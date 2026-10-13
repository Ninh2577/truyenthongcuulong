<?php

namespace Tests\Feature\ChatAI;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatMessageCreated;
use App\Exceptions\Chat\ChatAIConfigurationException;
use App\Exceptions\Chat\ChatAITimeoutException;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Services\Chat\AI\ChatAIBusinessGuard;
use App\Services\Chat\AI\ChatAIContextBuilder;
use App\Services\Chat\AI\ChatAIConversationService;
use App\Services\Chat\AI\ChatAIManager;
use App\Services\Chat\AI\ChatAIPromptBuilder;
use App\Services\Chat\AI\ChatHandoffService;
use App\Services\Chat\AI\Providers\FakeChatAIProvider;
use App\Services\Chat\AI\Providers\OpenAIChatProvider;
use App\Services\Chat\ChatConversationService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class ChatAIRuntimeBusinessTest extends TestCase
{
    protected ChatAIManager $aiManager;
    protected FakeChatAIProvider $fakeProvider;
    protected ChatAIConversationService $aiConversationService;
    protected ChatConversationService $conversationService;
    protected ChatMessageService $messageService;
    protected ChatHandoffService $handoffService;
    protected ChatAIBusinessGuard $businessGuard;

    protected function setUp(): void
    {
        parent::setUp();

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

    // =========================================================================
    // AI-01 TO AI-14 TEST SUITE
    // =========================================================================

    /**
     * AI-01: Visitor gửi "Xin chào" -> AI trả lời bằng tiếng Việt lịch sự, hỗ trợ thông tin.
     */
    public function test_ai_01_visitor_greeting_receives_vietnamese_ai_response(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ xin chào bạn! Cửu Long Media có thể hỗ trợ gì cho bạn hôm nay ạ? Hotline/Zalo liên hệ: 0939 363 262.');

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Xin chào');

        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('Cửu Long Media', $botMsg->message_body);
        $this->assertStringContainsString('0939 363 262', $botMsg->message_body);
        $this->assertEquals(ChatMessageSenderType::Bot, $botMsg->sender_type);
    }

    /**
     * AI-02: Khách hỏi "Bên mình có nhận quay phim sự kiện không?"
     * Expected: AI thông báo Cửu Long Media đang tạm ngưng nhận job Media.
     */
    public function test_ai_02_media_job_inquiry_notifies_media_suspension(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ hiện tại Cửu Long Media đang tạm ngưng nhận các job Media bao gồm quay phim sự kiện, chụp ảnh và dựng video ạ. Bạn vui lòng liên hệ Zalo 0939 363 262 để được hỗ trợ chi tiết.');

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Bên mình có nhận quay phim sự kiện không?');

        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('tạm ngưng', $botMsg->message_body);
        $this->assertStringContainsString('0939 363 262', $botMsg->message_body);
    }

    /**
     * AI-03: Khách hỏi "Giá flycam bao nhiêu?"
     * Expected: Giá tham khảo 1.000.000đ – 1.500.000đ/lần và phải có cụm từ "giá tham khảo".
     */
    public function test_ai_03_flycam_pricing_quotes_reference_price(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ mức giá tham khảo cho dịch vụ bay flycam là từ 1.000.000đ – 1.500.000đ / lần. Tuy nhiên hiện tại Cửu Long Media đang tạm ngưng nhận job Media ạ. Quý khách vui lòng liên hệ Zalo 0939 363 262 để biết thêm chi tiết.');

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Giá flycam bao nhiêu?');

        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('giá tham khảo', mb_strtolower($botMsg->message_body, 'UTF-8'));
        $this->assertStringContainsString('1.000.000', $botMsg->message_body);
        $this->assertStringContainsString('1.500.000', $botMsg->message_body);
    }

    /**
     * AI-04: Khách hỏi "Giá quay phim?"
     * Expected: Giá tham khảo 1.500.000đ – 2.000.000đ/máy và vẫn phải thông báo tạm ngưng Media.
     */
    public function test_ai_04_filming_pricing_quotes_reference_price_and_suspension(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ mức giá tham khảo cho thiết bị quay phim là từ 1.500.000đ – 2.000.000đ / máy. Lưu ý hiện tại công ty đang tạm ngưng nhận các job Media. Bạn có thể trao đổi thêm qua Zalo 0939 363 262 ạ.');

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Giá quay phim?');

        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('1.500.000', $botMsg->message_body);
        $this->assertStringContainsString('2.000.000', $botMsg->message_body);
        $this->assertStringContainsString('tạm ngưng', $botMsg->message_body);
    }

    /**
     * AI-05: Khách gửi "Tôi muốn gặp nhân viên"
     * Expected: Tự động chuyển giao Handoff: channel = human, status = waiting_agent, AI dừng.
     */
    public function test_ai_05_visitor_requests_human_triggers_handoff_and_stops_ai(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn gặp nhân viên');

        $conversation->refresh();

        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);

        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('chuyên viên tư vấn', $botMsg->message_body);
    }

    /**
     * AI-06: Khách gửi "Tôi muốn hỏi về hợp đồng"
     * Expected: Tự động kích hoạt Handoff nhân viên vì liên quan đến pháp lý/hợp đồng.
     */
    public function test_ai_06_contract_or_legal_inquiry_triggers_human_handoff(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn hỏi về hợp đồng và điều khoản');

        $conversation->refresh();

        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * AI-07: Context Multi-turn Retention:
     * Lượt 1: "Tôi ở Cần Thơ, cần quay phim." -> Lượt 2: "Còn flycam thì sao?"
     * Expected: Context gửi sang AI chứa toàn bộ lịch sử và System Prompt đầy đủ.
     */
    public function test_ai_07_context_multi_turn_maintains_history_and_system_prompt(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ Cần Thơ bên em hiện tạm ngưng nhận job quay phim ạ.');

        // Lượt 1
        $this->messageService->sendMessage($visitor, $conversation, 'Tôi ở Cần Thơ, cần quay phim.');

        // Lượt 2
        $this->fakeProvider->setCannedReply('Dạ đối với flycam, Cửu Long Media cũng đang tạm ngưng nhận dịch vụ này luôn ạ.');
        $this->messageService->sendMessage($visitor, $conversation, 'Còn flycam thì sao?');

        // Verify Context Builder output
        $builder = app(ChatAIContextBuilder::class);
        $systemPrompt = ChatAIPromptBuilder::getSystemPrompt();
        $aiRequest = $builder->build($conversation, $systemPrompt);

        $this->assertNotNull($aiRequest->systemPrompt);
        $this->assertStringContainsString('TẠM NGƯNG NHẬN TẤT CẢ CÁC JOB MEDIA', $aiRequest->systemPrompt);

        // Check messages count and sequence
        $roles = array_map(fn ($m) => $m->role, $aiRequest->messages);
        $contents = array_map(fn ($m) => $m->content, $aiRequest->messages);

        $this->assertContains('Tôi ở Cần Thơ, cần quay phim.', $contents);
        $this->assertContains('Còn flycam thì sao?', $contents);
        $this->assertContains('user', $roles);
        $this->assertContains('assistant', $roles);
    }

    /**
     * AI-08: Loop Protection Invariant:
     * Bot tạo message mới tuyệt đối không trigger AI lặp lại.
     */
    public function test_ai_08_bot_message_never_triggers_ai_loop(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $botMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Bot,
            'message_body' => 'Tin nhắn phản hồi từ Bot',
            'status' => ChatMessageStatus::Sent,
        ]);

        $initialBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();

        event(new ChatMessageCreated($botMsg));

        $newBotCount = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count();
        $this->assertEquals($initialBotCount, $newBotCount, 'Bot message must never trigger AI loop.');
    }

    /**
     * AI-09: Idempotency Protection:
     * Cùng một message_uuid gửi hai lần -> Chỉ sinh đúng 1 response duy nhất.
     */
    public function test_ai_09_idempotency_prevents_duplicate_ai_responses(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào lần 1',
            'status' => ChatMessageStatus::Sent,
        ]);

        $this->fakeProvider->setCannedReply('Chào bạn!');

        // Lần 1: Thành công
        $firstReply = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);
        $this->assertNotNull($firstReply);

        // Lần 2 (Trùng message_uuid): Bị khóa atomic lock
        $duplicateReply = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);
        $this->assertNull($duplicateReply, 'Duplicate message_uuid must yield null response.');
    }

    /**
     * AI-10: Rate Limiting & Over-frequency Protection:
     * Gửi liên tiếp vượt quá 5 tin nhắn/phút -> AI dừng và tự động Handoff.
     */
    public function test_ai_10_rate_limit_exceeded_triggers_automatic_handoff(): void
    {
        config(['chat_ai.max_ai_replies_per_minute' => 2]);

        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Phản hồi tự động.');

        // Msg 1 (count = 1)
        $m1 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin 1',
            'status' => ChatMessageStatus::Sent,
        ]);
        $r1 = $this->aiConversationService->processVisitorMessage($conversation, $m1);
        $this->assertNotNull($r1);

        // Msg 2 (count = 2)
        $m2 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin 2',
            'status' => ChatMessageStatus::Sent,
        ]);
        $r2 = $this->aiConversationService->processVisitorMessage($conversation, $m2);
        $this->assertNotNull($r2);

        // Msg 3 (Exceeds rate limit: 2) -> Handoff
        $m3 = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin 3 vượt hạn mức',
            'status' => ChatMessageStatus::Sent,
        ]);
        $r3 = $this->aiConversationService->processVisitorMessage($conversation, $m3);

        $this->assertNull($r3);

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * AI-11: Provider Timeout Handling:
     * Khi OpenAI timeout, hệ thống fallback mượt mà, thông báo Zalo 0939 363 262, không lộ exception ra ngoài.
     */
    public function test_ai_11_timeout_handles_gracefully_with_zalo_notice_and_no_exception(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->simulateTimeout();

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tin nhắn khi timeout',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('0939 363 262', $botMsg->message_body);
        $this->assertStringNotContainsString('Exception', $botMsg->message_body);
        $this->assertStringNotContainsString('timeout', mb_strtolower($botMsg->message_body, 'UTF-8'));

        $conversation->refresh();
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conversation->status);
    }

    /**
     * AI-12: Safe Default / Fail Closed:
     * Khi API key rỗng hoặc chưa cấu hình, AI fail-closed và kích hoạt fallback an toàn.
     */
    public function test_ai_12_missing_api_key_fails_closed_safely(): void
    {
        $provider = new OpenAIChatProvider(apiKey: '');
        $this->assertFalse($provider->isAvailable());

        $this->expectException(ChatAIConfigurationException::class);
        $request = new ChatAIRequest(messages: []);
        $provider->generateReply($request);
    }

    /**
     * AI-13: Business Guard Interception:
     * Nếu AI hallucinate trả lời vi phạm: "Cửu Long Media nhận quay phim sự kiện..."
     * Expected: Business Guard chặn lại và thay thế bằng thông báo tạm ngưng Media chuẩn.
     */
    public function test_ai_13_business_guard_intercepts_and_replaces_hallucinated_acceptance(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        // Mô phỏng AI hallucinate vi phạm quy tắc công ty
        $this->fakeProvider->setCannedReply('Vâng, Cửu Long Media nhận quay phim sự kiện chuyên nghiệp cho quý khách ạ!');

        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Bên bạn có quay phim không?',
            'status' => ChatMessageStatus::Sent,
        ]);

        $botMsg = $this->aiConversationService->processVisitorMessage($conversation, $visitorMsg);

        $this->assertNotNull($botMsg);
        // Không được chứa câu khẳng định nhận job
        $this->assertStringNotContainsString('nhận quay phim', $botMsg->message_body);
        // Phải chứa thông báo chuẩn mực của Business Guard
        $this->assertStringContainsString('tạm ngưng nhận các job Media', $botMsg->message_body);
        $this->assertStringContainsString('0939 363 262', $botMsg->message_body);
    }

    /**
     * AI-14: Security Audit:
     * OPENAI_API_KEY không bao giờ xuất hiện trong HTML, Blade, public API response, hay log.
     */
    public function test_ai_14_api_key_never_leaked_in_public_surfaces(): void
    {
        $secretKey = 'sk-proj-super-secret-production-key-998877';
        config(['chat_ai.openai.api_key' => $secretKey]);

        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        // API List conversations
        $response = $this->getJson("/api/chat/conversations/{$conversation->conversation_uuid}");
        $content = $response->getContent();

        $this->assertStringNotContainsString($secretKey, $content);

        // Send message API
        $response2 = $this->postJson("/api/chat/conversations/{$conversation->conversation_uuid}/messages", [
            'message_body' => 'Kiểm tra bảo mật API key',
        ]);
        $content2 = $response2->getContent();

        $this->assertStringNotContainsString($secretKey, $content2);
    }
}
