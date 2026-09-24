<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatVisitorSession extends Model
{
    use HasFactory;

    protected $table = 'chat_visitor_sessions';

    protected $fillable = [
        'chat_visitor_id',
        'token_hash',
        'expires_at',
        'last_active_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'last_active_at' => 'datetime',
        ];
    }

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(ChatVisitor::class, 'chat_visitor_id');
    }
}
