@extends('layouts.app')

@section('title', 'Sản Xuất Tư Liệu Hình Ảnh & Video Doanh Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Năng lực sản xuất tư liệu hình ảnh và video chuyên nghiệp bổ trợ cho nền tảng số: video giới thiệu, TVC ngắn và hình ảnh phục vụ website.')

@section('content')
<script>
    if (window.location.hash === '#chup-anh-su-kien' || window.location.hash === '#chup-anh') {
        window.location.replace('{{ route("services.event-photography") }}');
    }
</script>
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

<!-- ==================== HERO SECTION (GLOBAL BANNER HERO) ==================== -->
<x-banner.hero
    variant="media-visual"
    eyebrow="DIGITAL ECOSYSTEM SUPPORT • VISUAL ASSETS"
    title="Sản Xuất Tư Liệu Video"
    titleAccent="& Hình Ảnh Doanh Nghiệp"
    description="Năng lực sản xuất tư liệu hình ảnh và video chuyên nghiệp đóng vai trò bổ trợ chiến lược cho hệ sinh thái công nghệ: cung cấp hình ảnh thật, video giới thiệu quy trình vận hành và tư liệu đồng bộ cho Website & Web App."
    :breadcrumb="[
        ['label' => 'Dịch vụ & Giải pháp', 'url' => route('services.index')],
        ['label' => 'Tư liệu Media & Video']
    ]"
    :primaryCta="[
        'label' => 'Bắt đầu dự án',
        'url' => route('contact') . '?service=media',
        'icon' => 'arrow_forward'
    ]"
    :secondaryCta="[
        'label' => 'Xem điều phối ekip',
        'url' => route('booking'),
        'icon' => 'calendar_today'
    ]"
>
    <!-- Showreel Video Trigger Card inside Visual Slot -->
    <div class="relative w-full max-w-4xl mx-auto overflow-hidden rounded-2xl md:rounded-3xl border border-slate-200/90 shadow-lg bg-slate-900 aspect-video group cursor-pointer"
         @click="openVideo('https://www.youtube.com/embed/nGvVhO2kDo8?autoplay=1&rel=0&modestbranding=1')">
        <picture>
            <source srcset="{{ asset('images/showreel-cinematic-poster.webp') }}" type="image/webp">
            <img 
                src="{{ asset('images/showreel-cinematic-poster.jpg') }}" 
                alt="Showreel năng lực sản xuất Media Truyền Thông Cửu Long" 
                class="w-full h-full object-cover object-center group-hover:scale-102 transition-transform duration-500"
                loading="eager"
                fetchpriority="high"
                decoding="async"
            >
        </picture>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent flex items-center justify-center">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-primary/90 text-white flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:bg-primary transition-all duration-300">
                <span class="material-symbols-outlined text-[32px] sm:text-[40px] translate-x-0.5" aria-hidden="true">play_arrow</span>
            </div>
        </div>
        <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6 flex items-center justify-between text-white pointer-events-none">
            <div class="text-left">
                <span class="text-xs font-bold text-amber-400 uppercase tracking-wider block">SHOWREEL TƯ LIỆU NĂNG LỰC</span>
                <span class="text-sm sm:text-base font-bold">Thực tế sản xuất hình ảnh &amp; video doanh nghiệp</span>
            </div>
            <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/60 backdrop-blur-xs text-xs font-medium text-slate-200 border border-white/10">
                <span class="material-symbols-outlined text-[16px] text-amber-400">hd</span>
                <span>4K Showreel</span>
            </span>
        </div>
    </div>
</x-banner.hero>

<div class="w-full bg-[#f8f9ff] py-14 lg:py-20" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-14 lg:gap-18">

        <!-- ==================== CÁC NĂNG LỰC SẢN XUẤT ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Năng lực bổ trợ</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Tư Liệu Media Phục Vụ Nền Tảng Số
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Chuẩn thiết bị điện ảnh 4K</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Video -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-3">
                    <span class="text-xs font-bold text-primary">01</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Video Giới Thiệu &amp; TVC Ngắn</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sản xuất video giới thiệu năng lực doanh nghiệp, clip quy trình vận hành nhà máy hoặc hướng dẫn sử dụng sản phẩm/dịch vụ đưa lên trang chủ website.
                    </p>
                    <div class="text-xs text-slate-500 pt-2 border-t border-slate-100">
                        Định dạng: 4K UHD, tỷ lệ 16:9 và 9:16 tối ưu cho web và di động.
                    </div>
                </div>

                <!-- Photography -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-3">
                    <span class="text-xs font-bold text-primary">02</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Chụp Ảnh Cơ Sở &amp; Đội Ngũ</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Chụp ảnh chân dung nhân sự, ban lãnh đạo, văn phòng làm việc và hệ thống trang thiết bị thực tế, thay thế hoàn toàn ảnh stock rập khuôn.
                    </p>
                    <div class="text-xs text-slate-500 pt-2 border-t border-slate-100">
                        Độ phân giải cao, tối ưu dung lượng WebP tải trang nhanh.
                    </div>
                </div>

                <!-- Corporate Content -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-3">
                    <span class="text-xs font-bold text-primary">03</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Corporate Content &amp; Sự Kiện</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ghi hình hội nghị khách hàng, lễ ký kết đối tác, hoạt động đào tạo nội bộ nhằm bổ sung tư liệu thực chứng cho mục tin tức và hồ sơ năng lực.
                    </p>
                    <div class="text-xs text-slate-500 pt-2 border-t border-slate-100">
                        Ekip cơ động điều phối tác nghiệp tại Cần Thơ &amp; ĐBSCL.
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== ỨNG DỤNG TRONG DIGITAL ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tính tích hợp</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Ứng Dụng Tư Liệu Media Trong Hệ Sinh Thái Kỹ Thuật Số
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">ỨNG DỤNG 01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Banner Hero Website</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Video loop không tiếng hoặc ảnh panorama chất lượng cao làm nền trang chủ, gây ấn tượng thị giác chuyên nghiệp ngay lần đầu truy cập.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">ỨNG DỤNG 02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Hồ Sơ Năng Lực Số</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Nhúng video giới thiệu doanh nghiệp và hình ảnh dự án thực tế vào trang Profile trực tuyến gửi cho đối tác và khách hàng.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">ỨNG DỤNG 03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Web App Hướng Dẫn</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Video ngắn minh họa các bước thao tác, quy trình đặt lịch hoặc giải thích tính năng trong giao diện người dùng phần mềm.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">ỨNG DỤNG 04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Landing Page Quảng Cáo</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Hình ảnh chụp thật tăng tỷ lệ tin tưởng và chuyển đổi (CRO) khi chạy các chiến dịch Google Ads hoặc mạng xã hội.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== MỘT SỐ DỰ ÁN MEDIA TIÊU BIỂU ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Thực tế đã triển khai</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Dự Án Media Tiêu Biểu
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem tất cả dự án</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($mediaCaseStudies as $case)
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="aspect-video rounded-xl overflow-hidden bg-slate-100 relative">
                            @if($case->featured_image)
                                <img src="{{ asset('storage/' . $case->featured_image) }}" alt="{{ $case->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                    <span class="material-symbols-outlined text-4xl">movie</span>
                                </div>
                            @endif
                            @if($case->video_url)
                                <button type="button" @click="openVideo('{{ $case->video_url }}')" class="absolute inset-0 m-auto w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center shadow-md cursor-pointer hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[20px]">play_arrow</span>
                                </button>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <span class="text-[11px] font-semibold text-slate-400 block">{{ $case->client_name ?: 'Khách hàng' }}</span>
                            <h3 class="text-sm font-bold text-[#070f1e] line-clamp-1">{{ $case->title }}</h3>
                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $case->summary ?: 'Sản xuất tư liệu media chất lượng cao đồng bộ phục vụ truyền thông số.' }}
                            </p>
                        </div>
                    </div>
                    <div class="pt-3 mt-3 border-t border-slate-100">
                        <a href="{{ route('projects.show', $case->slug) }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Chi tiết dự án</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 p-6 text-center text-xs text-slate-500 bg-white rounded-xl border border-slate-200">
                    Đang cập nhật danh mục video tư liệu.
                </div>
                @endforelse
            </div>
        </section>

        <!-- ==================== FINAL CTA (GLOBAL BANNER CTA) ==================== -->
        <x-banner.cta
            variant="centered"
            badge="HỢP TÁC SẢN XUẤT"
            title="Sẵn Sàng Sản Xuất Tư Liệu Media Đồng Bộ Cho Doanh Nghiệp?"
            description="Trao đổi với chúng tôi về nhu cầu hình ảnh, video giới thiệu hoặc điều động ekip tác nghiệp để hoàn thiện tư liệu thương hiệu chuyên nghiệp nhất."
            :primaryCta="[
                'label' => 'Bắt đầu dự án',
                'url' => route('contact') . '?service=media',
                'icon' => 'arrow_forward'
            ]"
            :secondaryCta="[
                'label' => 'Xem điều phối ekip',
                'url' => route('booking'),
                'icon' => 'calendar_today'
            ]"
        />

    </x-ui.container>

    <!-- VIDEO MODAL -->
    <div x-show="videoModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md" style="display: none;">
        <div @click.outside="videoModal = false; currentVideoUrl = ''" class="w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl relative">
            <button type="button" @click="videoModal = false; currentVideoUrl = ''" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-white/20 text-white hover:bg-white/40 flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
            <iframe :src="currentVideoUrl" class="w-full h-full" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection
