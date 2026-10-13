<?php

namespace App\Services\Chat\AI;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationUpdated;
use App\Events\Chat\ChatMessageCreated;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;

class ChatHandoffService
{
    public function __construct(
        protected ?ChatAISettingsResolver $settingsResolver = null
    ) {
        $this->settingsResolver = $settingsResolver ?? app(ChatAISettingsResolver::class);
    }

    /**
     * Determine if visitor message text explicitly or semantically requests human agent handoff.
     * Evaluates configured keywords, natural conversational requests, and legal/contract topics.
     */
    public function isHandoffRequested(string $messageText): bool
    {
        $clean = mb_strtolower(trim($messageText), 'UTF-8');
        if ($clean === '') {
            return false;
        }

        // 1. Configured exact keyword substrings
        $keywords = $this->settingsResolver->getHandoffKeywords();
        foreach ($keywords as $kw) {
            $kwLower = mb_strtolower(trim($kw), 'UTF-8');
            if ($kwLower !== '' && str_contains($clean, $kwLower)) {
                return true;
            }
        }

        // 2. Natural language human agent intent patterns
        $naturalPatterns = [
            '/(nói\s+chuyện|trao\s+đổi|gặp|kết\s+nối)\s+(với\s+)?(người\s+thật|nhân\s+viên|tư\s+vấn\s+viên|chuyên\s+viên|cskh|người\s+phụ\s+trách)/u',
            '/(muốn|cho\s+tôi|cần|xin)\s+(gặp|nói\s+chuyện|trao\s+đổi\s+với)\s+(người\s+thật|nhân\s+viên|tư\s+vấn\s+viên|chuyên\s+viên|cskh|người\s+phụ\s+trách)/u',
            '/(có\s+tư\s+vấn\s+viên|có\s+nhân\s+viên)\s+(không|ở\s+đây\s+không)/u',
            '/(trao\s+đổi\s+trực\s+tiếp|nói\s+chuyện\s+trực\s+tiếp|gặp\s+trực\s+tiếp)/u',
        ];

        foreach ($naturalPatterns as $pattern) {
            if (preg_match($pattern, $clean)) {
                return true;
            }
        }

        // 3. Sensitive topics requiring mandatory human oversight (Contracts, Legal, Complaints)
        $sensitiveTopicPatterns = [
            '/(hợp\s+đồng|ký\s+hợp\s+đồng|điều\s+khoản\s+hợp\s+đồng)/u',
            '/(pháp\s+lý|trách\s+nhiệm\s+pháp\s+lý|bồi\s+thường\s+thiệt\s+hại)/u',
            '/(khiếu\s+nại|phản\s+ánh\s+dịch\s+vụ|tố\s+cáo)/u',
        ];

        foreach ($sensitiveTopicPatterns as $pattern) {
            if (preg_match($pattern, $clean)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Execute handoff from AI to human agent queue.
     * Sets channel to Human, status to WaitingAgent, persists notification message,
     * logs internal note, and dispatches events.
     *
     * @param ChatConversation $conversation
     * @param string $reason Reason for handoff ('Yêu cầu từ khách', 'AI timeout', 'AI provider error', etc.)
     * @param string|null $customerNotice Customer-facing message
     * @return ChatMessage|null Created bot message
     */
    public function executeHandoff(
        ChatConversation $conversation,
        string $reason,
        ?string $customerNotice = null
    ): ?ChatMessage {
        return DB::transaction(function () use ($conversation, $reason, $customerNotice) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->first();

            if (! $lockedConv) {
                return null;
            }

            // Do not perform handoff on spam or closed conversations
            if ($lockedConv->status === ChatConversationStatus::Spam || $lockedConv->status === ChatConversationStatus::Closed) {
                return null;
            }

            // Idempotency Invariant: If conversation is already transitioned to Human / WaitingAgent or Assigned, do NOT duplicate handoff notice or internal notes!
            if ($lockedConv->channel === ChatConversationChannel::Human && in_array($lockedConv->status, [ChatConversationStatus::WaitingAgent, ChatConversationStatus::Assigned], true)) {
                return $lockedConv->messages()
                    ->where('sender_type', ChatMessageSenderType::Bot)
                    ->latest('id')
                    ->first();
            }

            // Transition channel to human (disables automated AI replies)
            $lockedConv->channel = ChatConversationChannel::Human;

            // Transition status to WaitingAgent unless already assigned to an agent
            if ($lockedConv->assigned_to_user_id === null) {
                $lockedConv->status = ChatConversationStatus::WaitingAgent;
            }

            $lockedConv->save();

            // Record internal audit note for CSKH agents
            ChatInternalNote::create([
                'chat_conversation_id' => $lockedConv->id,
                'user_id' => null,
                'note_body' => "[Bàn giao nhân viên] {$reason}. Kênh chuyển sang Human, trạng thái: {$lockedConv->status->value}.",
            ]);

            // Persist customer notification message
            $noticeText = $customerNotice ?? $this->settingsResolver->getHandoffNotice();

            $botMessage = $lockedConv->messages()->create([
                'sender_type' => ChatMessageSenderType::Bot,
                'sender_user_id' => null,
                'message_body' => $noticeText,
                'status' => ChatMessageStatus::Sent,
            ]);

            // Atomically update conversation metadata
            $lockedConv->increment('visitor_unread_count', 1, [
                'last_message_at' => now(),
            ]);

            $freshMessage = $botMessage->fresh();
            $freshConversation = $lockedConv->fresh(['assignedUser', 'visitor']);

            DB::afterCommit(function () use ($freshMessage, $freshConversation) {
                event(new ChatMessageCreated($freshMessage));
                event(new ChatConversationUpdated($freshConversation));
            });

            return $freshMessage;
        });
    }
}
