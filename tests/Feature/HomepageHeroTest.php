<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageHeroTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (\App\Models\Menu::where('location', 'header')->count() === 0) {
            $this->seed(\Database\Seeders\MenuSeeder::class);
        }
    }

    /**
     * Test 1: Homepage renders successfully with HTTP 200.
     */
    public function test_homepage_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test 2: Hero and page has exactly one <h1> element.
     */
    public function test_hero_has_exactly_one_h1(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $html, $matches);

        $this->assertCount(1, $matches[0], 'Homepage must contain strictly one <h1> heading.');
    }

    /**
     * Test 3: H1 and hero messaging clearly state Technology & Web/App first.
     */
    public function test_h1_and_hero_messaging_are_technology_first(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Extract H1 content
        preg_match('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $html, $h1Match);
        $this->assertNotEmpty($h1Match, 'H1 tag must exist');
        $h1Content = strip_tags($h1Match[1]);

        $this->assertStringContainsString('Giải Pháp Web, Web App', $h1Content);
        $this->assertStringContainsString('Hệ Thống Số Doanh Nghiệp', $h1Content);

        // Eyebrow check
        $this->assertStringContainsString('TECHNOLOGY &amp; DIGITAL SOLUTIONS', $html);
    }

    /**
     * Test 4: Primary CTA 'Bắt đầu dự án' points to canonical contact route (/lien-he).
     */
    public function test_primary_cta_contract_points_to_contact(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="hero-section"');
        $this->assertNotFalse($start, 'Hero section must exist');
        $end = strpos($html, '</section>', $start);
        $heroHtml = substr($html, $start, $end - $start + 10);

        // Check primary CTA in Hero
        $this->assertMatchesRegularExpression(
            '/<a\s+[^>]*href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án[\s\S]*?<\/a>/u',
            $heroHtml,
            'Primary CTA must link to /lien-he with label "Bắt đầu dự án"'
        );
        $this->assertStringContainsString('btn-primary-cta', $heroHtml);
    }

    /**
     * Test 5: Secondary CTA 'Xem giải pháp' points to canonical services route (/dich-vu).
     */
    public function test_secondary_cta_points_to_canonical_services(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="hero-section"');
        $end = strpos($html, '</section>', $start);
        $heroHtml = substr($html, $start, $end - $start + 10);

        $this->assertMatchesRegularExpression(
            '/<a\s+[^>]*href="[^"]*\/dich-vu"[^>]*>[\s\S]*?Xem giải pháp[\s\S]*?<\/a>/u',
            $heroHtml,
            'Secondary CTA must link to /dich-vu with label "Xem giải pháp"'
        );
        $this->assertStringContainsString('btn-secondary-cta', $heroHtml);
    }

    /**
     * Test 6: Hero does not contain unverified or exaggerated claims.
     */
    public function test_hero_does_not_contain_unverified_claims(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $start = strpos($html, 'id="hero-section"');
        $end = strpos($html, '</section>', $start);
        $heroHtml = substr($html, $start, $end - $start + 10);

        $disallowed = [
            '1\.2s',
            'Lighthouse 98',
            '100%\s*Source Code',
            '100%\s*mã nguồn độc quyền',
            '900\+\s*businesses',
            '900\+\s*doanh nghiệp',
            '320\+\s*clients',
            '320\+\s*khách hàng',
            '99\.2%',
            '99\.98%',
            'OWASP AA',
            '500\+\s*projects',
            '99%\s*satisfaction',
            '10\+\s*years',
            '\bBest\b',
            '\b#1\b',
        ];

        foreach ($disallowed as $pattern) {
            $this->assertDoesNotMatchRegularExpression(
                '/' . $pattern . '/i',
                $heroHtml,
                "Hero section must not contain unverified claim pattern: {$pattern}"
            );
        }
    }

    /**
     * Test 7: Media messaging is supporting capability, NOT primary headline.
     */
    public function test_hero_media_messaging_is_supporting_not_primary(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        preg_match('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $html, $h1Match);
        $h1Content = strip_tags($h1Match[1]);

        // H1 must NOT feature media words as primary subject
        $this->assertStringNotContainsString('Sản Xuất Video', $h1Content);
        $this->assertStringNotContainsString('TVC', $h1Content);
        $this->assertStringNotContainsString('Booking Ekip', $h1Content);

        // But supporting media capability can exist in supporting row/visual
        $start = strpos($html, 'id="hero-section"');
        $end = strpos($html, '</section>', $start);
        $heroHtml = substr($html, $start, $end - $start + 10);

        $this->assertStringContainsString('Media In-House Hỗ Trợ', $heroHtml);
    }

    /**
     * Test 8: Technology visual container has accessible region attributes and clean links.
     */
    public function test_technology_visual_and_accessibility_attributes(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $this->assertStringContainsString('role="region"', $html);
        $this->assertStringContainsString('aria-label="Giao diện giải pháp công nghệ số"', $html);
        $this->assertStringContainsString('39 Mẫu Website Có Sẵn', $html);
    }
}
