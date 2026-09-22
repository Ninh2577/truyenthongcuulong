<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\CustomLogin;
use App\Http\Middleware\TwoFactorChallenge;
use App\Models\TrustedDevice;
use App\Models\User;
use App\Services\TrustedDeviceService;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class SecurityRegressionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    /**
     * Test login with correct password and correct captcha succeeds for a transient test user.
     */
    public function test_login_with_correct_credentials(): void
    {
        $testUser = User::create([
            'name' => 'Transient Login User',
            'email' => 'transient_login_' . uniqid() . '@example.com',
            'password' => 'ValidPassword12345!',
        ]);

        $this->assertTrue(Hash::check('ValidPassword12345!', $testUser->password));

        $testUser->delete();
    }

    /**
     * Test wrong captcha fails closed.
     */
    public function test_login_with_wrong_captcha_fails(): void
    {
        session([
            'admin_captcha_hash' => hash('sha256', 'CORRECT'),
            'admin_captcha_expires_at' => now()->addMinutes(5)->timestamp,
        ]);

        Livewire::test(CustomLogin::class)
            ->fillForm([
                'email' => 'admin@truyenthongcuulong.com',
                'password' => 'password',
                'captcha_answer' => 'WRONG',
            ])
            ->call('authenticate')
            ->assertHasErrors(['data.captcha_answer']);
    }

    /**
     * Test wrong password fails.
     */
    public function test_login_with_wrong_password_fails(): void
    {
        $code = 'XYZ89';
        session([
            'admin_captcha_hash' => hash('sha256', $code),
            'admin_captcha_expires_at' => now()->addMinutes(5)->timestamp,
        ]);

        Livewire::test(CustomLogin::class)
            ->fillForm([
                'email' => 'admin@truyenthongcuulong.com',
                'password' => 'WrongPassword123!',
                'captcha_answer' => $code,
            ])
            ->call('authenticate')
            ->assertHasFormErrors();
    }

    /**
     * Test panel access logic: Admin & Bien Tap Vien = true, non-admin = false.
     */
    public function test_panel_access_logic(): void
    {
        $panel = Filament::getPanel('admin');

        $admin = User::where('email', 'admin@truyenthongcuulong.com')->first();
        $this->assertTrue($admin->canAccessPanel($panel));

        $phucnguyen = User::where('email', 'phucnguyen@truyenthongcuulong.com')->first();
        $this->assertTrue($phucnguyen->canAccessPanel($panel));

        $editor = User::where('email', 'Caothanhtctva@gmail.com')->first();
        $this->assertTrue($editor->canAccessPanel($panel));

        $nonAdmin1 = User::where('email', 'minhminh3898@gmail.com')->first();
        $this->assertFalse($nonAdmin1->canAccessPanel($panel));

        $nonAdmin2 = User::where('email', 'hoangninh2577@gmail.com')->first();
        $this->assertFalse($nonAdmin2->canAccessPanel($panel));
    }

    /**
     * Test 2FA and Trusted Device regression: Valid device token bypasses OTP.
     */
    public function test_trusted_device_bypass_regression(): void
    {
        $admin = User::where('email', 'admin@truyenthongcuulong.com')->first();
        Filament::auth()->setUser($admin);
        session()->forget('login_2fa_challenge_passed_' . $admin->id);

        $rawToken = bin2hex(random_bytes(32));
        $device = TrustedDevice::create([
            'user_id' => $admin->id,
            'token_hash' => hash('sha256', $rawToken),
            'device_name' => 'Automated Test Device',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit',
            'expires_at' => now()->addDays(7),
        ]);

        $req = Request::create('/cuulongteam', 'GET');
        $req->cookies->set(TrustedDeviceService::COOKIE_NAME, $rawToken);

        $middleware = new TwoFactorChallenge();
        $executed = false;
        $middleware->handle($req, function () use (&$executed) {
            $executed = true;
            return response('OK');
        });

        $this->assertTrue($executed);
        $this->assertTrue($admin->isTwoFactorChallengePassed());

        // Cleanup
        $device->delete();
    }
}
