<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
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
    public int $perPage = 12;
    public array $selectedPosts = [];
    public bool $selectAll = false;

    // Sorting
    public string $sortColumn = 'published_at';
    public string $sortDirection = 'desc';

    // Date Filtering
    public string $dateFilter = 'all'; // all, today, this_week, this_month, last_month

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
        return 'Quản lý Bài viết - Cửu Long ID';
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
        $this->clearSelection();
    }

    public function setDateFilter(string $filter): void
    {
        $this->dateFilter = $filter;
        $this->currentPage = 1;
    }

    public function sortBy(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'desc';
        }
        $this->currentPage = 1;
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedAuthor = '';
        $this->selectedStatus = '';
        $this->dateFilter = 'all';
        $this->activeTab = 'all';
        $this->sortColumn = 'published_at';
        $this->sortDirection = 'desc';
        $this->currentPage = 1;
        $this->clearSelection();
    }

    public function clearSelection(): void
    {
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
            $this->selectedPosts = array_values(array_diff($this->selectedPosts, [$id]));
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
        $this->viewMode = in_array($mode, ['list', 'grid']) ? $mode : 'list';
    }

    // =========================================================================
    // SINGLE RECORD ACTIONS
    // =========================================================================

    public function deletePost(int $id): void
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            $this->selectedPosts = array_values(array_diff($this->selectedPosts, [$id]));
            Notification::make()
                ->title('Đã xóa bài viết thành công')
                ->success()
                ->send();
        }
    }

    public function toggleStatus(int $id): void
    {
        $post = Post::find($id);
        if (!$post) return;

        if ($post->status === 'published') {
            $post->status = 'draft';
            $msg = 'Đã chuyển bài viết về Bản nháp';
        } else {
            $post->status = 'published';
            if (!$post->published_at) {
                $post->published_at = now();
            }
            $msg = 'Đã xuất bản bài viết thành công';
        }
        $post->save();

        Notification::make()
            ->title($msg)
            ->success()
            ->send();
    }

    public function duplicatePost(int $id): void
    {
        $original = Post::find($id);
        if (!$original) return;

        $replica = $original->replicate([
            'views',
            'created_at',
            'updated_at',
        ]);

        $replica->title = '[Bản sao] ' . $original->title;
        $replica->slug = Str::slug($replica->title) . '-' . Str::random(5);
        $replica->status = 'draft';
        $replica->author_id = auth()->id() ?? $original->author_id;
        $replica->published_at = null;
        $replica->save();

        Notification::make()
            ->title('Đã nhân bản bài viết thành công (Bản nháp mới)')
            ->success()
            ->send();
    }

    // =========================================================================
    // BULK ACTIONS
    // =========================================================================

    public function bulkDelete(): void
    {
        if (empty($this->selectedPosts)) return;

        $count = count($this->selectedPosts);
        Post::whereIn('id', $this->selectedPosts)->delete();
        $this->clearSelection();

        Notification::make()
            ->title("Đã xóa vĩnh viễn {$count} bài viết đã chọn")
            ->success()
            ->send();
    }

    public function bulkPublish(): void
    {
        if (empty($this->selectedPosts)) return;

        $count = count($this->selectedPosts);
        Post::whereIn('id', $this->selectedPosts)->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
        $this->clearSelection();

        Notification::make()
            ->title("Đã xuất bản {$count} bài viết đã chọn")
            ->success()
            ->send();
    }

    public function bulkDraft(): void
    {
        if (empty($this->selectedPosts)) return;

        $count = count($this->selectedPosts);
        Post::whereIn('id', $this->selectedPosts)->update([
            'status' => 'draft',
        ]);
        $this->clearSelection();

        Notification::make()
            ->title("Đã chuyển {$count} bài viết về Bản nháp")
            ->success()
            ->send();
    }

    public function bulkHide(): void
    {
        if (empty($this->selectedPosts)) return;

        $count = count($this->selectedPosts);
        Post::whereIn('id', $this->selectedPosts)->update([
            'status' => 'hidden',
        ]);
        $this->clearSelection();

        Notification::make()
            ->title("Đã ẩn {$count} bài viết khỏi website")
            ->warning()
            ->send();
    }

    // =========================================================================
    // DATA COMPUTATION
    // =========================================================================

    public function getViewData(): array
    {
        return $this->getDisplayData();
    }

    protected function getDisplayData(): array
    {
        $baseQuery = Post::whereDoesntHave('category', fn ($q) => $q->where('slug', 'template-website'));

        // 1. REAL STAT COUNTS FROM DATABASE
        $totalCount = (clone $baseQuery)->count();
        $publishedCount = (clone $baseQuery)->where('status', 'published')->count();
        $draftCount = (clone $baseQuery)->where('status', 'draft')->count();
        $hiddenCount = (clone $baseQuery)->where('status', 'hidden')->count();

        // 2. QUERY REAL POSTS WITH RELATIONS
        $query = (clone $baseQuery)->with(['category', 'author']);

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

        // Date range filter
        if ($this->dateFilter === 'today') {
            $query->whereDate('published_at', Carbon::today());
        } elseif ($this->dateFilter === 'this_week') {
            $query->whereBetween('published_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($this->dateFilter === 'this_month') {
            $query->whereBetween('published_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        } elseif ($this->dateFilter === 'last_month') {
            $query->whereBetween('published_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
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

        // Sorting
        $allowedSorts = ['published_at', 'title', 'category_id', 'updated_at', 'views'];
        $sortCol = in_array($this->sortColumn, $allowedSorts) ? $this->sortColumn : 'published_at';
        $sortDir = strtolower($this->sortDirection) === 'asc' ? 'asc' : 'desc';

        if ($sortCol === 'published_at') {
            $query->orderByRaw("COALESCE(published_at, created_at) {$sortDir}");
        } else {
            $query->orderBy($sortCol, $sortDir);
        }

        $paginated = $query->paginate($this->perPage, ['*'], 'page', $this->currentPage);

        // 3. MAP POSTS FOR VIEW
        $posts = collect($paginated->items())->map(function ($post) {
            $catName = $post->category?->name ?? 'Tin tức';
            $authName = $post->author?->name ?? 'Quản trị viên';
            $authRole = $post->author?->roles?->first()?->name ?? 'Biên tập viên';

            $catColorMap = [
                'Công nghệ' => ['bg' => '#EFF6FF', 'text' => '#1D4ED8', 'border' => 'rgba(37, 99, 235, 0.2)'],
                'Marketing' => ['bg' => '#FFFBEB', 'text' => '#B45309', 'border' => 'rgba(245, 158, 11, 0.2)'],
                'Case Study' => ['bg' => '#F5F3FF', 'text' => '#7C3AED', 'border' => 'rgba(124, 58, 237, 0.2)'],
                'SEO' => ['bg' => '#ECFEFF', 'text' => '#0E7490', 'border' => 'rgba(14, 116, 144, 0.2)'],
                'Thương hiệu' => ['bg' => '#FFF1F2', 'text' => '#BE123C', 'border' => 'rgba(190, 18, 60, 0.2)'],
                'Hướng dẫn' => ['bg' => '#EFF6FF', 'text' => '#1D4ED8', 'border' => 'rgba(37, 99, 235, 0.2)'],
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
                'views' => $post->views ?? 0,
                'edit_url' => PostResource::getUrl('edit', ['record' => $post->id]),
                'preview_url' => URL::signedRoute('post.preview', ['post' => $post->id]),
            ];
        })->toArray();

        // 4. REAL FILTER OPTIONS FROM DATABASE
        $categories = Category::where('slug', '!=', 'template-website')->orderBy('name')->pluck('name', 'id')->toArray();
        $authors = User::whereIn('id', Post::select('author_id')->distinct())->orderBy('name')->pluck('name', 'id')->toArray();

        // Date range label
        $dateLabel = match($this->dateFilter) {
            'today' => 'Hôm nay (' . Carbon::today()->format('d/m') . ')',
            'this_week' => 'Tuần này',
            'this_month' => 'Tháng này (' . Carbon::now()->format('m/Y') . ')',
            'last_month' => 'Tháng trước (' . Carbon::now()->subMonth()->format('m/Y') . ')',
            default => 'Tất cả thời gian',
        };

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
            'dateLabel' => $dateLabel,
            'dateRange' => $dateLabel,
        ];
    }
}
