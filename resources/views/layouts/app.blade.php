<!DOCTYPE html>
<html class="scroll-smooth" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Truyền Thông Cửu Long - Creative Production Studio & Tech Agency')</title>
    <meta name="description" content="@yield('meta_description', 'Truyền Thông Cửu Long - Tổ hợp sáng tạo nội dung điện ảnh và công nghệ phần mềm hàng đầu Việt Nam.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Truyền Thông Cửu Long - Creative Production Studio & Tech Agency')">
    <meta property="og:description" content="@yield('meta_description', 'Creative Production Studio & Tech Agency tại Cần Thơ & ĐBSCL.')">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400;1,600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <!-- Schema JSON-LD Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "{{ url('/') }}/#organization",
      "name": "Truyền Thông Cửu Long",
      "url": "{{ url('/') }}",
      "description": "Nhà cung cấp Dịch vụ CNTT-Viễn Thông và Giải pháp Digital Marketing, Media hàng đầu Việt Nam.",
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
    @if(env('GTM_ID'))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ env('GTM_ID') }}');</script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-surface font-body text-on-surface antialiased selection:bg-primary selection:text-white" x-data="{ mobileMenu: false }">

    <!-- Quick Site Preloader (< 700ms) -->
    <div id="site-preloader" class="fixed inset-0 z-[9999] bg-[#0B132B] flex flex-col items-center justify-center transition-opacity duration-500">
        <div class="flex flex-col items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary via-orange-500 to-accent-amber p-0.5 shadow-2xl shadow-primary/40 animate-pulse">
                <div class="w-full h-full bg-navy-base rounded-[14px] flex items-center justify-center text-white">
                    <svg class="w-7 h-7 text-amber-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="2" stroke-dasharray="32 10" class="text-orange-400"/>
                        <path d="M8.5 14C8.5 11.5 10.2 9.5 13 9.5M11 12L15 8" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="2.2" fill="#ea580c"/>
                    </svg>
                </div>
            </div>
            <div class="flex flex-col items-center gap-1.5">
                <span class="font-headline text-sm font-bold text-white tracking-wider">TRUYỀN THÔNG CỬU LONG</span>
                <div class="w-36 h-1 bg-white/10 rounded-full overflow-hidden">
                    <div id="preloader-progress" class="h-full w-0 bg-gradient-to-r from-primary to-accent-amber rounded-full transition-all duration-500 ease-out"></div>
                </div>
            </div>
        </div>
    </div>

    @if(env('GTM_ID'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

            <!-- ==================== HEADER / NAVIGATION (RESTORED FULL MENU) ==================== -->
    <header class="fixed top-0 left-0 right-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all">
        <div class="h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-2 xl:gap-4">
            <!-- Brand Logo (SVG Monogram đẹp, không bao giờ vỡ ảnh) -->
            <a class="flex items-center gap-2.5 group shrink-0" href="{{ route('home') }}">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary via-orange-500 to-accent-amber p-0.5 shadow-sm shadow-primary/25 group-hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-full bg-navy-base rounded-[10px] flex items-center justify-center text-white">
                        <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="2" stroke-dasharray="32 10" class="text-orange-400"/>
                            <path d="M8.5 14C8.5 11.5 10.2 9.5 13 9.5M11 12L15 8" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="12" r="2.2" fill="#ea580c"/>
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline text-sm sm:text-base xl:text-lg font-extrabold tracking-tight text-navy-base leading-none whitespace-nowrap">TRUYỀN THÔNG CỬU LONG</span>
                    <span class="text-[9px] font-mono tracking-widest text-primary font-bold uppercase mt-1">Media &bull; Studio &bull; Tech</span>
                </div>
            </a>

            <!-- Desktop Nav: Tối ưu 100% không bị xuống dòng, đầy đủ logic điều hướng -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                <!-- 1. Trang chủ -->
                <a class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap transition-colors {{ request()->routeIs('home') ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}" href="{{ route('home') }}">
                    Trang chủ
                </a>

                <!-- 2. Về chúng tôi (Dropdown) -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @click.away="open = false">
                    <a href="{{ route('about') }}" class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap flex items-center gap-0.5 transition-colors {{ (request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('careers') || request()->routeIs('partners') || request()->routeIs('clients')) ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                        <span>Về chúng tôi</span>
                        <span class="material-symbols-outlined text-[15px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': open }">keyboard_arrow_down</span>
                    </a>

                    <!-- Dropdown Panel -->
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
                            <a href="{{ route('about') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group {{ request()->routeIs('about') ? 'bg-amber-50/70 text-amber-600' : '' }}">
                                <span class="material-symbols-outlined text-[18px] text-primary group-hover:text-amber-500">info</span>
                                <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Câu chuyện thương hiệu</span>
                            </a>
                            <a href="{{ route('team') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group {{ request()->routeIs('team') ? 'bg-amber-50/70 text-amber-600' : '' }}">
                                <span class="material-symbols-outlined text-[18px] text-orange-500 group-hover:text-amber-500">groups</span>
                                <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Đội ngũ Senior</span>
                            </a>
                            <a href="{{ route('careers') }}" class="flex items-center justify-between p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group {{ request()->routeIs('careers') ? 'bg-amber-50/70 text-amber-600' : '' }}">
                                <div class="flex items-center gap-2.5">
                                    <span class="material-symbols-outlined text-[18px] text-emerald-600 group-hover:text-amber-500">badge</span>
                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Tuyển dụng</span>
                                </div>
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-emerald-100 text-emerald-700">Hiring</span>
                            </a>
                            <a href="{{ route('partners') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group {{ request()->routeIs('partners') ? 'bg-amber-50/70 text-amber-600' : '' }}">
                                <span class="material-symbols-outlined text-[18px] text-sky-600 group-hover:text-amber-500">handshake</span>
                                <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Đối tác chiến lược</span>
                            </a>
                            <a href="{{ route('clients') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group {{ request()->routeIs('clients') ? 'bg-amber-50/70 text-amber-600' : '' }}">
                                <span class="material-symbols-outlined text-[18px] text-purple-600 group-hover:text-amber-500">workspace_premium</span>
                                <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Khách hàng tiêu biểu</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 3. Dịch vụ (Dropdown) -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @click.away="open = false">
                    <a href="{{ route('services.index') }}" class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap flex items-center gap-0.5 transition-colors {{ request()->routeIs('services.*') ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                        <span>Dịch vụ</span>
                        <span class="material-symbols-outlined text-[15px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': open }">keyboard_arrow_down</span>
                    </a>

                    <!-- Dropdown Panel -->
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2 pointer-events-none"
                         x-transition:enter-end="opacity-100 translate-y-0 pointer-events-auto"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 pointer-events-auto"
                         x-transition:leave-end="opacity-0 -translate-y-2 pointer-events-none"
                         class="absolute left-0 top-full pt-2 w-72 z-50"
                         style="display: none;">
                        <div class="p-2 rounded-2xl bg-white/95 backdrop-blur-xl border border-slate-200/90 shadow-[0_20px_45px_rgba(11,19,43,0.12)] space-y-1">
                            <a href="{{ route('services.web-app') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                <span class="material-symbols-outlined text-[18px] text-sky-600 group-hover:text-amber-500">code</span>
                                <div class="flex flex-col">
                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Thiết kế &amp; Lập trình Web/App</span>
                                    <span class="text-[10px] text-slate-400">Website &amp; Hệ thống số</span>
                                </div>
                            </a>
                            <a href="{{ route('services.media') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                <span class="material-symbols-outlined text-[18px] text-orange-500 group-hover:text-amber-500">videocam</span>
                                <div class="flex flex-col">
                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Quay Phim &amp; Sản Xuất Media</span>
                                    <span class="text-[10px] text-slate-400">TVC 4K &amp; Phim doanh nghiệp</span>
                                </div>
                            </a>
                            <a href="{{ route('services.marketing') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                <span class="material-symbols-outlined text-[18px] text-emerald-600 group-hover:text-amber-500">campaign</span>
                                <div class="flex flex-col">
                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Quảng Cáo &amp; Truyền Thông Số</span>
                                    <span class="text-[10px] text-slate-400">TikTok, Meta &amp; Google Ads</span>
                                </div>
                            </a>
                            <a href="{{ route('booking') }}" class="flex items-center gap-2.5 p-2 rounded-xl bg-amber-50/70 hover:bg-amber-100/70 text-slate-700 hover:text-amber-600 transition-all group border border-amber-200/60">
                                <span class="material-symbols-outlined text-[18px] text-amber-500">event_available</span>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Booking Team Media</span>
                                        <span class="px-1.5 py-0.2 rounded text-[9px] font-mono font-bold bg-amber-500 text-white">Hot</span>
                                    </div>
                                    <span class="text-[10px] text-slate-500">Đặt lịch quay phim trực tiếp</span>
                                </div>
                            </a>
                            <div class="pt-1 border-t border-slate-100 mt-1 space-y-1">
                                <a href="{{ route('templates.index') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                    <span class="material-symbols-outlined text-[18px] text-amber-500">web</span>
                                    <div class="flex flex-col">
                                        <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Kho Giao Diện Mẫu</span>
                                        <span class="text-[10px] text-slate-400">39+ Mẫu website đa ngành</span>
                                    </div>
                                </a>
                                <a href="{{ route('pricing') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                    <span class="material-symbols-outlined text-[18px] text-teal-600 group-hover:text-amber-500">payments</span>
                                    <div class="flex flex-col">
                                        <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Bảng Giá Dịch Vụ</span>
                                        <span class="text-[10px] text-slate-400">Dự toán ngân sách tùy chỉnh</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Dự án -->
                <a class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap transition-colors {{ request()->routeIs('projects.*') ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}" href="{{ route('projects.index') }}">
                    Dự án
                </a>

                <!-- 5. Bảng giá -->
                <a class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap transition-colors {{ request()->routeIs('pricing') ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}" href="{{ route('pricing') }}">
                    Bảng giá
                </a>

                <!-- 6. Tài nguyên & Kiến thức (Dropdown) -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @click.away="open = false">
                    <a href="{{ route('blog.index') }}" class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap flex items-center gap-0.5 transition-colors {{ (request()->routeIs('blog.*') || request()->routeIs('resources.*') || request()->routeIs('profile')) ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                        <span>Tài nguyên &amp; Tin tức</span>
                        <span class="material-symbols-outlined text-[15px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': open }">keyboard_arrow_down</span>
                    </a>

                    <!-- Dropdown Panel -->
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
                            <a href="{{ route('blog.index') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                <span class="material-symbols-outlined text-[18px] text-primary group-hover:text-amber-500">article</span>
                                <div class="flex flex-col">
                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Bài viết &amp; Tin tức</span>
                                    <span class="text-[10px] text-slate-400">Xu hướng truyền thông số</span>
                                </div>
                            </a>
                            <a href="{{ route('resources.index') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                <span class="material-symbols-outlined text-[18px] text-emerald-600 group-hover:text-amber-500">download</span>
                                <div class="flex flex-col">
                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Tài nguyên số (Download)</span>
                                    <span class="text-[10px] text-slate-400">LUTs màu, Ebook &amp; Biểu mẫu</span>
                                </div>
                            </a>
                            <a href="{{ route('profile') }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/60 text-slate-700 hover:text-amber-600 transition-all group">
                                <span class="material-symbols-outlined text-[18px] text-sky-600 group-hover:text-amber-500">menu_book</span>
                                <div class="flex flex-col">
                                    <span class="font-headline text-xs font-bold text-navy-base group-hover:text-amber-600">Hồ sơ năng lực</span>
                                    <span class="text-[10px] text-slate-400">CLM Company Profile</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 7. Liên hệ -->
                <a class="px-2.5 py-1.5 rounded-lg text-[13px] xl:text-sm font-semibold whitespace-nowrap transition-colors {{ request()->routeIs('contact') ? 'text-primary font-bold bg-orange-50/80' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}" href="{{ route('contact') }}">
                    Liên hệ
                </a>
            </nav>

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
            
            <!-- 1. Trang chủ -->
            <a class="block font-headline text-sm font-bold {{ request()->routeIs('home') ? 'text-primary' : 'text-slate-700' }}" href="{{ route('home') }}" @click="mobileMenu = false">
                Trang chủ
            </a>

            <!-- 2. Về chúng tôi (Accordion) -->
            <div class="border-t border-slate-100 pt-3">
                <button @click="mobileAbout = !mobileAbout" class="w-full flex items-center justify-between font-headline text-sm font-bold text-slate-700 focus:outline-none">
                    <span>Về chúng tôi</span>
                    <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': mobileAbout }">keyboard_arrow_down</span>
                </button>
                <div x-show="mobileAbout" x-transition class="pl-3 pt-2 space-y-2 text-xs">
                    <a href="{{ route('about') }}" class="block text-slate-600 hover:text-primary py-1 {{ request()->routeIs('about') ? 'font-bold text-primary' : '' }}" @click="mobileMenu = false">Câu chuyện thương hiệu</a>
                    <a href="{{ route('team') }}" class="block text-slate-600 hover:text-primary py-1 {{ request()->routeIs('team') ? 'font-bold text-primary' : '' }}" @click="mobileMenu = false">Đội ngũ Senior</a>
                    <a href="{{ route('careers') }}" class="block text-slate-600 hover:text-primary py-1 {{ request()->routeIs('careers') ? 'font-bold text-primary' : '' }}" @click="mobileMenu = false">Tuyển dụng</a>
                    <a href="{{ route('partners') }}" class="block text-slate-600 hover:text-primary py-1 {{ request()->routeIs('partners') ? 'font-bold text-primary' : '' }}" @click="mobileMenu = false">Đối tác chiến lược</a>
                    <a href="{{ route('clients') }}" class="block text-slate-600 hover:text-primary py-1 {{ request()->routeIs('clients') ? 'font-bold text-primary' : '' }}" @click="mobileMenu = false">Khách hàng tiêu biểu</a>
                </div>
            </div>

            <!-- 3. Dịch vụ (Accordion) -->
            <div class="border-t border-slate-100 pt-3">
                <button @click="mobileServices = !mobileServices" class="w-full flex items-center justify-between font-headline text-sm font-bold text-slate-700 focus:outline-none">
                    <span>Dịch vụ</span>
                    <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': mobileServices }">keyboard_arrow_down</span>
                </button>
                <div x-show="mobileServices" x-transition class="pl-3 pt-2 space-y-2 text-xs">
                    <a href="{{ route('services.web-app') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Thiết kế &amp; Lập trình Web/App</a>
                    <a href="{{ route('services.media') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Quay Dựng Phim &amp; Sản Xuất Media</a>
                    <a href="{{ route('services.marketing') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Quảng Cáo &amp; Truyền Thông Số</a>
                    <a href="{{ route('booking') }}" class="block font-semibold text-primary py-1" @click="mobileMenu = false">Booking Team Media (Đặt lịch quay)</a>
                    <a href="{{ route('templates.index') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Kho Giao Diện Mẫu (Templates)</a>
                    <a href="{{ route('pricing') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Bảng Giá Dịch Vụ &amp; Dự Toán</a>
                </div>
            </div>

            <!-- 4. Dự án -->
            <div class="border-t border-slate-100 pt-3">
                <a class="block font-headline text-sm font-bold text-slate-700 hover:text-primary" href="{{ route('projects.index') }}" @click="mobileMenu = false">
                    Dự án
                </a>
            </div>

            <!-- 5. Bảng giá -->
            <div class="border-t border-slate-100 pt-3">
                <a class="block font-headline text-sm font-bold text-slate-700 hover:text-primary" href="{{ route('pricing') }}" @click="mobileMenu = false">
                    Bảng giá dịch vụ
                </a>
            </div>

            <!-- 6. Tài nguyên & Kiến thức (Accordion) -->
            <div class="border-t border-slate-100 pt-3">
                <button @click="mobileResources = !mobileResources" class="w-full flex items-center justify-between font-headline text-sm font-bold text-slate-700 focus:outline-none">
                    <span>Tài nguyên &amp; Tin tức</span>
                    <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': mobileResources }">keyboard_arrow_down</span>
                </button>
                <div x-show="mobileResources" x-transition class="pl-3 pt-2 space-y-2 text-xs">
                    <a href="{{ route('blog.index') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Bài viết &amp; Tin tức</a>
                    <a href="{{ route('resources.index') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Tài nguyên số (Download Miễn Phí)</a>
                    <a href="{{ route('profile') }}" class="block text-slate-600 hover:text-primary py-1" @click="mobileMenu = false">Hồ sơ năng lực (Profile)</a>
                </div>
            </div>

            <!-- 7. Liên hệ -->
            <div class="border-t border-slate-100 pt-3">
                <a class="block font-headline text-sm font-bold text-slate-700 hover:text-primary" href="{{ route('contact') }}" @click="mobileMenu = false">
                    Liên hệ
                </a>
            </div>

            <!-- Mobile Hotline -->
            <div class="pt-4 border-t border-slate-200">
                <a class="flex items-center justify-center gap-2 py-2.5 rounded-full bg-slate-100 text-xs font-bold text-slate-700" href="tel:+84908888256">
                    <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                    <span>(+84) 908 888 CLM (0908 888 256)</span>
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

        @if(!request()->routeIs('home'))
    <!-- ==================== CTA BAND ==================== -->
        <section class="w-full relative overflow-hidden bg-gradient-to-r from-navy-base via-primary to-accent-coral py-16 text-white shadow-2xl animate-gradient-flow" id="cta-contact">
            <!-- Light streaks -->
            <div class="light-streak"></div>
            <div class="light-streak light-streak-delay"></div>
            <!-- Ambient light trail graphic -->
            <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-accent-amber/25 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-20 -top-20 w-96 h-96 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>
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
                <div class="flex flex-col sm:flex-row lg:flex-col items-center gap-4 shrink-0">
                    <a class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-white text-navy-base font-headline text-sm font-bold shadow-[0_12px_32px_rgba(0,0,0,0.35)] hover:bg-amber-50 hover:scale-105 active:scale-95 transition-all group" href="tel:+84908888256">
                        <span>Đặt Lịch Tư Vấn Miễn Phí (1:1)</span>
                        <span class="material-symbols-outlined text-[20px] text-primary transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                    <a class="inline-flex items-center gap-2 text-white/90 font-mono text-xs sm:text-sm hover:text-amber-300 transition-colors font-semibold" href="tel:+84908888256">
                        <span class="material-symbols-outlined text-[18px]">phone_in_talk</span>
                        <span>Hotline: 0908 888 CLM (0908 888 256)</span>
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
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary to-accent-amber p-0.5 shadow-sm">
                                <div class="w-full h-full bg-navy-base rounded-[10px] flex items-center justify-center text-white">
                                    <svg class="w-4 h-4 text-amber-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="2" stroke-dasharray="32 10"/>
                                        <circle cx="12" cy="12" r="2.5" fill="#f59e0b"/>
                                    </svg>
                                </div>
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
                            <a aria-label="Facebook" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" href="https://www.facebook.com/truyenthongcuulong/">
                                <span class="material-symbols-outlined text-[16px]">share</span>
                            </a>
                            <a aria-label="LinkedIn" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
                                <span class="material-symbols-outlined text-[16px]">work</span>
                            </a>
                            <a aria-label="YouTube" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-red-600 hover:text-white transition-colors" href="https://www.youtube.com/watch?v=nGvVhO2kDo8">
                                <span class="material-symbols-outlined text-[16px]">smart_display</span>
                            </a>
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
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('team') }}">Đội ngũ Senior</a></li>
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
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.media') }}">Quay TVC Doanh Nghiệp 4K</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.web-app') }}">Thiết kế &amp; Lập trình Web/App</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.marketing') }}">Quảng cáo Performance TikTok &amp; Meta</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.show', 'tich-hop-ai-solutions') }}">3D Motion Design &amp; AI Studio</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('booking') }}">Booking Team Media &amp; Livestream</a></li>
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
                        <a href="https://cungchoi.com" target="_blank" rel="noopener noreferrer" class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] hover:border-amber-400/40 transition-all group">
                            <div class="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-400 group-hover:scale-110 flex items-center justify-center shrink-0 transition-transform">
                                <span class="material-symbols-outlined text-[19px]">sports_esports</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate group-hover:text-amber-400 transition-colors">Cùng Chơi</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">Giải trí &amp; Kết nối cộng đồng</span>
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
</body>
</html>
