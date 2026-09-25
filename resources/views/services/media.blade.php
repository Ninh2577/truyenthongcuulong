@extends('layouts.app')

@section('title', 'Quay Phim Sự Kiện & Team Building - Truyền Thông Cửu Long')
@section('meta_description', 'Xưởng phim sản xuất TVC quảng cáo 4K, phim tài liệu doanh nghiệp và video viral chuyên nghiệp với trang thiết bị điện ảnh hiện đại.')

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Quay Phim Sự Kiện & Team Building",
  "serviceType": "Video Production & Film Making",
  "provider": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "url": "https://truyenthongcuulong.com",
    "logo": "https://truyenthongcuulong.com/images/logo.png"
  },
  "areaServed": "VN",
  "description": "Xưởng phim sản xuất TVC quảng cáo 4K, phim tài liệu doanh nghiệp và video viral chuyên nghiệp với trang thiết bị điện ảnh hiện đại.",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VND",
    "availability": "https://schema.org/InStock",
    "url": "{{ route('pricing') }}"
  }
}
</script>
@endpush

@section('content')
<div x-data="{
    videoModal: false,
    currentVideoUrl: '',
    openVideo(url) {
        let embed = url || 'https://www.youtube.com/embed/nGvVhO2kDo8?autoplay=1&rel=0&modestbranding=1';
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
    <section class="relative w-full overflow-hidden pt-32 pb-14 lg:pt-36 lg:pb-20 border-b border-slate-200/80 bg-surface-low bg-dot-grid-subtle">
        <!-- Ambient Cinema Light Beams -->
        <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-amber-500/15 via-primary/15 to-transparent blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/4 w-[400px] h-[300px] rounded-full bg-gradient-to-tr from-sky-500/10 via-primary/10 to-transparent blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb Navigation -->
            <div class="mb-6">
                <x-ui.breadcrumb :items="[
                    ['label' => 'Giải pháp & Dịch vụ', 'url' => '/dich-vu'],
                    ['label' => 'Sản xuất Media & Video']
                ]" />
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-8 flex flex-col gap-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 text-orange-700 font-mono text-xs font-bold border border-orange-200 w-fit backdrop-blur-sm shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <span>CREATIVE SUPPORT &bull; MEDIA &amp; VIDEO</span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base leading-tight">
                        Sản Xuất Tư Liệu Video &amp; <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-amber-500">Hình Ảnh Doanh Nghiệp</span>
                    </h1>
                    <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed max-w-3xl">
                        Năng lực sản xuất tư liệu hình ảnh và video chuyên nghiệp bổ trợ cho nền tảng số: từ video giới thiệu công ty, TVC quảng bá đến tư liệu sự kiện phục vụ website và truyền thông số.
                    </p>

                    <div class="flex flex-wrap items-center gap-2 pt-2">
                        <span class="px-3 py-1 rounded-lg bg-white border border-amber-200 text-amber-700 font-mono text-xs font-bold">Sony FX Cinema</span>
                        <span class="px-3 py-1 rounded-lg bg-white border border-sky-200 text-sky-700 font-mono text-xs font-bold">DaVinci Resolve HDR</span>
                        <span class="px-3 py-1 rounded-lg bg-white border border-emerald-200 text-emerald-700 font-mono text-xs font-bold">DJI Ronin RS3 Pro</span>
                        <span class="px-3 py-1 rounded-lg bg-white border border-orange-200 text-orange-700 font-mono text-xs font-bold">32-bit Float Sound</span>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 pt-3">
                        <a href="{{ route('contact') }}?service=media" class="px-6 py-3.5 rounded-xl bg-navy-base hover:bg-slate-800 text-white font-headline text-xs sm:text-sm font-bold shadow-md shadow-navy-base/15 transition-all flex items-center gap-2">
                            <span>Bắt đầu dự án</span>
                            <span class="material-symbols-outlined text-[16px] text-amber-400">arrow_forward</span>
                        </a>
                        <button type="button" @click="openVideo('https://www.youtube.com/embed/nGvVhO2kDo8?autoplay=1&rel=0&modestbranding=1')" class="px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary font-headline text-xs sm:text-sm font-semibold shadow-xs hover:border-primary/40 transition-all flex items-center gap-2 cursor-pointer">
                            <span class="material-symbols-outlined text-[18px] text-amber-500">play_circle</span>
                            <span>Xem Showreel</span>
                        </button>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-xl flex flex-col gap-5">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">TIÊU CHUẨN SẢN XUẤT</span>
                            <span class="material-symbols-outlined text-primary">videocam</span>
                        </div>
                        <ul class="flex flex-col gap-3 font-body text-xs text-slate-700">
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500">Độ phân giải:</span>
                                <span class="font-mono font-bold text-navy-base">4K UHD / 6K RAW</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500">Chuẩn không gian màu:</span>
                                <span class="font-mono font-bold text-navy-base">DCI-P3 / REC.709</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500">Hệ thống âm thanh:</span>
                                <span class="font-mono font-bold text-navy-base">Thu âm chuyên dụng</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500">Góc máy trên không:</span>
                                <span class="font-mono font-bold text-navy-base">Flycam 4K</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500">Bàn giao file:</span>
                                <span class="font-mono font-bold text-emerald-700 flex items-center">
                                    <span class="material-symbols-outlined text-[16px] mr-1">task_alt</span>
                                    Master 4K &amp; File Gốc
                                </span>
                            </li>
                        </ul>
                        <div class="pt-2">
                            <a href="{{ route('pricing') }}" class="w-full py-2.5 rounded-xl bg-surface-low hover:bg-slate-100 text-navy-base font-headline text-xs font-bold transition-all text-center block border border-slate-200">
                                Xem Bảng Giá Sản Xuất TVC
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: 4 Định Dạng Sản Phẩm Media Cốt Lõi -->
    <section class="w-full bg-surface bg-dot-grid-subtle py-16 lg:py-20 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold mb-3 border border-orange-200">
                    <span class="material-symbols-outlined text-[16px]">movie</span>
                    <span>CINEMATIC PORTFOLIO FORMATS</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                    4 Định Dạng Sản Phẩm Media Chủ Lực
                </h2>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                    Được may đo kỹ lưỡng cho từng nền tảng phát sóng: từ màn ảnh truyền hình, màn hình hội nghị đến các kênh mạng xã hội.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="opacity-0 translate-y-8 scroll-reveal p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 delay-100 flex flex-col justify-between group">
                    <div class="flex flex-col gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[26px]">tv</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">TVC Quảng Cáo 4K</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">Thời lượng 15s - 60s, kịch bản sáng tạo đột phá, diễn viên tuyển chọn, góc máy điện ảnh chuẩn màu truyền hình.</p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-200 text-xs font-mono font-bold text-primary">TV &amp; Digital Ads</div>
                </div>

                <div class="opacity-0 translate-y-8 scroll-reveal p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 delay-200 flex flex-col justify-between group">
                    <div class="flex flex-col gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[26px]">history_edu</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">Phim Doanh Nghiệp</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">Kỷ niệm thành lập, hồ sơ năng lực video, phỏng vấn ban lãnh đạo, tôn vinh chặng đường phát triển và văn hóa tổ chức.</p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-200 text-xs font-mono font-bold text-amber-600">Brand Profile</div>
                </div>

                <div class="opacity-0 translate-y-8 scroll-reveal p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 delay-300 flex flex-col justify-between group">
                    <div class="flex flex-col gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[26px]">play_circle</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">Video Ngắn Viral</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">Tối ưu cho TikTok, Facebook Reels và Shorts: Kịch bản bắt trúng thị hiếu trong 3 giây đầu, nhịp dựng nhanh lôi cuốn.</p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-200 text-xs font-mono font-bold text-sky-600">TikTok &amp; Reels</div>
                </div>

                <div class="opacity-0 translate-y-8 scroll-reveal p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 delay-500 flex flex-col justify-between group">
                    <div class="flex flex-col gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-headline text-xl font-bold group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[26px]">podcasts</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">Sự Kiện &amp; Livestream</h3>
                        <p class="font-body text-xs text-slate-600 leading-relaxed">Bàn switcher truyền hình trực tiếp 3-4 góc máy 4K, đường truyền vệ tinh chống rớt mạng, flycam ghi trọn đại cảnh.</p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-200 text-xs font-mono font-bold text-emerald-600">Gala &amp; Event</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Before/After Color Grading Interactive Slider -->
    <section class="relative w-full py-16 lg:py-20 border-b border-slate-200/80 bg-surface-low bg-dot-grid-subtle overflow-hidden" x-data="{ sliderPos: 50, demoPlayed: false }" x-intersect.once="setTimeout(() => { if(demoPlayed) return; demoPlayed=true; let p=50; let d=-1; let int = setInterval(()=> { p+=d; sliderPos=p; if(p<=35) d=1; if(p>=50 && d===1) clearInterval(int); }, 20); }, 800)">
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-50 text-amber-600 font-mono text-xs font-bold mb-3 border border-amber-200 backdrop-blur-sm shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">tune</span>
                    <span>DAVINCI RESOLVE COLOR SCIENCE</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                    Sức Mạnh Của Khâu Chỉnh Màu Điện Ảnh
                </h2>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                    Kéo thanh trượt để so sánh trực tiếp giữa khung hình LOG/RAW mộc và khung hình sau khi được Colorist xử lý màu sắc chuẩn REC.709/HDR.
                </p>
            </div>

            <div class="max-w-4xl mx-auto relative rounded-3xl overflow-hidden border border-white/20 shadow-2xl select-none" style="aspect-ratio: 16/9;">
                <!-- Before Image (LOG) -->
                <div class="absolute inset-0 w-full h-full bg-slate-800 flex items-center justify-center">
                    <img src="{{ asset('images/color-grade-raw-before.webp') }}" alt="LOG RAW Footages" class="w-full h-full object-cover grayscale brightness-90 contrast-75">
                    <div class="absolute top-4 left-4 px-3 py-1 rounded-full bg-black/70 backdrop-blur-md text-slate-300 font-mono text-xs font-bold border border-white/20">
                        RAW / S-LOG3 (Mộc)
                    </div>
                </div>

                <!-- After Image (Graded Cinematic) -->
                <div class="absolute inset-0 w-full h-full overflow-hidden" :style="'width: ' + sliderPos + '%'">
                    <div class="w-full h-full relative" style="width: 1000px; max-width: none;">
                        <img src="{{ asset('images/color-grade-master-after.webp') }}" alt="Cinematic Color Graded" class="w-full h-full object-cover saturate-150 contrast-125">
                        <div class="absolute top-4 left-4 px-3 py-1 rounded-full bg-amber-500 text-navy-base font-mono text-xs font-bold shadow-lg">
                            DaVinci Color Graded (Master 4K)
                        </div>
                    </div>
                </div>

                <!-- Slider Divider Line -->
                <div class="absolute top-0 bottom-0 w-1 bg-white cursor-ew-resize z-20 shadow-[0_0_10px_rgba(255,255,255,0.8)]" :style="'left: ' + sliderPos + '%'">
                    <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 w-9 h-9 rounded-full bg-white text-navy-base flex items-center justify-center shadow-lg font-bold">
                        <span class="material-symbols-outlined text-[20px]">drag_indicator</span>
                    </div>
                </div>

                <!-- Range Input Controller -->
                <input type="range" min="0" max="100" x-model="sliderPos" class="absolute inset-0 w-full h-full opacity-0 cursor-ew-resize z-30" aria-label="So sánh màu trước và sau">
            </div>
            <p class="text-center text-xs font-mono text-slate-400 mt-4">
                &larr; Kéo sang trái/phải để đối chiếu chất lượng &rarr;
            </p>
        </div>
    </section>



    <!-- Section 5: Dự Án Video Tiêu Biểu -->
    <section class="w-full bg-surface bg-dot-grid-subtle py-16 lg:py-20 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
                <div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold mb-3">
                        <span class="material-symbols-outlined text-[16px]">play_circle</span>
                        <span>FEATURED SHOWREELS</span>
                    </div>
                    <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                        Tác Phẩm &amp; Video Tiêu Biểu
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}?group=media" class="inline-flex items-center gap-2 text-primary font-headline text-sm font-bold hover:underline">
                    <span>Xem tất cả video</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @forelse($mediaCaseStudies as $case)
                <div class="opacity-0 translate-y-8 scroll-reveal rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col justify-between group" style="transition-delay: {{ $loop->index * 150 }}ms;" x-data="{ playing: false, hasVideo: {{ $case->video_url ? 'true' : 'false' }} }" @mouseenter="if(hasVideo) { playing = true; $refs.vid.play(); }" @mouseleave="if(hasVideo) { playing = false; $refs.vid.pause(); $refs.vid.currentTime = 0; }">
                    <div class="h-64 w-full relative overflow-hidden bg-navy-base">
                        @php
                            $imageUrl = $case->cover_image_url;
                        @endphp

                        @if($imageUrl)
                            <img src="{{ $imageUrl }}" alt="{{ $case->title }}" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500" :class="playing ? 'opacity-0' : 'opacity-100'">
                        @else
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-slate-800 to-navy-base flex flex-col items-center justify-center p-6 transition-opacity duration-500" :class="playing ? 'opacity-0' : 'opacity-100'">
                                <!-- Chưa có ảnh -->
                            </div>
                        @endif

                        @if($case->video_url)
                        <!-- Video Preview (Muted, Loop, Playsinline) -->
                        <video x-ref="vid" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500" :class="playing ? 'opacity-100 scale-105' : 'opacity-0 scale-100'" muted loop playsinline preload="none" poster="{{ $imageUrl ?? '' }}">
                            <source src="{{ $case->video_url }}" type="video/mp4">
                        </video>
                        @endif

                        <!-- Hover Overlay Gradient -->
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors pointer-events-none"></div>

                        <!-- Badge Duration (Only if has video) -->
                        @if($case->video_url)
                        <div class="absolute bottom-3 right-3 z-10 flex gap-2">
                            <span class="px-2 py-1 rounded-md bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/10 flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[12px]">schedule</span>
                                02:15
                            </span>
                        </div>
                        @endif

                        <!-- Play Button -->
                        <button type="button" @click="openVideo('{{ $case->video_url }}')" class="absolute inset-0 m-auto w-14 h-14 rounded-full bg-primary text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform cursor-pointer z-10">
                            <span class="material-symbols-outlined text-[28px] fill ml-1">play_arrow</span>
                        </button>

                        <div class="absolute top-3 left-3 z-10">
                            <span class="px-3 py-0.5 rounded-full bg-navy-base/80 backdrop-blur-md text-amber-400 font-mono text-xs font-bold border border-amber-400/30">
                                {{ $case->client_name ?: 'Đối Tác Doanh Nghiệp' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col gap-2.5">
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-1">
                            {!! $case->title !!}
                        </h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2 leading-relaxed">
                            {{ $case->summary ?: 'Chiến dịch hình ảnh chuyên nghiệp do ekip Truyền Thông Cửu Long trực tiếp bấm máy và hoàn thiện hậu kỳ.' }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-10 text-slate-500 text-sm">
                    Đang cập nhật các tác phẩm mới nhất.
                </div>
                @endforelse
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add tiny delay to ensure first paint happens
    setTimeout(() => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('scroll-reveal')) {
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    } else if (entry.target.classList.contains('scroll-reveal-right')) {
                        entry.target.classList.remove('opacity-0', 'translate-x-8');
                        entry.target.classList.add('opacity-100', 'translate-x-0');
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.scroll-reveal, .scroll-reveal-right').forEach((el) => {
            observer.observe(el);
        });
    }, 100);
});
</script>
@endpush
@endsection

