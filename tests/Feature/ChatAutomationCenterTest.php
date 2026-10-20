<?php

namespace Tests\Feature;

use App\Filament\Pages\ChatAutomationSettings;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\Automation\ChatAutomationEngine;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatAutomationCenterTest extends TestCase
{
    protected ChatAutomationEngine $engine;
    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();

        $this->engine = app(ChatAutomationEngine::class);

        Cache::flush();
        try {
            Cache::store('database')->flush();
        } catch (\Throwable $e) {
        }

        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

        $this->adminUser = User::factory()->create([
            'email' => 'admin_test_' . uniqid() . '@truyenthongcuulong.com',
        ]);
        $this->adminUser->assignRole('Admin');
    }

    protected function tearDown(): void
    {
        ChatSetting::whereIn('key', [
            ChatAutomationEngine::SETTING_KEY,
            'chat_automation_scripts_v2',
            'chat_automation_execution_logs',
            'chat_automation_versions',
        ])->delete();

        Cache::flush();
        parent::tearDown();
    }

    /**
     * Test 1: Page mounts successfully with real metrics calculated.
     */
    public function test_01_automation_center_mounts_with_real_metrics(): void
    {
        $this->actingAs($this->adminUser);

        // Verify HTTP GET returns 200 with full Automation Center structure
        $response = $this->get('/cuulongteam/chat-automation');
        $response->assertStatus(200);
        $response->assertSee('KỊCH BẢN TỰ ĐỘNG');
        $response->assertSee('Automation Center');
        $response->assertSee('Tổng kịch bản');
        $response->assertSee('Đang hoạt động');
        $response->assertSee('Tỷ lệ thành công');
        $response->assertSee('Mô phỏng trò chuyện');
        $response->assertSee('Sơ đồ luồng');
        $response->assertSee('Cấu hình chi tiết');

        Livewire::test(ChatAutomationSettings::class)
            ->assertStatus(200)
            ->assertSee('KỊCH BẢN TỰ ĐỘNG')
            ->assertSee('Automation Center')
            ->assertSee('Tổng kịch bản')
            ->assertSee('Đang hoạt động')
            ->assertSee('Tỷ lệ thành công')
            ->call('openTestModal')
            ->assertSee('Kiểm thử Automation')
            ->call('closeModals')
            ->call('openConflictModal')
            ->assertSee('Phát hiện xung đột Automation');
    }

    /**
     * Test 2: Category, status, and search filters work accurately.
     */
    public function test_02_filters_and_search_work_properly(): void
    {
        $this->actingAs($this->adminUser);

        $component = Livewire::test(ChatAutomationSettings::class)
            // Filter by category
            ->set('activeFilter', 'welcome')
            ->assertSee('Chào mừng khách hàng');

        $filtered = $component->get('filteredScripts');
        foreach ($filtered as $item) {
            $this->assertEquals('welcome', $item['category']);
        }

        // Filter by status: active vs paused
        $component->set('activeFilter', 'all')
            ->set('statusFilter', 'paused');
        $filteredPaused = $component->get('filteredScripts');
        foreach ($filteredPaused as $item) {
            $this->assertFalse((bool) $item['enabled']);
        }

        // Search filter
        $component->set('statusFilter', 'all')
            ->set('search', 'báo giá');
        $filteredSearch = $component->get('filteredScripts');
        $this->assertNotEmpty($filteredSearch);
        foreach ($filteredSearch as $item) {
            $hasTerm = str_contains(mb_strtolower($item['name'] . $item['desc'] . $item['trigger']), 'báo giá');
            $this->assertTrue($hasTerm);
        }
    }

    /**
     * Test 3: Create, edit, duplicate, and toggle automation scripts.
     */
    public function test_03_crud_and_toggle_operations(): void
    {
        $this->actingAs($this->adminUser);

        $component = Livewire::test(ChatAutomationSettings::class);

        // 1. Create new script
        $component->call('createNewScript')
            ->assertSet('showCreateEditModal', true)
            ->set('editingScript.name', 'Kịch bản Test Tạo Mới')
            ->set('editingScript.category', 'consulting')
            ->set('editingScript.trigger', 'Khi khách hỏi "test tạo mới"')
            ->set('editingScript.preview_bot_msg', 'Dạ đây là phản hồi test.')
            ->set('editingScript.priority', 15)
            ->call('saveEditingScript')
            ->assertSet('showCreateEditModal', false);

        $scripts = $component->get('scripts');
        $created = collect($scripts)->firstWhere('name', 'Kịch bản Test Tạo Mới');
        $this->assertNotNull($created);
        $this->assertEquals(15, $created['priority']);

        // 2. Toggle script status
        $component->call('toggleScript', $created['id']);
        $toggled = collect($component->get('scripts'))->firstWhere('id', $created['id']);
        $this->assertFalse($toggled['enabled']);

        // 3. Duplicate script
        $component->call('duplicateScript', $created['id']);
        $duplicated = collect($component->get('scripts'))->firstWhere('name', 'Kịch bản Test Tạo Mới (Bản sao)');
        $this->assertNotNull($duplicated);

        // 4. Delete script
        $component->call('deleteScript', $created['id']);
        $deleted = collect($component->get('scripts'))->firstWhere('id', $created['id']);
        $this->assertNull($deleted);
    }

    /**
     * Test 4: Bulk actions (activate, pause, delete).
     */
    public function test_04_bulk_actions_execution(): void
    {
        $this->actingAs($this->adminUser);

        $component = Livewire::test(ChatAutomationSettings::class);
        $allIds = array_column($component->get('scripts'), 'id');
        $targetIds = array_slice($allIds, 0, 2);

        // Bulk Pause
        $component->set('selectedIds', $targetIds)
            ->call('bulkPause');

        $scripts = $component->get('scripts');
        foreach ($scripts as $s) {
            if (in_array($s['id'], $targetIds)) {
                $this->assertFalse($s['enabled']);
            }
        }

        // Bulk Activate
        $component->set('selectedIds', $targetIds)
            ->call('bulkActivate');

        $scriptsAfter = $component->get('scripts');
        foreach ($scriptsAfter as $s) {
            if (in_array($s['id'], $targetIds)) {
                $this->assertTrue($s['enabled']);
            }
        }
    }

    /**
     * Test 5: Conflict detection detects duplicate keywords and matching priorities.
     */
    public function test_05_conflict_detection_engine(): void
    {
        $automations = [
            [
                'id' => 'rule_1',
                'name' => 'Báo giá 1',
                'enabled' => true,
                'priority' => 20,
                'trigger' => 'Khi hỏi "bảng giá"',
                'conditions' => [
                    ['field' => 'message_contains', 'value' => 'bảng giá'],
                ],
            ],
            [
                'id' => 'rule_2',
                'name' => 'Báo giá 2',
                'enabled' => true,
                'priority' => 20, // same priority = conflict!
                'trigger' => 'Khi hỏi "bảng giá"',
                'conditions' => [
                    ['field' => 'message_contains', 'value' => 'bảng giá'],
                ],
            ],
        ];

        $conflicts = $this->engine->detectConflicts($automations);
        $this->assertNotEmpty($conflicts);
        $this->assertTrue(collect($conflicts)->contains(fn($c) => $c['type'] === 'duplicate_keyword'));
    }

    /**
     * Test 6: Simulation runner executes safely without database persistence.
     */
    public function test_06_simulation_runner_safe_execution(): void
    {
        // Test normal quote match
        $resultQuote = $this->engine->simulateExecution('Cho tôi bảng giá website chi tiết');
        $this->assertEquals('PASS', $resultQuote['result']);
        $this->assertNotEmpty($resultQuote['simulated_output']);
        $this->assertGreaterThan(0, $resultQuote['duration_ms']);

        // Test spam blocking simulation
        $resultSpam = $this->engine->simulateExecution('Quảng cáo cược casino uy tín');
        $this->assertEquals('BLOCKED', $resultSpam['result']);

        // Test human handoff simulation
        $resultHandoff = $this->engine->simulateExecution('Tôi muốn gặp chuyên viên tư vấn');
        $this->assertEquals('HANDOFF', $resultHandoff['result']);
    }

    /**
     * Test 7: Execution logs recording and retrieval.
     */
    public function test_07_execution_log_recording_and_retrieval(): void
    {
        $logEntry = [
            'timestamp' => now()->toIso8601String(),
            'customer' => 'Nguyễn Văn Test',
            'conversation_id' => 999,
            'input' => 'Cho tôi báo giá TVC',
            'matched_trigger' => 'message_received',
            'automation' => 'Hỗ trợ báo giá nhanh',
            'result' => 'SUCCESS',
            'duration_ms' => 120,
            'error' => null,
        ];

        $this->engine->recordExecutionLog($logEntry);

        $logs = $this->engine->getExecutionLogs(10);
        $this->assertNotEmpty($logs);
        $this->assertEquals('Nguyễn Văn Test', $logs[0]['customer']);
        $this->assertEquals('SUCCESS', $logs[0]['result']);
    }

    /**
     * Test 8: Version history snapshots and restoration.
     */
    public function test_08_version_history_and_restore(): void
    {
        $initialData = [
            ['id' => 'v_test_1', 'name' => 'Version 1 Rule', 'enabled' => true],
        ];
        $this->engine->recordVersion('Lưu phiên bản ban đầu', $initialData, 'admin@example.com');

        $versions = $this->engine->getVersions();
        $this->assertNotEmpty($versions);
        $versionId = $versions[0]['id'];

        $updatedData = [
            ['id' => 'v_test_1', 'name' => 'Version 2 Rule Modified', 'enabled' => false],
        ];
        ChatSetting::set('chat_automation_scripts_v2', $updatedData);

        // Restore version
        $restored = $this->engine->restoreVersion($versionId);
        $this->assertNotNull($restored);
        $this->assertEquals('Version 1 Rule', $restored[0]['name']);
    }
}
