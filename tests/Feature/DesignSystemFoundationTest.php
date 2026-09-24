<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Blade;

class DesignSystemFoundationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test 1: Global layout renders cleanly on homepage.
     */
    public function test_global_layout_renders_with_b2b_foundation(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('<html class="scroll-smooth" lang="vi">', $html);
        $this->assertStringContainsString('id="main-content"', $html);
        $this->assertStringContainsString('Chuyển đến nội dung chính', $html);
        $this->assertStringContainsString('TRUYỀN THÔNG CỬU LONG', $html);
    }

    /**
     * Test 2: Footer visual foundation is clean B2B, personal ecosystem links are absent.
     */
    public function test_footer_is_clean_b2b_and_personal_links_are_removed(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Footer landmark
        $this->assertStringContainsString('<footer', $html);
        $this->assertStringContainsString('CLM Digital Solutions', $html);

        // Verify total ABSENCE of personal/camping lifestyle links
        $this->assertStringNotContainsString('cuulongcamping.vn', $html, 'Footer must not contain Cuu Long Camping link.');
        $this->assertStringNotContainsString('Cuu Long Camping', $html);
        $this->assertStringNotContainsString('tuilanguoimientay.vn', $html, 'Footer must not contain Tui La Nguoi Mien Tay link.');
        $this->assertStringNotContainsString('Tui Là Người Miền Tây', $html);
        $this->assertStringNotContainsString('tieudaotu.com', $html, 'Footer must not contain Tieu Dao Tu link.');
        $this->assertStringNotContainsString('Tiêu Dao Tử', $html);
        $this->assertStringNotContainsString('Cùng Chơi', $html, 'Footer must not contain Cung Choi link.');

        // Verify Technology-First ordering in Footer services
        $webAppPos = strpos($html, 'Thiết kế &amp; Lập trình Web-App');
        if ($webAppPos === false) {
            $webAppPos = strpos($html, 'Thiết kế & Lập trình Web-App');
        }
        $mediaPos = strpos($html, 'Sản Xuất Media &amp; Phim Doanh Nghiệp');
        if ($mediaPos === false) {
            $mediaPos = strpos($html, 'Sản Xuất Media & Phim Doanh Nghiệp');
        }

        $this->assertNotFalse($webAppPos, 'Web-App service must be listed in footer.');
        $this->assertNotFalse($mediaPos, 'Media service must be listed in footer.');
        $this->assertLessThan($mediaPos, $webAppPos, 'Web-App must precede Media in Footer services list.');
    }

    /**
     * Test 3: Core UI Primitives - Container renders with correct container widths.
     */
    public function test_ui_container_primitive(): void
    {
        $rendered = Blade::render('<x-ui.container>Content</x-ui.container>');
        $this->assertStringContainsString('max-w-7xl', $rendered);
        $this->assertStringContainsString('mx-auto', $rendered);
        $this->assertStringContainsString('Content', $rendered);

        $renderedNarrow = Blade::render('<x-ui.container size="narrow">Narrow Content</x-ui.container>');
        $this->assertStringContainsString('max-w-5xl', $renderedNarrow);
    }

    /**
     * Test 4: Core UI Primitives - Button polymorphic rendering and states.
     */
    public function test_ui_button_primitive(): void
    {
        // Button element
        $renderedBtn = Blade::render('<x-ui.button variant="primary" type="submit">Submit Form</x-ui.button>');
        $this->assertStringContainsString('<button type="submit"', $renderedBtn);
        $this->assertStringContainsString('bg-navy-base', $renderedBtn);
        $this->assertStringContainsString('Submit Form', $renderedBtn);

        // Link element
        $renderedLink = Blade::render('<x-ui.button variant="secondary" href="/lien-he">Contact Us</x-ui.button>');
        $this->assertStringContainsString('<a href="/lien-he"', $renderedLink);
        $this->assertStringContainsString('border-slate-200', $renderedLink);
        $this->assertStringContainsString('Contact Us', $renderedLink);
    }

    /**
     * Test 5: Core UI Primitives - Badge variants and dot indicators.
     */
    public function test_ui_badge_primitive(): void
    {
        $renderedTech = Blade::render('<x-ui.badge variant="tech" :dot="true">Web App</x-ui.badge>');
        $this->assertStringContainsString('bg-sky-50', $renderedTech);
        $this->assertStringContainsString('bg-sky-500', $renderedTech);
        $this->assertStringContainsString('Web App', $renderedTech);

        $renderedMedia = Blade::render('<x-ui.badge variant="media">Video 4K</x-ui.badge>');
        $this->assertStringContainsString('bg-amber-50', $renderedMedia);
        $this->assertStringContainsString('Video 4K', $renderedMedia);
    }

    /**
     * Test 6: Core UI Primitives - Card variants and radius.
     */
    public function test_ui_card_primitive(): void
    {
        $renderedCard = Blade::render('<x-ui.card variant="interactive" radius="2xl">Card Body</x-ui.card>');
        $this->assertStringContainsString('rounded-2xl', $renderedCard);
        $this->assertStringContainsString('hover:-translate-y-1', $renderedCard);
        $this->assertStringContainsString('Card Body', $renderedCard);
    }

    /**
     * Test 7: Core UI Primitives - Section Heading hierarchy.
     */
    public function test_ui_section_heading_primitive(): void
    {
        $rendered = Blade::render('<x-ui.section-heading eyebrow="CORE TECH" title="Enterprise Solutions" description="Comprehensive digital systems." />');
        $this->assertStringContainsString('CORE TECH', $rendered);
        $this->assertStringContainsString('<h2', $rendered);
        $this->assertStringContainsString('Enterprise Solutions', $rendered);
        $this->assertStringContainsString('Comprehensive digital systems.', $rendered);
    }

    /**
     * Test 8: Core UI Primitives - Input form field accessibility and iOS zoom protection.
     */
    public function test_ui_input_primitive(): void
    {
        $rendered = Blade::render('<x-ui.input name="fullname" label="Họ và tên" :required="true" placeholder="Nguyễn Văn A" />');
        $this->assertStringContainsString('for="fullname"', $rendered);
        $this->assertStringContainsString('Họ và tên', $rendered);
        $this->assertStringContainsString('id="fullname"', $rendered);
        $this->assertStringContainsString('required', $rendered);
        $this->assertStringContainsString('text-base sm:text-sm', $rendered, 'Input must have text-base on mobile to prevent iOS auto-zoom.');
    }

    /**
     * Test 9: CSS Design Tokens and Accessibility rules are present in app.css.
     */
    public function test_app_css_contains_design_tokens_and_accessibility(): void
    {
        $cssContent = file_get_contents(resource_path('css/app.css'));

        // CSS Variables
        $this->assertStringContainsString('--color-primary', $cssContent);
        $this->assertStringContainsString('--color-bg', $cssContent);
        $this->assertStringContainsString('--color-surface', $cssContent);
        $this->assertStringContainsString('--color-border-default', $cssContent);
        $this->assertStringContainsString('--color-tech-sky', $cssContent);

        // Accessibility rules
        $this->assertStringContainsString('@media (prefers-reduced-motion: reduce)', $cssContent);
        $this->assertStringContainsString(':focus-visible', $cssContent);
    }

    /**
     * Test 10: Custom cursor gimmick has been removed from home.blade.php.
     */
    public function test_custom_cursor_gimmick_is_removed(): void
    {
        $homeContent = file_get_contents(resource_path('views/home.blade.php'));
        $this->assertStringNotContainsString('id="case-study-cursor"', $homeContent, 'Gimmick #case-study-cursor must not exist in home.blade.php.');
    }

    /**
     * Test 11: Legacy debug route /dev-analyze-xml returns 404.
     */
    public function test_legacy_debug_route_is_removed(): void
    {
        $response = $this->get('/dev-analyze-xml');
        $this->assertEquals(404, $response->getStatusCode(), 'Route /dev-analyze-xml must return 404.');
    }

    /**
     * Test 12: All primary canonical routes render HTTP 200 without regression.
     */
    public function test_all_canonical_routes_return_ok(): void
    {
        $canonicalRoutes = [
            '/',
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
            '/du-an',
            '/lien-he',
        ];

        foreach ($canonicalRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200, "Route {$route} must return HTTP 200.");
        }
    }
}
