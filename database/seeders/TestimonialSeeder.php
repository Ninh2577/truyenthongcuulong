<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\CaseStudy;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::truncate();

        $data = [
            [
                'client_name' => 'Nguyễn Hoàng Nam',
                'client_title' => 'Giám Đốc Tiếp Thị & Truyền Thông, V-Group',
                'avatar' => null,
                'quote' => 'Chiến dịch TVC Nông Sản Xanh do Cửu Long thực hiện đã đạt hơn 65 triệu lượt xem, trở thành hiện tượng viral truyền thông và giúp thương hiệu chúng tôi phủ sóng toàn quốc.',
                'case_study_id' => 1,
            ],
            [
                'client_name' => 'Lê Thị Thu Trang',
                'client_title' => 'CEO & Founder, Chuỗi Thời Trang E-Commerce',
                'avatar' => null,
                'quote' => 'Hệ thống nền tảng số do Cửu Long TechLab phát triển chịu tải hơn 5 triệu lượt đọc và xử lý 50.000 đơn hàng mượt mà trong các đợt Mega Sale. Rất an tâm về độ ổn định.',
                'case_study_id' => 2,
            ],
            [
                'client_name' => 'Phạm Quốc Hưng',
                'client_title' => 'Giám Đốc Kinh Doanh, Mekong Real Group',
                'avatar' => null,
                'quote' => 'Mô hình tích hợp 3-in-1 của Cửu Long giúp chúng tôi tiết kiệm hơn 35% chi phí so với việc thuê rời rạc đơn vị quay phim và công ty chạy ads. ROAS thực tế vượt 340%.',
                'case_study_id' => null,
            ],
        ];

        foreach ($data as $d) {
            Testimonial::create($d);
        }

        // Cập nhật video_url và KPIs mẫu cho các Case Study
        CaseStudy::where('id', 1)->update([
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'views_metric' => '65M+',
            'reach_metric' => '12.8M',
            'conversion_metric' => '+320%',
        ]);

        CaseStudy::where('id', 2)->update([
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'views_metric' => '5M/Ngày',
            'reach_metric' => '99.99%',
            'conversion_metric' => '+280%',
        ]);
    }
}
