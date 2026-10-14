@extends('layouts.app')

@section('title', 'Những Website Chúng Tôi Đã Thực Hiện & Kho Giao Diện - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá những website chúng tôi đã thực hiện và kho giao diện: thiết kế hiện đại, chuẩn SEO, tối ưu trải nghiệm UI/UX và bảo mật hiệu suất cao cho doanh nghiệp.')
@section('canonical', route('projects.index'))

@php
    $websiteProjects = [
        [
            'id' => 1,
            'title' => 'Tôi là Người Miền Tây',
            'category_slug' => 'du-lich',
            'category_name' => 'Du lịch',
            'badge_class' => 'bg-orange-50 text-[#ff5400] border-orange-200/80',
            'description' => 'Website du lịch khám phá và lan tỏa nét đẹp văn hóa miền Tây sông nước với giao diện hiện đại, thân thiện người dùng.',
            'image' => asset('images/projects/website/du-an-tui-la-nguoi-mien-tay.png'),
            'client' => 'Tui Là Người Miền Tây',
            'tech' => 'WordPress, PHP, MySQL, Caching System',
            'year' => '2024',
            'slug' => 'website-tui-la-nguoi-mien-tay',
            'domain' => 'tuilanguoimientay.vn',
            'url' => 'https://tuilanguoimientay.vn',
            'features' => ['Cổng thông tin văn hóa & du lịch miền Tây', 'Tối ưu tốc độ tải trang Core Web Vitals', 'Tích hợp bản đồ địa điểm & mạng xã hội', 'Giao diện tương thích 100% thiết bị di động'],
        ],
        [
            'id' => 2,
            'title' => 'Cửu Long Camping',
            'category_slug' => 'du-lich',
            'category_name' => 'Du lịch',
            'badge_class' => 'bg-orange-50 text-[#ff5400] border-orange-200/80',
            'description' => 'Website đặt chỗ cắm trại, trải nghiệm thiên nhiên sinh thái với hệ thống booking và thanh toán trực tuyến.',
            'image' => asset('images/projects/website/du-an-cuulongcamping.png'),
            'client' => 'Cửu Long Camping & Glamping',
            'tech' => 'Laravel, Tailwind CSS, Booking Engine, VNPay',
            'year' => '2024',
            'slug' => 'website-cuu-long-camping',
            'domain' => 'cuulongcamping.vn',
            'url' => 'https://cuulongcamping.vn',
            'features' => ['Hệ thống đặt lịch cắm trại thông minh', 'Xem lịch trống theo thời gian thực', 'Tự động gửi email xác nhận đặt chỗ', 'Bộ sưu tập hình ảnh 4K sinh động'],
        ],
        [
            'id' => 3,
            'title' => 'Phòng Khám Đa Khoa Cần Thơ',
            'category_slug' => 'y-te',
            'category_name' => 'Y tế',
            'badge_class' => 'bg-sky-50 text-sky-600 border-sky-200/80',
            'description' => 'Website giới thiệu dịch vụ y tế, đặt lịch khám online và tư vấn sức khỏe trực tuyến 24/7.',
            'image' => asset('images/projects/website/du-an-phong-kham-can-tho.png'),
            'client' => 'Phòng Khám Đa Khoa Cần Thơ',
            'tech' => 'PHP, Laravel, MySQL, Schema Y Tế, REST API',
            'year' => '2024',
            'slug' => 'website-phong-kham-can-tho',
            'domain' => 'phongkhamcantho.com',
            'url' => 'https://phongkhamcantho.com',
            'features' => ['Đặt hẹn khám bệnh trực tuyến 24/7', 'Tra cứu thông tin bác sĩ & chuyên khoa', 'Tối ưu chuẩn SEO y tế địa phương', 'Bảo mật hồ sơ bệnh nhân an toàn'],
        ],
        [
            'id' => 4,
            'title' => 'Đa Khoa Cần Thơ - Sức Khỏe Cộng Đồng',
            'category_slug' => 'y-te',
            'category_name' => 'Y tế',
            'badge_class' => 'bg-sky-50 text-sky-600 border-sky-200/80',
            'description' => 'Nền tảng y khoa chuyên sâu, hỗ trợ bệnh nhân tìm hiểu bệnh lý và nhận tư vấn nhanh chóng từ chuyên gia.',
            'image' => asset('images/projects/website/du-an-da-khoa-can-tho.png'),
            'client' => 'Hệ Thống Y Tế Cần Thơ',
            'tech' => 'Laravel, Tailwind CSS, Livewire, MySQL',
            'year' => '2024',
            'slug' => 'website-da-khoa-can-tho',
            'domain' => 'dakhoacantho.com',
            'url' => 'https://dakhoacantho.com',
            'features' => ['Hệ thống tư vấn sức khỏe trực tuyến', 'Đăng ký khám & xét nghiệm định kỳ', 'Giao diện thân thiện chuẩn y khoa', 'Tối ưu tốc độ tải trang di động cực nhanh'],
        ],
        [
            'id' => 5,
            'title' => 'Phòng Khám Đa Khoa Gia Phước',
            'category_slug' => 'y-te',
            'category_name' => 'Y tế',
            'badge_class' => 'bg-teal-50 text-teal-600 border-teal-200/80',
            'description' => 'Website phòng khám đa khoa hiện đại, cung cấp dịch vụ khám chữa bệnh chất lượng cao tại Cần Thơ.',
            'image' => asset('images/projects/website/du-an-phong-kham-da-khoa-gia-phuoc.png'),
            'client' => 'Phòng Khám Đa Khoa Gia Phước',
            'tech' => 'Laravel, Vue.js, Tailwind CSS, Medical Schema',
            'year' => '2024',
            'slug' => 'website-phong-kham-da-khoa-gia-phuoc',
            'domain' => 'phongkhamgiaphuoc.com',
            'url' => 'https://phongkhamgiaphuoc.com',
            'features' => ['Giới thiệu đội ngũ y bác sĩ đầu ngành', 'Cổng tiếp nhận và phân luồng bệnh nhân', 'Tích hợp số hotline & tư vấn Zalo tức thì', 'Chuẩn SEO chuyên sâu ngành y dược'],
        ],
        [
            'id' => 6,
            'title' => 'Đa Khoa Gia Phước - Cổng Thông Tin Y Tế',
            'category_slug' => 'y-te',
            'category_name' => 'Y tế',
            'badge_class' => 'bg-teal-50 text-teal-600 border-teal-200/80',
            'description' => 'Trang thông tin chuyên khoa, cẩm nang sức khỏe và giải đáp thắc mắc người bệnh uy tín.',
            'image' => asset('images/projects/website/du-an-da-khoa-gia-phuoc.png'),
            'client' => 'Đa Khoa Gia Phước',
            'tech' => 'WordPress, PHP, MySQL, Technical SEO',
            'year' => '2024',
            'slug' => 'website-da-khoa-gia-phuoc',
            'domain' => 'dakhoagiaphuoc.vn',
            'url' => 'https://dakhoagiaphuoc.vn',
            'features' => ['Cẩm nang bệnh lý & hướng dẫn chăm sóc', 'Bảng thông tin dịch vụ khám chữa bệnh', 'Đặt lịch hẹn tái khám online tiện lợi', 'Hỗ trợ đa nền tảng điện thoại và máy tính'],
        ],
        [
            'id' => 7,
            'title' => 'Giặt Ủi Công Nghiệp 365',
            'category_slug' => 'dich-vu',
            'category_name' => 'Dịch vụ',
            'badge_class' => 'bg-blue-50 text-blue-600 border-blue-200/80',
            'description' => 'Website giới thiệu giải pháp giặt ủi công nghiệp cao cấp cho khách sạn, nhà hàng, bệnh viện và resort.',
            'image' => asset('images/projects/website/du-an-giat-ui-cong-nghiep-365.png'),
            'client' => 'Giặt Ủi Công Nghiệp 365',
            'tech' => 'Laravel, Tailwind CSS, Lead Engine, SEO',
            'year' => '2024',
            'slug' => 'website-giat-ui-cong-nghiep-365',
            'domain' => 'giatuicongnghiep365.com',
            'url' => 'https://giatuicongnghiep365.com',
            'features' => ['Giới thiệu quy trình giặt ủi công nghiệp', 'Dự toán chi phí giặt sấy theo số lượng', 'Biểu mẫu yêu cầu báo giá doanh nghiệp B2B', 'Giao diện trực quan, cam kết giao nhận 24/7'],
        ],
        [
            'id' => 8,
            'title' => 'Tiêu Dao Tự',
            'category_slug' => 'khac',
            'category_name' => 'Khác',
            'badge_class' => 'bg-amber-50 text-amber-700 border-amber-200/80',
            'description' => 'Website thông tin văn hóa, tâm linh và kiến trúc tự viện truyền thống, lan tỏa những giá trị bình an.',
            'image' => asset('images/projects/website/du-an-tieu-dao-tu.png'),
            'client' => 'Tiêu Dao Tự',
            'tech' => 'PHP, Modern UI/UX, Lightbox Gallery, Audio Player',
            'year' => '2024',
            'slug' => 'website-tieu-dao-tu',
            'domain' => 'tieudaotu.com',
            'url' => 'https://tieudaotu.com',
            'features' => ['Không gian kiến trúc thanh tịnh, trang nghiêm', 'Bộ sưu tập hình ảnh & hoạt động thiện nguyện', 'Tích hợp phát bài giảng và thông bạch', 'Tương thích mượt mà trên mọi thiết bị di động'],
        ],
    ];
@endphp

@section('content')
<div x-data="{
    activeTab: '{{ request('category') ?? 'all' }}',
    searchQuery: '',
    previewModal: false,
    selectedProject: null,
    totalCount: {{ count($websiteProjects) }},
    visibleCount: {{ count($websiteProjects) }},

    isProjectVisible(categorySlug, searchHaystack) {
        let matchTab = (this.activeTab === 'all') || (categorySlug === this.activeTab);
        if (!matchTab) return false;
        if (!this.searchQuery.trim()) return true;
        let q = this.searchQuery.trim().toLowerCase();
        return searchHaystack.includes(q);
    },

    openModal(proj) {
        this.selectedProject = proj;
        this.previewModal = true;
    },

    closeModal() {
        this.previewModal = false;
        this.selectedProject = null;
    }
}" class="bg-[#fcfdfd] text-slate-800">

    <style>
        .font-handwriting {
            font-family: 'Caveat', cursive, sans-serif;
        }
        .hero-feature-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 14px;
            transition: all 0.25s ease-in-out;
        }
        .hero-feature-card:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 84, 0, 0.4);
        }
        .tab-btn-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 20px;
            border-radius: 9999px;
            font-size: 13.5px;
            font-weight: 600;
            white-space: nowrap;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            color: #475569;
        }
        .tab-btn-pill:hover {
            border-color: #ff5400;
            color: #ff5400;
            background-color: #fffaf5;
        }
        .tab-btn-pill.active {
            background-color: #ff5400 !important;
            border-color: #ff5400 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
        }
        .project-website-card {
            border-radius: 20px;
            background-color: #ffffff;
            border: 1px solid #eef2f6;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
        }
        .project-website-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px -8px rgba(15, 23, 42, 0.12);
            border-color: rgba(255, 84, 0, 0.25);
        }
        .project-website-card:hover .project-img {
            transform: scale(1.02);
        }
        .project-img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .avatar-badge-wrapper {
            position: relative !important;
            width: 48px !important;
            height: 48px !important;
            flex-shrink: 0 !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }
        .avatar-badge-wrapper img {
            width: 48px !important;
            height: 48px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            display: block !important;
        }
        .avatar-verified-check {
            position: absolute !important;
            bottom: -2px !important;
            right: -2px !important;
            width: 18px !important;
            height: 18px !important;
            border-radius: 50% !important;
            background-color: #10b981 !important;
            color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: 2px solid #ffffff !important;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2) !important;
            z-index: 20 !important;
        }
        .star-rating-gold {
            display: inline-flex !important;
            align-items: center !important;
            gap: 2.5px !important;
        }
        .star-rating-gold svg {
            width: 16px !important;
            height: 16px !important;
            fill: #f59e0b !important;
        }
    </style>

    <!-- ========================================================
         SECTION 1: HERO HEADER BANNER (NHỮNG WEBSITE CHÚNG TÔI ĐÃ THỰC HIỆN)
         ======================================================== -->
    <section class="relative w-full overflow-hidden border-b border-slate-100 bg-[#fbfdfe]">
        
        <!-- ==================== DESKTOP (LG+): 100% UNCLIPPED NATURAL BANNER WITH OVERLAY ==================== -->
        <div class="hidden lg:block relative w-full select-none">
            <!-- Background Image in natural flow: w-full h-auto guarantees 100% full view with ZERO clipping -->
            <img src="{{ asset('images/projects/banner_du_an_website.png') }}?v={{ file_exists(public_path('images/projects/banner_du_an_website.png')) ? filemtime(public_path('images/projects/banner_du_an_website.png')) : time() }}" 
                 alt="Những Website Chúng Tôi Đã Thực Hiện Và Kho Giao Diện" 
                 class="w-full h-auto block select-none pointer-events-none"
                 loading="eager"
                 fetchpriority="high"
                 width="1024"
                 height="409">

            <!-- Soft Ambient Light Scrim on the left side to maximize readability against the city/bridge background -->
            <div class="absolute inset-y-0 left-0 w-7/12 bg-gradient-to-r from-white/70 via-white/40 to-transparent pointer-events-none z-0"></div>

            <!-- Content Overlay strictly fitted inside the banner -->
            <div class="absolute inset-0 z-10 flex items-center">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 xl:px-10 w-full">
                    <div class="grid grid-cols-12 gap-6 xl:gap-8 items-center">
                        
                        <!-- Left 60%: Text & 4 Badges on the sunny open left side -->
                        <div class="col-span-7 xl:col-span-6 space-y-2.5 lg:space-y-3 xl:space-y-4">
                            
                            <!-- Badge -->
                            <div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[#ff5400] bg-white/95 backdrop-blur-md border border-orange-200/80 shadow-xs">
                                    <span class="material-symbols-outlined text-[15px]">info</span>
                                    <span>DỰ ÁN WEBSITE</span>
                                </span>
                            </div>

                            <!-- Main Heading -->
                            <h1 class="text-2xl lg:text-[28px] xl:text-[38px] 2xl:text-[42px] font-black tracking-tight text-slate-900 leading-[1.18] drop-shadow-xs">
                                Những Website Chúng Tôi Đã Thực Hiện<br>
                                <span class="text-[#ff5400]">Và Kho Giao Diện</span>
                            </h1>

                            <!-- Description -->
                            <div class="max-w-lg">
                                <p class="text-slate-800 font-medium text-xs lg:text-[13px] xl:text-sm leading-relaxed bg-white/95 backdrop-blur-md px-4 py-2.5 rounded-xl border border-orange-200/80 shadow-xs">
                                    Mỗi dự án là một câu chuyện thành công. Chúng tôi tự hào mang đến những website hiện đại, chuẩn SEO, tối ưu trải nghiệm và phù hợp với từng nhu cầu kinh doanh của khách hàng.
                                </p>
                            </div>

                            <!-- 4 Badges (2x2 Grid) -->
                            <div class="grid grid-cols-2 gap-2 xl:gap-2.5 pt-1 max-w-lg">
                                <div class="hero-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">palette</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Thiết kế hiện đại &amp; độc đáo</h3>
                                    </div>
                                </div>

                                <div class="hero-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">search_insights</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Chuẩn SEO lên top Google</h3>
                                    </div>
                                </div>

                                <div class="hero-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">touch_app</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Tối ưu trải nghiệm người dùng (UI/UX)</h3>
                                    </div>
                                </div>

                                <div class="hero-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">verified_user</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Bảo mật &amp; hiệu suất cao</h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right 40%: Completely open to reveal the entire Laptop, Tablet, Phone, Calligraphy & Coffee cup -->
                        <div class="col-span-5 xl:col-span-6 pointer-events-none"></div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== MOBILE & TABLET (< 1024px): STACKED CLEANLY ==================== -->
        <div class="block lg:hidden w-full">
            <!-- Full Unclipped Banner Artwork on Top -->
            <div class="w-full bg-slate-50 border-b border-slate-100">
                <img src="{{ asset('images/projects/banner_du_an_website.png') }}?v={{ file_exists(public_path('images/projects/banner_du_an_website.png')) ? filemtime(public_path('images/projects/banner_du_an_website.png')) : time() }}" 
                     alt="Những Website Chúng Tôi Đã Thực Hiện Và Kho Giao Diện" 
                     class="w-full h-auto block select-none pointer-events-none"
                     loading="eager"
                     fetchpriority="high"
                     width="1024"
                     height="409">
            </div>

            <!-- Content below artwork -->
            <div class="px-4 sm:px-6 py-6 sm:py-8 space-y-4 bg-white">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[#ff5400] bg-orange-50 border border-orange-200/80">
                        <span class="material-symbols-outlined text-[15px]">info</span>
                        <span>DỰ ÁN WEBSITE</span>
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900 leading-tight">
                    Những Website Chúng Tôi Đã Thực Hiện<br>
                    <span class="text-[#ff5400]">Và Kho Giao Diện</span>
                </h1>

                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Mỗi dự án là một câu chuyện thành công. Chúng tôi tự hào mang đến những website hiện đại, chuẩn SEO, tối ưu trải nghiệm và phù hợp với từng nhu cầu kinh doanh của khách hàng.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-orange-50/50 border border-orange-100">
                        <span class="material-symbols-outlined text-[#ff5400] text-[20px]">palette</span>
                        <span class="text-xs font-bold text-slate-800">Thiết kế hiện đại &amp; độc đáo</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-orange-50/50 border border-orange-100">
                        <span class="material-symbols-outlined text-[#ff5400] text-[20px]">search_insights</span>
                        <span class="text-xs font-bold text-slate-800">Chuẩn SEO lên top Google</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-orange-50/50 border border-orange-100">
                        <span class="material-symbols-outlined text-[#ff5400] text-[20px]">touch_app</span>
                        <span class="text-xs font-bold text-slate-800">Tối ưu trải nghiệm người dùng (UI/UX)</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-orange-50/50 border border-orange-100">
                        <span class="material-symbols-outlined text-[#ff5400] text-[20px]">verified_user</span>
                        <span class="text-xs font-bold text-slate-800">Bảo mật &amp; hiệu suất cao</span>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- ========================================================
         SECTION 2: BREADCRUMB, CATEGORY FILTERS & SEARCH BAR
         ======================================================== -->
    <section class="pt-8 sm:pt-10 pb-16 sm:pb-20 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb Navigation -->
            <div class="flex items-center justify-between flex-wrap gap-2 mb-6">
                <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 font-medium" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="hover:text-[#ff5400] flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[17px]">home</span>
                        <span>Trang chủ</span>
                    </a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('projects.index') }}" class="hover:text-[#ff5400] transition-colors">Dự án</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-[#ff5400] font-semibold">Website</span>
                </nav>
                <a href="{{ route('projects.media') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-[#ff5400] transition-colors">
                    <span class="material-symbols-outlined text-[15px]">smart_display</span>
                    <span>Xem dự án Media</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <!-- Filter Tabs Row + Search Input Container -->
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4 mb-10 pb-2">
                
                <!-- Category Filter Pills -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none no-scrollbar flex-wrap sm:flex-nowrap">
                    
                    <button type="button" 
                            @click="activeTab = 'all'" 
                            :class="{ 'active': activeTab === 'all' }"
                            class="tab-btn-pill">
                        Tất cả
                    </button>

                    <button type="button" 
                            @click="activeTab = 'du-lich'" 
                            :class="{ 'active': activeTab === 'du-lich' }"
                            class="tab-btn-pill">
                        Du lịch
                    </button>

                    <button type="button" 
                            @click="activeTab = 'doanh-nghiep'" 
                            :class="{ 'active': activeTab === 'doanh-nghiep' }"
                            class="tab-btn-pill">
                        Doanh nghiệp
                    </button>

                    <button type="button" 
                            @click="activeTab = 'thuong-mai-dien-tu'" 
                            :class="{ 'active': activeTab === 'thuong-mai-dien-tu' }"
                            class="tab-btn-pill">
                        Thương mại điện tử
                    </button>

                    <button type="button" 
                            @click="activeTab = 'giao-duc'" 
                            :class="{ 'active': activeTab === 'giao-duc' }"
                            class="tab-btn-pill">
                        Giáo dục
                    </button>

                    <button type="button" 
                            @click="activeTab = 'y-te'" 
                            :class="{ 'active': activeTab === 'y-te' }"
                            class="tab-btn-pill">
                        Y tế
                    </button>

                    <button type="button" 
                            @click="activeTab = 'dich-vu'" 
                            :class="{ 'active': activeTab === 'dich-vu' }"
                            class="tab-btn-pill">
                        Dịch vụ
                    </button>

                    <button type="button" 
                            @click="activeTab = 'khac'" 
                            :class="{ 'active': activeTab === 'khac' }"
                            class="tab-btn-pill">
                        Khác
                    </button>

                </div>

                <!-- Search Input on the Right -->
                <div class="relative shrink-0 w-full sm:w-72 lg:w-80">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <span class="material-symbols-outlined text-[19px]">search</span>
                    </span>
                    <input type="text" 
                           x-model="searchQuery" 
                           placeholder="Tìm kiếm dự án..." 
                           class="w-full pl-10 pr-4 py-2 sm:py-2.5 rounded-full border border-slate-200 bg-white text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#ff5400] focus:ring-2 focus:ring-orange-500/20 shadow-2xs transition-all">
                    
                    <button type="button" 
                            x-show="searchQuery" 
                            @click="searchQuery = ''" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </button>
                </div>

            </div>

            <!-- ========================================================
                 PROJECTS GRID: 9 REAL CARDS STRICTLY MATCHING MOCKUP
                 ======================================================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 lg:gap-8">
                
                @foreach($websiteProjects as $proj)
                    @php
                        $searchHaystack = strtolower($proj['title'] . ' ' . $proj['description'] . ' ' . $proj['category_name'] . ' ' . $proj['client'] . ' ' . $proj['tech']);
                    @endphp
                    <article x-show="isProjectVisible('{{ $proj['category_slug'] }}', '{{ addslashes($searchHaystack) }}')" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-3"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="project-website-card group">
                        
                        <!-- Card Top: Website Screenshot Thumbnail (Full 3:4 Aspect Ratio) -->
                        <div class="aspect-[3/4] bg-slate-50 relative overflow-hidden border-b border-slate-100">
                            <a href="{{ $proj['url'] }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="block w-full h-full"
                               title="Ghé thăm website {{ $proj['title'] }} ({{ $proj['domain'] }})">
                                <img src="{{ $proj['image'] }}" 
                                     alt="{{ $proj['title'] }}" 
                                     class="w-full h-full object-cover object-top project-img"
                                     loading="lazy">
                            </a>
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-slate-950/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2 p-3">
                                <a href="{{ $proj['url'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="px-4 py-2 rounded-full bg-[#ff5400] hover:bg-orange-600 text-white font-bold text-xs shadow-lg flex items-center gap-1.5 transform translate-y-2 group-hover:translate-y-0 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                    <span>Truy cập web</span>
                                </a>
                                <button type="button" 
                                        @click="openModal({{ json_encode($proj) }})"
                                        class="px-3.5 py-2 rounded-full bg-white/95 hover:bg-white text-slate-800 font-bold text-xs shadow-lg flex items-center gap-1 transform translate-y-2 group-hover:translate-y-0 transition-all">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">visibility</span>
                                    <span>Chi tiết</span>
                                </button>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 sm:p-6 flex flex-col justify-between flex-1">
                            <div>
                                <!-- Title & Category Row -->
                                <div class="flex items-start justify-between gap-3 mb-2">
                                    <h2 class="text-base sm:text-[17px] font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1 leading-snug">
                                        <a href="{{ $proj['url'] }}" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           class="hover:underline">
                                            {{ $proj['title'] }}
                                        </a>
                                    </h2>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold shrink-0 border {{ $proj['badge_class'] }}">
                                        {{ $proj['category_name'] }}
                                    </span>
                                </div>

                                <!-- Brief Description -->
                                <p class="text-xs sm:text-[13px] text-slate-500 line-clamp-2 leading-relaxed mt-1">
                                    {{ $proj['description'] }}
                                </p>
                            </div>

                            <!-- Card Footer: Domain & External Link -->
                            <div class="pt-4 mt-3 flex items-center justify-between border-t border-slate-100/90 text-xs">
                                <a href="{{ $proj['url'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="inline-flex items-center gap-1 text-slate-500 hover:text-[#ff5400] font-medium transition-colors"
                                   title="{{ $proj['domain'] }}">
                                    <span class="material-symbols-outlined text-[15px] text-[#ff5400]">language</span>
                                    <span class="truncate max-w-[130px] sm:max-w-[150px] font-mono">{{ $proj['domain'] }}</span>
                                </a>
                                <a href="{{ $proj['url'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="inline-flex items-center gap-1 font-bold text-[#ff5400] hover:text-orange-600 group-hover:gap-1.5 transition-all">
                                    <span>Xem website</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_outward</span>
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach

            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 3: CON SỐ NỔI BẬT (STATISTICS DARK BANNER)
         ======================================================== -->
    <section class="relative py-14 sm:py-18 text-white overflow-hidden" 
             style="background: linear-gradient(135deg, rgba(8, 14, 26, 0.94) 0%, rgba(13, 21, 38, 0.96) 100%), url('{{ asset('images/projects/stats_banner_dark.jpg') }}'); background-size: cover; background-position: center; background-blend-mode: multiply;">
        
        <!-- Subtle orange ambient accent -->
        <div class="absolute -right-20 top-1/2 -translate-y-1/2 w-80 h-80 bg-orange-600/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Top Tag & Main Heading -->
            <div class="mb-10 sm:mb-12">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-500/15 border border-orange-400/30 text-[#ff8433] text-[11px] font-extrabold uppercase tracking-wider mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                    <span>CON SỐ NỔI BẬT</span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-white tracking-tight leading-tight">
                    Hành Trình Kiến Tạo Những Website<br class="hidden sm:inline"> Chất Lượng
                </h2>
            </div>

            <!-- Bottom Row: 4 Stats Cards + CTA Button -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- 4 Statistics (Columns 1-9) -->
                <div class="lg:col-span-9 grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-4">
                    
                    <!-- Stat 1: 100+ Dự án -->
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#ff5400] to-orange-400 text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                            <span class="material-symbols-outlined text-2xl">desktop_windows</span>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">100+</div>
                            <div class="text-xs text-slate-300 leading-snug mt-0.5">Dự án website<br>đã hoàn thành</div>
                        </div>
                    </div>

                    <!-- Stat 2: 95% Khách hàng hài lòng -->
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#ff5400] to-orange-400 text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                            <span class="material-symbols-outlined text-2xl">sentiment_satisfied</span>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">95%</div>
                            <div class="text-xs text-slate-300 leading-snug mt-0.5">Khách hàng<br>hài lòng</div>
                        </div>
                    </div>

                    <!-- Stat 3: 5+ Năm kinh nghiệm -->
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#ff5400] to-orange-400 text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                            <span class="material-symbols-outlined text-2xl">military_tech</span>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">5+</div>
                            <div class="text-xs text-slate-300 leading-snug mt-0.5">Năm kinh nghiệm<br>trong lĩnh vực web</div>
                        </div>
                    </div>

                    <!-- Stat 4: 100% Chuẩn SEO -->
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#ff5400] to-orange-400 text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                            <span class="material-symbols-outlined text-2xl">verified</span>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">100%</div>
                            <div class="text-xs text-slate-300 leading-snug mt-0.5">Website tối ưu<br>chuẩn SEO</div>
                        </div>
                    </div>

                </div>

                <!-- CTA Button (Columns 10-12) -->
                <div class="lg:col-span-3 flex lg:justify-end">
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full text-white font-bold text-sm bg-gradient-to-r from-[#ff5400] to-orange-500 shadow-xl shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-105 transition-all duration-300 whitespace-nowrap">
                        <span>Bắt đầu dự án ngay</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 4: KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI (TESTIMONIALS)
         ======================================================== -->
    <section class="py-16 sm:py-24 bg-gradient-to-b from-white via-orange-50/20 to-white border-t border-slate-100 relative overflow-hidden"
             x-data="{
                 activeSlide: 0,
                 totalSlides: 2,
                 next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides; },
                 prev() { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides; }
             }">
        <!-- Decorative Ambient Glow -->
        <div class="absolute -top-32 left-1/4 w-96 h-96 bg-orange-100/40 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute -bottom-32 right-10 w-96 h-96 bg-amber-100/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Left Column: Title, Trust Highlights, CTA & Nav Controls -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-[#ff5400] bg-orange-50 border border-orange-200/80 shadow-xs">
                            <span class="material-symbols-outlined text-[15px] text-[#ff5400]">hotel_class</span>
                            <span>KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI</span>
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-black text-slate-900 tracking-tight leading-[1.22]">
                        Sự Tin Tưởng Từ Khách Hàng Là <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff5400] to-amber-500">Động Lực Của Chúng Tôi</span>
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                        Chúng tôi luôn lắng nghe, thấu hiểu và đồng hành cùng doanh nghiệp trong suốt quá trình xây dựng, vận hành và phát triển giải pháp số.
                    </p>

                    <!-- Trust Metric Highlights -->
                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <div class="p-3.5 rounded-2xl bg-white border border-slate-100 shadow-xs flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 text-amber-500 flex items-center justify-center shrink-0">
                                <svg viewBox="0 0 20 20" style="width: 22px; height: 22px; fill: #f59e0b;"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <div>
                                <div class="text-base font-black text-slate-900">4.9 / 5.0</div>
                                <div class="text-[11px] text-slate-500 font-medium">Hài lòng từ 100+ đối tác</div>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white border border-slate-100 shadow-xs flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg viewBox="0 0 24 24" style="width: 22px; height: 22px; fill: none; stroke: #10b981; stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><polyline points="9 12 11 14 15 10"></polyline></svg>
                            </div>
                            <div>
                                <div class="text-base font-black text-slate-900">100%</div>
                                <div class="text-[11px] text-slate-500 font-medium">Đạt chuẩn tiến độ cam kết</div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA + Slider Controls Buttons Row -->
                    <div class="flex items-center gap-4 pt-2">
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-900 hover:bg-[#ff5400] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-orange-200 hover:shadow-lg transition-all duration-300 group">
                            <span>Liên hệ nhận tư vấn</span>
                            <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>

                        <!-- Prev / Next Slider Arrows -->
                        <div class="flex items-center gap-2">
                            <button type="button" 
                                    @click="prev()" 
                                    class="w-10 h-10 rounded-full border border-slate-200 hover:border-[#ff5400] bg-white hover:bg-orange-50 text-slate-600 hover:text-[#ff5400] flex items-center justify-center transition-all shadow-xs" 
                                    title="Đánh giá trước"
                                    aria-label="Đánh giá trước">
                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                            </button>
                            <button type="button" 
                                    @click="next()" 
                                    class="w-10 h-10 rounded-full border border-slate-200 hover:border-[#ff5400] bg-white hover:bg-orange-50 text-slate-600 hover:text-[#ff5400] flex items-center justify-center transition-all shadow-xs" 
                                    title="Đánh giá tiếp theo"
                                    aria-label="Đánh giá tiếp theo">
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Interactive Testimonial Cards & Carousel Dots -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- Slide 0: Card 1 & Card 2 -->
                    <div x-show="activeSlide === 0" 
                         x-transition:enter="transition ease-out duration-300 transform" 
                         x-transition:enter-start="opacity-0 translate-x-4" 
                         x-transition:enter-end="opacity-100 translate-x-0" 
                         class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        
                        <!-- Testimonial 1: Nguyễn Văn Hùng -->
                        <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-100/80 shadow-[0_8px_30px_-6px_rgba(15,23,42,0.06)] hover:shadow-[0_16px_36px_-6px_rgba(255,84,0,0.12)] hover:border-orange-200/80 transition-all duration-300 relative flex flex-col justify-between group">
                            
                            <!-- Card Header: Stars & Project Tag & Subtle Quote Icon -->
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="star-rating-gold">
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>
                                    <span class="text-[10.5px] font-bold text-orange-600 bg-orange-50 px-2.5 py-0.5 rounded-full border border-orange-100">
                                        Website Du Lịch
                                    </span>
                                </div>

                                <p class="text-xs sm:text-[13.5px] text-slate-700 leading-relaxed font-normal italic mb-6">
                                    &ldquo;Website được thiết kế rất đẹp, tốc độ nhanh, đúng với mong muốn của chúng tôi. Đội ngũ hỗ trợ nhiệt tình và chuyên nghiệp trong từng khâu bàn giao.&rdquo;
                                </p>
                            </div>

                            <!-- Customer Info -->
                            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                                <div class="avatar-badge-wrapper">
                                    <img src="{{ asset('images/projects/avatar_hung.jpg') }}" 
                                         alt="Nguyễn Văn Hùng" 
                                         class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm ring-2 ring-orange-100">
                                    <span class="avatar-verified-check" title="Khách hàng đã xác thực">
                                        <svg viewBox="0 0 24 24" style="width: 10px; height: 10px; fill: none; stroke: #ffffff; stroke-width: 3.5; stroke-linecap: round; stroke-linejoin: round;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-[#ff5400] transition-colors truncate">
                                        Nguyễn Văn Hùng
                                    </div>
                                    <div class="text-[11.5px] text-slate-500 truncate">
                                        Giám đốc
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2: Trần Thị Mai -->
                        <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-100/80 shadow-[0_8px_30px_-6px_rgba(15,23,42,0.06)] hover:shadow-[0_16px_36px_-6px_rgba(255,84,0,0.12)] hover:border-orange-200/80 transition-all duration-300 relative flex flex-col justify-between group">
                            
                            <!-- Card Header: Stars & Project Tag & Subtle Quote Icon -->
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="star-rating-gold">
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>
                                    <span class="text-[10.5px] font-bold text-sky-600 bg-sky-50 px-2.5 py-0.5 rounded-full border border-sky-100">
                                        Website Y Tế
                                    </span>
                                </div>

                                <p class="text-xs sm:text-[13.5px] text-slate-700 leading-relaxed font-normal italic mb-6">
                                    &ldquo;Chúng tôi rất hài lòng với chất lượng dịch vụ. Website không chỉ đẹp mà còn dễ sử dụng, đặt lịch khám tiện lợi và tối ưu chuẩn SEO rất tốt trên Google.&rdquo;
                                </p>
                            </div>

                            <!-- Customer Info -->
                            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                                <div class="avatar-badge-wrapper">
                                    <img src="{{ asset('images/projects/avatar_mai.jpg') }}" 
                                         alt="Trần Thị Mai" 
                                         class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm ring-2 ring-orange-100">
                                    <span class="avatar-verified-check" title="Khách hàng đã xác thực">
                                        <svg viewBox="0 0 24 24" style="width: 10px; height: 10px; fill: none; stroke: #ffffff; stroke-width: 3.5; stroke-linecap: round; stroke-linejoin: round;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-[#ff5400] transition-colors truncate">
                                        Trần Thị Mai
                                    </div>
                                    <div class="text-[11.5px] text-slate-500 truncate">
                                        CEO 
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Slide 1: Card 3 & Card 4 -->
                    <div x-show="activeSlide === 1" 
                         x-transition:enter="transition ease-out duration-300 transform" 
                         x-transition:enter-start="opacity-0 translate-x-4" 
                         x-transition:enter-end="opacity-100 translate-x-0" 
                         class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6" 
                         style="display: none;">
                        
                        <!-- Testimonial 3: Lê Anh Tuấn (Cửu Long Camping) -->
                        <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-100/80 shadow-[0_8px_30px_-6px_rgba(15,23,42,0.06)] hover:shadow-[0_16px_36px_-6px_rgba(255,84,0,0.12)] hover:border-orange-200/80 transition-all duration-300 relative flex flex-col justify-between group">
                            
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="star-rating-gold">
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>
                                    <span class="text-[10.5px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">
                                        Hệ Thống Booking
                                    </span>
                                </div>

                                <p class="text-xs sm:text-[13.5px] text-slate-700 leading-relaxed font-normal italic mb-6">
                                    &ldquo;Hệ thống đặt lịch cắm trại thông minh, khách hàng phản hồi rất tích cực. Tốc độ tải trang cực nhanh và giao diện mobile mượt mà, tiện lợi.&rdquo;
                                </p>
                            </div>

                            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                                <div class="avatar-badge-wrapper">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-amber-500 to-[#ff5400] text-white font-black text-sm flex items-center justify-center ring-2 ring-orange-100 shadow-sm">
                                        LAT
                                    </div>
                                    <span class="avatar-verified-check" title="Khách hàng đã xác thực">
                                        <svg viewBox="0 0 24 24" style="width: 10px; height: 10px; fill: none; stroke: #ffffff; stroke-width: 3.5; stroke-linecap: round; stroke-linejoin: round;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-[#ff5400] transition-colors truncate">
                                        Lê Anh Tuấn
                                    </div>
                                    <div class="text-[11.5px] text-slate-500 truncate">
                                        Founder - Cửu Long Camping
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 4: Phan Thu Hương (Nông Sản Mekong) -->
                        <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-100/80 shadow-[0_8px_30px_-6px_rgba(15,23,42,0.06)] hover:shadow-[0_16px_36px_-6px_rgba(255,84,0,0.12)] hover:border-orange-200/80 transition-all duration-300 relative flex flex-col justify-between group">
                            
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="star-rating-gold">
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>
                                    <span class="text-[10.5px] font-bold text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-full border border-indigo-100">
                                        E-Commerce Bán Lẻ
                                    </span>
                                </div>

                                <p class="text-xs sm:text-[13.5px] text-slate-700 leading-relaxed font-normal italic mb-6">
                                    &ldquo;Tính năng giỏ hàng và thanh toán trực tuyến bảo mật, vận hành rất trơn tru. Doanh thu bán lẻ qua website tăng trưởng rõ rệt sau 2 tháng ra mắt.&rdquo;
                                </p>
                            </div>

                            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                                <div class="avatar-badge-wrapper">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 text-white font-black text-sm flex items-center justify-center ring-2 ring-indigo-100 shadow-sm">
                                        PTH
                                    </div>
                                    <span class="avatar-verified-check" title="Khách hàng đã xác thực">
                                        <svg viewBox="0 0 24 24" style="width: 10px; height: 10px; fill: none; stroke: #ffffff; stroke-width: 3.5; stroke-linecap: round; stroke-linejoin: round;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-[#ff5400] transition-colors truncate">
                                        Phan Thu Hương
                                    </div>
                                    <div class="text-[11.5px] text-slate-500 truncate">
                                        Quản lý - HTX Nông Sản Mekong
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Carousel Dots Indicator (Interactive) -->
                    <div class="flex items-center justify-center gap-2 pt-3">
                        <button type="button" 
                                @click="activeSlide = 0" 
                                :class="activeSlide === 0 ? 'w-8 bg-[#ff5400]' : 'w-2.5 bg-slate-300 hover:bg-slate-400'" 
                                class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"
                                aria-label="Trang 1"></button>
                        <button type="button" 
                                @click="activeSlide = 1" 
                                :class="activeSlide === 1 ? 'w-8 bg-[#ff5400]' : 'w-2.5 bg-slate-300 hover:bg-slate-400'" 
                                class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"
                                aria-label="Trang 2"></button>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         MODAL: PROJECT DETAIL & LIVE PREVIEW MODAL
         ======================================================== -->
    <div x-show="previewModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm"
         @keydown.escape.window="closeModal()">
        
        <div class="relative w-full max-w-2xl bg-white rounded-3xl overflow-hidden shadow-2xl border border-slate-100 flex flex-col max-h-[90vh]"
             @click.away="closeModal()">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold" 
                          :class="selectedProject ? selectedProject.badge_class : ''"
                          x-text="selectedProject ? selectedProject.category_name : ''">
                    </span>
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base line-clamp-1" 
                        x-text="selectedProject ? selectedProject.title : ''">
                    </h3>
                    <template x-if="selectedProject?.url">
                        <a :href="selectedProject?.url" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="hidden sm:inline-flex items-center gap-1 text-[11.5px] font-semibold text-[#ff5400] hover:underline bg-orange-50 px-2 py-0.5 rounded-full border border-orange-200">
                            <span x-text="selectedProject?.domain"></span>
                            <span class="material-symbols-outlined text-[13px]">open_in_new</span>
                        </a>
                    </template>
                </div>
                <button type="button" 
                        @click="closeModal()" 
                        class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- Modal Content (Scrollable) -->
            <div class="overflow-y-auto p-6 space-y-5" x-if="selectedProject">
                
                <!-- Large Image Preview (Full 3:4 view without cropping) -->
                <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-md aspect-[3/4] max-h-[460px] bg-slate-50 flex items-center justify-center mx-auto">
                    <img :src="selectedProject?.image" 
                         :alt="selectedProject?.title" 
                         class="w-full h-full object-contain object-top">
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs">
                    <div>
                        <div class="text-slate-400 font-medium">Khách hàng</div>
                        <div class="font-bold text-slate-800 mt-0.5" x-text="selectedProject?.client"></div>
                    </div>
                    <div>
                        <div class="text-slate-400 font-medium">Năm thực hiện</div>
                        <div class="font-bold text-slate-800 mt-0.5" x-text="selectedProject?.year"></div>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <div class="text-slate-400 font-medium">Công nghệ</div>
                        <div class="font-bold text-[#ff5400] mt-0.5" x-text="selectedProject?.tech"></div>
                    </div>
                    <template x-if="selectedProject?.url">
                        <div class="col-span-2 sm:col-span-3 pt-2.5 mt-1 border-t border-slate-200/70 flex items-center justify-between">
                            <span class="text-slate-500 font-medium">Website trực tuyến:</span>
                            <a :href="selectedProject?.url" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="font-bold text-[#ff5400] hover:text-orange-700 hover:underline inline-flex items-center gap-1 font-mono text-xs">
                                <span x-text="selectedProject?.domain"></span>
                                <span class="material-symbols-outlined text-[15px]">open_in_new</span>
                            </a>
                        </div>
                    </template>
                </div>

                <!-- Description -->
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1.5">Giới thiệu dự án:</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed" x-text="selectedProject?.description"></p>
                </div>

                <!-- Key Features -->
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-2">Đặc điểm nổi bật:</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                        <template x-for="feat in (selectedProject?.features || [])">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-emerald-500">check_circle</span>
                                <span x-text="feat"></span>
                            </li>
                        </template>
                    </ul>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="p-4 sm:p-5 border-t border-slate-100 bg-slate-50 flex items-center justify-between gap-3 flex-wrap">
                <button type="button" 
                        @click="closeModal()" 
                        class="px-5 py-2.5 rounded-full border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-100 transition-colors">
                    Đóng
                </button>
                <div class="flex items-center gap-2 flex-wrap">
                    <template x-if="selectedProject?.url">
                        <a :href="selectedProject?.url" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="px-5 py-2.5 rounded-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition-colors flex items-center gap-1.5 shadow-sm">
                            <span class="material-symbols-outlined text-[16px] text-[#ff5400]">open_in_new</span>
                            <span>Ghé thăm website</span>
                        </a>
                    </template>
                    <a href="{{ route('contact') }}" 
                       class="px-5 py-2.5 rounded-full bg-[#ff5400] text-white font-bold text-xs shadow-md shadow-orange-500/25 hover:bg-orange-600 transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">forum</span>
                        <span>Tư vấn thiết kế</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
