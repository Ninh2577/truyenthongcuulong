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

        <!-- ==================== SECTION 02: BUSINESS PROBLEMS (CHỌN BÀI TOÁN) ==================== -->
        <section class="flex flex-col gap-8">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">XÁC ĐỊNH NHU CẦU</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Doanh Nghiệp Đang Cần Giải Quyết Vấn Đề Gì?
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Chọn nhóm bài toán sát nhất để đi thẳng vào phạm vi giải pháp và cách thức triển khai phù hợp.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Problem 1: Web App / Quản lý nội bộ -->
                <a href="{{ route('services.web-app') }}" class="group p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-sky-500/50 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center font-bold text-sm group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">dataset</span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-sky-700 transition-colors">
                            Số hóa quy trình &amp; Web App nội bộ
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Dữ liệu phân tán trên file Excel, cần cổng nghiệp vụ tiếp nhận thông tin, quản lý đặt lịch hoặc theo dõi hồ sơ khách hàng tập trung.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-sky-700 group-hover:text-primary transition-colors">
                        <span>Xem giải pháp Web App</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 2: Website doanh nghiệp may đo -->
                <a href="{{ route('services.web-app') }}" class="group p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-primary/50 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center font-bold text-sm group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">laptop_mac</span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors">
                            Website doanh nghiệp may đo chuẩn SEO
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Cần xây dựng hiện diện số chuyên nghiệp theo nhận diện riêng, cấu trúc bài bản, quản trị CMS thuận tiện và tối ưu tìm kiếm tự nhiên.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-primary transition-colors">
                        <span>Chi tiết website may đo</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 3: Kho giao diện dựng sẵn -->
                <a href="{{ route('templates.index') }}" class="group p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-amber-500/50 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-sm group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">dashboard_customize</span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-amber-700 transition-colors">
                            Triển khai website nhanh theo mẫu có sẵn
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Cần đưa website vào hoạt động sớm với chi phí tối ưu, chọn lựa từ hơn {{ $templatesCount > 0 ? $templatesCount : '39' }}+ mẫu thực tế đa ngành nghề và tùy biến nhận diện.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-amber-700 group-hover:text-primary transition-colors">
                        <span>Xem kho giao diện mẫu</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 4: Tăng trưởng SEO & Quảng cáo -->
                <a href="{{ route('services.marketing') }}" class="group p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-emerald-500/50 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">trending_up</span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-emerald-700 transition-colors">
                            Website chưa có lượt truy cập &amp; khách hàng
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Cần chuẩn hóa SEO kỹ thuật, xây dựng cấu trúc nội dung đúng hành vi tìm kiếm và vận hành chiến dịch quảng cáo có đo lường rõ ràng.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-emerald-700 group-hover:text-primary transition-colors">
                        <span>Giải pháp SEO &amp; Growth</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 5: Tư liệu Media & Video -->
                <a href="{{ route('services.media') }}" class="group p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-orange-500/50 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-700 flex items-center justify-center font-bold text-sm group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">videocam</span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-orange-700 transition-colors">
                            Thiếu tư liệu hình ảnh &amp; video doanh nghiệp
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Cần video giới thiệu công ty, ghi lại hình ảnh sự kiện, tư liệu chân thực hỗ trợ hiển thị trên website và truyền thông số.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-orange-700 group-hover:text-primary transition-colors">
                        <span>Dịch vụ sản xuất Media</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 6: Booking Ekip Sự Kiện -->
                <a href="{{ route('booking') }}" class="group p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-indigo-500/50 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-sm group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">event_available</span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-indigo-700 transition-colors">
                            Cần điều động ekip quay chụp tác nghiệp
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Cần nhân sự máy quay, chụp ảnh sự kiện hoặc thiết bị hỗ trợ theo buổi hoặc theo ngày cho hội nghị, lễ kỷ niệm và chương trình công ty.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-indigo-700 group-hover:text-primary transition-colors">
                        <span>Đặt lịch ekip tác nghiệp</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 03: TECHNOLOGY SOLUTIONS (TECH FIRST ~85%, MEDIA ~15%) ==================== -->
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
                        </div>
                        <div class="pt-5 mt-5 border-t border-slate-100">
                            <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-sky-700 hover:text-primary transition-colors">
                                <span>Xem phạm vi Web App</span>
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
                        </div>
                        <div class="pt-5 mt-5 border-t border-slate-100">
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
                        </div>
                        <div class="pt-5 mt-5 border-t border-slate-100">
                            <a href="{{ route('services.marketing') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-emerald-700 hover:text-primary transition-colors">
                                <span>Xem giải pháp SEO</span>
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

        <!-- ==================== SECTION 04: PROOF (MINH CHỨNG DỰ ÁN THỰC TẾ) ==================== -->
        @if($techCaseStudies->isNotEmpty())
        <section class="flex flex-col gap-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-200 pb-4">
                <div>
                    <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">MINH CHỨNG THỰC TẾ</span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                        Dự Án Đã Triển Khai Thực Tế
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-primary hover:underline">
                    <span>Xem tất cả dự án</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($techCaseStudies as $case)
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col justify-between gap-5 group hover:border-sky-500/50 hover:shadow-md transition-all">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between text-xs font-mono text-slate-500">
                            <span class="px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-700 font-bold border border-sky-200/60">Technology</span>
                            <span>{{ $case->year }}</span>
                        </div>
                        <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-primary transition-colors">
                            {{ $case->title }}
                        </h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            {{ $case->summary }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-500">{{ $case->client_name ?: 'Khách hàng y tế' }}</span>
                        <a href="{{ route('projects.show', $case->slug) }}" class="inline-flex items-center gap-1 text-xs font-headline font-bold text-sky-700 group-hover:text-primary transition-colors">
                            <span>Chi tiết dự án</span>
                            <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- ==================== SECTION 05: 6-STEP PROCESS (QUY TRÌNH TRIỂN KHAI) ==================== -->
        <section class="flex flex-col gap-8">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">CÁCH CHÚNG TÔI LÀM VIỆC</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Quy Trình Triển Khai 6 Bước Rõ Ràng
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Minh bạch từng cột mốc nghiệm thu, kiểm thử cẩn trọng trước khi bàn giao đưa vào vận hành.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xl font-black text-primary">01</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Khảo Sát Nhu Cầu &amp; Bài Toán</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Tìm hiểu hiện trạng vận hành, dữ liệu đầu vào và mục tiêu chuyển đổi cụ thể của doanh nghiệp.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xl font-black text-primary">02</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Phân Tích Nghiệp Vụ &amp; Kiến Trúc</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Xây dựng luồng dữ liệu, sơ đồ chức năng và đề xuất giải pháp kỹ thuật phù hợp phạm vi dự án.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xl font-black text-primary">03</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Thiết Kế Giao Diện UI/UX</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Thiết kế trực quan bám sát nhận diện thương hiệu, tối ưu trải nghiệm thao tác trên cả máy tính và di động.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xl font-black text-primary">04</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Lập Trình &amp; Tích Hợp</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Xây dựng module theo cấu trúc chuẩn, tích hợp cơ sở dữ liệu và các cổng API cần thiết.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xl font-black text-primary">05</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Kiểm Thử QA/QC</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Rà soát bảo mật dữ liệu, kiểm tra giao diện trên nhiều kích thước màn hình và đo lường tốc độ phản hồi.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex flex-col gap-2.5">
                    <span class="font-mono text-xl font-black text-primary">06</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Bàn Giao &amp; Hướng Dẫn Vận Hành</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Hướng dẫn quản trị viên khai thác hệ thống, chuyển giao tài liệu kỹ thuật và duy trì hỗ trợ sau triển khai.</p>
                </div>
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
