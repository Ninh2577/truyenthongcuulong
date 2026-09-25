<!DOCTYPE html>
<html class="scroll-smooth" lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(isset($isPreview) && $isPreview)
        <!-- Chặn index hoàn toàn đối với trang Xem trước -->
        <meta name="robots" content="noindex, nofollow">
    @endif
    <!-- Favicon and Touch Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-ttcl.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-ttcl.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-ttcl.png') }}">
    
    <title>@yield('title', 'Truyền Thông Cửu Long - Creative Production Studio & Tech Agency')</title>
    <meta name="description" content="@yield('meta_description', 'Truyền Thông Cửu Long - Tổ hợp sáng tạo nội dung điện ảnh và công nghệ phần mềm hàng đầu Việt Nam.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Truyền Thông Cửu Long - Creative Production Studio & Tech Agency')">
    <meta property="og:image" content="{{ asset('images/logo-ttcl.png') }}">
    <meta property="og:description" content="@yield('meta_description', 'Creative Production Studio & Tech Agency tại Cần Thơ & ĐBSCL.')">

    <!-- Preconnect to Google Fonts for faster DNS/TLS handshake -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preload & Non-render-blocking font loading (UI-REBUILD-07: Mulish Primary Font System) -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" media="print" onload="this.media='all'" />
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" /></noscript>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=swap" media="print" onload="this.media='all'" />
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=swap" /></noscript>

    <!-- WCAG AA Compliance for Amber/Orange text on Light Backgrounds -->
    <style>
        :root {
            --wcag-primary: #c2410c; /* Adjusted from #ea580c (WCAG AA) */
            --wcag-amber: #b45309;   /* Adjusted from #f59e0b (WCAG AA) */
        }
        
        /* Preserve original bright colors on Dark Backgrounds */
        .bg-\[\#080C16\], .bg-navy-base, .bg-\[\#070F1E\], .bg-\[\#102344\] {
            --wcag-primary: #ea580c;
            --wcag-amber: #f59e0b;
        }

        /* Apply dynamic compliant colors */
        .text-primary, .group:hover .group-hover\:text-primary { color: var(--wcag-primary) !important; }
        .text-amber-500, .group:hover .group-hover\:text-amber-500, .text-amber-400, .group:hover .group-hover\:text-amber-400 { color: var(--wcag-amber) !important; }
        .text-orange-500, .group:hover .group-hover\:text-orange-500, .text-orange-400, .group:hover .group-hover\:text-orange-400 { color: var(--wcag-primary) !important; }
    </style>

    <!-- Schema JSON-LD Organization & WebSite -->  
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "{{ url('/') }}/#organization",
      "name": "{{ get_setting('company_name', 'Truyền Thông Cửu Long') }}",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/logo-ttcl.png') }}",
      "description": "{{ get_setting('company_description', 'Nhà cung cấp Dịch vụ CNTT-Viễn Thông và Giải pháp Digital Marketing, Media hàng đầu Việt Nam.') }}",
      "telephone": "{{ '+84' . ltrim(preg_replace('/[^0-9]/', '', get_setting('company_phone', '0939.363.262')), '0') }}",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Cần Thơ",
        "addressCountry": "VN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "10.0438252",
        "longitude": "105.7789027"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "@id": "{{ url('/') }}/#website",
      "url": "{{ url('/') }}",
      "name": "{{ get_setting('company_name', 'Truyền Thông Cửu Long') }}",
      "description": "{{ get_setting('company_description', 'Đơn vị phát triển Website chuyên nghiệp, Web App & giải pháp số doanh nghiệp hiệu năng cao tại Cần Thơ & ĐBSCL.') }}",
      "inLanguage": "vi"
    }
    </script>
    @yield('schema')

    <!-- Google Tag Manager / Analytics -->
    @if(app()->environment('production') && env('GTM_ID'))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ env('GTM_ID') }}');</script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-surface font-body text-on-surface antialiased selection:bg-primary selection:text-white @yield('body-class')" x-data="{ mobileMenu: false }" x-effect="document.body.style.overflow = mobileMenu ? 'hidden' : ''">

    <!-- WCAG 2.1 AA: Skip to Main Content Link -->
    <a href="#main-content" 
       class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[10000] focus:px-4 focus:py-2.5 focus:bg-primary focus:text-white focus:font-headline focus:text-sm focus:font-bold focus:rounded-xl focus:shadow-2xl focus:outline-none focus:ring-2 focus:ring-white transition-all">
        Chuyển đến nội dung chính
    </a>

    <!-- Quick Site Preloader (< 700ms) - Only on home page to prevent ghost overlays on subpages -->
    @if(request()->routeIs('home'))
    <div id="site-preloader" class="fixed inset-0 z-[9999] bg-[#0B132B] flex flex-col items-center justify-center transition-opacity duration-500">
        <div class="flex flex-col items-center gap-4">
            <div class="w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center animate-pulse">
                <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Truyền Thông Cửu Long" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col items-center gap-1.5">
                <span class="font-headline text-sm font-bold text-white tracking-wider">TRUYỀN THÔNG CỬU LONG</span>
                <div class="w-36 h-1 bg-white/10 rounded-full overflow-hidden">
                    <div id="preloader-progress" class="h-full w-0 bg-gradient-to-r from-primary to-accent-amber rounded-full transition-all duration-500 ease-out"></div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(env('GTM_ID'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <!-- ==================== HEADER / NAVIGATION (TECHNOLOGY-FIRST UX/UI REFACTOR) ==================== -->
    <header class="fixed top-0 left-0 right-0 w-full z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all">
        <div class="h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-nowrap items-center justify-between gap-2 xl:gap-4">
            <!-- Brand Logo -->
            <a class="flex items-center gap-2 sm:gap-2.5 group shrink min-w-0 focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none rounded-xl" href="{{ route('home') }}" aria-label="Trang chủ Truyền Thông Cửu Long">
                <div class="w-10 h-10 sm:w-11 sm:h-11 flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Truyền Thông Cửu Long" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-headline text-xs sm:text-base font-extrabold tracking-tight text-navy-base leading-tight truncate">TRUYỀN THÔNG CỬU LONG</span>
                    <span class="text-[8px] sm:text-[9px] font-mono tracking-wider sm:tracking-widest text-primary font-bold uppercase mt-0.5 truncate hidden xs:block">Technology &bull; Digital Solutions</span>
                </div>
            </a>

            <!-- Desktop Nav: Dynamic Generation from DB (Technology First) -->
            @php
                $headerMenu = \App\Models\Menu::where('location', 'header')->where('is_active', true)->first();
                $menuItems = $headerMenu ? $headerMenu->rootItems : collect();

                $isActiveRoute = function($url) {
                    $trimmed = ltrim($url ?? '', '/');
                    if ($url === '/' || $trimmed === '') {
                        return request()->is('/');
                    }
                    if ($trimmed === 'dich-vu') {
                        return request()->is('dich-vu*');
                    }
                    if ($trimmed === 'du-an') {
                        return request()->is('du-an*');
                    }
                    if ($trimmed === 'bai-viet') {
                        return request()->is('bai-viet*') || request()->is('tin-tuc*');
                    }
                    if ($trimmed === 'tai-nguyen') {
                        return request()->is('tai-nguyen*') || request()->is('ho-so-nang-luc*');
                    }
                    if ($trimmed === 've-chung-toi' || $url === '#') {
                        return request()->is('ve-chung-toi*') || request()->is('doi-tac*') || request()->is('khach-hang*') || request()->is('tuyen-dung*');
                    }
                    if ($trimmed === 'lien-he') {
                        return request()->is('lien-he*');
                    }
                    return request()->is($trimmed . '*');
                };
            @endphp
            
            <nav class="hidden lg:flex items-center flex-nowrap shrink-0 gap-1 xl:gap-2" aria-label="Menu chính">
                @foreach($menuItems as $item)
                    @php
                        // On desktop, "Liên hệ" is prominently represented by the CTA button right next to nav
                        if ($item->url === '/lien-he' || $item->url === 'lien-he') {
                            continue;
                        }
                        $isActive = $isActiveRoute($item->url);
                    @endphp

                    @if($item->children->count() > 0)
                        @php
                            $isServices = ($item->url === '/dich-vu' || $item->url === 'dich-vu');
                            if ($isServices) {
                                $techChildren = $item->children->filter(function($c) {
                                    $u = ltrim($c->url ?? '', '/');
                                    return !in_array($u, ['dich-vu/media', 'dich-vu/booking', 'media', 'booking']) && !str_contains(strtolower($c->title), 'media') && !str_contains(strtolower($c->title), 'quay phim');
                                });
                                $mediaChildren = $item->children->filter(function($c) {
                                    $u = ltrim($c->url ?? '', '/');
                                    return in_array($u, ['dich-vu/media', 'dich-vu/booking', 'media', 'booking']) || str_contains(strtolower($c->title), 'media') || str_contains(strtolower($c->title), 'quay phim');
                                });
                            }
                        @endphp
                        
                        <!-- Dropdown Nav Item with Hover Delay & Keyboard Traversal -->
                        <div class="relative" 
                             x-data="{ 
                                 open: false, 
                                 timeout: null,
                                 show() { clearTimeout(this.timeout); this.open = true; },
                                 hide() { this.timeout = setTimeout(() => { this.open = false; }, 150); },
                                 toggle() { this.open = !this.open; }
                             }" 
                             @mouseenter="show()" 
                             @mouseleave="hide()" 
                             @focusin="show()" 
                             @focusout="hide()"
                             @keydown.escape.stop="open = false" 
                             @click.outside="open = false">
                            
                            <div class="flex items-center">
                                @php
                                    $itemResolvedUrl = ($item->url === '#' || empty($item->url))
                                        ? ($item->children->count() > 0 ? url($item->children->first()->url) : url('/ve-chung-toi'))
                                        : url($item->url);
                                @endphp
                                <a href="{{ $itemResolvedUrl }}" 
                                   class="px-2 xl:px-2.5 py-1.5 rounded-lg text-xs xl:text-sm font-semibold whitespace-nowrap flex items-center gap-1 transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isActive ? 'text-primary font-bold bg-orange-50/80 shadow-2xs' : 'text-slate-700 hover:text-primary hover:bg-slate-50' }}"
                                   @if($isActive) aria-current="page" @endif>
                                    <span>{{ $item->title }}</span>
                                </a>
                                <button type="button" 
                                        @click.prevent.stop="toggle()" 
                                        :aria-expanded="open.toString()" 
                                        aria-haspopup="true" 
                                        aria-label="Mở menu con {{ $item->title }}"
                                        class="p-1 text-slate-400 hover:text-primary rounded focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': open }">keyboard_arrow_down</span>
                                </button>
                            </div>
                            
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2 pointer-events-none"
                                 x-transition:enter-end="opacity-100 translate-y-0 pointer-events-auto"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0 pointer-events-auto"
                                 x-transition:leave-end="opacity-0 -translate-y-2 pointer-events-none"
                                 class="absolute left-0 top-full pt-2 {{ $isServices ? 'w-[820px] -left-36 xl:-left-24' : 'w-72' }} z-50"
                                              @if($isServices)
                                    <!-- ==================== 3-ZONE SOFTWARE COMPANY MEGA MENU (UI-REBUILD-07) ==================== -->
                                    <div class="p-6 rounded-2xl bg-white/95 backdrop-blur-xl border border-slate-200 shadow-[0_20px_45px_rgba(11,19,43,0.12)]" style="font-family: var(--font-primary);">
                                        <div class="grid grid-cols-12 gap-6" style="display: grid; grid-template-columns: repeat(12, minmax(0, 1fr));">
                                            <!-- Zone 1: Bài toán doanh nghiệp (4 cols) -->
                                            <div class="col-span-4 pr-4 border-r border-slate-100 flex flex-col justify-between" style="grid-column: span 4 / span 4;">
                                                <div>
                                                    <div class="px-2 py-1 mb-3">
                                                        <span class="text-[11px] font-bold tracking-wider uppercase text-slate-500">
                                                            BÀI TOÁN DOANH NGHIỆP
                                                        </span>
                                                    </div>
                                                    <div class="space-y-1">
                                                        <a href="{{ url('/dich-vu/web-app') }}" class="group flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Số hóa quy trình</span>
                                                                <span class="text-[11px] text-slate-500 truncate">Thay thế Excel, chuẩn hóa vận hành</span>
                                                            </div>
                                                            <span class="material-symbols-outlined text-[15px] text-slate-400 group-hover:text-primary group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                                        </a>
                                                        <a href="{{ url('/dich-vu/kho-giao-dien') }}" class="group flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Website doanh nghiệp</span>
                                                                <span class="text-[11px] text-slate-500 truncate">May đo hoặc thư viện nền tảng</span>
                                                            </div>
                                                            <span class="material-symbols-outlined text-[15px] text-slate-400 group-hover:text-primary group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                                        </a>
                                                        <a href="{{ url('/dich-vu/web-app') }}" class="group flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Tự động hóa</span>
                                                                <span class="text-[11px] text-slate-500 truncate">Giảm thao tác thủ công và sai sót</span>
                                                            </div>
                                                            <span class="material-symbols-outlined text-[15px] text-slate-400 group-hover:text-primary group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                                        </a>
                                                        <a href="{{ url('/dich-vu/marketing') }}" class="group flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Tăng trưởng số</span>
                                                                <span class="text-[11px] text-slate-500 truncate">SEO kỹ thuật và chuyển đổi</span>
                                                            </div>
                                                            <span class="material-symbols-outlined text-[15px] text-slate-400 group-hover:text-primary group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Zone 2: Giải pháp công nghệ (4 cols) -->
                                            <div class="col-span-4 pr-4 border-r border-slate-100 flex flex-col justify-between" style="grid-column: span 4 / span 4;">
                                                <div>
                                                    <div class="px-2 py-1 mb-3">
                                                        <span class="text-[11px] font-bold tracking-wider uppercase text-slate-500" aria-label="CÔNG NGHỆ &amp; GIẢI PHÁP SỐ">
                                                            GIẢI PHÁP CÔNG NGHỆ <span class="sr-only">CÔNG NGHỆ &amp; GIẢI PHÁP SỐ</span>
                                                        </span>
                                                    </div>
                                                    <div class="space-y-1">
                                                        <a href="{{ url('/dich-vu/web-app') }}" class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Web App</span>
                                                                <span class="text-[11px] text-slate-500 truncate">Ứng dụng web nghiệp vụ may đo</span>
                                                            </div>
                                                        </a>
                                                        <a href="{{ url('/dich-vu/kho-giao-dien') }}" class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Website</span>
                                                                <span class="text-[11px] text-slate-500 truncate">Nền tảng triển khai nhanh & tối ưu</span>
                                                            </div>
                                                        </a>
                                                        <a href="{{ url('/dich-vu/web-app') }}" class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Hệ thống quản trị</span>
                                                                <span class="text-[11px] text-slate-500 truncate">Admin portal, phân quyền, dữ liệu</span>
                                                            </div>
                                                        </a>
                                                        <a href="{{ url('/dich-vu/marketing') }}" class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <div class="flex flex-col min-w-0">
                                                                <span class="font-semibold text-xs text-navy-base group-hover:text-primary">SEO</span>
                                                                <span class="text-[11px] text-slate-500 truncate">Technical SEO & đo lường GA4</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Zone 3: Minh chứng (4 cols) -->
                                            <div class="col-span-4 flex flex-col justify-between space-y-3" style="grid-column: span 4 / span 4;">
                                                <div>
                                                    <div class="px-2 py-1 mb-3">
                                                        <span class="text-[11px] font-bold tracking-wider uppercase text-slate-500">
                                                            MINH CHỨNG
                                                        </span>
                                                    </div>
                                                    <div class="space-y-1">
                                                        <a href="{{ route('projects.index') }}" class="group flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Dự án</span>
                                                            <span class="text-[11px] text-slate-500">Case studies thực tế</span>
                                                        </a>
                                                        <a href="{{ url('/dich-vu/bang-gia') }}" class="group flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Bảng giá</span>
                                                            <span class="text-[11px] text-slate-500">Khung chi phí minh bạch</span>
                                                        </a>
                                                        <a href="{{ route('process') }}" class="group flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-colors">
                                                            <span class="font-semibold text-xs text-navy-base group-hover:text-primary">Quy trình</span>
                                                            <span class="text-[11px] text-slate-500">Quy chuẩn kỹ thuật</span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- CTA in Mega Menu -->
                                                <div class="pt-3 border-t border-slate-100">
                                                    <a href="{{ route('contact') }}" class="w-full py-2.5 px-4 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-semibold text-xs text-center flex items-center justify-center gap-1.5 shadow-sm transition-all">
                                                        <span>Bắt đầu dự án</span>
                                                        <span class="material-symbols-outlined text-[15px] text-amber-400" aria-hidden="true">arrow_forward</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bottom Hub Link Bar -->
                                        <div class="mt-4 pt-3 border-t border-slate-100 px-2 flex items-center justify-between text-xs text-slate-500">
                                            <span>Định hướng kỹ thuật &bull; Hỗ trợ <a href="{{ url('/dich-vu/media') }}" class="text-slate-600 hover:text-primary font-medium">TRUYỀN THÔNG &amp; MEDIA</a> &bull; <a href="{{ url('/dich-vu/booking') }}" class="text-slate-600 hover:text-primary font-medium">Booking Ekip</a></span>
                                            <a href="{{ route('services.index') }}" class="font-bold text-primary hover:text-orange-600 inline-flex items-center gap-1 transition-colors">
                                                <span>Xem tất cả giải pháp</span>
                                                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <!-- Standard Dropdown (Về chúng tôi & Tài nguyên) -->
                                    <div class="p-2.5 rounded-2xl bg-white/95 backdrop-blur-xl border border-slate-200/90 shadow-[0_20px_45px_rgba(11,19,43,0.12)] space-y-1">
                                        @foreach($item->children as $child)
                                            @php
                                                $isChildActive = request()->is(ltrim($child->url, '/'));
                                            @endphp
                                            <a href="{{ url($child->url ?? '#') }}" 
                                               target="{{ $child->target }}" 
                                               class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-all group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isChildActive ? 'bg-orange-50/70 text-primary font-bold' : '' }}"
                                               @if($isChildActive) aria-current="page" @endif>
                                                @if($child->icon)
                                                    <span class="material-symbols-outlined text-[18px] {{ $child->icon_color ?: 'text-slate-400 group-hover:text-primary' }}">{{ $child->icon }}</span>
                                                @endif
                                                <div class="flex flex-col">
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="font-headline text-xs font-bold text-navy-base group-hover:text-primary">{{ $child->title }}</span>
                                                        @if($child->badge_text)
                                                            <span class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold {{ $child->badge_color ?: 'bg-primary text-white' }}">{{ $child->badge_text }}</span>
                                                        @endif
                                                    </div>
                                                    @if($child->subtitle)
                                                        <span class="text-[10px] text-slate-400 leading-snug">{{ $child->subtitle }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <!-- Single Top-level Nav Item -->
                        <a class="px-2 xl:px-2.5 py-1.5 rounded-lg text-xs xl:text-sm font-semibold whitespace-nowrap transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isActive ? 'text-primary font-bold bg-orange-50/80 shadow-2xs' : 'text-slate-700 hover:text-primary hover:bg-slate-50' }}" 
                           href="{{ url($item->url ?? '#') }}" 
                           target="{{ $item->target }}"
                           @if($isActive) aria-current="page" @endif>
                            {{ $item->title }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Header Action CTA & Mobile Trigger -->
            <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                <!-- Primary CTA: Bắt đầu dự án -->
                <a class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 xl:px-5 py-2 xl:py-2.5 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-xs xl:text-sm font-bold shadow-md shadow-navy-base/15 hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all whitespace-nowrap group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none" href="{{ route('contact') }}">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[14px] sm:text-[16px] text-amber-400 group-hover:translate-x-0.5 transition-transform" aria-hidden="true">arrow_forward</span>
                </a>

                <!-- Mobile Menu Hamburger Button (WCAG 44x44px touch target) -->
                <button type="button" 
                        @click="mobileMenu = true" 
                        :aria-expanded="mobileMenu.toString()" 
                        aria-controls="mobile-nav-drawer" 
                        aria-label="Mở menu điều hướng" 
                        class="lg:hidden w-11 h-11 min-w-[44px] min-h-[44px] flex items-center justify-center rounded-xl text-slate-700 hover:text-navy-base hover:bg-slate-100 transition-colors focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none cursor-pointer shrink-0">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>
            </div>
        </div>

        <!-- ==================== MOBILE NAVIGATION DRAWER & BACKDROP ==================== -->
        <!-- Backdrop Overlay -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[60] bg-slate-900/60 backdrop-blur-sm lg:hidden"
             @click="mobileMenu = false"
             aria-hidden="true"
             style="display: none;"></div>

        <!-- Slide-over Drawer Panel -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             id="mobile-nav-drawer"
             role="dialog"
             aria-modal="true"
             aria-label="Menu điều hướng"
             class="fixed top-0 right-0 bottom-0 w-full max-w-[340px] sm:max-w-sm bg-white z-[70] shadow-2xl flex flex-col justify-between overflow-y-auto lg:hidden"
             style="display: none;"
             @keydown.escape.window="mobileMenu = false">
            
            <!-- Drawer Top Bar -->
            <div>
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <a class="flex items-center gap-2 group" href="{{ route('home') }}" @click="mobileMenu = false">
                        <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        <div class="flex flex-col">
                            <span class="font-headline text-xs font-bold text-navy-base leading-none">TRUYỀN THÔNG CỬU LONG</span>
                            <span class="text-[8px] font-mono text-primary font-bold uppercase mt-0.5">Technology &bull; Digital</span>
                        </div>
                    </a>
                    <button type="button" 
                            @click="mobileMenu = false" 
                            aria-label="Đóng menu điều hướng" 
                            class="w-11 h-11 min-w-[44px] min-h-[44px] flex items-center justify-center rounded-xl text-slate-500 hover:text-navy-base hover:bg-slate-100 transition-colors focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none cursor-pointer">
                        <span class="material-symbols-outlined text-[24px]">close</span>
                    </button>
                </div>

                <!-- Drawer Navigation List (UI-REBUILD-07 Section 16) -->
                <div class="p-5 space-y-2" style="font-family: var(--font-primary);">
                    <!-- 1. Giải pháp (Accordion) -->
                    <div class="border-b border-slate-100 pb-2" x-data="{ openSolutions: {{ request()->is('dich-vu*') ? 'true' : 'false' }} }">
                        <button type="button" 
                                @click="openSolutions = !openSolutions" 
                                class="w-full flex items-center justify-between py-2 text-sm font-bold text-slate-800 hover:text-primary transition-colors focus:outline-none">
                            <span class="{{ request()->is('dich-vu*') ? 'text-primary' : '' }}">Giải pháp</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': openSolutions }">keyboard_arrow_down</span>
                        </button>
                        <div x-show="openSolutions" x-transition class="pt-1 pb-2 pl-3 space-y-1">
                            <a href="{{ url('/dich-vu/web-app') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary {{ request()->is('dich-vu/web-app') ? 'text-primary font-bold' : '' }}" @click="mobileMenu = false">
                                Web App
                            </a>
                            <a href="{{ url('/dich-vu/kho-giao-dien') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary {{ request()->is('dich-vu/kho-giao-dien') ? 'text-primary font-bold' : '' }}" @click="mobileMenu = false">
                                Website
                            </a>
                            <a href="{{ url('/dich-vu/web-app#management-system') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                Hệ thống
                            </a>
                            <a href="{{ url('/dich-vu/bang-gia') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary {{ request()->is('dich-vu/bang-gia') ? 'text-primary font-bold' : '' }}" @click="mobileMenu = false">
                                Bảng giá giải pháp
                            </a>
                            <a href="{{ url('/dich-vu') }}" class="block pt-1 text-[11px] font-bold text-primary hover:underline" @click="mobileMenu = false">
                                Tất cả giải pháp &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- 2. Dự án -->
                    <a href="{{ route('projects.index') }}" class="block py-2 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('du-an*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Dự án
                    </a>

                    <!-- 3. Quy trình -->
                    <a href="{{ route('process') }}" class="block py-2 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('quy-trinh*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Quy trình
                    </a>

                    <!-- 4. Media -->
                    <a href="{{ url('/dich-vu/media') }}" class="block py-2 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('dich-vu/media*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Media
                    </a>

                    <!-- 5. Insights -->
                    <a href="{{ route('blog.index') }}" class="block py-2 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('bai-viet*') || request()->is('tin-tuc*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Insights
                    </a>

                    <!-- 6. Về Cửu Long -->
                    <a href="{{ route('about') }}" class="block py-2 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('ve-chung-toi*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Về Cửu Long
                    </a>

                    <!-- 7. Liên hệ -->
                    <a href="{{ route('contact') }}" class="block py-2 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('lien-he*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Liên hệ
                    </a>
                </div>
            </div>

            <!-- Drawer Bottom Action Panel -->
            <div class="p-5 border-t border-slate-100 bg-slate-50 space-y-3">
                <a class="w-full py-3 px-4 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-headline text-xs font-bold text-center flex items-center justify-center gap-2 shadow-md shadow-navy-base/20 transition-all" 
                   href="{{ route('contact') }}" 
                   @click="mobileMenu = false">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400">arrow_forward</span>
                </a>
                <a class="flex items-center justify-center gap-2 py-2 text-xs font-mono text-slate-500 hover:text-primary" 
                   href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}">
                    <span class="material-symbols-outlined text-primary text-[16px]">call</span>
                    <span>Hotline: {{ get_setting('company_phone', '0939.363.262') }}</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Global Flash Notification -->
    @if(session('success'))
    <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 max-w-xl w-full px-4" x-data="{ show: true }" x-show="show">
        <div class="p-4 rounded-2xl bg-emerald-500 text-white flex items-center justify-between shadow-2xl">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[24px]">check_circle</span>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-white hover:text-slate-200 text-xl font-bold">&times;</button>
        </div>
    </div>
    @endif

    <main id="main-content" tabindex="-1" class="w-full pt-20 outline-none">
        @yield('content')

        @if(!request()->routeIs('home') && !request()->routeIs('profile'))
    <!-- ==================== CTA BAND ==================== -->
        <section class="w-full relative overflow-hidden bg-gradient-to-br from-amber-500 via-orange-800 to-navy-base py-16 text-white shadow-2xl animate-gradient-flow" id="cta-contact">
            <!-- Light streaks -->
            <div class="light-streak"></div>
            <div class="light-streak light-streak-delay"></div>
            <!-- Ambient light trail graphic -->
            <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-amber-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-20 -top-20 w-96 h-96 rounded-full bg-orange-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] opacity-10 [background-size:16px_16px]"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="flex flex-col gap-3 max-w-2xl text-center lg:text-left">
                    <span class="font-mono text-xs text-amber-300 font-bold uppercase tracking-widest">KICKSTART YOUR PRODUCTION &amp; TECH STRATEGY</span>
                    <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                        Sẵn Sàng Bứt Phá Doanh Số Cùng Sức Mạnh Media &amp; Công Nghệ?
                    </h2>
                    <p class="font-body text-sm sm:text-base text-white/85 leading-relaxed">
                        Đặt lịch tư vấn trực tiếp cùng đội ngũ kỹ thuật và chuyên viên tại Truyền Thông Cửu Long. Chúng tôi phân tích hiện trạng và phác thảo lộ trình sản xuất truyền thông và hệ thống số tối ưu riêng cho bạn.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row lg:flex-col items-center gap-4 shrink-0 w-full lg:w-[320px]">
                    <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-3 w-full bg-white/10 backdrop-blur-md p-5 rounded-2xl border border-white/20 shadow-xl">
                        @csrf
                        <div class="text-center mb-1">
                            <span class="font-headline font-bold text-white">Đăng Ký Tư Vấn Ngay</span>
                        </div>
                        <input name="fullname" class="w-full px-3.5 py-2.5 rounded-xl bg-white/10 text-white placeholder:text-white/70 font-body text-[14px] border border-white/20 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all" placeholder="Họ tên của bạn" required="" type="text"/>
                        <input name="phone" class="w-full px-3.5 py-2.5 rounded-xl bg-white/10 text-white placeholder:text-white/70 font-body text-[14px] border border-white/20 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all" placeholder="Số điện thoại" required="" type="text"/>
                        <input type="hidden" name="message" value="Đăng ký tư vấn từ khối CTA Sẵn Sàng Bứt Phá"/>
                        <button class="w-full mt-1 py-3 rounded-xl bg-white text-navy-base font-headline text-[15px] font-bold hover:bg-amber-50 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-[0_8px_24px_rgba(0,0,0,0.25)]" type="submit">
                            Gửi Yêu Cầu
                        </button>
                    </form>
                    <a class="inline-flex items-center gap-2 text-white/90 font-mono text-xs sm:text-sm hover:text-amber-300 transition-colors font-semibold mt-2" href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}">
                        <span class="material-symbols-outlined text-[18px]">phone_in_talk</span>
                        <span>Hotline: {{ get_setting('company_phone', '0939.363.262') }}</span>
                    </a>
                </div>
            </div>
        </section>
    @endif

        <!-- ==================== FOOTER (DARK NAVY) ==================== -->
        <footer class="w-full bg-navy-base text-white pt-12 pb-10 lg:pt-14 lg:pb-12 border-t border-t-amber-500/30 relative" id="about-clm">
            <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-primary to-accent-coral"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-10 lg:gap-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
                    <!-- Col 1: Brand Info -->
                    <div class="lg:col-span-4 flex flex-col gap-4">
                        <div class="flex items-center gap-2.5">
                            <div class="w-14 h-14 flex items-center justify-center shrink-0">
                                <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Truyền Thông Cửu Long" class="w-full h-full object-contain">
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline text-lg font-bold text-white leading-tight">TRUYỀN THÔNG CỬU LONG</span>
                                <span class="font-mono text-[10px] text-accent-amber uppercase tracking-widest font-bold">Technology &amp; Digital Solutions</span>
                            </div>
                        </div>
                        <p class="font-body text-xs text-slate-400 leading-relaxed">
                            Truyền Thông Cửu Long (CLM Digital Solutions) - Đơn vị tư vấn, thiết kế và phát triển ứng dụng Web-App, phần mềm quản trị và giải pháp số doanh nghiệp. Tích hợp năng lực sản xuất visual in-house chuẩn mực.
                        </p>
                        <div class="flex items-center gap-3 pt-2 text-slate-400">
                            @if(get_setting('social_facebook', 'https://www.facebook.com/truyenthongcuulong/'))
                            <a aria-label="Facebook" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" href="{{ get_setting('social_facebook', 'https://www.facebook.com/truyenthongcuulong/') }}">
                                <span class="material-symbols-outlined text-[16px]">share</span>
                            </a>
                            @endif
                            @if(get_setting('social_linkedin'))
                            <a aria-label="LinkedIn" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="{{ get_setting('social_linkedin') }}">
                                <span class="material-symbols-outlined text-[16px]">work</span>
                            </a>
                            @endif
                            @if(get_setting('social_youtube', 'https://www.youtube.com/watch?v=nGvVhO2kDo8'))
                            <a aria-label="YouTube" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-red-600 hover:text-white transition-colors" href="{{ get_setting('social_youtube', 'https://www.youtube.com/watch?v=nGvVhO2kDo8') }}">
                                <span class="material-symbols-outlined text-[16px]">smart_display</span>
                            </a>
                            @endif
                            @if(get_setting('social_tiktok'))
                            <a aria-label="TikTok" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="{{ get_setting('social_tiktok') }}">
                                <span class="material-symbols-outlined text-[16px]">music_note</span>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Col 2: Quick Links -->
                    <div class="lg:col-span-2 flex flex-col gap-3">
                        <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">Liên Kết</h4>
                        <ul class="flex flex-col gap-2 font-body text-xs text-slate-400">
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('about') }}">Về chúng tôi</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('partners') }}">Đối tác chiến lược</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('clients') }}">Khách hàng tiêu biểu</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('templates.index') }}">Kho giao diện mẫu</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('resources.index') }}">Tài nguyên số (Download)</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('pricing') }}">Bảng giá dịch vụ</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('careers') }}">Tuyển dụng</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('projects.index') }}">Dự án &amp; Case Studies</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('profile') }}">Hồ sơ năng lực</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('blog.index') }}">Tin tức &amp; Xu hướng Media</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Services (Technology First) -->
                    <div class="lg:col-span-3 flex flex-col gap-3">
                        <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">Dịch Vụ Cốt Lõi</h4>
                        <ul class="flex flex-col gap-2 font-body text-xs text-slate-400">
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.web-app') }}">Thiết kế &amp; Lập trình Web-App</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('templates.index') }}">Kho Giao Diện Mẫu Thực Chiến</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.marketing') }}">Quảng Cáo Google Ads &amp; Tối Ưu SEO</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.media') }}">Sản Xuất Media &amp; Phim Doanh Nghiệp</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('booking') }}">Booking Ekip Tác Nghiệp</a></li>
                        </ul>
                    </div>

                    <!-- Col 4: Consultation Form -->
                    <div class="lg:col-span-3 flex flex-col gap-3">
                        <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">Đăng Ký Tư Vấn</h4>
                        <p class="font-body text-xs text-slate-400">Nhận đề xuất chiến lược sơ bộ và bảng dự toán phù hợp với nhu cầu.</p>
                        <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-2 pt-1">
                            @csrf
                            <input name="fullname" class="w-full px-3.5 py-2 rounded-xl bg-white/10 text-white placeholder:text-slate-500 font-body text-xs border border-white/10 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Họ và tên của bạn" required="" type="text"/>
                            <input name="phone" class="w-full px-3.5 py-2 rounded-xl bg-white/10 text-white placeholder:text-slate-500 font-body text-xs border border-white/10 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Số điện thoại / Email" required="" type="text"/>
                            <input type="hidden" name="message" value="Đăng ký tư vấn nhanh từ Footer"/>
                            <button class="w-full mt-1 py-2.5 rounded-xl bg-gradient-to-r from-primary to-accent-coral text-white font-headline text-xs font-bold hover:brightness-110 transition-all shadow-md shadow-primary/30" type="submit">
                                Gửi Yêu Cầu Tư Vấn
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Copyright & Legal -->
                <div class="pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-slate-500 font-body text-xs text-center md:text-left">
                    <p>© 2026 Truyền Thông Cửu Long (CLM Digital Solutions). Giấy phép ICP số 188/GP-BTTTT.</p>
                    <div class="flex gap-4">
                        <a class="hover:text-amber-400 transition-colors" href="{{ route('privacy') }}">Chính sách bảo mật</a>
                        <span>•</span>
                        <a class="hover:text-amber-400 transition-colors" href="{{ route('terms') }}">Điều khoản dịch vụ</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    @stack('scripts')
    {{-- Floating Contact Buttons --}}
    <style>
        /* --- FLOATING CONTACT BUTTONS (BOTTOM-LEFT TO AVOID COLLISION WITH CHAT FAB) --- */
        .floating-contact-wrapper {
            position: fixed;
            bottom: 20px;
            left: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 80;
        }

        .btn-floating-wrapper {
            position: relative;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @media (min-width: 640px) {
            .floating-contact-wrapper {
                bottom: 24px;
                left: 24px;
                gap: 14px;
            }
            .btn-floating-wrapper {
                width: 52px;
                height: 52px;
            }
        }

        .btn-floating-wrapper:hover {
            transform: scale(1.1);
        }

        /* Outer Halo */
        .btn-floating-wrapper::before {
            content: '';
            position: absolute;
            inset: -6px; /* Soft halo */
            border-radius: 50%;
            z-index: 0;
            opacity: 0.6;
            filter: blur(6px);
            transition: opacity 0.3s;
        }
        
        .btn-floating-wrapper:hover::before {
            opacity: 0.9;
            filter: blur(10px);
        }

        /* Inner Button Circle */
        .btn-floating-inner {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        /* Zalo Specific Colors */
        .btn-wrapper-zalo::before { background: #0065F7; }
        .btn-wrapper-zalo .btn-floating-inner { background: #FFFFFF; }
        .img-zalo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Call Specific Colors */
        @keyframes pulse-call {
            0% { box-shadow: 0 0 0 0 rgba(234, 88, 12, 0.5); }
            70% { box-shadow: 0 0 0 15px rgba(234, 88, 12, 0); }
            100% { box-shadow: 0 0 0 0 rgba(234, 88, 12, 0); }
        }
        .btn-wrapper-call::before { background: #F97316; }
        .btn-wrapper-call .btn-floating-inner { 
            background: #EA580C; 
            animation: pulse-call 2s infinite;
        }

        /* Call Icon */
        .icon-call {
            color: #FFFFFF;
            font-size: 24px !important;
            z-index: 20;
        }

        @media (min-width: 640px) {
            .icon-call {
                font-size: 26px !important;
            }
        }
    </style>

    <div class="floating-contact-wrapper">
        {{-- Zalo Button --}}
        @if(get_setting('social_zalo'))
        <a href="https://zalo.me/{{ preg_replace('/[^0-9]/', '', get_setting('social_zalo')) }}" target="_blank" class="btn-floating-wrapper btn-wrapper-zalo" title="Chat Zalo: {{ get_setting('social_zalo') }}">
            <div class="btn-floating-inner">
                <img src="{{ asset('images/zalo-icon-new.png') }}" alt="Zalo" class="img-zalo">
            </div>
        </a>
        @endif

        {{-- Call Button --}}
        <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}" class="btn-floating-wrapper btn-wrapper-call" title="Gọi ngay: {{ get_setting('company_phone', '0939.363.262') }}">
            <div class="btn-floating-inner">
                <span class="material-symbols-outlined icon-call">call</span>
            </div>
        </a>
    </div>

    {{-- Customer Support Chat Widget (CHAT-05) --}}
    <x-chat.widget />

</body>
</html>

