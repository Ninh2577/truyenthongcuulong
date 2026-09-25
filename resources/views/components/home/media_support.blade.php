{{-- 
    UI-REBUILD-07: MEDIA 15% COMPACT CREATIVE SUPPORT LAYER
    Section giải thích năng lực Media in-house hỗ trợ hệ sinh thái giải pháp số & công nghệ.
    Định vị: Technology First ≈ 85% — Media ≈ 15% (Creative Support Layer).
--}}
<section class="w-full bg-slate-50/80 py-12 lg:py-16 border-b border-slate-200/80 relative overflow-hidden gsap-reveal-section" 
         id="media-support" 
         aria-labelledby="media-support-title">
    
    <!-- Ambient Creative Warmth Glow -->
    <div class="absolute -top-32 right-10 w-96 h-96 bg-gradient-to-br from-amber-400/8 via-primary/5 to-transparent rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header & Positioning -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10 pb-6 border-b border-slate-200">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 text-orange-800 font-mono text-xs font-bold border border-orange-200/80 mb-3 shadow-2xs">
                    <span class="material-symbols-outlined text-[15px] text-primary" aria-hidden="true">videocam</span>
                    <span>CREATIVE SUPPORT &bull; MEDIA IN-HOUSE (15%)</span>
                </div>
                
                <h2 id="media-support-title" class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-navy-base">
                    Công Nghệ Tạo Nền Tảng &bull; Media Truyền Tải Giá Trị
                </h2>
                
                <p class="font-body text-slate-600 text-sm sm:text-base mt-2.5 leading-relaxed">
                    Đội ngũ Media in-house đồng hành cùng các dự án công nghệ của Cửu Long: trực tiếp sản xuất video giới thiệu tính năng, tư liệu truyền thông và sự kiện ra mắt đồng bộ nhận diện số cho doanh nghiệp.
                </p>
            </div>

            <!-- Quick Action CTAs -->
            <div class="flex flex-wrap sm:flex-nowrap items-center gap-2.5 sm:gap-3 shrink-0">
                <a href="{{ route('services.media') }}" 
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-xs font-bold shadow-xs transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">movie</span>
                    <span>Dịch Vụ Media</span>
                </a>
                
                <a href="{{ route('booking') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 font-headline text-xs font-bold transition-all shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-slate-500" aria-hidden="true">photo_camera</span>
                    <span>Booking Ekip</span>
                </a>
            </div>
        </div>

        <!-- 3 Core Media Support Capabilities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Capability 1 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/40 hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-orange-50 text-primary flex items-center justify-center mb-4" aria-hidden="true">
                        <span class="material-symbols-outlined text-[22px]">smart_display</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">
                        TVC &amp; Video Sản Phẩm Số
                    </h3>
                    <p class="font-body text-xs text-slate-600 mt-2 leading-relaxed">
                        Sản xuất video demo tính năng Web-App, video giới thiệu giải pháp số và TVC quảng cáo digital với kịch bản cô đọng, sắc nét.
                    </p>
                </div>
                <span class="text-[11px] font-mono text-primary font-semibold mt-4 pt-3 border-t border-slate-100 block">
                    Product Demo &bull; Digital Ads
                </span>
            </div>

            <!-- Capability 2 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-amber-500/40 hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center mb-4" aria-hidden="true">
                        <span class="material-symbols-outlined text-[22px]">history_edu</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">
                        Phim Doanh Nghiệp
                    </h3>
                    <p class="font-body text-xs text-slate-600 mt-2 leading-relaxed">
                        Xây dựng video hồ sơ năng lực, phỏng vấn ban lãnh đạo và quy trình vận hành giúp tăng uy tín thương hiệu khi tiếp cận khách hàng.
                    </p>
                </div>
                <span class="text-[11px] font-mono text-amber-700 font-semibold mt-4 pt-3 border-t border-slate-100 block">
                    Brand Profile &bull; Heritage
                </span>
            </div>

            <!-- Capability 3 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-sky-500/40 hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center mb-4" aria-hidden="true">
                        <span class="material-symbols-outlined text-[22px]">photo_camera</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">
                        Ghi Hình Sự Kiện &amp; Booking Ekip
                    </h3>
                    <p class="font-body text-xs text-slate-600 mt-2 leading-relaxed">
                        Tác nghiệp đa máy quay, flycam 4K và cung cấp nhân sự quay phim, thiết bị Sony Cinema cơ động theo ngày hoặc theo buổi.
                    </p>
                </div>
                <span class="text-[11px] font-mono text-sky-700 font-semibold mt-4 pt-3 border-t border-slate-100 block">
                    Launch Event &bull; Media Crew
                </span>
            </div>
        </div>

    </div>
</section>
