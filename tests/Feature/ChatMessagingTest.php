<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Tests\TestCase;

class ChatMessagingTest extends TestCase
{
    protected string $cookieName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');
        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');
    }

    /**
     * Helper to initialize a visitor session and obtain the token.
     */
    protected function createVisitorSession(): array
    {
        $res = $this->postJson('/api/chat/session/init');
        $cookie = $res->getCookie($this->cookieName, false);

        return [
            'visitor_uuid' => $res->json('visitor_uuid'),
            'token' => $cookie?->getValue(),
            'visitor' => ChatVisitor::where('visitor_uuid', $res->json('visitor_uuid'))->first(),
        ];
    }

    /**
     * Test 1: Visitor can create a new conversation when none exists.
     */
    public function test_01_visitor_can_create_conversation(): void
    {
        $session = $this->createVisitorSession();

        $response = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'conversation_uuid',
                'status',
                'channel',
                'visitor_unread_count',
                'last_message_at',
                'created_at',
            ],
        ]);

        $uuid = $response->json('data.conversation_uuid');
        $this->assertTrue(Str::isUuid($uuid));
        $this->assertEquals('open', $response->json('data.status'));
        $this->assertEquals('human', $response->json('data.channel'));

        // Internal IDs must never be exposed
        $response->assertJsonMissing(['id', 'chat_visitor_id', 'assigned_to_user_id']);

        $this->assertDatabaseHas('chat_conversations', [
            'conversation_uuid' => $uuid,
            'chat_visitor_id' => $session['visitor']->id,
            'status' => 'open',
        ]);
    }

    /**
     * Test 2: Reuse active conversation according to policy (idempotent).
     */
    public function test_02_reuse_active_conversation_policy(): void
    {
        $session = $this->createVisitorSession();

        // First call creates conversation
        $res1 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid1 = $res1->json('data.conversation_uuid');

        $countBefore = ChatConversation::where('chat_visitor_id', $session['visitor']->id)->count();
        $this->assertEquals(1, $countBefore);

        // Subsequent calls while conversation is active must reuse the same conversation
        $res2 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');

        $res2->assertStatus(200);
        $this->assertEquals($convUuid1, $res2->json('data.conversation_uuid'));

        // No duplicate conversation created
        $countAfter = ChatConversation::where('chat_visitor_id', $session['visitor']->id)->count();
        $this->assertEquals(1, $countAfter);
    }

    /**
     * Test 3: Conversation list only returns conversations belonging to the authenticated visitor.
     */
    public function test_03_conversation_list_only_returns_own_conversations(): void
    {
        $sessionA = $this->createVisitorSession();
        $sessionB = $this->createVisitorSession();

        // Visitor A creates a conversation
        $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson('/api/chat/conversations');

        // Visitor B creates a conversation
        $this->withCookie($this->cookieName, $sessionB['token'])
            ->postJson('/api/chat/conversations');

        // Visitor A lists conversations
        $resA = $this->withCookie($this->cookieName, $sessionA['token'])
            ->getJson('/api/chat/conversations');

        $resA->assertStatus(200);
        $this->assertCount(1, $resA->json('data'));

        // Conversation listed belongs to Visitor A
        $convUuid = $resA->json('data.0.conversation_uuid');
        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $this->assertEquals($sessionA['visitor']->id, $conv->chat_visitor_id);
    }

    /**
     * Test 4: Visitor A cannot read conversation of Visitor B (IDOR prevention -> 404).
     */
    public function test_04_visitor_cannot_access_foreign_conversation_detail(): void
    {
        $sessionA = $this->createVisitorSession();
        $sessionB = $this->createVisitorSession();

        $resB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->postJson('/api/chat/conversations');
        $convUuidB = $resB->json('data.conversation_uuid');

        // Visitor A attempts to access Visitor B's conversation
        $response = $this->withCookie($this->cookieName, $sessionA['token'])
            ->getJson("/api/chat/conversations/{$convUuidB}");

        $response->assertStatus(404);
    }

    /**
     * Corrective Test: Conversation pagination contract (default 15, max 100, capped at 100).
     */
    public function test_conversation_pagination_contract(): void
    {
        $session = $this->createVisitorSession();

        // Seed 110 closed conversations for this visitor
        for ($i = 1; $i <= 110; $i++) {
            ChatConversation::create([
                'chat_visitor_id' => $session['visitor']->id,
                'status' => ChatConversationStatus::Closed,
                'channel' => ChatConversationChannel::Human,
                'created_at' => now()->subMinutes(120 - $i),
            ]);
        }

        // 1. Request without per_page parameter must return exactly 15 records
        $resDefault = $this->withCookie($this->cookieName, $session['token'])
            ->getJson('/api/chat/conversations');

        $resDefault->assertStatus(200);
        $this->assertCount(15, $resDefault->json('data'));
        $this->assertEquals(15, $resDefault->json('meta.per_page'));
        $this->assertEquals(110, $resDefault->json('meta.total'));

        // 2. Request with per_page = 100 must be accepted and return exactly 100 records
        $res100 = $this->withCookie($this->cookieName, $session['token'])
            ->getJson('/api/chat/conversations?per_page=100');

        $res100->assertStatus(200);
        $this->assertCount(100, $res100->json('data'));
        $this->assertEquals(100, $res100->json('meta.per_page'));

        // 3. Request with per_page > 100 (e.g. 150) must be capped at 100 records
        $resCapped = $this->withCookie($this->cookieName, $session['token'])
            ->getJson('/api/chat/conversations?per_page=150');

        $resCapped->assertStatus(200);
        $this->assertCount(100, $resCapped->json('data'));
        $this->assertEquals(100, $resCapped->json('meta.per_page'));

        // Ensure internal database IDs are not exposed in pagination data
        $resDefault->assertJsonMissing(['id', 'chat_visitor_id', 'assigned_to_user_id', 'closed_by_user_id']);
    }

    /**
     * Corrective Test: Concurrency on conversation creation produces exactly 1 active conversation.
     * Simulates concurrent OS processes invoking getOrCreateActiveConversation simultaneously.
     */
    public function test_concurrent_conversation_creation_produces_single_active_conversation(): void
    {
        $session = $this->createVisitorSession();
        $visitorId = $session['visitor']->id;

        $cmd = 'php -r "require \'vendor/autoload.php\'; $app = require \'bootstrap/app.php\'; $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); $v = App\Models\ChatVisitor::find(' . $visitorId . '); $c = app(App\Services\Chat\ChatConversationService::class)->getOrCreateActiveConversation($v); echo $c->conversation_uuid;"';

        $p1 = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes1);
        $p2 = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes2);
        $p3 = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes3);

        $out1 = trim(stream_get_contents($pipes1[1])); fclose($pipes1[1]); fclose($pipes1[2]); proc_close($p1);
        $out2 = trim(stream_get_contents($pipes2[1])); fclose($pipes2[1]); fclose($pipes2[2]); proc_close($p2);
        $out3 = trim(stream_get_contents($pipes3[1])); fclose($pipes3[1]); fclose($pipes3[2]); proc_close($p3);

        $this->assertTrue(Str::isUuid($out1));
        $this->assertEquals($out1, $out2);
        $this->assertEquals($out1, $out3);

        // Exactly one active conversation exists for this visitor
        $activeCount = ChatConversation::where('chat_visitor_id', $visitorId)
            ->whereIn('status', ['open', 'assigned', 'waiting_customer', 'waiting_agent'])
            ->count();

        $this->assertEquals(1, $activeCount);
    }

    /**
     * Test 5: Visitor sends message successfully.
     */
    public function test_05_visitor_can_send_message(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Xin chào, tôi cần tư vấn dịch vụ livestream.',
            ]);

        $msgRes->assertStatus(201);
        $msgRes->assertJsonStructure([
            'data' => [
                'message_uuid',
                'sender_type',
                'message',
                'status',
                'recalled',
                'created_at',
            ],
        ]);

        $this->assertEquals('Xin chào, tôi cần tư vấn dịch vụ livestream.', $msgRes->json('data.message'));
        $this->assertEquals('visitor', $msgRes->json('data.sender_type'));
        $this->assertEquals('sent', $msgRes->json('data.status'));
        $this->assertFalse($msgRes->json('data.recalled'));

        // No internal database IDs leaked
        $msgRes->assertJsonMissing(['id', 'chat_conversation_id', 'sender_user_id']);
    }

    /**
     * Test 6: Message sender is strictly set to 'visitor' and sender_user_id is null server-side.
     */
    public function test_06_sender_is_strictly_visitor_server_side(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Test sender enforcement',
            ]);

        $msgUuid = $msgRes->json('data.message_uuid');
        $dbMsg = ChatMessage::where('message_uuid', $msgUuid)->first();

        $this->assertNotNull($dbMsg);
        $this->assertEquals(ChatMessageSenderType::Visitor, $dbMsg->sender_type);
        $this->assertNull($dbMsg->sender_user_id);
    }

    /**
     * Test 7: Client cannot spoof sender_type or sender_user_id.
     */
    public function test_07_client_cannot_spoof_sender_role(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Malicious attempt to spoof agent',
                'sender_type' => 'agent',
                'sender_user_id' => 1,
            ]);

        $msgRes->assertStatus(201);
        $this->assertEquals('visitor', $msgRes->json('data.sender_type'));

        $msgUuid = $msgRes->json('data.message_uuid');
        $dbMsg = ChatMessage::where('message_uuid', $msgUuid)->first();
        $this->assertEquals(ChatMessageSenderType::Visitor, $dbMsg->sender_type);
        $this->assertNull($dbMsg->sender_user_id);
    }

    /**
     * Test 8: Message validation (rejects empty string, whitespace only, strips HTML tags).
     */
    public function test_08_message_validation(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        // Empty message rejected
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => ''])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['message']);

        // Whitespace only rejected
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => '   '])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['message']);

        // HTML stripped
        $res = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => '<script>alert("xss")</script>Hello <b>World</b>',
            ]);
        $res->assertStatus(201);
        $this->assertEquals('alert("xss")Hello World', $res->json('data.message'));
    }

    /**
     * Test 9: Message pagination and page size bounds.
     */
    public function test_09_message_pagination(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();

        // Seed 35 messages
        for ($i = 1; $i <= 35; $i++) {
            $conv->messages()->create([
                'sender_type' => ChatMessageSenderType::Visitor,
                'message_body' => "Message number {$i}",
                'status' => ChatMessageStatus::Sent,
            ]);
        }

        // Default pagination (30 per page)
        $res = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages");

        $res->assertStatus(200);
        $this->assertCount(30, $res->json('data'));
        $this->assertEquals(35, $res->json('meta.total'));

        // Request with custom per_page = 10
        $resCustom = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages?per_page=10");
        $this->assertCount(10, $resCustom->json('data'));

        // Request with excessive per_page = 500 is capped at maximum 100
        $resExcessive = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages?per_page=500");
        $this->assertCount(35, $resExcessive->json('data'));
    }

    /**
     * Test 10: Stable message ordering (created_at ASC, id ASC).
     */
    public function test_10_stable_message_ordering(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();

        $m1 = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'First message',
            'status' => ChatMessageStatus::Sent,
            'created_at' => now()->subMinutes(5),
        ]);
        $m2 = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Second message',
            'status' => ChatMessageStatus::Sent,
            'created_at' => now()->subMinutes(3),
        ]);
        $m3 = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Third message',
            'status' => ChatMessageStatus::Sent,
            'created_at' => now()->subMinute(),
        ]);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages");

        $items = $res->json('data');
        $this->assertEquals($m1->message_uuid, $items[0]['message_uuid']);
        $this->assertEquals($m2->message_uuid, $items[1]['message_uuid']);
        $this->assertEquals($m3->message_uuid, $items[2]['message_uuid']);
    }

    /**
     * Test 11: Visitor can edit their own message within 15 minutes.
     */
    public function test_11_visitor_can_edit_own_message_within_window(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Original text',
            ]);
        $msgUuid = $msgRes->json('data.message_uuid');

        // Edit message
        $editRes = $this->withCookie($this->cookieName, $session['token'])
            ->patchJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}", [
                'message' => 'Edited text content',
            ]);

        $editRes->assertStatus(200);
        $this->assertEquals('Edited text content', $editRes->json('data.message'));
        $this->assertNotNull($editRes->json('data.edited_at'));

        $dbMsg = ChatMessage::where('message_uuid', $msgUuid)->first();
        $this->assertEquals('Edited text content', $dbMsg->message_body);
        $this->assertNotNull($dbMsg->edited_at);
    }

    /**
     * Test 12: Visitor cannot edit message of another visitor (IDOR -> 404).
     */
    public function test_12_visitor_cannot_edit_foreign_message(): void
    {
        $sessionA = $this->createVisitorSession();
        $sessionB = $this->createVisitorSession();

        $convResB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->postJson('/api/chat/conversations');
        $convUuidB = $convResB->json('data.conversation_uuid');

        $msgResB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->postJson("/api/chat/conversations/{$convUuidB}/messages", [
                'message' => 'Secret message B',
            ]);
        $msgUuidB = $msgResB->json('data.message_uuid');

        // Visitor A tries to edit Visitor B's message
        $editRes = $this->withCookie($this->cookieName, $sessionA['token'])
            ->patchJson("/api/chat/conversations/{$convUuidB}/messages/{$msgUuidB}", [
                'message' => 'Hacked text',
            ]);

        $editRes->assertStatus(404);
    }

    /**
     * Test 13: Visitor cannot edit agent, bot, or system message (403 Forbidden).
     */
    public function test_13_visitor_cannot_edit_agent_or_system_message(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $agentMsg = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Agent,
            'message_body' => 'Xin chào quý khách, tôi là tư vấn viên.',
            'status' => ChatMessageStatus::Sent,
        ]);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->patchJson("/api/chat/conversations/{$convUuid}/messages/{$agentMsg->message_uuid}", [
                'message' => 'Visitor trying to tamper agent response',
            ]);

        $res->assertStatus(403);
    }

    /**
     * Test 14: Editing after 15 minutes is rejected (422 Unprocessable Entity).
     */
    public function test_14_edit_after_15_minutes_rejected(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $oldMsg = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Sent 20 minutes ago',
            'status' => ChatMessageStatus::Sent,
        ]);
        $oldMsg->created_at = now()->subMinutes(20);
        $oldMsg->saveQuietly();

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->patchJson("/api/chat/conversations/{$convUuid}/messages/{$oldMsg->message_uuid}", [
                'message' => 'Late edit attempt',
            ]);

        $res->assertStatus(422);
    }

    /**
     * Test 15: Visitor can recall own message within 60 minutes.
     */
    public function test_15_visitor_can_recall_own_message(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Typo message to recall',
            ]);
        $msgUuid = $msgRes->json('data.message_uuid');

        // Recall message via action endpoint
        $recallRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}/recall");

        $recallRes->assertStatus(200);
        $this->assertTrue($recallRes->json('data.recalled'));
        $this->assertNull($recallRes->json('data.message'));
        $this->assertNotNull($recallRes->json('data.recalled_at'));

        // Database record retained
        $dbMsg = ChatMessage::where('message_uuid', $msgUuid)->first();
        $this->assertNotNull($dbMsg);
        $this->assertNotNull($dbMsg->recalled_at);
        $this->assertEquals('Typo message to recall', $dbMsg->message_body);
    }

    /**
     * Test 16: Recall after 60 minutes is rejected (422 Unprocessable Entity).
     */
    public function test_16_recall_after_60_minutes_rejected(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $oldMsg = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Sent 65 minutes ago',
            'status' => ChatMessageStatus::Sent,
        ]);
        $oldMsg->created_at = now()->subMinutes(65);
        $oldMsg->saveQuietly();

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages/{$oldMsg->message_uuid}/recall");

        $res->assertStatus(422);
    }

    /**
     * Test 17: Visitor cannot recall another visitor's message (404 Not Found).
     */
    public function test_17_visitor_cannot_recall_foreign_message(): void
    {
        $sessionA = $this->createVisitorSession();
        $sessionB = $this->createVisitorSession();

        $convResB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->postJson('/api/chat/conversations');
        $convUuidB = $convResB->json('data.conversation_uuid');

        $msgResB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->postJson("/api/chat/conversations/{$convUuidB}/messages", [
                'message' => 'Visitor B message',
            ]);
        $msgUuidB = $msgResB->json('data.message_uuid');

        $res = $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson("/api/chat/conversations/{$convUuidB}/messages/{$msgUuidB}/recall");

        $res->assertStatus(404);
    }

    /**
     * Test 18: Recalled message is retained in DB, but content is masked in public API list.
     */
    public function test_18_recalled_message_masked_in_public_history(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $msg = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Sensitive credit card info by mistake',
            'status' => ChatMessageStatus::Sent,
            'recalled_at' => now(),
        ]);

        $listRes = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages");

        $listRes->assertStatus(200);
        $item = $listRes->json('data.0');

        $this->assertEquals($msg->message_uuid, $item['message_uuid']);
        $this->assertTrue($item['recalled']);
        $this->assertNull($item['message']);
        $this->assertNotNull($item['recalled_at']);

        // Verify DB still retains the original body for audit/compliance
        $this->assertDatabaseHas('chat_messages', [
            'id' => $msg->id,
            'message_body' => 'Sensitive credit card info by mistake',
        ]);
    }

    /**
     * Test 19: Spam conversation rejects new messages (403 Forbidden).
     */
    public function test_19_spam_conversation_rejects_messages(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $conv->update(['status' => ChatConversationStatus::Spam]);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Spamming message',
            ]);

        $res->assertStatus(403);
    }

    /**
     * Test 20: Closed conversation rejects new messages (422 Unprocessable Entity).
     */
    public function test_20_closed_conversation_rejects_messages(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $conv->update(['status' => ChatConversationStatus::Closed, 'closed_at' => now()]);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Sending to closed conversation',
            ]);

        $res->assertStatus(422);
    }

    /**
     * Test 21: Conversation last_message_at and agent_unread_count update correctly when visitor sends message.
     */
    public function test_21_conversation_metadata_updated_on_message(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $this->assertNull($conv->last_message_at);
        $this->assertEquals(0, $conv->agent_unread_count);

        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Hello team',
            ]);

        $conv->refresh();
        $this->assertNotNull($conv->last_message_at);
        $this->assertEquals(1, $conv->agent_unread_count);

        // Sending second message increments agent_unread_count to 2
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Second message from visitor',
            ]);

        $conv->refresh();
        $this->assertEquals(2, $conv->agent_unread_count);
    }

    /**
     * Test 22: Initial message status is strictly 'sent'.
     */
    public function test_22_initial_message_status_is_sent(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Status check message',
            ]);

        $this->assertEquals('sent', $msgRes->json('data.status'));

        $msgUuid = $msgRes->json('data.message_uuid');
        $dbMsg = ChatMessage::where('message_uuid', $msgUuid)->first();
        $this->assertEquals(ChatMessageStatus::Sent, $dbMsg->status);
    }

    /**
     * Test 23: Visitor cannot forge 'delivered' or 'read' status.
     */
    public function test_23_visitor_cannot_forge_status(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Fake status attempt',
                'status' => 'read',
            ]);

        $this->assertEquals('sent', $msgRes->json('data.status'));

        $msgUuid = $msgRes->json('data.message_uuid');
        $dbMsg = ChatMessage::where('message_uuid', $msgUuid)->first();
        $this->assertEquals(ChatMessageStatus::Sent, $dbMsg->status);
    }

    /**
     * Test 24: Rate limiting on message sending triggers 429 when threshold exceeded.
     */
    public function test_24_rate_limiting_message_send(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $limit = (int) config('chat.message_send_rate_limit', 30);
        $limiterKey = md5('chat-message-send'.'visitor:'.$session['visitor_uuid']);

        // Simulate consuming rate limit attempts
        for ($i = 0; $i < $limit; $i++) {
            RateLimiter::hit($limiterKey, 60);
        }

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Flood attempt',
            ]);

        $res->assertStatus(429);
    }

    /**
     * Test 25: Mark conversation as read resets visitor_unread_count to 0.
     */
    public function test_25_mark_conversation_as_read(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $conv->update(['visitor_unread_count' => 5]);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/read");

        $res->assertStatus(200);
        $conv->refresh();
        $this->assertEquals(0, $conv->visitor_unread_count);
    }

    /**
     * Corrective Test: Message concurrency prevents lost updates on agent_unread_count.
     * Simulates 5 concurrent OS processes sending messages simultaneously into the same conversation.
     */
    public function test_concurrent_message_sending_prevents_lost_updates(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $conv = ChatConversation::where('conversation_uuid', $convUuid)->first();
        $conv->update([
            'status' => ChatConversationStatus::WaitingCustomer,
            'agent_unread_count' => 0,
        ]);

        $visitorId = $session['visitor']->id;
        $convId = $conv->id;
        $processes = [];
        $pipes = [];

        // Launch 5 concurrent worker processes
        for ($i = 1; $i <= 5; $i++) {
            $cmd = 'php -r "require \'vendor/autoload.php\'; $app = require \'bootstrap/app.php\'; $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); $v = App\Models\ChatVisitor::find(' . $visitorId . '); $c = App\Models\ChatConversation::find(' . $convId . '); $m = app(App\Services\Chat\ChatMessageService::class)->sendMessage($v, $c, \'Concurrent send ' . $i . '\'); echo $m->message_uuid;"';
            $processes[$i] = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes[$i]);
        }

        $uuids = [];
        for ($i = 1; $i <= 5; $i++) {
            $out = stream_get_contents($pipes[$i][1]);
            fclose($pipes[$i][1]);
            fclose($pipes[$i][2]);
            proc_close($processes[$i]);
            $uuids[] = trim($out);
        }

        $conv->refresh();

        // 1. All 5 messages were successfully created
        $this->assertCount(5, array_filter($uuids));
        $this->assertEquals(5, $conv->messages()->count());

        // 2. Lost-update check: agent_unread_count MUST be exactly 5, not a partial/clobbered value
        $this->assertEquals(5, $conv->agent_unread_count);

        // 3. Conversation status transitioned from waiting_customer to waiting_agent
        $this->assertEquals(ChatConversationStatus::WaitingAgent, $conv->status);
    }

    /**
     * Corrective Test: Verify zero leakage of internal database IDs across all responses.
     */
    public function test_internal_id_leakage_protection(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        // Conversation creation response check
        $convRes->assertJsonMissing(['id', 'chat_visitor_id', 'assigned_to_user_id', 'closed_by_user_id']);

        // Send message response check
        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Leakage assertion message',
            ]);
        $msgRes->assertJsonMissing(['id', 'chat_conversation_id', 'sender_user_id']);
        $msgUuid = $msgRes->json('data.message_uuid');

        // Message detail/list response check
        $listRes = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages");
        $listRes->assertJsonMissing(['chat_conversation_id', 'sender_user_id']);
        $firstItem = $listRes->json('data.0');
        $this->assertArrayNotHasKey('id', $firstItem);
        $this->assertArrayHasKey('message_uuid', $firstItem);

        // Edit response check
        $editRes = $this->withCookie($this->cookieName, $session['token'])
            ->patchJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}", [
                'message' => 'Edited text',
            ]);
        $editRes->assertJsonMissing(['id', 'chat_conversation_id', 'sender_user_id']);

        // Recall response check
        $recallRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}/recall");
        $recallRes->assertJsonMissing(['id', 'chat_conversation_id', 'sender_user_id']);
    }

    /**
     * Corrective Test: IDOR protection across conversations and messages.
     * Tests foreign conversation UUID and foreign message UUID combinations on PATCH, POST /recall, DELETE.
     */
    public function test_idor_message_cross_conversation_and_cross_visitor(): void
    {
        $sessionA = $this->createVisitorSession();
        $sessionB = $this->createVisitorSession();

        // Visitor A conversation and message
        $convResA = $this->withCookie($this->cookieName, $sessionA['token'])->postJson('/api/chat/conversations');
        $convUuidA = $convResA->json('data.conversation_uuid');
        $msgResA = $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson("/api/chat/conversations/{$convUuidA}/messages", ['message' => 'Msg A']);
        $msgUuidA = $msgResA->json('data.message_uuid');

        // Visitor B conversation and message
        $convResB = $this->withCookie($this->cookieName, $sessionB['token'])->postJson('/api/chat/conversations');
        $convUuidB = $convResB->json('data.conversation_uuid');
        $msgResB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->postJson("/api/chat/conversations/{$convUuidB}/messages", ['message' => 'Msg B']);
        $msgUuidB = $msgResB->json('data.message_uuid');

        // Case 1: Visitor A attempts actions directly on Visitor B's conversation + message (404)
        $this->withCookie($this->cookieName, $sessionA['token'])
            ->patchJson("/api/chat/conversations/{$convUuidB}/messages/{$msgUuidB}", ['message' => 'Tamper'])
            ->assertStatus(404);

        $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson("/api/chat/conversations/{$convUuidB}/messages/{$msgUuidB}/recall")
            ->assertStatus(404);

        $this->withCookie($this->cookieName, $sessionA['token'])
            ->deleteJson("/api/chat/conversations/{$convUuidB}/messages/{$msgUuidB}")
            ->assertStatus(404);

        // Case 2: Visitor A passes their own conversation UUID but Visitor B's message UUID (404)
        $this->withCookie($this->cookieName, $sessionA['token'])
            ->patchJson("/api/chat/conversations/{$convUuidA}/messages/{$msgUuidB}", ['message' => 'Cross-tamper'])
            ->assertStatus(404);

        $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson("/api/chat/conversations/{$convUuidA}/messages/{$msgUuidB}/recall")
            ->assertStatus(404);

        $this->withCookie($this->cookieName, $sessionA['token'])
            ->deleteJson("/api/chat/conversations/{$convUuidA}/messages/{$msgUuidB}")
            ->assertStatus(404);
    }

    /**
     * Corrective Test: Recalled message cannot be edited (422 Unprocessable Entity).
     */
    public function test_visitor_cannot_edit_recalled_message(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Will recall then edit']);
        $msgUuid = $msgRes->json('data.message_uuid');

        // Recall message
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}/recall")
            ->assertStatus(200);

        // Attempt edit on recalled message must fail with 422
        $res = $this->withCookie($this->cookieName, $session['token'])
            ->patchJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}", [
                'message' => 'Trying to edit after recall',
            ]);

        $res->assertStatus(422);
    }

    /**
     * Corrective Test: Visitor can recall message via HTTP DELETE verb.
     */
    public function test_visitor_can_recall_via_delete_method(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Delete verb recall test']);
        $msgUuid = $msgRes->json('data.message_uuid');

        // Recall via DELETE method
        $deleteRes = $this->withCookie($this->cookieName, $session['token'])
            ->deleteJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}");

        $deleteRes->assertStatus(200);
        $this->assertTrue($deleteRes->json('data.recalled'));
        $this->assertNull($deleteRes->json('data.message'));

        // Database record must NOT be physically deleted
        $this->assertDatabaseHas('chat_messages', [
            'message_uuid' => $msgUuid,
        ]);
        $dbMsg = ChatMessage::where('message_uuid', $msgUuid)->first();
        $this->assertNotNull($dbMsg->recalled_at);
    }

    /**
     * Corrective Test: Unauthenticated requests without cookie are rejected with HTTP 401.
     */
    public function test_unauthenticated_messaging_request_rejected(): void
    {
        // 1. GET /api/chat/conversations without cookie
        $this->getJson('/api/chat/conversations')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated visitor session.']);

        // 2. POST /api/chat/conversations without cookie
        $this->postJson('/api/chat/conversations')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated visitor session.']);

        // 3. POST messages without cookie
        $fakeUuid = (string) Str::uuid();
        $this->postJson("/api/chat/conversations/{$fakeUuid}/messages", ['message' => 'No cookie'])
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated visitor session.']);
    }
}

