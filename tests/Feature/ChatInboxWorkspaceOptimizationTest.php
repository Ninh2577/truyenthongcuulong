<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Filament\Pages\ChatInbox;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\PricingPlan;
use App\Models\User;
use App\Services\Chat\ChatQuickReplyService;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatInboxWorkspaceOptimizationTest extends TestCase
{
    protected User $agent;
    protected ChatConversation $conversation;
    protected ChatVisitor $visitor;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $this->agent = User::factory()->create([
            'email' => 'opt_agent_' . Str::random(6) . '@test.com',
        ]);
        $this->agent->assignRole('Admin');

        $this->visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name'         => 'Nguyễn Văn Test',
            'email'        => 'test@cuulong.vn',
            'phone'        => '0939123456',
        ]);

        $this->conversation = ChatConversation::create([
            'chat_visitor_id'    => $this->visitor->id,
            'status'             => ChatConversationStatus::Open,
            'channel'            => ChatConversationChannel::Human,
            'visitor_unread_count' => 0,
            'agent_unread_count'   => 1,
            'tags'               => ['Website', 'Khách hàng tiềm năng'],
            'lead_status'        => 'new',
        ]);
    }

    public function test_chat_quick_reply_service_returns_authentic_business_canned_responses(): void
    {
        $service = app(ChatQuickReplyService::class);
        $replies = $service->getAllQuickReplies();

        $this->assertNotEmpty($replies);
        $shortcuts = array_column($replies, 'shortcut');

        $this->assertContains('/gia', $shortcuts);
        $this->assertContains('/hello', $shortcuts);
        $this->assertContains('/website', $shortcuts);
        $this->assertContains('/contact', $shortcuts);
        $this->assertContains('/marketing', $shortcuts);
        $this->assertContains('/tvc', $shortcuts);

        $contact = $service->findByShortcut('/contact');
        $this->assertNotNull($contact);
        $this->assertStringContainsString('0939 363 262', $contact['content']);
        $this->assertStringContainsString('Truyền Thông Cửu Long', $contact['content']);
    }

    public function test_dynamic_tags_property_aggregates_tags_from_existing_conversations(): void
    {
        $visitor2 = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name'         => 'Visitor 2',
        ]);

        ChatConversation::create([
            'chat_visitor_id' => $visitor2->id,
            'status'          => ChatConversationStatus::Open,
            'channel'         => ChatConversationChannel::Human,
            'tags'            => ['Bất động sản', 'Cần Thơ', 'SEO'],
        ]);

        $component = Livewire::actingAs($this->agent)
            ->test(ChatInbox::class);

        $availableTags = $component->get('availableTags');

        $this->assertIsArray($availableTags);
        $this->assertContains('Website', $availableTags);
        $this->assertContains('Khách hàng tiềm năng', $availableTags);
        $this->assertContains('Bất động sản', $availableTags);
        $this->assertContains('Cần Thơ', $availableTags);
        $this->assertContains('SEO', $availableTags);
    }

    public function test_send_quotation_creates_real_chat_message_with_authentic_pricing_plan(): void
    {
        $plan = PricingPlan::where('is_active', true)->first();
        if (!$plan) {
            $plan = PricingPlan::create([
                'tier_name' => 'Website Doanh Nghiệp',
                'service_group' => 'web',
                'category_label' => 'Thiết Kế Website',
                'price_monthly' => 12000000,
                'price_display' => '12.000.000 VNĐ',
                'is_active' => true,
                'features' => ['Bảo hành 12 tháng', 'Chuẩn SEO'],
                'description' => 'Gói website chuyên nghiệp',
            ]);
        }

        $component = Livewire::actingAs($this->agent)
            ->test(ChatInbox::class)
            ->call('selectConversation', $this->conversation->conversation_uuid)
            ->call('sendQuotation', $plan->id);

        $this->conversation->refresh();
        $this->assertEquals('quoted', $this->conversation->lead_status);

        $message = ChatMessage::where('chat_conversation_id', $this->conversation->id)
            ->where('sender_type', ChatMessageSenderType::Agent)
            ->latest('id')
            ->first();

        $this->assertNotNull($message);
        $this->assertStringContainsString('THÔNG TIN BÁO GIÁ DỊCH VỤ', $message->message_body);
        $this->assertStringContainsString('TRUYỀN THÔNG CỬU LONG', $message->message_body);
    }

    public function test_quote_modal_controls(): void
    {
        $component = Livewire::actingAs($this->agent)
            ->test(ChatInbox::class)
            ->call('openQuoteModal')
            ->assertSet('showQuoteModal', true)
            ->call('closeQuoteModal')
            ->assertSet('showQuoteModal', false);
    }

    public function test_optimistic_message_submission_and_empty_guard(): void
    {
        $component = Livewire::actingAs($this->agent)
            ->test(ChatInbox::class)
            ->call('selectConversation', $this->conversation->conversation_uuid)
            ->set('replyMessage', '   ')
            ->call('sendReply');

        $initialCount = ChatMessage::where('chat_conversation_id', $this->conversation->id)->count();

        $component->set('replyMessage', 'Xin chào, chúng tôi có thể hỗ trợ gì cho bạn?')
            ->call('sendReply');

        $newCount = ChatMessage::where('chat_conversation_id', $this->conversation->id)->count();
        $this->assertEquals($initialCount + 1, $newCount);

        $lastMessage = ChatMessage::where('chat_conversation_id', $this->conversation->id)->latest('id')->first();
        $this->assertEquals('Xin chào, chúng tôi có thể hỗ trợ gì cho bạn?', $lastMessage->message_body);
    }

    public function test_quick_replies_settings_page_renders_and_lists_replies(): void
    {
        Livewire::actingAs($this->agent)
            ->test(\App\Filament\Pages\ChatQuickRepliesSettings::class)
            ->assertSuccessful()
            ->assertSee('Phím tắt & Mẫu tin nhắn')
            ->assertSee('/hello')
            ->assertSee('/gia')
            ->assertSee('/website');
    }

    public function test_quick_replies_can_be_created_updated_and_deleted(): void
    {
        $component = Livewire::actingAs($this->agent)
            ->test(\App\Filament\Pages\ChatQuickRepliesSettings::class)
            ->call('openCreateModal')
            ->assertSet('showModal', true)
            ->set('replyTitle', 'Tư Vấn SEO Nâng Cao')
            ->set('shortcut', '/seo')
            ->set('category', 'Dịch vụ Marketing')
            ->set('content', 'Dạ gói SEO Cửu Long cam kết từ khóa lên trang nhất Google sau 3 tháng.')
            ->call('save')
            ->assertSet('showModal', false);

        $service = app(ChatQuickReplyService::class);
        $found = $service->findByShortcut('/seo');
        $this->assertNotNull($found);
        $this->assertEquals('Tư Vấn SEO Nâng Cao', $found['title']);

        // Update
        $component->call('openEditModal', $found['id'])
            ->set('replyTitle', 'Tư Vấn SEO Tổng Thể')
            ->call('save');

        $updated = $service->findByShortcut('/seo');
        $this->assertEquals('Tư Vấn SEO Tổng Thể', $updated['title']);

        // Delete
        $component->call('delete', $found['id']);
        $deleted = $service->findByShortcut('/seo');
        $this->assertNull($deleted);
    }

    public function test_bulk_delete_has_no_50_limit_and_deletes_all_conversations(): void
    {
        // Create 60 dummy conversations to surpass the old 50 limit
        $uuids = [];
        for ($i = 0; $i < 60; $i++) {
            $conv = ChatConversation::create([
                'chat_visitor_id'   => $this->visitor->id,
                'conversation_uuid' => (string) Str::uuid(),
                'status'            => ChatConversationStatus::Open->value,
                'channel'           => ChatConversationChannel::Human->value,
            ]);
            $uuids[] = $conv->conversation_uuid;
        }

        $component = Livewire::actingAs($this->agent)
            ->test(ChatInbox::class);

        // Verify conversations count is >= 60 (no 50 limit cap)
        $this->assertGreaterThanOrEqual(60, $component->get('conversations')->count());

        // Toggle select all - must select all conversations without 50 cap
        $component->call('toggleSelectAll');
        $selected = $component->get('selectedConversations');
        $this->assertGreaterThanOrEqual(60, count($selected));

        // Delete all selected
        $component->call('deleteSelectedConversations');

        // Verify the 60 created conversations are all deleted
        $remaining = ChatConversation::whereIn('conversation_uuid', $uuids)->count();
        $this->assertEquals(0, $remaining);
    }
}
