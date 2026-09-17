<!DOCTYPE html>
<html class="scroll-smooth" lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    
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

    <!-- Preload & Non-render-blocking font loading -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" media="print" onload="this.media='all'" />
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" /></noscript>

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

    <!-- Schema JSON-LD Organization -->  
     <!-- địa chỉ Lầu 5 - Số 57 Hùng Vương, P.Ninh Kiều, TP.Cần Thơ, Việt Nam  -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "{{ url('/') }}/#organization",
      "name": "{{ get_setting('company_name', 'Truyền Thông Cửu Long') }}",
      "url": "{{ url('/') }}",
      "description": "{{ get_setting('company_description', 'Nhà cung cấp Dịch vụ CNTT-Viễn Thông và Giải pháp Digital Marketing, Media hàng đầu Việt Nam.') }}",
      "telephone": "+84908888256",
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
<body class="bg-surface font-body text-on-surface antialiased selection:bg-primary selection:text-white @yield('body-class')" x-data="{ mobileMenu: false, devPopup: false }">

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

            <!-- ==================== HEADER / NAVIGATION (RESTORED FULL MENU) ==================== -->
    <header class="fixed top-0 left-0 right-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all">
        <div class="h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-2 xl:gap-4">
            <!-- Brand Logo (SVG Monogram đẹp, không bao giờ vỡ ảnh) -->
            <a class="flex items-center gap-2.5 group shrink-0" href="{{ route('home') }}">
                <div class="w-12 h-12 flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Truyền Thông Cửu Long" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <span class="font-headline text-sm sm:text-base xl:text-lg font-extrabold tracking-tight text-navy-base leading-none whitespace-nowrap">TRUYỀN THÔNG CỬU LONG</span>
                    <span class="text-[9px] font-mono tracking-widest text-primary font-bold uppercase mt-1">Media &bull; Studio &bull; Tech</span>
                </div>
            </a>

            <!-- Desktop Nav: Dynamic Generation from DB -->
            @php
                $headerMenu = \App\Models\Menu::where('location', 'header')->where('is_active', true)->first();
                $menuItems = $headerMenu ? $headerMenu->rootItems : collect();
            @endphp
            
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                @foreach($menuItems as $item)
                    @if($item->children->count() > 0)
                        <!-- Dropdown Nav Item -->
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @click.away="open = false">
                            <a href="{{ url($item->url ?? '#') }}" class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap flex items-center gap-0.5 transition-colors {{ (request()->is(ltrim($item->url, '/') . '*') && $item->url != '/') ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                                <span>{{ $item->title }}</span>
                                <span class="material-symbols-outlined text-[15px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': open }">keyboard_arrow_down</span>
                            </a>
                            
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2 pointer-events-none"
                                 x-transition:enter-end="opacity-100 translate-y-0 pointer-events-auto"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0 pointer-events-auto"
                                 x-transition:leave-end="opacity-0 -translate-y-2 pointer-events-none"
                                 class="absolute left-0 top-full pt-2 w-64 z-50"
                                 style="display: none;">
                                <div class="p-2 rounded-2xl bg-white/95 backdrop-blur-xl border border-slate-200/90 shadow-[0_20px_45px_rgba(11,19,43,0.12)] space-y-1">
                                    @foreach($item->children as $child)
                                        <a href="{{ url($child->url ?? '#') }}" target="{{ $child->target }}" class="flex items-center gap-2.5 p-2 rounded-xl {{ $child->bg_color ?: 'hover:bg-amber-50/60' }} text-slate-700 hover:text-amber-600 transition-all group {{ (request()->is(ltrim($child->url, '/'))) ? 'bg-amber-50/70 text-amber-600' : '' }}">
                                            @if($child->icon)
                                                <span class="material-symbols-outlined text-[18px] {{ $child->icon_color ?: 'text-primary group-hover:text-amber-500' }}">{{ $child->icon }}</span>
                                            @endif
                                            <div class="flex flex-col">
                                                <div class="flex items-center gap-1.5">
                                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">{{ $child->title }}</span>
                                                    @if($child->badge_text)
                                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold {{ $child->badge_color ?: 'bg-amber-500 text-white' }}">{{ $child->badge_text }}</span>
                                                    @endif
                                                </div>
                                                @if($child->subtitle)
                                                    <span class="text-[10px] text-slate-400">{{ $child->subtitle }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Single Nav Item -->
                        <a class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap transition-colors {{ (request()->is(ltrim($item->url, '/')) || (request()->is('/') && $item->url == '/')) ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}" href="{{ url($item->url ?? '#') }}" target="{{ $item->target }}">
                            {{ $item->title }}
                        </a>
                    @endif
                @endforeach

            <!-- Action: Giữ nút CTA Amber nổi bật, loại bỏ nút hotline rườm rà gây chật chội -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a class="inline-flex items-center justify-center px-4 xl:px-5 py-2.5 rounded-full bg-gradient-to-r from-primary via-orange-500 to-accent-amber text-white font-headline text-xs xl:text-sm font-bold shadow-[0_4px_18px_rgba(234,88,12,0.3)] hover:shadow-[0_6px_22px_rgba(234,88,12,0.45)] hover:scale-[1.02] active:scale-[0.98] transition-all whitespace-nowrap" href="{{ route('contact') }}">
                    Yêu Cầu Tư Vấn
                </a>
                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-slate-700 hover:text-primary" aria-label="Mở menu điều hướng">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Drawer (Đồng bộ cấu trúc đầy đủ) -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden bg-white/95 backdrop-blur-xl border-b border-slate-200 px-6 py-5 space-y-4 max-h-[85vh] overflow-y-auto shadow-2xl" 
             style="display: none;"
             x-data="{ mobileAbout: false, mobileServices: false, mobileResources: false }">
            
            <!-- Mobile Menu Dynamic Generation -->
            @php
                // Tái sử dụng $menuItems đã fetch từ Desktop Nav ở trên
            @endphp
            
            @foreach($menuItems as $item)
                @if($item->children->count() > 0)
                    <!-- Accordion for {{ $item->title }} -->
                    <div class="border-t border-slate-100 pt-3" x-data="{ mobileOpen_{{ $item->id }}: false }">
                        <button @click="mobileOpen_{{ $item->id }} = !mobileOpen_{{ $item->id }}" class="w-full flex items-center justify-between font-headline text-sm font-bold text-slate-700 focus:outline-none">
                            <span>{{ $item->title }}</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': mobileOpen_{{ $item->id }} }">keyboard_arrow_down</span>
                        </button>
                        <div x-show="mobileOpen_{{ $item->id }}" x-transition class="pl-3 pt-2 space-y-2 text-xs" style="display: none;">
                            @foreach($item->children as $child)
                                <a href="{{ url($child->url ?? '#') }}" class="block text-slate-600 hover:text-primary py-1 {{ (request()->is(ltrim($child->url, '/') . '*')) ? 'font-bold text-primary' : '' }}" @click="mobileMenu = false">{{ $child->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Single Link for {{ $item->title }} -->
                    <div class="{{ $loop->first ? '' : 'border-t border-slate-100 pt-3' }}">
                        <a class="block font-headline text-sm font-bold {{ (request()->is(ltrim($item->url, '/')) || (request()->is('/') && $item->url == '/')) ? 'text-primary' : 'text-slate-700 hover:text-primary' }}" href="{{ url($item->url ?? '#') }}" @click="mobileMenu = false">
                            {{ $item->title }}
                        </a>
                    </div>
                @endif
            @endforeach

            <div class="pt-4 border-t border-slate-200">
                <a class="flex items-center justify-center gap-2 py-2.5 rounded-full bg-slate-100 text-xs font-bold text-slate-700" href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}">
                    <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                    <span>{{ get_setting('company_phone', '0939.363.262') }}</span>
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

    <main class="w-full pt-20">
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
                        Đặt lịch tư vấn chiến lược 1:1 cùng các chuyên gia hàng đầu tại Truyền Thông Cửu Long. Chúng tôi phân tích hiện trạng và phác thảo lộ trình sản xuất truyền thông và hệ thống số tối ưu riêng cho bạn.
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
                                <span class="font-mono text-[10px] text-accent-amber uppercase tracking-widest font-bold">Media &amp; Technology Hub</span>
                            </div>
                        </div>
                        <p class="font-body text-xs text-slate-400 leading-relaxed">
                            Truyền Thông Cửu Long - Tổ hợp sáng tạo nội dung điện ảnh và công nghệ phần mềm hàng đầu Việt Nam. Tích hợp nghệ thuật kể chuyện cùng năng lực kỹ thuật chuẩn doanh nghiệp.
                        </p>
                        <div class="flex items-center gap-3 pt-2 text-slate-400">
                            @if(get_setting('social_facebook', 'https://www.facebook.com/truyenthongcuulong/'))
                            <a aria-label="Facebook" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" href="{{ get_setting('social_facebook', 'https://www.facebook.com/truyenthongcuulong/') }}">
                                <span class="material-symbols-outlined text-[16px]">share</span>
                            </a>
                            @endif
                            <a aria-label="LinkedIn" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
                                <span class="material-symbols-outlined text-[16px]">work</span>
                            </a>
                            @if(get_setting('social_youtube', 'https://www.youtube.com/watch?v=nGvVhO2kDo8'))
                            <a aria-label="YouTube" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-red-600 hover:text-white transition-colors" href="{{ get_setting('social_youtube', 'https://www.youtube.com/watch?v=nGvVhO2kDo8') }}">
                                <span class="material-symbols-outlined text-[16px]">smart_display</span>
                            </a>
                            @endif
                            <a aria-label="TikTok" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
                                <span class="material-symbols-outlined text-[16px]">music_note</span>
                            </a>
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

                    <!-- Col 3: Services -->
                    <div class="lg:col-span-3 flex flex-col gap-3">
                        <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">Dịch Vụ Cốt Lõi</h4>
                        <ul class="flex flex-col gap-2 font-body text-xs text-slate-400">
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.media') }}">Quay Phim Sự Kiện &amp; Team Building</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.web-app') }}">Thiết kế &amp; Lập trình Web/App</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.marketing') }}">Quảng Cáo Google Ads &amp; Facebook</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.show', 'tich-hop-ai-solutions') }}">3D Motion Design &amp; AI Studio</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('booking') }}">Booking Team Media</a></li>
                        </ul>
                    </div>

                    <!-- Col 4: Consultation Form -->
                    <div class="lg:col-span-3 flex flex-col gap-3">
                        <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">Đăng Ký Tư Vấn</h4>
                        <p class="font-body text-xs text-slate-400">Nhận đề xuất chiến lược sơ bộ và bảng dự toán trong vòng 24 giờ.</p>
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

                <!-- Ecosystem Strip: 4 website thành viên thật -->
                <div class="flex flex-col gap-4 pt-8 border-t border-white/10">
                    <span class="font-mono text-[10px] text-slate-400 uppercase tracking-widest text-center font-bold">
                        HỆ SINH THÁI THÀNH VIÊN TRUYỀN THÔNG CỬU LONG
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- 1. Cuu Long Camping -->
                        <a href="https://cuulongcamping.vn" target="_blank" rel="noopener noreferrer" class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] hover:border-amber-400/40 transition-all group">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 group-hover:scale-110 flex items-center justify-center shrink-0 transition-transform">
                                <span class="material-symbols-outlined text-[19px]">camping</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate group-hover:text-amber-400 transition-colors">Cuu Long Camping</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">Trải nghiệm Camping &amp; Travel Video</span>
                            </div>
                        </a>

                        <!-- 2. Tui Là Người Miền Tây -->
                        <a href="https://tuilanguoimientay.vn" target="_blank" rel="noopener noreferrer" class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] hover:border-amber-400/40 transition-all group">
                            <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-400 group-hover:scale-110 flex items-center justify-center shrink-0 transition-transform">
                                <span class="material-symbols-outlined text-[19px]">map</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate group-hover:text-amber-400 transition-colors">Tui Là Người Miền Tây</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">Văn hóa &amp; Du lịch Miền Tây</span>
                            </div>
                        </a>

                        <!-- 3. Tiêu Dao Tử -->
                        <a href="https://tieudaotu.com" target="_blank" rel="noopener noreferrer" class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] hover:border-amber-400/40 transition-all group">
                            <div class="w-9 h-9 rounded-xl bg-sky-500/20 text-sky-400 group-hover:scale-110 flex items-center justify-center shrink-0 transition-transform">
                                <span class="material-symbols-outlined text-[19px]">explore</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate group-hover:text-amber-400 transition-colors">Tiêu Dao Tử</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">Blog trải nghiệm &amp; lifestyle</span>
                            </div>
                        </a>

                        <!-- 4. Cùng Chơi -->
                        <a href="#" @click.prevent="devPopup = true" class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] hover:border-amber-400/40 transition-all group cursor-pointer">
                            <div class="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-400 group-hover:scale-110 flex items-center justify-center shrink-0 transition-transform">
                                <span class="material-symbols-outlined text-[19px]">sports_esports</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate group-hover:text-amber-400 transition-colors">Cùng Chơi</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">Đang phát triển...</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Copyright & Legal -->
                <div class="pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-slate-500 font-body text-xs text-center md:text-left">
                    <p>© 2026 Truyền Thông Cửu Long (CLM Media &amp; Tech). Giấy phép ICP số 188/GP-BTTTT.</p>
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

    <!-- Elegant Development Popup -->
    <div x-show="devPopup" 
         style="display: none;"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-navy-base/80 backdrop-blur-md" @click="devPopup = false"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-sm bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95">
             
            <!-- Decorative Header -->
            <div class="h-2 w-full bg-gradient-to-r from-primary via-orange-500 to-amber-400"></div>
            
            <div class="p-8 text-center flex flex-col items-center">
                <!-- Icon -->
                <div class="w-16 h-16 rounded-2xl bg-orange-50 text-primary flex items-center justify-center mb-5 shadow-inner">
                    <span class="material-symbols-outlined text-[32px]">architecture</span>
                </div>
                
                <!-- Text -->
                <h3 class="font-headline text-xl font-bold text-navy-base mb-2">Đang Phát Triển</h3>
                <p class="font-body text-sm text-slate-500 leading-relaxed mb-6">
                    Hệ sinh thái này đang trong quá trình nâng cấp và hoàn thiện. Vui lòng quay lại trong thời gian tới!
                </p>
                
                <!-- Action -->
                <button @click="devPopup = false" class="w-full py-3 rounded-xl bg-slate-100 text-navy-base font-headline text-sm font-bold hover:bg-slate-200 hover:text-primary transition-colors">
                    Đã hiểu
                </button>
            </div>
        </div>
    </div>
    {{-- Floating Contact Buttons --}}
    <style>
        /* --- FLOATING CONTACT BUTTONS --- */
        .floating-contact-wrapper {
            position: fixed;
            bottom: 16px;
            right: 16px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            z-index: 90;
        }

        .btn-floating-wrapper {
            position: relative;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-floating-wrapper:hover {
            transform: scale(1.1);
        }

        /* Outer Halo */
        .btn-floating-wrapper::before {
            content: '';
            position: absolute;
            inset: -8px; /* Medium soft halo */
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
            overflow: hidden; /* To keep the image circular if needed */
        }

        /* Zalo Specific Colors */
        .btn-wrapper-zalo::before { background: #0065F7; }
        .btn-wrapper-zalo .btn-floating-inner { background: #FFFFFF; } /* White background for the image */
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
            font-size: 28px !important;
            z-index: 20;
        }

        @media (max-width: 640px) {
            .floating-contact-wrapper {
                bottom: 20px;
                right: 20px;
                gap: 16px;
            }
            .btn-floating-wrapper {
                width: 48px;
                height: 48px;
            }

            .icon-call {
                font-size: 24px !important;
            }
        }
    </style>

    <div class="floating-contact-wrapper">
        {{-- Zalo Button --}}
        @if(get_setting('social_zalo', '0939.363.262'))
        <a href="https://zalo.me/{{ preg_replace('/[^0-9]/', '', get_setting('social_zalo', '0939.363.262')) }}" target="_blank" class="btn-floating-wrapper btn-wrapper-zalo" title="Chat Zalo: {{ get_setting('social_zalo', '0939.363.262') }}">
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

</body>
</html>

