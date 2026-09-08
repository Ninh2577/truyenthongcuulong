@extends('layouts.app')

@section('title', 'Kho Giao Diện Website Đa Ngành Chuẩn SEO - Truyền Thông Cửu Long TechLab')
@section('meta_description', 'Khám phá 39+ mẫu giao diện website chuẩn SEO, tương thích mọi thiết bị di động, điểm PageSpeed 98/100, sẵn sàng triển khai vận hành trong 48 giờ.')

@section('content')
<div class="w-full bg-[#080C16] text-white selection:bg-amber-500 selection:text-slate-900" x-data="{
    previewModal: false,
    previewTitle: '',
    previewSlug: '',
    previewImg: '',
    previewDevice: 'desktop',

    openPreview(title, slug, img) {
        this.previewTitle = title;
        this.previewSlug = slug;
        this.previewImg = img;
        this.previewDevice = 'desktop';
        this.previewModal = true;
    }
}">

    <!-- SECTION 1: SMALL HERO -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 bg-[#0B132B]/60 border-b border-slate-800/80 overflow-hidden">
        <div class="absolute inset-0 bg-dot-grid-subtle opacity-20 pointer-events-none"></div>
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-semibold">Kho giao diện mẫu</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold mb-4">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>TECHLAB • TEMPLATE SHOWCASE</span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white mb-4">
                        Kho Giao Diện Website <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Đa Ngành Chuẩn SEO</span>
                    </h1>
                    <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                        Thư viện hơn 39+ mẫu giao diện website bản quyền hiện đại, kiến trúc clean-code tối ưu Core Web Vitals 98+, tích hợp đầy đủ công cụ chuyển đổi và sẵn sàng bàn giao vận hành trong 48 giờ.
                    </p>
                </div>

                <!-- Search Input -->
                <form action="{{ route('templates.index') }}" method="GET" class="w-full md:w-80 shrink-0">
                    @if(request('industry'))
                        <input type="hidden" name="industry" value="{{ request('industry') }}">
                    @endif
                    <div class="relative flex items-center">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm tên hoặc mã mẫu web..." 
                            class="w-full pl-10 pr-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-400 text-xs shadow-inner">
                        <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[18px]">search</span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- SECTION 2: 13 INDUSTRY FILTER PILLS -->
    <section class="py-6 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between gap-4 mb-3">
                <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">LỌC THEO NGÀNH NGHỀ ({{ $industries->count() }} NHÓM NGÀNH):</span>
                @if($selectedIndustry || request('q'))
                <a href="{{ route('templates.index') }}" class="text-xs font-mono font-bold text-amber-400 hover:underline flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">refresh</span>
                    <span>Xóa bộ lọc</span>
                </a>
                @endif
            </div>

            <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar">
                <a href="{{ route('templates.index') }}" 
                    class="px-4 py-2 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ empty($selectedIndustry) ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-400/20' : 'bg-[#0F172A] text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800' }}">
                    Tất cả ngành nghề ({{ $templates->total() }})
                </a>
                @foreach($industries as $ind)
                <a href="{{ route('templates.index', ['industry' => $ind->slug]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ $selectedIndustry === $ind->slug ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-400/20' : 'bg-[#0F172A] text-slate-300 hover:text-amber-400 hover:bg-slate-800 border border-slate-800' }}">
                    {{ $ind->name }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 3: TEMPLATES GRID -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($templates as $item)
                @php
                    $previewSrc = $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                @endphp
                <div class="group rounded-3xl overflow-hidden bg-[#0F172A] border border-slate-800 hover:border-amber-400/50 shadow-xl hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-300 flex flex-col justify-between">
                    
                    <div>
                        <!-- Browser Bezel Frame -->
                        <div class="w-full bg-[#0B132B] px-4 py-2.5 flex items-center justify-between border-b border-slate-800">
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                                <span class="ml-2 text-[10px] font-mono text-slate-400 truncate max-w-[140px]">{{ $item->slug }}.preview</span>
                            </div>
                            <span class="text-[9px] font-mono font-bold text-amber-400 bg-amber-400/10 px-2 py-0.5 rounded border border-amber-400/30">
                                48H DEPLOY
                            </span>
                        </div>

                        <!-- Thumbnail Preview Area -->
                        <div class="h-56 w-full relative overflow-hidden bg-slate-900 group/img">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-900 via-[#0F172A] to-slate-800 text-slate-300 p-6 text-center">
                                    <span class="material-symbols-outlined text-5xl mb-2 text-amber-400">web</span>
                                    <span class="font-headline text-xs font-bold">{{ $item->title }}</span>
                                </div>
                            @endif

                            <!-- Quick Action Overlay -->
                            <div class="absolute inset-0 bg-[#080C16]/75 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-xs">
                                <button type="button" @click="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $previewSrc }}')" 
                                    class="px-4 py-2 rounded-full bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-bold shadow-lg flex items-center gap-1.5 transition-transform hover:scale-105">
                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                    <span>Xem Demo Nhanh</span>
                                </button>
                            </div>
                        </div>

                        <!-- Card Details -->
                        <div class="p-6 flex flex-col gap-3">
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[10px] font-mono font-bold text-amber-400 bg-amber-400/10 border border-amber-400/20 px-2.5 py-0.5 rounded-full uppercase">
                                    {{ $item->category ? $item->category->name : 'Web Architecture' }}
                                </span>
                                <span class="text-[10px] font-mono text-emerald-400 font-bold bg-emerald-950/80 border border-emerald-500/30 px-2 py-0.5 rounded">
                                    ⚡ Core Vitals 98+
                                </span>
                            </div>

                            <h3 class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-2">
                                <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                            </h3>

                            <p class="font-body text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                {{ $item->summary ?: 'Giao diện thiết kế độc quyền tối ưu UI/UX đa thiết bị, chuẩn SEO và tích hợp hệ thống quản trị hiện đại.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="p-6 pt-0 flex items-center justify-between gap-3 border-t border-slate-800/80 mt-4">
                        <button type="button" @click="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $previewSrc }}')" 
                            class="inline-flex items-center gap-1 text-xs font-headline font-bold text-slate-400 hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            <span>Xem Demo Live</span>
                        </button>

                        <a href="{{ route('contact', ['service' => 'Template: ' . $item->title]) }}" 
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-bold shadow-md shadow-amber-400/20 transition-all">
                            <span>Chọn Mẫu Này</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>

                </div>
                @empty
                <div class="col-span-3 text-center py-20 bg-[#0F172A] rounded-3xl border border-slate-800">
                    <span class="material-symbols-outlined text-6xl text-slate-500 mb-3">developer_board_off</span>
                    <h3 class="font-headline text-lg font-bold text-white">Không tìm thấy mẫu giao diện phù hợp</h3>
                    <p class="font-body text-xs text-slate-400 mt-1">Vui lòng chọn nhóm ngành khác hoặc gửi yêu cầu thiết kế bản vẽ độc quyền theo yêu cầu.</p>
                    <a href="{{ route('templates.index') }}" class="mt-4 inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-amber-400 text-slate-950 font-headline text-xs font-bold hover:bg-amber-300 transition-all">
                        Xem tất cả 39+ mẫu giao diện
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $templates->links() }}
            </div>
        </div>
    </section>

    <!-- SECTION 4: 48-HOUR DEPLOYMENT TIMELINE -->
    <section class="py-12 lg:py-16 bg-[#0B132B]/50 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-400 uppercase">TIẾN ĐỘ THẦN TỐC</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">Quy Trình Triển Khai Website Trong 48 Giờ</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 relative">
                    <span class="font-mono text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-1 rounded-full w-fit">BƯỚC 01 • 04H ĐẦU</span>
                    <h3 class="font-headline text-base font-bold text-white">Chọn Mẫu &amp; Khóa Yêu Cầu</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Doanh nghiệp chọn mẫu giao diện ưng ý và xác định cấu trúc module chức năng cần giữ hoặc thêm mới.</p>
                </div>

                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 relative">
                    <span class="font-mono text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-1 rounded-full w-fit">BƯỚC 02 • 12H TIẾP</span>
                    <h3 class="font-headline text-base font-bold text-white">Cung Cấp Brand Identity</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Tiếp nhận file vector logo, bảng mã màu nhận diện thương hiệu, thông tin sản phẩm và nội dung trang chủ.</p>
                </div>

                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 relative">
                    <span class="font-mono text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-1 rounded-full w-fit">BƯỚC 03 • 24H TIẾP</span>
                    <h3 class="font-headline text-base font-bold text-white">Tùy Biến UI &amp; Nạp Dữ Liệu</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Kỹ sư TechLab triển khai mã nguồn trên hosting Staging, nạp dữ liệu thật và tối ưu tốc độ Core Web Vitals.</p>
                </div>

                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3 relative">
                    <span class="font-mono text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-1 rounded-full w-fit">BƯỚC 04 • 48H HOÀN TẤT</span>
                    <h3 class="font-headline text-base font-bold text-white">Trỏ Domain &amp; Bàn Giao</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Kích hoạt SSL Cloudflare, trỏ tên miền chính thức, bàn giao tài khoản quản trị CMS và hướng dẫn sử dụng.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- LIVE PREVIEW MODAL (ALPINE.JS) -->
    <div x-show="previewModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4 bg-black/85 backdrop-blur-md" style="display: none;">
        <div @click.outside="previewModal = false" class="w-full max-w-5xl h-[85vh] bg-[#0F172A] rounded-3xl border border-slate-700 shadow-2xl overflow-hidden flex flex-col">
            
            <!-- Modal Header Bezel -->
            <div class="h-14 px-6 bg-[#0B132B] border-b border-slate-800 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-rose-500 cursor-pointer" @click="previewModal = false"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                    </div>
                    <span class="text-xs font-mono font-bold text-white truncate max-w-xs sm:max-w-md" x-text="previewTitle"></span>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Responsive Switcher -->
                    <div class="hidden sm:flex items-center gap-1 bg-slate-900 p-1 rounded-xl border border-slate-800 text-xs">
                        <button type="button" @click="previewDevice = 'desktop'" :class="previewDevice === 'desktop' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded-lg">Desktop</button>
                        <button type="button" @click="previewDevice = 'tablet'" :class="previewDevice === 'tablet' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded-lg">Tablet</button>
                        <button type="button" @click="previewDevice = 'mobile'" :class="previewDevice === 'mobile' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded-lg">Mobile</button>
                    </div>

                    <a :href="'{{ route('contact') }}?service=' + encodeURIComponent('Template: ' + previewTitle)" 
                        class="px-3.5 py-1.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-bold transition-all flex items-center gap-1">
                        <span>Đặt Mẫu Này</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </a>

                    <button @click="previewModal = false" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-300 hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            </div>

            <!-- Modal Content Viewport -->
            <div class="flex-1 bg-slate-950 overflow-y-auto p-4 flex justify-center items-start">
                <div :class="{
                    'w-full max-w-full': previewDevice === 'desktop',
                    'w-[768px] border-x border-slate-800 shadow-2xl': previewDevice === 'tablet',
                    'w-[390px] border-x border-slate-800 shadow-2xl rounded-2xl overflow-hidden': previewDevice === 'mobile'
                }" class="transition-all duration-300 bg-white">
                    <img :src="previewImg" :alt="previewTitle" class="w-full h-auto object-top">
                </div>
            </div>

        </div>
    </div>

</div>

<!-- SCHEMA JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "Kho Giao Diện Mẫu Website Đa Ngành Chuẩn SEO - Truyền Thông Cửu Long",
    "description": "Thư viện 39+ mẫu giao diện website đa ngành nghề chuẩn SEO, tối ưu Core Web Vitals 98+, sẵn sàng triển khai trong 48 giờ.",
    "url": "{{ route('templates.index') }}",
    "provider": {
        "@type": "Organization",
        "name": "Truyền Thông Cửu Long TechLab",
        "url": "{{ url('/') }}"
    }
}
</script>
@endsection
