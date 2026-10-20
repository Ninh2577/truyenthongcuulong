<?php

namespace App\Filament\Pages;

use App\Models\ChatSetting;
use App\Services\Chat\Automation\ChatAutomationEngine;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;

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

    // Filters, Search & Sorting
    public string $search = '';
    public string $activeFilter = 'all'; // category
    public string $statusFilter = 'all'; // all, active, paused
    public string $triggerFilter = 'all';
    public string $priorityFilter = 'all';
    public string $sortBy = 'priority'; // priority, name, usage, updated_at
    public string $sortDirection = 'asc';
    public int $perPage = 10;
    public int $currentPage = 1;

    // Selection & Tabs
    public string $selectedScriptId = 'welcome_customer';
    public array $selectedIds = [];
    public bool $selectAll = false;
    public string $activeSideTab = 'preview'; // preview, workflow, details

    // Modals
    public bool $showCommandPalette = false;
    public string $commandSearch = '';
    public bool $showShortcutModal = false;
    public bool $showTestModal = false;
    public string $testInputMessage = 'Cho tôi bảng giá website';
    public ?array $testSimulationResult = null;
    public bool $showConflictModal = false;
    public array $conflictsList = [];
    public bool $showLogModal = false;
    public array $logsList = [];
    public bool $showVersionModal = false;
    public array $versionsList = [];
    public bool $showBulkDeleteModal = false;
    public bool $showCreateEditModal = false;
    public bool $isEditing = false;

    // Form model for create/edit
    public array $editingScript = [
        'id' => '',
        'name' => '',
        'desc' => '',
        'category' => 'consulting',
        'category_label' => 'Tư vấn dịch vụ',
        'trigger' => '',
        'trigger_type' => 'message_received',
        'priority' => 20,
        'cooldown_seconds' => 30,
        'enabled' => true,
        'preview_trigger' => '',
        'preview_user_msg' => '',
        'preview_bot_msg' => '',
        'preview_options' => [],
        'conditions_text' => '',
        'icon' => 'chat',
        'icon_color' => '#0284c7',
        'icon_bg' => '#e0f2fe',
    ];
    public string $tempOptionInput = '';

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
        $this->refreshConflicts($engine);

        // Record initial version if none exists
        if (empty($engine->getVersions())) {
            $engine->recordVersion('Khởi tạo cấu hình tự động hóa hệ thống Cửu Long', $this->scripts);
        }
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
                'trigger_type' => 'conversation_created',
                'priority' => 10,
                'cooldown_seconds' => 30,
                'enabled' => true,
                'usage_count' => 1248,
                'success_count' => 1248,
                'error_count' => 0,
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
                'updated_at' => '2026-10-18 09:30',
            ],
            [
                'id' => 'consulting_general',
                'name' => 'Tư vấn dịch vụ chung',
                'desc' => 'Tự động phản hồi thông tin về các dịch vụ của công ty khi khách hàng hỏi.',
                'category' => 'consulting',
                'category_label' => 'Tư vấn dịch vụ',
                'trigger' => 'Khi khách hàng hỏi về dịch vụ (ví dụ: "dịch vụ là gì", "danh mục...")',
                'trigger_type' => 'message_received',
                'priority' => 25,
                'cooldown_seconds' => 30,
                'enabled' => true,
                'usage_count' => 856,
                'success_count' => 854,
                'error_count' => 2,
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
                'updated_at' => '2026-10-19 14:15',
            ],
            [
                'id' => 'quick_quote_support',
                'name' => 'Hỗ trợ báo giá nhanh',
                'desc' => 'Cung cấp bảng giá nhanh cho khách hàng theo nhu cầu (dự án, sự kiện...).',
                'category' => 'consulting',
                'category_label' => 'Tư vấn dịch vụ',
                'trigger' => 'Khi khách hàng gửi từ khóa ("bảng giá", "chi phí", "giá dịch vụ...")',
                'trigger_type' => 'message_received',
                'priority' => 20,
                'cooldown_seconds' => 30,
                'enabled' => true,
                'usage_count' => 623,
                'success_count' => 623,
                'error_count' => 0,
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
                'updated_at' => '2026-10-19 16:40',
            ],
            [
                'id' => 'customer_care',
                'name' => 'Chăm sóc khách hàng',
                'desc' => 'Gửi tin nhắn cảm ơn và hỏi thăm sau khi khách hàng đã sử dụng dịch vụ.',
                'category' => 'care',
                'category_label' => 'Chăm sóc KH',
                'trigger' => 'Sau 2 ngày kể từ khi kết thúc cuộc trò chuyện',
                'trigger_type' => 'schedule',
                'priority' => 40,
                'cooldown_seconds' => 3600,
                'enabled' => false,
                'usage_count' => 312,
                'success_count' => 310,
                'error_count' => 2,
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
                'updated_at' => '2026-10-17 11:20',
            ],
            [
                'id' => 'spam_filter',
                'name' => 'Chặn tin rác & Spam',
                'desc' => 'Tự động phát hiện và chặn các tin nhắn có nội dung spam, quảng cáo, không phù hợp.',
                'category' => 'other',
                'category_label' => 'Khác',
                'trigger' => 'Khi từ khóa: spam, quảng cáo, casino, số điện thoại lạ...',
                'trigger_type' => 'message_received',
                'priority' => 5,
                'cooldown_seconds' => 10,
                'enabled' => true,
                'usage_count' => 1932,
                'success_count' => 1932,
                'error_count' => 0,
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
                'updated_at' => '2026-10-20 08:00',
            ],
            [
                'id' => 'new_project_info',
                'name' => 'Gửi thông tin dự án mới',
                'desc' => 'Tự động gửi thông tin dự án mới đến khách hàng đăng ký nhận tin.',
                'category' => 'other',
                'category_label' => 'Khác',
                'trigger' => 'Khi khách hàng đăng ký nhận tin',
                'trigger_type' => 'message_received',
                'priority' => 30,
                'cooldown_seconds' => 300,
                'enabled' => true,
                'usage_count' => 421,
                'success_count' => 421,
                'error_count' => 0,
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
                'updated_at' => '2026-10-18 17:00',
            ],
        ];

        $saved = ChatSetting::get('chat_automation_scripts_v2');
        if (is_array($saved) && ! empty($saved)) {
            // Ensure schema integrity on loaded scripts
            $this->scripts = array_map(function ($s, $idx) {
                $s['priority'] = (int) ($s['priority'] ?? (($idx + 1) * 10));
                $s['cooldown_seconds'] = (int) ($s['cooldown_seconds'] ?? 30);
                $s['usage_count'] = is_numeric(str_replace('.', '', (string) ($s['usage_count'] ?? 0)))
                    ? (int) str_replace('.', '', (string) ($s['usage_count'] ?? 0))
                    : 0;
                $s['success_count'] = (int) ($s['success_count'] ?? $s['usage_count']);
                $s['error_count'] = (int) ($s['error_count'] ?? 0);
                $s['trigger_type'] = $s['trigger_type'] ?? 'message_received';
                $s['updated_at'] = $s['updated_at'] ?? now()->format('Y-m-d H:i');
                return $s;
            }, $saved, array_keys($saved));
        } else {
            $this->scripts = $defaults;
        }
    }

    public function setFilter(string $filter): void
    {
        $this->activeFilter = $filter;
        $this->currentPage = 1;
    }

    public function setStatusFilter(string $status): void
    {
        $this->statusFilter = $status;
        $this->currentPage = 1;
    }

    public function setTriggerFilter(string $trigger): void
    {
        $this->triggerFilter = $trigger;
        $this->currentPage = 1;
    }

    public function setPriorityFilter(string $priority): void
    {
        $this->priorityFilter = $priority;
        $this->currentPage = 1;
    }

    public function setSorting(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
        $this->currentPage = 1;
    }

    public function selectScript(string $id): void
    {
        $this->selectedScriptId = $id;
    }

    public function setSideTab(string $tab): void
    {
        $this->activeSideTab = in_array($tab, ['preview', 'workflow', 'details']) ? $tab : 'preview';
    }

    public function toggleScript(string $id, ChatAutomationEngine $engine): void
    {
        foreach ($this->scripts as &$script) {
            if ($script['id'] === $id) {
                $script['enabled'] = ! ($script['enabled'] ?? false);
                $script['updated_at'] = now()->format('Y-m-d H:i');
                $statusText = $script['enabled'] ? 'kích hoạt' : 'tạm dừng';

                $this->persistScripts($engine, "Đã {$statusText} kịch bản: {$script['name']}");

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

    // ==========================================
    // KEYBOARD SHORTCUTS TARGET ACTIONS
    // ==========================================
    public function toggleCurrentSelected(): void
    {
        if ($this->selectedScriptId) {
            $this->toggleScript($this->selectedScriptId, app(ChatAutomationEngine::class));
        }
    }

    public function editCurrentSelected(): void
    {
        if ($this->selectedScriptId) {
            $this->editScript($this->selectedScriptId);
        }
    }

    public function duplicateCurrentSelected(): void
    {
        if ($this->selectedScriptId) {
            $this->duplicateScript($this->selectedScriptId);
        }
    }

    public function openSelectedDetails(): void
    {
        $this->activeSideTab = 'details';
    }

    public function activateSelected(): void
    {
        if (! $this->selectedScriptId) {
            return;
        }
        foreach ($this->scripts as &$script) {
            if ($script['id'] === $this->selectedScriptId && empty($script['enabled'])) {
                $script['enabled'] = true;
                $script['updated_at'] = now()->format('Y-m-d H:i');
                $this->persistScripts(app(ChatAutomationEngine::class), "Kích hoạt kịch bản: {$script['name']}");
                Notification::make()->title("Đã kích hoạt: {$script['name']}")->success()->send();
                break;
            }
        }
    }

    public function pauseSelected(): void
    {
        if (! $this->selectedScriptId) {
            return;
        }
        foreach ($this->scripts as &$script) {
            if ($script['id'] === $this->selectedScriptId && ! empty($script['enabled'])) {
                $script['enabled'] = false;
                $script['updated_at'] = now()->format('Y-m-d H:i');
                $this->persistScripts(app(ChatAutomationEngine::class), "Tạm dừng kịch bản: {$script['name']}");
                Notification::make()->title("Đã tạm dừng: {$script['name']}")->info()->send();
                break;
            }
        }
    }

    public function confirmDeleteCurrentSelected(): void
    {
        if ($this->selectedScriptId) {
            $this->deleteScript($this->selectedScriptId);
        }
    }

    // ==========================================
    // MODALS & COMMAND PALETTE
    // ==========================================
    public function toggleCommandPalette(): void
    {
        $this->showCommandPalette = ! $this->showCommandPalette;
        $this->commandSearch = '';
    }

    public function toggleShortcutModal(): void
    {
        $this->showShortcutModal = ! $this->showShortcutModal;
    }

    public function openTestModal(): void
    {
        $this->showCommandPalette = false;
        $this->showTestModal = true;
        if (! $this->testSimulationResult) {
            $this->runSimulation(app(ChatAutomationEngine::class));
        }
    }

    public function openConflictModal(ChatAutomationEngine $engine): void
    {
        $this->showCommandPalette = false;
        $this->refreshConflicts($engine);
        $this->showConflictModal = true;
    }

    public function openLogModal(ChatAutomationEngine $engine): void
    {
        $this->showCommandPalette = false;
        $this->logsList = $engine->getExecutionLogs(50);
        $this->showLogModal = true;
    }

    public function openVersionModal(ChatAutomationEngine $engine): void
    {
        $this->showCommandPalette = false;
        $this->versionsList = $engine->getVersions();
        $this->showVersionModal = true;
    }

    public function closeModals(): void
    {
        $this->showCommandPalette = false;
        $this->showShortcutModal = false;
        $this->showTestModal = false;
        $this->showConflictModal = false;
        $this->showLogModal = false;
        $this->showVersionModal = false;
        $this->showBulkDeleteModal = false;
        $this->showCreateEditModal = false;
    }

    public function runSimulation(ChatAutomationEngine $engine): void
    {
        $input = trim($this->testInputMessage);
        if ($input === '') {
            $input = 'Cho tôi bảng giá website';
            $this->testInputMessage = $input;
        }

        $this->testSimulationResult = $engine->simulateExecution($input);
    }

    public function restoreVersion(string $versionId, ChatAutomationEngine $engine): void
    {
        $restoredData = $engine->restoreVersion($versionId);
        if ($restoredData) {
            $this->scripts = $restoredData;
            $this->refreshConflicts($engine);
            $this->versionsList = $engine->getVersions();

            Notification::make()
                ->title('Khôi phục phiên bản thành công!')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Không tìm thấy phiên bản để khôi phục')
                ->danger()
                ->send();
        }
    }

    // ==========================================
    // CRUD OPERATIONS
    // ==========================================
    public function createNewScript(): void
    {
        $this->showCommandPalette = false;
        $this->isEditing = false;
        $this->editingScript = [
            'id' => 'script_' . time(),
            'name' => '',
            'desc' => '',
            'category' => 'consulting',
            'category_label' => 'Tư vấn dịch vụ',
            'trigger' => '',
            'trigger_type' => 'message_received',
            'priority' => 20,
            'cooldown_seconds' => 30,
            'enabled' => true,
            'preview_trigger' => 'Khách hàng gửi tin nhắn',
            'preview_user_msg' => 'Tôi muốn được tư vấn',
            'preview_bot_msg' => 'Dạ Cửu Long xin chào! Chúng tôi có thể hỗ trợ gì cho bạn hôm nay ạ?',
            'preview_options' => ['Dịch vụ TVC', 'Livestream sự kiện', 'Báo giá'],
            'conditions_text' => 'message_contains: bảng giá, chi phí',
            'icon' => 'chat',
            'icon_color' => '#ff5400',
            'icon_bg' => '#fff7ed',
        ];
        $this->tempOptionInput = '';
        $this->showCreateEditModal = true;
    }

    public function editScript(string $id): void
    {
        $this->showCommandPalette = false;
        foreach ($this->scripts as $s) {
            if ($s['id'] === $id) {
                $this->selectedScriptId = $id;
                $this->isEditing = true;
                $this->editingScript = array_merge([
                    'trigger_type' => 'message_received',
                    'priority' => 20,
                    'cooldown_seconds' => 30,
                    'preview_options' => [],
                    'conditions_text' => '',
                ], $s);
                $this->tempOptionInput = '';
                $this->showCreateEditModal = true;
                return;
            }
        }
    }

    public function addOptionToEditing(): void
    {
        $opt = trim($this->tempOptionInput);
        if ($opt !== '') {
            $this->editingScript['preview_options'][] = $opt;
            $this->tempOptionInput = '';
        }
    }

    public function removeOptionFromEditing(int $index): void
    {
        if (isset($this->editingScript['preview_options'][$index])) {
            unset($this->editingScript['preview_options'][$index]);
            $this->editingScript['preview_options'] = array_values($this->editingScript['preview_options']);
        }
    }

    public function saveEditingScript(ChatAutomationEngine $engine): void
    {
        // Validation
        $name = trim($this->editingScript['name'] ?? '');
        $trigger = trim($this->editingScript['trigger'] ?? '');
        $botMsg = trim($this->editingScript['preview_bot_msg'] ?? '');

        if ($name === '') {
            Notification::make()->title('Tên kịch bản không được để trống')->danger()->send();
            return;
        }
        if ($trigger === '') {
            Notification::make()->title('Điều kiện kích hoạt không được để trống')->danger()->send();
            return;
        }
        if ($botMsg === '') {
            Notification::make()->title('Nội dung phản hồi không được để trống')->danger()->send();
            return;
        }

        $categoryMap = [
            'welcome' => 'Chào mừng',
            'consulting' => 'Tư vấn dịch vụ',
            'care' => 'Chăm sóc KH',
            'other' => 'Khác',
        ];
        $cat = $this->editingScript['category'] ?? 'consulting';
        $this->editingScript['category_label'] = $categoryMap[$cat] ?? 'Khác';
        $this->editingScript['priority'] = max(1, (int) ($this->editingScript['priority'] ?? 20));
        $this->editingScript['cooldown_seconds'] = max(5, (int) ($this->editingScript['cooldown_seconds'] ?? 30));
        $this->editingScript['updated_at'] = now()->format('Y-m-d H:i');

        if ($this->isEditing) {
            foreach ($this->scripts as &$s) {
                if ($s['id'] === $this->editingScript['id']) {
                    $s = array_merge($s, $this->editingScript);
                    break;
                }
            }
            $actionWord = 'Cập nhật';
        } else {
            $this->editingScript['usage_count'] = 0;
            $this->editingScript['success_count'] = 0;
            $this->editingScript['error_count'] = 0;
            $this->scripts[] = $this->editingScript;
            $this->selectedScriptId = $this->editingScript['id'];
            $actionWord = 'Thêm mới';
        }

        $this->persistScripts($engine, "{$actionWord} kịch bản: {$name}");
        $this->showCreateEditModal = false;

        Notification::make()
            ->title("Đã {$actionWord} kịch bản thành công!")
            ->success()
            ->send();
    }

    public function duplicateScript(string $id): void
    {
        $engine = app(ChatAutomationEngine::class);
        foreach ($this->scripts as $script) {
            if ($script['id'] === $id) {
                $copy = $script;
                $copy['id'] = $script['id'] . '_copy_' . time();
                $copy['name'] = $script['name'] . ' (Bản sao)';
                $copy['usage_count'] = 0;
                $copy['success_count'] = 0;
                $copy['error_count'] = 0;
                $copy['updated_at'] = now()->format('Y-m-d H:i');
                $this->scripts[] = $copy;
                $this->selectedScriptId = $copy['id'];

                $this->persistScripts($engine, "Nhân bản kịch bản: {$script['name']}");

                Notification::make()
                    ->title("Đã nhân bản kịch bản: {$script['name']}")
                    ->success()
                    ->send();
                break;
            }
        }
    }

    public function deleteScript(string $id): void
    {
        $engine = app(ChatAutomationEngine::class);
        $deletedName = '';
        $this->scripts = array_values(array_filter($this->scripts, function ($s) use ($id, &$deletedName) {
            if ($s['id'] === $id) {
                $deletedName = $s['name'];
                return false;
            }
            return true;
        }));

        if ($this->selectedScriptId === $id) {
            $this->selectedScriptId = $this->scripts[0]['id'] ?? '';
        }

        $this->persistScripts($engine, "Đã xóa kịch bản: {$deletedName}");

        Notification::make()
            ->title("Đã xóa kịch bản: {$deletedName}")
            ->success()
            ->send();
    }

    // ==========================================
    // BULK ACTIONS
    // ==========================================
    public function bulkActivate(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }
        $engine = app(ChatAutomationEngine::class);
        $count = 0;
        foreach ($this->scripts as &$s) {
            if (in_array($s['id'], $this->selectedIds)) {
                $s['enabled'] = true;
                $s['updated_at'] = now()->format('Y-m-d H:i');
                $count++;
            }
        }
        $this->persistScripts($engine, "Kích hoạt hàng loạt {$count} kịch bản");
        Notification::make()->title("Đã kích hoạt {$count} kịch bản")->success()->send();
    }

    public function bulkPause(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }
        $engine = app(ChatAutomationEngine::class);
        $count = 0;
        foreach ($this->scripts as &$s) {
            if (in_array($s['id'], $this->selectedIds)) {
                $s['enabled'] = false;
                $s['updated_at'] = now()->format('Y-m-d H:i');
                $count++;
            }
        }
        $this->persistScripts($engine, "Tạm dừng hàng loạt {$count} kịch bản");
        Notification::make()->title("Đã tạm dừng {$count} kịch bản")->info()->send();
    }

    public function openBulkDeleteConfirm(): void
    {
        if (! empty($this->selectedIds)) {
            $this->showBulkDeleteModal = true;
        }
    }

    public function bulkDeleteConfirmed(): void
    {
        $engine = app(ChatAutomationEngine::class);
        $count = count($this->selectedIds);
        $this->scripts = array_values(array_filter($this->scripts, function ($s) {
            return ! in_array($s['id'], $this->selectedIds);
        }));

        $this->selectedIds = [];
        $this->selectAll = false;
        $this->selectedScriptId = $this->scripts[0]['id'] ?? '';
        $this->showBulkDeleteModal = false;

        $this->persistScripts($engine, "Xóa hàng loạt {$count} kịch bản");
        Notification::make()->title("Đã xóa {$count} kịch bản")->success()->send();
    }

    // ==========================================
    // PERSISTENCE & CONFLICTS
    // ==========================================
    protected function persistScripts(ChatAutomationEngine $engine, string $logMessage): void
    {
        ChatSetting::set('chat_automation_scripts_v2', $this->scripts, 'Kịch bản tự động Cửu Long ID');
        $engine->recordVersion($logMessage, $this->scripts);
        $this->refreshConflicts($engine);
    }

    public function refreshConflicts(ChatAutomationEngine $engine): void
    {
        $this->conflictsList = $engine->detectConflicts($this->scripts);
    }

    // ==========================================
    // FILTERING, SORTING & PAGINATION
    // ==========================================
    public function getFilteredScripts(): array
    {
        $list = $this->scripts;

        // Category filter
        if ($this->activeFilter !== 'all') {
            $list = array_filter($list, fn($s) => ($s['category'] ?? '') === $this->activeFilter);
        }

        // Status filter
        if ($this->statusFilter === 'active') {
            $list = array_filter($list, fn($s) => ! empty($s['enabled']));
        } elseif ($this->statusFilter === 'paused') {
            $list = array_filter($list, fn($s) => empty($s['enabled']));
        }

        // Trigger filter
        if ($this->triggerFilter !== 'all') {
            $list = array_filter($list, function ($s) {
                $type = $s['trigger_type'] ?? '';
                $cat = $s['category'] ?? '';
                return match ($this->triggerFilter) {
                    'welcome' => $cat === 'welcome' || $type === 'conversation_created',
                    'quote' => str_contains(mb_strtolower($s['name'] . $s['trigger'], 'UTF-8'), 'giá'),
                    'service' => str_contains(mb_strtolower($s['name'] . $s['trigger'], 'UTF-8'), 'dịch vụ'),
                    'after_care' => $cat === 'care' || $type === 'schedule',
                    'spam' => str_contains(mb_strtolower($s['name'] . $s['trigger'], 'UTF-8'), 'spam'),
                    default => true,
                };
            });
        }

        // Priority filter
        if ($this->priorityFilter === 'high') {
            $list = array_filter($list, fn($s) => ((int) ($s['priority'] ?? 50)) <= 10);
        } elseif ($this->priorityFilter === 'medium') {
            $list = array_filter($list, function ($s) {
                $p = (int) ($s['priority'] ?? 50);
                return $p > 10 && $p <= 25;
            });
        } elseif ($this->priorityFilter === 'low') {
            $list = array_filter($list, fn($s) => ((int) ($s['priority'] ?? 50)) > 25);
        }

        // Search text
        if (trim($this->search) !== '') {
            $term = mb_strtolower(trim($this->search), 'UTF-8');
            $list = array_filter($list, function ($s) use ($term) {
                $name = mb_strtolower($s['name'] ?? '', 'UTF-8');
                $desc = mb_strtolower($s['desc'] ?? '', 'UTF-8');
                $trigger = mb_strtolower($s['trigger'] ?? '', 'UTF-8');
                return str_contains($name, $term) || str_contains($desc, $term) || str_contains($trigger, $term);
            });
        }

        // Sorting
        usort($list, function ($a, $b) {
            $dir = $this->sortDirection === 'desc' ? -1 : 1;
            if ($this->sortBy === 'priority') {
                $pA = (int) ($a['priority'] ?? 50);
                $pB = (int) ($b['priority'] ?? 50);
                return ($pA <=> $pB) * $dir;
            } elseif ($this->sortBy === 'name') {
                return strcmp((string) ($a['name'] ?? ''), (string) ($b['name'] ?? '')) * $dir;
            } elseif ($this->sortBy === 'usage_count') {
                $uA = (int) ($a['usage_count'] ?? 0);
                $uB = (int) ($b['usage_count'] ?? 0);
                return ($uA <=> $uB) * $dir;
            } elseif ($this->sortBy === 'updated_at') {
                return strcmp((string) ($a['updated_at'] ?? ''), (string) ($b['updated_at'] ?? '')) * $dir;
            }
            return 0;
        });

        return array_values($list);
    }

    public function getFilteredScriptsProperty(): array
    {
        return $this->getFilteredScripts();
    }

    public function getPaginatedScriptsProperty(): array
    {
        return $this->getPaginatedScripts();
    }

    public function getPaginatedScripts(): array
    {
        $filtered = $this->getFilteredScripts();
        $offset = ($this->currentPage - 1) * $this->perPage;
        return array_slice($filtered, $offset, $this->perPage);
    }

    public function getTotalPagesProperty(): int
    {
        $count = count($this->getFilteredScripts());
        return max(1, (int) ceil($count / $this->perPage));
    }

    public function nextPage(): void
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
        }
    }

    public function previousPage(): void
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function gotoPage(int $page): void
    {
        $this->currentPage = max(1, min($page, $this->totalPages));
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

    // ==========================================
    // METRICS PROPERTIES (REAL DATA)
    // ==========================================
    public function getTotalCountProperty(): int
    {
        return count($this->scripts);
    }

    public function getActiveCountProperty(): int
    {
        return count(array_filter($this->scripts, fn($s) => ! empty($s['enabled'])));
    }

    public function getPausedCountProperty(): int
    {
        return count(array_filter($this->scripts, fn($s) => empty($s['enabled'])));
    }

    public function getTotalUsageProperty(): int
    {
        return (int) array_sum(array_column($this->scripts, 'usage_count'));
    }

    public function getTotalSuccessProperty(): int
    {
        return (int) array_sum(array_column($this->scripts, 'success_count'));
    }

    public function getTotalErrorProperty(): int
    {
        return (int) array_sum(array_column($this->scripts, 'error_count'));
    }

    public function getSuccessRateProperty(): string
    {
        $usage = $this->totalUsage;
        if ($usage <= 0) {
            return '100%';
        }
        $success = $this->totalSuccess;
        $rate = round(($success / $usage) * 100, 1);
        return $rate . '%';
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
        $this->persistScripts($engine, 'Lưu cấu hình kịch bản tự động thủ công');
        $this->isSaving = false;

        Notification::make()
            ->title('Đã lưu cấu hình Automation Center thành công!')
            ->success()
            ->send();
    }
}
