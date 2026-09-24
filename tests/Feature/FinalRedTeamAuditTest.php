<?php

namespace Tests\Feature;

use Tests\TestCase;

class FinalRedTeamAuditTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test 1: Routing - All canonical public routes return HTTP 200 OK.
     */
    public function test_all_canonical_public_routes_return_ok(): void
    {
        $routes = [
            '/',
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
            '/du-an',
            '/du-an/ung-dung-quan-ly-phong-kham',
            '/bai-viet',
            '/lien-he',
            '/sitemap.xml',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200, "Route '{$route}' must return HTTP 200.");
        }

        // Legacy alias /kho-giao-dien must 301-redirect to canonical /dich-vu/kho-giao-dien
        $legacyRedirect = $this->get('/kho-giao-dien');
        $legacyRedirect->assertStatus(301);
        $legacyRedirect->assertRedirect('/dich-vu/kho-giao-dien');
    }

    /**
     * Test 2: Routing - Catch-all route is placed at the end of routes/web.php and non-existent slug returns 404.
     */
    public function test_catch_all_route_order_and_404_behavior(): void
    {
        $webRoutesContent = file_get_contents(base_path('routes/web.php'));
        $lastRoutePos = strrpos($webRoutesContent, "Route::get('/{slug}'");
        $this->assertNotFalse($lastRoutePos, "Catch-all route '/{slug}' must exist in routes/web.php");

        // Verify it is located within the last 300 characters of routes/web.php
        $fileLen = strlen($webRoutesContent);
        $this->assertGreaterThan($fileLen - 300, $lastRoutePos, "Catch-all route must be at the very bottom of routes/web.php");

        // Non-existent slug returns 404
        $response = $this->get('/non-existent-random-slug-xyz-12345');
        $response->assertStatus(404);
    }

    /**
     * Test 3: Navigation - Technology-First hierarchy and canonical CTAs.
     */
    public function test_header_navigation_and_cta_contracts(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Technology first branding
        $this->assertStringContainsString('Technology &bull; Digital Solutions', $content);

        // Header primary CTA
        $this->assertStringContainsString('Bắt đầu dự án', $content);
        $this->assertStringContainsString(route('contact'), $content);

        // Mobile drawer has accessible attributes
        $this->assertStringContainsString('id="mobile-nav-drawer"', $content);
        $this->assertStringContainsString('role="dialog"', $content);
        $this->assertStringContainsString('aria-modal="true"', $content);
        $this->assertStringContainsString('aria-label="Đóng menu điều hướng"', $content);
    }

    /**
     * Test 4: SEO - Canonical URL strips query parameters.
     */
    public function test_canonical_url_strips_query_parameters(): void
    {
        $response = $this->get('/?utm_source=facebook&fbclid=abcxyz123');
        $content = $response->getContent();

        $this->assertStringNotContainsString('utm_source', $content);
        $this->assertStringNotContainsString('fbclid', $content);
        $this->assertMatchesRegularExpression('/<link\s+rel=["\']canonical["\']\s+href=["\'][^?"\']+["\']>/i', $content);
    }

    /**
     * Test 5: SEO - robots.txt disallows actual admin panel and references sitemap.
     */
    public function test_robots_txt_disallows_actual_admin_path(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));
        $this->assertStringContainsString('User-agent: *', $robots);
        $this->assertStringContainsString('Allow: /', $robots);
        $this->assertStringContainsString('Disallow: /cuulongteam', $robots);
        $this->assertStringContainsString('Disallow: /admin', $robots);
        $this->assertStringContainsString('Disallow: /api/', $robots);
        $this->assertStringContainsString('Sitemap:', $robots);
        $this->assertStringContainsString('sitemap.xml', $robots);
    }

    /**
     * Test 6: SEO - Sitemap does not leak admin or preview routes.
     */
    public function test_sitemap_does_not_leak_privileged_routes(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $content = $response->getContent();

        $this->assertStringNotContainsString('/cuulongteam', $content);
        $this->assertStringNotContainsString('/admin', $content);
        $this->assertStringNotContainsString('/preview/', $content);
        $this->assertStringNotContainsString('?utm', $content);
    }

    /**
     * Test 7: Accessibility - Lang attribute, Skip link, and Single H1.
     */
    public function test_core_accessibility_criteria(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // HTML lang attribute
        $this->assertStringContainsString('<html class="scroll-smooth" lang="vi">', $content);

        // Skip link
        $this->assertStringContainsString('href="#main-content"', $content);
        $this->assertStringContainsString('Chuyển đến nội dung chính', $content);
        $this->assertStringContainsString('id="main-content"', $content);

        // Exactly 1 H1
        preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $content, $h1Matches);
        $this->assertCount(1, $h1Matches[0]);
    }

    /**
     * Test 8: Accessibility - Form labels, aria-required, and aria-invalid.
     */
    public function test_contact_form_accessibility(): void
    {
        $response = $this->get('/lien-he');
        $content = $response->getContent();

        $this->assertStringContainsString('for="fullname"', $content);
        $this->assertStringContainsString('id="fullname"', $content);
        $this->assertStringContainsString('for="phone"', $content);
        $this->assertStringContainsString('id="phone"', $content);
        $this->assertStringContainsString('aria-required="true"', $content);
        $this->assertStringContainsString('aria-invalid="false"', $content);
    }

    /**
     * Test 9: Claim Safety - Zero unverified metrics across views.
     */
    public function test_claim_safety_zero_unverified_metrics(): void
    {
        $response = $this->get('/');
        $homepageContent = $response->getContent();

        // 900+ and 320+ must not appear on homepage
        $this->assertStringNotContainsString('900+', $homepageContent);
        $this->assertStringNotContainsString('320+', $homepageContent);
        $this->assertStringNotContainsString('10+ Năm', $homepageContent);

        // Unverified performance scores
        $this->assertStringNotContainsString('Lighthouse 90+', $homepageContent);
        $this->assertStringNotContainsString('Lighthouse Performance 95', $homepageContent);

        // Web App service page
        $webAppResponse = $this->get('/dich-vu/web-app');
        $webAppContent = $webAppResponse->getContent();
        $this->assertStringNotContainsString('Google Lighthouse Performance 95 - 100', $webAppContent);
        $this->assertStringNotContainsString('bảo trì 24/7', $webAppContent);

        // About page
        $aboutResponse = $this->get('/ve-chung-toi');
        $aboutContent = $aboutResponse->getContent();
        $this->assertStringNotContainsString('900+', $aboutContent);
        $this->assertStringNotContainsString('10+ Năm', $aboutContent);
    }

    /**
     * Test 10: HTML Sanity - Zero dead href="#" links in rendered public views.
     */
    public function test_no_dead_href_hash_in_rendered_views(): void
    {
        $routes = ['/', '/lien-he', '/dich-vu', '/du-an', '/bai-viet'];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $content = $response->getContent();
            $this->assertStringNotContainsString('href="#"', $content, "Route '{$route}' must not contain dead href='#' links.");
        }
    }

    /**
     * Test 11: Security Boundary - Signed URL required for post preview.
     */
    public function test_preview_route_requires_valid_signature(): void
    {
        $post = \App\Models\Post::first();
        if ($post) {
            $unsignedResponse = $this->get("/preview/post/{$post->id}");
            $unsignedResponse->assertStatus(403);
        } else {
            $this->assertTrue(true);
        }
    }
}
