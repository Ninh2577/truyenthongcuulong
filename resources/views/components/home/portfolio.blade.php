<section class="w-full bg-surface bg-dot-grid-subtle py-12 lg:py-16 relative gsap-reveal-section border-b border-slate-200/80 overflow-hidden" 
         id="portfolio-section"
         x-data="{ 
             mainTab: 'clients',
             currentFilter: 'all', 
             videoModal: false, 
             activeVideoUrl: '', 
             activeVideoTitle: '',
             currentIndustry: 'all',
             displayLimit: 6,
             filterTemplate(indSlug, idx) {
                 if (this.currentIndustry === 'all') {
                     return idx < this.displayLimit;
                 }
                 return this.currentIndustry === indSlug;
             },
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
    




    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-8">
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Dự Án &amp; Minh Chứng Năng Lực
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Từ sản xuất hình ảnh điện ảnh, sự kiện quy mô lớn cho các đối tác hàng đầu đến kho giải pháp website đa ngành nghề sẵn sàng triển khai thực chiến.
            </p>
        </div>

        <!-- Master Level-1 Tab Switcher (Cấp Tab Cao Nhất: Dự Án Khách Hàng vs Mẫu Website Có Sẵn) -->
        <!-- Master Tab Navigation (Sliding Pill Indicator) -->
        <div class="flex justify-center mb-12">
            <div class="relative inline-flex items-center p-1.5 rounded-2xl bg-slate-200/85 border border-slate-300/80 shadow-inner backdrop-blur-md max-w-full" 
                 role="tablist" 
                 aria-label="Phân loại danh mục portfolio">
                
                <!-- Sliding Pill Indicator -->
                <div class="absolute top-1.5 bottom-1.5 rounded-xl bg-navy-base shadow-lg shadow-navy-base/25 transition-all duration-300 ease-out pointer-events-none z-0"
                     :style="mainTab === 'clients' ? 'left: 6px; width: calc(50% - 6px);' : 'left: 50%; width: calc(50% - 6px);';">
                </div>

                <!-- Tab 1: Dự Án Khách Hàng -->
                <button type="button" 
                        role="tab" 
                        id="tab-clients" 
                        ref="tabClients"
                        aria-controls="panel-clients" 
                        :aria-selected="mainTab === 'clients'" 
                        @click="mainTab = 'clients'; $nextTick(() => { window.animatePortfolioCards && window.animatePortfolioCards(); })" 
                        @keydown.arrow-right="mainTab = 'templates'; $nextTick(() => { $refs.tabTemplates.focus(); window.animatePortfolioCards && window.animatePortfolioCards(); })" 
                        :class="mainTab === 'clients' ? 'text-white font-bold' : 'text-slate-600 hover:text-navy-base font-semibold'"
                        class="relative z-10 flex items-center justify-center gap-2 sm:gap-2.5 px-4 sm:px-7 py-2.5 sm:py-3 rounded-xl font-headline text-xs sm:text-base transition-colors duration-200 cursor-pointer flex-1 sm:flex-initial">
                    <span class="material-symbols-outlined text-[18px] sm:text-[20px] transition-colors duration-200" 
                          :class="mainTab === 'clients' ? 'text-primary' : 'text-slate-500'">verified</span>
                    <span>Dự Án Khách Hàng</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-mono font-bold transition-colors duration-200"
                          :class="mainTab === 'clients' ? 'bg-primary/25 text-orange-300' : 'bg-slate-300/70 text-slate-600'">
                        Verified
                    </span>
                </button>

                <!-- Tab 2: Mẫu Website Có Sẵn -->
                <button type="button" 
                        role="tab" 
                        id="tab-templates" 
                        ref="tabTemplates"
                        aria-controls="panel-templates" 
                        :aria-selected="mainTab === 'templates'" 
                        @click="mainTab = 'templates'; $nextTick(() => { window.animatePortfolioCards && window.animatePortfolioCards(); })" 
                        @keydown.arrow-left="mainTab = 'clients'; $nextTick(() => { $refs.tabClients.focus(); window.animatePortfolioCards && window.animatePortfolioCards(); })" 
                        :class="mainTab === 'templates' ? 'text-white font-bold' : 'text-slate-600 hover:text-navy-base font-semibold'"
                        class="relative z-10 flex items-center justify-center gap-2 sm:gap-2.5 px-4 sm:px-7 py-2.5 sm:py-3 rounded-xl font-headline text-xs sm:text-base transition-colors duration-200 cursor-pointer flex-1 sm:flex-initial">
                    <span class="material-symbols-outlined text-[18px] sm:text-[20px] transition-colors duration-200" 
                          :class="mainTab === 'templates' ? 'text-amber-400' : 'text-slate-500'">web</span>
                    <span>Mẫu Website Có Sẵn</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-mono font-bold transition-colors duration-200"
                          :class="mainTab === 'templates' ? 'bg-amber-500/25 text-amber-300' : 'bg-slate-300/70 text-slate-600'">
                        {{ count($websiteTemplates) }} Demo
                    </span>
                </button>
            </div>
        </div>



        <!-- ==================== TAB PANEL 1: DỰ ÁN KHÁCH HÀNG (VERIFIED CLIENT SHOWCASE) ==================== -->
        <div id="panel-clients" 
             role="tabpanel" 
             aria-labelledby="tab-clients" 
             x-show="mainTab === 'clients'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0">
            
            <!-- Sub-header & Sub-filter của Tab Dự Án Khách Hàng -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8 pb-6 border-b border-slate-200/80">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold border border-orange-200 shadow-xs">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>VERIFIED CLIENT SHOWCASE</span>
                </div>

                <!-- Sub-filter Cấp 2: Tất Cả / Sản Xuất Video / Web & Nền Tảng Số -->
                <div class="flex items-center gap-1.5 p-1 rounded-full bg-slate-100 border border-slate-200">
                    <button type="button" 
                            @click="currentFilter = 'all'; $nextTick(() => { window.animatePortfolioCards && window.animatePortfolioCards(); })" 
                            :class="currentFilter === 'all' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                            class="px-4 py-1.5 rounded-full font-headline text-xs font-bold transition-all cursor-pointer">
                        Tất Cả
                    </button>
                    <button type="button" 
                            @click="currentFilter = 'media'; $nextTick(() => { window.animatePortfolioCards && window.animatePortfolioCards(); })" 
                            :class="currentFilter === 'media' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                            class="px-4 py-1.5 rounded-full font-headline text-xs font-bold transition-all cursor-pointer">
                        Sản Xuất Video
                    </button>
                    <button type="button" 
                            @click="currentFilter = 'tech'" 
                            :class="currentFilter === 'tech' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-navy-base'"
                            class="px-4 py-1.5 rounded-full font-headline text-xs font-bold transition-all cursor-pointer">
                        Web &amp; Nền Tảng Số
                    </button>
                </div>
            </div>

            <!-- Portfolio Showcase Grid (6 card khách hàng thật) -->
            <div class="portfolio-grid-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Real Project 1: Hoya Lens Việt Nam (ID 14068) - Video: dBFbsinzwNs -->
                <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                     class="video-hover-card project-item portfolio-stagger-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="h-60 w-full relative overflow-hidden bg-black">
                        <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                             alt="Team Building Hoya Lens tại Mũi Né" 
                             src="{{ asset('storage/uploads/2023/07/hoya-viet-nam-team-building-phan-thiet-2023.jpg') }}"
                             onerror="this.src='https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=800&q=80'"/>
                        
                        <div class="absolute top-3.5 left-3.5">
                            <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                Phan Thiết / Mũi Né
                            </span>
                        </div>

                        <!-- Hover Video Play Trigger Button -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                             @click="openVideo('https://www.youtube.com/embed/dBFbsinzwNs?autoplay=1&rel=0&modestbranding=1', 'Hoya Lens Việt Nam &bull; Team Building Phan Thiết')">
                            <div class="w-14 h-14 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30 hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[28px] translate-x-0.5">play_arrow</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded bg-orange-100 text-orange-700 font-mono text-[10px] font-bold">Client: Hoya Lens</span>
                                <span class="text-xs text-slate-400 font-mono">07/2023</span>
                            </div>
                            <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                                Hoya Lens Việt Nam &bull; Team Building &amp; Gala Mũi Né
                            </h3>
                            <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                                Sản xuất video recap toàn diện, flycam khảo sát góc máy toàn cảnh bãi biển Mũi Né kết hợp ghi hình highlight đêm gala với ống kính tele zoom điện ảnh.
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                            <span>4K DCI &bull; 60fps</span>
                            <button type="button" @click="openVideo('https://www.youtube.com/embed/dBFbsinzwNs?autoplay=1&rel=0&modestbranding=1', 'Hoya Lens Việt Nam &bull; Team Building Phan Thiết')" class="text-primary font-bold inline-flex items-center gap-1 cursor-pointer">
                                <span class="material-symbols-outlined text-[15px]">play_circle</span>
                                <span>Xem Video &rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Real Project 2: Tất Niên Kredivo tại TP.HCM (ID 14064) - Video: pwPRwTicUhI -->
                <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                     class="video-hover-card project-item portfolio-stagger-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="h-60 w-full relative overflow-hidden bg-black">
                        <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                             alt="Tất Niên Kredivo tại TP.HCM" 
                             src="{{ asset('storage/uploads/2024/01/tat-nien-kredivo-viet-nam-2023.jpg') }}"
                             onerror="this.src='https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=800&q=80'"/>
                        
                        <div class="absolute top-3.5 left-3.5">
                            <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                TP. Hồ Chí Minh
                            </span>
                        </div>

                        <!-- Hover Video Play Trigger Button -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                             @click="openVideo('https://www.youtube.com/embed/pwPRwTicUhI?autoplay=1&rel=0&modestbranding=1', 'Tất Niên Kredivo Việt Nam &bull; Dạ Tiệc Tri Ân Đỉnh Cao')">
                            <div class="w-14 h-14 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30 hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[28px] translate-x-0.5">play_arrow</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded bg-orange-100 text-orange-700 font-mono text-[10px] font-bold">Client: Kredivo</span>
                                <span class="text-xs text-slate-400 font-mono">01/2024</span>
                            </div>
                            <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                                Tất Niên Kredivo &bull; Dạ Tiệc Tri Ân Đỉnh Cao
                            </h3>
                            <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                                Bắt trọn những khoảnh khắc cảm xúc bùng nổ, visual lighting sân khấu hoành tráng và âm thanh stereo sống động trong đêm tiệc tất niên của fintech hàng đầu Đông Nam Á.
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                            <span>Multi-Camera &bull; S-Log3</span>
                            <button type="button" @click="openVideo('https://www.youtube.com/embed/pwPRwTicUhI?autoplay=1&rel=0&modestbranding=1', 'Tất Niên Kredivo Việt Nam &bull; Dạ Tiệc Tri Ân Đỉnh Cao')" class="text-primary font-bold inline-flex items-center gap-1 cursor-pointer">
                                <span class="material-symbols-outlined text-[15px]">play_circle</span>
                                <span>Xem Video &rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Real Project 3: Rakus Việt Nam tại Nha Trang (ID 13905) - Video: T9h_Jq_nNWU -->
                <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                     class="video-hover-card project-item portfolio-stagger-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="h-60 w-full relative overflow-hidden bg-black">
                        <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                             alt="Team Building & Gala Dinner Rakus Việt Nam tại Nha Trang" 
                             src="{{ asset('storage/uploads/2023/07/rakus-viet-nam-team-building-nha-trang-2023.jpg') }}"
                             onerror="this.src='https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80'"/>
                        
                        <div class="absolute top-3.5 left-3.5">
                            <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                Nha Trang
                            </span>
                        </div>

                        <!-- Hover Video Play Trigger Button -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                             @click="openVideo('https://www.youtube.com/embed/T9h_Jq_nNWU?autoplay=1&rel=0&modestbranding=1', 'RAKUS Việt Nam &bull; Team Building & Gala Dinner Nha Trang')">
                            <div class="w-14 h-14 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30 hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[28px] translate-x-0.5">play_arrow</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded bg-orange-100 text-orange-700 font-mono text-[10px] font-bold">Client: RAKUS</span>
                                <span class="text-xs text-slate-400 font-mono">06/2024</span>
                            </div>
                            <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                                RAKUS Việt Nam &bull; Team Building &amp; Gala Dinner Nha Trang
                            </h3>
                            <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                                Ghi lại hành trình gắn kết văn hóa doanh nghiệp Nhật Bản với hình ảnh biển xanh cát trắng rực rỡ và hoạt động bãi biển nhiệt huyết của hơn 300 nhân sự IT.
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                            <span>DaVinci Color &bull; 4K</span>
                            <button type="button" @click="openVideo('https://www.youtube.com/embed/T9h_Jq_nNWU?autoplay=1&rel=0&modestbranding=1', 'RAKUS Việt Nam &bull; Team Building & Gala Dinner Nha Trang')" class="text-primary font-bold inline-flex items-center gap-1 cursor-pointer">
                                <span class="material-symbols-outlined text-[15px]">play_circle</span>
                                <span>Xem Video &rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Real Project 4: Sacombank Khối Ngân Hàng Số (ID 13902) - Video: nGvVhO2kDo8 -->
                <div x-show="currentFilter === 'all' || currentFilter === 'media'" 
                     class="video-hover-card project-item portfolio-stagger-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="h-60 w-full relative overflow-hidden bg-black">
                        <img class="project-parallax-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                             alt="Sacombank Khối Ngân Hàng Số Chiến Dịch Vươn Khơi" 
                             src="{{ asset('storage/uploads/2023/07/sacombank-khoi-ngan-hang-so-team-building-nha-trang.jpg') }}"
                             onerror="this.src='https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=800&q=80'"/>
                        
                        <div class="absolute top-3.5 left-3.5">
                            <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-white font-mono text-[10px] font-bold border border-white/20">
                                Nha Trang / Cần Thơ
                            </span>
                        </div>

                        <!-- Hover Video Play Trigger Button -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                             @click="openVideo('https://www.youtube.com/embed/nGvVhO2kDo8?autoplay=1&rel=0&modestbranding=1', 'Sacombank Khối Ngân Hàng Số &bull; Chiến Dịch Vươn Khơi')">
                            <div class="w-14 h-14 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg ring-4 ring-orange-400/30 hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[28px] translate-x-0.5">play_arrow</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded bg-orange-100 text-orange-700 font-mono text-[10px] font-bold">Client: SACOMBANK</span>
                                <span class="text-xs text-slate-400 font-mono">06/2024</span>
                            </div>
                            <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                                Sacombank Khối Ngân Hàng Số &bull; Chiến Dịch Vươn Khơi
                            </h3>
                            <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                                Đồng hành ghi hình chuỗi sự kiện truyền cảm hứng của khối ngân hàng số với phong cách quay năng động, hiện đại.
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                            <span>Flycam &bull; 4K 10-Bit</span>
                            <button type="button" @click="openVideo('https://www.youtube.com/embed/nGvVhO2kDo8?autoplay=1&rel=0&modestbranding=1', 'Sacombank Khối Ngân Hàng Số &bull; Chiến Dịch Vươn Khơi')" class="text-primary font-bold inline-flex items-center gap-1 cursor-pointer">
                                <span class="material-symbols-outlined text-[15px]">play_circle</span>
                                <span>Xem Video &rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tech Showcase 1: Enterprise Web Platform (Live Preview Scroll) -->
                <div x-show="currentFilter === 'all' || currentFilter === 'tech'" 
                     class="project-item portfolio-stagger-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="web-preview-scroll-container h-60 w-full relative overflow-hidden bg-slate-100">
                        <img class="web-preview-scroll-img w-full object-cover" 
                             alt="Nền tảng quản trị phân phối thương mại điện tử" 
                             src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80"/>
                        
                        <div class="absolute top-3.5 left-3.5 z-10">
                            <span class="px-2.5 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-sky-400 font-mono text-[10px] font-bold border border-sky-400/30">
                                Enterprise SaaS &bull; Cloud ERP
                            </span>
                        </div>
                        <div class="absolute bottom-3.5 right-3.5 z-10 px-2 py-0.5 rounded bg-emerald-950/80 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                            Hover để xem cuộn trang
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-[10px] font-bold">Tech Platform</span>
                                <span class="text-xs text-slate-400 font-mono">Laravel &bull; Vue.js</span>
                            </div>
                            <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                                Hệ Thống Phân Phối &amp; Quản Trị Chuỗi Cung Ứng Mekong
                            </h3>
                            <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                                Kiến trúc microservices xử lý hơn 50.000 đơn hàng/ngày, đồng bộ tồn kho thời gian thực với độ trễ dưới 200ms.
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                            <span>Lighthouse 98/100</span>
                            <a href="{{ route('projects.index') }}" class="text-sky-600 font-bold">Xem Case Study &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Tech Showcase 2: Corporate Brand Portal (Live Preview Scroll) -->
                <div x-show="currentFilter === 'all' || currentFilter === 'tech'" 
                     class="project-item portfolio-stagger-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="web-preview-scroll-container h-60 w-full relative overflow-hidden bg-slate-100">
                        <img class="web-preview-scroll-img w-full object-cover" 
                             alt="Cổng thông tin tập đoàn thủy hải sản xuất khẩu" 
                             src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80"/>
                        
                        <div class="absolute top-3.5 left-3.5 z-10">
                            <span class="px-2.5 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-sky-400 font-mono text-[10px] font-bold border border-sky-400/30">
                                Corporate Portal &bull; Multi-Language
                            </span>
                        </div>
                        <div class="absolute bottom-3.5 right-3.5 z-10 px-2 py-0.5 rounded bg-emerald-950/80 text-emerald-400 font-mono text-[10px] border border-emerald-500/30">
                            Hover để xem cuộn trang
                        </div>
                    </div>
                    <div class="p-6 flex flex-col gap-2 flex-1 justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-[10px] font-bold">Export Portal</span>
                                <span class="text-xs text-slate-400 font-mono">Full-Stack Cloud</span>
                            </div>
                            <h3 class="font-headline text-lg text-navy-base font-bold group-hover:text-primary transition-colors">
                                Cổng Thông Tin Tập Đoàn Thủy Hải Sản Xuất Khẩu
                            </h3>
                            <p class="font-body text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                                Giao diện đa ngôn ngữ (Anh - Nhật - Việt), tích hợp tra cứu chứng từ điện tử và chuẩn bảo mật doanh nghiệp quốc tế.
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                            <span>Global CDN &bull; SSL</span>
                            <a href="{{ route('projects.index') }}" class="text-sky-600 font-bold">Xem Case Study &rarr;</a>
                        </div>
                    </div>
                </div>
            </div> <!-- End .portfolio-grid-wrapper -->
        </div>

        <!-- ==================== TAB PANEL 2: MẪU WEBSITE CÓ SẴN (LIVE DEMO — XEM THỬ NGAY) ==================== -->
        <div id="panel-templates" 
             role="tabpanel" 
             aria-labelledby="tab-templates" 
             x-show="mainTab === 'templates'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             style="display: none;">
            
            <!-- Sub-header & Badge của Tab Mẫu Website -->
            <div class="text-center max-w-2xl mx-auto mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/15 text-amber-800 border border-amber-400/40 font-mono text-xs font-bold shadow-xs mb-3">
                    <span class="material-symbols-outlined text-[16px] text-amber-600">preview</span>
                    <span>LIVE DEMO — XEM THỬ NGAY</span>
                </div>
                <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                    Bộ giao diện mẫu sẵn sàng tùy chỉnh theo đúng ngành của bạn — bấm xem demo thật, không cần tưởng tượng.
                </p>
                <div class="flex items-center justify-center gap-2 mt-3 text-xs text-slate-500 font-mono">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Demo Có Sẵn &bull; Trải Nghiệm Tương Tác Trực Quan &bull; Tùy Biến 100% Theo Nhận Diện Doanh Nghiệp</span>
                </div>
            </div>

            <!-- Dải Chip Lọc Ngang Theo Ngành (Deep Navy + Amber Accent) -->
            <div class="mb-10">
                <div class="flex items-center gap-2 overflow-x-auto pb-3 pt-1 no-scrollbar justify-start lg:justify-center flex-nowrap scroll-smooth">
                    <!-- Chip: Tất Cả -->
                    <button type="button"
                            @click="currentIndustry = 'all'; displayLimit = 6"
                            :class="currentIndustry === 'all' 
                                ? 'bg-navy-base text-white border-navy-base shadow-md ring-2 ring-navy-base/20 font-bold' 
                                : 'bg-white text-slate-700 hover:bg-slate-100 hover:text-navy-base border-slate-200/90'"
                            class="px-4 py-2 rounded-full font-headline text-xs tracking-wide transition-all border shrink-0 flex items-center gap-1.5 cursor-pointer">
                        <span class="material-symbols-outlined text-[15px]">apps</span>
                        <span>Tất Cả</span>
                        <span class="px-1.5 py-0.5 rounded-full text-[10px] font-mono"
                              :class="currentIndustry === 'all' ? 'bg-amber-400 text-slate-950 font-bold' : 'bg-slate-100 text-slate-600'">
                            {{ $websiteTemplates->count() }}
                        </span>
                    </button>

                    <!-- Các Chip Ngành Nghề từ Database (Tự động ẩn ngành 0 bài như Thú Cưng) -->
                    @foreach($industryFilters as $ind)
                        @if($ind['has_templates'])
                        <button type="button"
                                @click="currentIndustry = '{{ $ind['slug'] }}'; displayLimit = 6"
                                :class="currentIndustry === '{{ $ind['slug'] }}' 
                                    ? 'bg-navy-base text-white border-navy-base shadow-md ring-2 ring-navy-base/20 font-bold' 
                                    : 'bg-white text-slate-700 hover:bg-slate-100 hover:text-navy-base border-slate-200/90'"
                                class="px-4 py-2 rounded-full font-headline text-xs tracking-wide transition-all border shrink-0 flex items-center gap-1.5 cursor-pointer">
                            <span>{{ $ind['name'] }}</span>
                            <span class="px-1.5 py-0.5 rounded-full text-[10px] font-mono"
                                  :class="currentIndustry === '{{ $ind['slug'] }}' ? 'bg-amber-400 text-slate-950 font-bold' : 'bg-slate-100 text-slate-600'">
                                {{ $ind['count'] }}
                            </span>
                        </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Lưới Card Demo Mẫu Website (Live Preview Vertical Scroll, Tuyệt Đối Không Có Tên Khách Hàng Thật) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($websiteTemplates as $idx => $template)
                <div x-show="filterTemplate('{{ $template->industry_slug }}', {{ $idx }})"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="portfolio-stagger-card group rounded-3xl overflow-hidden bg-white border border-slate-200/90 hover:border-amber-500/50 transition-all duration-500 hover:shadow-2xl hover:shadow-amber-500/10 flex flex-col justify-between">
                    
                    <!-- Browser Window Header (Deep Navy) -->
                    <div class="px-4 py-2.5 bg-slate-900 border-b border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                        </div>
                        <span class="font-mono text-[11px] text-slate-400 truncate max-w-[170px] sm:max-w-[200px]">
                            demo.cuulong.tech/{{ $template->slug }}
                        </span>
                        <span class="px-2 py-0.5 rounded bg-amber-400/15 text-[10px] font-mono text-amber-400 border border-amber-400/30 font-bold">
                            Demo
                        </span>
                    </div>

                    <!-- Live Preview Scroll Window (Hover để cuộn xem trang) -->
                    <div class="web-preview-window h-64 sm:h-72 w-full relative overflow-hidden bg-slate-950 cursor-pointer">
                        <img class="web-preview-scroll-img w-full object-cover" 
                             alt="{{ $template->title }}" 
                             src="{{ asset('storage/' . $template->thumbnail) }}"
                             onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80'"/>

                        <!-- Top-left Industry Badge -->
                        <div class="absolute top-3.5 left-3.5 z-10">
                            <span class="px-2.5 py-1 rounded-full bg-slate-950/85 backdrop-blur-md text-amber-400 font-mono text-[11px] font-bold border border-amber-400/30 shadow-md">
                                {{ $template->industry_name }}
                            </span>
                        </div>

                        <!-- Top-right Status Badge: "Demo Có Sẵn" (Không dùng nhãn Verified) -->
                        <div class="absolute top-3.5 right-3.5 z-10">
                            <span class="px-2 py-0.5 rounded-md bg-emerald-950/85 backdrop-blur-md text-emerald-400 font-mono text-[10px] font-bold border border-emerald-500/30 flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>Demo Có Sẵn</span>
                            </span>
                        </div>

                        <!-- Bottom-right Hover Hint -->
                        <div class="absolute bottom-3 right-3 z-10 px-2 py-1 rounded bg-slate-950/80 backdrop-blur-md text-slate-300 font-mono text-[10px] border border-white/10 group-hover:opacity-0 transition-opacity flex items-center gap-1 pointer-events-none">
                            <span class="material-symbols-outlined text-[13px] text-amber-400">touch_app</span>
                            <span>Rê chuột để cuộn</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 sm:p-6 flex flex-col gap-3 flex-1 justify-between bg-white">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-800 font-mono text-[10px] font-bold border border-amber-200">
                                    Giao Diện Tùy Biến
                                </span>
                                <span class="text-[11px] text-slate-400 font-mono">
                                    Chuẩn SEO &bull; Mobile 1st
                                </span>
                            </div>
                            <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-1">
                                {{ $template->clean_title }}
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1 line-clamp-1 leading-relaxed">
                                {{ !empty($template->summary) ? $template->summary : 'Giao diện ' . $template->industry_name . ' tối ưu trải nghiệm người dùng, tốc độ tải nhanh.' }}
                            </p>
                        </div>

                        <!-- 2 Nút Hành Động Trên Mỗi Card -->
                        <div class="pt-3.5 border-t border-slate-100 flex items-center gap-2">
                            <!-- TODO: Cần cung cấp URL demo trực tiếp cho từng mẫu website (hiện chỉ có ảnh preview, chưa có link xem thử thật — nút "Xem Demo Trực Tiếp" cần trỏ đến trang thật, không phải ảnh tĩnh) -->
                            <a href="{{ $template->demo_url ?? route('templates.index', ['industry' => $template->industry_slug, 'preview' => $template->slug]) }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="flex-1 py-2 px-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-headline text-xs font-bold flex items-center justify-center gap-1 transition-all border border-slate-200/80 shadow-xs group/btn">
                                <span class="truncate">Xem Demo</span>
                                <span class="material-symbols-outlined text-[14px] group-hover/btn:translate-x-0.5 transition-transform shrink-0">open_in_new</span>
                            </a>

                            <a href="{{ route('contact', ['service_interested' => 'Tư vấn mẫu website: ' . $template->clean_title]) }}" 
                               class="flex-1 py-2 px-2.5 rounded-xl bg-primary hover:bg-orange-600 text-white font-headline text-xs font-bold flex items-center justify-center gap-1 transition-all shadow-md shadow-orange-500/20 hover:shadow-orange-500/30">
                                <span class="material-symbols-outlined text-[14px] shrink-0">support_agent</span>
                                <span class="truncate">Tư Vấn Mẫu Này</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Nút "Xem Thêm Mẫu Website" (Mặc định hiện 6 card khi ở tab Tất Cả) -->
            <div x-show="currentIndustry === 'all' && displayLimit < {{ $websiteTemplates->count() }}" class="text-center mt-10">
                <button @click="displayLimit += 6" 
                        type="button"
                        class="inline-flex items-center gap-2 px-7 py-3 rounded-full bg-white hover:bg-slate-50 text-navy-base font-headline text-sm font-bold border border-slate-200 shadow-sm hover:shadow transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-[18px] text-primary">expand_more</span>
                    <span>Xem Thêm Mẫu Website</span>
                    <span class="px-2 py-0.5 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold" 
                          x-text="`+${ {{ $websiteTemplates->count() }} - displayLimit }`"></span>
                </button>
            </div>

            <!-- CTA Chuyển Tiếp Sang Kho Giao Diện Đầy Đủ (/kho-giao-dien) — CHỈ HIỆN KHI mainTab = 'templates' -->
            <div class="mt-14 pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-6 bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/15 text-amber-700 flex items-center justify-center border border-amber-400/30 shrink-0">
                        <span class="material-symbols-outlined text-[26px]">dashboard_customize</span>
                    </div>
                    <div>
                        <h4 class="font-headline text-base sm:text-lg font-bold text-navy-base">
                            Cần Tùy Biến Giao Diện Chuyên Biệt Cho Ngành Của Bạn?
                        </h4>
                        <p class="text-xs sm:text-sm text-slate-600 mt-0.5">
                            Khám phá kho 39+ giao diện demo bản quyền sẵn sàng triển khai ngay trong 3–5 ngày làm việc.
                        </p>
                    </div>
                </div>
                <a href="{{ route('templates.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary hover:bg-orange-600 text-white font-headline text-sm font-bold shadow-lg shadow-orange-500/25 transition-all group shrink-0">
                    <span>Khám Phá Toàn Bộ Kho Giao Diện &rarr;</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Video Player Lightbox Modal (Alpine.js) -->
        <div x-show="videoModal" 
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
                 class="w-full max-w-4xl bg-slate-950 rounded-3xl overflow-hidden shadow-2xl border border-white/20 relative flex flex-col">
                <!-- Modal Top Bar -->
                <div class="flex items-center justify-between px-6 py-4 bg-slate-900/95 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse shadow-[0_0_8px_rgba(239,68,68,0.8)]"></span>
                        <span class="font-headline font-bold text-white text-sm truncate" x-text="activeVideoTitle"></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <a :href="activeVideoUrl.replace('/embed/', '/watch?v=').replace('?autoplay=1&rel=0&modestbranding=1', '')" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex items-center gap-1.5 text-xs text-amber-400 hover:text-amber-300 font-mono">
                            <span>Mở trên YouTube</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                        <button @click="closeVideo()" aria-label="Đóng video" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>
                </div>

                <!-- Video Iframe 16:9 Aspect Ratio -->
                <div class="aspect-video w-full bg-black">
                    <template x-if="videoModal">
                        <iframe class="w-full h-full" 
                                :src="activeVideoUrl" 
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