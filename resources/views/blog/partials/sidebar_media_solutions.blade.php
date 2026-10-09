<!-- ==================== GIẢI PHÁP TRUYỀN THÔNG TOÀN DIỆN CHO DOANH NGHIỆP ==================== -->
<div class="rounded-[28px] sm:rounded-[32px] overflow-hidden border-2 border-[#FFA033] shadow-[0_15px_40px_rgba(255,94,20,0.12)] relative flex flex-col group transition-all duration-300 hover:shadow-[0_20px_50px_rgba(255,94,20,0.18)]"
     style="background: linear-gradient(180deg, #FFFFFF 0%, #FFFDF9 60%, #FFF5ED 100%);">
    
    <!-- Top-Right Orange Corner Wave Accent -->
    <div class="absolute top-0 right-0 w-36 h-28 pointer-events-none overflow-hidden z-0">
        <div class="w-44 h-44 -mr-16 -mt-20 rounded-full" 
             style="background: linear-gradient(135deg, #FFA033 0%, #FF5E14 100%);"></div>
    </div>

    <!-- 1. Header (Logo + Slogan) -->
    <div class="p-5 sm:p-6 pb-2 flex items-center justify-between relative z-10">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo-ttcl.png') }}" 
                 alt="Truyền Thông Cửu Long" 
                 class="w-9 h-9 object-contain drop-shadow-xs">
            <div class="flex flex-col text-left">
                <span class="font-headline font-black text-[11px] text-[#0F1E36] tracking-wider uppercase leading-none">TRUYỀN THÔNG</span>
                <span class="font-headline font-black text-[15px] text-[#0F1E36] tracking-tight uppercase leading-none mt-0.5">CỬU LONG</span>
            </div>
        </div>
        <div class="flex flex-col items-end text-right">
            <span class="font-serif italic font-bold text-xs sm:text-[13px] leading-tight text-white drop-shadow-xs">Sáng tạo</span>
            <span class="font-serif italic font-bold text-xs sm:text-[13px] leading-tight text-white drop-shadow-xs">Kiến tạo giá trị</span>
        </div>
    </div>

    <!-- 2. Main Title & Description -->
    <div class="px-5 sm:px-6 pt-2 pb-1 relative z-10">
        <h3 class="font-headline font-black text-lg sm:text-[21px] text-[#0F1E36] leading-[1.28] tracking-tight text-left">
            Giải Pháp Truyền Thông<br>Toàn Diện Cho Doanh Nghiệp
        </h3>
        <p class="font-body text-[11px] sm:text-xs text-slate-500 leading-relaxed mt-2 text-left">
            Từ ý tưởng đến hiện thực, chúng tôi đồng hành cùng bạn trên hành trình xây dựng thương hiệu và phát triển bền vững.
        </p>
    </div>

    <!-- 3. Service Rows (5 Service Items) -->
    <div class="px-5 sm:px-6 py-2.5 flex flex-col gap-2 relative z-10">
        
        <!-- Service 1: Sản xuất phim & TVC -->
        <a href="{{ route('services.media') }}" 
           class="flex items-center justify-between p-2 sm:p-2.5 rounded-2xl bg-white hover:bg-orange-50/60 border border-orange-100 hover:border-orange-300 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-md transition-all duration-300 group/item">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 sm:w-8.5 sm:h-8.5 rounded-full flex items-center justify-center shrink-0 text-white shadow-xs"
                     style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);">
                    <span class="material-symbols-outlined text-[17px] text-white">videocam</span>
                </div>
                <div class="flex flex-col text-left min-w-0">
                    <span class="font-headline font-bold text-xs text-[#0F1E36] group-hover/item:text-[#FF5E14] transition-colors truncate">Sản xuất phim &amp; TVC</span>
                    <span class="font-body text-[9.5px] text-slate-400 truncate">Chuyên nghiệp - Sáng tạo - Hiệu quả</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-[15px] text-[#FF5E14] group-hover/item:translate-x-0.5 transition-transform">chevron_right</span>
        </a>

        <!-- Service 2: Thiết kế & Lập trình Web-App -->
        <a href="{{ route('services.web-app') }}" 
           class="flex items-center justify-between p-2 sm:p-2.5 rounded-2xl bg-white hover:bg-orange-50/60 border border-orange-100 hover:border-orange-300 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-md transition-all duration-300 group/item">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 sm:w-8.5 sm:h-8.5 rounded-full flex items-center justify-center shrink-0 text-white shadow-xs"
                     style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);">
                    <span class="material-symbols-outlined text-[17px] text-white">desktop_windows</span>
                </div>
                <div class="flex flex-col text-left min-w-0">
                    <span class="font-headline font-bold text-xs text-[#0F1E36] group-hover/item:text-[#FF5E14] transition-colors truncate">Thiết kế &amp; Lập trình Web-App</span>
                    <span class="font-body text-[9.5px] text-slate-400 truncate">Hiện đại - Tối ưu - Chuẩn SEO</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-[15px] text-[#FF5E14] group-hover/item:translate-x-0.5 transition-transform">chevron_right</span>
        </a>

        <!-- Service 3: Quảng cáo Google & Facebook -->
        <a href="{{ route('services.marketing') }}" 
           class="flex items-center justify-between p-2 sm:p-2.5 rounded-2xl bg-white hover:bg-orange-50/60 border border-orange-100 hover:border-orange-300 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-md transition-all duration-300 group/item">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 sm:w-8.5 sm:h-8.5 rounded-full flex items-center justify-center shrink-0 text-white shadow-xs"
                     style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);">
                    <span class="material-symbols-outlined text-[17px] text-white">campaign</span>
                </div>
                <div class="flex flex-col text-left min-w-0">
                    <span class="font-headline font-bold text-xs text-[#0F1E36] group-hover/item:text-[#FF5E14] transition-colors truncate">Quảng cáo Google &amp; Facebook</span>
                    <span class="font-body text-[9.5px] text-slate-400 truncate">Tăng trưởng doanh thu - Tiếp cận đúng khách hàng</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-[15px] text-[#FF5E14] group-hover/item:translate-x-0.5 transition-transform">chevron_right</span>
        </a>

        <!-- Service 4: 3D Motion Design & AI Studio -->
        <a href="{{ route('services.media') }}" 
           class="flex items-center justify-between p-2 sm:p-2.5 rounded-2xl bg-white hover:bg-orange-50/60 border border-orange-100 hover:border-orange-300 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-md transition-all duration-300 group/item">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 sm:w-8.5 sm:h-8.5 rounded-full flex items-center justify-center shrink-0 text-white shadow-xs"
                     style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);">
                    <span class="material-symbols-outlined text-[17px] text-white">view_in_ar</span>
                </div>
                <div class="flex flex-col text-left min-w-0">
                    <span class="font-headline font-bold text-xs text-[#0F1E36] group-hover/item:text-[#FF5E14] transition-colors truncate">3D Motion Design &amp; AI Studio</span>
                    <span class="font-body text-[9.5px] text-slate-400 truncate">Đột phá công nghệ - Tạo nên khác biệt</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-[15px] text-[#FF5E14] group-hover/item:translate-x-0.5 transition-transform">chevron_right</span>
        </a>

        <!-- Service 5: Booking Team Media -->
        <a href="{{ route('booking') }}" 
           class="flex items-center justify-between p-2 sm:p-2.5 rounded-2xl bg-white hover:bg-orange-50/60 border border-orange-100 hover:border-orange-300 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-md transition-all duration-300 group/item">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 sm:w-8.5 sm:h-8.5 rounded-full flex items-center justify-center shrink-0 text-white shadow-xs"
                     style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);">
                    <span class="material-symbols-outlined text-[17px] text-white">groups</span>
                </div>
                <div class="flex flex-col text-left min-w-0">
                    <span class="font-headline font-bold text-xs text-[#0F1E36] group-hover/item:text-[#FF5E14] transition-colors truncate">Booking Team Media</span>
                    <span class="font-body text-[9.5px] text-slate-400 truncate">Linh hoạt - Chuyên nghiệp - Hiệu quả</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-[15px] text-[#FF5E14] group-hover/item:translate-x-0.5 transition-transform">chevron_right</span>
        </a>

    </div>

    <!-- 4. CTA Button (Khám phá dịch vụ) -->
    <div class="px-5 sm:px-6 pt-2 pb-1 relative z-10 text-left">
        <a href="{{ route('services.index') }}" 
           class="inline-flex items-center justify-center gap-3 px-6 py-2.5 sm:py-3 rounded-full text-white font-headline font-bold text-xs sm:text-sm tracking-wide shadow-[0_6px_20px_rgba(255,94,20,0.45)] hover:shadow-[0_8px_25px_rgba(255,94,20,0.6)] hover:scale-[1.03] active:scale-[0.98] transition-all group"
           style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);">
            <span style="color: #ffffff !important;">Khám phá dịch vụ</span>
            <span class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-white text-[#FF5E14] flex items-center justify-center shrink-0 shadow-xs group-hover:translate-x-0.5 transition-transform"
                  style="color: #FF5E14 !important;">
                <span class="material-symbols-outlined text-[13px] sm:text-[14px] font-black" style="color: #FF5E14 !important;">arrow_forward</span>
            </span>
        </a>
    </div>

    <!-- 5. 3D Desk Showcase Artwork -->
    <div class="relative w-full overflow-hidden -mt-2 select-none pointer-events-none z-0">
        <img src="{{ asset('images/blog/sidebar_desk_clean.png') }}" 
             alt="Truyền Thông Cửu Long Workspace" 
             class="w-full h-auto object-cover block"
             loading="lazy">
    </div>

    <!-- 6. Bottom Orange Footer Bar (3 Value Badges) -->
    <div class="w-full py-3 px-3 sm:px-4 flex items-center justify-between text-white relative z-10"
         style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);">
        <div class="flex items-center gap-1.5 text-left">
            <span class="material-symbols-outlined text-[16px] text-white shrink-0">verified_user</span>
            <span class="font-headline font-bold text-[9.5px] sm:text-[10px] text-white leading-tight">Uy tín<br>chuyên nghiệp</span>
        </div>
        <div class="w-px h-5 bg-white/30"></div>
        <div class="flex items-center gap-1.5 text-left">
            <span class="material-symbols-outlined text-[16px] text-white shrink-0">lightbulb</span>
            <span class="font-headline font-bold text-[9.5px] sm:text-[10px] text-white leading-tight">Sáng tạo<br>khác biệt</span>
        </div>
        <div class="w-px h-5 bg-white/30"></div>
        <div class="flex items-center gap-1.5 text-left">
            <span class="material-symbols-outlined text-[16px] text-white shrink-0">handshake</span>
            <span class="font-headline font-bold text-[9.5px] sm:text-[10px] text-white leading-tight">Đồng hành<br>lâu dài</span>
        </div>
    </div>

</div>
