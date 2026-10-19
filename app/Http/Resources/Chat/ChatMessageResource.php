<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isRecalled = $this->recalled_at !== null || $this->status === \App\Enums\ChatMessageStatus::Recalled;
        $isDeleted = $this->deleted_at !== null || $this->status === \App\Enums\ChatMessageStatus::Deleted;

        return [
            'message_uuid' => $this->message_uuid,
            'client_message_id' => $this->client_message_id,
            'sender_type' => $this->sender_type instanceof \BackedEnum ? $this->sender_type->value : (string) $this->sender_type,
            'message' => ($isRecalled || $isDeleted) ? null : $this->message_body,
            'status' => $this->status instanceof \BackedEnum ? $this->status->value : (string) $this->status,
            'recalled' => $isRecalled,
            'recalled_at' => $this->recalled_at?->toISOString(),
            'deleted' => $isDeleted,
            'deleted_at' => $this->deleted_at?->toISOString(),
            'edited_at' => $this->edited_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'attachments' => ($isRecalled || $isDeleted) ? [] : ChatAttachmentResource::collection($this->whenLoaded('attachments')),
        ];
    }
}
