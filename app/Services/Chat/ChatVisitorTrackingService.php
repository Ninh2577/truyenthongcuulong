<?php

namespace App\Services\Chat;

use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ChatVisitorTrackingService
{
    public const ONLINE_TIMEOUT_SECONDS = 60;
    public const TRACKING_CACHE_TTL_MINUTES = 60;
    public const ACTIVE_LIST_CACHE_KEY = 'chat:active_visitor_uuids';

    /**
     * Record a heartbeat from a visitor.
     *
     * @param  ChatVisitor  $visitor
     * @param  ChatVisitorSession|null  $session
     * @param  array  $payload  [current_url, page_title, referrer, ip, user_agent]
     * @return array
     */
    public function recordHeartbeat(ChatVisitor $visitor, ?ChatVisitorSession $session, array $payload = []): array
    {
        $now = now();
        $visitorUuid = $visitor->visitor_uuid;

        // 1. Update session last_active_at if session exists
        if ($session) {
            $session->update(['last_active_at' => $now]);
        }

        // 2. Resolve client info
        $userAgent = $payload['user_agent'] ?? null;
        if (empty($userAgent) || $userAgent === 'Symfony') {
            $userAgent = $visitor->user_agent ?? request()->userAgent() ?? '';
        }
        $uaParsed = $this->parseUserAgent($userAgent);

        $currentUrl = ! empty($payload['current_url']) ? trim(substr($payload['current_url'], 0, 500)) : '/';
        $pageTitle = ! empty($payload['page_title']) ? trim(substr($payload['page_title'], 0, 255)) : 'Trang chủ';
        $referrer = ! empty($payload['referrer']) ? trim(substr($payload['referrer'], 0, 500)) : null;

        // 3. Retrieve previous tracking to maintain dwell time
        $cacheKey = "chat:visitor:track:{$visitorUuid}";
        $prev = Cache::get($cacheKey, []);

        $pageEnteredAt = $now->toIso8601String();
        $dwellSeconds = 0;

        if (! empty($prev) && isset($prev['current_url'])) {
            if ($prev['current_url'] === $currentUrl && ! empty($prev['page_entered_at'])) {
                $pageEnteredAt = $prev['page_entered_at'];
                $dwellSeconds = max(0, $now->timestamp - Carbon::parse($pageEnteredAt)->timestamp);
            }
        }

        $trackingData = [
            'visitor_uuid' => $visitorUuid,
            'visitor_id' => $visitor->id,
            'session_id' => $session?->id,
            'status' => 'online',
            'is_online' => true,
            'current_url' => $currentUrl,
            'page_title' => $pageTitle,
            'referrer' => $referrer,
            'device_type' => $uaParsed['device_type'],
            'browser' => $uaParsed['browser'],
            'browser_version' => $uaParsed['browser_version'],
            'os' => $uaParsed['os'],
            'os_version' => $uaParsed['os_version'],
            'page_entered_at' => $pageEnteredAt,
            'dwell_seconds' => $dwellSeconds,
            'first_seen_at' => $visitor->created_at?->toIso8601String() ?? $now->toIso8601String(),
            'last_seen_at' => $now->toIso8601String(),
            'last_activity_at' => $now->toIso8601String(),
        ];

        Cache::put($cacheKey, $trackingData, now()->addMinutes(self::TRACKING_CACHE_TTL_MINUTES));

        // 4. Update the active visitors set
        $this->touchActiveList($visitorUuid, $now->timestamp);

        return $trackingData;
    }

    /**
     * Get tracking details for a visitor.
     *
     * @param  string  $visitorUuid
     * @param  ChatVisitor|null  $visitor
     * @return array
     */
    public function getTracking(string $visitorUuid, ?ChatVisitor $visitor = null): array
    {
        $cacheKey = "chat:visitor:track:{$visitorUuid}";
        $data = Cache::get($cacheKey);

        if (! is_array($data)) {
            $visitor = $visitor ?? ChatVisitor::where('visitor_uuid', $visitorUuid)->first();
            $uaParsed = $this->parseUserAgent($visitor?->user_agent ?? '');
            $latestSession = $visitor?->sessions()->latest('last_active_at')->first();

            $data = [
                'visitor_uuid' => $visitorUuid,
                'visitor_id' => $visitor?->id,
                'session_id' => $latestSession?->id,
                'status' => 'offline',
                'is_online' => false,
                'current_url' => '/',
                'page_title' => 'Trang chủ',
                'referrer' => null,
                'device_type' => $uaParsed['device_type'],
                'browser' => $uaParsed['browser'],
                'browser_version' => $uaParsed['browser_version'],
                'os' => $uaParsed['os'],
                'os_version' => $uaParsed['os_version'],
                'page_entered_at' => null,
                'dwell_seconds' => 0,
                'first_seen_at' => $visitor?->created_at?->toIso8601String(),
                'last_seen_at' => $latestSession?->last_active_at?->toIso8601String() ?? $visitor?->updated_at?->toIso8601String(),
                'last_activity_at' => $latestSession?->last_active_at?->toIso8601String() ?? $visitor?->updated_at?->toIso8601String(),
            ];
        }

        // Recompute online status dynamically based on last_activity_at
        $isOnline = false;
        if (! empty($data['last_activity_at'])) {
            $diffSeconds = abs(now()->timestamp - Carbon::parse($data['last_activity_at'])->timestamp);
            $isOnline = $diffSeconds < self::ONLINE_TIMEOUT_SECONDS;
        }

        $data['is_online'] = $isOnline;
        $data['status'] = $isOnline ? 'online' : 'offline';

        return $data;
    }

    /**
     * Compute realtime counts of online and offline visitors.
     *
     * @return array [online => int, offline => int]
     */
    public function getStatusCounts(): array
    {
        $activeList = Cache::get(self::ACTIVE_LIST_CACHE_KEY, []);
        $now = now()->timestamp;
        $onlineCount = 0;
        $prunedList = [];

        foreach ($activeList as $uuid => $timestamp) {
            if (($now - $timestamp) < self::ONLINE_TIMEOUT_SECONDS) {
                $onlineCount++;
                $prunedList[$uuid] = $timestamp;
            } elseif (($now - $timestamp) < 3600) {
                $prunedList[$uuid] = $timestamp;
            }
        }

        if (count($prunedList) !== count($activeList)) {
            Cache::put(self::ACTIVE_LIST_CACHE_KEY, $prunedList, now()->addHours(2));
        }

        $totalVisitors = ChatVisitor::count();
        $offlineCount = max(0, $totalVisitors - $onlineCount);

        return [
            'online' => $onlineCount,
            'offline' => $offlineCount,
            'total' => $totalVisitors,
        ];
    }

    /**
     * Update active visitors list with current timestamp.
     */
    protected function touchActiveList(string $visitorUuid, int $timestamp): void
    {
        $activeList = Cache::get(self::ACTIVE_LIST_CACHE_KEY, []);
        $activeList[$visitorUuid] = $timestamp;

        // Keep maximum 500 active records in cache
        if (count($activeList) > 500) {
            $cutoff = $timestamp - 3600;
            $activeList = array_filter($activeList, fn ($ts) => $ts >= $cutoff);
        }

        Cache::put(self::ACTIVE_LIST_CACHE_KEY, $activeList, now()->addHours(2));
    }

    /**
     * Parse User-Agent string into Device, Browser, and OS.
     *
     * @param  string  $ua
     * @return array
     */
    public function parseUserAgent(string $ua): array
    {
        $uaLower = strtolower($ua);

        // 1. Device Type
        $device = 'Desktop';
        if (preg_match('/(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk)/i', $ua)) {
            $device = 'Tablet';
        } elseif (preg_match('/(mobi|iphone|ipod|android.*mobile|blackberry|bb10|phone|opera mini|iemobile)/i', $ua)) {
            $device = 'Mobile';
        }

        // 2. Browser & Version
        $browser = 'Other';
        $browserVersion = '';

        if (preg_match('/edg\/([0-9.]+)/i', $ua, $matches)) {
            $browser = 'Edge';
            $browserVersion = $matches[1] ?? '';
        } elseif (preg_match('/(crios|chrome)\/([0-9.]+)/i', $ua, $matches)) {
            $browser = 'Chrome';
            $browserVersion = $matches[2] ?? '';
        } elseif (preg_match('/version\/([0-9.]+).*safari/i', $ua, $matches)) {
            $browser = 'Safari';
            $browserVersion = $matches[1] ?? '';
        } elseif (preg_match('/(firefox|fxios)\/([0-9.]+)/i', $ua, $matches)) {
            $browser = 'Firefox';
            $browserVersion = $matches[2] ?? '';
        } elseif (str_contains($uaLower, 'safari') && ! str_contains($uaLower, 'chrome')) {
            $browser = 'Safari';
        }

        // 3. Operating System & Version
        $os = 'Other';
        $osVersion = '';

        if (preg_match('/windows nt ([0-9.]+)/i', $ua, $matches)) {
            $os = 'Windows';
            $osVersion = match ($matches[1] ?? '') {
                '10.0' => '10/11',
                '6.3' => '8.1',
                '6.2' => '8',
                '6.1' => '7',
                default => $matches[1] ?? '',
            };
        } elseif (preg_match('/android ([0-9.]+)/i', $ua, $matches)) {
            $os = 'Android';
            $osVersion = $matches[1] ?? '';
        } elseif (preg_match('/(iphone|ipad|ipod).*os ([0-9_]+)/i', $ua, $matches)) {
            $os = 'iOS';
            $osVersion = str_replace('_', '.', $matches[2] ?? '');
        } elseif (preg_match('/mac os x ([0-9_.]+)/i', $ua, $matches)) {
            $os = 'macOS';
            $osVersion = str_replace('_', '.', $matches[1] ?? '');
        } elseif (str_contains($uaLower, 'linux')) {
            $os = 'Linux';
        }

        return [
            'device_type' => $device,
            'browser' => $browser,
            'browser_version' => $browserVersion,
            'os' => $os,
            'os_version' => $osVersion,
        ];
    }
}
