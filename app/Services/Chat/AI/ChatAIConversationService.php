<?php

namespace App\Services\Chat\AI;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIRequest;
use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationUpdated;
use App\Events\Chat\ChatMessageCreated;
use App\Exceptions\Chat\ChatAIException;
use App\Exceptions\Chat\ChatAITimeoutException;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ChatAIConversationService
{
    public function __construct(
        protected ChatAIServiceInterface $aiService,
        protected ChatAIContextBuilder $contextBuilder,
        protected ChatAISecurityGuard $securityGuard,
        protected ChatHandoffService $handoffService,
        protected ?ChatAISettingsResolver $settingsResolver = null
    ) {
        $this->settingsResolver = $settingsResolver ?? app(ChatAISettingsResolver::class);
    }

    /**
     * Process an incoming visitor message and orchestrate an AI reply or human handoff.
     *
     * @param ChatMessage|ChatConversation $conversationOrMessage
     * @param ChatMessage|null $triggerMessage
     * @return ChatMessage|null Created bot message if reply succeeded, null otherwise
     */
    public function processVisitorMessage(ChatMessage|ChatConversation $conversationOrMessage, ?ChatMessage $triggerMessage = null): ?ChatMessage
    {
        if ($triggerMessage === null && $conversationOrMessage instanceof ChatMessage) {
            $triggerMessage = $conversationOrMessage;
            $conversation = $triggerMessage->conversation;
        } elseif ($conversationOrMessage instanceof ChatConversation && $triggerMessage instanceof ChatMessage) {
            $conversation = $conversationOrMessage;
        } else {
            return null;
        }

        if (! $conversation || ! $triggerMessage) {
            return null;
        }

        // 1. Global AI Enablement Check
        if (! $this->settingsResolver->isEnabled()) {
            return null;
        }

        // 2. Loop Protection & Sender Identity Invariant:
        // Only visitor messages can trigger AI generation!
        if ($triggerMessage->sender_type !== ChatMessageSenderType::Visitor) {
            return null;
        }

        // 3. Pre-flight Moderation & Lifecycle Eligibility
        try {
            $this->securityGuard->assertEligible($conversation);
        } catch (ChatAIException) {
            return null;
        }

        // 4. Human Takeover & AI Channel Eligibility:
        // If an agent has already claimed or conversation is set to Human, AI must NOT reply!
        if ($conversation->assigned_to_user_id !== null || $conversation->channel === ChatConversationChannel::Human) {
            return null;
        }

        // 5. Explicit Human Handoff Request Check
        if ($this->handoffService->isHandoffRequested($triggerMessage->message_body)) {
            return $this->handoffService->executeHandoff(
                $conversation,
                'Khách hàng yêu cầu tư vấn viên trực tiếp: "' . mb_substr($triggerMessage->message_body, 0, 50) . '"'
            );
        }

        // 6. Concurrency & Idempotency Guard (Lock per triggering message UUID)
        $lockKey = "chat_ai:trigger:{$triggerMessage->message_uuid}";
        $lockAcquired = $this->getCacheStore()->add($lockKey, now()->timestamp, 60);
        if (! $lockAcquired) {
            // Already being processed or processed by another concurrent process
            return null;
        }

        // 7. Rate Limiting Guard (Max AI replies per conversation per minute)
        $maxPerMinute = $this->settingsResolver->getMaxRepliesPerMinute();
        $rateKey = "chat_ai:rate:{$conversation->id}";
        $currentCount = (int) $this->getCacheStore()->get($rateKey, 0);

        if ($currentCount >= $maxPerMinute) {
            $this->handoffService->executeHandoff(
                $conversation,
                "Tần suất hội thoại vượt ngưỡng AI ({$maxPerMinute} phản hồi/phút). Tự động bàn giao nhân viên."
            );
            return null;
        }

        // 8. Build Sanitized Context
        $aiRequest = $this->contextBuilder->build($conversation);

        // 9. Generate AI Reply
        try {
            $aiResponse = $this->aiService->generateReply($aiRequest);
        } catch (ChatAITimeoutException $e) {
            // Fallback gracefully on timeout
            return $this->handoffService->executeHandoff(
                $conversation,
                'AI Service Timeout: ' . $e->getMessage(),
                $this->settingsResolver->getFallbackNotice()
            );
        } catch (ChatAIException $e) {
            // Fallback gracefully on provider error without exposing credentials
            return $this->handoffService->executeHandoff(
                $conversation,
                'AI Provider Error [' . $e->getErrorCode() . ']',
                $this->settingsResolver->getFallbackNotice()
            );
        } catch (Throwable $e) {
            Log::error('Lỗi ngoại lệ khi sinh phản hồi AI chat: ' . $e->getMessage());
            return $this->handoffService->executeHandoff(
                $conversation,
                'AI System Exception',
                $this->settingsResolver->getFallbackNotice()
            );
        }

        $cleanReply = $this->securityGuard->sanitizeOutput($aiResponse->content);
        if ($cleanReply === '') {
            return $this->handoffService->executeHandoff(
                $conversation,
                'AI Malformed Empty Reply',
                $this->settingsResolver->getFallbackNotice()
            );
        }

        // 10. Atomic Persistence & Race Condition Protection
        return DB::transaction(function () use ($conversation, $cleanReply, $rateKey, $currentCount) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->first();

            if (! $lockedConv) {
                return null;
            }

            // CRITICAL RACE CONDITION RE-CHECKS INSIDE EXCLUSIVE LOCK:
            // 10.1 Did conversation become Spam while AI was computing?
            if ($lockedConv->status === ChatConversationStatus::Spam) {
                return null;
            }

            // 10.2 Did conversation become Closed while AI was computing?
            if ($lockedConv->status === ChatConversationStatus::Closed) {
                return null;
            }

            // 10.3 Did a Human Agent claim or reply while AI was computing?
            if ($lockedConv->assigned_to_user_id !== null || $lockedConv->channel === ChatConversationChannel::Human) {
                return null;
            }

            // 10.4 Did visitor get blocked while AI was computing?
            $visitor = $lockedConv->visitor;
            if ($visitor && $visitor->blocked_at !== null) {
                return null;
            }

            // Persist the bot message with sender_type = Bot and sender_user_id = null
            $botMessage = $lockedConv->messages()->create([
                'sender_type' => ChatMessageSenderType::Bot,
                'sender_user_id' => null,
                'message_body' => $cleanReply,
                'status' => ChatMessageStatus::Sent,
            ]);

            // Atomically update conversation metadata
            $lockedConv->increment('visitor_unread_count', 1, [
                'last_message_at' => now(),
            ]);

            // Increment conversation rate limit counter (TTL 60s)
            $this->getCacheStore()->put($rateKey, $currentCount + 1, 60);

            $freshMessage = $botMessage->fresh();
            $freshConversation = $lockedConv->fresh(['visitor', 'assignedUser']);

            DB::afterCommit(function () use ($freshMessage, $freshConversation) {
                event(new ChatMessageCreated($freshMessage));
                event(new ChatConversationUpdated($freshConversation));
            });

            return $freshMessage;
        });
    }

    /**
     * Get the cache repository for concurrency locks.
     * When running tests under an in-memory array store, seamlessly fall back to database
     * store if available to ensure cross-process atomic locks in multi-worker environments.
     */
    protected function getCacheStore(): CacheRepository
    {
        if (config('cache.default') === 'array' && config('cache.stores.database')) {
            try {
                return Cache::store('database');
            } catch (Throwable) {
                return Cache::store();
            }
        }

        return Cache::store();
    }
}
