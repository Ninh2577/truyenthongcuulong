<?php

namespace App\Services;

class RolePermissionMatrixHelper
{
    /**
     * Nhóm chức năng chính (Đồng bộ 100% với Navigation Menu)
     */
    public const GROUP_CONTENT = 'content';
    public const GROUP_BUSINESS = 'business';
    public const GROUP_COMMUNICATION = 'communication';
    public const GROUP_SYSTEM = 'system';
    public const GROUP_DASHBOARD = 'dashboard';

    /**
     * Cấu hình chi tiết các Resource và nhãn tiếng Việt chuẩn theo Sidebar Menu
     */
    public static function getResourceRegistry(): array
    {
        return [
            // 1. Nhóm NỘI DUNG & TIN TỨC
            'post' => [
                'name' => 'Bài Viết',
                'group' => self::GROUP_CONTENT,
                'icon' => 'heroicon-o-document-text',
                'description' => 'Quản lý tin tức, bài viết chuyên môn và bài PR thương hiệu.',
            ],
            'category' => [
                'name' => 'Danh Mục Bài Viết',
                'group' => self::GROUP_CONTENT,
                'icon' => 'heroicon-o-folder',
                'description' => 'Danh mục phân loại tin tức và bài viết.',
            ],
            'resource::post' => [
                'name' => 'Tài Nguyên',
                'group' => self::GROUP_CONTENT,
                'icon' => 'heroicon-o-book-open',
                'description' => 'Tài liệu, Ebook và tài nguyên truyền thông tải về.',
            ],

            // 2. Nhóm DỊCH VỤ & KHÁCH HÀNG
            'service' => [
                'name' => 'Dịch Vụ & Giải Pháp',
                'group' => self::GROUP_BUSINESS,
                'icon' => 'heroicon-o-sparkles',
                'description' => 'Chi tiết các giải pháp dịch vụ truyền thông của công ty.',
            ],
            'case::study' => [
                'name' => 'Dự Án Tiêu Biểu',
                'group' => self::GROUP_BUSINESS,
                'icon' => 'heroicon-o-briefcase',
                'description' => 'Các dự án thành công và hồ sơ năng lực thực tế.',
            ],
            'pricing::plan' => [
                'name' => 'Bảng Giá Dịch Vụ',
                'group' => self::GROUP_BUSINESS,
                'icon' => 'heroicon-o-credit-card',
                'description' => 'Gói báo giá dịch vụ marketing và sản xuất media.',
            ],
            'client' => [
                'name' => 'Khách Hàng Tiêu Biểu',
                'group' => self::GROUP_BUSINESS,
                'icon' => 'heroicon-o-user-group',
                'description' => 'Danh sách khách hàng doanh nghiệp và đối tác khách hàng.',
            ],

            // 3. Nhóm CHAT, CSKH & TUYỂN DỤNG
            'contact' => [
                'name' => 'Yêu Cầu Tư Vấn',
                'group' => self::GROUP_COMMUNICATION,
                'icon' => 'heroicon-o-chat-bubble-left-right',
                'description' => 'Lead và thông tin liên hệ khách hàng để lại từ website.',
            ],
            'job::application' => [
                'name' => 'Hồ Sơ Ứng Tuyển',
                'group' => self::GROUP_COMMUNICATION,
                'icon' => 'heroicon-o-identification',
                'description' => 'Ứng viên nộp CV và hồ sơ xin việc qua website.',
            ],

            // 4. Nhóm CẤU HÌNH & HỆ THỐNG
            'partner' => [
                'name' => 'Đối Tác Chiến Lược',
                'group' => self::GROUP_SYSTEM,
                'icon' => 'heroicon-o-building-office-2',
                'description' => 'Mạng lưới đối tác liên kết thương hiệu.',
            ],
            'menu' => [
                'name' => 'Menu Website',
                'group' => self::GROUP_SYSTEM,
                'icon' => 'heroicon-o-bars-3',
                'description' => 'Cấu trúc các menu điều hướng trang web.',
            ],
            'menu::item' => [
                'name' => 'Liên Kết Menu Con',
                'group' => self::GROUP_SYSTEM,
                'icon' => 'heroicon-o-link',
                'description' => 'Các mục liên kết chi tiết trong từng cấu trúc menu.',
            ],
            'redirect' => [
                'name' => 'SEO (Chuyển hướng 301)',
                'group' => self::GROUP_SYSTEM,
                'icon' => 'heroicon-o-arrows-right-left',
                'description' => 'Quản lý chuyển hướng link để giữ thứ hạng SEO.',
            ],
            'user' => [
                'name' => 'Tài Khoản Quản Trị',
                'group' => self::GROUP_SYSTEM,
                'icon' => 'heroicon-o-users',
                'description' => 'Quản lý danh sách nhân sự quản trị hệ thống.',
                'sensitive' => true,
            ],
            'role' => [
                'name' => 'Vai Trò & Phân Quyền',
                'group' => self::GROUP_SYSTEM,
                'icon' => 'heroicon-o-shield-check',
                'description' => 'Thiết lập vai trò và ma trận quyền truy cập.',
                'sensitive' => true,
            ],
        ];
    }

    /**
     * Danh sách Trang (Pages) đặc biệt kèm nhãn tiếng Việt
     */
    public static function getPageRegistry(): array
    {
        return [
            // Pages thuộc nhóm Nội Dung
            'page_MediaLibrary' => [
                'name' => 'Thư Viện Media',
                'group' => self::GROUP_CONTENT,
                'description' => 'Quản lý hình ảnh, video và tài liệu upload.',
            ],

            // Pages thuộc nhóm Chat & CSKH
            'page_ChatInbox' => [
                'name' => 'Hộp Thư Trực Tuyến',
                'group' => self::GROUP_COMMUNICATION,
                'description' => 'Trực tiếp trò chuyện và giải đáp khách hàng.',
            ],
            'page_ChatVisitorsPage' => [
                'name' => 'Khách Hàng (Trực Tuyến)',
                'group' => self::GROUP_COMMUNICATION,
                'description' => 'Theo dõi luồng khách đang xem trang theo thời gian thực.',
            ],
            'page_ChatAutomationSettings' => [
                'name' => 'Kịch Bản Tự Động',
                'group' => self::GROUP_COMMUNICATION,
                'description' => 'Kịch bản tin nhắn tự động và phân luồng tiếp nhận.',
            ],
            'page_ChatSpamPage' => [
                'name' => 'Spam & Chặn',
                'group' => self::GROUP_COMMUNICATION,
                'description' => 'Quản lý chặn các IP và số điện thoại quấy rối.',
            ],
            'page_ChatAISettings' => [
                'name' => 'Trợ Lý AI Bot',
                'group' => self::GROUP_COMMUNICATION,
                'description' => 'Cấu hình prompt và kịch bản phản hồi của AI.',
            ],

            // Pages thuộc nhóm Cấu hình
            'page_GeneralSettings' => [
                'name' => 'Cài Đặt',
                'group' => self::GROUP_SYSTEM,
                'description' => 'Thông tin công ty, hotline, email và cấu hình lõi.',
                'sensitive' => true,
            ],
            'page_SchemaSettings' => [
                'name' => 'Cấu Hình Schema (SEO)',
                'group' => self::GROUP_SYSTEM,
                'description' => 'Dữ liệu có cấu trúc Structured Data cho Google.',
                'sensitive' => true,
            ],
        ];
    }

    /**
     * Danh sách Widgets kèm nhãn tiếng Việt
     */
    public static function getWidgetRegistry(): array
    {
        return [
            'widget_DashboardOverview' => [
                'name' => 'Tổng quan chỉ số chính (KPIs)',
                'description' => 'Thẻ thống kê lượt xem, lead và bài viết mới.',
            ],
            'widget_ActionCenterWidget' => [
                'name' => 'Trung tâm tác vụ & Cảnh báo',
                'description' => 'Các việc cần xử lý ngay trong ngày.',
            ],
            'widget_NewContactsWidget' => [
                'name' => 'Yêu cầu tư vấn mới nhất',
                'description' => 'Danh sách khách hàng vừa để lại thông tin.',
            ],
            'widget_NewJobApplicationsWidget' => [
                'name' => 'Ứng viên tuyển dụng mới',
                'description' => 'Hồ sơ xin việc mới gửi gần đây.',
            ],
            'widget_QuickActionsWidget' => [
                'name' => 'Phím tắt tác vụ nhanh',
                'description' => 'Nút tạo nhanh bài viết, dự án, tài khoản.',
            ],
            'widget_MediaStatsWidget' => [
                'name' => 'Thống kê dung lượng Media',
                'description' => 'Dung lượng ổ đĩa đã sử dụng cho hình ảnh/video.',
            ],
            'widget_SeoHealthWidget' => [
                'name' => 'Đánh giá sức khỏe SEO',
                'description' => 'Kiểm tra điểm chất lượng SEO trang web.',
            ],
        ];
    }

    /**
     * Thứ tự hiển thị chuẩn của các hành động CRUD
     */
    public static function getActionLabels(): array
    {
        return [
            'view_any' => 'Xem danh sách',
            'view' => 'Xem chi tiết',
            'create' => 'Thêm mới',
            'update' => 'Cập nhật',
            'delete' => 'Xóa',
            'delete_any' => 'Xóa nhiều (Hàng loạt)',
        ];
    }

    /**
     * Dịch tên quyền kỹ thuật sang nhãn tiếng Việt đầy đủ và dễ hiểu
     */
    public static function translatePermission(string $permissionKey): string
    {
        // 1. Kiểm tra Pages
        $pages = self::getPageRegistry();
        if (isset($pages[$permissionKey])) {
            return 'Truy cập ' . $pages[$permissionKey]['name'];
        }

        // 2. Kiểm tra Widgets
        $widgets = self::getWidgetRegistry();
        if (isset($widgets[$permissionKey])) {
            return 'Hiển thị ' . $widgets[$permissionKey]['name'];
        }

        // 3. Phân tách Resource Action (Xử lý delete_any trước để tránh clash prefix với delete)
        $resources = self::getResourceRegistry();
        $actionsForLookup = [
            'delete_any' => 'Xóa nhiều (Hàng loạt)',
            'view_any' => 'Xem danh sách',
            'view' => 'Xem chi tiết',
            'create' => 'Thêm mới',
            'update' => 'Cập nhật',
            'delete' => 'Xóa',
        ];

        foreach ($actionsForLookup as $actionKey => $actionLabel) {
            if (str_starts_with($permissionKey, $actionKey . '_')) {
                $resourceKey = substr($permissionKey, strlen($actionKey . '_'));
                $resourceName = $resources[$resourceKey]['name'] ?? $resourceKey;
                return "{$actionLabel} - {$resourceName}";
            }
        }

        return $permissionKey;
    }

    public const LEVEL_NORMAL = 'normal';
    public const LEVEL_SENSITIVE = 'sensitive';
    public const LEVEL_CRITICAL = 'critical';

    /**
     * Xác định mức độ nhạy cảm 3 cấp độ:
     * - LEVEL 1 — NORMAL: view, view_any, create, update cơ bản
     * - LEVEL 2 — SENSITIVE: delete, delete_any, customer/contact, CSKH, chat
     * - LEVEL 3 — CRITICAL: user, role, permission, general settings, schema settings
     */
    public static function getPermissionSensitivity(string $permissionKey): string
    {
        // 1. Level 3 — CRITICAL: Quản lý người dùng, vai trò, cài đặt lõi hệ thống
        if (
            str_contains($permissionKey, 'role') ||
            str_contains($permissionKey, 'user') ||
            str_contains($permissionKey, 'super_admin') ||
            str_contains($permissionKey, 'Settings') ||
            $permissionKey === 'page_GeneralSettings' ||
            $permissionKey === 'page_SchemaSettings'
        ) {
            return self::LEVEL_CRITICAL;
        }

        // 2. Level 2 — SENSITIVE: Quyền xóa, xóa hàng loạt, tiếp cận dữ liệu khách hàng & kênh tương tác CSKH
        if (
            str_contains($permissionKey, 'delete_any') ||
            str_contains($permissionKey, 'delete_') ||
            str_contains($permissionKey, '_contact') ||
            str_contains($permissionKey, '_job_application') ||
            str_contains($permissionKey, 'Chat') ||
            $permissionKey === 'page_ChatSpamPage' ||
            $permissionKey === 'page_ChatAISettings' ||
            $permissionKey === 'page_ChatAutomationSettings'
        ) {
            return self::LEVEL_SENSITIVE;
        }

        // 3. Level 1 — NORMAL: Xem, thêm, cập nhật nghiệp vụ thông thường
        return self::LEVEL_NORMAL;
    }

    /**
     * Kiểm tra quyền có phải là quyền nhạy cảm (Level 2 hoặc Level 3) không.
     * Bảo toàn 100% tương thích ngược với các test hiện tại.
     */
    public static function isSensitivePermission(string $permissionKey): bool
    {
        return self::getPermissionSensitivity($permissionKey) !== self::LEVEL_NORMAL;
    }

    /**
     * Trả về thông tin huy hiệu cho từng mức độ nhạy cảm.
     */
    public static function getSensitivityBadgeInfo(string $level): array
    {
        return match ($level) {
            self::LEVEL_CRITICAL => [
                'label' => '🔴 Cực kỳ nhạy cảm',
                'short_label' => 'Cực kỳ nhạy cảm',
                'color' => 'danger',
                'badge_class' => 'bg-red-500/10 text-red-600 border border-red-500/20 font-bold',
            ],
            self::LEVEL_SENSITIVE => [
                'label' => '🟠 Nhạy cảm',
                'short_label' => 'Nhạy cảm',
                'color' => 'warning',
                'badge_class' => 'bg-amber-500/10 text-amber-600 border border-amber-500/20 font-semibold',
            ],
            default => [
                'label' => '🟢 Thông thường',
                'short_label' => 'Thông thường',
                'color' => 'success',
                'badge_class' => 'bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 font-medium',
            ],
        };
    }

    /**
     * Tính toán Preview Before/After khi thay đổi quyền:
     * CURRENT + ADDED - REMOVED = FINAL
     *
     * @param array<string> $beforePermissions
     * @param array<string> $afterPermissions
     * @return array
     */
    public static function calculatePermissionDiff(array $beforePermissions, array $afterPermissions): array
    {
        $before = array_values(array_unique($beforePermissions));
        $after = array_values(array_unique($afterPermissions));

        $added = array_values(array_diff($after, $before));
        $removed = array_values(array_diff($before, $after));
        $retained = array_values(array_intersect($before, $after));

        $addedCritical = array_values(array_filter($added, fn ($k) => self::getPermissionSensitivity($k) === self::LEVEL_CRITICAL));
        $addedSensitive = array_values(array_filter($added, fn ($k) => self::getPermissionSensitivity($k) === self::LEVEL_SENSITIVE));

        return [
            'before_count' => count($before),
            'added' => $added,
            'added_count' => count($added),
            'removed' => $removed,
            'removed_count' => count($removed),
            'retained_count' => count($retained),
            'final_count' => count($after),
            'net_change' => count($added) - count($removed),
            'has_critical_added' => ! empty($addedCritical),
            'critical_added' => $addedCritical,
            'has_sensitive_added' => ! empty($addedSensitive),
            'sensitive_added' => $addedSensitive,
        ];
    }

    /**
     * Thu thập danh mục 105 permissions cùng thông tin metadata đầy đủ phục vụ search và so sánh.
     */
    public static function getAllPermissionsMetadata(): array
    {
        $list = [];

        // 1. Resources
        $resources = self::getResourceRegistry();
        $actions = self::getActionLabels();
        foreach ($resources as $resKey => $resConfig) {
            foreach ($actions as $actionKey => $actionLabel) {
                $permKey = "{$actionKey}_{$resKey}";
                $sensitivity = self::getPermissionSensitivity($permKey);
                $list[$permKey] = [
                    'key' => $permKey,
                    'action' => $actionKey,
                    'action_label' => $actionLabel,
                    'resource_key' => $resKey,
                    'module' => $resConfig['name'],
                    'group' => $resConfig['group'],
                    'title' => "{$actionLabel} - {$resConfig['name']}",
                    'sensitivity' => $sensitivity,
                    'type' => 'resource',
                ];
            }
        }

        // 2. Pages
        $pages = self::getPageRegistry();
        foreach ($pages as $pageKey => $pageConfig) {
            $sensitivity = self::getPermissionSensitivity($pageKey);
            $list[$pageKey] = [
                'key' => $pageKey,
                'action' => 'access',
                'action_label' => 'Truy cập',
                'resource_key' => $pageKey,
                'module' => $pageConfig['name'],
                'group' => $pageConfig['group'],
                'title' => "Truy cập {$pageConfig['name']}",
                'sensitivity' => $sensitivity,
                'type' => 'page',
            ];
        }

        // 3. Widgets
        $widgets = self::getWidgetRegistry();
        foreach ($widgets as $widgetKey => $widgetConfig) {
            $sensitivity = self::getPermissionSensitivity($widgetKey);
            $list[$widgetKey] = [
                'key' => $widgetKey,
                'action' => 'view',
                'action_label' => 'Hiển thị',
                'resource_key' => $widgetKey,
                'module' => $widgetConfig['name'],
                'group' => self::GROUP_DASHBOARD,
                'title' => "Hiển thị {$widgetConfig['name']}",
                'sensitivity' => $sensitivity,
                'type' => 'widget',
            ];
        }

        return $list;
    }

    /**
     * Tìm kiếm quyền hạn dựa trên từ khóa tiếng Việt, permission key, module hoặc action.
     */
    public static function searchPermissions(string $query): array
    {
        $q = mb_strtolower(trim($query));
        if ($q === '') {
            return self::getAllPermissionsMetadata();
        }

        return array_filter(self::getAllPermissionsMetadata(), function ($item) use ($q) {
            return str_contains(mb_strtolower($item['key']), $q)
                || str_contains(mb_strtolower($item['title']), $q)
                || str_contains(mb_strtolower($item['module']), $q)
                || str_contains(mb_strtolower($item['action_label']), $q);
        });
    }

    /**
     * So sánh chi tiết quyền hạn giữa Role A và Role B
     *
     * @param \Spatie\Permission\Models\Role|array $roleA
     * @param \Spatie\Permission\Models\Role|array $roleB
     * @return array
     */
    public static function compareRoles($roleA, $roleB): array
    {
        $permsA = $roleA instanceof \Spatie\Permission\Models\Role
            ? $roleA->permissions->pluck('name')->toArray()
            : (array) $roleA;
        $permsB = $roleB instanceof \Spatie\Permission\Models\Role
            ? $roleB->permissions->pluck('name')->toArray()
            : (array) $roleB;

        $both = array_values(array_intersect($permsA, $permsB));
        $aOnly = array_values(array_diff($permsA, $permsB));
        $bOnly = array_values(array_diff($permsB, $permsA));

        $allMetadata = self::getAllPermissionsMetadata();
        $allKeys = array_keys($allMetadata);

        $neither = array_values(array_diff($allKeys, array_unique(array_merge($permsA, $permsB))));

        return [
            'both' => $both,
            'a_only' => $aOnly,
            'b_only' => $bOnly,
            'neither' => $neither,
            'role_a_perms' => $permsA,
            'role_b_perms' => $permsB,
            'items' => array_values($allMetadata),
        ];
    }

    /**
     * Nhóm danh mục chính hiển thị trên giao diện (Đồng bộ 100% với Sidebar Menu)
     */
    public static function getFunctionalGroups(): array
    {
        return [
            self::GROUP_CONTENT => [
                'title' => 'NỘI DUNG & TIN TỨC',
                'icon' => 'heroicon-m-newspaper',
                'badge' => '4 phân hệ',
                'description' => 'Bài viết, Danh mục bài viết, Tài nguyên ấn phẩm và Thư viện Media.',
            ],
            self::GROUP_BUSINESS => [
                'title' => 'DỊCH VỤ & KHÁCH HÀNG',
                'icon' => 'heroicon-m-presentation-chart-line',
                'badge' => '4 phân hệ',
                'description' => 'Dịch vụ & Giải pháp, Dự án tiêu biểu, Bảng giá dịch vụ và Khách hàng tiêu biểu.',
            ],
            self::GROUP_COMMUNICATION => [
                'title' => 'CHAT, CSKH & TUYỂN DỤNG',
                'icon' => 'heroicon-m-chat-bubble-left-right',
                'badge' => '7 phân hệ',
                'description' => 'Yêu cầu tư vấn, Hồ sơ ứng tuyển, Hộp thư trực tuyến, Khách online, Kịch bản tự động, Spam & AI Bot.',
            ],
            self::GROUP_SYSTEM => [
                'title' => 'CẤU HÌNH & HỆ THỐNG',
                'icon' => 'heroicon-m-cog-6-tooth',
                'badge' => 'Bảo mật cao',
                'description' => 'Cài đặt, Cấu hình Schema SEO, Menu Website, SEO 301, Đối tác, Tài khoản và Phân quyền.',
                'sensitive' => true,
            ],
            self::GROUP_DASHBOARD => [
                'title' => 'DASHBOARD & BÁO CÁO',
                'icon' => 'heroicon-m-squares-2x2',
                'badge' => '7 tiện ích',
                'description' => 'Các thẻ widget số liệu thống kê và tác vụ nhanh tại màn hình Dashboard.',
            ],
        ];
    }
}
