

<?php $__env->startSection('title', 'Hồ Sơ Năng Lực (E-Profile) - Truyền Thông Cửu Long'); ?>
<?php $__env->startSection('meta_description', 'Khám phá hồ sơ năng lực trực tuyến dạng Scrollytelling của Công ty Truyền Thông Cửu Long.'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Add base style adjustments if needed for the new design */
    html {
        scroll-behavior: smooth;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<main class="w-full pt-20 bg-surface">
    <div class="flex flex-col w-full relative">
        

        <!-- SECTION 1 — TRANG BÌA (HERO / COVER - DARK CINEMATIC SECTION) -->
        <section class="relative w-full min-h-[92vh] flex flex-col justify-between overflow-hidden bg-on-surface text-surface-container-lowest -mt-20 pt-28 pb-32 md:pb-36" id="hero">
            <!-- Cinematic Studio Background & Atmospheric Scrim -->
            <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('<?php echo e(asset('images/real-cameraman-production.jpg')); ?>')">
            </div>
            <!-- Deep Gradient Tint for Absolute Text Contrast -->
            <div class="absolute inset-0 z-0 bg-gradient-to-t from-on-surface via-on-surface/85 to-on-surface/75"></div>
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-primary/25 blur-[120px] rounded-full pointer-events-none z-0"></div>
            
            <!-- Main Hero Content -->
            <div class="relative z-10 max-w-container-max mx-auto px-gutter-mobile md:px-gutter-tablet lg:px-gutter-desktop w-full my-auto flex flex-col items-center text-center">
                <!-- Dragon Emblem / Crest Identity -->
                <div class="relative mb-6 group">
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl bg-gradient-to-br from-primary-container via-primary to-tertiary-container p-0.5 shadow-[0_0_36px_rgba(204,73,0,0.45)]">
                        <div class="w-full h-full rounded-2xl bg-on-surface/90 backdrop-blur-sm flex items-center justify-center">
                            <!-- Stylized Red-Orange Dragon / Film Icon -->
                            <svg class="w-12 h-12 text-primary-fixed" fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 4C14 4 6 12 6 22C6 29 10 34 16 38L20 34C16 31 13 27 13 22C13 16 18 11 24 11C30 11 35 16 35 22C35 25 33 28 30 30L26 26C28 25 29 23 29 22C29 19 27 17 24 17C21 17 19 19 19 22C19 24 20 26 22 27L18 31C14 28 12 25 12 22" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                                <path d="M28 34L34 40C39 35 42 29 42 22C42 12 34 4 24 4" stroke="#ffb599" stroke-linecap="round" stroke-width="2.5"></path>
                                <circle cx="24" cy="22" fill="currentColor" r="3.5"></circle>
                                <path d="M38 12L44 8M40 18L46 16" stroke="currentColor" stroke-linecap="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Super Heading -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-lowest/10 backdrop-blur-md mb-6">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="font-label-sm text-label-sm text-primary-fixed tracking-widest uppercase">Thành lập 2019 • Hơn 900 doanh nghiệp đối tác</span>
                </div>
                <h1 class="font-display-hero text-display-hero-mobile md:text-4xl lg:text-6xl font-extrabold text-surface-container-lowest tracking-tight max-w-5xl uppercase leading-tight">
                    CÔNG TY TNHH TRUYỀN THÔNG CỬU LONG
                </h1>
                <p class="font-headline-lg text-headline-sm md:text-headline-lg text-primary-fixed tracking-[0.25em] uppercase font-bold mt-4 mb-4">
                    (Cửu Long Media)
                </p>
                <p class="font-body-xl text-body-lg md:text-body-xl text-surface-variant max-w-3xl leading-relaxed">
                    Tổ hợp Truyền thông sáng tạo và Hạ tầng Công nghệ số. Định hình câu chuyện thương hiệu và kiến tạo nền tảng chuyển đổi số toàn diện.
                </p>
                <!-- Action Button Group -->
                <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
                    <a class="inline-flex items-center gap-2 rounded-full bg-primary-container text-on-primary-container font-label-md text-label-md px-8 py-3.5 shadow-[0_12px_28px_-6px_rgba(204,73,0,0.5)] hover:scale-105 transition-transform" href="#services">
                        <span>Khám Phá Giải Pháp</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
                    </a>
                    <a class="inline-flex items-center gap-2 rounded-full bg-surface-container-lowest/15 backdrop-blur-md text-surface-container-lowest hover:bg-surface-container-lowest/25 font-label-md text-label-md px-8 py-3.5 transition-all" href="#contact-cta">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                        <span>Liên Hệ Trực Tiếp</span>
                    </a>
                </div>
            </div>
            
            <!-- Floating Metrics Badge Bar -->
            <div class="relative z-10 max-w-container-max mx-auto px-gutter-mobile md:px-gutter-tablet lg:px-gutter-desktop w-full mt-10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 p-4 md:p-6 rounded-2xl bg-surface-container-lowest/5 backdrop-blur-xl">
                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="material-symbols-outlined text-[32px] md:text-[36px] text-primary-fixed">handshake</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Đối Tác Tin Cậy Đa Ngành</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="material-symbols-outlined text-[32px] md:text-[36px] text-primary-fixed">security</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Vận Hành Hệ Thống 24/7</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="font-headline-lg text-headline-md md:text-headline-lg text-primary-fixed">900+</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Doanh Nghiệp Đối Tác</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="material-symbols-outlined text-[32px] md:text-[36px] text-primary-fixed">hub</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Sản Xuất Media Đa Điểm</span>
                    </div>
                </div>
                <!-- Subtle Animated Chevron Prompt -->
                <div class="flex flex-col items-center justify-center mt-6 text-surface-variant/80">
                    <span class="font-label-sm text-label-sm tracking-wider uppercase mb-1">Cuộn để khám phá hồ sơ năng lực</span>
                    <span class="material-symbols-outlined animate-bounce text-primary-fixed">keyboard_arrow_down</span>
                </div>
            </div>
        </section>

        <!-- SECTION 2 — VỀ CHÚNG TÔI (LIGHT CONTRAST SECTION) -->
        <section class="w-full py-space-3xl md:py-space-4xl bg-surface-bright" id="about">
            <div class="max-w-container-max mx-auto px-gutter-mobile md:px-gutter-tablet lg:px-gutter-desktop">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12 items-start">
                    <!-- Left Column: 60% Narrative & Value Metrics -->
                    <div class="lg:col-span-7 flex flex-col gap-6">
                        <div class="inline-flex items-center gap-2 self-start px-3.5 py-1 rounded-full bg-secondary-container text-on-secondary-fixed">
                            <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
                            <span class="font-label-sm text-label-sm font-bold uppercase tracking-wider">Về Chúng Tôi</span>
                        </div>
                        <h2 class="font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface leading-tight">
                            Đội ngũ trẻ - năng động - sáng tạo.
                        </h2>
                        <p class="font-body-lg text-body-md md:text-body-lg text-on-surface-variant leading-relaxed">
                            Được thành lập từ năm 2019, Cửu Long Media là sự hợp nhất năng lực giữa Truyền thông (Media) và Công nghệ (Tech). Chúng tôi mang đến mô hình liên kết một cửa: Sản xuất hình ảnh chuẩn điện ảnh 4K song hành cùng giải pháp hạ tầng số, tự hào đã đồng hành cùng hơn 900 doanh nghiệp đối tác rộng khắp ĐBSCL và các tỉnh thành cả nước.
                        </p>
                        <!-- Key Value Chips -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                            <div class="p-4 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                                <span class="material-symbols-outlined text-primary text-[28px]">speed</span>
                                <span class="font-headline-sm text-headline-sm text-on-surface font-bold mt-1">-40%</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Thời gian &amp; Chi phí triển khai đa kênh</span>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                                <span class="material-symbols-outlined text-primary text-[28px]">hub</span>
                                <span class="font-headline-sm text-headline-sm text-on-surface font-bold mt-1">100%</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Đồng bộ bản sắc thương hiệu &amp; công nghệ</span>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                                <span class="material-symbols-outlined text-primary text-[28px]">monitoring</span>
                                <span class="font-headline-sm text-headline-sm text-on-surface font-bold mt-1">Real-time</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Báo cáo chỉ số chuyển đổi &amp; ROI chuẩn xác</span>
                            </div>
                        </div>
                        <!-- Brand Identity Anchor -->
                        <div class="relative mt-4 rounded-2xl bg-surface-container-lowest border border-surface-container-low overflow-hidden shadow-sm flex flex-col items-center justify-center p-8 group transition-shadow hover:shadow-md">
                            <!-- Subtle background accent -->
                            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-primary/5 via-transparent to-transparent opacity-50"></div>
                            
                            <img alt="Truyền Thông Cửu Long Logo" class="w-full max-w-[280px] h-auto object-contain transition-transform duration-700 group-hover:scale-105 relative z-10" src="<?php echo e(asset('images/logo-profile.png')); ?>"/>
                            
                            <div class="mt-8 pt-5 border-t border-surface-container-low w-full flex items-center justify-center gap-4 relative z-10">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">corporate_fare</span>
                                </div>
                                <div class="text-left">
                                    <h4 class="font-label-md text-label-md text-on-surface font-bold">Truyền Thông Cửu Long</h4>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">Tổ hợp Truyền thông &amp; Công nghệ số hàng đầu ĐBSCL</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column: 40% Tầm Nhìn Chiến Lược Card -->
                    <div class="lg:col-span-5 flex flex-col gap-6 lg:sticky lg:top-28">
                        <div class="p-8 md:p-10 rounded-2xl bg-gradient-to-br from-primary-fixed/40 via-surface-container-low to-surface-container-lowest shadow-md relative overflow-hidden">
                            <!-- Orange Indicator Bar -->
                            <div class="absolute top-0 left-0 bottom-0 w-2.5 bg-primary-container"></div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="material-symbols-outlined text-primary text-[32px]">visibility</span>
                                <span class="font-label-sm text-label-sm text-primary font-bold uppercase tracking-wider">Tầm Nhìn</span>
                            </div>
                            <blockquote class="font-headline-accent text-headline-md md:text-headline-accent text-on-surface italic leading-snug">
                                “Trở thành công ty truyền thông phát triển bền vững dựa trên tư duy đổi mới, thích ứng linh hoạt với kỷ nguyên số.”
                            </blockquote>
                            <div class="mt-8 pt-6 flex items-center justify-between">
                                <div>
                                    <p class="font-headline-sm text-headline-sm text-on-surface">Ban Điều Hành</p>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">Cửu Long Media Group (CLM)</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[24px]">verified_user</span>
                                </div>
                            </div>
                        </div>
                        <!-- Mission Subcard -->
                        <div class="p-6 rounded-2xl bg-surface-container-lowest shadow-sm flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined">flag</span>
                            </div>
                            <div>
                                <h4 class="font-headline-sm text-headline-sm text-on-surface mb-1">Sứ Mệnh</h4>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Đem lại sự hài lòng của khách hàng là kim chỉ nam hoạt động hàng đầu của chúng tôi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3 — DỊCH VỤ CỐT LÕI (DARK NAVY / SLATE SECTION) -->

        <!-- SECTION 4 — VÌ SAO CHỌN CHÚNG TÔI -->
        <section class="w-full py-space-2xl md:py-space-3xl bg-surface-container-low">
            <div class="max-w-container-max mx-auto px-gutter-mobile md:px-gutter-tablet lg:px-gutter-desktop">
                <div class="text-center mb-12">
                    <h2 class="font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface">
                        Giá Trị Cốt Lõi
                    </h2>
                    <p class="font-headline-md text-headline-md text-primary mt-4 uppercase font-bold tracking-widest">
                        KỊP THỜI – NHANH CHÓNG – SÁNG TẠO
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <span class="material-symbols-outlined text-[48px] text-primary mb-4">bolt</span>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">Tư vấn Kịp Thời</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Đội ngũ luôn sẵn sàng lắng nghe và đưa ra giải pháp ngay lập tức khi khách hàng cần.</p>
                    </div>
                    <div class="text-center p-6">
                        <span class="material-symbols-outlined text-[48px] text-primary mb-4">speed</span>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">Triển khai Nhanh Chóng</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Tối ưu hóa quy trình sản xuất, đảm bảo đúng tiến độ mà không suy giảm chất lượng.</p>
                    </div>
                    <div class="text-center p-6">
                        <span class="material-symbols-outlined text-[48px] text-primary mb-4">lightbulb</span>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">Ý tưởng Sáng Tạo</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Không rập khuôn, luôn đổi mới cách kể chuyện thương hiệu để tạo ấn tượng mạnh mẽ nhất.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 5 — DỰ ÁN TIÊU BIỂU -->
        <section class="w-full py-space-3xl md:py-space-4xl bg-surface-container-lowest" id="projects">
            <div class="max-w-container-max mx-auto px-gutter-mobile md:px-gutter-tablet lg:px-gutter-desktop">
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-secondary-container text-on-secondary-fixed mb-3">
                            <span class="material-symbols-outlined text-[16px] text-primary">auto_awesome</span>
                            <span class="font-label-sm text-label-sm font-bold uppercase tracking-wider">Hồ Sơ Thực Thi Minh Chứng</span>
                        </div>
                        <h2 class="font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface">
                            Đối Tác &amp; Dự Án Tiêu Biểu
                        </h2>
                    </div>
                    <a class="inline-flex items-center gap-1 font-label-md text-label-md text-primary font-bold hover:translate-x-1 transition-transform" href="<?php echo e(route('projects.index')); ?>">
                        <span>Xem tất cả dự án</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                </div>

                <div class="flex flex-wrap gap-3 mb-10">
                    <span class="px-4 py-2 rounded-full bg-surface-container-low text-on-surface-variant font-label-md text-label-md">Gia Phước Clinic</span>
                    <span class="px-4 py-2 rounded-full bg-surface-container-low text-on-surface-variant font-label-md text-label-md">Kinh Đô</span>
                    <span class="px-4 py-2 rounded-full bg-surface-container-low text-on-surface-variant font-label-md text-label-md">TATA International</span>
                    <span class="px-4 py-2 rounded-full bg-surface-container-low text-on-surface-variant font-label-md text-label-md">Du Lịch Chợ Lớn</span>
                    <span class="px-4 py-2 rounded-full bg-surface-container-low text-on-surface-variant font-label-md text-label-md">EXP Community</span>
                    <span class="px-4 py-2 rounded-full bg-surface-container-low text-on-surface-variant font-label-md text-label-md">Citranco</span>
                </div>

                <!-- 6 Project Cards Grid (2 rows x 3 cols) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Project 1: Nam Tây Nguyên -->
                    <div class="rounded-2xl bg-surface-bright shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group border border-surface-container-low">
                        <div class="h-52 w-full overflow-hidden relative bg-surface-container">
                            <img alt="Núi rừng Nam Tây Nguyên" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(asset('images/partners/nam_tay_nguyen_real.jpg')); ?>" onerror="this.src='https://placehold.co/600x400/1e293b/fff?text=Nam+Tay+Nguyen'"/>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-on-surface/80 text-surface-container-lowest text-[10px] sm:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap backdrop-blur-sm">Phim Tài Liệu • Du Lịch</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Núi rừng Nam Tây Nguyên</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                                    Dự án bảo tồn và truyền thông vẻ đẹp 23,000 Ha rừng nguyên sinh Đắk Nông.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Project 2: Láng Sen -->
                    <div class="rounded-2xl bg-surface-bright shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group border border-surface-container-low">
                        <div class="h-52 w-full overflow-hidden relative bg-surface-container">
                            <img alt="Khu bảo tồn Láng Sen" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(asset('images/partners/lang_sen_real.jpg')); ?>" onerror="this.src='https://placehold.co/600x400/1e293b/fff?text=Lang+Sen'"/>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-on-surface/80 text-surface-container-lowest text-[10px] sm:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap backdrop-blur-sm">Bảo Tồn • Flycam</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Khu bảo tồn Đất ngập nước Láng Sen</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                                    Khu Ramsar thứ 7 của Việt Nam, ghi hình các loài chim quý hiếm và hệ sinh thái đa dạng.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Project 3: Nâm Nung Ultimate Challenge -->
                    <div class="rounded-2xl bg-surface-bright shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group border border-surface-container-low">
                        <div class="h-52 w-full overflow-hidden relative bg-surface-container">
                            <img alt="Nâm Nung Ultimate Challenge" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(asset('images/partners/long_trekking_real.jpg')); ?>" onerror="this.src='https://placehold.co/600x400/1e293b/fff?text=Nam+Nung'"/>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-on-surface/80 text-surface-container-lowest text-[10px] sm:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap backdrop-blur-sm">Thể Thao • Sự Kiện</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Nâm Nung Ultimate Challenge</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                                    Truyền thông giải chạy bộ địa hình và đi bộ băng rừng quy mô lớn.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Project 4: Geopark 2022 -->
                    <div class="rounded-2xl bg-surface-bright shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group border border-surface-container-low">
                        <div class="h-52 w-full overflow-hidden relative bg-surface-container">
                            <img alt="Đắk Nông UNESCO Global Geopark 2022" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(asset('images/partners/geopark.jpg')); ?>"/>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-on-surface/80 text-surface-container-lowest text-[10px] sm:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap backdrop-blur-sm">Sự Kiện Quốc Tế</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Đắk Nông UNESCO Global Geopark 2022</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                                    Sản xuất hình ảnh quảng bá Công viên Địa chất toàn cầu UNESCO Đắk Nông vươn ra thế giới.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Project 5: Hội nghị Hang động -->
                    <div class="rounded-2xl bg-surface-bright shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group border border-surface-container-low">
                        <div class="h-52 w-full overflow-hidden relative bg-surface-container">
                            <img alt="Hội nghị Hang động Thế giới ISV20" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(asset('images/partners/cave.jpg')); ?>"/>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-on-surface/80 text-surface-container-lowest text-[10px] sm:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap backdrop-blur-sm">Hội Nghị Cấp Cao</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Hội nghị Hang động Thế giới ISV20</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                                    Ghi hình chuỗi sự kiện hội nghị quốc tế với sự tham gia của các chuyên gia đầu ngành.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Project 6: Team Building -->
                    <div class="rounded-2xl bg-surface-bright shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group border border-surface-container-low">
                        <div class="h-52 w-full overflow-hidden relative bg-surface-container">
                            <img alt="Chuỗi Sự kiện Team Building 500+ Sinh Viên" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(asset('images/partners/team_building.jpg')); ?>"/>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-on-surface/80 text-surface-container-lowest text-[10px] sm:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap backdrop-blur-sm">Sự Kiện Trải Nghiệm</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Chuỗi Sự kiện Team Building 500+ Sinh Viên</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                                    Ghi lại những khoảnh khắc năng động, nhiệt huyết của tập thể sinh viên quy mô lớn.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 6 — PHẢN HỒI KHÁCH HÀNG (TESTIMONIALS) -->
        <section class="w-full py-space-3xl md:py-space-4xl bg-surface-container-lowest border-t border-surface-container">
            <div class="max-w-container-max mx-auto px-gutter-mobile md:px-gutter-tablet lg:px-gutter-desktop">
                <div class="text-center mb-12">
                    <h2 class="font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface">
                        Khách Hàng Nói Gì Về Chúng Tôi
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-surface-container-low p-8 rounded-2xl">
                        <div class="flex text-amber-500 mb-4">
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                        </div>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-6 italic">"Giải pháp số hóa cổng thông tin và lịch hẹn của Cửu Long giúp phòng khám chúng tôi giảm tải 60% thời gian chờ đợi của bệnh nhân, thật sự rất hiệu quả."</p>
                        <div>
                            <h4 class="font-headline-sm text-headline-sm text-on-surface">Phòng Khám Đa Khoa Gia Phước</h4>
                        </div>
                    </div>
                    <div class="bg-surface-container-low p-8 rounded-2xl">
                        <div class="flex text-amber-500 mb-4">
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                        </div>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-6 italic">"Các hình ảnh truyền thông và video tư liệu được thực hiện vô cùng chuyên nghiệp, kịp tiến độ dù thời gian rất gấp gáp."</p>
                        <div>
                            <h4 class="font-headline-sm text-headline-sm text-on-surface">Kinh Đô</h4>
                        </div>
                    </div>
                    <div class="bg-surface-container-low p-8 rounded-2xl">
                        <div class="flex text-amber-500 mb-4">
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                            <span class="material-symbols-outlined text-[20px]">star</span>
                        </div>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-6 italic">"Đối tác tin cậy, thấu hiểu nhu cầu của giới trẻ và cộng đồng thể thao, triển khai media rất nhanh chóng và bắt trend."</p>
                        <div>
                            <h4 class="font-headline-sm text-headline-sm text-on-surface">EXP Community</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 7 — HỆ SINH THÁI THƯƠNG HIỆU (LIGHT / HORIZONTAL BANDS) -->
        <section class="w-full py-space-3xl md:py-space-4xl bg-surface-container-low" id="ecosystem">
            <div class="max-w-container-max mx-auto px-gutter-mobile md:px-gutter-tablet lg:px-gutter-desktop">
                <!-- Section Header -->
                <div class="max-w-3xl mb-12">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed mb-3">
                        <span class="material-symbols-outlined text-[16px] text-primary">share_location</span>
                        <span class="font-label-sm text-label-sm font-bold uppercase tracking-wider">Hệ Sinh Thái Thương Hiệu CLM</span>
                    </div>
                    <h2 class="font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface">
                        Mạng Lưới Thương Hiệu Thành Viên
                    </h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">
                        Sở hữu hệ thống truyền thông độc quyền cùng các điểm chạm trải nghiệm thực tế, tạo dựng tệp khán giả trung thành và lan tỏa giá trị văn hóa bản địa.
                    </p>
                </div>
                <!-- 4 Wide Horizontal Narrative Cards -->
                <div class="flex flex-col gap-6">
                    <!-- Brand 1: Cuu Long Camping -->
                    <a href="https://cuulongcamping.vn/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest p-6 md:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col lg:flex-row items-center gap-6 group relative overflow-hidden">
                        <div class="w-full lg:w-72 h-44 rounded-xl overflow-hidden shrink-0 relative">
                            <img alt="Cuu Long Camping" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://cuulongcamping.vn/wp-content/uploads/2026/01/2952ca4a-aa3e-4546-9c57-52f789045c04.jpg"/>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-emerald-700 text-white font-label-sm text-label-sm">Eco &amp; Travel</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
                                <span class="font-label-sm text-label-sm text-emerald-700 font-bold uppercase tracking-wider">Du Lịch Trải Nghiệm &amp; Điểm Chạm Thực Tế</span>
                            </div>
                            <h3 class="font-headline-lg text-headline-md md:text-headline-lg text-on-surface mb-2">
                                Cuu Long Camping
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
                                Mô hình cắm trại sinh thái ven sông kết hợp phim trường dã ngoại tự nhiên tại ĐBSCL. Nơi tổ chức các sự kiện Brand Activation, ghi hình thực tế và gắn kết cộng đồng du lịch bền vững.
                            </p>
                            <div class="flex flex-wrap gap-4 text-on-surface-variant font-body-sm text-body-sm">
                                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-emerald-600">park</span> 20,000m² Không gian xanh</span>
                                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-emerald-600">videocam</span> Phim trường ngoại cảnh 4K</span>
                            </div>
                        </div>
                    </a>
                    <!-- Brand 2: Tui Là Người Miền Tây -->
                    <a href="https://tuilanguoimientay.vn/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest p-6 md:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col lg:flex-row items-center gap-6 group relative overflow-hidden">
                        <div class="w-full lg:w-72 h-44 rounded-xl overflow-hidden shrink-0 relative">
                            <img alt="Tui Là Người Miền Tây Channel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://tuilanguoimientay.vn/wp-content/uploads/2019/12/an-giang.jpg"/>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-amber-600 text-white font-label-sm text-label-sm">Media Channel</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                <span class="font-label-sm text-label-sm text-amber-700 font-bold uppercase tracking-wider">Kênh Truyền Thông Văn Hóa &amp; Ẩm Thực</span>
                            </div>
                            <h3 class="font-headline-lg text-headline-md md:text-headline-lg text-on-surface mb-2">
                                Tui Là Người Miền Tây
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
                                Kênh truyền thông độc quyền của CLM khai thác vẻ đẹp ẩm thực, con người và tập quán xứ Tây Nam Bộ. Với mạng lưới người theo dõi trung thành, kênh là bệ phóng truyền thông tự nhiên cho các nhãn hàng F&amp;B và du lịch.
                            </p>
                            <div class="flex flex-wrap gap-4 text-on-surface-variant font-body-sm text-body-sm">
                                <span class="inline-flex items-center gap-1.5 font-bold text-amber-700"><span class="material-symbols-outlined text-[18px]">groups</span> 1.5M+ Người theo dõi</span>
                                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-amber-600">visibility</span> 45M+ Lượt xem video/tháng</span>
                            </div>
                        </div>
                    </a>
                    <!-- Brand 3: Tiêu Dao Tử -->
                    <a href="https://tieudaotu.com/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest p-6 md:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col lg:flex-row items-center gap-6 group relative overflow-hidden">
                        <div class="w-full lg:w-72 h-44 rounded-xl overflow-hidden shrink-0 relative">
                            <img alt="Tiêu Dao Tử Production Lab" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://tieudaotu.com/wp-content/uploads/2020/12/deo-ma-pi-leng-ha-giang-viet-nam-1920x800-3.jpg"/>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-blue-600 text-white font-label-sm text-label-sm">Media Archive &amp; Lab</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                                <span class="font-label-sm text-label-sm text-blue-700 font-bold uppercase tracking-wider">Production House &amp; Footages Bank</span>
                            </div>
                            <h3 class="font-headline-lg text-headline-md md:text-headline-lg text-on-surface mb-2">
                                Tiêu Dao Tử
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
                                Trung tâm thử nghiệm ý tưởng sáng tạo và ngân hàng tư liệu phong cảnh 4K/8K lớn nhất ĐBSCL. Cung cấp nguồn tài nguyên bản quyền chuẩn điện ảnh cho các đoàn làm phim và đài truyền hình trong lẫn ngoài nước.
                            </p>
                            <div class="flex flex-wrap gap-4 text-on-surface-variant font-body-sm text-body-sm">
                                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-blue-600">cloud_download</span> Kho lưu trữ 10TB+ Raw 4K</span>
                                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-blue-600">copyright</span> 100% Độc quyền bản quyền hình ảnh</span>
                            </div>
                        </div>
                    </a>
                    <!-- Brand 4: Cùng Chơi -->
                    <a href="https://cungchoi.com/" target="_blank" rel="noopener noreferrer" class="block rounded-2xl bg-surface-container-lowest p-6 md:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col lg:flex-row items-center gap-6 group relative overflow-hidden">
                        <div class="w-full lg:w-72 h-44 rounded-xl overflow-hidden shrink-0 relative">
                            <img alt="Cùng Chơi Gamification Studio" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(asset('images/partners/cungchoi_logo.png')); ?>"/>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-purple-600 text-white font-label-sm text-label-sm">Gamification</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-3 h-3 rounded-full bg-purple-600"></span>
                                <span class="font-label-sm text-label-sm text-purple-700 font-bold uppercase tracking-wider">Interactive Tech &amp; Gamified Marketing</span>
                            </div>
                            <h3 class="font-headline-lg text-headline-md md:text-headline-lg text-on-surface mb-2">
                                Cùng Chơi
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
                                Nền tảng phát triển Miniapps tương tác, trò chơi trực tuyến hóa (Gamification) phục vụ các chiến dịch ra mắt sản phẩm và giữ chân người dùng trong ứng dụng của doanh nghiệp.
                            </p>
                            <div class="flex flex-wrap gap-4 text-on-surface-variant font-body-sm text-body-sm">
                                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-purple-600">sports_esports</span> +300% Tỉ lệ tương tác phiên</span>
                                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-purple-600">extension</span> Tích hợp SDK tức thì trong 48h</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- SECTION 6 — CTA & LIÊN HỆ KẾT TRANG -->
        <?php if (isset($component)) { $__componentOriginal7377788b2746583c980d3e03b36ac40f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7377788b2746583c980d3e03b36ac40f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.cta','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7377788b2746583c980d3e03b36ac40f)): ?>
<?php $attributes = $__attributesOriginal7377788b2746583c980d3e03b36ac40f; ?>
<?php unset($__attributesOriginal7377788b2746583c980d3e03b36ac40f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7377788b2746583c980d3e03b36ac40f)): ?>
<?php $component = $__componentOriginal7377788b2746583c980d3e03b36ac40f; ?>
<?php unset($__componentOriginal7377788b2746583c980d3e03b36ac40f); ?>
<?php endif; ?>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/profile.blade.php ENDPATH**/ ?>