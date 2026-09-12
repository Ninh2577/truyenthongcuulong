<?php

namespace App\Policies;

use App\Models\Testimonial;
use App\Models\User;

class TestimonialPolicy
{
    public function viewAny(User $user): bool { return $user->hasPermissionTo('view_any_testimonials'); }
    public function view(User $user, Testimonial $model): bool { return $user->hasPermissionTo('view_testimonials'); }
    public function create(User $user): bool { return $user->hasPermissionTo('create_testimonials'); }
    public function update(User $user, Testimonial $model): bool { return $user->hasPermissionTo('update_testimonials'); }
    public function delete(User $user, Testimonial $model): bool { return $user->hasPermissionTo('delete_testimonials'); }
}
