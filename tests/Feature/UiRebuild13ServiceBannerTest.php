<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiRebuild13ServiceBannerTest extends TestCase
{
    /**
     * Test 1: All three service & solution pages return HTTP 200.
     */
    public function test_all_three_service_pages_return_http_200(): void
    {
        $routes = [
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    /**
     * Test 2: Each target page has strictly one H1 matching semantic architecture requirements.
     */
    public function test_strictly_single_h1_per_page_with_accurate_copy(): void
    {
        $pages = [
            '/dich-vu' => [
                'expectedTitle' => 'Giải Quyết Bài Toán Vận Hành',
                'expectedAccent' => 'Bằng Công Nghệ Phù Hợp',
            ],
            '/dich-vu/web-app' => [
                'expectedTitle' => 'Web App & Hệ Thống',
                'expectedAccent' => 'Cho Quy Trình Vận Hành Doanh Nghiệp',
            ],
            '/dich-vu/kho-giao-dien' => [
                'expectedTitle' => 'Thư Viện Nền Tảng',
                'expectedAccent' => 'Triển Khai Website Nhanh',
            ],
        ];

        foreach ($pages as $route => $criteria) {
            $response = $this->get($route);
            $content = $response->getContent();

            $h1Count = preg_match_all('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $content, $matches);
            $this->assertEquals(1, $h1Count, "Route {$route} must contain strictly 1 H1 heading tag. Found: {$h1Count}");

            $rawH1 = html_entity_decode(strip_tags($matches[1][0]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $h1Text = preg_replace('/\s+/u', ' ', trim($rawH1));

            $this->assertStringContainsString($criteria['expectedTitle'], $h1Text, "Route {$route} H1 must contain '{$criteria['expectedTitle']}'");
            $this->assertStringContainsString($criteria['expectedAccent'], $h1Text, "Route {$route} H1 must contain '{$criteria['expectedAccent']}'");
        }
    }

    /**
     * Test 3: Breadcrumb is rendered on all three pages.
     */
    public function test_breadcrumb_rendered_on_all_three_pages(): void
    {
        $pages = [
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
        ];

        foreach ($pages as $route) {
            $response = $this->get($route);
            $content = $response->getContent();

            $this->assertStringContainsString('aria-label="Breadcrumb"', $content, "Route {$route} must include breadcrumb navigation.");
            $this->assertStringContainsString('Dịch vụ &amp; Giải pháp', $content);
        }
    }

    /**
     * Test 4: Target CTAs have valid destinations.
     */
    public function test_hero_ctas_have_valid_destinations(): void
    {
        // 1. /dich-vu
        $respDichVu = $this->get('/dich-vu');
        $respDichVu->assertSee(route('contact'));
        $respDichVu->assertSee(route('projects.index'));

        // 2. /dich-vu/web-app
        $respWebApp = $this->get('/dich-vu/web-app');
        $respWebApp->assertSee(route('contact'));
        $respWebApp->assertSee('#architecture');

        // 3. /dich-vu/kho-giao-dien
        $respTemplates = $this->get('/dich-vu/kho-giao-dien');
        $respTemplates->assertSee('#catalog');
        $respTemplates->assertSee(route('contact'));
    }

    /**
     * Test 5: Web App hero uses real verified asset modern_tech_platform.jpg with LCP optimization.
     */
    public function test_web_app_hero_uses_real_asset_with_lcp(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $content = $response->getContent();

        $this->assertStringContainsString('modern_tech_platform.jpg', $content);
        $this->assertStringContainsString('fetchpriority="high"', $content);
        $this->assertStringContainsString('loading="eager"', $content);
        $this->assertStringContainsString('aspect-[16/10]', $content);
    }

    /**
     * Test 6: Templates Showcase hero embeds search form into slot.
     */
    public function test_template_showcase_hero_embeds_search_form(): void
    {
        $response = $this->get('/dich-vu/kho-giao-dien');
        $content = $response->getContent();

        $this->assertStringContainsString('<form action="' . route('templates.index') . '" method="GET"', $content);
        $this->assertStringContainsString('name="q"', $content);
        $this->assertStringContainsString('placeholder="Tìm theo tên ngành hoặc use-case..."', $content);
        $this->assertStringContainsString('id="catalog"', $content);
    }

    /**
     * Test 7: All three pages have bottom conversion CTA banner with phone and contact link.
     */
    public function test_bottom_cta_banner_rendered_on_all_three_pages(): void
    {
        $pages = [
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
        ];

        foreach ($pages as $route) {
            $response = $this->get($route);
            $content = $response->getContent();

            // Bottom CTA component presence
            $this->assertStringContainsString('tel:0939363262', $content, "Route {$route} must contain telephone CTA.");
            $this->assertStringContainsString(route('contact'), $content, "Route {$route} must contain contact CTA.");
        }
    }

    /**
     * Test 8: Content safety — no unverified superlatives or fake guarantees.
     */
    public function test_content_safety_no_prohibited_claims(): void
    {
        $prohibitedTerms = [
            'cam kết hoàn thành trong',
            'bảo mật tuyệt đối 100%',
            'tỷ lệ thành công 100%',
            'rẻ nhất thị trường',
            'hoàn hảo nhất',
            'số 1 việt nam',
        ];

        $pages = [
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
        ];

        foreach ($pages as $route) {
            $response = $this->get($route);
            $content = mb_strtolower($response->getContent(), 'UTF-8');

            foreach ($prohibitedTerms as $term) {
                $this->assertStringNotContainsString(
                    $term,
                    $content,
                    "Route {$route} must not contain unverified claim: '{$term}'"
                );
            }
        }
    }
}
