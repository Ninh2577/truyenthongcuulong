@extends('layouts.app')

@section('title', 'Quy Trình Triển Khai Giải Pháp Công Nghệ & Phần Mềm - Truyền Thông Cửu Long')
@section('meta_description', 'Quy trình phát triển phần mềm và website chuẩn 6 bước: Khảo sát thực tế, Phân tích kiến trúc, Thiết kế UI/UX, Lập trình tích hợp, Kiểm thử QA/QC và Bàn giao vận hành.')

@section('content')
<div class="w-full bg-surface-low bg-dot-grid-subtle min-h-screen pt-28 pb-20">
    <x-ui.container class="flex flex-col gap-16 lg:gap-20">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Quy trình triển khai']
            ]" />
        </div>

        <!-- ==================== SECTION 01: HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <x-ui.badge variant="primary" class="gap-1.5 px-3.5 py-1">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse" aria-hidden="true"></span>
                <span>HOW WE BUILD &bull; 6-STEP WORKFLOW</span>
            </x-ui.badge>
            
            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                Quy Trình Triển Khai Phần Mềm &amp; Nền Tảng Số <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-amber-500">Minh Bạch &bull; Rõ Ràng Từng Cột Mốc</span>
            </h1>

            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-3xl">
                Chúng tôi áp dụng quy trình 6 bước chặt chẽ nhằm bảo đảm mọi yêu cầu nghiệp vụ đều được khảo sát kỹ lưỡng, kiểm soát chất lượng qua từng chặng và bàn giao đúng cam kết kỹ thuật.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-headline text-xs sm:text-sm font-bold shadow-md shadow-navy-base/15 transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary font-headline text-xs sm:text-sm font-semibold shadow-xs hover:border-primary/40 transition-all">
                    <span>Xem các giải pháp</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">terminal</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 02: 6-STEP PROGRESSIVE WORKFLOW ==================== -->
        <section class="flex flex-col gap-10" id="development-process" aria-labelledby="development-process-title">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">QUY TRÌNH TRIỂN KHAI &bull; HOW WE BUILD</span>
                <h2 id="development-process-title" class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Từ Bài Toán Doanh Nghiệp Đến Hệ Thống Vận Hành
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Mỗi bước đều có kết quả bàn giao (Deliverable) cụ thể để hai bên cùng đối chiếu và nghiệm thu:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                
                <!-- BƯỚC 01 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-primary/50 hover:shadow-md transition-all flex flex-col justify-between gap-6 group">
                    <div class="flex flex-col gap-3.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-primary bg-orange-50 border border-orange-200/80 px-2.5 py-1 rounded-lg">
                                BƯỚC 01
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">manage_search</span>
                            </div>
                        </div>
                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Khảo Sát &amp; Tiếp Nhận Bài Toán
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Lắng nghe bài toán vận hành thực tế, làm rõ mục tiêu tăng trưởng và xác định phạm vi giải pháp cần triển khai cho doanh nghiệp.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Tài liệu phạm vi dự án &amp; định hướng giải pháp sơ bộ</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 02 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-primary/50 hover:shadow-md transition-all flex flex-col justify-between gap-6 group">
                    <div class="flex flex-col gap-3.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-primary bg-orange-50 border border-orange-200/80 px-2.5 py-1 rounded-lg">
                                BƯỚC 02
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">schema</span>
                            </div>
                        </div>
                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Phân Tích Nghiệp Vụ &amp; Kiến Trúc
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Mô hình hóa luồng xử lý dữ liệu, thiết kế sơ đồ quan hệ cơ sở dữ liệu và lựa chọn kiến trúc công nghệ phù hợp với quy mô sử dụng lâu dài.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Đặc tả yêu cầu chức năng &amp; sơ đồ kiến trúc hệ thống</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 03 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-primary/50 hover:shadow-md transition-all flex flex-col justify-between gap-6 group">
                    <div class="flex flex-col gap-3.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-primary bg-orange-50 border border-orange-200/80 px-2.5 py-1 rounded-lg">
                                BƯỚC 03
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">devices</span>
                            </div>
                        </div>
                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Thiết Kế Trải Nghiệm (UI/UX)
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Xây dựng khung giao diện tương tác độc bản, tối ưu luồng thao tác trên thiết bị di động và máy tính trước khi chuyển sang lập trình.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Bản mẫu giao diện trực quan hoàn chỉnh được doanh nghiệp duyệt</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 04 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-primary/50 hover:shadow-md transition-all flex flex-col justify-between gap-6 group">
                    <div class="flex flex-col gap-3.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-primary bg-orange-50 border border-orange-200/80 px-2.5 py-1 rounded-lg">
                                BƯỚC 04
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">code</span>
                            </div>
                        </div>
                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Lập Trình &amp; Tích Hợp Hệ Thống
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Phát triển chức năng theo tài liệu kiến trúc, kết nối cơ sở dữ liệu nội bộ và các cổng dịch vụ bên ngoài an toàn, ổn định.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Phiên bản thử nghiệm (Staging) để doanh nghiệp trực tiếp dùng thử</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 05 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-primary/50 hover:shadow-md transition-all flex flex-col justify-between gap-6 group">
                    <div class="flex flex-col gap-3.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-primary bg-orange-50 border border-orange-200/80 px-2.5 py-1 rounded-lg">
                                BƯỚC 05
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">fact_check</span>
                            </div>
                        </div>
                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Kiểm Thử &amp; Tối Ưu Vận Hành
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Rà soát toàn diện các trường hợp xử lý lỗi, kiểm tra khả năng hiển thị đa màn hình và tối ưu hóa thời gian phản hồi của trang.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Biên bản kiểm thử nghiệm thu chức năng nội bộ</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 06 -->
                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-primary/50 hover:shadow-md transition-all flex flex-col justify-between gap-6 group">
                    <div class="flex flex-col gap-3.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-primary bg-orange-50 border border-orange-200/80 px-2.5 py-1 rounded-lg">
                                BƯỚC 06
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">rocket_launch</span>
                            </div>
                        </div>
                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Bàn Giao &amp; Hỗ Trợ Khởi Chạy
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Cấu hình đưa hệ thống lên môi trường chính thức, hướng dẫn chi tiết người quản trị vận hành và duy trì chế độ hỗ trợ bảo hành kỹ thuật.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Hệ thống số chính thức đi vào hoạt động &amp; tài liệu bàn giao</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==================== SECTION 03: QUALITY & DELIVERY COMMITMENT ==================== -->
        <section class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 font-mono text-xs font-bold text-sky-700 bg-sky-50 px-2.5 py-0.5 rounded-full border border-sky-100">
                    <span class="material-symbols-outlined text-[15px]" aria-hidden="true">verified_user</span>
                    <span>NGUYÊN TẮC HỢP TÁC</span>
                </div>
                <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base">
                    Kiểm Soát Tiến Độ &bull; Minh Bạch Tài Chính &bull; Tự Chủ Mã Nguồn
                </h3>
                <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Hợp đồng pháp lý rõ ràng từng điều khoản; thanh toán chia nhỏ theo các mốc hoàn thành thực tế được khách hàng nghiệm thu trực tiếp; bàn giao toàn quyền sở hữu mã nguồn và cơ sở dữ liệu.
                </p>
            </div>
            <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-headline text-xs font-bold shrink-0 transition-all">
                <span>Xem giải pháp Web-App</span>
                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
            </a>
        </section>

        <!-- ==================== SECTION 04: FINAL CONVERSION CTA ==================== -->
        <section class="rounded-3xl bg-navy-base text-white p-8 sm:p-12 text-center flex flex-col items-center gap-6 shadow-xl">
            <div class="max-w-2xl flex flex-col gap-3">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">HỢP TÁC DỰ ÁN</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                    Sẵn Sàng Triển Khai Hệ Thống Số Cho Doanh Nghiệp?
                </h2>
                <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Chia sẻ yêu cầu sơ bộ hoặc vấn đề vận hành hiện tại, đội ngũ kỹ thuật của Cửu Long sẽ liên hệ tư vấn phương án kiến trúc và lộ trình phù hợp.
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
