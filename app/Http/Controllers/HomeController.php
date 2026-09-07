<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\Post;
use App\Models\Service;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $mediaServices = Service::where('group', 'media')->where('featured', true)->orderBy('order')->get();
        $techServices = Service::where('group', 'technology')->where('featured', true)->orderBy('order')->get();
        $caseStudies = CaseStudy::where('featured', true)->orderBy('order')->take(4)->get();
        $latestPosts = Post::with('category')->where('status', 'published')->orderByDesc('published_at')->take(6)->get();

        // Query các dự án sự kiện thật từ database cũ
        $clientProjects = Post::whereIn('id', [14068, 14064, 13905, 13902, 13886])->get();

        // Query các bài viết chuyên sâu về SEO & Thiết kế Web từ database cũ
        $featuredArticles = Post::whereIn('id', [19566, 3064, 19595])
            ->orWhere(function($query) {
                $query->where('title', 'LIKE', '%SEO Cần Thơ%')
                      ->orWhere('title', 'LIKE', '%Thiết Kế Website%');
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('home', compact(
            'mediaServices', 
            'techServices', 
            'caseStudies', 
            'latestPosts', 
            'clientProjects', 
            'featuredArticles'
        ));
    }
}