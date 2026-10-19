<?php

namespace App\Services;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TemplateShowcaseController;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuRouteResolver
{
    /**
     * Resolve a path against registered menu items or common aliases.
     * Returns a Response or View if resolved, or null.
     */
    public static function resolve(string $path, Request $request = null)
    {
        $request = $request ?: request();
        $trimmed = trim($path, '/');
        if ($trimmed === '') {
            return null;
        }

        $withSlash = '/' . $trimmed;

        // 1. Tìm MenuItem trực tiếp khớp với URL (cả có / và không /)
        $menuItem = MenuItem::where(function ($q) use ($withSlash, $trimmed) {
            $q->where('url', $withSlash)
              ->orWhere('url', $trimmed)
              ->orWhere('url', 'like', "%{$withSlash}");
        })->first();

        if ($menuItem) {
            return static::dispatchMenuItem($menuItem, $request);
        }

        // 2. Nếu đường dẫn bắt đầu bằng dich-vu/..., bóc tách phần slug bên trong
        if (str_starts_with($trimmed, 'dich-vu/')) {
            $innerSlug = substr($trimmed, 8);
            $innerItem = MenuItem::where(function ($q) use ($innerSlug) {
                $q->where('url', '/' . $innerSlug)
                  ->orWhere('url', $innerSlug)
                  ->orWhere('url', '/dich-vu/' . $innerSlug)
                  ->orWhere('url', 'dich-vu/' . $innerSlug);
            })->first();

            if ($innerItem) {
                return static::dispatchMenuItem($innerItem, $request);
            }
        }

        return null;
    }

    /**
     * Thực thi Controller và trả về View tương ứng của MenuItem.
     */
    public static function dispatchMenuItem(MenuItem $item, Request $request)
    {
        $routeName = $item->route_name ?? null;

        // Tự động suy luận nếu route_name chưa được đặt
        if (!$routeName) {
            $routeName = static::deduceRouteName($item);
        }

        switch ($routeName) {
            case 'templates.index':
            case 'templates.mau_giao_dien':
                return app(TemplateShowcaseController::class)->index($request);

            case 'services.web-app':
                return app(ServiceController::class)->webApp();

            case 'services.ui-ux':
            case 'services.thiet-ke-ui-ux':
                return app(ServiceController::class)->uiUx();

            case 'services.marketing':
                return app(ServiceController::class)->marketing();

            case 'services.website-care':
                return app(ServiceController::class)->websiteCare();

            case 'services.event-photography':
                return app(ServiceController::class)->eventPhotography();

            case 'services.event-videography':
                return app(ServiceController::class)->eventVideography();

            case 'services.teambuilding-photography':
                return app(ServiceController::class)->teambuildingPhotography();

            case 'services.teambuilding-videography':
                return app(ServiceController::class)->teambuildingVideography();

            case 'services.flycam':
                return app(ServiceController::class)->flycam();

            case 'services.index':
                return app(ServiceController::class)->index();

            case 'pricing':
                return app(CompanyController::class)->pricing();

            case 'projects.index':
            case 'projects.website':
                return app(CaseStudyController::class)->index();

            case 'projects.media':
                return app(CaseStudyController::class)->media();

            case 'blog.index':
                return app(BlogController::class)->index($request);

            case 'clients':
                return app(CompanyController::class)->clients();

            case 'careers':
                return app(CompanyController::class)->careers();

            case 'profile':
                return app(ProfileController::class)->index();

            case 'contact':
                return app(ContactController::class)->index();

            case 'home':
                return app(HomeController::class)->index();

            default:
                // Nếu là một bài viết cụ thể
                $slug = trim($item->url, '/');
                $post = \App\Models\Post::where('slug', $slug)->first();
                if ($post) {
                    return app(BlogController::class)->show($post->slug);
                }
                return null;
        }
    }

    /**
     * Tự động nhận diện trang chức năng dựa theo ID hoặc Tiêu đề Menu.
     */
    public static function deduceRouteName(MenuItem $item): ?string
    {
        $id = $item->id;
        $title = mb_strtolower($item->title ?? '');

        // Khớp theo ID của các mục menu gốc
        $idMap = [
            1 => 'home',
            2 => 'services.index',
            3 => 'templates.index',
            4 => 'services.web-app',
            5 => 'services.ui-ux',
            6 => 'services.marketing',
            7 => 'services.website-care',
            8 => 'services.event-photography',
            9 => 'services.event-videography',
            10 => 'services.teambuilding-photography',
            11 => 'services.teambuilding-videography',
            12 => 'services.flycam',
            13 => 'projects.index',
            14 => 'projects.index',
            15 => 'projects.media',
            16 => 'blog.index',
            17 => 'profile',
            18 => 'clients',
            19 => 'careers',
            20 => 'profile',
            21 => 'contact',
        ];

        if (isset($idMap[$id])) {
            return $idMap[$id];
        }

        // Khớp theo từ khóa tiêu đề
        if (str_contains($title, 'giao diện') || str_contains($title, 'template') || (str_contains($title, 'website') && !str_contains($title, 'quản trị') && !str_contains($title, 'app'))) {
            return 'templates.index';
        }
        if (str_contains($title, 'web app') || str_contains($title, 'ứng dụng')) {
            return 'services.web-app';
        }
        if (str_contains($title, 'ui/ux') || str_contains($title, 'ui') || str_contains($title, 'ux')) {
            return 'services.ui-ux';
        }
        if (str_contains($title, 'seo') || str_contains($title, 'marketing')) {
            return 'services.marketing';
        }
        if (str_contains($title, 'quản trị') || str_contains($title, 'chăm sóc')) {
            return 'services.website-care';
        }
        if (str_contains($title, 'chụp ảnh sự kiện') || str_contains($title, 'chụp hình sự kiện')) {
            return 'services.event-photography';
        }
        if (str_contains($title, 'quay phim sự kiện') || str_contains($title, 'quay video sự kiện')) {
            return 'services.event-videography';
        }
        if (str_contains($title, 'chụp ảnh teambuilding') || str_contains($title, 'chụp hình teambuilding')) {
            return 'services.teambuilding-photography';
        }
        if (str_contains($title, 'quay phim teambuilding') || str_contains($title, 'quay video teambuilding')) {
            return 'services.teambuilding-videography';
        }
        if (str_contains($title, 'flycam')) {
            return 'services.flycam';
        }
        if (str_contains($title, 'bảng giá')) {
            return 'pricing';
        }
        if (str_contains($title, 'dự án') || str_contains($title, 'case study')) {
            return 'projects.index';
        }
        if (str_contains($title, 'khách hàng') || str_contains($title, 'đối tác')) {
            return 'clients';
        }
        if (str_contains($title, 'tuyển dụng')) {
            return 'careers';
        }
        if (str_contains($title, 'hồ sơ năng lực') || str_contains($title, 'về chúng tôi') || str_contains($title, 'giới thiệu')) {
            return 'profile';
        }
        if (str_contains($title, 'liên hệ')) {
            return 'contact';
        }
        if (str_contains($title, 'blog') || str_contains($title, 'tin tức') || str_contains($title, 'bài viết')) {
            return 'blog.index';
        }

        return null;
    }

    /**
     * Danh sách các trang chức năng hỗ trợ trong Admin.
     */
    public static function supportedRoutes(): array
    {
        return [
            '' => '-- Tự động nhận diện theo tên menu --',
            'templates.index' => 'Kho & Mẫu Giao Diện Website (Theme / Showcase)',
            'services.web-app' => 'Thiết Kế Web App & Website',
            'services.ui-ux' => 'Thiết Kế UI/UX Theo Yêu Cầu',
            'services.marketing' => 'Dịch Vụ SEO & Marketing Tổng Thể',
            'services.website-care' => 'Quản Trị & Chăm Sóc Website',
            'services.event-photography' => 'Chụp Ảnh Sự Kiện',
            'services.event-videography' => 'Quay Phim Sự Kiện',
            'services.teambuilding-photography' => 'Chụp Ảnh Teambuilding',
            'services.teambuilding-videography' => 'Quay Phim Teambuilding',
            'services.flycam' => 'Quay Chụp Flycam',
            'pricing' => 'Bảng Giá Dịch Vụ',
            'services.index' => 'Trang Tổng Hợp Tất Cả Dịch Vụ (/dich-vu)',
            'projects.index' => 'Trang Dự Án Tiêu Biểu (/du-an)',
            'projects.media' => 'Trang Dự Án Media (/du-an/media)',
            'blog.index' => 'Trang Blog & Tin Tức (/bai-viet)',
            'clients' => 'Trang Khách Hàng Tiêu Biểu (/khach-hang)',
            'careers' => 'Trang Tuyển Dụng (/tuyen-dung)',
            'profile' => 'Trang Hồ Sơ Năng Lực (/ho-so-nang-luc)',
            'contact' => 'Trang Liên Hệ (/lien-he)',
            'home' => 'Trang Chủ (/)',
        ];
    }
}
