<section class="w-full bg-[#FAF9F5] py-14 lg:py-20 relative border-b border-slate-200/80 gsap-reveal-section" id="business-needs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100/80 text-sky-800 font-mono text-xs font-bold border border-sky-300/60 mb-3.5 shadow-2xs">
                <span class="material-symbols-outlined text-[16px] text-primary">alt_route</span>
                <span>BẮT ĐẦU TỪ BÀI TOÁN DOANH NGHIỆP &bull; SOLUTION FINDER</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Bạn Đang Cần Giải Quyết Vấn Đề Gì?
            </h2>
            <p class="font-body text-slate-600 text-base sm:text-lg mt-3.5 leading-relaxed">
                Không cần nắm rõ thuật ngữ kỹ thuật. Chọn bài toán sát nhất với thực trạng doanh nghiệp để tiếp cận hướng giải pháp công nghệ phù hợp.
            </p>
        </div>

        <!-- 4 Business Needs Cards Grid (4 cols on lg, 2 cols on md, 1 col on mobile) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Need 1: Quy trình vận hành phụ thuộc vào Excel -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">table_chart</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-sky-700 bg-sky-50 px-2.5 py-0.5 rounded-full border border-sky-100 uppercase tracking-wider">BÀI TOÁN 01</span>
                    </div>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-primary transition-colors leading-snug">
                        Quy trình vận hành phụ thuộc vào Excel &amp; thủ công
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Dữ liệu phân tán, dễ sai sót khi đối soát và tốn nhiều nhân lực tổng hợp báo cáo khi quy trình mở rộng.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Web App &amp; Hệ Thống Quản Trị</span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" 
                       class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Chi tiết Web App</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Need 2: Cần website doanh nghiệp phù hợp với hoạt động thực tế -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-indigo-500/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">web</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-indigo-700 bg-indigo-50 px-2.5 py-0.5 rounded-full border border-indigo-100 uppercase tracking-wider">BÀI TOÁN 02</span>
                    </div>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-indigo-600 transition-colors leading-snug">
                        Cần website doanh nghiệp phù hợp với hoạt động thực tế
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Thiết kế theo nhận diện thương hiệu, phản ánh đúng dịch vụ cốt lõi, chuẩn SEO và tối ưu trải nghiệm khách hàng.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Website Doanh Nghiệp &amp; Mẫu</span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('services.web-app') }}" 
                       class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Thiết kế website</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                    <a href="{{ route('templates.index') }}" 
                       class="text-[11px] font-mono text-slate-500 hover:text-primary transition-colors">
                        Kho mẫu &rarr;
                    </a>
                </div>
            </div>

            <!-- Need 3: Cần hệ thống quản lý dữ liệu và phân quyền -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-emerald-500/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">admin_panel_settings</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100 uppercase tracking-wider">BÀI TOÁN 03</span>
                    </div>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-emerald-600 transition-colors leading-snug">
                        Cần hệ thống quản lý dữ liệu tập trung &amp; phân quyền
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phân quyền chặt chẽ theo phòng ban, kiểm soát lịch sử thao tác, bảo mật dữ liệu khách hàng và chống rò rỉ thông tin.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Quản Lý Dữ Liệu &amp; RBAC</span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" 
                       class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Chi tiết phân quyền</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Need 4: Cần tự động hóa các bước xử lý nghiệp vụ -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-teal-500/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-11 h-11 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[24px]">sync_alt</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100 uppercase tracking-wider">BÀI TOÁN 04</span>
                    </div>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-teal-600 transition-colors leading-snug">
                        Cần tự động hóa các bước xử lý nghiệp vụ &amp; tăng trưởng
                    </h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tự động hóa luồng tiếp nhận khách, xác nhận lịch hẹn và tối ưu Technical SEO để chuyển đổi tự nhiên từ tìm kiếm.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Tự Động Hóa &amp; SEO Growth</span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <a href="{{ route('services.marketing') }}" 
                       class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Chi tiết tự động hóa &amp; SEO</span>
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Integrated Supporting Note: Media In-House Layer -->
        <div class="mt-8 p-4 rounded-xl bg-white border border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-2.5 text-slate-600">
                <span class="material-symbols-outlined text-[18px] text-amber-600 shrink-0">videocam</span>
                <span>Dự án số cần sản xuất hình ảnh nhận diện &amp; video giới thiệu đồng bộ?</span>
            </div>
            <a href="{{ route('services.media') }}" class="font-headline font-bold text-amber-700 hover:text-amber-800 inline-flex items-center gap-1 shrink-0">
                <span>Năng lực Media In-House hỗ trợ</span>
                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </div>

        </div>
    </div>
</section>
