@extends('layouts.app')

@section('title', 'Về Chúng Tôi - Truyền Thông Cửu Long | Đồng Hành Cùng Doanh Nghiệp Việt')
@section('meta_description', 'Truyền Thông Cửu Long là đội ngũ sáng tạo, công nghệ và truyền thông, mang đến các giải pháp toàn diện giúp doanh nghiệp xây dựng thương hiệu, chuyển đổi số và tạo ra giá trị bền vững.')
@section('body-class', 'page-about')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&display=swap');

    .font-caveat {
        font-family: 'Caveat', cursive, sans-serif;
    }

    .about-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 9999px;
        background-color: #fff7ed;
        border: 1px solid #ffedd5;
        color: #ff5400;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        width: fit-content;
        box-shadow: 0 1px 3px rgba(255, 84, 0, 0.05);
    }

    .about-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 9999px;
        background-color: #ff5400;
        display: inline-block;
    }

    .text-orange-gradient {
        color: #ff5400;
        background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ==========================================================
       SECTION 3: KIM CHỈ NAM CHO MỌI HÀNH ĐỘNG
       ========================================================== */
    .pillar-card {
        position: relative;
        border-radius: 24px;
        background: #ffffff !important;
        padding: 30px 26px;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
    }
    .pillar-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -10px rgba(255, 84, 0, 0.16);
        border-color: #fdba74 !important;
    }
    .pillar-card-watermark {
        position: absolute;
        top: 14px;
        right: 18px;
        font-size: 56px;
        font-weight: 900;
        line-height: 1;
        color: rgba(255, 84, 0, 0.15) !important;
        user-select: none;
        pointer-events: none;
        transition: all 0.3s ease;
    }
    .pillar-card:hover .pillar-card-watermark {
        color: rgba(255, 84, 0, 0.3) !important;
        transform: scale(1.08);
    }
    .pillar-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: #fff4ed !important;
        border: 1px solid #ffedd5 !important;
        color: #ff5400 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .pillar-card:hover .pillar-icon-box {
        background: #ff5400 !important;
        color: #ffffff !important;
        transform: scale(1.08);
    }
    .pillar-pill-tag {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 4px 12px;
        border-radius: 9999px;
        background: #fff4ed !important;
        color: #ff5400 !important;
        border: 1px solid #ffd8c2 !important;
    }
    .pillar-card-featured {
        background: #fffcf9 !important;
        border: 2px solid #ff7a29 !important;
        box-shadow: 0 10px 30px -5px rgba(255, 84, 0, 0.14) !important;
    }
    .pillar-card-featured .pillar-icon-box {
        background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35) !important;
    }
    .pillar-pill-tag-featured {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 4px 12px;
        border-radius: 9999px;
        background: #ff5400 !important;
        color: #ffffff !important;
        border: 1px solid #ea580c !important;
        box-shadow: 0 2px 8px rgba(255, 84, 0, 0.3) !important;
    }

    /* ==========================================================
       SECTION 4: HÀNH TRÌNH TRONG NHỮNG CON SỐ (DARK BENTO SHOWCASE)
       ========================================================== */
    .stats-bento-container {
        position: relative;
        border-radius: 32px;
        background: linear-gradient(145deg, #070f1e 0%, #0d1e38 50%, #060c18 100%) !important;
        color: #ffffff !important;
        padding: 36px 24px;
        border: 1px solid #1e293b !important;
        box-shadow: 0 25px 60px -15px rgba(7, 15, 30, 0.6) !important;
        overflow: hidden;
    }
    @media (min-width: 640px) {
        .stats-bento-container { padding: 48px 36px; }
    }
    @media (min-width: 1024px) {
        .stats-bento-container { padding: 56px 48px; }
    }
    .stats-ambient-glow-1 {
        position: absolute;
        top: -80px;
        right: -80px;
        width: 380px;
        height: 380px;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(255, 84, 0, 0.28) 0%, transparent 70%);
        pointer-events: none;
    }
    .stats-ambient-glow-2 {
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 380px;
        height: 380px;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.22) 0%, transparent 70%);
        pointer-events: none;
    }
    .stats-script-badge {
        font-family: 'Caveat', cursive, sans-serif;
        font-size: 24px;
        color: #ff944d !important;
        font-weight: 700;
        background: rgba(255, 84, 0, 0.12) !important;
        border: 1px solid rgba(255, 84, 0, 0.3) !important;
        padding: 10px 22px;
        border-radius: 18px;
        backdrop-filter: blur(8px);
        display: inline-flex;
        align-items: center;
    }
    .stat-card-glass {
        position: relative;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 24px 22px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .stat-card-glass:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.09) !important;
        border-color: rgba(255, 84, 0, 0.5) !important;
        box-shadow: 0 16px 36px -8px rgba(255, 84, 0, 0.28);
    }
    .stat-number-glow {
        font-size: clamp(38px, 3.8vw, 54px);
        font-weight: 900;
        line-height: 1;
        letter-spacing: -0.03em;
        color: #ff6b1a !important;
        text-shadow: 0 0 24px rgba(255, 107, 26, 0.38);
        margin-bottom: 8px;
    }
    .stat-icon-wrapper {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: rgba(255, 84, 0, 0.15) !important;
        border: 1px solid rgba(255, 84, 0, 0.32) !important;
        color: #ff944d !important;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }
    .stat-card-glass:hover .stat-icon-wrapper {
        transform: scale(1.1);
        background: #ff5400 !important;
        color: #ffffff !important;
    }
    .stat-tag-badge {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #fdba74 !important;
        background: rgba(255, 255, 255, 0.07) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        padding: 3px 9px;
        border-radius: 6px;
    }
    .stat-title-text {
        font-size: 16px;
        font-weight: 800;
        color: #ffffff !important;
        margin-bottom: 4px;
        line-height: 1.35;
    }
    .stat-desc-text {
        font-size: 13px;
        font-weight: 400;
        color: #94a3b8 !important;
        line-height: 1.5;
    }

    /* ==========================================================
       SECTION 6: QUÁ TRÌNH PHÁT TRIỂN (PREMIUM MILESTONE ROADMAP)
       ========================================================== */
    .timeline-card {
        position: relative;
        border-radius: 26px;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        padding: 32px 26px 28px;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
    }
    .timeline-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 22px 42px -10px rgba(255, 84, 0, 0.16);
        border-color: #fdba74 !important;
    }
    .timeline-card-watermark {
        position: absolute;
        bottom: 8px;
        right: 14px;
        font-size: 64px;
        font-weight: 900;
        line-height: 1;
        color: rgba(255, 84, 0, 0.07) !important;
        user-select: none;
        pointer-events: none;
        transition: all 0.3s ease;
        font-family: var(--font-heading, sans-serif);
    }
    .timeline-card:hover .timeline-card-watermark {
        color: rgba(255, 84, 0, 0.16) !important;
        transform: scale(1.08);
    }
    .timeline-node-beacon {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #fff4ed !important;
        border: 2px solid #ffedd5 !important;
        color: #ff5400 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 14px rgba(255, 84, 0, 0.14);
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    .timeline-card:hover .timeline-node-beacon {
        background: linear-gradient(135deg, #ff5400 0%, #ff7a29 100%) !important;
        color: #ffffff !important;
        border-color: #ff5400 !important;
        transform: scale(1.12);
        box-shadow: 0 8px 22px rgba(255, 84, 0, 0.35);
    }
    .timeline-year-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 9999px;
        background: #fff7ed !important;
        border: 1px solid #ffd8c2 !important;
        color: #ea580c !important;
        font-size: 13px;
        font-weight: 900;
        letter-spacing: 0.02em;
    }
    .timeline-phase-tag {
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #ff5400 !important;
        background: rgba(255, 84, 0, 0.08);
        padding: 3px 8px;
        border-radius: 6px;
    }
    /* Highlight Card: 2025 (Tương Lai) */
    .timeline-card-highlight {
        background: linear-gradient(180deg, #fffdfb 0%, #ffffff 100%) !important;
        border: 2px solid #ff7a29 !important;
        box-shadow: 0 12px 36px -6px rgba(255, 84, 0, 0.16) !important;
    }
    .timeline-card-highlight .timeline-node-beacon {
        background: linear-gradient(135deg, #ff5400 0%, #ff7a29 100%) !important;
        color: #ffffff !important;
        border-color: #ff5400 !important;
        box-shadow: 0 6px 18px rgba(255, 84, 0, 0.35);
    }
    .timeline-card-highlight .timeline-year-badge {
        background: #ff5400 !important;
        color: #ffffff !important;
        border-color: #ea580c !important;
        box-shadow: 0 2px 8px rgba(255, 84, 0, 0.3);
    }
    .timeline-track-glow {
        position: absolute;
        top: 23px;
        left: 12%;
        right: 12%;
        height: 3px;
        background: linear-gradient(90deg, #ffd8c2 0%, #ff7a29 50%, #ff5400 100%);
        border-radius: 9999px;
        z-index: 0;
        opacity: 0.7;
    }

    /* Hero Banner Text Overlay (Exact match to reference mockup) */
    .hero-banner-wrap {
        position: relative;
        width: 100%;
        user-select: none;
    }
    .hero-banner-img {
        width: 100%;
        height: auto;
        display: block;
        user-select: none;
        pointer-events: none;
    }
    .hero-banner-gradient-mask {
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(90deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.1) 32%, transparent 48%);
    }
    .hero-banner-content-box {
        position: absolute;
        inset: 0;
        z-index: 10;
        display: flex;
        align-items: center;
    }
    .hero-banner-inner {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding-left: 2.5rem;
        padding-right: 2.5rem;
    }
    @media (min-width: 1400px) {
        .hero-banner-inner {
            padding-left: 3.5rem;
            padding-right: 3.5rem;
        }
    }
    .hero-banner-text-col {
        max-width: 540px;
    }
    .hero-banner-heading {
        font-size: 32px;
        line-height: 1.18;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin: 0 0 14px 0;
        text-shadow: 0 1px 3px rgba(255, 255, 255, 0.9);
    }
    @media (min-width: 1280px) {
        .hero-banner-heading {
            font-size: 35px;
        }
    }
    .hero-banner-heading .h-dark {
        color: #0b1727;
        display: block;
    }
    .hero-banner-heading .h-orange {
        color: #ff5400;
        display: block;
    }
    .hero-banner-paragraph {
        color: #1e293b;
        font-size: 13.5px;
        line-height: 1.65;
        margin: 0 0 20px 0;
        max-width: 500px;
        font-weight: 500;
        text-shadow: 0 1px 2px rgba(255, 255, 255, 0.9);
    }
    .hero-badges-row {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 16px;
        flex-wrap: nowrap;
    }
    .hero-badge-item {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
    .hero-badge-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(180deg, #ff8c37 0%, #ff5400 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        flex-shrink: 0;
        box-shadow: 0 3px 8px rgba(255, 84, 0, 0.3);
    }
    .hero-badge-labels {
        display: flex;
        flex-direction: column;
        justify-content: center;
        line-height: 1.25;
        font-size: 11.5px;
        font-weight: 700;
        color: #0b1727;
        white-space: nowrap;
        text-shadow: 0 1px 2px rgba(255, 255, 255, 0.9);
    }
    .hero-badge-labels span {
        display: block;
    }

    /* Mobile / Tablet Styles */
    @media (max-width: 1023px) {
        .hero-banner-mobile-box {
            padding: 24px 16px 28px 16px;
            background: #fafaf9;
            border-top: 1px solid #f1f5f9;
        }
        .hero-banner-heading-mobile {
            font-size: 24px;
            line-height: 1.2;
            font-weight: 800;
            margin: 0 0 12px 0;
        }
        .hero-banner-heading-mobile .h-dark {
            color: #0b1727;
            display: block;
        }
        .hero-banner-heading-mobile .h-orange {
            color: #ff5400;
            display: block;
        }
        .hero-banner-paragraph-mobile {
            color: #475569;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 18px 0;
        }
        .hero-badges-grid-mobile {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    /* Section 3 Value Cards */
    .value-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        padding: 26px 22px;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .value-card:hover {
        transform: translateY(-5px);
        border-color: rgba(255, 84, 0, 0.3);
        box-shadow: 0 16px 32px -6px rgba(15, 23, 42, 0.08);
    }
    .value-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 9999px;
        background-color: #fff4ed;
        color: #ff5400;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        border: 1px solid #ffedd5;
    }

    /* Section 4 Stat items */
    .stat-col {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 12px 18px;
    }
    @media (min-width: 768px) {
        .stat-col:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 1px;
            background: #f1f5f9;
        }
    }

    /* Section 6 Milestone timeline */
    .timeline-track-line {
        position: absolute;
        top: 20px;
        left: 5%;
        right: 5%;
        height: 2px;
        background: #f1f5f9;
        z-index: 1;
    }
    .timeline-node-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 9999px;
        background: #fff7ed;
        border: 1.5px solid #ffedd5;
        color: #ff5400;
        font-size: 13px;
        font-weight: 800;
        position: relative;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(255, 84, 0, 0.08);
        transition: all 0.25s ease;
    }
    .timeline-node-pill:hover {
        border-color: #ff5400;
        background: #ffffff;
        transform: scale(1.05);
    }

    /* CTA Banner (Section 7 - Cùng Chúng Tôi Tạo Nên Những Giá Trị Thật!) */
    .about-cta-section {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #fffdfa 45%, #fff7f0 100%);
        border-top: 1px solid rgba(255, 84, 0, 0.08);
        border-bottom: 1px solid rgba(255, 84, 0, 0.08);
    }
    .about-cta-pill-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 32px;
        border-radius: 9999px;
        background: linear-gradient(135deg, #ff5400 0%, #ea580c 100%);
        color: #ffffff !important;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 8px 24px rgba(255, 84, 0, 0.38);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        border: none;
        cursor: pointer;
        width: fit-content;
    }
    .about-cta-pill-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(255, 84, 0, 0.48);
        color: #ffffff !important;
        background: linear-gradient(135deg, #ff661a 0%, #f95738 100%);
    }
    .about-cta-pill-btn:active {
        transform: translateY(0);
    }

    /* Primary Orange Action Buttons */
    .btn-orange-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: 9999px;
        background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%);
        color: #ffffff !important;
        font-size: 13.5px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(255, 84, 0, 0.3);
        transition: all 0.25s ease;
        border: none;
        cursor: pointer;
        width: fit-content;
    }
    .btn-orange-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 84, 0, 0.4);
    }
</style>
@endpush

@section('content')
<div class="w-full bg-[#fdfefe] text-slate-800">

    <!-- ========================================================
         SECTION 1: HERO BANNER (WIDESCREEN VỚI TEXT OVERLAY BẰNG CODE)
         ======================================================== -->
    <section class="relative w-full overflow-hidden border-b border-slate-100 bg-[#fbfdfe]">
        
        <!-- ==================== DESKTOP (LG+): WIDESCREEN BANNER VỚI TEXT OVERLAY ==================== -->
        <div class="hidden lg:block hero-banner-wrap">
            
            <!-- Banner Background Image (1024 x 376) -->
            <img src="{{ asset('images/about/banner_ve_chung_toi.png') }}?v={{ file_exists(public_path('images/about/banner_ve_chung_toi.png')) ? filemtime(public_path('images/about/banner_ve_chung_toi.png')) : time() }}" 
                 alt="Truyền Thông Cửu Long - Đồng Hành Cùng Doanh Nghiệp Việt" 
                 class="hero-banner-img"
                 loading="eager"
                 fetchpriority="high"
                 width="1024"
                 height="376">

            <!-- Soft white gradient overlay on the left to seamlessly ensure maximum text contrast -->
            <div class="hero-banner-gradient-mask"></div>

            <!-- Content Overlay strictly fitted on the left half -->
            <div class="hero-banner-content-box">
                <div class="hero-banner-inner">
                    <div class="hero-banner-text-col">
                        
                        <!-- Main Heading -->
                        <h1 class="hero-banner-heading">
                            <span class="h-dark">Truyền Thông Cửu Long</span>
                            <span class="h-orange">Đồng Hành Cùng</span>
                            <span class="h-orange">Doanh Nghiệp Việt</span>
                        </h1>

                        <!-- Description -->
                        <p class="hero-banner-paragraph">
                            Chúng tôi là đội ngũ sáng tạo, công nghệ và truyền thông, mang đến các giải pháp toàn diện giúp doanh nghiệp xây dựng thương hiệu, chuyển đổi số và tạo ra giá trị bền vững.
                        </p>

                        <!-- 4 Mini Feature Badges Row -->
                        <div class="hero-badges-row">
                            
                            <!-- 1. Sáng tạo khác biệt -->
                            <div class="hero-badge-item">
                                <div class="hero-badge-icon">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm-1 18h2v1h-2v-1zm-2-2h6v1H9v-1z"/></svg>
                                </div>
                                <div class="hero-badge-labels">
                                    <span>Sáng tạo</span>
                                    <span>khác biệt</span>
                                </div>
                            </div>

                            <!-- 2. Công nghệ hiện đại -->
                            <div class="hero-badge-item">
                                <div class="hero-badge-icon">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3zm0 4a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6z"/></svg>
                                </div>
                                <div class="hero-badge-labels">
                                    <span>Công nghệ</span>
                                    <span>hiện đại</span>
                                </div>
                            </div>

                            <!-- 3. Đội ngũ chuyên nghiệp -->
                            <div class="hero-badge-item">
                                <div class="hero-badge-icon">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                </div>
                                <div class="hero-badge-labels">
                                    <span>Đội ngũ</span>
                                    <span>chuyên nghiệp</span>
                                </div>
                            </div>

                            <!-- 4. Cam kết hiệu quả -->
                            <div class="hero-badge-item">
                                <div class="hero-badge-icon">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                </div>
                                <div class="hero-badge-labels">
                                    <span>Cam kết</span>
                                    <span>hiệu quả</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- ==================== MOBILE & TABLET (<LG): BANNER + CLEAN CONTENT BELOW ==================== -->
        <div class="block lg:hidden">
            <div class="w-full bg-[#f8fafc]">
                <img src="{{ asset('images/about/banner_ve_chung_toi.png') }}?v={{ file_exists(public_path('images/about/banner_ve_chung_toi.png')) ? filemtime(public_path('images/about/banner_ve_chung_toi.png')) : time() }}" 
                     alt="Truyền Thông Cửu Long - Đồng Hành Cùng Doanh Nghiệp Việt" 
                     class="w-full h-auto block select-none pointer-events-none"
                     loading="eager"
                     fetchpriority="high"
                     width="1024"
                     height="376">
            </div>

            <div class="hero-banner-mobile-box">
                <h1 class="hero-banner-heading-mobile">
                    <span class="h-dark">Truyền Thông Cửu Long</span>
                    <span class="h-orange">Đồng Hành Cùng</span>
                    <span class="h-orange">Doanh Nghiệp Việt</span>
                </h1>

                <p class="hero-banner-paragraph-mobile">
                    Chúng tôi là đội ngũ sáng tạo, công nghệ và truyền thông, mang đến các giải pháp toàn diện giúp doanh nghiệp xây dựng thương hiệu, chuyển đổi số và tạo ra giá trị bền vững.
                </p>

                <div class="hero-badges-grid-mobile">
                    <div class="hero-badge-item">
                        <div class="hero-badge-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm-1 18h2v1h-2v-1zm-2-2h6v1H9v-1z"/></svg>
                        </div>
                        <div class="hero-badge-labels">
                            <span>Sáng tạo</span>
                            <span>khác biệt</span>
                        </div>
                    </div>

                    <div class="hero-badge-item">
                        <div class="hero-badge-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3zm0 4a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6z"/></svg>
                        </div>
                        <div class="hero-badge-labels">
                            <span>Công nghệ</span>
                            <span>hiện đại</span>
                        </div>
                    </div>

                    <div class="hero-badge-item">
                        <div class="hero-badge-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        </div>
                        <div class="hero-badge-labels">
                            <span>Đội ngũ</span>
                            <span>chuyên nghiệp</span>
                        </div>
                    </div>

                    <div class="hero-badge-item">
                        <div class="hero-badge-icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        </div>
                        <div class="hero-badge-labels">
                            <span>Cam kết</span>
                            <span>hiệu quả</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>


    <!-- ========================================================
         SECTION 2: GIỚI THIỆU – CHÚNG TÔI LÀ AI? (1 BÊN TEXT, 1 BÊN HÌNH)
         ======================================================== -->
    <section class="relative w-full overflow-hidden bg-gradient-to-br from-[#ffffff] via-[#fffdfa] to-[#fff7f0] border-b border-orange-100/50 py-12 sm:py-16 lg:py-20">
        
        <!-- Subtle Ambient Warm Glow on Top Right -->
        <div class="absolute -top-24 right-0 w-[450px] sm:w-[550px] h-[450px] sm:h-[550px] bg-gradient-to-br from-orange-200/35 via-amber-100/15 to-transparent rounded-full blur-3xl pointer-events-none z-0" aria-hidden="true"></div>

        <!-- 1. Top-Left Corner Leaves Decor (User High-Res Asset) -->
        <img src="{{ asset('images/about/decor_leaves_top_left.png') }}?v={{ file_exists(public_path('images/about/decor_leaves_top_left.png')) ? filemtime(public_path('images/about/decor_leaves_top_left.png')) : time() }}" 
             alt="" 
             class="absolute top-0 left-0 w-28 sm:w-36 md:w-48 lg:w-60 xl:w-72 h-auto pointer-events-none select-none z-10"
             aria-hidden="true">

        <!-- 2. Bottom-Left Corner Orange Wave Decor (User High-Res Asset) -->
        <img src="{{ asset('images/about/decor_wave_bottom_left.png') }}?v={{ file_exists(public_path('images/about/decor_wave_bottom_left.png')) ? filemtime(public_path('images/about/decor_wave_bottom_left.png')) : time() }}" 
             alt="" 
             class="absolute bottom-0 left-0 w-48 sm:w-64 md:w-80 lg:w-[420px] xl:w-[500px] h-auto pointer-events-none select-none z-10"
             aria-hidden="true">

        <!-- 3. Bottom-Right Corner Leaves Decor (User High-Res Asset) -->
        <img src="{{ asset('images/about/decor_leaves_bottom_right.png') }}?v={{ file_exists(public_path('images/about/decor_leaves_bottom_right.png')) ? filemtime(public_path('images/about/decor_leaves_bottom_right.png')) : time() }}" 
             alt="" 
             class="absolute bottom-0 right-0 w-44 sm:w-60 md:w-72 lg:w-96 xl:w-[440px] h-auto pointer-events-none select-none z-20"
             aria-hidden="true">

        <!-- Main Content Grid: 1 Bên Text, 1 Bên Hình -->
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 xl:gap-10 items-center">
                
                <!-- CỘT TRÁI: TEXT BẰNG CODE HTML/CSS -->
                <div class="lg:col-span-5 space-y-4 sm:space-y-5">
                    
                    <!-- Badge GIỚI THIỆU -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#fff5ee] border border-orange-200/80 text-[#ff5400] text-xs font-black tracking-wider uppercase shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                        <span>GIỚI THIỆU</span>
                    </div>

                    <!-- Heading -->
                    <h2 class="text-3xl sm:text-4xl lg:text-[42px] xl:text-[46px] font-black text-slate-900 tracking-tight leading-[1.14]">
                        Chúng Tôi <span class="text-[#ff5400]">Là Ai?</span>
                    </h2>

                    <!-- Paragraph 1 -->
                    <p class="text-sm sm:text-[14.5px] lg:text-[15px] text-slate-600 leading-relaxed font-normal">
                        Truyền Thông Cửu Long là đơn vị chuyên cung cấp các giải pháp truyền thông, công nghệ và sáng tạo nội dung, đồng hành cùng các doanh nghiệp, tổ chức và cá nhân trong hành trình xây dựng thương hiệu và phát triển bền vững.
                    </p>

                    <!-- Paragraph 2 -->
                    <p class="text-sm sm:text-[14.5px] lg:text-[15px] text-slate-600 leading-relaxed font-normal">
                        Với kinh nghiệm thực tế, tư duy sáng tạo và tinh thần trách nhiệm, chúng tôi không chỉ tạo ra sản phẩm, mà còn mang đến những giá trị thật cho khách hàng.
                    </p>

                    <!-- Button Tìm hiểu thêm về chúng tôi -->
                    <div class="pt-2">
                        <a href="{{ route('services.index') }}" class="group inline-flex items-center gap-2.5 px-6 sm:px-7 py-3 rounded-full bg-gradient-to-r from-[#ff5400] to-[#f95738] hover:from-[#f95738] hover:to-[#ea580c] text-white text-sm sm:text-[15px] font-bold shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                            <span>Tìm hiểu thêm về chúng tôi</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>

                </div>

                <!-- CỘT PHẢI: 4. HÌNH ẢNH MONTAGE BÊN PHẢI (User High-Res Asset) -->
                <div class="lg:col-span-7 relative flex items-center justify-center lg:justify-end">
                    <img src="{{ asset('images/about/about_intro_visual.png') }}?v={{ file_exists(public_path('images/about/about_intro_visual.png')) ? filemtime(public_path('images/about/about_intro_visual.png')) : time() }}" 
                         alt="Không gian sáng tạo và đội ngũ Truyền Thông Cửu Long" 
                         class="w-full max-w-2xl xl:max-w-3xl h-auto object-contain block select-none drop-shadow-sm hover:scale-[1.01] transition-transform duration-500"
                         loading="lazy"
                         width="1665"
                         height="944">
                </div>

            </div>
        </div>

    </section>


    <!-- ========================================================
         SECTION 3: SỨ MỆNH - TẦM NHÌN - GIÁ TRỊ CỐT LÕI
         ======================================================== -->
    <section class="py-16 sm:py-20 lg:py-28 bg-gradient-to-b from-[#fffcf8] via-[#ffffff] to-[#fffcf8] border-b border-orange-100/50 relative overflow-hidden" id="kim-chi-nam">
        
        <!-- Subtle Ambient Background Glows -->
        <div class="absolute top-1/4 left-0 w-96 h-96 bg-orange-100/30 rounded-full blur-3xl pointer-events-none -z-0"></div>
        <div class="absolute bottom-1/4 right-0 w-96 h-96 bg-amber-100/30 rounded-full blur-3xl pointer-events-none -z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-14 sm:mb-20 space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#fff4ed] border border-orange-200/80 text-[#ff5400] text-xs font-black tracking-widest uppercase shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-[#ff5400] shadow-[0_0_8px_rgba(255,84,0,0.6)] animate-pulse"></span>
                    <span>SỨ MỆNH – TẦM NHÌN – GIÁ TRỊ CỐT LÕI</span>
                </div>

                <h2 class="text-3xl sm:text-4xl lg:text-[44px] font-black text-slate-900 tracking-tight leading-[1.18]">
                    Kim Chỉ Nam <span style="color: #ff5400 !important;">Cho Mọi Hành Động</span>
                </h2>

                <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-normal" style="color: #475569 !important;">
                    Tư tưởng cốt lõi định hình văn hóa doanh nghiệp, chuẩn mực chất lượng và kim chỉ nam định hướng cho từng bước phát triển của Truyền Thông Cửu Long.
                </p>
            </div>

            <!-- 4 Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-7">
                
                <!-- 1. Sứ Mệnh -->
                <div class="pillar-card group">
                    <span class="pillar-card-watermark">01</span>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="pillar-icon-box">
                                <span class="material-symbols-outlined text-[28px]">track_changes</span>
                            </div>
                            <span class="pillar-pill-tag">
                                Mục Tiêu
                            </span>
                        </div>
                        <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                            Sứ Mệnh
                        </h3>
                        <p class="text-sm leading-relaxed font-normal mb-6" style="color: #475569 !important;">
                            Mang đến các giải pháp truyền thông, công nghệ và sáng tạo nội dung chất lượng cao, đồng hành giúp doanh nghiệp nâng tầm thương hiệu và tối ưu hiệu quả kinh doanh.
                        </p>
                    </div>
                    <div class="relative z-10 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold" style="color: #64748b;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                        <span>Kiến tạo giá trị thực tế</span>
                    </div>
                </div>

                <!-- 2. Tầm Nhìn -->
                <div class="pillar-card group">
                    <span class="pillar-card-watermark">02</span>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="pillar-icon-box">
                                <span class="material-symbols-outlined text-[28px]">visibility</span>
                            </div>
                            <span class="pillar-pill-tag">
                                Tiên Phong
                            </span>
                        </div>
                        <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                            Tầm Nhìn
                        </h3>
                        <p class="text-sm leading-relaxed font-normal mb-6" style="color: #475569 !important;">
                            Trở thành đơn vị hàng đầu khu vực ĐBSCL và vươn tầm toàn quốc về truyền thông, công nghệ và sáng tạo nội dung, được khách hàng tin tưởng lựa chọn lâu dài.
                        </p>
                    </div>
                    <div class="relative z-10 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold" style="color: #64748b;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                        <span>Vươn tầm vị thế dẫn đầu</span>
                    </div>
                </div>

                <!-- 3. Giá Trị Cốt Lõi (Featured Spotlight Card) -->
                <div class="pillar-card pillar-card-featured group">
                    <span class="pillar-card-watermark" style="color: rgba(255, 84, 0, 0.22) !important;">03</span>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="pillar-icon-box">
                                <span class="material-symbols-outlined text-[28px]">diamond</span>
                            </div>
                            <span class="pillar-pill-tag-featured">
                                Trọng Tâm
                            </span>
                        </div>
                        <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                            Giá Trị Cốt Lõi
                        </h3>
                        <ul class="space-y-2.5 text-xs sm:text-[13px] font-medium mb-6" style="color: #334155 !important;">
                            <li class="flex items-center gap-2.5">
                                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[11px] shrink-0" style="background: #ffedd5; color: #ff5400; font-weight: 800;">✓</span>
                                <span><strong style="color: #0f172a; font-weight: 800;">Chất lượng</strong> là nền tảng</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[11px] shrink-0" style="background: #ffedd5; color: #ff5400; font-weight: 800;">✓</span>
                                <span><strong style="color: #0f172a; font-weight: 800;">Sáng tạo</strong> là động lực</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[11px] shrink-0" style="background: #ffedd5; color: #ff5400; font-weight: 800;">✓</span>
                                <span><strong style="color: #0f172a; font-weight: 800;">Khách hàng</strong> là trung tâm</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[11px] shrink-0" style="background: #ffedd5; color: #ff5400; font-weight: 800;">✓</span>
                                <span><strong style="color: #0f172a; font-weight: 800;">Bền vững</strong> là mục tiêu</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative z-10 pt-4 border-t border-orange-200/70 flex items-center gap-2 text-xs font-bold" style="color: #ea580c !important;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                        <span>4 Trụ cột văn hóa Cửu Long</span>
                    </div>
                </div>

                <!-- 4. Cam Kết -->
                <div class="pillar-card group">
                    <span class="pillar-card-watermark">04</span>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="pillar-icon-box">
                                <span class="material-symbols-outlined text-[28px]">handshake</span>
                            </div>
                            <span class="pillar-pill-tag">
                                Uy Tín
                            </span>
                        </div>
                        <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                            Cam Kết Vàng
                        </h3>
                        <p class="text-sm leading-relaxed font-normal mb-6" style="color: #475569 !important;">
                            Đồng hành lâu dài, tận tâm phụng sự, mang lại giải pháp hiệu quả thiết thực và đo lường được kết quả cụ thể cho từng khách hàng, đối tác.
                        </p>
                    </div>
                    <div class="relative z-10 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold" style="color: #64748b;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                        <span>Đồng hành trọn vòng đời dự án</span>
                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- ========================================================
         SECTION 4: CON SỐ NỔI BẬT – HÀNH TRÌNH TRONG NHỮNG CON SỐ
         ======================================================== -->
    <section class="py-16 sm:py-20 lg:py-28 bg-[#ffffff] border-b border-slate-100 relative overflow-hidden">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dark Premium Bento Card Showcase -->
            <div class="stats-bento-container">
                
                <!-- Glowing Ambient Lights -->
                <div class="stats-ambient-glow-1"></div>
                <div class="stats-ambient-glow-2"></div>

                <!-- Showcase Header Row -->
                <div class="relative z-10 mb-10 sm:mb-14">
                    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-8 border-b border-white/10">
                        <div class="space-y-3 max-w-2xl">
                            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full" style="background: rgba(255, 84, 0, 0.15); border: 1px solid rgba(255, 84, 0, 0.35); color: #fb923c; font-size: 11px; font-weight: 800; letter-spacing: 0.08em; text-transform: uppercase;">
                                <span class="w-2 h-2 rounded-full animate-ping" style="background: #fb923c; box-shadow: 0 0 8px rgba(251,146,60,0.8);"></span>
                                <span>CON SỐ NỔI BẬT</span>
                            </div>

                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-[1.15]" style="color: #ffffff !important;">
                                Hành Trình Trong <span style="color: #ff7a29 !important;">Những Con Số</span>
                            </h2>
                            
                            <p class="text-sm sm:text-base font-normal leading-relaxed" style="color: #cbd5e1 !important;">
                                Những cột mốc tự hào khẳng định năng lực thực chiến, sự tận tâm và tín nhiệm bền bỉ của hàng trăm doanh nghiệp, đối tác.
                            </p>
                        </div>
                        
                        <!-- Handwritten script accent with glowing badge -->
                        <div class="shrink-0 flex items-center">
                            <div class="stats-script-badge">
                                ✨ Cùng nhau kiến tạo những giá trị bền vững!
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4 Stats Bento Columns Grid -->
                <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
                    
                    <!-- Stat 1: 300+ -->
                    <div class="stat-card-glass group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="stat-icon-wrapper">
                                <span class="material-symbols-outlined text-[24px]">rocket_launch</span>
                            </div>
                            <span class="stat-tag-badge">
                                Dự án
                            </span>
                        </div>
                        <div class="stat-number-glow counter-value" data-target="300" data-suffix="+">
                            300+
                        </div>
                        <div class="stat-title-text">
                            Dự án đã thực hiện
                        </div>
                        <div class="stat-desc-text">
                            Đa dạng quy mô từ doanh nghiệp SME đến tập đoàn lớn
                        </div>
                    </div>

                    <!-- Stat 2: 50+ -->
                    <div class="stat-card-glass group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="stat-icon-wrapper">
                                <span class="material-symbols-outlined text-[24px]">handshake</span>
                            </div>
                            <span class="stat-tag-badge">
                                Tín nhiệm
                            </span>
                        </div>
                        <div class="stat-number-glow counter-value" data-target="50" data-suffix="+">
                            50+
                        </div>
                        <div class="stat-title-text">
                            Khách hàng tin tưởng
                        </div>
                        <div class="stat-desc-text">
                            Đối tác chiến lược đồng hành trên khắp cả nước
                        </div>
                    </div>

                    <!-- Stat 3: 5+ -->
                    <div class="stat-card-glass group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="stat-icon-wrapper">
                                <span class="material-symbols-outlined text-[24px]">verified</span>
                            </div>
                            <span class="stat-tag-badge">
                                Thực chiến
                            </span>
                        </div>
                        <div class="stat-number-glow counter-value" data-target="5" data-suffix="+">
                            5+
                        </div>
                        <div class="stat-title-text">
                            Năm kinh nghiệm
                        </div>
                        <div class="stat-desc-text">
                            Tiên phong trong lĩnh vực truyền thông &amp; giải pháp số
                        </div>
                    </div>

                    <!-- Stat 4: 20+ -->
                    <div class="stat-card-glass group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="stat-icon-wrapper">
                                <span class="material-symbols-outlined text-[24px]">groups_3</span>
                            </div>
                            <span class="stat-tag-badge">
                                Nhân sự
                            </span>
                        </div>
                        <div class="stat-number-glow counter-value" data-target="20" data-suffix="+">
                            20+
                        </div>
                        <div class="stat-title-text">
                            Nhân sự chuyên nghiệp
                        </div>
                        <div class="stat-desc-text">
                            Đội ngũ sáng tạo, công nghệ tận tâm &amp; hiệu quả
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ========================================================
         SECTION 5: ĐỘI NGŨ CỦA CHÚNG TÔI (NHỮNG CON NGƯỜI TẠO NÊN KHÁC BIỆT)
         ======================================================== -->
    <section class="relative w-full overflow-hidden bg-gradient-to-br from-[#ffffff] via-[#fffdfa] to-[#fff7f0] border-b border-orange-100/50 py-12 sm:py-16 lg:py-20" id="doi-ngu">
        
        <!-- Subtle Ambient Warm Glow on Top Right -->
        <div class="absolute -top-24 right-0 w-[450px] sm:w-[550px] h-[450px] sm:h-[550px] bg-gradient-to-br from-orange-200/35 via-amber-100/15 to-transparent rounded-full blur-3xl pointer-events-none z-0" aria-hidden="true"></div>

        <!-- 1. Top-Left Corner Leaves Decor (User High-Res Asset) -->
        <img src="{{ asset('images/about/decor_leaves_top_left.png') }}?v={{ file_exists(public_path('images/about/decor_leaves_top_left.png')) ? filemtime(public_path('images/about/decor_leaves_top_left.png')) : time() }}" 
             alt="" 
             class="absolute top-0 left-0 w-28 sm:w-36 md:w-48 lg:w-60 xl:w-72 h-auto pointer-events-none select-none z-10"
             aria-hidden="true">

        <!-- 2. Bottom-Left Corner Orange Wave Decor (User High-Res Asset) -->
        <img src="{{ asset('images/about/decor_wave_bottom_left.png') }}?v={{ file_exists(public_path('images/about/decor_wave_bottom_left.png')) ? filemtime(public_path('images/about/decor_wave_bottom_left.png')) : time() }}" 
             alt="" 
             class="absolute bottom-0 left-0 w-48 sm:w-64 md:w-80 lg:w-[420px] xl:w-[500px] h-auto pointer-events-none select-none z-10"
             aria-hidden="true">

        <!-- 3. Bottom-Right Corner Leaves Decor (User High-Res Asset) -->
        <img src="{{ asset('images/about/decor_leaves_bottom_right.png') }}?v={{ file_exists(public_path('images/about/decor_leaves_bottom_right.png')) ? filemtime(public_path('images/about/decor_leaves_bottom_right.png')) : time() }}" 
             alt="" 
             class="absolute bottom-0 right-0 w-44 sm:w-60 md:w-72 lg:w-96 xl:w-[440px] h-auto pointer-events-none select-none z-20"
             aria-hidden="true">

        <!-- Main Content Grid: 1 Bên Text, 1 Bên Hình -->
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 xl:gap-10 items-center">
                
                <!-- CỘT TRÁI: TEXT BẰNG CODE HTML/CSS -->
                <div class="lg:col-span-5 space-y-4 sm:space-y-5">
                    
                    <!-- Badge ĐỘI NGŨ CỦA CHÚNG TÔI -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#fff5ee] border border-orange-200/80 text-[#ff5400] text-xs font-black tracking-wider uppercase shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                        <span>ĐỘI NGŨ CỦA CHÚNG TÔI</span>
                    </div>

                    <!-- Heading -->
                    <h2 class="text-3xl sm:text-4xl lg:text-[42px] xl:text-[46px] font-black text-slate-900 tracking-tight leading-[1.14]">
                        Những Con Người <span class="text-[#ff5400]" style="color: #ff5400 !important;">Tạo Nên Khác Biệt</span>
                    </h2>

                    <!-- Paragraph -->
                    <p class="text-sm sm:text-[14.5px] lg:text-[15px] text-slate-600 leading-relaxed font-normal">
                        Đội ngũ Truyền Thông Cửu Long là sự kết hợp giữa kinh nghiệm, sáng tạo và đam mê, luôn sẵn sàng mang đến những ý tưởng đột phá và giải pháp tối ưu nhất cho khách hàng.
                    </p>

                    <!-- Button Xem đội ngũ -->
                    <div class="pt-2">
                        <a href="{{ route('careers') }}" class="group inline-flex items-center gap-2.5 px-6 sm:px-7 py-3 rounded-full bg-gradient-to-r from-[#ff5400] to-[#f95738] hover:from-[#f95738] hover:to-[#ea580c] text-white text-sm sm:text-[15px] font-bold shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                            <span>Xem đội ngũ</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>

                </div>

                <!-- CỘT PHẢI: HÌNH ẢNH MONTAGE ĐỘI NGŨ BÊN PHẢI -->
                <div class="lg:col-span-7 relative flex items-center justify-center lg:justify-end">
                    <img src="{{ asset('images/about/about_team_visual.png') }}?v={{ file_exists(public_path('images/about/about_team_visual.png')) ? filemtime(public_path('images/about/about_team_visual.png')) : time() }}" 
                         alt="Những con người tạo nên khác biệt - Đội ngũ Truyền Thông Cửu Long" 
                         class="w-full max-w-2xl xl:max-w-3xl h-auto object-contain block select-none drop-shadow-sm hover:scale-[1.01] transition-transform duration-500"
                         loading="lazy">
                </div>

            </div>
        </div>

    </section>


    <!-- ========================================================
         SECTION 6: QUÁ TRÌNH PHÁT TRIỂN – NHỮNG DẤU MỐC QUAN TRỌNG
         ======================================================== -->
    <section class="py-16 sm:py-20 lg:py-28 bg-gradient-to-b from-[#ffffff] via-[#fffbf6] to-[#ffffff] border-b border-orange-100/50 relative overflow-hidden" id="qua-trinh-phat-trien">
        
        <!-- Subtle Ambient Background Glows -->
        <div class="absolute top-1/3 left-1/4 w-[480px] h-[480px] bg-orange-100/35 rounded-full blur-3xl pointer-events-none -z-0"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-amber-100/30 rounded-full blur-3xl pointer-events-none -z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20 space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#fff4ed] border border-orange-200/80 text-[#ff5400] text-xs font-black tracking-widest uppercase shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-[#ff5400] shadow-[0_0_8px_rgba(255,84,0,0.6)] animate-pulse"></span>
                    <span>QUÁ TRÌNH PHÁT TRIỂN</span>
                </div>

                <h2 class="text-3xl sm:text-4xl lg:text-[44px] font-black text-slate-900 tracking-tight leading-[1.18]">
                    Những Dấu Mốc <span style="color: #ff5400 !important;">Quan Trọng</span>
                </h2>

                <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-normal" style="color: #475569 !important;">
                    Hành trình không ngừng đổi mới, sáng tạo và khẳng định vị thế thương hiệu đồng hành cùng hàng trăm doanh nghiệp, đối tác trên khắp cả nước.
                </p>
            </div>

            <!-- Horizontal Roadmap Timeline Container -->
            <div class="relative">
                
                <!-- Glowing Milestone Connecting Track (Desktop LG+) -->
                <div class="hidden lg:block timeline-track-glow"></div>

                <!-- 4 Milestones Bento Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-7 relative z-10">
                    
                    <!-- Milestone 1: 2019 -->
                    <div class="timeline-card group">
                        <span class="timeline-card-watermark">2019</span>
                        
                        <div class="relative z-10">
                            <!-- Top Row: Icon Beacon + Year Badge -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="timeline-node-beacon">
                                    <span class="material-symbols-outlined text-[24px]">rocket_launch</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="timeline-year-badge">
                                        2019
                                    </span>
                                    <span class="timeline-phase-tag">
                                        Khởi Đầu
                                    </span>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                                Thành Lập Công Ty
                            </h3>

                            <!-- Description -->
                            <p class="text-sm leading-relaxed font-normal mb-6" style="color: #475569 !important;">
                                Bắt đầu hành trình với sứ mệnh phụng sự, kiến tạo giải pháp truyền thông hiện đại và mang giá trị thực tế đến cộng đồng doanh nghiệp Việt Nam.
                            </p>

                            <!-- Milestone Key Highlights -->
                            <ul class="space-y-2 text-xs font-semibold text-slate-700 mb-6">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Thành lập tại Cần Thơ</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Đặt nền móng sản xuất Media</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Footer -->
                        <div class="relative z-10 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold" style="color: #64748b;">
                            <span>Cột mốc số 01</span>
                            <span class="text-[#ff5400]">Nền tảng vững chắc</span>
                        </div>
                    </div>

                    <!-- Milestone 2: 2021 -->
                    <div class="timeline-card group">
                        <span class="timeline-card-watermark">2021</span>
                        
                        <div class="relative z-10">
                            <!-- Top Row: Icon Beacon + Year Badge -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="timeline-node-beacon">
                                    <span class="material-symbols-outlined text-[24px]">hub</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="timeline-year-badge">
                                        2021
                                    </span>
                                    <span class="timeline-phase-tag">
                                        Mở Rộng
                                    </span>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                                Mở Rộng Dịch Vụ
                            </h3>

                            <!-- Description -->
                            <p class="text-sm leading-relaxed font-normal mb-6" style="color: #475569 !important;">
                                Hoàn thiện hệ sinh thái giải pháp toàn diện: Sản xuất Media, Marketing số, Thiết kế thương hiệu và Phát triển giải pháp công nghệ doanh nghiệp.
                            </p>

                            <!-- Milestone Key Highlights -->
                            <ul class="space-y-2 text-xs font-semibold text-slate-700 mb-6">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Đa dạng hóa dịch vụ sản xuất</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Hơn 50+ đối tác chiến lược đầu tiên</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Footer -->
                        <div class="relative z-10 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold" style="color: #64748b;">
                            <span>Cột mốc số 02</span>
                            <span class="text-[#ff5400]">Đa kênh & Toàn diện</span>
                        </div>
                    </div>

                    <!-- Milestone 3: 2023 -->
                    <div class="timeline-card group">
                        <span class="timeline-card-watermark">2023</span>
                        
                        <div class="relative z-10">
                            <!-- Top Row: Icon Beacon + Year Badge -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="timeline-node-beacon">
                                    <span class="material-symbols-outlined text-[24px]">trending_up</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="timeline-year-badge">
                                        2023
                                    </span>
                                    <span class="timeline-phase-tag">
                                        Bứt Phá
                                    </span>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                                Đội Ngũ Vững Mạnh
                            </h3>

                            <!-- Description -->
                            <p class="text-sm leading-relaxed font-normal mb-6" style="color: #475569 !important;">
                                Quy mô nhân sự tăng trưởng vượt bậc, trang bị hệ thống trang thiết bị trường quay 4K hiện đại và thực thi hơn 200+ dự án quy mô lớn nhỏ.
                            </p>

                            <!-- Milestone Key Highlights -->
                            <ul class="space-y-2 text-xs font-semibold text-slate-700 mb-6">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Quy mô nhân sự tăng gấp đôi</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Thiết bị chuẩn điện ảnh 4K</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Footer -->
                        <div class="relative z-10 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold" style="color: #64748b;">
                            <span>Cột mốc số 03</span>
                            <span class="text-[#ff5400]">Khẳng định vị thế</span>
                        </div>
                    </div>

                    <!-- Milestone 4: 2025 (Featured / Active Future Card) -->
                    <div class="timeline-card timeline-card-highlight group">
                        <span class="timeline-card-watermark" style="color: rgba(255, 84, 0, 0.15) !important;">2025</span>
                        
                        <div class="relative z-10">
                            <!-- Top Row: Icon Beacon + Year Badge -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="timeline-node-beacon">
                                    <span class="material-symbols-outlined text-[24px]">auto_awesome</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="timeline-year-badge">
                                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                        2025
                                    </span>
                                    <span class="timeline-phase-tag" style="background: #ff5400; color: #ffffff !important;">
                                        Vươn Tầm
                                    </span>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-black mb-3 group-hover:text-[#ff5400] transition-colors" style="color: #0f172a !important;">
                                Vươn Tới Tương Lai
                            </h3>

                            <!-- Description -->
                            <p class="text-sm leading-relaxed font-normal mb-6" style="color: #475569 !important;">
                                Đẩy mạnh nghiên cứu &amp; ứng dụng trí tuệ nhân tạo (AI), nâng tầm sáng tạo và bứt phá thị trường truyền thông công nghệ số trên toàn quốc.
                            </p>

                            <!-- Milestone Key Highlights -->
                            <ul class="space-y-2 text-xs font-semibold text-slate-800 mb-6">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Tích hợp AI &amp; Công nghệ số</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #ff5400;"></span>
                                    <span>Vươn tầm đối tác toàn quốc</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Footer -->
                        <div class="relative z-10 pt-4 border-t border-orange-200/80 flex items-center justify-between text-xs font-bold" style="color: #ea580c !important;">
                            <span>Cột mốc mục tiêu</span>
                            <span class="font-extrabold">Tiên phong dẫn đầu ✨</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ========================================================
         SECTION 7: CTA BANNER (CÙNG CHÚNG TÔI TẠO NÊN NHỮNG GIÁ TRỊ THẬT!)
         ======================================================== -->
    <section class="about-cta-section py-12 sm:py-16 lg:py-20 text-slate-800 shadow-sm relative overflow-hidden" id="cung-chung-toi">
        
        <!-- Ambient Warm Glow Top-Right -->
        <div class="absolute -top-24 right-0 w-[450px] sm:w-[550px] h-[450px] sm:h-[550px] bg-gradient-to-br from-orange-200/30 via-amber-100/15 to-transparent rounded-full blur-3xl pointer-events-none z-0" aria-hidden="true"></div>

        <!-- 1. Top-Left Corner Orange Wave Accent (Exact visual flow from mockup) -->
        <div class="absolute top-0 left-0 w-64 sm:w-80 md:w-96 lg:w-[460px] h-36 sm:h-44 md:h-52 pointer-events-none select-none z-10 overflow-hidden" aria-hidden="true">
            <svg class="w-full h-full" viewBox="0 0 460 200" fill="none" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="cta-top-wave-gradient-1" x1="0%" y1="0%" x2="80%" y2="80%">
                        <stop offset="0%" stop-color="#ff9944" stop-opacity="0.8" />
                        <stop offset="45%" stop-color="#ffb870" stop-opacity="0.5" />
                        <stop offset="100%" stop-color="#fff4e8" stop-opacity="0" />
                    </linearGradient>
                    <linearGradient id="cta-top-wave-gradient-2" x1="0%" y1="0%" x2="60%" y2="100%">
                        <stop offset="0%" stop-color="#ff5400" stop-opacity="0.85" />
                        <stop offset="50%" stop-color="#ff7b2b" stop-opacity="0.65" />
                        <stop offset="100%" stop-color="#ffd4b0" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path d="M0 0 H340 C260 55 170 95 0 120 Z" fill="url(#cta-top-wave-gradient-1)" />
                <path d="M0 0 H240 C170 42 110 75 0 95 Z" fill="url(#cta-top-wave-gradient-2)" />
                <path d="M0 50 C70 60 140 35 220 0 C170 0 90 0 0 0 Z" fill="#ffffff" fill-opacity="0.35" />
            </svg>
        </div>

        <!-- 2. Bottom-Left Corner Orange Wave Decor (User High-Res Asset) -->
        <img src="{{ asset('images/about/decor_wave_bottom_left.png') }}?v={{ file_exists(public_path('images/about/decor_wave_bottom_left.png')) ? filemtime(public_path('images/about/decor_wave_bottom_left.png')) : time() }}" 
             alt="" 
             class="absolute bottom-0 left-0 w-44 sm:w-60 md:w-72 lg:w-96 xl:w-[440px] h-auto pointer-events-none select-none z-10" 
             aria-hidden="true">

        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 xl:gap-10 items-center">
                
                <!-- Left Text Column -->
                <div class="lg:col-span-5 space-y-4 sm:space-y-5 text-left">
                    
                    <!-- Badge BẠN ĐÃ SẴN SÀNG? -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#fff5ee] border border-orange-200/90 text-[#ff5400] text-xs font-black tracking-wider uppercase shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-[#ff5400]"></span>
                        <span>BẠN ĐÃ SẴN SÀNG?</span>
                    </div>

                    <!-- Heading -->
                    <h2 class="text-3xl sm:text-4xl lg:text-[40px] xl:text-[44px] font-black tracking-tight leading-[1.18]" style="color: #0f172a !important;">
                        Cùng Chúng Tôi Tạo Nên<br>
                        <span class="relative inline-block text-[#ff5400]" style="color: #ff5400 !important;">
                            Những Giá Trị Thật!
                            <svg class="absolute -bottom-2 left-0 w-full h-3 text-[#ff5400]" viewBox="0 0 240 12" fill="none" preserveAspectRatio="none">
                                <path d="M3 9C60 3 180 3 237 9" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </h2>

                    <!-- Paragraph -->
                    <p class="text-sm sm:text-[14.5px] lg:text-[15px] leading-relaxed font-normal max-w-lg" style="color: #475569 !important;">
                        Hãy để Truyền Thông Cửu Long đồng hành cùng bạn trong hành trình xây dựng thương hiệu và phát triển bền vững.
                    </p>

                    <!-- CTA Button -->
                    <div class="pt-2">
                        <a href="{{ route('contact') }}" class="about-cta-pill-btn group">
                            <span>Liên hệ ngay</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>

                </div>

                <!-- Right Visual Column (Modern Workspace Composite) -->
                <div class="lg:col-span-7 relative flex items-center justify-center lg:justify-end">
                    <img src="{{ asset('images/about/about_cta_visual.png') }}?v={{ file_exists(public_path('images/about/about_cta_visual.png')) ? filemtime(public_path('images/about/about_cta_visual.png')) : time() }}" 
                         alt="Cùng Chúng Tôi Tạo Nên Những Giá Trị Thật - Truyền Thông Cửu Long" 
                         class="w-full max-w-2xl xl:max-w-3xl h-auto object-contain block select-none drop-shadow-sm hover:scale-[1.01] transition-transform duration-500"
                         loading="lazy">
                </div>

            </div>
        </div>

    </section>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const counterElements = document.querySelectorAll('.counter-value');
    if (!counterElements.length) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-target'), 10);
                const suffix = el.getAttribute('data-suffix') || '';
                if (!isNaN(target)) {
                    const duration = 1800; // ms
                    const startTime = performance.now();

                    function updateCount(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeOut = 1 - Math.pow(1 - progress, 3);
                        const currentVal = Math.floor(easeOut * target);
                        el.textContent = currentVal + suffix;

                        if (progress < 1) {
                            requestAnimationFrame(updateCount);
                        } else {
                            el.textContent = target + suffix;
                        }
                    }

                    requestAnimationFrame(updateCount);
                }
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.25 });

    counterElements.forEach(el => observer.observe(el));
});
</script>
@endpush
