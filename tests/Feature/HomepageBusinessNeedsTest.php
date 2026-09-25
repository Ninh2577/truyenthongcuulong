<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageBusinessNeedsTest extends TestCase
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
    public function test_homepage_returns_http_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test 2: Business Needs section exists exactly once on the page.
     */
    public function test_business_needs_section_exists_exactly_once(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $count = substr_count($html, 'id="business-needs"');
        $this->assertEquals(1, $count, 'Section id="business-needs" must appear exactly once');
    }

    /**
     * Test 3: Section heading clearly frames the business problem approach.
     */
    public function test_section_heading_frames_business_problem(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('BẮT ĐẦU TỪ BÀI TOÁN DOANH NGHIỆP', $html);
        $this->assertStringContainsString('Bạn Đang Cần Giải Quyết Vấn Đề Gì?', $html);
    }

    /**
     * Test 4: Technology needs appear BEFORE Media need in DOM order.
     */
    public function test_technology_needs_appear_before_media_need(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="business-needs"');
        $this->assertNotFalse($start);
        $end = strpos($html, '</section>', $start);
        $sectionHtml = substr($html, $start, $end - $start + 10);

        $techPos = strpos($sectionHtml, 'BÀI TOÁN 01');
        $mediaPos = strpos($sectionHtml, '/dich-vu/media');

        $this->assertNotFalse($techPos, 'Technology Need 01 must exist');
        $this->assertNotFalse($mediaPos, 'Media need/link must exist');
        $this->assertLessThan($mediaPos, $techPos, 'Technology needs must appear BEFORE Media need');
    }

    /**
     * Test 5: Every business need links to an existing canonical service route.
     */
    public function test_every_business_need_links_to_canonical_route(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="business-needs"');
        $end = strpos($html, '</section>', $start);
        $sectionHtml = substr($html, $start, $end - $start + 10);

        $canonicalRoutes = [
            '/dich-vu/web-app',
            '/dich-vu/marketing',
            '/dich-vu/kho-giao-dien',
            '/dich-vu/media',
        ];

        foreach ($canonicalRoutes as $route) {
            $this->assertStringContainsString($route, $sectionHtml, "Canonical route {$route} must exist in business needs");
        }
    }

    /**
     * Test 6: No fake recommendation or quiz endpoints exist in the section.
     */
    public function test_no_fake_recommendation_routes(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="business-needs"');
        $end = strpos($html, '</section>', $start);
        $sectionHtml = substr($html, $start, $end - $start + 10);

        $disallowedRoutes = [
            '/api/solution-finder',
            '/api/recommend',
            '/solution-quiz',
            '/quiz',
        ];

        foreach ($disallowedRoutes as $route) {
            $this->assertStringNotContainsString($route, $sectionHtml, "Fake route {$route} must not exist");
        }
    }

    /**
     * Test 7: No fake services (e.g. standalone ERP, CRM, Mobile App, AI platform) presented.
     */
    public function test_no_fake_services_presented(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="business-needs"');
        $end = strpos($html, '</section>', $start);
        $sectionHtml = substr($html, $start, $end - $start + 10);

        $fakeServices = [
            'AI-powered enterprise platform',
            'ERP platform',
            'CRM system',
            'Mobile app ecosystem',
        ];

        foreach ($fakeServices as $fake) {
            $this->assertStringNotContainsStringIgnoringCase($fake, $sectionHtml, "Fake service {$fake} must not exist");
        }
    }

    /**
     * Test 8: No unverified numeric marketing claims in the section.
     */
    public function test_no_unverified_claims_in_business_needs(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="business-needs"');
        $end = strpos($html, '</section>', $start);
        $sectionHtml = substr($html, $start, $end - $start + 10);

        $disallowed = [
            '1\.2s',
            'Lighthouse 98',
            '100%\s*Source Code',
            '100%\s*mã nguồn độc quyền',
            '900\+\s*doanh nghiệp',
            '320\+\s*khách hàng',
            '99\.2%',
            '99\.98%',
            'OWASP AA',
            '500\+\s*projects',
            '99%\s*satisfaction',
        ];

        foreach ($disallowed as $pattern) {
            $this->assertDoesNotMatchRegularExpression(
                '/' . $pattern . '/i',
                $sectionHtml,
                "Business Needs must not contain unverified claim pattern: {$pattern}"
            );
        }
    }

    /**
     * Test 9: Accessibility attributes are valid (semantic <a>, headings, aria-hidden for icons).
     */
    public function test_accessibility_attributes_are_valid(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="business-needs"');
        $end = strpos($html, '</section>', $start);
        $sectionHtml = substr($html, $start, $end - $start + 10);

        // Section has an H2 heading
        $this->assertMatchesRegularExpression('/<h2[^>]*>[\s\S]*?<\/h2>/iu', $sectionHtml);

        // Cards have H3 headings (4 business needs cards)
        preg_match_all('/<h3[^>]*>[\s\S]*?<\/h3>/iu', $sectionHtml, $h3Matches);
        $this->assertCount(4, $h3Matches[0], 'Must have exactly 4 H3 headings for the 4 cards');

        // All links use <a> tags with focus-visible
        $this->assertStringContainsString('focus-visible:ring-2', $sectionHtml);
    }

    /**
     * Test 10: Business Needs section preserves Header (UI-04) and Hero (UI-05).
     */
    public function test_preserves_header_and_hero(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Header still exists with UI-04 contract
        $this->assertStringContainsString('aria-label="Menu chính"', $html);
        $this->assertStringContainsString('Technology &bull; Digital Solutions', $html);

        // Hero still exists with UI-05 contract
        $this->assertStringContainsString('id="hero-section"', $html);
        $this->assertStringContainsString('Giải Pháp Web, Web App', $html);

        // Business Needs comes after Hero in DOM order
        $heroPos = strpos($html, 'id="hero-section"');
        $needsPos = strpos($html, 'id="business-needs"');
        $this->assertLessThan($needsPos, $heroPos, 'Hero section must appear before Business Needs section');
    }
}
