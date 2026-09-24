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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Tests\TestCase;

class ChatAgentInboxTest extends TestCase
{
    protected ChatAgentConversationService $agentConvService;
    protected User $adminUser;
    protected User $agentUser;
    protected User $unauthorizedUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->agentConvService = app(ChatAgentConversationService::class);

        // Ensure roles exist
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Biên Tập Viên']);

        // Create test users
        $this->adminUser = User::factory()->create([
            'email' => 'admin_' . Str::random(8) . '@example.com',
        ]);
        $this->adminUser->assignRole('Admin');

        $this->agentUser = User::factory()->create([
            'email' => 'agent_' . Str::random(8) . '@example.com',
        ]);
        $this->agentUser->assignRole('Biên Tập Viên');

        $this->unauthorizedUser = User::factory()->create([
            'email' => 'unauth_' . Str::random(8) . '@example.com',
        ]);
        // No role assigned to unauthorizedUser
    }

    protected function createConversation(array $attributes = []): ChatConversation
    {
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Nguyễn Văn ' . Str::random(4),
            'email' => Str::random(6) . '@test.com',
            'phone' => '090' . rand(1000000, 9999999),
        ]);

        return ChatConversation::create(array_merge([
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Human,
            'visitor_unread_count' => 0,
            'agent_unread_count' => 1,
        ], $attributes));
    }

    /**
     * Test 1: Agent can list conversations.
     */
    public function test_agent_can_list_conversations(): void
    {
        $conv1 = $this->createConversation(['last_message_at' => now()->addMinutes(10)]);
        $conv2 = $this->createConversation(['last_message_at' => now()->addMinutes(20)]);

        $list = $this->agentConvService->listConversationsForAgent($this->agentUser);

        $this->assertGreaterThanOrEqual(2, $list->total());
        $uuids = collect($list->items())->pluck('conversation_uuid');
        $index1 = $uuids->search($conv1->conversation_uuid);
        $index2 = $uuids->search($conv2->conversation_uuid);
        $this->assertNotFalse($index1);
        $this->assertNotFalse($index2);
        $this->assertLessThan($index1, $index2, 'Conversation with more recent message must appear earlier in list.');
    }

    /**
     * Test 2: Agent can get conversation details.
     */
    public function test_agent_can_get_conversation_details(): void
    {
        $conv = $this->createConversation();

        $details = $this->agentConvService->getConversation($this->agentUser, $conv->conversation_uuid);

        $this->assertEquals($conv->conversation_uuid, $details->conversation_uuid);
        $this->assertNotNull($details->visitor);
    }

    /**
     * Test 3: Unauthorized user without agent role cannot list conversations.
     */
    public function test_unauthorized_user_cannot_list_conversations(): void
    {
        $this->expectException(AccessDeniedHttpException::class);

        $this->agentConvService->listConversationsForAgent($this->unauthorizedUser);
    }

    /**
     * Test 4: Unauthorized user cannot view conversation details.
     */
    public function test_unauthorized_user_cannot_view_conversation(): void
    {
        $conv = $this->createConversation();

        $this->expectException(AccessDeniedHttpException::class);

        $this->agentConvService->getConversation($this->unauthorizedUser, $conv->conversation_uuid);
    }

    /**
     * Test 5: Secret data (token hashes, passwords, session tokens) is never leaked in conversation queries.
     */
    public function test_security_data_not_leaked_in_conversation_details(): void
    {
        $conv = $this->createConversation();
        // Create session with hashed token
        ChatVisitorSession::create([
            'chat_visitor_id' => $conv->chat_visitor_id,
            'session_uuid' => (string) Str::uuid(),
            'token_hash' => hash('sha256', Str::random(40)),
            'expires_at' => now()->addDays(30),
        ]);

        $details = $this->agentConvService->getConversation($this->agentUser, $conv->conversation_uuid);
        $array = $details->toArray();

        $this->assertArrayNotHasKey('token_hash', $array);
        $this->assertArrayNotHasKey('chat_visitor_sessions', $array);
        $this->assertArrayNotHasKey('password', $array);
    }

    /**
     * Test 6: Filter by status works properly.
     */
    public function test_filter_by_status(): void
    {
        $openConv = $this->createConversation(['status' => ChatConversationStatus::Open]);
        $closedConv = $this->createConversation(['status' => ChatConversationStatus::Closed]);

        $openList = $this->agentConvService->listConversationsForAgent($this->agentUser, ['status' => 'open']);
        $closedList = $this->agentConvService->listConversationsForAgent($this->agentUser, ['status' => 'closed']);

        $openUuids = collect($openList->items())->pluck('conversation_uuid');
        $closedUuids = collect($closedList->items())->pluck('conversation_uuid');

        $this->assertTrue($openUuids->contains($openConv->conversation_uuid));
        $this->assertFalse($openUuids->contains($closedConv->conversation_uuid));

        $this->assertTrue($closedUuids->contains($closedConv->conversation_uuid));
        $this->assertFalse($closedUuids->contains($openConv->conversation_uuid));
    }

    /**
     * Test 7: Filter by assignment (mine vs unassigned).
     */
    public function test_filter_by_assignment(): void
    {
        $unassigned = $this->createConversation(['assigned_to_user_id' => null]);
        $mine = $this->createConversation(['assigned_to_user_id' => $this->agentUser->id]);

        $mineList = $this->agentConvService->listConversationsForAgent($this->agentUser, ['assignment' => 'mine']);
        $unassignedList = $this->agentConvService->listConversationsForAgent($this->agentUser, ['assignment' => 'unassigned']);

        $mineUuids = collect($mineList->items())->pluck('conversation_uuid');
        $unassignedUuids = collect($unassignedList->items())->pluck('conversation_uuid');

        $this->assertTrue($mineUuids->contains($mine->conversation_uuid));
        $this->assertFalse($mineUuids->contains($unassigned->conversation_uuid));

        $this->assertTrue($unassignedUuids->contains($unassigned->conversation_uuid));
        $this->assertFalse($unassignedUuids->contains($mine->conversation_uuid));
    }

    /**
     * Test 8: Search by visitor name and conversation UUID.
     */
    public function test_search_conversations(): void
    {
        $conv = $this->createConversation();
        $conv->visitor->update(['name' => 'Trần Văn Đặc Biệt 99']);

        $searchResult = $this->agentConvService->listConversationsForAgent($this->agentUser, ['search' => 'Đặc Biệt 99']);
        $resultUuids = collect($searchResult->items())->pluck('conversation_uuid');

        $this->assertTrue($resultUuids->contains($conv->conversation_uuid));
    }

    /**
     * Test 9: Claim conversation sets assigned agent and updates status.
     */
    public function test_agent_claim_conversation_success(): void
    {
        $conv = $this->createConversation([
            'assigned_to_user_id' => null,
            'status' => ChatConversationStatus::Open,
        ]);

        $claimed = $this->agentConvService->claimConversation($this->agentUser, $conv);

        $this->assertEquals($this->agentUser->id, $claimed->assigned_to_user_id);
        $this->assertEquals(ChatConversationStatus::Assigned, $claimed->status);
    }

    /**
     * Test 10: Concurrency / race condition on claim:
     * When conversation is already claimed by Agent A, Agent B cannot claim it.
     */
    public function test_claim_conflict_when_already_claimed_by_another_agent(): void
    {
        $otherAgent = User::factory()->create();
        $otherAgent->assignRole('Biên Tập Viên');

        $conv = $this->createConversation([
            'assigned_to_user_id' => $otherAgent->id,
            'status' => ChatConversationStatus::Assigned,
        ]);

        $this->expectException(ConflictHttpException::class);

        $this->agentConvService->claimConversation($this->agentUser, $conv);
    }

    /**
     * Test 11: Close conversation sets status, closed_at, and closed_by_user_id.
     */
    public function test_agent_close_conversation(): void
    {
        $conv = $this->createConversation(['status' => ChatConversationStatus::Assigned]);

        $closed = $this->agentConvService->closeConversation($this->agentUser, $conv);

        $this->assertEquals(ChatConversationStatus::Closed, $closed->status);
        $this->assertNotNull($closed->closed_at);
        $this->assertEquals($this->agentUser->id, $closed->closed_by_user_id);
    }

    /**
     * Test 12: Reopen conversation restores open/assigned status and clears closed_at.
     */
    public function test_agent_reopen_conversation(): void
    {
        $conv = $this->createConversation([
            'status' => ChatConversationStatus::Closed,
            'assigned_to_user_id' => $this->agentUser->id,
            'closed_at' => now(),
            'closed_by_user_id' => $this->agentUser->id,
        ]);

        $reopened = $this->agentConvService->reopenConversation($this->agentUser, $conv);

        $this->assertEquals(ChatConversationStatus::Assigned, $reopened->status);
        $this->assertNull($reopened->closed_at);
        $this->assertNull($reopened->closed_by_user_id);
    }

    /**
     * Test 13: Mark as spam sets status to spam.
     */
    public function test_admin_mark_as_spam(): void
    {
        $conv = $this->createConversation(['status' => ChatConversationStatus::Open]);

        $spam = $this->agentConvService->markAsSpam($this->adminUser, $conv);

        $this->assertEquals(ChatConversationStatus::Spam, $spam->status);
    }

    /**
     * Test 14: Non-admin cannot mark as spam.
     */
    public function test_non_admin_cannot_mark_as_spam(): void
    {
        $conv = $this->createConversation(['status' => ChatConversationStatus::Open]);

        $this->expectException(AccessDeniedHttpException::class);

        $this->agentConvService->markAsSpam($this->agentUser, $conv);
    }

    /**
     * Test 15: Filament page /cuulongteam/chat-inbox responds for authenticated agent.
     */
    public function test_filament_chat_inbox_page_access(): void
    {
        $this->actingAs($this->agentUser);

        $response = $this->get('/cuulongteam/chat-inbox');

        $response->assertStatus(200);
        $response->assertSee('Hộp Thư Chăm Sóc Khách Hàng');
    }

    /**
     * Test 16: Filament page /cuulongteam/chat-inbox denies unauthenticated/unauthorized users.
     */
    public function test_filament_chat_inbox_page_denies_unauthorized_user(): void
    {
        // Unauthenticated -> redirects to login
        $guestResponse = $this->get('/cuulongteam/chat-inbox');
        $guestResponse->assertRedirect('/cuulongteam/login');

        // Unauthorized user -> 403
        $this->actingAs($this->unauthorizedUser);
        $unauthResponse = $this->get('/cuulongteam/chat-inbox');
        $unauthResponse->assertStatus(403);
    }

    /**
     * Test 17: Livewire select conversation.
     */
    public function test_livewire_select_conversation(): void
    {
        $this->actingAs($this->agentUser);
        $conv1 = $this->createConversation(['status' => ChatConversationStatus::Open]);
        $conv2 = $this->createConversation(['status' => ChatConversationStatus::Open]);

        $testable = \Livewire\Livewire::test(\App\Filament\Pages\ChatInbox::class);
        $html = $testable->html();
        
        // Find conv-item snippet (now rendered as <button> for reliable click handling)
        if (preg_match('/<button[^>]*wire:key="conv-item-[^"]*"[^>]*>/', $html, $matches)) {
            dump($matches[0]);
        } else {
            dump("conv-item button not found in html!");
        }

        $testable->assertSee($conv1->visitor->name)
            ->call('selectConversation', $conv2->conversation_uuid)
            ->assertSet('selectedConversationUuid', $conv2->conversation_uuid)
            ->assertSee($conv2->visitor->name);
    }
}
