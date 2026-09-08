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
<!-- Small Hero Section (NỀN TỐI DEEP NAVY) -->
<section class="relative w-full overflow-hidden bg-[#080C16] bg-dot-grid-dark pt-32 pb-12 lg:pt-36 lg:pb-16 border-b border-slate-800/80" style="background-color: #080C16 !important;">
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
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Thiết Kế &amp; Phát Triển Nền Tảng <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-cyan-300 to-amber-300">Web/App Chịu Tải Cao</span>, Chuẩn SEO &amp; Clean-Code
                </h1>
                <p class="font-body text-slate-300 text-base sm:text-lg leading-relaxed max-w-3xl">
                    Chúng tôi xây dựng hệ thống số theo chuẩn mực kiến trúc phần mềm doanh nghiệp: Tốc độ tải trang &lt; 1.2s, bảo mật đa tầng, tối ưu điểm Core Web Vitals tuyệt đối và bàn giao 100% mã nguồn độc quyền.
                </p>

                <!-- Tech Stack Badges -->
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-sky-400 font-mono text-xs font-bold border border-sky-500/30">Laravel 11</span>
                    <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-emerald-400 font-mono text-xs font-bold border border-emerald-500/30">Vue.js / Alpine</span>
                    <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-amber-400 font-mono text-xs font-bold border border-amber-500/30">Flutter App Ready</span>
                    <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-blue-400 font-mono text-xs font-bold border border-blue-500/30">MySQL / Redis</span>
                    <span class="px-3 py-1 rounded-lg bg-[#0F172A] text-orange-400 font-mono text-xs font-bold border border-orange-500/30">AWS Cloud &amp; Docker</span>
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
            <!-- Cap 1 -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-500/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-700 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-sky-100">
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
                    <span class="text-sky-600">Chuẩn SEO</span>
                </div>
            </div>

            <!-- Cap 2 -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 text-primary flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-orange-100">
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
                    <span class="text-primary">Đa cổng TT</span>
                </div>
            </div>

            <!-- Cap 3 -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-500/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-amber-100">
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
                    <span class="text-amber-600">Flutter Ready</span>
                </div>
            </div>

            <!-- Cap 4 -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-500/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform border border-emerald-100">
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
                    <span class="text-emerald-600">Enterprise</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Quy Trình Phát Triển 6 Bước Kỹ Thuật (NỀN TỐI DEEP NAVY) -->
<section class="w-full bg-[#080C16] bg-dot-grid-dark text-white py-12 lg:py-16 relative overflow-hidden border-b border-slate-800" style="background-color: #080C16 !important;">
    <!-- Ambient Glow -->
    <div class="absolute -top-24 right-10 w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 left-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/10 text-amber-400 font-mono text-xs font-bold mb-3 border border-amber-400/30">
                <span class="material-symbols-outlined text-[16px]">terminal</span>
                <span>AGILE DEVELOPMENT WORKFLOW</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                Quy Trình Triển Khai 6 Bước Chuẩn Mực
            </h2>
            <p class="font-body text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Minh bạch từng cột mốc nghiệm thu, kiểm thử tự động và đảm bảo tiến độ bàn giao chính xác 100%.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 hover:border-amber-400/40 transition-all">
                <span class="font-mono text-2xl font-black text-amber-400">01</span>
                <h3 class="font-headline text-base font-bold text-white">Phân Tích Nghiệp Vụ &amp; Kiến Trúc</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">Khảo sát yêu cầu, xác định sơ đồ CSDL, thiết lập thông số chịu tải và lựa chọn công nghệ tối ưu.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 hover:border-amber-400/40 transition-all">
                <span class="font-mono text-2xl font-black text-amber-400">02</span>
                <h3 class="font-headline text-base font-bold text-white">Wireframe &amp; Thiết Kế UI/UX</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">Dựng bản vẽ Figma chi tiết từng màn hình desktop &amp; mobile, duyệt màu sắc thương hiệu trước khi code.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 hover:border-amber-400/40 transition-all">
                <span class="font-mono text-2xl font-black text-amber-400">03</span>
                <h3 class="font-headline text-base font-bold text-white">Lập Trình Clean-Code</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">Xây dựng backend Laravel chuẩn RESTful API, frontend tương tác mượt mà không giật lag.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 hover:border-amber-400/40 transition-all">
                <span class="font-mono text-2xl font-black text-amber-400">04</span>
                <h3 class="font-headline text-base font-bold text-white">Kiểm Thử QA/QC Nghiêm Ngặt</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">Kiểm tra bảo mật, test tải đồng thời, rà soát responsive trên hơn 10 kích thước màn hình thiết bị.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 hover:border-amber-400/40 transition-all">
                <span class="font-mono text-2xl font-black text-amber-400">05</span>
                <h3 class="font-headline text-base font-bold text-white">Triển Khai Máy Chủ &amp; Tên Miền</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">Cấu hình SSL, CDN Cloudflare, thiết lập sao lưu cơ sở dữ liệu tự động hàng ngày.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 hover:border-amber-400/40 transition-all">
                <span class="font-mono text-2xl font-black text-amber-400">06</span>
                <h3 class="font-headline text-base font-bold text-white">Bàn Giao &amp; Bảo Hành 24/7</h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">Chuyển giao mã nguồn, hướng dẫn ban quản trị sử dụng CMS và kích hoạt hợp đồng bảo trì dài hạn.</p>
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($techCaseStudies as $case)
            <div class="rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group">
                <div class="h-48 w-full relative overflow-hidden bg-navy-base">
                    @if($case->thumbnail)
                        <img src="{{ asset('storage/' . $case->thumbnail) }}" alt="{{ $case->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-navy-base to-slate-800 flex items-center justify-center text-slate-500">
                            <span class="material-symbols-outlined text-5xl text-sky-400">devices</span>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-0.5 rounded-full bg-navy-base/80 backdrop-blur-md text-amber-400 font-mono text-xs font-bold border border-amber-400/30">
                            {{ $case->client_name ?: 'Hệ Thống Số' }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex flex-col gap-3">
                    <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2">
                        {!! $case->title !!}
                    </h3>
                    <p class="font-body text-xs text-slate-600 line-clamp-2 leading-relaxed">
                        {{ $case->summary ?: 'Hệ thống web platform được phát triển bởi đội ngũ kỹ sư phần mềm Truyền Thông Cửu Long TechLab.' }}
                    </p>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-sky-600">
                        <span>Chi tiết giải pháp</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-10 text-slate-500 text-sm">
                Đang cập nhật các case study công nghệ mới nhất.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Section 5: Khám Phá Kho Giao Diện Có Sẵn (NỀN SÁNG) -->
@if(isset($featuredTemplates) && $featuredTemplates->isNotEmpty())
<section class="w-full bg-surface bg-dot-grid-subtle py-12 lg:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[16px]">web</span>
                    <span>READY-TO-DEPLOY THEMES</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                    Mẫu Giao Diện Triển Khai Trong 48 Giờ
                </h2>
            </div>
            <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-2 text-sky-600 font-headline text-sm font-bold hover:underline">
                <span>Xem kho 39+ giao diện</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredTemplates as $tpl)
            <div class="rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm hover:shadow-lg transition-all flex flex-col justify-between group">
                <div class="h-44 w-full bg-slate-200 relative overflow-hidden">
                    @if($tpl->thumbnail)
                        <img src="{{ asset('storage/' . $tpl->thumbnail) }}" alt="{{ $tpl->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-navy-base flex items-center justify-center text-slate-500">
                            <span class="material-symbols-outlined text-4xl text-amber-400">web</span>
                        </div>
                    @endif
                </div>
                <div class="p-4 flex flex-col gap-2">
                    <span class="text-[10px] font-mono text-sky-600 font-bold uppercase">{{ $tpl->category->name ?? 'Giao diện mẫu' }}</span>
                    <h4 class="font-headline text-xs font-bold text-navy-base line-clamp-1 group-hover:text-primary transition-colors">{{ $tpl->title }}</h4>
                    <a href="{{ route('templates.index') }}" class="mt-2 text-xs font-headline font-bold text-primary hover:underline flex items-center gap-1">
                        <span>Xem chi tiết demo</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
