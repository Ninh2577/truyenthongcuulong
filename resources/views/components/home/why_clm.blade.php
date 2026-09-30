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
                        <img src="{{ asset('images/solutions/solutions_top_right_showcase_2x.webp') }}?v={{ filemtime(public_path('images/solutions/solutions_top_right_showcase_2x.webp')) }}" 
                             srcset="{{ asset('images/solutions/solutions_top_right_showcase_2x.png') }}?v={{ filemtime(public_path('images/solutions/solutions_top_right_showcase_2x.png')) }}" 
                             alt="Ba Nhóm Giải Pháp Công Nghệ Trọng Tâm - Thiết bị và giải pháp thực tế" 
                             class="w-full h-auto block select-none pointer-events-none" 
                             loading="lazy">
                    </div>
                </div>
            </div>

            <!-- 3 Solution Groups Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-7 items-stretch">
                
                <!-- CARD 1: Web App & Hệ Thống Quản Trị -->
                <div class="rounded-[22px] bg-white border border-slate-200/90 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <!-- Photo with Floating Badge -->
                    <div class="relative w-full aspect-[1208/484] overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/solutions/card_1_photo_2x.webp') }}?v={{ filemtime(public_path('images/solutions/card_1_photo_2x.webp')) }}" 
                             srcset="{{ asset('images/solutions/card_1_photo_2x.png') }}?v={{ filemtime(public_path('images/solutions/card_1_photo_2x.png')) }}" 
                             alt="Web App & Hệ Thống Quản Trị" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
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
                        <img src="{{ asset('images/solutions/card_2_photo_2x.webp') }}?v={{ filemtime(public_path('images/solutions/card_2_photo_2x.webp')) }}" 
                             srcset="{{ asset('images/solutions/card_2_photo_2x.png') }}?v={{ filemtime(public_path('images/solutions/card_2_photo_2x.png')) }}" 
                             alt="Website Doanh Nghiệp" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
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
                        <img src="{{ asset('images/solutions/card_3_photo_2x.webp') }}?v={{ filemtime(public_path('images/solutions/card_3_photo_2x.webp')) }}" 
                             srcset="{{ asset('images/solutions/card_3_photo_2x.png') }}?v={{ filemtime(public_path('images/solutions/card_3_photo_2x.png')) }}" 
                             alt="Quảng Cáo & Truyền Thông Số" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
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

        <!-- ==================== 2. NĂNG LỰC THỰC THI & CHUYÊN MÔN (SECTION 05: CAPABILITIES) ==================== -->
        <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-4 border-b border-slate-100">
                <div>
                    <span class="text-xs font-mono font-bold text-slate-400 uppercase tracking-wider block mb-1">
                        ENGINEERING CAPABILITIES
                    </span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base">
                        Năng Lực Kỹ Thuật &amp; Triển Khai Thực Tế
                    </h3>
                </div>
                <span class="text-xs font-body text-slate-500">
                    Quy chuẩn kỹ thuật kiểm soát trên từng phân đoạn dự án
                </span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-4 text-center">
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                    <span class="material-symbols-outlined text-[22px] text-sky-600">analytics</span>
                    <div class="font-headline text-xs font-bold text-navy-base">Phân Tích Nghiệp Vụ</div>
                    <p class="font-body text-[11px] text-slate-500">Làm rõ bài toán &amp; đặc tả</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                    <span class="material-symbols-outlined text-[22px] text-indigo-600">design_services</span>
                    <div class="font-headline text-xs font-bold text-navy-base">Thiết Kế UI/UX</div>
                    <p class="font-body text-[11px] text-slate-500">Trực quan &amp; chuẩn nhận diện</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                    <span class="material-symbols-outlined text-[22px] text-primary">code</span>
                    <div class="font-headline text-xs font-bold text-navy-base">Phát Triển Phần Mềm</div>
                    <p class="font-body text-[11px] text-slate-500">Laravel, Livewire &amp; Vue</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                    <span class="material-symbols-outlined text-[22px] text-emerald-600">database</span>
                    <div class="font-headline text-xs font-bold text-navy-base">Thiết Kế Cơ Sở Dữ Liệu</div>
                    <p class="font-body text-[11px] text-slate-500">Chuẩn hóa &amp; an toàn</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                    <span class="material-symbols-outlined text-[22px] text-teal-600">hub</span>
                    <div class="font-headline text-xs font-bold text-navy-base">Tích Hợp API</div>
                    <p class="font-body text-[11px] text-slate-500">Cổng thanh toán &amp; bên thứ 3</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                    <span class="material-symbols-outlined text-[22px] text-amber-600">admin_panel_settings</span>
                    <div class="font-headline text-xs font-bold text-navy-base">Phân Quyền Người Dùng</div>
                    <p class="font-body text-[11px] text-slate-500">Kiểm soát truy cập RBAC</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5 col-span-2 sm:col-span-1">
                    <span class="material-symbols-outlined text-[22px] text-rose-600">verified</span>
                    <div class="font-headline text-xs font-bold text-navy-base">Kiểm Thử &amp; Bàn Giao</div>
                    <p class="font-body text-[11px] text-slate-500">Nghiệm thu &amp; đào tạo</p>
                </div>
            </div>
        </div>

        <!-- ==================== 3. QUY TRÌNH 4 BƯỚC (SECTION 06: HOW WE WORK) ==================== -->
        <div class="space-y-8" id="how-we-work">
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

        <!-- ==================== 4. VÌ SAO CHỌN CỬU LONG (WHY CHOOSE CỬU LONG - 4 VALUE PILLARS) ==================== -->
        <div class="space-y-8 pt-4 border-t border-slate-200/80">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold border border-sky-200 mb-2.5 shadow-2xs">
                    <span class="material-symbols-outlined text-[16px]">stars</span>
                    <span>WHY CHOOSE CỬU LONG</span>
                </div>
                <h3 class="font-headline text-2xl sm:text-3xl font-extrabold tracking-tight text-navy-base">
                    Đối Tác Công Nghệ Số &bull; Tích Hợp Sáng Tạo Toàn Diện
                </h3>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Tại sao các doanh nghiệp chọn Cửu Long làm đối tác công nghệ và chuyển đổi số dài hạn thay vì phân tán nhiều nhà cung cấp?
                </p>
            </div>

            <!-- 4 Why-Cards Grid with Stagger Reveal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="why-card p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-sky-500/40 hover:shadow-md transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-sky-500/15 text-sky-600 flex items-center justify-center border border-sky-500/20">
                        <span class="material-symbols-outlined text-[24px]">terminal</span>
                    </div>
                    <h4 class="font-headline text-lg font-bold text-navy-base group-hover:text-sky-600 transition-colors">Công Nghệ Tự Chủ &bull; Kiến Trúc Mở</h4>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Bàn giao mã nguồn rõ ràng, kiến trúc module hiện đại, không phụ thuộc nền tảng đóng, tạo điều kiện thuận lợi để doanh nghiệp nâng cấp mở rộng lâu dài.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="why-card p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-primary/40 hover:shadow-md transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-orange-500/15 text-primary flex items-center justify-center border border-orange-500/20">
                        <span class="material-symbols-outlined text-[24px]">hub</span>
                    </div>
                    <h4 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">Sức Mạnh Media Hỗ Trợ</h4>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Lợi thế độc bản: Đội ngũ media và hình ảnh in-house giúp sản phẩm công nghệ của bạn có ngay tư liệu video và đồ họa đồng bộ, sắc nét.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="why-card p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-amber-500/40 hover:shadow-md transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/15 text-amber-600 flex items-center justify-center border border-amber-500/20">
                        <span class="material-symbols-outlined text-[24px]">speed</span>
                    </div>
                    <h4 class="font-headline text-lg font-bold text-navy-base group-hover:text-amber-600 transition-colors">Kiểm Soát Tiến Độ &amp; Chi Phí</h4>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Quy trình kiểm soát chất lượng chặt chẽ giúp tối ưu chi phí triển khai và đảm bảo nghiệm thu đúng các cột mốc đã thống nhất.
                    </p>
                    <div class="pt-2 mt-auto">
                        <a href="{{ route('process') }}" class="inline-flex items-center gap-1 font-mono text-[11px] font-bold text-amber-700 hover:text-navy-base transition-colors">
                            <span>Tìm hiểu chi tiết quy trình</span>
                            <span class="material-symbols-outlined text-[13px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="why-card p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 hover:border-emerald-500/40 hover:shadow-md transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/15 text-emerald-600 flex items-center justify-center border border-emerald-500/20">
                        <span class="material-symbols-outlined text-[24px]">security</span>
                    </div>
                    <h4 class="font-headline text-lg font-bold text-navy-base group-hover:text-emerald-600 transition-colors">Đồng Hành &amp; Hỗ Trợ Kỹ Thuật</h4>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Hợp đồng pháp lý minh bạch, cam kết bảo trì kỹ thuật định kỳ, bảo mật cơ sở dữ liệu và đồng hành xử lý các vấn đề vận hành nhanh chóng.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>