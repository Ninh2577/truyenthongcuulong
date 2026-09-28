<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UiRebuild11GlobalConsistencyTest extends TestCase
{
    /**
     * 1. Kiểm tra tất cả các route chính trả về HTTP 200 OK.
     */
    public function test_all_core_routes_return_http_200(): void
    {
        $routes = [
            'home' => '/',
            'services.index' => '/dich-vu',
            'services.web-app' => '/dich-vu/web-app',
            'templates.index' => '/dich-vu/kho-giao-dien',
            'pricing' => '/dich-vu/bang-gia',
            'services.marketing' => '/dich-vu/marketing',
            'services.media' => '/dich-vu/media',
            'booking' => '/dich-vu/booking',
            'projects.index' => '/du-an',
            'blog.index' => '/bai-viet',
            'contact' => '/lien-he',
            'about' => '/ve-chung-toi',
            'process' => '/quy-trinh',
            'partners' => '/doi-tac',
            'clients' => '/khach-hang',
        ];

        foreach ($routes as $name => $uri) {
            $response = $this->get($uri);
            $response->assertStatus(200, "Route [{$name}] ({$uri}) should return HTTP 200.");
        }
    }

    /**
     * 2. Kiểm tra Mulish typography được sử dụng nhất quán trên toàn bộ layout công khai.
     */
    public function test_mulish_font_is_consistently_declared(): void
    {
        $pages = ['/', '/dich-vu', '/du-an', '/bai-viet', '/lien-he'];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertStatus(200);
            $response->assertSee('family=Mulish', false, "Page [{$page}] should load Mulish Google Font.");
            $response->assertSee('font-headline', false, "Page [{$page}] should use Mulish headline typography token.");
        }
    }

    /**
     * 3. Kiểm tra mỗi trang có chính xác 1 thẻ H1 duy nhất cho chuẩn SEO & Accessibility.
     */
    public function test_each_public_page_has_exactly_one_h1(): void
    {
        $pages = [
            '/',
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/bang-gia',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
            '/du-an',
            '/bai-viet',
            '/lien-he',
            '/ve-chung-toi',
            '/quy-trinh',
            '/doi-tac',
            '/khach-hang',
        ];

        foreach ($pages as $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            preg_match_all('/<h1\b[^>]*>/i', $html, $matches);
            $h1Count = count($matches[0]);
            $this->assertEquals(1, $h1Count, "Route [{$uri}] should have exactly 1 <h1> tag, found {$h1Count}.");
        }
    }

    /**
     * 4. Kiểm tra Header và Footer luôn hiển thị trên tất cả các trang công khai.
     */
    public function test_header_and_footer_are_rendered_across_pages(): void
    {
        $pages = ['/', '/dich-vu', '/du-an', '/bai-viet', '/lien-he', '/quy-trinh'];

        foreach ($pages as $uri) {
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertSee('<header', false);
            $response->assertSee('TRUYỀN THÔNG CỬU LONG', false);
            $response->assertSee('<footer', false);
            $response->assertSee('Bắt đầu dự án', false);
        }
    }

    /**
     * 5. Kiểm tra các CTA chính dẫn đến route hợp lệ.
     */
    public function test_core_ctas_lead_to_valid_routes(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        
        // Header CTA and hero buttons
        $response->assertSee(route('contact'), false);
        $response->assertSee(route('services.index'), false);
        $response->assertSee(route('projects.index'), false);
    }

    /**
     * 6. Kiểm tra biểu mẫu liên hệ (/lien-he) duy trì hợp đồng backend và validation.
     */
    public function test_contact_form_contract_and_submission(): void
    {
        $response = $this->get('/lien-he');
        $response->assertStatus(200);
        $response->assertSee('name="fullname"', false);
        $response->assertSee('name="phone"', false);
        $response->assertSee('name="message"', false);
        $response->assertSee(route('contact.submit'), false);

        // Validation error on empty submission
        $submitResponse = $this->from('/lien-he')->post('/lien-he', []);
        $submitResponse->assertRedirect('/lien-he');
        $submitResponse->assertSessionHasErrors(['fullname', 'phone', 'message']);
    }

    /**
     * 7. Kiểm tra trang Dịch vụ & Giải pháp hiển thị chuẩn hóa sau khi đồng bộ component.
     */
    public function test_services_pages_consistency(): void
    {
        $serviceRoutes = [
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
            '/dich-vu/kho-giao-dien',
        ];

        foreach ($serviceRoutes as $uri) {
            $response = $this->get($uri);
            $response->assertStatus(200);
            // Check that page content is substantial and contains structured service elements
            $this->assertGreaterThan(5000, strlen($response->getContent()), "Service page [{$uri}] should render substantial content.");
        }
    }

    /**
     * 8. Kiểm tra trang Dự án và chi tiết Case Study thực tế.
     */
    public function test_portfolio_and_case_study_detail(): void
    {
        $response = $this->get('/du-an');
        $response->assertStatus(200);
        $response->assertSee('Dự án thực tế', false);

        // Check first case study
        $caseStudy = CaseStudy::first();
        if ($caseStudy) {
            $detailResponse = $this->get('/du-an/' . $caseStudy->slug);
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee(e($caseStudy->title), false);
            // Must have strictly 1 H1
            preg_match_all('/<h1\b[^>]*>/i', $detailResponse->getContent(), $h1Matches);
            $this->assertEquals(1, count($h1Matches[0]), "Case study [{$caseStudy->slug}] must have exactly 1 H1.");
        }
    }

    /**
     * 9. Kiểm tra trang Bài viết và chi tiết bài viết không còn lỗi UTF-8 mojibake.
     */
    public function test_blog_and_post_detail_utf8_integrity(): void
    {
        $response = $this->get('/bai-viet');
        $response->assertStatus(200);
        $response->assertSee('Tạp Chí', false);
        $response->assertDontSee('Táº¡p chÃ­', false);

        // Check published post detail
        $post = Post::where('status', 'published')->first();
        if ($post) {
            $postResponse = $this->get('/' . $post->slug);
            $postResponse->assertStatus(200);
            $postHtml = $postResponse->getContent();
            // Should not contain corrupted mojibake
            $this->assertStringNotContainsString('Truyá» n ThÃ´ng Cá»­u Long', $postHtml);
            $this->assertStringNotContainsString('Trang chá»§', $postHtml);
            $this->assertStringNotContainsString('Táº¡p chÃ­', $postHtml);
            $this->assertStringNotContainsString('Ná»™i dung chÃ­nh', $postHtml);
            $this->assertStringContainsString('Truyền Thông Cửu Long', $postHtml);
        }
    }

    /**
     * 10. Kiểm tra không có thẻ a rỗng (href="#" hoặc href="") trong các nút điều hướng chính.
     */
    public function test_no_empty_action_links_on_home(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        // Ensure key buttons don't have empty links
        $this->assertDoesNotMatchString('/<a\s+[^>]*href=["\']#["\'][^>]*class=["\'][^"\']*(btn-primary|btn-primary-cta|bg-primary)[^"\']*["\']/i', $html);
    }

    /**
     * Helper assertion for regex negative matching.
     */
    private function assertDoesNotMatchString(string $pattern, string $string, string $message = ''): void
    {
        $this->assertFalse((bool) preg_match($pattern, $string), $message ?: "Failed asserting that string does not match pattern {$pattern}");
    }
}
