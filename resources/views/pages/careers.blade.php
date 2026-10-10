@extends('layouts.app')

@section('title', 'Tuyển Dụng & Gia Nhập Đội Ngũ - Truyền Thông Cửu Long')
@section('meta_description', 'Gia nhập đội ngũ Truyền Thông Cửu Long. Cùng kiến tạo những giá trị lớn trong môi trường chuyên nghiệp, sáng tạo và giàu cơ hội phát triển tại Cần Thơ & ĐBSCL.')

@section('content')
<div class="w-full bg-[#fbfcfd] text-slate-800" 
     x-data="{ 
         activeTab: 'all', 
         selectedJob: null,
         appliedPosition: '',
         selectJob(job) {
             this.selectedJob = job;
         },
         applyFor(positionName) {
             this.appliedPosition = positionName;
             const formElement = document.getElementById('apply-form-section');
             if (formElement) {
                 formElement.scrollIntoView({ behavior: 'smooth' });
                 const selectElem = document.getElementById('position-select');
                 if (selectElem) {
                     selectElem.value = positionName;
                 }
             }
         }
     }">

    <!-- ==========================================
         SECTION 1: HERO BANNER TUYỂN DỤNG (THIẾT KẾ ĐỒNG BỘ TRANG KHÁCH HÀNG)
    =========================================== -->
    <section class="relative w-full overflow-hidden border-b border-slate-200/80" id="hero-section" style="background: linear-gradient(135deg, #ffffff 0%, #fffdfa 45%, #fff8f2 100%);">
        
        <!-- Bottom-Right Orange Wave (Subtle background accent đồng bộ trang Khách Hàng) -->
        <div class="pointer-events-none absolute bottom-0 right-0 w-64 sm:w-96 lg:w-[460px] h-40 sm:h-60 lg:h-72 z-0 select-none overflow-hidden opacity-90" aria-hidden="true">
            <svg viewBox="0 0 460 290" fill="none" class="w-full h-full" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="waveBottomRightCareers" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5e00" stop-opacity="0.95" />
                        <stop offset="45%" stop-color="#ff7a18" stop-opacity="0.88" />
                        <stop offset="100%" stop-color="#ffa057" stop-opacity="0.25" />
                    </linearGradient>
                </defs>
                <path d="M460 290 L130 290 C190 250 260 205 310 145 C355 90 400 45 460 0 Z" fill="url(#waveBottomRightCareers)" />
            </svg>
        </div>

        <style>
            .car-banner-grid {
                display: flex;
                flex-direction: column;
                gap: 2rem;
            }
            .car-banner-left {
                width: 100%;
            }
            .car-banner-right {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            @media (min-width: 1024px) {
                .car-banner-grid {
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                    gap: 2.5rem;
                }
                .car-banner-left {
                    flex: 1 1 54%;
                    max-width: 55%;
                }
                .car-banner-right {
                    flex: 0 0 45%;
                    max-width: 600px;
                    justify-content: flex-end;
                }
            }

            @media (min-width: 1280px) {
                .car-banner-left {
                    flex: 1 1 53%;
                    max-width: 54%;
                }
                .car-banner-right {
                    flex: 0 0 47%;
                    max-width: 660px;
                }
            }

            /* Badge Tag */
            .car-pill-badge {
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
            .car-pill-badge:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 20px rgba(255, 94, 0, 0.42);
            }

            /* Headline Typography */
            .car-hero-h1 {
                font-size: 28px;
                font-weight: 900;
                line-height: 1.22;
                letter-spacing: -0.025em;
                color: #0f172a;
                margin-bottom: 14px;
            }
            @media (min-width: 640px) {
                .car-hero-h1 { font-size: 34px; }
            }
            @media (min-width: 1024px) {
                .car-hero-h1 { font-size: 38px; }
            }
            @media (min-width: 1280px) {
                .car-hero-h1 { font-size: 42px; }
            }
            .car-hero-h1 .car-orange-text {
                background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 50%, #ea580c 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                color: #ff5e00;
                display: inline;
            }

            /* Paragraph */
            .car-hero-paragraph {
                font-size: 13.5px;
                line-height: 1.7;
                color: #475569;
                max-width: 580px;
                margin-bottom: 22px;
            }
            @media (min-width: 1024px) {
                .car-hero-paragraph { font-size: 14.5px; }
            }

            /* Highlight Feature Boxes (3 boxes phong cách Clients stat-box) */
            .car-perks-row {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
                max-width: 620px;
                margin-bottom: 24px;
            }
            @media (max-width: 639px) {
                .car-perks-row {
                    grid-template-columns: repeat(1, 1fr);
                    gap: 10px;
                }
            }

            .car-perk-box {
                position: relative;
                background: #ffffff;
                border-radius: 16px;
                padding: 14px 10px 12px;
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
            .car-perk-box::before {
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
            .car-perk-box:hover {
                transform: translateY(-4px);
                border-color: #ffd8bd;
                box-shadow: 0 12px 26px rgba(255, 94, 0, 0.12);
            }
            .car-perk-box:hover::before {
                opacity: 1;
            }

            .car-perk-icon-circle {
                width: 40px;
                height: 40px;
                border-radius: 12px;
                background: linear-gradient(135deg, #fff3ea 0%, #ffe5d3 100%);
                border: 1px solid rgba(255, 94, 0, 0.14);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ff5e00;
                margin-bottom: 8px;
                transition: all 0.35s ease;
                box-shadow: 0 2px 8px rgba(255, 94, 0, 0.08);
            }
            .car-perk-box:hover .car-perk-icon-circle {
                transform: scale(1.1) rotate(3deg);
                background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%);
                color: #ffffff !important;
                box-shadow: 0 6px 18px rgba(255, 94, 0, 0.35);
            }

            .car-perk-title {
                font-size: 12.5px;
                font-weight: 800;
                color: #0f172a;
                line-height: 1.25;
            }
            .car-perk-desc {
                font-size: 11px;
                font-weight: 600;
                color: #64748b;
                margin-top: 3px;
                line-height: 1.25;
            }

            /* Brand Slogan Line */
            .car-brand-footer {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-top: 22px;
                padding-top: 4px;
            }
            .car-brand-footer-bar {
                width: 32px;
                height: 3px;
                background: linear-gradient(90deg, #ff5e00, #ff8c3a);
                border-radius: 9999px;
            }
            .car-brand-footer-text {
                font-size: 11px;
                font-weight: 800;
                letter-spacing: 0.12em;
                color: #94a3b8;
                text-transform: uppercase;
            }
        </style>

        <!-- Main Content Container (Đồng bộ khoảng cách gọn gàng chuẩn trang Khách Hàng) -->
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-6 lg:py-8 relative z-10">
            <div class="car-banner-grid">
                
                <!-- CỘT TRÁI: TEXT & BUTTONS & PERKS -->
                <div class="car-banner-left text-left">
                    
                    <!-- 1. Badge Tag: TUYỂN DỤNG -->
                    <div>
                        <div class="car-pill-badge">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 18v3h3l11-11-3-3L4 18zm17.71-10.29a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                            <span>TUYỂN DỤNG NHÂN TÀI</span>
                        </div>
                    </div>

                    <!-- 3. Headline H1 -->
                    <h1 class="car-hero-h1">
                        Gia Nhập Đội Ngũ <br class="hidden sm:inline">
                        Truyền Thông Cửu Long <br>
                        <span class="car-orange-text">Cùng Kiến Tạo</span> <span class="car-orange-text">Những Giá Trị Lớn</span>
                    </h1>

                    <!-- 4. Paragraph Description -->
                    <p class="car-hero-paragraph">
                        Chúng tôi luôn tìm kiếm những con người đam mê sáng tạo, công nghệ và mong muốn phát triển sự nghiệp trong môi trường chuyên nghiệp, thân thiện và giàu cơ hội.
                    </p>

                    <!-- 5. 3 Perks Row (Cards phong cách chuẩn trang Khách hàng) -->
                    <div class="car-perks-row">
                        <!-- Card 1 -->
                        <div class="car-perk-box">
                            <div class="car-perk-icon-circle">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="car-perk-title">Môi trường</span>
                            <span class="car-perk-desc">Chuyên nghiệp</span>
                        </div>

                        <!-- Card 2 -->
                        <div class="car-perk-box">
                            <div class="car-perk-icon-circle">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <span class="car-perk-title">Cơ hội phát triển</span>
                            <span class="car-perk-desc">Lộ trình rõ ràng</span>
                        </div>

                        <!-- Card 3 -->
                        <div class="car-perk-box">
                            <div class="car-perk-icon-circle">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="car-perk-title">Thu nhập hấp dẫn</span>
                            <span class="car-perk-desc">&amp; Phúc lợi tốt</span>
                        </div>
                    </div>

                    <!-- 6. 2 CTA Buttons -->
                    <div class="flex flex-wrap items-center gap-3.5">
                        <a href="#danh-sach-tuyen-dung" 
                           style="background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%) !important; color: #ffffff !important;"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-headline text-xs sm:text-sm font-bold shadow-lg shadow-orange-500/30 hover:brightness-105 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                            <span>Xem vị trí tuyển dụng</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('about') }}" 
                           style="background: #ffffff !important; color: #ff5e00 !important; border: 1.5px solid #ff7a18 !important;"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-headline text-xs sm:text-sm font-bold hover:bg-orange-50/70 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                            <span>Tìm hiểu về Truyền Thông Cửu Long</span>
                        </a>
                    </div>

                    <!-- 7. Bottom Brand Slogan -->
                    <div class="car-brand-footer select-none">
                        <div class="car-brand-footer-bar"></div>
                        <span class="car-brand-footer-text">
                            TRUYỀN THÔNG CỬU LONG &nbsp;|&nbsp; LÀM HẾT MÌNH &bull; CÙNG NHAU PHÁT TRIỂN
                        </span>
                    </div>

                </div>

                <!-- CỘT PHẢI: KHỐI HÌNH ẢNH NGHỆ THUẬT (ĐỒNG BỘ SHOWCASE TRANG KHÁCH HÀNG) -->
                <div class="car-banner-right select-none">
                    <div class="relative w-full max-w-[580px] lg:max-w-[620px] xl:max-w-[660px] flex items-center justify-center lg:justify-end">
                        <img src="{{ asset('images/careers/banner/hero_showcase.png') }}?v={{ file_exists(public_path('images/careers/banner/hero_showcase.png')) ? filemtime(public_path('images/careers/banner/hero_showcase.png')) : time() }}" 
                             alt="Gia Nhập Đội Ngũ Truyền Thông Cửu Long" 
                             class="w-full h-auto max-h-[380px] sm:max-h-[420px] lg:max-h-[480px] object-contain drop-shadow-[0_12px_32px_rgba(0,0,0,0.06)] transition-transform duration-500 hover:scale-[1.01]"
                             loading="eager"
                             fetchpriority="high">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 2: VÌ SAO NÊN LÀM VIỆC TẠI CỬU LONG (NỔI BẬT NỀN, ĐỘ TƯƠNG PHẢN CAO THEO MOCKUP)
    =========================================== -->
    <section class="py-16 sm:py-20 border-b border-slate-200/80 relative" id="vi-sao-chon-cuu-long" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);">
        
        <style>
            /* Benefit Cards (Chống tệp màu background, nổi bật sắc nét) */
            .car-benefit-card {
                position: relative;
                background: #ffffff !important;
                border: 1.5px solid #e2e8f0 !important;
                border-radius: 20px;
                padding: 26px 22px;
                box-shadow: 0 4px 18px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.03) !important;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
                transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
                overflow: hidden;
            }
            .car-benefit-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #ff5e00, #ff8c3a);
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .car-benefit-card:hover {
                transform: translateY(-5px);
                border-color: #ff9b66 !important;
                box-shadow: 0 18px 36px -4px rgba(255, 94, 0, 0.16), 0 6px 12px -2px rgba(0, 0, 0, 0.04) !important;
            }
            .car-benefit-card:hover::before {
                opacity: 1;
            }

            /* Icon Wrapper Tròn Cam Nổi Bật Chuẩn Mockup */
            .car-benefit-icon-wrapper {
                width: 52px;
                height: 52px;
                border-radius: 16px;
                background: linear-gradient(135deg, #fff3ea 0%, #ffe0cc 100%);
                border: 1.5px solid #ffd0b5;
                color: #ff5e00;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(255, 94, 0, 0.14);
                transition: all 0.35s ease;
                flex-shrink: 0;
            }
            .car-benefit-card:hover .car-benefit-icon-wrapper {
                background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%);
                color: #ffffff !important;
                box-shadow: 0 8px 22px rgba(255, 94, 0, 0.38);
                transform: scale(1.08) rotate(3deg);
            }

            .car-benefit-title {
                font-family: inherit;
                font-size: 15.5px;
                font-weight: 800;
                color: #0f172a;
                line-height: 1.3;
                transition: color 0.25s ease;
            }
            .car-benefit-card:hover .car-benefit-title {
                color: #ea580c;
            }

            .car-benefit-desc {
                font-family: inherit;
                font-size: 13px;
                font-weight: 500;
                color: #475569;
                line-height: 1.65;
            }
        </style>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                
                <!-- Cột trái: Tiêu đề & Giới thiệu (Col 4) -->
                <div class="lg:col-span-4 flex flex-col items-start lg:sticky lg:top-28">
                    <!-- Badge cam nhỏ -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full font-headline text-xs font-bold mb-4"
                         style="background: #fff3ea !important; border: 1.5px solid #fed7aa !important; color: #ea580c !important; box-shadow: 0 2px 8px rgba(234, 88, 12, 0.08) !important;">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                        </svg>
                        <span>VÌ SAO NÊN LÀM VIỆC TẠI CỬU LONG</span>
                    </div>

                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-[34px] font-black text-slate-900 tracking-tight leading-snug mb-4">
                        Môi Trường Làm Việc<br class="hidden sm:inline">
                        Hiện Đại &amp; Thân Thiện
                    </h2>

                    <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed mb-7 max-w-sm">
                        Tại Truyền Thông Cửu Long, bạn không chỉ có một công việc, mà còn có một môi trường để học hỏi, sáng tạo và phát triển bản thân mỗi ngày.
                    </p>

                    <!-- Nút Khám phá môi trường làm việc (Cam rực rỡ chuẩn Mockup, không bị mờ/tệp nền) -->
                    <a href="#danh-sach-tuyen-dung" 
                       style="background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%) !important; color: #ffffff !important; box-shadow: 0 8px 24px rgba(255, 94, 0, 0.35) !important;"
                       class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full font-headline text-xs sm:text-sm font-bold hover:brightness-105 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                        <span>Khám phá môi trường làm việc</span>
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

                <!-- Cột phải: Grid 6 thẻ quyền lợi & phúc lợi (Col 8) -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                    
                    <!-- Card 1: Thu nhập cạnh tranh -->
                    <div class="car-benefit-card group">
                        <div class="car-benefit-icon-wrapper">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="car-benefit-title">
                            Thu nhập cạnh tranh
                        </h3>
                        <p class="car-benefit-desc">
                            Lương thưởng hấp dẫn theo năng lực và hiệu quả công việc. Đánh giá xét thưởng định kỳ.
                        </p>
                    </div>

                    <!-- Card 2: Bảo hiểm & phúc lợi -->
                    <div class="car-benefit-card group">
                        <div class="car-benefit-icon-wrapper">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                            </svg>
                        </div>
                        <h3 class="car-benefit-title">
                            Bảo hiểm &amp; phúc lợi
                        </h3>
                        <p class="car-benefit-desc">
                            Đầy đủ BHXH, BHYT, BHTN theo luật lao động và các chế độ đãi ngộ, quà tặng lễ tết.
                        </p>
                    </div>

                    <!-- Card 3: Đào tạo & phát triển -->
                    <div class="car-benefit-card group">
                        <div class="car-benefit-icon-wrapper">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-3.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                            </svg>
                        </div>
                        <h3 class="car-benefit-title">
                            Đào tạo &amp; phát triển
                        </h3>
                        <p class="car-benefit-desc">
                            Cơ hội học hỏi, nâng cao kỹ năng chuyên môn từ các chuyên gia thực chiến dày dặn kinh nghiệm.
                        </p>
                    </div>

                    <!-- Card 4: Môi trường sáng tạo -->
                    <div class="car-benefit-card group">
                        <div class="car-benefit-icon-wrapper">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="car-benefit-title">
                            Môi trường sáng tạo
                        </h3>
                        <p class="car-benefit-desc">
                            Tự do thể hiện ý tưởng, phát huy cá tính độc đáo trong từng sản phẩm truyền thông và công nghệ.
                        </p>
                    </div>

                    <!-- Card 5: Team building -->
                    <div class="car-benefit-card group">
                        <div class="car-benefit-icon-wrapper">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="car-benefit-title">
                            Team building
                        </h3>
                        <p class="car-benefit-desc">
                            Gắn kết, thân thiện, chia sẻ cùng nhau qua các chuyến du lịch, teambuilding và tiệc giao lưu.
                        </p>
                    </div>

                    <!-- Card 6: Cơ hội thăng tiến -->
                    <div class="car-benefit-card group">
                        <div class="car-benefit-icon-wrapper">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <h3 class="car-benefit-title">
                            Cơ hội thăng tiến
                        </h3>
                        <p class="car-benefit-desc">
                            Lộ trình nghề nghiệp rõ ràng, minh bạch; cơ hội trở thành Lead dự án hoặc đối tác chiến lược.
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 3: CÁC VỊ TRÍ ĐANG TUYỂN DỤNG & FORM
    =========================================== -->
    <section class="py-16 sm:py-20 bg-white relative overflow-hidden" id="danh-sach-tuyen-dung">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Thông báo nộp đơn thành công -->
            @if(session('success'))
            <div class="mb-8 p-4 sm:p-5 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-sm animate-fade-in">
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Thông báo lỗi nhập form -->
            @if($errors->any())
            <div class="mb-8 p-4 sm:p-5 rounded-2xl bg-rose-50 border border-rose-300 text-rose-800 text-xs sm:text-sm flex flex-col gap-1 shadow-sm">
                <div class="flex items-center gap-2 font-bold text-rose-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Vui lòng kiểm tra lại thông tin hồ sơ:</span>
                </div>
                <ul class="list-disc list-inside text-xs pl-5 text-rose-600">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Section Header với Text Trang Trí Góc Phải -->
            <div class="relative flex flex-col md:flex-row items-start md:items-end justify-between gap-4 mb-8">
                <div>
                    <!-- Badge cam nhỏ -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full font-headline text-xs font-bold mb-3"
                         style="background: #fff3ea !important; border: 1.5px solid #fed7aa !important; color: #ea580c !important; box-shadow: 0 2px 8px rgba(234, 88, 12, 0.08) !important;">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/>
                        </svg>
                        <span>KHỐI VỊ TRÍ TUYỂN DỤNG</span>
                    </div>

                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                        Các Vị Trí Đang Tuyển Dụng
                    </h2>

                    <p class="font-body text-slate-500 text-xs sm:text-sm mt-2 max-w-xl">
                        Chúng tôi đang tìm kiếm những tài năng ở nhiều lĩnh vực khác nhau. Hãy tìm vị trí phù hợp và bắt đầu hành trình cùng Cửu Long!
                    </p>
                </div>

                <!-- Text nghệ thuật bên phải: Bạn phù hợp với vị trí nào? -->
                <div class="relative shrink-0 flex items-center gap-2 self-end pb-1 select-none">
                    @if(file_exists(public_path('images/careers/text_decor_fit.png')))
                        <img src="{{ asset('images/careers/text_decor_fit.png') }}?v={{ file_exists(public_path('images/careers/text_decor_fit.png')) ? filemtime(public_path('images/careers/text_decor_fit.png')) : time() }}" 
                             alt="Bạn phù hợp với vị trí nào?" 
                             class="h-16 sm:h-20 md:h-24 w-auto object-contain drop-shadow-sm transition-transform duration-300 hover:scale-105"
                             style="max-height: 96px;">
                    @else
                        <div class="flex items-center gap-2 text-right">
                            <span class="font-headline text-base sm:text-lg md:text-xl font-extrabold italic text-[#ff5e00] tracking-wide transform -rotate-2">
                                Bạn phù hợp với vị trí nào?
                            </span>
                            <span class="text-[#ff5e00] text-2xl font-bold animate-bounce">⤵</span>
                        </div>
                    @endif
                </div>
            </div>

            <style>
                .careers-tab-pill {
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    padding: 9px 22px !important;
                    border-radius: 9999px !important;
                    font-size: 13.5px !important;
                    font-weight: 700 !important;
                    line-height: 1.4 !important;
                    white-space: nowrap !important;
                    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
                    cursor: pointer !important;
                    border: 1.5px solid #e2e8f0 !important;
                    background-color: #ffffff !important;
                    color: #475569 !important;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04) !important;
                    text-decoration: none !important;
                    user-select: none !important;
                }
                .careers-tab-pill:hover {
                    border-color: #fdba74 !important;
                    color: #ff5e00 !important;
                    background-color: #fffaf5 !important;
                    transform: translateY(-1px) !important;
                }
                .careers-tab-pill.active {
                    background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%) !important;
                    border-color: #ff5e00 !important;
                    color: #ffffff !important;
                    box-shadow: 0 4px 16px rgba(255, 94, 0, 0.32) !important;
                    transform: translateY(-1px) !important;
                }
                .careers-tab-pill.active:hover {
                    color: #ffffff !important;
                    background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%) !important;
                }
            </style>

            <!-- Tabs Lọc Vị Trí (5 tabs pills) -->
            <div class="flex items-center flex-wrap gap-2.5 sm:gap-3 mb-10 pb-2">
                <!-- Tab: Tất cả vị trí -->
                <button type="button" 
                        @click="activeTab = 'all'"
                        :class="{ 'active': activeTab === 'all' }"
                        class="careers-tab-pill font-headline">
                    Tất cả vị trí
                </button>

                <!-- Tab: Content & Marketing -->
                <button type="button" 
                        @click="activeTab = 'marketing'"
                        :class="{ 'active': activeTab === 'marketing' }"
                        class="careers-tab-pill font-headline">
                    Content &amp; Marketing
                </button>

                <!-- Tab: Thiết kế & Sáng tạo -->
                <button type="button" 
                        @click="activeTab = 'design'"
                        :class="{ 'active': activeTab === 'design' }"
                        class="careers-tab-pill font-headline">
                    Thiết kế &amp; Sáng tạo
                </button>

                <!-- Tab: Kỹ thuật & Công nghệ -->
                <button type="button" 
                        @click="activeTab = 'tech'"
                        :class="{ 'active': activeTab === 'tech' }"
                        class="careers-tab-pill font-headline">
                    Kỹ thuật &amp; Công nghệ
                </button>

                <!-- Tab: Hành chính & Kinh doanh -->
                <button type="button" 
                        @click="activeTab = 'business'"
                        :class="{ 'active': activeTab === 'business' }"
                        class="careers-tab-pill font-headline">
                    Hành chính &amp; Kinh doanh
                </button>
            </div>

            <!-- GRID 2 CỘT: Cột Trái (Job Cards) + Cột Phải (Form Ứng Tuyển) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- ==================== CỘT TRÁI: DANH SÁCH VIỆC LÀM (Col 7) ==================== -->
                <div class="lg:col-span-7 flex flex-col gap-4">
                    
                    @php
                    $recruitmentList = [];
                    if (isset($jobs) && $jobs->isNotEmpty()) {
                        foreach ($jobs as $jobItem) {
                            $rawTitle = $jobItem->title;
                            
                            // Làm sạch tiêu đề: bỏ các hậu tố '(ĐÃ TUYỂN ĐỦ)', tiền tố lặp
                            $cleanTitle = trim(preg_replace('/\s+/', ' ', str_ireplace([
                                '(ĐÃ TUYỂN ĐỦ)', '[ĐÃ TUYỂN ĐỦ]', 'ĐÃ TUYỂN ĐỦ',
                                'Truyền Thông Cửu Long Tuyển Dụng Vị Trí',
                                'Truyền Thông Cửu Long Tuyển Dụng',
                                'Truyền Thông Cửu Long Tuyển dụng',
                                'Truyền Thông Cửu Long Nhận',
                                'TUYỂN DỤNG NHÂN VIÊN',
                                'TUYỂN DỤNG', 'Tuyển Dụng', 'Tuyển dụng',
                            ], '', $rawTitle)));
                            
                            if (empty($cleanTitle)) {
                                $cleanTitle = $jobItem->title;
                            }
                            $cleanTitle = ltrim($cleanTitle, ' :-');
                            $cleanTitle = mb_convert_case(mb_substr($cleanTitle, 0, 1), MB_CASE_UPPER) . mb_substr($cleanTitle, 1);

                            $lowerStr = mb_strtolower($rawTitle . ' ' . ($jobItem->summary ?? ''));

                            // Phân loại danh mục tab: marketing, design, tech, business
                            if (str_contains($lowerStr, 'content') || str_contains($lowerStr, 'marketing') || str_contains($lowerStr, 'viết bài') || str_contains($lowerStr, 'social')) {
                                $categoryGroup = 'marketing';
                                $department = 'Marketing & Content';
                                $icon = 'megaphone';
                            } elseif (str_contains($lowerStr, 'thiết kế') || str_contains($lowerStr, 'design') || str_contains($lowerStr, 'đồ họa')) {
                                $categoryGroup = 'design';
                                $department = 'Thiết Kế Đồ Họa';
                                $icon = 'desktop';
                            } elseif (str_contains($lowerStr, 'video') || str_contains($lowerStr, 'editor') || str_contains($lowerStr, 'quay') || str_contains($lowerStr, 'dựng phim')) {
                                $categoryGroup = 'design';
                                $department = 'Media & Video';
                                $icon = 'video';
                            } elseif (str_contains($lowerStr, 'web') || str_contains($lowerStr, 'wordpress') || str_contains($lowerStr, 'lập trình') || str_contains($lowerStr, 'php') || str_contains($lowerStr, 'code') || str_contains($lowerStr, 'developer')) {
                                $categoryGroup = 'tech';
                                $department = 'Kỹ Thuật & Công Nghệ';
                                $icon = 'code';
                            } else {
                                $categoryGroup = 'business';
                                $department = 'Kinh Doanh & CSKH';
                                $icon = 'briefcase';
                            }

                            // Hình thức làm việc
                            $type = 'Toàn thời gian';
                            if (str_contains($lowerStr, 'ctv') || str_contains($lowerStr, 'cộng tác viên')) {
                                $type = 'Cộng tác viên / Bán thời gian';
                            } elseif (str_contains($lowerStr, 'thực tập') || str_contains($lowerStr, 'intern')) {
                                $type = 'Thực tập sinh';
                            }

                            // Bóc tách yêu cầu và quyền lợi từ nội dung bài viết
                            $requirements = [];
                            $benefits = [];
                            $plainContent = strip_tags($jobItem->content ?? '');

                            if (preg_match('/(?:Yêu [Cc]ầu|YÊU CẦU)[^:]*:(.*?)(?:Mô tả|MÔ TẢ|Quyền lợi|QUYỀN LỢI|Email|HẠN NỘP|$)/su', $plainContent, $mReq)) {
                                $lines = array_filter(array_map('trim', explode("\n", $mReq[1])));
                                foreach ($lines as $line) {
                                    $l = ltrim($line, "-*• \t\r");
                                    if (mb_strlen($l) > 6) $requirements[] = $l;
                                }
                            }
                            if (empty($requirements)) {
                                $requirements = [
                                    'Có tinh thần trách nhiệm cao, chủ động và ham học hỏi trong công việc.',
                                    'Khả năng làm việc độc lập và phối hợp nhịp nhàng cùng đội ngũ dự án.',
                                    'Ưu tiên ứng viên có kinh nghiệm thực tế hoặc có portfolio/sản phẩm demo liên quan.',
                                ];
                            }

                            if (preg_match('/(?:Quyền lợi|QUYỀN LỢI|Ưu điểm|Chế độ)[^:]*:(.*?)(?:Yêu cầu|YÊU CẦU|Email|HẠN NỘP|$)/su', $plainContent, $mBen)) {
                                $lines = array_filter(array_map('trim', explode("\n", $mBen[1])));
                                foreach ($lines as $line) {
                                    $l = ltrim($line, "-*•✓ \t\r");
                                    if (mb_strlen($l) > 6) $benefits[] = $l;
                                }
                            }
                            if (empty($benefits)) {
                                $benefits = [
                                    'Mức thu nhập cạnh tranh theo năng lực thực tế + Thưởng hiệu quả chiến dịch.',
                                    'Môi trường làm việc trẻ trung, sáng tạo, trang thiết bị làm việc hiện đại.',
                                    'Chế độ phúc lợi, BHXH đầy đủ và cơ hội thăng tiến mở rộng cùng công ty.',
                                ];
                            }

                            $recruitmentList[] = [
                                'id' => $jobItem->id,
                                'title' => $cleanTitle,
                                'category' => $categoryGroup,
                                'department' => $department,
                                'location' => 'TP. Cần Thơ',
                                'type' => $type,
                                'is_hot' => ($jobItem->published_at && $jobItem->published_at->gt(now()->subMonths(6))) || $jobItem->id == 559,
                                'icon' => $icon,
                                'summary' => $jobItem->summary ?: 'Tham gia đội ngũ Truyền Thông Cửu Long để cùng nhau sáng tạo và tạo dựng các giá trị bền vững.',
                                'requirements' => array_slice($requirements, 0, 5),
                                'benefits' => array_slice($benefits, 0, 5),
                                'slug' => $jobItem->slug,
                            ];
                        }
                    }
                    @endphp

                    @forelse($recruitmentList as $job)
                    <div x-show="activeTab === 'all' || activeTab === '{{ $job['category'] }}'"
                         x-transition:enter="transition ease-out duration-250"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="p-4.5 sm:p-5 rounded-2xl transition-all flex items-center justify-between gap-4 group cursor-pointer hover:-translate-y-1"
                         style="background: #ffffff !important; border: 1.5px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.05) !important;"
                         @click="selectJob({{ json_encode($job) }})">
                        
                        <!-- Left Info -->
                        <div class="flex items-center gap-3.5 sm:gap-4.5 min-w-0">
                            <!-- Icon vuông tròn cam chuẩn Mockup -->
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 transition-all group-hover:scale-105"
                                 style="background: linear-gradient(135deg, #fff3ea 0%, #ffe0cc 100%); border: 1.5px solid #ffd0b5; color: #ff5e00; box-shadow: 0 3px 10px rgba(255, 94, 0, 0.12);">
                                @if($job['icon'] === 'megaphone')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                @elseif($job['icon'] === 'desktop')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                @elseif($job['icon'] === 'code')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                @elseif($job['icon'] === 'video')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                @endif
                            </div>

                            <!-- Texts -->
                            <div class="min-w-0">
                                <div class="flex items-center gap-2.5 flex-wrap">
                                    <h3 class="font-headline text-sm sm:text-[15px] font-bold text-slate-900 group-hover:text-[#ff5e00] transition-colors truncate">
                                        {{ $job['title'] }}
                                    </h3>
                                    @if($job['is_hot'])
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black"
                                          style="background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626;">
                                        🔥 HOT
                                    </span>
                                    @endif
                                </div>

                                <!-- Metadata tags (Đồng bộ thẻ chuẩn Mockup) -->
                                <div class="flex items-center gap-2.5 sm:gap-3 text-[11px] mt-1.5 flex-wrap">
                                    <!-- Badge phòng ban -->
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[11px] font-bold"
                                          style="background: #fff3ea; color: #ea580c; border: 1px solid #fed7aa;">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#ff5e00]"></span>
                                        {{ $job['department'] }}
                                    </span>

                                    <!-- Vị trí -->
                                    <span class="inline-flex items-center gap-1 text-slate-500 font-medium">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $job['location'] }}
                                    </span>

                                    <!-- Hình thức -->
                                    <span class="inline-flex items-center gap-1 text-slate-500 font-medium">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $job['type'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Actions: Nút Xem chi tiết -->
                        <div class="shrink-0 flex items-center gap-1.5 text-xs font-headline font-bold text-slate-500 group-hover:text-[#ff5e00] transition-colors">
                            <span>Xem chi tiết</span>
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                    @empty
                    <div class="p-8 text-center bg-white rounded-2xl border border-slate-200">
                        <div class="w-12 h-12 rounded-full bg-orange-100 text-[#ff5e00] flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h4 class="font-headline text-sm font-bold text-slate-800">Hiện chưa có vị trí tuyển dụng mới</h4>
                        <p class="font-body text-xs text-slate-500 mt-1">Vui lòng quay lại sau hoặc gửi CV ứng tuyển chủ động qua form bên phải.</p>
                    </div>
                    @endforelse

                </div>


                <!-- ==================== CỘT PHẢI: FORM ỨNG TUYỂN NGAY (Col 5) ==================== -->
                <div class="lg:col-span-5 lg:sticky lg:top-28" id="apply-form-section">
                    
                    <!-- Khung Card Form Nổi Bật Chuẩn Mockup (Có viền cam và bóng đổ 3D) -->
                    <div style="background: #ffffff !important; border: 2px solid #ff7a18 !important; border-radius: 24px !important; overflow: hidden !important; box-shadow: 0 16px 40px -4px rgba(255, 94, 0, 0.2), 0 4px 16px rgba(0, 0, 0, 0.04) !important;">
                        
                        <!-- Header Form màu Cam chuẩn Mockup (Cố định mã màu cam rực rỡ, chữ trắng sắc nét) -->
                        <div style="background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%) !important; padding: 22px 24px !important; color: #ffffff !important; display: flex !important; align-items: center !important; gap: 14px !important;">
                            <div style="width: 48px; height: 48px; border-radius: 9999px; background: rgba(255, 255, 255, 0.22); border: 1.5px solid rgba(255, 255, 255, 0.45); display: flex; align-items: center; justify-content: center; color: #ffffff; flex-shrink: 0;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 19px; font-weight: 900; color: #ffffff !important; line-height: 1.2; margin: 0;">
                                    Ứng Tuyển Ngay
                                </h3>
                                <p style="font-size: 12px; font-weight: 500; color: rgba(255, 255, 255, 0.92) !important; margin-top: 4px; margin-bottom: 0; line-height: 1.4;">
                                    Điền thông tin của bạn, chúng tôi sẽ liên hệ trong thời gian sớm nhất!
                                </p>
                            </div>
                        </div>

                            <!-- Form Fields -->
                            <form action="{{ route('careers.apply') }}" 
                                  method="POST" 
                                  enctype="multipart/form-data" 
                                  class="p-6 sm:p-7 flex flex-col gap-4">
                                @csrf

                                <!-- Họ và tên -->
                                <div>
                                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1.5">
                                        Họ và tên <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="fullname" 
                                           value="{{ old('fullname') }}" 
                                           placeholder="Nhập họ và tên" 
                                           required 
                                           class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-[#ff5e00] focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1.5">
                                        Email <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Nhập email của bạn" 
                                           required 
                                           class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-[#ff5e00] focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                                </div>

                                <!-- Số điện thoại -->
                                <div>
                                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1.5">
                                        Số điện thoại <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="tel" 
                                           name="phone" 
                                           value="{{ old('phone') }}" 
                                           placeholder="Nhập số điện thoại" 
                                           required 
                                           class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-[#ff5e00] focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                                </div>

                                <!-- Vị trí ứng tuyển -->
                                <div>
                                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1.5">
                                        Vị trí ứng tuyển <span class="text-rose-500">*</span>
                                    </label>
                                    <select name="position" 
                                            id="position-select" 
                                            required 
                                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-900 focus:bg-white focus:border-[#ff5e00] focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all cursor-pointer">
                                        <option value="">-- Chọn vị trí ứng tuyển --</option>
                                        @foreach($recruitmentList as $jobOpt)
                                            <option value="{{ $jobOpt['title'] }}" :selected="appliedPosition === '{{ addslashes($jobOpt['title']) }}'">{{ $jobOpt['title'] }}</option>
                                        @endforeach
                                        <option value="Vị trí thực tập sinh hoặc khác">Khác (Vui lòng ghi rõ trong CV)</option>
                                    </select>
                                </div>

                                <!-- CV / Hồ sơ Upload Box -->
                                <div>
                                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1.5">
                                        CV / Hồ sơ (PDF, DOC, DOCX) <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative border-2 border-dashed border-slate-200 hover:border-orange-300 rounded-xl p-4 text-center bg-slate-50/70 hover:bg-orange-50/30 transition-all cursor-pointer">
                                        <input type="file" 
                                               name="cv_file" 
                                               accept=".pdf,.doc,.docx" 
                                               required 
                                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        <div class="flex flex-col items-center justify-center gap-1.5 pointer-events-none">
                                            <div class="w-8 h-8 rounded-full bg-orange-100 text-[#ff5e00] flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                            </div>
                                            <p class="font-headline text-xs font-bold text-slate-700">
                                                Chọn file hoặc kéo thả tại đây
                                            </p>
                                            <p class="text-[10px] text-slate-400">
                                                Dung lượng tối đa 20MB (PDF, DOC, DOCX)
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button Cam Đậm -->
                                <button type="submit" 
                                        style="background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%) !important; color: #ffffff !important; box-shadow: 0 8px 24px rgba(255, 94, 0, 0.3) !important;"
                                        class="mt-2 w-full py-3.5 rounded-xl font-headline text-xs sm:text-sm font-bold hover:brightness-105 hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2 cursor-pointer">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                    <span>Gửi hồ sơ ứng tuyển</span>
                                </button>
                            </form>

                        </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 4: BANNER CTA CUỐI TRANG
    =========================================== -->
    <section class="py-12 sm:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="relative rounded-3xl overflow-hidden p-8 sm:p-12 lg:p-14 text-white"
                 style="background: linear-gradient(135deg, #ff5e00 0%, #ff6f14 50%, #f54e00 100%) !important; background-color: #ff5e00 !important; box-shadow: 0 20px 50px -10px rgba(255, 94, 0, 0.45) !important;">
                
                <!-- Background decor ambient circles -->
                <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full pointer-events-none" style="background: rgba(255, 255, 255, 0.16); filter: blur(40px);"></div>
                <div class="absolute -bottom-24 right-1/3 w-96 h-96 rounded-full pointer-events-none" style="background: rgba(0, 0, 0, 0.1); filter: blur(50px);"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    
                    <!-- Nội dung bên trái (Col 7) -->
                    <div class="lg:col-span-7 flex flex-col items-start text-left">
                        <!-- Tag nhỏ -->
                        <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-headline text-[11px] font-black uppercase tracking-wider mb-4"
                             style="background: rgba(255, 255, 255, 0.22) !important; color: #ffffff !important; border: 1.5px solid rgba(255, 255, 255, 0.45) !important; backdrop-filter: blur(8px);">
                            <span>SẴN SÀNG BẮT ĐẦU?</span>
                        </div>

                        <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight leading-tight mb-3"
                            style="color: #ffffff !important; text-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);">
                            Hãy Gia Nhập Đội Ngũ<br>
                            Truyền Thông Cửu Long Ngay Hôm Nay!
                        </h2>

                        <p class="font-body text-xs sm:text-sm leading-relaxed max-w-xl mb-7"
                           style="color: rgba(255, 255, 255, 0.95) !important;">
                            Chúng tôi luôn chào đón những ứng viên tài năng, nhiệt huyết và sẵn sàng cùng nhau tạo nên những giá trị khác biệt.
                        </p>

                        <a href="#danh-sach-tuyen-dung" 
                           class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-full font-headline text-xs sm:text-sm font-extrabold transition-all hover:scale-105 active:scale-95 cursor-pointer"
                           style="background: #ffffff !important; color: #ff5e00 !important; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;">
                            <span style="color: #ff5e00 !important;">Xem tất cả vị trí tuyển dụng</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color: #ff5e00 !important;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Hình ảnh bên phải (Col 5): Bàn làm việc & Laptop -->
                    <div class="lg:col-span-5 relative flex items-center justify-center lg:justify-end">
                        <div class="relative w-full max-w-sm rounded-2xl overflow-hidden"
                             style="border: 2.5px solid rgba(255, 255, 255, 0.45) !important; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important; background: rgba(255, 255, 255, 0.1) !important;">
                            <img src="{{ asset('images/careers/cta_careers_desk.png') }}?v={{ file_exists(public_path('images/careers/cta_careers_desk.png')) ? filemtime(public_path('images/careers/cta_careers_desk.png')) : time() }}" 
                                 alt="Cùng nhau kiến tạo những điều tuyệt vời" 
                                 class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500"
                                 loading="lazy">

                            <!-- Decor badge overlay: Cùng nhau kiến tạo những điều tuyệt vời! -->
                            <div class="absolute bottom-3 right-3 px-3 py-1.5 rounded-xl text-right"
                                 style="background: rgba(0, 0, 0, 0.68) !important; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.28) !important;">
                                <p class="font-headline text-[11px] font-extrabold italic tracking-wide" style="color: #fde047 !important;">
                                    Cùng nhau kiến tạo<br>những điều tuyệt vời!
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- ==========================================
         MODAL CHI TIẾT CÔNG VIỆC (JOB DETAIL MODAL)
    =========================================== -->
    <div x-show="selectedJob !== null" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs" 
         style="display: none;"
         @keydown.escape.window="selectedJob = null">
        
        <div @click.away="selectedJob = null"
             class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-slate-200 relative p-6 sm:p-8 flex flex-col gap-6">
            
            <!-- Close Button -->
            <button type="button" 
                    @click="selectedJob = null"
                    class="absolute top-5 right-5 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header Modal -->
            <div class="border-b border-slate-100 pb-4 pr-10">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-orange-100 text-[#ff5e00] font-mono text-[10px] font-bold" 
                          x-text="selectedJob?.department"></span>
                    <span class="text-xs text-slate-400" x-text="selectedJob?.type"></span>
                </div>
                <h3 class="font-headline text-xl sm:text-2xl font-black text-slate-900" x-text="selectedJob?.title"></h3>
                <p class="font-body text-xs text-slate-500 mt-1" x-text="'Địa điểm làm việc: ' + (selectedJob?.location ?? 'TP. Cần Thơ')"></p>
            </div>

            <!-- Mô tả chung -->
            <div>
                <h4 class="font-headline text-xs font-bold text-[#ff5e00] uppercase tracking-wider mb-2">Mô tả công việc</h4>
                <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed" x-text="selectedJob?.summary"></p>
            </div>

            <!-- Yêu cầu ứng viên -->
            <div>
                <h4 class="font-headline text-xs font-bold text-[#ff5e00] uppercase tracking-wider mb-2">Yêu cầu ứng viên</h4>
                <ul class="space-y-1.5">
                    <template x-for="(req, idx) in selectedJob?.requirements" :key="idx">
                        <li class="flex items-start gap-2 text-xs sm:text-sm text-slate-600">
                            <span class="text-[#ff5e00] font-bold">&bull;</span>
                            <span x-text="req"></span>
                        </li>
                    </template>
                </ul>
            </div>

            <!-- Quyền lợi -->
            <div>
                <h4 class="font-headline text-xs font-bold text-[#ff5e00] uppercase tracking-wider mb-2">Quyền lợi &amp; Chế độ</h4>
                <ul class="space-y-1.5">
                    <template x-for="(ben, idx) in selectedJob?.benefits" :key="idx">
                        <li class="flex items-start gap-2 text-xs sm:text-sm text-slate-600">
                            <span class="text-emerald-500 font-bold">✓</span>
                            <span x-text="ben"></span>
                        </li>
                    </template>
                </ul>
            </div>

            <!-- Nút Ứng Tuyển trong Modal -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-4">
                <button type="button" 
                        @click="selectedJob = null"
                        class="px-5 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold font-headline transition-colors">
                    Đóng
                </button>
                <button type="button" 
                        @click="applyFor(selectedJob.title); selectedJob = null;"
                        style="background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%) !important; color: #ffffff !important; box-shadow: 0 4px 14px rgba(255, 94, 0, 0.3) !important;"
                        class="px-6 py-2.5 rounded-full text-xs font-bold font-headline hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center gap-2 cursor-pointer">
                    <span>Ứng tuyển vị trí này</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

</div>

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "Tuyển Dụng & Gia Nhập Đội Ngũ - Truyền Thông Cửu Long",
    "description": "Gia nhập đội ngũ Truyền Thông Cửu Long. Cùng kiến tạo những giá trị lớn trong môi trường chuyên nghiệp, sáng tạo và giàu cơ hội phát triển tại Cần Thơ & ĐBSCL.",
    "url": "{{ route('careers') }}"
}
</script>
@endsection
