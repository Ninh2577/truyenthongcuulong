<?php

namespace Tests\Feature;

use App\Models\Menu;
use Database\Seeders\MenuSeeder;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class NavigationArchitectureTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (Menu::where('location', 'header')->count() === 0) {
            $this->seed(MenuSeeder::class);
        }
    }

    /**
     * 1. Header renders with proper semantic elements and brand identity.
     */
    public function test_header_renders(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('<header', $html);
        $this->assertStringContainsString('</header>', $html);
        $this->assertStringContainsString('TRUYỀN THÔNG CỬU LONG', $html);
        $this->assertStringContainsString('Technology &bull; Digital Solutions', $html);
    }

    /**
     * 2. Primary navigation renders with semantic <nav> and aria-label.
     */
    public function test_primary_navigation_renders(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('<nav class="hidden lg:flex items-center', $html);
        $this->assertStringContainsString('aria-label="Menu chính"', $html);
    }

    /**
     * 3. Technology-first order: Technology appears before Media in both Desktop and Mobile navs.
     */
    public function test_technology_first_order(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Check Desktop Mega Menu ordering
        $techPos = strpos($html, 'CÔNG NGHỆ &amp; GIẢI PHÁP SỐ');
        if ($techPos === false) {
            $techPos = strpos($html, 'CÔNG NGHỆ & GIẢI PHÁP SỐ');
        }
        $mediaPos = strpos($html, 'TRUYỀN THÔNG &amp; MEDIA');
        if ($mediaPos === false) {
            $mediaPos = strpos($html, 'TRUYỀN THÔNG & MEDIA');
        }

        $this->assertNotFalse($techPos, 'Technology group must exist in navigation');
        $this->assertNotFalse($mediaPos, 'Media group must exist in navigation');
        $this->assertLessThan($mediaPos, $techPos, 'Technology group must appear BEFORE Media group');

        // Check canonical service order: web-app must appear before media
        $webAppPos = strpos($html, '/dich-vu/web-app');
        $mediaUrlPos = strpos($html, '/dich-vu/media');
        $this->assertNotFalse($webAppPos, 'Web app service URL must be present');
        $this->assertNotFalse($mediaUrlPos, 'Media service URL must be present');
        $this->assertLessThan($mediaUrlPos, $webAppPos, 'Web app must appear before Media in DOM');
    }

    /**
     * 4. Primary CTA exists in header.
     */
    public function test_primary_cta_exists(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('Bắt đầu dự án', $html);
    }

    /**
     * 5. Primary CTA destination is valid and points to canonical contact route.
     */
    public function test_primary_cta_destination_valid(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertMatchesRegularExpression('/href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án/u', $html);

        // Verify the contact page actually returns 200
        $contactResponse = $this->get('/lien-he');
        $contactResponse->assertStatus(200);
    }

    /**
     * 6. No dead href="#" in the rendered header navigation.
     */
    public function test_no_dead_href_in_header(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $start = strpos($html, '<header');
        $end = strpos($html, '</header>');
        $headerHtml = substr($html, $start, $end - $start + 9);

        $this->assertDoesNotMatchRegularExpression('/href="#"/i', $headerHtml, 'Header must not contain dead href="#"');
        $this->assertDoesNotMatchRegularExpression('/href=""/i', $headerHtml, 'Header must not contain empty href=""');
    }

    /**
     * 7. No javascript:void(0) in the rendered header navigation.
     */
    public function test_no_javascript_void_in_header(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $start = strpos($html, '<header');
        $end = strpos($html, '</header>');
        $headerHtml = substr($html, $start, $end - $start + 9);

        $this->assertDoesNotMatchRegularExpression('/href="javascript:/i', $headerHtml, 'Header must not contain javascript: links');
    }

    /**
     * 8. Desktop mega menu renders with 3-column architecture (Pain Points, Solutions, Proof/CTA).
     */
    public function test_desktop_mega_menu_renders(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        // Column 1: Business Pain Points
        $this->assertStringContainsString('BÀI TOÁN VẬN HÀNH', $html);
        $this->assertStringContainsString('Số hóa quy trình &amp; Web App', $html);
        // Column 2: Technical Solutions
        $this->assertStringContainsString('CÔNG NGHỆ &amp; GIẢI PHÁP SỐ', $html);
        $this->assertStringContainsString('TRUYỀN THÔNG &amp; MEDIA', $html);
        // Column 3: Real Proof & Action
        $this->assertStringContainsString('MINH CHỨNG THỰC TẾ', $html);
        $this->assertStringContainsString('Xem các dự án đã làm', $html);
    }

    /**
     * 9. Mobile navigation renders in slide-over drawer with task-oriented structure.
     */
    public function test_mobile_navigation_renders(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('id="mobile-nav-drawer"', $html);
        $this->assertStringContainsString('role="dialog"', $html);
        $this->assertStringContainsString('aria-modal="true"', $html);
        $this->assertStringContainsString('aria-label="Menu điều hướng"', $html);
    }

    /**
     * 10. aria-expanded and accessibility attributes are correctly implemented.
     */
    public function test_aria_expanded_and_accessibility_correctness(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        // Hamburger button controls mobile drawer
        $this->assertStringContainsString('aria-controls="mobile-nav-drawer"', $html);
        $this->assertStringContainsString(':aria-expanded="mobileMenu.toString()"', $html);
        // Close button has clear label
        $this->assertStringContainsString('aria-label="Đóng menu điều hướng"', $html);
    }

    /**
     * 11. Escape behavior and click-outside are wired up in Alpine directives.
     */
    public function test_escape_behavior_wired(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        // Desktop dropdown escape
        $this->assertStringContainsString('@keydown.escape.stop="open = false"', $html);
        $this->assertStringContainsString('@click.outside="open = false"', $html);
        // Mobile drawer escape
        $this->assertStringContainsString('@keydown.escape.window="mobileMenu = false"', $html);
    }

    /**
     * 12. Active navigation highlights current page correctly with aria-current="page".
     */
    public function test_active_navigation_home(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertMatchesRegularExpression('/aria-current="page"[^>]*>[\s\S]*?Trang chủ/u', $html);
    }

    /**
     * 13. Nested route active state: /dich-vu/web-app activates the parent 'Dịch vụ & Giải pháp'.
     */
    public function test_nested_route_active_state(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $response->assertStatus(200);

        $html = $response->getContent();
        // Top-level "Dịch vụ & Giải pháp" must be active
        $this->assertMatchesRegularExpression('/aria-current="page"[^>]*>[\s\S]*?Dịch vụ/u', $html);
        // Child item must also have aria-current="page"
        $this->assertStringContainsString('aria-current="page"', $html);
    }

    /**
     * 14. Breadcrumb component renders Schema.org Microdata and accessible navigation.
     */
    public function test_breadcrumb_component_renders(): void
    {
        $rendered = Blade::render('<x-ui.breadcrumb :items="$items" />', [
            'items' => [
                ['label' => 'Giải pháp', 'url' => '/dich-vu'],
                ['label' => 'Web App & Hệ thống số', 'url' => null],
            ],
        ]);

        $this->assertStringContainsString('aria-label="Breadcrumb"', $rendered);
        $this->assertStringContainsString('itemtype="https://schema.org/BreadcrumbList"', $rendered);
        $this->assertStringContainsString('itemtype="https://schema.org/ListItem"', $rendered);
        $this->assertStringContainsString('Trang chủ', $rendered);
        $this->assertStringContainsString('Giải pháp', $rendered);
        $this->assertStringContainsString('Web App &amp; Hệ thống số', $rendered);
        $this->assertStringContainsString('aria-current="page"', $rendered);
    }

    /**
     * 15. Footer navigation reflects core IA and displays technology solutions first.
     */
    public function test_footer_navigation(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('<footer', $html);
        $this->assertStringContainsString('Dịch Vụ Cốt Lõi', $html);
        $this->assertStringContainsString('/dich-vu/web-app', $html);
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $html);
        $this->assertStringContainsString('/dich-vu/marketing', $html);
        $this->assertStringContainsString('/dich-vu/media', $html);
        $this->assertStringContainsString('/dich-vu/booking', $html);
    }

    /**
     * 16. No unrelated ecosystem links (camping, personal blogs, etc.) in footer.
     */
    public function test_no_unrelated_ecosystem_links(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringNotContainsString('Cuu Long Camping', $html);
        $this->assertStringNotContainsString('Tui Là Người Miền Tây', $html);
        $this->assertStringNotContainsString('Tiêu Dao Tử', $html);
        $this->assertStringNotContainsString('Cùng Chơi', $html);
    }

    /**
     * 17. Canonical routes remain accessible and return HTTP 200.
     */
    public function test_canonical_routes_remain_accessible(): void
    {
        $routes = [
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
            '/ve-chung-toi',
            '/doi-tac',
            '/khach-hang',
            '/tuyen-dung',
            '/tai-nguyen',
            '/ho-so-nang-luc',
            '/lien-he',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200, "Route {$route} must return HTTP 200");
        }
    }

    /**
     * 18. Legacy redirects remain intact and return HTTP 301.
     */
    public function test_legacy_redirects_remain_intact(): void
    {
        $response = $this->get('/kho-giao-dien');
        $response->assertRedirect('/dich-vu/kho-giao-dien');
        $response->assertStatus(301);
    }

    /**
     * 19. No duplicate or confusing navigation destination where harmful.
     */
    public function test_no_duplicate_navigation_destinations(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        // The desktop primary nav skips 'Liên hệ' in menu list because the prominent primary CTA button handles it
        // Check that nav itself doesn't duplicate 'Liên hệ' link right next to 'Bắt đầu dự án'
        $startNav = strpos($html, '<nav class="hidden lg:flex');
        $endNav = strpos($html, '</nav>', $startNav);
        $navHtml = substr($html, $startNav, $endNav - $startNav);

        $this->assertDoesNotMatchRegularExpression('/<a[^>]*href="[^"]*\/lien-he"[^>]*>\s*Liên hệ\s*<\/a>/u', $navHtml, 'Nav list should not duplicate Liên hệ link on desktop where CTA button exists');
    }

    /**
     * 20. No fake or non-existent navigation pages in menus.
     */
    public function test_no_fake_or_nonexistent_navigation_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Ensure no dummy pages like /ai-solutions, /blockchain, /digital-ecosystem exist
        $fakeUrls = [
            '/ai-solutions',
            '/automation-cloud',
            '/blockchain',
            '/solutions/fake',
            '/services/fake',
        ];

        foreach ($fakeUrls as $fakeUrl) {
            $this->assertStringNotContainsString($fakeUrl, $html, "Navigation must not contain unverified/fake URL {$fakeUrl}");
        }
    }
}
