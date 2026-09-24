<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatAttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'attachment_uuid' => $this->attachment_uuid,
            'original_name' => $this->original_name,
            'mime_type' => $this->mime_type,
            'file_size' => (int) $this->file_size,
            'is_image' => str_starts_with($this->mime_type, 'image/'),
            'download_url' => route('api.chat.attachments.show', ['attachment_uuid' => $this->attachment_uuid]),
        ];
    }
}
