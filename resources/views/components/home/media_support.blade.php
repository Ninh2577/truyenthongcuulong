{{-- 
    UI-09: MEDIA 15% INTEGRATION / CREATIVE SUPPORT
    Section giải thích năng lực Media in-house hỗ trợ hệ sinh thái giải pháp số & công nghệ.
    Định vị: Technology First ≈ 85% — Media ≈ 15% (Creative Support Layer).
--}}
@php
    $mediaProjects = $mediaCaseStudies ?? \App\Models\CaseStudy::where('group', 'media')->orderBy('order')->take(3)->get();
@endphp

<section class="w-full bg-slate-50/70 py-14 lg:py-20 border-b border-slate-200/80 relative overflow-hidden gsap-reveal-section" 
         id="media-support" 
         aria-labelledby="media-support-title" 
         x-data="{ 
             mediaModal: false, 
             videoUrl: '', 
             videoTitle: '',
             playVideo(url, title) {
                 this.videoUrl = url;
                 this.videoTitle = title;
                 this.mediaModal = true;
                 document.body.style.overflow = 'hidden';
             },
             closeVideo() {
                 this.mediaModal = false;
                 this.videoUrl = '';
                 this.videoTitle = '';
                 document.body.style.overflow = 'auto';
             }
         }">
    
    <!-- Ambient Creative Warmth Glow -->
    <div class="absolute -top-32 right-10 w-96 h-96 bg-gradient-to-br from-amber-400/8 via-primary/5 to-transparent rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- ==================== 1. SECTION HEADER ==================== -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 pb-6 border-b border-slate-200">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 text-orange-800 font-mono text-xs font-bold border border-orange-200/80 mb-3 shadow-2xs">
                    <span class="material-symbols-outlined text-[15px] text-primary" aria-hidden="true">videocam</span>
                    <span>CREATIVE SUPPORT &bull; MEDIA IN-HOUSE (15%)</span>
                </div>
                
                <h2 id="media-support-title" class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-navy-base">
                    Công Nghệ Tạo Nền Tảng &bull; Media Truyền Tải Giá Trị
                </h2>
                
                <p class="font-body text-slate-600 text-sm sm:text-base mt-2.5 leading-relaxed">
                    Đội ngũ Media in-house đồng hành cùng các dự án công nghệ của Cửu Long: trực tiếp sản xuất video giới thiệu tính năng, tư liệu truyền thông và sự kiện ra mắt đồng bộ nhận diện số cho doanh nghiệp.
                </p>
            </div>

            <!-- Quick Action CTAs -->
            <div class="flex flex-wrap sm:flex-nowrap items-center gap-2.5 sm:gap-3 shrink-0">
                <a href="{{ route('services.media') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-white hover:bg-slate-100 text-navy-base border border-slate-300 font-headline text-xs font-bold transition-all shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-primary" aria-hidden="true">movie</span>
                    <span>Dịch Vụ Media</span>
                </a>
                
                <a href="{{ route('booking') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 font-headline text-xs font-bold transition-all shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-slate-500" aria-hidden="true">photo_camera</span>
                    <span>Booking Ekip</span>
                </a>
            </div>
        </div>

        <!-- ==================== 2. MEDIA CAPABILITIES (CREATIVE SUPPORT LAYER) ==================== -->
        <div class="mb-14">
            <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block mb-4">
                NĂNG LỰC SÁNG TẠO HỖ TRỢ HỆ SINH THÁI SỐ
            </span>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Capability 1 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/40 hover:shadow-xs transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center mb-3.5" aria-hidden="true">
                            <span class="material-symbols-outlined text-[20px]">smart_display</span>
                        </div>
                        <h3 class="font-headline text-sm font-bold text-navy-base">
                            TVC &amp; Video Sản Phẩm Số
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 leading-relaxed">
                            Sản xuất video demo tính năng Web-App, video giới thiệu giải pháp số và TVC quảng cáo digital với kịch bản cô đọng, sắc nét.
                        </p>
                    </div>
                    <span class="text-[11px] font-mono text-primary font-semibold mt-3 pt-3 border-t border-slate-100 block">
                        Product Demo &bull; Digital Ads
                    </span>
                </div>

                <!-- Capability 2 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-amber-500/40 hover:shadow-xs transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center mb-3.5" aria-hidden="true">
                            <span class="material-symbols-outlined text-[20px]">history_edu</span>
                        </div>
                        <h3 class="font-headline text-sm font-bold text-navy-base">
                            Phim Doanh Nghiệp
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 leading-relaxed">
                            Xây dựng video hồ sơ năng lực, phỏng vấn ban lãnh đạo và quy trình vận hành giúp tăng uy tín thương hiệu khi tiếp cận khách hàng.
                        </p>
                    </div>
                    <span class="text-[11px] font-mono text-amber-700 font-semibold mt-3 pt-3 border-t border-slate-100 block">
                        Brand Profile &bull; Heritage
                    </span>
                </div>

                <!-- Capability 3 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-sky-500/40 hover:shadow-xs transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center mb-3.5" aria-hidden="true">
                            <span class="material-symbols-outlined text-[20px]">podcasts</span>
                        </div>
                        <h3 class="font-headline text-sm font-bold text-navy-base">
                            Ghi Hình Sự Kiện &amp; Ra Mắt
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 leading-relaxed">
                            Tác nghiệp đa máy quay, flycam toàn cảnh và sản xuất video recap sự kiện ra mắt nền tảng số, hội thảo khách hàng, team building.
                        </p>
                    </div>
                    <span class="text-[11px] font-mono text-sky-700 font-semibold mt-3 pt-3 border-t border-slate-100 block">
                        Launch Event &bull; Recap 4K
                    </span>
                </div>

                <!-- Capability 4 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-emerald-500/40 hover:shadow-xs transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-3.5" aria-hidden="true">
                            <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                        </div>
                        <h3 class="font-headline text-sm font-bold text-navy-base">
                            Booking Ekip &amp; Thiết Bị
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-1.5 leading-relaxed">
                            Cung cấp nhân sự quay phim, đạo diễn hình ảnh và hệ thống máy quay Sony Cinema, ánh sáng chuyên dụng cơ động theo nhu cầu.
                        </p>
                    </div>
                    <span class="text-[11px] font-mono text-emerald-700 font-semibold mt-3 pt-3 border-t border-slate-100 block">
                        Media Crew Booking
                    </span>
                </div>
            </div>
        </div>

        <!-- ==================== 3. SELECTED MEDIA WORK SHOWCASE ==================== -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block">
                    DỰ ÁN SÁNG TẠO ĐÃ THỰC HIỆN
                </span>
                <a href="{{ route('services.media') }}" class="text-xs font-mono font-bold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem thêm dự án</span>
                    <span class="material-symbols-outlined text-[14px]" aria-hidden="true">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($mediaProjects as $project)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 shadow-2xs hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                        <div class="h-44 w-full relative overflow-hidden bg-black">
                            <img src="{{ $project->cover_image_url ?: asset('images/portfolio/sacombank.jpg') }}" 
                                 alt="{{ $project->title }}" 
                                 loading="lazy"
                                 onerror="this.src='{{ asset('images/portfolio/sacombank.jpg') }}'"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            
                            <div class="absolute inset-0 bg-black/25 group-hover:bg-black/10 transition-colors"></div>

                            @if(!empty($project->video_url))
                                <button type="button" 
                                        @click="playVideo('{{ $project->video_url }}?autoplay=1&rel=0&modestbranding=1', '{{ $project->title }}')"
                                        class="absolute inset-0 flex items-center justify-center cursor-pointer"
                                        aria-label="Xem video dự án {{ $project->title }}">
                                    <div class="w-11 h-11 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-[22px] translate-x-0.5" aria-hidden="true">play_arrow</span>
                                    </div>
                                </button>
                            @endif

                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                    {{ $project->client_name ?: 'Doanh Nghiệp' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between gap-3">
                            <div>
                                <h3 class="font-headline text-sm font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-1">
                                    {{ $project->title }}
                                </h3>
                                <p class="font-body text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                    {{ $project->summary }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] font-mono text-slate-400">
                                <span>{{ $project->year ?: '4K Cinema' }}</span>
                                @if(!empty($project->video_url))
                                    <button type="button" 
                                            @click="playVideo('{{ $project->video_url }}?autoplay=1&rel=0&modestbranding=1', '{{ $project->title }}')"
                                            class="text-primary font-bold inline-flex items-center gap-1 cursor-pointer hover:underline">
                                        <span class="material-symbols-outlined text-[14px]" aria-hidden="true">play_circle</span>
                                        <span>Xem video</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ==================== 4. CONVERSION ACTION STRIP ==================== -->
        <div class="mt-12 pt-8 border-t border-slate-200/90 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-center sm:text-left">
                <span class="font-headline text-sm sm:text-base font-bold text-navy-base block">
                    Cần tư vấn sản xuất hình ảnh &amp; video cho dự án số?
                </span>
                <span class="font-body text-xs sm:text-sm text-slate-600 block mt-0.5">
                    Đội ngũ Media Cửu Long đồng bộ kịch bản và nhận diện thương hiệu từ khâu thiết kế đến xuất bản.
                </span>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3 w-full sm:w-auto shrink-0">
                <a href="{{ route('services.media') }}" 
                   class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-xs font-bold shadow-xs hover:scale-[1.02] transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none w-full sm:w-auto">
                    <span>Xem năng lực Media</span>
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                </a>
                
                <a href="{{ route('booking') }}" 
                   class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-full bg-white hover:bg-slate-100 text-slate-700 font-headline text-xs font-semibold border border-slate-200 transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none w-full sm:w-auto">
                    <span>Booking Ekip</span>
                </a>
            </div>
        </div>

        <!-- ==================== 5. LIGHTBOX MODAL (VIDEO 4K) ==================== -->
        <div x-show="mediaModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             @keydown.escape.window="closeVideo()"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/90 backdrop-blur-md" 
             style="display: none;">
            <div @click.outside="closeVideo()" 
                 role="dialog"
                 aria-modal="true"
                 :aria-label="videoTitle || 'Video giới thiệu dự án'"
                 class="w-full max-w-4xl bg-slate-950 rounded-3xl overflow-hidden shadow-2xl border border-white/20 relative flex flex-col">
                <div class="flex items-center justify-between px-6 py-4 bg-slate-900/95 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse" aria-hidden="true"></span>
                        <span class="font-headline font-bold text-white text-sm truncate" x-text="videoTitle"></span>
                    </div>
                    <button @click="closeVideo()" aria-label="Đóng video" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">close</span>
                    </button>
                </div>
                <div class="aspect-video w-full bg-black">
                    <template x-if="mediaModal">
                        <iframe class="w-full h-full" 
                                :src="videoUrl" 
                                title="YouTube video player"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen></iframe>
                    </template>
                </div>
            </div>
        </div>

    </div>
</section>
