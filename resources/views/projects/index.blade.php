@extends('layouts.app')

@section('title', 'Dự Án & Case Studies Tiêu Biểu - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá các dự án sản xuất phim TVC 4K, phim tài liệu doanh nghiệp và hệ thống website đã triển khai thành công tại Truyền Thông Cửu Long.')

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Dự Án & Case Studies Tiêu Biểu",
  "provider": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "url": "https://truyenthongcuulong.com"
  },
  "description": "Khám phá các dự án sản xuất phim TVC 4K, phim tài liệu doanh nghiệp và hệ thống website đã triển khai thành công tại Truyền Thông Cửu Long."
}
</script>
@endpush

@section('content')
<div x-data="{
    videoModal: false,
    currentVideoUrl: '',
    openVideo(url) {
        let embed = url || 'https://www.youtube.com/embed/nGvVhO2kDo8?autoplay=1';
        if (embed.includes('watch?v=')) {
            embed = embed.replace('watch?v=', 'embed/') + '?autoplay=1';
        } else if (embed.includes('youtu.be/')) {
            embed = embed.replace('youtu.be/', 'www.youtube.com/embed/') + '?autoplay=1';
        }
        this.currentVideoUrl = embed;
        this.videoModal = true;
    }
}">
    <!-- Small Hero Section -->
    <section class="relative w-full overflow-hidden text-white pt-32 pb-14 lg:pt-36 lg:pb-20 border-b border-white/10 bg-dot-grid-dark" style="background-color: #080C16 !important;">
        <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-amber-400/15 via-primary/15 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-[400px] h-[300px] rounded-full bg-gradient-to-tr from-sky-500/10 via-primary/10 to-transparent blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs font-headline text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-white font-bold" aria-current="page">Dự Án &amp; Case Studies</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
                <div class="max-w-3xl flex flex-col gap-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-500/10 text-orange-400 font-mono text-xs font-bold border border-orange-500/30 w-fit backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <span>PROVEN TRACK RECORD &bull; 850+ DELIVERIES</span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Dự Án &amp; Chiến Dịch <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-400 to-amber-300">Tiêu Biểu</span>
                    </h1>
                    <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                        Khám phá kho case study thực chiến: Từ những thước phim TVC điện ảnh 4K giàu cảm xúc đến các nền tảng công nghệ chịu tải cao được kiến tạo bởi Truyền Thông Cửu Long.
                    </p>
                </div>

                <!-- Search Input Form -->
                <form action="{{ route('projects.index') }}" method="GET" class="w-full md:w-80 shrink-0">
                    @if(request('group'))
                        <input type="hidden" name="group" value="{{ request('group') }}">
                    @endif
                    <div class="relative flex items-center">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm tên dự án, khách hàng..." 
                            class="w-full pl-10 pr-4 py-3 rounded-2xl bg-white/10 border border-white/20 text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary text-xs shadow-xs backdrop-blur-sm">
                        <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[18px]">search</span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Filter Bar & Projects Grid -->
    <section class="w-full bg-surface bg-dot-grid-subtle py-16 lg:py-20 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10 pb-4 border-b border-slate-200">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar">
                    <a href="{{ route('projects.index', ['q' => request('q')]) }}" 
                        class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ empty(request('group')) || request('group') === 'all' ? 'bg-navy-base text-amber-400 shadow-md shadow-navy-base/20 border border-amber-400/30' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                        Tất Cả Dự Án ({{ $totalCount ?? $caseStudies->total() }})
                    </a>
                    <a href="{{ route('projects.index', ['group' => 'media', 'q' => request('q')]) }}" 
                        class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ request('group') === 'media' ? 'bg-navy-base text-amber-400 shadow-md shadow-navy-base/20 border border-amber-400/30' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                        Sản Xuất Điện Ảnh &bull; Media ({{ $mediaCount ?? 0 }})
                    </a>
                    <a href="{{ route('projects.index', ['group' => 'technology', 'q' => request('q')]) }}" 
                        class="px-5 py-2.5 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ request('group') === 'technology' ? 'bg-navy-base text-amber-400 shadow-md shadow-navy-base/20 border border-amber-400/30' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                        Nền Tảng Công Nghệ &bull; TechLab ({{ $techCount ?? 0 }})
                    </a>
                </div>

                @if(request('group') || request('q'))
                <a href="{{ route('projects.index') }}" class="text-xs font-mono font-bold text-primary hover:underline flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px]">refresh</span>
                    <span>Xóa bộ lọc</span>
                </a>
                @endif
            </div>

            <!-- Projects Grid (Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($caseStudies as $project)
                <div class="rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <!-- Project Media Frame -->
                    <div class="h-60 w-full relative overflow-hidden bg-navy-base">
                        @if($project->thumbnail)
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                        @else
                            <img src="https://images.unsplash.com/photo-1579783902614-a3fb3927b675?auto=format&fit=crop&w=800&q=80" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                        @endif

                        <!-- Video Play Trigger Button -->
                        @if($project->video_url)
                        <button type="button" @click="openVideo('{{ $project->video_url }}')" class="absolute inset-0 m-auto w-14 h-14 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/40 group-hover:scale-110 transition-transform cursor-pointer">
                            <span class="material-symbols-outlined text-[28px] fill ml-0.5">play_arrow</span>
                        </button>
                        @endif

                        <div class="absolute top-3.5 left-3.5">
                            <span class="px-3.5 py-1 rounded-full bg-navy-base/85 backdrop-blur-md text-amber-400 font-mono text-xs font-bold border border-amber-400/30">
                                {{ $project->client_name ?: 'Khách hàng đối tác' }}
                            </span>
                        </div>

                        <div class="absolute bottom-3.5 right-3.5">
                            <span class="px-3 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[11px]">
                                {{ $project->year ?: '2024 - 2025' }}
                            </span>
                        </div>
                    </div>

                    <!-- Project Info -->
                    <div class="p-6 flex flex-col gap-3 flex-1 justify-between">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase {{ $project->group === 'technology' ? 'bg-sky-100 text-sky-700' : 'bg-orange-100 text-primary' }}">
                                    {{ $project->group === 'technology' ? 'Hệ Thống Số' : 'Sản Xuất Media' }}
                                </span>
                            </div>
                            <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2">
                                {!! $project->title !!}
                            </h3>
                            <p class="font-body text-xs text-slate-600 line-clamp-3 leading-relaxed">
                                {{ $project->summary ?: 'Dự án được lên kế hoạch sản xuất và kiểm soát chất lượng bởi đội ngũ chuyên môn Truyền Thông Cửu Long.' }}
                            </p>
                        </div>

                        <!-- KPI Metrics (If present) -->
                        @if($project->views_metric || $project->conversion_metric)
                        <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100 text-center">
                            @if($project->views_metric)
                            <div class="p-2 rounded-xl bg-slate-50">
                                <span class="block font-headline text-sm font-extrabold text-primary">{{ $project->views_metric }}</span>
                                <span class="text-[10px] text-slate-500 font-medium">Lượt tiếp cận</span>
                            </div>
                            @endif
                            @if($project->conversion_metric)
                            <div class="p-2 rounded-xl bg-slate-50">
                                <span class="block font-headline text-sm font-extrabold text-emerald-600">{{ $project->conversion_metric }}</span>
                                <span class="text-[10px] text-slate-500 font-medium">Chuyển đổi</span>
                            </div>
                            @endif
                        </div>
                        @endif

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-primary">
                            <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center gap-1 hover:underline">
                                <span>Xem case study chi tiết</span>
                                <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-200">
                    <span class="material-symbols-outlined text-5xl text-slate-300 mb-2">folder_off</span>
                    <h4 class="font-headline text-lg font-bold text-navy-base">Không tìm thấy dự án phù hợp</h4>
                    <p class="font-body text-xs text-slate-500 mt-1">Vui lòng thử tìm kiếm với từ khóa khác hoặc xóa bộ lọc ngành.</p>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-primary mt-4 hover:underline">
                        <span>Quay lại tất cả dự án</span>
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Laravel Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $caseStudies->links() }}
            </div>

        </div>
    </section>

    <!-- Deep-Dive Showcase Section -->
    <section class="w-full bg-white bg-dot-grid-subtle py-16 lg:py-20 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-12 rounded-3xl text-white border border-slate-800/80 shadow-2xl flex flex-col gap-8 relative overflow-hidden" style="background-color: #080C16 !important;">
                <div class="absolute top-0 right-0 w-80 h-80 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-white/10 pb-6 relative z-10">
                    <div>
                        <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">CASE STUDY TIÊU BIỂU</span>
                        <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">
                            Sacom Nha Trang &bull; Khối Ngân Hàng Số Vươn Khơi
                        </h2>
                    </div>
                    <span class="px-3.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 font-mono text-xs font-bold border border-emerald-500/30 w-fit backdrop-blur-sm">
                        Sản Xuất Media 4K
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative z-10">
                    <div class="flex flex-col gap-2 p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="font-mono text-xs text-amber-400 font-bold">01. BỐI CẢNH</span>
                        <p class="text-xs text-slate-300 leading-relaxed">Sự kiện kích hoạt chiến lược khối ngân hàng số với hơn 500 cán bộ nhân viên tham dự tại vịnh Nha Trang.</p>
                    </div>
                    <div class="flex flex-col gap-2 p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="font-mono text-xs text-amber-400 font-bold">02. THÁCH THỨC</span>
                        <p class="text-xs text-slate-300 leading-relaxed">Tác nghiệp trên biển đảo với cường độ gió lớn, lịch trình liên tục 48 giờ không gián đoạn.</p>
                    </div>
                    <div class="flex flex-col gap-2 p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="font-mono text-xs text-amber-400 font-bold">03. GIẢI PHÁP CLM</span>
                        <p class="text-xs text-slate-300 leading-relaxed">Điều động 4 máy quay Sony FX Cinema, hệ thống flycam chuyên dụng bắt trọn toàn bộ đại cảnh biển.</p>
                    </div>
                    <div class="flex flex-col gap-2 p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="font-mono text-xs text-amber-400 font-bold">04. KẾT QUẢ</span>
                        <p class="text-xs text-slate-300 leading-relaxed">Hoàn thành và công chiếu video tổng kết cùng ngày, nhận được lời khen ngợi từ toàn thể ban lãnh đạo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal Lightbox -->
    <div x-show="videoModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4" style="display: none;">
        <div @click.away="videoModal = false; currentVideoUrl = ''" class="relative w-full max-w-4xl bg-black rounded-3xl overflow-hidden border border-white/20 shadow-2xl">
            <button type="button" @click="videoModal = false; currentVideoUrl = ''" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-white/20 text-white hover:bg-white/40 flex items-center justify-center cursor-pointer transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="relative w-full" style="padding-bottom: 56.25%;">
                <iframe :src="currentVideoUrl" class="absolute inset-0 w-full h-full" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>

</div>
@endsection
