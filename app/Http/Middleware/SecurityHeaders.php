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

        // CSP in Report-Only mode
        // Whitelisting self, Google Fonts, YouTube, Vimeo, Zalo
        $csp = "default-src 'self'; "
             . "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://sp.zalo.me https://www.google-analytics.com; "
             . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
             . "font-src 'self' https://fonts.gstatic.com data:; "
             . "img-src 'self' data: https://www.google-analytics.com https://i.ytimg.com; "
             . "frame-src 'self' https://www.youtube.com https://player.vimeo.com https://sp.zalo.me; "
             . "connect-src 'self' wss://*;";

        $response->headers->set('Content-Security-Policy-Report-Only', $csp);

        return $response;
    }
}
