@php
    $user = auth()->user();
    $roles = $user ? $user->roles->pluck('name')->implode(', ') : 'super_admin, Admin';
    $confirmedAt = $user?->two_factor_confirmed_at ? $user->two_factor_confirmed_at->timezone('Asia/Ho_Chi_Minh')->format('H:i - d/m/Y') : 'Đang hoạt động';
    $trustedDevicesCount = app(\App\Services\TrustedDeviceService::class)->getActiveCountForUser($user);
@endphp

<div class="text-center">
    <!-- Minh họa 3D Shield Security Xanh Lá ĐÃ KÍCH HOẠT -->
    <div class="relative mx-auto mb-4 flex items-center justify-center">
        <div class="relative w-36 h-36 flex items-center justify-center">
            <!-- Vòng hào quang phát sáng xanh ngọc -->
            <div class="absolute inset-0 rounded-full bg-emerald-400/20 blur-2xl transform scale-90"></div>

            <!-- SVG 3D Shield Vector Xanh Lá -->
            <svg viewBox="0 0 160 160" class="w-36 h-36 relative z-10 drop-shadow-xl" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Khiên chính màu xanh Emerald 3D -->
                <path d="M80 18C80 18 126 30 126 56C126 102 80 134 80 134C80 134 34 102 34 56C34 30 80 18 80 18Z" 
                      fill="url(#shieldGreenGrad)" stroke="#34D399" stroke-width="2.5" />
                <path d="M80 26C80 26 118 36 118 58C118 97 80 124 80 124C80 124 42 97 42 58C42 36 80 26 80 26Z" 
                      fill="url(#shieldGreenInner)" opacity="0.9" />

                <!-- Dấu Tick lớn trắng chính giữa khiên -->
                <path d="M62 76L74 88L98 62" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />

                <!-- Các hạt bụi sáng lơ lửng -->
                <circle cx="28" cy="48" r="2.5" fill="#6EE7B7" opacity="0.8" />
                <circle cx="132" cy="40" r="3" fill="#34D399" opacity="0.9" />
                <circle cx="136" cy="95" r="2" fill="#10B981" opacity="0.8" />

                <defs>
                    <linearGradient id="shieldGreenGrad" x1="80" y1="18" x2="80" y2="134" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#10B981"/>
                        <stop offset="0.5" stop-color="#059669"/>
                        <stop offset="1" stop-color="#047857"/>
                    </linearGradient>
                    <linearGradient id="shieldGreenInner" x1="80" y1="26" x2="80" y2="124" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#34D399"/>
                        <stop offset="0.4" stop-color="#10B981"/>
                        <stop offset="1" stop-color="#065F46"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>

    <!-- Tiêu đề & Phụ đề -->
    <h1 class="text-2xl sm:text-[27px] font-black text-slate-900 tracking-tight dark:text-white">
        Xác thực hai yếu tố (2FA)
    </h1>
    <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed max-w-md mx-auto">
        Tài khoản quản trị của bạn đang được bảo vệ an toàn bằng lớp xác thực hai yếu tố.
    </p>

    <!-- Status Pill: ĐÃ KÍCH HOẠT -->
    <div class="flex justify-center mt-4 mb-5">
        <div class="inline-flex items-center gap-3 rounded-full bg-[#ecfdf5] border border-[#a7f3d0] px-4 py-2 shadow-2xs dark:bg-emerald-950/40 dark:border-emerald-800/60">
            <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-white shadow-xs">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <div class="text-left leading-tight">
                <div class="text-xs font-black text-emerald-700 dark:text-emerald-400 tracking-wider uppercase">
                    ĐÃ KÍCH HOẠT THÀNH CÔNG
                </div>
                <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">
                    Bảo vệ cấp cao đang hoạt động trên hệ thống.
                </div>
            </div>
        </div>
    </div>

    <!-- Box 1: Thông tin tài khoản quản trị -->
    <div class="rounded-2xl bg-[#f0fdf4]/80 border border-[#bbf7d0] p-4 text-left shadow-2xs dark:bg-slate-800/50 dark:border-slate-700">
        <!-- Dòng 1: Tài khoản -->
        <div class="flex items-center gap-3 pb-3 border-b border-[#dcfce7] dark:border-slate-700/60">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#dcfce7] text-[#16a34a] dark:bg-emerald-900/60 dark:text-emerald-300">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <span class="block text-xs font-medium text-slate-500 dark:text-slate-400">Tài khoản quản trị</span>
                <span class="block font-bold text-sm text-slate-800 dark:text-slate-100 truncate" title="{{ $user?->email }}">
                    {{ $user?->email }}
                </span>
            </div>
        </div>

        <!-- Dòng 2: Quyền hạn -->
        <div class="flex items-center gap-3 py-3 border-b border-[#dcfce7] dark:border-slate-700/60">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#dcfce7] text-[#16a34a] dark:bg-emerald-900/60 dark:text-emerald-300">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <span class="block text-xs font-medium text-slate-500 dark:text-slate-400">Quyền hạn hệ thống</span>
                <span class="block font-bold text-sm text-slate-800 dark:text-slate-100">
                    {{ $roles ?: 'super_admin, Admin' }}
                </span>
            </div>
        </div>

        <!-- Dòng 3: Thời điểm xác nhận -->
        <div class="flex items-center gap-3 pt-3">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#dcfce7] text-[#16a34a] dark:bg-emerald-900/60 dark:text-emerald-300">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <span class="block text-xs font-medium text-slate-500 dark:text-slate-400">Thời điểm kích hoạt 2FA</span>
                <span class="block font-bold text-sm text-slate-800 dark:text-slate-100">
                    {{ $confirmedAt }}
                </span>
            </div>
        </div>
    </div>

    <!-- Box 2: Thông tin tính năng 7 ngày -->
    <div class="mt-4 rounded-2xl bg-[#eff6ff]/70 border border-[#bfdbfe] p-4 text-left shadow-2xs dark:bg-slate-800/40 dark:border-slate-700">
        <div class="flex items-start gap-3.5">
            <div class="shrink-0 pt-0.5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-xs">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-1 mb-1">
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white leading-snug">
                        Ghi nhớ thiết bị 7 ngày đang bật
                    </h4>
                    <span class="rounded-full bg-blue-100 px-2 py-0.5 text-[11px] font-bold text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                        {{ $trustedDevicesCount }} thiết bị
                    </span>
                </div>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Thiết bị của bạn đã được ghi nhớ trong vòng <strong>7 ngày</strong>. Trong 7 ngày tới, mỗi lần đăng nhập bạn sẽ không cần phải nhập lại mã OTP. Sau 7 ngày, hệ thống sẽ tự động yêu cầu xác thực lại để bảo vệ bạn.
                </p>
            </div>
        </div>
    </div>
</div>
