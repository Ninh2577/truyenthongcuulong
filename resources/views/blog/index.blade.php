@extends('layouts.app')

@section('title', 'Tạp Chí Truyền Thông & Công Nghệ - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá kiến thức chuyên sâu về Sản xuất TVC điện ảnh, Thiết kế Web/App chịu tải cao, Chiến lược Digital Marketing và Thư viện tài nguyên tải về.')

@section('content')
<!-- ==================== 1. FULL-WIDTH BLOG HERO BANNER (IDENTICAL TO USER DESIGN) ==================== -->
<section class="relative w-full bg-white border-b border-slate-200/80 pt-0 select-none group" id="blog-hero-section" style="position: relative; z-index: 40; overflow: visible !important;">
    
    {{-- Dedicated Scoped CSS ensuring 100% styling fidelity independent of Tailwind JIT compilation --}}
    <style>
        #blog-hero-section {
            position: relative !important;
            z-index: 40 !important;
            overflow: visible !important;
        }
        #blog-hero-section .hero-canvas {
            overflow: visible !important;
        }
        #blog-hero-section .hero-search-wrapper {
            z-index: 50 !important;
        }
        #blog-hero-section .hero-search-dropdown {
            z-index: 100 !important;
            box-shadow: 0 20px 45px -5px rgba(0, 0, 0, 0.22), 0 0 0 1px rgba(0, 0, 0, 0.06) !important;
        }
        #blog-hero-section .hero-card-inactive {
            background-color: #FFFFFF !important;
            border: 1px solid #F1F5F9 !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05) !important;
            transition: all 0.25s ease !important;
        }
        #blog-hero-section .hero-card-inactive:hover {
            border-color: #FFD2C0 !important;
            box-shadow: 0 8px 24px rgba(255, 94, 20, 0.16) !important;
            transform: translateY(-2px);
        }
        #blog-hero-section .hero-card-active {
            background: linear-gradient(135deg, #FF5E14 0%, #FF6E1C 100%) !important;
            color: #FFFFFF !important;
            box-shadow: 0 8px 24px rgba(255, 94, 20, 0.38) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            transform: translateY(-1px);
        }
        #blog-hero-section .hero-search-container {
            background-color: #FFFFFF !important;
            border: 1.5px solid #E2E8F0 !important;
            border-radius: 9999px !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08) !important;
            transition: all 0.2s ease !important;
        }
        #blog-hero-section .hero-search-container:focus-within {
            border-color: #FF5E14 !important;
            box-shadow: 0 8px 24px rgba(255, 94, 20, 0.22) !important;
        }
        #blog-hero-section input.hero-search-input,
        #blog-hero-section input[type="text"] {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            background: transparent !important;
            background-color: transparent !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
        }
        #blog-hero-section input.hero-search-input:focus,
        #blog-hero-section input[type="text"]:focus {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            --tw-ring-shadow: 0 0 #0000 !important;
            --tw-ring-offset-shadow: 0 0 #0000 !important;
        }
        #blog-hero-section .hero-search-btn {
            background: linear-gradient(135deg, #FF5E14 0%, #FF772A 100%) !important;
            color: #FFFFFF !important;
            border: none !important;
            outline: none !important;
            border-radius: 9999px !important;
            box-shadow: 0 4px 12px rgba(255, 94, 20, 0.4) !important;
            transition: all 0.2s ease !important;
        }
        #blog-hero-section .hero-search-btn:hover {
            background: linear-gradient(135deg, #E04F0F 0%, #FF5E14 100%) !important;
            transform: scale(1.04);
        }
    </style>

    {{-- Semantic Headings for SEO & Accessibility --}}
    <div class="sr-only">
        <h1>Tạp Chí Truyền Thông &amp; Công Nghệ Số - Truyền Thông Cửu Long</h1>
        <h2>Kho tàng 480+ bài viết phân tích xu hướng thị trường, cẩm nang sản xuất phim TVC, kiến thức giải pháp phần mềm và case study thực chiến.</h2>
        <nav aria-label="Chuyên mục bài viết">
            <a href="{{ route('blog.index') }}">Tất cả bài viết</a>
            @foreach($categories as $cat)
                <a href="{{ route('blog.resolve', $cat->slug) }}">{{ $cat->name }}</a>
            @endforeach
        </nav>
    </div>

    {{-- ==================== DESKTOP & TABLET CANVAS (>= 768px, ASPECT RATIO 1024 / 341) ==================== --}}
    <div class="relative w-full hidden md:block @container select-none hero-canvas" style="aspect-ratio: 1024 / 341; min-height: 360px; overflow: visible !important;">
        
        {{-- Layer 1: Edge-to-Edge Wave Background --}}
        <img src="{{ asset('images/blog/orange_waves_bg.png') }}" 
             alt="Background" 
             class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none z-0">
             
        {{-- Layer 2: Desk Photography Artwork --}}
        <img src="{{ asset('images/blog/desk_artwork.png') }}" 
             alt="Bàn làm việc sáng tạo" 
             class="absolute select-none pointer-events-none z-10"
             style="left: 45.5%; top: 11%; width: 53.5%; height: auto; max-height: 68%; object-fit: contain;">

        {{-- Layer 3: Top Right Branding Logo (Over Dot Grid) --}}
        <div class="absolute z-20 flex items-center gap-2 pointer-events-auto"
             style="right: 5.5%; top: 4.8%;">
            <img src="{{ asset('images/logo-ttcl.png') }}" alt="Truyền Thông Cửu Long Logo" 
                 class="object-contain" style="width: clamp(26px, 2.6cqw, 40px); height: clamp(26px, 2.6cqw, 40px);">
            <div class="flex flex-col text-left">
                <span class="font-headline font-extrabold text-[#0B1324] leading-tight tracking-wider" style="font-size: clamp(9px, 0.95cqw, 14px);">TRUYỀN THÔNG</span>
                <span class="font-headline font-black text-[#0B1324] leading-none tracking-tight" style="font-size: clamp(11px, 1.15cqw, 17px);">CỬU LONG</span>
            </div>
        </div>

        {{-- Layer 4: Editorial Badge Pill --}}
        <div class="absolute z-20 inline-flex items-center gap-1.5 rounded-full"
             style="left: 5.8%; top: 11.5%; padding: 0.35cqw 1.1cqw; background-color: #FFF0EB !important; border: 1.5px solid #FFD2C0 !important;">
            <span class="rounded-full shrink-0" style="width: clamp(5px, 0.5cqw, 8px); height: clamp(5px, 0.5cqw, 8px); background-color: #FF5E14 !important;"></span>
            <span class="font-mono font-bold uppercase tracking-wider" style="color: #FF5E14 !important; font-size: clamp(8px, 0.78cqw, 11px);">EDITORIAL &amp; INSIGHTS HUB</span>
        </div>

        {{-- Layer 5: Main Heading --}}
        <h1 class="absolute z-20 font-headline font-black leading-[1.14] tracking-tight text-left"
            style="left: 5.8%; top: 19.5%; font-size: clamp(20px, 2.75cqw, 43px); color: #1e293b !important;">
            Tạp Chí <span class="relative inline-block" style="color: #FF5E14 !important;">
                Truyền Thông
                <svg class="absolute -bottom-1 left-0 w-full" style="height: clamp(4px, 0.55cqw, 9px);" viewBox="0 0 100 12" preserveAspectRatio="none" fill="none">
                    <path d="M0,7 Q50,14 100,6" stroke="#FF5E14" stroke-width="3.5" stroke-linecap="round"/>
                </svg>
            </span><br>
            &amp; Công Nghệ Số
        </h1>

        {{-- Layer 6: Subtitle / Description --}}
        <p class="absolute z-20 font-body leading-relaxed text-left"
           style="left: 5.8%; top: 43.5%; max-width: 38%; font-size: clamp(9px, 0.92cqw, 14px); line-height: 1.45; color: #475569 !important;">
            Kho tàng {{ $categories->sum('posts_count') > 0 ? $categories->sum('posts_count') . '+' : '480+' }} bài viết phân tích xu hướng thị trường, cẩm nang sản xuất phim TVC, kiến thức giải pháp phần mềm và case study thực chiến.
        </p>

        {{-- Layer 7: Three Feature Items (Left Side) --}}
        <div class="absolute z-20 flex items-center justify-between"
             style="left: 5.8%; top: 56.5%; width: 38.5%;">
            
            <!-- Feature 1: Kiến thức chuyên sâu -->
            <div class="flex items-center gap-2">
                <div class="rounded-xl flex items-center justify-center shrink-0"
                     style="width: clamp(26px, 2.5cqw, 36px); height: clamp(26px, 2.5cqw, 36px); background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; box-shadow: 0 4px 10px rgba(255, 94, 20, 0.3) !important; border-radius: 9px;">
                    <span class="material-symbols-outlined" style="color: #FFFFFF !important; font-size: clamp(15px, 1.5cqw, 21px);">article</span>
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-headline font-bold leading-tight whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(9px, 0.85cqw, 12px);">Kiến thức chuyên sâu</span>
                    <span class="font-body leading-tight mt-0.5 whitespace-nowrap" style="color: #64748b !important; font-size: clamp(7.5px, 0.72cqw, 10px);">Từ thực tiễn, có giá trị</span>
                </div>
            </div>

            <!-- Feature 2: Cập nhật liên tục -->
            <div class="flex items-center gap-2">
                <div class="rounded-xl flex items-center justify-center shrink-0"
                     style="width: clamp(26px, 2.5cqw, 36px); height: clamp(26px, 2.5cqw, 36px); background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; box-shadow: 0 4px 10px rgba(255, 94, 20, 0.3) !important; border-radius: 9px;">
                    <span class="material-symbols-outlined" style="color: #FFFFFF !important; font-size: clamp(15px, 1.5cqw, 21px);">lightbulb</span>
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-headline font-bold leading-tight whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(9px, 0.85cqw, 12px);">Cập nhật liên tục</span>
                    <span class="font-body leading-tight mt-0.5 whitespace-nowrap" style="color: #64748b !important; font-size: clamp(7.5px, 0.72cqw, 10px);">Bắt kịp xu hướng mới</span>
                </div>
            </div>

            <!-- Feature 3: Dành cho doanh nghiệp -->
            <div class="flex items-center gap-2">
                <div class="rounded-xl flex items-center justify-center shrink-0"
                     style="width: clamp(26px, 2.5cqw, 36px); height: clamp(26px, 2.5cqw, 36px); background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; box-shadow: 0 4px 10px rgba(255, 94, 20, 0.3) !important; border-radius: 9px;">
                    <span class="material-symbols-outlined" style="color: #FFFFFF !important; font-size: clamp(15px, 1.5cqw, 21px);">groups</span>
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-headline font-bold leading-tight whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(9px, 0.85cqw, 12px);">Dành cho doanh nghiệp</span>
                    <span class="font-body leading-tight mt-0.5 whitespace-nowrap" style="color: #64748b !important; font-size: clamp(7.5px, 0.72cqw, 10px);">Hỗ trợ tăng trưởng bền vững</span>
                </div>
            </div>
        </div>

        {{-- Layer 8: 3 Floating Badges (Over the desk setup) --}}
        <!-- Badge 1: Công nghệ hiện đại -->
        <div class="absolute z-20 inline-flex items-center rounded-full hover:scale-105 transition-transform"
             style="left: 50.8%; top: 10.5%; padding: 0.35cqw 0.9cqw 0.35cqw 0.4cqw; gap: 0.5cqw; background: #FFFFFF !important; box-shadow: 0 10px 25px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04) !important; border: 1px solid rgba(226, 232, 240, 0.9) !important; border-radius: 9999px;">
            <div class="rounded-lg flex items-center justify-center font-mono font-bold shrink-0"
                 style="width: clamp(20px, 1.8cqw, 26px); height: clamp(20px, 1.8cqw, 26px); font-size: clamp(7.5px, 0.75cqw, 10.5px); background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; border-radius: 8px; box-shadow: 0 3px 8px rgba(255, 94, 20, 0.35) !important;">
                &lt;/&gt;
            </div>
            <div class="flex flex-col text-left" style="line-height: 1.15;">
                <span class="font-headline font-bold whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(8px, 0.78cqw, 11px);">Công nghệ</span>
                <span class="font-headline font-bold whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(8px, 0.78cqw, 11px);">hiện đại</span>
            </div>
        </div>

        <!-- Badge 2: Sáng tạo không giới hạn -->
        <div class="absolute z-20 inline-flex items-center rounded-full hover:scale-105 transition-transform"
             style="left: 63.8%; top: 8%; padding: 0.35cqw 0.9cqw 0.35cqw 0.4cqw; gap: 0.5cqw; background: #FFFFFF !important; box-shadow: 0 10px 25px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04) !important; border: 1px solid rgba(226, 232, 240, 0.9) !important; border-radius: 9999px;">
            <div class="rounded-full flex items-center justify-center shrink-0"
                 style="width: clamp(20px, 1.8cqw, 26px); height: clamp(20px, 1.8cqw, 26px); background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; border-radius: 9999px; box-shadow: 0 3px 8px rgba(255, 94, 20, 0.35) !important;">
                <span class="material-symbols-outlined" style="color: #FFFFFF !important; font-size: clamp(12px, 1.15cqw, 16px);">lightbulb</span>
            </div>
            <div class="flex flex-col text-left" style="line-height: 1.15;">
                <span class="font-headline font-bold whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(8px, 0.78cqw, 11px);">Sáng tạo</span>
                <span class="font-headline font-bold whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(8px, 0.78cqw, 11px);">không giới hạn</span>
            </div>
        </div>

        <!-- Badge 3: Hiệu quả bền vững -->
        <div class="absolute z-20 inline-flex items-center rounded-full hover:scale-105 transition-transform"
             style="left: 86.2%; top: 19%; padding: 0.35cqw 0.9cqw 0.35cqw 0.4cqw; gap: 0.5cqw; background: #FFFFFF !important; box-shadow: 0 10px 25px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04) !important; border: 1px solid rgba(226, 232, 240, 0.9) !important; border-radius: 9999px;">
            <div class="rounded-lg flex items-center justify-center shrink-0"
                 style="width: clamp(20px, 1.8cqw, 26px); height: clamp(20px, 1.8cqw, 26px); background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; border-radius: 8px; box-shadow: 0 3px 8px rgba(255, 94, 20, 0.35) !important;">
                <span class="material-symbols-outlined" style="color: #FFFFFF !important; font-size: clamp(12px, 1.15cqw, 16px);">bar_chart</span>
            </div>
            <div class="flex flex-col text-left" style="line-height: 1.15;">
                <span class="font-headline font-bold whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(8px, 0.78cqw, 11px);">Hiệu quả bền</span>
                <span class="font-headline font-bold whitespace-nowrap" style="color: #1e293b !important; font-size: clamp(8px, 0.78cqw, 11px);">vững</span>
            </div>
        </div>

        {{-- Layer 9: Live Search Bar --}}
        <div class="absolute hero-search-wrapper"
             style="left: 71.8%; top: 62.5%; width: 23.5%; height: 9.8%; z-index: 50 !important;"
             x-data="{
                query: '{{ request('q') }}',
                results: [],
                loading: false,
                open: false,
                search() {
                    if (this.query.trim().length < 2) {
                        this.results = [];
                        this.open = false;
                        return;
                    }
                    this.loading = true;
                    fetch('{{ route('api.search-posts') }}?q=' + encodeURIComponent(this.query))
                        .then(res => res.json())
                        .then(data => {
                            this.results = data.results || [];
                            this.open = true;
                            this.loading = false;
                        })
                        .catch(() => { this.loading = false; });
                }
             }" @click.outside="open = false">
             
            <form action="{{ route('blog.index') }}" method="GET" class="w-full h-full relative">
                <div class="hero-search-container w-full h-full flex items-center justify-between pl-3.5 sm:pl-4 pr-1"
                     style="background-color: #FFFFFF !important; border: 1.5px solid #E2E8F0 !important; border-radius: 9999px !important; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08) !important;">
                    <input type="text" name="q" x-model="query" @input.debounce.300ms="search()" 
                           placeholder="Tìm kiếm bài viết, tài liệu..." 
                           class="hero-search-input w-full h-full font-medium"
                           style="border: none !important; outline: none !important; box-shadow: none !important; -webkit-box-shadow: none !important; background: transparent !important; background-color: transparent !important; color: #1e293b !important; font-size: clamp(8.5px, 0.85cqw, 13px); padding: 0 8px 0 0 !important; margin: 0 !important;">
                    <button type="submit" 
                            class="hero-search-btn aspect-square rounded-full flex items-center justify-center shrink-0 active:scale-95 cursor-pointer"
                            style="height: 80% !important; min-width: 26px; aspect-ratio: 1 / 1; border-radius: 9999px !important; border: none !important; outline: none !important; background: linear-gradient(135deg, #FF5E14 0%, #FF772A 100%) !important; color: #FFFFFF !important; box-shadow: 0 4px 12px rgba(255, 94, 20, 0.4) !important;"
                            title="Tìm kiếm" aria-label="Tìm kiếm bài viết">
                        <span class="material-symbols-outlined" style="color: #FFFFFF !important; font-size: clamp(13px, 1.35cqw, 19px); line-height: 1;">search</span>
                    </button>
                </div>
            </form>

            <!-- Autocomplete Dropdown -->
            <div x-show="open && results.length > 0" x-transition 
                 class="hero-search-dropdown absolute top-full right-0 mt-2 w-[340px] xl:w-[380px] bg-white rounded-2xl border border-slate-200/90 overflow-hidden divide-y divide-slate-100 max-h-72 overflow-y-auto"
                 style="z-index: 100 !important; box-shadow: 0 20px 45px -5px rgba(0, 0, 0, 0.22), 0 0 0 1px rgba(0, 0, 0, 0.06) !important;">
                <template x-for="item in results" :key="item.url">
                    <a :href="item.url" class="p-3 flex items-start gap-2.5 hover:bg-orange-50/60 transition-colors group">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                             style="background-color: #FFF0EB !important; border: 1px solid #FFD2C0 !important; color: #FF5E14 !important;">
                            <span class="material-symbols-outlined text-[16px]" style="color: #FF5E14 !important;">article</span>
                        </div>
                        <div class="flex flex-col min-w-0 text-left">
                            <span class="font-headline text-xs font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-1" x-text="item.title"></span>
                            <div class="flex items-center gap-1.5 text-[10px] font-mono text-slate-400 mt-0.5">
                                <span class="font-semibold" style="color: #FF5E14 !important;" x-text="item.category"></span>
                                <span>•</span>
                                <span x-text="item.date"></span>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>

        {{-- Layer 10: 6 Bottom Category Cards --}}
        <div class="absolute z-20 flex items-center justify-between"
             style="left: 5.8%; top: 74.5%; width: 88.5%; height: 13.5%;">
             
            @php
                $isAllActive = !request('category') && !request('q');
                $totalPosts = $categories->sum('posts_count') > 0 ? $categories->sum('posts_count') . '+' : '480+' ;
                
                $catDefs = [
                    ['keywords' => ['kinh nghiệm', 'thực chiến'], 'defaultName' => 'Kinh Nghiệm Thực Chiến', 'icon' => 'movie', 'defaultCount' => 185, 'width' => '17.5%'],
                    ['keywords' => ['kiến thức', 'hướng dẫn'], 'defaultName' => 'Kiến Thức', 'icon' => 'edit_note', 'defaultCount' => 147, 'width' => '14.5%'],
                    ['keywords' => ['media', 'sản xuất', 'công nghệ'], 'defaultName' => 'Media & Sản Xuất', 'icon' => 'tv', 'defaultCount' => 145, 'width' => '16.5%'],
                    ['keywords' => ['marketing', 'quảng cáo'], 'defaultName' => 'Marketing Online', 'icon' => 'campaign', 'defaultCount' => 5, 'width' => '15.8%'],
                    ['keywords' => ['tin tức', 'hoạt động'], 'defaultName' => 'Tin Tức Hoạt Động', 'icon' => 'trending_up', 'defaultCount' => 3, 'width' => '15.2%'],
                ];
            @endphp

            <!-- Card 1: Tất cả bài viết -->
            <a href="{{ route('blog.index') }}" 
               class="h-full flex items-center justify-between px-2.5 lg:px-3 rounded-2xl transition-all duration-300 {{ $isAllActive ? 'hero-card-active' : 'hero-card-inactive' }}"
               style="width: 15.5%; border-radius: 16px; {{ $isAllActive ? 'background: linear-gradient(135deg, #FF5E14 0%, #FF6E1C 100%) !important; color: #FFFFFF !important; box-shadow: 0 8px 24px rgba(255, 94, 20, 0.38) !important;' : 'background-color: #FFFFFF !important; border: 1px solid #F1F5F9 !important; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05) !important;' }}">
                <div class="flex items-center gap-2 min-w-0">
                    <div class="card-icon-box rounded-xl flex items-center justify-center shrink-0"
                         style="width: clamp(23px, 2.2cqw, 32px); height: clamp(23px, 2.2cqw, 32px); border-radius: 10px; {{ $isAllActive ? 'background: rgba(255, 255, 255, 0.22) !important; color: #FFFFFF !important;' : 'background-color: #FFF0EB !important; color: #FF5E14 !important;' }}">
                        <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.35cqw, 19px); {{ $isAllActive ? 'color: #FFFFFF !important;' : 'color: #FF5E14 !important;' }}">grid_view</span>
                    </div>
                    <div class="flex flex-col min-w-0 text-left">
                        <span class="card-title font-headline font-bold leading-tight truncate" style="font-size: clamp(8.5px, 0.8cqw, 12px); {{ $isAllActive ? 'color: #FFFFFF !important;' : 'color: #1E293B !important;' }}">Tất cả bài viết</span>
                        <span class="card-count font-mono leading-tight mt-0.5" style="font-size: clamp(7.5px, 0.7cqw, 10px); {{ $isAllActive ? 'color: rgba(255,255,255,0.95) !important; font-weight: 700;' : 'color: #64748B !important; font-weight: 600;' }}">{{ $totalPosts }}</span>
                    </div>
                </div>
                <span class="card-arrow material-symbols-outlined shrink-0 ml-1" style="font-size: clamp(12px, 1.15cqw, 16px); {{ $isAllActive ? 'color: #FFFFFF !important;' : 'color: #FF5E14 !important;' }}">chevron_right</span>
            </a>

            <!-- Cards 2 to 6 -->
            @foreach($catDefs as $idx => $def)
                @php
                    $matchedCat = $categories->first(function($c) use ($def) {
                        $name = mb_strtolower($c->name);
                        foreach ($def['keywords'] as $kw) {
                            if (str_contains($name, $kw)) return true;
                        }
                        return false;
                    }) ?? $categories->get($idx);

                    $catName = $matchedCat ? $matchedCat->name : $def['defaultName'];
                    $catCount = $matchedCat ? $matchedCat->posts_count : $def['defaultCount'];
                    $catSlug = $matchedCat ? $matchedCat->slug : null;
                    $isActive = request('category') === $catSlug;
                @endphp

                <a href="{{ $catSlug ? route('blog.resolve', $catSlug) : route('blog.index') }}" 
                   class="h-full flex items-center justify-between px-2.5 lg:px-3 rounded-2xl transition-all duration-300 {{ $isActive ? 'hero-card-active' : 'hero-card-inactive' }}"
                   style="width: {{ $def['width'] }}; border-radius: 16px; {{ $isActive ? 'background: linear-gradient(135deg, #FF5E14 0%, #FF6E1C 100%) !important; color: #FFFFFF !important; box-shadow: 0 8px 24px rgba(255, 94, 20, 0.38) !important;' : 'background-color: #FFFFFF !important; border: 1px solid #F1F5F9 !important; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05) !important;' }}">
                    <div class="flex items-center gap-2 min-w-0">
                        <div class="card-icon-box rounded-xl flex items-center justify-center shrink-0"
                             style="width: clamp(23px, 2.2cqw, 32px); height: clamp(23px, 2.2cqw, 32px); border-radius: 10px; {{ $isActive ? 'background: rgba(255, 255, 255, 0.22) !important; color: #FFFFFF !important;' : 'background-color: #FFF0EB !important; color: #FF5E14 !important;' }}">
                            <span class="material-symbols-outlined" style="font-size: clamp(14px, 1.35cqw, 19px); {{ $isActive ? 'color: #FFFFFF !important;' : 'color: #FF5E14 !important;' }}">{{ $def['icon'] }}</span>
                        </div>
                        <div class="flex flex-col min-w-0 text-left">
                            <span class="card-title font-headline font-bold leading-tight truncate" style="font-size: clamp(8.5px, 0.8cqw, 12px); {{ $isActive ? 'color: #FFFFFF !important;' : 'color: #1E293B !important;' }}">{{ $catName }}</span>
                            <span class="card-count font-mono leading-tight mt-0.5" style="font-size: clamp(7.5px, 0.7cqw, 10px); {{ $isActive ? 'color: rgba(255,255,255,0.95) !important; font-weight: 700;' : 'color: #64748B !important; font-weight: 600;' }}">{{ $catCount }}</span>
                        </div>
                    </div>
                    <span class="card-arrow material-symbols-outlined shrink-0 ml-1" style="font-size: clamp(12px, 1.15cqw, 16px); {{ $isActive ? 'color: #FFFFFF !important;' : 'color: #FF5E14 !important;' }}">chevron_right</span>
                </a>
            @endforeach

        </div>

        {{-- Layer 11: Orange Accent Line at Bottom --}}
        <div class="absolute z-20 rounded-full"
             style="left: 13.5%; bottom: 4.8%; width: 55%; height: 3.5px; background-color: #FF5E14 !important; box-shadow: 0 2px 8px rgba(255, 94, 20, 0.35) !important;">
        </div>

    </div>

    {{-- ==================== MOBILE SCREEN VERSION (< 768px) ==================== --}}
    <div class="w-full bg-[#FFFDFB] md:hidden p-4 space-y-4"
         x-data="{
            query: '{{ request('q') }}',
            results: [],
            loading: false,
            open: false,
            search() {
                if (this.query.trim().length < 2) {
                    this.results = [];
                    this.open = false;
                    return;
                }
                this.loading = true;
                fetch('{{ route('api.search-posts') }}?q=' + encodeURIComponent(this.query))
                    .then(res => res.json())
                    .then(data => {
                        this.results = data.results || [];
                        this.open = true;
                        this.loading = false;
                    })
                    .catch(() => { this.loading = false; });
            }
         }" @click.outside="open = false">
        
        <!-- Mobile Header Artwork Preview -->
        <div class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden bg-gradient-to-br from-orange-100/50 via-white to-orange-50 p-2 border border-orange-200/60 shadow-sm">
            <img src="{{ asset('images/blog/desk_artwork.png') }}" alt="Bàn làm việc sáng tạo" class="w-full h-full object-contain">
        </div>

        <!-- Mobile Badge -->
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full"
             style="background-color: #FFF0EB !important; border: 1.5px solid #FFD2C0 !important;">
            <span class="w-2 h-2 rounded-full shrink-0" style="background-color: #FF5E14 !important;"></span>
            <span class="font-mono text-[10px] font-bold uppercase tracking-wider" style="color: #FF5E14 !important;">EDITORIAL &amp; INSIGHTS HUB</span>
        </div>

        <!-- Mobile Title -->
        <h1 class="font-headline text-2xl font-black text-[#1e293b] leading-tight">
            Tạp Chí <span style="color: #FF5E14 !important;" class="underline decoration-[#FF5E14]/40 decoration-wavy">Truyền Thông</span><br>
            &amp; Công Nghệ Số
        </h1>

        <!-- Mobile Description -->
        <p class="font-body text-xs text-[#475569] leading-relaxed">
            Kho tàng {{ $categories->sum('posts_count') > 0 ? $categories->sum('posts_count') . '+' : '480+' }} bài viết phân tích xu hướng thị trường, cẩm nang sản xuất phim TVC, kiến thức giải pháp phần mềm và case study thực chiến.
        </p>

        <!-- Mobile 3 Features Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 pt-1">
            <div class="flex items-center gap-2.5 p-2 rounded-xl bg-white border border-slate-200/80 shadow-2xs">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                     style="background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; box-shadow: 0 3px 8px rgba(255, 94, 20, 0.3) !important;">
                    <span class="material-symbols-outlined text-[18px]" style="color: #FFFFFF !important;">article</span>
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-headline text-xs font-bold text-[#1e293b]">Kiến thức chuyên sâu</span>
                    <span class="font-body text-[10px] text-slate-500">Từ thực tiễn, có giá trị</span>
                </div>
            </div>

            <div class="flex items-center gap-2.5 p-2 rounded-xl bg-white border border-slate-200/80 shadow-2xs">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                     style="background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; box-shadow: 0 3px 8px rgba(255, 94, 20, 0.3) !important;">
                    <span class="material-symbols-outlined text-[18px]" style="color: #FFFFFF !important;">lightbulb</span>
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-headline text-xs font-bold text-[#1e293b]">Cập nhật liên tục</span>
                    <span class="font-body text-[10px] text-slate-500">Bắt kịp xu hướng mới</span>
                </div>
            </div>

            <div class="flex items-center gap-2.5 p-2 rounded-xl bg-white border border-slate-200/80 shadow-2xs">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                     style="background: linear-gradient(135deg, #FF5E14 0%, #FF6B1A 100%) !important; color: #FFFFFF !important; box-shadow: 0 3px 8px rgba(255, 94, 20, 0.3) !important;">
                    <span class="material-symbols-outlined text-[18px]" style="color: #FFFFFF !important;">groups</span>
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-headline text-xs font-bold text-[#1e293b]">Dành cho doanh nghiệp</span>
                    <span class="font-body text-[10px] text-slate-500">Hỗ trợ tăng trưởng bền vững</span>
                </div>
            </div>
        </div>

        <!-- Mobile Search Form -->
        <form action="{{ route('blog.index') }}" method="GET" class="relative pt-1">
            <div class="hero-search-container relative flex items-center justify-between bg-white rounded-full pl-4 pr-1.5 py-1"
                 style="background-color: #FFFFFF !important; border: 1.5px solid #E2E8F0 !important; border-radius: 9999px !important; box-shadow: 0 4px 12px rgba(0,0,0,0.06) !important;">
                <input type="text" name="q" x-model="query" @input.debounce.300ms="search()" 
                       placeholder="Tìm kiếm bài viết, tài liệu..." 
                       class="hero-search-input w-full font-medium"
                       style="border: none !important; outline: none !important; box-shadow: none !important; -webkit-box-shadow: none !important; background: transparent !important; background-color: transparent !important; color: #1e293b !important; font-size: 13px; padding: 2px 8px 2px 0 !important; margin: 0 !important;">
                <button type="submit" 
                        class="hero-search-btn w-8 h-8 rounded-full flex items-center justify-center shrink-0 shadow-sm"
                        style="background: linear-gradient(135deg, #FF5E14 0%, #FF772A 100%) !important; color: #FFFFFF !important; border: none !important; outline: none !important; border-radius: 9999px !important;">
                    <span class="material-symbols-outlined text-[16px]" style="color: #FFFFFF !important; line-height: 1;">search</span>
                </button>
            </div>
            
            <!-- Mobile Autocomplete -->
            <div x-show="open && results.length > 0" x-transition 
                 class="absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-xl border border-slate-200 z-50 overflow-hidden divide-y divide-slate-100 max-h-60 overflow-y-auto">
                <template x-for="item in results" :key="item.url">
                    <a :href="item.url" class="p-3 flex items-start gap-2.5 hover:bg-orange-50/60">
                        <span class="material-symbols-outlined text-[18px] mt-0.5" style="color: #FF5E14 !important;">article</span>
                        <div class="flex flex-col min-w-0 text-left">
                            <span class="font-headline text-xs font-bold text-navy-base line-clamp-1" x-text="item.title"></span>
                            <span class="text-[10px] font-semibold" style="color: #FF5E14 !important;" x-text="item.category"></span>
                        </div>
                    </a>
                </template>
            </div>
        </form>

        <!-- Mobile Category Scroll Row -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden pt-1">
            <a href="{{ route('blog.index') }}" 
               class="px-3.5 py-2 rounded-xl text-xs font-headline font-bold whitespace-nowrap"
               style="{{ !request('category') && !request('q') ? 'background: linear-gradient(135deg, #FF5E14 0%, #FF6E1C 100%) !important; color: #FFFFFF !important; box-shadow: 0 4px 12px rgba(255, 94, 20, 0.3) !important;' : 'background-color: #FFFFFF !important; border: 1px solid #E2E8F0 !important; color: #334155 !important;' }}">
                Tất cả ({{ $categories->sum('posts_count') > 0 ? $categories->sum('posts_count') . '+' : '480+' }})
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('blog.resolve', $cat->slug) }}" 
               class="px-3.5 py-2 rounded-xl text-xs font-headline font-bold whitespace-nowrap"
               style="{{ request('category') === $cat->slug ? 'background: linear-gradient(135deg, #FF5E14 0%, #FF6E1C 100%) !important; color: #FFFFFF !important; box-shadow: 0 4px 12px rgba(255, 94, 20, 0.3) !important;' : 'background-color: #FFFFFF !important; border: 1px solid #E2E8F0 !important; color: #334155 !important;' }}">
                {{ $cat->name }} ({{ $cat->posts_count }})
            </a>
            @endforeach
        </div>
    </div>

</section>

<!-- ==================== 2. MAIN BLOG CONTENT (MAX-W-7XL) ==================== -->
<div class="w-full bg-surface bg-dot-grid-subtle py-12 sm:py-16 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Featured Big Magazine Banner (Only on first page without search) -->
        @if($featuredPost && !request('q') && !request('page'))
        <div class="mb-14 rounded-3xl overflow-hidden bg-navy-base text-white border border-slate-700/80 shadow-[0_20px_50px_rgba(7,15,30,0.2)] grid grid-cols-1 lg:grid-cols-12 group">
            <div class="lg:col-span-7 relative h-72 sm:h-96 lg:h-auto overflow-hidden bg-black">
                @if($featuredPost->thumbnail)
                    <img src="{{ $featuredPost->thumbnail_url }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" onerror="this.onerror=null; this.src='/images/fallback-banner.svg';">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-navy-surface via-[#0a1b38] to-navy-base">
                        <span class="material-symbols-outlined text-6xl text-slate-600">movie_creation</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-navy-base via-transparent to-transparent lg:hidden"></div>
                <div class="absolute top-4 left-4">
                    <span class="px-3.5 py-1 rounded-full bg-primary/95 text-white font-mono text-xs font-bold tracking-wide shadow-md uppercase">
                        ★ Tiêu Điểm Biên Tập
                    </span>
                </div>
            </div>
            <div class="lg:col-span-5 p-8 lg:p-10 flex flex-col justify-between">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-3 text-xs font-mono text-slate-400">
                        <span class="text-amber-400 font-bold uppercase">{{ $featuredPost->category?->name ?? 'Tin tức' }}</span>
                        <span>•</span>
                        <span>{{ $featuredPost->published_at ? $featuredPost->published_at->format('d/m/Y') : '' }}</span>
                        <span>•</span>
                        <span>{{ $featuredPost->views }} views</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white group-hover:text-amber-300 transition-colors leading-tight">
                        <a href="{{ route('blog.resolve', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                    </h2>
                    <p class="font-body text-sm text-slate-300 line-clamp-3 leading-relaxed">
                        {{ $featuredPost->summary }}
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-white/10 flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400">Ban Biên Tập Truyền Thông Cửu Long Hub</span>
                    <a href="{{ route('blog.resolve', $featuredPost->slug) }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/10 hover:bg-primary text-white font-headline text-xs font-bold transition-all group-hover:translate-x-1">
                        <span>Đọc toàn văn</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Content Area: Left Posts Grid (8 cols) + Right Sidebar (4 cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Posts Grid (8 cols) -->
            <div class="lg:col-span-8 flex flex-col">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7 mb-10">
                    @forelse($posts as $post)
                    <article class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_8px_24px_rgba(7,15,30,0.04)] hover:shadow-xl hover:border-orange-300 transition-all duration-300 flex flex-col">
                        <a href="{{ route('blog.resolve', $post->slug) }}" class="block aspect-video bg-slate-100 relative overflow-hidden shrink-0">
                            @if($post->thumbnail)
                                <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" onerror="this.onerror=null; this.src='/images/fallback-banner.svg';">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                                    <span class="material-symbols-outlined text-4xl">feed</span>
                                </div>
                            @endif
                            @if($post->category)
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-navy-base/85 backdrop-blur-md text-white border border-white/10">
                                {{ $post->category->name }}
                            </span>
                            @endif
                        </a>
                        <div class="p-6 flex flex-col flex-1 justify-between gap-3">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400">
                                    <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }}</span>
                                    <span>•</span>
                                    <span class="flex items-center gap-0.5">
                                        <span class="material-symbols-outlined text-[13px]">visibility</span>
                                        {{ $post->views }}
                                    </span>
                                </div>
                                <h3 class="font-headline font-bold text-base text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('blog.resolve', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="font-body text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {{ $post->summary }}
                                </p>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('blog.resolve', $post->slug) }}" class="text-xs font-headline font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                                    <span>Khám phá</span>
                                    <span class="material-symbols-outlined text-[14px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </a>
                                <span class="text-[10px] font-mono text-slate-400">~3 phút đọc</span>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="sm:col-span-2 text-center py-16 bg-white rounded-3xl border border-slate-200">
                        <span class="material-symbols-outlined text-5xl text-slate-300 mb-2">search_off</span>
                        <p class="font-headline text-base font-bold text-navy-base">Không tìm thấy bài viết nào phù hợp.</p>
                        <p class="font-body text-xs text-slate-500 mt-1">Hãy thử tìm kiếm với từ khóa khác hoặc xóa bộ lọc.</p>
                        <a href="{{ route('blog.index') }}" class="mt-4 inline-flex items-center gap-1 px-4 py-2 rounded-full bg-primary text-white font-headline text-xs font-bold">Xem tất cả bài viết</a>
                    </div>
                    @endforelse
                </div>

                <!-- Custom Pagination -->
                <div class="mt-10 flex justify-center">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar (4 cols) Sticky Container -->
            <aside class="lg:col-span-4">
                <div class="sticky top-24 space-y-6">
                    
                    <!-- 1. Popular Posts Card (Bài Đọc Nhiều Nhất) -->
                    <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">local_fire_department</span>
                                <h3 class="font-headline text-sm sm:text-base font-extrabold text-navy-base uppercase tracking-wider">Bài Đọc Nhiều Nhất</h3>
                            </div>
                        </div>
                        <div class="flex flex-col divide-y divide-slate-100">
                            @foreach($popularPosts as $index => $pop)
                            <a href="{{ route('blog.resolve', $pop->slug) }}" class="py-2.5 flex items-start gap-3 group">
                                <span class="font-headline text-lg font-black {{ $index === 0 ? 'text-primary' : ($index === 1 ? 'text-accent-amber' : 'text-slate-300') }} leading-none w-6 shrink-0 mt-0.5">
                                    0{{ $index + 1 }}
                                </span>
                                <div class="flex flex-col min-w-0">
                                    <h4 class="font-headline text-xs font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                        {{ $pop->title }}
                                    </h4>
                                    <span class="text-[10px] font-mono text-slate-400 mt-0.5">{{ $pop->views }} lượt xem</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Categories Breakdown (Chuyên Mục Đọc) -->
                    <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3.5">
                        <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                            <span class="material-symbols-outlined text-primary text-[20px]">folder_open</span>
                            <h3 class="font-headline text-sm sm:text-base font-extrabold text-navy-base uppercase tracking-wider">Chuyên Mục Đọc</h3>
                        </div>
                        <div class="flex flex-col gap-1">
                            @foreach($categories as $cat)
                            <a href="{{ route('blog.resolve', $cat->slug) }}" class="flex items-center justify-between p-2 rounded-xl hover:bg-orange-50/60 transition-colors group">
                                <span class="font-headline text-xs font-semibold text-slate-700 group-hover:text-primary transition-colors">{{ $cat->name }}</span>
                                <span class="text-[11px] font-mono font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 group-hover:bg-primary group-hover:text-white transition-colors">{{ $cat->posts_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. Comprehensive Media Solutions Card (Giải Pháp Truyền Thông Toàn Diện Cho Doanh Nghiệp) -->
                    @include('blog.partials.sidebar_media_solutions')

                </div>
            </aside>
        </div>

    </div>
</div>
@endsection
