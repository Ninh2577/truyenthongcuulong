<?php

namespace App\Services\Chat\Spam;

use App\Enums\ChatConversationStatus;
use App\Events\Chat\ChatConversationUpdated;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use Illuminate\Support\Facades\RateLimiter;

class ChatSpamProtectionService
{
    public const SETTING_KEY_SETTINGS = 'chat_spam_settings';
    public const SETTING_KEY_KEYWORDS = 'chat_spam_keywords_list';
    public const SETTING_KEY_BLOCKED_IPS = 'chat_blocked_ips_list';

    public const DEFAULT_BANNED_KEYWORDS = [
        ['keyword' => 'khuyến mãi', 'type' => 'Quảng cáo', 'type_class' => 'ad', 'enabled' => true],
        ['keyword' => 'giảm giá', 'type' => 'Quảng cáo', 'type_class' => 'ad', 'enabled' => true],
        ['keyword' => 'link lạ', 'type' => 'Lừa đảo', 'type_class' => 'fraud', 'enabled' => true],
        ['keyword' => 'vay tiền', 'type' => 'Lừa đảo', 'type_class' => 'fraud', 'enabled' => true],
        ['keyword' => 'casino', 'type' => 'Không phù hợp', 'type_class' => 'inappropriate', 'enabled' => true],
        ['keyword' => 'tặng quà', 'type' => 'Quảng cáo', 'type_class' => 'ad', 'enabled' => true],
    ];

    public const DEFAULT_BLOCKED_IPS = [
        ['ip' => '192.168.1.23', 'reason' => 'Spam', 'blocked_at' => '30/09/2026 08:21'],
        ['ip' => '103.45.67.89', 'reason' => 'Tấn công', 'blocked_at' => '28/09/2026 14:32'],
        ['ip' => '45.76.12.34', 'reason' => 'Spam', 'blocked_at' => '25/09/2026 11:10'],
    ];

    /**
     * Retrieve security & spam feature toggles.
     */
    public function getSettings(): array
    {
        $settings = ChatSetting::get(self::SETTING_KEY_SETTINGS);
        if (is_array($settings)) {
            return array_merge([
                'auto_spam_block' => true,
                'keyword_filter' => true,
                'ip_filter' => true,
                'rate_limit_filter' => true,
                'smart_ai_mode' => true,
            ], $settings);
        }

        return [
            'auto_spam_block' => true,
            'keyword_filter' => true,
            'ip_filter' => true,
            'rate_limit_filter' => true,
            'smart_ai_mode' => true,
        ];
    }

    /**
     * Check if a client IP address is in the blacklist.
     */
    public function isIpBlocked(?string $ip): bool
    {
        if (empty($ip)) {
            return false;
        }

        $settings = $this->getSettings();
        if (empty($settings['ip_filter'])) {
            return false;
        }

        $blockedList = ChatSetting::get(self::SETTING_KEY_BLOCKED_IPS);
        if (! is_array($blockedList) || empty($blockedList)) {
            $blockedList = self::DEFAULT_BLOCKED_IPS;
        }

        $cleanIp = trim($ip);
        foreach ($blockedList as $item) {
            $blockedIp = trim((string) ($item['ip'] ?? ''));
            if ($blockedIp !== '' && hash_equals($blockedIp, $cleanIp)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add an IP address to the blacklist.
     */
    public function blockIp(string $ip, string $reason = 'Spam'): void
    {
        $cleanIp = trim($ip);
        if ($cleanIp === '') {
            return;
        }

        $blockedList = ChatSetting::get(self::SETTING_KEY_BLOCKED_IPS);
        if (! is_array($blockedList)) {
            $blockedList = self::DEFAULT_BLOCKED_IPS;
        }

        foreach ($blockedList as $item) {
            if (trim((string) ($item['ip'] ?? '')) === $cleanIp) {
                return;
            }
        }

        $now = now()->timezone(config('app.timezone', 'Asia/Ho_Chi_Minh'))->format('d/m/Y H:i');
        $blockedList[] = [
            'ip' => $cleanIp,
            'reason' => $reason,
            'blocked_at' => $now,
        ];

        ChatSetting::set(self::SETTING_KEY_BLOCKED_IPS, $blockedList, 'Danh sách IP bị chặn');
    }

    /**
     * Remove an IP address from the blacklist.
     */
    public function unblockIp(string $ip): void
    {
        $cleanIp = trim($ip);
        $blockedList = ChatSetting::get(self::SETTING_KEY_BLOCKED_IPS);
        if (! is_array($blockedList)) {
            $blockedList = self::DEFAULT_BLOCKED_IPS;
        }

        $filtered = array_values(array_filter($blockedList, function ($item) use ($cleanIp) {
            return trim((string) ($item['ip'] ?? '')) !== $cleanIp;
        }));

        ChatSetting::set(self::SETTING_KEY_BLOCKED_IPS, $filtered, 'Danh sách IP bị chặn');
    }

    /**
     * Inspect message text against enabled banned keywords.
     * Returns match metadata array if matched, or null otherwise.
     */
    public function checkBannedKeywords(string $text): ?array
    {
        $settings = $this->getSettings();
        if (empty($settings['keyword_filter'])) {
            return null;
        }

        $keywords = ChatSetting::get(self::SETTING_KEY_KEYWORDS);
        if (! is_array($keywords) || empty($keywords)) {
            $keywords = self::DEFAULT_BANNED_KEYWORDS;
        }

        $normalized = mb_strtolower($text, 'UTF-8');

        foreach ($keywords as $kw) {
            $enabled = ! isset($kw['enabled']) || (bool) $kw['enabled'];
            if (! $enabled) {
                continue;
            }

            $rawKw = trim((string) ($kw['keyword'] ?? ''));
            if ($rawKw === '') {
                continue;
            }

            $normalizedKw = mb_strtolower($rawKw, 'UTF-8');
            if (str_contains($normalized, $normalizedKw)) {
                return [
                    'keyword' => $rawKw,
                    'type' => $kw['type'] ?? 'Spam',
                    'type_class' => $kw['type_class'] ?? 'inappropriate',
                ];
            }
        }

        return null;
    }

    /**
     * Handle detection of a banned keyword in a conversation:
     * - Records sanitized ChatInternalNote with reason, timestamp, rule matched.
     * - If auto_spam_block is enabled, updates conversation status to Spam.
     * - Emits ChatConversationUpdated.
     */
    public function handleSpamDetected(ChatConversation $conversation, array $matchedRule): void
    {
        $settings = $this->getSettings();

        $kw = $matchedRule['keyword'] ?? 'Unknown';
        $type = $matchedRule['type'] ?? 'Spam';
        $timeStr = now()->timezone(config('app.timezone', 'Asia/Ho_Chi_Minh'))->format('d/m/Y H:i:s');

        ChatInternalNote::create([
            'chat_conversation_id' => $conversation->id,
            'user_id' => null,
            'note_body' => "[Bảo vệ Spam: Từ khóa cấm] Phát hiện từ khóa vi phạm '{$kw}' (Loại: {$type}) lúc {$timeStr}.",
        ]);

        if (! empty($settings['auto_spam_block'])) {
            $conversation->status = ChatConversationStatus::Spam;
            $conversation->save();

            event(new ChatConversationUpdated($conversation->fresh()));
        }
    }

    /**
     * Check and increment rate limit quota for visitor.
     * Max 5 messages / minute by default.
     * Returns true if allowed, false if quota exceeded.
     */
    public function checkRateLimit(ChatVisitor $visitor, ?string $ip = null, int $limit = 5): bool
    {
        $settings = $this->getSettings();
        if (empty($settings['rate_limit_filter'])) {
            return true;
        }

        $key = 'chat_spam_rate:' . ($visitor->visitor_uuid ?: ($ip ?: 'unknown'));
        
        return RateLimiter::attempt(
            $key,
            $limit,
            function () {},
            60
        );
    }
}
