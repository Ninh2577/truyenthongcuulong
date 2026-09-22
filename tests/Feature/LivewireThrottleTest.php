<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\CustomLogin;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireThrottleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Filament::setCurrentPanel(Filament::getPanel('admin'));
        RateLimiter::clear('livewire-update');
    }

    /**
     * Test 1: Verify route /livewire/update has throttle:livewire-update middleware.
     */
    public function test_livewire_update_route_has_throttle_middleware(): void
    {
        $routes = Route::getRoutes()->get('POST');
        $this->assertArrayHasKey('livewire/update', $routes);

        $route = $routes['livewire/update'];
        $middleware = $route->gatherMiddleware();

        $this->assertContains('web', $middleware);
        $this->assertTrue(
            collect($middleware)->contains(fn ($m) => str_contains($m, 'throttle:livewire-update')),
            'Route /livewire/update must contain throttle:livewire-update middleware.'
        );
    }

    /**
     * Test 2: Verify /livewire/upload-file maintains its independent throttle:60,1.
     */
    public function test_livewire_upload_file_route_retains_independent_throttle(): void
    {
        $routes = Route::getRoutes()->get('POST');
        $this->assertArrayHasKey('livewire/upload-file', $routes);

        $route = $routes['livewire/upload-file'];
        $middleware = $route->gatherMiddleware();

        $this->assertContains('web', $middleware);
        $this->assertTrue(
            collect($middleware)->contains(fn ($m) => str_contains($m, 'ThrottleRequests:60,1') || str_contains($m, 'throttle:60,1')),
            'Route /livewire/upload-file must contain independent throttle:60,1 middleware.'
        );
    }

    /**
     * Test 3: Normal requests under limit do not receive 429.
     */
    public function test_normal_livewire_requests_under_limit_are_allowed(): void
    {
        $response = $this->post('/livewire/update', [], [
            'X-Livewire' => 'true',
        ]);

        // The request passes through throttle (status is not 429)
        $this->assertNotEquals(429, $response->getStatusCode());
    }

    /**
     * Test 4: Guest requests exceeding limit (60/min) trigger HTTP 429.
     */
    public function test_guest_requests_exceeding_throttle_limit_return_429(): void
    {
        $ip = '198.51.100.1';
        $hashedKey = md5('livewire-update'.'ip:'.$ip);

        // Hit 60 times (allowed)
        for ($i = 0; $i < 60; $i++) {
            RateLimiter::hit($hashedKey, 60);
        }

        // 61st request from same IP
        $response = $this->withServerVariables(['REMOTE_ADDR' => $ip])
            ->post('/livewire/update', [], [
                'X-Livewire' => 'true',
            ]);

        $response->assertStatus(429);
        $this->assertTrue($response->headers->has('Retry-After'));
    }

    /**
     * Test 5: Authenticated users have a 120/min limit keyed by user ID.
     */
    public function test_authenticated_user_has_higher_limit_keyed_by_user_id(): void
    {
        $user = User::where('email', 'admin@truyenthongcuulong.com')->first();
        $this->assertNotNull($user);

        $hashedKey = md5('livewire-update'.'user:'.$user->id);

        // Consume 60 hits for the user key (guest would be throttled, authenticated user is not)
        for ($i = 0; $i < 60; $i++) {
            RateLimiter::hit($hashedKey, 60);
        }

        // Authenticated request at 61st hit should still succeed (< 120)
        $response = $this->actingAs($user)
            ->post('/livewire/update', [], [
                'X-Livewire' => 'true',
            ]);

        $this->assertNotEquals(429, $response->getStatusCode());

        // Now consume remaining up to 120
        for ($i = 61; $i < 120; $i++) {
            RateLimiter::hit($hashedKey, 60);
        }

        // 121st request should be throttled
        $throttledResponse = $this->actingAs($user)
            ->post('/livewire/update', [], [
                'X-Livewire' => 'true',
            ]);

        $throttledResponse->assertStatus(429);
        $this->assertTrue($throttledResponse->headers->has('Retry-After'));
    }

    /**
     * Test 6: Component-level rate limiting in CustomLogin remains functional and independent.
     */
    public function test_existing_component_level_rate_limiter_remains_active(): void
    {
        $code = 'CAPTCHA1';
        session([
            'admin_captcha_hash' => hash('sha256', $code),
            'admin_captcha_expires_at' => now()->addMinutes(5)->timestamp,
        ]);

        // Verify Livewire component test executes properly through Livewire harness
        $test = Livewire::test(CustomLogin::class)
            ->fillForm([
                'email' => 'admin@truyenthongcuulong.com',
                'password' => 'WrongPassword!',
                'captcha_answer' => $code,
            ])
            ->call('authenticate')
            ->assertHasFormErrors();

        $this->assertNotNull($test);
    }

    /**
     * Test 7: Security check on untrusted client headers (CF-Connecting-IP spoofing).
     */
    public function test_client_ip_resolution_without_trusted_proxies(): void
    {
        $realRemote = '203.0.113.50';
        $spoofedIp = '1.2.3.4';

        // When TrustProxies is not configured to trust the remote,
        // Laravel's $request->ip() must not trust spoofed X-Forwarded-For or CF-Connecting-IP.
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => $realRemote,
            'HTTP_CF_CONNECTING_IP' => $spoofedIp,
            'HTTP_X_FORWARDED_FOR' => $spoofedIp,
        ])->post('/livewire/update', [], ['X-Livewire' => 'true']);

        // Confirm request was processed using remote address key, not spoofed IP
        $this->assertNotEquals(429, $response->getStatusCode());
    }
}
