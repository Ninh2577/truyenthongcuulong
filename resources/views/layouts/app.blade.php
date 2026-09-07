<!DOCTYPE html>
<html class="scroll-smooth" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Cửu Long Media & Technology - Creative Production Studio & Tech Agency')</title>
    <meta name="description" content="@yield('meta_description', 'Cửu Long Media & Technology - Tổ hợp sáng tạo nội dung điện ảnh và công nghệ phần mềm hàng đầu Việt Nam.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Cửu Long Media & Technology - Creative Production Studio & Tech Agency')">
    <meta property="og:description" content="@yield('meta_description', 'Creative Production Studio & Tech Agency tại Cần Thơ & ĐBSCL.')">
    <meta property="og:image" content="@yield('og_image', 'https://lh3.googleusercontent.com/aida/AEtjO1XFwX4HiQFmIiEoAWVzpyEesCWg-s3cW3_OywD-F4P2K6Ihv0FahvOINcwcDs5UYQ_y59TDDy5L5oB6SJndgCTfG4ajjq19W5C55BJfgOAAsK0ncT6ENswBz7W0Cujm6FKLHyDupQNpHhHONPunFiGdBNNQBaPpLYn4RZLhthR_kyx8X3ASC5uoOW2e19gEc8TdFIzSv9FVSu_QbQ4A3DkxVIY3Ucoocwzt26ZMrG5mc7CiH24dQCMDS5o')">

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
      "logo": "https://lh3.googleusercontent.com/aida/AEtjO1XFwX4HiQFmIiEoAWVzpyEesCWg-s3cW3_OywD-F4P2K6Ihv0FahvOINcwcDs5UYQ_y59TDDy5L5oB6SJndgCTfG4ajjq19W5C55BJfgOAAsK0ncT6ENswBz7W0Cujm6FKLHyDupQNpHhHONPunFiGdBNNQBaPpLYn4RZLhthR_kyx8X3ASC5uoOW2e19gEc8TdFIzSv9FVSu_QbQ4A3DkxVIY3Ucoocwzt26ZMrG5mc7CiH24dQCMDS5o",
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

    @if(env('GTM_ID'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <!-- ==================== HEADER / NAVIGATION ==================== -->
    <header class="fixed top-0 left-0 right-0 w-full z-50 bg-white/85 backdrop-blur-md border-b border-slate-200/70 shadow-sm transition-all">
        <div class="h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
            <!-- Brand Logo -->
            <a class="flex items-center gap-3 group" href="{{ route('home') }}">
                <div class="p-1 rounded-xl bg-navy-base/5 border border-slate-200/80 group-hover:border-primary/40 transition-colors">
                    <img alt="Cửu Long Media & Tech Logo" class="h-9 w-auto object-contain transition-transform duration-300 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida/AEtjO1XFwX4HiQFmIiEoAWVzpyEesCWg-s3cW3_OywD-F4P2K6Ihv0FahvOINcwcDs5UYQ_y59TDDy5L5oB6SJndgCTfG4ajjq19W5C55BJfgOAAsK0ncT6ENswBz7W0Cujm6FKLHyDupQNpHhHONPunFiGdBNNQBaPpLYn4RZLhthR_kyx8X3ASC5uoOW2e19gEc8TdFIzSv9FVSu_QbQ4A3DkxVIY3Ucoocwzt26ZMrG5mc7CiH24dQCMDS5o"/>
                </div>
                <div class="hidden sm:flex flex-col">
                    <span class="font-headline text-lg font-bold tracking-tight text-navy-base leading-tight">CỬU LONG</span>
                    <span class="text-[10px] font-mono tracking-widest text-primary font-bold uppercase">Media • Studio • Tech</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden xl:flex items-center gap-8">
                <a class="font-headline text-sm font-bold text-primary relative py-1 after:absolute after:-bottom-1.5 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-primary after:to-accent-amber after:rounded-full after:shadow-[0_0_8px_rgba(234,88,12,0.8)]" href="{{ route('home') }}">Trang chủ</a>
                <a class="font-headline text-sm font-semibold text-slate-600 hover:text-primary transition-colors" href="{{ route('home') }}#services-pillars">Dịch vụ cốt lõi</a>
                <a class="font-headline text-sm font-semibold text-slate-600 hover:text-primary transition-colors" href="{{ route('home') }}#why-clm">Lợi thế tích hợp</a>
                <a class="font-headline text-sm font-semibold text-slate-600 hover:text-primary transition-colors" href="{{ route('home') }}#portfolio-section">Showreel &amp; Dự án</a>
                <a class="font-headline text-sm font-semibold text-slate-600 hover:text-primary transition-colors" href="{{ route('blog.index') }}">Kiến thức</a>
                <a class="font-headline text-sm font-semibold text-slate-600 hover:text-primary transition-colors" href="{{ route('profile') }}">Hồ sơ năng lực</a>
                <a class="font-headline text-sm font-semibold text-slate-600 hover:text-primary transition-colors" href="#about-clm">Về chúng tôi</a>
            </nav>

            <!-- Action & Hotline -->
            <div class="flex items-center gap-3">
                <a class="hidden md:flex items-center gap-2 text-xs font-semibold text-slate-700 hover:text-primary transition-colors py-2 px-4 rounded-full bg-slate-100 border border-slate-200 shadow-xs" href="tel:+84908888256">
                    <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                    <span>(+84) 908 888 CLM</span>
                </a>
                <a class="inline-flex items-center justify-center px-5 sm:px-6 py-2.5 rounded-full bg-gradient-to-r from-primary via-orange-500 to-accent-amber text-white font-headline text-xs sm:text-sm font-bold shadow-[0_4px_18px_rgba(234,88,12,0.35)] hover:shadow-[0_6px_24px_rgba(234,88,12,0.5)] hover:scale-[1.02] active:scale-[0.98] transition-all border border-orange-400/40" href="#cta-contact">
                    Yêu Cầu Tư Vấn
                </a>
                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="xl:hidden p-2 text-slate-700 hover:text-primary">
                    <span class="material-symbols-outlined text-[28px]">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenu" x-transition class="xl:hidden bg-white border-b border-slate-200 px-4 py-4 space-y-3" style="display: none;">
            <a class="block font-headline text-sm font-bold text-primary" href="{{ route('home') }}">Trang chủ</a>
            <a class="block font-headline text-sm font-semibold text-slate-600" href="{{ route('home') }}#services-pillars">Dịch vụ cốt lõi</a>
            <a class="block font-headline text-sm font-semibold text-slate-600" href="{{ route('home') }}#why-clm">Lợi thế tích hợp</a>
            <a class="block font-headline text-sm font-semibold text-slate-600" href="{{ route('home') }}#portfolio-section">Showreel & Dự án</a>
            <a class="block font-headline text-sm font-semibold text-slate-600" href="{{ route('blog.index') }}">Kiến thức</a>
            <a class="block font-headline text-sm font-semibold text-slate-600" href="{{ route('profile') }}">Hồ sơ năng lực</a>
            <a class="block font-headline text-sm font-semibold text-slate-600" href="{{ route('contact') }}">Liên hệ</a>
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

        <!-- ==================== CTA BAND ==================== -->
        <section class="w-full relative overflow-hidden bg-gradient-to-r from-navy-base via-primary to-accent-coral py-16 text-white shadow-2xl" id="cta-contact">
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
                        Đặt lịch tư vấn chiến lược 1:1 cùng các chuyên gia hàng đầu tại Cửu Long. Chúng tôi phân tích hiện trạng và phác thảo lộ trình sản xuất truyền thông và hệ thống số tối ưu riêng cho bạn.
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

        <!-- ==================== FOOTER (DARK NAVY) ==================== -->
        <footer class="w-full bg-navy-base text-white pt-16 pb-12 border-t border-t-amber-500/30 relative" id="about-clm">
            <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-primary to-accent-coral"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
                    <!-- Col 1: Brand Info -->
                    <div class="lg:col-span-4 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="p-1 rounded-xl bg-white/10 border border-white/10">
                                <img alt="Cuu Long Media Tech Logo" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/AEtjO1XFwX4HiQFmIiEoAWVzpyEesCWg-s3cW3_OywD-F4P2K6Ihv0FahvOINcwcDs5UYQ_y59TDDy5L5oB6SJndgCTfG4ajjq19W5C55BJfgOAAsK0ncT6ENswBz7W0Cujm6FKLHyDupQNpHhHONPunFiGdBNNQBaPpLYn4RZLhthR_kyx8X3ASC5uoOW2e19gEc8TdFIzSv9FVSu_QbQ4A3DkxVIY3Ucoocwzt26ZMrG5mc7CiH24dQCMDS5o"/>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline text-lg font-bold text-white leading-tight">CỬU LONG</span>
                                <span class="font-mono text-[10px] text-accent-amber uppercase tracking-widest font-bold">Media &amp; Technology Hub</span>
                            </div>
                        </div>
                        <p class="font-body text-xs text-slate-400 leading-relaxed">
                            Cửu Long Media &amp; Technology - Tổ hợp sáng tạo nội dung điện ảnh và công nghệ phần mềm hàng đầu Việt Nam. Tích hợp nghệ thuật kể chuyện cùng năng lực kỹ thuật chuẩn doanh nghiệp.
                        </p>
                        <div class="flex items-center gap-3 pt-2 text-slate-400">
                            <a aria-label="Facebook" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
                                <span class="material-symbols-outlined text-[16px]">share</span>
                            </a>
                            <a aria-label="LinkedIn" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
                                <span class="material-symbols-outlined text-[16px]">work</span>
                            </a>
                            <a aria-label="YouTube" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
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
                            <li><a class="hover:text-amber-400 transition-colors" href="#services-pillars">3 Trụ cột năng lực</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="#portfolio-section">Showreel &amp; Case Studies</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('profile') }}">Hồ sơ năng lực</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('blog.index') }}">Tin tức &amp; Xu hướng Media</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Services -->
                    <div class="lg:col-span-3 flex flex-col gap-3">
                        <h4 class="font-headline text-sm font-bold text-white uppercase tracking-wider">Dịch Vụ Cốt Lõi</h4>
                        <ul class="flex flex-col gap-2 font-body text-xs text-slate-400">
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.show', 'san-xuat-video-media') }}">Quay TVC Doanh Nghiệp 4K</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}">Thiết kế &amp; Lập trình Web/App</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.show', 'digital-marketing-quang-cao') }}">Quảng cáo Performance TikTok &amp; Meta</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('services.show', 'tich-hop-ai-solutions') }}">3D Motion Design &amp; AI Studio</a></li>
                            <li><a class="hover:text-amber-400 transition-colors" href="{{ route('contact') }}">Booking Báo chí &amp; PR</a></li>
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

                <!-- Ecosystem Strip: Member entities -->
                <div class="flex flex-col gap-4 pt-8 border-t border-white/10">
                    <span class="font-mono text-[10px] text-slate-400 uppercase tracking-widest text-center font-bold">
                        HỆ SINH THÁI THÀNH VIÊN TRUYỀN THÔNG CỬU LONG
                    </span>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] transition-colors">
                            <div class="w-9 h-9 rounded-xl bg-primary/20 text-orange-400 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[19px]">movie</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate">CLM Studio</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">4K Film &amp; Visual Arts</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] transition-colors">
                            <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[19px]">psychology</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate">CLM TechLab</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">Web/App &amp; Generative AI</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] transition-colors">
                            <div class="w-9 h-9 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[19px]">animation</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate">CLM Motion &amp; VFX</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">3D CGI &amp; Post-production</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center gap-3 hover:bg-white/[0.08] transition-colors">
                            <div class="w-9 h-9 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[19px]">rocket</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs text-white font-bold truncate">CLM Ventures</span>
                                <span class="font-mono text-[10px] text-slate-400 truncate">Vườn ươm dự án số</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyright & Legal -->
                <div class="pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-slate-500 font-body text-xs text-center md:text-left">
                    <p>© 2026 Truyền Thông Cửu Long (CLM Media &amp; Tech). Giấy phép ICP số 188/GP-BTTTT.</p>
                    <div class="flex gap-4">
                        <a class="hover:text-amber-400 transition-colors" href="#">Chính sách bảo mật</a>
                        <span>•</span>
                        <a class="hover:text-amber-400 transition-colors" href="#">Điều khoản dịch vụ</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    @stack('scripts')
</body>
</html>