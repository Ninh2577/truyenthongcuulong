<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class UiRebuild13BannerComponentTest extends TestCase
{
    /**
     * Test 1: Hero Component renders successfully with default props
     */
    public function test_hero_renders_successfully_with_defaults(): void
    {
        $view = $this->blade('<x-banner.hero title="Khảo Sát Giải Pháp Phần Mềm" />');

        $view->assertSee('Khảo Sát Giải Pháp Phần Mềm');
        $view->assertSee('<h1', false);
        $view->assertDontSee('Breadcrumb');
    }

    /**
     * Test 2: Hero variant 'service-split' renders correctly with text and visual slot
     */
    public function test_hero_service_split_variant_renders_structure(): void
    {
        $view = $this->blade('
            <x-banner.hero 
                variant="service-split"
                eyebrow="SOFTWARE ENGINEERING"
                title="Web App Doanh Nghiệp"
                titleAccent="Tối Ưu Vận Hành"
                description="Hệ thống tùy biến theo đúng bài toán dữ liệu thực tế."
                :primaryCta="[\'label\' => \'Bắt đầu ngay\', \'url\' => \'/lien-he\', \'icon\' => \'arrow_forward\']"
                :secondaryCta="[\'label\' => \'Xem sơ đồ\', \'url\' => \'#architecture\', \'icon\' => \'schema\']"
                image="/images/test-architecture.webp"
                imageAlt="Sơ đồ kiến trúc microservices"
            />
        ');

        $view->assertSee('SOFTWARE ENGINEERING');
        $view->assertSee('Web App Doanh Nghiệp');
        $view->assertSee('Tối Ưu Vận Hành');
        $view->assertSee('Hệ thống tùy biến theo đúng bài toán dữ liệu thực tế.');
        $view->assertSee('Bắt đầu ngay');
        $view->assertSee('/lien-he');
        $view->assertSee('Xem sơ đồ');
        $view->assertSee('#architecture');
        $view->assertSee('src="/images/test-architecture.webp"', false);
        $view->assertSee('alt="Sơ đồ kiến trúc microservices"', false);
        $view->assertSee('loading="lazy"', false);
    }

    /**
     * Test 3: Hero variant 'service-centered' renders centered layout
     */
    public function test_hero_service_centered_variant_renders_structure(): void
    {
        $view = $this->blade('
            <x-banner.hero 
                variant="service-centered"
                title="Bảng Giá Dịch Vụ Công Nghệ"
                description="Báo giá minh bạch, không phát sinh chi phí ẩn."
            />
        ');

        $view->assertSee('Bảng Giá Dịch Vụ Công Nghệ');
        $view->assertSee('Báo giá minh bạch, không phát sinh chi phí ẩn.');
        $view->assertSee('max-w-4xl mx-auto text-center', false);
    }

    /**
     * Test 4: Hero variant 'media-visual' renders media container and poster
     */
    public function test_hero_media_visual_variant_renders_structure(): void
    {
        $view = $this->blade('
            <x-banner.hero 
                variant="media-visual"
                eyebrow="PRODUCTION MEDIA & REEL"
                title="Sản Xuất Video & Tư Liệu Doanh Nghiệp"
                description="Hệ sinh thái tư liệu hình ảnh chân thực cho website."
                image="/images/real-cameraman-production.jpg"
                imageAlt="Ekip quay phim tác nghiệp"
                :primaryCta="[\'label\' => \'Đặt lịch ekip\', \'url\' => \'/dich-vu/booking\']"
                :secondaryCta="[\'label\' => \'Xem Showreel\', \'url\' => \'#play-reel\', \'icon\' => \'play_circle\']"
            />
        ');

        $view->assertSee('PRODUCTION MEDIA & REEL');
        $view->assertSee('Sản Xuất Video & Tư Liệu Doanh Nghiệp');
        $view->assertSee('Đặt lịch ekip');
        $view->assertSee('Xem Showreel');
        $view->assertSee('src="/images/real-cameraman-production.jpg"', false);
    }

    /**
     * Test 5: Hero variant 'case-study' renders project metadata strip correctly
     */
    public function test_hero_case_study_variant_renders_metadata_strip(): void
    {
        $metaStrip = [
            ['label' => 'Khách hàng', 'value' => 'Phòng Khám Gia Phước'],
            ['label' => 'Loại sản phẩm', 'value' => 'Healthcare Web-App'],
            ['label' => 'Năm triển khai', 'value' => '2024'],
            ['label' => 'Trạng thái', 'value' => 'Đã bàn giao vận hành', 'color' => 'text-emerald-600'],
        ];

        $view = $this->blade('
            <x-banner.hero 
                variant="case-study"
                eyebrow="B2B CASE STUDY"
                title="Hệ Thống Đặt Lịch & Quản Lý Hồ Sơ Khám Bệnh"
                description="Ứng dụng số hóa quy trình tiếp nhận hồ sơ y tế bảo mật."
                :metaStrip="$meta"
            />
        ', ['meta' => $metaStrip]);

        $view->assertSee('B2B CASE STUDY');
        $view->assertSee('Hệ Thống Đặt Lịch & Quản Lý Hồ Sơ Khám Bệnh');
        $view->assertSee('Khách hàng');
        $view->assertSee('Phòng Khám Gia Phước');
        $view->assertSee('Healthcare Web-App');
        $view->assertSee('2024');
        $view->assertSee('Đã bàn giao vận hành');
    }

    /**
     * Test 6: Hero handles invalid variant safely by falling back to default
     */
    public function test_hero_invalid_variant_falls_back_safely(): void
    {
        $view = $this->blade('
            <x-banner.hero 
                variant="unknown-invalid-variant"
                title="Tiêu Đề An Toàn Fallback"
            />
        ');

        $view->assertSee('Tiêu Đề An Toàn Fallback');
        $view->assertSee('<h1', false);
    }

    /**
     * Test 7: Hero strictly guarantees single H1 per banner and escapes dynamic inputs
     */
    public function test_hero_escapes_xss_and_has_single_h1(): void
    {
        $rawMalicious = '<script>alert("xss")</script>';

        $view = $this->blade('
            <x-banner.hero 
                :title="$title"
                :titleAccent="$accent"
                :description="$desc"
            />
        ', [
            'title' => 'An Toàn ' . $rawMalicious,
            'accent' => 'Accent ' . $rawMalicious,
            'desc' => 'Desc ' . $rawMalicious,
        ]);

        $html = (string) $view;
        $this->assertEquals(1, substr_count($html, '<h1'), 'Chỉ được phép có duy nhất 1 thẻ H1.');
        $this->assertStringNotContainsString('<script>alert("xss")</script>', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', $html);
    }

    /**
     * Test 8: Breadcrumb renders only when valid items are provided
     */
    public function test_hero_breadcrumb_renders_when_provided(): void
    {
        $breadcrumb = [
            ['label' => 'Dịch vụ & Giải pháp', 'url' => '/dich-vu'],
            ['label' => 'Web App Doanh Nghiệp']
        ];

        $view = $this->blade('
            <x-banner.hero 
                title="Web App"
                :breadcrumb="$breadcrumb"
            />
        ', ['breadcrumb' => $breadcrumb]);

        $view->assertSee('aria-label="Breadcrumb"', false);
        $view->assertSee('Dịch vụ &amp; Giải pháp', false);
        $view->assertSee('Web App Doanh Nghiệp');
    }

    /**
     * Test 9: LCP and responsive image handling
     */
    public function test_hero_lcp_and_responsive_image(): void
    {
        $view = $this->blade('
            <x-banner.hero 
                title="LCP Optimized Hero"
                image="/images/desktop-hero.webp"
                imageMobile="/images/mobile-hero.webp"
                imageAlt="LCP Banner Hero"
                :isLcp="true"
            />
        ');

        $view->assertSee('loading="eager"', false);
        $view->assertSee('fetchpriority="high"', false);
        $view->assertSee('<picture', false);
        $view->assertSee('media="(max-width: 640px)"', false);
        $view->assertSee('srcset="/images/mobile-hero.webp"', false);
    }

    /**
     * Test 10: CTA Banner renders with default settings
     */
    public function test_cta_banner_renders_with_defaults(): void
    {
        $view = $this->blade('<x-banner.cta />');

        $view->assertSee('Bạn đang cần xây dựng một hệ thống phù hợp với doanh nghiệp?');
        $view->assertSee('Trao đổi với Cửu Long');
        $view->assertSee('Bắt đầu dự án');
        $view->assertSee('<h2', false);
        $view->assertDontSee('<h1', false);
    }

    /**
     * Test 11: CTA Banner supports two buttons, custom trust points and light variant
     */
    public function test_cta_banner_supports_custom_options(): void
    {
        $trustPoints = [
            'Tư vấn kỹ thuật theo bài toán thực tế',
            'Đặc tả kiến trúc & lộ trình rõ ràng'
        ];

        $view = $this->blade('
            <x-banner.cta 
                variant="light"
                eyebrow="TƯ VẤN TRỰC TIẾP"
                title="Sẵn Sàng Số Hóa Quy Trình Vận Hành?"
                description="Liên hệ ngay để nhận tài liệu phân tích kỹ thuật sơ bộ."
                :primaryCta="[\'label\' => \'Gửi yêu cầu ngay\', \'url\' => \'/lien-he\']"
                :secondaryCta="[\'label\' => \'Xem bảng giá\', \'url\' => \'/dich-vu/bang-gia\', \'icon\' => \'payments\']"
                :trustPoints="$points"
            />
        ', ['points' => $trustPoints]);

        $view->assertSee('TƯ VẤN TRỰC TIẾP');
        $view->assertSee('Sẵn Sàng Số Hóa Quy Trình Vận Hành?');
        $view->assertSee('Gửi yêu cầu ngay');
        $view->assertSee('/lien-he');
        $view->assertSee('Xem bảng giá');
        $view->assertSee('/dich-vu/bang-gia');
        $view->assertSee('Tư vấn kỹ thuật theo bài toán thực tế');
        $view->assertSee('Đặc tả kiến trúc &amp; lộ trình rõ ràng', false);
    }
}
