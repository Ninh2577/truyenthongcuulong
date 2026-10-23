<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;

class TwoFactorChallenge
{
    /**
     * Handle an incoming request.
     * Enforces 2FA challenge for enrolled users during Grace Period,
     * and seamlessly transitions to Hard Enforcement onboarding when
     * TWO_FACTOR_HARD_ENFORCEMENT environment flag is enabled.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $panel = Filament::getCurrentPanel();
        $user = Filament::auth()->user();

        // If not authenticated, ensure two-factor-setup redirects to login immediately
        if (! $user) {
            if ($request->is('*/two-factor-setup') || $request->routeIs('*.two-factor.setup')) {
                return redirect()->to($panel?->getLoginUrl() ?? '/cuulongteam/login');
            }

            return $next($request);
        }

        // Security Guard: Chỉ super_admin, Admin, hoặc email admin gốc mới có quyền dùng 2FA
        $canManage2FA = $user->hasAnyRole(['super_admin', 'Admin']) || $user->email === 'admin@truyenthongcuulong.com';

        // Nếu KHÔNG PHẢI super_admin hoặc Admin: Hoàn toàn ẩn và cấm 2FA
        if (! $canManage2FA) {
            // Nếu người dùng quyền khác cố truy cập bất kỳ route 2FA nào -> redirect về dashboard
            if ($request->is('*/two-factor-*') || $request->routeIs('*.two-factor.*')) {
                return redirect()->to($panel?->getUrl() ?? '/cuulongteam');
            }

            // Bỏ qua toàn bộ luồng 2FA cho các vai trò khác (Biên tập viên, CSKH, ...)
            return $next($request);
        }

        $isHardEnforcement = (bool) config('auth.two_factor_hard_enforcement', false);

        // -------------------------------------------------------------
        // Case 1: User has NOT confirmed 2FA (Unenrolled / Pending Setup)
        // -------------------------------------------------------------
        if (! $user->hasEnabledTwoFactorAuthentication()) {
            // Under Grace Period (default), unenrolled admins access dashboard freely
            if (! $isHardEnforcement) {
                return $next($request);
            }

            // Under Hard Enforcement, unenrolled admins MUST complete onboarding setup
            // 1a. Exemption: Logout is always allowed
            if ($request->is('*/logout') || $request->is('logout') || $request->routeIs('*.auth.logout')) {
                return $next($request);
            }

            // 1b. Exemption: Setup onboarding route
            if ($request->is('*/two-factor-setup') || $request->routeIs('*.two-factor.setup')) {
                return $next($request);
            }

            // 1c. Exemption: Livewire setup components
            if ($request->is('livewire/*')) {
                $components = $request->json('components', []);
                foreach ($components as $component) {
                    $snapshot = json_decode($component['snapshot'] ?? '{}', true);
                    $componentName = $snapshot['memo']['name'] ?? '';
                    if ($componentName && ! in_array($componentName, [
                        'Stephenjude\FilamentTwoFactorAuthentication\Livewire\TwoFactorAuthentication',
                        'Stephenjude\FilamentTwoFactorAuthentication\Livewire\PasskeyAuthentication',
                    ])) {
                        abort(403, 'Two-factor authentication enrollment required.');
                    }
                }

                return $next($request);
            }

            // Block access to dashboard and admin resources; redirect to setup onboarding
            $setupUrl = $panel?->route('two-factor.setup') ?? url('/cuulongteam/two-factor-setup');

            return redirect()->guest($setupUrl);
        }

        // -------------------------------------------------------------
        // Case 2: User HAS confirmed 2FA and passed the challenge in this session
        // -------------------------------------------------------------
        if ($user->isTwoFactorChallengePassed() || (method_exists($user, 'passkeyAuthenticated') && $user->passkeyAuthenticated())) {
            return $next($request);
        }

        // -------------------------------------------------------------
        // Case 2b: Check Trusted Device token (7-day bypass)
        // -------------------------------------------------------------
        if (app(\App\Services\TrustedDeviceService::class)->validateDeviceToken($request, $user)) {
            $user->setTwoFactorChallengePassed();

            return $next($request);
        }

        // -------------------------------------------------------------
        // Case 3: User HAS confirmed 2FA, but challenge is pending in this session
        // -------------------------------------------------------------

        // 3a. Exemption: Logout
        if ($request->is('*/logout') || $request->is('logout') || $request->routeIs('*.auth.logout')) {
            return $next($request);
        }

        // 3b. Exemption: Challenge page
        if ($request->is('*/two-factor-challenge') || $request->routeIs('*.two-factor.challenge')) {
            return $next($request);
        }

        // 3c. Exemption: Recovery page
        if ($request->is('*/two-factor-recovery') || $request->routeIs('*.two-factor.recovery')) {
            return $next($request);
        }

        // 3d. Exemption: Passkey routes
        if ($request->is('*/passkeys/*') || $request->routeIs('*.passkeys.*')) {
            return $next($request);
        }

        // 3e. Exemption: Livewire Challenge and Recovery components
        if ($request->is('livewire/*')) {
            $components = $request->json('components', []);
            foreach ($components as $component) {
                $snapshot = json_decode($component['snapshot'] ?? '{}', true);
                $componentName = $snapshot['memo']['name'] ?? '';
                if ($componentName && ! in_array($componentName, [
                    'Stephenjude\FilamentTwoFactorAuthentication\Pages\Challenge',
                    'App\Filament\Pages\Auth\CustomTwoFactorChallenge',
                    'Stephenjude\FilamentTwoFactorAuthentication\Pages\Recovery',
                ])) {
                    abort(403, 'Two-factor authentication challenge required.');
                }
            }

            return $next($request);
        }

        // Redirect to challenge page
        $challengeUrl = $panel?->route('two-factor.challenge')
            ?? url('/cuulongteam/two-factor-challenge');

        return redirect()->guest($challengeUrl);
    }
}
