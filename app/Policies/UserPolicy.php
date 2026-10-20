<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): ?bool
    {
        // Thao tác xóa nhạy cảm bắt buộc phải đi qua method delete/forceDelete để kiểm tra Super Admin cuối cùng
        if (in_array($ability, ['delete', 'forceDelete', 'deleteAny', 'forceDeleteAny'], true)) {
            return null;
        }

        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('Admin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin') || $user->can('view_any_user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function view(User $user, ?User $model = null): bool
    {
        return $user->hasRole('super_admin') || $user->can('view_user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole('super_admin') || $user->can('create_user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function update(User $user, ?User $model = null): bool
    {
        // Admin thường không thể sửa tài khoản của Super Admin
        if ($model && $model->hasRole('super_admin') && ! $user->hasRole('super_admin')) {
            return false;
        }

        return $user->hasRole('super_admin') || $user->can('update_user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user, ?User $model = null): bool
    {
        if ($model) {
            $check = \App\Services\RolePermissionSecurityService::checkCanDeleteUser($user, $model);
            if (! $check['allowed']) {
                return false;
            }
        }

        return $user->hasRole('super_admin') || $user->can('delete_user');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasRole('super_admin') || $user->can('delete_any_user');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDelete(User $user, ?User $model = null): bool
    {
        if ($model) {
            $check = \App\Services\RolePermissionSecurityService::checkCanDeleteUser($user, $model);
            if (! $check['allowed']) {
                return false;
            }
        }

        return $user->hasRole('super_admin') || $user->can('force_delete_user');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasRole('super_admin') || $user->can('force_delete_any_user');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        return $user->can('restore_user');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_user');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function replicate(User $user): bool
    {
        return $user->can('replicate_user');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_user');
    }
}
