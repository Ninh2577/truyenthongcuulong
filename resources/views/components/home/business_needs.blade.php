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

        <!-- 6 Business Needs Cards Grid (3 cols on lg, 2 cols on md, 1 col on mobile) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
            
            <!-- Need 1: Xây mới hoặc nâng cấp Website Doanh Nghiệp -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[26px]">web</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-sky-700 bg-sky-50 px-2.5 py-0.5 rounded-full border border-sky-100 uppercase tracking-wider">BÀI TOÁN 01</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors leading-snug">
                        &ldquo;Tôi cần xây dựng hoặc nâng cấp website doanh nghiệp chuẩn chỉnh&rdquo;
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Thiết kế giao diện độc bản theo nhận diện thương hiệu, tối ưu trải nghiệm người dùng (UX/UI), tốc độ tải trang nhanh và chuẩn cấu trúc mở rộng lâu dài.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Thiết kế &amp; Lập trình Web-App</span>
                    </div>
                </div>
                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Xem giải pháp Website &amp; Web-App</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Need 2: Số hóa quy trình vận hành & quản trị nội bộ -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[26px]">hub</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-indigo-700 bg-indigo-50 px-2.5 py-0.5 rounded-full border border-indigo-100 uppercase tracking-wider">BÀI TOÁN 02</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors leading-snug">
                        &ldquo;Tôi muốn số hóa quy trình và thay thế bảng tính Excel rời rạc&rdquo;
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Chuyển đổi quy trình thủ công thành hệ thống web-based tập trung: kiểm soát dữ liệu, quản lý đơn hàng/tiến độ và phân quyền chính xác theo từng bộ phận.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Số Hóa Quy Trình &amp; Web-App</span>
                    </div>
                </div>
                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Xem giải pháp Số hóa Quy trình</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Need 3: Xây dựng nền tảng Web App & Portal theo nghiệp vụ riêng -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[26px]">terminal</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full border border-blue-100 uppercase tracking-wider">BÀI TOÁN 03</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors leading-snug">
                        &ldquo;Tôi cần xây dựng nền tảng Web App hoặc cổng nghiệp vụ đặc thù&rdquo;
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Phát triển Web Application theo yêu cầu nghiệp vụ chuyên sâu, xử lý tải cao, bảo mật nhiều lớp và kết nối an toàn với các hệ thống thanh toán hoặc bên thứ ba.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Web-App Chuyên Sâu</span>
                    </div>
                </div>
                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.web-app') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Xem giải pháp Web-App chuyên sâu</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Need 4: Tăng trưởng thứ hạng tìm kiếm & Tối ưu SEO Google -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[26px]">trending_up</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100 uppercase tracking-wider">BÀI TOÁN 04</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors leading-snug">
                        &ldquo;Website có sẵn nhưng chưa tiếp cận được khách hàng từ Google&rdquo;
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Tối ưu Technical SEO chuẩn chỉ từ cấu trúc mã nguồn, tăng tốc độ trang, xây dựng luồng chuyển đổi nội dung giúp từ khóa ngành tăng trưởng bền vững.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Tối Ưu SEO &amp; Tăng Trưởng Số</span>
                    </div>
                </div>
                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.marketing') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Xem giải pháp Tối ưu SEO</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Need 5: Triển khai nhanh với website mẫu có sẵn (39+ mẫu) -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[26px]">dashboard</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-100 uppercase tracking-wider">BÀI TOÁN 05</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors leading-snug">
                        &ldquo;Tôi muốn ra mắt website thật nhanh với ngân sách tối ưu&rdquo;
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Lựa chọn từ hơn 39+ mẫu giao diện được lập trình sẵn cho 13 ngành nghề, kiểm tra trực tiếp qua bản live demo và đưa vào sử dụng trong thời gian ngắn nhất.
                    </p>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-navy-base">Kho Giao Diện (39+ Mẫu Sẵn Sàng)</span>
                    </div>
                </div>
                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('templates.index') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-headline font-bold text-primary group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                        <span>Khám phá 39+ mẫu demo có sẵn</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Need 6: Media in-house hỗ trợ dự án số (Supporting Capability ~15%) -->
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/80 shadow-2xs hover:border-amber-400/50 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="flex flex-col gap-3.5">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[26px]">videocam</span>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-amber-800 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200/80 uppercase tracking-wider">BÀI TOÁN 06 &bull; HỖ TRỢ</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-amber-700 transition-colors leading-snug">
                        &ldquo;Dự án số của tôi cần sản xuất visual &amp; video giới thiệu đồng bộ&rdquo;
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Ekip Media in-house hỗ trợ sản xuất hình ảnh nhận diện sắc nét, video giới thiệu 4K cho website &amp; giải pháp số mà không cần thuê agency bên ngoài.
                    </p>
                    <div class="p-2.5 rounded-xl bg-amber-50/60 border border-amber-100/70 flex items-center gap-2 text-xs font-mono">
                        <span class="text-slate-400">Giải pháp:</span>
                        <span class="font-bold text-amber-800">Media In-House Hỗ Trợ (15%)</span>
                    </div>
                </div>
                <div class="pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('services.media') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-headline font-bold text-amber-700 group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:outline-none">
                        <span>Khám phá năng lực Media hỗ trợ</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
