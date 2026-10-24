<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(Request $request)
    {
        $query = CaseStudy::query();

        $group = $request->input('group', 'all');
        if ($group === 'media') {
            return $this->media($request);
        }
        if (in_array($group, ['website', 'web', 'tech'])) {
            $group = 'technology';
        }
        if ($group && in_array($group, ['media', 'technology'])) {
            $query->where('group', $group);
        }

        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                    ->orWhere('client_name', 'like', "%{$s}%")
                    ->orWhere('content', 'like', "%{$s}%");
            });
        }

        $caseStudies = $query->orderBy('order')->paginate(9)->withQueryString();
        $counts = \Illuminate\Support\Facades\Cache::remember('casestudy_counts', 86400, function () {
            return [
                'total' => CaseStudy::count(),
                'media' => CaseStudy::where('group', 'media')->count(),
                'tech' => CaseStudy::where('group', 'technology')->count(),
            ];
        });
        $totalCount = $counts['total'];
        $mediaCount = $counts['media'];
        $techCount = $counts['tech'];

        return view('projects.index', compact('caseStudies', 'group', 'totalCount', 'mediaCount', 'techCount'));
    }

    public function media(Request $request)
    {
        $categories = \App\Models\Category::where('slug', 'abc')
            ->orWhere('name', 'Download Center')
            ->get();
        $categoryIds = $categories->pluck('id');

        $mediaPosts = \App\Models\Post::with('category')
            ->whereIn('category_id', $categoryIds)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->get();

        return view('projects.media', compact('mediaPosts', 'categories'));
    }

    public function show(string $slug)
    {
        $caseStudy = CaseStudy::where('slug', $slug)->first();
        
        if ($caseStudy) {
            // Tăng lượt xem thực tế của dự án
            try {
                $caseStudy->increment('views');
            } catch (\Throwable $e) {
                // Ignore if column is updating
            }

            if ($caseStudy->group === 'media') {
                return redirect()->to(url('/du-an/media#' . $caseStudy->slug));
            }

            return redirect()->to(route('projects.index') . '#' . $caseStudy->slug);
        }

        return redirect()->route('projects.index');
    }
}