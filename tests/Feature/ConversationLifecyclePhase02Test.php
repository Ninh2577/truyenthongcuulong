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
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\AI\ChatAIContextBuilder;
use App\Services\Chat\AI\ChatAIConversationService;
use App\Services\Chat\AI\ChatAIManager;
use App\Services\Chat\AI\Providers\FakeChatAIProvider;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatConversationService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class ConversationLifecyclePhase02Test extends TestCase
{
    protected FakeChatAIProvider $fakeProvider;
    protected ChatConversationService $conversationService;
    protected ChatMessageService $messageService;
    protected ChatAIConversationService $aiConversationService;
    protected ChatAIContextBuilder $contextBuilder;
    protected ChatAgentConversationService $agentConvService;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'chat_ai.enabled' => true,
            'chat_ai.provider' => 'fake',
            'chat_ai.default_channel' => 'hybrid',
            'chat_ai.max_ai_replies_per_minute' => 5,
            'chat_ai.handoff_keywords' => [
                'gặp nhân viên',
                'tư vấn viên',
                'nhân viên hỗ trợ',
                'người thật',
                'human',
                'agent',
            ],
            'chat_ai.handoff_notice' => 'Yêu cầu của bạn đã được chuyển tới chuyên viên tư vấn.',
            'chat_ai.fallback_notice' => 'Hệ thống AI hiện đang bận. Đã chuyển cho nhân viên.',
        ]);

        $this->fakeProvider = new FakeChatAIProvider();
        $this->app->instance(ChatAIServiceInterface::class, $this->fakeProvider);
        $this->app->instance('chat_ai.provider.fake', $this->fakeProvider);

        $this->conversationService = app(ChatConversationService::class);
        $this->messageService = app(ChatMessageService::class);
        $this->aiConversationService = app(ChatAIConversationService::class);
        $this->contextBuilder = app(ChatAIContextBuilder::class);
        $this->agentConvService = app(ChatAgentConversationService::class);

        Cache::flush();
    }

    protected function createVisitor(): ChatVisitor
    {
        return ChatVisitor::create([
            'name' => 'Visitor ' . Str::random(6),
            'first_ip' => '127.0.0.1',
        ]);
    }

    /**
     * TEST 01 — Conversation mới: Visitor mở Chat -> channel = hybrid (không được là human).
     */
    public function test_01_new_conversation_defaults_to_hybrid_channel(): void
    {
        $visitor = $this->createVisitor();

        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->assertNotNull($conversation);
        $this->assertEquals(ChatConversationChannel::Hybrid, $conversation->channel);
        $this->assertNotEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::Open, $conversation->status);
        $this->assertNull($conversation->assigned_to_user_id);
    }

    /**
     * TEST 02 — Visitor message: Visitor gửi message -> AI orchestration được phép chạy, không bị chặn bởi channel.
     */
    public function test_02_visitor_message_triggers_ai_flow_without_channel_block(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->assertEquals(ChatConversationChannel::Hybrid, $conversation->channel);

        // Visitor sends message (which dispatches ChatMessageCreated and triggers HandleAIChatOrchestration)
        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Xin chào công ty');

        // Verify visitor message exists
        $this->assertEquals('Xin chào công ty', $visitorMsg->message_body);
        $this->assertEquals(ChatMessageSenderType::Visitor, $visitorMsg->sender_type);

        // Retrieve bot response generated automatically via event orchestration without channel blocking
        $botMsg = $conversation->messages()
            ->where('sender_type', ChatMessageSenderType::Bot)
            ->first();

        // AI must not be blocked by channel and must produce a bot response
        $this->assertNotNull($botMsg, 'AI should respond when conversation is in hybrid channel.');
        $this->assertEquals(ChatMessageSenderType::Bot, $botMsg->sender_type);
        $this->assertNull($botMsg->sender_user_id);
        $this->assertDatabaseHas('chat_messages', [
            'id' => $botMsg->id,
            'sender_type' => 'bot',
        ]);
    }

    /**
     * TEST 03 — Bot context: Context của lượt tiếp theo phải chứa Bot message với role assistant.
     */
    public function test_03_bot_message_is_retained_in_ai_context_builder(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        // Turn 1: Visitor
        $msg1 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào!',
            'status' => ChatMessageStatus::Sent,
            'created_at' => now()->subSeconds(30),
        ]);

        // Turn 1: Bot reply
        $msg2 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Bot,
            'message_body' => 'Xin chào, tôi là trợ lý ảo. Tôi có thể hỗ trợ gì cho bạn?',
            'status' => ChatMessageStatus::Sent,
            'created_at' => now()->subSeconds(20),
        ]);

        // Turn 2: Visitor
        $msg3 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Bạn vừa nói gì?',
            'status' => ChatMessageStatus::Sent,
            'created_at' => now()->subSeconds(10),
        ]);

        $aiRequest = $this->contextBuilder->build($conversation);

        // Context must contain all 3 messages in chronological order
        $this->assertCount(3, $aiRequest->messages);

        // Turn 1 User
        $this->assertEquals('user', $aiRequest->messages[0]->role);
        $this->assertEquals('Xin chào!', $aiRequest->messages[0]->content);

        // Turn 1 Assistant (Bot message)
        $this->assertEquals('assistant', $aiRequest->messages[1]->role);
        $this->assertEquals('Xin chào, tôi là trợ lý ảo. Tôi có thể hỗ trợ gì cho bạn?', $aiRequest->messages[1]->content);

        // Turn 2 User
        $this->assertEquals('user', $aiRequest->messages[2]->role);
        $this->assertEquals('Bạn vừa nói gì?', $aiRequest->messages[2]->content);
    }

    /**
     * TEST 04 — Loop Protection: Bot message không trigger AI lần nữa.
     */
    public function test_04_bot_message_never_triggers_ai_loop(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        // Create a bot message
        $botMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Bot,
            'message_body' => 'Tôi là bot tự động.',
            'status' => ChatMessageStatus::Sent,
        ]);

        // Call AI processing on bot message
        $reply = $this->aiConversationService->processVisitorMessage($conversation, $botMsg);

        // Must strictly return null to prevent loop
        $this->assertNull($reply, 'Bot message must never trigger AI generation.');
    }

    /**
     * TEST 05 — Human Handoff: Khách yêu cầu người thật -> channel = human, status = waiting_agent.
     */
    public function test_05_human_handoff_transitions_to_human_channel_and_waiting_agent(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->assertEquals(ChatConversationChannel::Hybrid, $conversation->channel);

        // Visitor sends handoff trigger
        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn gặp nhân viên tư vấn');

        $noticeMsg = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);

        $conversation->refresh();

        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
        $this->assertNotNull($noticeMsg);
        $this->assertStringContainsString('chuyên viên tư vấn', $noticeMsg->message_body);
    }

    /**
     * TEST 06 — Agent Takeover: Agent claim -> assigned_to_user_id != null, channel = human.
     */
    public function test_06_agent_takeover_assigns_user_and_sets_human_channel(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $agent = User::factory()->create();
        $agent->assignRole('Admin');

        $claimedConv = $this->agentConvService->claimConversation($agent, $conversation);

        $this->assertEquals($agent->id, $claimedConv->assigned_to_user_id);
        $this->assertEquals(ChatConversationChannel::Human, $claimedConv->channel);
        $this->assertEquals(ChatConversationStatus::Assigned, $claimedConv->status);
    }

    /**
     * TEST 07 — AI STOP: Sau khi Agent takeover -> 0 AI response.
     */
    public function test_07_ai_stops_completely_after_agent_takeover(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $agent = User::factory()->create();
        $agent->assignRole('Admin');
        $this->agentConvService->claimConversation($agent, $conversation);

        $conversation->refresh();
        $this->assertNotNull($conversation->assigned_to_user_id);
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);

        // Visitor sends another message
        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Xin chào, bạn có ở đó không?');

        // AI must NOT reply
        $aiReply = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);

        $this->assertNull($aiReply, 'AI must return null and stop completely when assigned to an agent.');

        // No new bot messages in DB
        $botMsgCount = ChatMessage::where('chat_conversation_id', $conversation->id)
            ->where('sender_type', ChatMessageSenderType::Bot)
            ->count();
        $this->assertEquals(0, $botMsgCount);
    }

    /**
     * TEST 08 — Idempotency: Cùng một message_uuid chỉ tạo tối đa 1 AI response.
     */
    public function test_08_idempotency_prevents_duplicate_ai_responses(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Báo giá thiết kế website',
            'status' => ChatMessageStatus::Sent,
        ]);

        // Attempt 1: First invocation succeeds
        $res1 = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);
        $this->assertNotNull($res1);

        // Attempt 2: Duplicate concurrent invocation with same message UUID must be blocked by lock
        $res2 = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);
        $this->assertNull($res2, 'Duplicate message UUID trigger must be blocked by idempotency guard.');
    }

    /**
     * TEST 09 — Rate Limit: Vượt quá 5 AI replies/phút sẽ tự động chuyển sang Handoff.
     */
    public function test_09_rate_limiting_handoff_when_exceeding_limit(): void
    {
        config(['chat_ai.max_ai_replies_per_minute' => 2]);
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        // 1st message -> success
        $msg1 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Message 1',
            'status' => ChatMessageStatus::Sent,
        ]);
        $res1 = $this->aiConversationService->processVisitorMessage($conversation, $msg1);
        $this->assertNotNull($res1);

        // 2nd message -> success
        $msg2 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Message 2',
            'status' => ChatMessageStatus::Sent,
        ]);
        $res2 = $this->aiConversationService->processVisitorMessage($conversation, $msg2);
        $this->assertNotNull($res2);

        // 3rd message within same minute -> rate limited & handoff
        $msg3 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Message 3',
            'status' => ChatMessageStatus::Sent,
        ]);
        $res3 = $this->aiConversationService->processVisitorMessage($conversation, $msg3);

        // AI must not generate a standard bot reply, but rather handoff
        $this->assertNull($res3, '3rd message must be rate limited when limit is 2.');

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * TEST 10 — Existing conversation channel preservation: Giữ nguyên channel cũ (human, hybrid, ai).
     */
    public function test_10_existing_conversations_preserve_their_respective_channels(): void
    {
        $visitor1 = $this->createVisitor();
        $visitor2 = $this->createVisitor();
        $visitor3 = $this->createVisitor();

        // Seed existing conversations with specific channels
        $convHuman = ChatConversation::create([
            'chat_visitor_id' => $visitor1->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Human,
        ]);

        $convHybrid = ChatConversation::create([
            'chat_visitor_id' => $visitor2->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Hybrid,
        ]);

        $convAi = ChatConversation::create([
            'chat_visitor_id' => $visitor3->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Ai,
        ]);

        // getOrCreateActiveConversation must return existing active conversation with its original channel untouched
        $resHuman = $this->conversationService->getOrCreateActiveConversation($visitor1);
        $resHybrid = $this->conversationService->getOrCreateActiveConversation($visitor2);
        $resAi = $this->conversationService->getOrCreateActiveConversation($visitor3);

        $this->assertEquals(ChatConversationChannel::Human, $resHuman->channel);
        $this->assertEquals(ChatConversationChannel::Hybrid, $resHybrid->channel);
        $this->assertEquals(ChatConversationChannel::Ai, $resAi->channel);
    }
}
