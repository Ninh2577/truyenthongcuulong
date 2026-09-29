@extends('layouts.app')

@section('title', 'Tự Động Hóa Quy Trình & Workflow Doanh Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Giải pháp tự động hóa luồng việc doanh nghiệp, kết nối đa kênh Webhook, Zalo ZNS, VietQR, logistics và thông báo thời gian thực giúp tiết kiệm thời gian xử lý và giảm thiểu sai sót.')

@section('content')
<!-- ==================== HERO SECTION (GLOBAL BANNER HERO) ==================== -->
<x-banner.hero
    variant="service-split"
    eyebrow="WORKFLOW AUTOMATION • KẾT NỐI HỆ THỐNG LIỀN MẠCH"
    title="Tự Động Hóa Quy Trình"
    titleAccent="Vận Hành Đa Kênh Cho Doanh Nghiệp"
    description="Kết nối liền mạch website, cổng thanh toán VietQR, đơn vị vận chuyển và kênh giao tiếp khách hàng để hệ thống tự vận hành 24/7, loại bỏ thao tác copy thủ công và giảm thiểu sai sót."
    :breadcrumb="[
        ['label' => 'Dịch vụ & Giải pháp', 'url' => route('services.index')],
        ['label' => 'Tự động hóa quy trình']
    ]"
    :primaryCta="[
        'label' => 'Khảo sát luồng nghiệp vụ',
        'url' => route('contact') . '?service=' . urlencode('Tự động hóa quy trình'),
        'icon' => 'bolt'
    ]"
    :secondaryCta="[
        'label' => 'Khám phá giải pháp',
        'url' => '#automation-matrix',
        'icon' => 'hub'
    ]"
    class="!pt-24 !pb-8 lg:!pt-28 lg:!pb-10"
>
    <!-- Visual Showcase: Live Automation Terminal Simulation -->
    <div class="relative w-full">
        <div class="relative w-full overflow-hidden rounded-2xl bg-[#070f1e] border border-slate-700/80 shadow-2xl shadow-navy-base/30 p-5 sm:p-7 text-white font-mono space-y-4">
            <!-- Terminal Header -->
            <div class="flex items-center justify-between border-b border-slate-800 pb-3 text-xs sm:text-sm">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                    <span class="text-slate-300 ml-1 font-semibold text-xs sm:text-sm">workflow.engine.active • 24/7/365</span>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>REAL-TIME PIPELINE</span>
                </div>
            </div>

            <!-- Pipeline Live Steps -->
            <div class="space-y-3 text-sm">
                <!-- Step 1: Trigger -->
                <div class="p-3.5 sm:p-4 rounded-xl bg-slate-900/90 border border-slate-800 flex items-start gap-3.5 hover:border-slate-700 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-orange-500/20 text-primary flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-[18px]">input</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between text-xs sm:text-sm mb-1">
                            <span class="text-primary font-bold">01. TRIGGER KÍCH HOẠT</span>
                            <span class="text-slate-400 text-xs">0.12s</span>
                        </div>
                        <p class="text-slate-200 text-xs sm:text-sm leading-relaxed">Đơn hàng mới <span class="text-amber-400 font-semibold">#CL-8921</span> tiếp nhận từ Website/Form liên hệ.</p>
                    </div>
                </div>

                <!-- Step 2: Payment Webhook -->
                <div class="p-3.5 sm:p-4 rounded-xl bg-slate-900/90 border border-slate-800 flex items-start gap-3.5 hover:border-slate-700 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-[18px]">qr_code_scanner</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between text-xs sm:text-sm mb-1">
                            <span class="text-emerald-400 font-bold">02. VIETQR TỰ ĐỘNG ĐỐI SOÁT</span>
                            <span class="text-slate-400 text-xs">0.85s</span>
                        </div>
                        <p class="text-slate-200 text-xs sm:text-sm leading-relaxed">Webhook ngân hàng xác nhận tiền về tài khoản, khớp mã nội dung 100%.</p>
                    </div>
                </div>

                <!-- Step 3: Logistics API -->
                <div class="p-3.5 sm:p-4 rounded-xl bg-slate-900/90 border border-slate-800 flex items-start gap-3.5 hover:border-slate-700 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between text-xs sm:text-sm mb-1">
                            <span class="text-indigo-400 font-bold">03. BẮN ĐƠN VẬN CHUYỂN API</span>
                            <span class="text-slate-400 text-xs">1.20s</span>
                        </div>
                        <p class="text-slate-200 text-xs sm:text-sm leading-relaxed">Tự động đẩy đơn qua GHTK / Viettel Post, nhận mã vận đơn &amp; in phiếu gửi.</p>
                    </div>
                </div>

                <!-- Step 4: Multi-channel Alert -->
                <div class="p-3.5 sm:p-4 rounded-xl bg-slate-900/90 border border-slate-800 flex items-start gap-3.5 hover:border-slate-700 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-[18px]">notifications_active</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between text-xs sm:text-sm mb-1">
                            <span class="text-sky-400 font-bold">04. THÔNG BÁO ĐA KÊNH TỨC THÌ</span>
                            <span class="text-slate-400 text-xs">0.25s</span>
                        </div>
                        <p class="text-slate-200 text-xs sm:text-sm leading-relaxed">Gửi Zalo ZNS xác nhận tới khách hàng &amp; ping cảnh báo doanh thu vào Telegram.</p>
                    </div>
                </div>
            </div>

            <!-- Terminal Footer Status Bar -->
            <div class="pt-3 border-t border-slate-800 flex items-center justify-between text-xs text-slate-300">
                <div class="flex items-center gap-3">
                    <span>Tổng thời gian: <strong class="text-emerald-400 font-bold">~2.4 giây</strong></span>
                    <span class="hidden sm:inline">&bull;</span>
                    <span class="hidden sm:inline">Lỗi thao tác: <strong class="text-emerald-400 font-bold">0%</strong></span>
                </div>
                <span class="text-amber-400 font-bold uppercase tracking-wider text-xs">TỰ ĐỘNG KHÔNG CẦN DUYỆT TAY</span>
            </div>
        </div>

        <!-- Floating Badge -->
        <div class="absolute -bottom-3 -right-3 sm:-right-4 px-4 py-2.5 rounded-xl bg-white border border-slate-200/90 shadow-xl flex items-center gap-3 text-slate-900 z-10 font-sans">
            <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">sync_saved_locally</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs sm:text-sm font-bold leading-tight">Đồng bộ liên tục</span>
                <span class="text-xs text-slate-500">Giảm 70% thời gian xử lý</span>
            </div>
        </div>
    </div>
</x-banner.hero>

<!-- ==================== BODY CONTENT CONTAINER ==================== -->
<x-ui.container class="py-12 sm:py-16 space-y-16 lg:space-y-20">

    <!-- ==================== SECTION 01 — MA TRẬN 4 NHÓM GIẢI PHÁP TỰ ĐỘNG HÓA ==================== -->
    <section id="automation-matrix" class="space-y-8 scroll-mt-28">
        <div class="border-b border-slate-200 pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div class="space-y-1.5">
                <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">CẤU TRÚC GIẢI PHÁP</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight">
                    4 Trụ Cột Tự Động Hóa Vận Hành
                </h2>
            </div>
            <p class="text-sm sm:text-base text-slate-600 max-w-md leading-relaxed">
                Tự động hóa các nút thắt tốn thời gian nhất trong chuỗi hoạt động kinh doanh hàng ngày của doanh nghiệp.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Solution Card 1 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[24px]">forum</span>
                        </div>
                        <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-primary transition-colors">01</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-primary transition-colors">
                            Tự Động Hóa Bán Hàng &amp; CSKH Đa Kênh
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Khách hàng để lại thông tin đặt hẹn hoặc mua hàng sẽ nhận được phản hồi ngay lập tức qua tin nhắn có dấu nhận diện thương hiệu.
                        </p>
                    </div>
                    <ul class="space-y-2.5 pt-3 border-t border-slate-100 text-sm sm:text-base text-slate-700">
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Tự động gửi tin nhắn <strong>Zalo ZNS / SMS OTP</strong> xác nhận trong 3 giây.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Đồng bộ tự động thông tin vào CRM, phân bổ nhân sự phụ trách theo ca trực.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Nhắc lịch hẹn khám, lịch bảo dưỡng hoặc gia hạn dịch vụ hoàn toàn tự động.</span>
                        </li>
                    </ul>
                </div>
                <div class="pt-4 mt-5 border-t border-slate-100 flex items-center justify-between text-sm font-bold text-primary">
                    <span>Áp dụng: Phòng khám, Nha khoa, Spa, Bán lẻ</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </div>

            <!-- Solution Card 2 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-500/40 hover:shadow-md transition-all flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[24px]">payments</span>
                        </div>
                        <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-emerald-600 transition-colors">02</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-emerald-600 transition-colors">
                            Tự Động Hóa Thanh Toán &amp; Đối Soát VietQR
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Xóa bỏ hoàn toàn việc nhân viên kế toán phải chụp sao kê ngân hàng rồi đối soát thủ công từng dòng giao dịch.
                        </p>
                    </div>
                    <ul class="space-y-2.5 pt-3 border-t border-slate-100 text-sm sm:text-base text-slate-700">
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Sinh mã <strong>VietQR động</strong> tích hợp sẵn số tiền và mã hóa đơn riêng biệt.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Webhook ngân hàng thông báo tiền về trong 1 giây, tự động kích hoạt tài khoản/đơn.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Đồng bộ chứng từ thanh toán vào phần mềm kế toán hoặc Google Sheets nội bộ.</span>
                        </li>
                    </ul>
                </div>
                <div class="pt-4 mt-5 border-t border-slate-100 flex items-center justify-between text-sm font-bold text-emerald-600">
                    <span>Áp dụng: Thương mại điện tử, Học viện đào tạo, Dịch vụ số</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </div>

            <!-- Solution Card 3 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-indigo-500/40 hover:shadow-md transition-all flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[24px]">local_shipping</span>
                        </div>
                        <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-indigo-600 transition-colors">03</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-indigo-600 transition-colors">
                            Tự Động Hóa Đơn Hàng &amp; Vận Chuyển Logistics
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Liên kết cổng giao vận (GHTK, Viettel Post, Ahamove) để tự động đẩy đơn và theo dõi hành trình giao nhận.
                        </p>
                    </div>
                    <ul class="space-y-2.5 pt-3 border-t border-slate-100 text-sm sm:text-base text-slate-700">
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Tự động tạo vận đơn ngay sau khi khách xác nhận, in nhãn vận chuyển 1 chạm.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Tự động trừ tồn kho thời gian thực, ngăn chặn tình trạng bán vượt quá số lượng còn lại.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Cập nhật trạng thái giao hàng về hệ thống và báo tin tự động cho khách hàng.</span>
                        </li>
                    </ul>
                </div>
                <div class="pt-4 mt-5 border-t border-slate-100 flex items-center justify-between text-sm font-bold text-indigo-600">
                    <span>Áp dụng: Bán buôn, Bán lẻ, Nhà thuốc, Chuỗi cửa hàng</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </div>

            <!-- Solution Card 4 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-500/40 hover:shadow-md transition-all flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[24px]">smart_toy</span>
                        </div>
                        <span class="text-sm font-bold font-mono text-slate-400 group-hover:text-sky-600 transition-colors">04</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-[#070f1e] group-hover:text-sky-600 transition-colors">
                            Tự Động Hóa Báo Cáo &amp; Bot Cảnh Báo Telegram/Zalo
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Cấp quản lý luôn nắm trọn số liệu kinh doanh và sự cố hệ thống tức thì mà không cần mở phần mềm hay đợi nhân viên nộp báo cáo.
                        </p>
                    </div>
                    <ul class="space-y-2.5 pt-3 border-t border-slate-100 text-sm sm:text-base text-slate-700">
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Bot Telegram tự động gửi báo cáo doanh thu, đơn hàng mỗi ngày vào lúc 21:00.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Cảnh báo tức thì khi có đơn giá trị lớn, đơn bị hủy hoặc sự cố tồn kho thấp.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                            <span>Tự động kết xuất bảng tính báo cáo tuần gửi email định kỳ cho ban giám đốc.</span>
                        </li>
                    </ul>
                </div>
                <div class="pt-4 mt-5 border-t border-slate-100 flex items-center justify-between text-sm font-bold text-sky-600">
                    <span>Áp dụng: Mọi doanh nghiệp đang cần giám sát vận hành từ xa</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION 02 — SƠ ĐỒ 4 BƯỚC VẬN HÀNH TỰ ĐỘNG ==================== -->
    <section class="p-6 sm:p-10 rounded-3xl bg-slate-900 text-white shadow-xl relative overflow-hidden">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">KIẾN TRÚC VẬN HÀNH</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Chu Trình Xử Lý Tự Động Khép Kín
                </h2>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                    Từ khi phát sinh nhu cầu đến khi hoàn tất giao dịch, toàn bộ dữ liệu được dẫn truyền mạch lạc qua API bảo mật.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Step 1 -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm font-bold text-primary font-mono px-2.5 py-1 rounded bg-primary/10 border border-primary/20">BƯỚC 01</span>
                        <span class="material-symbols-outlined text-slate-400 text-[22px]">sensors</span>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-white">1. Kích hoạt sự kiện (Trigger)</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Sự kiện phát sinh từ khách hàng: gửi form tư vấn, đặt lịch khám, thanh toán QR hoặc đặt mua hàng online.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm font-bold text-emerald-400 font-mono px-2.5 py-1 rounded bg-emerald-500/10 border border-emerald-500/20">BƯỚC 02</span>
                        <span class="material-symbols-outlined text-emerald-400 text-[22px]">rule</span>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-white">2. Xử lý quy tắc nghiệp vụ</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Hệ thống đối chiếu lịch trống, kiểm tra mã giảm giá, xác thực nội dung chuyển khoản và phân loại mức ưu tiên.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm font-bold text-indigo-400 font-mono px-2.5 py-1 rounded bg-indigo-500/10 border border-indigo-500/20">BƯỚC 03</span>
                        <span class="material-symbols-outlined text-indigo-400 text-[22px]">hub</span>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-white">3. Đồng bộ dữ liệu đa kênh</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Đẩy thông tin sang CRM quản lý, cập nhật lịch Google Calendar, sinh mã vận đơn đơn vị chuyển phát.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm font-bold text-amber-400 font-mono px-2.5 py-1 rounded bg-amber-500/10 border border-amber-500/20">BƯỚC 04</span>
                        <span class="material-symbols-outlined text-amber-400 text-[22px]">check_circle</span>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-white">4. Xác nhận &amp; Cảnh báo tức thì</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Bắn tin nhắn xác nhận Zalo ZNS cho khách hàng và thông báo trạng thái đơn về nhóm chat Telegram của quản lý.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION 03 — SO SÁNH TRƯỚC VÀ SAU KHI TỰ ĐỘNG HÓA ==================== -->
    <section class="space-y-6">
        <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
            <div>
                <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">HIỆU QUẢ THỰC TẾ</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight mt-1">
                    So Sánh Vận Hành: Thủ Công vs Tự Động Hóa
                </h2>
            </div>
            <span class="text-xs sm:text-sm text-slate-500">Đo lường trên quy mô doanh nghiệp vừa và nhỏ</span>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm sm:text-base">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-800 font-bold">
                        <th class="p-4 sm:p-5 w-1/4">Tiêu chí vận hành</th>
                        <th class="p-4 sm:p-5 w-3/8 text-rose-700 bg-rose-50/50">Quy trình thủ công truyền thống</th>
                        <th class="p-4 sm:p-5 w-3/8 text-emerald-800 bg-emerald-50/70">Quy trình tự động hóa Cửu Long</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <tr>
                        <td class="p-4 sm:p-5 font-bold text-slate-900">Thời gian phản hồi khách</td>
                        <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Từ 15 – 60 phút, phụ thuộc nhân sự trực máy tính.</td>
                        <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Dưới 3 giây, tự động 24/7 kể cả ban đêm và ngày nghỉ.</td>
                    </tr>
                    <tr>
                        <td class="p-4 sm:p-5 font-bold text-slate-900">Đối soát giao dịch chuyển khoản</td>
                        <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Xem tin nhắn biến động số dư, chụp màn hình gửi qua lại dễ sót.</td>
                        <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">VietQR động khớp đúng từng đồng, webhook tự động duyệt 100%.</td>
                    </tr>
                    <tr>
                        <td class="p-4 sm:p-5 font-bold text-slate-900">Tạo mã vận chuyển giao hàng</td>
                        <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Nhân viên copy địa chỉ, số điện thoại sang app GHTK mất 3-5 phút/đơn.</td>
                        <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Bắn thẳng đơn qua API, sinh mã vận đơn và in phiếu ngay lập tức.</td>
                    </tr>
                    <tr>
                        <td class="p-4 sm:p-5 font-bold text-slate-900">Báo cáo kinh doanh cho quản lý</td>
                        <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Tổng hợp Excel cuối tuần hoặc cuối tháng, dữ liệu chậm trễ.</td>
                        <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Bot Telegram/Zalo gửi báo cáo tổng hợp tự động mỗi tối lúc 21:00.</td>
                    </tr>
                    <tr>
                        <td class="p-4 sm:p-5 font-bold text-slate-900">Chi phí mở rộng quy mô</td>
                        <td class="p-4 sm:p-5 text-rose-600 bg-rose-50/20 leading-relaxed">Khi đơn hàng tăng phải thuê thêm nhân sự nhập liệu và trực máy.</td>
                        <td class="p-4 sm:p-5 text-emerald-700 font-semibold bg-emerald-50/30 leading-relaxed">Hệ thống tự co giãn theo tải, không phát sinh chi phí nhân sự lặp lại.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- ==================== SECTION 04 — HỆ SINH THÁI KẾT NỐI TÍCH HỢP ==================== -->
    <section class="space-y-6">
        <div class="text-center max-w-xl mx-auto space-y-1.5">
            <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">HỆ SINH THÁI KẾT NỐI</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight">
                Tích Hợp Sẵn Sàng Các Nền Tảng Phổ Biến
            </h2>
            <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                Kết nối mượt mà với những dịch vụ thanh toán, giao vận và kênh chăm sóc khách hàng hàng đầu tại Việt Nam.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0">QR</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">VietQR Pro</span>
                    <span class="text-xs text-slate-500">Thanh toán tự động</span>
                </div>
            </div>
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs shrink-0">Zalo</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">Zalo ZNS / OA</span>
                    <span class="text-xs text-slate-500">Tin nhắn thương hiệu</span>
                </div>
            </div>
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center font-bold text-xs shrink-0">Tele</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">Telegram Bot</span>
                    <span class="text-xs text-slate-500">Cảnh báo &amp; Báo cáo</span>
                </div>
            </div>
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center font-bold text-xs shrink-0">GHTK</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">Giao Hàng Tiết Kiệm</span>
                    <span class="text-xs text-slate-500">API bắn đơn tự động</span>
                </div>
            </div>
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-xs shrink-0">VTP</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">Viettel Post</span>
                    <span class="text-xs text-slate-500">Giao nhận toàn quốc</span>
                </div>
            </div>
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs shrink-0">GSheet</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">Google Workspace</span>
                    <span class="text-xs text-slate-500">Lịch &amp; Google Sheets</span>
                </div>
            </div>
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xs shrink-0">CRM</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">Hubspot / Zoho</span>
                    <span class="text-xs text-slate-500">Đồng bộ khách hàng</span>
                </div>
            </div>
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-xs shrink-0">API</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-slate-900">RESTful Webhook</span>
                    <span class="text-xs text-slate-500">Tùy biến phần mềm riêng</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION 05 — CÁC TÌNH HUỐNG ỨNG DỤNG THỰC TẾ ==================== -->
    <section class="space-y-6">
        <div class="border-b border-slate-200 pb-3 flex items-center justify-between">
            <div>
                <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">CASE STUDY THỰC TẾ</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#070f1e] tracking-tight mt-1">
                    Ví Dụ Luồng Tự Động Triển Khai Cho Khách Hàng
                </h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Case Study 1 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded bg-teal-100 text-teal-800 text-xs font-bold uppercase font-mono">PHÒNG KHÁM &amp; NHA KHOA</span>
                    <span class="text-xs sm:text-sm text-slate-500 font-mono">Tiết kiệm 2 nhân sự trực</span>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-[#070f1e]">Hệ thống nhắc lịch khám &amp; phân bổ bác sĩ tự động</h3>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Khách đặt hẹn qua website ➔ Bot tự động kiểm tra ca trực bác sĩ ➔ Gửi tin Zalo ZNS xác nhận ngày giờ &amp; vị trí phòng khám kèm mã QR check-in ➔ Tự động nhắc tái khám trước 24 giờ.
                </p>
                <div class="flex items-center gap-4 text-sm font-semibold text-slate-700 pt-3 border-t border-slate-200/60">
                    <span>Kết quả: <strong class="text-emerald-700">Giảm 80%</strong> tỷ lệ khách quên lịch hẹn.</span>
                </div>
            </div>

            <!-- Case Study 2 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded bg-indigo-100 text-indigo-800 text-xs font-bold uppercase font-mono">BÁN SỈ &amp; THƯƠNG MẠI</span>
                    <span class="text-xs sm:text-sm text-slate-500 font-mono">Xử lý 300+ đơn/ngày</span>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-[#070f1e]">Tự động đối soát VietQR &amp; đẩy đơn giao hàng</h3>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Đại lý quét mã VietQR chuyển khoản ➔ Webhook ngân hàng tự động đối soát nội dung &amp; số tiền trong 2 giây ➔ Tự động in phiếu gửi hàng tại kho &amp; cập nhật mã vận đơn GHTK cho khách.
                </p>
                <div class="flex items-center gap-4 text-sm font-semibold text-slate-700 pt-3 border-t border-slate-200/60">
                    <span>Kết quả: <strong class="text-emerald-700">0% sai sót</strong> đối soát công nợ, giao nhanh hơn 4 giờ.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION 06 — FAQ CÂU HỎI THƯỜNG GẶP ==================== -->
    <section class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-6">
        <div class="border-b border-slate-100 pb-3">
            <span class="text-xs sm:text-sm font-bold text-primary uppercase font-mono tracking-wider">GIẢI ĐÁP THẮC MẮC</span>
            <h2 class="text-xl sm:text-2xl font-extrabold text-[#070f1e] mt-1">Câu Hỏi Thường Gặp Về Tự Động Hóa Quy Trình</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm text-slate-600">
            <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                <h3 class="font-bold text-slate-900 text-base">Hệ thống cũ của chúng tôi có kết nối được không?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Được. Nếu hệ thống cũ có hỗ trợ API hoặc kết nối cơ sở dữ liệu, Cửu Long có thể viết module trung gian (middleware) để đồng bộ dữ liệu hai chiều mà không cần phải thay mới phần mềm cũ của bạn.</p>
            </div>
            <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                <h3 class="font-bold text-slate-900 text-base">Dữ liệu khách hàng và dòng tiền có an toàn không?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Chúng tôi sử dụng chuẩn mã hóa SSL/TLS, xác thực Webhook Secret Key và không lưu trữ thông tin nhạy cảm của tài khoản ngân hàng. Mọi giao dịch đều qua cổng trực tiếp của ngân hàng thụ hưởng.</p>
            </div>
            <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                <h3 class="font-bold text-slate-900 text-base">Thời gian triển khai một luồng tự động mất bao lâu?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Với các luồng phổ biến như VietQR, Zalo ZNS hoặc đẩy đơn GHTK, thời gian tích hợp thường từ 3 đến 5 ngày làm việc. Các luồng phức tạp đa hệ thống sẽ có lộ trình từ 1 đến 2 tuần.</p>
            </div>
            <div class="space-y-2 p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                <h3 class="font-bold text-slate-900 text-base">Khi có sự cố nghẽn mạng bên thứ 3 thì xử lý ra sao?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Hệ thống được thiết kế với cơ chế hàng đợi (Message Queue) và tự động thử lại (Auto-retry). Nếu bên thứ 3 tạm thời gián đoạn, dữ liệu sẽ được lưu an toàn và gửi lại ngay khi kết nối phục hồi.</p>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION 07 — BANNER CTA CHUYỂN ĐỔI CUỐI TRANG ==================== -->
    <x-banner.cta
        variant="centered"
        badge="TIẾT KIỆM THỜI GIAN VẬN HÀNH"
        title="Sẵn Sàng Tự Động Hóa Doanh Nghiệp Của Bạn?"
        description="Hãy chia sẻ với Cửu Long những khâu đang tốn nhiều thời gian thao tác thủ công nhất. Chúng tôi sẽ khảo sát và đề xuất sơ đồ tự động hóa phù hợp."
        :primaryCta="[
            'label' => 'Đăng ký khảo sát quy trình',
            'url' => route('contact') . '?service=' . urlencode('Tự động hóa quy trình'),
            'icon' => 'bolt'
        ]"
        :secondaryCta="[
            'label' => get_setting('company_phone', '0939.363.262'),
            'url' => 'tel:' . preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')),
            'icon' => 'call'
        ]"
    />

</x-ui.container>
@endsection
