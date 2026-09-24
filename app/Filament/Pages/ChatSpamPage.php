<?php

namespace App\Filament\Pages;

use App\Models\ChatConversation;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Gate;

/**
 * CHAT-14: Spam & Chặn placeholder — exposes spam queue using existing CHAT-09 logic.
 * Full moderation center UI deferred to a future milestone.
 */
class ChatSpamPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-no-symbol';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Spam & Chặn';
    protected static ?string $title = 'Quản Lý Spam & Chặn Khách';
    protected static ?string $slug = 'chat-spam';
    protected static ?int $navigationSort = 40;
    protected static string $view = 'filament.pages.chat-spam';

    public static function canAccess(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        // Only admins can access spam management (CHAT-09 policy preserved)
        return $user->hasAnyRole(['super_admin', 'Admin'])
            || $user->can('delete_chat_conversation');
    }
}
