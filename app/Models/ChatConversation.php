<?php

namespace App\Models;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class ChatConversation extends Model
{
    use HasFactory;

    protected $table = 'chat_conversations';

    protected $fillable = [
        'conversation_uuid',
        'chat_visitor_id',
        'assigned_to_user_id',
        'status',
        'channel',
        'last_message_at',
        'visitor_unread_count',
        'agent_unread_count',
        'closed_at',
        'closed_by_user_id',
    ];

    protected function casts(): array
    {
        return [
            'conversation_uuid' => 'string',
            'status' => ChatConversationStatus::class,
            'channel' => ChatConversationChannel::class,
            'last_message_at' => 'datetime',
            'visitor_unread_count' => 'integer',
            'agent_unread_count' => 'integer',
            'closed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ChatConversation $conversation) {
            if (empty($conversation->conversation_uuid)) {
                $conversation->conversation_uuid = (string) Str::uuid();
            }
        });
    }

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(ChatVisitor::class, 'chat_visitor_id');
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function closedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by_user_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'chat_conversation_id');
    }

    /**
     * The single most-recent message for this conversation.
     * Use this for conversation list snippets to avoid N+1 queries.
     * Eager-load with ->with('latestMessage') in queries.
     */
    public function latestMessage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ChatMessage::class, 'chat_conversation_id')->latestOfMany();
    }

    public function internalNotes(): HasMany
    {
        return $this->hasMany(ChatInternalNote::class, 'chat_conversation_id');
    }

    public function attachments(): HasManyThrough
    {
        return $this->hasManyThrough(ChatAttachment::class, ChatMessage::class, 'chat_conversation_id', 'chat_message_id');
    }
}
