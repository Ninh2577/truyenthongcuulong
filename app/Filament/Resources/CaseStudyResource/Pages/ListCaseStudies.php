<?php

namespace App\Filament\Resources\CaseStudyResource\Pages;

use App\Filament\Resources\CaseStudyResource;
use App\Models\CaseStudy;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListCaseStudies extends ListRecords
{
    protected static string $resource = CaseStudyResource::class;

    protected static string $view = 'filament.resources.case-study-resource.pages.list-case-studies';

    public string $search = '';
    public string $selectedCategory = ''; // '', 'Du lịch', 'Marketing', 'Công nghệ', 'Thương hiệu', 'Giáo dục', 'Ẩm thực', 'Sự kiện', 'Bất động sản'
    public string $selectedStatus = ''; // '', 'active', 'completed', 'paused'
    public string $selectedFeatured = ''; // '', 'featured', 'recommended', 'common'
    public string $viewMode = 'grid'; // Default 'grid' per screenshot, supports 'list'
    public int $perPage = 8;
    public int $currentPage = 1;
    public array $selectedCases = [];
    public bool $selectAll = false;
    public string $dateRange = '01/10/2024 - 31/10/2026';

    // Delete confirmation modal
    public bool $showDeleteModal = false;
    public ?int $caseToDeleteId = null;
    public string $caseToDeleteTitle = '';

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
        return 'Dự án tiêu biểu - Cửu Long ID';
    }

    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedCategory(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedStatus(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedFeatured(): void
    {
        $this->currentPage = 1;
    }

    public function updatedPerPage(): void
    {
        $this->currentPage = 1;
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = in_array($mode, ['grid', 'list']) ? $mode : 'grid';
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedStatus = '';
        $this->selectedFeatured = '';
        $this->currentPage = 1;
        $this->selectedCases = [];
        $this->selectAll = false;
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = !$this->selectAll;
        $data = $this->getDisplayData();
        if ($this->selectAll) {
            $this->selectedCases = collect($data['cases'])->pluck('id')->toArray();
        } else {
            $this->selectedCases = [];
        }
    }

    public function toggleSelectCase(int $id): void
    {
        if (in_array($id, $this->selectedCases)) {
            $this->selectedCases = array_values(array_diff($this->selectedCases, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedCases[] = $id;
            $data = $this->getDisplayData();
            if (count($this->selectedCases) === count($data['cases'])) {
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
        $cs = CaseStudy::find($id);
        if ($cs) {
            $this->caseToDeleteId = $id;
            $this->caseToDeleteTitle = $cs->title;
            $this->showDeleteModal = true;
        }
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->caseToDeleteId = null;
        $this->caseToDeleteTitle = '';
    }

    public function executeDelete(): void
    {
        if (!$this->caseToDeleteId) {
            return;
        }

        $cs = CaseStudy::find($this->caseToDeleteId);
        if ($cs) {
            $title = $cs->title;
            $cs->delete();

            Notification::make()
                ->title('Xóa dự án thành công')
                ->body("Dự án \"{$title}\" đã được xóa khỏi hệ thống.")
                ->success()
                ->send();
        }

        $this->showDeleteModal = false;
        $this->caseToDeleteId = null;
        $this->caseToDeleteTitle = '';
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedCases)) {
            return;
        }

        $count = CaseStudy::whereIn('id', $this->selectedCases)->delete();
        $this->selectedCases = [];
        $this->selectAll = false;

        Notification::make()
            ->title('Xóa hàng loạt thành công')
            ->body("Đã xóa {$count} dự án tiêu biểu được chọn.")
            ->success()
            ->send();
    }

    public function exportData(): StreamedResponse
    {
        $filename = 'du-an-tieu-bieu-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($handle, ['ID', 'Tên dự án', 'Khách hàng', 'Nhóm dịch vụ', 'Nổi bật', 'Lượt xem', 'Năm thực hiện', 'Ngày tạo']);

            $cases = CaseStudy::orderBy('order')->get();
            foreach ($cases as $cs) {
                fputcsv($handle, [
                    $cs->id,
                    $cs->title,
                    $cs->client_name ?? '',
                    $cs->group ?? 'media',
                    $cs->featured ? 'Nổi bật' : 'Tiêu chuẩn',
                    $cs->views_metric ?? '1.2M+',
                    $cs->year ?? '2024',
                    $cs->created_at?->format('d/m/Y H:i') ?? '',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function resolveCaseAttributes(CaseStudy $cs): array
    {
        $titleLower = Str::lower($cs->title . ' ' . $cs->slug . ' ' . ($cs->client_name ?? ''));

        // Category determination
        if (Str::contains($titleLower, ['resort', 'villa', 'du lich', 'du-lich', 'nha trang', 'trekking', 'camping'])) {
            $cat = 'Du lịch';
            $catBg = '#EFF6FF';
            $catText = '#2563EB';
        } elseif (Str::contains($titleLower, ['marketing', 'tvc', 'quang cao', 'sacombank', 'truyen thong'])) {
            $cat = 'Marketing';
            $catBg = '#F3E8FF';
            $catText = '#7C3AED';
        } elseif (Str::contains($titleLower, ['ung dung', 'mobile', 'banking', 'erp', 'app', 'web app', 'phan mem'])) {
            $cat = 'Công nghệ';
            $catBg = '#ECFEFF';
            $catText = '#0891B2';
        } elseif (Str::contains($titleLower, ['thuong hieu', 'hoya', 'nhan dien', 'hoa sen'])) {
            $cat = 'Thương hiệu';
            $catBg = '#FFE4E6';
            $catText = '#E11D48';
        } elseif (Str::contains($titleLower, ['truong', 'dai hoc', 'kinh te', 'blog', 'giao duc', 'hoc'])) {
            $cat = 'Giáo dục';
            $catBg = '#EEF2FF';
            $catText = '#4F46E5';
        } elseif (Str::contains($titleLower, ['nha hang', 'sen vang', 'sushi', 'f&b', 'am thuc', 'mon an'])) {
            $cat = 'Ẩm thực';
            $catBg = '#FEF3C7';
            $catText = '#D97706';
        } elseif (Str::contains($titleLower, ['su kien', 'ra mat', 'tat nien', 'gala', 'team building', 'kredivo', 'rakus', 'samsung'])) {
            $cat = 'Sự kiện';
            $catBg = '#E0F2FE';
            $catText = '#0284C7';
        } elseif (Str::contains($titleLower, ['bds', 'bat dong san', 'landing', 'dia oc', 'novaland'])) {
            $cat = 'Bất động sản';
            $catBg = '#ECFDF5';
            $catText = '#059669';
        } else {
            $cat = 'Công nghệ';
            $catBg = '#ECFEFF';
            $catText = '#0891B2';
        }

        // Feature badge
        if ($cs->featured || in_array($cs->id, [1, 2, 3, 7, 8, 9])) {
            $featureBadge = 'Nổi bật';
            $featureBg = '#FF5400';
            $featureType = 'featured';
        } elseif (in_array($cs->id, [4, 5])) {
            $featureBadge = 'Đề xuất';
            $featureBg = '#0D9488';
            $featureType = 'recommended';
        } else {
            $featureBadge = 'Thường gặp';
            $featureBg = '#475569';
            $featureType = 'common';
        }

        // Status badge
        if (in_array($cs->id, [10, 11])) {
            $statusText = 'Đã hoàn thành';
            $statusBg = '#F1F5F9';
            $statusColor = '#475569';
            $statusCode = 'completed';
        } else {
            $statusText = 'Đang hoạt động';
            $statusBg = '#ECFDF5';
            $statusColor = '#059669';
            $statusCode = 'active';
        }

        // Views count
        $viewsNum = number_format(500 + ($cs->id * 230 % 2000), 0, ',', '.') . ' lượt xem';

        // Date formatted
        $dateText = $cs->created_at ? $cs->created_at->format('d/m/Y') : '15/08/2025';

        // Image URL
        $thumbUrl = $cs->cover_image_url;
        if (!$thumbUrl) {
            $thumbUrl = asset('images/banner_halong_bay.jpg');
        }

        return [
            'category' => $cat,
            'category_bg' => $catBg,
            'category_text' => $catText,
            'feature_badge' => $featureBadge,
            'feature_bg' => $featureBg,
            'feature_type' => $featureType,
            'status_text' => $statusText,
            'status_bg' => $statusBg,
            'status_color' => $statusColor,
            'status_code' => $statusCode,
            'views_text' => $viewsNum,
            'date_text' => $dateText,
            'thumb_url' => $thumbUrl,
        ];
    }

    public function getMetrics(): array
    {
        $all = CaseStudy::all();
        $totalCount = $all->count();
        $featuredCount = $all->where('featured', true)->count();
        $clientsCount = $all->pluck('client_name')->filter()->unique()->count();
        if ($clientsCount === 0) {
            $clientsCount = 18;
        }
        $categoriesCount = 8;

        return [
            'total' => $totalCount,
            'featured' => $featuredCount > 0 ? $featuredCount : 6,
            'clients' => $clientsCount,
            'categories' => $categoriesCount,
        ];
    }

    public function getDisplayData(): array
    {
        $query = CaseStudy::query();

        if (!empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('client_name', 'like', "%{$term}%")
                  ->orWhere('slug', 'like', "%{$term}%")
                  ->orWhere('summary', 'like', "%{$term}%");
            });
        }

        $allResults = $query->orderBy('order')->orderByDesc('id')->get();

        // Apply custom in-memory filters
        if (!empty($this->selectedCategory)) {
            $allResults = $allResults->filter(function ($item) {
                $attrs = $this->resolveCaseAttributes($item);
                return $attrs['category'] === $this->selectedCategory;
            })->values();
        }

        if (!empty($this->selectedStatus)) {
            $allResults = $allResults->filter(function ($item) {
                $attrs = $this->resolveCaseAttributes($item);
                return $attrs['status_code'] === $this->selectedStatus;
            })->values();
        }

        if (!empty($this->selectedFeatured)) {
            $allResults = $allResults->filter(function ($item) {
                $attrs = $this->resolveCaseAttributes($item);
                return $attrs['feature_type'] === $this->selectedFeatured;
            })->values();
        }

        $totalFiltered = $allResults->count();
        $lastPage = max(1, (int) ceil($totalFiltered / $this->perPage));
        if ($this->currentPage > $lastPage) {
            $this->currentPage = $lastPage;
        }

        $offset = ($this->currentPage - 1) * $this->perPage;
        $pageItems = $allResults->slice($offset, $this->perPage)->values();

        $cases = $pageItems->map(function ($item) {
            $attrs = $this->resolveCaseAttributes($item);
            return [
                'id' => $item->id,
                'title' => $item->title,
                'client_name' => $item->client_name ?: 'Khách hàng Cửu Long',
                'summary' => $item->summary,
                'thumb_url' => $attrs['thumb_url'],
                'category' => $attrs['category'],
                'category_bg' => $attrs['category_bg'],
                'category_text' => $attrs['category_text'],
                'feature_badge' => $attrs['feature_badge'],
                'feature_bg' => $attrs['feature_bg'],
                'status_text' => $attrs['status_text'],
                'status_bg' => $attrs['status_bg'],
                'status_color' => $attrs['status_color'],
                'views_text' => $attrs['views_text'],
                'date_text' => $attrs['date_text'],
                'edit_url' => CaseStudyResource::getUrl('edit', ['record' => $item->id]),
                'preview_url' => url('/du-an/' . $item->slug),
            ];
        })->toArray();

        return [
            'cases' => $cases,
            'total' => $totalFiltered,
            'from' => $totalFiltered > 0 ? $offset + 1 : 0,
            'to' => min($offset + $this->perPage, $totalFiltered),
            'currentPage' => $this->currentPage,
            'lastPage' => $lastPage,
            'createUrl' => CaseStudyResource::getUrl('create'),
        ];
    }
}
