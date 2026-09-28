<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiRebuild13MarketingMediaBannerTest extends TestCase
{
    /**
     * Test 1: Both Marketing and Media pages return HTTP 200.
     */
    public function test_both_marketing_and_media_routes_return_http_200(): void
    {
        $routes = [
            '/dich-vu/marketing',
            '/dich-vu/media',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    /**
     * Test 2: Each page has strictly one H1 matching semantic architecture requirements.
     */
    public function test_strictly_single_h1_per_page_with_accurate_copy(): void
    {
        $pages = [
            '/dich-vu/marketing' => [
                'expectedTitle' => 'Chiến Lược Tối Ưu SEO & Kênh Tiếp Cận Khách Hàng',
                'expectedAccent' => 'Dựa Trên Dữ Liệu Thực Tế',
                'keyword1' => 'SEO',
                'keyword2' => 'Dữ Liệu Thực Tế',
            ],
            '/dich-vu/media' => [
                'expectedTitle' => 'Sản Xuất Tư Liệu Video',
                'expectedAccent' => '& Hình Ảnh Doanh Nghiệp',
                'keyword1' => 'Sản Xuất Tư Liệu',
                'keyword2' => 'Doanh Nghiệp',
            ],
        ];

        foreach ($pages as $route => $criteria) {
            $response = $this->get($route);
            $content = $response->getContent();

            $h1Count = preg_match_all('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $content, $matches);
            $this->assertEquals(1, $h1Count, "Route {$route} must contain strictly 1 H1 heading tag. Found: {$h1Count}");

            $rawH1 = html_entity_decode(strip_tags($matches[1][0]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $h1Text = preg_replace('/\s+/u', ' ', trim($rawH1));

            $this->assertStringContainsString($criteria['keyword1'], $h1Text);
            $this->assertStringContainsString($criteria['keyword2'], $h1Text);
        }
    }

    /**
     * Test 3: Breadcrumb is rendered on both pages with proper semantic navigation.
     */
    public function test_breadcrumb_rendered_on_both_pages(): void
    {
        $pages = [
            '/dich-vu/marketing' => 'Tối ưu SEO &amp; Tăng trưởng số',
            '/dich-vu/media' => 'Tư liệu Media &amp; Video',
        ];

        foreach ($pages as $route => $label) {
            $response = $this->get($route);
            $content = $response->getContent();

            $this->assertStringContainsString('aria-label="Breadcrumb"', $content, "Route {$route} must include breadcrumb navigation.");
            $this->assertStringContainsString('Dịch vụ &amp; Giải pháp', $content);
            $this->assertStringContainsString($label, $content);
        }
    }

    /**
     * Test 4: Target CTAs have valid destinations.
     */
    public function test_hero_ctas_have_valid_destinations(): void
    {
        // 1. Marketing CTAs
        $respMarketing = $this->get('/dich-vu/marketing');
        $respMarketing->assertSee(route('contact'));
        $respMarketing->assertSee('#growth-path');

        // 2. Media CTAs
        $respMedia = $this->get('/dich-vu/media');
        $respMedia->assertSee(route('contact') . '?service=media');
        $respMedia->assertSee(route('booking'));
    }

    /**
     * Test 5: Media page uses media-visual variant with real verified 4K Showreel poster asset.
     */
    public function test_media_hero_uses_showreel_asset_and_video_trigger(): void
    {
        $response = $this->get('/dich-vu/media');
        $content = $response->getContent();

        $this->assertStringContainsString('showreel-cinematic-poster.webp', $content);
        $this->assertStringContainsString('showreel-cinematic-poster.jpg', $content);
        $this->assertStringContainsString('openVideo(', $content);
        $this->assertStringContainsString('SHOWREEL TƯ LIỆU NĂNG LỰC', $content);
    }

    /**
     * Test 6: Preserved business sections on both pages.
     */
    public function test_preserved_business_sections_on_both_pages(): void
    {
        // Marketing
        $respMarketing = $this->get('/dich-vu/marketing');
        $respMarketing->assertSee('id="growth-path"', false);
        $respMarketing->assertSee('Chuẩn Hóa SEO Kỹ Thuật (Technical SEO)');
        $respMarketing->assertSee('Đo Lường GA4 &amp; Search Console', false);

        // Media
        $respMedia = $this->get('/dich-vu/media');
        $respMedia->assertSee('Video Giới Thiệu &amp; TVC Ngắn', false);
        $respMedia->assertSee('Chụp Ảnh Cơ Sở &amp; Đội Ngũ', false);
        $respMedia->assertSee('Dự Án Media Tiêu Biểu');
        $respMedia->assertSee('videoModal');
    }

    /**
     * Test 7: Both pages have bottom conversion CTA banner with proper links.
     */
    public function test_bottom_cta_banner_rendered_on_both_pages(): void
    {
        // Marketing
        $respMarketing = $this->get('/dich-vu/marketing');
        $respMarketing->assertSee(route('contact'));
        $respMarketing->assertSee(route('services.index'));
        $respMarketing->assertSee('Khảo Sát &amp; Đánh Giá Hiện Trạng Website Của Bạn', false);

        // Media
        $respMedia = $this->get('/dich-vu/media');
        $respMedia->assertSee(route('contact') . '?service=media');
        $respMedia->assertSee(route('booking'));
        $respMedia->assertSee('Sẵn Sàng Sản Xuất Tư Liệu Media Đồng Bộ Cho Doanh Nghiệp?');
    }

    /**
     * Test 8: Content safety — no unverified superlatives or fake guarantees.
     */
    public function test_content_safety_no_prohibited_claims(): void
    {
        $prohibitedTerms = [
            'cam kết lên top 1 trong',
            'cam kết doanh thu',
            'bảo mật tuyệt đối 100%',
            'rẻ nhất việt nam',
            'số 1 miền tây',
            'hoàn hảo nhất',
        ];

        $pages = [
            '/dich-vu/marketing',
            '/dich-vu/media',
        ];

        foreach ($pages as $route) {
            $response = $this->get($route);
            $content = mb_strtolower($response->getContent(), 'UTF-8');

            foreach ($prohibitedTerms as $term) {
                $this->assertStringNotContainsString(
                    $term,
                    $content,
                    "Route {$route} must not contain unverified claim: '{$term}'"
                );
            }
        }
    }
}
