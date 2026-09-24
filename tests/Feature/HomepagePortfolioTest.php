<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepagePortfolioTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test Homepage returns HTTP 200.
     */
    public function test_homepage_returns_ok_status(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test Portfolio Section exists exactly once on the Homepage.
     */
    public function test_portfolio_section_exists_once(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $count = substr_count($content, 'id="portfolio-section"');
        $this->assertEquals(1, $count, 'Portfolio section (#portfolio-section) must exist exactly once.');
    }

    /**
     * Test Technology Case Studies appear BEFORE Media Case Studies in DOM order.
     */
    public function test_technology_case_studies_appear_before_media(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $techPos = strpos($content, 'id="tech-case-studies"');
        $mediaPos = strpos($content, 'id="media-case-studies"');

        $this->assertNotFalse($techPos, 'Technology case studies section must be present.');
        $this->assertNotFalse($mediaPos, 'Media case studies section must be present.');
        $this->assertLessThan($mediaPos, $techPos, 'Technology case studies must appear before Media case studies.');
    }

    /**
     * Test real project data from database is rendered (no fake projects).
     */
    public function test_real_technology_projects_rendered(): void
    {
        $response = $this->get('/');
        
        // Real project titles from database
        $response->assertSee('Ứng Dụng Quản Lý &amp; Đặt Lịch Phòng Khám Đa Khoa', false);
        $response->assertSee('Website Phòng Khám Đa Khoa Chuẩn WordPress', false);

        // Real client names from database
        $response->assertSee('Phòng Khám Gia Phước');
        $response->assertSee('Nha Khoa Nụ Cười');
    }

    /**
     * Test real media project data from database is rendered in secondary block.
     */
    public function test_real_media_projects_rendered(): void
    {
        $response = $this->get('/');

        // Real media projects rendered in top 3 from database
        $response->assertSee('Phim Doanh Nghiệp Hoya Lens');
        $response->assertSee('Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao');
    }

    /**
     * Test service mapping links to canonical routes.
     */
    public function test_service_mapping_and_canonical_routes(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Canonical Tech service link
        $this->assertStringContainsString('/dich-vu/web-app', $content);
        // Canonical Portfolio / Projects link
        $this->assertStringContainsString('/du-an', $content);
        // Canonical Media link
        $this->assertStringContainsString('/dich-vu/media', $content);
    }

    /**
     * Test template website demo showcase is present with link to canonical repository.
     */
    public function test_template_showcase_present(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $response->assertSee('KHO GIAO DIỆN DEMO SẴN SÀNG');
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $content);
    }

    /**
     * Test claim safety: No unverified claims or fake quantitative metrics.
     */
    public function test_claim_safety_no_unverified_metrics(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        // Must not contain fabricated metrics in portfolio
        $this->assertStringNotContainsString('+300%', $content);
        $this->assertStringNotContainsString('99% satisfaction', $content);
        $this->assertStringNotContainsString('Lighthouse 98', $content);
        $this->assertStringNotContainsString('giảm 50% chi phí', $content);
    }

    /**
     * Test accessibility: semantic section, h2, h3 headings, proper alt tags.
     */
    public function test_portfolio_accessibility(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringContainsString('<h2 id="portfolio-title"', $content);
        $this->assertStringContainsString('aria-labelledby="portfolio-title"', $content);
        $this->assertStringContainsString('<h3', $content);
    }

    /**
     * Test previous UI components do not regress.
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
    }
}
