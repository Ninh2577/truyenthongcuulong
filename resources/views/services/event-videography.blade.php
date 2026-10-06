@extends('layouts.app')

@section('title', 'Dịch Vụ Quay Phim Sự Kiện Chuyên Nghiệp • Lưu Giữ Khoảnh Khắc Vàng - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ quay phim sự kiện chuyên nghiệp tại Cần Thơ & Miền Tây: Hội nghị, hội thảo, khai trương, gala dinner, teambuilding. Máy quay Sony Cinema Line, Flycam 4K, giao file nhanh.')

@section('content')
<div class="w-full bg-[#ffffff] text-slate-800 antialiased overflow-x-hidden selection:bg-[#ff5400] selection:text-white" 
     style="font-family: var(--font-primary, 'Mulish', sans-serif);"
     x-data="{
         videoModal: false,
         modalVideoUrl: '',
         modalVideoTitle: '',
         openModal(id, title) {
             this.modalVideoUrl = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0&modestbranding=1';
             this.modalVideoTitle = title;
             this.videoModal = true;
             document.body.style.overflow = 'hidden';
         },
         closeModal() {
             this.videoModal = false;
             this.modalVideoUrl = '';
             document.body.style.overflow = '';
         }
     }"
     @keydown.escape.window="closeModal()">

    <!-- Custom Styling Matching Mockup -->
    <style>
        .badge-pill-orange {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 16px;
            border-radius: 9999px;
            background: transparent;
            border: 1px solid #ff5400;
            color: #ff5400;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .badge-pill-light {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 16px;
            border-radius: 9999px;
            background: #fff3ec;
            border: 1px solid #ffd4bd;
            color: #ff5400;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .card-hover-effect {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-hover-effect:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
            border-color: #fdba74;
        }
        .btn-brand-orange {
            background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 8px 22px rgba(255, 84, 0, 0.4) !important;
        }
        .btn-brand-orange:hover {
            background: linear-gradient(135deg, #e04a00 0%, #ff5400 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 12px 26px rgba(255, 84, 0, 0.5) !important;
        }
        /* Pricing Table Buttons */
        .btn-pricing-outline {
            border: 1.5px solid #cbd5e1 !important;
            background-color: #ffffff !important;
            color: #334155 !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .btn-pricing-outline:hover {
            border-color: #ff5400 !important;
            background-color: #ff5400 !important;
            color: #ffffff !important;
            box-shadow: 0 6px 18px rgba(255, 84, 0, 0.35) !important;
            transform: translateY(-2px);
        }
        .btn-pricing-outline:hover span,
        .btn-pricing-outline:hover .material-symbols-outlined {
            color: #ffffff !important;
        }

        .btn-pricing-highlight {
            border: 1.5px solid #ff5400 !important;
            background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%) !important;
            color: #ff5400 !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .btn-pricing-highlight:hover {
            border-color: #e04a00 !important;
            background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 8px 22px rgba(255, 84, 0, 0.42) !important;
            transform: translateY(-2px);
        }
        .btn-pricing-highlight:hover span,
        .btn-pricing-highlight:hover .material-symbols-outlined {
            color: #ffffff !important;
        }

        /* Category Card Icons */
        .service-cat-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%) !important;
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3);
            transition: all 0.3s ease;
        }
        .card-hover-effect:hover .service-cat-icon {
            transform: scale(1.08);
            box-shadow: 0 6px 16px rgba(255, 84, 0, 0.45);
        }
        .service-cat-icon .material-symbols-outlined {
            font-size: 20px;
            color: #ffffff !important;
            line-height: 1;
        }
    </style>


    <!-- ==========================================
         SECTION 1: HERO SECTION (FULL BLEED PANORAMA)
         ========================================== -->
    <section class="relative w-full overflow-hidden min-h-[500px] lg:min-h-[560px] flex items-center"
             style="background-color: #060b14 !important;">
        
        <!-- Background Image: 1.png (Ultra-wide Cameraman on the right & Live Stage) -->
        <div class="absolute inset-0 pointer-events-none select-none overflow-hidden">
            <img src="{{ asset('images/quay-phim-su-kien/1.png') }}" 
                 alt="Máy quay phim sự kiện chuyên nghiệp 4K Cinema Line" 
                 class="w-full h-full object-cover object-right">
            <!-- Smooth Gradient Overlay to blend with solid dark background on left -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#060b14] via-[#060b14]/90 md:via-[#060b14]/75 lg:via-[#060b14]/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#060b14] via-transparent to-[#060b14]/40"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-12 sm:py-16 lg:py-20 w-full">
            <!-- Khối bọc kính mờ tối bảo vệ nội dung Banner khỏi đèn sân khấu -->
            <div class="max-w-2xl p-6 sm:p-8 lg:p-9 rounded-2xl sm:rounded-3xl bg-[#060b14]/92 backdrop-blur-md border border-white/10 shadow-2xl shadow-black/60 space-y-6">
                
                <div>
                    <span class="badge-pill-orange">
                        QUAY PHIM SỰ KIỆN
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-black text-white tracking-tight leading-[1.18]">
                    Lưu Giữ <span class="text-[#ff5400]">Khoảnh Khắc</span><br>
                    <span class="text-[#ff7a00]">Vàng</span> Của Doanh Nghiệp
                </h1>

                <p class="text-xs sm:text-sm text-white font-medium leading-relaxed max-w-xl"
                   style="color: #ffffff !important; text-shadow: 0 2px 8px rgba(0,0,0,0.95), 0 1px 3px rgba(0,0,0,0.9);">
                    Chúng tôi mang đến giải pháp quay phim sự kiện chuyên nghiệp, từ hội nghị, hội thảo, lễ khai trương, gala dinner đến teambuilding, giúp bạn lưu giữ trọn vẹn những khoảnh khắc đáng nhớ nhất.
                </p>

                <!-- 4 Feature Badges with Orange Circles -->
                <div class="flex flex-wrap items-center gap-5 sm:gap-6 pt-2">
                    
                    <!-- 1 -->
                    <div class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-full bg-[#ff5400] text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[13px]">videocam</span>
                        </span>
                        <div class="leading-tight">
                            <span class="text-xs font-bold text-white block">Kỹ thuật hiện đại</span>
                            <span class="text-[10px] text-slate-200" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">4K/6K, Cinema Line</span>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-full bg-[#ff5400] text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[13px]">groups</span>
                        </span>
                        <div class="leading-tight">
                            <span class="text-xs font-bold text-white block">Êkíp chuyên nghiệp</span>
                            <span class="text-[10px] text-slate-200" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">Nhiệt huyết</span>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-full bg-[#ff5400] text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[13px]">movie_edit</span>
                        </span>
                        <div class="leading-tight">
                            <span class="text-xs font-bold text-white block">Dựng phim sáng tạo</span>
                            <span class="text-[10px] text-slate-200" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">Hấp dẫn</span>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-full bg-[#ff5400] text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[13px]">schedule</span>
                        </span>
                        <div class="leading-tight">
                            <span class="text-xs font-bold text-white block">Giao file nhanh</span>
                            <span class="text-[10px] text-slate-200" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">Đúng tiến độ</span>
                        </div>
                    </div>

                </div>

                <!-- 2 Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-3">
                    <a href="https://zalo.me/0939363262?text={{ urlencode('Xin chào, tôi cần tư vấn báo giá dịch vụ Quay phim sự kiện') }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="px-8 py-3.5 rounded-full bg-[#ff5400] hover:bg-[#e04a00] text-white font-bold text-sm inline-flex items-center gap-2 shadow-lg shadow-orange-500/30 hover:scale-105 active:scale-95 transition-all">
                        <span>Tư vấn báo giá ngay</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>

                    <button type="button" 
                            @click="openModal('nGvVhO2kDo8', 'Showreel Phim Sự Kiện & TVC 4K - Truyền Thông Cửu Long')"
                            class="px-7 py-3.5 rounded-full bg-[#0d1627]/80 hover:bg-[#152238] border border-white/20 text-white font-bold text-sm inline-flex items-center gap-2.5 backdrop-blur-xs transition-all cursor-pointer">
                        <span>Xem dự án đã thực hiện</span>
                        <span class="w-6 h-6 rounded-full bg-orange-500/20 border border-orange-500 text-orange-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[14px] ml-0.5">play_arrow</span>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 2: CÁC HẠNG MỤC QUAY PHIM SỰ KIỆN (LIGHT 5 COLS)
         ========================================== -->
    <section class="py-14 sm:py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="badge-pill-light">DỊCH VỤ CỦA CHÚNG TÔI</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mt-3">
                    Các Hạng Mục Quay Phim Sự Kiện
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-slate-600">
                    Đáp ứng mọi nhu cầu quay phim sự kiện của doanh nghiệp, từ quy mô nhỏ đến quy mô lớn.
                </p>
            </div>

            <!-- 5 Columns Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 lg:gap-4">
                
                <!-- Item 1: Hội Nghị, Hội Thảo -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group shadow-xs">
                    <div>
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden relative">
                            <img src="{{ asset('images/quay-phim-su-kien/cat-hoi-nghi.png') }}" 
                                 alt="Hội Nghị, Hội Thảo" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4 pt-3 space-y-2">
                            <div class="service-cat-icon shrink-0" 
                                 style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%) !important; color: #ffffff !important; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3); display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px; color: #ffffff !important; line-height: 1;">co_present</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Hội Nghị, Hội Thảo
                            </h3>
                            <p class="text-[11.5px] text-slate-600 leading-relaxed">
                                Ghi lại toàn bộ diễn biến, bài phát biểu, trao đổi chuyên môn với hình ảnh chất lượng cao.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn quay phim Hội Nghị, Hội Thảo') }}" target="_blank"
                           class="inline-flex items-center gap-1 text-[11.5px] font-bold text-[#ff5400] hover:translate-x-1 transition-all">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Item 2: Lễ Khai Trương & Ra Mắt Sản Phẩm -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group shadow-xs">
                    <div>
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden relative">
                            <img src="{{ asset('images/quay-phim-su-kien/cat-khai-truong.png') }}" 
                                 alt="Lễ Khai Trương & Ra Mắt Sản Phẩm" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4 pt-3 space-y-2">
                            <div class="service-cat-icon shrink-0" 
                                 style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%) !important; color: #ffffff !important; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3); display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px; color: #ffffff !important; line-height: 1;">celebration</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Lễ Khai Trương &amp; Ra Mắt Sản Phẩm
                            </h3>
                            <p class="text-[11.5px] text-slate-600 leading-relaxed">
                                Tôn vinh khoảnh khắc quan trọng, thể hiện đẳng cấp thương hiệu.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn quay phim Lễ Khai Trương') }}" target="_blank"
                           class="inline-flex items-center gap-1 text-[11.5px] font-bold text-[#ff5400] hover:translate-x-1 transition-all">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Item 3: Gala Dinner & Year End Party -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group shadow-xs">
                    <div>
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden relative">
                            <img src="{{ asset('images/quay-phim-su-kien/cat-gala.png') }}" 
                                 alt="Gala Dinner & Year End Party" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4 pt-3 space-y-2">
                            <div class="service-cat-icon shrink-0" 
                                 style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%) !important; color: #ffffff !important; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3); display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px; color: #ffffff !important; line-height: 1;">nightlife</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Gala Dinner &amp; Year End Party
                            </h3>
                            <p class="text-[11.5px] text-slate-600 leading-relaxed">
                                Lưu giữ những lời tri ân, lắng đọng và những khoảnh khắc cảm xúc nhất.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn quay phim Gala Dinner') }}" target="_blank"
                           class="inline-flex items-center gap-1 text-[11.5px] font-bold text-[#ff5400] hover:translate-x-1 transition-all">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Item 4: Teambuilding & Dã Ngoại Doanh Nghiệp -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group shadow-xs">
                    <div>
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden relative">
                            <img src="{{ asset('images/quay-phim-su-kien/cat-teambuilding.png') }}" 
                                 alt="Teambuilding & Dã Ngoại Doanh Nghiệp" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4 pt-3 space-y-2">
                            <div class="service-cat-icon shrink-0" 
                                 style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%) !important; color: #ffffff !important; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3); display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px; color: #ffffff !important; line-height: 1;">groups</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Teambuilding &amp; Dã Ngoại Doanh Nghiệp
                            </h3>
                            <p class="text-[11.5px] text-slate-600 leading-relaxed">
                                Ghi lại tinh thần đoàn kết, năng lượng tích cực và những khoảnh khắc vui vẻ của tập thể.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn quay phim Teambuilding') }}" target="_blank"
                           class="inline-flex items-center gap-1 text-[11.5px] font-bold text-[#ff5400] hover:translate-x-1 transition-all">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Item 5: Sự Kiện Khác -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group shadow-xs">
                    <div>
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden relative">
                            <img src="{{ asset('images/quay-phim-su-kien/cat-su-kien-khac.png') }}" 
                                 alt="Sự Kiện Khác" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4 pt-3 space-y-2">
                            <div class="service-cat-icon shrink-0" 
                                 style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%) !important; color: #ffffff !important; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3); display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px; color: #ffffff !important; line-height: 1;">camera_indoor</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                                Sự Kiện Khác
                            </h3>
                            <p class="text-[11.5px] text-slate-600 leading-relaxed">
                                Kỷ niệm thành lập, hội chợ, triển lãm, roadshow, sự kiện thể thao...
                            </p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn quay phim các sự kiện khác') }}" target="_blank"
                           class="inline-flex items-center gap-1 text-[11.5px] font-bold text-[#ff5400] hover:translate-x-1 transition-all">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 3: VÌ SAO CHỌN CHÚNG TÔI (FULL BLEED BANNER)
         ========================================== -->
    <section class="relative w-full py-16 sm:py-20 text-white overflow-hidden border-b border-white/10"
             style="background-color: #060b14 !important;">
        
        <!-- Background Image: 2.png (Cameraman with warm golden lighting & stage) -->
        <div class="absolute inset-0 pointer-events-none select-none overflow-hidden">
            <img src="{{ asset('images/quay-phim-su-kien/2.png') }}" 
                 alt="Dịch Vụ Quay Phim Sự Kiện Chuyên Nghiệp" 
                 class="w-full h-full object-cover object-right">
            <!-- Smooth Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#060b14] via-[#060b14]/90 md:via-[#060b14]/80 lg:via-[#060b14]/45 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#060b14]/50 via-transparent to-[#060b14]/30"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <!-- Khối bọc nội dung văn bản giúp tách biệt hoàn toàn khỏi ánh sáng đèn sân khấu -->
            <div class="max-w-2xl p-6 sm:p-8 lg:p-9 rounded-2xl sm:rounded-3xl bg-[#060b14]/92 backdrop-blur-md border border-white/10 shadow-2xl shadow-black/60 space-y-6">
                
                <div>
                    <span class="badge-pill-orange">VÌ SAO CHỌN CHÚNG TÔI</span>
                </div>
                
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight">
                    Dịch Vụ Quay Phim Sự Kiện<br>
                    <span class="text-[#ff5400]">Chuyên Nghiệp</span>
                </h2>

                <p class="text-xs sm:text-sm text-white font-medium leading-relaxed max-w-xl"
                   style="color: #ffffff !important; text-shadow: 0 2px 8px rgba(0,0,0,0.95), 0 1px 3px rgba(0,0,0,0.9);">
                    Không chỉ là ghi hình, chúng tôi kể câu chuyện thương hiệu của bạn bằng những thước phim chân thực, cảm xúc và đầy sáng tạo.
                </p>

                <!-- 4 Feature Badges with Orange Squares -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                    
                    <!-- 1 -->
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-lg bg-[#ff5400] text-white flex items-center justify-center shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[18px]">videocam</span>
                        </div>
                        <h4 class="text-xs font-bold text-white">Thiết bị hiện đại</h4>
                        <p class="text-[11px] text-slate-200 leading-relaxed font-normal" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">
                            Sony FX3/FX6, Cinema Line, 4K/6K chất lượng cao
                        </p>
                    </div>

                    <!-- 2 -->
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-lg bg-[#ff5400] text-white flex items-center justify-center shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[18px]">badge</span>
                        </div>
                        <h4 class="text-xs font-bold text-white">Ê-kíp chuyên nghiệp</h4>
                        <p class="text-[11px] text-slate-200 leading-relaxed font-normal" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">
                            Kinh nghiệm, sáng tạo, tận tâm
                        </p>
                    </div>

                    <!-- 3 -->
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-lg bg-[#ff5400] text-white flex items-center justify-center shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[18px]">movie_edit</span>
                        </div>
                        <h4 class="text-xs font-bold text-white">Dựng phim sáng tạo</h4>
                        <p class="text-[11px] text-slate-200 leading-relaxed font-normal" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">
                            Hình ảnh, âm thanh, nhạc nền chuyên nghiệp
                        </p>
                    </div>

                    <!-- 4 -->
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-lg bg-[#ff5400] text-white flex items-center justify-center shadow-md shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[18px]">alarm_on</span>
                        </div>
                        <h4 class="text-xs font-bold text-white">Giao file đúng hẹn</h4>
                        <p class="text-[11px] text-slate-200 leading-relaxed font-normal" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">
                            Đảm bảo tiến độ, chất lượng cam kết
                        </p>
                    </div>

                </div>

                <div class="pt-2">
                    <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn dịch vụ quay phim sự kiện') }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="px-8 py-3.5 rounded-full bg-[#ff5400] hover:bg-[#e04a00] text-white font-bold text-sm inline-flex items-center gap-2 shadow-lg shadow-orange-500/30 transition-all">
                        <span>Tư vấn quay phim sự kiện</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 4: VIDEO HIGHLIGHT SỰ KIỆN (LIGHT 5 CARDS)
         ========================================== -->
    <section class="py-14 sm:py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header with Arrows -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <span class="badge-pill-light">DỰ ÁN TIÊU BIỂU</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mt-2">
                        Video Highlight Sự Kiện
                    </h2>
                    <p class="mt-1 text-xs sm:text-sm text-slate-600">
                        Hàng trăm sự kiện đã được chúng tôi ghi hình và tạo nên những thước phim ấn tượng.
                    </p>
                </div>

                <!-- Slider Arrows -->
                <div class="hidden sm:flex items-center gap-2">
                    <button type="button" class="w-8 h-8 rounded-full border border-slate-300 hover:border-orange-500 hover:text-orange-500 flex items-center justify-center text-slate-500 transition-colors">
                        <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                    </button>
                    <button type="button" class="w-8 h-8 rounded-full border border-slate-300 hover:border-orange-500 hover:text-orange-500 flex items-center justify-center text-slate-500 transition-colors">
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    </button>
                </div>
            </div>

            <!-- 5 Video Cards Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- Video 1: Teambuilding Sacombank Nha Trang -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer"
                     @click="openModal('nGvVhO2kDo8', 'Teambuilding Sacombank Nha Trang')">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                            <img src="https://img.youtube.com/vi/nGvVhO2kDo8/maxresdefault.jpg" 
                                 alt="Teambuilding Sacombank Nha Trang" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <!-- Bottom Left Orange Play Button -->
                            <div class="absolute bottom-2 left-2 w-7 h-7 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px] ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="p-3 space-y-1.5">
                            <h4 class="text-xs sm:text-[13px] font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1">
                                Teambuilding Sacombank Nha Trang
                            </h4>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="px-2 py-0.5 rounded bg-orange-50 text-orange-600 font-bold">Teambuilding</span>
                                <span class="text-slate-400 font-mono">02:15</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video 2: Gala Dinner Kredivo 2024 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer"
                     @click="openModal('pwPRwTicUhI', 'Gala Dinner Kredivo - Tinh Hoa Hội Tụ')">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                            <img src="https://img.youtube.com/vi/pwPRwTicUhI/maxresdefault.jpg" 
                                 alt="Gala Dinner Kredivo 2024" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-2 left-2 w-7 h-7 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px] ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="p-3 space-y-1.5">
                            <h4 class="text-xs sm:text-[13px] font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1">
                                Gala Dinner Kredivo 2024
                            </h4>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="px-2 py-0.5 rounded bg-orange-50 text-orange-600 font-bold">Gala Dinner</span>
                                <span class="text-slate-400 font-mono">03:45</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video 3: Teambuilding RAKUS Nha Trang -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer"
                     @click="openModal('T9h_Jq_nNWU', 'Teambuilding RAKUS Nha Trang')">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                            <img src="https://img.youtube.com/vi/T9h_Jq_nNWU/maxresdefault.jpg" 
                                 alt="Teambuilding RAKUS Nha Trang" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-2 left-2 w-7 h-7 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px] ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="p-3 space-y-1.5">
                            <h4 class="text-xs sm:text-[13px] font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1">
                                Teambuilding RAKUS Nha Trang
                            </h4>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="px-2 py-0.5 rounded bg-orange-50 text-orange-600 font-bold">Teambuilding</span>
                                <span class="text-slate-400 font-mono">02:50</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video 4: Teambuilding Toya Phan Thiết -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer"
                     @click="openModal('dBFbsinzwNs', 'Teambuilding Toya Vietnam - Phan Thiết')">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                            <img src="https://img.youtube.com/vi/dBFbsinzwNs/maxresdefault.jpg" 
                                 alt="Teambuilding Toya Phan Thiết" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-2 left-2 w-7 h-7 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px] ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="p-3 space-y-1.5">
                            <h4 class="text-xs sm:text-[13px] font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1">
                                Teambuilding Toya Phan Thiết
                            </h4>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="px-2 py-0.5 rounded bg-orange-50 text-orange-600 font-bold">Teambuilding</span>
                                <span class="text-slate-400 font-mono">04:10</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video 5: Gala & Teambuilding Sacombank -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer"
                     @click="openModal('nGvVhO2kDo8', 'Gala & Teambuilding Sacombank')">
                    <div>
                        <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                            <img src="https://img.youtube.com/vi/nGvVhO2kDo8/hqdefault.jpg" 
                                 alt="Gala & Teambuilding Sacombank" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-2 left-2 w-7 h-7 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px] ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="p-3 space-y-1.5">
                            <h4 class="text-xs sm:text-[13px] font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1">
                                Gala &amp; Teambuilding Sacombank
                            </h4>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="px-2 py-0.5 rounded bg-orange-50 text-orange-600 font-bold">Teambuilding</span>
                                <span class="text-slate-400 font-mono">03:30</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Button with generous spacing -->
            <div class="text-center mt-12 sm:mt-16">
                <a href="{{ route('projects.index') }}?group=media" 
                   class="inline-flex items-center gap-2.5 px-8 py-3 rounded-full border border-slate-300 hover:border-orange-500 text-slate-700 hover:text-[#ff5400] hover:bg-orange-50/50 font-bold text-xs sm:text-sm shadow-xs hover:shadow-md transition-all group">
                    <span>Xem thêm dự án</span>
                    <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 5: QUY TRÌNH QUAY PHIM SỰ KIỆN (CINEMATIC FLARE BANNER)
         ========================================== -->
    <section class="relative w-full py-16 sm:py-20 text-white overflow-hidden border-b border-white/10"
             style="background: #060b14 url('{{ asset('images/quay-phim-su-kien/1.png') }}') center center / cover no-repeat;">
        
        <!-- Dark ambient overlay to highlight text cards -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#060b14]/75 via-[#060b14]/80 to-[#060b14]/92"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            <div class="max-w-2xl mx-auto mb-10 space-y-3">
                <div>
                    <span class="badge-pill-orange"
                          style="background: rgba(6, 11, 20, 0.88) !important; border: 1.5px solid #ff5400 !important; color: #ff7a00 !important; box-shadow: 0 4px 18px rgba(0,0,0,0.7) !important;">
                        QUY TRÌNH LÀM VIỆC
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight"
                    style="text-shadow: 0 4px 16px rgba(0,0,0,0.95), 0 2px 4px rgba(0,0,0,0.9);">
                    Quy Trình Quay Phim Sự Kiện
                </h2>
                <div>
                    <span class="text-xs sm:text-sm font-semibold tracking-wide inline-flex items-center gap-2 px-4 py-1 rounded-full"
                          style="background: rgba(6, 11, 20, 0.8) !important; color: #fed7aa !important; border: 1px solid rgba(255, 84, 0, 0.35) !important; text-shadow: 0 1px 4px rgba(0,0,0,0.9);">
                        <span>Chuyên nghiệp</span>
                        <span class="text-orange-500 font-bold">&bull;</span>
                        <span>Tận tâm</span>
                        <span class="text-orange-500 font-bold">&bull;</span>
                        <span>Nhanh chóng</span>
                    </span>
                </div>
            </div>

            <!-- 4 Frosted Glass Steps Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 text-left">
                
                <!-- Step 1 -->
                <div class="rounded-2xl p-5 space-y-3 transition-all duration-300 hover:-translate-y-1 hover:border-orange-500 group"
                     style="background: rgba(8, 14, 26, 0.88) !important; backdrop-filter: blur(16px) !important; -webkit-backdrop-filter: blur(16px) !important; border: 1.5px solid rgba(255, 255, 255, 0.16) !important; box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6) !important;">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg font-black text-xs flex items-center justify-center shadow-md shrink-0"
                              style="background: linear-gradient(135deg, #ff5400 0%, #ff7a00 100%) !important; color: #ffffff !important;">
                            01
                        </span>
                        <span class="text-xs font-mono font-bold uppercase tracking-wider"
                              style="color: #ff914d !important; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">Bước 01</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-orange-400 transition-colors"
                        style="color: #ffffff !important; text-shadow: 0 1px 4px rgba(0,0,0,0.8);">
                        Tư vấn &amp; Lên ý tưởng
                    </h3>
                    <p class="text-xs leading-relaxed font-normal"
                       style="color: #e2e8f0 !important; text-shadow: 0 1px 2px rgba(0,0,0,0.6);">
                        Hiểu rõ nhu cầu, đề xuất concept phù hợp.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="rounded-2xl p-5 space-y-3 transition-all duration-300 hover:-translate-y-1 hover:border-orange-500 group"
                     style="background: rgba(8, 14, 26, 0.88) !important; backdrop-filter: blur(16px) !important; -webkit-backdrop-filter: blur(16px) !important; border: 1.5px solid rgba(255, 255, 255, 0.16) !important; box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6) !important;">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg font-black text-xs flex items-center justify-center shadow-md shrink-0"
                              style="background: linear-gradient(135deg, #ff5400 0%, #ff7a00 100%) !important; color: #ffffff !important;">
                            02
                        </span>
                        <span class="text-xs font-mono font-bold uppercase tracking-wider"
                              style="color: #ff914d !important; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">Bước 02</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-orange-400 transition-colors"
                        style="color: #ffffff !important; text-shadow: 0 1px 4px rgba(0,0,0,0.8);">
                        Khảo sát &amp; Chuẩn bị
                    </h3>
                    <p class="text-xs leading-relaxed font-normal"
                       style="color: #e2e8f0 !important; text-shadow: 0 1px 2px rgba(0,0,0,0.6);">
                        Lên kịch bản, bố trí thiết bị, nhân sự.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="rounded-2xl p-5 space-y-3 transition-all duration-300 hover:-translate-y-1 hover:border-orange-500 group"
                     style="background: rgba(8, 14, 26, 0.88) !important; backdrop-filter: blur(16px) !important; -webkit-backdrop-filter: blur(16px) !important; border: 1.5px solid rgba(255, 255, 255, 0.16) !important; box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6) !important;">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg font-black text-xs flex items-center justify-center shadow-md shrink-0"
                              style="background: linear-gradient(135deg, #ff5400 0%, #ff7a00 100%) !important; color: #ffffff !important;">
                            03
                        </span>
                        <span class="text-xs font-mono font-bold uppercase tracking-wider"
                              style="color: #ff914d !important; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">Bước 03</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-orange-400 transition-colors"
                        style="color: #ffffff !important; text-shadow: 0 1px 4px rgba(0,0,0,0.8);">
                        Thực hiện ghi hình
                    </h3>
                    <p class="text-xs leading-relaxed font-normal"
                       style="color: #e2e8f0 !important; text-shadow: 0 1px 2px rgba(0,0,0,0.6);">
                        Ghi hình chuyên nghiệp, bắt trọn khoảnh khắc.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="rounded-2xl p-5 space-y-3 transition-all duration-300 hover:-translate-y-1 hover:border-orange-500 group"
                     style="background: rgba(8, 14, 26, 0.88) !important; backdrop-filter: blur(16px) !important; -webkit-backdrop-filter: blur(16px) !important; border: 1.5px solid rgba(255, 255, 255, 0.16) !important; box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6) !important;">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg font-black text-xs flex items-center justify-center shadow-md shrink-0"
                              style="background: linear-gradient(135deg, #ff5400 0%, #ff7a00 100%) !important; color: #ffffff !important;">
                            04
                        </span>
                        <span class="text-xs font-mono font-bold uppercase tracking-wider"
                              style="color: #ff914d !important; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">Bước 04</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-orange-400 transition-colors"
                        style="color: #ffffff !important; text-shadow: 0 1px 4px rgba(0,0,0,0.8);">
                        Dựng phim &amp; Hiệu chỉnh
                    </h3>
                    <p class="text-xs leading-relaxed font-normal"
                       style="color: #e2e8f0 !important; text-shadow: 0 1px 2px rgba(0,0,0,0.6);">
                        Biên tập, thêm hiệu ứng, âm nhạc theo yêu cầu.
                    </p>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 6: BÁO GIÁ QUAY PHIM SỰ KIỆN & GÓI THAM KHẢO (LIGHT)
         ========================================== -->
    <section class="py-14 sm:py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- PART A: Showcase Báo Giá Quay Phim Sự Kiện -->
            <div class="space-y-6">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="badge-pill-light">BẢNG GIÁ THAM KHẢO</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mt-2">
                        Báo Giá Quay Phim Sự Kiện
                    </h2>
                    <p class="mt-1 text-xs sm:text-sm text-slate-600">
                        Chúng tôi đem đến cho bạn giải pháp quay phim tốt nhất cho sự kiện.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Featured Promo Card -->
                    <div class="rounded-2xl p-5 bg-gradient-to-br from-[#0c1424] to-[#060a14] text-white flex flex-col justify-between border border-slate-800 shadow-md">
                        <div class="space-y-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-orange-500/20 text-orange-400 text-[10px] font-mono font-bold uppercase">
                                GÓI CƠ BẢN
                            </span>
                            <h4 class="text-base font-bold text-white">Quay Phim Trọn Gói</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Đầy đủ máy quay 4K, micro phỏng vấn và hỗ trợ dựng teaser trong 24h.
                            </p>
                        </div>
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần nhận bảng báo giá chi tiết Quay phim sự kiện') }}" target="_blank"
                           class="btn-brand-orange mt-4 py-2 px-3 rounded-xl font-bold text-xs text-center transition-all inline-block hover:scale-105 active:scale-95"
                           style="background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%) !important; color: #ffffff !important;">
                            <span style="color: #ffffff !important; font-weight: 700;">Nhận báo giá</span>
                        </a>
                    </div>

                    <!-- Item 1 -->
                    <div class="rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group">
                        <div class="aspect-[16/10] bg-slate-900 relative">
                            <img src="https://img.youtube.com/vi/nGvVhO2kDo8/mqdefault.jpg" alt="Teambuilding Sacombank Nha Trang" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3 space-y-1">
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-1">Teambuilding Sacombank Nha Trang</h5>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="text-orange-500 font-bold">Teambuilding</span>
                                <span class="text-slate-400 font-mono">03:45</span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group">
                        <div class="aspect-[16/10] bg-slate-900 relative">
                            <img src="https://img.youtube.com/vi/T9h_Jq_nNWU/mqdefault.jpg" alt="Teambuilding RAKUS Nha Trang" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3 space-y-1">
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-1">Teambuilding RAKUS Nha Trang</h5>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="text-orange-500 font-bold">Teambuilding</span>
                                <span class="text-slate-400 font-mono">02:50</span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group">
                        <div class="aspect-[16/10] bg-slate-900 relative">
                            <img src="https://img.youtube.com/vi/dBFbsinzwNs/mqdefault.jpg" alt="Teambuilding Toya Phan Thiết" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3 space-y-1">
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-1">Teambuilding Toya Phan Thiết</h5>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="text-orange-500 font-bold">Teambuilding</span>
                                <span class="text-slate-400 font-mono">04:10</span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group">
                        <div class="aspect-[16/10] bg-slate-900 relative">
                            <img src="https://img.youtube.com/vi/pwPRwTicUhI/mqdefault.jpg" alt="Gala Dinner Kredivo 2024" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3 space-y-1">
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-1">Gala Dinner Kredivo 2024</h5>
                            <div class="flex items-center justify-between text-[10.5px]">
                                <span class="text-orange-500 font-bold">Gala Dinner</span>
                                <span class="text-slate-400 font-mono">03:30</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- PART B: 4 Bảng Giá Gói Phim Thích Hợp -->
            <div class="space-y-8 pt-6 border-t border-slate-200">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="badge-pill-light">BẢNG GIÁ THAM KHẢO</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mt-2">
                        Báo Giá Gói Phim Thích Hợp
                    </h2>
                    <p class="mt-1 text-xs sm:text-sm text-slate-600">
                        Lựa chọn gói linh hoạt, tiết kiệm chi phí.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Package 1: Gói Cơ Bản -->
                    <div class="rounded-2xl bg-white border border-slate-200 p-6 flex flex-col justify-between card-hover-effect space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#ff5400]"></span>
                                <h4 class="text-base font-extrabold text-slate-900">Gói Cơ Bản</h4>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-slate-900">5.000.000đ<span class="text-xs text-slate-500 font-normal">+</span></div>
                                <span class="text-[11px] text-slate-500">Phù hợp sự kiện nhỏ &bull; Hội thảo nội bộ</span>
                            </div>
                            <ul class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-100">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>1 Máy quay 4K/6K chuyên dụng</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Thời gian: 1 buổi (4 tiếng)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Thời lượng video: 3 - 5 phút</span>
                                </li>
                            </ul>
                        </div>
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn Gói Cơ Bản Quay phim sự kiện') }}" target="_blank"
                           class="btn-pricing-outline w-full py-2.5 px-4 rounded-xl font-bold text-xs text-center inline-flex items-center justify-center gap-1 cursor-pointer">
                            <span>Đăng ký tư vấn</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>

                    <!-- Package 2: Gói Nâng Cao (Highlighted) -->
                    <div class="rounded-2xl bg-white border-2 border-[#ff5400] p-6 flex flex-col justify-between card-hover-effect space-y-6 shadow-lg relative">
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 rounded-full bg-[#ff5400] text-white text-[10px] font-bold uppercase tracking-wider shadow">
                            Phổ Biến Nhất
                        </span>
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#ff5400]"></span>
                                <h4 class="text-base font-extrabold text-slate-900">Gói Nâng Cao</h4>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-[#ff5400]">8.000.000đ<span class="text-xs text-slate-500 font-normal">+</span></div>
                                <span class="text-[11px] text-slate-500">Lễ khai trương &bull; Gala dinner doanh nghiệp</span>
                            </div>
                            <ul class="space-y-2 text-xs text-slate-700 pt-2 border-t border-slate-100">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span class="font-bold">2 Máy quay (Góc toàn + Góc cận)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Thiết bị chống rung Gimbal RS3</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Thời lượng video: 5 - 7 phút</span>
                                </li>
                            </ul>
                        </div>
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn Gói Nâng Cao Quay phim sự kiện') }}" target="_blank"
                           class="btn-pricing-highlight w-full py-2.5 px-4 rounded-xl font-bold text-xs text-center inline-flex items-center justify-center gap-1 cursor-pointer">
                            <span>Đăng ký tư vấn</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>

                    <!-- Package 3: Gói Cao Cấp -->
                    <div class="rounded-2xl bg-white border border-slate-200 p-6 flex flex-col justify-between card-hover-effect space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#ff5400]"></span>
                                <h4 class="text-base font-extrabold text-slate-900">Gói Cao Cấp</h4>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-slate-900">14.000.000đ<span class="text-xs text-slate-500 font-normal">+</span></div>
                                <span class="text-[11px] text-slate-500">Sự kiện quy mô lớn &bull; Teambuilding bãi biển</span>
                            </div>
                            <ul class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-100">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>3 - 4 Máy quay 4K/6K chuyên nghiệp</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Flycam 4K + Thiết bị chống rung</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>1 Clip Highlight + 1 Full Clip tổng kết</span>
                                </li>
                            </ul>
                        </div>
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn Gói Cao Cấp Quay phim sự kiện') }}" target="_blank"
                           class="btn-pricing-outline w-full py-2.5 px-4 rounded-xl font-bold text-xs text-center inline-flex items-center justify-center gap-1 cursor-pointer">
                            <span>Đăng ký tư vấn</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>

                    <!-- Package 4: Gói Theo Yêu Cầu -->
                    <div class="rounded-2xl bg-white border border-slate-200 p-6 flex flex-col justify-between card-hover-effect space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#ff5400]"></span>
                                <h4 class="text-base font-extrabold text-slate-900">Gói Theo Yêu Cầu</h4>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-slate-900">Liên hệ</div>
                                <span class="text-[11px] text-slate-500">Thiết kế theo kịch bản riêng của doanh nghiệp</span>
                            </div>
                            <ul class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-100">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Đáp ứng mọi quy mô sự kiện lớn</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Kịch bản riêng, concept độc đáo</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-[#ff5400]">check</span>
                                    <span>Đội ngũ chuyên nghiệp nhất</span>
                                </li>
                            </ul>
                        </div>
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn Gói Theo Yêu Cầu Quay phim sự kiện') }}" target="_blank"
                           class="btn-pricing-outline w-full py-2.5 px-4 rounded-xl font-bold text-xs text-center inline-flex items-center justify-center gap-1 cursor-pointer">
                            <span>Liên hệ ngay</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 7: PHẢN HỒI TỪ KHÁCH HÀNG (DARK TESTIMONIALS)
         ========================================== -->
    <section class="py-14 sm:py-16 relative overflow-hidden border-b border-white/10"
             style="background-color: #060b14 !important; color: #ffffff !important;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="badge-pill-orange">KHÁCH HÀNG NÓI GÌ</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight mt-3" style="color: #ffffff !important;">
                    Phản Hồi Từ Khách Hàng
                </h2>
                <p class="mt-2 text-xs sm:text-sm" style="color: #94a3b8 !important;">
                    Sự hài lòng của khách hàng là động lực lớn nhất của chúng tôi.
                </p>
            </div>

            <!-- 3 Testimonial Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card 1 -->
                <div class="rounded-2xl p-6 space-y-4 transition-all"
                     style="background-color: #0d1629 !important; border: 1px solid rgba(255, 255, 255, 0.12) !important;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs shrink-0"
                             style="background: linear-gradient(135deg, #ff5400, #ff7a00); color: #ffffff;">
                            TT
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold" style="color: #ffffff !important;">Anh Trần Tuấn</h4>
                            <p class="text-[10.5px]" style="color: #94a3b8 !important;">Giám đốc Marketing</p>
                        </div>
                    </div>
                    <p class="text-xs leading-relaxed font-normal" style="color: #cbd5e1 !important;">
                        "Video sự kiện rất chuyên nghiệp, dựng hình thần tốc. Đội ngũ làm việc cực nhiệt tình và sáng tạo!"
                    </p>
                    <div class="flex items-center gap-1 text-xs" style="color: #ff7a00 !important;">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-2xl p-6 space-y-4 transition-all"
                     style="background-color: #0d1629 !important; border: 1px solid rgba(255, 255, 255, 0.12) !important;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs shrink-0"
                             style="background: linear-gradient(135deg, #f43f5e, #fb923c); color: #ffffff;">
                            LA
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold" style="color: #ffffff !important;">Chị Lan Anh</h4>
                            <p class="text-[10.5px]" style="color: #94a3b8 !important;">Trưởng phòng Truyền thông</p>
                        </div>
                    </div>
                    <p class="text-xs leading-relaxed font-normal" style="color: #cbd5e1 !important;">
                        "Chất lượng hình ảnh và dựng phim vượt mong đợi. Chắc chắn sẽ tiếp tục hợp tác trong các sự kiện sau."
                    </p>
                    <div class="flex items-center gap-1 text-xs" style="color: #ff7a00 !important;">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="rounded-2xl p-6 space-y-4 transition-all"
                     style="background-color: #0d1629 !important; border: 1px solid rgba(255, 255, 255, 0.12) !important;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs shrink-0"
                             style="background: linear-gradient(135deg, #3b82f6, #06b6d4); color: #ffffff;">
                            HN
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold" style="color: #ffffff !important;">Anh Hoàng Nam</h4>
                            <p class="text-[10.5px]" style="color: #94a3b8 !important;">Giám đốc Vận hành</p>
                        </div>
                    </div>
                    <p class="text-xs leading-relaxed font-normal" style="color: #cbd5e1 !important;">
                        "Từ khâu tư vấn đến hậu kỳ đều rất chuyên nghiệp. Video highlight giúp chúng tôi quảng bá sự kiện vô cùng hiệu quả."
                    </p>
                    <div class="flex items-center gap-1 text-xs" style="color: #ff7a00 !important;">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 8: KHÁM PHÁ THÊM CÁC DỰ ÁN KHÁC (4 CARDS)
         ========================================== -->
    <section class="py-14 sm:py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <span class="badge-pill-light">DỰ ÁN LIÊN QUAN</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mt-2">
                    Khám Phá Thêm Các Dự Án Khác
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-1.5 max-w-2xl">
                    Đa dạng giải pháp sản xuất video chuyên nghiệp, đáp ứng toàn diện chiến dịch truyền thông của doanh nghiệp.
                </p>
            </div>

            <!-- 4 Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- 1: Phim Giới Thiệu Doanh Nghiệp -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer shadow-sm hover:shadow-md transition-all duration-300"
                     @click="openModal('dBFbsinzwNs', 'Phim Giới Thiệu Doanh Nghiệp')">
                    <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                        <img src="{{ asset('images/media/service_3_corporate_2x.png') }}" alt="Phim Giới Thiệu Doanh Nghiệp" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-60 group-hover:opacity-30 transition-opacity"></div>
                        <!-- Play circle button -->
                        <div class="absolute top-3 left-3 w-8 h-8 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[18px] ml-0.5">play_arrow</span>
                        </div>
                        <span class="absolute bottom-2.5 right-2.5 text-[10px] font-semibold text-white/95 bg-black/60 px-2 py-0.5 rounded backdrop-blur-sm">
                            4K Ultra HD
                        </span>
                    </div>
                    <div class="p-4 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[11px] font-semibold text-[#ff5400] uppercase tracking-wider block mb-1">Corporate Video</span>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug line-clamp-1">
                                Phim Giới Thiệu Doanh Nghiệp
                            </h4>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                Khẳng định tầm vóc quy mô, quảng bá năng lực & văn hóa công ty.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 2: TVC & Video Quảng Cáo Sản Phẩm -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer shadow-sm hover:shadow-md transition-all duration-300"
                     @click="openModal('nGvVhO2kDo8', 'TVC & Video Quảng Cáo Sản Phẩm')">
                    <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                        <img src="{{ asset('images/media/service_1_tvc_2x.png') }}" alt="TVC & Video Quảng Cáo Sản Phẩm" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-60 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute top-3 left-3 w-8 h-8 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[18px] ml-0.5">play_arrow</span>
                        </div>
                        <span class="absolute bottom-2.5 right-2.5 text-[10px] font-semibold text-white/95 bg-black/60 px-2 py-0.5 rounded backdrop-blur-sm">
                            TVC Ads
                        </span>
                    </div>
                    <div class="p-4 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[11px] font-semibold text-[#ff5400] uppercase tracking-wider block mb-1">TVC Commercial</span>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug line-clamp-1">
                                TVC & Video Quảng Cáo Sản Phẩm
                            </h4>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                Kịch bản sáng tạo chuẩn điện ảnh, tôn vinh sản phẩm và kích thích mua hàng.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 3: Quay Phim Teambuilding -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer shadow-sm hover:shadow-md transition-all duration-300"
                     @click="openModal('T9h_Jq_nNWU', 'Quay Phim Teambuilding')">
                    <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                        <img src="{{ asset('images/quay-phim-su-kien/cat-teambuilding.png') }}" alt="Quay Phim Teambuilding" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-60 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute top-3 left-3 w-8 h-8 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[18px] ml-0.5">play_arrow</span>
                        </div>
                        <span class="absolute bottom-2.5 right-2.5 text-[10px] font-semibold text-white/95 bg-black/60 px-2 py-0.5 rounded backdrop-blur-sm">
                            Flycam & 4K
                        </span>
                    </div>
                    <div class="p-4 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[11px] font-semibold text-[#ff5400] uppercase tracking-wider block mb-1">Teambuilding Video</span>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug line-clamp-1">
                                Quay Phim Teambuilding
                            </h4>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                Lưu giữ tinh thần đoàn kết, năng lượng bùng nổ và những khoảnh khắc gắn kết của tập thể.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 4: Video Ngắn TikTok, Reels & Shorts -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover-effect flex flex-col justify-between group cursor-pointer shadow-sm hover:shadow-md transition-all duration-300"
                     @click="openModal('pwPRwTicUhI', 'Video Ngắn TikTok & Reels Đa Kênh')">
                    <div class="aspect-[16/10] bg-slate-900 relative overflow-hidden">
                        <img src="{{ asset('images/media/service_5_social_2x.png') }}" alt="Video Ngắn TikTok & Reels Đa Kênh" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-60 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute top-3 left-3 w-8 h-8 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[18px] ml-0.5">play_arrow</span>
                        </div>
                        <span class="absolute bottom-2.5 right-2.5 text-[10px] font-semibold text-white/95 bg-black/60 px-2 py-0.5 rounded backdrop-blur-sm">
                            Short-form 9:16
                        </span>
                    </div>
                    <div class="p-4 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[11px] font-semibold text-[#ff5400] uppercase tracking-wider block mb-1">Short-Form Media</span>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug line-clamp-1">
                                Video Ngắn TikTok & Reels Đa Kênh
                            </h4>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                Đón đầu xu hướng, tối ưu giữ chân người xem và gia tăng tương tác tự nhiên.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 9: GIẢI ĐÁP THẮC MẮC (FAQ SPLIT LAYOUT)
         ========================================== -->
    <section class="py-14 sm:py-16 bg-white border-b border-slate-200" x-data="{ activeFaq: 1 }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <span class="badge-pill-light">CÂU HỎI THƯỜNG GẶP</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mt-2">
                    Giải Đáp Thắc Mắc Khi Thuê Dịch Vụ Quay Phim Sự Kiện
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left 8 cols: Accordions -->
                <div class="lg:col-span-8 space-y-3">
                    
                    <!-- FAQ 1 -->
                    <div class="rounded-xl border border-slate-200 overflow-hidden bg-white">
                        <button type="button" 
                                @click="activeFaq = (activeFaq === 1 ? 0 : 1)"
                                class="w-full p-4 text-left flex items-center justify-between font-bold text-xs sm:text-sm text-slate-900 hover:text-[#ff5400] transition-colors">
                            <span>Chi phí quay phim sự kiện được tính như thế nào?</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform" :class="activeFaq === 1 ? 'rotate-180 text-orange-500' : ''">keyboard_arrow_down</span>
                        </button>
                        <div x-show="activeFaq === 1" x-collapse>
                            <div class="p-4 pt-0 text-xs text-slate-600 leading-relaxed border-t border-slate-100">
                                Chi phí phụ thuộc vào thời lượng sự kiện, số lượng máy quay (1 máy hay multi-cam), thiết bị đi kèm (Flycam, gimbal, mic thu âm wireless) và yêu cầu dựng video (Highlight recap ngắn hay phim tổng kết chi tiết). Truyền Thông Cửu Long luôn tư vấn phương án tối ưu nhất theo ngân sách của bạn.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="rounded-xl border border-slate-200 overflow-hidden bg-white">
                        <button type="button" 
                                @click="activeFaq = (activeFaq === 2 ? 0 : 2)"
                                class="w-full p-4 text-left flex items-center justify-between font-bold text-xs sm:text-sm text-slate-900 hover:text-[#ff5400] transition-colors">
                            <span>Thời gian giao sản phẩm là bao lâu?</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform" :class="activeFaq === 2 ? 'rotate-180 text-orange-500' : ''">keyboard_arrow_down</span>
                        </button>
                        <div x-show="activeFaq === 2" x-collapse>
                            <div class="p-4 pt-0 text-xs text-slate-600 leading-relaxed border-t border-slate-100">
                                Chúng tôi hỗ trợ giao bản Teaser Highlight 60 giây trong vòng 24 giờ để doanh nghiệp kịp truyền thông nóng. Video bản chính thức hoàn thiện chỉnh màu và âm thanh sẽ được bàn giao sau 3 - 5 ngày làm việc.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="rounded-xl border border-slate-200 overflow-hidden bg-white">
                        <button type="button" 
                                @click="activeFaq = (activeFaq === 3 ? 0 : 3)"
                                class="w-full p-4 text-left flex items-center justify-between font-bold text-xs sm:text-sm text-slate-900 hover:text-[#ff5400] transition-colors">
                            <span>Tôi có được chỉnh sửa video sau khi nhận không?</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform" :class="activeFaq === 3 ? 'rotate-180 text-orange-500' : ''">keyboard_arrow_down</span>
                        </button>
                        <div x-show="activeFaq === 3" x-collapse>
                            <div class="p-4 pt-0 text-xs text-slate-600 leading-relaxed border-t border-slate-100">
                                Khách hàng được hỗ trợ chỉnh sửa miễn phí tối đa 2 lần đối với các chi tiết như nhịp cắt, chèn thêm logo, tiêu đề, nhạc nền hoặc hình ảnh bổ sung theo biên bản nghiệm thu.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="rounded-xl border border-slate-200 overflow-hidden bg-white">
                        <button type="button" 
                                @click="activeFaq = (activeFaq === 4 ? 0 : 4)"
                                class="w-full p-4 text-left flex items-center justify-between font-bold text-xs sm:text-sm text-slate-900 hover:text-[#ff5400] transition-colors">
                            <span>Đơn vị có hỗ trợ quay phim tại các địa điểm xa không?</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform" :class="activeFaq === 4 ? 'rotate-180 text-orange-500' : ''">keyboard_arrow_down</span>
                        </button>
                        <div x-show="activeFaq === 4" x-collapse>
                            <div class="p-4 pt-0 text-xs text-slate-600 leading-relaxed border-t border-slate-100">
                                Ekip Truyền Thông Cửu Long nhận triển khai sự kiện trên toàn quốc, đặc biệt là TP. Cần Thơ và 13 tỉnh thành Đồng Bằng Sông Cửu Long (Phú Quốc, Kiên Giang, An Giang, Cà Mau, Bến Tre...).
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right 4 cols: Help Box / Callout -->
                <div class="lg:col-span-4 rounded-2xl p-6 sm:p-7 space-y-4"
                     style="background: linear-gradient(145deg, #fffaf5 0%, #ffede0 100%) !important; border: 1.5px solid #ffd8c2 !important; box-shadow: 0 10px 25px -5px rgba(255, 84, 0, 0.08) !important;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-md"
                         style="background: linear-gradient(135deg, #ff5400 0%, #ff7a00 100%) !important; color: #ffffff !important;">
                        <span class="material-symbols-outlined text-[24px]" style="color: #ffffff !important;">support_agent</span>
                    </div>
                    <div class="space-y-1.5">
                        <h4 class="text-base font-bold" style="color: #0f172a !important;">Bạn vẫn còn câu hỏi khác?</h4>
                        <p class="text-xs sm:text-[13px] leading-relaxed" style="color: #475569 !important;">
                            Hãy để lại thông tin, đội ngũ của chúng tôi sẽ liên hệ và tư vấn giải pháp phù hợp nhất cho sự kiện của bạn.
                        </p>
                    </div>
                    <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn thêm về dịch vụ quay phim sự kiện') }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="btn-brand-orange w-full py-3.5 px-5 rounded-xl font-bold text-sm inline-flex items-center justify-center gap-2 transition-all duration-300 group cursor-pointer hover:scale-[1.02] active:scale-95"
                       style="background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%) !important; color: #ffffff !important; box-shadow: 0 8px 22px rgba(255, 84, 0, 0.42) !important;">
                        <span style="color: #ffffff !important; font-weight: 700;">Liên hệ ngay</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform" style="color: #ffffff !important;">arrow_forward</span>
                    </a>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 10: BANNER CTA CHỐT HẠ (ORANGE GRADIENT)
         ========================================== -->
    <section class="w-full py-12 lg:py-16 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #ea580c 0%, #ff5400 45%, #ff7a00 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Left 7 cols: Content -->
                <div class="lg:col-span-7 space-y-3">
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight">
                        Sẵn Sàng Bứt Phá Doanh Số<br>
                        Cùng Sức Mạnh Media &amp; Công Nghệ?
                    </h2>
                    <p class="text-xs sm:text-sm text-orange-100 font-normal leading-relaxed" style="max-width: 520px;">
                        Liên hệ ngay với Truyền Thông Cửu Long để nhận tư vấn kịch bản chi tiết và báo giá ưu đãi độc quyền dành riêng cho doanh nghiệp của bạn.
                    </p>
                    <div class="pt-2 flex flex-wrap items-center gap-4 text-xs font-mono text-white/90">
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            Báo giá sau 15 phút
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            Đầy đủ hợp đồng &amp; VAT
                        </span>
                    </div>
                </div>

                <!-- Right 5 cols: Fast Contact Box -->
                <div class="lg:col-span-5 bg-white/10 backdrop-blur-md border border-white/25 rounded-2xl p-5 sm:p-6 space-y-4">
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider text-center">ĐĂNG KÝ TƯ VẤN NHANH</h4>
                    <form action="{{ route('contact.submit') ?? '#' }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="text" name="name" placeholder="Họ và tên của bạn" required
                               class="w-full px-4 py-2.5 rounded-xl bg-white/90 text-slate-800 text-xs placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-orange-300">
                        <input type="tel" name="phone" placeholder="Số điện thoại / Zalo" required
                               class="w-full px-4 py-2.5 rounded-xl bg-white/90 text-slate-800 text-xs placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-orange-300">
                        <button type="submit" 
                                class="w-full py-2.5 rounded-xl bg-slate-950 hover:bg-black text-white font-black text-xs uppercase tracking-wider transition-all shadow-lg">
                            Gửi yêu cầu ngay
                        </button>
                    </form>
                    <div class="text-center pt-1 text-[11px] text-white/80">
                        <span>Hoặc gọi trực tiếp: </span>
                        <a href="tel:0939363262" class="font-extrabold text-white underline hover:text-amber-200">0939.363.262</a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         VIDEO LIGHTBOX MODAL (POPUP 4K STREAMING)
         ========================================== -->
    <div x-show="videoModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6 bg-black/90 backdrop-blur-md"
         style="display: none;">
        
        <div class="relative w-full max-w-4xl bg-slate-950 rounded-2xl overflow-hidden border border-white/20 shadow-2xl"
             @click.away="closeModal()">
            
            <div class="flex items-center justify-between px-4 py-3 bg-slate-900 border-b border-white/10 text-white">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600 animate-pulse"></span>
                    <span class="text-xs sm:text-sm font-bold text-white truncate max-w-md" x-text="modalVideoTitle"></span>
                </div>
                <button type="button" @click="closeModal()" 
                        class="p-1 rounded-lg hover:bg-white/10 text-slate-400 hover:text-white transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <div class="aspect-[16/9] w-full bg-black">
                <iframe :src="modalVideoUrl" 
                        class="w-full h-full" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                </iframe>
            </div>

            <div class="p-3 bg-slate-950 flex items-center justify-between text-xs text-slate-400 border-t border-white/5">
                <span>Truyền Thông Cửu Long &bull; Sản Xuất Video Sự Kiện 4K</span>
                <button type="button" @click="closeModal()" class="text-orange-400 hover:underline font-bold">
                    Đóng cửa sổ
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
