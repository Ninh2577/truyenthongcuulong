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
    activeShowcase: 0,
    showcases: [
        {
            title: 'Sài Gòn Từ Trên Cao',
            desc: 'Khám phá vẻ đẹp hiện đại và sôi động của thành phố',
            duration: '04:32',
            badge: 'DỰ ÁN TIÊU BIỂU',
            thumb: '{{ asset("images/quay-chup-flycam/flycam_real_showcase_bg.png") }}',
            videoUrl: 'https://www.youtube.com/embed/iB1MWOvOo6g'
        },
        {
            title: 'Vịnh Hạ Long',
            desc: 'Kỳ quan thiên nhiên thế giới',
            duration: '03:15',
            badge: 'DANH THẮNG QUỐC GIA',
            thumb: '{{ asset("images/quay-chup-flycam/project_coastal.jpg") }}',
            videoUrl: 'https://www.youtube.com/embed/iB1MWOvOo6g'
        },
        {
            title: 'Tây Bắc Mùa Lúa Chín',
            desc: 'Vẻ đẹp hoang sơ và hùng vĩ',
            duration: '02:40',
            badge: 'DU LỊCH SINH THÁI',
            thumb: '{{ asset("images/quay-chup-flycam/project_agriculture.jpg") }}',
            videoUrl: 'https://www.youtube.com/embed/iB1MWOvOo6g'
        },
        {
            title: 'Đà Nẵng Thành Phố Biển',
            desc: 'Năng động và hiện đại',
            duration: '03:20',
            badge: 'ĐÔ THỊ ĐÁNG SỐNG',
            thumb: '{{ asset("images/quay-chup-flycam/project_realestate.jpg") }}',
            videoUrl: 'https://www.youtube.com/embed/iB1MWOvOo6g'
        }
    ],
    nextShowcase() {
        this.activeShowcase = (this.activeShowcase + 1) % this.showcases.length;
    },
    prevShowcase() {
        this.activeShowcase = (this.activeShowcase - 1 + this.showcases.length) % this.showcases.length;
    },
    selectShowcase(idx) {
        this.activeShowcase = idx;
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
                <div class="lg:col-span-8 xl:col-span-7 space-y-6 pt-2">
                    <!-- Pill Tag -->
                    <div>
                        <span class="badge-flycam-pill">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                            DỊCH VỤ QUAY CHỤP FLYCAM
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <div>
                        <h1 class="font-black tracking-tight" style="line-height: 1.34;">
                            <span class="block text-3xl sm:text-4xl md:text-5xl lg:text-[46px] xl:text-[50px] text-[#070d18]">
                                Góc Nhìn Trên Cao
                            </span>
                            <span class="block text-3xl sm:text-4xl md:text-5xl lg:text-[46px] xl:text-[50px] text-[#ff5400] mt-2 sm:mt-2.5">
                                <span class="inline-block whitespace-nowrap">Kiến Tạo</span> <span class="inline-block whitespace-nowrap">Giá Trị Khác Biệt</span>
                            </span>
                        </h1>
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
                <div class="hidden lg:block lg:col-span-4 xl:col-span-5 min-h-[340px]"></div>
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
                        <a href="{{ route('projects.media') }}" class="btn-brand-primary px-7 py-3 text-sm font-bold">
                            <span>Xem các dự án đã thực hiện</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Video Box with Drone Viewfinder Corners -->
                <div class="lg:col-span-6">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group cursor-pointer bg-slate-900 border border-slate-100"
                         @click="openVideo('Dịch Vụ Quay Chụp Flycam Chuyên Nghiệp - Truyền Thông Cửu Long', 'https://www.youtube.com/embed/iB1MWOvOo6g?autoplay=1')">
                        
                        <!-- Video Thumbnail -->
                        <img src="{{ asset('images/quay-chup-flycam/video_flycam_thumb.jpg') }}?v=1" 
                             onerror="this.onerror=null; this.src='https://img.youtube.com/vi/iB1MWOvOo6g/hqdefault.jpg';"
                             alt="Dịch vụ quay chụp flycam chuyên nghiệp Truyền Thông Cửu Long" 
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
         SECTION 6: HÌNH ẢNH THỰC TẾ TỪ DỰ ÁN (FLYCAM SHOWCASE)
         ========================================== -->
    <section class="py-16 sm:py-20 lg:py-24 relative overflow-hidden bg-slate-100" id="danh-gia">
        
        <!-- Background Panoramic Drone Sunset Photo with Left Gradient Fade -->
        <div class="absolute inset-0 z-0 select-none pointer-events-none">
            <img src="{{ asset('images/quay-chup-flycam/flycam_real_showcase_bg.png') }}" 
                 alt="Flycam thực tế dự án Cửu Long Media" 
                 class="w-full h-full object-cover object-[center_right]">
            <!-- Left side gradient overlay for high contrast and readability -->
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/95 sm:via-white/85 to-white/30 lg:to-transparent"></div>
            <!-- Top & Bottom subtle fade -->
            <div class="absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-white/70 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white/70 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left Column (approx 5 cols): Heading & Features -->
                <div class="lg:col-span-5 space-y-5">
                    
                    <!-- Top Pill Tag -->
                    <div>
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-orange-300 bg-white/95 backdrop-blur-sm text-[11px] font-extrabold text-slate-800 tracking-wider uppercase shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ff5400]"></span>
                            <span>HÌNH ẢNH THỰC TẾ TỪ DỰ ÁN</span>
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <div>
                        <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight leading-[1.18] text-slate-900">
                            Khoảnh Khắc Thực Tế<br>
                            <span class="text-[#ff5400]">Từ Trên Cao</span>
                        </h2>
                        <!-- Small orange accent bar -->
                        <div class="w-12 h-1 bg-[#ff5400] rounded-full mt-3"></div>
                    </div>

                    <!-- Description Paragraph -->
                    <p class="text-sm sm:text-[14.5px] leading-relaxed text-slate-600 max-w-md">
                        Cùng khám phá những thước phim và hình ảnh flycam chất lượng cao, được thực hiện bởi đội ngũ Cửu Long Media trong các dự án thực tế.
                    </p>

                    <!-- 3 Feature Badges in a Row with dividers -->
                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 sm:gap-4 pt-2">
                        <!-- Feature 1 -->
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-[#ff5400] text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/25">
                                <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                            </div>
                            <div>
                                <div class="font-extrabold text-xs text-slate-900 leading-tight">Hình ảnh 4K</div>
                                <div class="text-[10.5px] text-slate-500 leading-tight mt-0.5">Sắc nét, chân thực</div>
                            </div>
                        </div>

                        <div class="hidden sm:block w-px h-8 bg-slate-300/80"></div>

                        <!-- Feature 2 -->
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-orange-100 text-[#ff5400] border border-orange-200 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[18px]">flight</span>
                            </div>
                            <div>
                                <div class="font-extrabold text-xs text-slate-900 leading-tight">Thiết bị hiện đại</div>
                                <div class="text-[10.5px] text-slate-500 leading-tight mt-0.5">Flycam chuyên nghiệp</div>
                            </div>
                        </div>

                        <div class="hidden sm:block w-px h-8 bg-slate-300/80"></div>

                        <!-- Feature 3 -->
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-orange-100 text-[#ff5400] border border-orange-200 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[18px]">verified_user</span>
                            </div>
                            <div>
                                <div class="font-extrabold text-xs text-slate-900 leading-tight">Đội ngũ chuyên nghiệp</div>
                                <div class="text-[10.5px] text-slate-500 leading-tight mt-0.5">Kinh nghiệm thực chiến</div>
                            </div>
                        </div>
                    </div>

                    <!-- Orange Pill CTA Button -->
                    <div class="pt-2">
                        <a href="{{ route('projects.media') }}" 
                           class="inline-flex items-center gap-2 px-7 py-3 rounded-full text-white font-extrabold text-sm shadow-xl shadow-orange-500/35 hover:scale-105 hover:shadow-orange-500/50 transition-all duration-300"
                           style="background: linear-gradient(135deg, #ff5400 0%, #ff7600 100%);">
                            <span>Xem thêm dự án</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>

                </div>

                <!-- Right Side (7 cols): Main Featured Video Card & 3 Playlist Cards -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 lg:gap-5 items-stretch">
                        
                        <!-- Center Featured Video Card (7 of 12 cols) -->
                        <div class="md:col-span-7 flex flex-col">
                            <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/60 group cursor-pointer aspect-[4/3] bg-slate-900 flex-1"
                                 @click="openVideo(showcases[activeShowcase].title, showcases[activeShowcase].videoUrl)">
                                
                                <!-- Thumbnail Image -->
                                <img :src="showcases[activeShowcase].thumb" 
                                     :alt="showcases[activeShowcase].title" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-black/20 group-hover:from-slate-950/90 transition-colors"></div>

                                <!-- Top-left Orange Badge -->
                                <div class="absolute top-3.5 left-3.5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#ff5400] text-white text-[10.5px] font-black uppercase tracking-wider shadow-md">
                                        <span class="material-symbols-outlined text-[13px]">video_camera_front</span>
                                        <span x-text="showcases[activeShowcase].badge">DỰ ÁN TIÊU BIỂU</span>
                                    </span>
                                </div>

                                <!-- Center Play Button with Frosted Ring & Glow -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full bg-white/20 backdrop-blur-md p-1.5 flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-300">
                                        <div class="w-full h-full rounded-full bg-[#ff5400] flex items-center justify-center text-white shadow-lg shadow-orange-500/50">
                                            <span class="material-symbols-outlined text-2xl sm:text-3xl translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bottom Captions & Duration -->
                                <div class="absolute bottom-0 inset-x-0 p-4 sm:p-5 flex items-end justify-between gap-3 text-white">
                                    <div class="min-w-0">
                                        <h3 class="font-black text-base sm:text-lg leading-snug line-clamp-1 group-hover:text-orange-300 transition-colors"
                                            x-text="showcases[activeShowcase].title">
                                            Sài Gòn Từ Trên Cao
                                        </h3>
                                        <p class="text-xs text-slate-300 line-clamp-1 mt-0.5"
                                           x-text="showcases[activeShowcase].desc">
                                            Khám phá vẻ đẹp hiện đại và sôi động của thành phố
                                        </p>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-sm text-white/90 text-[11px] font-bold shrink-0 flex items-center gap-1 border border-white/10">
                                        <span class="material-symbols-outlined text-[13px] text-orange-400">schedule</span>
                                        <span x-text="showcases[activeShowcase].duration">04:32</span>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <!-- Right Playlist Column (5 of 12 cols): 3 Video Cards -->
                        <div class="md:col-span-5 flex flex-col justify-between gap-3">
                            
                            <!-- Video 1: Vịnh Hạ Long -->
                            <div @click="selectShowcase(1); openVideo(showcases[1].title, showcases[1].videoUrl)"
                                 class="flex items-center gap-3 p-2.5 rounded-2xl bg-white/85 hover:bg-white backdrop-blur-md border border-white/80 shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer group">
                                <div class="relative w-24 h-16 rounded-xl overflow-hidden shrink-0 bg-slate-900 shadow-sm">
                                    <img src="{{ asset('images/quay-chup-flycam/project_coastal.jpg') }}" alt="Vịnh Hạ Long" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                        <div class="w-6 h-6 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-[15px] translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                        </div>
                                    </div>
                                    <span class="absolute bottom-1 right-1 px-1.5 py-0.2 rounded bg-black/70 text-[9px] font-bold text-white">03:15</span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-extrabold text-xs sm:text-[13px] text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1 leading-snug">Vịnh Hạ Long</h4>
                                    <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">Kỳ quan thiên nhiên thế giới</p>
                                    <div class="w-5 h-0.5 bg-[#ff5400] rounded-full mt-1.5"></div>
                                </div>
                            </div>

                            <!-- Video 2: Tây Bắc Mùa Lúa Chín -->
                            <div @click="selectShowcase(2); openVideo(showcases[2].title, showcases[2].videoUrl)"
                                 class="flex items-center gap-3 p-2.5 rounded-2xl bg-white/85 hover:bg-white backdrop-blur-md border border-white/80 shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer group">
                                <div class="relative w-24 h-16 rounded-xl overflow-hidden shrink-0 bg-slate-900 shadow-sm">
                                    <img src="{{ asset('images/quay-chup-flycam/project_agriculture.jpg') }}" alt="Tây Bắc Mùa Lúa Chín" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                        <div class="w-6 h-6 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-[15px] translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                        </div>
                                    </div>
                                    <span class="absolute bottom-1 right-1 px-1.5 py-0.2 rounded bg-black/70 text-[9px] font-bold text-white">02:40</span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-extrabold text-xs sm:text-[13px] text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1 leading-snug">Tây Bắc Mùa Lúa Chín</h4>
                                    <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">Vẻ đẹp hoang sơ và hùng vĩ</p>
                                    <div class="w-5 h-0.5 bg-[#ff5400] rounded-full mt-1.5"></div>
                                </div>
                            </div>

                            <!-- Video 3: Đà Nẵng Thành Phố Biển -->
                            <div @click="selectShowcase(3); openVideo(showcases[3].title, showcases[3].videoUrl)"
                                 class="flex items-center gap-3 p-2.5 rounded-2xl bg-white/85 hover:bg-white backdrop-blur-md border border-white/80 shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer group">
                                <div class="relative w-24 h-16 rounded-xl overflow-hidden shrink-0 bg-slate-900 shadow-sm">
                                    <img src="{{ asset('images/quay-chup-flycam/project_realestate.jpg') }}" alt="Đà Nẵng Thành Phố Biển" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                        <div class="w-6 h-6 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-[15px] translate-x-0.5" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                        </div>
                                    </div>
                                    <span class="absolute bottom-1 right-1 px-1.5 py-0.2 rounded bg-black/70 text-[9px] font-bold text-white">03:20</span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-extrabold text-xs sm:text-[13px] text-slate-900 group-hover:text-[#ff5400] transition-colors line-clamp-1 leading-snug">Đà Nẵng Thành Phố Biển</h4>
                                    <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">Năng động và hiện đại</p>
                                    <div class="w-5 h-0.5 bg-[#ff5400] rounded-full mt-1.5"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Bottom Carousel Pagination Controls -->
                    <div class="flex items-center justify-center gap-3 mt-5">
                        <button type="button" 
                                @click="prevShowcase()" 
                                class="w-8 h-8 rounded-full bg-white/90 hover:bg-white text-slate-700 shadow-sm border border-slate-200 flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-base">chevron_left</span>
                        </button>
                        <div class="flex items-center gap-1.5">
                            <template x-for="(dot, dIdx) in showcases" :key="dIdx">
                                <button type="button" 
                                        @click="selectShowcase(dIdx)"
                                        class="h-1.5 rounded-full transition-all duration-300"
                                        :class="activeShowcase === dIdx ? 'w-5 bg-[#ff5400]' : 'w-1.5 bg-slate-300 hover:bg-slate-400'">
                                </button>
                            </template>
                        </div>
                        <button type="button" 
                                @click="nextShowcase()" 
                                class="w-8 h-8 rounded-full bg-white/90 hover:bg-white text-slate-700 shadow-sm border border-slate-200 flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </button>
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
