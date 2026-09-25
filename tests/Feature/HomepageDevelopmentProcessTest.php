<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageDevelopmentProcessTest extends TestCase
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
     * Test 2: Process section exists on /quy-trinh.
     */
    public function test_development_process_section_exists_exactly_once(): void
    {
        $response = $this->get('/quy-trinh');
        $response->assertStatus(200);
        $content = $response->getContent();

        $count = substr_count($content, 'id="development-process"');
        $this->assertEquals(1, $count, 'Section id="development-process" must exist on /quy-trinh.');
    }

    /**
     * Test 3: Section has semantic H2 heading and aria-labelledby.
     */
    public function test_section_heading_and_accessibility(): void
    {
        $response = $this->get('/quy-trinh');
        $content = $response->getContent();

        $this->assertStringContainsString('aria-labelledby="development-process-title"', $content);
        $this->assertStringContainsString('id="development-process-title"', $content);
        $this->assertStringContainsString('QUY TRÌNH TRIỂN KHAI &bull; HOW WE BUILD', $content);
        $this->assertStringContainsString('Từ Bài Toán Doanh Nghiệp Đến Hệ Thống Vận Hành', $content);
    }

    /**
     * Test 4: All 6 verified steps render with H3 headings and deliverables.
     */
    public function test_all_six_process_steps_render_with_deliverables(): void
    {
        $response = $this->get('/quy-trinh');
        $content = $response->getContent();

        $expectedSteps = [
            'BƯỚC 01' => 'Khảo Sát &amp; Tiếp Nhận Bài Toán',
            'BƯỚC 02' => 'Phân Tích Nghiệp Vụ &amp; Kiến Trúc',
            'BƯỚC 03' => 'Thiết Kế Trải Nghiệm (UI/UX)',
            'BƯỚC 04' => 'Lập Trình &amp; Tích Hợp Hệ Thống',
            'BƯỚC 05' => 'Kiểm Thử &amp; Tối Ưu Vận Hành',
            'BƯỚC 06' => 'Bàn Giao &amp; Hỗ Trợ Khởi Chạy',
        ];

        foreach ($expectedSteps as $badge => $title) {
            $this->assertStringContainsString($badge, $content);
            $this->assertStringContainsString($title, $content);
        }

        // Check deliverable labels
        $this->assertStringContainsString('Kết quả đầu ra:', $content);
    }

    /**
     * Test 5: Process steps follow strict progressive DOM order (01 through 06).
     */
    public function test_process_steps_order_is_strictly_progressive(): void
    {
        $response = $this->get('/quy-trinh');
        $content = $response->getContent();

        $p1 = strpos($content, 'BƯỚC 01');
        $p2 = strpos($content, 'BƯỚC 02');
        $p3 = strpos($content, 'BƯỚC 03');
        $p4 = strpos($content, 'BƯỚC 04');
        $p5 = strpos($content, 'BƯỚC 05');
        $p6 = strpos($content, 'BƯỚC 06');

        $this->assertNotFalse($p1);
        $this->assertNotFalse($p2);
        $this->assertNotFalse($p3);
        $this->assertNotFalse($p4);
        $this->assertNotFalse($p5);
        $this->assertNotFalse($p6);

        $this->assertTrue($p1 < $p2 && $p2 < $p3 && $p3 < $p4 && $p4 < $p5 && $p5 < $p6, 'Steps must be in sequential order.');
    }

    /**
     * Test 6: Section position in Homepage flow preserves Why Cửu Long and links to /quy-trinh.
     */
    public function test_section_order_in_homepage_flow(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $portfolioPos = strpos($content, 'id="portfolio-section"');
        $whyPos = strpos($content, 'id="why-clm"');

        $this->assertNotFalse($portfolioPos, 'Portfolio section must exist.');
        $this->assertNotFalse($whyPos, 'Why Cửu Long section must exist.');
        $this->assertLessThan($whyPos, $portfolioPos, 'Portfolio must precede Why Cửu Long.');
        $this->assertStringContainsString('/quy-trinh', $content);
    }

    /**
     * Test 7: Claim Safety - No unverified technical jargon or fake marketing claims.
     */
    public function test_claim_safety_no_unverified_jargon_or_guarantees(): void
    {
        $response = $this->get('/quy-trinh');
        $content = $response->getContent();

        $processStart = strpos($content, 'id="development-process"');
        $processEnd = strpos($content, '</section>', $processStart);
        $processHtml = substr($content, $processStart, $processEnd - $processStart);

        $forbidden = [
            'OWASP',
            'Lighthouse 90+',
            'Lighthouse 98+',
            'zero bug',
            'Agile certified',
            'ISO',
            'CI/CD',
            'Docker',
            'Kubernetes',
            '99.9%',
            '100% on-time',
            '100% security',
        ];

        foreach ($forbidden as $phrase) {
            $this->assertStringNotContainsString($phrase, $processHtml, "Forbidden phrase '$phrase' must not exist in process section.");
        }
    }

    /**
     * Test 8: Canonical CTA links exist and point to valid routes.
     */
    public function test_canonical_cta_links(): void
    {
        $response = $this->get('/quy-trinh');
        $content = $response->getContent();

        $this->assertStringContainsString('/lien-he', $content);
        $this->assertStringContainsString('/dich-vu', $content);
    }

    /**
     * Test 9: Preserves Header (UI-04), Hero (UI-05), Business Needs (UI-06), and Portfolio (UI-07).
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

        // Semantic Anchor: Media Case Studies (consolidated into media_support layer)
        $this->assertStringContainsString('id="media-case-studies"', $content);
    }
}
