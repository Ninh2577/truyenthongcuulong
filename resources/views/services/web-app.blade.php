@extends('layouts.app')

@section('title', 'Phát Triển Web App & Website Doanh Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Xây dựng Web App và Website doanh nghiệp may đo theo quy trình vận hành thực tế: chuẩn hóa dữ liệu, giải quyết luồng công việc thủ công, nền tảng ổn định và bảo mật.')

@section('content')
<div class="w-full bg-surface-low bg-dot-grid-subtle min-h-screen pt-28 pb-20">
    <x-ui.container class="flex flex-col gap-16 lg:gap-20">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Giải pháp & Dịch vụ', 'url' => '/dich-vu'],
                ['label' => 'Web & Web App']
            ]" />
        </div>

        <!-- ==================== SECTION 01: HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <x-ui.badge variant="info" class="gap-1.5 px-3.5 py-1">
                <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse" aria-hidden="true"></span>
                <span>CORE TECHNOLOGY CAPABILITY</span>
            </x-ui.badge>
            
            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                Xây Dựng Web App &amp; Website Doanh Nghiệp <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-amber-500">Theo Đúng Quy Trình Vận Hành Thực Tế</span>
            </h1>

            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-3xl">
                Doanh nghiệp đang gặp khó khăn khi quản lý qua nhiều bảng tính Excel rời rạc hoặc cần hệ thống tiếp nhận, đặt lịch và tra cứu trực tuyến? Chúng tôi xây dựng các ứng dụng web và website may đo bám sát bài toán nghiệp vụ cụ thể.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-headline text-xs sm:text-sm font-bold shadow-md shadow-navy-base/15 transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="#case-studies" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary font-headline text-xs sm:text-sm font-semibold shadow-xs hover:border-primary/40 transition-all">
                    <span>Xem dự án thực tế</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">visibility</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 02: BUSINESS PROBLEMS (KHI NÀO CẦN WEB APP?) ==================== -->
        <section class="flex flex-col gap-8">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-sky-700 font-bold uppercase tracking-wider">DẤU HIỆU NHẬN BIẾT</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Khi Nào Doanh Nghiệp Cần Web App Hoặc Hệ Thống Số?
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Một số bài toán vận hành phổ biến cho thấy giải pháp thủ công hoặc website tĩnh đơn thuần không còn đáp ứng được nhu cầu công việc:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-9 h-9 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[18px]">table_rows</span>
                    </div>
                    <h3 class="font-headline text-sm sm:text-base font-bold text-navy-base">Dữ liệu phân tán trên nhiều bảng tính</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Nhiều bộ phận cùng sử dụng Excel rời rạc dẫn đến sai sót số liệu, khó đồng bộ trạng thái xử lý và không kiểm soát được lịch sử chỉnh sửa.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[18px]">rule</span>
                    </div>
                    <h3 class="font-headline text-sm sm:text-base font-bold text-navy-base">Quy trình xử lý đơn từ &amp; đặt lịch thủ công</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Nhân sự phải tiếp nhận qua tin nhắn, điện thoại và nhập liệu tay gây chậm trễ, trùng lịch hoặc thất thoát thông tin khách hàng.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-9 h-9 rounded-lg bg-sky-50 text-sky-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[18px]">badge</span>
                    </div>
                    <h3 class="font-headline text-sm sm:text-base font-bold text-navy-base">Cần cổng phân quyền nhiều cấp người dùng</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Cần phân tách vai trò rõ ràng giữa quản trị viên, nhân viên nghiệp vụ, chuyên gia/bác sĩ và khách hàng truy cập hồ sơ cá nhân.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[18px]">hub</span>
                    </div>
                    <h3 class="font-headline text-sm sm:text-base font-bold text-navy-base">Cần kết nối API &amp; đồng bộ luồng dữ liệu</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Cần cổng kết nối để đẩy dữ liệu form trực tuyến về cơ sở dữ liệu nội bộ, thông báo trạng thái hoặc liên kết dịch vụ bên ngoài.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                    </div>
                    <h3 class="font-headline text-sm sm:text-base font-bold text-navy-base">Website hiện tại thiếu chuẩn mực kỹ thuật</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Trang web cũ tải chậm, giao diện không tương thích màn hình di động, thiếu cấu trúc schema chuẩn khiến việc tiếp cận khách hàng bị hạn chế.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col gap-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-sm">
                        <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                    </div>
                    <h3 class="font-headline text-sm sm:text-base font-bold text-navy-base">Phụ thuộc nền tảng đóng khó mở rộng</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Doanh nghiệp dùng các nền tảng đóng bị giới hạn tính năng khi nghiệp vụ mở rộng, muốn sở hữu mã nguồn và cơ sở dữ liệu độc lập.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 03: WHAT WE BUILD (PHẠM VI NĂNG LỰC THỰC TẾ) ==================== -->
        <section class="flex flex-col gap-8">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">PHẠM VI TRIỂN KHAI</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Các Hạng Mục Chúng Tôi Trực Tiếp Xây Dựng
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Mô tả chính xác các năng lực kỹ thuật đã được kiểm chứng qua sản phẩm thực tế:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Build 1: Web App Quản lý nội bộ & Đặt lịch -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col justify-between gap-4">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-sky-50 text-sky-700 flex items-center justify-center font-bold text-sm">01</span>
                            <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base">Ứng Dụng Web Quản Trị &amp; Đặt Lịch Nghiệp Vụ</h3>
                        </div>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Hệ thống phần mềm chạy trên trình duyệt hỗ trợ tiếp nhận yêu cầu, phân loại hồ sơ, điều phối lịch hẹn theo ca làm việc, tra cứu dữ liệu khách hàng và lưu trữ thông tin tập trung.
                        </p>
                        <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-sky-600">check</span>
                                <span>Phân quyền tài khoản theo chức năng (Bác sĩ, Lễ tân, Quản trị)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-sky-600">check</span>
                                <span>Luồng đặt lịch trực tuyến và quản lý trạng thái ca hẹn</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-sky-600">check</span>
                                <span>Tra cứu và lưu trữ hồ sơ trên cơ sở dữ liệu MySQL</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Build 2: Website Doanh Nghiệp May Đo -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col justify-between gap-4">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">02</span>
                            <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base">Website Doanh Nghiệp May Đo Chuẩn SEO</h3>
                        </div>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Website đại diện thương hiệu được thiết kế bố cục riêng theo văn hóa và ngành nghề kinh doanh, trang bị hệ thống quản trị nội dung dễ sử dụng và cấu trúc chuẩn cho bộ máy tìm kiếm.
                        </p>
                        <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-primary">check</span>
                                <span>Giao diện độc bản, tương thích hoàn toàn trên máy tính và điện thoại</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-primary">check</span>
                                <span>Tối ưu SEO On-page: Semantic HTML5, Schema JSON-LD, Sitemap</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-primary">check</span>
                                <span>CMS trực quan cho phép ban biên tập chủ động cập nhật nội dung</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Build 3: Cổng Thông Tin & Tra Cứu -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col justify-between gap-4">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm">03</span>
                            <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base">Cổng Thông Tin &amp; Tiếp Nhận Hồ Sơ Trực Tuyến</h3>
                        </div>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Xây dựng các cổng biểu mẫu tương tác cho phép khách hàng nộp hồ sơ, tải tài liệu, gửi yêu cầu báo giá hoặc tra cứu trạng thái xử lý hồ sơ thông qua mã định danh.
                        </p>
                        <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-emerald-600">check</span>
                                <span>Biểu mẫu động hỗ trợ đính kèm tệp tin và xác thực dữ liệu</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-emerald-600">check</span>
                                <span>Gửi thông báo tự động qua email hoặc liên kết tin nhắn</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-emerald-600">check</span>
                                <span>Xuất báo cáo dữ liệu định kỳ phục vụ kiểm tra nội bộ</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Build 4: Tích hợp API & Kết nối Dữ liệu -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col justify-between gap-4">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-sm">04</span>
                            <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base">Tích Hợp API &amp; Quản Trị Dữ Liệu Tập Trung</h3>
                        </div>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Liên kết website/web-app với các dịch vụ bên thứ ba như cổng thanh toán trực tuyến, dịch vụ gửi thư điện tử giao dịch, lưu trữ đám mây hoặc hệ thống thông tin sẵn có của đối tác.
                        </p>
                        <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-amber-600">check</span>
                                <span>Tích hợp cổng thanh toán trực tuyến nội địa phổ biến</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-amber-600">check</span>
                                <span>Đồng bộ dữ liệu form trực tuyến về Google Sheets hoặc webhook</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-amber-600">check</span>
                                <span>Cơ chế bảo mật dữ liệu, mã hóa thông tin nhạy cảm</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 04: PROOF (2 TECHNOLOGY CASE STUDIES THẬT) ==================== -->
        <section id="case-studies" class="flex flex-col gap-8 scroll-mt-28">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-200 pb-4">
                <div>
                    <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">MINH CHỨNG THỰC TẾ</span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                        Dự Án Công Nghệ Tiêu Biểu
                    </h2>
                    <p class="font-body text-slate-600 text-xs sm:text-sm mt-1">
                        Sản phẩm thực tế đã bàn giao và vận hành từ nguồn dự án của chúng tôi:
                    </p>
                </div>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 text-xs font-headline font-bold text-primary hover:underline shrink-0">
                    <span>Xem danh mục dự án</span>
                    <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($techCaseStudies as $case)
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between gap-6 hover:border-sky-500/50 hover:shadow-md transition-all">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 font-mono text-[11px] font-bold border border-sky-200/60">Technology Case</span>
                            <span class="font-mono text-xs text-slate-500">Năm {{ $case->year }}</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base leading-snug">
                                {{ $case->title }}
                            </h3>
                            @if($case->client_name)
                                <span class="text-xs font-mono text-slate-500 block mt-1">Đơn vị: {{ $case->client_name }}</span>
                            @endif
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col gap-2">
                            <span class="font-mono text-[11px] text-slate-500 font-bold uppercase">Bài toán &amp; Giải pháp:</span>
                            <p class="font-body text-xs text-slate-700 leading-relaxed">
                                {{ $case->summary }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-500">Mã nguồn độc quyền</span>
                        <a href="{{ route('projects.show', $case->slug) }}" class="inline-flex items-center gap-1 text-xs font-headline font-bold text-sky-700 hover:text-primary transition-colors">
                            <span>Xem case study</span>
                            <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-2 text-center py-10 text-slate-500 text-sm">
                    Thông tin case study đang được cập nhật.
                </div>
                @endforelse
            </div>
        </section>

        <!-- ==================== SECTION 05: TECHNOLOGY STACK (CHỈ CÔNG NGHỆ CÓ EVIDENCE) ==================== -->
        <section class="flex flex-col gap-6">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">CÔNG NGHỆ THỰC TẾ</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Nền Tảng Kỹ Thuật Ứng Dụng
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Chúng tôi lựa chọn các công nghệ ổn định, có cộng đồng phát triển rộng rãi và phù hợp nhất với tính khả thi lâu dài của dự án:
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xs text-sky-700 font-bold uppercase">Backend Framework</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Laravel / PHP</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Kiến trúc phân tầng rõ ràng, cơ chế bảo mật chống SQL Injection, CSRF, XSS và hỗ trợ xây dựng RESTful API chuẩn mực.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xs text-sky-700 font-bold uppercase">Cơ Sở Dữ Liệu</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">MySQL Database</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Hệ quản trị cơ sở dữ liệu quan hệ tiêu chuẩn, thiết kế lược đồ bảng tối ưu hóa chỉ mục và toàn vẹn dữ liệu.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xs text-sky-700 font-bold uppercase">Frontend &amp; Giao Diện</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Blade &amp; JavaScript</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Mã HTML ngữ nghĩa kết hợp Tailwind CSS và tương tác JavaScript / Alpine.js nhẹ nhàng, tải trang nhanh không phụ thuộc framework cồng kềnh.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xs text-sky-700 font-bold uppercase">Quản Trị Phân Quyền</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">RBAC &amp; Session Auth</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Kiểm soát quyền truy cập chi tiết theo vai trò tài khoản, bảo vệ đường dẫn nội bộ và quản lý phiên làm việc an toàn.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 06: 6-STEP PROCESS ==================== -->
        <section class="flex flex-col gap-8">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">QUY TRÌNH THỰC HIỆN</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                    Quy Trình Phát Triển Web App Chuẩn 6 Bước
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Đảm bảo tiến độ thực tế và chất lượng mã nguồn qua từng chặng nghiệm thu:
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xl font-black text-sky-600">01</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Khảo Sát Thực Tế</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Gặp gỡ trực tiếp hoặc online để ghi nhận các bước công việc thực tế cần số hóa.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xl font-black text-sky-600">02</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Phân Tích Nghiệp Vụ</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Vẽ sơ đồ quy trình, thiết kế cơ sở dữ liệu và thống nhất danh sách tính năng.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xl font-black text-sky-600">03</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Thiết Kế UI/UX</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Dựng wireframe và bản thiết kế giao diện chi tiết để duyệt trải nghiệm thao tác.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xl font-black text-sky-600">04</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Lập Trình Chức Năng</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Viết mã nguồn sạch trên Laravel, kết nối cơ sở dữ liệu và bảo mật phiên truy cập.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xl font-black text-sky-600">05</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Kiểm Thử QA/QC</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Chạy thử luồng nghiệp vụ với dữ liệu mẫu, rà soát lỗi giao diện trên nhiều thiết bị.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-2">
                    <span class="font-mono text-xl font-black text-sky-600">06</span>
                    <h3 class="font-headline text-sm font-bold text-navy-base">Bàn Giao &amp; Hướng Dẫn</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Triển khai máy chủ, bàn giao quyền quản trị, hướng dẫn sử dụng và bảo hành kỹ thuật.</p>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 07: FEATURED TEMPLATES (TÙY CHỌN TRIỂN KHAI NHANH) ==================== -->
        @if(isset($featuredTemplates) && $featuredTemplates->isNotEmpty())
        <section class="flex flex-col gap-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-200 pb-4">
                <div>
                    <span class="font-mono text-xs text-amber-600 font-bold uppercase tracking-wider">TÙY CHỌN TIẾT KIỆM THỜI GIAN</span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                        Triển Khai Website Nhanh Từ Kho Giao Diện Có Sẵn
                    </h2>
                    <p class="font-body text-slate-600 text-xs sm:text-sm mt-1">
                        Nếu nhu cầu hiện tại chỉ cần website giới thiệu hoặc bán hàng tiêu chuẩn, quý khách có thể chọn từ 39+ mẫu dựng sẵn:
                    </p>
                </div>
                <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-amber-700 hover:underline shrink-0">
                    <span>Xem tất cả 39+ mẫu</span>
                    <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($featuredTemplates as $tpl)
                @php
                    $thumb = $tpl->thumbnail ? asset('storage/' . $tpl->thumbnail) : null;
                @endphp
                <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-xs flex flex-col justify-between gap-3 group hover:border-amber-400 hover:shadow-md transition-all">
                    <div class="flex flex-col gap-2.5">
                        <div class="aspect-[16/10] rounded-xl bg-slate-100 overflow-hidden relative">
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $tpl->title }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <span class="material-symbols-outlined text-3xl">image</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="font-headline text-xs sm:text-sm font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2">
                            {{ $tpl->title }}
                        </h3>
                    </div>
                    <div class="pt-3 border-t border-slate-100">
                        <a href="{{ route('templates.index') }}?q={{ urlencode($tpl->title) }}" class="inline-flex items-center gap-1 text-xs font-headline font-bold text-amber-700 group-hover:text-primary transition-colors">
                            <span>Chi tiết mẫu</span>
                            <span class="material-symbols-outlined text-[14px]" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- ==================== SECTION 08: CTA ==================== -->
        <section class="rounded-3xl bg-navy-base text-white p-8 sm:p-12 text-center flex flex-col items-center gap-6 shadow-xl">
            <div class="max-w-2xl flex flex-col gap-3">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">BẮT ĐẦU DỰ ÁN</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                    Trao Đổi Về Hệ Thống Số Của Doanh Nghiệp Bạn
                </h2>
                <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Đội ngũ kỹ thuật của chúng tôi sẵn sàng lắng nghe bài toán và tư vấn cấu trúc phần mềm phù hợp nhất với quy mô thực tế.
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs sm:text-sm font-extrabold shadow-md shadow-amber-400/20 transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-headline text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span>Xem các dự án đã làm</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">visibility</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
