<section class="w-full bg-white py-10 lg:py-14 border-b border-slate-200/80 relative overflow-hidden gsap-reveal-section" 
         id="media-support" 
         aria-labelledby="media-support-title">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-10 lg:space-y-12">
        
        <!-- ==================== 1. TOP HERO BANNER ==================== -->
        <div class="relative w-full flex flex-col lg:flex-row items-center justify-between min-h-[270px] lg:min-h-[300px]">
            
            <!-- Left: Content & 4 Features -->
            <div class="w-full lg:w-[48%] z-10 flex flex-col justify-center py-2 lg:py-4">
                <!-- Eyebrow -->
                <div class="flex items-center gap-2 mb-2.5">
                    <span style="display:inline-block; width:22px; height:3px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                    <span class="text-xs sm:text-[13px] font-extrabold text-[#0B132A] uppercase tracking-wider">SẢN XUẤT MEDIA &bull; TRUYỀN THÔNG THƯƠNG HIỆU <span class="sr-only">CREATIVE SUPPORT &bull; MEDIA IN-HOUSE (15%)</span></span>
                </div>
                
                <!-- Title -->
                <h2 id="media-support-title" class="font-headline text-3xl sm:text-4xl lg:text-[40px] font-black text-[#0B132A] tracking-tight leading-[1.16]">
                    Công Nghệ Tạo Nền Tảng &bull;<br>
                    <span style="color: #ff5500 !important;">Media Truyền Tải Giá Trị</span>
                </h2>
                
                <!-- Subtitle -->
                <p class="font-body text-slate-500 text-xs sm:text-[13.5px] mt-3 leading-relaxed max-w-xl">
                    Đội ngũ Media in-house đồng hành cùng các dự án công nghệ của Cửu Long từ khâu lên ý tưởng, sản xuất đến hậu kỳ, giúp thương hiệu của bạn lan tỏa mạnh mẽ qua những nội dung sáng tạo và chuyên nghiệp.
                </p>

                <!-- 4 Features in ONE horizontal row -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-1">
                    <!-- 1. Sản xuất video -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">videocam</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Sản xuất video</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">chuyên nghiệp</span>
                        </div>
                    </div>

                    <!-- 2. Hậu kỳ & dựng phim -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">play_arrow</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Hậu kỳ &amp; dựng phim</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">hiện đại</span>
                        </div>
                    </div>

                    <!-- 3. Ý tưởng sáng tạo -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">lightbulb</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Ý tưởng sáng tạo</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">đa nền tảng</span>
                        </div>
                    </div>

                    <!-- 4. Tối ưu nội dung -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">star</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Tối ưu nội dung</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">cho thương hiệu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Studio Camera Image with CSS fade from blur/transparent to clear -->
            <div class="w-full lg:w-[65%] lg:absolute lg:right-0 lg:top-0 lg:bottom-0 h-[230px] sm:h-[280px] lg:h-full flex items-center justify-end pointer-events-none select-none overflow-hidden"
                 style="-webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.15) 15%, rgba(0,0,0,0.8) 42%, #000 65%); mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.15) 15%, rgba(0,0,0,0.8) 42%, #000 65%);">
                <img src="{{ asset('images/media/media_hero_banner_2x.png') }}?v={{ filemtime(public_path('images/media/media_hero_banner_2x.png')) }}" 
                     alt="Sản xuất Media &amp; Truyền thông thương hiệu" 
                     class="w-full h-full object-cover object-right block"
                     loading="eager"
                     decoding="async">
            </div>
        </div>

        <!-- ==================== 2. DỊCH VỤ MEDIA NỔI BẬT (5 SERVICE CARDS) ==================== -->
        <div class="space-y-6">
            <!-- Header Row -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-5">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span style="display:inline-block; width:22px; height:3px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                        <span class="text-xs font-extrabold text-[#0B132A] uppercase tracking-wider">DỊCH VỤ MEDIA NỔI BẬT</span>
                    </div>
                    <h3 class="font-headline text-2xl sm:text-3xl font-black text-[#0B132A] tracking-tight">
                        Sản Xuất Nội Dung Đa Dạng &mdash; Phủ Sóng Mọi Nền Tảng
                    </h3>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-4 lg:gap-6">
                    <p class="font-body text-xs sm:text-[13px] text-slate-500 leading-relaxed max-w-md">
                        Từ video quảng cáo, TVC, livestream, đến các nội dung social media, chúng tôi mang đến giải pháp truyền thông trọn gói, phù hợp với mọi quy mô doanh nghiệp.
                    </p>
                    <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                        <a href="{{ route('services.media') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#ff5500] hover:bg-[#e04a00] text-white font-headline text-xs sm:text-sm font-bold shadow-sm hover:shadow-md transition-all">
                            <span class="material-symbols-outlined text-[18px]">movie</span>
                            <span>Khám phá dịch vụ Media</span>
                            <span class="font-bold select-none">&rarr;</span>
                        </a>
                        <a href="{{ route('booking') }}" 
                           class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-headline text-xs sm:text-sm font-semibold transition-all">
                            <span>Booking Ekip</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 5 Service Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 lg:gap-4 items-stretch">
                
                <!-- Card 1: Chụp Ảnh Sự Kiện -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_1_tvc_2x.png') }}?v={{ filemtime(public_path('images/media/service_1_tvc_2x.png')) }}" 
                             alt="Chụp Ảnh Sự Kiện" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Chụp Ảnh Sự Kiện
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Lưu giữ những khoảnh khắc đáng nhớ tại các sự kiện doanh nghiệp, hội nghị, hội thảo, ra mắt sản phẩm, lễ kỷ niệm...
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Quay Phim Sự Kiện -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_2_livestream_2x.png') }}?v={{ filemtime(public_path('images/media/service_2_livestream_2x.png')) }}" 
                             alt="Quay Phim Sự Kiện" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Quay Phim Sự Kiện
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Tạo nên những thước phim chuyên nghiệp, sống động, truyền tải trọn vẹn tinh thần và thông điệp của sự kiện.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Chụp Ảnh Teambuilding -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_3_corporate_2x.png') }}?v={{ filemtime(public_path('images/media/service_3_corporate_2x.png')) }}" 
                             alt="Chụp Ảnh Teambuilding" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Chụp Ảnh Teambuilding
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Ghi lại những khoảnh khắc gắn kết, tràn đầy năng lượng và tinh thần đồng đội trong các hoạt động teambuilding.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Quay Phim Teambuilding -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_4_postprod_2x.png') }}?v={{ filemtime(public_path('images/media/service_4_postprod_2x.png')) }}" 
                             alt="Quay Phim Teambuilding" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Quay Phim Teambuilding
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Biến những hoạt động tập thể thành thước phim ấn tượng, truyền cảm hứng và lưu giữ kỷ niệm lâu dài.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Quay Chụp Flycam -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_5_social_2x.png') }}?v={{ filemtime(public_path('images/media/service_5_social_2x.png')) }}" 
                             alt="Quay Chụp Flycam" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Quay Chụp Flycam
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Mang đến những góc nhìn ấn tượng từ trên cao, giúp hình ảnh và thước phim của bạn thêm phần độc đáo và chuyên nghiệp.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
