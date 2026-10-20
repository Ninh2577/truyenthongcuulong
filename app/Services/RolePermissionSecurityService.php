<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class RolePermissionSecurityService
{
    /**
     * Danh sách các vai trò cốt lõi của hệ thống (bất biến, không thể xóa).
     */
    public const SYSTEM_ROLES = [
        'super_admin',
    ];

    public const CORE_ADMIN_ROLES = [
        'super_admin',
        'Admin',
        'panel_user',
    ];

    public const BUSINESS_ROLES = [
        'Biên Tập Viên',
        'CSKH',
        'Cộng Tác Viên',
    ];

    /**
     * Kiểm tra xem role có phải là role hệ thống bất biến (Super Admin) không.
     */
    public static function isSystemRole(Role|string $role): bool
    {
        $name = is_string($role) ? $role : $role->name;
        return in_array($name, self::SYSTEM_ROLES, true);
    }

    /**
     * Kiểm tra xem role có phải là role được bảo vệ (không thể xóa) không.
     */
    public static function isProtectedRole(Role|string $role): bool
    {
        $name = is_string($role) ? $role : $role->name;
        return in_array($name, self::CORE_ADMIN_ROLES, true);
    }

    /**
     * Trả về loại vai trò (system, business, custom).
     */
    public static function getRoleType(Role|string $role): string
    {
        $name = is_string($role) ? $role : $role->name;

        if (self::isSystemRole($name)) {
            return 'system';
        }

        if (in_array($name, self::CORE_ADMIN_ROLES, true)) {
            return 'core_admin';
        }

        if (in_array($name, self::BUSINESS_ROLES, true)) {
            return 'business';
        }

        return 'custom';
    }

    /**
     * Thông tin hiển thị Badge của vai trò.
     */
    public static function getRoleBadgeInfo(Role|string $role): array
    {
        $type = self::getRoleType($role);

        return match ($type) {
            'system' => [
                'label' => '🛡️ Vai trò hệ thống',
                'color' => 'danger',
                'icon' => 'heroicon-m-shield-check',
            ],
            'core_admin' => [
                'label' => '⚡ Quản trị cốt lõi',
                'color' => 'warning',
                'icon' => 'heroicon-m-key',
            ],
            'business' => [
                'label' => '💼 Vai trò nghiệp vụ',
                'color' => 'info',
                'icon' => 'heroicon-m-briefcase',
            ],
            default => [
                'label' => '⚙️ Vai trò tùy biến',
                'color' => 'gray',
                'icon' => 'heroicon-m-user-group',
            ],
        };
    }

    /**
     * Mô tả định nghĩa nghiệp vụ của vai trò.
     */
    public static function getRoleDescription(Role|string $role): string
    {
        $name = is_string($role) ? $role : $role->name;

        return match ($name) {
            'super_admin' => 'Toàn quyền tối cao, kiểm soát toàn bộ kiến trúc hệ thống và bảo mật.',
            'Admin' => 'Quản trị viên cấp cao, quản lý vận hành dữ liệu, phân quyền và nhân sự.',
            'Biên Tập Viên' => 'Quản lý toàn diện bài viết, chuyên mục, dự án tiêu biểu và ấn phẩm.',
            'CSKH' => 'Tiếp nhận, xử lý phản hồi yêu cầu tư vấn, hộp thư trực tuyến và khách hàng.',
            'Cộng Tác Viên' => 'Soạn thảo và đề xuất bài viết, không có quyền xuất bản trực tiếp.',
            'panel_user' => 'Quyền cơ sở để đăng nhập và sử dụng giao diện quản trị.',
            default => 'Vai trò phân quyền tùy biến phục vụ quy trình nghiệp vụ nội bộ.',
        };
    }

    /**
     * Kiểm tra điều kiện an toàn trước khi xóa vai trò.
     *
     * @return array{allowed: bool, reason: string|null}
     */
    public static function checkCanDeleteRole(?User $actor, Role $role): array
    {
        if (self::isProtectedRole($role)) {
            return [
                'allowed' => false,
                'reason' => "Không thể xóa vai trò hệ thống cốt lõi ('{$role->name}').",
            ];
        }

        $usersCount = $role->users()->count();
        if ($usersCount > 0) {
            return [
                'allowed' => false,
                'reason' => "Vai trò '{$role->name}' đang được sử dụng bởi {$usersCount} tài khoản. Hãy chuyển tài khoản sang vai trò khác trước khi xóa.",
            ];
        }

        if ($actor && ! $actor->hasRole('super_admin') && ! $actor->can('delete_role')) {
            return [
                'allowed' => false,
                'reason' => 'Bạn không có quyền thực hiện thao tác xóa vai trò.',
            ];
        }

        return [
            'allowed' => true,
            'reason' => null,
        ];
    }

    /**
     * Kiểm tra điều kiện an toàn trước khi xóa tài khoản người dùng.
     *
     * @return array{allowed: bool, reason: string|null}
     */
    public static function checkCanDeleteUser(?User $actor, User $target): array
    {
        if ($actor && $actor->id === $target->id) {
            return [
                'allowed' => false,
                'reason' => 'Bạn không thể tự xóa tài khoản của chính mình.',
            ];
        }

        if ($target->hasRole('super_admin')) {
            $superAdminCount = User::role('super_admin')->count();
            if ($superAdminCount <= 1) {
                return [
                    'allowed' => false,
                    'reason' => 'Không thể xóa tài khoản Super Admin cuối cùng của hệ thống.',
                ];
            }

            if ($actor && ! $actor->hasRole('super_admin')) {
                return [
                    'allowed' => false,
                    'reason' => 'Chỉ Super Admin mới có quyền xóa một tài khoản Super Admin khác.',
                ];
            }
        }

        return [
            'allowed' => true,
            'reason' => null,
        ];
    }

    /**
     * Kiểm tra điều kiện an toàn khi cập nhật vai trò của một tài khoản.
     * Đảm bảo không hạ quyền Super Admin cuối cùng và chống privilege escalation.
     *
     * @param array<int|string> $newRoleIdentifiers IDs hoặc Names của các vai trò mới
     * @return array{allowed: bool, reason: string|null}
     */
    public static function checkCanUpdateUserRoles(?User $actor, User $target, array $newRoleIdentifiers): array
    {
        $hasSuperAdminCurrently = $target->hasRole('super_admin');

        // Chuẩn hóa danh sách tên role mới
        $newRoleNames = collect($newRoleIdentifiers)->map(function ($identifier) {
            if (is_numeric($identifier)) {
                return Role::find($identifier)?->name;
            }
            return (string) $identifier;
        })->filter()->values()->all();

        $willHaveSuperAdmin = in_array('super_admin', $newRoleNames, true);

        // Chống Privilege Escalation: Non-SuperAdmin không thể gán role super_admin
        if ($willHaveSuperAdmin && ! $hasSuperAdminCurrently) {
            if ($actor && ! $actor->hasRole('super_admin')) {
                return [
                    'allowed' => false,
                    'reason' => 'Bạn không có thẩm quyền cấp quyền Super Admin cho tài khoản này.',
                ];
            }
        }

        // Bảo vệ Super Admin cuối cùng: Không thể gỡ super_admin nếu chỉ còn duy nhất 1
        if ($hasSuperAdminCurrently && ! $willHaveSuperAdmin) {
            $superAdminCount = User::role('super_admin')->count();
            if ($superAdminCount <= 1) {
                return [
                    'allowed' => false,
                    'reason' => 'Hệ thống phải luôn duy trì tối thiểu 1 Super Admin hoạt động. Không thể thu hồi quyền Super Admin của tài khoản này.',
                ];
            }

            if ($actor && ! $actor->hasRole('super_admin')) {
                return [
                    'allowed' => false,
                    'reason' => 'Chỉ Super Admin mới có thẩm quyền thu hồi quyền Super Admin.',
                ];
            }
        }

        return [
            'allowed' => true,
            'reason' => null,
        ];
    }
}
