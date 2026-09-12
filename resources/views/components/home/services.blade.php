<section class="w-full bg-surface bg-dot-grid-subtle py-12 lg:py-16 relative gsap-reveal-section" id="services-pillars">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100/70 text-primary font-mono text-xs font-bold border border-orange-200 mb-3">
                <span class="material-symbols-outlined text-[16px]">category</span>
                <span>COMPREHENSIVE DIGITAL CAPABILITIES</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Ba Trụ Cột Năng Lực Cốt Lõi
            </h2>
            <p class="font-body text-slate-600 text-base sm:text-lg mt-4 leading-relaxed">
                Sự kết hợp hoàn hảo giữa năng lực sản xuất nội dung thị giác đỉnh cao, nền tảng công nghệ số vững chắc và chiến dịch truyền thông lan tỏa đa kênh.
            </p>
        </div>

        <!-- 3 Pillar Cards Grid with Hover Glow & Elevation -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Pillar 1: Media Production -->
            <div class="pillar-card pillar-card-media group p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-orange-100 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">videocam</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-primary tracking-wider uppercase">01 &bull; SẢN XUẤT HÌNH ẢNH</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Sản Xuất Video &amp; Phim Điện Ảnh
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Phim giới thiệu doanh nghiệp, TVC quảng cáo 4K, video viral đa nền tảng, phim tài liệu và ghi hình sự kiện doanh nghiệp quy mô lớn.
                    </p>

                    <ul class="flex flex-col gap-2.5 pt-4 border-t border-slate-100 text-xs font-medium text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[17px]">check_circle</span>
                            <span>TVC Quảng Cáo &amp; Viral Commercial 4K</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[17px]">check_circle</span>
                            <span>Phim Doanh Nghiệp &amp; Hồ Sơ Năng Lực Số</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[17px]">check_circle</span>
                            <span>Flycam &amp; Ghi Hình Team Building Sự Kiện</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-6 relative z-10">
                    <a href="{{ route('services.index') }}#media" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết dịch vụ Media</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar 2: Technology & Platforms -->
            <div class="pillar-card pillar-card-tech group p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">terminal</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-sky-600 tracking-wider uppercase">02 &bull; GIẢI PHÁP CÔNG NGHỆ</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-sky-600 transition-colors">
                        Phát Triển Web &amp; Nền Tảng Số
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Thiết kế Website doanh nghiệp chuẩn SEO, ứng dụng web/app hiệu năng cao, sàn thương mại điện tử và hệ thống quản trị chuyên biệt.
                    </p>

                    <ul class="flex flex-col gap-2.5 pt-4 border-t border-slate-100 text-xs font-medium text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sky-600 text-[17px]">check_circle</span>
                            <span>Website Doanh Nghiệp Chuẩn Senior SEO</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sky-600 text-[17px]">check_circle</span>
                            <span>Web Application &amp; Mobile App Tùy Biến</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sky-600 text-[17px]">check_circle</span>
                            <span>Tối Ưu Tốc Độ &amp; Bảo Mật Cloud Server</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-6 relative z-10">
                    <a href="{{ route('services.index') }}#technology" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-sky-600 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết dịch vụ Tech</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar 3: Digital Marketing & Media Growth -->
            <div class="pillar-card pillar-card-ads group p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">campaign</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-amber-600 tracking-wider uppercase">03 &bull; TRUYỀN THÔNG TĂNG TRƯỞNG</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">
                        Marketing Số &amp; Chiến Dịch PR
                    </h3>
                    <p class="font-body text-sm text-slate-600 leading-relaxed">
                        Tư vấn chiến lược truyền thông tổng thể, quản trị kênh mạng xã hội, booking báo chí truyền hình và quảng cáo hiệu năng tối ưu doanh số.
                    </p>

                    <ul class="flex flex-col gap-2.5 pt-4 border-t border-slate-100 text-xs font-medium text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[17px]">check_circle</span>
                            <span>Dịch Vụ SEO Tổng Thể Cần Thơ &amp; Toàn Quốc</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[17px]">check_circle</span>
                            <span>Booking Báo Chí, Đài Truyền Hình ĐBSCL</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[17px]">check_circle</span>
                            <span>Quản Trị Fanpage &amp; Xây Kênh TikTok Doanh Nghiệp</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-6 relative z-10">
                    <a href="{{ route('services.index') }}#marketing" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-amber-600 group-hover:translate-x-1 transition-transform">
                        <span>Xem chi tiết dịch vụ Marketing</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>