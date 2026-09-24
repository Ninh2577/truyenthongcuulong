<?php

namespace App\Policies;

use App\Enums\ChatConversationStatus;
use App\Models\ChatConversation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatConversationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access the chat inbox / view any conversations.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên'])
            || $user->can('view_any_chat_conversation');
    }

    /**
     * Determine whether the user can view a specific conversation.
     * Spam conversations are restricted strictly to administrators and moderators.
     */
    public function view(User $user, ChatConversation $conversation): bool
    {
        $isSpam = ($conversation->status === ChatConversationStatus::Spam)
            || (is_string($conversation->status) && $conversation->status === 'spam');

        if ($isSpam) {
            return $user->hasAnyRole(['super_admin', 'Admin'])
                || $user->can('delete_chat_conversation');
        }

        return $user->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên'])
            || $user->can('view_chat_conversation');
    }

    /**
     * Determine whether the user can claim/assign a conversation.
     */
    public function claim(User $user, ChatConversation $conversation): bool
    {
        return $user->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên'])
            || $user->can('update_chat_conversation');
    }

    /**
     * Determine whether the user can send a message in a conversation.
     */
    public function reply(User $user, ChatConversation $conversation): bool
    {
        return $user->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên'])
            || $user->can('update_chat_conversation');
    }

    /**
     * Determine whether the user can close a conversation.
     */
    public function close(User $user, ChatConversation $conversation): bool
    {
        return $user->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên'])
            || $user->can('update_chat_conversation');
    }

    /**
     * Determine whether the user can reopen a closed conversation.
     */
    public function reopen(User $user, ChatConversation $conversation): bool
    {
        return $user->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên'])
            || $user->can('update_chat_conversation');
    }

    /**
     * Determine whether the user can mark a conversation as spam.
     * Spam is a moderation state and requires administrative privileges.
     */
    public function spam(User $user, ChatConversation|string|null $conversation = null): bool
    {
        return $user->hasAnyRole(['super_admin', 'Admin'])
            || $user->can('delete_chat_conversation');
    }

    /**
     * Determine whether the user can block or unblock a visitor.
     * Visitor blocking is an administrative moderation action.
     */
    public function blockVisitor(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'Admin'])
            || $user->can('delete_chat_conversation');
    }
}
