<?php

namespace App\Services\Chat;

use App\Models\ChatSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ChatQuickReplyService
{
    /**
     * Cache key for quick replies.
     */
    public const CACHE_KEY = 'chat:quick_replies:catalog';
    public const SETTING_KEY = 'chat_quick_replies';

    /**
     * Get all active quick replies.
     */
    public function getAllQuickReplies(): array
    {
        return Cache::remember(self::CACHE_KEY, 3600, function () {
            $setting = ChatSetting::get(self::SETTING_KEY);
            if (! empty($setting) && is_array($setting)) {
                return $setting;
            }

            // Seed default quick replies if not set
            $defaults = $this->getDefaultQuickReplies();
            $this->saveQuickReplies($defaults);

            return $defaults;
        });
    }

    /**
     * Save all quick replies to settings and clear cache.
     */
    public function saveQuickReplies(array $replies): void
    {
        ChatSetting::set(
            self::SETTING_KEY,
            $replies,
            'Danh mục phím tắt & tin nhắn mẫu CSKH Cửu Long'
        );

        $this->clearCache();
    }

    /**
     * Create a new quick reply.
     */
    public function createQuickReply(array $data): array
    {
        $all = $this->getAllQuickReplies();

        $shortcut = '/' . ltrim(trim($data['shortcut'] ?? 'new'), '/');
        $id = ! empty($data['id']) ? Str::slug($data['id']) : Str::slug(ltrim($shortcut, '/'));
        
        // Ensure unique ID
        $existingIds = array_column($all, 'id');
        $finalId = $id;
        $counter = 1;
        while (in_array($finalId, $existingIds, true)) {
            $finalId = "{$id}-{$counter}";
            $counter++;
        }

        $newItem = [
            'id' => $finalId,
            'title' => trim($data['title'] ?? 'Mẫu tin nhắn mới'),
            'shortcut' => $shortcut,
            'category' => trim($data['category'] ?? 'Tư vấn dịch vụ'),
            'description' => trim($data['description'] ?? ''),
            'content' => trim($data['content'] ?? ''),
            'is_active' => (bool) ($data['is_active'] ?? true),
            'usage_count' => (int) ($data['usage_count'] ?? 0),
            'updated_at' => now()->format('H:i d/m/Y'),
        ];

        $all[] = $newItem;
        $this->saveQuickReplies($all);

        return $newItem;
    }

    /**
     * Update an existing quick reply.
     */
    public function updateQuickReply(string $id, array $data): ?array
    {
        $all = $this->getAllQuickReplies();
        $updatedItem = null;

        foreach ($all as $index => $item) {
            if ($item['id'] === $id) {
                $shortcut = ! empty($data['shortcut']) ? '/' . ltrim(trim($data['shortcut']), '/') : $item['shortcut'];
                $all[$index] = array_merge($item, [
                    'title' => trim($data['title'] ?? $item['title']),
                    'shortcut' => $shortcut,
                    'category' => trim($data['category'] ?? $item['category'] ?? 'Tư vấn dịch vụ'),
                    'description' => trim($data['description'] ?? $item['description'] ?? ''),
                    'content' => trim($data['content'] ?? $item['content']),
                    'is_active' => isset($data['is_active']) ? (bool) $data['is_active'] : (bool) $item['is_active'],
                    'updated_at' => now()->format('H:i d/m/Y'),
                ]);
                $updatedItem = $all[$index];
                break;
            }
        }

        if ($updatedItem) {
            $this->saveQuickReplies($all);
        }

        return $updatedItem;
    }

    /**
     * Delete a quick reply by ID.
     */
    public function deleteQuickReply(string $id): bool
    {
        $all = $this->getAllQuickReplies();
        $initialCount = count($all);

        $filtered = array_values(array_filter($all, fn ($item) => $item['id'] !== $id));
        if (count($filtered) !== $initialCount) {
            $this->saveQuickReplies($filtered);
            return true;
        }

        return false;
    }

    /**
     * Toggle active state.
     */
    public function toggleQuickReply(string $id): bool
    {
        $all = $this->getAllQuickReplies();
        $toggled = false;

        foreach ($all as $index => $item) {
            if ($item['id'] === $id) {
                $all[$index]['is_active'] = ! ($item['is_active'] ?? true);
                $all[$index]['updated_at'] = now()->format('H:i d/m/Y');
                $toggled = true;
                break;
            }
        }

        if ($toggled) {
            $this->saveQuickReplies($all);
        }

        return $toggled;
    }

    /**
     * Increment usage counter for a quick reply.
     */
    public function recordUsage(string $id): void
    {
        $all = $this->getAllQuickReplies();
        foreach ($all as $index => $item) {
            if ($item['id'] === $id) {
                $all[$index]['usage_count'] = ($item['usage_count'] ?? 0) + 1;
                break;
            }
        }
        $this->saveQuickReplies($all);
    }

    /**
     * Reset to standard defaults.
     */
    public function resetToDefaults(): array
    {
        $defaults = $this->getDefaultQuickReplies();
        $this->saveQuickReplies($defaults);

        return $defaults;
    }

    /**
     * Search quick replies matching query.
     */
    public function search(string $query): array
    {
        $all = $this->getAllQuickReplies();
        $q = mb_strtolower(trim($query));
        if ($q === '' || $q === '/') {
            return array_values(array_filter($all, fn ($item) => $item['is_active'] ?? true));
        }

        $cleanQuery = ltrim($q, '/');

        return array_values(array_filter($all, function ($item) use ($cleanQuery) {
            if (! ($item['is_active'] ?? true)) {
                return false;
            }

            $shortcut = mb_strtolower(ltrim($item['shortcut'], '/'));
            $title = mb_strtolower($item['title']);
            $category = mb_strtolower($item['category'] ?? '');

            return str_contains($shortcut, $cleanQuery)
                || str_contains($title, $cleanQuery)
                || str_contains($category, $cleanQuery);
        }));
    }

    /**
     * Find a quick reply by its exact shortcut (e.g. /gia, /hello, /contact).
     */
    public function findByShortcut(string $shortcut): ?array
    {
        $normalized = '/' . ltrim(trim($shortcut), '/');
        foreach ($this->getAllQuickReplies() as $reply) {
            if (mb_strtolower($reply['shortcut']) === mb_strtolower($normalized)) {
                return $reply;
            }
        }

        return null;
    }

    /**
     * Clear cached quick replies.
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Standard business quick replies adhering to Truyền Thông Cửu Long's official guidelines.
     * Categorized into: Chào hỏi, Tư vấn dịch vụ, Báo giá, CSKH, Khác
     */
    public function getDefaultQuickReplies(): array
    {
        return [
            [
                'id' => 'hello',
                'title' => 'Chào hỏi khách hàng',
                'shortcut' => '/hello',
                'category' => 'Chào hỏi',
                'description' => 'Tin nhắn mở đầu thân thiện, chuyên nghiệp',
                'content' => 'Chào anh/chị! Cảm ơn anh/chị đã quan tâm đến Truyền Thông Cửu Long. Anh/chị đang cần tư vấn về dịch vụ nào ạ?',
                'is_active' => true,
                'usage_count' => 142,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'website',
                'title' => 'Tư vấn dịch vụ Website',
                'shortcut' => '/website',
                'category' => 'Tư vấn dịch vụ',
                'description' => 'Thông tin năng lực thiết kế website chuẩn SEO',
                'content' => 'Truyền Thông Cửu Long cung cấp dịch vụ thiết kế website chuyên nghiệp, chuẩn SEO, giao diện hiện đại. Anh/chị cần tư vấn thêm về dịch vụ nào ạ?',
                'is_active' => true,
                'usage_count' => 176,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'gia',
                'title' => 'Gửi báo giá dịch vụ',
                'shortcut' => '/gia',
                'category' => 'Báo giá',
                'description' => 'Giới thiệu chính sách giá minh bạch',
                'content' => 'Dạ em gửi anh/chị bảng giá dịch vụ của Truyền Thông Cửu Long để anh/chị tham khảo ạ. Nếu cần tư vấn thêm, anh/chị cứ liên hệ em nhé!',
                'is_active' => true,
                'usage_count' => 215,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'contact',
                'title' => 'Thông tin liên hệ & Zalo',
                'shortcut' => '/contact',
                'category' => 'CSKH',
                'description' => 'Cung cấp số Hotline & Zalo tư vấn trực tiếp',
                'content' => 'Anh/chị có thể liên hệ Truyền Thông Cửu Long qua Zalo: 0939 363 262 để được tư vấn trực tiếp hoặc để lại thông tin, chúng em sẽ liên hệ lại ạ.',
                'is_active' => true,
                'usage_count' => 98,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'tuvan',
                'title' => 'Tạo yêu cầu tư vấn',
                'shortcut' => '/tuvan',
                'category' => 'Tư vấn dịch vụ',
                'description' => 'Thu thập thông tin nhu cầu khách hàng',
                'content' => 'Anh/chị vui lòng để lại thông tin bên dưới để được đội ngũ tư vấn của Truyền Thông Cửu Long hỗ trợ nhanh nhất ạ!',
                'is_active' => true,
                'usage_count' => 64,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'faq',
                'title' => 'Hỏi đáp thường gặp',
                'shortcut' => '/faq',
                'category' => 'Khác',
                'description' => 'Giải đáp các thắc mắc phổ biến của khách hàng',
                'content' => "Dưới đây là một số câu hỏi thường gặp:\n- Thời gian hoàn thành dự án là bao lâu?\n- Chi phí thiết kế website như thế nào?...",
                'is_active' => false,
                'usage_count' => 38,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'marketing',
                'title' => 'Tư vấn Marketing đa kênh',
                'shortcut' => '/marketing',
                'category' => 'Tư vấn dịch vụ',
                'description' => 'Tư vấn giải pháp đa kênh Google, Meta, TikTok',
                'content' => 'Gói Marketing Tổng Thể của Cửu Long kết hợp tối ưu đồng bộ đa kênh (Google Ads + Meta Ads + TikTok Ads) kèm sản xuất tư liệu video sáng tạo giúp tối ưu chi phí chuyển đổi và bám đuổi khách hàng tiềm năng hiệu quả.',
                'is_active' => true,
                'usage_count' => 112,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'tvc',
                'title' => 'Sản xuất Video & TVC 4K',
                'shortcut' => '/tvc',
                'category' => 'Tư vấn dịch vụ',
                'description' => 'Quy trình sản xuất phim doanh nghiệp chuẩn 4K',
                'content' => 'Về dịch vụ Media & TVC, ekip Cửu Long sản xuất chuẩn điện ảnh 4K ProRes với máy quay Sony FX Cinema, Flycam 4K không giới hạn góc quay và chỉnh màu DaVinci Resolve chuyên nghiệp.',
                'is_active' => true,
                'usage_count' => 84,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'baogia',
                'title' => 'Báo giá dịch vụ nhanh',
                'shortcut' => '/baogia',
                'category' => 'Báo giá',
                'description' => 'Kích hoạt gửi báo giá dịch vụ chính thức',
                'content' => 'Dạ em xin gửi bảng báo giá chính thức chi tiết kèm theo các quyền lợi và cam kết kỹ thuật của Truyền Thông Cửu Long qua tin nhắn này để anh/chị tiện theo dõi ạ.',
                'is_active' => true,
                'usage_count' => 163,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'chao_mung',
                'title' => 'Chào mừng quay trở lại',
                'shortcut' => '/welcome',
                'category' => 'Chào hỏi',
                'description' => 'Lời chào đón khách hàng thân thiết',
                'content' => 'Chào mừng anh/chị đã quay trở lại với Truyền Thông Cửu Long! Em có thể tiếp tục hỗ trợ tiến độ dự án hay tư vấn giải pháp mới nào cho anh/chị hôm nay ạ?',
                'is_active' => true,
                'usage_count' => 77,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'cam_on',
                'title' => 'Cảm ơn đã tin tưởng dịch vụ',
                'shortcut' => '/thanks',
                'category' => 'CSKH',
                'description' => 'Tin nhắn tri ân khách hàng',
                'content' => 'Cảm ơn anh/chị đã tin tưởng và đồng hành cùng Truyền Thông Cửu Long. Chúc anh/chị và doanh nghiệp ngày càng phát triển và bứt phá thành công rực rỡ!',
                'is_active' => true,
                'usage_count' => 52,
                'updated_at' => '20/10/2026',
            ],
            [
                'id' => 'chinh_sach',
                'title' => 'Chính sách bảo hành & hỗ trợ',
                'shortcut' => '/policy',
                'category' => 'Khác',
                'description' => 'Cam kết bảo hành kỹ thuật dự án',
                'content' => 'Toàn bộ dự án công nghệ tại Truyền Thông Cửu Long đều được cam kết bảo hành kỹ thuật, hỗ trợ trực tuyến 24/7 và backup dữ liệu định kỳ an toàn tuyệt đối.',
                'is_active' => true,
                'usage_count' => 45,
                'updated_at' => '20/10/2026',
            ],
        ];
    }
}
