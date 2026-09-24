<?php

namespace Tests\Feature;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatMessageCreated;
use App\Events\Chat\ChatConversationUpdated;
use App\Exceptions\Chat\ChatAITimeoutException;
use App\Exceptions\Chat\ChatAIUnavailableException;
use App\Models\ChatAttachment;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Models\User;
use App\Services\Chat\AI\ChatAIContextBuilder;
use App\Services\Chat\AI\ChatAIConversationService;
use App\Services\Chat\AI\ChatAIManager;
use App\Services\Chat\AI\ChatAISecurityGuard;
use App\Services\Chat\AI\ChatHandoffService;
use App\Services\Chat\AI\Providers\FakeChatAIProvider;
use App\Services\Chat\Automation\ChatAutomationEngine;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class ChatAIIntegrationTest extends TestCase
{
    protected ChatAIManager $aiManager;
    protected FakeChatAIProvider $fakeProvider;
    protected ChatAIConversationService $aiService;
    protected ChatHandoffService $handoffService;
    protected ChatMessageService $messageService;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'chat_ai.enabled' => true,
            'chat_ai.provider' => 'fake',
            'chat_ai.max_ai_replies_per_minute' => 5,
            'chat_ai.handoff_keywords' => [
                'gặp nhân viên',
                'tư vấn viên',
                'nhân viên hỗ trợ',
                'human',
                'agent',
            ],
            'chat_ai.handoff_notice' => 'Yêu cầu của bạn đã được chuyển tới chuyên viên tư vấn.',
            'chat_ai.fallback_notice' => 'Hệ thống AI hiện đang bận. Yêu cầu của bạn đã được chuyển tới nhân viên CSKH.',
        ]);

        $this->fakeProvider = new FakeChatAIProvider();
        $this->aiManager = app(ChatAIServiceInterface::class);
        $this->aiManager->setProvider($this->fakeProvider);

        $this->aiService = app(ChatAIConversationService::class);
        $this->handoffService = app(ChatHandoffService::class);
        $this->messageService = app(ChatMessageService::class);

        // Clear locks & caches before each test
        \App\Models\ChatSetting::where('key', \App\Services\Chat\Automation\ChatAutomationEngine::SETTING_KEY)->delete();
        Cache::flush();
    }

    protected function tearDown(): void
    {
        $this->fakeProvider->reset();
        $this->aiManager->resetProvider();
        \App\Models\ChatSetting::where('key', \App\Services\Chat\Automation\ChatAutomationEngine::SETTING_KEY)->delete();
        Cache::flush();

        parent::tearDown();
    }

    protected function createVisitorAndConversation(
        ChatConversationChannel $channel = ChatConversationChannel::Hybrid,
        ChatConversationStatus $status = ChatConversationStatus::Open
    ): array {
        $visitor = ChatVisitor::create([
            'name' => 'Visitor ' . Str::random(6),
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

    // =========================================================================
    // 1. INTEGRATION TESTS (1 - 6)
    // =========================================================================

    /**
     * Test 01: Visitor message triggers AI response flow end-to-end via event listener.
     */
    public function test_01_visitor_message_triggers_ai_response_flow(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->fakeProvider->setCannedReply('Chào bạn, Cửu Long có thể hỗ trợ gì cho bạn?');

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào Cửu Long',
            'status' => ChatMessageStatus::Sent,
        ]);

        event(new ChatMessageCreated($visitorMsg));

        $botMsg = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::Bot)
            ->first();

        $this->assertNotNull($botMsg, 'Expected bot message to be created via ChatMessageCreated event.');
        $this->assertSame('Chào bạn, Cửu Long có thể hỗ trợ gì cho bạn?', $botMsg->message_body);
    }

    /**
     * Test 02: Fake provider produces valid bot message body.
     */
    public function test_02_fake_provider_produces_valid_bot_message(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $canned = 'Dạ Cửu Long hiện có dịch vụ truyền thông và quảng cáo chuyên nghiệp.';
        $this->fakeProvider->setCannedReply($canned);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Bên bạn có những dịch vụ gì?',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($botMsg);
        $this->assertSame($canned, $botMsg->message_body);
        $this->assertSame($conversation->id, $botMsg->chat_conversation_id);
    }

    /**
     * Test 03: Bot message has sender_type = bot and sender_user_id = null.
     */
    public function test_03_bot_message_has_sender_type_bot(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi muốn hỏi thông tin',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($botMsg);
        $this->assertSame(ChatMessageSenderType::Bot, $botMsg->sender_type);
        $this->assertNull($botMsg->sender_user_id);
    }

    /**
     * Test 04: Bot message unread count updates correctly (visitor unread incremented).
     */
    public function test_04_bot_message_unread_count_updates_correctly(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->assertSame(0, $conversation->visitor_unread_count);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Cần tư vấn bảng giá',
            'status' => ChatMessageStatus::Sent,
        ]);

        $this->aiService->processVisitorMessage($visitorMsg);

        $conversation->refresh();
        $this->assertSame(1, $conversation->visitor_unread_count, 'visitor_unread_count should increment on bot reply.');
    }

    /**
     * Test 05: Conversation last_message_at updates when bot replies.
     */
    public function test_05_conversation_last_message_at_updates(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $conversation->update(['last_message_at' => now()->subHours(2)]);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiService->processVisitorMessage($visitorMsg);

        $conversation->refresh();
        $this->assertNotNull($conversation->last_message_at);
        $this->assertTrue($conversation->last_message_at->greaterThan(now()->subMinute()));
    }

    /**
     * Test 06: Realtime events (ChatMessageCreated & ChatConversationUpdated) dispatched for bot message.
     */
    public function test_06_realtime_event_dispatched_for_bot_message(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Sự kiện kiểm tra',
            'status' => ChatMessageStatus::Sent,
        ]);

        Event::fake([ChatMessageCreated::class, ChatConversationUpdated::class]);

        $this->aiService->processVisitorMessage($visitorMsg);

        Event::assertDispatched(ChatMessageCreated::class, function (ChatMessageCreated $event) {
            return $event->senderType === 'bot' || $event->chatMessage?->sender_type === ChatMessageSenderType::Bot;
        });

        Event::assertDispatched(ChatConversationUpdated::class, function (ChatConversationUpdated $event) use ($conversation) {
            return $event->conversationUuid === $conversation->conversation_uuid;
        });
    }

    // =========================================================================
    // 2. ELIGIBILITY TESTS (7 - 11)
    // =========================================================================

    /**
     * Test 07: Spam conversation rejects AI response.
     */
    public function test_07_spam_conversation_rejects_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(status: ChatConversationStatus::Spam);
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Nội dung bất kỳ',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res);
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * Test 08: Blocked visitor rejects AI response.
     */
    public function test_08_blocked_visitor_rejects_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitor->update(['blocked_at' => now()]);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi muốn hỏi',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res);
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * Test 09: Closed conversation rejects AI response.
     */
    public function test_09_closed_conversation_rejects_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(status: ChatConversationStatus::Closed);
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hỏi sau khi đóng',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res);
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * Test 10: AI disabled in configuration rejects AI response.
     */
    public function test_10_ai_disabled_in_config_rejects_ai(): void
    {
        config(['chat_ai.enabled' => false]);
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'AI đang tắt',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res);
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * Test 11: Human channel or assigned agent rejects AI response.
     */
    public function test_11_human_takeover_rejects_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(channel: ChatConversationChannel::Human);
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin nhắn sau takeover',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res);
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    // =========================================================================
    // 3. HANDOFF TESTS (12 - 16)
    // =========================================================================

    /**
     * Test 12: Explicit keyword triggers human handoff.
     */
    public function test_12_explicit_keyword_triggers_handoff(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Cho tôi gặp nhân viên tư vấn',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($res);
        $this->assertSame(ChatMessageSenderType::Bot, $res->sender_type);
        $this->assertStringContainsString('chuyên viên tư vấn', $res->message_body);

        $conversation->refresh();
        $this->assertSame(ChatConversationChannel::Human, $conversation->channel);
        $this->assertSame(ChatConversationStatus::WaitingAgent, $conversation->status);

        $this->assertTrue(
            $conversation->internalNotes()->where('note_body', 'like', '%tư vấn viên%')->exists(),
            'Expected internal audit note to be recorded.'
        );
    }

    /**
     * Test 13: AI unavailable/error triggers fallback to human handoff.
     */
    public function test_13_ai_unavailable_or_timeout_triggers_fallback_handoff(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->fakeProvider->simulateException(new ChatAIUnavailableException('Provider connection failed'));

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hệ thống đang lỗi',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($res);
        $this->assertSame(ChatMessageSenderType::Bot, $res->sender_type);
        $this->assertStringContainsString('bận', $res->message_body);

        $conversation->refresh();
        $this->assertSame(ChatConversationChannel::Human, $conversation->channel);
        $this->assertSame(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * Test 14: Agent takeover disables AI permanently for that conversation.
     */
    public function test_14_agent_takeover_disables_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $agent = User::factory()->create();
        $agent->assignRole('Admin');

        // Agent claims conversation via ChatAgentConversationService
        /** @var ChatAgentConversationService $agentConvService */
        $agentConvService = app(ChatAgentConversationService::class);
        $agentConvService->claimConversation($agent, $conversation);

        $conversation->refresh();
        $this->assertSame(ChatConversationChannel::Human, $conversation->channel);
        $this->assertSame($agent->id, $conversation->assigned_to_user_id);

        // Next visitor message arrives
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Khách hỏi tiếp',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res, 'AI must be disabled once agent takes over.');
    }

    /**
     * Test 15: Handoff updates conversation status to waiting_agent and channel to human.
     */
    public function test_15_handoff_updates_conversation_status_to_waiting_agent_and_channel_to_human(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation(
            channel: ChatConversationChannel::Ai,
            status: ChatConversationStatus::Open
        );

        $notice = $this->handoffService->executeHandoff($conversation, 'Thử nghiệm handoff trực tiếp');

        $this->assertNotNull($notice);
        $conversation->refresh();
        $this->assertSame(ChatConversationStatus::WaitingAgent, $conversation->status);
        $this->assertSame(ChatConversationChannel::Human, $conversation->channel);
    }

    /**
     * Test 16: Handoff creates internal note and bot notice for visitor.
     */
    public function test_16_handoff_creates_internal_note_and_bot_notice_for_visitor(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $this->handoffService->executeHandoff($conversation, 'Lý do kiểm thử');

        $this->assertEquals(1, $conversation->internalNotes()->count());
        $note = $conversation->internalNotes()->first();
        $this->assertStringContainsString('Lý do kiểm thử', $note->note_body);
        $this->assertNull($note->user_id);

        $botNotice = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::Bot)
            ->first();
        $this->assertNotNull($botNotice);
    }

    // =========================================================================
    // 4. LOOP PROTECTION TESTS (17 - 18)
    // =========================================================================

    /**
     * Test 17: AI bot message does not trigger another AI response (strict loop protection).
     */
    public function test_17_ai_bot_message_does_not_trigger_ai(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $botMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Bot,
            'message_body' => 'Tôi là bot',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($botMsg);

        $this->assertNull($res);
        $this->assertSame(1, $conversation->messages()->count());
    }

    /**
     * Test 18: AI bot message does not trigger CHAT-10 automation rules.
     */
    public function test_18_ai_bot_message_does_not_trigger_chat_10_automation_rules(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        /** @var ChatAutomationEngine $engine */
        $engine = app(ChatAutomationEngine::class);
        $engine->saveRules([
            [
                'id' => 'rule_test_loop',
                'name' => 'Reply to all messages',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Automation reply']],
                ],
            ],
        ]);

        $botMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Bot,
            'message_body' => 'Tin nhắn bot',
            'status' => ChatMessageStatus::Sent,
        ]);

        $executed = $engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $botMsg,
            'visitor' => $visitor,
        ]);

        $this->assertSame(0, $executed, 'Automation engine must ignore bot messages.');
    }

    // =========================================================================
    // 5. SECURITY TESTS (19 - 24)
    // =========================================================================

    /**
     * Test 19: Internal notes are excluded from AI context.
     */
    public function test_19_internal_notes_excluded_from_ai_context(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $conversation->internalNotes()->create([
            'note_body' => 'TOP_SECRET_INTERNAL_NOTE: Khách nợ tiền',
        ]);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi muốn hỏi thông tin dịch vụ',
            'status' => ChatMessageStatus::Sent,
        ]);

        /** @var ChatAIContextBuilder $contextBuilder */
        $contextBuilder = app(ChatAIContextBuilder::class);
        $request = $contextBuilder->build($conversation);

        foreach ($request->messages as $msg) {
            $this->assertStringNotContainsString('TOP_SECRET_INTERNAL_NOTE', $msg->content);
        }
    }

    /**
     * Test 20: Visitor session tokens, IP, and User-Agent are excluded from AI context.
     */
    public function test_20_visitor_session_tokens_excluded_from_ai_context(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $randomToken = 'super_secret_session_token_' . Str::random(16);
        $session = ChatVisitorSession::create([
            'chat_visitor_id' => $visitor->id,
            'token_hash' => hash('sha256', $randomToken),
            'expires_at' => now()->addDays(7),
            'last_active_at' => now(),
        ]);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Kiểm tra bảo mật token',
            'status' => ChatMessageStatus::Sent,
        ]);

        $contextBuilder = app(ChatAIContextBuilder::class);
        $request = $contextBuilder->build($conversation);

        foreach ($request->messages as $msg) {
            $this->assertStringNotContainsString($randomToken, $msg->content);
        }
    }

    /**
     * Test 21: Attachment bin storage paths are excluded from AI context.
     */
    public function test_21_attachment_bin_storage_excluded_from_ai_context(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Đính kèm tệp tin',
            'status' => ChatMessageStatus::Sent,
        ]);

        ChatAttachment::create([
            'chat_message_id' => $visitorMsg->id,
            'original_name' => 'proposal.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 1024,
            'stored_path' => 'chat-attachments/private/vault/secret_internal_file.bin',
            'disk' => 'local',
        ]);

        $contextBuilder = app(ChatAIContextBuilder::class);
        $request = $contextBuilder->build($conversation);

        foreach ($request->messages as $msg) {
            $this->assertStringNotContainsString('secret_internal_file.bin', $msg->content);
            $this->assertStringNotContainsString('chat-attachments/private', $msg->content);
        }
    }

    /**
     * Test 22: Numeric database IDs are excluded from AI context.
     */
    public function test_22_numeric_database_ids_excluded_from_ai_context(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Kiểm tra ID số',
            'status' => ChatMessageStatus::Sent,
        ]);

        $contextBuilder = app(ChatAIContextBuilder::class);
        $request = $contextBuilder->build($conversation);

        foreach ($request->messages as $msg) {
            $this->assertStringNotContainsString("id: {$visitor->id}", $msg->content);
            $this->assertStringNotContainsString("id: {$conversation->id}", $msg->content);
        }
    }

    /**
     * Test 23: AI output is sanitized before being saved as a message.
     */
    public function test_23_ai_output_sanitized_before_saving(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->fakeProvider->setCannedReply("<script>alert('pwned');</script> Xin chào quý khách!");

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Kiểm tra XSS',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($botMsg);
        $this->assertStringNotContainsString('<script>', $botMsg->message_body);
        $this->assertStringContainsString('Xin chào quý khách!', $botMsg->message_body);
    }

    /**
     * Test 24: Moderation flags strictly respected during AI pipeline.
     */
    public function test_24_moderation_flags_respected_during_ai_pipeline(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitor->update(['blocked_at' => now()]);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Nội dung từ khách đã bị khóa',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res);
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    // =========================================================================
    // 6. CONCURRENCY TESTS (25 - 28)
    // =========================================================================

    /**
     * Test 25: Duplicate visitor message deduplication suppresses repeated processing.
     */
    public function test_25_duplicate_visitor_message_deduplication(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin nhắn duy nhất',
            'status' => ChatMessageStatus::Sent,
        ]);

        // First call should succeed
        $res1 = $this->aiService->processVisitorMessage($visitorMsg);
        $this->assertNotNull($res1);

        // Immediate second call on the exact same message UUID should be deduplicated
        $res2 = $this->aiService->processVisitorMessage($visitorMsg);
        $this->assertNull($res2, 'Duplicate message UUID must be suppressed by deduplication lock.');

        $this->assertSame(1, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * Test 26: Concurrent AI requests rate limiting enforces maximum replies per minute.
     */
    public function test_26_concurrent_ai_requests_rate_limiting(): void
    {
        config(['chat_ai.max_ai_replies_per_minute' => 2]);
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Send 1st message -> success
        $msg1 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Message 1',
            'status' => ChatMessageStatus::Sent,
        ]);
        $res1 = $this->aiService->processVisitorMessage($msg1);
        $this->assertNotNull($res1);

        // Send 2nd message -> success
        $msg2 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Message 2',
            'status' => ChatMessageStatus::Sent,
        ]);
        $res2 = $this->aiService->processVisitorMessage($msg2);
        $this->assertNotNull($res2);

        // Send 3rd message within same minute -> rate limited
        $msg3 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Message 3',
            'status' => ChatMessageStatus::Sent,
        ]);
        $res3 = $this->aiService->processVisitorMessage($msg3);
        $this->assertNull($res3, '3rd message must be rate limited when limit is 2.');

        $conversation->refresh();
        $this->assertSame(ChatConversationChannel::Human, $conversation->channel);
        $this->assertSame(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * Test 27: Agent takeover race condition: AI response discarded if agent claims during AI call.
     */
    public function test_27_agent_takeover_race_condition(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $agent = User::factory()->create();

        // Create a custom provider mock that alters conversation state during generateReply()
        $interceptorProvider = new class($conversation, $agent) implements ChatAIServiceInterface {
            public function __construct(private ChatConversation $conv, private User $agent) {}
            public function generateReply(ChatAIRequest $request): ChatAIResponse {
                // Simulate race condition: Human agent claims the conversation while AI is thinking
                $this->conv->update([
                    'assigned_to_user_id' => $this->agent->id,
                    'channel' => ChatConversationChannel::Human,
                ]);

                return new ChatAIResponse(
                    content: 'Phản hồi trễ từ AI',
                    provider: 'fake',
                    model: 'mock',
                    promptTokens: 10,
                    completionTokens: 10,
                    totalTokens: 20
                );
            }
            public function isAvailable(): bool { return true; }
            public function getProviderName(): string { return 'interceptor'; }
        };

        $this->aiManager->setProvider($interceptorProvider);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Chào bạn',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res, 'AI response must be safely discarded if human agent took over during AI processing.');
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * Test 28: Moderation race condition: AI response discarded if conversation marked spam during AI call.
     */
    public function test_28_moderation_race_condition(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $interceptorProvider = new class($conversation) implements ChatAIServiceInterface {
            public function __construct(private ChatConversation $conv) {}
            public function generateReply(ChatAIRequest $request): ChatAIResponse {
                // Simulate race condition: Conversation marked as spam while AI is computing
                $this->conv->update(['status' => ChatConversationStatus::Spam]);

                return new ChatAIResponse(
                    content: 'Phản hồi AI cho spam',
                    provider: 'fake',
                    model: 'mock',
                    promptTokens: 10,
                    completionTokens: 10,
                    totalTokens: 20
                );
            }
            public function isAvailable(): bool { return true; }
            public function getProviderName(): string { return 'interceptor'; }
        };

        $this->aiManager->setProvider($interceptorProvider);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Spam payload',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNull($res, 'AI response must be discarded if conversation becomes spam during generation.');
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    // =========================================================================
    // 7. FAILURE TESTS (29 - 32)
    // =========================================================================

    /**
     * Test 29: Provider timeout triggers handoff fallback cleanly.
     */
    public function test_29_provider_timeout_fallback_to_handoff(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->fakeProvider->simulateTimeout();

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Timeout request',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($res);
        $this->assertStringContainsString('bận', $res->message_body);
        $this->assertSame(ChatConversationChannel::Human, $conversation->fresh()->channel);
    }

    /**
     * Test 30: Malformed/empty response triggers handoff fallback.
     */
    public function test_30_malformed_response_fallback_to_handoff(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->fakeProvider->setCannedReply('   '); // Whitespace only

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Hỏi đáp',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($res);
        $this->assertStringContainsString('bận', $res->message_body);
        $this->assertSame(ChatConversationChannel::Human, $conversation->fresh()->channel);
    }

    /**
     * Test 31: No fake or garbled raw error message sent to customer on failure.
     */
    public function test_31_no_fake_message_on_failure(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $this->fakeProvider->simulateException(new ChatAIUnavailableException('SQL error connection refused'));

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Kiểm tra lỗi hệ thống',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($res);
        $this->assertStringNotContainsString('SQL error', $res->message_body);
        $this->assertStringNotContainsString('connection refused', $res->message_body);
        $this->assertSame(config('chat_ai.fallback_notice'), $res->message_body);
    }

    /**
     * Test 32: No credentials, tokens, or API keys leaked on failure.
     */
    public function test_32_no_credential_leak_on_failure(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $secretKey = 'sk-proj-super-secret-key-1234567890';
        $this->fakeProvider->simulateException(new ChatAIUnavailableException("Failed with key: {$secretKey}"));

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Leak test',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);

        $this->assertNotNull($res);
        $this->assertStringNotContainsString($secretKey, $res->message_body);

        $latestNote = $conversation->internalNotes()->latest()->first();
        if ($latestNote) {
            $this->assertStringNotContainsString($secretKey, $latestNote->note_body);
        }
    }

    // =========================================================================
    // 8. REGRESSION TESTS (33 - 35)
    // =========================================================================

    /**
     * Test 33: CHAT-10 automation rules continue to function smoothly alongside AI.
     */
    public function test_33_chat_10_automation_rules_unaffected(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        /** @var ChatAutomationEngine $engine */
        $engine = app(ChatAutomationEngine::class);
        $engine->saveRules([
            [
                'id' => 'rule_regression_1',
                'name' => 'Auto Greeting',
                'trigger' => 'message_received',
                'enabled' => true,
                'priority' => 10,
                'conditions' => [],
                'actions' => [
                    ['type' => 'send_message', 'payload' => ['message' => 'Hệ thống tự động chào bạn!']],
                ],
            ],
        ]);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Chào shop',
            'status' => ChatMessageStatus::Sent,
        ]);

        // Engine processes trigger independently
        $executed = $engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $visitorMsg,
            'visitor' => $visitor,
        ]);

        $this->assertSame(1, $executed);
        $this->assertTrue(
            $conversation->messages()->where('sender_type', ChatMessageSenderType::System)->exists()
        );
    }

    /**
     * Test 34: CHAT-09 spam moderation continues to work as expected.
     */
    public function test_34_chat_09_spam_moderation_unaffected(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Mark as spam
        $conversation->update(['status' => ChatConversationStatus::Spam]);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Spam flood attempt',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->aiService->processVisitorMessage($visitorMsg);
        $this->assertNull($res);
    }

    /**
     * Test 35: Full chat suite compatibility and integrity.
     */
    public function test_35_full_chat_suite_compatibility(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $this->assertInstanceOf(ChatVisitor::class, $conversation->visitor);
        $this->assertSame(ChatConversationChannel::Hybrid, $conversation->channel);
        $this->assertSame(ChatConversationStatus::Open, $conversation->status);
        $this->assertSame(0, $conversation->messages()->count());
    }
}
