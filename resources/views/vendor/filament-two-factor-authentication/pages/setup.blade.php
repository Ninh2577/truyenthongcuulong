@php
    use Stephenjude\FilamentTwoFactorAuthentication\Livewire\PasskeyAuthentication;
    use App\Filament\Livewire\CustomTwoFactorAuthentication;
    use Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticationPlugin;

    $plugin = TwoFactorAuthenticationPlugin::get();

    /** @var \App\Models\User $user */
    $user = filament()->auth()->user();

    $canManage2FA = $user && ($user->hasAnyRole(['super_admin', 'Admin']) || $user->email === 'admin@truyenthongcuulong.com');
@endphp

<x-filament-panels::page.simple>
    <style>
        /* Tối ưu hóa layout toàn trang khớp 100% với mockup Cửu Long */
        body {
            background-color: #f3f6fa !important;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(249, 115, 22, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(37, 99, 235, 0.06) 0%, transparent 45%),
                linear-gradient(135deg, #f8fafc 0%, #edf3f9 100%) !important;
            background-attachment: fixed !important;
            min-height: 100vh !important;
        }

        /* Ẩn header mặc định và padding dư thừa của Filament Simple Page */
        .fi-simple-main {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            ring: 0 !important;
            outline: none !important;
            max-width: 540px !important;
            padding: 0 !important;
            margin-top: 1.5rem !important;
            margin-bottom: 2.5rem !important;
        }

        .fi-simple-header {
            display: none !important;
        }

        .fi-simple-layout {
            position: relative;
            overflow-x: hidden;
        }



        /* Họa tiết trang trí thương hiệu Cửu Long */
        .ttcl-bg-decor-top {
            position: fixed;
            top: 0;
            left: 0;
            width: 320px;
            height: 240px;
            pointer-events: none;
            background: radial-gradient(circle at 0% 0%, rgba(249, 115, 22, 0.12) 0%, transparent 70%);
            z-index: 0;
        }

        .ttcl-bg-decor-bottom {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 400px;
            height: 320px;
            pointer-events: none;
            background: radial-gradient(circle at 100% 100%, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
            z-index: 0;
        }

        /* Dải sóng góc dưới bên phải như ảnh mockup */
        .ttcl-corner-wave {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 280px;
            height: 200px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.85;
        }
    </style>

    <!-- Họa tiết nền Cửu Long -->
    <!-- Hình mờ văn phòng / tòa nhà bên trái như mockup ảnh 1 -->
    <div style="position: fixed; top: 0; left: 0; height: 100vh; width: 42%; pointer-events: none; z-index: 0; opacity: 0.18; background-image: url('{{ asset('images/auth-workspace-bg.jpg') }}'); background-size: cover; background-position: left center; -webkit-mask-image: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0) 100%); mask-image: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0) 100%);"></div>

    <div class="ttcl-bg-decor-top"></div>
    <div class="ttcl-bg-decor-bottom"></div>

    <!-- Họa tiết chấm bi hai bên card như mockup -->
    <div style="position: fixed; top: 28%; right: 5%; width: 140px; height: 200px; pointer-events: none; opacity: 0.22; z-index: 0; background-image: radial-gradient(#3b82f6 1.8px, transparent 1.8px); background-size: 16px 16px;"></div>
    <div style="position: fixed; top: 40%; left: 4%; width: 120px; height: 180px; pointer-events: none; opacity: 0.18; z-index: 0; background-image: radial-gradient(#f97316 1.8px, transparent 1.8px); background-size: 16px 16px;"></div>

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

    <!-- Dải sóng góc dưới bên phải -->
    <svg class="ttcl-corner-wave hidden sm:block" viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 200C90 190 140 140 200 90C240 50 260 20 280 0V200H0Z" fill="url(#blueWave)" opacity="0.3"/>
        <path d="M40 200C120 185 170 130 220 70C250 35 270 15 280 0V200H40Z" fill="url(#orangeWave)" opacity="0.45"/>
        <defs>
            <linearGradient id="blueWave" x1="140" y1="0" x2="280" y2="200" gradientUnits="userSpaceOnUse">
                <stop stop-color="#3B82F6"/>
                <stop offset="1" stop-color="#1D4ED8"/>
            </linearGradient>
            <linearGradient id="orangeWave" x1="120" y1="0" x2="280" y2="200" gradientUnits="userSpaceOnUse">
                <stop stop-color="#FB923C"/>
                <stop offset="1" stop-color="#EA580C"/>
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

    @if(! $canManage2FA)
        <div class="relative z-10 rounded-[28px] border border-red-200 bg-white p-8 text-center shadow-xl dark:border-red-900/50 dark:bg-gray-900">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-red-100 text-red-600 mb-4">
                <x-heroicon-s-x-circle class="h-8 w-8" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                Không có quyền truy cập tính năng 2FA
            </h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                Tính năng xác thực hai yếu tố (2FA) chỉ dành riêng cho tài khoản <strong>Admin</strong> và <strong>Super Admin</strong>. Các vai trò khác không có quyền thao tác tính năng này.
            </p>
            <div class="mt-6">
                <x-filament::button :href="filament()->getCurrentPanel()->getUrl()" tag="a" color="primary">
                    Quay về Bảng điều khiển
                </x-filament::button>
            </div>
        </div>
    @else
        <!-- Card chính chứa toàn bộ form 2FA -->
        <div class="relative z-10 rounded-[30px] border border-white/80 bg-white/95 backdrop-blur-md p-6 sm:p-8 shadow-[0_20px_50px_rgba(15,23,42,0.08)] dark:border-gray-800 dark:bg-gray-900/95 dark:shadow-none">
            @if($plugin->hasEnabledTwoFactorAuthentication())
                @livewire(CustomTwoFactorAuthentication::class, ['aside' => false, 'redirectTo' => filament()->getCurrentPanel()->route('two-factor.setup')])
            @endif

            @if($plugin->hasEnabledPasskeyAuthentication())
                @livewire(PasskeyAuthentication::class, ['aside' => false])
            @endif

            <!-- Dòng Note bảo mật chân card -->
            <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 11.5px; color: #64748b; font-weight: 500; text-align: center;">
                <svg style="width: 15px; height: 15px; color: #94a3b8; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                </svg>
                <span>Tài khoản của bạn được bảo vệ bởi hệ thống bảo mật hiện đại và tuân thủ các tiêu chuẩn an toàn thông tin.</span>
            </div>
        </div>

        <!-- Footer Links bên dưới Card -->
        <div class="relative z-10 mt-5 flex items-center justify-between text-xs font-bold px-3">
            <a href="{{ filament()->getCurrentPanel()->getUrl() }}" class="inline-flex items-center gap-1.5 text-orange-600 hover:text-orange-700 transition">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Bảng điều khiển</span>
            </a>

            <form method="POST" action="{{ filament()->getCurrentPanel()->getLogoutUrl() }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-orange-600 hover:text-orange-700 transition">
                    <span>Đăng xuất</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
            </form>
        </div>
    @endif
</x-filament-panels::page.simple>
