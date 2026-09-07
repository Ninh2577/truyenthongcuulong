<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TemplateShowcaseController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with('category')
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'template-website');
            });

        // Filter by selected industry
        $selectedIndustry = $request->input('industry');
        if ($selectedIndustry) {
            $cat = Category::where('slug', $selectedIndustry)->first();
            $keyword = $cat ? $cat->name : $selectedIndustry;
            $query->where(function($q) use ($keyword, $selectedIndustry) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('slug', 'like', "%{$selectedIndustry}%")
                  ->orWhere('summary', 'like', "%{$keyword}%");
            });
        }

        // Search text
        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where('title', 'like', "%{$s}%");
        }

        $templates = $query->orderByDesc('published_at')->paginate(12)->withQueryString();
        $industries = Category::industryFilters()->get();

        return view('templates.index', compact('templates', 'industries', 'selectedIndustry'));
    }
}
