<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiRebuild13BookingBannerTest extends TestCase
{
    /**
     * Test 1: Booking route returns HTTP 200.
     */
    public function test_booking_route_returns_http_200(): void
    {
        $response = $this->get('/dich-vu/booking');
        $response->assertStatus(200);
    }

    /**
     * Test 2: Booking page has strictly single H1 with semantic messaging.
     */
    public function test_booking_page_has_strictly_single_h1(): void
    {
        $response = $this->get('/dich-vu/booking');
        $content = $response->getContent();

        $h1Count = preg_match_all('/<h1[^>]*>([\s\S]*?)<\/h1>/iu', $content, $matches);
        $this->assertEquals(1, $h1Count, "Trang booking chỉ được có duy nhất 1 thẻ <h1>. Tìm thấy: {$h1Count}");

        $rawH1 = html_entity_decode(strip_tags($matches[1][0]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $h1Text = preg_replace('/\s+/u', ' ', trim($rawH1));

        $this->assertStringContainsString('Điều Phối Ekip Media', $h1Text);
        $this->assertStringContainsString('Theo Nhu Cầu Doanh Nghiệp', $h1Text);
    }

    /**
     * Test 3: Hero banner renders correctly with service-split variant and real asset.
     */
    public function test_hero_banner_renders_with_real_asset_and_lcp(): void
    {
        $response = $this->get('/dich-vu/booking');
        $content = $response->getContent();

        $this->assertStringContainsString('real-cameraman-production.jpg', $content);
        $this->assertStringContainsString('aspect-[16/10]', $content);
        $this->assertStringContainsString('fetchpriority="high"', $content);
        $this->assertStringContainsString('loading="eager"', $content);
        $this->assertStringContainsString('ON-DEMAND PRODUCTION CREW', $content);
    }

    /**
     * Test 4: Breadcrumb renders semantic navigation.
     */
    public function test_breadcrumb_navigation_rendered(): void
    {
        $response = $this->get('/dich-vu/booking');
        $content = $response->getContent();

        $this->assertStringContainsString('aria-label="Breadcrumb"', $content);
        $this->assertStringContainsString('Dịch vụ &amp; Giải pháp', $content);
        $this->assertStringContainsString('Điều phối ekip Media', $content);
    }

    /**
     * Test 5: Hero CTAs have valid destinations.
     */
    public function test_hero_ctas_have_valid_destinations(): void
    {
        $response = $this->get('/dich-vu/booking');
        $response->assertSee('#booking-form');
        $response->assertSee(route('services.media'));
    }

    /**
     * Test 6: Booking form has all required business fields and CSRF protection.
     */
    public function test_booking_form_has_all_required_fields(): void
    {
        $response = $this->get('/dich-vu/booking');
        $content = $response->getContent();

        $this->assertStringContainsString('action="' . route('contact.submit') . '"', $content);
        $this->assertStringContainsString('method="POST"', $content);
        $this->assertStringContainsString('name="_token"', $content);
        $this->assertStringContainsString('name="service_interested"', $content);
        $this->assertStringContainsString('value="booking-media"', $content);
        $this->assertStringContainsString('name="message"', $content);
        $this->assertStringContainsString('name="fullname"', $content);
        $this->assertStringContainsString('name="phone"', $content);
        $this->assertStringContainsString('name="crew_choice"', $content);
        $this->assertStringContainsString('id="booking-form"', $content);
    }

    /**
     * Test 7: Booking form submission flow through contact.submit endpoint.
     */
    public function test_booking_form_submission_flow(): void
    {
        // Missing required fields triggers validation error
        $invalidResponse = $this->post(route('contact.submit'), [
            'fullname' => '',
            'phone' => '',
        ]);
        $invalidResponse->assertSessionHasErrors(['fullname', 'phone']);

        // Valid booking payload succeeds
        $validResponse = $this->post(route('contact.submit'), [
            'fullname' => 'Doanh Nghiệp Test',
            'phone' => '0939123456',
            'service_interested' => 'booking-media',
            'message' => '[ĐIỀU PHỐI EKIP] Nhu cầu: Ekip Quay Phim | Ngày tác nghiệp: 2026-10-15 | Địa điểm: Cần Thơ | Ghi chú: Sự kiện khai trương',
        ]);
        $validResponse->assertSessionHas('success');
    }

    /**
     * Test 8: Bottom conversion CTA banner is rendered with phone and contact link.
     */
    public function test_bottom_cta_banner_rendered_with_valid_links(): void
    {
        $response = $this->get('/dich-vu/booking');
        $content = $response->getContent();

        $this->assertStringContainsString('tel:0939363262', $content);
        $this->assertStringContainsString(route('contact'), $content);
        $this->assertStringContainsString('Cần Điều Phối Ekip Khẩn Cấp Hoặc Tư Vấn Trực Tiếp?', $content);
    }

    /**
     * Test 9: Content safety — no unverified claims or fake guarantees.
     */
    public function test_content_safety_no_prohibited_claims(): void
    {
        $prohibitedTerms = [
            'rẻ nhất việt nam',
            'số 1 miền tây',
            'cam kết có mặt trong 5 phút',
            'bảo mật tuyệt đối 100%',
            'hoàn hảo nhất',
        ];

        $response = $this->get('/dich-vu/booking');
        $content = mb_strtolower($response->getContent(), 'UTF-8');

        foreach ($prohibitedTerms as $term) {
            $this->assertStringNotContainsString(
                $term,
                $content,
                "Trang booking không được chứa tuyên bố chưa xác minh: '{$term}'"
            );
        }
    }
}
