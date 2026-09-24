<?php

namespace App\Filament\Pages;

use App\Services\Chat\Automation\ChatAutomationEngine;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ChatAutomationSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Tự động hóa';
    protected static ?string $title = 'Cấu Hình Tự Động Hóa Chat';
    protected static ?string $slug = 'chat-automation';
    protected static ?int $navigationSort = 30;
    protected static string $view = 'filament.pages.chat-automation-settings';

    public array $rules = [];
    public bool $isSaving = false;

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
    }

    /**
     * Toggle the enabled state of a rule.
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

    /**
     * Save all rules to persistent chat_settings storage.
     */
    public function save(ChatAutomationEngine $engine): void
    {
        $this->isSaving = true;

        // Server-side sanitize rules
        $sanitized = [];
        foreach ($this->rules as $rule) {
            $ruleId = trim((string) ($rule['id'] ?? ''));
            $name = trim((string) ($rule['name'] ?? ''));
            $trigger = trim((string) ($rule['trigger'] ?? ''));
            $priority = (int) ($rule['priority'] ?? 10);
            $enabled = (bool) ($rule['enabled'] ?? false);

            if ($ruleId === '' || $name === '' || $trigger === '') {
                continue;
            }

            // Sanitize actions
            $actions = [];
            foreach ($rule['actions'] ?? [] as $act) {
                $actType = trim((string) ($act['type'] ?? ''));
                if ($actType === 'send_message') {
                    $msg = strip_tags(trim((string) ($act['payload']['message'] ?? '')));
                    if ($msg !== '') {
                        $actions[] = [
                            'type' => 'send_message',
                            'payload' => ['message' => $msg],
                        ];
                    }
                } elseif ($actType === 'update_status') {
                    $status = trim((string) ($act['payload']['status'] ?? ''));
                    if ($status !== '') {
                        $actions[] = [
                            'type' => 'update_status',
                            'payload' => ['status' => $status],
                        ];
                    }
                }
            }

            // Sanitize conditions
            $conditions = [];
            foreach ($rule['conditions'] ?? [] as $cond) {
                $field = trim((string) ($cond['field'] ?? ''));
                $operator = trim((string) ($cond['operator'] ?? 'equals'));
                $val = trim((string) ($cond['value'] ?? ''));
                if ($field !== '') {
                    $conditions[] = [
                        'field' => $field,
                        'operator' => $operator,
                        'value' => $val,
                    ];
                }
            }

            $sanitized[] = [
                'id' => $ruleId,
                'name' => $name,
                'trigger' => $trigger,
                'enabled' => $enabled,
                'priority' => $priority,
                'conditions' => $conditions,
                'actions' => $actions,
            ];
        }

        $this->rules = $sanitized;
        $engine->saveRules($this->rules);
        $this->isSaving = false;

        Notification::make()
            ->title('Đã lưu cấu hình tự động hóa thành công!')
            ->success()
            ->send();
    }
}
