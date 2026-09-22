<?php

namespace App\Services;

use App\Models\TrustedDevice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;

class TrustedDeviceService
{
    public const COOKIE_NAME = 'cuulong_admin_trusted_device';
    public const LIFETIME_DAYS = 7;
    public const MAX_ACTIVE_DEVICES = 10;

    /**
     * Trust the current device/browser for the given user for 7 days.
     * Generates a 256-bit CSPRNG token, stores only its SHA-256 hash in DB,
     * and queues an HttpOnly, SameSite=Lax cookie for the response.
     */
    public function trustCurrentDevice(User $user, ?string $deviceName = null): void
    {
        // 1. Generate 256-bit CSPRNG token (64 hex characters)
        $rawToken = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $rawToken);

        // 2. Limit active devices per user (revoke oldest if exceeding limit)
        $activeCount = TrustedDevice::where('user_id', $user->id)
            ->whereNull('revoked_at')
            ->where('expires_at', '>', now())
            ->count();

        if ($activeCount >= self::MAX_ACTIVE_DEVICES) {
            $oldest = TrustedDevice::where('user_id', $user->id)
                ->whereNull('revoked_at')
                ->orderBy('created_at', 'asc')
                ->first();

            $oldest?->update(['revoked_at' => now()]);
        }

        // 3. Absolute expiration: exactly 7 days from now
        $expiresAt = now()->addDays(self::LIFETIME_DAYS);

        // 4. Create database record
        TrustedDevice::create([
            'user_id'      => $user->id,
            'token_hash'   => $tokenHash,
            'device_name'  => $deviceName ? substr(strip_tags($deviceName), 0, 255) : null,
            'expires_at'   => $expiresAt,
            'last_used_at' => now(),
            'revoked_at'   => null,
        ]);

        // 5. Secure cookie flags
        $isSecure = request()->isSecure() || (app()->environment('production') && str_starts_with((string) config('app.url'), 'https://'));
        $minutes = self::LIFETIME_DAYS * 24 * 60; // 10080 minutes = 7 days

        Cookie::queue(Cookie::make(
            name: self::COOKIE_NAME,
            value: $rawToken,
            minutes: $minutes,
            path: '/',
            domain: config('session.domain'),
            secure: $isSecure,
            httpOnly: true,
            raw: false,
            sameSite: SymfonyCookie::SAMESITE_LAX
        ));
    }

    /**
     * Validate the trusted-device cookie for the authenticated user.
     * Enforces user binding, absolute expiry, revocation state, and active 2FA.
     * Fails closed on any discrepancy.
     */
    public function validateDeviceToken(Request $request, User $user): bool
    {
        try {
            // 1. Cookie existence and format check
            $rawToken = $request->cookie(self::COOKIE_NAME);
            if (! is_string($rawToken) || strlen($rawToken) !== 64 || ! ctype_xdigit($rawToken)) {
                return false;
            }

            // 2. User must currently have 2FA enabled
            if (! $user->hasEnabledTwoFactorAuthentication()) {
                return false;
            }

            // 3. Hash calculation and lookup bound to this specific user_id
            $tokenHash = hash('sha256', $rawToken);

            $device = TrustedDevice::where('user_id', $user->id)
                ->where('token_hash', $tokenHash)
                ->whereNull('revoked_at')
                ->where('expires_at', '>', now())
                ->first();

            if (! $device || ! $device->isValid()) {
                return false;
            }

            // 4. Update last_used_at metadata safely
            try {
                $device->update(['last_used_at' => now()]);
            } catch (\Throwable $e) {
                // Non-fatal metadata update failure should not block legitimate authentication
            }

            return true;
        } catch (\Throwable $e) {
            // Fail closed on any unexpected error
            return false;
        }
    }

    /**
     * Revoke all active trusted-device tokens for the given user.
     * Triggered on 2FA disable, secret rotation, or manual user request.
     */
    public function revokeAllForUser(User $user): int
    {
        return TrustedDevice::where('user_id', $user->id)
            ->whereNull('revoked_at')
            ->update(['revoked_at' => now()]);
    }

    /**
     * Revoke the current device's token and expire the cookie.
     */
    public function revokeCurrentDevice(Request $request, User $user): void
    {
        $rawToken = $request->cookie(self::COOKIE_NAME);
        if (is_string($rawToken) && strlen($rawToken) === 64) {
            $tokenHash = hash('sha256', $rawToken);
            TrustedDevice::where('user_id', $user->id)
                ->where('token_hash', $tokenHash)
                ->whereNull('revoked_at')
                ->update(['revoked_at' => now()]);
        }

        Cookie::queue(Cookie::forget(
            name: self::COOKIE_NAME,
            path: '/',
            domain: config('session.domain')
        ));
    }
}
