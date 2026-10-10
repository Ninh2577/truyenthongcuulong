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
                'title' => 'Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa',
                'slug' => 'ung-dung-quan-ly-phong-kham',
                'client_name' => 'Phòng Khám Gia Phước',
                'group' => 'technology',
                'summary' => 'Xây dựng hệ thống Web App quản trị y tế tập trung, tối ưu quy trình đặt lịch trực tuyến và quản lý hồ sơ an toàn.',
                'thumbnail' => 'uploads/projects/clinic-app-mockup.jpg',
                'featured' => true,
                'year' => '2024',
                'order' => 1,
                'meta_data' => [
                    'problem' => 'Tiếp nhận bệnh nhân và quản lý lịch khám qua nhiều kênh thủ công, khó tra cứu lịch sử bệnh án.',
                    'solution' => 'Xây dựng Web App đặt lịch khám bệnh trực tuyến kết hợp module quản lý hồ sơ nội bộ cho bác sĩ và lễ tân.',
                    'tech_stack' => 'PHP, Laravel, React, Node.js, MySQL, REST API',
                    'result' => 'Cổng đặt lịch trực tuyến, giao diện quản trị phòng khám, bàn giao toàn bộ mã nguồn và tài liệu vận hành.',
                    'metrics' => [
                        ['value' => 'Web-App', 'label' => 'Kiến trúc', 'context' => 'Quản trị y tế số hóa'],
                        ['value' => 'Bảo mật', 'label' => 'Hồ sơ', 'context' => 'Phân quyền đa tầng']
                    ]
                ],
            ],
            [
                'title' => 'Website Phòng Khám Đa Khoa Gia Phước Chuẩn WordPress',
                'slug' => 'website-phong-kham-da-khoa',
                'client_name' => 'Nha Khoa Nụ Cười',
                'group' => 'technology',
                'summary' => 'Hệ thống website y khoa chuẩn WordPress được tùy biến giao diện chuyên nghiệp, chuẩn SEO On-page.',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
                'featured' => true,
                'year' => '2024',
                'order' => 2,
                'meta_data' => [
                    'problem' => 'Doanh nghiệp y khoa cần hiện diện thương hiệu uy tín, tải trang nhanh và chuẩn SEO y tế địa phương.',
                    'solution' => 'Thiết kế và triển khai website y khoa chuẩn WordPress tùy biến, tối ưu cấu trúc Technical SEO và luồng đặt hẹn.',
                    'tech_stack' => 'WordPress, PHP, MySQL, Technical SEO, Schema Y Khoa',
                    'result' => 'Website WordPress chuẩn SEO vận hành ổn định, thông tin minh bạch và đạt chuẩn kỹ thuật Google.',
                    'metrics' => [
                        ['value' => 'Chuẩn SEO', 'label' => 'Tối ưu', 'context' => 'Tiếp cận khách hàng tự nhiên'],
                        ['value' => 'Y khoa', 'label' => 'Giao diện', 'context' => 'Thiết kế chuyên nghiệp']
                    ]
                ],
            ],
            [
                'title' => 'Hệ Thống ERP Truyền Thông Cửu Long',
                'slug' => 'he-thong-erp-truyen-thong-cuu-long',
                'client_name' => 'Truyền Thông Cửu Long',
                'group' => 'technology',
                'summary' => 'Hệ thống phần mềm quản trị doanh nghiệp ERP tổng thể, tối ưu vận hành nhân sự, dự án truyền thông và tài chính.',
                'thumbnail' => 'images/webapp/webapp_project_3_management.png',
                'featured' => true,
                'year' => '2024',
                'order' => 3,
                'meta_data' => [
                    'problem' => 'Doanh nghiệp truyền thông cần hệ thống quản trị tập trung quy trình sản xuất media, nhân sự và tài chính.',
                    'solution' => 'Phát triển hệ thống ERP chuyên biệt trên nền tảng Laravel hiện đại, bảo mật cao và tự động hóa điều phối dự án.',
                    'tech_stack' => 'PHP, Laravel, MySQL, Vue.js, REST API, Tailwind CSS',
                    'result' => 'Hệ thống ERP vận hành trơn tru, số hóa 100% quy trình nghiệp vụ và báo cáo tài chính thời gian thực.',
                    'metrics' => [
                        ['value' => 'ERP', 'label' => 'Mô hình', 'context' => 'Quản trị tổng thể'],
                        ['value' => 'Tự động', 'label' => 'Vận hành', 'context' => 'Số hóa quy trình']
                    ]
                ],
            ],
            [
                'title' => 'Website Y Khoa Phòng Khám Đa Khoa Gia Phước',
                'slug' => 'website-da-khoa-gia-phuoc',
                'client_name' => 'Đa Khoa Gia Phước',
                'group' => 'technology',
                'summary' => 'Thiết kế website y tế đa khoa chuẩn WordPress, cấu trúc chuyên khoa bài bản và chuẩn SEO.',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
                'featured' => false,
                'year' => '2024',
                'order' => 4,
                'meta_data' => [
                    'problem' => 'Cần cổng thông tin y tế chuyên sâu, giới thiệu chi tiết các khoa điều trị và bảng giá dịch vụ minh bạch.',
                    'solution' => 'Triển khai website trên nền tảng WordPress tùy biến, cấu trúc danh mục y khoa chuẩn mực và tối ưu trải nghiệm đọc trên di động.',
                    'tech_stack' => 'WordPress, PHP, MySQL, Technical SEO',
                    'result' => 'Website hoạt động ổn định, dễ dàng cập nhật tin tức y khoa và tiếp nhận tương tác của bệnh nhân.',
                    'metrics' => [
                        ['value' => 'WordPress', 'label' => 'Nền tảng', 'context' => 'Dễ quản trị CMS'],
                        ['value' => 'Y tế', 'label' => 'Chuẩn hóa', 'context' => 'Cấu trúc chuyên khoa']
                    ]
                ],
            ],
            [
                'title' => 'Website Phòng Khám Chuyên Khoa Gia Phước',
                'slug' => 'website-phong-kham-gia-phuoc',
                'client_name' => 'Phòng Khám Gia Phước',
                'group' => 'technology',
                'summary' => 'Website giới thiệu dịch vụ khám chữa bệnh chất lượng cao cho Phòng Khám Gia Phước bằng WordPress.',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
                'featured' => false,
                'year' => '2024',
                'order' => 5,
                'meta_data' => [
                    'problem' => 'Cần trang giới thiệu phòng khám hiện đại, làm nổi bật đội ngũ bác sĩ chuyên khoa và trang thiết bị y tế tiên tiến.',
                    'solution' => 'Xây dựng website chuẩn WordPress với giao diện y tế trang nhã, tích hợp nút gọi khẩn cấp và form tư vấn trực tuyến.',
                    'tech_stack' => 'WordPress, PHP, MySQL',
                    'result' => 'Giao diện chuyên nghiệp, tăng độ tin cậy thương hiệu y tế tại khu vực Đồng bằng sông Cửu Long.',
                    'metrics' => [
                        ['value' => 'WordPress', 'label' => 'CMS', 'context' => 'Tùy biến cao cấp'],
                        ['value' => 'Tin cậy', 'label' => 'Nhận diện', 'context' => 'Đội ngũ bác sĩ']
                    ]
                ],
            ],
            [
                'title' => 'Website Blog & Văn Hóa Du Lịch Tiêu Dao Tử',
                'slug' => 'website-tieu-dao-tu',
                'client_name' => 'Tiêu Dao Tử',
                'group' => 'technology',
                'summary' => 'Website nội dung và blog du lịch, văn hóa trải nghiệm xây dựng trên nền tảng WordPress chuẩn SEO.',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
                'featured' => false,
                'year' => '2024',
                'order' => 6,
                'meta_data' => [
                    'problem' => 'Khối lượng bài viết và hình ảnh phong phú cần hệ thống quản trị nội dung linh hoạt, tốc độ tải nhanh khi lượng truy cập cao.',
                    'solution' => 'Triển khai website WordPress với theme tùy biến tinh gọn, tối ưu bộ nhớ đệm (caching), nén ảnh WebP tự động và chuẩn SEO Google.',
                    'tech_stack' => 'WordPress, PHP, MySQL, Advanced SEO',
                    'result' => 'Trang web có tốc độ tải nhanh, hiển thị đẹp mắt trên mọi thiết bị, thu hút độc giả văn hóa du lịch.',
                    'metrics' => [
                        ['value' => 'WordPress', 'label' => 'Nền tảng', 'context' => 'Quản trị nội dung'],
                        ['value' => 'Tối ưu', 'label' => 'Tốc độ', 'context' => 'Trải nghiệm đọc mượt mà']
                    ]
                ],
            ],
            [
                'title' => 'Website Tui Là Người Miền Tây',
                'slug' => 'website-tui-la-nguoi-mien-tay',
                'client_name' => 'Tui Là Người Miền Tây',
                'group' => 'technology',
                'summary' => 'Nền tảng truyền thông cộng đồng và chia sẻ nét đẹp văn hóa, ẩm thực miền Tây trên WordPress.',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
                'featured' => false,
                'year' => '2024',
                'order' => 7,
                'meta_data' => [
                    'problem' => 'Cộng đồng văn hóa miền Tây cần kênh truyền thông chính thống, kết nối mạng xã hội và khả năng phục vụ lưu lượng truy cập lớn.',
                    'solution' => 'Xây dựng website trên WordPress với cơ chế cache mạnh mẽ, tích hợp chia sẻ đa kênh mạng xã hội và giao diện thân thiện, gần gũi.',
                    'tech_stack' => 'WordPress, PHP, MySQL, Caching System',
                    'result' => 'Cổng thông tin văn hóa hoạt động bền bỉ, nhận diện thương hiệu miền Tây lan tỏa rộng rãi.',
                    'metrics' => [
                        ['value' => 'WordPress', 'label' => 'Hệ thống', 'context' => 'Cộng đồng miền Tây'],
                        ['value' => 'Lan tỏa', 'label' => 'Truyền thông', 'context' => 'Đa kênh tương tác']
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
                'order' => 8,
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
                'order' => 9,
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
                'order' => 10,
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
                'order' => 11,
                'meta_data' => [
                    'metrics' => [
                        ['value' => '300+', 'label' => 'Nhân sự', 'context' => 'Gắn kết đội ngũ IT'],
                        ['value' => 'Biển xanh', 'label' => 'Nha Trang', 'context' => 'Hoạt động team nhiệt huyết']
                    ]
                ],
            ],
            [
                'title' => 'Website Du Lịch Long Trekking',
                'slug' => 'website-du-lich-long-trekking',
                'client_name' => 'Long Trekking',
                'group' => 'technology',
                'summary' => 'Website du lịch với giao diện hiện đại, tối ưu trải nghiệm người dùng và đặt tour trực tuyến.',
                'thumbnail' => 'uploads/projects/long-trekking-mockup.jpg',
                'featured' => true,
                'year' => '2024',
                'order' => 5,
                'meta_data' => [
                    'problem' => 'Cần cổng thông tin tour du lịch mạo hiểm, tối ưu tốc độ và tiện ích đăng ký khám phá trực tuyến.',
                    'solution' => 'Thiết kế website du lịch trekking hiện đại, giao diện giàu cảm xúc, chuẩn SEO và tích hợp cổng liên hệ tour.',
                    'tech_stack' => 'PHP, Laravel, Tailwind CSS, Responsive Design',
                    'result' => 'Hệ thống vận hành trơn tru, gia tăng trải nghiệm người dùng đặt tour khám phá thiên nhiên.',
                    'metrics' => [
                        ['value' => 'Web App', 'label' => 'Mô hình', 'context' => 'Đặt tour thông minh'],
                        ['value' => 'Trải nghiệm', 'label' => 'Giao diện', 'context' => 'Tương thích mọi thiết bị']
                    ]
                ],
            ]
        ];

        foreach ($caseStudies as $item) {
            CaseStudy::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
