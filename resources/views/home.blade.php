@extends('layouts.app')

@section('title', 'Truyền Thông Cửu Long - Creative Production Studio & Tech Agency')
@section('meta_description', 'Creative Production Studio & Enterprise Tech Agency hàng đầu Cần Thơ & ĐBSCL. Sản xuất Video TVC 4K chuẩn điện ảnh, giải pháp Web/App hiệu năng cao và chiến dịch truyền thông số đột phá.')

@section('content')
<!-- Custom Cursor for Portfolio Section (Desktop Only) -->
<div id="case-study-cursor" class="fixed pointer-events-none z-50 w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center font-headline text-xs font-bold shadow-2xl opacity-0 ring-4 ring-orange-400/35">
    <div class="flex items-center gap-0.5">
        <span>Xem</span>
        <span class="material-symbols-outlined text-[14px]">arrow_outward</span>
    </div>
</div>

<!-- ==================== 1. HERO SECTION (CINEMATIC TIMELINE & GSAP REVEAL) ==================== -->
<section class="relative w-full overflow-hidden bg-surface bg-dot-grid-subtle py-16 lg:py-24 border-b border-slate-200/80" id="hero-section">
    <!-- Ambient Studio Lighting -->
    <div class="absolute -top-24 right-0 w-[580px] h-[580px] rounded-full bg-gradient-to-br from-amber-400/15 via-primary/10 to-transparent blur-3xl pointer-events-none -mr-20"></div>
    <div class="absolute -bottom-32 left-10 w-[460px] h-[460px] rounded-full bg-gradient-to-tr from-sky-500/10 via-slate-300/10 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            <!-- Left Column: Editorial & Positioning -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                <!-- Eyebrow with REC Blink Pulse -->
                <div class="hero-fade-item inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-orange-50 border border-orange-200/80 text-primary corporate-eyebrow w-fit shadow-xs">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-primary animate-rec-pulse"></span>
                    <span>TRUYỀN THÔNG CỬU LONG &bull; CREATIVE PRODUCTION &times; DIGITAL TECHNOLOGY</span>
                </div>

                <!-- Main H1: Passes 5-Second Test Instantly -->
                <h1 class="corporate-heading text-3xl sm:text-4xl lg:text-[46px] lg:leading-[1.18] text-[#070F1E] font-extrabold tracking-tight">
                    <span class="hero-reveal-line block">Chúng tôi sản xuất hình ảnh</span>
                    <span class="hero-reveal-line block text-slate-800">và xây dựng nền tảng số</span>
                    <span class="hero-reveal-line block text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-amber-500">giúp thương hiệu tạo dấu ấn khác biệt.</span>
                </h1>

                <!-- Subtext: Clear, authoritative, mature -->
                <p class="hero-fade-item corporate-body text-base sm:text-lg text-slate-600 max-w-2xl leading-relaxed">
                    Tổ hợp chuyên sâu kết hợp năng lực sản xuất video điện ảnh và phát triển phần mềm số tại Cần Thơ &amp; ĐBSCL. Đồng hành từ chiến lược, kịch bản sáng tạo đến kiến trúc công nghệ vận hành chuẩn mực.
                </p>

                <!-- Dual Capability Paths (50/50 Balanced) -->
                <div class="hero-fade-item grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-1">
                    <!-- Path 1: Film & Video -->
                    <div class="p-4 rounded-2xl bg-white/95 border border-slate-200 shadow-xs hover:border-primary/40 transition-colors">
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-7 h-7 rounded-lg bg-orange-100 text-primary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[17px]">videocam</span>
                            </div>
                            <span class="corporate-eyebrow text-xs font-bold text-navy-base">FILM &amp; VIDEO PRODUCTION</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed">
                            TVC quảng cáo &bull; Phim doanh nghiệp &bull; Viral Video &bull; Event Recaps 4K
                        </p>
                    </div>

                    <!-- Path 2: Web & App Platform -->
                    <div class="p-4 rounded-2xl bg-white/95 border border-slate-200 shadow-xs hover:border-sky-500/40 transition-colors">
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-7 h-7 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[17px]">terminal</span>
                            </div>
                            <span class="corporate-eyebrow text-xs font-bold text-navy-base">WEB &amp; APP PLATFORM</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed">
                            Website doanh nghiệp &bull; Web Application &bull; Mobile App &bull; Cloud SaaS
                        </p>
                    </div>
                </div>

                <!-- CTA Actions with Magnetic Buttons -->
                <div class="hero-fade-item flex flex-wrap items-center gap-4 pt-2">
                    <a class="btn-primary-cta magnetic-btn" href="{{ route('contact') }}">
                        <span>Bắt đầu một dự án</span>
                        <span class="text-base leading-none">&nearr;</span>
                    </a>
                    <a class="btn-secondary-cta magnetic-btn" href="#showreel-section">
                        <span>Xem Showreel</span>
                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                    </a>
                </div>

                <!-- Verified Technical Badges -->
                <div class="hero-fade-item flex flex-wrap items-center gap-6 pt-4 border-t border-slate-200 text-slate-500 text-xs font-mono">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="font-semibold text-slate-700">4K/8K Cinema Workflow</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                        <span class="font-semibold text-slate-700">Enterprise Cloud Architecture</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <span class="font-semibold text-slate-700">Đội ngũ trực tiếp tại Cần Thơ</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Studio Console Mockup with Playhead & Waveform -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-lg rounded-3xl bg-[#081023] p-4 text-white shadow-2xl border border-white/15 overflow-hidden">
                    <!-- Top Window Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-white/10 text-xs text-slate-400 font-mono">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500/80 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block"></span>
                            <span class="ml-2 text-slate-300 font-semibold">CLM_STUDIO_MASTER.prproj</span>
                        </div>
                        <span class="px-2 py-0.5 rounded bg-white/10 text-[11px] text-amber-300 font-bold">4K DCI 24fps</span>
                    </div>

                    <!-- Video Preview Screen in Mockup -->
                    <div class="relative my-3 rounded-2xl overflow-hidden bg-black border border-white/10 aspect-video group">
                        <img class="w-full h-full object-cover opacity-85 group-hover:scale-105 transition-transform duration-700" alt="Cinematic Production Still" src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=1000&q=80"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30"></div>
                        
                        <!-- Center REC Tag -->
                        <div class="absolute top-3 left-3 flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-black/60 backdrop-blur-md text-[11px] font-mono text-white border border-white/15">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-rec-pulse"></span>
                            <span class="font-bold tracking-wider">REC</span>
                            <span class="text-slate-400">00:14:32:18</span>
                        </div>

                        <!-- Audio Waveform Visualization -->
                        <div class="absolute bottom-3 left-3 flex items-end gap-1 px-2.5 py-1.5 rounded-md bg-black/60 backdrop-blur-md border border-white/15">
                            <span class="text-[10px] font-mono text-slate-400 mr-1.5">AUDIO L/R</span>
                            <span class="w-1 bg-emerald-400 rounded-full wave-bar-1"></span>
                            <span class="w-1 bg-emerald-400 rounded-full wave-bar-2"></span>
                            <span class="w-1 bg-emerald-400 rounded-full wave-bar-3"></span>
                            <span class="w-1 bg-amber-400 rounded-full wave-bar-1"></span>
                            <span class="w-1 bg-primary rounded-full wave-bar-2"></span>
                        </div>

                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="w-12 h-12 rounded-full bg-primary/90 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-500/30">
                                <span class="material-symbols-outlined text-[24px] ml-0.5">play_arrow</span>
                            </div>
                        </div>
                    </div>

                    <!-- Studio Timeline Track with Animated Red Playhead -->
                    <div class="mt-3 p-3 rounded-xl bg-slate-900/90 border border-white/10 font-mono text-xs">
                        <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1.5">
                            <div class="flex items-center gap-2">
                                <span class="text-primary font-bold">V1:</span>
                                <span>Cinema_ColorGraded_Master.mov</span>
                            </div>
                            <span class="text-slate-300">00:02:45 / 00:03:00</span>
                        </div>

                        <!-- Timeline Track with Loop Playhead -->
                        <div class="relative w-full h-7 bg-slate-950 rounded-lg overflow-hidden border border-white/10 flex items-center px-1">
                            <!-- Track blocks -->
                            <div class="h-4 bg-orange-600/40 border border-orange-500/60 rounded w-1/3 mr-1 flex items-center justify-center text-[9px] text-orange-200">INTRO_4K</div>
                            <div class="h-4 bg-sky-600/40 border border-sky-500/60 rounded w-1/2 mr-1 flex items-center justify-center text-[9px] text-sky-200">MAIN_BODY</div>
                            <div class="h-4 bg-emerald-600/40 border border-emerald-500/60 rounded flex-1 flex items-center justify-center text-[9px] text-emerald-200">OUTRO</div>

                            <!-- Animated Playhead Line -->
                            <div class="animate-playhead absolute top-0 bottom-0 w-0.5 bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.9)] z-20 pointer-events-none">
                                <div class="w-2.5 h-2.5 bg-red-500 -ml-1 rotate-45 rounded-xs"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 2. SHOWREEL NỔI BẬT (DAVINCI CUSTOM PLAYER) ==================== -->
<!-- TODO: Cần cung cấp 1 khung hình BTS chuyên nghiệp, không chữ, ánh sáng studio rõ nét, độ phân giải tối thiểu 1920x1080, làm poster cho video showreel -->
<!-- TODO: Cần cung cấp video showreel chính thức 4K của Truyền Thông Cửu Long (định dạng MP4/WebM 1080p/4K, 30-60s) -->
<section class="w-full bg-[#070F1E] py-16 lg:py-24 text-white relative overflow-hidden border-b border-white/10 gsap-reveal-section" id="showreel-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10">
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/10 text-orange-400 font-mono text-xs font-bold border border-white/15 mb-3 shadow-sm">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-rec-pulse shadow-[0_0_8px_rgba(239,68,68,0.9)]"></span>
                <span>DAVINCI RESOLVE COLOR WORKFLOW</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white">
                Showreel Năng Lực Điện Ảnh &amp; Công Nghệ
            </h2>
            <p class="font-body text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Trải nghiệm chất lượng hình ảnh 4K DCI chuẩn điện ảnh với bộ điều khiển video mô phỏng DaVinci Resolve chuyên nghiệp.
            </p>
        </div>

        <!-- DaVinci-Style Full-Width Video Player Mockup -->
        <div id="showreel-container" class="relative w-full rounded-3xl overflow-hidden bg-black border border-white/15 shadow-[0_30px_80px_rgba(0,0,0,0.85),0_0_60px_rgba(234,88,12,0.2)] group">
            <div class="relative w-full aspect-video sm:aspect-[21/9] bg-black overflow-hidden flex items-center justify-center">
                <!-- Video Element with clean, text-free, cinematic BTS studio poster -->
                <video id="showreel-main-video" 
                       class="w-full h-full object-cover cursor-pointer" 
                       preload="metadata"
                       playsinline
                       poster="{{ asset('images/showreel-cinematic-poster.webp') }}">
                    <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4" type="video/mp4">
                    Trình duyệt của bạn không hỗ trợ phát video HTML5.
                </video>

                <!-- 72px Glassmorphism Play Button with Radiant Continuous Pulse Glow Loop -->
                <button id="showreel-center-play" 
                        aria-label="Phát video Showreel" 
                        class="absolute w-[72px] h-[72px] rounded-full bg-white/25 backdrop-blur-md border border-white/50 shadow-[0_0_35px_rgba(234,88,12,0.65),0_10px_25px_rgba(0,0,0,0.5)] flex items-center justify-center text-white hover:bg-white/35 hover:scale-110 active:scale-95 transition-all duration-300 z-20 cursor-pointer">
                    <!-- Expanding Radiant Pulse Glow Rings -->
                    <span class="absolute inset-0 rounded-full border-2 border-orange-500 animate-radiant-glow pointer-events-none"></span>
                    <span class="absolute -inset-2 rounded-full border border-amber-400 animate-radiant-glow-delay pointer-events-none"></span>
                    <span class="material-symbols-outlined text-[36px] text-white ml-1 filter drop-shadow-md">play_arrow</span>
                </button>

                <!-- Gradient Overlay: 90% black at bottom, 40% in lower third, transparent in middle/top -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/15 pointer-events-none"></div>

                <!-- Custom Scrubber & SMPTE Timecode Bar -->
                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 flex flex-col gap-3 bg-gradient-to-t from-[#070F1E] via-[#070F1E]/90 to-transparent z-20 transition-opacity duration-300">
                    <!-- Top Info: Cinematic Credit Line -->
                    <div class="flex items-center justify-between text-[10px] sm:text-[11px] font-mono tracking-wider text-white/70 uppercase select-none">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 inline-block shadow-[0_0_6px_rgba(245,158,11,0.8)]"></span>
                            <span>REEL 2026 — DIRECTED & PRODUCED BY TRUYỀN THÔNG CỬU LONG • SHOT ON RED 6K & SONY FX6 • GRADED IN DAVINCI RESOLVE</span>
                        </div>
                        <span class="hidden md:inline-block text-amber-300 font-bold">4K PRORES 422HQ &bull; 25FPS</span>
                    </div>

                    <!-- DaVinci Timeline Scrubber with SVG Audio Waveform -->
                    <div id="showreel-scrubber" class="davinci-scrubber-track w-full h-7 sm:h-8 relative cursor-pointer overflow-hidden rounded-lg bg-slate-950/80 border border-white/15">
                        <!-- Simulated Audio Waveform SVG Track -->
                        <svg class="davinci-waveform-bg" preserveAspectRatio="none" viewBox="0 0 500 28" fill="none">
                            <path d="M0 14 Q 5 6, 10 14 T 20 14 T 30 5 T 40 23 T 50 14 T 60 8 T 70 20 T 80 14 T 90 2 T 100 26 T 110 14 T 120 7 T 130 21 T 140 14 T 150 4 T 160 24 T 170 14 T 180 9 T 190 19 T 200 14 T 210 3 T 220 25 T 230 14 T 240 8 T 250 20 T 260 14 T 270 5 T 280 23 T 290 14 T 300 2 T 310 26 T 320 14 T 330 7 T 340 21 T 350 14 T 360 4 T 370 24 T 380 14 T 390 9 T 400 19 T 410 14 T 420 3 T 430 25 T 440 14 T 450 8 T 460 20 T 470 14 T 480 6 T 490 22 T 500 14" stroke="rgba(255,255,255,0.45)" stroke-width="1.6" />
                        </svg>

                        <!-- Progress Bar with Warm Amber Fill -->
                        <div id="showreel-progress-bar" class="davinci-scrubber-progress absolute top-0 bottom-0 left-0 bg-gradient-to-r from-primary/50 to-amber-400/50 w-0 pointer-events-none"></div>

                        <!-- Red Playhead Line with Triangular Top Indicator -->
                        <div id="showreel-playhead" class="davinci-playhead-line" style="left: 0%;">
                            <div class="davinci-playhead-cap"></div>
                        </div>
                    </div>

                    <!-- Player Controls Row -->
                    <div class="flex items-center justify-between text-xs font-mono text-slate-300 pt-1">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <!-- Play/Pause Toggle -->
                            <button id="showreel-play-toggle" aria-label="Bật/Tắt phát video" class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center text-white transition-colors">
                                <span id="showreel-play-icon" class="material-symbols-outlined text-[18px]">play_arrow</span>
                            </button>
                            
                            <!-- SMPTE Timecode Display (25fps) -->
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500 animate-rec-pulse"></span>
                                <span id="showreel-timecode" class="text-white font-bold tracking-wider text-[11px] sm:text-xs">00:00:00:00 / 00:03:45:00</span>
                            </div>
                        </div>

                        <!-- Right Controls: Audio Volume & Fullscreen -->
                        <div class="flex items-center gap-3">
                            <!-- Volume Group with Reveal Slider on Hover -->
                            <div class="group/vol relative flex items-center">
                                <button id="showreel-mute-btn" aria-label="Bật/Tắt âm thanh" class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center text-white transition-colors">
                                    <span id="showreel-mute-icon" class="material-symbols-outlined text-[18px]">volume_off</span>
                                </button>
                                <!-- Volume Slider (reveals smoothly on hover) -->
                                <div class="hidden sm:flex items-center w-0 overflow-hidden group-hover/vol:w-20 group-hover/vol:ml-2 transition-all duration-300">
                                    <input id="showreel-volume-slider" type="range" min="0" max="1" step="0.05" value="0" aria-label="Âm lượng video" class="w-16 h-1.5 accent-primary bg-white/30 rounded-lg cursor-pointer">
                                </div>
                            </div>

                            <!-- Fullscreen Button -->
                            <button id="showreel-fullscreen-btn" aria-label="Toàn màn hình" class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center text-white transition-colors">
                                <span class="material-symbols-outlined text-[18px]">fullscreen</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Film Credits Footer Bar -->
            <div class="px-6 py-3.5 bg-[#050B16] border-t border-white/10 flex flex-wrap items-center justify-between text-xs text-slate-400 font-mono gap-4">
                <div class="flex flex-wrap items-center gap-5 sm:gap-6 text-[11px]">
                    <div><span class="text-slate-500">DIRECTOR:</span> <span class="text-slate-200 font-semibold">Truyền Thông Cửu Long Creative Dept</span></div>
                    <div><span class="text-slate-500">DOP:</span> <span class="text-slate-200 font-semibold">Cinema Unit ĐBSCL</span></div>
                    <div><span class="text-slate-500">COLOR GRADE:</span> <span class="text-amber-400 font-semibold">DaVinci ACES Workflow</span></div>
                </div>
                <div class="text-slate-500 text-[11px]">
                    &copy; 2026 TRUYỀN THÔNG CỬU LONGNOLOGY STUDIO
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 3. DẢI LOGO ĐỐI TÁC (SEAMLESS INFINITE MARQUEE) ==================== -->
<section class="w-full bg-slate-50 border-b border-slate-200/80 py-6 overflow-hidden" id="marquee-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-3">
        <div class="flex items-center justify-center gap-3 text-center">
            <span class="h-px w-8 bg-slate-300"></span>
            <p class="font-mono text-xs font-bold uppercase tracking-widest text-slate-500">
                Đối Tác Chiến Lược &bull; Khách Hàng Đồng Hành Cùng Truyền Thông Cửu Long
            </p>
            <span class="h-px w-8 bg-slate-300"></span>
        </div>
    </div>

    <!-- Infinite Scrolling Marquee Track (Pause on Hover) -->
    <div class="marquee-container relative w-full overflow-hidden flex">
        <div class="marquee-track flex items-center gap-12 sm:gap-16 shrink-0 py-2">
            <!-- Real Partners from Old Database -->
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                <span>HOYA LENS VIETNAM</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-sky-600"></span>
                <span>SACOMBANK KHỐI SỐ</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                <span>KREDIVO VIETNAM</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                <span>RAKUS VIETNAM</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>VNPT CẦN THƠ</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>VIETTEL SOLUTIONS</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                <span>VINAMILK MEKONG</span>
            </div>

            <!-- Duplicated items for seamless infinite loop -->
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                <span>HOYA LENS VIETNAM</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-sky-600"></span>
                <span>SACOMBANK KHỐI SỐ</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                <span>KREDIVO VIETNAM</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                <span>RAKUS VIETNAM</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>VNPT CẦN THƠ</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>VIETTEL SOLUTIONS</span>
            </div>
            <div class="flex items-center gap-2 font-headline font-bold text-slate-600 text-sm tracking-wide opacity-80 hover:opacity-100 transition-opacity">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                <span>VINAMILK MEKONG</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 4. QUY TRÌNH LÀM VIỆC — 2 NGÀNH, 1 CHUẨN MỰC ==================== -->
<!-- TODO: Cung cấp 2 ảnh RAW và Color Graded cùng góc máy chất lượng cao (1920x1080) -->
<section class="w-full bg-surface bg-dot-grid-subtle py-20 lg:py-28 relative border-b border-slate-200/80 gsap-reveal-section" id="workflow-section" x-data="{ activeTab: 'media' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100/70 text-primary font-mono text-xs font-bold border border-orange-200 mb-3">
                <span class="material-symbols-outlined text-[15px]">account_tree</span>
                <span>STANDARDIZED DELIVERY PIPELINE</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Hai Ngành Riêng Biệt &bull; Một Chuẩn Mực Thực Thi
            </h2>
            <p class="font-body text-slate-600 text-base sm:text-lg mt-4 leading-relaxed">
                Mọi dự án tại Truyền Thông Cửu Long đều tuân thủ quy trình kiểm soát chất lượng 6 bước nghiêm ngặt, minh bạch từng mốc nghiệm thu.
            </p>

            <!-- 2-Tab Switcher -->
            <div class="inline-flex p-1.5 rounded-full bg-slate-200/80 border border-slate-300 mt-8 shadow-inner">
                <button @click="activeTab = 'media'" 
                        :class="activeTab === 'media' ? 'bg-primary text-white shadow-md' : 'text-slate-600 hover:text-navy-base'"
                        class="px-6 py-2.5 rounded-full font-headline text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">videocam</span>
                    <span>Quy Trình Sản Xuất Phim / Video</span>
                </button>
                <button @click="activeTab = 'tech'" 
                        :class="activeTab === 'tech' ? 'bg-navy-base text-white shadow-md' : 'text-slate-600 hover:text-navy-base'"
                        class="px-6 py-2.5 rounded-full font-headline text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">terminal</span>
                    <span>Quy Trình Phát Triển Web / App</span>
                </button>
            </div>
        </div>

        <!-- Tab 1: Film / Video Production Pipeline -->
        <div x-show="activeTab === 'media'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-12">
            <!-- 6-Step Visual Timeline Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Step 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 01</span>
                        <span class="material-symbols-outlined text-slate-400">lightbulb</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Khảo Sát &amp; Định Hướng Kịch Bản</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phân tích đề bài, chân dung khách hàng mục tiêu, thông điệp cốt lõi và xây dựng concept kịch bản đạo diễn chi tiết.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 02</span>
                        <span class="material-symbols-outlined text-slate-400">draw</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Storyboard &amp; Tiền Kỳ Chi Tiết</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Vẽ phân cảnh storyboard, chọn bối cảnh, tuyển diễn viên, chuẩn bị thiết bị điện ảnh và lập kế hoạch quay shooting schedule.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 03</span>
                        <span class="material-symbols-outlined text-slate-400">movie</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Tác Nghiệp Bấm Máy Hiện Trường</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Ghi hình với chuẩn 4K/8K RAW, hệ thống ánh sáng cinema, âm thanh thu trực tiếp chuyên nghiệp và flycam khảo sát góc cao.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 04</span>
                        <span class="material-symbols-outlined text-slate-400">cut</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Dựng Phim Thô &amp; Tinh Chỉnh Nhịp</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Lắp ráp các cảnh quay theo kịch bản đạo diễn, căn chỉnh nhịp độ cảm xúc, biên tập âm nhạc nền và hiệu ứng âm thanh SFX.
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 05</span>
                        <span class="material-symbols-outlined text-slate-400">palette</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Color Grading Chuẩn ACES / DaVinci</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Chỉnh màu điện ảnh trên màn hình chuyên dụng chuẩn REC.709/DCI-P3, tạo sắc thái điện ảnh độc quyền cho thương hiệu.
                    </p>
                </div>

                <!-- Step 6 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 06</span>
                        <span class="material-symbols-outlined text-slate-400">verified</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Xuất Bản Master &amp; Bàn Giao Bản Quyền</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Xuất file ProRes 422HQ và các định dạng tối ưu đa nền tảng (TikTok, YouTube, Facebook, TV Broadcast) kèm toàn quyền thương mại.
                    </p>
                </div>
            </div>

            <!-- Interactive Before / After Color Grading Slider -->
            <div class="p-6 sm:p-8 rounded-3xl bg-[#081023] text-white border border-white/15 shadow-xl">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div>
                        <h4 class="font-headline text-lg font-bold text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-400">tune</span>
                            <span>Trải Nghiệm Thực Tế: Sức Mạnh Chỉnh Màu Điện Ảnh (Color Grade)</span>
                        </h4>
                        <p class="font-body text-xs text-slate-300 mt-1">
                            Kéo thanh trượt ngang để so sánh giữa khung hình RAW nguyên bản và bản hoàn thiện màu sắc điện ảnh.
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-white/10 font-mono text-xs text-amber-300 border border-white/15">
                        60fps Hardware Accelerated
                    </span>
                </div>

                <!-- Slider Container -->
                <div id="color-grade-slider" class="slider-container relative w-full h-[280px] sm:h-[420px] rounded-2xl overflow-hidden shadow-2xl border border-white/20" style="--slider-pos: 50%;">
                    <!-- Before Image (RAW Flat Log Profile) -->
                    <img class="slider-before-img absolute inset-0 w-full h-full object-cover select-none" 
                         alt="Sony S-Log3 RAW Flat Profile before color grading" 
                         src="https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=1600&q=80"/>

                    <!-- After Image (Color Graded Master) -->
                    <div id="slider-after-wrapper" class="slider-after-wrapper absolute inset-0 w-full h-full overflow-hidden select-none">
                        <img class="slider-after-img absolute inset-0 w-full h-full object-cover select-none" 
                             alt="DaVinci Resolve Cinematic Color Graded Master 4K" 
                             src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=1600&q=80"/>
                    </div>

                    <!-- Labels -->
                    <div class="absolute top-4 left-4 z-20 px-3 py-1 rounded-md bg-black/70 backdrop-blur-md text-white font-mono text-xs font-bold border border-white/20">
                        ORIGINAL S-LOG3 RAW
                    </div>
                    <div class="absolute top-4 right-4 z-20 px-3 py-1 rounded-md bg-primary/90 backdrop-blur-md text-white font-mono text-xs font-bold border border-white/20">
                        DAVINCI GRADED MASTER
                    </div>

                    <!-- Draggable Handle Divider -->
                    <div id="slider-handle-line" 
                         tabindex="0" 
                         role="slider" 
                         aria-label="So sánh màu sắc hình ảnh" 
                         aria-valuemin="0" 
                         aria-valuemax="100" 
                         aria-valuenow="50" 
                         class="slider-handle absolute top-0 bottom-0 z-30 cursor-ew-resize flex items-center justify-center pointer-events-auto">
                        <div class="w-10 h-10 rounded-full bg-white text-navy-base flex items-center justify-center shadow-[0_0_20px_rgba(0,0,0,0.5)] border-2 border-primary">
                            <span class="material-symbols-outlined text-[20px]">drag_indicator</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2: Tech & Platform Engineering Pipeline -->
        <div x-show="activeTab === 'tech'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-12">
            <!-- 6-Step Visual Timeline Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Step 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 01</span>
                        <span class="material-symbols-outlined text-slate-400">terminal</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Khảo Sát &amp; Kiến Trúc Hệ Thống</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phân tích yêu cầu nghiệp vụ, thiết kế cơ sở dữ liệu quan hệ, lựa chọn tech stack và bảo mật hệ thống theo tiêu chuẩn OWASP.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 02</span>
                        <span class="material-symbols-outlined text-slate-400">devices</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Thiết Kế UI/UX &amp; Design System</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Xây dựng wireframe tương tác, thiết kế giao diện Figma chuẩn thương hiệu, tối ưu trải nghiệm người dùng trên Mobile First.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 03</span>
                        <span class="material-symbols-outlined text-slate-400">code</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Lập Trình Frontend &amp; Backend API</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phát triển code sạch trên Laravel / Node.js / React / Vue, tích hợp cổng thanh toán, CRM và các dịch vụ bên thứ ba an toàn.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 04</span>
                        <span class="material-symbols-outlined text-slate-400">speed</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Tối Ưu Hiệu Năng &amp; SEO Technical</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tối ưu Core Web Vitals (Lighthouse 90+), cấu trúc schema JSON-LD, nén ảnh thế hệ mới WebP/AVIF và cấu hình CDN Cloudflare.
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 05</span>
                        <span class="material-symbols-outlined text-slate-400">verified_user</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Kiểm Thử Tải &amp; Bảo Mật Toàn Diện</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Stress-testing chịu tải hàng nghìn kết nối đồng thời, rà soát lỗ hổng SQLi/XSS/CSRF trước khi đưa vào môi trường staging.
                    </p>
                </div>

                <!-- Step 6 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 06</span>
                        <span class="material-symbols-outlined text-slate-400">cloud_done</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Triển Khai Cloud &amp; Bảo Trì 24/7</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Đóng gói Docker, cấu hình CI/CD tự động lên AWS / Cloud Server, sao lưu dữ liệu định kỳ mỗi ngày và hỗ trợ kỹ thuật liên tục.
                    </p>
                </div>
            </div>

            <!-- Interactive Code Typewriter Terminal Mockup -->
            <div class="p-6 sm:p-8 rounded-3xl bg-[#081023] text-white border border-white/15 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-white/10 text-xs font-mono text-slate-400 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="ml-2 text-slate-300 font-bold">routes/api.php &bull; TruyenThongCuuLong Tech Engine</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded bg-white/10 text-emerald-400 text-[11px] font-bold">Production Ready</span>
                </div>
                <div class="bg-black/60 p-5 rounded-2xl border border-white/10 font-mono text-xs sm:text-sm text-emerald-400 overflow-x-auto min-h-[140px] flex items-center">
                    <div class="flex items-center">
                        <span class="text-slate-500 mr-3 select-none">$</span>
                        <code id="code-typewriter-target" class="text-slate-200"></code>
                        <span class="typewriter-cursor inline-block w-2 h-4 bg-primary ml-1"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 5. CÔNG NGHỆ & THIẾT BỊ THỰC CHIẾN ==================== -->
<!-- LƯU Ý KỸ THUẬT: Thiết bị và công nghệ được triển khai trực tiếp cho các dự án khách hàng -->
<section class="w-full bg-[#081023] text-white py-20 lg:py-28 relative border-b border-white/10 gsap-reveal-section" id="tech-gear-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 text-amber-400 font-mono text-xs font-bold border border-white/15 mb-3">
                <span class="material-symbols-outlined text-[16px]">precision_manufacturing</span>
                <span>PRODUCTION HARDWARE &amp; SOFTWARE STACK</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white">
                Vũ Khí Thực Chiến: Thiết Bị &amp; Công Nghệ
            </h2>
            <p class="font-body text-slate-300 text-sm sm:text-base mt-4 leading-relaxed">
                Trang thiết bị ghi hình chuyên dụng, cơ động bắt trọn mọi khoảnh khắc đám cưới, tiệc, sự kiện, hội nghị kết hợp nền tảng website, ứng dụng số và WordPress tối ưu hiệu năng, chi phí.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Gear Column: Event, Wedding & Conference Filming Hardware -->
            <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md flex flex-col gap-6">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-500/20 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[24px]">videocam</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-lg font-bold text-white">Thiết Bị Ghi Hình &amp; Sự Kiện</h3>
                            <p class="text-xs text-slate-400 font-mono">Quay phim đám cưới, quay tiệc &amp; hội nghị tại Cần Thơ, Miền Tây</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-orange-500/20 text-orange-300 font-mono text-xs font-bold">4K &bull; Sự Kiện</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-primary font-bold">MÁY QUAY SỰ KIỆN &amp; CƯỚI HỎI</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">Sony A7 IV &bull; A7S III &bull; FX30</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Quay phóng sự cưới, tiệc, hội nghị 4K sắc nét, bắt nét tự động</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-amber-400 font-bold">ỐNG KÍNH ĐA DỤNG &amp; CHÂN DUNG</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">Sony G Master &amp; Tamron f/2.8</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Zoom 24-70mm &bull; 70-200mm, bắt trọn góc rộng &amp; cảm xúc</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-sky-400 font-bold">CHỐNG RUNG &amp; FLYCAM TOÀN CẢNH</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">DJI Ronin RS3 / RS4 &bull; Flycam 4K</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Gimbal chống rung mượt mà, flycam bắt trọn lễ rước dâu &amp; hội nghị</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-emerald-400 font-bold">ÂM THANH &amp; ÁNH SÁNG SÂN KHẤU</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">Wireless Mic &bull; Đèn LED Cơ Động</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Rode / DJI Mic thu âm đại biểu, MC &amp; lễ đường, đèn LED trợ sáng</div>
                    </div>
                </div>
            </div>

            <!-- Tech Column: Website, WordPress & App Platform Stack -->
            <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md flex flex-col gap-6">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[24px]">cloud</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-lg font-bold text-white">Nền Tảng Website &amp; Ứng Dụng Số</h3>
                            <p class="text-xs text-slate-400 font-mono">Công nghệ phát triển website doanh nghiệp, tin tức &amp; web app</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-sky-500/20 text-sky-300 font-mono text-xs font-bold">Linh Hoạt &amp; Tối Ưu</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-sky-400 font-bold">BACKEND &amp; CMS</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">WordPress &bull; Laravel &bull; PHP &bull; Node.js</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">CMS doanh nghiệp chuẩn SEO, RESTful API &bull; Web App linh hoạt</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-emerald-400 font-bold">FRONTEND &amp; UI</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">Tailwind CSS &bull; Alpine.js &bull; React</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Hiệu năng mượt mà, tối ưu tốc độ tải và trải nghiệm di động</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-amber-400 font-bold">DATABASE &amp; CACHE</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">MySQL &bull; PostgreSQL &bull; Redis</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Lưu trữ an toàn, truy vấn siêu tốc, vận hành ổn định bền bỉ</div>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="font-mono text-xs text-rose-400 font-bold">HẠ TẦNG &amp; VẬN HÀNH</div>
                        <div class="text-sm font-semibold text-slate-200 mt-1">Cloud Hosting &bull; AWS &bull; Cloudflare</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Bảo mật SSL, tăng tốc CDN toàn cầu, sao lưu tự động &bull; Uptime 99.9%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 6. BA TRỤ CỘT NĂNG LỰC CỐT LÕI (PILLARS) ==================== -->
<section class="w-full bg-surface bg-dot-grid-subtle py-20 lg:py-28 relative gsap-reveal-section" id="services-pillars">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100/70 text-primary font-mono text-xs font-bold border border-orange-200 mb-3">
                <span class="material-symbols-outlined text-[16px]">category</span>
                <span>COMPREHENSIVE DIGITAL CAPABILITIES</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Ba Trụ Cột Năng Lực Cốt Lõi
            </h2>
            <p class="font-body text-slate-600 text-base sm:text-lg mt-4 leading-relaxed">
                Sự kết hợp hoàn hảo giữa năng lực sản xuất nội dung thị giác đỉnh cao, nền tảng công nghệ số vững chắc và chiến dịch truyền thông lan tỏa đa kênh.
            </p>
        </div>

        <!-- 3 Pillar Cards Grid with Hover Glow & Elevation -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Pillar 1: Media Production -->
            <div class="pillar-card pillar-card-media group p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-orange-100 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">videocam</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-primary tracking-wider uppercase">01 &bull; SẢN XUẤT HÌNH ẢNH</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Sản Xuất Video &amp; Phim Điện Ảnh
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Phim giới thiệu doanh nghiệp, TVC quảng cáo 4K, video viral đa nền tảng, phim tài liệu và ghi hình sự kiện doanh nghiệp quy mô lớn.
                    </p>

                    <ul class="flex flex-col gap-2.5 pt-4 border-t border-slate-100 text-xs font-medium text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[17px]">check_circle</span>
                            <span>TVC Quảng Cáo &amp; Viral Commercial 4K</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[17px]">check_circle</span>
                            <span>Phim Doanh Nghiệp &amp; Hồ Sơ Năng Lực Số</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[17px]">check_circle</span>
                            <span>Flycam &amp; Ghi Hình Team Building Sự Kiện</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-6 relative z-10">
                    <a href="{{ route('services.index') }}#media" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết dịch vụ Media</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar 2: Technology & Platforms -->
            <div class="pillar-card pillar-card-tech group p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">terminal</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-sky-600 tracking-wider uppercase">02 &bull; GIẢI PHÁP CÔNG NGHỆ</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-sky-600 transition-colors">
                        Phát Triển Web &amp; Nền Tảng Số
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Thiết kế Website doanh nghiệp chuẩn SEO, ứng dụng web/app hiệu năng cao, sàn thương mại điện tử và hệ thống quản trị chuyên biệt.
                    </p>

                    <ul class="flex flex-col gap-2.5 pt-4 border-t border-slate-100 text-xs font-medium text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sky-600 text-[17px]">check_circle</span>
                            <span>Website Doanh Nghiệp Chuẩn Senior SEO</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sky-600 text-[17px]">check_circle</span>
                            <span>Web Application &amp; Mobile App Tùy Biến</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sky-600 text-[17px]">check_circle</span>
                            <span>Tối Ưu Tốc Độ &amp; Bảo Mật Cloud Server</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-6 relative z-10">
                    <a href="{{ route('services.index') }}#technology" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-sky-600 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết dịch vụ Tech</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar 3: Digital Marketing & Media Growth -->
            <div class="pillar-card pillar-card-ads group p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">campaign</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-amber-600 tracking-wider uppercase">03 &bull; TRUYỀN THÔNG TĂNG TRƯỞNG</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">
                        Marketing Số &amp; Chiến Dịch PR
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Tư vấn chiến lược truyền thông tổng thể, quản trị kênh mạng xã hội, booking báo chí truyền hình và quảng cáo hiệu năng tối ưu doanh số.
                    </p>

                    <ul class="flex flex-col gap-2.5 pt-4 border-t border-slate-100 text-xs font-medium text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[17px]">check_circle</span>
                            <span>Dịch Vụ SEO Tổng Thể Cần Thơ &amp; Toàn Quốc</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[17px]">check_circle</span>
                            <span>Booking Báo Chí, Đài Truyền Hình ĐBSCL</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[17px]">check_circle</span>
                            <span>Quản Trị Fanpage &amp; Xây Kênh TikTok Doanh Nghiệp</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-6 relative z-10">
                    <a href="{{ route('services.index') }}#marketing" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-amber-600 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết dịch vụ Marketing</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 7. SỐ LIỆU THỐNG KÊ (GSAP SCROLLTRIGGER COUNTER) ==================== -->
<section class="w-full bg-white py-14 border-b border-slate-200/80 gsap-reveal-section" id="stats-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Stat 1: 10+ Years -->
            <div class="flex flex-col items-center text-center p-4">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[26px]">calendar_today</span>
                </div>
                <div class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="10" data-suffix="+">10+</span>
                </div>
                <p class="font-body text-xs sm:text-sm text-slate-600 mt-2 font-medium">Năm kinh nghiệm thực chiến</p>
            </div>

            <!-- Stat 2: 850+ Projects -->
            <div class="flex flex-col items-center text-center p-4">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[26px]">task_alt</span>
                </div>
                <div class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="850" data-suffix="+">850+</span>
                </div>
                <p class="font-body text-xs sm:text-sm text-slate-600 mt-2 font-medium">Dự án &amp; chiến dịch thành công</p>
            </div>

            <!-- Stat 3: 320+ Clients -->
            <div class="flex flex-col items-center text-center p-4">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[26px]">apartment</span>
                </div>
                <div class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="320" data-suffix="+">320+</span>
                </div>
                <p class="font-body text-xs sm:text-sm text-slate-600 mt-2 font-medium">Khách hàng doanh nghiệp</p>
            </div>

            <!-- Stat 4: 99.2% On-time -->
            <div class="flex flex-col items-center text-center p-4">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[26px]">verified</span>
                </div>
                <div class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="99.2" data-suffix="%">99.2%</span>
                </div>
                <p class="font-body text-xs sm:text-sm text-slate-600 mt-2 font-medium">Nghiệm thu đúng tiến độ</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 8. SỰ KẾT HỢP ĐỘC BẢN (SPOTLIGHT MOUSE OVERLAY) ==================== -->
<section class="w-full bg-[#070F1E] bg-dot-grid-dark py-20 lg:py-28 text-white relative overflow-hidden border-b border-white/10 gsap-reveal-section" id="why-clm">
    <!-- Interactive Mouse Spotlight Overlay -->
    <div class="spotlight-overlay"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 text-amber-400 font-mono text-xs font-bold border border-white/15 mb-3">
                <span class="material-symbols-outlined text-[16px]">stars</span>
                <span>THE UNIQUE ADVANTAGE</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white">
                Sự Kết Hợp Độc Bản: Điện Ảnh &times; Công Nghệ
            </h2>
            <p class="font-body text-slate-300 text-base sm:text-lg mt-4 leading-relaxed">
                Tại sao các thương hiệu hàng đầu chọn Truyền Thông Cửu Long thay vì thuê riêng lẻ từng đơn vị?
            </p>
        </div>

        <!-- 4 Why-Cards Grid with Stagger Reveal -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="why-card p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md flex flex-col gap-3 hover:border-primary/50 transition-all">
                <div class="w-12 h-12 rounded-xl bg-orange-500/20 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">hub</span>
                </div>
                <h3 class="font-headline text-lg font-bold text-white">Đồng Bộ Toàn Diện</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">
                    Từ kịch bản video, phong cách hình ảnh đến giao diện website đều xuất phát từ một tầm nhìn thương hiệu duy nhất, không bị phân mảnh.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="why-card p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md flex flex-col gap-3 hover:border-sky-500/50 transition-all">
                <div class="w-12 h-12 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">speed</span>
                </div>
                <h3 class="font-headline text-lg font-bold text-white">Tối Ưu Thời Gian &amp; Chi Phí</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">
                    Tiết kiệm đến 35% ngân sách so với việc thuê đồng thời studio quay phim và công ty phần mềm riêng rẽ.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="why-card p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md flex flex-col gap-3 hover:border-amber-500/50 transition-all">
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">pin_drop</span>
                </div>
                <h3 class="font-headline text-lg font-bold text-white">Am Hiểu Bản Địa ĐBSCL</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">
                    Trụ sở tại Cần Thơ, thấu hiểu tâm lý khách hàng miền Tây, sẵn sàng có mặt tại hiện trường tác nghiệp trong vòng 2 giờ.
                </p>
            </div>

            <!-- Card 4 -->
            <div class="why-card p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md flex flex-col gap-3 hover:border-emerald-500/50 transition-all">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">security</span>
                </div>
                <h3 class="font-headline text-lg font-bold text-white">Bảo Hành &amp; Đồng Hành Dài Hạn</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">
                    Hợp đồng pháp lý minh bạch, bàn giao đầy đủ mã nguồn và bản quyền video, bảo trì hệ thống công nghệ 24/7.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 9. DỰ ÁN TIÊU BIỂU & MINH CHỨNG NĂNG LỰC (PORTFOLIO) ==================== -->
<!-- TODO: Yêu cầu quản trị viên bổ sung tư liệu ảnh/video 4K full-res cho các dự án khách hàng nếu cần -->
<section class="w-full bg-slate-50 py-20 lg:py-28 gsap-reveal-section border-b border-slate-200/80" id="portfolio-section" x-data="{ currentFilter: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100/70 text-primary font-mono text-xs font-bold border border-orange-200 mb-3">
                    <span class="material-symbols-outlined text-[16px]">folder_special</span>
                    <span>VERIFIED CLIENT SHOWCASE</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                    Dự Án Tiêu Biểu &amp; Minh Chứng Năng Lực
                </h2>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Dữ liệu thực tế từ các chiến dịch truyền thông, phim sự kiện và nền tảng số đã được Truyền Thông Cửu Long bàn giao cho các đối tác uy tín.
                </p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex items-center gap-2 p-1.5 rounded-full bg-slate-200/80 border border-slate-300 self-start md:self-auto shadow-inner">
                <button @click="currentFilter = 'all'" 
                        :class="currentFilter === 'all' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                        class="px-4 py-1.5 rounded-full font-headline text-xs font-bold transition-all">
                    Tất Cả
                </button>
                <button @click="currentFilter = 'media'" 
                        :class="currentFilter === 'media' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                        class="px-4 py-1.5 rounded-full font-headline text-xs font-bold transition-all">
                    Sản Xuất Video
                </button>
                <button @click="currentFilter = 'tech'" 
                        :class="currentFilter === 'tech' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                        class="px-4 py-1.5 rounded-full font-headline text-xs font-bold transition-all">
                    Web &amp; Nền Tảng Số
                </button>
            </div>
        </div>

        <!-- Portfolio Showcase Grid -->
        <div class="portfolio-grid-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Real Project 1: Hoya Lens Việt Nam (ID 14068) -->
            <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                 class="video-hover-card project-item group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="h-60 w-full relative overflow-hidden bg-black">
                    <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                         alt="Team Building Hoya Lens tại Mũi Né" 
                         src="{{ asset('storage/uploads/2023/07/hoya-viet-nam-team-building-phan-thiet-2023.jpg') }}"
                         onerror="this.src='https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=800&q=80'"/>
                    
                    <div class="absolute top-3.5 left-3.5">
                        <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/20">
                            Team Building &bull; Flycam 4K
                        </span>
                    </div>
                    <div class="absolute bottom-3.5 right-3.5 px-2 py-0.5 rounded bg-black/70 backdrop-blur-md text-white font-mono text-[10px] border border-white/20">
                        Phan Thiết / Mũi Né
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30">
                            <span class="material-symbols-outlined text-[24px]">play_arrow</span>
                        </div>
                    </div>
                </div>
                <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded bg-orange-100 text-primary font-mono text-[10px] font-bold">Client: Hoya Lens</span>
                            <span class="text-xs text-slate-400 font-mono">07/2023</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Hoya Lens Việt Nam &bull; Team Building &amp; Gala Mũi Né
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                            Sản xuất video recap toàn diện, flycam khảo sát góc máy toàn cảnh bãi biển Mũi Né kết hợp ghi hình highlight đêm gala dinner.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                        <span>4K DCI &bull; 60fps</span>
                        <span class="text-primary font-bold">Xem Chi Tiết &rarr;</span>
                    </div>
                </div>
            </div>

            <!-- Real Project 2: Tất Niên Kredivo tại TP.HCM (ID 14064) -->
            <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                 class="video-hover-card project-item group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="h-60 w-full relative overflow-hidden bg-black">
                    <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                         alt="Tất Niên Kredivo tại TP.HCM" 
                         src="{{ asset('storage/uploads/2024/01/Tat-nien-kredivo-2024.jpg') }}"
                         onerror="this.src='https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80'"/>
                    
                    <div class="absolute top-3.5 left-3.5">
                        <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/20">
                            Year-End Party &bull; Cinema Recap
                        </span>
                    </div>
                    <div class="absolute bottom-3.5 right-3.5 px-2 py-0.5 rounded bg-black/70 backdrop-blur-md text-white font-mono text-[10px] border border-white/20">
                        TP. Hồ Chí Minh
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30">
                            <span class="material-symbols-outlined text-[24px]">play_arrow</span>
                        </div>
                    </div>
                </div>
                <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded bg-orange-100 text-primary font-mono text-[10px] font-bold">Client: Kredivo</span>
                            <span class="text-xs text-slate-400 font-mono">01/2024</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Tất Niên Kredivo &bull; Dạ Tiệc Tri Ân Đỉnh Cao
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                            Bắt trọn những khoảnh khắc cảm xúc bùng nổ, visual lighting sân khấu hoành tráng và âm thanh stereo sống động.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                        <span>Multi-Camera &bull; S-Log3</span>
                        <span class="text-primary font-bold">Xem Chi Tiết &rarr;</span>
                    </div>
                </div>
            </div>

            <!-- Real Project 3: Rakus Việt Nam tại Nha Trang (ID 13905) -->
            <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                 class="video-hover-card project-item group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="h-60 w-full relative overflow-hidden bg-black">
                    <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                         alt="Gala Dinner Rakus tại Nha Trang" 
                         src="{{ asset('storage/uploads/2024/06/Rakus-Nha-Trang-team-building.jpg') }}"
                         onerror="this.src='https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80'"/>
                    
                    <div class="absolute top-3.5 left-3.5">
                        <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/20">
                            Corporate Gala &bull; Team Building
                        </span>
                    </div>
                    <div class="absolute bottom-3.5 right-3.5 px-2 py-0.5 rounded bg-black/70 backdrop-blur-md text-white font-mono text-[10px] border border-white/20">
                        Nha Trang
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30">
                            <span class="material-symbols-outlined text-[24px]">play_arrow</span>
                        </div>
                    </div>
                </div>
                <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded bg-orange-100 text-primary font-mono text-[10px] font-bold">Client: RAKUS</span>
                            <span class="text-xs text-slate-400 font-mono">06/2024</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            RAKUS Việt Nam &bull; Team Building &amp; Gala Dinner Nha Trang
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                            Ghi lại hành trình gắn kết văn hóa doanh nghiệp Nhật Bản với hình ảnh biển xanh cát trắng rực rỡ và hoạt động bãi biển gắn kết.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                        <span>DaVinci Color &bull; 4K</span>
                        <span class="text-primary font-bold">Xem Chi Tiết &rarr;</span>
                    </div>
                </div>
            </div>

            <!-- Real Project 4: Sacombank Khối Ngân Hàng Số (ID 13902) -->
            <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                 class="video-hover-card project-item group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="h-60 w-full relative overflow-hidden bg-black">
                    <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                         alt="Team Building Sacombank Khối Ngân Hàng Số" 
                         src="{{ asset('storage/uploads/2024/06/teambuilding-sacombank-Nha-trang.jpg') }}"
                         onerror="this.src='https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=800&q=80'"/>
                    
                    <div class="absolute top-3.5 left-3.5">
                        <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/20">
                            Ngân Hàng Số &bull; Teambuilding
                        </span>
                    </div>
                    <div class="absolute bottom-3.5 right-3.5 px-2 py-0.5 rounded bg-black/70 backdrop-blur-md text-white font-mono text-[10px] border border-white/20">
                        Nha Trang / Cần Thơ
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30">
                            <span class="material-symbols-outlined text-[24px]">play_arrow</span>
                        </div>
                    </div>
                </div>
                <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-[10px] font-bold">Client: SACOMBANK</span>
                            <span class="text-xs text-slate-400 font-mono">06/2024</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Sacombank Khối Ngân Hàng Số &bull; Chiến Dịch Vươn Khơi
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                            Đồng hành ghi hình chuỗi sự kiện truyền cảm hứng của khối ngân hàng số với phong cách quay năng động, hiện đại.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                        <span>Flycam &bull; 4K 10-Bit</span>
                        <span class="text-primary font-bold">Xem Chi Tiết &rarr;</span>
                    </div>
                </div>
            </div>

            <!-- Tech Showcase 1: Enterprise Web Platform (Live Preview Scroll) -->
            <div x-show="currentFilter === 'all' || currentFilter === 'tech'" 
                 class="project-item group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="web-preview-scroll-container h-60 w-full relative overflow-hidden bg-slate-100">
                    <img class="web-preview-scroll-img w-full object-cover" 
                         alt="Nền tảng quản trị phân phối thương mại điện tử" 
                         src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80"/>
                    
                    <div class="absolute top-3.5 left-3.5 z-10">
                        <span class="px-2.5 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-sky-400 font-mono text-[10px] font-bold border border-sky-400/30">
                            Enterprise SaaS &bull; Cloud ERP
                        </span>
                    </div>
                    <div class="absolute bottom-3.5 right-3.5 z-10 px-2 py-0.5 rounded bg-emerald-950/80 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                        Hover để xem cuộn trang
                    </div>
                </div>
                <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-[10px] font-bold">Tech Platform</span>
                            <span class="text-xs text-slate-400 font-mono">Laravel &bull; Vue.js</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Hệ Thống Phân Phối &amp; Quản Trị Chuỗi Cung Ứng Mekong
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                            Kiến trúc microservices xử lý hơn 50.000 đơn hàng/ngày, đồng bộ tồn kho thời gian thực với độ trễ dưới 200ms.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                        <span>Lighthouse 98/100</span>
                        <a href="{{ route('projects.index') }}" class="text-sky-600 font-bold">Xem Case Study &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Tech Showcase 2: High-Performance Corporate Portal -->
            <div x-show="currentFilter === 'all' || currentFilter === 'tech'" 
                 class="project-item group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="web-preview-scroll-container h-60 w-full relative overflow-hidden bg-slate-100">
                    <img class="web-preview-scroll-img w-full object-cover" 
                         alt="Cổng thông tin doanh nghiệp xuất khẩu thủy sản" 
                         src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80"/>
                    
                    <div class="absolute top-3.5 left-3.5 z-10">
                        <span class="px-2.5 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-sky-400 font-mono text-[10px] font-bold border border-sky-400/30">
                            Corporate Portal &bull; Multi-Language
                        </span>
                    </div>
                    <div class="absolute bottom-3.5 right-3.5 z-10 px-2 py-0.5 rounded bg-emerald-950/80 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                        Hover để xem cuộn trang
                    </div>
                </div>
                <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-[10px] font-bold">Export Portal</span>
                            <span class="text-xs text-slate-400 font-mono">Full-Stack Cloud</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Cổng Thông Tin Tập Đoàn Thủy Hải Sản Xuất Khẩu
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                            Giao diện đa ngôn ngữ (Anh - Nhật - Việt), tích hợp tra cứu chứng từ điện tử và chuẩn bảo mật doanh nghiệp quốc tế.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                        <span>Global CDN &bull; SSL</span>
                        <a href="{{ route('projects.index') }}" class="text-sky-600 font-bold">Xem Case Study &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 10. HẬU TRƯỜNG SẢN XUẤT THỰC TẾ (BENTO GRID) ==================== -->
<!-- TODO: Yêu cầu quản trị viên bổ sung thêm ảnh hậu trường tác nghiệp thực tế của ekip Truyền Thông Cửu Long -->
<section class="w-full bg-slate-100 py-20 lg:py-28 relative border-b border-slate-200/80 gsap-reveal-section" id="bts-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white text-primary font-mono text-xs font-bold border border-slate-200 shadow-xs mb-3">
                <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                <span>AUTHENTIC FIELD OPERATIONS</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Hậu Trường Sản Xuất &amp; Tác Nghiệp Thực Tế
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Những khoảnh khắc chân thực phía sau ống kính của ekip Truyền Thông Cửu Long trên khắp mọi miền đất nước: từ bãi biển Mũi Né, Nha Trang đến các phim trường và trung tâm dữ liệu tại Cần Thơ, TP.HCM.
            </p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 auto-rows-[220px]">
            <!-- Bento 1: Large Feature (Span 2 cols, 2 rows) -->
            <div class="sm:col-span-2 sm:row-span-2 group relative rounded-3xl overflow-hidden bg-black border border-slate-200 shadow-sm">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Ekip Truyền Thông Cửu Long ghi hình hiện trường với máy quay điện ảnh Sony FX6" 
                     src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=1200&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <span class="px-2.5 py-0.5 rounded-full bg-primary text-white font-mono text-[10px] font-bold uppercase">Phim Trường Thực Tế</span>
                    <h3 class="font-headline text-xl sm:text-2xl font-bold text-white mt-2">
                        Ekip Vận Hành Máy Quay Điện Ảnh Sony FX3/FX6 &bull; Bối Cảnh TVC
                    </h3>
                    <p class="font-body text-xs text-slate-300 mt-1 line-clamp-2">
                        Đội ngũ kỹ thuật viên ánh sáng và đạo diễn hình ảnh phối hợp trực tiếp tại phim trường.
                    </p>
                </div>
            </div>

            <!-- Bento 2: Flycam Operation -->
            <div class="group relative rounded-3xl overflow-hidden bg-black border border-slate-200 shadow-sm">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Flycam khảo sát bãi biển Mũi Né" 
                     src="https://images.unsplash.com/photo-1527977966376-1c8408f9f108?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <span class="px-2 py-0.5 rounded bg-black/60 text-amber-300 font-mono text-[9px] font-bold">DJI Aerial 4K</span>
                    <h4 class="font-headline text-sm font-bold text-white mt-1">Flycam Tác Nghiệp Bãi Biển Mũi Né</h4>
                </div>
            </div>

            <!-- Bento 3: Color Grading Suite -->
            <div class="group relative rounded-3xl overflow-hidden bg-black border border-slate-200 shadow-sm">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Phòng chỉnh màu DaVinci Resolve" 
                     src="https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <span class="px-2 py-0.5 rounded bg-black/60 text-orange-300 font-mono text-[9px] font-bold">Studio Color Suite</span>
                    <h4 class="font-headline text-sm font-bold text-white mt-1">Phòng Hậu Kỳ &amp; Chỉnh Màu DaVinci</h4>
                </div>
            </div>

            <!-- Bento 4: Tech Engineering Room -->
            <div class="group relative rounded-3xl overflow-hidden bg-black border border-slate-200 shadow-sm">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Đội ngũ kỹ sư phần mềm Truyền Thông Cửu Long" 
                     src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <span class="px-2 py-0.5 rounded bg-black/60 text-sky-300 font-mono text-[9px] font-bold">Tech Lab Cần Thơ</span>
                    <h4 class="font-headline text-sm font-bold text-white mt-1">Đội Kỹ Sư Lập Trình &amp; Đám Mây</h4>
                </div>
            </div>

            <!-- Bento 5: Sound & Interview Record -->
            <div class="group relative rounded-3xl overflow-hidden bg-black border border-slate-200 shadow-sm">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Thu âm phỏng vấn hiện trường chuyên nghiệp" 
                     src="https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <span class="px-2 py-0.5 rounded bg-black/60 text-emerald-300 font-mono text-[9px] font-bold">Pro Audio Unit</span>
                    <h4 class="font-headline text-sm font-bold text-white mt-1">Thu Âm Phỏng Vấn &amp; Tiếng Hiện Trường</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 11. BÀI VIẾT & KINH NGHIỆM THỰC TẾ (INSIGHTS) ==================== -->
<section class="w-full bg-white py-20 lg:py-28 border-b border-slate-200/80 gsap-reveal-section" id="insights-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100/70 text-primary font-mono text-xs font-bold border border-orange-200 mb-3">
                    <span class="material-symbols-outlined text-[16px]">menu_book</span>
                    <span>PRACTICAL INSIGHTS &amp; EXPERTISE</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                    Bài Viết &amp; Kinh Nghiệm Thực Tế
                </h2>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Chia sẻ kiến thức chuyên sâu về sản xuất video, kỹ thuật SEO Google, kiến trúc công nghệ web và chiến lược truyền thông số.
                </p>
            </div>

            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-headline font-bold text-primary hover:text-orange-600 transition-colors self-start md:self-auto">
                <span>Xem tất cả bài viết</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <!-- Articles Grid (Dynamic from Database) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($featuredArticles as $article)
            <article class="group flex flex-col rounded-3xl bg-slate-50 border border-slate-200/80 overflow-hidden hover:shadow-xl hover:border-primary/40 transition-all duration-300">
                <div class="h-48 w-full relative overflow-hidden bg-slate-200">
                    @if($article->thumbnail)
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             alt="{{ $article->title }}" 
                             src="{{ asset('storage/' . $article->thumbnail) }}"
                             onerror="this.src='https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80'"/>
                    @else
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             alt="{{ $article->title }}" 
                             src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80"/>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/20">
                            {{ $article->category->name ?? 'Kiến Thức Chuyên Ngành' }}
                        </span>
                    </div>
                </div>

                <div class="p-6 flex flex-col justify-between flex-1 gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400 mb-2">
                            <span>{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') : 'Mới cập nhật' }}</span>
                            <span>&bull;</span>
                            <span>Truyền Thông Cửu Long Editorial</span>
                        </div>
                        <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2">
                            <a href="{{ url('/bai-viet/' . $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-2 line-clamp-3 leading-relaxed">
                            {{ $article->summary ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                        </p>
                    </div>

                    <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs font-headline font-bold text-primary">
                        <span>Đọc tiếp</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 py-12 text-center text-slate-500 font-mono text-sm">
                Đang cập nhật các bài viết mới từ hệ thống...
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ==================== 12. CTA BAND CUỐI TRANG (FLOWING GRADIENT & LIGHT STREAKS) ==================== -->
<section class="w-full relative overflow-hidden py-20 lg:py-24 bg-gradient-to-r from-navy-base via-primary to-accent-coral animate-gradient-flow text-white gsap-reveal-section" id="cta-contact">
    <!-- Light Streaks flying across background -->
    <div class="light-streak"></div>
    <div class="light-streak light-streak-delay"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 flex flex-col items-center gap-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-white font-mono text-xs font-bold shadow-sm">
            <span class="material-symbols-outlined text-[16px]">rocket_launch</span>
            <span>SẴN SÀNG TẠO NÊN DẤU ẤN ĐỘT PHÁ?</span>
        </div>

        <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white max-w-3xl leading-tight">
            Hãy Cùng Truyền Thông Cửu Long Biến Tầm Nhìn Thương Hiệu Thành Hiện Thực
        </h2>

        <p class="font-body text-white/90 text-base sm:text-lg max-w-2xl leading-relaxed">
            Cho dù bạn cần một bộ phim TVC chuẩn điện ảnh chạm đến trái tim hàng triệu khán giả hay một nền tảng công nghệ số chịu tải hàng triệu người dùng &mdash; chúng tôi luôn sẵn sàng lắng nghe và tư vấn giải pháp tối ưu.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a class="btn-primary-cta magnetic-btn inline-flex items-center gap-2 px-9 py-4 rounded-full bg-white text-navy-base font-headline text-sm font-bold shadow-[0_10px_30px_rgba(0,0,0,0.25)] hover:bg-slate-100 hover:scale-105 transition-all" href="{{ route('contact') }}">
                <span>Bắt Đầu Một Dự Án</span>
                <span class="material-symbols-outlined text-[19px] text-primary">arrow_forward</span>
            </a>
            <a class="btn-secondary-cta magnetic-btn inline-flex items-center gap-2 px-8 py-4 rounded-full bg-navy-base/60 backdrop-blur-md text-white font-headline text-sm font-semibold border border-white/30 hover:bg-navy-base/80 hover:border-white transition-all" href="tel:0908888256">
                <span class="material-symbols-outlined text-amber-400 text-[19px]">call</span>
                <span>Hotline: 0908 888 256</span>
            </a>
        </div>
    </div>
</section>
@endsection