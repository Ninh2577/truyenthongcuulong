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
     * Determine if visitor message text explicitly requests human agent handoff.
     */
    public function isHandoffRequested(string $messageText): bool
    {
        $clean = mb_strtolower(trim($messageText), 'UTF-8');
        if ($clean === '') {
            return false;
        }

        $keywords = $this->settingsResolver->getHandoffKeywords();

        foreach ($keywords as $kw) {
            $kwLower = mb_strtolower(trim($kw), 'UTF-8');
            if ($kwLower !== '' && str_contains($clean, $kwLower)) {
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
