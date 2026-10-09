@extends('layouts.app')

@section('title', 'Khách Hàng Tiêu Biểu & Đối Tác Chiến Lược - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá danh sách các đối tác, tập đoàn và doanh nghiệp đã tin tưởng đồng hành cùng Truyền Thông Cửu Long trong hành trình phát triển bền vững.')

@section('content')
<div class="w-full bg-[#fcfcfd]" x-data="{ showAllClients: false, activeCategory: 'all', activeProjectTab: 'all', showAllLogos: false }">

    <!-- ==================== BANNER KHÁCH HÀNG TIÊU BIỂU (HTML/CSS CODED) ==================== -->
    <!-- ==================== BANNER KHÁCH HÀNG TIÊU BIỂU (THIẾT KẾ THEO MOCKUP) ==================== -->
    <section class="relative w-full overflow-hidden border-b border-slate-200/80" id="hero-section" style="background: linear-gradient(135deg, #ffffff 0%, #fffdfa 45%, #fff8f2 100%);">
        
        <!-- Background Vector Waves & Accents (Matching Mockup) -->
        <!-- Bottom-Right Orange Wave (Subtle background accent) -->
        <div class="pointer-events-none absolute bottom-0 right-0 w-64 sm:w-96 lg:w-[460px] h-40 sm:h-60 lg:h-72 z-0 select-none overflow-hidden opacity-90" aria-hidden="true">
            <svg viewBox="0 0 460 290" fill="none" class="w-full h-full" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="waveBottomRight" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5e00" stop-opacity="0.95" />
                        <stop offset="45%" stop-color="#ff7a18" stop-opacity="0.88" />
                        <stop offset="100%" stop-color="#ffa057" stop-opacity="0.25" />
                    </linearGradient>
                </defs>
                <path d="M460 290 L130 290 C190 250 260 205 310 145 C355 90 400 45 460 0 Z" fill="url(#waveBottomRight)" />
            </svg>
        </div>

        <style>
            .clm-banner-grid {
                display: flex;
                flex-direction: column;
                gap: 2rem;
            }
            .clm-banner-left {
                width: 100%;
            }
            .clm-banner-right {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            @media (min-width: 1024px) {
                .clm-banner-grid {
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                    gap: 2rem;
                }
                .clm-banner-left {
                    flex: 1 1 54%;
                    max-width: 55%;
                }
                .clm-banner-right {
                    flex: 0 0 45%;
                    max-width: 580px;
                    justify-content: flex-end;
                }
            }

            @media (min-width: 1280px) {
                .clm-banner-left {
                    flex: 1 1 54%;
                    max-width: 55%;
                }
                .clm-banner-right {
                    flex: 0 0 46%;
                    max-width: 650px;
                }
            }

            /* Badge Tag: Khách hàng tiêu biểu */
            .clm-pill-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 6px 16px;
                border-radius: 9999px;
                background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%);
                color: #ffffff !important;
                box-shadow: 0 4px 15px rgba(255, 94, 0, 0.32);
                margin-bottom: 14px;
                font-size: 11px;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }
            .clm-pill-badge:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 20px rgba(255, 94, 0, 0.42);
            }

            /* Headline Typography */
            .clm-hero-h1 {
                font-size: 28px;
                font-weight: 900;
                line-height: 1.22;
                letter-spacing: -0.025em;
                color: #0f172a;
                margin-bottom: 14px;
            }
            @media (min-width: 640px) {
                .clm-hero-h1 {
                    font-size: 34px;
                }
            }
            @media (min-width: 1024px) {
                .clm-hero-h1 {
                    font-size: 38px;
                }
            }
            @media (min-width: 1280px) {
                .clm-hero-h1 {
                    font-size: 42px;
                }
            }
            .clm-hero-h1 .clm-orange-text {
                background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 50%, #ea580c 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                color: #ff5e00;
                display: inline;
            }

            /* Paragraph */
            .clm-hero-paragraph {
                font-size: 13.5px;
                line-height: 1.7;
                color: #475569;
                max-width: 600px;
                margin-bottom: 24px;
            }
            @media (min-width: 1024px) {
                .clm-hero-paragraph {
                    font-size: 14.5px;
                }
            }

            /* Stat Cards Grid */
            .clm-stats-row {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                max-width: 620px;
            }
            @media (min-width: 640px) {
                .clm-stats-row {
                    grid-template-columns: repeat(4, 1fr);
                    gap: 12px;
                }
            }
            @media (min-width: 1024px) {
                .clm-stats-row {
                    gap: 14px;
                }
            }

            /* Individual Stat Card */
            .clm-stat-box {
                position: relative;
                background: #ffffff;
                border-radius: 18px;
                padding: 16px 10px 14px;
                text-align: center;
                border: 1px solid #eef2f6;
                box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
                cursor: default;
                overflow: hidden;
            }
            .clm-stat-box::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #ff5e00, #ff944d);
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .clm-stat-box:hover {
                transform: translateY(-5px);
                border-color: #ffd8bd;
                box-shadow: 0 14px 30px rgba(255, 94, 0, 0.12), 0 2px 6px rgba(0, 0, 0, 0.03);
            }
            .clm-stat-box:hover::before {
                opacity: 1;
            }

            .clm-stat-icon-circle {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                background: linear-gradient(135deg, #fff3ea 0%, #ffe5d3 100%);
                border: 1px solid rgba(255, 94, 0, 0.14);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ff5e00;
                margin-bottom: 10px;
                transition: all 0.35s ease;
                box-shadow: 0 2px 8px rgba(255, 94, 0, 0.08);
            }
            .clm-stat-box:hover .clm-stat-icon-circle {
                transform: scale(1.1) rotate(3deg);
                background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%);
                color: #ffffff !important;
                box-shadow: 0 6px 18px rgba(255, 94, 0, 0.35);
            }

            .clm-stat-val {
                font-size: 24px;
                font-weight: 900;
                line-height: 1.1;
                color: #ff5e00;
                letter-spacing: -0.02em;
            }
            @media (min-width: 640px) {
                .clm-stat-val {
                    font-size: 26px;
                }
            }

            .clm-stat-lbl {
                font-size: 12px;
                font-weight: 600;
                color: #64748b;
                margin-top: 5px;
                line-height: 1.25;
            }

            /* Bottom Brand Slogan */
            .clm-brand-footer {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-top: 24px;
                padding-top: 4px;
            }
            .clm-brand-footer-bar {
                width: 32px;
                height: 3px;
                background: linear-gradient(90deg, #ff5e00, #ff8c3a);
                border-radius: 9999px;
            }
            .clm-brand-footer-text {
                font-size: 11px;
                font-weight: 800;
                letter-spacing: 0.12em;
                color: #94a3b8;
                text-transform: uppercase;
            }
        </style>

        <!-- Main Content Container -->
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-9 relative z-10">
            <div class="clm-banner-grid">
                
                <!-- ==================== CỘT TRÁI: TEXT & STAT CARDS (HOÀN TOÀN BẰNG CODE) ==================== -->
                <div class="clm-banner-left text-left">
                    
                    <!-- 1. Breadcrumb Navigation (Code HTML chuẩn SEO) -->
                    <nav class="flex items-center gap-1.5 text-xs sm:text-[13px] font-medium text-slate-500 mb-3" aria-label="Breadcrumb">
                        <a href="{{ route('home') }}" class="hover:text-[#ff5e00] transition-colors">Trang chủ</a>
                        <span class="text-slate-400 font-normal">&gt;</span>
                        <a href="{{ route('about') }}" class="hover:text-[#ff5e00] transition-colors">Về chúng tôi</a>
                        <span class="text-slate-400 font-normal">&gt;</span>
                        <span class="font-semibold text-[#ff5e00]">Khách hàng tiêu biểu</span>
                    </nav>

                    <!-- 2. Badge Tag: KHÁCH HÀNG TIÊU BIỂU (Cam rực rỡ theo Mockup) -->
                    <div>
                        <div class="clm-pill-badge" style="background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%); color: #ffffff;">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                            </svg>
                            <span>KHÁCH HÀNG TIÊU BIỂU</span>
                        </div>
                    </div>

                    <!-- 3. Headline H1 (Typography chuẩn Mockup) -->
                    <h1 class="clm-hero-h1">
                        Đồng Hành Cùng Hàng Trăm <br class="hidden sm:inline">
                        <span class="clm-orange-text" style="color: #ff5e00;">Thương Hiệu Tạo Nên</span> <span class="clm-orange-text" style="color: #ea580c;">Giá Trị Thật</span>
                    </h1>

                    <!-- 4. Paragraph Description -->
                    <p class="clm-hero-paragraph">
                        Truyền Thông Cửu Long tự hào là đối tác tin cậy của nhiều doanh nghiệp, thương hiệu lớn nhỏ trên khắp cả nước. Chúng tôi không chỉ cung cấp dịch vụ mà còn đồng hành cùng khách hàng trong hành trình phát triển bền vững.
                    </p>

                    <!-- 5. 4 Stat Cards Row (Thiết kế Card nổi bật có hiệu ứng Glow & Icon Badge) -->
                    <div class="clm-stats-row">
                        
                        <!-- Card 1: 500+ Khách hàng -->
                        <div class="clm-stat-box group">
                            <div class="clm-stat-icon-circle" style="background: linear-gradient(135deg, #fff3ea 0%, #ffe5d3 100%); color: #ff5e00;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="clm-stat-val" style="color: #ff5e00;">500+</span>
                            <span class="clm-stat-lbl">Khách hàng</span>
                        </div>

                        <!-- Card 2: 98% Hài lòng -->
                        <div class="clm-stat-box group">
                            <div class="clm-stat-icon-circle" style="background: linear-gradient(135deg, #fff3ea 0%, #ffe5d3 100%); color: #ff5e00;">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </div>
                            <span class="clm-stat-val" style="color: #ff5e00;">98%</span>
                            <span class="clm-stat-lbl">Hài lòng</span>
                        </div>

                        <!-- Card 3: 1.000+ Dự án -->
                        <div class="clm-stat-box group">
                            <div class="clm-stat-icon-circle" style="background: linear-gradient(135deg, #fff3ea 0%, #ffe5d3 100%); color: #ff5e00;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <span class="clm-stat-val" style="color: #ff5e00;">1.000+</span>
                            <span class="clm-stat-lbl">Dự án đã thực hiện</span>
                        </div>

                        <!-- Card 4: 5+ Năm đồng hành -->
                        <div class="clm-stat-box group">
                            <div class="clm-stat-icon-circle" style="background: linear-gradient(135deg, #fff3ea 0%, #ffe5d3 100%); color: #ff5e00;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="clm-stat-val" style="color: #ff5e00;">5+</span>
                            <span class="clm-stat-lbl">Năm đồng hành</span>
                        </div>

                    </div>

                    <!-- 6. Bottom Brand Slogan (Theo chuẩn Mockup) -->
                    <div class="clm-brand-footer select-none">
                        <div class="clm-brand-footer-bar"></div>
                        <span class="clm-brand-footer-text">
                            TRUYỀN THÔNG CỬU LONG &nbsp;|&nbsp; ĐỒNG HÀNH CÙNG SỰ PHÁT TRIỂN CỦA BẠN
                        </span>
                    </div>

                </div>

                <!-- ==================== CỘT PHẢI: KHỐI HÌNH ẢNH BANNER NGHỆ THUẬT ==================== -->
                <div class="clm-banner-right select-none">
                    <div class="relative w-full max-w-[560px] lg:max-w-[620px] xl:max-w-[650px] flex items-center justify-center lg:justify-end">
                        <img src="{{ asset('images/clients/hero_showcase.png') }}?v={{ file_exists(public_path('images/clients/hero_showcase.png')) ? filemtime(public_path('images/clients/hero_showcase.png')) : time() }}" 
                             alt="Khách hàng là trung tâm & Đối tác chiến lược - Truyền Thông Cửu Long" 
                             class="w-full h-auto max-h-[380px] sm:max-h-[420px] lg:max-h-[460px] object-contain drop-shadow-[0_12px_32px_rgba(0,0,0,0.06)] transition-transform duration-500 hover:scale-[1.01]"
                             loading="eager"
                             fetchpriority="high">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== SECTION 2: KHÁCH HÀNG CHIẾN LƯỢC & ĐỒNG HÀNH ==================== -->
    @php
        $clientLogos = range(1, 48);
        $logoVersion = file_exists(public_path('images/logoKhachHang/1.png')) 
            ? filemtime(public_path('images/logoKhachHang/1.png')) 
            : time();
    @endphp
    <section class="pt-16 sm:pt-20 pb-20 sm:pb-24 lg:pb-28 relative overflow-hidden border-t border-slate-100" id="strategic-clients" style="background: linear-gradient(180deg, #ffffff 0%, #fffdfa 55%, #fff9f3 100%);">
        
        <!-- 1. Top-Right Decorative Accent: Dot Grid & Faint Warm Skyline -->
        <div class="pointer-events-none absolute top-0 right-0 w-72 sm:w-96 lg:w-[480px] h-64 sm:h-80 select-none overflow-hidden opacity-35 z-0" aria-hidden="true">
            <svg class="w-full h-full" fill="none">
                <defs>
                    <pattern id="dotPatternStrategic" x="0" y="0" width="18" height="18" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1.3" fill="#ff7a18" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dotPatternStrategic)" />
            </svg>
        </div>

        <!-- 2. Bottom Dual Curved Orange Waves (Concave Cradle Sweep matching mockup) -->
        <div class="pointer-events-none absolute bottom-0 left-0 right-0 w-full h-28 sm:h-36 lg:h-44 select-none overflow-hidden z-0" aria-hidden="true">
            <svg viewBox="0 0 1440 180" fill="none" class="w-full h-full" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="waveCurveLeft" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5e00" stop-opacity="0.95" />
                        <stop offset="55%" stop-color="#ff7a18" stop-opacity="0.85" />
                        <stop offset="100%" stop-color="#ffa057" stop-opacity="0.2" />
                    </linearGradient>
                    <linearGradient id="waveCurveRight" x1="100%" y1="100%" x2="0%" y2="0%">
                        <stop offset="0%" stop-color="#ffa057" stop-opacity="0.75" />
                        <stop offset="50%" stop-color="#ffc28d" stop-opacity="0.4" />
                        <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <!-- Right soft golden wave -->
                <path d="M1440 180 L1440 40 C1250 50 1000 130 720 160 C500 180 200 180 0 180 Z" fill="url(#waveCurveRight)" />
                <!-- Left vibrant orange wave -->
                <path d="M0 180 L0 30 C180 40 420 120 720 160 C1000 175 1300 180 1440 180 Z" fill="url(#waveCurveLeft)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header (Đồng bộ chuẩn xác theo Mockup) -->
            <div class="text-center max-w-4xl mx-auto mb-10 sm:mb-12">
                
                <!-- Badge Tag: ĐỐI TÁC & KHÁCH HÀNG CHIẾN LƯỢC -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#fff2e8] border border-orange-200/80 shadow-2xs mb-3.5">
                    <span class="text-base sm:text-lg">🤝</span>
                    <span class="text-xs sm:text-[13px] font-extrabold uppercase tracking-widest text-[#ea580c]">
                        ĐỐI TÁC &amp; KHÁCH HÀNG CHIẾN LƯỢC
                    </span>
                </div>

                <!-- Headline H2 -->
                <h2 class="text-2xl sm:text-3xl lg:text-[38px] font-black text-[#0f172a] leading-tight tracking-tight mt-1">
                    Khách Hàng Chiến Lược &bull; Khách Hàng Đồng Hành <br class="hidden sm:inline">
                    <span style="color: #ff5e00;">Cùng Truyền Thông Cửu Long</span>
                </h2>

                <!-- Subtitle Paragraph -->
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-3.5 max-w-2xl mx-auto font-body">
                    Chúng tôi tự hào đồng hành cùng hơn 500+ doanh nghiệp, thương hiệu và tập đoàn hàng đầu trong đa dạng lĩnh vực, mang lại những giải pháp chuyển đổi số và sản xuất truyền thông đột phá.
                </p>
            </div>

        </div>

        <!-- Marquee Cuộn Vô Tận (Thẻ bo góc lớn trắng nổi bật chuẩn Mockup) -->
        <div class="marquee-container relative w-full overflow-hidden flex items-center py-4 [mask-image:linear-gradient(to_right,transparent,black_48px,black_calc(100%-48px),transparent)] [-webkit-mask-image:linear-gradient(to_right,transparent,black_48px,black_calc(100%-48px),transparent)] z-10">
            <div class="marquee-track flex items-center gap-4 sm:gap-5 shrink-0" style="animation-duration: 85s;" aria-label="Danh sách 48 logo khách hàng đồng hành">
                {{-- Dải phần tử gốc --}}
                @foreach($clientLogos as $logo)
                    <div class="inline-flex items-center justify-center p-3 sm:p-4 rounded-2xl sm:rounded-3xl bg-white border border-slate-100 shadow-[0_6px_22px_rgba(0,0,0,0.04)] hover:border-[#ff5e00]/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group shrink-0 h-24 sm:h-[115px] w-38 sm:w-[185px]">
                        <img src="{{ asset('images/logoKhachHang/' . $logo . '.png') }}?v={{ $logoVersion }}"
                             alt="Logo đối tác Truyền Thông Cửu Long {{ $logo }}"
                             class="h-14 sm:h-[75px] w-auto max-w-[125px] sm:max-w-[150px] object-contain group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>
                @endforeach
                {{-- Dải nhân đôi phục vụ hiệu ứng lặp CSS vô tận --}}
                @foreach($clientLogos as $logo)
                    <div class="inline-flex items-center justify-center p-3 sm:p-4 rounded-2xl sm:rounded-3xl bg-white border border-slate-100 shadow-[0_6px_22px_rgba(0,0,0,0.04)] hover:border-[#ff5e00]/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group shrink-0 h-24 sm:h-[115px] w-38 sm:w-[185px]" aria-hidden="true">
                        <img src="{{ asset('images/logoKhachHang/' . $logo . '.png') }}?v={{ $logoVersion }}"
                             alt=""
                             class="h-14 sm:h-[75px] w-auto max-w-[125px] sm:max-w-[150px] object-contain group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Khối Mở Rộng Xem Lưới 48 Thương Hiệu (Nút Pill Badge chuẩn Mockup) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 sm:mt-8 relative z-10">
            <div class="text-center">
                <button type="button" 
                        @click="showAllLogos = !showAllLogos"
                        class="inline-flex items-center gap-2.5 px-6 py-2.5 rounded-full bg-white hover:bg-orange-50/50 border border-orange-200 hover:border-orange-300 shadow-[0_4px_16px_rgba(0,0,0,0.04)] hover:shadow-md transition-all group">
                    <span class="w-6 h-6 rounded-full bg-[#ff5e00] flex items-center justify-center text-white text-xs shrink-0 shadow-xs">
                        👥
                    </span>
                    <span class="text-xs sm:text-sm font-bold text-slate-700 group-hover:text-[#ff5e00] transition-colors"
                          x-text="showAllLogos ? 'Thu gọn lưới thương hiệu' : 'Xem toàn bộ lưới thương hiệu tiêu biểu'"></span>
                    <svg class="w-4 h-4 text-[#ff5e00] transition-transform duration-300" :class="{ 'rotate-180': showAllLogos }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <div x-show="showAllLogos" 
                 x-collapse
                 x-cloak
                 class="pt-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3.5 sm:gap-4">
                    @foreach($clientLogos as $logo)
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] h-20 sm:h-24 flex items-center justify-center p-3 sm:p-4 hover:shadow-md hover:border-orange-200 hover:-translate-y-1 transition-all duration-300 group">
                            <img src="{{ asset('images/logoKhachHang/' . $logo . '.png') }}?v={{ $logoVersion }}"
                                 alt="Đối tác {{ $logo }}" 
                                 class="max-h-12 sm:max-h-14 w-auto max-w-[85%] object-contain group-hover:scale-105 transition-transform duration-300"
                                 loading="lazy">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 3. Dải 4 Chỉ Số Thống Kê Điểm Nhấn (Nằm trên nền trắng ngay trên vệt sóng cam theo đúng Mockup) -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 mt-10 sm:mt-12">
            <div class="flex flex-wrap items-center justify-center sm:justify-between gap-6 sm:gap-4 py-4 px-6 sm:px-8 bg-white/85 backdrop-blur-xs rounded-2xl border border-slate-100 shadow-[0_4px_22px_rgba(0,0,0,0.03)]">
                
                <!-- Stat 1: 500+ Doanh nghiệp đối tác -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-2xs" style="background-color: #fff2ea !important; color: #ff5e00 !important;">
                        <svg class="w-5 h-5" fill="none" stroke="#ff5e00" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg sm:text-xl font-black leading-none" style="color: #ff5e00 !important;">500+</div>
                        <div class="text-[11px] sm:text-xs font-semibold text-slate-500 mt-1">Doanh nghiệp đối tác</div>
                    </div>
                </div>

                <div class="hidden sm:block w-[1px] h-8 bg-slate-200"></div>

                <!-- Stat 2: 98% Khách hàng hài lòng -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-2xs" style="background-color: #fff2ea !important; color: #ff5e00 !important;">
                        <svg class="w-5 h-5" fill="#ff5e00" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg sm:text-xl font-black leading-none" style="color: #ff5e00 !important;">98%</div>
                        <div class="text-[11px] sm:text-xs font-semibold text-slate-500 mt-1">Khách hàng hài lòng</div>
                    </div>
                </div>

                <div class="hidden sm:block w-[1px] h-8 bg-slate-200"></div>

                <!-- Stat 3: 1000+ Dự án đã thực hiện -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-2xs" style="background-color: #fff2ea !important; color: #ff5e00 !important;">
                        <svg class="w-5 h-5" fill="none" stroke="#ff5e00" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg sm:text-xl font-black leading-none" style="color: #ff5e00 !important;">1000+</div>
                        <div class="text-[11px] sm:text-xs font-semibold text-slate-500 mt-1">Dự án đã thực hiện</div>
                    </div>
                </div>

                <div class="hidden sm:block w-[1px] h-8 bg-slate-200"></div>

                <!-- Stat 4: 5+ Năm đồng hành -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-2xs" style="background-color: #fff2ea !important; color: #ff5e00 !important;">
                        <svg class="w-5 h-5" fill="none" stroke="#ff5e00" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg sm:text-xl font-black leading-none" style="color: #ff5e00 !important;">5+</div>
                        <div class="text-[11px] sm:text-xs font-semibold text-slate-500 mt-1">Năm đồng hành</div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <!-- ==================== SECTION 3: DỰ ÁN THÀNH CÔNG THỰC TẾ (CSDL MEDIA & WEB/APP) ==================== -->
    @php
        // Lấy danh sách dự án CaseStudy từ CSDL
        $allDbCases = (isset($caseStudies) && $caseStudies->count() > 0) 
            ? $caseStudies 
            : \App\Models\CaseStudy::orderBy('order')->orderBy('id', 'desc')->get();

        // 5 Dự án tiêu biểu KHÔNG TRÙNG LẶP theo đúng thiết kế Mockup:
        // 1. Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa (Web & App)
        // 2. Website Phòng Khám Đa Khoa Chuẩn WordPress (Website - chỉ 1 mục duy nhất)
        // 3. TVC Quảng Cáo Ngân Hàng Sacombank (Media)
        // 4. Phim Doanh Nghiệp Hoya Lens (Media)
        // 5. Website Tui Là Người Miền Tây (Website)
        $targetProjectsConfig = [
            [
                'slug' => 'ung-dung-quan-ly-phong-kham',
                'badge' => 'Web & App',
                'badge_icon' => 'laptop',
                'group' => 'technology',
                'default_title' => 'Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa',
                'default_summary' => 'Xây dựng hệ thống Web App quản trị y tế tập trung, tối ưu quy trình đặt lịch trực tuyến...',
                'default_img' => asset('images/projects/clinic-app-mockup.jpg'),
            ],
            [
                'slug' => 'website-phong-kham-da-khoa',
                'badge' => 'Website',
                'badge_icon' => 'globe',
                'group' => 'technology',
                'default_title' => 'Website Phòng Khám Đa Khoa Chuẩn WordPress',
                'default_summary' => 'Hệ thống website y khoa chuẩn WordPress được tùy biến giao diện chuyên nghiệp, chuẩn SEO.',
                'default_img' => asset('images/projects/clinic-website-wp.png'),
            ],
            [
                'slug' => 'tvc-quang-cao-sacombank',
                'badge' => 'Media',
                'badge_icon' => 'video',
                'group' => 'media',
                'default_title' => 'TVC Quảng Cáo Ngân Hàng Sacombank',
                'default_summary' => 'Sản xuất video TVC quảng cáo chuyên nghiệp cho chiến dịch thẻ tín dụng mới.',
                'default_img' => asset('images/projects/sacombank-media-thumb.jpg'),
            ],
            [
                'slug' => 'phim-doanh-nghiep-hoya',
                'badge' => 'Media',
                'badge_icon' => 'video',
                'group' => 'media',
                'default_title' => 'Phim Doanh Nghiệp Hoya Lens',
                'default_summary' => 'Video giới thiệu quy trình sản xuất tròng kính Nhật Bản.',
                'default_img' => asset('images/projects/hoyalens-media-thumb.jpg'),
            ],
            [
                'slug' => 'website-tui-la-nguoi-mien-tay',
                'badge' => 'Website',
                'badge_icon' => 'globe',
                'group' => 'technology',
                'default_title' => 'Website Tui Là Người Miền Tây',
                'default_summary' => 'Nền tảng truyền thông cộng đồng và chia sẻ nét đẹp văn hóa, ẩm thực miền Tây trên WordPress.',
                'default_img' => asset('images/projects/web_tuilanguoimientay.jpg'),
            ],
        ];

        // Lấy đúng slug CSDL, TUYỆT ĐỐI không tìm mờ keyword để loại bỏ hoàn toàn trùng lặp
        $featuredProjects = collect($targetProjectsConfig)->map(function ($cfg) use ($allDbCases) {
            $dbItem = $allDbCases->firstWhere('slug', $cfg['slug']);

            $title = $dbItem?->title ?? $cfg['default_title'];
            if ($cfg['slug'] === 'website-tui-la-nguoi-mien-tay') {
                $title = 'Website Tui Là Người Miền Tây';
            }

            return (object)[
                'title' => $title,
                'slug' => $dbItem?->slug ?? $cfg['slug'],
                'client_name' => $dbItem?->client_name ?? 'Tui Là Người Miền Tây',
                'group' => $dbItem?->group ?? $cfg['group'],
                'badge' => $cfg['badge'],
                'badge_icon' => $cfg['badge_icon'],
                'summary' => $dbItem?->summary ?? $cfg['default_summary'],
                'cover_image_url' => $dbItem?->cover_image_url ?: $cfg['default_img'],
                'url' => route('projects.show', $dbItem?->slug ?? $cfg['slug']),
            ];
        });
    @endphp

    <section class="py-16 sm:py-20 lg:py-24 bg-white relative overflow-hidden" id="featured-projects">
        
        <!-- Scoped CSS: Đảm bảo 100% không bị tệp màu và không bị vỡ 5 cột trên màn hình Desktop -->
        <style>
            .clm-sec3-grid {
                display: grid;
                grid-template-columns: repeat(1, minmax(0, 1fr));
                gap: 1rem;
            }
            @media (min-width: 640px) {
                .clm-sec3-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 1rem;
                }
            }
            @media (min-width: 1024px) {
                .clm-sec3-grid {
                    grid-template-columns: repeat(5, minmax(0, 1fr));
                    gap: 0.85rem;
                }
            }

            .clm-filter-tab {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.6rem 1.4rem;
                border-radius: 9999px;
                font-size: 0.8125rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.25s ease;
                border: 1px solid #cbd5e1;
                background-color: #ffffff;
                color: #334155;
            }
            .clm-filter-tab:hover {
                border-color: #ff9d5c;
                color: #ff5e00;
                background-color: #fffaf5;
            }
            .clm-filter-tab.is-active {
                background-color: #ff5e00 !important;
                color: #ffffff !important;
                border-color: #ff5e00 !important;
                box-shadow: 0 4px 14px rgba(255, 94, 0, 0.35) !important;
            }
            .clm-filter-tab.is-active svg {
                color: #ffffff !important;
            }
            .clm-filter-tab.is-active span {
                color: #ffffff !important;
            }

            .clm-project-card {
                background-color: #ffffff;
                border-radius: 1.25rem;
                padding: 0.875rem;
                border: 1px solid #e2e8f0;
                box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .clm-project-card:hover {
                border-color: #ffd8be;
                box-shadow: 0 12px 28px rgba(255, 94, 0, 0.1);
                transform: translateY(-4px);
            }

            .clm-card-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.375rem;
                padding: 0.2rem 0.625rem;
                border-radius: 9999px;
                background-color: rgba(255, 255, 255, 0.96);
                backdrop-filter: blur(4px);
                border: 1px solid #ffd8be;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            }
            .clm-badge-icon {
                width: 1.125rem;
                height: 1.125rem;
                border-radius: 9999px;
                background-color: #ff5e00;
                color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }
            .clm-badge-text {
                font-size: 0.6875rem;
                font-weight: 700;
                color: #ff5e00;
                white-space: nowrap;
            }

            .clm-stat-strip-box {
                max-width: 56rem;
                margin-left: auto;
                margin-right: auto;
                margin-top: 2.75rem;
                background-color: #ffffff;
                border-radius: 9999px;
                border: 1px solid #ffd8be;
                box-shadow: 0 4px 20px rgba(255, 94, 0, 0.07);
                padding: 0.875rem 1.75rem;
            }
            @media (max-width: 640px) {
                .clm-stat-strip-box {
                    border-radius: 1.25rem;
                    padding: 1rem;
                }
            }
            .clm-stat-icon-wrap {
                width: 2.25rem;
                height: 2.25rem;
                border-radius: 0.75rem;
                background-color: #fff2ea;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ff5e00;
                flex-shrink: 0;
            }
            .clm-stat-number {
                font-size: 1.125rem;
                font-weight: 900;
                color: #ff5e00;
                line-height: 1;
            }
            .clm-stat-desc {
                font-size: 0.75rem;
                font-weight: 600;
                color: #64748b;
                margin-top: 0.25rem;
            }
        </style>
        
        <!-- Decorative Vector: Top-Left Orange Curve -->
        <div class="absolute top-0 left-0 w-64 sm:w-80 md:w-[420px] pointer-events-none select-none z-0">
            <svg viewBox="0 0 420 220" fill="none" class="w-full h-auto">
                <defs>
                    <linearGradient id="sec3CurveTL" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#ff5e00" stop-opacity="0.85"/>
                        <stop offset="45%" stop-color="#ff8838" stop-opacity="0.45"/>
                        <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M0,0 L360,0 C280,45 200,95 130,150 C70,195 25,215 0,220 Z" fill="url(#sec3CurveTL)"/>
            </svg>
        </div>

        <!-- Decorative Vector: Bottom-Left Dot Matrix Pattern -->
        <div class="absolute bottom-6 sm:bottom-10 left-4 sm:left-10 pointer-events-none select-none opacity-30 z-0">
            <svg width="140" height="70" viewBox="0 0 140 70" fill="none">
                <pattern id="dotGridSec3" x="0" y="0" width="16" height="16" patternUnits="userSpaceOnUse">
                    <circle cx="3" cy="3" r="1.8" fill="#ff7a1a"/>
                </pattern>
                <rect width="140" height="70" fill="url(#dotGridSec3)"/>
            </svg>
        </div>

        <!-- Decorative Vector: Bottom-Right Curved Orange Wave -->
        <div class="absolute bottom-0 right-0 w-72 sm:w-96 md:w-[480px] pointer-events-none select-none z-0">
            <svg viewBox="0 0 480 220" fill="none" class="w-full h-auto">
                <defs>
                    <linearGradient id="sec3CurveBR" x1="100%" y1="100%" x2="0%" y2="0%">
                        <stop offset="0%" stop-color="#ff5e00" stop-opacity="0.85"/>
                        <stop offset="50%" stop-color="#ff8a3d" stop-opacity="0.45"/>
                        <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M480,220 L180,220 C260,185 340,140 400,80 C440,35 465,10 480,0 Z" fill="url(#sec3CurveBR)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header (Rocket badge + Two-tone H2 + Subtitle) -->
            <div class="text-center max-w-3xl mx-auto mb-9 sm:mb-11">
                <div class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide border shadow-2xs"
                     style="background-color: #fff3ea; border-color: #ffd8be; color: #ff5e00;">
                    <span>🚀</span>
                    <span>DỰ ÁN THÀNH CÔNG</span>
                </div>
                
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-[40px] font-black tracking-tight mt-3">
                    <span style="color: #0f172a;">Dự Án </span><span style="color: #ff5e00;">Thành Công Thực Tế</span>
                </h2>
                
                <p class="font-body text-slate-500 text-xs sm:text-[13.5px] leading-relaxed mt-2.5 max-w-2xl mx-auto">
                    Mỗi dự án là một câu chuyện hợp tác thực tế, khẳng định năng lực số hóa Web/App và sản xuất truyền thông Media chuyên nghiệp của chúng tôi.
                </p>
            </div>

            <!-- Tab Filter Buttons (3 tabs, no numbers, matching mockup, color guaranteed) -->
            <div class="flex items-center justify-center flex-wrap gap-3 mb-10">
                <!-- Tab: Tất cả dự án -->
                <button type="button"
                        @click="activeProjectTab = 'all'" 
                        class="clm-filter-tab"
                        :class="{ 'is-active': activeProjectTab === 'all' }"
                        :style="activeProjectTab === 'all' ? 'background-color: #ff5e00 !important; color: #ffffff !important; border-color: #ff5e00 !important; box-shadow: 0 4px 14px rgba(255, 94, 0, 0.35) !important;' : ''">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 4h4v4H4V4zm6 0h4v4h-4V4zm6 0h4v4h-4V4zM4 10h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 16h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"/>
                    </svg>
                    <span>Tất cả dự án</span>
                </button>

                <!-- Tab: Dự Án Web / App -->
                <button type="button"
                        @click="activeProjectTab = 'technology'" 
                        class="clm-filter-tab"
                        :class="{ 'is-active': activeProjectTab === 'technology' }"
                        :style="activeProjectTab === 'technology' ? 'background-color: #ff5e00 !important; color: #ffffff !important; border-color: #ff5e00 !important; box-shadow: 0 4px 14px rgba(255, 94, 0, 0.35) !important;' : ''">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Dự Án Web / App</span>
                </button>

                <!-- Tab: Dự Án Media -->
                <button type="button"
                        @click="activeProjectTab = 'media'" 
                        class="clm-filter-tab"
                        :class="{ 'is-active': activeProjectTab === 'media' }"
                        :style="activeProjectTab === 'media' ? 'background-color: #ff5e00 !important; color: #ffffff !important; border-color: #ff5e00 !important; box-shadow: 0 4px 14px rgba(255, 94, 0, 0.35) !important;' : ''">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-2.5l4 2.5a1 1 0 001.5-.86V7.86a1 1 0 00-1.5-.86L16 9.5V8a2 2 0 00-2-2H4z" />
                    </svg>
                    <span>Dự Án Media</span>
                </button>
            </div>

            <!-- Dynamic 5 Featured Projects Grid (All 5 in 1 row on Desktop >= 1024px) -->
            <div class="clm-sec3-grid">
                @foreach($featuredProjects as $project)
                <div x-show="activeProjectTab === 'all' || activeProjectTab === '{{ $project->group }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="clm-project-card group">
                    
                    <div>
                        <!-- Thumbnail with Bottom-Left Category Pill -->
                        <div class="relative rounded-xl overflow-hidden aspect-[16/10] bg-slate-100 mb-3">
                            <img src="{{ $project->cover_image_url }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 loading="lazy">
                            
                            <!-- Category Badge overlaid at bottom-left -->
                            <div class="absolute bottom-2 left-2 z-10">
                                <div class="clm-card-badge">
                                    <div class="clm-badge-icon">
                                        @if($project->badge_icon === 'globe')
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8M3.6 15h16.8" />
                                            </svg>
                                        @elseif($project->badge_icon === 'video')
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M4 6a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-2.5l4 2.5a1 1 0 001.5-.86V7.86a1 1 0 00-1.5-.86L16 9.5V8a2 2 0 00-2-2H4z" />
                                            </svg>
                                        @else
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="clm-badge-text">{{ $project->badge }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Project Title -->
                        <h3 class="font-headline font-bold text-[13.5px] sm:text-[14px] text-slate-900 group-hover:text-[#ff5e00] transition-colors leading-snug line-clamp-2 min-h-[38px]">
                            <a href="{{ $project->url }}">
                                {{ $project->title }}
                            </a>
                        </h3>

                        <!-- Project Summary -->
                        <p class="font-body text-[11.5px] text-slate-500 leading-relaxed mt-1.5 line-clamp-2 min-h-[34px]">
                            {{ $project->summary }}
                        </p>
                    </div>

                    <!-- Footer Link: Xem chi tiết dự án -->
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center">
                        <a href="{{ $project->url }}" class="inline-flex items-center gap-1 font-headline font-bold text-[11.5px] sm:text-[12px] text-slate-700 group-hover:text-[#ff5e00] transition-colors">
                            <span>Xem chi tiết dự án</span>
                            <span style="color: #ff5e00;" class="font-black group-hover:translate-x-0.5 transition-transform">→</span>
                        </a>
                    </div>

                </div>
                @endforeach
            </div>

            <!-- Bottom Floating Stat Strip (Matching Mockup with Guaranteed Colors) -->
            <div class="clm-stat-strip-box">
                <div class="flex flex-wrap items-center justify-around gap-4 sm:gap-6">
                    
                    <!-- Stat 1: 500+ Dự án đã triển khai -->
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="clm-stat-icon-wrap">
                            <svg class="w-5 h-5" fill="none" stroke="#ff5e00" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <div class="clm-stat-number">500+</div>
                            <div class="clm-stat-desc">Dự án đã triển khai</div>
                        </div>
                    </div>

                    <div class="hidden sm:block w-px h-7 bg-slate-200"></div>

                    <!-- Stat 2: 98% Khách hàng hài lòng -->
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="clm-stat-icon-wrap">
                            <svg class="w-5 h-5" fill="none" stroke="#ff5e00" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="clm-stat-number">98%</div>
                            <div class="clm-stat-desc">Khách hàng hài lòng</div>
                        </div>
                    </div>

                    <div class="hidden sm:block w-px h-7 bg-slate-200"></div>

                    <!-- Stat 3: 1000+ Dự án đa lĩnh vực -->
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="clm-stat-icon-wrap">
                            <svg class="w-5 h-5" fill="none" stroke="#ff5e00" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <div class="clm-stat-number">1000+</div>
                            <div class="clm-stat-desc">Dự án đa lĩnh vực</div>
                        </div>
                    </div>

                    <div class="hidden sm:block w-px h-7 bg-slate-200"></div>

                    <!-- Stat 4: 5+ Năm đồng hành -->
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="clm-stat-icon-wrap">
                            <svg class="w-5 h-5" fill="none" stroke="#ff5e00" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="clm-stat-number">5+</div>
                            <div class="clm-stat-desc">Năm đồng hành</div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Hub links to Media & Web/App pages -->
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('projects.index') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-white border border-slate-200 text-slate-800 font-headline font-bold text-xs sm:text-sm hover:border-[#ff5e00] hover:text-[#ff5e00] hover:shadow-sm transition-all shadow-2xs">
                    <span class="material-symbols-outlined text-[18px] text-[#ff5e00]">devices</span>
                    <span>Toàn bộ dự án Web &amp; Phần Mềm</span>
                </a>
                <a href="{{ route('projects.media') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-white border border-slate-200 text-slate-800 font-headline font-bold text-xs sm:text-sm hover:border-[#ff5e00] hover:text-[#ff5e00] hover:shadow-sm transition-all shadow-2xs">
                    <span class="material-symbols-outlined text-[18px] text-rose-500">movie</span>
                    <span>Toàn bộ dự án Media, TVC &amp; Phim</span>
                </a>
            </div>

            <!-- Optional: Expand All Verified Clients (Smooth Accordion for SEO & Completeness) -->
            <div class="mt-14 text-center">
                <button type="button" 
                        @click="showAllClients = !showAllClients"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:text-[#ff5e00] hover:border-orange-300 hover:shadow-sm transition-all shadow-2xs">
                    <span x-text="showAllClients ? 'Thu gọn danh mục đối tác' : 'Xem toàn bộ 30+ khách hàng theo lĩnh vực'"></span>
                    <span class="material-symbols-outlined text-[18px] transition-transform duration-300" :class="{ 'rotate-180': showAllClients }">expand_more</span>
                </button>
            </div>

            <!-- Collapsible Full Client Directory -->
            <div x-show="showAllClients" 
                 x-collapse
                 x-cloak
                 class="mt-8 pt-8 border-t border-slate-200/80">
                
                <!-- Category Filter Tabs -->
                <div class="flex items-center justify-center flex-wrap gap-2 mb-8">
                    <button @click="activeCategory = 'all'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                            :class="activeCategory === 'all' ? 'bg-[#ff5e00] text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-50'">
                        Tất cả ({{ count($clients) }})
                    </button>
                    <button @click="activeCategory = 'finance'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                            :class="activeCategory === 'finance' ? 'bg-[#ff5e00] text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-50'">
                        Tài chính &amp; Ngân hàng
                    </button>
                    <button @click="activeCategory = 'tech'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                            :class="activeCategory === 'tech' ? 'bg-[#ff5e00] text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-50'">
                        Công nghệ &amp; Giải pháp số
                    </button>
                    <button @click="activeCategory = 'industry'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                            :class="activeCategory === 'industry' ? 'bg-[#ff5e00] text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-50'">
                        Nông nghiệp &amp; Sản xuất
                    </button>
                    <button @click="activeCategory = 'tourism'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                            :class="activeCategory === 'tourism' ? 'bg-[#ff5e00] text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-50'">
                        Du lịch &amp; Bán lẻ
                    </button>
                    <button @click="activeCategory = 'healthcare'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                            :class="activeCategory === 'healthcare' ? 'bg-[#ff5e00] text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-50'">
                        Y tế, Giáo dục &amp; Xã hội
                    </button>
                </div>

                @php
                $clientIcons = [
                    'finance' => 'account_balance',
                    'tech' => 'devices',
                    'industry' => 'domain',
                    'tourism' => 'flight_takeoff',
                    'healthcare' => 'local_hospital'
                ];
                $clientLabels = [
                    'finance' => 'Tài chính & Ngân hàng',
                    'tech' => 'Công nghệ & Giải pháp số',
                    'industry' => 'Nông nghiệp & Sản xuất',
                    'tourism' => 'Du lịch & Bán lẻ',
                    'healthcare' => 'Y tế, Giáo dục & Xã hội'
                ];
                @endphp

                <!-- Client Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($clients as $c)
                    <div x-show="activeCategory === 'all' || activeCategory === '{{ $c->industry_category }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-[#ff5e00]/50 hover:shadow-sm transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-orange-50 text-[#ff5e00] border border-orange-200 flex items-center justify-center group-hover:bg-[#ff5e00] group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">{{ $clientIcons[$c->industry_category] ?? 'business' }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 border border-slate-200 font-mono text-[9px] text-slate-500 font-medium">
                                    {{ $clientLabels[$c->industry_category] ?? 'Doanh nghiệp' }}
                                </span>
                            </div>
                            <h4 class="font-headline text-sm font-bold text-slate-900 group-hover:text-[#ff5e00] transition-colors line-clamp-1">
                                {{ $c->name }}
                            </h4>
                            <p class="font-body text-xs text-slate-500 mt-1 line-clamp-2">
                                Giải pháp: <span class="text-slate-700 font-medium">{{ $c->service_used }}</span>
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-[11px] font-mono text-slate-400">
                            <span class="inline-flex items-center gap-1 text-emerald-600 font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Đã nghiệm thu
                            </span>
                            <span class="text-[#ff5e00] font-bold">Đối tác thật</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- ==================== SECTION 4: CALL TO ACTION (WAVE ORANGE BANNER) ==================== -->
    <section class="relative w-full overflow-hidden text-white" id="client-cta" style="background-color: #fafbfc;">
        <!-- SVG Curved Wave Transition at Top -->
        <div class="w-full overflow-hidden leading-none -mb-1">
            <svg class="w-full h-12 sm:h-18 lg:h-22 block" viewBox="0 0 1440 80" fill="none" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="ctaWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5e00"/>
                        <stop offset="50%" stop-color="#ff6814"/>
                        <stop offset="100%" stop-color="#ff7a29"/>
                    </linearGradient>
                </defs>
                <path d="M0,38 C300,82 620,86 940,46 C1160,18 1320,12 1440,32 L1440,80 L0,80 Z" fill="url(#ctaWaveGradient)"></path>
            </svg>
        </div>

        <!-- Main Banner Background with Vibrant Gradient -->
        <div class="w-full py-12 lg:py-16 relative" style="background: linear-gradient(135deg, #ff5e00 0%, #ff6814 50%, #ff7a29 100%); background-color: #ff5e00;">
            <!-- Decorative subtle ambient glows -->
            <div class="pointer-events-none absolute left-10 top-0 w-72 h-72 rounded-full bg-white/10 blur-2xl"></div>
            <div class="pointer-events-none absolute right-10 bottom-0 w-96 h-96 rounded-full bg-amber-300/25 blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-12">
                    
                    <!-- Left: Handshake Icon & Message -->
                    <div class="flex items-start sm:items-center gap-4 sm:gap-6 max-w-2xl text-left">
                        <!-- Translucent Handshake Icon Box -->
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-inner" style="background-color: rgba(255, 255, 255, 0.22); border: 1px solid rgba(255, 255, 255, 0.4);">
                            <span class="material-symbols-outlined text-[30px] sm:text-[34px]">handshake</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="font-headline text-xs font-bold uppercase tracking-wider text-white" style="color: rgba(255, 255, 255, 0.95);">
                                SẴN SÀNG HỢP TÁC
                            </span>
                            <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight mt-1" style="color: #ffffff; text-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                Bạn Đang Tìm Một Đối Tác <br class="hidden sm:inline">
                                Truyền Thông Đáng Tin Cậy?
                            </h2>
                            <p class="font-body text-xs sm:text-sm leading-relaxed mt-2 max-w-xl text-white" style="color: rgba(255, 255, 255, 0.95);">
                                Hãy để Truyền Thông Cửu Long đồng hành cùng bạn trong hành trình xây dựng thương hiệu và phát triển kinh doanh bền vững.
                            </p>
                        </div>
                    </div>

                    <!-- Right: Action Button & Phone Contact -->
                    <div class="flex flex-col sm:flex-row lg:flex-col items-center sm:items-center lg:items-end gap-3 sm:gap-5 shrink-0 w-full sm:w-auto">
                        <!-- Action Button -->
                        <a href="{{ route('contact') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-white text-slate-900 font-headline font-bold text-sm hover:bg-orange-50 hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-md group">
                            <span>Liên hệ ngay</span>
                            <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>

                        <!-- Phone Hotline Row -->
                        <div class="flex items-center gap-2.5 text-white mt-1">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-white shrink-0" style="background-color: rgba(255, 255, 255, 0.22); border: 1px solid rgba(255, 255, 255, 0.4);">
                                <span class="material-symbols-outlined text-[18px]">phone_in_talk</span>
                            </div>
                            <div class="flex flex-col">
                                <a href="tel:0939363262" class="font-headline font-black text-xl sm:text-2xl text-white tracking-wide hover:text-amber-200 transition-colors leading-none" style="color: #ffffff;">
                                    0939.363.262
                                </a>
                                <span class="font-body text-[11px] font-medium mt-1 text-white" style="color: rgba(255, 255, 255, 0.9);">
                                    Tư vấn miễn phí 24/7
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "Khách Hàng Tiêu Biểu & Đối Tác Chiến Lược - Truyền Thông Cửu Long",
    "description": "Khám phá danh sách các đối tác, tập đoàn và doanh nghiệp đã tin tưởng đồng hành cùng Truyền Thông Cửu Long.",
    "url": "{{ route('clients') }}"
}
</script>
@endsection
