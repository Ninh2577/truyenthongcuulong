{{-- 
    UI-REBUILD-09: B2B SOFTWARE CASE STUDY — GIA PHƯỚC CLINIC WEB-APP
    Hồ sơ năng lực kỹ thuật: Ứng dụng Quản lý & Đặt lịch Phòng khám Đa khoa
    Tuân thủ nghiêm ngặt: Không số liệu giả, kiến trúc 4 tầng chuẩn xác, công nghệ thực tế.
--}}

<!-- Section 01: Project Hero -->
<section class="relative w-full pt-28 pb-14 lg:pt-36 lg:pb-16 bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-400">/</span>
            <a href="{{ route('projects.index') }}" class="hover:text-primary transition-colors">Dự án &amp; Case Studies</a>
            <span class="text-slate-400">/</span>
            <span class="text-navy-base font-bold truncate max-w-sm" aria-current="page">{{ $caseStudy->title }}</span>
        </nav>

        <div class="flex flex-col gap-5 max-w-4xl">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold border border-sky-200/80 w-fit">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>B2B SOFTWARE CASE STUDY &bull; HỆ THỐNG QUẢN TRỊ Y TẾ</span>
            </div>

            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                {{ $caseStudy->title }}
            </h1>

            <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed">
                Xây dựng hệ thống Web-App quản trị y tế tập trung, tối ưu quy trình tiếp nhận đặt lịch trực tuyến và quản lý hồ sơ khám chữa bệnh bảo mật cho Phòng Khám Đa Khoa Gia Phước.
            </p>

            <!-- Project Meta Strip -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 mt-2 border-t border-slate-200/80 font-mono text-xs">
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Khách hàng</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->client_name }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Loại sản phẩm</span>
                    <span class="font-bold text-sky-700 mt-0.5 block font-headline">Healthcare Web-App</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Thời gian</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->year ?: '2024' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Trạng thái</span>
                    <span class="font-bold text-emerald-600 mt-0.5 flex items-center gap-1 font-headline">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Đã triển khai
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Case Study Content Container -->
<div class="w-full bg-surface py-14 lg:py-20 border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 lg:space-y-20">

        <!-- Featured Interface Hero Mockup -->
        <div class="rounded-3xl overflow-hidden bg-slate-900 border border-slate-200 shadow-xl relative">
            <div class="p-3 bg-slate-950 border-b border-white/10 flex items-center justify-between text-xs font-mono text-slate-400">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-rose-500/80 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block"></span>
                    <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block"></span>
                    <span class="ml-2 text-slate-300 font-semibold text-[11px]">app.phongkhamgiaphuoc.vn/admin/dashboard</span>
                </div>
                <span class="text-[10px] text-emerald-400 font-bold px-2 py-0.5 rounded bg-emerald-950 border border-emerald-500/30">
                    LIVE SYSTEM
                </span>
            </div>
            <div class="aspect-[16/9] w-full bg-slate-900 overflow-hidden flex items-center justify-center">
                <img src="{{ asset('images/projects/clinic-app-mockup.jpg') }}" 
                     alt="Giao diện Web-App Quản lý Phòng khám Gia Phước" 
                     class="w-full h-full object-cover"
                     onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'">
            </div>
        </div>

        <!-- Section 02: Business Context & Needs -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 text-primary font-mono text-xs font-bold border border-orange-200">
                <span>01. BỐI CẢNH &amp; BÀI TOÁN DOANH NGHIỆP</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Thách Thức Trong Quy Trình Vận Hành Tiếp Nhận Khám Chữa Bệnh
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-4xl">
                Phòng Khám Đa Khoa Gia Phước là cơ sở y tế tiếp nhận lượt bệnh nhân hàng ngày trên nhiều chuyên khoa. Trước khi xây dựng hệ thống số, quy trình tiếp đón và quản trị dữ liệu gặp phải các rào cản vận hành:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-mono font-bold text-sm">
                        01
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Thao Tác Ghi Nhận Thủ Công</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Quy trình tiếp nhận bệnh nhân qua sổ sách và bảng tính excel rời rạc dễ dẫn đến sai sót đối soát và tốn nhiều thời gian nhập liệu giờ cao điểm.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-mono font-bold text-sm">
                        02
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Khó Tra Cứu Lịch Sử Khám</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Hồ sơ khám bệnh lưu trữ thủ công gây khó khăn trong việc phối hợp giữa nhân viên lễ tân, điều dưỡng và các bác sĩ chuyên khoa khác nhau.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center font-mono font-bold text-sm">
                        03
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Thiếu Kênh Đặt Lịch Tự Động</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Bệnh nhân không có công cụ đặt lịch hẹn trực tuyến chủ động, dẫn đến tình trạng dồn ứ khung giờ khám và khó phân bổ nhân sự y tế.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 03: The Implemented Solution -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-mono text-xs font-bold border border-emerald-200">
                <span>02. GIẢI PHÁP TRIỂN KHAI</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Hệ Thống Web-App Quản Trị Y Tế &amp; Đặt Lịch Trực Tuyến
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-4xl">
                Cửu Long thiết kế và phát triển nền tảng Web-App chuyên biệt cho môi trường y khoa, số hóa toàn diện quy trình tiếp nhận, điều phối và lưu trữ hồ sơ:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <!-- Module 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">calendar_month</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Phân Hệ Đặt Lịch Hẹn Trực Tuyến</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Cung cấp biểu mẫu đặt lịch trực tuyến cho bệnh nhân theo chuyên khoa, bác sĩ và khung giờ khám; tự động gửi mã lịch hẹn và thông báo nhắc lịch.
                        </p>
                    </div>
                </div>

                <!-- Module 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">badge</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Quản Lý Tiếp Đón &amp; Hồ Sơ Bệnh Nhân</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Số hóa hồ sơ thông tin hành chính, lịch sử khám bệnh, kết quả xét nghiệm và trạng thái hàng chờ khám theo thời gian thực.
                        </p>
                    </div>
                </div>

                <!-- Module 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">medical_services</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Giao Diện Bác Sĩ &amp; Phòng Khám</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Bảng điều khiển cho phép bác sĩ tra cứu nhanh tiền sử bệnh lý, cập nhật chỉ định cận lâm sàng và kê đơn thuốc chuẩn hóa.
                        </p>
                    </div>
                </div>

                <!-- Module 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">analytics</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Báo Cáo Thống Kê Lượt Tiếp Nhận</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Hệ thống tổng hợp báo cáo số lượng bệnh nhân tiếp nhận theo ngày, theo chuyên khoa và tỷ lệ hoàn thành lịch hẹn phục vụ quản trị nội bộ.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 04: System Architecture -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">account_tree</span>
                <span>03. KIẾN TRÚC HỆ THỐNG &bull; SYSTEM ARCHITECTURE</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Mô Hình Kiến Trúc Phân Tầng An Toàn &amp; Mở Rộng
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-4xl">
                Hệ thống được thiết kế theo mô hình phân tầng module rõ ràng, đảm bảo tách biệt giữa tầng hiển thị, tầng xử lý nghiệp vụ y tế và tầng cơ sở dữ liệu:
            </p>

            <!-- Architecture Diagram Container -->
            <div class="p-6 sm:p-8 rounded-3xl bg-slate-900 text-white border border-white/10 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-xs font-mono">
                    <!-- Layer 1 -->
                    <div class="p-4 rounded-2xl bg-slate-800/80 border border-sky-500/30 flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="text-sky-400 font-bold block text-[10px] uppercase tracking-wider">TẦNG 01: PRESENTATION</span>
                            <div class="font-headline font-bold text-sm text-white">Client Interface</div>
                            <p class="text-slate-300 font-body text-[11px] leading-relaxed">
                                Responsive Web UI cho máy tính phòng khám &amp; di động bệnh nhân. Tối ưu UX tiếp nhận nhanh.
                            </p>
                        </div>
                        <span class="mt-4 pt-2 border-t border-white/10 text-[10px] text-slate-400">Blade &bull; Tailwind CSS</span>
                    </div>

                    <!-- Layer 2 -->
                    <div class="p-4 rounded-2xl bg-slate-800/80 border border-indigo-500/30 flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="text-indigo-400 font-bold block text-[10px] uppercase tracking-wider">TẦNG 02: APPLICATION</span>
                            <div class="font-headline font-bold text-sm text-white">Business Logic</div>
                            <p class="text-slate-300 font-body text-[11px] leading-relaxed">
                                Xử lý đặt lịch, kiểm tra trùng lặp khung giờ, điều phối bác sĩ và thông báo tự động.
                            </p>
                        </div>
                        <span class="mt-4 pt-2 border-t border-white/10 text-[10px] text-slate-400">Laravel Core &bull; Service Layer</span>
                    </div>

                    <!-- Layer 3 -->
                    <div class="p-4 rounded-2xl bg-slate-800/80 border border-amber-500/30 flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="text-amber-400 font-bold block text-[10px] uppercase tracking-wider">TẦNG 03: SECURITY</span>
                            <div class="font-headline font-bold text-sm text-white">RBAC &amp; Access Control</div>
                            <p class="text-slate-300 font-body text-[11px] leading-relaxed">
                                Phân quyền vai trò: Bác sĩ, Lễ tân, Quản trị viên. Ghi log truy vết thao tác nhạy cảm.
                            </p>
                        </div>
                        <span class="mt-4 pt-2 border-t border-white/10 text-[10px] text-slate-400">Auth Middleware &bull; Audit Trail</span>
                    </div>

                    <!-- Layer 4 -->
                    <div class="p-4 rounded-2xl bg-slate-800/80 border border-emerald-500/30 flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="text-emerald-400 font-bold block text-[10px] uppercase tracking-wider">TẦNG 04: STORAGE</span>
                            <div class="font-headline font-bold text-sm text-white">Database &amp; Storage</div>
                            <p class="text-slate-300 font-body text-[11px] leading-relaxed">
                                Cơ sở dữ liệu quan hệ lưu trữ bệnh nhân, lịch hẹn, hồ sơ y tế với cơ chế backup định kỳ.
                            </p>
                        </div>
                        <span class="mt-4 pt-2 border-t border-white/10 text-[10px] text-slate-400">MySQL &bull; Encrypted Storage</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 05: Verified Technology Stack -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">terminal</span>
                <span>04. CÔNG NGHỆ XÁC MINH &bull; TECH STACK</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Công Nghệ Sử Dụng Trong Dự Án
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-4xl">
                Cam kết chỉ liệt kê các công nghệ thực tế được triển khai trong mã nguồn và môi trường vận hành của dự án:
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Framework</span>
                    <div class="font-headline font-bold text-sm text-navy-base">Laravel (PHP 8.2+)</div>
                    <p class="font-body text-[11px] text-slate-500">Kiến trúc MVC vững chắc</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Frontend</span>
                    <div class="font-headline font-bold text-sm text-navy-base">Blade &amp; Tailwind CSS</div>
                    <p class="font-body text-[11px] text-slate-500">Giao diện nhẹ, tối ưu tải</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Cơ sở dữ liệu</span>
                    <div class="font-headline font-bold text-sm text-navy-base">MySQL Relational DB</div>
                    <p class="font-body text-[11px] text-slate-500">Chuẩn hóa dữ liệu y tế</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Bảo mật</span>
                    <div class="font-headline font-bold text-sm text-navy-base">RBAC &amp; HTTPS</div>
                    <p class="font-body text-[11px] text-slate-500">Phân quyền đa tầng bảo mật</p>
                </div>
            </div>
        </section>

        <!-- Section 06: Deliverables -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">inventory_2</span>
                <span>05. SẢN PHẨM BÀN GIAO &bull; DELIVERABLES</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Phạm Vi Sản Phẩm Thực Tế Bàn Giao
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-2">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-sky-600">devices</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Hệ Thống Web-App</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Ứng dụng web hoàn chỉnh chạy trên máy chủ VPS, phân quyền tài khoản cho nhân sự phòng khám.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-indigo-600">code</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Mã Nguồn Bàn Giao</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Toàn bộ mã nguồn Laravel sạch sẽ, có tài liệu cấu hình môi trường và kịch bản deploy.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-emerald-600">description</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Tài Liệu Vận Hành</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tài liệu hướng dẫn sử dụng chi tiết cho từng vai trò: Lễ tân, Bác sĩ và Quản trị viên hệ thống.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-amber-600">support_agent</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Bảo Hành Kỹ Thuật</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Cam kết hỗ trợ xử lý sự cố kỹ thuật, cập nhật bản vá bảo mật và sao lưu dữ liệu định kỳ.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 07: Related Case Studies & Navigation -->
        <section class="space-y-6 pt-6 border-t border-slate-200/80">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">
                        DỰ ÁN CÙNG LĨNH VỰC
                    </span>
                    <h2 class="font-headline text-2xl font-bold text-navy-base">
                        Khám Phá Thêm Case Study Khác
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}" class="text-xs font-headline font-bold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem toàn bộ dự án</span>
                    <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                @foreach($relatedCases as $relCase)
                    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex items-center justify-between gap-4 group hover:border-primary/40 transition-colors">
                        <div>
                            <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">{{ $relCase->client_name ?: 'Khách hàng' }} &bull; {{ $relCase->year ?: '2024' }}</span>
                            <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors mt-1">
                                {{ $relCase->title }}
                            </h3>
                            <p class="font-body text-xs text-slate-500 line-clamp-1 mt-1">
                                {{ $relCase->summary }}
                            </p>
                        </div>
                        <a href="{{ route('projects.show', $relCase->slug) }}" 
                           class="w-10 h-10 rounded-xl bg-slate-50 text-slate-700 group-hover:bg-primary group-hover:text-white flex items-center justify-center shrink-0 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Section 08: Project Final CTA -->
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-[#070F1E] to-[#0C1A30] text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-2 text-center md:text-left max-w-xl">
                <span class="text-amber-400 font-mono text-xs font-bold uppercase tracking-wider block">
                    BẮT ĐẦU DỰ ÁN CỦA BẠN
                </span>
                <h3 class="font-headline text-2xl sm:text-3xl font-extrabold text-white">
                    Doanh Nghiệp Của Bạn Đang Cần Xây Dựng Hệ Thống Phần Mềm?
                </h3>
                <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Liên hệ với đội ngũ kỹ sư phần mềm Cửu Long để phân tích bài toán nghiệp vụ và nhận đề xuất giải pháp kỹ thuật phù hợp.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                <a href="{{ route('contact', ['service' => 'Web App Quản Trị']) }}" 
                   class="btn-primary-cta px-8 py-3.5 rounded-full bg-primary hover:bg-orange-600 text-white font-headline text-xs font-bold shadow-md transition-all">
                    <span>Bắt đầu dự án</span>
                </a>
                <a href="{{ route('services.web-app') }}" 
                   class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all border border-white/20">
                    <span>Giải pháp Web-App</span>
                </a>
            </div>
        </div>

    </div>
</div>
