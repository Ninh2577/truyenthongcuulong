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
        $mediaServices = Service::where('group', 'media')->orderBy('order')->get();
        $techServices = Service::where('group', 'technology')->orderBy('order')->get();

        return view('services.index', compact('mediaServices', 'techServices'));
    }

    public function webApp(): View
    {
        $service = Service::where('slug', 'thiet-ke-website-chuyen-nghiep')->first();
        $techCaseStudies = CaseStudy::where('group', 'technology')->orderBy('order')->take(4)->get();
        if ($techCaseStudies->isEmpty()) {
            $techCaseStudies = CaseStudy::orderBy('order')->take(4)->get();
        }
        $featuredTemplates = Post::with('category')
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'template-website');
            })
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        return view('services.web-app', compact('service', 'techCaseStudies', 'featuredTemplates'));
    }

    public function media(): View
    {
        $service = Service::where('slug', 'san-xuat-video-media')->first();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
        if ($mediaCaseStudies->isEmpty()) {
            $mediaCaseStudies = CaseStudy::orderBy('order')->take(6)->get();
        }

        return view('services.media', compact('service', 'mediaCaseStudies'));
    }

    public function marketing(): View
    {
        $service = Service::where('slug', 'digital-marketing-quang-cao')->first();
        $marketingCaseStudies = CaseStudy::orderBy('order')->take(4)->get();

        return view('services.marketing', compact('service', 'marketingCaseStudies'));
    }

    public function show(string $slug): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        // Redirect legacy service slugs to new dedicated routes if matched
        if ($slug === 'thiet-ke-website-chuyen-nghiep' || $slug === 'web-app') {
            return redirect()->route('services.web-app', [], 301);
        }
        if ($slug === 'san-xuat-video-media' || $slug === 'media') {
            return redirect()->route('services.media', [], 301);
        }
        if ($slug === 'digital-marketing-quang-cao' || $slug === 'marketing') {
            return redirect()->route('services.marketing', [], 301);
        }

        $service = Service::where('slug', $slug)->firstOrFail();
        $otherServices = Service::where('id', '!=', $service->id)->take(4)->get();

        return view('services.show', compact('service', 'otherServices'));
    }
}