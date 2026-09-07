@extends('layouts.app')

@section('title', 'Dự Án & Showreel Tiêu Biểu - Cửu Long Media & Tech')
@section('meta_description', 'Khám phá các case study thành công và showreel tác phẩm do Cửu Long Media & Technology Hub trực tiếp sản xuất: TVC điện ảnh 4K, hệ thống Web/App và chiến dịch truyền thông bùng nổ.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60" x-data="{
    videoModal: false,
    currentVideoUrl: '',
    openVideo(url) {
        this.currentVideoUrl = url || 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1';
        this.videoModal = true;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-20">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto flex flex-col gap-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 border border-orange-300 text-primary font-mono text-xs font-bold mx-auto">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>SHOWREEL &amp; CASE STUDIES</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                Dự Án &amp; Chiến Dịch <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-accent-coral">Tiêu Biểu</span>
            </h1>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                Minh chứng thực tế cho năng lực kết hợp giữa nghệ thuật kể chuyện hình ảnh và hạ tầng kỹ thuật số của Cửu Long.
            </p>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @forelse($caseStudies as $project)
            <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_12px_36px_rgba(7,15,30,0.06)] hover:shadow-2xl transition-all duration-500 flex flex-col justify-between">
                
                <!-- Project Visual / Mockup Screen -->
                <div class="h-64 sm:h-80 w-full relative overflow-hidden bg-navy-base">
                    @if($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90">
                    @else
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhvlu1138YzJVrOShzutAvKGkz3j5nSQ6FSRRCOi-qYlq3I4Auibp8apXefm76bwHf-2zrBkZUHfaoXZoXnsMQ793B5GdY66hawqN0_YynY0pHC26dWpNngI9JSXG1yDBHN3WvepMEVpRCDQuLKVPCWllEmUCljDTfvmU_OHs9pqJgLfDmDXFO6gZ4aDGs6861rp3bLHuyOiamlRpq_9zpLsfmH2jfMGse10trwqZt17ok_MAJabJq" 
                            alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90">
                    @endif

                    <!-- Play Video Lightbox Button -->
                    <button type="button" @click="openVideo('{{ $project->video_url }}')" 
                        class="absolute inset-0 m-auto w-14 h-14 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-[0_0_30px_rgba(234,88,12,0.9)] ring-4 ring-orange-400/40 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px] fill ml-0.5">play_arrow</span>
                    </button>

                    <div class="absolute top-4 left-4">
                        <span class="px-3.5 py-1 rounded-full bg-navy-base/80 backdrop-blur-md text-amber-400 font-mono text-xs font-bold border border-amber-400/30">
                            {{ $project->client_name ?: 'Khách hàng đối tác' }}
                        </span>
                    </div>

                    <!-- Video Progress bar line decoration -->
                    <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-black/60">
                        <div class="h-full w-2/3 bg-gradient-to-r from-primary to-accent-amber"></div>
                    </div>
                </div>

                <!-- Content & KPIs -->
                <div class="p-8 flex flex-col justify-between flex-1 gap-6">
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors leading-tight">
                            <a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a>
                        </h3>
                        <p class="font-body text-sm text-slate-600 leading-relaxed">
                            {{ $project->summary ?: 'Dự án phối hợp toàn diện từ khâu lên ý tưởng sáng tạo, tiền kỳ sản xuất đến tối ưu hóa kênh phân phối đa nền tảng.' }}
                        </p>
                    </div>

                    <!-- Realistic KPIs Metric Row -->
                    <div class="grid grid-cols-3 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-center">
                        <div class="flex flex-col">
                            <span class="font-headline text-lg sm:text-xl font-black text-primary">{{ $project->views_metric ?: '65M+' }}</span>
                            <span class="text-[10px] font-mono text-slate-500 uppercase">Lượt xem</span>
                        </div>
                        <div class="flex flex-col border-x border-slate-200">
                            <span class="font-headline text-lg sm:text-xl font-black text-navy-base">{{ $project->reach_metric ?: '12.8M' }}</span>
                            <span class="text-[10px] font-mono text-slate-500 uppercase">Tiếp cận</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-headline text-lg sm:text-xl font-black text-emerald-600">{{ $project->conversion_metric ?: '+320%' }}</span>
                            <span class="text-[10px] font-mono text-slate-500 uppercase">Tăng trưởng</span>
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center gap-1.5 font-headline text-xs font-bold text-primary hover:text-primary-hover transition-colors">
                            <span>Xem toàn bộ Case Study</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                        <span class="font-mono text-xs text-slate-400">Năm {{ $project->year ?: '2024' }}</span>
                    </div>
                </div>

            </div>
            @empty
            <div class="col-span-2 text-center py-20 bg-white rounded-3xl border border-slate-200">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-2">movie_filter</span>
                <p class="font-headline text-base font-bold text-navy-base">Chưa có dự án nào được cập nhật.</p>
            </div>
            @endforelse
        </div>

        <!-- Client Testimonials Section -->
        <div class="p-10 sm:p-14 rounded-3xl bg-navy-base text-white border border-slate-700 shadow-2xl flex flex-col gap-10">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-widest">CLIENT TESTIMONIALS</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white">Khách Hàng Nói Gì Về Chúng Tôi?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $testimonials = \App\Models\Testimonial::all();
                @endphp
                @foreach($testimonials as $testi)
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 flex flex-col justify-between gap-4">
                    <p class="font-body text-xs text-slate-300 italic leading-relaxed">
                        "{{ $testi->quote }}"
                    </p>
                    <div class="flex items-center gap-3 pt-3 border-t border-white/10">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-accent-amber flex items-center justify-center font-bold text-xs text-white">
                            {{ mb_substr($testi->client_name, 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="font-headline text-xs font-bold text-white">{{ $testi->client_name }}</span>
                            <span class="text-[10px] text-slate-400 font-mono">{{ $testi->client_title }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Video Player Lightbox Modal (Alpine.js) -->
    <div x-show="videoModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md" style="display: none;">
        <div @click.outside="videoModal = false; currentVideoUrl = ''" class="w-full max-w-4xl bg-black rounded-3xl overflow-hidden shadow-2xl border border-slate-700 relative">
            <button @click="videoModal = false; currentVideoUrl = ''" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/70 hover:bg-black text-white flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined text-[22px]">close</span>
            </button>
            <div class="aspect-video w-full">
                <iframe class="w-full h-full" :src="currentVideoUrl" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>

</div>
@endsection
