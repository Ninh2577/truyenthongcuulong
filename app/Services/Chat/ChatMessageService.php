<?php

namespace App\Services\Chat;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationUpdated;
use App\Events\Chat\ChatMessageCreated;
use App\Events\Chat\ChatMessageDeleted;
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
        array $attachments = [],
        ?string $clientMessageId = null
    ): ChatMessage {
        $spamService = app(\App\Services\Chat\Spam\ChatSpamProtectionService::class);
        $clientIp = request()->ip();
        $visitorIp = $visitor->first_ip;
        if ($spamService->isIpBlocked($clientIp) || ($visitorIp && $spamService->isIpBlocked($visitorIp))) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        $rateLimit = (int) config('chat.message_send_rate_limit', 30);
        if (! $spamService->checkRateLimit($visitor, $clientIp, $rateLimit)) {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(429, 'Quá nhiều tin nhắn gửi cùng lúc. Vui lòng thử lại sau.');
        }

        if ($visitor->blocked_at !== null) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        // Check conversation status invariants
        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new AccessDeniedHttpException('This conversation has been marked as spam.');
        }

        if ($conversation->status === ChatConversationStatus::Closed) {
            $conversation->status = ChatConversationStatus::Open;
            $conversation->closed_at = null;
            $conversation->closed_by_user_id = null;
            $conversation->save();
        }

        $cleanBody = strip_tags(trim((string) $body));
        if ($cleanBody === '' && empty($attachments)) {
            throw new UnprocessableEntityHttpException('Nội dung tin nhắn hoặc tệp đính kèm không được để trống.');
        }

        return DB::transaction(function () use ($conversation, $cleanBody, $attachments, $spamService, $clientMessageId) {
            // Re-lock conversation to ensure atomic metadata update and serial flood validation
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()->where('id', $conversation->id)->lockForUpdate()->first();

            if (! $lockedConv) {
                throw new UnprocessableEntityHttpException('Cuộc trò chuyện không tồn tại.');
            }

            if ($lockedConv->status === ChatConversationStatus::Closed) {
                $lockedConv->status = ChatConversationStatus::Open;
                $lockedConv->closed_at = null;
                $lockedConv->closed_by_user_id = null;
                $lockedConv->save();
            }

            if ($lockedConv->status === ChatConversationStatus::Spam) {
                throw new AccessDeniedHttpException('This conversation has been marked as spam.');
            }

            // Idempotency check with client_message_id
            if (! empty($clientMessageId)) {
                try {
                    if (\Illuminate\Support\Facades\Schema::hasColumn('chat_messages', 'client_message_id')) {
                        $existing = $lockedConv->messages()
                            ->where('client_message_id', $clientMessageId)
                            ->first();
                        if ($existing) {
                            return $existing;
                        }
                    }
                } catch (\Throwable) {
                    // Fallback gracefully if column not yet migrated
                }
            }

            // Banned keyword spam protection guard
            $matchedBanned = $cleanBody !== '' ? $spamService->checkBannedKeywords($cleanBody) : null;
            if ($matchedBanned) {
                $spamService->handleSpamDetected($lockedConv, $matchedBanned);
            }

            if ($cleanBody !== '') {
                $this->validateDuplicateSpam($lockedConv, $cleanBody);
            }

            $msgPayload = [
                'sender_type' => ChatMessageSenderType::Visitor,
                'sender_user_id' => null,
                'message_body' => $cleanBody,
                'status' => ChatMessageStatus::Sent,
            ];

            try {
                if ($clientMessageId && \Illuminate\Support\Facades\Schema::hasColumn('chat_messages', 'client_message_id')) {
                    $msgPayload['client_message_id'] = $clientMessageId;
                }
            } catch (\Throwable) {
                // Ignore if schema check fails
            }

            $message = $lockedConv->messages()->create($msgPayload);

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

                try {
                    \Illuminate\Support\Facades\Cache::put('chat_latest_visitor_msg_id', $freshMessage->id, 86400);
                    \Illuminate\Support\Facades\Cache::put('chat_latest_visitor_msg_data', [
                        'has_new' => true,
                        'latest_id' => $freshMessage->id,
                        'message_id' => $freshMessage->id,
                        'message_uuid' => $freshMessage->message_uuid,
                        'conversation_uuid' => $freshConversation?->conversation_uuid,
                        'customer_name' => $freshConversation?->visitor?->name ?: 'Khách hàng',
                        'preview' => \Illuminate\Support\Str::limit($freshMessage->message_body, 90),
                        'created_at' => $freshMessage->created_at?->diffForHumans(),
                    ], 86400);
                } catch (\Throwable) {}
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
                'status' => ChatMessageStatus::Recalled,
            ]);

            $freshMessage = $message->fresh();

            DB::afterCommit(function () use ($freshMessage) {
                event(new ChatMessageRecalled($freshMessage));
                event(new ChatMessageUpdated($freshMessage));
            });

            return $freshMessage;
        });
    }

    /**
     * Delete a visitor message (soft delete with status=deleted and deleted_at set).
     * Retains record for audit while masking content from public endpoints.
     *
     * @throws AccessDeniedHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function deleteMessage(
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
            throw new AccessDeniedHttpException('Only visitor messages can be deleted by the visitor.');
        }

        if ($message->deleted_at !== null) {
            throw new UnprocessableEntityHttpException('Message has already been deleted.');
        }

        return DB::transaction(function () use ($message) {
            $message->update([
                'deleted_at' => now(),
                'status' => ChatMessageStatus::Deleted,
            ]);

            $freshMessage = $message->fresh();

            DB::afterCommit(function () use ($freshMessage) {
                event(new ChatMessageDeleted($freshMessage));
                event(new ChatMessageUpdated($freshMessage));
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
