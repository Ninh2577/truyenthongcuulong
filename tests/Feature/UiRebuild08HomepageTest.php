<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Menu;
use App\Models\Post;
use Database\Seeders\CaseStudySeeder;
use Database\Seeders\MenuSeeder;
use Tests\TestCase;

class UiRebuild08HomepageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (Menu::where('location', 'header')->count() === 0) {
            $this->seed(MenuSeeder::class);
        }
        if (CaseStudy::count() === 0) {
            $this->seed(CaseStudySeeder::class);
        }
    }

    /**
     * Requirement 1: Trang chủ trả về HTTP 200.
     */
    public function test_homepage_returns_http_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Requirement 2: Trang chủ có đúng một H1.
     */
    public function test_homepage_has_strictly_one_h1(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        preg_match_all('/<h1[^>]*>[\s\S]*?<\/h1>/iu', $html, $matches);

        $this->assertCount(1, $matches[0], 'Homepage must contain strictly one <h1> heading.');

        // Verify H1 is technology-first and fits software company positioning
        $h1Text = strip_tags($matches[0][0]);
        $this->assertStringContainsString('Phát triển phần mềm', $h1Text);
        $this->assertStringContainsString('vận hành doanh nghiệp', $h1Text);
    }

    /**
     * Requirement 3: Typography sử dụng Mulish đồng nhất.
     */
    public function test_typography_uses_mulish_system(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Check Mulish font link or CSS root variable in output
        $this->assertMatchesRegularExpression('/Mulish/i', $html, 'Homepage must reference Mulish font family.');

        // Check CSS file directly for font token definition
        $cssContent = file_get_contents(resource_path('css/app.css'));
        $this->assertStringContainsString("'Mulish'", $cssContent, 'app.css must define Mulish as primary font token.');
    }

    /**
     * Requirement 4: CTA chính trỏ đến route hợp lệ.
     */
    public function test_primary_cta_points_to_valid_contact_route(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Hero Primary CTA
        $this->assertMatchesRegularExpression(
            '/<a\s+[^>]*href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án[\s\S]*?<\/a>/u',
            $html,
            'Hero must have primary CTA linking to /lien-he'
        );

        // Final Conversion Band CTA
        $this->assertStringContainsString('id="final-conversion-band"', $html);
        $this->assertMatchesRegularExpression(
            '/<section[^>]*id="final-conversion-band"[\s\S]*?<a\s+[^>]*href="[^"]*\/lien-he"[^>]*>[\s\S]*?Bắt đầu dự án[\s\S]*?<\/a>/u',
            $html,
            'Final conversion section must have primary CTA linking to /lien-he'
        );

        // Ensure /lien-he resolves with 200 OK
        $contactResponse = $this->get('/lien-he');
        $contactResponse->assertStatus(200);
    }

    /**
     * Requirement 5: Các dự án hiển thị lấy từ nguồn dữ liệu thực tế.
     */
    public function test_case_studies_render_from_real_database_records(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Real tech projects
        $response->assertSee('Ứng Dụng Quản Lý &amp; Đặt Lịch Phòng Khám Đa Khoa', false);
        $response->assertSee('Website Phòng Khám Đa Khoa Chuẩn WordPress', false);

        // Real clients
        $response->assertSee('Phòng Khám Gia Phước');
        $response->assertSee('Nha Khoa Nụ Cười');
    }

    /**
     * Requirement 6: Các bài viết nổi bật có liên kết hợp lệ.
     */
    public function test_featured_articles_have_valid_links(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('id="insights-section"', $html);

        // Match blog links in insights section
        preg_match_all('/<a\s+[^>]*href="([^"]*\/bai-viet\/[^"]+)"[^>]*>/u', $html, $matches);
        if (!empty($matches[1])) {
            $firstLink = $matches[1][0];
            $urlPath = parse_url($firstLink, PHP_URL_PATH);
            $articleResponse = $this->get($urlPath);
            $articleResponse->assertStatus(200);
        }
    }

    /**
     * Requirement 7: Không có liên kết rỗng (href="#") hoặc javascript:void(0).
     */
    public function test_no_dead_or_javascript_links_on_homepage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $this->assertDoesNotMatchRegularExpression(
            '/href="#"/i',
            $html,
            'Homepage must not contain empty or dead href="#" links.'
        );

        $this->assertDoesNotMatchRegularExpression(
            '/href="javascript:void\(0\)"/i',
            $html,
            'Homepage must not contain javascript:void(0) links.'
        );
    }

    /**
     * Requirement 8: Không phát sinh claim hoặc số liệu không có nguồn.
     */
    public function test_no_unverified_marketing_claims(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $prohibitedClaims = [
            '100%\s*hài\s*lòng',
            '100%\s*Mã\s*Nguồn',
            'Core\s*Web\s*Vitals\s*<\s*1s',
            'bảo\s*hành\s*trọn\s*đời',
            'tốc\s*độ\s*tải\s*<\s*1\.2s',
            'Điểm\s*Tuyệt\s*Đối\s*Google\s*Core\s*Web\s*Vitals',
            '#1\s*tại\s*Việt\s*Nam',
            'top\s*1\s*công\s*nghệ',
            '99\.99%\s*uptime',
        ];

        foreach ($prohibitedClaims as $pattern) {
            $this->assertDoesNotMatchRegularExpression(
                '/' . $pattern . '/iu',
                $html,
                "Homepage contains unverified claim matching pattern: {$pattern}"
            );
        }
    }

    /**
     * Requirement 9: Các section chính hiển thị đúng thứ tự đã triển khai.
     */
    public function test_main_sections_render_in_correct_hierarchy(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        $heroPos = strpos($html, 'id="hero-section"');
        $marqueePos = strpos($html, 'id="marquee-section"');
        $needsPos = strpos($html, 'id="business-needs"');
        $portfolioPos = strpos($html, 'id="portfolio-section"');
        $whyPos = strpos($html, 'id="why-clm"');
        $mediaPos = strpos($html, 'id="media-support"');
        $insightsPos = strpos($html, 'id="insights-section"');
        $finalCtaPos = strpos($html, 'id="final-conversion-band"');

        $this->assertNotFalse($heroPos, 'Hero section must exist.');
        $this->assertNotFalse($marqueePos, 'Marquee section must exist.');
        $this->assertNotFalse($needsPos, 'Business needs section must exist.');
        $this->assertNotFalse($portfolioPos, 'Portfolio section must exist.');
        $this->assertNotFalse($whyPos, 'Why CLM section must exist.');
        $this->assertNotFalse($mediaPos, 'Media support section must exist.');
        $this->assertNotFalse($insightsPos, 'Insights section must exist.');
        $this->assertNotFalse($finalCtaPos, 'Final CTA section must exist.');

        $this->assertLessThan($marqueePos, $heroPos, 'Hero must appear before Marquee');
        $this->assertLessThan($needsPos, $marqueePos, 'Marquee must appear before Business Needs');
        $this->assertLessThan($portfolioPos, $needsPos, 'Business Needs must appear before Portfolio Proof');
        $this->assertLessThan($whyPos, $portfolioPos, 'Portfolio Proof must appear before Why CLM');
        $this->assertLessThan($mediaPos, $whyPos, 'Why CLM must appear before Media Support');
        $this->assertLessThan($insightsPos, $mediaPos, 'Media Support must appear before Insights');
        $this->assertLessThan($finalCtaPos, $insightsPos, 'Insights must appear before Final Conversion Band');
    }

    /**
     * Requirement 10: Form hiện tại không bị mất hoặc thay đổi contract.
     */
    public function test_contact_form_contract_preserved(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // Footer consultation form
        $this->assertStringContainsString('action="' . route('contact.submit') . '"', $html);
        $this->assertStringContainsString('name="fullname"', $html);
        $this->assertStringContainsString('name="phone"', $html);
        $this->assertStringContainsString('name="_token"', $html);
    }
}
