@extends('layouts.app')

@section('title', 'Dịch Vụ & Giải Pháp Công Nghệ - Truyền Thông Cửu Long')
@section('meta_description', 'Giải quyết bài toán vận hành doanh nghiệp bằng công nghệ phù hợp: Web App, Website, Hệ thống quản trị, SEO & Media hỗ trợ.')

@section('content')
<div class="w-full bg-[#f8f9ff] min-h-screen pt-28 pb-20" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-16 lg:gap-20">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Dịch vụ & Giải pháp']
            ]" />
        </div>

        <!-- ==================== SECTION 01 — HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                DỊCH VỤ &amp; GIẢI PHÁP
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                Giải Quyết Bài Toán Vận Hành
                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                    Bằng Công Nghệ Phù Hợp
                </span>
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Web App &bull; Website &bull; Hệ thống quản trị &bull; SEO / Digital &bull; Media
            </p>
            <p class="text-slate-500 text-xs sm:text-sm max-w-xl">
                Chúng tôi tập trung xây dựng phần mềm và nền tảng số xuất phát từ đúng thực trạng dữ liệu, quy trình làm việc và mục tiêu kinh doanh của doanh nghiệp.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary text-xs sm:text-sm font-semibold shadow-xs hover:border-slate-300 transition-all">
                    <span>Xem dự án</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">visibility</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 02 — BUSINESS PROBLEMS ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Thực trạng vận hành</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Doanh Nghiệp Của Bạn Đang Đối Mặt Với Vấn Đề Gì?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">5 nhóm bài toán thường gặp</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Problem 1 -->
                <a href="{{ route('services.web-app') }}" class="p-5 rounded-xl bg-white border border-slate-200/90 hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400 group-hover:text-primary transition-colors">01</span>
                        <h3 class="text-sm font-bold text-[#070f1e] group-hover:text-primary transition-colors leading-snug">
                            Vận hành bằng Excel quá tải
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            File phân tán, nhập trùng, khó phân quyền và không có lịch sử chỉnh sửa.
                        </p>
                    </div>
                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                        <span>Web App quản trị</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 2 -->
                <a href="{{ route('templates.index') }}" class="p-5 rounded-xl bg-white border border-slate-200/90 hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400 group-hover:text-primary transition-colors">02</span>
                        <h3 class="text-sm font-bold text-[#070f1e] group-hover:text-primary transition-colors leading-snug">
                            Cần website doanh nghiệp chuẩn
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Website cũ tải chậm, giao diện lỗi thời, không tạo được uy tín khi tiếp cận đối tác.
                        </p>
                    </div>
                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                        <span>Nền tảng website</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 3 -->
                <a href="{{ route('services.web-app') }}" class="p-5 rounded-xl bg-white border border-slate-200/90 hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400 group-hover:text-primary transition-colors">03</span>
                        <h3 class="text-sm font-bold text-[#070f1e] group-hover:text-primary transition-colors leading-snug">
                            Cần hệ thống quản lý riêng
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Phần mềm đóng gói trên thị trường không khớp với đặc thù nghiệp vụ nội bộ.
                        </p>
                    </div>
                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                        <span>Hệ thống theo yêu cầu</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 4 -->
                <a href="{{ route('services.web-app') }}" class="p-5 rounded-xl bg-white border border-slate-200/90 hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400 group-hover:text-primary transition-colors">04</span>
                        <h3 class="text-sm font-bold text-[#070f1e] group-hover:text-primary transition-colors leading-snug">
                            Cần tự động hóa quy trình
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Nhân sự mất quá nhiều thời gian cho việc copy dữ liệu, xuất báo cáo và đối soát.
                        </p>
                    </div>
                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                        <span>Tự động hóa luồng việc</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </div>
                </a>

                <!-- Problem 5 -->
                <a href="{{ route('services.marketing') }}" class="p-5 rounded-xl bg-white border border-slate-200/90 hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-slate-400 group-hover:text-primary transition-colors">05</span>
                        <h3 class="text-sm font-bold text-[#070f1e] group-hover:text-primary transition-colors leading-snug">
                            Cần tăng trưởng hiện diện số
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Có website nhưng không có khách hàng truy cập tìm kiếm, chi phí ads ngày càng đắt.
                        </p>
                    </div>
                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                        <span>SEO &amp; Tăng trưởng số</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 03 — TECHNOLOGY SOLUTIONS ==================== -->
        <section class="flex flex-col gap-10">
            <!-- 3 Nhóm Công Nghệ Cốt Lõi -->
            <div id="tech-solutions" class="flex flex-col gap-6">
                <div class="border-b border-slate-200 pb-3 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Cấu trúc giải pháp</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                            Nhóm Giải Pháp Công Nghệ &amp; Nền Tảng Số
                        </h2>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-100 text-slate-700">Trọng tâm</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tech Solution 1 -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="space-y-3">
                            <span class="text-xs font-bold text-slate-400">01</span>
                            <h3 class="text-lg font-bold text-[#070f1e]">Web App &amp; Hệ Thống Doanh Nghiệp</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Xây dựng ứng dụng quản lý nội bộ, tiếp nhận yêu cầu, xử lý quy trình nhiều bước và phân quyền dữ liệu chặt chẽ trên nền Laravel/PHP hiện đại.
                            </p>
                            <div class="text-xs text-slate-500 space-y-1 pt-1">
                                <div><span class="font-semibold text-slate-700">Công nghệ:</span> Laravel, PHP, MySQL, REST API, RBAC</div>
                                <div><span class="font-semibold text-slate-700">Thực chứng:</span> Phòng khám Gia Phước, Nha khoa Nụ Cười</div>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:underline">
                                <span>Chi tiết giải pháp Web App</span>
                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tech Solution 2 -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="space-y-3">
                            <span class="text-xs font-bold text-slate-400">02</span>
                            <h3 class="text-lg font-bold text-[#070f1e]">Website &amp; Digital Platform</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Website giới thiệu doanh nghiệp và cổng thông tin được tối ưu kiến trúc chuẩn SEO, tốc độ tải nhanh, chuẩn thiết kế hiện đại trên máy tính và di động.
                            </p>
                            <div class="text-xs text-slate-500 space-y-1 pt-1">
                                <div><span class="font-semibold text-slate-700">Hình thức:</span> May đo theo nhận diện hoặc thư viện triển khai nhanh</div>
                                <div><span class="font-semibold text-slate-700">Thực chứng:</span> Live demo phân loại theo ngành nghề</div>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:underline">
                                <span>Xem thư viện nền tảng website</span>
                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tech Solution 3 -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="space-y-3">
                            <span class="text-xs font-bold text-slate-400">03</span>
                            <h3 class="text-lg font-bold text-[#070f1e]">SEO / Growth Technology</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Tối ưu cấu trúc kỹ thuật On-page, dữ liệu có cấu trúc Schema JSON-LD, kết nối công cụ phân tích GA4 và Google Ads định hướng chuyển đổi thực.
                            </p>
                            <div class="text-xs text-slate-500 space-y-1 pt-1">
                                <div><span class="font-semibold text-slate-700">Công cụ:</span> Google Search Console, GA4, GTM, Schema.org</div>
                                <div><span class="font-semibold text-slate-700">Mục tiêu:</span> Tăng trưởng lượng truy cập tự nhiên có giá trị</div>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('services.marketing') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:underline">
                                <span>Chi tiết giải pháp SEO &amp; Growth</span>
                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Creative Support Group (Hỗ trợ) -->
            <div id="media-solutions" class="flex flex-col gap-4 pt-2">
                <div class="border-b border-slate-200 pb-3 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Hỗ trợ hệ sinh thái</span>
                        <h2 class="text-lg sm:text-xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Năng Lực Truyền Thông &amp; Media Hỗ Trợ
                        </h2>
                    </div>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-100 text-slate-600">Bổ trợ</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-5 rounded-xl bg-white border border-slate-200/90 flex flex-col justify-between">
                        <div class="space-y-2">
                            <h3 class="text-sm font-bold text-[#070f1e]">Sản Xuất Video &amp; Hình Ảnh Doanh Nghiệp</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Cung cấp tư liệu media đồng bộ phục vụ website, hồ sơ năng lực và truyền thông kỹ thuật số.
                            </p>
                            <div class="text-xs text-slate-500">Thực chứng: Tư liệu dự án Sacombank, Hoya Lens, Kredivo.</div>
                        </div>
                        <div class="pt-3 mt-3 border-t border-slate-100">
                            <a href="{{ route('services.media') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                                <span>Chi tiết năng lực Media</span>
                                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <div class="p-5 rounded-xl bg-white border border-slate-200/90 flex flex-col justify-between">
                        <div class="space-y-2">
                            <h3 class="text-sm font-bold text-[#070f1e]">Điều Động Ekip Media Theo Nhu Cầu</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Điều phối nhân sự quay chụp sự kiện, hội thảo và tư liệu hiện trường cho doanh nghiệp tại Cần Thơ &amp; ĐBSCL.
                            </p>
                            <div class="text-xs text-slate-500">Quy trình điều động nhanh chóng, thiết bị chuẩn điện ảnh.</div>
                        </div>
                        <div class="pt-3 mt-3 border-t border-slate-100">
                            <a href="{{ route('booking') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                                <span>Đặt lịch ekip</span>
                                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 04 — PROOF ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Minh chứng thực tế</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Dự Án Tiêu Biểu
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem tất cả dự án</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($techCaseStudies as $case)
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                <span class="text-xs font-bold text-slate-500">{{ $case->client_name ?: 'Khách hàng B2B' }}</span>
                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded bg-slate-100 text-slate-600">{{ $case->year ?: 'Thực tế' }}</span>
                            </div>
                            <h3 class="text-base font-bold text-[#070f1e]">{{ $case->title }}</h3>
                            
                            <div class="space-y-2 text-xs">
                                <div>
                                    <span class="font-bold text-slate-700">Problem:</span>
                                    <span class="text-slate-600 ml-1">{{ $case->problem ?: 'Quy trình tiếp nhận và quản lý hồ sơ thủ công, phân tán.' }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-slate-700">Solution:</span>
                                    <span class="text-slate-600 ml-1">{{ $case->solution ?: 'Xây dựng Web App nghiệp vụ riêng với module quản lý lịch hẹn và phân quyền hồ sơ.' }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-slate-700">Technology:</span>
                                    <span class="text-slate-600 ml-1">{{ $case->tech_stack ?: 'Laravel, MySQL, REST API, Tailwind CSS' }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-slate-700">Result / Deliverable:</span>
                                    <span class="text-slate-600 ml-1">{{ $case->result ?: 'Hệ thống vận hành thực tế, dữ liệu tập trung và giảm thiểu sai sót.' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ route('projects.show', $case->slug) }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                                <span>Xem case study chi tiết</span>
                                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Fallback nếu database trống -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm">
                        <h3 class="text-base font-bold text-[#070f1e]">Phòng Khám Gia Phước</h3>
                        <p class="text-xs text-slate-600 mt-2">Hệ thống đặt lịch &amp; quản lý hồ sơ tiếp nhận trực tuyến trên nền Laravel/MySQL.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- ==================== SECTION 05 — PROCESS ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm">
            <div class="border-b border-slate-100 pb-4 mb-6">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Quy chuẩn làm việc</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Quy Trình Triển Khai 4 Bước
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-2">
                    <span class="text-lg font-bold text-primary">01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Khảo Sát</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Làm việc trực tiếp để bóc tách luồng vận hành thực tế, các điểm nghẽn dữ liệu và yêu cầu đầu ra.
                    </p>
                </div>

                <div class="space-y-2">
                    <span class="text-lg font-bold text-primary">02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Kiến Trúc Giải Pháp</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Thiết kế cấu trúc cơ sở dữ liệu, luồng tương tác người dùng và lựa chọn công nghệ phù hợp ngân sách.
                    </p>
                </div>

                <div class="space-y-2">
                    <span class="text-lg font-bold text-primary">03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Phát Triển</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lập trình theo module, kiểm thử chức năng định kỳ và đảm bảo tiêu chuẩn bảo mật phân quyền.
                    </p>
                </div>

                <div class="space-y-2">
                    <span class="text-lg font-bold text-primary">04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Bàn Giao &amp; Hỗ Trợ</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Triển khai hạ tầng, hướng dẫn vận hành trực tiếp cho nhân sự và bảo hành kỹ thuật sau bàn giao.
                    </p>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Tuân thủ cam kết kỹ thuật &bull; Bàn giao toàn bộ mã nguồn</span>
                <a href="{{ route('process') }}" class="font-semibold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem chi tiết quy trình</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION 06 — CTA ==================== -->
        <section class="rounded-2xl bg-[#070f1e] text-white p-8 sm:p-12 text-center flex flex-col items-center gap-5 shadow-xl">
            <span class="text-xs text-amber-400 font-bold uppercase tracking-wider">HỢP TÁC KỸ THUẬT</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                Bạn Đang Có Bài Toán Cần Xây Dựng?
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                Mô tả sơ bộ về nhu cầu vận hành của bạn, đội ngũ kỹ thuật của Cửu Long sẽ liên hệ để phân tích tính khả thi và đưa ra giải pháp phù hợp.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs sm:text-sm font-bold shadow-sm transition-all">
                    <span>Bắt đầu trao đổi với đội ngũ kỹ thuật</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">call</span>
                    <span>{{ get_setting('company_phone', '0939.363.262') }}</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
