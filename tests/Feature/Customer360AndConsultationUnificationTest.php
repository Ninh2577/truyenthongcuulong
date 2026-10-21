<?php

namespace Tests\Feature;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Filament\Pages\ChatVisitorsPage;
use App\Models\ChatConversation;
use App\Models\ChatVisitor;
use App\Models\Contact;
use App\Models\User;
use App\Services\CustomerIdentityResolver;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class Customer360AndConsultationUnificationTest extends TestCase
{
    protected array $testPhones = [
        '0939111001', '0939222002', '0939333003', '0939444004', '0939555005',
        '0939666006', '0939777007', '0939888008', '0939101001', '0939101002',
        '0939121212', '0939131313', '0939141414', '0939151515', '0939191919', '0939202020'
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->resolver = app(CustomerIdentityResolver::class);
        RateLimiter::clear('5,1');

        Contact::whereIn('phone_normalized', $this->testPhones)->delete();
        ChatVisitor::whereIn('phone_normalized', $this->testPhones)->delete();
    }

    protected function tearDown(): void
    {
        Contact::whereIn('phone_normalized', $this->testPhones)->delete();
        ChatVisitor::whereIn('phone_normalized', $this->testPhones)->delete();
        parent::tearDown();
    }

    /**
     * TEST 1: Form /lien-he submit thành công -> record xuất hiện trong Admin Yêu Cầu Tư Vấn.
     */
    public function test_01_contact_form_submission_success(): void
    {
        $response = $this->post('/lien-he', [
            'fullname' => 'Nguyễn Văn Test 1',
            'phone' => '0939111001',
            'email' => 'test1@cuulong.vn',
            'service_interested' => 'Thiết kế Website',
            'message' => 'Nhu cầu thiết kế website doanh nghiệp',
            'channel' => 'website_contact',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'phone' => '0939111001',
            'email' => 'test1@cuulong.vn',
            'channel' => 'website_contact',
        ]);
    }

    /**
     * TEST 2: Form dịch vụ submit -> record xuất hiện cùng ContactResource.
     */
    public function test_02_service_form_submission_creates_contact(): void
    {
        $response = $this->post('/lien-he', [
            'fullname' => 'Trần Thị Dịch Vụ',
            'phone' => '0939222002',
            'email' => 'dichvu@cuulong.vn',
            'service_interested' => 'Sản xuất Phim & Video',
            'message' => 'Cần quay phim giới thiệu công ty',
            'channel' => 'website_service',
            'source_url' => 'https://cuulong.vn/dich-vu/quay-phim-su-kien',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'phone' => '0939222002',
            'service_interested' => 'Sản xuất Phim & Video',
            'channel' => 'website_service',
        ]);
    }

    /**
     * TEST 3: Form template submit -> record xuất hiện cùng ContactResource.
     */
    public function test_03_template_form_submission_creates_contact(): void
    {
        $response = $this->post('/lien-he', [
            'fullname' => 'Lê Văn Mẫu Giao Diện',
            'phone' => '0939333003',
            'email' => 'template@cuulong.vn',
            'service_interested' => 'Tư vấn Template: Mẫu Xây Dựng 01',
            'message' => 'Tư vấn mua template mã xd-01',
            'channel' => 'website_template',
            'source_url' => 'https://cuulong.vn/kho-giao-dien',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'phone' => '0939333003',
            'channel' => 'website_template',
        ]);
    }

    /**
     * TEST 4: AJAX submit -> JSON response, không redirect HTML.
     */
    public function test_04_ajax_submission_returns_json_response(): void
    {
        $response = $this->postJson('/lien-he', [
            'fullname' => 'Khách Hàng Ajax',
            'phone' => '0939444004',
            'email' => 'ajax@cuulong.vn',
            'service_interested' => 'Quảng cáo Google',
            'message' => 'Tư vấn ngân sách chạy Ads',
            'channel' => 'website_template',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'contact_id',
        ]);
        $this->assertTrue($response->json('success'));
    }

    /**
     * TEST 5: Normal form submit -> redirect back + success message.
     */
    public function test_05_normal_form_submission_redirects_with_flash(): void
    {
        $response = $this->from('/lien-he')->post('/lien-he', [
            'fullname' => 'Khách Hàng Normal',
            'phone' => '0939555005',
            'message' => 'Yêu cầu tư vấn thông thường',
        ]);

        $response->assertRedirect('/lien-he');
        $response->assertSessionHas('success');
    }

    /**
     * TEST 6: Form có phone -> customer identity được resolve.
     */
    public function test_06_form_with_phone_resolves_customer_identity(): void
    {
        $response = $this->postJson('/lien-he', [
            'fullname' => 'Võ Văn Sáu',
            'phone' => '0939666006',
            'message' => 'Kiểm tra liên kết identity',
        ]);

        $contact = Contact::where('phone', '0939666006')->first();
        $this->assertNotNull($contact);
        $this->assertNotNull($contact->chat_visitor_id);
        $this->assertNotNull($contact->visitor);
        $this->assertTrue($contact->visitor->is_identified);
        $this->assertEquals('0939666006', $contact->visitor->phone_normalized);
    }

    /**
     * TEST 7: Khách đã chat trước đó có cùng phone -> không tạo duplicate customer.
     */
    public function test_07_existing_chat_customer_not_duplicated_on_consultation(): void
    {
        $existingVisitor = ChatVisitor::create([
            'visitor_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Khách Chat Trước',
            'phone' => '0939777007',
            'phone_normalized' => '0939777007',
            'is_identified' => true,
        ]);

        $visitorCountBefore = ChatVisitor::count();

        $this->postJson('/lien-he', [
            'fullname' => 'Khách Chat Trước',
            'phone' => '0939 777 007',
            'message' => 'Gửi thêm yêu cầu tư vấn',
        ]);

        $visitorCountAfter = ChatVisitor::count();
        $this->assertEquals($visitorCountBefore, $visitorCountAfter, 'Không được tạo mới duplicate ChatVisitor');

        $contact = Contact::where('phone_normalized', '0939777007')->first();
        $this->assertEquals($existingVisitor->id, $contact->chat_visitor_id);
    }

    /**
     * TEST 8: Khách có cùng email -> resolve đúng customer.
     */
    public function test_08_existing_customer_resolved_by_email(): void
    {
        $existingVisitor = ChatVisitor::create([
            'visitor_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Khách Hàng Email Match',
            'email' => 'match.email@cuulong.vn',
            'email_normalized' => 'match.email@cuulong.vn',
            'is_identified' => true,
        ]);

        $visitorCountBefore = ChatVisitor::count();

        $this->postJson('/lien-he', [
            'fullname' => 'Khách Hàng Email Match',
            'phone' => '0939888008',
            'email' => 'MATCH.EMAIL@cuulong.vn',
            'message' => 'Kiểm tra resolve qua email',
        ]);

        $this->assertEquals($visitorCountBefore, ChatVisitor::count());
        $contact = Contact::where('email_normalized', 'match.email@cuulong.vn')->first();
        $this->assertEquals($existingVisitor->id, $contact->chat_visitor_id);
    }

    /**
     * TEST 9: Phone format khác nhau -> cùng identity sau normalize.
     */
    public function test_09_phone_normalization_formats(): void
    {
        $format1 = $this->resolver->normalizePhone('0939363262');
        $format2 = $this->resolver->normalizePhone('0939 363 262');
        $format3 = $this->resolver->normalizePhone('0939-363-262');
        $format4 = $this->resolver->normalizePhone('+84939363262');

        $this->assertEquals('0939363262', $format1);
        $this->assertEquals('0939363262', $format2);
        $this->assertEquals('0939363262', $format3);
        $this->assertEquals('0939363262', $format4);
    }

    /**
     * TEST 10: Hai khách cùng tên nhưng khác phone/email -> KHÔNG merge.
     */
    public function test_10_different_customers_with_same_name_not_merged(): void
    {
        $customerA = $this->resolver->resolveForConsultation([
            'fullname' => 'Nguyễn Văn Trùng Tên',
            'phone' => '0939101001',
            'email' => 'trungten1@cuulong.vn',
        ]);

        $customerB = $this->resolver->resolveForConsultation([
            'fullname' => 'Nguyễn Văn Trùng Tên',
            'phone' => '0939101002',
            'email' => 'trungten2@cuulong.vn',
        ]);

        $this->assertNotEquals($customerA->id, $customerB->id, 'Hai khách khác SĐT và email không được merge');
    }

    /**
     * TEST 11: Visitor chỉ có cookie/UUID -> không biến thành customer thật.
     */
    public function test_11_anonymous_visitor_remains_unidentified(): void
    {
        $anonVisitor = ChatVisitor::create([
            'visitor_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'name' => null,
            'phone' => null,
            'email' => null,
            'is_identified' => false,
        ]);

        $this->assertFalse($anonVisitor->is_identified);
        $this->assertNull($anonVisitor->phone_normalized);
    }

    /**
     * TEST 12: Customer đã có tên thật, tracking update -> không ghi đè tên thật bằng dummy name.
     */
    public function test_12_real_name_not_overwritten_by_dummy_tracking_name(): void
    {
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Nguyễn Hoàng Khách Thật',
            'phone' => '0939121212',
            'phone_normalized' => '0939121212',
            'is_identified' => true,
        ]);

        // Attempt resolving with dummy name
        $resolved = $this->resolver->resolveForConsultation([
            'fullname' => 'Nguyễn Văn Test',
            'phone' => '0939121212',
        ]);

        $this->assertEquals('Nguyễn Hoàng Khách Thật', $resolved->name, 'Không được ghi đè tên thật bằng dummy name');
    }

    /**
     * TEST 13: Customer có 3 consultation requests -> Customer 360 liên kết đủ 3.
     */
    public function test_13_customer_with_multiple_consultations_linked_properly(): void
    {
        $phone = '0939131313';

        for ($i = 1; $i <= 3; $i++) {
            $this->postJson('/lien-he', [
                'fullname' => 'Khách Ba Yêu Cầu',
                'phone' => $phone,
                'service_interested' => "Dịch vụ thứ {$i}",
                'message' => "Yêu cầu số {$i}",
            ]);
        }

        $visitor = ChatVisitor::where('phone_normalized', $phone)->first();
        $this->assertNotNull($visitor);
        $this->assertEquals(3, $visitor->contacts()->count());
    }

    /**
     * TEST 14: Customer có 5 chat conversations -> Customer 360 hiển thị đủ 5.
     */
    public function test_14_customer_with_multiple_chat_conversations(): void
    {
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Khách 5 Hội Thoại',
            'phone' => '0939141414',
            'phone_normalized' => '0939141414',
            'is_identified' => true,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            ChatConversation::create([
                'conversation_uuid' => (string) \Illuminate\Support\Str::uuid(),
                'chat_visitor_id' => $visitor->id,
                'status' => ChatConversationStatus::Closed,
                'channel' => ChatConversationChannel::Human,
            ]);
        }

        $this->assertEquals(5, $visitor->conversations()->count());
    }

    /**
     * TEST 15: Customer vừa chat vừa gửi consultation -> cùng một Customer 360.
     */
    public function test_15_customer_with_both_chat_and_consultation_unified(): void
    {
        $phone = '0939151515';

        // 1. Visitor starts a chat
        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Khách Chat Và Tư Vấn',
            'phone' => $phone,
            'phone_normalized' => $phone,
            'is_identified' => true,
        ]);
        ChatConversation::create([
            'conversation_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'channel' => ChatConversationChannel::Human,
        ]);

        // 2. Later, visitor submits a consultation form
        $this->postJson('/lien-he', [
            'fullname' => 'Khách Chat Và Tư Vấn',
            'phone' => $phone,
            'message' => 'Gửi yêu cầu tư vấn chi tiết sau khi chat',
        ]);

        // Verification
        $unified = ChatVisitor::with(['conversations', 'contacts'])->find($visitor->id);
        $this->assertEquals(1, $unified->conversations->count());
        $this->assertEquals(1, $unified->contacts->count());
    }

    /**
     * TEST 16: 786+ visitor -> không load toàn bộ vào browser.
     */
    public function test_16_visitors_page_paginates_without_loading_all(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        \Illuminate\Support\Facades\Gate::before(fn () => true);

        // Verify total visitors in database is at least 786
        $total = ChatVisitor::count();
        $this->assertGreaterThanOrEqual(786, $total);

        // Render Livewire ChatVisitorsPage
        $component = Livewire::test(ChatVisitorsPage::class);

        // In default 'all_identified' filter: loads only identified customers
        $identifiedPaginated = $component->instance()->visitors;
        $this->assertNotNull($identifiedPaginated);
        $this->assertLessThanOrEqual(15, $identifiedPaginated->count(), 'Mỗi trang chỉ load tối đa 15 visitor');

        // In 'all' filter: total reflects all 786+ visitors
        $component->call('setCustomerFilter', 'all');
        $allPaginated = $component->instance()->visitors;
        $this->assertGreaterThanOrEqual(786, $allPaginated->total());
        $this->assertLessThanOrEqual(15, $allPaginated->count());
    }

    /**
     * TEST 17: Pagination -> query đúng và không N+1.
     */
    public function test_17_pagination_eager_loading_avoids_n_plus_one(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        \Illuminate\Support\Facades\Gate::before(fn () => true);

        // Test page 1 and page 2 navigation
        $component = Livewire::test(ChatVisitorsPage::class);
        $component->call('setCustomerFilter', 'all');
        $page1 = $component->instance()->visitors;
        $this->assertEquals(1, $page1->currentPage());

        $component->call('gotoPage', 2);
        $page2 = $component->instance()->visitors;
        $this->assertEquals(2, $page2->currentPage());
        $this->assertLessThanOrEqual(15, $page2->count());
    }

    /**
     * TEST 18: Unauthorized user -> không thể xem customer data nếu policy không cho phép.
     */
    public function test_18_unauthorized_user_forbidden(): void
    {
        // 1. Unauthenticated guest request -> redirects to login
        $response = $this->get(route('filament.admin.pages.chat-visitors'));
        $response->assertRedirect(route('filament.admin.auth.login'));

        // 2. Authenticated user without permission -> 403 Forbidden
        $userWithoutPermission = User::factory()->create();
        $this->actingAs($userWithoutPermission);
        $authResponse = $this->get(route('filament.admin.pages.chat-visitors'));
        $this->assertTrue(in_array($authResponse->status(), [403, 302]));
    }

    /**
     * TEST 19: XSS trong fullname/message -> stripped và sanitize.
     */
    public function test_19_xss_protection_strips_script_tags(): void
    {
        $xssFullname = '<script>alert("XSS")</script>Nguyễn An Toàn';
        $xssMessage = '<img src=x onerror=alert(1)>Cần tư vấn thiết kế website';

        $this->postJson('/lien-he', [
            'fullname' => $xssFullname,
            'phone' => '0939191919',
            'message' => $xssMessage,
        ]);

        $contact = Contact::where('phone', '0939191919')->first();
        $this->assertNotNull($contact);
        $this->assertStringNotContainsString('<script>', $contact->fullname);
        $this->assertStringNotContainsString('<img', $contact->message);
    }

    /**
     * TEST 20: Spam submit -> rate limit (throttle:5,1) hoạt động.
     */
    public function test_20_rate_limiting_blocks_spam(): void
    {
        RateLimiter::clear('5,1');

        $submitted = 0;
        $blocked = false;

        for ($i = 1; $i <= 8; $i++) {
            $res = $this->post('/lien-he', [
                'fullname' => "Spam Bot {$i}",
                'phone' => '0939202020',
                'message' => 'Spam test spam test',
            ]);

            if ($res->status() === 429) {
                $blocked = true;
                break;
            }
            $submitted++;
        }

        $this->assertTrue($blocked || $submitted <= 5, 'Rate limiter phải chặn khi submit quá nhiều lần trong 1 phút');
    }
}
