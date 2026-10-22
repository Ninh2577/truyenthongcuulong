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
            ['loc' => $baseUrl . '/dich-vu/kho-giao-dien', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/tai-nguyen', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/ve-chung-toi', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/bang-gia', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/tuyen-dung', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/chinh-sach-bao-mat', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['loc' => $baseUrl . '/dieu-khoan-dich-vu', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['loc' => $baseUrl . '/ho-so-nang-luc', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/lien-he', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        $seenUrls = [];

        foreach ($staticRoutes as $r) {
            $seenUrls[$r['loc']] = true;
            $xml .= "  <url>\n    <loc>{$r['loc']}</loc>\n    <priority>{$r['priority']}</priority>\n    <changefreq>{$r['changefreq']}</changefreq>\n  </url>\n";
        }

        // Services
        foreach (Service::all() as $s) {
            $loc = $baseUrl . '/dich-vu/' . $s->slug;
            if (isset($seenUrls[$loc])) continue;
            $seenUrls[$loc] = true;
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <priority>0.8</priority>\n    <changefreq>weekly</changefreq>\n  </url>\n";
        }

        // Case studies
        foreach (CaseStudy::all() as $cs) {
            $loc = $baseUrl . '/du-an/' . $cs->slug;
            if (isset($seenUrls[$loc])) continue;
            $seenUrls[$loc] = true;
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <priority>0.8</priority>\n    <changefreq>weekly</changefreq>\n  </url>\n";
        }

        // Categories
        foreach (Category::where('is_industry_filter', false)->get() as $cat) {
            $loc = route('blog.resolve', $cat->slug);
            if (isset($seenUrls[$loc])) continue;
            $seenUrls[$loc] = true;
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <priority>0.7</priority>\n    <changefreq>weekly</changefreq>\n  </url>\n";
        }

        // Posts (Published only: Pillar Page & Landing Page priority 0.9 / weekly, Standard post priority 0.6 / monthly)
        foreach (Post::where('status', 'published')->orderByDesc('published_at')->get() as $p) {
            $loc = route('blog.resolve', $p->slug);
            if (isset($seenUrls[$loc])) continue;
            $seenUrls[$loc] = true;
            $lastmod = $p->updated_at ? $p->updated_at->toAtomString() : now()->toAtomString();
            $priority = ($p->isPillarPage() || $p->isLandingPage()) ? '0.9' : '0.6';
            $changefreq = ($p->isPillarPage() || $p->isLandingPage()) ? 'weekly' : 'monthly';
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n    <lastmod>{$lastmod}</lastmod>\n    <priority>{$priority}</priority>\n    <changefreq>{$changefreq}</changefreq>\n  </url>\n";
        }

        $xml .= "</urlset>";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }
}
