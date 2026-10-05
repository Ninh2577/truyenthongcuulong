@extends('layouts.app')

@section('title', 'Dịch Vụ Quản Trị & Chăm Sóc Website Chuyên Nghiệp • Bảo Mật & Ổn Định 24/7 - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ quản trị và chăm sóc website toàn diện: sao lưu tự động, tối ưu Google PageSpeed 90+, vá lỗi bảo mật, đăng bài viết chuẩn SEO và giám sát uptime 24/7.')

@section('content')
<div class="w-full bg-[#fcfdff] text-slate-800 antialiased overflow-x-hidden" style="font-family: var(--font-primary, 'Mulish', sans-serif);">

    <!-- ==========================================
         1. HERO SECTION (100% MATCH WITH REFERENCE IMAGE 2)
         ========================================== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap">

    <section class="relative w-full overflow-hidden border-b border-orange-500/20 pt-20 flex items-center min-h-[460px] lg:min-h-[490px] xl:min-h-[520px]"
             style="background-color: #040812;">
        
        <!-- Full-Width Background Image 1.png (Edge to Edge 100vw, cropped top for optimal horizon & laptop focus) -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/quan-tri/1.png') }}?v={{ time() }}" 
                 alt="Dịch vụ quản trị và chăm sóc website chuyên nghiệp - Truyền Thông Cửu Long" 
                 class="w-full h-full object-cover object-[72%_center] lg:object-center select-none pointer-events-none">
            
            <!-- Soft Twilight Vignette: Preserves room ambiance while ensuring 100% crisp text readability -->
            <div class="absolute inset-0 pointer-events-none"
                 style="background: linear-gradient(to right, rgba(4, 8, 18, 0.92) 0%, rgba(4, 8, 18, 0.75) 42%, rgba(4, 8, 18, 0.35) 60%, transparent 100%); width: 62%;"></div>
            <div class="absolute inset-0 sm:hidden pointer-events-none"
                 style="background: linear-gradient(to top, rgba(4, 8, 18, 0.95) 0%, transparent 50%, rgba(4, 8, 18, 0.3) 100%);"></div>
        </div>

        <!-- Content Container (Aligns with max-w-7xl header) -->
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-6 lg:py-8 relative z-10">
            <div class="max-w-xl lg:max-w-2xl xl:max-w-[52%] flex flex-col justify-center" style="gap: 13px;">
                
                <!-- Tag / Category (Solid Fiery Orange, uppercase, wide tracking) -->
                <div>
                    <span style="color: #ff5400; font-weight: 800; font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; font-family: 'Mulish', monospace, sans-serif; text-shadow: 0 1px 4px rgba(0,0,0,0.95);">
                        DỊCH VỤ QUẢN TRỊ &amp; CHĂM SÓC WEBSITE
                    </span>
                </div>

                <!-- Main H1 (2 Lines: Line 1 White, Line 2 Solid Fiery Orange - 100% Identical to Image 2) -->
                <h1 style="margin: 0; line-height: 1.15; letter-spacing: -0.02em;">
                    <span style="color: #ffffff; font-weight: 900; font-size: clamp(28px, 3.4vw, 44px); display: block; text-shadow: 0 2px 10px rgba(0,0,0,0.95);">
                        Giải Pháp Quản Trị Website
                    </span>
                    <span style="color: #ff5400; font-weight: 900; font-size: clamp(28px, 3.4vw, 44px); display: block; margin-top: 4px; text-shadow: 0 2px 12px rgba(0,0,0,0.95);">
                        Vận Hành Ổn Định &amp; Bảo Mật 24/7
                    </span>
                </h1>

                <!-- Description Paragraph (Light Silver-White, High Contrast) -->
                <p style="color: #cbd5e1; font-size: 14px; line-height: 1.6; max-width: 540px; margin: 0; text-shadow: 0 1px 4px rgba(0,0,0,0.95);">
                    Đồng hành bảo vệ, tối ưu tốc độ tải trang, sao lưu dữ liệu và chăm sóc nội dung website liên tục, giúp doanh nghiệp tiết kiệm 80% chi phí nhân sự IT và an tâm bứt phá doanh số.
                </p>

                <!-- 4 Feature Badges (2 Columns x 2 Rows with Orange Circle Icons & Crisp White Text) -->
                <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px 24px; padding-top: 4px; max-width: 520px;">
                    <!-- 1. Uptime ổn định 99.9% -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; fill: white;" viewBox="0 0 24 24">
                                <path d="m20.38 8.57-1.23 1.85a8 8 0 0 1-.22 7.58H5.07A8 8 0 0 1 15.58 6.85l1.85-1.23A10 10 0 0 0 3.35 19a2 2 0 0 0 1.72 1h13.85a2 2 0 0 0 1.74-1 10 10 0 0 0-.28-10.43zM10.5 15.25a1.25 1.25 0 1 1 2.22-.78l3.1-4.66a.75.75 0 0 0-1.04-1.04l-4.66 3.1a1.25 1.25 0 0 1 .38 3.38z"/>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Uptime ổn định 99.9%
                        </span>
                    </div>

                    <!-- 2. Tối ưu PageSpeed 90+ -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; stroke: white; fill: none; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                                <polyline points="16 7 22 7 22 13"></polyline>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Tối ưu PageSpeed 90+
                        </span>
                    </div>

                    <!-- 3. Sao lưu dữ liệu đa tầng -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; stroke: white; fill: none; stroke-width: 2.4; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Sao lưu dữ liệu đa tầng
                        </span>
                    </div>

                    <!-- 4. Hỗ trợ sự cố < 15 phút -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 26px; height: 26px; border-radius: 9999px; background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(255, 84, 0, 0.45); flex-shrink: 0;">
                            <svg style="width: 14px; height: 14px; stroke: white; fill: none; stroke-width: 2.4; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 13.5px; text-shadow: 0 1px 4px rgba(0,0,0,0.95); white-space: nowrap;">
                            Hỗ trợ sự cố &lt; 15 phút
                        </span>
                    </div>
                </div>

                <!-- 2 CTA Action Buttons -->
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 14px; padding-top: 6px;">
                    <!-- Button 1: Nhận tư vấn & Báo giá -->
                    <a href="{{ route('contact') }}" 
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
                    <a href="#bang-gia" 
                       style="background: rgba(15, 23, 42, 0.65) !important; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1.5px solid rgba(255, 255, 255, 0.4) !important; color: #ffffff !important; padding: 12px 24px; border-radius: 9999px; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s;"
                       onmouseover="this.style.borderColor='#ff7a29'; this.style.transform='scale(1.04)';"
                       onmouseout="this.style.borderColor='rgba(255, 255, 255, 0.4)'; this.style.transform='scale(1)';">
                        <span>Xem bảng giá dịch vụ</span>
                        <svg style="width: 16px; height: 16px; stroke: #ff7a29; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;" viewBox="0 0 24 24">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                    </a>
                </div>

                <!-- Handwriting Quote at bottom-left (Off-White Script, Rotated -3deg, Exact to Image 2) -->
                <div style="padding-top: 8px;">
                    <p style="font-family: 'Dancing Script', 'Caveat', cursive, sans-serif; font-size: 22px; font-weight: 700; color: #ffffff; line-height: 1.25; transform: rotate(-3deg); transform-origin: left center; text-shadow: 0 2px 8px rgba(0,0,0,0.95); margin: 0; letter-spacing: 0.02em;">
                        Hệ thống của bạn luôn được<br>
                        giám sát và bảo vệ 24/7
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================================================================
         BỌC TOÀN BỘ NỘI DUNG (SECTIONS 2 ĐẾN 5) TRONG THẺ CONTAINER
         VỚI NỀN ĐỔ BÓNG / ÁNH SÁNG AMBIENT GLOW CHUẨN CAO CẤP
         ========================================================================= -->
    <div class="relative w-full overflow-hidden" 
         style="background: radial-gradient(circle at 12% 16%, rgba(255, 122, 41, 0.22) 0%, transparent 50%), 
                           radial-gradient(circle at 88% 36%, rgba(14, 165, 233, 0.20) 0%, transparent 55%), 
                           radial-gradient(circle at 18% 65%, rgba(245, 158, 11, 0.22) 0%, transparent 55%),
                           radial-gradient(circle at 85% 88%, rgba(16, 185, 129, 0.20) 0%, transparent 50%),
                           linear-gradient(180deg, #ffffff 0%, #f8faff 40%, #f3f7fd 100%);">
        
        <!-- Ambient Background Glows & Shadows Nổi Bật -->
        <div class="absolute top-[5%] -left-24 w-[640px] h-[640px] rounded-full bg-gradient-to-br from-orange-400/50 via-amber-300/35 to-transparent blur-[100px] pointer-events-none"></div>
        <div class="absolute top-[26%] -right-28 w-[720px] h-[720px] rounded-full bg-gradient-to-bl from-sky-400/45 via-indigo-300/30 to-transparent blur-[110px] pointer-events-none"></div>
        <div class="absolute top-[54%] -left-20 w-[680px] h-[680px] rounded-full bg-gradient-to-tr from-emerald-400/40 via-teal-300/30 to-transparent blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-[3%] right-[-5%] w-[640px] h-[640px] rounded-full bg-gradient-to-tl from-amber-400/50 via-orange-400/35 to-transparent blur-[100px] pointer-events-none"></div>

        <x-ui.container class="container py-12 sm:py-16 lg:py-20 relative z-10">

        <!-- ==========================================
             2. 5 VẤN ĐỀ THƯỜNG GẶP KHI THIẾU QUẢN TRỊ WEBSITE
             ========================================== -->
        <section id="thach-thuc" class="space-y-8 sm:space-y-10 scroll-mt-28">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>RỦI RO THỰC TẾ KHI WEBSITE THIẾU NGƯỜI CHĂM SÓC</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Website Của Bạn Có Đang Gặp Phải Những Tình Trạng Này?
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Thiếu đội ngũ kỹ thuật chuyên trách khiến website xuống cấp, mất dần thứ hạng tìm kiếm và bỏ lỡ hàng ngàn khách hàng tiềm năng.
                </p>
            </div>

            <!-- 5 Cards in a row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- Card 1: Nhiễm mã độc & virus -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-rose-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-rose-50 border border-rose-200/60 flex items-center justify-center text-rose-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">gpp_maybe</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-rose-600 transition-colors">
                        Nhiễm mã độc &amp; Spam
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Không vá lỗi kịp thời khiến web bị hacker chèn link cờ bạc, Google đưa vào danh sách đen.
                    </p>
                </div>

                <!-- Card 2: Web chạy chậm, mất khách -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-amber-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-amber-50 border border-amber-200/60 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">speed</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                        Tải chậm, mất khách
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Hình ảnh nặng, rác database khiến khách hàng thoát trang ngay sau 3 giây chờ đợi.
                    </p>
                </div>

                <!-- Card 3: Không ai viết bài, cập nhật -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-sky-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-sky-50 border border-sky-200/60 flex items-center justify-center text-sky-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">article</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-sky-600 transition-colors">
                        Nội dung cũ kỹ
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Hàng tháng không có bài viết mới, banner hết hạn làm giảm sút uy tín thương hiệu trong mắt khách.
                    </p>
                </div>

                <!-- Card 4: Mất dữ liệu khi sự cố -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-purple-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-purple-50 border border-purple-200/60 flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">cloud_off</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-purple-600 transition-colors">
                        Không sao lưu dữ liệu
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Khi server bị lỗi hoặc virus phá hủy, không có bản sao lưu dự phòng để khôi phục lại dữ liệu.
                    </p>
                </div>

                <!-- Card 5: Chi phí thuê IT quá cao -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 border border-emerald-200/60 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">
                        Chi phí IT đắt đỏ
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Thuê nhân sự IT và Content toàn thời gian tốn 15 - 20 triệu/tháng nhưng không đủ khối lượng việc.
                    </p>
                </div>

            </div>

        </section>


        <!-- ==========================================
             3. 6 BƯỚC QUY TRÌNH QUẢN TRỊ & BẢO TRÌ CHUẨN
             ========================================== -->
        <section id="quy-trinh" class="space-y-8 sm:space-y-10 scroll-mt-28" style="margin-top: clamp(45px, 5.5vw, 65px);">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>QUY TRÌNH VẬN HÀNH CHUYÊN NGHIỆP</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    6 Bước Quản Trị &amp; Chăm Sóc Toàn Diện
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Quy trình giám sát và tối ưu hóa khép kín, đảm bảo website của bạn luôn vận hành trơn tru và phát triển liên tục.
                </p>
            </div>

            <!-- 6 Steps Cards Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                
                <!-- Step 01: Audit toàn diện -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-orange-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-orange-500 text-white font-mono text-[10px] font-black flex items-center justify-center">01</span>
                        <span class="w-8 h-8 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">find_in_page</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">Audit &amp; Rà soát</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Kiểm tra bảo mật, tốc độ tải, link hỏng và lỗi kỹ thuật.</p>
                    </div>
                </div>

                <!-- Step 02: Vá lỗi & Bảo mật -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-mono text-[10px] font-black flex items-center justify-center">02</span>
                        <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">security</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-600 transition-colors leading-snug">Vá lỗi bảo mật</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Cập nhật core, plugin, gia cố SSL và tường lửa chống tấn công.</p>
                    </div>
                </div>

                <!-- Step 03: Tối ưu tốc độ -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-sky-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-sky-500 text-white font-mono text-[10px] font-black flex items-center justify-center">03</span>
                        <span class="w-8 h-8 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">rocket_launch</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-sky-600 transition-colors leading-snug">Tối ưu tốc độ</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Nén ảnh WebP, tối ưu database và cache đạt PageSpeed 90+.</p>
                    </div>
                </div>

                <!-- Step 04: Sao lưu tự động -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-indigo-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-indigo-500 text-white font-mono text-[10px] font-black flex items-center justify-center">04</span>
                        <span class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">cloud_sync</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors leading-snug">Sao lưu đa tầng</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Cài đặt backup định kỳ tự động lưu trữ trên Cloud độc lập.</p>
                    </div>
                </div>

                <!-- Step 05: Chăm sóc nội dung -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-cyan-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-cyan-500 text-white font-mono text-[10px] font-black flex items-center justify-center">05</span>
                        <span class="w-8 h-8 rounded-full bg-cyan-50 text-cyan-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">edit_note</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-cyan-600 transition-colors leading-snug">Đăng bài chuẩn SEO</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Sản xuất nội dung, cập nhật sản phẩm &amp; thiết kế banner sự kiện.</p>
                    </div>
                </div>

                <!-- Step 06: Báo cáo định kỳ -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-blue-400 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-blue-600 text-white font-mono text-[10px] font-black flex items-center justify-center">06</span>
                        <span class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">analytics</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors leading-snug">Báo cáo hàng tháng</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Báo cáo chỉ số traffic, thứ hạng và đề xuất cải tiến định kỳ.</p>
                    </div>
                </div>

            </div>

        </section>


        <!-- ==========================================
             4. CÁC HẠNG MỤC DỊCH VỤ QUẢN TRỊ CHI TIẾT
             ========================================== -->
        <section id="hang-muc" class="space-y-8 sm:space-y-10 scroll-mt-28" style="margin-top: clamp(45px, 5.5vw, 65px);">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>CÁC HẠNG MỤC DỊCH VỤ</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Giải Pháp Vận Hành Toàn Diện Cho Doanh Nghiệp
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Tùy theo quy mô và ngành nghề kinh doanh, chúng tôi cung cấp đầy đủ các gói dịch vụ linh hoạt, đáp ứng mọi yêu cầu kỹ thuật.
                </p>
            </div>

            <!-- 2 Columns Grid: Left Image (care-categories-3d.png) + Right 6 Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left: Real Developer Workstation & Checklist Notebook -->
                <div class="lg:col-span-5 relative flex items-center justify-center">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-amber-400/20 via-orange-500/15 to-transparent rounded-3xl blur-2xl pointer-events-none"></div>
                    <img src="{{ asset('images/quan-tri/care-categories-3d.png') }}?v={{ time() }}" 
                         alt="Hạng mục dịch vụ quản trị và chăm sóc website chuyên nghiệp" 
                         class="w-full max-w-md h-auto object-contain rounded-2xl block relative z-10 shadow-2xl hover:scale-[1.02] transition-transform duration-300">
                </div>

                <!-- Right: 6 Service Cards (2 Columns x 3 Rows) -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- 1. Bảo mật & Chống mã độc -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-rose-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">shield</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-rose-600 transition-colors">
                                Bảo Mật &amp; Quét Mã Độc
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Cài đặt tường lửa WAF, vá lỗ hổng zero-day, rà quét mã độc tự động hàng ngày.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-rose-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 2. Tối ưu tốc độ PageSpeed -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-amber-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">speed</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                                Tối Ưu Tốc Độ PageSpeed
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Nén ảnh chuẩn WebP, tối ưu bộ nhớ đệm Cache và database, cam kết điểm xanh 90+.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-amber-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 3. Sao lưu dữ liệu đa tầng -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">cloud_done</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">
                                Sao Lưu Dữ Liệu Đa Tầng
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Tự động sao lưu database và source code định kỳ lưu trữ an toàn trên Google Drive / Cloud.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-emerald-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 4. Đăng bài viết chuẩn SEO -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-sky-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">edit_note</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-sky-600 transition-colors">
                                Viết Bài Chuẩn SEO
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Sản xuất bài viết giàu giá trị, đúng ý định tìm kiếm, gắn internal link chuẩn E-E-A-T.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-sky-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 5. Thiết kế Banner & Đồ Họa Web -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-purple-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">palette</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-purple-600 transition-colors">
                                Thiết Kế Banner Sự Kiện
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Cập nhật banner trang chủ, slider khuyến mãi và đồ họa bài viết đồng bộ nhận diện.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-purple-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 6. Giám sát & Ứng cứu 24/7 -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-orange-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-orange-50 text-[#ff5400] flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">support_agent</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors">
                                Giám Sát Uptime &amp; Hỗ Trợ 24/7
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Cảnh báo downtime tức thì, đội ngũ kỹ thuật phản hồi xử lý sự cố trong vòng 15 phút.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-[#ff5400] inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                </div>

            </div>

        </section>


        <!-- ==========================================
             5. MINH CHỨNG HIỆU QUẢ & BÁO CÁO THỰC TẾ
             ========================================== -->
        <section id="minh-chung" class="space-y-8 sm:space-y-10 scroll-mt-28" style="margin-top: clamp(45px, 5.5vw, 65px);">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>BÁO CÁO MINH BẠCH &amp; ĐO LƯỜNG THỰC TẾ</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Những Con Số Thực Tế Đáng Tự Hào
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Mỗi tháng, khách hàng của Truyền Thông Cửu Long đều nhận được bản báo cáo chi tiết về tốc độ, bảo mật và lưu lượng tăng trưởng.
                </p>
            </div>

            <!-- 2 Columns Grid: iPad Case Study Left + Metrics & Quote Right -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left: Tablet with Monthly Maintenance Report (maintenance-proof.png) -->
                <div class="lg:col-span-7 relative group">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-emerald-500/15 via-sky-400/15 to-transparent rounded-3xl blur-2xl pointer-events-none"></div>
                    <img src="{{ asset('images/quan-tri/maintenance-proof.png') }}?v={{ time() }}" 
                         alt="Báo cáo bảo trì website hàng tháng thực tế - Truyền Thông Cửu Long" 
                         class="w-full h-auto object-contain block relative z-10 mx-auto drop-shadow-xl transform group-hover:scale-[1.01] transition-transform duration-300">
                </div>

                <!-- Right: Stats & Testimonial Quote -->
                <div class="lg:col-span-5 space-y-4">
                    
                    <!-- 3 Stats Cards in a Row / Column -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-3.5">
                        
                        <!-- Metric 1: Google PageSpeed -->
                        <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-4">
                            <span class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[26px]">speed</span>
                            </span>
                            <div>
                                <div class="text-2xl font-black text-emerald-600 font-mono">98/100</div>
                                <div class="text-xs text-slate-500 font-medium">Điểm Google PageSpeed Desktop</div>
                            </div>
                        </div>

                        <!-- Metric 2: Uptime Guarantee -->
                        <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-4">
                            <span class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[26px]">timer</span>
                            </span>
                            <div>
                                <div class="text-2xl font-black text-slate-900 font-mono">99.9%</div>
                                <div class="text-xs text-slate-500 font-medium">Uptime vận hành liên tục</div>
                            </div>
                        </div>

                        <!-- Metric 3: Incident Response -->
                        <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-4">
                            <span class="w-12 h-12 rounded-xl bg-sky-50 text-sky-500 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[26px]">bolt</span>
                            </span>
                            <div>
                                <div class="text-2xl font-black text-sky-600 font-mono">&lt; 15 phút</div>
                                <div class="text-xs text-slate-500 font-medium">Thời gian phản hồi sự cố khẩn cấp</div>
                            </div>
                        </div>

                    </div>

                    <!-- Testimonial Quote Box -->
                    <div class="p-6 rounded-2xl bg-[#fffbf5] border border-amber-200/70 shadow-md hover:shadow-lg transition-all space-y-3 relative overflow-hidden">
                        <span class="text-3xl text-amber-400 font-serif leading-none block">“</span>
                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed italic">
                            "Nhờ Cửu Long quản trị, website của chúng tôi luôn chạy nhanh như chớp, dữ liệu được backup an toàn hàng ngày và không còn nỗi lo sập web trong các đợt chạy quảng cáo cao điểm."
                        </p>
                        <div class="text-xs font-bold text-slate-900 pt-1 border-t border-amber-200/50">
                            — Giám đốc điều hành Doanh nghiệp tại Cần Thơ
                        </div>
                    </div>

                </div>

            </div>

        </section>


        <!-- ==========================================
             5.5 BẢNG GIÁ CÁC GÓI QUẢN TRỊ WEBSITE MINH BẠCH
             ========================================== -->
        <section id="bang-gia" class="space-y-8 sm:space-y-10 scroll-mt-28" style="margin-top: clamp(45px, 5.5vw, 65px);">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>BẢNG GIÁ DỊCH VỤ MINH BẠCH</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Các Gói Chăm Sóc &amp; Quản Trị Website
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Tiết kiệm đến 80% so với tự tuyển nhân sự. Không phát sinh chi phí ẩn, cam kết hiệu quả rõ ràng trong hợp đồng.
                </p>
            </div>

            <!-- Pricing Grid: 3 Packages -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-stretch">
                
                <!-- Package 1: Cơ Bản -->
                <div class="p-6 sm:p-7 rounded-3xl bg-white border border-slate-200/90 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between space-y-6 relative">
                    <div class="space-y-4">
                        <div class="inline-flex px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold uppercase font-mono">
                            KHỞI NGHIỆP / CƠ BẢN
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-slate-900 font-mono">
                                1.200.000 <span class="text-sm font-sans font-bold text-slate-500">đ/tháng</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Phù hợp web giới thiệu doanh nghiệp, landing page.</p>
                        </div>
                        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-700 pt-2 border-t border-slate-100">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Sao lưu dữ liệu: <strong>1 lần / tuần</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Quét mã độc &amp; bảo mật SSL định kỳ</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Tối ưu tốc độ tải trang cơ bản</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Đăng tải: <strong>4 bài viết / tháng</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Hỗ trợ sự cố giờ hành chính</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('contact') }}" 
                       class="w-full text-center py-3 rounded-full bg-slate-100 hover:bg-orange-50 hover:text-[#ff5400] text-slate-800 font-bold text-xs sm:text-sm border border-slate-200 transition-colors">
                        Đăng ký gói Cơ Bản
                    </a>
                </div>

                <!-- Package 2: Tiêu Chuẩn (BEST CHOICE) -->
                <div class="p-6 sm:p-7 rounded-3xl bg-gradient-to-b from-[#fffbf8] to-white border-2 border-[#ff5400] shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between space-y-6 relative">
                    <!-- Best Choice Badge -->
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                        ★ PHỔ BIẾN NHẤT
                    </div>
                    <div class="space-y-4">
                        <div class="inline-flex px-3 py-1 rounded-full bg-orange-100 text-[#ff5400] text-xs font-bold uppercase font-mono">
                            DOANH NGHIỆP &amp; BÁN HÀNG
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-[#ff5400] font-mono">
                                2.800.000 <span class="text-sm font-sans font-bold text-slate-500">đ/tháng</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Phù hợp web bán hàng, dịch vụ, spa, phòng khám.</p>
                        </div>
                        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-700 pt-2 border-t border-orange-100">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Sao lưu dữ liệu: <strong>Hàng ngày (Daily)</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Tối ưu Google PageSpeed <strong>90+</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Viết &amp; Đăng: <strong>10 - 12 bài SEO / tháng</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Thiết kế: <strong>2 - 4 banner sự kiện</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Giám sát Uptime <strong>24/7</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Hỗ trợ khẩn cấp <strong>&lt; 30 phút</strong></span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('contact') }}" 
                       class="w-full text-center py-3.5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#e64a00] hover:to-[#ff5400] text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-orange-500/25 transition-all">
                        Đăng ký gói Tiêu Chuẩn
                    </a>
                </div>

                <!-- Package 3: Toàn Diện / VIP -->
                <div class="p-6 sm:p-7 rounded-3xl bg-white border border-slate-200/90 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between space-y-6 relative">
                    <div class="space-y-4">
                        <div class="inline-flex px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold uppercase font-mono">
                            THƯƠNG MẠI &amp; WEB APP VIP
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-slate-900 font-mono">
                                5.500.000 <span class="text-sm font-sans font-bold text-slate-500">đ/tháng</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Phù hợp hệ sinh thái Web App, sàn TMĐT quy mô lớn.</p>
                        </div>
                        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-700 pt-2 border-t border-slate-100">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Quản trị toàn diện Web &amp; Server riêng</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Tối ưu Core Web Vitals chuẩn tối đa</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Đăng tải: <strong>20+ bài viết SEO / tháng</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Thiết kế: <strong>6 banner khuyến mãi</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Tích hợp kỹ thuật API, Webhook, VietQR</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Cam kết SLA phản hồi <strong>&lt; 15 phút</strong></span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('contact') }}" 
                       class="w-full text-center py-3 rounded-full bg-slate-100 hover:bg-orange-50 hover:text-[#ff5400] text-slate-800 font-bold text-xs sm:text-sm border border-slate-200 transition-colors">
                        Đăng ký gói Toàn Diện
                    </a>
                </div>

            </div>

        </section>

    </x-ui.container>
    </div>


    <!-- ==========================================
         6. SẴN SÀNG BỨT PHÁ (BANNER TOÀN CẢNH CTA CẦU CẦN THƠ HOÀNG HÔN - FULL-WIDTH)
         ========================================== -->
    <section class="w-full relative overflow-hidden py-16 sm:py-20 lg:py-24 text-white bg-slate-950">
        
        <!-- Background Twilight Landscape Photo (cta-maintenance.png) -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/quan-tri/cta-maintenance.png') }}?v={{ time() }}" 
                 alt="Văn phòng kỹ thuật Truyền Thông Cửu Long nhìn ra cầu Cần Thơ" 
                 class="w-full h-full object-cover object-center opacity-65">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/88 to-slate-950/80"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8 sm:gap-10">
            
            <!-- Left Info -->
            <div class="space-y-3.5 max-w-2xl">
                <div class="text-xs font-bold text-[#ff7a29] uppercase font-mono tracking-wider flex items-center gap-1.5"
                     style="text-shadow: 0 1px 4px rgba(0,0,0,0.9);">
                    <span class="font-extrabold text-[#ff5400]">::</span>
                    <span>ĐỒNG HÀNH KỸ THUẬT VỮNG CHẮC</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-white tracking-tight leading-tight"
                    style="text-shadow: 0 2px 10px rgba(0,0,0,0.95);">
                    Để Website Của Bạn Luôn Vận Hành<br class="hidden sm:inline"> Mượt Mà &amp; An Toàn 24/7
                </h2>
                
                <!-- Description text with distinct high-contrast white & shadow (no background container) -->
                <p style="color: #ffffff; font-size: 15px; line-height: 1.65; font-weight: 500; text-shadow: 0 1px 3px #000000, 0 2px 8px rgba(0, 0, 0, 0.95), 0 0 16px rgba(0, 0, 0, 0.9); max-width: 580px; margin: 0;">
                    Liên hệ ngay với <strong style="color: #ff9e58; font-weight: 700; text-shadow: 0 1px 4px #000000;">Truyền Thông Cửu Long</strong> để nhận bản kiểm tra Audit website miễn phí và xây dựng lộ trình chăm sóc tối ưu nhất cho doanh nghiệp.
                </p>
            </div>

            <!-- Right Action Buttons & Phone -->
            <div class="flex flex-col sm:flex-row lg:flex-col items-start sm:items-center lg:items-start gap-4 shrink-0">
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-sm shadow-xl shadow-orange-500/30 hover:scale-105 active:scale-100 transition-all duration-300">
                    <span>Nhận tư vấn &amp; Báo giá</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>

                <!-- Phone Row: Màu nền đậm sang trọng, viền cam phát sáng, icon rung chuông & sóng xung kích -->
                <div class="relative flex items-center gap-3.5 p-2 sm:p-2.5 pr-6 rounded-full bg-slate-950/90 backdrop-blur-md border border-orange-500/40 shadow-2xl hover:border-orange-400 group transition-all duration-300"
                     style="box-shadow: 0 12px 35px -5px rgba(0, 0, 0, 0.85), 0 0 25px rgba(255, 84, 0, 0.35);">
                    
                    <!-- Ambient Rich Orange Shadow/Glow -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-orange-600/40 via-amber-500/25 to-transparent rounded-full blur-md pointer-events-none"></div>

                    <!-- Animated Call Icon Container -->
                    <div class="relative flex items-center justify-center w-11 h-11 sm:w-12 sm:h-12 shrink-0">
                        <!-- Pulse wave radiating outward -->
                        <span class="absolute inline-flex h-full w-full rounded-full bg-orange-400/60 animate-ping"></span>
                        <span class="absolute inline-flex h-12 w-12 rounded-full bg-amber-400/40 animate-pulse-wave"></span>
                        
                        <!-- Call Icon with Phone Ringing Wobble & Rich Orange Shadow -->
                        <div class="relative w-full h-full rounded-full bg-gradient-to-tr from-[#ff5400] via-[#ff7a29] to-[#ea580c] text-white flex items-center justify-center shadow-lg shadow-orange-500/60 group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[22px] sm:text-[24px] animate-phone-ring">call</span>
                        </div>
                    </div>

                    <!-- Phone Number & Subtitle -->
                    <div class="flex flex-col relative z-10">
                        <a href="tel:0939363262" 
                           class="text-white text-xl sm:text-2xl font-black tracking-wide font-mono group-hover:text-amber-300 transition-colors drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                            0939.363.262
                        </a>
                        <span class="text-[11px] sm:text-xs text-slate-300 group-hover:text-slate-100 font-medium tracking-wide">
                            Gọi ngay để được hỗ trợ nhanh nhất
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Custom Animation Styles for Ringing Phone & Wave Pulse -->
    <style>
        @keyframes phoneRing {
            0%, 100% { transform: rotate(0deg) scale(1); }
            10%, 30% { transform: rotate(-14deg) scale(1.08); }
            20%, 40% { transform: rotate(14deg) scale(1.08); }
            50% { transform: rotate(-8deg) scale(1.04); }
            60% { transform: rotate(8deg) scale(1.04); }
            70%, 90% { transform: rotate(0deg) scale(1); }
        }
        @keyframes pulseWave {
            0% { transform: scale(0.9); opacity: 0.9; }
            50% { transform: scale(1.45); opacity: 0; }
            100% { transform: scale(1.45); opacity: 0; }
        }
        .animate-phone-ring {
            display: inline-block;
            animation: phoneRing 2s infinite ease-in-out;
            transform-origin: center center;
        }
        .animate-pulse-wave {
            animation: pulseWave 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
    </style>


    <!-- ==========================================
         7. CÂU HỎI THƯỜNG GẶP (FAQ - BỌC CONTAINER & NỀN ĐỔ BÓNG)
         ========================================== -->
    <div class="relative w-full overflow-hidden" 
         style="background: radial-gradient(circle at 85% 30%, rgba(255, 122, 41, 0.18) 0%, transparent 50%), 
                           radial-gradient(circle at 15% 70%, rgba(14, 165, 233, 0.16) 0%, transparent 50%), 
                           linear-gradient(180deg, #ffffff 0%, #fafdff 100%);">
        <div class="absolute -top-16 -right-16 w-[450px] h-[450px] rounded-full bg-gradient-to-br from-orange-400/35 via-amber-300/25 to-transparent blur-[90px] pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-[450px] h-[450px] rounded-full bg-gradient-to-tr from-sky-400/30 via-indigo-300/20 to-transparent blur-[90px] pointer-events-none"></div>

        <x-ui.container class="container py-14 sm:py-20 lg:py-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start" x-data="{ active: 1 }">
            
            <!-- Left Header -->
            <div class="lg:col-span-5 space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>CÂU HỎI THƯỜNG GẶP</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Giải Đáp Thắc Mắc Về Dịch Vụ Quản Trị
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed">
                    Mọi thắc mắc về kỹ thuật, dữ liệu và quy trình bàn giao đều được chúng tôi giải đáp minh bạch.
                </p>
            </div>

            <!-- Right FAQ Accordion List -->
            <div class="lg:col-span-7 divide-y divide-slate-200 border-y border-slate-200">
                
                <!-- FAQ 1 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 1 ? null : 1)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Doanh nghiệp có cần cung cấp toàn bộ tài khoản Hosting / Server không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 1 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 1" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Để thực hiện bảo mật, sao lưu và tối ưu tốc độ, Cửu Long cần quyền truy cập quản trị website (Admin) và quyền hosting/cPanel. Chúng tôi cam kết bảo mật 100% bằng hợp đồng pháp lý (NDA) và hướng dẫn bạn tạo tài khoản phân quyền riêng biệt an toàn.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 2 ? null : 2)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Nếu website bị sập hoặc gặp sự cố vào ban đêm thì có được xử lý không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 2 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 2" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Có. Hệ thống giám sát Uptime của Cửu Long hoạt động tự động 24/7. Khi phát hiện website chập chờn hoặc không truy cập được, hệ thống sẽ tự động bắn cảnh báo khẩn cấp về nhóm kỹ sư trực ca để kiểm tra và khôi phục ngay trong vòng 15 - 30 phút.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 3 ? null : 3)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Bài viết do Cửu Long đăng tải có chuẩn SEO và đúng chuyên môn ngành không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 3 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 3" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        100% bài viết do đội ngũ Content Creator chuyên nghiệp của Cửu Long biên tập, nghiên cứu kỹ lưỡng ngành nghề của bạn, chuẩn hóa cấu trúc Heading (H1, H2, H3), tối ưu hình ảnh và thẻ Alt, đảm bảo mang lại giá trị thực cho người đọc và hỗ trợ tăng hạng Google.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 4 ? null : 4)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Website từng bị dính mã độc hoặc bị Google cảnh báo đỏ có khôi phục được không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 4 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 4" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Hoàn toàn được. Khi tiếp nhận, kỹ sư Cửu Long sẽ quét cô lập toàn bộ mã độc, dọn sạch backdoor, gỡ bỏ link spam độc hại, sau đó gửi yêu cầu kháng nghị trực tiếp với Google Search Console để gỡ bỏ cảnh báo đỏ "Trang web lừa đảo/chứa phần mềm độc hại" cho tên miền của bạn.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 5 ? null : 5)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Hợp đồng dịch vụ quản trị tối thiểu trong bao lâu?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 5 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 5" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Thời gian hợp đồng tối thiểu thông thường là 03 tháng để hệ thống được tối ưu và tích lũy hiệu quả đo lường rõ rệt. Với các hợp đồng từ 06 tháng đến 01 năm, Cửu Long có chính sách chiết khấu ưu đãi từ 10% - 15% cùng gói tặng kèm thiết kế banner sự kiện miễn phí.
                    </div>
                </div>

            </div>

        </div>
    </x-ui.container>
    </div>

</div>
@endsection
