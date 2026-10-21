<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Http\Resources\Chat\ChatMessageResource;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use App\Services\Chat\Automation\ChatAutomationEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class ChatAutomationServiceQuoteFlowTest extends TestCase
{
    protected ChatAutomationEngine $engine;

    protected function setUp(): void
    {
        parent::setUp();
        $this->engine = app(ChatAutomationEngine::class);

        RateLimiter::clear('chat-message-send');
        Cache::flush();
        try {
            Cache::store('database')->flush();
        } catch (\Throwable $e) {
        }
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
            'name' => 'Khách test bảng giá ' . uniqid(),
        ]);

        $conversation = ChatConversation::create([
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Hybrid,
            'visitor_unread_count' => 0,
            'agent_unread_count' => 0,
        ]);

        return [$visitor, $conversation];
    }

    /**
     * Test 1: Customer asking for "Bảng giá dịch vụ" triggers automated inquiry with service options.
     */
    public function test_01_customer_asking_quote_triggers_service_inquiry(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Bảng giá dịch vụ',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertEquals(1, $executed, 'Must execute exactly ONE quote rule, never duplicate.');
        $this->assertEquals(1, $conversation->messages()->where('sender_type', '!=', ChatMessageSenderType::Visitor)->count(), 'Exactly one bot reply should be sent.');

        // Verify bot sent reply
        $botMsg = $conversation->messages()->where('sender_type', '!=', ChatMessageSenderType::Visitor)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('bảng giá dịch vụ', mb_strtolower($botMsg->message_body, 'UTF-8'));
        $this->assertStringContainsString('bạn đang quan tâm đến nhóm dịch vụ nào', mb_strtolower($botMsg->message_body, 'UTF-8'));

        // Verify options tag is present
        $this->assertStringContainsString('[OPTIONS:', $botMsg->message_body);
        $this->assertStringContainsString('Sản xuất TVC', $botMsg->message_body);
        $this->assertStringContainsString('Livestream', $botMsg->message_body);
        $this->assertStringContainsString('Website', $botMsg->message_body);

        // Verify ChatMessageResource cleanly extracts options
        $resource = (new ChatMessageResource($botMsg))->toArray(new Request());
        $this->assertIsArray($resource['options']);
        $this->assertCount(5, $resource['options']);
        $this->assertStringNotContainsString('[OPTIONS:', $resource['message']);
        $this->assertEquals($botMsg->id, $resource['id']);
    }

    /**
     * Test 2: Customer selects TVC service returns TVC pricing tier details.
     */
    public function test_02_customer_selects_tvc_returns_tvc_package_pricing(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => '🎬 Sản xuất TVC & Video quảng cáo',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertGreaterThanOrEqual(1, $executed);

        $botMsg = $conversation->messages()->where('sender_type', '!=', ChatMessageSenderType::Visitor)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('Sản xuất TVC & Video quảng cáo', $botMsg->message_body);
        $this->assertStringContainsString('TikTok', $botMsg->message_body);
    }

    /**
     * Test 3: Customer selects Livestream service returns Livestream pricing tier details.
     */
    public function test_03_customer_selects_livestream_returns_livestream_pricing(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => '📡 Dịch vụ Livestream sự kiện',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertGreaterThanOrEqual(1, $executed);

        $botMsg = $conversation->messages()->where('sender_type', '!=', ChatMessageSenderType::Visitor)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('Livestream sự kiện', $botMsg->message_body);
        $this->assertStringContainsString('máy quay', $botMsg->message_body);
    }

    /**
     * Test 4: Customer selects Photo service returns Photography package pricing.
     */
    public function test_04_customer_selects_photo_returns_photo_pricing(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => '📸 Chụp ảnh sự kiện & Profile',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertGreaterThanOrEqual(1, $executed);

        $botMsg = $conversation->messages()->where('sender_type', '!=', ChatMessageSenderType::Visitor)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('Chụp ảnh sự kiện & Profile', $botMsg->message_body);
    }

    /**
     * Test 5: Customer selects Web service returns Website package pricing.
     */
    public function test_05_customer_selects_web_returns_web_pricing(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => '💻 Thiết kế Website & Phần mềm',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertGreaterThanOrEqual(1, $executed);

        $botMsg = $conversation->messages()->where('sender_type', '!=', ChatMessageSenderType::Visitor)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('Thiết kế Website & Phần mềm', $botMsg->message_body);
    }

    /**
     * Test 6: Customer selects Direct advisor returns advisor contact confirmation.
     */
    public function test_06_customer_selects_direct_advisor_returns_contact_notice(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        $msg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => '📞 Báo giá trực tiếp qua Hotline/Zalo',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $executed = $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $msg,
            'visitor' => $visitor,
            'event_id' => $msg->message_uuid,
        ]);

        $this->assertGreaterThanOrEqual(1, $executed);

        $botMsg = $conversation->messages()->where('sender_type', '!=', ChatMessageSenderType::Visitor)->latest('id')->first();
        $this->assertNotNull($botMsg);
        $this->assertStringContainsString('0939 363 262', $botMsg->message_body);
    }

    /**
     * Test 7: Verify conversation creation greeting precedes visitor quote selection in message ordering.
     */
    public function test_07_full_lifecycle_greeting_precedes_customer_quote_selection(): void
    {
        [$visitor, $conversation] = $this->createVisitorAndConversation();

        // Step 1: Conversation created trigger delivers welcome greeting
        $this->engine->handleTrigger('conversation_created', [
            'conversation' => $conversation,
            'visitor' => $visitor,
            'event_id' => 'evt_created_' . uniqid(),
        ]);

        $welcomeMsg = $conversation->messages()->first();
        $this->assertNotNull($welcomeMsg);
        $this->assertStringContainsString('Chào bạn', $welcomeMsg->message_body);

        // Step 2: Customer selects quote inquiry
        $visitorMsg = $conversation->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Bảng giá dịch vụ',
            'status' => \App\Enums\ChatMessageStatus::Sent,
        ]);

        $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $visitorMsg,
            'visitor' => $visitor,
            'event_id' => $visitorMsg->message_uuid,
        ]);

        // Step 3: Retrieve all messages ordered by (created_at asc, id asc)
        $orderedMessages = $conversation->messages()->orderBy('created_at', 'asc')->orderBy('id', 'asc')->get();

        $this->assertCount(3, $orderedMessages);
        $this->assertEquals($welcomeMsg->id, $orderedMessages[0]->id, 'First message must be the welcome greeting.');
        $this->assertEquals($visitorMsg->id, $orderedMessages[1]->id, 'Second message must be the visitor choice.');
        $this->assertStringContainsString('nhóm dịch vụ nào', $orderedMessages[2]->message_body, 'Third message must be quote inquiry.');
    }
}
