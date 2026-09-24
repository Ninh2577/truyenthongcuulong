@php
    $techCaseStudies = $techCaseStudies ?? \App\Models\CaseStudy::where('group', 'technology')->orderBy('order')->get();
    $mediaCaseStudies = $mediaCaseStudies ?? \App\Models\CaseStudy::where('group', 'media')->orderBy('order')->take(3)->get();
@endphp

<section class="w-full bg-surface bg-dot-grid-subtle py-14 lg:py-20 relative gsap-reveal-section border-b border-slate-200/80 overflow-hidden" 
         id="portfolio-section"
         aria-labelledby="portfolio-title"
         x-data="{ 
             videoModal: false, 
             activeVideoUrl: '', 
             activeVideoTitle: '',
             currentIndustry: 'all',
             displayLimit: 6,
             filterTemplate(indSlug, idx) {
                 if (this.currentIndustry === 'all') {
                     return idx < this.displayLimit;
                 }
                 return this.currentIndustry === indSlug;
             },
             openVideo(url, title) {
                 this.activeVideoUrl = url;
                 this.activeVideoTitle = title;
                 this.videoModal = true;
                 document.body.style.overflow = 'hidden';
             },
             closeVideo() {
                 this.videoModal = false;
                 this.activeVideoUrl = '';
                 this.activeVideoTitle = '';
                 document.body.style.overflow = 'auto';
             }
         }">

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 lg:space-y-20">

        <!-- ==================== 1. TECHNOLOGY CASE STUDIES (PRIMARY ~85%) ==================== -->
        <div class="space-y-10" id="tech-case-studies">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold border border-sky-200 mb-3.5 shadow-2xs">
                    <span class="material-symbols-outlined text-[16px] text-primary">terminal</span>
                    <span>BÀI TOÁN THỰC TẾ &bull; TECHNOLOGY CASE STUDIES</span>
                </div>
                <h2 id="portfolio-title" class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                    Những Bài Toán Công Nghệ Chúng Tôi Đã Triển Khai
                </h2>
                <p class="font-body text-slate-600 text-base sm:text-lg mt-3.5 leading-relaxed">
                    Từ ứng dụng Web-App quản lý nghiệp vụ đến nền tảng website doanh nghiệp chuẩn SEO, mỗi dự án là một minh chứng thực tế cho năng lực giải quyết bài toán vận hành của Cửu Long.
                </p>
            </div>

            <!-- Technology Projects Grid (Problem-First Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                @foreach($techCaseStudies as $techProject)
                    @php
                        $isClinicApp = ($techProject->slug === 'ung-dung-quan-ly-phong-kham');
                        $tagLabel = $isClinicApp ? 'Healthcare Web-App • Clinic System' : 'Medical Portal • Chuẩn SEO Y Khoa';
                        $businessProblem = $isClinicApp 
                            ? 'Quy trình tiếp đón bệnh nhân thủ công, mất thời gian ghi nhận và khó tra cứu hồ sơ khám chữa bệnh theo thời gian thực.' 
                            : 'Doanh nghiệp y khoa cần hiện diện thương hiệu uy tín, tải trang nhanh và tối ưu cấu trúc thu hút bệnh nhân từ Google.';
                        $solutionDetail = $isClinicApp
                            ? 'Xây dựng hệ thống Web-App quản trị y tế tập trung, tối ưu quy trình đặt lịch trực tuyến và quản lý hồ sơ an toàn.'
                            : 'Thiết kế website y khoa chuyên nghiệp, chuẩn cấu trúc SEO y tế và tích hợp luồng chuyển đổi đặt hẹn tự động.';
                        $serviceLink = route('services.web-app');
                        $serviceLabel = 'Thiết kế & Lập trình Web-App';
                    @endphp

                    <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <!-- Card Visual / Image Preview -->
                        <div class="web-preview-scroll-container h-64 sm:h-72 w-full relative overflow-hidden bg-slate-900">
                            @if($techProject->thumbnail)
                                <img class="web-preview-scroll-img w-full object-cover" 
                                     alt="{{ $techProject->title }}" 
                                     loading="lazy"
                                     src="{{ asset('storage/' . $techProject->thumbnail) }}"
                                     onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'"/>
                            @else
                                <img class="web-preview-scroll-img w-full object-cover" 
                                     alt="{{ $techProject->title }}" 
                                     loading="lazy"
                                     src="{{ asset('images/modern_tech_platform.jpg') }}"/>
                            @endif

                            <div class="absolute top-3.5 left-3.5 z-10">
                                <span class="px-3 py-1 rounded-full bg-slate-900/85 backdrop-blur-md text-sky-400 font-mono text-[11px] font-bold border border-sky-400/30">
                                    {{ $tagLabel }}
                                </span>
                            </div>
                            <div class="absolute bottom-3.5 right-3.5 z-10 px-2.5 py-0.5 rounded bg-emerald-950/85 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                                Project Live
                            </div>
                        </div>

                        <!-- Card Body (Problem -> Solution -> Service Mapping) -->
                        <div class="p-6 sm:p-7 flex flex-col gap-4 flex-1 justify-between">
                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded bg-sky-50 text-sky-700 font-mono text-[10px] font-bold border border-sky-100">
                                        Khách hàng: {{ $techProject->client_name ?: 'Doanh nghiệp' }}
                                    </span>
                                    <span class="text-xs text-slate-400 font-mono">{{ $techProject->year ?: '2025' }}</span>
                                </div>

                                <h3 class="font-headline text-xl sm:text-2xl text-navy-base font-bold group-hover:text-primary transition-colors leading-snug">
                                    {{ $techProject->title }}
                                </h3>

                                <!-- Problem & Solution Narrative -->
                                <div class="space-y-2 pt-1">
                                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 space-y-1">
                                        <div class="flex items-center gap-1.5 font-bold text-navy-base font-mono text-[11px] uppercase tracking-wider">
                                            <span class="material-symbols-outlined text-[15px] text-amber-600">help_outline</span>
                                            <span>Bài toán doanh nghiệp:</span>
                                        </div>
                                        <p class="text-slate-600 leading-relaxed pl-5 font-body">
                                            {{ $businessProblem }}
                                        </p>
                                    </div>

                                    <div class="p-3 rounded-xl bg-sky-50/60 border border-sky-100/70 text-xs sm:text-sm text-slate-700 space-y-1">
                                        <div class="flex items-center gap-1.5 font-bold text-sky-900 font-mono text-[11px] uppercase tracking-wider">
                                            <span class="material-symbols-outlined text-[15px] text-sky-600">check_circle</span>
                                            <span>Giải pháp triển khai:</span>
                                        </div>
                                        <p class="text-slate-600 leading-relaxed pl-5 font-body">
                                            {{ $solutionDetail }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Meta & Canonical Links -->
                            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                                <div class="flex items-center gap-1.5 font-mono text-slate-500">
                                    <span class="text-slate-400">Dịch vụ:</span>
                                    <a href="{{ $serviceLink }}" class="font-bold text-primary hover:underline">
                                        {{ $serviceLabel }} &rarr;
                                    </a>
                                </div>
                                <a href="{{ route('projects.show', $techProject->slug) }}" 
                                   class="inline-flex items-center gap-1 font-headline font-bold text-navy-base hover:text-primary transition-colors focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                                    <span>Xem chi tiết Case Study</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Primary Action CTA for Technology Projects -->
            <div class="text-center pt-2">
                <a href="{{ route('projects.index') }}" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-sm font-bold shadow-md shadow-navy-base/20 hover:scale-[1.02] active:scale-[0.98] transition-all group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span>Xem toàn bộ dự án công nghệ</span>
                    <span class="material-symbols-outlined text-[18px] text-amber-400 group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- ==================== 2. KHO GIAO DIỆN DEMO SẴN SÀNG (39+ MẪU THEO NGÀNH) ==================== -->
        @if(isset($websiteTemplates) && count($websiteTemplates) > 0)
            <div class="p-6 sm:p-8 lg:p-10 rounded-3xl bg-slate-900 text-white border border-white/10 shadow-2xl space-y-8" id="ready-made-templates">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 border-b border-white/10">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 font-mono text-[11px] font-bold border border-amber-500/30 mb-2.5">
                            <span class="material-symbols-outlined text-[15px]">dashboard</span>
                            <span>KHO GIAO DIỆN DEMO SẴN SÀNG</span>
                        </div>
                        <h3 class="font-headline text-2xl sm:text-3xl font-bold text-white tracking-tight">
                            39+ Mẫu Giao Diện Sẵn Sàng Vận Hành Cho 13 Ngành Nghề
                        </h3>
                        <p class="font-body text-slate-400 text-sm mt-1.5 max-w-2xl leading-relaxed">
                            Bản dựng chuẩn chỉ, tải nhanh và tối ưu chuyển đổi. Bạn có thể kiểm tra trực tiếp trải nghiệm người dùng ngay trên bản live demo.
                        </p>
                    </div>
                    <a href="{{ route('templates.index') }}" 
                       class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-amber-400 hover:bg-amber-300 text-navy-base font-headline text-xs font-bold shrink-0 shadow-md transition-all">
                        <span>Khám phá kho demo</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Template Industry Chips Filter -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-thin">
                    <button type="button" 
                            @click="currentIndustry = 'all'" 
                            :class="currentIndustry === 'all' ? 'bg-amber-400 text-navy-base font-bold' : 'bg-white/10 text-slate-300 hover:bg-white/20'"
                            class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors whitespace-nowrap cursor-pointer">
                        Tất Cả (39)
                    </button>
                    @if(isset($industryFilters))
                        @foreach($industryFilters as $ind)
                            @if($ind['has_templates'])
                                <button type="button" 
                                        @click="currentIndustry = '{{ $ind['slug'] }}'" 
                                        :class="currentIndustry === '{{ $ind['slug'] }}' ? 'bg-amber-400 text-navy-base font-bold' : 'bg-white/10 text-slate-300 hover:bg-white/20'"
                                        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors whitespace-nowrap cursor-pointer">
                                    {{ $ind['name'] }} ({{ $ind['count'] }})
                                </button>
                            @endif
                        @endforeach
                    @endif
                </div>

                <!-- Demo Templates Sample Grid (First 6 items) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($websiteTemplates as $idx => $tmpl)
                        <div x-show="filterTemplate('{{ $tmpl->industry_slug }}', {{ $idx }})" 
                             class="rounded-2xl overflow-hidden bg-slate-950/80 border border-white/10 hover:border-amber-400/50 transition-all flex flex-col group">
                            <div class="h-44 w-full relative overflow-hidden bg-slate-800">
                                @if($tmpl->thumbnail)
                                    <img src="{{ $tmpl->thumbnail }}" 
                                         alt="{{ $tmpl->title }}" 
                                         loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-800 text-slate-500">
                                        <span class="material-symbols-outlined text-[32px]">web</span>
                                    </div>
                                @endif
                                <div class="absolute top-2.5 left-2.5">
                                    <span class="px-2 py-0.5 rounded bg-black/70 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/10">
                                        {{ $tmpl->industry_name }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 flex flex-col justify-between flex-1 gap-3">
                                <h4 class="font-headline text-sm font-bold text-white group-hover:text-amber-300 transition-colors line-clamp-1">
                                    {{ $tmpl->clean_title ?? $tmpl->title }}
                                </h4>
                                <div class="flex items-center justify-between text-xs pt-2 border-t border-white/10 font-mono">
                                    <span class="text-slate-400 text-[11px]">WordPress &bull; Chuẩn SEO</span>
                                    <a href="{{ route('templates.index') }}" class="text-amber-400 hover:text-amber-300 font-bold inline-flex items-center gap-1">
                                        <span>Xem Demo</span>
                                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- ==================== 3. MEDIA SECONDARY BLOCK (CREATIVE SUPPORT ~15%) ==================== -->
        <div class="p-6 sm:p-8 lg:p-10 rounded-3xl bg-slate-50 border border-slate-200/80 space-y-8" id="media-case-studies">
            <!-- Secondary Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 text-amber-800 font-mono text-[11px] font-bold border border-amber-200/80 mb-2">
                        <span class="material-symbols-outlined text-[15px] text-amber-700">videocam</span>
                        <span>CREATIVE SUPPORT &bull; NĂNG LỰC MEDIA IN-HOUSE (15%)</span>
                    </div>
                    <h3 class="font-headline text-2xl sm:text-3xl font-bold text-navy-base tracking-tight">
                        Hình Ảnh &amp; Video Hỗ Trợ Hệ Sinh Thái Dự Án Số
                    </h3>
                    <p class="font-body text-slate-600 text-sm mt-1 max-w-2xl leading-relaxed">
                        Sản xuất video TVC 4K, phim giới thiệu doanh nghiệp và visual assets đồng bộ trực tiếp cho website &amp; nền tảng số mà không cần thuê ngoài.
                    </p>
                </div>
                <a href="{{ route('services.media') }}" 
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-white hover:bg-slate-100 text-slate-700 hover:text-primary font-headline text-xs font-bold border border-slate-200 shadow-2xs transition-all shrink-0">
                    <span>Xem năng lực Media</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>

            <!-- Media Projects Grid (Compact 3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($mediaCaseStudies as $mediaProject)
                    <div class="group rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div class="h-44 w-full relative overflow-hidden bg-black">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 alt="{{ $mediaProject->title }}" 
                                 loading="lazy"
                                 src="{{ $mediaProject->cover_image_url ?: asset('images/portfolio/sacombank.jpg') }}"
                                 onerror="this.src='{{ asset('images/portfolio/sacombank.jpg') }}'"/>
                            
                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                    {{ $mediaProject->client_name ?: 'Media' }}
                                </span>
                            </div>

                            @if(!empty($mediaProject->video_url))
                                <div class="absolute inset-0 flex items-center justify-center opacity-85 group-hover:opacity-100 transition-opacity cursor-pointer"
                                     @click="openVideo('{{ $mediaProject->video_url }}?autoplay=1&rel=0', '{{ $mediaProject->title }}')">
                                    <div class="w-11 h-11 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-3 ring-orange-400/30 hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-[22px] translate-x-0.5">play_arrow</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="p-5 flex flex-col justify-between flex-1 gap-3">
                            <div>
                                <span class="text-[10px] font-mono font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-100">
                                    Sản Xuất Media
                                </span>
                                <h4 class="font-headline text-base text-navy-base font-bold group-hover:text-primary transition-colors line-clamp-1 mt-1.5">
                                    {{ $mediaProject->title }}
                                </h4>
                                <p class="font-body text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                    {{ $mediaProject->summary }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                                <span class="text-slate-400 text-[11px]">{{ $mediaProject->year ?: '4K Cinema' }}</span>
                                @if(!empty($mediaProject->video_url))
                                    <button type="button" 
                                            @click="openVideo('{{ $mediaProject->video_url }}?autoplay=1&rel=0', '{{ $mediaProject->title }}')" 
                                            class="text-primary font-bold inline-flex items-center gap-1 cursor-pointer hover:underline">
                                        <span class="material-symbols-outlined text-[14px]">play_circle</span>
                                        <span>Xem Video</span>
                                    </button>
                                @else
                                    <a href="{{ route('projects.show', $mediaProject->slug) }}" class="text-primary font-bold hover:underline">
                                        <span>Chi tiết &rarr;</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- ==================== VIDEO MODAL ==================== -->
    <template x-teleport="body">
        <div x-show="videoModal" 
             x-cloak
             role="dialog"
             aria-modal="true"
             aria-label="Xem video dự án"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/80 backdrop-blur-md"
             @keydown.escape.window="closeVideo()">
            <div class="relative w-full max-w-4xl bg-black rounded-3xl overflow-hidden shadow-2xl border border-white/20"
                 @click.away="closeVideo()">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b border-white/10 text-white">
                    <h4 class="font-headline text-sm sm:text-base font-bold truncate pr-4" x-text="activeVideoTitle"></h4>
                    <button type="button" 
                            @click="closeVideo()" 
                            aria-label="Đóng video"
                            class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">close</span>
                    </button>
                </div>
                <!-- Video Container (16:9 Aspect Ratio) -->
                <div class="relative w-full aspect-video bg-black">
                    <iframe x-show="activeVideoUrl" 
                            :src="activeVideoUrl" 
                            :title="activeVideoTitle || 'Video giới thiệu dự án'"
                            class="w-full h-full" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </template>
</section>