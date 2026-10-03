@extends('layouts.app')

@section('title', 'Thiết Kế UI/UX Theo Yêu Cầu • Chuẩn Bản Quyền & Tối Ưu Chuyển Đổi | Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ thiết kế UI/UX chuyên nghiệp theo yêu cầu. Từ Wireframe đến Prototype tương tác Figma. Giao diện độc bản, chuẩn trải nghiệm người dùng Việt, tối ưu tỷ lệ chuyển đổi CRO.')

@section('content')
<div class="w-full bg-white text-slate-800 antialiased overflow-hidden" style="font-family: var(--font-primary, system-ui, -apple-system, sans-serif);">

    <!-- ==========================================
         1. HERO SECTION: THIẾT KẾ UI/UX THEO YÊU CẦU
         ========================================== -->
    <section class="relative overflow-hidden pt-24 sm:pt-28 pb-12 sm:pb-16"
             style="background: radial-gradient(circle at 85% 20%, rgba(255, 84, 0, 0.16) 0%, rgba(255, 122, 41, 0.08) 35%, transparent 65%), radial-gradient(circle at 10% 45%, rgba(255, 153, 0, 0.12) 0%, transparent 50%), linear-gradient(180deg, #fff4ec 0%, #fffaf6 45%, #ffffff 100%);">
        
        <!-- Tech Dot Grid Matrix Background -->
        <div class="absolute inset-0 pointer-events-none opacity-40" 
             style="background-image: radial-gradient(rgba(255, 84, 0, 0.14) 1.2px, transparent 1.2px); background-size: 24px 24px;"></div>

        <!-- Ambient Orange Light Orbs -->
        <div class="absolute -top-12 -right-12 w-[600px] h-[600px] rounded-full bg-gradient-to-br from-[#ff5400]/22 via-[#ff7a29]/12 to-transparent blur-[100px] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-[420px] h-[420px] rounded-full bg-gradient-to-tr from-amber-400/20 via-orange-400/12 to-transparent blur-[90px] pointer-events-none"></div>

        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 xl:gap-16 items-center">
                
                <!-- Left: Headline, Value Propositions & CTA Buttons -->
                <div class="lg:col-span-6 xl:col-span-6 space-y-5 sm:space-y-6">
                    
                    <!-- Pill Tag -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-500/10 border border-orange-300/80 text-[#ff5400] text-xs sm:text-sm font-bold tracking-wide font-mono uppercase shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-[#ff5400] animate-pulse"></span>
                        <span>Dịch vụ Thiết Kế UI/UX</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-3xl sm:text-4xl lg:text-[42px] xl:text-[50px] font-black text-[#0c192e] tracking-tight leading-[1.15]">
                        <span class="block">Thiết Kế UI/UX Theo Yêu Cầu</span>
                        <span class="block text-xl sm:text-2xl lg:text-[28px] xl:text-[32px] font-bold text-slate-700 mt-2 leading-snug">
                            Không Chỉ Đẹp, Mà Phải <span class="text-[#ff5400]" style="background: linear-gradient(135deg, #ff5400 0%, #ff7a29 50%, #e64a00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Chạm Vào Cảm Xúc &amp; Tối Ưu Chuyển Đổi</span>
                        </span>
                    </h1>

                    <!-- Subtitle Paragraph -->
                    <p class="text-sm sm:text-base text-slate-600 max-w-xl leading-relaxed font-normal">
                        Từ bản vẽ Wireframe đến Prototype tương tác thực tế trên Figma. Chúng tôi thiết kế giao diện độc bản, chuẩn UX hành vi người dùng Việt và sẵn sàng lập trình 100%.
                    </p>

                    <!-- 3 Core Trust Badges -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <!-- Badge 1 -->
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/90 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)]">
                            <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center shrink-0 border border-orange-200/80 text-[#ff5400]">
                                <span class="material-symbols-outlined text-[20px]">verified</span>
                            </div>
                            <div>
                                <span class="block text-xs font-black text-slate-900 leading-tight">100%</span>
                                <span class="block text-[11px] text-slate-500 font-medium leading-tight">Thiết kế độc quyền</span>
                            </div>
                        </div>

                        <!-- Badge 2 -->
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/90 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)]">
                            <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center shrink-0 border border-orange-200/80 text-[#ff5400]">
                                <span class="material-symbols-outlined text-[20px]">layers</span>
                            </div>
                            <div>
                                <span class="block text-xs font-black text-slate-900 leading-tight">Bàn giao chuẩn</span>
                                <span class="block text-[11px] text-slate-500 font-medium leading-tight">Figma Auto-layout</span>
                            </div>
                        </div>

                        <!-- Badge 3 -->
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/90 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)]">
                            <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center shrink-0 border border-orange-200/80 text-[#ff5400]">
                                <span class="material-symbols-outlined text-[20px]">devices</span>
                            </div>
                            <div>
                                <span class="block text-xs font-black text-slate-900 leading-tight">Tương thích</span>
                                <span class="block text-[11px] text-slate-500 font-medium leading-tight">Đa thiết bị (Responsive)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-2 flex flex-wrap items-center gap-3.5">
                        <a href="#quy-trinh" 
                           class="inline-flex items-center justify-center gap-2.5 px-6 sm:px-7 py-3 sm:py-3.5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ff7a29] text-white text-xs sm:text-sm font-bold tracking-wide shadow-[0_8px_24px_-4px_rgba(255,84,0,0.38)] hover:shadow-[0_12px_32px_-4px_rgba(255,84,0,0.5)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                            <span>Tư vấn &amp; Xem Bản Mẫu Figma</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>

                        <a href="#bang-gia" 
                           class="inline-flex items-center justify-center gap-2 px-6 sm:px-7 py-3 sm:py-3.5 rounded-full bg-white/95 border-2 border-orange-300/80 text-slate-800 hover:text-[#ff5400] hover:border-[#ff5400] text-xs sm:text-sm font-bold tracking-wide shadow-xs hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                            <span>Nhận Báo Giá Thiết Kế</span>
                        </a>
                    </div>

                </div>

                <!-- Right: High-End Hero Mockup Canvas -->
                <div class="lg:col-span-6 xl:col-span-6 relative">
                    <!-- General Ambient Warm Glow behind entire canvas -->
                    <div class="absolute -inset-6 bg-gradient-to-tr from-amber-400/30 via-orange-500/20 to-yellow-300/25 rounded-full blur-3xl pointer-events-none"></div>

                    <!-- Custom Visual Container: Supports User Image with Graceful Dynamic Fallback -->
                        @if(file_exists(public_path('images/uiux/hero-uiux.png')))
                            <div class="relative w-full h-full select-none overflow-visible group">
                                
                                <!-- ================= GOLDEN BACKLIGHT & 3D LUMINOUS ORBITAL RING (Như Hình 2) ================= -->
                                <!-- 1. Intense Golden Glow directly behind the Laptop screen and body -->
                                <div class="absolute top-[42%] left-[64%] -translate-x-1/2 -translate-y-1/2 w-[85%] sm:w-[95%] h-[80%] sm:h-[90%] pointer-events-none z-0 rounded-full animate-golden-breathe"
                                     style="background: radial-gradient(ellipse at center, rgba(254, 215, 64, 0.75) 0%, rgba(251, 191, 36, 0.55) 28%, rgba(245, 158, 11, 0.32) 52%, rgba(234, 88, 12, 0.1) 72%, transparent 88%); filter: blur(42px);">
                                </div>

                                <!-- 2. Concentrated Golden Core Backlight (High Luminescence behind Laptop) -->
                                <div class="absolute top-[36%] right-[8%] w-[68%] h-[68%] pointer-events-none z-0 rounded-full"
                                     style="background: radial-gradient(circle at 55% 45%, rgba(254, 240, 138, 0.75) 0%, rgba(251, 191, 36, 0.5) 35%, rgba(245, 158, 11, 0.22) 65%, transparent 82%); filter: blur(30px);">
                                </div>

                                <!-- 3. 3D Golden Luminous Orbital Light Ring (Vòng hào quang ánh sáng vàng 3D cong lượn như hình 2) -->
                                <div class="absolute inset-0 pointer-events-none z-0 flex items-center justify-center -translate-y-2 sm:-translate-y-4">
                                    <svg class="w-[118%] h-[118%] overflow-visible filter drop-shadow-[0_0_22px_rgba(251,191,36,0.9)] drop-shadow-[0_0_45px_rgba(245,158,11,0.55)]" 
                                         viewBox="0 0 820 540" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Outer soft diffuse glow arc -->
                                        <ellipse cx="445" cy="265" rx="370" ry="200" transform="rotate(-13 445 265)" 
                                                 stroke="url(#goldenHaloGlow)" stroke-width="14" opacity="0.65" filter="url(#goldGlowFilter)"/>
                                        
                                        <!-- Middle intense golden neon body -->
                                        <ellipse cx="445" cy="265" rx="370" ry="200" transform="rotate(-13 445 265)" 
                                                 stroke="url(#goldenHaloMid)" stroke-width="4.8" opacity="0.95" filter="blur(1.8px)"/>
                                        
                                        <!-- Crisp luminous bright golden-white core line -->
                                        <ellipse cx="445" cy="265" rx="370" ry="200" transform="rotate(-13 445 265)" 
                                                 stroke="url(#goldenHaloCore)" stroke-width="2.4" opacity="1"/>

                                        <!-- Inner secondary dashed accent orbit -->
                                        <ellipse cx="465" cy="275" rx="275" ry="145" transform="rotate(-16 465 275)" 
                                                 stroke="url(#goldenInnerArc)" stroke-width="1.8" stroke-dasharray="9 15" opacity="0.6"/>

                                        <defs>
                                            <filter id="goldGlowFilter" x="-20%" y="-20%" width="140%" height="140%">
                                                <feGaussianBlur stdDeviation="12"/>
                                            </filter>

                                            <!-- Core Gradient: Brilliant Yellow-White to Amber -->
                                            <linearGradient id="goldenHaloCore" x1="80" y1="80" x2="800" y2="450" gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#fbbf24" stop-opacity="0.95"/>
                                                <stop offset="18%" stop-color="#fffbeb" stop-opacity="1"/>
                                                <stop offset="32%" stop-color="#fef08a" stop-opacity="1"/>
                                                <stop offset="65%" stop-color="#f59e0b" stop-opacity="0.95"/>
                                                <stop offset="88%" stop-color="#ea580c" stop-opacity="0.6"/>
                                                <stop offset="100%" stop-color="#fbbf24" stop-opacity="0.1"/>
                                            </linearGradient>

                                            <!-- Middle Gradient: Vibrant Gold to Orange -->
                                            <linearGradient id="goldenHaloMid" x1="100" y1="100" x2="780" y2="430" gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#f59e0b" stop-opacity="0.8"/>
                                                <stop offset="28%" stop-color="#fde047" stop-opacity="1"/>
                                                <stop offset="68%" stop-color="#f97316" stop-opacity="0.85"/>
                                                <stop offset="100%" stop-color="#ea580c" stop-opacity="0.25"/>
                                            </linearGradient>

                                            <!-- Outer Wide Glow Gradient -->
                                            <linearGradient id="goldenHaloGlow" x1="50" y1="50" x2="820" y2="500" gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#fbbf24" stop-opacity="0.6"/>
                                                <stop offset="30%" stop-color="#fef08a" stop-opacity="0.95"/>
                                                <stop offset="65%" stop-color="#f59e0b" stop-opacity="0.75"/>
                                                <stop offset="100%" stop-color="#ea580c" stop-opacity="0"/>
                                            </linearGradient>

                                            <!-- Inner Dotted Arc Gradient -->
                                            <linearGradient id="goldenInnerArc" x1="180" y1="150" x2="740" y2="390" gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#fde047" stop-opacity="0.95"/>
                                                <stop offset="50%" stop-color="#f59e0b" stop-opacity="0.7"/>
                                                <stop offset="100%" stop-color="#fbbf24" stop-opacity="0.1"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>

                                <!-- The Hero UI/UX Image (Foreground relative z-10) -->
                                <img src="{{ asset('images/uiux/hero-uiux.png') }}?v={{ time() }}" 
                                     alt="Thiết kế UI/UX theo yêu cầu - Truyền Thông Cửu Long" 
                                     class="w-full h-auto object-cover block select-none pointer-events-none relative z-10">

                                <!-- ================= REAL-TIME ANIMATED FIGMA MULTIPLAYER CURSORS ================= -->
                                <!-- 1. Hoàng Design (Orange) -->
                                <div class="figma-cursor figma-cursor-hoang absolute z-20 pointer-events-none will-change-transform">
                                    <div class="relative flex items-start">
                                        <svg class="w-4 sm:w-5 h-4 sm:h-5 drop-shadow-md shrink-0" viewBox="0 0 24 24" fill="none">
                                            <path d="M5.5 3.5L18 13.5L12 14.5L9 21L5.5 3.5Z" fill="#ff5400" stroke="#ffffff" stroke-width="1.8" stroke-linejoin="round"/>
                                        </svg>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] sm:text-[11px] font-extrabold text-white shadow-lg whitespace-nowrap -ml-0.5 mt-2.5 sm:mt-3" 
                                              style="background: linear-gradient(135deg, #ff5400 0%, #ff7a29 100%); box-shadow: 0 4px 12px rgba(255,84,0,0.4);">
                                            Hoàng Design
                                        </span>
                                        <span class="figma-ripple figma-ripple-hoang absolute top-1 left-1 w-6 h-6 rounded-full bg-[#ff5400] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></span>
                                    </div>
                                </div>

                                <!-- 2. Cửu Long Lead (Blue) -->
                                <div class="figma-cursor figma-cursor-cuulong absolute z-20 pointer-events-none will-change-transform">
                                    <div class="relative flex items-start">
                                        <svg class="w-4 sm:w-5 h-4 sm:h-5 drop-shadow-md shrink-0" viewBox="0 0 24 24" fill="none">
                                            <path d="M5.5 3.5L18 13.5L12 14.5L9 21L5.5 3.5Z" fill="#0284c7" stroke="#ffffff" stroke-width="1.8" stroke-linejoin="round"/>
                                        </svg>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] sm:text-[11px] font-extrabold text-white shadow-lg whitespace-nowrap -ml-0.5 mt-2.5 sm:mt-3" 
                                              style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); box-shadow: 0 4px 12px rgba(2,132,199,0.4);">
                                            Cửu Long Lead
                                        </span>
                                        <span class="figma-ripple figma-ripple-cuulong absolute top-1 left-1 w-6 h-6 rounded-full bg-[#0284c7] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></span>
                                    </div>
                                </div>

                                <!-- 3. Mai UI/UX (Purple / Pink) -->
                                <div class="figma-cursor figma-cursor-mai absolute z-20 pointer-events-none will-change-transform">
                                    <div class="relative flex items-start">
                                        <svg class="w-4 sm:w-5 h-4 sm:h-5 drop-shadow-md shrink-0" viewBox="0 0 24 24" fill="none">
                                            <path d="M5.5 3.5L18 13.5L12 14.5L9 21L5.5 3.5Z" fill="#d946ef" stroke="#ffffff" stroke-width="1.8" stroke-linejoin="round"/>
                                        </svg>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] sm:text-[11px] font-extrabold text-white shadow-lg whitespace-nowrap -ml-0.5 mt-2.5 sm:mt-3" 
                                              style="background: linear-gradient(135deg, #d946ef 0%, #ec4899 100%); box-shadow: 0 4px 12px rgba(217,70,239,0.4);">
                                            Mai UI/UX
                                        </span>
                                        <span class="figma-ripple figma-ripple-mai absolute top-1 left-1 w-6 h-6 rounded-full bg-[#d946ef] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></span>
                                    </div>
                                </div>
                            </div>

                            <style>
                                /* ================= GOLDEN BACKLIGHT & PULSE ================= */
                                @keyframes goldenBreathe {
                                    0%, 100% {
                                        transform: translate(-50%, -50%) scale(1);
                                        opacity: 0.85;
                                    }
                                    50% {
                                        transform: translate(-50%, -50%) scale(1.08);
                                        opacity: 1;
                                    }
                                }
                                .animate-golden-breathe {
                                    animation: goldenBreathe 6s ease-in-out infinite;
                                }

                                /* ================= FIGMA MULTIPLAYER CURSOR ANIMATIONS ================= */
                                .figma-cursor {
                                    position: absolute;
                                    z-index: 30;
                                    pointer-events: none;
                                    will-change: top, left, transform;
                                }

                                /* 1. Hoàng Design Path (11s) */
                                .figma-cursor-hoang {
                                    animation: figmaMoveHoang 11s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
                                }
                                @keyframes figmaMoveHoang {
                                    0% {
                                        top: 14%;
                                        left: 51%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    12% {
                                        top: 26%;
                                        left: 44%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    15% {
                                        top: 26%;
                                        left: 44%;
                                        transform: translate(0, 0) scale(0.9);
                                    }
                                    18% {
                                        top: 26%;
                                        left: 44%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    32% {
                                        top: 48%;
                                        left: 38%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    48% {
                                        top: 58%;
                                        left: 48%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    51% {
                                        top: 58%;
                                        left: 48%;
                                        transform: translate(0, 0) scale(0.9);
                                    }
                                    54% {
                                        top: 58%;
                                        left: 48%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    70% {
                                        top: 36%;
                                        left: 56%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    85% {
                                        top: 20%;
                                        left: 48%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    100% {
                                        top: 14%;
                                        left: 51%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                }
                                .figma-ripple-hoang {
                                    animation: figmaRippleHoang 11s cubic-bezier(0.2, 0.8, 0.2, 1) infinite;
                                }
                                @keyframes figmaRippleHoang {
                                    0%, 14%, 22%, 50%, 58%, 100% {
                                        transform: translate(-50%, -50%) scale(0.6);
                                        opacity: 0;
                                    }
                                    15%, 51% {
                                        transform: translate(-50%, -50%) scale(1);
                                        opacity: 0.8;
                                    }
                                    20%, 56% {
                                        transform: translate(-50%, -50%) scale(2.6);
                                        opacity: 0;
                                    }
                                }

                                /* 2. Cửu Long Lead Path (13s) */
                                .figma-cursor-cuulong {
                                    animation: figmaMoveCuuLong 13s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
                                }
                                @keyframes figmaMoveCuuLong {
                                    0% {
                                        top: 16%;
                                        left: 76%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    14% {
                                        top: 25%;
                                        left: 68%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    17% {
                                        top: 25%;
                                        left: 68%;
                                        transform: translate(0, 0) scale(0.9);
                                    }
                                    20% {
                                        top: 25%;
                                        left: 68%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    38% {
                                        top: 38%;
                                        left: 74%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    55% {
                                        top: 48%;
                                        left: 62%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    58% {
                                        top: 48%;
                                        left: 62%;
                                        transform: translate(0, 0) scale(0.9);
                                    }
                                    61% {
                                        top: 48%;
                                        left: 62%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    78% {
                                        top: 28%;
                                        left: 78%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    90% {
                                        top: 20%;
                                        left: 74%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    100% {
                                        top: 16%;
                                        left: 76%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                }
                                .figma-ripple-cuulong {
                                    animation: figmaRippleCuuLong 13s cubic-bezier(0.2, 0.8, 0.2, 1) infinite;
                                }
                                @keyframes figmaRippleCuuLong {
                                    0%, 16%, 24%, 57%, 65%, 100% {
                                        transform: translate(-50%, -50%) scale(0.6);
                                        opacity: 0;
                                    }
                                    17%, 58% {
                                        transform: translate(-50%, -50%) scale(1);
                                        opacity: 0.8;
                                    }
                                    22%, 63% {
                                        transform: translate(-50%, -50%) scale(2.6);
                                        opacity: 0;
                                    }
                                }

                                /* 3. Mai UI/UX Path (12s) */
                                .figma-cursor-mai {
                                    animation: figmaMoveMai 12s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
                                }
                                @keyframes figmaMoveMai {
                                    0% {
                                        top: 36%;
                                        left: 85%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    15% {
                                        top: 46%;
                                        left: 72%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    18% {
                                        top: 46%;
                                        left: 72%;
                                        transform: translate(0, 0) scale(0.9);
                                    }
                                    21% {
                                        top: 46%;
                                        left: 72%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    40% {
                                        top: 30%;
                                        left: 58%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    56% {
                                        top: 22%;
                                        left: 64%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    59% {
                                        top: 22%;
                                        left: 64%;
                                        transform: translate(0, 0) scale(0.9);
                                    }
                                    62% {
                                        top: 22%;
                                        left: 64%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    78% {
                                        top: 40%;
                                        left: 80%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                    100% {
                                        top: 36%;
                                        left: 85%;
                                        transform: translate(0, 0) scale(1);
                                    }
                                }
                                .figma-ripple-mai {
                                    animation: figmaRippleMai 12s cubic-bezier(0.2, 0.8, 0.2, 1) infinite;
                                }
                                @keyframes figmaRippleMai {
                                    0%, 17%, 25%, 58%, 66%, 100% {
                                        transform: translate(-50%, -50%) scale(0.6);
                                        opacity: 0;
                                    }
                                    18%, 59% {
                                        transform: translate(-50%, -50%) scale(1);
                                        opacity: 0.8;
                                    }
                                    23%, 64% {
                                        transform: translate(-50%, -50%) scale(2.6);
                                        opacity: 0;
                                    }
                                }
                            </style>
                        @else
                            <!-- Placeholder Mockup Container (Designed Exactly as shown in prompt image) -->
                            <div class="relative w-full aspect-[16/10] bg-gradient-to-br from-[#1e293b] via-[#0f172a] to-[#020617] p-4 sm:p-6 flex items-center justify-center overflow-hidden">
                                
                                <!-- Floating Figma Toolbar Simulator -->
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 z-20 flex flex-col gap-2 p-2 rounded-2xl bg-slate-900/90 border border-slate-700/80 shadow-2xl backdrop-blur-xl">
                                    <div class="w-8 h-8 rounded-lg bg-orange-500/20 text-[#ff5400] flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[18px]">near_me</span>
                                    </div>
                                    <div class="w-8 h-8 rounded-lg text-slate-400 hover:text-white flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[18px]">crop_square</span>
                                    </div>
                                    <div class="w-8 h-8 rounded-lg text-slate-400 hover:text-white flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </div>
                                    <div class="w-8 h-8 rounded-lg text-slate-400 hover:text-white flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[18px]">title</span>
                                    </div>
                                    <div class="w-8 h-8 rounded-lg text-slate-400 hover:text-white flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[18px]">chat_bubble</span>
                                    </div>
                                </div>

                                <!-- Collaborative Multiplayer Cursors -->
                                <div class="absolute top-8 left-1/4 z-30 flex items-center gap-1 animate-bounce" style="animation-duration: 3s;">
                                    <span class="material-symbols-outlined text-amber-400 text-[20px] -rotate-45 drop-shadow">near_me</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold text-slate-950 bg-amber-400 shadow-md">Hoàng Design</span>
                                </div>
                                <div class="absolute top-12 right-1/4 z-30 flex items-center gap-1 animate-bounce" style="animation-duration: 3.8s;">
                                    <span class="material-symbols-outlined text-sky-400 text-[20px] -rotate-45 drop-shadow">near_me</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold text-white bg-sky-500 shadow-md">Cửu Long Lead</span>
                                </div>
                                <div class="absolute bottom-16 right-12 z-30 flex items-center gap-1 animate-bounce" style="animation-duration: 4.2s;">
                                    <span class="material-symbols-outlined text-pink-400 text-[20px] -rotate-45 drop-shadow">near_me</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold text-white bg-pink-500 shadow-md">Mai UI/UX</span>
                                </div>

                                <!-- Simulated Laptop & Artboards Preview -->
                                <div class="w-full max-w-[90%] rounded-2xl bg-slate-900 border border-slate-700/80 p-4 shadow-2xl space-y-3">
                                    <!-- Laptop Window Header -->
                                    <div class="flex items-center justify-between border-b border-slate-800 pb-2">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-red-500/80"></span>
                                            <span class="w-2.5 h-2.5 rounded-full bg-yellow-500/80"></span>
                                            <span class="w-2.5 h-2.5 rounded-full bg-green-500/80"></span>
                                            <span class="text-[10px] text-slate-400 font-mono ml-2">CuuLong_UIUX_Project.fig</span>
                                        </div>
                                        <span class="px-2 py-0.5 rounded text-[9px] font-mono font-bold bg-orange-500/20 text-[#ff5400]">Dev Mode • Ready</span>
                                    </div>
                                    <!-- Multi Artboards Grid -->
                                    <div class="grid grid-cols-12 gap-2 items-center">
                                        <div class="col-span-4 rounded-xl bg-slate-800/80 border border-slate-700 p-2.5 space-y-2">
                                            <div class="h-2 w-16 bg-slate-600 rounded"></div>
                                            <div class="h-10 rounded-lg bg-slate-700/60 flex items-center justify-center">
                                                <span class="text-[10px] text-slate-400 font-mono">Analytics Chart</span>
                                            </div>
                                            <div class="grid grid-cols-2 gap-1.5">
                                                <div class="h-6 rounded bg-orange-500/20"></div>
                                                <div class="h-6 rounded bg-slate-700"></div>
                                            </div>
                                        </div>
                                        <div class="col-span-4 rounded-xl bg-white p-2.5 space-y-2 shadow-lg">
                                            <div class="flex justify-between items-center">
                                                <div class="h-2 w-12 bg-orange-500 rounded"></div>
                                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                            </div>
                                            <div class="h-14 rounded-lg bg-orange-50 border border-orange-200 p-1.5 flex flex-col justify-between">
                                                <span class="text-[9px] font-bold text-orange-950">Mobile App Screen</span>
                                                <div class="h-4 rounded bg-[#ff5400] text-[8px] text-white flex items-center justify-center font-bold">Checkout</div>
                                            </div>
                                        </div>
                                        <div class="col-span-4 rounded-xl bg-slate-800/80 border border-slate-700 p-2.5 space-y-2">
                                            <div class="h-2 w-14 bg-slate-600 rounded"></div>
                                            <div class="h-10 rounded-lg bg-slate-700/60 flex items-center justify-center">
                                                <span class="text-[10px] text-slate-400 font-mono">Design Tokens</span>
                                            </div>
                                            <div class="h-6 rounded bg-sky-500/20"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Floating 3D Figma Logo Badge -->
                                <div class="absolute bottom-4 right-4 z-30 p-2 rounded-2xl bg-white/95 border border-slate-200 shadow-xl flex items-center gap-2">
                                    <svg class="w-6 h-6" viewBox="0 0 38 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 28.5C19 23.2533 23.2533 19 28.5 19C33.7467 19 38 23.2533 38 28.5C38 33.7467 33.7467 38 28.5 38C23.2533 38 19 33.7467 19 28.5Z" fill="#1ABCFE"/>
                                        <path d="M0 47.5C0 42.2533 4.25329 38 9.5 38H19V47.5C19 52.7467 14.7467 57 9.5 57C4.25329 57 0 52.7467 0 47.5Z" fill="#0ACF83"/>
                                        <path d="M19 0V19H28.5C33.7467 19 38 14.7467 38 9.5C38 4.25329 33.7467 0 28.5 0H19Z" fill="#FF7262"/>
                                        <path d="M0 9.5C0 14.7467 4.25329 19 9.5 19H19V0H9.5C4.25329 0 0 4.25329 0 9.5Z" fill="#F24E1E"/>
                                        <path d="M0 28.5C0 33.7467 4.25329 38 9.5 38H19V19H9.5C4.25329 19 0 23.2533 0 28.5Z" fill="#A259FF"/>
                                    </svg>
                                    <span class="text-xs font-bold text-slate-800 font-mono">Figma Auto-Layout</span>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         2. VẤN ĐỀ & GIẢI PHÁP (PROBLEM & SOLUTION)
         ========================================== -->
    <section id="van-de-giai-phap" class="py-14 sm:py-20 bg-slate-50/70 relative border-t border-slate-100"
             style="background-image: radial-gradient(rgba(12, 25, 46, 0.035) 1px, transparent 1px); background-size: 24px 24px;">
        
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16">
            
            <!-- Top Header: Căn giữa sang trọng, giải phóng 100% diện tích bên dưới cho 2 hình ảnh điện thoại -->
            <div class="max-w-3xl mx-auto text-center space-y-3.5 mb-12 sm:mb-16">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold text-[#ff5400] bg-orange-500/10 border border-orange-500/20 font-mono tracking-wider uppercase">
                    VẤN ĐỀ &amp; GIẢI PHÁP
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-[#0c192e] tracking-tight leading-tight">
                    Giao Diện Không Chỉ Đẹp <span class="text-[#ff5400]">Mà Phải Hiệu Quả</span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Một giao diện tốt không chỉ là thẩm mỹ bắt mắt, mà còn phải thấu hiểu hành vi người dùng, tối ưu tỷ lệ chuyển đổi và mang lại giá trị kinh doanh đo lường được.
                </p>
                <div class="pt-2">
                    <a href="#quy-trinh" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full border border-orange-300 text-[#ff5400] hover:bg-orange-50 hover:shadow-md text-xs sm:text-sm font-bold transition-all">
                        <span>Tìm hiểu quy trình thiết kế chuẩn UX</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Comparison Dual Cards: Chiếm toàn bộ 12 cột (Mỗi thẻ rộng ~800px) giúp 2 ảnh hiển thị cực to, rõ nét từng chi tiết -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 relative items-stretch">
                
                <!-- Floating VS Badge between Cards -->
                <div class="hidden lg:flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 w-16 h-16 rounded-full bg-gradient-to-br from-[#ff5400] via-[#ff7a29] to-[#ea580c] text-white font-black text-base items-center justify-center shadow-2xl border-4 border-white pointer-events-none">
                    VS
                </div>

                <!-- Card 1: Giao diện đại trà / Kém UX (Red / Negative) -->
                <div class="rounded-3xl p-6 sm:p-8 bg-white border border-rose-200 shadow-[0_12px_36px_-6px_rgba(244,63,94,0.1)] flex flex-col justify-between space-y-6 group hover:shadow-2xl transition-all duration-300">
                    <div>
                        <!-- Card Header -->
                        <div class="flex items-center justify-between border-b border-rose-100 pb-4 mb-5">
                            <div class="flex items-center gap-3">
                                <span class="w-9 h-9 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-black text-base shadow-sm">✕</span>
                                <div>
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900">Giao diện đại trà / Kém UX</h3>
                                    <p class="text-xs text-rose-500 font-medium">Bố cục rối, tỷ lệ thoát trang cao</p>
                                </div>
                            </div>
                            <span class="hidden sm:inline-flex px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-600 border border-rose-200">
                                Thực trạng phổ biến
                            </span>
                        </div>

                        <!-- 4 Pain Points Grid 2x2 gọn gàng -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-2">
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 bg-rose-50/60 p-3 rounded-2xl border border-rose-100">
                                <span class="material-symbols-outlined text-rose-500 text-[20px] shrink-0 mt-0.5">cancel</span>
                                <span class="font-medium">Rối mắt, khó phân biệt vùng bấm</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 bg-rose-50/60 p-3 rounded-2xl border border-rose-100">
                                <span class="material-symbols-outlined text-rose-500 text-[20px] shrink-0 mt-0.5">cancel</span>
                                <span class="font-medium">Người dùng không biết bấm vào đâu</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 bg-rose-50/60 p-3 rounded-2xl border border-rose-100">
                                <span class="material-symbols-outlined text-rose-500 text-[20px] shrink-0 mt-0.5">cancel</span>
                                <span class="font-medium">Tỷ lệ thoát trang (Bounce rate) cao</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 bg-rose-50/60 p-3 rounded-2xl border border-rose-100">
                                <span class="material-symbols-outlined text-rose-500 text-[20px] shrink-0 mt-0.5">cancel</span>
                                <span class="font-medium">Lập trình viên mất nhiều thời gian fix</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Phone Mockup Frame (Bad UX): Chiều cao lớn 580px - 620px để hiển thị to rõ từng chú thích -->
                    <div class="w-full h-[520px] sm:h-[580px] lg:h-[620px] rounded-2xl bg-gradient-to-b from-slate-100/90 via-slate-50 to-slate-200/70 border border-slate-200/90 overflow-hidden flex items-center justify-center p-4 sm:p-6 relative group/img">
                        @if(file_exists(public_path('images/uiux/phone-bad-ux.png')))
                            <img src="{{ asset('images/uiux/phone-bad-ux.png') }}?v={{ time() }}" 
                                 alt="Giao diện đại trà kém UX" 
                                 class="h-full w-auto max-w-full object-contain filter drop-shadow-[0_12px_24px_rgba(0,0,0,0.15)] transform group-hover/img:scale-[1.03] transition-transform duration-300">
                        @else
                            <div class="w-44 h-72 rounded-2xl bg-slate-200/90 border border-slate-300 p-3 space-y-2 opacity-70">
                                <div class="h-3 bg-slate-400 rounded w-20"></div>
                                <div class="h-16 bg-slate-300 rounded"></div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card 2: Giải pháp của Cửu Long (Green & Orange / Positive) -->
                <div class="rounded-3xl p-6 sm:p-8 bg-white border-2 border-emerald-400 shadow-[0_16px_40px_-6px_rgba(16,185,129,0.18)] flex flex-col justify-between space-y-6 group hover:shadow-2xl transition-all duration-300">
                    <div>
                        <!-- Card Header -->
                        <div class="flex items-center justify-between border-b border-emerald-100 pb-4 mb-5">
                            <div class="flex items-center gap-3">
                                <span class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-base shadow-sm">✓</span>
                                <div>
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900">
                                        Giải pháp của <span class="text-[#ff5400]">Cửu Long</span>
                                    </h3>
                                    <p class="text-xs text-emerald-600 font-medium">Chuẩn Design System &amp; Tối ưu chuyển đổi</p>
                                </div>
                            </div>
                            <span class="hidden sm:inline-flex px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Chuẩn UX Quốc Tế
                            </span>
                        </div>

                        <!-- 4 Highlights Grid 2x2 -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-2">
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-800 bg-emerald-50/70 p-3 rounded-2xl border border-emerald-100 font-medium">
                                <span class="material-symbols-outlined text-emerald-600 text-[20px] shrink-0 mt-0.5">check_circle</span>
                                <span>Nghiên cứu hành vi (UX Research)</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-800 bg-emerald-50/70 p-3 rounded-2xl border border-emerald-100 font-medium">
                                <span class="material-symbols-outlined text-emerald-600 text-[20px] shrink-0 mt-0.5">check_circle</span>
                                <span>Hệ thống thiết kế (Design System)</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-800 bg-emerald-50/70 p-3 rounded-2xl border border-emerald-100 font-medium">
                                <span class="material-symbols-outlined text-emerald-600 text-[20px] shrink-0 mt-0.5">check_circle</span>
                                <span>Tối ưu tỷ lệ chuyển đổi (CRO)</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-800 bg-emerald-50/70 p-3 rounded-2xl border border-emerald-100 font-medium">
                                <span class="material-symbols-outlined text-emerald-600 text-[20px] shrink-0 mt-0.5">check_circle</span>
                                <span>Trải nghiệm mượt mà đa thiết bị</span>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Mockup Frame (Good UX): Chiều cao lớn 580px - 620px để hiển thị to rõ từng chi tiết -->
                    <div class="w-full h-[520px] sm:h-[580px] lg:h-[620px] rounded-2xl bg-gradient-to-br from-orange-50/90 via-amber-50/50 to-emerald-50/40 border border-orange-200/90 overflow-hidden flex items-center justify-center p-4 sm:p-6 relative group/img">
                        @if(file_exists(public_path('images/uiux/phone-good-ux.png')))
                            <img src="{{ asset('images/uiux/phone-good-ux.png') }}?v={{ time() }}" 
                                 alt="Giải pháp thiết kế UI/UX Cửu Long" 
                                 class="h-full w-auto max-w-full object-contain filter drop-shadow-[0_14px_28px_rgba(255,84,0,0.18)] transform group-hover/img:scale-[1.03] transition-transform duration-300">
                        @else
                            <div class="w-44 h-72 rounded-2xl bg-white border border-orange-200 shadow-md p-3 space-y-2">
                                <div class="h-3 bg-[#ff5400] rounded w-20"></div>
                                <div class="h-16 bg-orange-100 rounded-lg"></div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         3. CÁC GÓI DỊCH VỤ THIẾT KẾ UI/UX (5 CARDS)
         ========================================== -->
    <section class="py-16 sm:py-20 bg-white relative">
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16">
            
            <!-- Section Header -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-10 sm:mb-12">
                <div>
                    <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">DỊCH VỤ CỦA CHÚNG TÔI</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0c192e] tracking-tight mt-1">
                        Các Gói Dịch Vụ Thiết Kế UI/UX
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 max-w-lg leading-relaxed">
                    Từ website đến mobile app, từ tối ưu giao diện đến xây dựng hệ thống thiết kế, chúng tôi có giải pháp phù hợp với mọi nhu cầu của doanh nghiệp.
                </p>
            </div>

            <!-- 5 Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5"
                 style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 20px;">
                
                <!-- Card 1: UI/UX Web App & Dashboard -->
                <div class="group rounded-3xl p-5 bg-white border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:border-orange-300 hover:shadow-[0_12px_32px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-full aspect-[3/2] rounded-2xl bg-slate-100 overflow-hidden mb-4 relative">
                            @if(file_exists(public_path('images/uiux/service-webapp.png')))
                                <img src="{{ asset('images/uiux/service-webapp.png') }}?v={{ time() }}" alt="UI/UX Web App & Dashboard quản trị" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-950 p-3 flex flex-col justify-between">
                                    <div class="h-2 w-12 bg-orange-400 rounded"></div>
                                    <div class="h-8 rounded bg-slate-700/60 flex items-center justify-center text-[10px] text-slate-300 font-mono">Analytics Chart</div>
                                    <div class="h-2 w-16 bg-slate-600 rounded"></div>
                                </div>
                            @endif
                            <div class="absolute top-2.5 left-2.5 w-7 h-7 rounded-lg bg-orange-500 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px]">dashboard</span>
                            </div>
                        </div>

                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                            UI/UX Web App &amp; Dashboard quản trị
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed font-normal">
                            Hệ thống SaaS, CRM, ERP, Dashboard phân tích số liệu phức tạp với biểu đồ trực quan, thao tác nhanh.
                        </p>
                    </div>

                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] pt-4 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Card 2: Thiết kế Mobile App -->
                <div class="group rounded-3xl p-5 bg-white border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:border-orange-300 hover:shadow-[0_12px_32px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-full aspect-[3/2] rounded-2xl bg-slate-100 overflow-hidden mb-4 relative">
                            @if(file_exists(public_path('images/uiux/service-mobile.png')))
                                <img src="{{ asset('images/uiux/service-mobile.png') }}?v={{ time() }}" alt="Thiết kế Mobile App" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-amber-50 to-orange-100 p-3 flex items-center justify-center gap-1.5">
                                    <div class="w-10 h-16 rounded-md bg-white border border-orange-200 shadow-xs"></div>
                                    <div class="w-11 h-18 rounded-md bg-white border border-orange-300 shadow-md"></div>
                                    <div class="w-10 h-16 rounded-md bg-white border border-orange-200 shadow-xs"></div>
                                </div>
                            @endif
                            <div class="absolute top-2.5 left-2.5 w-7 h-7 rounded-lg bg-orange-500 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px]">smartphone</span>
                            </div>
                        </div>

                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                            Thiết kế Mobile App (iOS / Android)
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed font-normal">
                            Tuân thủ Apple Human Interface Guidelines và Google Material Design 3.
                        </p>
                    </div>

                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] pt-4 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Card 3: Landing Page Doanh Nghiệp -->
                <div class="group rounded-3xl p-5 bg-white border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:border-orange-300 hover:shadow-[0_12px_32px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-full aspect-[3/2] rounded-2xl bg-slate-100 overflow-hidden mb-4 relative">
                            @if(file_exists(public_path('images/uiux/service-landing.png')))
                                <img src="{{ asset('images/uiux/service-landing.png') }}?v={{ time() }}" alt="Landing Page Doanh Nghiệp & Bán Hàng" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-900 to-indigo-950 p-3 flex flex-col justify-between">
                                    <div class="h-2 w-14 bg-sky-400 rounded"></div>
                                    <div class="h-7 rounded bg-blue-500/20 border border-blue-400/40"></div>
                                    <div class="h-2 w-10 bg-slate-400 rounded"></div>
                                </div>
                            @endif
                            <div class="absolute top-2.5 left-2.5 w-7 h-7 rounded-lg bg-orange-500 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px]">web</span>
                            </div>
                        </div>

                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                            Landing Page Doanh Nghiệp &amp; Bán Hàng
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed font-normal">
                            Tập trung tối đa vào hiệu ứng thị giác và phễu chuyển đổi khách hàng tiềm năng.
                        </p>
                    </div>

                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] pt-4 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Card 4: UX Audit & Redesign -->
                <div class="group rounded-3xl p-5 bg-white border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:border-orange-300 hover:shadow-[0_12px_32px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-full aspect-[3/2] rounded-2xl bg-slate-100 overflow-hidden mb-4 relative">
                            @if(file_exists(public_path('images/uiux/service-audit.png')))
                                <img src="{{ asset('images/uiux/service-audit.png') }}?v={{ time() }}" alt="UX Audit & Redesign" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 p-3 flex flex-col justify-between items-center text-center">
                                    <span class="material-symbols-outlined text-slate-600 text-[28px] mt-1">analytics</span>
                                    <span class="text-[10px] font-mono font-bold text-slate-700">Audit &amp; Optimization</span>
                                    <div class="h-1.5 w-16 bg-orange-500 rounded"></div>
                                </div>
                            @endif
                            <div class="absolute top-2.5 left-2.5 w-7 h-7 rounded-lg bg-orange-500 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px]">sync</span>
                            </div>
                        </div>

                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                            UX Audit &amp; Redesign <span class="text-xs font-normal text-slate-500 block">(Tái cấu trúc giao diện cũ)</span>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed font-normal">
                            Phân tích lỗi trải nghiệm hiện tại và đưa ra bản cải tiến đột phá.
                        </p>
                    </div>

                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] pt-4 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Card 5: Xây dựng Design System & UI Kit -->
                <div class="group rounded-3xl p-5 bg-white border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:border-orange-300 hover:shadow-[0_12px_32px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-full aspect-[3/2] rounded-2xl bg-slate-100 overflow-hidden mb-4 relative">
                            @if(file_exists(public_path('images/uiux/service-design-system.png')))
                                <img src="{{ asset('images/uiux/service-design-system.png') }}?v={{ time() }}" alt="Xây dựng Design System & UI Kit" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-900 to-indigo-950 p-3 grid grid-cols-2 gap-1.5">
                                    <div class="rounded bg-slate-800 p-1 border border-slate-700"></div>
                                    <div class="rounded bg-orange-500/20 p-1 border border-orange-500/40"></div>
                                    <div class="rounded bg-sky-500/20 p-1 border border-sky-500/40"></div>
                                    <div class="rounded bg-slate-800 p-1 border border-slate-700"></div>
                                </div>
                            @endif
                            <div class="absolute top-2.5 left-2.5 w-7 h-7 rounded-lg bg-orange-500 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[16px]">widgets</span>
                            </div>
                        </div>

                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">
                            Xây dựng Design System &amp; UI Kit
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed font-normal">
                            Bàn giao đầy đủ Component, Variants, Design Tokens giúp team dev code nhanh gấp 3 lần.
                        </p>
                    </div>

                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] pt-4 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         4. QUY TRÌNH THIẾT KẾ: DESIGN THINKING (5 BƯỚC)
         ========================================== -->
    <section id="quy-trinh" class="py-16 sm:py-24 text-white relative overflow-hidden" style="background-color: #0c192e;">
        
        <!-- Ambient Glowing Orbs on Dark -->
        <div class="absolute -top-24 left-1/4 w-96 h-96 rounded-full bg-orange-500/10 blur-[120px] pointer-events-none"></div>
        <div class="absolute -bottom-24 right-1/4 w-96 h-96 rounded-full bg-sky-500/10 blur-[120px] pointer-events-none"></div>

        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16 relative z-10">
            
            <!-- Section Header -->
            <div class="max-w-3xl mb-12 sm:mb-16">
                <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">QUY TRÌNH THIẾT KẾ</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight mt-1">
                    Design Thinking — 5 Bước Minh Bạch
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                    Chúng tôi áp dụng quy trình Design Thinking để đảm bảo mọi sản phẩm đều bắt đầu từ nhu cầu thực tế và mang lại giá trị bền vững.
                </p>
            </div>

            <!-- 5 Steps Connected Grid -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 lg:gap-8 relative"
                 style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px;">
                
                <!-- Connector Line on Desktop -->
                <div class="hidden md:block absolute top-7 left-12 right-12 h-0.5 bg-gradient-to-r from-orange-500 via-amber-400 to-orange-500/40 z-0"></div>

                <!-- Step 1 -->
                <div class="relative z-10 space-y-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#ff5400] to-[#ff7a29] text-white flex items-center justify-center shadow-[0_0_24px_rgba(255,84,0,0.5)] border-2 border-[#0c192e]">
                        <span class="material-symbols-outlined text-[24px]">search</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-white">Khảo sát &amp; Định hình mục tiêu</h3>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed font-normal">
                            Phỏng vấn nghiệp vụ, vẽ hành trình người dùng (User Journey Map).
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 space-y-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#ff5400] to-[#ff7a29] text-white flex items-center justify-center shadow-[0_0_24px_rgba(255,84,0,0.5)] border-2 border-[#0c192e]">
                        <span class="material-symbols-outlined text-[24px]">grid_view</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-white">Xây dựng Wireframe (Khung xương)</h3>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed font-normal">
                            Bố trí luồng thông tin, cấu trúc trang trước khi đổ màu.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 space-y-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#ff5400] to-[#ff7a29] text-white flex items-center justify-center shadow-[0_0_24px_rgba(255,84,0,0.5)] border-2 border-[#0c192e]">
                        <span class="material-symbols-outlined text-[24px]">palette</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-white">Moodboard &amp; Visual Design (Hi-Fi)</h3>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed font-normal">
                            Lên phong cách màu sắc, typography, đồ họa chi tiết trên Figma.
                        </p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10 space-y-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#ff5400] to-[#ff7a29] text-white flex items-center justify-center shadow-[0_0_24px_rgba(255,84,0,0.5)] border-2 border-[#0c192e]">
                        <span class="material-symbols-outlined text-[24px]">play_circle</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-white">Interactive Prototype (Bản mẫu chạy thử)</h3>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed font-normal">
                            Khách hàng được click, vuốt chạm trải nghiệm như app thật.
                        </p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="relative z-10 space-y-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#ff5400] to-[#ff7a29] text-white flex items-center justify-center shadow-[0_0_24px_rgba(255,84,0,0.5)] border-2 border-[#0c192e]">
                        <span class="material-symbols-outlined text-[24px]">code</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-white">Bàn giao Dev-Ready (Figma Dev Mode)</h3>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed font-normal">
                            Xuất asset, gắn đo đạc thông số, đồng hành cùng team lập trình.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         5. CÔNG CỤ & TIÊU CHUẨN KỸ THUẬT
         ========================================== -->
    <section class="py-14 sm:py-18 bg-white relative border-b border-slate-100"
             style="background-image: radial-gradient(rgba(12, 25, 46, 0.03) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Left Title -->
                <div class="lg:col-span-5 space-y-2">
                    <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">CÔNG CỤ &amp; TIÊU CHUẨN</span>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-black text-[#0c192e] tracking-tight">
                        Công Cụ &amp; Tiêu Chuẩn Kỹ Thuật
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md">
                        Chúng tôi sử dụng các công cụ chuyên nghiệp và tuân thủ các tiêu chuẩn quốc tế để đảm bảo chất lượng, hiệu suất và khả năng tiếp cận tốt nhất.
                    </p>
                </div>

                <!-- Right 5 Tools Row -->
                <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-5 gap-3.5 sm:gap-3"
                     style="display: grid; grid-template-columns: repeat(auto-fit, minmax(110px, 1fr)); gap: 12px;">
                    
                    <!-- 1. Figma -->
                    <div class="flex flex-col items-center text-center p-3.5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-orange-300 hover:shadow-md transition-all">
                        <div class="w-10 h-10 flex items-center justify-center mb-2">
                            <svg class="w-7 h-7" viewBox="0 0 38 57" fill="none">
                                <path d="M19 28.5C19 23.2533 23.2533 19 28.5 19C33.7467 19 38 23.2533 38 28.5C38 33.7467 33.7467 38 28.5 38C23.2533 38 19 33.7467 19 28.5Z" fill="#1ABCFE"/>
                                <path d="M0 47.5C0 42.2533 4.25329 38 9.5 38H19V47.5C19 52.7467 14.7467 57 9.5 57C4.25329 57 0 52.7467 0 47.5Z" fill="#0ACF83"/>
                                <path d="M19 0V19H28.5C33.7467 19 38 14.7467 38 9.5C38 4.25329 33.7467 0 28.5 0H19Z" fill="#FF7262"/>
                                <path d="M0 9.5C0 14.7467 4.25329 19 9.5 19H19V0H9.5C4.25329 0 0 4.25329 0 9.5Z" fill="#F24E1E"/>
                                <path d="M0 28.5C0 33.7467 4.25329 38 9.5 38H19V19H9.5C4.25329 19 0 23.2533 0 28.5Z" fill="#A259FF"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Figma</span>
                        <span class="text-[10px] text-slate-400 mt-0.5">Thiết kế &amp; cộng tác</span>
                    </div>

                    <!-- 2. FigJam -->
                    <div class="flex flex-col items-center text-center p-3.5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-purple-300 hover:shadow-md transition-all">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center mb-2 text-purple-600">
                            <span class="material-symbols-outlined text-[24px]">draw</span>
                        </div>
                        <span class="text-xs font-bold text-slate-800">FigJam</span>
                        <span class="text-[10px] text-slate-400 mt-0.5">Phác thảo &amp; Brainstorm</span>
                    </div>

                    <!-- 3. Adobe Ai / Ps -->
                    <div class="flex flex-col items-center text-center p-3.5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-blue-300 hover:shadow-md transition-all">
                        <div class="w-10 h-10 flex items-center justify-center gap-1 mb-2">
                            <span class="w-5 h-5 rounded bg-[#330000] text-[#ff9a00] font-black text-[9px] flex items-center justify-center border border-[#ff9a00]/40">Ai</span>
                            <span class="w-5 h-5 rounded bg-[#001e36] text-[#31a8ff] font-black text-[9px] flex items-center justify-center border border-[#31a8ff]/40">Ps</span>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Adobe Ai / Ps</span>
                        <span class="text-[10px] text-slate-400 mt-0.5">Xử lý vector &amp; hình ảnh</span>
                    </div>

                    <!-- 4. WCAG 2.1 -->
                    <div class="flex flex-col items-center text-center p-3.5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-300 hover:shadow-md transition-all">
                        <div class="w-10 h-10 flex items-center justify-center mb-2">
                            <span class="px-1.5 py-0.5 rounded bg-sky-600 text-white font-black text-[9px] font-mono">WCAG 2.1</span>
                        </div>
                        <span class="text-xs font-bold text-slate-800">WCAG 2.1</span>
                        <span class="text-[10px] text-slate-400 mt-0.5">Tiêu chuẩn tiếp cận</span>
                    </div>

                    <!-- 5. Auto-Layout -->
                    <div class="flex flex-col items-center text-center p-3.5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-amber-300 hover:shadow-md transition-all col-span-2 sm:col-span-1">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center mb-2 text-[#ff5400]">
                            <span class="material-symbols-outlined text-[24px]">layers</span>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Auto-Layout</span>
                        <span class="text-[10px] text-slate-400 mt-0.5">Bàn giao lập trình</span>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         6. BẢNG GIÁ THAM KHẢO (3 GÓI LINH HOẠT)
         ========================================== -->
    <section id="bang-gia" class="py-16 sm:py-24 bg-white relative">
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left Title & Description -->
                <div class="lg:col-span-4 space-y-3">
                    <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">BẢNG GIÁ THAM KHẢO</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0c192e] tracking-tight leading-tight">
                        Linh Hoạt Theo Nhu Cầu<br>Doanh Nghiệp
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Chúng tôi cung cấp các gói dịch vụ linh hoạt, minh bạch và tối ưu chi phí cho từng giai đoạn phát triển của doanh nghiệp.
                    </p>
                </div>

                <!-- Right 3 Pricing Cards -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-5">
                    
                    <!-- Gói 1: Khởi Điểm -->
                    <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:border-orange-300 hover:shadow-lg transition-all duration-300 flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-base font-bold text-slate-900">Gói Khởi Điểm</h3>
                                <span class="text-xs text-slate-400">Landing Page UI/UX</span>
                            </div>
                            <div class="pt-2">
                                <span class="text-xs text-slate-500 font-medium">Từ</span>
                                <div class="text-2xl font-black text-[#ff5400] leading-none mt-1">8.000.000đ</div>
                            </div>
                            <ul class="space-y-2.5 pt-3 border-t border-slate-100">
                                <li class="flex items-center gap-2 text-xs text-slate-600">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>1-3 màn hình giao diện</span>
                                </li>
                                <li class="flex items-center gap-2 text-xs text-slate-600">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>Bản thiết kế Figma</span>
                                </li>
                                <li class="flex items-center gap-2 text-xs text-slate-600">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>Hỗ trợ chỉnh sửa 2 lần</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('contact') }}" class="w-full py-3 rounded-full bg-slate-100 hover:bg-orange-50 text-slate-800 hover:text-[#ff5400] font-bold text-xs text-center transition-all">
                            Đăng ký tư vấn →
                        </a>
                    </div>

                    <!-- Gói 2: Chuyên Nghiệp (Phổ Biến) -->
                    <div class="rounded-3xl p-6 bg-white border-2 border-[#ff5400] shadow-[0_12px_36px_-4px_rgba(255,84,0,0.22)] relative flex flex-col justify-between space-y-6">
                        <!-- Popular Ribbon Tag -->
                        <div class="absolute -top-3 right-6 px-3 py-0.5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ff7a29] text-white font-bold text-[10px] uppercase tracking-wider shadow-sm">
                            Phổ biến
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-base font-bold text-slate-900">Gói Chuyên Nghiệp</h3>
                                <span class="text-xs text-slate-400">Full Web / E-Commerce</span>
                            </div>
                            <div class="pt-2">
                                <span class="text-xs text-slate-500 font-medium">Từ</span>
                                <div class="text-2xl font-black text-[#ff5400] leading-none mt-1">18.000.000đ</div>
                            </div>
                            <ul class="space-y-2.5 pt-3 border-t border-slate-100">
                                <li class="flex items-center gap-2 text-xs text-slate-700 font-medium">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>10-20 màn hình giao diện</span>
                                </li>
                                <li class="flex items-center gap-2 text-xs text-slate-700 font-medium">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>Design System cơ bản</span>
                                </li>
                                <li class="flex items-center gap-2 text-xs text-slate-700 font-medium">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>Prototype tương tác</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('contact') }}" class="w-full py-3 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ff7a29] text-white hover:shadow-md font-bold text-xs text-center transition-all">
                            Đăng ký tư vấn →
                        </a>
                    </div>

                    <!-- Gói 3: Nâng Cao -->
                    <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:border-orange-300 hover:shadow-lg transition-all duration-300 flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-base font-bold text-slate-900">Gói Nâng Cao</h3>
                                <span class="text-xs text-slate-400">Web App / Mobile App phức tạp</span>
                            </div>
                            <div class="pt-2">
                                <span class="text-xs text-slate-500 font-medium">Từ</span>
                                <div class="text-2xl font-black text-[#ff5400] leading-none mt-1">35.000.000đ</div>
                            </div>
                            <ul class="space-y-2.5 pt-3 border-t border-slate-100">
                                <li class="flex items-center gap-2 text-xs text-slate-600">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>20+ màn hình giao diện</span>
                                </li>
                                <li class="flex items-center gap-2 text-xs text-slate-600">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>Full Prototype &amp; Design System</span>
                                </li>
                                <li class="flex items-center gap-2 text-xs text-slate-600">
                                    <span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span>
                                    <span>Hỗ trợ lập trình (tùy chọn)</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('contact') }}" class="w-full py-3 rounded-full bg-slate-100 hover:bg-orange-50 text-slate-800 hover:text-[#ff5400] font-bold text-xs text-center transition-all">
                            Đăng ký tư vấn →
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         7. FOOTER CALL-TO-ACTION BANNER
         ========================================== -->
    <section class="py-10 sm:py-14 bg-white">
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16">
            
            <div class="relative w-full rounded-3xl overflow-hidden shadow-2xl shadow-orange-500/20 p-8 sm:p-12 lg:p-14 flex flex-col md:flex-row md:items-center justify-between gap-6"
                 style="background: linear-gradient(135deg, #ff5400 0%, #ff7a29 50%, #e64a00 100%);">
                
                <!-- Ambient decorative elements -->
                <div class="absolute -right-10 -bottom-10 w-80 h-80 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                <div class="absolute right-1/4 top-0 w-60 h-60 rounded-full bg-amber-300/20 blur-xl pointer-events-none"></div>

                <!-- Text Left -->
                <div class="relative z-10 space-y-2 max-w-2xl text-white">
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight leading-tight">
                        Sẵn Sàng Biến Ý Tưởng Của Bạn Thành Sản Phẩm Thực Tế?
                    </h2>
                    <p class="text-xs sm:text-sm text-orange-100 font-normal leading-relaxed">
                        Hãy để Truyền Thông Cửu Long đồng hành cùng bạn trong hành trình xây dựng trải nghiệm số đỉnh cao.
                    </p>
                </div>

                <!-- CTA Button Right -->
                <div class="relative z-10 shrink-0">
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-full bg-white text-slate-900 hover:text-[#ff5400] font-bold text-xs sm:text-sm shadow-xl hover:shadow-2xl hover:scale-105 active:scale-100 transition-all duration-300">
                        <span>Liên hệ ngay</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection
