<?php

namespace Tests\Feature;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Filament\Pages\ChatInbox;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\ChatConversationService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatInboxPhase25RealtimeTest extends TestCase
{
    protected User $admin;
    protected ChatVisitor $visitor;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

        $this->admin = User::factory()->create([
            'email' => 'phase25_admin_' . Str::random(6) . '@cuulong.com',
        ]);
        $this->admin->assignRole('Admin');

        $this->visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Khách Hàng Test Phase 2.5',
            'phone' => '0987654321',
            'email' => 'khachhang25@gmail.com',
            'first_ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0',
        ]);
    }

    /**
     * Test 1: Storing conversation records source_url, source_path, source_title and default tags.
     */
    public function test_conversation_service_records_source_url_and_metadata(): void
    {
        /** @var ChatConversationService $service */
        $service = app(ChatConversationService::class);

        $conv = $service->getOrCreateActiveConversation($this->visitor, [
            'source_url' => 'https://truyenthongcuulong.com/dich-vu/thiet-ke-website',
            'source_path' => '/dich-vu/thiet-ke-website',
            'source_title' => 'Thiết kế Website Doanh Nghiệp',
        ]);

        $this->assertNotNull($conv);
        $this->assertEquals('https://truyenthongcuulong.com/dich-vu/thiet-ke-website', $conv->source_url);
        $this->assertEquals('/dich-vu/thiet-ke-website', $conv->source_path);
        $this->assertEquals('Thiết kế Website Doanh Nghiệp', $conv->source_title);
        $this->assertIsArray($conv->tags);
        $this->assertContains('Website', $conv->tags);
        $this->assertEquals('new', $conv->lead_status);
    }

    /**
     * Test 2: When customer sends a message, agent_unread_count increments.
     */
    public function test_customer_message_increments_agent_unread_count(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        $initialUnread = (int) $conv->agent_unread_count;

        /** @var ChatMessageService $msgService */
        $msgService = app(ChatMessageService::class);
        $msg = $msgService->sendMessage($this->visitor, $conv, 'Tôi muốn tư vấn thiết kế website trọn gói.');

        $conv->refresh();
        $this->assertEquals($initialUnread + 1, $conv->agent_unread_count);
        $this->assertEquals(ChatMessageSenderType::Visitor, $msg->sender_type);
        $this->assertNull($msg->read_at);
    }

    /**
     * Test 3: Reopen conversation when customer sends a message on a closed conversation.
     */
    public function test_closed_conversation_auto_reopens_on_customer_message(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        // Close conversation
        $conv->update([
            'status' => ChatConversationStatus::Closed,
            'closed_at' => now(),
            'closed_by_user_id' => $this->admin->id,
        ]);
        $this->assertEquals(ChatConversationStatus::Closed, $conv->status);

        // Customer sends message
        /** @var ChatMessageService $msgService */
        $msgService = app(ChatMessageService::class);
        $msg = $msgService->sendMessage($this->visitor, $conv, 'Em muốn hỏi thêm về dịch vụ sau khi đóng.');

        $conv->refresh();
        $this->assertEquals(ChatConversationStatus::Open, $conv->status);
        $this->assertNull($conv->closed_at);
        $this->assertNull($conv->closed_by_user_id);
        $this->assertGreaterThan(0, $conv->agent_unread_count);
    }

    /**
     * Test 4: Marking conversation as read resets agent_unread_count and updates message read_at.
     */
    public function test_marking_conversation_as_read_updates_status_and_timestamps(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        /** @var ChatMessageService $msgService */
        $msgService = app(ChatMessageService::class);
        $msg = $msgService->sendMessage($this->visitor, $conv, 'Tin nhắn chưa đọc.');

        $conv->refresh();
        $this->assertNull($msg->read_at);
        $this->assertGreaterThan(0, $conv->agent_unread_count);

        $this->actingAs($this->admin);

        Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid])
            ->assertSet('selectedConversationUuid', $conv->conversation_uuid);

        $conv->refresh();
        $msg->refresh();

        $this->assertEquals(0, $conv->agent_unread_count);
        $this->assertNotNull($msg->read_at);
        $this->assertEquals(ChatMessageStatus::Read, $msg->status);
    }

    /**
     * Test 5: Customer Tag assignment and removal works dynamically.
     */
    public function test_customer_tags_management(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        $this->actingAs($this->admin);

        Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid])
            ->call('addTag', 'Bất động sản')
            ->call('addTag', 'Doanh nghiệp lớn');

        $conv->refresh();
        $this->assertContains('Bất động sản', $conv->tags);
        $this->assertContains('Doanh nghiệp lớn', $conv->tags);

        // Remove tag
        Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid])
            ->call('removeTag', 'Bất động sản');

        $conv->refresh();
        $this->assertNotContains('Bất động sản', $conv->tags);
        $this->assertContains('Doanh nghiệp lớn', $conv->tags);
    }

    /**
     * Test 6: Lead Stage updates correctly.
     */
    public function test_lead_stage_updates(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        $this->actingAs($this->admin);

        Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid])
            ->call('updateLeadStatus', 'quoted');

        $conv->refresh();
        $this->assertEquals('quoted', $conv->lead_status);

        Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid])
            ->call('updateLeadStatus', 'deal_closed');

        $conv->refresh();
        $this->assertEquals('deal_closed', $conv->lead_status);
    }

    /**
     * Test 7: Section 24 Sorting (Unread > Waiting Agent > Latest).
     */
    public function test_section_24_conversation_sorting(): void
    {
        // Reset unread on other conversations for isolated test
        ChatConversation::query()->update(['agent_unread_count' => 0]);

        $visitor2 = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Khách Hàng 2',
            'first_ip' => '127.0.0.1',
        ]);
        $visitor3 = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Khách Hàng 3',
            'first_ip' => '127.0.0.1',
        ]);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);

        // Conv 1: closed, old
        $c1 = $convService->getOrCreateActiveConversation($this->visitor);
        $c1->update([
            'status' => ChatConversationStatus::Closed,
            'agent_unread_count' => 0,
            'last_message_at' => now()->subHours(5),
        ]);

        // Conv 2: open but no unread
        $c2 = $convService->getOrCreateActiveConversation($visitor2);
        $c2->update([
            'status' => ChatConversationStatus::Open,
            'agent_unread_count' => 0,
            'last_message_at' => now()->subHours(2),
        ]);

        // Conv 3: has unread messages (should be sorted first!)
        $c3 = $convService->getOrCreateActiveConversation($visitor3);
        $c3->update([
            'status' => ChatConversationStatus::WaitingAgent,
            'agent_unread_count' => 5,
            'last_message_at' => now()->subHours(1),
        ]);

        $this->actingAs($this->admin);

        $component = Livewire::test(ChatInbox::class);
        $conversations = $component->get('conversations');

        $this->assertNotEmpty($conversations);
        $this->assertEquals($c3->id, $conversations->first()->id, 'Conversation with unread messages must be prioritized first');
    }

    /**
     * Test 8: Filter by tag.
     */
    public function test_filtering_by_tag(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $c1 = $convService->getOrCreateActiveConversation($this->visitor);
        $c1->update(['tags' => ['Website', 'SEO']]);

        $visitor2 = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Khách Hàng Thẻ Khác',
            'first_ip' => '127.0.0.1',
        ]);
        $c2 = $convService->getOrCreateActiveConversation($visitor2);
        $c2->update(['tags' => ['App di động']]);

        $this->actingAs($this->admin);

        Livewire::test(ChatInbox::class)
            ->set('filterTag', 'SEO')
            ->assertSee($this->visitor->name)
            ->assertDontSee('Khách Hàng Thẻ Khác');
    }

    /**
     * Test 9: Realtime poll event dispatching on new visitor message.
     */
    public function test_poll_dispatches_incoming_message_event(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid]);

        // Customer sends message in background
        /** @var ChatMessageService $msgService */
        $msgService = app(ChatMessageService::class);
        $msg = $msgService->sendMessage($this->visitor, $conv, 'Báo giá thiết kế website cho em nhé!');

        // Run poll
        $component->call('poll')
            ->assertDispatched('incoming-customer-message')
            ->assertDispatched('inbox-synced');
    }

    /**
     * Test 10: Safe source URL opens properly and renders safely.
     */
    public function test_safe_source_url_rendering(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor, [
            'source_url' => 'https://truyenthongcuulong.com/dich-vu/thiet-ke-website',
            'source_path' => '/dich-vu/thiet-ke-website',
            'source_title' => 'Thiết kế Website Doanh Nghiệp',
        ]);

        $this->actingAs($this->admin);

        Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid])
            ->assertSee('Thiết kế Website Doanh Nghiệp')
            ->assertSee('/dich-vu/thiet-ke-website')
            ->assertSee('Mở trang bắt đầu');
    }

    /**
     * Test 11: Idempotency with client_message_id for visitor message.
     */
    public function test_visitor_client_message_id_idempotency(): void
    {
        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        /** @var ChatMessageService $msgService */
        $msgService = app(ChatMessageService::class);

        $clientMsgId = 'vis_uuid_' . Str::uuid();

        $msg1 = $msgService->sendMessage($this->visitor, $conv, 'Tin nhắn kiểm tra idempotency', [], $clientMsgId);
        $msg2 = $msgService->sendMessage($this->visitor, $conv, 'Tin nhắn kiểm tra idempotency', [], $clientMsgId);

        $this->assertEquals($msg1->id, $msg2->id);
        $this->assertEquals($msg1->message_uuid, $msg2->message_uuid);
        $this->assertEquals(1, $conv->messages()->where('client_message_id', $clientMsgId)->count());
    }

    /**
     * Test 12: Idempotency with client_message_id for agent reply in ChatInbox.
     */
    public function test_agent_client_message_id_idempotency_in_inbox(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        $clientMsgId = 'agent_uuid_' . Str::uuid();

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid]);
        $component->set('replyMessage', 'Phản hồi tư vấn lần 1')
            ->call('sendReply', $clientMsgId);

        $component->set('replyMessage', 'Phản hồi tư vấn lần 2 trùng lặp')
            ->call('sendReply', $clientMsgId);

        $this->assertEquals(1, $conv->messages()->where('client_message_id', $clientMsgId)->count());
    }

    /**
     * Test 13: Agent recall message sets status to Recalled, recalled_at, and masks body in public resource.
     */
    public function test_agent_recall_message(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        /** @var \App\Services\Chat\ChatAgentMessageService $agentMsgService */
        $agentMsgService = app(\App\Services\Chat\ChatAgentMessageService::class);
        $msg = $agentMsgService->sendAgentMessage($this->admin, $conv, 'Tin nhắn cần thu hồi');

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid]);
        $component->call('recallMessage', $msg->message_uuid)
            ->assertDispatched('message-recalled');

        $msg->refresh();
        $this->assertNotNull($msg->recalled_at);
        $this->assertEquals(ChatMessageStatus::Recalled, $msg->status);

        // Verify API resource masks content
        $resource = (new \App\Http\Resources\Chat\ChatMessageResource($msg))->toArray(request());
        $this->assertTrue($resource['recalled']);
        $this->assertNull($resource['message']);
    }

    /**
     * Test 14: Agent delete message sets status to Deleted, deleted_at, and masks body in public resource.
     */
    public function test_agent_delete_message(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        /** @var \App\Services\Chat\ChatAgentMessageService $agentMsgService */
        $agentMsgService = app(\App\Services\Chat\ChatAgentMessageService::class);
        $msg = $agentMsgService->sendAgentMessage($this->admin, $conv, 'Tin nhắn cần xóa');

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid]);
        $component->call('deleteMessage', $msg->message_uuid)
            ->assertDispatched('message-deleted');

        $msg->refresh();
        $this->assertNotNull($msg->deleted_at);
        $this->assertEquals(ChatMessageStatus::Deleted, $msg->status);

        // Verify API resource masks content
        $resource = (new \App\Http\Resources\Chat\ChatMessageResource($msg))->toArray(request());
        $this->assertTrue($resource['deleted']);
        $this->assertNull($resource['message']);
    }

    /**
     * Test 15: Visitor typing endpoint sets cache and Livewire poll dispatches typing event.
     */
    public function test_typing_indicator_and_poll_dispatch(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        // Simulate visitor typing via cache
        \Illuminate\Support\Facades\Cache::put(
            "chat:typing:conversation:{$conv->conversation_uuid}:visitor",
            [
                'visitor_uuid' => $this->visitor->visitor_uuid,
                'name' => 'Khách hàng',
                'typed_at' => now()->timestamp,
            ],
            now()->addSeconds(4)
        );

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid]);
        $component->call('poll')
            ->assertDispatched('visitor-typing-status');
    }

    /**
     * Test 16: Security guard: Unauthorized agent cannot delete another agent's message without permission.
     */
    public function test_security_agent_cannot_delete_another_agents_message(): void
    {
        Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);

        $agent1 = User::factory()->create();
        $agent1->assignRole('Biên Tập Viên');

        $agent2 = User::factory()->create();
        $agent2->assignRole('Biên Tập Viên');

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        /** @var \App\Services\Chat\ChatAgentMessageService $agentMsgService */
        $agentMsgService = app(\App\Services\Chat\ChatAgentMessageService::class);
        $msg = $agentMsgService->sendAgentMessage($agent1, $conv, 'Tin nhắn của nhân viên 1');

        $this->expectException(\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class);
        $agentMsgService->deleteAgentMessage($agent2, $conv, $msg->message_uuid);
    }

    /**
     * Test 17: Agent with permission can delete conversation session.
     */
    public function test_delete_conversation_session(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        /** @var \App\Services\Chat\ChatAgentMessageService $agentMsgService */
        $agentMsgService = app(\App\Services\Chat\ChatAgentMessageService::class);
        $agentMsgService->sendAgentMessage($this->admin, $conv, 'Tin nhắn để xóa');

        $this->assertDatabaseHas('chat_conversations', ['id' => $conv->id]);
        $this->assertDatabaseHas('chat_messages', ['chat_conversation_id' => $conv->id]);

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid]);
        $component->call('deleteConversation');

        $this->assertDatabaseMissing('chat_conversations', ['id' => $conv->id]);
        $this->assertDatabaseMissing('chat_messages', ['chat_conversation_id' => $conv->id]);
    }

    /**
     * Test 18: Agent can edit own message.
     */
    public function test_agent_can_edit_own_message(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv = $convService->getOrCreateActiveConversation($this->visitor);

        /** @var \App\Services\Chat\ChatAgentMessageService $agentMsgService */
        $agentMsgService = app(\App\Services\Chat\ChatAgentMessageService::class);
        $msg = $agentMsgService->sendAgentMessage($this->admin, $conv, 'Nội dung ban đầu');

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv->conversation_uuid]);
        $component->call('startEditMessage', $msg->message_uuid);
        $this->assertEquals($msg->message_uuid, $component->get('editingMessageUuid'));
        $this->assertEquals('Nội dung ban đầu', $component->get('editMessageText'));

        $component->set('editMessageText', 'Nội dung đã được chỉnh sửa');
        $component->call('saveEditMessage');

        $msg->refresh();
        $this->assertEquals('Nội dung đã được chỉnh sửa', $msg->message_body);
        $this->assertNotNull($msg->edited_at);
        $this->assertNull($component->get('editingMessageUuid'));
    }

    /**
     * Test 19: Bulk select and delete multiple conversations.
     */
    public function test_bulk_select_and_delete_multiple_conversations(): void
    {
        $this->actingAs($this->admin);

        /** @var ChatConversationService $convService */
        $convService = app(ChatConversationService::class);
        $conv1 = $convService->getOrCreateActiveConversation($this->visitor);

        $visitor2 = \App\Models\ChatVisitor::create(['name' => 'Visitor 2 for bulk test']);
        $conv2 = $convService->getOrCreateActiveConversation($visitor2);

        $component = Livewire::test(ChatInbox::class, ['conversation' => $conv1->conversation_uuid]);

        // Toggle single conversation
        $component->call('toggleSelectConversation', $conv1->conversation_uuid);
        $this->assertContains($conv1->conversation_uuid, $component->get('selectedConversations'));

        // Toggle select all
        $component->call('toggleSelectAll');
        $this->assertTrue($component->get('selectAll'));
        $this->assertContains($conv1->conversation_uuid, $component->get('selectedConversations'));
        $this->assertContains($conv2->conversation_uuid, $component->get('selectedConversations'));

        // Bulk delete
        $component->call('deleteSelectedConversations');
        $this->assertEmpty($component->get('selectedConversations'));
        $this->assertDatabaseMissing('chat_conversations', ['id' => $conv1->id]);
        $this->assertDatabaseMissing('chat_conversations', ['id' => $conv2->id]);
    }
}
