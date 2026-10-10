{{-- 
    HOMEPAGE HERO BANNER (ROTATING SLIDER / CAROUSEL - CLEAN ARTWORK + CODE TEXT SEPARATION)
    Banner 1: Phát triển phần mềm với tư duy chiến lược • Technology & Digital Solutions (1983 x 793)
    Banner 2: Biến Ý Tưởng Thành Sản Phẩm Thực Tế • Lập trình - Phần mềm - Tích hợp AI (1983 x 793)
    Tách biệt 100% giữa Background Artwork, Text/Buttons và 6 Khối Kính 3D Floating Tiles (Glassmorphism).
--}}
<section class="relative w-full overflow-hidden bg-white border-b border-slate-200/80 pt-0 group" 
         id="hero-section"
         x-data="{
             currentSlide: 0,
             totalSlides: 2,
             autoplayInterval: null,
             isVisible: true,
             init() {
                 this.startAutoplay();

                 if ('IntersectionObserver' in window) {
                     const observer = new IntersectionObserver((entries) => {
                         entries.forEach(entry => {
                             this.isVisible = entry.isIntersecting;
                             if (this.isVisible) {
                                 this.startAutoplay();
                             } else {
                                 this.stopAutoplay();
                             }
                         });
                     }, { threshold: 0 });
                     observer.observe(this.$el);
                 }

                 document.addEventListener('visibilitychange', () => {
                     if (document.hidden) {
                         this.stopAutoplay();
                     } else if (this.isVisible) {
                         this.startAutoplay();
                     }
                 });
             },
             startAutoplay() {
                 this.stopAutoplay();
                 this.autoplayInterval = setInterval(() => {
                     this.nextSlide();
                 }, 5000);
             },
             stopAutoplay() {
                 if (this.autoplayInterval) {
                     clearInterval(this.autoplayInterval);
                     this.autoplayInterval = null;
                 }
             },
             nextSlide() {
                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
             },
             prevSlide() {
                 this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
             },
             goToSlide(index) {
                 this.currentSlide = index;
                 this.startAutoplay();
             }
         }"
         @mouseenter="stopAutoplay()"
         @mouseleave="startAutoplay()">

    <style>
        /* ================= 3D GLASSMORPHISM FLOATING TILES ================= */
        .hero-glass-tile {
            position: absolute;
            z-index: 25;
            border-radius: clamp(14px, 1.4cqw, 24px);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.72) 0%, rgba(255, 255, 255, 0.35) 55%, rgba(255, 255, 255, 0.62) 100%);
            backdrop-filter: blur(16px) saturate(190%);
            -webkit-backdrop-filter: blur(16px) saturate(190%);
            border: 1.5px solid rgba(255, 255, 255, 0.95);
            box-shadow: 
                0 18px 36px -6px rgba(15, 23, 42, 0.16),
                0 4px 14px rgba(255, 255, 255, 0.8),
                inset 0 2px 2px rgba(255, 255, 255, 1),
                inset 0 -2px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none !important;
            user-select: none;
            will-change: transform;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease, border-color 0.35s ease, background 0.35s ease;
            width: clamp(42px, 4.7cqw, 88px);
            height: clamp(42px, 4.7cqw, 88px);
            padding: clamp(5px, 0.5cqw, 10px);
        }

        .hero-glass-tile:hover {
            animation-play-state: paused !important;
            transform: scale(1.15) translateY(-6px) !important;
            border-color: #ff5e00 !important;
            background: rgba(255, 255, 255, 0.88) !important;
            box-shadow: 
                0 24px 48px -4px rgba(255, 94, 0, 0.38),
                0 0 30px rgba(255, 94, 0, 0.28),
                inset 0 2px 2px #fff !important;
            z-index: 40 !important;
        }

        .hero-glass-tile svg {
            width: 100%;
            height: 100%;
            display: block;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hero-glass-tile:hover svg {
            transform: scale(1.08) rotate(3deg);
        }

        /* 6 Floating Animation Paths (Di chuyển lơ lửng 2D/3D đa chiều lệch pha nhau) */
        .hero-tile-float-1 { animation: floatHeroTile1 7.5s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite; }
        .hero-tile-float-2 { animation: floatHeroTile2 8.8s cubic-bezier(0.42, 0, 0.58, 1) 0.5s infinite; }
        .hero-tile-float-3 { animation: floatHeroTile3 7.0s cubic-bezier(0.45, 0.05, 0.55, 0.95) 1.0s infinite; }
        .hero-tile-float-4 { animation: floatHeroTile4 9.2s cubic-bezier(0.42, 0, 0.58, 1) 1.4s infinite; }
        .hero-tile-float-5 { animation: floatHeroTile5 8.0s cubic-bezier(0.45, 0.05, 0.55, 0.95) 0.8s infinite; }
        .hero-tile-float-6 { animation: floatHeroTile6 8.5s cubic-bezier(0.42, 0, 0.58, 1) 1.2s infinite; }

        @keyframes floatHeroTile1 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(6px, -12px) rotate(2deg); }
            50% { transform: translate(12px, 6px) rotate(-1.5deg); }
            75% { transform: translate(-6px, 10px) rotate(1deg); }
        }

        @keyframes floatHeroTile2 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(-10px, 12px) rotate(-2deg); }
            50% { transform: translate(8px, 10px) rotate(1.5deg); }
            75% { transform: translate(10px, -10px) rotate(-1deg); }
        }

        @keyframes floatHeroTile3 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(10px, -10px) rotate(1.8deg); }
            50% { transform: translate(-8px, -12px) rotate(-1.2deg); }
            75% { transform: translate(-10px, 8px) rotate(1.5deg); }
        }

        @keyframes floatHeroTile4 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(-12px, -8px) rotate(-2deg); }
            50% { transform: translate(10px, -12px) rotate(2deg); }
            75% { transform: translate(8px, 10px) rotate(-1.5deg); }
        }

        @keyframes floatHeroTile5 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(8px, 12px) rotate(1.5deg); }
            50% { transform: translate(-10px, 8px) rotate(-1.8deg); }
            75% { transform: translate(-8px, -10px) rotate(1.2deg); }
        }

        @keyframes floatHeroTile6 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(-10px, -10px) rotate(-1.5deg); }
            50% { transform: translate(8px, -12px) rotate(1.8deg); }
            75% { transform: translate(12px, 8px) rotate(-1deg); }
        }

        /* ================= BANNER TEXT OVERLAY & CTA BUTTONS (MINIMALIST GLOW) ================= */
        .hero-text-overlay {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 100% !important;
            pointer-events: none !important;
            display: flex !important;
            align-items: flex-start !important;
            padding-top: clamp(20px, 3.8vw, 64px) !important;
            z-index: 15 !important;
            box-sizing: border-box !important;
        }

        .hero-text-col {
            pointer-events: auto !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
            text-align: left !important;
            margin-left: 4.8% !important;
            width: 44% !important;
            max-width: 620px !important;
        }

        .hero-tag-pill {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            padding: clamp(4px, 0.38vw, 7px) clamp(12px, 1.1vw, 20px) !important;
            border-radius: 9999px !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            border: 1.5px solid rgba(255, 94, 0, 0.8) !important;
            box-shadow: 0 4px 14px rgba(255, 94, 0, 0.15), inset 0 1px 1px #fff !important;
            margin-bottom: clamp(10px, 1.2vw, 18px) !important;
            align-self: flex-start !important;
            transition: all 0.3s ease !important;
        }

        .hero-tag-pill:hover {
            border-color: #ff5e00 !important;
            box-shadow: 0 6px 18px rgba(255, 94, 0, 0.25), inset 0 1px 1px #fff !important;
            transform: translateY(-1px) !important;
        }

        .hero-tag-dot {
            width: 7px !important;
            height: 7px !important;
            border-radius: 9999px !important;
            background-color: #ff5e00 !important;
            box-shadow: 0 0 8px #ff5e00 !important;
            display: inline-block !important;
            animation: heroTagPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite !important;
        }

        @keyframes heroTagPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        .hero-tag-icon {
            font-family: monospace !important;
            font-weight: 900 !important;
            color: #ff5e00 !important;
            font-size: clamp(9px, 0.8vw, 13px) !important;
            line-height: 1 !important;
        }

        .hero-tag-text {
            font-family: 'Mulish', sans-serif !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.06em !important;
            color: #ff5e00 !important;
            font-size: clamp(8px, 0.72vw, 12px) !important;
            line-height: 1 !important;
        }

        .hero-heading {
            font-family: 'Mulish', sans-serif !important;
            font-weight: 900 !important;
            letter-spacing: -0.03em !important;
            line-height: 1.14 !important;
            margin: 0 0 clamp(10px, 1.2vw, 18px) 0 !important;
            font-size: clamp(22px, 3.1vw, 56px) !important;
        }

        .hero-heading .hero-heading-dark {
            display: block !important;
            color: #0b132b !important;
            letter-spacing: -0.03em !important;
        }

        .hero-heading .hero-heading-orange {
            display: block !important;
            background: linear-gradient(135deg, #ff4d00 0%, #ff7300 45%, #ff9500 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            filter: drop-shadow(0 4px 16px rgba(255, 94, 0, 0.25)) !important;
            letter-spacing: -0.025em !important;
        }

        .hero-desc {
            font-family: 'Mulish', sans-serif !important;
            font-weight: 500 !important;
            color: #475569 !important;
            line-height: 1.68 !important;
            margin: 0 0 clamp(14px, 1.8vw, 26px) 0 !important;
            max-width: 520px !important;
            font-size: clamp(10px, 0.92vw, 15.5px) !important;
        }

        .hero-btn-row {
            display: flex !important;
            align-items: center !important;
            gap: clamp(10px, 1.2vw, 18px) !important;
        }

        .hero-btn-primary {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            border-radius: 9999px !important;
            background: linear-gradient(135deg, #ff5e00 0%, #ff781e 50%, #ea580c 100%) !important;
            color: #ffffff !important;
            font-family: 'Mulish', sans-serif !important;
            font-weight: 800 !important;
            text-decoration: none !important;
            padding: clamp(8px, 0.82vw, 15px) clamp(20px, 2vw, 36px) !important;
            font-size: clamp(10.5px, 0.92vw, 15.5px) !important;
            box-shadow: 0 10px 28px -4px rgba(255, 94, 0, 0.5), 0 3px 10px rgba(255, 94, 0, 0.3), inset 0 1px 1.5px rgba(255, 255, 255, 0.5) !important;
            border: 1px solid rgba(255, 255, 255, 0.35) !important;
            cursor: pointer !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        }

        .hero-btn-primary:hover {
            transform: translateY(-3px) scale(1.02) !important;
            box-shadow: 0 16px 36px -4px rgba(255, 94, 0, 0.65), 0 6px 16px rgba(255, 94, 0, 0.4), inset 0 1px 2px #fff !important;
        }

        .hero-btn-primary .hero-arrow {
            display: inline-flex !important;
            transition: transform 0.25s ease !important;
        }

        .hero-btn-primary:hover .hero-arrow {
            transform: translateX(4px) !important;
        }

        .hero-btn-secondary {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            border-radius: 9999px !important;
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(12px) !important;
            color: #0f172a !important;
            border: 1.5px solid rgba(203, 213, 225, 0.95) !important;
            font-family: 'Mulish', sans-serif !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            padding: clamp(8px, 0.82vw, 15px) clamp(20px, 2vw, 36px) !important;
            font-size: clamp(10.5px, 0.92vw, 15.5px) !important;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05), inset 0 1px 1px #fff !important;
            cursor: pointer !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        }

        .hero-btn-secondary:hover {
            transform: translateY(-3px) scale(1.02) !important;
            border-color: #ff5e00 !important;
            color: #ff5e00 !important;
            background: #ffffff !important;
            box-shadow: 0 10px 26px rgba(255, 94, 0, 0.2), inset 0 1px 1px #fff !important;
        }

        .hero-btn-secondary .hero-arrow {
            display: inline-flex !important;
            transition: transform 0.25s ease !important;
        }

        .hero-btn-secondary:hover .hero-arrow {
            transform: translateX(4px) !important;
        }

        /* ================= FULL-WIDTH BOTTOM FEATURE STRIP ================= */
        .hero-bottom-bar {
            position: absolute !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 20 !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            border-top: 1px solid rgba(226, 232, 240, 0.95) !important;
            padding: clamp(6px, 0.65vw, 11px) clamp(14px, 2.2vw, 38px) !important;
            box-sizing: border-box !important;
            box-shadow: 0 -4px 20px rgba(15, 23, 42, 0.03) !important;
        }

        .hero-bottom-grid {
            display: grid !important;
            grid-template-columns: repeat(5, minmax(0, 1fr)) !important;
            width: 100% !important;
            align-items: center !important;
            margin: 0 !important;
            padding: 0 !important;
            gap: clamp(4px, 0.6vw, 12px) !important;
        }

        .hero-bottom-item {
            display: flex !important;
            align-items: center !important;
            gap: clamp(8px, 0.8vw, 13px) !important;
            padding: clamp(4px, 0.4vw, 8px) clamp(8px, 0.9vw, 14px) !important;
            border-right: 1px solid rgba(226, 232, 240, 0.8) !important;
            box-sizing: border-box !important;
            min-width: 0 !important;
            border-radius: 12px !important;
            transition: all 0.25s ease !important;
            cursor: pointer !important;
            text-decoration: none !important;
        }

        .hero-bottom-item:last-child {
            border-right: none !important;
        }

        .hero-bottom-item:hover {
            background: rgba(255, 94, 0, 0.05) !important;
            border-color: rgba(255, 94, 0, 0.3) !important;
            transform: translateY(-2px) !important;
        }

        .hero-bottom-badge {
            width: clamp(28px, 2.4vw, 42px) !important;
            height: clamp(28px, 2.4vw, 42px) !important;
            min-width: clamp(28px, 2.4vw, 42px) !important;
            border-radius: 9999px !important;
            background: linear-gradient(135deg, #ff7a18 0%, #ff5e00 100%) !important;
            color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            box-shadow: 0 4px 10px rgba(255, 94, 0, 0.32), inset 0 1px 1px rgba(255, 255, 255, 0.4) !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        }

        .hero-bottom-item:hover .hero-bottom-badge {
            transform: scale(1.12) rotate(4deg) !important;
            box-shadow: 0 8px 18px rgba(255, 94, 0, 0.5), inset 0 1px 1px #fff !important;
        }

        .hero-bottom-text {
            min-width: 0 !important;
            overflow: hidden !important;
        }

        .hero-bottom-title {
            font-family: 'Mulish', sans-serif !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            line-height: 1.25 !important;
            font-size: clamp(8.5px, 0.76vw, 13.5px) !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            margin: 0 !important;
            transition: color 0.2s ease !important;
        }

        .hero-bottom-item:hover .hero-bottom-title {
            color: #ff5e00 !important;
        }

        .hero-bottom-sub {
            font-family: 'Mulish', sans-serif !important;
            font-weight: 500 !important;
            color: #64748b !important;
            line-height: 1.25 !important;
            margin: 2px 0 0 0 !important;
            font-size: clamp(7px, 0.6vw, 11px) !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            transition: color 0.2s ease !important;
        }

        .hero-bottom-item:hover .hero-bottom-sub {
            color: #475569 !important;
        }

        .hero-slider-dots-box {
            position: absolute !important;
            bottom: clamp(52px, 4.8vw, 76px) !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            z-index: 30 !important;
            pointer-events: auto !important;
            user-select: none !important;
        }

        /* ================= BANNER SLIDE TRANSITION EFFECTS ================= */
        .hero-slide-enter-active {
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) !important;
            will-change: opacity, transform !important;
            z-index: 10 !important;
        }

        .hero-slide-leave-active {
            transition: opacity 0.65s cubic-bezier(0.16, 1, 0.3, 1), transform 0.65s cubic-bezier(0.16, 1, 0.3, 1) !important;
            will-change: opacity, transform !important;
            z-index: 5 !important;
        }

        .hero-slide-enter-start {
            opacity: 0 !important;
            transform: scale(1.025) translateX(35px) !important;
        }

        .hero-slide-enter-end {
            opacity: 1 !important;
            transform: scale(1) translateX(0) !important;
        }

        .hero-slide-leave-start {
            opacity: 1 !important;
            transform: scale(1) translateX(0) !important;
        }

        .hero-slide-leave-end {
            opacity: 0 !important;
            transform: scale(0.975) translateX(-35px) !important;
        }

        /* Staggered Content Animation inside Active Slide */
        .hero-slide-active .hero-tag-pill {
            animation: heroFadeSlideDown 0.75s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both !important;
        }

        .hero-slide-active .hero-heading {
            animation: heroFadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.18s both !important;
        }

        .hero-slide-active .hero-desc {
            animation: heroFadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.28s both !important;
        }

        .hero-slide-active .hero-btn-row {
            animation: heroFadeSlideUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.38s both !important;
        }

        @keyframes heroFadeSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-16px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroFadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(22px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dot Indicators */
        .hero-dot-btn {
            height: 7px !important;
            border-radius: 9999px !important;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
            cursor: pointer !important;
            border: none !important;
            padding: 0 !important;
        }

        .hero-dot-active {
            width: 34px !important;
            background-color: #ff5e00 !important;
            box-shadow: 0 0 12px rgba(255, 94, 0, 0.6) !important;
        }

        .hero-dot-inactive {
            width: 8px !important;
            background-color: #cbd5e1 !important;
        }

        .hero-dot-inactive:hover {
            background-color: #94a3b8 !important;
            transform: scale(1.2) !important;
        }

        /* Mobile Transition Effects */
        .hero-mobile-text-enter-active {
            transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .hero-mobile-text-leave-active {
            transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .hero-mobile-text-enter-start {
            opacity: 0 !important;
            transform: translateY(12px) !important;
        }
        .hero-mobile-text-enter-end {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .hero-mobile-text-leave-start {
            opacity: 1 !important;
        }
        .hero-mobile-text-leave-end {
            opacity: 0 !important;
        }
    </style>

    {{-- Semantic Headings for SEO & Accessibility --}}
    <div class="sr-only">
        <h1>Phát triển phần mềm với tư duy chiến lược - Truyền Thông Cửu Long</h1>
        <h2>Đồng hành cùng doanh nghiệp kiến tạo giá trị số bền vững</h2>
        <h2>Giải Pháp Web, Web App &amp; Hệ Thống Số Doanh Nghiệp</h2>
        <p>Thiết kế và xây dựng website, Web App cùng hệ thống quản trị theo nhu cầu thực tế. Tư vấn giải pháp công nghệ và media thương hiệu trọn gói.</p>
        <h2>Biến Ý Tưởng Thành Sản Phẩm Thực Tế</h2>
        <p>Chúng tôi cung cấp giải pháp lập trình web, mobile app và hệ thống phần mềm theo yêu cầu, giúp doanh nghiệp tối ưu quy trình, nâng cao hiệu suất và bứt phá trong kỷ nguyên số.</p>
    </div>

    {{-- ==================== DESKTOP & TABLET: FULL-WIDTH SLIDER (ASPECT RATIO 1983 / 793) ==================== --}}
    <div class="relative w-full bg-white overflow-hidden select-none hidden md:block @container" 
         style="aspect-ratio: 1983/793; min-height: 320px;">
        
        <div class="grid grid-cols-1 grid-rows-1 w-full h-full relative">
            
            <!-- ==================== SLIDE 1: PHÁT TRIỂN PHẦN MỀM VỚI TƯ DUY CHIẾN LƯỢC ==================== -->
            <div x-show="currentSlide === 0"
                 x-transition:enter="hero-slide-enter-active"
                 x-transition:enter-start="hero-slide-enter-start"
                 x-transition:enter-end="hero-slide-enter-end"
                 x-transition:leave="hero-slide-leave-active"
                 x-transition:leave-start="hero-slide-leave-start"
                 x-transition:leave-end="hero-slide-leave-end"
                 :class="{ 'hero-slide-active': currentSlide === 0 }"
                 class="col-start-1 row-start-1 w-full h-full relative">
                
                {{-- Clean Background Artwork (Ảnh không chữ, không icon tĩnh) --}}
                <img src="{{ asset('images/banner1_clean.png') }}?v=5" 
                     alt="Phát triển phần mềm với tư duy chiến lược • Truyền Thông Cửu Long" 
                     class="w-full h-full object-cover block select-none pointer-events-none"
                     loading="eager"
                     fetchpriority="high"
                     width="1983"
                     height="793">

                {{-- 6 Khối Kính 3D Floating Glass Tiles (Di chuyển lơ lửng sống động) --}}
                <!-- Tile 1: </> Web & Coding -->
                <a href="{{ route('services.web-app') }}" 
                   title="Lập trình Web & Web App chuyên nghiệp"
                   class="hero-glass-tile hero-tile-float-1" 
                   style="left: 50.5%; top: 18%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s1t1-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#3B82F6"/>
                                <stop offset="50%" stop-color="#2563EB"/>
                                <stop offset="100%" stop-color="#1D4ED8"/>
                            </linearGradient>
                            <linearGradient id="s1t1-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <filter id="s1t1-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#1E3A8A" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s1t1-glow" x="10" y="10" width="44" height="44" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2" stdDeviation="1.5" flood-color="#000000" flood-opacity="0.25"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s1t1-base)" filter="url(#s1t1-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s1t1-gloss)"/>
                        <g filter="url(#s1t1-glow)">
                            <path d="M 23 23 L 15 32 L 23 41" stroke="#FFFFFF" stroke-width="4.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M 35 20 L 29 44" stroke="#FFFFFF" stroke-width="4.2" stroke-linecap="round"/>
                            <path d="M 41 23 L 49 32 L 41 41" stroke="#FFFFFF" stroke-width="4.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                    </svg>
                </a>

                <!-- Tile 2: Cloud ☁️ Điện toán đám mây -->
                <a href="{{ route('services.web-app') }}" 
                   title="Điện toán đám mây & Hạ tầng Cloud"
                   class="hero-glass-tile hero-tile-float-2" 
                   style="left: 60.5%; top: 8.5%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s1t2-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FBBF24"/>
                                <stop offset="40%" stop-color="#F97316"/>
                                <stop offset="100%" stop-color="#EA580C"/>
                            </linearGradient>
                            <linearGradient id="s1t2-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="s1t2-cloud" x1="32" y1="18" x2="32" y2="46" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF"/>
                                <stop offset="85%" stop-color="#F8FAFC"/>
                                <stop offset="100%" stop-color="#E2E8F0"/>
                            </linearGradient>
                            <filter id="s1t2-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#C2410C" flood-opacity="0.4"/>
                            </filter>
                            <filter id="s1t2-cloudshadow" x="10" y="14" width="44" height="38" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="3" stdDeviation="2.5" flood-color="#7C2D12" flood-opacity="0.35"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s1t2-base)" filter="url(#s1t2-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s1t2-gloss)"/>
                        <g filter="url(#s1t2-cloudshadow)">
                            <path d="M 23 43 C 18.5 43 15 39.5 15 35 C 15 31.2 17.6 28 21.2 27.2 C 22.4 22.6 26.6 19 31.5 19 C 37 19 41.5 23.2 42.2 28.5 C 45.5 29 48 31.8 48 35.2 C 48 39.5 44.5 43 40.2 43 Z" fill="url(#s1t2-cloud)"/>
                            <path d="M 23 27 C 26 22 35 21 39 25 C 36 23 29 23 23 27 Z" fill="#FFFFFF" opacity="0.8"/>
                        </g>
                    </svg>
                </a>

                <!-- Tile 3: Play ▶️ Media & Video Production -->
                <a href="{{ route('services.media') }}" 
                   title="Sản xuất Media, Phim TVC & Video Doanh Nghiệp"
                   class="hero-glass-tile hero-tile-float-3" 
                   style="left: 69.5%; top: 6.5%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s1t3-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#38BDF8"/>
                                <stop offset="40%" stop-color="#2563EB"/>
                                <stop offset="100%" stop-color="#1D4ED8"/>
                            </linearGradient>
                            <linearGradient id="s1t3-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="s1t3-play" x1="24" y1="18" x2="48" y2="44" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF"/>
                                <stop offset="100%" stop-color="#F0F9FF"/>
                            </linearGradient>
                            <filter id="s1t3-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#1E3A8A" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s1t3-playglow" x="18" y="14" width="34" height="36" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2.5" stdDeviation="2" flood-color="#0F172A" flood-opacity="0.35"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s1t3-base)" filter="url(#s1t3-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s1t3-gloss)"/>
                        <g filter="url(#s1t3-playglow)">
                            <path d="M 26 20.8 C 26 18.8 28.2 17.6 29.9 18.7 L 44.8 28.4 C 46.4 29.5 46.4 31.9 44.8 33 L 29.9 42.7 C 28.2 43.8 26 42.6 26 40.6 Z" fill="url(#s1t3-play)"/>
                            <path d="M 27 21.5 L 43.5 31.5 L 27 23.5 Z" fill="#FFFFFF" opacity="0.6"/>
                        </g>
                    </svg>
                </a>

                <!-- Tile 4: AI 🧠 Trí tuệ nhân tạo -->
                <a href="{{ route('services.index') }}" 
                   title="Giải pháp Ứng dụng Trí tuệ nhân tạo (AI)"
                   class="hero-glass-tile hero-tile-float-4" 
                   style="left: 79.5%; top: 12.5%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s1t4-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#F59E0B"/>
                                <stop offset="45%" stop-color="#EA580C"/>
                                <stop offset="100%" stop-color="#C2410C"/>
                            </linearGradient>
                            <linearGradient id="s1t4-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="s1t4-gold" x1="16" y1="16" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FEF08A"/>
                                <stop offset="50%" stop-color="#FBBF24"/>
                                <stop offset="100%" stop-color="#D97706"/>
                            </linearGradient>
                            <filter id="s1t4-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#7C2D12" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s1t4-chipglow" x="12" y="12" width="40" height="40" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2.5" stdDeviation="2" flood-color="#451A03" flood-opacity="0.4"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s1t4-base)" filter="url(#s1t4-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s1t4-gloss)"/>
                        <g filter="url(#s1t4-chipglow)">
                            <path d="M 26 13 L 26 19 M 38 13 L 38 19" stroke="url(#s1t4-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <path d="M 26 45 L 26 51 M 38 45 L 38 51" stroke="url(#s1t4-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <path d="M 13 26 L 19 26 M 13 38 L 19 38" stroke="url(#s1t4-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <path d="M 45 26 L 51 26 M 45 38 L 51 38" stroke="url(#s1t4-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <rect x="18" y="18" width="28" height="28" rx="6" fill="#7C2D12" stroke="url(#s1t4-gold)" stroke-width="1.8"/>
                            <circle cx="22" cy="22" r="1.2" fill="#FDE047"/>
                            <circle cx="42" cy="22" r="1.2" fill="#FDE047"/>
                            <circle cx="22" cy="42" r="1.2" fill="#FDE047"/>
                            <circle cx="42" cy="42" r="1.2" fill="#FDE047"/>
                            <text x="32" y="36.5" font-family="system-ui, -apple-system, sans-serif" font-size="13" font-weight="900" fill="#FFFFFF" text-anchor="middle" letter-spacing="1">AI</text>
                        </g>
                    </svg>
                </a>

                <!-- Tile 5: Shield 🛡️ Bảo mật dữ liệu -->
                <a href="{{ route('services.web-app') }}" 
                   title="Bảo mật dữ liệu & An toàn hệ thống"
                   class="hero-glass-tile hero-tile-float-5" 
                   style="left: 88.5%; top: 22%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s1t5-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#38BDF8"/>
                                <stop offset="40%" stop-color="#0284C7"/>
                                <stop offset="100%" stop-color="#0369A1"/>
                            </linearGradient>
                            <linearGradient id="s1t5-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="s1t5-shield" x1="32" y1="15" x2="32" y2="47" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF"/>
                                <stop offset="100%" stop-color="#E0F2FE"/>
                            </linearGradient>
                            <filter id="s1t5-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#0C4A6E" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s1t5-shieldglow" x="14" y="14" width="36" height="38" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2.5" stdDeviation="2" flood-color="#082F49" flood-opacity="0.35"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s1t5-base)" filter="url(#s1t5-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s1t5-gloss)"/>
                        <g filter="url(#s1t5-shieldglow)">
                            <path d="M 32 16 C 39 16 44 18 44 18 C 44 31 38 40.5 32 46 C 26 40.5 20 31 20 18 C 20 18 25 16 32 16 Z" fill="url(#s1t5-shield)"/>
                            <path d="M 32 18 C 38 18 42 19.5 42 19.5 C 42 30 36.8 38.5 32 43 C 27.2 38.5 22 30 22 19.5 C 22 19.5 26 18 32 18 Z" stroke="#38BDF8" stroke-width="1.2" opacity="0.6"/>
                            <path d="M 28 27 C 28 24.8 29.8 23 32 23 C 34.2 23 36 24.8 36 27 L 36 29 L 28 29 Z" stroke="#0284C7" stroke-width="2" stroke-linecap="round"/>
                            <rect x="27" y="29" width="10" height="8" rx="2" fill="#0284C7"/>
                            <circle cx="32" cy="32.5" r="1.1" fill="#FFFFFF"/>
                            <path d="M 32 33.6 L 32 35.2" stroke="#FFFFFF" stroke-width="1.1" stroke-linecap="round"/>
                        </g>
                    </svg>
                </a>

                <!-- Tile 6: Devices 📱 Đa nền tảng thiết bị -->
                <a href="{{ route('services.web-app') }}" 
                   title="Thiết kế chuẩn Responsive & Đa thiết bị"
                   class="hero-glass-tile hero-tile-float-6" 
                   style="left: 93.5%; top: 40%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s1t6-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#38BDF8"/>
                                <stop offset="40%" stop-color="#0284C7"/>
                                <stop offset="100%" stop-color="#0369A1"/>
                            </linearGradient>
                            <linearGradient id="s1t6-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <filter id="s1t6-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#0C4A6E" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s1t6-devglow" x="12" y="16" width="40" height="34" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2.5" stdDeviation="2" flood-color="#082F49" flood-opacity="0.35"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s1t6-base)" filter="url(#s1t6-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s1t6-gloss)"/>
                        <g filter="url(#s1t6-devglow)">
                            <rect x="17" y="19" width="24" height="16" rx="2.5" stroke="#FFFFFF" stroke-width="2.2" fill="#0369A1" fill-opacity="0.3"/>
                            <path d="M 25 35 L 23 41 L 35 41 L 33 35" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="33" y="24" width="13" height="20" rx="2.5" fill="#FFFFFF"/>
                            <rect x="35" y="26.5" width="9" height="13.5" rx="1" fill="#0284C7"/>
                            <circle cx="39.5" cy="42" r="0.75" fill="#0369A1"/>
                        </g>
                    </svg>
                </a>

                {{-- HTML & CSS Text Overlay (Cột bên trái) --}}
                <div class="hero-text-overlay" aria-hidden="false">
                    <div class="hero-text-col">
                        
                        <!-- 1. Tag Pill: Viền cam, chữ cam bo tròn chuẩn mẫu -->
                        <div class="hero-tag-pill">
                            <span class="hero-tag-dot"></span>
                            <span class="hero-tag-icon">&lt;/&gt;</span>
                            <span class="hero-tag-text">
                                PHÁT TRIỂN PHẦN MỀM &amp; GIẢI PHÁP SỐ
                            </span>
                        </div>

                        <!-- 2. Main Heading H1: Dòng 1 xanh đen #0b132b, Dòng 2 cam rực #ff5e00 -->
                        <h1 class="hero-heading">
                            <span class="hero-heading-dark">Phát triển phần mềm</span>
                            <span class="hero-heading-orange">với tư duy chiến lược</span>
                        </h1>

                        <!-- 3. Description Paragraph -->
                        <p class="hero-desc">
                            Thiết kế và xây dựng website, Web App cùng hệ thống quản trị theo nhu cầu thực tế, giúp doanh nghiệp số hóa quy trình và kiểm soát hoạt động hiệu quả hơn.
                        </p>

                        <!-- 4. CTA Buttons: Nút cam đặc & Nút trắng viền xám -->
                        <div class="hero-btn-row">
                            <a href="{{ route('contact') }}" 
                               class="hero-btn-primary"
                               title="Bắt đầu dự án">
                                <span>Bắt đầu dự án</span>
                                <span class="material-symbols-outlined hero-arrow" style="font-size: 16px;">arrow_forward</span>
                            </a>

                            <a href="{{ route('services.index') }}" 
                               class="hero-btn-secondary"
                               title="Xem giải pháp công nghệ">
                                <span>Xem giải pháp</span>
                                <span class="material-symbols-outlined hero-arrow" style="font-size: 16px;">arrow_forward</span>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Dải 5 tính năng cốt lõi toàn chiều rộng chân banner Slide 1 -->
                <div class="hero-bottom-bar">
                    <div class="hero-bottom-grid">
                        <a href="{{ route('services.index') }}" class="hero-bottom-item" title="Xem giải pháp Tư duy chiến lược">
                            <div class="hero-bottom-badge">
                                <span style="font-family: monospace; font-weight: 900; font-size: clamp(8px, 0.75vw, 13px);">&lt;/&gt;</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Tư duy chiến lược</div>
                                <div class="hero-bottom-sub">Số hóa quy trình thực tế</div>
                            </div>
                        </a>
                        <a href="{{ route('services.web-app') }}" class="hero-bottom-item" title="Xem giải pháp Website & Web App">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">laptop_mac</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Website &amp; Web App</div>
                                <div class="hero-bottom-sub">Kiến trúc mở, chuẩn SEO</div>
                            </div>
                        </a>
                        <a href="{{ route('services.media') }}" class="hero-bottom-item" title="Xem dịch vụ Media In-House">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">videocam</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Media In-House</div>
                                <div class="hero-bottom-sub">Sản xuất visual chuẩn mực</div>
                            </div>
                        </a>
                        <a href="{{ route('services.index') }}" class="hero-bottom-item" title="Xem giải pháp Tích hợp AI">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">psychology</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Tích hợp AI</div>
                                <div class="hero-bottom-sub">Tự động hóa thông minh</div>
                            </div>
                        </a>
                        <a href="{{ route('contact') }}" class="hero-bottom-item" title="Tư vấn bảo hành & hỗ trợ 24/7">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">verified_user</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Đồng hành bền vững</div>
                                <div class="hero-bottom-sub">Bảo hành &amp; hỗ trợ 24/7</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ==================== SLIDE 2: BIẾN Ý TƯỞNG THÀNH SẢN PHẨM THỰC TẾ ==================== -->
            <div x-show="currentSlide === 1"
                 x-cloak
                 x-transition:enter="hero-slide-enter-active"
                 x-transition:enter-start="hero-slide-enter-start"
                 x-transition:enter-end="hero-slide-enter-end"
                 x-transition:leave="hero-slide-leave-active"
                 x-transition:leave-start="hero-slide-leave-start"
                 x-transition:leave-end="hero-slide-leave-end"
                 :class="{ 'hero-slide-active': currentSlide === 1 }"
                 class="col-start-1 row-start-1 w-full h-full relative">
                
                {{-- Clean Background Artwork (Ảnh không chữ, không icon tĩnh) --}}
                <img src="{{ asset('images/banner2_clean.png') }}?v=5" 
                     alt="Biến Ý Tưởng Thành Sản Phẩm Thực Tế • Truyền Thông Cửu Long" 
                     class="w-full h-full object-cover block select-none pointer-events-none"
                     loading="eager"
                     width="1983"
                     height="793">

                {{-- 5 Khối Kính 3D Floating Glass Tiles Slide 2 --}}
                <!-- Tile 1: </> Code Cam Neon -->
                <a href="{{ route('services.web-app') }}" 
                   title="Phát triển Web & Ứng dụng theo yêu cầu"
                   class="hero-glass-tile hero-tile-float-1" 
                   style="left: 52%; top: 16%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s2t1-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFA14A"/>
                                <stop offset="45%" stop-color="#FF5E00"/>
                                <stop offset="100%" stop-color="#C2410C"/>
                            </linearGradient>
                            <linearGradient id="s2t1-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <filter id="s2t1-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#7C2D12" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s2t1-glow" x="10" y="10" width="44" height="44" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2" stdDeviation="1.5" flood-color="#000000" flood-opacity="0.25"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s2t1-base)" filter="url(#s2t1-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s2t1-gloss)"/>
                        <g filter="url(#s2t1-glow)">
                            <path d="M 23 23 L 15 32 L 23 41" stroke="#FFFFFF" stroke-width="4.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M 35 20 L 29 44" stroke="#FFFFFF" stroke-width="4.2" stroke-linecap="round"/>
                            <path d="M 41 23 L 49 32 L 41 41" stroke="#FFFFFF" stroke-width="4.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                    </svg>
                </a>

                <!-- Tile 2: Cloud ☁️ -->
                <a href="{{ route('services.web-app') }}" 
                   title="Điện toán đám mây & Lưu trữ an toàn"
                   class="hero-glass-tile hero-tile-float-2" 
                   style="left: 61.5%; top: 11%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s2t2-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FDE047"/>
                                <stop offset="40%" stop-color="#F59E0B"/>
                                <stop offset="100%" stop-color="#EA580C"/>
                            </linearGradient>
                            <linearGradient id="s2t2-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="s2t2-cloud" x1="32" y1="18" x2="32" y2="46" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF"/>
                                <stop offset="85%" stop-color="#FFFBEB"/>
                                <stop offset="100%" stop-color="#FEF3C7"/>
                            </linearGradient>
                            <filter id="s2t2-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#7C2D12" flood-opacity="0.4"/>
                            </filter>
                            <filter id="s2t2-cloudshadow" x="10" y="14" width="44" height="38" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="3" stdDeviation="2.5" flood-color="#451A03" flood-opacity="0.35"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s2t2-base)" filter="url(#s2t2-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s2t2-gloss)"/>
                        <g filter="url(#s2t2-cloudshadow)">
                            <path d="M 23 43 C 18.5 43 15 39.5 15 35 C 15 31.2 17.6 28 21.2 27.2 C 22.4 22.6 26.6 19 31.5 19 C 37 19 41.5 23.2 42.2 28.5 C 45.5 29 48 31.8 48 35.2 C 48 39.5 44.5 43 40.2 43 Z" fill="url(#s2t2-cloud)"/>
                            <path d="M 23 27 C 26 22 35 21 39 25 C 36 23 29 23 23 27 Z" fill="#FFFFFF" opacity="0.8"/>
                        </g>
                    </svg>
                </a>

                <!-- Tile 3: AI Chip 🧠 (Dark Titanium & Gold) -->
                <a href="{{ route('services.index') }}" 
                   title="Tích hợp AI thông minh vào hệ thống"
                   class="hero-glass-tile hero-tile-float-4" 
                   style="left: 76.5%; top: 10%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s2t3-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#334155"/>
                                <stop offset="50%" stop-color="#1E293B"/>
                                <stop offset="100%" stop-color="#0F172A"/>
                            </linearGradient>
                            <linearGradient id="s2t3-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.35"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="s2t3-gold" x1="16" y1="16" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FEF08A"/>
                                <stop offset="50%" stop-color="#FBBF24"/>
                                <stop offset="100%" stop-color="#D97706"/>
                            </linearGradient>
                            <filter id="s2t3-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#020617" flood-opacity="0.6"/>
                            </filter>
                            <filter id="s2t3-chipglow" x="12" y="12" width="40" height="40" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2.5" stdDeviation="2" flood-color="#000000" flood-opacity="0.5"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s2t3-base)" filter="url(#s2t3-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="url(#s2t3-gold)" stroke-width="1.2" stroke-opacity="0.8"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s2t3-gloss)"/>
                        <g filter="url(#s2t3-chipglow)">
                            <path d="M 26 13 L 26 19 M 38 13 L 38 19" stroke="url(#s2t3-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <path d="M 26 45 L 26 51 M 38 45 L 38 51" stroke="url(#s2t3-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <path d="M 13 26 L 19 26 M 13 38 L 19 38" stroke="url(#s2t3-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <path d="M 45 26 L 51 26 M 45 38 L 51 38" stroke="url(#s2t3-gold)" stroke-width="2.6" stroke-linecap="round"/>
                            <rect x="18" y="18" width="28" height="28" rx="6" fill="#0F172A" stroke="url(#s2t3-gold)" stroke-width="1.8"/>
                            <circle cx="22" cy="22" r="1.2" fill="#FDE047"/>
                            <circle cx="42" cy="22" r="1.2" fill="#FDE047"/>
                            <circle cx="22" cy="42" r="1.2" fill="#FDE047"/>
                            <circle cx="42" cy="42" r="1.2" fill="#FDE047"/>
                            <text x="32" y="36.5" font-family="system-ui, -apple-system, sans-serif" font-size="13" font-weight="900" fill="url(#s2t3-gold)" text-anchor="middle" letter-spacing="1">AI</text>
                        </g>
                    </svg>
                </a>

                <!-- Tile 4: Shield 🛡️ -->
                <a href="{{ route('services.web-app') }}" 
                   title="Bảo mật dữ liệu tuyệt đối"
                   class="hero-glass-tile hero-tile-float-5" 
                   style="left: 87.5%; top: 12.5%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s2t4-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FF8C38"/>
                                <stop offset="40%" stop-color="#FF5E00"/>
                                <stop offset="100%" stop-color="#C2410C"/>
                            </linearGradient>
                            <linearGradient id="s2t4-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="s2t4-shield" x1="32" y1="15" x2="32" y2="47" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF"/>
                                <stop offset="100%" stop-color="#FFF7ED"/>
                            </linearGradient>
                            <filter id="s2t4-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#7C2D12" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s2t4-shieldglow" x="14" y="14" width="36" height="38" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2.5" stdDeviation="2" flood-color="#451A03" flood-opacity="0.35"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s2t4-base)" filter="url(#s2t4-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s2t4-gloss)"/>
                        <g filter="url(#s2t4-shieldglow)">
                            <path d="M 32 16 C 39 16 44 18 44 18 C 44 31 38 40.5 32 46 C 26 40.5 20 31 20 18 C 20 18 25 16 32 16 Z" fill="url(#s2t4-shield)"/>
                            <path d="M 32 18 C 38 18 42 19.5 42 19.5 C 42 30 36.8 38.5 32 43 C 27.2 38.5 22 30 22 19.5 C 22 19.5 26 18 32 18 Z" stroke="#FB923C" stroke-width="1.2" opacity="0.6"/>
                            <path d="M 28 27 C 28 24.8 29.8 23 32 23 C 34.2 23 36 24.8 36 27 L 36 29 L 28 29 Z" stroke="#EA580C" stroke-width="2" stroke-linecap="round"/>
                            <rect x="27" y="29" width="10" height="8" rx="2" fill="#EA580C"/>
                            <circle cx="32" cy="32.5" r="1.1" fill="#FFFFFF"/>
                            <path d="M 32 33.6 L 32 35.2" stroke="#FFFFFF" stroke-width="1.1" stroke-linecap="round"/>
                        </g>
                    </svg>
                </a>

                <!-- Tile 5: Smartphone 📱 -->
                <a href="{{ route('services.web-app') }}" 
                   title="Ứng dụng di động iOS & Android"
                   class="hero-glass-tile hero-tile-float-6" 
                   style="left: 93.5%; top: 26%;">
                    <svg class="select-none" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="s2t5-base" x1="8" y1="8" x2="56" y2="56" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FBBF24"/>
                                <stop offset="40%" stop-color="#FF7A18"/>
                                <stop offset="100%" stop-color="#EA580C"/>
                            </linearGradient>
                            <linearGradient id="s2t5-gloss" x1="32" y1="8" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.45"/>
                                <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
                            </linearGradient>
                            <filter id="s2t5-shadow" x="0" y="0" width="64" height="64" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#7C2D12" flood-opacity="0.45"/>
                            </filter>
                            <filter id="s2t5-phoneglow" x="18" y="12" width="28" height="40" filterUnits="userSpaceOnUse">
                                <feDropShadow dx="0" dy="2.5" stdDeviation="2" flood-color="#451A03" flood-opacity="0.35"/>
                            </filter>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="15" fill="url(#s2t5-base)" filter="url(#s2t5-shadow)"/>
                        <rect x="6.75" y="6.75" width="50.5" height="50.5" rx="14.25" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                        <path d="M 9 20 C 9 13.5 13.5 9 20 9 L 44 9 C 50.5 9 55 13.5 55 20 C 44 26 20 26 9 20 Z" fill="url(#s2t5-gloss)"/>
                        <g filter="url(#s2t5-phoneglow)">
                            <rect x="23" y="15" width="18" height="34" rx="4" fill="#FFFFFF"/>
                            <rect x="24.5" y="17.5" width="15" height="29" rx="2.5" fill="#C2410C"/>
                            <rect x="29" y="19" width="6" height="1.8" rx="0.9" fill="#FFFFFF"/>
                            <rect x="28.5" y="44" width="7" height="1" rx="0.5" fill="#FFFFFF" opacity="0.8"/>
                        </g>
                    </svg>
                </a>

                {{-- HTML & CSS Text Overlay (Cột bên trái) --}}
                <div class="hero-text-overlay" aria-hidden="false">
                    <div class="hero-text-col">
                        
                        <!-- 1. Tag Pill: Viền cam, chữ cam bo tròn chuẩn mẫu -->
                        <div class="hero-tag-pill">
                            <span class="hero-tag-dot"></span>
                            <span class="hero-tag-icon">&lt;/&gt;</span>
                            <span class="hero-tag-text">
                                LẬP TRÌNH • PHÁT TRIỂN PHẦN MỀM • ỨNG DỤNG
                            </span>
                        </div>

                        <!-- 2. Main Heading H1: Dòng 1 xanh đen #0b132b, Dòng 2 cam rực #ff5e00 -->
                        <h1 class="hero-heading">
                            <span class="hero-heading-dark">Biến Ý Tưởng Thành</span>
                            <span class="hero-heading-orange">Sản Phẩm Thực Tế</span>
                        </h1>

                        <!-- 3. Description Paragraph -->
                        <p class="hero-desc">
                            Chúng tôi cung cấp giải pháp lập trình web, mobile app và hệ thống phần mềm theo yêu cầu, giúp doanh nghiệp tối ưu quy trình, nâng cao hiệu suất và bứt phá trong kỷ nguyên số.
                        </p>

                        <!-- 4. CTA Buttons: Nút cam đặc & Nút trắng viền xám -->
                        <div class="hero-btn-row">
                            <a href="{{ route('contact') }}" 
                               class="hero-btn-primary"
                               title="Bắt đầu dự án">
                                <span>Bắt đầu dự án</span>
                                <span class="material-symbols-outlined hero-arrow" style="font-size: 16px;">arrow_forward</span>
                            </a>

                            <a href="{{ route('services.index') }}" 
                               class="hero-btn-secondary"
                               title="Xem giải pháp công nghệ">
                                <span>Xem giải pháp công nghệ</span>
                                <span class="material-symbols-outlined hero-arrow" style="font-size: 16px;">arrow_forward</span>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Dải 5 tính năng cốt lõi toàn chiều rộng chân banner Slide 2 -->
                <div class="hero-bottom-bar">
                    <div class="hero-bottom-grid">
                        <a href="{{ route('services.web-app') }}" class="hero-bottom-item" title="Xem giải pháp Website & Web App">
                            <div class="hero-bottom-badge">
                                <span style="font-family: monospace; font-weight: 900; font-size: clamp(8px, 0.75vw, 13px);">&lt;/&gt;</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Website &amp; Web App</div>
                                <div class="hero-bottom-sub">Hiệu năng cao, chuẩn SEO</div>
                            </div>
                        </a>
                        <a href="{{ route('services.web-app') }}" class="hero-bottom-item" title="Xem giải pháp Mobile App">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">smartphone</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Mobile App</div>
                                <div class="hero-bottom-sub">iOS &amp; Android hiện đại</div>
                            </div>
                        </a>
                        <a href="{{ route('services.web-app') }}" class="hero-bottom-item" title="Xem dịch vụ Hệ thống phần mềm">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">cloud</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Hệ thống phần mềm</div>
                                <div class="hero-bottom-sub">Tùy chỉnh theo yêu cầu</div>
                            </div>
                        </a>
                        <a href="{{ route('services.index') }}" class="hero-bottom-item" title="Xem giải pháp Tích hợp AI">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">psychology</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Tích hợp AI</div>
                                <div class="hero-bottom-sub">Tự động hóa thông minh</div>
                            </div>
                        </a>
                        <a href="{{ route('services.web-app') }}" class="hero-bottom-item" title="Xem giải pháp Bảo mật dữ liệu">
                            <div class="hero-bottom-badge">
                                <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.15vw, 20px);">verified_user</span>
                            </div>
                            <div class="hero-bottom-text">
                                <div class="hero-bottom-title">Bảo mật dữ liệu</div>
                                <div class="hero-bottom-sub">An toàn &amp; ổn định</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Slider Dots & Controls (Desktop) -->
        <div class="hero-slider-dots-box" aria-label="Chuyển slide banner">
            <button type="button" 
                    @click="goToSlide(0)" 
                    class="hero-dot-btn shadow-xs" 
                    :class="currentSlide === 0 ? 'hero-dot-active' : 'hero-dot-inactive'" 
                    aria-label="Xem Slide 1"></button>
            <button type="button" 
                    @click="goToSlide(1)" 
                    class="hero-dot-btn shadow-xs" 
                    :class="currentSlide === 1 ? 'hero-dot-active' : 'hero-dot-inactive'" 
                    aria-label="Xem Slide 2"></button>
        </div>


    </div>

    {{-- ==================== MOBILE SCREEN (< 768px): GIAO DIỆN TỐI ƯU ĐIỆN THOẠI ==================== --}}
    <div class="w-full bg-[#FFFDFB] md:hidden p-4 space-y-4">
        
        <!-- Mobile Artwork with Smooth Slide Switch -->
        <div class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-sm">
            <div class="grid grid-cols-1 grid-rows-1 w-full h-full">
                <div x-show="currentSlide === 0" 
                     x-transition:enter="hero-slide-enter-active" 
                     x-transition:enter-start="hero-slide-enter-start" 
                     x-transition:enter-end="hero-slide-enter-end" 
                     x-transition:leave="hero-slide-leave-active" 
                     x-transition:leave-start="hero-slide-leave-start" 
                     x-transition:leave-end="hero-slide-leave-end" 
                     class="col-start-1 row-start-1 w-full h-full">
                    <img src="{{ asset('images/banner1_clean.png') }}?v=5" alt="Phát triển phần mềm" class="w-full h-full object-cover">
                </div>
                <div x-show="currentSlide === 1" 
                     x-cloak 
                     x-transition:enter="hero-slide-enter-active" 
                     x-transition:enter-start="hero-slide-enter-start" 
                     x-transition:enter-end="hero-slide-enter-end" 
                     x-transition:leave="hero-slide-leave-active" 
                     x-transition:leave-start="hero-slide-leave-start" 
                     x-transition:leave-end="hero-slide-leave-end" 
                     class="col-start-1 row-start-1 w-full h-full">
                    <img src="{{ asset('images/banner2_clean.png') }}?v=5" alt="Biến Ý Tưởng Thành Sản Phẩm Thực Tế" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Mobile Dots -->
            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex items-center gap-1.5 z-10 bg-black/30 backdrop-blur-xs px-2 py-1 rounded-full">
                <button type="button" @click="goToSlide(0)" class="h-1.5 rounded-full transition-all" :class="currentSlide === 0 ? 'w-5 bg-white' : 'w-1.5 bg-white/60'"></button>
                <button type="button" @click="goToSlide(1)" class="h-1.5 rounded-full transition-all" :class="currentSlide === 1 ? 'w-5 bg-white' : 'w-1.5 bg-white/60'"></button>
            </div>
        </div>

        <!-- Slide Content on Mobile (Smooth Grid Transition) -->
        <div class="grid grid-cols-1 grid-rows-1">
            <!-- Slide 1 Text on Mobile -->
            <div x-show="currentSlide === 0" 
                 x-transition:enter="hero-mobile-text-enter-active"
                 x-transition:enter-start="hero-mobile-text-enter-start"
                 x-transition:enter-end="hero-mobile-text-enter-end"
                 x-transition:leave="hero-mobile-text-leave-active"
                 x-transition:leave-start="hero-mobile-text-leave-start"
                 x-transition:leave-end="hero-mobile-text-leave-end"
                 class="col-start-1 row-start-1 space-y-2.5">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-orange-50 border border-orange-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#ff5e00]"></span>
                    <span class="font-headline font-bold text-[10px] text-[#ea580c] uppercase tracking-wider">PHÁT TRIỂN PHẦN MỀM &amp; GIẢI PHÁP SỐ</span>
                </div>
                <h2 class="font-headline text-2xl font-black text-slate-900 leading-tight">
                    Phát triển phần mềm <br>
                    <span class="text-[#ff5e00]">với tư duy chiến lược</span>
                </h2>
                <p class="font-body text-xs text-slate-600 leading-relaxed">
                    Đồng hành cùng doanh nghiệp kiến tạo giá trị số bền vững. Thiết kế &amp; lập trình Web App chuyên nghiệp.
                </p>
            </div>

            <!-- Slide 2 Text on Mobile -->
            <div x-show="currentSlide === 1" 
                 x-cloak 
                 x-transition:enter="hero-mobile-text-enter-active"
                 x-transition:enter-start="hero-mobile-text-enter-start"
                 x-transition:enter-end="hero-mobile-text-enter-end"
                 x-transition:leave="hero-mobile-text-leave-active"
                 x-transition:leave-start="hero-mobile-text-leave-start"
                 x-transition:leave-end="hero-mobile-text-leave-end"
                 class="col-start-1 row-start-1 space-y-2.5">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-white border border-[#ff5e00]">
                    <span class="font-mono text-[11px] font-bold text-[#ff5e00]">&lt;/&gt;</span>
                    <span class="font-headline font-bold text-[10px] text-[#ff5e00] uppercase tracking-wider">LẬP TRÌNH • PHÁT TRIỂN PHẦN MỀM • ỨNG DỤNG</span>
                </div>
                <h2 class="font-headline text-2xl font-black text-slate-900 leading-tight">
                    Biến Ý Tưởng Thành <br>
                    <span class="text-[#ff5e00]">Sản Phẩm Thực Tế</span>
                </h2>
                <p class="font-body text-xs text-slate-600 leading-relaxed">
                    Chúng tôi cung cấp giải pháp lập trình web, mobile app và hệ thống phần mềm theo yêu cầu, giúp doanh nghiệp tối ưu quy trình, nâng cao hiệu suất và bứt phá trong kỷ nguyên số.
                </p>
            </div>
        </div>

        <!-- Mobile CTA Buttons -->
        <div class="flex items-center gap-3 pt-1">
            <a href="{{ route('contact') }}" class="flex-1 py-3 px-4 rounded-xl text-white font-headline font-bold text-xs flex items-center justify-center gap-1.5 shadow-md active:scale-95 transition-all text-center" style="background: #ff5e00;">
                <span>Bắt đầu dự án</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
            <a href="{{ route('services.index') }}" class="flex-1 py-3 px-4 rounded-xl bg-white border border-slate-300 text-slate-800 font-headline font-bold text-xs flex items-center justify-center gap-1.5 shadow-xs active:scale-95 transition-all text-center">
                <span>Xem giải pháp công nghệ</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    </div>

</section>