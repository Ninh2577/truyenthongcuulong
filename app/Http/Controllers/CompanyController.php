<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Post;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function partners(): View
    {
        $topPartners = \Illuminate\Support\Facades\Cache::remember('partners.top', 86400, function () {
            return \App\Models\Partner::active()->where('tier', 'top')->ordered()->get();
        });
        $goldPartners = \Illuminate\Support\Facades\Cache::remember('partners.gold', 86400, function () {
            return \App\Models\Partner::active()->where('tier', 'gold')->ordered()->get();
        });
        $strategicPartners = \Illuminate\Support\Facades\Cache::remember('partners.strategic', 86400, function () {
            return \App\Models\Partner::active()->where('tier', 'strategic')->ordered()->get();
        });

        return view('pages.partners', compact('topPartners', 'goldPartners', 'strategicPartners'));
    }

    public function clients(): View
    {
        $clients = \Illuminate\Support\Facades\Cache::remember('clients.all', 86400, function () {
            return \App\Models\Client::active()->ordered()->get();
        });
        
        return view('pages.clients', compact('clients'));
    }

    public function pricing(): View
    {
        $videoPlans = \Illuminate\Support\Facades\Cache::remember('pricing.tvc', 86400, function () {
            return \App\Models\PricingPlan::active()->where('service_group', 'tvc')->ordered()->get();
        });
        $webPlans = \Illuminate\Support\Facades\Cache::remember('pricing.web', 86400, function () {
            return \App\Models\PricingPlan::active()->where('service_group', 'web')->ordered()->get();
        });
        $marketingPlans = \Illuminate\Support\Facades\Cache::remember('pricing.marketing', 86400, function () {
            return \App\Models\PricingPlan::active()->where('service_group', 'marketing')->ordered()->get();
        });

        return view('pages.pricing', compact('videoPlans', 'webPlans', 'marketingPlans'));
    }

    public function careers(): View
    {
        $jobs = Post::where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'tuyen-dung')->orWhere('pillar_group', 'corporate');
            })
            ->orderByDesc('published_at')
            ->get();

        return view('pages.careers', compact('jobs'));
    }

    public function applyJob(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:100',
            'position' => 'required|string|max:150',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'cover_letter' => 'nullable|string|max:2000',
        ]);

        $path = $request->file('cv_file')->store('private/cv');

        JobApplication::create([
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'position' => $validated['position'],
            'cv_path' => $path,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Hồ sơ ứng tuyển của bạn đã được gửi thành công! Ban Nhân Sự Truyền Thông Cửu Long sẽ liên hệ phỏng vấn trong vòng 3 ngày làm việc.');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }
}
