@extends('layouts.app')

@section('title', 'Tạp Chí Truyền Thông & Công Nghệ - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá kiến thức chuyên sâu về Sản xuất TVC điện ảnh, Thiết kế Web/App chịu tải cao, Chiến lược Digital Marketing và Thư viện tài nguyên tải về.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 pb-8 border-b border-slate-200">
            <div class="max-w-2xl flex flex-col gap-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 border border-orange-200 text-primary font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>EDITORIAL &amp; INSIGHTS HUB</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    Tạp Chí <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-accent-coral">Truyền Thông</span> &amp; Công Nghệ Số
                </h1>
                <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                    Kho tàng 480+ bài viết phân tích xu hướng thị trường, cẩm nang sản xuất phim TVC, kiến trúc giải pháp phần mềm và case study thực chiến.
                </p>
            </div>

            <!-- Live Search Bar -->
            <div class="w-full md:w-80 relative" x-data="{
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
                <form action="{{ route('blog.index') }}" method="GET">
                    <div class="relative flex items-center">
                        <input type="text" name="q" x-model="query" @input.debounce.300ms="search()" placeholder="Tìm kiếm bài viết, tài liệu..." 
                            class="w-full pl-10 pr-10 py-3 rounded-2xl bg-white border border-slate-300 text-navy-base placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm shadow-xs transition-all">
                        <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[20px] pointer-events-none">search</span>
                        <div x-show="loading" class="absolute right-3">
                            <span class="inline-block w-4 h-4 border-2 border-primary border-t-transparent rounded-full animate-spin"></span>
                        </div>
                    </div>
                </form>

                <!-- Instant Autocomplete Dropdown -->
                <div x-show="open && results.length > 0" x-transition 
                    class="absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-xl border border-slate-200 z-50 overflow-hidden divide-y divide-slate-100 max-h-96 overflow-y-auto">
                    <template x-for="item in results" :key="item.url">
                        <a :href="item.url" class="p-3.5 flex items-start gap-3 hover:bg-orange-50/50 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">article</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-headline text-xs font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-1" x-text="item.title"></span>
                                <div class="flex items-center gap-2 text-[10px] font-mono text-slate-400 mt-0.5">
                                    <span class="text-primary font-semibold" x-text="item.category"></span>
                                    <span>•</span>
                                    <span x-text="item.date"></span>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>
            </div>
        </div>

        <!-- 3+2 Pillar Tabs Filter -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-10 no-scrollbar">
            <a href="{{ route('blog.index') }}" 
                class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ empty($currentPillar) ? 'bg-primary text-white shadow-md shadow-orange-500/30' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200 hover:border-slate-300' }}">
                Tất cả (488)
            </a>
            <a href="{{ route('blog.index', ['pillar' => 'studio']) }}" 
                class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all flex items-center gap-1.5 {{ $currentPillar === 'studio' ? 'bg-navy-base text-amber-400 border border-amber-400/40 shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                <span class="material-symbols-outlined text-[16px] text-primary">movie</span>
                <span>Studio &amp; Media (146)</span>
            </a>
            <a href="{{ route('blog.index', ['pillar' => 'tech']) }}" 
                class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all flex items-center gap-1.5 {{ $currentPillar === 'tech' ? 'bg-navy-base text-sky-400 border border-sky-400/40 shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                <span class="material-symbols-outlined text-[16px] text-sky-500">code</span>
                <span>Tech Lab &amp; Web (92)</span>
            </a>
            <a href="{{ route('blog.index', ['pillar' => 'agency']) }}" 
                class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all flex items-center gap-1.5 {{ $currentPillar === 'agency' ? 'bg-navy-base text-rose-400 border border-rose-400/40 shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                <span class="material-symbols-outlined text-[16px] text-accent-coral">campaign</span>
                <span>Marketing &amp; Ads (192)</span>
            </a>
            <a href="{{ route('blog.index', ['pillar' => 'resource']) }}" 
                class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all flex items-center gap-1.5 {{ $currentPillar === 'resource' ? 'bg-navy-base text-emerald-400 border border-emerald-400/40 shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                <span class="material-symbols-outlined text-[16px] text-emerald-500">download</span>
                <span>Tài Nguyên Tải Về (52)</span>
            </a>
            <a href="{{ route('blog.index', ['pillar' => 'corporate']) }}" 
                class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all flex items-center gap-1.5 {{ $currentPillar === 'corporate' ? 'bg-navy-base text-purple-400 border border-purple-400/40 shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                <span class="material-symbols-outlined text-[16px] text-purple-500">corporate_fare</span>
                <span>Tuyển Dụng &amp; CLM (6)</span>
            </a>
        </div>

        <!-- Featured Big Magazine Banner (Only on first page without search) -->
        @if($featuredPost && !request('q') && !request('page'))
        <div class="mb-14 rounded-3xl overflow-hidden bg-navy-base text-white border border-slate-700/80 shadow-[0_20px_50px_rgba(7,15,30,0.2)] grid grid-cols-1 lg:grid-cols-12 group">
            <div class="lg:col-span-7 relative h-72 sm:h-96 lg:h-auto overflow-hidden bg-black">
                @if($featuredPost->thumbnail)
                    <img src="{{ asset('storage/' . $featuredPost->thumbnail) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90">
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
                        <a href="{{ route('blog.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                    </h2>
                    <p class="font-body text-sm text-slate-300 line-clamp-3 leading-relaxed">
                        {{ $featuredPost->summary }}
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-white/10 flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400">Ban Biên Tập Truyền Thông Cửu Long Hub</span>
                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/10 hover:bg-primary text-white font-headline text-xs font-bold transition-all group-hover:translate-x-1">
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
                        <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video bg-slate-100 relative overflow-hidden shrink-0">
                            @if($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
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
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="font-body text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {{ $post->summary }}
                                </p>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-xs font-headline font-bold text-primary hover:text-primary-hover flex items-center gap-1">
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

            <!-- Sidebar (4 cols) -->
            <div class="lg:col-span-4 flex flex-col gap-8">
                
                <!-- Popular Posts Card -->
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex flex-col gap-5">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">local_fire_department</span>
                            <h3 class="font-headline text-base font-extrabold text-navy-base uppercase tracking-wider">Bài Đọc Nhiều Nhất</h3>
                        </div>
                    </div>
                    <div class="flex flex-col divide-y divide-slate-100">
                        @foreach($popularPosts as $index => $pop)
                        <a href="{{ route('blog.show', $pop->slug) }}" class="py-3 flex items-start gap-3.5 group">
                            <span class="font-headline text-xl font-black {{ $index === 0 ? 'text-primary' : ($index === 1 ? 'text-accent-amber' : 'text-slate-300') }} leading-none w-6 shrink-0">
                                0{{ $index + 1 }}
                            </span>
                            <div class="flex flex-col min-w-0">
                                <h4 class="font-headline text-xs font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                    {{ $pop->title }}
                                </h4>
                                <span class="text-[10px] font-mono text-slate-400 mt-1">{{ $pop->views }} lượt xem</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Categories Breakdown -->
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex flex-col gap-4">
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="material-symbols-outlined text-primary text-[20px]">folder_open</span>
                        <h3 class="font-headline text-base font-extrabold text-navy-base uppercase tracking-wider">Chuyên Mục Đọc</h3>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        @foreach($categories as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-orange-50/60 transition-colors group">
                            <span class="font-headline text-xs font-semibold text-slate-700 group-hover:text-primary transition-colors">{{ $cat->name }}</span>
                            <span class="text-[11px] font-mono font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 group-hover:bg-primary group-hover:text-white transition-colors">{{ $cat->posts_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Newsletter / Consultation Mini Box -->
                <div class="p-7 rounded-3xl bg-gradient-to-br from-navy-base to-[#0a1c38] text-white border border-white/10 shadow-lg flex flex-col gap-4 relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-36 h-36 rounded-full bg-primary/20 blur-2xl pointer-events-none"></div>
                    <span class="font-mono text-[10px] text-accent-amber font-bold tracking-widest uppercase">CLM CONSULTING</span>
                    <h4 class="font-headline text-lg font-bold text-white leading-tight">
                        Cần Tư Vấn Chiến Lược TVC &amp; Phần Mềm Doanh Nghiệp?
                    </h4>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Chuyên gia Truyền Thông Cửu Long trực tiếp khảo sát và lập đề xuất giải pháp sản xuất - công nghệ riêng cho bạn.
                    </p>
                    <a href="{{ route('contact') }}" class="mt-2 inline-flex items-center justify-center gap-2 py-3 px-5 rounded-full bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold shadow-md hover:scale-[1.02] transition-transform">
                        <span>Liên hệ tư vấn ngay</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
