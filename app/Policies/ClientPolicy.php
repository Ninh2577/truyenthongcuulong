<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function viewAny(User $user): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function view(User $user, Client $model): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function create(User $user): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function update(User $user, Client $model): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function delete(User $user, Client $model): bool { return $user->hasRole('Admin'); }
}
