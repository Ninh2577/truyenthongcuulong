@extends('layouts.app')

@section('title', 'Tối Ưu SEO & Tăng Trưởng Kênh Tìm Kiếm - Truyền Thông Cửu Long')
@section('meta_description', 'Giải pháp tối ưu SEO kỹ thuật on-page, cấu trúc nội dung tìm kiếm và thiết lập chiến dịch quảng cáo có đo lường giúp website tiếp cận đúng khách hàng mục tiêu.')

@section('content')
<div class="w-full bg-surface-low bg-dot-grid-subtle min-h-screen pt-28 pb-20">
    <x-ui.container class="flex flex-col gap-16 lg:gap-20">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Giải pháp & Dịch vụ', 'url' => '/dich-vu'],
                ['label' => 'Tối ưu SEO & Marketing số']
            ]" />
        </div>

        <!-- ==================== SECTION 01: HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <x-ui.badge variant="success" class="gap-1.5 px-3.5 py-1">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" aria-hidden="true"></span>
                <span>SEARCH ENGINE OPTIMIZATION &bull; DIGITAL GROWTH</span>
            </x-ui.badge>

            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                Chiến Lược Tối Ưu SEO &amp; Kênh Tiếp Cận Khách Hàng <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-primary to-amber-500">Dựa Trên Dữ Liệu Thực Tế</span>
            </h1>

            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-3xl">
                Website của doanh nghiệp đã xây dựng xong nhưng chưa có lượng người truy cập phù hợp? Chúng tôi tập trung chuẩn hóa kỹ thuật on-page, xây dựng cấu trúc nội dung bài bản và kết nối công cụ đo lường để gia tăng độ hiển thị trên công cụ tìm kiếm.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-headline text-xs sm:text-sm font-bold shadow-md shadow-navy-base/15 transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="#growth-path" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-emerald-700 font-headline text-xs sm:text-sm font-semibold shadow-xs hover:border-emerald-500/40 transition-all">
                    <span>Xem lộ trình tăng trưởng</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_downward</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 02: BUSINESS PROBLEM & JOURNEY ==================== -->
        <section id="growth-path" class="flex flex-col gap-8 scroll-mt-28">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-emerald-700 font-bold uppercase tracking-wider">HÀNH TRÌNH GIẢI QUYẾT BÀI TOÁN</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Từ Hiện Trạng Đến Kênh Tiếp Cận Khách Hàng Bền Vững
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Quy trình tiếp cận bài toán tăng trưởng từng bước một cách khoa học:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xs font-bold text-rose-600 uppercase">VẤN ĐỀ ĐẦU TIÊN</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Thiếu Lượt Truy Cập</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Website không xuất hiện khi khách hàng tìm kiếm từ khóa ngành nghề, thiếu khách hàng tiềm năng.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xs font-bold text-sky-700 uppercase">BƯỚC 01</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Search Visibility</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Rà soát chỉ mục, khai báo sitemap, tối ưu robots.txt và kiểm tra khả năng lập chỉ mục trên Google.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xs font-bold text-sky-700 uppercase">BƯỚC 02</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Technical SEO</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Chuẩn hóa cấu trúc HTML5, thẻ tiêu đề H1/H2, dữ liệu có cấu trúc Schema JSON-LD và tốc độ tải.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xs font-bold text-emerald-700 uppercase">BƯỚC 03</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Cấu Trúc &amp; Nội Dung</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Xây dựng cụm chủ đề chuyên môn bám sát ý định tìm kiếm thực tế của người dùng có nhu cầu.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xs font-bold text-emerald-700 uppercase">BƯỚC 04</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Đo Lường &amp; Tinh Chỉnh</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Gắn thẻ theo dõi chuyển đổi (GA4, Search Console) để đánh giá nguồn truy cập và điều chỉnh.</p>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 03: SCOPE & CAPABILITIES ==================== -->
        <section class="flex flex-col gap-8">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">PHẠM VI TRIỂN KHAI</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Nội Dung Dịch Vụ SEO &amp; Truyền Thông Số
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Minh bạch các hạng mục công việc được thực hiện trong gói giải pháp:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Cap 1: SEO Kỹ Thuật -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">settings</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Chuẩn Hóa SEO Kỹ Thuật (On-Page)</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tối ưu cấu trúc URL thân thiện, thẻ canonical tránh trùng lặp nội dung, tối ưu dung lượng hình ảnh và bổ sung schema doanh nghiệp cục bộ.
                    </p>
                </div>

                <!-- Cap 2: Nghiên Cứu Từ Khóa -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">search</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Nghiên Cứu Từ Khóa &amp; Ý Định Tìm Kiếm</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Khảo sát các cụm từ tìm kiếm thực tế của khách hàng trong ngành nghề, phân loại theo nhu cầu tìm hiểu thông tin và nhu cầu sử dụng dịch vụ.
                    </p>
                </div>

                <!-- Cap 3: Quảng Cáo Google Search -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">campaign</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Quảng Cáo Google Search Có Kiểm Soát</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Thiết lập chiến dịch tìm kiếm đúng từ khóa mục tiêu, cài đặt từ khóa phủ định để tránh lãng phí ngân sách và viết mẫu quảng cáo bám sát trang đích.
                    </p>
                </div>

                <!-- Cap 4: Quảng Cáo Mạng Xã Hội -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">share</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Quảng Cáo Mạng Xã Hội (Meta Ads)</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Thiết lập đối tượng mục tiêu theo vị trí địa lý, độ tuổi và sở thích; thử nghiệm các mẫu hình ảnh/video tư liệu thực tế của doanh nghiệp.
                    </p>
                </div>

                <!-- Cap 5: Đo Lường & Báo Cáo -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">analytics</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Đo Lường &amp; Báo Cáo Số Liệu Thực Tế</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Cài đặt Google Analytics 4, liên kết Search Console và gửi báo cáo định kỳ giúp doanh nghiệp theo dõi rõ ràng lưu lượng và hành vi người dùng.
                    </p>
                </div>

                <!-- Cap 6: Tư Liệu Media Bổ Trợ -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">photo_camera</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Tư Liệu Media &amp; Hình Ảnh Bổ Trợ</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tận dụng lợi thế sản xuất in-house của Cửu Long để cung cấp hình ảnh chân thực cho bài viết và quảng cáo, không phụ thuộc ảnh stock rập khuôn.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 04: CTA ==================== -->
        <section class="rounded-3xl bg-navy-base text-white p-8 sm:p-12 text-center flex flex-col items-center gap-6 shadow-xl">
            <div class="max-w-2xl flex flex-col gap-3">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">TƯ VẤN KẾ HOẠCH</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                    Khảo Sát &amp; Đánh Giá Hiện Trạng Website Của Bạn
                </h2>
                <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Liên hệ với chúng tôi để được kiểm tra cấu trúc SEO kỹ thuật sơ bộ và nhận tư vấn hướng tiếp cận phù hợp cho ngành hàng của bạn.
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs sm:text-sm font-extrabold shadow-md shadow-amber-400/20 transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-headline text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span>Xem các giải pháp khác</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">visibility</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
