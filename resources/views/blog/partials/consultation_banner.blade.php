<!-- ==================== CẦN TƯ VẤN CHIẾN LƯỢC TVC & PHẦN MỀM DOANH NGHIỆP ==================== -->
<div class="mt-14 sm:mt-18 relative rounded-[28px] sm:rounded-[36px] overflow-hidden border border-white/10 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.5)] select-none"
     style="background: linear-gradient(135deg, #0c101c 0%, #0e1526 50%, #151b2e 100%);">
    
    <!-- Background Orange Ambient Glows -->
    <div class="absolute -right-24 -top-24 w-[500px] h-[500px] rounded-full bg-[#FF5E14]/20 blur-[130px] pointer-events-none"></div>
    <div class="absolute right-12 bottom-0 w-[400px] h-[400px] rounded-full bg-[#FFA033]/15 blur-[100px] pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] opacity-[0.035] [background-size:24px_24px] pointer-events-none"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 items-center gap-8 lg:gap-10 p-6 sm:p-10 lg:p-12 xl:p-14">
        
        <!-- Left Content Column (7 cols) -->
        <div class="lg:col-span-7 flex flex-col items-start text-left">
            
            <!-- 1. Pill Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-white text-xs font-bold uppercase tracking-wider shadow-sm border border-white/10 mb-4"
                 style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%) !important;">
                <span class="material-symbols-outlined text-[16px] text-white">lightbulb</span>
                <span style="color: #ffffff !important;">Tư vấn miễn phí</span>
            </div>

            <!-- 2. Main Title -->
            <h3 class="font-headline font-black text-2xl sm:text-3xl lg:text-[34px] xl:text-[38px] text-white leading-[1.25] mb-3.5 tracking-tight">
                Cần Tư Vấn Chiến Lược <span style="color: #FF7A29 !important; background: linear-gradient(135deg, #FFA033 0%, #FF5E14 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TVC &amp; Phần Mềm Doanh Nghiệp?</span>
            </h3>

            <!-- 3. Subtitle -->
            <p class="font-body text-slate-300 text-xs sm:text-sm lg:text-[15px] leading-relaxed max-w-xl mb-6 font-normal">
                Chuyên gia Truyền Thông Cửu Long trực tiếp khảo sát và lập đề xuất giải pháp sản xuất – công nghệ riêng cho bạn.
            </p>

            <!-- 4. CTA Button -->
            <div class="mb-8">
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center gap-3 px-6 sm:px-8 py-3.5 sm:py-4 rounded-full text-white font-headline font-bold text-xs sm:text-sm tracking-wide transition-all duration-300 hover:scale-[1.03] active:scale-[0.98] group"
                   style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%) !important; box-shadow: 0 8px 30px rgba(255, 94, 20, 0.5) !important;">
                    <span class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-white text-[#FF5E14] flex items-center justify-center shrink-0 shadow-xs group-hover:translate-x-0.5 transition-transform"
                          style="color: #FF5E14 !important;">
                        <span class="material-symbols-outlined text-[16px] sm:text-[18px] font-black">arrow_forward</span>
                    </span>
                    <span class="text-white" style="color: #ffffff !important;">Liên hệ tư vấn ngay</span>
                </a>
            </div>

            <!-- 5. Value Proposition Footer -->
            <div class="pt-5 border-t border-white/10 flex flex-wrap items-center gap-4 sm:gap-6 text-xs text-slate-300 w-full">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[19px] text-[#FFA033]">verified_user</span>
                    <span class="font-medium text-slate-200">Tư vấn chuyên sâu</span>
                </div>
                <div class="hidden sm:block w-px h-4 bg-white/20"></div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[19px] text-[#FFA033]">track_changes</span>
                    <span class="font-medium text-slate-200">Giải pháp đo ni đóng giày</span>
                </div>
                <div class="hidden sm:block w-px h-4 bg-white/20"></div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[19px] text-[#FFA033]">handshake</span>
                    <span class="font-medium text-slate-200">Đồng hành lâu dài</span>
                </div>
            </div>

        </div>

        <!-- Right Artwork Column (5 cols) -->
        <div class="lg:col-span-5 flex items-center justify-center lg:justify-end relative">
            <img src="{{ asset('images/blog/consultation_3d_graphic.png') }}" 
                 alt="Chiến lược TVC &amp; Phần mềm doanh nghiệp" 
                 class="w-full max-w-[340px] sm:max-w-[420px] lg:max-w-none h-auto object-contain drop-shadow-[0_20px_45px_rgba(255,94,20,0.38)] hover:scale-105 transition-transform duration-700">
        </div>

    </div>
</div>
