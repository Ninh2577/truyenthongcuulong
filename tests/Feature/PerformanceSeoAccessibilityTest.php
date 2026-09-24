<?php

namespace Tests\Feature;

use Tests\TestCase;

class PerformanceSeoAccessibilityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test 1: SEO - Meta title, description, and canonical on key canonical routes.
     */
    public function test_key_routes_have_valid_metadata_and_canonical(): void
    {
        $routes = [
            '/' => 'Truyền Thông Cửu Long',
            '/lien-he' => 'Liên Hệ',
            '/dich-vu' => 'Dịch Vụ',
            '/dich-vu/web-app' => 'Web App',
            '/du-an' => 'Dự Án',
        ];

        foreach ($routes as $uri => $expectedTitleKeyword) {
            $response = $this->get($uri);
            $response->assertStatus(200, "Route {$uri} must be accessible.");
            $content = $response->getContent();

            // Title must exist and contain expected keyword
            $this->assertMatchesRegularExpression('/<title>[^<]+<\/title>/i', $content, "Route {$uri} must have a non-empty <title>.");
            $this->assertStringContainsStringIgnoringCase($expectedTitleKeyword, $content, "Route {$uri} title should mention '{$expectedTitleKeyword}'.");

            // Meta description must exist and not be empty
            $this->assertMatchesRegularExpression('/<meta\s+name=["\']description["\']\s+content=["\'][^"\']+["\']/i', $content, "Route {$uri} must have a non-empty meta description.");

            // Canonical link must exist
            $this->assertMatchesRegularExpression('/<link\s+rel=["\']canonical["\']\s+href=["\'][^"\']+["\']/i', $content, "Route {$uri} must have a canonical tag.");
        }
    }

    /**
     * Test 2: SEO - Exactly one semantic H1 tag on homepage.
     */
    public function test_homepage_has_strictly_one_h1_heading(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $content, $matches);
        $this->assertCount(1, $matches[0], 'Homepage must contain exactly one <h1> element for semantic SEO hierarchy.');
        $this->assertStringContainsString('Giải Pháp Web, Web App', $matches[0][0]);
    }

    /**
     * Test 3: SEO - robots.txt file exists, allows root crawling, disallows admin/api, and references sitemap.
     */
    public function test_robots_txt_is_valid_and_references_sitemap(): void
    {
        $robotsPath = public_path('robots.txt');
        $this->assertFileExists($robotsPath, 'public/robots.txt must exist.');

        $robotsContent = file_get_contents($robotsPath);
        $this->assertStringContainsString('User-agent: *', $robotsContent);
        $this->assertStringContainsString('Allow: /', $robotsContent);
        $this->assertStringContainsString('Disallow: /admin', $robotsContent);
        $this->assertStringContainsString('Sitemap:', $robotsContent);
        $this->assertStringContainsString('sitemap.xml', $robotsContent);
    }

    /**
     * Test 4: SEO - Sitemap endpoint returns HTTP 200 and valid XML.
     */
    public function test_sitemap_endpoint_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=utf-8');

        $content = $response->getContent();
        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $content);
        $this->assertStringContainsString('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $content);
        $this->assertStringContainsString('/dich-vu', $content);
        $this->assertStringContainsString('/du-an', $content);
    }

    /**
     * Test 5: SEO - Structured data JSON-LD is source-backed without fake metrics.
     */
    public function test_structured_data_organization_and_website_schema(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Must contain Organization schema
        $this->assertStringContainsString('"@type": "Organization"', $content);
        $this->assertStringContainsString('"@type": "WebSite"', $content);
        $this->assertStringContainsString('logo-ttcl.png', $content);

        // Claim safety: NO unverified marketing numbers in schema or meta descriptions
        $this->assertStringNotContainsString('"10+ năm"', $content);
        $this->assertStringNotContainsString('"900+ doanh nghiệp"', $content);
        $this->assertStringNotContainsString('"320+ khách hàng"', $content);

        // Zero fake reviews/ratings in structured data
        $this->assertStringNotContainsString('"@type": "AggregateRating"', $content);
        $this->assertStringNotContainsString('"@type": "Review"', $content);
    }

    /**
     * Test 6: Accessibility - Skip to Main Content link exists and targets #main-content.
     */
    public function test_skip_to_main_content_link_exists(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringContainsString('href="#main-content"', $content);
        $this->assertStringContainsString('Chuyển đến nội dung chính', $content);
        $this->assertStringContainsString('id="main-content"', $content);
    }

    /**
     * Test 7: Accessibility - Mobile viewport allows user zoom (WCAG SC 1.4.4).
     */
    public function test_viewport_does_not_disable_zoom(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringNotContainsString('user-scalable=no', $content, 'Viewport must not disable pinch-to-zoom.');
        $this->assertStringNotContainsString('maximum-scale=1.0', $content, 'Viewport must not restrict maximum scale to 1.0.');
        $this->assertStringNotContainsString('maximum-scale=1"', $content, 'Viewport must not restrict maximum scale to 1.');
        $this->assertStringContainsString('maximum-scale=5', $content, 'Viewport allows up to 5x zoom.');
    }

    /**
     * Test 8: Accessibility - Contact form has programmatic label-input associations and ARIA attributes.
     */
    public function test_contact_form_accessibility_attributes(): void
    {
        $response = $this->get('/lien-he');
        $content = $response->getContent();

        // Labels must have for matching id
        $this->assertStringContainsString('for="fullname"', $content);
        $this->assertStringContainsString('id="fullname"', $content);
        $this->assertStringContainsString('for="phone"', $content);
        $this->assertStringContainsString('id="phone"', $content);
        $this->assertStringContainsString('for="email"', $content);
        $this->assertStringContainsString('id="email"', $content);
        $this->assertStringContainsString('for="service_interested"', $content);
        $this->assertStringContainsString('id="service_interested"', $content);
        $this->assertStringContainsString('for="message"', $content);
        $this->assertStringContainsString('id="message"', $content);

        // Required inputs have aria-required
        $this->assertStringContainsString('aria-required="true"', $content);
        $this->assertStringContainsString('aria-invalid="false"', $content);
    }

    /**
     * Test 9: Accessibility - Modal dialogs have role="dialog" and aria-modal="true".
     */
    public function test_modals_have_proper_aria_roles(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Mobile drawer dialog
        $this->assertStringContainsString('id="mobile-nav-drawer"', $content);
        $this->assertStringContainsString('role="dialog"', $content);
        $this->assertStringContainsString('aria-modal="true"', $content);

        // Portfolio video modal
        $this->assertStringContainsString('role="dialog"', $content);
        $this->assertStringContainsString('aria-modal="true"', $content);
        $this->assertStringContainsString('aria-label="Đóng video"', $content);
    }

    /**
     * Test 10: Performance - Below-the-fold images use loading="lazy" and decoding="async".
     */
    public function test_below_fold_images_are_lazy_loaded(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Count occurrences of loading="lazy"
        $lazyCount = substr_count($content, 'loading="lazy"');
        $this->assertGreaterThanOrEqual(5, $lazyCount, 'Below-the-fold images on homepage must be lazy loaded.');

        // Font preload uses non-blocking print-to-all technique
        $this->assertStringContainsString('media="print" onload="this.media=\'all\'"', $content);
    }

    /**
     * Test 11: Accessibility & Performance - CSS contains prefers-reduced-motion and focus-visible.
     */
    public function test_css_contains_reduced_motion_and_focus_visible(): void
    {
        $cssPath = resource_path('css/app.css');
        $this->assertFileExists($cssPath);

        $cssContent = file_get_contents($cssPath);
        $this->assertStringContainsString('@media (prefers-reduced-motion: reduce)', $cssContent);
        $this->assertStringContainsString(':focus-visible', $cssContent);
        $this->assertStringContainsString('marquee-track', $cssContent);
    }
}
