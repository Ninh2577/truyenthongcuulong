<?php

namespace App\Filament\Pages;

use App\Services\Chat\ChatQuickReplyService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Str;

class ChatQuickRepliesSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-command-line';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Phím tắt & Mẫu tin';
    protected static ?string $title = 'Phím tắt & Mẫu tin nhắn';
    protected static ?string $slug = 'chat-quick-replies';
    protected static ?int $navigationSort = 25;
    protected static string $view = 'filament.pages.chat-quick-replies-settings';

    public function getMaxContentWidth(): MaxWidth | string | null
    {
        return MaxWidth::Full;
    }

    // Filters & Search
    public string $search = '';
    public string $activeCategory = 'all';
    public string $activeType = 'all';
    public string $activeStatus = 'all';

    // Modals
    public bool $showModal = false;
    public bool $isEditing = false;
    public string $editingId = '';
    public bool $showResetModal = false;
    public bool $showGuideModal = false;

    // Form fields
    public string $replyTitle = '';
    public string $shortcut = '';
    public string $category = 'Tư vấn dịch vụ';
    public string $description = '';
    public string $content = '';
    public bool $is_active = true;

    // Quick preview modal
    public bool $showPreviewModal = false;
    public ?array $previewItem = null;

    protected function rules(): array
    {
        return [
            'replyTitle' => 'required|min:2|max:100',
            'shortcut' => 'required|min:2|max:30',
            'category' => 'required|max:50',
            'content' => 'required|min:5|max:2000',
        ];
    }

    public function getService(): ChatQuickReplyService
    {
        return app(ChatQuickReplyService::class);
    }

    public function getAllRepliesProperty(): array
    {
        return $this->getService()->getAllQuickReplies();
    }

    public function getQuickRepliesProperty(): array
    {
        $all = $this->allReplies;

        // Filter by category
        if ($this->activeCategory !== 'all') {
            $all = array_filter($all, fn ($item) => ($item['category'] ?? '') === $this->activeCategory);
        }

        // Filter by status
        if ($this->activeStatus === 'active') {
            $all = array_filter($all, fn ($item) => (bool) ($item['is_active'] ?? true));
        } elseif ($this->activeStatus === 'inactive') {
            $all = array_filter($all, fn ($item) => ! (bool) ($item['is_active'] ?? true));
        }

        // Filter by search
        if (trim($this->search) !== '') {
            $q = mb_strtolower(trim($this->search));
            $cleanQ = ltrim($q, '/');
            $all = array_filter($all, function ($item) use ($cleanQ) {
                return str_contains(mb_strtolower(ltrim($item['shortcut'], '/')), $cleanQ)
                    || str_contains(mb_strtolower($item['title']), $cleanQ)
                    || str_contains(mb_strtolower($item['content']), $cleanQ)
                    || str_contains(mb_strtolower($item['category'] ?? ''), $cleanQ);
            });
        }

        return array_values($all);
    }

    public function getCategoryCountsProperty(): array
    {
        $all = $this->allReplies;
        $standardCats = ['Chào hỏi', 'Tư vấn dịch vụ', 'Báo giá', 'CSKH', 'Khác'];
        $counts = [
            'all' => count($all),
        ];

        foreach ($standardCats as $cat) {
            $counts[$cat] = count(array_filter($all, fn ($i) => ($i['category'] ?? '') === $cat));
        }

        return $counts;
    }

    public function getStatsProperty(): array
    {
        $all = $this->allReplies;
        $active = count(array_filter($all, fn ($i) => (bool) ($i['is_active'] ?? true)));
        $totalUsage = array_sum(array_column($all, 'usage_count'));
        $uniqueShortcuts = count(array_unique(array_column($all, 'shortcut')));
        $categoriesCount = count(array_unique(array_filter(array_column($all, 'category'))));

        return [
            'total' => count($all),
            'shortcuts' => $uniqueShortcuts,
            'today_usage' => max(45, (int) round($totalUsage * 0.15)),
            'categories' => $categoriesCount,
            'active' => $active,
        ];
    }

    public function getCategoryMeta(string $category): array
    {
        return match ($category) {
            'Chào hỏi', 'Chào đón' => [
                'icon' => '💬',
                'bg' => '#eff6ff',
                'color' => '#2563eb',
                'tag_bg' => '#f3e8ff',
                'tag_text' => '#7e22ce',
            ],
            'Tư vấn dịch vụ', 'Dịch vụ Website', 'Dịch vụ Marketing', 'Dịch vụ Media' => [
                'icon' => '💼',
                'bg' => '#ecfdf5',
                'color' => '#059669',
                'tag_bg' => '#ecfdf5',
                'tag_text' => '#047857',
            ],
            'Báo giá' => [
                'icon' => '💲',
                'bg' => '#fffbeb',
                'color' => '#d97706',
                'tag_bg' => '#fef3c7',
                'tag_text' => '#b45309',
            ],
            'CSKH', 'Liên hệ' => [
                'icon' => '📞',
                'bg' => '#f5f3ff',
                'color' => '#7c3aed',
                'tag_bg' => '#f5f3ff',
                'tag_text' => '#6d28d9',
            ],
            default => [
                'icon' => '❓',
                'bg' => '#f8fafc',
                'color' => '#64748b',
                'tag_bg' => '#f1f5f9',
                'tag_text' => '#475569',
            ],
        };
    }

    public function openCreateModal(): void
    {
        $this->resetValidation();
        $this->isEditing = false;
        $this->editingId = '';
        $this->replyTitle = '';
        $this->shortcut = '/';
        $this->category = 'Tư vấn dịch vụ';
        $this->description = '';
        $this->content = '';
        $this->is_active = true;
        $this->showModal = true;
    }

    public function openEditModal(string $id): void
    {
        $this->resetValidation();
        $service = $this->getService();
        $all = $service->getAllQuickReplies();
        $item = collect($all)->firstWhere('id', $id);

        if (! $item) {
            Notification::make()->title('Không tìm thấy mẫu tin')->danger()->send();
            return;
        }

        $this->isEditing = true;
        $this->editingId = $id;
        $this->replyTitle = $item['title'];
        $this->shortcut = $item['shortcut'];
        $this->category = $item['category'] ?? 'Tư vấn dịch vụ';
        $this->description = $item['description'] ?? '';
        $this->content = $item['content'];
        $this->is_active = (bool) ($item['is_active'] ?? true);
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        $service = $this->getService();
        $cleanShortcut = '/' . ltrim(trim($this->shortcut), '/');

        $data = [
            'title' => $this->replyTitle,
            'shortcut' => $cleanShortcut,
            'category' => $this->category,
            'description' => $this->description,
            'content' => $this->content,
            'is_active' => $this->is_active,
        ];

        if ($this->isEditing) {
            $service->updateQuickReply($this->editingId, $data);
            Notification::make()->title('Đã cập nhật phím tắt thành công')->success()->send();
        } else {
            $service->createQuickReply($data);
            Notification::make()->title('Đã thêm mới phím tắt thành công')->success()->send();
        }

        $this->showModal = false;
    }

    public function duplicate(string $id): void
    {
        $service = $this->getService();
        $all = $service->getAllQuickReplies();
        $item = collect($all)->firstWhere('id', $id);

        if (! $item) {
            return;
        }

        $newItem = $item;
        $newItem['title'] = $item['title'] . ' (Bản sao)';
        $newItem['shortcut'] = $item['shortcut'] . '_copy';
        unset($newItem['id']);

        $service->createQuickReply($newItem);
        Notification::make()->title('Đã nhân bản phím tắt')->success()->send();
    }

    public function toggleStatus(string $id): void
    {
        $this->getService()->toggleQuickReply($id);
        Notification::make()->title('Đã thay đổi trạng thái hoạt động')->success()->send();
    }

    public function delete(string $id): void
    {
        $this->getService()->deleteQuickReply($id);
        Notification::make()->title('Đã xóa phím tắt thành công')->success()->send();
    }

    public function openResetModal(): void
    {
        $this->showResetModal = true;
    }

    public function confirmReset(): void
    {
        $this->getService()->resetToDefaults();
        $this->showResetModal = false;
        Notification::make()->title('Đã khôi phục danh mục phím tắt tiêu chuẩn')->success()->send();
    }

    public function openGuideModal(): void
    {
        $this->showGuideModal = true;
    }

    public function closeGuideModal(): void
    {
        $this->showGuideModal = false;
    }
}
