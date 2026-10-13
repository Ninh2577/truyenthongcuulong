<?php

namespace Tests\Feature\ChatAI;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationUpdated;
use App\Events\Chat\ChatMessageCreated;
use App\Exceptions\Chat\ChatAIConfigurationException;
use App\Exceptions\Chat\ChatAITimeoutException;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\AI\ChatAIBusinessGuard;
use App\Services\Chat\AI\ChatAIContextBuilder;
use App\Services\Chat\AI\ChatAIConversationService;
use App\Services\Chat\AI\ChatAIManager;
use App\Services\Chat\AI\ChatAIPromptBuilder;
use App\Services\Chat\AI\ChatHandoffService;
use App\Services\Chat\AI\Providers\FakeChatAIProvider;
use App\Services\Chat\AI\Providers\OpenAIChatProvider;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatAgentMessageService;
use App\Services\Chat\ChatConversationService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tests\TestCase;

class BusinessRuleEngineHandoffHardeningTest extends TestCase
{
    protected ChatAIManager $aiManager;
    protected FakeChatAIProvider $fakeProvider;
    protected ChatAIConversationService $aiConversationService;
    protected ChatConversationService $conversationService;
    protected ChatMessageService $messageService;
    protected ChatAgentConversationService $agentConversationService;
    protected ChatAgentMessageService $agentMessageService;
    protected ChatHandoffService $handoffService;
    protected ChatAIBusinessGuard $businessGuard;

    protected function setUp(): void
    {
        parent::setUp();

        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);

        config([
            'chat_ai.enabled' => true,
            'chat_ai.provider' => 'fake',
            'chat_ai.default_channel' => 'hybrid',
            'chat_ai.max_ai_replies_per_minute' => 5,
            'chat_ai.openai.api_key' => 'test-dummy-api-key',
            'chat_ai.openai.model' => 'gpt-4o-mini',
            'chat_ai.timeout_seconds' => 15,
        ]);

        $this->fakeProvider = new FakeChatAIProvider();
        $this->aiManager = app(ChatAIServiceInterface::class);
        $this->aiManager->setProvider($this->fakeProvider);

        $this->aiConversationService = app(ChatAIConversationService::class);
        $this->conversationService = app(ChatConversationService::class);
        $this->messageService = app(ChatMessageService::class);
        $this->agentConversationService = app(ChatAgentConversationService::class);
        $this->agentMessageService = app(ChatAgentMessageService::class);
        $this->handoffService = app(ChatHandoffService::class);
        $this->businessGuard = app(ChatAIBusinessGuard::class);

        \App\Models\ChatSetting::where('key', \App\Services\Chat\AI\ChatAISettingsResolver::SETTING_KEY)->delete();
        Cache::flush();
    }

    protected function tearDown(): void
    {
        $this->fakeProvider->reset();
        $this->aiManager->resetProvider();
        \App\Models\ChatSetting::where('key', \App\Services\Chat\AI\ChatAISettingsResolver::SETTING_KEY)->delete();
        Cache::flush();

        parent::tearDown();
    }

    protected function createVisitor(): ChatVisitor
    {
        return ChatVisitor::create([
            'name' => 'Visitor ' . Str::random(6),
        ]);
    }

    protected function createAgent(string $name = 'Agent CSKH'): User
    {
        $user = User::factory()->create([
            'name' => $name,
            'email' => 'agent_' . Str::random(6) . '@cuulong.vn',
        ]);
        $user->assignRole('Admin');

        return $user;
    }

    // =========================================================================
    // BH-01 TO BH-26 TEST MATRIX
    // =========================================================================

    /**
     * BH-01: Visitor -> AI response in Hybrid + Open state.
     */
    public function test_bh_01_visitor_receives_ai_response(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ Cửu Long Media xin chào bạn!');

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Xin chào');

        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();
        $this->assertNotNull($botMsg);
        $this->assertSame('Dạ Cửu Long Media xin chào bạn!', $botMsg->message_body);
    }

    /**
     * BH-02: Visitor explicit keyword -> Handoff.
     */
    public function test_bh_02_visitor_explicit_keyword_handoff(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->messageService->sendMessage($visitor, $conversation, 'gặp nhân viên');

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * BH-03: Natural handoff ("cho tôi nói chuyện với người thật") -> Human.
     */
    public function test_bh_03_natural_handoff_transitions_to_human(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->messageService->sendMessage($visitor, $conversation, 'Cho tôi nói chuyện với người thật');

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * BH-04: Contract/legal inquiry -> Human.
     */
    public function test_bh_04_contract_or_legal_inquiry_triggers_human_handoff(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn hỏi về ký hợp đồng và điều khoản bồi thường');

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * BH-05: Agent takeover -> AI zero response.
     */
    public function test_bh_05_agent_takeover_causes_ai_zero_response(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $this->agentConversationService->claimConversation($agent, $conversation);

        $conversation->refresh();
        $this->assertEquals($agent->id, $conversation->assigned_to_user_id);
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);

        // Visitor sends message after takeover
        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Có ai ở đó không?');

        $reply = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);
        $this->assertNull($reply, 'AI must return null when conversation is claimed by agent.');
    }

    /**
     * BH-06: Agent message -> AI zero response & no recursion.
     */
    public function test_bh_06_agent_message_never_triggers_ai(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $this->agentConversationService->claimConversation($agent, $conversation);

        $initialBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();

        $this->agentMessageService->sendAgentMessage($agent, $conversation, 'Dạ em chào anh/chị, em là nhân viên hỗ trợ.');

        $newBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();
        $this->assertSame($initialBotCount, $newBotCount, 'Agent message must never trigger AI.');
    }

    /**
     * BH-07: Visitor reply after takeover -> AI zero response, handled by agent.
     */
    public function test_bh_07_visitor_reply_after_takeover_produces_zero_ai_response(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $this->agentConversationService->claimConversation($agent, $conversation);
        $this->agentMessageService->sendAgentMessage($agent, $conversation, 'Em có thể giúp gì cho anh chị?');

        $initialBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();

        // Visitor replies to agent
        $this->messageService->sendMessage($visitor, $conversation, 'Anh cần tư vấn dịch vụ.');

        $newBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();
        $this->assertSame($initialBotCount, $newBotCount, 'Visitor reply after agent takeover must never trigger AI.');
    }

    /**
     * BH-08: Close conversation -> AI zero response.
     */
    public function test_bh_08_close_conversation_stops_ai(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $this->agentConversationService->closeConversation($agent, $conversation);

        $conversation->refresh();
        $this->assertEquals(ChatConversationStatus::Closed, $conversation->status);

        $this->expectException(UnprocessableEntityHttpException::class);
        $this->messageService->sendMessage($visitor, $conversation, 'Tin nhắn gửi vào phòng chat đã đóng');
    }

    /**
     * BH-09: Spam conversation -> AI zero response.
     */
    public function test_bh_09_spam_conversation_stops_ai(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $this->agentConversationService->markAsSpam($agent, $conversation);

        $conversation->refresh();
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->status);

        // Direct AI processing assertion
        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Spam test body',
            'status' => ChatMessageStatus::Sent,
        ]);

        $reply = $this->aiConversationService->processVisitorMessage($conversation, $msg);
        $this->assertNull($reply, 'Spam conversation must yield null response.');
    }

    /**
     * BH-10: Enable AI -> AI remains idle until Visitor message.
     */
    public function test_bh_10_enable_ai_remains_idle_until_visitor_message(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        // Agent claims conversation (Human)
        $this->agentConversationService->claimConversation($agent, $conversation);
        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);

        $initialBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();

        // Agent enables AI bot
        $this->agentConversationService->enableAIBot($agent, $conversation);

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Hybrid, $conversation->channel);
        $this->assertNull($conversation->assigned_to_user_id);
        $this->assertEquals(ChatConversationStatus::Open, $conversation->status);

        // Verify zero immediate bot message created
        $newBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();
        $this->assertSame($initialBotCount, $newBotCount, 'Enabling AI must not create any immediate bot response.');
    }

    /**
     * BH-11: Enable AI -> next Visitor message can trigger AI.
     */
    public function test_bh_11_next_visitor_message_triggers_ai_after_re_enabling(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        // Agent claims and then re-enables AI
        $this->agentConversationService->claimConversation($agent, $conversation);
        $this->agentConversationService->enableAIBot($agent, $conversation);

        $this->fakeProvider->setCannedReply('Dạ em có thể hỗ trợ gì tiếp theo cho anh chị ạ?');

        // Next visitor message triggers AI
        $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn hỏi lại giá thiết bị');

        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertSame('Dạ em có thể hỗ trợ gì tiếp theo cho anh chị ạ?', $botMsg->message_body);
    }

    /**
     * BH-12: Double handoff -> One transition, strictly idempotent.
     */
    public function test_bh_12_double_handoff_is_strictly_idempotent(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        // Call executeHandoff twice
        $msg1 = $this->handoffService->executeHandoff($conversation, 'Lần 1');
        $this->assertNotNull($msg1);

        $initialNotes = ChatInternalNote::where('chat_conversation_id', $conversation->id)->count();
        $initialBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();

        $msg2 = $this->handoffService->executeHandoff($conversation, 'Lần 2');

        $newNotes = ChatInternalNote::where('chat_conversation_id', $conversation->id)->count();
        $newBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();

        $this->assertSame($initialNotes, $newNotes, 'Duplicate handoff must not duplicate internal notes.');
        $this->assertSame($initialBotCount, $newBotCount, 'Duplicate handoff must not duplicate bot messages.');
    }

    /**
     * BH-13: Double claim concurrency -> One successful Agent, second gets conflict.
     */
    public function test_bh_13_double_claim_conflict_protection(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agentA = $this->createAgent('Agent A');
        $agentB = $this->createAgent('Agent B');

        // Agent A claims first
        $claimedA = $this->agentConversationService->claimConversation($agentA, $conversation);
        $this->assertSame($agentA->id, $claimedA->assigned_to_user_id);

        // Agent B attempts to claim the same conversation -> ConflictHttpException
        $this->expectException(ConflictHttpException::class);
        $this->agentConversationService->claimConversation($agentB, $conversation);
    }

    /**
     * BH-14: Claim + AI orchestration race -> Zero AI response after claim.
     */
    public function test_bh_14_claim_and_ai_race_yields_zero_ai_response(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Câu hỏi của khách lúc agent đang claim',
            'status' => ChatMessageStatus::Sent,
        ]);

        // Agent claims conversation before AI transaction commits
        $this->agentConversationService->claimConversation($agent, $conversation);

        // AI service processVisitorMessage must re-check assignment and return null
        $reply = $this->aiConversationService->processVisitorMessage($conversation, $msg);
        $this->assertNull($reply, 'AI must cancel reply when agent claims conversation concurrently.');
    }

    /**
     * BH-15: Bot message -> No AI loop.
     */
    public function test_bh_15_bot_message_never_triggers_ai_loop(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $botMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Bot,
            'message_body' => 'Phản hồi từ Bot',
            'status' => ChatMessageStatus::Sent,
        ]);

        $initialCount = $conversation->messages()->count();
        event(new ChatMessageCreated($botMsg));

        $this->assertSame($initialCount, $conversation->messages()->count());
    }

    /**
     * BH-16: Internal note -> No AI trigger.
     */
    public function test_bh_16_internal_note_never_triggers_ai(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $note = ChatInternalNote::create([
            'chat_conversation_id' => $conversation->id,
            'user_id' => $agent->id,
            'note_body' => 'Ghi chú nội bộ',
        ]);

        $botCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();
        $this->assertSame(0, $botCount);
    }

    /**
     * BH-17: Agent message -> No AI trigger.
     */
    public function test_bh_17_agent_message_never_triggers_ai(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        $agentMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Agent,
            'sender_user_id' => $agent->id,
            'message_body' => 'Chào anh chị',
            'status' => ChatMessageStatus::Sent,
        ]);

        event(new ChatMessageCreated($agentMsg));
        $botCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();
        $this->assertSame(0, $botCount);
    }

    /**
     * BH-18: Rate limit -> Handoff.
     */
    public function test_bh_18_rate_limit_triggers_handoff(): void
    {
        config(['chat_ai.max_ai_replies_per_minute' => 1]);

        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Reply 1');

        $m1 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Msg 1',
            'status' => ChatMessageStatus::Sent,
        ]);
        $this->aiConversationService->processVisitorMessage($conversation, $m1);

        $m2 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Msg 2 vượt rate limit',
            'status' => ChatMessageStatus::Sent,
        ]);
        $r2 = $this->aiConversationService->processVisitorMessage($conversation, $m2);
        $this->assertNull($r2);

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * BH-19: OpenAI timeout -> Fallback with Hotline/Zalo notice.
     */
    public function test_bh_19_openai_timeout_graceful_fallback(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->simulateTimeout();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Test timeout',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiConversationService->processVisitorMessage($conversation, $msg);
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('0939 363 262', $botMsg->message_body);

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * BH-20: Missing API key -> Fail closed.
     */
    public function test_bh_20_missing_api_key_fails_closed(): void
    {
        $provider = new OpenAIChatProvider(apiKey: '');
        $this->assertFalse($provider->isAvailable());

        $this->expectException(ChatAIConfigurationException::class);
        $provider->generateReply(new ChatAIRequest(messages: []));
    }

    /**
     * BH-21: BusinessGuard still intercepts hallucinated Media acceptance.
     */
    public function test_bh_21_business_guard_intercepts_hallucinated_acceptance(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ vâng, bên em nhận quay phim sự kiện chuyên nghiệp cho anh chị ạ!');

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Bên bạn có quay phim không?',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiConversationService->processVisitorMessage($conversation, $msg);
        $this->assertNotNull($botMsg);
        $this->assertStringNotContainsString('bên em nhận quay phim', $botMsg->message_body);
        $this->assertStringContainsString('tạm ngưng nhận các job Media', $botMsg->message_body);
        $this->assertStringContainsString('0939 363 262', $botMsg->message_body);
    }

    /**
     * BH-22: Business pricing rule unchanged.
     */
    public function test_bh_22_business_pricing_rule_unchanged(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Mức giá tham khảo flycam từ 1.000.000đ – 1.500.000đ/lần. Hiện tại công ty đang tạm ngưng nhận job Media ạ.');

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Báo giá flycam',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiConversationService->processVisitorMessage($conversation, $msg);
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('giá tham khảo', mb_strtolower($botMsg->message_body, 'UTF-8'));
    }

    /**
     * BH-23: Sensitive context excluded.
     */
    public function test_bh_23_sensitive_context_excluded(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);
        $agent = $this->createAgent();

        ChatInternalNote::create([
            'chat_conversation_id' => $conversation->id,
            'user_id' => $agent->id,
            'note_body' => 'BÍ MẬT NỘI BỘ DO NOT LEAK',
        ]);

        $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin nhắn hợp lệ của khách',
            'status' => ChatMessageStatus::Sent,
        ]);

        $builder = app(ChatAIContextBuilder::class);
        $req = $builder->build($conversation);

        $this->assertNotEmpty($req->messages);
        foreach ($req->messages as $m) {
            $this->assertStringNotContainsString('BÍ MẬT NỘI BỘ', $m->content);
        }
    }

    /**
     * BH-24: Secret leak audit.
     */
    public function test_bh_24_secret_leak_audit(): void
    {
        $secret = 'sk-proj-test-security-secret-key-12345';
        config(['chat_ai.openai.api_key' => $secret]);

        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $res = $this->getJson("/api/chat/conversations/{$conversation->conversation_uuid}");
        $this->assertStringNotContainsString($secret, (string) $res->getContent());
    }

    /**
     * BH-25: Phase 02.0 regression compatibility.
     */
    public function test_bh_25_phase_02_0_regression_compatibility(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->assertEquals(ChatConversationChannel::Hybrid, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::Open, $conversation->status);
    }

    /**
     * BH-26: Phase 02.1 regression compatibility.
     */
    public function test_bh_26_phase_02_1_regression_compatibility(): void
    {
        $prompt = ChatAIPromptBuilder::getSystemPrompt();
        $this->assertStringContainsString('TẠM NGƯNG NHẬN TẤT CẢ CÁC JOB MEDIA', $prompt);
        $this->assertStringContainsString('0939 363 262', $prompt);
    }
}
