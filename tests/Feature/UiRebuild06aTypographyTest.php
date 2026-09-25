<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * UI-REBUILD-06A Typography tests.
 * Note: Typography system was upgraded to Mulish in UI-REBUILD-07.
 */
class UiRebuild06aTypographyTest extends TestCase
{
    /**
     * Test 1: Verify Google Font preloading and stylesheet link in layout.
     * Updated for UI-REBUILD-07: Mulish is active.
     */
    public function test_google_font_loading_in_layout(): void
    {
        $layoutContent = file_get_contents(resource_path('views/layouts/app.blade.php'));

        // Mulish is active font
        $this->assertStringContainsString('family=Mulish', $layoutContent);

        // Preload attribute is used
        $this->assertStringContainsString('rel="preload" as="style"', $layoutContent);

        // Obsolete fonts removed from layout
        $this->assertStringNotContainsString('family=Space+Grotesk', $layoutContent);
        $this->assertStringNotContainsString('family=Plus+Jakarta+Sans', $layoutContent);
        $this->assertStringNotContainsString('family=JetBrains+Mono', $layoutContent);
    }

    /**
     * Test 2: Verify CSS Semantic Typography Tokens exist in app.css.
     */
    public function test_typography_tokens_exist_in_css(): void
    {
        $cssContent = file_get_contents(resource_path('css/app.css'));

        $this->assertStringContainsString("--font-primary: 'Mulish'", $cssContent);
        $this->assertStringContainsString("--font-heading: var(--font-primary)", $cssContent);
        $this->assertStringContainsString("--font-body: var(--font-primary)", $cssContent);

        // Utilities use semantic tokens
        $this->assertStringContainsString('font-family: var(--font-heading);', $cssContent);
        $this->assertStringContainsString('font-family: var(--font-body);', $cssContent);
    }

    /**
     * Test 3: Verify Tailwind config maps headline and body to primary typography.
     */
    public function test_tailwind_config_font_families(): void
    {
        $tailwindConfig = file_get_contents(base_path('tailwind.config.js'));

        $this->assertStringContainsString('Mulish', $tailwindConfig);
        $this->assertStringContainsString('"headline": ["var(--font-primary)"', $tailwindConfig);
        $this->assertStringContainsString('"body": ["var(--font-primary)"', $tailwindConfig);
    }

    /**
     * Test 4: All service/solution pages render HTTP 200 with strictly one H1.
     */
    public function test_all_service_pages_render_and_have_strictly_one_h1(): void
    {
        $routes = [
            '/' => 'Homepage',
            '/dich-vu' => 'Solution Hub',
            '/dich-vu/web-app' => 'Web App',
            '/dich-vu/kho-giao-dien' => 'Template Library',
            '/dich-vu/bang-gia' => 'Pricing',
            '/dich-vu/marketing' => 'Marketing',
            '/dich-vu/media' => 'Media',
            '/dich-vu/booking' => 'Booking',
        ];

        foreach ($routes as $route => $name) {
            $response = $this->get($route);
            $response->assertStatus(200, "Route {$route} ({$name}) must return HTTP 200");

            $content = $response->getContent();
            $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content, $matches);
            $this->assertEquals(1, $h1Count, "Page {$route} ({$name}) must have strictly one H1 heading.");

            // H1 must not use font-medium (500)
            $this->assertStringNotContainsString('font-medium', $matches[0][0], "Page {$route} H1 must not use font-medium (500).");
        }
    }

    /**
     * Test 5: Verify uppercase headings are disciplined and not shouting on service pages.
     */
    public function test_headings_do_not_use_excessive_uppercase(): void
    {
        $response = $this->get('/dich-vu');
        $content = $response->getContent();

        // Main H2 in service hub must not have uppercase class
        $this->assertDoesNotMatchRegularExpression('/<h2[^>]*class="[^"]*uppercase[^"]*"[^>]*>\s*Nhóm Giải Pháp/iu', $content);
        $this->assertDoesNotMatchRegularExpression('/<h2[^>]*class="[^"]*uppercase[^"]*"[^>]*>\s*Năng Lực Truyền Thông/iu', $content);
    }

    /**
     * Test 6: Verify Web-App page visual hierarchy.
     */
    public function test_web_app_page_visual_hierarchy(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $content = $response->getContent();

        // Eyebrow exists
        $this->assertStringContainsString('SOFTWARE ENGINEERING', $content);

        // H1 exists with clean structured lines
        $this->assertStringContainsString('Web App &amp; Hệ Thống', $content);
        $this->assertStringContainsString('Cho Quy Trình Vận Hành Doanh Nghiệp', $content);

        // Technical architecture section has Laravel, MySQL, REST API
        $this->assertStringContainsString('Laravel', $content);
        $this->assertStringContainsString('MySQL', $content);
        $this->assertStringContainsString('REST API', $content);
        $this->assertStringContainsString('RBAC', $content);
    }

    /**
     * Test 7: Verify CTA buttons use standard classes and maintain responsive integrity.
     */
    public function test_cta_buttons_typography_and_classes(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringContainsString('btn-primary-cta', $content);
        $this->assertStringContainsString('btn-secondary-cta', $content);

        // Check no overflow-x-hidden breaking classes
        $this->assertStringNotContainsString('overflow-x-scroll', $content);
    }
}
