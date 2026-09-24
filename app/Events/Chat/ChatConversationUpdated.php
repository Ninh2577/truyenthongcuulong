<?php

namespace App\Events\Chat;

use App\Models\ChatConversation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatConversationUpdated
{
    use Dispatchable, SerializesModels;

    public string $conversationUuid;
    public string $status;
    public int $visitorUnreadCount;
    public int $agentUnreadCount;
    public ?string $lastMessageAt;

    /**
     * Create a new event instance with strictly public safe payload.
     * Zero internal numeric IDs, zero sensitive agent metadata.
     */
    public function __construct(ChatConversation $conversation)
    {
        $this->conversationUuid = $conversation->conversation_uuid;
        $this->status = $conversation->status instanceof \BackedEnum ? $conversation->status->value : (string) $conversation->status;
        $this->visitorUnreadCount = (int) $conversation->visitor_unread_count;
        $this->agentUnreadCount = (int) $conversation->agent_unread_count;
        $this->lastMessageAt = $conversation->last_message_at?->toISOString();
    }

    /**
     * Get the sanitized public payload representation for broadcasts or consumers.
     */
    public function publicPayload(): array
    {
        return [
            'conversation_uuid' => $this->conversationUuid,
            'status' => $this->status,
            'visitor_unread_count' => $this->visitorUnreadCount,
            'agent_unread_count' => $this->agentUnreadCount,
            'last_message_at' => $this->lastMessageAt,
        ];
    }
}
