<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Models\CaseStudy;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $baseUrl = url('/');

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        // Static pages
        $staticRoutes = [
            ['loc' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => $baseUrl . '/dich-vu', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/du-an', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/bai-viet', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => $baseUrl . '/ho-so-nang-luc', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/lien-he', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        foreach ($staticRoutes as $r) {
            $xml .= "  <url>\n    <loc>{$r['loc']}</loc>\n    <priority>{$r['priority']}</priority>\n    <changefreq>{$r['changefreq']}</changefreq>\n  </url>\n";
        }

        // Services
        foreach (Service::all() as $s) {
            $loc = $baseUrl . '/dich-vu/' . $s->slug;
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <priority>0.8</priority>\n    <changefreq>weekly</changefreq>\n  </url>\n";
        }

        // Case studies
        foreach (CaseStudy::all() as $cs) {
            $loc = $baseUrl . '/du-an/' . $cs->slug;
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <priority>0.8</priority>\n    <changefreq>weekly</changefreq>\n  </url>\n";
        }

        // Categories
        foreach (Category::all() as $cat) {
            $loc = $baseUrl . '/chuyen-muc/' . $cat->slug;
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <priority>0.7</priority>\n    <changefreq>weekly</changefreq>\n  </url>\n";
        }

        // Posts
        foreach (Post::where('status', 'published')->orderByDesc('published_at')->get() as $p) {
            $loc = $baseUrl . '/bai-viet/' . $p->slug;
            $lastmod = $p->updated_at ? $p->updated_at->toAtomString() : now()->toAtomString();
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <lastmod>{$lastmod}</lastmod>\n    <priority>0.6</priority>\n    <changefreq>monthly</changefreq>\n  </url>\n";
        }

        $xml .= "</urlset>";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }
}