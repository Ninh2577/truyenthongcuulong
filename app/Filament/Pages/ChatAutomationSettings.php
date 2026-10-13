<?php

namespace App\Filament\Pages;

use App\Services\Chat\Automation\ChatAutomationEngine;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ChatAutomationSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Kịch bản tự động';
    protected static ?string $title = 'Kịch Bản Tự Động';
    protected static ?string $slug = 'chat-automation';
    protected static ?int $navigationSort = 30;
    protected static string $view = 'filament.pages.chat-automation-settings';

    public array $rules = [];
    public bool $isSaving = false;

    public string $activeFilter = 'all';
    public string $search = '';
    public string $selectedScriptId = 'welcome_customer';
    public array $selectedIds = [];
    public bool $selectAll = false;

    public array $scripts = [];

    public function getHeading(): string
    {
        return '';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        return $user->hasRole(['super_admin', 'Admin']) || $user->can('manage_chat_settings');
    }

    public function mount(ChatAutomationEngine $engine): void
    {
        $this->rules = $engine->getRules();
        $this->loadScripts();
    }

    protected function loadScripts(): void
    {
        $defaults = [
            [
                'id' => 'welcome_customer',
                'name' => 'Chào mừng khách hàng',
                'desc' => 'Tự động gửi tin nhắn chào mừng khi khách hàng bắt đầu cuộc trò chuyện với website.',
                'category' => 'welcome',
                'category_label' => 'Chào mừng',
                'trigger' => 'Khi khách hàng nhắn tin đầu tiên',
                'enabled' => true,
                'usage_count' => '1.248',
                'icon' => 'chat',
                'icon_color' => '#0284c7',
                'icon_bg' => '#e0f2fe',
                'preview_trigger' => 'Khách hàng bắt đầu chat',
                'preview_user_msg' => 'Xin chào!',
                'preview_bot_msg' => "Chào bạn! Cảm ơn bạn đã quan tâm đến Cửu Long ID. Bạn cần tư vấn về dịch vụ nào ạ?\n\nVui lòng chọn:",
                'preview_options' => [
                    'Dự án tiêu biểu',
                    'Bảng giá dịch vụ',
                    'Đăng ký tư vấn',
                ],
            ],
            [
                'id' => 'consulting_general',
                'name' => 'Tư vấn dịch vụ chung',
                'desc' => 'Tự động phản hồi thông tin về các dịch vụ của công ty khi khách hàng hỏi.',
                'category' => 'consulting',
                'category_label' => 'Tư vấn dịch vụ',
                'trigger' => 'Khi khách hàng hỏi về dịch vụ (ví dụ: "dịch vụ là gì", "bảng giá...")',
                'enabled' => true,
                'usage_count' => '856',
                'icon' => 'document',
                'icon_color' => '#16a34a',
                'icon_bg' => '#dcfce7',
                'preview_trigger' => 'Khách hỏi dịch vụ',
                'preview_user_msg' => 'Bên mình có những dịch vụ nào vậy?',
                'preview_bot_msg' => "Truyền Thông Cửu Long cung cấp các gói giải pháp dịch vụ truyền thông chuyên nghiệp:",
                'preview_options' => [
                    'Sản xuất Video / TVC',
                    'Livestream sự kiện',
                    'Bảng giá & Khuyến mãi',
                ],
            ],
            [
                'id' => 'quick_quote_support',
                'name' => 'Hỗ trợ báo giá nhanh',
                'desc' => 'Cung cấp bảng giá nhanh cho khách hàng theo nhu cầu (dự án, sự kiện...).',
                'category' => 'consulting',
                'category_label' => 'Tư vấn dịch vụ',
                'trigger' => 'Khi khách hàng gửi từ khóa ("bảng giá", "chi phí", "giá dịch vụ...")',
                'enabled' => true,
                'usage_count' => '623',
                'icon' => 'phone',
                'icon_color' => '#9333ea',
                'icon_bg' => '#f3e8ff',
                'preview_trigger' => 'Khách gửi từ khóa báo giá',
                'preview_user_msg' => 'Báo giá dịch vụ quay phim giúp mình',
                'preview_bot_msg' => "Dạ Cửu Long xin gửi báo giá chi tiết theo từng hạng mục để bạn tham khảo ngay:",
                'preview_options' => [
                    'Bảng giá quay phim TVC',
                    'Bảng giá Livestream',
                    'Gặp chuyên viên tư vấn',
                ],
            ],
            [
                'id' => 'customer_care',
                'name' => 'Chăm sóc khách hàng',
                'desc' => 'Gửi tin nhắn cảm ơn và hỏi thăm sau khi khách hàng đã sử dụng dịch vụ.',
                'category' => 'care',
                'category_label' => 'Chăm sóc KH',
                'trigger' => 'Sau 2 ngày kể từ khi kết thúc cuộc trò chuyện',
                'enabled' => false,
                'usage_count' => '312',
                'icon' => 'user',
                'icon_color' => '#ea580c',
                'icon_bg' => '#ffedd5',
                'preview_trigger' => 'Sau 2 ngày kết thúc',
                'preview_user_msg' => '[Kích hoạt tự động theo lịch]',
                'preview_bot_msg' => "Chào bạn! Cảm ơn bạn đã tin tưởng dịch vụ của Cửu Long ID. Bạn có hài lòng với chất lượng phục vụ không ạ?",
                'preview_options' => [
                    'Rất hài lòng ⭐⭐⭐⭐⭐',
                    'Cần hỗ trợ thêm',
                    'Gửi góp ý kiến',
                ],
            ],
            [
                'id' => 'spam_filter',
                'name' => 'Chặn tin rác & Spam',
                'desc' => 'Tự động phát hiện và chặn các tin nhắn có nội dung spam, quảng cáo, không phù hợp.',
                'category' => 'other',
                'category_label' => 'Khác',
                'trigger' => 'Khi từ khóa: spam, quảng cáo, casino, số điện thoại lạ...',
                'enabled' => true,
                'usage_count' => '1.932',
                'icon' => 'shield',
                'icon_color' => '#dc2626',
                'icon_bg' => '#fee2e2',
                'preview_trigger' => 'Phát hiện từ khóa nghi vấn',
                'preview_user_msg' => 'Quảng cáo cược uy tín...',
                'preview_bot_msg' => "[Hệ thống tự động phát hiện và chặn tin nhắn theo bộ lọc an toàn]",
                'preview_options' => [
                    'Báo cáo quản trị',
                    'Kiểm tra danh sách chặn',
                ],
            ],
            [
                'id' => 'new_project_info',
                'name' => 'Gửi thông tin dự án mới',
                'desc' => 'Tự động gửi thông tin dự án mới đến khách hàng đăng ký nhận tin.',
                'category' => 'other',
                'category_label' => 'Khác',
                'trigger' => 'Khi khách hàng đăng ký nhận tin',
                'enabled' => true,
                'usage_count' => '421',
                'icon' => 'image',
                'icon_color' => '#0284c7',
                'icon_bg' => '#e0f2fe',
                'preview_trigger' => 'Khách đăng ký bản tin',
                'preview_user_msg' => 'Tôi muốn nhận tin dự án mới',
                'preview_bot_msg' => "Cảm ơn bạn! Thông tin về các dự án tiêu biểu và ưu đãi mới nhất sẽ được cập nhật đến bạn:",
                'preview_options' => [
                    'Dự án nổi bật 2026',
                    'Hồ sơ năng lực',
                ],
            ],
        ];

        $saved = \App\Models\ChatSetting::get('chat_automation_scripts_v2');
        if (is_array($saved) && ! empty($saved)) {
            // merge or use saved
            $this->scripts = $saved;
        } else {
            $this->scripts = $defaults;
        }
    }

    public function setFilter(string $filter): void
    {
        $this->activeFilter = $filter;
    }

    public function selectScript(string $id): void
    {
        $this->selectedScriptId = $id;
    }

    public function toggleScript(string $id, ChatAutomationEngine $engine): void
    {
        foreach ($this->scripts as &$script) {
            if ($script['id'] === $id) {
                $script['enabled'] = ! $script['enabled'];
                $statusText = $script['enabled'] ? 'kích hoạt' : 'tạm dừng';
                \App\Models\ChatSetting::set('chat_automation_scripts_v2', $this->scripts, 'Kịch bản tự động');

                Notification::make()
                    ->title("Đã {$statusText} kịch bản: {$script['name']}")
                    ->success()
                    ->send();
                break;
            }
        }
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = ! $this->selectAll;
        if ($this->selectAll) {
            $this->selectedIds = array_column($this->getFilteredScripts(), 'id');
        } else {
            $this->selectedIds = [];
        }
    }

    public function toggleSelect(string $id): void
    {
        if (in_array($id, $this->selectedIds)) {
            $this->selectedIds = array_diff($this->selectedIds, [$id]);
        } else {
            $this->selectedIds[] = $id;
        }
        $this->selectAll = count($this->selectedIds) === count($this->getFilteredScripts());
    }

    public function createNewScript(): void
    {
        Notification::make()
            ->title('Mở trình tạo kịch bản mới')
            ->info()
            ->body('Tính năng khởi tạo kịch bản kéo thả trực quan đang sẵn sàng.')
            ->send();
    }

    public function duplicateScript(string $id): void
    {
        foreach ($this->scripts as $script) {
            if ($script['id'] === $id) {
                $copy = $script;
                $copy['id'] = $script['id'] . '_copy_' . time();
                $copy['name'] = $script['name'] . ' (Bản sao)';
                $copy['usage_count'] = '0';
                $this->scripts[] = $copy;
                \App\Models\ChatSetting::set('chat_automation_scripts_v2', $this->scripts, 'Kịch bản tự động');

                Notification::make()
                    ->title("Đã sao chép kịch bản: {$script['name']}")
                    ->success()
                    ->send();
                break;
            }
        }
    }

    public function editScript(string $id): void
    {
        $this->selectedScriptId = $id;
        Notification::make()
            ->title('Chế độ chỉnh sửa kịch bản')
            ->info()
            ->body('Bạn có thể xem trước và điều chỉnh cấu hình kịch bản ở khung bên phải.')
            ->send();
    }

    public function getFilteredScripts(): array
    {
        $list = $this->scripts;

        if ($this->activeFilter !== 'all') {
            $list = array_filter($list, function ($s) {
                return ($s['category'] ?? '') === $this->activeFilter;
            });
        }

        if (trim($this->search) !== '') {
            $term = mb_strtolower(trim($this->search), 'UTF-8');
            $list = array_filter($list, function ($s) use ($term) {
                $name = mb_strtolower($s['name'] ?? '', 'UTF-8');
                $desc = mb_strtolower($s['desc'] ?? '', 'UTF-8');
                $trigger = mb_strtolower($s['trigger'] ?? '', 'UTF-8');
                return str_contains($name, $term) || str_contains($desc, $term) || str_contains($trigger, $term);
            });
        }

        return array_values($list);
    }

    public function getSelectedScript(): ?array
    {
        foreach ($this->scripts as $s) {
            if ($s['id'] === $this->selectedScriptId) {
                return $s;
            }
        }
        return $this->scripts[0] ?? null;
    }

    /**
     * Backward compatibility with previous rules list
     */
    public function toggleRule(string $ruleId, ChatAutomationEngine $engine): void
    {
        foreach ($this->rules as &$rule) {
            if (($rule['id'] ?? '') === $ruleId) {
                $rule['enabled'] = ! ($rule['enabled'] ?? false);
                break;
            }
        }

        $engine->saveRules($this->rules);

        Notification::make()
            ->title('Đã cập nhật trạng thái quy tắc')
            ->success()
            ->send();
    }

    public function save(ChatAutomationEngine $engine): void
    {
        $this->isSaving = true;
        \App\Models\ChatSetting::set('chat_automation_scripts_v2', $this->scripts, 'Kịch bản tự động');
        $this->isSaving = false;

        Notification::make()
            ->title('Đã lưu cấu hình kịch bản tự động thành công!')
            ->success()
            ->send();
    }
}
