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
                'title' => 'Website Phòng Khám Đa Khoa Chuẩn WordPress',
                'slug' => 'website-phong-kham-da-khoa',
                'client_name' => 'Nha Khoa Nụ Cười',
                'group' => 'technology',
                'summary' => 'Hệ thống website y khoa chuẩn WordPress được tùy biến giao diện chuyên nghiệp.',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
                'featured' => true,
                'year' => '2024',
                'meta_data' => [
                    'metrics' => [
                        ['value' => 'Chuẩn SEO', 'label' => 'Tối ưu', 'context' => 'Tiếp cận khách hàng tự nhiên'],
                        ['value' => 'Y khoa', 'label' => 'Giao diện', 'context' => 'Thiết kế chuyên nghiệp']
                    ]
                ],
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
                'meta_data' => [
                    'metrics' => [
                        ['value' => 'TVC', 'label' => 'Định dạng', 'context' => 'Quảng cáo chuyên nghiệp'],
                        ['value' => 'Mới', 'label' => 'Chiến dịch', 'context' => 'Thẻ tín dụng mở rộng']
                    ]
                ],
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
                'meta_data' => [
                    'metrics' => [
                        ['value' => 'Nhật Bản', 'label' => 'Tiêu chuẩn', 'context' => 'Quy trình sản xuất tròng kính']
                    ]
                ],
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
                'meta_data' => [
                    'metrics' => [
                        ['value' => 'Bùng nổ', 'label' => 'Cảm xúc', 'context' => 'Ghi lại mọi khoảnh khắc'],
                        ['value' => 'Hoành tráng', 'label' => 'Sân khấu', 'context' => 'Lighting & Âm thanh stereo']
                    ]
                ],
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
                'meta_data' => [
                    'metrics' => [
                        ['value' => '300+', 'label' => 'Nhân sự', 'context' => 'Gắn kết đội ngũ IT'],
                        ['value' => 'Biển xanh', 'label' => 'Nha Trang', 'context' => 'Hoạt động team nhiệt huyết']
                    ]
                ],
            ]
        ];

        foreach ($caseStudies as $item) {
            CaseStudy::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
