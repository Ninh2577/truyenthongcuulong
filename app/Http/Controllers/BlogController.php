<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        return Cache::remember('blog_categories_active', 3600, function () {
            return Category::withCount(['posts' => function ($q) {
                    $q->where('status', 'published');
                }])
                ->where('slug', '!=', 'template-website')
                ->where('is_industry_filter', false)
                ->having('posts_count', '>', 0)
                ->orderByDesc('posts_count')
                ->take(15)
                ->get();
        });
    }

    /**
     * Top popular real blog posts.
     */
    protected function blogPopularPosts(int $limit = 5)
    {
        return Cache::remember('blog_popular_posts_' . $limit, 3600, function () use ($limit) {
            return $this->blogPostQuery()
                ->orderByDesc('views')
                ->take($limit)
                ->get();
        });
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
        $post = Post::with(['category', 'author'])->where('slug', $slug)->where('status', 'published')->firstOrFail();

        // Nếu là mẫu template website, điều hướng sang trang chi tiết kho giao diện
        if ($post->category?->slug === 'template-website') {
            return redirect()->route('templates.show', $slug);
        }

        $post->increment('views');

        // Lấy Nội dung và Mục lục (TOC) đã format từ Cache (hoặc parse mới)
        $cacheKey = 'post_editorial_v5_' . $post->id . '_' . $post->updated_at->timestamp;
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

        \Illuminate\Support\Facades\View::share('currentPost', $post);

        if ($post->isLandingPage()) {
            return view('blog.landing_page', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts'));
        }

        if ($post->isPillarPage()) {
            $clusterPosts = $post->clusterPosts(8);
            return view('blog.pillar_page', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts', 'clusterPosts'));
        }

        return view('blog.show', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts'));
    }

    public function preview(Post $post): View
    {
        $post->loadMissing(['category', 'author']);

        // Preview không dùng cache để luôn thấy mới nhất
        $formattedData = \App\Services\ArticleEditorialFormatter::format($post->content);
        $post->content = $formattedData['content'];
        $toc = $formattedData['toc'];

        $relatedPosts = collect();
        $categoryPosts = collect();
        $popularPosts = collect();
        $categories = $this->blogCategories();
        $isPreview = true;

        \Illuminate\Support\Facades\View::share('currentPost', $post);

        if ($post->isLandingPage()) {
            return view('blog.landing_page', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts', 'isPreview'));
        }

        if ($post->isPillarPage()) {
            $clusterPosts = $post->clusterPosts(8);
            return view('blog.pillar_page', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts', 'clusterPosts', 'isPreview'));
        }

        return view('blog.show', compact('post', 'toc', 'relatedPosts', 'popularPosts', 'categories', 'categoryPosts', 'isPreview'));
    }

    public function publishFromPreview(Post $post, Request $request)
    {
        // Cho phép nếu đã đăng nhập hoặc request hợp lệ
        if (!auth()->check() && !$request->hasValidSignature()) {
            abort(403, 'Bạn không có quyền xuất bản bài viết này.');
        }

        $post->status = 'published';
        if (empty($post->published_at)) {
            $post->published_at = now();
        }
        $post->save();

        // Xóa cache bài viết nếu có để trang public luôn cập nhật mới nhất
        $cacheKey = 'post_editorial_v5_' . $post->id . '_' . $post->updated_at->timestamp;
        \Illuminate\Support\Facades\Cache::forget($cacheKey);

        return redirect()->route('blog.resolve', $post->slug)
            ->with('success', 'Đã xuất bản bài viết thành công!');
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
        // 1. Check if slug belongs to a Category
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            if ($slug === 'template-website') {
                return redirect()->route('templates.index');
            }
            return $this->category($slug);
        }

        // 2. Check if slug belongs to a Post
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            if ($post->category?->slug === 'template-website') {
                return redirect()->route('templates.show', $slug);
            }
            return $this->show($slug);
        }

        // 3. Check if slug belongs to a Service
        $service = \App\Models\Service::where('slug', $slug)->first();
        if ($service) {
            return redirect()->to('/dich-vu/' . $service->slug, 301);
        }

        // 4. Common system / service aliases
        $aliases = [
            'web-app' => '/dich-vu/web-app',
            'ui-ux' => '/dich-vu/ui-ux',
            'thiet-ke-ui-ux' => '/dich-vu/ui-ux',
            'thiet-ke-web' => '/dich-vu/web-app',
            'kho-giao-dien' => '/kho-giao-dien',
            'mau-giao-dien' => '/mau-giao-dien',
            'mau-website' => '/mau-giao-dien',
            'giao-dien' => '/mau-giao-dien',
            'web-demo' => '/mau-giao-dien',
            'marketing' => '/dich-vu/marketing',
            'quan-tri-website' => '/dich-vu/quan-tri-website',
            'cham-soc-website' => '/dich-vu/quan-tri-website',
            'chup-anh-su-kien' => '/dich-vu/chup-anh-su-kien',
            'quay-phim-su-kien' => '/dich-vu/quay-phim-su-kien',
            'chup-anh-teambuilding' => '/dich-vu/chup-anh-teambuilding',
            'quay-phim-teambuilding' => '/dich-vu/quay-phim-teambuilding',
            'quay-chup-flycam' => '/dich-vu/quay-chup-flycam',
            'flycam' => '/dich-vu/quay-chup-flycam',
            'dich-vu-seo' => '/dich-vu-seo-can-tho',
            'seo-can-tho' => '/dich-vu-seo-can-tho',
            'seo' => '/dich-vu-seo-can-tho',
        ];

        if (isset($aliases[$slug])) {
            return redirect()->to($aliases[$slug], 301);
        }

        // 5. Check if slug belongs to a CaseStudy
        $caseStudy = \App\Models\CaseStudy::where('slug', $slug)->first();
        if ($caseStudy) {
            return redirect()->route('projects.show', $slug, 301);
        }

        // 6. Check MenuRouteResolver for any custom menu item URL
        $menuResult = \App\Services\MenuRouteResolver::resolve($slug);
        if ($menuResult) {
            return $menuResult;
        }

        abort(404);
    }

    /**
     * Tự động chuyển hướng 301 mọi link có tiền tố danh mục/dịch vụ
     * dạng domain/{category}/{post_slug} về thẳng URL chuẩn
     */
    public function resolveCategoryPost(string $category, string $slug)
    {
        // 1. Nếu là tiền tố dịch vụ, ủy quyền cho ServiceController
        if ($category === 'dich-vu') {
            return app(ServiceController::class)->show($slug);
        }

        // 2. Kiểm tra nếu là Post
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            return redirect()->to('/' . $slug, 301);
        }

        // 3. Kiểm tra nếu $slug là Category con
        $cat = Category::where('slug', $slug)->first();
        if ($cat) {
            return redirect()->to('/' . $slug, 301);
        }

        // 4. Check MenuRouteResolver for any custom menu item URL
        $menuResult = \App\Services\MenuRouteResolver::resolve($category . '/' . $slug) ?: \App\Services\MenuRouteResolver::resolve($slug);
        if ($menuResult) {
            return $menuResult;
        }

        abort(404);
    }
}

