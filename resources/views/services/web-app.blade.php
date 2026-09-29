@extends('layouts.app')

@section('title', 'Web App & Hệ Thống Vận Hành Doanh Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Thiết kế và phát triển Web App và hệ thống số phù hợp với quy trình, dữ liệu và nhu cầu vận hành thực tế của doanh nghiệp.')

@section('content')
<!-- ==================== HERO SECTION (GLOBAL BANNER HERO) ==================== -->
<x-banner.hero
    variant="service-split"
    eyebrow="SOFTWARE ENGINEERING • CHUYỂN ĐỔI SỐ DOANH NGHIỆP"
    title="Web App & Hệ Thống"
    titleAccent="Cho Quy Trình Vận Hành Doanh Nghiệp"
    description="Thiết kế và phát triển phần mềm may đo bám sát thực tế vận hành: chuẩn hóa dữ liệu, loại bỏ sai sót từ Excel, tự động hóa quy trình nhiều bước và phân quyền bảo mật chặt chẽ."
    :breadcrumb="[
        ['label' => 'Dịch vụ & Giải pháp', 'url' => route('services.index')],
        ['label' => 'Web App & Hệ Thống']
    ]"
    :primaryCta="[
        'label' => 'Trao đổi bài toán',
        'url' => route('contact'),
        'icon' => 'arrow_forward'
    ]"
    :secondaryCta="[
        'label' => 'Xem kiến trúc hệ thống',
        'url' => '#architecture',
        'icon' => 'schema'
    ]"
    class="!pt-24 !pb-8 lg:!pt-28 lg:!pb-10"
>
    <!-- Visual Showcase with Floating Badges & Dark Window Frame -->
    <div class="relative w-full">
        <!-- Main Mock Window Frame -->
        <div class="relative w-full overflow-hidden rounded-2xl bg-slate-900 border border-slate-700/80 shadow-2xl shadow-navy-base/20 aspect-[16/10] group">
            <img 
                src="{{ asset('images/modern_tech_platform.jpg') }}" 
                alt="Kiến trúc giải pháp Web App và hệ thống số quản trị doanh nghiệp" 
                class="w-full h-full object-cover object-center group-hover:scale-102 transition-transform duration-500"
                loading="eager"
                fetchpriority="high"
                decoding="async"
            >
            <!-- Overlay gradient for depth -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-slate-950/40 pointer-events-none"></div>

            <!-- Top Browser bar mockup -->
            <div class="absolute top-3 left-3 right-3 flex items-center justify-between text-white pointer-events-none z-10">
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-slate-950/70 backdrop-blur-md border border-white/10 text-[10px] font-mono">
                    <div class="flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-rose-500 inline-block"></span>
                        <span class="w-2 h-2 rounded-full bg-amber-500 inline-block"></span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span>
                    </div>
                    <span class="text-slate-300 ml-1">system.cuulong.digital/app</span>
                </div>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-mono font-bold border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>ONLINE</span>
                </span>
            </div>

            <!-- Bottom Caption Inside Frame -->
            <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-white pointer-events-none z-10">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-slate-200">Kiến trúc Laravel 11 • REST API &bull; MySQL</span>
                </div>
                <span class="text-[10px] font-mono text-amber-300 font-bold bg-amber-500/20 px-2.5 py-0.5 rounded-full border border-amber-500/30">ROLE-BASED ACL</span>
            </div>
        </div>

        <!-- Floating Badge: Top Right -->
        <div class="hidden sm:flex absolute -top-4 -right-4 items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200/90 shadow-xl text-xs font-bold text-[#070f1e] z-20">
            <span class="flex h-2.5 w-2.5 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
            </span>
            <span>Tự Động Hóa Workflow</span>
        </div>

        <!-- Floating Badge: Bottom Left -->
        <div class="hidden sm:flex absolute -bottom-4 -left-4 items-center gap-2 px-3.5 py-2 rounded-xl bg-navy-base border border-slate-700 shadow-xl text-xs font-bold text-white z-20">
            <span class="material-symbols-outlined text-[16px] text-amber-400">verified_user</span>
            <span>Bảo Mật &amp; Audit Trail 100%</span>
        </div>
    </div>
</x-banner.hero>

<div class="w-full bg-[#f8f9ff] py-10 lg:py-14" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-12 lg:gap-16">

        <!-- ==================== SECTION 02 — KHI NÀO DOANH NGHIỆP CẦN WEB APP? ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Thời điểm chuyển đổi</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Khi Nào Doanh Nghiệp Cần Web App?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">4 tình huống nhận diện rõ rệt</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Card 01: Excel quá tải -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-rose-200 transition-all flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-200/60 flex items-center justify-center text-rose-600 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">table_chart</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-rose-500 bg-rose-50 px-2 py-0.5 rounded-md">01</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] group-hover:text-rose-600 transition-colors">Excel Bắt Đầu Quá Tải</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Bảng tính bắt đầu chậm chạp, hay xảy ra xung đột khi nhiều người cùng mở, dễ bị ghi đè công thức và mất dấu vết sai lệch.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-rose-700 bg-rose-50/80 px-2.5 py-1 rounded-lg">
                            <span class="material-symbols-outlined text-[13px]">database</span>
                            <span>CSDL quan hệ MySQL tập trung</span>
                        </span>
                    </div>
                </div>

                <!-- Card 02: Quy trình nhiều bước -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-200 transition-all flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200/60 flex items-center justify-center text-amber-600 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">account_tree</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-amber-500 bg-amber-50 px-2 py-0.5 rounded-md">02</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] group-hover:text-amber-600 transition-colors">Quy Trình Nhiều Bước</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Một hồ sơ hoặc đơn hàng cần đi qua nhiều khâu: Tiếp nhận &rarr; Duyệt &rarr; Thực hiện &rarr; Nghiệm thu &rarr; Lưu trữ, đòi hỏi trạng thái minh bạch.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-amber-800 bg-amber-50/80 px-2.5 py-1 rounded-lg">
                            <span class="material-symbols-outlined text-[13px]">published_with_changes</span>
                            <span>Workflow tự động hóa nhiều cấp</span>
                        </span>
                    </div>
                </div>

                <!-- Card 03: Dữ liệu phân tán -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-sky-200 transition-all flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 border border-sky-200/60 flex items-center justify-center text-sky-600 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">hub</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-sky-500 bg-sky-50 px-2 py-0.5 rounded-md">03</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] group-hover:text-sky-600 transition-colors">Dữ Liệu Phân Tán Rời Rạc</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Thông tin nằm rải rác trên Zalo, email, máy tính cá nhân của nhân sự, khiến lãnh đạo không thể nắm bắt báo cáo tức thời.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-sky-800 bg-sky-50/80 px-2.5 py-1 rounded-lg">
                            <span class="material-symbols-outlined text-[13px]">monitoring</span>
                            <span>Dashboard quản trị &amp; KPI tức thời</span>
                        </span>
                    </div>
                </div>

                <!-- Card 04: Kiểm soát quyền & lịch sử -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200/60 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-md">04</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] group-hover:text-emerald-600 transition-colors">Kiểm Soát Quyền &amp; Lịch Sử</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Cần giới hạn ai được xem mục gì, ai được sửa dữ liệu và toàn bộ lịch sử thao tác (audit trail) phải được ghi nhận rõ ràng.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-emerald-800 bg-emerald-50/80 px-2.5 py-1 rounded-lg">
                            <span class="material-symbols-outlined text-[13px]">history</span>
                            <span>Phân quyền RBAC &amp; Activity Log</span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== BẢNG SO SÁNH TRỰC DIỆN: EXCEL VS WEB APP ==================== -->
        <section class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">So sánh hiệu quả</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Vận Hành Thủ Công (Excel / Zalo) vs Hệ Thống Web App May Đo
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Đối chiếu trực diện giá trị mang lại</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Cột 1: Vận hành truyền thống -->
                <div class="p-5 sm:p-6 rounded-xl bg-slate-50/80 border border-rose-200/70 flex flex-col gap-4">
                    <div class="flex items-center gap-2 text-rose-700 font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px] text-rose-600">cancel</span>
                        <span>VẬN HÀNH BẰNG EXCEL / ZALO RỜI RẠC</span>
                    </div>
                    <ul class="space-y-3 text-xs text-slate-600 leading-relaxed">
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✕</span>
                            <span><strong>Dữ liệu phân tán &amp; Dễ thất lạc:</strong> Lưu trên máy cá nhân, gửi qua Zalo dễ trôi file, không có bản sao lưu tập trung.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✕</span>
                            <span><strong>Lỗi nhập trùng &amp; Xung đột công thức:</strong> Nhiều người cùng sửa dễ bị ghi đè, sai lệch số liệu doanh thu và tồn kho không thể cứu vãn.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✕</span>
                            <span><strong>Không thể phân quyền bảo mật:</strong> Mở file là thấy toàn bộ dữ liệu, không giới hạn quyền theo ca hoặc cấp bậc nhân viên.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✕</span>
                            <span><strong>Báo cáo thủ công chậm trễ:</strong> Cuối tháng mất hàng giờ đến hàng ngày để tổng hợp dữ liệu, ban lãnh đạo không có số liệu kịp thời.</span>
                        </li>
                    </ul>
                </div>

                <!-- Cột 2: Web App Cửu Long -->
                <div class="p-5 sm:p-6 rounded-xl bg-orange-50/30 border border-primary/30 flex flex-col gap-4 shadow-2xs">
                    <div class="flex items-center gap-2 text-primary font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px] text-primary">check_circle</span>
                        <span>HỆ THỐNG WEB APP CHUYÊN BIỆT CỬU LONG</span>
                    </div>
                    <ul class="space-y-3 text-xs text-slate-700 leading-relaxed">
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                            <span><strong>Dữ liệu tập trung &amp; Sao lưu tự động:</strong> Cơ sở dữ liệu MySQL bảo mật cao trên máy chủ riêng, backup tự động hàng ngày.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                            <span><strong>Ràng buộc logic tự động:</strong> Kiểm tra hợp lệ dữ liệu ngay khi nhập, triệt tiêu 100% lỗi trùng lặp và tính toán sai sót.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                            <span><strong>Phân quyền vai trò (RBAC) chi tiết:</strong> Đúng người đúng việc, ghi lại toàn bộ lịch sử chỉnh sửa (Audit Logs) minh bạch.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                            <span><strong>Dashboard thời gian thực:</strong> Số liệu cập nhật tức thời liên tục theo thời gian thực, xuất báo cáo PDF / Excel chuẩn mực chỉ với 1 cú nhấp chuột.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 03 — CHÚNG TÔI XÂY DỰNG GÌ? ==================== -->
        <section id="management-system" class="flex flex-col gap-6 scroll-mt-28">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Phạm vi kỹ thuật</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Chúng Tôi Xây Dựng Những Hệ Thống Nào?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">4 nhóm năng lực xây dựng chính</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Group 1: Website & Portal -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-200/60">
                                    <span class="material-symbols-outlined text-[20px]">language</span>
                                </div>
                                <span class="text-xs font-bold text-primary font-mono uppercase">NHÓM 01</span>
                            </div>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded bg-sky-50 text-sky-700 border border-sky-100">Cổng thông tin &amp; Portal</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e] group-hover:text-primary transition-colors">Website &amp; Enterprise Portal</h3>
                        <div class="space-y-2 text-xs text-slate-600 leading-relaxed">
                            <div><span class="font-bold text-slate-800">Bài toán thực tế:</span> Website cũ nghèo nàn thông tin, tải chậm, không hỗ trợ tra cứu hoặc tiếp nhận biểu mẫu số hóa.</div>
                            <div><span class="font-bold text-slate-800">Chức năng cốt lõi:</span> Quản lý bài viết đa danh mục, giới thiệu sản phẩm/dịch vụ, cổng tiếp nhận biểu mẫu, tra cứu thông tin trực tuyến.</div>
                            <div><span class="font-bold text-slate-800">Đối tượng sử dụng:</span> Khách hàng vãng lai, đối tác B2B, ban biên tập nội dung.</div>
                        </div>
                        <!-- Tech Chips -->
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Chuẩn SEO On-page</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Tối ưu LCP &lt; 1.2s</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">CMS Độc Quyền</span>
                        </div>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-xs font-semibold text-slate-700 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[15px] text-emerald-600">check_circle</span>
                        <span>Đầu ra: Website chuẩn mực tải nhanh, quản trị trực quan</span>
                    </div>
                </div>

                <!-- Group 2: Web Application -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-orange-50 text-primary flex items-center justify-center border border-orange-200/60">
                                    <span class="material-symbols-outlined text-[20px]">terminal</span>
                                </div>
                                <span class="text-xs font-bold text-primary font-mono uppercase">NHÓM 02</span>
                            </div>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded bg-orange-50 text-orange-700 border border-orange-100">Ứng dụng nghiệp vụ</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e] group-hover:text-primary transition-colors">Web Application Nghiệp Vụ</h3>
                        <div class="space-y-2 text-xs text-slate-600 leading-relaxed">
                            <div><span class="font-bold text-slate-800">Bài toán thực tế:</span> Nhân viên mất nhiều giờ nhập liệu thủ công giữa các bộ phận, thiếu cơ chế xác thực dữ liệu.</div>
                            <div><span class="font-bold text-slate-800">Chức năng cốt lõi:</span> Xử lý luồng dữ liệu nghiệp vụ, tính toán tự động, xác thực hồ sơ, xuất file PDF/Excel theo biểu mẫu.</div>
                            <div><span class="font-bold text-slate-800">Đối tượng sử dụng:</span> Nhân viên nghiệp vụ, trưởng bộ phận, ban điều hành.</div>
                        </div>
                        <!-- Tech Chips -->
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Laravel 11</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Validation Logic</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Xuất PDF / Excel</span>
                        </div>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-xs font-semibold text-slate-700 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[15px] text-emerald-600">check_circle</span>
                        <span>Đầu ra: Phần mềm chạy trên web, không cần cài đặt, ổn định cao</span>
                    </div>
                </div>

                <!-- Group 3: Admin / Management System -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-200/60">
                                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                                </div>
                                <span class="text-xs font-bold text-primary font-mono uppercase">NHÓM 03</span>
                            </div>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded bg-indigo-50 text-indigo-700 border border-indigo-100">Hệ thống điều hành</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e] group-hover:text-primary transition-colors">Admin / Management System</h3>
                        <div class="space-y-2 text-xs text-slate-600 leading-relaxed">
                            <div><span class="font-bold text-slate-800">Bài toán thực tế:</span> Không có một giao diện duy nhất để bao quát toàn bộ hoạt động kinh doanh và nhân sự.</div>
                            <div><span class="font-bold text-slate-800">Chức năng cốt lõi:</span> Bảng điều khiển (Dashboard) KPI số liệu thực tế, quản lý phân quyền vai trò (RBAC), kiểm soát nhật ký hệ thống.</div>
                            <div><span class="font-bold text-slate-800">Đối tượng sử dụng:</span> Ban giám đốc, quản trị viên hệ thống (Super Admin).</div>
                        </div>
                        <!-- Tech Chips -->
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Phân Quyền RBAC</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Audit Logs 100%</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Báo Cáo KPI</span>
                        </div>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-xs font-semibold text-slate-700 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[15px] text-emerald-600">check_circle</span>
                        <span>Đầu ra: Trung tâm điều khiển số an toàn, bảo mật cấp doanh nghiệp</span>
                    </div>
                </div>

                <!-- Group 4: Booking / Workflow System -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-200/60">
                                    <span class="material-symbols-outlined text-[20px]">event_available</span>
                                </div>
                                <span class="text-xs font-bold text-primary font-mono uppercase">NHÓM 04</span>
                            </div>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-100">Điều phối &amp; Luồng việc</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e] group-hover:text-primary transition-colors">Booking &amp; Workflow System</h3>
                        <div class="space-y-2 text-xs text-slate-600 leading-relaxed">
                            <div><span class="font-bold text-slate-800">Bài toán thực tế:</span> Trùng lịch hẹn, sót yêu cầu của khách hàng khi phối hợp qua nhiều kênh liên lạc rời rạc.</div>
                            <div><span class="font-bold text-slate-800">Chức năng cốt lõi:</span> Đặt hẹn thông minh theo slot khả dụng, điều phối nhân sự/bác sĩ phụ trách, gửi thông báo tự động.</div>
                            <div><span class="font-bold text-slate-800">Đối tượng sử dụng:</span> Khách hàng đặt hẹn, lễ tân điều phối, chuyên gia/kỹ thuật viên.</div>
                        </div>
                        <!-- Tech Chips -->
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Tự Động Check Slot</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">SMS / Zalo ZNS API</span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-semibold">Lịch Trực Ca</span>
                        </div>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-xs font-semibold text-slate-700 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[15px] text-emerald-600">check_circle</span>
                        <span>Đầu ra: Luồng tiếp nhận trơn tru, giảm thiểu tỷ lệ vắng hẹn</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 04 — ARCHITECTURE ==================== -->
        <section id="architecture" class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Cấu trúc phân tầng</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Kiến Trúc Kỹ Thuật Hệ Thống
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Mô hình kiến trúc phân lớp chuẩn mực</span>
            </div>

            <!-- Architecture Box Diagram with Visual Flow -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 pt-2">
                <!-- Layer 1 -->
                <div class="p-4 rounded-xl bg-slate-50/90 border border-slate-200/90 hover:border-sky-300 hover:bg-sky-50/30 transition-all flex flex-col items-center text-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">devices</span>
                    </div>
                    <span class="text-[10px] font-bold text-sky-600 font-mono tracking-wider">LỚP 1</span>
                    <span class="text-xs font-bold text-[#070f1e]">User &amp; Devices</span>
                    <span class="text-[11px] text-slate-500 leading-snug">Khách hàng, Nhân viên, Quản trị qua trình duyệt</span>
                </div>

                <!-- Layer 2 -->
                <div class="p-4 rounded-xl bg-slate-50/90 border border-slate-200/90 hover:border-teal-300 hover:bg-teal-50/30 transition-all flex flex-col items-center text-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">code</span>
                    </div>
                    <span class="text-[10px] font-bold text-teal-600 font-mono tracking-wider">LỚP 2</span>
                    <span class="text-xs font-bold text-[#070f1e]">Frontend UI</span>
                    <span class="text-[11px] text-slate-500 leading-snug">Blade Templates, Tailwind CSS, Alpine.js</span>
                </div>

                <!-- Layer 3 -->
                <div class="p-4 rounded-xl bg-slate-50/90 border border-slate-200/90 hover:border-indigo-300 hover:bg-indigo-50/30 transition-all flex flex-col items-center text-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">security</span>
                    </div>
                    <span class="text-[10px] font-bold text-indigo-600 font-mono tracking-wider">LỚP 3</span>
                    <span class="text-xs font-bold text-[#070f1e]">Application</span>
                    <span class="text-[11px] text-slate-500 leading-snug">Routing, Middleware, CSRF &amp; Auth Session</span>
                </div>

                <!-- Layer 4 -->
                <div class="p-4 rounded-xl bg-slate-50/90 border border-slate-200/90 hover:border-orange-300 hover:bg-orange-50/30 transition-all flex flex-col items-center text-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-orange-100 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">psychology</span>
                    </div>
                    <span class="text-[10px] font-bold text-primary font-mono tracking-wider">LỚP 4</span>
                    <span class="text-xs font-bold text-[#070f1e]">Business Logic</span>
                    <span class="text-[11px] text-slate-500 leading-snug">Xử lý nghiệp vụ, Validation, RBAC Permissions</span>
                </div>

                <!-- Layer 5 -->
                <div class="p-4 rounded-xl bg-slate-50/90 border border-slate-200/90 hover:border-amber-300 hover:bg-amber-50/30 transition-all flex flex-col items-center text-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">database</span>
                    </div>
                    <span class="text-[10px] font-bold text-amber-600 font-mono tracking-wider">LỚP 5</span>
                    <span class="text-xs font-bold text-[#070f1e]">Database</span>
                    <span class="text-[11px] text-slate-500 leading-snug">MySQL InnoDB, Eloquent ORM, Indexing</span>
                </div>

                <!-- Layer 6 -->
                <div class="p-4 rounded-xl bg-slate-50/90 border border-slate-200/90 hover:border-emerald-300 hover:bg-emerald-50/30 transition-all flex flex-col items-center text-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">monitoring</span>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-600 font-mono tracking-wider">LỚP 6</span>
                    <span class="text-xs font-bold text-[#070f1e]">Admin / Reporting</span>
                    <span class="text-[11px] text-slate-500 leading-snug">Audit Logs, Báo cáo KPI, Xuất file tự động</span>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-xs text-slate-600 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-emerald-600">verified</span>
                    <span>Kiến trúc phân tầng bảo đảm tính an toàn dữ liệu, chống SQL Injection, CSRF và sẵn sàng mở rộng module.</span>
                </div>
                <span class="font-semibold text-slate-700 shrink-0 font-mono text-[11px] px-2.5 py-1 rounded bg-slate-200/70">Bảo mật chuẩn OWASP Top 10</span>
            </div>
        </section>

        <!-- ==================== SECTION 05 — TECHNOLOGY ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Công nghệ thực tế</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Ngăn Xếp Công Nghệ Chúng Tôi Sử Dụng
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Chỉ liệt kê các công nghệ dự án trực tiếp hỗ trợ</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5">
                <!-- Laravel -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-red-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">developer_board</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">Laravel</span>
                        <span class="text-[10px] text-slate-500">PHP Framework</span>
                    </div>
                </div>

                <!-- PHP -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-indigo-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">code</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">PHP 8.2+</span>
                        <span class="text-[10px] text-slate-500">Ngôn ngữ xử lý</span>
                    </div>
                </div>

                <!-- MySQL -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-amber-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">database</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">MySQL</span>
                        <span class="text-[10px] text-slate-500">Hệ quản trị CSDL</span>
                    </div>
                </div>

                <!-- REST API -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-sky-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">api</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">REST API</span>
                        <span class="text-[10px] text-slate-500">Giao tiếp dịch vụ</span>
                    </div>
                </div>

                <!-- Blade -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-orange-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-orange-50 text-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">layers</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">Blade</span>
                        <span class="text-[10px] text-slate-500">Template Engine</span>
                    </div>
                </div>

                <!-- Alpine.js -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-teal-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">bolt</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">Alpine.js</span>
                        <span class="text-[10px] text-slate-500">Tương tác UI nhẹ</span>
                    </div>
                </div>

                <!-- JavaScript -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-yellow-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">javascript</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">JavaScript</span>
                        <span class="text-[10px] text-slate-500">ES6+ Modules</span>
                    </div>
                </div>

                <!-- Tailwind CSS -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-cyan-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">css</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">Tailwind CSS</span>
                        <span class="text-[10px] text-slate-500">Giao diện đáp ứng</span>
                    </div>
                </div>

                <!-- RBAC -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-emerald-200 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">verified_user</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">RBAC</span>
                        <span class="text-[10px] text-slate-500">Phân quyền vai trò</span>
                    </div>
                </div>

                <!-- Mulish -->
                <div class="p-3.5 rounded-xl bg-white border border-slate-200/90 hover:border-slate-300 hover:shadow-xs transition-all flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[18px]">text_fields</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#070f1e] block">Mulish</span>
                        <span class="text-[10px] text-slate-500">Typography đồng bộ</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 06 — CASE STUDIES ==================== -->
        <section id="case-studies" class="flex flex-col gap-6 scroll-mt-28">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Minh chứng triển khai</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        2 Case Studies Tiêu Biểu
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem toàn bộ dự án</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($techCaseStudies as $case)
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-slate-800">{{ $case->client_name ?: 'Đơn vị triển khai' }}</span>
                            <span class="text-xs font-mono text-slate-400">Năm {{ $case->year ?: '2024' }}</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] leading-snug group-hover:text-primary transition-colors">{{ $case->title }}</h3>

                        <div class="space-y-2 text-xs">
                            <div>
                                <span class="font-bold text-slate-700">Business Problem:</span>
                                <span class="text-slate-600 ml-1">{{ $case->problem ?: 'Tiếp nhận bệnh nhân và quản lý lịch khám qua nhiều kênh thủ công, khó tra cứu lịch sử bệnh án.' }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-slate-700">Solution:</span>
                                <span class="text-slate-600 ml-1">{{ $case->solution ?: 'Xây dựng Web App đặt lịch khám bệnh trực tuyến kết hợp module quản lý hồ sơ nội bộ cho bác sĩ và lễ tân.' }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-slate-700">Technology:</span>
                                <span class="text-slate-600 ml-1 font-mono text-[11px]">{{ $case->tech_stack ?: 'Laravel, MySQL, REST API, Tailwind CSS, RBAC' }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-slate-700">Deliverables:</span>
                                <span class="text-slate-600 ml-1">{{ $case->result ?: 'Cổng đặt lịch trực tuyến, giao diện quản trị phòng khám, bàn giao toàn bộ mã nguồn và tài liệu vận hành.' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100">
                        <a href="{{ route('projects.show', $case->slug) }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Chi tiết sản phẩm đã triển khai</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-slate-800">Phòng Khám Đa Khoa Gia Phước</span>
                            <span class="text-xs text-slate-400">Y tế &bull; Đặt lịch</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] leading-snug">Hệ Thống Đặt Hẹn &amp; Quản Lý Hồ Sơ Tiếp Nhận</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Xây dựng Web App đặt lịch khám bệnh trực tuyến kết hợp module quản lý hồ sơ nội bộ cho bác sĩ và lễ tân trên nền Laravel &amp; MySQL.</p>
                    </div>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-slate-800">Nha Khoa Nụ Cười</span>
                            <span class="text-xs text-slate-400">Dịch vụ &bull; Chăm sóc</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] leading-snug">Cổng Thông Tin Doanh Nghiệp &amp; Tiếp Nhận Khách Hàng</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Nền tảng website tương tác khách hàng, đồng bộ dữ liệu đặt lịch hẹn và tư vấn trực tuyến chuẩn SEO.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </section>

        <!-- ==================== SECTION 07 — QUY TRÌNH & CROSS-LINKS ==================== -->
        <section class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Tiêu chuẩn thực thi</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Quy Trình Phát Triển 4 Bước
                    </h2>
                </div>
                <a href="{{ route('process') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem chi tiết quy trình 6 bước</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-2 p-4 rounded-xl bg-slate-50/60 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">01</span>
                        <span class="w-2 h-2 rounded-full bg-primary/40"></span>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Khảo sát nghiệp vụ</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Phân tích luồng công việc hiện tại, các trường dữ liệu cần lưu trữ và các trường hợp ngoại lệ.
                    </p>
                </div>
                <div class="space-y-2 p-4 rounded-xl bg-slate-50/60 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">02</span>
                        <span class="w-2 h-2 rounded-full bg-primary/40"></span>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Thiết kế kiến trúc &amp; UI</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Thiết kế lược đồ cơ sở dữ liệu và giao diện làm việc trực quan cho từng vai trò người dùng.
                    </p>
                </div>
                <div class="space-y-2 p-4 rounded-xl bg-slate-50/60 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">03</span>
                        <span class="w-2 h-2 rounded-full bg-primary/40"></span>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Lập trình &amp; Kiểm thử</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Xây dựng theo từng module chức năng, kiểm thử logic tính toán và kiểm tra bảo mật truy cập.
                    </p>
                </div>
                <div class="space-y-2 p-4 rounded-xl bg-slate-50/60 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">04</span>
                        <span class="w-2 h-2 rounded-full bg-primary/40"></span>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Triển khai &amp; Bảo hành</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Cài đặt trên máy chủ thực tế, bàn giao tài liệu kỹ thuật và hỗ trợ kỹ thuật liên tục trong vận hành.
                    </p>
                </div>
            </div>

            <!-- Template library cross-link -->
            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-600">
                <span>Cần triển khai nhanh với ngân sách tối ưu? Tham khảo thư viện nền tảng có sẵn.</span>
                <a href="{{ route('templates.index') }}" class="font-bold text-primary hover:underline inline-flex items-center gap-1 shrink-0">
                    <span>Khám phá kho giao diện</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 08 — FAQ ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Hỏi đáp kỹ thuật</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Các Câu Hỏi Thường Gặp Về Web App
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-primary">help</span>
                        <span>Có nhận xây hệ thống theo yêu cầu không?</span>
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed pl-6">
                        Có. 100% ứng dụng Web App của Cửu Long được thiết kế may đo từ đầu theo đúng quy trình và đặc thù dữ liệu thực tế của doanh nghiệp, không ép dùng template có sẵn.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-primary">api</span>
                        <span>Có tích hợp API không?</span>
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed pl-6">
                        Có. Hệ thống hỗ trợ xây dựng và kết nối RESTful API với các cổng thanh toán (VNPay, MoMo), dịch vụ SMS/Zalo ZNS, Google Sheets hoặc phần mềm kế toán/ERP hiện có.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-primary">admin_panel_settings</span>
                        <span>Có hệ thống quản trị không?</span>
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed pl-6">
                        Có. Mỗi sản phẩm đều đi kèm bảng điều khiển Admin riêng biệt với chức năng phân quyền chi tiết (RBAC) theo từng phòng ban và ghi nhận nhật ký thao tác.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-primary">published_with_changes</span>
                        <span>Có bảo trì sau khi bàn giao không?</span>
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed pl-6">
                        Có. Chúng tôi cung cấp chính sách bảo hành kỹ thuật 12 tháng, sao lưu dữ liệu định kỳ và hỗ trợ nâng cấp module khi quy mô nghiệp vụ mở rộng.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-2xs space-y-2 md:col-span-2">
                    <h3 class="text-sm font-bold text-[#070f1e] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-primary">payments</span>
                        <span>Chi phí phát triển Web App phụ thuộc vào đâu?</span>
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed pl-6">
                        Chi phí được tính dựa trên số lượng module chức năng, độ phức tạp của luồng xử lý dữ liệu, yêu cầu tích hợp API bên ngoài và mức độ tùy biến giao diện, không phát sinh chi phí ẩn.
                    </p>
                </div>
            </div>
        </section>

    </x-ui.container>
</div>

<!-- ==================== FINAL CTA (GLOBAL BANNER CTA) ==================== -->
<x-banner.cta
    eyebrow="BẮT ĐẦU DỰ ÁN • TƯ VẤN KIẾN TRÚC"
    title="Mô Tả Bài Toán Của Bạn"
    description="Hãy cho chúng tôi biết về quy trình vận hành hoặc điểm nghẽn doanh nghiệp của bạn đang gặp phải. Đội ngũ kỹ thuật sẽ phân tích và đề xuất phương án kiến trúc tối ưu."
    :primaryCta="[
        'label' => 'Mô tả bài toán của bạn',
        'url' => route('contact'),
        'icon' => 'arrow_forward'
    ]"
    :secondaryCta="[
        'label' => 'Hotline: ' . get_setting('company_phone', '0939.363.262'),
        'url' => 'tel:' . preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')),
        'icon' => 'call'
    ]"
    :trustPoints="[
        'Kiến trúc module độc lập',
        'Chuẩn RESTful API & RBAC',
        'Bảo hành kỹ thuật & hỗ trợ mở rộng'
    ]"
/>
@endsection
