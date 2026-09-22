<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Facades\Filament;
use Tests\TestCase;

class ContentSecurityPolicyTest extends TestCase
{
    /**
     * Test CSP is enforced and contains all mandatory hardened directives.
     */
    public function test_csp_header_is_enforced_and_hardened_on_homepage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Must NOT be report-only
        $this->assertFalse($response->headers->has('Content-Security-Policy-Report-Only'));
        $this->assertTrue($response->headers->has('Content-Security-Policy'));

        $csp = $response->headers->get('Content-Security-Policy');

        // Check essential directives
        $this->assertStringContainsString("default-src 'self'", $csp);
        $this->assertStringContainsString("object-src 'none'", $csp);
        $this->assertStringContainsString("base-uri 'self'", $csp);
        $this->assertStringContainsString("form-action 'self'", $csp);
        $this->assertStringContainsString("frame-ancestors 'self'", $csp);

        // Check required runtime origins
        $this->assertStringContainsString("https://images.unsplash.com", $csp);
        $this->assertStringContainsString("https://www.google.com", $csp);
        $this->assertStringContainsString("https://www.youtube.com", $csp);
        $this->assertStringContainsString("https://img.youtube.com", $csp);
        $this->assertStringContainsString("https://fonts.googleapis.com", $csp);
        $this->assertStringContainsString("https://fonts.gstatic.com", $csp);
        $this->assertStringContainsString("https://commondatastorage.googleapis.com", $csp);
        $this->assertStringContainsString("https://cdn.tiny.cloud", $csp);

        // Must NOT contain insecure wildcards
        $this->assertStringNotContainsString("wss://*", $csp);
        $this->assertStringNotContainsString("connect-src *", $csp);
        $this->assertStringNotContainsString("script-src *", $csp);
    }

    /**
     * Test security headers baseline is delivered on admin login page.
     */
    public function test_security_headers_on_admin_login(): void
    {
        $response = $this->get('/cuulongteam/login');

        $response->assertStatus(200);
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->assertHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $this->assertTrue($response->headers->has('Content-Security-Policy'));
    }

    /**
     * Test CSP on authenticated admin dashboard.
     */
    public function test_csp_on_admin_dashboard(): void
    {
        $admin = User::where('email', 'admin@truyenthongcuulong.com')->first();
        $admin->setTwoFactorChallengePassed();
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        $response = $this->actingAs($admin)->get('/cuulongteam');

        $response->assertStatus(200);
        $this->assertTrue($response->headers->has('Content-Security-Policy'));
        $csp = $response->headers->get('Content-Security-Policy');

        $this->assertStringContainsString("default-src 'self'", $csp);
        $this->assertStringContainsString("object-src 'none'", $csp);
        $this->assertStringContainsString("frame-ancestors 'self'", $csp);
    }

    /**
     * Test that production environment removes dev server origins.
     */
    public function test_production_environment_excludes_dev_servers(): void
    {
        // Mock production environment
        $this->app['env'] = 'production';

        $response = $this->get('/');
        $csp = $response->headers->get('Content-Security-Policy');

        $this->assertStringNotContainsString('http://localhost:5173', $csp);
        $this->assertStringNotContainsString('ws://localhost:5173', $csp);
    }
}
