<?php

namespace App\Policies;

use App\Models\Partner;
use App\Models\User;

class PartnerPolicy
{
    public function viewAny(User $user): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function view(User $user, Partner $model): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function create(User $user): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function update(User $user, Partner $model): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function delete(User $user, Partner $model): bool { return $user->hasRole('Admin'); }
}
