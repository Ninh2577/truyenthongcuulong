@extends('layouts.app')

@section('title', 'Thiết Kế & Lập Trình Web/App Chuyên Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ thiết kế website và phát triển web app doanh nghiệp chuẩn SEO, kiến trúc clean-code chịu tải cao, bàn giao trọn gói mã nguồn.')

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Thiết Kế & Lập Trình Web/App Doanh Nghiệp",
  "serviceType": "Software Development & Web Design",
  "provider": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "url": "https://truyenthongcuulong.com",
    "logo": "https://truyenthongcuulong.com/images/logo.png"
  },
  "areaServed": "VN",
  "description": "Dịch vụ thiết kế website và phát triển web app doanh nghiệp chuẩn SEO, kiến trúc clean-code chịu tải cao, bàn giao trọn gói mã nguồn.",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VND",
    "availability": "https://schema.org/InStock",
    "url": "{{ route('pricing') }}"
  }
}
</script>
@endpush

@section('content')
<!-- Small Hero Section (NỀN SÁNG: Surface Low) -->
<section class="relative w-full overflow-hidden bg-surface-low bg-dot-grid-subtle pt-32 pb-12 lg:pt-36 lg:pb-16 border-b border-slate-200/80">
    <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-sky-500/15 via-cyan-500/10 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 left-1/4 w-96 h-96 bg-amber-500/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-600">/</span>
            <a href="{{ route('services.index') }}" class="hover:text-amber-400 transition-colors">Dịch vụ</a>
            <span class="text-slate-600">/</span>
            <span class="text-amber-400 font-semibold" aria-current="page">Thiết Kế &amp; Lập Trình Web/App</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-8 flex flex-col gap-5">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-400/10 text-sky-400 font-mono text-xs font-bold border border-sky-400/30 w-fit">
                    <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                    <span>TECHLAB &bull; ENTERPRISE SOFTWARE SOLUTIONS</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base leading-tight">
                    Thiết Kế &amp; Phát Triển Nền Tảng <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-cyan-600 to-amber-500">Web/App Chịu Tải Cao</span>, Chuẩn SEO &amp; Clean-Code
                </h1>
                <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed max-w-3xl">
                    Chúng tôi xây dựng hệ thống số theo chuẩn mực kiến trúc phần mềm doanh nghiệp: Tốc độ tải trang &lt; 1.2s, bảo mật đa tầng, tối ưu điểm Core Web Vitals tuyệt đối và bàn giao 100% mã nguồn độc quyền.
                </p>

                <!-- Tech Stack Badges (Năng Lực Kỹ Thuật Đa Dạng & Triển Khai Theo Yêu Cầu) -->
                <div class="flex flex-col gap-2.5 pt-2">
                    <!-- Row 1: Core Frameworks & Front-end/Mobile -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-[11px] font-mono font-bold text-slate-400 uppercase tracking-wider mr-1 hidden sm:inline">Nền tảng lõi:</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-sky-400 font-mono text-xs font-bold border border-sky-500/30">Laravel 11</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-cyan-300 font-mono text-xs font-bold border border-cyan-500/30">React</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-emerald-400 font-mono text-xs font-bold border border-emerald-500/30">Vue.js / Alpine</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-amber-300 font-mono text-xs font-bold border border-amber-400/30">JavaScript (ES6+)</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-amber-400 font-mono text-xs font-bold border border-amber-500/30">Flutter App Ready</span>
                    </div>
                    <!-- Row 2: Infrastructure, Database & CMS Hỗ Trợ Theo Yêu Cầu -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-[11px] font-mono font-bold text-slate-400 uppercase tracking-wider mr-1 hidden sm:inline">Hạ tầng &amp; Hỗ trợ:</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-blue-400 font-mono text-xs font-bold border border-blue-500/30">MySQL / Redis</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-indigo-300 font-mono text-xs font-bold border border-indigo-500/30">SQL Server</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-orange-400 font-mono text-xs font-bold border border-orange-500/30">AWS Cloud &amp; Docker</span>
                        <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-teal-300 font-mono text-xs font-bold border border-teal-500/30">WordPress (CMS)</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-3">
                    <a href="{{ route('pricing') }}" class="px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs sm:text-sm font-extrabold shadow-lg shadow-amber-400/20 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">calculate</span>
                        <span>Dự Toán Chi Phí Tức Thời</span>
                    </a>
                    <a href="#case-studies" class="px-6 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-white font-headline text-xs sm:text-sm font-semibold hover:bg-slate-800 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                        <span>Xem Dự Án Đã Làm</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="p-6 rounded-3xl bg-[#0F172A] text-white border border-slate-700/80 shadow-xl flex flex-col gap-5 relative overflow-hidden">
                    <div class="flex items-center justify-between pb-3 border-b border-white/10">
                        <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">CAM KẾT KỸ THUẬT SLA</span>
                        <span class="material-symbols-outlined text-amber-400">verified</span>
                    </div>
                    <ul class="flex flex-col gap-3 font-body text-xs text-slate-300">
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Google Lighthouse Performance 95 - 100</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Bảo mật chống tấn công SQLi, XSS, CSRF</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Bàn giao trọn gói mã nguồn &amp; DB</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Hỗ trợ kỹ thuật &amp; bảo trì 24/7</span>
                        </li>
                    </ul>
                    <div class="pt-2">
                        <a href="{{ route('contact') }}?service=web-app" class="w-full py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all text-center block">
                            Đặt Lịch Phỏng Vấn Kỹ Thuật
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: 4 Gói Giải Pháp Trọng Tâm (NỀN SÁNG) -->
<section class="w-full bg-surface bg-dot-grid-subtle py-12 lg:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold mb-3 border border-sky-200">
                <span class="material-symbols-outlined text-[16px]">widgets</span>
                <span>CORE SOFTWARE CAPABILITIES</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                4 Gói Giải Pháp Công Nghệ Trọng Tâm
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Tối ưu hóa riêng biệt cho từng quy mô kinh doanh, từ doanh nghiệp vừa &amp; nhỏ đến tập đoàn đa chi nhánh.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Gói 1: Website Doanh Nghiệp Cao Cấp (NAVY / DEEP BLUE) -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-blue-500/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-900 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-blue-200">
                        <span class="material-symbols-outlined text-[26px]">devices</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">
                        Website Doanh Nghiệp Cao Cấp
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Thiết kế giao diện độc quyền theo nhận diện thương hiệu, tối ưu Core Web Vitals, tốc độ tải nhanh &lt; 1.2s và chuẩn SEO Google Onpage 100%.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500 font-bold">
                    <span>Thời gian: 7 - 14 ngày</span>
                    <span class="text-blue-700">Chuẩn SEO</span>
                </div>
            </div>

            <!-- Gói 2: Cổng Thông Tin & Sàn E-Commerce (EMERALD / GREEN) -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-500/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-800 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-emerald-200">
                        <span class="material-symbols-outlined text-[26px]">shopping_cart</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">
                        Cổng Thông Tin &amp; Sàn E-Commerce
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Hệ thống CMS quản trị phân quyền đa cấp, tích hợp cổng thanh toán VNPay, Momo, tự động tính phí vận chuyển và quản lý kho hàng thời gian thực.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500 font-bold">
                    <span>Thời gian: 2 - 4 tuần</span>
                    <span class="text-emerald-700">Đa cổng TT</span>
                </div>
            </div>

            <!-- Gói 3: Mobile App Đa Nền Tảng (ORANGE / AMBER) -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-orange-500/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-800 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-orange-200">
                        <span class="material-symbols-outlined text-[26px]">phone_iphone</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">
                        Mobile App Đa Nền Tảng
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Năng lực kỹ thuật sẵn sàng triển khai ứng dụng di động trên nền Flutter/React Native: Một mã nguồn chạy mượt mà trên cả iOS &amp; Android, đồng bộ API tức thì.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500 font-bold">
                    <span>Sẵn sàng phát triển</span>
                    <span class="text-orange-700">Flutter Ready</span>
                </div>
            </div>

            <!-- Gói 4: Hệ Thống Nội Bộ & Tích Hợp API (PURPLE / INDIGO) -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-purple-500/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-800 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-purple-200">
                        <span class="material-symbols-outlined text-[26px]">hub</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">
                        Hệ Thống Nội Bộ &amp; Tích Hợp API
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Số hóa quy trình vận hành CRM, ERP doanh nghiệp, kết nối API các phần mềm kế toán, giao vận và chatbot tự động hóa dữ liệu thông minh.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500 font-bold">
                    <span>May đo nghiệp vụ</span>
                    <span class="text-purple-700">Enterprise</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Quy Trình Phát Triển 6 Bước Kỹ Thuật (NỀN SÁNG) -->
<section class="w-full bg-surface-low bg-dot-grid-subtle text-slate-900 py-12 lg:py-16 relative overflow-hidden border-b border-slate-200/80">
    <!-- Ambient Glow -->
    <div class="absolute -top-24 right-10 w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 left-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-50 text-amber-600 font-mono text-xs font-bold mb-3 border border-amber-200">
                <span class="material-symbols-outlined text-[16px]">terminal</span>
                <span>AGILE DEVELOPMENT WORKFLOW</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                Quy Trình Triển Khai 6 Bước Chuẩn Mực
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Minh bạch từng cột mốc nghiệm thu, kiểm thử tự động và đảm bảo tiến độ bàn giao chính xác 100%.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-amber-400/60 hover:shadow-md transition-all">
                <span class="font-mono text-2xl font-black text-amber-500">01</span>
                <h3 class="font-headline text-base font-bold text-navy-base">Phân Tích Nghiệp Vụ &amp; Kiến Trúc</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Khảo sát yêu cầu, xác định sơ đồ CSDL, thiết lập thông số chịu tải và lựa chọn công nghệ tối ưu.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-amber-400/60 hover:shadow-md transition-all">
                <span class="font-mono text-2xl font-black text-amber-500">02</span>
                <h3 class="font-headline text-base font-bold text-navy-base">Wireframe &amp; Thiết Kế UI/UX</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Dựng bản vẽ Figma chi tiết từng màn hình desktop &amp; mobile, duyệt màu sắc thương hiệu trước khi code.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-amber-400/60 hover:shadow-md transition-all">
                <span class="font-mono text-2xl font-black text-amber-500">03</span>
                <h3 class="font-headline text-base font-bold text-navy-base">Lập Trình Clean-Code</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Xây dựng backend Laravel chuẩn RESTful API, frontend tương tác mượt mà không giật lag.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-amber-400/60 hover:shadow-md transition-all">
                <span class="font-mono text-2xl font-black text-amber-500">04</span>
                <h3 class="font-headline text-base font-bold text-navy-base">Kiểm Thử QA/QC Nghiêm Ngặt</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Kiểm tra bảo mật, test tải đồng thời, rà soát responsive trên hơn 10 kích thước màn hình thiết bị.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-amber-400/60 hover:shadow-md transition-all">
                <span class="font-mono text-2xl font-black text-amber-500">05</span>
                <h3 class="font-headline text-base font-bold text-navy-base">Triển Khai Máy Chủ &amp; Tên Miền</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Cấu hình SSL, CDN Cloudflare, thiết lập sao lưu cơ sở dữ liệu tự động hàng ngày.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-amber-400/60 hover:shadow-md transition-all">
                <span class="font-mono text-2xl font-black text-amber-500">06</span>
                <h3 class="font-headline text-base font-bold text-navy-base">Bàn Giao &amp; Bảo Hành 24/7</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Chuyển giao mã nguồn, hướng dẫn ban quản trị sử dụng CMS và kích hoạt hợp đồng bảo trì dài hạn.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Dự Án Tiêu Biểu & Mẫu Giao Diện (NỀN SÁNG) -->
<section id="case-studies" class="w-full bg-surface bg-dot-grid-subtle py-12 lg:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>PROVEN DELIVERIES</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                    Dự Án Công Nghệ Tiêu Biểu
                </h2>
            </div>
            <a href="{{ route('projects.index') }}?group=technology" class="inline-flex items-center gap-2 text-primary font-headline text-sm font-bold hover:underline">
                <span>Xem tất cả dự án</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featuredTechProjects as $project)
            @php
                // Màu badge trạng thái
                if ($project['status_type'] === 'operational') {
                    $statusDot = 'bg-cyan-400';
                    $statusText = 'text-cyan-300';
                    $statusBg = 'bg-cyan-400/10 border-cyan-400/30';
                } elseif ($project['status_type'] === 'ready') {
                    $statusDot = 'bg-amber-400';
                    $statusText = 'text-amber-300';
                    $statusBg = 'bg-amber-400/10 border-amber-400/30';
                } else {
                    $statusDot = 'bg-emerald-400';
                    $statusText = 'text-emerald-300';
                    $statusBg = 'bg-emerald-400/10 border-emerald-400/30';
                }
                $hasThumb = !empty($project['thumbnail']) && file_exists(public_path('storage/' . $project['thumbnail']));
            @endphp
            <div class="group rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl hover:shadow-slate-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col bg-white">

                <!-- Image Area with aspect ratio to prevent severe cropping -->
                <div class="relative overflow-hidden aspect-[4/3] xl:aspect-[16/10] bg-slate-900 border-b border-slate-100">
                    @if($hasThumb)
                        <img src="{{ asset('storage/' . $project['thumbnail']) }}"
                             alt="{{ $project['title'] }}"
                             loading="lazy"
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                    @else
                        <!-- Fallback gradient background -->
                        <div class="w-full h-full bg-gradient-to-br {{ $project['gradient'] }} flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-dot-grid-dark opacity-30 pointer-events-none"></div>
                            <span class="material-symbols-outlined text-5xl text-white/20">code_blocks</span>
                        </div>
                    @endif

                    <!-- Dark gradient overlay from bottom -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent pointer-events-none"></div>

                    <!-- Status badge — bottom-left overlay on image -->
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-mono font-bold px-2.5 py-1 rounded-full {{ $statusText }} {{ $statusBg }} border backdrop-blur-md shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }} animate-pulse shrink-0"></span>
                            {{ $project['status_badge'] }}
                        </span>
                    </div>

                    <!-- Category badge — bottom-right overlay on image -->
                    <div class="absolute bottom-3 right-3 z-10">
                        <span class="px-2.5 py-1 rounded-full bg-white/10 backdrop-blur-md text-[10px] font-mono font-bold text-white border border-white/20 shadow-sm">
                            {{ $project['badge'] }}
                        </span>
                    </div>
                </div>

                <!-- Card body — seamless continuation, no border separator -->
                <div class="p-5 flex flex-col gap-3 flex-1 justify-between">
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-sm sm:text-base font-bold text-navy-base group-hover:text-primary transition-colors leading-snug line-clamp-2">
                            {{ $project['title'] }}
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed line-clamp-3">
                            {{ $project['summary'] }}
                        </p>
                    </div>

                    <!-- Footer: tech stack + CTA (tech stack shown ONCE here only) -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                        <span class="font-mono text-[10px] text-slate-500 leading-tight">{{ $project['tech_stack'] }}</span>
                        <a href="{{ route('contact', ['service' => 'Tư Vấn Giải Pháp: ' . $project['title']]) }}"
                           class="inline-flex items-center gap-1 text-xs font-headline font-bold text-sky-700 group-hover:text-primary transition-colors shrink-0">
                            <span>Chi tiết</span>
                            <span class="material-symbols-outlined text-[15px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-10 text-slate-500 text-sm">
                Đang cập nhật các dự án công nghệ mới nhất.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Section 5: Khám Phá Kho Giao Diện Có Sẵn (NỀN SÁNG - PHONG CÁCH GOLDEN BEE) -->
@if(isset($featuredTemplates) && $featuredTemplates->isNotEmpty())
<section x-data="{ activeFilter: 'all' }" class="w-full bg-surface bg-dot-grid-subtle py-12 lg:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 lg:mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[16px]">web</span>
                    <span>READY-TO-DEPLOY THEMES</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                    Mẫu Giao Diện Triển Khai Trong 48 Giờ
                </h2>
            </div>
            <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-2 text-sky-700 font-headline text-sm font-bold hover:underline">
                <span>Xem kho 39+ giao diện</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <!-- Thanh Filter Dạng Pill Phía Trên Lưới (Phong cách Golden Bee) -->
        <div class="flex items-center justify-start md:justify-center gap-2 sm:gap-2.5 overflow-x-auto no-scrollbar pb-3 px-1 mb-8 sm:mb-10">
            <button type="button"
                @click="activeFilter = 'all'"
                :class="activeFilter === 'all' ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-400/25 border-amber-400 font-bold' : 'bg-white text-slate-700 hover:text-navy-base hover:bg-slate-50 border-slate-200/90 shadow-2xs hover:border-amber-400/50 font-semibold'"
                class="px-5 py-2 rounded-full text-xs font-headline whitespace-nowrap transition-all border shrink-0 cursor-pointer">
                Tất cả
            </button>
            <button type="button"
                @click="activeFilter = 'sach-van-phong'"
                :class="activeFilter === 'sach-van-phong' ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-400/25 border-amber-400 font-bold' : 'bg-white text-slate-700 hover:text-navy-base hover:bg-slate-50 border-slate-200/90 shadow-2xs hover:border-amber-400/50 font-semibold'"
                class="px-5 py-2 rounded-full text-xs font-headline whitespace-nowrap transition-all border shrink-0 cursor-pointer">
                Nhà sách & Văn phòng
            </button>
            <button type="button"
                @click="activeFilter = 'thoi-trang'"
                :class="activeFilter === 'thoi-trang' ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-400/25 border-amber-400 font-bold' : 'bg-white text-slate-700 hover:text-navy-base hover:bg-slate-50 border-slate-200/90 shadow-2xs hover:border-amber-400/50 font-semibold'"
                class="px-5 py-2 rounded-full text-xs font-headline whitespace-nowrap transition-all border shrink-0 cursor-pointer">
                Thời trang & Bán lẻ
            </button>
            <button type="button"
                @click="activeFilter = 'o-to-xe-may'"
                :class="activeFilter === 'o-to-xe-may' ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-400/25 border-amber-400 font-bold' : 'bg-white text-slate-700 hover:text-navy-base hover:bg-slate-50 border-slate-200/90 shadow-2xs hover:border-amber-400/50 font-semibold'"
                class="px-5 py-2 rounded-full text-xs font-headline whitespace-nowrap transition-all border shrink-0 cursor-pointer">
                Xe máy & Ô tô
            </button>
            <button type="button"
                @click="activeFilter = 'noi-that'"
                :class="activeFilter === 'noi-that' ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-400/25 border-amber-400 font-bold' : 'bg-white text-slate-700 hover:text-navy-base hover:bg-slate-50 border-slate-200/90 shadow-2xs hover:border-amber-400/50 font-semibold'"
                class="px-5 py-2 rounded-full text-xs font-headline whitespace-nowrap transition-all border shrink-0 cursor-pointer">
                Nội thất & Kiến trúc
            </button>
        </div>

        <style>
            .gb-scroll-container {
                height: 420px;
            }
            @media (max-width: 640px) {
                .gb-scroll-container {
                    height: 380px;
                }
            }
            .gb-long-img {
                width: 100%;
                height: auto;
                min-height: 101%; /* Just enough to ensure it covers if slightly short */
                display: block;
                object-fit: cover;
                object-position: top;
                transform: translateY(0);
                transition: transform 6.5s cubic-bezier(0.25, 1, 0.5, 1);
                will-change: transform;
            }
            .group:hover .gb-long-img {
                transform: translateY(calc(-100% + 420px));
            }
            @media (max-width: 640px) {
                .group:hover .gb-long-img {
                    transform: translateY(calc(-100% + 380px));
                }
            }
        </style>

        <!-- Lưới Card Giao Diện (Phong cách Trang Web Thu Nhỏ Cuộn Dài) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredTemplates as $tpl)
            @php
                $slug = $tpl->slug;
                
                if (str_contains($slug, 'sach-van-phong') || str_contains($slug, 'book')) {
                    $filterKey = 'sach-van-phong';
                    $indFilterSlug = 'sach-van-phong-pham';
                    $typeBadge = 'E-commerce';
                    $tierBadge = 'Miễn phí tùy chỉnh';
                    $titleDisplay = 'Stationero Bookstore';
                    $subtitleDisplay = 'Nhà Sách & Văn Phòng Phẩm';
                    $fullImgPath = 'uploads/2022/11/website-bookstore-stationero-homepage-scaled.jpg';
                } elseif (str_contains($slug, 'thoi-trang') || str_contains($slug, 'fashion')) {
                    $filterKey = 'thoi-trang';
                    $indFilterSlug = 'thoi-trang';
                    $typeBadge = 'Thời trang';
                    $tierBadge = 'Nâng cao';
                    $titleDisplay = 'Stylista Boutique';
                    $subtitleDisplay = 'Thời Trang & Phụ Kiện';
                    $fullImgPath = 'uploads/2022/10/template-website-fashion-stylista-homepage-scaled.jpg';
                } elseif (str_contains($slug, 'o-to-xe-may') || str_contains($slug, 'car') || str_contains($slug, 'grand')) {
                    $filterKey = 'o-to-xe-may';
                    $indFilterSlug = 'o-to-xe-may';
                    $typeBadge = 'Showroom';
                    $tierBadge = 'Nâng cao';
                    $titleDisplay = 'Grand Motors';
                    $subtitleDisplay = 'Đại Lý Xe Máy & Ô Tô';
                    $fullImgPath = 'uploads/2022/11/template-website-car-grand-homepage-scaled.jpg';
                } else {
                    $filterKey = 'noi-that';
                    $indFilterSlug = 'noi-that-trang-tri';
                    $typeBadge = 'Nội thất';
                    $tierBadge = 'Miễn phí tùy chỉnh';
                    $titleDisplay = 'Furnihaus Living';
                    $subtitleDisplay = 'Nội Thất & Không Gian Sống';
                    $fullImgPath = 'uploads/2022/11/template-website-noithattrangtri-furnihaus-homepage-scaled.jpg';
                }

                $imgSrc = (file_exists(public_path('storage/' . $fullImgPath))) 
                    ? asset('storage/' . $fullImgPath) 
                    : ($tpl->thumbnail && file_exists(public_path('storage/' . $tpl->thumbnail)) ? asset('storage/' . $tpl->thumbnail) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80');
            @endphp
            <div x-show="activeFilter === 'all' || activeFilter === '{{ $filterKey }}'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 class="group relative rounded-3xl overflow-hidden bg-slate-900 border border-slate-200/90 hover:border-amber-400/80 shadow-md hover:shadow-2xl hover:shadow-amber-500/15 transition-all duration-500 flex flex-col justify-between gb-scroll-container">
                
                <!-- Full-Length Webpage Vertical Scroll Preview -->
                <div class="w-full h-full relative overflow-hidden bg-slate-950">
                    <img src="{{ $imgSrc }}" 
                         alt="{{ $titleDisplay }}" 
                         loading="lazy"
                         decoding="async"
                         class="gb-long-img">

                    <!-- Badge Loại Hình (Góc Trái - Phong Cách Golden Bee) -->
                    <div class="absolute top-3.5 left-3.5 z-20">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/95 text-slate-900 font-headline text-[11px] sm:text-xs font-bold shadow-md tracking-tight border border-white/60 backdrop-blur-xs">
                            {{ $typeBadge }}
                        </span>
                    </div>

                    <!-- Badge Phân Loại Gói (Góc Phải - Phong Cách Golden Bee) -->
                    <div class="absolute top-3.5 right-3.5 z-20">
                        @if($tierBadge === 'Miễn phí tùy chỉnh')
                            <span class="inline-flex items-center gap-0.5 sm:gap-1 px-2 sm:px-3 py-1 rounded-full bg-amber-400 text-slate-950 font-headline text-[10px] sm:text-[11px] font-extrabold shadow-md tracking-tight">
                                <span class="material-symbols-outlined text-[13px]">bolt</span>
                                <span class="hidden sm:inline">{{ $tierBadge }}</span>
                                <span class="sm:hidden">Miễn phí</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-0.5 sm:gap-1 px-2 sm:px-3 py-1 rounded-full bg-slate-950/85 backdrop-blur-md text-amber-300 font-headline text-[10px] sm:text-[11px] font-extrabold shadow-md tracking-tight border border-amber-400/40">
                                <span class="material-symbols-outlined text-[13px]">workspace_premium</span>
                                <span class="hidden sm:inline">{{ $tierBadge }}</span>
                                <span class="sm:hidden">Pro</span>
                            </span>
                        @endif
                    </div>

                    <!-- Bottom Gradient Overlay & Amber CTA Button (Phong Cách Golden Bee) -->
                    <div class="absolute inset-x-0 bottom-0 pt-32 pb-4 px-4 flex flex-col gap-2.5 z-20 pointer-events-auto" style="background: linear-gradient(to top, rgba(2, 6, 23, 0.95) 0%, rgba(2, 6, 23, 0.8) 45%, transparent 100%);">
                        <div>
                            <h3 class="font-headline text-base sm:text-lg font-bold text-white tracking-tight leading-snug drop-shadow-md group-hover:text-amber-300 transition-colors">
                                {{ $titleDisplay }}
                            </h3>
                            <p class="font-body text-xs text-slate-300 font-medium line-clamp-1 mt-0.5">
                                {{ $subtitleDisplay }}
                            </p>
                        </div>
                        
                        <a href="{{ route('templates.index', ['industry' => $indFilterSlug]) }}" 
                           class="w-full py-2.5 px-4 rounded-full bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs sm:text-sm font-extrabold shadow-lg shadow-amber-400/30 flex items-center justify-center gap-1.5 transition-all transform group-hover:scale-[1.02] active:scale-[0.98]">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
