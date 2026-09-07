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

        return view('home', compact('mediaServices', 'techServices', 'caseStudies', 'latestPosts'));
    }
}