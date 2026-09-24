<?php

namespace App\Services\Chat\AI;

use App\Enums\ChatConversationStatus;
use App\Exceptions\Chat\ChatAIException;
use App\Models\ChatConversation;

class ChatAISecurityGuard
{
    /**
     * Ensure the conversation is eligible for AI generation.
     * Fails closed if conversation is spam, visitor is blocked, or conversation is closed.
     *
     * @param ChatConversation $conversation
     * @throws ChatAIException
     */
    public function assertEligible(ChatConversation $conversation): void
    {
        // 1. Check Moderation: Blocked Visitor
        $visitor = $conversation->visitor;
        if ($visitor && $visitor->blocked_at !== null) {
            throw new ChatAIException(
                'Khách truy cập đang bị chặn bởi quản trị viên.',
                'AI_VISITOR_BLOCKED',
                403
            );
        }

        // 2. Check Moderation: Spam Conversation
        if ($conversation->status === ChatConversationStatus::Spam) {
            throw new ChatAIException(
                'Cuộc hội thoại đã bị đánh dấu là spam.',
                'AI_CONVERSATION_SPAM',
                403
            );
        }

        // 3. Check Lifecycle: Closed Conversation
        if ($conversation->status === ChatConversationStatus::Closed) {
            throw new ChatAIException(
                'Cuộc hội thoại đã đóng, không thể sinh phản hồi.',
                'AI_CONVERSATION_CLOSED',
                409
            );
        }
    }

    /**
     * Sanitize and strip unsafe HTML/scripts from AI outputs before saving to conversation.
     */
    public function sanitizeOutput(?string $content): string
    {
        if ($content === null) {
            return '';
        }

        return strip_tags(trim($content));
    }
}
