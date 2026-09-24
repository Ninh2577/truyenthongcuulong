<?php

namespace Tests\Feature;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Events\Chat\ChatConversationRead;
use App\Events\Chat\ChatConversationUpdated;
use App\Events\Chat\ChatMessageCreated;
use App\Events\Chat\ChatMessageRecalled;
use App\Events\Chat\ChatMessageUpdated;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatAgentMessageService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatRealtimeSyncTest extends TestCase
{
    protected string $cookieName;
    protected User $agentUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');
        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');

        Role::firstOrCreate(['name' => 'Biên Tập Viên']);
        $this->agentUser = User::factory()->create([
            'email' => 'sync_agent_' . Str::random(8) . '@example.com',
        ]);
        $this->agentUser->assignRole('Biên Tập Viên');
    }

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
     * Test 1: ChatMessageCreated event contains zero numeric IDs, tokens, or private paths.
     */
    public function test_01_message_created_event_payload_is_strictly_safe_and_id_free(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        /** @var ChatMessageService $service */
        $service = app(ChatMessageService::class);
        $message = $service->sendMessage($session['visitor'], $conversation, 'Xin chào công ty');

        $event = new ChatMessageCreated($message);
        $payload = $event->publicPayload();

        $this->assertEquals($conversation->conversation_uuid, $payload['conversation_uuid']);
        $this->assertEquals($message->message_uuid, $payload['message_uuid']);
        $this->assertEquals('visitor', $payload['sender_type']);
        $this->assertEquals('Xin chào công ty', $payload['message']);
        $this->assertFalse($payload['recalled']);
        $this->assertIsArray($payload['attachments']);

        // Assert strictly zero internal numeric IDs, zero visitor tokens, zero private paths
        $this->assertArrayNotHasKey('id', $payload);
        $this->assertArrayNotHasKey('chat_conversation_id', $payload);
        $this->assertArrayNotHasKey('sender_user_id', $payload);
        $this->assertArrayNotHasKey('chat_visitor_id', $payload);
        $this->assertArrayNotHasKey('session_token', $payload);
        $this->assertArrayNotHasKey('file_path', $payload);
        $this->assertArrayNotHasKey('storage_path', $payload);
    }

    /**
     * Test 2: ChatMessageUpdated and ChatMessageRecalled mask sensitive content.
     */
    public function test_02_message_updated_and_recalled_events_payload_security(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $conversation = ChatConversation::where('conversation_uuid', $convRes->json('data.conversation_uuid'))->firstOrFail();

        /** @var ChatMessageService $service */
        $service = app(ChatMessageService::class);
        $message = $service->sendMessage($session['visitor'], $conversation, 'Tin nhắn ban đầu');

        // Edit
        $edited = $service->editMessage($session['visitor'], $conversation, $message->message_uuid, 'Tin nhắn đã sửa');
        $updateEvent = new ChatMessageUpdated($edited);
        $updatePayload = $updateEvent->publicPayload();

        $this->assertEquals('Tin nhắn đã sửa', $updatePayload['message']);
        $this->assertNotNull($updatePayload['edited_at']);
        $this->assertArrayNotHasKey('id', $updatePayload);

        // Recall
        $recalled = $service->recallMessage($session['visitor'], $conversation, $message->message_uuid);
        $recallEvent = new ChatMessageRecalled($recalled);
        $recallPayload = $recallEvent->publicPayload();

        $this->assertNull($recallPayload['message']);
        $this->assertTrue($recallPayload['recalled']);
        $this->assertEmpty($recallPayload['attachments']);
        $this->assertArrayNotHasKey('id', $recallPayload);
    }

    /**
     * Test 3: ChatConversationUpdated and ChatConversationRead events payload safety.
     */
    public function test_03_conversation_events_payload_security(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $conversation = ChatConversation::where('conversation_uuid', $convRes->json('data.conversation_uuid'))->firstOrFail();

        $updatedEvent = new ChatConversationUpdated($conversation);
        $upPayload = $updatedEvent->publicPayload();

        $this->assertEquals($conversation->conversation_uuid, $upPayload['conversation_uuid']);
        $this->assertEquals('open', $upPayload['status']);
        $this->assertArrayNotHasKey('id', $upPayload);
        $this->assertArrayNotHasKey('chat_visitor_id', $upPayload);
        $this->assertArrayNotHasKey('assigned_to_user_id', $upPayload);

        $readEvent = new ChatConversationRead($conversation, 'visitor');
        $readPayload = $readEvent->publicPayload();

        $this->assertEquals($conversation->conversation_uuid, $readPayload['conversation_uuid']);
        $this->assertEquals('visitor', $readPayload['reader_type']);
        $this->assertNotNull($readPayload['read_at']);
        $this->assertArrayNotHasKey('id', $readPayload);
    }

    /**
     * Test 4: Visitor message sending dispatches ChatMessageCreated and ChatConversationUpdated.
     */
    public function test_04_visitor_sending_dispatches_events(): void
    {
        Event::fake([ChatMessageCreated::class, ChatConversationUpdated::class]);

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Xin chào tư vấn viên',
            ])
            ->assertStatus(201);

        Event::assertDispatched(ChatMessageCreated::class, function ($e) use ($convUuid) {
            return $e->message === 'Xin chào tư vấn viên'
                && $e->conversationUuid === $convUuid;
        });

        Event::assertDispatched(ChatConversationUpdated::class, function ($e) use ($convUuid) {
            return $e->conversationUuid === $convUuid;
        });
    }

    /**
     * Test 5: Agent message sending dispatches ChatMessageCreated and ChatConversationUpdated.
     */
    public function test_05_agent_sending_dispatches_events(): void
    {
        Event::fake([ChatMessageCreated::class, ChatConversationUpdated::class]);

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        /** @var ChatAgentMessageService $agentMsgService */
        $agentMsgService = app(ChatAgentMessageService::class);
        $agentMsgService->sendAgentMessage($this->agentUser, $conversation, 'Dạ chào bạn, tôi có thể hỗ trợ gì?');

        Event::assertDispatched(ChatMessageCreated::class, function ($e) use ($convUuid) {
            return $e->senderType === 'agent'
                && $e->conversationUuid === $convUuid;
        });

        Event::assertDispatched(ChatConversationUpdated::class, function ($e) use ($convUuid) {
            return $e->conversationUuid === $convUuid
                && $e->status === ChatConversationStatus::WaitingCustomer->value;
        });
    }

    /**
     * Test 6: Catch-up cursor filtering with after_uuid parameter.
     */
    public function test_06_catch_up_cursor_with_after_uuid(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        // Send Message 1
        $res1 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Tin 1']);
        $uuid1 = $res1->json('data.message_uuid');

        // Send Message 2
        $res2 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Tin 2']);
        $uuid2 = $res2->json('data.message_uuid');

        // Send Message 3
        $res3 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Tin 3']);
        $uuid3 = $res3->json('data.message_uuid');

        // Full list should have 3 messages
        $fullList = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages");
        $fullList->assertStatus(200);
        $this->assertCount(3, $fullList->json('data'));

        // Catch-up after uuid1 should return only uuid2 and uuid3
        $catchUp1 = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages?after_uuid={$uuid1}");
        $catchUp1->assertStatus(200);
        $data1 = $catchUp1->json('data');
        $this->assertCount(2, $data1);
        $this->assertEquals($uuid2, $data1[0]['message_uuid']);
        $this->assertEquals($uuid3, $data1[1]['message_uuid']);

        // Catch-up after uuid3 should return empty array
        $catchUp3 = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages?after_uuid={$uuid3}");
        $catchUp3->assertStatus(200);
        $this->assertCount(0, $catchUp3->json('data'));
    }

    /**
     * Test 7: Burst message ordering is strictly deterministic.
     */
    public function test_07_burst_message_ordering_is_strictly_deterministic(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $sentUuids = [];
        for ($i = 1; $i <= 5; $i++) {
            $r = $this->withCookie($this->cookieName, $session['token'])
                ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                    'message' => "Burst message #{$i}",
                ]);
            $sentUuids[] = $r->json('data.message_uuid');
        }

        $listRes = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}/messages?per_page=10");
        $listRes->assertStatus(200);

        $fetchedUuids = array_column($listRes->json('data'), 'message_uuid');
        $this->assertEquals($sentUuids, $fetchedUuids, 'Burst messages must retain strict chronological ordering.');
    }

    /**
     * Test 8: Unread counter sync and markAsRead event dispatch.
     */
    public function test_08_unread_counter_sync_and_mark_as_read(): void
    {
        Event::fake([ChatConversationRead::class, ChatConversationUpdated::class]);

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        // Agent sends message -> increases visitor_unread_count
        /** @var ChatAgentMessageService $agentMsgService */
        $agentMsgService = app(ChatAgentMessageService::class);
        $agentMsgService->sendAgentMessage($this->agentUser, $conversation, 'Chào bạn');

        $conversation->refresh();
        $this->assertEquals(1, $conversation->visitor_unread_count);

        // Visitor calls markRead endpoint
        $readRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/read");
        $readRes->assertStatus(200);

        $conversation->refresh();
        $this->assertEquals(0, $conversation->visitor_unread_count);

        Event::assertDispatched(ChatConversationRead::class, function ($e) use ($convUuid) {
            return $e->conversationUuid === $convUuid && $e->readerType === 'visitor';
        });
    }

    /**
     * Test 9: Fail-closed IDOR protection on message sync with after_uuid.
     */
    public function test_09_idor_fail_closed_with_after_uuid(): void
    {
        $sessionA = $this->createVisitorSession();
        $sessionB = $this->createVisitorSession();

        $convResA = $this->withCookie($this->cookieName, $sessionA['token'])->postJson('/api/chat/conversations');
        $convUuidA = $convResA->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson("/api/chat/conversations/{$convUuidA}/messages", ['message' => 'Bí mật của A']);
        $uuidA = $msgRes->json('data.message_uuid');

        // Visitor B attempts to query conversation A with after_uuid
        $resB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->getJson("/api/chat/conversations/{$convUuidA}/messages?after_uuid={$uuidA}");

        // Must be rejected with 404 (IDOR prevention)
        $resB->assertStatus(404);
    }

    /**
     * Test 10: Agent conversation lifecycle operations dispatch ChatConversationUpdated.
     */
    public function test_10_agent_lifecycle_operations_dispatch_events(): void
    {
        Event::fake([ChatConversationUpdated::class]);

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        /** @var ChatAgentConversationService $agentConvService */
        $agentConvService = app(ChatAgentConversationService::class);

        // Claim
        $agentConvService->claimConversation($this->agentUser, $conversation);
        Event::assertDispatched(ChatConversationUpdated::class);

        // Close
        $agentConvService->closeConversation($this->agentUser, $conversation);
        Event::assertDispatched(ChatConversationUpdated::class);

        // Reopen
        $agentConvService->reopenConversation($this->agentUser, $conversation);
        Event::assertDispatched(ChatConversationUpdated::class);
    }
}
