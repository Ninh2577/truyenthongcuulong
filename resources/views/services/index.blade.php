@extends('layouts.app')

@section('title', 'Trung Tâm Giải Pháp & Dịch Vụ - Truyền Thông Cửu Long')
@section('meta_description', 'Giải pháp công nghệ bám sát bài toán vận hành thực tế: Web App quản lý, Website doanh nghiệp may đo chuẩn SEO, 39+ mẫu giao diện và tư liệu truyền thông số.')

@section('content')
<div class="w-full bg-surface-low bg-dot-grid-subtle min-h-screen pt-28 pb-20">
    <x-ui.container class="flex flex-col gap-16 lg:gap-20">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Giải pháp & Dịch vụ']
            ]" />
        </div>

        <!-- ==================== SECTION 01: HERO ==================== -->
        <section class="text-center max-w-3xl mx-auto flex flex-col items-center gap-5">
            <x-ui.badge variant="primary" class="gap-1.5 px-3.5 py-1">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse" aria-hidden="true"></span>
                <span>SOLUTION ARCHITECTURE &bull; B2B TECHNOLOGY</span>
            </x-ui.badge>
            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                Giải Pháp Công Nghệ Cho Những Bài Toán <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-amber-500">Vận Hành &amp; Tăng Trưởng Cụ Thể</span>
            </h1>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Chúng tôi không tiếp cận theo hướng bán dịch vụ rời rạc. Mỗi giải pháp được thiết kế bắt đầu từ đúng hiện trạng dữ liệu và nhu cầu vận hành thực tế của doanh nghiệp.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-headline text-xs sm:text-sm font-bold shadow-md shadow-navy-base/15 transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary font-headline text-xs sm:text-sm font-semibold shadow-xs hover:border-primary/40 transition-all">
                    <span>Xem dự án thực tế</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">visibility</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 02: SOLUTION ARCHITECTURE DIRECTORY ==================== -->
        <section class="flex flex-col gap-10">
            <!-- Technology Core Group -->
            <div id="tech-solutions" class="flex flex-col gap-6">
                <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-sky-600" aria-hidden="true"></span>
                        <h2 class="font-headline text-xl sm:text-2xl font-extrabold text-navy-base uppercase tracking-tight">
                            Nhóm Giải Pháp Công Nghệ &amp; Nền Tảng Số
                        </h2>
                    </div>
                    <x-ui.badge variant="info" class="text-[10px]">Trọng Tâm Phát Triển</x-ui.badge>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tech Solution 1: Web App -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-sky-700 bg-sky-50 px-2.5 py-1 rounded-lg">CÔNG NGHỆ 01</span>
                                <span class="material-symbols-outlined text-sky-600 text-[20px]">code</span>
                            </div>
                            <h3 class="font-headline text-lg font-bold text-navy-base">
                                Phát Triển Web App &amp; Website Doanh Nghiệp
                            </h3>
                            <p class="font-body text-xs text-slate-600 leading-relaxed">
                                Xây dựng các ứng dụng web nghiệp vụ (tiếp nhận, quản lý hồ sơ, đặt lịch) và website doanh nghiệp độc bản trên nền Laravel/PHP hiện đại.
                            </p>
                            <div class="flex flex-wrap gap-1.5 pt-1">
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">Laravel</span>
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">MySQL</span>
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">RESTful API</span>
                            </div>
                            <div class="mt-2 py-1.5 px-2.5 rounded-lg bg-slate-50 border border-slate-100 text-[11px] font-mono text-slate-600 flex items-center gap-1.5">
                                <span class="text-sky-700 font-bold">Thực chứng:</span>
                                <span class="truncate">Phòng khám Gia Phước, Nha khoa Nụ Cười</span>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-sky-700 hover:text-primary transition-colors">
                                <span>Xem chi tiết giải pháp Web App</span>
                                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tech Solution 2: Template Library -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg">CÔNG NGHỆ 02</span>
                                <span class="material-symbols-outlined text-amber-600 text-[20px]">web</span>
                            </div>
                            <h3 class="font-headline text-lg font-bold text-navy-base">
                                Kho 39+ Giao Diện Website Dựng Sẵn
                            </h3>
                            <p class="font-body text-xs text-slate-600 leading-relaxed">
                                Lựa chọn mẫu giao diện có sẵn theo 13 ngành nghề, giúp doanh nghiệp rút ngắn thời gian chuẩn bị và triển khai website hiệu quả.
                            </p>
                            <div class="flex flex-wrap gap-1.5 pt-1">
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">39+ Mẫu thật</span>
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">13 Ngành nghề</span>
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">Live Demo</span>
                            </div>
                            <div class="mt-2 py-1.5 px-2.5 rounded-lg bg-slate-50 border border-slate-100 text-[11px] font-mono text-slate-600 flex items-center gap-1.5">
                                <span class="text-amber-700 font-bold">Thực chứng:</span>
                                <span class="truncate">Live Demo 13 ngành nghề vận hành ngay</span>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-amber-700 hover:text-primary transition-colors">
                                <span>Khám phá kho giao diện</span>
                                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tech Solution 3: Marketing & SEO -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg">CÔNG NGHỆ 03</span>
                                <span class="material-symbols-outlined text-emerald-600 text-[20px]">query_stats</span>
                            </div>
                            <h3 class="font-headline text-lg font-bold text-navy-base">
                                Tối Ưu SEO &amp; Kênh Tăng Trưởng Số
                            </h3>
                            <p class="font-body text-xs text-slate-600 leading-relaxed">
                                Tối ưu cấu trúc kỹ thuật on-page, kết nối công cụ đo lường và triển khai chiến dịch quảng cáo đúng nhóm khách hàng có nhu cầu.
                            </p>
                            <div class="flex flex-wrap gap-1.5 pt-1">
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">SEO Kỹ thuật</span>
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">Google Search</span>
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[11px] font-mono">Đo lường GA4</span>
                            </div>
                            <div class="mt-2 py-1.5 px-2.5 rounded-lg bg-slate-50 border border-slate-100 text-[11px] font-mono text-slate-600 flex items-center gap-1.5">
                                <span class="text-emerald-700 font-bold">Thực chứng:</span>
                                <span class="truncate">Cấu trúc Schema JSON-LD &amp; Báo cáo GA4</span>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('services.marketing') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-emerald-700 hover:text-primary transition-colors">
                                <span>Xem giải pháp SEO &amp; Marketing</span>
                                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Creative Support Group (~15%) -->
            <div id="media-solutions" class="flex flex-col gap-6 pt-4">
                <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500" aria-hidden="true"></span>
                        <h2 class="font-headline text-xl sm:text-2xl font-extrabold text-navy-base uppercase tracking-tight">
                            Năng Lực Truyền Thông &amp; Media Hỗ Trợ (~15%)
                        </h2>
                    </div>
                    <x-ui.badge variant="warning" class="text-[10px]">Creative Support</x-ui.badge>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Media Solution 1: Media Support -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="flex flex-col gap-3">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg">MEDIA 01</span>
                                <span class="material-symbols-outlined text-amber-600 text-[20px]">movie_edit</span>
                            </div>
                            <h3 class="font-headline text-base font-bold text-navy-base">
                                Sản Xuất Video Doanh Nghiệp &amp; TVC
                            </h3>
                            <p class="font-body text-xs text-slate-600 leading-relaxed">
                                Hỗ trợ sản xuất video giới thiệu doanh nghiệp, clip quảng bá dịch vụ và tư liệu truyền thông đồng bộ phục vụ website.
                            </p>
                            <div class="mt-2 py-1.5 px-2.5 rounded-lg bg-slate-50 border border-slate-100 text-[11px] font-mono text-slate-600 flex items-center gap-1.5">
                                <span class="text-amber-700 font-bold">Thực chứng:</span>
                                <span class="truncate">TVC Sacombank, Hoya Lens, Kredivo</span>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-amber-700 hover:text-primary transition-colors">
                                <span>Chi tiết năng lực Media</span>
                                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- Media Solution 2: Booking Crew -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="flex flex-col gap-3">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg">MEDIA 02</span>
                                <span class="material-symbols-outlined text-indigo-600 text-[20px]">photo_camera</span>
                            </div>
                            <h3 class="font-headline text-base font-bold text-navy-base">
                                Điều Động Ekip &amp; Thiết Bị Sự Kiện
                            </h3>
                            <p class="font-body text-xs text-slate-600 leading-relaxed">
                                Cung cấp nhân sự quay phim, chụp ảnh sự kiện doanh nghiệp, hội nghị theo buổi hoặc trọn gói ngày tại Cần Thơ và ĐBSCL.
                            </p>
                            <div class="mt-2 py-1.5 px-2.5 rounded-lg bg-slate-50 border border-slate-100 text-[11px] font-mono text-slate-600 flex items-center gap-1.5">
                                <span class="text-indigo-700 font-bold">Thực chứng:</span>
                                <span class="truncate">Ekip Sony Cinema cơ động tại Cần Thơ &amp; ĐBSCL</span>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('booking') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-indigo-700 hover:text-primary transition-colors">
                                <span>Xem biểu phí Booking</span>
                                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 04: ARCHITECTURE EVIDENCE SUMMARY ==================== -->
        <section class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-2xs flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 font-mono text-xs font-bold text-sky-700 bg-sky-50 px-2.5 py-0.5 rounded-full border border-sky-100">
                    <span class="material-symbols-outlined text-[15px]">verified</span>
                    <span>THỰC CHỨNG TRIỂN KHAI &bull; VERIFIED EVIDENCE</span>
                </div>
                <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base">
                    Mỗi Giải Pháp Đều Được Chứng Minh Bằng Sản Phẩm Đang Hoạt Động
                </h3>
                <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Từ các ứng dụng Web-App y tế quản lý hồ sơ và đặt lịch trực tuyến, 39+ mẫu website demo vận hành ngay, đến các TVC doanh nghiệp chuẩn điện ảnh 4K cho đối tác lớn.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-headline text-xs font-bold transition-all shadow-xs">
                    <span>Xem toàn bộ dự án</span>
                    <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="{{ route('services.web-app') }}#case-studies" class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-headline text-xs font-bold transition-all">
                    <span>Case Studies Web-App</span>
                    <span class="material-symbols-outlined text-[15px]" aria-hidden="true">visibility</span>
                </a>
            </div>
        </section>



        <!-- ==================== SECTION 06: CTA CONVERSION ==================== -->
        <section class="rounded-3xl bg-navy-base text-white p-8 sm:p-12 text-center flex flex-col items-center gap-6 shadow-xl relative overflow-hidden">
            <div class="max-w-2xl flex flex-col gap-3">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">HỢP TÁC TRIỂN KHAI</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                    Sẵn Sàng Trao Đổi Về Dự Án Của Doanh Nghiệp?
                </h2>
                <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Chia sẻ yêu cầu sơ bộ hoặc vấn đề vận hành cần giải quyết, đội ngũ kỹ thuật của Cửu Long sẽ liên hệ tư vấn phương án khả thi.
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs sm:text-sm font-extrabold shadow-md shadow-amber-400/20 transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-headline text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">call</span>
                    <span>Hotline: {{ get_setting('company_phone', '0939.363.262') }}</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
