@extends('layouts.app')

@section('title', 'Dịch Vụ Chụp Ảnh TeamBuilding Chuyên Nghiệp • Bắt Trọn Khoảnh Khắc - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ chụp ảnh teambuilding, hoạt động ngoài trời, dã ngoại bãi biển chuyên nghiệp tại Cần Thơ & ĐBSCL. Bắt trọn năng lượng gắn kết, bàn giao ảnh nhanh, chất lượng sắc nét.')

@section('content')
<div class="w-full bg-[#fcfdff] text-slate-800 antialiased overflow-x-hidden" 
     style="font-family: var(--font-primary, 'Mulish', sans-serif);"
     x-data="{
         previewImage: null,
         previewTitle: '',
         openPreview(src, title) {
             this.previewImage = src;
             this.previewTitle = title;
         },
         closePreview() {
             this.previewImage = null;
             this.previewTitle = '';
         }
     }">

    <!-- Custom Essential Styling (Guaranteed to render without depending on Vite rebuild) -->
    <style>
        .badge-teambuilding {
            display: inline-flex;
            align-items: center;
            padding: 5px 18px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: 1.5px solid #ff5400;
            color: #ff5400;
            background: rgba(255, 84, 0, 0.06);
        }
        .badge-teambuilding-dark {
            display: inline-flex;
            align-items: center;
            padding: 5px 18px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: 1px solid rgba(255, 84, 0, 0.5);
            color: #ff7a1a;
            background: rgba(255, 84, 0, 0.12);
        }
        .bg-dark-section {
            background-color: #070d18 !important;
        }
        .bg-dark-bar {
            background-color: #0a1120 !important;
        }
        .bg-dark-card {
            background-color: #0e1726 !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        .card-dark-glass {
            background-color: #0e1726 !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-dark-glass:hover {
            border-color: rgba(255, 84, 0, 0.5) !important;
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -10px rgba(255, 84, 0, 0.25);
        }
        .feature-icon-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 84, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ff5400;
            background: rgba(255, 84, 0, 0.08);
            transition: all 0.3s ease;
        }
        .group:hover .feature-icon-circle {
            background: #ff5400;
            color: #ffffff;
            border-color: #ff5400;
            transform: scale(1.06);
            box-shadow: 0 0 20px rgba(255, 84, 0, 0.45);
        }
        .img-hover-zoom {
            overflow: hidden;
            border-radius: 1rem;
        }
        .img-hover-zoom img {
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .img-hover-zoom:hover img {
            transform: scale(1.05);
        }
        .btn-orange-pill {
            background: linear-gradient(135deg, #ff5400, #ff7a1a) !important;
            color: #ffffff !important;
            box-shadow: 0 6px 18px -4px rgba(255, 84, 0, 0.45);
        }
        .btn-orange-pill:hover {
            background: linear-gradient(135deg, #e04a00, #ff6600) !important;
            box-shadow: 0 8px 24px -4px rgba(255, 84, 0, 0.6);
            transform: translateY(-1px);
        }
        .camera-badge-pill {
            width: 38px;
            height: 30px;
            border-radius: 8px;
            background-color: #ff5400 !important;
            color: #ffffff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.35);
        }
        .camera-badge-line {
            width: 52px;
            height: 3px;
            background-color: #ff5400 !important;
            border-radius: 9999px;
            display: inline-block;
        }
        .decor-sparks-topright {
            position: absolute;
            top: 20px;
            right: 48px;
            pointer-events: none;
            user-select: none;
            z-index: 10;
        }
        .decor-plane-topright {
            position: absolute;
            top: 20px;
            right: 48px;
            pointer-events: none;
            user-select: none;
            z-index: 10;
        }
        @media (max-width: 768px) {
            .decor-sparks-topright {
                top: 14px;
                right: 20px;
            }
            .decor-plane-topright {
                top: 14px;
                right: 20px;
                width: 100px;
            }
        }

        /* ===================================================
           SECTION: VÌ SAO CHỌN CHÚNG TÔI (4 FEATURE CARDS)
           Khớp hoàn hảo với Mockup thiết kế người dùng cung cấp
           =================================================== */
        .why-us-section {
            position: relative;
            background: linear-gradient(180deg, #ffffff 0%, #fffdfa 55%, #ffffff 100%);
            padding-top: 54px;
            padding-bottom: 64px;
            overflow: hidden;
        }

        /* Eyebrow badge with side lines */
        .why-us-badge-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .why-us-badge-line {
            width: 32px;
            height: 1.5px;
            background-color: #ff5400;
            display: inline-block;
        }
        .why-us-badge-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 18px;
            border-radius: 9999px;
            border: 1.5px solid #ff5400;
            color: #ff5400;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.06);
        }

        /* Main Heading */
        .why-us-title {
            font-size: 26px;
            font-weight: 900;
            color: #0f172a;
            line-height: 1.25;
            letter-spacing: -0.02em;
            text-align: center;
            margin: 0;
        }
        @media (min-width: 640px) {
            .why-us-title {
                font-size: 32px;
            }
        }
        @media (min-width: 1024px) {
            .why-us-title {
                font-size: 38px;
            }
        }
        .why-us-title-highlight {
            color: #ff5400;
        }

        /* Subtitle & Curved underline */
        .why-us-subtitle {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            text-align: center;
            margin-top: 10px;
            font-weight: 500;
            max-width: 680px;
        }
        @media (min-width: 640px) {
            .why-us-subtitle {
                font-size: 15px;
            }
        }

        /* 4 Feature Cards Grid */
        .why-us-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 52px 20px;
            margin-top: 54px;
        }
        @media (min-width: 640px) {
            .why-us-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 52px 20px;
            }
        }
        @media (min-width: 1024px) {
            .why-us-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 22px;
            }
        }

        /* Individual Feature Card */
        .why-us-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid #ffe3d1;
            border-radius: 22px;
            padding: 50px 20px 24px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 10px 28px -4px rgba(0, 0, 0, 0.05), 0 2px 8px rgba(255, 84, 0, 0.04);
            transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .why-us-card:hover {
            transform: translateY(-6px);
            border-color: #ff5400;
            box-shadow: 0 18px 36px -6px rgba(255, 84, 0, 0.16), 0 8px 18px -4px rgba(0, 0, 0, 0.06);
        }

        /* Floating Icon Badge at Top Center */
        .why-us-icon-badge {
            position: absolute;
            top: -38px;
            left: 50%;
            transform: translateX(-50%);
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #ffffff;
            padding: 4px;
            box-shadow: 0 8px 20px -3px rgba(255, 84, 0, 0.28), 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 2px solid #ffd8c2;
            transition: all 0.35s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
        }
        .why-us-card:hover .why-us-icon-badge {
            transform: translateX(-50%) scale(1.08);
            box-shadow: 0 12px 26px -2px rgba(255, 84, 0, 0.38);
            border-color: #ff5400;
        }

        .why-us-icon-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff7a1a 0%, #ff4500 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            position: relative;
        }

        /* Card Title */
        .why-us-card-title {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            letter-spacing: -0.01em;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            transition: color 0.25s ease;
        }
        @media (min-width: 640px) {
            .why-us-card-title {
                font-size: 17px;
            }
        }
        .why-us-card:hover .why-us-card-title {
            color: #ff5400;
        }

        /* Card Description */
        .why-us-card-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
            flex-grow: 1;
        }

        /* Card Bottom Orange Dash */
        .why-us-card-dash {
            width: 32px;
            height: 3px;
            background-color: #ff5400;
            border-radius: 9999px;
            margin-top: 18px;
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        .why-us-card:hover .why-us-card-dash {
            width: 48px;
            background-color: #e04a00;
        }

        /* Decor elements positioning */
        .why-us-decor-topleft {
            position: absolute;
            top: 0;
            left: 0;
            width: 160px;
            height: 90px;
            pointer-events: none;
            user-select: none;
            z-index: 1;
        }
        @media (min-width: 640px) {
            .why-us-decor-topleft {
                width: 250px;
                height: 135px;
            }
        }
        @media (min-width: 1024px) {
            .why-us-decor-topleft {
                width: 320px;
                height: 170px;
            }
        }

        .why-us-decor-topright {
            position: absolute;
            top: 0;
            right: 0;
            width: 130px;
            height: 100px;
            pointer-events: none;
            user-select: none;
            z-index: 1;
        }
        @media (min-width: 640px) {
            .why-us-decor-topright {
                width: 200px;
                height: 160px;
            }
        }
        @media (min-width: 1024px) {
            .why-us-decor-topright {
                width: 260px;
                height: 200px;
            }
        }

        .why-us-decor-bottomleft {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 130px;
            height: 55px;
            pointer-events: none;
            user-select: none;
            z-index: 1;
        }
        @media (min-width: 640px) {
            .why-us-decor-bottomleft {
                width: 210px;
                height: 80px;
            }
        }
        @media (min-width: 1024px) {
            .why-us-decor-bottomleft {
                width: 270px;
                height: 95px;
            }
        }

        .why-us-decor-bottomright {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 160px;
            height: 70px;
            pointer-events: none;
            user-select: none;
            z-index: 1;
        }
        @media (min-width: 640px) {
            .why-us-decor-bottomright {
                width: 250px;
                height: 100px;
            }
        }
        @media (min-width: 1024px) {
            .why-us-decor-bottomright {
                width: 330px;
                height: 125px;
            }
        }

        /* ===================================================
           SECTION: CÁC GÓI CHỤP ẢNH TEAMBUILDING (PRICING PACKAGES)
           Khớp hoàn hảo với Mockup thiết kế người dùng cung cấp
           =================================================== */
        .pkg-section {
            position: relative;
            background: linear-gradient(180deg, #fbfcfe 0%, #f6f8fb 55%, #ffffff 100%);
            padding-top: 64px;
            padding-bottom: 72px;
            overflow: hidden;
        }

        /* Eyebrow Pill */
        .pkg-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 4px 14px 4px 6px;
            border-radius: 9999px;
            border: 1px solid rgba(255, 84, 0, 0.35);
            background: rgba(255, 84, 0, 0.06);
            margin-bottom: 12px;
        }
        .pkg-eyebrow-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background-color: #ff5400;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pkg-eyebrow-text {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #ff5400;
        }

        /* Section Header Layout */
        .pkg-header-row {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 38px;
        }
        @media (min-width: 768px) {
            .pkg-header-row {
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
            }
        }
        .pkg-title-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        @media (min-width: 768px) {
            .pkg-title-group {
                flex-direction: row;
                align-items: center;
            }
        }
        .pkg-title {
            font-size: 28px;
            font-weight: 900;
            color: #0f172a;
            line-height: 1.18;
            letter-spacing: -0.02em;
            margin: 0;
        }
        @media (min-width: 640px) {
            .pkg-title {
                font-size: 34px;
            }
        }
        @media (min-width: 1024px) {
            .pkg-title {
                font-size: 38px;
            }
        }
        .pkg-title-highlight {
            color: #ff5400;
        }
        .pkg-divider-line {
            width: 2px;
            height: 48px;
            background-color: #ff5400;
            border-radius: 9999px;
            margin: 0 20px;
            display: none;
        }
        @media (min-width: 768px) {
            .pkg-divider-line {
                display: block;
            }
        }
        .pkg-subtitle {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            max-width: 380px;
            margin: 0;
            font-weight: 500;
        }

        /* 3 Cards Container */
        .pkg-cards-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 24px;
            align-items: stretch;
        }
        @media (min-width: 1024px) {
            .pkg-cards-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 24px;
            }
        }

        /* Individual Package Card */
        .pkg-card {
            background: #0e1726;
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
        }
        .pkg-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -8px rgba(0, 0, 0, 0.15);
        }

        /* Featured / Highlighted Card (Card 2) */
        .pkg-card-featured {
            border: 2px solid #ff5400 !important;
            box-shadow: 0 14px 40px -4px rgba(255, 84, 0, 0.22), 0 4px 16px rgba(0, 0, 0, 0.08) !important;
        }
        @media (min-width: 1024px) {
            .pkg-card-featured {
                transform: translateY(-8px);
            }
            .pkg-card-featured:hover {
                transform: translateY(-14px);
            }
        }

        /* Top Image Container */
        .pkg-card-img-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background-color: #070d18;
        }
        .pkg-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .pkg-card:hover .pkg-card-img-wrap img {
            transform: scale(1.06);
        }

        /* Floating Badges on Image */
        .pkg-badge-dark {
            position: absolute;
            top: 14px;
            left: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(10, 17, 32, 0.88);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 9999px;
            padding: 4px 12px 4px 5px;
            color: #ffffff;
            z-index: 2;
        }
        .pkg-badge-icon-sq {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background-color: #ff5400;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pkg-badge-text-title {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            line-height: 1.1;
        }
        .pkg-badge-text-sub {
            font-size: 9.5px;
            color: #cbd5e1;
            line-height: 1;
        }

        /* Featured Orange Badge on Image */
        .pkg-badge-featured {
            position: absolute;
            top: 14px;
            left: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #ff6600, #ff4500);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 9999px;
            padding: 5px 14px;
            color: #ffffff;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.4);
            z-index: 2;
        }

        /* Card Body (Dark Section) */
        .pkg-card-body {
            padding: 22px 22px 20px 22px;
            color: #ffffff;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .pkg-card-title {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }
        .pkg-card-title-slash {
            color: #ff5400;
            font-weight: 900;
        }
        .pkg-card-desc {
            font-size: 13px;
            color: #94a3b8;
            line-height: 1.5;
            margin-bottom: 16px;
            min-height: 38px;
        }
        .pkg-card-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .pkg-card-list-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: #e2e8f0;
            line-height: 1.45;
        }
        .pkg-check-circle {
            width: 17px;
            height: 17px;
            border-radius: 50%;
            background-color: #ff5400;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 900;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Card Footer (White Background Strip) */
        .pkg-card-footer {
            background: #ffffff;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-top: 1px solid #f1f5f9;
        }
        .pkg-btn-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 700;
            transition: all 0.25s ease;
            text-decoration: none;
            white-space: nowrap;
        }
        .pkg-btn-cta-orange {
            background: linear-gradient(135deg, #ff5400, #ff7a1a);
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3);
        }
        .pkg-btn-cta-orange:hover {
            background: linear-gradient(135deg, #e04a00, #ff6600);
            box-shadow: 0 6px 16px rgba(255, 84, 0, 0.45);
            transform: translateY(-1px);
        }
        .pkg-btn-cta-outline {
            background: #ffffff;
            color: #0f172a !important;
            border: 1.5px solid #0f172a;
        }
        .pkg-btn-cta-outline:hover {
            background: #0f172a;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .pkg-price-col {
            display: flex;
            align-items: center;
            gap: 8px;
            text-align: left;
        }
        .pkg-price-camera-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: 1px solid rgba(255, 84, 0, 0.4);
            background: rgba(255, 84, 0, 0.06);
            color: #ff5400;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .pkg-price-label {
            font-size: 10.5px;
            color: #94a3b8;
            line-height: 1.1;
            font-weight: 500;
        }
        .pkg-price-value {
            font-size: 12.5px;
            font-weight: 800;
            color: #ff5400;
            line-height: 1.2;
            white-space: nowrap;
        }

        /* Bottom Guarantee Trust Bar */
        .pkg-trust-bar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px 24px;
            margin-top: 36px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 16px;
        }
        @media (min-width: 640px) {
            .pkg-trust-bar {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .pkg-trust-bar {
                grid-template-columns: repeat(4, minmax(0, 1fr));
                padding: 14px 28px;
            }
        }
        .pkg-trust-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            justify-content: center;
        }
        @media (min-width: 1024px) {
            .pkg-trust-item:not(:last-child) {
                border-right: 1px solid #e2e8f0;
                padding-right: 18px;
            }
        }
        .pkg-trust-item .material-symbols-outlined {
            font-size: 20px;
            color: #ff5400;
            flex-shrink: 0;
        }

        /* ===================================================
           SECTION: KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI (TESTIMONIALS)
           Khớp hoàn hảo với Mockup thiết kế người dùng cung cấp
           =================================================== */
        .testimonial-section {
            position: relative;
            padding-top: 64px;
            padding-bottom: 72px;
            overflow: hidden;
            background-color: #f8fafc;
        }

        .testimonial-bg-wrap {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }
        .testimonial-bg-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: right center;
        }
        .testimonial-bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(248, 250, 252, 0.98) 0%, rgba(248, 250, 252, 0.94) 48%, rgba(248, 250, 252, 0.55) 75%, rgba(248, 250, 252, 0.1) 100%);
            pointer-events: none;
        }
        @media (max-width: 1024px) {
            .testimonial-bg-overlay {
                background: rgba(248, 250, 252, 0.94);
            }
        }

        .testimonial-card-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 20px;
            margin-top: 36px;
        }
        @media (min-width: 1024px) {
            .testimonial-card-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 20px;
            }
        }

        .testimonial-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            box-shadow: 0 10px 28px -4px rgba(0, 0, 0, 0.05);
            transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
        }
        @media (min-width: 640px) {
            .testimonial-card {
                flex-direction: row;
                align-items: stretch;
                padding: 16px;
            }
        }
        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 36px -6px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card-featured {
            border: 2px solid #ff5400 !important;
            box-shadow: 0 12px 32px -4px rgba(255, 84, 0, 0.18), 0 4px 12px rgba(0, 0, 0, 0.04) !important;
        }

        .testimonial-thumb-wrap {
            width: 100%;
            aspect-ratio: 1 / 1;
            border-radius: 16px;
            overflow: hidden;
            background-color: #070d18;
            flex-shrink: 0;
        }
        @media (min-width: 640px) {
            .testimonial-thumb-wrap {
                width: 135px;
                height: auto;
            }
        }
        @media (min-width: 1280px) {
            .testimonial-thumb-wrap {
                width: 145px;
            }
        }
        .testimonial-thumb-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.5s ease;
        }
        .testimonial-card:hover .testimonial-thumb-wrap img {
            transform: scale(1.06);
        }

        .testimonial-content-wrap {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
            min-width: 0;
        }

        .testimonial-quote-icon {
            color: #ff5400;
            font-size: 32px;
            line-height: 1;
            font-family: Georgia, serif;
            font-weight: 900;
            margin-bottom: 2px;
        }

        .testimonial-quote-text {
            font-size: 12.5px;
            color: #334155;
            line-height: 1.55;
            margin: 0 0 14px 0;
            font-weight: 400;
        }

        .testimonial-author-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: auto;
            padding-top: 8px;
            border-top: 1px solid #f1f5f9;
        }
        .testimonial-author-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #ffe3d1;
            flex-shrink: 0;
        }
        .testimonial-author-name {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 6px;
            line-height: 1.2;
        }
        .testimonial-author-name-dash {
            width: 14px;
            height: 1.5px;
            background-color: #ff5400;
            display: inline-block;
        }
        .testimonial-author-role {
            font-size: 11.5px;
            color: #64748b;
            font-weight: 500;
            line-height: 1.2;
            margin-top: 2px;
        }

        /* Nav controls row */
        .testimonial-nav-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
            margin-top: 34px;
        }
        .testimonial-nav-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ff5400;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.35);
            transition: all 0.25s ease;
            border: none;
            cursor: pointer;
        }
        .testimonial-nav-btn:hover {
            background: #e04a00;
            transform: scale(1.08);
        }
        .testimonial-nav-dots {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .testimonial-dot {
            width: 7px;
            height: 7px;
            border-radius: 9999px;
            background-color: #cbd5e1;
            transition: all 0.25s ease;
        }
        .testimonial-dot.active {
            width: 22px;
            background-color: #ff5400;
        }
    </style>

    <!-- ==========================================
         SECTION 1: HERO SECTION
         Banner Chụp Ảnh TeamBuilding (Homepage Aspect Ratio 1983 x 793)
         ========================================== -->
    <section class="relative w-full bg-[#070d18] text-white overflow-hidden">
        <div class="relative w-full overflow-hidden select-none" style="aspect-ratio: 1983 / 793; min-height: 240px;">
            <img src="{{ asset('images/chup-anh-teambuilding/hero_teambuilding.png') }}" 
                 alt="Dịch Vụ Chụp Ảnh TeamBuilding Chuyên Nghiệp" 
                 width="1983"
                 height="793"
                 class="w-full h-full object-cover object-center block select-none">
            
            <!-- Dynamic Orange Accent Flare (Top-Left as seen in mockup) -->
            <div class="absolute top-0 left-0 w-[42%] h-full pointer-events-none opacity-40 sm:opacity-50"
                 style="background: linear-gradient(135deg, rgba(255, 84, 0, 0.75) 0%, rgba(255, 122, 26, 0.35) 45%, transparent 75%);"></div>
        </div>
    </section>

    <!-- ==========================================
         SECTION: VÌ SAO CHỌN CHÚNG TÔI (4 FEATURE CARDS)
         Thiết kế chuẩn xác 100% theo Mockup ảnh đính kèm
         ========================================== -->
    <section class="why-us-section">
        <!-- Decor Top-Left: Dynamic Vibrant Orange Paint Splash / Brush Stroke -->
        <div class="why-us-decor-topleft" aria-hidden="true">
            <svg viewBox="0 0 340 180" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <path d="M0 0 L180 0 C230 18 280 8 330 0 C280 28 220 50 160 68 C110 82 65 110 25 150 C10 165 0 178 0 180 Z" fill="url(#topleftBrushGrad)"/>
                <path d="M0 15 C55 22 135 25 245 10 C205 32 135 45 60 62 C25 70 0 76 0 76 Z" fill="#ff7a1a" opacity="0.9"/>
                <path d="M0 70 C35 82 85 105 130 138 C95 132 50 125 0 115 Z" fill="#ff4500" opacity="0.8"/>
                <circle cx="295" cy="24" r="3.5" fill="#ff5400"/>
                <circle cx="265" cy="38" r="4.5" fill="#ff7a1a"/>
                <circle cx="242" cy="52" r="3" fill="#ff5400"/>
                <circle cx="195" cy="80" r="4" fill="#ff5400"/>
                <circle cx="150" cy="116" r="4.5" fill="#ff7a1a"/>
                <circle cx="105" cy="150" r="3.5" fill="#ff5400"/>
                <circle cx="60" cy="165" r="2.5" fill="#ff7a1a"/>
                <defs>
                    <linearGradient id="topleftBrushGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#ff4500"/>
                        <stop offset="60%" stop-color="#ff6600"/>
                        <stop offset="100%" stop-color="#ff8c1a"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Decor Top-Right: Tropical Palm Fronds Watermark in Soft Peach/Orange -->
        <div class="why-us-decor-topright" aria-hidden="true">
            <svg viewBox="0 0 280 220" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <g stroke="#ff8c42" stroke-linecap="round" opacity="0.45">
                    <path d="M280 0 C220 50 160 120 120 210" stroke-width="2.5"/>
                    <path d="M250 25 C200 15 150 25 110 45" stroke-width="1.8"/>
                    <path d="M235 45 C185 40 140 55 95 80" stroke-width="1.8"/>
                    <path d="M215 70 C170 70 125 90 85 120" stroke-width="1.8"/>
                    <path d="M195 98 C155 105 115 130 80 165" stroke-width="1.8"/>
                    <path d="M170 128 C135 140 105 170 80 205" stroke-width="1.8"/>
                    <path d="M145 160 C120 180 100 205 85 220" stroke-width="1.8"/>

                    <path d="M280 40 C235 85 190 145 160 220" stroke-width="2" opacity="0.6"/>
                    <path d="M260 65 C220 60 180 75 145 100" stroke-width="1.5" opacity="0.6"/>
                    <path d="M240 90 C205 92 165 115 135 145" stroke-width="1.5" opacity="0.6"/>
                    <path d="M215 120 C185 130 155 160 135 195" stroke-width="1.5" opacity="0.6"/>
                </g>
            </svg>
        </div>

        <!-- Decor Bottom-Left: Dynamic Orange Ribbon Swoosh -->
        <div class="why-us-decor-bottomleft" aria-hidden="true">
            <svg viewBox="0 0 280 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <path d="M-10 100 L-10 65 C50 55 130 45 270 95 L270 100 Z" fill="url(#bottomLeftSwooshGrad)"/>
                <path d="M-10 82 C60 70 140 68 230 100 Z" fill="#ff7a1a" opacity="0.8"/>
                <defs>
                    <linearGradient id="bottomLeftSwooshGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff4500"/>
                        <stop offset="100%" stop-color="#ff7a1a"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Decor Bottom-Right: Multi-Layer Ribbon (Navy Base + Orange Swoosh + Palm Watermark) -->
        <div class="why-us-decor-bottomright" aria-hidden="true">
            <svg viewBox="0 0 340 130" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <!-- Navy Base Wedge -->
                <path d="M80 130 C160 125 240 105 340 70 L340 130 Z" fill="#070d18"/>
                <!-- Orange Ribbon Swoosh -->
                <path d="M10 130 C110 95 210 50 340 25 L340 65 C230 85 140 115 50 130 Z" fill="url(#bottomRightSwooshGrad)"/>
                <path d="M70 130 C160 100 240 70 340 50 L340 65 C250 82 170 108 90 130 Z" fill="#ff8c3a" opacity="0.9"/>
                <!-- Subtle Palm Watermark at Right -->
                <g stroke="#ff8c42" stroke-linecap="round" opacity="0.45">
                    <path d="M340 10 C310 35 280 70 260 110" stroke-width="1.8"/>
                    <path d="M325 25 C295 22 270 30 250 45" stroke-width="1.4"/>
                    <path d="M310 45 C285 45 260 60 240 80" stroke-width="1.4"/>
                    <path d="M295 70 C275 75 255 95 240 115" stroke-width="1.4"/>
                </g>
                <defs>
                    <linearGradient id="bottomRightSwooshGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff4500"/>
                        <stop offset="70%" stop-color="#ff6600"/>
                        <stop offset="100%" stop-color="#ff8c1a"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header Container -->
            <div class="text-center flex flex-col items-center">
                <!-- Eyebrow Badge: — VÌ SAO CHỌN CHÚNG TÔI — -->
                <div class="why-us-badge-wrapper">
                    <span class="why-us-badge-line"></span>
                    <span class="why-us-badge-pill">VÌ SAO CHỌN CHÚNG TÔI</span>
                    <span class="why-us-badge-line"></span>
                </div>
                
                <!-- Main Heading: Dịch Vụ Chụp Ảnh TeamBuilding -->
                <h2 class="why-us-title">
                    Dịch Vụ Chụp Ảnh <span class="why-us-title-highlight">TeamBuilding</span>
                </h2>

                <!-- Subtitle with Organic Curved Underline -->
                <div class="flex flex-col items-center justify-center">
                    <p class="why-us-subtitle">
                        Không chỉ là ghi hình, mà là lưu giữ những khoảnh khắc<br class="hidden sm:inline">
                        kết nối, lan tỏa tinh thần đồng đội.
                    </p>
                    <svg width="220" height="16" viewBox="0 0 220 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto mt-1 block">
                        <path d="M6 13C65 3.5 155 3.5 214 13C160 5 70 5 6 13Z" fill="#ff5400"/>
                    </svg>
                </div>
            </div>

            <!-- 4 Feature Cards Grid -->
            <div class="why-us-grid">
                
                <!-- Card 1: Bắt trọn khoảnh khắc -->
                <div class="why-us-card group">
                    <!-- Floating Top Circular Icon Badge -->
                    <div class="why-us-icon-badge">
                        <div class="why-us-icon-inner">
                            <!-- 3 Sparks radiating from camera top (matching mockup) -->
                            <svg class="absolute -top-1 w-6 h-3 text-white" viewBox="0 0 24 12" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                                <line x1="5" y1="10" x2="2" y2="3"/>
                                <line x1="12" y1="9" x2="12" y2="1"/>
                                <line x1="19" y1="10" x2="22" y2="3"/>
                            </svg>
                            <span class="material-symbols-outlined text-[32px] leading-none text-white mt-1">photo_camera</span>
                        </div>
                    </div>
                    
                    <h3 class="why-us-card-title">
                        Bắt trọn<br>khoảnh khắc
                    </h3>
                    <p class="why-us-card-desc">
                        Lưu giữ những khoảnh khắc tự nhiên, chân thực và đầy cảm xúc.
                    </p>
                    <div class="why-us-card-dash"></div>
                </div>

                <!-- Card 2: Đội ngũ chuyên nghiệp -->
                <div class="why-us-card group">
                    <div class="why-us-icon-badge">
                        <div class="why-us-icon-inner">
                            <span class="material-symbols-outlined text-[34px] leading-none text-white">groups</span>
                        </div>
                    </div>
                    
                    <h3 class="why-us-card-title">
                        Đội ngũ<br>chuyên nghiệp
                    </h3>
                    <p class="why-us-card-desc">
                        Nhiếp ảnh gia giàu kinh nghiệm, hiểu rõ từng góc bấm đỉnh cao sự kiện.
                    </p>
                    <div class="why-us-card-dash"></div>
                </div>

                <!-- Card 3: Chỉnh sửa tinh tế -->
                <div class="why-us-card group">
                    <div class="why-us-icon-badge">
                        <div class="why-us-icon-inner">
                            <span class="material-symbols-outlined text-[34px] leading-none text-white">bolt</span>
                        </div>
                    </div>
                    
                    <h3 class="why-us-card-title">
                        Chỉnh sửa<br>tinh tế
                    </h3>
                    <p class="why-us-card-desc">
                        Hình ảnh sắc nét, màu sắc sống động, đúng tinh thần chương trình.
                    </p>
                    <div class="why-us-card-dash"></div>
                </div>

                <!-- Card 4: Giao ảnh nhanh -->
                <div class="why-us-card group">
                    <div class="why-us-icon-badge">
                        <div class="why-us-icon-inner">
                            <span class="material-symbols-outlined text-[32px] leading-none text-white">photo_library</span>
                        </div>
                    </div>
                    
                    <h3 class="why-us-card-title">
                        Giao ảnh nhanh
                    </h3>
                    <p class="why-us-card-desc">
                        Hoàn thiện và bàn giao đúng hẹn, đáp ứng mọi nhu cầu.
                    </p>
                    <div class="why-us-card-dash"></div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 2: KHOẢNH KHẮC TEAMBUILDING
         Thiết kế chuẩn xác theo Mockup (Collage 5 ảnh + Decor hè + Handwriting callout)
         ========================================== -->
    <section class="py-14 sm:py-20 bg-white relative overflow-hidden">
        
        <!-- Top Right Decor: Palm Frond Watermark (Image 1) -->
        <div class="absolute top-0 right-0 w-64 sm:w-80 h-64 sm:h-80 pointer-events-none select-none opacity-20 overflow-hidden" aria-hidden="true">
            <svg viewBox="0 0 200 200" class="w-full h-full text-orange-400" fill="currentColor">
                <path d="M190,10 C150,15 120,40 100,75 C90,60 80,45 60,35 C80,55 90,75 95,95 C75,85 55,80 30,85 C55,95 75,105 90,115 C70,120 45,135 25,155 C50,145 75,135 95,130 C85,150 70,170 50,190 C75,175 95,155 105,135 C115,155 130,175 150,190 C135,165 125,145 120,125 C140,140 165,150 190,155 C165,135 145,120 130,110 C150,105 175,100 195,95 C170,85 150,80 135,80 C155,65 175,45 190,10 Z" opacity="0.35"/>
            </svg>
        </div>

        <!-- Bottom Left Decor: Organic Soft Orange Wave Swoosh (Image 1) -->
        <div class="absolute -bottom-16 -left-16 w-56 sm:w-72 h-56 sm:h-72 rounded-full pointer-events-none opacity-25"
             style="background: radial-gradient(circle, #ff7a1a 0%, #ff5400 50%, transparent 75%);" aria-hidden="true"></div>

        <!-- Bottom Right Decor: Orange Dot Grid (Exact to Image 1) -->
        <div class="absolute bottom-6 right-6 sm:bottom-10 sm:right-12 pointer-events-none select-none opacity-40 z-0" aria-hidden="true">
            <div class="grid grid-cols-8 gap-2">
                @for($i = 0; $i < 24; $i++)
                    <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400] inline-block"></span>
                @endfor
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- 3 Radiating Sunburst Spark Lines (Positioned cleanly on top-right of container as in Image 1) -->
            <div class="decor-sparks-topright" aria-hidden="true">
                <svg viewBox="0 0 40 40" class="w-8 sm:w-10 h-8 sm:h-10" fill="none">
                    <!-- Left spark -->
                    <line x1="10" y1="30" x2="18" y2="20" stroke="#ff5400" stroke-width="3.5" stroke-linecap="round" />
                    <!-- Center spark -->
                    <line x1="20" y1="8" x2="20" y2="22" stroke="#ff5400" stroke-width="3.5" stroke-linecap="round" />
                    <!-- Right spark -->
                    <line x1="30" y1="30" x2="22" y2="20" stroke="#ff5400" stroke-width="3.5" stroke-linecap="round" />
                </svg>
            </div>
            
            <!-- Section Header: Badge + Line + 2-Line Bold Heading + Handwriting Callout (Image 1 & Image 2) -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 sm:mb-12">
                <div>
                    <!-- Badge Icon [📷] + Orange Line (Exact to Image 1) -->
                    <div class="flex items-center gap-3 mb-4">
                        <span class="camera-badge-pill">
                            <span class="material-symbols-outlined" style="font-size: 19px !important; color: #ffffff !important;">photo_camera</span>
                        </span>
                        <span class="camera-badge-line"></span>
                    </div>

                    <!-- 2-Line Bold Heading (Exact to Image 1) -->
                    <h2 class="text-3xl sm:text-4xl lg:text-[44px] font-black tracking-tight leading-[1.12] text-[#0f172a]">
                        Khoảnh Khắc<br>
                        <span style="color: #ff5400;">TeamBuilding</span>
                    </h2>
                </div>

                <!-- Handwriting Callout & Hand-drawn Arrow (Exact to Image 2) -->
                <div class="hidden md:flex flex-col items-center pointer-events-none select-none -rotate-3 mb-2" 
                     style="font-family: 'Caveat', cursive; color: #ff5400;">
                    <span class="text-xl sm:text-2xl font-bold leading-tight tracking-wide text-center">
                        Bắt trọn năng lượng<br>
                        &amp; gắn kết đồng đội
                    </span>
                    <!-- Underline -->
                    <svg class="w-32 h-2 -mt-0.5" viewBox="0 0 120 8" fill="none">
                        <path d="M2 5 Q 60 1, 118 4" stroke="#ff5400" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    <!-- Curved Hand-drawn Arrow pointing down to the photo gallery -->
                    <svg class="w-8 h-9 mt-1 ml-6 -rotate-6" viewBox="0 0 35 40" fill="none">
                        <path d="M22 2 Q 26 18, 10 32" stroke="#ff5400" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M7 24 L 10 32 L 18 29" stroke="#ff5400" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- 5 Photos Grid Layout (Exact to Image 1: Left 50% + Right 2x2 50%) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-stretch">
                
                <!-- Left: 1 Large Main Photo (span 6 cols) -->
                <div class="lg:col-span-6 img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3] lg:aspect-auto h-full min-h-[320px] lg:min-h-[440px]"
                     @click="openPreview('{{ asset('images/chup-anh-teambuilding/team_arms_ocean.png') }}', 'Đoàn Kết Vươn Xa • Team Building Bãi Biển')">
                    <img src="{{ asset('images/chup-anh-teambuilding/team_arms_ocean.png') }}" 
                         alt="Đoàn Kết Vươn Xa • Team Building Bãi Biển" 
                         class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-5">
                        <span class="text-white text-xs sm:text-sm font-bold flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px]">zoom_in</span> Xem phóng to
                        </span>
                    </div>
                </div>

                <!-- Right: 2x2 Grid of 4 Photos (span 6 cols) -->
                <div class="lg:col-span-6 grid grid-cols-2 gap-4 sm:gap-6">
                    <!-- Top-Left: Đẩy bóng khổng lồ -->
                    <div class="img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3]"
                         @click="openPreview('{{ asset('images/chup-anh-teambuilding/giant_ball_game.png') }}', 'Trò Chơi Bóng Khổng Lồ Bãi Biển')">
                        <img src="{{ asset('images/chup-anh-teambuilding/giant_ball_game.png') }}" 
                             alt="Trò Chơi Bóng Khổng Lồ Bãi Biển" 
                             class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-4">
                            <span class="text-white text-xs font-bold flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">zoom_in</span> Đua bóng khổng lồ
                            </span>
                        </div>
                    </div>

                    <!-- Top-Right: Reo hò cờ chiến thắng -->
                    <div class="img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3]"
                         @click="openPreview('{{ asset('images/chup-anh-teambuilding/team_cheer_flag.png') }}', 'Reo Hò Chiến Thắng Đội Ngũ')">
                        <img src="{{ asset('images/chup-anh-teambuilding/team_cheer_flag.png') }}" 
                             alt="Reo Hò Chiến Thắng Đội Ngũ" 
                             class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-4">
                            <span class="text-white text-xs font-bold flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">zoom_in</span> Cờ chiến thắng
                            </span>
                        </div>
                    </div>

                    <!-- Bottom-Left: Vòng tròn đặt tay đồng lòng -->
                    <div class="img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3]"
                         @click="openPreview('{{ asset('images/chup-anh-teambuilding/hands_stacked_circle.png') }}', 'Đồng Lòng Quyết Tâm • One Team One Dream')">
                        <img src="{{ asset('images/chup-anh-teambuilding/hands_stacked_circle.png') }}" 
                             alt="Đồng Lòng Quyết Tâm • One Team One Dream" 
                             class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-4">
                            <span class="text-white text-xs font-bold flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">zoom_in</span> Chung một mục tiêu
                            </span>
                        </div>
                    </div>

                    <!-- Bottom-Right: Nhảy biển teambuilding Cửu Long -->
                    <div class="img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3]"
                         @click="openPreview('{{ asset('images/chup-anh-teambuilding/team_jump_beach.png') }}', 'Khoảnh Khắc Bùng Nổ Năng Lượng')">
                        <img src="{{ asset('images/chup-anh-teambuilding/team_jump_beach.png') }}" 
                             alt="Khoảnh Khắc Bùng Nổ Năng Lượng" 
                             class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-4">
                            <span class="text-white text-xs font-bold flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">zoom_in</span> Bứt phá giới hạn
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 3: VÌ SAO CHỌN CHÚNG TÔI (DARK SECTION)
         4 Cards đen mờ bo tròn nổi bật
         ========================================== -->
    <section class="py-16 sm:py-20 relative bg-dark-section text-white overflow-hidden border-t border-b border-white/5" 
             style="background-color: #070d18 !important;">
        
        <!-- Subtle dark backdrop pattern -->
        <div class="absolute inset-0 opacity-15 pointer-events-none"
             style="background-image: radial-gradient(#ff5400 1px, transparent 1px); background-size: 24px 24px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 sm:mb-12">
                <div class="text-left">
                    <span class="badge-teambuilding-dark">DỊCH VỤ CHỤP ẢNH TEAMBUILDING</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight mt-3">
                        Vì Sao Chọn Chúng Tôi
                    </h2>
                </div>

                <!-- Handwriting Callout & Hand-drawn Arrow (Image 2 style) -->
                <div class="hidden md:flex flex-col items-center pointer-events-none select-none -rotate-3 mb-2" 
                     style="font-family: 'Caveat', cursive; color: #ff7a1a;">
                    <span class="text-xl sm:text-2xl font-bold leading-tight tracking-wide text-center">
                        Cam kết chất lượng<br>
                        &amp; dịch vụ tận tâm
                    </span>
                    <svg class="w-32 h-2 -mt-0.5" viewBox="0 0 120 8" fill="none">
                        <path d="M2 5 Q 60 1, 118 4" stroke="#ff7a1a" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    <svg class="w-8 h-9 mt-1 ml-6 -rotate-6" viewBox="0 0 35 40" fill="none">
                        <path d="M22 2 Q 26 18, 10 32" stroke="#ff7a1a" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M7 24 L 10 32 L 18 29" stroke="#ff7a1a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- 4 Dark Glass Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
                
                <!-- Card 1: Kinh nghiệm thực chiến -->
                <div class="card-dark-glass rounded-2xl p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl text-[#ff5400] flex items-center justify-center mb-5 group-hover:bg-[#ff5400] group-hover:text-white transition-all"
                             style="background: rgba(255, 84, 0, 0.12); border: 1px solid rgba(255, 84, 0, 0.3);">
                            <span class="material-symbols-outlined text-[24px]">star</span>
                        </div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Kinh nghiệm thực chiến
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2.5 leading-relaxed">
                            Đã đồng hành cùng nhiều thương hiệu lớn nhỏ trong các chương trình team building.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Trang thiết bị hiện đại -->
                <div class="card-dark-glass rounded-2xl p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl text-[#ff5400] flex items-center justify-center mb-5 group-hover:bg-[#ff5400] group-hover:text-white transition-all"
                             style="background: rgba(255, 84, 0, 0.12); border: 1px solid rgba(255, 84, 0, 0.3);">
                            <span class="material-symbols-outlined text-[24px]">photo_camera</span>
                        </div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Trang thiết bị hiện đại
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2.5 leading-relaxed">
                            Sử dụng máy ảnh, ống kính chuyên dụng, Flycam (tùy nhu cầu).
                        </p>
                    </div>
                </div>

                <!-- Card 3: Phong cách linh hoạt -->
                <div class="card-dark-glass rounded-2xl p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl text-[#ff5400] flex items-center justify-center mb-5 group-hover:bg-[#ff5400] group-hover:text-white transition-all"
                             style="background: rgba(255, 84, 0, 0.12); border: 1px solid rgba(255, 84, 0, 0.3);">
                            <span class="material-symbols-outlined text-[24px]">diversity_3</span>
                        </div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Phong cách linh hoạt
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2.5 leading-relaxed">
                            Bắt trọn cả những khoảnh khắc ngẫu hứng lẫn những shot hình được dàn dựng.
                        </p>
                    </div>
                </div>

                <!-- Card 4: Chất lượng hình ảnh cao -->
                <div class="card-dark-glass rounded-2xl p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl text-[#ff5400] flex items-center justify-center mb-5 group-hover:bg-[#ff5400] group-hover:text-white transition-all"
                             style="background: rgba(255, 84, 0, 0.12); border: 1px solid rgba(255, 84, 0, 0.3);">
                            <span class="material-symbols-outlined text-[24px]">high_quality</span>
                        </div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Chất lượng hình ảnh cao
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2.5 leading-relaxed">
                            Ảnh sắc nét, màu sắc chân thực, phù hợp cho truyền thông nội bộ và marketing.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 4: MỘT SỐ HÌNH ẢNH TEAMBUILDING (DỰ ÁN TIÊU BIỂU)
         Thiết kế chuẩn xác theo Mockup (3 Cột ảnh + Decor hè + Máy bay giấy + Handwriting)
         ========================================== -->
    <section class="py-14 sm:py-20 bg-white relative overflow-hidden">
        
        <!-- Top Right Decor: Palm Frond Watermark (Image 1) -->
        <div class="absolute top-0 right-0 w-64 sm:w-80 h-64 sm:h-80 pointer-events-none select-none opacity-20 overflow-hidden" aria-hidden="true">
            <svg viewBox="0 0 200 200" class="w-full h-full text-orange-400" fill="currentColor">
                <path d="M190,10 C150,15 120,40 100,75 C90,60 80,45 60,35 C80,55 90,75 95,95 C75,85 55,80 30,85 C55,95 75,105 90,115 C70,120 45,135 25,155 C50,145 75,135 95,130 C85,150 70,170 50,190 C75,175 95,155 105,135 C115,155 130,175 150,190 C135,165 125,145 120,125 C140,140 165,150 190,155 C165,135 145,120 130,110 C150,105 175,100 195,95 C170,85 150,80 135,80 C155,65 175,45 190,10 Z" opacity="0.35"/>
            </svg>
        </div>

        <!-- Bottom Left Decor: Organic Soft Orange Wave Swoosh (Image 1) -->
        <div class="absolute -bottom-16 -left-16 w-56 sm:w-72 h-56 sm:h-72 rounded-full pointer-events-none opacity-25"
             style="background: radial-gradient(circle, #ff7a1a 0%, #ff5400 50%, transparent 75%);" aria-hidden="true"></div>

        <!-- Bottom Right Decor: Orange Dot Grid (Exact to Image 1) -->
        <div class="absolute bottom-6 right-6 sm:bottom-10 sm:right-12 pointer-events-none select-none opacity-40 z-0" aria-hidden="true">
            <div class="grid grid-cols-8 gap-2">
                @for($i = 0; $i < 24; $i++)
                    <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400] inline-block"></span>
                @endfor
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Orange Paper Airplane with Dashed Flight Path (Positioned on top-right of container) -->
            <div class="decor-plane-topright" aria-hidden="true">
                <svg viewBox="0 0 160 80" class="w-32 sm:w-44 h-auto" fill="none">
                    <!-- Dashed flight curve -->
                    <path d="M8 68 Q 50 62, 80 42 T 132 18" stroke="#ff5400" stroke-width="2" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <!-- Origami paper airplane -->
                    <g transform="translate(126, 6) rotate(16)">
                        <polygon points="0,22 28,0 24,24 12,18" fill="none" stroke="#ff5400" stroke-width="2.2" stroke-linejoin="round"/>
                        <line x1="28" y1="0" x2="12" y2="18" stroke="#ff5400" stroke-width="2.2" stroke-linecap="round"/>
                    </g>
                </svg>
            </div>
            
            <!-- Section Header: Camera Icon + Line + Badge + Title + Handwriting Callout (Image 1 & Image 2) -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 sm:mb-12">
                <div>
                    <!-- Camera Icon [📷] + Orange Line (Image 1) -->
                    <div class="flex items-center gap-3 mb-3">
                        <span class="camera-badge-pill">
                            <span class="material-symbols-outlined" style="font-size: 19px !important; color: #ffffff !important;">photo_camera</span>
                        </span>
                        <span class="camera-badge-line"></span>
                    </div>

                    <!-- Retained text: DỰ ÁN TIÊU BIỂU & Một Số Hình Ảnh TeamBuilding -->
                    <span class="badge-teambuilding">DỰ ÁN TIÊU BIỂU</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight leading-[1.15] text-[#0f172a] mt-2">
                        Một Số Hình Ảnh <span style="color: #ff5400;">TeamBuilding</span>
                    </h2>
                </div>

                <!-- Handwriting Callout & Hand-drawn Arrow (Exact to Image 2) -->
                <div class="hidden md:flex flex-col items-center pointer-events-none select-none -rotate-2 mb-2" 
                     style="font-family: 'Caveat', cursive; color: #ff5400;">
                    <span class="text-xl sm:text-2xl font-bold leading-tight tracking-wide text-center">
                        Năng lượng bùng nổ<br>
                        trong từng khoảnh khắc
                    </span>
                    <!-- Underline -->
                    <svg class="w-36 h-2 mt-0.5" viewBox="0 0 140 8" fill="none">
                        <path d="M4 5 Q 70 2, 136 4" stroke="#ff5400" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    <!-- Curved Arrow pointing down -->
                    <svg class="w-7 h-9 mt-1" viewBox="0 0 25 35" fill="none">
                        <path d="M12 2 Q 15 16, 12 28" stroke="#ff5400" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M6 22 L 12 28 L 18 22" stroke="#ff5400" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- 3 Columns Showcase Grid (Exact to Image 1: Left 50% + Mid 25% + Right 25%) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-stretch">
                
                <!-- Col 1: Large Wide Photo (span 6 cols) - Đua bóng khổng lồ bãi biển -->
                <div class="lg:col-span-6 img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3] lg:aspect-auto h-full min-h-[320px] lg:min-h-[440px]"
                     @click="openPreview('{{ asset('images/chup-anh-teambuilding/giant_ball_game.png') }}', 'Team Building Bãi Biển • Sôi Nổi Hào Hứng')">
                    <img src="{{ asset('images/chup-anh-teambuilding/giant_ball_game.png') }}" 
                         alt="Team Building Bãi Biển • Sôi Nổi Hào Hứng" 
                         class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-5">
                        <span class="text-white text-xs sm:text-sm font-bold flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px]">zoom_in</span> Xem phóng to
                        </span>
                    </div>
                </div>

                <!-- Col 2: 2 Stacked Photos (span 3 cols) -->
                <div class="lg:col-span-3 flex flex-col justify-between gap-4 sm:gap-6">
                    <!-- Top: Vòng tròn đặt tay ngửa mặt nhìn trời -->
                    <div class="img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3]"
                         @click="openPreview('{{ asset('images/chup-anh-teambuilding/hands_stacked_circle.png') }}', 'Tinh Thần Chiến Binh • Quyết Tâm Về Đích')">
                        <img src="{{ asset('images/chup-anh-teambuilding/hands_stacked_circle.png') }}" 
                             alt="Tinh Thần Chiến Binh • Quyết Tâm Về Đích" 
                             class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-4">
                            <span class="text-white text-xs font-bold flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">zoom_in</span> Đồng lòng hướng đích
                            </span>
                        </div>
                    </div>

                    <!-- Bottom: Hoạt động teambuilding thi đua trên cỏ -->
                    <div class="img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[4/3]"
                         @click="openPreview('{{ asset('images/chup-anh-teambuilding/hero_teambuilding.png') }}', 'Tập Thể Gắn Kết • Kỷ Niệm Đáng Nhớ')">
                        <img src="{{ asset('images/chup-anh-teambuilding/hero_teambuilding.png') }}" 
                             alt="Tập Thể Gắn Kết • Kỷ Niệm Đáng Nhớ" 
                             class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-4">
                            <span class="text-white text-xs font-bold flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">zoom_in</span> Gắn kết đoàn thể
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Col 3: Tall Victory Flag Photo (span 3 cols) -->
                <div class="lg:col-span-3 img-hover-zoom rounded-2xl sm:rounded-3xl shadow-sm border border-slate-100 cursor-pointer relative group aspect-[3/4] lg:aspect-auto h-full min-h-[320px] lg:min-h-[440px]"
                     @click="openPreview('{{ asset('images/chup-anh-teambuilding/team_cheer_flag.png') }}', 'Giương Cao Cờ Chiến Thắng')">
                    <img src="{{ asset('images/chup-anh-teambuilding/team_cheer_flag.png') }}" 
                         alt="Giương Cao Cờ Chiến Thắng" 
                         class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl sm:rounded-3xl flex items-end p-5">
                        <span class="text-white text-xs sm:text-sm font-bold flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px]">zoom_in</span> Khí thế bừng cháy
                        </span>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 5: QUY TRÌNH CHỤP ẢNH TEAMBUILDING (DARK ROADMAP)
         ========================================== -->
    <section class="py-16 sm:py-20 bg-dark-section text-white relative border-t border-b border-white/5"
             style="background-color: #070d18 !important;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="relative max-w-3xl mx-auto text-center mb-12 sm:mb-16">
                <span class="badge-teambuilding-dark">QUY TRÌNH LÀM VIỆC</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight mt-3">
                    Quy Trình Chụp Ảnh TeamBuilding
                </h2>

                <!-- Handwriting Callout & Hand-drawn Arrow (Image 2 style) -->
                <div class="hidden lg:flex flex-col items-center absolute -right-20 top-0 pointer-events-none select-none -rotate-6" 
                     style="font-family: 'Caveat', cursive; color: #ff7a1a;">
                    <span class="text-xl sm:text-2xl font-bold leading-tight tracking-wide text-center">
                        Rõ ràng &amp; chuyên nghiệp<br>
                        từ đầu đến cuối
                    </span>
                    <svg class="w-32 h-2 -mt-0.5" viewBox="0 0 120 8" fill="none">
                        <path d="M2 5 Q 60 1, 118 4" stroke="#ff7a1a" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    <svg class="w-8 h-9 mt-1 mr-6 rotate-12" viewBox="0 0 35 40" fill="none">
                        <path d="M12 2 Q 10 18, 25 32" stroke="#ff7a1a" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M28 24 L 25 32 L 17 29" stroke="#ff7a1a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- 4 Steps Connected Roadmap -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 relative">
                
                <!-- Step 01 -->
                <div class="relative rounded-2xl p-6 transition-all flex flex-col justify-between group"
                     style="background-color: #0e1726 !important; border: 1px solid rgba(255, 255, 255, 0.08) !important;">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-8 h-8 rounded-full font-mono font-bold text-xs flex items-center justify-center text-white"
                              style="background: #ff5400; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.4);">
                            01
                        </span>
                        <div class="w-10 h-10 rounded-xl text-[#ff5400] flex items-center justify-center"
                             style="background: rgba(255, 84, 0, 0.12);">
                            <span class="material-symbols-outlined text-[20px]">chat</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Tư vấn &amp; báo giá
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2 leading-relaxed">
                            Lắng nghe nhu cầu, tư vấn gói chụp phù hợp nhất với quy mô sự kiện.
                        </p>
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="relative rounded-2xl p-6 transition-all flex flex-col justify-between group"
                     style="background-color: #0e1726 !important; border: 1px solid rgba(255, 255, 255, 0.08) !important;">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-8 h-8 rounded-full font-mono font-bold text-xs flex items-center justify-center text-white"
                              style="background: #ff5400; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.4);">
                            02
                        </span>
                        <div class="w-10 h-10 rounded-xl text-[#ff5400] flex items-center justify-center"
                             style="background: rgba(255, 84, 0, 0.12);">
                            <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Ký hợp đồng
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2 leading-relaxed">
                            Thống nhất lịch trình, địa điểm, phương án chụp và yêu cầu cụ thể.
                        </p>
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="relative rounded-2xl p-6 transition-all flex flex-col justify-between group"
                     style="background-color: #0e1726 !important; border: 1px solid rgba(255, 255, 255, 0.08) !important;">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-8 h-8 rounded-full font-mono font-bold text-xs flex items-center justify-center text-white"
                              style="background: #ff5400; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.4);">
                            03
                        </span>
                        <div class="w-10 h-10 rounded-xl text-[#ff5400] flex items-center justify-center"
                             style="background: rgba(255, 84, 0, 0.12);">
                            <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Thực hiện chụp ảnh
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2 leading-relaxed">
                            Nhiếp ảnh gia tác nghiệp chuyên nghiệp, lăn xả và linh hoạt theo từng game.
                        </p>
                    </div>
                </div>

                <!-- Step 04 -->
                <div class="relative rounded-2xl p-6 transition-all flex flex-col justify-between group"
                     style="background-color: #0e1726 !important; border: 1px solid rgba(255, 255, 255, 0.08) !important;">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-8 h-8 rounded-full font-mono font-bold text-xs flex items-center justify-center text-white"
                              style="background: #ff5400; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.4);">
                            04
                        </span>
                        <div class="w-10 h-10 rounded-xl text-[#ff5400] flex items-center justify-center"
                             style="background: rgba(255, 84, 0, 0.12);">
                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white group-hover:text-[#ff5400] transition-colors">
                            Bàn giao &amp; thanh toán
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-300 mt-2 leading-relaxed">
                            Giao ảnh đúng hạn qua Drive/Cloud, hỗ trợ chỉnh sửa theo yêu cầu phát sinh.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 6: CÁC GÓI CHỤP ẢNH TEAMBUILDING (PRICING PACKAGES)
         Thiết kế chuẩn xác 100% theo Mockup ảnh đính kèm
         ========================================== -->
    <section class="pkg-section">
        <!-- Top-Right Tropical Palm Watermark Accent -->
        <div class="absolute top-0 right-0 w-64 sm:w-80 h-64 sm:h-80 pointer-events-none select-none overflow-hidden opacity-30 sm:opacity-40" aria-hidden="true">
            <svg viewBox="0 0 240 240" fill="none" class="w-full h-full text-orange-400">
                <g stroke="#ff7a1a" stroke-linecap="round" opacity="0.6">
                    <path d="M240 0 C180 50 120 120 70 230" stroke-width="2.5"/>
                    <path d="M210 25 C160 15 110 25 70 50" stroke-width="2"/>
                    <path d="M195 50 C145 45 100 60 55 90" stroke-width="2"/>
                    <path d="M175 80 C130 80 85 105 45 140" stroke-width="2"/>
                    <path d="M150 115 C110 125 70 155 35 195" stroke-width="2"/>
                </g>
            </svg>
        </div>

        <!-- Top-Left Soft Warm Glow -->
        <div class="absolute -top-16 -left-16 w-64 h-64 rounded-full pointer-events-none opacity-20"
             style="background: radial-gradient(circle, #ff7a1a 0%, #ff5400 45%, transparent 75%);" aria-hidden="true"></div>

        <!-- Bottom-Left Soft Ribbon Swoosh -->
        <div class="absolute -bottom-10 -left-10 w-72 h-36 pointer-events-none opacity-25" aria-hidden="true">
            <svg viewBox="0 0 280 120" fill="none" class="w-full h-full">
                <path d="M-10 120 L-10 70 C60 60 150 40 280 100 L280 120 Z" fill="#ff7a1a"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header Row: Title + Divider + Description + Handwriting Callout -->
            <div class="pkg-header-row">
                <div class="text-left">
                    <!-- Eyebrow Pill -->
                    <div class="pkg-eyebrow">
                        <span class="pkg-eyebrow-icon">
                            <span class="material-symbols-outlined text-[15px]">photo_camera</span>
                        </span>
                        <span class="pkg-eyebrow-text">GÓI DỊCH VỤ</span>
                    </div>

                    <div class="pkg-title-group">
                        <h2 class="pkg-title">
                            Các Gói Chụp Ảnh<br>
                            <span class="pkg-title-highlight">TeamBuilding</span>
                        </h2>

                        <!-- Vertical Orange Divider Line -->
                        <div class="pkg-divider-line"></div>

                        <!-- Header Description -->
                        <p class="pkg-subtitle">
                            Ghi lại trọn vẹn những khoảnh khắc<br class="hidden sm:inline">
                            đoàn kết, năng lượng và tinh thần đồng đội<br class="hidden sm:inline">
                            của doanh nghiệp bạn.
                        </p>
                    </div>
                </div>

                <!-- Handwriting Callout (Top-Right) -->
                <div class="hidden lg:flex flex-col items-center select-none pointer-events-none -rotate-2 mb-2">
                    <span class="text-2xl lg:text-[27px] font-bold leading-tight tracking-wide text-center" 
                          style="font-family: 'Caveat', cursive; color: #ff5400;">
                        Khoảnh khắc đẹp<br>
                        Tạo nên giá trị bền vững
                    </span>
                    <svg class="w-36 h-2.5 -mt-0.5" viewBox="0 0 140 10" fill="none">
                        <path d="M2 6 Q 70 1, 138 6" stroke="#ff5400" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <!-- 3 Package Cards Grid -->
            <div class="pkg-cards-grid">
                
                <!-- Package 1: Gói Cơ Bản -->
                <div class="pkg-card group">
                    <!-- Top Image Container with Badge -->
                    <div class="pkg-card-img-wrap">
                        <img src="{{ asset('images/chup-anh-teambuilding/team_arms_ocean.png') }}" 
                             alt="Gói Cơ Bản - Chụp ảnh TeamBuilding" 
                             class="w-full h-full object-cover">
                        <!-- Floating Badge on Image -->
                        <div class="pkg-badge-dark">
                            <div class="pkg-badge-icon-sq">
                                <span class="material-symbols-outlined text-[14px]">photo_camera</span>
                            </div>
                            <div>
                                <div class="pkg-badge-text-title">GÓI CƠ BẢN</div>
                                <div class="pkg-badge-text-sub">Lưu giữ những khoảnh khắc đẹp</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body (Dark Section) -->
                    <div class="pkg-card-body">
                        <div class="pkg-card-title">
                            <span class="pkg-card-title-slash">/</span> Gói Cơ Bản
                        </div>
                        <p class="pkg-card-desc">
                            Phù hợp cho các chương trình nhỏ, trong ngày.
                        </p>

                        <ul class="pkg-card-list">
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Chụp ảnh theo thời gian yêu cầu</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Chỉnh sửa ảnh cơ bản</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Giao ảnh online nhanh chóng</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Card Footer (White Background Strip) -->
                    <div class="pkg-card-footer">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn Gói Cơ Bản Chụp Ảnh Teambuilding') }}" 
                           target="_blank"
                           class="pkg-btn-cta pkg-btn-cta-orange">
                            <span>Liên hệ tư vấn</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>

                        <div class="pkg-price-col">
                            <div class="pkg-price-camera-icon">
                                <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                            </div>
                            <div>
                                <div class="pkg-price-label">Ảnh đẹp</div>
                                <div class="pkg-price-value">Liên hệ báo giá</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 2: Gói Nâng Cao (Highlight/Featured Card) -->
                <div class="pkg-card pkg-card-featured group">
                    <!-- Top Image Container with Featured Badge -->
                    <div class="pkg-card-img-wrap">
                        <img src="{{ asset('images/chup-anh-teambuilding/hero_teambuilding.png') }}" 
                             alt="Gói Nâng Cao - Chụp ảnh TeamBuilding" 
                             class="w-full h-full object-cover">
                        <!-- Featured Badge -->
                        <div class="pkg-badge-featured">
                            <span>★</span> GÓI ĐƯỢC CHỌN NHIỀU NHẤT
                        </div>
                    </div>

                    <!-- Card Body (Dark Section) -->
                    <div class="pkg-card-body">
                        <div class="pkg-card-title">
                            <span class="pkg-card-title-slash">/</span> Gói Nâng Cao
                        </div>
                        <p class="pkg-card-desc">
                            Dành cho các sự kiện quy mô vừa và lớn.
                        </p>

                        <ul class="pkg-card-list">
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Chụp ảnh toàn bộ chương trình</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Chỉnh sửa ảnh chuyên sâu (Color Grading)</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Giao ảnh chất lượng cao 4K</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Hỗ trợ tư vấn concept &amp; kịch bản góc máy</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Card Footer (White Background Strip) -->
                    <div class="pkg-card-footer">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn Gói Nâng Cao Chụp Ảnh Teambuilding') }}" 
                           target="_blank"
                           class="pkg-btn-cta pkg-btn-cta-orange">
                            <span>Liên hệ tư vấn</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>

                        <div class="pkg-price-col">
                            <div class="pkg-price-camera-icon">
                                <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                            </div>
                            <div>
                                <div class="pkg-price-label">Ảnh đẹp</div>
                                <div class="pkg-price-value">Liên hệ báo giá</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 3: Gói Cao Cấp -->
                <div class="pkg-card group">
                    <!-- Top Image Container with Badge -->
                    <div class="pkg-card-img-wrap">
                        <img src="{{ asset('images/chup-anh-teambuilding/team_cheer_flag.png') }}" 
                             alt="Gói Cao Cấp - Chụp ảnh TeamBuilding" 
                             class="w-full h-full object-cover">
                        <!-- Floating Badge on Image -->
                        <div class="pkg-badge-dark">
                            <div class="pkg-badge-icon-sq">
                                <span class="material-symbols-outlined text-[14px]">workspace_premium</span>
                            </div>
                            <div>
                                <div class="pkg-badge-text-title">GÓI CAO CẤP</div>
                                <div class="pkg-badge-text-sub">Trải nghiệm khác biệt</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body (Dark Section) -->
                    <div class="pkg-card-body">
                        <div class="pkg-card-title">
                            <span class="pkg-card-title-slash">/</span> Gói Cao Cấp
                        </div>
                        <p class="pkg-card-desc">
                            Giải pháp toàn diện cho doanh nghiệp lớn, tổ chức sự kiện đặc biệt.
                        </p>

                        <ul class="pkg-card-list">
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Chụp ảnh &amp; Flycam toàn cảnh (nếu cần)</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Chỉnh sửa chuyên nghiệp từng shot hình</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Giao ảnh nhanh trong ngày</span>
                            </li>
                            <li class="pkg-card-list-item">
                                <span class="pkg-check-circle">✓</span>
                                <span>Hỗ trợ truyền thông đa nền tảng (Social Ready)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Card Footer (White Background Strip) -->
                    <div class="pkg-card-footer">
                        <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn Gói Cao Cấp Chụp Ảnh Teambuilding') }}" 
                           target="_blank"
                           class="pkg-btn-cta pkg-btn-cta-outline">
                            <span>Liên hệ tư vấn</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>

                        <div class="pkg-price-col">
                            <div class="pkg-price-camera-icon">
                                <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                            </div>
                            <div>
                                <div class="pkg-price-label">Ảnh đẹp</div>
                                <div class="pkg-price-value">Liên hệ báo giá</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Guarantee Trust Bar (4 Items) -->
            <div class="pkg-trust-bar">
                <div class="pkg-trust-item">
                    <span class="material-symbols-outlined">verified</span>
                    <span>Đội ngũ nhiếp ảnh gia chuyên nghiệp</span>
                </div>
                <div class="pkg-trust-item">
                    <span class="material-symbols-outlined">photo_camera</span>
                    <span>Trang thiết bị hiện đại</span>
                </div>
                <div class="pkg-trust-item">
                    <span class="material-symbols-outlined">bolt</span>
                    <span>Xử lý ảnh nhanh chóng</span>
                </div>
                <div class="pkg-trust-item">
                    <span class="material-symbols-outlined">favorite</span>
                    <span>Tận tâm – Uy tín – Chất lượng</span>
                </div>
            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 7: KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI (TESTIMONIALS)
         Thiết kế chuẩn xác 100% theo Mockup ảnh đính kèm
         ========================================== -->
    <section class="testimonial-section">
        <!-- Panoramic Sunset Beach Teambuilding Background -->
        <div class="testimonial-bg-wrap">
            <img src="{{ asset('images/chup-anh-teambuilding/sunset_team_cheer.png') }}" 
                 alt="Hoàng hôn TeamBuilding" 
                 class="testimonial-bg-img">
            <div class="testimonial-bg-overlay"></div>
        </div>

        <!-- Decor Bottom-Left: Paint Splatter Sweep -->
        <div class="why-us-decor-bottomleft" style="z-index: 1;" aria-hidden="true">
            <svg viewBox="0 0 280 100" fill="none" class="w-full h-full">
                <path d="M-10 100 L-10 65 C50 55 130 45 270 95 L270 100 Z" fill="url(#testiBottomLeftGrad)"/>
                <path d="M-10 82 C60 70 140 68 230 100 Z" fill="#ff7a1a" opacity="0.8"/>
                <defs>
                    <linearGradient id="testiBottomLeftGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff4500"/>
                        <stop offset="100%" stop-color="#ff7a1a"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Decor Bottom-Right: Dynamic Ribbon Swoosh -->
        <div class="why-us-decor-bottomright" style="z-index: 1;" aria-hidden="true">
            <svg viewBox="0 0 340 130" fill="none" class="w-full h-full">
                <path d="M10 130 C110 95 210 50 340 25 L340 65 C230 85 140 115 50 130 Z" fill="url(#testiBottomRightGrad)"/>
                <defs>
                    <linearGradient id="testiBottomRightGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ff4500"/>
                        <stop offset="70%" stop-color="#ff6600"/>
                        <stop offset="100%" stop-color="#ff8c1a"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header Row: Title + Subtitle + Handwriting Callout -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div>
                    <!-- Eyebrow Pill -->
                    <div class="pkg-eyebrow">
                        <span class="pkg-eyebrow-icon">
                            <span class="material-symbols-outlined text-[15px]">format_quote</span>
                        </span>
                        <span class="pkg-eyebrow-text">KHÁCH HÀNG NÓI GÌ</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight leading-[1.18] text-[#0f172a]">
                        Khách Hàng Nói Gì Về<br>
                        <span class="text-[#ff5400]">Chúng Tôi</span>
                    </h2>
                    
                    <p class="text-sm sm:text-[15px] text-slate-600 font-medium leading-relaxed mt-2.5 max-w-xl">
                        Sự hài lòng của khách hàng là động lực để chúng tôi<br class="hidden sm:inline">
                        không ngừng hoàn thiện và phát triển.
                    </p>
                </div>

                <!-- Handwriting Callout (Center/Right in header) -->
                <div class="hidden lg:flex flex-col items-center select-none pointer-events-none -rotate-2 mb-2">
                    <span class="text-2xl lg:text-[27px] font-bold leading-tight tracking-wide text-center" 
                          style="font-family: 'Caveat', cursive; color: #ff5400;">
                        Đồng hành cùng<br>
                        thành công của bạn
                    </span>
                    <svg class="w-36 h-2.5 -mt-0.5" viewBox="0 0 140 10" fill="none">
                        <path d="M2 6 Q 70 1, 138 6" stroke="#ff5400" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <!-- 3 Testimonial Cards Grid -->
            <div class="testimonial-card-grid">
                
                <!-- Card 1: Anh Tuấn (Marketing Manager) -->
                <div class="testimonial-card group">
                    <!-- Left: Teambuilding Photo -->
                    <div class="testimonial-thumb-wrap">
                        <img src="{{ asset('images/chup-anh-teambuilding/team_jump_beach.png') }}" 
                             alt="Khách hàng trải nghiệm TeamBuilding" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Right: Content -->
                    <div class="testimonial-content-wrap">
                        <div>
                            <div class="testimonial-quote-icon">“</div>
                            <p class="testimonial-quote-text">
                                “Đội ngũ chuyên nghiệp, nhiệt tình và bắt trọn rất nhiều khoảnh khắc đẹp của công ty chúng tôi trong suốt chuyến đi. Ảnh chất lượng cao, đúng tinh thần của chương trình. Chúng tôi rất hài lòng!”
                            </p>
                        </div>

                        <!-- Author Row: Only Job Title, No Company Name (as requested) -->
                        <div class="testimonial-author-row">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" 
                                 alt="Anh Tuấn" 
                                 class="testimonial-author-avatar"
                                 onerror="this.src='https://ui-avatars.com/api/?name=Anh+Tuan&background=ff5400&color=fff&rounded=true'">
                            <div>
                                <div class="testimonial-author-name">
                                    <span>Anh Tuấn</span>
                                    <span class="testimonial-author-name-dash"></span>
                                </div>
                                <div class="testimonial-author-role">Marketing Manager</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Chị Lan (Giám đốc Marketing) - Featured Card -->
                <div class="testimonial-card testimonial-card-featured group">
                    <!-- Left: Teambuilding Photo -->
                    <div class="testimonial-thumb-wrap">
                        <img src="{{ asset('images/chup-anh-teambuilding/team_cheer_flag.png') }}" 
                             alt="Khách hàng trải nghiệm TeamBuilding" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Right: Content -->
                    <div class="testimonial-content-wrap">
                        <div>
                            <div class="testimonial-quote-icon">“</div>
                            <p class="testimonial-quote-text">
                                “Chất lượng hình ảnh tuyệt vời, bố cục rõ ràng, màu sắc sống động. Đội ngũ của các bạn rất chuyên nghiệp, hỗ trợ tận tình từ khâu chuẩn bị đến khi bàn giao sản phẩm. Chúng tôi sẽ tiếp tục hợp tác trong những chương trình sau!”
                            </p>
                        </div>

                        <!-- Author Row: Only Job Title, No Company Name (as requested) -->
                        <div class="testimonial-author-row">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=100&auto=format&fit=crop&q=80" 
                                 alt="Chị Lan" 
                                 class="testimonial-author-avatar"
                                 onerror="this.src='https://ui-avatars.com/api/?name=Chi+Lan&background=ff5400&color=fff&rounded=true'">
                            <div>
                                <div class="testimonial-author-name">
                                    <span>Chị Lan</span>
                                    <span class="testimonial-author-name-dash"></span>
                                </div>
                                <div class="testimonial-author-role">Giám đốc Marketing</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Anh Hoàng (CEO) -->
                <div class="testimonial-card group">
                    <!-- Left: Teambuilding Photo -->
                    <div class="testimonial-thumb-wrap">
                        <img src="{{ asset('images/chup-anh-teambuilding/hero_teambuilding.png') }}" 
                             alt="Khách hàng trải nghiệm TeamBuilding" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Right: Content -->
                    <div class="testimonial-content-wrap">
                        <div>
                            <div class="testimonial-quote-icon">“</div>
                            <p class="testimonial-quote-text">
                                “Hình ảnh sắc nét, màu sắc rực rỡ, bắt đúng tinh thần team building. Dịch vụ chuyên nghiệp, đúng tiến độ, giá cả hợp lý. Cảm ơn ekip Truyền Thông Cửu Long đã mang đến cho chúng tôi những khoảnh khắc đáng nhớ!”
                            </p>
                        </div>

                        <!-- Author Row: Only Job Title, No Company Name (as requested) -->
                        <div class="testimonial-author-row">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&auto=format&fit=crop&q=80" 
                                 alt="Anh Hoàng" 
                                 class="testimonial-author-avatar"
                                 onerror="this.src='https://ui-avatars.com/api/?name=Anh+Hoang&background=ff5400&color=fff&rounded=true'">
                            <div>
                                <div class="testimonial-author-name">
                                    <span>Anh Hoàng</span>
                                    <span class="testimonial-author-name-dash"></span>
                                </div>
                                <div class="testimonial-author-role">CEO</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Carousel Navigation Controls -->
            <div class="testimonial-nav-row">
                <button type="button" class="testimonial-nav-btn" aria-label="Khách hàng trước">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                </button>
                <div class="testimonial-nav-dots">
                    <span class="testimonial-dot active"></span>
                    <span class="testimonial-dot"></span>
                    <span class="testimonial-dot"></span>
                    <span class="testimonial-dot"></span>
                </div>
                <button type="button" class="testimonial-nav-btn" aria-label="Khách hàng tiếp theo">
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 8: CALL-TO-ACTION (VIBRANT ORANGE BAR)
         ========================================== -->
    <section class="w-full py-10 sm:py-12 relative overflow-hidden"
             style="background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%) !important;">
        
        <!-- Subtle camera lens watermark silhouette -->
        <div class="absolute right-0 top-0 bottom-0 w-1/3 opacity-15 pointer-events-none hidden md:block"
             style="background: radial-gradient(circle at right, rgba(255,255,255,0.4) 0%, transparent 70%);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            
            <div class="text-center md:text-left text-white space-y-1">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-black tracking-tight drop-shadow-sm">
                    Bạn đang lên kế hoạch cho chương trình TeamBuilding?
                </h2>
                <p class="text-xs sm:text-sm text-orange-100 font-medium">
                    Hãy để chúng tôi lưu giữ những khoảnh khắc tràn đầy năng lượng này!
                </p>
            </div>

            <div class="shrink-0">
                <a href="https://zalo.me/0939363262?text={{ urlencode('Tôi cần tư vấn dịch vụ chụp ảnh TeamBuilding') }}" 
                   target="_blank"
                   class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-black text-xs sm:text-sm text-[#ff5400] bg-white hover:bg-orange-50 shadow-lg shadow-black/10 hover:shadow-xl transition-all transform hover:-translate-y-0.5"
                   style="color: #ff5400 !important; background-color: #ffffff !important;">
                    <span>Liên hệ ngay</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>

        </div>
    </section>


    <!-- ==========================================
         LIGHTBOX PREVIEW MODAL
         ========================================== -->
    <div x-show="previewImage" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
         @keydown.escape.window="closePreview()"
         style="display: none;">
        
        <!-- Close Button -->
        <button type="button" 
                @click="closePreview()" 
                class="absolute top-5 right-5 text-white/80 hover:text-white p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors z-20">
            <span class="material-symbols-outlined text-[28px]">close</span>
        </button>

        <div class="max-w-5xl max-h-[90vh] flex flex-col items-center" @click.away="closePreview()">
            <img :src="previewImage" 
                 :alt="previewTitle" 
                 class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl border border-white/10">
            <p x-text="previewTitle" class="text-white text-sm sm:text-base font-bold mt-4 text-center"></p>
        </div>
    </div>

</div>
@endsection
