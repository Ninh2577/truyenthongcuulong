<?php

namespace App\Policies;

use App\Models\TeamMember;
use App\Models\User;

class TeamMemberPolicy
{
    public function viewAny(User $user): bool { return $user->hasPermissionTo('view_any_team_members'); }
    public function view(User $user, TeamMember $model): bool { return $user->hasPermissionTo('view_team_members'); }
    public function create(User $user): bool { return $user->hasPermissionTo('create_team_members'); }
    public function update(User $user, TeamMember $model): bool { return $user->hasPermissionTo('update_team_members'); }
    public function delete(User $user, TeamMember $model): bool { return $user->hasPermissionTo('delete_team_members'); }
}
