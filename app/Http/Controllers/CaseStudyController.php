<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(): View
    {
        $caseStudies = CaseStudy::orderBy('order')->paginate(9);
        return view('projects.index', compact('caseStudies'));
    }

    public function show(string $slug): View
    {
        $caseStudy = CaseStudy::where('slug', $slug)->firstOrFail();
        $relatedCases = CaseStudy::where('id', '!=', $caseStudy->id)->take(3)->get();

        return view('projects.show', compact('caseStudy', 'relatedCases'));
    }
}