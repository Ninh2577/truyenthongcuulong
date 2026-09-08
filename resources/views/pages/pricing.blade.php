@extends('layouts.app')

@section('title', 'Bảng Giá Dịch Vụ & Dự Toán Chi Phí - Truyền Thông Cửu Long')
@section('meta_description', 'Bảng giá minh bạch sản xuất phim TVC quảng cáo 4K, thiết kế web/app chuẩn SEO và quản trị truyền thông số. Công cụ tự tính dự toán chi phí trực tuyến tức thì trong 30 giây.')

@section('content')
<div class="w-full bg-[#080C16] text-white selection:bg-amber-500 selection:text-slate-900" x-data="{
    tab: 'tvc',
    // Cost Estimator State
    serviceType: 'tvc',
    // TVC options
    duration: '60',
    drone: true,
    actor: 'pro',
    colorGrading: true,
    // Web options
    webType: 'corp',
    webPages: '10',
    aiFeature: false,
    multiLang: false,
    // Marketing options
    mktPlatform: 'multi',
    mktVideoAddon: true,
    mktDuration: '3',

    calculateTotal() {
        let total = 0;
        if (this.serviceType === 'tvc') {
            total += parseInt(this.duration) * 400000;
            if (this.drone) total += 5000000;
            if (this.actor === 'pro') total += 12000000;
            if (this.actor === 'celeb') total += 35000000;
            if (this.colorGrading) total += 4000000;
        } else if (this.serviceType === 'web') {
            if (this.webType === 'landing') total = 9500000;
            else if (this.webType === 'corp') total = 28000000;
            else if (this.webType === 'custom') total = 65000000;
            
            if (this.aiFeature) total += 15000000;
            if (this.multiLang) total += 6000000;
        } else if (this.serviceType === 'marketing') {
            let baseMonthly = 15000000;
            if (this.mktPlatform === 'single') baseMonthly = 10000000;
            if (this.mktPlatform === 'multi') baseMonthly = 22000000;
            if (this.mktPlatform === 'growth') baseMonthly = 40000000;
            
            total = baseMonthly * parseInt(this.mktDuration);
            if (this.mktVideoAddon) total += 8000000 * parseInt(this.mktDuration);
        }
        return new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
    }
}">

    <!-- SECTION 1: SMALL HERO -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 bg-[#0B132B]/60 border-b border-slate-800/80 overflow-hidden">
        <div class="absolute inset-0 bg-dot-grid-subtle opacity-20 pointer-events-none"></div>
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-semibold">Bảng giá dịch vụ</span>
            </nav>

            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold mb-4">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>TRANSPARENT PRICING &amp; ESTIMATOR</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white mb-4">
                    Bảng Giá Minh Bạch &amp; <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Dự Toán Tức Thì</span>
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed mb-8">
                    Cam kết minh bạch theo hợp đồng SLA tiêu chuẩn, không phát sinh chi phí ẩn. Chúng tôi cung cấp giải pháp may đo linh hoạt theo đúng quy mô và mục tiêu tăng trưởng của từng doanh nghiệp.
                </p>

                <!-- Category Switcher Tabs -->
                <div class="inline-flex flex-wrap items-center p-1.5 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-xl gap-1">
                    <button type="button" @click="tab = 'tvc'" 
                        :class="tab === 'tvc' ? 'bg-amber-400 text-slate-950 font-bold shadow-md shadow-amber-400/20' : 'text-slate-400 hover:text-white'" 
                        class="px-5 py-2.5 rounded-xl font-headline text-xs font-bold transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">videocam</span>
                        <span>Sản Xuất Video &amp; TVC</span>
                    </button>
                    <button type="button" @click="tab = 'web'" 
                        :class="tab === 'web' ? 'bg-amber-400 text-slate-950 font-bold shadow-md shadow-amber-400/20' : 'text-slate-400 hover:text-white'" 
                        class="px-5 py-2.5 rounded-xl font-headline text-xs font-bold transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">code</span>
                        <span>Thiết Kế Web &amp; App</span>
                    </button>
                    <button type="button" @click="tab = 'marketing'" 
                        :class="tab === 'marketing' ? 'bg-amber-400 text-slate-950 font-bold shadow-md shadow-amber-400/20' : 'text-slate-400 hover:text-white'" 
                        class="px-5 py-2.5 rounded-xl font-headline text-xs font-bold transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">trending_up</span>
                        <span>Quảng Cáo &amp; Marketing Số</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: TIER PRICING CARDS -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- TVC TAB -->
            <div x-show="tab === 'tvc'" x-transition class="space-y-8">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <span class="font-mono text-xs font-bold text-amber-400 uppercase">DANH MỤC 01</span>
                        <h2 class="font-headline text-2xl font-bold text-white">Gói Dịch Vụ Sản Xuất Video Điện Ảnh &amp; TVC</h2>
                    </div>
                    <span class="text-xs font-mono text-slate-400 hidden sm:inline">Trang thiết bị chuẩn Cinema 4K</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <!-- Starter -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col justify-between hover:border-slate-700 transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">GÓI KHỞI NGHIỆP</span>
                            <h3 class="font-headline text-2xl font-bold text-white">Viral Short-form &amp; Reels</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-white">15.000.000</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ / gói 5 video</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Tối ưu cho TikTok, Facebook Reels, YouTube Shorts thu hút tương tác tự nhiên và chuyển đổi nhanh.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> 05 Video ngắn chuẩn 9:16 Full HD/4K</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Kịch bản bắt trend &amp; Hook 3 giây đầu</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Quay 01 buổi studio hoặc ngoại cảnh thực tế</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Phụ đề dynamic &amp; âm nhạc thương mại bản quyền</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Bàn giao file sẵn sàng xuất bản trong 5 ngày</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Short-form Video 15tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-headline text-xs font-bold text-center transition-all">
                            Đăng Ký Gói Khởi Nghiệp
                        </a>
                    </div>

                    <!-- Growth (PRO - Highlighted) -->
                    <div class="p-8 rounded-3xl bg-[#131D38] border-2 border-amber-400/80 shadow-2xl shadow-amber-500/10 flex flex-col justify-between relative transform lg:-translate-y-2">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-amber-400 text-slate-950 font-mono text-[11px] font-extrabold shadow-md uppercase tracking-wider">
                            ★ DOANH NGHIỆP LỰA CHỌN NHIỀU NHẤT
                        </div>
                        <div class="flex flex-col gap-4 pt-2">
                            <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-wider">GÓI TĂNG TRƯỞNG PRO</span>
                            <h3 class="font-headline text-2xl font-bold text-white">Phim Doanh Nghiệp &amp; TVC 4K</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">45.000.000</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ / video</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Nâng tầm vị thế thương hiệu với quy trình tiền kỳ, quay dựng chuẩn điện ảnh 4K ProRes và Flycam không giới hạn.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-700 text-xs text-slate-200">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Phim giới thiệu 3-5 phút chuẩn 4K Cinema</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Dàn máy quay Sony FX Cinema &amp; Lens điện ảnh</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Flycam 4K trên không không giới hạn shot bay</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> MC/Diễn viên chuyên nghiệp &amp; Voiceover đài TH</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Chỉnh màu DaVinci Resolve chuẩn HDR</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Bàn giao toàn bộ source RAW gốc lưu trữ 1 năm</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói TVC Doanh Nghiệp 45tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold text-center shadow-lg shadow-amber-400/20 transition-all">
                            Nhận Kịch Bản &amp; Báo Giá Ngay
                        </a>
                    </div>

                    <!-- Enterprise -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col justify-between hover:border-slate-700 transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">GÓI MASTER ĐIỆN ẢNH</span>
                            <h3 class="font-headline text-2xl font-bold text-white">3D VFX &amp; Mega Campaign</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-white">95.000.000+</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ / dự án</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Chiến dịch truyền thông quy mô lớn, kỹ xảo 3D CGI tinh xảo và đạo diễn danh tiếng trực tiếp chỉ đạo tiền kỳ.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Ekip sản xuất quy mô 20+ nhân sự chuyên nghiệp</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Kỹ xảo 3D CGI / Visual FX chuẩn rạp chiếu</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Hòa âm phối khí độc quyền chuẩn 5.1 Surround</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tổ chức casting diễn viên &amp; bối cảnh chuyên biệt</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Cam kết bảo hiểm tiến độ phát sóng truyền hình</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Mega Campaign 95tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-headline text-xs font-bold text-center transition-all">
                            Liên Hệ Báo Giá Dự Án Lớn
                        </a>
                    </div>
                </div>
            </div>

            <!-- WEB TAB -->
            <div x-show="tab === 'web'" x-transition class="space-y-8" style="display: none;">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <span class="font-mono text-xs font-bold text-amber-400 uppercase">DANH MỤC 02</span>
                        <h2 class="font-headline text-2xl font-bold text-white">Gói Dịch Vụ Thiết Kế Web &amp; Ứng Dụng Số TechLab</h2>
                    </div>
                    <span class="text-xs font-mono text-slate-400 hidden sm:inline">Kiến trúc Clean-code Laravel &amp; WordPress</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <!-- Starter -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col justify-between hover:border-slate-700 transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">GÓI KHỞI ĐỘNG</span>
                            <h3 class="font-headline text-2xl font-bold text-white">Landing Page Chuyển Đổi</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-white">9.500.000</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Tối ưu chuyên sâu cho phễu bán hàng, chạy quảng cáo Google Ads, Meta Ads và TikTok Ads chuyển đổi cao.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Giao diện độc quyền chuẩn UI/UX Responsive</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tốc độ tải trang cực nhanh &lt; 0.8 giây</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tích hợp mã đo lường Meta Pixel, GA4, TikTok Event</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Form thu thập data đẩy thẳng về Google Sheet/Zalo</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Triển khai hoàn tất trong 48 - 72 giờ</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Landing Page 9.5tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-headline text-xs font-bold text-center transition-all">
                            Chọn Gói Landing Page
                        </a>
                    </div>

                    <!-- Growth (PRO - Highlighted) -->
                    <div class="p-8 rounded-3xl bg-[#131D38] border-2 border-amber-400/80 shadow-2xl shadow-amber-500/10 flex flex-col justify-between relative transform lg:-translate-y-2">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-amber-400 text-slate-950 font-mono text-[11px] font-extrabold shadow-md uppercase tracking-wider">
                            ★ KHUYÊN DÙNG CHO DOANH NGHIỆP
                        </div>
                        <div class="flex flex-col gap-4 pt-2">
                            <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-wider">GÓI DOANH NGHIỆP PRO</span>
                            <h3 class="font-headline text-2xl font-bold text-white">Portal &amp; Web Doanh Nghiệp</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">28.000.000</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Website doanh nghiệp cao cấp xây trên Laravel/WordPress hiện đại, bảo mật đa lớp và cấu trúc SEO On-Page tự động.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-700 text-xs text-slate-200">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Thiết kế từ 8 - 15 trang chuẩn nhận diện thương hiệu</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Hệ thống CMS quản trị trực quan đa ngôn ngữ</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Cấu trúc dữ liệu SEO Schema JSON-LD tự động</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tặng Tên miền quốc tế + Hosting NVMe tốc độ cao 1 năm</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Chứng chỉ bảo mật SSL &amp; Tường lửa Cloudflare Pro</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Bảo hành mã nguồn trọn đời dự án</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Web Doanh Nghiệp 28tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold text-center shadow-lg shadow-amber-400/20 transition-all">
                            Tư Vấn Kiến Trúc Web Ngay
                        </a>
                    </div>

                    <!-- Enterprise -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col justify-between hover:border-slate-700 transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">GÓI MAY ĐO NỀN TẢNG</span>
                            <h3 class="font-headline text-2xl font-bold text-white">App Mobile &amp; AI System</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-white">65.000.000+</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Hệ thống ứng dụng di động Flutter (iOS/Android) hoặc nền tảng quản trị ERP/CRM tích hợp trợ lý AI thông minh.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Ứng dụng di động Flutter đa nền tảng iOS &amp; Android</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tích hợp Chatbot AI tư vấn tự động (OpenAI / Claude API)</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Kiến trúc Microservices &amp; API RESTful bảo mật cao</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Hỗ trợ publish ứng dụng lên App Store &amp; Google Play</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Cam kết SLA bảo trì 99.9% uptime</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói App Mobile & AI 65tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-headline text-xs font-bold text-center transition-all">
                            Yêu Cầu Khảo Sát Kỹ Thuật
                        </a>
                    </div>
                </div>
            </div>

            <!-- MARKETING TAB -->
            <div x-show="tab === 'marketing'" x-transition class="space-y-8" style="display: none;">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <span class="font-mono text-xs font-bold text-amber-400 uppercase">DANH MỤC 03</span>
                        <h2 class="font-headline text-2xl font-bold text-white">Gói Dịch Vụ Quảng Cáo &amp; Truyền Thông Số Thực Chiến</h2>
                    </div>
                    <span class="text-xs font-mono text-slate-400 hidden sm:inline">Tối ưu chi phí nhờ tự sản xuất tư liệu hình ảnh</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <!-- Starter -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col justify-between hover:border-slate-700 transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">GÓI KHỞI ĐỘNG ADS</span>
                            <h3 class="font-headline text-2xl font-bold text-white">Quản Trị 1 Kênh Cốt Lõi</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-white">10.000.000</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ / tháng</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Tập trung tối ưu 1 kênh quảng cáo mạnh nhất (Google Search hoặc Meta Ads) để tạo dòng khách hàng đều đặn.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Thiết lập &amp; chuẩn hóa tài khoản quảng cáo chính chủ</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Nghiên cứu bộ từ khóa / đối tượng mục tiêu tiềm năng</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Thiết kế 6-8 mẫu banner tĩnh chuẩn kích thước</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tối ưu tỷ lệ click CTR và giá thầu hàng ngày</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Báo cáo số liệu minh bạch theo tuần</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Quản Trị Ads 1 Kênh 10tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-headline text-xs font-bold text-center transition-all">
                            Chọn Gói 1 Kênh
                        </a>
                    </div>

                    <!-- Growth (PRO - Highlighted) -->
                    <div class="p-8 rounded-3xl bg-[#131D38] border-2 border-amber-400/80 shadow-2xl shadow-amber-500/10 flex flex-col justify-between relative transform lg:-translate-y-2">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-amber-400 text-slate-950 font-mono text-[11px] font-extrabold shadow-md uppercase tracking-wider">
                            ★ HIỆU QUẢ TĂNG TRƯỞNG CAO NHẤT
                        </div>
                        <div class="flex flex-col gap-4 pt-2">
                            <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-wider">GÓI TĂNG TRƯỞNG ĐA KÊNH</span>
                            <h3 class="font-headline text-2xl font-bold text-white">Full-Funnel Growth &amp; Content</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">22.000.000</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ / tháng</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Kết hợp đồng bộ Ads (Google + Meta + TikTok) và sản xuất tư liệu video sáng tạo giúp tối ưu chi phí chuyển đổi.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-700 text-xs text-slate-200">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Quản trị phân bổ ngân sách 3 nền tảng (Google, Meta, TikTok)</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tặng kèm gói quay dựng 04 video ngắn quảng cáo/tháng</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Viết 08 bài chuẩn SEO kéo traffic tự nhiên bền vững</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Thiết lập phễu Retargeting bám đuổi khách hàng</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Dashboard theo dõi số liệu real-time 24/7</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Tăng Trưởng Đa Kênh 22tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold text-center shadow-lg shadow-amber-400/20 transition-all">
                            Nhận Kế Hoạch Tăng Trưởng
                        </a>
                    </div>

                    <!-- Enterprise -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col justify-between hover:border-slate-700 transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">GÓI PHÒNG MARKETING NGOÀI</span>
                            <h3 class="font-headline text-2xl font-bold text-white">Omnichannel Master</h3>
                            <div class="flex items-baseline gap-1.5 my-2">
                                <span class="font-headline text-3xl sm:text-4xl font-black text-white">40.000.000+</span>
                                <span class="text-xs font-mono text-slate-400">VNĐ / tháng</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Thay thế toàn bộ phòng Marketing in-house với đầy đủ Senior Planner, Content Creator, Designer, Media Buyer và Ekip quay dựng.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Giám đốc Marketing (CMO) đồng hành lập chiến lược quý</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Sản xuất không giới hạn tư liệu hình ảnh và video reel</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Triển khai SEO tổng thể phủ sóng hàng ngàn từ khóa ngành</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Booking báo chí và mạng lưới đối tác KOLs/KOCs</li>
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Họp chiến lược định kỳ hàng tuần trực tiếp</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Phòng Marketing Ngoài 40tr']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-headline text-xs font-bold text-center transition-all">
                            Đặt Lịch Họp Chiến Lược
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 3: INTERACTIVE COST ESTIMATOR -->
    <section class="py-12 lg:py-16 bg-[#0B132B]/70 border-b border-slate-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-12 rounded-3xl bg-[#0F172A] border border-amber-400/30 shadow-2xl relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 border-b border-slate-800 pb-8 mb-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 text-amber-400 font-mono text-xs font-bold mb-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                            <span>CÔNG CỤ TỰ ĐỘNG THÔNG MINH</span>
                        </div>
                        <h2 class="font-headline text-2xl sm:text-3xl font-bold text-white">Dự Toán Chi Phí Tức Thời (30 Giây)</h2>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1">Lựa chọn các hạng mục cần thiết để xem chi phí ước tính ngay lập tức.</p>
                    </div>

                    <!-- Estimator Selector -->
                    <div class="flex items-center gap-1.5 bg-slate-900 p-1.5 rounded-2xl border border-slate-800 shrink-0">
                        <button type="button" @click="serviceType = 'tvc'" 
                            :class="serviceType === 'tvc' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all">
                            Sản Xuất TVC
                        </button>
                        <button type="button" @click="serviceType = 'web'" 
                            :class="serviceType === 'web' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all">
                            Lập Trình Web
                        </button>
                        <button type="button" @click="serviceType = 'marketing'" 
                            :class="serviceType === 'marketing' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" 
                            class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all">
                            Quảng Cáo Số
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Controls (7 cols) -->
                    <div class="lg:col-span-7 flex flex-col gap-6">
                        <!-- TVC Controls -->
                        <div x-show="serviceType === 'tvc'" class="space-y-5">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">1. Thời lượng video dự kiến:</label>
                                <select x-model="duration" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="30">30 Giây (TVC Quảng cáo nhanh / Social Hook)</option>
                                    <option value="60">60 Giây (Chuẩn truyền hình / Trailer sự kiện)</option>
                                    <option value="180">3 Phút (Phim giới thiệu năng lực công ty)</option>
                                    <option value="300">5 Phút (Phóng sự tài liệu doanh nghiệp chuyên sâu)</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <input type="checkbox" x-model="drone" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Quay Flycam 4K trên không</p>
                                        <p class="text-slate-400 text-[11px]">+5.000.000 VNĐ</p>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <input type="checkbox" x-model="colorGrading" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Chỉnh màu DaVinci HDR</p>
                                        <p class="text-slate-400 text-[11px]">+4.000.000 VNĐ</p>
                                    </div>
                                </label>
                            </div>

                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">2. Diễn viên &amp; MC Voiceover:</label>
                                <select x-model="actor" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="none">Sử dụng nhân sự nội bộ doanh nghiệp (0 VNĐ)</option>
                                    <option value="pro">Diễn viên &amp; MC đài truyền hình chuyên nghiệp (+12.000.000 VNĐ)</option>
                                    <option value="celeb">KOLs / Gương mặt nổi tiếng ngành (+35.000.000 VNĐ)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Web Controls -->
                        <div x-show="serviceType === 'web'" class="space-y-5" style="display: none;">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">1. Loại hình website / ứng dụng:</label>
                                <select x-model="webType" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="landing">Landing Page Chuyển Đổi Nhanh (9.500.000 VNĐ)</option>
                                    <option value="corp">Website Giới Thiệu Doanh Nghiệp &amp; Portal (28.000.000 VNĐ)</option>
                                    <option value="custom">Nền Tảng App Mobile &amp; Phần Mềm May Đo (65.000.000 VNĐ)</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <input type="checkbox" x-model="aiFeature" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Tích hợp Chatbot AI</p>
                                        <p class="text-slate-400 text-[11px]">+15.000.000 VNĐ</p>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <input type="checkbox" x-model="multiLang" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Đa ngôn ngữ (Anh - Việt)</p>
                                        <p class="text-slate-400 text-[11px]">+6.000.000 VNĐ</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Marketing Controls -->
                        <div x-show="serviceType === 'marketing'" class="space-y-5" style="display: none;">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">1. Quy mô triển khai kênh:</label>
                                <select x-model="mktPlatform" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="single">Tập trung 1 kênh đơn lẻ (10.000.000 VNĐ/tháng)</option>
                                    <option value="multi">Phối hợp đa kênh Google + Meta + TikTok (22.000.000 VNĐ/tháng)</option>
                                    <option value="growth">Phòng Marketing Thuê Ngoài Toàn Diện (40.000.000 VNĐ/tháng)</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-headline text-xs font-bold text-slate-300 mb-2">2. Thời hạn chiến dịch:</label>
                                    <select x-model="mktDuration" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                        <option value="1">1 Tháng (Thử nghiệm)</option>
                                        <option value="3">3 Tháng (Tăng tốc quý - Khuyên dùng)</option>
                                        <option value="6">6 Tháng (Tối ưu dài hạn)</option>
                                    </select>
                                </div>

                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors mt-auto">
                                    <input type="checkbox" x-model="mktVideoAddon" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Sản xuất Video Ads</p>
                                        <p class="text-slate-400 text-[11px]">+8.000.000 VNĐ/tháng</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Result Box (5 cols) -->
                    <div class="lg:col-span-5 p-8 rounded-3xl bg-[#080C16] border border-amber-400/40 flex flex-col items-center text-center gap-4 shadow-xl">
                        <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">TỔNG CHI PHÍ DỰ TOÁN SƠ BỘ</span>
                        <div class="font-headline text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200" x-text="calculateTotal()"></div>
                        <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                            Bao gồm đầy đủ nhân sự kỹ thuật, trang thiết bị tác nghiệp và chế độ bảo hành cam kết SLA theo hợp đồng chính thức.
                        </p>

                        <div class="w-full pt-4 border-t border-slate-800 flex flex-col gap-2.5">
                            <a :href="'{{ route('contact') }}?service=' + encodeURIComponent(serviceType) + '&estimate=' + encodeURIComponent(calculateTotal())" 
                                class="w-full py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold shadow-md shadow-amber-400/20 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[16px]">description</span>
                                <span>Nhận Báo Giá File PDF Chính Thức</span>
                            </a>
                            <a href="https://zalo.me/0947888365" target="_blank" rel="noopener noreferrer" 
                                class="w-full py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white font-headline text-xs font-semibold border border-slate-700 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-sky-400">chat</span>
                                <span>Tư Vấn Nhanh Qua Zalo Trực Tuyến</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: COMPARISON MATRIX -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-400 uppercase">TIÊU CHUẨN SO SÁNH</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">So Sánh Chi Tiết Quyền Lợi Các Gói Dịch Vụ</h2>
            </div>

            <div class="overflow-x-auto rounded-3xl border border-slate-800 bg-[#0F172A] shadow-xl">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="bg-[#0B132B] text-slate-400 font-mono uppercase text-[11px] border-b border-slate-800">
                        <tr>
                            <th class="py-4 px-6 font-bold text-white">Hạng Mục Tiêu Chuẩn</th>
                            <th class="py-4 px-6 text-center">Gói Khởi Nghiệp</th>
                            <th class="py-4 px-6 text-center text-amber-400 font-bold bg-amber-400/5">Gói Tăng Trưởng (PRO)</th>
                            <th class="py-4 px-6 text-center">Gói Doanh Nghiệp (Master)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80">
                        <tr>
                            <td class="py-4 px-6 font-semibold text-white">Khảo sát &amp; Lập kế hoạch tiền kỳ</td>
                            <td class="py-4 px-6 text-center">Online qua Zoom</td>
                            <td class="py-4 px-6 text-center bg-amber-400/5 text-amber-300 font-medium">Trực tiếp tại doanh nghiệp</td>
                            <td class="py-4 px-6 text-center">Trực tiếp + Biên bản giải pháp</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-white">Trang thiết bị tác nghiệp / Tech stack</td>
                            <td class="py-4 px-6 text-center">Máy quay 4K cơ bản</td>
                            <td class="py-4 px-6 text-center bg-amber-400/5 text-amber-300 font-medium">Sony FX Cinema + Flycam 4K</td>
                            <td class="py-4 px-6 text-center">Dàn thiết bị điện ảnh cao cấp</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-white">Bản quyền âm nhạc &amp; Tư liệu</td>
                            <td class="py-4 px-6 text-center">Bản quyền nền tảng số</td>
                            <td class="py-4 px-6 text-center bg-amber-400/5 text-amber-300 font-medium">Thương mại vĩnh viễn</td>
                            <td class="py-4 px-6 text-center">Độc quyền phối âm riêng</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-white">Số lần hiệu chỉnh / Refactor</td>
                            <td class="py-4 px-6 text-center">02 Lần</td>
                            <td class="py-4 px-6 text-center bg-amber-400/5 text-amber-300 font-medium">04 Lần</td>
                            <td class="py-4 px-6 text-center">Không giới hạn theo kịch bản</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-white">Bàn giao file RAW / Toàn bộ Source Code</td>
                            <td class="py-4 px-6 text-center">File thành phẩm</td>
                            <td class="py-4 px-6 text-center bg-amber-400/5 text-amber-300 font-medium">Bàn giao 100% gốc</td>
                            <td class="py-4 px-6 text-center">Bàn giao 100% gốc + Document</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-white">Thời gian bảo hành SLA</td>
                            <td class="py-4 px-6 text-center">03 Tháng</td>
                            <td class="py-4 px-6 text-center bg-amber-400/5 text-amber-300 font-medium">12 Tháng</td>
                            <td class="py-4 px-6 text-center">Trọn đời dự án (24/7)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- SECTION 5: PAYMENT MILESTONES & COMMITMENTS -->
    <section class="py-12 lg:py-16 bg-[#0B132B]/50 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-400 uppercase">CHÍNH SÁCH HỢP ĐỒNG</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">Lộ Trình Thanh Toán Linh Hoạt &amp; Cam Kết</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">40%</span>
                    <h3 class="font-headline text-base font-bold text-white">Đợt 1: Ký Kết Hợp Đồng &amp; Tiền Kỳ</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Khởi động dự án, chốt kịch bản phân cảnh / sơ đồ kiến trúc hệ thống và đặt lịch tác nghiệp ekip hoặc hạ tầng server.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">40%</span>
                    <h3 class="font-headline text-base font-bold text-white">Đợt 2: Nghiệm Thu Bản Dựng Thô / Staging</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Duyệt bản dựng video First Cut hoặc trải nghiệm phiên bản website thử nghiệm trên môi trường kiểm thử chuyên biệt.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">20%</span>
                    <h3 class="font-headline text-base font-bold text-white">Đợt 3: Bàn Giao File Gốc &amp; Go-Live</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Xuất bản video 4K chất lượng cao nhất, trỏ tên miền chính thức, bàn giao toàn bộ mã nguồn và kích hoạt SLA bảo hành.
                    </p>
                </div>
            </div>

            <!-- Commitments banner -->
            <div class="p-6 rounded-3xl bg-slate-900 border border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-300">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-amber-400 text-[24px]">verified_user</span>
                    <span>Xuất hóa đơn giá trị gia tăng (VAT) đầy đủ theo quy định pháp luật.</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-amber-400 text-[24px]">lock_reset</span>
                    <span>Bảo mật 100% tài liệu và chiến dịch theo thỏa thuận NDA.</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-amber-400 text-[24px]">schedule</span>
                    <span>Bồi hoàn nếu chậm trễ tiến độ quá thời hạn SLA cam kết.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: PRICING FAQ -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800" x-data="{ openFaq: 1 }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-400 uppercase">CÂU HỎI THƯỜNG GẶP</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">Giải Đáp Về Chi Phí &amp; Hợp Đồng</h2>
            </div>

            <div class="space-y-4">
                <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 cursor-pointer" @click="openFaq = openFaq === 1 ? 0 : 1">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-white">Bảng giá trên có phát sinh thêm chi phí nào ngoài hợp đồng không?</h3>
                        <span class="material-symbols-outlined text-amber-400 transition-transform duration-200" :class="openFaq === 1 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 1" x-transition class="mt-3 pt-3 border-t border-slate-800 text-xs text-slate-400 leading-relaxed">
                        Tuyệt đối không. Toàn bộ các hạng mục công việc, số lần chỉnh sửa, nhân sự tác nghiệp và bản quyền âm nhạc đều được quy định rõ ràng trong phụ lục hợp đồng. Nếu doanh nghiệp có nhu cầu bổ sung thêm tính năng hoặc thời lượng mới, chúng tôi sẽ lập báo giá chi tiết trước khi thực hiện.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 cursor-pointer" @click="openFaq = openFaq === 2 ? 0 : 2">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-white">Doanh nghiệp của tôi có được bàn giao toàn bộ mã nguồn website và file video gốc không?</h3>
                        <span class="material-symbols-outlined text-amber-400 transition-transform duration-200" :class="openFaq === 2 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 2" x-transition class="mt-3 pt-3 border-t border-slate-800 text-xs text-slate-400 leading-relaxed" style="display: none;">
                        Có, 100%. Sau khi thanh toán đợt cuối, Truyền Thông Cửu Long bàn giao toàn quyền sở hữu trí tuệ: toàn bộ mã nguồn website, tài khoản hosting/domain, cũng như file video render 4K chuẩn và ổ cứng lưu trữ file footage RAW theo yêu cầu.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 cursor-pointer" @click="openFaq = openFaq === 3 ? 0 : 3">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-white">Thời gian từ lúc ký hợp đồng đến khi bàn giao sản phẩm là bao lâu?</h3>
                        <span class="material-symbols-outlined text-amber-400 transition-transform duration-200" :class="openFaq === 3 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 3" x-transition class="mt-3 pt-3 border-t border-slate-800 text-xs text-slate-400 leading-relaxed" style="display: none;">
                        Thời gian trung bình: Landing page từ 48-72 giờ; Website doanh nghiệp từ 10-15 ngày làm việc; Video ngắn TikTok/Reels từ 3-5 ngày; Phim TVC doanh nghiệp 4K từ 15-25 ngày tùy quy mô tiền kỳ và kỹ xảo.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-[#0F172A] border border-slate-800 cursor-pointer" @click="openFaq = openFaq === 4 ? 0 : 4">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-white">Công ty có chính sách chiết khấu khi triển khai trọn gói nhiều dịch vụ không?</h3>
                        <span class="material-symbols-outlined text-amber-400 transition-transform duration-200" :class="openFaq === 4 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 4" x-transition class="mt-3 pt-3 border-t border-slate-800 text-xs text-slate-400 leading-relaxed" style="display: none;">
                        Có. Khi ký kết hợp đồng combo kết hợp (ví dụ: Làm Website Doanh Nghiệp + Sản Xuất TVC Phim Giới Thiệu + Quản Trị Quảng Cáo), khách hàng sẽ được chiết khấu trực tiếp từ 10% đến 20% trên tổng giá trị gói dịch vụ, đồng thời được hỗ trợ chụp ảnh profile ban lãnh đạo miễn phí.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 7: CTA BAND -->
    <section class="py-12 lg:py-16 bg-gradient-to-br from-[#0B132B] via-[#0F172A] to-[#080C16] relative overflow-hidden">
        <div class="absolute inset-0 bg-dot-grid-subtle opacity-15 pointer-events-none"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 text-amber-400 font-mono text-xs font-bold mb-4">
                <span>BÁO GIÁ CHÍNH THỨC TRÌNH BAN GIÁM ĐỐC</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-white mb-4">
                Cần Hồ Sơ Báo Giá Chi Tiết Có Dấu Mộc Đỏ Công Ty?
            </h2>
            <p class="font-body text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed mb-8">
                Gửi yêu cầu ngay để chuyên viên phụ trách của Truyền Thông Cửu Long lập bảng dự toán chi tiết từng đầu việc và gửi đến bạn trong vòng 2 giờ làm việc.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('contact') }}" 
                    class="px-8 py-4 rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-sm font-extrabold shadow-xl shadow-amber-400/20 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">mark_email_read</span>
                    <span>Yêu Cầu Báo Giá Chính Thức</span>
                </a>
                <a href="tel:0947888365" 
                    class="px-8 py-4 rounded-2xl bg-slate-900/90 hover:bg-slate-800 text-white font-headline text-sm font-bold border border-slate-700 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] text-amber-400">call</span>
                    <span>Hotline Trực Ban: 0947.888.365</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- SCHEMA JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Bảng Giá Dịch Vụ & Dự Toán Chi Phí - Truyền Thông Cửu Long",
    "description": "Bảng giá chi phí sản xuất phim TVC quảng cáo 4K, thiết kế web/app chuẩn SEO và quản trị truyền thông số.",
    "url": "{{ route('pricing') }}",
    "provider": {
        "@type": "Organization",
        "name": "Truyền Thông Cửu Long",
        "url": "{{ url('/') }}",
        "telephone": "0947888365",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Cần Thơ",
            "addressCountry": "VN"
        }
    },
    "mainEntity": {
        "@type": "PriceSpecification",
        "priceCurrency": "VND",
        "minPrice": "9500000",
        "maxPrice": "95000000"
    }
}
</script>
@endsection
