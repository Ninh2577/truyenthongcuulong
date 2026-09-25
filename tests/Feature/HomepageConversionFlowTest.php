<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageConversionFlowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test 1: Homepage returns HTTP 200.
     */
    public function test_homepage_returns_ok_status(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test 2: Contact page returns HTTP 200.
     */
    public function test_contact_page_returns_ok_status(): void
    {
        $response = $this->get('/lien-he');
        $response->assertStatus(200);
    }

    /**
     * Test 3: Final conversion band exists exactly once with accessibility and alias.
     */
    public function test_final_conversion_band_exists_and_has_proper_structure(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $count = substr_count($content, 'id="final-conversion-band"');
        $this->assertEquals(1, $count, 'Section id="final-conversion-band" must exist exactly once on the Homepage.');

        $this->assertStringContainsString('id="cta-contact"', $content, 'Anchor alias id="cta-contact" must exist for backward compatibility.');
        $this->assertStringContainsString('aria-labelledby="final-cta-title"', $content, 'Section must reference title via aria-labelledby.');
        $this->assertStringContainsString('<h2 id="final-cta-title"', $content, 'Section must have h2 with id="final-cta-title".');
        $this->assertStringContainsString('Bạn Đang Có Một Bài Toán Cần Giải Quyết?', $content);
    }

    /**
     * Test 4: Primary CTA hierarchy across Homepage (Header, Hero, Process, Final).
     */
    public function test_primary_cta_hierarchy_canonical_routes(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Header Primary CTA
        $this->assertMatchesRegularExpression('/href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án/u', $content);

        // Hero Primary CTA
        $heroStart = strpos($content, 'id="hero-section"');
        $this->assertNotFalse($heroStart);
        $heroEnd = strpos($content, '</section>', $heroStart);
        $heroHtml = substr($content, $heroStart, $heroEnd - $heroStart);
        $this->assertStringContainsString('/lien-he', $heroHtml);
        $this->assertStringContainsString('Bắt đầu dự án', $heroHtml);

        // Why CLM Section (Replaced development-process, linking to /quy-trinh)
        $whyStart = strpos($content, 'id="why-clm"');
        $this->assertNotFalse($whyStart);
        $whyEnd = strpos($content, '</section>', $whyStart);
        $whyHtml = substr($content, $whyStart, $whyEnd - $whyStart);
        $this->assertStringContainsString('/quy-trinh', $whyHtml);

        // Final Conversion Band Primary CTA
        $ctaStart = strpos($content, 'id="final-conversion-band"');
        $this->assertNotFalse($ctaStart);
        $ctaEnd = strpos($content, '</section>', $ctaStart);
        $ctaHtml = substr($content, $ctaStart, $ctaEnd - $ctaStart);
        $this->assertStringContainsString('/lien-he', $ctaHtml);
        $this->assertStringContainsString('Bắt đầu dự án', $ctaHtml);
    }

    /**
     * Test 5: Secondary Exploration CTAs map to canonical routes.
     */
    public function test_secondary_and_exploration_ctas(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Hero Secondary CTA
        $heroStart = strpos($content, 'id="hero-section"');
        $heroEnd = strpos($content, '</section>', $heroStart);
        $heroHtml = substr($content, $heroStart, $heroEnd - $heroStart);
        $this->assertStringContainsString('/dich-vu', $heroHtml);
        $this->assertStringContainsString('Xem giải pháp', $heroHtml);

        // Why CLM exploration CTA (links to /quy-trinh)
        $whyStart = strpos($content, 'id="why-clm"');
        $whyEnd = strpos($content, '</section>', $whyStart);
        $whyHtml = substr($content, $whyStart, $whyEnd - $whyStart);
        $this->assertStringContainsString('/quy-trinh', $whyHtml);

        // Media Support CTAs
        $mediaStart = strpos($content, 'id="media-support"');
        $mediaEnd = strpos($content, '</section>', $mediaStart);
        $mediaHtml = substr($content, $mediaStart, $mediaEnd - $mediaStart);
        $this->assertStringContainsString('/dich-vu/media', $mediaHtml);
        $this->assertStringContainsString('/dich-vu/booking', $mediaHtml);

        // Final CTA Secondary
        $ctaStart = strpos($content, 'id="final-conversion-band"');
        $ctaEnd = strpos($content, '</section>', $ctaStart);
        $ctaHtml = substr($content, $ctaStart, $ctaEnd - $ctaStart);
        $this->assertStringContainsString('/dich-vu', $ctaHtml);
        $this->assertStringContainsString('Xem giải pháp công nghệ', $ctaHtml);
    }

    /**
     * Test 6: Business Needs & Portfolio CTA Integrity.
     */
    public function test_business_needs_and_portfolio_cta_integrity(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Business Needs section
        $needsStart = strpos($content, 'id="business-needs"');
        $this->assertNotFalse($needsStart);
        $needsEnd = strpos($content, '</section>', $needsStart);
        $needsHtml = substr($content, $needsStart, $needsEnd - $needsStart);
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $needsHtml);
        $this->assertStringContainsString('/dich-vu/web-app', $needsHtml);
        $this->assertStringContainsString('/dich-vu/marketing', $needsHtml);
        $this->assertStringContainsString('/dich-vu/media', $needsHtml);

        // Portfolio section
        $portfolioStart = strpos($content, 'id="portfolio-section"');
        $this->assertNotFalse($portfolioStart);
        $portfolioEnd = strpos($content, '</section>', $portfolioStart);
        $portfolioHtml = substr($content, $portfolioStart, $portfolioEnd - $portfolioStart);
        $this->assertStringContainsString('/du-an', $portfolioHtml);
    }

    /**
     * Test 7: Section Flow Order preserves Architecture.
     */
    public function test_homepage_conversion_flow_section_order(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $heroPos = strpos($content, 'id="hero-section"');
        $needsPos = strpos($content, 'id="business-needs"');
        $portfolioPos = strpos($content, 'id="portfolio-section"');
        $whyPos = strpos($content, 'id="why-clm"');
        $mediaPos = strpos($content, 'id="media-support"');
        $finalCtaPos = strpos($content, 'id="final-conversion-band"');

        $this->assertLessThan($needsPos, $heroPos, 'Hero must precede Business Needs.');
        $this->assertLessThan($portfolioPos, $needsPos, 'Business Needs must precede Portfolio.');
        $this->assertLessThan($whyPos, $portfolioPos, 'Portfolio must precede Why CLM.');
        $this->assertLessThan($mediaPos, $whyPos, 'Why CLM must precede Media Support.');
        $this->assertLessThan($finalCtaPos, $mediaPos, 'Media Support must precede Final Conversion Band.');
    }

    /**
     * Test 8: Contact Form UX & Elements on /lien-he.
     */
    public function test_contact_form_elements_and_ux(): void
    {
        $response = $this->get('/lien-he');
        $content = $response->getContent();

        // Form tag & method
        $this->assertStringContainsString('action="' . url('/lien-he') . '"', $content);
        $this->assertStringContainsString('method="POST"', $content);
        $this->assertStringContainsString('name="_token"', $content);

        // Required & optional fields
        $this->assertStringContainsString('name="fullname"', $content);
        $this->assertStringContainsString('name="phone"', $content);
        $this->assertStringContainsString('name="email"', $content);
        $this->assertStringContainsString('name="service_interested"', $content);
        $this->assertStringContainsString('name="message"', $content);

        // Privacy note
        $this->assertStringContainsString('Thông tin của quý khách được bảo mật', $content);
    }

    /**
     * Test 9: Contact Form Validation rejects empty request.
     */
    public function test_contact_form_validation_rejects_empty_submission(): void
    {
        $response = $this->post('/lien-he', []);
        $response->assertSessionHasErrors(['fullname', 'phone', 'message']);
    }

    /**
     * Test 10: Claim Safety - No fake urgency or unverified conversion guarantees.
     */
    public function test_claim_safety_no_fake_urgency_or_guarantees(): void
    {
        // 1. Check Homepage Final Conversion Band
        $homeResponse = $this->get('/');
        $homeContent = $homeResponse->getContent();

        $ctaStart = strpos($homeContent, 'id="final-conversion-band"');
        $ctaEnd = strpos($homeContent, '</section>', $ctaStart);
        $ctaHtml = substr($homeContent, $ctaStart, $ctaEnd - $ctaStart);

        $forbiddenHomepageClaims = [
            'Tư vấn miễn phí 100%',
            'Phản hồi trong 5 phút',
            'Báo giá trong 24h',
            'Cam kết không phát sinh',
            'Hoàn tiền',
            '100% thành công',
            'Đăng ký ngay!!!',
            'Chỉ còn 2 suất',
            'Ưu đãi hôm nay',
            'Hết hạn lúc 23:59',
        ];

        foreach ($forbiddenHomepageClaims as $claim) {
            $this->assertStringNotContainsString($claim, $ctaHtml, "Forbidden claim '$claim' must not exist in final conversion band.");
        }

        // 2. Check Contact Page (within main content to avoid layout widgets)
        $contactResponse = $this->get('/lien-he');
        $contactContent = $contactResponse->getContent();

        $contactMainStart = strpos($contactContent, '<main');
        $contactMainEnd = strpos($contactContent, '</main>');
        $contactMainHtml = ($contactMainStart !== false && $contactMainEnd !== false)
            ? substr($contactContent, $contactMainStart, $contactMainEnd - $contactMainStart)
            : $contactContent;

        $forbiddenContactClaims = [
            'Hỗ trợ 24/7',
            'SLA Phản Hồi 15 Phút',
            'Phản hồi nhanh 15 phút',
            'Cam kết phản hồi trong 15 phút',
            '100% bảo mật tuyệt đối',
        ];

        foreach ($forbiddenContactClaims as $claim) {
            $this->assertStringNotContainsString($claim, $contactMainHtml, "Forbidden claim '$claim' must not exist in contact main content.");
        }
    }

    /**
     * Test 11: Regression - Preserves Previous UI Phase Components (UI-04 to UI-09).
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
        $this->assertStringContainsString('&amp; Hệ Thống Số Doanh Nghiệp', $content);

        // UI-06 Business Needs
        $this->assertStringContainsString('id="business-needs"', $content);
        $this->assertStringContainsString('BẮT ĐẦU TỪ BÀI TOÁN DOANH NGHIỆP', $content);

        // UI-07 Portfolio
        $this->assertStringContainsString('id="portfolio-section"', $content);
        $this->assertStringContainsString('id="tech-case-studies"', $content);

        // UI-08 Why CLM (Distinct value differentiator)
        $this->assertStringContainsString('id="why-clm"', $content);
        $this->assertStringContainsString('WHY CHOOSE CỬU LONG', $content);

        // UI-09 Media Support
        $this->assertStringContainsString('id="media-support"', $content);
        $this->assertStringContainsString('CREATIVE SUPPORT &bull; MEDIA IN-HOUSE (15%)', $content);
    }
}
