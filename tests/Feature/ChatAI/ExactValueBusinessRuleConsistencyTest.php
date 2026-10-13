<?php

namespace Tests\Feature\ChatAI;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Contracts\Chat\ChatAIServiceInterface;
use App\Services\Chat\AI\ChatAIBusinessGuard;
use App\Services\Chat\AI\ChatAIConversationService;
use App\Services\Chat\AI\ChatAIManager;
use App\Services\Chat\AI\ChatAIPromptBuilder;
use App\Services\Chat\AI\ChatHandoffService;
use App\Services\Chat\AI\Providers\FakeChatAIProvider;
use App\Services\Chat\ChatBusinessRules;
use App\Services\Chat\ChatConversationService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * PHASE 02.3 HOTFIX — EXACT VALUE BUSINESS RULE CONSISTENCY TEST SUITE
 * Verifies PRICE-01 to PRICE-11 invariants and guards against Business Rule Drift.
 */
class ExactValueBusinessRuleConsistencyTest extends TestCase
{
    use DatabaseTransactions;

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

        Cache::flush();
    }

    protected function tearDown(): void
    {
        $this->fakeProvider->reset();
        $this->aiManager->resetProvider();
        Cache::flush();

        parent::tearDown();
    }

    protected function createVisitor(string $ip = '127.0.0.1'): ChatVisitor
    {
        return ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Visitor Test ' . Str::random(6),
            'first_ip' => $ip,
            'last_ip' => $ip,
        ]);
    }

    /**
     * PRICE-01: Input "Giá thuê flycam bao nhiêu?"
     * Expected: Có "1.000.000đ", "1.500.000đ", và "giá tham khảo".
     */
    public function test_price_01_flycam_exact_reference_price_values(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $canonicalReply = sprintf(
            'Dạ mức %s cho dịch vụ Flycam là từ %s đến %s/%s. Tuy nhiên hiện tại Cửu Long Media đang tạm ngưng nhận các job Media. Quý khách vui lòng liên hệ Hotline/Zalo %s để được tư vấn thêm.',
            ChatBusinessRules::FLYCAM_PRICE_TYPE,
            ChatBusinessRules::FLYCAM_REFERENCE_PRICE_MIN,
            ChatBusinessRules::FLYCAM_REFERENCE_PRICE_MAX,
            ChatBusinessRules::FLYCAM_UNIT,
            ChatBusinessRules::HOTLINE
        );
        $this->fakeProvider->setCannedReply($canonicalReply);

        $visitorMsg = $this->messageService->sendMessage($visitor, $conversation, 'Giá thuê flycam bao nhiêu?');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('1.000.000', $botMsg->message_body);
        $this->assertStringContainsString('1.500.000', $botMsg->message_body);
        $this->assertStringContainsString('giá tham khảo', mb_strtolower($botMsg->message_body, 'UTF-8'));
    }

    /**
     * PRICE-02: Response KHÔNG được chứa: 3.000.000đ
     */
    public function test_price_02_response_must_not_contain_3_million(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Mức giá tham khảo flycam từ 1.000.000đ – 1.500.000đ/lần. Hiện tại công ty đang tạm ngưng nhận job Media ạ.');

        $this->messageService->sendMessage($visitor, $conversation, 'Giá thuê flycam bao nhiêu?');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringNotContainsString('3.000.000', $botMsg->message_body);
        $this->assertStringNotContainsString('3tr', mb_strtolower($botMsg->message_body, 'UTF-8'));
    }

    /**
     * PRICE-03: Response KHÔNG được chứa: 5.000.000đ
     */
    public function test_price_03_response_must_not_contain_5_million(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Mức giá tham khảo flycam từ 1.000.000đ – 1.500.000đ/lần. Hiện tại công ty đang tạm ngưng nhận job Media ạ.');

        $this->messageService->sendMessage($visitor, $conversation, 'Giá thuê flycam bao nhiêu?');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringNotContainsString('5.000.000', $botMsg->message_body);
        $this->assertStringNotContainsString('5tr', mb_strtolower($botMsg->message_body, 'UTF-8'));
    }

    /**
     * PRICE-04: Response KHÔNG được chứa: "3.000.000đ – 5.000.000đ/buổi"
     */
    public function test_price_04_response_must_not_contain_legacy_pricing_range(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Mức giá tham khảo flycam từ 1.000.000đ – 1.500.000đ/lần. Hiện tại công ty đang tạm ngưng nhận job Media ạ.');

        $this->messageService->sendMessage($visitor, $conversation, 'Giá thuê flycam bao nhiêu?');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringNotContainsString('3.000.000đ – 5.000.000đ/buổi', $botMsg->message_body);
        $this->assertStringNotContainsString('3.000.000 - 5.000.000', $botMsg->message_body);
    }

    /**
     * PRICE-05: Response phải dùng: "/lần", không phải: "/buổi"
     */
    public function test_price_05_response_must_use_per_flight_unit_not_per_session(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Mức giá tham khảo flycam từ 1.000.000đ – 1.500.000đ/lần. Hiện tại công ty đang tạm ngưng nhận job Media.');

        $this->messageService->sendMessage($visitor, $conversation, 'Giá thuê flycam bao nhiêu?');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $lower = mb_strtolower($botMsg->message_body, 'UTF-8');
        $this->assertStringContainsString('/lần', $lower);
        $this->assertStringNotContainsString('/buổi', $lower);
    }

    /**
     * PRICE-06: AI không được biến: 1.000.000đ – 1.500.000đ/lần thành giá chính thức/cố định.
     */
    public function test_price_06_cannot_claim_fixed_official_price(): void
    {
        // When AI hallucinates that the price is official or fixed, BusinessGuard intercepts
        $hallucinatedReply = 'Giá chính thức là 1.000.000đ – 1.500.000đ/lần, bên em cam kết mức giá này.';
        $enforced = $this->businessGuard->validateAndEnforce($hallucinatedReply);

        $this->assertEquals(ChatAIBusinessGuard::DEFAULT_FALLBACK_REPLY, $enforced);
        $this->assertStringContainsString('giá tham khảo', mb_strtolower($enforced, 'UTF-8'));
    }

    /**
     * PRICE-07: Khi khách hỏi booking Flycam: AI phải nhắc media đang tạm thời ngưng nhận.
     */
    public function test_price_07_booking_flycam_triggers_suspension_notice(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ Cửu Long Media hiện đang tạm ngưng tiếp nhận các dịch vụ Media (quay phim, flycam) để nâng cấp hệ thống. Quý khách vui lòng liên hệ Hotline/Zalo 0939 363 262.');

        $this->messageService->sendMessage($visitor, $conversation, 'Tôi muốn thuê flycam tuần sau');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $lower = mb_strtolower($botMsg->message_body, 'UTF-8');
        $this->assertTrue(str_contains($lower, 'tạm ngưng') || str_contains($lower, 'ngưng nhận') || str_contains($lower, 'tạm dừng'));
        $this->assertStringNotContainsString('xác nhận đặt lịch', $lower);
        $this->assertStringNotContainsString('bên em nhận', $lower);
    }

    /**
     * PRICE-08: Khi khách hỏi giá camera: Expected 1.500.000đ – 2.000.000đ/máy
     */
    public function test_price_08_camera_reference_price_quotes_canonical_range(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ mức giá tham khảo cho thiết bị quay phim/camera là từ 1.500.000đ – 2.000.000đ/máy. Tuy nhiên hiện tại Cửu Long Media đang tạm ngưng nhận job Media ạ.');

        $this->messageService->sendMessage($visitor, $conversation, 'Giá thuê camera bao nhiêu?');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('1.500.000', $botMsg->message_body);
        $this->assertStringContainsString('2.000.000', $botMsg->message_body);
        $this->assertStringContainsString('máy', mb_strtolower($botMsg->message_body, 'UTF-8'));
    }

    /**
     * PRICE-09: Giá camera cũng phải được xác định là: "giá tham khảo"
     */
    public function test_price_09_camera_price_must_be_reference_price(): void
    {
        $visitor = $this->createVisitor();
        $conversation = $this->conversationService->getOrCreateActiveConversation($visitor);

        $this->fakeProvider->setCannedReply('Dạ mức giá tham khảo cho thiết bị quay phim/camera là từ 1.500.000đ – 2.000.000đ/máy. Lưu ý đây là giá tham khảo.');

        $this->messageService->sendMessage($visitor, $conversation, 'Báo giá máy quay');
        $botMsg = $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->first();

        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('giá tham khảo', mb_strtolower($botMsg->message_body, 'UTF-8'));
    }

    /**
     * PRICE-10: Hotline phải là 0939 363 262
     */
    public function test_price_10_hotline_must_be_canonical_cuu_long_number(): void
    {
        $this->assertEquals('0939 363 262', ChatBusinessRules::HOTLINE);
        $this->assertEquals('0939 363 262', ChatBusinessRules::ZALO);
        $this->assertStringContainsString('0939 363 262', ChatAIPromptBuilder::getSystemPrompt());
        $this->assertStringContainsString('0939 363 262', ChatAIBusinessGuard::DEFAULT_FALLBACK_REPLY);
    }

    /**
     * PRICE-11: Không được xuất hiện một Business Rule khác mâu thuẫn với canonical value.
     */
    public function test_price_11_canonical_consistency_across_system_prompt_and_rules(): void
    {
        $prompt = ChatAIPromptBuilder::getSystemPrompt();

        // 1. Verify Flycam in System Prompt
        $this->assertStringContainsString('1.000.000đ – 1.500.000đ / lần', $prompt);
        $this->assertStringNotContainsString('3.000.000', $prompt);
        $this->assertStringNotContainsString('5.000.000', $prompt);
        $this->assertStringNotContainsString('/buổi', $prompt);

        // 2. Verify Camera in System Prompt
        $this->assertStringContainsString('1.500.000đ – 2.000.000đ / máy', $prompt);

        // 3. Verify Address in System Prompt
        $this->assertStringContainsString('Lầu 5, 57 Hùng Vương, phường Ninh Kiều, TP Cần Thơ', $prompt);

        // 4. Verify Hotline in System Prompt
        $this->assertStringContainsString('0939 363 262', $prompt);

        // 5. Verify ChatBusinessRules class matches
        $rules = ChatBusinessRules::all();
        $this->assertEquals('1.000.000đ', $rules['flycam']['price_min']);
        $this->assertEquals('1.500.000đ', $rules['flycam']['price_max']);
        $this->assertEquals('lần', $rules['flycam']['unit']);
        $this->assertEquals('1.500.000đ', $rules['camera']['price_min']);
        $this->assertEquals('2.000.000đ', $rules['camera']['price_max']);
        $this->assertEquals('máy', $rules['camera']['unit']);
        $this->assertEquals('0939 363 262', $rules['hotline']);
    }

    /**
     * GUARD-HOTFIX: Verify ChatAIBusinessGuard intercepts legacy 3-5M and /buổi.
     */
    public function test_guard_intercepts_legacy_flycam_values_and_units(): void
    {
        // Case A: Hallucinated 3.000.000 - 5.000.000
        $legacyText = 'Giá flycam là 3.000.000đ – 5.000.000đ/buổi nhé anh.';
        $this->assertTrue($this->businessGuard->isViolation($legacyText));
        $enforcedA = $this->businessGuard->validateAndEnforce($legacyText);
        $this->assertEquals(ChatAIBusinessGuard::DEFAULT_FALLBACK_REPLY, $enforcedA);

        // Case B: Hallucinated /buổi
        $unitText = 'Giá thuê flycam là 1.200.000đ/buổi ạ.';
        $this->assertTrue($this->businessGuard->isViolation($unitText));
        $enforcedB = $this->businessGuard->validateAndEnforce($unitText);
        $this->assertEquals(ChatAIBusinessGuard::DEFAULT_FALLBACK_REPLY, $enforcedB);

        // Case C: Valid canonical reply is NOT violated
        $validText = 'Mức giá tham khảo flycam từ 1.000.000đ – 1.500.000đ/lần. Hiện tại Cửu Long Media đang tạm ngưng nhận job Media ạ.';
        $this->assertFalse($this->businessGuard->isViolation($validText));
        $enforcedC = $this->businessGuard->validateAndEnforce($validText);
        $this->assertEquals($validText, $enforcedC);
    }
}
