<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ChatAttachment extends Model
{
    use HasFactory;

    protected $table = 'chat_attachments';

    protected $fillable = [
        'attachment_uuid',
        'chat_message_id',
        'original_name',
        'stored_path',
        'disk',
        'mime_type',
        'file_size',
    ];

    protected function casts(): array
    {
        return [
            'attachment_uuid' => 'string',
            'file_size' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ChatAttachment $attachment) {
            if (empty($attachment->attachment_uuid)) {
                $attachment->attachment_uuid = (string) Str::uuid();
            }
        });
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(ChatMessage::class, 'chat_message_id');
    }
}
