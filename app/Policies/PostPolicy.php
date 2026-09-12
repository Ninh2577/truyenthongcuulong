<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', 'Biên Tập Viên', 'Cộng Tác Viên']);
    }

    public function view(User $user, Post $post): bool
    {
        return $user->hasAnyRole(['Admin', 'Biên Tập Viên', 'Cộng Tác Viên']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', 'Biên Tập Viên', 'Cộng Tác Viên']);
    }

    public function update(User $user, Post $post): bool
    {
        return $user->hasAnyRole(['Admin', 'Biên Tập Viên', 'Cộng Tác Viên']);
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->hasAnyRole(['Admin', 'Biên Tập Viên']);
    }

    public function publish(User $user, Post $post): bool
    {
        return $user->hasAnyRole(['Admin', 'Biên Tập Viên']);
    }
}
