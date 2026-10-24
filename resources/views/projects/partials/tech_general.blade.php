{{-- 
    TECHNOLOGY CASE STUDY — PREMIUM DYNAMIC TEMPLATE FOR WEBSITES & DIGITAL SOLUTIONS
    Hiển thị giao diện website trực quan, browser mockup chuẩn macOS, danh sách tính năng, hồ sơ kỹ thuật và kết quả đo lường thực tế.
--}}
@php
    $meta = $caseStudy->meta_data ?? [];
    $domain = $meta['domain'] ?? '';
    $demoUrl = $meta['demo_url'] ?? '';
    $features = $meta['features'] ?? [];
    $techStack = $meta['tech_stack'] ?? ($caseStudy->tech_stack ?? '');
    $problem = $meta['problem'] ?? ($caseStudy->problem ?? '');
    $solution = $meta['solution'] ?? ($caseStudy->solution ?? '');
    $result = $meta['result'] ?? ($caseStudy->result ?? '');
    $gearUsed = $meta['gear_used'] ?? '';
    $metrics = $meta['metrics'] ?? [];
    $gallery = $caseStudy->gallery ?? [];
    $catName = $meta['category_name'] ?? 'Website doanh nghiệp';

    // Badge styling theo danh mục
    $catBadgeStyles = [
        'Du lịch' => 'bg-orange-50 text-[#ff5400] border-orange-200/80',
        'Y tế' => 'bg-sky-50 text-sky-700 border-sky-200/80',
        'Dịch vụ' => 'bg-teal-50 text-teal-700 border-teal-200/80',
        'Doanh nghiệp' => 'bg-indigo-50 text-indigo-700 border-indigo-200/80',
        'Thương mại điện tử' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80',
        'Giáo dục' => 'bg-purple-50 text-purple-700 border-purple-200/80',
    ];
    $catBadgeClass = $catBadgeStyles[$catName] ?? 'bg-slate-100 text-slate-700 border-slate-200';

    // Trích xuất YouTube Video ID nếu có
    $videoId = null;
    if (!empty($caseStudy->video_url)) {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $caseStudy->video_url, $match)) {
            $videoId = $match[1];
        }
    }
@endphp

<!-- Section 01: Project Hero Header -->
<section class="relative w-full pt-28 pb-14 lg:pt-36 lg:pb-16 bg-[#fbfcfe] bg-dot-grid-subtle border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500 mb-6 flex-wrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#ff5400] transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('projects.index') }}" class="hover:text-[#ff5400] transition-colors">Dự án &amp; Case Studies</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-900 font-bold truncate max-w-sm" aria-current="page">{{ $caseStudy->title }}</span>
        </nav>

        <div class="flex flex-col gap-5 max-w-4xl">
            <!-- Pill Badges -->
            <div class="flex items-center gap-2 flex-wrap">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $catBadgeClass }}">
                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                    <span>{{ $catName }}</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-700 font-mono text-xs font-bold border border-slate-200">
                    <span class="w-2 h-2 rounded-full bg-[#ff5400] animate-pulse"></span>
                    <span>DỰ ÁN THỰC THI THỰC TẾ &bull; TRUYỀN THÔNG CỬU LONG</span>
                </span>
            </div>

            <!-- Main Heading Title -->
            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                {{ $caseStudy->title }}
            </h1>

            <!-- Summary / Subtitle -->
            <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed max-w-3xl">
                {{ $caseStudy->summary ?: 'Giải pháp thiết kế và phát triển website chuyên nghiệp, tối ưu chuẩn SEO và trải nghiệm người dùng may đo bởi Truyền Thông Cửu Long.' }}
            </p>

            <!-- Quick Action Buttons -->
            <div class="flex items-center gap-3 pt-2 flex-wrap">
                @if($demoUrl)
                    <a href="{{ $demoUrl }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#ff5400] hover:bg-orange-600 text-white font-bold text-sm shadow-md shadow-orange-500/25 transition-all transform hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        <span>Trải nghiệm website trực tuyến</span>
                    </a>
                @endif
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white hover:bg-slate-50 text-slate-800 font-bold text-sm border border-slate-200 shadow-2xs transition-all">
                    <span class="material-symbols-outlined text-[18px] text-[#ff5400]">forum</span>
                    <span>Tư vấn giải pháp tương tự</span>
                </a>
            </div>

            <!-- Project Meta Strip -->
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 pt-5 mt-3 border-t border-slate-200/80 font-mono text-xs">
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Khách hàng</span>
                    <span class="font-bold text-slate-900 mt-0.5 block font-headline truncate">{{ $caseStudy->client_name ?: 'Đối tác Cửu Long' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Lĩnh vực</span>
                    <span class="font-bold text-[#ff5400] mt-0.5 block font-headline truncate">{{ $catName }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Thời gian</span>
                    <span class="font-bold text-slate-900 mt-0.5 block font-headline">{{ $caseStudy->year ?: '2024' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Trạng thái</span>
                    <span class="font-bold text-emerald-600 mt-0.5 flex items-center gap-1 font-headline">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Đã triển khai
                    </span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Lượt xem</span>
                    <span class="font-bold text-slate-700 mt-0.5 block font-headline">
                        {{ number_format((int)($caseStudy->views ?? 0), 0, ',', '.') }} lượt
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Case Study Content Container -->
<div class="w-full bg-[#f8fafc] py-14 lg:py-20 border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 lg:space-y-20">

        <!-- ========================================================
             FEATURED INTERFACE HERO MOCKUP (MACOS BROWSER WINDOW)
             ======================================================== -->
        <div class="rounded-3xl overflow-hidden bg-slate-950 border border-slate-200/90 shadow-2xl relative group">
            
            <!-- Browser Header Bar (macOS Red/Yellow/Green Buttons + Domain Bar) -->
            <div class="px-4 py-3 bg-slate-950/95 border-b border-white/10 flex items-center justify-between text-xs font-mono text-slate-400 gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-rose-500/85 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-amber-500/85 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-emerald-500/85 inline-block"></span>
                    
                    <!-- URL Address Pill -->
                    <div class="ml-2 px-3 py-1 rounded-md bg-white/5 border border-white/10 flex items-center gap-1.5 text-slate-300 text-xs">
                        <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="font-semibold">{{ $domain ?: ($caseStudy->slug . '.vn') }}</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-2.5">
                    <span class="inline-flex items-center gap-1.5 text-[11px] text-emerald-400 font-bold px-2.5 py-0.5 rounded-full bg-emerald-950/80 border border-emerald-500/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>LIVE SYSTEM &bull; ONLINE</span>
                    </span>
                    @if($demoUrl)
                        <a href="{{ $demoUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="hidden sm:inline-flex items-center gap-1 text-[11px] font-bold text-white bg-[#ff5400] hover:bg-orange-600 px-3 py-1 rounded-full transition-all">
                            <span>Truy cập web</span>
                            <span class="material-symbols-outlined text-[13px]">arrow_outward</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Website Screenshot Banner View -->
            <div class="relative w-full bg-slate-900 overflow-hidden flex items-center justify-center group/img">
                <img src="{{ $caseStudy->cover_image_url }}" 
                     alt="{{ $caseStudy->title }}" 
                     class="w-full h-auto max-h-[680px] object-cover object-top transition-transform duration-700 group-hover/img:scale-[1.01]"
                     loading="eager"
                     onerror="this.src='{{ asset('images/banner_halong_bay.jpg') }}'">
                
                @if($demoUrl)
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-transparent opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex items-end justify-center p-6 sm:p-8">
                        <a href="{{ $demoUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="px-7 py-3.5 rounded-full bg-[#ff5400] hover:bg-orange-600 text-white font-bold text-sm sm:text-base shadow-2xl flex items-center gap-2 transform translate-y-3 group-hover/img:translate-y-0 transition-all">
                            <span class="material-symbols-outlined text-[20px]">open_in_new</span>
                            <span>Ghé thăm website trực tiếp: {{ $domain ?: $demoUrl }}</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <!-- ========================================================
             SECTION 02: KEY FEATURES & HIGHLIGHTS
             ======================================================== -->
        @if(!empty($features) && count($features) > 0)
            <section class="space-y-6">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 text-[#ff5400] font-mono text-xs font-bold border border-orange-200 mb-2">
                            <span>01. TÍNH NĂNG &amp; NĂNG LỰC NỔI BẬT</span>
                        </div>
                        <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-slate-900">
                            Các Đặc Điểm Nổi Bật Của Website
                        </h2>
                    </div>
                    @if($demoUrl)
                        <a href="{{ $demoUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] hover:underline font-mono">
                            <span>Xem website trực tiếp</span>
                            <span class="material-symbols-outlined text-[15px]">arrow_outward</span>
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($features as $idx => $feat)
                        <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-2xs hover:shadow-md hover:border-orange-300/80 transition-all duration-300 space-y-3 group/feat">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#ff5400] group-hover/feat:bg-[#ff5400] group-hover/feat:text-white flex items-center justify-center font-bold text-sm transition-all duration-300 shadow-2xs">
                                {{ sprintf('%02d', $idx + 1) }}
                            </div>
                            <h3 class="font-headline text-sm sm:text-base font-bold text-slate-900 group-hover/feat:text-[#ff5400] transition-colors leading-snug">
                                {{ $feat }}
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Triển khai may đo tối ưu chuẩn UX/UI và đồng bộ dữ liệu thời gian thực.
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ========================================================
             SECTION 03: PROBLEM & SOLUTION
             ======================================================== -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-50 text-sky-700 font-mono text-xs font-bold border border-sky-200 mb-1">
                <span>02. BỐI CẢNH &amp; GIẢI PHÁP MAY ĐO</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-slate-900">
                Bài Toán Thực Tế Và Phương Án Giải Quyết
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Problem Card -->
                <div class="p-7 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-4 hover:border-rose-300 transition-all">
                    <div class="flex items-center gap-2.5 text-rose-600 font-bold text-sm tracking-wide">
                        <span class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[20px]">help_outline</span>
                        </span>
                        <span>BÀI TOÁN DOANH NGHIỆP (PROBLEM)</span>
                    </div>
                    <p class="text-sm sm:text-base text-slate-700 leading-relaxed">
                        {{ $problem ?: 'Doanh nghiệp cần xây dựng hiện diện số chuyên nghiệp, nâng cấp nhận diện thương hiệu trực tuyến và chuẩn hóa quy trình tiếp cận khách hàng trên đa nền tảng thiết bị.' }}
                    </p>
                </div>

                <!-- Solution Card -->
                <div class="p-7 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-4 hover:border-emerald-300 transition-all">
                    <div class="flex items-center gap-2.5 text-emerald-600 font-bold text-sm tracking-wide">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        </span>
                        <span>GIẢI PHÁP TRIỂN KHAI (SOLUTION)</span>
                    </div>
                    <p class="text-sm sm:text-base text-slate-700 leading-relaxed">
                        {{ $solution ?: 'Truyền Thông Cửu Long thiết kế giao diện UI/UX may đo độc bản, tối ưu tốc độ tải trang Core Web Vitals chuẩn Google, tích hợp các tính năng nghiệp vụ tự động và bảo mật cao cấp.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- ========================================================
             SECTION 04: TECH STACK & DELIVERABLES
             ======================================================== -->
        <section class="p-7 sm:p-9 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-7">
            <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-100 pb-5">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 font-mono text-xs font-bold border border-indigo-200 mb-2">
                        <span>03. HỒ SƠ KỸ THUẬT &amp; BÀN GIAO</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Kiến Trúc Công Nghệ &amp; Bàn Giao</h2>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 font-mono text-xs font-semibold">
                        Nghiệm thu hoàn tất
                    </span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tech Stack -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                    <div class="text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">code</span>
                        <span>Công nghệ sử dụng</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        @foreach(explode(',', $techStack ?: 'PHP, Laravel, Tailwind CSS, MySQL, REST API') as $tech)
                            <span class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs font-mono">
                                {{ trim($tech) }}
                            </span>
                        @endforeach
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">Mã nguồn tinh gọn, tối ưu hiệu năng và bảo mật chuẩn mực.</p>
                </div>

                <!-- Deliverables -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                    <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider font-mono flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">verified</span>
                        <span>Kết quả bàn giao</span>
                    </div>
                    <div class="text-sm font-bold text-slate-900 leading-snug">
                        {{ $result ?: 'Nghiệm thu thành công 100%, bàn giao toàn bộ mã nguồn và quyền quản trị cho khách hàng.' }}
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">Bàn giao tài liệu hướng dẫn quản trị và chính sách bảo hành hỗ trợ kỹ thuật lâu dài.</p>
                </div>

                <!-- Domain & Live URL -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3 md:col-span-2 lg:col-span-1">
                    <div class="text-xs font-bold text-sky-600 uppercase tracking-wider font-mono flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">language</span>
                        <span>Tên miền &amp; Vận hành</span>
                    </div>
                    <div class="text-sm font-bold text-slate-900 font-mono">
                        {{ $domain ?: ($caseStudy->slug . '.vn') }}
                    </div>
                    @if($demoUrl)
                        <a href="{{ $demoUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] hover:underline font-mono">
                            <span>Ghé thăm trang web ↗</span>
                        </a>
                    @else
                        <p class="text-xs text-slate-500">Hệ thống đang vận hành ổn định trên hạ tầng Cloud Server chuyên dụng.</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- ========================================================
             SECTION 05: KPI METRICS (NẾU CÓ DỮ LIỆU)
             ======================================================== -->
        @if(!empty($metrics) && count($metrics) > 0)
            <section class="space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-mono text-xs font-bold border border-emerald-200 mb-1">
                    <span>04. HIỆU QUẢ ĐO LƯỜNG (KPI HIGHLIGHTS)</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Chỉ Số Tăng Trưởng &amp; Kết Quả Thực Tế
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($metrics as $met)
                        <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                            <div class="text-3xl sm:text-4xl font-black text-[#ff5400] font-headline tracking-tight">
                                {{ $met['value'] ?? '' }}
                            </div>
                            <div class="text-sm font-bold text-slate-900">
                                {{ $met['label'] ?? '' }}
                            </div>
                            @if(!empty($met['context']))
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    {{ $met['context'] }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ========================================================
             SECTION 06: YOUTUBE VIDEO EMBED (NẾU CÓ VIDEO URL)
             ======================================================== -->
        @if($videoId)
            <section class="space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-red-600 font-mono text-xs font-bold border border-red-200 mb-1">
                    <span>05. VIDEO GIỚI THIỆU DỰ ÁN</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Trải Nghiệm Trực Quan Qua Video
                </h2>
                <div class="aspect-video w-full rounded-3xl overflow-hidden shadow-2xl border border-slate-200/80 bg-black">
                    <iframe class="w-full h-full" 
                            src="https://www.youtube.com/embed/{{ $videoId }}" 
                            title="{{ $caseStudy->title }}"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </section>
        @endif

        <!-- ========================================================
             SECTION 07: GALLERY (NẾU CÓ THƯ VIỆN ẢNH)
             ======================================================== -->
        @if(!empty($gallery) && count($gallery) > 0)
            <section class="space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-50 text-purple-700 font-mono text-xs font-bold border border-purple-200 mb-1">
                    <span>06. HÌNH ẢNH GIAO DIỆN &amp; CHI TIẾT</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Bộ Sưu Tập Giao Diện Dự Án
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($gallery as $img)
                        <div class="rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-sm group/g space-y-2">
                            <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                                <img src="{{ $img['image_url'] ?? '' }}" 
                                     alt="{{ $img['caption'] ?? $caseStudy->title }}" 
                                     class="w-full h-full object-cover group-hover/g:scale-105 transition-transform duration-500">
                            </div>
                            @if(!empty($img['caption']))
                                <div class="p-3 text-xs text-slate-600 font-medium">
                                    {{ $img['caption'] }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ========================================================
             SECTION 08: DETAILED ARTICLE CONTENT (NẾU CÓ TRONG ADMIN)
             ======================================================== -->
        @if(!empty($caseStudy->content))
            <section class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-6">
                <h2 class="text-2xl font-bold text-slate-900 border-b border-slate-100 pb-4">
                    Chi Tiết Quá Trình Triển Khai
                </h2>
                <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed">
                    {!! $caseStudy->content !!}
                </div>
            </section>
        @endif

        <!-- ========================================================
             SECTION 09: RELATED PROJECTS
             ======================================================== -->
        @if(isset($relatedCases) && $relatedCases->count() > 0)
            <section class="space-y-6 pt-6 border-t border-slate-200/80">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <span class="text-xs font-mono font-bold text-[#ff5400] uppercase tracking-wider block mb-1">KHÁM PHÁ THÊM</span>
                        <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-slate-900">
                            Các Dự Án Website Tiêu Biểu Khác
                        </h2>
                    </div>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] hover:underline font-mono">
                        <span>Xem tất cả dự án</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedCases as $rel)
                        <a href="{{ route('projects.show', $rel->slug) }}" class="group/rel block rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-2xs hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                                <img src="{{ $rel->cover_image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover/rel:scale-105 transition-transform duration-500">
                                <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white/95 text-slate-800 shadow-sm border border-slate-100">
                                    {{ $rel->meta_data['category_name'] ?? 'Website' }}
                                </span>
                            </div>
                            <div class="p-5 space-y-1.5">
                                <h3 class="font-bold text-slate-900 text-sm group-hover/rel:text-[#ff5400] transition-colors line-clamp-1">
                                    {{ $rel->title }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {{ $rel->summary }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ========================================================
             SECTION 10: BOTTOM BACK & CTA BAR
             ======================================================== -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-[#ff5400] transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Quay lại danh mục dự án</span>
            </a>
            <div class="flex items-center gap-3 flex-wrap">
                @if($demoUrl)
                    <a href="{{ $demoUrl }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="inline-flex items-center gap-1.5 px-6 py-3 rounded-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-md transition-all">
                        <span>Ghé thăm website</span>
                        <span class="material-symbols-outlined text-[16px] text-[#ff5400]">open_in_new</span>
                    </a>
                @endif
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#ff5400] hover:bg-orange-600 text-white font-bold text-sm shadow-md shadow-orange-500/25 transition-all">
                    <span>Tư vấn dự án tương tự</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </div>

    </div>
</div>
