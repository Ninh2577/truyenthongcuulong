@extends('layouts.app')

@section('title', 'Dự Án Thực Tế & Giải Pháp Đã Triển Khai - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá các sản phẩm số và dự án truyền thông được thực hiện bởi Cửu Long. Giải pháp Web App, website doanh nghiệp và năng lực sản xuất media in-house.')
@section('canonical', route('projects.index'))

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Dự Án Thực Tế & Giải Pháp Đã Triển Khai",
  "provider": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "url": "https://truyenthongcuulong.com"
  },
  "description": "Khám phá các sản phẩm số và dự án truyền thông được thực hiện bởi Cửu Long."
}
</script>
@endpush

@section('content')
<div x-data="{
    videoModal: false,
    currentVideoUrl: '',
    openVideo(url) {
        let embed = url || '';
        if (embed.includes('watch?v=')) {
            embed = embed.replace('watch?v=', 'embed/') + '?autoplay=1&rel=0&modestbranding=1';
        } else if (embed.includes('youtu.be/')) {
            embed = embed.replace('youtu.be/', 'www.youtube.com/embed/') + '?autoplay=1&rel=0&modestbranding=1';
        }
        this.currentVideoUrl = embed;
        this.videoModal = true;
    }
}">
    <!-- Small Hero Section -->
    <section class="relative w-full overflow-hidden pt-28 pb-14 lg:pt-36 lg:pb-18 border-b border-slate-200/80 bg-surface-low bg-dot-grid-subtle">
        <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-amber-400/5 via-primary/5 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-[400px] h-[300px] rounded-full bg-gradient-to-tr from-sky-500/5 via-primary/5 to-transparent blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs font-headline text-slate-500 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-slate-400">/</span>
                <span class="text-navy-base font-bold" aria-current="page">Dự Án &amp; Case Studies</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
                <div class="max-w-3xl flex flex-col gap-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-50 text-sky-800 font-mono text-xs font-bold border border-sky-200/80 w-fit shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <span>CASE STUDIES &bull; PORTFOLIO PROOF</span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base leading-tight">
                        Dự án thực tế &amp; giải pháp đã triển khai
                    </h1>
                    <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed">
                        Khám phá các sản phẩm số và dự án truyền thông được thực hiện bởi Cửu Long. Mỗi dự án là một bài toán vận hành cụ thể được giải quyết bằng giải pháp công nghệ phù hợp và kết quả kiểm chứng.
                    </p>
                </div>

                <!-- Search Input Form -->
                <form action="{{ route('projects.index') }}" method="GET" class="w-full md:w-80 shrink-0">
                    @if(request('group'))
                        <input type="hidden" name="group" value="{{ request('group') }}">
                    @endif
                    <div class="relative flex items-center">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm tên dự án, khách hàng..." 
                            class="w-full pl-10 pr-4 py-3 rounded-2xl bg-white border border-slate-200 text-navy-base placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary text-xs shadow-2xs">
                        <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[18px]">search</span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Filter Bar & Projects Grid -->
    <section class="w-full bg-surface py-14 lg:py-20 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10 pb-4 border-b border-slate-200/80">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar text-xs font-headline">
                    <a href="{{ route('projects.index', ['q' => request('q')]) }}" 
                        class="px-5 py-2.5 rounded-full font-bold whitespace-nowrap transition-all {{ empty(request('group')) || request('group') === 'all' ? 'bg-navy-base text-white shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200 hover:border-slate-300' }}">
                        Tất Cả Dự Án ({{ $totalCount ?? $caseStudies->total() }})
                    </a>
                    <a href="{{ route('projects.index', ['group' => 'technology', 'q' => request('q')]) }}" 
                        class="px-5 py-2.5 rounded-full font-bold whitespace-nowrap transition-all {{ request('group') === 'technology' ? 'bg-navy-base text-white shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200 hover:border-slate-300' }}">
                        Phần Mềm &amp; Web App ({{ $techCount ?? 0 }})
                    </a>
                    <a href="{{ route('projects.index', ['group' => 'media', 'q' => request('q')]) }}" 
                        class="px-5 py-2.5 rounded-full font-bold whitespace-nowrap transition-all {{ request('group') === 'media' ? 'bg-navy-base text-white shadow-md' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200 hover:border-slate-300' }}">
                        Media &amp; Sản Xuất Nội Dung ({{ $mediaCount ?? 0 }})
                    </a>
                </div>

                @if(request('group') || request('q'))
                <a href="{{ route('projects.index') }}" class="text-xs font-mono font-bold text-primary hover:underline flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px]">refresh</span>
                    <span>Xóa bộ lọc</span>
                </a>
                @endif
            </div>

            <!-- Projects Grid (Showcase Layout) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($caseStudies as $project)
                @php
                    $isTech = ($project->group === 'technology');
                    $isClinicApp = ($project->slug === 'ung-dung-quan-ly-phong-kham');
                    $isClinicWeb = ($project->slug === 'website-phong-kham-da-khoa');
                    
                    $solutionTag = $isClinicApp ? 'Healthcare Web-App' : ($isClinicWeb ? 'Website Y Khoa' : 'Video TVC / Media');
                    $badgeBg = $isTech ? 'bg-sky-50 text-sky-700 border-sky-200' : 'bg-amber-50 text-amber-800 border-amber-200';
                @endphp

                <article class="rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-2xs hover:shadow-xl hover:border-primary/40 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Project Media Frame -->
                    <div class="h-64 w-full relative overflow-hidden bg-slate-900 flex items-center justify-center">
                        @php
                            $youtubeId = '';
                            if ($project->video_url && preg_match('/(?:youtube\.com\/(?:embed\/|watch\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $project->video_url, $matches)) {
                                $youtubeId = $matches[1];
                            }
                        @endphp
                        
                        @if($youtubeId)
                            <img src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90" 
                                 onerror="this.src='https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg'">
                        @elseif($project->slug === 'ung-dung-quan-ly-phong-kham')
                            <img src="{{ asset('images/projects/clinic-app-mockup.jpg') }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'">
                        @elseif($project->slug === 'website-phong-kham-da-khoa')
                            <img src="{{ asset('images/projects/clinic-website-wp.jpg') }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'">
                        @elseif($project->thumbnail)
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'">
                        @else
                            <img src="{{ asset('images/modern_tech_platform.jpg') }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover">
                        @endif

                        <!-- Video Play Trigger Button if Media -->
                        @if($project->video_url)
                        <button type="button" @click="openVideo('{{ $project->video_url }}')" 
                                class="absolute inset-0 m-auto w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/40 group-hover:scale-110 transition-transform cursor-pointer z-10"
                                aria-label="Xem video {{ $project->title }}">
                            <span class="material-symbols-outlined text-[24px] fill ml-0.5">play_arrow</span>
                        </button>
                        @endif

                        <!-- Top Client Badge -->
                        <div class="absolute top-3.5 left-3.5 pointer-events-none z-10">
                            <span class="px-3 py-1 rounded-full bg-slate-900/85 backdrop-blur-md text-amber-300 font-mono text-[11px] font-bold border border-white/10">
                                {{ $project->client_name ?: 'Khách hàng đối tác' }}
                            </span>
                        </div>

                        <!-- Year Badge -->
                        <div class="absolute bottom-3.5 right-3.5 pointer-events-none z-10">
                            <span class="px-2.5 py-0.5 rounded bg-black/70 backdrop-blur-md text-slate-300 font-mono text-[10px]">
                                {{ $project->year ?: '2024' }}
                            </span>
                        </div>
                    </div>

                    <!-- Project Info -->
                    <div class="p-6 flex flex-col gap-4 flex-1 justify-between">
                        <div class="space-y-2.5">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase border {{ $badgeBg }}">
                                    {{ $solutionTag }}
                                </span>
                            </div>

                            <h2 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                <a href="{{ route('projects.show', $project->slug) }}">
                                    {{ $project->title }}
                                </a>
                            </h2>

                            <p class="font-body text-xs text-slate-600 line-clamp-3 leading-relaxed">
                                {{ $project->summary ?: 'Dự án được lên kế hoạch và triển khai kỹ thuật bởi đội ngũ Truyền Thông Cửu Long.' }}
                            </p>
                        </div>

                        <!-- Verified Technical Tags from meta_data -->
                        @php
                            $metaData = $project->meta_data ?? [];
                            $metrics = array_slice($metaData['metrics'] ?? [], 0, 2);
                        @endphp

                        @if(!empty($metrics))
                        <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100 font-mono text-center">
                            @foreach($metrics as $metric)
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100/80">
                                <span class="block text-[11px] font-bold text-navy-base">{{ $metric['value'] }}</span>
                                <span class="block text-[10px] text-slate-500 mt-0.5">{{ $metric['label'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-headline font-bold text-primary">
                            <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center gap-1.5 hover:underline group-hover:translate-x-0.5 transition-transform">
                                <span>Xem chi tiết Case Study</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-200">
                    <span class="material-symbols-outlined text-5xl text-slate-300 mb-2">folder_off</span>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Không tìm thấy dự án phù hợp</h3>
                    <p class="font-body text-xs text-slate-500 mt-1">Vui lòng thử tìm kiếm với từ khóa khác hoặc xóa bộ lọc.</p>
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

    <!-- Final Consultation Banner -->
    <section class="w-full bg-surface-low py-14 lg:py-18 border-b border-slate-200/80">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-10 rounded-3xl bg-navy-base text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                <div class="space-y-2 max-w-xl">
                    <span class="text-amber-400 font-mono text-xs font-bold uppercase tracking-wider block">
                        TƯ VẤN TRIỂN KHAI DỰ ÁN
                    </span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white">
                        Bạn Có Một Bài Toán Cần Giải Quyết?
                    </h2>
                    <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                        Hãy trao đổi với chúng tôi về yêu cầu phần mềm hoặc nhu cầu xây dựng website để nhận phân tích giải pháp và ước toán chi phí.
                    </p>
                </div>
                <a href="{{ route('contact') }}" 
                   class="btn-primary-cta px-8 py-3.5 rounded-full bg-primary hover:bg-orange-600 text-white font-headline text-xs font-bold shadow-md hover:scale-105 transition-all shrink-0">
                    <span>Bắt đầu dự án</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Video Modal Lightbox -->
    <div x-show="videoModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4" style="display: none;">
        <div @click.away="videoModal = false; currentVideoUrl = ''" class="relative w-full max-w-4xl bg-black rounded-3xl overflow-hidden border border-white/20 shadow-2xl">
            <button type="button" @click="videoModal = false; currentVideoUrl = ''" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-white/20 text-white hover:bg-white/40 flex items-center justify-center cursor-pointer transition-colors" aria-label="Đóng video">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="relative w-full" style="padding-bottom: 56.25%;">
                <iframe :src="currentVideoUrl" class="absolute inset-0 w-full h-full" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>

</div>
@endsection
