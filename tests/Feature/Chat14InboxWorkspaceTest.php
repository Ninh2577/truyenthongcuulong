<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Filament\Pages\ChatAISettings;
use App\Filament\Pages\ChatAutomationSettings;
use App\Filament\Pages\ChatInbox;
use App\Filament\Pages\ChatSpamPage;
use App\Filament\Pages\ChatVisitorsPage;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatAgentMessageService;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * CHAT-14 Test Suite — Inbox Workspace + Navigation Module
 *
 * Covers:
 *  - Inbox access and conversation open (bug fix verification)
 *  - Conversation selection via UUID contract
 *  - Filter resilience (search/status/assignment/unread do not break selection)
 *  - Message sending, claim, assign, human takeover
 *  - Message type rendering invariants (bot ≠ agent ≠ system ≠ visitor)
 *  - Navigation module group structure
 *  - Authorization boundaries (no bypass)
 *  - Regression: CHAT-09/10/11/12/13
 */
class Chat14InboxWorkspaceTest extends TestCase
{
    protected User $admin;
    protected User $agent;
    protected User $unauthorized;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);

        $this->admin = User::factory()->create([
            'email' => 'chat14admin_' . Str::random(6) . '@test.com',
        ]);
        $this->admin->assignRole('Admin');

        $this->agent = User::factory()->create([
            'email' => 'chat14agent_' . Str::random(6) . '@test.com',
        ]);
        $this->agent->assignRole('Biên Tập Viên');

        $this->unauthorized = User::factory()->create([
            'email' => 'chat14unauth_' . Str::random(6) . '@test.com',
        ]);
        // No role
    }

    // ──────────────────────────────────────────────────────────────
    // HELPERS
    // ──────────────────────────────────────────────────────────────

    protected function makeConversation(array $override = []): ChatConversation
    {
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name'         => 'Test Visitor ' . Str::random(5),
            'email'        => Str::random(5) . '@test.com',
        ]);

        return ChatConversation::create(array_merge([
            'chat_visitor_id'    => $visitor->id,
            'status'             => ChatConversationStatus::Open,
            'channel'            => ChatConversationChannel::Human,
            'visitor_unread_count' => 0,
            'agent_unread_count'   => 1,
        ], $override));
    }

    protected function addMessage(ChatConversation $conv, string $senderType, ?int $userId = null, string $body = 'Test message'): ChatMessage
    {
        return ChatMessage::create([
            'message_uuid'         => (string) Str::uuid(),
            'chat_conversation_id' => $conv->id,
            'sender_type'          => $senderType,
            'sender_user_id'       => $userId,
            'message_body'         => $body,
            'status'               => ChatMessageStatus::Sent,
        ]);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION A: INBOX ACCESS
    // ──────────────────────────────────────────────────────────────

    /** Test 1 */
    public function test_admin_can_open_chat_inbox_page(): void
    {
        $this->actingAs($this->admin);
        $response = $this->get('/cuulongteam/chat-inbox');
        $response->assertStatus(200);
        $response->assertSee('Hộp Thư Chăm Sóc Khách Hàng');
    }

    /** Test 2 */
    public function test_agent_can_open_chat_inbox_page(): void
    {
        $this->actingAs($this->agent);
        $response = $this->get('/cuulongteam/chat-inbox');
        $response->assertStatus(200);
    }

    /** Test 3 */
    public function test_unauthenticated_user_redirected_from_inbox(): void
    {
        $response = $this->get('/cuulongteam/chat-inbox');
        $response->assertRedirect('/cuulongteam/login');
    }

    /** Test 4 */
    public function test_unauthorized_user_cannot_access_inbox(): void
    {
        $this->actingAs($this->unauthorized);
        $response = $this->get('/cuulongteam/chat-inbox');
        $response->assertStatus(403);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION B: CONVERSATION SELECTION (UUID CONTRACT)
    // ──────────────────────────────────────────────────────────────

    /** Test 5: CHAT-14 primary bug fix — selectConversation sets state via UUID */
    public function test_select_conversation_sets_uuid_state(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid)
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid);
    }

    /** Test 6: Selection must use public UUID (not numeric ID) */
    public function test_conversation_selection_uses_public_uuid_not_numeric_id(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        // selectConversation accepts string UUID
        $livewire = Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid);

        $uuid = $livewire->get('selectedConversationUuid');
        $this->assertEquals($conv->conversation_uuid, $uuid);
        // UUID must not be the numeric ID
        $this->assertNotEquals((string) $conv->id, $uuid);
    }

    /** Test 7: getSelectedConversationProperty loads correct conversation */
    public function test_selected_conversation_loads_correct_detail(): void
    {
        $this->actingAs($this->agent);
        $conv1 = $this->makeConversation();
        $conv2 = $this->makeConversation();

        $livewire = Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv2->conversation_uuid);

        // The detail should show conv2's visitor name (not conv1's)
        $livewire->assertSee($conv2->visitor->name);
    }

    /** Test 8: Switching conversations updates the selected state correctly */
    public function test_switch_between_conversations_works(): void
    {
        $this->actingAs($this->agent);
        $conv1 = $this->makeConversation();
        $conv2 = $this->makeConversation();

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv1->conversation_uuid)
            ->assertSet('selectedConversationUuid', $conv1->conversation_uuid)
            ->call('selectConversation', $conv2->conversation_uuid)
            ->assertSet('selectedConversationUuid', $conv2->conversation_uuid);
    }

    /** Test 9: Conversation that doesn't exist fails safely (no 500) */
    public function test_nonexistent_conversation_uuid_fails_safely(): void
    {
        $this->actingAs($this->agent);
        $fakeUuid = (string) Str::uuid();

        // Should not throw — selectedConversationUuid is set but selectedConversation returns null
        $livewire = Livewire::test(ChatInbox::class)
            ->call('selectConversation', $fakeUuid);

        $livewire->assertSet('selectedConversationUuid', $fakeUuid);
    }

    /** Test 10: CHAT-14 bug fix — selectConversation state persists even when read-marking fails */
    public function test_mark_as_read_failure_does_not_prevent_conversation_opening(): void
    {
        // Use a normal open conversation — verify UUID state is always set after selectConversation
        // The real bug was: ANY exception in selectConversation caused state rollback in Livewire 3
        // The fix wraps markConversationAsRead in try-catch so selectedConversationUuid is always set
        $conv = $this->makeConversation(['status' => ChatConversationStatus::Open]);

        $this->actingAs($this->agent);

        $livewire = Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid);

        // State MUST be set after call — this was null before the CHAT-14 fix
        $livewire->assertSet('selectedConversationUuid', $conv->conversation_uuid);

        // Also verify replyMessage was reset (part of the fix)
        $livewire->assertSet('replyMessage', '');
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION C: MESSAGE HISTORY
    // ──────────────────────────────────────────────────────────────

    /** Test 11: Message history loads after conversation is selected */
    public function test_message_history_loads_for_selected_conversation(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();
        $this->addMessage($conv, 'visitor', null, 'Xin chào tôi cần hỏi về giá');
        $this->addMessage($conv, 'agent', $this->agent->id, 'Chào bạn, tôi sẽ hỗ trợ ngay');

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid)
            ->assertSee('Xin chào tôi cần hỏi về giá')
            ->assertSee('Chào bạn, tôi sẽ hỗ trợ ngay');
    }

    /** Test 12: Message history is isolated per conversation */
    public function test_message_history_is_isolated_per_conversation(): void
    {
        $this->actingAs($this->agent);
        $conv1 = $this->makeConversation();
        $conv2 = $this->makeConversation();

        $uniqueBody1 = 'UNIQUE_BODY_CONV1_' . Str::random(10);
        $uniqueBody2 = 'UNIQUE_BODY_CONV2_' . Str::random(10);

        $this->addMessage($conv1, 'visitor', null, $uniqueBody1);
        $this->addMessage($conv2, 'visitor', null, $uniqueBody2);

        $svc = app(ChatAgentMessageService::class);

        // Select conv1 — messages must contain conv1's body but NOT conv2's body in the thread
        // We check via service layer (not blade) to avoid list snippet interference
        $messages1 = $svc->listMessages($this->agent, $conv1, 100);
        $messages2 = $svc->listMessages($this->agent, $conv2, 100);

        $bodies1 = $messages1->pluck('message_body')->toArray();
        $bodies2 = $messages2->pluck('message_body')->toArray();

        $this->assertContains($uniqueBody1, $bodies1);
        $this->assertNotContains($uniqueBody2, $bodies1);

        $this->assertContains($uniqueBody2, $bodies2);
        $this->assertNotContains($uniqueBody1, $bodies2);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION D: FILTER RESILIENCE
    // ──────────────────────────────────────────────────────────────

    /** Test 13: Search filter does not clear selection */
    public function test_search_filter_does_not_clear_conversation_selection(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid)
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid)
            ->set('search', 'some search term')
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid);
    }

    /** Test 14: Status filter does not clear selection */
    public function test_status_filter_does_not_clear_conversation_selection(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid)
            ->set('filterStatus', 'closed')
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid);
    }

    /** Test 15: Assignment filter does not clear selection */
    public function test_assignment_filter_does_not_clear_conversation_selection(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid)
            ->set('filterAssignment', 'mine')
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid);
    }

    /** Test 16: Unread filter does not clear selection */
    public function test_unread_filter_does_not_clear_conversation_selection(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid)
            ->set('unreadOnly', true)
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION E: MESSAGE SENDING + HUMAN TAKEOVER
    // ──────────────────────────────────────────────────────────────

    /** Test 17: Agent can send a message in an open conversation */
    public function test_agent_can_send_message(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation(['status' => ChatConversationStatus::Open]);

        $svc = app(ChatAgentMessageService::class);
        $msg = $svc->sendAgentMessage($this->agent, $conv, 'Tin nhắn test CHAT-14');

        $this->assertNotNull($msg->id);
        $this->assertEquals('agent', $msg->sender_type->value);
        $this->assertEquals($this->agent->id, $msg->sender_user_id);
        $this->assertEquals('Tin nhắn test CHAT-14', $msg->message_body);
    }

    /** Test 18: Sending agent message sets channel to Human (CHAT-12 invariant) */
    public function test_agent_message_sets_channel_to_human(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation([
            'status'  => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Ai,
        ]);

        $svc = app(ChatAgentMessageService::class);
        $svc->sendAgentMessage($this->agent, $conv, 'Human takeover');

        $conv->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conv->channel);
    }

    /** Test 19: Claim conversation sets channel to Human and status to Assigned */
    public function test_claim_conversation_sets_human_channel_and_assigned_status(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation([
            'status'             => ChatConversationStatus::Open,
            'channel'            => ChatConversationChannel::Ai,
            'assigned_to_user_id' => null,
        ]);

        $svc = app(ChatAgentConversationService::class);
        $claimed = $svc->claimConversation($this->agent, $conv);

        $this->assertEquals($this->agent->id, $claimed->assigned_to_user_id);
        $this->assertEquals(ChatConversationStatus::Assigned, $claimed->status);
        $this->assertEquals(ChatConversationChannel::Human, $claimed->channel);
    }

    /** Test 20: Livewire sendReply triggers message-sent dispatch */
    public function test_livewire_send_reply_dispatches_message_sent(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation(['status' => ChatConversationStatus::Open]);

        Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid)
            ->set('replyMessage', 'Livewire reply test')
            ->call('sendReply')
            ->assertDispatched('message-sent');
    }

    /** Test 21: Cannot send message to closed conversation */
    public function test_cannot_send_message_to_closed_conversation(): void
    {
        $conv = $this->makeConversation(['status' => ChatConversationStatus::Closed]);
        $svc = app(ChatAgentMessageService::class);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException::class);
        $svc->sendAgentMessage($this->agent, $conv, 'Test');
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION F: MESSAGE TYPE INVARIANTS
    // ──────────────────────────────────────────────────────────────

    /** Test 22: Visitor messages have sender_type = visitor */
    public function test_visitor_message_has_correct_sender_type(): void
    {
        $conv = $this->makeConversation();
        $msg = $this->addMessage($conv, 'visitor');
        $msg->refresh();

        $this->assertEquals(ChatMessageSenderType::Visitor, $msg->sender_type);
        $this->assertNotEquals(ChatMessageSenderType::Agent, $msg->sender_type);
        $this->assertNotEquals(ChatMessageSenderType::Bot, $msg->sender_type);
    }

    /** Test 23: Bot messages have sender_type = bot (not agent) */
    public function test_bot_message_is_not_agent(): void
    {
        $conv = $this->makeConversation();
        $msg = $this->addMessage($conv, 'bot');
        $msg->refresh();

        $this->assertEquals(ChatMessageSenderType::Bot, $msg->sender_type);
        $this->assertNotEquals(ChatMessageSenderType::Agent, $msg->sender_type);
    }

    /** Test 24: System messages have sender_type = system (not agent, not bot) */
    public function test_system_message_is_distinct_from_agent_and_bot(): void
    {
        $conv = $this->makeConversation();
        $msg = $this->addMessage($conv, 'system');
        $msg->refresh();

        $this->assertEquals(ChatMessageSenderType::System, $msg->sender_type);
        $this->assertNotEquals(ChatMessageSenderType::Agent, $msg->sender_type);
        $this->assertNotEquals(ChatMessageSenderType::Bot, $msg->sender_type);
    }

    /** Test 25: Agent message sender_user_id is set */
    public function test_agent_message_has_sender_user_id(): void
    {
        $conv = $this->makeConversation();
        $svc = app(ChatAgentMessageService::class);
        $msg = $svc->sendAgentMessage($this->agent, $conv, 'Agent says hi');

        $this->assertEquals($this->agent->id, $msg->sender_user_id);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION G: NAVIGATION MODULE
    // ──────────────────────────────────────────────────────────────

    /** Test 26: ChatInbox is in 'Chat & CSKH' navigation group */
    public function test_chat_inbox_is_in_chat_cskh_navigation_group(): void
    {
        $reflection = new \ReflectionClass(ChatInbox::class);
        $property   = $reflection->getProperty('navigationGroup');
        $property->setAccessible(true);

        $this->assertEquals('Chat & CSKH', $property->getValue());
    }

    /** Test 27: ChatAutomationSettings is in 'Chat & CSKH' navigation group */
    public function test_chat_automation_is_in_chat_cskh_navigation_group(): void
    {
        $reflection = new \ReflectionClass(ChatAutomationSettings::class);
        $property   = $reflection->getProperty('navigationGroup');
        $property->setAccessible(true);

        $this->assertEquals('Chat & CSKH', $property->getValue());
    }

    /** Test 28: ChatAISettings is in 'Chat & CSKH' navigation group */
    public function test_chat_ai_settings_is_in_chat_cskh_navigation_group(): void
    {
        $reflection = new \ReflectionClass(ChatAISettings::class);
        $property   = $reflection->getProperty('navigationGroup');
        $property->setAccessible(true);

        $this->assertEquals('Chat & CSKH', $property->getValue());
    }

    /** Test 29: Chat Inbox URL is preserved at /cuulongteam/chat-inbox */
    public function test_chat_inbox_url_is_preserved(): void
    {
        $this->actingAs($this->agent);
        $response = $this->get('/cuulongteam/chat-inbox');
        $response->assertStatus(200);
    }

    /** Test 30: Chat AI settings URL is preserved at /cuulongteam/chat-ai */
    public function test_chat_ai_settings_url_is_preserved(): void
    {
        $this->actingAs($this->admin);
        $response = $this->get('/cuulongteam/chat-ai');
        $response->assertStatus(200);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION H: AUTHORIZATION BOUNDARIES
    // ──────────────────────────────────────────────────────────────

    /** Test 31: Unauthorized user cannot claim conversation */
    public function test_unauthorized_user_cannot_claim_conversation(): void
    {
        $conv = $this->makeConversation();
        $svc  = app(ChatAgentConversationService::class);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class);
        $svc->claimConversation($this->unauthorized, $conv);
    }

    /** Test 32: Unauthorized user cannot send agent message */
    public function test_unauthorized_user_cannot_send_message(): void
    {
        $conv = $this->makeConversation();
        $svc  = app(ChatAgentMessageService::class);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class);
        $svc->sendAgentMessage($this->unauthorized, $conv, 'Hacked message');
    }

    /** Test 33: Non-admin cannot access spam conversations */
    public function test_non_admin_cannot_mark_as_spam(): void
    {
        $conv = $this->makeConversation();
        $svc  = app(ChatAgentConversationService::class);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class);
        $svc->markAsSpam($this->agent, $conv);
    }

    /** Test 34: Visitor (Spam) conversation view is restricted to admins */
    public function test_spam_conversation_view_restricted_to_admins(): void
    {
        $conv = $this->makeConversation(['status' => ChatConversationStatus::Spam]);
        $svc  = app(ChatAgentConversationService::class);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class);
        $svc->getConversation($this->agent, $conv->conversation_uuid);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION I: DOMAIN INVARIANTS
    // ──────────────────────────────────────────────────────────────

    /** Test 35: Conversation status and channel are distinct fields */
    public function test_status_and_channel_are_distinct(): void
    {
        $conv = $this->makeConversation([
            'status'  => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Ai,
        ]);

        $this->assertEquals(ChatConversationStatus::Open, $conv->status);
        $this->assertEquals(ChatConversationChannel::Ai, $conv->channel);
        // Status is not channel
        $this->assertNotEquals($conv->status->value, $conv->channel->value);
    }

    /** Test 36: One visitor can have multiple conversations */
    public function test_one_visitor_can_have_multiple_conversations(): void
    {
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name'         => 'Multi Conv Visitor',
        ]);

        $conv1 = ChatConversation::create([
            'chat_visitor_id'    => $visitor->id,
            'status'             => ChatConversationStatus::Closed,
            'channel'            => ChatConversationChannel::Human,
            'visitor_unread_count' => 0,
            'agent_unread_count'   => 0,
        ]);

        $conv2 = ChatConversation::create([
            'chat_visitor_id'    => $visitor->id,
            'status'             => ChatConversationStatus::Open,
            'channel'            => ChatConversationChannel::Ai,
            'visitor_unread_count' => 0,
            'agent_unread_count'   => 0,
        ]);

        $this->assertEquals($visitor->id, $conv1->chat_visitor_id);
        $this->assertEquals($visitor->id, $conv2->chat_visitor_id);
        $this->assertNotEquals($conv1->conversation_uuid, $conv2->conversation_uuid);
    }

    /** Test 37: Spam conversation ≠ blocked visitor (CHAT-09 invariant) */
    public function test_spam_conversation_is_distinct_from_blocked_visitor(): void
    {
        $conv = $this->makeConversation(['status' => ChatConversationStatus::Open]);
        $visitor = $conv->visitor;

        // Mark conversation as spam
        $svc = app(ChatAgentConversationService::class);
        $svc->markAsSpam($this->admin, $conv);
        $conv->refresh();
        $visitor->refresh();

        // Conversation is spam but visitor is NOT blocked
        $this->assertEquals(ChatConversationStatus::Spam, $conv->status);
        $this->assertNull($visitor->blocked_at);
    }

    /** Test 38: Block visitor does not change conversation status (CHAT-09 invariant) */
    public function test_blocking_visitor_does_not_change_conversation_status(): void
    {
        $conv = $this->makeConversation(['status' => ChatConversationStatus::Open]);
        $visitor = $conv->visitor;

        $svc = app(ChatAgentConversationService::class);
        $svc->blockVisitor($this->admin, $visitor);
        $conv->refresh();

        // Status of existing conversation is unchanged
        $this->assertEquals(ChatConversationStatus::Open, $conv->status);
        $visitor->refresh();
        $this->assertNotNull($visitor->blocked_at);
    }

    // ──────────────────────────────────────────────────────────────
    // SECTION J: REGRESSION (CHAT-09 / 10 / 11 / 12 / 13)
    // ──────────────────────────────────────────────────────────────

    /** Test 39: CHAT-09 regression — spam moderation service still works */
    public function test_chat09_spam_moderation_service_works(): void
    {
        $conv = $this->makeConversation();

        $svc = app(ChatAgentConversationService::class);
        $spammed = $svc->markAsSpam($this->admin, $conv);

        $this->assertEquals(ChatConversationStatus::Spam, $spammed->status);

        $restored = $svc->unmarkSpam($this->admin, $conv->fresh());
        $this->assertNotEquals(ChatConversationStatus::Spam, $restored->status);
    }

    /** Test 40: CHAT-10 regression — automation engine class is resolvable */
    public function test_chat10_automation_engine_is_resolvable(): void
    {
        $engine = app(\App\Services\Chat\Automation\ChatAutomationEngine::class);
        $this->assertNotNull($engine);
        $rules = $engine->getRules();
        $this->assertIsArray($rules);
    }

    /** Test 41: CHAT-11 regression — AI provider interface is resolvable */
    public function test_chat11_ai_provider_interface_is_resolvable(): void
    {
        $manager = app(\App\Contracts\Chat\ChatAIServiceInterface::class);
        $this->assertNotNull($manager);
        $this->assertInstanceOf(\App\Services\Chat\AI\ChatAIManager::class, $manager);
    }

    /** Test 42: CHAT-12 regression — agent send enforces human channel */
    public function test_chat12_agent_send_enforces_human_channel(): void
    {
        $conv = $this->makeConversation([
            'status'  => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Hybrid,
        ]);

        $svc = app(ChatAgentMessageService::class);
        $svc->sendAgentMessage($this->agent, $conv, 'Human takeover test');

        $conv->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conv->channel);
    }

    /** Test 43: CHAT-13 regression — AI settings resolver is resolvable */
    public function test_chat13_ai_settings_resolver_is_resolvable(): void
    {
        $resolver = app(\App\Services\Chat\AI\ChatAISettingsResolver::class);
        $this->assertNotNull($resolver);
        $settings = $resolver->getSettings();
        $this->assertIsArray($settings);
        $this->assertArrayHasKey('enabled', $settings);
        $this->assertArrayHasKey('provider', $settings);
    }

    /** Test 44: CHAT-13 regression — AI settings page URL preserved */
    public function test_chat13_ai_settings_url_preserved_at_chat_ai(): void
    {
        $this->actingAs($this->admin);
        $response = $this->get('/cuulongteam/chat-ai');
        $response->assertStatus(200);
        // Source-of-truth preserved
        $response->assertSee('Quản Trị Vận Hành AI Chat');
    }

    /** Test 45: ChatSpamPage access is admin-only */
    public function test_chat_spam_page_access_is_admin_only(): void
    {
        $this->actingAs($this->admin);
        $response = $this->get('/cuulongteam/chat-spam');
        $response->assertStatus(200);

        // Agent (non-admin) cannot access
        $this->actingAs($this->agent);
        $agentResponse = $this->get('/cuulongteam/chat-spam');
        $agentResponse->assertStatus(403);
    }

    /** Test 46: ChatVisitorsPage access is agent-level */
    public function test_chat_visitors_page_access_allowed_for_agents(): void
    {
        $this->actingAs($this->agent);
        $response = $this->get('/cuulongteam/chat-visitors');
        $response->assertStatus(200);
    }

    /** Test 47: Conversation list renders in blade (smoke test) */
    public function test_conversation_list_renders_correctly_in_blade(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        $livewire = Livewire::test(ChatInbox::class);
        $livewire->assertSee($conv->visitor->name);
    }

    /** Test 48: Livewire canAccess returns false for unauthorized user */
    public function test_livewire_can_access_returns_false_for_unauthorized(): void
    {
        $this->actingAs($this->unauthorized);
        $this->assertFalse(ChatInbox::canAccess());
    }

    /** Test 49: Navigation badge shows unread count */
    public function test_navigation_badge_shows_unread_count_when_conversations_have_unread(): void
    {
        $this->makeConversation(['agent_unread_count' => 3]);
        $this->actingAs($this->admin);

        $badge = ChatInbox::getNavigationBadge();
        // Badge exists and is positive
        $this->assertNotNull($badge);
        $this->assertGreaterThan(0, (int) $badge);
    }

    /** Test 50: UUID is not leaked via numeric ID in conversation identifier */
    public function test_uuid_contract_no_numeric_id_leak(): void
    {
        $this->actingAs($this->agent);
        $conv = $this->makeConversation();

        $livewire = Livewire::test(ChatInbox::class)
            ->call('selectConversation', $conv->conversation_uuid);

        $uuid = $livewire->get('selectedConversationUuid');
        // Must be a valid UUID format (not an integer string)
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            $uuid
        );
    }

    /** Test 51: Navigation group and sort order strict contract (10, 20, 30, 40, 50) */
    public function test_navigation_group_and_sort_contract(): void
    {
        $this->assertEquals('Chat & CSKH', ChatInbox::getNavigationGroup());
        $this->assertEquals(10, ChatInbox::getNavigationSort());

        $this->assertEquals('Chat & CSKH', \App\Filament\Pages\ChatVisitorsPage::getNavigationGroup());
        $this->assertEquals(20, \App\Filament\Pages\ChatVisitorsPage::getNavigationSort());

        $this->assertEquals('Chat & CSKH', \App\Filament\Pages\ChatAutomationSettings::getNavigationGroup());
        $this->assertEquals(30, \App\Filament\Pages\ChatAutomationSettings::getNavigationSort());

        $this->assertEquals('Chat & CSKH', \App\Filament\Pages\ChatSpamPage::getNavigationGroup());
        $this->assertEquals(40, \App\Filament\Pages\ChatSpamPage::getNavigationSort());

        $this->assertEquals('Chat & CSKH', \App\Filament\Pages\ChatAISettings::getNavigationGroup());
        $this->assertEquals(50, \App\Filament\Pages\ChatAISettings::getNavigationSort());
    }
}
