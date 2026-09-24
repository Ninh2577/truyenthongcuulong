<?php

namespace App\Services\Chat\AI;

use App\Models\ChatSetting;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ChatAISettingsResolver
{
    public const SETTING_KEY = 'chat_ai_settings';
    public const AUDIT_KEY = 'chat_ai_audit_log';
    public const CACHE_KEY = 'chat_ai_settings_runtime';
    public const CACHE_TTL = 300; // 5 minutes

    /**
     * Get all active AI settings, checking persistent store with cache and falling back to config defaults.
     */
    public function getSettings(): array
    {
        $raw = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return ChatSetting::get(self::SETTING_KEY, []);
        });

        if (! is_array($raw)) {
            $raw = [];
        }

        $defaultKeywords = config('chat_ai.handoff_keywords', [
            'gặp nhân viên',
            'tư vấn viên',
            'nhân viên hỗ trợ',
            'chăm sóc khách hàng',
            'người thật',
            'human',
            'agent',
        ]);

        return [
            'enabled' => (bool) ($raw['enabled'] ?? config('chat_ai.enabled', false)),
            'provider' => (string) ($raw['provider'] ?? config('chat_ai.provider', 'none')),
            'default_channel' => (string) ($raw['default_channel'] ?? config('chat_ai.default_channel', 'hybrid')),
            'max_ai_replies_per_minute' => (int) ($raw['max_ai_replies_per_minute'] ?? config('chat_ai.max_ai_replies_per_minute', 5)),
            'handoff_keywords' => is_array($raw['handoff_keywords'] ?? null) ? $raw['handoff_keywords'] : $defaultKeywords,
            'handoff_notice' => (string) ($raw['handoff_notice'] ?? config('chat_ai.handoff_notice', 'Yêu cầu của bạn đã được chuyển tới chuyên viên tư vấn. Đội ngũ CSKH của Cửu Long sẽ hỗ trợ bạn ngay trong giây lát.')),
            'fallback_notice' => (string) ($raw['fallback_notice'] ?? config('chat_ai.fallback_notice', 'Hệ thống AI hiện đang bận hoặc quá tải. Yêu cầu của bạn đã được chuyển tới nhân viên CSKH hỗ trợ trực tiếp.')),
        ];
    }

    /**
     * Check if AI Chat is enabled.
     */
    public function isEnabled(): bool
    {
        return (bool) ($this->getSettings()['enabled'] ?? false);
    }

    /**
     * Get active AI Provider name with production fail-closed safeguard.
     */
    public function getProvider(): string
    {
        $provider = strtolower(trim((string) ($this->getSettings()['provider'] ?? 'none')));

        // Production Invariant: Fake provider is strictly disallowed in production
        if (app()->environment('production') && $provider === 'fake') {
            Log::warning('ChatAI: Fake provider attempted in production environment. Failing closed to none.');
            return 'none';
        }

        return $provider;
    }

    /**
     * Get default conversation channel.
     */
    public function getDefaultChannel(): string
    {
        $channel = (string) ($this->getSettings()['default_channel'] ?? 'hybrid');
        return in_array($channel, ['hybrid', 'human', 'ai'], true) ? $channel : 'hybrid';
    }

    /**
     * Get maximum allowed AI replies per minute per conversation.
     */
    public function getMaxRepliesPerMinute(): int
    {
        $limit = (int) ($this->getSettings()['max_ai_replies_per_minute'] ?? 5);
        return max(1, min($limit, 60));
    }

    /**
     * Get normalized handoff keyword list.
     */
    public function getHandoffKeywords(): array
    {
        $keywords = $this->getSettings()['handoff_keywords'] ?? [];
        if (! is_array($keywords)) {
            return [];
        }

        $normalized = [];
        foreach ($keywords as $kw) {
            $cleaned = mb_strtolower(trim(strip_tags((string) $kw)), 'UTF-8');
            if ($cleaned !== '') {
                $normalized[] = $cleaned;
            }
        }

        return array_values(array_unique($normalized));
    }

    /**
     * Get customer notice when human handoff is requested.
     */
    public function getHandoffNotice(): string
    {
        return (string) ($this->getSettings()['handoff_notice'] ?? '');
    }

    /**
     * Get fallback notice when AI encounters error or timeout.
     */
    public function getFallbackNotice(): string
    {
        return (string) ($this->getSettings()['fallback_notice'] ?? '');
    }

    /**
     * Validate and sanitize input settings before persistence.
     *
     * @throws ValidationException
     */
    public function validateAndSanitize(array $input): array
    {
        $errors = [];

        // 1. Enabled (bool)
        $enabled = (bool) ($input['enabled'] ?? false);

        // 2. Provider (string)
        $provider = strtolower(trim((string) ($input['provider'] ?? 'none')));
        $validProviders = ['none', 'fake', 'openai', 'gemini'];
        if (! in_array($provider, $validProviders, true)) {
            $errors['provider'] = "Nhà cung cấp AI '{$provider}' không hợp lệ.";
        }

        if (app()->environment('production') && $provider === 'fake') {
            $errors['provider'] = 'Không được phép kích hoạt Fake Provider trên môi trường production.';
        }

        // 3. Default Channel (string)
        $channel = strtolower(trim((string) ($input['default_channel'] ?? 'hybrid')));
        if (! in_array($channel, ['hybrid', 'human', 'ai'], true)) {
            $errors['default_channel'] = "Kênh hội thoại '{$channel}' không hợp lệ.";
        }

        // 4. Max replies per minute (int 1..60)
        $rateLimit = filter_var($input['max_ai_replies_per_minute'] ?? 5, FILTER_VALIDATE_INT);
        if ($rateLimit === false || $rateLimit < 1 || $rateLimit > 60) {
            $errors['max_ai_replies_per_minute'] = 'Tần suất phản hồi AI phải là số nguyên từ 1 đến 60 tin nhắn/phút.';
        }

        // 5. Handoff Keywords (array or string)
        $rawKeywords = $input['handoff_keywords'] ?? [];
        if (is_string($rawKeywords)) {
            $rawKeywords = preg_split('/[\r\n,]+/', $rawKeywords);
        }

        if (! is_array($rawKeywords)) {
            $errors['handoff_keywords'] = 'Danh sách từ khóa không đúng định dạng.';
            $rawKeywords = [];
        }

        $sanitizedKeywords = [];
        foreach ($rawKeywords as $kw) {
            $clean = mb_strtolower(trim(strip_tags((string) $kw)), 'UTF-8');
            if ($clean !== '') {
                if (mb_strlen($clean, 'UTF-8') > 100) {
                    $errors['handoff_keywords'] = 'Mỗi từ khóa không được vượt quá 100 ký tự.';
                    break;
                }
                $sanitizedKeywords[] = $clean;
            }
        }
        $sanitizedKeywords = array_values(array_unique($sanitizedKeywords));

        if (count($sanitizedKeywords) > 50) {
            $errors['handoff_keywords'] = 'Số lượng từ khóa bàn giao tối đa là 50 từ khóa.';
        }

        // 6. Handoff Notice (string)
        $handoffNotice = strip_tags(trim((string) ($input['handoff_notice'] ?? '')));
        if ($handoffNotice === '') {
            $errors['handoff_notice'] = 'Thông báo bàn giao nhân viên không được để trống.';
        } elseif (mb_strlen($handoffNotice, 'UTF-8') > 1000) {
            $errors['handoff_notice'] = 'Thông báo bàn giao không được vượt quá 1000 ký tự.';
        }

        // 7. Fallback Notice (string)
        $fallbackNotice = strip_tags(trim((string) ($input['fallback_notice'] ?? '')));
        if ($fallbackNotice === '') {
            $errors['fallback_notice'] = 'Thông báo sự cố AI không được để trống.';
        } elseif (mb_strlen($fallbackNotice, 'UTF-8') > 1000) {
            $errors['fallback_notice'] = 'Thông báo sự cố không được vượt quá 1000 ký tự.';
        }

        if (! empty($errors)) {
            throw ValidationException::withMessages($errors);
        }

        return [
            'enabled' => $enabled,
            'provider' => $provider,
            'default_channel' => $channel,
            'max_ai_replies_per_minute' => (int) $rateLimit,
            'handoff_keywords' => $sanitizedKeywords,
            'handoff_notice' => $handoffNotice,
            'fallback_notice' => $fallbackNotice,
        ];
    }

    /**
     * Save settings to persistent store, flush runtime cache, and record audit trail.
     */
    public function saveSettings(array $input, ?User $actor = null): array
    {
        $oldSettings = $this->getSettings();
        $validated = $this->validateAndSanitize($input);

        // Atomic persistence
        ChatSetting::set(self::SETTING_KEY, $validated, 'Cấu hình vận hành AI Chat');

        // Immediate cache invalidation
        Cache::forget(self::CACHE_KEY);

        // Audit Trail Recording
        $this->recordAuditLog($actor, $oldSettings, $validated);

        return $validated;
    }

    /**
     * Record an audit log entry for changes in AI operational settings.
     */
    public function recordAuditLog(?User $actor, array $oldSettings, array $newSettings): void
    {
        $changes = [];
        $monitoredKeys = [
            'enabled',
            'provider',
            'default_channel',
            'max_ai_replies_per_minute',
            'handoff_keywords',
            'handoff_notice',
            'fallback_notice',
        ];

        foreach ($monitoredKeys as $key) {
            $oldVal = $oldSettings[$key] ?? null;
            $newVal = $newSettings[$key] ?? null;

            if ($oldVal !== $newVal) {
                $changes[$key] = [
                    'old' => $oldVal,
                    'new' => $newVal,
                ];
            }
        }

        if (empty($changes)) {
            return;
        }

        $entry = [
            'timestamp' => now()->toISOString(),
            'actor_id' => $actor?->id,
            'actor_name' => $actor?->name ?? 'System',
            'actor_email' => $actor?->email ?? 'system@cuulong.local',
            'changes' => $changes,
        ];

        try {
            $existing = ChatSetting::get(self::AUDIT_KEY, []);
            if (! is_array($existing)) {
                $existing = [];
            }

            array_unshift($existing, $entry);
            // Cap at 50 most recent audit logs
            $existing = array_slice($existing, 0, 50);

            ChatSetting::set(self::AUDIT_KEY, $existing, 'Lịch sử thay đổi cấu hình AI');
        } catch (\Throwable $e) {
            Log::error('ChatAISettings: Không thể lưu audit log vào chat_settings: ' . $e->getMessage());
        }

        Log::info('CHAT_AI_AUDIT', $entry);
    }

    /**
     * Get recent audit history.
     */
    public function getAuditLog(): array
    {
        $log = ChatSetting::get(self::AUDIT_KEY, []);
        return is_array($log) ? $log : [];
    }

    /**
     * Clear audit history (used in test cleanups or maintenance).
     */
    public function clearAuditLog(): void
    {
        ChatSetting::where('key', self::AUDIT_KEY)->delete();
    }

    /**
     * Reset settings to default (used in test cleanups).
     */
    public function resetSettings(): void
    {
        ChatSetting::where('key', self::SETTING_KEY)->delete();
        ChatSetting::where('key', self::AUDIT_KEY)->delete();
        Cache::forget(self::CACHE_KEY);
    }
}
