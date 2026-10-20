<?php

namespace App\Services;

use App\Models\RolePermissionAuditLog;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Role;
use Throwable;

class RolePermissionAuditService
{
    /**
     * Ghi nhận một bản ghi Audit Log.
     */
    public static function logAction(array $params): ?RolePermissionAuditLog
    {
        try {
            $actor = $params['actor'] ?? auth()->user();
            $actorId = $actor instanceof User ? $actor->id : ($params['actor_user_id'] ?? null);
            $actorName = $actor instanceof User ? $actor->name : ($params['actor_name'] ?? 'System/Console');
            $actorEmail = $actor instanceof User ? $actor->email : ($params['actor_email'] ?? null);

            $beforeState = self::sanitizeState($params['before_state'] ?? null);
            $afterState = self::sanitizeState($params['after_state'] ?? null);
            $changedFields = self::sanitizeState($params['changed_fields'] ?? null);

            $action = $params['action'] ?? RolePermissionAuditLog::ACTION_UPDATE_ROLE;
            $sensitivity = $params['sensitivity_level'] ?? self::determineSensitivity($action, $params['target_name'] ?? '', $changedFields);

            return RolePermissionAuditLog::create([
                'actor_user_id' => $actorId,
                'actor_name' => $actorName,
                'actor_email' => $actorEmail,
                'action' => $action,
                'target_type' => $params['target_type'] ?? 'role',
                'target_id' => (string) ($params['target_id'] ?? ''),
                'target_name' => $params['target_name'] ?? '',
                'before_state' => $beforeState,
                'after_state' => $afterState,
                'changed_fields' => $changedFields,
                'ip_address' => Request::ip() ?? '127.0.0.1',
                'user_agent' => Request::userAgent() ?? 'CLI/System',
                'success' => $params['success'] ?? true,
                'reason' => $params['reason'] ?? null,
                'sensitivity_level' => $sensitivity,
            ]);
        } catch (Throwable $e) {
            // Audit log failure must not crash critical business operations, but should log to system error log
            \Illuminate\Support\Facades\Log::error('RolePermissionAuditService failed to write log: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return null;
        }
    }

    /**
     * Ghi nhận khi tạo mới vai trò.
     */
    public static function logRoleCreated($arg1, $arg2 = null, $arg3 = null): ?RolePermissionAuditLog
    {
        if ($arg1 instanceof Role) {
            $role = $arg1;
            $permissions = is_array($arg2) ? $arg2 : [];
            $actor = $arg3 instanceof User ? $arg3 : auth()->user();
        } else {
            $actor = $arg1 instanceof User ? $arg1 : auth()->user();
            $role = $arg2;
            $permissions = is_array($arg3) ? $arg3 : [];
        }

        $sensitivity = RolePermissionAuditLog::SENSITIVITY_NORMAL;
        if ($role->name === 'super_admin' || $role->name === 'Admin') {
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_CRITICAL;
        }

        return self::logAction([
            'actor' => $actor,
            'action' => RolePermissionAuditLog::ACTION_CREATE_ROLE,
            'target_type' => 'role',
            'target_id' => (string) $role->id,
            'target_name' => $role->name,
            'before_state' => null,
            'after_state' => [
                'name' => $role->name,
                'guard_name' => $role->guard_name,
                'permissions' => array_values($permissions),
                'permissions_count' => count($permissions),
            ],
            'changed_fields' => [
                'created' => true,
                'permissions_assigned' => array_values($permissions),
            ],
            'sensitivity_level' => $sensitivity,
        ]);
    }

    /**
     * Ghi nhận khi cập nhật vai trò và ma trận quyền hạn.
     */
    public static function logRoleUpdated(
        $first,
        $second,
        $third = [],
        $fourth = [],
        $fifth = [],
        $sixth = []
    ): ?RolePermissionAuditLog {
        if ($first instanceof Role) {
            $role = $first;
            $beforePermissions = is_array($second) ? $second : [];
            $afterPermissions = is_array($third) ? $third : [];
            $actor = $fourth instanceof User ? $fourth : auth()->user();
            $beforeData = is_array($fifth) ? $fifth : [];
            $afterData = is_array($sixth) ? $sixth : [];
        } else {
            $actor = $first instanceof User ? $first : auth()->user();
            $role = $second;
            $beforePermissions = is_array($third) ? $third : [];
            $afterPermissions = is_array($fourth) ? $fourth : [];
            $beforeData = is_array($fifth) ? $fifth : [];
            $afterData = is_array($sixth) ? $sixth : [];
        }

        $beforeSet = collect($beforePermissions)->values()->all();
        $afterSet = collect($afterPermissions)->values()->all();

        $addedPermissions = array_values(array_diff($afterSet, $beforeSet));
        $removedPermissions = array_values(array_diff($beforeSet, $afterSet));

        $hasCriticalPermission = false;
        $hasSensitivePermission = false;

        $allTouched = array_merge($addedPermissions, $removedPermissions);
        foreach ($allTouched as $perm) {
            $level = RolePermissionMatrixHelper::getPermissionSensitivity($perm);
            if ($level === RolePermissionMatrixHelper::LEVEL_CRITICAL) {
                $hasCriticalPermission = true;
            } elseif ($level === RolePermissionMatrixHelper::LEVEL_SENSITIVE) {
                $hasSensitivePermission = true;
            }
        }

        if (count($allTouched) > 10) {
            $action = RolePermissionAuditLog::ACTION_BULK_PERMISSION_CHANGE;
            $sensitivity = $hasCriticalPermission ? RolePermissionAuditLog::SENSITIVITY_CRITICAL : RolePermissionAuditLog::SENSITIVITY_SENSITIVE;
        } elseif ($hasCriticalPermission) {
            $action = RolePermissionAuditLog::ACTION_SENSITIVE_PERMISSION_CHANGE;
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_CRITICAL;
        } elseif ($role->name === 'super_admin' || $role->name === 'Admin') {
            $action = RolePermissionAuditLog::ACTION_UPDATE_ROLE;
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_CRITICAL;
        } elseif ($hasSensitivePermission) {
            $action = RolePermissionAuditLog::ACTION_UPDATE_ROLE;
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_SENSITIVE;
        } else {
            $action = RolePermissionAuditLog::ACTION_UPDATE_ROLE;
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_NORMAL;
        }

        $changedFields = [
            'permissions_added' => $addedPermissions,
            'permissions_removed' => $removedPermissions,
            'permissions_count_before' => count($beforeSet),
            'permissions_count_after' => count($afterSet),
            'net_change' => count($addedPermissions) - count($removedPermissions),
        ];

        if (! empty($beforeData) || ! empty($afterData)) {
            $changedFields['attributes_changed'] = array_keys(array_diff_assoc($afterData, $beforeData));
        }

        return self::logAction([
            'actor' => $actor,
            'action' => $action,
            'target_type' => 'role',
            'target_id' => (string) $role->id,
            'target_name' => $role->name,
            'before_state' => array_merge($beforeData, [
                'permissions' => $beforeSet,
                'permissions_count' => count($beforeSet),
            ]),
            'after_state' => array_merge($afterData, [
                'permissions' => $afterSet,
                'permissions_count' => count($afterSet),
            ]),
            'changed_fields' => $changedFields,
            'sensitivity_level' => $sensitivity,
        ]);
    }

    /**
     * Ghi nhận khi sao chép vai trò.
     */
    public static function logRoleCloned($first, $second, $third = null, $fourth = null): ?RolePermissionAuditLog
    {
        if ($first instanceof Role) {
            $sourceRole = $first;
            $newRole = $second;
            $clonedPermissions = is_array($third) ? $third : [];
            $actor = $fourth instanceof User ? $fourth : auth()->user();
        } else {
            $actor = $first instanceof User ? $first : auth()->user();
            $sourceRole = $second;
            $newRole = $third;
            $clonedPermissions = is_array($fourth) ? $fourth : [];
        }

        return self::logAction([
            'actor' => $actor,
            'action' => RolePermissionAuditLog::ACTION_CLONE_ROLE,
            'target_type' => 'role',
            'target_id' => (string) $newRole->id,
            'target_name' => $newRole->name,
            'before_state' => [
                'source_role_id' => $sourceRole->id,
                'source_role_name' => $sourceRole->name,
                'source_permissions_count' => $sourceRole->permissions()->count(),
            ],
            'after_state' => [
                'new_role_id' => $newRole->id,
                'new_role_name' => $newRole->name,
                'permissions' => array_values($clonedPermissions),
                'permissions_count' => count($clonedPermissions),
            ],
            'changed_fields' => [
                'cloned_from' => $sourceRole->name,
                'permissions_count' => count($clonedPermissions),
            ],
            'sensitivity_level' => RolePermissionAuditLog::SENSITIVITY_NORMAL,
        ]);
    }

    /**
     * Ghi nhận khi xóa vai trò.
     */
    public static function logRoleDeleted($first, $second = null, array $beforeState = []): ?RolePermissionAuditLog
    {
        if ($first instanceof Role) {
            $role = $first;
            $actor = $second instanceof User ? $second : auth()->user();
        } else {
            $actor = $first instanceof User ? $first : auth()->user();
            $role = $second;
        }

        return self::logAction([
            'actor' => $actor,
            'action' => RolePermissionAuditLog::ACTION_DELETE_ROLE,
            'target_type' => 'role',
            'target_id' => (string) $role->id,
            'target_name' => $role->name,
            'before_state' => ! empty($beforeState) ? $beforeState : [
                'id' => $role->id,
                'name' => $role->name,
                'permissions_count' => $role->permissions()->count(),
            ],
            'after_state' => null,
            'changed_fields' => [
                'deleted' => true,
            ],
            'sensitivity_level' => RolePermissionAuditLog::SENSITIVITY_SENSITIVE,
        ]);
    }

    /**
     * Ghi nhận khi gán hoặc thay đổi vai trò của người dùng.
     */
    public static function logUserRolesChanged($first, $second, $third = [], $fourth = null): ?RolePermissionAuditLog
    {
        if ($first instanceof User && is_array($second)) {
            // ($targetUser, $beforeRoles, $afterRoles, $actor)
            $targetUser = $first;
            $beforeRoles = $second;
            $afterRoles = is_array($third) ? $third : [];
            $actor = $fourth instanceof User ? $fourth : auth()->user();
        } else {
            // ($actor, $targetUser, $beforeRoles, $afterRoles)
            $actor = $first instanceof User ? $first : auth()->user();
            $targetUser = $second;
            $beforeRoles = is_array($third) ? $third : [];
            $afterRoles = is_array($fourth) ? $fourth : [];
        }
        $added = array_values(array_diff($afterRoles, $beforeRoles));
        $removed = array_values(array_diff($beforeRoles, $afterRoles));

        if (empty($added) && empty($removed)) {
            return null;
        }

        $isSuperAdminTouched = in_array('super_admin', $added, true) || in_array('super_admin', $removed, true);
        $isAdminTouched = in_array('Admin', $added, true) || in_array('Admin', $removed, true);

        if ($isSuperAdminTouched) {
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_CRITICAL;
            $action = RolePermissionAuditLog::ACTION_SUPER_ADMIN_CHANGE;
        } elseif ($isAdminTouched) {
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_CRITICAL;
            $action = ! empty($added) ? RolePermissionAuditLog::ACTION_ASSIGN_ROLE_TO_USER : RolePermissionAuditLog::ACTION_REMOVE_ROLE_FROM_USER;
        } else {
            $sensitivity = RolePermissionAuditLog::SENSITIVITY_NORMAL;
            $action = ! empty($added) ? RolePermissionAuditLog::ACTION_ASSIGN_ROLE_TO_USER : RolePermissionAuditLog::ACTION_REMOVE_ROLE_FROM_USER;
        }

        return self::logAction([
            'actor' => $actor,
            'action' => $action,
            'target_type' => 'user',
            'target_id' => (string) $targetUser->id,
            'target_name' => "{$targetUser->name} ({$targetUser->email})",
            'before_state' => [
                'user_id' => $targetUser->id,
                'roles' => $beforeRoles,
            ],
            'after_state' => [
                'user_id' => $targetUser->id,
                'roles' => $afterRoles,
            ],
            'changed_fields' => [
                'roles_added' => $added,
                'roles_removed' => $removed,
            ],
            'sensitivity_level' => $sensitivity,
        ]);
    }

    /**
     * Tự động xác định mức độ nhạy cảm của hành động.
     */
    protected static function determineSensitivity(string $action, string $targetName, ?array $changedFields): string
    {
        if (
            $action === RolePermissionAuditLog::ACTION_SUPER_ADMIN_CHANGE ||
            $targetName === 'super_admin' ||
            str_contains(strtolower($targetName), 'super_admin')
        ) {
            return RolePermissionAuditLog::SENSITIVITY_CRITICAL;
        }

        if (
            $action === RolePermissionAuditLog::ACTION_DELETE_ROLE ||
            $action === RolePermissionAuditLog::ACTION_SENSITIVE_PERMISSION_CHANGE ||
            $targetName === 'Admin'
        ) {
            return RolePermissionAuditLog::SENSITIVITY_SENSITIVE;
        }

        return RolePermissionAuditLog::SENSITIVITY_NORMAL;
    }

    /**
     * Làm sạch dữ liệu, loại bỏ tuyệt đối mật khẩu và token bí mật.
     */
    protected static function sanitizeState(?array $state): ?array
    {
        if ($state === null) {
            return null;
        }

        $forbiddenKeys = [
            'password',
            'password_confirmation',
            'current_password',
            'remember_token',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'token',
            'api_token',
            'secret',
        ];

        return Arr::except($state, $forbiddenKeys);
    }
}
