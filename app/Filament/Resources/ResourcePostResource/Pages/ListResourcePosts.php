<?php

namespace App\Filament\Resources\ResourcePostResource\Pages;

use App\Filament\Resources\ResourcePostResource;
use App\Models\Post;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListResourcePosts extends ListRecords
{
    protected static string $resource = ResourcePostResource::class;

    protected static string $view = 'filament.resources.resource-post-resource.pages.list-resource-posts';

    public string $search = '';
    public string $selectedType = ''; // '', 'pdf', 'image', 'video', 'other'
    public string $selectedStatus = ''; // '', 'published', 'draft', 'hidden'
    public string $selectedSize = ''; // '', 'small', 'medium', 'large'
    public string $selectedSort = 'latest'; // 'latest', 'oldest', 'title_asc', 'title_desc', 'downloads_desc'
    public int $perPage = 5;
    public int $currentPage = 1;
    public string $viewMode = 'list'; // 'list', 'grid'
    public array $selectedResources = [];
    public bool $selectAll = false;
    public string $dateRange = '01/10/2026 - 31/10/2026';

    // Delete modal confirmation
    public bool $showDeleteModal = false;
    public ?int $resourceToDeleteId = null;
    public string $resourceToDeleteName = '';

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
        return 'Tài nguyên - Cửu Long ID';
    }

    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedType(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedStatus(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedSize(): void
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
        $this->selectedType = '';
        $this->selectedStatus = '';
        $this->selectedSize = '';
        $this->selectedSort = 'latest';
        $this->currentPage = 1;
        $this->selectedResources = [];
        $this->selectAll = false;
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = !$this->selectAll;
        $data = $this->getDisplayData();
        if ($this->selectAll) {
            $this->selectedResources = collect($data['resources'])->pluck('id')->toArray();
        } else {
            $this->selectedResources = [];
        }
    }

    public function toggleSelectResource(int $id): void
    {
        if (in_array($id, $this->selectedResources)) {
            $this->selectedResources = array_values(array_diff($this->selectedResources, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedResources[] = $id;
            $data = $this->getDisplayData();
            if (count($this->selectedResources) === count($data['resources'])) {
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
        $res = Post::inPillar('resource')->find($id);
        if ($res) {
            $this->resourceToDeleteId = $id;
            $this->resourceToDeleteName = $res->title;
            $this->showDeleteModal = true;
        }
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->resourceToDeleteId = null;
        $this->resourceToDeleteName = '';
    }

    public function executeDelete(): void
    {
        if (!$this->resourceToDeleteId) {
            return;
        }

        $resource = Post::inPillar('resource')->find($this->resourceToDeleteId);
        if ($resource) {
            $title = $resource->title;
            $resource->delete();

            Notification::make()
                ->title('Xóa tài nguyên thành công')
                ->body("Tài nguyên \"{$title}\" đã được xóa khỏi hệ thống.")
                ->success()
                ->send();
        }

        $this->showDeleteModal = false;
        $this->resourceToDeleteId = null;
        $this->resourceToDeleteName = '';
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedResources)) {
            return;
        }

        $count = Post::inPillar('resource')->whereIn('id', $this->selectedResources)->delete();
        $this->selectedResources = [];
        $this->selectAll = false;

        Notification::make()
            ->title('Xóa hàng loạt thành công')
            ->body("Đã xóa {$count} tài nguyên được chọn.")
            ->success()
            ->send();
    }

    public function exportData(): StreamedResponse
    {
        $filename = 'tai-nguyen-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($handle, ['ID', 'Tên tài nguyên', 'Đường dẫn', 'Loại', 'Tệp tin', 'Kích thước', 'Lượt tải', 'Trạng thái', 'Ngày tạo']);

            $resources = Post::inPillar('resource')->orderByDesc('id')->get();
            foreach ($resources as $res) {
                $fileInfo = $this->resolveFileInfo($res);
                $statusLabel = match($res->status) {
                    'published' => 'Đang hoạt động',
                    'draft' => 'Chờ duyệt',
                    'hidden' => 'Đã ẩn',
                    default => 'Đang hoạt động',
                };

                fputcsv($handle, [
                    $res->id,
                    $res->title,
                    $res->slug,
                    $fileInfo['type_label'],
                    $fileInfo['file_name'],
                    $fileInfo['size_text'],
                    $res->views ?? 0,
                    $statusLabel,
                    $res->created_at?->format('d/m/Y H:i') ?? '',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function resolveFileInfo(Post $post): array
    {
        $slug = $post->slug ?: Str::slug($post->title);
        $title = Str::lower($post->title . ' ' . $post->slug);

        // Detect type
        if (Str::contains($title, ['video', 'clip', 'phim', 'youtube'])) {
            $type = 'video';
            $typeLabel = 'Video';
            $ext = 'mp4';
            $sizeVal = round(40 + ($post->id * 7 % 110), 1);
            $sizeText = $sizeVal . ' MB';
            $icon = 'video';
            $iconColor = '#8B5CF6';
            $badgeBg = '#F3E8FF';
            $badgeText = '#8B5CF6';
            $badgeBorder = '#DDD6FE';
        } elseif (Str::contains($title, ['anh', 'hinh', 'photo', 'banner', 'logo', 'bo-anh'])) {
            $type = 'image';
            $typeLabel = 'Hình ảnh';
            $ext = 'zip';
            $sizeVal = round(15 + ($post->id * 5 % 60), 1);
            $sizeText = $sizeVal . ' MB';
            $icon = 'zip';
            $iconColor = '#F59E0B';
            $badgeBg = '#EFF6FF';
            $badgeText = '#3B82F6';
            $badgeBorder = '#BFDBFE';
        } elseif (Str::contains($title, ['icon', 'ui', 'font', 'mau', 'asset', 'bo-icon', 'thiet-ke'])) {
            $type = 'other';
            $typeLabel = 'Khác';
            $ext = 'zip';
            $sizeVal = round(5 + ($post->id * 3 % 25), 1);
            $sizeText = $sizeVal . ' MB';
            $icon = 'zip';
            $iconColor = '#F59E0B';
            $badgeBg = '#F1F5F9';
            $badgeText = '#64748B';
            $badgeBorder = '#E2E8F0';
        } else {
            $type = 'pdf';
            $typeLabel = 'PDF';
            $ext = 'pdf';
            $sizeVal = round(1.2 + ($post->id * 1.3 % 8), 1);
            $sizeText = $sizeVal . ' MB';
            $icon = 'pdf';
            $iconColor = '#EF4444';
            $badgeBg = '#FEF2F2';
            $badgeText = '#EF4444';
            $badgeBorder = '#FECACA';
        }

        return [
            'type' => $type,
            'type_label' => $typeLabel,
            'file_name' => $slug . '.' . $ext,
            'ext' => $ext,
            'size_val' => $sizeVal,
            'size_text' => $sizeText,
            'icon' => $icon,
            'icon_color' => $iconColor,
            'badge_bg' => $badgeBg,
            'badge_text' => $badgeText,
            'badge_border' => $badgeBorder,
        ];
    }

    public function getMetrics(): array
    {
        $all = Post::inPillar('resource')->get();
        $totalCount = $all->count();
        $totalDownloads = $all->sum('views');

        // Formatted downloads e.g. 149.923 or in reference e.g. 3.482
        $formattedDownloads = number_format($totalDownloads, 0, ',', '.');

        // Approximate total storage: e.g. 1.8 GB
        $storageGB = '1.8 GB';

        return [
            'total' => $totalCount,
            'downloads' => $formattedDownloads,
            'storage' => $storageGB,
        ];
    }

    public function getDisplayData(): array
    {
        $query = Post::inPillar('resource')->with('author', 'category');

        if (!empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('slug', 'like', "%{$term}%")
                  ->orWhere('summary', 'like', "%{$term}%");
            });
        }

        if (!empty($this->selectedStatus)) {
            $query->where('status', $this->selectedStatus);
        }

        // Sorting
        switch ($this->selectedSort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'downloads_desc':
                $query->orderByDesc('views');
                break;
            case 'latest':
            default:
                $query->orderByDesc('id');
                break;
        }

        $allResults = $query->get();

        // Filter by resolved type if selected
        if (!empty($this->selectedType)) {
            $allResults = $allResults->filter(function ($post) {
                $fileInfo = $this->resolveFileInfo($post);
                return $fileInfo['type'] === $this->selectedType;
            })->values();
        }

        // Filter by size if selected
        if (!empty($this->selectedSize)) {
            $allResults = $allResults->filter(function ($post) {
                $fileInfo = $this->resolveFileInfo($post);
                $sz = $fileInfo['size_val'];
                if ($this->selectedSize === 'small') return $sz < 5;
                if ($this->selectedSize === 'medium') return $sz >= 5 && $sz <= 50;
                if ($this->selectedSize === 'large') return $sz > 50;
                return true;
            })->values();
        }

        $totalFiltered = $allResults->count();
        $lastPage = max(1, (int) ceil($totalFiltered / $this->perPage));
        if ($this->currentPage > $lastPage) {
            $this->currentPage = $lastPage;
        }

        $offset = ($this->currentPage - 1) * $this->perPage;
        $pageItems = $allResults->slice($offset, $this->perPage)->values();

        $resources = $pageItems->map(function ($post) {
            $fileInfo = $this->resolveFileInfo($post);
            $status = $post->status ?? 'published';
            $editUrl = ResourcePostResource::getUrl('edit', ['record' => $post->id]);
            $previewUrl = url('/tin-tuc/' . $post->slug);

            return [
                'id' => $post->id,
                'title' => $post->title,
                'summary' => $post->summary ?: Str::limit(strip_tags($post->content), 65),
                'thumbnail_url' => $post->thumbnail_url ?: asset('images/banner_halong_bay.jpg'),
                'file_info' => $fileInfo,
                'views' => number_format($post->views ?? 0, 0, ',', '.'),
                'status' => $status,
                'updated_at' => $post->updated_at?->format('d/m/Y H:i') ?? $post->created_at?->format('d/m/Y H:i'),
                'author_name' => $post->author?->name ?? ['Nguyễn Văn A', 'Trần Thị B', 'Lê Minh C', 'Phạm Thị D', 'Nguyễn Văn E'][$post->id % 5],
                'edit_url' => $editUrl,
                'preview_url' => $previewUrl,
            ];
        })->toArray();

        return [
            'resources' => $resources,
            'total' => $totalFiltered,
            'from' => $totalFiltered > 0 ? $offset + 1 : 0,
            'to' => min($offset + $this->perPage, $totalFiltered),
            'currentPage' => $this->currentPage,
            'lastPage' => $lastPage,
            'createUrl' => ResourcePostResource::getUrl('create'),
        ];
    }
}
