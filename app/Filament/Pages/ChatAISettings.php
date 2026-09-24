<?php

namespace App\Filament\Pages;

use App\Services\Chat\AI\ChatAISettingsResolver;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Validation\ValidationException;

class ChatAISettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Trợ lý AI';
    protected static ?string $title = 'Quản Trị Vận Hành AI Chat';
    protected static ?string $slug = 'chat-ai';
    protected static ?int $navigationSort = 50;
    protected static string $view = 'filament.pages.chat-ai-settings';

    public bool $enabled = false;
    public string $provider = 'none';
    public string $default_channel = 'hybrid';
    public int $max_ai_replies_per_minute = 5;
    public string $handoff_keywords_text = '';
    public string $handoff_notice = '';
    public string $fallback_notice = '';
    public bool $isSaving = false;
    public array $auditLogs = [];

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
        $this->enabled = (bool) $settings['enabled'];
        $this->provider = (string) $settings['provider'];
        $this->default_channel = (string) $settings['default_channel'];
        $this->max_ai_replies_per_minute = (int) $settings['max_ai_replies_per_minute'];

        $keywords = is_array($settings['handoff_keywords'] ?? null) ? $settings['handoff_keywords'] : [];
        $this->handoff_keywords_text = implode("\n", $keywords);

        $this->handoff_notice = (string) $settings['handoff_notice'];
        $this->fallback_notice = (string) $settings['fallback_notice'];

        $this->auditLogs = $resolver->getAuditLog();
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

            Notification::make()
                ->title('Đã lưu cấu hình AI Chat thành công!')
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
