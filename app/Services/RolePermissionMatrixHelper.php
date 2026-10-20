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

    /**
     * Kiểm tra quyền có phải là quyền nhạy cảm không.
     */
    public static function isSensitivePermission(string $permissionKey): bool
    {
        if (str_contains($permissionKey, 'delete_any') ||
            str_contains($permissionKey, '_role') ||
            str_contains($permissionKey, '_user') ||
            $permissionKey === 'page_GeneralSettings' ||
            $permissionKey === 'page_SchemaSettings'
        ) {
            return true;
        }

        return false;
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
