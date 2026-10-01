@php
    $mediaCaseStudies = $mediaCaseStudies ?? \App\Models\CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
@endphp

<section class="w-full bg-white py-10 lg:py-14 border-b border-slate-200/80 relative overflow-hidden gsap-reveal-section" 
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
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-10 lg:space-y-12">
        
        <!-- ==================== 1. TOP HERO BANNER ==================== -->
        <div class="relative w-full flex flex-col lg:flex-row items-center justify-between min-h-[270px] lg:min-h-[300px]">
            
            <!-- Left: Content & 4 Features -->
            <div class="w-full lg:w-[48%] z-10 flex flex-col justify-center py-2 lg:py-4">
                <!-- Eyebrow -->
                <div class="flex items-center gap-2 mb-2.5">
                    <span style="display:inline-block; width:22px; height:3px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                    <span class="text-xs sm:text-[13px] font-extrabold text-[#0B132A] uppercase tracking-wider">SẢN XUẤT MEDIA &bull; TRUYỀN THÔNG THƯƠNG HIỆU</span>
                </div>
                
                <!-- Title -->
                <h2 id="media-support-title" class="font-headline text-3xl sm:text-4xl lg:text-[40px] font-black text-[#0B132A] tracking-tight leading-[1.16]">
                    Công Nghệ Tạo Nền Tảng &bull;<br>
                    <span style="color: #ff5500 !important;">Media Truyền Tải Giá Trị</span>
                </h2>
                
                <!-- Subtitle -->
                <p class="font-body text-slate-500 text-xs sm:text-[13.5px] mt-3 leading-relaxed max-w-xl">
                    Đội ngũ Media in-house đồng hành cùng các dự án công nghệ của Cửu Long từ khâu lên ý tưởng, sản xuất đến hậu kỳ, giúp thương hiệu của bạn lan tỏa mạnh mẽ qua những nội dung sáng tạo và chuyên nghiệp.
                </p>

                <!-- 4 Features in ONE horizontal row -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-1">
                    <!-- 1. Sản xuất video -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">videocam</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Sản xuất video</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">chuyên nghiệp</span>
                        </div>
                    </div>

                    <!-- 2. Hậu kỳ & dựng phim -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">play_arrow</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Hậu kỳ &amp; dựng phim</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">hiện đại</span>
                        </div>
                    </div>

                    <!-- 3. Ý tưởng sáng tạo -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">lightbulb</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Ý tưởng sáng tạo</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">đa nền tảng</span>
                        </div>
                    </div>

                    <!-- 4. Tối ưu nội dung -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px] text-[#ff5500] shrink-0 mt-0.5">star</span>
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-[12px] font-bold text-slate-800 leading-tight">Tối ưu nội dung</span>
                            <span class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">cho thương hiệu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Studio Camera Image with CSS fade from blur/transparent to clear -->
            <div class="w-full lg:w-[65%] lg:absolute lg:right-0 lg:top-0 lg:bottom-0 h-[230px] sm:h-[280px] lg:h-full flex items-center justify-end pointer-events-none select-none overflow-hidden"
                 style="-webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.15) 15%, rgba(0,0,0,0.8) 42%, #000 65%); mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.15) 15%, rgba(0,0,0,0.8) 42%, #000 65%);">
                <img src="{{ asset('images/media/media_hero_banner_2x.png') }}?v={{ filemtime(public_path('images/media/media_hero_banner_2x.png')) }}" 
                     alt="Sản xuất Media &amp; Truyền thông thương hiệu" 
                     class="w-full h-full object-cover object-right block"
                     loading="eager"
                     decoding="async">
            </div>
        </div>

        <!-- ==================== 2. DỊCH VỤ MEDIA NỔI BẬT (5 SERVICE CARDS) ==================== -->
        <div class="space-y-6">
            <!-- Header Row -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-5">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span style="display:inline-block; width:22px; height:3px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                        <span class="text-xs font-extrabold text-[#0B132A] uppercase tracking-wider">DỊCH VỤ MEDIA NỔI BẬT</span>
                    </div>
                    <h3 class="font-headline text-2xl sm:text-3xl font-black text-[#0B132A] tracking-tight">
                        Sản Xuất Nội Dung Đa Dạng &mdash; Phủ Sóng Mọi Nền Tảng
                    </h3>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-4 lg:gap-6">
                    <p class="font-body text-xs sm:text-[13px] text-slate-500 leading-relaxed max-w-md">
                        Từ video quảng cáo, TVC, livestream, đến các nội dung social media, chúng tôi mang đến giải pháp truyền thông trọn gói, phù hợp với mọi quy mô doanh nghiệp.
                    </p>
                    <a href="{{ route('services.media') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#ff5500] hover:bg-[#e04a00] text-white font-headline text-xs sm:text-sm font-bold shadow-sm hover:shadow-md transition-all shrink-0">
                        <span class="material-symbols-outlined text-[18px]">movie</span>
                        <span>Khám phá dịch vụ Media</span>
                        <span class="font-bold select-none">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- 5 Service Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 lg:gap-4 items-stretch">
                
                <!-- Card 1: Video Quảng Cáo & TVC -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_1_tvc_2x.png') }}?v={{ filemtime(public_path('images/media/service_1_tvc_2x.png')) }}" 
                             alt="Video Quảng Cáo &amp; TVC" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Video Quảng Cáo &amp; TVC
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Sản xuất TVC, video quảng cáo sáng tạo, chuyên nghiệp, giúp thương hiệu của bạn nổi bật và ghi dấu ấn.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Livestream Sự Kiện -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_2_livestream_2x.png') }}?v={{ filemtime(public_path('images/media/service_2_livestream_2x.png')) }}" 
                             alt="Livestream Sự Kiện" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Livestream Sự Kiện
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Truyền tải trực tiếp các sự kiện, hội thảo, ra mắt sản phẩm với chất lượng hình ảnh ổn định, chuyên nghiệp.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Phim Doanh Nghiệp -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_3_corporate_2x.png') }}?v={{ filemtime(public_path('images/media/service_3_corporate_2x.png')) }}" 
                             alt="Phim Doanh Nghiệp" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Phim Doanh Nghiệp
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Giới thiệu văn hóa, con người, năng lực của doanh nghiệp bằng những thước phim chuyên nghiệp và cảm xúc.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Hậu Kỳ & Dựng Phim -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_4_postprod_2x.png') }}?v={{ filemtime(public_path('images/media/service_4_postprod_2x.png')) }}" 
                             alt="Hậu Kỳ &amp; Dựng Phim" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Hậu Kỳ &amp; Dựng Phim
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Biến những thước phim thô thành sản phẩm hoàn chỉnh với kỹ thuật dựng phim hiện đại, hiệu ứng chuyên nghiệp.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Nội Dung Social Media -->
                <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.07)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div class="relative w-full aspect-[372/178] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('images/media/service_5_social_2x.png') }}?v={{ filemtime(public_path('images/media/service_5_social_2x.png')) }}" 
                             alt="Nội Dung Social Media" 
                             class="w-full h-full object-cover block group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>
                    <div class="pt-2 px-4 pb-4 flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="font-headline text-[15px] sm:text-base font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug mb-2">
                                Nội Dung Social Media
                            </h4>
                            <p class="font-body text-slate-500 text-xs sm:text-[12.5px] leading-relaxed mb-4">
                                Sáng tạo nội dung phù hợp từng nền tảng, từ Facebook, YouTube, TikTok đến Instagram, giúp tăng tương tác và nhận diện thương hiệu.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5500] hover:underline group-hover:translate-x-1 transition-transform">
                                <span>Xem chi tiết</span>
                                <span class="font-bold select-none leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== 3. DỰ ÁN MEDIA TIÊU BIỂU ==================== -->
        <div class="space-y-4 pt-2" x-data="{
            scrollContainer(direction) {
                const el = this.$refs.projectCarousel;
                if (!el) return;
                const scrollAmount = el.clientWidth * 0.75;
                el.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
            }
        }">
            <!-- Header Row -->
            <div class="flex items-center justify-between pb-1">
                <div>
                    <div class="flex items-center gap-2 mb-1.5">
                        <span style="display:inline-block; width:22px; height:3px; border-radius:9999px; background-color:#ff5500 !important;"></span>
                        <span class="text-xs font-extrabold text-[#0B132A] uppercase tracking-wider">DỰ ÁN MEDIA TIÊU BIỂU</span>
                    </div>
                    <h3 class="font-headline text-xl sm:text-2xl font-black text-[#0B132A] tracking-tight">
                        Sản Phẩm Thực Tế Từ Những Ý Tưởng Sáng Tạo
                    </h3>
                </div>

                <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1 text-xs sm:text-sm font-bold text-[#ff5500] hover:underline shrink-0">
                    <span>Xem tất cả dự án</span>
                    <span class="font-bold select-none">&rarr;</span>
                </a>
            </div>

            <!-- 6 Video Thumbnails with Navigation Buttons -->
            <div class="relative flex items-center gap-3">
                <!-- Prev Button -->
                <button type="button" 
                        @click="scrollContainer(-1)"
                        aria-label="Dự án trước"
                        class="w-9 h-9 rounded-full bg-white border border-slate-200/90 shadow-md hover:border-[#ff5500] hover:text-[#ff5500] text-slate-600 flex items-center justify-center shrink-0 transition-colors cursor-pointer select-none">
                    <span class="text-lg leading-none">&lsaquo;</span>
                </button>

                <!-- 6 Thumbnails Carousel / Grid -->
                <div x-ref="projectCarousel" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 lg:gap-3.5 flex-1 overflow-x-auto no-scrollbar scroll-smooth">
                    
                    <!-- Item 1: TVC Du Lịch -->
                    <div class="relative aspect-[318/130] rounded-xl overflow-hidden shadow-2xs group cursor-pointer border border-slate-200/80 bg-slate-900"
                         @click="openVideo('https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1', 'TVC Du Lịch')">
                        <img src="{{ asset('images/media/project_1_travel_2x.png') }}?v={{ filemtime(public_path('images/media/project_1_travel_2x.png')) }}" 
                             alt="TVC Du Lịch" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>

                    <!-- Item 2: Phim Doanh Nghiệp -->
                    <div class="relative aspect-[318/130] rounded-xl overflow-hidden shadow-2xs group cursor-pointer border border-slate-200/80 bg-slate-900"
                         @click="openVideo('https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1', 'Phim Doanh Nghiệp')">
                        <img src="{{ asset('images/media/project_2_corporate_2x.png') }}?v={{ filemtime(public_path('images/media/project_2_corporate_2x.png')) }}" 
                             alt="Phim Doanh Nghiệp" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>

                    <!-- Item 3: Livestream Sự Kiện -->
                    <div class="relative aspect-[318/130] rounded-xl overflow-hidden shadow-2xs group cursor-pointer border border-slate-200/80 bg-slate-900"
                         @click="openVideo('https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1', 'Livestream Sự Kiện')">
                        <img src="{{ asset('images/media/project_3_livestream_2x.png') }}?v={{ filemtime(public_path('images/media/project_3_livestream_2x.png')) }}" 
                             alt="Livestream Sự Kiện" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>

                    <!-- Item 4: Video Sản Phẩm -->
                    <div class="relative aspect-[318/130] rounded-xl overflow-hidden shadow-2xs group cursor-pointer border border-slate-200/80 bg-slate-900"
                         @click="openVideo('https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1', 'Video Sản Phẩm')">
                        <img src="{{ asset('images/media/project_4_product_2x.png') }}?v={{ filemtime(public_path('images/media/project_4_product_2x.png')) }}" 
                             alt="Video Sản Phẩm" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>

                    <!-- Item 5: Social Media -->
                    <div class="relative aspect-[318/130] rounded-xl overflow-hidden shadow-2xs group cursor-pointer border border-slate-200/80 bg-slate-900"
                         @click="openVideo('https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1', 'Social Media')">
                        <img src="{{ asset('images/media/project_5_social_2x.png') }}?v={{ filemtime(public_path('images/media/project_5_social_2x.png')) }}" 
                             alt="Social Media" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>

                    <!-- Item 6: Hậu Kỳ -->
                    <div class="relative aspect-[318/130] rounded-xl overflow-hidden shadow-2xs group cursor-pointer border border-slate-200/80 bg-slate-900"
                         @click="openVideo('https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1', 'Hậu Kỳ')">
                        <img src="{{ asset('images/media/project_6_post_2x.png') }}?v={{ filemtime(public_path('images/media/project_6_post_2x.png')) }}" 
                             alt="Hậu Kỳ" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>

                </div>

                <!-- Next Button -->
                <button type="button" 
                        @click="scrollContainer(1)"
                        aria-label="Dự án tiếp theo"
                        class="w-9 h-9 rounded-full bg-white border border-slate-200/90 shadow-md hover:border-[#ff5500] hover:text-[#ff5500] text-slate-600 flex items-center justify-center shrink-0 transition-colors cursor-pointer select-none">
                    <span class="text-lg leading-none">&rsaquo;</span>
                </button>
            </div>
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
