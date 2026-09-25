<?php

namespace Tests\Feature;

use App\Models\Menu;
use Database\Seeders\MenuSeeder;
use Tests\TestCase;

class HomepageRebuildTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (Menu::where('location', 'header')->count() === 0) {
            $this->seed(MenuSeeder::class);
        }
        if (\App\Models\CaseStudy::count() === 0) {
            $this->seed(\Database\Seeders\CaseStudySeeder::class);
        }
    }

    /**
     * 1. Test Homepage returns HTTP 200 OK.
     */
    public function test_homepage_returns_ok_status(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * 2. Test strictly one H1 on the entire Homepage (SEO & Heading Hierarchy).
     */
    public function test_homepage_has_strictly_one_h1(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $html);
        $this->assertEquals(1, $h1Count, 'Homepage must have strictly one <h1> tag.');
    }

    /**
     * 3. Test all core Homepage sections exist in DOM (Streamlined 8-section architecture).
     */
    public function test_all_homepage_sections_exist(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $sections = [
            'id="hero-section"',
            'id="marquee-section"',
            'id="business-needs"',
            'id="portfolio-section"',
            'id="why-clm"',
            'id="media-support"',
            'id="insights-section"',
            'id="final-conversion-band"',
        ];

        foreach ($sections as $sectionId) {
            $this->assertStringContainsString($sectionId, $html, "Section {$sectionId} must exist on Homepage.");
        }
    }

    /**
     * 4. Test strict DOM Information Hierarchy.
     */
    public function test_strict_homepage_dom_hierarchy(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $heroPos = strpos($html, 'id="hero-section"');
        $marqueePos = strpos($html, 'id="marquee-section"');
        $needsPos = strpos($html, 'id="business-needs"');
        $portfolioPos = strpos($html, 'id="portfolio-section"');
        $whyPos = strpos($html, 'id="why-clm"');
        $mediaPos = strpos($html, 'id="media-support"');
        $insightsPos = strpos($html, 'id="insights-section"');
        $finalCtaPos = strpos($html, 'id="final-conversion-band"');

        $this->assertLessThan($marqueePos, $heroPos, 'Hero must precede Marquee');
        $this->assertLessThan($needsPos, $marqueePos, 'Marquee must precede Business Needs');
        $this->assertLessThan($portfolioPos, $needsPos, 'Business Needs must precede Portfolio Proof');
        $this->assertLessThan($whyPos, $portfolioPos, 'Portfolio Proof must precede Why CLM');
        $this->assertLessThan($mediaPos, $whyPos, 'Why CLM must precede Media Support');
        $this->assertLessThan($insightsPos, $mediaPos, 'Media Support must precede Insights');
        $this->assertLessThan($finalCtaPos, $insightsPos, 'Insights must precede Final Conversion Band');
    }

    /**
     * 5. Test Technology First: Technology content precedes Media in both hero and case studies.
     */
    public function test_technology_first_order(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $techPos = strpos($html, 'id="tech-case-studies"');
        $mediaPos = strpos($html, 'id="media-support"');

        $this->assertNotFalse($techPos);
        $this->assertNotFalse($mediaPos);
        $this->assertLessThan($mediaPos, $techPos, 'Technology case studies must appear before Media support');
    }

    /**
     * 6. Test Business Problem Finder contains verified problem paths linking to canonical routes.
     */
    public function test_business_problem_finder_links_resolve(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('Bạn Đang Cần Giải Quyết Vấn Đề Gì?', $html);
        $this->assertStringContainsString('BÀI TOÁN 01', $html);
        $this->assertStringContainsString('BÀI TOÁN 02', $html);
        $this->assertStringContainsString('BÀI TOÁN 03', $html);
        $this->assertStringContainsString('BÀI TOÁN 04', $html);

        // Canonical destination routes
        $this->assertStringContainsString('/dich-vu/web-app', $html);
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $html);
        $this->assertStringContainsString('/dich-vu/marketing', $html);
        $this->assertStringContainsString('/dich-vu/media', $html);
    }

    /**
     * 8. Test real Technology Case Studies from database are rendered (no fake projects).
     */
    public function test_real_technology_case_studies_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Real project titles from database
        $response->assertSee('Ứng Dụng Quản Lý &amp; Đặt Lịch Phòng Khám Đa Khoa', false);
        $response->assertSee('Website Phòng Khám Đa Khoa Chuẩn WordPress', false);

        // Real client names from database
        $response->assertSee('Phòng Khám Gia Phước');
        $response->assertSee('Nha Khoa Nụ Cười');
    }

    /**
     * 9. Test real Media Case Studies from database are rendered in supporting block.
     */
    public function test_real_media_case_studies_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Real media clients from database
        $response->assertSee('Phim Doanh Nghiệp Hoya Lens');
        $response->assertSee('Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao');
    }

    /**
     * 10. Test Claim Safety: No unverified or prohibited marketing claims on Homepage.
     */
    public function test_claim_safety_no_prohibited_claims(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $prohibitedPatterns = [
            '900\+\s*doanh nghiệp',
            '320\+\s*khách hàng',
            '10\+\s*năm(?!\s*bảo hành)',
            '99\.2%',
            '99%\s*khách hàng',
            'Lighthouse\s*98',
            'Lighthouse\s*90\+',
            'OWASP',
            '24\/7',
            'tiết kiệm\s*đến\s*35%',
            'tiết kiệm\s*35%',
            'phản hồi\s*trong\s*2\s*giờ',
            'phản hồi\s*trong\s*24\s*giờ',
            'hàng\s*triệu\s*người\s*dùng',
            'hàng\s*nghìn\s*concurrent',
            '100%\s*Mã\s*Nguồn',
            '100%\s*Code',
            'Core\s*Web\s*Vitals\s*<\s*1s',
            'bảo\s*hành\s*trọn\s*đời',
            'tốc\s*độ\s*tải\s*<\s*1\.2s',
            'Điểm\s*Tuyệt\s*Đối\s*Google\s*Core\s*Web\s*Vitals',
        ];

        foreach ($prohibitedPatterns as $pattern) {
            $this->assertDoesNotMatchRegularExpression(
                '/' . $pattern . '/iu', 
                $html, 
                "Homepage contains prohibited marketing claim pattern: {$pattern}"
            );
        }
    }

    /**
     * 11. Test Primary CTA contract: points to /lien-he without dead links.
     */
    public function test_primary_cta_contract(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        // Check primary hero CTA
        $this->assertMatchesRegularExpression('/href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án/u', $html);
        // Check final conversion CTA
        $this->assertStringContainsString('id="final-conversion-band"', $html);
    }

    /**
     * 12. Test No dead links (href="#") or javascript:void(0) in Homepage content.
     */
    public function test_no_dead_links_in_homepage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        // Extract main content area
        $this->assertDoesNotMatchRegularExpression('/href="#"/i', $html, 'Homepage must not contain dead href="#"');
        $this->assertDoesNotMatchRegularExpression('/href="javascript:/i', $html, 'Homepage must not contain javascript: links');
    }



    /**
     * 14. Test Why Cửu Long renders evidence-based value points.
     */
    public function test_why_cuu_long_evidence_based(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('Công Nghệ Tự Chủ &bull; Kiến Trúc Mở', $html);
        $this->assertStringContainsString('Sức Mạnh Media Hỗ Trợ', $html);
        $this->assertStringContainsString('Kiểm Soát Tiến Độ &amp; Chi Phí', $html);
        $this->assertStringContainsString('Đồng Hành &amp; Hỗ Trợ Kỹ Thuật', $html);
    }

    /**
     * 15. Test Responsive grid classes and touch target semantics.
     */
    public function test_responsive_grid_structure(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('grid-cols-1', $html);
        $this->assertStringContainsString('max-w-7xl mx-auto', $html);
        $this->assertStringContainsString('px-4 sm:px-6 lg:px-8', $html);
    }

    /**
     * 16. Test canonical destination routes all return HTTP 200.
     */
    public function test_canonical_destination_routes_resolve(): void
    {
        $routes = [
            '/',
            '/dich-vu',
            '/dich-vu/web-app',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/marketing',
            '/dich-vu/media',
            '/du-an',
            '/bai-viet',
            '/lien-he',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertStatus(200, "Route {$route} linked on Homepage must resolve with 200 OK");
        }
    }
}
