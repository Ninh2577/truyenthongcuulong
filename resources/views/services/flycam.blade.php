@extends('layouts.app')

@section('title', 'Dịch Vụ Quay Chụp Flycam Chuyên Nghiệp Cần Thơ & Miền Tây - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ quay chụp flycam chuyên nghiệp tại Cần Thơ và Miền Tây. Khẳng định vị thế thương hiệu với thước phim flycam 4K sắc nét, an toàn, chuẩn điện ảnh.')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Dịch Vụ Quay Chụp Flycam Chuyên Nghiệp",
  "provider": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo-ttcl.png') }}"
  },
  "areaServed": {
    "@type": "AdministrativeArea",
    "name": "Đồng bằng Sông Cửu Long & Toàn Quốc"
  },
  "description": "Dịch vụ quay phim và chụp ảnh bằng Flycam chất lượng cao 4K cho dự án bất động sản, sự kiện, du lịch và quảng bá doanh nghiệp.",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VND",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endsection

@section('content')
<div x-data="{ 
    videoModal: false, 
    videoUrl: '', 
    videoTitle: '',
    openVideo(title, url) {
        this.videoTitle = title;
        this.videoUrl = url;
        this.videoModal = true;
    },
    closeVideo() {
        this.videoModal = false;
        this.videoUrl = '';
    },
    activeTestimonial: 0,
    testimonials: [
        {
            quote: 'Video flycam của Truyền Thông Cửu Long thật sự ấn tượng! Góc quay đẹp, sắc nét, thể hiện rõ tinh thần của sự kiện. Đội ngũ làm việc chuyên nghiệp, đúng tiến độ. Chắc chắn chúng tôi sẽ hợp tác lâu dài!',
            name: 'Anh Lê Văn Hòa',
            role: 'Giám đốc Marketing',
            avatar: 'VH'
        },
        {
            quote: 'Cảnh quay flycam cho dự án bất động sản của chúng tôi đẹp vượt mong đợi. Độ phân giải 4K sắc nét, bắt trọn toàn cảnh dự án từ trên cao, giúp tỷ lệ khách hàng chốt cọc tăng rõ rệt.',
            name: 'Chị Nguyễn Thanh Thảo',
            role: 'Trưởng phòng Truyền thông',
            avatar: 'TT'
        },
        {
            quote: 'Ekip bay flycam tay nghề rất cao, xử lý góc máy mượt mà và chấp hành nghiêm ngặt an toàn bay. Các thước phim hoàng hôn trên sông cực kỳ giàu cảm xúc!',
            name: 'Anh Trần Quốc Bảo',
            role: 'Trưởng ban Tổ chức',
            avatar: 'QB'
        }
    ],
    nextTestimonial() {
        this.activeTestimonial = (this.activeTestimonial + 1) % this.testimonials.length;
    },
    prevTestimonial() {
        this.activeTestimonial = (this.activeTestimonial - 1 + this.testimonials.length) % this.testimonials.length;
    }
}">

    <!-- Custom CSS strictly mimicking the mockup -->
    <style>
        .badge-flycam-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 5px 16px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: 1.5px solid #ff5400;
            color: #ff5400;
            background: rgba(255, 84, 0, 0.07);
        }
        .badge-flycam-dark-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 5px 16px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: 1px solid rgba(255, 84, 0, 0.4);
            color: #ff7a1a;
            background: rgba(255, 84, 0, 0.12);
        }
        .btn-brand-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #ff5400;
            background-image: linear-gradient(135deg, #ff4e00 0%, #ff5e00 50%, #ff7600 100%);
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 9999px;
            transition: all 0.25s ease-in-out;
            box-shadow: 0 8px 20px -4px rgba(255, 84, 0, 0.42);
        }
        .btn-brand-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -4px rgba(255, 84, 0, 0.52);
            color: #ffffff !important;
        }
        .btn-brand-outline-light {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff !important;
            font-size: 12px;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.06);
            transition: all 0.25s ease;
        }
        .btn-brand-outline-light:hover {
            border-color: #ff5400;
            background: rgba(255, 84, 0, 0.2);
            color: #ffffff !important;
        }
        .section-dark-navy {
            background-color: #070d18 !important;
            color: #ffffff !important;
        }
        .testimonial-glass-card {
            background: rgba(255, 255, 255, 0.04) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .testimonial-nav-btn {
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #cbd5e1 !important;
            background: transparent !important;
        }
        .testimonial-nav-btn:hover {
            border-color: #ff5400 !important;
            color: #ffffff !important;
            background: rgba(255, 84, 0, 0.2) !important;
        }
        .pulse-play-ring {
            box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7);
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7); }
            70% { box-shadow: 0 0 0 18px rgba(255, 84, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 84, 0, 0); }
        }
        
        /* Dedicated Highlight Circle for Section 2 */
        .flycam-highlight-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 9999px;
            background-color: #ff5400 !important;
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
            transition: transform 0.2s ease;
        }
        .flycam-highlight-icon-circle:hover {
            transform: scale(1.08);
        }
        .flycam-highlight-icon-circle .material-symbols-outlined {
            font-size: 24px !important;
            color: #ffffff !important;
        }

        /* Drone Viewfinder Reticle Overlay */
        .drone-reticle-corner {
            position: absolute;
            width: 28px;
            height: 28px;
            border-color: rgba(255, 255, 255, 0.85);
            pointer-events: none;
        }
        .reticle-tl { top: 20px; left: 20px; border-top: 2.5px solid; border-left: 2.5px solid; }
        .reticle-tr { top: 20px; right: 20px; border-top: 2.5px solid; border-right: 2.5px solid; }
        .reticle-bl { bottom: 20px; left: 20px; border-bottom: 2.5px solid; border-left: 2.5px solid; }
        .reticle-br { bottom: 20px; right: 20px; border-bottom: 2.5px solid; border-right: 2.5px solid; }

        /* Step circle styling */
        .process-step-circle {
            width: 72px;
            height: 72px;
            border-radius: 9999px;
            border: 2px dashed rgba(255, 84, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            position: relative;
            transition: all 0.3s ease;
        }
        .process-step-circle:hover {
            border-color: #ff5400;
            border-style: solid;
            transform: translateY(-4px);
            box-shadow: 0 10px 20px -5px rgba(255, 84, 0, 0.2);
        }
        .process-step-badge {
            position: absolute;
            top: -6px;
            left: -6px;
            width: 26px;
            height: 26px;
            border-radius: 9999px;
            background-color: #ff5400 !important;
            color: #ffffff !important;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(255, 84, 0, 0.4);
        }

        /* Hero Banner Background */
        .hero-banner-flycam {
            background: linear-gradient(90deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 45%, rgba(255,255,255,0.15) 78%, rgba(255,255,255,0) 100%), 
                        url('{{ asset("images/quay-chup-flycam/hero_banner.jpg") }}');
            background-size: cover;
            background-position: right center;
            background-repeat: no-repeat;
        }
        @media (max-width: 1024px) {
            .hero-banner-flycam {
                background: linear-gradient(180deg, rgba(255,255,255,0.96) 0%, rgba(255,255,255,0.86) 60%, rgba(255,255,255,0.3) 100%), 
                            url('{{ asset("images/quay-chup-flycam/hero_banner.jpg") }}');
                background-position: center;
            }
        }

        /* Fallbacks */
        .bg-\[\#ff5400\] { background-color: #ff5400 !important; }
        .text-\[\#ff5400\] { color: #ff5400 !important; }
        .border-\[\#ff5400\] { border-color: #ff5400 !important; }
    </style>


    <!-- ==========================================
         SECTION 1: HERO BANNER (GÓC NHÌN TRÊN CAO)
         ========================================== -->
    <section class="relative pt-24 sm:pt-28 md:pt-36 pb-20 sm:pb-28 lg:pb-36 hero-banner-flycam overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Content Column -->
                <div class="lg:col-span-7 xl:col-span-6 space-y-6 pt-2">
                    <!-- Pill Tag -->
                    <div>
                        <span class="badge-flycam-pill">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                            DỊCH VỤ QUAY CHỤP FLYCAM
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <div class="space-y-1">
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-black text-[#070d18] tracking-tight leading-[1.15]">
                            Góc Nhìn Trên Cao
                        </h1>
                        <div class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-black text-[#ff5400] tracking-tight leading-[1.15]">
                            Kiến Tạo Giá Trị Khác Biệt
                        </div>
                    </div>

                    <!-- Description Text -->
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-xl font-normal">
                        Với công nghệ flycam hiện đại và đội ngũ quay phim chuyên nghiệp, chúng tôi mang đến những thước phim từ trên cao ấn tượng, độc đáo và đầy cảm xúc.
                    </p>

                    <!-- CTA Button -->
                    <div class="pt-2">
                        <a href="tel:0939363262" class="btn-brand-primary px-8 py-3.5 text-sm sm:text-base font-bold tracking-wide">
                            <span>Liên hệ tư vấn</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column (Spacer allowing Drone visual to shine through) -->
                <div class="hidden lg:block lg:col-span-5 xl:col-span-6 min-h-[340px]"></div>
            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 2: 5 FLOATING HIGHLIGHT CARDS
         ========================================== -->
    <section class="relative z-20 -mt-10 sm:-mt-14 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl shadow-slate-200/80 border border-slate-100 p-6 sm:p-7 lg:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-4 lg:divide-x lg:divide-slate-100">
                
                <!-- Item 1: Thiết bị hiện đại -->
                <div class="flex items-start gap-3.5 lg:pr-3">
                    <div class="flycam-highlight-icon-circle">
                        <span class="material-symbols-outlined">photo_camera</span>
                    </div>
                    <div>
                        <h2 class="text-sm font-extrabold text-[#070d18] tracking-tight">Thiết bị hiện đại</h2>
                        <p class="text-[11px] sm:text-xs text-slate-500 leading-snug mt-1">Sử dụng flycam đời mới, độ phân giải cao, ổn định.</p>
                    </div>
                </div>

                <!-- Item 2: Đội ngũ chuyên nghiệp -->
                <div class="flex items-start gap-3.5 lg:px-3">
                    <div class="flycam-highlight-icon-circle">
                        <span class="material-symbols-outlined">badge</span>
                    </div>
                    <div>
                        <h2 class="text-sm font-extrabold text-[#070d18] tracking-tight">Đội ngũ chuyên nghiệp</h2>
                        <p class="text-[11px] sm:text-xs text-slate-500 leading-snug mt-1">Pilot giàu kinh nghiệm, đảm bảo an toàn và chất lượng.</p>
                    </div>
                </div>

                <!-- Item 3: Chất lượng hình ảnh 4K -->
                <div class="flex items-start gap-3.5 lg:px-3">
                    <div class="flycam-highlight-icon-circle">
                        <span class="material-symbols-outlined">high_quality</span>
                    </div>
                    <div>
                        <h2 class="text-sm font-extrabold text-[#070d18] tracking-tight">Chất lượng hình ảnh 4K</h2>
                        <p class="text-[11px] sm:text-xs text-slate-500 leading-snug mt-1">Hình ảnh sắc nét, màu sắc sống động, chuẩn điện ảnh.</p>
                    </div>
                </div>

                <!-- Item 4: Thực hiện nhanh chóng -->
                <div class="flex items-start gap-3.5 lg:px-3">
                    <div class="flycam-highlight-icon-circle">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div>
                        <h2 class="text-sm font-extrabold text-[#070d18] tracking-tight">Thực hiện nhanh chóng</h2>
                        <p class="text-[11px] sm:text-xs text-slate-500 leading-snug mt-1">Lên kế hoạch linh hoạt, bàn giao đúng tiến độ.</p>
                    </div>
                </div>

                <!-- Item 5: An toàn tuyệt đối -->
                <div class="flex items-start gap-3.5 lg:pl-3">
                    <div class="flycam-highlight-icon-circle">
                        <span class="material-symbols-outlined">verified_user</span>
                    </div>
                    <div>
                        <h2 class="text-sm font-extrabold text-[#070d18] tracking-tight">An toàn tuyệt đối</h2>
                        <p class="text-[11px] sm:text-xs text-slate-500 leading-snug mt-1">Đảm bảo an toàn bay, đúng quy định hàng không.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 3: VỀ DỊCH VỤ CỦA CHÚNG TÔI
         ========================================== -->
    <section class="py-16 sm:py-24 bg-white relative overflow-hidden" id="ve-dich-vu">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Left Column -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="badge-flycam-pill">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                            DỊCH VỤ CỦA CHÚNG TÔI
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#070d18] leading-tight tracking-tight">
                        Quay Chụp Flycam <br>
                        <span class="text-[#ff5400]">Cho Mọi Nhu Cầu Doanh Nghiệp</span>
                    </h2>

                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Từ quảng bá thương hiệu, giới thiệu dự án, đến lưu giữ khoảnh khắc đặc biệt, dịch vụ quay chụp flycam của chúng tôi luôn mang đến những góc nhìn mới lạ và ấn tượng nhất.
                    </p>

                    <!-- Feature Checkpoints with Orange Checkmarks -->
                    <div class="space-y-3 pt-1 pb-2">
                        <div class="flex items-center gap-3 text-slate-700 text-sm font-semibold">
                            <span class="material-symbols-outlined text-[#ff5400] text-lg font-bold shrink-0">check</span>
                            <span>Quay phim dự án, bất động sản</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-700 text-sm font-semibold">
                            <span class="material-symbols-outlined text-[#ff5400] text-lg font-bold shrink-0">check</span>
                            <span>Quảng bá du lịch, sự kiện</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-700 text-sm font-semibold">
                            <span class="material-symbols-outlined text-[#ff5400] text-lg font-bold shrink-0">check</span>
                            <span>Video quảng cáo, TVC</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-700 text-sm font-semibold">
                            <span class="material-symbols-outlined text-[#ff5400] text-lg font-bold shrink-0">check</span>
                            <span>Chụp ảnh flycam theo yêu cầu</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-2">
                        <a href="#du-an-tieu-bieu" class="btn-brand-primary px-7 py-3 text-sm font-bold">
                            <span>Xem các dự án đã thực hiện</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Video Box with Drone Viewfinder Corners -->
                <div class="lg:col-span-6">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group cursor-pointer bg-slate-900 border border-slate-100"
                         @click="openVideo('Quay Chụp Flycam Cửu Long Media - Góc Nhìn Điện Ảnh', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        
                        <!-- Coastal Drone Landscape Image -->
                        <img src="{{ asset('images/quay-chup-flycam/service_video_thumb.jpg') }}" 
                             alt="Góc nhìn flycam bờ biển và thiên nhiên" 
                             class="w-full h-[320px] sm:h-[400px] object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <!-- Subtle Dark Vignette -->
                        <div class="absolute inset-0 bg-slate-900/15 group-hover:bg-slate-900/25 transition-colors"></div>

                        <!-- Drone Reticle Corners (4 White Corner Marks) -->
                        <div class="drone-reticle-corner reticle-tl"></div>
                        <div class="drone-reticle-corner reticle-tr"></div>
                        <div class="drone-reticle-corner reticle-bl"></div>
                        <div class="drone-reticle-corner reticle-br"></div>

                        <!-- Center Play Button with Frosted Glass Ring -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/20 backdrop-blur-md border border-white/60 flex items-center justify-center text-white shadow-2xl pulse-play-ring group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl sm:text-4xl text-white translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 4: DỰ ÁN TIÊU BIỂU (DARK NAVY)
         ========================================== -->
    <section class="py-16 sm:py-24 section-dark-navy relative overflow-hidden" id="du-an-tieu-bieu" style="background-color: #070d18 !important; color: #ffffff !important;">
        <!-- Ambient background lights -->
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full blur-3xl pointer-events-none" style="background-color: rgba(255, 84, 0, 0.08);"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full blur-3xl pointer-events-none" style="background-color: rgba(37, 99, 235, 0.08);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 sm:mb-14">
                <div class="space-y-3">
                    <div>
                        <span class="badge-flycam-dark-pill">
                            ★ DỰ ÁN TIÊU BIỂU
                        </span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight">
                        Những Thước Phim Flycam Ấn Tượng
                    </h2>
                    <p class="text-slate-400 text-sm max-w-xl">
                        Khám phá các dự án flycam tiêu biểu mà chúng tôi đã thực hiện.
                    </p>
                </div>

                <div>
                    <a href="{{ route('projects.index') }}" class="btn-brand-outline-light">
                        <span>Xem thêm dự án</span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- 4 Showcase Project Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Project 1: Du lịch biển đảo -->
                <div class="group relative rounded-2xl overflow-hidden shadow-lg border border-white/10 cursor-pointer bg-slate-900"
                     @click="openVideo('Flycam Du Lịch Biển Đảo Việt Nam', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                    <img src="{{ asset('images/quay-chup-flycam/project_coastal.jpg') }}" 
                         alt="Du lịch biển đảo" 
                         class="w-full h-56 sm:h-64 object-cover object-center group-hover:scale-108 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    
                    <!-- Bottom Pill Tag -->
                    <div class="absolute bottom-3.5 left-3.5 right-3.5">
                        <span class="inline-block px-3 py-1.5 rounded-full text-xs font-bold text-white bg-black/60 backdrop-blur-md border border-white/20">
                            Du lịch biển đảo
                        </span>
                    </div>

                    <!-- Hover Play Icon Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                        </div>
                    </div>
                </div>

                <!-- Project 2: Sự kiện & lễ hội -->
                <div class="group relative rounded-2xl overflow-hidden shadow-lg border border-white/10 cursor-pointer bg-slate-900"
                     @click="openVideo('Flycam Toàn Cảnh Lễ Hội Sông Nước', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                    <img src="{{ asset('images/quay-chup-flycam/project_event.jpg') }}" 
                         alt="Sự kiện & lễ hội" 
                         class="w-full h-56 sm:h-64 object-cover object-center group-hover:scale-108 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    
                    <div class="absolute bottom-3.5 left-3.5 right-3.5">
                        <span class="inline-block px-3 py-1.5 rounded-full text-xs font-bold text-white bg-black/60 backdrop-blur-md border border-white/20">
                            Sự kiện &amp; lễ hội
                        </span>
                    </div>

                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                        </div>
                    </div>
                </div>

                <!-- Project 3: Bất động sản -->
                <div class="group relative rounded-2xl overflow-hidden shadow-lg border border-white/10 cursor-pointer bg-slate-900"
                     @click="openVideo('Flycam Dự Án Bất Động Sản Ven Sông', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                    <img src="{{ asset('images/quay-chup-flycam/project_realestate.jpg') }}" 
                         alt="Bất động sản" 
                         class="w-full h-56 sm:h-64 object-cover object-center group-hover:scale-108 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    
                    <div class="absolute bottom-3.5 left-3.5 right-3.5">
                        <span class="inline-block px-3 py-1.5 rounded-full text-xs font-bold text-white bg-black/60 backdrop-blur-md border border-white/20">
                            Bất động sản
                        </span>
                    </div>

                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                        </div>
                    </div>
                </div>

                <!-- Project 4: Nông nghiệp & nông thôn -->
                <div class="group relative rounded-2xl overflow-hidden shadow-lg border border-white/10 cursor-pointer bg-slate-900"
                     @click="openVideo('Flycam Nông Nghiệp Sinh Thái Miền Tây', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                    <img src="{{ asset('images/quay-chup-flycam/project_agriculture.jpg') }}" 
                         alt="Nông nghiệp & nông thôn" 
                         class="w-full h-56 sm:h-64 object-cover object-center group-hover:scale-108 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    
                    <div class="absolute bottom-3.5 left-3.5 right-3.5">
                        <span class="inline-block px-3 py-1.5 rounded-full text-xs font-bold text-white bg-black/60 backdrop-blur-md border border-white/20">
                            Nông nghiệp &amp; nông thôn
                        </span>
                    </div>

                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 5: QUY TRÌNH THỰC HIỆN (4 BƯỚC)
         ========================================== -->
    <section class="py-16 sm:py-24 bg-white relative overflow-hidden" id="quy-trinh">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-14 sm:mb-18 space-y-3">
                <div>
                    <span class="badge-flycam-pill">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                        QUY TRÌNH THỰC HIỆN
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#070d18] tracking-tight">
                    Đơn Giản 4 Bước
                </h2>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Chúng tôi luôn tối ưu quy trình để mang đến trải nghiệm tốt nhất và đảm bảo chất lượng cho từng dự án.
                </p>
            </div>

            <!-- 4 Steps Flow with Chevron Dividers -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6 relative">
                
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center p-6 rounded-2xl hover:bg-slate-50/80 transition-colors relative">
                    <div class="process-step-circle mb-5">
                        <span class="process-step-badge">01</span>
                        <span class="material-symbols-outlined text-3xl text-[#ff5400]">chat_bubble_outline</span>
                    </div>
                    <h3 class="text-base font-extrabold text-[#070d18] tracking-tight">Tư vấn &amp; báo giá</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mt-2 max-w-[210px]">Tiếp nhận yêu cầu, tư vấn giải pháp phù hợp.</p>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center p-6 rounded-2xl hover:bg-slate-50/80 transition-colors relative">
                    <div class="process-step-circle mb-5">
                        <span class="process-step-badge">02</span>
                        <span class="material-symbols-outlined text-3xl text-[#ff5400]">map</span>
                    </div>
                    <h3 class="text-base font-extrabold text-[#070d18] tracking-tight">Lên kế hoạch</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mt-2 max-w-[210px]">Khảo sát địa điểm, xây dựng kịch bản chi tiết.</p>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center p-6 rounded-2xl hover:bg-slate-50/80 transition-colors relative">
                    <div class="process-step-circle mb-5">
                        <span class="process-step-badge">03</span>
                        <!-- Stylized Drone Icon -->
                        <span class="material-symbols-outlined text-3xl text-[#ff5400]">flight_takeoff</span>
                    </div>
                    <h3 class="text-base font-extrabold text-[#070d18] tracking-tight">Thực hiện quay chụp</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mt-2 max-w-[210px]">Sử dụng thiết bị hiện đại, đảm bảo an toàn.</p>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col items-center text-center p-6 rounded-2xl hover:bg-slate-50/80 transition-colors relative">
                    <div class="process-step-circle mb-5">
                        <span class="process-step-badge">04</span>
                        <span class="material-symbols-outlined text-3xl text-[#ff5400]">video_settings</span>
                    </div>
                    <h3 class="text-base font-extrabold text-[#070d18] tracking-tight">Hậu kỳ &amp; bàn giao</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mt-2 max-w-[210px]">Chỉnh sửa chuyên nghiệp, giao sản phẩm đúng hẹn.</p>
                </div>

            </div>

        </div>
    </section>


    <!-- ==========================================
         SECTION 6: ĐÁNH GIÁ TỪ KHÁCH HÀNG (DARK TESTIMONIAL)
         ========================================== -->
    <section class="py-16 sm:py-24 section-dark-navy relative overflow-hidden" id="danh-gia" style="background-color: #070d18 !important; color: #ffffff !important;">
        <!-- Ambient background lights -->
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full blur-3xl pointer-events-none" style="background-color: rgba(255, 84, 0, 0.1);"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full blur-3xl pointer-events-none" style="background-color: rgba(37, 99, 235, 0.1);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left Column (approx 4 cols) -->
                <div class="lg:col-span-4 space-y-4">
                    <div>
                        <span class="badge-flycam-dark-pill">
                            ★ KHÁCH HÀNG NÓI GÌ
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight leading-tight text-white">
                        Đánh Giá Từ Khách Hàng
                    </h2>

                    <p class="text-sm leading-relaxed text-slate-400">
                        Sự hài lòng của khách hàng là động lực để chúng tôi không ngừng hoàn thiện.
                    </p>

                    <div class="pt-2">
                        <a href="tel:0939363262" class="btn-brand-primary px-6 py-3 text-sm">
                            <span>Xem thêm đánh giá</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Center Column: Testimonial Card (approx 5 cols) -->
                <div class="lg:col-span-5 relative">
                    <div class="testimonial-glass-card rounded-3xl p-6 sm:p-8 relative">
                        <!-- Quotation icon -->
                        <div class="text-4xl sm:text-5xl font-serif leading-none mb-3 text-[#ff5400]">
                            “
                        </div>

                        <!-- Quote content -->
                        <p class="text-sm sm:text-base leading-relaxed italic min-h-[96px] text-slate-200"
                           x-text="'“' + testimonials[activeTestimonial].quote + '”'">
                            “Video flycam của Truyền Thông Cửu Long thật sự ấn tượng! Góc quay đẹp, sắc nét, thể hiện rõ tinh thần của sự kiện. Đội ngũ làm việc chuyên nghiệp, đúng tiến độ. Chắc chắn chúng tôi sẽ hợp tác lâu dài!”
                        </p>

                        <!-- Nav arrows & Author -->
                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-white/10">
                            <div class="flex items-center gap-3">
                                <!-- Avatar initials -->
                                <div class="w-10 h-10 rounded-full font-bold flex items-center justify-center text-sm shadow-md bg-[#ff5400] text-white"
                                     x-text="testimonials[activeTestimonial].avatar">
                                    VH
                                </div>
                                <div>
                                    <div class="font-extrabold text-sm text-white" x-text="testimonials[activeTestimonial].name">Anh Lê Văn Hòa</div>
                                    <div class="text-xs text-slate-400" x-text="testimonials[activeTestimonial].role">Giám đốc Marketing</div>
                                </div>
                            </div>

                            <!-- Prev / Next arrows -->
                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        @click="prevTestimonial()" 
                                        class="w-8 h-8 rounded-full testimonial-nav-btn flex items-center justify-center transition-all"
                                        aria-label="Previous testimonial">
                                    <span class="material-symbols-outlined text-base">chevron_left</span>
                                </button>
                                <button type="button" 
                                        @click="nextTestimonial()" 
                                        class="w-8 h-8 rounded-full testimonial-nav-btn flex items-center justify-center transition-all"
                                        aria-label="Next testimonial">
                                    <span class="material-symbols-outlined text-base">chevron_right</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Dots -->
                    <div class="flex items-center justify-center gap-2 mt-4">
                        <template x-for="(t, index) in testimonials" :key="index">
                            <button type="button" 
                                    @click="activeTestimonial = index"
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :style="(activeTestimonial === index) ? 'width: 24px; background-color: #ff5400 !important;' : 'width: 8px; background-color: rgba(255, 255, 255, 0.25) !important;'">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Right Column: 3 Video Thumbnails with Play button (approx 3 cols) -->
                <div class="lg:col-span-3 space-y-3.5">
                    <!-- Thumb 1 -->
                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer border border-white/10 shadow-lg"
                         @click="openVideo('Flycam Toàn Cảnh Vịnh Đảo Biển', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        <img src="{{ asset('images/quay-chup-flycam/service_video_thumb.jpg') }}" 
                             alt="Flycam bãi biển" 
                             class="w-full h-24 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/40 transition-colors flex items-center justify-center">
                            <div class="w-9 h-9 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>

                    <!-- Thumb 2 -->
                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer border border-white/10 shadow-lg"
                         @click="openVideo('Flycam Thành Phố Hoàng Hôn', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        <img src="{{ asset('images/quay-chup-flycam/project_realestate.jpg') }}" 
                             alt="Flycam đô thị hoàng hôn" 
                             class="w-full h-24 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/40 transition-colors flex items-center justify-center">
                            <div class="w-9 h-9 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>

                    <!-- Thumb 3 -->
                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer border border-white/10 shadow-lg"
                         @click="openVideo('Flycam Cánh Đồng Sinh Thái Miền Tây', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
                        <img src="{{ asset('images/quay-chup-flycam/project_agriculture.jpg') }}" 
                             alt="Flycam nông nghiệp miền Tây" 
                             class="w-full h-24 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/40 transition-colors flex items-center justify-center">
                            <div class="w-9 h-9 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SECTION 7: CTA BANNER (ORANGE SUNSET)
         ========================================== -->
    <section class="relative py-12 sm:py-16 overflow-hidden" 
             style="background: linear-gradient(90deg, rgba(235, 75, 0, 0.95) 0%, rgba(245, 95, 0, 0.88) 50%, rgba(255, 120, 0, 0.85) 100%), url('{{ asset("images/quay-chup-flycam/cta_banner_bg.jpg") }}'); background-size: cover; background-position: center;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <!-- Text on Left -->
                <div class="space-y-1.5 text-center md:text-left">
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-white tracking-tight">
                        Bạn đang cần một video flycam chuyên nghiệp?
                    </h2>
                    <p class="text-white/90 text-xs sm:text-sm font-medium">
                        Hãy liên hệ ngay với chúng tôi để được tư vấn và báo giá chi tiết nhất!
                    </p>
                </div>

                <!-- Call Button on Right -->
                <div class="shrink-0">
                    <a href="tel:0939363262" 
                       class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-full bg-white text-[#ff5400] font-black text-base shadow-xl hover:bg-orange-50 hover:scale-105 transition-all">
                        <span class="material-symbols-outlined text-xl text-[#ff5400]">call</span>
                        <span>0939.363.262</span>
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         MODAL: VIDEO PLAYER POPUP
         ========================================== -->
    <div x-show="videoModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         @keydown.escape.window="closeVideo()">
        
        <div class="relative w-full max-w-4xl bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-white/10"
             @click.away="closeVideo()">
            <!-- Top bar -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-white/10 bg-slate-900/80">
                <h3 class="font-bold text-white text-sm sm:text-base line-clamp-1" x-text="videoTitle">Xem Video Flycam</h3>
                <button type="button" 
                        @click="closeVideo()" 
                        class="w-9 h-9 rounded-full bg-white/10 text-white flex items-center justify-center hover:bg-white/20 transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <!-- Video iframe -->
            <div class="aspect-video w-full bg-black">
                <template x-if="videoModal && videoUrl">
                    <iframe :src="videoUrl" 
                            class="w-full h-full border-0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </template>
            </div>
        </div>
    </div>

</div>
@endsection
