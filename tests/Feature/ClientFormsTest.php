<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\JobApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClientFormsTest extends TestCase
{
    /**
     * Test 1: Footer Consultation Form với số điện thoại thông thường
     */
    public function test_footer_consultation_form_with_phone(): void
    {
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_footer',
            'source_url' => 'https://truyenthongcuulong.vn/',
            'message' => 'Đăng ký tư vấn nhanh từ Footer',
            'fullname' => 'Nguyễn Văn Test',
            'phone' => '0939363262',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Nguyễn Văn Test',
            'phone' => '0939363262',
            'channel' => 'website_footer',
        ]);
    }

    /**
     * Test 2: Footer Consultation Form với Email điền vào ô Phone (Trường hợp gây lỗi 500 trước đây)
     */
    public function test_footer_consultation_form_with_email_in_phone_field(): void
    {
        $email = 'hoangninh2577@gmail.com';
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_footer',
            'source_url' => 'https://truyenthongcuulong.vn/',
            'message' => 'Đăng ký tư vấn nhanh từ Footer',
            'fullname' => 'Khách Hàng Email Footer',
            'phone' => $email,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Khách Hàng Email Footer',
            'email' => $email,
            'channel' => 'website_footer',
        ]);
    }

    /**
     * Test 3: Footer Consultation Form với Email dài (> 20 ký tự, test cột VARCHAR(20) của chat_visitors)
     */
    public function test_footer_consultation_form_with_long_email_does_not_throw_500(): void
    {
        $longEmail = 'rat-dai-khach-hang-dac-biet-cuu-long@doanhnghiep-mientay.com.vn';
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_footer',
            'source_url' => 'https://truyenthongcuulong.vn/',
            'message' => 'Đăng ký tư vấn nhanh từ Footer',
            'fullname' => 'Doanh Nghiệp Miền Tây',
            'phone' => $longEmail,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Doanh Nghiệp Miền Tây',
            'email' => $longEmail,
            'channel' => 'website_footer',
        ]);
    }

    /**
     * Test 4: Banner CTA Form
     */
    public function test_banner_cta_form_submission(): void
    {
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_banner',
            'source_url' => 'https://truyenthongcuulong.vn/gioi-thieu',
            'message' => 'Đăng ký tư vấn từ khối CTA Sẵn Sàng Bứt Phá',
            'fullname' => 'Trần Thị Banner',
            'phone' => '0918123456',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Trần Thị Banner',
            'phone' => '0918123456',
            'channel' => 'website_banner',
        ]);
    }

    /**
     * Test 5: Main Contact Page Form (/lien-he)
     */
    public function test_main_contact_page_form_submission(): void
    {
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_contact',
            'source_url' => 'https://truyenthongcuulong.vn/lien-he',
            'fullname' => 'Lê Văn Liên Hệ',
            'phone' => '0907123987',
            'email' => 'contact_test@cuulong.vn',
            'service_interested' => 'Sản xuất Phim & Video',
            'message' => 'Cần tư vấn quay TVC giới thiệu doanh nghiệp tại Cần Thơ',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Lê Văn Liên Hệ',
            'phone' => '0907123987',
            'email' => 'contact_test@cuulong.vn',
            'service_interested' => 'Sản xuất Phim & Video',
            'channel' => 'website_contact',
        ]);
    }

    /**
     * Test 6: Service Detail Form (/dich-vu/{slug})
     */
    public function test_service_detail_form_submission(): void
    {
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_service',
            'source_url' => 'https://truyenthongcuulong.vn/dich-vu/san-xuat-phim-doanh-nghiep',
            'service_interested' => 'Sản Xuất Phim Doanh Nghiệp',
            'fullname' => 'Phạm Văn Dịch Vụ',
            'phone' => '0945999888',
            'email' => 'service_inquiry@cuulong.vn',
            'message' => 'Báo giá sản xuất video 4K thời lượng 3 phút',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Phạm Văn Dịch Vụ',
            'phone' => '0945999888',
            'service_interested' => 'Sản Xuất Phim Doanh Nghiệp',
        ]);
    }

    /**
     * Test 7: Video Service Quick Form (event-videography)
     */
    public function test_event_videography_form_submission(): void
    {
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_service',
            'source_url' => 'https://truyenthongcuulong.vn/dich-vu/quay-phim-su-kien-can-tho',
            'service_interested' => 'Quay phim sự kiện',
            'fullname' => 'Hoàng Quay Phim',
            'phone' => '0939000111',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Hoàng Quay Phim',
            'phone' => '0939000111',
            'service_interested' => 'Quay phim sự kiện',
        ]);
    }

    /**
     * Test 8: Booking Media Team Form (/booking)
     */
    public function test_booking_form_submission(): void
    {
        $response = $this->post(route('contact.submit'), [
            'channel' => 'website_booking',
            'source_url' => 'https://truyenthongcuulong.vn/booking',
            'service_interested' => 'booking-media',
            'fullname' => 'Đoàn Khách Booking',
            'phone' => '0988777666',
            'message' => 'Khách đặt lịch: Đoàn Khách Booking | SĐT: 0988777666 | Ngày: 2026-11-15 | Địa điểm: TP. Cần Thơ',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Đoàn Khách Booking',
            'phone' => '0988777666',
            'channel' => 'website_booking',
        ]);
    }

    /**
     * Test 9: Template Consultation Modal (AJAX POST)
     */
    public function test_template_consult_ajax_submission(): void
    {
        $response = $this->postJson(route('contact.submit'), [
            'channel' => 'website_template',
            'source_url' => 'https://truyenthongcuulong.vn/mau-giao-dien',
            'fullname' => 'Khách Mua Template',
            'phone' => '0966555444',
            'email' => 'template_buyer@gmail.com',
            'service_interested' => 'Tải về / Tư vấn Template: Corporate B2B Tech',
            'message' => 'Mã mẫu: corporate_b2b',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $this->assertDatabaseHas('contacts', [
            'fullname' => 'Khách Mua Template',
            'phone' => '0966555444',
            'email' => 'template_buyer@gmail.com',
            'channel' => 'website_template',
        ]);
    }

    /**
     * Test 10: Recruitment Form (/tuyen-dung/apply)
     */
    public function test_careers_job_application_submission(): void
    {
        Storage::fake('private_cv');

        $file = UploadedFile::fake()->create('my_cv.pdf', 500, 'application/pdf');

        $response = $this->post(route('careers.apply'), [
            'fullname' => 'Ứng Viên Tiềm Năng',
            'phone' => '0912345678',
            'email' => 'ungvien@gmail.com',
            'position' => 'Senior Video Editor & Motion Designer',
            'cv_file' => $file,
            'cover_letter' => 'Tôi có 5 năm kinh nghiệm dựng phim và làm animation.',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('job_applications', [
            'fullname' => 'Ứng Viên Tiềm Năng',
            'phone' => '0912345678',
            'email' => 'ungvien@gmail.com',
            'position' => 'Senior Video Editor & Motion Designer',
        ]);
    }
}
