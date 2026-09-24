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

        // 2. Về chúng tôi
        $about = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 2,
            'title' => 'Về chúng tôi',
            'url' => '/ve-chung-toi',
            'target' => '_self',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $about->id,
            'order' => 1,
            'title' => 'Câu chuyện thương hiệu',
            'url' => '/ve-chung-toi',
            'target' => '_self',
            'icon' => 'info',
            'icon_color' => 'text-primary',
            'subtitle' => 'Hành trình phát triển & Sứ mệnh',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $about->id,
            'order' => 2,
            'title' => 'Tuyển dụng',
            'url' => '/tuyen-dung',
            'target' => '_self',
            'icon' => 'badge',
            'icon_color' => 'text-emerald-600',
            'badge_text' => 'Hiring',
            'badge_color' => 'bg-emerald-100 text-emerald-700',
            'subtitle' => 'Cơ hội phát triển nghề nghiệp',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $about->id,
            'order' => 3,
            'title' => 'Đối tác chiến lược',
            'url' => '/doi-tac',
            'target' => '_self',
            'icon' => 'handshake',
            'icon_color' => 'text-sky-600',
            'subtitle' => 'Mạng lưới đối tác công nghệ & media',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $about->id,
            'order' => 4,
            'title' => 'Khách hàng tiêu biểu',
            'url' => '/khach-hang',
            'target' => '_self',
            'icon' => 'workspace_premium',
            'icon_color' => 'text-purple-600',
            'subtitle' => 'Doanh nghiệp đã tin tưởng hợp tác',
        ]);

        // 3. Giải pháp & Dịch vụ (Technology First Architecture)
        $services = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 3,
            'title' => 'Dịch vụ & Giải pháp',
            'url' => '/dich-vu',
            'target' => '_self',
        ]);

        // Tier 2 Technology (Priority 85%) - Listed First
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 1,
            'title' => 'Thiết kế & Lập trình Web-App',
            'subtitle' => 'Website & Hệ thống số chuyên sâu',
            'url' => '/dich-vu/web-app',
            'target' => '_self',
            'icon' => 'code',
            'icon_color' => 'text-sky-600',
            'badge_text' => 'Core Tech',
            'badge_color' => 'bg-sky-500 text-white',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 2,
            'title' => 'Kho Giao Diện Website Mẫu',
            'subtitle' => '39+ Mẫu website doanh nghiệp đa ngành',
            'url' => '/dich-vu/kho-giao-dien',
            'target' => '_self',
            'icon' => 'web',
            'icon_color' => 'text-amber-500',
            'badge_text' => '39+ Mẫu',
            'badge_color' => 'bg-amber-100 text-amber-800',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 3,
            'title' => 'Bảng Giá & Dự Toán Chi Phí',
            'subtitle' => 'Dự toán ngân sách Web/App & phần mềm',
            'url' => '/dich-vu/bang-gia',
            'target' => '_self',
            'icon' => 'payments',
            'icon_color' => 'text-teal-600',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 4,
            'title' => 'Tối Ưu SEO & Tăng Trưởng Số',
            'subtitle' => 'Technical SEO, Meta & Google Ads',
            'url' => '/dich-vu/marketing',
            'target' => '_self',
            'icon' => 'trending_up',
            'icon_color' => 'text-emerald-600',
        ]);

        // Tier 2 Media (Priority 15% - Creative Support) - Listed Second
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 5,
            'title' => 'Quay Phim Sự Kiện & TVC 4K',
            'subtitle' => 'TVC 4K & Phim giới thiệu doanh nghiệp',
            'url' => '/dich-vu/media',
            'target' => '_self',
            'icon' => 'videocam',
            'icon_color' => 'text-orange-500',
            'badge_text' => 'Media',
            'badge_color' => 'bg-slate-100 text-slate-600',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $services->id,
            'order' => 6,
            'title' => 'Booking Ekip Media',
            'subtitle' => 'Đặt lịch quay chụp sự kiện trực tiếp',
            'url' => '/dich-vu/booking',
            'target' => '_self',
            'icon' => 'event_available',
            'icon_color' => 'text-amber-500',
        ]);

        // 4. Dự án
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 4,
            'title' => 'Dự án',
            'url' => '/du-an',
            'target' => '_self',
        ]);

        // 5. Bài viết & Tin tức
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 5,
            'title' => 'Bài viết & Tin tức',
            'url' => '/bai-viet',
            'target' => '_self',
        ]);

        // 6. Tài nguyên
        $resources = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 6,
            'title' => 'Tài nguyên',
            'url' => '/tai-nguyen',
            'target' => '_self',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $resources->id,
            'order' => 1,
            'title' => 'Tài nguyên số (Download)',
            'subtitle' => 'LUTs màu, Ebook & Biểu mẫu',
            'url' => '/tai-nguyen',
            'target' => '_self',
            'icon' => 'download',
            'icon_color' => 'text-emerald-600',
        ]);

        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $resources->id,
            'order' => 2,
            'title' => 'Hồ sơ năng lực',
            'subtitle' => 'CLM Company Profile',
            'url' => '/ho-so-nang-luc',
            'target' => '_self',
            'icon' => 'menu_book',
            'icon_color' => 'text-sky-600',
        ]);

        // 7. Liên hệ
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => null,
            'order' => 7,
            'title' => 'Liên hệ',
            'url' => '/lien-he',
            'target' => '_self',
        ]);
    }
}
