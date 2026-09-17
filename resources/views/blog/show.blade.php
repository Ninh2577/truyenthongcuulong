@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' - Truyền Thông Cửu Long')
@section('meta_description', $post->meta_description ?: $post->summary)
@section('og_image', $post->thumbnail ? $post->thumbnail_url : 'https://lh3.googleusercontent.com/aida/AEtjO1XFwX4HiQFmIiEoAWVzpyEesCWg-s3cW3_OywD-F4P2K6Ihv0FahvOINcwcDs5UYQ_y59TDDy5L5oB6SJndgCTfG4ajjq19W5C55BJfgOAAsK0ncT6ENswBz7W0Cujm6FKLHyDupQNpHhHONPunFiGdBNNQBaPpLYn4RZLhthR_kyx8X3ASC5uoOW2e19gEc8TdFIzSv9FVSu_QbQ4A3DkxVIY3Ucoocwzt26ZMrG5mc7CiH24dQCMDS5o')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ addslashes($post->title) }}",
  "image": [
    "{{ $post->thumbnail ? $post->thumbnail_url : 'https://truyenthongcuulong.com/logo.png' }}"
  ],
  "datePublished": "{{ $post->published_at ? $post->published_at->toAtomString() : now()->toAtomString() }}",
  "dateModified": "{{ $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString() }}",
  "author": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "logo": {
      "@type": "ImageObject",
      "url": "https://truyenthongcuulong.com/logo.png"
    }
  },
  "description": "{{ addslashes($post->summary) }}"
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Trang chủ",
    "item": "{{ route('home') }}"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "Tạp chí",
    "item": "{{ route('blog.index') }}"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "{{ addslashes($post->title) }}"
  }]
}
</script>
@endsection

@section('content')
<style>
    html {
        scroll-behavior: smooth;
    }
    .toc-link.active {
        color: #ea580c; /* text-orange-600 */
        font-weight: 800;
        border-left: 3px solid #ea580c;
        padding-left: 0.75rem;
        background: linear-gradient(90deg, rgba(255,237,213,0.5) 0%, rgba(255,237,213,0) 100%);
    }
    .toc-link {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
        padding-left: 0.75rem;
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        border-radius: 0 8px 8px 0;
    }
    .toc-link:hover {
        color: #ea580c;
        border-left-color: #fdba74; /* orange-300 */
        background: linear-gradient(90deg, rgba(255,237,213,0.3) 0%, rgba(255,237,213,0) 100%);
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<!-- Reading Progress Bar -->
<div id="reading-progress-bar" class="fixed top-[72px] left-0 h-1.5 bg-gradient-to-r from-orange-500 to-yellow-400 z-[60] transition-all w-0 shadow-sm"></div>

<div class="w-full bg-[#FAFAFA] pt-24 lg:pt-32 pb-20">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-[13px] font-medium text-slate-500 mb-8 lg:mb-12 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-orange-600 transition-colors">Trang chủ</a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-orange-600 transition-colors">Tạp chí</a>
            @if($post->category)
            <span class="text-slate-300">/</span>
            <a href="{{ route('blog.resolve', $post->category->slug) }}" class="hover:text-orange-600 transition-colors">{{ $post->category->name }}</a>
            @endif
        </nav>

        <div class="flex flex-col lg:grid lg:grid-cols-[1fr_320px] gap-12 lg:items-stretch relative">
            
            <!-- MAIN CONTENT COL -->
            <div class="w-full min-w-0">
                
                <!-- Hero Section Side-by-Side -->
                <div class="flex flex-col lg:grid lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-12">
                    <!-- Article Header -->
                    <header class="mb-0">
                        @php
                            $highlightedTitle = $post->title;
                            if (!empty($post->focus_keyword)) {
                                $keyword = preg_quote(trim($post->focus_keyword), '/');
                                $highlightedTitle = preg_replace('/(' . $keyword . ')/iu', '<span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-400">$1</span>', $post->title);
                            }
                        @endphp
                        <h1 class="font-headline text-[32px] sm:text-[40px] lg:text-[48px] font-black text-[#111827] leading-[1.15] tracking-tight mb-6">
                            {!! $highlightedTitle !!}
                        </h1>

                        <div class="flex flex-wrap items-center justify-between gap-4 py-6 border-y border-slate-200/80 text-[13px] text-slate-600">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-orange-500 to-orange-400 flex items-center justify-center text-white font-bold shadow-md">
                                    CL
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-[#111827] text-[14px]">Truyền Thông Cửu Long</span>
                                    <span class="font-mono text-slate-500">{{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }} · Đọc 5 phút</span>
                                </div>
                            </div>

                            <!-- Social Share -->
                            <div class="flex items-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                                    class="w-9 h-9 rounded-full bg-slate-100 hover:bg-[#1877f2] hover:text-white flex items-center justify-center text-slate-600 transition-all shadow-sm">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="https://zalo.me/share?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                                    class="w-9 h-9 rounded-full bg-slate-100 hover:bg-[#0068ff] hover:text-white flex items-center justify-center text-slate-600 font-bold transition-all shadow-sm text-xs">
                                    Z
                                </a>
                            </div>
                        </div>
                    </header>

                    <!-- Featured Thumbnail -->
                    @if($post->thumbnail)
                    <figure class="w-full aspect-[4/3] rounded-[24px] overflow-hidden shadow-xl border border-slate-200/50 bg-slate-100 relative group">
                        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60"></div>
                    </figure>
                    @endif
                </div>

                <!-- Summary / Lead -->
                @if($post->summary)
                <div class="p-6 sm:p-8 rounded-[24px] bg-orange-50/80 mb-12 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-orange-500"></div>
                    <p class="font-body text-lg sm:text-[20px] leading-[1.7] text-[#1f2937] font-medium italic relative z-10">
                        {{ $post->summary }}
                    </p>
                </div>
                @endif

                <!-- TOC Mobile (Accordion) -->
                @if(!empty($toc) && count($toc) > 1)
                <div class="block lg:hidden rounded-2xl p-5 mb-10 bg-white border border-slate-200 shadow-sm" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between cursor-pointer" @click="expanded = !expanded">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-[24px]">menu_book</span>
                            <h2 class="font-headline font-bold text-[#111827] text-lg">Nội dung chính</h2>
                        </div>
                        <span class="material-symbols-outlined text-slate-400 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <ul x-show="expanded" x-collapse class="mt-4 space-y-2 text-[15px] font-body border-t border-slate-100 pt-4">
                        @foreach($toc as $item)
                        <li class="{{ $item['level'] === 3 ? 'ml-4 text-slate-500' : 'font-semibold text-slate-800' }}">
                            <a href="#{{ $item['anchor'] }}" class="hover:text-orange-600 transition-colors block py-1" @click="expanded = false">
                                {{ $item['title'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Article Main Content Prose -->
                <article class="prose prose-lg prose-slate max-w-none w-full text-slate-700 leading-[1.8] font-body
                    prose-headings:font-headline prose-headings:font-bold prose-headings:text-[#111827] prose-headings:tracking-tight
                    prose-h2:text-[26px] prose-h2:sm:text-[30px] prose-h2:mt-14 prose-h2:mb-6 prose-h2:pb-4 prose-h2:border-b prose-h2:border-slate-200/80
                    prose-h3:text-[22px] prose-h3:sm:text-[24px] prose-h3:mt-10 prose-h3:mb-5
                    prose-p:mb-6
                    prose-a:text-orange-600 hover:prose-a:text-orange-700 prose-a:font-semibold prose-a:underline prose-a:underline-offset-4 prose-a:decoration-orange-300/50
                    prose-img:rounded-[20px] prose-img:shadow-lg prose-img:border prose-img:border-slate-200/50 prose-img:mx-auto prose-img:my-10 prose-img:w-full
                    prose-blockquote:border-l-4 prose-blockquote:border-orange-500 prose-blockquote:bg-orange-50/50 prose-blockquote:py-5 prose-blockquote:px-8 prose-blockquote:rounded-r-[20px] prose-blockquote:font-medium prose-blockquote:text-slate-700 prose-blockquote:text-[20px] prose-blockquote:leading-[1.7]
                    prose-ul:marker:text-orange-500 prose-ul:my-6 prose-ul:space-y-2
                    prose-ol:marker:text-orange-500 prose-ol:font-semibold prose-ol:my-6 prose-ol:space-y-2
                    [&>ul>li>strong]:text-[#111827] [&>ul>li>strong]:font-bold
                    prose-code:font-mono prose-code:text-orange-600 prose-code:bg-orange-50 prose-code:px-2 prose-code:py-1 prose-code:rounded-lg prose-code:text-[14px]">
                    {!! $post->content !!}
                </article>

                <div class="mt-16 text-center text-slate-400 italic">
                    --- Hết ---
                </div>

                <!-- Bottom Breadcrumb -->
                <nav class="flex items-center gap-2 text-[13px] font-medium text-slate-500 mt-10 p-5 bg-white border border-slate-200 rounded-[16px] shadow-sm flex-wrap">
                    <span class="material-symbols-outlined text-orange-500 text-[18px]">home</span>
                    <a href="{{ route('home') }}" class="hover:text-orange-600 transition-colors">Trang chủ</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('blog.index') }}" class="hover:text-orange-600 transition-colors">Tạp chí</a>
                    @if($post->category)
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('blog.resolve', $post->category->slug) }}" class="hover:text-orange-600 transition-colors">{{ $post->category->name }}</a>
                    @endif
                </nav>

                <!-- Consultation Box CTA -->
                <div class="mt-12 p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 rounded-full bg-white/20 blur-3xl pointer-events-none"></div>
                    <div class="flex flex-col gap-2 text-center sm:text-left relative z-10">
                        <h3 class="font-headline text-2xl font-bold text-white">Bạn cần Tư vấn chiến lược Truyền thông?</h3>
                        <p class="text-sm text-white/90">Đặt lịch trao đổi trực tiếp 1:1 với chuyên gia của Truyền Thông Cửu Long.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="px-8 py-3.5 rounded-full bg-white text-orange-600 hover:bg-orange-50 font-headline text-sm font-bold shadow-md hover:scale-105 transition-transform shrink-0 relative z-10 flex items-center gap-2">
                        Đăng Ký Ngay
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>

            </div>
            
            <!-- RIGHT SIDEBAR (TOC) -->
            @if(!empty($toc) && count($toc) > 1)
            <div class="hidden lg:block w-full">
                <!-- Sticky Container -->
                <div class="sticky top-32">
                    <div class="bg-white rounded-[24px] p-7 border border-slate-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        <h3 class="font-headline font-bold text-lg text-[#111827] mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-orange-500 rounded-full"></span>
                            Nội Dung Bài Viết
                        </h3>
                        <nav class="toc-container max-h-[calc(100vh-250px)] overflow-y-auto pr-3 custom-scrollbar">
                            <ul class="space-y-1.5 text-[14px] font-medium">
                                @foreach($toc as $item)
                                <li class="{{ $item['level'] === 3 ? 'ml-4' : 'mt-3 first:mt-0' }}">
                                    <a href="#{{ $item['anchor'] }}" class="toc-link block text-slate-500">
                                        {{ $item['title'] }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    
                    <!-- Small Ad / CTA in Sidebar -->
                    <a href="{{ route('projects.index') }}" class="mt-6 block bg-slate-900 rounded-[24px] p-6 text-white overflow-hidden relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-600/20 to-transparent group-hover:opacity-100 opacity-50 transition-opacity duration-500"></div>
                        <h4 class="font-headline font-bold text-xl relative z-10 mb-2">Hơn 900+ Doanh Nghiệp<br>Đã Đồng Hành</h4>
                        <p class="text-slate-400 text-xs relative z-10 mb-4">Xem các case study thành công của chúng tôi.</p>
                        <span class="inline-flex items-center text-xs font-bold text-orange-500 group-hover:text-orange-400 relative z-10 gap-1 transition-colors">Khám phá ngay <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span></span>
                    </a>

                    <!-- Bài Viết Mới Nhất / Nổi Bật Widget -->
                    @if(isset($popularPosts) && $popularPosts->count() > 0)
                    <div class="mt-6 bg-white rounded-[24px] p-6 border border-slate-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        <h3 class="font-headline font-bold text-lg text-[#111827] mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-orange-500 rounded-full"></span>
                            Bài Viết Nổi Bật
                        </h3>
                        <div class="flex flex-col gap-4">
                            @foreach($popularPosts as $popPost)
                            <a href="{{ route('blog.resolve', $popPost->slug) }}" class="group flex gap-3 items-center">
                                @if($popPost->thumbnail)
                                <div class="w-20 h-16 rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                    <img src="{{ $popPost->thumbnail_url }}" alt="{{ $popPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                @endif
                                <h4 class="font-headline font-bold text-[13px] text-[#111827] group-hover:text-orange-600 transition-colors line-clamp-3 leading-snug">
                                    {{ $popPost->title }}
                                </h4>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

        </div>

        <!-- Related Articles Grid -->
        @if($relatedPosts->count() > 0)
        <div class="mt-24 pt-16 border-t border-slate-200">
            <div class="flex items-center justify-between mb-10">
                <h3 class="font-headline font-black text-3xl sm:text-4xl text-[#111827] tracking-tight">Bài Viết Mới Nhất</h3>
                <a href="{{ route('blog.index') }}" class="hidden sm:flex px-5 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-sm font-bold text-slate-700 transition-colors items-center gap-2">
                    Xem tất cả
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedPosts as $rPost)
                <a href="{{ route('blog.resolve', $rPost->slug) }}" class="group block">
                    <div class="aspect-[4/3] rounded-[24px] bg-slate-100 overflow-hidden relative mb-4">
                        @if($rPost->thumbnail)
                        <img src="{{ $rPost->thumbnail_url }}" alt="{{ $rPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        @endif
                        <div class="absolute top-3 left-3 px-3 py-1 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold text-slate-800 uppercase tracking-widest shadow-sm">
                            {{ $rPost->category?->name ?? 'Tin tức' }}
                        </div>
                    </div>
                    <h4 class="font-headline font-bold text-[17px] text-[#111827] group-hover:text-orange-600 transition-colors line-clamp-2 leading-[1.4] mb-2">
                        {{ $rPost->title }}
                    </h4>
                    <p class="text-[13px] text-slate-500 font-mono">{{ $rPost->published_at ? $rPost->published_at->format('d/m/Y') : '' }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<!-- Back to top button -->
<button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 rounded-full bg-[#111827] text-white shadow-2xl flex items-center justify-center hover:bg-orange-500 hover:scale-110 transition-all duration-300 translate-y-20 opacity-0 z-[90]" aria-label="Lên đầu trang">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Reading Progress Bar
        const progressBar = document.getElementById('reading-progress-bar');
        const updateProgress = () => {
            const winScroll = window.pageYOffset || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            if (height > 0) {
                const scrolled = (winScroll / height) * 100;
                if (progressBar) progressBar.style.width = scrolled + '%';
            }
        };
        window.addEventListener('scroll', updateProgress, {passive: true});
        updateProgress();

        // 2. Scroll Spy for TOC
        const sections = Array.from(document.querySelectorAll('article h2[id], article h3[id]'));
        const navLinks = document.querySelectorAll('.toc-link');
        
        if (sections.length > 0 && navLinks.length > 0) {
            const observerOptions = {
                root: null,
                rootMargin: '-100px 0px -50% 0px',
                threshold: 0
            };

            const observerCallback = (entries) => {
                let currentIntersecting = null;
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        currentIntersecting = entry.target.getAttribute('id');
                    }
                });

                if (currentIntersecting) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${currentIntersecting}`) {
                            link.classList.add('active');
                        }
                    });
                }
            };

            const observer = new IntersectionObserver(observerCallback, observerOptions);
            sections.forEach(sec => observer.observe(sec));
        }

        // 3. Back to Top Button
        const bttBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                bttBtn.classList.remove('translate-y-20', 'opacity-0');
            } else {
                bttBtn.classList.add('translate-y-20', 'opacity-0');
            }
        }, {passive: true});

        bttBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection
