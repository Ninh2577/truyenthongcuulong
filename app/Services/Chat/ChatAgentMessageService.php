<?php

namespace App\Services\Chat;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationUpdated;
use App\Events\Chat\ChatMessageCreated;
use App\Events\Chat\ChatMessageRecalled;
use App\Events\Chat\ChatMessageUpdated;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ChatAgentMessageService
{
    /**
     * Send a message from the authenticated agent into the specified conversation.
     * Enforces server-side controlled sender_type=agent and sender_user_id.
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function sendAgentMessage(
        User $agent,
        ChatConversation $conversation,
        ?string $body = null,
        array $attachments = []
    ): ChatMessage {
        if (Gate::forUser($agent)->denies('reply', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to reply to this conversation.');
        }

        // Conversation status invariants
        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('Cuộc trò chuyện này đã bị đánh dấu spam.');
        }

        if ($conversation->status === ChatConversationStatus::Closed) {
            throw new UnprocessableEntityHttpException('Cuộc trò chuyện đã đóng. Vui lòng mở lại trước khi gửi tin nhắn.');
        }

        $cleanBody = strip_tags(trim((string) $body));
        if ($cleanBody === '' && empty($attachments)) {
            throw new UnprocessableEntityHttpException('Nội dung tin nhắn hoặc tệp đính kèm không được để trống.');
        }

        $maxLength = (int) config('chat.message_max_length', 2000);
        if (mb_strlen($cleanBody) > $maxLength) {
            throw new UnprocessableEntityHttpException("Nội dung tin nhắn không được vượt quá {$maxLength} ký tự.");
        }

        return DB::transaction(function () use ($agent, $conversation, $cleanBody, $attachments) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Create message strictly bound to authenticated agent
            $message = $lockedConv->messages()->create([
                'sender_type' => ChatMessageSenderType::Agent,
                'sender_user_id' => $agent->id,
                'message_body' => $cleanBody,
                'status' => ChatMessageStatus::Sent,
            ]);

            if (! empty($attachments)) {
                /** @var ChatAttachmentService $attachmentService */
                $attachmentService = app(ChatAttachmentService::class);
                $attachmentService->storeAttachmentsForMessage($message, $attachments);
            }

            // If conversation is unclaimed, auto-assign to the replying agent
            if ($lockedConv->assigned_to_user_id === null) {
                $lockedConv->assigned_to_user_id = $agent->id;
            }

            // Update conversation lifecycle: advance status to waiting_customer and channel to Human (agent takeover)
            $extraData = [
                'last_message_at' => now(),
                'assigned_to_user_id' => $lockedConv->assigned_to_user_id,
                'channel' => \App\Enums\ChatConversationChannel::Human,
                'status' => ChatConversationStatus::WaitingCustomer,
            ];

            // Increment visitor_unread_count atomically
            $lockedConv->increment('visitor_unread_count', 1, $extraData);

            $freshMessage = $message->fresh(['senderUser', 'attachments']);
            $freshConversation = $lockedConv->fresh();

            DB::afterCommit(function () use ($freshMessage, $freshConversation) {
                event(new ChatMessageCreated($freshMessage));
                event(new ChatConversationUpdated($freshConversation));
            });

            return $freshMessage;
        });
    }

    /**
     * List messages for the conversation with deterministic ordering and bounded pagination.
     */
    public function listMessages(User $agent, ChatConversation $conversation, int $perPage = 50): LengthAwarePaginator
    {
        if (Gate::forUser($agent)->denies('view', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to view messages in this conversation.');
        }

        $maxPerPage = (int) config('chat.messages_per_page_max', 100);
        $perPage = max(1, min($perPage, $maxPerPage));

        return $conversation->messages()
            ->with(['senderUser', 'attachments'])
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->paginate($perPage);
    }

    /**
     * Edit an agent message within the allowed time window (default 15 minutes).
     * Strictly verifies that only the original authoring agent can edit the message.
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function editAgentMessage(
        User $agent,
        ChatConversation $conversation,
        string $messageUuid,
        string $newBody
    ): ChatMessage {
        if (Gate::forUser($agent)->denies('reply', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to edit messages in this conversation.');
        }

        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('Cuộc trò chuyện này đã bị đánh dấu spam.');
        }

        $message = $conversation->messages()
            ->where('message_uuid', $messageUuid)
            ->firstOrFail();

        if ($message->sender_type !== ChatMessageSenderType::Agent) {
            throw new AccessDeniedHttpException('Chỉ có thể chỉnh sửa tin nhắn của nhân viên.');
        }

        if ((int) $message->sender_user_id !== (int) $agent->id) {
            throw new AccessDeniedHttpException('Bạn không thể chỉnh sửa tin nhắn của nhân viên khác.');
        }

        if ($message->recalled_at !== null) {
            throw new UnprocessableEntityHttpException('Không thể chỉnh sửa tin nhắn đã bị thu hồi.');
        }

        $windowMinutes = (int) config('chat.message_edit_window_minutes', 15);
        if ($message->created_at->addMinutes($windowMinutes)->isPast()) {
            throw new UnprocessableEntityHttpException("Tin nhắn chỉ có thể chỉnh sửa trong vòng {$windowMinutes} phút sau khi gửi.");
        }

        $cleanBody = strip_tags(trim($newBody));
        if ($cleanBody === '') {
            throw new UnprocessableEntityHttpException('Nội dung tin nhắn không được để trống.');
        }

        return DB::transaction(function () use ($message, $cleanBody) {
            $message->update([
                'message_body' => $cleanBody,
                'edited_at' => now(),
            ]);

            $freshMessage = $message->fresh(['senderUser', 'attachments']);

            DB::afterCommit(function () use ($freshMessage) {
                event(new ChatMessageUpdated($freshMessage));
            });

            return $freshMessage;
        });
    }

    /**
     * Recall an agent message within the allowed time window (default 60 minutes).
     * Strictly verifies that only the original authoring agent can recall the message.
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function recallAgentMessage(
        User $agent,
        ChatConversation $conversation,
        string $messageUuid
    ): ChatMessage {
        if (Gate::forUser($agent)->denies('reply', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to recall messages in this conversation.');
        }

        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('Cuộc trò chuyện này đã bị đánh dấu spam.');
        }

        $message = $conversation->messages()
            ->where('message_uuid', $messageUuid)
            ->firstOrFail();

        if ($message->sender_type !== ChatMessageSenderType::Agent) {
            throw new AccessDeniedHttpException('Chỉ có thể thu hồi tin nhắn của nhân viên.');
        }

        if ((int) $message->sender_user_id !== (int) $agent->id) {
            throw new AccessDeniedHttpException('Bạn không thể thu hồi tin nhắn của nhân viên khác.');
        }

        if ($message->recalled_at !== null) {
            throw new UnprocessableEntityHttpException('Tin nhắn này đã được thu hồi trước đó.');
        }

        $windowMinutes = (int) config('chat.message_recall_window_minutes', 60);
        if ($message->created_at->addMinutes($windowMinutes)->isPast()) {
            throw new UnprocessableEntityHttpException("Tin nhắn chỉ có thể thu hồi trong vòng {$windowMinutes} phút sau khi gửi.");
        }

        return DB::transaction(function () use ($message) {
            $message->update([
                'recalled_at' => now(),
            ]);

            $freshMessage = $message->fresh(['senderUser']);

            DB::afterCommit(function () use ($freshMessage) {
                event(new ChatMessageRecalled($freshMessage));
            });

            return $freshMessage;
        });
    }

    /**
     * Add an internal note to the conversation.
     * Notes are strictly private to agents and admins; never exposed to visitors.
     */
    public function addInternalNote(User $agent, ChatConversation $conversation, string $noteBody): ChatInternalNote
    {
        if (Gate::forUser($agent)->denies('view', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to add notes to this conversation.');
        }

        $cleanBody = strip_tags(trim($noteBody));
        if ($cleanBody === '') {
            throw new UnprocessableEntityHttpException('Nội dung ghi chú không được để trống.');
        }

        return $conversation->internalNotes()->create([
            'user_id' => $agent->id,
            'note_body' => $cleanBody,
        ]);
    }

    /**
     * List all internal notes for a conversation.
     */
    public function listInternalNotes(User $agent, ChatConversation $conversation): Collection
    {
        if (Gate::forUser($agent)->denies('view', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to view notes for this conversation.');
        }

        return $conversation->internalNotes()
            ->with(['user'])
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
