@php
    $techCaseStudies = $techCaseStudies ?? \App\Models\CaseStudy::where('group', 'technology')->orderBy('order')->get();
    $mediaCaseStudies = $mediaCaseStudies ?? \App\Models\CaseStudy::where('group', 'media')->orderBy('order')->take(3)->get();
@endphp

<section class="w-full bg-surface bg-dot-grid-subtle py-14 lg:py-20 relative gsap-reveal-section border-b border-slate-200/80 overflow-hidden" 
         id="portfolio-section"
         aria-labelledby="portfolio-title">

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
                @if(isset($techCaseStudies) && $techCaseStudies->isNotEmpty())
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
                @else
                    <!-- Fallback Verified Real Tech Projects -->
                    <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div class="web-preview-scroll-container h-64 sm:h-72 w-full relative overflow-hidden bg-slate-900">
                            <img class="web-preview-scroll-img w-full object-cover" 
                                 alt="Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa" 
                                 loading="lazy"
                                 src="{{ asset('images/modern_tech_platform.jpg') }}"/>
                            <div class="absolute top-3.5 left-3.5 z-10">
                                <span class="px-3 py-1 rounded-full bg-slate-900/85 backdrop-blur-md text-sky-400 font-mono text-[11px] font-bold border border-sky-400/30">
                                    Healthcare Web-App • Clinic System
                                </span>
                            </div>
                            <div class="absolute bottom-3.5 right-3.5 z-10 px-2.5 py-0.5 rounded bg-emerald-950/85 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                                Project Live
                            </div>
                        </div>
                        <div class="p-6 sm:p-7 flex flex-col gap-4 flex-1 justify-between">
                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded bg-sky-50 text-sky-700 font-mono text-[10px] font-bold border border-sky-100">
                                        Khách hàng: Phòng Khám Gia Phước
                                    </span>
                                    <span class="text-xs text-slate-400 font-mono">2024</span>
                                </div>
                                <h3 class="font-headline text-xl sm:text-2xl text-navy-base font-bold group-hover:text-primary transition-colors leading-snug">
                                    Ứng Dụng Quản Lý &amp; Đặt Lịch Phòng Khám Đa Khoa
                                </h3>
                                <div class="space-y-2 pt-1">
                                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 space-y-1">
                                        <div class="flex items-center gap-1.5 font-bold text-navy-base font-mono text-[11px] uppercase tracking-wider">
                                            <span class="material-symbols-outlined text-[15px] text-amber-600">help_outline</span>
                                            <span>Bài toán doanh nghiệp:</span>
                                        </div>
                                        <p class="text-slate-600 leading-relaxed pl-5 font-body">
                                            Quy trình tiếp đón bệnh nhân thủ công, mất thời gian ghi nhận và khó tra cứu hồ sơ khám chữa bệnh theo thời gian thực.
                                        </p>
                                    </div>
                                    <div class="p-3 rounded-xl bg-sky-50/60 border border-sky-100/70 text-xs sm:text-sm text-slate-700 space-y-1">
                                        <div class="flex items-center gap-1.5 font-bold text-sky-900 font-mono text-[11px] uppercase tracking-wider">
                                            <span class="material-symbols-outlined text-[15px] text-sky-600">check_circle</span>
                                            <span>Giải pháp triển khai:</span>
                                        </div>
                                        <p class="text-slate-600 leading-relaxed pl-5 font-body">
                                            Xây dựng hệ thống Web-App quản trị y tế tập trung, tối ưu quy trình đặt lịch trực tuyến và quản lý hồ sơ an toàn.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                                <div class="flex items-center gap-1.5 font-mono text-slate-500">
                                    <span class="text-slate-400">Dịch vụ:</span>
                                    <a href="{{ route('services.web-app') }}" class="font-bold text-primary hover:underline">
                                        Thiết kế &amp; Lập trình Web-App &rarr;
                                    </a>
                                </div>
                                <a href="{{ route('projects.show', 'ung-dung-quan-ly-phong-kham') }}" 
                                   class="inline-flex items-center gap-1 font-headline font-bold text-navy-base hover:text-primary transition-colors">
                                    <span>Xem chi tiết Case Study</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div class="web-preview-scroll-container h-64 sm:h-72 w-full relative overflow-hidden bg-slate-900">
                            <img class="web-preview-scroll-img w-full object-cover" 
                                 alt="Website Phòng Khám Đa Khoa Chuẩn WordPress" 
                                 loading="lazy"
                                 src="{{ asset('images/modern_tech_platform.jpg') }}"/>
                            <div class="absolute top-3.5 left-3.5 z-10">
                                <span class="px-3 py-1 rounded-full bg-slate-900/85 backdrop-blur-md text-sky-400 font-mono text-[11px] font-bold border border-sky-400/30">
                                    Medical Portal • Chuẩn SEO Y Khoa
                                </span>
                            </div>
                            <div class="absolute bottom-3.5 right-3.5 z-10 px-2.5 py-0.5 rounded bg-emerald-950/85 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                                Project Live
                            </div>
                        </div>
                        <div class="p-6 sm:p-7 flex flex-col gap-4 flex-1 justify-between">
                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded bg-sky-50 text-sky-700 font-mono text-[10px] font-bold border border-sky-100">
                                        Khách hàng: Nha Khoa Nụ Cười
                                    </span>
                                    <span class="text-xs text-slate-400 font-mono">2024</span>
                                </div>
                                <h3 class="font-headline text-xl sm:text-2xl text-navy-base font-bold group-hover:text-primary transition-colors leading-snug">
                                    Website Phòng Khám Đa Khoa Chuẩn WordPress
                                </h3>
                                <div class="space-y-2 pt-1">
                                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 space-y-1">
                                        <div class="flex items-center gap-1.5 font-bold text-navy-base font-mono text-[11px] uppercase tracking-wider">
                                            <span class="material-symbols-outlined text-[15px] text-amber-600">help_outline</span>
                                            <span>Bài toán doanh nghiệp:</span>
                                        </div>
                                        <p class="text-slate-600 leading-relaxed pl-5 font-body">
                                            Doanh nghiệp y khoa cần hiện diện thương hiệu uy tín, tải trang nhanh và tối ưu cấu trúc thu hút bệnh nhân từ Google.
                                        </p>
                                    </div>
                                    <div class="p-3 rounded-xl bg-sky-50/60 border border-sky-100/70 text-xs sm:text-sm text-slate-700 space-y-1">
                                        <div class="flex items-center gap-1.5 font-bold text-sky-900 font-mono text-[11px] uppercase tracking-wider">
                                            <span class="material-symbols-outlined text-[15px] text-sky-600">check_circle</span>
                                            <span>Giải pháp triển khai:</span>
                                        </div>
                                        <p class="text-slate-600 leading-relaxed pl-5 font-body">
                                            Thiết kế website y khoa chuyên nghiệp, chuẩn cấu trúc SEO y tế và tích hợp luồng chuyển đổi đặt hẹn tự động.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                                <div class="flex items-center gap-1.5 font-mono text-slate-500">
                                    <span class="text-slate-400">Dịch vụ:</span>
                                    <a href="{{ route('services.web-app') }}" class="font-bold text-primary hover:underline">
                                        Thiết kế &amp; Lập trình Web-App &rarr;
                                    </a>
                                </div>
                                <a href="{{ route('projects.show', 'website-phong-kham-da-khoa') }}" 
                                   class="inline-flex items-center gap-1 font-headline font-bold text-navy-base hover:text-primary transition-colors">
                                    <span>Xem chi tiết Case Study</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
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

        <!-- ==================== 2. KHO GIAO DIỆN DEMO SẴN SÀNG (4 MẪU TIÊU BIỂU) ==================== -->
        @php
            $featuredTemplates = collect();
            if (isset($websiteTemplates) && $websiteTemplates->isNotEmpty()) {
                // Đại diện 4 nhóm ngành tiêu biểu từ dữ liệu thực tế (không phải tuyên bố top converting)
                $targetIndustries = ['doanh-nghiep', 'bat-dong-san', 'suc-khoe-lam-dep', 'thoi-trang'];
                foreach ($targetIndustries as $ind) {
                    $match = $websiteTemplates->firstWhere('industry_slug', $ind);
                    if ($match && !$featuredTemplates->contains('id', $match->id)) {
                        $featuredTemplates->push($match);
                    }
                }
                if ($featuredTemplates->count() < 4) {
                    foreach ($websiteTemplates as $tmpl) {
                        if (!$featuredTemplates->contains('id', $tmpl->id)) {
                            $featuredTemplates->push($tmpl);
                            if ($featuredTemplates->count() >= 4) break;
                        }
                    }
                }
            }
            $totalTemplateCount = isset($websiteTemplates) ? count($websiteTemplates) : 39;
        @endphp

        <div class="p-6 sm:p-8 lg:p-10 rounded-3xl bg-slate-900 text-white border border-white/10 shadow-2xl space-y-8" id="ready-made-templates">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 border-b border-white/10">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 font-mono text-[11px] font-bold border border-amber-500/30 mb-2.5">
                        <span class="material-symbols-outlined text-[15px]">dashboard</span>
                        <span>KHO GIAO DIỆN DEMO SẴN SÀNG</span>
                    </div>
                    <h3 class="font-headline text-2xl sm:text-3xl font-bold text-white tracking-tight">
                        Mẫu Giao Diện Khởi Chạy Nhanh Cho Doanh Nghiệp
                    </h3>
                    <p class="font-body text-slate-400 text-sm mt-1.5 max-w-2xl leading-relaxed">
                        Bản dựng chuẩn chỉ, tải nhanh và tối ưu cấu trúc. Khám phá các mẫu giao diện phổ biến hoặc truy cập toàn bộ thư viện giao diện theo ngành nghề.
                    </p>
                </div>
                <a href="{{ route('templates.index') }}" 
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-amber-400 hover:bg-amber-300 text-navy-base font-headline text-xs font-bold shrink-0 shadow-md transition-all focus-visible:ring-2 focus-visible:ring-amber-400 focus-visible:outline-none">
                    <span>Xem kho giao diện</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>

            @if($featuredTemplates->isNotEmpty())
                <!-- 4 Curated Featured Template Cards (No 39-item catalog, No category filter buttons) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredTemplates as $tmpl)
                        <div class="rounded-2xl overflow-hidden bg-slate-950/80 border border-white/10 hover:border-amber-400/50 transition-all flex flex-col group justify-between">
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
                                    <span class="px-2.5 py-0.5 rounded bg-black/70 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/10">
                                        {{ $tmpl->industry_name }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 sm:p-5 flex flex-col justify-between flex-1 gap-3">
                                <div class="space-y-1">
                                    <h4 class="font-headline text-sm sm:text-base font-bold text-white group-hover:text-amber-300 transition-colors line-clamp-1">
                                        {{ $tmpl->clean_title ?? $tmpl->title }}
                                    </h4>
                                    <p class="font-mono text-slate-400 text-xs">WordPress &bull; Chuẩn SEO</p>
                                </div>
                                <div class="pt-3 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                                    <a href="{{ route('templates.index') }}" class="text-amber-400 hover:text-amber-300 font-bold inline-flex items-center gap-1">
                                        <span>Xem mẫu</span>
                                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback Curated Industry Cards if dynamic posts pending -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="rounded-2xl p-5 bg-white/5 border border-white/10 flex flex-col justify-between gap-4">
                        <div>
                            <span class="px-2.5 py-1 rounded bg-amber-400/20 text-amber-300 font-mono text-[11px] font-bold">Doanh Nghiệp</span>
                            <h4 class="font-headline text-base font-bold text-white mt-3">Giao diện Doanh Nghiệp &amp; Dịch Vụ</h4>
                            <p class="font-body text-slate-400 text-xs mt-1.5 leading-relaxed">Định vị thương hiệu uy tín, giới thiệu năng lực và chứng chỉ chuyên ngành.</p>
                        </div>
                        <a href="{{ route('templates.index', ['industry' => 'doanh-nghiep']) }}" class="text-amber-400 hover:text-amber-300 font-mono text-xs font-bold inline-flex items-center gap-1">
                            <span>Khám phá mẫu &rarr;</span>
                        </a>
                    </div>
                    <div class="rounded-2xl p-5 bg-white/5 border border-white/10 flex flex-col justify-between gap-4">
                        <div>
                            <span class="px-2.5 py-1 rounded bg-amber-400/20 text-amber-300 font-mono text-[11px] font-bold">Bất Động Sản</span>
                            <h4 class="font-headline text-base font-bold text-white mt-3">Giao diện Bất Động Sản &amp; Dự Án</h4>
                            <p class="font-body text-slate-400 text-xs mt-1.5 leading-relaxed">Tối ưu bản đồ vị trí, thư viện mặt bằng và biểu mẫu tư vấn trực tiếp.</p>
                        </div>
                        <a href="{{ route('templates.index', ['industry' => 'bat-dong-san']) }}" class="text-amber-400 hover:text-amber-300 font-mono text-xs font-bold inline-flex items-center gap-1">
                            <span>Khám phá mẫu &rarr;</span>
                        </a>
                    </div>
                    <div class="rounded-2xl p-5 bg-white/5 border border-white/10 flex flex-col justify-between gap-4">
                        <div>
                            <span class="px-2.5 py-1 rounded bg-amber-400/20 text-amber-300 font-mono text-[11px] font-bold">Y Tế &bull; Phòng Khám</span>
                            <h4 class="font-headline text-base font-bold text-white mt-3">Giao diện Y Tế &amp; Phòng Khám</h4>
                            <p class="font-body text-slate-400 text-xs mt-1.5 leading-relaxed">Chuẩn cấu trúc SEO y tế, giới thiệu đội ngũ bác sĩ và đặt lịch khám nhanh.</p>
                        </div>
                        <a href="{{ route('templates.index', ['industry' => 'suc-khoe-lam-dep']) }}" class="text-amber-400 hover:text-amber-300 font-mono text-xs font-bold inline-flex items-center gap-1">
                            <span>Khám phá mẫu &rarr;</span>
                        </a>
                    </div>
                    <div class="rounded-2xl p-5 bg-white/5 border border-white/10 flex flex-col justify-between gap-4">
                        <div>
                            <span class="px-2.5 py-1 rounded bg-amber-400/20 text-amber-300 font-mono text-[11px] font-bold">Thời Trang &bull; Bán Lẻ</span>
                            <h4 class="font-headline text-base font-bold text-white mt-3">Giao diện Cửa Hàng &amp; Bán Lẻ</h4>
                            <p class="font-body text-slate-400 text-xs mt-1.5 leading-relaxed">Trưng bày bộ sưu tập bắt mắt, tối ưu trải nghiệm mua sắm trên thiết bị di động.</p>
                        </div>
                        <a href="{{ route('templates.index', ['industry' => 'thoi-trang']) }}" class="text-amber-400 hover:text-amber-300 font-mono text-xs font-bold inline-flex items-center gap-1">
                            <span>Khám phá mẫu &rarr;</span>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Section Gateway CTA to Canonical Template Warehouse -->
            <div class="pt-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-slate-400 text-xs sm:text-sm font-body text-center sm:text-left">
                    Toàn bộ thư viện hơn {{ $totalTemplateCount }}+ mẫu giao diện đã phân loại theo 13 ngành nghề tại Kho Giao Diện.
                </p>
                <a href="{{ route('templates.index') }}" 
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-amber-400 hover:bg-amber-300 text-navy-base font-headline text-xs sm:text-sm font-bold shadow-md shadow-amber-400/20 hover:scale-[1.02] active:scale-[0.98] transition-all group shrink-0 focus-visible:ring-2 focus-visible:ring-amber-400 focus-visible:outline-none">
                    <span>Xem toàn bộ {{ $totalTemplateCount }}+ mẫu giao diện</span>
                    <span class="material-symbols-outlined text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                </a>
            </div>
        </div>

    </div>
</section>