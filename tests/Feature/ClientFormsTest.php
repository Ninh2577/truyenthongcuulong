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

    /**
     * Test 11: Validation - Footer Form với số điện thoại sai định dạng (quá ngắn hoặc chứa chữ cái)
     */
    public function test_footer_form_rejects_invalid_phone_with_friendly_error(): void
    {
        $response = $this->from(route('home'))->post(route('contact.submit'), [
            'channel' => 'website_footer',
            'source_url' => 'https://truyenthongcuulong.vn/',
            'message' => 'Đăng ký tư vấn',
            'fullname' => 'Khách Hàng Sai SĐT',
            'phone' => '12345', // Quá ngắn
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['phone']);
        $this->assertNotEquals(500, $response->getStatusCode());
    }

    /**
     * Test 12: Validation - Footer Form với email sai định dạng trong ô phone
     */
    public function test_footer_form_rejects_invalid_email_with_friendly_error(): void
    {
        $response = $this->from(route('home'))->post(route('contact.submit'), [
            'channel' => 'website_footer',
            'source_url' => 'https://truyenthongcuulong.vn/',
            'message' => 'Đăng ký tư vấn',
            'fullname' => 'Khách Hàng Sai Email',
            'phone' => 'invalid-email@', // Email không hợp lệ
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['phone']);
        $this->assertNotEquals(500, $response->getStatusCode());
    }

    /**
     * Test 13: Validation - Main Contact Page bỏ trống họ tên và số điện thoại
     */
    public function test_contact_page_rejects_empty_inputs_with_friendly_error(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.submit'), [
            'channel' => 'website_contact',
            'source_url' => 'https://truyenthongcuulong.vn/lien-he',
            'fullname' => '',
            'phone' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['fullname', 'phone']);
        $this->assertNotEquals(500, $response->getStatusCode());
    }

    /**
     * Test 14: Validation - Template Modal qua AJAX gửi dữ liệu sai định dạng trả về HTTP 422 JSON
     */
    public function test_template_ajax_rejects_invalid_phone_with_422_json(): void
    {
        $response = $this->postJson(route('contact.submit'), [
            'channel' => 'website_template',
            'source_url' => 'https://truyenthongcuulong.vn/mau-giao-dien',
            'fullname' => 'A', // Tên quá ngắn (< 2 ký tự)
            'phone' => '0939abcxyz', // Chứa chữ cái
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
        ]);
        $response->assertJsonStructure(['message']);
        $this->assertNotEquals(500, $response->getStatusCode());
    }

    /**
     * Test 15: Validation - Tuyển dụng nộp file không hợp lệ (.exe)
     */
    public function test_careers_apply_rejects_invalid_file_extension(): void
    {
        Storage::fake('private_cv');
        $file = UploadedFile::fake()->create('malicious_file.exe', 100);

        $response = $this->from(route('careers'))->post(route('careers.apply'), [
            'fullname' => 'Hacker Test',
            'phone' => '0912345678',
            'email' => 'hacker@example.com',
            'position' => 'Developer',
            'cv_file' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['cv_file']);
        $this->assertNotEquals(500, $response->getStatusCode());
    }
}

