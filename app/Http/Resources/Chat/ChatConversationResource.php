<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'conversation_uuid' => $this->conversation_uuid,
            'status' => $this->status instanceof \BackedEnum ? $this->status->value : (string) $this->status,
            'channel' => $this->channel instanceof \BackedEnum ? $this->channel->value : (string) $this->channel,
            'visitor_unread_count' => (int) $this->visitor_unread_count,
            'last_message_at' => $this->last_message_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
