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
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatAgentMessageService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tests\TestCase;

class ChatAgentMessageTest extends TestCase
{
    protected ChatAgentMessageService $agentMsgService;
    protected ChatAgentConversationService $agentConvService;
    protected ChatMessageService $visitorMsgService;
    protected User $agent1;
    protected User $agent2;
    protected User $unauthorizedUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->agentMsgService = app(ChatAgentMessageService::class);
        $this->agentConvService = app(ChatAgentConversationService::class);
        $this->visitorMsgService = app(ChatMessageService::class);

        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Biên Tập Viên']);

        $this->agent1 = User::factory()->create(['name' => 'Agent One']);
        $this->agent1->assignRole('Biên Tập Viên');

        $this->agent2 = User::factory()->create(['name' => 'Agent Two']);
        $this->agent2->assignRole('Biên Tập Viên');

        $this->unauthorizedUser = User::factory()->create(['name' => 'Random User']);
    }

    protected function createConversation(array $attributes = []): ChatConversation
    {
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Khách Hàng ' . Str::random(4),
            'email' => Str::random(6) . '@test.com',
            'phone' => '0901234567',
        ]);

        return ChatConversation::create(array_merge([
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Human,
            'visitor_unread_count' => 0,
            'agent_unread_count' => 0,
        ], $attributes));
    }

    /**
     * Test 1: Agent sends message successfully.
     * Enforces server-controlled sender_type=agent and sender_user_id=Auth::id().
     * Transactionally increments visitor_unread_count and updates last_message_at.
     */
    public function test_agent_send_message_server_controlled_identity(): void
    {
        $conv = $this->createConversation([
            'status' => ChatConversationStatus::WaitingAgent,
            'visitor_unread_count' => 0,
        ]);

        $message = $this->agentMsgService->sendAgentMessage(
            $this->agent1,
            $conv,
            'Xin chào, Cửu Long Media có thể tư vấn gói dịch vụ nào cho bạn?'
        );

        $this->assertEquals(ChatMessageSenderType::Agent, $message->sender_type);
        $this->assertEquals($this->agent1->id, $message->sender_user_id);
        $this->assertEquals(ChatMessageStatus::Sent, $message->status);
        $this->assertEquals('Xin chào, Cửu Long Media có thể tư vấn gói dịch vụ nào cho bạn?', $message->message_body);

        $conv->refresh();
        $this->assertEquals(1, $conv->visitor_unread_count);
        $this->assertEquals(ChatConversationStatus::WaitingCustomer, $conv->status);
        $this->assertNotNull($conv->last_message_at);
        $this->assertEquals($this->agent1->id, $conv->assigned_to_user_id);
    }

    /**
     * Test 2: Unauthorized user cannot send agent messages.
     */
    public function test_unauthorized_user_cannot_send_agent_message(): void
    {
        $conv = $this->createConversation();

        $this->expectException(AccessDeniedHttpException::class);

        $this->agentMsgService->sendAgentMessage($this->unauthorizedUser, $conv, 'Tin nhắn bất hợp pháp');
    }

    /**
     * Test 3: Agent read action resets agent_unread_count to 0 and marks visitor messages as read.
     */
    public function test_agent_mark_as_read(): void
    {
        $conv = $this->createConversation([
            'agent_unread_count' => 3,
        ]);

        // Create an unread visitor message
        $visitorMsg = $conv->messages()->create([
            'sender_type' => ChatMessageSenderType::Visitor,
            'sender_user_id' => null,
            'message_body' => 'Tôi muốn hỏi báo giá',
            'status' => ChatMessageStatus::Sent,
            'read_at' => null,
        ]);

        $this->agentConvService->markAsReadByAgent($this->agent1, $conv);

        $conv->refresh();
        $visitorMsg->refresh();

        $this->assertEquals(0, $conv->agent_unread_count);
        $this->assertNotNull($visitorMsg->read_at);
        $this->assertEquals(ChatMessageStatus::Read, $visitorMsg->status);
    }

    /**
     * Test 4: Visitor sending message increments agent_unread_count.
     */
    public function test_visitor_message_increments_agent_unread_count(): void
    {
        $conv = $this->createConversation(['agent_unread_count' => 0]);
        $visitor = $conv->visitor;

        $this->visitorMsgService->sendMessage($visitor, $conv, 'Khách gửi tin nhắn mới');

        $conv->refresh();
        $this->assertEquals(1, $conv->agent_unread_count);
    }

    /**
     * Test 5: Closed conversation rejects agent message.
     */
    public function test_closed_conversation_rejects_agent_message(): void
    {
        $conv = $this->createConversation(['status' => ChatConversationStatus::Closed]);

        $this->expectException(UnprocessableEntityHttpException::class);

        $this->agentMsgService->sendAgentMessage($this->agent1, $conv, 'Xin chào');
    }

    /**
     * Test 6: Spam conversation rejects agent message.
     */
    public function test_spam_conversation_rejects_agent_message(): void
    {
        $conv = $this->createConversation(['status' => ChatConversationStatus::Spam]);

        $this->expectException(AccessDeniedHttpException::class);

        $this->agentMsgService->sendAgentMessage($this->agent1, $conv, 'Xin chào');
    }

    /**
     * Test 7: Agent can edit their own message within 15 minutes.
     */
    public function test_agent_can_edit_own_message_within_window(): void
    {
        $conv = $this->createConversation();
        $msg = $this->agentMsgService->sendAgentMessage($this->agent1, $conv, 'Nội dung ban đầu');

        $edited = $this->agentMsgService->editAgentMessage($this->agent1, $conv, $msg->message_uuid, 'Nội dung đã sửa đổi');

        $this->assertEquals('Nội dung đã sửa đổi', $edited->message_body);
        $this->assertNotNull($edited->edited_at);
    }

    /**
     * Test 8: Agent cannot edit another agent's message.
     */
    public function test_agent_cannot_edit_another_agents_message(): void
    {
        $conv = $this->createConversation();
        $msg = $this->agentMsgService->sendAgentMessage($this->agent1, $conv, 'Nội dung của Agent 1');

        $this->expectException(AccessDeniedHttpException::class);

        $this->agentMsgService->editAgentMessage($this->agent2, $conv, $msg->message_uuid, 'Agent 2 cố tình sửa');
    }

    /**
     * Test 9: Agent can recall their own message within 60 minutes.
     */
    public function test_agent_can_recall_own_message_within_window(): void
    {
        $conv = $this->createConversation();
        $msg = $this->agentMsgService->sendAgentMessage($this->agent1, $conv, 'Nội dung cần thu hồi');

        $recalled = $this->agentMsgService->recallAgentMessage($this->agent1, $conv, $msg->message_uuid);

        $this->assertNotNull($recalled->recalled_at);
    }

    /**
     * Test 10: Agent cannot recall another agent's message.
     */
    public function test_agent_cannot_recall_another_agents_message(): void
    {
        $conv = $this->createConversation();
        $msg = $this->agentMsgService->sendAgentMessage($this->agent1, $conv, 'Nội dung của Agent 1');

        $this->expectException(AccessDeniedHttpException::class);

        $this->agentMsgService->recallAgentMessage($this->agent2, $conv, $msg->message_uuid);
    }

    /**
     * Test 11: Internal notes can be added by agents and are NEVER leaked to visitor messages endpoint.
     */
    public function test_internal_notes_recorded_and_not_leaked_to_visitor(): void
    {
        $conv = $this->createConversation();

        // Agent adds internal note
        $note = $this->agentMsgService->addInternalNote(
            $this->agent1,
            $conv,
            'Ghi chú nội bộ: Khách hàng VIP cần chuẩn bị hợp đồng trước 17h'
        );

        $this->assertEquals($this->agent1->id, $note->user_id);
        $this->assertEquals($conv->id, $note->chat_conversation_id);

        // List notes via agent service
        $notes = $this->agentMsgService->listInternalNotes($this->agent1, $conv);
        $this->assertCount(1, $notes);
        $this->assertEquals($note->id, $notes->first()->id);

        // Verify visitor message endpoint NEVER returns this internal note
        $visitor = $conv->visitor;
        $sessionService = app(\App\Services\Chat\VisitorSessionService::class);
        $session = $sessionService->createSession($visitor);

        $cookieName = config('chat.cookie_name', 'chat_visitor_token');
        $response = $this->withCookie($cookieName, $session['session_token'])
            ->getJson("/api/chat/conversations/{$conv->conversation_uuid}/messages");

        $response->assertStatus(200);
        $response->assertDontSee('Khách hàng VIP cần chuẩn bị hợp đồng trước 17h');
    }
}
