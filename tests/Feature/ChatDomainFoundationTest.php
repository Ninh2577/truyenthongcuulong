<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Models\ChatAttachment;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatMessage;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ChatDomainFoundationTest extends TestCase
{
    /**
     * Test 1: ChatVisitor auto-generates UUID, sets fillables, and relationships work.
     */
    public function test_chat_visitor_lifecycle_and_relationships(): void
    {
        $visitor = ChatVisitor::create([
            'name' => 'Nguyen Van A',
            'phone' => '0901234567',
            'email' => 'visitor_test@example.com',
            'first_ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 Test Agent',
        ]);

        $this->assertNotNull($visitor->id);
        $this->assertNotEmpty($visitor->visitor_uuid);
        $this->assertTrue(Str::isUuid($visitor->visitor_uuid));

        // Test Session relationship
        $rawToken = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $rawToken);

        $session = $visitor->sessions()->create([
            'token_hash' => $tokenHash,
            'expires_at' => now()->addDays(30),
            'last_active_at' => now(),
        ]);

        $this->assertCount(1, $visitor->fresh()->sessions);
        $this->assertEquals($visitor->id, $session->visitor->id);

        // Test cascade delete on visitor
        $visitorId = $visitor->id;
        $visitor->delete();
        $this->assertDatabaseMissing('chat_visitor_sessions', ['id' => $session->id]);
        $this->assertDatabaseMissing('chat_visitors', ['id' => $visitorId]);
    }

    /**
     * Test 2: ChatConversation auto-generates UUID, enum casts, and user relationships work.
     */
    public function test_chat_conversation_lifecycle_and_enum_casts(): void
    {
        $admin = User::where('email', 'admin@truyenthongcuulong.com')->first() ?? User::factory()->create(['email' => 'admin@truyenthongcuulong.com']);
        $this->assertNotNull($admin);

        $visitor = ChatVisitor::create([
            'name' => 'Visitor Conversation Test',
        ]);

        $conversation = ChatConversation::create([
            'chat_visitor_id' => $visitor->id,
            'assigned_to_user_id' => $admin->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Human,
            'visitor_unread_count' => 1,
            'agent_unread_count' => 0,
        ]);

        $this->assertNotEmpty($conversation->conversation_uuid);
        $this->assertTrue(Str::isUuid($conversation->conversation_uuid));
        $this->assertInstanceOf(ChatConversationStatus::class, $conversation->status);
        $this->assertEquals(ChatConversationStatus::Open, $conversation->status);
        $this->assertInstanceOf(ChatConversationChannel::class, $conversation->channel);
        $this->assertEquals(ChatConversationChannel::Human, $conversation->channel);

        // Relationship assertions
        $this->assertEquals($visitor->id, $conversation->visitor->id);
        $this->assertEquals($admin->id, $conversation->assignedUser->id);

        // Update status enum
        $conversation->update([
            'status' => ChatConversationStatus::Assigned,
            'channel' => ChatConversationChannel::Hybrid,
        ]);

        $fresh = $conversation->fresh();
        $this->assertEquals(ChatConversationStatus::Assigned, $fresh->status);
        $this->assertEquals(ChatConversationChannel::Hybrid, $fresh->channel);

        // Cleanup
        $conversation->delete();
        $visitor->delete();
    }

    /**
     * Test 3: ChatMessage creation, sender type enum, status enum, and cascade deletion.
     */
    public function test_chat_message_lifecycle_and_enum_casts(): void
    {
        $admin = User::where('email', 'admin@truyenthongcuulong.com')->first() ?? User::factory()->create(['email' => 'admin@truyenthongcuulong.com']);

        $visitor = ChatVisitor::create(['name' => 'Visitor Message Test']);
        $conversation = ChatConversation::create(['chat_visitor_id' => $visitor->id]);

        // Visitor message
        $visitorMsg = ChatMessage::create([
            'chat_conversation_id' => $conversation->id,
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Xin chào Cửu Long Media!',
            'status' => ChatMessageStatus::Sent,
        ]);

        $this->assertNotEmpty($visitorMsg->message_uuid);
        $this->assertTrue(Str::isUuid($visitorMsg->message_uuid));
        $this->assertEquals(ChatMessageSenderType::Visitor, $visitorMsg->sender_type);
        $this->assertEquals(ChatMessageStatus::Sent, $visitorMsg->status);

        // Agent message
        $agentMsg = ChatMessage::create([
            'chat_conversation_id' => $conversation->id,
            'sender_type' => ChatMessageSenderType::Agent,
            'sender_user_id' => $admin->id,
            'message_body' => 'Chào bạn, chúng tôi có thể hỗ trợ gì cho bạn?',
            'status' => ChatMessageStatus::Delivered,
        ]);

        $this->assertEquals(ChatMessageSenderType::Agent, $agentMsg->sender_type);
        $this->assertEquals($admin->id, $agentMsg->senderUser->id);
        $this->assertCount(2, $conversation->fresh()->messages);

        // Cleanup
        $conversation->delete();
        $visitor->delete();
    }

    /**
     * Test 4: ChatAttachment metadata model and relationship to ChatMessage.
     */
    public function test_chat_attachment_metadata_and_relationship(): void
    {
        $visitor = ChatVisitor::create(['name' => 'Visitor Attachment Test']);
        $conversation = ChatConversation::create(['chat_visitor_id' => $visitor->id]);
        $message = ChatMessage::create([
            'chat_conversation_id' => $conversation->id,
            'sender_type' => ChatMessageSenderType::Visitor,
            'message_body' => 'Đây là tài liệu đính kèm',
            'status' => ChatMessageStatus::Sent,
        ]);

        $attachment = ChatAttachment::create([
            'chat_message_id' => $message->id,
            'original_name' => 'brief_du_an.pdf',
            'stored_path' => 'chat_attachments/2026/09/brief_du_an.bin',
            'disk' => 'local',
            'mime_type' => 'application/pdf',
            'file_size' => 1048576,
        ]);

        $this->assertNotEmpty($attachment->attachment_uuid);
        $this->assertTrue(Str::isUuid($attachment->attachment_uuid));
        $this->assertEquals($message->id, $attachment->message->id);
        $this->assertCount(1, $message->fresh()->attachments);

        // Cleanup
        $conversation->delete();
        $visitor->delete();
    }

    /**
     * Test 5: ChatInternalNote model and relationships.
     */
    public function test_chat_internal_note_lifecycle_and_relationships(): void
    {
        $admin = User::where('email', 'admin@truyenthongcuulong.com')->first() ?? User::factory()->create(['email' => 'admin@truyenthongcuulong.com']);
        $visitor = ChatVisitor::create(['name' => 'Visitor Note Test']);
        $conversation = ChatConversation::create(['chat_visitor_id' => $visitor->id]);

        $note = ChatInternalNote::create([
            'chat_conversation_id' => $conversation->id,
            'user_id' => $admin->id,
            'note_body' => 'Khách hàng quan tâm gói sản xuất TVC 4K.',
        ]);

        $this->assertEquals($conversation->id, $note->conversation->id);
        $this->assertEquals($admin->id, $note->user->id);
        $this->assertCount(1, $conversation->fresh()->internalNotes);

        // Cleanup
        $conversation->delete();
        $visitor->delete();
    }

    /**
     * Test 6: ChatSetting JSON storage and static get/set helpers.
     */
    public function test_chat_setting_json_cast_and_helpers(): void
    {
        $config = [
            'greeting_enabled' => true,
            'greeting_message' => 'Chào mừng bạn đến với Truyền Thông Cửu Long!',
            'delay_seconds' => 3,
        ];

        ChatSetting::set('general_config', $config, 'Cấu hình chung hệ thống chat');

        $retrieved = ChatSetting::get('general_config');
        $this->assertIsArray($retrieved);
        $this->assertTrue($retrieved['greeting_enabled']);
        $this->assertEquals(3, $retrieved['delay_seconds']);

        // Non-existent key returns default
        $defaultVal = ChatSetting::get('unknown_key', 'DEFAULT_VAL');
        $this->assertEquals('DEFAULT_VAL', $defaultVal);

        // Cleanup
        ChatSetting::where('key', 'general_config')->delete();
    }

    /**
     * Test 7: Security Invariant - UUID uniqueness enforcement.
     */
    public function test_uuid_uniqueness_enforcement(): void
    {
        $fixedUuid = (string) Str::uuid();

        ChatVisitor::create([
            'visitor_uuid' => $fixedUuid,
            'name' => 'Original Visitor',
        ]);

        $this->expectException(\Illuminate\Database\UniqueConstraintViolationException::class);

        ChatVisitor::create([
            'visitor_uuid' => $fixedUuid,
            'name' => 'Duplicate Visitor',
        ]);
    }
}
