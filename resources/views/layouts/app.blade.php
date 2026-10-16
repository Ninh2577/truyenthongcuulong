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

    <!-- Preload & High-Performance Font Loading (Mulish, Caveat & Material Symbols) -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Caveat:wght@600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Caveat:wght@600;700&display=swap" />

    <!-- Material Symbols: font-display=block prevents flash of raw text (arrow_forward, menu, etc.) before icon font loads -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=block" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=block" />

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

        /* Fast, Snappy & Responsive Scroll Reveal */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.42s cubic-bezier(0.16, 1, 0.3, 1), transform 0.42s cubic-bezier(0.16, 1, 0.3, 1) !important;
            will-change: opacity, transform;
        }
        .scroll-reveal.is-revealed {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .scroll-reveal-scale {
            opacity: 0;
            transform: translateY(14px) scale(0.985);
            transition: opacity 0.45s cubic-bezier(0.16, 1, 0.3, 1), transform 0.45s cubic-bezier(0.16, 1, 0.3, 1) !important;
            will-change: opacity, transform;
        }
        .scroll-reveal-scale.is-revealed {
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }
        .grid.scroll-reveal.is-revealed > *:nth-child(1), .scroll-reveal-group.is-revealed > *:nth-child(1) { animation: revealFadeUp 0.38s cubic-bezier(0.16, 1, 0.3, 1) 0.02s backwards !important; }
        .grid.scroll-reveal.is-revealed > *:nth-child(2), .scroll-reveal-group.is-revealed > *:nth-child(2) { animation: revealFadeUp 0.38s cubic-bezier(0.16, 1, 0.3, 1) 0.06s backwards !important; }
        .grid.scroll-reveal.is-revealed > *:nth-child(3), .scroll-reveal-group.is-revealed > *:nth-child(3) { animation: revealFadeUp 0.38s cubic-bezier(0.16, 1, 0.3, 1) 0.10s backwards !important; }
        .grid.scroll-reveal.is-revealed > *:nth-child(4), .scroll-reveal-group.is-revealed > *:nth-child(4) { animation: revealFadeUp 0.38s cubic-bezier(0.16, 1, 0.3, 1) 0.14s backwards !important; }
        .grid.scroll-reveal.is-revealed > *:nth-child(5), .scroll-reveal-group.is-revealed > *:nth-child(5) { animation: revealFadeUp 0.38s cubic-bezier(0.16, 1, 0.3, 1) 0.18s backwards !important; }
        .grid.scroll-reveal.is-revealed > *:nth-child(6), .scroll-reveal-group.is-revealed > *:nth-child(6) { animation: revealFadeUp 0.38s cubic-bezier(0.16, 1, 0.3, 1) 0.22s backwards !important; }
    </style>

    <!-- Schema JSON-LD Graph: ProfessionalService, Organization, WebSite & WebPage -->  
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": ["ProfessionalService", "Organization"],
      "@id": "https://truyenthongcuulong.com/#organization",
      "name": "Truyền Thông Cửu Long",
      "legalName": "Công Ty TNHH Truyền Thông Cửu Long",
      "alternateName": [
        "Cửu Long Media",
        "Truyền Thông Cửu Long - Technology & Digital Solutions"
      ],
      "url": "https://truyenthongcuulong.com",
      "email": "truyenthongcuulong@gmail.com",
      "telephone": "+84939363262",
      "priceRange": "$$",
      "description": "Đơn vị cung cấp giải pháp công nghệ, thiết kế Website chuẩn SEO, phát triển Web App, SEO tổng thể và dịch vụ quay phim, chụp ảnh sự kiện chuyên nghiệp tại Cần Thơ và ĐBSCL.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Lầu 5, 57 Hùng Vương",
        "addressLocality": "Ninh Kiều",
        "addressRegion": "Cần Thơ",
        "postalCode": "900000",
        "addressCountry": "VN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 10.0438252,
        "longitude": 105.7789027
      },
      "logo": {
        "@type": "ImageObject",
        "@id": "https://truyenthongcuulong.com/#logo",
        "url": "https://truyenthongcuulong.com/images/logo-ttcl.png",
        "contentUrl": "https://truyenthongcuulong.com/images/logo-ttcl.png",
        "caption": "Truyền Thông Cửu Long",
        "inLanguage": "vi-VN"
      },
      "image": {
        "@id": "https://truyenthongcuulong.com/#logo"
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
          ],
          "opens": "07:30",
          "closes": "17:30"
        }
      ],
      "sameAs": [
        "https://www.facebook.com/truyenthongcuulong",
        "https://twitter.com/nguyenhophuc87"
      ],
      "areaServed": [
        {
          "@type": "City",
          "name": "Cần Thơ"
        },
        {
          "@type": "AdministrativeArea",
          "name": "Đồng bằng sông Cửu Long"
        }
      ],
      "knowsAbout": [
        "Thiết kế Website chuẩn SEO",
        "Lập trình Web App & Ứng dụng di động",
        "Thiết kế UI/UX",
        "Dịch vụ SEO tổng thể",
        "Sản xuất Video & Media sự kiện 4K",
        "Quay phim Teambuilding & Chụp ảnh sự kiện",
        "Dịch vụ Flycam chuyên nghiệp"
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Dịch vụ Công nghệ & Truyền thông",
        "itemListElement": [
          {
            "@type": "OfferCatalog",
            "name": "Website & Phần mềm",
            "itemListElement": [
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Thiết kế Website",
                  "description": "Website chuẩn SEO, tốc độ cao & tối ưu chuyển đổi với hơn 70+ mẫu giao diện.",
                  "url": "https://truyenthongcuulong.com/kho-giao-dien"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Thiết kế Web App & Ứng Dụng Di Động",
                  "description": "Số hóa quy trình nghiệp vụ & phần mềm quản lý.",
                  "url": "https://truyenthongcuulong.com/dich-vu/web-app"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Thiết kế UI/UX Theo Yêu Cầu",
                  "description": "Trải nghiệm người dùng tinh tế, chuẩn thương hiệu.",
                  "url": "https://truyenthongcuulong.com/dich-vu/web-app#ui-ux"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Dịch Vụ SEO Tổng Thể",
                  "description": "Technical SEO, từ khóa lên Top & tăng trưởng tự nhiên.",
                  "url": "https://truyenthongcuulong.com/dich-vu/marketing"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Quản Trị Website",
                  "description": "Bảo trì kỹ thuật, bảo mật, tối ưu tốc độ & backup.",
                  "url": "https://truyenthongcuulong.com/dich-vu/quan-tri-website"
                }
              }
            ]
          },
          {
            "@type": "OfferCatalog",
            "name": "Quay chụp & Media",
            "itemListElement": [
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Chụp Ảnh Sự Kiện",
                  "description": "Hội nghị, hội thảo, khai trương & lễ kỷ niệm.",
                  "url": "https://truyenthongcuulong.com/dich-vu/chup-anh-su-kien"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Quay Phim Sự Kiện",
                  "description": "Sản xuất video sự kiện, teambuilding, gala dinner, hội nghị chuyên nghiệp.",
                  "url": "https://truyenthongcuulong.com/dich-vu/quay-phim-su-kien"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Chụp Ảnh Teambuilding",
                  "description": "Ghi lại khoảnh khắc gắn kết, dã ngoại sôi nổi của doanh nghiệp.",
                  "url": "https://truyenthongcuulong.com/dich-vu/chup-anh-teambuilding"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Quay Phim Teambuilding",
                  "description": "Video recap tràn đầy năng lượng, cảm xúc và truyền lửa thương hiệu.",
                  "url": "https://truyenthongcuulong.com/dich-vu/quay-phim-teambuilding"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Quay Chụp Flycam",
                  "description": "Góc nhìn toàn cảnh trên không mãn nhãn, độ nét 4K HDR cho dự án và sự kiện.",
                  "url": "https://truyenthongcuulong.com/dich-vu/quay-chup-flycam"
                }
              }
            ]
          }
        ]
      }
    },
    {
      "@type": "WebSite",
      "@id": "https://truyenthongcuulong.com/#website",
      "url": "https://truyenthongcuulong.com",
      "name": "Truyền Thông Cửu Long",
      "description": "Technology • Digital Solutions",
      "publisher": {
        "@id": "https://truyenthongcuulong.com/#organization"
      },
      "inLanguage": "vi-VN"
    },
    {
      "@type": "WebPage",
      "@id": "{{ url()->current() }}#webpage",
      "url": "{{ url()->current() }}",
      "name": "{{ addslashes(trim(View::yieldContent('title', 'Truyền Thông Cửu Long - Giải pháp Công nghệ & Truyền thông'))) }}",
      "isPartOf": {
        "@id": "https://truyenthongcuulong.com/#website"
      },
      "about": {
        "@id": "https://truyenthongcuulong.com/#organization"
      },
      "primaryImageOfPage": {
        "@id": "https://truyenthongcuulong.com/#logo"
      },
      @if(request()->routeIs('home'))
      "breadcrumb": {
        "@id": "https://truyenthongcuulong.com/#breadcrumb"
      },
      @endif
      "inLanguage": "vi-VN"
    }
    @if(request()->routeIs('home'))
    ,{
      "@type": "BreadcrumbList",
      "@id": "https://truyenthongcuulong.com/#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Trang chủ",
          "item": "https://truyenthongcuulong.com"
        }
      ]
    }
    @endif
  ]
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
        [x-cloak] { display: none !important; }
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
            font-display: block;
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
    <header class="fixed top-0 left-0 right-0 w-full z-50" style="z-index: 1000 !important;">
        <div class="w-full bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all">
            <div class="h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-nowrap items-center justify-between gap-2 xl:gap-4">
            <!-- Brand Logo -->
            <a class="flex items-center gap-2 sm:gap-2.5 group shrink-0 focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none rounded-xl" href="{{ route('home') }}" aria-label="Trang chủ Truyền Thông Cửu Long">
                <div class="w-10 h-10 sm:w-11 sm:h-11 flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Truyền Thông Cửu Long" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col shrink-0">
                    <span class="font-headline text-xs sm:text-base font-extrabold tracking-tight text-navy-base leading-tight whitespace-nowrap">TRUYỀN THÔNG CỬU LONG</span>
                    <span class="text-[8px] sm:text-[9px] font-mono tracking-wider sm:tracking-widest text-primary font-bold uppercase mt-0.5 whitespace-nowrap hidden xs:block">Technology &bull; Digital Solutions</span>
                </div>
            </a>

            <!-- Desktop Nav: Dynamic Generation from DB (Technology First) -->
            @php
                $menuVersion = \Illuminate\Support\Facades\Cache::get('header_menu_version', 'v4');
                $menuItems = \Illuminate\Support\Facades\Cache::remember('header_menu_items_tree_' . $menuVersion, 86400, function () {
                    $headerMenu = \App\Models\Menu::where('location', 'header')->where('is_active', true)->first();
                    return $headerMenu ? $headerMenu->rootItems()->with('children')->get() : collect();
                });

                $servicesMenuItem = $menuItems->first(fn($i) => $i->url === '/dich-vu' || $i->url === 'dich-vu' || str_contains(mb_strtolower($i->title), 'dịch vụ'));
                $servicesCol1 = $servicesMenuItem ? $servicesMenuItem->children->filter(fn($c) => $c->order <= 5) : collect();
                $servicesCol2 = $servicesMenuItem ? $servicesMenuItem->children->filter(fn($c) => $c->order > 5) : collect();

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
            
            <nav class="hidden lg:flex items-center flex-nowrap shrink-0 gap-0.5 xl:gap-1.5" aria-label="Menu chính">
                @foreach($menuItems as $item)
                    @php
                        $isActive = $isActiveRoute($item->url);
                    @endphp

                    @if($item->children->count() > 0)
                        @php
                            $isServices = ($item->url === '/dich-vu' || $item->url === 'dich-vu' || str_contains(mb_strtolower($item->title), 'dịch vụ'));
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
                                    $isAboutItem = ($item->title === 'Về Chúng Tôi' || str_contains($item->url ?? '', 've-chung-toi'));
                                    $itemResolvedUrl = ($isAboutItem)
                                        ? '#'
                                        : (($item->url === '#' || empty($item->url))
                                            ? ($item->children->count() > 0 ? url($item->children->first()->url) : url('/dich-vu'))
                                            : url($item->url));
                                @endphp
                                <a href="{{ $itemResolvedUrl }}" 
                                   class="px-1.5 xl:px-2.5 py-1.5 rounded-lg text-xs xl:text-sm font-semibold whitespace-nowrap flex items-center gap-1 transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isActive ? 'text-primary font-bold bg-orange-50/80 shadow-2xs' : 'text-slate-700 hover:text-primary hover:bg-slate-50' }}"
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
                                 class="absolute top-full pt-2 z-50 {{ $isServices ? 'w-[740px] -left-28 xl:-left-20' : 'w-72 left-0' }}"
                                 style="z-index: 1050 !important; {{ $isServices ? 'width: 740px; min-width: 700px; max-width: 95vw; left: -140px;' : '' }}">
                                @if($isServices)
                                    <!-- ==================== DỊCH VỤ: CHIA LÀM 2 CỘT ==================== -->
                                    <div class="p-5 sm:p-6 rounded-3xl bg-white border border-slate-200/90 shadow-[0_20px_50px_rgba(15,23,42,0.16)]" style="font-family: var(--font-primary); width: 100%; box-sizing: border-box;">
                                        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px;">
                                            @php
                                                $col1 = $item->children->filter(fn($c) => $c->order <= 5);
                                                $col2 = $item->children->filter(fn($c) => $c->order > 5);
                                            @endphp
                                            <!-- Cột 1: Website & Giải pháp số -->
                                            <div style="min-width: 0;" class="pr-4 border-r border-slate-100 flex flex-col justify-between">
                                                <div>
                                                    <div class="px-3 py-1.5 mb-3 flex items-center gap-2 rounded-lg bg-sky-50 border border-sky-100" style="display: flex; align-items: center;">
                                                        <span class="w-2 h-2 rounded-full bg-sky-600 shrink-0" aria-hidden="true"></span>
                                                        <span class="text-[11px] font-extrabold tracking-wider uppercase text-sky-800 font-mono" style="white-space: nowrap;">
                                                            1. WEBSITE &amp; PHẦN MỀM
                                                        </span>
                                                    </div>
                                                    <div class="space-y-1">
                                                        @foreach($col1 as $child)
                                                            @php
                                                                $isChildActive = request()->is(ltrim($child->url, '/'));
                                                            @endphp
                                                            <a href="{{ url($child->url ?? '#') }}" 
                                                               target="{{ $child->target }}"
                                                               class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-sky-50/70 text-slate-700 hover:text-sky-700 transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isChildActive ? 'bg-sky-50 text-sky-700 font-bold' : '' }}"
                                                               style="display: flex; align-items: flex-start; gap: 10px; width: 100%; box-sizing: border-box;">
                                                                <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-colors shrink-0 mt-0.5"
                                                                     style="width: 32px; height: 32px; min-width: 32px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                                                    <span class="material-symbols-outlined text-[18px] {{ $child->icon_color ?: '' }} group-hover:text-white" aria-hidden="true">{{ $child->icon ?: 'code' }}</span>
                                                                </div>
                                                                <div class="flex flex-col min-w-0 flex-1" style="min-width: 0; flex: 1;">
                                                                    <div class="flex items-center gap-1.5 flex-wrap" style="display: flex; align-items: center; gap: 6px;">
                                                                        <span class="font-headline text-xs font-bold text-navy-base group-hover:text-sky-700 transition-colors leading-tight" style="white-space: normal;">{{ $child->title }}</span>
                                                                        @if($child->badge_text)
                                                                            <span class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold {{ $child->badge_color ?: 'bg-primary text-white' }} shrink-0">{{ $child->badge_text }}</span>
                                                                        @endif
                                                                    </div>
                                                                    @if($child->subtitle)
                                                                        <span class="text-[11px] text-slate-500 leading-snug mt-0.5" style="display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.35;">{{ $child->subtitle }}</span>
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cột 2: Quay Chụp & Media -->
                                            <div style="min-width: 0;" class="flex flex-col justify-between">
                                                <div>
                                                    <div class="px-3 py-1.5 mb-3 flex items-center gap-2 rounded-lg bg-orange-50 border border-orange-100" style="display: flex; align-items: center;">
                                                        <span class="w-2 h-2 rounded-full bg-primary shrink-0" aria-hidden="true"></span>
                                                        <span class="text-[11px] font-extrabold tracking-wider uppercase text-orange-800 font-mono" style="white-space: nowrap;">
                                                            2. QUAY CHỤP &amp; MEDIA
                                                        </span>
                                                    </div>
                                                    <div class="space-y-1">
                                                        @foreach($col2 as $child)
                                                            @php
                                                                $childResolvedUrl = $child->url;
                                                                if (empty($childResolvedUrl) || $childResolvedUrl === '#') {
                                                                    if (str_contains($child->title, 'Chụp Ảnh Sự Kiện')) {
                                                                        $childResolvedUrl = '/dich-vu/chup-anh-su-kien';
                                                                    } elseif (str_contains($child->title, 'Chụp Ảnh Teambuilding')) {
                                                                        $childResolvedUrl = '/dich-vu/chup-anh-teambuilding';
                                                                    } elseif (str_contains($child->title, 'Quay Phim Sự Kiện')) {
                                                                        $childResolvedUrl = '/dich-vu/quay-phim-su-kien';
                                                                    } elseif (str_contains($child->title, 'Quay Phim Teambuilding') || str_contains($child->title, 'Quay Phim TeamBuilding')) {
                                                                        $childResolvedUrl = '/dich-vu/quay-phim-teambuilding';
                                                                    } elseif (str_contains($child->title, 'Flycam')) {
                                                                        $childResolvedUrl = '/dich-vu/quay-chup-flycam';
                                                                    }
                                                                }
                                                                $isChildActive = request()->is(ltrim($childResolvedUrl, '/'));
                                                            @endphp
                                                            <a href="{{ url($childResolvedUrl ?? '#') }}" 
                                                               target="{{ $child->target }}"
                                                               class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-orange-50/70 text-slate-700 hover:text-primary transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isChildActive ? 'bg-orange-50 text-primary font-bold' : '' }}"
                                                               style="display: flex; align-items: flex-start; gap: 10px; width: 100%; box-sizing: border-box;">
                                                                <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600 group-hover:bg-primary group-hover:text-white transition-colors shrink-0 mt-0.5"
                                                                     style="width: 32px; height: 32px; min-width: 32px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                                                    <span class="material-symbols-outlined text-[18px] {{ $child->icon_color ?: '' }} group-hover:text-white" aria-hidden="true">{{ $child->icon ?: 'videocam' }}</span>
                                                                </div>
                                                                <div class="flex flex-col min-w-0 flex-1" style="min-width: 0; flex: 1;">
                                                                    <div class="flex items-center gap-1.5 flex-wrap" style="display: flex; align-items: center; gap: 6px;">
                                                                        <span class="font-headline text-xs font-bold text-navy-base group-hover:text-primary transition-colors leading-tight" style="white-space: normal;">{{ $child->title }}</span>
                                                                        @if($child->badge_text)
                                                                            <span class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold {{ $child->badge_color ?: 'bg-primary text-white' }} shrink-0">{{ $child->badge_text }}</span>
                                                                        @endif
                                                                    </div>
                                                                    @if($child->subtitle)
                                                                        <span class="text-[11px] text-slate-500 leading-snug mt-0.5" style="display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.35;">{{ $child->subtitle }}</span>
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bottom Link Bar -->
                                        <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500" style="display: flex; align-items: center; justify-content: space-between;">
                                            <div class="flex items-center gap-2 text-[11px]" style="display: flex; align-items: center; gap: 8px;">
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 font-bold font-mono text-[10px]">TƯ VẤN NHANH</span>
                                                <span>Hotline: <a href="tel:0939363262" class="text-primary font-bold hover:underline">0939.363.262</a></span>
                                            </div>
                                            <div class="flex items-center gap-3" style="display: flex; align-items: center; gap: 12px;">
                                                <a href="{{ route('pricing') }}" class="text-xs font-semibold text-slate-600 hover:text-primary transition-colors">
                                                    Bảng giá dịch vụ &rarr;
                                                </a>
                                                <a href="{{ route('services.index') }}" class="font-headline font-bold text-xs text-primary hover:text-orange-600 inline-flex items-center gap-1 transition-colors">
                                                    <span>Xem tất cả dịch vụ</span>
                                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2.5 rounded-2xl bg-white border border-slate-200/90 shadow-[0_16px_40px_rgba(15,23,42,0.12)] space-y-1">
                                        @foreach($item->children as $child)
                                            @php
                                                $isChildAbout = ($child->title === 'Về Chúng Tôi' || str_contains($child->url ?? '', 've-chung-toi'));
                                                $childResolvedUrl = $isChildAbout ? '#' : url($child->url ?? '#');
                                                $isChildActive = request()->is(ltrim($child->url, '/'));
                                            @endphp
                                            <a href="{{ $childResolvedUrl }}" 
                                               target="{{ $child->target }}" 
                                               class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-700 hover:text-primary transition-all group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isChildActive ? 'bg-orange-50/70 text-primary font-bold' : '' }}"
                                               @if($isChildActive) aria-current="page" @endif>
                                                @if($child->icon)
                                                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center group-hover:bg-primary/10 transition-colors shrink-0">
                                                        <span class="material-symbols-outlined text-[18px] {{ $child->icon_color ?: 'text-slate-400 group-hover:text-primary' }}">{{ $child->icon }}</span>
                                                    </div>
                                                @endif
                                                <div class="flex flex-col min-w-0">
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="font-headline text-xs font-bold text-navy-base group-hover:text-primary">{{ $child->title }}</span>
                                                        @if($child->badge_text)
                                                            <span class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold {{ $child->badge_color ?: 'bg-primary text-white' }}">{{ $child->badge_text }}</span>
                                                        @endif
                                                    </div>
                                                    @if($child->subtitle)
                                                        <span class="text-[10px] text-slate-400 leading-snug truncate">{{ $child->subtitle }}</span>
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
                        @php
                            $isSingleAbout = ($item->title === 'Về Chúng Tôi' || str_contains($item->url ?? '', 've-chung-toi'));
                            $singleResolvedUrl = $isSingleAbout ? '#' : url($item->url ?? '#');
                        @endphp
                        <a class="px-1.5 xl:px-2.5 py-1.5 rounded-lg text-xs xl:text-sm font-semibold whitespace-nowrap transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none {{ $isActive ? 'text-primary font-bold bg-orange-50/80 shadow-2xs' : 'text-slate-700 hover:text-primary hover:bg-slate-50' }}" 
                           href="{{ $singleResolvedUrl }}" 
                           target="{{ $item->target }}"
                           @if($isActive) aria-current="page" @endif>
                            {{ $item->title }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Header Action CTA & Mobile Trigger -->
            <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                <!-- Primary CTA: Bắt đầu dự án (Desktop & Tablet) -->
                <a class="hidden sm:inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 xl:px-5 py-2 xl:py-2.5 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-xs xl:text-sm font-bold shadow-md shadow-navy-base/15 hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all whitespace-nowrap group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none" href="{{ route('contact') }}">
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

                <!-- Drawer Navigation List (Exact Requested Menu) -->
                <div class="p-5 space-y-1" style="font-family: var(--font-primary);">
                    <!-- 1. Trang Chủ -->
                    <a href="{{ route('home') }}" class="block py-2.5 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('/') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Trang chủ
                    </a>

                    <!-- 2. Dịch Vụ (Accordion: Chia làm 2 Cột) -->
                    <div class="border-b border-slate-100 pb-2" x-data="{ openServices: {{ request()->is('dich-vu*') ? 'true' : 'false' }} }">
                        <button type="button" 
                                @click="openServices = !openServices" 
                                class="w-full flex items-center justify-between py-2.5 text-sm font-bold text-slate-800 hover:text-primary transition-colors focus:outline-none">
                            <span class="{{ request()->is('dich-vu*') ? 'text-primary' : '' }}">Dịch Vụ</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': openServices }">keyboard_arrow_down</span>
                        </button>
                        <div x-show="openServices" x-transition class="pt-1 pb-2 pl-2 space-y-3">
                            <!-- Cột 1: Website & Phần mềm -->
                            <div class="space-y-1">
                                <span class="block px-2 py-0.5 text-[10px] font-mono font-extrabold uppercase tracking-wider text-sky-700 bg-sky-50 rounded">
                                    1. Website &amp; Phần Mềm
                                </span>
                                @if(isset($servicesCol1) && $servicesCol1->isNotEmpty())
                                    @foreach($servicesCol1 as $child)
                                        <a href="{{ url($child->url ?? '#') }}" target="{{ $child->target ?? '_self' }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                            {{ $child->title }}
                                        </a>
                                    @endforeach
                                @else
                                    <a href="{{ url('/kho-giao-dien') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Thiết kế Website
                                    </a>
                                    <a href="{{ url('/dich-vu/web-app') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Thiết kế Web App &amp; Ứng Dụng Di Động
                                    </a>
                                    <a href="{{ url('/dich-vu/ui-ux') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Thiết kế UI/UX Theo Yêu Cầu
                                    </a>
                                    <a href="{{ url('/dich-vu/marketing') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Dịch Vụ Seo Tổng Thể
                                    </a>
                                    <a href="{{ route('services.website-care') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Quản Trị Website
                                    </a>
                                @endif
                            </div>

                            <!-- Cột 2: Quay Chụp & Media -->
                            <div class="space-y-1 pt-1 border-t border-slate-100">
                                <span class="block px-2 py-0.5 text-[10px] font-mono font-extrabold uppercase tracking-wider text-orange-700 bg-orange-50 rounded">
                                    2. Quay Chụp &amp; Media
                                </span>
                                @if(isset($servicesCol2) && $servicesCol2->isNotEmpty())
                                    @foreach($servicesCol2 as $child)
                                        <a href="{{ url($child->url ?? '#') }}" target="{{ $child->target ?? '_self' }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                            {{ $child->title }}
                                        </a>
                                    @endforeach
                                @else
                                    <a href="{{ route('services.event-photography') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Chụp Ảnh Sự Kiện
                                    </a>
                                    <a href="{{ route('services.event-videography') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Quay Phim Sự Kiện
                                    </a>
                                    <a href="{{ route('services.teambuilding-photography') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Chụp Ảnh Teambuilding
                                    </a>
                                    <a href="{{ route('services.teambuilding-videography') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Quay Phim Teambuilding
                                    </a>
                                    <a href="{{ route('services.flycam') }}" class="block px-2 py-1 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                        Quay Chụp Flycam
                                    </a>
                                @endif
                            </div>

                            <a href="{{ url('/dich-vu') }}" class="block pt-1 px-2 text-[11px] font-bold text-primary hover:underline" @click="mobileMenu = false">
                                Xem tất cả dịch vụ &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- 3. Dự Án (Accordion: Website, Media) -->
                    <div class="border-b border-slate-100 pb-2" x-data="{ openProjects: {{ request()->is('du-an*') ? 'true' : 'false' }} }">
                        <button type="button" 
                                @click="openProjects = !openProjects" 
                                class="w-full flex items-center justify-between py-2.5 text-sm font-bold text-slate-800 hover:text-primary transition-colors focus:outline-none">
                            <span class="{{ request()->is('du-an*') ? 'text-primary' : '' }}">Dự Án</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': openProjects }">keyboard_arrow_down</span>
                        </button>
                        <div x-show="openProjects" x-transition class="pt-1 pb-2 pl-3 space-y-1">
                            <a href="{{ url('/du-an?group=technology') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                1. Website
                            </a>
                            <a href="{{ url('/du-an/media') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary" @click="mobileMenu = false">
                                2. Media
                            </a>
                            <a href="{{ route('projects.index') }}" class="block pt-1 text-[11px] font-bold text-primary hover:underline" @click="mobileMenu = false">
                                Xem tất cả dự án &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- 4. Blog -->
                    <a href="{{ route('blog.index') }}" class="block py-2.5 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('bai-viet*') || request()->is('tin-tuc*') || request()->is('blog*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Blog
                    </a>

                    <!-- 5. Về Chúng Tôi (Accordion: Khách Hàng, Tuyển Dụng, Hồ Sơ Năng Lực) -->
                    <div class="border-b border-slate-100 pb-2" x-data="{ openAbout: {{ (request()->is('ve-chung-toi*') || request()->is('khach-hang*') || request()->is('tuyen-dung*') || request()->is('ho-so-nang-luc*')) ? 'true' : 'false' }} }">
                        <button type="button" 
                                @click="openAbout = !openAbout" 
                                class="w-full flex items-center justify-between py-2.5 text-sm font-bold text-slate-800 hover:text-primary transition-colors focus:outline-none">
                            <span class="{{ (request()->is('ve-chung-toi*') || request()->is('khach-hang*') || request()->is('tuyen-dung*') || request()->is('ho-so-nang-luc*')) ? 'text-primary' : '' }}">Về Chúng Tôi</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="{ 'rotate-180 text-primary': openAbout }">keyboard_arrow_down</span>
                        </button>
                        <div x-show="openAbout" x-transition class="pt-1 pb-2 pl-3 space-y-1">
                            <a href="{{ route('clients') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary {{ request()->is('khach-hang*') ? 'text-primary font-bold' : '' }}" @click="mobileMenu = false">
                                Khách Hàng
                            </a>
                            <a href="{{ route('careers') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary {{ request()->is('tuyen-dung*') ? 'text-primary font-bold' : '' }}" @click="mobileMenu = false">
                                Tuyển Dụng
                            </a>
                            <a href="{{ route('profile') }}" class="block py-1.5 text-xs font-semibold text-slate-600 hover:text-primary {{ request()->is('ho-so-nang-luc*') ? 'text-primary font-bold' : '' }}" @click="mobileMenu = false">
                                Hồ Sơ Năng Lực
                            </a>
                            <a href="#" class="block pt-1 text-[11px] font-bold text-slate-400 hover:text-primary" @click="mobileMenu = false">
                                Giới thiệu chung &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- 6. Liên Hệ -->
                    <a href="{{ route('contact') }}" class="block py-2.5 text-sm font-bold text-slate-800 hover:text-primary border-b border-slate-100 {{ request()->is('lien-he*') ? 'text-primary' : '' }}" @click="mobileMenu = false">
                        Liên Hệ
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

        @if(!request()->routeIs('home') && !request()->routeIs('profile') && !request()->routeIs('services.index') && !request()->routeIs('templates.index') && !request()->routeIs('services.marketing') && !request()->routeIs('services.website-care') && !request()->routeIs('services.event-videography') && !request()->routeIs('clients') && !request()->routeIs('contact'))
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

        <!-- ==================== FOOTER (DARK NAVY & ORANGE ACCENTS) ==================== -->
        <footer class="w-full bg-[#060b13] text-white pt-14 pb-8 relative overflow-hidden border-t border-slate-800/80" id="about-clm" style="background-color: #060b13; color: #ffffff;">
            <!-- Decorative Angular Facets & Glow (Matching Brand Identity) -->
            <div class="pointer-events-none absolute left-0 top-0 w-40 h-52 bg-gradient-to-br from-orange-600/25 via-orange-500/5 to-transparent [clip-path:polygon(0_0,100%_0,0_100%)] opacity-90"></div>
            <div class="pointer-events-none absolute left-0 top-0 w-28 h-36 border-l border-t border-orange-500/40"></div>

            <div class="pointer-events-none absolute right-0 bottom-0 w-52 h-64 bg-gradient-to-tl from-orange-600/30 via-orange-500/10 to-transparent [clip-path:polygon(100%_0,100%_100%,0_100%)] opacity-90"></div>
            <div class="pointer-events-none absolute right-0 bottom-0 w-36 h-48 border-r border-b border-orange-500/40"></div>

            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Top 5-Column Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-6 xl:gap-8 items-start">
                    
                    <!-- Col 1: Brand Info (lg:col-span-3) -->
                    <div class="lg:col-span-3 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 flex items-center justify-center shrink-0">
                                <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo Truyền Thông Cửu Long" class="w-full h-full object-contain">
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline text-base font-extrabold text-white tracking-tight leading-tight">TRUYỀN THÔNG CỬU LONG</span>
                                <span class="font-mono text-[10px] text-[#ff6a1a] uppercase tracking-wider font-bold">Technology &amp; Digital Solutions</span>
                            </div>
                        </div>
                        <p class="font-body text-xs text-slate-400 leading-relaxed">
                            Truyền Thông Cửu Long (CLM Digital Solutions) – Đơn vị tư vấn, thiết kế và phát triển ứng dụng Web-App, phần mềm quản trị và giải pháp số doanh nghiệp. Tích hợp năng lực sản xuất visual in-house chuẩn mực.
                        </p>
                        <!-- Social Icons (Facebook, YouTube, Zalo) -->
                        <div class="flex items-center gap-2.5 pt-1 text-slate-300">
                            <!-- Facebook -->
                            <a aria-label="Facebook" target="_blank" rel="noopener noreferrer" href="{{ get_setting('social_facebook', 'https://www.facebook.com/truyenthongcuulong/') }}" class="w-8 h-8 rounded-lg bg-[#111927] border border-slate-700/60 hover:border-orange-500/60 hover:bg-orange-500/10 hover:text-white flex items-center justify-center transition-all shadow-sm">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <!-- YouTube -->
                            <a aria-label="YouTube" target="_blank" rel="noopener noreferrer" href="{{ get_setting('social_youtube', 'https://www.youtube.com/@truyenthongcuulong') }}" class="w-8 h-8 rounded-lg bg-[#111927] border border-slate-700/60 hover:border-orange-500/60 hover:bg-orange-500/10 hover:text-white flex items-center justify-center transition-all shadow-sm">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                            <!-- Zalo -->
                            <a aria-label="Zalo" target="_blank" rel="noopener noreferrer" href="{{ get_setting('social_zalo', 'https://zalo.me/0939363262') }}" class="w-8 h-8 rounded-lg bg-[#111927] border border-slate-700/60 hover:border-orange-500/60 hover:bg-orange-500/10 hover:text-white flex items-center justify-center transition-all shadow-sm group">
                                <span class="font-bold text-[10px] tracking-tight text-slate-300 group-hover:text-white">Zalo</span>
                            </a>
                        </div>
                    </div>

                    <!-- Col 2: Quick Links (lg:col-span-2) -->
                    <div class="lg:col-span-2 flex flex-col gap-3">
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-6 h-6 rounded-full border border-orange-500/70 flex items-center justify-center text-orange-400 shrink-0">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
                            </div>
                            <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">LIÊN KẾT</h4>
                        </div>
                        <ul class="flex flex-col gap-2 font-body text-xs text-slate-400">
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('home') }}"><span>Trang chủ</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="#"><span>Về chúng tôi</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('projects.website') }}"><span>Dự án Website</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('projects.media') }}"><span>Dự án Media</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('clients') }}"><span>Khách hàng tiêu biểu</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('partners') }}"><span>Đối tác chiến lược</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('templates.index') }}"><span>Kho giao diện mẫu</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('pricing') }}"><span>Bảng giá dịch vụ</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('profile') }}"><span>Hồ sơ năng lực</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('careers') }}"><span>Tuyển dụng</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('blog.index') }}"><span>Blog &amp; Tin tức</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('contact') }}"><span>Liên hệ hợp tác</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Core Services (lg:col-span-2) -->
                    <div class="lg:col-span-2 flex flex-col gap-3">
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-6 h-6 rounded-full border border-orange-500/70 flex items-center justify-center text-orange-400 shrink-0">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg>
                            </div>
                            <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">DỊCH VỤ CỐT LÕI</h4>
                        </div>
                        <ul class="flex flex-col gap-2 font-body text-xs text-slate-400">
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('templates.index') }}"><span>Thiết kế Website</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.web-app') }}"><span>Thiết kế Web App &amp; Di Động</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.ui-ux') }}"><span>Thiết kế UI/UX Theo Yêu Cầu</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.marketing') }}"><span>Dịch Vụ SEO Tổng Thể</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.website-care') }}"><span>Quản Trị Website</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.event-photography') }}"><span>Chụp Ảnh Sự Kiện</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.event-videography') }}"><span>Quay Phim Sự Kiện</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.teambuilding-photography') }}"><span>Chụp Ảnh Teambuilding</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.teambuilding-videography') }}"><span>Quay Phim Teambuilding</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                            <li><a class="flex items-center justify-between hover:text-orange-400 transition-colors group" href="{{ route('services.flycam') }}"><span>Quay Chụp Flycam</span><span class="text-orange-500/70 font-mono text-[11px] group-hover:translate-x-0.5 transition-transform">&gt;</span></a></li>
                        </ul>
                    </div>

                    <!-- Col 4: Consultation Form (lg:col-span-3) -->
                    <div class="lg:col-span-3 flex flex-col gap-3">
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-6 h-6 rounded-full border border-orange-500/70 flex items-center justify-center text-orange-400 shrink-0">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                            </div>
                            <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">ĐĂNG KÝ TƯ VẤN</h4>
                        </div>
                        <p class="font-body text-xs text-slate-400 leading-relaxed">Nhận đề xuất chiến lược sơ bộ và bảng dự toán phù hợp với nhu cầu.</p>
                        
                        <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-2.5 pt-1">
                            @csrf
                            <input type="hidden" name="message" value="Đăng ký tư vấn nhanh từ Footer"/>
                            
                            <!-- Fullname Pill Input -->
                            <div class="relative group">
                                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 group-focus-within:text-orange-400 transition-colors">
                                    <svg class="w-4 h-4 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input name="fullname" type="text" placeholder="Họ và tên của bạn" required 
                                       class="w-full rounded-full bg-[#0d1624] text-xs text-white placeholder:text-slate-500 pl-10 pr-4 py-2.5 border border-slate-700/80 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 focus:outline-none transition-colors shadow-inner"
                                       style="border-radius: 9999px !important; outline: none !important; -webkit-appearance: none !important;" />
                            </div>

                            <!-- Phone / Email Pill Input -->
                            <div class="relative group">
                                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 group-focus-within:text-orange-400 transition-colors">
                                    <svg class="w-4 h-4 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input name="phone" type="text" placeholder="Số điện thoại / Email" required 
                                       class="w-full rounded-full bg-[#0d1624] text-xs text-white placeholder:text-slate-500 pl-10 pr-4 py-2.5 border border-slate-700/80 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 focus:outline-none transition-colors shadow-inner"
                                       style="border-radius: 9999px !important; outline: none !important; -webkit-appearance: none !important;" />
                            </div>

                            <!-- Submit Pill Button -->
                            <button type="submit" class="w-full mt-1 py-2.5 px-4 rounded-full bg-gradient-to-r from-[#ff5311] via-[#f97316] to-[#ff3800] hover:brightness-110 active:scale-[0.99] text-white font-headline text-xs font-bold flex items-center justify-center gap-2 shadow-lg shadow-orange-500/25 transition-all cursor-pointer">
                                <svg class="w-4 h-4 fill-current rotate-45 shrink-0" viewBox="0 0 24 24">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                </svg>
                                <span>Gửi Yêu Cầu Tư Vấn</span>
                                <span class="font-mono text-sm leading-none">&gt;</span>
                            </button>
                        </form>
                    </div>

                    <!-- Col 5: Slogan & Contact (lg:col-span-2) -->
                    <div class="lg:col-span-2 flex flex-col gap-4">
                        <!-- Top Slogan with Upward Growth Arrow -->
                        <div class="flex items-center justify-between pb-2 border-b border-slate-800/80">
                            <div>
                                <div class="text-xl md:text-2xl font-serif italic text-[#ff712c] font-normal leading-tight">Cùng Bạn</div>
                                <div class="text-sm md:text-base font-bold text-white tracking-tight leading-tight">Kiến Tạo Giá Trị Số</div>
                            </div>
                            <div class="shrink-0 -mt-1 flex items-center justify-center">
                                <img src="{{ asset('images/ecosystem/growth_arrow.svg') }}?v=2" 
                                     alt="Kiến tạo giá trị số" 
                                     class="h-10 w-10 object-contain drop-shadow-[0_2px_10px_rgba(255,94,0,0.5)]">
                            </div>
                        </div>

                        <!-- 3 Contact Items -->
                        <div class="flex flex-col gap-3.5 text-xs">
                            <!-- Hotline -->
                            <a href="tel:0939363262" class="flex items-center gap-3 group">
                                <div class="w-8 h-8 rounded-full border border-orange-500/60 bg-orange-500/10 flex items-center justify-center text-orange-400 group-hover:scale-105 group-hover:border-orange-400 transition-all shrink-0">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-white text-sm tracking-wide group-hover:text-orange-400 transition-colors">0939.363.262</div>
                                    <div class="text-slate-400 text-[11px] truncate">Hotline tư vấn miễn phí</div>
                                </div>
                            </a>

                            <!-- Email -->
                            <a href="mailto:info@cuulongmedia.vn" class="flex items-center gap-3 group">
                                <div class="w-8 h-8 rounded-full border border-orange-500/60 bg-orange-500/10 flex items-center justify-center text-orange-400 group-hover:scale-105 group-hover:border-orange-400 transition-all shrink-0">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-white text-xs tracking-wide group-hover:text-orange-400 transition-colors truncate">info@cuulongmedia.vn</div>
                                    <div class="text-slate-400 text-[11px] truncate">Email hỗ trợ</div>
                                </div>
                            </a>

                            <!-- Address -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full border border-orange-500/60 bg-orange-500/10 flex items-center justify-center text-orange-400 shrink-0">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-white text-xs tracking-wide leading-snug">Lầu 5 số 57 Hùng Vương</div>
                                    <div class="text-slate-400 text-[11px] leading-snug">P.Ninh Kiều, TP.Cần Thơ</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Bottom Bar: Legal -->
                <div class="pt-6 border-t border-slate-800/80 flex items-center justify-center gap-4 text-slate-400 font-body text-xs text-center">
                    <a class="hover:text-orange-400 transition-colors" href="{{ route('privacy') }}">Chính sách bảo mật</a>
                    <span class="text-slate-600">•</span>
                    <a class="hover:text-orange-400 transition-colors" href="{{ route('terms') }}">Điều khoản dịch vụ</a>
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
        @php
            $zaloPhone = get_setting('social_zalo', '0939363262');
        @endphp
        @if($zaloPhone)
        <a href="https://zalo.me/{{ preg_replace('/[^0-9]/', '', $zaloPhone) }}" target="_blank" class="btn-floating-wrapper btn-wrapper-zalo" title="Chat Zalo: {{ $zaloPhone }}">
            <div class="btn-floating-inner">
                <img src="{{ asset('images/zalo-icon-new.png') }}" alt="Zalo" class="img-zalo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div style="display: none; width: 100%; height: 100%; background: #0068ff; align-items: center; justify-content: center; border-radius: 50%;">
                    <svg viewBox="0 0 48 48" style="width: 28px; height: 28px; fill: white;" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 4C12.95 4 4 12.95 4 24c0 3.84 1.09 7.42 2.97 10.47L4.1 42.6c-.23.77.49 1.48 1.25 1.25l8.13-2.87C16.58 42.91 20.16 44 24 44c11.05 0 20-8.95 20-20S35.05 4 24 4zm-4.7 26.5h-5.8c-.8 0-1.4-.6-1.4-1.4 0-.8.6-1.4 1.4-1.4h3.6l-5.1-6.8c-.3-.4-.4-.9-.2-1.4.2-.5.6-.9 1.1-.9h5.5c.8 0 1.4.6 1.4 1.4 0 .8-.6 1.4-1.4 1.4h-3.3l5.1 6.8c.3.4.4.9.2 1.4-.2.5-.6.9-1.1.9zm13.2 0h-2.5c-.8 0-1.4-.6-1.4-1.4V19.4c0-.8.6-1.4 1.4-1.4s1.4.6 1.4 1.4v8.3h1.1c.8 0 1.4.6 1.4 1.4 0 .8-.6 1.4-1.4 1.4zm9.3-5.2c0 3.4-2.8 5.2-5.7 5.2s-5.7-1.8-5.7-5.2v-2.1c0-3.4 2.8-5.2 5.7-5.2s5.7 1.8 5.7 5.2v2.1zm-2.8-2.1c0-1.8-1.3-2.6-2.9-2.6s-2.9.8-2.9 2.6v2.1c0 1.8 1.3 2.6 2.9 2.6s2.9-.8 2.9-2.6v-2.1z"/>
                    </svg>
                </div>
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

