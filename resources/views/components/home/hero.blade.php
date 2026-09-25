<section class="relative w-full overflow-hidden bg-surface bg-dot-grid-subtle py-10 sm:py-14 lg:py-18 border-b border-slate-200/80" id="hero-section">
    <!-- Ambient Tech Lighting (Sky/Navy Primary with Warm Amber Accent) -->
    <div class="absolute -top-24 right-0 w-[520px] h-[520px] rounded-full bg-gradient-to-br from-sky-500/12 via-primary/8 to-transparent blur-3xl pointer-events-none -mr-20"></div>
    <div class="absolute -bottom-28 left-4 w-[420px] h-[420px] rounded-full bg-gradient-to-tr from-amber-400/8 via-sky-300/8 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
            
            <!-- Left Column: Technology-First Positioning, Headline, Value Proposition & CTAs (7 cols) -->
            <div class="lg:col-span-7 flex flex-col gap-5 sm:gap-6">
                <!-- Eyebrow: Technology & Digital Solutions Dominant -->
                <div class="hero-fade-item inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-sky-50 border border-sky-200/80 text-sky-800 corporate-eyebrow w-fit shadow-2xs">
                    <span class="inline-block w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>TRUYỀN THÔNG CỬU LONG &bull; TECHNOLOGY &amp; DIGITAL SOLUTIONS</span>
                </div>

                <!-- Primary H1: Technology Core & Digital Solutions (Strictly 1 H1 on page) -->
                <h1 class="corporate-heading text-3xl sm:text-4xl lg:text-[44px] xl:text-[48px] lg:leading-[1.18] text-[#070F1E] font-extrabold tracking-tight">
                    <span class="hero-reveal-line block">Giải Pháp Web, Web App</span>
                    <span class="hero-reveal-line block text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-sky-600">
                        &amp; Hệ Thống Số Doanh Nghiệp
                    </span>
                    <span class="hero-reveal-line block text-slate-800 text-2xl sm:text-3xl lg:text-[34px] font-bold mt-1 font-headline">
                        chuẩn kiến trúc công nghệ hiện đại.
                    </span>
                </h1>

                <!-- Supporting Copy: Clear, authoritative value proposition -->
                <p class="hero-fade-item corporate-body text-base sm:text-lg text-slate-600 max-w-2xl leading-relaxed">
                    Thiết kế và phát triển nền tảng số phù hợp với quy trình vận hành và mục tiêu tăng trưởng thực tế của doanh nghiệp. Tích hợp năng lực Media in-house hỗ trợ sản xuất visual assets chuẩn mực.
                </p>

                <!-- Action CTAs: Primary (Bắt đầu dự án) & Secondary (Xem giải pháp) -->
                <div class="hero-fade-item flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-1">
                    <!-- Primary CTA -->
                    <a class="btn-primary-cta magnetic-btn inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-sm font-bold shadow-lg shadow-navy-base/20 hover:scale-[1.02] active:scale-[0.98] transition-all group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none" 
                       href="{{ route('contact') }}">
                        <span>Bắt đầu dự án</span>
                        <span class="material-symbols-outlined text-[18px] text-amber-400 group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                    </a>

                    <!-- Secondary CTA -->
                    <a class="btn-secondary-cta magnetic-btn inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full bg-white hover:bg-slate-50 text-slate-700 hover:text-primary font-headline text-sm font-bold border border-slate-200/90 shadow-2xs hover:border-primary/40 transition-all group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none" 
                       href="{{ route('services.index') }}">
                        <span>Xem giải pháp</span>
                        <span class="material-symbols-outlined text-[18px] text-slate-400 group-hover:text-primary transition-colors">terminal</span>
                    </a>
                </div>

                <!-- Verified Capabilities / Trust Strip (No fake metrics) -->
                <div class="hero-fade-item pt-4 border-t border-slate-200/80">
                    <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block mb-2.5">
                        NĂNG LỰC GIẢI PHÁP CỐT LÕI
                    </span>
                    <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 text-xs">
                        <!-- Chip 1: Web Development -->
                        <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-primary hover:text-primary transition-colors font-medium shadow-2xs">
                            <span class="material-symbols-outlined text-[16px] text-primary">code</span>
                            <span>Lập trình Web-App</span>
                        </a>

                        <!-- Chip 2: Kho Giao Diện 39+ Mẫu -->
                        <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-primary hover:text-primary transition-colors font-medium shadow-2xs">
                            <span class="material-symbols-outlined text-[16px] text-sky-600">dashboard</span>
                            <span>Kho Giao Diện (39+ Mẫu)</span>
                        </a>

                        <!-- Chip 3: Tối Ưu SEO & Tăng Trưởng -->
                        <a href="{{ route('services.marketing') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-primary hover:text-primary transition-colors font-medium shadow-2xs">
                            <span class="material-symbols-outlined text-[16px] text-emerald-600">trending_up</span>
                            <span>Tối Ưu SEO &amp; Số Hóa</span>
                        </a>

                        <!-- Chip 4: Media in-house hỗ trợ -->
                        <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200/80 text-slate-600 hover:border-amber-500 hover:text-amber-700 transition-colors font-medium">
                            <span class="material-symbols-outlined text-[16px] text-amber-600">videocam</span>
                            <span>Media In-House Hỗ Trợ</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Technology-First Platform Console & Interface Mockup (5 cols) -->
            <div class="lg:col-span-5 relative" id="hero-tech-console">
                <div class="relative mx-auto max-w-lg rounded-3xl bg-[#070F1E] p-4 text-white shadow-2xl border border-sky-500/25 overflow-hidden" role="region" aria-label="Giao diện giải pháp công nghệ số">
                    <!-- Browser / Console Top Window Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-white/10 text-xs text-slate-400 font-mono">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500/80 inline-block" aria-hidden="true"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block" aria-hidden="true"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block" aria-hidden="true"></span>
                            <span class="ml-2 text-sky-300 font-semibold truncate text-[11px] sm:text-xs">cuulong.digital/solutions/web-app</span>
                        </div>
                        <span class="px-2 py-0.5 rounded bg-emerald-950/80 text-[10px] text-emerald-400 font-mono font-bold border border-emerald-400/30 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>ONLINE</span>
                        </span>
                    </div>

                    <!-- Inner Application Interface Dashboard Preview -->
                    <div class="my-3 rounded-2xl overflow-hidden bg-slate-950 border border-white/10 p-3 sm:p-4 space-y-3 font-sans">
                        <!-- Module Highlights Grid -->
                        <div class="grid grid-cols-3 gap-2 text-center font-mono">
                            <div class="p-2 rounded-xl bg-white/5 border border-white/10">
                                <span class="block text-[9px] text-slate-400 uppercase tracking-wider">KIẾN TRÚC</span>
                                <span class="font-headline font-bold text-xs text-sky-400 block mt-0.5">Web-App</span>
                            </div>
                            <div class="p-2 rounded-xl bg-white/5 border border-white/10">
                                <span class="block text-[9px] text-slate-400 uppercase tracking-wider">TỐI ƯU</span>
                                <span class="font-headline font-bold text-xs text-emerald-400 block mt-0.5">SEO &amp; Tốc Độ</span>
                            </div>
                            <div class="p-2 rounded-xl bg-white/5 border border-white/10">
                                <span class="block text-[9px] text-slate-400 uppercase tracking-wider">HỖ TRỢ</span>
                                <span class="font-headline font-bold text-xs text-amber-400 block mt-0.5">Media 4K</span>
                            </div>
                        </div>

                        <!-- Live Architecture Modules Preview -->
                        <div class="space-y-2 pt-1">
                            <div class="flex items-center justify-between text-[11px] text-slate-400 font-mono pb-1 border-b border-white/10">
                                <span>CÁC PHÂN HỆ TRIỂN KHAI</span>
                                <span class="text-sky-400 font-semibold">Ready to Deploy</span>
                            </div>

                            <!-- Module Card 1 -->
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">web</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold text-white truncate font-headline">Cổng Thông Tin Doanh Nghiệp</div>
                                    <div class="text-[10px] text-slate-400 truncate">Thiết kế tùy biến, chuẩn SEO &amp; tối ưu tải trang</div>
                                </div>
                                <span class="material-symbols-outlined text-[16px] text-slate-500">check_circle</span>
                            </div>

                            <!-- Module Card 2 -->
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">terminal</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold text-white truncate font-headline">Web-App &amp; Hệ Thống Nghiệp Vụ</div>
                                    <div class="text-[10px] text-slate-400 truncate">Xử lý quy trình quản trị, phân quyền và dữ liệu số</div>
                                </div>
                                <span class="material-symbols-outlined text-[16px] text-slate-500">check_circle</span>
                            </div>

                            <!-- Module Card 3 -->
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">movie</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold text-white truncate font-headline">Gói Media &amp; Visual Assets In-House</div>
                                    <div class="text-[10px] text-slate-400 truncate">Hình ảnh nhận diện, video giới thiệu đồng bộ cho web</div>
                                </div>
                                <span class="material-symbols-outlined text-[16px] text-slate-500">check_circle</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Quick Action Link to Template Library -->
                    <div class="p-3 rounded-xl bg-slate-900/90 border border-white/10 font-mono text-xs flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" aria-hidden="true"></span>
                            <span class="text-slate-300 text-[11px]">Kho Giao Diện Dựng Sẵn</span>
                        </div>
                        <a href="{{ route('templates.index') }}" 
                           class="text-sky-400 hover:text-sky-300 font-bold inline-flex items-center gap-1 text-[11px] transition-colors focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                            <span>Xem kho giao diện</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>