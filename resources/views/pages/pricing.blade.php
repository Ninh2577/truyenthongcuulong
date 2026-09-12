@extends('layouts.app')

@section('title', 'Bảng Giá Dịch Vụ & Dự Toán Chi Phí - Truyền Thông Cửu Long')
@section('meta_description', 'Minh bạch quy chuẩn sản xuất phim TVC quảng cáo 4K, thiết kế web/app chuẩn SEO và quản trị truyền thông số. Công cụ tự tính cấu hình dự toán trực tuyến tức thì.')

@section('content')
<div class="w-full selection:bg-amber-500 selection:text-slate-900" x-data="{
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
    aiFeature: false,
    multiLang: false,
    // Marketing options
    mktPlatform: 'multi',
    mktVideoAddon: true,
    mktDuration: '3',

    getEstimatedTier() {
        if (this.serviceType === 'tvc') {
            if (this.actor === 'celeb' || parseInt(this.duration) >= 180) {
                return 'HẠNG MỤC CAO CẤP: MASTER CINEMA CAMPAIGN';
            } else if (this.drone || this.actor === 'pro') {
                return 'HẠNG MỤC TIÊU CHUẨN: TVC DOANH NGHIỆP PRO';
            } else {
                return 'HẠNG MỤC CƠ BẢN: SHORT-FORM & SOCIAL VIRAL';
            }
        } else if (this.serviceType === 'web') {
            if (this.webType === 'custom' || this.aiFeature) {
                return 'HẠNG MỤC CAO CẤP: APP MOBILE & AI SYSTEM';
            } else if (this.webType === 'corp') {
                return 'HẠNG MỤC TIÊU CHUẨN: WEB PORTAL DOANH NGHIỆP';
            } else {
                return 'HẠNG MỤC KHỞI ĐỘNG: LANDING PAGE CHUYỂN ĐỔI';
            }
        } else if (this.serviceType === 'marketing') {
            if (this.mktPlatform === 'growth') {
                return 'HẠNG MỤC CHIẾN LƯỢC: PHÒNG MARKETING THUÊ NGOÀI';
            } else if (this.mktPlatform === 'multi') {
                return 'HẠNG MỤC TĂNG TRƯỞNG: FULL-FUNNEL ĐA KÊNH';
            } else {
                return 'HẠNG MỤC CỐT LÕI: QUẢN TRỊ 1 KÊNH CHUYÊN SÂU';
            }
        }
        return 'TÙY CHỈNH THEO YÊU CẦU RIÊNG';
    },

    getScopeSummary() {
        if (this.serviceType === 'tvc') {
            let durText = this.duration + ' giây';
            if (this.duration === '180') durText = '3 phút giới thiệu';
            if (this.duration === '300') durText = '5 phút phóng sự';
            let extras = [];
            if (this.drone) extras.push('Flycam 4K');
            if (this.colorGrading) extras.push('Chỉnh màu HDR');
            if (this.actor === 'pro') extras.push('MC/Diễn viên PRO');
            if (this.actor === 'celeb') extras.push('KOL/Celeb');
            return `Thời lượng: ${durText} • Phụ trợ: ${extras.join(', ') || 'Cơ bản'}`;
        } else if (this.serviceType === 'web') {
            let typeText = this.webType === 'landing' ? 'Landing Page' : (this.webType === 'corp' ? 'Portal Doanh nghiệp' : 'App Mobile & Phần mềm');
            let extras = [];
            if (this.aiFeature) extras.push('AI Chatbot');
            if (this.multiLang) extras.push('Đa ngôn ngữ');
            return `Quy mô: ${typeText} • Tính năng: ${extras.join(', ') || 'Chuẩn SEO'}`;
        } else if (this.serviceType === 'marketing') {
            let platText = this.mktPlatform === 'single' ? '1 Kênh trọng tâm' : (this.mktPlatform === 'multi' ? 'Google + Meta + TikTok' : 'Omnichannel Toàn diện');
            return `Nền tảng: ${platText} • Thời gian: ${this.mktDuration} tháng • ${this.mktVideoAddon ? 'Kèm quay Video Ads' : 'Banner chuẩn'}`;
        }
        return '';
    }
}">

    <!-- SECTION 1: SMALL HERO (NỀN SÁNG: Surface Low) -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80 overflow-hidden">
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-1/4 w-96 h-96 bg-sky-500/10 blur-3xl pointer-events-none"></div>

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
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-navy-base mb-4">
                    Bảng Giá Minh Bạch &amp; <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber">Dự Toán Tức Thì</span>
                </h1>
                <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
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

    <!-- SECTION 2: TIER PRICING CARDS (NỀN SÁNG) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- TVC TAB -->
            <div x-show="tab === 'tvc'" x-transition class="space-y-8">
                <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                    <div>
                        <span class="font-mono text-xs font-bold text-amber-600 uppercase">DANH MỤC 01</span>
                        <h2 class="font-headline text-2xl font-bold text-navy-base">Gói Dịch Vụ Sản Xuất Video Điện Ảnh &amp; TVC</h2>
                    </div>
                    <span class="text-xs font-mono text-slate-500 hidden sm:inline">Trang thiết bị chuẩn Cinema 4K</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <!-- Starter -->
                    <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-400/40 flex flex-col justify-between transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI KHỞI NGHIỆP</span>
                            <h3 class="font-headline text-2xl font-bold text-navy-base">{{ $videoPlans[0]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">{{ $videoPlans[0]->price_display }}</span>
                                <span class="text-xs font-mono text-amber-600 font-semibold block mt-1">{{ $videoPlans[0]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">Tối ưu cho TikTok, Facebook Reels, YouTube Shorts thu hút tương tác tự nhiên và chuyển đổi nhanh.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-100 text-xs text-slate-700">
                                @foreach($videoPlans[0]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-500 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Short-form Video']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold text-center transition-all shadow-sm">
                            Nhận Báo Giá Gói Khởi Nghiệp
                        </a>
                    </div>

                    <!-- Growth (PRO - Highlighted) -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border-2 border-amber-400 shadow-2xl shadow-amber-500/15 flex flex-col justify-between relative transform lg:-translate-y-2 text-white">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-amber-400 text-slate-950 font-mono text-[11px] font-extrabold shadow-md uppercase tracking-wider">
                            ★ DOANH NGHIỆP LỰA CHỌN NHIỀU NHẤT
                        </div>
                        <div class="flex flex-col gap-4 pt-2">
                            <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-wider">GÓI TĂNG TRƯỞNG PRO</span>
                            <h3 class="font-headline text-2xl font-bold text-white">{{ $videoPlans[1]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">{{ $videoPlans[1]->price_display }}</span>
                                <span class="text-xs font-mono text-slate-300 font-semibold block mt-1">{{ $videoPlans[1]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Nâng tầm vị thế thương hiệu với quy trình tiền kỳ, quay dựng chuẩn điện ảnh 4K ProRes và Flycam không giới hạn.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-700 text-xs text-slate-200">
                                @foreach($videoPlans[1]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói TVC Doanh Nghiệp']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold text-center shadow-lg shadow-amber-400/20 transition-all">
                            Nhận Kịch Bản &amp; Báo Giá Chi Tiết
                        </a>
                    </div>

                    <!-- Enterprise -->
                    <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-400/40 flex flex-col justify-between transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI MASTER ĐIỆN ẢNH</span>
                            <h3 class="font-headline text-2xl font-bold text-navy-base">{{ $videoPlans[2]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">{{ $videoPlans[2]->price_display }}</span>
                                <span class="text-xs font-mono text-amber-600 font-semibold block mt-1">{{ $videoPlans[2]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">Chiến dịch truyền thông quy mô lớn, kỹ xảo 3D CGI tinh xảo và đạo diễn danh tiếng trực tiếp chỉ đạo tiền kỳ.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-100 text-xs text-slate-700">
                                @foreach($videoPlans[2]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-500 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Mega Campaign']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold text-center transition-all shadow-sm">
                            Tư Vấn Giải Pháp Điện Ảnh Riêng
                        </a>
                    </div>
                </div>
            </div>

            <!-- WEB TAB -->
            <div x-show="tab === 'web'" x-transition class="space-y-8" style="display: none;">
                <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                    <div>
                        <span class="font-mono text-xs font-bold text-amber-600 uppercase">DANH MỤC 02</span>
                        <h2 class="font-headline text-2xl font-bold text-navy-base">Gói Dịch Vụ Thiết Kế Web &amp; Ứng Dụng Số TechLab</h2>
                    </div>
                    <span class="text-xs font-mono text-slate-500 hidden sm:inline">Kiến trúc Clean-code Laravel &amp; WordPress</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <!-- Starter -->
                    <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-400/40 flex flex-col justify-between transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI KHỞI ĐỘNG</span>
                            <h3 class="font-headline text-2xl font-bold text-navy-base">{{ $webPlans[0]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">{{ $webPlans[0]->price_display }}</span>
                                <span class="text-xs font-mono text-amber-600 font-semibold block mt-1">{{ $webPlans[0]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">Tối ưu chuyên sâu cho phễu bán hàng, chạy quảng cáo Google Ads, Meta Ads và TikTok Ads chuyển đổi cao.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-100 text-xs text-slate-700">
                                @foreach($webPlans[0]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-500 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Landing Page']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold text-center transition-all shadow-sm">
                            Chọn Gói Landing Page
                        </a>
                    </div>

                    <!-- Growth (PRO - Highlighted) -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border-2 border-amber-400 shadow-2xl shadow-amber-500/15 flex flex-col justify-between relative transform lg:-translate-y-2 text-white">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-amber-400 text-slate-950 font-mono text-[11px] font-extrabold shadow-md uppercase tracking-wider">
                            ★ KHUYÊN DÙNG CHO DOANH NGHIỆP
                        </div>
                        <div class="flex flex-col gap-4 pt-2">
                            <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-wider">GÓI DOANH NGHIỆP PRO</span>
                            <h3 class="font-headline text-2xl font-bold text-white">{{ $webPlans[1]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">{{ $webPlans[1]->price_display }}</span>
                                <span class="text-xs font-mono text-slate-300 font-semibold block mt-1">{{ $webPlans[1]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Website doanh nghiệp cao cấp xây trên Laravel/WordPress hiện đại, bảo mật đa lớp và cấu trúc SEO On-Page tự động.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-700 text-xs text-slate-200">
                                @foreach($webPlans[1]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Web Doanh Nghiệp']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold text-center shadow-lg shadow-amber-400/20 transition-all">
                            Tư Vấn Kiến Trúc Web Ngay
                        </a>
                    </div>

                    <!-- Enterprise -->
                    <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-400/40 flex flex-col justify-between transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI MAY ĐO NỀN TẢNG</span>
                            <h3 class="font-headline text-2xl font-bold text-navy-base">{{ $webPlans[2]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">{{ $webPlans[2]->price_display }}</span>
                                <span class="text-xs font-mono text-amber-600 font-semibold block mt-1">{{ $webPlans[2]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">Hệ thống ứng dụng di động Flutter (iOS/Android) hoặc nền tảng quản trị ERP/CRM tích hợp trợ lý AI thông minh.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-100 text-xs text-slate-700">
                                @foreach($webPlans[2]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-500 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói App Mobile & AI']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold text-center transition-all shadow-sm">
                            Yêu Cầu Khảo Sát Kỹ Thuật
                        </a>
                    </div>
                </div>
            </div>

            <!-- MARKETING TAB -->
            <div x-show="tab === 'marketing'" x-transition class="space-y-8" style="display: none;">
                <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                    <div>
                        <span class="font-mono text-xs font-bold text-amber-600 uppercase">DANH MỤC 03</span>
                        <h2 class="font-headline text-2xl font-bold text-navy-base">Gói Dịch Vụ Quảng Cáo &amp; Truyền Thông Số Thực Chiến</h2>
                    </div>
                    <span class="text-xs font-mono text-slate-500 hidden sm:inline">Tối ưu chi phí nhờ tự sản xuất tư liệu hình ảnh</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <!-- Starter -->
                    <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-400/40 flex flex-col justify-between transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI KHỞI ĐỘNG ADS</span>
                            <h3 class="font-headline text-2xl font-bold text-navy-base">{{ $marketingPlans[0]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">{{ $marketingPlans[0]->price_display }}</span>
                                <span class="text-xs font-mono text-amber-600 font-semibold block mt-1">{{ $marketingPlans[0]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">Tập trung tối ưu 1 kênh quảng cáo mạnh nhất (Google Search hoặc Meta Ads) để tạo dòng khách hàng đều đặn.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-100 text-xs text-slate-700">
                                @foreach($marketingPlans[0]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-500 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Quản Trị Ads 1 Kênh']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold text-center transition-all shadow-sm">
                            Chọn Gói 1 Kênh
                        </a>
                    </div>

                    <!-- Growth (PRO - Highlighted) -->
                    <div class="p-8 rounded-3xl bg-[#0F172A] border-2 border-amber-400 shadow-2xl shadow-amber-500/15 flex flex-col justify-between relative transform lg:-translate-y-2 text-white">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-amber-400 text-slate-950 font-mono text-[11px] font-extrabold shadow-md uppercase tracking-wider">
                            ★ HIỆU QUẢ TĂNG TRƯỞNG CAO NHẤT
                        </div>
                        <div class="flex flex-col gap-4 pt-2">
                            <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-wider">GÓI TĂNG TRƯỞNG ĐA KÊNH</span>
                            <h3 class="font-headline text-2xl font-bold text-white">{{ $marketingPlans[1]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">{{ $marketingPlans[1]->price_display }}</span>
                                <span class="text-xs font-mono text-slate-300 font-semibold block mt-1">{{ $marketingPlans[1]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Kết hợp đồng bộ Ads (Google + Meta + TikTok) và sản xuất tư liệu video sáng tạo giúp tối ưu chi phí chuyển đổi.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-700 text-xs text-slate-200">
                                @foreach($marketingPlans[1]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Tăng Trưởng Đa Kênh']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold text-center shadow-lg shadow-amber-400/20 transition-all">
                            Nhận Kế Hoạch Tăng Trưởng
                        </a>
                    </div>

                    <!-- Enterprise -->
                    <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-400/40 flex flex-col justify-between transition-all">
                        <div class="flex flex-col gap-4">
                            <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI PHÒNG MARKETING NGOÀI</span>
                            <h3 class="font-headline text-2xl font-bold text-navy-base">{{ $marketingPlans[2]->tier_name }}</h3>
                            <div class="my-2">
                                <span class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">{{ $marketingPlans[2]->price_display }}</span>
                                <span class="text-xs font-mono text-amber-600 font-semibold block mt-1">{{ $marketingPlans[2]->price_note }}</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">Thay thế toàn bộ phòng Marketing in-house với đầy đủ Senior Planner, Content Creator, Designer, Media Buyer và Ekip quay dựng.</p>
                            <ul class="space-y-3 pt-6 border-t border-slate-100 text-xs text-slate-700">
                                @foreach($marketingPlans[2]->features as $feature)
                                <li class="flex items-center gap-2.5"><span class="text-amber-500 font-bold">✓</span> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('contact', ['service' => 'Gói Phòng Marketing Ngoài']) }}" 
                            class="mt-8 py-3.5 w-full rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold text-center transition-all shadow-sm">
                            Đặt Lịch Họp Chiến Lược
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 3: INTERACTIVE COST ESTIMATOR (NỀN SÁNG, FORM TỐI) -->
    <section class="relative py-12 lg:py-16 bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80 overflow-hidden">
        <!-- Ambient Glow -->
        <div class="absolute -top-24 right-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-10 w-96 h-96 rounded-full bg-sky-500/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="p-8 sm:p-12 rounded-3xl bg-[#0F172A] border border-amber-400/30 shadow-2xl relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 border-b border-slate-800 pb-8 mb-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 text-amber-400 font-mono text-xs font-bold mb-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                            <span>CÔNG CỤ TỰ ĐỘNG THÔNG MINH</span>
                        </div>
                        <h2 class="font-headline text-2xl sm:text-3xl font-bold text-white">Dự Toán Quy Mô Dự Án Tức Thời</h2>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1">Lựa chọn cấu hình mong muốn để hệ thống phân loại cấp độ dự toán sơ bộ.</p>
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
                                        <p class="text-slate-400 text-[11px]">Tùy chọn bổ sung</p>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <input type="checkbox" x-model="colorGrading" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Chỉnh màu DaVinci HDR</p>
                                        <p class="text-slate-400 text-[11px]">Chuẩn rạp chiếu</p>
                                    </div>
                                </label>
                            </div>

                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">2. Diễn viên &amp; MC Voiceover:</label>
                                <select x-model="actor" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="none">Sử dụng nhân sự nội bộ doanh nghiệp</option>
                                    <option value="pro">Diễn viên &amp; MC đài truyền hình chuyên nghiệp</option>
                                    <option value="celeb">KOLs / Gương mặt đại sứ thương hiệu</option>
                                </select>
                            </div>
                        </div>

                        <!-- Web Controls -->
                        <div x-show="serviceType === 'web'" class="space-y-5" style="display: none;">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">1. Loại hình website / ứng dụng:</label>
                                <select x-model="webType" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="landing">Landing Page Chuyển Đổi Nhanh</option>
                                    <option value="corp">Website Giới Thiệu Doanh Nghiệp &amp; Portal</option>
                                    <option value="custom">Nền Tảng App Mobile &amp; Phần Mềm May Đo</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <input type="checkbox" x-model="aiFeature" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Tích hợp Chatbot AI</p>
                                        <p class="text-slate-400 text-[11px]">Tự động hóa tư vấn</p>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <input type="checkbox" x-model="multiLang" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Đa ngôn ngữ (Anh - Việt)</p>
                                        <p class="text-slate-400 text-[11px]">Thị trường quốc tế</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Marketing Controls -->
                        <div x-show="serviceType === 'marketing'" class="space-y-5" style="display: none;">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">1. Quy mô triển khai kênh:</label>
                                <select x-model="mktPlatform" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="single">Tập trung 1 kênh đơn lẻ (Google hoặc Meta Ads)</option>
                                    <option value="multi">Phối hợp đa kênh Google + Meta + TikTok</option>
                                    <option value="growth">Phòng Marketing Thuê Ngoài Toàn Diện (Omnichannel)</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-headline text-xs font-bold text-slate-300 mb-2">2. Thời hạn chiến dịch:</label>
                                    <select x-model="mktDuration" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                        <option value="1">1 Tháng (Thử nghiệm hiệu quả)</option>
                                        <option value="3">3 Tháng (Tăng tốc quý - Khuyên dùng)</option>
                                        <option value="6">6 Tháng (Tối ưu tăng trưởng bền vững)</option>
                                    </select>
                                </div>

                                <label class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors mt-auto">
                                    <input type="checkbox" x-model="mktVideoAddon" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                    <div class="text-xs">
                                        <p class="font-bold text-white">Sản xuất Video Ads</p>
                                        <p class="text-slate-400 text-[11px]">Tư liệu quay dựng riêng</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Result Box (5 cols) -->
                    <div class="lg:col-span-5 p-8 rounded-3xl bg-[#080C16] border border-amber-400/40 flex flex-col items-center text-center gap-4 shadow-xl">
                        <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">KẾT QUẢ PHÂN TÍCH CẤU HÌNH</span>
                        <div class="font-headline text-lg sm:text-xl font-bold text-white" x-text="getEstimatedTier()"></div>
                        <div class="p-3 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-300 w-full" x-text="getScopeSummary()"></div>
                        
                        <div class="py-1">
                            <span class="text-[11px] font-mono text-amber-400 font-bold uppercase">CHÍNH SÁCH BÁO GIÁ</span>
                            <p class="font-headline text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200 mt-1">
                                Tùy Chỉnh Theo Dự Toán
                            </p>
                        </div>
                        
                        <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                            Đội ngũ chuyên gia CLM sẽ lập bảng chiết tính chi tiết từng đầu việc theo đúng ngân sách doanh nghiệp và gửi trong 2 giờ.
                        </p>

                        <div class="w-full pt-4 border-t border-slate-800 flex flex-col gap-2.5">
                            <a :href="'{{ route('contact') }}?service=' + encodeURIComponent(serviceType) + '&scope=' + encodeURIComponent(getScopeSummary())" 
                                class="w-full py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold shadow-md shadow-amber-400/20 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[16px]">description</span>
                                <span>Nhận Báo Giá Dự Toán Chi Tiết (PDF)</span>
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

    <!-- SECTION 4: COMPARISON MATRIX (NỀN SÁNG) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-600 uppercase">TIÊU CHUẨN SO SÁNH</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base mt-1">So Sánh Chi Tiết Quyền Lợi Các Cấp Độ Dịch Vụ</h2>
            </div>

            <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-50 text-slate-600 font-mono uppercase text-[11px] border-b border-slate-200">
                        <tr>
                            <th class="py-4 px-6 font-bold text-navy-base">Hạng Mục Tiêu Chuẩn</th>
                            <th class="py-4 px-6 text-center text-slate-600 font-bold">Gói Khởi Nghiệp</th>
                            <th class="py-4 px-6 text-center text-amber-700 font-bold bg-amber-50/70 border-x border-amber-100">Gói Tăng Trưởng (PRO)</th>
                            <th class="py-4 px-6 text-center text-slate-600 font-bold">Gói Doanh Nghiệp (Master)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="py-4 px-6 font-semibold text-navy-base">Khảo sát &amp; Lập kế hoạch tiền kỳ</td>
                            <td class="py-4 px-6 text-center text-slate-600">Online qua Zoom</td>
                            <td class="py-4 px-6 text-center bg-amber-50/50 text-amber-800 font-semibold border-x border-amber-100/60">Trực tiếp tại doanh nghiệp</td>
                            <td class="py-4 px-6 text-center text-slate-600">Trực tiếp + Biên bản giải pháp</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-navy-base">Trang thiết bị tác nghiệp / Tech stack</td>
                            <td class="py-4 px-6 text-center text-slate-600">Máy quay 4K cơ bản</td>
                            <td class="py-4 px-6 text-center bg-amber-50/50 text-amber-800 font-semibold border-x border-amber-100/60">Sony FX Cinema + Flycam 4K</td>
                            <td class="py-4 px-6 text-center text-slate-600">Dàn thiết bị điện ảnh cao cấp</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-navy-base">Bản quyền âm nhạc &amp; Tư liệu</td>
                            <td class="py-4 px-6 text-center text-slate-600">Bản quyền nền tảng số</td>
                            <td class="py-4 px-6 text-center bg-amber-50/50 text-amber-800 font-semibold border-x border-amber-100/60">Thương mại vĩnh viễn</td>
                            <td class="py-4 px-6 text-center text-slate-600">Độc quyền phối âm riêng</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-navy-base">Số lần hiệu chỉnh / Refactor</td>
                            <td class="py-4 px-6 text-center text-slate-600">02 Lần</td>
                            <td class="py-4 px-6 text-center bg-amber-50/50 text-amber-800 font-semibold border-x border-amber-100/60">04 Lần</td>
                            <td class="py-4 px-6 text-center text-slate-600">Không giới hạn theo kịch bản</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-navy-base">Bàn giao file RAW / Toàn bộ Source Code</td>
                            <td class="py-4 px-6 text-center text-slate-600">File thành phẩm</td>
                            <td class="py-4 px-6 text-center bg-amber-50/50 text-amber-800 font-semibold border-x border-amber-100/60">Bàn giao 100% gốc</td>
                            <td class="py-4 px-6 text-center text-slate-600">Bàn giao 100% gốc + Document</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-semibold text-navy-base">Thời gian bảo hành SLA</td>
                            <td class="py-4 px-6 text-center text-slate-600">03 Tháng</td>
                            <td class="py-4 px-6 text-center bg-amber-50/50 text-amber-800 font-semibold border-x border-amber-100/60">12 Tháng</td>
                            <td class="py-4 px-6 text-center text-slate-600">Trọn đời dự án (24/7)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- SECTION 5: PAYMENT MILESTONES & COMMITMENTS -->
    <section class="relative py-12 lg:py-16 bg-[#080C16] bg-dot-grid-dark border-b border-slate-800 text-white overflow-hidden" style="background-color: #080C16 !important;">
        <!-- Ambient Glow -->
        <div class="absolute -top-24 right-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-10 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
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

    <!-- SECTION 6: PRICING FAQ (NỀN SÁNG) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80" x-data="{ openFaq: 1 }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-600 uppercase">CÂU HỎI THƯỜNG GẶP</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base mt-1">Giải Đáp Về Chi Phí &amp; Hợp Đồng</h2>
            </div>

            <div class="space-y-4">
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/50 transition-colors cursor-pointer" @click="openFaq = openFaq === 1 ? 0 : 1">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-navy-base">Chính sách báo giá của Truyền Thông Cửu Long được tính toán như thế nào?</h3>
                        <span class="material-symbols-outlined text-amber-500 transition-transform duration-200" :class="openFaq === 1 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 1" x-transition class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-600 leading-relaxed">
                        Chúng tôi áp dụng mô hình định giá linh hoạt theo đúng quy mô và yêu cầu thực tế của từng doanh nghiệp, tránh việc đóng khung giá cứng nhắc gây lãng phí ngân sách. Toàn bộ các hạng mục công việc, số buổi tác nghiệp, số lần chỉnh sửa và bảo hành đều được quy định rõ ràng trong phụ lục hợp đồng, tuyệt đối không có chi phí ẩn.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/50 transition-colors cursor-pointer" @click="openFaq = openFaq === 2 ? 0 : 2">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-navy-base">Doanh nghiệp của tôi có được bàn giao toàn bộ mã nguồn website và file video gốc không?</h3>
                        <span class="material-symbols-outlined text-amber-500 transition-transform duration-200" :class="openFaq === 2 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 2" x-transition class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-600 leading-relaxed" style="display: none;">
                        Có, 100%. Sau khi thanh toán đợt cuối, Truyền Thông Cửu Long bàn giao toàn quyền sở hữu trí tuệ: toàn bộ mã nguồn website, tài khoản hosting/domain, cũng như file video render 4K chuẩn và ổ cứng lưu trữ file footage RAW theo yêu cầu.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/50 transition-colors cursor-pointer" @click="openFaq = openFaq === 3 ? 0 : 3">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-navy-base">Thời gian từ lúc ký hợp đồng đến khi bàn giao sản phẩm là bao lâu?</h3>
                        <span class="material-symbols-outlined text-amber-500 transition-transform duration-200" :class="openFaq === 3 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 3" x-transition class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-600 leading-relaxed" style="display: none;">
                        Thời gian trung bình: Landing page từ 48-72 giờ; Website doanh nghiệp từ 10-15 ngày làm việc; Video ngắn TikTok/Reels từ 3-5 ngày; Phim TVC doanh nghiệp 4K từ 15-25 ngày tùy quy mô tiền kỳ và kỹ xảo.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/50 transition-colors cursor-pointer" @click="openFaq = openFaq === 4 ? 0 : 4">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="font-headline text-sm font-bold text-navy-base">Công ty có chính sách chiết khấu khi triển khai trọn gói nhiều dịch vụ không?</h3>
                        <span class="material-symbols-outlined text-amber-500 transition-transform duration-200" :class="openFaq === 4 ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <div x-show="openFaq === 4" x-transition class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-600 leading-relaxed" style="display: none;">
                        Có. Khi ký kết hợp đồng combo kết hợp (ví dụ: Làm Website Doanh Nghiệp + Sản Xuất TVC Phim Giới Thiệu + Quản Trị Quảng Cáo), khách hàng sẽ được chiết khấu trực tiếp từ 10% đến 20% trên tổng giá trị gói dịch vụ, đồng thời được hỗ trợ chụp ảnh profile ban lãnh đạo miễn phí.
                    </div>
                </div>
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
    "description": "Báo giá may đo sản xuất phim TVC quảng cáo 4K, thiết kế web/app chuẩn SEO và quản trị truyền thông số theo quy mô doanh nghiệp.",
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
    }
}
</script>
@endsection
