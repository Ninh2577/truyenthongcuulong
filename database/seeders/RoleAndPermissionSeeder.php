<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\RolePermissionMatrixHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Hoàn toàn Idempotent, an toàn tuyệt đối, không xóa role hay detach user hiện hữu.
     */
    public function run(): void
    {
        // 1. Quên cache permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Danh sách tất cả các permission chuẩn hóa của hệ thống
        $allPermissions = [];

        // 2.1. Permissions cho từng Resource (CRUD)
        $resources = array_keys(RolePermissionMatrixHelper::getResourceRegistry());
        $actions = array_keys(RolePermissionMatrixHelper::getActionLabels());

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $allPermissions[] = "{$action}_{$resource}";
            }
        }

        // 2.2. Permissions cho Pages
        foreach (array_keys(RolePermissionMatrixHelper::getPageRegistry()) as $pagePerm) {
            $allPermissions[] = $pagePerm;
        }

        // 2.3. Permissions cho Widgets
        foreach (array_keys(RolePermissionMatrixHelper::getWidgetRegistry()) as $widgetPerm) {
            $allPermissions[] = $widgetPerm;
        }

        // Tạo hoặc lấy permission (firstOrCreate)
        $permissionModels = [];
        foreach ($allPermissions as $permName) {
            $permissionModels[$permName] = Permission::firstOrCreate([
                'name' => $permName,
                'guard_name' => 'web',
            ]);
        }

        // 3. Khởi tạo/Tìm các Role cốt lõi
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $editorRole = Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);
        $cskhRole = Role::firstOrCreate(['name' => 'CSKH', 'guard_name' => 'web']);
        $contributorRole = Role::firstOrCreate(['name' => 'Cộng Tác Viên', 'guard_name' => 'web']);
        $panelUserRole = Role::firstOrCreate(['name' => 'panel_user', 'guard_name' => 'web']);

        // 4. Đồng bộ quyền cho Super Admin (Toàn quyền tất cả)
        $superAdminRole->syncPermissions(Permission::all());

        // 5. Đồng bộ quyền cho Admin (Toàn quyền quản trị)
        $adminRole->syncPermissions(Permission::all());

        // 6. Đồng bộ quyền cho Biên Tập Viên
        $editorPermNames = collect($allPermissions)->filter(function ($name) {
            // Không cấp quyền quản trị user và role
            if (str_contains($name, '_user') || str_contains($name, '_role')) {
                return false;
            }
            // Không cấp cài đặt hệ thống lõi
            if (in_array($name, ['page_GeneralSettings', 'page_SchemaSettings', 'page_ChatAutomationSettings', 'page_ChatAISettings', 'page_ChatSpamPage'], true)) {
                return false;
            }
            // Không cấp cấu hình menu, chuyển hướng SEO 301, đối tác (dành riêng cho Admin)
            if (str_contains($name, '_menu') || str_contains($name, '_redirect') || str_contains($name, '_partner')) {
                return false;
            }
            return true;
        })->values()->all();
        $editorRole->syncPermissions($editorPermNames);

        // 7. Đồng bộ quyền cho CSKH
        $cskhPermNames = collect($allPermissions)->filter(function ($name) {
            $allowedKeywords = ['contact', 'client', 'job::application', 'Chat', 'NewContacts', 'Dashboard'];
            foreach ($allowedKeywords as $kw) {
                if (str_contains($name, $kw)) {
                    return true;
                }
            }
            return false;
        })->values()->all();
        $cskhRole->syncPermissions($cskhPermNames);

        // 8. Đồng bộ quyền cho Cộng Tác Viên
        $contributorPermNames = [
            'view_any_post',
            'view_post',
            'create_post',
            'update_post',
            'view_any_category',
            'view_category',
            'page_MediaLibrary',
            'widget_DashboardOverview',
        ];
        $contributorRole->syncPermissions($contributorPermNames);

        // 9. Đồng bộ quyền cơ sở cho panel_user
        $panelUserPermNames = [
            'widget_DashboardOverview',
        ];
        $panelUserRole->syncPermissions($panelUserPermNames);

        // 10. Đảm bảo tài khoản gốc luôn giữ Super Admin
        $rootAdmin = User::where('email', 'admin@truyenthongcuulong.com')->first() ?? User::find(5);
        if ($rootAdmin && ! $rootAdmin->hasRole('super_admin')) {
            $rootAdmin->assignRole($superAdminRole);
        }

        // Xóa lại cache để cập nhật ngay
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
