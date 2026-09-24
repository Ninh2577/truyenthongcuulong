<?php

namespace App\Events\Chat;

use App\Models\ChatConversation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatConversationRead
{
    use Dispatchable, SerializesModels;

    public string $conversationUuid;
    public string $readerType; // 'visitor' | 'agent'
    public ?string $readAt;

    /**
     * Create a new event instance with strictly public safe payload.
     */
    public function __construct(ChatConversation $conversation, string $readerType)
    {
        $this->conversationUuid = $conversation->conversation_uuid;
        $this->readerType = $readerType;
        $this->readAt = now()->toISOString();
    }

    /**
     * Get the sanitized public payload representation for broadcasts or consumers.
     */
    public function publicPayload(): array
    {
        return [
            'conversation_uuid' => $this->conversationUuid,
            'reader_type' => $this->readerType,
            'read_at' => $this->readAt,
        ];
    }
}
