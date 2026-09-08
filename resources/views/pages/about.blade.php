@extends('layouts.app')

@section('title', 'Câu Chuyện Thương Hiệu & Triết Lý Hoạt Động - Truyền Thông Cửu Long')
@section('meta_description', 'Tìm hiểu về Truyền Thông Cửu Long: Hơn 10 năm kinh nghiệm hợp nhất nghệ thuật kể chuyện điện ảnh và năng lực kỹ thuật số chuẩn mực.')

@push('styles')
<style>
/* 35mm Cinematic Film Grain Texture */
.film-grain-overlay {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
}
</style>
@endpush

@section('content')
<div class="w-full">
    
    <!-- ==================== 1. SMALL HERO SECTION (NỀN TỐI 1: Amber Glow Reference) ==================== -->
    <section class="relative pt-32 pb-16 lg:pt-36 lg:pb-24 overflow-hidden bg-[#080C16] text-white bg-dot-grid-dark border-b border-white/10 about-reveal-section">
        <!-- 35mm Film Grain Overlay -->
        <div class="absolute inset-0 film-grain-overlay opacity-35 pointer-events-none"></div>

        <!-- Ambient Studio Lighting Gradient Blobs (Amber Reference) -->
        <div class="absolute -top-24 right-0 w-[560px] h-[560px] rounded-full bg-gradient-to-br from-amber-400/15 via-primary/10 to-transparent blur-3xl pointer-events-none -mr-20"></div>
        <div class="absolute -bottom-24 -left-20 w-[460px] h-[460px] rounded-full bg-gradient-to-tr from-sky-500/15 via-amber-500/5 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#080C16]/40 to-[#080C16] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Trang chủ</a>
                <span class="text-slate-600">/</span>
                <span class="text-slate-400">Về chúng tôi</span>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-bold">Câu chuyện thương hiệu</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 flex flex-col gap-6">
                    <!-- Eyebrow with REC Blink Pulse -->
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit shadow-sm">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-amber-400 animate-rec-pulse"></span>
                        <span>ABOUT TRUYỀN THÔNG CỬU LONG &bull; 10+ NĂM ĐỒNG HÀNH</span>
                    </div>

                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                        Hành Trình Giao Thoa Giữa <br class="hidden sm:inline" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Nghệ Thuật Điện Ảnh</span> &amp; <br class="hidden sm:inline" />
                        <span class="text-white">Sức Mạnh Công Nghệ Số</span>
                    </h1>

                    <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl">
                        Hơn 10 năm kinh nghiệm đồng hành cùng các thương hiệu và doanh nghiệp kiến tạo những tác phẩm truyền hình, phim tài liệu doanh nghiệp và nền tảng số chuẩn mực. Chúng tôi kết hợp tư duy thị giác điện ảnh cùng nền tảng kỹ thuật phần mềm vững chắc để mang lại giá trị chuyển đổi bền vững.
                    </p>

                    <!-- 3 Redesigned Stat Cards (Glassmorphism & GSAP Count-Up) -->
                    <div class="grid grid-cols-3 gap-3.5 sm:gap-5 pt-3" id="about-hero-stats">
                        <!-- Stat 1: 10+ -->
                        <div class="stat-card-item p-4 sm:p-5 rounded-3xl bg-white/[0.05] backdrop-blur-md border border-white/10 hover:border-amber-400/50 hover:bg-white/[0.08] transition-all duration-300 shadow-xl group flex flex-col justify-between">
                            <div class="w-10 h-10 rounded-2xl bg-amber-400/15 border border-amber-400/30 text-amber-400 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-300 to-amber-200 tracking-tight">
                                    <span class="about-stat-counter" data-target="10" data-suffix="+">10+</span>
                                </div>
                                <p class="text-[11px] sm:text-xs text-slate-300 font-medium mt-1 leading-snug">Năm kinh nghiệm thực chiến</p>
                            </div>
                        </div>

                        <!-- Stat 2: 850+ -->
                        <div class="stat-card-item p-4 sm:p-5 rounded-3xl bg-white/[0.05] backdrop-blur-md border border-white/10 hover:border-sky-400/50 hover:bg-white/[0.08] transition-all duration-300 shadow-xl group flex flex-col justify-between">
                            <div class="w-10 h-10 rounded-2xl bg-sky-400/15 border border-sky-400/30 text-sky-400 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-sky-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                                    <polyline points="2 17 12 22 22 17"/>
                                    <polyline points="2 12 12 17 22 12"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight">
                                    <span class="about-stat-counter" data-target="850" data-suffix="+">850+</span>
                                </div>
                                <p class="text-[11px] sm:text-xs text-slate-300 font-medium mt-1 leading-snug">Dự án Media &amp; Tech</p>
                            </div>
                        </div>

                        <!-- Stat 3: 99.2% -->
                        <div class="stat-card-item p-4 sm:p-5 rounded-3xl bg-white/[0.05] backdrop-blur-md border border-white/10 hover:border-emerald-400/50 hover:bg-white/[0.08] transition-all duration-300 shadow-xl group flex flex-col justify-between">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-400/15 border border-emerald-400/30 text-emerald-400 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300 tracking-tight">
                                    <span class="about-stat-counter" data-target="99.2" data-suffix="%">99.2%</span>
                                </div>
                                <p class="text-[11px] sm:text-xs text-slate-300 font-medium mt-1 leading-snug">Khách hàng hài lòng</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual Box -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl overflow-hidden bg-[#0F172A]/80 backdrop-blur-md border border-white/15 p-3.5 shadow-2xl shadow-black/60 group hover:border-amber-400/40 transition-all duration-500">
                        <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-900">
                            <img src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=900&q=80" 
                                 alt="Phim trường & Không gian sáng tạo Truyền Thông Cửu Long" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-85"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full bg-black/70 backdrop-blur-md text-amber-400 font-mono text-[10px] font-bold border border-amber-400/30 shadow-md">
                                    Cinema 4K &bull; TechLab
                                </span>
                                <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 font-mono text-[10px] font-bold border border-emerald-500/30 backdrop-blur-md">
                                    Enterprise SLA
                                </span>
                            </div>
                        </div>
                        <div class="p-4 flex items-center justify-between text-white">
                            <div>
                                <h3 class="font-headline text-sm font-bold group-hover:text-amber-400 transition-colors">Trụ Sở Sáng Tạo &amp; Tech Hub</h3>
                                <p class="text-[11px] font-mono text-slate-400">TP. Cần Thơ &amp; TP. Hồ Chí Minh</p>
                            </div>
                            <a href="{{ route('contact') }}" class="text-xs font-headline font-bold text-amber-400 hover:text-amber-300 flex items-center gap-1.5 transition-colors">
                                <span>Kết nối ngay</span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Soft Wave Boundary Divider: Hero (Dark) to Section 2 (Light) -->
        <div class="absolute -bottom-1 left-0 right-0 overflow-hidden leading-none pointer-events-none z-20">
            <svg class="relative block w-full h-8 sm:h-12 text-surface fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C300,85 900,85 1200,0 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </section>

    <!-- ==================== 2. DUAL DNA SECTION (NỀN SÁNG: bg-surface) ==================== -->
    <section class="relative py-14 lg:py-20 bg-surface bg-dot-grid-subtle border-b border-slate-200/80 overflow-hidden about-reveal-section">
        <!-- Ambient Gradient Blobs (Light Surface) -->
        <div class="absolute -top-24 -left-20 w-[450px] h-[450px] rounded-full bg-gradient-to-br from-orange-400/10 via-amber-200/20 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-20 w-[450px] h-[450px] rounded-full bg-gradient-to-tl from-sky-400/10 via-indigo-200/20 to-transparent blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16 about-reveal-header">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 border border-amber-300 text-amber-800 font-mono text-xs font-bold mb-3 shadow-xs">
                    <svg class="w-4 h-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <circle cx="19" cy="5" r="2"></circle>
                        <circle cx="5" cy="19" r="2"></circle>
                        <path d="M10.4 10.4 6.4 17.6"></path>
                        <path d="m13.6 13.6 4-7.2"></path>
                    </svg>
                    <span>THE DUAL DNA PHILOSOPHY</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-base tracking-tight">
                    Sự Kết Hợp Độc Bản: <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber">Điện Ảnh × Công Nghệ</span>
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed max-w-2xl mx-auto">
                    Hầu hết doanh nghiệp phải thuê riêng lẻ một production house quay video và một công ty phần mềm làm web/app. Tại Truyền Thông Cửu Long, chúng tôi hợp nhất cả hai năng lực vào một luồng thực thi đồng bộ duy nhất.
                </p>
            </div>

            <!-- 2 Dual DNA Cards with Stagger Grid & Hover Glow -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch" id="dual-dna-grid">
                <!-- Bán Cầu Trái: Tech & Logic -->
                <div class="group relative p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-400 hover:shadow-2xl hover:shadow-sky-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex flex-col gap-5">
                        <!-- Icon badge with verified Material Symbol -->
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 text-white flex items-center justify-center shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
                            <span class="material-symbols-outlined text-[28px] text-white select-none" style="font-size: 28px; line-height: 1; color: #ffffff !important;">terminal</span>
                        </div>
                        <div>
                            <span class="font-mono text-[11px] text-sky-600 uppercase tracking-wider font-bold">KỸ THUẬT &bull; LOGIC HỆ THỐNG</span>
                            <h3 class="font-headline text-xl sm:text-2xl font-bold text-navy-base group-hover:text-primary transition-colors mt-1">Tư Duy Kiến Trúc Sư Phần Mềm</h3>
                        </div>
                        <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Mỗi nền tảng số được xây dựng với tư duy kỹ thuật vững chắc: Kiến trúc Clean Code, bảo mật đa tầng, tối ưu tốc độ tải trang Core Web Vitals &ge; 95 và cấu trúc dữ liệu phục vụ mục tiêu chuyển đổi doanh thu.
                        </p>
                        <ul class="space-y-2.5 pt-2 text-xs text-slate-700 font-body">
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-[16px] text-primary shrink-0">check_circle</span>
                                <span>Kiến trúc phân tầng Microservices / Modular Laravel</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-[16px] text-primary shrink-0">check_circle</span>
                                <span>Bảo mật chống SQLi, XSS, CSRF &amp; sao lưu tự động</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-[16px] text-primary shrink-0">check_circle</span>
                                <span>Bàn giao toàn bộ 100% mã nguồn không phụ thuộc nhà cung cấp</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="font-mono text-xs text-slate-400">Nền tảng công nghệ mũi nhọn</span>
                        <a href="{{ route('services.web-app') }}" class="text-xs font-headline font-bold text-primary hover:text-amber-600 flex items-center gap-1.5 transition-colors group/link">
                            <span>Khám phá Web/App</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Bán Cầu Phải: Cinema & Emotion -->
                <div class="group relative p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400 hover:shadow-2xl hover:shadow-amber-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 via-orange-500 to-amber-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex flex-col gap-5">
                        <!-- Icon badge with verified Material Symbol -->
                        <div class="w-14 h-14 rounded-2xl text-white flex items-center justify-center shadow-lg shadow-amber-500/25 group-hover:scale-105 transition-transform duration-300" style="background: linear-gradient(135deg, #f59e0b, #ea580c) !important;">
                            <span class="material-symbols-outlined text-[28px] text-white select-none" style="font-size: 28px; line-height: 1; color: #ffffff !important;">movie</span>
                        </div>
                        <div>
                            <span class="font-mono text-[11px] text-amber-600 uppercase tracking-wider font-bold">THẨM MỸ &bull; TRỰC GIÁC NGHỆ THUẬT</span>
                            <h3 class="font-headline text-xl sm:text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors mt-1">Ngôn Ngữ Kể Chuyện Điện Ảnh</h3>
                        </div>
                        <p class="font-body text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Hình ảnh không chỉ cần đẹp mà phải truyền cảm hứng và khơi gợi cảm xúc. Từ kịch bản sâu sắc, góc máy điện ảnh chuẩn 4K/DCI cho đến quy trình chỉnh màu DaVinci Resolve giúp thương hiệu khắc sâu trong tâm trí khách hàng.
                        </p>
                        <ul class="space-y-2.5 pt-2 text-xs text-slate-700 font-body">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Trang thiết bị chuẩn Cinema Line 4K/6K HDR</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Phòng dựng chuẩn DaVinci Resolve với Colorist chuyên sâu</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Kịch bản phân cảnh độc quyền bám sát USP của doanh nghiệp</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="font-mono text-xs text-slate-400">Xưởng sản xuất nghe nhìn</span>
                        <a href="{{ route('services.media') }}" class="text-xs font-headline font-bold text-amber-600 hover:text-primary flex items-center gap-1.5 transition-colors group/link">
                            <span>Khám phá Media</span>
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Soft Wave Boundary Divider: Section 2 (Light) to Section 3 (Dark) -->
        <div class="absolute -bottom-1 left-0 right-0 overflow-hidden leading-none pointer-events-none z-20">
            <svg class="relative block w-full h-8 sm:h-12 text-[#080C16] fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C300,85 900,85 1200,0 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </section>

    <!-- ==================== 3. VISION & MISSION (NỀN TỐI 2: Cyan/Teal Glow & Diagonal Light Beam) ==================== -->
    <section class="relative py-16 lg:py-24 bg-[#080C16] border-b border-white/10 text-white bg-dot-grid-dark overflow-hidden about-reveal-section">
        <!-- 35mm Film Grain Overlay -->
        <div class="absolute inset-0 film-grain-overlay opacity-35 pointer-events-none"></div>

        <!-- DIAGONAL ANAMORPHIC LIGHT BEAM (Dải sáng chéo góc ~32 độ, cyan/teal mờ ~12%) -->
        <div class="absolute -top-40 -left-40 w-[140%] h-36 rotate-[32deg] bg-gradient-to-r from-transparent via-cyan-400/12 to-transparent blur-2xl pointer-events-none"></div>
        <div class="absolute -top-20 -left-20 w-[140%] h-14 rotate-[32deg] bg-gradient-to-r from-transparent via-teal-300/10 to-transparent blur-lg pointer-events-none"></div>

        <!-- Ambient Cyan / Teal Atmospheric Lighting -->
        <div class="absolute -top-28 -right-20 w-[480px] h-[480px] rounded-full bg-gradient-to-bl from-teal-500/15 via-cyan-500/10 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-28 -left-20 w-[480px] h-[480px] rounded-full bg-gradient-to-tr from-cyan-600/12 via-teal-400/8 to-transparent blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- ASYMMETRICAL 5/7 GRID (Phá vỡ nhẹ sự đối xứng) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch" id="vision-mission-grid">
                
                <!-- 1. Vision (Tầm Nhìn 2030 - lg:col-span-5) -->
                <div class="lg:col-span-5 group relative p-8 sm:p-10 rounded-3xl bg-[#0F172A]/90 backdrop-blur-md border border-slate-800 hover:border-teal-400/70 hover:shadow-2xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-teal-400 via-cyan-400 to-sky-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex flex-col gap-5">
                        <!-- Icon badge with verified Material Symbol -->
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-600 text-white flex items-center justify-center shadow-lg shadow-teal-500/25 group-hover:scale-105 transition-transform duration-300 font-bold">
                            <span class="material-symbols-outlined text-[28px] text-white select-none" style="font-size: 28px; line-height: 1; color: #ffffff !important;">visibility</span>
                        </div>
                        <div>
                            <span class="font-mono text-xs text-teal-400 uppercase tracking-widest font-bold">STRATEGIC HORIZON</span>
                            <h3 class="font-headline text-2xl sm:text-3xl font-bold text-white group-hover:text-teal-300 transition-colors mt-1">Tầm Nhìn Chiến Lược 2030</h3>
                        </div>
                        <p class="font-body text-sm text-slate-300 leading-relaxed">
                            Trở thành tổ hợp truyền thông sáng tạo và công nghệ số hàng đầu khu vực Đồng bằng sông Cửu Long và vươn tầm cả nước; là biểu tượng của sự hợp nhất hoàn hảo giữa tính duy mỹ điện ảnh và chuẩn mực kỹ thuật công nghệ thông tin.
                        </p>
                    </div>
                    <div class="pt-6 mt-4 border-t border-slate-800/90 flex flex-wrap items-center gap-2 text-xs font-mono text-slate-300">
                        <span class="px-3 py-1 rounded-full bg-teal-500/10 border border-teal-400/20 text-teal-300">Bền vững</span>
                        <span class="px-3 py-1 rounded-full bg-teal-500/10 border border-teal-400/20 text-teal-300">Đẳng cấp</span>
                        <span class="px-3 py-1 rounded-full bg-teal-500/10 border border-teal-400/20 text-teal-300">Tiên phong</span>
                    </div>
                </div>

                <!-- 2. Mission (Sứ Mệnh Cốt Lõi - lg:col-span-7 - Nhỉnh hơn + Backdrop ảnh mờ) -->
                <div class="lg:col-span-7 group relative p-8 sm:p-10 rounded-3xl bg-[#0F172A]/90 backdrop-blur-md border border-slate-800 hover:border-cyan-400/70 hover:shadow-2xl hover:shadow-cyan-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <!-- Subtle Cinematic Studio Backdrop (Blur nhẹ tạo chiều sâu khác biệt) -->
                    <div class="absolute inset-0 bg-cover bg-center opacity-10 blur-[1.5px] pointer-events-none group-hover:scale-105 transition-transform duration-700" style="background-image: url('https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80');"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-[#0F172A]/90 via-[#0F172A]/95 to-[#080C16] pointer-events-none"></div>

                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 via-teal-400 to-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                    
                    <div class="flex flex-col gap-5 relative z-10">
                        <div class="flex items-center justify-between">
                            <!-- Icon badge with verified Material Symbol -->
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 via-teal-500 to-emerald-500 text-white flex items-center justify-center shadow-lg shadow-cyan-500/25 group-hover:scale-105 transition-transform duration-300">
                                <span class="material-symbols-outlined text-[28px] text-white select-none" style="font-size: 28px; line-height: 1; color: #ffffff !important;">rocket_launch</span>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-cyan-400/10 border border-cyan-400/30 text-cyan-300 font-mono text-[11px] font-bold">
                                CORE MISSION
                            </span>
                        </div>
                        <div>
                            <span class="font-mono text-xs text-cyan-400 uppercase tracking-widest font-bold">EXECUTION PRINCIPLES</span>
                            <h3 class="font-headline text-2xl sm:text-3xl font-bold text-white group-hover:text-cyan-300 transition-colors mt-1">Sứ Mệnh Cốt Lõi</h3>
                        </div>
                        <p class="font-body text-sm text-slate-300 leading-relaxed">
                            Xóa bỏ rào cản phân mảnh giữa ý tưởng nội dung và năng lực triển khai kỹ thuật; trang bị cho doanh nghiệp giải pháp tổng thể (Video Cinematic + Hệ thống Web/App + Chiến dịch Digital) giúp tối ưu hóa ngân sách vận hành và tạo đà bứt phá doanh thu.
                        </p>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-800/90 grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs font-mono relative z-10">
                        <div class="p-3 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-2 text-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                            <span>Tối ưu chi phí</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-2 text-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                            <span>Tăng chuyển đổi</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-2 text-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span>Đồng hành dài hạn</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Soft Wave Boundary Divider: Section 3 (Dark) to Section 4 (Light) -->
        <div class="absolute -bottom-1 left-0 right-0 overflow-hidden leading-none pointer-events-none z-20">
            <svg class="relative block w-full h-8 sm:h-12 text-surface fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C300,85 900,85 1200,0 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </section>

    <!-- ==================== 4. CORE VALUES 4T (NỀN SÁNG: bg-surface) ==================== -->
    <section class="relative py-14 lg:py-20 bg-surface bg-dot-grid-subtle border-b border-slate-200/80 overflow-hidden about-reveal-section">
        <!-- Ambient Gradient Blobs (Light Surface) -->
        <div class="absolute -top-24 -right-20 w-[450px] h-[450px] rounded-full bg-gradient-to-bl from-amber-300/15 via-orange-200/20 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-20 w-[450px] h-[450px] rounded-full bg-gradient-to-tr from-rose-300/10 via-sky-200/15 to-transparent blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-16 about-reveal-header">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 border border-amber-300 text-amber-800 font-mono text-xs font-bold mb-3 shadow-xs">
                    <svg class="w-4 h-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                    <span>ORGANIZATIONAL PRINCIPLES</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-base tracking-tight">
                    Giá Trị Cốt Lõi: <span class="text-primary font-black">Hệ Giá Trị 4T</span>
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed">
                    Bốn kim chỉ nam dẫn đường cho mọi quyết định sáng tạo, kỹ thuật và đối thoại cùng khách hàng.
                </p>
            </div>

            <!-- 4 Cards with Stagger Grid & 100% Bulletproof Inline SVG Icons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="values-4t-grid">
                <!-- TÂM -->
                <div class="group relative p-7 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-rose-400 hover:shadow-2xl hover:shadow-rose-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col gap-4 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-rose-400 to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Icon badge with verified Material Symbol -->
                    <div class="w-12 h-12 rounded-2xl text-white flex items-center justify-center shadow-lg shadow-rose-500/25 group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, #f43f5e, #e11d48) !important;">
                        <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">favorite</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-navy-base group-hover:text-rose-600 transition-colors">TÂM &bull; Tận Tụy</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Đặt danh dự nghề nghiệp và lợi ích của khách hàng làm trọng tâm. Mỗi dự án đều được chăm chút tỉ mỉ như đứa con tinh thần của chính chúng tôi.
                    </p>
                </div>

                <!-- TẦM -->
                <div class="group relative p-7 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400 hover:shadow-2xl hover:shadow-amber-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col gap-4 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Icon badge with verified Material Symbol -->
                    <div class="w-12 h-12 rounded-2xl text-white flex items-center justify-center shadow-lg shadow-amber-500/25 group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, #f59e0b, #d97706) !important;">
                        <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">workspace_premium</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">TẦM &bull; Chuẩn Mực</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Không thỏa hiệp với những sản phẩm chắp vá. Luôn hướng đến chuẩn mực quốc tế trong cả thẩm mỹ nghe nhìn lẫn kiến trúc hạ tầng công nghệ số.
                    </p>
                </div>

                <!-- TỐC -->
                <div class="group relative p-7 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-400 hover:shadow-2xl hover:shadow-sky-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col gap-4 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-sky-400 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Icon badge with verified Material Symbol -->
                    <div class="w-12 h-12 rounded-2xl text-white flex items-center justify-center shadow-lg shadow-sky-500/25 group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, #0ea5e9, #2563eb) !important;">
                        <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">bolt</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-navy-base group-hover:text-sky-600 transition-colors">TỐC &bull; Kỷ Luật</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phản hồi yêu cầu trong 15 phút, triển khai dự án quyết liệt và cam kết tiến độ bàn giao chính xác theo từng mốc hợp đồng đã ký kết.
                    </p>
                </div>

                <!-- THẬT -->
                <div class="group relative p-7 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-400 hover:shadow-2xl hover:shadow-emerald-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col gap-4 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Icon badge with verified Material Symbol -->
                    <div class="w-12 h-12 rounded-2xl text-white flex items-center justify-center shadow-lg shadow-emerald-500/25 group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, #10b981, #059669) !important;">
                        <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">verified_user</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-navy-base group-hover:text-emerald-600 transition-colors">THẬT &bull; Minh Bạch</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Nói thật, làm thật, nghiệm thu bằng số liệu thật. Mọi chi phí, thời gian và chỉ số hiệu quả KPI đều được đo lường minh bạch tuyệt đối.
                    </p>
                </div>
            </div>
        </div>

        <!-- Soft Wave Boundary Divider: Section 4 (Light) to Section 5 (Dark) -->
        <div class="absolute -bottom-1 left-0 right-0 overflow-hidden leading-none pointer-events-none z-20">
            <svg class="relative block w-full h-8 sm:h-12 text-[#080C16] fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C300,85 900,85 1200,0 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </section>

    <!-- ==================== 5. ECOSYSTEM SECTION (NỀN TỐI 3: Indigo/Purple Mesh Gradient & Blueprint Grid) ==================== -->
    <section class="relative py-16 lg:py-24 bg-[#080C16] text-white bg-dot-grid-dark overflow-hidden about-reveal-section" style="background-color: #080C16 !important;">
        <!-- 35mm Film Grain Overlay -->
        <div class="absolute inset-0 film-grain-overlay opacity-35 pointer-events-none"></div>

        <!-- MULTI-POINT MESH GRADIENT (Bầu trời đêm đa sắc Deep Night Sky) -->
        <div class="absolute inset-0 pointer-events-none opacity-45 bg-[radial-gradient(ellipse_at_top_left,rgba(99,102,241,0.2),transparent_50%),radial-gradient(ellipse_at_bottom_right,rgba(168,85,247,0.18),transparent_50%),radial-gradient(ellipse_at_center,rgba(59,130,246,0.14),transparent_60%)]"></div>
        <div class="absolute -top-28 right-10 w-[520px] h-[520px] rounded-full bg-gradient-to-br from-indigo-500/20 via-purple-500/12 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-28 left-10 w-[480px] h-[480px] rounded-full bg-gradient-to-tr from-violet-600/18 via-indigo-600/10 to-transparent blur-3xl pointer-events-none"></div>

        <!-- ARCHITECTURAL BLUEPRINT GRID LINES (1px đường kẻ kỹ thuật mô phỏng bản vẽ) -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
            <!-- Vertical coordinate lines -->
            <div class="absolute top-0 bottom-0 left-[18%] w-[1px] bg-gradient-to-b from-transparent via-indigo-400/15 to-transparent"></div>
            <div class="absolute top-0 bottom-0 left-[50%] w-[1px] bg-gradient-to-b from-transparent via-indigo-400/15 to-transparent"></div>
            <div class="absolute top-0 bottom-0 left-[82%] w-[1px] bg-gradient-to-b from-transparent via-indigo-400/15 to-transparent"></div>
            <!-- Horizontal coordinate lines (framing the card deck, avoiding the section title) -->
            <div class="absolute left-0 right-0 top-[35%] h-[1px] bg-gradient-to-r from-transparent via-indigo-400/15 to-transparent"></div>
            <div class="absolute left-0 right-0 bottom-[12%] h-[1px] bg-gradient-to-r from-transparent via-indigo-400/15 to-transparent"></div>
            <!-- Tech crosshair coordinate marks (+) positioned away from header text -->
            <span class="absolute top-[34.2%] left-[17.6%] font-mono text-[10px] text-indigo-400/35 select-none">+</span>
            <span class="absolute top-[34.2%] left-[81.6%] font-mono text-[10px] text-indigo-400/35 select-none">+</span>
            <span class="absolute bottom-[13%] left-[17.6%] font-mono text-[10px] text-indigo-400/35 select-none">+</span>
            <span class="absolute bottom-[13%] left-[49.6%] font-mono text-[10px] text-indigo-400/35 select-none">+</span>
            <span class="absolute bottom-[13%] left-[81.6%] font-mono text-[10px] text-indigo-400/35 select-none">+</span>
            <span class="absolute top-8 right-12 font-mono text-[9px] text-indigo-400/30 select-none tracking-widest hidden lg:inline-block">SYS.ARCH // NODES_V4</span>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-16 about-reveal-header relative z-20">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-400/30 text-indigo-300 font-mono text-xs font-bold mb-3 shadow-xs">
                    <span class="inline-block w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                    <span>ECOSYSTEM MATRIX &bull; TECH BLUEPRINT</span>
                </div>
                <!-- Clean section heading with NO dark box overlay or clipping artifact -->
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-1 text-white" style="color: #ffffff !important;">
                    Hệ Sinh Thái Số <span class="text-amber-400" style="color: #f59e0b !important;">Trực Thuộc CLM</span>
                </h2>
                <p class="font-body text-slate-300 text-xs sm:text-sm mt-3 leading-relaxed">
                    Các thương hiệu và nền tảng trực tuyến độc lập thuộc mạng lưới phát triển của Truyền Thông Cửu Long.
                </p>
            </div>

            <!-- 4 Ecosystem Cards with Stagger Grid & Verified Material Symbols Icons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-20" id="ecosystem-grid">
                <!-- Ecosystem 1: Cuu Long Camping -->
                <a href="https://cuulongcamping.vn" target="_blank" rel="noopener noreferrer" 
                   class="group relative p-7 rounded-3xl bg-[#0F172A] border border-slate-700/80 hover:border-emerald-400/80 hover:bg-[#131D38] hover:shadow-2xl hover:shadow-emerald-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden shadow-xl">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div>
                        <!-- Verified Material Symbol: camping -->
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/25 group-hover:scale-110 transition-transform duration-300 mb-4">
                            <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">camping</span>
                        </div>
                        <!-- Brand title with 100% white contrast (Bug 2 fix) -->
                        <h3 class="font-headline text-lg sm:text-xl font-bold transition-colors mb-1" style="color: #ffffff !important; opacity: 1 !important; display: block !important;">
                            Cuu Long Camping
                        </h3>
                        <span class="font-mono text-[11px] text-emerald-400 block mb-2 font-semibold" style="color: #34d399 !important;">cuulongcamping.vn</span>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Mô hình cắm trại sinh thái dã ngoại, trải nghiệm thiên nhiên và sản xuất Travel Video quảng bá miền Tây.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-emerald-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">open_in_new</span>
                    </div>
                </a>

                <!-- Ecosystem 2: Tui Là Người Miền Tây -->
                <a href="https://tuilanguoimientay.vn" target="_blank" rel="noopener noreferrer" 
                   class="group relative p-7 rounded-3xl bg-[#0F172A] border border-slate-700/80 hover:border-amber-400/80 hover:bg-[#131D38] hover:shadow-2xl hover:shadow-amber-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden shadow-xl">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div>
                        <!-- Verified Material Symbol: map -->
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 text-white flex items-center justify-center shadow-lg shadow-amber-500/25 group-hover:scale-110 transition-transform duration-300 mb-4">
                            <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">map</span>
                        </div>
                        <!-- Brand title with 100% white contrast (Bug 2 fix) -->
                        <h3 class="font-headline text-lg sm:text-xl font-bold transition-colors mb-1" style="color: #ffffff !important; opacity: 1 !important; display: block !important;">
                            Tui Là Người Miền Tây
                        </h3>
                        <span class="font-mono text-[11px] text-amber-400 block mb-2 font-semibold" style="color: #fbbf24 !important;">tuilanguoimientay.vn</span>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Kênh truyền thông văn hóa, ẩm thực, phong tục đời sống và phong cảnh ĐBSCL với hàng trăm nghìn độc giả.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-amber-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">open_in_new</span>
                    </div>
                </a>

                <!-- Ecosystem 3: Tiêu Dao Tử -->
                <a href="https://tieudaotu.com" target="_blank" rel="noopener noreferrer" 
                   class="group relative p-7 rounded-3xl bg-[#0F172A] border border-slate-700/80 hover:border-sky-400/80 hover:bg-[#131D38] hover:shadow-2xl hover:shadow-sky-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden shadow-xl">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-sky-400 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div>
                        <!-- Verified Material Symbol: explore -->
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 text-white flex items-center justify-center shadow-lg shadow-sky-500/25 group-hover:scale-110 transition-transform duration-300 mb-4">
                            <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">explore</span>
                        </div>
                        <!-- Brand title with 100% white contrast (Bug 2 fix) -->
                        <h3 class="font-headline text-lg sm:text-xl font-bold transition-colors mb-1" style="color: #ffffff !important; opacity: 1 !important; display: block !important;">
                            Tiêu Dao Tử
                        </h3>
                        <span class="font-mono text-[11px] text-sky-400 block mb-2 font-semibold" style="color: #38bdf8 !important;">tieudaotu.com</span>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Blog hành trình phiêu lưu, kinh nghiệm phượt và nguồn tư liệu nhiếp ảnh thực địa đa dạng.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-sky-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">open_in_new</span>
                    </div>
                </a>

                <!-- Ecosystem 4: Cùng Chơi -->
                <a href="https://cungchoi.com" target="_blank" rel="noopener noreferrer" 
                   class="group relative p-7 rounded-3xl bg-[#0F172A] border border-slate-700/80 hover:border-purple-400/80 hover:bg-[#131D38] hover:shadow-2xl hover:shadow-purple-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden shadow-xl">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div>
                        <!-- Verified Material Symbol: sports_esports -->
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-purple-500/25 group-hover:scale-110 transition-transform duration-300 mb-4">
                            <span class="material-symbols-outlined text-[26px] text-white select-none" style="font-size: 26px; line-height: 1; color: #ffffff !important;">sports_esports</span>
                        </div>
                        <!-- Brand title with 100% white contrast (Bug 2 fix) -->
                        <h3 class="font-headline text-lg sm:text-xl font-bold transition-colors mb-1" style="color: #ffffff !important; opacity: 1 !important; display: block !important;">
                            Cùng Chơi
                        </h3>
                        <span class="font-mono text-[11px] text-purple-400 block mb-2 font-semibold" style="color: #c084fc !important;">cungchoi.com</span>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Nền tảng cộng đồng giải trí, minigames và các hoạt động tương tác trực tuyến cho giới trẻ.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-purple-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">open_in_new</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Soft gradient blend into Master CTA band -->
        <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-b from-transparent to-navy-base pointer-events-none"></div>
    </section>

</div>

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AboutPage",
    "name": "Câu Chuyện Thương Hiệu & Triết Lý Hoạt Động - Truyền Thông Cửu Long",
    "description": "Hơn 10 năm kinh nghiệm hợp nhất nghệ thuật kể chuyện điện ảnh và năng lực kỹ thuật số chuẩn mực.",
    "url": "{{ route('about') }}",
    "mainEntity": {
        "@type": "Organization",
        "name": "Truyền Thông Cửu Long",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "foundingDate": "2014",
        "sameAs": [
            "https://www.facebook.com/truyenthongcuulong/",
            "https://www.youtube.com/watch?v=nGvVhO2kDo8"
        ]
    }
}
</script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    // 1. Stats Counter Count-Up (Trigger at top 88%)
    const statsContainer = document.getElementById('about-hero-stats');
    if (statsContainer) {
        ScrollTrigger.create({
            trigger: statsContainer,
            start: 'top 88%',
            once: true,
            onEnter: () => {
                gsap.fromTo('#about-hero-stats .stat-card-item',
                    { y: 20, opacity: 0 },
                    { y: 0, opacity: 1, duration: 0.5, stagger: 0.1, ease: 'power2.out' }
                );
                document.querySelectorAll('#about-hero-stats .about-stat-counter').forEach(counter => {
                    const target = parseFloat(counter.getAttribute('data-target'));
                    const isDecimal = target % 1 !== 0;
                    const suffix = counter.getAttribute('data-suffix') || '';
                    const obj = { val: 0 };
                    gsap.to(obj, {
                        val: target,
                        duration: 1.2,
                        ease: 'power2.out',
                        onUpdate: () => {
                            counter.textContent = (isDecimal ? obj.val.toFixed(1) : Math.round(obj.val)) + suffix;
                        }
                    });
                });
            }
        });
    }

    // 2. Section Header Fade-in & Slide-Up (top 85%, duration ~0.55s, power2.out)
    document.querySelectorAll('.about-reveal-section').forEach(sec => {
        sec.style.opacity = '1';
        const header = sec.querySelector('.about-reveal-header');
        if (header) {
            gsap.from(header, {
                y: 24,
                opacity: 0,
                duration: 0.55,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: sec,
                    start: 'top 85%',
                    once: true
                }
            });
        }
    });

    // 3. Dual DNA Cards Stagger Reveal (120ms stagger)
    const dualDnaGrid = document.getElementById('dual-dna-grid');
    if (dualDnaGrid) {
        gsap.fromTo(dualDnaGrid.children,
            { y: 25, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.55,
                stagger: 0.12,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: dualDnaGrid,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    }

    // 4. Vision & Mission Cards Stagger Reveal
    const visionGrid = document.getElementById('vision-mission-grid');
    if (visionGrid) {
        gsap.fromTo(visionGrid.children,
            { y: 25, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.55,
                stagger: 0.12,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: visionGrid,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    }

    // 5. 4T Values Cards Stagger Reveal (100ms stagger)
    const valuesGrid = document.getElementById('values-4t-grid');
    if (valuesGrid) {
        gsap.fromTo(valuesGrid.children,
            { y: 25, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.55,
                stagger: 0.1,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: valuesGrid,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    }

    // 6. Ecosystem Cards Stagger Reveal (100ms stagger)
    const ecosystemGrid = document.getElementById('ecosystem-grid');
    if (ecosystemGrid) {
        gsap.fromTo(ecosystemGrid.children,
            { y: 25, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.55,
                stagger: 0.1,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: ecosystemGrid,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    }
});
</script>
@endpush
@endsection
