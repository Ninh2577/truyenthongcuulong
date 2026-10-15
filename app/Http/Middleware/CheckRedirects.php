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

        // 2. Logic redirect từ CSDL cho các URL thông thường (Cached O(1) in-memory lookup)
        $cleanPath = '/' . trim($path, '/');
        $redirectsMap = \Illuminate\Support\Facades\Cache::remember('redirects_map', 86400, function () {
            try {
                $all = Redirect::select(['id', 'old_url', 'new_url', 'status_code'])->get();
                $map = [];
                foreach ($all as $item) {
                    $norm = '/' . trim($item->old_url, '/');
                    $map[$norm] = [
                        'id' => $item->id,
                        'new_url' => $item->new_url,
                        'status_code' => $item->status_code ?: 301,
                    ];
                }
                return $map;
            } catch (\Throwable $e) {
                return [];
            }
        });

        if (isset($redirectsMap[$cleanPath])) {
            $matched = $redirectsMap[$cleanPath];

            // Chuẩn hóa đích đến: loại bỏ tiền tố /tin-tuc/ hoặc /bai-viet/ vì chuẩn hiện tại là domain/{slug}
            $targetUrl = preg_replace('#^/(tin-tuc|bai-viet)/#', '/', $matched['new_url']);

            // Nếu đích đến trùng với URL hiện tại, bỏ qua để chống vòng lặp ERR_TOO_MANY_REDIRECTS
            if (rtrim($cleanPath, '/') === rtrim($targetUrl, '/')) {
                return $next($request);
            }

            if ($path !== rtrim($targetUrl, '/')) {
                try {
                    Redirect::where('id', $matched['id'])->increment('hits');
                } catch (\Throwable $e) {}

                $newUrl = $targetUrl;
                $queryString = $request->getQueryString();

                if (!empty($queryString)) {
                    $newUrl .= (str_contains($newUrl, '?') ? '&' : '?') . $queryString;
                }

                return redirect($newUrl, $matched['status_code']);
            }
        }

        return $next($request);
    }
}