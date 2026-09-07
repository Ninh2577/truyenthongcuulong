@extends('layouts.app')

@section('title', 'Cửu Long Media & Technology - Creative Production Studio & Tech Agency')
@section('meta_description', 'Creative Production Studio & Enterprise Tech Agency hàng đầu. Sản xuất Video TVC 4K chuẩn điện ảnh, giải pháp Web/App hiệu năng cao và chiến dịch truyền thông số đột phá.')

@section('content')
<!-- Custom Cursor for Portfolio Section (Desktop) -->
<div id="case-study-cursor" class="fixed pointer-events-none z-50 w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center font-headline text-xs font-bold shadow-2xl opacity-0 ring-4 ring-orange-400/35">
    <div class="flex items-center gap-0.5">
        <span>Xem</span>
        <span class="material-symbols-outlined text-[14px]">arrow_outward</span>
    </div>
</div>

<!-- ==================== 1. HERO SECTION (PHASE 3: CORPORATE 5-SECOND TEST) ==================== -->
<section class="relative w-full overflow-hidden bg-surface bg-dot-grid-subtle py-16 lg:py-24 border-b border-slate-200/80" id="hero-section">
    <!-- Subtle Ambient Lighting -->
    <div class="absolute -top-24 right-0 w-[580px] h-[580px] rounded-full bg-gradient-to-br from-amber-400/15 via-primary/10 to-transparent blur-3xl pointer-events-none -mr-20"></div>
    <div class="absolute -bottom-32 left-10 w-[460px] h-[460px] rounded-full bg-gradient-to-tr from-sky-500/10 via-slate-300/10 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            <!-- Hero Left Column: Editorial & Conversion Focused -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                <!-- Eyebrow: Company Identity & Dual Capabilities -->
                <div class="hero-fade-item inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-orange-50 border border-orange-200/80 text-primary corporate-eyebrow w-fit shadow-xs">
                    <span class="inline-block w-2 h-2 rounded-full bg-primary animate-rec-pulse"></span>
                    <span>CUU LONG MEDIA &amp; TECH &bull; CREATIVE PRODUCTION &times; DIGITAL TECHNOLOGY</span>
                </div>

                <!-- Main H1: Passes 5-Second Test Instantly -->
                <h1 class="corporate-heading text-3xl sm:text-4xl lg:text-[46px] lg:leading-[1.18] text-[#070F1E] font-extrabold tracking-tight">
                    <span class="hero-reveal-line block">Chúng tôi sản xuất hình ảnh</span>
                    <span class="hero-reveal-line block text-slate-800">và xây dựng nền tảng số</span>
                    <span class="hero-reveal-line block text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-amber-500">giúp thương hiệu tạo dấu ấn khác biệt.</span>
                </h1>

                <!-- Subtext: Clear, mature, authoritative -->
                <p class="hero-fade-item corporate-body text-base sm:text-lg text-slate-600 max-w-2xl leading-relaxed">
                    Tổ hợp chuyên sâu kết hợp năng lực sản xuất video điện ảnh và phát triển phần mềm số tại Cần Thơ &amp; ĐBSCL. Đồng hành từ chiến lược, kịch bản sáng tạo đến kiến trúc công nghệ vận hành chuẩn mực.
                </p>

                <!-- Dual Capability Paths (50/50 Balanced Representation) -->
                <div class="hero-fade-item grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-1">
                    <!-- Path 1: Film & Video -->
                    <div class="p-4 rounded-2xl bg-white/95 border border-slate-200 shadow-xs hover:border-primary/40 transition-colors">
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-7 h-7 rounded-lg bg-orange-100 text-primary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[17px]">videocam</span>
                            </div>
                            <span class="corporate-eyebrow text-xs font-bold text-navy-base">FILM &amp; VIDEO</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed">
                            TVC &bull; Commercial &bull; Corporate Film &bull; Social Video 4K
                        </p>
                    </div>

                    <!-- Path 2: Web & App -->
                    <div class="p-4 rounded-2xl bg-white/95 border border-slate-200 shadow-xs hover:border-sky-500/40 transition-colors">
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-7 h-7 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[17px]">terminal</span>
                            </div>
                            <span class="corporate-eyebrow text-xs font-bold text-navy-base">WEB &amp; APP</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed">
                            Website &bull; Web Application &bull; Mobile App &bull; Digital Platform
                        </p>
                    </div>
                </div>

                <!-- Standardized CTAs: Exactly 2 Choices -->
                <div class="hero-fade-item flex flex-wrap items-center gap-4 pt-2">
                    <a class="btn-primary-cta" href="{{ route('contact') }}">
                        <span>Bắt đầu một dự án</span>
                        <span class="text-base leading-none">&nearr;</span>
                    </a>
                    <a class="btn-secondary-cta" href="#selected-work">
                        <span>Xem dự án</span>
                        <span class="material-symbols-outlined text-[18px]">south</span>
                    </a>
                </div>

                <!-- Verified Technical Capabilities (No Fake Numbers) -->
                <div class="hero-fade-item flex flex-wrap items-center gap-6 pt-4 border-t border-slate-200 text-slate-500 text-xs font-mono">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="font-semibold text-slate-700">4K/8K Cinema Workflow</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                        <span class="font-semibold text-slate-700">Full-Stack Cloud Architecture</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <span class="font-semibold text-slate-700">Đội ngũ kỹ thuật trực tiếp tại Cần Thơ</span>
                    </div>
                </div>
            </div>

            <!-- Hero Right Column: Clean, Restrained Cinema Timeline Mockup (Zero Clutter) -->
            <div class="lg:col-span-5 relative flex justify-center items-center">
                <!-- Soft backdrop ambient halo -->
                <div class="absolute w-72 h-72 sm:w-[420px] sm:h-[420px] rounded-full bg-gradient-to-tr from-orange-500/15 via-amber-500/10 to-sky-600/10 blur-3xl pointer-events-none"></div>

                <!-- Main Realistic Cinema Timeline Mockup -->
                <div class="relative w-full max-w-[480px] rounded-3xl bg-[#070F1E] border border-slate-700/80 shadow-[0_24px_60px_rgba(7,15,30,0.45),0_0_30px_rgba(234,88,12,0.12)] overflow-hidden">
                    <!-- Window Topbar -->
                    <div class="px-4 py-3 bg-[#0B132B] border-b border-white/10 flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-rose-500/90"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-amber-400/90"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500/90"></div>
                            <span class="ml-2 text-[10px] font-mono text-slate-400">CuuLong_Studio_Master &bull; 4K Timeline</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] font-mono px-2 py-0.5 rounded bg-orange-500/20 text-orange-400 border border-orange-500/30 font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-rec-pulse"></span> REC 4K RAW
                        </div>
                    </div>

                    <!-- Viewport Screen (Hero LCP Element: fetchpriority="high", no lazy) -->
                    <div class="relative h-48 w-full bg-black overflow-hidden group">
                        <img class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-500" alt="Hậu trường sản xuất phim quảng cáo và nền tảng số Cửu Long Media & Tech" fetchpriority="high" src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/20 pointer-events-none"></div>
                        
                        <!-- Center Play Glyph -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-primary/90 backdrop-blur-md text-white flex items-center justify-center shadow-[0_0_24px_rgba(234,88,12,0.8)] ring-4 ring-orange-500/30 hover:scale-110 transition-transform cursor-pointer">
                                <span class="material-symbols-outlined text-[24px] fill ml-0.5">play_arrow</span>
                            </div>
                        </div>

                        <!-- Monitor Overlay Meta -->
                        <div class="absolute bottom-2.5 left-3 px-2.5 py-1 rounded bg-black/75 backdrop-blur-md text-[10px] font-mono text-white flex items-center gap-1.5 border border-white/10">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> 00:02:14:18 / 3840&times;2160
                        </div>
                        <div class="absolute bottom-2.5 right-3 px-2 py-1 rounded bg-black/75 backdrop-blur-md text-[10px] font-mono text-amber-400 border border-white/10">
                            DaVinci Color Studio
                        </div>
                    </div>

                    <!-- Timeline Workspace -->
                    <div class="p-3.5 bg-[#050B16] flex flex-col gap-2.5 relative">
                        <!-- Playhead (15s continuous sweep) -->
                        <div class="animate-playhead absolute top-0 bottom-0 w-[2px] bg-red-500 z-20 pointer-events-none shadow-[0_0_8px_rgba(239,68,68,0.9)]">
                            <div class="w-2.5 h-2.5 bg-red-500 rotate-45 -ml-1 -top-1 absolute shadow-sm"></div>
                        </div>

                        <!-- Timecode Marks -->
                        <div class="flex justify-between text-[9px] font-mono text-slate-500 px-1 border-b border-white/5 pb-1">
                            <span>00:00:00</span>
                            <span>00:01:00</span>
                            <span>00:02:00</span>
                            <span>00:03:00</span>
                            <span>00:04:00</span>
                        </div>

                        <!-- Video Track V2: Cine Master Clips -->
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] font-mono text-slate-400 w-5">V2</span>
                            <div class="flex-1 h-5 rounded bg-slate-800/90 border border-slate-700/80 flex items-center gap-1 px-1.5 overflow-hidden">
                                <div class="h-3.5 w-1/4 rounded bg-orange-600/80 text-[8px] font-mono text-white flex items-center px-1 truncate">RED_Cam_01</div>
                                <div class="h-3.5 w-1/3 rounded bg-amber-600/80 text-[8px] font-mono text-white flex items-center px-1 truncate">Drone_Mavic3</div>
                                <div class="h-3.5 w-1/3 rounded bg-rose-600/80 text-[8px] font-mono text-white flex items-center px-1 truncate">Sony_FX6</div>
                            </div>
                        </div>

                        <!-- Video Track V1: UI & VFX Layer -->
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] font-mono text-slate-400 w-5">V1</span>
                            <div class="flex-1 h-5 rounded bg-slate-800/90 border border-slate-700/80 flex items-center gap-1 px-1.5 overflow-hidden">
                                <div class="h-3.5 w-1/2 rounded bg-indigo-600/70 text-[8px] font-mono text-white flex items-center px-1 truncate">Web_Platform_UI</div>
                                <div class="h-3.5 w-1/2 rounded bg-sky-600/70 text-[8px] font-mono text-white flex items-center px-1 truncate">ColorGrade_LUT</div>
                            </div>
                        </div>

                        <!-- Audio Track A1: Live jumping audio waveform bars -->
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] font-mono text-slate-400 w-5">A1</span>
                            <div class="flex-1 h-6 rounded bg-emerald-950/50 border border-emerald-800/50 flex items-center justify-between px-2 overflow-hidden">
                                <div class="flex items-center gap-1 h-full w-full py-1">
                                    <span class="wave-bar-1 w-0.5 h-3 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-2 w-0.5 h-4 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-3 w-0.5 h-2 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-1 w-0.5 h-5 bg-emerald-300 rounded-full inline-block"></span>
                                    <span class="wave-bar-2 w-0.5 h-3 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-3 w-0.5 h-4 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-1 w-0.5 h-2 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-2 w-0.5 h-5 bg-emerald-300 rounded-full inline-block"></span>
                                    <span class="wave-bar-3 w-0.5 h-3 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-1 w-0.5 h-4 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-2 w-0.5 h-2 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-3 w-0.5 h-5 bg-emerald-300 rounded-full inline-block"></span>
                                    <span class="wave-bar-1 w-0.5 h-3 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-2 w-0.5 h-4 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-3 w-0.5 h-2 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-1 w-0.5 h-5 bg-emerald-300 rounded-full inline-block"></span>
                                    <span class="wave-bar-2 w-0.5 h-3 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-3 w-0.5 h-4 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-1 w-0.5 h-2 bg-emerald-400/90 rounded-full inline-block"></span>
                                    <span class="wave-bar-2 w-0.5 h-5 bg-emerald-300 rounded-full inline-block"></span>
                                    <span class="wave-bar-3 w-0.5 h-3 bg-emerald-400/90 rounded-full inline-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 2. SHOWREEL NỔI BẬT (DAVINCI CUSTOM PLAYER) ==================== -->
<!-- TODO: REAL COMPANY DATA REQUIRED: Cần cung cấp video showreel chính thức của Cửu Long Media & Tech (định dạng MP4/WebM 1080p/4K, 30-60s) -->
<!-- TODO: REAL COMPANY DATA REQUIRED: Cần cung cấp file phụ đề .vtt hoặc transcript cho video showreel -->
<section class="w-full bg-[#070F1E] py-16 lg:py-24 text-white relative overflow-hidden border-b border-white/10 gsap-reveal-section" id="showreel-section">
    <!-- Ambient Studio Lights -->
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/25 text-amber-400 text-xs font-mono font-bold tracking-wider uppercase mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-rec-pulse"></span>
                    SHOWREEL 2026 &bull; CỬU LONG MEDIA &amp; TECH
                </div>
                <h2 class="corporate-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Đỉnh Cao Ngôn Ngữ Hình Ảnh &amp; Năng Lực Điện Ảnh
                </h2>
            </div>
            <p class="corporate-body text-sm sm:text-base text-slate-400 max-w-md leading-relaxed">
                Từng khung hình được chế tác với máy quay RED 6K, hệ ống kính cine cao cấp và hệ thống cân chỉnh màu DaVinci Resolve Studio 32-bit float.
            </p>
        </div>

        <!-- Custom Cinema Video Player Container -->
        <div id="showreel-container" class="relative w-full rounded-3xl overflow-hidden bg-black border border-white/15 shadow-[0_25px_60px_rgba(0,0,0,0.6),0_0_50px_rgba(234,88,12,0.15)] group">
            <!-- Aspect Ratio 21:9 on Desktop, 16:9 on Mobile -->
            <div class="relative w-full aspect-[16/9] lg:aspect-[21/9] bg-black overflow-hidden">
                <!-- HTML5 Native Video Tag with Lazy loading & Preload None for Performance -->
                <video id="main-showreel-video"
                       class="w-full h-full object-cover"
                       preload="none"
                       poster="https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=1600&q=80"
                       playsinline
                       muted
                       aria-label="Cửu Long Media &amp; Tech Showreel Reel Video">
                    <source src="https://assets.mixkit.co/videos/preview/mixkit-set-of-plateaus-seen-from-the-sky-in-a-sunset-26070-large.mp4" type="video/mp4"/>
                    Trình duyệt của bạn không hỗ trợ thẻ video HTML5.
                </video>

                <!-- Big Centered Play Trigger Button (visible when paused) -->
                <button id="showreel-big-play" 
                        aria-label="Phát Showreel Video"
                        class="absolute inset-0 flex items-center justify-center bg-black/40 hover:bg-black/20 transition-colors z-20 group/play">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-primary/90 text-white flex items-center justify-center shadow-[0_0_40px_rgba(234,88,12,0.8)] ring-4 ring-orange-500/40 group-hover/play:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[40px] sm:text-[48px] fill ml-1">play_arrow</span>
                    </div>
                </button>

                <!-- DaVinci Color Grading Scrubber Controls Bar (Bottom Overlay) -->
                <div class="absolute bottom-0 left-0 right-0 z-30 p-4 sm:p-6 bg-gradient-to-t from-black/95 via-black/70 to-transparent flex flex-col gap-3 opacity-90 group-hover:opacity-100 transition-opacity">
                    <!-- DaVinci Waveform Timeline Scrubber Track -->
                    <div id="showreel-scrubber" class="davinci-scrubber-track w-full">
                        <div id="showreel-progress-bar" class="davinci-scrubber-progress">
                            <div class="davinci-playhead-indicator"></div>
                        </div>
                    </div>

                    <!-- Controls Row & Film Credit Line -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs font-mono">
                        <!-- Play/Pause & Timecode -->
                        <div class="flex items-center gap-3">
                            <button id="showreel-play-toggle" aria-label="Bật/Tắt phát video" class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center text-white transition-colors">
                                <span id="showreel-play-icon" class="material-symbols-outlined text-[18px]">play_arrow</span>
                            </button>

                            <!-- DaVinci SMPTE Timecode HH:MM:SS:FF -->
                            <div class="flex items-center gap-1.5 px-2.5 py-1 rounded bg-black/60 border border-white/10 text-amber-400 font-bold">
                                <span class="material-symbols-outlined text-[14px] text-slate-400">timer</span>
                                <span id="showreel-timecode">00:00:00:00 / 00:00:00:00</span>
                            </div>

                            <button id="showreel-mute-btn" aria-label="Bật/Tắt âm thanh" class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center text-white transition-colors">
                                <span id="showreel-mute-icon" class="material-symbols-outlined text-[18px]">volume_off</span>
                            </button>
                        </div>

                        <!-- Film Credit Line -->
                        <div class="text-[11px] text-slate-400 font-mono tracking-wider truncate">
                            <span class="text-amber-400 font-semibold">CỬU LONG STUDIOS</span> &mdash; SHOT ON RED KOMODO 6K &amp; SONY FX6 &bull; GRADED IN DAVINCI RESOLVE
                        </div>

                        <!-- Fullscreen -->
                        <div class="flex items-center gap-2">
                            <button id="showreel-fullscreen-btn" aria-label="Toàn màn hình" class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center text-white transition-colors">
                                <span class="material-symbols-outlined text-[18px]">fullscreen</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 3. DẢI LOGO ĐỐI TÁC (SEAMLESS INFINITE MARQUEE) ==================== -->
<section class="w-full bg-slate-50 border-b border-slate-200/80 py-6 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-3">
        <p class="text-center font-mono text-xs uppercase tracking-widest text-slate-500 font-bold">
            Tiêu Chuẩn Thiết Bị Điện Ảnh &amp; Nền Tảng Công Nghệ Đồng Hành
        </p>
    </div>

    <div class="marquee-container relative w-full overflow-hidden">
        <div class="absolute left-0 top-0 bottom-0 w-20 sm:w-36 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-20 sm:w-36 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>

        <div class="marquee-track flex items-center gap-12 py-2">
            <!-- First set of partner marks -->
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-600 flex items-center justify-center text-white text-[11px] font-black">RED</div>
                <span>RED DIGITAL CINEMA</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-slate-900 flex items-center justify-center text-white text-[11px] font-black">SONY</div>
                <span>SONY CINEMA LINE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-indigo-700 flex items-center justify-center text-white text-[11px] font-black">BMD</div>
                <span>DAVINCI RESOLVE STUDIO</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-500 flex items-center justify-center text-white text-[11px] font-black">LAR</div>
                <span>LARAVEL ENTERPRISE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-sky-500 flex items-center justify-center text-white text-[11px] font-black">REA</div>
                <span>REACT &amp; TYPESCRIPT</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-orange-500 flex items-center justify-center text-white text-[11px] font-black">AWS</div>
                <span>AMAZON WEB SERVICES</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-emerald-600 flex items-center justify-center text-white text-[11px] font-black">DJI</div>
                <span>DJI RONIN &amp; MAVIC CINE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-amber-500 flex items-center justify-center text-white text-[11px] font-black">APU</div>
                <span>APUTURE LIGHTING</span>
            </div>

            <!-- Duplicate set for infinite seamless loop -->
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-600 flex items-center justify-center text-white text-[11px] font-black">RED</div>
                <span>RED DIGITAL CINEMA</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-slate-900 flex items-center justify-center text-white text-[11px] font-black">SONY</div>
                <span>SONY CINEMA LINE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-indigo-700 flex items-center justify-center text-white text-[11px] font-black">BMD</div>
                <span>DAVINCI RESOLVE STUDIO</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-500 flex items-center justify-center text-white text-[11px] font-black">LAR</div>
                <span>LARAVEL ENTERPRISE</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 4. QUY TRÌNH THỰC HIỆN KÉP (FILM & TECH WORKFLOW) ==================== -->
<section class="w-full bg-surface py-20 lg:py-28 border-b border-slate-200/80 gsap-reveal-section" id="workflow" x-data="{ activeTab: 'media' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="corporate-eyebrow text-primary mb-2">
                    END-TO-END METHODOLOGY &amp; WORKFLOW
                </div>
                <h2 class="corporate-heading text-3xl sm:text-4xl lg:text-5xl text-navy-base tracking-tight">
                    Quy Trình Triển Khai Minh Bạch &amp; Chuẩn Hóa
                </h2>
            </div>

            <!-- Tab Switcher (Film vs Tech) -->
            <div class="flex items-center bg-slate-200/70 p-1.5 rounded-full border border-slate-300 w-fit" role="tablist">
                <button type="button"
                        role="tab"
                        aria-label="Xem quy trình sản xuất video điện ảnh"
                        :aria-selected="activeTab === 'media'"
                        @click="activeTab = 'media'"
                        :class="activeTab === 'media' ? 'bg-primary text-white shadow-sm' : 'text-slate-700 hover:text-navy-base'"
                        class="px-5 py-2 rounded-full font-headline text-xs sm:text-sm font-bold transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[17px]">movie</span>
                    <span>Sản Xuất Video (6 Bước)</span>
                </button>
                <button type="button"
                        role="tab"
                        aria-label="Xem quy trình kỹ thuật lập trình phần mềm"
                        :aria-selected="activeTab === 'tech'"
                        @click="activeTab = 'tech'"
                        :class="activeTab === 'tech' ? 'bg-navy-base text-white shadow-sm' : 'text-slate-700 hover:text-navy-base'"
                        class="px-5 py-2 rounded-full font-headline text-xs sm:text-sm font-bold transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[17px]">code</span>
                    <span>Kỹ Thuật Web/App (6 Bước)</span>
                </button>
            </div>
        </div>

        <!-- TAB 1: FILM PRODUCTION PIPELINE -->
        <div x-show="activeTab === 'media'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-14">
            <!-- 6-Step Horizontal Pipeline Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-5">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-orange-100 text-primary font-mono text-xs font-bold flex items-center justify-center">01</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">lightbulb</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Khám Phá &amp; Ý Tưởng</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Nghiên cứu đối tượng mục tiêu, thông điệp cốt lõi và định hình concept sáng tạo tổng thể.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-orange-100 text-primary font-mono text-xs font-bold flex items-center justify-center">02</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">edit_note</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Kịch Bản &amp; Storyboard</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Phát triển kịch bản văn học, kịch bản phân cảnh chi tiết từng góc máy và moodboard hình ảnh.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-orange-100 text-primary font-mono text-xs font-bold flex items-center justify-center">03</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">videocam</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Bấm Máy Ghi Hình</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Sản xuất thực địa với máy quay RED 6K, hệ thống ánh sáng cinema và flycam chuyên dụng.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-2xl p-5 border border-primary/40 shadow-xs flex flex-col gap-3 relative ring-2 ring-orange-400/20 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-primary text-white font-mono text-xs font-bold flex items-center justify-center">04</span>
                        <span class="material-symbols-outlined text-primary text-[20px]">palette</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Dựng &amp; Color Grade</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Dựng nhịp điệu trên Premiere, cân chỉnh màu điện ảnh chuyên sâu trên DaVinci Resolve.</p>
                </div>

                <!-- Step 5 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-orange-100 text-primary font-mono text-xs font-bold flex items-center justify-center">05</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">graphic_eq</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Sound Design &amp; VFX</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Xử lý âm thanh Foley, lồng tiếng, kỹ xảo 3D CGI và Motion Graphic sống động.</p>
                </div>

                <!-- Step 6 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-mono text-xs font-bold flex items-center justify-center">06</span>
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">verified</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Master &amp; Đa Nền Tảng</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Xuất file ProRes 422 HQ tiêu chuẩn phát sóng và các tỷ lệ 16:9, 9:16 cho Social Media.</p>
                </div>
            </div>

            <!-- Interactive Before/After Color Grading Comparison Component -->
            <div class="bg-navy-base rounded-3xl p-6 sm:p-10 text-white border border-slate-700/70 shadow-2xl">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
                    <div>
                        <div class="inline-flex items-center gap-2 text-amber-400 text-xs font-mono font-bold uppercase mb-2">
                            <span class="material-symbols-outlined text-[16px]">tune</span>
                            NĂNG LỰC COLOR GRADING CHUYÊN NGHIỆP
                        </div>
                        <h3 class="corporate-heading text-2xl sm:text-3xl text-white">
                            So Sánh Thực Tế: S-Log3 Flat RAW vs Final Color Grade
                        </h3>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-md font-body leading-relaxed">
                        Kéo thanh trượt để so sánh giữa khung hình thô phẳng (dải dynamic range 16 stops) và màu sắc điện ảnh hoàn thiện sau khi xử lý trên bàn máy DaVinci Resolve Studio.
                    </p>
                </div>

                <!-- Slider Box -->
                <div id="color-grade-slider" class="slider-container relative w-full h-[320px] sm:h-[480px] rounded-2xl overflow-hidden shadow-2xl border border-white/20" style="--slider-pos: 50%;">
                    <!-- Before Layer (RAW / Flat S-Log3) - Full width in background -->
                    <div class="absolute inset-0 w-full h-full bg-slate-900">
                        <img class="w-full h-full object-cover filter saturate-50 contrast-75 brightness-110" alt="Ảnh RAW S-Log3 chưa qua chỉnh màu" src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=1600&q=80"/>
                        <div class="absolute top-4 left-4 z-10 px-3.5 py-1.5 rounded-full bg-black/70 backdrop-blur-md text-slate-200 text-xs font-mono font-bold border border-white/20 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                            <span>RAW S-Log3 Flat (Chưa Chỉnh Màu)</span>
                        </div>
                    </div>

                    <!-- After Layer (Final Color Graded) - Clipped dynamically by width -->
                    <div id="slider-after-wrapper" class="slider-after-wrapper z-10">
                        <img class="w-full h-full object-cover filter saturate-125 contrast-125 brightness-95" alt="Ảnh Final Color Graded chuẩn điện ảnh Teal and Orange" src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=1600&q=80"/>
                        <div class="absolute top-4 left-4 z-10 px-3.5 py-1.5 rounded-full bg-amber-500/90 backdrop-blur-md text-navy-base text-xs font-mono font-bold border border-amber-300 flex items-center gap-1.5 shadow-md">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Final Grade: Cinematic Teal &amp; Orange</span>
                        </div>
                    </div>

                    <!-- Draggable Handle Line with Accessible ARIA slider -->
                    <div id="slider-handle-line" 
                         role="slider"
                         tabindex="0"
                         aria-label="Thanh trượt so sánh màu sắc RAW và hoàn thiện"
                         aria-valuemin="0" 
                         aria-valuemax="100" 
                         aria-valuenow="50"
                         class="slider-handle-line">
                        <div class="slider-handle-button">
                            <span class="material-symbols-outlined text-[20px]">drag_indicator</span>
                        </div>
                    </div>
                </div>

                <!-- Footer note -->
                <div class="mt-4 flex items-center justify-between text-xs font-mono text-slate-400">
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">mouse</span> Kéo chuột hoặc vuốt chạm để so sánh</span>
                    <span class="hidden sm:inline">Phím mũi tên &larr; &rarr; để điều khiển bàn phím</span>
                </div>
            </div>
        </div>

        <!-- TAB 2: WEB/APP DEVELOPMENT PIPELINE -->
        <div x-show="activeTab === 'tech'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-14" style="display: none;">
            <!-- 6-Step Horizontal Engineering Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-5">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 font-mono text-xs font-bold flex items-center justify-center">01</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">travel_explore</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Khảo Sát &amp; Kiến Trúc</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Xác định use-cases, thiết kế cấu trúc database, sơ đồ thực thể và giải pháp bảo mật.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 font-mono text-xs font-bold flex items-center justify-center">02</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">design_services</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Wireframe &amp; UI/UX</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Thiết kế Design System trên Figma, Prototype tương tác thực tế và tối ưu trải nghiệm người dùng.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-5 border border-sky-500/40 shadow-xs flex flex-col gap-3 relative ring-2 ring-sky-400/20 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-600 text-white font-mono text-xs font-bold flex items-center justify-center">03</span>
                        <span class="material-symbols-outlined text-sky-600 text-[20px]">terminal</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Frontend &amp; Backend</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Lập trình Clean Code với Laravel 11, React/Vue, tối ưu API RESTful và Microservices.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 font-mono text-xs font-bold flex items-center justify-center">04</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">bug_report</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Kiểm Thử &amp; Bảo Mật</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Unit testing, stress-test tải hàng chục ngàn người dùng đồng thời, rà soát lỗ hổng OWASP Top 10.</p>
                </div>

                <!-- Step 5 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 font-mono text-xs font-bold flex items-center justify-center">05</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">rocket_launch</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">CI/CD &amp; Triển Khai</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Đóng gói Docker, tự động hóa build CI/CD lên hạ tầng AWS/DigitalOcean với SSL &amp; Cloudflare CDN.</p>
                </div>

                <!-- Step 6 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-mono text-xs font-bold flex items-center justify-center">06</span>
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">headset_mic</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Bảo Hành &amp; Giám Sát</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Giám sát uptime 99.99%, backup dữ liệu định kỳ mỗi ngày và hỗ trợ kỹ thuật bảo hành 24/7.</p>
                </div>
            </div>

            <!-- Interactive Live Code Typewriter Window Component -->
            <div class="bg-[#0B132B] rounded-3xl p-6 sm:p-10 text-white border border-slate-700 shadow-2xl">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
                    <div>
                        <div class="inline-flex items-center gap-2 text-sky-400 text-xs font-mono font-bold uppercase mb-2">
                            <span class="material-symbols-outlined text-[16px]">code</span>
                            TIÊU CHUẨN KỸ THUẬT &amp; CLEAN ARCHITECTURE
                        </div>
                        <h3 class="corporate-heading text-2xl sm:text-3xl text-white">
                            Kiến Trúc Phần Mềm Doanh Nghiệp Chuẩn Mực
                        </h3>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-md font-body leading-relaxed">
                        Mã nguồn được viết theo chuẩn PSR-12, tối ưu hóa truy vấn CSDL, tích hợp Redis Caching và cơ chế Queue Worker giúp xử lý hàng ngàn tác vụ ngầm cùng lúc.
                    </p>
                </div>

                <!-- Code Terminal Box -->
                <div class="w-full rounded-2xl bg-[#070F1E] border border-white/10 shadow-2xl overflow-hidden">
                    <div class="px-4 py-3 bg-[#0c162e] border-b border-white/10 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500/80"></div>
                            <span class="ml-2 font-mono text-xs text-slate-400 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-sky-400">php</span>
                                app/Services/VideoProductionPipeline.php
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400">
                            <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-bold">PHP 8.3 &bull; Strict Types</span>
                        </div>
                    </div>

                    <div class="p-4 sm:p-6 overflow-x-auto text-xs sm:text-sm font-mono leading-relaxed text-slate-300">
                        <pre class="m-0"><code id="code-typewriter-target">&lt;?php

declare(strict_types=1);

namespace App\Services\MediaTech;

use App\Models\Project;
use App\Jobs\RenderCinema4KFootage;
use Illuminate\Support\Facades\Queue;

final class ProductionEngine
{
    /**
     * Dispatch high-performance video transcode job to Redis cluster.
     */
    public function dispatchMasterRender(Project $project): RenderReceipt
    {
        return Queue::connection('redis')-&gt;pushOn(
            queue: 'cinema-renders',
            job: new RenderCinema4KFootage(
                projectId: $project-&gt;id,
                resolution: '3840x2160',
                colorSpace: 'DaVinci Wide Gamut',
                codec: 'Apple ProRes 422 HQ'
            )
        );
    }
}</code><span class="typewriter-cursor"></span></pre>
                    </div>
                </div>

                <!-- Uptime Status Footnote -->
                <div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                    <span class="text-slate-400">Tiêu Chuẩn Vận Hành Hạ Tầng</span>
                    <span class="text-emerald-400 font-bold flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        99.99% Uptime Verified &bull; Automated Disaster Recovery
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 5. CÔNG NGHỆ & THIẾT BỊ THỰC CHIẾN ==================== -->
<!-- LƯU Ý KỸ THUẬT: Danh sách Enterprise Tech Stack dưới đây là các công nghệ áp dụng triển khai cho các dự án khách hàng của Cửu Long Tech. Hệ thống website hiện tại được vận hành trên nền tảng Laravel 11 + Blade + Alpine.js + Tailwind CSS. -->
<section class="w-full bg-[#081023] text-white py-20 lg:py-28 relative border-b border-white/10 gsap-reveal-section" id="tech-gear-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/25 text-amber-400 text-xs font-mono font-bold tracking-wider uppercase mb-3">
                <span class="material-symbols-outlined text-[15px]">hardware</span>
                HARDWARE &amp; SOFTWARE INFRASTRUCTURE
            </div>
            <h2 class="corporate-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-4">
                Năng Lực Thiết Bị Điện Ảnh &amp; Ngăn Xếp Công Nghệ
            </h2>
            <p class="corporate-body text-base sm:text-lg text-slate-400 leading-relaxed">
                Chúng tôi trực tiếp sở hữu thiết bị điện ảnh chuyên nghiệp và làm chủ những công nghệ lập trình tiên tiến nhất, đảm bảo tính chủ động 100% trong mọi dự án lớn.
            </p>
        </div>

        <!-- 2 Columns Grid: Left Studio Gear vs Right Tech Stack -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-start">
            <!-- Left Column: STUDIO PRODUCTION GEAR -->
            <div class="bg-navy-base/80 backdrop-blur-xl rounded-3xl p-6 sm:p-8 border border-white/10 shadow-2xl flex flex-col gap-6">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-500/20 text-orange-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[24px]">videocam</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-xl font-bold text-white">Cinema Production Gear</h3>
                            <p class="text-xs font-mono text-slate-400">Trang thiết bị ghi hình &amp; hậu kỳ điện ảnh trực tiếp sở hữu</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-orange-500/10 text-orange-400 font-mono text-[11px] font-bold border border-orange-500/30">
                        CINE LAB
                    </span>
                </div>

                <!-- Gear Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">RED Komodo 6K</span>
                            <span class="px-2 py-0.5 rounded bg-red-500/20 text-red-400 font-mono text-[10px] font-bold">6K RAW</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Cảm biến Super 35 Global Shutter, ghi hình 6K R3D RAW, dynamic range 16+ stops.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">Sony FX6 Cinema</span>
                            <span class="px-2 py-0.5 rounded bg-slate-700 text-slate-200 font-mono text-[10px] font-bold">4K 120fps</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Cảm biến Full-Frame 4K, Dual Base ISO 800/12800, màu S-Cinetone chuẩn điện ảnh.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">DaVinci Micro Panel</span>
                            <span class="px-2 py-0.5 rounded bg-indigo-500/20 text-indigo-400 font-mono text-[10px] font-bold">32-bit Float</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Bảng điều khiển cân màu phần cứng kết hợp màn hình chuyên dụng chuẩn DCI-P3.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">DJI RS3 Pro &amp; LiDAR</span>
                            <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold">AF LiDAR</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Gimbal tải trọng lớn, lấy nét LiDAR ban đêm tự động và truyền hình ảnh không dây SDR.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group sm:col-span-2">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">Aputure Lighting Grid &amp; Cine Lenses</span>
                            <span class="px-2 py-0.5 rounded bg-amber-500/20 text-amber-400 font-mono text-[10px] font-bold">CRI 96+</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Hệ thống đèn Spotlight 600d Pro, Amaran Tube và bộ ống kính điện ảnh T2.0 đảm bảo chất lượng ánh sáng hoàn hảo.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: ENTERPRISE TECH STACK -->
            <div class="bg-navy-base/80 backdrop-blur-xl rounded-3xl p-6 sm:p-8 border border-white/10 shadow-2xl flex flex-col gap-6">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[24px]">terminal</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-xl font-bold text-white">Enterprise Software Stack</h3>
                            <p class="text-xs font-mono text-slate-400">Công nghệ nền tảng phát triển dự án chuẩn doanh nghiệp</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-sky-500/10 text-sky-400 font-mono text-[11px] font-bold border border-sky-500/30">
                        TECH HUB
                    </span>
                </div>

                <!-- Stack Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">Laravel 11 &amp; PHP 8.3</span>
                            <span class="px-2 py-0.5 rounded bg-red-500/20 text-red-400 font-mono text-[10px] font-bold">Backend</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Framework bảo mật cao, ORM Eloquent tối ưu, hỗ trợ Queue Workers và Event-driven Architecture.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">React &amp; TypeScript</span>
                            <span class="px-2 py-0.5 rounded bg-sky-500/20 text-sky-400 font-mono text-[10px] font-bold">Frontend SPA</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Xây dựng ứng dụng đơn trang (SPA), Dashboard điều hành thời gian thực với kiểu dữ liệu chặt chẽ.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">Tailwind CSS &amp; Alpine.js</span>
                            <span class="px-2 py-0.5 rounded bg-teal-500/20 text-teal-400 font-mono text-[10px] font-bold">UI Framework</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Giao diện responsive linh hoạt, tải trang siêu tốc dưới 1s, trải nghiệm mượt mà không độ trễ.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-500/40 hover:bg-white/10 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">MySQL 8 &amp; Redis Cache</span>
                            <span class="px-2 py-0.5 rounded bg-orange-500/20 text-orange-400 font-mono text-[10px] font-bold">Database</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Cơ sở dữ liệu quan hệ tối ưu hóa index, Redis in-memory cache giảm tải truy vấn tới 80%.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-500/40 hover:bg-white/10 transition-all group sm:col-span-2">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">Docker Container &amp; AWS Cloud</span>
                            <span class="px-2 py-0.5 rounded bg-indigo-500/20 text-indigo-400 font-mono text-[10px] font-bold">DevOps</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Đóng gói môi trường đồng nhất, CI/CD tự động hóa, Auto-scaling và tường lửa Cloudflare WAF bảo vệ đa lớp.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 6. CORE CAPABILITIES MATRIX ==================== -->
<section class="w-full bg-surface py-20 lg:py-28 border-b border-slate-200/80 gsap-reveal-section" id="capabilities-matrix">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="corporate-eyebrow text-primary mb-3">
                INTEGRATED BUSINESS CAPABILITIES
            </div>
            <h2 class="corporate-heading text-3xl sm:text-4xl lg:text-5xl text-navy-base tracking-tight mb-4">
                Hai Năng Lực Cốt Lõi Vận Hành Song Hành
            </h2>
            <p class="corporate-body text-base sm:text-lg text-slate-600 leading-relaxed">
                Chúng tôi giải quyết bài toán tăng trưởng toàn diện cho thương hiệu bằng cách kết hợp sức mạnh cảm xúc của video truyền thông với nền tảng kỹ thuật số hiệu năng cao.
            </p>
        </div>

        <!-- 2 Balanced Core Capability Cards (50/50 Grid) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            <!-- Capability 1: FILM & VIDEO PRODUCTION -->
            <div class="corporate-card p-8 sm:p-10 flex flex-col justify-between border-t-4 border-t-primary">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-orange-50 border border-orange-200 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[32px]">videocam</span>
                        </div>
                        <span class="corporate-eyebrow text-xs font-bold text-primary bg-orange-50 px-3 py-1 rounded-full border border-orange-200/70">
                            FILM &amp; VIDEO PRODUCTION
                        </span>
                    </div>

                    <h3 class="corporate-heading text-2xl sm:text-3xl text-navy-base mb-4">
                        Sản Xuất Video &amp; Phim Doanh Nghiệp Điện Ảnh
                    </h3>
                    <p class="corporate-body text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                        Sáng tạo kịch bản, quay dựng 4K chuẩn điện ảnh giúp thương hiệu truyền tải thông điệp sâu sắc, tạo dựng niềm tin và thôi thúc khách hàng hành động.
                    </p>

                    <div class="space-y-3.5 border-t border-slate-100 pt-6">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">TVC &amp; Phim Giới Thiệu Doanh Nghiệp</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Chất lượng 4K/6K sắc nét, xây dựng câu chuyện truyền cảm hứng và vị thế dẫn đầu ngành.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Video Ngắn Chuyển Đổi (TikTok, Reels, Shorts)</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Tối ưu format dọc 9:16, bắt nhịp xu hướng và phân phối thông minh để mở rộng tệp khách hàng.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Color Grading &amp; Kỹ Xảo Điện Ảnh</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Cân chỉnh màu DaVinci Resolve Studio 32-bit float, âm thanh Sound Design Foley và VFX chuyển động.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 mt-8 border-t border-slate-100 flex items-center justify-between">
                    <a class="btn-primary-cta !px-6 !py-3 !text-xs sm:!text-sm" href="{{ route('services.show', 'san-xuat-video-media') }}">
                        <span>Khám phá dịch vụ Video</span>
                        <span class="text-base leading-none">&nearr;</span>
                    </a>
                    <a class="font-headline text-xs sm:text-sm font-bold text-slate-600 hover:text-primary transition-colors" href="{{ route('projects.index') }}">
                        Xem dự án đã thực hiện &rarr;
                    </a>
                </div>
            </div>

            <!-- Capability 2: WEB & APP DEVELOPMENT -->
            <div class="corporate-card p-8 sm:p-10 flex flex-col justify-between border-t-4 border-t-sky-500">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-200 text-sky-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[32px]">terminal</span>
                        </div>
                        <span class="corporate-eyebrow text-xs font-bold text-sky-700 bg-sky-50 px-3 py-1 rounded-full border border-sky-200/70">
                            WEB &amp; APP DEVELOPMENT
                        </span>
                    </div>

                    <h3 class="corporate-heading text-2xl sm:text-3xl text-navy-base mb-4">
                        Thiết Kế &amp; Lập Trình Nền Tảng Số Doanh Nghiệp
                    </h3>
                    <p class="corporate-body text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                        Xây dựng hệ thống website, web application và ứng dụng di động hiệu năng cao, bảo mật vững chắc và tối ưu hóa chuyển đổi kinh doanh.
                    </p>

                    <div class="space-y-3.5 border-t border-slate-100 pt-6">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-sky-600 text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Website Doanh Nghiệp &amp; Thương Mại Điện Tử</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Thiết kế UI/UX độc quyền chuẩn thương hiệu, tối ưu tốc độ tải dưới 1s và chuẩn SEO kỹ thuật.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-sky-600 text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Hệ Thống Web Application &amp; ERP Nội Bộ</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Số hóa quy trình vận hành, quản lý kho, khách hàng (CRM) và phân quyền dữ liệu nhiều chi nhánh.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-sky-600 text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Tích Hợp AI &amp; Tự Động Hóa Dữ Liệu</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Trợ lý AI thông minh, chatbot tư vấn tự động và kết nối các cổng thanh toán, đơn vị vận chuyển.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 mt-8 border-t border-slate-100 flex items-center justify-between">
                    <a class="btn-primary-cta !px-6 !py-3 !text-xs sm:!text-sm !bg-slate-900 hover:!bg-sky-600 !shadow-none" href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}">
                        <span>Khám phá dịch vụ Web/App</span>
                        <span class="text-base leading-none">&nearr;</span>
                    </a>
                    <a class="font-headline text-xs sm:text-sm font-bold text-slate-600 hover:text-sky-600 transition-colors" href="{{ route('contact') }}">
                        Tư vấn kiến trúc &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 7. TRUST & CREDIBILITY SIGNALS (CONTENT INTEGRITY RULE) ==================== -->
<!-- TODO: REAL COMPANY DATA REQUIRED: Khi có số liệu thống kê chính xác (số năm hoạt động thực tế, số dự án hoàn thành đã nghiệm thu...), cập nhật tại đây -->
<section class="w-full bg-white py-16 border-b border-slate-200/80 gsap-reveal-section" id="trust-signals">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Pillar 1: In-House -->
            <div class="flex flex-col items-center sm:items-start text-center sm:text-left gap-3 p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">precision_manufacturing</span>
                </div>
                <div>
                    <h3 class="font-headline text-base font-extrabold text-navy-base">100% Trực Tiếp Thực Thi</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed mt-1">
                        Sở hữu máy quay cinema và đội ngũ lập trình tại chỗ, không bán thầu hay qua trung gian.
                    </p>
                </div>
            </div>

            <!-- Pillar 2: Enterprise Code -->
            <div class="flex flex-col items-center sm:items-start text-center sm:text-left gap-3 p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">verified_user</span>
                </div>
                <div>
                    <h3 class="font-headline text-base font-extrabold text-navy-base">Chuẩn Kiến Trúc An Toàn</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed mt-1">
                        Tuân thủ tiêu chuẩn bảo mật quốc tế, kiểm thử tải kỹ lưỡng và bàn giao 100% mã nguồn.
                    </p>
                </div>
            </div>

            <!-- Pillar 3: SLA & Support -->
            <div class="flex flex-col items-center sm:items-start text-center sm:text-left gap-3 p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">support_agent</span>
                </div>
                <div>
                    <h3 class="font-headline text-base font-extrabold text-navy-base">Bảo Hành &amp; Đồng Hành</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed mt-1">
                        Cam kết hỗ trợ kỹ thuật định kỳ, bảo trì hệ thống số và tư vấn truyền thông dài hạn.
                    </p>
                </div>
            </div>

            <!-- Pillar 4: Transparency -->
            <div class="flex flex-col items-center sm:items-start text-center sm:text-left gap-3 p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">fact_check</span>
                </div>
                <div>
                    <h3 class="font-headline text-base font-extrabold text-navy-base">Minh Bạch &amp; Rõ Ràng</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed mt-1">
                        Hợp đồng pháp lý cụ thể, lộ trình tiến độ chi tiết từng giai đoạn và nghiệm thu theo checklist.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 8. "WHY CHOOSE US" (SPOTLIGHT MOUSE OVERLAY) ==================== -->
<section class="w-full bg-[#070F1E] bg-dot-grid-dark py-20 lg:py-28 text-white relative overflow-hidden border-b border-white/10 gsap-reveal-section" id="why-clm">
    <!-- Interactive Mouse Spotlight Overlay -->
    <div class="spotlight-overlay absolute inset-0 z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Header Info -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 text-amber-400 corporate-eyebrow w-fit">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>TẠI SAO CHỌN CỬU LONG MEDIA &amp; TECH?</span>
                </div>
                <h2 class="corporate-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Sự Kết Hợp Độc Bản Giữa Nghệ Thuật Điện Ảnh &amp; Nền Tảng Công Nghệ
                </h2>
                <p class="corporate-body text-slate-300 text-base sm:text-lg leading-relaxed">
                    Hầu hết các đơn vị trên thị trường chỉ làm tốt một nửa câu chuyện: hoặc thuần sáng tạo nội dung nhưng yếu năng lực kỹ thuật, hoặc mạnh lập trình nhưng thiếu tư duy thẩm mỹ và truyền thông. Cửu Long hợp nhất cả hai năng lực dưới một mái nhà chung.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a class="btn-primary-cta" href="{{ route('contact') }}">
                        <span>Bắt đầu một dự án</span>
                        <span class="text-base leading-none">&nearr;</span>
                    </a>
                    <a class="btn-secondary-cta-dark" href="{{ route('about') }}">
                        <span>Tìm hiểu đội ngũ</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Right 4 Advantage Cards -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Advantage 1 -->
                <div class="corporate-card-dark p-6 sm:p-7 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-orange-500/20 text-orange-400 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">hub</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">
                        Tổ Hợp "All-In-One" Đồng Bộ
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Từ ý tưởng kịch bản, sản xuất video TVC, thiết kế giao diện UI/UX đến phát triển hệ thống phần mềm &mdash; thương hiệu được quản lý đồng nhất, không phân mảnh.
                    </p>
                </div>

                <!-- Advantage 2 -->
                <div class="corporate-card-dark p-6 sm:p-7 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">memory</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-sky-400 transition-colors">
                        Trang Thiết Bị &amp; Tech Đỉnh Cao
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Trực tiếp sở hữu máy quay RED Komodo 6K, Sony Cinema Line, bàn chỉnh màu DaVinci Resolve Studio và hạ tầng cloud container hiệu năng cao.
                    </p>
                </div>

                <!-- Advantage 3 -->
                <div class="corporate-card-dark p-6 sm:p-7 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">explore</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-rose-400 transition-colors">
                        Am Hiểu Sâu Sắc Văn Hóa Bản Địa
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Đội ngũ chuyên gia địa phương am hiểu sâu sắc thị trường Cần Thơ &amp; ĐBSCL, mang đến góc nhìn văn hóa chân thực kết hợp tiêu chuẩn sáng tạo quốc tế.
                    </p>
                </div>

                <!-- Advantage 4 -->
                <div class="corporate-card-dark p-6 sm:p-7 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">verified</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">
                        Trực Tiếp Triển Khai &amp; Bảo Hành
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Làm việc trực tiếp cùng đội ngũ Senior chuyên môn, hỗ trợ kỹ thuật liên tục, bảo trì dài hạn và phản hồi tức thì khi có yêu cầu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 9. [NÂNG CẤP] CASE STUDIES (FILTER TABS, HOVER PLAY, LIVE PREVIEW SCROLL) ==================== -->
<section class="w-full bg-slate-50 py-20 lg:py-28 gsap-reveal-section" id="portfolio-section" x-data="{ currentFilter: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header with Functional Filter Tabs -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold uppercase mb-2">
                    <span class="material-symbols-outlined text-[15px]">verified</span>
                    PORTFOLIO &amp; SHOWCASE
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    Dự Án Tiêu Biểu &amp; Minh Chứng Năng Lực
                </h2>
            </div>

            <!-- Functional Alpine Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 bg-white p-1.5 rounded-full border border-slate-200 shadow-sm" role="tablist">
                <button type="button" 
                        @click="currentFilter = 'all'"
                        :class="currentFilter === 'all' ? 'bg-navy-base text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                        class="px-4 py-2 rounded-full font-headline text-xs font-bold transition-all">
                    Tất Cả
                </button>
                <button type="button" 
                        @click="currentFilter = 'video'"
                        :class="currentFilter === 'video' ? 'bg-navy-base text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                        class="px-4 py-2 rounded-full font-headline text-xs font-bold transition-all">
                    Video &amp; TVC
                </button>
                <button type="button" 
                        @click="currentFilter = 'web'"
                        :class="currentFilter === 'web' ? 'bg-navy-base text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                        class="px-4 py-2 rounded-full font-headline text-xs font-bold transition-all">
                    Web &amp; App
                </button>
                <button type="button" 
                        @click="currentFilter = 'marketing'"
                        :class="currentFilter === 'marketing' ? 'bg-navy-base text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                        class="px-4 py-2 rounded-full font-headline text-xs font-bold transition-all">
                    Chiến Dịch Marketing
                </button>
            </div>
        </div>

        <!-- Portfolio Cards Grid with Custom Cursor Zone -->
        <div class="portfolio-grid-wrapper grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Card 1 (Web/App): Laptop Mockup with LIVE PREVIEW VERTICAL SCROLL -->
            <div x-show="currentFilter === 'all' || currentFilter === 'web'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="project-item tech group lg:col-span-7 rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.05)] hover:shadow-2xl transition-all duration-500 flex flex-col relative cursor-pointer">
                
                <!-- Browser Mockup Header Bar -->
                <div class="px-4 py-3 bg-slate-900 border-b border-white/10 flex items-center justify-between">
                    <div class="flex items-center gap-1.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                        <span class="ml-2 px-3 py-0.5 rounded-full bg-white/10 text-[11px] font-mono text-slate-300">https://v-media.vn (Live Preview)</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-sky-500/20 text-sky-300 border border-sky-400/30 text-[10px] font-mono font-bold">Web Platform</span>
                </div>

                <!-- Live Preview Vertical Scroll Window -->
                <div class="web-preview-window w-full bg-slate-950">
                    <!-- Long full-page screenshot (scrolls down on hover) -->
                    <img class="web-preview-scroll-img" 
                         alt="Giao diện nền tảng số V-Media chụp cuộn toàn trang" 
                         loading="lazy"
                         src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80"/>
                    <div class="absolute bottom-3 right-3 px-3 py-1 rounded-full bg-black/80 backdrop-blur-md text-amber-400 font-mono text-xs font-bold border border-white/15 pointer-events-none group-hover:opacity-0 transition-opacity flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">pan_tool_alt</span> Rê chuột để cuộn trang
                    </div>
                </div>

                <div class="p-7 flex flex-col gap-3 flex-1 bg-gradient-to-b from-white to-slate-50/50">
                    <h3 class="font-headline text-2xl text-navy-base font-extrabold group-hover:text-sky-600 transition-colors">
                        Cổng Tin Tức &amp; Tạp Chí Số Toàn Diện V-Media
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Tái cấu trúc kiến trúc microservices chịu tải hơn 5 triệu lượt đọc mỗi ngày, tích hợp AI tự động tổng hợp tin tức và tối ưu SEO kỹ thuật thời gian thực.
                    </p>
                    <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                        <span class="text-sky-600 font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">trending_up</span> +280% Tăng trưởng Traffic
                        </span>
                        <span class="text-slate-500 font-semibold bg-slate-100 px-3 py-1 rounded-full">⚡ 0.3s Tải trang</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: 2 Cards (Video TVC + Digital Growth) -->
            <div class="lg:col-span-5 flex flex-col gap-8">
                <!-- Card 2 (Video): Hover Autoplay Preview -->
                <div x-show="currentFilter === 'all' || currentFilter === 'video'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="project-item film video-hover-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.05)] hover:shadow-xl transition-all duration-300 flex flex-col relative cursor-pointer">
                    <div class="h-48 w-full relative overflow-hidden bg-black">
                        <!-- Static Cover Image -->
                        <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90" 
                             alt="Cinematic commercial still 4K" 
                             loading="lazy"
                             src="https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=800&q=80"/>
                        
                        <!-- Auto-playing video on hover (muted & loop, playsinline for Safari/iOS) -->
                        <video class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-500 pointer-events-none" 
                               muted 
                               loop 
                               playsinline 
                               preload="none" 
                               src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4"></video>

                        <div class="absolute inset-0 flex items-center justify-center group-hover:opacity-0 transition-opacity">
                            <div class="w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-[0_0_25px_rgba(234,88,12,0.9)] ring-4 ring-orange-400/30 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[24px] fill ml-0.5">play_arrow</span>
                            </div>
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-black/70 backdrop-blur-md text-white font-mono text-[11px] font-bold border border-white/20">
                            03:45 • RED 6K
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

                <!-- Card 3 (Marketing): Realtime Analytics Dashboard Mockup -->
                <div x-show="currentFilter === 'all' || currentFilter === 'marketing'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="project-item ads group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.05)] hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-navy-base">
                        <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-85" 
                             alt="AI data visualization command center interface" 
                             loading="lazy"
                             src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80"/>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-0.5 rounded-full bg-navy-base/80 backdrop-blur-md text-amber-400 font-mono text-[10px] font-bold border border-amber-400/30">
                                Social Radar • NLP Intelligence
                            </span>
                        </div>
                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-emerald-950/80 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                            ⚡ 60s Live Report
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-mono text-[10px] font-bold">MarTech &amp; AI Ads</span>
                            <span class="text-xs text-slate-400 font-mono">ROAS 4.8x</span>
                        </div>
                        <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                            Hệ Thống Lắng Nghe &amp; Tối Ưu Quảng Cáo AI
                        </h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Phần mềm thu thập phản hồi mạng xã hội theo thời gian thực kết hợp phân bổ ngân sách quảng cáo tự động cho chuỗi bán lẻ.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Projects Button -->
        <div class="mt-12 text-center">
            <a class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-white text-navy-base font-headline text-sm font-bold border border-slate-300 shadow-sm hover:border-primary hover:text-primary transition-all hover:-translate-y-0.5" href="{{ url('/du-an') }}">
                <span>Xem Tất Cả 850+ Dự Án Đã Thực Hiện</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>
</section>

<!-- ==================== 10. [SECTION MỚI] HẬU TRƯỜNG SẢN XUẤT (BEHIND THE SCENES BENTO GRID) ==================== -->
<!-- TODO: Cần cung cấp 5-8 ảnh hậu trường sản xuất thực tế của ekip Cửu Long Media & Tech (định dạng JPG/WebP, độ phân giải cao) -->
<section class="w-full bg-slate-100 py-20 lg:py-28 relative border-b border-slate-200/80 gsap-reveal-section" id="bts-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 border border-orange-200 text-primary text-xs font-mono font-bold tracking-wider uppercase mb-3">
                <span class="material-symbols-outlined text-[15px]">photo_camera</span>
                BEHIND THE SCENES • KHÔNG GIAN THỰC ĐỊA
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight mb-4">
                Hậu Trường Thực Chiến Cùng Đội Ngũ Cửu Long
            </h2>
            <p class="font-body text-base sm:text-lg text-slate-600 leading-relaxed">
                Từng thước phim triệu views và mỗi dòng code mượt mà đều bắt nguồn từ sự tập trung cao độ tại phim trường bối cảnh và tech lab của chúng tôi.
            </p>
        </div>

        <!-- Bento Grid Layout with High-Fidelity Ratios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 items-stretch">
            <!-- Bento 1 (Large - 7 Cols, 2 Rows): Field Shooting with RED Camera -->
            <div class="lg:col-span-7 rounded-3xl overflow-hidden relative group min-h-[320px] sm:min-h-[420px] shadow-md border border-slate-200 bg-slate-900">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Ekip Cửu Long tác nghiệp quay phim trên bối cảnh sông nước miền Tây" 
                     loading="lazy"
                     src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=1200&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 flex flex-col gap-1.5 text-white">
                    <span class="px-3 py-1 rounded-full bg-orange-500/90 text-white font-mono text-[11px] font-bold w-fit mb-1">
                        PHIM TRƯỜNG MEKONG • 08/2026
                    </span>
                    <h3 class="font-headline font-bold text-xl sm:text-2xl text-white">
                        Ekip Vận Hành Máy Quay RED Komodo 6K Trên Bối Cảnh Sông Tiền
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-300 line-clamp-2">
                        Ghi hình cảnh bình minh miền Tây với hệ thống gimbal chống rung và ống kính điện ảnh Anamorphic cho chiến dịch TVC Nông nghiệp xanh.
                    </p>
                </div>
            </div>

            <!-- Bento 2 (5 Cols): Master Color Grading Room -->
            <div class="lg:col-span-5 rounded-3xl overflow-hidden relative group min-h-[280px] shadow-md border border-slate-200 bg-slate-900">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Phòng Master Color Grading DaVinci Resolve với màn hình chuẩn màu EIZO" 
                     loading="lazy"
                     src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5 flex flex-col gap-1 text-white">
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-600/90 text-white font-mono text-[10px] font-bold w-fit mb-1">
                        DAVINCI SUITE
                    </span>
                    <h4 class="font-headline font-bold text-lg text-white">
                        Phòng Master Cân Chỉnh Màu Tiêu Chuẩn EIZO
                    </h4>
                    <p class="font-body text-xs text-slate-300">
                        Cân màu 32-bit float đảm bảo tính nhất quán dải màu trên mọi thiết bị phát sóng và màn hình điện thoại.
                    </p>
                </div>
            </div>

            <!-- Bento 3 (4 Cols): Tech Architecture & Code Sprint -->
            <div class="lg:col-span-4 rounded-3xl overflow-hidden relative group min-h-[260px] shadow-md border border-slate-200 bg-slate-900">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Buổi họp Sprint Review và thiết kế kiến trúc hệ thống của đội ngũ kỹ sư Cửu Long Tech" 
                     loading="lazy"
                     src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5 flex flex-col gap-1 text-white">
                    <span class="px-2.5 py-0.5 rounded-full bg-sky-600/90 text-white font-mono text-[10px] font-bold w-fit mb-1">
                        TECH LAB • SPRINT 14
                    </span>
                    <h4 class="font-headline font-bold text-base text-white">
                        Kiến Trúc Microservices &amp; Clean Code
                    </h4>
                    <p class="font-body text-xs text-slate-300">
                        Họp rà soát kiến trúc hệ thống CSDL và kiểm thử tải cho dự án cổng tin tức.
                    </p>
                </div>
            </div>

            <!-- Bento 4 (4 Cols): Aerial Flycam Operations -->
            <div class="lg:col-span-4 rounded-3xl overflow-hidden relative group min-h-[260px] shadow-md border border-slate-200 bg-slate-900">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Pilot điều khiển flycam Mavic 3 Cine ghi hình trên không" 
                     loading="lazy"
                     src="https://images.unsplash.com/photo-1508614589041-895b88991e3e?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5 flex flex-col gap-1 text-white">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-600/90 text-white font-mono text-[10px] font-bold w-fit mb-1">
                        AERIAL CINE
                    </span>
                    <h4 class="font-headline font-bold text-base text-white">
                        Tác Nghiệp Flycam Săn Góc Toàn Cảnh
                    </h4>
                    <p class="font-body text-xs text-slate-300">
                        Ghi hình ProRes 422 HQ từ độ cao 150m bao quát toàn cảnh nhà máy và vùng nguyên liệu.
                    </p>
                </div>
            </div>

            <!-- Bento 5 (4 Cols): Video Editing Station -->
            <div class="lg:col-span-4 rounded-3xl overflow-hidden relative group min-h-[260px] shadow-md border border-slate-200 bg-slate-900">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                     alt="Bàn dựng phim đa màn hình với phần mềm Premiere Pro và DaVinci" 
                     loading="lazy"
                     src="https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=800&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5 flex flex-col gap-1 text-white">
                    <span class="px-2.5 py-0.5 rounded-full bg-purple-600/90 text-white font-mono text-[10px] font-bold w-fit mb-1">
                        POST-PRODUCTION
                    </span>
                    <h4 class="font-headline font-bold text-base text-white">
                        Bàn Dựng Phim Đa Track &amp; Sound Design
                    </h4>
                    <p class="font-body text-xs text-slate-300">
                        Phối hợp timeline hàng chục lớp video, âm thanh Foley và kỹ xảo Motion Graphic.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 11. CTA BAND (FLOWING GRADIENT & LIGHT STREAKS) ==================== -->
<section class="w-full relative overflow-hidden py-20 lg:py-24 bg-gradient-to-r from-navy-base via-primary to-accent-coral animate-gradient-flow text-white gsap-reveal-section">
    <!-- Light Streaks flying across background -->
    <div class="light-streak"></div>
    <div class="light-streak light-streak-delay"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 flex flex-col items-center gap-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-white font-mono text-xs font-bold shadow-sm">
            <span class="material-symbols-outlined text-[16px]">rocket_launch</span>
            <span>SẴN SÀNG TẠO NÊN DẤU ẤN ĐỘT PHÁ?</span>
        </div>

        <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white max-w-3xl leading-tight">
            Hãy Cùng Cửu Long Biến Tầm Nhìn Thương Hiệu Thành Hiện Thực
        </h2>

        <p class="font-body text-white/90 text-base sm:text-lg max-w-2xl leading-relaxed">
            Cho dù bạn cần một bộ phim TVC chuẩn điện ảnh chạm đến trái tim hàng triệu khán giả hay một nền tảng công nghệ số chịu tải hàng triệu người dùng — chúng tôi luôn sẵn sàng lắng nghe và tư vấn giải pháp tối ưu.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a class="inline-flex items-center gap-2 px-9 py-4 rounded-full bg-white text-navy-base font-headline text-sm font-bold shadow-[0_10px_30px_rgba(0,0,0,0.25)] hover:bg-slate-100 hover:scale-105 transition-all" href="{{ url('/lien-he') }}">
                <span>Đặt Lịch Tư Vấn Dự Án</span>
                <span class="material-symbols-outlined text-[19px] text-primary">arrow_forward</span>
            </a>
            <a class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-navy-base/60 backdrop-blur-md text-white font-headline text-sm font-semibold border border-white/30 hover:bg-navy-base/80 hover:border-white transition-all" href="tel:0901234567">
                <span class="material-symbols-outlined text-amber-400 text-[19px]">call</span>
                <span>Hotline: 090 123 4567</span>
            </a>
        </div>
    </div>
</section>
@endsection
