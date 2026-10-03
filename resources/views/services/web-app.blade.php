@extends('layouts.app')

@section('title', 'Thiết Kế & Lập Trình Web - App Chuyên Nghiệp | Truyền Thông Cửu Long')
@section('meta_description', 'Chúng tôi mang đến giải pháp thiết kế website, lập trình ứng dụng di động và hệ thống phần mềm hiện đại, tối ưu trải nghiệm người dùng, giúp doanh nghiệp chuyển đổi số và phát triển bền vững.')

@section('content')
<div class="w-full bg-white text-slate-800 antialiased overflow-hidden" style="font-family: var(--font-primary, system-ui, -apple-system, sans-serif);">

    <!-- ==================== 1. HERO SECTION ==================== -->
    <section class="relative overflow-hidden"
             style="padding-top: 86px; padding-bottom: 12px; background: radial-gradient(circle at 85% 25%, rgba(255, 84, 0, 0.18) 0%, rgba(255, 122, 41, 0.08) 40%, transparent 70%), radial-gradient(circle at 10% 45%, rgba(255, 153, 0, 0.14) 0%, transparent 50%), linear-gradient(180deg, #fff3ea 0%, #fffbf8 50%, #fafbfc 100%);">
        
        <!-- Subtle Orange Tech Dot Grid Matrix -->
        <div class="absolute inset-0 pointer-events-none opacity-40" 
             style="background-image: radial-gradient(rgba(255, 84, 0, 0.14) 1.2px, transparent 1.2px); background-size: 24px 24px;"></div>

        <!-- Decorative 3D Ambient Orange Light Orbs & Glowing Shadows -->
        <div class="absolute -top-10 -right-10 w-[550px] h-[550px] rounded-full bg-gradient-to-br from-[#ff5400]/25 via-[#ff7a29]/15 to-transparent blur-[90px] pointer-events-none"></div>
        <div class="absolute top-1/3 right-1/4 w-[400px] h-[400px] rounded-full bg-gradient-to-tr from-amber-400/25 via-orange-400/18 to-transparent blur-[80px] pointer-events-none"></div>
        <div class="absolute top-16 -left-16 w-[420px] h-[420px] rounded-full bg-gradient-to-tr from-orange-400/18 via-amber-300/12 to-transparent blur-[85px] pointer-events-none"></div>

        <!-- Background Flowing Orange Ribbon Path -->
        <div class="absolute inset-0 w-full h-full pointer-events-none opacity-35 overflow-hidden">
            <svg class="w-full h-full" viewBox="0 0 1440 600" fill="none" preserveAspectRatio="none">
                <path d="M -50,200 C 300,80 650,420 1000,180 C 1280,30 1400,320 1550,180" stroke="url(#heroRibbonGrad)" stroke-width="2.5" stroke-dasharray="8 6"/>
                <defs>
                    <linearGradient id="heroRibbonGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5400" stop-opacity="0.9"/>
                        <stop offset="50%" stop-color="#ff9900" stop-opacity="0.65"/>
                        <stop offset="100%" stop-color="#38bdf8" stop-opacity="0.5"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 xl:gap-10 items-center">
                
                <!-- Left Column: Typography & Action Buttons -->
                <div class="lg:col-span-6 xl:col-span-5 space-y-4 sm:space-y-4.5">
                    <!-- Pill Tag -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gradient-to-r from-orange-500/12 via-amber-500/10 to-orange-500/5 border border-orange-300 text-[#ff5400] text-xs sm:text-sm font-bold tracking-wide font-mono uppercase shadow-[0_2px_10px_-2px_rgba(255,84,0,0.2)] backdrop-blur-sm">
                        <span class="font-bold text-sm leading-none">&lt;/&gt;</span>
                        <span>THIẾT KẾ &amp; LẬP TRÌNH WEB - APP</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-3xl sm:text-4xl lg:text-[40px] xl:text-[46px] font-black text-[#0c192e] tracking-tight leading-[1.12]">
                        <span class="block">Hiện Thực Hóa</span>
                        <span class="block text-[#ff5400] mt-0.5">Ý Tưởng Của Bạn</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-xs sm:text-sm text-slate-600 max-w-xl leading-relaxed font-normal mt-1.5">
                        Chúng tôi mang đến giải pháp thiết kế website, lập trình ứng dụng di động và hệ thống phần mềm hiện đại, tối ưu trải nghiệm người dùng, giúp doanh nghiệp chuyển đổi số và phát triển bền vững.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="pt-1.5 flex flex-wrap items-center gap-3">
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-white text-xs sm:text-sm font-bold shadow-md shadow-orange-500/30 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300"
                           style="background: linear-gradient(135deg, #ff5400 0%, #ff6a1a 100%);">
                            <span>Bắt đầu dự án</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>

                        <a href="#du-an-tieu-bieu" 
                           class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-white/90 backdrop-blur-md border border-orange-200/80 hover:border-orange-400 hover:bg-orange-50/50 text-slate-700 text-xs sm:text-sm font-semibold shadow-xs hover:-translate-y-0.5 transition-all duration-300">
                            <span>Xem giải pháp công nghệ</span>
                            <span class="material-symbols-outlined text-[18px] text-slate-500">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Visual Showcase Mockup with 3D Orange Glow Backdrop -->
                <div class="lg:col-span-6 xl:col-span-7 relative flex items-center justify-center lg:justify-end">
                    <div class="relative w-full max-w-[680px] xl:max-w-[760px] transition-transform duration-500 hover:scale-[1.01]">
                        <!-- Warm Orange Shadow Backdrop -->
                        <div class="absolute inset-3 sm:inset-5 rounded-3xl bg-gradient-to-tr from-orange-500/28 via-amber-400/20 to-orange-300/15 blur-2xl -z-10 transform scale-95 translate-y-3 pointer-events-none"></div>

                        <img src="{{ asset('images/webapp/webapp_hero_showcase.png') }}?v={{ time() }}" 
                             alt="Giải pháp công nghệ thiết kế Web App Truyền Thông Cửu Long" 
                             class="w-full h-auto object-contain select-none"
                             style="filter: drop-shadow(0 18px 30px rgba(255, 84, 0, 0.20)) drop-shadow(0 8px 16px rgba(0, 0, 0, 0.08));"
                             loading="eager"
                             fetchpriority="high">
                    </div>
                </div>
            </div>

            <!-- Bottom: 5 Core Capability Chips Strip -->
            <div class="mt-5 lg:mt-6 pt-3.5 border-t border-orange-200/50">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-3.5">
                    
                    <!-- 1. Website & Web App -->
                    <div class="flex items-center gap-2.5 p-2.5 sm:p-3 rounded-2xl bg-white/95 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)] hover:border-orange-400 hover:shadow-[0_8px_20px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-0.5 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-orange-500/12 flex items-center justify-center text-[#ff5400] font-bold text-xs sm:text-sm shrink-0">
                            &lt;/&gt;
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs sm:text-[13px] font-bold text-[#0c192e] truncate">Website &amp; Web App</div>
                            <div class="text-[11px] text-slate-500 truncate mt-0.5">Hiệu năng cao, chuẩn SEO</div>
                        </div>
                    </div>

                    <!-- 2. Mobile App -->
                    <div class="flex items-center gap-2.5 p-2.5 sm:p-3 rounded-2xl bg-white/95 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)] hover:border-orange-400 hover:shadow-[0_8px_20px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-0.5 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-orange-500/12 flex items-center justify-center text-[#ff5400] shrink-0">
                            <span class="material-symbols-outlined text-[18px]">phone_iphone</span>
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs sm:text-[13px] font-bold text-[#0c192e] truncate">Mobile App</div>
                            <div class="text-[11px] text-slate-500 truncate mt-0.5">iOS &amp; Android hiện đại</div>
                        </div>
                    </div>

                    <!-- 3. Hệ thống phần mềm -->
                    <div class="flex items-center gap-2.5 p-2.5 sm:p-3 rounded-2xl bg-white/95 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)] hover:border-orange-400 hover:shadow-[0_8px_20px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-0.5 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-orange-500/12 flex items-center justify-center text-[#ff5400] shrink-0">
                            <span class="material-symbols-outlined text-[18px]">cloud</span>
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs sm:text-[13px] font-bold text-[#0c192e] truncate">Hệ thống phần mềm</div>
                            <div class="text-[11px] text-slate-500 truncate mt-0.5">Tùy chỉnh theo yêu cầu</div>
                        </div>
                    </div>

                    <!-- 4. Tích hợp AI -->
                    <div class="flex items-center gap-2.5 p-2.5 sm:p-3 rounded-2xl bg-white/95 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)] hover:border-orange-400 hover:shadow-[0_8px_20px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-0.5 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-orange-500/12 flex items-center justify-center text-[#ff5400] shrink-0">
                            <span class="material-symbols-outlined text-[18px]">psychology</span>
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs sm:text-[13px] font-bold text-[#0c192e] truncate">Tích hợp AI</div>
                            <div class="text-[11px] text-slate-500 truncate mt-0.5">Tự động hóa thông minh</div>
                        </div>
                    </div>

                    <!-- 5. Bảo mật dữ liệu -->
                    <div class="col-span-2 sm:col-span-1 flex items-center gap-2.5 p-2.5 sm:p-3 rounded-2xl bg-white/95 backdrop-blur-md border border-orange-200/60 shadow-[0_4px_16px_-4px_rgba(255,84,0,0.08)] hover:border-orange-400 hover:shadow-[0_8px_20px_-4px_rgba(255,84,0,0.18)] hover:-translate-y-0.5 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-orange-500/12 flex items-center justify-center text-[#ff5400] shrink-0">
                            <span class="material-symbols-outlined text-[18px]">security</span>
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs sm:text-[13px] font-bold text-[#0c192e] truncate">Bảo mật dữ liệu</div>
                            <div class="text-[11px] text-slate-500 truncate mt-0.5">An toàn &amp; ổn định</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 3D Curved Wave Transition to Section 2 with Gradient & Drop Shadow -->
        <div class="w-full overflow-hidden leading-none relative z-10 -mb-[1px] -mt-3 sm:-mt-5">
            <svg class="relative block w-full h-[16px] sm:h-[22px] lg:h-[26px]" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="waveGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5400" stop-opacity="0.85"/>
                        <stop offset="45%" stop-color="#ff7a29" stop-opacity="0.9"/>
                        <stop offset="75%" stop-color="#fb923c" stop-opacity="0.8"/>
                        <stop offset="100%" stop-color="#38bdf8" stop-opacity="0.7"/>
                    </linearGradient>
                    <filter id="waveShadow1" x="-5%" y="-20%" width="110%" height="150%">
                        <feDropShadow dx="0" dy="-2" stdDeviation="3" flood-color="#ff5400" flood-opacity="0.16"/>
                    </filter>
                </defs>
                <path d="M0,25 C360,85 720,-10 1080,55 C1240,85 1360,45 1440,30 L1440,100 L0,100 Z" fill="#fafbfc"/>
                <path d="M0,25 C360,85 720,-10 1080,55 C1240,85 1360,45 1440,30" fill="none" stroke="url(#waveGrad1)" stroke-width="2.5" filter="url(#waveShadow1)"/>
            </svg>
        </div>
    </section>


    <!-- ==================== 2. TẠI SAO CHỌN CHÚNG TÔI - NĂNG LỰC CÔNG NGHỆ VƯỢT TRỘI ==================== -->
    <section class="pb-0 bg-[#fafbfc] relative overflow-hidden" style="padding-top: 18px; padding-bottom: 0px;">
        
        <!-- Background 3D Ambient Glow Spheres -->
        <div class="absolute -top-24 -left-20 w-88 h-88 rounded-full bg-gradient-to-tr from-orange-400/15 via-amber-300/10 to-transparent blur-[80px] pointer-events-none"></div>
        <div class="absolute -bottom-28 -right-24 w-96 h-96 rounded-full bg-gradient-to-bl from-blue-400/10 via-cyan-300/10 to-transparent blur-[90px] pointer-events-none"></div>
        
        <!-- Background Flowing Ribbon Path -->
        <div class="absolute inset-0 w-full h-full pointer-events-none opacity-30 overflow-hidden">
            <svg class="w-full h-full" viewBox="0 0 1440 600" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M -50,150 C 250,50 450,350 750,200 C 1050,50 1250,450 1500,250" stroke="url(#ribbonGrad1)" stroke-width="2.5" stroke-dasharray="8 6"/>
                <defs>
                    <linearGradient id="ribbonGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5400" stop-opacity="0.8"/>
                        <stop offset="50%" stop-color="#ff9900" stop-opacity="0.6"/>
                        <stop offset="100%" stop-color="#38bdf8" stop-opacity="0.7"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 xl:gap-12 items-center">
                
                <!-- Left: Intro & 4 Feature Cards -->
                <div class="lg:col-span-7 xl:col-span-7 space-y-5 sm:space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">TẠI SAO CHỌN CHÚNG TÔI</span>
                        <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-black text-[#0c192e] tracking-tight mt-1.5 leading-tight">
                            Năng Lực Công Nghệ Vượt Trội
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 font-normal leading-relaxed max-w-2xl mt-2">
                            Với đội ngũ kỹ sư giàu kinh nghiệm và quy trình làm việc chuyên nghiệp, chúng tôi cam kết mang đến những sản phẩm chất lượng, đúng tiến độ và tối ưu chi phí cho khách hàng.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('about') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-white text-xs sm:text-sm font-bold shadow-md shadow-orange-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300" style="background: linear-gradient(135deg, #ff5400, #ff6a1a);">
                                <span>Khám phá năng lực</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- 4 Capabilities Cards Grid with Floating 3D Glow Shadows -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-3.5 pt-1">
                        
                        <!-- Card 1: Tư vấn giải pháp (Cam) -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-4 border border-slate-200/80 shadow-[0_8px_24px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_-6px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1 transition-all duration-300 group">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white mb-2.5 shadow-sm group-hover:scale-105 transition-transform" style="background: linear-gradient(135deg, #ff7a29, #ff5400);">
                                <span class="material-symbols-outlined text-[20px]">lightbulb</span>
                            </div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Tư vấn giải pháp
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed mt-1">
                                Phân tích nhu cầu, đề xuất giải pháp phù hợp nhất.
                            </p>
                        </div>

                        <!-- Card 2: Thiết kế UI/UX (Xanh Dương) -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-4 border border-slate-200/80 shadow-[0_8px_24px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_-6px_rgba(37,99,235,0.15)] hover:border-blue-300 hover:-translate-y-1 transition-all duration-300 group">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white mb-2.5 shadow-sm group-hover:scale-105 transition-transform" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                                <span class="material-symbols-outlined text-[20px]">design_services</span>
                            </div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-blue-600 transition-colors">
                                Thiết kế UI/UX
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed mt-1">
                                Giao diện hiện đại, thân thiện, tối ưu trải nghiệm.
                            </p>
                        </div>

                        <!-- Card 3: Lập trình & triển khai (Tím) -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-4 border border-slate-200/80 shadow-[0_8px_24px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_-6px_rgba(139,92,246,0.15)] hover:border-purple-300 hover:-translate-y-1 transition-all duration-300 group">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white mb-2.5 shadow-sm group-hover:scale-105 transition-transform" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                                <span class="material-symbols-outlined text-[20px]">code</span>
                            </div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-purple-600 transition-colors">
                                Lập trình &amp; triển khai
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed mt-1">
                                Code sạch, hiệu suất cao, dễ mở rộng.
                            </p>
                        </div>

                        <!-- Card 4: Bảo trì & hỗ trợ (Xanh Lá) -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-4 border border-slate-200/80 shadow-[0_8px_24px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_-6px_rgba(16,185,129,0.15)] hover:border-emerald-300 hover:-translate-y-1 transition-all duration-300 group">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white mb-2.5 shadow-sm group-hover:scale-105 transition-transform" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <span class="material-symbols-outlined text-[20px]">support_agent</span>
                            </div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-emerald-600 transition-colors">
                                Bảo trì &amp; hỗ trợ
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed mt-1">
                                Đồng hành lâu dài, đảm bảo hệ thống ổn định.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Right: Alternating Tech Showcase Mockups (1.png & 2.png) -->
                <div class="lg:col-span-5 xl:col-span-5 relative flex items-center justify-center">
                    <div id="techShowcaseSlider" 
                         class="relative w-full max-w-[390px] lg:max-w-[430px] mx-auto flex flex-col items-center justify-center select-none group">
                         
                        <!-- Ambient Warm Glow Circle behind graphic -->
                        <div class="absolute w-64 h-64 sm:w-72 sm:h-72 rounded-full bg-gradient-to-tr from-orange-400/20 to-amber-200/15 blur-3xl pointer-events-none -z-10"></div>

                        <!-- Image Stage Container with natural height -->
                        <div class="relative w-full flex items-center justify-center">
                            <!-- Image 1: In-flow element to guarantee natural height -->
                            <img id="techSlide0" 
                                 src="{{ asset('images/webapp/1.png') }}?v={{ time() }}" 
                                 alt="Năng lực công nghệ - Minh họa 1" 
                                 class="w-full max-h-[340px] sm:max-h-[370px] object-contain filter drop-shadow-[0_12px_24px_rgba(0,0,0,0.1)] transition-all duration-700 ease-in-out block"
                                 style="opacity: 1; transform: scale(1); transition: opacity 0.7s ease, transform 0.7s ease; z-index: 10;">

                            <!-- Image 2: Absolute overlaid on top of Image 1 -->
                            <img id="techSlide1" 
                                 src="{{ asset('images/webapp/2.png') }}?v={{ time() }}" 
                                 alt="Năng lực công nghệ - Minh họa 2" 
                                 class="w-full h-full max-h-[340px] sm:max-h-[370px] object-contain filter drop-shadow-[0_12px_24px_rgba(0,0,0,0.1)] transition-all duration-700 ease-in-out absolute inset-0 m-auto"
                                 style="opacity: 0; transform: scale(0.96); transition: opacity 0.7s ease, transform 0.7s ease; z-index: 0; pointer-events: none;">
                        </div>

                        <!-- Navigation Indicator Dots -->
                        <div class="flex items-center gap-2 mt-2.5 z-20 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full border border-slate-200/80 shadow-xs">
                            <button type="button"
                                    id="techDot0"
                                    onclick="window.switchTechSlide(0)"
                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer w-7 bg-[#ff5400]"
                                    aria-label="Xem ảnh 1"></button>
                            <button type="button"
                                    id="techDot1"
                                    onclick="window.switchTechSlide(1)"
                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer w-2.5 bg-slate-300 hover:bg-slate-400"
                                    aria-label="Xem ảnh 2"></button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- 3D Curved Wave Transition to Section 3 with Gradient & Shadow -->
        <div class="w-full overflow-hidden leading-none relative z-10 -mb-[1px] -mt-4 sm:-mt-6">
            <svg class="relative block w-full h-[16px] sm:h-[22px] lg:h-[26px]" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="waveGrad2" x1="100%" y1="0%" x2="0%" y2="0%">
                        <stop offset="0%" stop-color="#ff5400" stop-opacity="0.85"/>
                        <stop offset="50%" stop-color="#a855f7" stop-opacity="0.75"/>
                        <stop offset="100%" stop-color="#0284c7" stop-opacity="0.8"/>
                    </linearGradient>
                    <filter id="waveShadow2" x="-5%" y="-20%" width="110%" height="150%">
                        <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#ff5400" flood-opacity="0.14"/>
                    </filter>
                </defs>
                <path d="M0,75 C360,10 720,95 1100,25 C1240,0 1360,20 1440,30 L1440,100 L0,100 Z" fill="#ffffff"/>
                <path d="M0,75 C360,10 720,95 1100,25 C1240,0 1360,20 1440,30" fill="none" stroke="url(#waveGrad2)" stroke-width="2.5" filter="url(#waveShadow2)"/>
            </svg>
        </div>
    </section>


    <!-- ==================== 3. QUY TRÌNH LÀM VIỆC - 6 BƯỚC ĐỂ HIỆN THỰC HÓA DỰ ÁN ==================== -->
    <section class="pb-0 bg-white relative overflow-hidden"
             style="padding-top: 14px; padding-bottom: 0px; background-image: radial-gradient(rgba(12, 25, 46, 0.03) 1px, transparent 1px); background-size: 24px 24px;">
        
        <!-- 3D Ambient Glow Spheres for Section 3 -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-gradient-to-r from-orange-400/10 via-amber-200/10 to-blue-400/5 blur-[120px] pointer-events-none"></div>
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-orange-400/10 blur-[80px] pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full bg-blue-400/8 blur-[90px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-4 sm:mb-5">
                <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">QUY TRÌNH LÀM VIỆC</span>
                <h2 class="text-2xl sm:text-3xl lg:text-[36px] font-black text-[#0c192e] tracking-tight mt-1.5 leading-tight">
                    6 Bước Để Hiện Thực Hóa Dự Án
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-normal mt-1.5">
                    Quy trình tinh gọn, minh bạch và bám sát tiến độ từng giai đoạn.
                </p>
            </div>

            <!-- 6 Steps Timeline Grid with Flowing Curved Track Line -->
            <div class="relative">
                <!-- Desktop Connected Flowing Wave Track Line -->
                <div class="hidden xl:block absolute top-[36px] left-[6%] right-[6%] h-[30px] z-0 pointer-events-none">
                    <svg class="w-full h-full" viewBox="0 0 1200 30" fill="none" preserveAspectRatio="none">
                        <path d="M 0,15 Q 150,0 300,15 T 600,15 T 900,15 T 1200,15" stroke="url(#stepWaveTrack)" stroke-width="2.5" stroke-dasharray="6 4"/>
                        <defs>
                            <linearGradient id="stepWaveTrack" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ff5400" stop-opacity="0.8"/>
                                <stop offset="50%" stop-color="#ff7a29" stop-opacity="0.9"/>
                                <stop offset="100%" stop-color="#38bdf8" stop-opacity="0.8"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 sm:gap-5 relative z-10">
                    
                    <!-- Step 01 -->
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-slate-200/70 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_-6px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center text-center group">
                        <div class="w-12 h-12 rounded-full text-white text-xs font-black flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300 mb-3"
                             style="background: linear-gradient(135deg, #ff7a29, #ff5400);">
                            01
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Tiếp nhận yêu cầu
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mt-1">
                                Lắng nghe và phân tích nhu cầu của bạn
                            </p>
                        </div>
                    </div>

                    <!-- Step 02 -->
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-slate-200/70 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_-6px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center text-center group">
                        <div class="w-12 h-12 rounded-full text-white text-xs font-black flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300 mb-3"
                             style="background: linear-gradient(135deg, #ff7a29, #ff5400);">
                            02
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Tư vấn &amp; đề xuất
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mt-1">
                                Đưa ra giải pháp tối ưu và báo giá chi tiết
                            </p>
                        </div>
                    </div>

                    <!-- Step 03 -->
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-slate-200/70 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_-6px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center text-center group">
                        <div class="w-12 h-12 rounded-full text-white text-xs font-black flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300 mb-3"
                             style="background: linear-gradient(135deg, #ff7a29, #ff5400);">
                            03
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Thiết kế giao diện
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mt-1">
                                Duyệt UI/UX trước khi lập trình
                            </p>
                        </div>
                    </div>

                    <!-- Step 04 -->
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-slate-200/70 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_-6px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center text-center group">
                        <div class="w-12 h-12 rounded-full text-white text-xs font-black flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300 mb-3"
                             style="background: linear-gradient(135deg, #ff7a29, #ff5400);">
                            04
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Lập trình &amp; kiểm thử
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mt-1">
                                Đảm bảo chất lượng, hiệu suất và bảo mật
                            </p>
                        </div>
                    </div>

                    <!-- Step 05 -->
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-slate-200/70 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_-6px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center text-center group">
                        <div class="w-12 h-12 rounded-full text-white text-xs font-black flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300 mb-3"
                             style="background: linear-gradient(135deg, #ff7a29, #ff5400);">
                            05
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Triển khai
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mt-1">
                                Bàn giao, hướng dẫn sử dụng chi tiết
                            </p>
                        </div>
                    </div>

                    <!-- Step 06 -->
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-slate-200/70 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_-6px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center text-center group">
                        <div class="w-12 h-12 rounded-full text-white text-xs font-black flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300 mb-3"
                             style="background: linear-gradient(135deg, #ff7a29, #ff5400);">
                            06
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Bảo trì &amp; hỗ trợ
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mt-1">
                                Đồng hành lâu dài, nâng cấp khi cần thiết
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 3D Curved Wave Transition to Section 4 with Gradient & Shadow -->
        <div class="w-full overflow-hidden leading-none relative z-10 -mb-[1px] -mt-4 sm:-mt-6">
            <svg class="relative block w-full h-[16px] sm:h-[22px] lg:h-[26px]" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="waveGrad3" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.8"/>
                        <stop offset="45%" stop-color="#ff7a29" stop-opacity="0.9"/>
                        <stop offset="100%" stop-color="#ff5400" stop-opacity="0.85"/>
                    </linearGradient>
                    <filter id="waveShadow3" x="-5%" y="-20%" width="110%" height="150%">
                        <feDropShadow dx="0" dy="-2" stdDeviation="3" flood-color="#ff5400" flood-opacity="0.14"/>
                    </filter>
                </defs>
                <path d="M0,35 C320,95 680,-15 1040,60 C1220,95 1360,50 1440,30 L1440,100 L0,100 Z" fill="#fafbfc"/>
                <path d="M0,35 C320,95 680,-15 1040,60 C1220,95 1360,50 1440,30" fill="none" stroke="url(#waveGrad3)" stroke-width="2.5" filter="url(#waveShadow3)"/>
            </svg>
        </div>
    </section>


    <!-- ==================== 4. DỰ ÁN TIÊU BIỂU - MỘT SỐ DỰ ÁN WEB APP & MOBILE APP ==================== -->
    <section id="du-an-tieu-bieu" class="pb-0 bg-[#fafbfc] relative overflow-hidden" style="padding-top: 14px; padding-bottom: 0px;">
        
        <!-- 3D Ambient Glow Spheres for Section 4 -->
        <div class="absolute -top-24 -left-20 w-80 h-80 rounded-full bg-gradient-to-tr from-orange-400/12 via-amber-300/10 to-transparent blur-[80px] pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-20 w-96 h-96 rounded-full bg-gradient-to-bl from-blue-400/10 via-cyan-300/8 to-transparent blur-[90px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-3.5 sm:mb-4.5">
                <div>
                    <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">DỰ ÁN TIÊU BIỂU</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-[36px] font-black text-[#0c192e] tracking-tight mt-1.5 leading-tight">
                        Một Số Dự Án Web App &amp; Mobile App
                    </h2>
                </div>

                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#ff5400] hover:text-[#d94800] group shrink-0">
                    <span>Xem tất cả dự án</span>
                    <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- 5 Projects Responsive Grid with 3D Float Shadows -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5 sm:gap-6">
                
                <!-- Project 1: Website Doanh Nghiệp -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_45px_-8px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ asset('images/webapp/webapp_project_1_website.png') }}?v={{ time() }}" 
                             alt="Website Doanh Nghiệp" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Website Doanh Nghiệp
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Giải pháp cho doanh nghiệp vừa và nhỏ
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Project 2: Ứng Dụng Đặt Hàng -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_45px_-8px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ asset('images/webapp/webapp_project_2_ecommerce.png') }}?v={{ time() }}" 
                             alt="Ứng Dụng Đặt Hàng" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Ứng Dụng Đặt Hàng
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Tối ưu trải nghiệm mua sắm
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Project 3: Hệ Thống Quản Lý -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_45px_-8px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ asset('images/webapp/webapp_project_3_management.png') }}?v={{ time() }}" 
                             alt="Hệ Thống Quản Lý" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Hệ Thống Quản Lý
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Quản trị doanh nghiệp hiệu quả
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Project 4: App Giáo Dục -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_45px_-8px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ asset('images/webapp/webapp_project_4_education.png') }}?v={{ time() }}" 
                             alt="App Giáo Dục" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                App Giáo Dục
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Học tập mọi lúc, mọi nơi
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Project 5: Ứng Dụng Du Lịch -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_45px_-8px_rgba(255,84,0,0.15)] hover:border-orange-300 hover:-translate-y-1.5 transition-all duration-300 group flex flex-col">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ asset('images/webapp/webapp_project_5_travel.png') }}?v={{ time() }}" 
                             alt="Ứng Dụng Du Lịch" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-[#0c192e] group-hover:text-[#ff5400] transition-colors">
                                Ứng Dụng Du Lịch
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Khám phá thế giới dễ dàng
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- 3D Curved Wave Transition to Section 5 with Gradient & Shadow -->
        <div class="w-full overflow-hidden leading-none relative z-10 -mb-[1px] -mt-4 sm:-mt-6">
            <svg class="relative block w-full h-[16px] sm:h-[22px] lg:h-[26px]" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="waveGrad4" x1="100%" y1="0%" x2="0%" y2="0%">
                        <stop offset="0%" stop-color="#ff5400" stop-opacity="0.85"/>
                        <stop offset="50%" stop-color="#ff8a00" stop-opacity="0.9"/>
                        <stop offset="100%" stop-color="#fb923c" stop-opacity="0.75"/>
                    </linearGradient>
                    <filter id="waveShadow4" x="-5%" y="-20%" width="110%" height="150%">
                        <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#ff5400" flood-opacity="0.14"/>
                    </filter>
                </defs>
                <path d="M0,65 C400,15 800,90 1200,25 C1320,5 1400,25 1440,30 L1440,100 L0,100 Z" fill="#ffffff"/>
                <path d="M0,65 C400,15 800,90 1200,25 C1320,5 1400,25 1440,30" fill="none" stroke="url(#waveGrad4)" stroke-width="2.5" filter="url(#waveShadow4)"/>
            </svg>
        </div>
    </section>


    <!-- ==================== 5. CÔNG NGHỆ SỬ DỤNG - HIỆN ĐẠI • ỔN ĐỊNH • LINH HOẠT ==================== -->
    <section class="pb-6 sm:pb-7 bg-white relative overflow-hidden"
             style="padding-top: 14px; background-image: radial-gradient(rgba(12, 25, 46, 0.03) 1px, transparent 1px); background-size: 24px 24px;">
        
        <!-- Ambient Glow behind Tech Badges -->
        <div class="absolute top-1/2 left-1/3 -translate-y-1/2 w-96 h-48 bg-gradient-to-r from-orange-400/10 via-amber-300/10 to-transparent blur-[70px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Left Title -->
                <div class="lg:col-span-4 xl:col-span-3">
                    <span class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">CÔNG NGHỆ SỬ DỤNG</span>
                    <h2 class="text-xl sm:text-2xl font-black text-[#0c192e] tracking-tight mt-1 leading-tight">
                        Hiện Đại • Ổn Định • Linh Hoạt
                    </h2>
                </div>

                <!-- Right Tech Badges Row with Official Colored Brand Logos & Glass Cards -->
                <div class="lg:col-span-8 xl:col-span-9 flex flex-wrap items-center gap-3 sm:gap-3.5">
                    
                    <!-- 1. Laravel -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-red-300 hover:shadow-[0_8px_20px_-4px_rgba(255,45,32,0.18)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/laravel.svg') }}?v={{ time() }}" alt="Laravel Logo" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">Laravel</span>
                    </div>

                    <!-- 2. React -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-cyan-300 hover:shadow-[0_8px_20px_-4px_rgba(97,218,251,0.25)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/react.svg') }}?v={{ time() }}" alt="React Logo" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">React</span>
                    </div>

                    <!-- 3. Flutter -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-sky-300 hover:shadow-[0_8px_20px_-4px_rgba(2,86,155,0.2)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/flutter.svg') }}?v={{ time() }}" alt="Flutter Logo" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">Flutter</span>
                    </div>

                    <!-- 4. Node.js -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-emerald-300 hover:shadow-[0_8px_20px_-4px_rgba(83,158,67,0.2)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/nodejs.svg') }}?v={{ time() }}" alt="Node.js Logo" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">Node.js</span>
                    </div>

                    <!-- 5. MySQL -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-amber-300 hover:shadow-[0_8px_20px_-4px_rgba(242,145,17,0.2)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/mysql.svg') }}?v={{ time() }}" alt="MySQL Logo" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">MySQL</span>
                    </div>

                    <!-- 6. PostgreSQL -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-indigo-300 hover:shadow-[0_8px_20px_-4px_rgba(51,103,145,0.2)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/postgresql.svg') }}?v={{ time() }}" alt="PostgreSQL Logo" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">PostgreSQL</span>
                    </div>

                    <!-- 7. AWS -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-orange-300 hover:shadow-[0_8px_20px_-4px_rgba(255,153,0,0.2)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/aws.svg') }}?v={{ time() }}" alt="AWS Logo" class="w-7 h-5 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">AWS</span>
                    </div>

                    <!-- 8. Docker -->
                    <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.05)] hover:border-blue-300 hover:shadow-[0_8px_20px_-4px_rgba(36,150,237,0.2)] hover:-translate-y-0.5 transition-all duration-300 group">
                        <img src="{{ asset('images/tech/docker.svg') }}?v={{ time() }}" alt="Docker Logo" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                        <span class="text-xs sm:text-sm font-bold text-slate-800">Docker</span>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- ==================== 5.5. ANCHOR & SPOTLIGHT: THIẾT KẾ UI/UX THEO YÊU CẦU (#ui-ux) ==================== -->
    <section id="ui-ux" class="py-10 sm:py-14 bg-gradient-to-b from-white via-orange-50/40 to-white relative">
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16">
            <div class="relative rounded-3xl p-8 sm:p-10 lg:p-12 bg-white border-2 border-orange-200/80 shadow-[0_16px_40px_-8px_rgba(255,84,0,0.12)] overflow-hidden">
                <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-gradient-to-br from-orange-400/15 via-amber-300/10 to-transparent blur-3xl pointer-events-none"></div>
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-[#ff5400] text-xs font-bold font-mono uppercase">
                            <span class="w-2 h-2 rounded-full bg-[#ff5400] animate-pulse"></span>
                            <span>DỊCH VỤ CHUYÊN SÂU</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0c192e] tracking-tight">
                            Thiết Kế UI/UX Theo Yêu Cầu
                        </h2>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-2xl">
                            Không chỉ dừng lại ở lập trình, Truyền Thông Cửu Long mang đến dịch vụ thiết kế UI/UX độc bản chuyên sâu từ Wireframe đến Prototype Figma hoàn chỉnh, tối ưu trải nghiệm và tỷ lệ chuyển đổi.
                        </p>
                        <div class="pt-2 flex flex-wrap gap-4 items-center">
                            <a href="{{ route('services.ui-ux') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ff7a29] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                <span>Khám phá Trang Thiết Kế UI/UX</span>
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                            <span class="text-xs text-slate-500 font-medium">100% Độc Bản • Figma Dev-Ready • Chuẩn Responsive</span>
                        </div>
                    </div>

                    <div class="lg:col-span-4 flex justify-center">
                        <div class="w-full max-w-sm rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 p-5 border border-slate-700 shadow-xl space-y-3">
                            <div class="flex items-center justify-between text-xs text-slate-400 font-mono">
                                <span>UI/UX Preview</span>
                                <span class="text-[#ff5400] font-bold">Figma Auto-Layout</span>
                            </div>
                            <div class="h-24 rounded-xl bg-slate-800/80 border border-slate-700 p-3 flex flex-col justify-between">
                                <div class="h-2 w-20 bg-orange-400 rounded"></div>
                                <div class="h-8 rounded bg-slate-700/60 flex items-center justify-center text-[10px] text-slate-300">Design System &amp; Prototype</div>
                                <div class="h-2 w-14 bg-slate-600 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ==================== 6. SẴN SÀNG BẮT ĐẦU - CTA FOOTER BANNER ==================== -->
    <section class="py-8 sm:py-10 bg-white">
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16">
            <div class="relative w-full rounded-3xl overflow-hidden shadow-2xl shadow-orange-500/15 group aspect-[2048/768] select-none" style="aspect-ratio: 2048/768; min-height: 220px;">
                <img src="{{ asset('images/webapp/webapp_cta_banner.png') }}?v={{ time() }}" 
                     alt="Cùng Biến Ý Tưởng Của Bạn Thành Sản Phẩm Thực Tế • Truyền Thông Cửu Long" 
                     class="w-full h-full object-cover block select-none group-hover:scale-[1.01] transition-transform duration-500">

                <!-- Hotspot Overlay Links đè khớp lên nút bấm của banner -->
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <!-- Nút Bắt đầu dự án ngay -->
                    <a href="{{ route('contact') }}" 
                       class="hero-hotspot-btn group absolute pointer-events-auto rounded-full cursor-pointer transition-transform duration-300 ease-out hover:-translate-y-1 hover:scale-[1.02] active:scale-[0.98] select-none"
                       style="left: 4.8%; top: 58.5%; width: 14.5%; height: 11.5%;"
                       title="Bắt đầu dự án ngay"
                       aria-label="Bắt đầu dự án ngay">
                    </a>

                    <!-- Nút Tìm hiểu về chúng tôi -->
                    <a href="{{ route('about') }}" 
                       class="hero-hotspot-btn group absolute pointer-events-auto rounded-full cursor-pointer transition-transform duration-300 ease-out hover:-translate-y-1 hover:scale-[1.02] active:scale-[0.98] select-none"
                       style="left: 20.8%; top: 58.5%; width: 16.5%; height: 11.5%;"
                       title="Tìm hiểu về chúng tôi"
                       aria-label="Tìm hiểu về chúng tôi">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Script điều khiển slider luân phiên 1.png và 2.png -->
    <script>
    (function () {
        let currentSlide = 0;
        let slideTimer = null;

        function setSlide(index) {
            currentSlide = index;
            const img0 = document.getElementById('techSlide0');
            const img1 = document.getElementById('techSlide1');
            const dot0 = document.getElementById('techDot0');
            const dot1 = document.getElementById('techDot1');

            if (!img0 || !img1) return;

            if (currentSlide === 0) {
                // Hiển thị ảnh 1 (1.png)
                img0.style.opacity = '1';
                img0.style.transform = 'scale(1)';
                img0.style.pointerEvents = 'auto';
                img0.style.zIndex = '10';

                img1.style.opacity = '0';
                img1.style.transform = 'scale(0.96)';
                img1.style.pointerEvents = 'none';
                img1.style.zIndex = '0';

                if (dot0 && dot1) {
                    dot0.className = 'h-2 rounded-full transition-all duration-300 cursor-pointer w-7 bg-[#ff5400]';
                    dot1.className = 'h-2 rounded-full transition-all duration-300 cursor-pointer w-2.5 bg-slate-300 hover:bg-slate-400';
                }
            } else {
                // Hiển thị ảnh 2 (2.png)
                img0.style.opacity = '0';
                img0.style.transform = 'scale(0.96)';
                img0.style.pointerEvents = 'none';
                img0.style.zIndex = '0';

                img1.style.opacity = '1';
                img1.style.transform = 'scale(1)';
                img1.style.pointerEvents = 'auto';
                img1.style.zIndex = '10';

                if (dot0 && dot1) {
                    dot0.className = 'h-2 rounded-full transition-all duration-300 cursor-pointer w-2.5 bg-slate-300 hover:bg-slate-400';
                    dot1.className = 'h-2 rounded-full transition-all duration-300 cursor-pointer w-7 bg-[#ff5400]';
                }
            }
        }

        window.switchTechSlide = function (idx) {
            stopAuto();
            setSlide(idx);
            startAuto();
        };

        function startAuto() {
            stopAuto();
            slideTimer = setInterval(() => {
                setSlide(currentSlide === 0 ? 1 : 0);
            }, 3500);
        }

        function stopAuto() {
            if (slideTimer) clearInterval(slideTimer);
        }

        function initSlider() {
            const slider = document.getElementById('techShowcaseSlider');
            if (slider) {
                slider.addEventListener('mouseenter', stopAuto);
                slider.addEventListener('mouseleave', startAuto);
            }
            setSlide(0);
            startAuto();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSlider);
        } else {
            initSlider();
        }
    })();

    (function () {
        function checkUiUxHash() {
            if (window.location.hash === '#ui-ux') {
                window.location.replace("{{ route('services.ui-ux') }}");
            }
        }
        checkUiUxHash();
        window.addEventListener('hashchange', checkUiUxHash);
    })();
    </script>

</div>
@endsection
