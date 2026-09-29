<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiRebuildAutomationPageTest extends TestCase
{
    /**
     * Test 1: Automation page returns HTTP 200 and redirect works.
     */
    public function test_automation_route_returns_http_200_and_redirects(): void
    {
        $response = $this->get('/dich-vu/tu-dong-hoa');
        $response->assertStatus(200);

        // Test redirect from short url
        $redirect = $this->get('/tu-dong-hoa');
        $redirect->assertRedirect('/dich-vu/tu-dong-hoa');
    }

    /**
     * Test 2: Automation page has strictly single H1.
     */
    public function test_strictly_single_h1_with_accurate_copy(): void
    {
        $response = $this->get('/dich-vu/tu-dong-hoa');
        $content = $response->getContent();

        $h1Count = preg_match_all('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $content, $matches);
        $this->assertEquals(1, $h1Count, "Route /dich-vu/tu-dong-hoa must contain strictly 1 H1 heading tag. Found: {$h1Count}");

        $rawH1 = html_entity_decode(strip_tags($matches[1][0]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $h1Text = preg_replace('/\s+/u', ' ', trim($rawH1));

        $this->assertStringContainsString('Tự Động Hóa Quy Trình', $h1Text);
        $this->assertStringContainsString('Vận Hành Đa Kênh Cho Doanh Nghiệp', $h1Text);
    }

    /**
     * Test 3: Breadcrumb rendered properly.
     */
    public function test_breadcrumb_rendered(): void
    {
        $response = $this->get('/dich-vu/tu-dong-hoa');
        $content = $response->getContent();

        $this->assertStringContainsString('Dịch vụ &amp; Giải pháp', $content);
        $this->assertStringContainsString('Tự động hóa quy trình', $content);
    }

    /**
     * Test 4: Key automation sections rendered.
     */
    public function test_key_automation_sections_rendered(): void
    {
        $response = $this->get('/dich-vu/tu-dong-hoa');
        $content = $response->getContent();

        // 4 pillars
        $this->assertStringContainsString('Tự Động Hóa Bán Hàng &amp; CSKH Đa Kênh', $content);
        $this->assertStringContainsString('Tự Động Hóa Thanh Toán &amp; Đối Soát VietQR', $content);
        $this->assertStringContainsString('Tự Động Hóa Đơn Hàng &amp; Vận Chuyển Logistics', $content);
        $this->assertStringContainsString('Tự Động Hóa Báo Cáo &amp; Bot Cảnh Báo Telegram/Zalo', $content);

        // Comparisons
        $this->assertStringContainsString('So Sánh Vận Hành: Thủ Công vs Tự Động Hóa', $content);

        // Ecosystem
        $this->assertStringContainsString('VietQR Pro', $content);
        $this->assertStringContainsString('Zalo ZNS / OA', $content);
        $this->assertStringContainsString('Telegram Bot', $content);

        // CTA
        $this->assertStringContainsString('Sẵn Sàng Tự Động Hóa Doanh Nghiệp Của Bạn?', $content);
    }

    /**
     * Test 5: Menu link for Tự động hóa links to /dich-vu/tu-dong-hoa.
     */
    public function test_mega_menu_links_to_automation_page(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringContainsString('/dich-vu/tu-dong-hoa', $content);
    }

    /**
     * Test 6: Content safety - zero prohibited marketing claims.
     */
    public function test_content_safety_no_prohibited_claims(): void
    {
        $response = $this->get('/dich-vu/tu-dong-hoa');
        $content = $response->getContent();

        $prohibited = [
            '100% bảo mật',
            'hoàn hảo nhất',
            'rẻ nhất',
            'số 1 việt nam',
            'cam kết doanh thu',
        ];

        foreach ($prohibited as $phrase) {
            $this->assertStringNotContainsStringIgnoringCase($phrase, $content);
        }
    }
}
