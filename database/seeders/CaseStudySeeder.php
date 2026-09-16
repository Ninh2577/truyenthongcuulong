<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseStudy;

class CaseStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $caseStudies = [
            [
                'title' => 'Hệ Thống ERP Quản Trị Doanh Nghiệp Nội Bộ',
                'slug' => 'he-thong-erp-quan-tri-doanh-nghiep',
                'client_name' => 'Truyền Thông Cửu Long',
                'group' => 'technology',
                'summary' => 'Hệ thống ERP xây dựng riêng cho Truyền Thông Cửu Long, số hóa toàn diện quy trình vận hành.',
                'thumbnail' => 'uploads/projects/erp-dashboard-clm.jpg',
                'featured' => true,
                'year' => '2026',
            ],
            [
                'title' => 'Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa',
                'slug' => 'ung-dung-quan-ly-phong-kham',
                'client_name' => 'Phòng Khám Gia Phước',
                'group' => 'technology',
                'summary' => 'Giải pháp số hóa toàn diện quy trình tiếp đón và quản lý khám chữa bệnh: đặt lịch trực tuyến, theo dõi hồ sơ.',
                'thumbnail' => 'uploads/projects/clinic-app-gia-phuoc.jpg',
                'featured' => true,
                'year' => '2025',
            ],
            [
                'title' => 'Chatbot Tư Vấn Khách Hàng Tự Động Đa Kênh',
                'slug' => 'chatbot-tu-van-khach-hang',
                'client_name' => 'Nhiều đối tác',
                'group' => 'technology',
                'summary' => 'Trợ lý số hóa thông minh tích hợp trực tiếp trên website, tự động giải đáp thắc mắc.',
                'thumbnail' => 'uploads/projects/chatbot-tu-van.jpg',
                'featured' => true,
                'year' => '2025',
            ],
            [
                'title' => 'Website Phòng Khám Đa Khoa Chuẩn WordPress',
                'slug' => 'website-phong-kham-da-khoa',
                'client_name' => 'Nha Khoa Nụ Cười',
                'group' => 'technology',
                'summary' => 'Hệ thống website y khoa chuẩn WordPress được tùy biến giao diện chuyên nghiệp.',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
                'featured' => true,
                'year' => '2024',
            ],
            [
                'title' => 'TVC Quảng Cáo Ngân Hàng Sacombank',
                'slug' => 'tvc-quang-cao-sacombank',
                'client_name' => 'Sacombank',
                'group' => 'media',
                'summary' => 'Sản xuất video TVC quảng cáo chuyên nghiệp cho chiến dịch thẻ tín dụng mới.',
                'thumbnail' => 'uploads/projects/sacombank-media-thumb.jpg',
                'video_url' => 'https://www.youtube.com/embed/nGvVhO2kDo8',
                'featured' => true,
                'year' => '2026',
            ],
            [
                'title' => 'Phim Doanh Nghiệp Hoya Lens',
                'slug' => 'phim-doanh-nghiep-hoya',
                'client_name' => 'Hoya Lens',
                'group' => 'media',
                'summary' => 'Video giới thiệu quy trình sản xuất tròng kính Nhật Bản.',
                'thumbnail' => 'uploads/projects/hoyalens-media-thumb.jpg',
                'video_url' => 'https://www.youtube.com/embed/dBFbsinzwNs',
                'featured' => true,
                'year' => '2025',
            ],
            [
                'title' => 'Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao',
                'slug' => 'tat-nien-kredivo-da-tiec-tri-an',
                'client_name' => 'Kredivo',
                'group' => 'media',
                'summary' => 'Bắt trọn những khoảnh khắc cảm xúc bùng nổ, visual lighting sân khấu hoành tráng và âm thanh stereo sống động trong đêm tiệc tất niên của fintech hàng đầu Đông Nam Á.',
                'thumbnail' => 'uploads/2024/01/tat-nien-kredivo-viet-nam-2023.jpg',
                'video_url' => 'https://www.youtube.com/embed/pwPRwTicUhI',
                'featured' => true,
                'year' => '2024',
            ],
            [
                'title' => 'RAKUS Việt Nam - Team Building & Gala Dinner Nha Trang',
                'slug' => 'rakus-viet-nam-team-building-nha-trang',
                'client_name' => 'RAKUS',
                'group' => 'media',
                'summary' => 'Ghi lại hành trình gắn kết văn hóa doanh nghiệp Nhật Bản với hình ảnh biển xanh cát trắng rực rỡ và hoạt động bãi biển nhiệt huyết của hơn 300 nhân sự IT.',
                'thumbnail' => 'uploads/2023/07/rakus-viet-nam-team-building-nha-trang-2023.jpg',
                'video_url' => 'https://www.youtube.com/embed/T9h_Jq_nNWU',
                'featured' => true,
                'year' => '2024',
            ]
        ];

        foreach ($caseStudies as $item) {
            CaseStudy::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
