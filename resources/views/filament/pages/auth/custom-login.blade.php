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
            overflow-x: hidden; overflow-y: auto; z-index: 99999;
            background-color: var(--bg-right);
        }

        /* --- LEFT SIDE (BRAND) --- */
        .split-left {
            flex: 1.2; background-color: var(--bg-left); position: relative;
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 3rem; overflow: hidden;
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

        .left-header { display: flex; align-items: center; gap: 0.75rem; z-index: 10; }
        .status-dot {
            width: 8px; height: 8px; border-radius: 50%; background-color: #10B981;
            box-shadow: 0 0 10px #10B981; animation: pulseDot 2s infinite;
        }
        .header-title { font-family: 'Space Grotesk', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; color: var(--text-secondary); text-transform: uppercase; }

        .left-content { z-index: 10; display: flex; flex-direction: column; align-items: center; text-align: center; }
        .brand-logo-container { position: relative; margin-bottom: 2.5rem; }
        .brand-logo-glow {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 120%; height: 120%; border-radius: 50%; background: rgba(245, 158, 11, 0.3);
            filter: blur(20px); animation: pulseGlow 3s infinite alternate ease-in-out; z-index: -1;
        }
        .brand-logo { width: 140px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.5)); }
        
        .main-title {
            font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 700;
            letter-spacing: 0.25em; margin-bottom: 1rem; text-transform: uppercase;
            opacity: 0; transform: translateY(20px); animation: fadeSlideUp 0.8s forwards 0.1s;
        }
        .tagline {
            font-size: 0.9rem; font-weight: 700; letter-spacing: 0.4em; color: var(--brand-amber);
            margin-bottom: 1rem; text-transform: uppercase;
            opacity: 0; transform: translateY(20px); animation: fadeSlideUp 0.8s forwards 0.2s;
        }
        .sub-tagline {
            font-size: 1rem; color: var(--text-secondary); margin-bottom: 2rem;
            opacity: 0; transform: translateY(20px); animation: fadeSlideUp 0.8s forwards 0.3s;
        }
        .divider { display: flex; align-items: center; justify-content: center; gap: 1rem; width: 100%; max-width: 200px; margin: 0 auto; opacity: 0; animation: fadeSlideUp 0.8s forwards 0.4s; }
        .divider-line { height: 1px; background: rgba(255,255,255,0.1); flex: 1; }
        .divider-dot { width: 4px; height: 4px; border-radius: 50%; background: var(--brand-amber); }

        .left-footer { z-index: 10; display: flex; justify-content: space-between; align-items: center; width: 100%; font-family: 'Space Grotesk', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em; opacity: 0; animation: fadeSlideUp 0.8s forwards 0.5s; }
        .footer-system { display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary); text-transform: uppercase; }
        .footer-version { color: var(--brand-amber); font-weight: 600; text-transform: uppercase; }

        /* --- RIGHT SIDE (FORM) --- */
        .split-right {
            flex: 1; background-color: var(--bg-right); position: relative;
            display: flex; flex-direction: column; padding: 3rem 4rem;
        }

        .right-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: auto;
            font-family: 'Space Grotesk', sans-serif; font-size: 0.7rem; letter-spacing: 0.1em; color: var(--text-secondary); text-transform: uppercase;
            opacity: 0; animation: fadeIn 0.8s forwards 0.3s;
        }
        .badge-zero-trust { display: flex; align-items: center; gap: 0.5rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.05); padding: 0.4rem 1rem; border-radius: 999px; }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; background-color: var(--brand-amber); }

        .form-wrapper {
            margin: auto 0; width: 100%; max-width: 420px;
            opacity: 0; transform: translateX(30px); animation: slideInRight 0.8s forwards 0.15s;
        }

        .form-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .form-subtitle { font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 2.5rem; line-height: 1.5; }

        /* Form Overrides */
        .fi-form-override { width: 100%; }
        .fi-form-override label { font-size: 0.75rem !important; color: var(--text-secondary) !important; font-weight: 600 !important; margin-bottom: 0.5rem !important; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 0.25rem; }
        .fi-form-override sup { color: var(--brand-amber) !important; font-size: 1rem !important; top: -0.2em !important; }
        
        .fi-form-override input:not([type="checkbox"]) {
            background-color: var(--input-bg) !important; border: 1px solid var(--input-border) !important;
            color: var(--text-primary) !important; border-radius: 8px !important;
            padding-top: 0.875rem !important; padding-bottom: 0.875rem !important;
            font-size: 0.95rem !important; transition: all 0.3s ease !important; 
            width: 100% !important; box-sizing: border-box !important; box-shadow: inset 0 2px 4px rgba(0,0,0,0.2) !important;
        }
        .fi-form-override input:not([type="checkbox"]):focus {
            border-color: var(--brand-amber) !important; 
            box-shadow: 0 0 0 1px var(--brand-amber), 0 0 15px rgba(245, 158, 11, 0.15), inset 0 2px 4px rgba(0,0,0,0.2) !important;
            outline: none !important;
        }
        .fi-form-override .fi-input-wrp { background: transparent !important; box-shadow: none !important; border: none !important; ring: none !important; }
        .fi-form-override svg { color: var(--text-secondary) !important; }

        /* Custom Checkbox */
        .fi-form-override input[type="checkbox"] {
            appearance: none !important; -webkit-appearance: none !important;
            background-color: var(--input-bg) !important; border: 1px solid var(--input-border) !important; 
            border-radius: 4px !important; transition: all 0.3s ease !important; 
            width: 1.25rem !important; height: 1.25rem !important; position: relative; cursor: pointer;
        }
        .fi-form-override input[type="checkbox"]:checked { background: linear-gradient(135deg, var(--brand-amber), var(--brand-orange)) !important; transform: scale(1.05); }

        .btn-primary {
            width: 100%; padding: 1rem; border-radius: 9999px;
            background: linear-gradient(90deg, var(--brand-amber), var(--brand-orange)); 
            color: #ffffff; font-weight: 700; font-size: 0.9rem; border: none; cursor: pointer; 
            transition: box-shadow 0.3s ease; display: flex; justify-content: center; align-items: center; gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(234, 88, 12, 0.2); font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase; letter-spacing: 0.1em;
            position: relative; overflow: hidden;
            /* Will be animated by GSAP */
        }
        .btn-content-wrapper { display: flex; align-items: center; justify-content: center; gap: 0.5rem; pointer-events: none; }
        .btn-arrow { transition: transform 0.3s ease; }
        .btn-primary:hover .btn-arrow { transform: translateX(5px); }
        .btn-primary:hover { box-shadow: 0 12px 30px rgba(234, 88, 12, 0.4); }

        .security-badges { display: flex; justify-content: center; gap: 1.5rem; margin-top: 3rem; font-size: 0.75rem; color: var(--text-secondary); opacity: 0; animation: slideInRight 0.8s forwards 0.25s; }
        .security-badge { display: flex; align-items: center; gap: 0.4rem; }
        .right-footer { margin-top: auto; text-align: center; font-size: 0.75rem; color: rgba(148, 163, 184, 0.5); padding-top: 2rem; opacity: 0; animation: slideInRight 0.8s forwards 0.35s; }

        /* Animations */
        @keyframes pulseDot { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.2); } }
        @keyframes pulseGlow { 0% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); } 100% { opacity: 1; transform: translate(-50%, -50%) scale(1.15); } }
        @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }

        @media (prefers-reduced-motion: reduce) {
            *, ::before, ::after { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; scroll-behavior: auto !important; }
        }

        @media (max-width: 992px) {
            .auth-split-universe { flex-direction: column; }
            .split-left { flex: none; padding: 2rem 1.5rem; justify-content: center; text-align: center; }
            .split-left .left-header, .split-left .sub-tagline, .split-left .divider, .split-left .left-footer, .split-left .glow-blob, .split-left .radar-circles { display: none; }
            .brand-logo { width: 80px; margin-bottom: 1rem; }
            .main-title { font-size: 1.5rem; margin-bottom: 0.25rem; }
            .tagline { font-size: 0.7rem; margin-bottom: 0; }
            .split-right { padding: 2rem 1.5rem; }
            .right-header { display: none; }
            .form-wrapper { margin: 0 auto; }
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
            <div class="sub-tagline">Cinematic Production & Technology Platform</div>
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-dot"></div>
                <div class="divider-line"></div>
            </div>
        </div>

        <div class="left-footer">
            <div class="footer-system">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Hệ thống vận hành & xác thực nội bộ
            </div>
            <div class="footer-version">Phiên bản v3.0</div>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="split-right">
        <div class="right-header">
            <div class="badge-zero-trust">
                <div class="badge-dot"></div>
                SGN-Cluster-01 &middot; Bảo mật Zero-Trust
            </div>
            <div>PORTAL: ADMIN</div>
        </div>

        <div class="form-wrapper">
            <h2 class="form-title">Đăng nhập quản trị</h2>
            <p class="form-subtitle">Nhập thông tin định danh cán bộ quản lý hệ sinh thái Cửu Long ID.</p>

            <x-filament-panels::form wire:submit="authenticate">
                <div class="fi-form-override">
                    {{ $this->form }}
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="authenticate" class="btn-primary" id="magnetic-btn">
                    <span wire:loading.remove wire:target="authenticate" class="btn-content-wrapper">
                        Đăng nhập <span class="btn-arrow">&rarr;</span>
                    </span>
                    <span wire:loading wire:target="authenticate">Đang xác thực...</span>
                </button>
            </x-filament-panels::form>

            <div class="security-badges">
                <div class="security-badge">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Mã hóa SSL 256-bit
                </div>
                <div class="security-badge">
                    &middot;
                </div>
                <div class="security-badge">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Rate Limiting chống Brute-Force
                </div>
            </div>
        </div>

        <div class="right-footer">
            &copy; 2026 Truyền Thông Cửu Long. Hệ thống quản trị nội bộ.
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('magnetic-btn');
            if (btn && window.innerWidth > 992 && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                const xTo = gsap.quickTo(btn, "x", {duration: 0.4, ease: "power3"}, 0);
                const yTo = gsap.quickTo(btn, "y", {duration: 0.4, ease: "power3"}, 0);

                btn.addEventListener("mousemove", (e) => {
                    const rect = btn.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;
                    const distanceX = e.clientX - centerX;
                    const distanceY = e.clientY - centerY;
                    
                    xTo(distanceX * 0.2);
                    yTo(distanceY * 0.2);
                });

                btn.addEventListener("mouseleave", () => {
                    xTo(0);
                    yTo(0);
                });
            }
        });
    </script>
</div>
