{{-- 
    UI-10: FINAL CONVERSION BAND / CTA ARCHITECTURE
    Section chuyển đổi cuối Homepage: "Bạn Đang Có Một Bài Toán Cần Giải Quyết?"
    Định vị: Technology First, Web/App/AI, 5 Floating HUD Badges & High-Tech Workspace.
--}}
<section class="w-full relative overflow-hidden py-14 lg:py-18 text-white border-t border-slate-800/80" 
         style="background-color: #060A12;"
         id="final-conversion-band"
         aria-labelledby="final-cta-title">
    
    <!-- Anchor alias for backward compatibility -->
    <div id="cta-contact" class="absolute -top-20 opacity-0 pointer-events-none" aria-hidden="true"></div>

    <!-- Ambient High-Tech Glow Accents -->
    <div class="absolute -top-32 right-1/4 w-[500px] h-[300px] bg-orange-600/10 rounded-full blur-[100px] pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 bg-amber-500/10 rounded-full blur-[120px] pointer-events-none" aria-hidden="true"></div>
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-64 h-64 bg-orange-500/5 rounded-full blur-[80px] pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
            
            <!-- ==================== LEFT COLUMN: CONTENT & ACTIONS (7 Cols) ==================== -->
            <div class="lg:col-span-7 flex flex-col">
                <!-- Eyebrow Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/15 text-xs font-bold uppercase tracking-wider mb-4 self-start">
                    <span class="text-[#ff5500] font-mono text-sm leading-none">&lt;/&gt;</span>
                    <span class="text-white text-[11px] sm:text-xs tracking-wider">LẬP TRÌNH • WEB APP • MOBILE APP • AI</span>
                </div>

                <!-- Section H2 Title -->
                <h2 id="final-cta-title" class="font-headline text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight text-white leading-[1.18] mb-4">
                    Bạn Đang Có Một Bài Toán <br>
                    <span class="text-[#ff5500]">Cần Giải Quyết?</span>
                </h2>

                <!-- Problem-First Supporting Copy -->
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl mb-7">
                    Trao đổi với Cửu Long để làm rõ bài toán, phạm vi và hướng triển khai. Chúng tôi luôn sẵn sàng lắng nghe và đưa ra giải pháp phù hợp nhất với mục tiêu của bạn.
                </p>

                <!-- Primary & Secondary Action CTAs -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 mb-8">
                    <!-- Primary Conversion CTA -->
                    <a class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full bg-[#ff5500] hover:bg-[#e04b00] text-white font-headline text-sm font-bold shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all group focus-visible:ring-2 focus-visible:ring-white focus-visible:outline-none" 
                       href="{{ route('contact') }}">
                        <span class="material-symbols-outlined text-[19px]">chat</span>
                        <span>Bắt đầu dự án</span>
                        <span class="font-bold select-none group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>

                    <!-- Secondary Exploration CTA -->
                    <a class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-full bg-white/5 hover:bg-white/10 text-white font-headline text-sm font-semibold border border-white/20 hover:border-[#ff5500] transition-all group focus-visible:ring-2 focus-visible:ring-white focus-visible:outline-none" 
                       href="{{ route('services.index') }}">
                        <span class="material-symbols-outlined text-[19px] text-[#ff5500]">terminal</span>
                        <span>Xem giải pháp công nghệ</span>
                        <span class="font-bold select-none group-hover:translate-x-1 transition-transform text-slate-400 group-hover:text-white">&rarr;</span>
                    </a>
                </div>

                <!-- Trust & Clarity Badges (4 Points from Design) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-white/10 text-slate-300">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-[#ff5500]/60 flex items-center justify-center shrink-0 text-[#ff5500] bg-[#ff5500]/10">
                            <span class="text-[10px] font-mono font-bold leading-none">&lt;/&gt;</span>
                        </div>
                        <span class="text-[11.5px] sm:text-xs leading-snug">Tư vấn chuyên sâu theo nhu cầu thực tế</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-[#ff5500]/60 flex items-center justify-center shrink-0 text-[#ff5500] bg-[#ff5500]/10">
                            <span class="material-symbols-outlined text-[13px]">smartphone</span>
                        </div>
                        <span class="text-[11.5px] sm:text-xs leading-snug">Đội ngũ chuyên gia giàu kinh nghiệm</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-[#ff5500]/60 flex items-center justify-center shrink-0 text-[#ff5500] bg-[#ff5500]/10">
                            <span class="material-symbols-outlined text-[13px]">cloud</span>
                        </div>
                        <span class="text-[11.5px] sm:text-xs leading-snug">Đề xuất giải pháp tối ưu chi phí</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-[#ff5500]/60 flex items-center justify-center shrink-0 text-[#ff5500] bg-[#ff5500]/10">
                            <span class="material-symbols-outlined text-[13px]">verified_user</span>
                        </div>
                        <span class="text-[11.5px] sm:text-xs leading-snug">Đồng hành từ ý tưởng đến triển khai</span>
                    </div>
                </div>

            </div>

            <!-- ==================== RIGHT COLUMN: TECH WORKSPACE VISUAL (5 Cols) ==================== -->
            <div class="lg:col-span-5 relative w-full flex items-center justify-center lg:justify-end">
                <div class="relative w-full max-w-[560px] overflow-hidden rounded-2xl group">
                    <img src="{{ asset('images/cta/tech_workspace_visual.png') }}" 
                         alt="Hệ sinh thái giải pháp công nghệ - Cửu Long Media" 
                         class="w-full h-auto object-contain drop-shadow-2xl group-hover:scale-[1.02] transition-transform duration-700" 
                         loading="lazy"
                         width="489"
                         height="361">
                </div>
            </div>

        </div>
    </div>
</section>