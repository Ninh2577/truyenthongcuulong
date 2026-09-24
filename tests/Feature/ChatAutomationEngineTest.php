<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\Automation\ChatAutomationActionService;
use App\Services\Chat\Automation\ChatAutomationEngine;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatAutomationEngineTest extends TestCase
{
    protected ChatAutomationEngine $engine;
    protected ChatAutomationActionService $actionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();

        $this->actionService = app(ChatAutomationActionService::class);
        $this->engine = app(ChatAutomationEngine::class);

        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');
        Cache::flush();
        try {
            Cache::store('database')->flush();
        } catch (\Throwable $e) {
        }

        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'CSKH', 'guard_name' => 'web']);
    }

    protected function tearDown(): void
    {
        ChatSetting::where('key', ChatAutomationEngine::SETTING_KEY)->delete();
        Cache::flush();
        try {
            Cache::store('database')->flush();
        } catch (\Throwable $e) {
        }

        parent::tearDown();
    }

    protected function createVisitorAndConversation(): array
    {
        $visitor = ChatVisitor::create([
            'name' => 'Test Visitor ' . uniqid(),
        ]);

        $conversation = ChatConversation::create([
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Human,
            'visitor_unread_count' => 0,
            'agent_unread_count' => 0,
        ]);

        return [$visitor, $conversation];
    }

    /**
     * Test 1: Enabled rule matching trigger and condition executes successfully.
     */
    public function test_01_enabled_rule_matches_and_executes(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_test_enabled',
            'name' => 'Test Enabled Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [
                ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'tư vấn'],
            ],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Dạ chúng tôi sẵn sàng tư vấn.']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi cần tư vấn gấp',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(1, $executed);
        $this->assertDatabaseHas('chat_messages', [
            'chat_conversation_id' => $conversation->id,
            'sender_type' => ChatMessageSenderType::System->value,
            'message_body' => 'Dạ chúng tôi sẵn sàng tư vấn.',
        ]);
    }

    /**
     * Test 2: Disabled rule is ignored and does not execute.
     */
    public function test_02_disabled_rule_does_not_execute(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_test_disabled',
            'name' => 'Disabled Rule',
            'trigger' => 'message_received',
            'enabled' => false,
            'priority' => 10,
            'conditions' => [
                ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'xin chào'],
            ],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Automated reply']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào công ty',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
        $this->assertEquals(1, $conversation->messages()->count());
    }

    /**
     * Test 3: Trigger mismatch does not execute.
     */
    public function test_03_trigger_mismatch_does_not_execute(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_conv_created',
            'name' => 'Conv Created Rule',
            'trigger' => 'conversation_created',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Welcome message']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        // Trigger is message_received, but rule is for conversation_created
        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hello',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
    }

    /**
     * Test 4: Condition mismatch does not execute.
     */
    public function test_04_condition_mismatch_does_not_execute(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_keyword_match',
            'name' => 'Keyword Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [
                ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'báo giá'],
            ],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Bảng giá đây ạ']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        // Message does not contain "báo giá"
        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi muốn tuyển dụng',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
    }

    /**
     * Test 5: Multiple conditions all must be satisfied.
     */
    public function test_05_multiple_conditions_all_must_satisfy(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $conversation->update(['status' => ChatConversationStatus::Assigned]);

        $rule = [
            'id' => 'rule_multi_cond',
            'name' => 'Multi Condition Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [
                ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'hỗ trợ'],
                ['field' => 'conversation_status', 'operator' => 'equals', 'value' => 'open'],
            ],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Đang hỗ trợ']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Cần hỗ trợ',
            'status' => 'sent',
        ]);

        // Status is assigned, but rule requires open -> should fail
        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);
        $this->assertEquals(0, $executed);

        // Now set status to open -> should pass
        $conversation->update(['status' => ChatConversationStatus::Open]);
        $executed2 = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
            'event_id' => uniqid(),
        ]);
        $this->assertEquals(1, $executed2);
    }

    /**
     * Test 6: Deterministic rule ordering by priority ASC.
     */
    public function test_06_deterministic_priority_ordering(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_low_pri',
                'name' => 'Low Priority',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 50,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Second reply']]],
            ],
            [
                'id' => 'rule_high_pri',
                'name' => 'High Priority',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'First reply']]],
            ],
        ];
        $this->engine->saveRules($rules);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Check priority',
            'status' => 'sent',
        ]);

        $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $messages = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::System)
            ->orderBy('id', 'asc')
            ->pluck('message_body')
            ->toArray();

        $this->assertCount(2, $messages);
        $this->assertEquals('First reply', $messages[0]);
        $this->assertEquals('Second reply', $messages[1]);
    }

    /**
     * Test 7: Automated message is created with sender_type = System and null sender_user_id.
     */
    public function test_07_automated_message_created_with_system_sender_type(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $this->actionService->sendAutomatedMessage($conversation, 'System auto response', 'Test Rule');

        $this->assertEquals(ChatMessageSenderType::System, $msg->sender_type);
        $this->assertNull($msg->sender_user_id);
        $this->assertEquals('System auto response', $msg->message_body);
    }

    /**
     * Test 8: Unread counters update accurately: visitor_unread increments, agent_unread does not increment.
     */
    public function test_08_unread_counters_accurate_on_automated_message(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->assertEquals(0, $conversation->visitor_unread_count);
        $this->assertEquals(0, $conversation->agent_unread_count);

        $this->actionService->sendAutomatedMessage($conversation, 'Auto msg for visitor');

        $conversation->refresh();
        // Visitor unread must increment so visitor sees notification
        $this->assertEquals(1, $conversation->visitor_unread_count);
        // Agent unread must NOT increment to prevent false alert
        $this->assertEquals(0, $conversation->agent_unread_count);
        $this->assertNotNull($conversation->last_message_at);
    }

    /**
     * Test 9: Execution audit note is recorded in ChatInternalNote.
     */
    public function test_09_execution_audit_note_recorded(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $this->actionService->sendAutomatedMessage($conversation, 'Audited reply', 'Greeting Rule');

        $this->assertDatabaseHas('chat_internal_notes', [
            'chat_conversation_id' => $conversation->id,
            'user_id' => null,
            'note_body' => '[Tự động hóa: Greeting Rule] Đã gửi phản hồi tự động cho khách.',
        ]);
    }

    /**
     * Test 10: Status transition action works correctly.
     */
    public function test_10_status_transition_action_executed(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->assertEquals(ChatConversationStatus::Open, $conversation->status);

        $this->actionService->updateConversationStatus(
            $conversation,
            ChatConversationStatus::WaitingAgent,
            'Route Rule'
        );

        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->fresh()->status);
        $this->assertDatabaseHas('chat_internal_notes', [
            'chat_conversation_id' => $conversation->id,
            'note_body' => "[Tự động hóa: Route Rule] Trạng thái chuyển từ 'open' sang 'waiting_agent'.",
        ]);
    }

    /**
     * Test 11 & 12: Idempotency: duplicate event does not trigger duplicate execution.
     */
    public function test_11_and_12_duplicate_event_does_not_execute_twice(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_idemp_test',
            'name' => 'Idempotency Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Unique automated reply']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Test idemp',
            'status' => 'sent',
        ]);

        $testEventId = 'evt_idemp_' . uniqid();

        // First execution succeeds
        $firstExec = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
            'event_id' => $testEventId,
        ]);
        $this->assertEquals(1, $firstExec);

        // Second execution with identical event_id is skipped
        $secondExec = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
            'event_id' => $testEventId,
        ]);
        $this->assertEquals(0, $secondExec);

        // Database has exactly 1 automated message
        $systemMsgCount = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::System)
            ->count();
        $this->assertEquals(1, $systemMsgCount);
    }

    /**
     * Test 13: Concurrency test using independent worker processes.
     */
    public function test_13_concurrent_automation_execution_with_workers(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_concurrent_test',
            'name' => 'Concurrent Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Concurrent reply']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Concurrent trigger',
            'status' => 'sent',
        ]);

        $fixedEventId = 'fixed_event_concurrency_' . uniqid();
        $visitorId = $visitor->id;
        $convId = $conversation->id;
        $msgId = $incomingMsg->id;

        $processes = [];
        $pipes = [];

        // Launch 4 concurrent workers trying to process the exact same event
        for ($i = 1; $i <= 4; $i++) {
            $cmd = 'php -r "require \'vendor/autoload.php\'; $app = require \'bootstrap/app.php\'; $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); $v = App\Models\ChatVisitor::find(' . $visitorId . '); $c = App\Models\ChatConversation::find(' . $convId . '); $m = App\Models\ChatMessage::find(' . $msgId . '); $count = app(App\Services\Chat\Automation\ChatAutomationEngine::class)->handleTrigger(\'message_received\', [\'conversation\' => $c, \'message\' => $m, \'visitor\' => $v, \'event_id\' => \'' . $fixedEventId . '\']); echo $count;"';
            $processes[$i] = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes[$i]);
        }

        $results = [];
        for ($i = 1; $i <= 4; $i++) {
            $out = stream_get_contents($pipes[$i][1]);
            fclose($pipes[$i][1]);
            fclose($pipes[$i][2]);
            proc_close($processes[$i]);
            $results[] = (int) trim($out);
        }

        // Exactly one process should report 1 execution, and the others report 0
        $this->assertEquals(1, array_sum($results), 'Expected exactly one execution among 4 concurrent workers.');
        $this->assertEquals(1, $conversation->messages()->where('sender_type', ChatMessageSenderType::System)->count());
    }

    /**
     * Test 14: Loop protection: automated message does not recursively trigger message_received automation.
     */
    public function test_14_loop_protection_automated_message_does_not_trigger_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_loop_guard',
            'name' => 'Loop Guard Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Should not loop']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        // Create a SYSTEM message
        $systemMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::System,
            'message_body' => 'I am a system message',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $systemMsg,
            'visitor' => $visitor,
        ]);

        // MUST be 0! System messages are never processed as incoming triggers
        $this->assertEquals(0, $executed);
    }

    /**
     * Test 15: Agent message does not trigger visitor automation.
     */
    public function test_15_agent_message_does_not_trigger_visitor_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_agent_guard',
            'name' => 'Agent Guard Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Should not reply to agent']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        $agent = User::factory()->create(['email' => 'agent_' . uniqid() . '@example.com']);

        $agentMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Agent,
            'sender_user_id' => $agent->id,
            'message_body' => 'Xin chào tôi là agent',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $agentMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
    }

    /**
     * Test 16: Blocked visitor is skipped by automation engine.
     */
    public function test_16_blocked_visitor_is_skipped(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitor->update(['blocked_at' => now()]);

        $rule = [
            'id' => 'rule_block_test',
            'name' => 'Block Test Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Hi']]],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hello',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
    }

    /**
     * Test 17: Spam conversation is skipped by automation engine.
     */
    public function test_17_spam_conversation_is_skipped(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $conversation->update(['status' => ChatConversationStatus::Spam]);

        $rule = [
            'id' => 'rule_spam_test',
            'name' => 'Spam Test Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Hi']]],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hello',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
    }

    /**
     * Test 18: Closed conversation is skipped and not auto-reopened by automation.
     */
    public function test_18_closed_conversation_is_skipped(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $conversation->update(['status' => ChatConversationStatus::Closed]);

        $rule = [
            'id' => 'rule_closed_test',
            'name' => 'Closed Test Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [],
            'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Hi']]],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hello',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
        $this->assertEquals(ChatConversationStatus::Closed, $conversation->fresh()->status);
    }

    /**
     * Test 19: Outside business hours condition logic.
     */
    public function test_19_outside_business_hours_condition(): void
    {
        // Sunday 10:00 -> Outside business hours
        $sunday = Carbon::parse('2026-09-27 10:00:00', 'Asia/Ho_Chi_Minh');
        $this->assertTrue($this->engine->isOutsideBusinessHours($sunday));

        // Wednesday 10:00 -> Inside business hours
        $wedMorning = Carbon::parse('2026-09-23 10:00:00', 'Asia/Ho_Chi_Minh');
        $this->assertFalse($this->engine->isOutsideBusinessHours($wedMorning));

        // Wednesday 20:00 -> Outside business hours
        $wedNight = Carbon::parse('2026-09-23 20:00:00', 'Asia/Ho_Chi_Minh');
        $this->assertTrue($this->engine->isOutsideBusinessHours($wedNight));
    }

    /**
     * Test 20: Full integration: visitor message via HTTP triggers automation rule.
     */
    public function test_20_http_visitor_message_triggers_automation_end_to_end(): void
    {
        $sessionService = app(\App\Services\Chat\VisitorSessionService::class);
        $session = $sessionService->initSession(null, ['ip' => '127.0.0.1', 'user_agent' => 'PHPUnit']);
        $cookieName = config('chat.cookie_name', 'chat_visitor_token');

        $rule = [
            'id' => 'rule_e2e_quote',
            'name' => 'E2E Quote Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [
                ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'báo giá'],
            ],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Dạ bảng giá dịch vụ đây ạ.']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        // Visitor creates conversation
        $convRes = $this->withCookie($cookieName, $session['session_token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        // Visitor sends message matching keyword
        $msgRes = $this->withCookie($cookieName, $session['session_token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Cho mình xin báo giá livestream nhé',
            ]);
        $msgRes->assertStatus(201);

        // Verification: System automated reply was dispatched and saved
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();
        $systemMsg = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::System)
            ->first();

        $this->assertNotNull($systemMsg);
        $this->assertEquals('Dạ bảng giá dịch vụ đây ạ.', $systemMsg->message_body);
        $this->assertNull($systemMsg->sender_user_id);
    }

    /**
     * Test 21: Full integration: new conversation creation triggers conversation_created greeting.
     */
    public function test_21_new_conversation_creation_triggers_greeting(): void
    {
        $sessionService = app(\App\Services\Chat\VisitorSessionService::class);
        $session = $sessionService->initSession(null, ['ip' => '127.0.0.1', 'user_agent' => 'PHPUnit']);
        $cookieName = config('chat.cookie_name', 'chat_visitor_token');

        $rule = [
            'id' => 'rule_greeting_test',
            'name' => 'Greeting On Created',
            'trigger' => 'conversation_created',
            'enabled' => true,
            'priority' => 5,
            'conditions' => [
                ['field' => 'conversation_status', 'operator' => 'equals', 'value' => 'open'],
            ],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Chào mừng bạn đến với Cửu Long!']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        // Visitor creates conversation
        $convRes = $this->withCookie($cookieName, $session['session_token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();
        $systemGreeting = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::System)
            ->first();

        $this->assertNotNull($systemGreeting);
        $this->assertEquals('Chào mừng bạn đến với Cửu Long!', $systemGreeting->message_body);
    }

    /**
     * Test 22: Unknown/malicious condition fails closed.
     */
    public function test_22_unknown_condition_fails_closed(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_malicious_test',
            'name' => 'Malicious Condition Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'conditions' => [
                ['field' => 'arbitrary_injection', 'operator' => 'eval', 'value' => 'true'],
            ],
            'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Should not run']]],
        ];
        $this->engine->saveRules([$rule]);

        $incomingMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Trigger attempt',
            'status' => 'sent',
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $incomingMsg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
    }

    /**
     * Test 23: Cooldown prevents runaway automation within cooldown window.
     */
    public function test_23_cooldown_prevents_runaway_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rule = [
            'id' => 'rule_cooldown_test',
            'name' => 'Cooldown Test Rule',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 10,
            'cooldown_seconds' => 60,
            'conditions' => [],
            'actions' => [
                ['type' => 'send_message', 'payload' => ['message' => 'Cooldown response']],
            ],
        ];
        $this->engine->saveRules([$rule]);

        // First message
        $msg1 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Msg 1',
            'status' => 'sent',
        ]);

        $exec1 = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg1,
            'visitor' => $visitor,
            'event_id' => uniqid(),
        ]);
        $this->assertEquals(1, $exec1);

        // Immediate second message in same conversation should be throttled by cooldown
        $msg2 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Msg 2',
            'status' => 'sent',
        ]);

        $exec2 = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg2,
            'visitor' => $visitor,
            'event_id' => uniqid(),
        ]);
        $this->assertEquals(0, $exec2);
    }

    /**
     * Test 24: Action failure triggers rollback without partial state corruption.
     */
    public function test_24_action_failure_triggers_transaction_rollback(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        try {
            // Attempt to send empty message which throws UnprocessableEntityHttpException
            $this->actionService->sendAutomatedMessage($conversation, '');
            $this->fail('Empty automated message should have thrown exception.');
        } catch (\Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException $e) {
            $this->assertTrue(true);
        }

        // Conversation unread count and messages remain unchanged
        $this->assertEquals(0, $conversation->fresh()->visitor_unread_count);
        $this->assertEquals(0, $conversation->messages()->count());
    }

    /**
     * Test 25: Filament page authorization: Admin can access, unauthorized user is denied.
     */
    public function test_25_filament_automation_page_authorization(): void
    {
        $adminUser = User::factory()->create(['email' => 'admin_' . uniqid() . '@example.com']);
        $adminUser->assignRole('Admin');

        $agentUser = User::factory()->create(['email' => 'agent_' . uniqid() . '@example.com']);
        $agentUser->assignRole('CSKH');

        // Admin user can access
        $this->actingAs($adminUser);
        $this->get('/cuulongteam/chat-automation')->assertStatus(200);

        // Regular agent without manage permission is denied
        $this->actingAs($agentUser);
        $this->get('/cuulongteam/chat-automation')->assertStatus(403);
    }
}
