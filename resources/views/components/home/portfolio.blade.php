@php
    if (!isset($techCaseStudies) || $techCaseStudies->isEmpty()) {
        $techCaseStudies = \App\Models\CaseStudy::where('group', 'technology')
            ->whereIn('slug', ['ung-dung-quan-ly-phong-kham', 'website-phong-kham-da-khoa'])
            ->orderBy('order')
            ->take(2)
            ->get();
    } else {
        $filtered = $techCaseStudies->whereIn('slug', ['ung-dung-quan-ly-phong-kham', 'website-phong-kham-da-khoa'])->take(2);
        $techCaseStudies = $filtered->isNotEmpty() ? $filtered : $techCaseStudies->take(2);
    }
    $mediaCaseStudies = $mediaCaseStudies ?? \App\Models\CaseStudy::where('group', 'media')->orderBy('order')->take(3)->get();
@endphp

<section class="w-full bg-surface bg-dot-grid-subtle pt-6 lg:pt-8 pb-14 lg:pb-20 relative gsap-reveal-section border-b border-slate-200/80 overflow-hidden" 
         id="portfolio-section"
         aria-labelledby="portfolio-title">

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 lg:space-y-6">

        <!-- ==================== 1. TECHNOLOGY CASE STUDIES (PRIMARY ~85%) ==================== -->
        <div class="space-y-6 sm:space-y-8 relative pt-2 lg:pt-4 pb-2 sm:pb-3" id="tech-case-studies">
            
            <!-- Slogan Viết Tay Top-Left (Text sắc nét, typography chuẩn kèm mũi tên cam trỏ xuống Card 1) -->
            <div class="hidden lg:flex flex-col items-center absolute left-3 xl:left-6 top-1 lg:top-2 pointer-events-none select-none z-20" aria-hidden="true">
                <span style="font-family: 'Caveat', cursive, sans-serif; color: #ea580c; font-size: 20px; line-height: 1.2; transform: rotate(-5deg); display: block; font-weight: 700; text-align: center; text-shadow: 0 1px 2px rgba(234, 88, 12, 0.1);">
                    Giải pháp<br>
                    công nghệ thực tế<br>
                    cho doanh nghiệp<br>
                    của bạn
                </span>
                <!-- Hand-drawn curved SVG arrow curving gracefully toward Card 1 -->
                <svg class="w-10 h-10 text-[#ea580c] mt-1 -rotate-6 translate-x-3 overflow-visible" viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 4 C 10 16, 18 24, 26 28"/>
                    <path d="M19 28 L 26 28 L 25 21"/>
                </svg>
            </div>

            <!-- Chữ thư pháp Cửu Long Top-Right (Sắc nét, chuẩn theo thiết kế mẫu) -->
            <div class="hidden lg:block absolute right-2 xl:right-6 top-0 lg:top-1 w-44 xl:w-52 pointer-events-none select-none z-0 opacity-85" aria-hidden="true">
                <img src="{{ asset('images/projects/decor_cuulong_watermark.png') }}?v={{ filemtime(public_path('images/projects/decor_cuulong_watermark.png')) }}" 
                     alt="Cửu Long Watermark" 
                     class="w-full h-auto object-contain">
            </div>

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto relative z-10">
                <!-- Eyebrow Pill with Orange Lines -->
                <div class="inline-flex items-center gap-2.5 mb-3.5">
                    <span style="width: 32px; height: 2px; background-color: #f97316; display: inline-block; border-radius: 9999px;" aria-hidden="true"></span>
                    <span style="background-color: #eef2f6; color: #475569; font-size: 11px; font-weight: 700; letter-spacing: 0.16em; padding: 4px 14px; border-radius: 9999px; border: 1px solid #e2e8f0;" class="shadow-2xs uppercase">
                        DỰ ÁN TIÊU BIỂU
                    </span>
                    <span style="width: 32px; height: 2px; background-color: #f97316; display: inline-block; border-radius: 9999px;" aria-hidden="true"></span>
                </div>

                <!-- Title with Orange Emphasis -->
                <h2 id="portfolio-title" class="font-headline text-2xl sm:text-3xl lg:text-[40px] font-extrabold tracking-tight text-[#0B132A] leading-tight">
                    Những Bài Toán Công Nghệ<br>
                    <span style="color: #ff5500 !important;" class="font-black">Chúng Tôi Đã Triển Khai</span>
                </h2>

                <!-- Subtitle -->
                <p class="font-body text-slate-500 text-xs sm:text-[13.5px] lg:text-[14px] mt-3.5 max-w-2xl mx-auto leading-relaxed">
                    Từ ứng dụng Web-App quản lý nghiệp vụ đến nền tảng website doanh nghiệp chuẩn SEO, mỗi dự án là một minh chứng thực tế cho năng lực giải quyết bài toán vận hành của Cửu Long.
                </p>
            </div>

            <style>
                .tech-case-preview-window {
                    position: relative;
                    width: 100%;
                    height: 270px;
                    overflow: hidden;
                    background-color: #0b1329;
                }
                @media (min-width: 640px) {
                    .tech-case-preview-window {
                        height: 310px;
                    }
                }
                @media (min-width: 1024px) {
                    .tech-case-preview-window {
                        height: 320px;
                    }
                }
                .tech-case-scroll-img {
                    width: 100%;
                    height: auto;
                    display: block;
                    transform: translateY(0);
                    transition: transform 2.5s ease-out;
                    will-change: transform;
                }
                /* When card is hovered, smoothly scroll down */
                .group:hover .tech-case-scroll-img {
                    transform: translateY(calc(-100% + 270px));
                    transition: transform 7.5s ease-in-out;
                }
                .group:hover .tech-case-scroll-img-app {
                    transition: transform 3.8s ease-in-out;
                }
                @media (min-width: 640px) {
                    .group:hover .tech-case-scroll-img {
                        transform: translateY(calc(-100% + 310px));
                    }
                }
                @media (min-width: 1024px) {
                    .group:hover .tech-case-scroll-img {
                        transform: translateY(calc(-100% + 320px));
                    }
                }
            </style>

            <!-- Technology Projects Grid (2 Big Featured Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 items-stretch pt-2 relative z-10">
                <!-- Card 1: Healthcare Web-App Clinic System -->
                <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/80 shadow-[0_4px_25px_rgba(0,0,0,0.04)] hover:shadow-[0_14px_38px_rgba(0,0,0,0.09)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    
                    <!-- Showcase Image Preview (Scroll on Hover) -->
                    <div class="tech-case-preview-window border-b border-slate-100">
                        <picture>
                            <source srcset="{{ asset('images/projects/tech_case_clinic_app.webp') }}?v={{ filemtime(public_path('images/projects/tech_case_clinic_app.webp')) }}" type="image/webp">
                            <img class="tech-case-scroll-img tech-case-scroll-img-app" 
                                 alt="Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa" 
                                 loading="lazy"
                                 src="{{ asset('images/projects/tech_case_clinic_app.png') }}?v={{ filemtime(public_path('images/projects/tech_case_clinic_app.png')) }}"/>
                        </picture>
                        
                        <!-- Hover to scroll visual badge -->
                        <div class="absolute bottom-2.5 right-3 pointer-events-none opacity-80 group-hover:opacity-0 transition-opacity duration-300 bg-slate-900/80 text-slate-300 text-[10px] font-medium px-2.5 py-1 rounded-full flex items-center gap-1.5 backdrop-blur-xs border border-slate-700/50">
                            <svg class="w-3 h-3 text-sky-400 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                            <span>Rê chuột để cuộn</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
                        <div class="space-y-3.5">
                            <!-- Meta Row: Client Tag + Year -->
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full bg-[#f0f9ff] text-[#0284c7] font-sans text-xs font-semibold border border-[#e0f2fe]">
                                    Khách hàng: Phòng Khám Đa Khoa
                                </span>
                                <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <span>2024</span>
                                </div>
                            </div>

                            <!-- Project Title -->
                            <h3 class="font-headline text-[17px] sm:text-[19px] lg:text-[20px] font-bold text-[#0B132A] group-hover:text-primary transition-colors leading-snug">
                                Ứng Dụng Quản Lý &amp; Đặt Lịch Phòng Khám Đa Khoa
                            </h3>

                            <!-- Problem vs Solution 2 Columns -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4 pt-1">
                                <!-- Problem -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1.5 mb-1.5 min-w-0">
                                        <div class="w-5 h-5 rounded-full bg-[#fff4ed] border border-[#fed7aa] flex items-center justify-center shrink-0 shadow-2xs">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="#f97316"><path d="M12 2C7.58 2 4 5.58 4 10c0 2.5 1.15 4.73 2.96 6.19.43.35.69.87.69 1.42V19c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-1.39c0-.55.26-1.07.69-1.42C17.85 14.73 19 12.5 19 10c0-4.42-3.58-8-8-8zm-2 19h4v1h-4v-1z"/></svg>
                                        </div>
                                        <span class="text-[10px] sm:text-[10.5px] 2xl:text-[11px] font-bold text-[#0B132A] uppercase tracking-tight whitespace-nowrap">BÀI TOÁN DOANH NGHIỆP:</span>
                                    </div>
                                    <p class="text-[11.5px] text-slate-500 leading-relaxed">
                                        Quy trình tiếp đón bệnh nhân thủ công, mất thời gian ghi nhận và khó tra cứu hồ sơ khám chữa bệnh theo thời gian thực.
                                    </p>
                                </div>

                                <!-- Solution -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1.5 mb-1.5 min-w-0">
                                        <div class="w-5 h-5 rounded-full bg-[#f0f9ff] border border-[#bae6fd] flex items-center justify-center shrink-0 shadow-2xs">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <span class="text-[10px] sm:text-[10.5px] 2xl:text-[11px] font-bold text-[#0B132A] uppercase tracking-tight whitespace-nowrap">GIẢI PHÁP TRIỂN KHAI:</span>
                                    </div>
                                    <p class="text-[11.5px] text-slate-500 leading-relaxed">
                                        Xây dựng hệ thống Web-App quản lý y tế tập trung, tối ưu quy trình đặt lịch trực tuyến và quản lý hồ sơ an toàn.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Meta -->
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center">
                            <a href="{{ route('projects.show', 'ung-dung-quan-ly-phong-kham') }}" 
                                class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1e40af] hover:text-[#ff5500] transition-colors group-hover:translate-x-0.5">
                                <span>Xem chi tiết Case Study</span>
                                <span class="text-sm font-bold leading-none select-none">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Website Phong Kham Da Khoa Gia Phuoc Chuan WordPress -->
                <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/80 shadow-[0_4px_25px_rgba(0,0,0,0.04)] hover:shadow-[0_14px_38px_rgba(0,0,0,0.09)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    
                    <!-- Showcase Image Preview (Scroll on Hover) -->
                    <div class="tech-case-preview-window border-b border-slate-100">
                        <picture>
                            <source srcset="{{ asset('images/projects/tech_case_hospital_wp.webp') }}?v={{ filemtime(public_path('images/projects/tech_case_hospital_wp.webp')) }}" type="image/webp">
                            <img class="tech-case-scroll-img" 
                                 alt="Website Phòng Khám Đa Khoa Gia Phước Chuẩn WordPress" 
                                 loading="lazy"
                                 src="{{ asset('images/projects/tech_case_hospital_wp.png') }}?v={{ filemtime(public_path('images/projects/tech_case_hospital_wp.png')) }}"/>
                        </picture>

                        <!-- Hover to scroll visual badge -->
                        <div class="absolute bottom-2.5 right-3 pointer-events-none opacity-80 group-hover:opacity-0 transition-opacity duration-300 bg-slate-900/80 text-slate-300 text-[10px] font-medium px-2.5 py-1 rounded-full flex items-center gap-1.5 backdrop-blur-xs border border-slate-700/50">
                            <svg class="w-3 h-3 text-sky-400 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                            <span>Rê chuột để cuộn</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
                        <div class="space-y-3.5">
                            <!-- Meta Row: Client Tag + Year -->
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full bg-[#f0f9ff] text-[#0284c7] font-sans text-xs font-semibold border border-[#e0f2fe]">
                                    Khách hàng: Phòng Khám Đa Khoa Gia Phước
                                </span>
                                <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <span>2024</span>
                                </div>
                            </div>

                            <!-- Project Title -->
                            <h3 class="font-headline text-[17px] sm:text-[19px] lg:text-[20px] font-bold text-[#0B132A] group-hover:text-primary transition-colors leading-snug">
                                Website Phòng Khám Đa Khoa Gia Phước Chuẩn WordPress
                            </h3>

                            <!-- Problem vs Solution 2 Columns -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4 pt-1">
                                <!-- Problem -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1.5 mb-1.5 min-w-0">
                                        <div class="w-5 h-5 rounded-full bg-[#fff4ed] border border-[#fed7aa] flex items-center justify-center shrink-0 shadow-2xs">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="#f97316"><path d="M12 2C7.58 2 4 5.58 4 10c0 2.5 1.15 4.73 2.96 6.19.43.35.69.87.69 1.42V19c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-1.39c0-.55.26-1.07.69-1.42C17.85 14.73 19 12.5 19 10c0-4.42-3.58-8-8-8zm-2 19h4v1h-4v-1z"/></svg>
                                        </div>
                                        <span class="text-[10px] sm:text-[10.5px] 2xl:text-[11px] font-bold text-[#0B132A] uppercase tracking-tight whitespace-nowrap">BÀI TOÁN DOANH NGHIỆP:</span>
                                    </div>
                                    <p class="text-[11.5px] text-slate-500 leading-relaxed">
                                        Doanh nghiệp y khoa cần hiện diện thương hiệu uy tín, tải trang nhanh và tối ưu cấu trúc thu hút bệnh nhân từ Google.
                                    </p>
                                </div>

                                <!-- Solution -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1.5 mb-1.5 min-w-0">
                                        <div class="w-5 h-5 rounded-full bg-[#f0f9ff] border border-[#bae6fd] flex items-center justify-center shrink-0 shadow-2xs">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <span class="text-[10px] sm:text-[10.5px] 2xl:text-[11px] font-bold text-[#0B132A] uppercase tracking-tight whitespace-nowrap">GIẢI PHÁP TRIỂN KHAI:</span>
                                    </div>
                                    <p class="text-[11.5px] text-slate-500 leading-relaxed">
                                        Thiết kế website y khoa chuyên nghiệp, chuẩn cấu trúc SEO y tế và tích hợp luồng chuyển đổi đặt hẹn tự động.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Meta -->
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center">
                            <a href="{{ route('projects.show', 'website-phong-kham-da-khoa') }}" 
                               class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1e40af] hover:text-[#ff5500] transition-colors group-hover:translate-x-0.5">
                                <span>Xem chi tiết Case Study</span>
                                <span class="text-sm font-bold leading-none select-none">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Primary Action CTA for Technology Projects -->
            <div class="text-center pt-2 pb-0 relative z-10">
                <a href="{{ route('projects.index') }}" 
                   style="background-color: #0B132A !important; color: #ffffff !important;"
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full hover:!bg-[#ff5500] text-white font-headline text-xs sm:text-sm font-bold shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300">
                    <span>Xem toàn bộ dự án của chúng tôi</span>
                    <span class="text-base font-bold select-none leading-none">→</span>
                </a>
            </div>
        </div>

        <div class="relative pt-0 sm:pt-1 scroll-mt-16" id="ready-made-templates">
            
            <!-- Animation Keyframes for CTA Button -->
            <style>
                @keyframes pulse-gentle {
                    0%, 100% {
                        box-shadow: 0 8px 20px rgba(255, 85, 0, 0.45), 0 0 0 0 rgba(255, 85, 0, 0.45);
                        transform: scale(1);
                    }
                    50% {
                        box-shadow: 0 12px 28px rgba(255, 85, 0, 0.65), 0 0 0 7px rgba(255, 85, 0, 0);
                        transform: scale(1.025);
                    }
                }
                .animate-pulse-gentle {
                    animation: pulse-gentle 2.4s ease-in-out infinite;
                }
                .animate-pulse-gentle:hover {
                    animation: none;
                }
            </style>

            <!-- Header Section: Intro + Feature Pills + Handwriting Callout & CTA -->
            <div class="relative flex flex-col lg:flex-row lg:items-center justify-between gap-6 lg:gap-8 pb-6 sm:pb-8">
                
                <!-- Left Column: Title & Intro & Badges -->
                <div class="max-w-2xl relative z-10">
                    <!-- Eyebrow -->
                    <div class="flex items-center gap-2.5 mb-3.5">
                        <span style="display:inline-block; width:34px; height:4px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                        <span class="text-xs sm:text-[13px] font-extrabold text-[#0B132A] uppercase tracking-wider">KHO GIAO DIỆN DEMO SẴN SÀNG</span>
                    </div>

                    <!-- Title -->
                    <h2 class="font-headline text-3xl sm:text-4xl lg:text-[44px] font-black text-[#0B132A] tracking-tight leading-[1.18]">
                        Mẫu Giao Diện Khởi Chạy Nhanh<br>
                        <span style="color: #ff5500 !important;">Cho Doanh Nghiệp</span>
                    </h2>

                    <!-- Subtitle -->
                    <p class="font-body text-slate-500 text-sm sm:text-[15px] mt-3.5 leading-relaxed">
                        Bản dựng chuẩn chỉ, tải nhanh và tối ưu cấu trúc. Khám phá các mẫu giao diện phổ biến hoặc truy cập toàn bộ thư viện giao diện theo ngành nghề.
                    </p>

                    <!-- 4 Feature Pills -->
                    <div class="flex flex-wrap items-center gap-2.5 sm:gap-3 pt-5">
                        <!-- Chuẩn SEO -->
                        <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white border border-slate-200/90 shadow-2xs text-slate-700 text-xs font-semibold hover:border-orange-300 hover:bg-orange-50/40 transition-all">
                            <svg class="w-3.5 h-3.5" style="color: #ff5500;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                            <span>Chuẩn SEO</span>
                        </div>
                        <!-- Tối ưu tốc độ -->
                        <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white border border-slate-200/90 shadow-2xs text-slate-700 text-xs font-semibold hover:border-orange-300 hover:bg-orange-50/40 transition-all">
                            <svg class="w-3.5 h-3.5" style="color: #ff5500;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <span>Tối ưu tốc độ</span>
                        </div>
                        <!-- Dễ dàng tùy chỉnh -->
                        <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white border border-slate-200/90 shadow-2xs text-slate-700 text-xs font-semibold hover:border-orange-300 hover:bg-orange-50/40 transition-all">
                            <svg class="w-3.5 h-3.5" style="color: #ff5500;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                            </svg>
                            <span>Dễ dàng tùy chỉnh</span>
                        </div>
                        <!-- Hỗ trợ kỹ thuật -->
                        <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white border border-slate-200/90 shadow-2xs text-slate-700 text-xs font-semibold hover:border-orange-300 hover:bg-orange-50/40 transition-all">
                            <svg class="w-3.5 h-3.5" style="color: #ff5500;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
                            </svg>
                            <span>Hỗ trợ kỹ thuật</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Authentic Mockup Collage + Handwriting Callout & Animated Interactive Orange Button -->
                <div class="relative lg:w-5/12 flex items-center justify-center lg:justify-end pt-2 lg:pt-0">
                    <div class="relative w-full max-w-[480px] lg:max-w-[500px]">
                        <!-- Illustration Background: Collage + Handwriting + Arrow (Seamless, NO white cutout) -->
                        <img src="{{ asset('images/templates/top_right_header_banner.webp') }}?v={{ filemtime(public_path('images/templates/top_right_header_banner.webp')) }}" 
                             srcset="{{ asset('images/templates/top_right_header_banner.png') }}?v={{ filemtime(public_path('images/templates/top_right_header_banner.png')) }}"
                             alt="Kho giao diện demo - Đa dạng ngành nghề, Nhiều phong cách, Chỉ cần một cú nhấp chuột!"
                             class="w-full h-auto block select-none pointer-events-none"
                             loading="lazy">
                        
                        <!-- Real Animated Interactive Orange Pill Button -->
                        <a href="{{ route('templates.index') }}" 
                           id="btn-xem-kho-giao-dien"
                           aria-label="Xem kho giao diện"
                           style="position: absolute; right: 3.5%; top: 64.5%; transform: translateY(-50%); background: linear-gradient(135deg, #ff6600 0%, #ff5500 50%, #e04b00 100%) !important; color: #ffffff !important; border: 2px solid rgba(255, 255, 255, 0.95) !important;"
                           class="group/btn z-20 rounded-full flex items-center justify-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 text-white font-headline text-xs sm:text-[13px] lg:text-[14px] font-extrabold cursor-pointer transition-all duration-300 shadow-[0_8px_22px_rgba(255,85,0,0.45)] hover:shadow-[0_14px_34px_rgba(255,85,0,0.7)] hover:scale-105 active:scale-95 animate-pulse-gentle whitespace-nowrap select-none">
                            
                            <!-- Grid icon (4 rounded squares) -->
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white shrink-0 group-hover/btn:rotate-12 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                            </svg>
                            
                            <!-- Text -->
                            <span class="whitespace-nowrap select-none font-bold tracking-tight">Xem kho giao diện</span>
                            
                            <!-- Arrow with hover bounce animation -->
                            <span class="text-xs sm:text-sm lg:text-base font-black leading-none select-none shrink-0 group-hover/btn:translate-x-1.5 transition-transform duration-300">→</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ==================== 4 FEATURED TEMPLATE CARDS WITH CAROUSEL CONTROLS ==================== -->
            <div class="relative group/carousel">
                
                <!-- Navigation Arrow Left -->
                <button type="button" 
                        onclick="const c = document.getElementById('template-cards-container'); c.scrollBy({ left: -320, behavior: 'smooth' });"
                        aria-label="Previous template"
                        class="absolute -left-3 sm:-left-5 top-[38%] -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white border border-slate-200/90 shadow-[0_4px_15px_rgba(0,0,0,0.08)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.12)] text-slate-700 hover:text-[#ff5500] hover:border-[#ff5500]/40 transition-all flex items-center justify-center cursor-pointer active:scale-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Navigation Arrow Right -->
                <button type="button" 
                        onclick="const c = document.getElementById('template-cards-container'); c.scrollBy({ left: 320, behavior: 'smooth' });"
                        aria-label="Next template"
                        class="absolute -right-3 sm:-right-5 top-[38%] -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white border border-slate-200/90 shadow-[0_4px_15px_rgba(0,0,0,0.08)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.12)] text-slate-700 hover:text-[#ff5500] hover:border-[#ff5500]/40 transition-all flex items-center justify-center cursor-pointer active:scale-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Cards Grid / Scrollable Container -->
                <div id="template-cards-container" 
                     class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6 overflow-x-auto scroll-smooth pb-2 pt-1 no-scrollbar">

                    <!-- CARD 1: Sàn Giao Dịch Nhà Đất -->
                    <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        <!-- Preview Box -->
                        <div class="p-3 pb-0">
                            <div class="w-full rounded-2xl overflow-hidden border border-slate-200/80 bg-white shadow-2xs group-hover:border-[#ff5500]/40 transition-colors">
                                <img src="{{ asset('images/templates/card_1_preview.webp') }}?v={{ filemtime(public_path('images/templates/card_1_preview.webp')) }}" 
                                     srcset="{{ asset('images/templates/card_1_preview.png') }}?v={{ filemtime(public_path('images/templates/card_1_preview.png')) }}"
                                     alt="Sàn Giao Dịch Nhà Đất Mockup" 
                                     class="w-full h-auto object-cover block group-hover:scale-102 transition-transform duration-500" 
                                     loading="lazy">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex flex-col justify-between flex-1">
                            <div>
                                <span style="color: #ff5500 !important;" class="text-[11px] font-extrabold uppercase tracking-wider block mb-1">MẪU WEBSITE</span>
                                <h4 class="font-headline text-[18px] font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug">
                                    Sàn Giao Dịch Nhà Đất
                                </h4>
                                <p class="text-slate-500 text-xs sm:text-[13px] leading-relaxed mt-2 line-clamp-3">
                                    Giao diện chuyên nghiệp dành cho doanh nghiệp bất động sản, giúp giới thiệu dự án, đăng tin và thu hút khách hàng tiềm năng.
                                </p>
                            </div>

                            <!-- Footer Meta -->
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-50 text-slate-700 text-xs font-medium border border-slate-200/70">
                                    <svg class="w-3.5 h-3.5" style="color: #ff5500;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                    <span>Bất động sản</span>
                                </span>
                                <a href="{{ route('templates.index', ['industry' => 'bat-dong-san']) }}" 
                                   class="inline-flex items-center gap-1 text-xs font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors">
                                    <span>Xem chi tiết</span>
                                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: Bất Động Sản VinLand Luxury -->
                    <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        <!-- Preview Box -->
                        <div class="p-3 pb-0">
                            <div class="w-full rounded-2xl overflow-hidden border border-slate-200/80 bg-white shadow-2xs group-hover:border-[#ff5500]/40 transition-colors">
                                <img src="{{ asset('images/templates/card_2_preview.webp') }}?v={{ filemtime(public_path('images/templates/card_2_preview.webp')) }}" 
                                     srcset="{{ asset('images/templates/card_2_preview.png') }}?v={{ filemtime(public_path('images/templates/card_2_preview.png')) }}"
                                     alt="Bất Động Sản VinLand Luxury Mockup" 
                                     class="w-full h-auto object-cover block group-hover:scale-102 transition-transform duration-500" 
                                     loading="lazy">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex flex-col justify-between flex-1">
                            <div>
                                <span style="color: #ff5500 !important;" class="text-[11px] font-extrabold uppercase tracking-wider block mb-1">MẪU WEBSITE</span>
                                <h4 class="font-headline text-[18px] font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug">
                                    Bất Động Sản VinLand Luxury
                                </h4>
                                <p class="text-slate-500 text-xs sm:text-[13px] leading-relaxed mt-2 line-clamp-3">
                                    Giao diện cao cấp, sang trọng, phù hợp cho các dự án bất động sản cao cấp, biệt thự, nghỉ dưỡng.
                                </p>
                            </div>

                            <!-- Footer Meta -->
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-50 text-slate-700 text-xs font-medium border border-slate-200/70">
                                    <svg class="w-3.5 h-3.5" style="color: #ff5500;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                    <span>Bất động sản</span>
                                </span>
                                <a href="{{ route('templates.index', ['industry' => 'bat-dong-san']) }}" 
                                   class="inline-flex items-center gap-1 text-xs font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors">
                                    <span>Xem chi tiết</span>
                                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: Thời Trang Thiết Kế Minimal -->
                    <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        <!-- Preview Box -->
                        <div class="p-3 pb-0">
                            <div class="w-full rounded-2xl overflow-hidden border border-slate-200/80 bg-white shadow-2xs group-hover:border-[#ff5500]/40 transition-colors">
                                <img src="{{ asset('images/templates/card_3_preview.webp') }}?v={{ filemtime(public_path('images/templates/card_3_preview.webp')) }}" 
                                     srcset="{{ asset('images/templates/card_3_preview.png') }}?v={{ filemtime(public_path('images/templates/card_3_preview.png')) }}"
                                     alt="Thời Trang Thiết Kế Minimal Mockup" 
                                     class="w-full h-auto object-cover block group-hover:scale-102 transition-transform duration-500" 
                                     loading="lazy">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex flex-col justify-between flex-1">
                            <div>
                                <span style="color: #ff5500 !important;" class="text-[11px] font-extrabold uppercase tracking-wider block mb-1">MẪU WEBSITE</span>
                                <h4 class="font-headline text-[18px] font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug">
                                    Thời Trang Thiết Kế Minimal
                                </h4>
                                <p class="text-slate-500 text-xs sm:text-[13px] leading-relaxed mt-2 line-clamp-3">
                                    Giao diện thời trang hiện đại, tinh tế, phù hợp cho shop thời trang, thương hiệu thời trang thiết kế.
                                </p>
                            </div>

                            <!-- Footer Meta -->
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-50 text-slate-700 text-xs font-medium border border-slate-200/70">
                                    <svg class="w-3.5 h-3.5" style="color: #ff5500;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                                    <span>Thời trang</span>
                                </span>
                                <a href="{{ route('templates.index', ['industry' => 'thoi-trang']) }}" 
                                   class="inline-flex items-center gap-1 text-xs font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors">
                                    <span>Xem chi tiết</span>
                                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 4: Căn Hộ Chung Cư GreenSky -->
                    <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        <!-- Preview Box -->
                        <div class="p-3 pb-0">
                            <div class="w-full rounded-2xl overflow-hidden border border-slate-200/80 bg-white shadow-2xs group-hover:border-[#ff5500]/40 transition-colors">
                                <img src="{{ asset('images/templates/card_4_preview.webp') }}?v={{ filemtime(public_path('images/templates/card_4_preview.webp')) }}" 
                                     srcset="{{ asset('images/templates/card_4_preview.png') }}?v={{ filemtime(public_path('images/templates/card_4_preview.png')) }}"
                                     alt="Căn Hộ Chung Cư GreenSky Mockup" 
                                     class="w-full h-auto object-cover block group-hover:scale-102 transition-transform duration-500" 
                                     loading="lazy">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex flex-col justify-between flex-1">
                            <div>
                                <span style="color: #ff5500 !important;" class="text-[11px] font-extrabold uppercase tracking-wider block mb-1">MẪU WEBSITE</span>
                                <h4 class="font-headline text-[18px] font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug">
                                    Căn Hộ Chung Cư GreenSky
                                </h4>
                                <p class="text-slate-500 text-xs sm:text-[13px] leading-relaxed mt-2 line-clamp-3">
                                    Giao diện hiện đại, thân thiện, phù hợp cho các dự án căn hộ, chung cư, bất động sản cao tầng.
                                </p>
                            </div>

                            <!-- Footer Meta -->
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-50 text-slate-700 text-xs font-medium border border-slate-200/70">
                                    <svg class="w-3.5 h-3.5" style="color: #ff5500;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                    <span>Bất động sản</span>
                                </span>
                                <a href="{{ route('templates.index', ['industry' => 'bat-dong-san']) }}" 
                                   class="inline-flex items-center gap-1 text-xs font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors">
                                    <span>Xem chi tiết</span>
                                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ==================== BOTTOM DARK CTA BANNER ==================== -->
            <div style="background: linear-gradient(90deg, #03122c 0%, #061c47 50%, #03122c 100%) !important; border: 1px solid rgba(255, 255, 255, 0.12) !important; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;" 
                 class="mt-12 lg:mt-16 rounded-[24px] text-white px-6 py-6 sm:px-8 sm:py-7 lg:px-10 lg:py-8 relative overflow-hidden flex flex-col lg:flex-row lg:items-center justify-between gap-6 lg:gap-10">
                <!-- Ambient Glow Background -->
                <div class="absolute -right-10 -bottom-10 w-72 h-72 rounded-full bg-[#ff5500]/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-10 -top-10 w-72 h-72 rounded-full bg-blue-600/15 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6 lg:gap-8 w-full">
                    <!-- Left: Title -->
                    <div class="lg:w-5/12">
                        <div class="flex items-center gap-2 mb-2">
                            <span style="display:inline-block; width:26px; height:3px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                            <span class="text-[11px] font-bold text-slate-300 uppercase tracking-widest">SỞ HỮU GIAO DIỆN CHUYÊN NGHIỆP</span>
                        </div>
                        <h3 class="text-2xl sm:text-[28px] lg:text-[32px] font-black text-white leading-tight">
                            Bạn cần một mẫu giao diện <span style="color: #ff5500 !important;">riêng?</span>
                        </h3>
                    </div>

                    <!-- Middle: Description with vertical divider -->
                    <div class="lg:w-4/12 lg:border-l lg:border-white/20 lg:pl-8">
                        <p class="text-slate-300 text-xs sm:text-[13px] leading-relaxed">
                            Đội ngũ thiết kế của chúng tôi sẵn sàng tạo ra giao diện độc quyền, phù hợp với thương hiệu và mục tiêu kinh doanh của bạn.
                        </p>
                    </div>

                    <!-- Right: CTA Button -->
                    <div class="lg:w-3/12 flex lg:justify-end shrink-0">
                        <a href="{{ route('contact') }}" 
                           style="background-color: #ff5500 !important; color: #ffffff !important; box-shadow: 0 8px 24px rgba(255, 85, 0, 0.4) !important;"
                           class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full text-white font-headline text-xs sm:text-sm font-bold hover:scale-105 active:scale-95 transition-all whitespace-nowrap">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <span>Liên hệ tư vấn</span>
                            <span class="text-base font-bold leading-none select-none">→</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>