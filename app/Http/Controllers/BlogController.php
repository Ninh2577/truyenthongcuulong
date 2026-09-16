<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with('category')->where('status', 'published');

        // Filter by Pillar
        $currentPillar = $request->input('pillar');
        if ($currentPillar && in_array($currentPillar, ['tech', 'studio', 'agency', 'resource', 'corporate'])) {
            $query->inPillar($currentPillar);
        }

        // Search query
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where('title', 'like', "%{$search}%");
        }

        // Featured Hero Post (highest views or latest in current filter)
        $featuredPost = (clone $query)->orderByDesc('views')->first();

        // Paginated posts
        if ($featuredPost && !$request->filled('q') && !$request->filled('page')) {
            $posts = (clone $query)->where('id', '!=', $featuredPost->id)->orderByDesc('published_at')->paginate(12)->withQueryString();
        } else {
            $posts = $query->orderByDesc('published_at')->paginate(12)->withQueryString();
        }

        // Top popular posts for sidebar
        $popularPosts = Post::where('status', 'published')->orderByDesc('views')->take(5)->get();

        // Category counts
        $categories = Category::withCount('posts')
            ->where('is_industry_filter', false)
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take(15)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'featuredPost', 'popularPosts', 'currentPillar'));
    }

    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $posts = Post::with('category')
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->orderByDesc('published_at')
            ->paginate(12);

        $popularPosts = Post::where('status', 'published')->orderByDesc('views')->take(5)->get();

        $categories = Category::withCount('posts')
            ->where('is_industry_filter', false)
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take(15)
            ->get();

        return view('blog.category', compact('category', 'posts', 'categories', 'popularPosts'));
    }

    public function show(string $slug): View
    {
        $post = Post::with('category')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        $post->increment('views');

        // Lấy Nội dung và Mục lục (TOC) đã format từ Cache (hoặc parse mới)
        $cacheKey = 'post_editorial_' . $post->id;
        $formattedData = \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addDays(30), function () use ($post) {
            if ($post->article_type === 'listicle') {
                return \App\Services\ArticleEditorialFormatter::format($post->content);
            }
            // Standard bài viết vẫn format TOC thông thường qua class cũ (nhưng class cũ cũng trả về chung format)
            // Ta có thể tận dụng ArticleEditorialFormatter luôn vì nó tự skip listicle markup nếu ko có keyword
            return \App\Services\ArticleEditorialFormatter::format($post->content);
        });

        $post->content = $formattedData['content'];
        $toc = $formattedData['toc'];

        // Related posts in same pillar
        $pillar = $post->category?->pillar_group;
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->when($pillar, fn($q) => $q->inPillar($pillar))
            ->inRandomOrder()
            ->take(4)
            ->get();

        $popularPosts = Post::where('status', 'published')->orderByDesc('views')->take(5)->get();

        return view('blog.show', compact('post', 'toc', 'relatedPosts', 'popularPosts'));
    }

    public function preview(Post $post): View
    {
        // Preview không dùng cache để luôn thấy mới nhất
        $formattedData = \App\Services\ArticleEditorialFormatter::format($post->content);
        $post->content = $formattedData['content'];
        $toc = $formattedData['toc'];

        $relatedPosts = collect();
        $popularPosts = collect();
        $isPreview = true;

        return view('blog.show', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'isPreview'));
    }

    public function searchApi(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));
        if (mb_strlen($q) < 2) {
            return response()->json(['results' => []]);
        }

        $posts = Post::with('category')
            ->where('status', 'published')
            ->where(function($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('summary', 'like', "%{$q}%");
            })
            ->orderByDesc('published_at')
            ->take(6)
            ->get(['id', 'title', 'slug', 'category_id', 'thumbnail', 'published_at']);

        $results = $posts->map(fn($p) => [
            'title' => $p->title,
            'url' => route('blog.resolve', $p->slug),
            'category' => $p->category?->name ?? 'Tin tức',
            'date' => $p->published_at ? $p->published_at->format('d/m/Y') : '',
            'thumbnail' => $p->thumbnail,
        ]);

        return response()->json(['results' => $results]);
    }

    public function resolveSlug(string $slug): View
    {
        // Check if slug belongs to a Category
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            return $this->category($slug);
        }

        // Check if slug belongs to a Post
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            return $this->show($slug);
        }

        abort(404);
    }
}
