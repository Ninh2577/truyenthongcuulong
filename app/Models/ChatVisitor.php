<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ChatVisitor extends Model
{
    use HasFactory;

    protected $table = 'chat_visitors';

    protected $fillable = [
        'visitor_uuid',
        'name',
        'phone',
        'email',
        'first_ip',
        'user_agent',
        'blocked_at',
    ];

    protected function casts(): array
    {
        return [
            'visitor_uuid' => 'string',
            'blocked_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ChatVisitor $visitor) {
            if (empty($visitor->visitor_uuid)) {
                $visitor->visitor_uuid = (string) Str::uuid();
            }
        });
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(ChatVisitorSession::class, 'chat_visitor_id');
    }

    public function activeSessions(): HasMany
    {
        return $this->hasMany(ChatVisitorSession::class, 'chat_visitor_id')->where('expires_at', '>', now());
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(ChatConversation::class, 'chat_visitor_id');
    }

    public function internalNotes(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            ChatInternalNote::class,
            ChatConversation::class,
            'chat_visitor_id',
            'chat_conversation_id',
            'id',
            'id'
        );
    }
}
