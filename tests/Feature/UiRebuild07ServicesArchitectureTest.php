<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiRebuild07ServicesArchitectureTest extends TestCase
{
    /**
     * Test 1: Typography - Mulish is preloaded and loaded in layout, old fonts removed.
     */
    public function test_mulish_typography_system_loaded_and_old_fonts_removed(): void
    {
        $layoutContent = file_get_contents(resource_path('views/layouts/app.blade.php'));

        // Mulish must be loaded
        $this->assertStringContainsString('family=Mulish', $layoutContent);

        // Preload attribute is used
        $this->assertStringContainsString('rel="preload" as="style"', $layoutContent);

        // Discarded fonts MUST NOT be in layout
        $this->assertStringNotContainsString('family=Space+Grotesk', $layoutContent);
        $this->assertStringNotContainsString('family=Plus+Jakarta+Sans', $layoutContent);
        $this->assertStringNotContainsString('family=Manrope', $layoutContent);
        $this->assertStringNotContainsString('family=Inter', $layoutContent);
    }

    /**
     * Test 2: Typography - Semantic CSS variables and Tailwind map to Mulish.
     */
    public function test_typography_tokens_in_css_and_tailwind(): void
    {
        $cssContent = file_get_contents(resource_path('css/app.css'));

        $this->assertStringContainsString("--font-primary: 'Mulish'", $cssContent);
        $this->assertStringContainsString("--font-heading: var(--font-primary)", $cssContent);
        $this->assertStringContainsString("--font-body: var(--font-primary)", $cssContent);

        $tailwindConfig = file_get_contents(base_path('tailwind.config.js'));
        $this->assertStringContainsString("'Mulish'", $tailwindConfig);
        $this->assertStringContainsString('"headline": ["var(--font-primary)"', $tailwindConfig);
        $this->assertStringContainsString('"body": ["var(--font-primary)"', $tailwindConfig);
    }

    /**
     * Test 3: Routes - All 7 solution and service canonical routes return HTTP 200.
     */
    public function test_all_seven_service_routes_return_http_200(): void
    {
        $routes = [
            '/dich-vu' => 'Solution Hub',
            '/dich-vu/web-app' => 'Web App Flagship',
            '/dich-vu/kho-giao-dien' => 'Rapid Deployment Library',
            '/dich-vu/bang-gia' => 'Pricing Framework',
            '/dich-vu/marketing' => 'Technical Marketing & Growth',
            '/dich-vu/media' => 'Media & Visual Assets',
            '/dich-vu/booking' => 'On-demand Crew Dispatch',
        ];

        foreach ($routes as $route => $name) {
            $response = $this->get($route);
            $response->assertStatus(200, "Route {$route} ({$name}) must return HTTP 200");
        }
    }

    /**
     * Test 4: H1 - Exactly one H1 per page across all 7 pages with correct semantic copy.
     */
    public function test_each_service_page_has_strictly_one_h1(): void
    {
        $expectedH1s = [
            '/dich-vu' => ['Bài Toán Vận Hành', 'Công Nghệ Phù Hợp'],
            '/dich-vu/web-app' => ['Web App & Hệ Thống', 'Quy Trình Vận Hành Doanh Nghiệp'],
            '/dich-vu/kho-giao-dien' => ['Thư Viện Nền Tảng Triển Khai Website Nhanh'],
            '/dich-vu/bang-gia' => ['Khung Chi Phí Phát Triển Phần Mềm'],
            '/dich-vu/marketing' => ['SEO', 'Dữ Liệu Thực Tế'],
            '/dich-vu/media' => ['Sản Xuất Tư Liệu', 'Doanh Nghiệp'],
            '/dich-vu/booking' => ['Điều Phối Ekip Media'],
        ];

        foreach ($expectedH1s as $route => $keywords) {
            $response = $this->get($route);
            $content = $response->getContent();

            $h1Count = preg_match_all('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $content, $matches);
            $this->assertEquals(1, $h1Count, "Route {$route} must contain strictly 1 H1 heading tag. Found: {$h1Count}");

            $rawH1 = html_entity_decode(strip_tags($matches[1][0]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $h1Text = preg_replace('/\s+/u', ' ', trim($rawH1));
            foreach ($keywords as $kw) {
                $this->assertTrue(
                    mb_stripos($h1Text, $kw) !== false,
                    "Route {$route} H1 must contain '{$kw}'. Actual: {$h1Text}"
                );
            }
        }
    }

    /**
     * Test 5: Mega Menu - 3 Zones (Bài toán doanh nghiệp, Giải pháp công nghệ, Minh chứng) + CTA.
     */
    public function test_mega_menu_three_zones_and_primary_cta(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringContainsString('BÀI TOÁN DOANH NGHIỆP', $content);
        $this->assertStringContainsString('GIẢI PHÁP CÔNG NGHỆ', $content);
        $this->assertStringContainsString('MINH CHỨNG', $content);

        // Canonical routes in mega menu
        $this->assertStringContainsString('/dich-vu/web-app', $content);
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $content);
        $this->assertStringContainsString('/dich-vu/bang-gia', $content);
        $this->assertStringContainsString('/dich-vu/marketing', $content);

        // Primary CTA in Mega Menu
        $this->assertStringContainsString('Bắt đầu dự án', $content);
    }

    /**
     * Test 6: Web App Flagship - Layered architecture and verified tech stack.
     */
    public function test_web_app_architecture_and_real_tech_stack(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $content = $response->getContent();

        // Layered Architecture verification
        $this->assertStringContainsString('Kiến Trúc Kỹ Thuật Hệ Thống', $content);
        $this->assertStringContainsString('User', $content);
        $this->assertStringContainsString('Frontend', $content);
        $this->assertStringContainsString('Application', $content);
        $this->assertStringContainsString('Business Logic', $content);
        $this->assertStringContainsString('Database', $content);
        $this->assertStringContainsString('Admin / Reporting', $content);

        // Real project technology stack
        $this->assertStringContainsString('Laravel', $content);
        $this->assertStringContainsString('PHP', $content);
        $this->assertStringContainsString('MySQL', $content);
        $this->assertStringContainsString('REST API', $content);
        $this->assertStringContainsString('Blade', $content);
        $this->assertStringContainsString('Alpine.js', $content);
        $this->assertStringContainsString('JavaScript', $content);
        $this->assertStringContainsString('Tailwind CSS', $content);
        $this->assertStringContainsString('RBAC', $content);

        // Disallowed fake claims in Web App page
        $this->assertStringNotContainsString('Kubernetes', $content);
        $this->assertStringNotContainsString('Microservices', $content);
        $this->assertStringNotContainsString('OWASP AA', $content);
    }

    /**
     * Test 7: Pricing Page - Differentiates reference pricing vs custom quotation.
     */
    public function test_pricing_page_structure_and_no_instant_checkout(): void
    {
        $response = $this->get('/dich-vu/bang-gia');
        $content = $response->getContent();

        $this->assertStringContainsString('Website Doanh Nghiệp', $content);
        $this->assertStringContainsString('Web Application', $content);
        $this->assertStringContainsString('Hệ Thống Phần Mềm Doanh Nghiệp Theo Yêu Cầu', $content);
        $this->assertStringContainsString('4 Yếu Tố Ảnh Hưởng Đến Chi Phí', $content);
        $this->assertStringContainsString('Quy Trình Tiếp Nhận &amp; Báo Giá', $content);

        // Must not feel like SaaS checkout
        $this->assertStringNotContainsString('Thanh toán ngay', $content);
        $this->assertStringNotContainsString('Mua ngay', $content);
    }

    /**
     * Test 8: Content Safety - No unverified superlative claims across service pages.
     */
    public function test_content_safety_no_unverified_superlatives_on_service_pages(): void
    {
        $serviceRoutes = [
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/bang-gia',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
        ];

        $forbiddenPatterns = [
            '/100%\s*chất lượng/iu',
            '/\bNhanh nhất\b/iu',
            '/\bSố 1\b/iu',
            '/\bTop 1\b/iu',
            '/\b24\/7\b/iu',
            '/99\.9%/iu',
            '/<\s*1\s*giây/iu',
            '/Tiết kiệm\s*35%/iu',
        ];

        foreach ($serviceRoutes as $route) {
            $response = $this->get($route);
            $content = $response->getContent();

            foreach ($forbiddenPatterns as $pattern) {
                $this->assertDoesNotMatchRegularExpression(
                    $pattern,
                    $content,
                    "Route {$route} must not contain unverified marketing claim matching {$pattern}"
                );
            }
        }
    }

    /**
     * Test 9: Real Proof & Case Studies Preserved - Real clients and projects are present.
     */
    public function test_real_case_studies_and_clients_are_preserved(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $content = $response->getContent();

        // Real case studies in Web App page
        $this->assertStringContainsString('Phòng Khám', $content);
        $this->assertStringContainsString('Gia Phước', $content);
        $this->assertStringContainsString('Nha Khoa Nụ Cười', $content);
    }
}
