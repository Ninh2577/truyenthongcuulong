<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Base query for real editorial blog posts (excluding website templates).
     */
    protected function blogPostQuery()
    {
        return Post::with('category')
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->where('slug', '!=', 'template-website')
                  ->where('is_industry_filter', false);
            });
    }

    /**
     * Real categories with active blog posts.
     */
    protected function blogCategories()
    {
        return Category::withCount(['posts' => function ($q) {
                $q->where('status', 'published');
            }])
            ->where('slug', '!=', 'template-website')
            ->where('is_industry_filter', false)
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take(15)
            ->get();
    }

    /**
     * Top popular real blog posts.
     */
    protected function blogPopularPosts(int $limit = 5)
    {
        return $this->blogPostQuery()
            ->orderByDesc('views')
            ->take($limit)
            ->get();
    }

    public function index(Request $request): View
    {
        $query = $this->blogPostQuery();

        // Filter by Pillar
        $currentPillar = $request->input('pillar');
        if ($currentPillar && in_array($currentPillar, ['tech', 'studio', 'agency', 'resource', 'corporate'])) {
            $query->inPillar($currentPillar);
        }

        // Search query
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
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
        $popularPosts = $this->blogPopularPosts(5);

        // Category counts
        $categories = $this->blogCategories();

        return view('blog.index', compact('posts', 'categories', 'featuredPost', 'popularPosts', 'currentPillar'));
    }

    public function category(string $slug)
    {
        if ($slug === 'template-website') {
            return redirect()->route('templates.index');
        }

        $category = Category::where('slug', $slug)->firstOrFail();
        
        $posts = Post::with('category')
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->orderByDesc('published_at')
            ->paginate(12);

        $popularPosts = $this->blogPopularPosts(5);
        $categories = $this->blogCategories();

        return view('blog.category', compact('category', 'posts', 'categories', 'popularPosts'));
    }

    public function show(string $slug)
    {
        $post = Post::with('category')->where('slug', $slug)->where('status', 'published')->firstOrFail();

        // Nếu là mẫu template website, điều hướng sang trang chi tiết kho giao diện
        if ($post->category?->slug === 'template-website') {
            return redirect()->route('templates.show', $slug);
        }

        $post->increment('views');

        // Lấy Nội dung và Mục lục (TOC) đã format từ Cache (hoặc parse mới)
        $cacheKey = 'post_editorial_v3_' . $post->id . '_' . $post->updated_at->timestamp;
        $formattedData = \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addDays(30), function () use ($post) {
            return \App\Services\ArticleEditorialFormatter::format($post->content);
        });

        $post->content = $formattedData['content'];
        $toc = $formattedData['toc'];

        // Related posts in same pillar for sidebar (excluding templates)
        $pillar = $post->category?->pillar_group;
        $relatedPosts = $this->blogPostQuery()
            ->where('id', '!=', $post->id)
            ->when($pillar, fn($q) => $q->inPillar($pillar))
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Posts strictly in the same category for bottom section (carousel slider)
        $categoryPosts = $this->blogPostQuery()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn($q) => $q->where('category_id', $post->category_id))
            ->orderByDesc('published_at')
            ->take(12)
            ->get();

        // If category has fewer than 8 posts, supplement with pillar posts
        if ($categoryPosts->count() < 8 && $pillar) {
            $excludeIds = $categoryPosts->pluck('id')->push($post->id)->all();
            $supplementPosts = $this->blogPostQuery()
                ->whereNotIn('id', $excludeIds)
                ->inPillar($pillar)
                ->orderByDesc('published_at')
                ->take(12 - $categoryPosts->count())
                ->get();
            $categoryPosts = $categoryPosts->concat($supplementPosts);
        }

        $popularPosts = $this->blogPopularPosts(5);
        $categories = $this->blogCategories();

        return view('blog.show', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts'));
    }

    public function preview(Post $post): View
    {
        // Preview không dùng cache để luôn thấy mới nhất
        $formattedData = \App\Services\ArticleEditorialFormatter::format($post->content);
        $post->content = $formattedData['content'];
        $toc = $formattedData['toc'];

        $relatedPosts = collect();
        $categoryPosts = collect();
        $popularPosts = collect();
        $categories = $this->blogCategories();
        $isPreview = true;

        return view('blog.show', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts', 'isPreview'));
    }

    public function searchApi(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));
        if (mb_strlen($q) < 2) {
            return response()->json(['results' => []]);
        }

        $posts = $this->blogPostQuery()
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

    public function resolveSlug(string $slug)
    {
        // Check if slug belongs to a Category
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            if ($slug === 'template-website') {
                return redirect()->route('templates.index');
            }
            return $this->category($slug);
        }

        // Check if slug belongs to a Post
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            if ($post->category?->slug === 'template-website') {
                return redirect()->route('templates.show', $slug);
            }
            return $this->show($slug);
        }

        abort(404);
    }
}
