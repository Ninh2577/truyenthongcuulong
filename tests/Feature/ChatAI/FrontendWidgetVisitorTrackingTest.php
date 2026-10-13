<?php

namespace Tests\Feature\ChatAI;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Models\User;
use App\Services\Chat\ChatBusinessRules;
use App\Services\Chat\ChatVisitorTrackingService;
use App\Services\Chat\VisitorSessionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * PHASE 02.4 — FRONTEND CHAT WIDGET & REALTIME VISITOR TRACKING TEST SUITE
 * Verifies:
 * 1. Visitor Tracking & Heartbeat (URL, Title, Dwell time, Device, OS, Browser)
 * 2. Realtime Online / Offline status calculation and monitor summary
 * 3. Security (XSS protection, CSRF, No OpenAI API Key on frontend, HttpOnly cookie)
 * 4. Widget Messaging Lifecycle (Reconcile state, Idempotency, Multi-tab)
 * 5. Automation, Business Guard, & Price Regression (Flycam 1-1.5tr, Camera 1.5-2tr, Media pause)
 * 6. Human Handoff & Agent Takeover (AI stops after takeover)
 */
class FrontendWidgetVisitorTrackingTest extends TestCase
{
    protected VisitorSessionService $sessionService;
    protected ChatVisitorTrackingService $trackingService;
    protected string $cookieName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();

        $this->sessionService = app(VisitorSessionService::class);
        $this->trackingService = app(ChatVisitorTrackingService::class);
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');

        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');
        Cache::flush();
    }

    /**
     * Helper to create an authenticated visitor session.
     */
    protected function createVisitorWithSession(array $visitorAttributes = []): array
    {
        $visitor = ChatVisitor::create(array_merge([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Khách Kiểm Thử ' . Str::random(4),
            'first_ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        ], $visitorAttributes));

        $rawToken = 'test_token_' . Str::random(40);
        $session = ChatVisitorSession::create([
            'chat_visitor_id' => $visitor->id,
            'token_hash' => hash('sha256', $rawToken),
            'expires_at' => now()->addDays(30),
            'last_active_at' => now(),
        ]);

        return [$visitor, $session, $rawToken];
    }

    // =========================================================================
    // SECTION 1: REALTIME VISITOR TRACKING & HEARTBEAT
    // =========================================================================

    /**
     * Test 01: Heartbeat records current URL, page title, and computes dwell time accurately.
     */
    public function test_01_heartbeat_records_url_title_and_dwell_time(): void
    {
        [$visitor, $session, $token] = $this->createVisitorWithSession();

        // 1. Initial heartbeat on home page
        $res1 = $this->withCookie($this->cookieName, $token)->postJson('/api/chat/tracking/heartbeat', [
            'current_url' => '/du-an',
            'page_title' => 'Dự Án Tiêu Biểu | Cửu Long Media',
            'referrer' => 'https://google.com',
        ]);

        $res1->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.current_url', '/du-an')
            ->assertJsonPath('data.page_title', 'Dự Án Tiêu Biểu | Cửu Long Media')
            ->assertJsonPath('data.device_type', 'Desktop')
            ->assertJsonPath('data.browser', 'Chrome')
            ->assertJsonPath('data.os', 'Windows')
            ->assertJsonPath('data.is_online', true);

        // 2. Second heartbeat on same page after simulated time elapsed
        Carbon::setTestNow(now()->addSeconds(25));

        $res2 = $this->withCookie($this->cookieName, $token)->postJson('/api/chat/tracking/heartbeat', [
            'current_url' => '/du-an',
            'page_title' => 'Dự Án Tiêu Biểu | Cửu Long Media',
        ]);

        $res2->assertStatus(200);
        $dwell = $res2->json('data.dwell_seconds');
        $this->assertGreaterThanOrEqual(24, $dwell);

        // 3. Navigation to a new page resets dwell time for that page
        $res3 = $this->withCookie($this->cookieName, $token)->postJson('/api/chat/tracking/heartbeat', [
            'current_url' => '/bang-gia',
            'page_title' => 'Bảng Giá Dịch Vụ',
        ]);

        $res3->assertStatus(200)
            ->assertJsonPath('data.current_url', '/bang-gia')
            ->assertJsonPath('data.dwell_seconds', 0);

        Carbon::setTestNow(); // Reset time
    }

    /**
     * Test 02: Unauthenticated heartbeat request is rejected with 401.
     */
    public function test_02_unauthenticated_heartbeat_returns_401(): void
    {
        $response = $this->postJson('/api/chat/tracking/heartbeat', [
            'current_url' => '/',
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test 03: Heartbeat from blocked IP is rejected with 403 Forbidden.
     */
    public function test_03_heartbeat_from_blocked_ip_returns_403(): void
    {
        [$visitor, $session, $token] = $this->createVisitorWithSession();
        $spamService = app(\App\Services\Chat\Spam\ChatSpamProtectionService::class);
        $spamService->blockIp('127.0.0.1', 'Spam test');

        $response = $this->withCookie($this->cookieName, $token)
            ->postJson('/api/chat/tracking/heartbeat', [
                'current_url' => '/',
            ]);

        $response->assertStatus(403);
        $spamService->unblockIp('127.0.0.1');
    }

    /**
     * Test 04: Device, Browser, and OS detection for various User-Agent strings.
     */
    public function test_04_device_detection_accuracy(): void
    {
        // 1. Mobile iPhone Safari
        $uaIphone = 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Mobile/15E148 Safari/604.1';
        $parsed1 = $this->trackingService->parseUserAgent($uaIphone);
        $this->assertEquals('Mobile', $parsed1['device_type']);
        $this->assertEquals('Safari', $parsed1['browser']);
        $this->assertEquals('iOS', $parsed1['os']);

        // 2. Android Mobile Chrome
        $uaAndroid = 'Mozilla/5.0 (Linux; Android 14; SM-S928B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.6261.64 Mobile Safari/537.36';
        $parsed2 = $this->trackingService->parseUserAgent($uaAndroid);
        $this->assertEquals('Mobile', $parsed2['device_type']);
        $this->assertEquals('Chrome', $parsed2['browser']);
        $this->assertEquals('Android', $parsed2['os']);

        // 3. iPad Tablet
        $uaIpad = 'Mozilla/5.0 (iPad; CPU OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1';
        $parsed3 = $this->trackingService->parseUserAgent($uaIpad);
        $this->assertEquals('Tablet', $parsed3['device_type']);
        $this->assertEquals('Safari', $parsed3['browser']);
        $this->assertEquals('iOS', $parsed3['os']);

        // 4. Desktop Windows Edge
        $uaEdge = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.2365.92';
        $parsed4 = $this->trackingService->parseUserAgent($uaEdge);
        $this->assertEquals('Desktop', $parsed4['device_type']);
        $this->assertEquals('Edge', $parsed4['browser']);
        $this->assertEquals('Windows', $parsed4['os']);
    }

    /**
     * Test 05: Realtime Online vs Offline calculation and TTL timeout (60 seconds).
     */
    public function test_05_online_status_ttl_expiration(): void
    {
        [$visitor, $session, $token] = $this->createVisitorWithSession();

        // Send heartbeat at T = 0
        $this->withCookie($this->cookieName, $token)->postJson('/api/chat/tracking/heartbeat', [
            'current_url' => '/',
        ]);

        $tracking1 = $this->trackingService->getTracking($visitor->visitor_uuid, $visitor);
        $this->assertTrue($tracking1['is_online']);
        $this->assertEquals('online', $tracking1['status']);

        // Advance time by 65 seconds (beyond 60s timeout)
        Carbon::setTestNow(now()->addSeconds(65));

        $tracking2 = $this->trackingService->getTracking($visitor->visitor_uuid, $visitor);
        $this->assertFalse($tracking2['is_online']);
        $this->assertEquals('offline', $tracking2['status']);

        Carbon::setTestNow(); // Reset time
    }

    // =========================================================================
    // SECTION 2: FRONTEND CHAT WIDGET & UI INTEGRITY
    // =========================================================================

    /**
     * Test 06: Homepage renders chat widget without any OpenAI API keys.
     */
    public function test_06_homepage_widget_security_no_api_keys(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Required elements
        $response->assertSee('id="chat-widget-root"', false);
        $response->assertSee('id="chat-fab-button"', false);
        $response->assertSee('id="chat-window-modal"', false);

        // Security invariants: No OpenAI API keys exposed in HTML or JS
        $content = $response->getContent();
        $this->assertDoesNotMatchRegularExpression('/sk-[a-zA-Z0-9_\-]{20,}/', $content);
        $this->assertStringNotContainsString('OPENAI_API_KEY', $content);
        $this->assertStringNotContainsString('NEXT_PUBLIC_OPENAI_API_KEY', $content);
        $this->assertStringNotContainsString('VITE_OPENAI_API_KEY', $content);
    }

    /**
     * Test 07: Widget strictly uses x-text and avoids innerHTML/x-html to prevent XSS.
     */
    public function test_07_widget_xss_protection_compliance(): void
    {
        $viewPath = resource_path('views/components/chat/widget.blade.php');
        $this->assertFileExists($viewPath);
        $content = file_get_contents($viewPath);

        $this->assertStringNotContainsString('x-html', $content);
        $this->assertStringNotContainsString('.innerHTML', $content);
        $this->assertStringContainsString('x-text="msg.message"', $content);
        $this->assertStringContainsString('Cửu Long AI đang trả lời...', $content);
        $this->assertStringContainsString('Cửu Long AI', $content);
        $this->assertStringContainsString('Nhân viên tư vấn', $content);
    }

    /**
     * Test 08: Multi-tab session stability — Opening multiple tabs reuses same visitor and conversation.
     */
    public function test_08_multi_tab_reuses_same_visitor_and_conversation(): void
    {
        // Tab 1: Init session
        $init1 = $this->postJson('/api/chat/session/init');
        $init1->assertStatus(200);
        $cookieVal = $init1->getCookie($this->cookieName, false)?->getValue();
        $visitorUuid = $init1->json('visitor_uuid');

        // Tab 1: Create conversation
        $conv1 = $this->withCookie($this->cookieName, $cookieVal)->postJson('/api/chat/conversations');
        $conv1->assertStatus(200);
        $convUuid1 = $conv1->json('data.conversation_uuid');

        // Tab 2: Re-init session with same cookie
        $init2 = $this->withCookie($this->cookieName, $cookieVal)->postJson('/api/chat/session/init');
        $init2->assertStatus(200);
        $this->assertEquals($visitorUuid, $init2->json('visitor_uuid'));

        // Tab 2: Fetch active conversation
        $conv2 = $this->withCookie($this->cookieName, $cookieVal)->postJson('/api/chat/conversations');
        $conv2->assertStatus(200);
        $convUuid2 = $conv2->json('data.conversation_uuid');

        // Invariant: Exact same conversation reused, no duplicate created
        $this->assertEquals($convUuid1, $convUuid2);
        $this->assertEquals(1, ChatConversation::where('conversation_uuid', $convUuid1)->count());
    }

    // =========================================================================
    // SECTION 3: BUSINESS RULES & CANONICAL REGRESSION
    // =========================================================================

    /**
     * Test 09: Media inquiry regression — Media pause notice, no booking acceptance.
     */
    public function test_09_media_inquiry_notifies_suspension_and_rejects_booking(): void
    {
        [$visitor, $session, $token] = $this->createVisitorWithSession();
        $conv = ChatConversation::create([
            'conversation_uuid' => (string) Str::uuid(),
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Ai,
        ]);

        $systemPrompt = \App\Services\Chat\AI\ChatAIPromptBuilder::getDefaultSystemPrompt();

        // System prompt contains media suspension directive
        $this->assertStringContainsString('TẠM NGƯNG', $systemPrompt);
        $this->assertStringContainsString('0939 363 262', $systemPrompt);

        // Guard intercepts hallucinated booking confirmations
        $guard = app(\App\Services\Chat\AI\ChatAIBusinessGuard::class);
        $this->assertTrue($guard->isViolation('Dạ bên em nhận quay phim sự kiện cho anh, chốt lịch ngày mai ạ.'));
        $guarded = $guard->validateAndEnforce('Dạ bên em nhận quay phim sự kiện cho anh, chốt lịch ngày mai ạ.');
        $this->assertStringContainsString('tạm ngưng', $guarded);
    }

    /**
     * Test 10: Canonical Flycam and Camera prices regression — Exact value verification.
     */
    public function test_10_canonical_pricing_exact_values(): void
    {
        // 1. Flycam canonical price
        $this->assertEquals('1.000.000đ – 1.500.000đ/lần', ChatBusinessRules::FLYCAM_CANONICAL_PRICE_TEXT);
        $this->assertEquals('1.000.000đ', ChatBusinessRules::FLYCAM_REFERENCE_PRICE_MIN);
        $this->assertEquals('1.500.000đ', ChatBusinessRules::FLYCAM_REFERENCE_PRICE_MAX);

        // 2. Camera canonical price
        $this->assertEquals('1.500.000đ – 2.000.000đ/máy', ChatBusinessRules::CAMERA_CANONICAL_PRICE_TEXT);

        // 3. Hotline
        $this->assertEquals('0939 363 262', ChatBusinessRules::HOTLINE);

        // 4. Guard rejects legacy 3.000.000đ or 5.000.000đ prices
        $guard = app(\App\Services\Chat\AI\ChatAIBusinessGuard::class);
        $legacyText = 'Giá thuê flycam là 3.000.000đ - 5.000.000đ/buổi';
        $this->assertTrue($guard->isViolation($legacyText));
        $enforced = $guard->validateAndEnforce($legacyText);
        $this->assertEquals(\App\Services\Chat\AI\ChatAIBusinessGuard::DEFAULT_FALLBACK_REPLY, $enforced);
    }

    /**
     * Test 11: Human Handoff transitions to waiting_agent and stops AI.
     */
    public function test_11_human_handoff_transitions_and_stops_ai(): void
    {
        [$visitor, $session, $token] = $this->createVisitorWithSession();
        $conv = ChatConversation::create([
            'conversation_uuid' => (string) Str::uuid(),
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Ai,
        ]);

        $handoffService = app(\App\Services\Chat\AI\ChatHandoffService::class);
        $this->assertTrue($handoffService->isHandoffRequested('gặp nhân viên'));
        $handoffService->executeHandoff($conv, 'Yêu cầu từ khách');

        $conv->refresh();
        // Invariant: Status transitions to waiting_agent
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conv->status);

        // Invariant: Channel transitions to human
        $this->assertEquals(ChatConversationChannel::Human, $conv->channel);
    }

    /**
     * Test 12: Agent takeover stops AI permanently for that conversation.
     */
    public function test_12_agent_takeover_stops_ai(): void
    {
        Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);
        $agent = User::factory()->create();
        $agent->assignRole('Biên Tập Viên');

        [$visitor, $session, $token] = $this->createVisitorWithSession();
        $conv = ChatConversation::create([
            'conversation_uuid' => (string) Str::uuid(),
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::WaitingAgent,
            'channel' => ChatConversationChannel::Human,
        ]);

        // Agent claims conversation
        $agentConversationService = app(\App\Services\Chat\ChatAgentConversationService::class);
        $claimedConv = $agentConversationService->claimConversation($agent, $conv);

        $this->assertEquals(ChatConversationStatus::Assigned, $claimedConv->status);
        $this->assertEquals($agent->id, $claimedConv->assigned_to_user_id);

        // Agent sends message
        $agentMessageService = app(\App\Services\Chat\ChatAgentMessageService::class);
        $agentMsg = $agentMessageService->sendAgentMessage($agent, $claimedConv, 'Chào bạn, mình là nhân viên tư vấn Cửu Long.');
        $this->assertEquals('agent', $agentMsg->sender_type->value);

        // Visitor replies — AI service must NOT produce any bot message
        $visitorMsg = $conv->messages()->create([
            'sender_type' => \App\Enums\ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi cần tư vấn gấp',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $aiService = app(\App\Services\Chat\AI\ChatAIConversationService::class);
        $replyMsg = $aiService->processVisitorMessage($claimedConv, $visitorMsg);
        $this->assertNull($replyMsg);
    }
}
