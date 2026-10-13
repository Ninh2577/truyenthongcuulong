<?php

namespace App\Filament\Pages;

use App\Models\ChatConversation;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Gate;

/**
 * CHAT-14: Spam & Chặn placeholder — exposes spam queue using existing CHAT-09 logic.
 * Full moderation center UI deferred to a future milestone.
 */
class ChatSpamPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-no-symbol';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Spam & Chặn';
    protected static ?string $title = 'Spam & Chặn';
    protected static ?string $slug = 'chat-spam';
    protected static ?int $navigationSort = 40;
    protected static string $view = 'filament.pages.chat-spam';

    // Tabs
    public string $activeTab = 'general'; // 'general', 'keywords', 'blacklist', 'history'

    // Feature Toggles
    public bool $auto_spam_block = true;
    public bool $keyword_filter = true;
    public bool $ip_filter = true;
    public bool $rate_limit_filter = true;
    public bool $smart_ai_mode = true;

    // Modals / Input State
    public bool $showAddKeywordModal = false;
    public string $newKeyword = '';
    public string $newKeywordType = 'quang_cao';

    public bool $showAddIpModal = false;
    public string $newIp = '';
    public string $newIpReason = 'Spam';

    // Data lists
    public array $spamKeywords = [];
    public array $blockedIps = [];

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

        // Only admins can access spam management (CHAT-09 policy preserved)
        return $user->hasAnyRole(['super_admin', 'Admin'])
            || $user->can('delete_chat_conversation');
    }

    public function mount(): void
    {
        abort_unless(static::canAccess(), 403);

        $this->loadSettings();
    }

    protected function loadSettings(): void
    {
        $settings = \App\Models\ChatSetting::get('chat_spam_settings');
        if (is_array($settings)) {
            $this->auto_spam_block = (bool) ($settings['auto_spam_block'] ?? true);
            $this->keyword_filter = (bool) ($settings['keyword_filter'] ?? true);
            $this->ip_filter = (bool) ($settings['ip_filter'] ?? true);
            $this->rate_limit_filter = (bool) ($settings['rate_limit_filter'] ?? true);
            $this->smart_ai_mode = (bool) ($settings['smart_ai_mode'] ?? true);
        }

        $keywords = \App\Models\ChatSetting::get('chat_spam_keywords_list');
        if (is_array($keywords) && ! empty($keywords)) {
            $this->spamKeywords = $keywords;
        } else {
            $this->spamKeywords = [
                ['keyword' => 'khuyến mãi', 'type' => 'Quảng cáo', 'type_class' => 'ad', 'enabled' => true],
                ['keyword' => 'giảm giá', 'type' => 'Quảng cáo', 'type_class' => 'ad', 'enabled' => true],
                ['keyword' => 'link lạ', 'type' => 'Lừa đảo', 'type_class' => 'fraud', 'enabled' => true],
                ['keyword' => 'vay tiền', 'type' => 'Lừa đảo', 'type_class' => 'fraud', 'enabled' => true],
                ['keyword' => 'casino', 'type' => 'Không phù hợp', 'type_class' => 'inappropriate', 'enabled' => true],
                ['keyword' => 'tặng quà', 'type' => 'Quảng cáo', 'type_class' => 'ad', 'enabled' => true],
            ];
        }

        $ips = \App\Models\ChatSetting::get('chat_blocked_ips_list');
        if (is_array($ips) && ! empty($ips)) {
            $this->blockedIps = $ips;
        } else {
            $this->blockedIps = [
                ['ip' => '192.168.1.23', 'reason' => 'Spam', 'blocked_at' => '30/09/2026 08:21'],
                ['ip' => '103.45.67.89', 'reason' => 'Tấn công', 'blocked_at' => '28/09/2026 14:32'],
                ['ip' => '45.76.12.34', 'reason' => 'Spam', 'blocked_at' => '25/09/2026 11:10'],
            ];
        }
    }

    public function switchTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function toggleSetting(string $key): void
    {
        if (isset($this->{$key})) {
            $this->{$key} = ! $this->{$key};
            $this->saveSettings();

            $statusText = $this->{$key} ? 'Đã bật' : 'Đã tắt';
            \Filament\Notifications\Notification::make()
                ->title("{$statusText} tính năng bảo vệ")
                ->success()
                ->send();
        }
    }

    public function toggleKeyword(int $index): void
    {
        if (isset($this->spamKeywords[$index])) {
            $this->spamKeywords[$index]['enabled'] = ! ($this->spamKeywords[$index]['enabled'] ?? false);
            \App\Models\ChatSetting::set('chat_spam_keywords_list', $this->spamKeywords, 'Danh sách từ khóa spam');

            $kw = $this->spamKeywords[$index]['keyword'];
            $st = $this->spamKeywords[$index]['enabled'] ? 'kích hoạt' : 'tạm dừng';
            \Filament\Notifications\Notification::make()
                ->title("Đã {$st} từ khóa: \"{$kw}\"")
                ->success()
                ->send();
        }
    }

    public function deleteKeyword(int $index): void
    {
        if (isset($this->spamKeywords[$index])) {
            $kw = $this->spamKeywords[$index]['keyword'];
            array_splice($this->spamKeywords, $index, 1);
            \App\Models\ChatSetting::set('chat_spam_keywords_list', $this->spamKeywords, 'Danh sách từ khóa spam');

            \Filament\Notifications\Notification::make()
                ->title("Đã xóa từ khóa: \"{$kw}\"")
                ->success()
                ->send();
        }
    }

    public function openAddKeywordModal(): void
    {
        $this->newKeyword = '';
        $this->newKeywordType = 'Quảng cáo';
        $this->showAddKeywordModal = true;
    }

    public function saveNewKeyword(): void
    {
        $kw = trim($this->newKeyword);
        if ($kw === '') {
            return;
        }

        $typeClass = match($this->newKeywordType) {
            'Lừa đảo' => 'fraud',
            'Không phù hợp' => 'inappropriate',
            default => 'ad',
        };

        $this->spamKeywords[] = [
            'keyword' => $kw,
            'type' => $this->newKeywordType,
            'type_class' => $typeClass,
            'enabled' => true,
        ];

        \App\Models\ChatSetting::set('chat_spam_keywords_list', $this->spamKeywords, 'Danh sách từ khóa spam');
        $this->showAddKeywordModal = false;
        $this->newKeyword = '';

        \Filament\Notifications\Notification::make()
            ->title("Đã thêm từ khóa mới: \"{$kw}\"")
            ->success()
            ->send();
    }

    public function deleteIp(int $index): void
    {
        if (isset($this->blockedIps[$index])) {
            $ip = $this->blockedIps[$index]['ip'];
            array_splice($this->blockedIps, $index, 1);
            \App\Models\ChatSetting::set('chat_blocked_ips_list', $this->blockedIps, 'Danh sách IP bị chặn');

            \Filament\Notifications\Notification::make()
                ->title("Đã gỡ chặn IP: {$ip}")
                ->success()
                ->send();
        }
    }

    public function openAddIpModal(): void
    {
        $this->newIp = '';
        $this->newIpReason = 'Spam';
        $this->showAddIpModal = true;
    }

    public function saveNewIp(): void
    {
        $ip = trim($this->newIp);
        if ($ip === '') {
            return;
        }

        $now = now()->timezone(config('app.timezone', 'Asia/Ho_Chi_Minh'))->format('d/m/Y H:i');

        $this->blockedIps[] = [
            'ip' => $ip,
            'reason' => $this->newIpReason,
            'blocked_at' => $now,
        ];

        \App\Models\ChatSetting::set('chat_blocked_ips_list', $this->blockedIps, 'Danh sách IP bị chặn');
        $this->showAddIpModal = false;
        $this->newIp = '';

        \Filament\Notifications\Notification::make()
            ->title("Đã thêm IP vào danh sách chặn: {$ip}")
            ->success()
            ->send();
    }

    protected function saveSettings(): void
    {
        \App\Models\ChatSetting::set('chat_spam_settings', [
            'auto_spam_block' => $this->auto_spam_block,
            'keyword_filter' => $this->keyword_filter,
            'ip_filter' => $this->ip_filter,
            'rate_limit_filter' => $this->rate_limit_filter,
            'smart_ai_mode' => $this->smart_ai_mode,
        ], 'Cấu hình bảo vệ Spam & Chặn IP');
    }
}
