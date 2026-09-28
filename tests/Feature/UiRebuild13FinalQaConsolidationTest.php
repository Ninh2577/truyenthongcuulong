<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiRebuild13FinalQaConsolidationTest extends TestCase
{
    /**
     * All 7 target pages under audit scope.
     */
    protected array $targetPages = [
        'homepage' => '/',
        'services_index' => '/dich-vu',
        'web_app' => '/dich-vu/web-app',
        'templates' => '/dich-vu/kho-giao-dien',
        'marketing' => '/dich-vu/marketing',
        'media' => '/dich-vu/media',
        'booking' => '/dich-vu/booking',
    ];

    /**
     * Test 1: All 7 target pages return HTTP 200.
     */
    public function test_all_seven_target_pages_return_http_200(): void
    {
        foreach ($this->targetPages as $name => $route) {
            $response = $this->get($route);
            $response->assertStatus(200, "Route {$route} ({$name}) must return status 200.");
        }
    }

    /**
     * Test 2: Strictly single H1 heading tag per page across all 7 target pages.
     */
    public function test_strictly_single_h1_per_page(): void
    {
        $expectedH1Keywords = [
            '/' => ['Phát triển phần mềm', 'vận hành doanh nghiệp'],
            '/dich-vu' => ['Giải Quyết Bài Toán Vận Hành', 'Bằng Công Nghệ Phù Hợp'],
            '/dich-vu/web-app' => ['Web App & Hệ Thống', 'Quy Trình Vận Hành Doanh Nghiệp'],
            '/dich-vu/kho-giao-dien' => ['Thư Viện Nền Tảng', 'Triển Khai Website Nhanh'],
            '/dich-vu/marketing' => ['Chiến Lược Tối Ưu SEO', 'Dữ Liệu Thực Tế'],
            '/dich-vu/media' => ['Sản Xuất Tư Liệu Video', 'Hình Ảnh Doanh Nghiệp'],
            '/dich-vu/booking' => ['Điều Phối Ekip Media', 'Theo Nhu Cầu Doanh Nghiệp'],
        ];

        foreach ($expectedH1Keywords as $route => $keywords) {
            $response = $this->get($route);
            $html = $response->getContent();

            $h1Count = preg_match_all('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $html, $matches);
            $this->assertEquals(1, $h1Count, "Route {$route} must contain strictly 1 H1 heading tag. Found: {$h1Count}");

            $rawH1 = html_entity_decode(strip_tags($matches[1][0]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $h1Text = preg_replace('/\s+/u', ' ', trim($rawH1));

            foreach ($keywords as $kw) {
                $this->assertStringContainsString(
                    $kw,
                    $h1Text,
                    "Route {$route} H1 must contain keyword '{$kw}'. Actual: '{$h1Text}'"
                );
            }
        }
    }

    /**
     * Test 3: Breadcrumb navigation is present and valid on all 6 service pages.
     */
    public function test_breadcrumb_navigation_on_all_service_pages(): void
    {
        $servicePages = [
            '/dich-vu' => 'Dịch vụ &amp; Giải pháp',
            '/dich-vu/web-app' => 'Web App &amp; Hệ Thống',
            '/dich-vu/kho-giao-dien' => 'Thư viện nền tảng website',
            '/dich-vu/marketing' => 'Tối ưu SEO &amp; Tăng trưởng số',
            '/dich-vu/media' => 'Tư liệu Media &amp; Video',
            '/dich-vu/booking' => 'Điều phối ekip Media',
        ];

        foreach ($servicePages as $route => $expectedLabel) {
            $response = $this->get($route);
            $html = $response->getContent();

            $this->assertStringContainsString('aria-label="Breadcrumb"', $html, "Route {$route} must have accessible breadcrumb.");
            $this->assertStringContainsString($expectedLabel, $html, "Route {$route} breadcrumb must contain label '{$expectedLabel}'.");
        }
    }

    /**
     * Test 4: All in-page anchor links point to target element IDs that actually exist in the HTML.
     */
    public function test_all_in_page_anchors_exist(): void
    {
        $anchorChecks = [
            '/dich-vu/web-app' => 'architecture',
            '/dich-vu/kho-giao-dien' => 'catalog',
            '/dich-vu/marketing' => 'growth-path',
            '/dich-vu/booking' => 'booking-form',
        ];

        foreach ($anchorChecks as $route => $targetId) {
            $response = $this->get($route);
            $html = $response->getContent();

            // Link exists in CTA
            $this->assertStringContainsString("#{$targetId}", $html, "Route {$route} must contain CTA pointing to #{$targetId}.");

            // Target element with id exists
            $this->assertMatchesRegularExpression(
                '/<[^>]+id=[\'"]' . preg_quote($targetId, '/') . '[\'"][^>]*>/i',
                $html,
                "Route {$route} must contain target element with id='{$targetId}'."
            );
        }
    }

    /**
     * Test 5: Hero banner physical assets exist on disk and LCP optimization is applied.
     */
    public function test_hero_banner_physical_assets_and_lcp_optimization(): void
    {
        $requiredAssets = [
            'public/images/modern_tech_platform.jpg',
            'public/images/real-cameraman-production.jpg',
            'public/images/showreel-cinematic-poster.webp',
            'public/images/showreel-cinematic-poster.jpg',
        ];

        foreach ($requiredAssets as $relPath) {
            $fullPath = base_path($relPath);
            $this->assertFileExists($fullPath, "Physical image asset must exist at {$relPath}.");
            $this->assertGreaterThan(1000, filesize($fullPath), "Asset {$relPath} must not be empty.");
        }

        // Web App Hero LCP
        $webAppHtml = $this->get('/dich-vu/web-app')->getContent();
        $this->assertStringContainsString('modern_tech_platform.jpg', $webAppHtml);
        $this->assertStringContainsString('fetchpriority="high"', $webAppHtml);
        $this->assertStringContainsString('loading="eager"', $webAppHtml);
        $this->assertStringContainsString('aspect-[16/10]', $webAppHtml);

        // Booking Hero LCP
        $bookingHtml = $this->get('/dich-vu/booking')->getContent();
        $this->assertStringContainsString('real-cameraman-production.jpg', $bookingHtml);
        $this->assertStringContainsString('fetchpriority="high"', $bookingHtml);
        $this->assertStringContainsString('loading="eager"', $bookingHtml);
        $this->assertStringContainsString('aspect-[16/10]', $bookingHtml);
    }

    /**
     * Test 6: Bottom conversion CTA banners are present on all 6 service pages.
     */
    public function test_bottom_conversion_cta_banners(): void
    {
        $servicePages = [
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
        ];

        foreach ($servicePages as $route) {
            $response = $this->get($route);
            $html = $response->getContent();

            // All service pages have valid conversion links in CTA banner
            $this->assertStringContainsString(route('contact'), $html, "Route {$route} must contain contact CTA link.");
        }
    }

    /**
     * Test 7: No unescaped Blade tags or syntax leak in rendered output.
     */
    public function test_no_raw_blade_syntax_leakage(): void
    {
        $rawBladeTokens = ['{{ $', '@props', '@extends', '@section', '@endsection', '@if', '@endif'];

        foreach ($this->targetPages as $name => $route) {
            $response = $this->get($route);
            $html = $response->getContent();

            foreach ($rawBladeTokens as $token) {
                $this->assertStringNotContainsString(
                    $token,
                    $html,
                    "Route {$route} ({$name}) has leaked uncompiled Blade syntax: '{$token}'."
                );
            }
        }
    }

    /**
     * Test 8: Content safety — strictly no unverified superlatives or fake claims.
     */
    public function test_content_safety_zero_prohibited_marketing_claims(): void
    {
        $prohibitedClaims = [
            'cam kết lên top 1 trong',
            'bảo mật tuyệt đối 100%',
            'tỷ lệ thành công 100%',
            'rẻ nhất thị trường',
            'hoàn hảo nhất',
            'số 1 việt nam',
            'số 1 miền tây',
        ];

        foreach ($this->targetPages as $name => $route) {
            $response = $this->get($route);
            $content = mb_strtolower($response->getContent(), 'UTF-8');

            foreach ($prohibitedClaims as $claim) {
                $this->assertStringNotContainsString(
                    $claim,
                    $content,
                    "Route {$route} ({$name}) contains unverified claim: '{$claim}'."
                );
            }
        }
    }

    /**
     * Test 9: Booking form business functionality integrity.
     */
    public function test_booking_form_business_integrity(): void
    {
        $response = $this->get('/dich-vu/booking');
        $html = $response->getContent();

        $this->assertStringContainsString('action="' . route('contact.submit') . '"', $html);
        $this->assertStringContainsString('name="service_interested"', $html);
        $this->assertStringContainsString('name="fullname"', $html);
        $this->assertStringContainsString('name="phone"', $html);
        $this->assertStringContainsString('name="crew_choice"', $html);
    }

    /**
     * Test 10: Template library search form inside hero slot functionality.
     */
    public function test_template_library_hero_slot_search_integrity(): void
    {
        $response = $this->get('/dich-vu/kho-giao-dien');
        $html = $response->getContent();

        $this->assertStringContainsString('action="' . route('templates.index') . '"', $html);
        $this->assertStringContainsString('name="q"', $html);
        $this->assertStringContainsString('placeholder="Tìm theo tên ngành hoặc use-case..."', $html);
    }
}
