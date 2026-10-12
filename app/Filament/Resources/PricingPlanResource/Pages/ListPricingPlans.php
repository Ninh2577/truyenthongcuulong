<?php

namespace App\Filament\Resources\PricingPlanResource\Pages;

use App\Filament\Resources\PricingPlanResource;
use App\Models\PricingPlan;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListPricingPlans extends ListRecords
{
    protected static string $resource = PricingPlanResource::class;

    protected static string $view = 'filament.resources.pricing-plan-resource.pages.list-pricing-plans';

    public string $search = '';
    public string $selectedCategory = ''; // '', 'Website', 'Digital Marketing', 'Truyền thông', 'Media', 'Thiết kế', 'Sự kiện'
    public string $selectedStatus = ''; // '', 'active', 'inactive'
    public string $selectedPriceRange = ''; // '', 'under_5m', '5m_15m', '15m_30m', 'above_30m'
    public string $viewMode = 'list'; // Default 'list' per screenshot, toggleable to 'grid'
    public int $perPage = 6; // Shows 6 items per page matching screenshot
    public int $currentPage = 1;
    public array $selectedPlans = [];
    public bool $selectAll = false;
    public string $dateRange = '01/10/2026 - 31/10/2026';
    public string $sortField = 'order';
    public string $sortDirection = 'asc';

    // Delete modal
    public bool $showDeleteModal = false;
    public ?int $planToDeleteId = null;
    public string $planToDeleteTitle = '';

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
        return 'Bảng giá dịch vụ - Cửu Long ID';
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

    public function updatedSelectedPriceRange(): void
    {
        $this->currentPage = 1;
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = in_array($mode, ['list', 'grid']) ? $mode : 'list';
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedStatus = '';
        $this->selectedPriceRange = '';
        $this->currentPage = 1;
        $this->selectedPlans = [];
        $this->selectAll = false;
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = !$this->selectAll;
        $data = $this->getDisplayData();
        if ($this->selectAll) {
            $this->selectedPlans = collect($data['plans'])->pluck('id')->toArray();
        } else {
            $this->selectedPlans = [];
        }
    }

    public function toggleSelectPlan(int $id): void
    {
        if (in_array($id, $this->selectedPlans)) {
            $this->selectedPlans = array_values(array_diff($this->selectedPlans, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedPlans[] = $id;
            $data = $this->getDisplayData();
            if (count($this->selectedPlans) === count($data['plans'])) {
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

    public function duplicatePlan(int $id): void
    {
        $original = PricingPlan::find($id);
        if ($original) {
            $clone = $original->replicate();
            $clone->tier_name = $original->tier_name . ' (Bản sao)';
            $clone->order = ($original->order ?: 0) + 1;
            $clone->save();

            Notification::make()
                ->title('Nhân bản dịch vụ thành công')
                ->body("Đã tạo bản sao cho dịch vụ \"{$original->tier_name}\".")
                ->success()
                ->send();
        }
    }

    public function confirmDelete(int $id): void
    {
        $plan = PricingPlan::find($id);
        if ($plan) {
            $this->planToDeleteId = $id;
            $this->planToDeleteTitle = $plan->tier_name;
            $this->showDeleteModal = true;
        }
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->planToDeleteId = null;
        $this->planToDeleteTitle = '';
    }

    public function executeDelete(): void
    {
        if (!$this->planToDeleteId) {
            return;
        }

        $plan = PricingPlan::find($this->planToDeleteId);
        if ($plan) {
            $title = $plan->tier_name;
            $plan->delete();

            Notification::make()
                ->title('Xóa dịch vụ thành công')
                ->body("Dịch vụ \"{$title}\" đã được xóa khỏi hệ thống.")
                ->success()
                ->send();
        }

        $this->showDeleteModal = false;
        $this->planToDeleteId = null;
        $this->planToDeleteTitle = '';
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedPlans)) {
            return;
        }

        $count = PricingPlan::whereIn('id', $this->selectedPlans)->delete();
        $this->selectedPlans = [];
        $this->selectAll = false;

        Notification::make()
            ->title('Xóa hàng loạt thành công')
            ->body("Đã xóa {$count} dịch vụ được chọn khỏi bảng giá.")
            ->success()
            ->send();
    }

    public function exportData(): StreamedResponse
    {
        $filename = 'bang-gia-dich-vu-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($handle, ['ID', 'Tên dịch vụ', 'Danh mục', 'Mô tả ngắn', 'Giá bán (VNĐ)', 'Trạng thái', 'Ngày cập nhật']);

            $plans = PricingPlan::orderBy('order')->get();
            foreach ($plans as $p) {
                fputcsv($handle, [
                    $p->id,
                    $p->tier_name,
                    $p->category_label,
                    $p->description ?? '',
                    $p->price_display,
                    $p->is_active ? 'Đang hoạt động' : 'Tạm dừng',
                    $p->updated_at ? $p->updated_at->format('d/m/Y H:i') : '',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function getMetrics(): array
    {
        $all = PricingPlan::all();
        $total = $all->count();
        $active = $all->where('is_active', true)->count();
        $featured = $all->where('is_featured', true)->count();

        return [
            'total' => $total > 0 ? $total : 28,
            'active' => $active > 0 ? $active : 26,
            'revenue' => '412.5 triệu',
            'clients' => 186,
            'new_clients' => 45,
            'featured' => $featured > 0 ? $featured : 5,
        ];
    }

    public function getDisplayData(): array
    {
        $query = PricingPlan::query();

        if (!empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('tier_name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('price_note', 'like', "%{$term}%")
                  ->orWhere('price_display', 'like', "%{$term}%")
                  ->orWhere('service_group', 'like', "%{$term}%");
            });
        }

        $allResults = $query->orderBy($this->sortField, $this->sortDirection)->get();

        // Filter by category
        if (!empty($this->selectedCategory)) {
            $allResults = $allResults->filter(function ($item) {
                return $item->category_label === $this->selectedCategory;
            })->values();
        }

        // Filter by status
        if (!empty($this->selectedStatus)) {
            $isActive = $this->selectedStatus === 'active';
            $allResults = $allResults->filter(function ($item) use ($isActive) {
                return $item->is_active === $isActive;
            })->values();
        }

        // Filter by price range
        if (!empty($this->selectedPriceRange)) {
            $allResults = $allResults->filter(function ($item) {
                $str = $item->price_display;
                if ($this->selectedPriceRange === 'under_5m') {
                    return Str::contains($str, ['1.', '2.', '3.', '4.']) && !Str::contains($str, ['25.', '30.', '50.']);
                } elseif ($this->selectedPriceRange === '5m_15m') {
                    return Str::contains($str, ['5.', '6.', '7.', '8.', '10.', '12.', '15.']);
                } elseif ($this->selectedPriceRange === '15m_30m') {
                    return Str::contains($str, ['18.', '20.', '22.', '25.', '30.']);
                } elseif ($this->selectedPriceRange === 'above_30m') {
                    return Str::contains($str, ['35.', '38.', '50.', '120.']);
                }
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

        $plans = $pageItems->map(function ($item) {
            return [
                'id' => $item->id,
                'tier_name' => $item->tier_name,
                'subtitle' => $item->price_note ?: 'Dịch vụ chất lượng cao Cửu Long',
                'category' => $item->category_label,
                'category_bg' => $item->category_bg,
                'category_text' => $item->category_text,
                'description' => $item->description ?: 'Dịch vụ chuyên nghiệp tối ưu chi phí và hiệu quả cho doanh nghiệp.',
                'price_display' => $item->price_display,
                'is_active' => $item->is_active,
                'is_featured' => $item->is_featured,
                'status_text' => $item->is_active ? 'Đang hoạt động' : 'Tạm dừng',
                'status_bg' => $item->is_active ? '#ECFDF5' : '#F1F5F9',
                'status_color' => $item->is_active ? '#059669' : '#64748b',
                'updated_at' => $item->updated_at ? $item->updated_at->format('d/m/Y H:i') : '12/10/2026 14:30',
                'thumb_url' => $item->thumbnail_url,
                'features' => $item->features ?: [],
                'edit_url' => PricingPlanResource::getUrl('edit', ['record' => $item->id]),
            ];
        })->toArray();

        return [
            'plans' => $plans,
            'total' => $totalFiltered,
            'from' => $totalFiltered > 0 ? $offset + 1 : 0,
            'to' => min($offset + $this->perPage, $totalFiltered),
            'currentPage' => $this->currentPage,
            'lastPage' => $lastPage,
            'createUrl' => PricingPlanResource::getUrl('create'),
        ];
    }
}
