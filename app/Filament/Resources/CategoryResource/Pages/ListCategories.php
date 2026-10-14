<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected static string $view = 'filament.resources.category-resource.pages.list-categories';

    public string $search = '';
    public string $selectedStatus = ''; // '', 'active', 'paused', 'hidden'
    public string $selectedSort = 'latest'; // 'latest', 'oldest', 'name_asc', 'name_desc', 'posts_desc', 'order_asc'
    public int $perPage = 10;
    public int $currentPage = 1;
    public string $viewMode = 'list'; // 'list', 'grid'
    public array $selectedCategories = [];
    public bool $selectAll = false;
    public string $dateRange = '01/10/2026 - 31/10/2026';

    // Delete modal confirmation
    public bool $showDeleteModal = false;
    public ?int $categoryToDeleteId = null;
    public string $categoryToDeleteName = '';

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
        return 'Danh mục - Truyền Thông Cửu Long';
    }

    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedStatus(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedSort(): void
    {
        $this->currentPage = 1;
    }

    public function updatedPerPage(): void
    {
        $this->currentPage = 1;
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = in_array($mode, ['list', 'grid']) ? $mode : 'list';
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedStatus = '';
        $this->selectedSort = 'latest';
        $this->currentPage = 1;
        $this->selectedCategories = [];
        $this->selectAll = false;
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = !$this->selectAll;
        $data = $this->getDisplayData();
        if ($this->selectAll) {
            $this->selectedCategories = collect($data['categories'])->pluck('id')->toArray();
        } else {
            $this->selectedCategories = [];
        }
    }

    public function toggleSelectCategory(int $id): void
    {
        if (in_array($id, $this->selectedCategories)) {
            $this->selectedCategories = array_values(array_diff($this->selectedCategories, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedCategories[] = $id;
            $data = $this->getDisplayData();
            if (count($this->selectedCategories) === count($data['categories'])) {
                $this->selectAll = true;
            }
        }
    }

    public function setPage($page, $pageName = 'page'): void
    {
        $this->currentPage = max(1, (int) $page);
    }

    public function previousPage($pageName = 'page'): void
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function nextPage($pageName = 'page'): void
    {
        $data = $this->getDisplayData();
        if ($this->currentPage < $data['lastPage']) {
            $this->currentPage++;
        }
    }

    public function confirmDelete(int $id): void
    {
        $cat = Category::find($id);
        if ($cat) {
            $this->categoryToDeleteId = $id;
            $this->categoryToDeleteName = $cat->name;
            $this->showDeleteModal = true;
        }
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->categoryToDeleteId = null;
        $this->categoryToDeleteName = '';
    }

    public function executeDelete(): void
    {
        if (!$this->categoryToDeleteId) {
            return;
        }

        $category = Category::find($this->categoryToDeleteId);
        if ($category) {
            $name = $category->name;
            $category->delete();

            Notification::make()
                ->title('Xóa chuyên mục thành công')
                ->body("Chuyên mục \"{$name}\" đã được xóa khỏi hệ thống.")
                ->success()
                ->send();
        }

        $this->showDeleteModal = false;
        $this->categoryToDeleteId = null;
        $this->categoryToDeleteName = '';
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedCategories)) {
            return;
        }

        $count = Category::whereIn('id', $this->selectedCategories)->delete();
        $this->selectedCategories = [];
        $this->selectAll = false;

        Notification::make()
            ->title('Xóa hàng loạt thành công')
            ->body("Đã xóa {$count} chuyên mục được chọn.")
            ->success()
            ->send();
    }

    public function exportData(): StreamedResponse
    {
        $filename = 'chuyen-muc-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($handle, ['ID', 'Tên chuyên mục', 'Slug', 'Phân nhóm', 'Số bài viết', 'Trạng thái', 'Thứ tự', 'Ngày cập nhật']);

            $categories = Category::withCount('posts')->orderBy('order')->get();
            foreach ($categories as $cat) {
                $status = $this->determineStatus($cat);
                $statusLabel = match($status) {
                    'active' => 'Đang hoạt động',
                    'paused' => 'Tạm dừng',
                    'hidden' => 'Đã ẩn',
                    default => 'Đang hoạt động',
                };

                fputcsv($handle, [
                    $cat->id,
                    $cat->name,
                    $cat->slug,
                    $cat->pillar_group ?? 'general',
                    $cat->posts_count,
                    $statusLabel,
                    $cat->order ?? $cat->display_order ?? 0,
                    $cat->updated_at?->format('d/m/Y H:i') ?? '',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function determineStatus(Category $category): string
    {
        return $category->determineStatus();
    }

    public function getCategoryTheme(int $id, ?string $pillarGroup = null): array
    {
        $themes = [
            0 => [
                'color' => '#FF5400',
                'bg' => 'bg-orange-500',
                'border' => 'border-orange-500',
                'text' => 'text-white',
                'icon' => 'code',
            ],
            1 => [
                'color' => '#8B5CF6',
                'bg' => 'bg-purple-500',
                'border' => 'border-purple-500',
                'text' => 'text-white',
                'icon' => 'sparkles',
            ],
            2 => [
                'color' => '#3B82F6',
                'bg' => 'bg-blue-500',
                'border' => 'border-blue-500',
                'text' => 'text-white',
                'icon' => 'pen-tool',
            ],
            3 => [
                'color' => '#10B981',
                'bg' => 'bg-emerald-500',
                'border' => 'border-emerald-500',
                'text' => 'text-white',
                'icon' => 'briefcase',
            ],
            4 => [
                'color' => '#EF4444',
                'bg' => 'bg-red-500',
                'border' => 'border-red-500',
                'text' => 'text-white',
                'icon' => 'users',
            ],
            5 => [
                'color' => '#6366F1',
                'bg' => 'bg-indigo-500',
                'border' => 'border-indigo-500',
                'text' => 'text-white',
                'icon' => 'calendar',
            ],
        ];

        return $themes[$id % count($themes)];
    }

    public function getMetrics(): array
    {
        $all = Category::all();
        $total = $all->count();

        $active = 0;
        $paused = 0;
        $hidden = 0;

        foreach ($all as $cat) {
            $status = $this->determineStatus($cat);
            if ($status === 'hidden') {
                $hidden++;
            } elseif ($status === 'paused') {
                $paused++;
            } else {
                $active++;
            }
        }

        $activePct = $total > 0 ? round(($active / $total) * 100, 1) : 0;
        $pausedPct = $total > 0 ? round(($paused / $total) * 100, 1) : 0;
        $hiddenPct = $total > 0 ? round(($hidden / $total) * 100, 1) : 0;

        return [
            'total' => $total,
            'active' => $active,
            'active_pct' => $activePct,
            'paused' => $paused,
            'paused_pct' => $pausedPct,
            'hidden' => $hidden,
            'hidden_pct' => $hiddenPct,
        ];
    }

    public function getDisplayData(): array
    {
        $query = Category::withCount('posts')->with('parent');

        if (!empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('slug', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
            });
        }

        // Apply sorting
        switch ($this->selectedSort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'posts_desc':
                $query->orderByDesc('posts_count');
                break;
            case 'order_asc':
                $query->orderBy('order', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('id', 'asc');
                break;
        }

        $allResults = $query->get();

        // Apply status filter if selected
        if (!empty($this->selectedStatus)) {
            $allResults = $allResults->filter(function ($item) {
                return $this->determineStatus($item) === $this->selectedStatus;
            })->values();
        }

        $totalFiltered = $allResults->count();
        $lastPage = max(1, (int) ceil($totalFiltered / $this->perPage));
        if ($this->currentPage > $lastPage) {
            $this->currentPage = $lastPage;
        }

        $offset = ($this->currentPage - 1) * $this->perPage;
        $pageItems = $allResults->slice($offset, $this->perPage)->values();

        return [
            'categories' => $pageItems,
            'total' => $totalFiltered,
            'from' => $totalFiltered > 0 ? $offset + 1 : 0,
            'to' => min($offset + $this->perPage, $totalFiltered),
            'currentPage' => $this->currentPage,
            'lastPage' => $lastPage,
        ];
    }
}
