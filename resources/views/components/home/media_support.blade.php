{{-- 
    UI-REBUILD-08: CONSOLIDATED MEDIA CREATIVE SUPPORT LAYER (15%)
    Tích hợp 3 năng lực Media in-house cốt lõi và 3 dự án thực chứng tiêu biểu thành 1 flow liền mạch.
--}}
@php
    $mediaCaseStudies = $mediaCaseStudies ?? \App\Models\CaseStudy::where('group', 'media')->orderBy('order')->take(3)->get();
@endphp

<section class="w-full bg-slate-50/80 py-14 lg:py-20 border-b border-slate-200/80 relative overflow-hidden gsap-reveal-section" 
         id="media-support" 
         aria-labelledby="media-support-title"
         x-data="{
             videoModal: false,
             activeVideoUrl: '',
             activeVideoTitle: '',
             openVideo(url, title) {
                 this.activeVideoUrl = url;
                 this.activeVideoTitle = title;
                 this.videoModal = true;
                 document.body.style.overflow = 'hidden';
             },
             closeVideo() {
                 this.videoModal = false;
                 this.activeVideoUrl = '';
                 this.activeVideoTitle = '';
                 document.body.style.overflow = 'auto';
             }
         }">
    
    <!-- Ambient Creative Warmth Glow -->
    <div class="absolute -top-32 right-10 w-96 h-96 bg-gradient-to-br from-amber-400/8 via-primary/5 to-transparent rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-12">
        
        <!-- Header & Positioning -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6 border-b border-slate-200">
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
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3 shrink-0">
                <a href="{{ route('services.media') }}" 
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-xs font-bold shadow-xs transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">movie</span>
                    <span>Dịch Vụ Media</span>
                </a>
                
                <a href="{{ route('booking') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 font-headline text-xs font-bold transition-all shadow-2xs focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-slate-500" aria-hidden="true">photo_camera</span>
                    <span>Booking Ekip</span>
                </a>
            </div>
        </div>

        <!-- 3 Core Media Support Capabilities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Capability 1 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/40 hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-orange-50 text-primary flex items-center justify-center mb-4" aria-hidden="true">
                        <span class="material-symbols-outlined text-[22px]">smart_display</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">
                        TVC &amp; Video Sản Phẩm Số
                    </h3>
                    <p class="font-body text-xs text-slate-600 mt-2 leading-relaxed">
                        Sản xuất video demo tính năng Web-App, video giới thiệu giải pháp số và TVC quảng cáo digital với kịch bản cô đọng, sắc nét.
                    </p>
                </div>
                <span class="text-[11px] font-mono text-primary font-semibold mt-4 pt-3 border-t border-slate-100 block">
                    Product Demo &bull; Digital Ads
                </span>
            </div>

            <!-- Capability 2 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-amber-500/40 hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center mb-4" aria-hidden="true">
                        <span class="material-symbols-outlined text-[22px]">history_edu</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">
                        Phim Doanh Nghiệp
                    </h3>
                    <p class="font-body text-xs text-slate-600 mt-2 leading-relaxed">
                        Xây dựng video hồ sơ năng lực, phỏng vấn ban lãnh đạo và quy trình vận hành giúp tăng uy tín thương hiệu khi tiếp cận khách hàng.
                    </p>
                </div>
                <span class="text-[11px] font-mono text-amber-700 font-semibold mt-4 pt-3 border-t border-slate-100 block">
                    Brand Profile &bull; Heritage
                </span>
            </div>

            <!-- Capability 3 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-sky-500/40 hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center mb-4" aria-hidden="true">
                        <span class="material-symbols-outlined text-[22px]">photo_camera</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">
                        Ghi Hình Sự Kiện &amp; Booking Ekip
                    </h3>
                    <p class="font-body text-xs text-slate-600 mt-2 leading-relaxed">
                        Tác nghiệp đa máy quay, flycam 4K và cung cấp nhân sự quay phim, thiết bị Sony Cinema cơ động theo ngày hoặc theo buổi.
                    </p>
                </div>
                <span class="text-[11px] font-mono text-sky-700 font-semibold mt-4 pt-3 border-t border-slate-100 block">
                    Launch Event &bull; Media Crew
                </span>
            </div>
        </div>

        <!-- Visual Evidence: 3 Media Projects Strip (Consolidated from Portfolio) -->
        <div class="pt-6 border-t border-slate-200" id="media-case-studies">
            <div class="flex items-center justify-between mb-6">
                <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">TÁC PHẨM &amp; DỰ ÁN MEDIA THỰC TẾ</span>
                <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1 text-xs font-headline font-bold text-amber-700 hover:underline">
                    <span>Xem tất cả video</span>
                    <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
                </a>
            </div>

            @if(isset($mediaCaseStudies) && $mediaCaseStudies->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($mediaCaseStudies as $mediaProject)
                        <div class="group rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                            <div class="h-44 w-full relative overflow-hidden bg-black">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                     alt="{{ $mediaProject->title }}" 
                                     loading="lazy"
                                     src="{{ $mediaProject->cover_image_url ?: asset('images/portfolio/sacombank.jpg') }}"
                                     onerror="this.src='{{ asset('images/portfolio/sacombank.jpg') }}'"/>
                                
                                <div class="absolute top-2.5 left-2.5">
                                    <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                        {{ $mediaProject->client_name ?: 'Media' }}
                                    </span>
                                </div>

                                @if(!empty($mediaProject->video_url))
                                    <div class="absolute inset-0 flex items-center justify-center opacity-85 group-hover:opacity-100 transition-opacity cursor-pointer"
                                         @click="openVideo('{{ $mediaProject->video_url }}?autoplay=1&rel=0', '{{ $mediaProject->title }}')">
                                        <div class="w-11 h-11 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-3 ring-orange-400/30 hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-[22px] translate-x-0.5">play_arrow</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4 sm:p-5 flex flex-col justify-between flex-1 gap-2.5">
                                <div>
                                    <span class="text-[10px] font-mono font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-100">
                                        Sản Xuất Media
                                    </span>
                                    <h4 class="font-headline text-sm sm:text-base text-navy-base font-bold group-hover:text-primary transition-colors line-clamp-1 mt-1.5">
                                        {{ $mediaProject->title }}
                                    </h4>
                                    <p class="font-body text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                        {{ $mediaProject->summary }}
                                    </p>
                                </div>

                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                                    <span class="text-slate-400 text-[11px]">{{ $mediaProject->year ?: '4K Cinema' }}</span>
                                    @if(!empty($mediaProject->video_url))
                                        <button type="button" 
                                                @click="openVideo('{{ $mediaProject->video_url }}?autoplay=1&rel=0', '{{ $mediaProject->title }}')" 
                                                class="text-primary font-bold inline-flex items-center gap-1 cursor-pointer hover:underline">
                                            <span class="material-symbols-outlined text-[14px]">play_circle</span>
                                            <span>Xem Video</span>
                                        </button>
                                    @else
                                        <a href="{{ route('projects.show', $mediaProject->slug) }}" class="text-primary font-bold hover:underline">
                                            <span>Chi tiết &rarr;</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="group rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div class="h-44 w-full relative overflow-hidden bg-black">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 alt="TVC Quảng Cáo Ngân Hàng Sacombank" 
                                 loading="lazy"
                                 src="{{ asset('images/portfolio/sacombank.jpg') }}"
                                 onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'"/>
                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                    Sacombank
                                </span>
                            </div>
                        </div>
                        <div class="p-4 sm:p-5 flex flex-col justify-between flex-1 gap-2.5">
                            <div>
                                <span class="text-[10px] font-mono font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-100">Sản Xuất Media</span>
                                <h4 class="font-headline text-sm sm:text-base text-navy-base font-bold group-hover:text-primary transition-colors line-clamp-1 mt-1.5">
                                    TVC Quảng Cáo Ngân Hàng Sacombank
                                </h4>
                                <p class="font-body text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                    Sản xuất video TVC quảng cáo chuyên nghiệp cho chiến dịch thẻ tín dụng mới.
                                </p>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                                <span class="text-slate-400 text-[11px]">2026</span>
                                <a href="{{ route('services.media') }}" class="text-primary font-bold hover:underline">Chi tiết &rarr;</a>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div class="h-44 w-full relative overflow-hidden bg-black">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 alt="Phim Doanh Nghiệp Hoya Lens" 
                                 loading="lazy"
                                 src="{{ asset('images/portfolio/hoya.jpg') }}"
                                 onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'"/>
                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                    Hoya Lens
                                </span>
                            </div>
                        </div>
                        <div class="p-4 sm:p-5 flex flex-col justify-between flex-1 gap-2.5">
                            <div>
                                <span class="text-[10px] font-mono font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-100">Sản Xuất Media</span>
                                <h4 class="font-headline text-sm sm:text-base text-navy-base font-bold group-hover:text-primary transition-colors line-clamp-1 mt-1.5">
                                    Phim Doanh Nghiệp Hoya Lens
                                </h4>
                                <p class="font-body text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                    Video giới thiệu quy trình sản xuất tròng kính Nhật Bản chuẩn mực.
                                </p>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                                <span class="text-slate-400 text-[11px]">2025</span>
                                <a href="{{ route('services.media') }}" class="text-primary font-bold hover:underline">Chi tiết &rarr;</a>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div class="h-44 w-full relative overflow-hidden bg-black">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 alt="Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao" 
                                 loading="lazy"
                                 src="{{ asset('images/portfolio/kredivo.jpg') }}"
                                 onerror="this.src='{{ asset('images/modern_tech_platform.jpg') }}'"/>
                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                    Kredivo
                                </span>
                            </div>
                        </div>
                        <div class="p-4 sm:p-5 flex flex-col justify-between flex-1 gap-2.5">
                            <div>
                                <span class="text-[10px] font-mono font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-100">Sản Xuất Media</span>
                                <h4 class="font-headline text-sm sm:text-base text-navy-base font-bold group-hover:text-primary transition-colors line-clamp-1 mt-1.5">
                                    Tất Niên Kredivo - Dạ Tiệc Tri Ân Đỉnh Cao
                                </h4>
                                <p class="font-body text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                    Bắt trọn những khoảnh khắc bùng nổ, visual sân khấu hoành tráng đêm tiệc tất niên fintech hàng đầu.
                                </p>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                                <span class="text-slate-400 text-[11px]">2024</span>
                                <a href="{{ route('services.media') }}" class="text-primary font-bold hover:underline">Chi tiết &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>

    <!-- ==================== VIDEO MODAL ==================== -->
    <template x-teleport="body">
        <div x-show="videoModal" 
             x-cloak
             role="dialog"
             aria-modal="true"
             aria-label="Xem video dự án"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/80 backdrop-blur-md"
             @keydown.escape.window="closeVideo()">
            <div class="relative w-full max-w-4xl bg-black rounded-3xl overflow-hidden shadow-2xl border border-white/20"
                 @click.away="closeVideo()">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b border-white/10 text-white">
                    <h4 class="font-headline text-sm sm:text-base font-bold truncate pr-4" x-text="activeVideoTitle"></h4>
                    <button type="button" 
                            @click="closeVideo()" 
                            aria-label="Đóng video"
                            class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">close</span>
                    </button>
                </div>
                <!-- Video Container (16:9 Aspect Ratio) -->
                <div class="relative w-full aspect-video bg-black">
                    <iframe x-show="activeVideoUrl" 
                            :src="activeVideoUrl" 
                            :title="activeVideoTitle || 'Video giới thiệu dự án'"
                            class="w-full h-full" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </template>
</section>
