<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Models\Client;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected static string $view = 'filament.resources.client-resource.pages.list-clients';

    public string $search = '';
    public string $selectedIndustry = ''; // '', 'Bất động sản', 'Công nghệ', 'Tài chính', 'Bán lẻ', 'Ngân hàng', 'Thương mại điện tử', 'Sản xuất', 'Du lịch', 'Y tế', 'Giáo dục'
    public string $selectedStatus = ''; // '', 'active', 'inactive'
    public string $viewMode = 'grid'; // Default 'grid' per screenshot, toggleable to 'list'
    public int $perPage = 8; // 8 items per page per screenshot
    public int $currentPage = 1;
    public string $dateRange = '01/10/2026 - 31/10/2026';

    // Delete modal
    public bool $showDeleteModal = false;
    public ?int $clientToDeleteId = null;
    public string $clientToDeleteName = '';

    // Speed configuration modal
    public bool $showSpeedModal = false;
    public int $speedHome = 80;
    public int $speedMedia = 80;
    public int $speedClients = 85;

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
        return 'Khách hàng tiêu biểu - Cửu Long ID';
    }

    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedIndustry(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedStatus(): void
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
        $this->selectedIndustry = '';
        $this->selectedStatus = '';
        $this->currentPage = 1;
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
        $client = Client::find($id);
        if ($client) {
            $this->clientToDeleteId = $id;
            $this->clientToDeleteName = $client->name;
            $this->showDeleteModal = true;
        }
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->clientToDeleteId = null;
        $this->clientToDeleteName = '';
    }

    public function executeDelete(): void
    {
        if (!$this->clientToDeleteId) {
            return;
        }

        $client = Client::find($this->clientToDeleteId);
        if ($client) {
            $name = $client->name;
            $client->delete();

            Notification::make()
                ->title('Xóa khách hàng thành công')
                ->body("Khách hàng \"{$name}\" đã được xóa khỏi hệ thống.")
                ->success()
                ->send();
        }

        $this->showDeleteModal = false;
        $this->clientToDeleteId = null;
        $this->clientToDeleteName = '';
    }

    public function openSpeedModal(): void
    {
        $this->speedHome = (int) setting('client_marquee_speed_home', 80);
        $this->speedMedia = (int) setting('client_marquee_speed_media', 80);
        $this->speedClients = (int) setting('client_marquee_speed_clients', 85);
        $this->showSpeedModal = true;
    }

    public function closeSpeedModal(): void
    {
        $this->showSpeedModal = false;
    }

    public function saveSpeedSettings(): void
    {
        $this->speedHome = max(10, min(300, (int) $this->speedHome));
        $this->speedMedia = max(10, min(300, (int) $this->speedMedia));
        $this->speedClients = max(10, min(300, (int) $this->speedClients));

        \App\Models\Setting::updateOrCreate(['key' => 'client_marquee_speed_home'], ['value' => (string) $this->speedHome]);
        \App\Models\Setting::updateOrCreate(['key' => 'client_marquee_speed_media'], ['value' => (string) $this->speedMedia]);
        \App\Models\Setting::updateOrCreate(['key' => 'client_marquee_speed_clients'], ['value' => (string) $this->speedClients]);

        clear_setting_cache();

        Notification::make()
            ->title('Lưu tốc độ cuộn logo thành công')
            ->body("Trang chủ: {$this->speedHome}s | Media: {$this->speedMedia}s | Khách hàng: {$this->speedClients}s")
            ->success()
            ->send();

        $this->showSpeedModal = false;
    }

    public function toggleLocation(int $clientId, string $location): void
    {
        $client = Client::find($clientId);
        if (!$client) {
            return;
        }

        if ($location === 'home') {
            $client->show_on_home = !$client->show_on_home;
            $status = $client->show_on_home ? 'hiển thị' : 'ẩn';
            $locationName = 'Trang chủ';
        } elseif ($location === 'media') {
            $client->show_on_media = !$client->show_on_media;
            $status = $client->show_on_media ? 'hiển thị' : 'ẩn';
            $locationName = 'Trang Media';
        } elseif ($location === 'clients') {
            $client->show_on_clients = !$client->show_on_clients;
            $status = $client->show_on_clients ? 'hiển thị' : 'ẩn';
            $locationName = 'Trang Khách hàng';
        } else {
            return;
        }

        $client->save();

        Notification::make()
            ->title("Đã {$status} trên {$locationName}")
            ->body("Khách hàng \"{$client->name}\" đã được cập nhật hiển thị.")
            ->success()
            ->send();
    }

    public function toggleActiveStatus(int $clientId): void
    {
        $client = Client::find($clientId);
        if (!$client) {
            return;
        }

        $client->is_active = !$client->is_active;
        $client->save();

        $status = $client->is_active ? 'Kích hoạt' : 'Tạm dừng';
        Notification::make()
            ->title("Đã {$status}")
            ->body("Khách hàng \"{$client->name}\" đã được chuyển sang trạng thái {$status}.")
            ->success()
            ->send();
    }

    public function updateClientOrder(int $clientId, int $order): void
    {
        $client = Client::find($clientId);
        if (!$client) {
            return;
        }

        $client->order = max(0, $order);
        $client->save();

        Notification::make()
            ->title('Cập nhật thứ tự thành công')
            ->body("Khách hàng \"{$client->name}\" đã đổi thứ tự vị trí sang #{$client->order}.")
            ->success()
            ->send();
    }

    public function exportData(): StreamedResponse
    {
        $filename = 'khach-hang-tieu-bieu-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($handle, ['ID', 'Tên khách hàng', 'Lĩnh vực', 'Dịch vụ sử dụng', 'Người đại diện', 'Chức vụ', 'Năm hợp tác', 'Trạng thái']);

            $clients = Client::orderBy('order')->get();
            foreach ($clients as $c) {
                fputcsv($handle, [
                    $c->id,
                    $c->name,
                    $c->industry_label,
                    $c->service_used ?? '',
                    $c->representative_name,
                    $c->representative_role,
                    $c->year_started ?? '2022',
                    $c->is_active ? 'Đang hợp tác' : 'Tạm dừng',
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
        $realCount = Client::count();
        $newCount = Client::where('year_started', '>=', '2023')->count();
        $industriesCount = Client::all()->pluck('industry_label')->unique()->count();

        return [
            'total' => $realCount,
            'new' => $newCount > 0 ? $newCount : 12,
            'satisfaction' => '98%',
            'industries' => $industriesCount > 0 ? $industriesCount : 5,
        ];
    }

    public function getDisplayData(): array
    {
        $query = Client::query();

        if (!empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('industry_category', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('service_used', 'like', "%{$term}%");
            });
        }

        $allResults = $query->orderBy('order', 'asc')->orderBy('id', 'asc')->get();

        // Filter by industry
        if (!empty($this->selectedIndustry)) {
            $allResults = $allResults->filter(function ($item) {
                return $item->industry_label === $this->selectedIndustry;
            })->values();
        }

        // Filter by status
        if (!empty($this->selectedStatus)) {
            $isActive = $this->selectedStatus === 'active';
            $allResults = $allResults->filter(function ($item) use ($isActive) {
                return $item->is_active === $isActive;
            })->values();
        }

        $totalFiltered = $allResults->count();
        $totalDisplayCount = $totalFiltered;

        $lastPage = max(1, (int) ceil($totalDisplayCount / $this->perPage));
        if ($this->currentPage > $lastPage) {
            $this->currentPage = $lastPage;
        }

        $offset = ($this->currentPage - 1) * $this->perPage;
        $pageItems = $allResults->slice($offset, $this->perPage)->values();

        $items = $pageItems->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'logo_url' => $item->logo_url,
                'banner_url' => $item->banner_url,
                'description' => $item->description ?: 'Dịch vụ truyền thông của Cửu Long rất chuyên nghiệp, sáng tạo và đúng tiến độ.',
                'industry' => $item->industry_label,
                'industry_bg' => $item->industry_bg,
                'industry_text' => $item->industry_text,
                'representative_name' => $item->representative_name,
                'representative_role' => $item->representative_role,
                'representative_avatar' => $item->representative_avatar,
                'date_text' => $item->year_started ? 'Năm ' . $item->year_started : ($item->created_at ? $item->created_at->format('d/m/Y') : '12/10/2026'),
                'service_used' => $item->service_used ?: 'Sản xuất Media & Thiết kế',
                'is_active' => $item->is_active,
                'status_text' => $item->is_active ? 'Đang hợp tác' : 'Tạm dừng',
                'order' => $item->order,
                'show_on_home' => (bool) $item->show_on_home,
                'show_on_media' => (bool) $item->show_on_media,
                'show_on_clients' => (bool) $item->show_on_clients,
                'edit_url' => ClientResource::getUrl('edit', ['record' => $item->id]),
            ];
        })->toArray();

        return [
            'clients' => $items,
            'total' => $totalDisplayCount,
            'from' => $totalFiltered > 0 ? $offset + 1 : 0,
            'to' => min($offset + $this->perPage, $totalDisplayCount),
            'currentPage' => $this->currentPage,
            'lastPage' => $lastPage,
            'createUrl' => ClientResource::getUrl('create'),
        ];
    }
}
