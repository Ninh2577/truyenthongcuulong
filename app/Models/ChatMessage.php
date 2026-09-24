<?php

namespace App\Models;

use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ChatMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_messages';

    protected $fillable = [
        'message_uuid',
        'chat_conversation_id',
        'sender_type',
        'sender_user_id',
        'message_body',
        'status',
        'read_at',
        'edited_at',
        'recalled_at',
    ];

    protected function casts(): array
    {
        return [
            'message_uuid' => 'string',
            'sender_type' => ChatMessageSenderType::class,
            'status' => ChatMessageStatus::class,
            'read_at' => 'datetime',
            'edited_at' => 'datetime',
            'recalled_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ChatMessage $message) {
            if (empty($message->message_uuid)) {
                $message->message_uuid = (string) Str::uuid();
            }
        });
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatConversation::class, 'chat_conversation_id');
    }

    public function senderUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ChatAttachment::class, 'chat_message_id');
    }
}
