{{-- 
    UI-REBUILD-04: SECTION 05 — WHAT WE ACTUALLY BUILD
    Giải thích phạm vi sản phẩm và giải pháp công nghệ bằng ngôn ngữ business rõ ràng,
    dựa trên các năng lực thực tế đã được kiểm chứng của Truyền Thông Cửu Long.
--}}
<section class="w-full bg-white py-14 lg:py-20 border-b border-slate-200/80 relative overflow-hidden gsap-reveal-section" 
         id="what-we-build" 
         aria-labelledby="what-we-build-title">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold border border-sky-200 mb-3.5 shadow-2xs">
                <span class="material-symbols-outlined text-[16px] text-primary" aria-hidden="true">build_circle</span>
                <span>PHẠM VI NĂNG LỰC &bull; WHAT WE BUILD</span>
            </div>
            
            <h2 id="what-we-build-title" class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Phạm Vi Sản Phẩm &amp; Nền Tảng Số Chúng Tôi Triển Khai
            </h2>
            
            <p class="font-body text-slate-600 text-base sm:text-lg mt-3.5 leading-relaxed">
                Tập trung vào những giải pháp công nghệ có khả năng giải quyết trực tiếp bài toán vận hành, hiện diện thương hiệu và tăng trưởng của doanh nghiệp.
            </p>
        </div>

        <!-- 6 Capability Scope Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- 01: Website Doanh Nghiệp May Đo -->
            <div class="p-6 sm:p-7 rounded-2xl bg-surface border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">web</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-sky-800 bg-sky-50 px-2.5 py-1 rounded-md border border-sky-200 uppercase">
                            Website Doanh Nghiệp
                        </span>
                    </div>

                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Website Doanh Nghiệp May Đo
                    </h3>

                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Thiết kế giao diện độc bản theo đúng nhận diện thương hiệu, tối ưu cấu trúc tải trang nhanh, hiển thị mượt mà trên di động và chuẩn bị sẵn cấu trúc mở rộng lâu dài.
                    </p>

                    <div class="pt-3 border-t border-slate-200/70 text-xs font-mono text-slate-500 space-y-1.5">
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            <span>Độc bản theo nhận diện thương hiệu</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            <span>Tối ưu hiển thị đa thiết bị</span>
                        </div>
                    </div>
                </div>

                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary hover:underline">
                        <span>Chi tiết dịch vụ Website</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- 02: Web Application Quản Trị Nghiệp Vụ -->
            <div class="p-6 sm:p-7 rounded-2xl bg-surface border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">terminal</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-indigo-800 bg-indigo-50 px-2.5 py-1 rounded-md border border-indigo-200 uppercase">
                            Web Application
                        </span>
                    </div>

                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Web App &amp; Hệ Thống Quản Trị
                    </h3>

                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Chuyển đổi quy trình thủ công rời rạc (Excel, giấy tờ) thành ứng dụng web tập trung: quản lý dữ liệu, phân quyền tài khoản và theo dõi tiến độ công việc theo thời gian thực.
                    </p>

                    <div class="pt-3 border-t border-slate-200/70 text-xs font-mono text-slate-500 space-y-1.5">
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                            <span>Số hóa quy trình vận hành nội bộ</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                            <span>Phân quyền và bảo mật dữ liệu</span>
                        </div>
                    </div>
                </div>

                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary hover:underline">
                        <span>Chi tiết Web Application</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- 03: Business Management System / Portal -->
            <div class="p-6 sm:p-7 rounded-2xl bg-surface border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">hub</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-blue-800 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200 uppercase">
                            Digital Portal
                        </span>
                    </div>

                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Cổng Nghiệp Vụ &amp; Đặt Lịch Tự Động
                    </h3>

                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Xây dựng cổng tiếp nhận yêu cầu, tra cứu thông tin dịch vụ, đăng ký lịch hẹn trực tuyến và kết nối thông suốt giữa khách hàng với bộ phận điều hành.
                    </p>

                    <div class="pt-3 border-t border-slate-200/70 text-xs font-mono text-slate-500 space-y-1.5">
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            <span>Đặt lịch &amp; điều phối tự động</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            <span>Tra cứu dữ liệu và hồ sơ số</span>
                        </div>
                    </div>
                </div>

                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary hover:underline">
                        <span>Xem case study y tế tiêu biểu</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- 04: Kho Giao Diện 39+ Mẫu Sẵn Sàng -->
            <div class="p-6 sm:p-7 rounded-2xl bg-surface border border-slate-200/90 shadow-2xs hover:border-amber-500/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">dashboard</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-amber-800 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200 uppercase">
                            Kho Mẫu Demo
                        </span>
                    </div>

                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-amber-700 transition-colors">
                        Kho 39+ Giao Diện Doanh Nghiệp
                    </h3>

                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Thư viện mẫu website dựng sẵn cho 13 nhóm ngành (bất động sản, y tế, giáo dục, F&amp;B...). Trực tiếp trải nghiệm live demo và đưa vào hoạt động với chi phí và thời gian tối ưu.
                    </p>

                    <div class="pt-3 border-t border-slate-200/70 text-xs font-mono text-slate-500 space-y-1.5">
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            <span>39+ Mẫu cho 13 ngành nghề</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            <span>Trực tiếp trải nghiệm bản Live Demo</span>
                        </div>
                    </div>
                </div>

                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-amber-700 hover:underline">
                        <span>Khám phá kho 39+ mẫu</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- 05: Technical SEO & Tăng Trưởng Kỹ Thuật Số -->
            <div class="p-6 sm:p-7 rounded-2xl bg-surface border border-slate-200/90 shadow-2xs hover:border-emerald-500/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">trending_up</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200 uppercase">
                            Tăng Trưởng Số
                        </span>
                    </div>

                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-emerald-700 transition-colors">
                        Technical SEO &amp; Tối Ưu Tìm Kiếm
                    </h3>

                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Xây dựng nền tảng mã nguồn chuẩn SEO, cấu trúc dữ liệu Schema phong phú, tối ưu hóa trải nghiệm tải trang giúp từ khóa ngành tăng trưởng bền vững trên Google.
                    </p>

                    <div class="pt-3 border-t border-slate-200/70 text-xs font-mono text-slate-500 space-y-1.5">
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Chuẩn hóa Technical SEO &amp; Schema</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Chiến lược từ khóa theo ngành bền vững</span>
                        </div>
                    </div>
                </div>

                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.marketing') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-emerald-700 hover:underline">
                        <span>Chi tiết giải pháp SEO</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- 06: Media In-House Hỗ Trợ Dự Án Số -->
            <div class="p-6 sm:p-7 rounded-2xl bg-surface border border-slate-200/90 shadow-2xs hover:border-orange-500/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-800 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">videocam</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-orange-800 bg-orange-50 px-2.5 py-1 rounded-md border border-orange-200 uppercase">
                            Creative Support
                        </span>
                    </div>

                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Media &amp; Hình Ảnh In-House Hỗ Trợ
                    </h3>

                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Năng lực sản xuất visual đồng hành: cung cấp hình ảnh chất lượng cao, video giới thiệu giải pháp và TVC quảng cáo phục vụ đồng bộ cho website và nền tảng số.
                    </p>

                    <div class="pt-3 border-t border-slate-200/70 text-xs font-mono text-slate-500 space-y-1.5">
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            <span>Sản xuất video TVC &amp; phim doanh nghiệp</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            <span>Đồng bộ nhận diện hình ảnh cho web</span>
                        </div>
                    </div>
                </div>

                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary hover:underline">
                        <span>Khám phá năng lực Media</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>
