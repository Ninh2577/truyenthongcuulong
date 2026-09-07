@extends('layouts.app')

@section('title', 'Cửu Long Media & Technology - Creative Production Studio & Tech Agency')
@section('meta_description', 'Kiến tạo vị thế với truyền thông sáng tạo & nền tảng công nghệ đột phá. Sản xuất Video TVC 4K, Web/App hiệu năng cao và chiến dịch truyền thông số.')

@section('content')
<!-- ==================== HERO SECTION ==================== -->
<section class="relative w-full overflow-hidden bg-surface bg-dot-grid-subtle py-16 lg:py-24 border-b border-slate-200/60">
    <!-- Ambient Studio Lightings, Lens Flare, Decorative Orbits -->
    <div class="absolute -top-24 right-0 w-[620px] h-[620px] rounded-full bg-gradient-to-br from-amber-400/20 via-primary/15 to-accent-coral/10 blur-3xl pointer-events-none -mr-20"></div>
    <div class="absolute -bottom-32 left-10 w-[500px] h-[500px] rounded-full bg-gradient-to-tr from-blue-500/10 via-slate-400/10 to-transparent blur-3xl pointer-events-none"></div>
    
    <!-- Aperture rings / circular lens marks -->
    <div class="absolute top-12 right-12 w-[600px] h-[600px] rounded-full border border-orange-500/10 pointer-events-none hidden lg:block"></div>
    <div class="absolute top-28 right-28 w-[440px] h-[440px] rounded-full border border-amber-500/10 border-dashed pointer-events-none hidden lg:block"></div>
    <div class="absolute -top-10 left-1/3 w-[800px] h-[2px] bg-gradient-to-r from-transparent via-amber-400/35 to-transparent rotate-[32deg] pointer-events-none blur-[1px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            <!-- Hero Left Column -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                <!-- Studio Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gradient-to-r from-amber-100/90 via-orange-50 to-orange-100 border border-amber-300/70 text-primary font-mono text-xs font-bold w-fit shadow-sm">
                    <span class="inline-block w-2 h-2 rounded-full bg-accent-coral animate-ping"></span>
                    <span class="text-navy-base font-bold tracking-tight">REC • 4K FILM PRODUCTION &amp; TECH LAB</span>
                </div>

                <!-- Main Headline -->
                <h1 class="font-headline text-4xl sm:text-5xl lg:text-[56px] lg:leading-[66px] text-navy-base font-extrabold tracking-tight">
                    Kiến Tạo Vị Thế Với Truyền Thông <span class="font-serif italic font-normal text-transparent bg-clip-text bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 relative inline-block">Sáng Tạo</span> &amp; Nền Tảng Công Nghệ <span class="relative inline-block">Đột Phá<span class="absolute -bottom-1 left-0 w-full h-1 bg-gradient-to-r from-primary via-accent-amber to-transparent rounded-full"></span></span>
                </h1>

                <!-- Subtext emphasizing the 3 pillars -->
                <p class="font-body text-base sm:text-lg text-slate-600 max-w-2xl leading-relaxed">
                    Cửu Long Media &amp; Technology kết hợp sức mạnh sản xuất <strong class="text-navy-base font-semibold">Video TVC chuẩn điện ảnh</strong>, hạ tầng <strong class="text-navy-base font-semibold">Web/App hiệu năng cao</strong> và <strong class="text-navy-base font-semibold">Chiến dịch truyền thông số đột phá</strong> giúp thương hiệu thống lĩnh thị trường.
                </p>

                <!-- Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-gradient-to-r from-primary via-orange-500 to-accent-amber text-white font-headline text-sm font-bold shadow-[0_8px_25px_rgba(234,88,12,0.35)] hover:shadow-[0_12px_32px_rgba(234,88,12,0.5)] hover:scale-105 active:scale-95 transition-all group" href="#services-pillars">
                        <span>Khám Phá Dịch Vụ</span>
                        <span class="material-symbols-outlined text-[19px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                    <a class="inline-flex items-center gap-2 px-7 py-4 rounded-full bg-white/90 backdrop-blur-md text-navy-base font-headline text-sm font-semibold border border-slate-300 shadow-sm hover:border-primary hover:text-primary transition-all hover:-translate-y-0.5" href="#portfolio-section">
                        <span class="material-symbols-outlined text-primary text-[20px]">movie</span>
                        <span>Xem Showreel &amp; Dự Án</span>
                    </a>
                </div>

                <!-- Trust Row -->
                <div class="flex flex-wrap items-center gap-4 pt-4 border-t border-slate-200 text-slate-600 text-sm">
                    <div class="flex items-center -space-x-2">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white font-bold text-xs ring-2 ring-white shadow-xs">CL</div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-navy-surface to-slate-900 flex items-center justify-center text-white font-bold text-xs ring-2 ring-white shadow-xs">VN</div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-accent-coral to-rose-600 flex items-center justify-center text-white font-bold text-xs ring-2 ring-white shadow-xs">4K</div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center text-white font-bold text-xs ring-2 ring-white shadow-xs">AI</div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1 text-amber-500">
                            <span class="material-symbols-outlined text-[17px] fill">star</span>
                            <span class="material-symbols-outlined text-[17px] fill">star</span>
                            <span class="material-symbols-outlined text-[17px] fill">star</span>
                            <span class="material-symbols-outlined text-[17px] fill">star</span>
                            <span class="material-symbols-outlined text-[17px] fill">star</span>
                            <span class="text-navy-base font-bold text-xs sm:text-sm ml-1">4.9/5</span>
                        </div>
                        <span class="text-xs text-slate-500 font-medium">Hơn 500+ doanh nghiệp &amp; thương hiệu đồng hành</span>
                    </div>
                </div>
            </div>

            <!-- Hero Right Column: Cinematic Video Editing Timeline + 3 Floating Pillars Cards -->
            <div class="lg:col-span-5 relative flex justify-center items-center">
                <!-- Soft backdrop halo -->
                <div class="absolute w-80 h-80 sm:w-[480px] sm:h-[480px] rounded-full bg-gradient-to-tr from-orange-500/20 via-rose-500/15 to-blue-600/10 blur-3xl"></div>

                <!-- Floating Pillar Card 1: Circular Glowing Play Button Badge -->
                <div class="absolute -top-6 -left-4 sm:-left-8 z-30 flex items-center gap-3 backdrop-blur-xl bg-navy-base/90 text-white px-4 py-2.5 rounded-2xl border border-orange-500/40 shadow-[0_12px_32px_rgba(234,88,12,0.3)] hover:scale-105 transition-all">
                    <div class="relative w-8 h-8 rounded-full bg-gradient-to-r from-primary to-accent-amber flex items-center justify-center shadow-[0_0_15px_rgba(234,88,12,0.9)]">
                        <span class="material-symbols-outlined text-[18px] text-white fill">play_arrow</span>
                        <span class="absolute inset-0 rounded-full border border-white animate-ping opacity-60"></span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline text-xs font-bold text-white">4K Cine Master</span>
                        <span class="text-[10px] font-mono text-amber-400">ProRes 422 HQ • 60fps</span>
                    </div>
                </div>

                <!-- Floating Pillar Card 2: Code Snippet Card -->
                <div class="absolute -bottom-6 -right-2 sm:-right-6 z-30 backdrop-blur-xl bg-[#09152b]/95 text-white p-3.5 rounded-2xl border border-sky-400/40 shadow-[0_14px_36px_rgba(7,15,30,0.4)] flex flex-col gap-1.5 max-w-[240px] hover:scale-105 transition-all">
                    <div class="flex items-center justify-between gap-3 text-[10px] font-mono text-slate-400 border-b border-white/10 pb-1">
                        <span class="flex items-center gap-1 text-sky-400 font-bold">
                            <span class="material-symbols-outlined text-[13px]">code</span> HeroPlayer.tsx
                        </span>
                        <span class="text-emerald-400 font-semibold">Build OK</span>
                    </div>
                    <code class="text-[11px] font-mono text-amber-300 leading-tight">
                        &lt;<span class="text-sky-400">VideoPlayer</span><br/>
                        &nbsp;&nbsp;<span class="text-slate-300">autoPlay</span> <span class="text-emerald-400">quality</span>=<span class="text-orange-400">"4K"</span><br/>
                        &nbsp;&nbsp;<span class="text-emerald-400">latency</span>=<span class="text-orange-400">"0.02s"</span> /&gt;
                    </code>
                </div>

                <!-- Floating Pillar Card 3: Campaign Performance Mini Chip -->
                <div class="absolute -bottom-7 -left-3 sm:-left-6 z-30 backdrop-blur-xl bg-white/95 text-navy-base px-3.5 py-2.5 rounded-2xl border border-orange-300 shadow-[0_12px_28px_rgba(234,88,12,0.18)] flex items-center gap-3 hover:scale-105 transition-transform">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-accent-coral to-primary flex items-center justify-center text-white shadow-md shrink-0">
                        <span class="material-symbols-outlined text-[18px]">query_stats</span>
                    </div>
                    <div class="flex flex-col pr-1">
                        <div class="flex items-center gap-1.5">
                            <span class="text-[11px] font-headline font-bold">Omni Ads ROAS</span>
                            <span class="text-[10px] font-mono text-emerald-700 bg-emerald-100 font-bold px-1.5 rounded-full">+340%</span>
                        </div>
                        <span class="text-[10px] text-slate-500 font-medium">Chiến dịch viral TikTok/Meta</span>
                    </div>
                </div>

                <!-- Main Realistic Video Editing Timeline Mockup -->
                <div class="relative w-full max-w-[460px] rounded-3xl bg-navy-base border border-slate-700/80 shadow-[0_24px_60px_rgba(7,15,30,0.35),0_0_40px_rgba(234,88,12,0.15)] overflow-hidden">
                    <div class="px-4 py-2.5 bg-navy-surface border-b border-white/10 flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                            <span class="ml-2 text-[10px] font-mono text-slate-400">CuuLong_CineStudio_v3.4 - Project: Mekong_Viral_TVC</span>
                        </div>
                        <div class="flex items-center gap-1 text-[10px] font-mono px-2 py-0.5 rounded bg-orange-500/20 text-orange-400 border border-orange-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> REC 4K
                        </div>
                    </div>

                    <!-- Viewport Preview Screen -->
                    <div class="relative h-44 w-full bg-black overflow-hidden group">
                        <img class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-500" alt="Cinematic production preview of Mekong Delta agricultural landscape" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhvlu1138YzJVrOShzutAvKGkz3j5nSQ6FSRRCOi-qYlq3I4Auibp8apXefm76bwHf-2zrBkZUHfaoXZoXnsMQ793B5GdY66hawqN0_YynY0pHC26dWpNngI9JSXG1yDBHN3WvepMEVpRCDQuLKVPCWllEmUCljDTfvmU_OHs9pqJgLfDmDXFO6gZ4aDGs6861rp3bLHuyOiamlRpq_9zpLsfmH2jfMGse10trwqZt17ok_MAJabJq"/>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-primary/90 backdrop-blur-md text-white flex items-center justify-center shadow-[0_0_24px_rgba(234,88,12,0.9)] ring-4 ring-orange-500/30 hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[26px] fill ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="absolute top-2.5 left-3 px-2 py-0.5 rounded bg-black/60 backdrop-blur-md text-[10px] font-mono text-amber-400 border border-white/10">
                            TC: 00:04:18:22
                        </div>
                        <div class="absolute top-2.5 right-3 px-2 py-0.5 rounded bg-black/60 backdrop-blur-md text-[10px] font-mono text-slate-300 border border-white/10">
                            FPS: 59.94
                        </div>
                        <div class="absolute bottom-2 left-3 right-3 flex items-center justify-between text-[10px] font-mono text-slate-300 bg-black/50 px-2 py-1 rounded">
                            <span>Color: DaVinci Wide Gamut</span>
                            <span class="text-emerald-400">Audio: -6dB Peak Normal</span>
                        </div>
                    </div>

                    <!-- Multi-track Video & Audio Editing Timeline Canvas -->
                    <div class="p-3 bg-[#08111f] flex flex-col gap-1.5 border-t border-white/10 relative">
                        <div class="flex items-center justify-between text-[9px] font-mono text-slate-500 pb-1 border-b border-white/5">
                            <span>00:00</span>
                            <span>01:30</span>
                            <span class="text-orange-400 font-bold">04:18</span>
                            <span>06:00</span>
                            <span>08:30</span>
                        </div>
                        <div class="absolute top-2 bottom-2 left-[54%] w-[2px] bg-red-500 z-20 pointer-events-none shadow-[0_0_8px_rgba(239,68,68,0.9)]">
                            <div class="w-2.5 h-2.5 bg-red-500 rotate-45 -ml-[4px] -top-1 absolute shadow-sm"></div>
                        </div>
                        <div class="flex items-center gap-1.5 h-6">
                            <span class="text-[9px] font-mono text-slate-400 w-5">V2</span>
                            <div class="flex-1 h-full bg-white/[0.04] rounded flex items-center p-0.5 gap-1 overflow-hidden">
                                <div class="w-1/4 h-full bg-amber-500/80 rounded px-1.5 flex items-center text-[9px] font-mono text-navy-base font-bold truncate">3D Intro.mp4</div>
                                <div class="w-1/3 h-full bg-orange-500/80 rounded px-1.5 flex items-center text-[9px] font-mono text-navy-base font-bold truncate">Drone_Mekong.mov</div>
                                <div class="w-1/4 h-full bg-rose-500/80 rounded px-1.5 flex items-center text-[9px] font-mono text-white font-bold truncate">Callout_UI.aep</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 h-6">
                            <span class="text-[9px] font-mono text-slate-400 w-5">V1</span>
                            <div class="flex-1 h-full bg-white/[0.04] rounded flex items-center p-0.5 gap-1 overflow-hidden">
                                <div class="w-1/2 h-full bg-primary rounded px-1.5 flex items-center text-[9px] font-mono text-white font-bold truncate">Master_A_Roll_4K.raw</div>
                                <div class="w-1/2 h-full bg-orange-600 rounded px-1.5 flex items-center text-[9px] font-mono text-white font-bold truncate">Product_Cinematic.raw</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 h-6">
                            <span class="text-[9px] font-mono text-slate-400 w-5">A1</span>
                            <div class="flex-1 h-full bg-emerald-950/40 border border-emerald-500/30 rounded flex items-center px-1 overflow-hidden relative">
                                <svg class="w-full h-4 opacity-80" fill="none" preserveaspectratio="none" viewBox="0 0 200 20">
                                    <path d="M0 10 L10 4 L20 16 L30 2 L40 18 L50 6 L60 14 L70 1 L80 19 L90 8 L100 12 L110 3 L120 17 L130 5 L140 15 L150 2 L160 18 L170 8 L180 13 L190 6 L200 10" stroke="#10b981" stroke-linecap="round" stroke-width="1.8"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 h-5">
                            <span class="text-[9px] font-mono text-slate-400 w-5">A2</span>
                            <div class="flex-1 h-full bg-sky-950/40 border border-sky-500/30 rounded flex items-center px-1 overflow-hidden">
                                <svg class="w-full h-3 opacity-80" fill="none" preserveaspectratio="none" viewBox="0 0 200 14">
                                    <path d="M0 7 L20 7 L30 1 L40 13 L50 7 L80 7 L90 2 L100 12 L110 7 L150 7 L160 3 L170 11 L180 7 L200 7" stroke="#38bdf8" stroke-linecap="round" stroke-width="1.5"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TECH STACK & PRODUCTION GEAR TRUST BAR ==================== -->
<section class="w-full bg-slate-100/90 border-b border-slate-200/80 py-6 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center gap-3">
        <span class="font-mono text-[11px] text-slate-500 uppercase tracking-widest font-bold">
            HỆ SINH THÁI SẢN XUẤT CÔNG NGHỆ &amp; ĐỐI TÁC TRUYỀN THÔNG TOÀN CẦU
        </span>
        <div class="w-full flex flex-wrap items-center justify-center gap-x-7 gap-y-3 text-slate-700">
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-purple-600">movie_filter</span>
                <span class="font-headline text-xs font-bold">Adobe Premiere &amp; AE</span>
            </div>
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-amber-600">tune</span>
                <span class="font-headline text-xs font-bold">DaVinci Resolve 19</span>
            </div>
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-sky-600">code_blocks</span>
                <span class="font-headline text-xs font-bold">Laravel 11 &amp; React</span>
            </div>
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-emerald-600">smart_toy</span>
                <span class="font-headline text-xs font-bold">OpenAI &amp; Claude AI</span>
            </div>
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-blue-500">cloud</span>
                <span class="font-headline text-xs font-bold">Google Cloud Platform</span>
            </div>
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-orange-600">cloud_done</span>
                <span class="font-headline text-xs font-bold">AWS Enterprise</span>
            </div>
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-pink-600">video_library</span>
                <span class="font-headline text-xs font-bold">TikTok Partner Agency</span>
            </div>
            <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200/70 shadow-2xs">
                <span class="material-symbols-outlined text-[18px] text-blue-600">public</span>
                <span class="font-headline text-xs font-bold">Meta Business Partner</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== STATS SECTION ==================== -->
<section class="w-full bg-white py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 p-4 rounded-3xl bg-slate-50/80 border border-slate-200 shadow-xs">
            <!-- Stat 1 -->
            <div class="relative p-6 rounded-2xl bg-gradient-to-t from-orange-50/60 to-transparent flex flex-col items-center text-center gap-2">
                <div class="w-11 h-11 rounded-full bg-orange-100 text-primary flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[22px]">video_camera_front</span>
                </div>
                <span class="font-headline text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber leading-none">10+</span>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Năm Kinh Nghiệm Studio &amp; Tech</span>
                <div class="hidden lg:block absolute right-0 top-1/4 h-1/2 w-px bg-slate-200"></div>
            </div>
            <!-- Stat 2 -->
            <div class="relative p-6 rounded-2xl bg-gradient-to-t from-amber-50/60 to-transparent flex flex-col items-center text-center gap-2">
                <div class="w-11 h-11 rounded-full bg-amber-100 text-accent-amber flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[22px]">rocket_launch</span>
                </div>
                <span class="font-headline text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-accent-amber to-orange-600 leading-none">850+</span>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Dự Án &amp; Chiến Dịch Triển Khai</span>
                <div class="hidden lg:block absolute right-0 top-1/4 h-1/2 w-px bg-slate-200"></div>
            </div>
            <!-- Stat 3 -->
            <div class="relative p-6 rounded-2xl bg-gradient-to-t from-blue-50/60 to-transparent flex flex-col items-center text-center gap-2">
                <div class="w-11 h-11 rounded-full bg-blue-100 text-navy-base flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[22px]">corporate_fare</span>
                </div>
                <span class="font-headline text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-navy-base to-slate-700 leading-none">320+</span>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Doanh Nghiệp &amp; Đối Tác Hợp Tác</span>
                <div class="hidden lg:block absolute right-0 top-1/4 h-1/2 w-px bg-slate-200"></div>
            </div>
            <!-- Stat 4 -->
            <div class="relative p-6 rounded-2xl bg-gradient-to-t from-rose-50/60 to-transparent flex flex-col items-center text-center gap-2">
                <div class="w-11 h-11 rounded-full bg-rose-100 text-accent-coral flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[22px]">verified</span>
                </div>
                <span class="font-headline text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-accent-coral to-rose-600 leading-none">99.2%</span>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Tỷ Lệ Khách Hàng Tái Ký Dài Hạn</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== SERVICES SECTION: THREE DISTINCT PILLARS ==================== -->
<section class="w-full bg-surface bg-dot-grid-subtle py-20 lg:py-28 relative" id="services-pillars">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-16 relative z-10">
        <div class="flex flex-col items-center text-center gap-3 max-w-3xl mx-auto">
            <span class="px-4 py-1 rounded-full bg-orange-100 border border-orange-300 text-primary font-mono text-xs uppercase tracking-wider font-bold">
                3 TRỤ CỘT NĂNG LỰC CỐT LÕI
            </span>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                Giải Pháp Toàn Diện Cho <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent-amber to-rose-500">Tăng Trưởng</span> Doanh Nghiệp
            </h2>
            <p class="font-body text-base text-slate-600 max-w-2xl leading-relaxed">
                Hợp nhất 3 lĩnh vực then chốt tạo nên vòng tròn khép kín: Nền tảng số vững chắc, Nội dung nghe nhìn chạm cảm xúc và Chiến lược phân phối đa kênh bùng nổ.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- PILLAR 1: Thiết kế & Lập trình Web/App -->
            <div class="group rounded-3xl p-8 bg-gradient-to-b from-navy-surface via-[#0a1830] to-navy-base text-white border border-sky-500/30 shadow-[0_16px_36px_rgba(7,15,30,0.25)] hover:border-sky-400/70 hover:shadow-[0_20px_45px_rgba(56,189,248,0.2)] transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -top-4 -right-4 font-mono text-5xl font-black text-sky-500/10 select-none pointer-events-none">&lt;/&gt;</div>
                <div class="absolute top-0 right-0 w-36 h-36 bg-sky-500/15 rounded-full blur-2xl pointer-events-none"></div>
                <div class="flex flex-col gap-6 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-700 flex items-center justify-center text-white shadow-[0_0_20px_rgba(56,189,248,0.5)]">
                            <span class="material-symbols-outlined text-[28px]">terminal</span>
                        </div>
                        <span class="font-mono text-[11px] text-sky-300 bg-sky-950/70 border border-sky-400/30 px-3 py-1 rounded-full font-bold">PILLAR 01</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-2xl font-bold text-white group-hover:text-sky-300 transition-colors">
                            Thiết Kế &amp; Lập Trình Web/App
                        </h3>
                        <p class="font-body text-sm text-slate-300 leading-relaxed">
                            Xây dựng hệ thống phần mềm chịu tải cao, kiến trúc Microservices hiện đại, nền tảng thương mại điện tử, ứng dụng di động iOS/Android và tích hợp AI chuyên sâu.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-sky-300 text-xs font-mono font-medium border border-sky-400/20">High-load Architecture</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-sky-300 text-xs font-mono font-medium border border-sky-400/20">iOS / Android Flutter</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-sky-300 text-xs font-mono font-medium border border-sky-400/20">Laravel 11 &amp; AI Integration</span>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-white/10 relative z-10">
                    <a class="inline-flex items-center gap-2 font-headline text-sm font-bold text-sky-400 hover:text-sky-300 transition-colors group/link" href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}">
                        <span>Xem chi tiết giải pháp Web/App</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover/link:translate-x-1.5">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- PILLAR 2: Quay Dựng Phim & Sản Xuất Nội Dung -->
            <div class="group rounded-3xl p-8 bg-gradient-to-b from-white via-orange-50/50 to-amber-50/70 border-2 border-orange-300/80 shadow-[0_16px_36px_rgba(234,88,12,0.15)] hover:border-primary hover:shadow-[0_20px_45px_rgba(234,88,12,0.25)] transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-3 bg-navy-base flex items-center justify-around px-2">
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                </div>
                <div class="absolute top-0 right-0 w-36 h-36 bg-amber-400/20 rounded-full blur-2xl pointer-events-none"></div>
                <div class="flex flex-col gap-6 pt-2 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary via-orange-500 to-accent-amber flex items-center justify-center text-white shadow-[0_0_20px_rgba(234,88,12,0.45)]">
                            <span class="material-symbols-outlined text-[28px]">movie_edit</span>
                        </div>
                        <span class="font-mono text-[11px] text-primary bg-orange-100 border border-orange-300 px-3 py-1 rounded-full font-bold">PILLAR 02</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Quay Dựng Phim &amp; Sản Xuất Nội Dung
                        </h3>
                        <p class="font-body text-sm text-slate-600 leading-relaxed">
                            Sản xuất TVC doanh nghiệp 4K, video viral triệu view, Motion Design 3D/VFX, podcast studio cao cấp và chuỗi nội dung ngắn (Shorts/Reels/TikTok) tối ưu chuyển đổi.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-primary text-xs font-semibold border border-orange-200">TVC Doanh Nghiệp 4K</span>
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-primary text-xs font-semibold border border-orange-200">3D Motion &amp; VFX</span>
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-primary text-xs font-semibold border border-orange-200">Viral Short-form Studio</span>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-orange-200/80 relative z-10">
                    <a class="inline-flex items-center gap-2 font-headline text-sm font-bold text-primary hover:text-primary-hover transition-colors group/link" href="{{ route('services.show', 'san-xuat-video-media') }}">
                        <span>Xem Showreel &amp; Bảng giá Media</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover/link:translate-x-1.5">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- PILLAR 3: Quảng Cáo & Truyền Thông Số -->
            <div class="group rounded-3xl p-8 bg-gradient-to-br from-amber-500/10 via-rose-50/50 to-orange-100/40 border-2 border-rose-300/70 shadow-[0_16px_36px_rgba(239,68,68,0.12)] hover:border-accent-coral hover:shadow-[0_20px_45px_rgba(239,68,68,0.22)] transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 w-36 h-36 bg-rose-500/15 rounded-full blur-2xl pointer-events-none"></div>
                <div class="flex flex-col gap-6 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-accent-coral via-rose-500 to-amber-500 flex items-center justify-center text-white shadow-[0_0_20px_rgba(239,68,68,0.45)]">
                            <span class="material-symbols-outlined text-[28px]">campaign</span>
                        </div>
                        <span class="font-mono text-[11px] text-accent-coral bg-rose-100 border border-rose-300 px-3 py-1 rounded-full font-bold">PILLAR 03</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-accent-coral transition-colors">
                            Quảng Cáo &amp; Truyền Thông Số
                        </h3>
                        <p class="font-body text-sm text-slate-600 leading-relaxed">
                            Chiến dịch PR báo chí chính thống (VnExpress, Forbes, CafeF), tối ưu quảng cáo đa kênh Google/Meta/TikTok Shop với cam kết ROAS thực tế và nền tảng dữ liệu CDP.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold border border-rose-200">Booking PR Báo Chí</span>
                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold border border-rose-200">Performance Ads Omnichannel</span>
                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold border border-rose-200">MarTech Data Automation</span>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-rose-200/80 relative z-10">
                    <a class="inline-flex items-center gap-2 font-headline text-sm font-bold text-accent-coral hover:text-rose-600 transition-colors group/link" href="{{ route('services.show', 'digital-marketing-quang-cao') }}">
                        <span>Khám phá gói Growth Marketing</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover/link:translate-x-1.5">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== "WHY CHOOSE US" (DARK NAVY SECTION) ==================== -->
<section class="w-full bg-navy-base bg-dot-grid-dark py-20 lg:py-28 text-white relative overflow-hidden border-y border-white/10" id="why-clm">
    <div class="absolute -top-32 -left-32 w-[550px] h-[550px] rounded-full bg-gradient-to-br from-primary/30 to-accent-coral/10 blur-[110px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-[550px] h-[550px] rounded-full bg-gradient-to-tl from-blue-600/20 via-sky-600/15 to-transparent blur-[110px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col gap-16">
        <div class="flex flex-col items-center text-center gap-3 max-w-3xl mx-auto">
            <span class="px-4 py-1.5 rounded-full bg-white/10 border border-white/15 text-accent-amber font-mono text-xs tracking-widest uppercase font-bold backdrop-blur-md">
                LỢI THẾ CẠNH TRANH ĐỘC BẢN
            </span>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                Tại Sao Các Doanh Nghiệp Chọn Cửu Long Media &amp; Tech?
            </h2>
            <p class="font-body text-base text-slate-300 max-w-2xl leading-relaxed">
                Chúng tôi phá vỡ khoảng cách giữa đơn vị quay dựng video nghệ thuật và công ty phần mềm kỹ thuật, trao cho doanh nghiệp giải pháp thống nhất toàn diện.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="relative p-7 rounded-3xl bg-gradient-to-b from-white/[0.12] to-white/[0.04] backdrop-blur-xl border-2 border-primary/60 shadow-[0_0_35px_rgba(234,88,12,0.25)] flex flex-col gap-4 hover:-translate-y-1.5 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary via-orange-500 to-accent-amber flex items-center justify-center text-white shadow-[0_0_24px_rgba(234,88,12,0.7)]">
                    <span class="material-symbols-outlined text-[26px]">all_inclusive</span>
                </div>
                <h3 class="font-headline text-xl font-bold text-white group-hover:text-amber-300 transition-colors">
                    Mô Hình Tích Hợp 3-in-1: Code + Film + Ads
                </h3>
                <p class="font-body text-sm text-slate-300 leading-relaxed">
                    Từ ý tưởng kịch bản TVC, thiết kế landing page đến cài đặt tracking pixel và chạy ads được thực hiện bởi một đội ngũ đồng nhất.
                </p>
                <div class="mt-auto pt-3 border-t border-white/10 flex items-center gap-2 text-amber-400 text-xs font-bold font-mono">
                    <span class="material-symbols-outlined text-[17px]">verified</span>
                    <span>Đồng bộ 100% không rò rỉ chi phí</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="relative p-7 rounded-3xl bg-gradient-to-b from-white/[0.08] to-white/[0.02] backdrop-blur-xl border border-white/10 shadow-[0_16px_36px_rgba(0,0,0,0.3)] flex flex-col gap-4 hover:border-sky-400/40 hover:-translate-y-1.5 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white shadow-[0_0_20px_rgba(56,189,248,0.5)]">
                    <span class="material-symbols-outlined text-[26px]">precision_manufacturing</span>
                </div>
                <h3 class="font-headline text-xl font-bold text-white group-hover:text-sky-300 transition-colors">
                    Trang Thiết Bị Cine &amp; AI Studio 4.0
                </h3>
                <p class="font-body text-sm text-slate-300 leading-relaxed">
                    Sở hữu dàn máy quay điện ảnh RED/Sony FX, hệ thống phòng dựng DaVinci HDR và công nghệ AI Render tự động hóa tốc độ cao.
                </p>
                <div class="mt-auto pt-3 border-t border-white/10 flex items-center gap-2 text-sky-300 text-xs font-bold font-mono">
                    <span class="material-symbols-outlined text-[17px]">verified</span>
                    <span>Chuẩn chất lượng 4K ProRes</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="relative p-7 rounded-3xl bg-gradient-to-b from-white/[0.08] to-white/[0.02] backdrop-blur-xl border border-white/10 shadow-[0_16px_36px_rgba(0,0,0,0.3)] flex flex-col gap-4 hover:border-emerald-400/40 hover:-translate-y-1.5 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white shadow-[0_0_20px_rgba(16,185,129,0.5)]">
                    <span class="material-symbols-outlined text-[26px]">contract</span>
                </div>
                <h3 class="font-headline text-xl font-bold text-white group-hover:text-emerald-300 transition-colors">
                    Cam Kết KPI &amp; SLA Hợp Đồng Rõ Ràng
                </h3>
                <p class="font-body text-sm text-slate-300 leading-relaxed">
                    Cam kết bằng văn bản số lượt tiếp cận (reach), lượt xem thực (views), uptime hệ thống 99.9% và tiến độ bàn giao đúng hẹn.
                </p>
                <div class="mt-auto pt-3 border-t border-white/10 flex items-center gap-2 text-emerald-400 text-xs font-bold font-mono">
                    <span class="material-symbols-outlined text-[17px]">verified</span>
                    <span>SLA pháp lý minh bạch</span>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="relative p-7 rounded-3xl bg-gradient-to-b from-white/[0.08] to-white/[0.02] backdrop-blur-xl border border-white/10 shadow-[0_16px_36px_rgba(0,0,0,0.3)] flex flex-col gap-4 hover:border-rose-400/40 hover:-translate-y-1.5 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-accent-coral to-rose-600 flex items-center justify-center text-white shadow-[0_0_20px_rgba(239,68,68,0.5)]">
                    <span class="material-symbols-outlined text-[26px]">diversity_3</span>
                </div>
                <h3 class="font-headline text-xl font-bold text-white group-hover:text-rose-300 transition-colors">
                    Đội Ngũ Senior Cấp Cao Trực Tiếp Thực Hiện
                </h3>
                <p class="font-body text-sm text-slate-300 leading-relaxed">
                    Các đạo diễn hình ảnh từng đoạt giải, biên kịch điện ảnh và lập trình viên trưởng kinh nghiệm 10+ năm trực tiếp cố vấn chiến dịch.
                </p>
                <div class="mt-auto pt-3 border-t border-white/10 flex items-center gap-2 text-rose-400 text-xs font-bold font-mono">
                    <span class="material-symbols-outlined text-[17px]">verified</span>
                    <span>Đạo diễn &amp; Tech Lead chỉ đạo</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CASE STUDIES / FEATURED WORK ==================== -->
<section class="w-full bg-slate-50 py-20 lg:py-28" id="portfolio-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="flex flex-col gap-2">
                <span class="font-mono text-xs text-primary uppercase font-bold tracking-widest">SHOWREEL &amp; PORTFOLIO</span>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-navy-base">
                    Dự Án &amp; Chiến Dịch <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-rose-500 font-extrabold">Tiêu Biểu</span>
                </h2>
            </div>
            <!-- Category Tabs -->
            <div class="flex flex-wrap gap-1.5 bg-white p-1.5 rounded-full border border-slate-200 shadow-xs" id="filter-tabs">
                <button class="px-4 py-1.5 rounded-full bg-primary text-white font-headline text-xs font-bold shadow-xs transition-all" onclick="filterProjects(event, 'all')">Tất cả dự án</button>
                <button class="px-4 py-1.5 rounded-full text-slate-600 hover:text-navy-base font-headline text-xs font-semibold transition-all" onclick="filterProjects(event, 'film')">Phim &amp; Video TVC</button>
                <button class="px-4 py-1.5 rounded-full text-slate-600 hover:text-navy-base font-headline text-xs font-semibold transition-all" onclick="filterProjects(event, 'webapp')">Web &amp; Nền tảng số</button>
                <button class="px-4 py-1.5 rounded-full text-slate-600 hover:text-navy-base font-headline text-xs font-semibold transition-all" onclick="filterProjects(event, 'ads')">Chiến dịch Ads &amp; PR</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Card 1: Prominent Web/App Architecture in Glass Browser Mockup (7 Cols) -->
            <div class="project-item webapp lg:col-span-7 group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_12px_36px_rgba(7,15,30,0.06)] hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="w-full bg-navy-base text-slate-400 px-4 py-3 flex items-center justify-between border-b border-white/10">
                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                        <span class="ml-2 text-xs font-mono text-slate-400/80">https://vmedia-portal.vn/live</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-sky-500/20 text-sky-300 border border-sky-400/30 text-[10px] font-mono font-bold">Featured Web Platform</span>
                </div>
                <div class="h-64 sm:h-80 w-full relative overflow-hidden bg-slate-100">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Modern responsive digital news website interface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIYimxDL4LgX0qamlnVYiUZNtTFtItfln4gg0saviuCv_dRzMpfY2bNE5Vu1FGfE6Z2niv_Q8goyPUkDRjN84OsfaVlAVgoggdm9gL25EBg368XTBbYGCevEwtztCh9j-WhP_egiqtjFlOysh90tfRmIfYK6hnsVWGPCVR2odW8rbzUhHEwb7TiOvzQR23w-VnKdTeb3fZUZnAzVFFQ000W83kiDSONt561Gcz2iImNQolgOcCGawp"/>
                    <div class="absolute top-4 left-4">
                        <span class="px-3.5 py-1 rounded-full bg-navy-base/80 backdrop-blur-md text-sky-400 font-mono text-xs font-bold border border-sky-400/30">
                            Laravel 11 • AI CMS
                        </span>
                    </div>
                </div>
                <div class="p-7 flex flex-col gap-3 flex-1 bg-gradient-to-b from-white to-slate-50/50">
                    <h3 class="font-headline text-2xl text-navy-base font-extrabold group-hover:text-primary transition-colors">
                        Cổng Tin Tức &amp; Tạp Chí Số Toàn Diện V-Media
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Tái cấu trúc kiến trúc microservices chịu tải hơn 5 triệu lượt đọc mỗi ngày, tích hợp AI tự động tổng hợp tin tức và tối ưu SEO theo thời gian thực.
                    </p>
                    <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                        <span class="text-primary font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">trending_up</span> +280% Tăng trưởng Traffic
                        </span>
                        <span class="text-slate-500 font-semibold bg-slate-100 px-3 py-1 rounded-full">⚡ 0.3s Tải trang</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: 2 Video Player Mockup Cards (5 Cols) -->
            <div class="lg:col-span-5 flex flex-col gap-8">
                <!-- Card 2: Realistic Video Player Mockup -->
                <div class="project-item film group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.05)] hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-black">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90" alt="Cinematic commercial still 4K" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhvlu1138YzJVrOShzutAvKGkz3j5nSQ6FSRRCOi-qYlq3I4Auibp8apXefm76bwHf-2zrBkZUHfaoXZoXnsMQ793B5GdY66hawqN0_YynY0pHC26dWpNngI9JSXG1yDBHN3WvepMEVpRCDQuLKVPCWllEmUCljDTfvmU_OHs9pqJgLfDmDXFO6gZ4aDGs6861rp3bLHuyOiamlRpq_9zpLsfmH2jfMGse10trwqZt17ok_MAJabJq"/>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-[0_0_25px_rgba(234,88,12,0.9)] ring-4 ring-orange-400/30 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[24px] fill ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-black/70 backdrop-blur-md text-white font-mono text-[11px] font-bold border border-white/20">
                            03:45 • 4K
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-black/60">
                            <div class="h-full w-2/3 bg-gradient-to-r from-primary to-accent-amber relative">
                                <div class="absolute right-0 -top-1 w-3 h-3 rounded-full bg-white shadow-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-orange-100 text-primary font-mono text-[10px] font-bold">Film &amp; TVC Viral</span>
                            <span class="text-xs text-slate-400 font-mono">65M+ Views</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Chiến Dịch Lan Tỏa Nông Nghiệp Xanh Mekong
                        </h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Chuỗi phim ngắn cảm xúc đạt Top 1 Trending TikTok kết hợp chiến dịch PR đa báo đài, nâng tầm thương hiệu nông sản Việt.
                        </p>
                    </div>
                </div>

                <!-- Card 3: AI & MarTech Realtime Analytics Dashboard Mockup -->
                <div class="project-item ads group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.05)] hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-navy-base">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-85" alt="AI data visualization command center interface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNXp6piqhQB6NUMICjmyyBYcL-ES1b4QJSu6lV4zmkjmURxhXvYcYXGlnD9BD5SSjlK_bNFHxWWZi56edxviZbalD9sVk7VkSjNPvFJ_YR226IMLOJU5AFfXCTXx82HwXt3BGMf0lO6FjZIOPjkC7AMvroQL8aP2wXGDmkcBGgJLHQ8XgOA7b9absqSTzgksVtfFt7qQsoZbxXb6wIDNigsB7tufWecV4W8uOUyLPdlbgCKHGkYNrL"/>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-0.5 rounded-full bg-navy-base/80 backdrop-blur-md text-amber-400 font-mono text-[10px] font-bold border border-amber-400/30">
                                NLP Intelligence • Social Radar
                            </span>
                        </div>
                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-emerald-950/80 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                            ⚡ 60s Live Report
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-mono text-[10px] font-bold">MarTech &amp; AI Ads</span>
                            <span class="text-xs text-slate-400 font-mono">Real-time Feed</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Hệ Thống Tự Động Phân Tích Dữ Liệu Báo Chí Real-time
                        </h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Quét 200+ đầu báo trực tuyến mỗi phút, phân tích sắc thái cảm xúc và dự báo xu hướng giúp tối ưu chi phí quảng cáo 40%.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function filterProjects(event, category) {
        const tabs = document.querySelectorAll('#filter-tabs button');
        tabs.forEach(tab => {
            tab.className = 'px-4 py-1.5 rounded-full text-slate-600 hover:text-navy-base font-headline text-xs font-semibold transition-all';
        });
        event.currentTarget.className = 'px-4 py-1.5 rounded-full bg-primary text-white font-headline text-xs font-bold shadow-xs transition-all';

        const items = document.querySelectorAll('.project-item');
        items.forEach(item => {
            if (category === 'all' || item.classList.contains(category)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endpush
