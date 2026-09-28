{{-- 
    UI-REBUILD-09: CORPORATE WEBSITE CASE STUDY — NHA KHOA NỤ CƯỜI
    Hồ sơ triển khai: Website Phòng Khám Đa Khoa Chuẩn WordPress
    Tuân thủ nghiêm ngặt: Định vị đúng website y khoa chuẩn SEO, không nhầm lẫn sang Web App phức tạp, không số liệu giả.
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
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-teal-100 text-teal-800 font-mono text-xs font-bold border border-teal-200/80 w-fit">
                <span class="w-2 h-2 rounded-full bg-teal-600"></span>
                <span>CORPORATE WEBSITE CASE STUDY &bull; NỀN TẢNG Y KHOA SỐ</span>
            </div>

            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                {{ $caseStudy->title }}
            </h1>

            <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed">
                Thiết kế và triển khai website y khoa chuẩn WordPress cho Nha Khoa Nụ Cười: tối ưu nhận diện thương hiệu y tế, trình bày minh bạch dịch vụ và xây dựng cấu trúc Technical SEO y khoa.
            </p>

            <!-- Project Meta Strip -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 mt-2 border-t border-slate-200/80 font-mono text-xs">
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Khách hàng</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->client_name }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Loại giải pháp</span>
                    <span class="font-bold text-teal-700 mt-0.5 block font-headline">Website Y Khoa</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Nền tảng</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">WordPress CMS</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Năm triển khai</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->year ?: '2024' }}</span>
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
                    <span class="ml-2 text-slate-300 font-semibold text-[11px]">nhakhoanucuoi.vn/dich-vu-nha-khoa</span>
                </div>
                <span class="text-[10px] text-teal-400 font-bold px-2 py-0.5 rounded bg-teal-950 border border-teal-500/30">
                    WORDPRESS CUSTOM THEME
                </span>
            </div>
            <div class="aspect-[16/9] w-full bg-slate-900 overflow-hidden flex items-center justify-center">
                @if($caseStudy->thumbnail)
                    <img src="{{ asset('storage/' . $caseStudy->thumbnail) }}" 
                         alt="Giao diện Website Nha Khoa Nụ Cười" 
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'">
                @else
                    <img src="{{ asset('images/modern_tech_platform.jpg') }}" 
                         alt="Giao diện Website Nha Khoa Nụ Cười" 
                         class="w-full h-full object-cover">
                @endif
            </div>
        </div>

        <!-- Section 02: Bối cảnh và Mục tiêu Website -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 text-primary font-mono text-xs font-bold border border-orange-200">
                <span>01. BỐI CẢNH &amp; MỤC TIÊU DỰ ÁN</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Xây Dựng Hiện Diện Trực Tuyến Chuyên Nghiệp Cho Phòng Khám
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-4xl">
                Nha Khoa Nụ Cười cần một nền tảng website doanh nghiệp chuyên biệt để giới thiệu đầy đủ các dịch vụ nha khoa tổng quát, chỉnh nha và răng thẩm mỹ. Mục tiêu cốt lõi của dự án bao gồm:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-mono font-bold text-sm">
                        01
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Định Vị Thương Hiệu Uy Tín</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Thiết kế giao diện mang tính chuẩn mực y khoa, thể hiện rõ bằng cấp, chứng chỉ hành nghề của đội ngũ bác sĩ và hệ thống trang thiết bị hiện đại.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center font-mono font-bold text-sm">
                        02
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Minh Bạch Thông Tin Dịch Vụ</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Trình bày bảng giá dịch vụ rõ ràng, quy trình thực hiện từng bước và chính sách bảo hành giúp khách hàng an tâm lựa chọn.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-mono font-bold text-sm">
                        03
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Cấu Trúc Thân Thiện Google</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tổ chức cấu trúc URL chuẩn SEO, gắn thẻ Schema y tế (Dentist / MedicalWebPage) nhằm tiếp cận người tìm kiếm dịch vụ tại địa phương.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 03: Giải pháp thiết kế & triển khai -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-mono text-xs font-bold border border-emerald-200">
                <span>02. GIẢI PHÁP THIẾT KẾ &amp; TRIỂN KHAI</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Thiết Kế Tùy Biến Trên Nền Tảng WordPress Chuẩn SEO
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-4xl">
                Cửu Long phát triển theme WordPress tùy biến độc bản thay vì sử dụng theme mua sẵn cồng kềnh, giúp website nhẹ tải, an toàn và dễ dàng quản trị:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">palette</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Thiết Kế Nhận Diện Y Khoa Hiện Đại</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Phối màu xanh ngọc và trắng chủ đạo mang lại cảm giác thân thiện, vệ sinh và an tâm. Bố cục rộng rãi, phân chia khối nội dung mạch lạc.
                        </p>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">phone_iphone</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Tối Ưu Trải Nghiệm Thiết Bị Di Động</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Toàn bộ giao diện được tối ưu hóa cho màn hình điện thoại thông minh, tích hợp thanh điều hướng cố định và nút gọi hotline / đặt lịch tức thì.
                        </p>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">admin_panel_settings</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Trang Quản Trị Trực Quan</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Đội ngũ nhân sự phòng khám có thể tự cập nhật bài viết cẩm nang răng miệng, bảng giá điều trị và danh mục bác sĩ mà không cần hỗ trợ kỹ thuật.
                        </p>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">send</span>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-headline text-base font-bold text-navy-base">Luồng Nhận Đặt Hẹn Tự Động</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Khi khách hàng điền form tư vấn, dữ liệu được gửi ngay vào hòm thư điện tử và lưu trữ an toàn trong trang quản trị phòng khám.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 04: Cấu trúc trang và chức năng thực tế -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">view_quilt</span>
                <span>03. CẤU TRÚC TRANG &bull; SITEMAP &amp; MODULES</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Các Phân Trang &amp; Chức Năng Đã Triển Khai
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="text-xs font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100">TRANG CHỦ</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Cổng Thông Tin Tổng Quan</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Banner định vị, danh mục dịch vụ nha khoa tiêu biểu, phản hồi từ khách hàng và địa chỉ phòng khám.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="text-xs font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100">DỊCH VỤ</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Trang Chi Tiết Kỹ Thuật</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Từng dịch vụ (bọc răng sứ, niềng răng, cấy ghép Implant) có trang riêng mô tả quy trình thực hiện và bảng giá chi tiết.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="text-xs font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100">BÁC SĨ</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Đội Ngũ Chuyên Gia</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Giới thiệu kinh nghiệm công tác, chứng chỉ chuyên khoa và hình ảnh thực tế của từng bác sĩ điều trị.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="text-xs font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100">CẨM NANG</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Kiến Thức Răng Miệng</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Chuyên mục bài viết tư vấn chăm sóc răng miệng, hướng dẫn vệ sinh sau điều trị được tối ưu chuẩn SEO y tế.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="text-xs font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100">LIÊN HỆ</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Đặt Lịch Hẹn &amp; Bản Đồ</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Bản đồ chỉ dẫn Google Maps, form đặt lịch khám trực tuyến, số điện thoại hotline và thời gian làm việc.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="text-xs font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100">BẢNG GIÁ</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Chi Phí Minh Bạch</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Bảng phân chia chi phí theo từng dịch vụ, vật liệu răng và chính sách trả góp tiện lợi cho bệnh nhân.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 05: Công nghệ được xác minh -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">terminal</span>
                <span>04. CÔNG NGHỆ XÁC MINH &bull; TECH STACK</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Nền Tảng Công Nghệ Website
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Hệ quản trị CMS</span>
                    <div class="font-headline font-bold text-sm text-navy-base">WordPress (PHP)</div>
                    <p class="font-body text-[11px] text-slate-500">Mã nguồn CMS ổn định</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Giao diện</span>
                    <div class="font-headline font-bold text-sm text-navy-base">Custom Theme</div>
                    <p class="font-body text-[11px] text-slate-500">HTML5, CSS3, JavaScript</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Cấu trúc SEO</span>
                    <div class="font-headline font-bold text-sm text-navy-base">Schema y tế &bull; XML</div>
                    <p class="font-body text-[11px] text-slate-500">Khung dữ liệu chuẩn Google</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-1.5">
                    <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">Bảo mật</span>
                    <div class="font-headline font-bold text-sm text-navy-base">SSL &bull; Anti-Spam</div>
                    <p class="font-body text-[11px] text-slate-500">Lọc thư rác cho biểu mẫu</p>
                </div>
            </div>
        </section>

        <!-- Section 06: Sản phẩm bàn giao -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">inventory_2</span>
                <span>05. SẢN PHẨM BÀN GIAO &bull; DELIVERABLES</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Phạm Vi Bàn Giao Khách Hàng
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-2">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-teal-600">web</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Website Hoàn Chỉnh</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Toàn bộ website hoạt động ổn định trên tên miền chính thức của phòng khám.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-sky-600">admin_panel_settings</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Quyền Sở Hữu CMS</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Bàn giao tài khoản quản trị cao nhất và thông tin máy chủ lưu trữ cho phòng khám.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-indigo-600">menu_book</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Tài Liệu Hướng Dẫn</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Hướng dẫn đăng bài viết mới, cập nhật bảng giá và xử lý thông tin khách hàng từ form.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2.5">
                    <span class="material-symbols-outlined text-[26px] text-amber-600">verified_user</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Hỗ Trợ Kỹ Thuật</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Cam kết hỗ trợ bảo hành kỹ thuật, sao lưu cơ sở dữ liệu định kỳ chống sự cố.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 07: Related Case Studies -->
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

        <!-- Section 08: Final CTA -->
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-[#070F1E] to-[#0C1A30] text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-2 text-center md:text-left max-w-xl">
                <span class="text-teal-400 font-mono text-xs font-bold uppercase tracking-wider block">
                    BẮT ĐẦU DỰ ÁN CỦA BẠN
                </span>
                <h3 class="font-headline text-2xl sm:text-3xl font-extrabold text-white">
                    Doanh Nghiệp Của Bạn Cần Một Website Chuẩn Chỉnh?
                </h3>
                <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Trao đổi với Cửu Long để được tư vấn giao diện độc bản hoặc lựa chọn giải pháp khởi chạy nhanh từ kho giao diện mẫu.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                <a href="{{ route('contact', ['service' => 'Website Doanh Nghiệp']) }}" 
                   class="btn-primary-cta px-8 py-3.5 rounded-full bg-primary hover:bg-orange-600 text-white font-headline text-xs font-bold shadow-md transition-all">
                    <span>Bắt đầu dự án</span>
                </a>
                <a href="{{ route('templates.index') }}" 
                   class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all border border-white/20">
                    <span>Xem kho giao diện</span>
                </a>
            </div>
        </div>

    </div>
</div>
