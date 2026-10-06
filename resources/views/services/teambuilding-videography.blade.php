@extends('layouts.app')

@section('title', 'Dịch Vụ Quay Phim TeamBuilding Chuyên Nghiệp • Lưu Giữ Khoảnh Khắc Vàng - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ quay phim teambuilding chuyên nghiệp, ghi lại trọn vẹn những khoảnh khắc gắn kết, năng lượng và tinh thần đồng đội của doanh nghiệp bạn. Flycam 4K, giao file nhanh.')

@section('content')
<div class="w-full bg-[#fcfdff] text-slate-800 antialiased overflow-x-hidden font-body"
     x-data="{
         videoModal: false,
         videoTitle: '',
         videoUrl: '',
         openVideo(title, url) {
             this.videoTitle = title || 'Video Highlight TeamBuilding';
             this.videoUrl = url || 'https://www.youtube.com/embed/dQw4w9WgXcQ';
             this.videoModal = true;
         },
         closeVideo() {
             this.videoModal = false;
             this.videoUrl = '';
         },
         activeTestimonial: 0,
         testimonials: [
             {
                 quote: 'Đội ngũ chuyên nghiệp, nhiệt tình và bắt trọn rất nhiều khoảnh khắc đẹp của công ty chúng tôi trong suốt chuyến đi. Ảnh chất lượng cao, đúng tinh thần của chương trình. Chúng tôi rất hài lòng!',
                 name: 'Anh Tuấn',
                    role: 'Marketing Manager',
                 avatar: 'AT'
             },
             {
                 quote: 'Video teambuilding được dựng rất cảm xúc và năng động, hiệu ứng âm thanh và màu sắc tuyệt vời. Ban lãnh đạo và toàn thể nhân viên đều rất khen ngợi.',
                 name: 'Chị Mai Lan',
                    role: 'HR Director',
                 avatar: 'ML'
             },
             {
                 quote: 'Ekip quay phim đúng giờ, thiết bị flycam 4K sắc nét và bắt kịp mọi góc độ hoạt động bãi biển náo nhiệt. Bàn giao video highlight đúng hạn cam kết!',
                 name: 'Anh Hoàng Nam',
                    role: 'Event Organizer',
                 avatar: 'HN'
             }
         ],
         nextTestimonial() {
             this.activeTestimonial = (this.activeTestimonial + 1) % this.testimonials.length;
         },
         prevTestimonial() {
             this.activeTestimonial = (this.activeTestimonial - 1 + this.testimonials.length) % this.testimonials.length;
         }
     }">

    <!-- Preload Caveat font with full Vietnamese support -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&subset=vietnamese&display=swap" rel="stylesheet">

    <!-- Custom CSS strictly mimicking the mockup -->
    <style>
        .badge-teambuilding-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 16px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: 1.5px solid #ff5400;
            color: #ff5400;
            background: rgba(255, 84, 0, 0.06);
        }
        .badge-teambuilding-dark-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 16px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: 1px solid rgba(255, 84, 0, 0.4);
            color: #ff7a1a;
            background: rgba(255, 84, 0, 0.12);
        }
        .btn-brand-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #ff5400;
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 9999px;
            transition: all 0.25s ease-in-out;
            box-shadow: 0 8px 20px -4px rgba(255, 84, 0, 0.38);
        }
        .btn-brand-primary:hover {
            background-color: #e04800;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -4px rgba(255, 84, 0, 0.48);
        }
        .btn-brand-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: transparent;
            color: #ff5400;
            font-weight: 700;
            border: 1.5px solid #ff5400;
            border-radius: 9999px;
            transition: all 0.25s ease-in-out;
        }
        .btn-brand-outline:hover {
            background-color: #ff5400;
            color: #ffffff;
            box-shadow: 0 8px 20px -4px rgba(255, 84, 0, 0.35);
        }
        .handwritten-font {
            font-family: 'Caveat', cursive !important;
            font-weight: 700;
        }
        .feature-icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #ff5400 !important;
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.35);
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }
        .feature-icon-circle:hover {
            transform: scale(1.08);
        }
        .feature-icon-circle .material-symbols-outlined {
            font-size: 22px !important;
            color: #ffffff !important;
        }
        .highlight-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 9999px;
            background-color: #ff5400 !important;
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
            transition: transform 0.2s ease;
        }
        .highlight-icon-circle:hover {
            transform: scale(1.06);
        }
        .highlight-icon-circle .material-symbols-outlined {
            font-size: 24px !important;
            color: #ffffff !important;
        }
        .bg-\[\#ff5400\] {
            background-color: #ff5400 !important;
        }
        .text-\[\#ff5400\] {
            color: #ff5400 !important;
        }
        .border-\[\#ff5400\] {
            border-color: #ff5400 !important;
        }
        .shadow-\[\#ff5400\]\/30 {
            box-shadow: 0 4px 14px 0 rgba(255, 84, 0, 0.3) !important;
        }
        .shadow-\[\#ff5400\]\/50 {
            box-shadow: 0 10px 25px -3px rgba(255, 84, 0, 0.5) !important;
        }
        .section-dark-navy {
            background-color: #070d18 !important;
            color: #ffffff !important;
        }
        .testimonial-glass-card {
            background: rgba(255, 255, 255, 0.04) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .testimonial-nav-btn {
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #cbd5e1 !important;
            background: transparent !important;
        }
        .testimonial-nav-btn:hover {
            border-color: #ff5400 !important;
            color: #ffffff !important;
            background: rgba(255, 84, 0, 0.2) !important;
        }


        .pulse-play-ring {
            box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7);
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7);
            }
            70% {
                box-shadow: 0 0 0 18px rgba(255, 84, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 84, 0, 0);
            }
        }
        .hero-banner-videography {
            background: linear-gradient(90deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 45%, rgba(255,255,255,0.15) 80%, rgba(255,255,255,0) 100%), 
                        url('{{ asset("images/quay-phim-teambuilding/hero_banner.png") }}');
            background-size: cover;
            background-position: right center;
            background-repeat: no-repeat;
        }
        @media (max-width: 768px) {
            .hero-banner-videography {
                background: linear-gradient(180deg, rgba(255,255,255,0.97) 0%, rgba(255,255,255,0.88) 60%, rgba(255,255,255,0.5) 100%), 
                            url('{{ asset("images/quay-phim-teambuilding/hero_banner.png") }}');
                background-position: center center;
            }
        }
        .pricing-card-featured {
            border: 2px solid #ff5400 !important;
            box-shadow: 0 20px 40px -15px rgba(255, 84, 0, 0.22) !important;
            position: relative;
        }
        .cta-bottom-gradient {
            background: linear-gradient(135deg, #ff4e00 0%, #ff5e00 50%, #ff7600 100%);
        }
    </style>

    <!-- ==========================================
         SECTION 1: HERO BANNER (BEACH CAMERAMAN)
         ========================================== -->
    <section class="relative pt-24 sm:pt-28 md:pt-32 pb-16 sm:pb-24 lg:pb-32 hero-banner-videography overflow-hidden">
        <!-- Floating decorative brush in top-right corner if needed -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Content -->
                <div class="lg:col-span-7 xl:col-span-6 space-y-5 sm:space-y-6 pt-4">
                    <!-- Pill Tag -->
                    <div>
                        <span class="badge-teambuilding-pill">
                            QUAY PHIM TEAMBUILDING
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[52px] font-black text-[#070d18] leading-[1.18] tracking-tight">
                        Lưu Giữ Khoảnh Khắc <br>
                        <span class="text-[#ff5400]">Vàng Của Doanh Nghiệp</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-slate-600 text-sm sm:text-base md:text-lg leading-relaxed max-w-xl font-normal">
                        Dịch vụ quay phim team building chuyên nghiệp, ghi lại trọn vẹn những khoảnh khắc gắn kết, năng lượng và tinh thần đồng đội của doanh nghiệp bạn.
                    </p>

                    <!-- Mobile only handwritten script note -->
                    <div class="lg:hidden pt-1 pb-2">
                        <div class="handwritten-font text-[#ff5400] text-xl sm:text-2xl font-bold leading-[1.2] select-none transform rotate-[-2.5deg]">
                            <div class="relative inline-block">
                                <span class="absolute -top-2.5 -left-6 text-[#ff5400]">
                                    <svg class="w-5 h-5 inline-block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round">
                                        <line x1="8" y1="4" x2="14" y2="10"></line>
                                        <line x1="2" y1="11" x2="9" y2="14"></line>
                                        <line x1="1" y1="19" x2="8" y2="18"></line>
                                    </svg>
                                </span>
                                Video chất lượng cao<br>
                                Kể câu chuyện thương hiệu<br>
                                <span class="relative inline-block">
                                    doanh nghiệp bạn!
                                    <svg class="w-full h-2 text-[#ff5400] mt-0.5" viewBox="0 0 200 8" fill="none" preserveAspectRatio="none">
                                        <path d="M2 5 Q 100 8 198 3" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 4 FEATURE ITEMS (MATCHING MOCKUP: CLEAN TRANSPARENT, SOLID ORANGE CIRCLE ICONS) -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 max-w-2xl pt-2 pb-1">
                        <!-- Item 1 -->
                        <div class="flex flex-col items-center text-center">
                            <div class="feature-icon-circle">
                                <span class="material-symbols-outlined">videocam</span>
                            </div>
                            <h3 class="text-xs sm:text-[13px] font-extrabold text-[#070d18] mt-2 tracking-tight">Đội ngũ chuyên nghiệp</h3>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 leading-snug mt-0.5 max-w-[125px]">Kinh nghiệm, sáng tạo, bắt trọn mọi khoảnh khắc.</p>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex flex-col items-center text-center">
                            <div class="feature-icon-circle">
                                <span class="material-symbols-outlined">movie</span>
                            </div>
                            <h3 class="text-xs sm:text-[13px] font-extrabold text-[#070d18] mt-2 tracking-tight">Thiết bị hiện đại</h3>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 leading-snug mt-0.5 max-w-[125px]">Hình ảnh sắc nét, âm thanh sống động.</p>
                        </div>

                        <!-- Item 3 -->
                        <div class="flex flex-col items-center text-center">
                            <div class="feature-icon-circle">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                            <h3 class="text-xs sm:text-[13px] font-extrabold text-[#070d18] mt-2 tracking-tight">Dựng phim ấn tượng</h3>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 leading-snug mt-0.5 max-w-[125px]">Câu chuyện sinh động, truyền cảm hứng.</p>
                        </div>

                        <!-- Item 4 -->
                        <div class="flex flex-col items-center text-center">
                            <div class="feature-icon-circle">
                                <span class="material-symbols-outlined">verified_user</span>
                            </div>
                            <h3 class="text-xs sm:text-[13px] font-extrabold text-[#070d18] mt-2 tracking-tight">Giao sản phẩm đúng hẹn</h3>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 leading-snug mt-0.5 max-w-[125px]">Chất lượng cam kết, hỗ trợ tận tâm.</p>
                        </div>
                    </div>

                    <!-- CTA Button (BELOW THE 4 CARDS) -->
                    <div class="pt-2">
                        <a href="tel:0939363262" class="btn-brand-primary px-8 py-3.5 text-sm sm:text-base font-bold uppercase tracking-wide">
                            <span>LIÊN HỆ TƯ VẤN NGAY</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column (Empty spacer for grid) -->
                <div class="hidden lg:block lg:col-span-5 xl:col-span-5"></div>
            </div>

            <!-- Desktop Script Note (Positioned high in the clear blue sky above gate and crowd, exactly as mockup) -->
            <div class="hidden lg:block absolute z-20 pointer-events-none" style="top: 18px; left: 42%;">
                <div class="handwritten-font text-[#ff5400] font-bold leading-[1.18] drop-shadow-sm select-none" style="font-size: 29px; transform: rotate(-3.5deg);">
                    <div class="relative inline-block">
                        <!-- 3 radiant rays in top-left matching mockup -->
                        <span class="absolute text-[#ff5400]" style="top: -8px; left: -26px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round">
                                <line x1="8" y1="4" x2="14" y2="10"></line>
                                <line x1="2" y1="11" x2="9" y2="14"></line>
                                <line x1="1" y1="19" x2="8" y2="18"></line>
                            </svg>
                        </span>
                        Video chất lượng cao
                    </div>
                    <div>Kể câu chuyện thương hiệu</div>
                    <div class="relative inline-block">
                        doanh nghiệp bạn!
                        <!-- Orange hand-drawn brush underline matching mockup -->
                        <svg class="absolute text-[#ff5400]" style="bottom: -7px; left: -2px; width: 104%; height: 10px;" viewBox="0 0 200 10" fill="none" preserveAspectRatio="none">
                            <path d="M2 6 Q 100 9 198 4" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- ==========================================
         SECTION 2: 4 FLOATING HIGHLIGHT CARDS
         ========================================== -->
    <section class="relative z-20 -mt-8 sm:-mt-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl shadow-slate-200/70 border border-slate-100 p-6 sm:p-8 lg:p-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:divide-x lg:divide-slate-100">
                <!-- Item 1: Bắt trọn khoảnh khắc -->
                <div class="flex items-start gap-4 lg:pr-4">
                    <div class="highlight-icon-circle">
                        <span class="material-symbols-outlined">videocam</span>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-[#070d18] tracking-tight">Bắt trọn khoảnh khắc</h2>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mt-1">Lưu giữ những khoảnh khắc tự nhiên, chân thực và đầy cảm xúc.</p>
                    </div>
                </div>

                <!-- Item 2: Đội ngũ chuyên nghiệp -->
                <div class="flex items-start gap-4 lg:px-4">
                    <div class="highlight-icon-circle">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-[#070d18] tracking-tight">Đội ngũ chuyên nghiệp</h2>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mt-1">Nhiếp ảnh gia giàu kinh nghiệm, hiểu rõ từng góc bấm đỉnh cao sự kiện.</p>
                    </div>
                </div>

                <!-- Item 3: Chỉnh sửa tinh tế -->
                <div class="flex items-start gap-4 lg:px-4">
                    <div class="highlight-icon-circle">
                        <span class="material-symbols-outlined">bolt</span>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-[#070d18] tracking-tight">Chỉnh sửa tinh tế</h2>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mt-1">Hình ảnh sắc nét, màu sắc sống động, đúng tinh thần chương trình.</p>
                    </div>
                </div>

                <!-- Item 4: Giao ảnh nhanh -->
                <div class="flex items-start gap-4 lg:pl-4">
                    <div class="highlight-icon-circle">
                        <span class="material-symbols-outlined">photo_library</span>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-[#070d18] tracking-tight">Giao ảnh nhanh</h2>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mt-1">Hoàn thiện và bàn giao đúng hẹn, đáp ứng mọi nhu cầu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 3: VỀ DỊCH VỤ (ABOUT SECTION)
         ========================================== -->
    <section class="py-16 sm:py-24 relative overflow-hidden" id="ve-dich-vu">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Left Column -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="badge-teambuilding-pill">
                            VỀ DỊCH VỤ
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#070d18] leading-tight tracking-tight">
                        Quay Phim TeamBuilding <br>
                        <span class="text-[#ff5400]">Chuyên Nghiệp – Sáng Tạo – Hiệu Quả</span>
                    </h2>

                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Chúng tôi mang đến giải pháp quay phim, chụp ảnh team building chuyên nghiệp, giúp doanh nghiệp lưu giữ trọn vẹn những khoảnh khắc đáng nhớ, lan tỏa tinh thần đoàn kết và giá trị thương hiệu.
                    </p>

                    <!-- 3 Stats Counter -->
                    <div class="grid grid-cols-3 gap-4 pt-2 pb-2">
                        <!-- Stat 1 -->
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[#ff5400] text-2xl mt-0.5">star</span>
                            <div>
                                <div class="text-xl sm:text-2xl font-black text-[#070d18]">5+</div>
                                <div class="text-xs text-slate-500 font-medium">Năm kinh nghiệm</div>
                            </div>
                        </div>

                        <!-- Stat 2 -->
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[#ff5400] text-2xl mt-0.5">group</span>
                            <div>
                                <div class="text-xl sm:text-2xl font-black text-[#070d18]">200+</div>
                                <div class="text-xs text-slate-500 font-medium">Dự án đã thực hiện</div>
                            </div>
                        </div>

                        <!-- Stat 3 -->
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[#ff5400] text-2xl mt-0.5">favorite</span>
                            <div>
                                <div class="text-xl sm:text-2xl font-black text-[#070d18]">100%</div>
                                <div class="text-xs text-slate-500 font-medium">Khách hàng hài lòng</div>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pt-2">
                        <a href="{{ route('projects.index') }}" class="btn-brand-primary px-7 py-3.5 text-sm">
                            <span>Xem các dự án đã thực hiện</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Video Play Card with Giant Ball -->
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border border-slate-100 group cursor-pointer"
                         @click="openVideo('Quay Phim Teambuilding - Năng Lượng & Kết Nối', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        <img src="{{ asset('images/chup-anh-teambuilding/giant_ball_game.png') }}" 
                             alt="Hoạt động quay phim teambuilding bãi biển" 
                             class="w-full h-[320px] sm:h-[400px] object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-slate-900/20 transition-colors"></div>

                        <!-- Central Play Button -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-[#ff5400] flex items-center justify-center text-white shadow-2xl shadow-[#ff5400]/50 pulse-play-ring group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl sm:text-4xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>

                    <!-- Handwritten note in bottom right corner -->
                    <div class="handwritten-font text-[#ff5400] text-xl sm:text-2xl font-bold text-right mt-3 select-none transform rotate-[-2deg]">
                        Những khoảnh khắc <br>
                        đáng nhớ cùng nhau!
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 4: CÁC GÓI QUAY PHIM TEAMBUILDING (PRICING)
         ========================================== -->
    <section class="py-16 sm:py-20 bg-slate-50/60 relative overflow-hidden" id="bao-gia">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 sm:mb-16">
                <div>
                    <span class="badge-teambuilding-pill mb-3">
                        GÓI DỊCH VỤ
                    </span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#070d18] tracking-tight">
                        Các Gói Quay Phim TeamBuilding
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-2">
                        Linh hoạt theo nhu cầu của từng doanh nghiệp, từ sự kiện nhỏ đến chương trình quy mô lớn.
                    </p>
                </div>

                <div class="handwritten-font text-[#ff5400] text-xl sm:text-2xl font-bold select-none transform md:rotate-[-3deg] md:text-right">
                    Lựa chọn gói phù hợp <br>
                    cho mọi quy mô doanh nghiệp
                </div>
            </div>

            <!-- Pricing Grid: 3 Packages -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                
                <!-- Package 1: Gói Cơ Bản -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 flex flex-col justify-between shadow-sm hover:shadow-xl transition-all duration-300">
                    <div>
                        <!-- Thumbnail -->
                        <div class="relative rounded-2xl overflow-hidden mb-5">
                            <img src="{{ asset('images/chup-anh-teambuilding/team_arms_ocean.png') }}" 
                                 alt="Gói Cơ Bản" 
                                 class="w-full h-44 object-cover object-center">
                            <div class="absolute bottom-2.5 left-1/2 -translate-x-1/2">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-orange-100/90 backdrop-blur-sm text-[#ff5400] border border-orange-200 whitespace-nowrap shadow-xs">
                                    🏆 GÓI CƠ BẢN
                                </span>
                            </div>
                        </div>

                        <!-- Title & Description -->
                        <h3 class="text-xl font-extrabold text-[#070d18]">Gói Cơ Bản</h3>
                        <p class="text-xs text-slate-500 mt-1 mb-5">Phù hợp cho các chương trình nhỏ, trong ngày.</p>

                        <!-- Feature List -->
                        <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Quay phim Full HD (1–2 máy)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Chụp ảnh theo thời gian yêu cầu</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Dựng video ngắn 3 – 5 phút</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Giao file qua Google Drive</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Price & CTA -->
                    <div class="pt-8 mt-6 border-t border-slate-100">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">CHỈ TỪ</div>
                        <div class="text-2xl sm:text-3xl font-black text-[#ff5400] tracking-tight mt-0.5 mb-5">
                            5.000.000đ
                        </div>
                        <a href="tel:0939363262" class="btn-brand-primary w-full py-3 text-sm">
                            <span>Đăng ký tư vấn</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Package 2: Gói Nâng Cao (FEATURED / GÓI ĐƯỢC CHỌN NHIỀU NHẤT) -->
                <div class="bg-white rounded-3xl pricing-card-featured p-6 flex flex-col justify-between transition-all duration-300 md:-translate-y-2">
                    <div>
                        <!-- Top Banner Badge -->
                        <div class="bg-[#ff5400] text-white text-xs font-black uppercase tracking-wider py-1.5 px-4 text-center rounded-2xl -mt-6 -mx-6 mb-4 shadow-sm">
                            ★ GÓI ĐƯỢC CHỌN NHIỀU NHẤT ★
                        </div>

                        <!-- Thumbnail -->
                        <div class="relative rounded-2xl overflow-hidden mb-5">
                            <img src="{{ asset('images/chup-anh-teambuilding/hero_teambuilding.png') }}" 
                                 alt="Gói Nâng Cao" 
                                 class="w-full h-44 object-cover object-center">
                            <div class="absolute bottom-2.5 left-1/2 -translate-x-1/2">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-orange-100/90 backdrop-blur-sm text-[#ff5400] border border-orange-200 whitespace-nowrap shadow-xs">
                                    🏆 GÓI NÂNG CAO
                                </span>
                            </div>
                        </div>

                        <!-- Title & Description -->
                        <h3 class="text-xl font-extrabold text-[#070d18]">Gói Nâng Cao</h3>
                        <p class="text-xs text-slate-500 mt-1 mb-5">Dành cho các sự kiện quy mô vừa và lớn.</p>

                        <!-- Feature List -->
                        <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Quay phim 4K (2-3 máy)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Chụp ảnh chuyên sâu (Color Grading)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Dựng video 5 – 10 phút</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Hỗ trợ tư vấn concept & kịch bản góc máy</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Giao toàn bộ ảnh và video gốc</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Price & CTA -->
                    <div class="pt-8 mt-6 border-t border-slate-100">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">CHỈ TỪ</div>
                        <div class="text-2xl sm:text-3xl font-black text-[#ff5400] tracking-tight mt-0.5 mb-5">
                            8.000.000đ
                        </div>
                        <a href="tel:0939363262" class="btn-brand-primary w-full py-3 text-sm">
                            <span>Đăng ký tư vấn</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Package 3: Gói Cao Cấp -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 flex flex-col justify-between shadow-sm hover:shadow-xl transition-all duration-300">
                    <div>
                        <!-- Thumbnail -->
                        <div class="relative rounded-2xl overflow-hidden mb-5">
                            <img src="{{ asset('images/chup-anh-teambuilding/team_cheer_flag.png') }}" 
                                 alt="Gói Cao Cấp" 
                                 class="w-full h-44 object-cover object-center">
                            <div class="absolute bottom-2.5 left-1/2 -translate-x-1/2">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-orange-100/90 backdrop-blur-sm text-[#ff5400] border border-orange-200 whitespace-nowrap shadow-xs">
                                    🏆 GÓI CAO CẤP
                                </span>
                            </div>
                        </div>

                        <!-- Title & Description -->
                        <h3 class="text-xl font-extrabold text-[#070d18]">Gói Cao Cấp</h3>
                        <p class="text-xs text-slate-500 mt-1 mb-5">Giải pháp toàn diện cho doanh nghiệp lớn, tổ chức sự kiện đặc biệt.</p>

                        <!-- Feature List -->
                        <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Quay phim 4K flycam (toàn cảnh nếu cần)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Chỉnh sửa chuyên nghiệp từng shot hình</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Giao ảnh nhanh trong ngày</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Hỗ trợ truyền thông đa nền tảng (Social Ready)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[#ff5400] text-base shrink-0 mt-0.5 font-bold">check</span>
                                <span>Tùy chỉnh theo yêu cầu riêng</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Price & CTA -->
                    <div class="pt-8 mt-6 border-t border-slate-100">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">CHỈ TỪ</div>
                        <div class="text-2xl sm:text-3xl font-black text-[#ff5400] tracking-tight mt-0.5 mb-5">
                            12.000.000đ
                        </div>
                        <a href="tel:0939363262" class="btn-brand-outline w-full py-3 text-sm">
                            <span>Đăng ký tư vấn</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 5: KHÁCH HÀNG NÓI GÌ (DARK TESTIMONIAL)
         ========================================== -->
    <section class="py-16 sm:py-24 section-dark-navy relative overflow-hidden" id="danh-gia" style="background-color: #070d18 !important; color: #ffffff !important;">
        <!-- Ambient background lights -->
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full blur-3xl pointer-events-none" style="background-color: rgba(255, 84, 0, 0.12);"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full blur-3xl pointer-events-none" style="background-color: rgba(37, 99, 235, 0.12);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left Column (approx 4 cols) -->
                <div class="lg:col-span-4 space-y-4">
                    <div>
                        <span class="badge-teambuilding-dark-pill">
                            ★ KHÁCH HÀNG NÓI GÌ
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight leading-tight" style="color: #ffffff !important;">
                        Khách Hàng Nói Gì Về Chúng Tôi
                    </h2>

                    <p class="text-sm leading-relaxed" style="color: #94a3b8 !important;">
                        Sự hài lòng của khách hàng là động lực để chúng tôi không ngừng hoàn thiện.
                    </p>

                    <div class="pt-2">
                        <a href="tel:0939363262" class="btn-brand-primary px-6 py-3 text-sm">
                            <span>Xem thêm đánh giá</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Center Column: Testimonial Card (approx 5 cols) -->
                <div class="lg:col-span-5 relative">
                    <div class="testimonial-glass-card rounded-3xl p-6 sm:p-8 relative">
                        <!-- Quotation icon -->
                        <div class="text-4xl sm:text-5xl font-serif leading-none mb-3 opacity-90" style="color: #ff5400 !important;">
                            “
                        </div>

                        <!-- Quote content -->
                        <p class="text-sm sm:text-base leading-relaxed italic min-h-[96px]"
                           style="color: #e2e8f0 !important;"
                           x-text="'“' + testimonials[activeTestimonial].quote + '”'">
                            “Đội ngũ chuyên nghiệp, nhiệt tình và bắt trọn rất nhiều khoảnh khắc đẹp của công ty chúng tôi trong suốt chuyến đi. Ảnh chất lượng cao, đúng tinh thần của chương trình. Chúng tôi rất hài lòng!”
                        </p>

                        <!-- Nav arrows -->
                        <div class="flex items-center justify-between mt-6 pt-4 border-t" style="border-top-color: rgba(255, 255, 255, 0.1);">
                            <div class="flex items-center gap-3">
                                <!-- Avatar initials -->
                                <div class="w-10 h-10 rounded-full text-white font-bold flex items-center justify-center text-sm shadow-md"
                                     style="background-color: #ff5400 !important; color: #ffffff !important;"
                                     x-text="testimonials[activeTestimonial].avatar">
                                    AT
                                </div>
                                <div>
                                    <div class="font-extrabold text-sm" style="color: #ffffff !important;" x-text="testimonials[activeTestimonial].name">Anh Tuấn</div>
                                    <div class="text-xs" style="color: #94a3b8 !important;" x-text="testimonials[activeTestimonial].role">Marketing Manager</div>
                                </div>
                            </div>

                            <!-- Prev / Next arrows -->
                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        @click="prevTestimonial()" 
                                        class="w-8 h-8 rounded-full testimonial-nav-btn flex items-center justify-center transition-all"
                                        aria-label="Previous testimonial">
                                    <span class="material-symbols-outlined text-base">chevron_left</span>
                                </button>
                                <button type="button" 
                                        @click="nextTestimonial()" 
                                        class="w-8 h-8 rounded-full testimonial-nav-btn flex items-center justify-center transition-all"
                                        aria-label="Next testimonial">
                                    <span class="material-symbols-outlined text-base">chevron_right</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Dots -->
                    <div class="flex items-center justify-center gap-2 mt-4">
                        <template x-for="(t, index) in [0, 1, 2, 3, 4]" :key="index">
                            <button type="button" 
                                    @click="activeTestimonial = index % testimonials.length"
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :style="(activeTestimonial === index % testimonials.length) ? 'width: 24px; background-color: #ff5400 !important;' : 'width: 8px; background-color: rgba(255, 255, 255, 0.25) !important;'">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Right Column: 3 Video Thumbnails with Play button (approx 3 cols) -->
                <div class="lg:col-span-3 space-y-3.5">
                    <!-- Thumb 1 -->
                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer border shadow-lg"
                         style="border-color: rgba(255, 255, 255, 0.1);"
                         @click="openVideo('Video Highlight Teambuilding Bãi Biển', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        <img src="{{ asset('images/chup-anh-teambuilding/team_arms_ocean.png') }}" 
                             alt="Video thumbnail 1" 
                             class="w-full h-24 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/40 transition-colors flex items-center justify-center">
                            <div class="w-9 h-9 rounded-full text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform" style="background-color: #ff5400 !important;">
                                <span class="material-symbols-outlined text-xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>

                    <!-- Thumb 2 -->
                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer border shadow-lg"
                         style="border-color: rgba(255, 255, 255, 0.1);"
                         @click="openVideo('Trò Chơi Bóng Khổng Lồ Teambuilding', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        <img src="{{ asset('images/chup-anh-teambuilding/giant_ball_game.png') }}" 
                             alt="Video thumbnail 2" 
                             class="w-full h-24 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/40 transition-colors flex items-center justify-center">
                            <div class="w-9 h-9 rounded-full text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform" style="background-color: #ff5400 !important;">
                                <span class="material-symbols-outlined text-xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>

                    <!-- Thumb 3 -->
                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer border shadow-lg"
                         style="border-color: rgba(255, 255, 255, 0.1);"
                         @click="openVideo('Hoàng Hôn Đồng Đội Teambuilding', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        <img src="{{ asset('images/chup-anh-teambuilding/sunset_team_cheer.png') }}" 
                             alt="Video thumbnail 3" 
                             class="w-full h-24 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/40 transition-colors flex items-center justify-center">
                            <div class="w-9 h-9 rounded-full text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform" style="background-color: #ff5400 !important;">
                                <span class="material-symbols-outlined text-xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 6: CTA BANNER (ORANGE GRADIENT WITH CONTACT BOX)
         ========================================== -->
    <section class="py-12 sm:py-16 section-dark-navy relative" style="background-color: #070d18 !important;">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="cta-bottom-gradient rounded-3xl p-6 sm:p-10 md:p-12 relative overflow-hidden text-white shadow-2xl">
                <!-- Silhouette watermark pattern on right -->
                <div class="absolute right-0 bottom-0 top-0 w-1/3 opacity-20 pointer-events-none hidden lg:block"
                     style="background: url('{{ asset("images/chup-anh-teambuilding/sunset_team_cheer.png") }}') center right / cover no-repeat; mix-blend-mode: overlay;">
                </div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left Title -->
                    <div class="lg:col-span-5 space-y-2">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-black leading-tight text-white tracking-tight">
                            Sẵn Sàng Lưu Giữ <br>
                            Khoảnh Khắc Của Bạn?
                        </h2>
                        <p class="text-white/90 text-xs sm:text-sm leading-relaxed max-w-md">
                            Liên hệ ngay với chúng tôi để được tư vấn gói quay phim team building phù hợp nhất cho doanh nghiệp của bạn.
                        </p>
                    </div>

                    <!-- Right Contact White Box & Cursive Flourish -->
                    <div class="lg:col-span-7 flex flex-col md:flex-row items-center gap-6 justify-end">
                        
                        <!-- Floating White Capsule Card -->
                        <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 text-slate-800 shadow-2xl w-full md:w-auto flex flex-col sm:flex-row items-center gap-6">
                            <!-- Info Column -->
                            <div class="space-y-2 text-xs sm:text-sm w-full sm:w-auto">
                                <div class="flex items-center gap-2.5 font-bold text-slate-900">
                                    <span class="material-symbols-outlined text-[#ff5400] text-lg">call</span>
                                    <span>0939.363.262</span>
                                </div>
                                <div class="flex items-center gap-2.5 text-slate-600">
                                    <span class="material-symbols-outlined text-[#ff5400] text-lg">mail</span>
                                    <span>info@truyenthongcuulong.com</span>
                                </div>
                                <div class="flex items-center gap-2.5 text-slate-600">
                                    <span class="material-symbols-outlined text-[#ff5400] text-lg">location_on</span>
                                    <span>Lầu 5 số 57 Hùng Vương, P.Ninh Kiều, TP.Cần Thơ</span>
                                </div>
                            </div>

                            <!-- Action button inside box -->
                            <div class="w-full sm:w-auto">
                                <a href="tel:0939363262" class="btn-brand-primary w-full sm:w-auto px-7 py-3 text-sm whitespace-nowrap">
                                    <span>Liên hệ ngay</span>
                                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                                </a>
                            </div>
                        </div>

                        <!-- Handwritten text note on far right -->
                        <div class="handwritten-font text-white text-xl sm:text-2xl font-bold leading-tight select-none transform md:rotate-[-4deg] text-center md:text-right hidden xl:block shrink-0">
                            Cùng tạo nên <br>
                            những thước phim ý nghĩa!
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         LIGHTBOX / VIDEO POPUP MODAL
         ========================================== -->
    <div x-show="videoModal" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-md"
         @keydown.escape.window="closeVideo()">
        <div class="relative w-full max-w-4xl bg-slate-900 rounded-2xl overflow-hidden shadow-2xl border border-white/10"
             @click.away="closeVideo()">
            <div class="flex items-center justify-between p-4 bg-slate-950/90 border-b border-white/10">
                <h3 class="text-white text-sm sm:text-base font-bold truncate pr-4" x-text="videoTitle"></h3>
                <button type="button" @click="closeVideo()" class="text-slate-400 hover:text-white p-1 rounded-lg">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
            </div>
            <div class="relative w-full pb-[56.25%] bg-black">
                <iframe class="absolute inset-0 w-full h-full" 
                        :src="videoUrl" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>

</div>
@endsection
