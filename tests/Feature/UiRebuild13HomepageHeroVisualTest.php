<?php

namespace Tests\Feature;

use Database\Seeders\MenuSeeder;
use Tests\TestCase;

class UiRebuild13HomepageHeroVisualTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(MenuSeeder::class);
        }
    }

    /**
     * Test 1: Homepage renders successfully with HTTP 200.
     */
    public function test_homepage_renders_http_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test 2: Homepage hero has strictly one <h1> heading with B2B technology messaging.
     */
    public function test_homepage_hero_has_single_h1_with_tech_messaging(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $html, $matches);

        $this->assertCount(1, $matches[0], 'Trang chủ chỉ được có duy nhất 1 thẻ <h1>.');

        $h1Text = strip_tags($matches[0][0]);
        $this->assertStringContainsString('Phát triển phần mềm', $h1Text);
        $this->assertStringContainsString('vận hành doanh nghiệp', $h1Text);
        $this->assertStringContainsString('Giải Pháp Web, Web App', $h1Text);
        $this->assertStringContainsString('Hệ Thống Số Doanh Nghiệp', $h1Text);
    }

    /**
     * Test 3: Hero CTAs have valid destinations and proper classes.
     */
    public function test_hero_ctas_have_valid_destinations(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="hero-section"');
        $this->assertNotFalse($start, 'Hero section với id="hero-section" phải tồn tại.');
        $end = strpos($html, '</section>', $start);
        $heroHtml = substr($html, $start, $end - $start + 10);

        // Primary CTA
        $this->assertMatchesRegularExpression(
            '/<a\s+[^>]*href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án[\s\S]*?<\/a>/u',
            $heroHtml,
            'CTA chính phải dẫn đến /lien-he.'
        );
        $this->assertStringContainsString('btn-primary-cta', $heroHtml);

        // Secondary CTA
        $this->assertMatchesRegularExpression(
            '/<a\s+[^>]*href="[^"]*\/dich-vu"[^>]*>[\s\S]*?Xem giải pháp[\s\S]*?<\/a>/u',
            $heroHtml,
            'CTA phụ phải dẫn đến /dich-vu.'
        );
        $this->assertStringContainsString('btn-secondary-cta', $heroHtml);
    }

    /**
     * Test 4: Visual Showcase displays verified real image with zero CLS and LCP priority.
     */
    public function test_visual_showcase_uses_real_asset_and_lcp_optimization(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Region and accessibility labels
        $this->assertStringContainsString('role="region"', $html);
        $this->assertStringContainsString('aria-label="Giao diện giải pháp công nghệ số"', $html);

        // Real visual image asset
        $this->assertStringContainsString('modern_tech_platform.jpg', $html);
        $this->assertStringContainsString('aspect-[16/10]', $html);
        $this->assertStringContainsString('fetchpriority="high"', $html);
        $this->assertStringContainsString('loading="eager"', $html);
        $this->assertStringContainsString('decoding="async"', $html);

        // Template showcase quick link
        $this->assertMatchesRegularExpression('/Kho Giao Diện \(\d+\+? Mẫu Website Có Sẵn\)/u', $html);
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $html);
    }

    /**
     * Test 5: Extra slot renders verified capability chips without dead links.
     */
    public function test_capabilities_strip_renders_valid_links(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $this->assertStringContainsString('NĂNG LỰC GIẢI PHÁP CỐT LÕI', $html);
        $this->assertStringContainsString('Lập trình Web-App', $html);
        $this->assertStringContainsString('/dich-vu/web-app', $html);
        $this->assertMatchesRegularExpression('/Kho Giao Diện \(\d+\+ Mẫu\)/u', $html);
        $this->assertStringContainsString('Tối Ưu SEO &amp; Số Hóa', $html);
        $this->assertStringContainsString('/dich-vu/marketing', $html);
        $this->assertStringContainsString('Media In-House Hỗ Trợ', $html);
        $this->assertStringContainsString('/dich-vu/media', $html);
    }

    /**
     * Test 6: Hero section strictly avoids unverified / exaggerated claims.
     */
    public function test_hero_has_no_fake_claims(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $start = strpos($html, 'id="hero-section"');
        $end = strpos($html, '</section>', $start);
        $heroHtml = substr($html, $start, $end - $start + 10);

        $disallowed = [
            '1\.2s', 'Lighthouse 98', '100% Source Code',
            '900\+ businesses', '320\+ clients', '99\.2%',
            'OWASP AA', '500\+ projects', '10\+ years',
        ];

        foreach ($disallowed as $pattern) {
            $this->assertDoesNotMatchRegularExpression(
                '/' . $pattern . '/i',
                $heroHtml,
                "Hero không được chứa tuyên bố chưa xác thực: {$pattern}"
            );
        }
    }
}
