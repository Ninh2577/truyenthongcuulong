@extends('layouts.app')

@section('title', 'Liên Hệ - Truyền Thông Cửu Long')
@section('meta_description', 'Liên hệ với Truyền Thông Cửu Long để nhận tư vấn giải pháp truyền thông, sản xuất video, quảng cáo và phát triển công nghệ.')

@section('content')
@php
    $address = get_setting('company_address', 'Lô 5-7 Hùng Vương, P. Cái Khế, Q. Ninh Kiều, TP. Cần Thơ');
    $phone = get_setting('company_phone', '0939.363.262');
    $email = get_setting('company_email', 'info@truyenthongcuulong.com');
    $rawMap = get_setting('company_map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125715.77259461124!2d105.6983416!3d10.0341851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f6de3dedb%3A0x329435b60e7f7229!2zQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s');
    $mapUrl = $rawMap;
    if (preg_match('/src="([^"]+)"/', $rawMap, $match)) {
        $mapUrl = $match[1];
    }
@endphp

<!-- ==================== BANNER LIÊN HỆ (THIẾT KẾ THEO CHUẨN TRANG KHÁCH HÀNG) ==================== -->
<section class="relative w-full overflow-hidden border-b border-slate-200/80" id="hero-section" style="background: linear-gradient(135deg, #ffffff 0%, #fffdfa 45%, #fff8f2 100%);">
    
    <!-- Background Vector Waves & Accents (Matching Trang Khách Hàng) -->
    <div class="pointer-events-none absolute bottom-0 right-0 w-64 sm:w-96 lg:w-[460px] h-40 sm:h-60 lg:h-72 z-0 select-none overflow-hidden opacity-90" aria-hidden="true">
        <svg viewBox="0 0 460 290" fill="none" class="w-full h-full" preserveAspectRatio="none">
            <defs>
                <linearGradient id="waveBottomRightContact" x1="0%" y1="100%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#ff5e00" stop-opacity="0.95" />
                    <stop offset="45%" stop-color="#ff7a18" stop-opacity="0.88" />
                    <stop offset="100%" stop-color="#ffa057" stop-opacity="0.25" />
                </linearGradient>
            </defs>
            <path d="M460 290 L130 290 C190 250 260 205 310 145 C355 90 400 45 460 0 Z" fill="url(#waveBottomRightContact)" />
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

        /* Badge Tag: Cam rực rỡ */
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
            font-size: 22px;
            font-weight: 900;
            line-height: 1.1;
            color: #ff5e00;
            letter-spacing: -0.02em;
        }
        @media (min-width: 640px) {
            .clm-stat-val {
                font-size: 24px;
            }
        }

        .clm-stat-lbl {
            font-size: 11.5px;
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
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10 relative z-10">
        <div class="clm-banner-grid">
            
            <!-- ==================== CỘT TRÁI: TEXT & STAT CARDS ==================== -->
            <div class="clm-banner-left text-left">
                
                <!-- 1. Breadcrumb Navigation -->
                <nav class="flex items-center gap-1.5 text-xs sm:text-[13px] font-medium text-slate-500 mb-3" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="hover:text-[#ff5e00] transition-colors">Trang chủ</a>
                    <span class="text-slate-400 font-normal">&gt;</span>
                    <span class="font-semibold text-[#ff5e00]">Liên hệ</span>
                </nav>

                <!-- 2. Badge Tag: KẾT NỐI - HỢP TÁC - PHÁT TRIỂN -->
                <div>
                    <div class="clm-pill-badge">
                        <span class="material-symbols-outlined text-[15px] shrink-0">handshake</span>
                        <span>KẾT NỐI - HỢP TÁC - PHÁT TRIỂN</span>
                    </div>
                </div>

                <!-- 3. Headline H1 -->
                <h1 class="clm-hero-h1">
                    Liên Hệ Với <br class="hidden sm:inline">
                    <span class="clm-orange-text">Truyền Thông Cửu Long</span>
                </h1>

                <!-- 4. Paragraph Description -->
                <p class="clm-hero-paragraph">
                    Chúng tôi luôn sẵn sàng lắng nghe và tư vấn giải pháp phù hợp nhất cho nhu cầu truyền thông – công nghệ của bạn. Hãy kết nối để cùng nhau kiến tạo những giá trị đột phá!
                </p>

                <!-- 5. 4 Stat Cards Row (Chuẩn phong cách Khách Hàng) -->
                <div class="clm-stats-row">
                    
                    <!-- Card 1: 24/7 Tư Vấn -->
                    <div class="clm-stat-box group">
                        <div class="clm-stat-icon-circle">
                            <span class="material-symbols-outlined text-[20px]">support_agent</span>
                        </div>
                        <span class="clm-stat-val">24/7</span>
                        <span class="clm-stat-lbl">Hỗ trợ tư vấn</span>
                    </div>

                    <!-- Card 2: < 15p Phản Hồi -->
                    <div class="clm-stat-box group">
                        <div class="clm-stat-icon-circle">
                            <span class="material-symbols-outlined text-[20px]">bolt</span>
                        </div>
                        <span class="clm-stat-val">&lt; 15p</span>
                        <span class="clm-stat-lbl">Phản hồi yêu cầu</span>
                    </div>

                    <!-- Card 3: 100% Bảo Mật -->
                    <div class="clm-stat-box group">
                        <div class="clm-stat-icon-circle">
                            <span class="material-symbols-outlined text-[20px]">verified_user</span>
                        </div>
                        <span class="clm-stat-val">100%</span>
                        <span class="clm-stat-lbl">Bảo mật thông tin</span>
                    </div>

                    <!-- Card 4: 0đ Báo Giá -->
                    <div class="clm-stat-box group">
                        <div class="clm-stat-icon-circle">
                            <span class="material-symbols-outlined text-[20px]">request_quote</span>
                        </div>
                        <span class="clm-stat-val">0đ</span>
                        <span class="clm-stat-lbl">Khảo sát &amp; Báo giá</span>
                    </div>

                </div>

                <!-- 6. Bottom Brand Slogan -->
                <div class="clm-brand-footer select-none">
                    <div class="clm-brand-footer-bar"></div>
                    <span class="clm-brand-footer-text">
                        TRUYỀN THÔNG CỬU LONG &nbsp;|&nbsp; ĐỒNG HÀNH CÙNG SỰ PHÁT TRIỂN CỦA BẠN
                    </span>
                </div>

            </div>

            <!-- ==================== CỘT PHẢI: KHỐI HÌNH ẢNH SHOWCASE ==================== -->
            <div class="clm-banner-right select-none">
                <div class="relative w-full max-w-[580px] lg:max-w-[640px] xl:max-w-[680px] flex items-center justify-center lg:justify-end">
                    <img src="{{ asset('images/contact/hero_contact.png') }}?v={{ file_exists(public_path('images/contact/hero_contact.png')) ? filemtime(public_path('images/contact/hero_contact.png')) : time() }}" 
                         alt="Đội ngũ tư vấn & media chuyên nghiệp - Truyền Thông Cửu Long" 
                         class="w-full h-auto max-h-[400px] sm:max-h-[450px] lg:max-h-[490px] object-contain drop-shadow-[0_16px_36px_rgba(255,94,0,0.14)] transition-transform duration-500 hover:scale-[1.02]"
                         loading="eager"
                         fetchpriority="high">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Main Content: Contact Information & Form -->
<section class="w-full py-12 lg:py-16" style="background-color: #ffffff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            <!-- LEFT COLUMN: Contact Cards & Google Map -->
            <div class="lg:col-span-6 flex flex-col gap-6">
                
                <!-- Section Header -->
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: #ff5e00;">
                        THÔNG TIN LIÊN HỆ
                    </span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-2">
                        Kết Nối Với Chúng Tôi
                    </h2>
                    <p class="font-body text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Bạn có thể liên hệ với chúng tôi qua các kênh sau, đội ngũ của chúng tôi sẽ phản hồi nhanh nhất có thể!
                    </p>
                </div>

                <!-- 4 Contact Cards Grid (2x2) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- Card 1: Hotline & Zalo -->
                    <div class="rounded-2xl p-5 transition-all duration-200 hover:-translate-y-0.5" style="background: #ffffff; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.05);">
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #ff5e00, #ff8c00); color: #ffffff;">
                                <span class="material-symbols-outlined text-[20px]">call</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs text-slate-500 font-medium">Hotline &amp; Zalo</div>
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" class="font-headline font-bold text-base hover:underline block truncate mt-0.5" style="color: #ff5e00;">
                                    {{ $phone }}
                                </a>
                                <div class="text-[11px] text-slate-400 mt-0.5">Hỗ trợ tư vấn 24/7</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Email -->
                    <div class="rounded-2xl p-5 transition-all duration-200 hover:-translate-y-0.5" style="background: #ffffff; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.05);">
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #ff5e00, #ff8c00); color: #ffffff;">
                                <span class="material-symbols-outlined text-[20px]">mail</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs text-slate-500 font-medium">Email</div>
                                <a href="mailto:{{ $email }}" class="font-headline font-bold text-xs sm:text-sm hover:underline block truncate mt-0.5" style="color: #ff5e00;" title="{{ $email }}">
                                    {{ $email }}
                                </a>
                                <div class="text-[11px] text-slate-400 mt-0.5">Phản hồi trong vòng 24h</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Địa chỉ -->
                    <div class="rounded-2xl p-5 transition-all duration-200 hover:-translate-y-0.5" style="background: #ffffff; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.05);">
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #ff5e00, #ff8c00); color: #ffffff;">
                                <span class="material-symbols-outlined text-[20px]">location_on</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs text-slate-500 font-medium">Địa chỉ</div>
                                <div class="font-headline font-semibold text-xs text-slate-800 leading-snug mt-0.5">
                                    {{ $address }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Giờ làm việc -->
                    <div class="rounded-2xl p-5 transition-all duration-200 hover:-translate-y-0.5" style="background: #ffffff; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.05);">
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #ff5e00, #ff8c00); color: #ffffff;">
                                <span class="material-symbols-outlined text-[20px]">schedule</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs text-slate-500 font-medium">Giờ làm việc</div>
                                <div class="font-headline font-semibold text-xs text-slate-800 mt-0.5">
                                    Thứ 2 - Thứ 6: 8:00 - 17:30
                                </div>
                                <div class="text-[11px] text-slate-500 mt-0.5">
                                    Thứ 7: 8:00 - 12:00
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Google Map Embedded -->
                @if($mapUrl)
                <div class="relative w-full h-[260px] sm:h-[300px] rounded-2xl overflow-hidden shadow-sm" style="border: 1px solid #e2e8f0;">
                    <iframe src="{{ $mapUrl }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade" 
                            title="Bản đồ Truyền Thông Cửu Long"></iframe>

                    <!-- Floating Map Card Pin -->
                    <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-md rounded-xl p-3 shadow-md max-w-[240px] pointer-events-none" style="border: 1px solid rgba(226, 232, 240, 0.8);">
                        <div class="flex items-center gap-1.5 mb-1">
                            <span class="w-2 h-2 rounded-full" style="background-color: #ff5e00;"></span>
                            <span class="font-headline font-bold text-xs text-slate-900">Truyền Thông Cửu Long</span>
                        </div>
                        <p class="text-[10px] text-slate-500 leading-tight">
                            {{ $address }}
                        </p>
                        <a href="https://maps.google.com/?q={{ urlencode($address) }}" target="_blank" rel="noopener noreferrer" class="text-[10px] font-medium text-sky-600 hover:underline mt-1 inline-block pointer-events-auto">
                            Xem bản đồ lớn hơn
                        </a>
                    </div>
                </div>
                @endif

            </div>

            <!-- RIGHT COLUMN: Contact Form -->
            <div class="lg:col-span-6">
                <div class="rounded-3xl p-6 sm:p-8 lg:p-9 shadow-xl relative" style="background-color: #ffffff; border: 1px solid #f1f5f9; box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(241, 245, 249, 1);">
                    
                    <!-- Form Header -->
                    <div class="mb-6">
                        <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: #ff5e00;">
                            GỬI YÊU CẦU TƯ VẤN
                        </span>
                        <h2 class="font-headline text-2xl sm:text-[26px] font-extrabold text-slate-900 tracking-tight">
                            Hãy Để Lại Thông Tin
                        </h2>
                        <p class="font-body text-xs sm:text-sm text-slate-500 mt-1">
                            Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất!
                        </p>
                    </div>

                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="mb-5 p-4 rounded-xl flex items-center gap-3" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534;">
                            <span class="material-symbols-outlined text-[20px]" style="color: #16a34a;">check_circle</span>
                            <span class="text-xs font-semibold">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-5 p-4 rounded-xl text-xs" style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                            <div class="font-bold mb-1">Vui lòng kiểm tra lại thông tin:</div>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Họ và tên -->
                        <div>
                            <label for="fullname" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Họ và tên *
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-slate-400 pointer-events-none">person</span>
                                <input type="text" 
                                       id="fullname" 
                                       name="fullname" 
                                       value="{{ old('fullname') }}"
                                       autocomplete="name" 
                                       required 
                                       class="w-full pl-10 pr-4 py-3 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-all duration-200"
                                       style="background-color: #f8fafc; border: 1px solid #e2e8f0;"
                                       onfocus="this.style.borderColor='#ff5e00'; this.style.backgroundColor='#ffffff';"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc';"
                                       placeholder="Nhập họ và tên của bạn" />
                            </div>
                        </div>

                        <!-- Số điện thoại -->
                        <div>
                            <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Số điện thoại *
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-slate-400 pointer-events-none">call</span>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}"
                                       autocomplete="tel" 
                                       inputmode="tel" 
                                       required 
                                       class="w-full pl-10 pr-4 py-3 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-all duration-200"
                                       style="background-color: #f8fafc; border: 1px solid #e2e8f0;"
                                       onfocus="this.style.borderColor='#ff5e00'; this.style.backgroundColor='#ffffff';"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc';"
                                       placeholder="Nhập số điện thoại của bạn" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Email
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-slate-400 pointer-events-none">mail</span>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       autocomplete="email" 
                                       class="w-full pl-10 pr-4 py-3 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-all duration-200"
                                       style="background-color: #f8fafc; border: 1px solid #e2e8f0;"
                                       onfocus="this.style.borderColor='#ff5e00'; this.style.backgroundColor='#ffffff';"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc';"
                                       placeholder="Nhập email của bạn" />
                            </div>
                        </div>

                        <!-- Dịch vụ quan tâm -->
                        <div>
                            <label for="service_interested" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Dịch vụ quan tâm
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-slate-400 pointer-events-none">grid_view</span>
                                <select id="service_interested" 
                                        name="service_interested" 
                                        class="w-full pl-10 pr-10 py-3 rounded-xl text-xs sm:text-sm text-slate-800 focus:outline-none transition-all duration-200 appearance-none cursor-pointer"
                                        style="background-color: #f8fafc; border: 1px solid #e2e8f0;"
                                        onfocus="this.style.borderColor='#ff5e00'; this.style.backgroundColor='#ffffff';"
                                        onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc';">
                                    <option value="" disabled selected>Chọn dịch vụ</option>
                                    <option value="Sản xuất Phim & Video" {{ request('service') == 'media' ? 'selected' : '' }}>Sản xuất Phim &amp; Video</option>
                                    <option value="Thiết kế Website & WebApp" {{ request('service') == 'web-app' ? 'selected' : '' }}>Thiết kế Website &amp; WebApp</option>
                                    <option value="Quảng cáo Google Ads & Facebook" {{ request('service') == 'marketing' ? 'selected' : '' }}>Quảng cáo Google Ads &amp; Facebook</option>
                                    <option value="3D Motion Design & AI Studio" {{ request('service') == 'ai-solutions' ? 'selected' : '' }}>3D Motion Design &amp; AI Studio</option>
                                    <option value="Booking Team Media" {{ request('service') == 'booking-media' ? 'selected' : '' }}>Booking Team Media</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-[18px] text-slate-400 pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Nội dung yêu cầu -->
                        <div>
                            <label for="message" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Nội dung yêu cầu *
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-[18px] text-slate-400 pointer-events-none">chat_bubble</span>
                                <textarea id="message" 
                                          name="message" 
                                          rows="3" 
                                          required 
                                          class="w-full pl-10 pr-4 py-3 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-all duration-200"
                                          style="background-color: #f8fafc; border: 1px solid #e2e8f0;"
                                          onfocus="this.style.borderColor='#ff5e00'; this.style.backgroundColor='#ffffff';"
                                          onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc';"
                                          placeholder="Vui lòng mô tả chi tiết nhu cầu của bạn...">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full py-3.5 px-6 rounded-xl text-white font-headline font-bold text-sm shadow-md transition-all duration-200 cursor-pointer flex items-center justify-center gap-2 hover:opacity-95 hover:shadow-lg active:scale-[0.99]"
                                    style="background-color: #ff5e00; box-shadow: 0 10px 25px -5px rgba(255, 94, 0, 0.4);">
                                <span class="material-symbols-outlined text-[18px] rotate-[-20deg]">send</span>
                                <span>Gửi yêu cầu</span>
                            </button>
                        </div>

                        <!-- Security guarantee note -->
                        <div class="flex items-center justify-center gap-1.5 pt-2 text-center text-xs text-slate-500">
                            <span class="material-symbols-outlined text-[16px] text-emerald-500">verified_user</span>
                            <span class="text-[11px] sm:text-xs">Thông tin của bạn được bảo mật tuyệt đối và chỉ sử dụng để liên hệ tư vấn.</span>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <!-- BOTTOM BANNER: CTA "Cùng Bạn Kiến Tạo Những Giá Trị Bền Vững" -->
        <div class="mt-12 sm:mt-16 rounded-3xl overflow-hidden relative shadow-2xl" style="background: linear-gradient(135deg, #100b07 0%, #1a110a 50%, #0c0805 100%);">
            
            <!-- Clean Background Image overlay with blend -->
            <div class="absolute inset-0 opacity-40 bg-right bg-no-repeat bg-cover pointer-events-none" style="background-image: url('{{ asset('images/contact/cta_workspace_clean.jpg') }}'); background-position: center right;"></div>
            
            <!-- Dark gradient fade from left ensuring text clarity -->
            <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(90deg, #100b07 0%, rgba(16, 11, 7, 0.96) 45%, rgba(16, 11, 7, 0.5) 80%, rgba(16, 11, 7, 0.2) 100%);"></div>

            <div class="relative z-10 px-6 py-8 sm:px-10 sm:py-9 lg:px-12 lg:py-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 sm:gap-8">
                
                <!-- Left Content with Handshake Icon -->
                <div class="flex items-center gap-4 sm:gap-6 flex-1 min-w-0">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center shrink-0 shadow-lg" style="background: rgba(255, 94, 0, 0.15); border: 1.5px solid rgba(255, 94, 0, 0.4); color: #ff5e00;">
                        <span class="material-symbols-outlined text-[32px] sm:text-[36px]">handshake</span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="font-headline font-bold text-xs sm:text-sm uppercase tracking-wider mb-1" style="color: #ff7a1a;">
                            Cùng Bạn Kiến Tạo
                        </div>
                        <h3 class="font-headline font-extrabold text-xl sm:text-2xl lg:text-3xl text-white tracking-tight leading-snug mb-2">
                            Những Giá Trị Bền Vững
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                            Truyền Thông Cửu Long – Đối tác đồng hành tin cậy, mang đến những giải pháp truyền thông sáng tạo và hiệu quả.
                        </p>
                    </div>
                </div>

                <!-- Right Action Button -->
                <div class="shrink-0 self-start md:self-center">
                    <a href="{{ route('services.index') }}" 
                       class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3.5 sm:py-4 rounded-full text-white font-headline font-bold text-xs sm:text-sm whitespace-nowrap shadow-xl transition-transform duration-300 hover:scale-105 active:scale-95"
                       style="background: linear-gradient(135deg, #ff5e00 0%, #ff7a18 100%); box-shadow: 0 10px 25px -5px rgba(255, 94, 0, 0.5);">
                        <span>Khám phá dịch vụ</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
