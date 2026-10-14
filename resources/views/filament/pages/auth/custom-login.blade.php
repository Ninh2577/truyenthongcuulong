<div class="cl-login-universe">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --cl-orange-primary: #FF5400;
            --cl-orange-hover: #E04700;
            --cl-orange-gradient: linear-gradient(90deg, #FF6B00 0%, #FF4500 100%);
            --cl-text-dark: #0F172A;
            --cl-text-muted: #64748B;
            --cl-border-light: #E2E8F0;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }

        /* ── Fullscreen Background Universe ── */
        .cl-login-universe {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc url('{{ asset('images/login-bg.jpg') }}') center center / cover no-repeat;
            overflow-x: hidden;
            overflow-y: auto;
            z-index: 99999;
            color: var(--cl-text-dark);
            color-scheme: light !important;
            padding: 2.5rem 4rem;
            box-sizing: border-box;
        }

        /* Soft highlight wash on the left to ensure crisp text contrast over the sky/bridge */
        .cl-login-universe::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0.42) 0%,
                rgba(255, 255, 255, 0.22) 42%,
                rgba(255, 255, 255, 0.04) 100%
            );
            pointer-events: none;
            z-index: 1;
        }

        /* ── Top Bar ── */
        .cl-top-bar {
            position: absolute;
            top: 2.2rem;
            left: 4.5rem;
            right: 4.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 20;
            pointer-events: auto;
        }

        /* Top Brand Logo */
        .cl-brand-header {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
        }
        .cl-brand-header img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.12));
        }
        .cl-brand-header-text {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
        }
        .cl-brand-header-name {
            font-size: 0.98rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            color: #0F172A;
            text-transform: uppercase;
        }
        .cl-brand-header-media {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            color: #64748B;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-top: 3px;
        }
        .cl-brand-header-media::before,
        .cl-brand-header-media::after {
            content: '';
            display: inline-block;
            width: 14px;
            height: 1px;
            background-color: #94A3B8;
        }

        /* Top Right Tagline */
        .cl-top-tagline {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            letter-spacing: 0.02em;
        }
        .cl-top-tagline-bar {
            width: 24px;
            height: 2.5px;
            background-color: var(--cl-orange-primary);
            border-radius: 9999px;
            display: inline-block;
        }

        /* ── Left Hero Area ── */
        .cl-hero-section {
            position: relative;
            z-index: 10;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            padding-bottom: 3.5rem;
            margin-left: 0.5rem;
            animation: fadeIn 0.8s ease-out;
        }

        .cl-hero-badge {
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #334155;
            margin-bottom: 0.6rem;
            display: inline-block;
        }

        .cl-hero-title-dark {
            font-size: 3.4rem;
            font-weight: 800;
            color: #0F172A;
            line-height: 1.05;
            letter-spacing: -0.03em;
            margin: 0;
        }

        .cl-hero-title-orange {
            font-size: 3.4rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FF5400 0%, #EA580C 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.1;
            letter-spacing: -0.03em;
            margin: 0 0 1rem 0;
        }

        .cl-hero-desc {
            font-size: 0.95rem;
            color: #475569;
            line-height: 1.55;
            max-width: 440px;
            margin: 0 0 2rem 0;
        }

        /* 3 Solution Badges Row */
        .cl-features-row {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-top: 0.5rem;
        }

        .cl-feature-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .cl-feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(234, 88, 12, 0.28);
        }

        .icon-media {
            background: linear-gradient(135deg, #FF4500 0%, #DC2626 100%);
        }
        .icon-studio {
            background: linear-gradient(135deg, #FF6B00 0%, #EA580C 100%);
        }
        .icon-tech {
            background: linear-gradient(135deg, #FF8A00 0%, #D97706 100%);
        }

        .cl-feature-icon svg {
            width: 22px;
            height: 22px;
        }

        .cl-feature-info {
            display: flex;
            flex-direction: column;
        }
        .cl-feature-name {
            font-size: 0.92rem;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.2;
        }
        .cl-feature-sub {
            font-size: 0.72rem;
            color: #64748B;
            line-height: 1.2;
            margin-top: 2px;
            white-space: nowrap;
        }

        /* ── Bottom-Left Sweeping Wave & Badge ── */
        .cl-bottom-wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 540px;
            height: 190px;
            z-index: 15;
            pointer-events: none;
            overflow: hidden;
        }

        .cl-wave-svg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .cl-bottom-badge {
            position: absolute;
            bottom: 2.2rem;
            left: 3.5rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            z-index: 20;
            pointer-events: auto;
        }

        .cl-shield-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #EA580C 0%, #C2410C 100%);
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            flex-shrink: 0;
        }
        .cl-shield-icon svg {
            width: 20px;
            height: 20px;
        }

        .cl-badge-text-group {
            display: flex;
            flex-direction: column;
        }

        .cl-badge-headline {
            font-size: 0.84rem;
            font-weight: 700;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }
        .cl-badge-line {
            width: 32px;
            height: 1.5px;
            background: rgba(255, 255, 255, 0.6);
            display: inline-block;
        }

        .cl-badge-sub {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            margin-top: 1px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        /* ── Right Side: Floating Login Card ── */
        .cl-login-card-wrapper {
            position: relative;
            z-index: 30;
            width: 100%;
            max-width: 480px;
            margin-left: auto;
            margin-right: 1.5rem;
            animation: slideInRight 0.8s ease-out;
        }

        .cl-login-card {
            position: relative;
            background: #FFFFFF;
            border-radius: 28px;
            padding: 2.25rem 2.5rem 1.75rem 2.5rem;
            box-shadow:
                0 25px 60px -15px rgba(0, 0, 0, 0.18),
                0 0 1px 1px rgba(255, 255, 255, 0.9),
                0 10px 25px -5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            box-sizing: border-box;
        }

        /* Top-Left Orange Accent Stroke */
        .cl-login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 85px;
            height: 85px;
            border-top: 3.5px solid var(--cl-orange-primary);
            border-left: 3.5px solid var(--cl-orange-primary);
            border-top-left-radius: 28px;
            pointer-events: none;
            z-index: 5;
        }

        /* Translucent Dragon Watermark in bottom right */
        .cl-card-watermark {
            position: absolute;
            bottom: -22px;
            right: -22px;
            width: 150px;
            height: 150px;
            opacity: 0.06;
            pointer-events: none;
            user-select: none;
            z-index: 1;
        }

        /* Card Content Layer */
        .cl-card-inner {
            position: relative;
            z-index: 2;
        }

        /* Brand logo on card */
        .cl-card-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .cl-card-brand img {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }
        .cl-card-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
            text-align: left;
        }
        .cl-card-brand-name {
            font-size: 0.95rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            color: #0F172A;
            text-transform: uppercase;
        }
        .cl-card-brand-sub {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            color: #64748B;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-top: 2px;
        }
        .cl-card-brand-sub::before,
        .cl-card-brand-sub::after {
            content: '';
            display: inline-block;
            width: 12px;
            height: 1px;
            background-color: #94A3B8;
        }

        /* Heading with Orange Bar */
        .cl-card-heading-group {
            margin-bottom: 1.25rem;
        }
        .cl-card-heading-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .cl-heading-bar {
            width: 4px;
            height: 22px;
            background-color: var(--cl-orange-primary);
            border-radius: 9999px;
            flex-shrink: 0;
        }
        .cl-card-heading-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0F172A;
            margin: 0;
            letter-spacing: -0.01em;
        }
        .cl-card-heading-subtitle {
            font-size: 0.78rem;
            color: #64748B;
            margin-top: 0.35rem;
            line-height: 1.45;
        }

        /* ── Form Inputs & Overrides ── */
        .fi-form-override {
            width: 100%;
        }

        /* Field labels */
        .fi-form-override label {
            font-size: 0.76rem !important;
            color: #334155 !important;
            font-weight: 600 !important;
            margin-bottom: 0.35rem !important;
            letter-spacing: 0.01em;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }
        .fi-form-override sup {
            color: #EF4444 !important;
            font-size: 0.85rem !important;
            top: -0.1em !important;
            font-weight: 700;
        }

        .fi-form-override .fi-fo-field-wrp {
            margin-bottom: 0.65rem !important;
        }
        .fi-form-override .fi-fo-field-wrp:last-child {
            margin-bottom: 0 !important;
        }

        /* Text & Password inputs */
        .fi-form-override input:not([type="checkbox"]) {
            background-color: #FFFFFF !important;
            border: 1.5px solid #E2E8F0 !important;
            color: #0F172A !important;
            border-radius: 12px !important;
            padding: 0.65rem 0.85rem !important;
            font-size: 0.85rem !important;
            transition: all 0.25s ease !important;
            width: 100% !important;
            box-sizing: border-box !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03) !important;
        }
        .fi-form-override input:not([type="checkbox"])::placeholder {
            color: #94A3B8 !important;
            font-weight: 400 !important;
        }
        .fi-form-override input:not([type="checkbox"]):focus {
            border-color: var(--cl-orange-primary) !important;
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.12), 0 1px 2px rgba(0,0,0,0.05) !important;
            outline: none !important;
            background-color: #FFFFFF !important;
        }

        .fi-form-override .fi-input-wrp {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }
        .fi-form-override .fi-input-wrp > svg,
        .fi-form-override .fi-prefix-icon svg {
            color: #64748B !important;
            width: 1.15rem;
            height: 1.15rem;
        }

        /* Password single toggle button */
        .fi-form-override .fi-input-wrp-suffix [x-show*="isPasswordRevealed"] {
            display: none !important;
        }
        .pw-single-toggle {
            background: transparent;
            border: none;
            padding: 0 0.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: #94A3B8;
            transition: color 0.2s ease;
        }
        .pw-single-toggle:hover {
            color: var(--cl-orange-primary);
        }
        .pw-single-toggle svg {
            width: 1.15rem;
            height: 1.15rem;
            flex-shrink: 0;
        }

        /* Checkbox styling */
        .fi-form-override input[type="checkbox"] {
            appearance: none !important;
            -webkit-appearance: none !important;
            background-color: #FFFFFF !important;
            border: 1.5px solid #CBD5E1 !important;
            border-radius: 5px !important;
            transition: all 0.2s ease !important;
            width: 1.15rem !important;
            height: 1.15rem !important;
            position: relative !important;
            cursor: pointer !important;
            flex-shrink: 0 !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        }
        .fi-form-override input[type="checkbox"]:hover {
            border-color: var(--cl-orange-primary) !important;
            box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15) !important;
        }
        .fi-form-override input[type="checkbox"]:checked {
            background: var(--cl-orange-gradient) !important;
            border-color: var(--cl-orange-primary) !important;
            box-shadow: 0 2px 6px rgba(255, 84, 0, 0.25) !important;
        }
        .fi-form-override input[type="checkbox"]:checked::after {
            content: '' !important;
            position: absolute !important;
            top: 50% !important; left: 50% !important;
            transform: translate(-50%, -50%) !important;
            width: 0.65rem !important;
            height: 0.65rem !important;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 12 10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.5 5l3 3L10.5 1.5' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }
        .fi-form-override .fi-checkbox-label,
        .fi-form-override span.fi-fo-field-wrp-label,
        .fi-form-override label span {
            color: #334155 !important;
            font-size: 0.78rem !important;
            font-weight: 500 !important;
        }

        /* Captcha Display Box */
        .fi-form-override .captcha-placeholder label {
            font-size: 0.74rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.01em !important;
            color: #334155 !important;
            text-transform: none !important;
            margin-bottom: 0.35rem !important;
        }
        .captcha-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            padding: 0.35rem 0.65rem;
            user-select: none;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.03);
        }
        .captcha-image-wrapper {
            display: flex;
            align-items: center;
            line-height: 1;
        }
        .captcha-image-wrapper img {
            height: 38px;
            width: auto;
            border-radius: 6px;
            display: block;
            user-select: none;
            -webkit-user-drag: none;
        }
        .captcha-refresh {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 0.4rem;
            cursor: pointer;
            color: #64748B;
            transition: all 0.25s ease;
            flex-shrink: 0;
            line-height: 0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .captcha-refresh:hover {
            color: var(--cl-orange-primary);
            border-color: var(--cl-orange-primary);
            transform: rotate(180deg);
        }
        .fi-form-override .captcha-input-wrapper {
            margin-top: 0.35rem !important;
        }
        .fi-form-override .captcha-input-wrapper .fi-prefix-icon svg {
            color: var(--cl-orange-primary) !important;
        }

        /* ── Submit Button ── */
        .cl-submit-btn {
            width: 100%;
            height: 46px;
            border-radius: 12px;
            background: var(--cl-orange-gradient);
            color: #FFFFFF;
            font-weight: 700;
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 8px 20px -3px rgba(255, 84, 0, 0.4);
            font-family: inherit;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
        }
        .cl-submit-btn:hover {
            box-shadow: 0 12px 28px -3px rgba(255, 84, 0, 0.5);
            transform: translateY(-1px);
        }
        .cl-submit-btn:active {
            transform: translateY(1px);
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.3);
        }
        .cl-btn-text {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
        }
        .cl-btn-arrow {
            transition: transform 0.25s ease;
            display: inline-block;
        }
        .cl-submit-btn:hover .cl-btn-arrow {
            transform: translateX(4px);
        }

        /* ── Security Badges Row ── */
        .cl-security-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.25rem;
            margin-top: 1.15rem;
            font-size: 0.68rem;
            color: #64748B;
        }
        .cl-sec-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }
        .cl-sec-item svg {
            width: 14px;
            height: 14px;
            color: #64748B;
            flex-shrink: 0;
        }

        /* ── Card Footer ── */
        .cl-card-footer {
            text-align: center;
            font-size: 0.68rem;
            color: #94A3B8;
            margin-top: 0.85rem;
            letter-spacing: 0.01em;
        }

        /* ── Validation Error Styling ── */
        .fi-form-override .fi-input-wrp.fi-invalid input {
            border-color: #EF4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
        }
        .fi-form-override p.fi-fo-field-wrp-validation-error {
            display: flex !important;
            align-items: center !important;
            gap: 0.35rem !important;
            margin-top: 0.25rem !important;
            padding: 0.25rem 0.5rem !important;
            font-size: 0.72rem !important;
            font-weight: 500 !important;
            color: #DC2626 !important;
            background: #FEF2F2 !important;
            border-left: 2.5px solid #EF4444 !important;
            border-radius: 0 6px 6px 0 !important;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── Responsive Rules ── */
        @media (max-width: 1200px) {
            .cl-login-universe {
                padding: 2rem 2.5rem;
            }
            .cl-top-bar {
                left: 2.5rem;
                right: 2.5rem;
            }
            .cl-hero-title-dark,
            .cl-hero-title-orange {
                font-size: 2.75rem;
            }
            .cl-features-row {
                gap: 1.25rem;
            }
        }

        @media (max-width: 1024px) {
            .cl-login-universe {
                flex-direction: column;
                justify-content: flex-start;
                padding: 1.5rem;
                overflow-y: auto;
            }
            .cl-top-bar {
                position: relative;
                top: 0; left: 0; right: 0;
                margin-bottom: 2rem;
                width: 100%;
            }
            .cl-hero-section {
                text-align: center;
                align-items: center;
                padding-bottom: 2rem;
                margin-left: 0;
            }
            .cl-hero-desc {
                margin: 0 auto 1.5rem auto;
            }
            .cl-features-row {
                justify-content: center;
                flex-wrap: wrap;
                margin-bottom: 1.5rem;
            }
            .cl-bottom-wave-container {
                display: none;
            }
            .cl-login-card-wrapper {
                margin: 0 auto;
            }
        }

        @media (max-width: 640px) {
            .cl-top-tagline {
                display: none;
            }
            .cl-login-card {
                padding: 1.75rem 1.5rem;
                border-radius: 20px;
            }
            .cl-hero-title-dark,
            .cl-hero-title-orange {
                font-size: 2.2rem;
            }
            .cl-features-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.85rem;
            }
        }
    </style>

    <!-- Top Bar -->
    <div class="cl-top-bar">
        <!-- Logo Top Left -->
        <div class="cl-brand-header">
            <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Cửu Long Media" />
            <div class="cl-brand-header-text">
                <span class="cl-brand-header-name">TRUYỀN THÔNG</span>
                <span class="cl-brand-header-name">CỬU LONG</span>
                <span class="cl-brand-header-media">MEDIA</span>
            </div>
        </div>

        <!-- Tagline Top Right -->
        <div class="cl-top-tagline">
            <span class="cl-top-tagline-bar"></span>
            <span>Sáng tạo nội dung &bull; Kiến tạo giá trị</span>
        </div>
    </div>

    <!-- Left Hero Section -->
    <div class="cl-hero-section">
        <div class="cl-hero-badge">HỆ THỐNG QUẢN TRỊ</div>
        <h1 class="cl-hero-title-dark">Truyền Thông</h1>
        <h1 class="cl-hero-title-orange">Cửu Long</h1>
        <p class="cl-hero-desc">
            Nền tảng quản lý nội dung và vận hành hệ thống truyền thông số chuyên nghiệp.
        </p>

        <!-- 3 Feature Chips -->
        <div class="cl-features-row">
            <!-- Media -->
            <div class="cl-feature-card">
                <div class="cl-feature-icon icon-media">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653z"/>
                    </svg>
                </div>
                <div class="cl-feature-info">
                    <span class="cl-feature-name">Media</span>
                    <span class="cl-feature-sub">Sản xuất &bull; Hậu kỳ</span>
                </div>
            </div>

            <!-- Studio -->
            <div class="cl-feature-card">
                <div class="cl-feature-icon icon-studio">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="cl-feature-info">
                    <span class="cl-feature-name">Studio</span>
                    <span class="cl-feature-sub">Chụp ảnh &bull; Quay phim</span>
                </div>
            </div>

            <!-- Tech -->
            <div class="cl-feature-card">
                <div class="cl-feature-icon icon-tech">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="cl-feature-info">
                    <span class="cl-feature-name">Tech</span>
                    <span class="cl-feature-sub">Giải pháp công nghệ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Left Decorative Wave & Badge -->
    <div class="cl-bottom-wave-container">
        <svg class="cl-wave-svg" viewBox="0 0 540 190" preserveAspectRatio="none">
            <defs>
                <linearGradient id="clWaveGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#9A3412" stop-opacity="0.95" />
                    <stop offset="45%" stop-color="#C2410C" stop-opacity="0.95" />
                    <stop offset="100%" stop-color="#EA580C" stop-opacity="0.9" />
                </linearGradient>
            </defs>
            <path d="M 0,70 Q 230,15 370,115 T 540,190 L 0,190 Z" fill="url(#clWaveGrad)"/>
        </svg>

        <div class="cl-bottom-badge">
            <div class="cl-shield-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                </svg>
            </div>
            <div class="cl-badge-text-group">
                <div class="cl-badge-headline">
                    <span>Chất lượng tạo nên uy tín</span>
                    <span class="cl-badge-line"></span>
                </div>
                <div class="cl-badge-sub">Cửu Long Media</div>
            </div>
        </div>
    </div>

    <!-- Right Side: The Login Card -->
    <div class="cl-login-card-wrapper">
        <div class="cl-login-card">
            <!-- Translucent Watermark Dragon -->
            <img src="{{ asset('images/logo-ttcl.png') }}" alt="" class="cl-card-watermark" />

            <div class="cl-card-inner">
                <!-- Centered Logo inside Card -->
                <div class="cl-card-brand">
                    <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Cửu Long Media" />
                    <div class="cl-card-brand-text">
                        <span class="cl-card-brand-name">TRUYỀN THÔNG</span>
                        <span class="cl-card-brand-name">CỬU LONG</span>
                        <span class="cl-card-brand-sub">MEDIA</span>
                    </div>
                </div>

                <!-- Card Heading -->
                <div class="cl-card-heading-group">
                    <div class="cl-card-heading-row">
                        <span class="cl-heading-bar"></span>
                        <h2 class="cl-card-heading-title">Đăng nhập quản trị</h2>
                    </div>
                    <p class="cl-card-heading-subtitle">
                        Nhập thông tin đăng nhập để truy cập hệ thống quản trị Truyền Thông Cửu Long Media.
                    </p>
                </div>

                <!-- Filament Login Form -->
                <x-filament-panels::form wire:submit="authenticate" novalidate>
                    <div class="fi-form-override">
                        {{ $this->form }}
                    </div>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="authenticate"
                        class="cl-submit-btn"
                        id="cl-magnetic-btn"
                    >
                        <span wire:loading.remove wire:target="authenticate" class="cl-btn-text">
                            ĐĂNG NHẬP <span class="cl-btn-arrow">&rarr;</span>
                        </span>
                        <span wire:loading wire:target="authenticate">Đang xác thực...</span>
                    </button>
                </x-filament-panels::form>

                <!-- Security Badges -->
                <div class="cl-security-row">
                    <div class="cl-sec-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Mã hóa SSL 256-bit</span>
                    </div>
                    <div class="cl-sec-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Rate Limiting chống Brute-Force</span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="cl-card-footer">
                    &copy; 2026 Truyền Thông Cửu Long. Hệ quản trị nội bộ.
                </div>
            </div>
        </div>
    </div>

    <!-- Password Reveal Toggle Script -->
    <script>
        var SVG_EYE = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
        var SVG_EYE_OFF = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';

        function setupPasswordSingleToggle() {
            var suffixDiv = document.querySelector('.fi-form-override .fi-input-wrp-suffix');
            if (!suffixDiv) return;

            var existing = suffixDiv.querySelector('.pw-single-toggle');
            if (existing) existing.remove();

            var allXShow = Array.from(suffixDiv.querySelectorAll('[x-show]'));
            var showBtn = allXShow.find(function(el) {
                return el.getAttribute('x-show').indexOf('!') !== -1;
            });
            var hideBtn = allXShow.find(function(el) {
                return el.getAttribute('x-show').indexOf('!') === -1;
            });
            if (!showBtn || !hideBtn) return;

            var inputWrp = suffixDiv.closest('.fi-input-wrp');
            if (!inputWrp) return;

            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'pw-single-toggle';
            btn.title = 'Hiện / Ẩn Mật Khẩu';
            btn.innerHTML = SVG_EYE;

            btn.addEventListener('click', function() {
                var input = inputWrp.querySelector('input');
                if (!input) return;

                if (input.type === 'password') {
                    showBtn.click();
                    btn.innerHTML = SVG_EYE_OFF;
                } else {
                    hideBtn.click();
                    btn.innerHTML = SVG_EYE;
                }
            });

            suffixDiv.appendChild(btn);
        }

        document.addEventListener('alpine:initialized', setupPasswordSingleToggle);

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(setupPasswordSingleToggle, 200);
            setTimeout(setupPasswordSingleToggle, 600);

            try {
                var magnetBtn = document.getElementById('cl-magnetic-btn');
                if (magnetBtn && typeof gsap !== 'undefined' && window.innerWidth > 992
                    && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    var xTo = gsap.quickTo(magnetBtn, 'x', {duration: 0.4, ease: 'power3'});
                    var yTo = gsap.quickTo(magnetBtn, 'y', {duration: 0.4, ease: 'power3'});
                    magnetBtn.addEventListener('mousemove', function(e) {
                        var r = magnetBtn.getBoundingClientRect();
                        xTo((e.clientX - r.left - r.width  / 2) * 0.15);
                        yTo((e.clientY - r.top  - r.height / 2) * 0.15);
                    });
                    magnetBtn.addEventListener('mouseleave', function() { xTo(0); yTo(0); });
                }
            } catch(e) {}
        });

        document.addEventListener('livewire:update', function() {
            setTimeout(setupPasswordSingleToggle, 200);
        });
    </script>
</div>
