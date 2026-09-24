<?php

namespace App\Events\Chat;

use App\Models\ChatMessage;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageRecalled
{
    use Dispatchable, SerializesModels;

    public string $conversationUuid;
    public string $messageUuid;
    public bool $recalled;
    public ?string $recalledAt;
    public array $attachments;

    /**
     * Create a new event instance with strictly public safe payload.
     * Original message body is masked to null and attachments empty.
     */
    public function __construct(ChatMessage $message)
    {
        $conversation = $message->conversation;

        $this->conversationUuid = $conversation ? $conversation->conversation_uuid : '';
        $this->messageUuid = $message->message_uuid;
        $this->recalled = true;
        $this->recalledAt = $message->recalled_at?->toISOString();
        $this->attachments = [];
    }

    /**
     * Get the sanitized public payload representation for broadcasts or consumers.
     */
    public function publicPayload(): array
    {
        return [
            'conversation_uuid' => $this->conversationUuid,
            'message_uuid' => $this->messageUuid,
            'message' => null,
            'recalled' => true,
            'recalled_at' => $this->recalledAt,
            'attachments' => [],
        ];
    }
}
