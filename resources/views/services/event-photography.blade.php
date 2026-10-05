@extends('layouts.app')

@section('title', 'Dịch Vụ Chụp Ảnh Sự Kiện Chuyên Nghiệp Tại Cần Thơ & Miền Tây • Bắt Trọn Khoảnh Khắc - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ chụp ảnh sự kiện, hội nghị, khai trương, gala dinner và teambuilding chuyên nghiệp tại Cần Thơ và ĐBSCL. Máy ảnh Full-frame cao cấp, bàn giao ảnh trong 24h, hỗ trợ Live Photo QR xem ảnh trực tiếp.')

@section('content')
<div class="w-full bg-[#fcfdff] text-slate-800 antialiased overflow-x-hidden" style="font-family: var(--font-primary, 'Mulish', sans-serif);">

    <!-- Google Font Alex Brush & Dancing Script cho chữ ký nghệ thuật -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Dancing+Script:wght@400;500;600;700&display=swap">

    <!-- ==========================================
         1. HERO SECTION (BANNER ĐẦU TRANG)
         ========================================== -->
    <section class="relative w-full overflow-hidden border-b border-orange-500/20 pt-20 flex items-center min-h-[480px] lg:min-h-[520px] xl:min-h-[550px]"
             style="background-color: #040812;">
        
        <!-- Full-Width Background Image (hero-event-photo.png) -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/chup-anh-su-kien/hero-event-photo.png') }}?v={{ time() }}" 
                 alt="Dịch vụ chụp ảnh sự kiện chuyên nghiệp Cần Thơ - Truyền Thông Cửu Long" 
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                 class="w-full h-full object-cover object-[72%_center] lg:object-center select-none pointer-events-none">
            
            <!-- Fallback Elegant Studio Backdrop if image is being created -->
            <div class="absolute inset-0 hidden pointer-events-none"
                 style="background: radial-gradient(circle at 75% 45%, rgba(255, 84, 0, 0.18) 0%, rgba(15, 23, 42, 0.85) 50%, #040812 100%);"></div>

            <!-- Twilight Dark Vignette (Ensure 100% crisp readability for left side text) -->
            <div class="absolute inset-0 pointer-events-none"
                 style="background: linear-gradient(to right, rgba(4, 8, 18, 0.94) 0%, rgba(4, 8, 18, 0.80) 42%, rgba(4, 8, 18, 0.35) 65%, transparent 100%); width: 65%;"></div>
            <div class="absolute inset-0 sm:hidden pointer-events-none"
                 style="background: linear-gradient(to top, rgba(4, 8, 18, 0.95) 0%, transparent 50%, rgba(4, 8, 18, 0.3) 100%);"></div>
        </div>

        <!-- Content Container -->
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10 relative z-10">
            <div class="max-w-xl lg:max-w-2xl xl:max-w-[54%] flex flex-col justify-center" style="gap: 14px;">
                
                <!-- Tag / Category -->
                <div>
                    <span style="color: #ff5400; font-weight: 800; font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; font-family: 'Mulish', monospace, sans-serif; text-shadow: 0 1px 4px rgba(0,0,0,0.95);">
                        DỊCH VỤ QUAY CHỤP &amp; MEDIA SỰ KIỆN
                    </span>
                </div>

                <!-- Main H1 (2 Lines: White + Fiery Orange) -->
                <h1 style="margin: 0; line-height: 1.15; letter-spacing: -0.02em;">
                    <span style="color: #ffffff; font-weight: 900; font-size: clamp(28px, 3.4vw, 44px); display: block; text-shadow: 0 2px 10px rgba(0,0,0,0.95);">
                        Chụp Ảnh Sự Kiện Chuyên Nghiệp
                    </span>
                    <span style="color: #ff5400; font-weight: 900; font-size: clamp(28px, 3.4vw, 44px); display: block; margin-top: 4px; text-shadow: 0 2px 12px rgba(0,0,0,0.95);">
                        Bắt Trọn Khoảnh Khắc Đắt Giá
                    </span>
                </h1>

                <!-- Description Paragraph -->
                <p style="color: #cbd5e1; font-size: 14.5px; line-height: 1.6; max-width: 540px; margin: 0; text-shadow: 0 1px 4px rgba(0,0,0,0.95);">
                    Ghi lại trọn vẹn cảm xúc, sự trang trọng và quy mô của sự kiện với hệ thống máy ảnh Full-frame cao cấp. Bàn giao ảnh nhanh trong 24h, hỗ trợ Live Photo QR xem ảnh trực tiếp tại sự kiện.
                </p>

                <!-- 4 Feature Badges (2 Columns x 2 Rows) -->
                <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px 24px; padding-top: 4px; max-width: 520px;">
                    <!-- Badge 1: Giao ảnh trong 24h -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; stroke: white; fill: none; stroke-width: 2.4; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Giao ảnh demo trong 24h
                        </span>
                    </div>

                    <!-- Badge 2: Máy ảnh Full-frame 4K/8K -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; stroke: white; fill: none; stroke-width: 2.4; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Thiết bị Full-Frame 4K/8K
                        </span>
                    </div>

                    <!-- Badge 3: Đúng timeline 100% -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; stroke: white; fill: none; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Đúng timeline 100%
                        </span>
                    </div>

                    <!-- Badge 4: Ekip chuẩn dresscode -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; stroke: white; fill: none; stroke-width: 2.4; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Ekip chuẩn Dresscode lịch sự
                        </span>
                    </div>
                </div>

                <!-- 2 Action Buttons -->
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 14px; padding-top: 6px;">
                    <!-- Button 1: Nhận tư vấn & Báo giá -->
                    <a href="{{ route('contact') }}?service=chup-anh-su-kien" 
                       style="background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 50%, #ea580c 100%) !important; color: #ffffff !important; padding: 12px 28px; border-radius: 9999px; font-weight: 800; font-size: 14px; box-shadow: 0 8px 24px rgba(255, 84, 0, 0.45); display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: transform 0.2s, box-shadow 0.2s;"
                       onmouseover="this.style.transform='scale(1.04)'; this.style.boxShadow='0 12px 30px rgba(255, 84, 0, 0.6)';"
                       onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 8px 24px rgba(255, 84, 0, 0.45)';">
                        <span>Nhận tư vấn &amp; Báo giá</span>
                        <svg style="width: 16px; height: 16px; stroke: white; fill: none; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>

                    <!-- Button 2: Xem bảng giá dịch vụ -->
                    <a href="#bang-gia-su-kien" 
                       style="background: rgba(15, 23, 42, 0.65) !important; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1.5px solid rgba(255, 255, 255, 0.4) !important; color: #ffffff !important; padding: 12px 24px; border-radius: 9999px; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s;"
                       onmouseover="this.style.borderColor='#ff7a29'; this.style.transform='scale(1.04)';"
                       onmouseout="this.style.borderColor='rgba(255, 255, 255, 0.4)'; this.style.transform='scale(1)';">
                        <span>Xem bảng giá chụp ảnh</span>
                        <svg style="width: 16px; height: 16px; stroke: #ff7a29; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                    </a>
                </div>

                <!-- Handwriting Quote at bottom-left -->
                <div style="padding-top: 6px;">
                    <p style="font-family: 'Dancing Script', 'Caveat', cursive, sans-serif; font-size: 21px; font-weight: 700; color: #ffffff; line-height: 1.25; transform: rotate(-3deg); transform-origin: left center; text-shadow: 0 2px 8px rgba(0,0,0,0.95); margin: 0; letter-spacing: 0.02em;">
                        Mỗi khung hình là một câu chuyện thương hiệu tự hào
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         2. CÁC HẠNG MỤC CHỤP ẢNH SỰ KIỆN TRỌNG TÂM (REDESIGNED 4 CARDS)
         ========================================== -->
    <style>
        .category-cards-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        @media (min-width: 640px) {
            .category-cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
        }
        @media (min-width: 1024px) {
            .category-cards-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }
        }
        @media (min-width: 1280px) {
            .category-cards-grid {
                gap: 24px;
            }
        }
        .category-solution-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 26px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .category-solution-card:hover {
            transform: translateY(-8px);
            border-color: #ffedd5;
            box-shadow: 0 20px 35px -5px rgba(255, 84, 0, 0.14), 0 8px 16px -4px rgba(0, 0, 0, 0.04);
        }
        .category-card-icon-badge {
            width: 52px;
            height: 52px;
            border-radius: 9999px;
            background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%);
            border: 4px solid #ffffff;
            box-shadow: 0 6px 16px rgba(255, 84, 0, 0.35);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            margin-top: -26px;
            margin-left: 20px;
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease;
        }
        .category-solution-card:hover .category-card-icon-badge {
            transform: scale(1.1);
        }
        /* Eyebrow tag đồng bộ */
        .pricing-eyebrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 12px;
        }
        .pricing-eyebrow .eyebrow-line {
            width: 32px;
            height: 1.5px;
            background: -webkit-linear-gradient(0deg, #ff5400, #ff7a00);
            background: linear-gradient(90deg, #ff5400, #ff7a00);
            display: inline-block;
            border-radius: 9999px;
        }
        .pricing-eyebrow .eyebrow-dot {
            width: 5px;
            height: 5px;
            background-color: #ff5400;
            border-radius: 9999px;
            display: inline-block;
        }
        .pricing-eyebrow .eyebrow-text {
            font-size: 11.5px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            background: -webkit-linear-gradient(0deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            background: linear-gradient(90deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            color: #ff5400; /* Fallback an toàn */
            display: inline-block;
        }
        .text-orange-gradient-title {
            background: -webkit-linear-gradient(0deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            background: linear-gradient(90deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            color: #ff5400; /* Fallback an toàn */
            display: inline-block;
        }
        /* Rút ngắn khoảng cách giữa các section (padding chuẩn, thoáng vừa vặn) */
        .event-section-compact {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }
        @media (min-width: 640px) {
            .event-section-compact {
                padding-top: 48px !important;
                padding-bottom: 48px !important;
            }
        }
        @media (min-width: 1024px) {
            .event-section-compact {
                padding-top: 56px !important;
                padding-bottom: 56px !important;
            }
        }
    </style>

    <section class="py-10 sm:py-12 lg:py-14 event-section-compact bg-white border-b border-slate-100 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            
            <!-- Watermark Calligraphy Left: Event Photography (Màu cam đào pastel thanh mảnh như mẫu) -->
            <div class="hidden md:block absolute top-0 left-0 lg:left-2 select-none pointer-events-none z-0"
                 style="font-family: 'Alex Brush', cursive; font-size: clamp(42px, 4vw, 62px); color: #ff9a52; opacity: 0.32; transform: rotate(-10deg); font-weight: 400; line-height: 0.88; letter-spacing: 0.02em;">
                Event<br>&nbsp;&nbsp;Photography
            </div>

            <!-- Calligraphy Right: Lưu giữ khoảnh khắc Giá trị (Font mềm mại kèm nét cọ cam như mẫu) -->
            <div class="hidden md:block absolute top-0 right-0 lg:right-4 select-none pointer-events-none text-right z-0"
                 style="font-family: 'Dancing Script', cursive; transform: rotate(-6deg); font-weight: 600; line-height: 1.15;">
                <div class="text-[22px] sm:text-[25px] text-[#1e3a5f]" style="letter-spacing: 0.02em;">Lưu giữ</div>
                <div class="text-[26px] sm:text-[30px] text-[#1e3a5f] -mt-0.5" style="letter-spacing: 0.02em;">khoảnh khắc</div>
                <div class="text-[28px] sm:text-[32px] text-[#1e3a5f] -mt-0.5" style="letter-spacing: 0.02em;">Giá trị</div>
                <!-- Nét cọ gạch chân màu cam uốn cong nghệ thuật -->
                <div class="flex justify-end -mt-1 mr-1">
                    <svg width="78" height="10" viewBox="0 0 78 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 7.5C22 2.5 54 2 76 6.5" stroke="#ff5400" stroke-width="2.8" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <!-- Section Header (Centered with Safe Margins) -->
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10 relative z-10 px-4">
                <!-- Eyebrow with decorative lines -->
                <div class="pricing-eyebrow">
                    <span class="eyebrow-line"></span>
                    <span class="eyebrow-dot"></span>
                    <span class="eyebrow-text">DỊCH VỤ CHỤP ẢNH SỰ KIỆN</span>
                    <span class="eyebrow-dot"></span>
                    <span class="eyebrow-line"></span>
                </div>

                <h2 class="text-2xl sm:text-3xl lg:text-[40px] font-black text-slate-900 tracking-tight leading-[1.2]">
                    Giải Pháp Chụp Ảnh Chuyên Sâu<br>
                    Cho <span class="text-orange-gradient-title">Từng Loại Hình Sự Kiện</span>
                </h2>
                
                <p class="mt-3 text-sm sm:text-[15px] text-slate-600 leading-relaxed max-w-xl mx-auto">
                    Từ sự kiện trang trọng cấp cao đến hoạt động gắn kết sôi nổi ngoài trời, Cửu Long luôn bố trí ekip phù hợp nhất với phong cách của bạn.
                </p>
            </div>

            <!-- 4 Cards Grid -->
            <div class="category-cards-grid relative z-10">

                <!-- Card 1: Hội nghị, Hội thảo & Lễ ký kết -->
                <div class="category-solution-card group">
                    <div>
                        <!-- Card Image -->
                        <div class="w-full aspect-[16/11] bg-slate-900 overflow-hidden relative">
                            <img src="{{ asset('images/chup-anh-su-kien/category-hoi-nghi.png') }}?v={{ time() }}" 
                                 alt="Chụp ảnh hội nghị hội thảo lễ ký kết Cần Thơ"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Floating Orange Icon Badge -->
                        <div class="category-card-icon-badge">
                            <span class="material-symbols-outlined text-[24px]">groups</span>
                        </div>

                        <!-- Card Content -->
                        <div class="px-5 pt-3 pb-2 space-y-3">
                            <h3 class="text-[17px] font-black text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Hội Nghị, Hội Thảo &amp;<br>Lễ Ký Kết
                            </h3>
                            <p class="text-[12.5px] text-slate-600 leading-relaxed min-h-[56px]">
                                Bắt trọn thần thái diễn giả trên bục phát biểu, khoảnh khắc ký kết biên bản ghi nhớ và đại biểu chăm chú tại hội trường.
                            </p>
                            
                            <ul class="space-y-2 pt-2 border-t border-slate-100 text-[12px] text-slate-700">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Góc máy chính diện &amp; cận cảnh sắc nét</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Độ nét cao phục vụ báo chí &amp; PR</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="p-5 pt-3">
                        <a href="{{ route('contact') }}?service=chup-anh-hoi-nghi" 
                           class="w-full py-3 px-5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-[13px] inline-flex items-center justify-center gap-1.5 shadow-md shadow-orange-500/25 hover:shadow-lg hover:shadow-orange-500/40 hover:scale-[1.02] transition-all duration-200">
                            <span>Tư vấn gói hội nghị</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Lễ Khai Trương & Khánh Thành -->
                <div class="category-solution-card group">
                    <div>
                        <!-- Card Image -->
                        <div class="w-full aspect-[16/11] bg-slate-900 overflow-hidden relative">
                            <img src="{{ asset('images/chup-anh-su-kien/category-khai-truong.png') }}?v={{ time() }}" 
                                 alt="Chụp ảnh lễ khai trương khánh thành showroom"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Floating Orange Icon Badge -->
                        <div class="category-card-icon-badge">
                            <span class="material-symbols-outlined text-[24px]">event_available</span>
                        </div>

                        <!-- Card Content -->
                        <div class="px-5 pt-3 pb-2 space-y-3">
                            <h3 class="text-[17px] font-black text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Lễ Khai Trương &amp;<br>Khánh Thành
                            </h3>
                            <p class="text-[12.5px] text-slate-600 leading-relaxed min-h-[56px]">
                                Ghi lại khoảnh khắc cắt băng đỏ, múa lân sư rồng may mắn, nâng ly chúc mừng và không gian showroom mới khang trang.
                            </p>
                            
                            <ul class="space-y-2 pt-2 border-t border-slate-100 text-[12px] text-slate-700">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Bắt trọn khoảnh khắc cắt băng chỉ 1 lần</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Chụp check-in khách mời tại Backdrop</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="p-5 pt-3">
                        <a href="{{ route('contact') }}?service=chup-anh-khai-truong" 
                           class="w-full py-3 px-5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-[13px] inline-flex items-center justify-center gap-1.5 shadow-md shadow-orange-500/25 hover:shadow-lg hover:shadow-orange-500/40 hover:scale-[1.02] transition-all duration-200">
                            <span>Tư vấn gói khai trương</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 3: Gala Dinner & Year End Party -->
                <div class="category-solution-card group">
                    <div>
                        <!-- Card Image -->
                        <div class="w-full aspect-[16/11] bg-slate-900 overflow-hidden relative">
                            <img src="{{ asset('images/chup-anh-su-kien/category-gala-dinner.png') }}?v={{ time() }}" 
                                 alt="Chụp ảnh tiệc tất niên Gala Dinner Year End Party"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Floating Orange Icon Badge -->
                        <div class="category-card-icon-badge">
                            <span class="material-symbols-outlined text-[24px]">emoji_events</span>
                        </div>

                        <!-- Card Content -->
                        <div class="px-5 pt-3 pb-2 space-y-3">
                            <h3 class="text-[17px] font-black text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Gala Dinner &amp;<br>Year End Party
                            </h3>
                            <p class="text-[12.5px] text-slate-600 leading-relaxed min-h-[56px]">
                                Lưu giữ trọn vẹn niềm hân hoan khi trao cúp vinh danh nhân sự, tiệc kết cuối năm và không khí bùng nổ trong sự kiện.
                            </p>
                            
                            <ul class="space-y-2 pt-2 border-t border-slate-100 text-[12px] text-slate-700">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Hệ thống đèn Flash/Strobe tiệc đêm</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Chụp từng bàn tiệc và tập thể phòng ban</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="p-5 pt-3">
                        <a href="{{ route('contact') }}?service=chup-anh-gala-dinner" 
                           class="w-full py-3 px-5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-[13px] inline-flex items-center justify-center gap-1.5 shadow-md shadow-orange-500/25 hover:shadow-lg hover:shadow-orange-500/40 hover:scale-[1.02] transition-all duration-200">
                            <span>Tư vấn gói Gala Dinner</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 4: Teambuilding & Hoạt Động Doanh Nghiệp -->
                <div class="category-solution-card group">
                    <div>
                        <!-- Card Image -->
                        <div class="w-full aspect-[16/11] bg-slate-900 overflow-hidden relative">
                            <img src="{{ asset('images/chup-anh-su-kien/category-teambuilding.png') }}?v={{ time() }}" 
                                 alt="Chụp ảnh teambuilding ngoài trời bãi biển Cần Thơ"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Floating Orange Icon Badge -->
                        <div class="category-card-icon-badge">
                            <span class="material-symbols-outlined text-[24px]">diversity_3</span>
                        </div>

                        <!-- Card Content -->
                        <div class="px-5 pt-3 pb-2 space-y-3">
                            <h3 class="text-[17px] font-black text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Teambuilding &amp; Hoạt Động<br>Doanh Nghiệp
                            </h3>
                            <p class="text-[12.5px] text-slate-600 leading-relaxed min-h-[56px]">
                                Ghi lại những nụ cười sảng khoái, khoảnh khắc vượt thử thách đồng đội và năng lượng gắn kết bùng nổ của toàn thể nhân sự.
                            </p>
                            
                            <ul class="space-y-2 pt-2 border-t border-slate-100 text-[12px] text-slate-700">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Tốc độ chụp bắt khoảnh khắc vận động</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[17px] text-[#ff5400] shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span class="font-medium">Góc chụp flycam toàn cảnh bãi biển/resort</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="p-5 pt-3">
                        <a href="{{ route('contact') }}?service=chup-anh-teambuilding" 
                           class="w-full py-3 px-5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-[13px] inline-flex items-center justify-center gap-1.5 shadow-md shadow-orange-500/25 hover:shadow-lg hover:shadow-orange-500/40 hover:scale-[1.02] transition-all duration-200">
                            <span>Tư vấn gói Teambuilding</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         3. TÍNH NĂNG ĐỘT PHÁ: LIVE PHOTO QR CODE & TRANG THIẾT BỊ
         ========================================== -->
    <section class="py-10 sm:py-12 lg:py-14 event-section-compact bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff0a_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Live Photo QR Description -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-500/15 border border-orange-500/30 text-xs font-bold text-orange-400 font-mono uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span>
                        <span>ĐỘT PHÁ CÔNG NGHỆ SỰ KIỆN</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight">
                        Live Photo QR Code:<br>
                        <span class="text-[#ff5400]">Xem &amp; Tải Ảnh Tức Thì</span> Ngay Tại Sự Kiện
                    </h2>

                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                        Không còn phải chờ đợi 2-3 ngày để nhận ảnh! Với công nghệ <strong class="text-white">Live Photo Gallery</strong> độc quyền từ Truyền Thông Cửu Long, thợ chụp sẽ đồng bộ ảnh trực tiếp lên hệ thống đám mây. Khách mời chỉ cần quét mã QR đặt tại bàn tiệc để tải ảnh đẹp về đăng Facebook, Zalo hay TikTok ngay trong buổi tiệc!
                    </p>

                    <!-- Feature Points Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-1.5">
                            <div class="flex items-center gap-2 text-orange-400 font-bold text-sm">
                                <span class="material-symbols-outlined text-[20px]">qr_code_scanner</span>
                                <span>Quét QR xem ngay</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Ảnh tải lên sau 15-30 phút, tối ưu nhận diện gương mặt thông minh.
                            </p>
                        </div>

                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-1.5">
                            <div class="flex items-center gap-2 text-orange-400 font-bold text-sm">
                                <span class="material-symbols-outlined text-[20px]">share</span>
                                <span>Tăng lan tỏa Viral</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Khách mời tự hào chia sẻ hình ảnh đẹp, tăng nhận diện thương hiệu gấp 5 lần.
                            </p>
                        </div>

                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-1.5">
                            <div class="flex items-center gap-2 text-orange-400 font-bold text-sm">
                                <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                                <span>Sony Alpha &amp; Canon R</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                100% cảm biến Full-frame cao cấp, lấy nét mắt siêu tốc độ trong điều kiện ánh sáng khó.
                            </p>
                        </div>

                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-1.5">
                            <div class="flex items-center gap-2 text-orange-400 font-bold text-sm">
                                <span class="material-symbols-outlined text-[20px]">cloud_done</span>
                                <span>Lưu trữ vĩnh viễn</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Link kho ảnh Google Drive tốc độ cao, không nén dung lượng trong vòng 1 năm.
                            </p>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('contact') }}?service=live-photo-qr" 
                           class="inline-flex items-center gap-2 px-7 py-3 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-sm shadow-xl shadow-orange-500/25 transition-all">
                            <span>Đăng ký tích hợp Live Photo QR</span>
                            <span class="material-symbols-outlined text-[18px]">bolt</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Visual Photo Mockup (gear-and-livephoto.png) -->
                <div class="lg:col-span-6">
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-2xl bg-slate-950 aspect-[3/2] group">
                        <img src="{{ asset('images/chup-anh-su-kien/gear-and-livephoto.png') }}?v={{ time() }}" 
                             alt="Thiết bị máy ảnh chuyên nghiệp và hệ thống Live Photo Cửu Long"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                             class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500">
                        
                        <!-- Fallback Interactive Visual Card if image is not uploaded yet -->
                        <div class="w-full h-full hidden flex-col justify-between p-8 bg-gradient-to-br from-slate-900 via-slate-950 to-orange-950/40">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                                    <span class="text-xs font-mono font-bold text-emerald-400 tracking-wider">LIVE PHOTO GALLERY CONNECTED</span>
                                </div>
                                <span class="px-3 py-1 rounded-full bg-white/10 text-xs font-mono text-white">Canon R5 &bull; Sony A7IV</span>
                            </div>

                            <div class="flex items-center justify-center my-6">
                                <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-center shadow-2xl">
                                    <span class="material-symbols-outlined text-6xl text-orange-400 mb-2">qr_code_2</span>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider">Quét mã nhận ảnh tức thì</p>
                                    <span class="text-[11px] text-slate-300">Đồng bộ tự động sau mỗi shoot chụp</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-xs text-slate-400 border-t border-white/10 pt-4">
                                <span>Tốc độ bàn giao: &lt; 30 giây/ảnh</span>
                                <span>Độ phân giải: 45 Megapixels RAW</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         4. BẢNG GIÁ DỊCH VỤ MINH BẠCH & TIẾT KIỆM (REDESIGNED PRICING)
         ========================================== -->
    <style>
        .pricing-grid-custom {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            align-items: center;
        }
        @media (min-width: 1024px) {
            .pricing-grid-custom {
                grid-template-columns: 0.94fr 1.12fr 0.94fr;
                gap: 1.5rem;
                align-items: center;
            }
        }
        @media (min-width: 1280px) {
            .pricing-grid-custom {
                grid-template-columns: 0.93fr 1.14fr 0.93fr;
                gap: 2rem;
            }
        }
        /* 2 khối 2 bên: nhỏ hơn, tinh gọn hơn */
        .pricing-card-side {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 28px 24px;
            box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
        }
        @media (min-width: 1024px) {
            .pricing-card-side {
                transform: scale(0.97);
            }
            .pricing-card-side:hover {
                transform: scale(0.99) translateY(-4px);
                box-shadow: 0 16px 32px -8px rgba(0, 0, 0, 0.08);
            }
        }
        /* Khối giữa: to hơn, nổi bật hơn hẳn */
        .pricing-card-center {
            background: #ffffff;
            border: 2.5px solid #ff5400;
            border-radius: 28px;
            padding: 38px 28px;
            box-shadow: 0 20px 45px -10px rgba(255, 84, 0, 0.22), 0 4px 16px rgba(0, 0, 0, 0.04);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 10;
            transition: all 0.3s ease;
        }
        @media (min-width: 1024px) {
            .pricing-card-center {
                transform: scale(1.04);
            }
            .pricing-card-center:hover {
                transform: scale(1.06) translateY(-4px);
                box-shadow: 0 28px 56px -12px rgba(255, 84, 0, 0.3);
            }
        }
        /* Nút 2 bên: Xử lý triệt để lỗi hover màu trắng */
        .pricing-side-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px 24px;
            border-radius: 9999px;
            border: 2px solid #0f172a;
            background-color: #ffffff !important;
            color: #0f172a !important;
            font-weight: 800;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
        }
        .pricing-side-btn span {
            color: #0f172a !important;
            transition: color 0.25s ease;
        }
        .pricing-side-btn:hover {
            background-color: #0f172a !important;
            border-color: #0f172a !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -2px rgba(15, 23, 42, 0.3);
        }
        .pricing-side-btn:hover span {
            color: #ffffff !important;
        }
        /* Eyebrow tag đồng bộ với mục Giải Pháp: hiển thị rõ nét 100% với màu cam gradient */
        .pricing-eyebrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 12px;
        }
        .pricing-eyebrow .eyebrow-line {
            width: 32px;
            height: 1.5px;
            background: -webkit-linear-gradient(0deg, #ff5400, #ff7a00);
            background: linear-gradient(90deg, #ff5400, #ff7a00);
            display: inline-block;
            border-radius: 9999px;
        }
        .pricing-eyebrow .eyebrow-dot {
            width: 5px;
            height: 5px;
            background-color: #ff5400;
            border-radius: 9999px;
            display: inline-block;
        }
        .pricing-eyebrow .eyebrow-text {
            font-size: 11.5px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            background: -webkit-linear-gradient(0deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            background: linear-gradient(90deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            color: #ff5400; /* Fallback an toàn tuyệt đối */
            display: inline-block;
        }
        /* Gradient cam cho chữ tiêu đề H2 */
        .text-orange-gradient-title {
            background: -webkit-linear-gradient(0deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            background: linear-gradient(90deg, #ff5400 0%, #ff7a00 50%, #ea580c 100%);
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            color: #ff5400; /* Fallback an toàn tuyệt đối */
            display: inline-block;
        }
    </style>

    <section id="bang-gia-su-kien" class="py-10 sm:py-12 lg:py-14 event-section-compact bg-[#f8f9fc] border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
                <!-- Eyebrow Tag giống mục Giải Pháp: Có vạch kẻ trang trí và text cam gradient rõ nét -->
                <div class="pricing-eyebrow">
                    <span class="eyebrow-line"></span>
                    <span class="eyebrow-dot"></span>
                    <span class="eyebrow-text">BẢNG GIÁ DỊCH VỤ CHỤP ẢNH SỰ KIỆN</span>
                    <span class="eyebrow-dot"></span>
                    <span class="eyebrow-line"></span>
                </div>

                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    Bảng Giá Chụp Ảnh Sự Kiện<br class="hidden sm:inline">
                    Linh Hoạt Theo <span class="text-orange-gradient-title">Nhu Cầu</span>
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                    Tối ưu chi phí cho doanh nghiệp. Cam kết không phát sinh phụ phí di chuyển nội ô Cần Thơ, bàn giao toàn bộ file gốc không giới hạn.
                </p>
            </div>

            <!-- Pricing Grid: Khối giữa to hơn 2 khối bên cạnh -->
            <div class="pricing-grid-custom">

                <!-- Plan 1: Nửa ngày (1 Buổi) - Khối bên nhỏ gọn -->
                <div class="pricing-card-side">
                    <div class="space-y-5">
                        <div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider font-mono">GÓI CƠ BẢN</span>
                            <h3 class="text-lg font-black text-slate-900 mt-1">Nửa Ngày (1 Buổi)</h3>
                            <p class="text-xs text-slate-500 mt-1.5">Phù hợp lễ khai trương, ký kết hợp tác, hội thảo 3 - 4 giờ.</p>
                        </div>

                        <div class="py-3.5 border-y border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Liên Hệ</span>
                            </div>
                            <span class="text-[11px] text-orange-600 font-semibold block mt-1">✓ Báo giá theo thời lượng &amp; quy mô sự kiện</span>
                        </div>

                        <ul class="space-y-2.5 text-xs text-slate-600">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span><strong>01 Nhiếp ảnh gia</strong> trang phục lịch sự</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span>Chụp <strong>không giới hạn số lượng</strong> file</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span>Chỉnh sửa màu sắc &amp; ánh sáng <strong>toàn bộ ảnh</strong></span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span>Bàn giao toàn bộ ảnh gốc + sửa trong <strong>24h</strong></span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span>Lưu trữ đám mây Google Drive tốc độ cao</span>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-6">
                        <a href="{{ route('contact') }}?service=chup-anh-1-buoi" 
                           class="pricing-side-btn"
                           onmouseover="this.style.backgroundColor='#0f172a'; this.style.color='#ffffff'; this.querySelectorAll('span').forEach(s => s.style.color='#ffffff');"
                           onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#0f172a'; this.querySelectorAll('span').forEach(s => s.style.color='#0f172a');">
                            <span>Liên hệ nhận báo giá</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Plan 2: Cả ngày (2 Buổi) - Khối giữa to lớn & nổi bật nhất -->
                <div class="pricing-card-center">
                    <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                        PHỔ BIẾN NHẤT
                    </span>

                    <div class="space-y-6">
                        <div>
                            <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">GÓI TIÊU CHUẨN</span>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">Trọn Gói Cả Ngày</h3>
                            <p class="text-xs text-slate-500 mt-1.5">Phù hợp hội nghị cả ngày, teambuilding kết hợp Gala Dinner tối.</p>
                        </div>

                        <div class="py-4 border-y border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="text-3xl sm:text-4xl font-black text-[#ff5400] tracking-tight">Liên Hệ</span>
                            </div>
                            <span class="text-[11px] text-orange-600 font-semibold block mt-1">✓ Báo giá ưu đãi tối ưu cho doanh nghiệp</span>
                        </div>

                        <ul class="space-y-3 text-xs text-slate-600">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-[#ff5400] shrink-0">check_circle</span>
                                <span><strong>01 Nhiếp ảnh gia chính</strong> theo sát toàn bộ timeline</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-[#ff5400] shrink-0">check_circle</span>
                                <span>Chụp <strong>không giới hạn số lượng</strong> (800 - 1500+ ảnh)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-[#ff5400] shrink-0">check_circle</span>
                                <span>Trang bị <strong>hệ thống đèn Flash/Strobe</strong> tiệc đêm</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-[#ff5400] shrink-0">check_circle</span>
                                <span>Chỉnh sửa toàn bộ + <strong>chọn 50 ảnh đẹp trả trước trong đêm</strong></span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-[#ff5400] shrink-0">check_circle</span>
                                <span>Hỗ trợ xuất hóa đơn VAT đầy đủ cho doanh nghiệp</span>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-8">
                        <a href="{{ route('contact') }}?service=chup-anh-ca-ngay" 
                           class="w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-xs inline-flex items-center justify-center gap-2 shadow-lg shadow-orange-500/30 hover:scale-[1.02] transition-all">
                            <span>Liên hệ nhận báo giá</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Plan 3: VIP Sự kiện lớn - Khối bên nhỏ gọn -->
                <div class="pricing-card-side">
                    <div class="space-y-5">
                        <div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider font-mono">GÓI CAO CẤP VIP</span>
                            <h3 class="text-lg font-black text-slate-900 mt-1">Đại Hội &amp; Sự Kiện VIP</h3>
                            <p class="text-xs text-slate-500 mt-1.5">Dành cho sự kiện 200 - 1000+ khách, lễ kỷ niệm lớn, ngày hội xúc tiến.</p>
                        </div>

                        <div class="py-3.5 border-y border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Liên Hệ</span>
                            </div>
                            <span class="text-[11px] text-orange-600 font-semibold block mt-1">✓ Tư vấn giải pháp trọn gói theo yêu cầu</span>
                        </div>

                        <ul class="space-y-2.5 text-xs text-slate-600">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span><strong>02 Nhiếp ảnh gia</strong> (1 bắt khoảnh khắc + 1 chụp backdrop)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span>Tặng kèm <strong>Quay chụp Flycam toàn cảnh</strong> 4K</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span><strong>Tích hợp Live Photo QR Code</strong> xem ảnh tải về tức thì</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span>Bàn giao file nén + in ấn photobook kỷ niệm</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-emerald-500 shrink-0">check</span>
                                <span>Hợp đồng kinh tế &amp; thanh toán linh hoạt</span>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-6">
                        <a href="{{ route('contact') }}?service=chup-anh-vip" 
                           class="pricing-side-btn"
                           onmouseover="this.style.backgroundColor='#0f172a'; this.style.color='#ffffff'; this.querySelectorAll('span').forEach(s => s.style.color='#ffffff');"
                           onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#0f172a'; this.querySelectorAll('span').forEach(s => s.style.color='#0f172a');">
                            <span>Liên hệ nhận báo giá</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         5. QUY TRÌNH TÁC NGHIỆP 5 BƯỚC AN TÂM (REDESIGNED 5-COLUMN WORKFLOW)
         ========================================== -->
    <style>
        .event-steps-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            position: relative;
        }
        @media (min-width: 640px) {
            .event-steps-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }
        @media (min-width: 1024px) {
            .event-steps-grid {
                grid-template-columns: repeat(5, 1fr);
                gap: 16px;
            }
        }
        .step-item-card {
            position: relative;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 24px 20px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
        }
        .step-item-card:hover {
            transform: translateY(-6px);
            border-color: #ff5400;
            box-shadow: 0 16px 32px -8px rgba(255, 84, 0, 0.16), 0 4px 12px rgba(0, 0, 0, 0.04);
        }
        .step-arrow-connector {
            display: none;
        }
        @media (min-width: 1024px) {
            .step-arrow-connector {
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 44px;
                left: calc(100% + 8px);
                transform: translate(-50%, -50%);
                z-index: 20;
                width: 26px;
                height: 26px;
                border-radius: 9999px;
                background: #ffffff;
                border: 1.5px solid #e2e8f0;
                box-shadow: 0 2px 6px rgba(15, 23, 42, 0.08);
                color: #ff5400;
                transition: all 0.25s ease;
                pointer-events: none;
            }
            .step-item-card:hover .step-arrow-connector {
                border-color: #ff5400;
                background: #ff5400;
                color: #ffffff;
                box-shadow: 0 4px 12px rgba(255, 84, 0, 0.35);
                transform: translate(-50%, -50%) scale(1.12);
            }
        }
    </style>

    <section class="py-10 sm:py-12 lg:py-14 event-section-compact bg-slate-50/60 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
                <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-orange-100/70 border border-orange-200 text-xs font-bold text-[#ff5400] font-mono uppercase tracking-wider mb-3">
                    <span>QUY TRÌNH CHUẨN MỰC</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    5 Bước Triển Khai Chặt Chẽ &bull; An Tâm Tuyệt Đối
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                    Mọi sự kiện đều có kế hoạch tác nghiệp bài bản, đảm bảo không bỏ lỡ bất kỳ khoảnh khắc trọng đại nào.
                </p>
            </div>

            <!-- Steps Grid: 5 Columns on Desktop -->
            <div class="event-steps-grid">
                
                <!-- Step 1 -->
                <div class="step-item-card group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#ff5400] to-[#ea580c] text-white font-black text-sm font-mono flex items-center justify-center shadow-md shadow-orange-500/25">
                                01
                            </span>
                            <span class="material-symbols-outlined text-[24px] text-slate-300 group-hover:text-orange-500 transition-colors">assignment</span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold uppercase font-mono tracking-wider text-orange-600 block">BƯỚC 1</span>
                            <h3 class="text-[15px] font-bold text-slate-900 leading-snug group-hover:text-orange-600 transition-colors">Tiếp Nhận Timeline</h3>
                            <p class="text-xs text-slate-600 leading-relaxed pt-1">
                                Lắng nghe kịch bản sự kiện, danh sách đại biểu VIP và các khoảnh khắc then chốt cần bắt cận cảnh.
                            </p>
                        </div>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500 font-medium">
                        <span>Khởi động kịch bản</span>
                        <span class="font-bold text-orange-600 font-mono">20%</span>
                    </div>
                    <div class="step-arrow-connector">
                        <span class="material-symbols-outlined text-[15px]" style="font-weight: 800; line-height: 1;">chevron_right</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step-item-card group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#ff5400] to-[#ea580c] text-white font-black text-sm font-mono flex items-center justify-center shadow-md shadow-orange-500/25">
                                02
                            </span>
                            <span class="material-symbols-outlined text-[24px] text-slate-300 group-hover:text-orange-500 transition-colors">location_searching</span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold uppercase font-mono tracking-wider text-orange-600 block">BƯỚC 2</span>
                            <h3 class="text-[15px] font-bold text-slate-900 leading-snug group-hover:text-orange-600 transition-colors">Khảo Sát Địa Điểm</h3>
                            <p class="text-xs text-slate-600 leading-relaxed pt-1">
                                Đến sớm 30 - 45 phút kiểm tra ánh sáng sân khấu, góc đặt máy và bố trí hệ thống đèn flash phụ trợ.
                            </p>
                        </div>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500 font-medium">
                        <span>Setup &amp; Test góc</span>
                        <span class="font-bold text-orange-600 font-mono">40%</span>
                    </div>
                    <div class="step-arrow-connector">
                        <span class="material-symbols-outlined text-[15px]" style="font-weight: 800; line-height: 1;">chevron_right</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step-item-card group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#ff5400] to-[#ea580c] text-white font-black text-sm font-mono flex items-center justify-center shadow-md shadow-orange-500/25">
                                03
                            </span>
                            <span class="material-symbols-outlined text-[24px] text-slate-300 group-hover:text-orange-500 transition-colors">photo_camera</span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold uppercase font-mono tracking-wider text-orange-600 block">BƯỚC 3</span>
                            <h3 class="text-[15px] font-bold text-slate-900 leading-snug group-hover:text-orange-600 transition-colors">Tác Nghiệp Chuẩn Mực</h3>
                            <p class="text-xs text-slate-600 leading-relaxed pt-1">
                                Thợ mặc trang phục lịch sự (áo sơ mi/vest đen), di chuyển khéo léo, tôn trọng không gian sự kiện.
                            </p>
                        </div>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500 font-medium">
                        <span>Bắt trọn khoảnh khắc</span>
                        <span class="font-bold text-orange-600 font-mono">60%</span>
                    </div>
                    <div class="step-arrow-connector">
                        <span class="material-symbols-outlined text-[15px]" style="font-weight: 800; line-height: 1;">chevron_right</span>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="step-item-card group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#ff5400] to-[#ea580c] text-white font-black text-sm font-mono flex items-center justify-center shadow-md shadow-orange-500/25">
                                04
                            </span>
                            <span class="material-symbols-outlined text-[24px] text-slate-300 group-hover:text-orange-500 transition-colors">auto_fix_high</span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold uppercase font-mono tracking-wider text-orange-600 block">BƯỚC 4</span>
                            <h3 class="text-[15px] font-bold text-slate-900 leading-snug group-hover:text-orange-600 transition-colors">Hậu Kỳ Màu Sắc</h3>
                            <p class="text-xs text-slate-600 leading-relaxed pt-1">
                                Lọc ảnh lỗi, chỉnh sửa ánh sáng, cân bằng trắng và tinh chỉnh màu sắc hài hòa, tôn da nhân vật.
                            </p>
                        </div>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500 font-medium">
                        <span>Retouch &amp; Lọc ảnh</span>
                        <span class="font-bold text-orange-600 font-mono">80%</span>
                    </div>
                    <div class="step-arrow-connector">
                        <span class="material-symbols-outlined text-[15px]" style="font-weight: 800; line-height: 1;">chevron_right</span>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="step-item-card group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#ff5400] to-[#ea580c] text-white font-black text-sm font-mono flex items-center justify-center shadow-md shadow-orange-500/25">
                                05
                            </span>
                            <span class="material-symbols-outlined text-[24px] text-slate-300 group-hover:text-orange-500 transition-colors">cloud_download</span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold uppercase font-mono tracking-wider text-orange-600 block">BƯỚC 5</span>
                            <h3 class="text-[15px] font-bold text-slate-900 leading-snug group-hover:text-orange-600 transition-colors">Bàn Giao &amp; Lưu Trữ</h3>
                            <p class="text-xs text-slate-600 leading-relaxed pt-1">
                                Bàn giao link Google Drive tốc độ cao trong vòng 24h. Lưu trữ vĩnh viễn trên server sao lưu của Cửu Long.
                            </p>
                        </div>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500 font-medium">
                        <span>Hoàn tất &amp; Lưu trữ</span>
                        <span class="font-bold text-emerald-600 font-mono">100%</span>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         6. ALBUM DỰ ÁN MEDIA & SỰ KIỆN ĐÃ TRIỂN KHAI
         ========================================== -->
    <section class="py-10 sm:py-12 lg:py-14 event-section-compact bg-[#f8f9fc] border-b border-slate-200/90 relative"
             x-data="{
                 videoModal: false,
                 currentVideoUrl: '',
                 currentVideoTitle: '',
                 openVideo(url, title) {
                     if (!url) return;
                     let embed = url;
                     if (embed.includes('watch?v=')) {
                         embed = embed.replace('watch?v=', 'embed/');
                     } else if (embed.includes('youtu.be/')) {
                         embed = embed.replace('youtu.be/', 'www.youtube.com/embed/');
                     }
                     if (!embed.includes('autoplay=1')) {
                         embed += (embed.includes('?') ? '&' : '?') + 'autoplay=1&rel=0&modestbranding=1';
                     }
                     this.currentVideoUrl = embed;
                     this.currentVideoTitle = title || 'Video sự kiện';
                     this.videoModal = true;
                     document.body.style.overflow = 'hidden';
                 },
                 closeVideo() {
                     this.videoModal = false;
                     this.currentVideoUrl = '';
                     document.body.style.overflow = '';
                 }
             }"
             @keydown.escape.window="closeVideo()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-7 sm:mb-8">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-50 border border-orange-200/60 text-xs font-bold text-[#ff5400] font-mono uppercase tracking-wider mb-2">
                        <span>PORTFOLIO THỰC CHIẾN</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                        Khoảnh Khắc Sự Kiện Đã Thực Hiện
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}?group=media" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] hover:underline">
                    <span>Xem tất cả dự án Media</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>

            <!-- Case Studies Grid: 4 Cột 1 Dòng -->
            <style>
                @media (min-width: 1024px) {
                    .case-studies-grid-4 {
                        display: grid !important;
                        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                    }
                }
            </style>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 case-studies-grid-4">
                @forelse($mediaCaseStudies as $case)
                @php
                    $videoUrl = $case->video_url ?? '';
                    $videoId = null;
                    if (!empty($videoUrl)) {
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $videoUrl, $matches)) {
                            $videoId = $matches[1];
                        }
                    }
                    if (!$videoId) {
                        if ($case->slug === 'tvc-quang-cao-sacombank') $videoId = 'nGvVhO2kDo8';
                        elseif ($case->slug === 'phim-doanh-nghiep-hoya') $videoId = 'dBFbsinzwNs';
                        elseif ($case->slug === 'tat-nien-kredivo-da-tiec-tri-an') $videoId = 'pwPRwTicUhI';
                        elseif ($case->slug === 'rakus-viet-nam-team-building-nha-trang') $videoId = 'T9h_Jq_nNWU';
                    }

                    $finalVideoUrl = $videoId ? "https://www.youtube.com/embed/{$videoId}" : ($case->video_url ?? '');
                    
                    // Thumbnail 100% từ chính video đó
                    $primaryThumb = $videoId 
                        ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" 
                        : ($case->thumbnail ? asset('storage/' . $case->thumbnail) : asset('images/showreel-cinematic-poster.jpg'));
                    $fallbackThumb = $videoId 
                        ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" 
                        : asset('images/showreel-cinematic-poster.jpg');
                @endphp
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-sm overflow-hidden flex flex-col justify-between group hover:shadow-xl hover:border-orange-300 transition-all duration-300">
                    <div class="space-y-3">
                        <!-- Video Thumbnail with Play Button Clickable -->
                        <div class="aspect-[16/10] bg-slate-950 relative overflow-hidden group/thumb cursor-pointer select-none"
                             @click="openVideo('{{ $finalVideoUrl }}', '{{ addslashes($case->title) }}')"
                             title="Bấm để xem video: {{ $case->title }}">
                            
                            <img src="{{ $primaryThumb }}" 
                                 alt="{{ $case->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="if(this.src !== '{{ $fallbackThumb }}') { this.src='{{ $fallbackThumb }}'; }">
                            
                            <!-- Video Overlay with Pulsing Play Button -->
                            <div class="absolute inset-0 bg-black/35 group-hover/thumb:bg-black/55 transition-colors flex items-center justify-center">
                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-red-600 text-white flex items-center justify-center shadow-2xl shadow-red-950/80 transform group-hover/thumb:scale-115 transition-all duration-300 border-2 border-white/40">
                                    <span class="material-symbols-outlined text-[28px] sm:text-[32px] ml-0.5 text-white">play_arrow</span>
                                </div>
                            </div>

                            <!-- Badge Client Name -->
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-black/75 backdrop-blur-xs text-[10.5px] font-bold text-white border border-white/10 shadow">
                                {{ $case->client_name ?: 'Dự án Media' }}
                            </span>

                            <!-- Bottom 'Xem Video' Tag -->
                            <span class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded-md bg-black/85 backdrop-blur-xs text-[10.5px] font-bold text-white flex items-center gap-1 border border-white/15 shadow">
                                <span class="material-symbols-outlined text-[14px] text-red-500">smart_display</span>
                                <span>Xem Video</span>
                            </span>
                        </div>

                        <div class="px-4 xl:px-5 pt-4 pb-2 space-y-1.5">
                            <h3 class="text-[14.5px] font-bold text-slate-900 line-clamp-1 group-hover:text-[#ff5400] transition-colors cursor-pointer leading-snug"
                                @click="openVideo('{{ $finalVideoUrl }}', '{{ addslashes($case->title) }}')">
                                {{ $case->title }}
                            </h3>
                            <p class="text-[11.5px] text-slate-600 line-clamp-2 leading-relaxed">
                                {{ $case->summary ?: 'Ghi lại trọn vẹn diễn biến sự kiện với chất lượng hình ảnh sắc nét, đáp ứng tiêu chuẩn truyền thông chuyên nghiệp.' }}
                            </p>
                        </div>
                    </div>

                    <div class="px-4 xl:px-5 border-t border-slate-100 flex items-center justify-between text-[11.5px] xl:text-xs" style="padding-top: 13px; padding-bottom: 22px;">
                        <button type="button" 
                                @click="openVideo('{{ $finalVideoUrl }}', '{{ addslashes($case->title) }}')"
                                class="font-extrabold text-red-600 hover:text-red-700 inline-flex items-center gap-1.5 cursor-pointer hover:underline transition-colors whitespace-nowrap">
                            <span class="material-symbols-outlined text-[17px]">play_circle</span>
                            <span>Xem video</span>
                        </button>

                        <a href="{{ route('projects.show', $case->slug) }}" 
                           class="font-bold text-slate-500 hover:text-[#ff5400] inline-flex items-center gap-1 hover:underline transition-colors whitespace-nowrap">
                            <span>Chi tiết dự án</span>
                            <span class="material-symbols-outlined text-[13px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-4 p-8 text-center bg-white rounded-2xl border border-slate-200 text-slate-500 text-xs">
                    Đang cập nhật các album sự kiện mới nhất.
                </div>
                @endforelse
            </div>

        </div>

        <!-- ==========================================
             VIDEO POPUP LIGHTBOX MODAL
             ========================================== -->
        <div x-show="videoModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6 bg-black/90 backdrop-blur-md" 
             style="display: none;"
             x-cloak>
            
            <div @click.outside="closeVideo()" 
                 class="w-full max-w-4xl bg-slate-950 rounded-2xl overflow-hidden shadow-2xl border border-white/15 flex flex-col transform transition-all">
                
                <!-- Modal Topbar -->
                <div class="px-5 py-3.5 bg-slate-900 border-b border-white/10 flex items-center justify-between text-white">
                    <div class="flex items-center gap-2.5 min-w-0 pr-4">
                        <span class="w-7 h-7 rounded-lg bg-red-600/20 text-red-500 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[18px]">smart_display</span>
                        </span>
                        <h3 class="font-bold text-sm sm:text-base text-slate-100 truncate" x-text="currentVideoTitle"></h3>
                    </div>
                    <button type="button" 
                            @click="closeVideo()" 
                            class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors cursor-pointer shrink-0"
                            aria-label="Đóng video"
                            title="Đóng video (Phím Esc)">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>

                <!-- Video Iframe Responsive 16:9 -->
                <div class="w-full aspect-video bg-black relative">
                    <template x-if="videoModal && currentVideoUrl">
                        <iframe :src="currentVideoUrl" 
                                class="w-full h-full" 
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                        </iframe>
                    </template>
                </div>
            </div>
        </div>
    </section>


    <!-- ==========================================
         7. BANNER CTA CHỐT HẠ (CẦU CẦN THƠ HOÀNG HÔN)
         ========================================== -->
    <section class="w-full relative overflow-hidden py-10 sm:py-12 lg:py-14 event-section-compact text-white bg-slate-950">
        
        <!-- Background Image (cta-event-photo.png) -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/chup-anh-su-kien/cta-event-photo.png') }}?v={{ time() }}" 
                 alt="Ekip chụp ảnh sự kiện Truyền Thông Cửu Long"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                 class="w-full h-full object-cover object-center opacity-65">
            <!-- Fallback if cta-event-photo.png not added yet: use cta-maintenance or dark gradient -->
            <img src="{{ asset('images/quan-tri/cta-maintenance.png') }}?v={{ time() }}" 
                 alt="Truyền Thông Cửu Long Media" 
                 class="w-full h-full object-cover object-center opacity-65 hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/88 to-slate-950/80"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8 sm:gap-10">
            
            <!-- Left Info -->
            <div class="space-y-3.5 max-w-2xl">
                <div class="text-xs font-bold text-[#ff7a29] uppercase font-mono tracking-wider flex items-center gap-1.5"
                     style="text-shadow: 0 1px 4px rgba(0,0,0,0.9);">
                    <span class="font-extrabold text-[#ff5400]">::</span>
                    <span>ĐẶT LỊCH EKIP NGAY HÔM NAY</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-white tracking-tight leading-tight"
                    style="text-shadow: 0 2px 10px rgba(0,0,0,0.95);">
                    Đừng Để Những Khoảnh Khắc<br class="hidden sm:inline"> Đắt Giá Trôi Qua Mất
                </h2>
                
                <!-- Description text with distinct high-contrast white & shadow -->
                <p style="color: #ffffff; font-size: 15px; line-height: 1.65; font-weight: 500; text-shadow: 0 1px 3px #000000, 0 2px 8px rgba(0, 0, 0, 0.95), 0 0 16px rgba(0, 0, 0, 0.9); max-width: 580px; margin: 0;">
                    Liên hệ ngay với <strong style="color: #ff9e58; font-weight: 700; text-shadow: 0 1px 4px #000000;">Truyền Thông Cửu Long</strong> để giữ lịch ekip chụp ảnh sự kiện chuyên nghiệp và nhận ưu đãi tích hợp Live Photo QR miễn phí!
                </p>
            </div>

            <!-- Right Action Buttons & Phone -->
            <div class="flex flex-col sm:flex-row lg:flex-col items-start sm:items-center lg:items-start gap-4 shrink-0">
                <a href="{{ route('contact') }}?service=chup-anh-su-kien" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-sm shadow-xl shadow-orange-500/30 hover:scale-105 active:scale-100 transition-all duration-300">
                    <span>Nhận tư vấn &amp; Báo giá ngay</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>

                <!-- Phone Row -->
                <div class="relative flex items-center gap-3.5 p-2 sm:p-2.5 pr-6 rounded-full bg-slate-950/90 backdrop-blur-md border border-orange-500/40 shadow-2xl hover:border-orange-400 group transition-all duration-300"
                     style="box-shadow: 0 12px 35px -5px rgba(0, 0, 0, 0.85), 0 0 25px rgba(255, 84, 0, 0.35);">
                    
                    <div class="absolute -inset-1 bg-gradient-to-r from-orange-600/40 via-amber-500/25 to-transparent rounded-full blur-md pointer-events-none"></div>

                    <div class="relative flex items-center justify-center w-11 h-11 sm:w-12 sm:h-12 shrink-0">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-orange-400/60 animate-ping"></span>
                        <div class="relative w-full h-full rounded-full bg-gradient-to-tr from-[#ff5400] via-[#ff7a29] to-[#ea580c] text-white flex items-center justify-center shadow-lg shadow-orange-500/60 group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[22px] sm:text-[24px]">call</span>
                        </div>
                    </div>

                    <div class="flex flex-col relative z-10">
                        <a href="tel:0939363262" 
                           class="text-white text-xl sm:text-2xl font-black tracking-wide font-mono group-hover:text-amber-300 transition-colors drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                            0939.363.262
                        </a>
                        <span class="text-[11px] sm:text-xs text-slate-300 group-hover:text-slate-100 font-medium tracking-wide">
                            Hotline tư vấn đặt lịch 24/7
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- ==========================================
         8. CÂU HỎI THƯỜNG GẶP (FAQ ACCORDION)
         ========================================== -->
    <section class="py-10 sm:py-12 lg:py-14 event-section-compact bg-white" x-data="{ activeFaq: null }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-8 sm:mb-10">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-50 border border-orange-200/60 text-xs font-bold text-[#ff5400] font-mono uppercase tracking-wider mb-2">
                    <span>HỎI ĐÁP DỊCH VỤ</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    Giải Đáp Thắc Mắc Khi Thuê Chụp Ảnh Sự Kiện
                </h2>
            </div>

            <div class="space-y-4">
                
                <!-- FAQ 1 -->
                <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden transition-all duration-200"
                     :class="{ 'border-orange-500 shadow-sm': activeFaq === 1 }">
                    <button type="button" @click="activeFaq = activeFaq === 1 ? null : 1"
                            class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-[#ff5400] transition-colors">
                        <span>Sau khi sự kiện kết thúc thì bao lâu tôi nhận được ảnh?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 transition-transform duration-200 shrink-0"
                              :class="{ 'rotate-180 text-[#ff5400]': activeFaq === 1 }">expand_more</span>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Cửu Long Media hỗ trợ gửi trước <strong>30 - 50 ảnh đẹp nhất ngay trong đêm</strong> để quý doanh nghiệp kịp thời đăng bài truyền thông, mạng xã hội. Toàn bộ file ảnh gốc và ảnh đã chỉnh sửa hoàn chỉnh sẽ được bàn giao trong vòng <strong>24h - 48h</strong> qua link đám mây Google Drive tốc độ cao.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden transition-all duration-200"
                     :class="{ 'border-orange-500 shadow-sm': activeFaq === 2 }">
                    <button type="button" @click="activeFaq = activeFaq === 2 ? null : 2"
                            class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-[#ff5400] transition-colors">
                        <span>Ekip có nhận chụp tại các tỉnh lân cận Cần Thơ không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 transition-transform duration-200 shrink-0"
                              :class="{ 'rotate-180 text-[#ff5400]': activeFaq === 2 }">expand_more</span>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Có. Cửu Long Media có đội ngũ ekip cơ động sẵn sàng tác nghiệp tại tất cả 13 tỉnh thành Đồng bằng Sông Cửu Long (Hậu Giang, Vĩnh Long, An Giang, Kiên Giang, Đồng Tháp, Sóc Trăng, Bạc Liêu, Cà Mau...). Chi phí di chuyển ngoại tỉnh sẽ được báo giá minh bạch, tối ưu nhất.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden transition-all duration-200"
                     :class="{ 'border-orange-500 shadow-sm': activeFaq === 3 }">
                    <button type="button" @click="activeFaq = activeFaq === 3 ? null : 3"
                            class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-[#ff5400] transition-colors">
                        <span>Truyền Thông Cửu Long có xuất hóa đơn đỏ (VAT) không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 transition-transform duration-200 shrink-0"
                              :class="{ 'rotate-180 text-[#ff5400]': activeFaq === 3 }">expand_more</span>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Có. Là công ty pháp nhân chuyên nghiệp, chúng tôi cung cấp đầy đủ hợp đồng kinh tế, biên bản nghiệm thu và hóa đơn giá trị gia tăng điện tử (VAT) hợp lệ cho tất cả khách hàng cơ quan, doanh nghiệp.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden transition-all duration-200"
                     :class="{ 'border-orange-500 shadow-sm': activeFaq === 4 }">
                    <button type="button" @click="activeFaq = activeFaq === 4 ? null : 4"
                            class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-[#ff5400] transition-colors">
                        <span>Thợ chụp ảnh có mặc đồng phục hay vest lịch sự không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 transition-transform duration-200 shrink-0"
                              :class="{ 'rotate-180 text-[#ff5400]': activeFaq === 4 }">expand_more</span>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        100% thợ chụp ảnh của Cửu Long đều tuân thủ dresscode chuyên nghiệp: áo sơ mi đen / polo đen có cổ / vest tối màu lịch sự, đi giày trang nhã và đeo thẻ tác nghiệp. Tác phong nhã nhặn, tôn trọng không gian sự kiện của khách hàng.
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection
