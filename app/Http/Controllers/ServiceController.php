<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\Post;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $techServices = Service::where('group', 'technology')->orderBy('order')->get();
        $mediaServices = Service::where('group', 'media')->orderBy('order')->get();
        $techCaseStudies = CaseStudy::where('group', 'technology')->orderBy('order')->take(2)->get();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(4)->get();
        $templatesCount = Post::where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'template-website');
            })->count();

        return view('services.index', compact('techServices', 'mediaServices', 'techCaseStudies', 'mediaCaseStudies', 'templatesCount'));
    }

    public function webApp(): View
    {
        $service = Service::where('slug', 'thiet-ke-website')->orWhere('slug', 'thiet-ke-website-chuyen-nghiep')->first();
        $techCaseStudies = CaseStudy::where('group', 'technology')->orderBy('order')->take(2)->get();

        // 4 mẫu website thực tế từ database
        $preferredSlugs = [
            'mau-website-sach-van-phong-stationero',
            'mau-website-thoi-trang-stylista',
            'mau-website-o-to-xe-may-grand',
            'mau-website-noi-that-trang-tri-furnihaus',
        ];

        $featuredTemplates = Post::with('category')
            ->where('status', 'published')
            ->whereIn('slug', $preferredSlugs)
            ->get()
            ->sortBy(function ($post) use ($preferredSlugs) {
                return array_search($post->slug, $preferredSlugs);
            });

        if ($featuredTemplates->count() < 4) {
            $featuredTemplates = Post::with('category')
                ->where('status', 'published')
                ->whereHas('category', function ($q) {
                    $q->where('slug', 'template-website');
                })
                ->orderByDesc('published_at')
                ->take(4)
                ->get();
        }

        return view('services.web-app', compact('service', 'techCaseStudies', 'featuredTemplates'));
    }

    public function uiUx(): View
    {
        $service = Service::where('slug', 'thiet-ke-ui-ux')
            ->orWhere('slug', 'thiet-ke-website')
            ->first();
        $techCaseStudies = CaseStudy::where('group', 'technology')->orderBy('order')->take(3)->get();
        if ($techCaseStudies->isEmpty()) {
            $techCaseStudies = CaseStudy::orderBy('order')->take(3)->get();
        }

        return view('services.ui-ux', compact('service', 'techCaseStudies'));
    }

    public function automation(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('services.web-app', [], 301);
    }

    public function media(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('projects.media', [], 301);
    }

    public function marketing(): View
    {
        $service = Service::where('slug', 'digital-marketing-quang-cao')->first();
        $marketingCaseStudies = CaseStudy::orderBy('order')->take(4)->get();

        return view('services.marketing', compact('service', 'marketingCaseStudies'));
    }

    public function websiteCare(): View
    {
        $service = Service::where('slug', 'quan-tri-website')
            ->orWhere('slug', 'cham-soc-website')
            ->orWhere('slug', 'thiet-ke-website')
            ->first();
        $techCaseStudies = CaseStudy::where('group', 'technology')->orderBy('order')->take(3)->get();
        if ($techCaseStudies->isEmpty()) {
            $techCaseStudies = CaseStudy::orderBy('order')->take(3)->get();
        }

        return view('services.website-care', compact('service', 'techCaseStudies'));
    }

    public function eventPhotography(): View
    {
        $service = Service::where('slug', 'chup-anh-su-kien')
            ->orWhere('slug', 'dich-vu-chup-anh-su-kien')
            ->orWhere('slug', 'san-xuat-video-media')
            ->first();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
        if ($mediaCaseStudies->isEmpty()) {
            $mediaCaseStudies = CaseStudy::orderBy('order')->take(6)->get();
        }

        return view('services.event-photography', compact('service', 'mediaCaseStudies'));
    }

    public function eventVideography(): View
    {
        $service = Service::where('slug', 'quay-phim-su-kien')
            ->orWhere('slug', 'dich-vu-quay-phim-su-kien')
            ->orWhere('slug', 'san-xuat-video-media')
            ->first();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
        if ($mediaCaseStudies->isEmpty()) {
            $mediaCaseStudies = CaseStudy::orderBy('order')->take(6)->get();
        }

        return view('services.event-videography', compact('service', 'mediaCaseStudies'));
    }

    public function teambuildingPhotography(): View
    {
        $service = Service::where('slug', 'chup-anh-teambuilding')
            ->orWhere('slug', 'dich-vu-chup-anh-teambuilding')
            ->orWhere('slug', 'chup-anh-su-kien')
            ->first();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
        if ($mediaCaseStudies->isEmpty()) {
            $mediaCaseStudies = CaseStudy::orderBy('order')->take(6)->get();
        }

        return view('services.teambuilding-photography', compact('service', 'mediaCaseStudies'));
    }

    public function teambuildingVideography(): View
    {
        $service = Service::where('slug', 'quay-phim-teambuilding')
            ->orWhere('slug', 'dich-vu-quay-phim-teambuilding')
            ->orWhere('slug', 'quay-phim-su-kien')
            ->first();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
        if ($mediaCaseStudies->isEmpty()) {
            $mediaCaseStudies = CaseStudy::orderBy('order')->take(6)->get();
        }

        return view('services.teambuilding-videography', compact('service', 'mediaCaseStudies'));
    }

    public function flycam(): View
    {
        $service = Service::where('slug', 'quay-chup-flycam')
            ->orWhere('slug', 'dich-vu-quay-chup-flycam')
            ->orWhere('slug', 'flycam')
            ->first();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
        if ($mediaCaseStudies->isEmpty()) {
            $mediaCaseStudies = CaseStudy::orderBy('order')->take(6)->get();
        }

        return view('services.flycam', compact('service', 'mediaCaseStudies'));
    }

    public function show(string $slug): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        // 1. Kho giao diện / mẫu website
        if (in_array($slug, ['kho-giao-dien', 'mau-giao-dien', 'mau-website', 'web-demo', 'template-website', 'giao-dien'])) {
            return redirect()->route('templates.index', [], 301);
        }

        // 2. Thiết kế Website & Web App
        if (in_array($slug, ['thiet-ke-website', 'thiet-ke-web', 'web-app', 'thiet-ke-website-chuyen-nghiep', 'website'])) {
            return redirect()->route('services.web-app', [], 301);
        }

        // 3. UI/UX
        if (in_array($slug, ['ui-ux', 'thiet-ke-ui-ux'])) {
            return redirect()->route('services.ui-ux', [], 301);
        }

        // 4. Quản trị & Chăm sóc Website
        if (in_array($slug, ['quan-tri-website', 'cham-soc-website', 'cham-soc-web'])) {
            return redirect()->route('services.website-care', [], 301);
        }

        // 5. SEO & Marketing
        if (in_array($slug, ['seo', 'seo-can-tho', 'dich-vu-seo', 'dich-vu-seo-can-tho'])) {
            return redirect()->to('/dich-vu-seo-can-tho', 301);
        }
        if (in_array($slug, ['marketing', 'digital-marketing', 'digital-marketing-quang-cao', 'marketing-online', 'tu-van-marketing', 'quang-cao'])) {
            return redirect()->route('services.marketing', [], 301);
        }

        // 6. Quay chụp & Media
        if (in_array($slug, ['chup-anh-su-kien', 'dich-vu-chup-anh-su-kien'])) {
            return redirect()->route('services.event-photography', [], 301);
        }
        if (in_array($slug, ['chup-anh-teambuilding', 'dich-vu-chup-anh-teambuilding'])) {
            return redirect()->route('services.teambuilding-photography', [], 301);
        }
        if (in_array($slug, ['quay-phim-su-kien', 'dich-vu-quay-phim-su-kien'])) {
            return redirect()->route('services.event-videography', [], 301);
        }
        if (in_array($slug, ['quay-phim-teambuilding', 'dich-vu-quay-phim-teambuilding'])) {
            return redirect()->route('services.teambuilding-videography', [], 301);
        }
        if (in_array($slug, ['quay-chup-flycam', 'dich-vu-quay-chup-flycam', 'flycam'])) {
            return redirect()->route('services.flycam', [], 301);
        }
        if (in_array($slug, ['tu-dong-hoa', 'tu-dong-hoa-quy-trinh'])) {
            return redirect()->route('services.automation', [], 301);
        }
        if (in_array($slug, ['san-xuat-video-media', 'media'])) {
            return redirect()->route('services.media', [], 301);
        }
        if (in_array($slug, ['booking-media', 'booking'])) {
            return redirect()->route('booking', [], 301);
        }

        // 7. Check if Service exists in database
        $service = Service::where('slug', $slug)->first();
        if ($service) {
            $otherServices = Service::where('id', '!=', $service->id)->take(4)->get();
            return view('services.show', compact('service', 'otherServices'));
        }

        // 8. Check if slug matches a published Post (e.g. blog post / service article entered under /dich-vu/)
        $post = Post::where('slug', $slug)->where('status', 'published')->first();
        if ($post) {
            return redirect()->to('/' . $post->slug, 301);
        }

        // 9. Check if slug matches a Category
        $category = \App\Models\Category::where('slug', $slug)->first();
        if ($category) {
            return redirect()->to('/' . $category->slug, 301);
        }

        // 10. Check if slug matches a CaseStudy
        $caseStudy = CaseStudy::where('slug', $slug)->first();
        if ($caseStudy) {
            return redirect()->route('projects.show', $slug, 301);
        }

        // 11. Check MenuRouteResolver for any custom menu item URL
        $menuResult = \App\Services\MenuRouteResolver::resolve('/dich-vu/' . $slug) ?: \App\Services\MenuRouteResolver::resolve($slug);
        if ($menuResult) {
            return $menuResult;
        }

        abort(404);
    }

    public function booking(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('contact', [], 301);
    }
}