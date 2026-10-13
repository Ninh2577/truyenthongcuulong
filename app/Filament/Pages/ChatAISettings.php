<?php

namespace App\Filament\Pages;

use App\Services\Chat\AI\ChatAISettingsResolver;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Validation\ValidationException;

class ChatAISettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Trợ lý AI Bot';
    protected static ?string $title = 'Trợ Lý AI Bot';
    protected static ?string $slug = 'chat-ai';
    protected static ?int $navigationSort = 50;
    protected static string $view = 'filament.pages.chat-ai-settings';

    public bool $enabled = true;
    public string $provider = 'openai';
    public string $default_channel = 'hybrid';
    public int $max_ai_replies_per_minute = 5;
    public string $handoff_keywords_text = '';
    public string $handoff_notice = '';
    public string $fallback_notice = '';
    public bool $isSaving = false;
    public array $auditLogs = [];

    // Bot Profile & Tabs
    public string $bot_name = 'Trợ lý Cửu Long ID';
    public string $bot_description = 'Tư vấn và hỗ trợ khách hàng về các dịch vụ của Cửu Long ID, giải đáp thắc mắc và hướng dẫn nhanh chóng.';
    public string $bot_language = 'vi';
    public bool $feature_project_consulting = true;
    public bool $feature_price_quote = true;
    public bool $feature_tech_support = true;
    public bool $feature_customer_care = true;

    public string $activeTab = 'general'; // 'general', 'scenarios', 'data_integration', 'advanced'

    // Interactive Test Chat
    public string $testInput = '';
    public array $testMessages = [];

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

        return $user->hasAnyRole(['super_admin', 'Admin'])
            || $user->can('manage_chat_ai')
            || $user->can('manage_chat_settings');
    }

    public function mount(ChatAISettingsResolver $resolver): void
    {
        abort_unless(static::canAccess(), 403);

        $settings = $resolver->getSettings();
        $this->enabled = (bool) ($settings['enabled'] ?? true);
        $this->provider = (string) ($settings['provider'] ?? 'openai');
        $this->default_channel = (string) ($settings['default_channel'] ?? 'hybrid');
        $this->max_ai_replies_per_minute = (int) ($settings['max_ai_replies_per_minute'] ?? 5);

        $keywords = is_array($settings['handoff_keywords'] ?? null) ? $settings['handoff_keywords'] : [];
        $this->handoff_keywords_text = implode("\n", $keywords);

        $this->handoff_notice = (string) ($settings['handoff_notice'] ?? 'Dạ tôi đang kết nối bạn với chuyên viên tư vấn. Xin vui lòng đợi trong giây lát ạ!');
        $this->fallback_notice = (string) ($settings['fallback_notice'] ?? 'Hệ thống AI đang bận. Đội ngũ CSKH sẽ phản hồi bạn ngay.');

        $this->auditLogs = $resolver->getAuditLog();

        // Load profile if saved
        $profile = \App\Models\ChatSetting::get('chat_ai_bot_profile');
        if (is_array($profile)) {
            $this->bot_name = $profile['bot_name'] ?? $this->bot_name;
            $this->bot_description = $profile['bot_description'] ?? $this->bot_description;
            $this->bot_language = $profile['bot_language'] ?? $this->bot_language;
            $this->feature_project_consulting = (bool) ($profile['feature_project_consulting'] ?? true);
            $this->feature_price_quote = (bool) ($profile['feature_price_quote'] ?? true);
            $this->feature_tech_support = (bool) ($profile['feature_tech_support'] ?? true);
            $this->feature_customer_care = (bool) ($profile['feature_customer_care'] ?? true);
        }

        $this->initTestMessages();
    }

    protected function initTestMessages(): void
    {
        $this->testMessages = [
            [
                'id' => 1,
                'sender' => 'bot',
                'text' => "Xin chào! Tôi là trợ lý AI của Cửu Long ID.\nBạn có thể hỏi tôi về các dịch vụ, dự án, báo giá hoặc bất kỳ thông tin nào bạn cần.",
                'time' => '14:32',
            ],
            [
                'id' => 2,
                'sender' => 'user',
                'text' => 'Dịch vụ thiết kế website có những gói nào?',
                'time' => '14:33',
            ],
            [
                'id' => 3,
                'sender' => 'bot',
                'text' => "Cửu Long ID hiện có 3 gói thiết kế website chính:\n1. Gói Cơ bản: Phù hợp với doanh nghiệp nhỏ\n2. Gói Nâng cao: Tính năng đầy đủ, tùy chỉnh linh hoạt\n3. Gói Cao cấp: Giải pháp toàn diện, hỗ trợ 24/7\n\nBạn muốn tìm hiểu chi tiết gói nào?",
                'time' => '14:33',
            ],
        ];
    }

    public function switchTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function toggleBot(ChatAISettingsResolver $resolver): void
    {
        $this->enabled = ! $this->enabled;
        $this->save($resolver);
    }

    public function sendTestMessage(): void
    {
        $input = trim($this->testInput);
        if ($input === '') {
            return;
        }

        $now = now()->timezone(config('app.timezone', 'Asia/Ho_Chi_Minh'))->format('H:i');

        // Add user message
        $this->testMessages[] = [
            'id' => count($this->testMessages) + 1,
            'sender' => 'user',
            'text' => $input,
            'time' => $now,
        ];

        $this->testInput = '';

        // Generate Bot reply
        $reply = $this->generateBotReply($input);
        $this->testMessages[] = [
            'id' => count($this->testMessages) + 1,
            'sender' => 'bot',
            'text' => $reply,
            'time' => $now,
        ];
    }

    protected function generateBotReply(string $input): string
    {
        $lower = mb_strtolower($input, 'UTF-8');

        if (str_contains($lower, 'báo giá') || str_contains($lower, 'chi phí') || str_contains($lower, 'giá')) {
            return "Dạ bảng giá dịch vụ của Truyền Thông Cửu Long được xây dựng tối ưu theo nhu cầu cụ thể của từng dự án. Bạn có thể để lại số điện thoại hoặc yêu cầu để nhận file báo giá chi tiết trong 5 phút nhé!";
        }

        if (str_contains($lower, 'livestream') || str_contains($lower, 'quay phim')) {
            return "Cửu Long cung cấp dịch vụ Livestream và sản xuất Media chuyên nghiệp chuẩn 4K, hệ thống đa góc máy, bàn trộn âm thanh và đường truyền độc lập tại Cần Thơ và miền Tây.";
        }

        if (str_contains($lower, 'website') || str_contains($lower, 'thiết kế web')) {
            return "Dạ chúng tôi có 3 gói thiết kế website: Cơ bản (landing page), Nâng cao (doanh nghiệp & bán hàng) và Cao cấp (hệ thống giải pháp tùy biến). Gói nào cũng chuẩn SEO và bảo hành trọn đời!";
        }

        if (str_contains($lower, 'liên hệ') || str_contains($lower, 'tư vấn') || str_contains($lower, 'nhân viên')) {
            return "Dạ bạn có thể gọi hotline 0968 479 499 hoặc để lại thông tin tại đây, chuyên viên tư vấn Cửu Long ID sẽ kết nối ngay với bạn ạ!";
        }

        return "Cảm ơn bạn đã đặt câu hỏi! Trợ lý AI Cửu Long ID đã ghi nhận yêu cầu. Bạn cần tìm hiểu thêm về hạng mục nào để mình hỗ trợ cụ thể hơn nhé?";
    }

    public function clearTestHistory(): void
    {
        $this->initTestMessages();
        Notification::make()
            ->title('Đã xóa lịch sử thử nghiệm')
            ->info()
            ->send();
    }

    /**
     * Save settings to persistent store and record audit trail.
     */
    public function save(ChatAISettingsResolver $resolver): void
    {
        abort_unless(static::canAccess(), 403);

        $this->isSaving = true;

        $input = [
            'enabled' => $this->enabled,
            'provider' => $this->provider,
            'default_channel' => $this->default_channel,
            'max_ai_replies_per_minute' => $this->max_ai_replies_per_minute,
            'handoff_keywords' => $this->handoff_keywords_text,
            'handoff_notice' => $this->handoff_notice,
            'fallback_notice' => $this->fallback_notice,
        ];

        try {
            $saved = $resolver->saveSettings($input, auth()->user());

            $this->enabled = $saved['enabled'];
            $this->provider = $saved['provider'];
            $this->default_channel = $saved['default_channel'];
            $this->max_ai_replies_per_minute = $saved['max_ai_replies_per_minute'];
            $this->handoff_keywords_text = implode("\n", $saved['handoff_keywords']);
            $this->handoff_notice = $saved['handoff_notice'];
            $this->fallback_notice = $saved['fallback_notice'];

            $this->auditLogs = $resolver->getAuditLog();

            \App\Models\ChatSetting::set('chat_ai_bot_profile', [
                'bot_name' => $this->bot_name,
                'bot_description' => $this->bot_description,
                'bot_language' => $this->bot_language,
                'feature_project_consulting' => $this->feature_project_consulting,
                'feature_price_quote' => $this->feature_price_quote,
                'feature_tech_support' => $this->feature_tech_support,
                'feature_customer_care' => $this->feature_customer_care,
            ], 'Cấu hình hồ sơ và tính năng Trợ lý AI Bot');

            Notification::make()
                ->title('Đã lưu cài đặt Trợ lý AI Bot thành công!')
                ->success()
                ->send();
        } catch (ValidationException $e) {
            foreach ($e->errors() as $field => $messages) {
                foreach ($messages as $msg) {
                    $this->addError($field, $msg);
                }
            }

            Notification::make()
                ->title('Lỗi lưu cấu hình')
                ->body(collect($e->errors())->flatten()->first())
                ->danger()
                ->send();
        } finally {
            $this->isSaving = false;
        }
    }
}
