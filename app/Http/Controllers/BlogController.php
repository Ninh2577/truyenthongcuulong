<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with('category')->where('status', 'published');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where('title', 'like', "%{$search}%");
        }

        $posts = $query->orderByDesc('published_at')->paginate(12)->withQueryString();
        $categories = Category::withCount('posts')->having('posts_count', '>', 0)->orderByDesc('posts_count')->take(15)->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::with('category')
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->orderByDesc('published_at')
            ->paginate(12);

        $categories = Category::withCount('posts')->having('posts_count', '>', 0)->orderByDesc('posts_count')->take(15)->get();

        return view('blog.category', compact('category', 'posts', 'categories'));
    }

    public function show(string $slug): View
    {
        $post = Post::with('category')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        $post->increment('views');

        // Extract Table of Contents from H2 / H3 tags
        $toc = [];
        if ($post->content) {
            preg_match_all('/<h([2-3])[^>]*>(.*?)<\/h\1>/i', $post->content, $matches, PREG_SET_ORDER);
            foreach ($matches as $i => $match) {
                $level = (int)$match[1];
                $title = strip_tags($match[2]);
                $anchor = 'section-' . ($i + 1);
                $toc[] = [
                    'level' => $level,
                    'title' => $title,
                    'anchor' => $anchor,
                ];
                // Inject anchor id into the content heading
                $replacement = sprintf('<h%d id="%s">%s</h%d>', $level, $anchor, $match[2], $level);
                $post->content = substr_replace($post->content, $replacement, strpos($post->content, $match[0]), strlen($match[0]));
            }
        }

        // Related posts
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn($q) => $q->where('category_id', $post->category_id))
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'toc', 'relatedPosts'));
    }
}