<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Menu;
use Database\Seeders\CaseStudySeeder;
use Database\Seeders\MenuSeeder;
use Tests\TestCase;

class UiRebuild09PortfolioTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (Menu::where('location', 'header')->count() === 0) {
            $this->seed(MenuSeeder::class);
        }
        if (CaseStudy::count() === 0) {
            $this->seed(CaseStudySeeder::class);
        }
    }

    /**
     * Requirement 1: Trang danh mục dự án trả về HTTP 200.
     */
    public function test_portfolio_index_returns_http_200(): void
    {
        $response = $this->get('/du-an');
        $response->assertStatus(200);
    }

    /**
     * Requirement 2: Hai trang Case Study hiện có trả về HTTP 200.
     */
    public function test_both_case_study_detail_pages_return_http_200(): void
    {
        $giaPhuoc = $this->get('/du-an/ung-dung-quan-ly-phong-kham');
        $giaPhuoc->assertStatus(200);

        $nuCuoi = $this->get('/du-an/website-phong-kham-da-khoa');
        $nuCuoi->assertStatus(200);
    }

    /**
     * Requirement 3: Mỗi trang có đúng một H1 hợp lệ.
     */
    public function test_each_portfolio_page_has_strictly_one_h1(): void
    {
        $pages = [
            '/du-an',
            '/du-an/ung-dung-quan-ly-phong-kham',
            '/du-an/website-phong-kham-da-khoa',
        ];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $html = $response->getContent();

            preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $html, $matches);
            $this->assertCount(1, $matches[0], "Page '{$url}' must have strictly one <h1> element.");
        }

        // Check index H1 phrasing
        $indexResponse = $this->get('/du-an');
        $indexHtml = $indexResponse->getContent();
        $this->assertStringContainsString('Dự án thực tế &amp; giải pháp đã triển khai', $indexHtml);
    }

    /**
     * Requirement 4: Các liên kết đến dự án hoạt động và trỏ đúng route.
     */
    public function test_project_links_resolve_and_navigate_correctly(): void
    {
        $response = $this->get('/du-an');
        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('/du-an/ung-dung-quan-ly-phong-kham', $html);
        $this->assertStringContainsString('/du-an/website-phong-kham-da-khoa', $html);

        // Click through test
        $detail = $this->get('/du-an/ung-dung-quan-ly-phong-kham');
        $detail->assertStatus(200);
        $detail->assertSee('Phòng Khám Gia Phước');
    }

    /**
     * Requirement 5: Các bộ lọc dự án hoạt động thực tế trên dữ liệu.
     */
    public function test_portfolio_filters_work_dynamically(): void
    {
        // Technology filter
        $techResponse = $this->get('/du-an?group=technology');
        $techResponse->assertStatus(200);
        $techHtml = $techResponse->getContent();
        $this->assertStringContainsString('Ứng Dụng Quản Lý &amp; Đặt Lịch Phòng Khám Đa Khoa', $techHtml);
        $this->assertStringNotContainsString('TVC Quảng Cáo Ngân Hàng Sacombank', $techHtml);

        // Media filter
        $mediaResponse = $this->get('/du-an?group=media');
        $mediaResponse->assertStatus(200);
        $mediaHtml = $mediaResponse->getContent();
        $this->assertStringContainsString('TVC Quảng Cáo Ngân Hàng Sacombank', $mediaHtml);
        $this->assertStringNotContainsString('Ứng Dụng Quản Lý &amp; Đặt Lịch Phòng Khám Đa Khoa', $mediaHtml);
    }

    /**
     * Requirement 6: Dữ liệu dự án lấy từ nguồn hiện có (không tạo dữ liệu giả).
     */
    public function test_project_data_is_grounded_in_database(): void
    {
        $response = $this->get('/du-an');
        $response->assertStatus(200);

        // Real clients from DB
        $response->assertSee('Phòng Khám Gia Phước');
        $response->assertSee('Nha Khoa Nụ Cười');
        $response->assertSee('Sacombank');
    }

    /**
     * Requirement 7: Không xuất hiện claim hoặc số liệu giả mạo.
     */
    public function test_no_fabricated_metrics_or_fake_claims(): void
    {
        $urls = [
            '/du-an',
            '/du-an/ung-dung-quan-ly-phong-kham',
            '/du-an/website-phong-kham-da-khoa',
        ];

        $prohibitedPatterns = [
            '65M\+\s*Views',
            '12\.8M\s*Reach',
            '\+320%\s*Conversion',
            '100%\s*mã\s*nguồn\s*độc\s*quyền',
            'bảo\s*hành\s*trọn\s*đời',
            '#1\s*tại\s*Việt\s*Nam',
            'top\s*1\s*công\s*nghệ',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $html = $response->getContent();

            foreach ($prohibitedPatterns as $pattern) {
                $this->assertDoesNotMatchRegularExpression(
                    '/' . $pattern . '/iu',
                    $html,
                    "Page '{$url}' contains prohibited fake claim: {$pattern}"
                );
            }
        }
    }

    /**
     * Requirement 8: Breadcrumb và canonical URL hợp lệ trên các trang.
     */
    public function test_breadcrumb_and_canonical_urls_are_valid(): void
    {
        $giaPhuoc = $this->get('/du-an/ung-dung-quan-ly-phong-kham');
        $giaPhuoc->assertStatus(200);
        $gpHtml = $giaPhuoc->getContent();

        $this->assertStringContainsString('aria-label="Breadcrumb"', $gpHtml);
        $this->assertStringContainsString(url('/du-an/ung-dung-quan-ly-phong-kham'), $gpHtml);

        $index = $this->get('/du-an');
        $index->assertStatus(200);
        $indexHtml = $index->getContent();

        $this->assertStringContainsString('aria-label="Breadcrumb"', $indexHtml);
        $this->assertStringContainsString(url('/du-an'), $indexHtml);
    }

    /**
     * Requirement 9: Không có liên kết rỗng (href="#") hoặc javascript:void(0).
     */
    public function test_no_dead_or_javascript_links_in_portfolio(): void
    {
        $urls = [
            '/du-an',
            '/du-an/ung-dung-quan-ly-phong-kham',
            '/du-an/website-phong-kham-da-khoa',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $html = $response->getContent();

            $this->assertDoesNotMatchRegularExpression(
                '/href="#"/i',
                $html,
                "Page '{$url}' must not contain empty href='#'"
            );

            $this->assertDoesNotMatchRegularExpression(
                '/href="javascript:void\(0\)"/i',
                $html,
                "Page '{$url}' must not contain javascript:void(0)"
            );
        }
    }

    /**
     * Requirement 10: Không làm hỏng các trang dịch vụ và trang chủ (Regression).
     */
    public function test_homepage_and_services_remain_unbroken(): void
    {
        $routes = [
            '/',
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
            '/dich-vu/bang-gia',
            '/lien-he',
            '/quy-trinh',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200, "Regression route '{$route}' must return 200 OK");
        }
    }
}
