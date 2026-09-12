<?php

namespace App\Policies;

use App\Models\PricingPlan;
use App\Models\User;

class PricingPlanPolicy
{
    public function viewAny(User $user): bool { return $user->hasPermissionTo('view_any_pricing_plans'); }
    public function view(User $user, PricingPlan $model): bool { return $user->hasPermissionTo('view_pricing_plans'); }
    public function create(User $user): bool { return $user->hasPermissionTo('create_pricing_plans'); }
    public function update(User $user, PricingPlan $model): bool { return $user->hasPermissionTo('update_pricing_plans'); }
    public function delete(User $user, PricingPlan $model): bool { return $user->hasPermissionTo('delete_pricing_plans'); }
}
