{{-- 
    UI-10: FINAL CONVERSION BAND / CTA ARCHITECTURE
    Section chuyển đổi cuối Homepage: định vị rõ ràng bài toán kinh doanh -> tư vấn giải pháp kỹ thuật.
    Định vị: Technology First, Conversion Path minh bạch, không áp lực giả tạo.
--}}
<section class="w-full relative overflow-hidden py-16 lg:py-20 bg-gradient-to-br from-[#070F1E] via-[#0C1A30] to-navy-base text-white gsap-reveal-section border-t border-slate-800" 
         id="final-conversion-band"
         aria-labelledby="final-cta-title">
    
    <!-- Anchor alias for backward compatibility -->
    <div id="cta-contact" class="absolute -top-20 opacity-0 pointer-events-none" aria-hidden="true"></div>

    <!-- Ambient Tech Glow Accents -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-gradient-to-b from-primary/15 via-sky-500/10 to-transparent blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-10 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 flex flex-col items-center gap-6">
        
        <!-- Eyebrow -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-amber-300 font-mono text-xs font-bold border border-white/15 shadow-2xs">
            <span class="material-symbols-outlined text-[16px] text-primary" aria-hidden="true">terminal</span>
            <span>BẮT ĐẦU DỰ ÁN &bull; TƯ VẤN GIẢI PHÁP CÔNG NGHỆ</span>
        </div>

        <!-- Section H2 -->
        <h2 id="final-cta-title" class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white max-w-3xl leading-tight">
            Bạn Đang Có Một Bài Toán Cần Giải Quyết?
        </h2>

        <!-- Problem-First Supporting Copy -->
        <p class="font-body text-slate-300 text-base sm:text-lg max-w-2xl leading-relaxed">
            Hãy chia sẻ mục tiêu kinh doanh, quy trình hiện tại hoặc vấn đề vận hành doanh nghiệp đang gặp phải. Đội ngũ Cửu Long sẽ trực tiếp phân tích đề bài để xác định hướng giải pháp số và lộ trình triển khai khả thi nhất.
        </p>

        <!-- Primary & Secondary Action CTAs -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4 pt-2 w-full sm:w-auto">
            <!-- Primary Conversion CTA -->
            <a class="btn-primary-cta inline-flex items-center justify-center gap-2 px-9 py-4 rounded-full bg-primary hover:bg-orange-600 text-white font-headline text-sm font-bold shadow-lg shadow-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-all group focus-visible:ring-2 focus-visible:ring-white focus-visible:outline-none" 
               href="{{ route('contact') }}">
                <span>Bắt đầu dự án</span>
                <span class="material-symbols-outlined text-[19px] text-amber-300 group-hover:translate-x-0.5 transition-transform" aria-hidden="true">arrow_forward</span>
            </a>

            <!-- Secondary Exploration CTA -->
            <a class="btn-secondary-cta inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-white/10 hover:bg-white/20 text-white font-headline text-sm font-semibold border border-white/20 hover:border-white/40 transition-all focus-visible:ring-2 focus-visible:ring-white focus-visible:outline-none" 
               href="{{ route('services.index') }}">
                <span class="material-symbols-outlined text-[18px] text-slate-300" aria-hidden="true">terminal</span>
                <span>Xem giải pháp công nghệ</span>
            </a>
        </div>

        <!-- Trust & Clarity Badges (Zero fake claims) -->
        <div class="pt-6 border-t border-white/10 w-full max-w-2xl flex flex-wrap items-center justify-center gap-x-8 gap-y-2 text-xs font-mono text-slate-400">
            <div class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-emerald-400" aria-hidden="true">check_circle</span>
                <span>Tư vấn kỹ thuật theo bài toán thực tế</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-emerald-400" aria-hidden="true">check_circle</span>
                <span>Đặc tả kiến trúc &amp; lộ trình rõ ràng</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-emerald-400" aria-hidden="true">check_circle</span>
                <span>Năng lực Media in-house hỗ trợ</span>
            </div>
        </div>

    </div>
</section>