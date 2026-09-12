<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Định nghĩa các resource
        $resources = [
            'posts',
            'case_studies',
            'partners',
            'clients',
            'pricing_plans',
            'team_members',
            'testimonials',
            'users'
        ];

        // Tạo permissions cơ bản (CRUD) cho từng resource
        $permissions = [];
        foreach ($resources as $resource) {
            $permissions[] = "view_any_{$resource}";
            $permissions[] = "view_{$resource}";
            $permissions[] = "create_{$resource}";
            $permissions[] = "update_{$resource}";
            $permissions[] = "delete_{$resource}";
        }

        // Tạo permission riêng cho Cộng Tác Viên (chỉ tạo draft) - mặc dù logic này có thể nằm ở Policy
        $permissions[] = 'publish_posts';

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Tạo Role: Admin (Toàn quyền)
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::all());

        // Tạo Role: Biên Tập Viên
        $editorRole = Role::firstOrCreate(['name' => 'Biên Tập Viên']);
        $editorPermissions = Permission::whereIn('name', [
            // Không cấp quyền cho users
            'view_any_posts', 'view_posts', 'create_posts', 'update_posts', 'delete_posts', 'publish_posts',
            'view_any_case_studies', 'view_case_studies', 'create_case_studies', 'update_case_studies', 'delete_case_studies',
            'view_any_partners', 'view_partners', 'create_partners', 'update_partners', 'delete_partners',
            'view_any_clients', 'view_clients', 'create_clients', 'update_clients', 'delete_clients',
            'view_any_pricing_plans', 'view_pricing_plans', 'create_pricing_plans', 'update_pricing_plans', 'delete_pricing_plans',
            'view_any_team_members', 'view_team_members', 'create_team_members', 'update_team_members', 'delete_team_members',
            'view_any_testimonials', 'view_testimonials', 'create_testimonials', 'update_testimonials', 'delete_testimonials',
        ])->get();
        $editorRole->syncPermissions($editorPermissions);

        // Tạo Role: Cộng Tác Viên
        $contributorRole = Role::firstOrCreate(['name' => 'Cộng Tác Viên']);
        $contributorPermissions = Permission::whereIn('name', [
            'view_any_posts', 'view_posts', 'create_posts', 'update_posts',
            // Không có delete_posts và không có publish_posts
        ])->get();
        $contributorRole->syncPermissions($contributorPermissions);

        // Gán Role Admin cho User đầu tiên (thường là Admin gốc)
        $adminUser = User::first();
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}
