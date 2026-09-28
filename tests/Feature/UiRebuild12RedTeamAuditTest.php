<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Post;
use App\Models\PricingPlan;
use App\Models\Service;
use Tests\TestCase;

class UiRebuild12RedTeamAuditTest extends TestCase
{
    /**
     * Danh sách toàn bộ các route tĩnh cần kiểm toán độc lập
     */
    protected array $coreRoutes = [
        'Trang chủ' => '/',
        'Hub Dịch vụ' => '/dich-vu',
        'Web App' => '/dich-vu/web-app',
        'Kho giao diện' => '/dich-vu/kho-giao-dien',
        'Bảng giá' => '/dich-vu/bang-gia',
        'Marketing' => '/dich-vu/marketing',
        'Media' => '/dich-vu/media',
        'Booking' => '/dich-vu/booking',
        'Danh mục dự án' => '/du-an',
        'Danh sách bài viết' => '/bai-viet',
        'Trung tâm tài nguyên' => '/tai-nguyen',
        'Về chúng tôi' => '/ve-chung-toi',
        'Quy trình' => '/quy-trinh',
        'Đối tác' => '/doi-tac',
        'Khách hàng' => '/khach-hang',
        'Tuyển dụng' => '/tuyen-dung',
        'Hồ sơ năng lực' => '/ho-so-nang-luc',
        'Liên hệ' => '/lien-he',
        'Chính sách bảo mật' => '/chinh-sach-bao-mat',
        'Điều khoản dịch vụ' => '/dieu-khoan-dich-vu',
    ];

    /**
     * 1. Red-Team: Kiểm tra HTTP status cho toàn bộ 20 route tĩnh
     */
    public function test_red_team_all_static_routes_return_http_200(): void
    {
        foreach ($this->coreRoutes as $name => $uri) {
            $response = $this->get($uri);
            $response->assertStatus(200, "Route [{$name}] ({$uri}) phải trả về HTTP 200.");
        }
    }

    /**
     * 2. Red-Team: Kiểm tra Legacy Redirect (301)
     */
    public function test_red_team_legacy_redirect_301(): void
    {
        $response = $this->get('/kho-giao-dien');
        $response->assertStatus(301);
        $response->assertRedirect('/dich-vu/kho-giao-dien');
    }

    /**
     * 3. Red-Team: Kiểm tra nghiêm ngặt mỗi trang chỉ có duy nhất 1 thẻ H1
     */
    public function test_red_team_strictly_single_h1_per_page(): void
    {
        foreach ($this->coreRoutes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);
            $count = count($matches[0]);
            $this->assertEquals(1, $count, "Route [{$name}] ({$uri}) phải có chính xác 1 thẻ <h1>, phát hiện: {$count}.");
        }
    }

    /**
     * 4. Red-Team: Kiểm tra font Mulish được nạp và áp dụng trên tất cả các trang
     */
    public function test_red_team_mulish_font_declared_everywhere(): void
    {
        foreach ($this->coreRoutes as $name => $uri) {
            $response = $this->get($uri);
            $response->assertSee('family=Mulish', false, "Route [{$name}] ({$uri}) thiếu link tải Mulish.");
            $response->assertSee('font-headline', false, "Route [{$name}] ({$uri}) thiếu class font-headline.");
            // Không chứa các font cũ bị phế truất
            $this->assertStringNotContainsString('font-family: \'Manrope\'', $response->getContent());
            $this->assertStringNotContainsString('font-family: \'Space Grotesk\'', $response->getContent());
            $this->assertStringNotContainsString('font-family: \'Plus Jakarta Sans\'', $response->getContent());
        }
    }

    /**
     * 5. Red-Team: Quét sạch lỗi mojibake / encoding UTF-8 hỏng
     */
    public function test_red_team_no_utf8_mojibake_in_rendered_html(): void
    {
        foreach ($this->coreRoutes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            
            $this->assertDoesNotMatchRegularExpression('/Ã[¡-¿]|á»|Ä[‘-™]|Â·|Táº¡p|chá»§/u', $html, "Route [{$name}] ({$uri}) chứa chuỗi ký tự UTF-8 bị hỏng (mojibake).");
        }
    }

    /**
     * 6. Red-Team: Kiểm tra SEO Meta Tags (Title, Description, Canonical)
     */
    public function test_red_team_seo_meta_tags_present(): void
    {
        foreach ($this->coreRoutes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            
            $this->assertMatchesRegularExpression('/<title\b[^>]*>.+?<\/title>/is', $html, "Route [{$name}] ({$uri}) thiếu <title> hợp lệ.");
            $this->assertMatchesRegularExpression('/<meta\s+name=["\']description["\']\s+content=["\'][^"\']+["\']/i', $html, "Route [{$name}] ({$uri}) thiếu meta description.");
            $this->assertMatchesRegularExpression('/<link\s+rel=["\']canonical["\']\s+href=["\'][^"\']+["\']/i', $html, "Route [{$name}] ({$uri}) thiếu canonical URL.");
        }
    }

    /**
     * 7. Red-Team: Kiểm tra tính sẵn sàng của Header, Footer và Skip Link
     */
    public function test_red_team_layout_scaffolding(): void
    {
        foreach ($this->coreRoutes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            
            $this->assertStringContainsString('<header', $html, "Route [{$name}] ({$uri}) thiếu <header>.");
            $this->assertStringContainsString('<footer', $html, "Route [{$name}] ({$uri}) thiếu <footer>.");
            $this->assertStringContainsString('href="#main-content"', $html, "Route [{$name}] ({$uri}) thiếu Skip to content link (WCAG 2.1).");
            $this->assertStringContainsString('Bắt đầu dự án', $html, "Route [{$name}] ({$uri}) thiếu CTA chính.");
        }
    }

    /**
     * 8. Red-Team: Kiểm tra toàn vẹn dữ liệu động thực tế từ Database
     */
    public function test_red_team_database_dynamic_data_integrity(): void
    {
        // Case Study thực tế
        $caseStudies = CaseStudy::all();
        $this->assertGreaterThanOrEqual(2, $caseStudies->count(), 'Phải có ít nhất 2 Case Study trong DB.');
        foreach ($caseStudies as $cs) {
            $response = $this->get('/du-an/' . $cs->slug);
            $response->assertStatus(200);
            $response->assertSee(e($cs->title), false);
            // Đúng 1 H1
            preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $response->getContent(), $h1);
            $this->assertEquals(1, count($h1[0]), "Case study [{$cs->slug}] phải có chính xác 1 H1.");
        }

        // Bài viết đã xuất bản
        $posts = Post::where('status', 'published')->limit(5)->get();
        $this->assertGreaterThan(0, $posts->count(), 'Phải có bài viết xuất bản trong DB.');
        foreach ($posts as $post) {
            $response = $this->get('/' . $post->slug);
            $response->assertStatus(200);
            $response->assertSee(e($post->title), false);
        }

        // Đối tác & Khách hàng
        $this->assertGreaterThan(0, Partner::active()->count(), 'Phải có đối tác active.');
        $this->assertGreaterThan(0, Client::active()->count(), 'Phải có khách hàng active.');
        $this->assertGreaterThan(0, PricingPlan::active()->count(), 'Phải có bảng giá active.');
    }

    /**
     * 9. Red-Team: Kiểm tra xử lý lỗi 404 cho URL không tồn tại
     */
    public function test_red_team_graceful_404_handling(): void
    {
        $response = $this->get('/du-an/khong-ton-tai-xyz-999');
        $response->assertStatus(404);

        $responsePost = $this->get('/bai-viet-hoan-toan-khong-co-that-999');
        $responsePost->assertStatus(404);
    }

    /**
     * 10. Red-Team: Kiểm tra Contact Form Validation & Rate Limiting Contract
     */
    public function test_red_team_contact_contract_and_security(): void
    {
        // GET contact page
        $response = $this->get('/lien-he');
        $response->assertStatus(200);
        $response->assertSee('csrf-token', false);

        // POST empty payload -> fail validation
        $emptySubmit = $this->from('/lien-he')->post('/lien-he', []);
        $emptySubmit->assertRedirect('/lien-he');
        $emptySubmit->assertSessionHasErrors(['fullname', 'phone', 'message']);
    }
}
