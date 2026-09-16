@extends('layouts.app')

@section('title', 'Kho Giao Diện Website Đa Ngành Chuẩn SEO - Truyền Thông Cửu Long TechLab')
@section('meta_description', 'Khám phá 39+ mẫu giao diện website chuẩn SEO, tương thích mọi thiết bị di động, điểm PageSpeed 98/100, sẵn sàng triển khai vận hành trong 48 giờ.')

@section('content')
<div class="w-full selection:bg-amber-500 selection:text-slate-900" x-data="{
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

    <!-- SECTION 1: SMALL HERO (NỀN SÁNG: Surface Low) -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80 overflow-hidden">
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-1/4 w-96 h-96 bg-sky-500/10 blur-3xl pointer-events-none"></div>

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
                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-navy-base mb-4">
                        Kho Giao Diện Website <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber">Đa Ngành Chuẩn SEO</span>
                    </h1>
                    <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                        Thư viện hơn 39+ mẫu giao diện website bản quyền hiện đại, kiến trúc clean-code tối ưu Core Web Vitals 98+, tích hợp đầy đủ công cụ chuyển đổi và sẵn sàng bàn giao vận hành trong 48 giờ.
                    </p>
                </div>

                <!-- Search Input -->
                <form action="{{ route('templates.index') }}" method="GET" class="w-full md:w-80 shrink-0">
                    @if(request('industry'))
                        <input type="hidden" name="industry" value="{{ request('industry') }}">
                    @endif
                    <div class="relative flex items-center group">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm tên hoặc mã mẫu web..." 
                            class="w-full pl-10 pr-4 py-3 rounded-2xl bg-white border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 text-xs shadow-sm hover:shadow-md focus:shadow-md transition-all">
                        <span class="material-symbols-outlined absolute left-3 text-slate-400 group-focus-within:text-amber-500 transition-colors text-[18px]">search</span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- SECTION 2: 13 INDUSTRY FILTER PILLS (NỀN SÁNG) -->
    <section class="py-6 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between gap-4 mb-3">
                <span class="font-mono text-xs font-bold text-slate-600 uppercase tracking-wider">LỌC THEO NGÀNH NGHỀ ({{ $industries->count() }} NHÓM NGÀNH):</span>
                @if($selectedIndustry || request('q'))
                <a href="{{ route('templates.index') }}" class="text-xs font-mono font-bold text-amber-600 hover:underline flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">refresh</span>
                    <span>Xóa bộ lọc</span>
                </a>
                @endif
            </div>

            <div class="flex items-center gap-2 overflow-x-auto pb-4 no-scrollbar scroll-smooth snap-x">
                <a href="{{ route('templates.index') }}" 
                    class="snap-start px-4 py-2 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all duration-300 {{ empty($selectedIndustry) ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/25' : 'bg-transparent text-slate-600 hover:text-amber-600 hover:border-amber-400/50 border border-slate-200 shadow-sm' }}">
                    Tất cả ngành nghề ({{ $templates->total() }})
                </a>
                @foreach($industries as $ind)
                <a href="{{ route('templates.index', ['industry' => $ind->slug]) }}" 
                    class="snap-start px-4 py-2 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all duration-300 {{ $selectedIndustry === $ind->slug ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/25' : 'bg-transparent text-slate-600 hover:text-amber-600 hover:border-amber-400/50 border border-slate-200 shadow-sm' }}">
                    {{ $ind->name }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 3: TEMPLATES GRID (NỀN SÁNG) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($templates as $item)
                @php
                    // Hỗ trợ cả URL đầy đủ (import WordPress cũ) và path tương đối (local storage)
                    $thumbSrc = null;
                    if ($item->thumbnail) {
                        $thumbSrc = \Str::startsWith($item->thumbnail, 'http')
                            ? $item->thumbnail
                            : asset('storage/' . $item->thumbnail);
                    }
                    $previewSrc = $thumbSrc ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                @endphp
                <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200 hover:border-amber-400/50 shadow-sm hover:shadow-2xl hover:shadow-amber-500/10 hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between relative">
                    
                    <!-- 48H DEPLOY BADGE -->
                    <div class="absolute top-4 right-4 z-10 flex items-center gap-1 bg-amber-500 text-white px-2.5 py-1 rounded-lg shadow-lg font-headline text-[9px] sm:text-[10px] font-bold tracking-wider">
                        <span class="material-symbols-outlined text-[12px] sm:text-[14px]">schedule</span>
                        48H DEPLOY
                    </div>

                    <div>
                        <!-- Browser Bezel Frame -->
                        <div class="w-full bg-slate-50 px-4 py-2.5 flex items-center gap-1.5 border-b border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
                            <div class="w-2.5 h-2.5 rounded-full bg-rose-400 shadow-sm"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-amber-400 shadow-sm"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-sm"></div>
                            <span class="ml-2 text-[9px] font-mono text-slate-400 truncate max-w-[120px]">{{ $item->slug }}.preview</span>
                        </div>

                        <!-- Thumbnail Preview Area -->
                        <div class="aspect-[4/3] sm:aspect-video w-full relative overflow-hidden bg-slate-50 group/img">
                            @if($thumbSrc)
                                <img src="{{ $thumbSrc }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-700" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 text-slate-300 p-6 text-center">
                                    <span class="material-symbols-outlined text-4xl mb-2">image_not_supported</span>
                                </div>
                            @endif

                            <!-- Quick Action Overlay -->
                            <div class="absolute inset-0 bg-navy-base/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm z-20">
                                <button type="button" @click.prevent="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $previewSrc }}')" 
                                    class="px-5 py-2.5 rounded-full bg-amber-500 hover:bg-amber-400 text-white font-headline text-xs font-bold shadow-[0_4px_14px_rgba(245,158,11,0.4)] flex items-center gap-2 transition-transform hover:scale-105">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    <span>Xem Demo Nhanh</span>
                                </button>
                            </div>
                        </div>

                        <!-- Card Details -->
                        <div class="p-5 sm:p-6 flex flex-col gap-3">
                            <div class="flex items-center gap-2 flex-wrap relative z-30">
                                <span class="text-[9px] font-mono font-bold text-slate-500 uppercase tracking-wider bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                    {{ $item->category ? $item->category->name : 'Web Architecture' }}
                                </span>
                                <span class="text-[9px] font-mono text-emerald-600 font-bold bg-emerald-50 border border-emerald-200/60 px-2 py-0.5 rounded flex items-center gap-0.5">
                                    <span class="material-symbols-outlined text-[12px]">bolt</span> Core Vitals 98+
                                </span>
                            </div>

                            <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-tight">
                                <a href="{{ route('blog.resolve', $item->slug) }}" class="focus:outline-none before:absolute before:inset-0 before:z-10">{{ $item->title }}</a>
                            </h3>

                            <p class="font-body text-xs sm:text-sm text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $item->summary ?: 'Giao diện thiết kế độc quyền, tối ưu điểm SEO & tốc độ tải trang, mang lại trải nghiệm khách hàng vượt trội.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="px-5 sm:px-6 mb-6 sm:mb-8 mt-auto relative z-30 flex flex-wrap items-center justify-between gap-3 pt-2">
                        <button type="button" @click.prevent="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $previewSrc }}')" 
                            class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-transparent border border-slate-200 text-slate-600 font-headline text-xs font-bold hover:bg-slate-50 hover:text-navy-base hover:border-slate-300 transition-all flex-1 sm:flex-none">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            <span>Xem Chi Tiết</span>
                        </button>

                        <a href="{{ route('contact', ['service' => 'Template: ' . $item->title]) }}" 
                            class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-headline text-xs font-bold shadow-md shadow-amber-500/20 hover:shadow-lg hover:shadow-amber-500/40 transition-all group/btn flex-1 sm:flex-none">
                            <span>Chọn Mẫu Này</span>
                            <span class="material-symbols-outlined text-[14px] group-hover/btn:translate-x-0.5 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-20 bg-white rounded-3xl border border-slate-200">
                    <span class="material-symbols-outlined text-6xl text-slate-400 mb-3">developer_board_off</span>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Không tìm thấy mẫu giao diện phù hợp</h3>
                    <p class="font-body text-xs text-slate-500 mt-1">Vui lòng chọn nhóm ngành khác hoặc gửi yêu cầu thiết kế bản vẽ độc quyền theo yêu cầu.</p>
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

    <!-- SECTION 4: 48-HOUR DEPLOYMENT TIMELINE (NỀN SÁNG) -->
    <section class="relative py-12 lg:py-16 bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80 overflow-hidden">
        <!-- Ambient Glow -->
        <div class="absolute -top-24 right-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-10 w-96 h-96 rounded-full bg-sky-500/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-primary uppercase">TIẾN ĐỘ THẦN TỐC</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base mt-1">Quy Trình Triển Khai Website Trong 48 Giờ</h2>
            </div>

            <div class="relative">
                <!-- Connector Line (Desktop) -->
                <div class="hidden lg:block absolute top-0 left-[12%] right-[12%] h-1 bg-gradient-to-r from-amber-200 via-amber-400 to-amber-200 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 relative z-10 pt-4 lg:pt-0">
                    <div class="group p-6 lg:pt-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:border-amber-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <!-- Milestone Dot -->
                        <div class="hidden lg:flex absolute top-0 left-8 -mt-[2px] w-4 h-4 rounded-full border-[3px] border-white bg-amber-500 shadow-sm group-hover:scale-150 transition-transform"></div>
                        <span class="font-mono text-[10px] font-bold text-amber-700 bg-amber-50 border border-amber-200/50 px-2.5 py-1 rounded-full w-fit">BƯỚC 01 • 04H ĐẦU</span>
                        <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base leading-tight">Chọn Mẫu &amp; Khóa Yêu Cầu</h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">Doanh nghiệp chọn mẫu giao diện ưng ý và xác định cấu trúc module chức năng cần giữ hoặc thêm mới.</p>
                    </div>

                    <div class="group p-6 lg:pt-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:border-amber-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <!-- Milestone Dot -->
                        <div class="hidden lg:flex absolute top-0 left-8 -mt-[2px] w-4 h-4 rounded-full border-[3px] border-white bg-amber-500 shadow-sm group-hover:scale-150 transition-transform"></div>
                        <span class="font-mono text-[10px] font-bold text-amber-700 bg-amber-50 border border-amber-200/50 px-2.5 py-1 rounded-full w-fit">BƯỚC 02 • 12H TIẾP</span>
                        <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base leading-tight">Cung Cấp Brand Identity</h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">Tiếp nhận file vector logo, bảng mã màu nhận diện thương hiệu, thông tin sản phẩm và nội dung trang chủ.</p>
                    </div>

                    <div class="group p-6 lg:pt-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:border-amber-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <!-- Milestone Dot -->
                        <div class="hidden lg:flex absolute top-0 left-8 -mt-[2px] w-4 h-4 rounded-full border-[3px] border-white bg-amber-500 shadow-sm group-hover:scale-150 transition-transform"></div>
                        <span class="font-mono text-[10px] font-bold text-amber-700 bg-amber-50 border border-amber-200/50 px-2.5 py-1 rounded-full w-fit">BƯỚC 03 • 24H TIẾP</span>
                        <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base leading-tight">Tùy Biến UI &amp; Nạp Dữ Liệu</h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">Kỹ sư TechLab triển khai mã nguồn trên hosting Staging, nạp dữ liệu thật và tối ưu tốc độ Core Web Vitals.</p>
                    </div>

                    <div class="group p-6 lg:pt-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col gap-3 relative hover:border-amber-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <!-- Milestone Dot -->
                        <div class="hidden lg:flex absolute top-0 left-8 -mt-[2px] w-4 h-4 rounded-full border-[3px] border-white bg-amber-500 shadow-sm group-hover:scale-150 transition-transform"></div>
                        <span class="font-mono text-[10px] font-bold text-amber-700 bg-amber-50 border border-amber-200/50 px-2.5 py-1 rounded-full w-fit">BƯỚC 04 • 48H HOÀN TẤT</span>
                        <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base leading-tight">Trỏ Domain &amp; Bàn Giao</h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">Kích hoạt SSL Cloudflare, trỏ tên miền chính thức, bàn giao tài khoản quản trị CMS và hướng dẫn sử dụng.</p>
                    </div>
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
