<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('case_studies')) {
            return;
        }

        $projects = [
            [
                'title' => 'Tôi là Người Miền Tây',
                'slug' => 'website-tui-la-nguoi-mien-tay',
                'client_name' => 'Tui Là Người Miền Tây',
                'group' => 'technology',
                'summary' => 'Website du lịch khám phá và lan tỏa nét đẹp văn hóa miền Tây sông nước với giao diện hiện đại, thân thiện người dùng.',
                'thumbnail' => 'images/projects/website/du-an-tui-la-nguoi-mien-tay.png',
                'featured' => true,
                'year' => '2024',
                'order' => 1,
                'meta_data' => json_encode([
                    'category_name' => 'Du lịch',
                    'category_slug' => 'du-lich',
                    'badge_class' => 'bg-orange-50 text-[#ff5400] border-orange-200/80',
                    'domain' => 'tuilanguoimientay.vn',
                    'demo_url' => 'https://tuilanguoimientay.vn',
                    'tech_stack' => 'WordPress, PHP, MySQL, Caching System',
                    'features' => [
                        'Cổng thông tin văn hóa & du lịch miền Tây',
                        'Tối ưu tốc độ tải trang Core Web Vitals',
                        'Tích hợp bản đồ địa điểm & mạng xã hội',
                        'Giao diện tương thích 100% thiết bị di động',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cửu Long Camping',
                'slug' => 'website-cuu-long-camping',
                'client_name' => 'Cửu Long Camping & Glamping',
                'group' => 'technology',
                'summary' => 'Website đặt chỗ cắm trại, trải nghiệm thiên nhiên sinh thái với hệ thống booking và thanh toán trực tuyến.',
                'thumbnail' => 'images/projects/website/du-an-cuulongcamping.png',
                'featured' => true,
                'year' => '2024',
                'order' => 2,
                'meta_data' => json_encode([
                    'category_name' => 'Du lịch',
                    'category_slug' => 'du-lich',
                    'badge_class' => 'bg-orange-50 text-[#ff5400] border-orange-200/80',
                    'domain' => 'cuulongcamping.vn',
                    'demo_url' => 'https://cuulongcamping.vn',
                    'tech_stack' => 'Laravel, Tailwind CSS, Booking Engine, VNPay',
                    'features' => [
                        'Hệ thống đặt lịch cắm trại thông minh',
                        'Xem lịch trống theo thời gian thực',
                        'Tự động gửi email xác nhận đặt chỗ',
                        'Bộ sưu tập hình ảnh 4K sinh động',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Phòng Khám Đa Khoa Cần Thơ',
                'slug' => 'website-phong-kham-can-tho',
                'client_name' => 'Phòng Khám Đa Khoa Cần Thơ',
                'group' => 'technology',
                'summary' => 'Website giới thiệu dịch vụ y tế, đặt lịch khám online và tư vấn sức khỏe trực tuyến 24/7.',
                'thumbnail' => 'images/projects/website/du-an-phong-kham-can-tho.png',
                'featured' => true,
                'year' => '2024',
                'order' => 3,
                'meta_data' => json_encode([
                    'category_name' => 'Y tế',
                    'category_slug' => 'y-te',
                    'badge_class' => 'bg-sky-50 text-sky-600 border-sky-200/80',
                    'domain' => 'phongkhamcantho.com',
                    'demo_url' => 'https://phongkhamcantho.com',
                    'tech_stack' => 'PHP, Laravel, MySQL, Schema Y Tế, REST API',
                    'features' => [
                        'Đặt hẹn khám bệnh trực tuyến 24/7',
                        'Tra cứu thông tin bác sĩ & chuyên khoa',
                        'Tối ưu chuẩn SEO y tế địa phương',
                        'Bảo mật hồ sơ bệnh nhân an toàn',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Đa Khoa Cần Thơ - Sức Khỏe Cộng Đồng',
                'slug' => 'website-da-khoa-can-tho',
                'client_name' => 'Hệ Thống Y Tế Cần Thơ',
                'group' => 'technology',
                'summary' => 'Nền tảng y khoa chuyên sâu, hỗ trợ bệnh nhân tìm hiểu bệnh lý và nhận tư vấn nhanh chóng từ chuyên gia.',
                'thumbnail' => 'images/projects/website/du-an-da-khoa-can-tho.png',
                'featured' => true,
                'year' => '2024',
                'order' => 4,
                'meta_data' => json_encode([
                    'category_name' => 'Y tế',
                    'category_slug' => 'y-te',
                    'badge_class' => 'bg-sky-50 text-sky-600 border-sky-200/80',
                    'domain' => 'dakhoacantho.com',
                    'demo_url' => 'https://dakhoacantho.com',
                    'tech_stack' => 'Laravel, Tailwind CSS, Livewire, MySQL',
                    'features' => [
                        'Hệ thống tư vấn sức khỏe trực tuyến',
                        'Đăng ký khám & xét nghiệm định kỳ',
                        'Giao diện thân thiện chuẩn y khoa',
                        'Tối ưu tốc độ tải trang di động cực nhanh',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Phòng Khám Đa Khoa Gia Phước',
                'slug' => 'website-phong-kham-da-khoa-gia-phuoc',
                'client_name' => 'Phòng Khám Đa Khoa Gia Phước',
                'group' => 'technology',
                'summary' => 'Website phòng khám đa khoa hiện đại, cung cấp dịch vụ khám chữa bệnh chất lượng cao tại Cần Thơ.',
                'thumbnail' => 'images/projects/website/du-an-phong-kham-da-khoa-gia-phuoc.png',
                'featured' => true,
                'year' => '2024',
                'order' => 5,
                'meta_data' => json_encode([
                    'category_name' => 'Y tế',
                    'category_slug' => 'y-te',
                    'badge_class' => 'bg-teal-50 text-teal-600 border-teal-200/80',
                    'domain' => 'phongkhamgiaphuoc.com',
                    'demo_url' => 'https://phongkhamgiaphuoc.com',
                    'tech_stack' => 'Laravel, Vue.js, Tailwind CSS, Medical Schema',
                    'features' => [
                        'Giới thiệu đội ngũ y bác sĩ đầu ngành',
                        'Cổng tiếp nhận và phân luồng bệnh nhân',
                        'Tích hợp số hotline & tư vấn Zalo tức thì',
                        'Chuẩn SEO chuyên sâu ngành y dược',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Đa Khoa Gia Phước - Cổng Thông Tin Y Tế',
                'slug' => 'website-da-khoa-gia-phuoc',
                'client_name' => 'Đa Khoa Gia Phước',
                'group' => 'technology',
                'summary' => 'Trang thông tin chuyên khoa, cẩm nang sức khỏe và giải đáp thắc mắc người bệnh uy tín.',
                'thumbnail' => 'images/projects/website/du-an-da-khoa-gia-phuoc.png',
                'featured' => true,
                'year' => '2024',
                'order' => 6,
                'meta_data' => json_encode([
                    'category_name' => 'Y tế',
                    'category_slug' => 'y-te',
                    'badge_class' => 'bg-teal-50 text-teal-600 border-teal-200/80',
                    'domain' => 'dakhoagiaphuoc.vn',
                    'demo_url' => 'https://dakhoagiaphuoc.vn',
                    'tech_stack' => 'WordPress, PHP, MySQL, Technical SEO',
                    'features' => [
                        'Cẩm nang bệnh lý & hướng dẫn chăm sóc',
                        'Bảng thông tin dịch vụ khám chữa bệnh',
                        'Đặt lịch hẹn tái khám online tiện lợi',
                        'Hỗ trợ đa nền tảng điện thoại và máy tính',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Giặt Ủi Công Nghiệp 365',
                'slug' => 'website-giat-ui-cong-nghiep-365',
                'client_name' => 'Giặt Ủi Công Nghiệp 365',
                'group' => 'technology',
                'summary' => 'Website giới thiệu giải pháp giặt ủi công nghiệp cao cấp cho khách sạn, nhà hàng, bệnh viện và resort.',
                'thumbnail' => 'images/projects/website/du-an-giat-ui-cong-nghiep-365.png',
                'featured' => true,
                'year' => '2024',
                'order' => 7,
                'meta_data' => json_encode([
                    'category_name' => 'Dịch vụ',
                    'category_slug' => 'dich-vu',
                    'badge_class' => 'bg-blue-50 text-blue-600 border-blue-200/80',
                    'domain' => 'giatuicongnghiep365.com',
                    'demo_url' => 'https://giatuicongnghiep365.com',
                    'tech_stack' => 'Laravel, Tailwind CSS, Lead Engine, SEO',
                    'features' => [
                        'Giới thiệu quy trình giặt ủi công nghiệp',
                        'Dự toán chi phí giặt sấy theo số lượng',
                        'Biểu mẫu yêu cầu báo giá doanh nghiệp B2B',
                        'Giao diện trực quan, cam kết giao nhận 24/7',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tiêu Dao Tự',
                'slug' => 'website-tieu-dao-tu',
                'client_name' => 'Tiêu Dao Tự',
                'group' => 'technology',
                'summary' => 'Website thông tin văn hóa, tâm linh và kiến trúc tự viện truyền thống, lan tỏa những giá trị bình an.',
                'thumbnail' => 'images/projects/website/du-an-tieu-dao-tu.png',
                'featured' => true,
                'year' => '2024',
                'order' => 8,
                'meta_data' => json_encode([
                    'category_name' => 'Khác',
                    'category_slug' => 'khac',
                    'badge_class' => 'bg-amber-50 text-amber-700 border-amber-200/80',
                    'domain' => 'tieudaotu.com',
                    'demo_url' => 'https://tieudaotu.com',
                    'tech_stack' => 'PHP, Modern UI/UX, Lightbox Gallery, Audio Player',
                    'features' => [
                        'Không gian kiến trúc thanh tịnh, trang nghiêm',
                        'Bộ sưu tập hình ảnh & hoạt động thiện nguyện',
                        'Tích hợp phát bài giảng và thông bạch',
                        'Tương thích mượt mà trên mọi thiết bị di động',
                    ],
                    'show_on_pages' => ['home', 'web-app'],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $allowedSlugs = collect($projects)->pluck('slug')->toArray();
        DB::table('case_studies')->whereNotIn('slug', $allowedSlugs)->delete();

        // 1. Đồng bộ / Cập nhật đúng 8 dự án website thực tế
        foreach ($projects as $proj) {
            DB::table('case_studies')->updateOrInsert(
                ['slug' => $proj['slug']],
                $proj
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down migration
    }
};
