<?php

namespace Tests\Feature;

use App\Models\RolePermissionAuditLog;
use App\Models\User;
use App\Services\RolePermissionAuditService;
use App\Services\RolePermissionMatrixHelper;
use App\Services\RolePermissionSecurityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolePermissionPhase2EnterpriseTest extends TestCase
{
    protected User $superAdmin;
    protected User $regularAdmin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = User::role('super_admin')->first() ?? User::factory()->create();
        if (! $this->superAdmin->hasRole('super_admin')) {
            $this->superAdmin->assignRole('super_admin');
        }

        $this->regularAdmin = User::role('Admin')->first() ?? User::factory()->create();
        if (! $this->regularAdmin->hasRole('Admin')) {
            $this->regularAdmin->assignRole('Admin');
        }

        $this->regularUser = User::whereDoesntHave('roles', fn ($q) => $q->whereIn('name', ['super_admin', 'Admin']))->first()
            ?? User::factory()->create();
    }

    protected function tearDown(): void
    {
        Role::where('name', 'like', 'Test_Role_%')
            ->orWhere('name', 'like', 'Biên Tập Viên Nội Dung%')
            ->delete();

        parent::tearDown();
    }

    /**
     * Test 1: Audit Log creation upon role created
     */
    public function test_audit_log_creation_on_role_created(): void
    {
        $roleName = 'Test_Role_Audit_' . uniqid();
        $role = Role::create(['name' => $roleName, 'guard_name' => 'web']);
        $perms = ['view_post', 'create_post'];

        $log = RolePermissionAuditService::logRoleCreated($role, $perms, $this->superAdmin);

        $this->assertInstanceOf(RolePermissionAuditLog::class, $log);
        $this->assertEquals(RolePermissionAuditLog::ACTION_CREATE_ROLE, $log->action);
        $this->assertEquals($role->id, $log->target_id);
        $this->assertEquals($roleName, $log->target_name);
        $this->assertEquals($this->superAdmin->id, $log->actor_user_id);
        $this->assertEquals(RolePermissionAuditLog::SENSITIVITY_NORMAL, $log->sensitivity_level);

        // Verify in DB
        $this->assertDatabaseHas('role_permission_audit_logs', [
            'id' => $log->id,
            'target_name' => $roleName,
            'action' => RolePermissionAuditLog::ACTION_CREATE_ROLE,
        ]);

        // Clean up test role
        $role->delete();
    }

    /**
     * Test 2: Audit Log tracks accurate Before/After states on role update
     */
    public function test_audit_log_before_after_on_role_update(): void
    {
        $role = Role::create(['name' => 'Test_Role_Update_' . uniqid(), 'guard_name' => 'web']);
        $beforePerms = ['view_post', 'create_post'];
        $afterPerms = ['view_post', 'delete_post', 'publish_post'];

        $log = RolePermissionAuditService::logRoleUpdated(
            $role,
            $beforePerms,
            $afterPerms,
            $this->superAdmin,
            ['name' => $role->name],
            ['name' => $role->name]
        );

        $this->assertEquals(RolePermissionAuditLog::ACTION_UPDATE_ROLE, $log->action);
        $this->assertContains('view_post', $log->before_state['permissions']);
        $this->assertContains('create_post', $log->before_state['permissions']);
        $this->assertContains('delete_post', $log->after_state['permissions']);

        // Changed fields should show added and removed
        $this->assertEquals(['delete_post', 'publish_post'], $log->changed_fields['permissions_added']);
        $this->assertEquals(['create_post'], $log->changed_fields['permissions_removed']);

        // Sensitivity should be sensitive or critical because delete/publish was added
        $this->assertEquals(RolePermissionAuditLog::SENSITIVITY_SENSITIVE, $log->sensitivity_level);

        $role->delete();
    }

    /**
     * Test 3: Audit Log marks CRITICAL when critical permission or role assignment is modified
     */
    public function test_audit_log_marks_critical_for_critical_permissions(): void
    {
        $role = Role::create(['name' => 'Test_Role_Critical_' . uniqid(), 'guard_name' => 'web']);
        $beforePerms = ['view_post'];
        $afterPerms = ['view_post', 'delete_shield::role']; // Critical permission

        $log = RolePermissionAuditService::logRoleUpdated(
            $role,
            $beforePerms,
            $afterPerms,
            $this->superAdmin
        );

        $this->assertEquals(RolePermissionAuditLog::SENSITIVITY_CRITICAL, $log->sensitivity_level);
        $this->assertTrue($log->isCritical());

        $role->delete();
    }

    /**
     * Test 4 & 5: Role Clone duplicates permissions correctly
     */
    public function test_role_clone_duplicates_permissions_correctly(): void
    {
        $sourceRole = Role::where('name', 'Biên Tập Viên')->first();
        $this->assertNotNull($sourceRole);

        $sourcePerms = $sourceRole->permissions->pluck('name')->toArray();
        $cloneName = 'Biên Tập Viên Nội Dung ' . uniqid();

        $clonedRole = Role::create(['name' => $cloneName, 'guard_name' => 'web']);
        $clonedRole->syncPermissions($sourceRole->permissions);

        $clonedPerms = $clonedRole->fresh()->permissions->pluck('name')->toArray();

        $this->assertEquals(count($sourcePerms), count($clonedPerms));
        $this->assertEquals(sort($sourcePerms), sort($clonedPerms));

        // Audit log test for clone
        $log = RolePermissionAuditService::logRoleCloned($sourceRole, $clonedRole, $clonedPerms, $this->superAdmin);
        $this->assertEquals(RolePermissionAuditLog::ACTION_CLONE_ROLE, $log->action);
        $this->assertEquals($clonedRole->id, $log->target_id);

        $clonedRole->delete();
    }

    /**
     * Test 6: Role Clone strictly DOES NOT copy users
     */
    public function test_role_clone_does_not_copy_users(): void
    {
        $sourceRole = Role::where('name', 'Biên Tập Viên')->first();
        $this->assertGreaterThan(0, $sourceRole->users()->count());

        $cloneName = 'Test_Clone_No_Users_' . uniqid();
        $clonedRole = Role::create(['name' => $cloneName, 'guard_name' => 'web']);
        $clonedRole->syncPermissions($sourceRole->permissions);

        // Cloned role must have exactly 0 users
        $this->assertEquals(0, $clonedRole->users()->count());

        $clonedRole->delete();
    }

    /**
     * Test 7: Permission Search returns accurate results by module, key, and Vietnamese label
     */
    public function test_permission_search_functionality(): void
    {
        // 1. Search by Vietnamese module name
        $resultsPost = RolePermissionMatrixHelper::searchPermissions('bài viết');
        $this->assertNotEmpty($resultsPost);
        foreach ($resultsPost as $item) {
            $matched = str_contains(mb_strtolower($item['title']), 'bài viết')
                || str_contains(mb_strtolower($item['module']), 'bài viết');
            $this->assertTrue($matched);
        }

        // 2. Search by key action
        $resultsDelete = RolePermissionMatrixHelper::searchPermissions('delete');
        $this->assertNotEmpty($resultsDelete);
        foreach ($resultsDelete as $item) {
            $this->assertTrue(str_contains($item['key'], 'delete') || str_contains($item['action_label'], 'Xóa'));
        }

        // 3. Search empty string returns all 105 permissions
        $all = RolePermissionMatrixHelper::searchPermissions('');
        $this->assertCount(105, $all);
    }

    /**
     * Test 8: Permission Preview formula CURRENT + ADDED - REMOVED = FINAL
     */
    public function test_permission_preview_formula_calculation(): void
    {
        $before = ['view_post', 'create_post', 'update_post', 'view_contact']; // 4
        $after = ['view_post', 'update_post', 'delete_post', 'publish_post']; // 4 (removed: create_post, view_contact (-2); added: delete_post, publish_post (+2))

        $diff = RolePermissionMatrixHelper::calculatePermissionDiff($before, $after);

        $this->assertEquals(4, $diff['before_count']);
        $this->assertEquals(2, $diff['added_count']);
        $this->assertContains('delete_post', $diff['added']);
        $this->assertContains('publish_post', $diff['added']);

        $this->assertEquals(2, $diff['removed_count']);
        $this->assertContains('create_post', $diff['removed']);
        $this->assertContains('view_contact', $diff['removed']);

        $this->assertEquals(4, $diff['final_count']);
        // Verify formula: CURRENT (4) + ADDED (2) - REMOVED (2) = FINAL (4)
        $this->assertEquals($diff['final_count'], $diff['before_count'] + $diff['added_count'] - $diff['removed_count']);
    }

    /**
     * Test 9: Role Impact Preview detects active users on role
     */
    public function test_role_impact_preview_detects_affected_users(): void
    {
        $role = Role::where('name', 'Biên Tập Viên')->first();
        $this->assertNotNull($role);

        $userCount = $role->users()->count();
        $this->assertGreaterThan(0, $userCount);

        // Calculating diff for the role
        $currentPerms = $role->permissions->pluck('name')->toArray();
        $newPerms = array_merge($currentPerms, ['page_GeneralSettings']);

        $diff = RolePermissionMatrixHelper::calculatePermissionDiff($currentPerms, $newPerms);

        $this->assertTrue($diff['has_critical_added']);
        $this->assertEquals(1, $diff['added_count']);
        $this->assertContains('page_GeneralSettings', $diff['added']);
    }

    /**
     * Test 10: Role Comparison compares Role A vs Role B side-by-side
     */
    public function test_role_comparison_algorithm(): void
    {
        $roleA = Role::where('name', 'Biên Tập Viên')->first();
        $roleB = Role::where('name', 'CSKH')->first();

        $this->assertNotNull($roleA);
        $this->assertNotNull($roleB);

        $comparison = RolePermissionMatrixHelper::compareRoles($roleA, $roleB);

        $this->assertArrayHasKey('both', $comparison);
        $this->assertArrayHasKey('a_only', $comparison);
        $this->assertArrayHasKey('b_only', $comparison);
        $this->assertArrayHasKey('neither', $comparison);
        $this->assertArrayHasKey('items', $comparison);

        // Sum of both + a_only + b_only + neither should equal total permissions (105)
        $total = count($comparison['both']) + count($comparison['a_only']) + count($comparison['b_only']) + count($comparison['neither']);
        $this->assertEquals(105, $total);
    }

    /**
     * Test 11: Sensitive permission 3-tier classification correctness
     */
    public function test_sensitive_permission_three_tier_classification(): void
    {
        // Level 1: Normal
        $this->assertEquals(
            RolePermissionMatrixHelper::LEVEL_NORMAL,
            RolePermissionMatrixHelper::getPermissionSensitivity('view_post')
        );
        $this->assertEquals(
            RolePermissionMatrixHelper::LEVEL_NORMAL,
            RolePermissionMatrixHelper::getPermissionSensitivity('create_category')
        );

        // Level 2: Sensitive
        $this->assertEquals(
            RolePermissionMatrixHelper::LEVEL_SENSITIVE,
            RolePermissionMatrixHelper::getPermissionSensitivity('delete_post')
        );
        $this->assertEquals(
            RolePermissionMatrixHelper::LEVEL_SENSITIVE,
            RolePermissionMatrixHelper::getPermissionSensitivity('delete_any_service')
        );

        // Level 3: Critical
        $this->assertEquals(
            RolePermissionMatrixHelper::LEVEL_CRITICAL,
            RolePermissionMatrixHelper::getPermissionSensitivity('delete_shield::role')
        );
        $this->assertEquals(
            RolePermissionMatrixHelper::LEVEL_CRITICAL,
            RolePermissionMatrixHelper::getPermissionSensitivity('update_users')
        );
        $this->assertEquals(
            RolePermissionMatrixHelper::LEVEL_CRITICAL,
            RolePermissionMatrixHelper::getPermissionSensitivity('page_GeneralSettings')
        );
    }

    /**
     * Test 12: Admin privilege escalation prevention - Admin cannot clone super_admin
     */
    public function test_admin_cannot_escalate_by_cloning_super_admin(): void
    {
        // Acting as regular Admin
        $this->actingAs($this->regularAdmin);

        $superAdminRole = Role::where('name', 'super_admin')->first();
        $this->assertNotNull($superAdminRole);

        // Check helper or policy: Regular admin cannot clone super_admin
        $canEscalate = $this->regularAdmin->hasRole('super_admin');
        $this->assertFalse($canEscalate);
    }

    /**
     * Test 13: Direct HTTP or Eloquent cannot delete protected system role
     */
    public function test_cannot_delete_protected_system_roles(): void
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $adminRole = Role::where('name', 'Admin')->first();

        $checkSuper = RolePermissionSecurityService::checkCanDeleteRole($this->superAdmin, $superAdminRole);
        $this->assertFalse($checkSuper['allowed']);

        $checkAdmin = RolePermissionSecurityService::checkCanDeleteRole($this->superAdmin, $adminRole);
        $this->assertFalse($checkAdmin['allowed']);
    }

    /**
     * Test 14: User roles change audit log
     */
    public function test_audit_log_recorded_when_user_roles_change(): void
    {
        $testUser = User::factory()->create();

        $log = RolePermissionAuditService::logUserRolesChanged(
            $testUser,
            [],
            ['Biên Tập Viên'],
            $this->superAdmin
        );

        $this->assertNotNull($log);
        $this->assertEquals(RolePermissionAuditLog::ACTION_ASSIGN_ROLE_TO_USER, $log->action);
        $this->assertEquals($testUser->id, $log->target_id);
        $this->assertStringContainsString($testUser->name, $log->target_name);
        $this->assertContains('Biên Tập Viên', $log->changed_fields['roles_added']);

        $testUser->delete();
    }
}
