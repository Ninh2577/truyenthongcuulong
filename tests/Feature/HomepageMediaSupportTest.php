<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageMediaSupportTest extends TestCase
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
     * Test 2: Media Support section exists exactly once on Homepage.
     */
    public function test_media_support_section_exists_exactly_once(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $count = substr_count($content, 'id="media-support"');
        $this->assertEquals(1, $count, 'Section id="media-support" must exist exactly once on the Homepage.');
    }

    /**
     * Test 3: Section heading hierarchy, H2 with aria-labelledby and eyebrow.
     */
    public function test_media_support_heading_hierarchy_and_accessibility(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringContainsString('aria-labelledby="media-support-title"', $content);
        $this->assertStringContainsString('<h2 id="media-support-title"', $content);
        $this->assertStringContainsString('CREATIVE SUPPORT &bull; MEDIA IN-HOUSE (15%)', $content);
        $this->assertStringContainsString('Công Nghệ Tạo Nền Tảng &bull; Media Truyền Tải Giá Trị', $content);
    }

    /**
     * Test 4: All 4 verified media capabilities are rendered.
     */
    public function test_all_four_media_capabilities_render(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $expectedCapabilities = [
            'TVC &amp; Video Sản Phẩm Số',
            'Phim Doanh Nghiệp',
            'Ghi Hình Sự Kiện &amp; Ra Mắt',
            'Booking Ekip &amp; Thiết Bị',
        ];

        foreach ($expectedCapabilities as $cap) {
            $this->assertStringContainsString($cap, $content);
        }
    }

    /**
     * Test 5: Real media case studies from database are rendered.
     */
    public function test_real_media_case_studies_rendered(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $mediaStart = strpos($content, 'id="media-support"');
        $mediaEnd = strpos($content, '</section>', $mediaStart);
        $mediaHtml = substr($content, $mediaStart, $mediaEnd - $mediaStart);

        $this->assertStringContainsString('Phim Doanh Nghiệp Hoya Lens', $mediaHtml);
        $this->assertStringContainsString('Tất Niên Kredivo', $mediaHtml);
        $this->assertStringContainsString('RAKUS Việt Nam', $mediaHtml);
    }

    /**
     * Test 6: Canonical CTA links in Media Support point to existing routes.
     */
    public function test_canonical_cta_links_in_media_support(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $mediaStart = strpos($content, 'id="media-support"');
        $mediaEnd = strpos($content, '</section>', $mediaStart);
        $mediaHtml = substr($content, $mediaStart, $mediaEnd - $mediaStart);

        $this->assertStringContainsString('/dich-vu/media', $mediaHtml);
        $this->assertStringContainsString('/dich-vu/booking', $mediaHtml);
    }

    /**
     * Test 7: Section position in DOM - Media Support comes AFTER Technology sections.
     */
    public function test_media_support_positioned_after_technology_sections(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $portfolioPos = strpos($content, 'id="portfolio-section"');
        $processPos = strpos($content, 'id="development-process"');
        $mediaPos = strpos($content, 'id="media-support"');

        $this->assertNotFalse($portfolioPos);
        $this->assertNotFalse($processPos);
        $this->assertNotFalse($mediaPos);

        $this->assertLessThan($mediaPos, $portfolioPos, 'Portfolio section must precede Media Support.');
        $this->assertLessThan($mediaPos, $processPos, 'Development Process must precede Media Support.');
    }

    /**
     * Test 8: Claim Safety - No unverified marketing claims in Media Support.
     */
    public function test_claim_safety_no_unverified_marketing_claims(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $mediaStart = strpos($content, 'id="media-support"');
        $mediaEnd = strpos($content, '</section>', $mediaStart);
        $mediaHtml = substr($content, $mediaStart, $mediaEnd - $mediaStart);

        $forbidden = [
            '10+ năm kinh nghiệm',
            '500+ dự án',
            '900+ doanh nghiệp',
            '99% khách hàng hài lòng',
            '4K cinema certified',
            'Award-winning',
            'Top production house',
            '100% in-house',
        ];

        foreach ($forbidden as $phrase) {
            $this->assertStringNotContainsString($phrase, $mediaHtml, "Forbidden claim '$phrase' must not exist in media-support.");
        }
    }

    /**
     * Test 9: Preserves Header (UI-04), Hero (UI-05), Business Needs (UI-06), Portfolio (UI-07), and Process (UI-08).
     */
    public function test_previous_ui_components_preserved(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // UI-04 Header
        $this->assertStringContainsString('aria-label="Menu chính"', $content);
        $this->assertStringContainsString('Bắt đầu dự án', $content);

        // UI-05 Hero
        $this->assertStringContainsString('id="hero-section"', $content);
        $this->assertStringContainsString('Xem giải pháp', $content);

        // UI-06 Business Needs
        $this->assertStringContainsString('id="business-needs"', $content);
        $this->assertStringContainsString('BẮT ĐẦU TỪ BÀI TOÁN DOANH NGHIỆP', $content);

        // UI-07 Portfolio
        $this->assertStringContainsString('id="portfolio-section"', $content);
        $this->assertStringContainsString('id="tech-case-studies"', $content);

        // UI-08 Development Process
        $this->assertStringContainsString('id="development-process"', $content);
        $this->assertStringContainsString('QUY TRÌNH TRIỂN KHAI &bull; HOW WE BUILD', $content);
    }
}
