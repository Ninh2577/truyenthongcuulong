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
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ChatMessageService
{
    /**
     * Send a message from the authenticated visitor into the specified conversation.
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function sendMessage(
        ChatVisitor $visitor,
        ChatConversation $conversation,
        ?string $body = null,
        array $attachments = []
    ): ChatMessage {
        if ($visitor->blocked_at !== null) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        // Check conversation status invariants
        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('This conversation has been marked as spam.');
        }

        if ($conversation->status === ChatConversationStatus::Closed) {
            throw new UnprocessableEntityHttpException('Conversation is closed. Please start a new conversation.');
        }

        $cleanBody = strip_tags(trim((string) $body));
        if ($cleanBody === '' && empty($attachments)) {
            throw new UnprocessableEntityHttpException('Nội dung tin nhắn hoặc tệp đính kèm không được để trống.');
        }

        return DB::transaction(function () use ($conversation, $cleanBody, $attachments) {
            // Re-lock conversation to ensure atomic metadata update and serial flood validation
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()->where('id', $conversation->id)->lockForUpdate()->first();

            if ($cleanBody !== '') {
                $this->validateDuplicateSpam($lockedConv, $cleanBody);
            }

            $message = $lockedConv->messages()->create([
                'sender_type' => ChatMessageSenderType::Visitor,
                'sender_user_id' => null,
                'message_body' => $cleanBody,
                'status' => ChatMessageStatus::Sent,
            ]);

            if (! empty($attachments)) {
                /** @var ChatAttachmentService $attachmentService */
                $attachmentService = app(ChatAttachmentService::class);
                $attachmentService->storeAttachmentsForMessage($message, $attachments);
            }

            // Update conversation metadata atomically with SQL-level increment
            $extraData = [
                'last_message_at' => now(),
            ];

            // If conversation was waiting for customer reply, advance status to waiting_agent
            if ($lockedConv->status === ChatConversationStatus::WaitingCustomer) {
                $extraData['status'] = ChatConversationStatus::WaitingAgent;
            }

            $lockedConv->increment('agent_unread_count', 1, $extraData);

            $freshMessage = $message->fresh(['attachments']);
            $freshConversation = $lockedConv->fresh();

            DB::afterCommit(function () use ($freshMessage, $freshConversation) {
                event(new ChatMessageCreated($freshMessage));
                event(new ChatConversationUpdated($freshConversation));
            });

            return $freshMessage;
        });
    }

    /**
     * List messages for the conversation with stable ordering and bounded pagination.
     * Optionally filtered to messages after the given message UUID cursor.
     */
    public function listMessages(
        ChatConversation $conversation,
        int $perPage = 30,
        ?string $afterUuid = null
    ): LengthAwarePaginator {
        $maxPerPage = (int) config('chat.messages_per_page_max', 100);
        $perPage = max(1, min($perPage, $maxPerPage));

        $query = $conversation->messages()
            ->with(['attachments'])
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc');

        if ($afterUuid) {
            $cursor = $conversation->messages()
                ->where('message_uuid', $afterUuid)
                ->first();

            if ($cursor) {
                $query->where(function ($q) use ($cursor) {
                    $q->where('created_at', '>', $cursor->created_at)
                        ->orWhere(function ($sub) use ($cursor) {
                            $sub->where('created_at', '=', $cursor->created_at)
                                ->where('id', '>', $cursor->id);
                        });
                });
            }
        }

        return $query->paginate($perPage);
    }

    /**
     * Edit a visitor message within the allowed time window (default 15 minutes).
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function editMessage(
        ChatVisitor $visitor,
        ChatConversation $conversation,
        string $messageUuid,
        string $newBody
    ): ChatMessage {
        if ($visitor->blocked_at !== null) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('This conversation has been marked as spam.');
        }

        $message = $conversation->messages()
            ->where('message_uuid', $messageUuid)
            ->firstOrFail();

        if ($message->sender_type !== ChatMessageSenderType::Visitor) {
            throw new AccessDeniedHttpException('Only visitor messages can be edited by the visitor.');
        }

        if ($message->recalled_at !== null) {
            throw new UnprocessableEntityHttpException('Recalled messages cannot be edited.');
        }

        $windowMinutes = (int) config('chat.message_edit_window_minutes', 15);
        if ($message->created_at->addMinutes($windowMinutes)->isPast()) {
            throw new UnprocessableEntityHttpException("Messages can only be edited within {$windowMinutes} minutes of sending.");
        }

        $cleanBody = strip_tags(trim($newBody));
        if ($cleanBody === '') {
            throw new UnprocessableEntityHttpException('Message body cannot be empty.');
        }

        return DB::transaction(function () use ($message, $cleanBody) {
            $message->update([
                'message_body' => $cleanBody,
                'edited_at' => now(),
            ]);

            $freshMessage = $message->fresh(['attachments']);

            DB::afterCommit(function () use ($freshMessage) {
                event(new ChatMessageUpdated($freshMessage));
            });

            return $freshMessage;
        });
    }

    /**
     * Recall a visitor message within the allowed time window (default 60 minutes).
     * Soft recall: retains the database record for audit while masking content from public API.
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function recallMessage(
        ChatVisitor $visitor,
        ChatConversation $conversation,
        string $messageUuid
    ): ChatMessage {
        if ($visitor->blocked_at !== null) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('This conversation has been marked as spam.');
        }

        $message = $conversation->messages()
            ->where('message_uuid', $messageUuid)
            ->firstOrFail();

        if ($message->sender_type !== ChatMessageSenderType::Visitor) {
            throw new AccessDeniedHttpException('Only visitor messages can be recalled by the visitor.');
        }

        if ($message->recalled_at !== null) {
            throw new UnprocessableEntityHttpException('Message has already been recalled.');
        }

        $windowMinutes = (int) config('chat.message_recall_window_minutes', 60);
        if ($message->created_at->addMinutes($windowMinutes)->isPast()) {
            throw new UnprocessableEntityHttpException("Messages can only be recalled within {$windowMinutes} minutes of sending.");
        }

        return DB::transaction(function () use ($message) {
            $message->update([
                'recalled_at' => now(),
            ]);

            $freshMessage = $message->fresh();

            DB::afterCommit(function () use ($freshMessage) {
                event(new ChatMessageRecalled($freshMessage));
            });

            return $freshMessage;
        });
    }

    /**
     * Inspect message body for rapid identical message floods.
     *
     * @throws UnprocessableEntityHttpException
     * @throws AccessDeniedHttpException
     */
    protected function validateDuplicateSpam(ChatConversation $conversation, string $cleanBody): void
    {
        $threshold = (int) config('chat.spam_duplicate_threshold', 4);
        $windowSeconds = (int) config('chat.spam_duplicate_window_seconds', 30);

        if ($threshold <= 1) {
            return;
        }

        $normalized = mb_strtolower(preg_replace('/\s+/u', ' ', trim($cleanBody)), 'UTF-8');

        // Check recent visitor messages in this conversation within the window
        $recentMessages = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::Visitor)
            ->where('created_at', '>=', now()->subSeconds($windowSeconds))
            ->orderBy('id', 'desc')
            ->limit($threshold)
            ->pluck('message_body');

        $identicalCount = 0;
        foreach ($recentMessages as $pastBody) {
            $pastNormalized = mb_strtolower(preg_replace('/\s+/u', ' ', trim((string) $pastBody)), 'UTF-8');
            if ($pastNormalized === $normalized) {
                $identicalCount++;
            }
        }

        if ($identicalCount >= ($threshold - 1)) {
            $action = config('chat.spam_duplicate_action', 'throttle');
            if ($action === 'mark_spam') {
                $conversation->update(['status' => ChatConversationStatus::Spam]);
                event(new ChatConversationUpdated($conversation->fresh()));
                throw new AccessDeniedHttpException('Cuộc trò chuyện đã bị đánh dấu spam do gửi tin nhắn trùng lặp liên tục.');
            }

            throw new UnprocessableEntityHttpException('Phát hiện tin nhắn trùng lặp gửi liên tục. Vui lòng thử lại sau giây lát.');
        }
    }
}
