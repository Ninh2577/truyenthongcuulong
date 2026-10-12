<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected static string $view = 'filament.resources.post-resource.pages.list-posts';

    public string $search = '';
    public ?string $activeTab = 'all'; // all, published, draft, hidden
    public string $selectedCategory = '';
    public string $selectedAuthor = '';
    public string $selectedStatus = '';
    public string $viewMode = 'list'; // list, grid
    public int $currentPage = 1;
    public int $perPage = 6;
    public array $selectedPosts = [];
    public bool $selectAll = false;
    public string $dateRange = '01/10/2026 - 31/10/2026';

    public function getHeading(): string|Htmlable
    {
        return '';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Bài viết - Cửu Long ID';
    }

    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedCategory(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedAuthor(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedStatus(): void
    {
        $this->currentPage = 1;
    }

    public function updatedPerPage(): void
    {
        $this->currentPage = 1;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->currentPage = 1;
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedAuthor = '';
        $this->selectedStatus = '';
        $this->activeTab = 'all';
        $this->currentPage = 1;
        $this->selectedPosts = [];
        $this->selectAll = false;
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = !$this->selectAll;
        $display = $this->getDisplayData();
        if ($this->selectAll) {
            $this->selectedPosts = collect($display['posts'])->pluck('id')->toArray();
        } else {
            $this->selectedPosts = [];
        }
    }

    public function toggleSelectPost(int $id): void
    {
        if (in_array($id, $this->selectedPosts)) {
            $this->selectedPosts = array_diff($this->selectedPosts, [$id]);
        } else {
            $this->selectedPosts[] = $id;
        }
        $display = $this->getDisplayData();
        $this->selectAll = count($this->selectedPosts) === count($display['posts']) && count($display['posts']) > 0;
    }

    public function setPage($page, $pageName = 'page'): void
    {
        $this->currentPage = max(1, (int) $page);
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = $mode;
    }

    public function deletePost(int $id): void
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            \Filament\Notifications\Notification::make()
                ->title('Đã xóa bài viết thành công')
                ->success()
                ->send();
        }
    }

    public function getViewData(): array
    {
        return $this->getDisplayData();
    }

    protected function getDisplayData(): array
    {
        // 1. REAL STAT COUNTS FROM DATABASE
        $totalCount = Post::count();
        $publishedCount = Post::where('status', 'published')->count();
        $draftCount = Post::where('status', 'draft')->count();
        $hiddenCount = Post::where('status', 'hidden')->count();

        // 2. QUERY REAL POSTS WITH RELATIONS
        $query = Post::with(['category', 'author']);

        // Tab filter
        if ($this->activeTab === 'published') {
            $query->where('status', 'published');
        } elseif ($this->activeTab === 'draft') {
            $query->where('status', 'draft');
        } elseif ($this->activeTab === 'hidden') {
            $query->where('status', 'hidden');
        }

        // Status dropdown filter
        if (!empty($this->selectedStatus)) {
            $query->where('status', $this->selectedStatus);
        }

        // Category dropdown filter
        if (!empty($this->selectedCategory)) {
            $query->where('category_id', $this->selectedCategory);
        }

        // Author dropdown filter
        if (!empty($this->selectedAuthor)) {
            $query->where('author_id', $this->selectedAuthor);
        }

        // Search filter
        if (!empty(trim($this->search))) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhere('summary', 'like', $term)
                  ->orWhereHas('category', fn ($catQ) => $catQ->where('name', 'like', $term))
                  ->orWhereHas('author', fn ($authQ) => $authQ->where('name', 'like', $term));
            });
        }

        // Order by latest publish date or created date
        $paginated = $query->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate($this->perPage, ['*'], 'page', $this->currentPage);

        // 3. MAP POSTS FOR VIEW
        $posts = collect($paginated->items())->map(function ($post) {
            $catName = $post->category?->name ?? 'Tin tức';
            $authName = $post->author?->name ?? 'Đới Sỹ Hoán';
            $authRole = $post->author?->roles?->first()?->name ?? 'Biên tập viên';

            $catColorMap = [
                'Công nghệ' => ['bg' => '#EFF6FF', 'text' => '#1D4ED8', 'border' => 'rgba(37, 99, 235, 0.2)'],
                'Marketing' => ['bg' => '#FFFBEB', 'text' => '#B45309', 'border' => 'rgba(245, 158, 11, 0.2)'],
                'Case Study' => ['bg' => '#F5F3FF', 'text' => '#7C3AED', 'border' => 'rgba(124, 58, 237, 0.2)'],
                'SEO' => ['bg' => '#ECFEFF', 'text' => '#0E7490', 'border' => 'rgba(14, 116, 144, 0.2)'],
                'Thương hiệu' => ['bg' => '#FFF1F2', 'text' => '#BE123C', 'border' => 'rgba(190, 18, 60, 0.2)'],
                'Hướng dẫn' => ['bg' => '#EFF6FF', 'text' => '#1D4ED8', 'border' => 'rgba(37, 99, 235, 0.2)'],
                'Template Website' => ['bg' => '#FFF7ED', 'text' => '#C2410C', 'border' => 'rgba(249, 115, 22, 0.2)'],
                'Doanh Nghiệp & Dịch Vụ' => ['bg' => '#ECFDF5', 'text' => '#047857', 'border' => 'rgba(16, 185, 129, 0.2)'],
            ];
            $color = $catColorMap[$catName] ?? ['bg' => '#F1F5F9', 'text' => '#475569', 'border' => 'rgba(100, 116, 139, 0.2)'];

            $statusLabel = match($post->status) {
                'published' => 'Đã xuất bản',
                'draft'     => 'Bản nháp',
                'hidden'    => 'Đã ẩn',
                default     => 'Đã xuất bản',
            };
            $statusBg = match($post->status) {
                'published' => '#ECFDF5',
                'draft'     => '#FFF7ED',
                'hidden'    => '#F1F5F9',
                default     => '#ECFDF5',
            };
            $statusText = match($post->status) {
                'published' => '#047857',
                'draft'     => '#C2410C',
                'hidden'    => '#64748B',
                default     => '#047857',
            };
            $statusDot = match($post->status) {
                'published' => '#10B981',
                'draft'     => '#F97316',
                'hidden'    => '#94A3B8',
                default     => '#10B981',
            };

            $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($authName) . '&background=2563EB&color=fff&rounded=true';

            return [
                'id' => $post->id,
                'title' => $post->title,
                'summary' => $post->summary ?: Str::limit(strip_tags($post->content), 85),
                'thumbnail' => $post->thumbnail_url ?: asset('images/banner_halong_bay.jpg'),
                'category' => $catName,
                'category_badge_bg' => $color['bg'],
                'category_badge_text' => $color['text'],
                'category_badge_border' => $color['border'],
                'author_name' => $authName,
                'author_role' => $authRole,
                'author_avatar' => $avatarUrl,
                'status' => $post->status,
                'status_label' => $statusLabel,
                'status_badge_bg' => $statusBg,
                'status_badge_text' => $statusText,
                'status_badge_border' => 'rgba(16, 185, 129, 0.2)',
                'status_dot' => $statusDot,
                'published_at' => $post->published_at?->format('d/m/Y H:i') ?? $post->created_at->format('d/m/Y H:i'),
                'updated_at' => $post->updated_at->format('d/m/Y H:i'),
                'edit_url' => PostResource::getUrl('edit', ['record' => $post->id]),
                'preview_url' => url('/tin-tuc/' . $post->slug),
            ];
        })->toArray();

        // 4. REAL FILTER OPTIONS FROM DATABASE
        $categories = Category::orderBy('name')->pluck('name', 'id')->toArray();
        $authors = User::whereIn('id', Post::select('author_id')->distinct())->orderBy('name')->pluck('name', 'id')->toArray();

        return [
            'totalCount' => $totalCount,
            'publishedCount' => $publishedCount,
            'draftCount' => $draftCount,
            'hiddenCount' => $hiddenCount,
            'posts' => $posts,
            'categories' => $categories,
            'authors' => $authors,
            'total' => $paginated->total(),
            'firstItem' => $paginated->firstItem() ?? 0,
            'lastItem' => $paginated->lastItem() ?? 0,
            'currentPage' => $paginated->currentPage(),
            'lastPage' => $paginated->lastPage(),
            'createUrl' => PostResource::getUrl('create'),
        ];
    }
}
