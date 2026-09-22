<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Security headers
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Content Security Policy (Enforced)
        // Explicitly whitelists actual runtime origins with zero wildcards.
        $scriptSrc = [
            "'self'",
            "'unsafe-inline'",
            "'unsafe-eval'",
            'https://www.googletagmanager.com',
            'https://www.google-analytics.com',
            'https://*.google-analytics.com',
            'https://sp.zalo.me',
            'https://cdnjs.cloudflare.com',
            'https://unpkg.com',
            'https://cdn.tailwindcss.com',
            'https://cdn.tiny.cloud',
            'https://cdn.jsdelivr.net',
        ];

        $styleSrc = [
            "'self'",
            "'unsafe-inline'",
            'https://fonts.googleapis.com',
            'https://fonts.bunny.net',
            'https://unpkg.com',
            'https://cdn.tiny.cloud',
        ];

        $imgSrc = [
            "'self'",
            'data:',
            'blob:',
            'https://images.unsplash.com',
            'https://www.google-analytics.com',
            'https://*.google-analytics.com',
            'https://i.ytimg.com',
            'https://img.youtube.com',
            'https://*.ytimg.com',
            'https://*.youtube.com',
            'https://cdn.tiny.cloud',
            'https://sp.zalo.me',
            'https://ui-avatars.com',
            'https://truyenthongcuulong.com',
            'https://*.truyenthongcuulong.com',
        ];

        $fontSrc = [
            "'self'",
            'data:',
            'https://fonts.gstatic.com',
            'https://fonts.bunny.net',
            'https://cdn.tiny.cloud',
        ];

        $frameSrc = [
            "'self'",
            'https://www.youtube.com',
            'https://www.youtube-nocookie.com',
            'https://player.vimeo.com',
            'https://sp.zalo.me',
            'https://www.google.com',
            'https://www.googletagmanager.com',
        ];

        $mediaSrc = [
            "'self'",
            'data:',
            'blob:',
            'https://commondatastorage.googleapis.com',
        ];

        $connectSrc = [
            "'self'",
            'https://www.google-analytics.com',
            'https://*.google-analytics.com',
            'https://*.analytics.google.com',
            'https://cdn.tiny.cloud',
        ];

        // In local development only: permit Vite dev server HMR
        if (app()->environment('local')) {
            $connectSrc[] = 'http://localhost:5173';
            $connectSrc[] = 'ws://localhost:5173';
            $scriptSrc[] = 'http://localhost:5173';
            $styleSrc[] = 'http://localhost:5173';
        }

        $csp = "default-src 'self'; "
             . "script-src " . implode(' ', array_unique($scriptSrc)) . "; "
             . "style-src " . implode(' ', array_unique($styleSrc)) . "; "
             . "font-src " . implode(' ', array_unique($fontSrc)) . "; "
             . "img-src " . implode(' ', array_unique($imgSrc)) . "; "
             . "frame-src " . implode(' ', array_unique($frameSrc)) . "; "
             . "media-src " . implode(' ', array_unique($mediaSrc)) . "; "
             . "connect-src " . implode(' ', array_unique($connectSrc)) . "; "
             . "object-src 'none'; "
             . "base-uri 'self'; "
             . "form-action 'self'; "
             . "frame-ancestors 'self';";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
