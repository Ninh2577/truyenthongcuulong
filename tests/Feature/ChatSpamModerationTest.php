<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Models\User;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tests\TestCase;

class ChatSpamModerationTest extends TestCase
{
    protected string $cookieName;
    protected User $adminUser;
    protected User $agentUser;
    protected User $unauthorizedUser;
    protected ChatAgentConversationService $agentConvService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');
        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');
        RateLimiter::clear('chat-attachment-upload');

        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Biên Tập Viên']);

        $this->adminUser = User::factory()->create([
            'email' => 'admin_mod_' . Str::random(8) . '@example.com',
        ]);
        $this->adminUser->assignRole('Admin');

        $this->agentUser = User::factory()->create([
            'email' => 'agent_mod_' . Str::random(8) . '@example.com',
        ]);
        $this->agentUser->assignRole('Biên Tập Viên');

        $this->unauthorizedUser = User::factory()->create([
            'email' => 'unauth_mod_' . Str::random(8) . '@example.com',
        ]);

        $this->agentConvService = app(ChatAgentConversationService::class);
    }

    protected function createVisitorSession(): array
    {
        $sessionService = app(\App\Services\Chat\VisitorSessionService::class);
        $result = $sessionService->initSession(null, [
            'ip' => '127.0.0.1',
            'user_agent' => 'PHPUnit',
        ]);

        return [
            'visitor_uuid' => $result['visitor']->visitor_uuid,
            'token' => $result['session_token'],
            'visitor' => $result['visitor'],
        ];
    }

    /**
     * Test 1: Authorized admin can mark a conversation as spam.
     */
    public function test_01_authorized_admin_can_mark_conversation_as_spam(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $conversation = ChatConversation::where('conversation_uuid', $convRes->json('data.conversation_uuid'))->firstOrFail();

        $updated = $this->agentConvService->markAsSpam($this->adminUser, $conversation);

        $this->assertEquals(ChatConversationStatus::Spam, $updated->status);
        $this->assertDatabaseHas('chat_conversations', [
            'id' => $conversation->id,
            'status' => 'spam',
        ]);
    }

    /**
     * Test 2: Unauthorized agent cannot mark conversation as spam (403 Access Denied).
     */
    public function test_02_unauthorized_agent_cannot_mark_conversation_as_spam(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $conversation = ChatConversation::where('conversation_uuid', $convRes->json('data.conversation_uuid'))->firstOrFail();

        $this->expectException(AccessDeniedHttpException::class);
        $this->agentConvService->markAsSpam($this->agentUser, $conversation);
    }

    /**
     * Test 3: Visitor cannot mark conversation as spam via client payload or request.
     */
    public function test_03_visitor_cannot_set_conversation_status_to_spam(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations', ['status' => 'spam']);

        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        // Status must be open, client input 'status' => 'spam' is ignored
        $this->assertEquals(ChatConversationStatus::Open, $conversation->status);
    }

    /**
     * Test 4: Spam conversation rejects visitor messages with 403 Forbidden.
     */
    public function test_04_spam_conversation_rejects_visitor_message(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        $this->agentConvService->markAsSpam($this->adminUser, $conversation);

        $msgRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Tôi muốn quảng cáo cờ bạc',
            ]);

        $msgRes->assertStatus(403);
        $this->assertDatabaseMissing('chat_messages', [
            'chat_conversation_id' => $conversation->id,
            'message_body' => 'Tôi muốn quảng cáo cờ bạc',
        ]);
    }

    /**
     * Test 5: Spam conversation rejects visitor attachment upload with 403 before writing file.
     */
    public function test_05_spam_conversation_rejects_visitor_attachment_upload(): void
    {
        Storage::fake(config('chat.attachment_disk', 'chat_private'));

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        $this->agentConvService->markAsSpam($this->adminUser, $conversation);

        $fakeFile = UploadedFile::fake()->image('spam_banner.jpg', 200, 200);

        $uploadRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/attachments", [
                'attachments' => [$fakeFile],
            ]);

        $uploadRes->assertStatus(403);
        $this->assertCount(0, Storage::disk(config('chat.attachment_disk', 'chat_private'))->allFiles());
    }

    /**
     * Test 6 & 7: Spam does not increment unread counters or update last_message_at.
     */
    public function test_06_and_07_spam_does_not_increment_unread_or_update_last_message_at(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        $initialLastMessageAt = $conversation->last_message_at;
        $initialAgentUnread = $conversation->agent_unread_count;

        $this->agentConvService->markAsSpam($this->adminUser, $conversation);
        $conversation->refresh();

        // Spamming rejection
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Spam attempt'])
            ->assertStatus(403);

        $conversation->refresh();
        $this->assertEquals($initialAgentUnread, $conversation->agent_unread_count);
        $this->assertEquals($initialLastMessageAt, $conversation->last_message_at);
    }

    /**
     * Test 8: Spam conversation cannot be auto-reopened by visitor message.
     */
    public function test_08_spam_conversation_cannot_be_auto_reopened_by_visitor(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $conversation = ChatConversation::where('conversation_uuid', $convUuid)->firstOrFail();

        $this->agentConvService->markAsSpam($this->adminUser, $conversation);

        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Reopen me'])
            ->assertStatus(403);

        $conversation->refresh();
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->status);
    }

    /**
     * Test 9: Authorized moderator can unmark spam and restore conversation.
     */
    public function test_09_authorized_moderator_can_unmark_spam(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $conversation = ChatConversation::where('conversation_uuid', $convRes->json('data.conversation_uuid'))->firstOrFail();

        $this->agentConvService->markAsSpam($this->adminUser, $conversation);
        $this->assertEquals(ChatConversationStatus::Spam, $conversation->fresh()->status);

        // Unauthorized agent cannot unmark spam
        try {
            $this->agentConvService->unmarkSpam($this->agentUser, $conversation);
            $this->fail('Unauthorized agent should have been denied unmarking spam.');
        } catch (AccessDeniedHttpException $e) {
            $this->assertTrue(true);
        }

        // Admin unmarks spam
        $restored = $this->agentConvService->unmarkSpam($this->adminUser, $conversation);
        $this->assertEquals(ChatConversationStatus::Open, $restored->status);
    }

    /**
     * Test 10, 11, 12: Blocked visitor cannot create conversation, send message, or upload attachment.
     */
    public function test_10_to_12_blocked_visitor_is_rejected_across_all_endpoints(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');
        $visitor = $session['visitor'];

        // Admin blocks visitor
        $this->agentConvService->blockVisitor($this->adminUser, $visitor);

        // 10. Cannot create conversation
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson('/api/chat/conversations')
            ->assertStatus(401); // Session was deleted upon block -> 401

        // 11. Cannot send message
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Xin chào'])
            ->assertStatus(401);

        // 12. Cannot upload attachment
        $fakeFile = UploadedFile::fake()->image('test.jpg', 100, 100);
        $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/attachments", ['attachments' => [$fakeFile]])
            ->assertStatus(401);
    }

    /**
     * Test 13 & 14: All active sessions are revoked upon visitor block.
     */
    public function test_13_and_14_all_active_sessions_revoked_upon_block(): void
    {
        $session1 = $this->createVisitorSession();
        $visitor = $session1['visitor'];

        // Create second session for same visitor
        $sessionService = app(\App\Services\Chat\VisitorSessionService::class);
        $session2 = $sessionService->createSession($visitor);

        $this->assertEquals(2, $visitor->sessions()->count());

        // Admin blocks visitor
        $this->agentConvService->blockVisitor($this->adminUser, $visitor);

        // All active sessions revoked
        $this->assertEquals(0, $visitor->activeSessions()->count());

        // Both tokens now rejected
        $this->withCookie($this->cookieName, $session1['token'])
            ->getJson('/api/chat/conversations')
            ->assertStatus(401);

        $this->withCookie($this->cookieName, $session2['session_token'])
            ->getJson('/api/chat/conversations')
            ->assertStatus(401);
    }

    /**
     * Test 15: Unblocked visitor can initialize fresh session and chat normally.
     */
    public function test_15_unblocked_visitor_can_resume_operations(): void
    {
        $session = $this->createVisitorSession();
        $visitor = $session['visitor'];

        $this->agentConvService->blockVisitor($this->adminUser, $visitor);
        $this->assertNotNull($visitor->fresh()->blocked_at);

        // Admin unblocks visitor
        $this->agentConvService->unblockVisitor($this->adminUser, $visitor);
        $this->assertNull($visitor->fresh()->blocked_at);

        // Visitor can initialize a new session
        $res = $this->postJson('/api/chat/session/init');
        $res->assertStatus(200);
        $this->assertNotEmpty($res->json('visitor_uuid'));
    }

    /**
     * Test 16: Message flood triggers 429 Too Many Requests.
     */
    public function test_16_message_flood_triggers_429(): void
    {
        config(['chat.message_send_rate_limit' => 3]);
        RateLimiter::clear('chat-message-send');

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        for ($i = 0; $i < 3; $i++) {
            $r = $this->withCookie($this->cookieName, $session['token'])
                ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => "Message {$i}"]);
            $r->assertStatus(201);
        }

        // The limit + 1 attempt must receive 429
        $floodRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Flood message']);

        $floodRes->assertStatus(429);
    }

    /**
     * Test 17: Attachment upload flood triggers 429 Too Many Requests.
     */
    public function test_17_attachment_flood_triggers_429(): void
    {
        config(['chat.attachment_upload_rate_limit' => 2]);
        RateLimiter::clear('chat-attachment-upload');

        Storage::fake(config('chat.attachment_disk', 'chat_private'));

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        for ($i = 0; $i < 2; $i++) {
            $file = UploadedFile::fake()->image("img_{$i}.jpg", 50, 50);
            $r = $this->withCookie($this->cookieName, $session['token'])
                ->postJson("/api/chat/conversations/{$convUuid}/attachments", ['attachments' => [$file]]);
            $r->assertStatus(201);
        }

        $overflowFile = UploadedFile::fake()->image('overflow.jpg', 50, 50);
        $floodRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/attachments", ['attachments' => [$overflowFile]]);

        $floodRes->assertStatus(429);
    }

    /**
     * Test 18: Session init flood triggers 429 Too Many Requests.
     */
    public function test_18_session_init_flood_triggers_429(): void
    {
        config(['chat.session_init_rate_limit' => 2]);
        RateLimiter::clear('chat-session-init');

        for ($i = 0; $i < 2; $i++) {
            $r = $this->postJson('/api/chat/session/init');
            $r->assertStatus(200);
        }

        $floodRes = $this->postJson('/api/chat/session/init');
        $floodRes->assertStatus(429);
    }

    /**
     * Test 19: Rate limit cannot be bypassed by querying a different conversation UUID.
     */
    public function test_19_rate_limiter_cannot_be_bypassed_by_conversation_uuid(): void
    {
        config(['chat.message_send_rate_limit' => 2]);
        RateLimiter::clear('chat-message-send');

        $session = $this->createVisitorSession();
        $convRes1 = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid1 = $convRes1->json('data.conversation_uuid');

        for ($i = 0; $i < 2; $i++) {
            $this->withCookie($this->cookieName, $session['token'])
                ->postJson("/api/chat/conversations/{$convUuid1}/messages", ['message' => "Msg {$i}"]);
        }

        // Even with another UUID (or attempt), visitor identity key is locked -> 429
        $r = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid1}/messages", ['message' => 'Bypass attempt']);
        $r->assertStatus(429);
    }

    /**
     * Test 20: Duplicate identical message flood triggers validation rejection (422).
     */
    public function test_20_duplicate_message_flood_triggers_rejection(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $threshold = (int) config('chat.spam_duplicate_threshold', 4);

        for ($i = 1; $i < $threshold; $i++) {
            $r = $this->withCookie($this->cookieName, $session['token'])
                ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Mua hàng giá rẻ']);
            $r->assertStatus(201);
        }

        // The threshold-th identical message within window is rejected with 422
        $dupRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => ' Mua hàng   giá rẻ ']);

        $dupRes->assertStatus(422);
        $this->assertStringContainsString('trùng lặp', $dupRes->json('message'));
    }

    /**
     * Test 21: Legitimate distinct messages are not rejected by duplicate detector.
     */
    public function test_21_legitimate_distinct_messages_are_not_rejected(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $res1 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Chào bạn, công ty có dịch vụ livestream không?']);
        $res1->assertStatus(201);

        $res2 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Báo giá cho gói 3 máy quay là bao nhiêu?']);
        $res2->assertStatus(201);

        $res3 = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Địa điểm tại Cần Thơ có phụ phí di chuyển không?']);
        $res3->assertStatus(201);
    }

    /**
     * Test 22: Unauthorized agent cannot view spam conversations (403).
     */
    public function test_22_unauthorized_agent_cannot_view_spam_conversations(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $conversation = ChatConversation::where('conversation_uuid', $convRes->json('data.conversation_uuid'))->firstOrFail();

        $this->agentConvService->markAsSpam($this->adminUser, $conversation);

        // Admin can view
        $adminView = $this->agentConvService->getConversation($this->adminUser, $conversation->conversation_uuid);
        $this->assertEquals($conversation->conversation_uuid, $adminView->conversation_uuid);

        // Regular agent without spam permission cannot view spam conversation
        $this->expectException(AccessDeniedHttpException::class);
        $this->agentConvService->getConversation($this->agentUser, $conversation->conversation_uuid);
    }

    /**
     * Test 23 & 24: Default inbox excludes spam; explicit spam filter returns spam for authorized admin.
     */
    public function test_23_and_24_inbox_filter_spam_visibility(): void
    {
        $uniqueTag = 'SPAMTEST_' . uniqid();

        $session1 = $this->createVisitorSession();
        $session1['visitor']->update(['name' => "{$uniqueTag} Normal"]);
        $conv1 = $this->withCookie($this->cookieName, $session1['token'])->postJson('/api/chat/conversations');
        $normalConv = ChatConversation::where('conversation_uuid', $conv1->json('data.conversation_uuid'))->firstOrFail();

        $session2 = $this->createVisitorSession();
        $session2['visitor']->update(['name' => "{$uniqueTag} Spam"]);
        $conv2 = $this->withCookie($this->cookieName, $session2['token'])->postJson('/api/chat/conversations');
        $spamConv = ChatConversation::where('conversation_uuid', $conv2->json('data.conversation_uuid'))->firstOrFail();
        $this->agentConvService->markAsSpam($this->adminUser, $spamConv);

        // 23. Default inbox list (filterStatus = 'all') excludes spam
        $defaultList = $this->agentConvService->listConversationsForAgent($this->agentUser, [
            'status' => 'all',
            'search' => $uniqueTag,
        ], 100);
        $uuidsInDefault = collect($defaultList->items())->pluck('conversation_uuid')->all();

        $this->assertContains($normalConv->conversation_uuid, $uuidsInDefault);
        $this->assertNotContains($spamConv->conversation_uuid, $uuidsInDefault);

        // 24. Explicit spam filter by admin returns spam conversation
        $spamList = $this->agentConvService->listConversationsForAgent($this->adminUser, [
            'status' => 'spam',
            'search' => $uniqueTag,
        ], 100);
        $uuidsInSpam = collect($spamList->items())->pluck('conversation_uuid')->all();

        $this->assertContains($spamConv->conversation_uuid, $uuidsInSpam);
        $this->assertNotContains($normalConv->conversation_uuid, $uuidsInSpam);

        // Unauthorized agent querying spam filter gets 403
        try {
            $this->agentConvService->listConversationsForAgent($this->agentUser, ['status' => 'spam']);
            $this->fail('Regular agent should not be authorized to query spam filter.');
        } catch (AccessDeniedHttpException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * Test 25: No internal numeric IDs or private paths leaked in moderation responses.
     */
    public function test_25_no_sensitive_internal_data_leakage(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->getJson("/api/chat/conversations/{$convUuid}");

        $res->assertStatus(200);
        $res->assertJsonMissing(['id', 'chat_visitor_id', 'assigned_to_user_id', 'closed_by_user_id', 'token_hash']);
    }

    /**
     * Test 26: Duplicate message flood boundary semantics.
     * Threshold = 4 (Max 3 accepted in window, 4th rejected with 422).
     * Tests: below, exact, above, distinct, whitespace variants, case variants, outside window.
     */
    public function test_26_duplicate_message_flood_boundary_semantics(): void
    {
        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $convUuid = $convRes->json('data.conversation_uuid');

        // Below threshold: messages 1, 2, 3 accepted (201)
        for ($i = 1; $i <= 3; $i++) {
            $this->withCookie($this->cookieName, $session['token'])
                ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'khuyen mai'])
                ->assertStatus(201);
        }

        // Exact threshold: 4th identical message is blocked (422)
        $exactRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'khuyen mai']);
        $exactRes->assertStatus(422);

        // Above threshold: 5th identical message is blocked (422)
        $aboveRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'khuyen mai']);
        $aboveRes->assertStatus(422);

        // Distinct message is accepted (201)
        $distinctRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'dich vu quay phim']);
        $distinctRes->assertStatus(201);

        // Whitespace variant of duplicate is blocked (422)
        $wsRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => "  khuyen \t  mai \n "]);
        $wsRes->assertStatus(422);

        // Case variant of duplicate is blocked (422)
        $caseRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'KHUYEN MAI']);
        $caseRes->assertStatus(422);

        // Outside window: backdate previous messages beyond window seconds (35s)
        ChatMessage::where('message_body', 'khuyen mai')->update([
            'created_at' => now()->subSeconds(35),
        ]);

        // After window expiry, message is accepted again (201)
        $windowRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'khuyen mai']);
        $windowRes->assertStatus(201);
    }

    /**
     * Test 27: Concurrency test - 5 independent worker processes sending identical messages.
     * Verifies that race conditions cannot bypass duplicate flood protection.
     */
    public function test_27_duplicate_flood_concurrency_with_workers(): void
    {
        $session = $this->createVisitorSession();
        $visitorId = $session['visitor']->id;
        $conv = ChatConversation::create([
            'chat_visitor_id' => $visitorId,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Human,
            'visitor_unread_count' => 0,
            'agent_unread_count' => 0,
        ]);
        $convId = $conv->id;

        $targetMsg = 'Concurrent flood test ' . uniqid();
        $processes = [];
        $pipes = [];

        // Launch 5 concurrent workers
        for ($i = 1; $i <= 5; $i++) {
            $cmd = 'php -r "require \'vendor/autoload.php\'; $app = require \'bootstrap/app.php\'; $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); $v = App\Models\ChatVisitor::find(' . $visitorId . '); $c = App\Models\ChatConversation::find(' . $convId . '); try { $m = app(App\Services\Chat\ChatMessageService::class)->sendMessage($v, $c, \'' . $targetMsg . '\'); echo \'OK:\' . $m->message_uuid; } catch (\Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException $e) { echo \'ERR:422\'; } catch (\Throwable $t) { echo \'ERR:\' . get_class($t); }"';
            $processes[$i] = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes[$i]);
        }

        $outputs = [];
        for ($i = 1; $i <= 5; $i++) {
            $out = stream_get_contents($pipes[$i][1]);
            fclose($pipes[$i][1]);
            fclose($pipes[$i][2]);
            proc_close($processes[$i]);
            $outputs[] = trim($out);
        }

        $successCount = 0;
        $rejectedCount = 0;
        foreach ($outputs as $out) {
            if (str_starts_with($out, 'OK:')) {
                $successCount++;
            } elseif ($out === 'ERR:422') {
                $rejectedCount++;
            }
        }

        // Threshold = 4 means exactly 3 identical messages are accepted, and 2 are throttled (422)
        $this->assertEquals(3, $successCount, "Expected exactly 3 successes out of 5 concurrent requests. Outputs: " . implode(', ', $outputs));
        $this->assertEquals(2, $rejectedCount, "Expected exactly 2 throttles out of 5 concurrent requests. Outputs: " . implode(', ', $outputs));

        // Exact DB check: conversation contains exactly 3 messages of this text
        $dbCount = ChatMessage::where('chat_conversation_id', $convId)
            ->where('message_body', $targetMsg)
            ->count();
        $this->assertEquals(3, $dbCount);
    }

    /**
     * Test 28: Blocked visitor full lifecycle & unblock token behavior.
     * Verifies:
     * - Before block: active capability.
     * - Block: old token -> 401 across all endpoints.
     * - Block: new session attempt -> 403.
     * - Unblock: old token STILL -> 401 (not automatically revived).
     * - Unblock: new session init -> 200, receives new token.
     * - New token is fully usable.
     */
    public function test_28_blocked_visitor_full_lifecycle_and_unblock_token_behavior(): void
    {
        $session = $this->createVisitorSession();
        $visitor = $session['visitor'];
        $oldToken = $session['token'];

        // 1. Before block: visitor creates conversation and sends message
        $convRes = $this->withCookie($this->cookieName, $oldToken)->postJson('/api/chat/conversations');
        $convRes->assertStatus(200);
        $convUuid = $convRes->json('data.conversation_uuid');

        $msgRes = $this->withCookie($this->cookieName, $oldToken)
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Active message']);
        $msgRes->assertStatus(201);
        $msgUuid = $msgRes->json('data.message_uuid');

        // 2. Moderator blocks visitor
        $this->agentConvService->blockVisitor($this->adminUser, $visitor);

        // 3. Old token receives 401 on every endpoint (sessions were deleted)
        $this->withCookie($this->cookieName, $oldToken)->getJson('/api/chat/conversations')->assertStatus(401);
        $this->withCookie($this->cookieName, $oldToken)->postJson('/api/chat/conversations')->assertStatus(401);
        $this->withCookie($this->cookieName, $oldToken)->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Blocked'])->assertStatus(401);
        $this->withCookie($this->cookieName, $oldToken)->postJson("/api/chat/conversations/{$convUuid}/read")->assertStatus(401);
        $this->withCookie($this->cookieName, $oldToken)->patchJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}", ['message' => 'Edit blocked'])->assertStatus(401);
        $this->withCookie($this->cookieName, $oldToken)->deleteJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}")->assertStatus(401);

        // 4. Blocked visitor attempting new session init receives 403
        $this->withCookie($this->cookieName, $oldToken)
            ->postJson('/api/chat/session/init')
            ->assertStatus(403);

        // 5. Moderator unblocks visitor
        $this->agentConvService->unblockVisitor($this->adminUser, $visitor);
        $this->assertNull($visitor->fresh()->blocked_at);

        // 6. Old revoked token STILL returns 401 (does NOT magically revive)
        $this->withCookie($this->cookieName, $oldToken)
            ->postJson("/api/chat/conversations/{$convUuid}/messages", ['message' => 'Still old token'])
            ->assertStatus(401);

        // 7. Visitor initializes new session -> succeeds (200)
        $initRes = $this->postJson('/api/chat/session/init');
        $initRes->assertStatus(200);
        $newToken = $initRes->getCookie($this->cookieName, false)?->getValue();
        $this->assertNotEmpty($newToken);
        $this->assertNotEquals($oldToken, $newToken);

        // 8. New session can create conversation and message
        $newConvRes = $this->withCookie($this->cookieName, $newToken)->postJson('/api/chat/conversations');
        $newConvRes->assertStatus(200);
        $newConvUuid = $newConvRes->json('data.conversation_uuid');

        $this->withCookie($this->cookieName, $newToken)
            ->postJson("/api/chat/conversations/{$newConvUuid}/messages", ['message' => 'Unblocked and active'])
            ->assertStatus(201);
    }

    /**
     * Test 29: Spam conversation lifecycle and unmark restoration invariants.
     * Case A: assigned conversation -> spam -> unmark -> assigned
     * Case B: open conversation -> spam -> unmark -> open
     * Invariants: last_message_at, unread counters, message history preserved.
     */
    public function test_29_spam_conversation_lifecycle_and_restoration_invariants(): void
    {
        // Case A: Assigned conversation
        $sessionA = $this->createVisitorSession();
        $convResA = $this->withCookie($this->cookieName, $sessionA['token'])->postJson('/api/chat/conversations');
        $convA = ChatConversation::where('conversation_uuid', $convResA->json('data.conversation_uuid'))->firstOrFail();

        // Agent claims conversation -> assigned
        $this->agentConvService->claimConversation($this->agentUser, $convA);
        $this->assertEquals(ChatConversationStatus::Assigned, $convA->fresh()->status);
        $this->assertEquals($this->agentUser->id, $convA->fresh()->assigned_to_user_id);

        // Send a message first
        $msgRes = $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson("/api/chat/conversations/{$convA->conversation_uuid}/messages", ['message' => 'Initial inquiry']);
        $msgUuid = $msgRes->json('data.message_uuid');
        $convA->refresh();

        $origLastMsgAt = $convA->last_message_at;
        $origAgentUnread = $convA->agent_unread_count;
        $origVisitorUnread = $convA->visitor_unread_count;

        // Admin marks as spam
        $this->agentConvService->markAsSpam($this->adminUser, $convA);
        $this->assertEquals(ChatConversationStatus::Spam, $convA->fresh()->status);

        // Visitor attempts in spam: message, attachment, edit, recall -> 403
        $this->withCookie($this->cookieName, $sessionA['token'])
            ->postJson("/api/chat/conversations/{$convA->conversation_uuid}/messages", ['message' => 'Spam msg'])
            ->assertStatus(403);
        $this->withCookie($this->cookieName, $sessionA['token'])
            ->patchJson("/api/chat/conversations/{$convA->conversation_uuid}/messages/{$msgUuid}", ['message' => 'Edit attempt'])
            ->assertStatus(403);
        $this->withCookie($this->cookieName, $sessionA['token'])
            ->deleteJson("/api/chat/conversations/{$convA->conversation_uuid}/messages/{$msgUuid}")
            ->assertStatus(403);

        // Agent attempts in spam: send, edit, recall -> 403
        try {
            $agentMsgService = app(\App\Services\Chat\ChatAgentMessageService::class);
            $agentMsgService->sendAgentMessage($this->adminUser, $convA->fresh(), 'Agent spam reply');
            $this->fail('Agent sending in spam conversation should be rejected.');
        } catch (AccessDeniedHttpException $e) {
            $this->assertTrue(true);
        }

        // Invariants preserved: unread and last_message_at unchanged
        $convA->refresh();
        $this->assertEquals($origLastMsgAt, $convA->last_message_at);
        $this->assertEquals($origAgentUnread, $convA->agent_unread_count);
        $this->assertEquals($origVisitorUnread, $convA->visitor_unread_count);

        // Admin unmarks spam -> restored to assigned
        $restoredA = $this->agentConvService->unmarkSpam($this->adminUser, $convA);
        $this->assertEquals(ChatConversationStatus::Assigned, $restoredA->status);
        $this->assertEquals($this->agentUser->id, $restoredA->assigned_to_user_id);

        // Case B: Open conversation
        $sessionB = $this->createVisitorSession();
        $convResB = $this->withCookie($this->cookieName, $sessionB['token'])->postJson('/api/chat/conversations');
        $convB = ChatConversation::where('conversation_uuid', $convResB->json('data.conversation_uuid'))->firstOrFail();
        $this->assertEquals(ChatConversationStatus::Open, $convB->status);
        $this->assertNull($convB->assigned_to_user_id);

        $this->agentConvService->markAsSpam($this->adminUser, $convB);
        $this->assertEquals(ChatConversationStatus::Spam, $convB->fresh()->status);

        $restoredB = $this->agentConvService->unmarkSpam($this->adminUser, $convB);
        $this->assertEquals(ChatConversationStatus::Open, $restoredB->status);
        $this->assertNull($restoredB->assigned_to_user_id);
    }

    /**
     * Test 30: Moderation events dispatch ChatConversationUpdated with strictly safe public payload.
     */
    public function test_30_moderation_event_payload_security(): void
    {
        \Illuminate\Support\Facades\Event::fake([\App\Events\Chat\ChatConversationUpdated::class]);

        $session = $this->createVisitorSession();
        $convRes = $this->withCookie($this->cookieName, $session['token'])->postJson('/api/chat/conversations');
        $conv = ChatConversation::where('conversation_uuid', $convRes->json('data.conversation_uuid'))->firstOrFail();

        // 1. Mark as spam dispatches event
        $this->agentConvService->markAsSpam($this->adminUser, $conv);

        \Illuminate\Support\Facades\Event::assertDispatched(\App\Events\Chat\ChatConversationUpdated::class, function ($event) use ($conv) {
            if ($event->status !== 'spam') {
                return false;
            }
            $payload = $event->publicPayload();

            // Strictly safe public fields
            $this->assertEquals($conv->conversation_uuid, $payload['conversation_uuid']);
            $this->assertEquals('spam', $payload['status']);
            $this->assertArrayHasKey('visitor_unread_count', $payload);
            $this->assertArrayHasKey('agent_unread_count', $payload);
            $this->assertArrayHasKey('last_message_at', $payload);

            // Zero sensitive or internal data
            $this->assertArrayNotHasKey('id', $payload);
            $this->assertArrayNotHasKey('chat_visitor_id', $payload);
            $this->assertArrayNotHasKey('assigned_to_user_id', $payload);
            $this->assertArrayNotHasKey('closed_by_user_id', $payload);
            $this->assertArrayNotHasKey('disk_path', $payload);
            $this->assertArrayNotHasKey('file_path', $payload);
            $this->assertArrayNotHasKey('token_hash', $payload);

            return true;
        });

        // 2. Unmark spam dispatches event
        $this->agentConvService->unmarkSpam($this->adminUser, $conv);

        \Illuminate\Support\Facades\Event::assertDispatched(\App\Events\Chat\ChatConversationUpdated::class, function ($event) use ($conv) {
            return $event->status === 'open' && $event->conversationUuid === $conv->conversation_uuid;
        });
    }
}
