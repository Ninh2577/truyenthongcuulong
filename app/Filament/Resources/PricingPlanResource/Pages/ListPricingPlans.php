<?php

namespace App\Filament\Resources\PricingPlanResource\Pages;

use App\Filament\Resources\PricingPlanResource;
use App\Enums\PricingServiceGroup;
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
    public string $selectedCategory = ''; // '', 'web', 'tvc', ...
    public string $selectedStatus = ''; // '', 'active', 'inactive', 'featured'
    public string $selectedPriceRange = ''; // '', 'under_5m', '5m_15m', '15m_30m', 'above_30m'
    public array $sidebarDisplayPages = []; // ['pricing', 'service', 'both', 'none']
    public array $sidebarServiceGroups = []; // ['tvc', 'web', 'marketing', ...]
    public string $sidebarStatus = ''; // '', 'active', 'inactive', 'featured'
    public string $viewMode = 'list'; // 'list' or 'grid'
    public int $perPage = 8;
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

    public function updatedSidebarDisplayPages(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSidebarServiceGroups(): void
    {
        $this->currentPage = 1;
    }

    public function setSidebarStatus(string $status): void
    {
        if ($this->sidebarStatus === $status) {
            $this->sidebarStatus = '';
        } else {
            $this->sidebarStatus = $status;
        }
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
        $this->sidebarDisplayPages = [];
        $this->sidebarServiceGroups = [];
        $this->sidebarStatus = '';
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

    public function toggleLocation(int $planId, string $location): void
    {
        $plan = PricingPlan::find($planId);
        if (!$plan) {
            return;
        }

        if ($location === 'pricing') {
            $plan->show_on_pricing_page = !$plan->show_on_pricing_page;
            $status = $plan->show_on_pricing_page ? 'hiển thị' : 'ẩn';
            $locationName = 'Trang Bảng giá (/dich-vu/bang-gia)';
        } elseif ($location === 'service') {
            $plan->show_on_service_page = !$plan->show_on_service_page;
            $status = $plan->show_on_service_page ? 'hiển thị' : 'ẩn';
            $locationName = 'Trang Dịch vụ con';
        } else {
            return;
        }

        $plan->save();

        Notification::make()
            ->title("Đã {$status} trên {$locationName}")
            ->body("Gói \"{$plan->tier_name}\" đã được cập nhật hiển thị.")
            ->success()
            ->send();
    }

    public function toggleActiveStatus(int $planId): void
    {
        $plan = PricingPlan::find($planId);
        if (!$plan) {
            return;
        }

        $plan->is_active = !$plan->is_active;
        $plan->save();

        $status = $plan->is_active ? 'Kích hoạt' : 'Tạm dừng';
        Notification::make()
            ->title("Đã {$status}")
            ->body("Gói \"{$plan->tier_name}\" đã chuyển sang trạng thái {$status}.")
            ->success()
            ->send();
    }

    public function toggleFeaturedStatus(int $planId): void
    {
        $plan = PricingPlan::find($planId);
        if (!$plan) {
            return;
        }

        $plan->is_featured = !$plan->is_featured;
        $plan->save();

        $status = $plan->is_featured ? 'Đặt làm gói Nổi bật' : 'Bỏ gói Nổi bật';
        Notification::make()
            ->title($status)
            ->body("Gói \"{$plan->tier_name}\" ({$plan->category_label}) đã được cập nhật.")
            ->success()
            ->send();
    }

    public function updatePlanOrder(int $planId, int $order): void
    {
        $plan = PricingPlan::find($planId);
        if (!$plan) {
            return;
        }

        $plan->order = max(0, $order);
        $plan->save();

        Notification::make()
            ->title('Cập nhật thứ tự thành công')
            ->body("Gói \"{$plan->tier_name}\" đã đổi thứ tự vị trí sang #{$plan->order}.")
            ->success()
            ->send();
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
            fputcsv($handle, ['ID', 'Tên gói dịch vụ', 'Nhóm dịch vụ', 'Giá hiển thị', 'Ghi chú giá', 'Nổi bật', 'Hiện trên Bảng giá', 'Hiện trên Trang dịch vụ', 'Trang đích', 'Trạng thái', 'Ngày cập nhật']);

            $plans = PricingPlan::orderBy('order')->get();
            foreach ($plans as $p) {
                fputcsv($handle, [
                    $p->id,
                    $p->tier_name,
                    $p->category_label,
                    $p->price_display,
                    $p->price_note ?? '',
                    $p->is_featured ? 'Có' : 'Không',
                    $p->show_on_pricing_page ? 'Hiển thị' : 'Ẩn',
                    $p->show_on_service_page ? 'Hiển thị' : 'Ẩn',
                    $p->target_page ?? '',
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
        $pricingCount = $all->where('show_on_pricing_page', true)->count();
        $serviceCount = $all->where('show_on_service_page', true)->count();
        $featured = $all->where('is_featured', true)->count();

        return [
            'total' => $total,
            'active' => $active,
            'pricing_page' => $pricingCount,
            'service_page' => $serviceCount,
            'featured' => $featured,
        ];
    }

    public function getSidebarFacets(): array
    {
        $all = PricingPlan::all();

        $pricingCount = $all->where('show_on_pricing_page', true)->count();
        $serviceCount = $all->where('show_on_service_page', true)->count();
        $bothCount = $all->filter(fn($p) => $p->show_on_pricing_page && $p->show_on_service_page)->count();
        $noneCount = $all->filter(fn($p) => !$p->show_on_pricing_page && !$p->show_on_service_page)->count();

        $groups = [
            ['id' => 'tvc', 'label' => 'Sản Xuất Video & TVC'],
            ['id' => 'web', 'label' => 'Thiết Kế Web & App'],
            ['id' => 'marketing', 'label' => 'Quảng Cáo & Marketing'],
            ['id' => 'ui-ux', 'label' => 'Thiết Kế UI/UX'],
            ['id' => 'website-care', 'label' => 'Quản Trị & Chăm Sóc Web'],
            ['id' => 'event-photography', 'label' => 'Chụp Ảnh Sự Kiện'],
            ['id' => 'event-videography', 'label' => 'Quay Phim Sự Kiện'],
            ['id' => 'teambuilding-photography', 'label' => 'Chụp Ảnh Teambuilding'],
            ['id' => 'teambuilding-videography', 'label' => 'Quay Phim Teambuilding'],
        ];

        $groupsFacets = [];
        foreach ($groups as $g) {
            $c = $all->where('service_group', $g['id'])->count();
            $groupsFacets[] = [
                'id' => $g['id'],
                'label' => $g['label'],
                'count' => $c,
            ];
        }

        $activeCount = $all->where('is_active', true)->count();
        $inactiveCount = $all->where('is_active', false)->count();
        $featuredCount = $all->where('is_featured', true)->count();

        return [
            'display_pages' => [
                ['id' => 'pricing', 'label' => 'Trang Bảng giá (/dich-vu/bang-gia)', 'count' => $pricingCount],
                ['id' => 'service', 'label' => 'Trang Dịch vụ con', 'count' => $serviceCount],
                ['id' => 'both', 'label' => 'Hiển thị đồng thời cả 2 nơi', 'count' => $bothCount],
                ['id' => 'none', 'label' => 'Chưa hiển thị nơi nào', 'count' => $noneCount],
            ],
            'service_groups' => $groupsFacets,
            'statuses' => [
                ['id' => 'active', 'label' => 'Đang hoạt động', 'count' => $activeCount, 'color' => '#10b981'],
                ['id' => 'featured', 'label' => 'Gói nổi bật (Hot)', 'count' => $featuredCount, 'color' => '#f59e0b'],
                ['id' => 'inactive', 'label' => 'Tạm dừng hiển thị', 'count' => $inactiveCount, 'color' => '#94a3b8'],
            ],
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
                  ->orWhere('service_group', 'like', "%{$term}%")
                  ->orWhere('target_page', 'like', "%{$term}%");
            });
        }

        // Filter by sidebar display pages
        if (!empty($this->sidebarDisplayPages)) {
            $query->where(function ($q) {
                foreach ($this->sidebarDisplayPages as $p) {
                    if ($p === 'pricing') {
                        $q->orWhere('show_on_pricing_page', true);
                    } elseif ($p === 'service') {
                        $q->orWhere('show_on_service_page', true);
                    } elseif ($p === 'both') {
                        $q->orWhere(function ($sub) {
                            $sub->where('show_on_pricing_page', true)->where('show_on_service_page', true);
                        });
                    } elseif ($p === 'none') {
                        $q->orWhere(function ($sub) {
                            $sub->where('show_on_pricing_page', false)->where('show_on_service_page', false);
                        });
                    }
                }
            });
        }

        // Filter by sidebar service groups
        if (!empty($this->sidebarServiceGroups)) {
            $query->whereIn('service_group', $this->sidebarServiceGroups);
        }

        // Filter by sidebar status
        if (!empty($this->sidebarStatus)) {
            if ($this->sidebarStatus === 'active') {
                $query->where('is_active', true);
            } elseif ($this->sidebarStatus === 'inactive') {
                $query->where('is_active', false);
            } elseif ($this->sidebarStatus === 'featured') {
                $query->where('is_featured', true);
            }
        }

        // Toolbar category filter
        if (!empty($this->selectedCategory)) {
            $query->where('service_group', $this->selectedCategory);
        }

        // Toolbar status filter
        if (!empty($this->selectedStatus)) {
            if ($this->selectedStatus === 'active') {
                $query->where('is_active', true);
            } elseif ($this->selectedStatus === 'inactive') {
                $query->where('is_active', false);
            } elseif ($this->selectedStatus === 'featured') {
                $query->where('is_featured', true);
            }
        }

        $allResults = $query->orderBy($this->sortField, $this->sortDirection)->get();

        // Toolbar price range filter
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
            $targetUrl = !empty($item->target_page)
                ? url($item->target_page)
                : match ($item->service_group) {
                    'web' => url('/dich-vu/web-app'),
                    'ui-ux' => url('/dich-vu/ui-ux'),
                    'marketing' => url('/dich-vu/marketing'),
                    'website-care' => url('/dich-vu/quan-tri-website'),
                    'event-photography' => url('/dich-vu/chup-anh-su-kien'),
                    'event-videography' => url('/dich-vu/quay-phim-su-kien'),
                    'tvc' => url('/dich-vu/bang-gia#tvc'),
                    'teambuilding-photography' => url('/dich-vu/chup-anh-teambuilding'),
                    'teambuilding-videography' => url('/dich-vu/quay-phim-teambuilding'),
                    default => url('/dich-vu'),
                };
            return [
                'id' => $item->id,
                'tier_name' => $item->tier_name,
                'subtitle' => $item->price_note ?: 'Dịch vụ chất lượng cao Cửu Long',
                'service_group' => $item->service_group,
                'category' => $item->category_label,
                'category_bg' => $item->category_bg,
                'category_text' => $item->category_text,
                'description' => $item->description ?: 'Dịch vụ chuyên nghiệp tối ưu chi phí và hiệu quả cho doanh nghiệp.',
                'price_display' => $item->price_display,
                'order' => $item->order,
                'is_active' => $item->is_active,
                'is_featured' => $item->is_featured,
                'show_on_pricing_page' => $item->show_on_pricing_page,
                'show_on_service_page' => $item->show_on_service_page,
                'target_page' => $item->target_page,
                'target_url' => $targetUrl,
                'status_text' => $item->is_active ? 'Đang hoạt động' : 'Tạm dừng',
                'status_bg' => $item->is_active ? '#ECFDF5' : '#F1F5F9',
                'status_color' => $item->is_active ? '#059669' : '#64748b',
                'updated_at' => $item->updated_at ? $item->updated_at->format('d/m/Y H:i') : '',
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
