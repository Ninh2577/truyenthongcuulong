<?php

namespace Tests\Feature;

use App\Models\Menu;
use Database\Seeders\MenuSeeder;
use Tests\TestCase;

class SolutionArchitectureTest extends TestCase
{
    protected array $routes = [
        'services.hub' => '/dich-vu',
        'services.web-app' => '/dich-vu/web-app',
        'templates.index' => '/dich-vu/kho-giao-dien',
        'pricing' => '/dich-vu/bang-gia',
        'services.marketing' => '/dich-vu/marketing',
        'services.media' => '/dich-vu/media',
        'services.booking' => '/dich-vu/booking',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        if (Menu::where('location', 'header')->count() === 0) {
            $this->seed(MenuSeeder::class);
        }
    }

    /**
     * 1. Test all 7 Solution & Service routes return HTTP 200 OK.
     */
    public function test_all_seven_solution_routes_return_ok_status(): void
    {
        foreach ($this->routes as $name => $uri) {
            $response = $this->get($uri);
            $this->assertEquals(
                200,
                $response->getStatusCode(),
                "Route [{$name}] at URI '{$uri}' failed to return HTTP 200 OK."
            );
        }
    }

    /**
     * 2. Test strictly one H1 tag per page across all 7 routes.
     */
    public function test_each_solution_page_has_strictly_one_h1(): void
    {
        foreach ($this->routes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            $h1Count = preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $html);
            $this->assertEquals(
                1,
                $h1Count,
                "Route [{$name}] at '{$uri}' must have strictly one <h1> tag. Found: {$h1Count}"
            );
        }
    }

    /**
     * 3. Test breadcrumbs exist and are structured across all 7 routes.
     */
    public function test_each_solution_page_has_breadcrumb_navigation(): void
    {
        foreach ($this->routes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            $hasBreadcrumb = (strpos($html, 'aria-label="Breadcrumb"') !== false || strpos($html, 'aria-label="breadcrumb"') !== false);
            $this->assertTrue(
                $hasBreadcrumb,
                "Route [{$name}] at '{$uri}' must render an accessible breadcrumb navigation."
            );
        }
    }

    /**
     * 4. Test each solution page has primary CTA pointing to /lien-he.
     */
    public function test_each_solution_page_has_primary_cta_pointing_to_contact(): void
    {
        foreach ($this->routes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();
            $hasContactLink = (strpos($html, '/lien-he') !== false || strpos($html, 'route(\'contact\')') !== false);
            $this->assertTrue(
                $hasContactLink,
                "Route [{$name}] at '{$uri}' must provide a clear CTA link pointing to /lien-he."
            );
        }
    }

    /**
     * 5. Test no banned/fake marketing claims in rendered text content.
     */
    public function test_no_prohibited_marketing_claims_in_solution_pages(): void
    {
        $bannedTerms = [
            '100%',
            '35%',
            '24/7',
            '24 giờ',
            '2 giờ',
            '1.2s',
            'Lighthouse 90+',
            'Lighthouse 98',
            'OWASP',
            '99.2%',
            '900+',
            '320+',
            '10+ năm',
            'hàng triệu users',
            'guaranteed',
            '48H',
            '48 giờ',
        ];

        foreach ($this->routes as $name => $uri) {
            $response = $this->get($uri);
            $html = $response->getContent();

            // Strip style and script tags to avoid CSS width:100% or JS false positives
            $textOnly = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $html);
            $textOnly = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $textOnly);
            $cleanText = strip_tags($textOnly);

            foreach ($bannedTerms as $term) {
                $this->assertFalse(
                    stripos($cleanText, $term) !== false,
                    "Route [{$name}] at '{$uri}' contains prohibited marketing claim '{$term}'."
                );
            }
        }
    }

    /**
     * 6. Test Service Hub displays Technology solutions first and Media support second.
     */
    public function test_service_hub_displays_technology_first_and_media_second(): void
    {
        $response = $this->get('/dich-vu');
        $html = $response->getContent();

        $techPos = strpos($html, 'id="tech-solutions"');
        $mediaPos = strpos($html, 'id="media-solutions"');

        $this->assertNotFalse($techPos, 'Service Hub must have #tech-solutions section.');
        $this->assertNotFalse($mediaPos, 'Service Hub must have #media-solutions section.');
        $this->assertTrue(
            $techPos < $mediaPos,
            'Service Hub must present Technology Solutions before Media Solutions in the DOM flow.'
        );
    }

    /**
     * 7. Test Web App flagship page renders real case studies and templates.
     */
    public function test_web_app_flagship_renders_case_studies_and_templates(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $html = $response->getContent();

        // Must link to real projects
        $this->assertStringContainsString('/du-an/', $html, 'Web App page must link to real Case Studies.');

        // Must link to templates
        $this->assertStringContainsString('/dich-vu/kho-giao-dien', $html, 'Web App page must link to template library.');
    }

    /**
     * 8. Test Pricing page has no external AOS or third-party blocking scripts.
     */
    public function test_pricing_page_has_no_external_aos_scripts(): void
    {
        $response = $this->get('/dich-vu/bang-gia');
        $html = $response->getContent();

        $this->assertStringNotContainsString('unpkg.com/aos', $html, 'Pricing page must not import external AOS library.');
        $this->assertStringNotContainsString('data-aos=', $html, 'Pricing page must not have data-aos attributes.');
    }
}
