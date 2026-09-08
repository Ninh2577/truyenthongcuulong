<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(Request $request): View
    {
        $query = CaseStudy::query();

        $group = $request->input('group', 'all');
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
        $totalCount = CaseStudy::count();
        $mediaCount = CaseStudy::where('group', 'media')->count();
        $techCount = CaseStudy::where('group', 'technology')->count();

        return view('projects.index', compact('caseStudies', 'group', 'totalCount', 'mediaCount', 'techCount'));
    }

    public function show(string $slug): View
    {
        $caseStudy = CaseStudy::where('slug', $slug)->firstOrFail();
        $relatedCases = CaseStudy::where('id', '!=', $caseStudy->id)->take(3)->get();

        return view('projects.show', compact('caseStudy', 'relatedCases'));
    }
}