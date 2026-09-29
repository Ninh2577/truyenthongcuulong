@extends('layouts.app')

@section('title', 'Tối Ưu SEO & Tăng Trưởng Kênh Tìm Kiếm - Truyền Thông Cửu Long')
@section('meta_description', 'Giải pháp tối ưu SEO kỹ thuật on-page, cấu trúc nội dung tìm kiếm và thiết lập chiến dịch quảng cáo có đo lường giúp website tiếp cận đúng khách hàng mục tiêu.')

@section('content')
<!-- ==================== HERO SECTION (GLOBAL BANNER HERO) ==================== -->
<x-banner.hero
    variant="service-split"
    eyebrow="TECHNICAL SEO • DATA-DRIVEN GROWTH • CHUYỂN ĐỔI SỐ"
    title="Chiến Lược Tối Ưu SEO & Kênh Tiếp Cận Khách Hàng"
    titleAccent="Dựa Trên Dữ Liệu Thực Tế"
    description="Dịch vụ bổ trợ chuyên sâu cho hệ thống website: chuẩn hóa kỹ thuật On-page, cấu trúc nội dung theo ý định tìm kiếm thực tế và kết nối công cụ đo lường chuyển đổi minh bạch."
    :breadcrumb="[
        ['label' => 'Dịch vụ & Giải pháp', 'url' => route('services.index')],
        ['label' => 'Tối ưu SEO & Tăng trưởng số']
    ]"
    :primaryCta="[
        'label' => 'Bắt đầu dự án',
        'url' => route('contact'),
        'icon' => 'arrow_forward'
    ]"
    :secondaryCta="[
        'label' => 'Xem lộ trình tăng trưởng',
        'url' => '#growth-path',
        'icon' => 'arrow_downward'
    ]"
    class="!pt-24 !pb-8 lg:!pt-28 lg:!pb-10"
>
    <!-- Visual Showcase Slot: Google Search Console & Growth Performance Dashboard Mockup -->
    <div class="relative w-full">
        <div class="relative w-full overflow-hidden rounded-2xl bg-[#070f1e] border border-slate-700/80 shadow-2xl shadow-navy-base/30 p-5 sm:p-7 text-white font-mono space-y-4">
            <!-- Terminal Header -->
            <div class="flex items-center justify-between border-b border-slate-800 pb-3 text-xs sm:text-sm">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                    <span class="text-slate-300 ml-1 font-semibold text-xs sm:text-sm">search.google.com/console • Verified</span>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>LIVE PERFORMANCE</span>
                </div>
            </div>

            <!-- Top 4 Growth KPI Metrics -->
            <div class="grid grid-cols-2 gap-2.5">
                <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                    <div class="text-[11px] text-slate-400">Lượt hiển thị (Impressions)</div>
                    <div class="text-base sm:text-lg font-bold text-emerald-400 font-mono flex items-center gap-1">
                        <span>+185%</span>
                        <span class="material-symbols-outlined text-[16px]">trending_up</span>
                    </div>
                    <div class="text-[10px] text-slate-500 mt-0.5">380,500 lượt tìm kiếm</div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                    <div class="text-[11px] text-slate-400">Click tự nhiên (Organic)</div>
                    <div class="text-base sm:text-lg font-bold text-sky-400 font-mono flex items-center gap-1">
                        <span>+142%</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_upward</span>
                    </div>
                    <div class="text-[10px] text-slate-500 mt-0.5">32,480 lượt truy cập/tháng</div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                    <div class="text-[11px] text-slate-400">Core Web Vitals</div>
                    <div class="text-base sm:text-lg font-bold text-amber-400 font-mono">98/100</div>
                    <div class="text-[10px] text-emerald-400 mt-0.5">Tốc độ tải dưới 1.5s</div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                    <div class="text-[11px] text-slate-400">Chuyển đổi (CRO)</div>
                    <div class="text-base sm:text-lg font-bold text-primary font-mono">+38%</div>
                    <div class="text-[10px] text-slate-500 mt-0.5">Cuộc gọi &amp; Form liên hệ</div>
                </div>
            </div>

            <!-- Simulated SVG Organic Traffic Wave Graph -->
            <div class="p-3.5 rounded-xl bg-slate-900/90 border border-slate-800 space-y-2">
                <div class="flex items-center justify-between text-xs text-slate-400">
                    <span class="text-slate-300 font-semibold">Đà Tăng Trưởng Lượng Truy Cập 6 Tháng</span>
                    <span class="text-emerald-400 font-bold">XU HƯỚNG TĂNG BỀN VỮNG</span>
                </div>
                <div class="h-16 w-full flex items-end pt-2">
                    <svg class="w-full h-full overflow-visible" viewBox="0 0 300 60" fill="none">
                        <defs>
                            <linearGradient id="growthGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#10b981" stop-opacity="0.35"/>
                                <stop offset="100%" stop-color="#10b981" stop-opacity="0.0"/>
                            </linearGradient>
                        </defs>
                        <path d="M0,52 C40,48 80,44 120,32 C160,24 200,18 240,10 C270,5 290,2 300,2 L300,60 L0,60 Z" fill="url(#growthGrad)"/>
                        <path d="M0,52 C40,48 80,44 120,32 C160,24 200,18 240,10 C270,5 290,2 300,2" stroke="#10b981" stroke-width="2.5" stroke-linecap="round"/>
                        <circle cx="300" cy="2" r="3.5" fill="#10b981" />
                    </svg>
                </div>
                <div class="flex justify-between text-[10px] text-slate-500 pt-1 font-mono">
                    <span>Tháng 1</span>
                    <span>Tháng 2</span>
                    <span>Tháng 3</span>
                    <span>Tháng 4</span>
                    <span>Tháng 5</span>
                    <span class="text-emerald-400 font-bold">Tháng 6</span>
                </div>
            </div>

            <!-- Mini Keyword Ranking Strip -->
            <div class="space-y-1.5 text-xs pt-1">
                <div class="p-2 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-between text-[11px]">
                    <span class="text-slate-300 font-mono truncate">phòng khám uy tín cần thơ</span>
                    <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-bold font-mono text-[10px]">Top #1 Google</span>
                </div>
                <div class="p-2 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-between text-[11px]">
                    <span class="text-slate-300 font-mono truncate">nha khoa thẩm mỹ răng sứ</span>
                    <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-bold font-mono text-[10px]">Top #1 Google</span>
                </div>
            </div>
        </div>

        <!-- Floating Badge -->
        <div class="absolute bottom-4 right-3 sm:bottom-5 sm:-right-4 px-4 py-2.5 rounded-xl bg-white border border-slate-200/90 shadow-xl hidden sm:flex items-center gap-3 text-slate-900 z-10 font-sans">
            <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">verified</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs sm:text-sm font-bold leading-tight">Dữ liệu thực tế</span>
                <span class="text-xs text-slate-500">Giảm 60% chi phí thầu Ads</span>
            </div>
        </div>
    </div>
</x-banner.hero>

<!-- ==================== BODY CONTENT CONTAINER ==================== -->
<div class="w-full bg-[#f8f9ff] py-14 lg:py-20" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-14 lg:gap-20">

        <!-- ==================== BÀI TOÁN TĂNG TRƯỞNG & HÀNH TRÌNH ==================== -->
        <section id="growth-path" class="flex flex-col gap-8 scroll-mt-28">
            <div class="border-b border-slate-200 pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                <div class="space-y-1.5">
                    <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">HÀNH TRÌNH GIẢI QUYẾT BÀI TOÁN</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight">
                        Từ Hiện Trạng Đến Kênh Tiếp Cận Khách Hàng Bền Vững
                    </h2>
                </div>
                <p class="text-sm sm:text-base text-slate-600 max-w-md leading-relaxed">
                    Phương pháp tiếp cận dựa trên dữ liệu kỹ thuật chuẩn xác, tạo dựng tài sản số tự sinh ra khách hàng tiềm năng.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-5">
                <!-- Initial Problem -->
                <div class="p-6 rounded-2xl bg-white border border-rose-200/80 shadow-xs space-y-2.5 flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-bold font-mono text-rose-600 uppercase tracking-wider block">VẤN ĐỀ ĐẦU TIÊN</span>
                        <h3 class="text-base sm:text-lg font-bold text-[#070f1e]">Thiếu Lượt Truy Cập</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Website không xuất hiện khi khách hàng tìm kiếm từ khóa ngành nghề, thiếu khách hàng tiềm năng.</p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-rose-600 flex items-center gap-1">
                        <span>Đốt tiền quảng cáo ngắn hạn</span>
                    </div>
                </div>

                <!-- Step 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-2.5 flex flex-col justify-between hover:border-primary/40 transition-colors">
                    <div class="space-y-2">
                        <span class="text-xs font-bold font-mono text-slate-400 block uppercase tracking-wider">BƯỚC 01</span>
                        <h3 class="text-base sm:text-lg font-bold text-[#070f1e]">Search Visibility</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Rà soát chỉ mục, khai báo sitemap XML, cấu hình robots.txt và kiểm tra khả năng lập chỉ mục trên Google.</p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-primary flex items-center gap-1">
                        <span>Khai báo thực thể Google</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-2.5 flex flex-col justify-between hover:border-emerald-400 transition-colors">
                    <div class="space-y-2">
                        <span class="text-xs font-bold font-mono text-slate-400 block uppercase tracking-wider">BƯỚC 02</span>
                        <h3 class="text-base sm:text-lg font-bold text-[#070f1e]">Technical SEO</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Chuẩn hóa cấu trúc HTML5, thẻ tiêu đề H1/H2, dữ liệu có cấu trúc Schema JSON-LD và tối ưu Core Web Vitals.</p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-emerald-600 flex items-center gap-1">
                        <span>Tốc độ tải dưới 1.5s</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-2.5 flex flex-col justify-between hover:border-indigo-400 transition-colors">
                    <div class="space-y-2">
                        <span class="text-xs font-bold font-mono text-slate-400 block uppercase tracking-wider">BƯỚC 03</span>
                        <h3 class="text-base sm:text-lg font-bold text-[#070f1e]">Cấu Trúc &amp; Nội Dung</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Xây dựng cụm chủ đề chuyên môn bám sát ý định tìm kiếm thực tế của người dùng có nhu cầu sử dụng dịch vụ.</p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-indigo-600 flex items-center gap-1">
                        <span>Cụm bài viết chuyển đổi</span>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-2.5 flex flex-col justify-between hover:border-sky-400 transition-colors">
                    <div class="space-y-2">
                        <span class="text-xs font-bold font-mono text-slate-400 block uppercase tracking-wider">BƯỚC 04</span>
                        <h3 class="text-base sm:text-lg font-bold text-[#070f1e]">Đo Lường &amp; Tinh Chỉnh</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Gắn thẻ theo dõi chuyển đổi (GA4, Search Console) để đánh giá nguồn truy cập và điều chỉnh chiến lược.</p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-sky-600 flex items-center gap-1">
                        <span>Minh bạch 100% dữ liệu</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== PHẠM VI NỘI DUNG DỊCH VỤ ==================== -->
        <section class="flex flex-col gap-8">
            <div class="border-b border-slate-200 pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                <div class="space-y-1.5">
                    <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">PHẠM VI TRIỂN KHAI</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight">
                        Nội Dung Dịch Vụ SEO &amp; Truyền Thông Số
                    </h2>
                </div>
                <p class="text-sm sm:text-base text-slate-600 max-w-md leading-relaxed">
                    Hỗ trợ kỹ thuật chuyên sâu &amp; tăng trưởng bền vững cho mọi website doanh nghiệp.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Service 1 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all space-y-3.5 group flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-11 h-11 rounded-xl bg-orange-50 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[22px]">build</span>
                            </div>
                            <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-primary transition-colors">01</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-primary transition-colors">
                            Chuẩn Hóa SEO Kỹ Thuật (Technical SEO)
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Tối ưu cấu trúc URL thân thiện, thẻ canonical tránh trùng lặp nội dung, tối ưu dung lượng hình ảnh WebP và bổ sung schema tổ chức theo chuẩn Schema.org.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-primary">
                        <span>Cam kết chuẩn Google Core Web Vitals</span>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-500/40 hover:shadow-md transition-all space-y-3.5 group flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[22px]">manage_search</span>
                            </div>
                            <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-emerald-600 transition-colors">02</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-emerald-600 transition-colors">
                            Nghiên Cứu Từ Khóa &amp; Ý Định Tìm Kiếm
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Khảo sát các cụm từ tìm kiếm thực tế của khách hàng trong ngành nghề, phân loại theo nhu cầu tìm hiểu thông tin và nhu cầu chuyển đổi sử dụng dịch vụ.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-emerald-600">
                        <span>Nhắm đúng tệp khách có nhu cầu mua</span>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-indigo-500/40 hover:shadow-md transition-all space-y-3.5 group flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[22px]">ads_click</span>
                            </div>
                            <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-indigo-600 transition-colors">03</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-indigo-600 transition-colors">
                            Quảng Cáo Google Search Theo Mục Tiêu
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Thiết lập chiến dịch tìm kiếm đúng từ khóa mục tiêu, cài đặt từ khóa phủ định để tránh lãng phí ngân sách và viết thông điệp bám sát trang đích.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-indigo-600">
                        <span>Tối ưu điểm chất lượng Quality Score</span>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-500/40 hover:shadow-md transition-all space-y-3.5 group flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[22px]">article</span>
                            </div>
                            <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-amber-600 transition-colors">04</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-amber-600 transition-colors">
                            Content Chuyên Ngành &amp; Landing Page
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Xây dựng nội dung bài viết chuyên sâu có giá trị nghiệp vụ, tối ưu cấu trúc các khối thông tin trên Landing Page nhằm nâng cao tỷ lệ khách liên hệ.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-amber-600">
                        <span>Cấu trúc E-E-A-T chuẩn Google</span>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-500/40 hover:shadow-md transition-all space-y-3.5 group flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[22px]">query_stats</span>
                            </div>
                            <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-sky-600 transition-colors">05</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-sky-600 transition-colors">
                            Đo Lường GA4 &amp; Search Console
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Cài đặt Google Analytics 4, liên kết Search Console, theo dõi sự kiện bấm gọi/gửi form và gửi báo cáo định kỳ minh bạch về nguồn truy cập.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-sky-600">
                        <span>Báo cáo minh bạch từng cuộc gọi</span>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-purple-500/40 hover:shadow-md transition-all space-y-3.5 group flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[22px]">video_library</span>
                            </div>
                            <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-purple-600 transition-colors">06</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-purple-600 transition-colors">
                            Tư Liệu Media Thực Tế Hỗ Trợ
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Sử dụng hình ảnh và video tư liệu chân thực từ ekip của Cửu Long để minh họa cho nội dung, tăng độ tin cậy của doanh nghiệp khi người dùng truy cập.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs font-bold text-purple-600">
                        <span>Hình ảnh bản quyền &bull; Độ nét 4K</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== BẢNG SO SÁNH: SEO BỀN VỮNG VS CHẠY ADS THUẦN TÚY ==================== -->
        <section class="space-y-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">HIỆU QUẢ ĐẦU TƯ</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight mt-1">
                        So Sánh Chiến Lược: SEO Kỹ Thuật vs Chạy Ads Thuần Túy
                    </h2>
                </div>
                <span class="text-xs sm:text-sm text-slate-500">Định hình chiến lược phát triển tài sản số</span>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full text-left text-sm sm:text-base">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-800 font-bold">
                            <th class="p-4 sm:p-5 w-1/4">Tiêu chí so sánh</th>
                            <th class="p-4 sm:p-5 w-3/8 text-rose-700 bg-rose-50/50">Quảng cáo trả tiền thuần túy (Paid Ads)</th>
                            <th class="p-4 sm:p-5 w-3/8 text-emerald-800 bg-emerald-50/70">SEO Kỹ Thuật &amp; Tăng Trưởng Số Cửu Long</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <tr>
                            <td class="p-4 sm:p-5 font-bold text-slate-900">Chi phí theo thời gian</td>
                            <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Chi phí ngày càng tăng do cạnh tranh giá thầu từ khóa khốc liệt.</td>
                            <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Chi phí duy trì ổn định, chi phí trên mỗi khách hàng tiềm năng giảm dần theo thời gian.</td>
                        </tr>
                        <tr>
                            <td class="p-4 sm:p-5 font-bold text-slate-900">Khi dừng nạp ngân sách</td>
                            <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Ngừng nạp tiền là lượng khách hàng và lượt truy cập lập tức về số 0.</td>
                            <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Thứ hạng và traffic tự nhiên vẫn tiếp tục duy trì và mang về khách hàng đều đặn.</td>
                        </tr>
                        <tr>
                            <td class="p-4 sm:p-5 font-bold text-slate-900">Mức độ tin cậy từ khách</td>
                            <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Khách hàng thường có xu hướng bỏ qua hoặc dè chừng các kết quả có nhãn "Được tài trợ".</td>
                            <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Kết quả tìm kiếm tự nhiên được người dùng tin tưởng cao hơn gấp 3 lần.</td>
                        </tr>
                        <tr>
                            <td class="p-4 sm:p-5 font-bold text-slate-900">Rủi ro nền tảng</td>
                            <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Thường xuyên đối mặt với việc tài khoản quảng cáo bị hạn chế hoặc bị quét vi phạm.</td>
                            <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">An toàn tuyệt đối, xây dựng bền vững trên chính tài sản website sở hữu của doanh nghiệp.</td>
                        </tr>
                        <tr>
                            <td class="p-4 sm:p-5 font-bold text-slate-900">Giá trị tài sản số</td>
                            <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Chỉ là chi phí tiêu hao hàng tháng, không để lại giá trị thặng dư.</td>
                            <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Website trở thành tài sản số uy tín cao, giá trị thương hiệu gia tăng vững chắc trên Google.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ==================== MINH CHỨNG KHÁCH HÀNG THỰC TẾ ==================== -->
        <section class="space-y-6">
            <div class="border-b border-slate-200 pb-3 flex items-center justify-between">
                <div>
                    <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">CASE STUDY THỰC TẾ</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight mt-1">
                        Dự Án Tăng Trưởng SEO &amp; Chuyển Đổi Tiêu Biểu
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Case Study 1 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded bg-teal-100 text-teal-800 text-xs font-bold uppercase font-mono">Y TẾ &amp; PHÒNG KHÁM</span>
                        <span class="text-xs sm:text-sm text-slate-500 font-mono">Top 1–3 Ngành Y Tế</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-[#070f1e]">Phòng Khám Đa Khoa Gia Phước</h3>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        Tối ưu Technical SEO chuẩn hóa cấu trúc chuyên khoa, tối ưu Core Web Vitals và xây dựng cụm bài viết y khoa chuẩn mực E-E-A-T tại khu vực Cần Thơ &amp; các tỉnh Miền Tây.
                    </p>
                    <div class="flex items-center gap-4 text-sm font-semibold text-slate-700 pt-3 border-t border-slate-100">
                        <span>Kết quả: <strong class="text-emerald-700">Tăng 120%</strong> cuộc gọi đặt hẹn tự nhiên qua website.</span>
                    </div>
                </div>

                <!-- Case Study 2 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded bg-indigo-100 text-indigo-800 text-xs font-bold uppercase font-mono">NHA KHOA THẨM MỸ</span>
                        <span class="text-xs sm:text-sm text-slate-500 font-mono">Local SEO &amp; Bán Kính 10km</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-[#070f1e]">Nha Khoa Nụ Cười</h3>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        Tối ưu hiện diện tìm kiếm cục bộ (Local SEO Google Maps), phủ cụm từ khóa tư vấn bọc răng sứ, niềng răng và thiết kế Landing Page tư vấn nụ cười với tỷ lệ chuyển đổi cao.
                    </p>
                    <div class="flex items-center gap-4 text-sm font-semibold text-slate-700 pt-3 border-t border-slate-100">
                        <span>Kết quả: <strong class="text-emerald-700">Top 1 Maps</strong>, tiếp cận hàng nghìn khách hàng tiềm năng xung quanh.</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== BẢNG KIỂM TRA SỨC KHỎE WEBSITE (8 TIÊU CHUẨN) ==================== -->
        <section class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-6">
            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">CHECKLIST CHUYÊN MÔN</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] mt-1">
                        8 Tiêu Chuẩn Kiểm Định Sức Khỏe SEO Website
                    </h2>
                </div>
                <span class="text-xs sm:text-sm text-slate-500">Áp dụng trực tiếp trong quy trình Audit của Cửu Long</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">speed</span>
                        <span>1. Core Web Vitals &lt; 1.8s</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Tốc độ tải trang mượt mà trên thiết bị di động, hạn chế tối đa độ trễ.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">title</span>
                        <span>2. Meta Title &amp; H1 Độc Bản</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Mỗi trang duy nhất 1 thẻ H1, tiêu đề bám sát ý định tìm kiếm của khách.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">schema</span>
                        <span>3. Schema.org JSON-LD</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Khai báo cấu trúc dữ liệu cho doanh nghiệp, bài viết, dịch vụ y tế rõ ràng.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">lock</span>
                        <span>4. SSL/HTTPS &amp; Canonical</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Bảo mật kết nối và gắn thẻ canonical chống trùng lặp nội dung trên web.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">image</span>
                        <span>5. Hình Ảnh WebP &amp; Alt Tag</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Tối ưu dung lượng hình ảnh sắc nét, nén WebP, đầy đủ mô tả từ khóa Alt.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">account_tree</span>
                        <span>6. Sitemap XML &amp; Robots</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Hỗ trợ bot Google thu thập dữ liệu nhanh chóng và liên tục không bị chặn.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">insights</span>
                        <span>7. Đo Lường Sự Kiện GA4</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Gắn mã theo dõi chính xác từng lượt bấm gọi hotline và gửi thông tin tư vấn.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1.5">
                    <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">devices</span>
                        <span>8. 100% Mobile-Friendly</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Trải nghiệm chạm vuốt tối ưu, phông chữ to rõ, không tràn màn hình.</p>
                </div>
            </div>
        </section>

        <!-- ==================== FAQ CÂU HỎI THƯỜNG GẶP ==================== -->
        <section class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">GIẢI ĐÁP THẮC MẮC</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#070f1e] mt-1">Câu Hỏi Thường Gặp Về Tối Ưu SEO &amp; Tăng Trưởng Số</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm text-slate-600">
                <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <h3 class="font-bold text-slate-900 text-base">Sau bao lâu thì thấy kết quả tăng trưởng từ SEO?</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Thông thường sau khi hoàn tất Audit kỹ thuật On-page (2–4 tuần đầu), thứ hạng từ khóa và lượt hiển thị bắt đầu tăng rõ rệt từ tháng thứ 2 đến tháng thứ 3 và đạt điểm rơi tăng trưởng ổn định từ tháng thứ 6.</p>
                </div>
                <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <h3 class="font-bold text-slate-900 text-base">Doanh nghiệp đã chạy Google Ads thì có nên làm SEO không?</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Rất nên. SEO và Ads bổ trợ cho nhau: Khi làm SEO kỹ thuật tốt, điểm chất lượng trang đích (Quality Score) trong Ads sẽ tăng, giúp giảm chi phí thầu mỗi lượt nhấp. Đồng thời, website xuất hiện ở cả phần tìm kiếm tự nhiên lẫn quảng cáo sẽ nâng cao tối đa độ uy tín thương hiệu.</p>
                </div>
                <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <h3 class="font-bold text-slate-900 text-base">Website có bị phạt khi Google cập nhật thuật toán lõi không?</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Hoàn toàn không. Cửu Long áp dụng 100% kỹ thuật White-Hat (SEO mũ trắng), tập trung giải quyết bài toán thật của người dùng và tối ưu mã nguồn chuẩn Google. Khi Google cập nhật, những website làm chuẩn kỹ thuật thậm chí còn được tăng hạng cao hơn.</p>
                </div>
                <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <h3 class="font-bold text-slate-900 text-base">Làm sao để tôi kiểm tra số liệu tăng trưởng minh bạch?</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Quý khách được phân quyền quản trị trực tiếp trên Google Search Console và Google Analytics 4 chính chủ. Mọi con số về lượt click, từ khóa lên top và cuộc gọi phát sinh đều có thể tự kiểm chứng độc lập 24/7.</p>
                </div>
            </div>
        </section>

        <!-- ==================== FINAL CTA (GLOBAL BANNER CTA) ==================== -->
        <x-banner.cta
            variant="centered"
            badge="TƯ VẤN KẾ HOẠCH"
            title="Khảo Sát & Đánh Giá Hiện Trạng Website Của Bạn"
            description="Liên hệ với chúng tôi để được kiểm tra cấu trúc SEO kỹ thuật sơ bộ và nhận tư vấn hướng tiếp cận tăng trưởng bền vững cho ngành hàng của bạn."
            :primaryCta="[
                'label' => 'Bắt đầu dự án',
                'url' => route('contact'),
                'icon' => 'arrow_forward'
            ]"
            :secondaryCta="[
                'label' => 'Xem các giải pháp khác',
                'url' => route('services.index'),
                'icon' => 'visibility'
            ]"
        />

    </x-ui.container>
</div>
@endsection
