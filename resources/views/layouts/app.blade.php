<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>@yield('title', 'Truyền Thông Cửu Long - Agency Truyền Thông & Giải Pháp Công Nghệ')</title>
    <meta name="description" content="@yield('meta_description', 'Truyền Thông Cửu Long (Cửu Long Media) là đơn vị hàng đầu cung cấp giải pháp kép: Sản xuất Media, Digital Marketing & Giải pháp công nghệ, phát triển Web/App chuẩn SEO.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Truyền Thông Cửu Long - Agency Truyền Thông & Giải Pháp Công Nghệ')">
    <meta property="og:description" content="@yield('meta_description', 'Agency truyền thông sáng tạo kết hợp giải pháp công nghệ tại Cần Thơ & ĐBSCL.')">
    <meta property="og:image" content="@yield('og_image', asset('storage/uploads/logo.png'))">

    <!-- Schema JSON-LD Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "{{ url('/') }}/#organization",
      "name": "Truyền Thông Cửu Long",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('storage/uploads/logo.png') }}",
      "description": "Nhà cung cấp Dịch vụ CNTT-Viễn Thông và Giải pháp Digital Marketing, Media hàng đầu Việt Nam.",
      "telephone": "+84907123456",
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

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#0B132B] text-slate-200 min-h-screen flex flex-col selection:bg-cyan-500 selection:text-white" x-data="{ mobileMenu: false }">

    @if(env('GTM_ID'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <!-- Sticky Header -->
    <header class="sticky top-0 z-50 glass-panel border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 via-blue-600 to-amber-400 p-[2px] shadow-glow group-hover:scale-105 transition-transform">
                        <div class="w-full h-full bg-[#0B132B] rounded-[10px] flex items-center justify-center font-heading font-black text-cyan-400 text-lg">
                            CL
                        </div>
                    </div>
                    <div>
                        <div class="font-heading font-extrabold text-xl tracking-tight text-white group-hover:text-cyan-400 transition-colors">
                            CỬU LONG <span class="text-cyan-400">MEDIA</span>
                        </div>
                        <div class="text-[10px] uppercase font-semibold tracking-widest text-slate-400">
                            Agency & Tech Solutions
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-300">
                    <a href="{{ route('home') }}" class="hover:text-cyan-400 transition-colors {{ request()->routeIs('home') ? 'text-cyan-400 font-semibold' : '' }}">Trang Chủ</a>
                    
                    <!-- Dropdown Services -->
                    <div class="relative group" x-data="{ open: false }" @mouseleave="open = false">
                        <button @mouseover="open = true" @click="open = !open" class="flex items-center gap-1.5 hover:text-cyan-400 transition-colors py-2 {{ request()->routeIs('services.*') ? 'text-cyan-400 font-semibold' : '' }}">
                            <span>Dịch Vụ</span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition.opacity.duration.200ms class="absolute left-0 mt-2 w-72 glass-panel rounded-2xl p-3 shadow-2xl border border-white/10 z-50" style="display: none;">
                            <div class="text-[11px] font-bold text-cyan-400 uppercase tracking-wider px-3 py-1">Agency Truyền Thông</div>
                            <a href="{{ route('services.show', 'san-xuat-video-media') }}" class="block px-3 py-2 text-sm rounded-xl hover:bg-white/5 hover:text-cyan-300 transition-colors">🎬 Sản xuất Video & TVC</a>
                            <a href="{{ route('services.show', 'digital-marketing-quang-cao') }}" class="block px-3 py-2 text-sm rounded-xl hover:bg-white/5 hover:text-cyan-300 transition-colors">📢 Digital Marketing & Ads</a>
                            
                            <div class="border-t border-white/10 my-2"></div>
                            
                            <div class="text-[11px] font-bold text-amber-400 uppercase tracking-wider px-3 py-1">Giải Pháp Công Nghệ</div>
                            <a href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}" class="block px-3 py-2 text-sm rounded-xl hover:bg-white/5 hover:text-amber-300 transition-colors">💻 Thiết kế Website & App</a>
                            <a href="{{ route('services.show', 'tich-hop-ai-solutions') }}" class="block px-3 py-2 text-sm rounded-xl hover:bg-white/5 hover:text-amber-300 transition-colors">🤖 Trí Tuệ Nhân Tạo (AI)</a>
                        </div>
                    </div>

                    <a href="{{ route('projects.index') }}" class="hover:text-cyan-400 transition-colors {{ request()->routeIs('projects.*') ? 'text-cyan-400 font-semibold' : '' }}">Dự Án</a>
                    <a href="{{ route('blog.index') }}" class="hover:text-cyan-400 transition-colors {{ request()->routeIs('blog.*') ? 'text-cyan-400 font-semibold' : '' }}">Kiến Thức & Tin Tức</a>
                    <a href="{{ route('profile') }}" class="hover:text-cyan-400 transition-colors {{ request()->routeIs('profile') ? 'text-cyan-400 font-semibold' : '' }}">Hồ Sơ Năng Lực</a>
                    <a href="{{ route('contact') }}" class="hover:text-cyan-400 transition-colors {{ request()->routeIs('contact') ? 'text-cyan-400 font-semibold' : '' }}">Liên Hệ</a>
                </nav>

                <!-- Action Button -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('contact') }}" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-semibold rounded-xl group bg-gradient-to-r from-cyan-500 via-blue-600 to-amber-400 shadow-glow hover:scale-105 transition-all">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-[#0B132B] rounded-[10px] group-hover:bg-opacity-0 text-white">
                            Nhận Báo Giá ⚡
                        </span>
                    </a>
                </div>

                <!-- Mobile Menu Toggle Button -->
                <div class="flex md:hidden items-center">
                    <button @click="mobileMenu = !mobileMenu" class="p-2 text-slate-300 hover:text-white focus:outline-none" aria-label="Toggle menu">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="md:hidden glass-panel border-b border-white/10 px-4 pt-2 pb-6 space-y-3" style="display: none;">
            <a href="{{ route('home') }}" class="block py-2 text-base font-medium text-slate-200 hover:text-cyan-400">Trang Chủ</a>
            <a href="{{ route('services.index') }}" class="block py-2 text-base font-medium text-slate-200 hover:text-cyan-400">Dịch Vụ</a>
            <a href="{{ route('projects.index') }}" class="block py-2 text-base font-medium text-slate-200 hover:text-cyan-400">Dự Án</a>
            <a href="{{ route('blog.index') }}" class="block py-2 text-base font-medium text-slate-200 hover:text-cyan-400">Kiến Thức & Tin Tức</a>
            <a href="{{ route('profile') }}" class="block py-2 text-base font-medium text-slate-200 hover:text-cyan-400">Hồ Sơ Năng Lực</a>
            <a href="{{ route('contact') }}" class="block py-2 text-base font-medium text-slate-200 hover:text-cyan-400">Liên Hệ</a>
            <div class="pt-2">
                <a href="{{ route('contact') }}" class="block w-full text-center py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow-glow">
                    Nhận Báo Giá Ngay ⚡
                </a>
            </div>
        </div>
    </header>

    <!-- Global Flash Notification -->
    @if(session('success'))
    <div class="max-w-4xl mx-auto px-4 mt-6 z-40 w-full" x-data="{ show: true }" x-show="show">
        <div class="p-4 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 flex items-center justify-between shadow-glow">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-400 hover:text-white">&times;</button>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#080D1D] border-t border-white/10 pt-16 pb-12 mt-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Company Info -->
                <div class="md:col-span-1 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-blue-600 p-[2px]">
                            <div class="w-full h-full bg-[#0B132B] rounded-[10px] flex items-center justify-center font-heading font-black text-cyan-400">
                                CL
                            </div>
                        </div>
                        <span class="font-heading font-extrabold text-xl text-white">CỬU LONG <span class="text-cyan-400">MEDIA</span></span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Nhà cung cấp Dịch vụ CNTT - Viễn thông & Giải pháp Digital Marketing, Media sáng tạo hàng đầu tại Cần Thơ và Đồng bằng Sông Cửu Long.
                    </p>
                    <div class="text-xs text-slate-400 space-y-1.5 pt-2">
                        <div>📍 Trụ sở: TP. Cần Thơ, Việt Nam</div>
                        <div>📞 Hotline: 0907.xxx.xxx</div>
                        <div>✉️ Email: lienhe@truyenthongcuulong.com</div>
                    </div>
                </div>

                <!-- Column 2: Media Services -->
                <div>
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Truyền Thông Sáng Tạo</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('services.show', 'san-xuat-video-media') }}" class="hover:text-cyan-400 transition-colors">Sản xuất Video TVC & Viral</a></li>
                        <li><a href="{{ route('services.show', 'san-xuat-video-media') }}" class="hover:text-cyan-400 transition-colors">Quay phim Sự kiện & Travel Video</a></li>
                        <li><a href="{{ route('services.show', 'digital-marketing-quang-cao') }}" class="hover:text-cyan-400 transition-colors">Quảng cáo Facebook & Google Ads</a></li>
                        <li><a href="{{ route('services.show', 'digital-marketing-quang-cao') }}" class="hover:text-cyan-400 transition-colors">Quản trị Fanpage & Kênh TikTok</a></li>
                    </ul>
                </div>

                <!-- Column 3: Tech Solutions -->
                <div>
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Giải Pháp Công Nghệ</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}" class="hover:text-amber-400 transition-colors">Thiết kế Website Chuẩn SEO</a></li>
                        <li><a href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}" class="hover:text-amber-400 transition-colors">Phát triển Web App & Phần mềm</a></li>
                        <li><a href="{{ route('services.show', 'tich-hop-ai-solutions') }}" class="hover:text-amber-400 transition-colors">Tích hợp Chatbot AI Doanh Nghiệp</a></li>
                        <li><a href="{{ route('services.show', 'tich-hop-ai-solutions') }}" class="hover:text-amber-400 transition-colors">Tự động hóa Truyền thông (Automation)</a></li>
                    </ul>
                </div>

                <!-- Column 4: Quick Links -->
                <div>
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Tài Nguyên & Liên Kết</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('profile') }}" class="hover:text-cyan-400 transition-colors">Hồ sơ năng lực (E-Profile)</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-cyan-400 transition-colors">Thư viện Kiến thức & Blog</a></li>
                        <li><a href="{{ route('sitemap') }}" class="hover:text-cyan-400 transition-colors">Sitemap XML</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-cyan-400 transition-colors">Liên hệ tư vấn</a></li>
                        <li><a href="{{ url('/admin') }}" class="text-xs text-slate-400 hover:text-slate-300">Đăng nhập Admin CMS</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <div>
                    &copy; {{ date('Y') }} Truyền Thông Cửu Long. All rights reserved. Nền tảng xây dựng trên Laravel 11.
                </div>
                <div class="flex items-center gap-6">
                    <span>Cam kết chất lượng & Bảo mật</span>
                    <span>Tốc độ tối ưu Core Web Vitals</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Contact Widgets -->
    <div class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">
        <a href="tel:0907123456" class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg hover:scale-110 transition-transform shadow-emerald-500/40" title="Gọi hotline">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        </a>
        <a href="https://zalo.me/0907123456" target="_blank" rel="noopener" class="w-12 h-12 rounded-full bg-blue-500 text-white font-bold flex items-center justify-center shadow-lg hover:scale-110 transition-transform shadow-blue-500/40 text-xs" title="Chat Zalo">
            Zalo
        </a>
    </div>

    @stack('scripts')
</body>
</html>
