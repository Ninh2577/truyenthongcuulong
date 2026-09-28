<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TemplateShowcaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure master template-website category exists
        $templateCat = Category::firstOrCreate(
            ['slug' => 'template-website'],
            [
                'name' => 'Template Website',
                'pillar_group' => 'tech',
                'description' => 'Kho giao diện và nền tảng website doanh nghiệp dựng sẵn',
            ]
        );

        // 2. Ensure industry categories with is_industry_filter = true exist
        $industries = [
            ['name' => 'Bất Động Sản', 'slug' => 'bat-dong-san', 'order' => 1],
            ['name' => 'Xây Dựng & Kiến Trúc', 'slug' => 'xay-dung', 'order' => 2],
            ['name' => 'Doanh Nghiệp & Dịch Vụ', 'slug' => 'doanh-nghiep', 'order' => 3],
            ['name' => 'Công Nghệ & Phần Mềm', 'slug' => 'cong-nghe', 'order' => 4],
            ['name' => 'Nhà Hàng & F&B', 'slug' => 'nha-hang', 'order' => 5],
            ['name' => 'Khách Sạn & Du Lịch', 'slug' => 'du-lich', 'order' => 6],
            ['name' => 'Y Tế & Nha Khoa', 'slug' => 'y-te', 'order' => 7],
            ['name' => 'Giáo Dục & Đào Tạo', 'slug' => 'giao-duc', 'order' => 8],
            ['name' => 'Thời Trang & Mỹ Phẩm', 'slug' => 'thoi-trang', 'order' => 9],
            ['name' => 'Spa & Thẩm Mỹ', 'slug' => 'spa-lam-dep', 'order' => 10],
            ['name' => 'Bán Lẻ & E-Commerce', 'slug' => 'ban-le', 'order' => 11],
            ['name' => 'Luật & Tài Chính', 'slug' => 'tai-chinh', 'order' => 12],
            ['name' => 'Ô Tô & Vận Tải', 'slug' => 'o-to', 'order' => 13],
            ['name' => 'Nông Nghiệp & Thực Phẩm', 'slug' => 'nong-nghiep', 'order' => 14],
        ];

        foreach ($industries as $ind) {
            Category::updateOrCreate(
                ['slug' => $ind['slug']],
                [
                    'name' => $ind['name'],
                    'is_industry_filter' => true,
                    'display_order' => $ind['order'],
                    'pillar_group' => 'tech',
                ]
            );
        }

        // 3. 68 new high-end website templates across all industries (Combining with 39 existing = 107 templates)
        $newTemplates = [
            // --- BẤT ĐỘNG SẢN & KIẾN TRÚC ---
            [
                'title' => 'Mẫu website Bất Động Sản VinLand Luxury',
                'slug' => 'mau-website-bat-dong-san-vinland-luxury',
                'summary' => 'Nền tảng giới thiệu dự án cao cấp, biệt thự nghỉ dưỡng với bản đồ 360 độ, layout mặt bằng và form đăng ký tư vấn bảo mật.',
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                'industry' => 'bat-dong-san',
            ],
            [
                'title' => 'Mẫu website Sàn Giao Dịch Nhà Đất MetroLand',
                'slug' => 'mau-website-san-giao-dich-nha-dat-metroland',
                'summary' => 'Hệ thống tìm kiếm bất động sản theo quận huyện, mức giá và diện tích. Tối ưu tải nhanh cho hàng nghìn tin đăng.',
                'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80',
                'industry' => 'bat-dong-san',
            ],
            [
                'title' => 'Mẫu website Căn Hộ Chung Cư GreenSky Tower',
                'slug' => 'mau-website-can-ho-chung-cu-greensky-tower',
                'summary' => 'Landing page dự án chung cư xanh với bảng tính lãi vay trả góp, thư viện ảnh 4K và tiến độ xây dựng trực quan.',
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=800&q=80',
                'industry' => 'bat-dong-san',
            ],
            [
                'title' => 'Mẫu website Thiết Kế Kiến Trúc & Nội Thất NordicHome',
                'slug' => 'mau-website-thiet-ke-kien-truc-noi-that-nordichome',
                'summary' => 'Showcase dự án thiết kế nội thất phong cách Bắc Âu tối giản, tích hợp báo giá theo m2 tự động.',
                'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=800&q=80',
                'industry' => 'xay-dung',
            ],
            [
                'title' => 'Mẫu website Tổng Thầu Xây Dựng An Phát Cons',
                'slug' => 'mau-website-tong-thau-xay-dung-an-phat-cons',
                'summary' => 'Website profile công ty xây dựng dân dụng & công nghiệp với hồ sơ năng lực tải về, danh mục công trình tiêu biểu.',
                'image' => 'https://images.unsplash.com/photo-1541888946425-d0fbb186156f?auto=format&fit=crop&w=800&q=80',
                'industry' => 'xay-dung',
            ],
            [
                'title' => 'Mẫu website Xây Dựng & Trang Trí Ngoại Thất Landscape Pro',
                'slug' => 'mau-website-xay-dung-ngoai-that-landscape-pro',
                'summary' => 'Giao diện chuyên thiết kế cảnh quan sân vườn, hồ bơi và khu nghỉ dưỡng sinh thái cao cấp.',
                'image' => 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=800&q=80',
                'industry' => 'xay-dung',
            ],

            // --- DOANH NGHIỆP & DỊCH VỤ B2B ---
            [
                'title' => 'Mẫu website Tập Đoàn Đa Ngành Apex Holdings',
                'slug' => 'mau-website-tap-doan-da-nganh-apex-holdings',
                'summary' => 'Thiết kế nhận diện tập đoàn uy tín, bố cục thông tin cổ đông, quan hệ nhà đầu tư và văn hóa doanh nghiệp chuẩn quốc tế.',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],
            [
                'title' => 'Mẫu website Tư Vấn Quản Trị Chiến Lược V-Consulting',
                'slug' => 'mau-website-tu-van-quan-tri-chien-luoc-v-consulting',
                'summary' => 'Giao diện hiện đại cho công ty tư vấn tài chính, chuyển đổi số và tái cấu trúc vận hành với case study chuyên sâu.',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],
            [
                'title' => 'Mẫu website Dịch Vụ Logistics & Vận Tải Quốc Tế TransLog',
                'slug' => 'mau-website-dich-vu-logistics-quoc-te-translog',
                'summary' => 'Tích hợp tra cứu mã vận đơn bưu kiện, bảng cước tàu biển & hàng không, biểu mẫu yêu cầu báo giá hàng gom.',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],
            [
                'title' => 'Mẫu website Công Ty Dịch Vụ Bảo Vệ An Ninh Toàn Cầu',
                'slug' => 'mau-website-cong-ty-dich-vu-bao-ve-an-ninh-toan-cau',
                'summary' => 'Website giới thiệu giải pháp an ninh, vệ sĩ chuyên nghiệp và hệ thống camera giám sát bảo vệ mục tiêu cố định.',
                'image' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],
            [
                'title' => 'Mẫu website Văn Phòng Dịch Thuật Công Chứng MasterTranslate',
                'slug' => 'mau-website-van-phong-dich-thuat-cong-chung-mastertranslate',
                'summary' => 'Hệ thống gửi file tài liệu cần dịch trực tuyến, tính phí tạm tính tức thời theo số trang và ngôn ngữ đích.',
                'image' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],

            // --- CÔNG NGHỆ, PHẦN MỀM & SAAS ---
            [
                'title' => 'Mẫu website Công Ty Phần Mềm Kỹ Thuật Số DevCloud',
                'slug' => 'mau-website-cong-ty-phan-mem-ky-thuat-so-devcloud',
                'summary' => 'Giao diện công ty công nghệ phong cách B2B, làm nổi bật tech stack hiện đại, quy trình Agile và dịch vụ gia công IT.',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80',
                'industry' => 'cong-nghe',
            ],
            [
                'title' => 'Mẫu website Nền Tảng SaaS Quản Lý Nhân Sự HRNext',
                'slug' => 'mau-website-nen-tang-saas-quan-ly-nhan-su-hrnext',
                'summary' => 'Landing page phần mềm tính lương, chấm công và đánh giá KPI với nút Dùng thử 14 ngày, bảng so sánh tính năng trực quan.',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80',
                'industry' => 'cong-nghe',
            ],
            [
                'title' => 'Mẫu website Giải Pháp AI & Trí Tuệ Nhân Tạo SynapseAI',
                'slug' => 'mau-website-giai-phap-ai-tri-tue-nhan-tao-synapseai',
                'summary' => 'Thiết kế công nghệ cao với gam màu dark-mode sang trọng, hiệu ứng viền phát sáng và tài liệu API tương tác.',
                'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
                'industry' => 'cong-nghe',
            ],
            [
                'title' => 'Mẫu website An Ninh Mạng & Trung Tâm Dữ Liệu CyberGuard',
                'slug' => 'mau-website-an-ninh-mang-du-lieu-cyberguard',
                'summary' => 'Giải pháp phòng chống mã độc, chứng chỉ bảo mật ISO 27001 và dịch vụ kiểm thử thâm nhập hệ thống (Pentest).',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80',
                'industry' => 'cong-nghe',
            ],
            [
                'title' => 'Mẫu website Ứng Dụng Di Động SmartFin App',
                'slug' => 'mau-website-ung-dung-di-dong-smartfin-app',
                'summary' => 'Landing page quảng bá ứng dụng fintech cho cả iOS và Android với mã QR tải app và lời nhận xét thực tế từ người dùng.',
                'image' => 'https://images.unsplash.com/photo-1556742049-0a67e557224f?auto=format&fit=crop&w=800&q=80',
                'industry' => 'cong-nghe',
            ],

            // --- NHÀ HÀNG & F&B ---
            [
                'title' => 'Mẫu website Nhà Hàng Nhật Bản Sakura Sushi Bar',
                'slug' => 'mau-website-nha-hang-nhat-ban-sakura-sushi-bar',
                'summary' => 'Thực đơn điện tử hấp dẫn với hình ảnh món ăn chất lượng cao, tính năng đặt bàn trực tuyến và tích hợp Google Map.',
                'image' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nha-hang',
            ],
            [
                'title' => 'Mẫu website Nhà Hàng Âu Fine Dining The Prime Steak',
                'slug' => 'mau-website-nha-hang-au-fine-dining-the-prime-steak',
                'summary' => 'Bố cục tinh tế sang trọng chuẩn phong cách châu Âu, kết nối danh mục rượu vang thượng hạng và đặt bàn sự kiện VIP.',
                'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nha-hang',
            ],
            [
                'title' => 'Mẫu website Quán Cà Phê & Rang Xay Artisan Roast',
                'slug' => 'mau-website-quan-ca-phe-rang-xay-artisan-roast',
                'summary' => 'Phong cách cổ điển mộc mạc cho quán cà phê đặc sản, bán kèm hạt cà phê đóng gói và phụ kiện pha chế tại nhà.',
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nha-hang',
            ],
            [
                'title' => 'Mẫu website Tiệm Bánh Ngọt & Trà Chiều SweetDelight',
                'slug' => 'mau-website-tiem-banh-ngot-tra-chieu-sweetdelight',
                'summary' => 'Giao diện ngọt ngào dành cho tiệm bánh sinh nhật may đo, giỏ bánh quà tặng sự kiện và giao hàng trong ngày.',
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nha-hang',
            ],
            [
                'title' => 'Mẫu website Chuỗi Nhượng Quyền Trà Sữa BobaTea',
                'slug' => 'mau-website-chuoi-nhuong-quyen-tra-sua-bobatea',
                'summary' => 'Website năng động cho thương hiệu F&B trẻ trung, trang thông tin chính sách nhượng quyền và danh sách chi nhánh.',
                'image' => 'https://images.unsplash.com/photo-1558857563-b37fe78a9dd7?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nha-hang',
            ],

            // --- KHÁCH SẠN & DU LỊCH ---
            [
                'title' => 'Mẫu website Khu Nghỉ Dưỡng Sinh Thái Pearl Island Resort',
                'slug' => 'mau-website-khu-nghi-duong-pearl-island-resort',
                'summary' => 'Thiết kế nghỉ dưỡng biển đẳng cấp 5 sao, thư viện video cảnh quay flycam 4K và đặt phòng theo thời gian thực.',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',
                'industry' => 'du-lich',
            ],
            [
                'title' => 'Mẫu website Khách Sạn Boutique & Căn Hộ Phố Cổ Central Stay',
                'slug' => 'mau-website-khach-san-boutique-central-stay',
                'summary' => 'Tối ưu trải nghiệm đặt phòng trực tiếp không qua trung gian OTA, hiển thị tiện ích phòng và tour khám phá ẩm thực địa phương.',
                'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
                'industry' => 'du-lich',
            ],
            [
                'title' => 'Mẫu website Công Ty Lữ Hành & Tour Quốc Tế VietTraveler',
                'slug' => 'mau-website-cong-ty-lu-hanh-quoc-te-viettraveler',
                'summary' => 'Quản lý lịch trình tour, ngày khởi hành, đặt cọc giữ chỗ và hướng dẫn xin visa du lịch chi tiết.',
                'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=800&q=80',
                'industry' => 'du-lich',
            ],
            [
                'title' => 'Mẫu website Đặt Tour Trải Nghiệm Trekking & Cắm Trại WildCamp',
                'slug' => 'mau-website-dat-tour-trekking-cam-trai-wildcamp',
                'summary' => 'Dành cho đơn vị tổ chức du lịch khám phá mạo hiểm, dã ngoại cắm trại gia đình với checklist chuẩn bị hành trang.',
                'image' => 'https://images.unsplash.com/photo-1510312305653-8ed496efae75?auto=format&fit=crop&w=800&q=80',
                'industry' => 'du-lich',
            ],

            // --- Y TẾ & NHA KHOA ---
            [
                'title' => 'Mẫu website Bệnh Viện Đa Khoa Quốc Tế CarePlus',
                'slug' => 'mau-website-benh-vien-da-khoa-quoc-te-careplus',
                'summary' => 'Tra cứu danh sách bác sĩ chuyên khoa, đặt lịch khám theo giờ và tra cứu kết quả xét nghiệm bảo mật trực tuyến.',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80',
                'industry' => 'y-te',
            ],
            [
                'title' => 'Mẫu website Nha Khoa Thẩm Mỹ & Niềng Răng DentalCare',
                'slug' => 'mau-website-nha-khoa-tham-my-dentalcare',
                'summary' => 'Hình ảnh trước - sau khi điều trị chuẩn y khoa, bảng giá dịch vụ bọc răng sứ, niềng răng trong suốt và hotline khẩn cấp.',
                'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=800&q=80',
                'industry' => 'y-te',
            ],
            [
                'title' => 'Mẫu website Phòng Khám Nhi & Tiêm Chủng Trẻ Em BabyCare',
                'slug' => 'mau-website-phong-kham-nhi-tiem-chung-babycare',
                'summary' => 'Giao diện thân thiện cho phụ huynh, tra cứu lịch tiêm phòng chuẩn Bộ Y Tế và hướng dẫn sơ cấp cứu nhi khoa.',
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80',
                'industry' => 'y-te',
            ],
            [
                'title' => 'Mẫu website Hệ Thống Nhà Thuốc Chuẩn GPP PharmaMart',
                'slug' => 'mau-website-he-thong-nha-thuoc-gpp-pharmamart',
                'summary' => 'Tìm kiếm thuốc kê đơn và thực phẩm bảo vệ sức khỏe, dịch vụ tư vấn dược sĩ trực tuyến qua Zalo và giao thuốc nhanh.',
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80',
                'industry' => 'y-te',
            ],

            // --- GIÁO DỤC & ĐÀO TẠO ---
            [
                'title' => 'Mẫu website Trường Song Ngữ Quốc Tế Global Pathway',
                'slug' => 'mau-website-truong-song-ngu-quoc-te-global-pathway',
                'summary' => 'Giới thiệu lộ trình giáo dục liên cấp, chương trình tú tài quốc tế IB, biểu phí học phí và đăng ký tour tham quan trường.',
                'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=800&q=80',
                'industry' => 'giao-duc',
            ],
            [
                'title' => 'Mẫu website Trung Tâm Anh Ngữ & Luyện Thi IELTS Master',
                'slug' => 'mau-website-trung-tam-anh-ngu-ielts-master',
                'summary' => 'Kiểm tra trình độ đầu vào trực tuyến miễn phí, bảng vàng học viên đạt điểm cao và cam kết chuẩn đầu ra bằng văn bản.',
                'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
                'industry' => 'giao-duc',
            ],
            [
                'title' => 'Mẫu website Khóa Học Trực Tuyến & E-Learning EduPro',
                'slug' => 'mau-website-khoa-hoc-truc-tuyen-elearning-edupro',
                'summary' => 'Bán khóa học video theo chuyên đề, hệ thống quản trị bài tập và cấp chứng chỉ số cho học viên sau tốt nghiệp.',
                'image' => 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?auto=format&fit=crop&w=800&q=80',
                'industry' => 'giao-duc',
            ],
            [
                'title' => 'Mẫu website Học Viện Đào Tạo Lập Trình CodeAcademy',
                'slug' => 'mau-website-hoc-vien-lap-trinh-codeacademy',
                'summary' => 'Bootcamp đào tạo lập trình Fullstack, giới thiệu đồ án thực tế của sinh viên và kết nối việc làm với các công ty phần mềm.',
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80',
                'industry' => 'giao-duc',
            ],
            [
                'title' => 'Mẫu website Trường Mầm Non Tư Thục Hoa Mặt Trời',
                'slug' => 'mau-website-truong-mam-non-hoa-mat-troi',
                'summary' => 'Hình ảnh cơ sở vật chất thân thiện, chế độ dinh dưỡng theo tuần và nhật ký hoạt động vui học của các bé.',
                'image' => 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&w=800&q=80',
                'industry' => 'giao-duc',
            ],

            // --- THỜI TRANG & MỸ PHẨM ---
            [
                'title' => 'Mẫu website Thời Trang Thiết Kế Minimalist Studio',
                'slug' => 'mau-website-thoi-trang-thiet-ke-minimalist-studio',
                'summary' => 'Lookbook thời trang chuẩn quốc tế, bố cục phóng khoáng tôn vinh chất liệu vải và phom dáng trang phục thanh lịch.',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=800&q=80',
                'industry' => 'thoi-trang',
            ],
            [
                'title' => 'Mẫu website Thương Hiệu Thời Trang Công Sở Elegance Man',
                'slug' => 'mau-website-thoi-trang-cong-so-elegance-man',
                'summary' => 'Bộ sưu tập vest, sơ mi may đo cao cấp với bảng hướng dẫn chọn size chuẩn xác và chính sách đổi trả miễn phí.',
                'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=800&q=80',
                'industry' => 'thoi-trang',
            ],
            [
                'title' => 'Mẫu website Mỹ Phẩm Hữu Cơ & Chăm Sóc Da PureBotanics',
                'slug' => 'mau-website-my-pham-huu-co-purebotanics',
                'summary' => 'Thiết kế tone pastel tự nhiên, hiển thị chứng nhận nguồn gốc xuất xứ organic và bài viết tư vấn quy trình dưỡng da lành tính.',
                'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80',
                'industry' => 'thoi-trang',
            ],
            [
                'title' => 'Mẫu website Phụ Kiện Trang Sức Cao Cấp Aurelia Jewelry',
                'slug' => 'mau-website-phu-kien-trang-suc-aurelia-jewelry',
                'summary' => 'Zoom ảnh sản phẩm chi tiết sắc nét, giấy kiểm định kim cương đá quý và hộp quà sang trọng giao hàng toàn quốc.',
                'image' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?auto=format&fit=crop&w=800&q=80',
                'industry' => 'thoi-trang',
            ],
            [
                'title' => 'Mẫu website Kính Mắt Thời Trang & Đo Thị Lực VisionOptic',
                'slug' => 'mau-website-kinh-mat-thoi-trang-visionoptic',
                'summary' => 'Thử kính thực tế ảo trên khuôn mặt, đặt lịch đo mắt bằng máy móc tự động và tròng kính chống ánh sáng xanh.',
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=800&q=80',
                'industry' => 'thoi-trang',
            ],

            // --- SPA & THẨM MỸ ---
            [
                'title' => 'Mẫu website Viện Thẩm Mỹ Công Nghệ Cao BelleAura',
                'slug' => 'mau-website-vien-tham-my-belleaura',
                'summary' => 'Trình diễn công nghệ trẻ hóa da, đội ngũ thạc sĩ - bác sĩ tu nghiệp nước ngoài và tư vấn liệu trình 1:1 kín đáo.',
                'image' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80',
                'industry' => 'spa-lam-dep',
            ],
            [
                'title' => 'Mẫu website Spa Massage Trị Liệu Dưỡng Sinh Sen Zen',
                'slug' => 'mau-website-spa-duong-sinh-sen-zen',
                'summary' => 'Không gian thiền định yên ả, gói dịch vụ xông hơi đá muối, massage cổ vai gáy giải tỏa căng thẳng công việc.',
                'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
                'industry' => 'spa-lam-dep',
            ],
            [
                'title' => 'Mẫu website Salon Tóc & Chăm Sóc Da Đầu HairArt Studio',
                'slug' => 'mau-website-salon-toc-hairart-studio',
                'summary' => 'Bộ sưu tập mẫu tóc xu hướng, đặt thợ làm tóc ưng ý theo khung giờ và bán sản phẩm chăm sóc tóc độc quyền.',
                'image' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
                'industry' => 'spa-lam-dep',
            ],
            [
                'title' => 'Mẫu website Studio Make Up & Dịch Vụ Cưới GlamourBride',
                'slug' => 'mau-website-studio-makeup-cuoi-glamourbride',
                'summary' => 'Bộ ảnh cô dâu thực tế, bảng giá gói chụp phóng sự cưới và trang điểm tiệc tận nơi cho gia đình.',
                'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=800&q=80',
                'industry' => 'spa-lam-dep',
            ],

            // --- BÁN LẺ & E-COMMERCE ---
            [
                'title' => 'Mẫu website Siêu Thị Nông Sản & Trái Cây Nhập Khẩu FreshFarm',
                'slug' => 'mau-website-nong-san-trai-cay-nhap-khau-freshfarm',
                'summary' => 'Giao diện đặt mua thực phẩm hữu cơ, giỏ quà tết doanh nghiệp, tích hợp thanh toán thẻ và giao hàng nhanh 2h.',
                'image' => 'https://images.unsplash.com/photo-1610832958506-aa56368176cf?auto=format&fit=crop&w=800&q=80',
                'industry' => 'ban-le',
            ],
            [
                'title' => 'Mẫu website Cửa Hàng Thiết Bị Đồ Gia Dụng Thông Minh SmartHome',
                'slug' => 'mau-website-do-gia-dung-thong-minh-smarthome',
                'summary' => 'Catalog máy hút bụi robot, nồi chiên không dầu, lọc không khí với thông số kỹ thuật chi tiết và bảo hành điện tử.',
                'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=800&q=80',
                'industry' => 'ban-le',
            ],
            [
                'title' => 'Mẫu website Thế Giới Thể Thao & Đồ Dã Ngoại ProAthlete',
                'slug' => 'mau-website-the-gioi-the-thao-proathlete',
                'summary' => 'Trang thương mại điện tử chuyên dụng cụ tập gym, yoga, giày chạy bộ chính hãng với bộ lọc đa cấp thông minh.',
                'image' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?auto=format&fit=crop&w=800&q=80',
                'industry' => 'ban-le',
            ],
            [
                'title' => 'Mẫu website Đồ Chơi Thông Minh & Đồ Dùng Trẻ Em KidsWorld',
                'slug' => 'mau-website-do-choi-thong-minh-kidsworld',
                'summary' => 'Phân loại đồ chơi giáo dục theo độ tuổi của bé, cam kết nhựa an toàn không độc hại và gói quà miễn phí.',
                'image' => 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?auto=format&fit=crop&w=800&q=80',
                'industry' => 'ban-le',
            ],
            [
                'title' => 'Mẫu website Cửa Hàng Nhạc Cụ & Âm Thanh Harmony Music',
                'slug' => 'mau-website-cua-hang-nhac-cu-harmony-music',
                'summary' => 'Trưng bày đàn piano điện tử, guitar acoustic, loa kiểm âm với audio nghe thử chất âm chân thực từng cây đàn.',
                'image' => 'https://images.unsplash.com/photo-1511192336575-5a79af67a629?auto=format&fit=crop&w=800&q=80',
                'industry' => 'ban-le',
            ],

            // --- LUẬT, TÀI CHÍNH & KẾ TOÁN ---
            [
                'title' => 'Mẫu website Hãng Luật & Luật Sư Doanh Nghiệp LexJustice',
                'slug' => 'mau-website-hang-luat-luat-su-lexjustice',
                'summary' => 'Thiết kế uy quyền, chuẩn mực dành cho hãng luật chuyên tư vấn M&A, giải quyết tranh chấp thương mại và sở hữu trí tuệ.',
                'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=800&q=80',
                'industry' => 'tai-chinh',
            ],
            [
                'title' => 'Mẫu website Dịch Vụ Kế Toán Trọn Gói & Báo Cáo Thuế TaxSmart',
                'slug' => 'mau-website-dich-vu-ke-toan-thue-taxsmart',
                'summary' => 'Bảng giá dịch vụ kế toán rõ ràng theo quy mô doanh nghiệp, giải pháp quyết toán thuế doanh nghiệp an toàn.',
                'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80',
                'industry' => 'tai-chinh',
            ],
            [
                'title' => 'Mẫu website Công Ty Giám Định Bảo Hiểm & Thẩm Định Giá Valor',
                'slug' => 'mau-website-giam-dinh-tham-dinh-gia-valor',
                'summary' => 'Profile công ty thẩm định tài sản, nhà máy và dự án đầu tư với hồ sơ pháp lý minh bạch và danh mục khách hàng ngân hàng.',
                'image' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=800&q=80',
                'industry' => 'tai-chinh',
            ],
            [
                'title' => 'Mẫu website Quỹ Đầu Tư Khởi Nghiệp & Thiên Thần VentureGate',
                'slug' => 'mau-website-quy-dau-tu-khoi-nghiep-venturegate',
                'summary' => 'Giao diện nhận pitch deck từ các startup, công bố danh mục đầu tư (portfolio) và mạng lưới cố vấn kinh doanh.',
                'image' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&w=800&q=80',
                'industry' => 'tai-chinh',
            ],

            // --- Ô TÔ & VẬN TẢI ---
            [
                'title' => 'Mẫu website Showroom Ô Tô & Xe Hơi Nhập Khẩu AutoPrime',
                'slug' => 'mau-website-showroom-o-to-autoprime',
                'summary' => 'So sánh thông số kỹ thuật xe hơi, bảng tính tiền lăn bánh theo từng tỉnh thành và đăng ký lái thử xe tận nơi.',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80',
                'industry' => 'o-to',
            ],
            [
                'title' => 'Mẫu website Trung Tâm Sửa Chữa & Chăm Sóc Ô Tô ProDetailing',
                'slug' => 'mau-website-trung-tam-cham-soc-o-to-prodetailing',
                'summary' => 'Giới thiệu dịch vụ dán phim cách nhiệt, phủ ceramic, bảo dưỡng định kỳ với hệ thống đặt lịch tránh chờ đợi.',
                'image' => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=800&q=80',
                'industry' => 'o-to',
            ],
            [
                'title' => 'Mẫu website Dịch Vụ Cứu Hộ Giao Thông & Cho Thuê Xe Tự Lái QuickRent',
                'slug' => 'mau-website-cho-thue-xe-tu-lai-quickrent',
                'summary' => 'Lựa chọn dòng xe 4-7-16 chỗ theo ngày, bảng giá niêm yết không phụ phí ẩn và hỗ trợ cứu hộ khẩn cấp 24/7.',
                'image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80',
                'industry' => 'o-to',
            ],

            // --- NÔNG NGHIỆP & THỰC PHẨM SẠCH ---
            [
                'title' => 'Mẫu website Trang Trại Nông Nghiệp Công Nghệ Cao GreenFarm',
                'slug' => 'mau-website-nong-nghiep-cong-nghe-cao-greenfarm',
                'summary' => 'Quy trình trồng trọt khép kín chuẩn GlobalGAP, truy xuất nguồn gốc QR code từ trang trại đến bàn ăn người tiêu dùng.',
                'image' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nong-nghiep',
            ],
            [
                'title' => 'Mẫu website Xuất Khẩu Thủy Hải Sản ĐBSCL MekongSeafood',
                'slug' => 'mau-website-xuat-khau-thuy-hai-san-mekongseafood',
                'summary' => 'Website song ngữ xuất khẩu cá tra, tôm đông lạnh chuẩn HACCP, chứng nhận FDA Hoa Kỳ và hồ sơ kiểm định quốc tế.',
                'image' => 'https://images.unsplash.com/photo-1534483509719-3feaee7c30da?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nong-nghiep',
            ],
            [
                'title' => 'Mẫu website Hợp Tác Xã Gạo Đặc Sản & Nếp Thơm RiceGold',
                'slug' => 'mau-website-gao-dac-san-ricegold',
                'summary' => 'Quảng bá hạt ngọc trời Cửu Long ST25 đạt chuẩn, kết nối trực tiếp thương lái và đơn vị phân phối siêu thị toàn quốc.',
                'image' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nong-nghiep',
            ],
            [
                'title' => 'Mẫu website Trái Cây Sấy & Nông Sản Chế Biến EcoSnack',
                'slug' => 'mau-website-trai-cay-say-nong-san-ecosnack',
                'summary' => 'Thương mại hóa sản phẩm OCOP địa phương, đóng gói bao bì đẹp mắt làm quà tặng xuất khẩu sang các thị trường khó tính.',
                'image' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=800&q=80',
                'industry' => 'nong-nghiep',
            ],

            // --- BỔ SUNG THÊM CÁC USE-CASE ĐẶC THÙ NỔI BẬT ---
            [
                'title' => 'Mẫu website Studio Nhiếp Ảnh & Quay Phim Nghệ Thuật VisionLab',
                'slug' => 'mau-website-studio-nhiep-anh-visionlab',
                'summary' => 'Portfolio nghệ thuật trình diễn ảnh chân dung, phóng sự cưới và TVC doanh nghiệp định dạng sắc nét.',
                'image' => 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],
            [
                'title' => 'Mẫu website Trung Tâm Thể Dục & Huấn Luyện Viên Cá Nhân FitZone',
                'slug' => 'mau-website-trung-tam-the-duc-fitzone',
                'summary' => 'Đăng ký tập thử miễn phí, xem lịch tập của HLV cá nhân và thực đơn ăn uống khoa học cho người giảm mỡ tăng cơ.',
                'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80',
                'industry' => 'spa-lam-dep',
            ],
            [
                'title' => 'Mẫu website Cửa Hàng Thú Cưng & Khách Sạn Chó Mèo PetParadise',
                'slug' => 'mau-website-cua-hang-thu-cung-petparadise',
                'summary' => 'Dịch vụ spa tắm cắt tỉa lông thú cưng, khách sạn nội trú an toàn và thức ăn dinh dưỡng nhập khẩu.',
                'image' => 'https://images.unsplash.com/photo-1548767797-d8c844163c4c?auto=format&fit=crop&w=800&q=80',
                'industry' => 'ban-le',
            ],
            [
                'title' => 'Mẫu website Công Ty Tổ Chức Sự Kiện & Hội Nghị EventPro',
                'slug' => 'mau-website-cong-ty-to-chuc-su-kien-eventpro',
                'summary' => 'Trang chuyên tổ chức lễ khai trương, gala dinner, hội nghị khách hàng trọn gói từ âm thanh ánh sáng đến nhân sự.',
                'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],
            [
                'title' => 'Mẫu website Nhà Máy Sản Xuất Bao Bì Giấy Sinh Thái GreenPack',
                'slug' => 'mau-website-san-xuat-bao-bi-giay-greenpack',
                'summary' => 'Báo giá thùng carton, túi giấy kraft in ấn theo yêu cầu với dây chuyền tự động hóa công suất lớn cho nhà máy.',
                'image' => 'https://images.unsplash.com/photo-1530587191325-3db32d826c18?auto=format&fit=crop&w=800&q=80',
                'industry' => 'doanh-nghiep',
            ],
            [
                'title' => 'Mẫu website Cửa Hàng Bán Hoa Tươi & Điện Hoa 24h BloomFlorist',
                'slug' => 'mau-website-cua-hang-hoa-tuoi-bloomflorist',
                'summary' => 'Dịch vụ điện hoa chúc mừng khai trương, hoa sinh nhật và hoa chia buồn giao nhanh trong vòng 60 phút.',
                'image' => 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?auto=format&fit=crop&w=800&q=80',
                'industry' => 'ban-le',
            ],
            [
                'title' => 'Mẫu website Trung Tâm Ngoại Ngữ & Du Học Quốc Tế BridgeEdu',
                'slug' => 'mau-website-du-hoc-quoc-te-bridgeedu',
                'summary' => 'Cẩm nang học bổng các trường đại học tại Úc, Canada, Mỹ và dịch vụ hoàn thiện hồ sơ visa tỷ lệ đậu 98%.',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80',
                'industry' => 'giao-duc',
            ],
            [
                'title' => 'Mẫu website Nội Thất Văn Phòng & Co-Working Space WorkSmart',
                'slug' => 'mau-website-noi-that-van-phong-worksmart',
                'summary' => 'Bàn ghế công thái học (ergonomic), module bàn làm việc nhóm và thiết kế setup không gian văn phòng sáng tạo.',
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80',
                'industry' => 'xay-dung',
            ],
        ];

        foreach ($newTemplates as $tpl) {
            Post::updateOrCreate(
                ['slug' => $tpl['slug']],
                [
                    'category_id' => $templateCat->id,
                    'title' => $tpl['title'],
                    'summary' => $tpl['summary'],
                    'content' => "<p>{$tpl['summary']}</p><p>Giao diện được thiết kế hiện đại, đạt tiêu chuẩn kỹ thuật Core Web Vitals của Google, tương thích 100% trên các thiết bị di động, tablet và máy tính để bàn. Tích hợp sẵn hệ thống quản trị nội dung CMS tiếng Việt dễ sử dụng, bảo mật SSL và tối ưu mã nguồn chuẩn SEO on-page.</p>",
                    'thumbnail' => $tpl['image'],
                    'status' => 'published',
                    'article_type' => 'standard',
                    'editorial_status' => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                    'views' => rand(150, 1850),
                    'meta_title' => $tpl['title'] . ' - Truyền Thông Cửu Long',
                    'meta_description' => $tpl['summary'],
                ]
            );
        }
    }
}
