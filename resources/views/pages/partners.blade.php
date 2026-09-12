@extends('layouts.app')

@section('title', 'Mạng Lưới Đối Tác Chiến Lược - Truyền Thông Cửu Long')
@section('meta_description', 'Danh sách các đối tác hạ tầng công nghệ và du lịch lữ hành đồng hành bền vững cùng Truyền Thông Cửu Long.')

@push('styles')
<style>
/* Stagger reveal initial state */
.partner-card-stagger {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.partner-card-stagger.revealed {
    opacity: 1;
    transform: translateY(0);
}

/* Base card transition */
.partner-card-base {
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease, border-color 0.35s ease;
}

/* Unified Cinematic Editorial Color Grade (LUT Film Mood) */
.editorial-film-grade {
    filter: saturate(0.86) contrast(1.04) brightness(0.96) sepia(0.06);
    transition: filter 0.4s ease, transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.group:hover .editorial-film-grade {
    filter: saturate(1.02) contrast(1.02) brightness(1.0) sepia(0);
}

/* Metallic Shimmer Sweep on Badges */
@keyframes metallicShimmer {
    0% { transform: translateX(-150%) skewX(-25deg); }
    100% { transform: translateX(200%) skewX(-25deg); }
}

.badge-metallic-shimmer {
    position: relative;
    overflow: hidden;
}

.badge-metallic-shimmer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 60%;
    height: 100%;
    background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.6) 50%, rgba(255, 255, 255, 0) 100%);
    animation: metallicShimmer 3s ease-in-out infinite;
    pointer-events: none;
    z-index: 1;
}

.badge-metallic-shimmer > span {
    position: relative;
    z-index: 10;
}

/* 1. TOP PARTNER BADGE */
.badge-top-metallic {
    background: linear-gradient(135deg, #F59E0B 0%, #EA580C 50%, #F59E0B 100%) !important;
    background-size: 200% 200% !important;
    color: #FFFFFF !important;
    border: none !important;
    box-shadow: 0 2px 10px rgba(234, 88, 12, 0.35) !important;
    text-shadow: none !important;
    font-weight: 800 !important;
    letter-spacing: 0.04em;
}

.badge-top-metallic .material-symbols-outlined {
    color: #FFFFFF !important;
}

/* 2. GOLD PARTNER BADGE */
.badge-gold-metallic {
    background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 60%, #D97706 100%) !important;
    background-size: 200% 200% !important;
    color: #0B132B !important;
    border: none !important;
    box-shadow: 0 2px 8px rgba(217, 119, 6, 0.3) !important;
    text-shadow: none !important;
    font-weight: 800 !important;
    letter-spacing: 0.04em;
}

.badge-gold-metallic .material-symbols-outlined {
    color: #0B132B !important;
}

/* Card Tier 1: Top Partner (Feature Showcase) */
.partner-card-top-feature {
    background: linear-gradient(180deg, rgba(26, 20, 10, 0.95) 0%, rgba(13, 20, 36, 0.98) 100%);
    border: 1.5px solid rgba(251, 191, 36, 0.38);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5), 0 0 20px rgba(245, 158, 11, 0.08);
}
.partner-card-top-feature:hover {
    border-color: rgba(251, 191, 36, 0.9);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.65), 0 0 30px rgba(245, 158, 11, 0.25);
    transform: translateY(-5px);
}

/* Card Tier 2: Gold Partner (Medium Layout) */
.partner-card-gold-medium {
    background: linear-gradient(180deg, rgba(24, 18, 12, 0.9) 0%, rgba(15, 23, 42, 0.96) 100%);
    border: 1px solid rgba(217, 119, 6, 0.32);
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
}
.partner-card-gold-medium:hover {
    border-color: rgba(245, 158, 11, 0.8);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.55), 0 0 22px rgba(217, 119, 6, 0.22);
    transform: translateY(-4px);
}

/* Card Tier 3: Strategic Partner (Compact List Grid) */
.partner-card-strategic-compact {
    background: rgba(14, 21, 37, 0.85);
    border: 1px solid rgba(51, 65, 85, 0.6);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
    transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
}
.partner-card-strategic-compact:hover {
    background: rgba(19, 29, 51, 0.95);
    border-color: rgba(56, 189, 248, 0.6);
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.45), 0 0 15px rgba(56, 189, 248, 0.12);
    transform: translateY(-2px);
}

@media (prefers-reduced-motion: reduce) {
    .partner-card-stagger, .partner-card-base, .partner-card-strategic-compact {
        transition: none !important;
        transform: none !important;
    }
    .badge-metallic-shimmer, .badge-metallic-shimmer::after {
        animation: none !important;
    }
}
</style>
@endpush

@section('content')
<div class="w-full">

    {{-- 1. Hero (NỀN SÁNG: Surface Low) --}}
    <section class="relative pt-32 pb-16 lg:pt-36 lg:pb-20 overflow-hidden border-b border-slate-200/80 bg-surface-low text-slate-900 bg-dot-grid-subtle">
        {{-- Film Grain Overlay --}}
        <div class="absolute inset-0 film-grain-overlay opacity-10 pointer-events-none"></div>

        {{-- Ambient Studio Lighting Gradient Blobs --}}
        <div class="absolute -top-20 right-0 w-[580px] h-[580px] rounded-full bg-gradient-to-br from-amber-500/15 via-orange-500/10 to-transparent blur-3xl pointer-events-none -mr-20"></div>
        <div class="absolute -bottom-20 -left-20 w-[480px] h-[480px] rounded-full bg-gradient-to-tr from-sky-500/15 via-emerald-500/10 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/3 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[260px] rounded-full bg-amber-400/8 blur-[100px] pointer-events-none"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-surface-low/30 to-surface-low pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Trang chủ</a>
                <span class="text-slate-600">/</span>
                <a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">Về chúng tôi</a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-bold">Đối tác chiến lược</span>
            </nav>

            {{-- 2-Column Hero Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                
                {{-- Cột Trái (lg:col-span-7): Tiết chế nhãn phụ, tập trung H1, lead text & 3 Stat Cards --}}
                <div class="lg:col-span-7 flex flex-col gap-6">
                    {{-- Clean Eyebrow Badge (Tiết chế, chỉ giữ 1 thông điệp chính) --}}
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit shadow-sm">
                        <span class="inline-block w-2 h-2 rounded-full bg-amber-400"></span>
                        <span>OFFICIAL PARTNERS NETWORK</span>
                    </div>

                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-[1.18] text-navy-base">
                        Mạng Lưới Đối Tác <br class="hidden sm:inline" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-accent-amber">Đồng Hành Bền Vững</span> Cùng CLM
                    </h1>

                    <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                        Hơn 10 năm hoạt động, Truyền Thông Cửu Long tự hào kiến tạo liên minh tin cậy cùng các nhà cung cấp hạ tầng số uy tín và mạng lưới 15 đối tác lữ hành, khu bảo tồn sinh thái và đơn vị sự kiện thực chiến trên toàn quốc.
                    </p>

                    {{-- 3 Ô Số Liệu GSAP Count-Up --}}
                    <div class="grid grid-cols-3 gap-3.5 sm:gap-4 pt-2" id="partner-hero-stats">
                        <!-- Stat 1: 17+ -->
                        <div class="partner-stat-card p-4 rounded-2xl bg-white/[0.6] backdrop-blur-md border border-slate-200 hover:border-amber-400/50 hover:bg-white/[0.8] transition-all duration-300 shadow-sm group flex flex-col justify-between">
                            <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="3"/>
                                    <circle cx="6" cy="6" r="2.5"/>
                                    <circle cx="18" cy="6" r="2.5"/>
                                    <circle cx="6" cy="18" r="2.5"/>
                                    <circle cx="18" cy="18" r="2.5"/>
                                    <line x1="8" y1="8" x2="10" y2="10"/>
                                    <line x1="16" y1="8" x2="14" y2="10"/>
                                    <line x1="8" y1="16" x2="10" y2="14"/>
                                    <line x1="16" y1="16" x2="14" y2="14"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-headline text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber tracking-tight">
                                    <span class="partner-stat-counter" data-target="17" data-suffix="+">17+</span>
                                </div>
                                <p class="text-[11px] sm:text-xs text-slate-500 font-medium mt-1 leading-snug">Đối tác chiến lược</p>
                            </div>
                        </div>

                        <!-- Stat 2: 10+ -->
                        <div class="partner-stat-card p-4 rounded-2xl bg-white/[0.6] backdrop-blur-md border border-slate-200 hover:border-sky-400/50 hover:bg-white/[0.8] transition-all duration-300 shadow-sm group flex flex-col justify-between">
                            <div class="w-9 h-9 rounded-xl bg-sky-50 border border-sky-200 text-sky-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m11 17 2 2a1 1 0 0 0 1.4 0l4.6-4.6a2 2 0 0 0 0-2.8l-3.2-3.2a2 2 0 0 0-2.8 0L7 14.4"/>
                                    <path d="m7.1 14.5-3-3a2 2 0 0 1 0-2.8l3.2-3.2a2 2 0 0 1 2.8 0l2.3 2.3"/>
                                    <path d="m15.5 8.5 2.5-2.5a2 2 0 0 1 2.8 0l.4.4"/>
                                    <path d="m2 14 3.5 3.5"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-headline text-2xl sm:text-3xl font-black text-navy-base tracking-tight">
                                    <span class="partner-stat-counter" data-target="10" data-suffix="+">10+</span>
                                </div>
                                <p class="text-[11px] sm:text-xs text-slate-500 font-medium mt-1 leading-snug">Năm gắn kết bền vững</p>
                            </div>
                        </div>

                        <!-- Stat 3: 100% -->
                        <div class="partner-stat-card p-4 rounded-2xl bg-white/[0.6] backdrop-blur-md border border-slate-200 hover:border-emerald-400/50 hover:bg-white/[0.8] transition-all duration-300 shadow-sm group flex flex-col justify-between">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-headline text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-400 tracking-tight">
                                    <span class="partner-stat-counter" data-target="100" data-suffix="%">100%</span>
                                </div>
                                <p class="text-[11px] sm:text-xs text-slate-500 font-medium mt-1 leading-snug">Chuẩn SLA dịch vụ</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cột Phải (lg:col-span-5): Thay sơ đồ Hub-and-Spoke bằng Editorial Photo Collage (Bàn Làm Việc Biên Tập Của Creative Director) --}}
                <div class="lg:col-span-5 relative flex items-center justify-center py-4">
                    {{-- Ambient Backlight Glow --}}
                    <div class="absolute w-72 h-72 rounded-full bg-amber-500/15 blur-3xl pointer-events-none"></div>
                    <div class="absolute w-64 h-64 rounded-full bg-sky-500/10 blur-3xl pointer-events-none -bottom-8 -right-6"></div>

                    <div class="relative w-full max-w-[420px] h-[360px] sm:h-[390px]">
                        {{-- Photo 1: Back Left (Tilted -6deg) — Khu Bảo Tồn Láng Sen --}}
                        <div class="absolute top-2 left-1 w-[220px] sm:w-[250px] rounded-2xl p-2 bg-[#0C1424]/95 border border-white/15 shadow-2xl shadow-black/80 transform -rotate-6 hover:rotate-0 hover:z-30 hover:scale-105 transition-all duration-500 cursor-pointer group">
                            <div class="w-full h-28 sm:h-32 rounded-xl overflow-hidden bg-slate-900 relative">
                                <img src="{{ asset('images/partners/lang_sen_real.jpg') }}" alt="KBT Đất Ngập Nước Láng Sen" class="editorial-film-grade w-full h-full object-cover">
                                <span class="absolute bottom-1.5 left-1.5 px-2 py-0.5 rounded bg-black/70 backdrop-blur-md text-[9px] font-mono text-amber-300 font-bold uppercase">KBT Láng Sen</span>
                            </div>
                            <div class="px-1 pt-1.5 flex items-center justify-between text-[10px] font-mono text-slate-400">
                                <span>Ramsar Wetland</span>
                                <span class="text-amber-400">#02</span>
                            </div>
                        </div>

                        {{-- Photo 2: Back Right (Tilted +6deg) — Long Trekking --}}
                        <div class="absolute top-5 right-1 w-[210px] sm:w-[240px] rounded-2xl p-2 bg-[#0C1424]/95 border border-white/15 shadow-2xl shadow-black/80 transform rotate-6 hover:rotate-0 hover:z-30 hover:scale-105 transition-all duration-500 cursor-pointer group">
                            <div class="w-full h-28 sm:h-32 rounded-xl overflow-hidden bg-slate-900 relative">
                                <img src="{{ asset('images/partners/long_trekking_real.jpg') }}" alt="Long Trekking Trails" class="editorial-film-grade w-full h-full object-cover">
                                <span class="absolute bottom-1.5 left-1.5 px-2 py-0.5 rounded bg-black/70 backdrop-blur-md text-[9px] font-mono text-amber-300 font-bold uppercase">Long Trekking</span>
                            </div>
                            <div class="px-1 pt-1.5 flex items-center justify-between text-[10px] font-mono text-slate-400">
                                <span>Jungle Expeditions</span>
                                <span class="text-amber-400">#01</span>
                            </div>
                        </div>

                        {{-- Photo 3: Foreground Center (Tilted -2deg) — Liên Minh Du Lịch ĐBSCL --}}
                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 w-[260px] sm:w-[290px] rounded-2xl p-2.5 bg-[#10192D] border border-amber-400/40 shadow-[0_20px_45px_rgba(0,0,0,0.85)] transform -rotate-2 hover:rotate-0 hover:z-30 hover:scale-105 transition-all duration-500 cursor-pointer group z-20">
                            <div class="w-full h-32 sm:h-36 rounded-xl overflow-hidden bg-slate-900 relative">
                                <img src="{{ asset('images/partners/lien_minh_dbscl_opt.jpg') }}" alt="Liên Minh Du Lịch ĐBSCL" class="editorial-film-grade w-full h-full object-cover">
                                <span class="absolute top-2 right-2 px-2 py-0.5 rounded-full bg-amber-400/20 border border-amber-400/40 text-[9px] font-mono text-amber-300 font-bold uppercase backdrop-blur-md">Field Archive</span>
                                <span class="absolute bottom-2 left-2 px-2.5 py-1 rounded-md bg-black/75 backdrop-blur-md text-[10px] font-mono text-white font-bold">Đồng Bằng Sông Cửu Long</span>
                            </div>
                            <div class="px-1 pt-2 flex items-center justify-between text-[10px] font-mono">
                                <span class="text-slate-300 font-medium">Tư liệu 13 tỉnh Tây Nam Bộ</span>
                                <span class="text-amber-400 font-bold">17 Partners</span>
                            </div>
                        </div>

                        {{-- Editorial Stamp --}}
                        <div class="absolute -bottom-2 right-2 z-30 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/[0.08] backdrop-blur-md border border-white/15 text-[10px] font-mono text-slate-300 shadow-lg">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                            <span>Curated Field Network</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 2. Hạ Tầng Công Nghệ (NỀN SÁNG: bg-surface) --}}
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 border border-sky-300 text-sky-800 font-mono text-xs font-bold mb-2">
                        <span class="material-symbols-outlined text-[15px] text-sky-600">dns</span>
                        <span>CLOUD &amp; HOSTING INFRASTRUCTURE</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base tracking-tight">Đối Tác Hạ Tầng Máy Chủ &amp; Tên Miền</h2>
                </div>
                <p class="font-body text-xs text-slate-600 max-w-md">Nền tảng máy chủ đám mây vững chắc bảo đảm 99.9% uptime cho mọi website và ứng dụng của khách hàng.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-700 font-mono text-xs font-bold border border-sky-200">DOMAIN &amp; CLOUD HOSTING</span>
                            <span class="text-xs font-mono text-slate-500">Đối tác lâu năm</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">P.A Việt Nam</h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">Nhà đăng ký tên miền và cung cấp dịch vụ máy chủ lớn nhất Việt Nam. Đối tác chiến lược đồng hành cung cấp giải pháp trung tâm dữ liệu chuẩn Tier 3, Cloud VPS và chứng chỉ bảo mật SSL cho các hệ thống doanh nghiệp do CLM xây dựng.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Hạ tầng Tier 3</span>
                        <span>Đăng ký Domain .VN / Quốc tế</span>
                    </div>
                </div>
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 font-mono text-xs font-bold border border-amber-200">INTERNATIONAL CLOUD HOSTING</span>
                            <span class="text-xs font-mono text-slate-500">Đối tác quốc tế</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">Hawk Host</h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">Nhà cung cấp điện toán đám mây và Hosting hiệu năng cao hàng đầu Bắc Mỹ với máy chủ đặt tại Hong Kong và Singapore. Cung cấp hạ tầng tốc độ tải trang cực nhanh và khả năng chống DDoS ổn định cho các cổng thông tin quốc tế.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>LiteSpeed Web Server</span>
                        <span>Multi-Datacenter Routing</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Mạng Lưới Đối Tác Lữ Hành, Du Lịch & Sự Kiện (NỀN SÁNG: Phân Cấp Biên Tập Editorial 3 Tầng) --}}
    <section class="py-16 lg:py-24 bg-surface-low text-slate-900 border-b border-slate-200/80 relative overflow-hidden" style="background-image: radial-gradient(rgba(251, 191, 36, 0.12) 1.5px, transparent 1.5px), radial-gradient(rgba(15, 23, 42, 0.04) 1px, transparent 1px); background-size: 28px 28px;">
        
        {{-- Lens Flare & Ambient Glow --}}
        <div class="absolute top-0 right-1/4 w-[700px] h-[350px] bg-gradient-to-r from-transparent via-amber-500/10 to-transparent blur-[90px] rotate-12 pointer-events-none"></div>
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[900px] h-[400px] rounded-full bg-amber-500/10 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-[600px] h-[340px] rounded-full bg-sky-500/8 blur-[110px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-14 pb-6 border-b border-slate-200/80">
                <div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-100 border border-amber-300 text-amber-700 font-mono text-xs font-bold mb-3">
                        <span class="material-symbols-outlined text-[15px]">travel_explore</span>
                        <span>TOURISM, TRAVEL &amp; EVENTS NETWORK</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-navy-base">Đối Tác Du Lịch, Lữ Hành &amp; Tổ Chức Sự Kiện</h2>
                    <p class="font-body text-slate-600 text-xs sm:text-sm mt-2 max-w-xl">Mạng lưới 15 đơn vị lữ hành, nghỉ dưỡng sinh thái và tổ chức sự kiện chuyên nghiệp đồng hành chặt chẽ trong các chiến dịch truyền thông và tác nghiệp thực địa.</p>
                </div>
                <div class="flex items-center gap-2 text-xs font-mono text-slate-400">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>15 ĐƠN VỊ &bull; 3 TẦNG PHÂN CẤP THỊ GIÁC</span>
                </div>
            </div>

            @php
            $partnerIcons = [
                'long-trekking' => 'terrain',
                'khu-bao-ton-lang-sen' => 'forest',
                'nam-tay-nguyen' => 'hiking',
                'mtc-travel' => 'travel_explore',
                'gonatour' => 'flight_takeoff',
                'apollo-travel-events' => 'campaign',
                'vntravel' => 'language',
                'hoang-anh-event' => 'spatial_audio_off',
                'intertravel' => 'luggage',
                'hoangmai-travel' => 'directions_bus',
                'sgstar' => 'groups',
                'travelife' => 'eco',
                'phu-tho' => 'hub',
                'khu-nghi-duong-cuu-long' => 'water',
                'lien-minh-du-lich-dbscl' => 'diversity_3',
                'pa-viet-nam' => 'dns',
                'hawk-host' => 'cloud',
            ];
            @endphp

            {{-- ======================================================== --}}
            {{-- TẦNG 1: TOP PARTNERS — FEATURE SHOWCASE (3 CARD LỚN)     --}}
            {{-- Ảnh chiếm ~60% chiều cao, tiêu đề overlay đè lên ảnh     --}}
            {{-- ======================================================== --}}
            <div class="mb-14">
                <div class="flex items-center gap-3 mb-6">
                    <span class="px-3 py-1 rounded-md bg-amber-400/15 border border-amber-400/30 text-amber-300 font-mono text-xs font-bold uppercase tracking-wider">
                        01 &bull; TOP TIER SHOWCASE
                    </span>
                    <span class="text-xs font-mono text-slate-400">3 ĐỐI TÁC TIÊU BIỂU NỔI BẬT</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($topPartners as $index => $partner)
                    <div class="partner-card-stagger partner-card-base partner-card-top-feature rounded-3xl overflow-hidden flex flex-col justify-between group" data-index="{{ $index }}">
                        
                        {{-- 1. Large Image Canvas (~60% Height) with Overlay Typography --}}
                        <div class="relative w-full h-72 sm:h-80 overflow-hidden bg-slate-900">
                            <img data-src="{{ Str::startsWith($partner->image, 'http') ? $partner->image : asset('storage/' . $partner->image) }}" 
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 10'%3E%3C/svg%3E"
                                 alt="{{ $partner->name }} - {{ $partner->category }}"
                                 loading="lazy"
                                 decoding="async"
                                 width="600"
                                 height="400"
                                 class="partner-img editorial-film-grade w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 opacity-0 group-hover:opacity-100" />
                            
                            {{-- Gradient Overlay from transparent to dark navy --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0D1424] via-[#0D1424]/50 to-transparent pointer-events-none"></div>

                            {{-- Single Top Partner Metallic Shimmer Badge (Top-Left) --}}
                            <div class="absolute top-4 left-4 z-10">
                                <span class="badge-metallic-shimmer badge-top-metallic inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-mono text-[11px] font-extrabold tracking-wide">
                                    <span class="material-symbols-outlined text-[14px] text-amber-950 fill-1">star</span>
                                    <span>TOP PARTNER</span>
                                </span>
                            </div>

                            {{-- Floating Golden Squircle Icon (Hệ màu vàng kim đồng nhất) --}}
                            <div class="absolute top-4 right-4 z-10 w-11 h-11 rounded-2xl bg-amber-950/85 border border-amber-400/60 text-amber-300 flex items-center justify-center shadow-lg shadow-amber-950/50 backdrop-blur-md group-hover:scale-110 transition-transform duration-300">
                                <span class="material-symbols-outlined text-[22px] select-none">{{ $partnerIcons[$partner->slug] ?? 'star' }}</span>
                            </div>

                            {{-- OVERLAY TITLE BLOCK — Đè trực tiếp lên chân ảnh --}}
                            <div class="absolute bottom-4 left-5 right-5 z-10">
                                <p class="font-mono text-xs text-amber-300 font-bold mb-1 tracking-wide flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    <span>{{ $partner->category }}</span>
                                </p>
                                <h3 class="font-headline text-2xl font-extrabold text-white group-hover:text-amber-300 transition-colors tracking-tight leading-snug">
                                    {{ $partner->name }}
                                </h3>
                            </div>
                        </div>

                        {{-- 2. Minimalist Body: 1 dòng mô tả ngắn, nhiều khoảng thở, không lặp badge --}}
                        <div class="p-6 pt-4 flex-1 flex flex-col justify-between">
                            <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed">
                                {{ $partner->description }}
                            </p>
                            <div class="pt-4 mt-5 border-t border-amber-400/20 flex items-center justify-between text-xs font-mono text-slate-400">
                                <span class="text-amber-300/90 font-medium">{{ $partner->tagline }}</span>
                                <span class="text-slate-500 font-semibold">Cộng tác chiến lược</span>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            {{-- ======================================================== --}}
            {{-- TẦNG 2: GOLD PARTNERS — MEDIUM CARDS (3 CARD TRUNG BÌNH) --}}
            {{-- Layout ảnh + text tách biệt đơn giản, hệ màu đồng/bronze  --}}
            {{-- ======================================================== --}}
            <div class="mb-14 pt-4">
                <div class="flex items-center gap-3 mb-6">
                    <span class="px-3 py-1 rounded-md bg-amber-600/15 border border-amber-600/30 text-amber-400 font-mono text-xs font-bold uppercase tracking-wider">
                        02 &bull; GOLD TIER NETWORK
                    </span>
                    <span class="text-xs font-mono text-slate-400">3 ĐỐI TÁC LỮ HÀNH &amp; TỔ CHỨC SỰ KIỆN</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($goldPartners as $index => $partner)
                    <div class="partner-card-stagger partner-card-base partner-card-gold-medium rounded-3xl overflow-hidden flex flex-col justify-between group" data-index="{{ $index + 3 }}">
                        
                        {{-- Medium Image Banner (~45% Height) --}}
                        <div class="relative w-full h-44 sm:h-48 overflow-hidden bg-slate-900">
                            <img data-src="{{ Str::startsWith($partner->image, 'http') ? $partner->image : asset('storage/' . $partner->image) }}" 
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 9'%3E%3C/svg%3E"
                                 alt="{{ $partner->name }} - {{ $partner->category }}"
                                 loading="lazy"
                                 decoding="async"
                                 width="500"
                                 height="300"
                                 class="partner-img editorial-film-grade w-full h-full object-cover transition-transform duration-600 ease-out group-hover:scale-105 opacity-0 group-hover:opacity-100" />
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-transparent to-black/20 pointer-events-none"></div>

                            {{-- Single Gold Shimmer Badge (Top-Left) --}}
                            <div class="absolute top-3.5 left-3.5 z-10">
                                <span class="badge-metallic-shimmer badge-gold-metallic inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-mono text-[10px] font-extrabold tracking-wide">
                                    <span class="material-symbols-outlined text-[13px] text-amber-950 fill-1">verified</span>
                                    <span>GOLD PARTNER</span>
                                </span>
                            </div>

                            {{-- Floating Bronze Icon Badge (Hệ màu đồng bronze nhất quán) --}}
                            <div class="absolute top-3.5 right-3.5 z-10 w-9 h-9 rounded-xl bg-[#1D140C]/90 border border-amber-600/50 text-amber-400 flex items-center justify-center shadow-md backdrop-blur-md group-hover:scale-110 transition-transform duration-300">
                                <span class="material-symbols-outlined text-[18px] select-none">{{ $partnerIcons[$partner->slug] ?? 'verified' }}</span>
                            </div>
                        </div>

                        {{-- Card Body: Text rõ ràng, tách biệt, không lặp badge --}}
                        <div class="p-6 pt-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-300 transition-colors">
                                    {{ $partner->name }}
                                </h3>
                                <p class="font-mono text-[11px] text-amber-400/90 mt-1 mb-2 font-medium">
                                    {{ $partner->category }}
                                </p>
                                <p class="font-body text-xs text-slate-300 leading-relaxed">
                                    {{ $partner->description }}
                                </p>
                            </div>
                            <div class="pt-3 mt-4 border-t border-slate-800/80 flex items-center justify-between text-xs font-mono text-slate-400">
                                <span class="text-amber-400/80">{{ $partner->tagline }}</span>
                                <span class="text-slate-500">Đối tác uy tín</span>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            {{-- ======================================================== --}}
            {{-- TẦNG 3: STRATEGIC PARTNERS — COMPACT LIST GRID (9 ĐƠN VỊ) --}}
            {{-- Dạng thẻ hàng ngang gọn gàng, hệ màu Slate trung tính     --}}
            {{-- ======================================================== --}}
            <div class="pt-4">
                <div class="flex items-center gap-3 mb-6">
                    <span class="px-3 py-1 rounded-md bg-slate-800 border border-slate-700 text-slate-300 font-mono text-xs font-bold uppercase tracking-wider">
                        03 &bull; STRATEGIC COMPACT DIRECTORY
                    </span>
                    <span class="text-xs font-mono text-slate-400">9 ĐƠN VỊ CHUYÊN SÂU &bull; TRẬT TỰ ĐỒNG NHẤT</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                    @foreach($strategicPartners as $index => $partner)
                    <div class="partner-card-stagger partner-card-strategic-compact rounded-2xl p-3.5 sm:p-4 flex flex-row items-center gap-4 group" data-index="{{ $index + 6 }}">
                        
                        {{-- Small Square/4:3 Thumbnail on the Left --}}
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden shrink-0 bg-slate-900 border border-slate-700/60 relative">
                            <img data-src="{{ Str::startsWith($partner->image, 'http') ? $partner->image : asset('storage/' . $partner->image) }}" 
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                 alt="{{ $partner->name }}"
                                 loading="lazy"
                                 decoding="async"
                                 width="120"
                                 height="120"
                                 class="partner-img editorial-film-grade w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105 opacity-0 group-hover:opacity-100" />
                            
                            {{-- Compact Neutral Icon Overlay on thumbnail --}}
                            <div class="absolute bottom-1.5 right-1.5 w-6 h-6 rounded-md bg-slate-900/90 border border-slate-700 text-slate-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[14px]">{{ $partnerIcons[$partner->slug] ?? 'business' }}</span>
                            </div>
                        </div>

                        {{-- Text Info on the Right: Name, Category, 1-Line Description --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h3 class="font-headline text-sm sm:text-base font-bold text-white group-hover:text-amber-300 transition-colors truncate">
                                    {{ $partner->name }}
                                </h3>
                                <span class="text-[9px] font-mono text-slate-400 uppercase tracking-wide shrink-0">Strategic</span>
                            </div>
                            <p class="font-mono text-[10px] sm:text-[11px] text-slate-400 mb-1 truncate">
                                {{ $partner->category }}
                            </p>
                            <p class="font-body text-[11px] sm:text-xs text-slate-300/80 line-clamp-2 leading-snug">
                                {{ $partner->description }}
                            </p>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- 4. Collaboration Principles (NỀN SÁNG: bg-surface) --}}
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-100 border border-amber-300 text-amber-800 font-mono text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[15px] text-amber-600">handshake</span>
                    <span>PARTNERSHIP VALUES</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-base tracking-tight">
                    3 Tiêu Chuẩn Hợp Tác Bền Vững
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm mt-3">
                    Xây dựng nền tảng liên kết uy tín, minh bạch và tạo ra giá trị cộng hưởng lâu dài.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">
                        01
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Tôn Trọng Cam Kết SLA</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Mọi thỏa thuận hợp tác về chất lượng dịch vụ, thời gian vận hành và bảo mật dữ liệu đều được cam kết chặt chẽ bằng văn bản pháp lý.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">
                        02
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Đôi Bên Cùng Phát Triển (Win-Win)</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Chia sẻ nguồn lực, tệp khách hàng và kinh nghiệm chuyên môn để cùng tạo ra sản phẩm dịch vụ hoàn hảo nhất tới tay người tiêu dùng.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">
                        03
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Đồng Hành Dài Hạn</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Chúng tôi hướng đến mối quan hệ hợp tác chiến lược tính bằng nhiều năm, không chạy theo lợi nhuận ngắn hạn hay hợp đồng nhất thời.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.partner-card-stagger');
    
    // Lazy load partner banner images when within 300px of viewport
    const partnerImages = document.querySelectorAll('.partner-img');
    if ('IntersectionObserver' in window && partnerImages.length > 0) {
        const imgObserver = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.onload = function() {
                            img.classList.remove('opacity-0');
                            img.classList.add('opacity-85');
                        };
                        if (img.complete) {
                            img.classList.remove('opacity-0');
                            img.classList.add('opacity-85');
                        }
                    }
                    obs.unobserve(img);
                }
            });
        }, { rootMargin: '300px 0px' });

        partnerImages.forEach(function(img) {
            imgObserver.observe(img);
        });
    } else {
        partnerImages.forEach(function(img) {
            if (img.dataset.src) img.src = img.dataset.src;
            img.classList.remove('opacity-0');
            img.classList.add('opacity-85');
        });
    }

    // Stagger reveal on scroll
    if ('IntersectionObserver' in window && cards.length > 0) {
        const observer = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const idx = parseInt(entry.target.getAttribute('data-index') || '0', 10);
                    setTimeout(function() {
                        entry.target.classList.add('revealed');
                    }, (idx % 3) * 75);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

        cards.forEach(function(card) {
            observer.observe(card);
        });
    } else {
        cards.forEach(function(card) { card.classList.add('revealed'); });
    }

    // Stats Count-Up: Synchronized with GSAP ScrollTrigger matching /ve-chung-toi & Homepage
    const statsContainer = document.getElementById('partner-hero-stats');
    if (statsContainer) {
        const animateStats = () => {
            document.querySelectorAll('#partner-hero-stats .partner-stat-counter').forEach(counter => {
                const target = parseFloat(counter.getAttribute('data-target'));
                const isDecimal = target % 1 !== 0;
                const suffix = counter.getAttribute('data-suffix') || '';
                const obj = { val: 0 };
                if (typeof gsap !== 'undefined') {
                    gsap.to(obj, {
                        val: target,
                        duration: 1.4,
                        ease: 'power2.out',
                        onUpdate: () => {
                            counter.textContent = (isDecimal ? obj.val.toFixed(1) : Math.round(obj.val)) + suffix;
                        }
                    });
                }
            });
        };

        if (typeof ScrollTrigger !== 'undefined' && typeof gsap !== 'undefined') {
            ScrollTrigger.create({
                trigger: statsContainer,
                start: 'top 92%',
                once: true,
                onEnter: animateStats
            });
        } else {
            setTimeout(animateStats, 150);
        }
    }
});
</script>
@endpush

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AboutPage",
    "name": "Mạng Lưới Đối Tác Chiến Lược - Truyền Thông Cửu Long",
    "description": "Danh sách các đối tác hạ tầng công nghệ và du lịch lữ hành đồng hành bền vững cùng Truyền Thông Cửu Long.",
    "url": "{{ route('partners') }}"
}
</script>
@endsection

