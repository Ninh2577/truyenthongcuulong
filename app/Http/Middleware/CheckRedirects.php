<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = '/' . ltrim($request->path(), '/');

        // 1. Kiểm tra URL sitemap (WordPress cũ hoặc hệ thống sinh ra)
        if (preg_match('/(sitemap_index\.xml|sitemap\.xml|.*-sitemap.*\.xml)$/i', $path)) {
            // Option (a): Redirect mọi sitemap cũ về sitemap chính của Laravel
            if ($path !== '/sitemap.xml') {
                return redirect('/sitemap.xml', 301);
            }
            // Nếu đúng là /sitemap.xml, cho qua để SitemapController xử lý
            return $next($request);
        }

        // 2. Logic redirect từ CSDL cho các URL thông thường
        $redirect = Redirect::where('old_url', $path)
            ->orWhere('old_url', $path . '/')
            ->first();

        if ($redirect) {
            $redirect->increment('hits');
            return redirect($redirect->new_url, $redirect->status_code ?: 301);
        }

        return $next($request);
    }
}