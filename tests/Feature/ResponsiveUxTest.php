<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResponsiveUxTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test 1: All canonical routes return HTTP 200.
     */
    public function test_all_canonical_routes_return_ok_status(): void
    {
        $canonicalRoutes = [
            '/',
            '/lien-he',
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/dich-vu/booking',
            '/du-an',
        ];

        foreach ($canonicalRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200, "Route $route must return HTTP 200.");
        }
    }

    /**
     * Test 2: Mobile Header structure and touch targets.
     */
    public function test_mobile_header_structure_and_touch_targets(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Hamburger button must have accessible name and minimum 44x44px touch target
        $this->assertStringContainsString('aria-label="Mở menu điều hướng"', $content);
        $this->assertStringContainsString('min-w-[44px]', $content);
        $this->assertStringContainsString('min-h-[44px]', $content);

        // Drawer close button must exist and have accessible name
        $this->assertStringContainsString('aria-label="Đóng menu điều hướng"', $content);

        // Header CTA Bắt đầu dự án must have responsive padding and text
        $this->assertStringContainsString('Bắt đầu dự án', $content);

        // Brand logo has responsive truncate classes for small viewports
        $this->assertStringContainsString('TRUYỀN THÔNG CỬU LONG', $content);
        $this->assertStringContainsString('truncate', $content);
    }

    /**
     * Test 3: Mobile Drawer preserves Technology-First hierarchy and keyboard accessibility.
     */
    public function test_mobile_drawer_technology_first_and_accessibility(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Drawer dialog attributes
        $this->assertStringContainsString('id="mobile-nav-drawer"', $content);
        $this->assertStringContainsString('role="dialog"', $content);
        $this->assertStringContainsString('aria-modal="true"', $content);
        $this->assertStringContainsString('@keydown.escape.window="mobileMenu = false"', $content);

        // Technology Group must appear before Media Group in Mobile Drawer
        $techPos = strpos($content, 'CÔNG NGHỆ &amp; GIẢI PHÁP SỐ');
        $mediaPos = strpos($content, 'TRUYỀN THÔNG &amp; MEDIA');
        $this->assertNotFalse($techPos, 'Technology group must exist in mobile drawer.');
        $this->assertNotFalse($mediaPos, 'Media group must exist in mobile drawer.');
        $this->assertLessThan($mediaPos, $techPos, 'Technology must precede Media in Mobile Drawer navigation.');

        // Drawer primary CTA points to /lien-he
        $drawerStart = strpos($content, 'id="mobile-nav-drawer"');
        $drawerEnd = strpos($content, '</header>', $drawerStart);
        $drawerHtml = substr($content, $drawerStart, $drawerEnd - $drawerStart);
        $this->assertStringContainsString('/lien-he', $drawerHtml);
        $this->assertStringContainsString('Bắt đầu dự án', $drawerHtml);
    }

    /**
     * Test 4: Floating contact buttons and Chat FAB anti-collision layout.
     */
    public function test_floating_elements_anti_collision_layout(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Floating Contact Wrapper (Call & Zalo) positioned on left
        $this->assertStringContainsString('.floating-contact-wrapper', $content);
        $this->assertStringContainsString('left: 16px;', $content);

        // Chat FAB positioned on right
        $this->assertStringContainsString('id="chat-fab-button"', $content);
        $this->assertStringContainsString('right-4', $content);
    }

    /**
     * Test 5: Component CTA responsive stacking across Homepage.
     */
    public function test_component_cta_responsive_stacking(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Hero CTA container
        $heroStart = strpos($content, 'id="hero-section"');
        $heroEnd = strpos($content, '</section>', $heroStart);
        $heroHtml = substr($content, $heroStart, $heroEnd - $heroStart);
        $this->assertStringContainsString('flex-col sm:flex-row items-stretch sm:items-center', $heroHtml);

        // Why CLM CTA container (links to /quy-trinh)
        $whyStart = strpos($content, 'id="why-clm"');
        $this->assertNotFalse($whyStart);

        // Media Support CTA container
        $mediaStart = strpos($content, 'id="media-support"');
        $mediaEnd = strpos($content, '</section>', $mediaStart);
        $mediaHtml = substr($content, $mediaStart, $mediaEnd - $mediaStart);
        $this->assertStringContainsString('flex-col sm:flex-row items-stretch sm:items-center', $mediaHtml);

        // Final Conversion Band CTA container
        $ctaStart = strpos($content, 'id="final-conversion-band"');
        $ctaEnd = strpos($content, '</section>', $ctaStart);
        $ctaHtml = substr($content, $ctaStart, $ctaEnd - $ctaStart);
        $this->assertStringContainsString('flex-col sm:flex-row items-stretch sm:items-center', $ctaHtml);
    }

    /**
     * Test 6: Contact form mobile UX & iOS auto-zoom prevention.
     */
    public function test_contact_form_mobile_ux_and_ios_zoom_prevention(): void
    {
        $response = $this->get('/lien-he');
        $content = $response->getContent();

        // Font-size must be text-base sm:text-sm (>= 16px on mobile) to prevent iOS auto-zoom
        $this->assertStringContainsString('text-base sm:text-sm', $content);

        // Mobile keyboard hints
        $this->assertStringContainsString('autocomplete="name"', $content);
        $this->assertStringContainsString('autocomplete="tel"', $content);
        $this->assertStringContainsString('inputmode="tel"', $content);
        $this->assertStringContainsString('autocomplete="email"', $content);
        $this->assertStringContainsString('inputmode="email"', $content);

        // Submit button touch target
        $this->assertStringContainsString('min-h-[48px]', $content);
        $this->assertStringContainsString('Gửi Yêu Cầu Tư Vấn', $content);
    }

    /**
     * Test 7: Claim Safety - No fake urgency or unverified conversion guarantees.
     */
    public function test_claim_safety_no_fake_claims(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $forbidden = [
            'Tư vấn miễn phí 100%',
            'Phản hồi trong 5 phút',
            'Báo giá trong 24h',
            'Cam kết không phát sinh',
            'Hoàn tiền',
            '100% thành công',
            'Đăng ký ngay!!!',
            'Chỉ còn 2 suất',
            'Ưu đãi hôm nay',
        ];

        foreach ($forbidden as $phrase) {
            $this->assertStringNotContainsString($phrase, $content, "Forbidden claim '$phrase' must not exist on Homepage.");
        }
    }

    /**
     * Test 8: Regression - Preserves Previous UI Phase Components (UI-04 to UI-10).
     */
    public function test_previous_ui_phases_preserved(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // UI-04 Header
        $this->assertStringContainsString('aria-label="Menu chính"', $content);

        // UI-05 Hero
        $this->assertStringContainsString('id="hero-section"', $content);
        $this->assertStringContainsString('Giải Pháp Web, Web App', $content);

        // UI-06 Business Needs
        $this->assertStringContainsString('id="business-needs"', $content);

        // UI-07 Portfolio
        $this->assertStringContainsString('id="portfolio-section"', $content);

        // UI-08 Why CLM (Distinct differentiator)
        $this->assertStringContainsString('id="why-clm"', $content);

        // UI-09 Media Support
        $this->assertStringContainsString('id="media-support"', $content);

        // UI-10 Final Conversion Band
        $this->assertStringContainsString('id="final-conversion-band"', $content);
    }
}
