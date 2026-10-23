@php
    $user = auth()->user();
    $roles = $user ? $user->roles->pluck('name')->implode(', ') : 'super_admin, Admin';
@endphp

<div class="text-center">
    <!-- Minh họa 3D Shield Security chuẩn 100% theo Mockup -->
    <div style="position: relative; width: 150px; height: 140px; margin: 0 auto 12px auto; display: flex; align-items: center; justify-content: center;">
        <!-- Vòng hào quang phát sáng -->
        <div style="position: absolute; inset: 0; border-radius: 9999px; background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(249, 115, 22, 0.15) 60%, transparent 80%); filter: blur(14px);"></div>

        <!-- SVG 3D Shield Vector tinh xảo -->
        <svg viewBox="0 0 160 150" style="width: 145px; height: 135px; position: relative; z-index: 2; filter: drop-shadow(0 12px 20px rgba(37, 99, 235, 0.22));" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Đổ bóng khiên -->
            <ellipse cx="80" cy="142" rx="46" ry="6" fill="#1E3A8A" opacity="0.18" filter="blur(3px)" />

            <!-- Khiên lớn chính màu xanh Sapphire 3D -->
            <path d="M80 12C80 12 128 25 128 54C128 104 80 138 80 138C80 138 32 104 32 54C32 25 80 12 80 12Z" 
                  fill="url(#shield3dGrad)" stroke="#93C5FD" stroke-width="2.5" />
            
            <!-- Lớp chiều sâu trong khiên -->
            <path d="M80 20C80 20 120 31 120 56C120 98 80 128 80 128C80 128 40 98 40 56C40 31 80 20 80 20Z" 
                  fill="url(#shield3dInner)" />
            
            <!-- Vệt bóng gương phản quang thủy tinh -->
            <path d="M48 42C62 32 80 28 80 28V122C56 104 46 80 46 56C46 50 47 45 48 42Z" 
                  fill="white" opacity="0.22" />

            <!-- Ổ khóa trắng phát sáng 3D chính giữa khiên -->
            <g filter="url(#lockShadow)">
                <!-- Thân khóa -->
                <rect x="65" y="68" width="30" height="24" rx="5" fill="#FFFFFF" />
                <!-- Càng khóa -->
                <path d="M71 68V58C71 53.0294 75.0294 49 80 49C84.9706 49 89 53.0294 89 58V68" 
                      stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" />
                <!-- Lỗ khóa -->
                <circle cx="80" cy="78" r="3" fill="#2563EB" />
                <path d="M80 80V85" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" />
            </g>

            <!-- Khiên nhỏ màu cam có dấu tick V bên góc dưới -->
            <g style="filter: drop-shadow(0 6px 12px rgba(234, 88, 12, 0.35));">
                <path d="M106 72C106 72 130 78 130 92C130 114 106 130 106 130C106 130 82 114 82 92C82 78 106 72 106 72Z" 
                      fill="url(#orangeBadgeGrad)" stroke="#FED7AA" stroke-width="2" />
                <!-- Tick checkmark trắng -->
                <path d="M97 93L103 99L115 86" stroke="#FFFFFF" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
            </g>

            <!-- Hạt bụi sáng lung linh -->
            <circle cx="26" cy="46" r="3" fill="#FBBF24" opacity="0.85" />
            <circle cx="136" cy="36" r="2.5" fill="#60A5FA" opacity="0.9" />
            <circle cx="142" cy="78" r="2" fill="#F97316" opacity="0.85" />
            <path d="M34 96L36 99L39 97L37 94L34 96Z" fill="#93C5FD" opacity="0.8"/>

            <defs>
                <linearGradient id="shield3dGrad" x1="80" y1="12" x2="80" y2="138" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#3B82F6"/>
                    <stop offset="0.45" stop-color="#2563EB"/>
                    <stop offset="1" stop-color="#1D4ED8"/>
                </linearGradient>
                <linearGradient id="shield3dInner" x1="80" y1="20" x2="80" y2="128" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#60A5FA"/>
                    <stop offset="0.35" stop-color="#3B82F6"/>
                    <stop offset="0.85" stop-color="#1E40AF"/>
                    <stop offset="1" stop-color="#172554"/>
                </linearGradient>
                <linearGradient id="orangeBadgeGrad" x1="106" y1="72" x2="106" y2="130" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FB923C"/>
                    <stop offset="0.6" stop-color="#EA580C"/>
                    <stop offset="1" stop-color="#C2410C"/>
                </linearGradient>
                <filter id="lockShadow" x="61" y="44" width="38" height="52" filterUnits="userSpaceOnUse">
                    <feDropShadow dx="0" dy="3" stdDeviation="3" flood-color="#0F172A" flood-opacity="0.25"/>
                </filter>
            </defs>
        </svg>
    </div>

    <!-- Tiêu đề chính -->
    <h1 class="text-2xl sm:text-[27px] font-black text-slate-900 tracking-tight dark:text-white" style="font-family: inherit;">
        Xác thực hai yếu tố (2FA)
    </h1>
    <!-- Phụ đề -->
    <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed max-w-md mx-auto">
        Tăng cường bảo mật tối đa cho tài khoản quản trị bằng lớp bảo vệ xác thực hai yếu tố.
    </p>

    <!-- Status Pill: CHƯA KÍCH HOẠT (Style khớp chính xác mockup ảnh 1) -->
    <div style="display: flex; justify-content: center; margin-top: 18px; margin-bottom: 20px;">
        <div style="display: inline-flex; align-items: center; gap: 12px; background: #fff7ed; border: 1px solid #fed7aa; border-radius: 9999px; padding: 7px 18px; box-shadow: 0 1px 3px rgba(249, 115, 22, 0.08);">
            <!-- Icon tròn cam tích V -->
            <div style="display: flex; width: 24px; height: 24px; flex-shrink: 0; align-items: center; justify-content: center; border-radius: 9999px; background: #f97316; color: white; box-shadow: 0 1px 2px rgba(234, 88, 12, 0.3);">
                <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <div style="text-align: left; line-height: 1.25;">
                <div style="font-size: 12px; font-weight: 800; color: #ea580c; letter-spacing: 0.05em; text-transform: uppercase;">
                    CHƯA KÍCH HOẠT
                </div>
                <div style="font-size: 11px; color: #64748b; font-weight: 500;">
                    Vui lòng xác thực để tiếp tục truy cập hệ thống.
                </div>
            </div>
        </div>
    </div>

    <!-- Box 1: Thông tin tài khoản quản trị -->
    <div style="background: rgba(240, 246, 255, 0.85); border: 1px solid #dbeafe; border-radius: 18px; padding: 14px 16px; text-align: left; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
        <!-- Dòng 1: Tài khoản quản trị -->
        <div style="display: flex; align-items: center; gap: 12px; padding-bottom: 10px; border-bottom: 1px solid #e0edff;">
            <div style="display: flex; width: 36px; height: 36px; flex-shrink: 0; align-items: center; justify-content: center; border-radius: 9999px; background: #dbeafe; color: #2563eb;">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
            </div>
            <div style="min-width: 0; flex: 1;">
                <span style="display: block; font-size: 11px; font-weight: 500; color: #64748b;">Tài khoản quản trị</span>
                <span style="display: block; font-weight: 700; font-size: 13.5px; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $user?->email }}">
                    {{ $user?->email }}
                </span>
            </div>
        </div>

        <!-- Dòng 2: Quyền hạn hệ thống -->
        <div style="display: flex; align-items: center; gap: 12px; padding-top: 10px;">
            <div style="display: flex; width: 36px; height: 36px; flex-shrink: 0; align-items: center; justify-content: center; border-radius: 9999px; background: #dbeafe; color: #2563eb;">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
            </div>
            <div style="min-width: 0; flex: 1;">
                <span style="display: block; font-size: 11px; font-weight: 500; color: #64748b;">Quyền hạn hệ thống</span>
                <span style="display: block; font-weight: 700; font-size: 13.5px; color: #1e293b;">
                    {{ $roles ?: 'super_admin, Admin' }} <span style="font-weight: 500; color: #475569;">(Được phép kích hoạt)</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Box 2: Thông tin tính năng 7 ngày & Google Authenticator -->
    <div style="background: rgba(240, 246, 255, 0.65); border: 1px solid #dbeafe; border-radius: 18px; padding: 14px 16px; text-align: left; box-shadow: 0 1px 2px rgba(0,0,0,0.02); margin-top: 14px;">
        <!-- Phần 1: Cơ chế 7 ngày -->
        <div style="display: flex; align-items: flex-start; gap: 14px; padding-bottom: 14px; border-bottom: 1px solid #e0edff;">
            <div style="flex-shrink: 0; padding-top: 2px;">
                <!-- Icon Smartphone bảo mật 3D -->
                <div style="width: 44px; height: 52px; position: relative; display: flex; align-items: center; justify-content: center;">
                    <svg viewBox="0 0 48 56" style="width: 44px; height: 52px;" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="6" y="2" width="28" height="46" rx="6" fill="#EFF6FF" stroke="#3B82F6" stroke-width="2.5" />
                        <rect x="15" y="6" width="10" height="2" rx="1" fill="#93C5FD" />
                        <circle cx="20" cy="42" r="2" fill="#93C5FD" />
                        <!-- Pin dots -->
                        <circle cx="12" cy="18" r="1.5" fill="#3B82F6" />
                        <circle cx="16" cy="18" r="1.5" fill="#3B82F6" />
                        <circle cx="20" cy="18" r="1.5" fill="#3B82F6" />
                        <circle cx="24" cy="18" r="1.5" fill="#3B82F6" />
                        <circle cx="28" cy="18" r="1.5" fill="#3B82F6" />
                        <!-- Shield Lock overlay -->
                        <path d="M34 26C34 26 42 28.5 42 33.5C42 40 34 45 34 45C34 45 26 40 26 33.5C26 28.5 34 26 34 26Z" fill="#2563EB" />
                        <rect x="31" y="34" width="6" height="5" rx="1" fill="white" />
                        <path d="M32.5 34V32C32.5 31.1716 33.1716 30.5 34 30.5C34.8284 30.5 35.5 31.1716 35.5 32V34" stroke="white" stroke-width="1.2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
            <div style="flex: 1; min-width: 0;">
                <h4 style="font-weight: 700; font-size: 13.5px; color: #0f172a; margin-bottom: 3px; line-height: 1.3;">
                    Cơ chế lưu mã 2FA trong 7 ngày
                </h4>
                <p style="font-size: 11.5px; color: #475569; line-height: 1.55;">
                    Sau khi kích hoạt, ở mỗi lần đăng nhập bạn có thể tích chọn <strong>"Ghi nhớ thiết bị này trong 7 ngày"</strong>. Bạn chỉ cần nhập mã một lần duy nhất và làm việc thoải mái trong 7 ngày. Khi hết hạn 7 ngày, hệ thống mới yêu cầu nhập lại mã OTP để bảo vệ tài khoản.
                </p>
            </div>
        </div>

        <!-- Phần 2: Sử dụng Google Authenticator -->
        <div style="display: flex; align-items: flex-start; gap: 14px; padding-top: 12px;">
            <div style="flex-shrink: 0; padding-top: 2px;">
                <div style="width: 42px; height: 42px; border-radius: 9999px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: center; padding: 6px;">
                    <!-- Bông hoa 4 cánh biểu tượng Google Authenticator -->
                    <svg viewBox="0 0 40 40" style="width: 100%; height: 100%;" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="19" fill="#FAFAFA" />
                        <path d="M20 10C20 6.5 17.5 4 14 4C10.5 4 8 6.5 8 10C8 13.5 10.5 16 14 16H20V10Z" fill="#EA4335" />
                        <path d="M30 20C33.5 20 36 17.5 36 14C36 10.5 33.5 8 30 8C26.5 8 24 10.5 24 14V20H30Z" fill="#FBBC05" />
                        <path d="M20 30C20 33.5 22.5 36 26 36C29.5 36 32 33.5 32 30C32 26.5 29.5 24 26 24H20V30Z" fill="#34A853" />
                        <path d="M10 20C6.5 20 4 22.5 4 26C4 29.5 6.5 32 10 32C13.5 32 16 29.5 16 26V20H10Z" fill="#4285F4" />
                    </svg>
                </div>
            </div>
            <div style="flex: 1; min-width: 0;">
                <h4 style="font-weight: 700; font-size: 13.5px; color: #0f172a; margin-bottom: 3px; line-height: 1.3;">
                    Sử dụng Google Authenticator
                </h4>
                <p style="font-size: 11.5px; color: #475569; line-height: 1.55;">
                    Khi kích hoạt, bạn sẽ được yêu cầu nhập mã bảo mật OTP 6 chữ số ngẫu nhiên từ ứng dụng <strong>Google Authenticator</strong> trên điện thoại mỗi khi đăng nhập.
                </p>
            </div>
        </div>
    </div>

    <!-- Nút Bắt đầu kích hoạt 2FA (Style nút gradient cam Cửu Long chuẩn mockup) -->
    <div class="ttcl-enable-action-wrapper" style="margin-top: 22px;">
        <style>
            .ttcl-enable-action-wrapper .fi-btn {
                width: 100% !important;
                padding-top: 14px !important;
                padding-bottom: 14px !important;
                padding-left: 24px !important;
                padding-right: 24px !important;
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
            .ttcl-enable-action-wrapper .fi-btn:hover {
                background: linear-gradient(135deg, #ea580c 0%, #c2410c 50%, #f97316 100%) !important;
                box-shadow: 0 14px 30px rgba(234, 88, 12, 0.48) !important;
                transform: translateY(-1.5px) !important;
            }
            .ttcl-enable-action-wrapper .fi-btn:active {
                transform: translateY(0) !important;
            }
            .ttcl-enable-action-wrapper .fi-btn .fi-btn-label::after {
                content: "  →" !important;
                font-weight: 900 !important;
            }
        </style>

        {{ $this->enableTwoFactorAuthentication }}
    </div>
</div>
