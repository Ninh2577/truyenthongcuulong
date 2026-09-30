{{-- 
    HOMEPAGE HERO BANNER (FULL WIDTH / EDGE-TO-EDGE)
    Banner đồ họa chính thức: Phát triển phần mềm với tư duy chiến lược • Technology & Digital Solutions.
    Hiển thị full trang (edge-to-edge 100%) không bị giới hạn container, bắt đầu ngay dưới thanh điều hướng.
--}}
<section class="relative w-full overflow-hidden bg-white border-b border-slate-200/80 pt-0" id="hero-section">
    {{-- Semantic Headings for SEO & Accessibility (Nội dung khớp chuẩn xác với chữ trong đồ họa) --}}
    <div class="sr-only">
        <h1>Phát triển phần mềm với tư duy chiến lược - Truyền Thông Cửu Long</h1>
        <h2>Đồng hành cùng doanh nghiệp kiến tạo giá trị số bền vững</h2>
        <p>Thiết kế và xây dựng website, Web App cùng hệ thống quản trị theo nhu cầu thực tế, giúp doanh nghiệp số hóa quy trình và kiểm soát hoạt động hiệu quả hơn. Năng lực Media in-house hỗ trợ sản xuất visual assets chuẩn mực.</p>
    </div>

    {{-- ==================== CHÍNH DIỆN: FULL-WIDTH BANNER (EDGE-TO-EDGE 100%) ==================== --}}
    <div class="relative w-full bg-[#0b1324] overflow-hidden">
        <picture>
            <source srcset="{{ asset('images/banner_home_cuulong.png') }}?v={{ filemtime(public_path('images/banner_home_cuulong.png')) }}" type="image/png">
            <img 
                src="{{ asset('images/banner_home_cuulong.png') }}?v={{ filemtime(public_path('images/banner_home_cuulong.png')) }}" 
                alt="Phát triển phần mềm với tư duy chiến lược • Truyền Thông Cửu Long" 
                class="w-full h-auto block select-none"
                loading="eager"
                fetchpriority="high"
                decoding="async"
                width="1983"
                height="793"
            >
        </picture>

        {{-- Hotspot Overlay (Desktop / Laptop / Tablet) cho 2 nút bấm trên ảnh --}}
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            {{-- Nút Bắt đầu dự án --}}
            <a href="{{ route('contact') }}" 
               class="absolute pointer-events-auto rounded-full cursor-pointer hover:ring-2 hover:ring-orange-400/50 hover:bg-white/10 transition-all"
               style="left: 6.6%; top: 68%; width: 12.8%; height: 11.5%;"
               title="Bắt đầu dự án"
               aria-label="Bắt đầu dự án"></a>

            {{-- Nút Xem giải pháp --}}
            <a href="{{ route('services.index') }}" 
               class="absolute pointer-events-auto rounded-full cursor-pointer hover:ring-2 hover:ring-slate-400/50 hover:bg-white/10 transition-all"
               style="left: 20.2%; top: 68%; width: 11.4%; height: 11.5%;"
               title="Xem giải pháp"
               aria-label="Xem giải pháp"></a>
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