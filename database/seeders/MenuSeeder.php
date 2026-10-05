<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $headerMenu = Menu::updateOrCreate(
            ['location' => 'header'],
            [
                'name' => 'Menu Chính',
                'is_active' => true,
            ]
        );

        // Clear existing items for this menu to avoid duplicates
        MenuItem::where('menu_id', $headerMenu->id)->delete();

        // 1. Trang chủ
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 1,
            'title' => 'Trang chủ',
            'url' => '/',
            'target' => '_self',
        ]);

        // 2. Dịch vụ (Chia làm 2 Cột: Cột 1 Website & Phần mềm, Cột 2 Media & Quay chụp)
        $services = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 2,
            'title' => 'Dịch Vụ',
            'url' => '/dich-vu',
            'target' => '_self',
        ]);

        // Cột 1: Website & Ứng dụng số
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 1,
            'title' => 'Thiết kế Website',
            'subtitle' => 'Website chuẩn SEO, tốc độ cao & tối ưu chuyển đổi',
            'url' => '/dich-vu/kho-giao-dien',
            'target' => '_self',
            'icon' => 'web',
            'icon_color' => 'text-amber-500',
            'badge_text' => '70+ Mẫu',
            'badge_color' => 'bg-amber-100 text-amber-800',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 2,
            'title' => 'Thiết kế Web App & Ứng Dụng Di Động',
            'subtitle' => 'Số hóa quy trình nghiệp vụ & phần mềm quản lý',
            'url' => '/dich-vu/web-app',
            'target' => '_self',
            'icon' => 'developer_board',
            'icon_color' => 'text-sky-600',
            'badge_text' => 'Core Tech',
            'badge_color' => 'bg-sky-500 text-white',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 3,
            'title' => 'Thiết kế UI/UX Theo Yêu Cầu',
            'subtitle' => 'Trải nghiệm người dùng tinh tế, chuẩn thương hiệu',
            'url' => '/dich-vu/web-app#ui-ux',
            'target' => '_self',
            'icon' => 'design_services',
            'icon_color' => 'text-purple-600',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 4,
            'title' => 'Dịch Vụ Seo Tổng Thể',
            'subtitle' => 'Technical SEO, từ khóa lên Top & tăng trưởng tự nhiên',
            'url' => '/dich-vu/marketing',
            'target' => '_self',
            'icon' => 'trending_up',
            'icon_color' => 'text-emerald-600',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 5,
            'title' => 'Quản Trị Website',
            'subtitle' => 'Bảo trì kỹ thuật, bảo mật, tối ưu tốc độ & backup',
            'url' => '/dich-vu/quan-tri-website',
            'target' => '_self',
            'icon' => 'settings_suggest',
            'icon_color' => 'text-indigo-600',
        ]);

        // Cột 2: Quay Chụp & Media
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 6,
            'title' => 'Chụp Ảnh Sự Kiện',
            'subtitle' => 'Hội nghị, hội thảo, khai trương & lễ kỷ niệm',
            'url' => '/dich-vu/media#chup-anh-su-kien',
            'target' => '_self',
            'icon' => 'photo_camera',
            'icon_color' => 'text-rose-500',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 7,
            'title' => 'Quay Phim Sự Kiện',
            'subtitle' => 'Phim tổng kết sự kiện, highlight & livestream chuyên nghiệp',
            'url' => '/dich-vu/media#quay-phim-su-kien',
            'target' => '_self',
            'icon' => 'videocam',
            'icon_color' => 'text-orange-500',
            'badge_text' => '4K UHD',
            'badge_color' => 'bg-orange-100 text-orange-800',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 8,
            'title' => 'Chụp Ảnh Teambuilding',
            'subtitle' => 'Ghi lại khoảnh khắc gắn kết, dã ngoại sôi nổi của doanh nghiệp',
            'url' => '/dich-vu/media#teambuilding',
            'target' => '_self',
            'icon' => 'diversity_3',
            'icon_color' => 'text-teal-600',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 9,
            'title' => 'Quay Phim Teambuilding',
            'subtitle' => 'Video recap tràn đầy năng lượng, cảm xúc & truyền lửa',
            'url' => '/dich-vu/media#quay-phim-teambuilding',
            'target' => '_self',
            'icon' => 'movie',
            'icon_color' => 'text-blue-500',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 10,
            'title' => 'Quay Chụp Flycam',
            'subtitle' => 'Góc nhìn toàn cảnh trên không mãn nhãn, độ nét 4K HDR',
            'url' => '/dich-vu/media#flycam',
            'target' => '_self',
            'icon' => 'flight',
            'icon_color' => 'text-amber-600',
            'badge_text' => 'Flycam',
            'badge_color' => 'bg-amber-100 text-amber-800',
        ]);

        // 3. Dự Án (Chia 2: Website, Media)
        $projects = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 3,
            'title' => 'Dự Án',
            'url' => '/du-an',
            'target' => '_self',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $projects->id,
            'order' => 1,
            'title' => 'Website',
            'subtitle' => 'Dự án website, phần mềm & ứng dụng số',
            'url' => '/du-an?group=technology',
            'target' => '_self',
            'icon' => 'laptop_mac',
            'icon_color' => 'text-sky-600',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $projects->id,
            'order' => 2,
            'title' => 'Media',
            'subtitle' => 'Dự án quay phim, chụp ảnh sự kiện & TVC doanh nghiệp',
            'url' => '/du-an?group=media',
            'target' => '_self',
            'icon' => 'video_camera_back',
            'icon_color' => 'text-orange-500',
        ]);

        // 4. Blog
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 4,
            'title' => 'Blog',
            'url' => '/bai-viet',
            'target' => '_self',
        ]);

        // 5. Về Chúng Tôi (Khách Hàng, Tuyển Dụng, Hồ Sơ Năng Lực)
        $about = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 5,
            'title' => 'Về Chúng Tôi',
            'url' => '/ve-chung-toi',
            'target' => '_self',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $about->id,
            'order' => 1,
            'title' => 'Khách Hàng',
            'subtitle' => 'Khách hàng & Đối tác đồng hành cùng Cửu Long',
            'url' => '/khach-hang',
            'target' => '_self',
            'icon' => 'workspace_premium',
            'icon_color' => 'text-amber-500',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $about->id,
            'order' => 2,
            'title' => 'Tuyển Dụng',
            'subtitle' => 'Cơ hội phát triển nghề nghiệp tại Cửu Long',
            'url' => '/tuyen-dung',
            'target' => '_self',
            'icon' => 'badge',
            'icon_color' => 'text-emerald-600',
            'badge_text' => 'Hiring',
            'badge_color' => 'bg-emerald-100 text-emerald-700',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $about->id,
            'order' => 3,
            'title' => 'Hồ Sơ Năng Lực',
            'subtitle' => 'CLM Company Profile & Năng lực công nghệ',
            'url' => '/ho-so-nang-luc',
            'target' => '_self',
            'icon' => 'menu_book',
            'icon_color' => 'text-sky-600',
        ]);

        // 6. Liên Hệ
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 6,
            'title' => 'Liên Hệ',
            'url' => '/lien-he',
            'target' => '_self',
        ]);
    }
}
