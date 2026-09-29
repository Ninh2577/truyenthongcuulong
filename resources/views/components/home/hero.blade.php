{{-- 
    UI-REBUILD-13.3: HOMEPAGE HERO & VISUAL SHOWCASE
    Định vị B2B Software Engineering, Web-App & Nền Tảng Số Doanh Nghiệp (85% Tech, 15% Media).
    Tái sử dụng chuẩn kiến trúc component x-banner.hero.
    Visual Showcase sử dụng tài sản hình ảnh thực tế (modern_tech_platform.jpg), tối ưu LCP & Zero CLS.
--}}
<x-banner.hero
    variant="service-split"
    id="hero-section"
    eyebrow="PHÁT TRIỂN PHẦN MỀM & GIẢI PHÁP SỐ • TECHNOLOGY & DIGITAL SOLUTIONS"
    title="Phát triển phần mềm"
    titleAccent="phù hợp với vận hành doanh nghiệp. Giải Pháp Web, Web App & Hệ Thống Số Doanh Nghiệp."
    description="Thiết kế và xây dựng website, Web App cùng hệ thống quản trị theo nhu cầu thực tế, giúp doanh nghiệp số hóa quy trình và kiểm soát hoạt động hiệu quả hơn. Năng lực Media in-house hỗ trợ sản xuất visual assets chuẩn mực."
    :primaryCta="[
        'label' => 'Bắt đầu dự án',
        'url' => route('contact'),
        'icon' => 'arrow_forward'
    ]"
    :secondaryCta="[
        'label' => 'Xem giải pháp',
        'url' => route('services.index'),
        'icon' => 'arrow_forward'
    ]"
>
    {{-- ==================== EXTRA SLOT (LEFT COLUMN): VERIFIED CAPABILITIES STRIP ==================== --}}
    <x-slot:extra>
        <div class="pt-4 border-t border-slate-200/80 w-full">
            <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block mb-2.5">
                NĂNG LỰC GIẢI PHÁP CỐT LÕI
            </span>
            <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 text-xs">
                <!-- Chip 1: Web Development -->
                <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:border-primary hover:text-primary hover:shadow-xs hover:-translate-y-0.5 transition-all font-medium shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-primary" aria-hidden="true">code</span>
                    <span>Lập trình Web-App</span>
                </a>

                @php
                    $heroTemplateCount = $heroTemplateCount ?? ((isset($websiteTemplates) && count($websiteTemplates) > 0) ? count($websiteTemplates) : 106);
                @endphp

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
                <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200/80 text-slate-600 hover:border-amber-500 hover:text-amber-700 hover:shadow-xs hover:-translate-y-0.5 transition-all font-medium focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-amber-600" aria-hidden="true">videocam</span>
                    <span>Media In-House Hỗ Trợ</span>
                </a>
            </div>
        </div>
    </x-slot:extra>

    {{-- ==================== DEFAULT SLOT (RIGHT COLUMN): REAL PRODUCT VISUAL SHOWCASE ==================== --}}
    <div class="relative mx-auto max-w-lg rounded-3xl bg-[#070F1E] p-3.5 sm:p-4 text-white shadow-2xl border border-sky-500/25 overflow-hidden" 
         role="region" 
         aria-label="Giao diện giải pháp công nghệ số">
        
        <!-- Browser / Console Top Window Header -->
        <div class="flex items-center justify-between pb-3 border-b border-white/10 text-xs text-slate-400 font-mono">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-rose-500/80 inline-block" aria-hidden="true"></span>
                <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block" aria-hidden="true"></span>
                <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block" aria-hidden="true"></span>
                <span class="ml-2 text-sky-300 font-semibold truncate text-[11px] sm:text-xs">cuulong.digital/solutions/web-app</span>
            </div>
            <span class="px-2 py-0.5 rounded bg-emerald-950/80 text-[10px] text-emerald-400 font-mono font-bold border border-emerald-400/30 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" aria-hidden="true"></span>
                <span>ONLINE</span>
            </span>
        </div>

        <!-- Real UI Visual Showcase: Web-App Platform Image (Zero CLS & LCP Optimized) -->
        <div class="my-3 rounded-2xl overflow-hidden bg-slate-950 border border-white/10 relative group">
            <div class="w-full aspect-[16/10] overflow-hidden relative">
                <img 
                    src="{{ asset('images/modern_tech_platform.jpg') }}" 
                    alt="Giao diện nền tảng Web-App quản trị doanh nghiệp thực tế phát triển bởi Cửu Long"
                    class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                >
                <!-- Subtle Gradient Tint for Text Legibility -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent pointer-events-none" aria-hidden="true"></div>

                <!-- Floating Architecture Specs Badge -->
                <div class="absolute bottom-2.5 left-2.5 right-2.5 flex items-center justify-between gap-2 p-2 rounded-xl bg-[#070F1E]/85 backdrop-blur-md border border-white/15 text-[11px] font-mono text-slate-300">
                    <div class="flex items-center gap-1.5 truncate">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span class="text-white font-bold truncate">Web-App Architecture</span>
                        <span class="text-slate-400 hidden sm:inline">&bull; Laravel 11 / Tailwind</span>
                    </div>
                    <span class="text-amber-300 font-semibold shrink-0">Live System</span>
                </div>
            </div>
        </div>

        <!-- Bottom Quick Action Link to Template Library -->
        <div class="p-3 rounded-xl bg-slate-900/90 border border-white/10 font-mono text-xs flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" aria-hidden="true"></span>
                <span class="text-slate-300 text-[11px]">Kho Giao Diện ({{ $heroTemplateCount }}+ Mẫu Website Có Sẵn)</span>
            </div>
            <a href="{{ route('templates.index') }}" 
               class="text-sky-400 hover:text-sky-300 font-bold inline-flex items-center gap-1 text-[11px] transition-colors focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                <span>Xem kho giao diện</span>
                <span class="material-symbols-outlined text-[14px]" aria-hidden="true">arrow_forward</span>
            </a>
        </div>
    </div>
</x-banner.hero>