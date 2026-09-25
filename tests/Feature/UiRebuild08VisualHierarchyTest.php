<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiRebuild08VisualHierarchyTest extends TestCase
{
    /**
     * Test 1: Verify Homepage above-the-fold, UX flow, and consolidated media proof.
     */
    public function test_homepage_visual_hierarchy_and_flow(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Exactly one H1
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content, $h1Matches);
        $this->assertEquals(1, $h1Count, 'Homepage must have strictly one H1 heading');
        $this->assertStringContainsString('Giải Pháp Web, Web App', $h1Matches[0][0]);

        // Hero CTA Contracts
        $this->assertMatchesRegularExpression('/<a\s+[^>]*class="[^"]*btn-primary-cta[^"]*"[^>]*href="[^"]*\/lien-he"[^>]*>|<a\s+[^>]*href="[^"]*\/lien-he"[^>]*class="[^"]*btn-primary-cta[^"]*"[^>]*>/iu', $content);
        $this->assertMatchesRegularExpression('/<a\s+[^>]*class="[^"]*btn-secondary-cta[^"]*"[^>]*href="[^"]*\/dich-vu"[^>]*>|<a\s+[^>]*href="[^"]*\/dich-vu"[^>]*class="[^"]*btn-secondary-cta[^"]*"[^>]*>/iu', $content);
        $this->assertStringContainsString('Bắt đầu dự án', $content);
        $this->assertStringContainsString('Xem giải pháp', $content);

        // Flow order
        $heroPos = strpos($content, 'id="hero-section"');
        $marqueePos = strpos($content, 'id="marquee-section"');
        $businessPos = strpos($content, 'id="business-needs"');
        $portfolioPos = strpos($content, 'id="portfolio-section"');
        $whyPos = strpos($content, 'id="why-clm"');
        $mediaPos = strpos($content, 'id="media-support"');
        $insightsPos = strpos($content, 'id="insights-section"');
        $ctaPos = strpos($content, 'id="final-conversion-band"');

        $this->assertNotFalse($heroPos, 'Hero must exist');
        $this->assertNotFalse($marqueePos, 'Marquee must exist');
        $this->assertNotFalse($businessPos, 'Business needs must exist');
        $this->assertNotFalse($portfolioPos, 'Portfolio must exist');
        $this->assertNotFalse($whyPos, 'Why CLM must exist');
        $this->assertNotFalse($mediaPos, 'Media support must exist');
        $this->assertNotFalse($insightsPos, 'Insights must exist');
        $this->assertNotFalse($ctaPos, 'Final CTA must exist');

        $this->assertLessThan($marqueePos, $heroPos);
        $this->assertLessThan($businessPos, $marqueePos);
        $this->assertLessThan($portfolioPos, $businessPos);
        $this->assertLessThan($whyPos, $portfolioPos);
        $this->assertLessThan($mediaPos, $whyPos);
        $this->assertLessThan($insightsPos, $mediaPos);
        $this->assertLessThan($ctaPos, $insightsPos);

        // Portfolio has Ready-made templates
        $this->assertStringContainsString('id="ready-made-templates"', $content);

        // Why CLM has link to 6-step process
        $this->assertStringContainsString('/quy-trinh', $content);
    }

    /**
     * Test 2: Service Hub /dich-vu acts as Solution Architecture Directory.
     */
    public function test_service_hub_directory_architecture(): void
    {
        $response = $this->get('/dich-vu');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Exactly one H1
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content, $h1Matches);
        $this->assertEquals(1, $h1Count, 'Service hub must have strictly one H1 heading');

        // Contains Tech & Media Solution Groups
        $this->assertStringContainsString('Nhóm Giải Pháp Công Nghệ &amp; Nền Tảng Số', $content);
        $this->assertStringContainsString('Năng Lực Truyền Thông &amp; Media Hỗ Trợ', $content);

        // Links to detailed services
        $this->assertStringContainsString('/dich-vu/web-app', $content);
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $content);
        $this->assertStringContainsString('/dich-vu/marketing', $content);
        $this->assertStringContainsString('/dich-vu/media', $content);
    }

    /**
     * Test 3: Web-App page flow and link to /quy-trinh.
     */
    public function test_web_app_page_flow_and_commitments(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Exactly one H1
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content);
        $this->assertEquals(1, $h1Count, 'Web-app page must have strictly one H1 heading');

        // Contains delivery commitment linking to /quy-trinh
        $this->assertStringContainsString('Xem chi tiết quy trình 6 bước', $content);
        $this->assertStringContainsString('/quy-trinh', $content);

        // Contains template cross-sell
        $this->assertStringContainsString('Khám phá kho giao diện', $content);
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $content);
    }

    /**
     * Test 4: Media page visual showcase and final conversion CTA.
     */
    public function test_media_page_flow_and_final_cta(): void
    {
        $response = $this->get('/dich-vu/media');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Exactly one H1
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content);
        $this->assertEquals(1, $h1Count, 'Media page must have strictly one H1 heading');

        // Contains Final CTA
        $this->assertStringContainsString('HỢP TÁC SẢN XUẤT', $content);
        $this->assertStringContainsString('Sẵn Sàng Sản Xuất Tư Liệu Media Đồng Bộ Cho Doanh Nghiệp?', $content);
    }

    /**
     * Test 5: Marketing & SEO page flow and capabilities.
     */
    public function test_marketing_page_flow(): void
    {
        $response = $this->get('/dich-vu/marketing');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Exactly one H1
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content);
        $this->assertEquals(1, $h1Count, 'Marketing page must have strictly one H1 heading');

        $this->assertStringContainsString('HÀNH TRÌNH GIẢI QUYẾT BÀI TOÁN', $content);
        $this->assertStringContainsString('Nội Dung Dịch Vụ SEO &amp; Truyền Thông Số', $content);
    }

    /**
     * Test 6: Template library discovery page and final CTA.
     */
    public function test_template_library_discovery_page(): void
    {
        $response = $this->get('/dich-vu/kho-giao-dien');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Exactly one H1
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content);
        $this->assertEquals(1, $h1Count, 'Template page must have strictly one H1 heading');

        // Contains Filter and Final CTA
        $this->assertStringContainsString('LỌC THEO NGÀNH NGHỀ', $content);
        $this->assertStringContainsString('Cần Giao Diện May Đo Hoặc Tùy Biến Chuyên Sâu?', $content);
    }

    /**
     * Test 7: /quy-trinh page renders 6-step process with deliverables.
     */
    public function test_process_page_renders_six_steps_cleanly(): void
    {
        $response = $this->get('/quy-trinh');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Exactly one H1
        $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $content);
        $this->assertEquals(1, $h1Count, 'Process page must have strictly one H1 heading');

        // Exactly 6 steps
        $this->assertStringContainsString('BƯỚC 01', $content);
        $this->assertStringContainsString('BƯỚC 02', $content);
        $this->assertStringContainsString('BƯỚC 03', $content);
        $this->assertStringContainsString('BƯỚC 04', $content);
        $this->assertStringContainsString('BƯỚC 05', $content);
        $this->assertStringContainsString('BƯỚC 06', $content);

        // Contains deliverables
        $this->assertStringContainsString('Kết quả đầu ra:', $content);

        // Contains quality commitment & Final CTA
        $this->assertStringContainsString('NGUYÊN TẮC HỢP TÁC', $content);
        $this->assertStringContainsString('Sẵn Sàng Triển Khai Hệ Thống Số Cho Doanh Nghiệp?', $content);
    }
}
