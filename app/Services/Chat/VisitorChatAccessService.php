<?php

namespace App\Services\Chat;

use App\Models\ChatConversation;
use App\Models\ChatVisitor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VisitorChatAccessService
{
    /**
     * Verify that a given conversation UUID strictly belongs to the authenticated ChatVisitor.
     * Throws ModelNotFoundException (HTTP 404) if conversation does not exist or ownership check fails.
     * Prevents IDOR by never disclosing existence of unauthorized conversations.
     *
     * @throws ModelNotFoundException
     */
    public function verifyConversationOwnership(ChatVisitor $visitor, string $conversationUuid): ChatConversation
    {
        return ChatConversation::query()
            ->where('conversation_uuid', $conversationUuid)
            ->where('chat_visitor_id', $visitor->id)
            ->firstOrFail();
    }

    /**
     * Check boolean access permission for a visitor against a loaded conversation instance.
     */
    public function canAccess(ChatVisitor $visitor, ChatConversation $conversation): bool
    {
        if ($visitor->blocked_at !== null) {
            return false;
        }

        return (int) $conversation->chat_visitor_id === (int) $visitor->id;
    }
}
