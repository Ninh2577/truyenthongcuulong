@extends('layouts.app')

@section('title', 'Dự Án Đã Triển Khai - Truyền Thông Cửu Long')
@section('meta_description', 'Hành trình tạo nên những giá trị thực. Khám phá các dự án lập trình website, web app và sản xuất media thực chiến của Truyền Thông Cửu Long.')
@section('canonical', route('projects.index'))

@section('content')
<div x-data="{
    activeTab: '{{ request('group') && in_array(request('group'), ['media', 'web', 'tech', 'technology']) ? (request('group') === 'media' ? 'media' : 'web') : 'all' }}',
    currentPage: 1,
    videoModal: false,
    videoUrl: '',
    videoTitle: '',
    devModal: false,
    devProjectTitle: '',
    openVideo(title, url) {
        this.videoTitle = title;
        this.videoUrl = url;
        this.videoModal = true;
    },
    closeVideo() {
        this.videoModal = false;
        this.videoUrl = '';
    },
    openDevModal(title) {
        this.devProjectTitle = title;
        this.devModal = true;
    },
    closeDevModal() {
        this.devModal = false;
    }
}">

    <!-- Custom CSS strictly mimicking the mockup & fixing spacing/pagination -->
    <style>
        .badge-project-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 5px 16px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: 1.5px solid #ff5400;
            color: #ff5400;
            background: rgba(255, 84, 0, 0.08);
        }
        .hero-banner-projects {
            position: relative;
            background-image: url('{{ asset("images/quay-chup-flycam/hero_banner.jpg") }}');
            background-size: cover;
            background-position: right center;
            background-repeat: no-repeat;
        }
        @media (max-width: 1024px) {
            .hero-banner-projects {
                background-position: center;
            }
        }
        .hero-glass-box {
            background: linear-gradient(135deg, rgba(7, 13, 24, 0.38) 0%, rgba(7, 13, 24, 0.16) 55%, rgba(7, 13, 24, 0.02) 100%);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 28px;
            padding: 34px 38px;
            box-shadow: 0 16px 36px -10px rgba(0, 0, 0, 0.22);
            max-width: 660px;
        }
        @media (min-width: 1024px) {
            .hero-glass-box {
                margin-left: -28px;
            }
        }
        @media (max-width: 640px) {
            .hero-glass-box {
                padding: 24px 20px;
                border-radius: 20px;
            }
        }
        .hero-title-main {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin: 0 !important;
            text-shadow: 0 3px 18px rgba(0, 0, 0, 0.8), 0 1px 4px rgba(0, 0, 0, 0.9);
        }
        .hero-title-line1 {
            display: block;
            color: #ffffff !important;
            line-height: 1.15 !important;
            letter-spacing: -0.02em;
        }
        .hero-title-line2 {
            display: block;
            color: #ff8433 !important;
            line-height: 1.15 !important;
            letter-spacing: -0.02em;
        }
        @media (min-width: 640px) {
            .hero-title-main {
                gap: 18px;
            }
        }
        .btn-tab-filter {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 20px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            transition: all 0.25s ease-in-out;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            color: #475569;
        }
        .btn-tab-filter:hover {
            border-color: #ff5400;
            color: #ff5400;
        }
        .btn-tab-filter.active {
            background-color: #ff5400 !important;
            border-color: #ff5400 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
        }
        .project-card {
            border-radius: 20px;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
        }
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 32px -10px rgba(15, 23, 42, 0.12);
            border-color: rgba(255, 84, 0, 0.3);
        }
        .project-card > div:first-child {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        
        /* Spacious card body ensuring generous breathing room before the border */
        .card-body-container {
            padding: 24px 24px 28px 24px !important;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .card-body-container h2 {
            margin: 0 0 10px 0 !important;
            line-height: 1.35 !important;
            min-height: 48px;
            display: flex;
            align-items: flex-start;
        }
        .card-body-container p {
            margin-top: 0 !important;
            margin-bottom: 24px !important; /* Generous breathing room between text and bottom border */
            line-height: 1.6 !important;
            color: #64748b !important;
            min-height: 44px;
        }

        /* Clean, airy card footer bar with distinct top border */
        .card-footer-container {
            padding: 18px 24px 20px 24px !important;
            border-top: 1px solid #f1f5f9 !important;
            margin-top: auto !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12.5px;
            color: #64748b;
            background-color: #ffffff;
        }

        /* High-contrast pagination styles ensuring active state is never washed out or blended */
        .pagination-container {
            margin-top: 56px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .pagination-btn {
            width: 42px;
            height: 42px;
            border-radius: 9999px;
            border: 1.5px solid #cbd5e1 !important;
            background-color: #ffffff !important;
            color: #1e293b !important;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            user-select: none;
        }
        .pagination-btn:hover:not(.active) {
            border-color: #ff5400 !important;
            color: #ff5400 !important;
            background-color: #fff7ed !important;
            transform: translateY(-1px);
        }
        .pagination-btn.active,
        button.pagination-btn.active {
            background-color: #ff5400 !important;
            background-image: linear-gradient(135deg, #ff4e00 0%, #ff5e00 50%, #ff7600 100%) !important;
            border-color: #ff5400 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.45) !important;
            font-weight: 800 !important;
            transform: scale(1.05);
        }

        .stats-gradient-banner {
            background: linear-gradient(90deg, #d93d00 0%, #ff5400 50%, #ff6b00 100%);
        }
        .pulse-play-ring {
            box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7);
            animation: pulse-ring 2s infinite;
        }
        /* Web Preview Window & Hover-to-Scroll Effect (Like Homepage) */
        .web-case-preview-window {
            position: relative;
            width: 100%;
            height: 236px;
            overflow: hidden;
            background-color: #0b1329;
            display: block;
        }
        .web-case-scroll-img {
            width: 100%;
            height: auto;
            min-height: 100%;
            display: block;
            transform: translateY(0);
            transition: transform 2.5s ease-out;
            will-change: transform;
        }
        .project-card:hover .web-case-scroll-img {
            transform: translateY(calc(-100% + 236px));
            transition: transform 6.5s ease-in-out;
        }
        .badge-scroll-hint {
            position: absolute;
            bottom: 10px;
            right: 12px;
            pointer-events: none;
            opacity: 0.85;
            transition: opacity 0.3s ease;
            background: rgba(15, 23, 42, 0.82);
            color: #cbd5e1;
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            gap: 4px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            z-index: 20;
        }
        .project-card:hover .badge-scroll-hint {
            opacity: 0;
        }
    </style>


    <!-- ==========================================
         SECTION 1: HERO BANNER (DỰ ÁN ĐÃ TRIỂN KHAI)
         ========================================== -->
    <section class="relative pt-24 sm:pt-28 md:pt-36 pb-20 sm:pb-28 lg:pb-36 hero-banner-projects overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Content Column with Translucent Frosted Glass Box -->
                <div class="lg:col-span-8 xl:col-span-7">
                    <div class="hero-glass-box space-y-6">
                        <!-- Pill Tag -->
                        <div>
                            <span class="badge-project-pill">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                                DỰ ÁN ĐÃ TRIỂN KHAI
                            </span>
                        </div>

                        <!-- Main Heading -->
                        <div>
                            <h1 class="hero-title-main font-black tracking-tight text-3xl sm:text-4xl md:text-5xl lg:text-[54px] xl:text-[60px]">
                                <span class="hero-title-line1">Hành Trình Tạo Nên</span>
                                <span class="hero-title-line2">Những Giá Trị Thực</span>
                            </h1>
                        </div>

                        <!-- Description Text -->
                        <p class="text-slate-200 text-sm sm:text-base leading-relaxed max-w-xl font-normal">
                            Mỗi dự án là một câu chuyện - là sự kết hợp giữa sáng tạo, công nghệ và tâm huyết của đội ngũ Truyền Thông Cửu Long để mang đến những sản phẩm chất lượng, hiệu quả và khác biệt.
                        </p>
                    </div>
                </div>

                <!-- Right Column Spacer allowing Drone visual to shine through -->
                <div class="hidden lg:block lg:col-span-4 xl:col-span-5 min-h-[300px]"></div>
            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 2: FILTER TABS & PROJECTS GRID
         ========================================== -->
    <section class="pt-12 pb-20 sm:pt-16 sm:pb-24 lg:pt-20 lg:pb-28 bg-[#f8fafc] border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Filter Tabs -->
            <div class="flex items-center gap-2.5 overflow-x-auto pb-4 mb-10 no-scrollbar">
                <button type="button" 
                        @click="activeTab = 'all'" 
                        :class="{ 'active': activeTab === 'all' }"
                        class="btn-tab-filter">
                    <span class="material-symbols-outlined text-[19px]">apps</span>
                    <span>Tất cả dự án</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'web'" 
                        :class="{ 'active': activeTab === 'web' }"
                        class="btn-tab-filter">
                    <span class="material-symbols-outlined text-[19px]">language</span>
                    <span>Thiết kế &amp; Web</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'media'" 
                        :class="{ 'active': activeTab === 'media' }"
                        class="btn-tab-filter">
                    <span class="material-symbols-outlined text-[19px]">videocam</span>
                    <span>Quay chụp sự kiện</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'wordpress'" 
                        :class="{ 'active': activeTab === 'wordpress' }"
                        class="btn-tab-filter">
                    <span class="material-symbols-outlined text-[19px]">layers</span>
                    <span>WordPress</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'laravel'" 
                        :class="{ 'active': activeTab === 'laravel' }"
                        class="btn-tab-filter">
                    <span class="material-symbols-outlined text-[19px]">code</span>
                    <span>Laravel &amp; React</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'game'" 
                        :class="{ 'active': activeTab === 'game' }"
                        class="btn-tab-filter">
                    <span class="material-symbols-outlined text-[19px]">sports_esports</span>
                    <span>Game Web</span>
                </button>
            </div>

            <!-- PROJECTS GRID: 12 REAL PROJECTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 sm:gap-8">

                <!-- ==============================================
                     NHÓM 1: 4 DỰ ÁN MEDIA (TỪ TRANG CHỤP ẢNH SỰ KIỆN)
                     ============================================== -->

                <!-- 1. TVC Sacombank -->
                <article x-show="activeTab === 'all' || activeTab === 'media'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <!-- Thumbnail Frame -->
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openVideo('TVC Quảng Cáo Ngân Hàng Sacombank', 'https://www.youtube.com/embed/nGvVhO2kDo8')">
                            <img src="https://img.youtube.com/vi/nGvVhO2kDo8/maxresdefault.jpg" 
                                 alt="TVC Quảng Cáo Sacombank" 
                                 class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500"
                                 onerror="this.src='https://img.youtube.com/vi/nGvVhO2kDo8/hqdefault.jpg'">
                            
                            <div class="absolute inset-0 bg-slate-950/25 group-hover:bg-slate-950/45 transition-colors flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-xl group-hover:scale-115 transition-transform pulse-play-ring">
                                    <span class="material-symbols-outlined text-2xl ml-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                </div>
                            </div>

                            <!-- Bottom Tag Badge -->
                            <div class="absolute bottom-3 left-3">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Quay chụp sự kiện
                                </span>
                            </div>
                        </div>

                        <!-- Card Body with Generous Padding -->
                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug cursor-pointer"
                                @click="openVideo('TVC Quảng Cáo Ngân Hàng Sacombank', 'https://www.youtube.com/embed/nGvVhO2kDo8')">
                                TVC Quảng Cáo Ngân Hàng Sacombank
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Sản xuất video TVC quảng cáo chuyên nghiệp cho chiến dịch thẻ tín dụng mới, tôn vinh hình ảnh thương hiệu hiện đại.
                            </p>
                        </div>
                    </div>

                    <!-- Card Footer Bar -->
                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 2/2026</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">videocam</span>
                                <span>Video</span>
                            </span>
                        </div>
                        <button type="button" 
                                @click="openVideo('TVC Quảng Cáo Ngân Hàng Sacombank', 'https://www.youtube.com/embed/nGvVhO2kDo8')"
                                class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </button>
                    </div>
                </article>


                <!-- 2. Phim Doanh Nghiệp Hoya Lens -->
                <article x-show="activeTab === 'all' || activeTab === 'media'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openVideo('Phim Doanh Nghiệp Hoya Lens', 'https://www.youtube.com/embed/dBFbsinzwNs')">
                            <img src="https://img.youtube.com/vi/dBFbsinzwNs/maxresdefault.jpg" 
                                 alt="Phim Doanh Nghiệp Hoya Lens" 
                                 class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500"
                                 onerror="this.src='https://img.youtube.com/vi/dBFbsinzwNs/hqdefault.jpg'">
                            
                            <div class="absolute inset-0 bg-slate-950/25 group-hover:bg-slate-950/45 transition-colors flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-xl group-hover:scale-115 transition-transform pulse-play-ring">
                                    <span class="material-symbols-outlined text-2xl ml-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                </div>
                            </div>

                            <div class="absolute bottom-3 left-3">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Media doanh nghiệp
                                </span>
                            </div>
                        </div>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug cursor-pointer"
                                @click="openVideo('Phim Doanh Nghiệp Hoya Lens', 'https://www.youtube.com/embed/dBFbsinzwNs')">
                                Phim Doanh Nghiệp Hoya Lens
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Thước phim giới thiệu quy trình sản xuất tròng kính Nhật Bản chuẩn công nghệ cao, khẳng định vị thế thương hiệu.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 8/2025</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">videocam</span>
                                <span>Video</span>
                            </span>
                        </div>
                        <button type="button" 
                                @click="openVideo('Phim Doanh Nghiệp Hoya Lens', 'https://www.youtube.com/embed/dBFbsinzwNs')"
                                class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </button>
                    </div>
                </article>


                <!-- 3. RAKUS Việt Nam - Team Building Nha Trang -->
                <article x-show="activeTab === 'all' || activeTab === 'media'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openVideo('RAKUS Việt Nam - Team Building & Gala Dinner Nha Trang', 'https://www.youtube.com/embed/T9h_Jq_nNWU')">
                            <img src="https://img.youtube.com/vi/T9h_Jq_nNWU/maxresdefault.jpg" 
                                 alt="RAKUS Việt Nam Team Building" 
                                 class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500"
                                 onerror="this.src='https://img.youtube.com/vi/T9h_Jq_nNWU/hqdefault.jpg'">
                            
                            <div class="absolute inset-0 bg-slate-950/25 group-hover:bg-slate-950/45 transition-colors flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-xl group-hover:scale-115 transition-transform pulse-play-ring">
                                    <span class="material-symbols-outlined text-2xl ml-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                </div>
                            </div>

                            <div class="absolute bottom-3 left-3">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Quay phim Teambuilding
                                </span>
                            </div>
                        </div>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug cursor-pointer"
                                @click="openVideo('RAKUS Việt Nam - Team Building & Gala Dinner Nha Trang', 'https://www.youtube.com/embed/T9h_Jq_nNWU')">
                                RAKUS Việt Nam - Team Building &amp; Gala Dinner
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Hành trình gắn kết văn hóa doanh nghiệp Nhật Bản với năng lượng bùng nổ của hơn 300 nhân sự IT tại biển Nha Trang.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 7/2024</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">videocam</span>
                                <span>Video</span>
                            </span>
                        </div>
                        <button type="button" 
                                @click="openVideo('RAKUS Việt Nam - Team Building & Gala Dinner Nha Trang', 'https://www.youtube.com/embed/T9h_Jq_nNWU')"
                                class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </button>
                    </div>
                </article>


                <!-- 4. Tất Niên Kredivo - Dạ Tiệc Tri Ân -->
                <article x-show="activeTab === 'all' || activeTab === 'media'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openVideo('Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao', 'https://www.youtube.com/embed/pwPRwTicUhI')">
                            <img src="https://img.youtube.com/vi/pwPRwTicUhI/maxresdefault.jpg" 
                                 alt="Tất Niên Kredivo" 
                                 class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500"
                                 onerror="this.src='https://img.youtube.com/vi/pwPRwTicUhI/hqdefault.jpg'">
                            
                            <div class="absolute inset-0 bg-slate-950/25 group-hover:bg-slate-950/45 transition-colors flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-xl group-hover:scale-115 transition-transform pulse-play-ring">
                                    <span class="material-symbols-outlined text-2xl ml-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                </div>
                            </div>

                            <div class="absolute bottom-3 left-3">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Quay chụp sự kiện
                                </span>
                            </div>
                        </div>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug cursor-pointer"
                                @click="openVideo('Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao', 'https://www.youtube.com/embed/pwPRwTicUhI')">
                                Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Ghi lại những khoảnh khắc bùng nổ, visual lighting sân khấu hoành tráng trong đêm tiệc tất niên của fintech hàng đầu.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 1/2024</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">videocam</span>
                                <span>Ảnh &amp; Video</span>
                            </span>
                        </div>
                        <button type="button" 
                                @click="openVideo('Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao', 'https://www.youtube.com/embed/pwPRwTicUhI')"
                                class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </button>
                    </div>
                </article>



                <!-- ==============================================
                     NHÓM 2: CÁC DỰ ÁN WEBSITE WORDPRESS
                     ============================================== -->

                <!-- 5. Phòng Khám Cần Thơ (WordPress) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'wordpress'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <a href="https://phongkhamcantho.com/" target="_blank" rel="noopener noreferrer" class="web-case-preview-window">
                            <img src="{{ asset('images/projects/web_phongkhamcantho.jpg') }}" 
                                 alt="Website Phòng Khám Cần Thơ" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Thiết kế &amp; Web
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-white/95 text-slate-800 shadow">
                                WordPress
                            </span>
                        </a>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug">
                                <a href="https://phongkhamcantho.com/" target="_blank" rel="noopener noreferrer">
                                    Website Y Khoa Phòng Khám Cần Thơ
                                </a>
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Cổng thông tin y tế chuyên sâu, giới thiệu chuyên khoa và hệ thống đặt lịch hẹn khám trực tuyến chuẩn WordPress.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 3/2025</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">language</span>
                                <span>Web</span>
                            </span>
                        </div>
                        <a href="https://phongkhamcantho.com/" target="_blank" rel="noopener noreferrer" class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </article>


                <!-- 6. Phòng Khám Gia Phước (WordPress) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'wordpress'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <a href="https://phongkhamgiaphuoc.com/" target="_blank" rel="noopener noreferrer" class="web-case-preview-window">
                            <img src="{{ asset('images/projects/tech_case_hospital_wp.webp') }}" 
                                 alt="Website Phòng Khám Gia Phước" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Thiết kế &amp; Web
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-white/95 text-slate-800 shadow">
                                WordPress
                            </span>
                        </a>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug">
                                <a href="https://phongkhamgiaphuoc.com/" target="_blank" rel="noopener noreferrer">
                                    Website Phòng Khám Đa Khoa Gia Phước
                                </a>
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Nền tảng website phòng khám y tế chất lượng cao, tối ưu SEO On-page và trải nghiệm người dùng trên thiết bị di động.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 2/2025</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">language</span>
                                <span>Web</span>
                            </span>
                        </div>
                        <a href="https://phongkhamgiaphuoc.com/" target="_blank" rel="noopener noreferrer" class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </article>


                <!-- 7. Cửu Long Camping (WordPress) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'wordpress'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <a href="https://cuulongcamping.vn" target="_blank" rel="noopener noreferrer" class="web-case-preview-window">
                            <img src="{{ asset('images/projects/web_cuulongcamping.jpg') }}" 
                                 alt="Website Cửu Long Camping" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Thiết kế &amp; Web
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-white/95 text-slate-800 shadow">
                                WordPress
                            </span>
                        </a>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug">
                                <a href="https://cuulongcamping.vn" target="_blank" rel="noopener noreferrer">
                                    Website Thương Hiệu - Cửu Long Camping
                                </a>
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Thiết kế website dã ngoại, sinh thái ven sông với giao diện phong cách Glamping hiện đại, booking tiện lợi.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 1/2025</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">language</span>
                                <span>Web</span>
                            </span>
                        </div>
                        <a href="https://cuulongcamping.vn" target="_blank" rel="noopener noreferrer" class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </article>


                <!-- 8. Tiêu Dao Tử (WordPress) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'wordpress'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <a href="https://tieudaotu.com" target="_blank" rel="noopener noreferrer" class="web-case-preview-window">
                            <img src="{{ asset('images/projects/web_tieudaotu.jpg') }}" 
                                 alt="Website Tiêu Dao Tử" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Thiết kế &amp; Web
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-white/95 text-slate-800 shadow">
                                WordPress
                            </span>
                        </a>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug">
                                <a href="https://tieudaotu.com" target="_blank" rel="noopener noreferrer">
                                    Website Blog Du Lịch &amp; Văn Hóa Tiêu Dao Tử
                                </a>
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Cổng blog du khảo văn hóa, phong cách sống với bố cục thanh lịch, tối ưu tốc độ đọc và khả năng tương tác độc giả.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 12/2024</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">language</span>
                                <span>Web</span>
                            </span>
                        </div>
                        <a href="https://tieudaotu.com" target="_blank" rel="noopener noreferrer" class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </article>


                <!-- 9. Tui Là Người Miền Tây (WordPress) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'wordpress'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <a href="https://tuilanguoimientay.vn" target="_blank" rel="noopener noreferrer" class="web-case-preview-window">
                            <img src="{{ asset('images/projects/web_tuilanguoimientay.jpg') }}" 
                                 alt="Website Tui Là Người Miền Tây" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Thiết kế &amp; Web
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-white/95 text-slate-800 shadow">
                                WordPress
                            </span>
                        </a>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug">
                                <a href="https://tuilanguoimientay.vn" target="_blank" rel="noopener noreferrer">
                                    Website Cổng Thông Tin Tui Là Người Miền Tây
                                </a>
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Nền tảng truyền thông cộng đồng và chia sẻ nét đẹp văn hóa, ẩm thực miền Tây trên hệ thống WordPress tối ưu cao cấp.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 11/2024</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">language</span>
                                <span>Web</span>
                            </span>
                        </div>
                        <a href="https://tuilanguoimientay.vn" target="_blank" rel="noopener noreferrer" class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </article>



                <!-- ==============================================
                     NHÓM 3: LARAVEL, REACT & GAME DEVELOPMENT
                     ============================================== -->

                <!-- 10. dakhoacantho (PHP Laravel) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'laravel'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <a href="https://dakhoacantho.com" target="_blank" rel="noopener noreferrer" class="web-case-preview-window">
                            <img src="{{ asset('images/projects/web_dakhoacantho.jpg') }}" 
                                 alt="Hệ thống dakhoacantho.com" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Thiết kế &amp; Web
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-blue-600 text-white shadow">
                                PHP Laravel
                            </span>
                        </a>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug">
                                <a href="https://dakhoacantho.com" target="_blank" rel="noopener noreferrer">
                                    Nền Tảng Y Khoa Đa Khoa Cần Thơ (dakhoacantho)
                                </a>
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Xây dựng hệ thống website y tế tốc độ cao, cơ chế phân quyền bảo mật cao cấp trên nền tảng PHP Laravel hiện đại.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 10/2024</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">code</span>
                                <span>Laravel</span>
                            </span>
                        </div>
                        <a href="https://dakhoacantho.com" target="_blank" rel="noopener noreferrer" class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </article>


                <!-- 11. App quản lý phòng khám (PHP React) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'laravel'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <div class="web-case-preview-window cursor-pointer"
                             @click="window.location.href = '{{ route('projects.show', 'ung-dung-quan-ly-phong-kham') }}'">
                            <img src="{{ asset('images/projects/tech_case_clinic_app.webp') }}" 
                                 alt="App quản lý phòng khám" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Thiết kế &amp; Web App
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-sky-500 text-white shadow">
                                PHP React
                            </span>
                        </div>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug">
                                <a href="{{ route('projects.show', 'ung-dung-quan-ly-phong-kham') }}">
                                    Web App Quản Lý Phòng Khám Thông Minh
                                </a>
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Hệ thống Web App quản lý lịch khám, hồ sơ bệnh án điện tử tập trung cho bác sĩ và bệnh nhân sử dụng PHP và React.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 9/2024</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">devices</span>
                                <span>Web App</span>
                            </span>
                        </div>
                        <a href="{{ route('projects.show', 'ung-dung-quan-ly-phong-kham') }}" class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </article>


                <!-- 12. Cungchoi.com (Dự án Game - Click mở popup đang phát triển) -->
                <article x-show="activeTab === 'all' || activeTab === 'web' || activeTab === 'game'" 
                         x-transition 
                         class="project-card group">
                    <div>
                        <div class="web-case-preview-window cursor-pointer"
                             @click="openDevModal('Cổng Game Cùng Chơi (cungchoi.com)')">
                            <img src="{{ asset('images/projects/web_cungchoi.jpg') }}" 
                                 alt="Dự án Cungchoi.com" 
                                 class="web-case-scroll-img">
                            
                            <!-- Hover to scroll visual badge -->
                            <div class="badge-scroll-hint">
                                <span class="material-symbols-outlined text-[13px] text-sky-400 animate-bounce">arrow_downward</span>
                                <span>Rê chuột để cuộn</span>
                            </div>

                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#ff5400] text-white shadow-sm">
                                    Dự án Game
                                </span>
                            </div>

                            <span class="absolute top-3 right-3 z-10 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500 text-white shadow">
                                Đang phát triển
                            </span>
                        </div>

                        <div class="card-body-container">
                            <h2 class="text-base sm:text-lg font-bold text-[#070d18] group-hover:text-[#ff5400] transition-colors leading-snug cursor-pointer"
                                @click="openDevModal('Cổng Game Cùng Chơi (cungchoi.com)')">
                                Cổng Game Trực Tuyến Cùng Chơi (cungchoi.com)
                            </h2>
                            <p class="text-xs sm:text-sm line-clamp-2">
                                Nền tảng game giải trí tương tác trên nền tảng web thế hệ mới với kho mini-game đa dạng và tính năng kết nối người chơi.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer-container">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-slate-400">calendar_today</span>
                                <span>Tháng 8/2024</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-[#ff5400]">sports_esports</span>
                                <span>Game Web</span>
                            </span>
                        </div>
                        <button type="button" 
                                @click="openDevModal('Cổng Game Cùng Chơi (cungchoi.com)')"
                                class="font-bold text-[#ff5400] hover:underline flex items-center gap-1">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </button>
                    </div>
                </article>

            </div>

            <!-- Pagination Bar with High Contrast Orange Active Button & Sharp Borders -->
            <div class="pagination-container">
                <button type="button" 
                        @click="currentPage = Math.max(1, currentPage - 1)" 
                        class="pagination-btn"
                        aria-label="Trang trước">
                    <span class="material-symbols-outlined text-base">chevron_left</span>
                </button>
                
                <button type="button" 
                        @click="currentPage = 1" 
                        :class="currentPage === 1 ? 'active' : ''" 
                        class="pagination-btn active">
                    1
                </button>

                <button type="button" 
                        @click="currentPage = 2" 
                        :class="currentPage === 2 ? 'active' : ''" 
                        class="pagination-btn">
                    2
                </button>

                <button type="button" 
                        @click="currentPage = 3" 
                        :class="currentPage === 3 ? 'active' : ''" 
                        class="pagination-btn">
                    3
                </button>

                <button type="button" 
                        @click="currentPage = 4" 
                        :class="currentPage === 4 ? 'active' : ''" 
                        class="pagination-btn">
                    4
                </button>
                
                <button type="button" 
                        @click="currentPage = Math.min(4, currentPage + 1)" 
                        class="pagination-btn"
                        aria-label="Trang sau">
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                </button>
            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 3: STATS BANNER (HƠN 100+ DỰ ÁN ĐÃ TRIỂN KHAI)
         ========================================== -->
    <section class="stats-gradient-banner py-14 sm:py-18 text-white relative overflow-hidden"
             style="background: linear-gradient(90deg, #d93d00 0%, #ff5400 50%, #ff6b00 100%), url('{{ asset("images/quay-chup-flycam/cta_banner_bg.jpg") }}'); background-size: cover; background-position: center; background-blend-mode: multiply;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left Column -->
                <div class="lg:col-span-5 space-y-4">
                    <div>
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-white/20 text-white backdrop-blur-sm border border-white/30">
                            VÌ SAO CHỌN CHÚNG TÔI
                        </span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-white tracking-tight leading-tight">
                        Hơn 100+ Dự Án Đã Triển Khai
                    </h2>
                    <p class="text-white/90 text-xs sm:text-sm leading-relaxed max-w-md">
                        Chúng tôi tự hào đồng hành cùng hàng trăm khách hàng trong và ngoài tỉnh, mang đến những giải pháp truyền thông sáng tạo, hiệu quả và khác biệt.
                    </p>
                </div>

                <!-- Right Column: 4 Stats Counters -->
                <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
                    
                    <!-- Stat 1 -->
                    <div class="space-y-2">
                        <div class="w-12 h-12 mx-auto rounded-full bg-white/15 backdrop-blur-md flex items-center justify-center border border-white/30 text-white">
                            <span class="material-symbols-outlined text-2xl">photo_camera</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                            100+
                        </div>
                        <div class="text-xs text-white/85 font-medium">
                            Dự án đã triển khai
                        </div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="space-y-2">
                        <div class="w-12 h-12 mx-auto rounded-full bg-white/15 backdrop-blur-md flex items-center justify-center border border-white/30 text-white">
                            <span class="material-symbols-outlined text-2xl">groups</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                            80+
                        </div>
                        <div class="text-xs text-white/85 font-medium">
                            Khách hàng tin tưởng
                        </div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="space-y-2">
                        <div class="w-12 h-12 mx-auto rounded-full bg-white/15 backdrop-blur-md flex items-center justify-center border border-white/30 text-white">
                            <span class="material-symbols-outlined text-2xl">thumb_up</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                            98%
                        </div>
                        <div class="text-xs text-white/85 font-medium">
                            Khách hàng hài lòng
                        </div>
                    </div>

                    <!-- Stat 4 -->
                    <div class="space-y-2">
                        <div class="w-12 h-12 mx-auto rounded-full bg-white/15 backdrop-blur-md flex items-center justify-center border border-white/30 text-white">
                            <span class="material-symbols-outlined text-2xl">history</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                            5+
                        </div>
                        <div class="text-xs text-white/85 font-medium">
                            Năm kinh nghiệm
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         MODAL 1: DỰ ÁN GAME ĐANG PHÁT TRIỂN (CUNGCHOI.COM)
         ========================================== -->
    <div x-show="devModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
         @keydown.escape.window="closeDevModal()">
        
        <div class="relative w-full max-w-md bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-100 text-center"
             @click.away="closeDevModal()">
            
            <!-- Animated Icon -->
            <div class="w-16 h-16 mx-auto rounded-full bg-orange-100 text-[#ff5400] flex items-center justify-center mb-5 shadow-inner">
                <span class="material-symbols-outlined text-4xl">construction</span>
            </div>

            <h3 class="text-xl font-black text-[#070d18] tracking-tight mb-2">
                Dự Án Đang Trong Quá Trình Phát Triển
            </h3>

            <p class="text-sm font-bold text-[#ff5400] mb-3" x-text="devProjectTitle">
                Cổng Game Cùng Chơi (cungchoi.com)
            </p>

            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6">
                Hệ thống đang được đội ngũ kỹ thuật của Truyền Thông Cửu Long hoàn thiện tính năng và kiểm thử trải nghiệm. Phiên bản chính thức sẽ sớm ra mắt đến quý đối tác và người dùng!
            </p>

            <div class="flex items-center justify-center gap-3">
                <button type="button" 
                        @click="closeDevModal()" 
                        class="w-full py-3 px-6 rounded-full bg-[#ff5400] text-white font-bold text-sm shadow-md hover:bg-orange-600 transition-colors">
                    Đã hiểu
                </button>
            </div>
        </div>
    </div>


    <!-- ==========================================
         MODAL 2: VIDEO PLAYER POPUP
         ========================================== -->
    <div x-show="videoModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         @keydown.escape.window="closeVideo()">
        
        <div class="relative w-full max-w-4xl bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-white/10"
             @click.away="closeVideo()">
            <div class="flex items-center justify-between px-6 py-4 border-b border-white/10 bg-slate-900/80">
                <h3 class="font-bold text-white text-sm sm:text-base line-clamp-1" x-text="videoTitle">Xem Video Dự Án</h3>
                <button type="button" 
                        @click="closeVideo()" 
                        class="w-9 h-9 rounded-full bg-white/10 text-white flex items-center justify-center hover:bg-white/20 transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <div class="aspect-video w-full bg-black">
                <template x-if="videoModal && videoUrl">
                    <iframe :src="videoUrl" 
                            class="w-full h-full border-0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </template>
            </div>
        </div>
    </div>

</div>
@endsection
