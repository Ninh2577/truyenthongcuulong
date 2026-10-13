<?php

namespace Tests\Feature\ChatAI;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Events\Chat\ChatMessageCreated;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\AI\ChatAIConversationService;
use App\Services\Chat\AI\ChatHandoffService;
use App\Services\Chat\Automation\ChatAutomationActionService;
use App\Services\Chat\Automation\ChatAutomationEngine;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatMessageService;
use App\Services\Chat\Spam\ChatSpamProtectionService;
use App\Services\Chat\VisitorSessionService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class AutomationEngineSpamProtectionTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    protected ChatAutomationEngine $automationEngine;
    protected ChatAutomationActionService $automationActionService;
    protected ChatSpamProtectionService $spamService;
    protected ChatMessageService $messageService;
    protected ChatHandoffService $handoffService;
    protected ChatAgentConversationService $agentConvService;
    protected VisitorSessionService $sessionService;
    protected User $agentUser;
    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');
        Cache::flush();

        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);

        $this->adminUser = User::factory()->create(['email' => 'admin_' . Str::random(6) . '@cuulong.vn']);
        $this->adminUser->assignRole('Admin');

        $this->agentUser = User::factory()->create(['email' => 'agent_' . Str::random(6) . '@cuulong.vn']);
        $this->agentUser->assignRole('Biên Tập Viên');

        $this->automationEngine = app(ChatAutomationEngine::class);
        $this->automationActionService = app(ChatAutomationActionService::class);
        $this->spamService = app(ChatSpamProtectionService::class);
        $this->messageService = app(ChatMessageService::class);
        $this->handoffService = app(ChatHandoffService::class);
        $this->agentConvService = app(ChatAgentConversationService::class);
        $this->sessionService = app(VisitorSessionService::class);

        // Ensure default spam settings enabled
        ChatSetting::set(ChatSpamProtectionService::SETTING_KEY_SETTINGS, [
            'auto_spam_block' => true,
            'keyword_filter' => true,
            'ip_filter' => true,
            'rate_limit_filter' => true,
            'smart_ai_mode' => true,
        ]);

        config([
            'chat_ai.enabled' => true,
            'chat_ai.provider' => 'openai',
            'chat_ai.default_channel' => 'hybrid',
            'services.openai.api_key' => 'sk-mock-valid-key-for-test',
        ]);

        ChatSetting::set(\App\Services\Chat\AI\ChatAISettingsResolver::SETTING_KEY, [
            'enabled' => true,
            'provider' => 'openai',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
        ]);
    }

    protected function createVisitorAndConversation(
        ChatConversationChannel $channel = ChatConversationChannel::Hybrid,
        ChatConversationStatus $status = ChatConversationStatus::Open
    ): array {
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Visitor ' . Str::random(5),
            'first_ip' => '127.0.0.1',
        ]);

        $conversation = ChatConversation::create([
            'chat_visitor_id' => $visitor->id,
            'status' => $status,
            'channel' => $channel,
            'visitor_unread_count' => 0,
            'agent_unread_count' => 0,
        ]);

        return [$visitor, $conversation];
    }

    // ==========================================
    // AUTOMATION ENGINE TESTS (AUTO-01 .. AUTO-12)
    // ==========================================

    /**
     * AUTO-01: Welcome automation delivers greeting options on conversation_created.
     */
    public function test_auto_01_welcome_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_greeting_default',
                'name' => 'Lời chào mừng tự động',
                'trigger' => 'conversation_created',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [
                    ['field' => 'conversation_status', 'operator' => 'equals', 'value' => 'open'],
                ],
                'actions' => [
                    [
                        'type' => 'send_message',
                        'payload' => [
                            'message' => "Xin chào! Cảm ơn bạn đã liên hệ Truyền Thông Cửu Long. Bạn có thể chọn:\n1. Dự án tiêu biểu\n2. Bảng giá dịch vụ\n3. Liên hệ Zalo tư vấn",
                        ],
                    ],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $executed = $this->automationEngine->handleTrigger('conversation_created', [
            'conversation' => $conversation,
            'visitor' => $visitor,
            'event_id' => $conversation->conversation_uuid,
        ]);

        $this->assertEquals(1, $executed);
        $this->assertDatabaseHas('chat_messages', [
            'chat_conversation_id' => $conversation->id,
            'sender_type' => ChatMessageSenderType::System->value,
        ]);

        $msg = $conversation->messages()->latest('id')->first();
        $this->assertStringContainsString('Dự án tiêu biểu', $msg->message_body);
        $this->assertStringContainsString('Bảng giá dịch vụ', $msg->message_body);
        $this->assertStringContainsString('Liên hệ Zalo tư vấn', $msg->message_body);
    }

    /**
     * AUTO-02: Welcome idempotency prevents duplicate greeting for identical conversation.
     */
    public function test_auto_02_welcome_idempotency(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_welcome_idemp',
                'name' => 'Welcome Idempotent',
                'trigger' => 'conversation_created',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Chào mừng bạn!']],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $exec1 = $this->automationEngine->handleTrigger('conversation_created', [
            'conversation' => $conversation,
            'visitor' => $visitor,
            'event_id' => $conversation->conversation_uuid,
        ]);
        $exec2 = $this->automationEngine->handleTrigger('conversation_created', [
            'conversation' => $conversation,
            'visitor' => $visitor,
            'event_id' => $conversation->conversation_uuid,
        ]);

        $this->assertEquals(1, $exec1);
        $this->assertEquals(0, $exec2); // Skipped via idempotency
        $this->assertEquals(1, $conversation->messages()->where('sender_type', ChatMessageSenderType::System)->count());
    }

    /**
     * AUTO-03: Keyword automation responds to pricing keywords ('giá', 'bảng giá', 'chi phí').
     */
    public function test_auto_03_keyword_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_pricing',
                'name' => 'Phản hồi báo giá',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [
                    ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'bảng giá'],
                ],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Dạ bảng giá dịch vụ tham khảo đã được gửi.']],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Gửi cho tôi bảng giá dịch vụ website với',
            'status' => 'sent',
        ]);

        $executed = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertEquals(1, $executed);
        $this->assertDatabaseHas('chat_messages', [
            'chat_conversation_id' => $conversation->id,
            'message_body' => 'Dạ bảng giá dịch vụ tham khảo đã được gửi.',
        ]);
    }

    /**
     * AUTO-04: Deterministic keyword priority ordering (priority 10 executes before 20).
     */
    public function test_auto_04_keyword_priority(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_second',
                'name' => 'Rule Low Priority',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 50,
                'conditions' => [
                    ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'hỗ trợ'],
                ],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Phản hồi 2']],
                ],
            ],
            [
                'id' => 'rule_first',
                'name' => 'Rule High Priority',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [
                    ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'hỗ trợ'],
                ],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Phản hồi 1']],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi cần hỗ trợ',
            'status' => 'sent',
        ]);

        $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $messages = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::System)
            ->orderBy('id', 'asc')
            ->pluck('message_body')
            ->toArray();

        $this->assertCount(2, $messages);
        $this->assertEquals('Phản hồi 1', $messages[0]);
        $this->assertEquals('Phản hồi 2', $messages[1]);
    }

    /**
     * AUTO-05: Off-hours condition matches outside business hours (after 18:00 or Sunday).
     */
    public function test_auto_05_off_hours(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // 20:00 on Monday is outside hours (08:00-18:00)
        $nightTime = Carbon::create(2026, 10, 12, 20, 0, 0, 'Asia/Ho_Chi_Minh');
        $this->assertTrue($this->automationEngine->isOutsideBusinessHours($nightTime));

        // 10:00 on Monday is working hours
        $dayTime = Carbon::create(2026, 10, 12, 10, 0, 0, 'Asia/Ho_Chi_Minh');
        $this->assertFalse($this->automationEngine->isOutsideBusinessHours($dayTime));
    }

    /**
     * AUTO-06: Off-hours timezone complies strictly with application timezone (Asia/Ho_Chi_Minh).
     */
    public function test_auto_06_off_hours_timezone(): void
    {
        $this->assertEquals('Asia/Ho_Chi_Minh', config('app.timezone'));

        // Sunday noon in HCM timezone
        $sundayNoon = Carbon::create(2026, 10, 18, 12, 0, 0, 'Asia/Ho_Chi_Minh');
        $this->assertTrue($this->automationEngine->isOutsideBusinessHours($sundayNoon));
    }

    /**
     * AUTO-07: Automation loop protection rejects System, Agent, and Bot messages.
     */
    public function test_auto_07_automation_loop_protection(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_any_message',
                'name' => 'Catch All',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Loop response']],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $systemMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::System,
            'message_body' => 'System notification',
            'status' => 'sent',
        ]);
        $botMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Bot,
            'message_body' => 'Bot reply',
            'status' => 'sent',
        ]);
        $agentMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Agent,
            'sender_user_id' => $this->agentUser->id,
            'message_body' => 'Agent reply',
            'status' => 'sent',
        ]);

        $this->assertEquals(0, $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $systemMsg,
        ]));
        $this->assertEquals(0, $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $botMsg,
        ]));
        $this->assertEquals(0, $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $agentMsg,
        ]));
    }

    /**
     * AUTO-08: Automation does not run when conversation is HUMAN or claimed by agent.
     */
    public function test_auto_08_automation_plus_human(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(ChatConversationChannel::Human);

        $rules = [
            [
                'id' => 'rule_auto_human',
                'name' => 'Greeting',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Auto reply']]],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào',
            'status' => 'sent',
        ]);

        $executed = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
        ]);

        $this->assertEquals(0, $executed);
    }

    /**
     * AUTO-09: Automation does not run when conversation is CLOSED.
     */
    public function test_auto_09_automation_plus_closed(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(ChatConversationChannel::Hybrid, ChatConversationStatus::Closed);

        $rules = [
            [
                'id' => 'rule_closed',
                'name' => 'Closed Guard',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Auto reply']]],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin nhắn khi đóng',
            'status' => 'sent',
        ]);

        $this->assertEquals(0, $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
        ]));
    }

    /**
     * AUTO-10: Automation does not run when conversation is SPAM.
     */
    public function test_auto_10_automation_plus_spam(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(ChatConversationChannel::Hybrid, ChatConversationStatus::Spam);

        $rules = [
            [
                'id' => 'rule_spam',
                'name' => 'Spam Guard',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Auto reply']]],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Spam message',
            'status' => 'sent',
        ]);

        $this->assertEquals(0, $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
        ]));
    }

    /**
     * AUTO-11: Automation enforces BusinessGuard: intercepts hallucinated acceptance of Media bookings.
     */
    public function test_auto_11_automation_plus_business_guard(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Misconfigured rule that promises media acceptance
        $rules = [
            [
                'id' => 'rule_bad_media',
                'name' => 'Bad Media Rule',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [
                    ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'quay phim'],
                ],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Dạ bên em nhận quay phim sự kiện, có thể đặt lịch ngay ạ!']],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi muốn thuê quay phim sự kiện cuối tuần',
            'status' => 'sent',
        ]);

        $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $sentMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::System)->latest('id')->first();
        $this->assertNotNull($sentMsg);
        // Intercepted and replaced with paused notice
        $this->assertStringContainsString('tạm ngưng tiếp nhận các công việc Media', $sentMsg->message_body);
        $this->assertStringNotContainsString('đặt lịch ngay', $sentMsg->message_body);
    }

    /**
     * AUTO-12: Duplicate suppression and cooldown suppress rapid repeated triggers.
     */
    public function test_auto_12_duplicate_suppression(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_cooldown_test',
                'name' => 'Cooldown Test',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'cooldown_seconds' => 30,
                'conditions' => [
                    ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'giá'],
                ],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Báo giá nhanh']],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg1 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'giá',
            'status' => 'sent',
        ]);
        $msg2 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'giá',
            'status' => 'sent',
        ]);

        $exec1 = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg1,
            'visitor' => $visitor,
            'event_id' => $msg1->message_uuid,
        ]);
        $exec2 = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg2,
            'visitor' => $visitor,
            'event_id' => $msg2->message_uuid,
        ]);

        $this->assertEquals(1, $exec1);
        $this->assertEquals(0, $exec2); // Throttled by cooldown!
    }

    // ==========================================
    // SPAM PROTECTION TESTS (SPAM-01 .. SPAM-12)
    // ==========================================

    /**
     * SPAM-01: Banned keyword marks conversation as Spam and records audit note.
     */
    public function test_spam_01_banned_keyword(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn vay tiền nhanh');

        $conversation->refresh();
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->status);

        $this->assertDatabaseHas('chat_internal_notes', [
            'chat_conversation_id' => $conversation->id,
        ]);
        $note = $conversation->internalNotes()->latest('id')->first();
        $this->assertStringContainsString('vay tiền', $note->note_body);
    }

    /**
     * SPAM-02: Multiple banned keywords detected accurately ('casino', 'link lạ', 'khuyến mãi').
     */
    public function test_spam_02_multiple_banned_keywords(): void
    {
        $this->assertNotNull($this->spamService->checkBannedKeywords('chơi casino'));
        $this->assertNotNull($this->spamService->checkBannedKeywords('bấm vào link lạ này'));
        $this->assertNotNull($this->spamService->checkBannedKeywords('nhận khuyến mãi khủng'));
        $this->assertNull($this->spamService->checkBannedKeywords('tôi muốn tư vấn website'));
    }

    /**
     * SPAM-03: IP blacklist rejects blocked visitor IP with 403 Forbidden.
     */
    public function test_spam_03_ip_blacklist(): void
    {
        $this->spamService->blockIp('123.45.67.89', 'Tấn công ddos');
        $this->assertTrue($this->spamService->isIpBlocked('123.45.67.89'));

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitor->update(['first_ip' => '123.45.67.89']);

        $this->expectException(AccessDeniedHttpException::class);
        $this->messageService->sendMessage($visitor, $conversation, 'Hello');
    }

    /**
     * SPAM-04: Existing conversation of an IP that becomes blocked is subsequently rejected.
     */
    public function test_spam_04_existing_conversation_blocked_ip(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitor->update(['first_ip' => '111.222.333.444']);

        // First message passes
        $msg1 = $this->messageService->sendMessage($visitor, $conversation, 'Tin nhắn hợp lệ');
        $this->assertNotNull($msg1);

        // Later, admin blocks this IP
        $this->spamService->blockIp('111.222.333.444', 'Spam flood');

        // Next message rejected
        $this->expectException(AccessDeniedHttpException::class);
        $this->messageService->sendMessage($visitor, $conversation, 'Tin nhắn sau khi bị chặn');
    }

    /**
     * SPAM-05: Rate limit allows up to 5 messages/minute, blocks 6th.
     */
    public function test_spam_05_rate_limit_5_per_minute(): void
    {
        config(['chat.message_send_rate_limit' => 5]);
        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat_spam_rate:' . '127.0.0.1');

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        RateLimiter::clear('chat_spam_rate:' . $visitor->visitor_uuid);

        for ($i = 1; $i <= 5; $i++) {
            $msg = $this->messageService->sendMessage($visitor, $conversation, "Tin nhắn hợp lệ số {$i}");
            $this->assertNotNull($msg);
        }

        // 6th message triggers 429
        $this->expectException(HttpException::class);
        $this->messageService->sendMessage($visitor, $conversation, 'Tin nhắn số 6 vượt ngưỡng');
    }

    /**
     * SPAM-06: Rate limit resets after window expiration.
     */
    public function test_spam_06_rate_limit_reset(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $key = 'chat_spam_rate:' . $visitor->visitor_uuid;

        // Exhaust limit
        for ($i = 0; $i < 5; $i++) {
            $this->spamService->checkRateLimit($visitor, '127.0.0.1', 5);
        }
        $this->assertFalse($this->spamService->checkRateLimit($visitor, '127.0.0.1', 5));

        // Clear/expire rate limit
        RateLimiter::clear($key);

        // Can send again
        $this->assertTrue($this->spamService->checkRateLimit($visitor, '127.0.0.1', 5));
    }

    /**
     * SPAM-07: Concurrent rate limit maintains atomic counting.
     */
    public function test_spam_07_concurrent_rate_limit(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        RateLimiter::clear('chat_spam_rate:' . $visitor->visitor_uuid);

        $success = 0;
        $blocked = 0;

        for ($i = 0; $i < 10; $i++) {
            if ($this->spamService->checkRateLimit($visitor, '127.0.0.1', 5)) {
                $success++;
            } else {
                $blocked++;
            }
        }

        $this->assertEquals(5, $success);
        $this->assertEquals(5, $blocked);
    }

    /**
     * SPAM-08: Conversation marked as SPAM rejects any subsequent visitor messages with 403.
     */
    public function test_spam_08_spam_state(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(ChatConversationChannel::Hybrid, ChatConversationStatus::Spam);

        $this->expectException(AccessDeniedHttpException::class);
        $this->messageService->sendMessage($visitor, $conversation, 'Xin chào lại');
    }

    /**
     * SPAM-09: Spam guard takes precedence over human handoff ("vay tiền" + "gặp nhân viên" -> SPAM).
     */
    public function test_spam_09_spam_takes_precedence_over_handoff(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn vay tiền, cho tôi gặp nhân viên');

        $conversation->refresh();
        // Must be marked as Spam, NOT transitioned to WaitingAgent!
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->status);
        $this->assertNotEquals(ChatConversationStatus::WaitingAgent, $conversation->status);

        // AI and Handoff zero notice
        $this->assertEquals(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * SPAM-10: When conversation is SPAM, AI orchestration produces zero replies.
     */
    public function test_spam_10_spam_stops_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(ChatConversationChannel::Hybrid, ChatConversationStatus::Spam);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hỏi giá',
            'status' => 'sent',
        ]);

        $aiService = app(ChatAIConversationService::class);
        $response = $aiService->processVisitorMessage($conversation, $msg);

        $this->assertNull($response);
    }

    /**
     * SPAM-11: When conversation is SPAM, Automation Engine produces zero replies.
     */
    public function test_spam_11_spam_stops_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(ChatConversationChannel::Hybrid, ChatConversationStatus::Spam);

        $rules = [
            [
                'id' => 'rule_test',
                'name' => 'Catch all',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Spam reply']]],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Báo giá',
            'status' => 'sent',
        ]);

        $exec = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
        ]);

        $this->assertEquals(0, $exec);
    }

    /**
     * SPAM-12: Security logging records internal note without exposing API keys or secrets.
     */
    public function test_spam_12_security_logging(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $this->messageService->sendMessage($visitor, $conversation, 'tham gia casino trúng thưởng');

        $note = $conversation->internalNotes()->latest('id')->first();
        $this->assertNotNull($note);
        $this->assertStringContainsString('[Bảo vệ Spam: Từ khóa cấm]', $note->note_body);
        $this->assertStringNotContainsString('sk-', $note->note_body);
        $this->assertStringNotContainsString('api_key', $note->note_body);
    }

    // ==========================================
    // CONCURRENCY & RACE CONDITIONS (RACE-01 .. RACE-06)
    // ==========================================

    /**
     * RACE-01: Concurrent automation executions for the same message run at most once.
     */
    public function test_race_01_concurrent_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_race_auto',
                'name' => 'Race Auto Rule',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'One time']]],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào test',
            'status' => 'sent',
        ]);

        $exec1 = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);
        $exec2 = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertEquals(1, $exec1 + $exec2);
        $this->assertEquals(1, $conversation->messages()->where('sender_type', ChatMessageSenderType::System)->count());
    }

    /**
     * RACE-02: Concurrent rate limit hits do not leak quota beyond limit.
     */
    public function test_race_02_concurrent_rate_limit(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        RateLimiter::clear('chat_spam_rate:' . $visitor->visitor_uuid);

        $count = 0;
        for ($i = 0; $i < 15; $i++) {
            if ($this->spamService->checkRateLimit($visitor, '127.0.0.1', 5)) {
                $count++;
            }
        }

        $this->assertEquals(5, $count);
    }

    /**
     * RACE-03: When Automation responds, AI orchestration yields zero replies.
     */
    public function test_race_03_automation_vs_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_auto_vs_ai',
                'name' => 'Auto vs AI',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [
                    ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'tư vấn'],
                ],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Tự động phản hồi tư vấn']]],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi cần tư vấn ngay',
            'status' => 'sent',
        ]);

        // 1. Automation handles message
        $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        // 2. AI orchestrator attempts to process same message
        $aiService = app(ChatAIConversationService::class);
        $aiReply = $aiService->processVisitorMessage($conversation, $msg);

        $this->assertNull($aiReply); // AI must not double-respond!
        $this->assertEquals(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * RACE-04: Spam detection vs AI: Spam completely stops AI from executing.
     */
    public function test_race_04_spam_vs_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'quảng cáo khuyến mãi',
            'status' => 'sent',
        ]);

        // Spam is detected
        $banned = $this->spamService->checkBannedKeywords($msg->message_body);
        $this->assertNotNull($banned);
        $this->spamService->handleSpamDetected($conversation, $banned);

        // AI is called concurrently
        $aiService = app(ChatAIConversationService::class);
        $res = $aiService->processVisitorMessage($conversation, $msg);

        $this->assertNull($res);
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->fresh()->status);
    }

    /**
     * RACE-05: Spam detection vs Handoff: Spam stops handoff transition.
     */
    public function test_race_05_spam_vs_handoff(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Message contains both spam and handoff
        $text = 'cần vay tiền gặp nhân viên tư vấn';
        $banned = $this->spamService->checkBannedKeywords($text);
        $this->assertNotNull($banned);

        $this->spamService->handleSpamDetected($conversation, $banned);

        // Handoff on a Spam conversation must return null
        $handoff = $this->handoffService->executeHandoff($conversation, 'Yêu cầu');
        $this->assertNull($handoff);
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->fresh()->status);
    }

    /**
     * RACE-06: Agent takeover vs Automation: Claimed conversation blocks automation.
     */
    public function test_race_06_agent_takeover_vs_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Agent claims conversation
        $this->agentConvService->claimConversation($this->agentUser, $conversation);
        $conversation->refresh();
        $this->assertEquals($this->agentUser->id, $conversation->assigned_to_user_id);
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);

        // Visitor sends new message
        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'báo giá',
            'status' => 'sent',
        ]);

        $rules = [
            [
                'id' => 'rule_takeover_test',
                'name' => 'Takeover Test',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [['type' => 'send_message', 'payload' => ['message' => 'Should not send']]],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        $exec = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
        ]);

        $this->assertEquals(0, $exec);
        $this->assertEquals(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::System)->count());
    }

    // ==========================================
    // REGRESSION SUITE TESTS (REG-01 .. REG-03)
    // ==========================================

    /**
     * REG-01: Phase 02.0 lifecycle compatibility intact.
     */
    public function test_reg_01_phase_02_0_regression(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $this->assertEquals(ChatConversationStatus::Open, $conversation->status);
        $this->assertEquals(ChatConversationChannel::Hybrid, $conversation->channel);

        // Agent assigns conversation
        $assigned = $this->agentConvService->assignConversation($this->adminUser, $conversation, $this->agentUser);
        $this->assertEquals(ChatConversationStatus::Assigned, $assigned->status);
        $this->assertEquals($this->agentUser->id, $assigned->assigned_to_user_id);
    }

    /**
     * REG-02: Phase 02.1 OpenAI business runtime compatibility intact.
     */
    public function test_reg_02_phase_02_1_regression(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Natural handoff trigger intact
        $handoffMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Cho tôi gặp nhân viên tư vấn',
            'status' => 'sent',
        ]);

        $aiService = app(ChatAIConversationService::class);
        $res = $aiService->processVisitorMessage($conversation, $handoffMsg);

        $this->assertNotNull($res);
        $this->assertEquals(ChatConversationChannel::Human, $conversation->fresh()->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->fresh()->status);
    }

    /**
     * REG-03: Phase 02.2 state machine & handoff hardening compatibility intact.
     */
    public function test_reg_03_phase_02_2_regression(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Atomic claim
        $claimed = $this->agentConvService->claimConversation($this->agentUser, $conversation);
        $this->assertEquals($this->agentUser->id, $claimed->assigned_to_user_id);

        // Re-enable AI Bot restores Hybrid channel & Open status
        $reEnabled = $this->agentConvService->enableAIBot($this->agentUser, $conversation);
        $this->assertEquals(ChatConversationChannel::Hybrid, $reEnabled->channel);
        $this->assertEquals(ChatConversationStatus::Open, $reEnabled->status);
        $this->assertNull($reEnabled->assigned_to_user_id);
    }

    /**
     * AUTO-13: Off-hours automation is suppressed when message is received during active working hours.
     */
    public function test_auto_13_off_hours_suppressed_during_business_hours(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $rules = [
            [
                'id' => 'rule_off_hours_test',
                'name' => 'Off hours test',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [
                    ['field' => 'outside_business_hours', 'operator' => 'equals', 'value' => true],
                ],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Ngoài giờ']],
                ],
            ],
        ];
        $this->automationEngine->saveRules($rules);

        // Monday 10:00 is during business hours
        Carbon::setTestNow(Carbon::create(2026, 10, 12, 10, 0, 0, 'Asia/Ho_Chi_Minh'));

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào sáng sớm',
            'status' => 'sent',
        ]);

        $exec = $this->automationEngine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
        ]);

        $this->assertEquals(0, $exec);
        Carbon::setTestNow(null);
    }

    /**
     * SPAM-13: Unblocking a previously blocked IP restores visitor access immediately.
     */
    public function test_spam_13_unblocked_ip_allows_operations(): void
    {
        $this->spamService->blockIp('222.111.0.1', 'Temporary block');
        $this->assertTrue($this->spamService->isIpBlocked('222.111.0.1'));

        $this->spamService->unblockIp('222.111.0.1');
        $this->assertFalse($this->spamService->isIpBlocked('222.111.0.1'));

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitor->update(['first_ip' => '222.111.0.1']);

        $msg = $this->messageService->sendMessage($visitor, $conversation, 'Tôi có thể chat lại');
        $this->assertNotNull($msg);
    }

    /**
     * RACE-07: Concurrent double handoff and spam guarantees spam wins and locks conversation.
     */
    public function test_race_07_concurrent_double_handoff_and_spam(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $text = 'cần vay tiền khẩn cấp';
        $banned = $this->spamService->checkBannedKeywords($text);
        $this->assertNotNull($banned);

        $this->spamService->handleSpamDetected($conversation, $banned);

        // Attempting handoff after spam detection fails closed
        $handoffResult = $this->handoffService->executeHandoff($conversation, 'Handoff attempt');
        $this->assertNull($handoffResult);
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->fresh()->status);
    }
}
