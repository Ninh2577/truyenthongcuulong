<section class="relative w-full overflow-hidden bg-surface bg-dot-grid-subtle py-14 lg:py-20 border-b border-slate-200/80" id="hero-section">
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
                    <a id="hero-play-cta" class="btn-secondary-cta magnetic-btn cursor-pointer" href="#hero-studio-console">
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

            <!-- Right Column: Interactive Studio Console Showreel Player -->
            <div class="lg:col-span-5 relative" id="hero-studio-console">
                <div class="relative mx-auto max-w-lg rounded-3xl bg-[#081023] p-4 text-white shadow-2xl border border-white/15 overflow-hidden">
                    <!-- Top Window Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-white/10 text-xs text-slate-400 font-mono">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500/80 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block"></span>
                            <span class="ml-2 text-slate-300 font-semibold truncate">TRUYEN_THONG_CUU_LONG_SHOWREEL.mov</span>
                        </div>
                        <span class="px-2 py-0.5 rounded bg-white/10 text-[10px] sm:text-[11px] text-amber-300 font-bold shrink-0">4K 25FPS</span>
                    </div>

                    <!-- Video Preview Screen in Mockup with DaVinci Player -->
                    <div id="showreel-container" class="relative my-3 rounded-2xl overflow-hidden bg-black border border-white/10 aspect-video group">
                        <video id="showreel-main-video" 
                               class="w-full h-full object-cover cursor-pointer" 
                               preload="metadata"
                               playsinline
                               poster="{{ asset('images/showreel-cinematic-poster.webp') }}?v=real">
                            <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4" type="video/mp4">
                            Trình duyệt không hỗ trợ phát video.
                        </video>
                        
                        <!-- 56px Center Glassmorphism Play Button with Radiant Continuous Pulse Loop -->
                        <button id="showreel-center-play" 
                                aria-label="Phát video Showreel" 
                                class="absolute inset-0 m-auto w-14 h-14 rounded-full bg-white/25 backdrop-blur-md border border-white/50 shadow-[0_0_35px_rgba(234,88,12,0.7)] flex items-center justify-center text-white hover:bg-white/35 hover:scale-110 active:scale-95 transition-all z-20 cursor-pointer">
                            <span class="absolute inset-0 rounded-full border-2 border-orange-500 animate-radiant-glow pointer-events-none"></span>
                            <span class="material-symbols-outlined text-[32px] ml-0.5 text-white filter drop-shadow">play_arrow</span>
                        </button>

                        <!-- Top REC Tag & Timecode -->
                        <div class="absolute top-3 left-3 flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-black/60 backdrop-blur-md text-[11px] font-mono text-white border border-white/15 z-10 pointer-events-none">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-rec-pulse"></span>
                            <span class="font-bold tracking-wider">REC</span>
                            <span id="showreel-timecode" class="text-slate-300 font-mono ml-1">00:00:00:00</span>
                        </div>

                        <!-- Bottom Audio Waveform & Player Action Buttons -->
                        <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between z-10 pointer-events-none">
                            <div class="flex items-end gap-1 px-2.5 py-1.5 rounded-md bg-black/60 backdrop-blur-md border border-white/15">
                                <span class="text-[9px] font-mono text-slate-400 mr-1">AUDIO</span>
                                <span class="w-1 bg-emerald-400 rounded-full wave-bar-1"></span>
                                <span class="w-1 bg-emerald-400 rounded-full wave-bar-2"></span>
                                <span class="w-1 bg-emerald-400 rounded-full wave-bar-3"></span>
                                <span class="w-1 bg-amber-400 rounded-full wave-bar-1"></span>
                                <span class="w-1 bg-primary rounded-full wave-bar-2"></span>
                            </div>

                            <div class="flex items-center gap-2 pointer-events-auto">
                                <button id="showreel-mute-btn" aria-label="Bật/Tắt âm thanh" class="w-7 h-7 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition-colors cursor-pointer">
                                    <span id="showreel-mute-icon" class="material-symbols-outlined text-[16px]">volume_off</span>
                                </button>
                                <button id="showreel-fullscreen-btn" aria-label="Toàn màn hình" class="w-7 h-7 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px]">fullscreen</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Studio Timeline Track with Synced Scrubber & Animated Playhead -->
                    <div class="mt-2 p-3 rounded-xl bg-slate-900/90 border border-white/10 font-mono text-xs">
                        <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1.5">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-amber-400 inline-block shadow-[0_0_6px_rgba(245,158,11,0.8)]"></span>
                                <span class="text-slate-300 font-semibold text-[10px]">TIMELINE SCRUBBER &bull; 25FPS</span>
                            </div>
                            <span class="text-amber-300 font-bold text-[10px]">PRORES 422HQ</span>
                        </div>

                        <!-- Timeline Scrubber Track with SVG Audio Waveform -->
                        <div id="showreel-scrubber" class="davinci-scrubber-track w-full h-7 relative cursor-pointer overflow-hidden rounded-lg bg-slate-950 border border-white/15">
                            <svg class="davinci-waveform-bg w-full h-full" preserveAspectRatio="none" viewBox="0 0 500 28" fill="none">
                                <path d="M0 14 Q 5 6, 10 14 T 20 14 T 30 5 T 40 23 T 50 14 T 60 8 T 70 20 T 80 14 T 90 2 T 100 26 T 110 14 T 120 7 T 130 21 T 140 14 T 150 4 T 160 24 T 170 14 T 180 9 T 190 19 T 200 14 T 210 3 T 220 25 T 230 14 T 240 8 T 250 20 T 260 14 T 270 5 T 280 23 T 290 14 T 300 2 T 310 26 T 320 14 T 330 7 T 340 21 T 350 14 T 360 4 T 370 24 T 380 14 T 390 9 T 400 19 T 410 14 T 420 3 T 430 25 T 440 14 T 450 8 T 460 20 T 470 14 T 480 6 T 490 22 T 500 14" stroke="rgba(255,255,255,0.4)" stroke-width="1.6" />
                            </svg>

                            <!-- Progress Bar with Amber Gradient Fill -->
                            <div id="showreel-progress-bar" class="davinci-scrubber-progress absolute top-0 bottom-0 left-0 bg-gradient-to-r from-primary/50 to-amber-400/50 w-0 pointer-events-none"></div>

                            <!-- Red Playhead Line with Triangular Top Cap -->
                            <div id="showreel-playhead" class="davinci-playhead-line absolute top-0 bottom-0 w-0.5 bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.9)] z-20 pointer-events-none" style="left: 0%;">
                                <div class="w-2.5 h-2.5 bg-red-500 -ml-1 rotate-45 rounded-xs"></div>
                            </div>
                        </div>

                        <!-- Credit Footer Line -->
                        <div class="mt-2 text-[10px] text-slate-400 text-center truncate">
                            REEL 2026 &bull; DIRECTED &amp; PRODUCED BY TRUYỀN THÔNG CỬU LONG
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>