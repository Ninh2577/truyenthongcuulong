<?php

namespace App\Services\Chat\Automation;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationUpdated;
use App\Events\Chat\ChatMessageCreated;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ChatAutomationActionService
{
    /**
     * Send an automated system message into a conversation.
     * Enforces sender_type = System, increments visitor_unread_count atomically,
     * updates last_message_at, and dispatches sanitized domain events.
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function sendAutomatedMessage(ChatConversation $conversation, string $messageBody, ?string $ruleName = null): ChatMessage
    {
        // Enforce moderation invariants
        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('Cannot execute automation on a spam conversation.');
        }

        if ($conversation->status === ChatConversationStatus::Closed) {
            throw new UnprocessableEntityHttpException('Cannot execute automation on a closed conversation.');
        }

        $cleanBody = strip_tags(trim($messageBody));
        if ($cleanBody === '') {
            throw new UnprocessableEntityHttpException('Automated message body cannot be empty.');
        }

        return DB::transaction(function () use ($conversation, $cleanBody, $ruleName) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Create system message strictly bound to sender_type = System
            $message = $lockedConv->messages()->create([
                'sender_type' => ChatMessageSenderType::System,
                'sender_user_id' => null,
                'message_body' => $cleanBody,
                'status' => ChatMessageStatus::Sent,
            ]);

            // Update conversation metadata: increment visitor unread count and touch last_message_at
            $lockedConv->increment('visitor_unread_count', 1, [
                'last_message_at' => now(),
            ]);

            // Record execution audit note
            if (! empty($ruleName)) {
                ChatInternalNote::create([
                    'chat_conversation_id' => $lockedConv->id,
                    'user_id' => null,
                    'note_body' => "[Tự động hóa: {$ruleName}] Đã gửi phản hồi tự động cho khách.",
                ]);
            }

            $freshMessage = $message->fresh();
            $freshConversation = $lockedConv->fresh();

            DB::afterCommit(function () use ($freshMessage, $freshConversation) {
                event(new ChatMessageCreated($freshMessage));
                event(new ChatConversationUpdated($freshConversation));
            });

            return $freshMessage;
        });
    }

    /**
     * Update conversation status via automation rule (e.g. tag or route).
     *
     * @throws AccessDeniedHttpException
     */
    public function updateConversationStatus(
        ChatConversation $conversation,
        ChatConversationStatus $newStatus,
        ?string $ruleName = null
    ): ChatConversation {
        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('Cannot update status of a spam conversation via automation.');
        }

        return DB::transaction(function () use ($conversation, $newStatus, $ruleName) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            $oldStatus = $lockedConv->status->value;
            $lockedConv->status = $newStatus;
            $lockedConv->save();

            if (! empty($ruleName)) {
                ChatInternalNote::create([
                    'chat_conversation_id' => $lockedConv->id,
                    'user_id' => null,
                    'note_body' => "[Tự động hóa: {$ruleName}] Trạng thái chuyển từ '{$oldStatus}' sang '{$newStatus->value}'.",
                ]);
            }

            $fresh = $lockedConv->fresh(['visitor', 'assignedUser']);

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationUpdated($fresh));
            });

            return $fresh;
        });
    }
}
