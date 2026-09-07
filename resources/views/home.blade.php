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

<!-- ==================== 2. [SECTION MỚI] SHOWREEL NỔI BẬT (DAVINCI CUSTOM PLAYER) ==================== -->
<!-- TODO: Cần cung cấp video showreel chính thức của Cửu Long Media & Tech (định dạng MP4/WebM 1080p/4K, 30-60s) -->
<!-- TODO: Cần cung cấp file phụ đề .vtt hoặc transcript cho video showreel -->
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
                    SHOWREEL 2026 • CỬU LONG MEDIA &amp; TECH LAB
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Đỉnh Cao Ngôn Ngữ Hình Ảnh &amp; Năng Lực Điện Ảnh
                </h2>
            </div>
            <p class="font-body text-sm sm:text-base text-slate-400 max-w-md leading-relaxed">
                Từng khung hình được chế tác với máy quay RED 6K, hệ ống kính cine cao cấp và hệ thống cân chỉnh màu DaVinci Resolve Studio 32-bit float.
            </p>
        </div>

        <!-- Custom Cinema Video Player Container -->
        <div id="showreel-container" class="relative w-full rounded-3xl overflow-hidden bg-black border border-white/15 shadow-[0_25px_60px_rgba(0,0,0,0.6),0_0_50px_rgba(234,88,12,0.15)] group">
            <!-- Aspect Ratio 21:9 on Desktop, 16:9 on Mobile -->
            <div class="relative w-full aspect-video lg:aspect-[21/9] bg-black overflow-hidden flex items-center justify-center">
                <!-- Video Element with Multi-source & Fallback (LCP: fetchpriority high on poster, no lazy) -->
                <video id="showreel-main-video" 
                       class="w-full h-full object-cover" 
                       poster="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=1920&q=80"
                       playsinline 
                       muted 
                       preload="metadata">
                    <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4" type="video/mp4" media="(min-width: 769px)">
                    <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4" type="video/mp4" media="(max-width: 768px)">
                    <track kind="captions" srclang="vi" label="Tiếng Việt">
                    Trình duyệt của bạn không hỗ trợ phát video HTML5.
                </video>

                <!-- Center Large Glassmorphism Play Button -->
                <button id="showreel-center-play" 
                        aria-label="Phát video showreel Cửu Long"
                        class="absolute z-20 w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-navy-base/80 backdrop-blur-xl border border-white/30 text-white flex items-center justify-center shadow-[0_0_40px_rgba(234,88,12,0.8)] hover:scale-110 hover:border-amber-400 transition-all duration-300 group/play">
                    <span class="material-symbols-outlined text-[36px] sm:text-[42px] fill ml-1 text-amber-400 group-hover/play:scale-110 transition-transform">play_arrow</span>
                    <span class="absolute inset-0 rounded-full border-2 border-amber-400/40 animate-ping pointer-events-none"></span>
                </button>

                <!-- Cinematic Letterbox Vignette Overlay -->
                <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-black/85 via-transparent to-black/40"></div>

                <!-- DaVinci Top Status Bar -->
                <div class="absolute top-4 left-4 right-4 flex items-center justify-between text-xs font-mono text-slate-300 pointer-events-none z-10">
                    <div class="flex items-center gap-2 bg-black/60 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span class="font-bold text-white tracking-wide">MASTER REEL 2026</span>
                        <span class="text-slate-400 text-[11px]">• 6K DCI RAW • 2.39:1 CINEMASCOPE</span>
                    </div>
                    <div class="hidden sm:flex items-center gap-3 bg-black/60 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10 text-[11px]">
                        <span class="text-amber-400 font-bold">DaVinci 32-bit Float</span>
                        <span class="text-slate-400">|</span>
                        <span>Rec.709 Master</span>
                    </div>
                </div>

                <!-- DaVinci Custom Scrubber & Bottom Controls Bar -->
                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 bg-gradient-to-t from-black via-black/80 to-transparent z-10 flex flex-col gap-3">
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
                            <span class="text-amber-400 font-semibold">CỬU LONG STUDIOS</span> — SHOT ON RED KOMODO 6K &amp; SONY FX6 • GRADED IN DAVINCI RESOLVE
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
<section class="w-full bg-slate-100/90 border-b border-slate-200/80 py-6 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-3">
        <p class="text-center font-mono text-xs uppercase tracking-widest text-slate-500 font-bold">
            Đối tác chiến lược &amp; Thương hiệu đồng hành
        </p>
    </div>

    <div class="marquee-container relative w-full overflow-hidden">
        <div class="absolute left-0 top-0 bottom-0 w-20 sm:w-36 bg-gradient-to-r from-slate-100/90 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-20 sm:w-36 bg-gradient-to-l from-slate-100/90 to-transparent z-10 pointer-events-none"></div>

        <div class="marquee-track flex items-center gap-12 py-2">
            <!-- First set of partner marks -->
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-600 flex items-center justify-center text-white text-[11px] font-black">RED</div>
                <span>RED DIGITAL CINEMA</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-slate-900 flex items-center justify-center text-white text-[11px] font-black">SONY</div>
                <span>SONY CINEMA LINE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-indigo-700 flex items-center justify-center text-white text-[11px] font-black">BMD</div>
                <span>DAVINCI RESOLVE STUDIO</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-500 flex items-center justify-center text-white text-[11px] font-black">LAR</div>
                <span>LARAVEL ENTERPRISE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-sky-500 flex items-center justify-center text-white text-[11px] font-black">REA</div>
                <span>REACT &amp; NEXT.JS</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-orange-500 flex items-center justify-center text-white text-[11px] font-black">AWS</div>
                <span>AMAZON WEB SERVICES</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-emerald-600 flex items-center justify-center text-white text-[11px] font-black">DJI</div>
                <span>DJI RONIN &amp; MAVIC CINE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-amber-500 flex items-center justify-center text-white text-[11px] font-black">APU</div>
                <span>APUTURE LIGHTING</span>
            </div>

            <!-- Duplicate set for infinite seamless loop -->
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-600 flex items-center justify-center text-white text-[11px] font-black">RED</div>
                <span>RED DIGITAL CINEMA</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-slate-900 flex items-center justify-center text-white text-[11px] font-black">SONY</div>
                <span>SONY CINEMA LINE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-indigo-700 flex items-center justify-center text-white text-[11px] font-black">BMD</div>
                <span>DAVINCI RESOLVE STUDIO</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-red-500 flex items-center justify-center text-white text-[11px] font-black">LAR</div>
                <span>LARAVEL ENTERPRISE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-sky-500 flex items-center justify-center text-white text-[11px] font-black">REA</div>
                <span>REACT &amp; NEXT.JS</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-orange-500 flex items-center justify-center text-white text-[11px] font-black">AWS</div>
                <span>AMAZON WEB SERVICES</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-emerald-600 flex items-center justify-center text-white text-[11px] font-black">DJI</div>
                <span>DJI RONIN &amp; MAVIC CINE</span>
            </div>
            <div class="flex items-center gap-2 text-slate-700 font-headline font-bold text-sm sm:text-base tracking-wider grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100 shrink-0">
                <div class="w-7 h-7 rounded bg-amber-500 flex items-center justify-center text-white text-[11px] font-black">APU</div>
                <span>APUTURE LIGHTING</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 4. [SECTION MỚI] QUY TRÌNH LÀM VIỆC — 2 NGÀNH, 1 CHUẨN MỰC ==================== -->
<!-- TODO: Cần cung cấp 2 ảnh RAW và Color Graded cùng góc máy (JPG/WebP, tối thiểu 1920x1080px) -->
<section class="w-full bg-surface bg-dot-grid-subtle py-20 lg:py-28 relative border-b border-slate-200/70 gsap-reveal-section" id="workflow-section" x-data="{ activeTab: 'video' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 border border-orange-200 text-primary text-xs font-mono font-bold tracking-wider uppercase mb-3">
                <span class="material-symbols-outlined text-[15px]">precision_manufacturing</span>
                WORKFLOW &amp; ENGINEERING STANDARDS
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight mb-4">
                Quy Trình Làm Việc — 2 Ngành, 1 Chuẩn Mực
            </h2>
            <p class="font-body text-base sm:text-lg text-slate-600 leading-relaxed">
                Minh bạch từ giai đoạn khởi tạo ý tưởng đến bàn giao thành phẩm. Cho dù là một thước phim điện ảnh triệu views hay hệ thống ứng dụng chịu tải cao, chúng tôi luôn vận hành theo quy chuẩn khắt khe nhất.
            </p>

            <!-- 2-Tab Switcher Buttons (Accessible with role="tablist") -->
            <div class="inline-flex p-1.5 rounded-full bg-slate-200/80 border border-slate-300 mt-8 shadow-inner" role="tablist" aria-label="Lựa chọn quy trình làm việc">
                <button type="button" 
                        role="tab"
                        :aria-selected="activeTab === 'video'"
                        @click="activeTab = 'video'"
                        :class="activeTab === 'video' ? 'bg-navy-base text-white shadow-md' : 'text-slate-600 hover:text-navy-base'"
                        class="flex items-center gap-2 px-6 py-3 rounded-full font-headline text-sm font-bold transition-all duration-300">
                    <span class="material-symbols-outlined text-[18px]">movie</span>
                    <span>Sản Xuất Video &amp; TVC</span>
                </button>
                <button type="button" 
                        role="tab"
                        :aria-selected="activeTab === 'tech'"
                        @click="activeTab = 'tech'"
                        :class="activeTab === 'tech' ? 'bg-navy-base text-white shadow-md' : 'text-slate-600 hover:text-navy-base'"
                        class="flex items-center gap-2 px-6 py-3 rounded-full font-headline text-sm font-bold transition-all duration-300">
                    <span class="material-symbols-outlined text-[18px]">terminal</span>
                    <span>Phát Triển Web &amp; App</span>
                </button>
            </div>
        </div>

        <!-- TAB 1: VIDEO PRODUCTION PIPELINE -->
        <div x-show="activeTab === 'video'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-14">
            <!-- 6-Step Horizontal Timeline Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-5">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-orange-100 text-primary font-mono text-xs font-bold flex items-center justify-center">01</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">lightbulb</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Ý Tưởng &amp; Kịch Bản</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Xác định thông điệp cốt lõi, xây dựng Storyboard chi tiết &amp; Moodboard hình ảnh.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-orange-100 text-primary font-mono text-xs font-bold flex items-center justify-center">02</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">groups</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Tiền Kỳ &amp; Casting</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Tuyển chọn diễn viên, khảo sát bối cảnh thực địa, chuẩn bị trang thiết bị &amp; đạo cụ.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-5 border border-primary/40 shadow-sm flex flex-col gap-3 relative ring-2 ring-orange-400/20 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-primary text-white font-mono text-xs font-bold flex items-center justify-center">03</span>
                        <span class="material-symbols-outlined text-primary text-[20px]">videocam</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Quay Hình 6K</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Ghi hình với máy quay RED Komodo &amp; Sony FX6, ánh sáng Aputure và gimbal 3 trục.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-2xl p-5 border border-primary/40 shadow-sm flex flex-col gap-3 relative ring-2 ring-orange-400/20 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-primary text-white font-mono text-xs font-bold flex items-center justify-center">04</span>
                        <span class="material-symbols-outlined text-primary text-[20px]">palette</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Dựng &amp; Color Grade</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Dựng nhịp điệu trên Premiere, cân chỉnh màu điện ảnh chuyên sâu trên DaVinci Resolve.</p>
                </div>

                <!-- Step 5 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-orange-100 text-primary font-mono text-xs font-bold flex items-center justify-center">05</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">graphic_eq</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Sound Design &amp; VFX</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Xử lý âm thanh Foley, lồng tiếng, kỹ xảo 3D CGI và Motion Graphic sống động.</p>
                </div>

                <!-- Step 6 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-primary/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-mono text-xs font-bold flex items-center justify-center">06</span>
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">verified</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Master &amp; Đa Nền Tảng</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Xuất file ProRes 422 HQ tiêu chuẩn phát sóng và các tỉ lệ 16:9, 9:16 cho Social Media.</p>
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
                        <h3 class="font-headline text-2xl sm:text-3xl font-extrabold text-white">
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
                    <span class="hidden sm:inline">Phím mũi tên ◄ ► để điều khiển bàn phím</span>
                </div>
            </div>
        </div>

        <!-- TAB 2: WEB/APP DEVELOPMENT PIPELINE -->
        <div x-show="activeTab === 'tech'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-14" style="display: none;">
            <!-- 6-Step Horizontal Engineering Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-5">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 font-mono text-xs font-bold flex items-center justify-center">01</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">account_tree</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Khảo Sát &amp; Kiến Trúc</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Thu thập yêu cầu nghiệp vụ, thiết kế Data Schema, giải pháp chịu tải cao &amp; bảo mật.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 font-mono text-xs font-bold flex items-center justify-center">02</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">design_services</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Thiết Kế UI/UX</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Xây dựng Figma Design System đồng bộ, prototype tương tác chuẩn WCAG 2.1.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-5 border border-sky-500/40 shadow-sm flex flex-col gap-3 relative ring-2 ring-sky-400/20 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-600 text-white font-mono text-xs font-bold flex items-center justify-center">03</span>
                        <span class="material-symbols-outlined text-sky-600 text-[20px]">code</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Lập Trình Clean Code</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Phát triển với Laravel 11, React 19, TypeScript, Clean Architecture &amp; Repository Pattern.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-2xl p-5 border border-sky-500/40 shadow-sm flex flex-col gap-3 relative ring-2 ring-sky-400/20 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-600 text-white font-mono text-xs font-bold flex items-center justify-center">04</span>
                        <span class="material-symbols-outlined text-sky-600 text-[20px]">bug_report</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Kiểm Thử QA &amp; Audit</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Kiểm thử tự động Pest/PHPUnit, kiểm thử chịu tải, audit bảo mật theo OWASP Top 10.</p>
                </div>

                <!-- Step 5 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 font-mono text-xs font-bold flex items-center justify-center">05</span>
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">rocket_launch</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Triển Khai CI/CD</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Đóng gói Docker, tự động hóa pipeline GitHub Actions triển khai không downtime.</p>
                </div>

                <!-- Step 6 -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:shadow-md hover:border-sky-500/40 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-mono text-xs font-bold flex items-center justify-center">06</span>
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">verified_user</span>
                    </div>
                    <h3 class="font-headline font-bold text-navy-base text-base">Bảo Trì &amp; Uptime 99.9%</h3>
                    <p class="font-body text-xs text-slate-500 leading-relaxed">Giám sát 24/7 với Sentry &amp; Prometheus, sao lưu dữ liệu tự động định kỳ.</p>
                </div>
            </div>

            <!-- Interactive Live Code Typewriter & CI/CD Terminal Dashboard -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Live Code Editor with Typewriter Effect -->
                <div class="lg:col-span-7 bg-[#0b132b] rounded-3xl p-6 sm:p-7 border border-slate-700 shadow-2xl flex flex-col">
                    <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-400 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                            <span class="ml-2 font-mono text-xs text-slate-400">routes/api.php — CuuLong Core Architecture</span>
                        </div>
                        <span class="text-[11px] font-mono text-sky-400 font-bold bg-sky-950/80 px-2.5 py-0.5 rounded border border-sky-400/30">
                            PHP 8.3 • Laravel 11
                        </span>
                    </div>

                    <!-- Code Typewriter Target -->
                    <div class="bg-[#060c18] p-5 rounded-2xl border border-white/5 font-mono text-xs sm:text-sm text-amber-300 min-h-[170px] relative overflow-hidden">
                        <pre class="font-mono leading-relaxed whitespace-pre-wrap"><code id="code-typewriter-target">Route::prefix('v1/media')-&gt;group(function () {
    Route::post('/render-4k', [VideoPipeline::class, 'transcodeMaster']);
    Route::get('/analytics/realtime', [MarTechEngine::class, 'streamRoas']);
});</code><span class="typewriter-cursor"></span></pre>
                    </div>

                    <div class="mt-4 flex items-center justify-between text-xs font-mono text-slate-400">
                        <span class="text-emerald-400 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">check_circle</span> 100% Type Safe &amp; Clean Architecture</span>
                        <span>PSR-12 Compliant</span>
                    </div>
                </div>

                <!-- Right: Mini CI/CD Realtime Dashboard -->
                <div class="lg:col-span-5 bg-[#09152b] rounded-3xl p-6 sm:p-7 border border-slate-700 shadow-2xl flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-white/10 mb-5">
                            <span class="font-headline font-bold text-white text-base flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-400 text-[20px]">tune</span>
                                CI/CD Pipeline Status
                            </span>
                            <span class="text-[10px] font-mono text-emerald-400 bg-emerald-950 px-2 py-0.5 rounded border border-emerald-500/30">
                                ACTIVE
                            </span>
                        </div>

                        <!-- Pipeline Steps -->
                        <div class="flex flex-col gap-3 font-mono text-xs">
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-white/5 border border-white/5">
                                <div class="flex items-center gap-2 text-slate-300">
                                    <span class="material-symbols-outlined text-emerald-400 text-[18px]">task_alt</span>
                                    <span>Pest Unit &amp; Feature Tests</span>
                                </div>
                                <span class="text-emerald-400 font-bold">48/48 Passed</span>
                            </div>

                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-white/5 border border-white/5">
                                <div class="flex items-center gap-2 text-slate-300">
                                    <span class="material-symbols-outlined text-emerald-400 text-[18px]">inventory_2</span>
                                    <span>Docker Image Build</span>
                                </div>
                                <span class="text-sky-400 font-bold">v4.2.0 • 24s</span>
                            </div>

                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-white/5 border border-white/5">
                                <div class="flex items-center gap-2 text-slate-300">
                                    <span class="material-symbols-outlined text-emerald-400 text-[18px]">cloud_done</span>
                                    <span>Cloudflare Edge Deploy</span>
                                </div>
                                <span class="text-amber-400 font-bold">Global 0ms</span>
                            </div>
                        </div>
                    </div>

                    <!-- Uptime Status Footnote -->
                    <div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                        <span class="text-slate-400">Server Status</span>
                        <span class="text-emerald-400 font-bold flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            99.99% Uptime Verified
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 5. [SECTION MỚI] CÔNG NGHỆ & THIẾT BỊ THỰC CHIẾN ==================== -->
<!-- LƯU Ý KỸ THUẬT: Danh sách Enterprise Tech Stack dưới đây là các công nghệ áp dụng triển khai cho các dự án khách hàng của Cửu Long Tech. Hệ thống website hiện tại được vận hành trên nền tảng Laravel 11 + Blade + Alpine.js + Tailwind CSS. -->
<section class="w-full bg-[#081023] text-white py-20 lg:py-28 relative border-b border-white/10 gsap-reveal-section" id="tech-gear-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/25 text-amber-400 text-xs font-mono font-bold tracking-wider uppercase mb-3">
                <span class="material-symbols-outlined text-[15px]">hardware</span>
                HARDWARE &amp; SOFTWARE INFRASTRUCTURE
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-4">
                Vũ Khí Thực Chiến: Thiết Bị Điện Ảnh &amp; Ngăn Xếp Công Nghệ
            </h2>
            <p class="font-body text-base sm:text-lg text-slate-400 leading-relaxed">
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
                            <h3 class="font-headline text-xl font-bold text-white">Studio Production Gear</h3>
                            <p class="text-xs font-mono text-slate-400">Trang thiết bị ghi hình &amp; hậu kỳ điện ảnh sở hữu thật</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-orange-500/10 text-orange-400 font-mono text-[11px] font-bold border border-orange-500/30">
                        CINE LAB
                    </span>
                </div>

                <!-- Gear Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Gear 1 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group" title="Máy quay điện ảnh 6K với Global Shutter loại bỏ hiện tượng méo hình chuyển động nhanh">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">RED Komodo 6K</span>
                            <span class="px-2 py-0.5 rounded bg-red-500/20 text-red-400 font-mono text-[10px] font-bold">6K RAW</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Cảm biến Super 35 Global Shutter, ghi hình 6K R3D RAW, dynamic range 16+ stops.</p>
                    </div>

                    <!-- Gear 2 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group" title="Dòng Cinema Line của Sony tối ưu ghi hình thực địa, slow-motion 120fps chất lượng cao">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">Sony FX6 Cinema</span>
                            <span class="px-2 py-0.5 rounded bg-slate-700 text-slate-200 font-mono text-[10px] font-bold">4K 120fps</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Cảm biến Full-Frame 4K, Dual Base ISO 800/12800, màu S-Cinetone chuẩn điện ảnh.</p>
                    </div>

                    <!-- Gear 3 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group" title="Bàn chỉnh màu phần cứng chuyên dụng kết hợp phần mềm DaVinci Resolve Studio bản quyền">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">DaVinci Micro Panel</span>
                            <span class="px-2 py-0.5 rounded bg-indigo-500/20 text-indigo-400 font-mono text-[10px] font-bold">32-bit Float</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Bảng điều khiển cân màu phần cứng kết hợp màn hình EIZO ColorEdge chuẩn DCI-P3.</p>
                    </div>

                    <!-- Gear 4 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group" title="Hệ thống chống rung chuyên nghiệp với motor lấy nét tự động bằng cảm biến LiDAR">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">DJI RS3 Pro &amp; LiDAR</span>
                            <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold">AF LiDAR</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Gimbal tải trọng lớn, lấy nét LiDAR ban đêm tự động và truyền hình ảnh không dây SDR.</p>
                    </div>

                    <!-- Gear 5 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group" title="Flycam cao cấp ghi hình Apple ProRes 422 HQ phục vụ các cảnh quay trên không">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">DJI Mavic 3 Cine</span>
                            <span class="px-2 py-0.5 rounded bg-amber-500/20 text-amber-400 font-mono text-[10px] font-bold">ProRes Cine</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Camera Hasselblad 4/3 CMOS, cảm biến tránh vật cản đa hướng, bay ổn định cấp bão.</p>
                    </div>

                    <!-- Gear 6 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-orange-500/40 hover:bg-white/10 transition-all group" title="Hệ thống chiếu sáng phim trường công suất lớn với chỉ số hoàn màu chính xác CRI 96+">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-primary transition-colors">Aputure 600d Pro Suite</span>
                            <span class="px-2 py-0.5 rounded bg-rose-500/20 text-rose-400 font-mono text-[10px] font-bold">CRI 96+</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Hệ thống ánh sáng studio công suất 600W, điều khiển mạng không dây Sidus Link.</p>
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
                            <h3 class="font-headline text-xl font-bold text-white">Enterprise Tech Stack</h3>
                            <p class="text-xs font-mono text-slate-400">Ngăn xếp công nghệ triển khai cho các dự án khách hàng</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-sky-500/10 text-sky-400 font-mono text-[11px] font-bold border border-sky-400/30">
                        TECH LAB
                    </span>
                </div>

                <!-- Tech Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Tech 1 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-400/40 hover:bg-white/10 transition-all group" title="Framework PHP mạnh mẽ hàng đầu thế giới với hệ sinh thái phong phú và bảo mật cao">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">Laravel 11 Core</span>
                            <span class="px-2 py-0.5 rounded bg-red-500/20 text-red-400 font-mono text-[10px] font-bold">PHP 8.3</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Eloquent ORM, Job Queues, Built-in Caching và kiến trúc bảo mật cấp doanh nghiệp.</p>
                    </div>

                    <!-- Tech 2 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-400/40 hover:bg-white/10 transition-all group" title="Thư viện UI hiện đại kết hợp Next.js hỗ trợ Server-Side Rendering và Streaming">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">React 19 &amp; Next.js</span>
                            <span class="px-2 py-0.5 rounded bg-sky-500/20 text-sky-400 font-mono text-[10px] font-bold">SSR / SSG</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Server Components, Virtual DOM, tối ưu hóa tốc độ tải trang dưới 0.5s tức thì.</p>
                    </div>

                    <!-- Tech 3 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-400/40 hover:bg-white/10 transition-all group" title="Ngôn ngữ siêu tập của JS đảm bảo mã nguồn chặt chẽ và không phát sinh lỗi runtime">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">TypeScript</span>
                            <span class="px-2 py-0.5 rounded bg-blue-500/20 text-blue-400 font-mono text-[10px] font-bold">Strict Type</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Kiểm tra kiểu dữ liệu tĩnh nghiêm ngặt, tự động sinh tài liệu API và bảo trì lâu dài.</p>
                    </div>

                    <!-- Tech 4 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-400/40 hover:bg-white/10 transition-all group" title="Thư viện chuyển động phần cứng đỉnh cao được các studio quốc tế tin cậy">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">GSAP &amp; Tailwind CSS</span>
                            <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold">60fps GPU</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Animation mượt mà tăng tốc phần cứng GPU, không giật lag và 0 Layout Shift (CLS).</p>
                    </div>

                    <!-- Tech 5 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-400/40 hover:bg-white/10 transition-all group" title="Cơ sở dữ liệu quan hệ tối ưu kết hợp bộ đệm nhớ ram Redis siêu tốc">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">MySQL 8 &amp; Redis</span>
                            <span class="px-2 py-0.5 rounded bg-rose-500/20 text-rose-400 font-mono text-[10px] font-bold">In-Memory</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Tối ưu truy vấn dữ liệu hàng triệu dòng, phản hồi cache dưới mili-giây.</p>
                    </div>

                    <!-- Tech 6 -->
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-sky-400/40 hover:bg-white/10 transition-all group" title="Container hóa chuẩn hóa môi trường triển khai trên AWS / Cloudflare">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline font-bold text-white text-sm group-hover:text-sky-400 transition-colors">Docker &amp; CI/CD</span>
                            <span class="px-2 py-0.5 rounded bg-amber-500/20 text-amber-400 font-mono text-[10px] font-bold">Auto Deploy</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Container hóa đồng nhất, tự động hóa build/test/deploy liên tục không gián đoạn.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 6. SERVICES SECTION: THREE DISTINCT PILLARS (GIỮ NGUYÊN) ==================== -->
<section class="w-full bg-surface bg-dot-grid-subtle py-20 lg:py-28 relative gsap-reveal-section" id="services-pillars">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Title -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 border border-orange-200 text-primary text-xs font-mono font-bold tracking-wider uppercase mb-3">
                <span class="material-symbols-outlined text-[15px]">layers</span>
                HỆ SINH THÁI DỊCH VỤ TOÀN DIỆN
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight mb-4">
                3 Trụ Cột Tích Hợp Tạo Nên Sức Bật Thương Hiệu
            </h2>
            <p class="font-body text-base sm:text-lg text-slate-600 leading-relaxed">
                Chúng tôi xóa bỏ ranh giới giữa Studio sản xuất hình ảnh và Công ty công nghệ, mang đến một chuỗi giá trị khép kín từ hạ tầng số đến nội dung truyền thông đỉnh cao.
            </p>
        </div>

        <!-- 3 Distinct Colored Pillar Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            <!-- Pillar Card 1: Tech Lab (Sky Blue Signature) -->
            <div class="pillar-card pillar-card-tech group relative rounded-3xl p-8 bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.06)] flex flex-col justify-between overflow-hidden">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-sky-400/15 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-200 text-sky-600 flex items-center justify-center shadow-xs group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-[30px]">terminal</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold">
                            Pillar 01 • Tech Lab
                        </span>
                    </div>
                    <h3 class="font-headline text-2xl font-extrabold text-navy-base mb-3 group-hover:text-sky-600 transition-colors">
                        Nền Tảng Công Nghệ &amp; Ứng Dụng Web/App
                    </h3>
                    <p class="font-body text-slate-600 text-sm leading-relaxed mb-6">
                        Kiến tạo hạ tầng số vững chắc, bảo mật cao và tối ưu trải nghiệm người dùng với các công nghệ lập trình tiên tiến nhất.
                    </p>
                    <ul class="space-y-3 font-body text-xs sm:text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            Thiết kế Website Doanh nghiệp &amp; Báo điện tử
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            Phát triển Web App &amp; Hệ thống Quản trị ERP
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            Tích hợp AI Chatbot &amp; Tự động hóa Dữ liệu
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            Tối ưu hiệu năng Core Web Vitals &amp; SEO Kỹ thuật
                        </li>
                    </ul>
                </div>
                <div class="pt-8 mt-6 border-t border-slate-100">
                    <a class="inline-flex items-center gap-2 font-headline text-sm font-bold text-sky-600 hover:text-sky-700 transition-colors group/link" href="{{ url('/dich-vu') }}">
                        <span>Xem chi tiết giải pháp</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar Card 2: Production Studio (Amber Signature - Highlighted) -->
            <div class="pillar-card pillar-card-media group relative rounded-3xl p-8 bg-white border-2 border-primary/40 shadow-[0_15px_40px_rgba(234,88,12,0.12)] flex flex-col justify-between overflow-hidden">
                <div class="absolute top-0 right-0 px-4 py-1.5 rounded-bl-2xl bg-gradient-to-r from-primary to-accent-amber text-white font-mono text-[11px] font-bold shadow-xs">
                    MŨI NHỌN SÁNG TẠO
                </div>
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-orange-500/15 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-orange-50 border border-orange-200 text-primary flex items-center justify-center shadow-xs group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-[30px]">movie</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold">
                            Pillar 02 • Media Studio
                        </span>
                    </div>
                    <h3 class="font-headline text-2xl font-extrabold text-navy-base mb-3 group-hover:text-primary transition-colors">
                        Sản Xuất Truyền Thông &amp; Phim Doanh Nghiệp
                    </h3>
                    <p class="font-body text-slate-600 text-sm leading-relaxed mb-6">
                        Kể câu chuyện thương hiệu bằng ngôn ngữ điện ảnh 4K sắc sảo, khơi gợi cảm xúc và thúc đẩy hành động mạnh mẽ từ khách hàng.
                    </p>
                    <ul class="space-y-3 font-body text-xs sm:text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Sản xuất TVC Quảng cáo &amp; Phim Doanh nghiệp 4K
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Video ngắn Viral TikTok, Reels, YouTube Shorts
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Quay chụp Sự kiện, Hội nghị &amp; Khảo sát Flycam
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Color Grading DaVinci Resolve &amp; Kỹ xảo 3D/VFX
                        </li>
                    </ul>
                </div>
                <div class="pt-8 mt-6 border-t border-slate-100">
                    <a class="inline-flex items-center gap-2 font-headline text-sm font-bold text-primary hover:text-orange-700 transition-colors group/link" href="{{ url('/dich-vu') }}">
                        <span>Xem chi tiết giải pháp</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar Card 3: Omni-channel Growth (Coral/Rose Signature) -->
            <div class="pillar-card pillar-card-ads group relative rounded-3xl p-8 bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.06)] flex flex-col justify-between overflow-hidden">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-rose-400/15 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-rose-50 border border-rose-200 text-accent-coral flex items-center justify-center shadow-xs group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-[30px]">query_stats</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-800 font-mono text-xs font-bold">
                            Pillar 03 • Digital Growth
                        </span>
                    </div>
                    <h3 class="font-headline text-2xl font-extrabold text-navy-base mb-3 group-hover:text-accent-coral transition-colors">
                        Chiến Dịch Số &amp; Tăng Trưởng Doanh Thu
                    </h3>
                    <p class="font-body text-slate-600 text-sm leading-relaxed mb-6">
                        Tối ưu hóa phễu chuyển đổi đa kênh, phân phối nội dung thông minh và tối đa hóa chỉ số lợi tức đầu tư (ROAS) cho doanh nghiệp.
                    </p>
                    <ul class="space-y-3 font-body text-xs sm:text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent-coral"></span>
                            Quảng cáo Performance đa kênh (Meta, TikTok, Google)
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent-coral"></span>
                            Chiến dịch Viral Booking KOC/KOL Chuyên biệt
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent-coral"></span>
                            Quản trị &amp; Phát triển Fanpage / Kênh TikTok triệu views
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent-coral"></span>
                            Tối ưu hóa Tỷ lệ Chuyển đổi CRO &amp; Phễu bán hàng
                        </li>
                    </ul>
                </div>
                <div class="pt-8 mt-6 border-t border-slate-100">
                    <a class="inline-flex items-center gap-2 font-headline text-sm font-bold text-accent-coral hover:text-rose-700 transition-colors group/link" href="{{ url('/dich-vu') }}">
                        <span>Xem chi tiết giải pháp</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 7. STATS SECTION (GSAP SCROLLTRIGGER COUNTER) ==================== -->
<section class="w-full bg-white py-14 border-b border-slate-200/80 gsap-reveal-section" id="stats-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Stat 1 -->
            <div class="flex flex-col items-center text-center gap-2">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center mb-1">
                    <span class="material-symbols-outlined text-[26px]">schedule</span>
                </div>
                <div class="font-headline text-4xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="10" data-suffix="+">0+</span>
                </div>
                <span class="font-mono text-xs uppercase tracking-wider text-slate-500 font-semibold">Năm Kinh Nghiệm Thực Chiến</span>
            </div>

            <!-- Stat 2 -->
            <div class="flex flex-col items-center text-center gap-2">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center mb-1">
                    <span class="material-symbols-outlined text-[26px]">movie_filter</span>
                </div>
                <div class="font-headline text-4xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="850" data-suffix="+">0+</span>
                </div>
                <span class="font-mono text-xs uppercase tracking-wider text-slate-500 font-semibold">Dự Án Video &amp; Nền Tảng Số</span>
            </div>

            <!-- Stat 3 -->
            <div class="flex flex-col items-center text-center gap-2">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-1">
                    <span class="material-symbols-outlined text-[26px]">handshake</span>
                </div>
                <div class="font-headline text-4xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="320" data-suffix="+">0+</span>
                </div>
                <span class="font-mono text-xs uppercase tracking-wider text-slate-500 font-semibold">Khách Hàng Doanh Nghiệp</span>
            </div>

            <!-- Stat 4 -->
            <div class="flex flex-col items-center text-center gap-2">
                <div class="stat-icon w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-1">
                    <span class="material-symbols-outlined text-[26px]">sentiment_very_satisfied</span>
                </div>
                <div class="font-headline text-4xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                    <span class="stat-counter" data-target="99.2" data-suffix="%">0%</span>
                </div>
                <span class="font-mono text-xs uppercase tracking-wider text-slate-500 font-semibold">Tỷ Lệ Hài Lòng &amp; Tái Ký</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 8. "WHY CHOOSE US" (SPOTLIGHT MOUSE OVERLAY) ==================== -->
<section class="w-full bg-navy-base bg-dot-grid-dark py-20 lg:py-28 text-white relative overflow-hidden border-y border-white/10 gsap-reveal-section" id="why-clm">
    <!-- Interactive Mouse Spotlight Overlay -->
    <div class="spotlight-overlay absolute inset-0 z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Header Info -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-amber-400 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>TẠI SAO CHỌN CỬU LONG MEDIA &amp; TECH?</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Sự Kết Hợp Độc Bản Giữa Nghệ Thuật &amp; Kỹ Thuật
                </h2>
                <p class="font-body text-slate-300 text-base sm:text-lg leading-relaxed">
                    Hầu hết các agency chỉ làm tốt một nửa câu chuyện: hoặc giỏi sáng tạo nội dung nhưng yếu công nghệ, hoặc mạnh lập trình nhưng thiếu tư duy truyền thông. Cửu Long hợp nhất cả hai trong một thể thống nhất.
                </p>
                <div class="pt-2">
                    <a class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-sm font-bold shadow-lg hover:shadow-orange-500/30 transition-all hover:scale-105" href="{{ url('/ve-chung-toi') }}">
                        <span>Tìm Hiểu Đội Ngũ Cửu Long</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Right 4 Advantage Cards with Ambient Glow -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Advantage 1 -->
                <div class="why-card p-6 rounded-2xl bg-navy-surface/80 backdrop-blur-md border border-white/10 hover:border-amber-400/50 transition-all duration-300 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-orange-500/20 text-orange-400 flex items-center justify-center animate-ambient-glow">
                        <span class="material-symbols-outlined text-[26px]">hub</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">
                        Hệ Sinh Thái Khép Kín 360°
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Từ ý tưởng kịch bản, quay phim 4K, thiết kế giao diện, lập trình backend đến triển khai quảng cáo đa kênh — không qua trung gian.
                    </p>
                </div>

                <!-- Advantage 2 -->
                <div class="why-card p-6 rounded-2xl bg-navy-surface/80 backdrop-blur-md border border-white/10 hover:border-sky-400/50 transition-all duration-300 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center animate-ambient-glow">
                        <span class="material-symbols-outlined text-[26px]">memory</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-sky-400 transition-colors">
                        Trang Thiết Bị &amp; Tech Đỉnh Cao
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Sở hữu máy quay RED Komodo 6K, Sony FX6, bàn chỉnh màu DaVinci Resolve Studio và hạ tầng máy chủ hiệu năng cao bảo mật tuyệt đối.
                    </p>
                </div>

                <!-- Advantage 3 -->
                <div class="why-card p-6 rounded-2xl bg-navy-surface/80 backdrop-blur-md border border-white/10 hover:border-rose-400/50 transition-all duration-300 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center animate-ambient-glow">
                        <span class="material-symbols-outlined text-[26px]">monitoring</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-rose-400 transition-colors">
                        Cam Kết Bằng Số Liệu &amp; KPI
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Mọi chiến dịch truyền thông và hệ thống phần mềm đều được đo lường cụ thể theo số lượt chuyển đổi, traffic và tốc độ phản hồi.
                    </p>
                </div>

                <!-- Advantage 4 -->
                <div class="why-card p-6 rounded-2xl bg-navy-surface/80 backdrop-blur-md border border-white/10 hover:border-emerald-400/50 transition-all duration-300 flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center animate-ambient-glow">
                        <span class="material-symbols-outlined text-[26px]">support_agent</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">
                        Hỗ Trợ Kỹ Thuật 24/7 &amp; Bảo Hành
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Đội ngũ kỹ sư và chuyên viên truyền thông đồng hành liên tục cùng khách hàng, khắc phục sự cố tức thời và cập nhật định kỳ.
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
