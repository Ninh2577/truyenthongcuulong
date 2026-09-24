<?php

namespace App\Events\Chat;

use App\Http\Resources\Chat\ChatAttachmentResource;
use App\Models\ChatMessage;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageCreated
{
    use Dispatchable, SerializesModels;

    public string $conversationUuid;
    public string $messageUuid;
    public string $senderType;
    public ?string $message;
    public string $status;
    public bool $recalled;
    public ?string $createdAt;
    public array $attachments;
    public ?ChatMessage $chatMessage = null;

    /**
     * Create a new event instance with strictly public safe payload.
     * Zero internal numeric IDs, zero visitor tokens, zero private storage paths.
     */
    public function __construct(ChatMessage $message)
    {
        $this->chatMessage = $message;
        $conversation = $message->conversation;

        $this->conversationUuid = $conversation ? $conversation->conversation_uuid : '';
        $this->messageUuid = $message->message_uuid;
        $this->senderType = $message->sender_type instanceof \BackedEnum ? $message->sender_type->value : (string) $message->sender_type;
        $this->message = $message->recalled_at !== null ? null : $message->message_body;
        $this->status = $message->status instanceof \BackedEnum ? $message->status->value : (string) $message->status;
        $this->recalled = $message->recalled_at !== null;
        $this->createdAt = $message->created_at?->toISOString();

        $this->attachments = $this->recalled
            ? []
            : ChatAttachmentResource::collection($message->relationLoaded('attachments') ? $message->attachments : $message->attachments()->get())
                ->resolve();
    }

    /**
     * Get the sanitized public payload representation for broadcasts or consumers.
     */
    public function publicPayload(): array
    {
        return [
            'conversation_uuid' => $this->conversationUuid,
            'message_uuid' => $this->messageUuid,
            'sender_type' => $this->senderType,
            'message' => $this->message,
            'status' => $this->status,
            'recalled' => $this->recalled,
            'created_at' => $this->createdAt,
            'attachments' => $this->attachments,
        ];
    }
}
