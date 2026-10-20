<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\RolePermissionMatrixHelper;
use App\Services\RolePermissionSecurityService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolePermissionSecurityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test 1: Vai trò Super Admin không thể bị xóa ở bất kỳ tầng nào.
     */
    public function test_super_admin_role_cannot_be_deleted(): void
    {
        $superAdminUser = User::role('super_admin')->first();
        $superAdminRole = Role::where('name', 'super_admin')->first();

        $this->assertNotNull($superAdminRole);

        // 1. Kiểm tra qua Service
        $check = RolePermissionSecurityService::checkCanDeleteRole($superAdminUser, $superAdminRole);
        $this->assertFalse($check['allowed']);
        $this->assertStringContainsString('hệ thống', $check['reason']);

        // 2. Kiểm tra qua Policy
        $policyResult = Gate::forUser($superAdminUser)->allows('delete', $superAdminRole);
        $this->assertFalse($policyResult);
    }

    /**
     * Test 2: Vai trò Admin cốt lõi không thể bị xóa.
     */
    public function test_admin_core_role_cannot_be_deleted(): void
    {
        $superAdminUser = User::role('super_admin')->first();
        $adminRole = Role::where('name', 'Admin')->first();

        $this->assertNotNull($adminRole);

        $check = RolePermissionSecurityService::checkCanDeleteRole($superAdminUser, $adminRole);
        $this->assertFalse($check['allowed']);

        $policyResult = Gate::forUser($superAdminUser)->allows('delete', $adminRole);
        $this->assertFalse($policyResult);
    }

    /**
     * Test 3: Vai trò đang có thành viên sử dụng không thể bị xóa.
     */
    public function test_role_with_active_users_cannot_be_deleted(): void
    {
        $superAdminUser = User::role('super_admin')->first();
        $editorRole = Role::where('name', 'Biên Tập Viên')->first();

        $this->assertNotNull($editorRole);
        $this->assertGreaterThan(0, $editorRole->users()->count());

        $check = RolePermissionSecurityService::checkCanDeleteRole($superAdminUser, $editorRole);
        $this->assertFalse($check['allowed']);
        $this->assertStringContainsString('đang được sử dụng', $check['reason']);

        $policyResult = Gate::forUser($superAdminUser)->allows('delete', $editorRole);
        $this->assertFalse($policyResult);
    }

    /**
     * Test 4: Vai trò tùy biến không có người dùng có thể xóa an toàn.
     */
    public function test_custom_role_with_zero_users_can_be_deleted(): void
    {
        $superAdminUser = User::role('super_admin')->first();
        
        // Tạo role tùy biến tạm thời
        $tempRole = Role::create([
            'name' => 'Test Temporary Role ' . uniqid(),
            'guard_name' => 'web',
        ]);

        $check = RolePermissionSecurityService::checkCanDeleteRole($superAdminUser, $tempRole);
        $this->assertTrue($check['allowed']);

        $policyResult = Gate::forUser($superAdminUser)->allows('delete', $tempRole);
        $this->assertTrue($policyResult);

        // Xóa an toàn
        $tempRole->delete();
        $this->assertDatabaseMissing('roles', ['id' => $tempRole->id]);
    }

    /**
     * Test 5: Không thể xóa tài khoản Super Admin cuối cùng của hệ thống.
     */
    public function test_last_super_admin_user_cannot_be_deleted(): void
    {
        $superAdminUser = User::role('super_admin')->first();
        $this->assertNotNull($superAdminUser);

        // Kiểm tra xem hiện có đúng 1 super_admin hay không
        $superAdminCount = User::role('super_admin')->count();
        $this->assertEquals(1, $superAdminCount);

        // 1. Kiểm tra qua Service
        $check = RolePermissionSecurityService::checkCanDeleteUser($superAdminUser, $superAdminUser);
        $this->assertFalse($check['allowed']);

        // 2. Policy: không cho phép tự xóa hoặc xóa super_admin cuối
        $policyResult = Gate::forUser($superAdminUser)->allows('delete', $superAdminUser);
        $this->assertFalse($policyResult);
    }

    /**
     * Test 6: Chống Privilege Escalation - Admin không được cấp quyền Super Admin cho người khác.
     */
    public function test_non_super_admin_cannot_assign_super_admin_role(): void
    {
        $adminUser = User::role('Admin')->whereDoesntHave('roles', fn ($q) => $q->where('name', 'super_admin'))->first();
        if (! $adminUser) {
            $adminUser = User::create([
                'name' => 'Test Admin Privilege',
                'email' => 'test_admin_priv_' . uniqid() . '@test.com',
                'password' => bcrypt('password123456'),
            ]);
            $adminUser->assignRole('Admin');
        }

        $targetUser = User::create([
            'name' => 'Target User',
            'email' => 'target_' . uniqid() . '@test.com',
            'password' => bcrypt('password123456'),
        ]);

        // Admin cố gán super_admin cho targetUser
        $check = RolePermissionSecurityService::checkCanUpdateUserRoles($adminUser, $targetUser, ['super_admin']);
        $this->assertFalse($check['allowed']);
        $this->assertStringContainsString('thẩm quyền', $check['reason']);

        // Clean up
        $targetUser->delete();
    }

    /**
     * Test 7: Chống hạ quyền Super Admin cuối cùng (Bảo toàn ít nhất 1 Super Admin).
     */
    public function test_cannot_demote_last_super_admin(): void
    {
        $superAdminUser = User::role('super_admin')->first();
        $this->assertNotNull($superAdminUser);

        // Thử thu hồi role super_admin khỏi tài khoản này
        $check = RolePermissionSecurityService::checkCanUpdateUserRoles($superAdminUser, $superAdminUser, ['Admin']);
        $this->assertFalse($check['allowed']);
        $this->assertStringContainsString('tối thiểu 1 Super Admin', $check['reason']);
    }

    /**
     * Test 8: Độ chính xác của việc tính toán số lượng quyền và phân quyền hiệu lực.
     */
    public function test_permissions_count_and_assignment_correctness(): void
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $this->assertNotNull($superAdminRole);
        $this->assertEquals(105, $superAdminRole->permissions()->count());

        $adminRole = Role::where('name', 'Admin')->first();
        $this->assertNotNull($adminRole);
        $this->assertEquals(105, $adminRole->permissions()->count());

        $editorRole = Role::where('name', 'Biên Tập Viên')->first();
        $this->assertNotNull($editorRole);
        $this->assertEquals(91, $editorRole->permissions()->count());
    }

    /**
     * Test 9: Việt hóa nhãn quyền chính xác trên Presentation Layer.
     */
    public function test_vietnamese_permission_labels_translation(): void
    {
        $label1 = RolePermissionMatrixHelper::translatePermission('view_any_post');
        $this->assertEquals('Xem danh sách - Bài Viết', $label1);

        $label2 = RolePermissionMatrixHelper::translatePermission('create_case::study');
        $this->assertEquals('Thêm mới - Dự Án Tiêu Biểu', $label2);

        $label3 = RolePermissionMatrixHelper::translatePermission('delete_any_user');
        $this->assertEquals('Xóa nhiều (Hàng loạt) - Tài Khoản Quản Trị', $label3);

        $label4 = RolePermissionMatrixHelper::translatePermission('page_ChatInbox');
        $this->assertEquals('Truy cập Hộp Thư Trực Tuyến', $label4);
    }

    /**
     * Test 10: Nhận diện quyền quản trị nhạy cảm.
     */
    public function test_sensitive_permissions_identification(): void
    {
        $this->assertTrue(RolePermissionMatrixHelper::isSensitivePermission('delete_any_post'));
        $this->assertTrue(RolePermissionMatrixHelper::isSensitivePermission('create_role'));
        $this->assertTrue(RolePermissionMatrixHelper::isSensitivePermission('update_user'));
        $this->assertTrue(RolePermissionMatrixHelper::isSensitivePermission('page_GeneralSettings'));

        // Quyền đọc bài viết thông thường không phải nhạy cảm
        $this->assertFalse(RolePermissionMatrixHelper::isSensitivePermission('view_post'));
        $this->assertFalse(RolePermissionMatrixHelper::isSensitivePermission('view_any_post'));
    }
}
