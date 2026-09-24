<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeaderNavigationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test header renders with semantic navigation and landmark roles.
     */
    public function test_header_navigation_renders_cleanly_on_homepage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('<header', $html);
        $this->assertStringContainsString('aria-label="Menu chính"', $html);
        $this->assertStringContainsString('Technology &bull; Digital Solutions', $html);
    }

    /**
     * Test Technology-First Mega Menu hierarchy: Tech before Media, canonical routes intact.
     */
    public function test_technology_first_mega_menu_structure(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $techPos = strpos($html, 'CÔNG NGHỆ &amp; GIẢI PHÁP SỐ');
        if ($techPos === false) {
            $techPos = strpos($html, 'CÔNG NGHỆ & GIẢI PHÁP SỐ');
        }
        $mediaPos = strpos($html, 'TRUYỀN THÔNG &amp; MEDIA');
        if ($mediaPos === false) {
            $mediaPos = strpos($html, 'TRUYỀN THÔNG & MEDIA');
        }

        $this->assertNotFalse($techPos, 'Tech group header must be present');
        $this->assertNotFalse($mediaPos, 'Media group header must be present');
        $this->assertLessThan($mediaPos, $techPos, 'Technology group must appear BEFORE Media group');

        // Check canonical service routes
        $canonicalUrls = [
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/bang-gia',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
        ];

        foreach ($canonicalUrls as $url) {
            $this->assertStringContainsString($url, $html, "Canonical service URL {$url} must be present in navigation");
        }
    }

    /**
     * Test Primary Header CTA 'Bắt đầu dự án' points to canonical contact route.
     */
    public function test_header_primary_cta_contract(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('Bắt đầu dự án', $html);
        $this->assertMatchesRegularExpression('/href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án/u', $html);
    }

    /**
     * Test Mobile Drawer contains accessible dialog semantics and controls.
     */
    public function test_mobile_drawer_and_accessibility_attributes(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $this->assertStringContainsString('role="dialog"', $html);
        $this->assertStringContainsString('aria-modal="true"', $html);
        $this->assertStringContainsString('aria-controls="mobile-nav-drawer"', $html);
        $this->assertStringContainsString('aria-label="Đóng menu điều hướng"', $html);
    }

    /**
     * Test active route indicators set aria-current="page".
     */
    public function test_active_route_detection(): void
    {
        $responseHome = $this->get('/');
        $responseHome->assertStatus(200);
        $this->assertMatchesRegularExpression('/aria-current="page"[^>]*>[\s\S]*?Trang chủ/u', $responseHome->getContent());

        $responseService = $this->get('/dich-vu/web-app');
        $responseService->assertStatus(200);
        $this->assertMatchesRegularExpression('/aria-current="page"[^>]*>[\s\S]*?Dịch vụ/u', $responseService->getContent());
    }

    /**
     * Test claim safety: No unverified or exaggerated badges in Header.
     */
    public function test_claim_safety_no_unverified_badges(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $start = strpos($html, '<header');
        $end = strpos($html, '</header>');
        $headerHtml = substr($html, $start, $end - $start + 9);

        $disallowed = [
            '500\+\s*projects',
            '99%\s*satisfaction',
            '10\+\s*years',
            'Enterprise-grade',
            'Best in class',
            '#1',
            '\bHot\b(?!line)',
            '\bPopular\b',
        ];

        foreach ($disallowed as $pattern) {
            $this->assertDoesNotMatchRegularExpression('/' . $pattern . '/i', $headerHtml, "Header contains disallowed claim pattern: {$pattern}");
        }
    }
}
