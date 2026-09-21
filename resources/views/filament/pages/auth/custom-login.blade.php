<div class="auth-split-universe dark" style="color-scheme: dark;">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        :root {
            --bg-left: #080C16;
            --bg-right: #0B132B;
            --brand-amber: #f59e0b;
            --brand-orange: #ea580c;
            --text-primary: #ffffff;
            --text-secondary: #94A3B8;
            --input-bg: #131B2F;
            --input-border: rgba(255, 255, 255, 0.1);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .auth-split-universe {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            display: flex; color: var(--text-primary);
            overflow: hidden; z-index: 99999;
            background-color: var(--bg-right);
        }

        /* --- LEFT SIDE (BRAND) --- */
        .split-left {
            flex: 1.2; background-color: var(--bg-left); position: relative;
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 2rem 2.5rem; overflow: hidden;
        }

        .dot-grid {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(rgba(245, 158, 11, 0.08) 1px, transparent 1px);
            background-size: 24px 24px; z-index: 1; pointer-events: none;
        }

        .radar-circles {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 800px; height: 800px; border-radius: 50%;
            border: 1px dashed rgba(255, 255, 255, 0.03); z-index: 1; pointer-events: none;
            box-shadow: 0 0 0 150px rgba(255,255,255,0.01), 0 0 0 300px rgba(255,255,255,0.01);
        }

        .glow-blob {
            position: absolute; border-radius: 50%; filter: blur(90px); z-index: 2; pointer-events: none;
        }
        .blob-1 { width: 500px; height: 500px; background: rgba(245, 158, 11, 0.15); top: -100px; left: -100px; }
        .blob-2 { width: 450px; height: 450px; background: rgba(30, 58, 138, 0.2); bottom: -50px; right: -50px; }

        .left-header { display: flex; align-items: center; gap: 0.75rem; z-index: 10; flex-shrink: 0; }
        .status-dot {
            width: 8px; height: 8px; border-radius: 50%; background-color: #10B981;
            box-shadow: 0 0 10px #10B981; animation: pulseDot 2s infinite;
        }
        .header-title { font-family: 'Space Grotesk', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; color: var(--text-secondary); text-transform: uppercase; }

        .left-content { z-index: 10; display: flex; flex-direction: column; align-items: center; text-align: center; }
        .brand-logo-container { position: relative; margin-bottom: 1.5rem; }
        .brand-logo-glow {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 120%; height: 120%; border-radius: 50%; background: rgba(245, 158, 11, 0.3);
            filter: blur(20px); animation: pulseGlow 3s infinite alternate ease-in-out; z-index: -1;
        }
        .brand-logo { width: 110px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.5)); }

        .main-title {
            font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700;
            letter-spacing: 0.2em; margin-bottom: 0.6rem; text-transform: uppercase;
            opacity: 0; transform: translateY(20px); animation: fadeSlideUp 0.8s forwards 0.1s;
        }
        .tagline {
            font-size: 0.8rem; font-weight: 700; letter-spacing: 0.4em; color: var(--brand-amber);
            margin-bottom: 0.6rem; text-transform: uppercase;
            opacity: 0; transform: translateY(20px); animation: fadeSlideUp 0.8s forwards 0.2s;
        }
        .sub-tagline {
            font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 1.2rem;
            opacity: 0; transform: translateY(20px); animation: fadeSlideUp 0.8s forwards 0.3s;
        }
        .divider { display: flex; align-items: center; justify-content: center; gap: 1rem; width: 100%; max-width: 200px; margin: 0 auto; opacity: 0; animation: fadeSlideUp 0.8s forwards 0.4s; }
        .divider-line { height: 1px; background: rgba(255,255,255,0.1); flex: 1; }
        .divider-dot { width: 4px; height: 4px; border-radius: 50%; background: var(--brand-amber); }

        .left-footer { z-index: 10; display: flex; justify-content: space-between; align-items: center; width: 100%; font-family: 'Space Grotesk', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em; opacity: 0; animation: fadeSlideUp 0.8s forwards 0.5s; }
        .footer-system { display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary); text-transform: uppercase; }

        /* --- RIGHT SIDE (FORM) --- */
        .split-right {
            flex: 1; background-color: var(--bg-right); position: relative;
            display: flex; flex-direction: column;
            padding: 1.25rem 2.5rem 1rem 2.5rem;
            overflow-y: auto; overflow-x: hidden;
        }

        .right-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;
            font-family: 'Space Grotesk', sans-serif; font-size: 0.7rem; letter-spacing: 0.1em; color: var(--text-secondary); text-transform: uppercase;
            opacity: 0; animation: fadeIn 0.8s forwards 0.3s;
            flex-shrink: 0;
        }
        .badge-zero-trust { display: flex; align-items: center; gap: 0.5rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.05); padding: 0.35rem 0.9rem; border-radius: 999px; }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; background-color: var(--brand-amber); }

        .form-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%; max-width: 420px;
            padding: 0.5rem 0;
            opacity: 0; transform: translateX(30px); animation: slideInRight 0.8s forwards 0.15s;
        }

        .form-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700; margin-bottom: 0.2rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .form-subtitle { font-size: 0.78rem; color: var(--text-secondary); margin-bottom: 1rem; line-height: 1.4; }

        /* Form Overrides */
        .fi-form-override { width: 100%; }
        .fi-form-override label { font-size: 0.72rem !important; color: var(--text-secondary) !important; font-weight: 600 !important; margin-bottom: 0.35rem !important; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 0.25rem; }
        .fi-form-override sup { color: var(--brand-amber) !important; font-size: 1rem !important; top: -0.2em !important; }

        /* Khoang cach giua cac field - compact */
        .fi-form-override .fi-fo-field-wrp { margin-bottom: 0.5rem !important; }
        .fi-form-override .fi-fo-field-wrp:last-child { margin-bottom: 0 !important; }

        .fi-form-override input:not([type="checkbox"]) {
            background-color: var(--input-bg) !important; border: 1px solid var(--input-border) !important;
            color: var(--text-primary) !important; border-radius: 8px !important;
            padding-top: 0.6rem !important; padding-bottom: 0.6rem !important;
            font-size: 0.875rem !important; transition: all 0.3s ease !important;
            width: 100% !important; box-sizing: border-box !important; box-shadow: inset 0 2px 4px rgba(0,0,0,0.2) !important;
        }
        .fi-form-override input:not([type="checkbox"]):focus {
            border-color: var(--brand-amber) !important;
            box-shadow: 0 0 0 1px var(--brand-amber), 0 0 15px rgba(245, 158, 11, 0.15), inset 0 2px 4px rgba(0,0,0,0.2) !important;
            outline: none !important;
        }
        .fi-form-override .fi-input-wrp { background: transparent !important; box-shadow: none !important; border: none !important; }
        .fi-form-override .fi-input-wrp > svg, .fi-form-override .fi-prefix-icon svg { color: var(--text-secondary) !important; }

        /* Alpine x-cloak */
        [x-cloak] { display: none !important; }

        /* ============================================================
           SINGLE PASSWORD TOGGLE
           An ca 2 button goc cua Filament (Show + Hide).
           JS se tao 1 button tuy chinh duy nhat thay the.
           ============================================================ */
        .fi-form-override .fi-input-wrp-suffix [x-show*="isPasswordRevealed"] {
            display: none !important;
        }
        /* Single toggle button custom */
        .pw-single-toggle {
            background: transparent;
            border: none;
            padding: 0 0.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: rgba(148,163,184,0.8);
            transition: color 0.2s ease;
        }
        .pw-single-toggle:hover {
            color: var(--brand-amber);
        }
        .pw-single-toggle svg {
            width: 1.2rem;
            height: 1.2rem;
            flex-shrink: 0;
        }

        /* Custom Checkbox voi dau tick dep */
        .fi-form-override input[type="checkbox"] {
            appearance: none !important; -webkit-appearance: none !important;
            background-color: var(--input-bg) !important;
            border: 1.5px solid rgba(255,255,255,0.2) !important;
            border-radius: 5px !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            width: 1.25rem !important; height: 1.25rem !important;
            position: relative !important; cursor: pointer !important;
            flex-shrink: 0 !important;
        }
        .fi-form-override input[type="checkbox"]:hover {
            border-color: var(--brand-amber) !important;
            box-shadow: 0 0 0 3px rgba(245,158,11,0.15) !important;
        }
        .fi-form-override input[type="checkbox"]:checked {
            background: linear-gradient(135deg, var(--brand-amber), var(--brand-orange)) !important;
            border-color: var(--brand-amber) !important;
            transform: scale(1.05) !important;
            box-shadow: 0 0 0 3px rgba(245,158,11,0.2), 0 2px 8px rgba(234,88,12,0.3) !important;
        }
        .fi-form-override input[type="checkbox"]:checked::after {
            content: '' !important;
            position: absolute !important;
            top: 50% !important; left: 50% !important;
            transform: translate(-50%, -50%) !important;
            width: 0.65rem !important; height: 0.65rem !important;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 12 10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.5 5l3 3L10.5 1.5' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }

        /* CAPTCHA Display */
        .fi-form-override .captcha-placeholder label {
            font-size: 0.63rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.12em !important;
            color: var(--brand-amber) !important;
            text-transform: uppercase !important;
            margin-bottom: 0.3rem !important;
        }
        .captcha-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0,0,0,0.4);
            border: 1px solid rgba(245,158,11,0.3);
            border-radius: 8px;
            padding: 0.35rem 0.75rem;
            user-select: none;
            backdrop-filter: blur(4px);
            position: relative;
            overflow: hidden;
        }
        .captcha-box::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(
                45deg,
                rgba(255,255,255,0.015) 0px, rgba(255,255,255,0.015) 1px,
                transparent 1px, transparent 8px
            );
            pointer-events: none;
        }
        .captcha-chars,
        .captcha-image-wrapper {
            display: flex;
            align-items: center;
            line-height: 1;
        }
        .captcha-image-wrapper img {
            height: 40px;
            width: auto;
            border-radius: 5px;
            display: block;
            user-select: none;
            -webkit-user-drag: none;
        }
        .captcha-refresh {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 7px;
            padding: 0.35rem 0.45rem;
            cursor: pointer;
            color: rgba(148,163,184,0.8);
            transition: color 0.25s ease, border-color 0.25s ease, transform 0.35s ease;
            flex-shrink: 0;
            line-height: 0;
        }
        .captcha-refresh:hover {
            color: var(--brand-amber);
            border-color: rgba(245,158,11,0.5);
            transform: rotate(180deg);
        }
        .fi-form-override .captcha-input-wrapper {
            margin-top: 0.3rem !important;
        }
        .fi-form-override .captcha-input-wrapper .fi-prefix-icon svg {
            color: var(--brand-amber) !important;
        }

        .btn-primary {
            width: 100%; padding: 0.75rem; border-radius: 9999px;
            background: linear-gradient(90deg, var(--brand-amber), var(--brand-orange));
            color: #ffffff; font-weight: 700; font-size: 0.85rem; border: none; cursor: pointer;
            transition: box-shadow 0.3s ease; display: flex; justify-content: center; align-items: center; gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(234, 88, 12, 0.2); font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase; letter-spacing: 0.1em;
            position: relative; overflow: hidden;
            margin-top: 0.75rem;
        }
        .btn-content-wrapper { display: flex; align-items: center; justify-content: center; gap: 0.5rem; pointer-events: none; }
        .btn-arrow { transition: transform 0.3s ease; }
        .btn-primary:hover .btn-arrow { transform: translateX(5px); }
        .btn-primary:hover { box-shadow: 0 12px 30px rgba(234, 88, 12, 0.4); }

        .security-badges { display: flex; justify-content: center; gap: 1.5rem; margin-top: 1.25rem; font-size: 0.72rem; color: var(--text-secondary); opacity: 0; animation: slideInRight 0.8s forwards 0.25s; flex-shrink: 0; }
        .security-badge { display: flex; align-items: center; gap: 0.4rem; }
        .right-footer { text-align: center; font-size: 0.7rem; color: rgba(148, 163, 184, 0.5); padding-top: 0.75rem; opacity: 0; animation: slideInRight 0.8s forwards 0.35s; flex-shrink: 0; }

        /* ============================================================
           VALIDATION ERROR STYLING
           Giao dien bao loi dep mat, phu hop voi theme toi Amber.
           ============================================================ */

        /* Border do + hover khi field bi invalid
           LUU Y: fi-invalid o tren .fi-input-wrp (khong phai fi-fo-field-wrp)
        */
        .fi-form-override .fi-input-wrp.fi-invalid {
            border: 1.5px solid rgba(239, 68, 68, 0.7) !important;
            box-shadow: 0 0 0 2px rgba(239,68,68,0.15), 0 0 14px rgba(239,68,68,0.08) !important;
            --tw-ring-shadow: none !important;
            --tw-ring-color: transparent !important;
            transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
        }

        /* HOVER: vien do sang hon, glow manh hon */
        .fi-form-override .fi-input-wrp.fi-invalid:hover {
            border-color: rgba(239, 68, 68, 1) !important;
            box-shadow:
                0 0 0 3px rgba(239,68,68,0.22),
                0 0 22px rgba(239,68,68,0.2),
                inset 0 2px 4px rgba(0,0,0,0.25) !important;
        }

        /* Icon prefix doi sang mau do khi invalid */
        .fi-form-override .fi-input-wrp.fi-invalid .fi-input-wrp-prefix svg {
            color: rgba(239,68,68,0.8) !important;
            transition: color 0.25s ease !important;
        }
        .fi-form-override .fi-input-wrp.fi-invalid:hover .fi-input-wrp-prefix svg {
            color: rgba(239,68,68,1) !important;
        }

        /* Dong bao loi ben duoi field */
        .fi-form-override p.fi-fo-field-wrp-validation-error {
            display: flex !important;
            align-items: center !important;
            gap: 0.4rem !important;
            margin-top: 0.35rem !important;
            padding: 0.4rem 0.7rem !important;
            font-size: 0.72rem !important;
            font-weight: 500 !important;
            color: #fca5a5 !important;
            background: linear-gradient(90deg, rgba(239,68,68,0.12), rgba(239,68,68,0.06)) !important;
            border-left: 2.5px solid rgba(239,68,68,0.7) !important;
            border-radius: 0 6px 6px 0 !important;
            animation: errorSlideIn 0.25s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
        }

        /* Icon ! tu dong truoc message */
        .fi-form-override p.fi-fo-field-wrp-validation-error::before {
            content: '!';
            flex-shrink: 0;
            width: 1.1rem;
            height: 1.1rem;
            background: rgba(239,68,68,0.25);
            border: 1px solid rgba(239,68,68,0.5);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            color: #f87171;
            line-height: 1;
        }

        @keyframes errorSlideIn {
            from { opacity: 0; transform: translateY(-4px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Notifications chung cua Filament (toast) */
        .fi-notifications [data-sonner-toast] {
            background: rgba(15,23,42,0.95) !important;
            border: 1px solid rgba(239,68,68,0.35) !important;
            backdrop-filter: blur(12px) !important;
            border-radius: 10px !important;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4) !important;
        }

        @keyframes pulseDot { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.2); } }
        @keyframes pulseGlow { 0% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); } 100% { opacity: 1; transform: translate(-50%, -50%) scale(1.15); } }
        @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }

        @media (prefers-reduced-motion: reduce) {
            *, ::before, ::after { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; scroll-behavior: auto !important; }
        }

        @media (max-width: 992px) {
            .auth-split-universe { flex-direction: column; overflow-y: auto; }
            .split-left { flex: none; padding: 1.5rem 1.5rem; justify-content: center; text-align: center; }
            .split-left .left-header, .split-left .sub-tagline, .split-left .divider, .split-left .left-footer, .split-left .glow-blob, .split-left .radar-circles { display: none; }
            .brand-logo { width: 70px; margin-bottom: 0.75rem; }
            .main-title { font-size: 1.3rem; margin-bottom: 0.2rem; }
            .tagline { font-size: 0.65rem; margin-bottom: 0; }
            .split-right { padding: 1.5rem 1.5rem; overflow: visible; }
            .right-header { display: none; }
            .form-wrapper { margin: 0 auto; flex: none; }
        }
    </style>

    <!-- LEFT SIDE -->
    <div class="split-left">
        <div class="dot-grid"></div>
        <div class="radar-circles"></div>
        <div class="glow-blob blob-1"></div>
        <div class="glow-blob blob-2"></div>

        <div class="left-header">
            <div class="status-dot"></div>
            <div class="header-title">Cửu Long Digital Ecosystem</div>
        </div>

        <div class="left-content">
            <div class="brand-logo-container">
                <div class="brand-logo-glow"></div>
                <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo" class="brand-logo">
            </div>
            <h1 class="main-title">Truyền Thông Cửu Long</h1>
            <div class="tagline">Media &middot; Studio &middot; Tech</div>
            <div class="sub-tagline">Cinematic Production &amp; Technology Platform</div>
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-dot"></div>
                <div class="divider-line"></div>
            </div>
        </div>

        <div class="left-footer">
            <div class="footer-system">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Hệ thống vận hành &amp; xác thực nội bộ
            </div>
            {{-- An version: tranh ro ri thong tin he thong --}}
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="split-right">
        <div class="right-header">
            <div class="badge-zero-trust">
                <div class="badge-dot"></div>
                SGN-Cluster-01 &middot; Bảo Mật Zero-Trust
            </div>
            <div>PORTAL: ADMIN</div>
        </div>

        <div class="form-wrapper">
            <h2 class="form-title">Đăng nhập quản trị</h2>
            <p class="form-subtitle">Nhập thông tin định danh cán bộ quản lý hệ sinh thái Cửu Long ID.</p>

            <x-filament-panels::form wire:submit="authenticate" novalidate>
                <div class="fi-form-override">
                    {{ $this->form }}
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="authenticate"
                    class="btn-primary"
                    id="magnetic-btn"
                >
                    <span wire:loading.remove wire:target="authenticate" class="btn-content-wrapper">
                        Đăng Nhập <span class="btn-arrow">&rarr;</span>
                    </span>
                    <span wire:loading wire:target="authenticate">Đang xác thực...</span>
                </button>
            </x-filament-panels::form>

            <div class="security-badges">
                <div class="security-badge">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Mã Hóa SSL 256-bit
                </div>
                <div class="security-badge">&middot;</div>
                <div class="security-badge">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Rate Limiting chống Brute-Force
                </div>
            </div>
        </div>

        <div class="right-footer">
            &copy; 2026 Truyền Thông Cửu Long. Hệ quản trị nội bộ.
        </div>
    </div>

    <script>
        /**
         * Thay 2 nut toggle password (Show + Hide) cua Filament bang 1 nut duy nhat.
         *
         * Cach hoat dong:
         * - CSS da an ca 2 nut goc voi !important
         * - Ham nay tao 1 nut custom vao cuoi fi-input-wrp-suffix
         * - Click nut custom -> programmatic click len nut goc phu hop
         *   (click() tren hidden element van kich Alpine x-on:click handler)
         * - Icon tu dong doi giua eye / eye-off theo trang thai
         */
        var SVG_EYE = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
        var SVG_EYE_OFF = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';

        function setupPasswordSingleToggle() {
            var suffixDiv = document.querySelector('.fi-form-override .fi-input-wrp-suffix');
            if (!suffixDiv) return;

            // Xoa toggle cu neu Livewire re-render
            var existing = suffixDiv.querySelector('.pw-single-toggle');
            if (existing) existing.remove();

            // Tim 2 nut goc (Show va Hide) theo x-show attribute
            var allXShow = Array.from(suffixDiv.querySelectorAll('[x-show]'));
            var showBtn = allXShow.find(function(el) {
                return el.getAttribute('x-show').indexOf('!') !== -1;
            });
            var hideBtn = allXShow.find(function(el) {
                return el.getAttribute('x-show').indexOf('!') === -1;
            });
            if (!showBtn || !hideBtn) return;

            // Tim input mat khau (tim trong fi-input-wrp bao gom suffix)
            var inputWrp = suffixDiv.closest('.fi-input-wrp');
            if (!inputWrp) return;

            // Tao nut toggle duy nhat
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'pw-single-toggle';
            btn.title = 'Hiện / Ẩn Mật Khẩu';
            btn.innerHTML = SVG_EYE;

            btn.addEventListener('click', function() {
                // Kiem tra trang thai hien tai qua input type
                var input = inputWrp.querySelector('input');
                if (!input) return;

                if (input.type === 'password') {
                    // Dang an -> click Show de lo mat khau
                    showBtn.click();
                    btn.innerHTML = SVG_EYE_OFF;
                } else {
                    // Dang lo -> click Hide de an mat khau
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

            // GSAP magnetic button
            try {
                var magnetBtn = document.getElementById('magnetic-btn');
                if (magnetBtn && typeof gsap !== 'undefined' && window.innerWidth > 992
                    && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    var xTo = gsap.quickTo(magnetBtn, 'x', {duration: 0.4, ease: 'power3'});
                    var yTo = gsap.quickTo(magnetBtn, 'y', {duration: 0.4, ease: 'power3'});
                    magnetBtn.addEventListener('mousemove', function(e) {
                        var r = magnetBtn.getBoundingClientRect();
                        xTo((e.clientX - r.left - r.width  / 2) * 0.2);
                        yTo((e.clientY - r.top  - r.height / 2) * 0.2);
                    });
                    magnetBtn.addEventListener('mouseleave', function() { xTo(0); yTo(0); });
                }
            } catch(e) { console.warn('GSAP skipped:', e.message); }
        });

        // Sau moi Livewire re-render (refresh captcha, validation, v.v.)
        document.addEventListener('livewire:update', function() {
            setTimeout(setupPasswordSingleToggle, 200);
        });
    </script>
</div>
