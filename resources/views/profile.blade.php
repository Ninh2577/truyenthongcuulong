@extends('layouts.app')

@section('title', 'Hồ Sơ Năng Lực - Công Ty TNHH Truyền Thông Cửu Long')
@section('meta_description', 'Hồ sơ năng lực Công ty TNHH Truyền Thông Cửu Long (Cuu Long Media). Tổ hợp giải pháp truyền thông sáng tạo, sản xuất phim doanh nghiệp, marketing và công nghệ số hàng đầu tại Cần Thơ & ĐBSCL.')
@section('canonical', route('profile'))

@push('styles')
<style>
    /* Scoped styling cho trang Hồ Sơ Năng Lực */
    .profile-hero-overlay {
        background: linear-gradient(180deg, rgba(8, 14, 28, 0.38) 0%, rgba(8, 14, 28, 0.65) 55%, rgba(6, 11, 24, 0.95) 100%);
    }

    .hero-heading-white {
        background: linear-gradient(180deg, #FFFFFF 20%, #E2E8F0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 2px 14px rgba(0, 0, 0, 0.6));
    }

    .hero-heading-orange {
        background: linear-gradient(90deg, #FF5E00 0%, #FF8C00 45%, #FFB703 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 4px 24px rgba(255, 94, 0, 0.75));
    }

    .badge-hero-pill {
        background: linear-gradient(135deg, rgba(255, 94, 0, 0.25) 0%, rgba(255, 170, 0, 0.15) 100%);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1.5px solid rgba(255, 150, 45, 0.65);
        color: #fff7ed;
        box-shadow: 0 4px 20px rgba(255, 94, 0, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.4);
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
    }

    .btn-hero-primary {
        background: linear-gradient(135deg, #FF4500 0%, #FF6A00 45%, #FFA500 100%);
        box-shadow: 0 10px 28px -4px rgba(255, 80, 0, 0.7), 0 0 20px rgba(255, 140, 0, 0.4), inset 0 1.5px 1.5px rgba(255, 255, 255, 0.45);
        border: 1.5px solid rgba(255, 185, 60, 0.85);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }
    .btn-hero-primary:hover {
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 14px 34px -4px rgba(255, 80, 0, 0.85), 0 0 28px rgba(255, 170, 0, 0.55), inset 0 1.5px 2px rgba(255, 255, 255, 0.6);
        border-color: #ffe082;
    }

    .btn-hero-secondary {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.18) 0%, rgba(255, 255, 255, 0.08) 100%);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1.5px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25), inset 0 1px 1px rgba(255, 255, 255, 0.35);
        color: #ffffff;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .btn-hero-secondary:hover {
        transform: translateY(-2px) scale(1.03);
        background: linear-gradient(135deg, rgba(255, 122, 24, 0.35) 0%, rgba(255, 255, 255, 0.25) 100%);
        border-color: #ffa726;
        box-shadow: 0 12px 30px rgba(255, 106, 0, 0.35), inset 0 1px 1.5px rgba(255, 255, 255, 0.55);
    }

    .glass-card-dark {
        background: linear-gradient(180deg, rgba(13, 22, 42, 0.88) 0%, rgba(7, 13, 26, 0.96) 100%);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-top: 1.5px solid rgba(255, 150, 50, 0.65);
        box-shadow: 0 24px 50px -10px rgba(0, 0, 0, 0.7), 0 0 35px rgba(255, 94, 0, 0.15);
    }

    .cap-icon-box {
        background: linear-gradient(135deg, rgba(255, 94, 0, 0.25) 0%, rgba(255, 160, 0, 0.14) 100%);
        border: 1.5px solid rgba(255, 140, 40, 0.5);
        box-shadow: 0 4px 14px rgba(255, 94, 0, 0.25), inset 0 1px 1px rgba(255, 255, 255, 0.3);
        color: #ff9d42;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .profile-cap-item:hover .cap-icon-box {
        transform: translateY(-2px) scale(1.12);
        background: linear-gradient(135deg, #ff5e00 0%, #ff8c00 100%);
        border-color: #ffd54f;
        color: #ffffff;
        box-shadow: 0 8px 22px rgba(255, 94, 0, 0.65), 0 0 16px rgba(255, 170, 0, 0.5);
    }
    .cap-label-text {
        color: #f1f5f9;
        transition: color 0.25s ease, text-shadow 0.25s ease;
    }
    .profile-cap-item:hover .cap-label-text {
        color: #ffaa40;
        text-shadow: 0 0 12px rgba(255, 140, 40, 0.5);
    }

    .badge-pill-orange {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 9999px;
        font-family: var(--font-headline, sans-serif);
        font-size: 11.5px;
        font-weight: 800;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        background: #fff4ec;
        border: 1.5px solid #fed7aa;
        color: #ff5e00;
        box-shadow: 0 2px 8px rgba(255, 94, 0, 0.08);
    }

    .solution-card-item {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
    .solution-card-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px -8px rgba(255, 94, 0, 0.15);
        border-color: rgba(255, 94, 0, 0.35);
    }
    .solution-card-item:hover .solution-img {
        transform: scale(1.06);
    }
    .solution-img {
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .project-profile-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 18px -2px rgba(15, 23, 42, 0.05);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
    .project-profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 32px -8px rgba(15, 23, 42, 0.12);
        border-color: rgba(255, 94, 0, 0.3);
    }
    .project-profile-card:hover .project-img {
        transform: scale(1.05);
    }
    .project-img {
        transition: transform 0.5s ease-out;
    }

    .partner-brand-pill {
        background: #ffffff;
        border: 1.5px solid #edf2f7;
        border-radius: 18px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
    }
    .partner-brand-pill:hover {
        transform: translateY(-3px);
        border-color: #ff5e00;
        box-shadow: 0 10px 24px rgba(255, 94, 0, 0.12);
    }

    .profile-hero-aspect {
        min-height: 560px;
    }
    @media (min-width: 1024px) {
        .profile-hero-aspect {
            aspect-ratio: 1983 / 793;
            min-height: 0 !important;
        }
    }

    .profile-capabilities-grid {
        display: grid !important;
        grid-template-columns: repeat(5, minmax(0, 1fr)) !important;
        align-items: center !important;
        width: 100% !important;
    }

    @media (max-width: 640px) {
        .profile-capabilities-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 10px !important;
        }
    }

    @media (min-width: 641px) {
        .profile-cap-item:not(:last-child) {
            border-right: 1px solid rgba(255, 255, 255, 0.12);
        }
    }

    /* Section 2: Về Chúng Tôi - Quote Card & Stat Boxes */
    .profile-quote-card {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        border-radius: 24px;
        overflow: hidden;
        background: linear-gradient(135deg, #fffdfa 0%, #fff6ec 55%, #feedd7 100%);
        border: 1.5px solid #fed7aa;
        box-shadow: 0 10px 30px rgba(255, 94, 0, 0.08);
        height: 100%;
        min-height: 240px;
    }
    .profile-quote-text {
        flex: 1 1 53%;
        padding: 24px 22px 20px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }
    .profile-quote-photo {
        flex: 1 1 47%;
        position: relative;
        min-height: 220px;
        overflow: hidden;
        background: #feedd7;
    }
    .profile-quote-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }
    .profile-quote-photo:hover img {
        transform: scale(1.04);
    }
    .profile-quote-blend {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(254, 237, 215, 0.98) 0%, rgba(254, 237, 215, 0.45) 25%, transparent 60%);
        pointer-events-none;
    }
    @media (max-width: 639px) {
        .profile-quote-card {
            flex-direction: column;
        }
        .profile-quote-text {
            padding: 20px 18px;
        }
        .profile-quote-photo {
            min-height: 200px;
        }
        .profile-quote-blend {
            background: linear-gradient(to bottom, rgba(254, 237, 215, 0.95) 0%, transparent 40%);
        }
    }
    .profile-stat-box {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-bottom: 3.5px solid #ff5e00 !important;
        border-radius: 16px;
        padding: 12px 14px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .profile-stat-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 94, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="w-full bg-[#fbfcfd] text-slate-800 overflow-hidden">

    <!-- ========================================================
         SECTION 1: HERO COVER BANNER (HỒ SƠ NĂNG LỰC) - TỈ LỆ CHUẨN TRANG CHỦ (1983 x 793)
         ======================================================== -->
    <section class="relative w-full overflow-hidden text-white border-b border-slate-200/80" id="profile-hero">
        <!-- Container giữ tỉ lệ đồng nhất với banner trang chủ: 1983 / 793 (2.5:1) -->
        <div class="relative w-full bg-[#0b1324] overflow-hidden select-none flex flex-col justify-between profile-hero-aspect">

            <!-- Background Image Panorama (1983 x 793) -->
            <div class="absolute inset-0 z-0">
                @php
                    $heroBannerPng = 'images/profile/hero_banner.png';
                    $heroBannerPath = file_exists(public_path($heroBannerPng)) ? $heroBannerPng : 'images/real-cameraman-production.jpg';
                    $heroBannerUrl = asset($heroBannerPath) . '?v=' . filemtime(public_path($heroBannerPath));
                @endphp
                <img src="{{ $heroBannerUrl }}" 
                     alt="Hồ sơ năng lực - Công ty TNHH Truyền Thông Cửu Long" 
                     class="w-full h-full object-cover object-center select-none pointer-events-none"
                     loading="eager"
                     fetchpriority="high"
                     width="1983"
                     height="793">
                <!-- Scrim overlay removed to keep hero_banner.png completely clear and vibrant -->
            </div>

            <!-- Hero Content Container (Fitted neatly within 1983x793 frame) -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-between py-6 sm:py-8 lg:py-8 xl:py-10">
                
                <!-- Top / Middle: Heading, Intro & Slogan -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 xl:gap-8 items-center my-auto">
                    <!-- Left 7-8 Cols: Khối thông tin Giới thiệu (Đóng khối kính mờ cao cấp, chữ nổi bật, nền ảnh rõ nét) -->
                    <div class="lg:col-span-7 xl:col-span-8 text-left p-5 sm:p-7 lg:p-8 rounded-3xl"
                         style="background: rgba(10, 16, 32, 0.58); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1.5px solid rgba(255, 255, 255, 0.16); box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);">
                        
                        <!-- Badge pill (Sáng rõ, nổi bật 100%, không bị chìm/mất chữ) -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full font-headline text-[11px] sm:text-[11.5px] font-black uppercase tracking-wider mb-3 select-none"
                             style="background: #fff5ec; border: 1.5px solid #fed7aa; box-shadow: 0 4px 14px rgba(255, 94, 0, 0.25);">
                            <span class="w-2 h-2 rounded-full bg-[#ff5e00] shadow-[0_0_8px_#ff5e00] animate-pulse"></span>
                            <span style="color: #ff5e00; font-weight: 900; letter-spacing: 0.06em;">HỒ SƠ NĂNG LỰC</span>
                        </div>

                        <h1 class="font-headline text-2xl sm:text-3xl lg:text-[34px] xl:text-[40px] font-black tracking-tight uppercase leading-[1.15]">
                            <span class="hero-heading-white">CÔNG TY TNHH TRUYỀN THÔNG</span><br>
                            <span class="hero-heading-orange">CỬU LONG</span>
                        </h1>

                        <div class="inline-flex items-center gap-2.5 mt-1.5 mb-2.5">
                            <span class="w-6 h-[2px] bg-gradient-to-r from-transparent to-[#ff9d42]"></span>
                            <p class="font-headline text-xs sm:text-sm font-extrabold tracking-[0.25em] uppercase text-amber-300 drop-shadow-[0_2px_8px_rgba(0,0,0,0.6)]">
                                (CUU LONG MEDIA)
                            </p>
                            <span class="w-6 h-[2px] bg-gradient-to-l from-transparent to-[#ff9d42]"></span>
                        </div>

                        <p class="font-body text-xs sm:text-[14px] lg:text-[14.5px] leading-relaxed text-slate-100 max-w-2xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.7)]">
                            Truyền Thông Cửu Long tự hào là <strong class="text-white font-bold drop-shadow-sm">đối tác đồng hành tin cậy</strong>, mang đến những giải pháp truyền thông <span class="text-amber-300 font-semibold drop-shadow-sm">sáng tạo, chuyên nghiệp và hiệu quả</span>, giúp thương hiệu của bạn tỏa sáng vượt trội.
                        </p>

                        <!-- Buttons Group -->
                        <div class="flex flex-wrap items-center gap-3.5 sm:gap-4 mt-5 sm:mt-6">
                            <a href="#giai-phap-toan-dien" 
                               class="btn-hero-primary inline-flex items-center gap-2.5 px-6 py-2.5 sm:px-7 sm:py-3 rounded-full font-headline text-xs sm:text-sm font-black text-white group cursor-pointer active:scale-95">
                                <span>Khám phá năng lực</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>

                            <a href="{{ route('contact') }}" 
                               class="btn-hero-secondary inline-flex items-center gap-2 px-6 py-2.5 sm:px-7 sm:py-3 rounded-full font-headline text-xs sm:text-sm font-bold text-white group cursor-pointer active:scale-95"
                               style="background: rgba(255, 255, 255, 0.16); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1.5px solid rgba(255, 255, 255, 0.45); box-shadow: 0 4px 16px rgba(0,0,0,0.25);">
                                <span class="material-symbols-outlined text-[19px] text-[#ffb703] group-hover:scale-110 transition-transform">support_agent</span>
                                <span style="color: #ffffff; font-weight: 700;">Liên hệ tư vấn</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Cols: Giữ trong suốt để hiển thị toàn bộ Người quay phim & Slogan trong ảnh banner của khách -->
                    <div class="lg:col-span-5 xl:col-span-4 hidden lg:block"></div>
                </div>

                <!-- Bottom: 5 Khối Năng Lực Độc Lập (Bỏ nền đen dải dài, tách thành 5 khối kính mờ riêng biệt) -->
                <div class="mt-4 sm:mt-5 lg:mt-6 w-full max-w-6xl mx-auto">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2.5 sm:gap-3 lg:gap-3.5">
                        
                        <!-- 1. Tư vấn - Chiến lược -->
                        <div class="profile-cap-item flex flex-col items-center justify-center text-center p-2.5 sm:p-3 rounded-2xl group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:border-orange-400"
                             style="background: rgba(10, 16, 32, 0.60); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1.5px solid rgba(255, 255, 255, 0.16); box-shadow: 0 10px 25px rgba(0,0,0,0.35);">
                            <div class="cap-icon-box w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center mb-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-[20px] sm:text-[22px]">explore</span>
                            </div>
                            <span class="cap-label-text font-headline text-[11px] sm:text-[12px] lg:text-[12.5px] font-bold leading-tight">
                                Tư vấn - Chiến lược
                            </span>
                        </div>

                        <!-- 2. Sản xuất - Hậu kỳ -->
                        <div class="profile-cap-item flex flex-col items-center justify-center text-center p-2.5 sm:p-3 rounded-2xl group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:border-orange-400"
                             style="background: rgba(10, 16, 32, 0.60); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1.5px solid rgba(255, 255, 255, 0.16); box-shadow: 0 10px 25px rgba(0,0,0,0.35);">
                            <div class="cap-icon-box w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center mb-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-[20px] sm:text-[22px]">movie</span>
                            </div>
                            <span class="cap-label-text font-headline text-[11px] sm:text-[12px] lg:text-[12.5px] font-bold leading-tight">
                                Sản xuất - Hậu kỳ
                            </span>
                        </div>

                        <!-- 3. Thiết kế - Lập trình -->
                        <div class="profile-cap-item flex flex-col items-center justify-center text-center p-2.5 sm:p-3 rounded-2xl group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:border-orange-400"
                             style="background: rgba(10, 16, 32, 0.60); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1.5px solid rgba(255, 255, 255, 0.16); box-shadow: 0 10px 25px rgba(0,0,0,0.35);">
                            <div class="cap-icon-box w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center mb-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-[20px] sm:text-[22px]">devices</span>
                            </div>
                            <span class="cap-label-text font-headline text-[11px] sm:text-[12px] lg:text-[12.5px] font-bold leading-tight">
                                Thiết kế - Lập trình
                            </span>
                        </div>

                        <!-- 4. Marketing - Quảng cáo -->
                        <div class="profile-cap-item flex flex-col items-center justify-center text-center p-2.5 sm:p-3 rounded-2xl group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:border-orange-400"
                             style="background: rgba(10, 16, 32, 0.60); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1.5px solid rgba(255, 255, 255, 0.16); box-shadow: 0 10px 25px rgba(0,0,0,0.35);">
                            <div class="cap-icon-box w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center mb-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-[20px] sm:text-[22px]">campaign</span>
                            </div>
                            <span class="cap-label-text font-headline text-[11px] sm:text-[12px] lg:text-[12.5px] font-bold leading-tight">
                                Marketing - Quảng cáo
                            </span>
                        </div>

                        <!-- 5. Tổ chức & Phát triển -->
                        <div class="profile-cap-item flex flex-col items-center justify-center text-center p-2.5 sm:p-3 rounded-2xl group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:border-orange-400 col-span-2 sm:col-span-1"
                             style="background: rgba(10, 16, 32, 0.60); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1.5px solid rgba(255, 255, 255, 0.16); box-shadow: 0 10px 25px rgba(0,0,0,0.35);">
                            <div class="cap-icon-box w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center mb-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-[20px] sm:text-[22px]">diversity_3</span>
                            </div>
                            <span class="cap-label-text font-headline text-[11px] sm:text-[12px] lg:text-[12.5px] font-bold leading-tight">
                                Tổ chức &amp; Phát triển
                            </span>
                        </div>

                    </div>
                </div>

                    <!-- Cuộn xuống để khám phá thêm prompt -->
                    <div class="flex items-center justify-center gap-2 text-amber-300/85 text-[11px] font-bold mt-2.5 select-none">
                        <span class="w-4 h-5 rounded-full border border-amber-400/60 flex items-start justify-center p-0.5 shadow-[0_0_8px_rgba(255,160,0,0.35)]">
                            <span class="w-1 h-1.5 rounded-full bg-gradient-to-b from-[#ff5e00] to-[#ffaa00] animate-bounce"></span>
                        </span>
                        <span class="tracking-wider uppercase text-[10px] sm:text-[10.5px] text-amber-200/90 font-extrabold">Cuộn xuống để khám phá thêm</span>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================================
         SECTION 2: VỀ CHÚNG TÔI (ABOUT & VISION / MISSION)
         ======================================================== -->
    <section class="py-16 sm:py-20 lg:py-24 bg-[#fffdfa] relative overflow-hidden" id="ve-chung-toi">
        <!-- Họa tiết cọ sơn trang trí góc trên phải (Orange Paint Brush Top Right) -->
        <div class="absolute -top-6 -right-6 w-36 sm:w-52 lg:w-64 pointer-events-none select-none z-0 opacity-90">
            <svg viewBox="0 0 240 120" fill="none" class="w-full h-auto">
                <path d="M40 20C90 10 160 5 220 2C228 15 235 40 215 50C170 65 110 50 60 70C45 60 30 35 40 20Z" fill="url(#brushGradTop)" opacity="0.9"/>
                <path d="M120 15C170 8 210 12 235 25C225 45 190 40 140 45C100 50 70 60 50 55C70 35 95 25 120 15Z" fill="#ff7a18" opacity="0.7"/>
                <path d="M170 5C200 2 230 10 240 30C220 35 180 25 150 20C160 12 165 8 170 5Z" fill="#ffaa00" opacity="0.5"/>
                <defs>
                    <linearGradient id="brushGradTop" x1="40" y1="20" x2="220" y2="50" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#ff5e00"/>
                        <stop offset="1" stop-color="#ff9900"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Họa tiết cọ sơn trang trí góc dưới trái (Orange Paint Brush Bottom Left) -->
        <div class="absolute -bottom-8 -left-8 w-44 sm:w-60 lg:w-72 pointer-events-none select-none z-0 opacity-90">
            <svg viewBox="0 0 260 140" fill="none" class="w-full h-auto">
                <path d="M10 120C40 90 90 70 150 65C170 80 160 110 110 125C60 135 30 130 10 120Z" fill="url(#brushGradBottom)" opacity="0.95"/>
                <path d="M25 105C65 75 125 60 190 55C205 70 185 95 140 110C95 120 50 125 25 105Z" fill="#ff7a18" opacity="0.75"/>
                <path d="M60 85C110 55 170 45 230 40C240 55 210 80 160 95C120 105 85 95 60 85Z" fill="#ffaa00" opacity="0.45"/>
                <defs>
                    <linearGradient id="brushGradBottom" x1="10" y1="120" x2="190" y2="55" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#ff5e00"/>
                        <stop offset="1" stop-color="#ff9900"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Dãy núi mây mờ thoai thoải chân trang trí ở đáy mục (Mountain Silhouette Footprint) -->
        <div class="absolute bottom-0 inset-x-0 h-20 sm:h-28 pointer-events-none opacity-20 overflow-hidden z-0">
            <svg class="w-full h-full object-cover" viewBox="0 0 1440 140" fill="none" preserveAspectRatio="none">
                <path d="M0 140L0 95C60 80 120 105 180 85C240 65 300 100 360 75C420 50 480 90 540 68C600 45 660 98 720 80C780 62 840 110 900 90C960 68 1020 115 1080 75C1140 38 1200 85 1260 62C1320 40 1380 72 1440 55L1440 140Z" fill="#94a3b8"/>
                <path d="M0 140L0 115C80 98 160 125 240 108C320 90 400 120 480 100C560 78 640 118 720 105C800 90 880 125 960 108C1040 90 1120 120 1200 105C1280 85 1360 112 1440 95L1440 140Z" fill="#64748b"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 xl:gap-8 items-stretch">
                
                <!-- ================= LEFT COLUMN: Giới thiệu & 4 Thẻ số liệu + Thẻ Nhận diện Thương hiệu ================= -->
                <div class="flex flex-col justify-between space-y-4">
                    <div>
                        <!-- Badge Cam Về chúng tôi -->
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-headline text-[11px] font-extrabold uppercase tracking-wider mb-2"
                             style="background: #fff4ec; border: 1.5px solid #fed7aa; color: #ff5e00; box-shadow: 0 2px 8px rgba(255, 94, 0, 0.08);">
                            <span class="material-symbols-outlined text-[15px]">group</span>
                            <span>VỀ CHÚNG TÔI</span>
                        </div>

                        <!-- Tiêu đề lớn: Đội ngũ trẻ – năng động – sáng tạo. -->
                        <div class="mb-2.5">
                            <h2 class="font-headline text-2xl sm:text-3xl lg:text-[32px] font-black tracking-tight leading-tight" style="color: #0f172a;">
                                <span>Đội ngũ trẻ – </span>
                                <span style="color: #ff5e00;">năng động – sáng tạo.</span>
                            </h2>
                            <!-- Nét cọ uốn cong dưới tiêu đề -->
                            <svg class="w-28 sm:w-36 h-2 mt-1" viewBox="0 0 160 12" fill="none" style="color: #ff5e00;">
                                <path d="M2 9C40 2 110 1 158 8" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
                            </svg>
                        </div>

                        <!-- Mô tả văn bản -->
                        <p class="font-body text-slate-600 text-xs sm:text-[13px] lg:text-[13.5px] leading-relaxed max-w-xl">
                            Các thành viên tại <strong class="text-slate-900 font-bold">Truyền Thông Cửu Long</strong> đều là những người trẻ nhiệt huyết và đầy sáng tạo, mang trong mình khát vọng kiến tạo giá trị thông qua các giải pháp truyền thông. Chúng tôi luôn đặt chất lượng, hiệu quả và sự hài lòng của khách hàng lên hàng đầu.
                        </p>
                    </div>

                    <!-- 4 Thẻ Thống Kê Nhanh (Grid 4 cột viền cam đáy) -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3 pt-0.5">
                        
                        <!-- 1. 40+ Nhân sự -->
                        <div class="profile-stat-box">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0"
                                     style="background: #fff4ec; border: 1px solid #fed7aa; color: #ff5e00;">
                                    <span class="material-symbols-outlined text-[15px]">group</span>
                                </div>
                                <span class="font-headline text-lg sm:text-xl font-black text-slate-900 leading-none">40+</span>
                            </div>
                            <p class="font-body text-[11px] leading-snug text-slate-500 font-medium">
                                Nhân sự năng động trẻ sáng tạo
                            </p>
                        </div>

                        <!-- 2. 100% Dự án -->
                        <div class="profile-stat-box">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0"
                                     style="background: #fff4ec; border: 1px solid #fed7aa; color: #ff5e00;">
                                    <span class="material-symbols-outlined text-[15px]">check_circle</span>
                                </div>
                                <span class="font-headline text-lg sm:text-xl font-black text-slate-900 leading-none">100%</span>
                            </div>
                            <p class="font-body text-[11px] leading-snug text-slate-500 font-medium">
                                Dự án đúng tiến độ cam kết
                            </p>
                        </div>

                        <!-- 3. 100+ Khách hàng -->
                        <div class="profile-stat-box">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0"
                                     style="background: #fff4ec; border: 1px solid #fed7aa; color: #ff5e00;">
                                    <span class="material-symbols-outlined text-[15px]">sentiment_satisfied</span>
                                </div>
                                <span class="font-headline text-lg sm:text-xl font-black text-slate-900 leading-none">100+</span>
                            </div>
                            <p class="font-body text-[11px] leading-snug text-slate-500 font-medium">
                                Khách hàng hài lòng mỗi năm
                            </p>
                        </div>

                        <!-- 4. 10+ Đối tác -->
                        <div class="profile-stat-box">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0"
                                     style="background: #fff4ec; border: 1px solid #fed7aa; color: #ff5e00;">
                                    <span class="material-symbols-outlined text-[15px]">handshake</span>
                                </div>
                                <span class="font-headline text-lg sm:text-xl font-black text-slate-900 leading-none">10+</span>
                            </div>
                            <p class="font-body text-[11px] leading-snug text-slate-500 font-medium">
                                Đối tác chiến lược
                            </p>
                        </div>

                    </div>

                    <!-- Thẻ Logo Nhận Diện Thương Hiệu Ngang (Đồng bộ Mockup) -->
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-white border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex items-center justify-between gap-4 hover:border-orange-200 transition-all min-h-[82px]">
                        <div class="flex items-center gap-3.5">
                            <!-- Khối logo vuông bo tròn vàng cam -->
                            <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl p-1 shrink-0 flex items-center justify-center shadow-sm"
                                 style="background: linear-gradient(135deg, #ff9900 0%, #ff7a18 50%, #ff5e00 100%); width: 52px; height: 52px;">
                                <div class="w-full h-full bg-white rounded-xl p-1 flex items-center justify-center">
                                    <img src="{{ asset('images/logo-ttcl.png') }}" 
                                         alt="Logo Truyền Thông Cửu Long" 
                                         class="w-full h-full object-contain">
                                </div>
                            </div>
                            <div>
                                <h4 class="font-headline text-sm sm:text-[15px] font-black uppercase text-slate-900 tracking-wider">
                                    TRUYỀN THÔNG CỬU LONG
                                </h4>
                                <p class="font-body text-xs sm:text-[12.5px] text-slate-500 font-medium mt-0.5">
                                    Kiến tạo giá trị – Lan tỏa thương hiệu
                                </p>
                            </div>
                        </div>

                        <!-- Mũi tên decor hướng phải -->
                        <div class="flex items-center gap-1.5 pr-2 select-none" style="color: #ff5e00;">
                            <span class="w-8 sm:w-14 h-[1.5px]" style="background: linear-gradient(to right, transparent, #ff5e00);"></span>
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- ================= RIGHT COLUMN: Khối Tầm Nhìn & Ảnh Đội Ngũ + Khối Sứ Mệnh ================= -->
                <div class="flex flex-col justify-between space-y-4">
                    
                    <!-- Khối Tầm Nhìn Lớn: Trích dẫn lãnh đạo kết hợp Ảnh Đội ngũ trẻ trung (Horizontal Split) -->
                    <div class="profile-quote-card">
                        <!-- Cột trái: Trích dẫn Tầm nhìn -->
                        <div class="profile-quote-text">
                            <div>
                                <!-- Dấu ngoặc kép cam to -->
                                <div class="text-3xl sm:text-4xl font-serif leading-none font-black mb-2 select-none" style="color: #ff5e00;">
                                    “
                                </div>
                                <blockquote class="font-headline text-xs sm:text-[13.5px] lg:text-[14px] font-bold italic text-slate-800 leading-relaxed">
                                    Trở thành công ty truyền thông phát triển bền vững dựa trên tư duy đổi mới, thích ứng linh hoạt vì kỷ nguyên số.
                                </blockquote>
                            </div>

                            <div class="mt-4 pt-3 border-t border-orange-200/80">
                                <h4 class="font-headline text-xs sm:text-[13.5px] font-extrabold text-slate-900">
                                    Ban Điều Hành
                                </h4>
                                <p class="font-body text-[11px] text-slate-500 font-medium mt-0.5">
                                    Công ty TNHH Truyền Thông Cửu Long
                                </p>
                            </div>
                        </div>

                        <!-- Cột phải: Ảnh chụp Đội ngũ thực tế Cửu Long Media -->
                        <div class="profile-quote-photo">
                            @php
                                $teamImgPng = 'images/profile/team_leadership.png';
                                $teamImgJpg = 'images/profile/team_leadership.jpg';
                                $teamImgPath = file_exists(public_path($teamImgPng)) ? $teamImgPng : (file_exists(public_path($teamImgJpg)) ? $teamImgJpg : 'images/about/about_team_visual.png');
                                $teamImgUrl = asset($teamImgPath) . (file_exists(public_path($teamImgPath)) ? '?v=' . filemtime(public_path($teamImgPath)) : '');
                            @endphp
                            <img src="{{ $teamImgUrl }}" 
                                 alt="Ban Điều Hành & Đội ngũ Truyền Thông Cửu Long" 
                                 loading="eager">
                            <!-- Lớp phủ gradient mờ mềm mại hòa quyện giữa nền trích dẫn và ảnh -->
                            <div class="profile-quote-blend"></div>
                        </div>
                    </div>

                    <!-- Khối Sứ Mệnh (Đồng bộ Mockup & Căn thẳng hàng với Thẻ Brand bên trái) -->
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-white border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex items-center gap-3.5 text-left hover:border-orange-200 transition-all min-h-[82px]">
                        <div class="w-11 h-11 rounded-full flex items-center justify-center shrink-0 shadow-xs"
                             style="background: linear-gradient(135deg, #fff2e8 0%, #ffe8d6 100%); border: 1.5px solid #fed7aa; color: #ff5e00;">
                            <span class="material-symbols-outlined text-[22px]">track_changes</span>
                        </div>
                        <div>
                            <h4 class="font-headline text-sm sm:text-[15px] font-black text-slate-900">
                                Sứ Mệnh
                            </h4>
                            <p class="font-body text-xs sm:text-[12.5px] text-slate-600 mt-0.5 leading-relaxed">
                                Tạo ra những giải pháp truyền thông sáng tạo, hiệu quả, đồng hành cùng khách hàng phát triển bền vững.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- ========================================================
         SECTION 3: NĂNG LỰC CỦA CHÚNG TÔI (GIẢI PHÁP TRUYỀN THÔNG & CÔNG NGHỆ TOÀN DIỆN)
         ======================================================== -->
    <section class="py-16 sm:py-20 lg:py-24 bg-[#fafbfc] relative border-t border-slate-100" id="giai-phap-toan-dien">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
                <span class="badge-pill-orange mb-3.5">
                    NĂNG LỰC CỦA CHÚNG TÔI
                </span>

                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Giải Pháp Truyền Thông &amp; Công Nghệ Toàn Diện
                </h2>

                <p class="font-body text-slate-500 text-xs sm:text-sm md:text-[15px] mt-3 leading-relaxed">
                    Chúng tôi cung cấp các dịch vụ chuyên sâu, từ sản xuất nội dung, marketing số đến phát triển công nghệ, giúp doanh nghiệp nâng tầm thương hiệu và hiệu quả kinh doanh.
                </p>
            </div>

            <!-- 5 Thẻ Năng Lực Cốt Lõi (Grid 5 cột trên Desktop) -->
            @php
                $findSolutionImg = function($baseName, $fallback = '') {
                    $extensions = ['png', 'jpg', 'jpeg', 'webp'];
                    foreach ($extensions as $ext) {
                        $rel = "images/profile/{$baseName}.{$ext}";
                        if (file_exists(public_path($rel))) {
                            return asset($rel) . '?v=' . filemtime(public_path($rel));
                        }
                    }
                    if ($fallback && file_exists(public_path($fallback))) {
                        return asset($fallback);
                    }
                    return asset("images/profile/{$baseName}.png");
                };
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4.5 sm:gap-5 items-stretch">
                
                <!-- Card 1: Sản Xuất Phim Doanh Nghiệp & Sự Kiện -->
                <div class="solution-card-item group">
                    <div>
                        <!-- Thumbnail Image với nút icon tròn đè góc -->
                        <div class="relative w-full aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $findSolutionImg('solution_film_production', 'images/quay-phim-su-kien/service_film_production_hero.jpg') }}" 
                                 alt="Sản Xuất Phim Doanh Nghiệp & Sự Kiện" 
                                 class="w-full h-full object-cover solution-img"
                                 loading="lazy">
                            <!-- Icon tròn cam đè góc dưới trái ảnh -->
                            <div class="absolute -bottom-3 left-4 w-8 h-8 rounded-full bg-[#ff5e00] text-white flex items-center justify-center shadow-md z-10">
                                <span class="material-symbols-outlined text-[16px]">videocam</span>
                            </div>
                        </div>

                        <!-- Content Body -->
                        <div class="p-4 sm:p-5 pt-6 text-left">
                            <h3 class="font-headline text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-[#ff5e00] transition-colors leading-snug">
                                Sản Xuất Phim Doanh Nghiệp &amp; Sự Kiện
                            </h3>
                            <p class="font-body text-xs text-slate-500 mt-2 leading-relaxed">
                                Tạo nên những thước phim chuyên nghiệp, truyền tải thông điệp thương hiệu.
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Link -->
                    <div class="p-4 sm:p-5 pt-0 text-left">
                        <a href="{{ route('services.media') }}" 
                            class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-[#ff5e00] hover:text-[#e05200] transition-colors group-hover:translate-x-0.5 transition-transform">
                            <span>Tìm hiểu thêm</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Thiết Kế & Lập Trình Web-App -->
                <div class="solution-card-item group">
                    <div>
                        <div class="relative w-full aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $findSolutionImg('solution_webapp_design', 'images/modern_tech_platform.jpg') }}" 
                                 alt="Thiết Kế & Lập Trình Web-App" 
                                 class="w-full h-full object-cover solution-img"
                                 loading="lazy">
                            <div class="absolute -bottom-3 left-4 w-8 h-8 rounded-full bg-[#ff5e00] text-white flex items-center justify-center shadow-md z-10">
                                <span class="material-symbols-outlined text-[16px]">terminal</span>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 pt-6 text-left">
                            <h3 class="font-headline text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-[#ff5e00] transition-colors leading-snug">
                                Thiết Kế &amp; Lập Trình Web-App
                            </h3>
                            <p class="font-body text-xs text-slate-500 mt-2 leading-relaxed">
                                Website, ứng dụng hiện đại chuẩn SEO, tối ưu trải nghiệm người dùng.
                            </p>
                        </div>
                    </div>

                    <div class="p-4 sm:p-5 pt-0 text-left">
                        <a href="{{ route('services.web-app') }}" 
                            class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-[#ff5e00] hover:text-[#e05200] transition-colors group-hover:translate-x-0.5 transition-transform">
                            <span>Tìm hiểu thêm</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 3: Quảng Cáo Google Ads & Facebook -->
                <div class="solution-card-item group">
                    <div>
                        <div class="relative w-full aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $findSolutionImg('solution_digital_ads', 'images/digital_marketing_laptop.jpg') }}" 
                                 alt="Quảng Cáo Google Ads & Facebook" 
                                 class="w-full h-full object-cover solution-img"
                                 loading="lazy">
                            <div class="absolute -bottom-3 left-4 w-8 h-8 rounded-full bg-[#ff5e00] text-white flex items-center justify-center shadow-md z-10">
                                <span class="material-symbols-outlined text-[16px]">ads_click</span>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 pt-6 text-left">
                            <h3 class="font-headline text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-[#ff5e00] transition-colors leading-snug">
                                Quảng Cáo Google Ads &amp; Facebook
                            </h3>
                            <p class="font-body text-xs text-slate-500 mt-2 leading-relaxed">
                                Tiếp cận đúng khách hàng, tối ưu chi phí, gia tăng doanh số.
                            </p>
                        </div>
                    </div>

                    <div class="p-4 sm:p-5 pt-0 text-left">
                        <a href="{{ route('services.marketing') }}" 
                            class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-[#ff5e00] hover:text-[#e05200] transition-colors group-hover:translate-x-0.5 transition-transform">
                            <span>Tìm hiểu thêm</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 4: 3D Motion Design & AI Studio -->
                <div class="solution-card-item group">
                    <div>
                        <div class="relative w-full aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $findSolutionImg('solution_3d_ai_motion', 'images/graphic_design_workspace.jpg') }}" 
                                 alt="3D Motion Design & AI Studio" 
                                 class="w-full h-full object-cover solution-img"
                                 loading="lazy">
                            <div class="absolute -bottom-3 left-4 w-8 h-8 rounded-full bg-[#ff5e00] text-white flex items-center justify-center shadow-md z-10">
                                <span class="material-symbols-outlined text-[16px]">view_in_ar</span>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 pt-6 text-left">
                            <h3 class="font-headline text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-[#ff5e00] transition-colors leading-snug">
                                3D Motion Design &amp; AI Studio
                            </h3>
                            <p class="font-body text-xs text-slate-500 mt-2 leading-relaxed">
                                Biến ý tưởng thành hình ảnh sống động, sáng tạo, chuyên nghiệp.
                            </p>
                        </div>
                    </div>

                    <div class="p-4 sm:p-5 pt-0 text-left">
                        <a href="{{ route('services.ui-ux') }}" 
                            class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-[#ff5e00] hover:text-[#e05200] transition-colors group-hover:translate-x-0.5 transition-transform">
                            <span>Tìm hiểu thêm</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 5: Booking Team Media -->
                <div class="solution-card-item group">
                    <div>
                        <div class="relative w-full aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $findSolutionImg('solution_booking_media', 'images/team_meeting_room.jpg') }}" 
                                 alt="Booking Team Media" 
                                 class="w-full h-full object-cover solution-img"
                                 loading="lazy">
                            <div class="absolute -bottom-3 left-4 w-8 h-8 rounded-full bg-[#ff5e00] text-white flex items-center justify-center shadow-md z-10">
                                <span class="material-symbols-outlined text-[16px]">groups</span>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 pt-6 text-left">
                            <h3 class="font-headline text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-[#ff5e00] transition-colors leading-snug">
                                Booking Team Media
                            </h3>
                            <p class="font-body text-xs text-slate-500 mt-2 leading-relaxed">
                                Kết nối KOLs, content creator, nhân sự truyền thông, sự kiện, phim, hợp tác toàn diện.
                            </p>
                        </div>
                    </div>

                    <div class="p-4 sm:p-5 pt-0 text-left">
                        <a href="{{ route('booking') }}" 
                           class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-[#ff5e00] hover:text-[#e05200] transition-colors group-hover:translate-x-0.5 transition-transform">
                            <span>Tìm hiểu thêm</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 4: SỨC MẠNH TỪ KINH NGHIỆM & CÔNG NGHỆ (DARK STATS BANNER)
         ======================================================== -->
    <section class="relative w-full py-16 sm:py-20 bg-slate-900 overflow-hidden text-white" id="suc-manh-kinh-nghiem">
        <!-- Background Image Panorama hoàng hôn -->
        <div class="absolute inset-0 z-0">
            @php
                $statsBgPath = 'images/profile/stats_banner_bg.png';
                $hasStatsBg = file_exists(public_path($statsBgPath));
                $statsBgUrl = $hasStatsBg ? asset($statsBgPath) . '?v=' . filemtime(public_path($statsBgPath)) : asset('images/real-cameraman-production.jpg');
            @endphp
            <img src="{{ $statsBgUrl }}" 
                 alt="Sức Mạnh Từ Kinh Nghiệm & Công Nghệ" 
                 class="w-full h-full object-cover object-center select-none pointer-events-none opacity-45">
            <!-- Dark gradient filter -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-slate-950/95"></div>
            <!-- Subtle orange glow -->
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#ff5e00]/20 blur-[120px] rounded-full pointer-events-none"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Left 5 Cols: Tiêu đề & Lời dẫn -->
                <div class="lg:col-span-5 text-left">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-headline text-xs font-extrabold uppercase tracking-wider mb-3.5"
                          style="background: #ff5e00; color: #ffffff; box-shadow: 0 4px 14px rgba(255, 94, 0, 0.4);">
                        KHẲNG ĐỊNH VỊ THẾ
                    </span>

                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight">
                        Sức Mạnh Từ Kinh Nghiệm<br>
                        &amp; Công Nghệ
                    </h2>

                    <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed mt-3 max-w-lg">
                        Chúng tôi sở hữu đội ngũ nhân sự chuyên môn, tư duy thực thi linh hoạt, chuyên nghiệp và hệ thống công nghệ hiện đại, sẵn sàng đáp ứng mọi nhu cầu của khách hàng.
                    </p>
                </div>

                <!-- Right 7 Cols: 4 Cột Số Liệu Ấn Tượng ngăn cách nét đứt cam -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-2">
                        
                        <!-- Col 1 -->
                        <div class="flex flex-col items-center text-center p-3 sm:p-4 border-r-0 sm:border-r border-dashed border-orange-500/40">
                            <div class="w-11 h-11 rounded-2xl bg-orange-500/20 border border-orange-400/30 flex items-center justify-center text-[#ff7a18] mb-2.5">
                                <span class="material-symbols-outlined text-[24px]">workspace_premium</span>
                            </div>
                            <span class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight">
                                5+
                            </span>
                            <span class="font-headline text-[10.5px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-300 mt-1">
                                NĂM KINH NGHIỆM TRONG NGÀNH
                            </span>
                        </div>

                        <!-- Col 2 -->
                        <div class="flex flex-col items-center text-center p-3 sm:p-4 border-r-0 sm:border-r border-dashed border-orange-500/40">
                            <div class="w-11 h-11 rounded-2xl bg-orange-500/20 border border-orange-400/30 flex items-center justify-center text-[#ff7a18] mb-2.5">
                                <span class="material-symbols-outlined text-[24px]">groups</span>
                            </div>
                            <span class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight">
                                30+
                            </span>
                            <span class="font-headline text-[10.5px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-300 mt-1">
                                NHÂN SỰ CHUYÊN MÔN
                            </span>
                        </div>

                        <!-- Col 3 -->
                        <div class="flex flex-col items-center text-center p-3 sm:p-4 border-r-0 sm:border-r border-dashed border-orange-500/40">
                            <div class="w-11 h-11 rounded-2xl bg-orange-500/20 border border-orange-400/30 flex items-center justify-center text-[#ff7a18] mb-2.5">
                                <span class="material-symbols-outlined text-[24px]">folder_special</span>
                            </div>
                            <span class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight">
                                500+
                            </span>
                            <span class="font-headline text-[10.5px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-300 mt-1">
                                DỰ ÁN ĐÃ TRIỂN KHAI
                            </span>
                        </div>

                        <!-- Col 4 -->
                        <div class="flex flex-col items-center text-center p-3 sm:p-4">
                            <div class="w-11 h-11 rounded-2xl bg-orange-500/20 border border-orange-400/30 flex items-center justify-center text-[#ff7a18] mb-2.5">
                                <span class="material-symbols-outlined text-[24px]">favorite</span>
                            </div>
                            <span class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight">
                                98%
                            </span>
                            <span class="font-headline text-[10.5px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-300 mt-1">
                                KHÁCH HÀNG HÀI LÒNG
                            </span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================================
         SECTION 5: DỰ ÁN TIÊU BIỂU (HÀNH TRÌNH KIẾN TẠO NHỮNG GIÁ TRỊ THỰC)
         ======================================================== -->
    <section class="py-16 sm:py-20 lg:py-24 bg-white relative" id="du-an-tieu-bieu">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header với Nút Xem Tất Cả Bên Phải -->
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-10 sm:mb-12">
                <div>
                    <span class="badge-pill-orange mb-3">
                        DỰ ÁN TIÊU BIỂU
                    </span>

                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                        Hành Trình Kiến Tạo Những Giá Trị Thực
                    </h2>

                    <p class="font-body text-slate-500 text-xs sm:text-sm mt-2 max-w-xl">
                        Khám phá một số dự án tiêu biểu mà chúng tôi đã thực hiện, phản ánh năng lực sáng tạo và kinh nghiệm trong nhiều lĩnh vực khác nhau.
                    </p>
                </div>

                <a href="{{ route('projects.index') }}" 
                   class="inline-flex items-center gap-1.5 font-headline text-xs sm:text-sm font-bold text-[#ff5e00] hover:text-[#e05200] transition-colors shrink-0 group">
                    <span>Xem tất cả dự án</span>
                    <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- 6 Thẻ Dự Án (Grid 3 Cột x 2 Hàng từ CSDL) -->
            @php
                $projectsList = (isset($featuredProjects) && $featuredProjects->isNotEmpty())
                    ? $featuredProjects
                    : \App\Models\CaseStudy::where('featured', true)->orderBy('order')->take(6)->get();

                if ($projectsList->isEmpty()) {
                    $projectsList = \App\Models\CaseStudy::orderBy('order')->take(6)->get();
                }
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
                @forelse($projectsList as $project)
                    @php
                        $coverImg = $project->cover_image_url ?: asset('images/projects/web_tuilanguoimientay.jpg');
                        $isMedia = $project->group === 'media';
                        $groupLabel = $isMedia ? 'Media & Phim' : 'Website & App';
                        $badgeStyle = $isMedia 
                            ? 'background: #fff7ed; color: #ff5e00; border: 1px solid #fed7aa;' 
                            : 'background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;';
                        $projectUrl = route('projects.show', $project->slug);
                    @endphp
                    <a href="{{ $projectUrl }}" class="project-profile-card group flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-300">
                        <div>
                            <!-- Thumbnail Image -->
                            <div class="relative w-full aspect-[16/9] overflow-hidden bg-slate-100">
                                <img src="{{ $coverImg }}" 
                                     alt="{{ $project->title }}" 
                                     class="w-full h-full object-cover project-img group-hover:scale-105 transition-transform duration-500"
                                     loading="lazy">
                                <!-- Badge Thể loại góc trên bên trái -->
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10.5px] font-extrabold uppercase tracking-wider shadow-xs"
                                          style="{{ $badgeStyle }}">
                                        {{ $project->client_name ?: $groupLabel }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content Body -->
                            <div class="p-4 sm:p-5 text-left">
                                <h3 class="font-headline text-sm sm:text-base font-black text-slate-900 group-hover:text-[#ff5e00] transition-colors leading-snug line-clamp-1">
                                    {{ $project->title }}
                                </h3>
                                <p class="font-body text-xs text-slate-500 mt-1.5 leading-relaxed line-clamp-2">
                                    {{ $project->summary ?: ($project->meta_data['problem'] ?? 'Dự án tiêu biểu được thực hiện bởi đội ngũ Truyền Thông Cửu Long.') }}
                                </p>
                            </div>
                        </div>

                        <!-- Footer Link & Icon Arrow -->
                        <div class="p-4 sm:p-5 pt-0 flex items-center justify-between">
                            <span class="text-xs font-headline font-bold text-[#ff5e00] group-hover:underline inline-flex items-center gap-1">
                                <span>Xem chi tiết</span>
                            </span>
                            <span class="w-7 h-7 rounded-full bg-orange-50 text-[#ff5e00] flex items-center justify-center group-hover:bg-[#ff5e00] group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-400">
                        Đang cập nhật các dự án tiêu biểu...
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 6: KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI (TESTIMONIALS)
         ======================================================== -->
    <section class="py-16 sm:py-20 lg:py-24 relative overflow-hidden border-t border-slate-100" id="danh-gia-khach-hang"
             style="background: linear-gradient(180deg, #ffffff 0%, #fffdfa 40%, #fff8f0 100%);">
        
        <!-- Họa tiết sóng cam uốn cong nghệ thuật ở góc dưới phải -->
        <div class="absolute -bottom-10 -right-10 w-64 sm:w-80 lg:w-96 pointer-events-none select-none z-0 opacity-80">
            <svg viewBox="0 0 320 220" fill="none" class="w-full h-auto">
                <path d="M40 220C120 180 200 120 260 40C280 15 310 0 320 0V220H40Z" fill="url(#decorWaveOrange)" opacity="0.25"/>
                <path d="M120 220C180 190 240 140 290 80C305 60 315 30 320 10V220H120Z" fill="url(#decorWaveOrange)" opacity="0.4"/>
                <defs>
                    <linearGradient id="decorWaveOrange" x1="40" y1="220" x2="320" y2="40" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#ff9900"/>
                        <stop offset="1" stop-color="#ff5e00"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header: Tiêu đề trung tâm & Slogan viết tay góc phải (Đã bỏ Logo & Tên Cty Cửu Long) -->
            <div class="relative flex flex-col items-center justify-center mb-12 sm:mb-14">
                
                <!-- Tiêu đề trung tâm (Căn giữa đối xứng hoàn hảo) -->
                <div class="text-center max-w-2xl mx-auto">
                    <!-- Badge Cam -->
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full font-headline text-[11px] font-extrabold uppercase tracking-wider mb-3 shadow-xs"
                         style="background: #fff4ec; border: 1.5px solid #fed7aa; color: #ff5e00;">
                        <span>KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI</span>
                    </div>

                    <!-- Tiêu đề lớn -->
                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-[34px] font-black tracking-tight leading-tight mb-2.5">
                        <span class="text-slate-900">Lắng nghe những </span>
                        <span style="color: #ff5e00;">giá trị thật</span>
                    </h2>

                    <!-- Mô tả ngắn gọn -->
                    <p class="font-body text-slate-500 text-xs sm:text-[13.5px] leading-relaxed max-w-xl mx-auto">
                        Sự tin tưởng và những phản hồi tích cực từ khách hàng chính là động lực để chúng tôi không ngừng sáng tạo và mang đến những giải pháp truyền thông hiệu quả hơn mỗi ngày.
                    </p>
                </div>

                <!-- Slogan Viết Tay / Nghệ Thuật Góc Phải -->
                <div class="hidden lg:flex flex-col items-end justify-center absolute right-0 top-1/2 -translate-y-1/2 text-right select-none pointer-events-none">
                    <p class="font-serif italic font-extrabold text-[14px] lg:text-[15px] leading-snug tracking-wide" style="color: #ff5e00;">
                        Khách hàng<br>
                        là người bạn đồng hành<br>
                        của chúng tôi!
                    </p>
                    <svg class="w-28 lg:w-32 h-2.5 mt-1" viewBox="0 0 140 12" fill="none" style="color: #ff7a18;">
                        <path d="M2 9C35 2 95 1 138 8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </div>

            </div>

            <!-- Khối Đánh Giá (3 Thẻ ngang) -->
            <div class="relative">
                
                <!-- Grid 3 Thẻ Đánh Giá (Custom thiết kế tinh gọn - Bỏ hình người) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6">
                    
                    <!-- ================= Card 1: Mekong Eco Travel ================= -->
                    <div class="rounded-3xl bg-white border border-slate-200/80 p-6 sm:p-7 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_rgba(255,94,0,0.08)] hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                        <!-- Nét viền cam nhấn nhẹ ở cạnh trên -->
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#ff9900] via-[#ff7a18] to-[#ff5e00]"></div>

                        <div>
                            <!-- Header thẻ: Dấu ngoặc kép & Đánh giá 5 sao -->
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-serif text-2xl font-black shadow-xs select-none"
                                     style="background: #fff4ec; border: 1.5px solid #fed7aa; color: #ff5e00;">
                                    “
                                </div>
                                <div class="flex items-center gap-1 text-[#ff7a18] text-xs sm:text-sm select-none">
                                    ★ ★ ★ ★ ★
                                </div>
                            </div>

                            <!-- Trích dẫn đánh giá -->
                            <p class="font-body text-xs sm:text-[13.5px] text-slate-700 leading-relaxed italic mb-6 text-left">
                                "Đội ngũ chuyên nghiệp, sáng tạo và luôn lắng nghe khách hàng. Chúng tôi rất hài lòng với chất lượng dịch vụ từ Truyền Thông Cửu Long."
                            </p>
                        </div>

                        <!-- Footer: Logo, Tên khách hàng & Badge chứng nhận -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2.5 text-left">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full border border-slate-200/90 overflow-hidden shrink-0 p-0.5 bg-white shadow-xs">
                                    <img src="{{ asset('images/profile/avatar_cuu_phuoc.png') }}" 
                                         alt="Logo Mekong Eco Travel" 
                                         class="w-full h-full object-contain rounded-full">
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-headline text-xs sm:text-[13.5px] font-black text-slate-900 truncate">
                                        Mekong Eco Travel
                                    </h4>
                                    <p class="font-body text-[11px] text-slate-500 truncate mt-0.5">
                                        Thương hiệu du lịch & lữ hành
                                    </p>
                                </div>
                            </div>

                            <span class="hidden sm:inline-flex items-center gap-1 text-[10.5px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 rounded-full shrink-0">
                                <span class="material-symbols-outlined text-[13px]">verified</span>
                                <span>Xác thực</span>
                            </span>
                        </div>
                    </div>

                    <!-- ================= Card 2: An Nhiên Beauty ================= -->
                    <div class="rounded-3xl bg-white border border-slate-200/80 p-6 sm:p-7 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_rgba(255,94,0,0.08)] hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#ff9900] via-[#ff7a18] to-[#ff5e00]"></div>

                        <div>
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-serif text-2xl font-black shadow-xs select-none"
                                     style="background: #fff4ec; border: 1.5px solid #fed7aa; color: #ff5e00;">
                                    “
                                </div>
                                <div class="flex items-center gap-1 text-[#ff7a18] text-xs sm:text-sm select-none">
                                    ★ ★ ★ ★ ★
                                </div>
                            </div>

                            <p class="font-body text-xs sm:text-[13.5px] text-slate-700 leading-relaxed italic mb-6 text-left">
                                "Dự án được triển khai đúng tiến độ, chất lượng vượt mong đợi. Rất hài lòng và sẽ tiếp tục hợp tác cùng Cửu Long Media."
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2.5 text-left">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full border border-slate-200/90 overflow-hidden shrink-0 p-0.5 bg-white shadow-xs">
                                    <img src="{{ asset('images/profile/avatar_kim_hy.png') }}" 
                                         alt="Logo An Nhiên Beauty" 
                                         class="w-full h-full object-contain rounded-full">
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-headline text-xs sm:text-[13.5px] font-black text-slate-900 truncate">
                                        An Nhiên Beauty
                                    </h4>
                                    <p class="font-body text-[11px] text-slate-500 truncate mt-0.5">
                                        Thương hiệu mỹ phẩm thiên nhiên
                                    </p>
                                </div>
                            </div>

                            <span class="hidden sm:inline-flex items-center gap-1 text-[10.5px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 rounded-full shrink-0">
                                <span class="material-symbols-outlined text-[13px]">verified</span>
                                <span>Xác thực</span>
                            </span>
                        </div>
                    </div>

                    <!-- ================= Card 3: SIP Beverage ================= -->
                    <div class="rounded-3xl bg-white border border-slate-200/80 p-6 sm:p-7 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_16px_36px_rgba(255,94,0,0.08)] hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#ff9900] via-[#ff7a18] to-[#ff5e00]"></div>

                        <div>
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-serif text-2xl font-black shadow-xs select-none"
                                     style="background: #fff4ec; border: 1.5px solid #fed7aa; color: #ff5e00;">
                                    “
                                </div>
                                <div class="flex items-center gap-1 text-[#ff7a18] text-xs sm:text-sm select-none">
                                    ★ ★ ★ ★ ★
                                </div>
                            </div>

                            <p class="font-body text-xs sm:text-[13.5px] text-slate-700 leading-relaxed italic mb-6 text-left">
                                "Sự sáng tạo và chuyên nghiệp của đội ngũ đã giúp chúng tôi gia tăng nhận diện thương hiệu rõ rệt trong các chiến dịch truyền thông."
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2.5 text-left">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full border border-slate-200/90 overflow-hidden shrink-0 p-0.5 bg-white shadow-xs">
                                    <img src="{{ asset('images/profile/avatar_sip_cream.png') }}" 
                                         alt="Logo SIP Beverage" 
                                         class="w-full h-full object-contain rounded-full">
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-headline text-xs sm:text-[13.5px] font-black text-slate-900 truncate">
                                        SIP Beverage
                                    </h4>
                                    <p class="font-body text-[11px] text-slate-500 truncate mt-0.5">
                                        Chuỗi đồ uống & ẩm thực
                                    </p>
                                </div>
                            </div>

                            <span class="hidden sm:inline-flex items-center gap-1 text-[10.5px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 rounded-full shrink-0">
                                <span class="material-symbols-outlined text-[13px]">verified</span>
                                <span>Xác thực</span>
                            </span>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Thanh Thống Kê / Cam Kết Tin Cậy Ở Đáy (Trust Bar 4 Cột - 4 Khối Màu Cam Chủ Đạo & Icon Nổi Bật) -->
            <div class="mt-12 relative z-10">
                <!-- Vầng hào quang cam ngoại vi -->
                <div class="absolute -inset-1.5 rounded-[32px] blur-xl opacity-75 -z-10 pointer-events-none"
                     style="background: linear-gradient(90deg, rgba(255,153,0,0.25) 0%, rgba(255,94,0,0.35) 50%, rgba(255,122,24,0.25) 100%);"></div>

                <!-- Khung chính màu trắng viền cam sang trọng -->
                <div class="rounded-3xl p-4 sm:p-6 lg:p-7 relative overflow-hidden transition-all duration-300"
                     style="background: #ffffff; border: 2px solid #fed7aa; box-shadow: 0 16px 45px rgba(255,94,0,0.14);">
                    
                    <!-- Dải cam gradient trên đỉnh thẻ -->
                    <div class="absolute top-0 inset-x-0 h-1.5"
                         style="background: linear-gradient(90deg, #ff9900 0%, #ff5e00 50%, #ff7a18 100%);"></div>

                    <!-- Lưới 4 khối màu cam chủ đạo (Tone cam dịu hơn một chút & Đổ bóng màu cam nổi bật) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4 lg:gap-5">
                        
                        <!-- 1. 100+ Khách hàng tin tưởng -->
                        <div class="group flex items-center gap-3.5 p-4 rounded-2xl transition-all duration-300 hover:-translate-y-1.5"
                             style="background: linear-gradient(135deg, #ffa256 0%, #ff7626 100%); border: 1px solid rgba(255,255,255,0.25); box-shadow: 0 14px 32px -2px rgba(255, 94, 0, 0.48), 0 6px 16px rgba(255, 120, 36, 0.30);">
                            <!-- Hộp icon nền trắng tương phản cao, chống tiệp màu -->
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300"
                                 style="background: #ffffff; box-shadow: 0 4px 14px rgba(0,0,0,0.14);">
                                <span class="material-symbols-outlined text-[24px] select-none" style="color: #ff6e1d; font-size: 24px;">handshake</span>
                            </div>
                            <div>
                                <span class="font-headline text-2xl sm:text-[26px] font-black leading-none block tracking-tight"
                                      style="color: #ffffff; text-shadow: 0 2px 6px rgba(180, 50, 0, 0.30);">
                                    100+
                                </span>
                                <span class="font-body text-xs sm:text-[13px] font-bold mt-1 block"
                                      style="color: #ffffff; opacity: 0.96; text-shadow: 0 1px 4px rgba(180, 50, 0, 0.25);">
                                    Khách hàng tin tưởng
                                </span>
                            </div>
                        </div>

                        <!-- 2. 95% Khách hàng hài lòng -->
                        <div class="group flex items-center gap-3.5 p-4 rounded-2xl transition-all duration-300 hover:-translate-y-1.5"
                             style="background: linear-gradient(135deg, #ffa256 0%, #ff7626 100%); border: 1px solid rgba(255,255,255,0.25); box-shadow: 0 14px 32px -2px rgba(255, 94, 0, 0.48), 0 6px 16px rgba(255, 120, 36, 0.30);">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300"
                                 style="background: #ffffff; box-shadow: 0 4px 14px rgba(0,0,0,0.14);">
                                <span class="material-symbols-outlined text-[24px] select-none" style="color: #ff6e1d; font-size: 24px;">star</span>
                            </div>
                            <div>
                                <span class="font-headline text-2xl sm:text-[26px] font-black leading-none block tracking-tight"
                                      style="color: #ffffff; text-shadow: 0 2px 6px rgba(180, 50, 0, 0.30);">
                                    95%
                                </span>
                                <span class="font-body text-xs sm:text-[13px] font-bold mt-1 block"
                                      style="color: #ffffff; opacity: 0.96; text-shadow: 0 1px 4px rgba(180, 50, 0, 0.25);">
                                    Khách hàng hài lòng
                                </span>
                            </div>
                        </div>

                        <!-- 3. 98% Dự án đúng tiến độ -->
                        <div class="group flex items-center gap-3.5 p-4 rounded-2xl transition-all duration-300 hover:-translate-y-1.5"
                             style="background: linear-gradient(135deg, #ffa256 0%, #ff7626 100%); border: 1px solid rgba(255,255,255,0.25); box-shadow: 0 14px 32px -2px rgba(255, 94, 0, 0.48), 0 6px 16px rgba(255, 120, 36, 0.30);">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300"
                                 style="background: #ffffff; box-shadow: 0 4px 14px rgba(0,0,0,0.14);">
                                <span class="material-symbols-outlined text-[24px] select-none" style="color: #ff6e1d; font-size: 24px;">schedule</span>
                            </div>
                            <div>
                                <span class="font-headline text-2xl sm:text-[26px] font-black leading-none block tracking-tight"
                                      style="color: #ffffff; text-shadow: 0 2px 6px rgba(180, 50, 0, 0.30);">
                                    98%
                                </span>
                                <span class="font-body text-xs sm:text-[13px] font-bold mt-1 block"
                                      style="color: #ffffff; opacity: 0.96; text-shadow: 0 1px 4px rgba(180, 50, 0, 0.25);">
                                    Dự án đúng tiến độ
                                </span>
                            </div>
                        </div>

                        <!-- 4. 100% Cam kết chất lượng -->
                        <div class="group flex items-center gap-3.5 p-4 rounded-2xl transition-all duration-300 hover:-translate-y-1.5"
                             style="background: linear-gradient(135deg, #ffa256 0%, #ff7626 100%); border: 1px solid rgba(255,255,255,0.25); box-shadow: 0 14px 32px -2px rgba(255, 94, 0, 0.48), 0 6px 16px rgba(255, 120, 36, 0.30);">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300"
                                 style="background: #ffffff; box-shadow: 0 4px 14px rgba(0,0,0,0.14);">
                                <span class="material-symbols-outlined text-[24px] select-none" style="color: #ff6e1d; font-size: 24px;">verified_user</span>
                            </div>
                            <div>
                                <span class="font-headline text-2xl sm:text-[26px] font-black leading-none block tracking-tight"
                                      style="color: #ffffff; text-shadow: 0 2px 6px rgba(180, 50, 0, 0.30);">
                                    100%
                                </span>
                                <span class="font-body text-xs sm:text-[13px] font-bold mt-1 block"
                                      style="color: #ffffff; opacity: 0.96; text-shadow: 0 1px 4px rgba(180, 50, 0, 0.25);">
                                    Cam kết chất lượng
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 7: ĐỐI TÁC CHIẾN LƯỢC (MẠNG LƯỚI THƯƠNG HIỆU THÀNH VIÊN)
         ======================================================== -->
    <section class="py-16 sm:py-20 bg-white relative" id="mang-luoi-doi-tac">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-left mb-8 sm:mb-10">
                <span class="badge-pill-orange mb-3">
                    ĐỐI TÁC CHIẾN LƯỢC
                </span>

                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Mạng Lưới Thương Hiệu Thành Viên
                </h2>

                <p class="font-body text-slate-500 text-xs sm:text-sm mt-2 max-w-xl">
                    Hệ sinh thái các thương hiệu và đối tác chiến lược mà Truyền Thông Cửu Long đã và đang đồng hành.
                </p>
            </div>

            <!-- 4 Thẻ Thương Hiệu Thành Viên (Grid 4 Cột) -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-5">
                
                <!-- 1. Tôi Là Người Miền Tây -->
                <div class="partner-brand-pill group">
                    <div class="w-11 h-11 rounded-xl bg-slate-50 border border-slate-200/80 p-1.5 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/ecosystem/mientay.png') }}" 
                             alt="Tôi là Người Miền Tây" 
                             class="w-full h-full object-contain">
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-headline text-xs sm:text-sm font-extrabold text-slate-900 group-hover:text-[#ff5e00] transition-colors truncate">
                            Tôi là Người
                        </h4>
                        <p class="font-body text-[11px] text-slate-500 truncate">
                            Miền Tây
                        </p>
                    </div>
                </div>

                <!-- 2. Tiêu Dao Tử -->
                <div class="partner-brand-pill group">
                    <div class="w-11 h-11 rounded-xl bg-slate-50 border border-slate-200/80 p-1.5 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/ecosystem/tieudaotu.png') }}" 
                             alt="Tiêu Dao Tử" 
                             class="w-full h-full object-contain">
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-headline text-xs sm:text-sm font-extrabold text-slate-900 group-hover:text-[#ff5e00] transition-colors truncate">
                            Tiêu Dao Tử
                        </h4>
                        <p class="font-body text-[11px] text-slate-500 truncate">
                            Du lịch &amp; Trải nghiệm
                        </p>
                    </div>
                </div>

                <!-- 3. Cửu Long Camping -->
                <div class="partner-brand-pill group">
                    <div class="w-11 h-11 rounded-xl bg-slate-50 border border-slate-200/80 p-1.5 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/ecosystem/camping.png') }}" 
                             alt="Cửu Long Camping" 
                             class="w-full h-full object-contain">
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-headline text-xs sm:text-sm font-extrabold text-slate-900 group-hover:text-[#ff5e00] transition-colors truncate">
                            Cửu Long Camping
                        </h4>
                        <p class="font-body text-[11px] text-slate-500 truncate">
                            Glamping &amp; Dã ngoại
                        </p>
                    </div>
                </div>

                <!-- 4. Cùng Chơi -->
                <div class="partner-brand-pill group">
                    <div class="w-11 h-11 rounded-xl bg-slate-50 border border-slate-200/80 p-1.5 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/ecosystem/cungchoi.png') }}" 
                             alt="Cùng Chơi" 
                             class="w-full h-full object-contain">
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-headline text-xs sm:text-sm font-extrabold text-slate-900 group-hover:text-[#ff5e00] transition-colors truncate">
                            Cùng Chơi
                        </h4>
                        <p class="font-body text-[11px] text-slate-500 truncate">
                            Media &amp; Giải trí
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 8: CALL TO ACTION BANNER (SẴN SÀNG TƯ VẤN GIẢI PHÁP TRUYỀN THÔNG)
         ======================================================== -->
    <section class="relative w-full overflow-hidden text-white" id="profile-cta" style="background-color: #fafbfc;">
        <!-- SVG Curved Wave Transition at Top -->
        <div class="w-full overflow-hidden leading-none -mb-1">
            <svg class="w-full h-12 sm:h-18 lg:h-22 block" viewBox="0 0 1440 80" fill="none" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="profileCtaWave" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff5e00"/>
                        <stop offset="50%" stop-color="#ff6814"/>
                        <stop offset="100%" stop-color="#ff7a29"/>
                    </linearGradient>
                </defs>
                <path d="M0,38 C300,82 620,86 940,46 C1160,18 1320,12 1440,32 L1440,80 L0,80 Z" fill="url(#profileCtaWave)"></path>
            </svg>
        </div>

        <!-- Main Banner Background with Vibrant Gradient -->
        <div class="w-full py-12 lg:py-16 relative" style="background: linear-gradient(135deg, #ff5e00 0%, #ff6814 50%, #ff7a29 100%); background-color: #ff5e00;">
            <!-- Ambient glows -->
            <div class="pointer-events-none absolute left-10 top-0 w-72 h-72 rounded-full bg-white/10 blur-2xl"></div>
            <div class="pointer-events-none absolute right-10 bottom-0 w-96 h-96 rounded-full bg-amber-300/25 blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    
                    <!-- Left 7 Cols: Thông điệp & Nút CTA -->
                    <div class="lg:col-span-7 text-left">
                        <!-- Translucent Badge -->
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full font-headline text-xs font-bold uppercase tracking-wider mb-3.5"
                             style="background: rgba(255, 255, 255, 0.22); border: 1px solid rgba(255, 255, 255, 0.45); color: #ffffff;">
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>SẴN SÀNG TƯ VẤN GIẢI PHÁP TRUYỀN THÔNG</span>
                        </div>

                        <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight"
                            style="color: #ffffff !important; text-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);">
                            Bạn Đang Có Nhu Cầu Về Truyền Thông,<br class="hidden sm:inline">
                            Marketing Hay Công Nghệ?
                        </h2>

                        <p class="font-body text-xs sm:text-sm leading-relaxed max-w-xl mt-3 mb-7"
                           style="color: rgba(255, 255, 255, 0.95) !important;">
                            Hãy để Truyền Thông Cửu Long trở thành đối tác chiến lược, đồng hành cùng bạn trên hành trình phát triển thương hiệu.
                        </p>

                        <!-- Button Liên hệ ngay -->
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center gap-2.5 px-8 py-3.5 rounded-full font-headline text-xs sm:text-sm font-extrabold transition-all hover:scale-105 active:scale-95 shadow-lg group cursor-pointer"
                           style="background: #ffffff !important; color: #ff5e00 !important; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;">
                            <span style="color: #ff5e00 !important;">Liên hệ ngay</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color: #ff5e00 !important;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Right 5 Cols: Bàn làm việc & Laptop với chữ decor nghệ thuật -->
                    <div class="lg:col-span-5 relative flex items-center justify-center lg:justify-end">
                        <div class="relative w-full max-w-sm rounded-2xl overflow-hidden"
                             style="border: 2.5px solid rgba(255, 255, 255, 0.45) !important; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important; background: rgba(255, 255, 255, 0.1) !important;">
                            @php
                                $ctaDeskPath = 'images/careers/cta_careers_desk.png';
                                $hasCtaDesk = file_exists(public_path($ctaDeskPath));
                                $ctaDeskUrl = $hasCtaDesk ? asset($ctaDeskPath) . '?v=' . filemtime(public_path($ctaDeskPath)) : asset('images/real-cameraman-production.jpg');
                            @endphp
                            <img src="{{ $ctaDeskUrl }}" 
                                 alt="Cùng nhau kiến tạo những điều tuyệt vời" 
                                 class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500"
                                 loading="lazy">

                            <!-- Decor badge overlay: Cùng nhau kiến tạo những điều tuyệt vời! -->
                            <div class="absolute bottom-3 right-3 px-3 py-1.5 rounded-xl text-right"
                                 style="background: rgba(0, 0, 0, 0.68) !important; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.28) !important;">
                                <p class="font-headline text-[11px] font-extrabold italic tracking-wide" style="color: #fde047 !important;">
                                    Cùng nhau kiến tạo<br>những điều tuyệt vời!
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>

<!-- Schema JSON-LD cho E-Profile Doanh Nghiệp -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "Hồ Sơ Năng Lực - Công Ty TNHH Truyền Thông Cửu Long",
  "description": "Tổ hợp giải pháp truyền thông sáng tạo, sản xuất phim doanh nghiệp, marketing và công nghệ số hàng đầu tại Cần Thơ & ĐBSCL.",
  "publisher": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo-ttcl.png') }}"
  }
}
</script>
@endsection