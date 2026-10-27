<x-filament-panels::page.simple>
    <style>
        body {
            background-color: #f3f6fa !important;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(249, 115, 22, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(37, 99, 235, 0.06) 0%, transparent 45%),
                linear-gradient(135deg, #f8fafc 0%, #edf3f9 100%) !important;
            background-attachment: fixed !important;
            min-height: 100vh !important;
        }

        .fi-simple-main {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            outline: none !important;
            max-width: 520px !important;
            padding: 0 !important;
            margin-top: 2rem !important;
            margin-bottom: 2.5rem !important;
        }

        .fi-simple-header {
            display: none !important;
        }

        /* Nút submit form challenge */
        .fi-form-actions button[type="submit"] {
            width: 100% !important;
            padding-top: 14px !important;
            padding-bottom: 14px !important;
            border-radius: 18px !important;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #f59e0b 100%) !important;
            color: #ffffff !important;
            font-size: 15.5px !important;
            font-weight: 800 !important;
            letter-spacing: 0.02em !important;
            border: none !important;
            box-shadow: 0 10px 25px rgba(234, 88, 12, 0.38) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            transition: all 0.25s ease !important;
        }
        .fi-form-actions button[type="submit"]:hover {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 50%, #f97316 100%) !important;
            box-shadow: 0 14px 30px rgba(234, 88, 12, 0.48) !important;
            transform: translateY(-1.5px) !important;
        }

    </style>

    <!-- Họa tiết nền Cửu Long -->
    <div style="position: fixed; top: 0; left: 0; height: 100vh; width: 42%; pointer-events: none; z-index: 0; opacity: 0.18; background-image: url('{{ asset('images/auth-workspace-bg.jpg') }}'); background-size: cover; background-position: left center; -webkit-mask-image: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0) 100%); mask-image: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0) 100%);"></div>

    <!-- Dải sóng góc trên bên trái -->
    <svg style="position: fixed; top: 0; left: 0; width: 220px; height: 160px; pointer-events: none; z-index: 0; opacity: 0.85;" viewBox="0 0 220 160" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0V160C50 140 100 90 150 40C180 15 200 5 220 0H0Z" fill="url(#orangeTopWave)" opacity="0.35"/>
        <path d="M0 0V110C40 95 80 60 120 25C150 5 180 0 220 0H0Z" fill="url(#blueTopWave)" opacity="0.4"/>
        <defs>
            <linearGradient id="orangeTopWave" x1="0" y1="0" x2="220" y2="160" gradientUnits="userSpaceOnUse">
                <stop stop-color="#EA580C"/>
                <stop offset="1" stop-color="#F97316"/>
            </linearGradient>
            <linearGradient id="blueTopWave" x1="0" y1="0" x2="220" y2="160" gradientUnits="userSpaceOnUse">
                <stop stop-color="#2563EB"/>
                <stop offset="1" stop-color="#60A5FA"/>
            </linearGradient>
        </defs>
    </svg>

    <!-- Header Logo Truyền Thông Cửu Long -->
    <div class="relative z-10 flex items-center justify-center gap-3.5 mb-5">
        <img src="{{ asset('images/logo-ttcl.png') }}" alt="Truyền Thông Cửu Long" class="h-11 w-auto object-contain drop-shadow-xs" />
        <div class="h-8 w-px bg-slate-300 dark:bg-slate-700"></div>
        <div class="text-left">
            <div class="text-[15px] font-black tracking-wider text-slate-800 dark:text-white leading-tight">TRUYỀN THÔNG CỬU LONG</div>
            <div class="text-[10px] font-bold tracking-widest text-slate-500 dark:text-slate-400 uppercase">HỆ THỐNG QUẢN TRỊ</div>
        </div>
    </div>

    <!-- Card chính Challenge -->
    <div class="relative z-10 rounded-[30px] border border-white/80 bg-white/95 backdrop-blur-md p-6 sm:p-8 shadow-[0_20px_50px_rgba(15,23,42,0.08)] dark:border-gray-800 dark:bg-gray-900/95 text-center">
        <!-- Minh họa 3D Shield -->
        <div style="position: relative; width: 110px; height: 110px; margin: 0 auto 10px auto; display: flex; align-items: center; justify-content: center;">
            <div style="position: absolute; inset: 0; border-radius: 9999px; background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(249, 115, 22, 0.15) 60%, transparent 80%); filter: blur(12px);"></div>

            <svg viewBox="0 0 160 150" style="width: 105px; height: 100px; position: relative; z-index: 2; filter: drop-shadow(0 8px 16px rgba(37, 99, 235, 0.25));" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M80 12C80 12 128 25 128 54C128 104 80 138 80 138C80 138 32 104 32 54C32 25 80 12 80 12Z" 
                      fill="url(#chBlueGrad)" stroke="#93C5FD" stroke-width="2.5" />
                <path d="M80 20C80 20 120 31 120 56C120 98 80 128 80 128C80 128 40 98 40 56C40 31 80 20 80 20Z" 
                      fill="url(#chBlueInner)" />

                <!-- Ổ khóa trắng -->
                <rect x="65" y="68" width="30" height="24" rx="5" fill="#FFFFFF" />
                <path d="M71 68V58C71 53.0294 75.0294 49 80 49C84.9706 49 89 53.0294 89 58V68" 
                      stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" />
                <circle cx="80" cy="78" r="3" fill="#2563EB" />
                <path d="M80 80V85" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" />

                <defs>
                    <linearGradient id="chBlueGrad" x1="80" y1="12" x2="80" y2="138" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#3B82F6"/>
                        <stop offset="1" stop-color="#1D4ED8"/>
                    </linearGradient>
                    <linearGradient id="chBlueInner" x1="80" y1="20" x2="80" y2="128" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#60A5FA"/>
                        <stop offset="1" stop-color="#1E40AF"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight dark:text-white">
            Xác thực bảo mật 2FA
        </h1>
        <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
            Nhập mã bảo mật 6 chữ số ngẫu nhiên từ ứng dụng <strong>Google Authenticator</strong> trên điện thoại của bạn.
        </p>

        <!-- Form nhập OTP & Checkbox 7 ngày -->
        <div class="mt-5 text-left">
            <x-filament-panels::form id="form" wire:submit="authenticate">
                {{ $this->form }}

                <div class="mt-4">
                    <x-filament-panels::form.actions
                        :actions="$this->getCachedFormActions()"
                        :full-width="$this->hasFullWidthFormActions()"
                    />
                </div>
            </x-filament-panels::form>
        </div>

        <!-- Tùy chọn đăng nhập bằng mã dự phòng -->
        <div class="mt-5 pt-4 border-t border-slate-100 dark:border-gray-800 text-xs text-slate-500 flex items-center justify-between">
            <div>
                {{ $this->recoveryAction }}
            </div>
            <div>
                <x-filament-two-factor-authentication::logout />
            </div>
        </div>
    </div>

    <!-- Popup Modal Thông Báo Xác Thực Thành Công -->
    <div 
        x-data="{ showModal: false, message: 'Đang chuyển hướng vào hệ thống...' }"
        @challenge-confirmed.window="showModal = true; if ($event.detail.message) { message = $event.detail.message; }"
    >
        <template x-teleport="body">
            <div 
                x-show="showModal" 
                x-cloak 
                style="position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; z-index: 999999 !important; display: flex !important; align-items: center !important; justify-content: center !important; background: rgba(15, 23, 42, 0.65) !important; backdrop-filter: blur(8px) !important; padding: 16px !important; margin: 0 !important;"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <div style="background: white !important; border-radius: 24px !important; padding: 32px 28px !important; max-width: 420px !important; width: 100% !important; text-align: center !important; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35) !important; border: 1.5px solid #fed7aa !important; margin: auto !important; position: relative !important;">
                    <!-- Icon checkmark cam tròn gradient -->
                    <div style="width: 72px; height: 72px; margin: 0 auto 16px auto; border-radius: 9999px; background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border: 2.5px solid #fdba74; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 0 8px rgba(249, 115, 22, 0.12);">
                        <svg style="width: 38px; height: 38px; color: #ea580c;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    
                    <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">
                        Xác thực 2FA thành công!
                    </h3>
                    
                    <p style="font-size: 13.5px; color: #64748b; line-height: 1.55; margin-bottom: 22px;" x-text="message">
                        Đang chuyển hướng vào hệ thống...
                    </p>

                    <!-- Loading Spinner & Trạng thái chuyển hướng -->
                    <div style="display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13px; font-weight: 700; color: #ea580c; background: #fff7ed; padding: 10px 16px; border-radius: 12px; border: 1px solid #fed7aa;">
                        <svg style="animation: spin 1s linear infinite; width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none">
                            <circle style="opacity: 0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path style="opacity: 0.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Đang vào Bảng điều khiển...</span>
                    </div>
                </div>
            </div>
        </template>
    </div>
</x-filament-panels::page.simple>
