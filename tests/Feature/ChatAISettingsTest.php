<?php

namespace Tests\Feature;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Exceptions\Chat\ChatAITimeoutException;
use App\Exceptions\Chat\ChatAIUnavailableException;
use App\Filament\Pages\ChatAISettings;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\AI\ChatAIConversationService;
use App\Services\Chat\AI\ChatAIManager;
use App\Services\Chat\AI\ChatAISettingsResolver;
use App\Services\Chat\AI\Providers\FakeChatAIProvider;
use App\Services\Chat\AI\Providers\NoneChatAIProvider;
use App\Services\Chat\Automation\ChatAutomationEngine;
use App\Services\Chat\ChatAgentConversationService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatAISettingsTest extends TestCase
{
    protected ChatAISettingsResolver $resolver;
    protected ChatAIManager $aiManager;
    protected FakeChatAIProvider $fakeProvider;
    protected User $adminUser;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->resolver = app(ChatAISettingsResolver::class);
        $this->resolver->resetSettings();

        // Ensure roles exist
        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

        $this->adminUser = User::factory()->create([
            'email' => 'admin_' . Str::random(8) . '@cuulong.test',
        ]);
        $this->adminUser->assignRole('Admin');

        $this->regularUser = User::factory()->create([
            'email' => 'user_' . Str::random(8) . '@cuulong.test',
        ]);

        $this->fakeProvider = new FakeChatAIProvider();
        $this->aiManager = app(ChatAIServiceInterface::class);
        $this->aiManager->setProvider($this->fakeProvider);

        ChatSetting::where('key', ChatAutomationEngine::SETTING_KEY)->delete();
        Cache::flush();
    }

    protected function tearDown(): void
    {
        $this->resolver->resetSettings();
        $this->fakeProvider->reset();
        $this->aiManager->resetProvider();
        ChatSetting::where('key', ChatAutomationEngine::SETTING_KEY)->delete();
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
    // 1. CONFIGURATION & PERSISTENCE TESTS (1 - 10)
    // =========================================================================

    /**
     * Test 01: AI enabled setting persisted.
     */
    public function test_01_ai_enabled_persisted(): void
    {
        $saved = $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);
        $this->assertTrue($this->resolver->isEnabled());
        $this->assertTrue($saved['enabled']);
    }

    /**
     * Test 02: AI disabled setting persisted.
     */
    public function test_02_ai_disabled_persisted(): void
    {
        $this->resolver->saveSettings(['enabled' => false, 'provider' => 'none', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);
        $this->assertFalse($this->resolver->isEnabled());
    }

    /**
     * Test 03: Provider persisted to settings store.
     */
    public function test_03_provider_persisted(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'openai', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);
        $this->assertSame('openai', $this->resolver->getProvider());
    }

    /**
     * Test 04: Fake provider rejected in production environment.
     */
    public function test_04_fake_provider_rejected_in_production(): void
    {
        app()->detectEnvironment(fn () => 'production');

        $this->expectException(ValidationException::class);
        $this->resolver->validateAndSanitize([
            'enabled' => true,
            'provider' => 'fake',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);
    }

    /**
     * Test 05: None provider fails closed.
     */
    public function test_05_none_provider_fails_closed(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'none', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);
        $this->assertSame('none', $this->resolver->getProvider());

        $this->aiManager->resetProvider();
        $provider = $this->aiManager->getProvider();
        $this->assertInstanceOf(NoneChatAIProvider::class, $provider);
        $this->assertFalse($provider->isAvailable());
    }

    /**
     * Test 06: Rate limit validation (min 1, max 60).
     */
    public function test_06_rate_limit_validation(): void
    {
        $this->expectException(ValidationException::class);
        $this->resolver->validateAndSanitize([
            'enabled' => true,
            'provider' => 'none',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 0, // Invalid < 1
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);
    }

    /**
     * Test 07: Keyword validation rejects oversized keywords (>100 chars).
     */
    public function test_07_keyword_validation(): void
    {
        $this->expectException(ValidationException::class);
        $this->resolver->validateAndSanitize([
            'enabled' => true,
            'provider' => 'none',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => [str_repeat('a', 101)], // Exceeds 100
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);
    }

    /**
     * Test 08: Duplicate keywords normalized and deduplicated.
     */
    public function test_08_duplicate_keywords_normalized(): void
    {
        $sanitized = $this->resolver->validateAndSanitize([
            'enabled' => true,
            'provider' => 'none',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['Human', 'human', '  HUMAN  ', 'agent'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);

        $this->assertSame(['human', 'agent'], $sanitized['handoff_keywords']);
    }

    /**
     * Test 09: Empty keywords handled safely.
     */
    public function test_09_empty_keywords_handled_safely(): void
    {
        $sanitized = $this->resolver->validateAndSanitize([
            'enabled' => true,
            'provider' => 'none',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => "human\n\n   \nagent\n",
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);

        $this->assertSame(['human', 'agent'], $sanitized['handoff_keywords']);
    }

    /**
     * Test 10: Notice validation and HTML sanitization.
     */
    public function test_10_notice_validation_and_sanitization(): void
    {
        $sanitized = $this->resolver->validateAndSanitize([
            'enabled' => true,
            'provider' => 'none',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => '<b>Chuyển máy</b> <script>alert(1)</script> cho nhân viên.',
            'fallback_notice' => '<i>Hệ thống bận</i>.',
        ]);

        $this->assertStringNotContainsString('<b>', $sanitized['handoff_notice']);
        $this->assertStringNotContainsString('<script>', $sanitized['handoff_notice']);
        $this->assertSame('Chuyển máy alert(1) cho nhân viên.', $sanitized['handoff_notice']);
        $this->assertSame('Hệ thống bận.', $sanitized['fallback_notice']);
    }

    // =========================================================================
    // 2. RUNTIME BEHAVIOR TESTS (11 - 17)
    // =========================================================================

    /**
     * Test 11: Runtime reads persistent setting over config fallback.
     */
    public function test_11_runtime_reads_persistent_setting_over_config(): void
    {
        config(['chat_ai.default_channel' => 'human']);

        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'fake',
            'default_channel' => 'ai',
            'max_ai_replies_per_minute' => 12,
            'handoff_keywords' => ['tro_ly'],
            'handoff_notice' => 'Persistent notice',
            'fallback_notice' => 'Persistent fallback',
        ]);

        $this->assertSame('ai', $this->resolver->getDefaultChannel());
        $this->assertSame(12, $this->resolver->getMaxRepliesPerMinute());
        $this->assertSame(['tro_ly'], $this->resolver->getHandoffKeywords());
    }

    /**
     * Test 12: Disabled setting prevents AI from generating response.
     */
    public function test_12_disabled_setting_prevents_ai_responses(): void
    {
        $this->resolver->saveSettings([
            'enabled' => false,
            'provider' => 'fake',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào',
            'status' => ChatMessageStatus::Sent,
        ]);

        $aiService = app(ChatAIConversationService::class);
        $res = $aiService->processVisitorMessage($msg);

        $this->assertNull($res);
        $this->assertSame(0, $conversation->messages()->where('sender_type', ChatMessageSenderType::Bot)->count());
    }

    /**
     * Test 13: Changed provider is respected at runtime.
     */
    public function test_13_changed_provider_respected_at_runtime(): void
    {
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'none',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);

        $this->aiManager->resetProvider();
        $this->assertSame('none', $this->resolver->getProvider());
        $this->assertInstanceOf(NoneChatAIProvider::class, $this->aiManager->getProvider());
    }

    /**
     * Test 14: Changed rate limit is respected at runtime.
     */
    public function test_14_changed_rate_limit_respected_at_runtime(): void
    {
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'fake',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 1, // Only 1 per minute
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $aiService = app(ChatAIConversationService::class);

        // 1st message -> reply
        $msg1 = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'Msg 1', 'status' => ChatMessageStatus::Sent]);
        $res1 = $aiService->processVisitorMessage($msg1);
        $this->assertNotNull($res1);

        // 2nd message -> rate limited
        $msg2 = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'Msg 2', 'status' => ChatMessageStatus::Sent]);
        $res2 = $aiService->processVisitorMessage($msg2);
        $this->assertNull($res2);

        $this->assertSame(ChatConversationChannel::Human, $conversation->fresh()->channel);
    }

    /**
     * Test 15: Changed handoff keywords trigger handoff at runtime.
     */
    public function test_15_changed_handoff_keywords_trigger_handoff(): void
    {
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'fake',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['lien_he_sep'],
            'handoff_notice' => 'Chuyển sếp',
            'fallback_notice' => 'Fallback',
        ]);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $aiService = app(ChatAIConversationService::class);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Tôi muốn lien_he_sep ngay',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $aiService->processVisitorMessage($msg);
        $this->assertNotNull($res);
        $this->assertSame(ChatConversationChannel::Human, $conversation->fresh()->channel);
        $this->assertSame('Chuyển sếp', $res->message_body);
    }

    /**
     * Test 16: Changed handoff notice is sent to visitor.
     */
    public function test_16_changed_handoff_notice_sent_to_visitor(): void
    {
        $customNotice = 'Xin chờ trong giây lát, chuyên viên CSKH đang vào phòng chat.';
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'fake',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['tro_giup'],
            'handoff_notice' => $customNotice,
            'fallback_notice' => 'Fallback',
        ]);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $aiService = app(ChatAIConversationService::class);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Cần tro_giup gấp',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $aiService->processVisitorMessage($msg);
        $this->assertSame($customNotice, $res->message_body);
    }

    /**
     * Test 17: Changed fallback notice is used on AI error/timeout.
     */
    public function test_17_changed_fallback_notice_used_on_error(): void
    {
        $customFallback = 'AI đang bảo trì đột xuất, mời bạn nhắn lại sau.';
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'fake',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => $customFallback,
        ]);

        $this->fakeProvider->simulateTimeout();

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $aiService = app(ChatAIConversationService::class);

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Báo giá',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $aiService->processVisitorMessage($msg);
        $this->assertNotNull($res);
        $this->assertSame($customFallback, $res->message_body);
    }

    // =========================================================================
    // 3. SECURITY & UI ACCESS TESTS (18 - 22)
    // =========================================================================

    /**
     * Test 18: Secrets never appear in UI state or HTML.
     */
    public function test_18_secrets_never_appear_in_ui_state(): void
    {
        $this->actingAs($this->adminUser);

        config(['chat_ai.openai.api_key' => 'sk-proj-super-secret-key-999']);
        config(['chat_ai.gemini.api_key' => 'AIzaSySecretGeminiKey888']);

        $testable = Livewire::test(ChatAISettings::class);
        $html = $testable->html();

        $this->assertStringNotContainsString('sk-proj-super-secret-key-999', $html);
        $this->assertStringNotContainsString('AIzaSySecretGeminiKey888', $html);
        $this->assertStringContainsString('Đã cấu hình', $html);
    }

    /**
     * Test 19: Secrets never appear in audit log.
     */
    public function test_19_secrets_never_appear_in_audit_log(): void
    {
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'openai',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ], $this->adminUser);

        $logs = $this->resolver->getAuditLog();
        $encoded = json_encode($logs);

        $this->assertStringNotContainsString('api_key', $encoded);
        $this->assertStringNotContainsString('password', $encoded);
        $this->assertStringNotContainsString('secret', $encoded);
    }

    /**
     * Test 20: Unauthorized user cannot access Filament AI settings page.
     */
    public function test_20_unauthorized_user_cannot_access_page(): void
    {
        $this->actingAs($this->regularUser);

        $response = $this->get('/cuulongteam/chat-ai');
        $this->assertContains($response->status(), [403, 404]);
    }

    /**
     * Test 21: Unauthorized user cannot update settings via Livewire.
     */
    public function test_21_unauthorized_user_cannot_update_settings(): void
    {
        $this->actingAs($this->regularUser);

        $this->assertFalse(ChatAISettings::canAccess());

        $component = new ChatAISettings();

        try {
            $component->save(app(ChatAISettingsResolver::class));
            $this->fail('Expected 403 HttpException was not thrown.');
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            $this->assertSame(403, $e->getStatusCode());
        }
    }

    /**
     * Test 22: Client-side invalid values rejected server-side.
     */
    public function test_22_client_side_invalid_values_rejected_server_side(): void
    {
        $this->actingAs($this->adminUser);

        Livewire::test(ChatAISettings::class)
            ->set('max_ai_replies_per_minute', 999) // Invalid > 60
            ->call('save')
            ->assertHasErrors(['max_ai_replies_per_minute']);
    }

    // =========================================================================
    // 4. REGRESSION INVARIANTS TESTS (23 - 30)
    // =========================================================================

    /**
     * Test 23: Human takeover still disables AI permanently.
     */
    public function test_23_human_takeover_still_disables_ai(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        /** @var ChatAgentConversationService $agentConvService */
        $agentConvService = app(ChatAgentConversationService::class);
        $agentConvService->claimConversation($this->adminUser, $conversation);

        $msg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'Khách hỏi tiếp', 'status' => ChatMessageStatus::Sent]);
        $res = app(ChatAIConversationService::class)->processVisitorMessage($msg);

        $this->assertNull($res);
    }

    /**
     * Test 24: Spam conversation still blocks AI.
     */
    public function test_24_spam_conversation_still_blocks_ai(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);

        [$visitor, $conversation] = $this->createVisitorAndConversation(status: ChatConversationStatus::Spam);
        $msg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'Spam', 'status' => ChatMessageStatus::Sent]);

        $res = app(ChatAIConversationService::class)->processVisitorMessage($msg);
        $this->assertNull($res);
    }

    /**
     * Test 25: Blocked visitor still blocks AI.
     */
    public function test_25_blocked_visitor_still_blocks_ai(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $visitor->update(['blocked_at' => now()]);

        $msg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'Bị khóa', 'status' => ChatMessageStatus::Sent]);
        $res = app(ChatAIConversationService::class)->processVisitorMessage($msg);

        $this->assertNull($res);
    }

    /**
     * Test 26: Closed conversation still blocks AI.
     */
    public function test_26_closed_conversation_still_blocks_ai(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);

        [$visitor, $conversation] = $this->createVisitorAndConversation(status: ChatConversationStatus::Closed);
        $msg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'Sau khi đóng', 'status' => ChatMessageStatus::Sent]);

        $res = app(ChatAIConversationService::class)->processVisitorMessage($msg);
        $this->assertNull($res);
    }

    /**
     * Test 27: Provider failure still hands off to human.
     */
    public function test_27_provider_failure_still_hands_off(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);
        $this->fakeProvider->simulateException(new ChatAIUnavailableException('Offline'));

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $msg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'Alo', 'status' => ChatMessageStatus::Sent]);

        $res = app(ChatAIConversationService::class)->processVisitorMessage($msg);
        $this->assertNotNull($res);
        $this->assertSame(ChatConversationChannel::Human, $conversation->fresh()->channel);
    }

    /**
     * Test 28: Bot message cannot recursively trigger AI.
     */
    public function test_28_bot_message_cannot_recursively_trigger_ai(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $botMsg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Bot, 'message_body' => 'I am bot', 'status' => ChatMessageStatus::Sent]);

        $res = app(ChatAIConversationService::class)->processVisitorMessage($botMsg);
        $this->assertNull($res);
    }

    /**
     * Test 29: Bot message cannot trigger CHAT-10 automation rules.
     */
    public function test_29_bot_message_cannot_trigger_automation(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();
        /** @var ChatAutomationEngine $engine */
        $engine = app(ChatAutomationEngine::class);

        $botMsg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Bot, 'message_body' => 'I am bot', 'status' => ChatMessageStatus::Sent]);
        $executed = $engine->handleTrigger('message_received', ['conversation' => $conversation, 'message' => $botMsg, 'visitor' => $visitor]);

        $this->assertSame(0, $executed);
    }

    /**
     * Test 30: Duplicate AI execution protection remains intact.
     */
    public function test_30_duplicate_ai_execution_protection_intact(): void
    {
        $this->resolver->saveSettings(['enabled' => true, 'provider' => 'fake', 'default_channel' => 'hybrid', 'max_ai_replies_per_minute' => 5, 'handoff_keywords' => ['human'], 'handoff_notice' => 'Notice', 'fallback_notice' => 'Fallback']);

        [$visitor, $conversation] = $this->createVisitorAndConversation();
        $msg = $conversation->messages()->create(['sender_type' => ChatMessageSenderType::Visitor, 'message_body' => 'One time', 'status' => ChatMessageStatus::Sent]);

        $aiService = app(ChatAIConversationService::class);
        $res1 = $aiService->processVisitorMessage($msg);
        $this->assertNotNull($res1);

        $res2 = $aiService->processVisitorMessage($msg);
        $this->assertNull($res2);
    }

    // =========================================================================
    // 5. AUDIT TRAIL & CACHE TESTS (31 - 35)
    // =========================================================================

    /**
     * Test 31: Setting update creates audit record.
     */
    public function test_31_setting_update_creates_audit_record(): void
    {
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'openai',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 10,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ], $this->adminUser);

        $logs = $this->resolver->getAuditLog();
        $this->assertNotEmpty($logs);
        $this->assertArrayHasKey('changes', $logs[0]);
    }

    /**
     * Test 32: Actor recorded in audit trail.
     */
    public function test_32_actor_recorded_in_audit_trail(): void
    {
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'gemini',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ], $this->adminUser);

        $logs = $this->resolver->getAuditLog();
        $this->assertSame($this->adminUser->id, $logs[0]['actor_id']);
        $this->assertSame($this->adminUser->name, $logs[0]['actor_name']);
        $this->assertSame($this->adminUser->email, $logs[0]['actor_email']);
    }

    /**
     * Test 33: Old and new values recorded in audit trail diff.
     */
    public function test_33_old_and_new_values_recorded_in_audit_trail(): void
    {
        $this->resolver->saveSettings([
            'enabled' => false,
            'provider' => 'none',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Old notice',
            'fallback_notice' => 'Old fallback',
        ]);

        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'openai',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'New notice',
            'fallback_notice' => 'Old fallback',
        ], $this->adminUser);

        $logs = $this->resolver->getAuditLog();
        $changes = $logs[0]['changes'];

        $this->assertArrayHasKey('enabled', $changes);
        $this->assertFalse($changes['enabled']['old']);
        $this->assertTrue($changes['enabled']['new']);

        $this->assertArrayHasKey('provider', $changes);
        $this->assertSame('none', $changes['provider']['old']);
        $this->assertSame('openai', $changes['provider']['new']);

        $this->assertArrayHasKey('handoff_notice', $changes);
        $this->assertSame('Old notice', $changes['handoff_notice']['old']);
        $this->assertSame('New notice', $changes['handoff_notice']['new']);
    }

    /**
     * Test 34: Sensitive values redacted or excluded from audit trail.
     */
    public function test_34_sensitive_values_redacted_from_audit_trail(): void
    {
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'openai',
            'default_channel' => 'hybrid',
            'max_ai_replies_per_minute' => 5,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ], $this->adminUser);

        $logs = $this->resolver->getAuditLog();
        $this->assertArrayNotHasKey('api_key', $logs[0]['changes']);
        $this->assertArrayNotHasKey('password', $logs[0]['changes']);
    }

    /**
     * Test 35: Immediate cache invalidation on setting update.
     */
    public function test_35_cache_invalidation_on_update_immediate(): void
    {
        // 1. Initial read caches the settings
        $this->resolver->getSettings();
        $this->assertTrue(Cache::has(ChatAISettingsResolver::CACHE_KEY));

        // 2. Saving new settings clears cache
        $this->resolver->saveSettings([
            'enabled' => true,
            'provider' => 'gemini',
            'default_channel' => 'ai',
            'max_ai_replies_per_minute' => 20,
            'handoff_keywords' => ['human'],
            'handoff_notice' => 'Notice',
            'fallback_notice' => 'Fallback',
        ]);

        $this->assertFalse(Cache::has(ChatAISettingsResolver::CACHE_KEY));

        // 3. Next read reflects new values
        $newSettings = $this->resolver->getSettings();
        $this->assertSame('gemini', $newSettings['provider']);
        $this->assertSame(20, $newSettings['max_ai_replies_per_minute']);
        $this->assertSame('ai', $newSettings['default_channel']);
    }
}
