<section class="w-full bg-surface-low bg-dot-grid-subtle py-14 lg:py-20 text-slate-900 relative overflow-hidden border-b border-slate-200/80 gsap-reveal-section" id="why-clm">
    <!-- Interactive Mouse Spotlight Overlay -->
    <div class="spotlight-overlay" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-16 lg:space-y-20">

        <!-- ==================== 1. BA NHÓM GIẢI PHÁP CÔNG NGHỆ TRỌNG TÂM ==================== -->
        <div class="space-y-10" id="technology-solutions">
            
            <!-- Header Section: Left Content + Right Devices Mockup Showcase -->
            <div class="relative flex flex-col lg:flex-row lg:items-center justify-between gap-8 pb-4">
                
                <!-- Left Column: Eyebrow, Main Title, Subtitle, 3 Value Badges -->
                <div class="max-w-2xl relative z-10">
                    <!-- Eyebrow -->
                    <div class="flex items-center gap-2.5 mb-3.5">
                        <span style="display:inline-block; width:34px; height:4px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                        <span class="text-xs sm:text-[13px] font-extrabold text-[#0B132A] uppercase tracking-wider">NĂNG LỰC CỐT LÕI &bull; TECHNOLOGY SOLUTIONS</span>
                    </div>

                    <!-- Title -->
                    <h2 class="font-headline text-3xl sm:text-4xl lg:text-[44px] font-black text-[#0B132A] tracking-tight leading-[1.18]">
                        Ba Nhóm Giải Pháp Công Nghệ<br>
                        <span style="color: #ff5500 !important;">Trọng Tâm</span>
                    </h2>

                    <!-- Subtitle -->
                    <p class="font-body text-slate-500 text-sm sm:text-[15px] mt-3.5 leading-relaxed">
                        Tập trung giải quyết bài toán vận hành, quản trị dữ liệu và tiếp cận khách hàng trên nền tảng số của doanh nghiệp.
                    </p>

                    <!-- 3 Trust / Value Badges with Dividers -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-2 pt-6 mt-6 border-t border-slate-200/70 items-center">
                        <!-- Badge 1: Tư duy chiến lược -->
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-200/90 text-[#ff5500] flex items-center justify-center shrink-0 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-[13px] font-bold text-[#0B132A] leading-tight">Tư duy chiến lược</h4>
                                <p class="text-[11px] text-slate-500 leading-tight mt-1">Định hướng đúng nhu cầu thực tế của doanh nghiệp</p>
                            </div>
                        </div>

                        <!-- Badge 2: Giải pháp toàn diện -->
                        <div class="flex items-center gap-3 sm:border-l sm:border-slate-200 sm:pl-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-200/90 text-[#ff5500] flex items-center justify-center shrink-0 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                                    <polyline points="2 17 12 22 22 17"/>
                                    <polyline points="2 12 12 17 22 12"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-[13px] font-bold text-[#0B132A] leading-tight">Giải pháp toàn diện</h4>
                                <p class="text-[11px] text-slate-500 leading-tight mt-1">Từ tư vấn - thiết kế - triển khai đến vận hành</p>
                            </div>
                        </div>

                        <!-- Badge 3: Đồng hành dài hạn -->
                        <div class="flex items-center gap-3 sm:border-l sm:border-slate-200 sm:pl-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-200/90 text-[#ff5500] flex items-center justify-center shrink-0 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-[13px] font-bold text-[#0B132A] leading-tight">Đồng hành dài hạn</h4>
                                <p class="text-[11px] text-slate-500 leading-tight mt-1">Hỗ trợ, tối ưu và phát triển cùng doanh nghiệp</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Devices Mockup Collage + Handwriting Callout -->
                <div class="relative lg:w-5/12 flex items-center justify-center lg:justify-end pt-2 lg:pt-0">
                    <div class="relative w-full max-w-[480px] lg:max-w-[500px]">
                        <img src="{{ asset('images/solutions/solutions_top_right_showcase_2x.png') }}?v={{ filemtime(public_path('images/solutions/solutions_top_right_showcase_2x.png')) }}" 
                             alt="Ba Nhóm Giải Pháp Công Nghệ Trọng Tâm - Thiết bị và giải pháp thực tế" 
                             class="w-full h-auto block select-none pointer-events-none drop-shadow-sm" 
                             loading="eager"
                             decoding="async">
                    </div>
                </div>
            </div>

            <!-- 3 Solution Groups Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-7 items-stretch">
                
                <!-- CARD 1: Web App & Hệ Thống Quản Trị -->
                <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <!-- Photo with Floating Badge -->
                    <div class="relative w-full aspect-[1208/484] overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/solutions/card_1_photo_2x.png') }}?v={{ filemtime(public_path('images/solutions/card_1_photo_2x.png')) }}" 
                             alt="Web App & Hệ Thống Quản Trị" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="eager"
                             decoding="async">
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[11px] font-mono font-bold tracking-wider text-slate-500 uppercase block mb-1.5">01. WEB &amp; APP</span>
                            <h3 class="font-headline text-xl sm:text-[22px] font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-tight mb-3">
                                Web App &amp; Hệ Thống Quản Trị
                            </h3>
                            <p class="font-body text-slate-500 text-xs sm:text-[13px] leading-relaxed mb-5">
                                Xây dựng hệ thống phần mềm nghiệp vụ, quản lý dữ liệu tập trung, phân quyền đa cấp độ và sở hữu quy trình vận hành theo yêu cầu thực tế của doanh nghiệp.
                            </p>

                            <!-- Check Items -->
                            <ul class="space-y-2.5 pt-1 border-t border-slate-100 mb-6 text-xs sm:text-[13px] font-medium text-slate-700">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-[#ff5500] text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Phần mềm quản trị nội bộ &amp; ERP rút gọn</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-[#ff5500] text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Hệ thống đặt lịch &amp; hỗ trợ trực tuyến</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-[#ff5500] text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Kiến trúc mở, dễ dàng nâng cấp mở rộng</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Link -->
                        <div class="pt-2">
                            <a href="{{ route('services.web-app') }}" 
                               class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết giải pháp</span>
                                <span class="font-bold select-none leading-none">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: Website Doanh Nghiệp -->
                <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <!-- Photo with Floating Badge -->
                    <div class="relative w-full aspect-[1208/484] overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/solutions/card_2_photo_2x.png') }}?v={{ filemtime(public_path('images/solutions/card_2_photo_2x.png')) }}" 
                             alt="Website Doanh Nghiệp" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="eager"
                             decoding="async">
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[11px] font-mono font-bold tracking-wider text-slate-500 uppercase block mb-1.5">02. WEBSITE</span>
                            <h3 class="font-headline text-xl sm:text-[22px] font-bold text-[#0B132A] group-hover:text-blue-600 transition-colors leading-tight mb-3">
                                Website Doanh Nghiệp
                            </h3>
                            <p class="font-body text-slate-500 text-xs sm:text-[13px] leading-relaxed mb-5">
                                Thiết kế website theo yêu cầu nhận diện đặc bản hoặc lựa chọn từ thư viện giao diện chuẩn hóa cho 13 ngành nghề, tối ưu UX/UI và tốc độ tải trang.
                            </p>

                            <!-- Check Items -->
                            <ul class="space-y-2.5 pt-1 border-t border-slate-100 mb-6 text-xs sm:text-[13px] font-medium text-slate-700">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Thiết kế theo nhận diện thương hiệu</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Thư viện giao diện hiện đại, đa ngành nghề</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Tương thích đa thiết bị &amp; chuẩn SEO</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Link -->
                        <div class="pt-2">
                            <a href="{{ route('templates.index') }}" 
                               class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-blue-600 hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết giải pháp</span>
                                <span class="font-bold select-none leading-none">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: Quảng Cáo & Truyền Thông Số -->
                <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <!-- Photo with Floating Badge -->
                    <div class="relative w-full aspect-[1208/484] overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/solutions/card_3_photo_2x.png') }}?v={{ filemtime(public_path('images/solutions/card_3_photo_2x.png')) }}" 
                             alt="Quảng Cáo & Truyền Thông Số" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="eager"
                             decoding="async">
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[11px] font-mono font-bold tracking-wider text-slate-500 uppercase block mb-1.5">03. DIGITAL MARKETING</span>
                            <h3 class="font-headline text-xl sm:text-[22px] font-bold text-[#0B132A] group-hover:text-emerald-600 transition-colors leading-tight mb-3">
                                Quảng Cáo &amp; Truyền Thông Số
                            </h3>
                            <p class="font-body text-slate-500 text-xs sm:text-[13px] leading-relaxed mb-5">
                                Tăng trưởng thương hiệu và tiếp cận khách hàng mục tiêu thông qua các kênh digital hiện đại, với chiến lược được thiết kế riêng cho từng ngành hàng.
                            </p>

                            <!-- Check Items -->
                            <ul class="space-y-2.5 pt-1 border-t border-slate-100 mb-6 text-xs sm:text-[13px] font-medium text-slate-700">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Google Ads &amp; Facebook Ads</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>SEO tổng thể &amp; Local SEO</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                    <span>Social Media &amp; Content Marketing</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Link -->
                        <div class="pt-2">
                            <a href="{{ route('services.marketing') }}" 
                               class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-emerald-600 hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết giải pháp</span>
                                <span class="font-bold select-none leading-none">→</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom CTA Banner: Liên hệ ngay để nhận tư vấn giải pháp phù hợp! -->
            <div style="background: linear-gradient(90deg, #071530 0%, #0d234d 50%, #071530 100%) !important; border: 1px solid rgba(255, 255, 255, 0.12) !important; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.22) !important;" 
                 class="mt-10 sm:mt-12 rounded-[22px] text-white px-6 py-5 sm:px-8 sm:py-6 relative overflow-hidden flex flex-col lg:flex-row lg:items-center justify-between gap-5 lg:gap-6">
                <!-- Ambient Glow Background -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-[#ff5500]/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-10 -top-10 w-64 h-64 rounded-full bg-blue-600/15 blur-3xl pointer-events-none"></div>

                <!-- Left: Headline with Eyebrow -->
                <div class="relative z-10 lg:w-5/12">
                    <div class="flex items-center gap-2 mb-1.5">
                        <span style="display:inline-block; width:26px; height:3px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                        <span class="text-[10.5px] sm:text-[11px] font-bold text-slate-300 uppercase tracking-widest">SẴN SÀNG BẮT ĐẦU DỰ ÁN CỦA BẠN?</span>
                    </div>
                    <h3 class="text-base sm:text-lg lg:text-[19px] font-extrabold text-white leading-tight">
                        Liên hệ ngay để nhận <span style="color: #ff5500 !important;">tư vấn giải pháp</span> phù hợp!
                    </h3>
                </div>

                <!-- Middle: Contact Quick Links (Divider | Phone | Email | Fast response) -->
                <div class="relative z-10 lg:w-4/12 flex flex-wrap items-center gap-4 sm:gap-6 lg:border-l lg:border-white/15 lg:pl-6 text-xs text-slate-300">
                    <a href="tel:0939363262" class="inline-flex items-center gap-1.5 hover:text-white transition-colors">
                        <svg class="w-4 h-4 text-[#ff5500]" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57a1 1 0 01-.25 1.02l-2.2 2.2z"/></svg>
                        <span class="font-bold text-white">0939.363.262</span>
                    </a>
                    <a href="mailto:info@truyenthongcuulong.com" class="inline-flex items-center gap-1.5 hover:text-white transition-colors">
                        <svg class="w-4 h-4 text-[#ff5500]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                        <span>info@truyenthongcuulong.com</span>
                    </a>
                    <div class="inline-flex items-center gap-1.5 text-slate-400">
                        <svg class="w-4 h-4 text-[#ff5500]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Tư vấn nhanh</span>
                    </div>
                </div>

                <!-- Right: CTA Button -->
                <div class="relative z-10 lg:w-3/12 flex lg:justify-end shrink-0">
                    <a href="{{ route('contact') }}" 
                       style="background: linear-gradient(135deg, #ff6600 0%, #ff5500 100%) !important; color: #ffffff !important; box-shadow: 0 8px 24px rgba(255, 85, 0, 0.45) !important;"
                       class="inline-flex items-center justify-center gap-2 px-6 py-2.5 sm:py-3 rounded-full text-white font-headline text-xs sm:text-sm font-bold hover:scale-105 active:scale-95 transition-all whitespace-nowrap">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                        <span>Liên hệ ngay</span>
                        <span class="text-sm font-bold leading-none select-none">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- ==================== 2. NĂNG LỰC KỸ THUẬT & TRIỂN KHAI THỰC TẾ (REDESIGN) ==================== -->
        <div class="capabilities-section space-y-10">

            {{-- === HERO: 2-col header (text left + photo right) === --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center rounded-3xl bg-gradient-to-br from-slate-900 via-navy-base to-slate-800 p-8 sm:p-10 overflow-hidden relative">
                {{-- Decorative blur blob --}}
                <div class="absolute -top-20 -right-20 w-72 h-72 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -left-16 w-56 h-56 bg-sky-500/10 rounded-full blur-2xl pointer-events-none"></div>

                {{-- Left: Text --}}
                <div class="relative z-10 space-y-5">
                    <div class="inline-flex items-center gap-2">
                        <span class="w-7 h-px bg-primary"></span>
                        <span class="text-[11px] font-mono font-bold text-primary uppercase tracking-widest">Năng Lực Kỹ Thuật &amp; Triển Khai Thực Tế</span>
                    </div>
                    <div>
                        <h3 class="font-headline text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                            Công Nghệ Hiện Đại
                        </h3>
                        <h3 class="font-headline text-3xl sm:text-4xl font-extrabold text-primary leading-tight">
                            Kiến Tạo Giải Pháp Thực Tế
                        </h3>
                    </div>
                    <p class="font-body text-slate-300 text-sm leading-relaxed max-w-md">
                        Chúng tôi kết hợp giữa đội ngũ kỹ thuật giàu kinh nghiệm, quy trình triển khai chuyên nghiệp và công nghệ hiện đại để mang đến những sản phẩm số ổn định, hiệu quả và có khả năng mở rộng lâu dài.
                    </p>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-primary mt-0.5 shrink-0">groups</span>
                            <div>
                                <div class="font-headline text-xs font-bold text-white">Đội ngũ chuyên gia</div>
                                <div class="font-body text-[11px] text-slate-400">Kinh nghiệm thực chiến đa lĩnh vực.</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-sky-400 mt-0.5 shrink-0">memory</span>
                            <div>
                                <div class="font-headline text-xs font-bold text-white">Công nghệ hiện đại</div>
                                <div class="font-body text-[11px] text-slate-400">Đáp ứng linh hoạt mọi nhu cầu dự án.</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-emerald-400 mt-0.5 shrink-0">fact_check</span>
                            <div>
                                <div class="font-headline text-xs font-bold text-white">Quy trình chuẩn</div>
                                <div class="font-body text-[11px] text-slate-400">Minh bạch, hiệu quả, đúng tiến độ.</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-amber-400 mt-0.5 shrink-0">support_agent</span>
                            <div>
                                <div class="font-headline text-xs font-bold text-white">Hỗ trợ lâu dài</div>
                                <div class="font-body text-[11px] text-slate-400">Đồng hành cùng sự phát triển của bạn.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Developer Photo --}}
                <div class="relative z-10 hidden lg:block">
                    <div class="rounded-2xl overflow-hidden shadow-2xl border border-white/10" style="aspect-ratio:1575/738">
                        <img
                            src="{{ asset('images/solutions/capabilities_showcase_2x.webp') }}"
                            srcset="{{ asset('images/solutions/capabilities_showcase_2x.png') }} 1575w"
                            sizes="(min-width:1024px) 600px, 100vw"
                            alt="Đội ngũ lập trình viên Truyền Thông Cửu Long"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>

            {{-- === 5 CAPABILITY CARDS === --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                {{-- Card 1: Lập trình Web & Ứng dụng --}}
                <div class="cap-card group p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px] text-primary" style="line-height:1">code_blocks</span>
                        </div>
                        <div class="text-[10px] font-mono font-bold text-slate-400 uppercase tracking-wider">01. Web &amp; App</div>
                    </div>
                    <div>
                        <h4 class="font-headline text-sm font-bold text-navy-base mb-2 group-hover:text-primary transition-colors">Lập trình Web &amp; Ứng dụng</h4>
                        <p class="font-body text-[11px] text-slate-500 leading-relaxed">Phát triển website, web app, mobile app theo yêu cầu, tối ưu hiệu suất và trải nghiệm.</p>
                    </div>
                    <ul class="space-y-1.5 mt-auto">
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Laravel / PHP
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            React / Next.js
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Mobile App (Android / iOS)
                        </li>
                    </ul>
                    <a href="{{ route('services.show', 'web-app') }}" class="inline-flex items-center gap-1 text-[11px] font-mono font-bold text-primary hover:text-navy-base transition-colors mt-1 group/link">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined group-hover/link:translate-x-0.5 transition-transform" style="font-size:13px;line-height:1">arrow_forward</span>
                    </a>
                </div>

                {{-- Card 2: Hạ tầng & Cloud --}}
                <div class="cap-card group p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px] text-primary" style="line-height:1">cloud</span>
                        </div>
                        <div class="text-[10px] font-mono font-bold text-slate-400 uppercase tracking-wider">02. Cloud</div>
                    </div>
                    <div>
                        <h4 class="font-headline text-sm font-bold text-navy-base mb-2 group-hover:text-primary transition-colors">Hạ tầng &amp; Cloud</h4>
                        <p class="font-body text-[11px] text-slate-500 leading-relaxed">Triển khai hạ tầng ổn định, bảo mật, sẵn sàng mở rộng.</p>
                    </div>
                    <ul class="space-y-1.5 mt-auto">
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Cloud Server (AWS, Google Cloud)
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Docker &amp; Kubernetes
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            CI/CD &amp; DevOps
                        </li>
                    </ul>
                    <a href="{{ route('services.show', 'web-app') }}" class="inline-flex items-center gap-1 text-[11px] font-mono font-bold text-primary hover:text-navy-base transition-colors mt-1 group/link">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined group-hover/link:translate-x-0.5 transition-transform" style="font-size:13px;line-height:1">arrow_forward</span>
                    </a>
                </div>

                {{-- Card 3: Sản xuất Media In-house --}}
                <div class="cap-card group p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px] text-primary" style="line-height:1">photo_camera</span>
                        </div>
                        <div class="text-[10px] font-mono font-bold text-slate-400 uppercase tracking-wider">03. Media</div>
                    </div>
                    <div>
                        <h4 class="font-headline text-sm font-bold text-navy-base mb-2 group-hover:text-primary transition-colors">Sản xuất Media In-house</h4>
                        <p class="font-body text-[11px] text-slate-500 leading-relaxed">Tạo ra nội dung hình ảnh, video chất lượng cao phục vụ marketing và truyền thông.</p>
                    </div>
                    <ul class="space-y-1.5 mt-auto">
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Quay phim &amp; Chụp ảnh
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Dựng phim &amp; Motion Graphic
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            3D Motion &amp; AI Studio
                        </li>
                    </ul>
                    <a href="{{ route('services.show', 'media') }}" class="inline-flex items-center gap-1 text-[11px] font-mono font-bold text-primary hover:text-navy-base transition-colors mt-1 group/link">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined group-hover/link:translate-x-0.5 transition-transform" style="font-size:13px;line-height:1">arrow_forward</span>
                    </a>
                </div>

                {{-- Card 4: Thiết kế UI/UX --}}
                <div class="cap-card group p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px] text-primary" style="line-height:1">design_services</span>
                        </div>
                        <div class="text-[10px] font-mono font-bold text-slate-400 uppercase tracking-wider">04. UI/UX</div>
                    </div>
                    <div>
                        <h4 class="font-headline text-sm font-bold text-navy-base mb-2 group-hover:text-primary transition-colors">Thiết kế UI/UX</h4>
                        <p class="font-body text-[11px] text-slate-500 leading-relaxed">Thiết kế giao diện hiện đại, tối ưu trải nghiệm người dùng, chuẩn thương hiệu.</p>
                    </div>
                    <ul class="space-y-1.5 mt-auto">
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Website &amp; Web App
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Mobile App
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Branding &amp; Visual Design
                        </li>
                    </ul>
                    <a href="{{ route('services.show', 'website') }}" class="inline-flex items-center gap-1 text-[11px] font-mono font-bold text-primary hover:text-navy-base transition-colors mt-1 group/link">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined group-hover/link:translate-x-0.5 transition-transform" style="font-size:13px;line-height:1">arrow_forward</span>
                    </a>
                </div>

                {{-- Card 5: Bảo mật & Vận hành --}}
                <div class="cap-card group p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:border-primary/50 hover:shadow-lg transition-all duration-300 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px] text-primary" style="line-height:1">security</span>
                        </div>
                        <div class="text-[10px] font-mono font-bold text-slate-400 uppercase tracking-wider">05. Security</div>
                    </div>
                    <div>
                        <h4 class="font-headline text-sm font-bold text-navy-base mb-2 group-hover:text-primary transition-colors">Bảo mật &amp; Vận hành</h4>
                        <p class="font-body text-[11px] text-slate-500 leading-relaxed">Đảm bảo an toàn dữ liệu, hệ thống ổn định và hỗ trợ kỹ thuật liên tục.</p>
                    </div>
                    <ul class="space-y-1.5 mt-auto">
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Bảo mật hệ thống
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Backup &amp; Phục hồi dữ liệu
                        </li>
                        <li class="flex items-center gap-2 text-[11px] font-body text-slate-600">
                            <span class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center shrink-0 leading-none"><span class="material-symbols-outlined text-primary" style="font-size:11px;line-height:1;display:block">check</span></span>
                            Giám sát &amp; Bảo trì định kỳ
                        </li>
                    </ul>
                    <a href="{{ route('services.show', 'web-app') }}" class="inline-flex items-center gap-1 text-[11px] font-mono font-bold text-primary hover:text-navy-base transition-colors mt-1 group/link">
                        <span>Xem chi tiết</span>
                        <span class="material-symbols-outlined group-hover/link:translate-x-0.5 transition-transform" style="font-size:13px;line-height:1">arrow_forward</span>
                    </a>
                </div>
            </div>


            {{-- === BOTTOM: Process Flow (left) + Stats (right) === --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-stretch" id="how-we-work">

                {{-- Left: QUY TRÌNH TRIỂN KHAI --}}
                <div class="lg:col-span-3 rounded-2xl bg-white border border-slate-200 shadow-sm p-7 space-y-6 relative overflow-hidden">
                    {{-- Handwriting callout --}}
                    <div class="absolute top-4 right-6 text-right pointer-events-none">
                        <svg viewBox="0 0 140 60" class="w-32 opacity-80" fill="none">
                            <text x="5" y="22" font-family="Caveat, cursive" font-size="13" fill="#f97316" transform="rotate(-4,70,30)">Quy trình rõ ràng</text>
                            <text x="18" y="40" font-family="Caveat, cursive" font-size="13" fill="#f97316" transform="rotate(-4,70,30)">Minh bạch</text>
                            <text x="30" y="58" font-family="Caveat, cursive" font-size="13" fill="#f97316" transform="rotate(-4,70,30)">Hiệu quả</text>
                        </svg>
                        <svg viewBox="0 0 40 30" class="w-8 ml-auto -mt-1 opacity-70" fill="none">
                            <path d="M5 5 Q20 0 35 20" stroke="#f97316" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                            <path d="M30 18 L35 20 L32 14" stroke="#f97316" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 mb-2">
                            <span class="w-5 h-px bg-primary"></span>
                            <span class="text-[10px] font-mono font-bold text-primary uppercase tracking-widest">Quy Trình Triển Khai</span>
                        </div>
                        <h4 class="font-headline text-xl sm:text-2xl font-extrabold text-navy-base">Từ Ý Tưởng Đến Hiện Thực</h4>
                        <p class="font-body text-xs text-slate-500 mt-1.5 max-w-sm">Chúng tôi luôn đồng hành cùng bạn trong từng bước, đảm bảo dự án được triển khai đúng kế hoạch, đúng chất lượng và đúng mục tiêu.</p>
                    </div>

                    {{-- 6-step horizontal flow --}}
                    <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
                        @php $steps = [
                            ['num'=>'01','icon'=>'inbox','label'=>'Tiếp nhận nhu cầu','sub'=>'Tư vấn, phân tích & đề xuất giải pháp'],
                            ['num'=>'02','icon'=>'lightbulb','label'=>'Thiết kế giải pháp','sub'=>'Lên ý tưởng, demo & thống nhất phương án'],
                            ['num'=>'03','icon'=>'code','label'=>'Phát triển & kiểm thử','sub'=>'Coding, test, tối ưu hiệu suất'],
                            ['num'=>'04','icon'=>'rocket_launch','label'=>'Triển khai','sub'=>'Đưa vào vận hành thực tế'],
                            ['num'=>'05','icon'=>'school','label'=>'Đào tạo & bàn giao','sub'=>'Hướng dẫn sử dụng, chuyển giao đầy đủ'],
                            ['num'=>'06','icon'=>'support_agent','label'=>'Hỗ trợ & bảo trì','sub'=>'Đồng hành lâu dài, phản hồi nhanh'],
                        ]; @endphp
                        @foreach($steps as $step)
                        <div class="flex flex-col items-center text-center gap-1.5 relative">
                            <div class="w-9 h-9 rounded-full bg-orange-50 border-2 border-orange-200 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[16px] text-primary">{{ $step['icon'] }}</span>
                            </div>
                            <span class="text-[9px] font-mono font-bold text-primary">{{ $step['num'] }}</span>
                            <div class="font-headline text-[10px] font-bold text-navy-base leading-tight">{{ $step['label'] }}</div>
                            <div class="font-body text-[9px] text-slate-400 leading-snug hidden sm:block">{{ $step['sub'] }}</div>
                            @if(!$loop->last)
                            <div class="absolute top-4 -right-1.5 w-3 h-px bg-slate-300 hidden sm:block"></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Stats card --}}
                <div class="lg:col-span-2 rounded-2xl bg-gradient-to-br from-slate-900 to-navy-base p-7 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary/15 rounded-full blur-2xl"></div>
                    <div class="relative z-10 space-y-4">
                        <div>
                            <div class="inline-flex items-center gap-2 mb-2">
                                <span class="w-5 h-px bg-primary"></span>
                                <span class="text-[10px] font-mono font-bold text-primary uppercase tracking-widest">Con Số Năng Lực</span>
                            </div>
                            <h4 class="font-headline text-xl font-extrabold text-white leading-snug">
                                Kinh Nghiệm Tạo Nên<br><span class="text-primary">Sự Khác Biệt</span>
                            </h4>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-primary/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[20px] text-primary">folder_open</span>
                                </div>
                                <div>
                                    <div class="font-headline text-2xl font-extrabold text-white">100+</div>
                                    <div class="font-body text-[10px] text-slate-400">Dự án triển khai</div>
                                </div>
                            </div>
                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-sky-500/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[20px] text-sky-400">groups</span>
                                </div>
                                <div>
                                    <div class="font-headline text-2xl font-extrabold text-white">50+</div>
                                    <div class="font-body text-[10px] text-slate-400">Khách hàng tin tưởng</div>
                                </div>
                            </div>
                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[20px] text-emerald-400">calendar_month</span>
                                </div>
                                <div>
                                    <div class="font-headline text-2xl font-extrabold text-white">5+</div>
                                    <div class="font-body text-[10px] text-slate-400">Năm kinh nghiệm trong ngành</div>
                                </div>
                            </div>
                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-amber-500/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[20px] text-amber-400">verified</span>
                                </div>
                                <div>
                                    <div class="font-headline text-2xl font-extrabold text-white">99%</div>
                                    <div class="font-body text-[10px] text-slate-400">Tỷ lệ dự án đúng tiến độ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== 3. QUY TRÌNH 4 BƯỚC (SECTION 06: HOW WE WORK) - REMOVED, MERGED INTO ABOVE ==================== -->
        <div class="hidden" id="how-we-work-legacy">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200 mb-2.5">
                    <span class="material-symbols-outlined text-[16px] text-primary">route</span>
                    <span>QUY TRÌNH TRIỂN KHAI &bull; HOW WE WORK</span>
                </div>
                <h3 class="font-headline text-2xl sm:text-3xl font-extrabold tracking-tight text-navy-base">
                    Quy Trình 4 Bước Rõ Ràng &amp; Minh Bạch
                </h3>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Mỗi giai đoạn tập trung vào đầu ra cụ thể giúp khách hàng kiểm soát tiến độ và chất lượng sản phẩm.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs hover:border-primary/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group space-y-3">
                    <div class="space-y-3">
                        <span class="text-xs font-mono font-bold text-primary bg-orange-50 px-2.5 py-1 rounded-full border border-orange-100 inline-block">BƯỚC 01</span>
                        <h4 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors">Tiếp nhận &amp; phân tích yêu cầu</h4>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Làm rõ bài toán nghiệp vụ, mục tiêu vận hành và đối tượng người dùng của hệ thống.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] font-mono text-slate-500 flex items-center gap-1.5 border-t border-slate-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary/70 shrink-0"></span>
                        <span>Đầu ra: Tài liệu đặc tả yêu cầu sơ bộ.</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs hover:border-sky-500/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group space-y-3">
                    <div class="space-y-3">
                        <span class="text-xs font-mono font-bold text-sky-700 bg-sky-50 px-2.5 py-1 rounded-full border border-sky-100 inline-block">BƯỚC 02</span>
                        <h4 class="font-headline text-base font-bold text-navy-base group-hover:text-sky-600 transition-colors">Đề xuất giải pháp &amp; phạm vi</h4>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Lựa chọn kiến trúc công nghệ phù hợp, xác định phạm vi phân hệ và lộ trình chi phí chi tiết.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] font-mono text-slate-500 flex items-center gap-1.5 border-t border-slate-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500/70 shrink-0"></span>
                        <span>Đầu ra: Đề xuất kỹ thuật &amp; dự toán.</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs hover:border-indigo-500/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group space-y-3">
                    <div class="space-y-3">
                        <span class="text-xs font-mono font-bold text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-100 inline-block">BƯỚC 03</span>
                        <h4 class="font-headline text-base font-bold text-navy-base group-hover:text-indigo-600 transition-colors">Thiết kế, phát triển &amp; kiểm thử</h4>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Thiết kế giao diện người dùng, lập trình các phân hệ, kiểm thử chức năng và bảo mật hệ thống.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] font-mono text-slate-500 flex items-center gap-1.5 border-t border-slate-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500/70 shrink-0"></span>
                        <span>Đầu ra: Bản dựng hoàn thiện trên staging.</span>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs hover:border-emerald-500/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group space-y-3">
                    <div class="space-y-3">
                        <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100 inline-block">BƯỚC 04</span>
                        <h4 class="font-headline text-base font-bold text-navy-base group-hover:text-emerald-600 transition-colors">Bàn giao &amp; hỗ trợ vận hành</h4>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">
                            Triển khai lên server chính thức, hướng dẫn bàn giao sử dụng và bảo hành kỹ thuật định kỳ.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] font-mono text-slate-500 flex items-center gap-1.5 border-t border-slate-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500/70 shrink-0"></span>
                        <span>Đầu ra: Nghiệm thu &amp; mã nguồn bàn giao.</span>
                    </div>
                </div>
            </div>

            <div class="text-center pt-2">
                <a href="{{ route('process') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-white border border-slate-200 shadow-2xs hover:border-primary hover:text-primary font-headline font-bold text-xs sm:text-sm text-slate-700 transition-all hover:shadow-xs group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span>Tìm hiểu chi tiết quy trình triển khai &amp; tiêu chuẩn nghiệm thu</span>
                    <span class="material-symbols-outlined text-[16px] text-primary group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                </a>
            </div>
        </div>

    </div>
</section>