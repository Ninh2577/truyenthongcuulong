@extends('layouts.app')

@section('title', 'Bảng Giá & Khung Chi Phí Phần Mềm - Truyền Thông Cửu Long')
@section('meta_description', 'Khung chi phí minh bạch cho dịch vụ thiết kế Website, phát triển Web App và hệ thống số theo yêu cầu. Báo giá chi tiết theo phạm vi công việc.')

@section('content')
<div class="w-full bg-[#f8f9ff] min-h-screen pt-28 pb-20" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-14 lg:gap-18">
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Dịch vụ & Giải pháp', 'url' => '/dich-vu'],
                ['label' => 'Bảng giá & Khung chi phí']
            ]" />
        </div>

        <!-- ==================== HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                TRANSPARENT PRICING FRAMEWORK &bull; KHÔNG PHÁT SINH ẨN
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                Khung Chi Phí Phát Triển
                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                    Phần Mềm &amp; Nền Tảng Số
                </span>
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Phần mềm doanh nghiệp không phải là sản phẩm đóng gói sẵn trên kệ. Chi phí được tính toán minh bạch dựa trên đúng phạm vi tính năng, luồng nghiệp vụ và giá trị thực tế mang lại.
            </p>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200/90 text-xs text-slate-600 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Phân biệt rõ: <strong>Giá tham khảo cho mô hình chuẩn</strong> &amp; <strong>Báo giá chi tiết theo yêu cầu</strong></span>
            </div>
        </section>

        <!-- ==================== 3 KHUNG DỊCH VỤ CHÍNH ==================== -->
        <section class="flex flex-col gap-12">
            <!-- 01: WEBSITE -->
            <div class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 01</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Website Doanh Nghiệp &amp; Cổng Thông Tin
                        </h2>
                    </div>
                    <span class="text-xs text-slate-500">Thời gian triển khai: 1 &ndash; 3 tuần</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-xl bg-slate-50/70 border border-slate-200/70 space-y-4 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base font-bold text-[#070f1e]">Nền tảng triển khai nhanh</h3>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700">Giá tham khảo</span>
                            </div>
                            <div class="text-2xl font-extrabold text-[#070f1e]">
                                5.000.000 &ndash; 12.000.000 <span class="text-xs font-normal text-slate-500">VNĐ</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Lựa chọn cấu trúc giao diện chuẩn ngành từ thư viện có sẵn, tùy biến màu sắc thương hiệu và nạp dữ liệu thực tế.
                            </p>
                            <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                <li class="flex items-center gap-1.5">&bull; Tương thích màn hình máy tính và di động</li>
                                <li class="flex items-center gap-1.5">&bull; Tối ưu cấu trúc chuẩn SEO On-page</li>
                                <li class="flex items-center gap-1.5">&bull; Bàn giao CMS quản trị bài viết &amp; liên hệ</li>
                                <li class="flex items-center gap-1.5">&bull; Bảo hành kỹ thuật 12 tháng</li>
                            </ul>
                        </div>
                        <a href="{{ route('templates.index') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1 pt-2">
                            <span>Xem thư viện mẫu giao diện</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>

                    <div class="p-6 rounded-xl bg-slate-50/70 border border-slate-200/70 space-y-4 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base font-bold text-[#070f1e]">May đo thiết kế độc bản</h3>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary">Theo yêu cầu</span>
                            </div>
                            <div class="text-2xl font-extrabold text-[#070f1e]">
                                15.000.000 &ndash; 35.000.000 <span class="text-xs font-normal text-slate-500">VNĐ</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Thiết kế wireframe và UI/UX riêng biệt theo đúng bộ nhận diện và trải nghiệm khách hàng đặc thù của thương hiệu.
                            </p>
                            <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                <li class="flex items-center gap-1.5">&bull; Bản vẽ UI/UX độc quyền, không trùng lặp</li>
                                <li class="flex items-center gap-1.5">&bull; Tối ưu chỉ số Core Web Vitals (tốc độ cao)</li>
                                <li class="flex items-center gap-1.5">&bull; Cấu trúc Schema JSON-LD đa thực thể nâng cao</li>
                                <li class="flex items-center gap-1.5">&bull; Bàn giao mã nguồn hoàn chỉnh và tài liệu kỹ thuật</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact') }}?service={{ urlencode('Website may đo') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1 pt-2">
                            <span>Yêu cầu tư vấn may đo</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 02: WEB APP -->
            <div class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 02</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Web Application &amp; Hệ Thống Nghiệp Vụ
                        </h2>
                    </div>
                    <span class="text-xs text-slate-500">Thời gian triển khai: 3 &ndash; 8 tuần</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-xl bg-slate-50/70 border border-slate-200/70 space-y-4 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base font-bold text-[#070f1e]">Web App Nghiệp vụ tiêu chuẩn</h3>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700">Giá tham khảo</span>
                            </div>
                            <div class="text-2xl font-extrabold text-[#070f1e]">
                                25.000.000 &ndash; 50.000.000 <span class="text-xs font-normal text-slate-500">VNĐ</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Phù hợp bài toán tiếp nhận đơn từ, đặt lịch khám/dịch vụ, quản lý trạng thái hồ sơ nội bộ cho doanh nghiệp vừa và nhỏ.
                            </p>
                            <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                <li class="flex items-center gap-1.5">&bull; Phân quyền 2 &ndash; 3 nhóm tài khoản cơ bản</li>
                                <li class="flex items-center gap-1.5">&bull; Cơ sở dữ liệu MySQL quan hệ tập trung</li>
                                <li class="flex items-center gap-1.5">&bull; Thông báo email tự động và xuất báo cáo Excel</li>
                                <li class="flex items-center gap-1.5">&bull; Bảo mật session auth và mã hóa dữ liệu</li>
                            </ul>
                        </div>
                        <a href="{{ route('services.web-app') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1 pt-2">
                            <span>Xem mô hình Web App đã làm</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>

                    <div class="p-6 rounded-xl bg-slate-50/70 border border-slate-200/70 space-y-4 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base font-bold text-[#070f1e]">Web App Quy trình đa vai trò</h3>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary">Theo yêu cầu</span>
                            </div>
                            <div class="text-2xl font-extrabold text-[#070f1e]">
                                50.000.000 &ndash; 120.000.000 <span class="text-xs font-normal text-slate-500">VNĐ</span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Dành cho quy trình vận hành nhiều khâu phê duyệt, tích hợp API thanh toán/SMS và yêu cầu kiểm toán lịch sử chặt chẽ.
                            </p>
                            <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                <li class="flex items-center gap-1.5">&bull; Ma trận phân quyền chi tiết (Role-Based ACL)</li>
                                <li class="flex items-center gap-1.5">&bull; Nhật ký hoạt động toàn diện (Audit Log)</li>
                                <li class="flex items-center gap-1.5">&bull; Tích hợp API bên thứ 3 (Thanh toán, Zalo ZNS, Webhook)</li>
                                <li class="flex items-center gap-1.5">&bull; Dashboard biểu đồ KPI và báo cáo phân tích thời gian thực</li>
                            </ul>
                        </div>
                        <a href="{{ route('contact') }}?service={{ urlencode('Web App quy trình') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1 pt-2">
                            <span>Khảo sát bài toán quy trình</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 03: HỆ THỐNG THEO YÊU CẦU -->
            <div class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-4">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 03</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Hệ Thống Phần Mềm Doanh Nghiệp Theo Yêu Cầu (Custom ERP / CRM)
                        </h2>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-100 text-slate-700">Khảo sát &bull; Báo giá theo SRS</span>
                </div>

                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Đối với các hệ thống quản trị nội bộ phức hợp, việc đưa ra một con số cố định trước khi khảo sát là thiếu trách nhiệm kỹ thuật. Chúng tôi làm việc trực tiếp cùng ban lãnh đạo để lập <strong>Tài liệu đặc tả yêu cầu phần mềm (SRS - Software Requirements Specification)</strong>, bóc tách từng phân hệ và báo giá chi tiết theo từng mốc bàn giao.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60 space-y-1">
                        <span class="text-xs font-bold text-[#070f1e] block">1. Khảo sát &amp; Lập SRS</span>
                        <span class="text-xs text-slate-500">Phân tích luồng nghiệp vụ và lập danh sách tính năng cụ thể.</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60 space-y-1">
                        <span class="text-xs font-bold text-[#070f1e] block">2. Dự toán theo Module</span>
                        <span class="text-xs text-slate-500">Định lượng ngày công (man-days) cho từng hạng mục minh bạch.</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60 space-y-1">
                        <span class="text-xs font-bold text-[#070f1e] block">3. Nghiệm thu theo Chặng</span>
                        <span class="text-xs text-slate-500">Thanh toán theo tiến độ hoàn thành các mốc bàn giao thực tế.</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== CÁC YẾU TỐ ẢNH HƯỞNG CHI PHÍ ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Minh bạch định giá</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    4 Yếu Tố Ảnh Hưởng Đến Chi Phí Triển Khai
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Độ phức tạp quy trình</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Số lượng màn hình nghiệp vụ, công thức tính toán tự động và các trường hợp xử lý ngoại lệ phát sinh.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Quy mô phân quyền</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Số lượng cấp tài khoản, phạm vi giới hạn dữ liệu giữa các chi nhánh và yêu cầu giám sát kiểm toán.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Tích hợp hệ thống ngoài</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Độ phức tạp khi kết nối với cổng thanh toán ngân hàng, phần mềm hóa đơn điện tử hoặc cơ sở dữ liệu cũ.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Yêu cầu bảo mật &amp; tải</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Tiêu chuẩn bảo mật dữ liệu nhạy cảm, cơ chế mã hóa và khả năng đáp ứng lượng truy cập đồng thời lớn.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== QUY TRÌNH BÁO GIÁ ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Quy chuẩn làm việc</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Quy Trình Tiếp Nhận &amp; Báo Giá
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Tiếp nhận yêu cầu</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lắng nghe sơ bộ về hiện trạng và mục tiêu nghiệp vụ cần xây dựng của khách hàng.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Bóc tách phạm vi (SOW)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lập danh mục chức năng rõ ràng, xác định công nghệ phù hợp và thời gian hoàn thành.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Gửi bảng dự toán chi tiết</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Gửi báo giá chính thức kèm timeline tiến độ và các điều khoản nghiệm thu minh bạch.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Ký kết &amp; Triển khai</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ký kết hợp đồng pháp lý đầy đủ và bắt đầu thực hiện theo các mốc milestone cam kết.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== FAQ ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Hỏi đáp chi phí</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Các Câu Hỏi Thường Gặp Về Chi Phí
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Có phát sinh chi phí ngoài hợp đồng không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Không. Bảng dự toán của Cửu Long bám sát phạm vi công việc (Scope of Work) đã thống nhất bằng văn bản. Chúng tôi chỉ tính thêm phí khi khách hàng chủ động yêu cầu mở rộng tính năng mới ngoài phạm vi ban đầu.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Phương thức thanh toán như thế nào?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Thông thường được chia làm 3 đợt: Tạm ứng khi ký hợp đồng (40%), Thanh toán sau khi hoàn thành bản vẽ kiến trúc &amp; nghiệm thu Demo (30%), Thanh toán đợt cuối khi bàn giao mã nguồn chính thức (30%).
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Chi phí duy trì hàng năm bao gồm những gì?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Doanh nghiệp chỉ cần thanh toán phí duy trì tên miền (domain) và máy chủ lưu trữ (hosting/VPS) cho các nhà cung cấp hạ tầng. Mã nguồn thuộc quyền sở hữu vĩnh viễn của quý khách, không phải thuê bao hàng tháng.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Doanh nghiệp có nhận toàn bộ mã nguồn không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Có. 100% mã nguồn và cơ sở dữ liệu được bàn giao toàn vẹn cho khách hàng sau khi thanh lý hợp đồng. Quý khách hoàn toàn tự do lưu trữ và phát triển tiếp về sau.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== FINAL CTA ==================== -->
        <section class="rounded-2xl bg-[#070f1e] text-white p-8 sm:p-12 text-center flex flex-col items-center gap-5 shadow-xl">
            <span class="text-xs text-amber-400 font-bold uppercase tracking-wider">BẮT ĐẦU DỰ ÁN</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                Cần Dự Toán Chính Xác Cho Dự Án Của Bạn?
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                Hãy gửi cho chúng tôi mô tả yêu cầu hoặc bản phác thảo bài toán của bạn để nhận phân tích kỹ thuật và bảng dự toán chi tiết trong 24 giờ làm việc.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs sm:text-sm font-bold shadow-sm transition-all">
                    <span>Yêu cầu báo giá chi tiết</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">call</span>
                    <span>Tư vấn qua Hotline: {{ get_setting('company_phone', '0939.363.262') }}</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
