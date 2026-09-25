@extends('layouts.app')

@section('title', 'Tối Ưu SEO & Tăng Trưởng Kênh Tìm Kiếm - Truyền Thông Cửu Long')
@section('meta_description', 'Giải pháp tối ưu SEO kỹ thuật on-page, cấu trúc nội dung tìm kiếm và thiết lập chiến dịch quảng cáo có đo lường giúp website tiếp cận đúng khách hàng mục tiêu.')

@section('content')
<div class="w-full bg-[#f8f9ff] min-h-screen pt-28 pb-20" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-14 lg:gap-18">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Dịch vụ & Giải pháp', 'url' => '/dich-vu'],
                ['label' => 'Tối ưu SEO & Tăng trưởng số']
            ]" />
        </div>

        <!-- ==================== HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                TECHNICAL SEO &bull; SEARCH ENGINE VISIBILITY
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                Chiến Lược Tối Ưu SEO &amp; Kênh Tiếp Cận Khách Hàng
                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                    Dựa Trên Dữ Liệu Thực Tế
                </span>
            </h1>

            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Dịch vụ bổ trợ chuyên sâu cho hệ thống website: chuẩn hóa kỹ thuật On-page, cấu trúc nội dung theo ý định tìm kiếm thực tế và kết nối công cụ đo lường chuyển đổi minh bạch.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="#growth-path" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary text-xs sm:text-sm font-semibold shadow-xs hover:border-slate-300 transition-all">
                    <span>Xem lộ trình tăng trưởng</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_downward</span>
                </a>
            </div>
        </section>

        <!-- ==================== BÀI TOÁN TĂNG TRƯỞNG & HÀNH TRÌNH ==================== -->
        <section id="growth-path" class="flex flex-col gap-6 scroll-mt-28">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">HÀNH TRÌNH GIẢI QUYẾT BÀI TOÁN</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Từ Hiện Trạng Đến Kênh Tiếp Cận Khách Hàng Bền Vững
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Tiếp cận dựa trên phân tích kỹ thuật</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-sm space-y-1.5">
                    <span class="text-xs font-bold text-rose-600 block">VẤN ĐỀ ĐẦU TIÊN</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Thiếu Lượt Truy Cập</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Website không xuất hiện khi khách hàng tìm kiếm từ khóa ngành nghề, thiếu khách hàng tiềm năng.</p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-sm space-y-1.5">
                    <span class="text-xs font-bold text-slate-400 block">BƯỚC 01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Search Visibility</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Rà soát chỉ mục, khai báo sitemap XML, cấu hình robots.txt và kiểm tra khả năng lập chỉ mục trên Google.</p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-sm space-y-1.5">
                    <span class="text-xs font-bold text-slate-400 block">BƯỚC 02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Technical SEO</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Chuẩn hóa cấu trúc HTML5, thẻ tiêu đề H1/H2, dữ liệu có cấu trúc Schema JSON-LD và tối ưu Core Web Vitals.</p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-sm space-y-1.5">
                    <span class="text-xs font-bold text-slate-400 block">BƯỚC 03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Cấu Trúc &amp; Nội Dung</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Xây dựng cụm chủ đề chuyên môn bám sát ý định tìm kiếm thực tế của người dùng có nhu cầu sử dụng dịch vụ.</p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-sm space-y-1.5">
                    <span class="text-xs font-bold text-slate-400 block">BƯỚC 04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Đo Lường &amp; Tinh Chỉnh</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Gắn thẻ theo dõi chuyển đổi (GA4, Search Console) để đánh giá nguồn truy cập và điều chỉnh chiến lược.</p>
                </div>
            </div>
        </section>

        <!-- ==================== PHẠM VI NỘI DUNG DỊCH VỤ ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">PHẠM VI TRIỂN KHAI</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Nội Dung Dịch Vụ SEO &amp; Truyền Thông Số
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Hỗ trợ kỹ thuật &amp; tăng trưởng bền vững</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">01</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Chuẩn Hóa SEO Kỹ Thuật (Technical SEO)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Tối ưu cấu trúc URL thân thiện, thẻ canonical tránh trùng lặp nội dung, tối ưu dung lượng hình ảnh WebP và bổ sung schema tổ chức theo chuẩn Schema.org.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">02</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Nghiên Cứu Từ Khóa &amp; Ý Định Tìm Kiếm</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Khảo sát các cụm từ tìm kiếm thực tế của khách hàng trong ngành nghề, phân loại theo nhu cầu tìm hiểu thông tin và nhu cầu chuyển đổi sử dụng dịch vụ.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">03</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Quảng Cáo Google Search Theo Mục Tiêu</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Thiết lập chiến dịch tìm kiếm đúng từ khóa mục tiêu, cài đặt từ khóa phủ định để tránh lãng phí ngân sách và viết thông điệp bám sát trang đích.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">04</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Content Chuyên Ngành &amp; Landing Page</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Xây dựng nội dung bài viết chuyên sâu có giá trị nghiệp vụ, tối ưu cấu trúc các khối thông tin trên Landing Page nhằm nâng cao tỷ lệ khách liên hệ.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">05</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Đo Lường GA4 &amp; Search Console</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Cài đặt Google Analytics 4, liên kết Search Console, theo dõi sự kiện bấm gọi/gửi form và gửi báo cáo định kỳ minh bạch về nguồn truy cập.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">06</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Tư Liệu Media Thực Tế Hỗ Trợ</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sử dụng hình ảnh và video tư liệu chân thực từ ekip của Cửu Long để minh họa cho nội dung, tăng độ tin cậy của doanh nghiệp khi người dùng truy cập.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== FINAL CTA ==================== -->
        <section class="rounded-2xl bg-[#070f1e] text-white p-8 sm:p-12 text-center flex flex-col items-center gap-5 shadow-xl">
            <span class="text-xs text-amber-400 font-bold uppercase tracking-wider">TƯ VẤN KẾ HOẠCH</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                Khảo Sát &amp; Đánh Giá Hiện Trạng Website Của Bạn
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                Liên hệ với chúng tôi để được kiểm tra cấu trúc SEO kỹ thuật sơ bộ và nhận tư vấn hướng tiếp cận tăng trưởng bền vững cho ngành hàng của bạn.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs sm:text-sm font-bold shadow-sm transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span>Xem các giải pháp khác</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">visibility</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
