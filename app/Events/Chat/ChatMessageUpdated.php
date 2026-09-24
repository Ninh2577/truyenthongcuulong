<?php

namespace App\Events\Chat;

use App\Http\Resources\Chat\ChatAttachmentResource;
use App\Models\ChatMessage;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageUpdated
{
    use Dispatchable, SerializesModels;

    public string $conversationUuid;
    public string $messageUuid;
    public ?string $message;
    public ?string $editedAt;
    public array $attachments;

    /**
     * Create a new event instance with strictly public safe payload.
     */
    public function __construct(ChatMessage $message)
    {
        $conversation = $message->conversation;

        $this->conversationUuid = $conversation ? $conversation->conversation_uuid : '';
        $this->messageUuid = $message->message_uuid;
        $this->message = $message->recalled_at !== null ? null : $message->message_body;
        $this->editedAt = $message->edited_at?->toISOString();

        $this->attachments = $message->recalled_at !== null
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
            'message' => $this->message,
            'edited_at' => $this->editedAt,
            'attachments' => $this->attachments,
        ];
    }
}
