<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected static string $view = 'filament.resources.contact-resource.pages.list-contacts';

    public string $search = '';
    public string $selectedStatus = ''; // '', 'resolved', 'processing', 'new', 'rejected'
    public string $selectedChannel = ''; // '', 'website', 'hotline', 'form', 'email', 'zalo'
    public string $selectedDate = ''; // '', 'today', '7days', '30days', 'month'
    public string $dateRange = '01/10/2026 - 31/10/2026';
    public int $perPage = 6;
    public int $currentPage = 1;
    public string $viewMode = 'list'; // 'list', 'grid'
    public array $selectedContacts = [];
    public bool $selectAll = false;

    // Create modal state
    public bool $showCreateModal = false;
    public string $createFullname = '';
    public string $createCustomerType = 'Khách hàng mới';
    public string $createPhone = '';
    public string $createEmail = '';
    public string $createChannel = 'website';
    public string $createService = '';
    public string $createMessage = '';
    public string $createStatus = 'new';

    // View detail modal state
    public bool $showViewModal = false;
    public ?array $viewingContact = null;

    // Edit status modal state
    public bool $showEditModal = false;
    public ?int $editingContactId = null;
    public string $editStatus = 'new';
    public string $editAdminNote = '';

    // Delete modal confirmation
    public bool $showDeleteModal = false;
    public ?int $contactToDeleteId = null;
    public string $contactToDeleteName = '';

    public function mount(): void
    {
        parent::mount();
        $this->dateRange = now()->startOfMonth()->format('d/m/Y') . ' - ' . now()->endOfMonth()->format('d/m/Y');
    }

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
        return 'Yêu Cầu Tư Vấn - Cửu Long ID';
    }

    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedStatus(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedChannel(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedDate(): void
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
        $this->selectedChannel = '';
        $this->selectedDate = '';
        $this->currentPage = 1;
        $this->selectedContacts = [];
        $this->selectAll = false;
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = !$this->selectAll;
        $data = $this->getDisplayData();
        if ($this->selectAll) {
            $this->selectedContacts = collect($data['contacts'])->pluck('id')->toArray();
        } else {
            $this->selectedContacts = [];
        }
    }

    public function toggleSelectContact(int $id): void
    {
        if (in_array($id, $this->selectedContacts)) {
            $this->selectedContacts = array_values(array_diff($this->selectedContacts, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedContacts[] = $id;
            $data = $this->getDisplayData();
            if (count($this->selectedContacts) === count($data['contacts'])) {
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

    public function openCreateModal(): void
    {
        $this->createFullname = '';
        $this->createCustomerType = 'Khách hàng mới';
        $this->createPhone = '';
        $this->createEmail = '';
        $this->createChannel = 'website';
        $this->createService = '';
        $this->createMessage = '';
        $this->createStatus = 'new';
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
    }

    public function saveNewContact(): void
    {
        $this->validate([
            'createFullname' => 'required|string|max:255',
            'createPhone' => 'required|string|max:30',
            'createMessage' => 'required|string',
        ], [
            'createFullname.required' => 'Vui lòng nhập họ và tên khách hàng.',
            'createPhone.required' => 'Vui lòng nhập số điện thoại.',
            'createMessage.required' => 'Vui lòng nhập nội dung yêu cầu tư vấn.',
        ]);

        $contact = Contact::create([
            'fullname' => $this->createFullname,
            'customer_type' => $this->createCustomerType,
            'phone' => $this->createPhone,
            'email' => $this->createEmail ?: null,
            'channel' => $this->createChannel,
            'service_interested' => $this->createService ?: null,
            'message' => $this->createMessage,
            'status' => $this->createStatus,
            'created_at' => now(),
        ]);

        $this->showCreateModal = false;

        Notification::make()
            ->title('Tạo yêu cầu tư vấn thành công')
            ->body("Đã lưu yêu cầu tư vấn từ khách hàng \"{$contact->fullname}\".")
            ->success()
            ->send();
    }

    public function openViewModal(int $id): void
    {
        $c = Contact::find($id);
        if ($c) {
            $this->viewingContact = [
                'id' => $c->id,
                'fullname' => $c->fullname,
                'customer_type' => $c->customer_type ?: 'Khách hàng mới',
                'avatar' => $c->avatar,
                'phone' => $c->phone,
                'email' => $c->email,
                'channel' => $c->channel ?: 'website',
                'service_interested' => $c->service_interested,
                'message' => $c->message,
                'status' => $c->status,
                'admin_note' => $c->admin_note,
                'created_at' => $c->created_at?->format('d/m/Y H:i') ?? '',
                'created_relative' => $c->created_at?->diffForHumans() ?? '',
            ];
            $this->showViewModal = true;
        }
    }

    public function closeViewModal(): void
    {
        $this->showViewModal = false;
        $this->viewingContact = null;
    }

    public function openEditModal(int $id): void
    {
        $c = Contact::find($id);
        if ($c) {
            $this->editingContactId = $c->id;
            $this->editStatus = $c->status;
            $this->editAdminNote = $c->admin_note ?? '';
            $this->showEditModal = true;
        }
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->editingContactId = null;
    }

    public function saveEditStatus(): void
    {
        if (!$this->editingContactId) {
            return;
        }

        $c = Contact::find($this->editingContactId);
        if ($c) {
            $c->status = $this->editStatus;
            $c->admin_note = $this->editAdminNote;
            if ($this->editStatus === 'resolved' && is_null($c->replied_at)) {
                $c->replied_at = now();
            }
            $c->save();

            Notification::make()
                ->title('Cập nhật trạng thái thành công')
                ->body("Yêu cầu tư vấn của \"{$c->fullname}\" đã được chuyển sang trạng thái mới.")
                ->success()
                ->send();
        }

        $this->showEditModal = false;
        $this->editingContactId = null;
    }

    public function confirmDelete(int $id): void
    {
        $c = Contact::find($id);
        if ($c) {
            $this->contactToDeleteId = $id;
            $this->contactToDeleteName = $c->fullname;
            $this->showDeleteModal = true;
        }
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->contactToDeleteId = null;
        $this->contactToDeleteName = '';
    }

    public function executeDelete(): void
    {
        if (!$this->contactToDeleteId) {
            return;
        }

        $c = Contact::find($this->contactToDeleteId);
        if ($c) {
            $name = $c->fullname;
            $c->delete();

            Notification::make()
                ->title('Xóa yêu cầu tư vấn thành công')
                ->body("Yêu cầu tư vấn của \"{$name}\" đã được xóa khỏi hệ thống.")
                ->success()
                ->send();
        }

        $this->showDeleteModal = false;
        $this->contactToDeleteId = null;
        $this->contactToDeleteName = '';
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedContacts)) {
            return;
        }

        $count = Contact::whereIn('id', $this->selectedContacts)->delete();
        $this->selectedContacts = [];
        $this->selectAll = false;

        Notification::make()
            ->title('Xóa hàng loạt thành công')
            ->body("Đã xóa {$count} yêu cầu tư vấn được chọn.")
            ->success()
            ->send();
    }

    public function exportData(): StreamedResponse
    {
        $filename = 'yeu-cau-tu-van-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($handle, ['ID', 'Họ tên', 'Loại khách hàng', 'Số điện thoại', 'Email', 'Kênh tiếp nhận', 'Nội dung', 'Trạng thái', 'Thời gian gửi']);

            $contacts = Contact::orderByDesc('created_at')->get();
            foreach ($contacts as $c) {
                fputcsv($handle, [
                    $c->id,
                    $c->fullname,
                    $c->customer_type ?: 'Khách hàng mới',
                    $c->phone,
                    $c->email,
                    $c->channel ?: 'website',
                    $c->message,
                    $c->status,
                    $c->created_at?->format('d/m/Y H:i') ?? '',
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
        $total = Contact::count();
        $resolved = Contact::where('status', 'resolved')->count();
        $pending = Contact::whereIn('status', ['new', 'processing'])->count();
        $today = Contact::whereDate('created_at', today())->count();

        // Calculate real trend compared to previous month
        $lastMonthTotal = Contact::whereMonth('created_at', now()->subMonth()->month)
                                 ->whereYear('created_at', now()->subMonth()->year)
                                 ->count();
        $thisMonthTotal = Contact::whereMonth('created_at', now()->month)
                                 ->whereYear('created_at', now()->year)
                                 ->count();

        if ($lastMonthTotal > 0) {
            $totalDiff = round((($thisMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100);
            $totalTrend = ($totalDiff >= 0 ? '+' : '') . $totalDiff . '%';
            $totalTrendUp = $totalDiff >= 0;
        } else {
            $totalTrend = $thisMonthTotal > 0 ? '+100%' : '0%';
            $totalTrendUp = true;
        }

        // Resolved percentage of total
        $resolvedPct = $total > 0 ? round(($resolved / $total) * 100) : 0;
        $resolvedTrend = $resolvedPct . '%';

        // Pending percentage of total
        $pendingPct = $total > 0 ? round(($pending / $total) * 100) : 0;
        $pendingTrend = $pendingPct . '%';

        // Today trend vs yesterday
        $yesterday = Contact::whereDate('created_at', today()->subDay())->count();
        if ($yesterday > 0) {
            $todayDiff = round((($today - $yesterday) / $yesterday) * 100);
            $todayTrend = ($todayDiff >= 0 ? '+' : '') . $todayDiff . '%';
            $todayTrendUp = $todayDiff >= 0;
        } else {
            $todayTrend = $today > 0 ? '+100%' : '0%';
            $todayTrendUp = true;
        }

        return [
            'total' => number_format($total, 0, ',', '.'),
            'total_trend' => $totalTrend,
            'total_trend_up' => $totalTrendUp,
            'total_sub' => 'So với tháng trước',

            'resolved' => number_format($resolved, 0, ',', '.'),
            'resolved_trend' => $resolvedTrend,
            'resolved_trend_up' => true,
            'resolved_sub' => 'Đã phản hồi khách hàng',

            'pending' => number_format($pending, 0, ',', '.'),
            'pending_trend' => $pendingTrend,
            'pending_trend_up' => false,
            'pending_sub' => 'Cần phản hồi',

            'today' => number_format($today, 0, ',', '.'),
            'today_trend' => $todayTrend,
            'today_trend_up' => $todayTrendUp,
            'today_sub' => 'Yêu cầu mới',
        ];
    }

    public function getDisplayData(): array
    {
        $query = Contact::query();

        if (!empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('fullname', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('message', 'like', "%{$term}%");
            });
        }

        if (!empty($this->selectedStatus) && $this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }

        if (!empty($this->selectedChannel) && $this->selectedChannel !== 'all') {
            $query->where('channel', $this->selectedChannel);
        }

        if (!empty($this->selectedDate) && $this->selectedDate !== 'all') {
            if ($this->selectedDate === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($this->selectedDate === '7days') {
                $query->where('created_at', '>=', now()->subDays(7));
            } elseif ($this->selectedDate === '30days') {
                $query->where('created_at', '>=', now()->subDays(30));
            } elseif ($this->selectedDate === 'month') {
                $query->whereMonth('created_at', now()->month);
            }
        }

        $query->orderByDesc('created_at')->orderByDesc('id');

        $totalFiltered = $query->count();
        $lastPage = max(1, (int) ceil($totalFiltered / $this->perPage));
        $this->currentPage = min($this->currentPage, $lastPage);

        $contacts = $query->skip(($this->currentPage - 1) * $this->perPage)
                          ->take($this->perPage)
                          ->get();

        $from = $totalFiltered > 0 ? (($this->currentPage - 1) * $this->perPage + 1) : 0;
        $to = min($this->currentPage * $this->perPage, $totalFiltered);

        return [
            'contacts' => $contacts,
            'total' => $totalFiltered,
            'displayTotal' => $totalFiltered,
            'totalDisplayFormatted' => number_format($totalFiltered, 0, ',', '.'),
            'currentPage' => $this->currentPage,
            'lastPage' => $lastPage,
            'perPage' => $this->perPage,
            'from' => $from,
            'to' => $to,
        ];
    }
}
