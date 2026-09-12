<section class="w-full relative overflow-hidden py-14 lg:py-18 bg-gradient-to-r from-navy-base via-primary to-accent-coral animate-gradient-flow text-white gsap-reveal-section" id="cta-contact">
    <!-- Light Streaks flying across background -->
    <div class="light-streak"></div>
    <div class="light-streak light-streak-delay"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 flex flex-col items-center gap-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-white font-mono text-xs font-bold shadow-sm">
            <span class="material-symbols-outlined text-[16px]">rocket_launch</span>
            <span>SẴN SÀNG TẠO NÊN DẤU ẤN ĐỘT PHÁ?</span>
        </div>

        <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white max-w-3xl leading-tight">
            Hãy Cùng Truyền Thông Cửu Long Biến Tầm Nhìn Thương Hiệu Thành Hiện Thực
        </h2>

        <p class="font-body text-white/90 text-base sm:text-lg max-w-2xl leading-relaxed">
            Cho dù bạn cần một bộ phim TVC chuẩn điện ảnh chạm đến trái tim hàng triệu khán giả hay một nền tảng công nghệ số chịu tải hàng triệu người dùng &mdash; chúng tôi luôn sẵn sàng lắng nghe và tư vấn giải pháp tối ưu.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a class="btn-primary-cta magnetic-btn inline-flex items-center gap-2 px-9 py-4 rounded-full bg-white text-navy-base font-headline text-sm font-bold shadow-[0_10px_30px_rgba(0,0,0,0.25)] hover:bg-slate-100 hover:scale-105 transition-all" href="{{ route('contact') }}">
                <span>Bắt Đầu Một Dự Án</span>
                <span class="material-symbols-outlined text-[19px] text-primary">arrow_forward</span>
            </a>
            <a class="btn-secondary-cta magnetic-btn inline-flex items-center gap-2 px-8 py-4 rounded-full bg-navy-base/60 backdrop-blur-md text-white font-headline text-sm font-semibold border border-white/30 hover:bg-navy-base/80 hover:border-white transition-all" href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939363262')) }}">
                <span class="material-symbols-outlined">call</span>
                <span>Hotline: {{ get_setting('company_phone', '0939 363 262') }}</span>
            </a>
        </div>
    </div>
</section>