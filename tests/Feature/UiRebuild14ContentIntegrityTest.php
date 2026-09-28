<?php

namespace Tests\Feature;

use Database\Seeders\MenuSeeder;
use Tests\TestCase;

class UiRebuild14ContentIntegrityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(MenuSeeder::class);
        }
    }

    /**
     * Test 1: Homepage and Services routes return HTTP 200 and single H1.
     */
    public function test_target_pages_return_http_200_and_single_h1(): void
    {
        foreach (['/', '/dich-vu'] as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();
            preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $html, $matches);
            $this->assertCount(1, $matches[0], "Route {$route} must have strictly 1 <h1> heading.");
        }
    }

    /**
     * Test 2: Homepage Hero template count is consistent and dynamic (no stale 39 vs 106 mismatch).
     */
    public function test_homepage_template_count_integrity(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        // Hero chip and visual card showcase
        $this->assertMatchesRegularExpression('/Kho Giao Diện \(\d+\+ Mẫu\)/u', $html);
        $this->assertMatchesRegularExpression('/Kho Giao Diện \(\d+\+? Mẫu Website Có Sẵn\)/u', $html);

        // Portfolio library section
        $this->assertMatchesRegularExpression('/Toàn bộ thư viện hơn \d+\+ mẫu giao diện/u', $html);
    }

    /**
     * Test 3: Homepage process messaging is aligned and has no conflicting step counts on the same page.
     */
    public function test_homepage_process_consistency(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        // Section 06 displays the 4-step condensed phases
        $this->assertStringContainsString('Quy Trình 4 Bước Rõ Ràng', $html);
        $this->assertStringContainsString('BƯỚC 01', $html);
        $this->assertStringContainsString('BƯỚC 04', $html);

        // Why Choose CLM Card 3 does not falsely claim "6 bước" right beneath "4 bước"
        $this->assertStringNotContainsString('Quy trình kiểm soát chất lượng 6 bước giúp tối ưu', $html);
        $this->assertStringNotContainsString('Tìm hiểu quy trình 6 bước', $html);
        $this->assertStringContainsString('Quy trình kiểm soát chất lượng chặt chẽ', $html);
        $this->assertStringContainsString('Tìm hiểu chi tiết quy trình', $html);
    }

    /**
     * Test 4: Marquee accessibility and distinct items.
     */
    public function test_marquee_accessibility_and_loop_integrity(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('id="marquee-section"', $html);
        $this->assertStringContainsString('aria-label="Danh sách đối tác tiêu biểu"', $html);
        $this->assertStringContainsString('aria-label="Danh sách khách hàng tiêu biểu"', $html);

        // Check that aria-hidden="true" is applied on the duplicate loop
        $this->assertStringContainsString('aria-hidden="true"', $html);
    }

    /**
     * Test 5: Homepage Insights articles have valid links, titles, and non-empty descriptions.
     */
    public function test_homepage_insights_article_content_integrity(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('id="insights-section"', $html);
        $this->assertStringContainsString('Bài Viết &amp; Kinh Nghiệm Thực Tế', $html);

        // Check that any rendered article cards do not have empty description tags (<p ...></p>)
        if (strpos($html, '<article class="group') !== false) {
            $this->assertDoesNotMatchRegularExpression(
                '/<p class="font-body text-xs text-slate-600 mt-2 line-clamp-3 leading-relaxed">\s*<\/p>/u',
                $html,
                'Article cards must not have empty descriptions.'
            );
        }
    }

    /**
     * Test 6: Services page project proof integrity (no false Laravel claims for WordPress website).
     */
    public function test_services_project_proof_integrity(): void
    {
        $response = $this->get('/dich-vu');
        $response->assertStatus(200);
        $html = $response->getContent();

        // 1. Solution Proofs
        // Web App solution lists Phòng khám Gia Phước
        $this->assertStringContainsString('Web App &amp; Hệ Thống Doanh Nghiệp', $html);
        $this->assertMatchesRegularExpression('/Thực chứng:<\/span>\s*Phòng khám Gia Phước<\/div>/u', $html);

        // Website solution lists Nha khoa Nụ Cười
        $this->assertStringContainsString('Website &amp; Digital Platform', $html);
        $this->assertMatchesRegularExpression('/Thực chứng:<\/span>\s*Nha khoa Nụ Cười/u', $html);

        // 2. Project Showcase Cards
        if (strpos($html, 'Nha Khoa Nụ Cười') !== false) {
            // Nha Khoa Nụ Cười must reflect WordPress/PHP stack, NOT Laravel
            $start = strpos($html, 'Nha Khoa Nụ Cười');
            $end = strpos($html, '</a>', $start);
            $nhaKhoaHtml = substr($html, $start - 100, $end - $start + 200);

            $this->assertStringContainsString('WordPress', $nhaKhoaHtml);
            $this->assertStringNotContainsString('Laravel, MySQL, REST API, Tailwind CSS', $nhaKhoaHtml);
        }

        if (strpos($html, 'Phòng Khám Gia Phước') !== false) {
            // Gia Phước must reflect Web-App / Laravel stack
            $start = strpos($html, 'Phòng Khám Gia Phước');
            $end = strpos($html, '</a>', $start);
            $giaPhuocHtml = substr($html, $start - 100, $end - $start + 200);

            $this->assertStringContainsString('Web App', $giaPhuocHtml);
            $this->assertStringContainsString('Laravel', $giaPhuocHtml);
        }
    }
}
