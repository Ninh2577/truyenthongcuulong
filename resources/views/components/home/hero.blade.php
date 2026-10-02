{{-- 
    HOMEPAGE HERO BANNER (ROTATING SLIDER / CAROUSEL)
    Hỗ trợ 2 banner luân phiên tự động chuyển đổi:
    Banner 1: Phát triển phần mềm với tư duy chiến lược • Technology & Digital Solutions (1983 x 793)
    Banner 2: Bạn Đang Có Một Bài Toán Cần Giải Quyết? • Tư vấn - Giải pháp - Đồng hành (1983 x 793)
    Kích thước chuẩn đồng nhất 100%, không bị giật trang khi chuyển slide.
--}}
<section class="relative w-full overflow-hidden bg-white border-b border-slate-200/80 pt-0 group" 
         id="hero-section"
         x-data="{
             currentSlide: 0,
             totalSlides: 2,
             autoplayInterval: null,
             isVisible: true,
             init() {
                 this.startAutoplay();

                 if ('IntersectionObserver' in window) {
                     const observer = new IntersectionObserver((entries) => {
                         entries.forEach(entry => {
                             this.isVisible = entry.isIntersecting;
                             if (this.isVisible) {
                                 this.startAutoplay();
                             } else {
                                 this.stopAutoplay();
                             }
                         });
                     }, { threshold: 0 });
                     observer.observe(this.$el);
                 }

                 document.addEventListener('visibilitychange', () => {
                     if (document.hidden) {
                         this.stopAutoplay();
                     } else if (this.isVisible) {
                         this.startAutoplay();
                     }
                 });
             },
             startAutoplay() {
                 this.stopAutoplay();
                 this.autoplayInterval = setInterval(() => {
                     this.nextSlide();
                 }, 3500);
             },
             stopAutoplay() {
                 if (this.autoplayInterval) {
                     clearInterval(this.autoplayInterval);
                     this.autoplayInterval = null;
                 }
             },
             nextSlide() {
                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
             }
         }">

    {{-- Semantic Headings for SEO & Accessibility --}}
    <div class="sr-only">
        <h1>Phát triển phần mềm với tư duy chiến lược - Truyền Thông Cửu Long</h1>
        <h2>Đồng hành cùng doanh nghiệp kiến tạo giá trị số bền vững</h2>
        <h2>Giải Pháp Web, Web App &amp; Hệ Thống Số Doanh Nghiệp</h2>
        <p>Thiết kế và xây dựng website, Web App cùng hệ thống quản trị theo nhu cầu thực tế. Tư vấn giải pháp công nghệ và media thương hiệu trọn gói.</p>
        <h2>Bạn Đang Có Một Bài Toán Cần Giải Quyết?</h2>
        <p>Trao đổi với Cửu Long để làm rõ bài toán, phạm vi và hướng triển khai. Chúng tôi luôn sẵn sàng lắng nghe và đưa ra giải pháp phù hợp nhất với mục tiêu của bạn.</p>
    </div>

    {{-- ==================== CHÍNH DIỆN: FULL-WIDTH SLIDER (EDGE-TO-EDGE 100%) ==================== --}}
    <div class="relative w-full bg-[#0b1324] overflow-hidden select-none aspect-[1983/793] hero-page-flip-container" style="aspect-ratio: 1983/793; min-height: 240px;">
        <div class="grid grid-cols-1 grid-rows-1 w-full h-full">
            
            <!-- ==================== SLIDE 1 ==================== -->
            <div x-show="currentSlide === 0"
                 x-transition:enter="page-turn-enter-active"
                 x-transition:enter-start="page-turn-enter-start"
                 x-transition:enter-end="page-turn-enter-end"
                 x-transition:leave="page-turn-leave-active"
                 x-transition:leave-start="page-turn-leave-start"
                 x-transition:leave-end="page-turn-leave-end"
                 class="col-start-1 row-start-1 w-full h-full relative hero-page-flip-slide">
                
                <picture class="w-full h-full block">
                    <source srcset="{{ asset('images/banner_home_cuulong.webp') }}?v={{ file_exists(public_path('images/banner_home_cuulong.webp')) ? filemtime(public_path('images/banner_home_cuulong.webp')) : time() }}" type="image/webp">
                    <img 
                        src="{{ asset('images/banner_home_cuulong.png') }}?v={{ filemtime(public_path('images/banner_home_cuulong.png')) }}" 
                        alt="Phát triển phần mềm với tư duy chiến lược • Truyền Thông Cửu Long" 
                        class="w-full h-full object-cover block select-none"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                        width="1983"
                        height="793"
                        style="image-rendering: -webkit-optimize-contrast;"
                    >
                </picture>

                {{-- Hotspot Overlay Slide 1 (Desktop / Laptop / Tablet) --}}
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    {{-- Nút Bắt đầu dự án --}}
                    <a href="{{ route('contact') }}" 
                       class="hero-hotspot-btn group absolute pointer-events-auto rounded-full cursor-pointer transition-transform duration-300 ease-out hover:-translate-y-1 hover:scale-[1.02] active:translate-y-0 active:scale-[0.98] select-none"
                       style="left: 6.9%; top: 69.3%; width: 12.2%; height: 7.6%; outline: none !important; border: none !important;"
                       title="Bắt đầu dự án"
                       aria-label="Bắt đầu dự án">
                    </a>

                    {{-- Nút Xem giải pháp --}}
                    <a href="{{ route('services.index') }}" 
                       class="hero-hotspot-btn group absolute pointer-events-auto rounded-full cursor-pointer transition-transform duration-300 ease-out hover:-translate-y-1 hover:scale-[1.02] active:translate-y-0 active:scale-[0.98] select-none"
                       style="left: 20.0%; top: 69.3%; width: 12.8%; height: 7.6%; outline: none !important; border: none !important;"
                       title="Xem giải pháp"
                       aria-label="Xem giải pháp">
                    </a>
                </div>
            </div>

            <!-- ==================== SLIDE 2 ==================== -->
            <div x-show="currentSlide === 1"
                 x-cloak
                 x-transition:enter="page-turn-enter-active"
                 x-transition:enter-start="page-turn-enter-start"
                 x-transition:enter-end="page-turn-enter-end"
                 x-transition:leave="page-turn-leave-active"
                 x-transition:leave-start="page-turn-leave-start"
                 x-transition:leave-end="page-turn-leave-end"
                 class="col-start-1 row-start-1 w-full h-full relative hero-page-flip-slide">
                
                <picture class="w-full h-full block">
                    <source srcset="{{ asset('images/banner_home_cuulong_2.webp') }}?v={{ file_exists(public_path('images/banner_home_cuulong_2.webp')) ? filemtime(public_path('images/banner_home_cuulong_2.webp')) : time() }}" type="image/webp">
                    <img 
                        src="{{ asset('images/banner_home_cuulong_2.png') }}?v={{ file_exists(public_path('images/banner_home_cuulong_2.png')) ? filemtime(public_path('images/banner_home_cuulong_2.png')) : time() }}" 
                        alt="Bạn Đang Có Một Bài Toán Cần Giải Quyết? • Truyền Thông Cửu Long" 
                        class="w-full h-full object-cover block select-none"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                        width="1983"
                        height="793"
                        style="image-rendering: -webkit-optimize-contrast;"
                    >
                </picture>

                {{-- Hotspot Overlay Slide 2 (Desktop / Laptop / Tablet) --}}
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    {{-- Nút Bắt đầu dự án --}}
                    <a href="{{ route('contact') }}" 
                       class="hero-hotspot-btn group absolute pointer-events-auto rounded-full cursor-pointer transition-transform duration-300 ease-out hover:-translate-y-1 hover:scale-[1.02] active:translate-y-0 active:scale-[0.98] select-none"
                       style="left: 5.0%; top: 57.6%; width: 15.6%; height: 8.7%; outline: none !important; border: none !important;"
                       title="Bắt đầu dự án"
                       aria-label="Bắt đầu dự án">
                    </a>

                    {{-- Nút Xem giải pháp công nghệ --}}
                    <a href="{{ route('services.index') }}" 
                       class="hero-hotspot-btn group absolute pointer-events-auto rounded-full cursor-pointer transition-transform duration-300 ease-out hover:-translate-y-1 hover:scale-[1.02] active:translate-y-0 active:scale-[0.98] select-none"
                       style="left: 21.6%; top: 57.6%; width: 18.6%; height: 8.7%; outline: none !important; border: none !important;"
                       title="Xem giải pháp công nghệ"
                       aria-label="Xem giải pháp công nghệ">
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Mobile Action Buttons: Giúp người dùng điện thoại chạm bấm dễ dàng mà không cần zoom ảnh --}}
    <div class="max-w-7xl mx-auto px-4 py-3 sm:hidden">
        <div class="flex items-center gap-3">
            <a href="{{ route('contact') }}" class="flex-1 py-3 px-4 rounded-xl bg-primary text-white font-headline font-bold text-xs flex items-center justify-center gap-1.5 shadow-md active:scale-95 transition-all text-center">
                <span>Bắt đầu dự án</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
            <a href="{{ route('services.index') }}" class="flex-1 py-3 px-4 rounded-xl bg-white border border-slate-300 text-slate-800 font-headline font-bold text-xs flex items-center justify-center gap-1.5 shadow-xs active:scale-95 transition-all text-center">
                <span>Xem giải pháp</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    </div>

    {{-- ==================== NĂNG LỰC GIẢI PHÁP CỐT LÕI (CAPABILITY CHIPS STRIP) ==================== --}}
    @php
        $heroTemplateCount = $heroTemplateCount ?? ((isset($websiteTemplates) && count($websiteTemplates) > 0) ? count($websiteTemplates) : 70);
    @endphp

    <div class="w-full bg-slate-50/80 border-t border-slate-200/80 py-3.5 sm:py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[11px] font-mono uppercase tracking-wider text-slate-500 font-bold">
                    NĂNG LỰC GIẢI PHÁP CỐT LÕI
                </span>
            </div>
            <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 text-xs">
                <!-- Chip 1: Web Development -->
                <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-primary hover:text-primary hover:shadow-xs hover:-translate-y-0.5 transition-all font-medium shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-primary" aria-hidden="true">code</span>
                    <span>Lập trình Web-App</span>
                </a>

                <!-- Chip 2: Kho Giao Diện Thư Viện Mẫu -->
                <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-primary hover:text-primary hover:shadow-xs hover:-translate-y-0.5 transition-all font-medium shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-sky-600" aria-hidden="true">dashboard</span>
                    <span>Kho Giao Diện ({{ $heroTemplateCount }}+ Mẫu)</span>
                </a>

                <!-- Chip 3: Tối Ưu SEO & Tăng Trưởng -->
                <a href="{{ route('services.marketing') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-primary hover:text-primary hover:shadow-xs hover:-translate-y-0.5 transition-all font-medium shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-emerald-600" aria-hidden="true">trending_up</span>
                    <span>Tối Ưu SEO &amp; Số Hóa</span>
                </a>

                <!-- Chip 4: Media in-house hỗ trợ -->
                <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-amber-500 hover:text-amber-700 hover:shadow-xs hover:-translate-y-0.5 transition-all font-medium shadow-2xs focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-amber-600" aria-hidden="true">videocam</span>
                    <span>Media In-House Hỗ Trợ</span>
                </a>
            </div>
        </div>
    </div>
</section>