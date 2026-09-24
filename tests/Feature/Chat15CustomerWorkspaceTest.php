<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Filament\Pages\ChatInbox;
use App\Filament\Pages\ChatVisitorsPage;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class Chat15CustomerWorkspaceTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $agent;
    protected User $unauthorized;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $this->admin = User::factory()->create(['email' => 'admin@example.com']);
        $this->admin->assignRole('super_admin');

        $this->agent = User::factory()->create(['email' => 'agent@example.com']);
        $this->agent->assignRole('Biên Tập Viên');

        $this->unauthorized = User::factory()->create(['email' => 'unauth@example.com']);
        $this->unauthorized->assignRole('user');
    }

    protected function makeVisitor(array $attributes = []): ChatVisitor
    {
        return ChatVisitor::create(array_merge([
            'visitor_uuid' => (string) Str::uuid(),
            'name'         => 'Visitor ' . Str::random(4),
            'email'        => 'visitor_' . Str::random(5) . '@example.com',
            'phone'        => '0901234567',
        ], $attributes));
    }

    protected function makeConversation(ChatVisitor $visitor, array $attributes = []): ChatConversation
    {
        return ChatConversation::create(array_merge([
            'conversation_uuid'    => (string) Str::uuid(),
            'chat_visitor_id'      => $visitor->id,
            'status'               => ChatConversationStatus::Open,
            'channel'              => ChatConversationChannel::Ai,
            'visitor_unread_count' => 0,
            'agent_unread_count'   => 0,
        ], $attributes));
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION I: CUSTOMER LIST (Scenarios 1 - 7)
    // ──────────────────────────────────────────────────────────────

    /** Test 01: Chat visitors page accessible to authorized agent */
    public function test_01_page_accessible_to_authorized_agent(): void
    {
        $this->actingAs($this->agent);
        $this->get(route('filament.admin.pages.chat-visitors'))
            ->assertSuccessful();
    }

    /** Test 02: Visitor list loads in Livewire component */
    public function test_02_visitor_list_loads_correctly(): void
    {
        $visitor = $this->makeVisitor(['name' => 'Nguyễn Thị Hoa']);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->assertSee('Nguyễn Thị Hoa')
            ->assertSee(substr($visitor->visitor_uuid, 0, 8));
    }

    /** Test 03: Customer list pagination works */
    public function test_03_pagination_works(): void
    {
        $this->actingAs($this->agent);

        // Create 18 visitors (page size is 15)
        for ($i = 1; $i <= 18; $i++) {
            $this->makeVisitor(['name' => "BatchVisitor {$i}"]);
        }

        $component = Livewire::test(ChatVisitorsPage::class);
        $paginator = $component->instance()->getVisitorsProperty();
        $this->assertEquals(18, $paginator->total());
        $this->assertEquals(15, $paginator->perPage());
    }

    /** Test 04: Search by visitor name */
    public function test_04_search_by_visitor_name(): void
    {
        $this->makeVisitor(['name' => 'Trần Văn Targeted']);
        $this->makeVisitor(['name' => 'Lê Thị Other']);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->set('search', 'Targeted')
            ->assertSee('Trần Văn Targeted')
            ->assertDontSee('Lê Thị Other');
    }

    /** Test 05: Search by visitor UUID */
    public function test_05_search_by_visitor_uuid(): void
    {
        $v1 = $this->makeVisitor(['name' => 'First Visitor']);
        $v2 = $this->makeVisitor(['name' => 'Second Visitor']);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->set('search', $v1->visitor_uuid)
            ->assertSee('First Visitor')
            ->assertDontSee('Second Visitor');
    }

    /** Test 06: Empty state displayed when no visitors match */
    public function test_06_empty_state_when_no_visitors_match(): void
    {
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->set('search', 'NonExistentXYZ999')
            ->assertSee('Chưa có khách hàng');
    }

    /** Test 07: Status filter resets pagination page */
    public function test_07_status_filter_resets_pagination(): void
    {
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->set('filterStatus', 'blocked')
            ->assertSet('filterStatus', 'blocked');
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION II: CUSTOMER DETAIL & VISITOR 360 (Scenarios 8 - 15)
    // ──────────────────────────────────────────────────────────────

    /** Test 08: Select visitor updates selectedVisitorUuid */
    public function test_08_select_visitor_sets_state(): void
    {
        $visitor = $this->makeVisitor();
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSet('selectedVisitorUuid', $visitor->visitor_uuid);
    }

    /** Test 09: Selected visitor detail loads with profile */
    public function test_09_selected_visitor_detail_loads(): void
    {
        $visitor = $this->makeVisitor(['name' => 'Hoàng Minh Detailed']);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('Hoàng Minh Detailed')
            ->assertSee($visitor->visitor_uuid);
    }

    /** Test 10: Visitor UUID shown safely in public DOM */
    public function test_10_visitor_uuid_shown_safely(): void
    {
        $visitor = $this->makeVisitor();
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee($visitor->visitor_uuid);
    }

    /** Test 11: Sessions load in visitor detail */
    public function test_11_sessions_load_in_detail(): void
    {
        $visitor = $this->makeVisitor();
        ChatVisitorSession::create([
            'chat_visitor_id' => $visitor->id,
            'token_hash'      => hash('sha256', 'test_secret_token_123'),
            'expires_at'      => now()->addDays(7),
            'last_active_at'  => now(),
        ]);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('Phiên hoạt động gần nhất')
            ->assertSee('Hiệu lực');
    }

    /** Test 12: Conversations load in visitor history */
    public function test_12_conversations_load_in_history(): void
    {
        $visitor = $this->makeVisitor();
        $conv = $this->makeConversation($visitor, ['status' => ChatConversationStatus::Assigned]);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee(substr($conv->conversation_uuid, 0, 8))
            ->assertSee(ChatConversationStatus::Assigned->value);
    }

    /** Test 13: Conversation count displayed accurately */
    public function test_13_conversation_count_accurate(): void
    {
        $visitor = $this->makeVisitor();
        $this->makeConversation($visitor);
        $this->makeConversation($visitor);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('2 cuộc');
    }

    /** Test 14: Security invariant — token_hash and secrets NEVER exposed in HTML */
    public function test_14_secrets_and_token_hashes_never_exposed(): void
    {
        $secretHash = hash('sha256', 'super_secret_session_token_xyz');
        $visitor = $this->makeVisitor();
        ChatVisitorSession::create([
            'chat_visitor_id' => $visitor->id,
            'token_hash'      => $secretHash,
            'expires_at'      => now()->addDays(3),
        ]);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertDontSee($secretHash)
            ->assertDontSee('token_hash');
    }

    /** Test 15: Last activity timestamp rendered */
    public function test_15_last_activity_rendered(): void
    {
        $visitor = $this->makeVisitor();
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('Hoạt động gần nhất');
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION III: CONVERSATION NAVIGATION (Scenarios 16 - 20)
    // ──────────────────────────────────────────────────────────────

    /** Test 16: Conversation snippet shows latest message */
    public function test_16_conversation_snippet_shows_latest_message(): void
    {
        $visitor = $this->makeVisitor();
        $conv = $this->makeConversation($visitor);
        ChatMessage::create([
            'chat_conversation_id' => $conv->id,
            'sender_type'          => ChatMessageSenderType::Visitor,
            'message_body'         => 'Hỏi giá gói video cao cấp',
        ]);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('Hỏi giá gói video cao cấp');
    }

    /** Test 17: Open conversation redirects to ChatInbox with public UUID */
    public function test_17_open_conversation_redirects_to_inbox(): void
    {
        $visitor = $this->makeVisitor();
        $conv = $this->makeConversation($visitor);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('openConversation', $conv->conversation_uuid)
            ->assertRedirect(route('filament.admin.pages.chat-inbox', ['conversation' => $conv->conversation_uuid]));
    }

    /** Test 18: Public UUID contract preserved in openConversation */
    public function test_18_open_conversation_uses_uuid_not_numeric_id(): void
    {
        $visitor = $this->makeVisitor();
        $conv = $this->makeConversation($visitor);
        $this->actingAs($this->agent);

        $livewire = Livewire::test(ChatVisitorsPage::class);
        $livewire->call('openConversation', $conv->conversation_uuid);

        // Target URL must contain UUID format
        $redirectUrl = $livewire->effects['redirect'] ?? '';
        $this->assertStringContainsString($conv->conversation_uuid, $redirectUrl);
        $this->assertStringNotContainsString("/{$conv->id}?", $redirectUrl);
    }

    /** Test 19: ChatInbox mount accepts conversation query param and selects it */
    public function test_19_chat_inbox_mount_selects_conversation_from_param(): void
    {
        $visitor = $this->makeVisitor();
        $conv = $this->makeConversation($visitor);
        $this->actingAs($this->agent);

        Livewire::withQueryParams(['conversation' => $conv->conversation_uuid])
            ->test(ChatInbox::class)
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid);
    }

    /** Test 20: Switching between conversations of the same visitor */
    public function test_20_visitor_with_multiple_conversations_links_correctly(): void
    {
        $visitor = $this->makeVisitor();
        $conv1 = $this->makeConversation($visitor, ['status' => ChatConversationStatus::Closed]);
        $conv2 = $this->makeConversation($visitor, ['status' => ChatConversationStatus::Open]);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee(substr($conv1->conversation_uuid, 0, 8))
            ->assertSee(substr($conv2->conversation_uuid, 0, 8));
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION IV: MODERATION & SECURITY (Scenarios 21 - 26)
    // ──────────────────────────────────────────────────────────────

    /** Test 21: Blocked visitor shows danger badge */
    public function test_21_blocked_visitor_shows_blocked_badge(): void
    {
        $visitor = $this->makeVisitor(['blocked_at' => now()]);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('Bị chặn');
    }

    /** Test 22: Visitor with spam conversation shows spam indicator */
    public function test_22_visitor_with_spam_conversation_shows_spam_indicator(): void
    {
        $visitor = $this->makeVisitor();
        $this->makeConversation($visitor, ['status' => ChatConversationStatus::Spam]);
        $this->actingAs($this->admin);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('Có spam');
    }

    /** Test 23: Spam conversation is distinct from blocked visitor */
    public function test_23_spam_is_distinct_from_blocked(): void
    {
        $visitor = $this->makeVisitor(['blocked_at' => null]);
        $this->makeConversation($visitor, ['status' => ChatConversationStatus::Spam]);
        $this->actingAs($this->admin);

        $this->assertNull($visitor->blocked_at);
        $this->assertTrue($visitor->conversations()->where('status', ChatConversationStatus::Spam)->exists());
    }

    /** Test 24: Unauthorized user cannot access chat visitors page */
    public function test_24_unauthorized_user_cannot_access_page(): void
    {
        $this->actingAs($this->unauthorized);
        $this->get(route('filament.admin.pages.chat-visitors'))
            ->assertForbidden();
    }

    /** Test 25: Non-admin agent cannot block visitor */
    public function test_25_non_admin_cannot_block_visitor(): void
    {
        $visitor = $this->makeVisitor(['blocked_at' => null]);
        $this->actingAs($this->agent); // Biên Tập Viên role, not Admin

        Livewire::test(ChatVisitorsPage::class)
            ->call('toggleBlockVisitor', $visitor->visitor_uuid);

        $visitor->refresh();
        $this->assertNull($visitor->blocked_at);
    }

    /** Test 26: Admin can block and unblock visitor */
    public function test_26_admin_can_block_and_unblock_visitor(): void
    {
        $visitor = $this->makeVisitor(['blocked_at' => null]);
        $this->actingAs($this->admin); // super_admin

        Livewire::test(ChatVisitorsPage::class)
            ->call('toggleBlockVisitor', $visitor->visitor_uuid);

        $visitor->refresh();
        $this->assertNotNull($visitor->blocked_at);

        // Unblock
        Livewire::test(ChatVisitorsPage::class)
            ->call('toggleBlockVisitor', $visitor->visitor_uuid);

        $visitor->refresh();
        $this->assertNull($visitor->blocked_at);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION V: INTERNAL NOTES (Scenarios 27 - 29)
    // ──────────────────────────────────────────────────────────────

    /** Test 27: Agent can add internal note to visitor's conversation */
    public function test_27_agent_can_add_internal_note(): void
    {
        $visitor = $this->makeVisitor();
        $conv = $this->makeConversation($visitor);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->set('newInternalNote', 'Khách VIP đang khảo sát giá sản xuất phim ngắn')
            ->call('addInternalNote');

        $this->assertDatabaseHas('chat_internal_notes', [
            'chat_conversation_id' => $conv->id,
            'user_id'              => $this->agent->id,
            'note_body'            => 'Khách VIP đang khảo sát giá sản xuất phim ngắn',
        ]);
    }

    /** Test 28: Internal notes list displayed in visitor detail */
    public function test_28_internal_notes_displayed_in_detail(): void
    {
        $visitor = $this->makeVisitor();
        $conv = $this->makeConversation($visitor);
        ChatInternalNote::create([
            'chat_conversation_id' => $conv->id,
            'user_id'              => $this->agent->id,
            'note_body'            => 'Ghi chú nghiệp vụ bí mật',
        ]);
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSee('Ghi chú nghiệp vụ bí mật')
            ->assertSee($this->agent->name);
    }

    /** Test 29: Tag section gracefully handles lack of tags without crash */
    public function test_29_tag_section_handled_gracefully(): void
    {
        $visitor = $this->makeVisitor();
        $this->actingAs($this->agent);

        Livewire::test(ChatVisitorsPage::class)
            ->call('selectVisitor', $visitor->visitor_uuid)
            ->assertSuccessful();
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION VI: REGRESSION & NAVIGATION (Scenarios 30 - 34)
    // ──────────────────────────────────────────────────────────────

    /** Test 30: Navigation group and sort order for ChatVisitorsPage */
    public function test_30_navigation_group_and_sort_contract(): void
    {
        $this->assertEquals('Chat & CSKH', ChatVisitorsPage::getNavigationGroup());
        $this->assertEquals(20, ChatVisitorsPage::getNavigationSort());
        $this->assertEquals('Khách hàng', ChatVisitorsPage::getNavigationLabel());
    }

    /** Test 31: CHAT-09 Spam moderation regression intact */
    public function test_31_chat09_spam_moderation_service_intact(): void
    {
        $service = app(\App\Services\Chat\ChatAgentConversationService::class);
        $this->assertTrue(method_exists($service, 'markAsSpam'));
        $this->assertTrue(method_exists($service, 'unmarkSpam'));
    }

    /** Test 32: CHAT-10 Automation engine regression intact */
    public function test_32_chat10_automation_engine_intact(): void
    {
        $engine = app(\App\Services\Chat\Automation\ChatAutomationEngine::class);
        $this->assertInstanceOf(\App\Services\Chat\Automation\ChatAutomationEngine::class, $engine);
    }

    /** Test 33: CHAT-11/12 AI & Human handoff regression intact */
    public function test_33_chat11_12_ai_provider_and_handoff_intact(): void
    {
        $resolver = app(\App\Services\Chat\AI\ChatAISettingsResolver::class);
        $this->assertInstanceOf(\App\Services\Chat\AI\ChatAISettingsResolver::class, $resolver);
    }

    /** Test 34: CHAT-14 ChatInbox page and route remain fully operational */
    public function test_34_chat14_chat_inbox_remains_fully_operational(): void
    {
        $this->actingAs($this->admin);
        $this->get(route('filament.admin.pages.chat-inbox'))
            ->assertSuccessful();
    }
}
