<?php

namespace App\Policies;

use App\Models\CaseStudy;
use App\Models\User;

class CaseStudyPolicy
{
    public function viewAny(User $user): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function view(User $user, CaseStudy $model): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function create(User $user): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function update(User $user, CaseStudy $model): bool { return $user->hasAnyRole(['Admin', 'Biên Tập Viên']); }
    public function delete(User $user, CaseStudy $model): bool { return $user->hasRole('Admin'); }
}
