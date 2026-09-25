@extends('layouts.app')

@section('title', 'Web App & Hệ Thống Vận Hành Doanh Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Thiết kế và phát triển Web App và hệ thống số phù hợp với quy trình, dữ liệu và nhu cầu vận hành thực tế của doanh nghiệp.')

@section('content')
<div class="w-full bg-[#f8f9ff] min-h-screen pt-28 pb-20" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-16 lg:gap-20">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Dịch vụ & Giải pháp', 'url' => '/dich-vu'],
                ['label' => 'Web App & Hệ Thống']
            ]" />
        </div>

        <!-- ==================== HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                SOFTWARE ENGINEERING &bull; WEB APPLICATIONS
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                Web App &amp; Hệ Thống
                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                    Cho Quy Trình Vận Hành Doanh Nghiệp
                </span>
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Thiết kế và phát triển hệ thống phù hợp với quy trình, dữ liệu và nhu cầu vận hành thực tế.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all">
                    <span>Trao đổi bài toán</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="#architecture" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary text-xs sm:text-sm font-semibold shadow-xs hover:border-slate-300 transition-all">
                    <span>Xem kiến trúc hệ thống</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">schema</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 02 — KHI NÀO DOANH NGHIỆP CẦN WEB APP? ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Thời điểm chuyển đổi</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Khi Nào Doanh Nghiệp Cần Web App?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">4 tình huống nhận diện rõ rệt</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400">01</span>
                        <h3 class="text-base font-bold text-[#070f1e]">Excel không còn đủ</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Bảng tính bắt đầu chậm chạp, hay xảy ra xung đột khi nhiều người cùng mở, dễ bị ghi đè công thức và mất dấu vết sai lệch.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-[11px] text-slate-500">
                        Giải pháp: Cơ sở dữ liệu quan hệ MySQL tập trung.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400">02</span>
                        <h3 class="text-base font-bold text-[#070f1e]">Quy trình nhiều bước</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Một hồ sơ hoặc đơn hàng cần đi qua nhiều khâu: Tiếp nhận &rarr; Duyệt &rarr; Thực hiện &rarr; Nghiệm thu &rarr; Lưu trữ, đòi hỏi trạng thái minh bạch.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-[11px] text-slate-500">
                        Giải pháp: Luồng trạng thái workflow tự động hóa.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400">03</span>
                        <h3 class="text-base font-bold text-[#070f1e]">Dữ liệu phân tán</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Thông tin nằm rải rác trên Zalo, email, máy tính cá nhân của nhân sự, khiến lãnh đạo không thể nắm bắt báo cáo tức thời.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-[11px] text-slate-500">
                        Giải pháp: Dashboard quản trị và báo cáo tập trung.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400">04</span>
                        <h3 class="text-base font-bold text-[#070f1e]">Kiểm soát quyền &amp; lịch sử</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Cần giới hạn ai được xem mục gì, ai được sửa dữ liệu và toàn bộ lịch sử thao tác (audit trail) phải được ghi nhận rõ ràng.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100 text-[11px] text-slate-500">
                        Giải pháp: Phân quyền theo vai trò (RBAC) &amp; Activity Log.
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 03 — CHÚNG TÔI XÂY DỰNG GÌ? ==================== -->
        <section id="management-system" class="flex flex-col gap-6 scroll-mt-28">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Phạm vi kỹ thuật</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Chúng Tôi Xây Dựng Những Hệ Thống Nào?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">4 nhóm năng lực xây dựng chính</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Group 1: Website & Portal -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-primary">NHÓM 01</span>
                            <span class="text-xs text-slate-500">Cổng thông tin &amp; Doanh nghiệp</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e]">Website &amp; Enterprise Portal</h3>
                        <div class="space-y-2 text-xs text-slate-600">
                            <div><span class="font-bold text-slate-700">Vấn đề:</span> Website cũ nghèo nàn thông tin, tải chậm, không hỗ trợ tra cứu hoặc gửi yêu cầu số hóa.</div>
                            <div><span class="font-bold text-slate-700">Chức năng:</span> Quản lý bài viết, giới thiệu sản phẩm/dịch vụ, cổng tiếp nhận biểu mẫu, tra cứu thông tin trực tuyến.</div>
                            <div><span class="font-bold text-slate-700">Loại người dùng:</span> Khách hàng vãng lai, đối tác B2B, ban biên tập nội dung.</div>
                            <div><span class="font-bold text-slate-700">Dữ liệu:</span> Danh mục, bài viết, tài liệu số, thông tin liên hệ.</div>
                            <div><span class="font-bold text-slate-700">Kết quả đầu ra:</span> Website tải nhanh, chuẩn SEO, có hệ quản trị trực quan.</div>
                        </div>
                    </div>
                </div>

                <!-- Group 2: Web Application -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-primary">NHÓM 02</span>
                            <span class="text-xs text-slate-500">Ứng dụng nghiệp vụ</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e]">Web Application Nghiệp Vụ</h3>
                        <div class="space-y-2 text-xs text-slate-600">
                            <div><span class="font-bold text-slate-700">Vấn đề:</span> Nhân viên mất nhiều giờ nhập liệu thủ công giữa các bộ phận, thiếu cơ chế xác thực dữ liệu.</div>
                            <div><span class="font-bold text-slate-700">Chức năng:</span> Xử lý luồng dữ liệu nghiệp vụ, tính toán tự động, xác thực hồ sơ, xuất file PDF/Excel theo mẫu.</div>
                            <div><span class="font-bold text-slate-700">Loại người dùng:</span> Nhân viên nghiệp vụ, trưởng bộ phận, ban điều hành.</div>
                            <div><span class="font-bold text-slate-700">Dữ liệu:</span> Hồ sơ tiếp nhận, bảng biểu nghiệp vụ, trạng thái xử lý theo ca.</div>
                            <div><span class="font-bold text-slate-700">Kết quả đầu ra:</span> Phần mềm chạy trên trình duyệt, không cần cài đặt, vận hành ổn định.</div>
                        </div>
                    </div>
                </div>

                <!-- Group 3: Admin / Management System -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-primary">NHÓM 03</span>
                            <span class="text-xs text-slate-500">Hệ thống điều hành</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e]">Admin / Management System</h3>
                        <div class="space-y-2 text-xs text-slate-600">
                            <div><span class="font-bold text-slate-700">Vấn đề:</span> Không có một giao diện duy nhất để bao quát toàn bộ hoạt động kinh doanh và nhân sự.</div>
                            <div><span class="font-bold text-slate-700">Chức năng:</span> Bảng điều khiển (Dashboard) KPI số liệu thực tế, quản lý phân quyền vai trò (RBAC), kiểm soát nhật ký hệ thống.</div>
                            <div><span class="font-bold text-slate-700">Loại người dùng:</span> Ban giám đốc, quản trị viên hệ thống (Super Admin).</div>
                            <div><span class="font-bold text-slate-700">Dữ liệu:</span> Báo cáo tổng hợp, số lượng giao dịch, nhật ký truy cập (Audit Logs).</div>
                            <div><span class="font-bold text-slate-700">Kết quả đầu ra:</span> Trung tâm điều khiển số an toàn, bảo mật dữ liệu cấp doanh nghiệp.</div>
                        </div>
                    </div>
                </div>

                <!-- Group 4: Booking / Workflow System -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-primary">NHÓM 04</span>
                            <span class="text-xs text-slate-500">Điều phối &amp; Luồng công việc</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#070f1e]">Booking &amp; Workflow System</h3>
                        <div class="space-y-2 text-xs text-slate-600">
                            <div><span class="font-bold text-slate-700">Vấn đề:</span> Trùng lịch hẹn, sót yêu cầu của khách hàng khi phối hợp qua nhiều kênh liên lạc rời rạc.</div>
                            <div><span class="font-bold text-slate-700">Chức năng:</span> Đặt hẹn thông minh theo slot khả dụng, điều phối nhân sự/bác sĩ phụ trách, gửi thông báo tự động.</div>
                            <div><span class="font-bold text-slate-700">Loại người dùng:</span> Khách hàng đặt hẹn, lễ tân điều phối, chuyên gia/kỹ thuật viên.</div>
                            <div><span class="font-bold text-slate-700">Dữ liệu:</span> Lịch làm việc, ca trực, thông tin bệnh nhân/khách hàng, trạng thái xác nhận.</div>
                            <div><span class="font-bold text-slate-700">Kết quả đầu ra:</span> Luồng tiếp nhận trơn tru, giảm thiểu tỷ lệ vắng hẹn và nhầm lẫn.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 04 — ARCHITECTURE ==================== -->
        <section id="architecture" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Cấu trúc phân tầng</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Kiến Trúc Kỹ Thuật Hệ Thống
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Mô hình kiến trúc phân lớp chuẩn mực</span>
            </div>

            <!-- Architecture Box Diagram -->
            <div class="grid grid-cols-1 md:grid-cols-6 gap-3 pt-2">
                <!-- Layer 1 -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col items-center text-center gap-1.5">
                    <span class="text-[11px] font-bold text-slate-400">LỚP 1</span>
                    <span class="text-xs font-bold text-[#070f1e]">User</span>
                    <span class="text-[11px] text-slate-500">Khách hàng, Nhân viên, Quản lý qua Trình duyệt</span>
                </div>

                <!-- Layer 2 -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col items-center text-center gap-1.5">
                    <span class="text-[11px] font-bold text-slate-400">LỚP 2</span>
                    <span class="text-xs font-bold text-[#070f1e]">Frontend</span>
                    <span class="text-[11px] text-slate-500">Blade Templates, Tailwind CSS, Alpine.js</span>
                </div>

                <!-- Layer 3 -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col items-center text-center gap-1.5">
                    <span class="text-[11px] font-bold text-slate-400">LỚP 3</span>
                    <span class="text-xs font-bold text-[#070f1e]">Application</span>
                    <span class="text-[11px] text-slate-500">Routing, Middleware, Auth Session &amp; API Controller</span>
                </div>

                <!-- Layer 4 -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col items-center text-center gap-1.5">
                    <span class="text-[11px] font-bold text-slate-400">LỚP 4</span>
                    <span class="text-xs font-bold text-[#070f1e]">Business Logic</span>
                    <span class="text-[11px] text-slate-500">Xử lý nghiệp vụ, Validation, RBAC Permissions</span>
                </div>

                <!-- Layer 5 -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col items-center text-center gap-1.5">
                    <span class="text-[11px] font-bold text-slate-400">LỚP 5</span>
                    <span class="text-xs font-bold text-[#070f1e]">Database</span>
                    <span class="text-[11px] text-slate-500">MySQL InnoDB, Eloquent ORM, Indexing</span>
                </div>

                <!-- Layer 6 -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col items-center text-center gap-1.5">
                    <span class="text-[11px] font-bold text-slate-400">LỚP 6</span>
                    <span class="text-xs font-bold text-[#070f1e]">Admin / Reporting</span>
                    <span class="text-[11px] text-slate-500">Audit Logs, Báo cáo KPI, Xuất dữ liệu</span>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-600 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <span>Kiến trúc phân tầng bảo đảm tính an toàn dữ liệu, chống SQL Injection, CSRF và dễ dàng mở rộng chức năng.</span>
                <span class="font-semibold text-slate-700 shrink-0">Bảo mật chuẩn OWASP Top 10</span>
            </div>
        </section>

        <!-- ==================== SECTION 05 — TECHNOLOGY ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Công nghệ thực tế</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Ngăn Xếp Công Nghệ Chúng Tôi Sử Dụng
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Chỉ liệt kê các công nghệ dự án trực tiếp hỗ trợ</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">Laravel</span>
                    <span class="text-[11px] text-slate-500">PHP Framework</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">PHP 8.2+</span>
                    <span class="text-[11px] text-slate-500">Ngôn ngữ xử lý</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">MySQL</span>
                    <span class="text-[11px] text-slate-500">Hệ quản trị CSDL</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">REST API</span>
                    <span class="text-[11px] text-slate-500">Giao tiếp dịch vụ</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">Blade</span>
                    <span class="text-[11px] text-slate-500">Template Engine</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">Alpine.js</span>
                    <span class="text-[11px] text-slate-500">Tương tác UI gọn nhẹ</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">JavaScript</span>
                    <span class="text-[11px] text-slate-500">ES6+ Modules</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">Tailwind CSS</span>
                    <span class="text-[11px] text-slate-500">Thiết kế đáp ứng</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">RBAC</span>
                    <span class="text-[11px] text-slate-500">Phân quyền vai trò</span>
                </div>
                <div class="p-4 rounded-xl bg-white border border-slate-200/90 text-center space-y-1">
                    <span class="text-xs font-bold text-[#070f1e] block">Mulish</span>
                    <span class="text-[11px] text-slate-500">Typography đồng bộ</span>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 06 — CASE STUDIES ==================== -->
        <section id="case-studies" class="flex flex-col gap-6 scroll-mt-28">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Minh chứng triển khai</span>
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
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-slate-700">{{ $case->client_name ?: 'Đơn vị triển khai' }}</span>
                            <span class="text-xs text-slate-400">Năm {{ $case->year ?: '2024' }}</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] leading-snug">{{ $case->title }}</h3>

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
                                <span class="text-slate-600 ml-1">{{ $case->tech_stack ?: 'Laravel, MySQL, REST API, Tailwind CSS, RBAC' }}</span>
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
                            <span class="text-xs font-bold text-slate-700">Phòng Khám Đa Khoa Gia Phước</span>
                            <span class="text-xs text-slate-400">Y tế &bull; Đặt lịch</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] leading-snug">Hệ Thống Đặt Hẹn &amp; Quản Lý Hồ Sơ Tiếp Nhận</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Xây dựng Web App đặt lịch khám bệnh trực tuyến kết hợp module quản lý hồ sơ nội bộ cho bác sĩ và lễ tân trên nền Laravel &amp; MySQL.</p>
                    </div>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-slate-700">Nha Khoa Nụ Cười</span>
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
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tiêu chuẩn thực thi</span>
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
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Khảo sát nghiệp vụ</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Phân tích luồng công việc hiện tại, các trường dữ liệu cần lưu trữ và các trường hợp ngoại lệ.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Thiết kế kiến trúc &amp; UI</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Thiết kế lược đồ cơ sở dữ liệu và giao diện làm việc trực quan cho từng vai trò người dùng.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Lập trình &amp; Kiểm thử</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Xây dựng theo từng module chức năng, kiểm thử logic tính toán và kiểm tra bảo mật truy cập.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">04</span>
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
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Hỏi đáp kỹ thuật</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Các Câu Hỏi Thường Gặp Về Web App
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Có nhận xây hệ thống theo yêu cầu không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Có. 100% ứng dụng Web App của Cửu Long được thiết kế may đo từ đầu theo đúng quy trình và đặc thù dữ liệu thực tế của doanh nghiệp, không ép dùng template có sẵn.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Có tích hợp API không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Có. Hệ thống hỗ trợ xây dựng và kết nối RESTful API với các cổng thanh toán (VNPay, MoMo), dịch vụ SMS/Zalo ZNS, Google Sheets hoặc phần mềm kế toán/ERP hiện có.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Có hệ thống quản trị không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Có. Mỗi sản phẩm đều đi kèm bảng điều khiển Admin riêng biệt với chức năng phân quyền chi tiết (RBAC) theo từng phòng ban và ghi nhận nhật ký thao tác.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Có bảo trì sau khi bàn giao không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Có. Chúng tôi cung cấp chính sách bảo hành kỹ thuật 12 tháng, sao lưu dữ liệu định kỳ và hỗ trợ nâng cấp module khi quy mô nghiệp vụ mở rộng.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2 md:col-span-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Chi phí phát triển Web App phụ thuộc vào đâu?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Chi phí được tính dựa trên số lượng module chức năng, độ phức tạp của luồng xử lý dữ liệu, yêu cầu tích hợp API bên ngoài và mức độ tùy biến giao diện, không phát sinh chi phí ẩn.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 09 — FINAL CTA ==================== -->
        <section class="rounded-2xl bg-[#070f1e] text-white p-8 sm:p-12 text-center flex flex-col items-center gap-5 shadow-xl">
            <span class="text-xs text-amber-400 font-bold uppercase tracking-wider">BẮT ĐẦU DỰ ÁN</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                Mô Tả Bài Toán Của Bạn
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                Hãy cho chúng tôi biết về quy trình vận hành hoặc điểm nghẽn doanh nghiệp của bạn đang gặp phải. Đội ngũ kỹ thuật sẽ phân tích và đề xuất phương án kiến trúc tối ưu.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs sm:text-sm font-bold shadow-sm transition-all">
                    <span>Mô tả bài toán của bạn</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">call</span>
                    <span>Hotline: {{ get_setting('company_phone', '0939.363.262') }}</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
