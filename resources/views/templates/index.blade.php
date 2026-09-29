@extends('layouts.app')

@section('title', 'Thư Viện Nền Tảng Triển Khai Website Nhanh - Truyền Thông Cửu Long')
@section('meta_description', 'Thư viện nền tảng giao diện website chuẩn SEO theo ngành nghề, giúp doanh nghiệp rút ngắn thời gian chuẩn bị và triển khai nhanh chóng.')

@section('content')
<!-- ==================== HERO SECTION (GLOBAL BANNER HERO) ==================== -->
<x-banner.hero
    variant="service-centered"
    eyebrow="RAPID DEPLOYMENT PLATFORM • TIẾT KIỆM THỜI GIAN"
    title="Thư Viện Nền Tảng"
    titleAccent="Triển Khai Website Nhanh"
    description="Tập hợp các cấu trúc website được dựng sẵn theo từng ngành nghề kinh doanh thực tế, giúp doanh nghiệp rút ngắn thời gian khởi tạo, tối ưu chi phí ban đầu mà vẫn bảo đảm tiêu chuẩn kỹ thuật chuẩn SEO."
    :breadcrumb="[
        ['label' => 'Dịch vụ & Giải pháp', 'url' => route('services.index')],
        ['label' => 'Thư viện nền tảng website']
    ]"
    :primaryCta="[
        'label' => 'Khám phá thư viện',
        'url' => '#catalog',
        'icon' => 'explore'
    ]"
    :secondaryCta="[
        'label' => 'Tư vấn giải pháp',
        'url' => route('contact'),
        'icon' => 'arrow_forward'
    ]"
    class="!pt-24 !pb-8 lg:!pt-28 lg:!pb-10"
>
    <!-- Search Form & Metric Chips inside Hero Visual Slot -->
    <div class="flex flex-col items-center gap-4 w-full max-w-xl mx-auto">
        <form action="{{ route('templates.index') }}" method="GET" class="w-full">
            @if(request('industry'))
                <input type="hidden" name="industry" value="{{ request('industry') }}">
            @endif
            <div class="relative flex items-center shadow-lg shadow-navy-base/5 rounded-2xl bg-white border border-slate-200 focus-within:border-primary focus-within:ring-3 focus-within:ring-primary/20 transition-all">
                <span class="material-symbols-outlined absolute left-4 text-slate-400 text-[20px]">search</span>
                <input 
                    type="text" 
                    name="q" 
                    value="{{ request('q') }}" 
                    placeholder="Tìm theo tên ngành hoặc use-case..." 
                    class="w-full pl-12 pr-28 py-3.5 rounded-2xl bg-transparent text-slate-900 placeholder:text-slate-400 focus:outline-none text-xs sm:text-sm font-medium"
                >
                <button type="submit" class="absolute right-2 px-4 py-2 rounded-xl bg-primary hover:bg-orange-600 text-white text-xs font-bold transition-all shadow-xs flex items-center gap-1">
                    <span>Tìm kiếm</span>
                </button>
            </div>
        </form>

        <!-- Metric Highlights Strip -->
        <div class="flex flex-wrap items-center justify-center gap-2 text-[11px] font-semibold text-slate-600">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-slate-200/80 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>60+ Mẫu Giao Diện Sẵn Sàng</span>
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-slate-200/80 shadow-2xs">
                <span class="material-symbols-outlined text-[13px] text-primary">bolt</span>
                <span>Triển Khai 3–5 Ngày</span>
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-slate-200/80 shadow-2xs">
                <span class="material-symbols-outlined text-[13px] text-sky-600">check_circle</span>
                <span>Chuẩn SEO Google On-page</span>
            </span>
        </div>
    </div>
</x-banner.hero>

<div class="w-full bg-[#f8f9ff] py-10 lg:py-14" style="font-family: var(--font-primary);" x-data="{
    previewModal: false,
    previewTitle: '',
    previewSlug: '',
    previewImg: '',
    previewDevice: 'desktop',

    openPreview(title, slug, img) {
        this.previewTitle = title;
        this.previewSlug = slug;
        this.previewImg = img;
        this.previewDevice = 'desktop';
        this.previewModal = true;
    }
}">

    <x-ui.container class="flex flex-col gap-12 lg:gap-16">

        <!-- ==================== KHI NÀO NÊN DÙNG WEBSITE MẪU? ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Phù hợp nhu cầu</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Website Mẫu Dùng Cho Trường Hợp Nào?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">3 kịch bản ứng dụng tối ưu nhất</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 01: Khởi nghiệp -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-sky-300 transition-all flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 border border-sky-200/60 flex items-center justify-center text-sky-600 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[22px]">rocket_launch</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-sky-600 bg-sky-50 px-2.5 py-0.5 rounded-md">01</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] group-hover:text-sky-600 transition-colors">
                            Khởi nghiệp cần ra mắt gấp
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Doanh nghiệp mới thành lập cần có website chỉn chu trong vòng 3–5 ngày để gửi hồ sơ đối tác, in namecard và chạy chiến dịch tiếp thị đầu tiên.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-sky-800 bg-sky-50/80 px-2.5 py-1 rounded-lg">
                            <span class="material-symbols-outlined text-[13px]">schedule</span>
                            <span>Bàn giao &amp; vận hành trong 3–5 ngày</span>
                        </span>
                    </div>
                </div>

                <!-- Card 02: Tối ưu ngân sách -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-emerald-300 transition-all flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200/60 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[22px]">savings</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-md">02</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] group-hover:text-emerald-600 transition-colors">
                            Tối ưu ngân sách ban đầu
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Chưa cần đầu tư may đo phức tạp, muốn dành nguồn vốn cho hoạt động kinh doanh cốt lõi nhưng vẫn muốn sở hữu website ổn định và chuẩn SEO.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-emerald-800 bg-emerald-50/80 px-2.5 py-1 rounded-lg">
                            <span class="material-symbols-outlined text-[13px]">payments</span>
                            <span>Tiết kiệm đáng kể chi phí khởi tạo</span>
                        </span>
                    </div>
                </div>

                <!-- Card 03: Mô hình chuẩn ngành -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-300 transition-all flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200/60 flex items-center justify-center text-amber-600 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[22px]">domain_verification</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-md">03</span>
                        </div>
                        <h3 class="text-base font-bold text-[#070f1e] group-hover:text-amber-600 transition-colors">
                            Đã có mô hình chuẩn ngành
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Các ngành nghề như nhà hàng, nội thất, thời trang, phòng khám nha khoa có luồng bố cục tiêu chuẩn rõ ràng, chỉ cần thay thế dữ liệu và màu sắc nhận diện.
                        </p>
                    </div>
                    <div class="pt-3 mt-4 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-amber-800 bg-amber-50/80 px-2.5 py-1 rounded-lg">
                            <span class="material-symbols-outlined text-[13px]">category</span>
                            <span>Cấu trúc chuẩn theo từng ngành</span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== INDUSTRY FILTER PILLS (GOLDEN BEE STYLE) ==================== -->
        <section id="catalog" class="flex flex-col gap-4 scroll-mt-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-200 pb-3">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] text-primary">filter_list</span>
                    <span class="text-xs font-bold text-[#1A1A1B] uppercase tracking-wider font-mono">
                        LỌC THEO NGÀNH NGHỀ ({{ $industries->count() }} NHÓM NGÀNH)
                    </span>
                </div>
                @if($selectedIndustry || request('q'))
                <a href="{{ route('templates.index') }}" class="text-xs font-bold text-primary hover:underline flex items-center gap-1 w-fit">
                    <span class="material-symbols-outlined text-[15px]">restart_alt</span>
                    <span>Xóa bộ lọc (Xem tất cả)</span>
                </a>
                @endif
            </div>

            <div class="flex items-center gap-2.5 overflow-x-auto pb-3 pt-1 no-scrollbar">
                <a href="{{ route('templates.index') }}" 
                    class="inline-flex items-center gap-2 px-4 py-2 border-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap transition-all duration-200 {{ empty($selectedIndustry) ? 'border-primary bg-primary text-white shadow-md' : 'bg-white border-gray-200 text-gray-700 hover:border-primary hover:text-primary' }}">
                    <span class="material-symbols-outlined text-[16px]">apps</span>
                    <span>Tất cả</span>
                    <span class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[11px] font-bold rounded-full {{ empty($selectedIndustry) ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-600' }}">
                        {{ $totalCount ?? $templates->total() }}
                    </span>
                </a>
                @foreach($industries as $ind)
                @php
                    $isActive = $selectedIndustry === $ind->slug;
                    $count = $industryCounts[$ind->slug] ?? 0;
                @endphp
                <a href="{{ route('templates.index', ['industry' => $ind->slug]) }}" 
                    class="inline-flex items-center gap-2 px-4 py-2 border-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap transition-all duration-200 {{ $isActive ? 'border-primary bg-primary text-white shadow-md' : 'bg-white border-gray-200 text-gray-700 hover:border-primary hover:text-primary' }}">
                    <span>{{ $ind->name }}</span>
                    @if($count > 0)
                    <span class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[11px] font-bold rounded-full {{ $isActive ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-600' }}">
                        {{ $count }}
                    </span>
                    @endif
                </a>
                @endforeach
            </div>
        </section>

        <!-- ==================== TEMPLATE GALLERY (GOLDEN BEE STYLE) ==================== -->
        <section class="flex flex-col gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" role="list">
                @forelse($templates as $item)
                @php
                    $thumb = $item->thumbnail_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                    
                    // Dynamic Golden Bee style badges
                    $t = mb_strtolower($item->title . ' ' . $item->slug);
                    if (str_contains($t, 'bán hàng') || str_contains($t, 'shop') || str_contains($t, 'thời trang') || str_contains($t, 'mỹ phẩm') || str_contains($t, 'trang sức') || str_contains($t, 'bán lẻ') || str_contains($t, 'bánh ngọt') || str_contains($t, 'sách')) {
                        $badgeLabel = 'Thiết kế website bán hàng';
                    } elseif (str_contains($t, 'app') || str_contains($t, 'phần mềm') || str_contains($t, 'saas') || str_contains($t, 'công nghệ')) {
                        $badgeLabel = 'Giải pháp công nghệ số';
                    } elseif (str_contains($t, 'y tế') || str_contains($t, 'nha khoa') || str_contains($t, 'bệnh viện') || str_contains($t, 'phòng khám')) {
                        $badgeLabel = 'Thiết kế website y tế';
                    } elseif (str_contains($t, 'giáo dục') || str_contains($t, 'khóa học') || str_contains($t, 'trường') || str_contains($t, 'e-learning')) {
                        $badgeLabel = 'Website giáo dục đào tạo';
                    } else {
                        $badgeLabel = 'Thiết kế website doanh nghiệp';
                    }

                    if (str_contains($t, 'bất động sản') || str_contains($t, 'nhà đất') || str_contains($t, 'căn hộ')) {
                        $subTag = 'Bất động sản';
                    } elseif (str_contains($t, 'kiến trúc') || str_contains($t, 'nội thất') || str_contains($t, 'xây dựng')) {
                        $subTag = 'Kiến trúc & Nội thất';
                    } elseif (str_contains($t, 'nhà hàng') || str_contains($t, 'f&b') || str_contains($t, 'cà phê') || str_contains($t, 'ẩm thực') || str_contains($t, 'sushi')) {
                        $subTag = 'Nhà hàng & F&B';
                    } elseif (str_contains($t, 'du lịch') || str_contains($t, 'resort') || str_contains($t, 'khách sạn') || str_contains($t, 'tour')) {
                        $subTag = 'Du lịch & Khách sạn';
                    } elseif (str_contains($t, 'thời trang') || str_contains($t, 'trang sức') || str_contains($t, 'kính mắt')) {
                        $subTag = 'Thời trang & Phụ kiện';
                    } elseif (str_contains($t, 'y tế') || str_contains($t, 'nha khoa') || str_contains($t, 'thẩm mỹ') || str_contains($t, 'spa')) {
                        $subTag = 'Y tế & Sức khỏe';
                    } elseif (str_contains($t, 'giáo dục') || str_contains($t, 'khóa học') || str_contains($t, 'đào tạo')) {
                        $subTag = 'Giáo dục & Đào tạo';
                    } elseif (str_contains($t, 'công nghệ') || str_contains($t, 'phần mềm') || str_contains($t, 'saas')) {
                        $subTag = 'Công nghệ & Phần mềm';
                    } elseif (str_contains($t, 'ô tô') || str_contains($t, 'xe')) {
                        $subTag = 'Ô tô & Vận tải';
                    } elseif (str_contains($t, 'thủy hải sản') || str_contains($t, 'nông nghiệp') || str_contains($t, 'nông sản')) {
                        $subTag = 'Nông nghiệp & Thực phẩm';
                    } elseif (str_contains($t, 'luật') || str_contains($t, 'tài chính') || str_contains($t, 'kế toán')) {
                        $subTag = 'Tài chính & Pháp lý';
                    } else {
                        $subTag = 'Website bán hàng';
                    }
                @endphp
                <article class="group h-full" role="listitem">
                    <div class="relative h-full rounded-3xl overflow-hidden bg-white border-2 border-gray-200 hover:border-amber-400 hover:shadow-xl hover:shadow-amber-400/10 transition-all duration-300 flex flex-col">
                        <!-- Image Container (Flush aspect-video with gradient and floating badges) -->
                        <div class="relative aspect-video overflow-hidden bg-slate-900">
                            <img src="{{ $thumb }}" 
                                 alt="{{ $item->title }}" 
                                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 loading="lazy">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1A1A1B]/80 via-transparent to-transparent pointer-events-none"></div>

                            <!-- Top Right Status Badge: Hoàn thành (Green Pill) -->
                            <div class="absolute top-4 right-4 z-10">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#00c968] text-white font-bold rounded-full text-xs shadow-lg backdrop-blur-sm">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Hoàn thành</span>
                                </span>
                            </div>

                            <!-- Bottom Left Category Badge: Amber Pill Floating over Image -->
                            <div class="absolute bottom-4 left-4 z-10">
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-amber-400 text-slate-900 font-bold rounded-full text-xs shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                                    </svg>
                                    <span>{{ $badgeLabel }}</span>
                                </span>
                            </div>

                            <!-- Hover Overlay for Instant Preview -->
                            <div class="absolute inset-0 bg-slate-950/30 backdrop-blur-[2px] transition-opacity duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100 z-20">
                                <button type="button" @click="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $thumb }}')" class="px-4 py-2 rounded-xl bg-white text-slate-900 text-xs font-bold shadow-xl flex items-center gap-1.5 cursor-pointer hover:bg-slate-100 transition-all">
                                    <span class="material-symbols-outlined text-[16px] text-primary">visibility</span>
                                    <span>Xem bản mẫu</span>
                                </button>
                            </div>
                        </div>

                        <!-- Card Body (p-6 flex-1 flex flex-col) -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Title -->
                            <h3 class="text-lg md:text-xl font-bold text-[#1A1A1B] mb-3 leading-tight group-hover:text-primary transition-colors line-clamp-2 cursor-pointer" @click="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $thumb }}')">
                                {{ $item->title }}
                            </h3>

                            <!-- Excerpt / Summary -->
                            <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed flex-1">
                                {{ $item->summary ?: 'Bố cục hiện đại, chuẩn UI/UX, tích hợp biểu mẫu chuyển đổi và tối ưu hiển thị đa thiết bị.' }}
                            </p>

                            <!-- Footer (border-t border-gray-200 pt-4 mt-auto) -->
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4 mt-auto">
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium hover:bg-amber-400 hover:text-slate-950 transition-colors">
                                        {{ $subTag }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-3">
                                    <button type="button" aria-label="Xem trước {{ $item->title }}" @click="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $thumb }}')" class="flex items-center gap-1.5 text-primary hover:text-orange-600 font-semibold text-sm group-hover:gap-2.5 transition-all cursor-pointer">
                                        <span>Xem thêm</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-1 md:col-span-3 text-center py-16 bg-white rounded-3xl border-2 border-gray-200">
                    <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">dashboard</span>
                    <h3 class="text-base font-bold text-[#1A1A1B]">Không tìm thấy mẫu phù hợp</h3>
                    <p class="text-xs text-slate-500 mt-1">Vui lòng chọn danh mục khác hoặc gửi yêu cầu tùy biến riêng.</p>
                    <a href="{{ route('templates.index') }}" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                        <span>Xem tất cả mẫu</span>
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $templates->links() }}
            </div>
        </section>

        <!-- ==================== QUY TRÌNH TÙY BIẾN ==================== -->
        <section class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Cách thức làm việc</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Quy Trình Tùy Biến 4 Bước
                    </h2>
                </div>
                <span class="text-xs text-slate-500">Chuẩn hóa từ chọn mẫu đến bàn giao</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-5 rounded-xl bg-slate-50/70 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">01</span>
                        <div class="w-8 h-8 rounded-lg bg-orange-100 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">dashboard_customize</span>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Chọn mẫu nền tảng</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Doanh nghiệp chọn cấu trúc giao diện phù hợp với ngành nghề và mô tả các chức năng muốn giữ lại.
                    </p>
                </div>
                <div class="p-5 rounded-xl bg-slate-50/70 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">02</span>
                        <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">palette</span>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Cập nhật nhận diện</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Cửu Long tiếp nhận logo, mã màu chủ đạo, số hotline và các kênh liên hệ để tinh chỉnh visual đồng bộ.
                    </p>
                </div>
                <div class="p-5 rounded-xl bg-slate-50/70 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">03</span>
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">upload_file</span>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Nạp dữ liệu thực tế</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Đưa bài viết, hình ảnh sản phẩm/dịch vụ thực tế của quý khách vào các trang nội dung tương ứng.
                    </p>
                </div>
                <div class="p-5 rounded-xl bg-slate-50/70 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-primary font-mono">04</span>
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">verified</span>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-[#070f1e]">Trỏ tên miền &amp; Bàn giao</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kích hoạt chứng chỉ SSL, liên kết tên miền chính thức và bàn giao toàn bộ quyền quản trị CMS.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== MAY ĐO HOẶC TÙY BIẾN CHUYÊN SÂU ==================== -->
        <section class="p-8 sm:p-10 rounded-3xl bg-[#070f1e] border border-slate-800 text-white shadow-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative overflow-hidden">
            <!-- Background glow -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>

            <div class="space-y-3 max-w-2xl relative z-10">
                <span class="text-xs font-bold text-primary uppercase font-mono tracking-wider">NĂNG LỰC MAY ĐO RIÊNG BIỆT</span>
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight">
                    Cần Giao Diện May Đo Hoặc Tùy Biến Chuyên Sâu?
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Nếu quý khách có yêu cầu nhận diện độc bản, thiết kế riêng từng màn hình hoặc tích hợp nghiệp vụ phức tạp không nằm trong mẫu có sẵn, đội ngũ kỹ sư của Cửu Long sẽ thiết kế kiến trúc may đo toàn diện.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0 relative z-10 w-full md:w-auto">
                <a href="{{ route('services.web-app') }}" class="px-6 py-3 rounded-xl bg-primary hover:bg-orange-600 text-white text-xs font-bold text-center transition-all shadow-md">
                    <span>Xem giải pháp Web App may đo</span>
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs font-bold text-center transition-all">
                    <span>Liên hệ tư vấn</span>
                </a>
            </div>
        </section>

        <!-- ==================== FINAL CTA (GLOBAL BANNER CTA) ==================== -->
        <x-banner.cta
            variant="centered"
            badge="KHỞI ĐỘNG NHANH CHÓNG"
            title="Sẵn Sàng Triển Khai Website Cho Doanh Nghiệp?"
            description="Chọn mẫu nền tảng ưng ý hoặc trao đổi trực tiếp với chúng tôi để hoàn thiện website chuẩn mực trong thời gian ngắn nhất."
            :primaryCta="[
                'label' => 'Bắt đầu dự án',
                'url' => route('contact'),
                'icon' => 'arrow_forward'
            ]"
            :secondaryCta="[
                'label' => get_setting('company_phone', '0939.363.262'),
                'url' => 'tel:' . preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')),
                'icon' => 'call'
            ]"
        />
    </x-ui.container>

    <!-- LIVE PREVIEW MODAL -->
    <div x-show="previewModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4 bg-black/80 backdrop-blur-sm" style="display: none;">
        <div @click.outside="previewModal = false" class="w-full max-w-5xl h-[85vh] bg-[#070f1e] rounded-2xl border border-slate-700 shadow-2xl overflow-hidden flex flex-col">
            <div class="h-14 px-6 bg-[#0b1b33] border-b border-slate-700 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block"></span>
                    </div>
                    <span class="text-xs font-semibold text-white truncate max-w-xs sm:max-w-md ml-2" x-text="previewTitle"></span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-1 bg-[#070f1e] p-1 rounded-lg border border-slate-700 text-xs">
                        <button type="button" @click="previewDevice = 'desktop'" :class="previewDevice === 'desktop' ? 'bg-primary text-white font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded transition-colors">Desktop</button>
                        <button type="button" @click="previewDevice = 'tablet'" :class="previewDevice === 'tablet' ? 'bg-primary text-white font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded transition-colors">Tablet</button>
                        <button type="button" @click="previewDevice = 'mobile'" :class="previewDevice === 'mobile' ? 'bg-primary text-white font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded transition-colors">Mobile</button>
                    </div>
                    <a :href="'{{ route('contact') }}?service=' + encodeURIComponent('Nền tảng: ' + previewTitle)" class="px-3.5 py-1.5 rounded-lg bg-primary hover:bg-orange-600 text-white text-xs font-bold transition-all shadow-xs">
                        Áp dụng mẫu này
                    </a>
                    <button type="button" @click="previewModal = false" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>
            </div>
            <div class="flex-1 bg-slate-900 overflow-y-auto p-4 flex justify-center items-start">
                <div :class="{
                    'w-full max-w-full': previewDevice === 'desktop',
                    'w-[768px] shadow-2xl': previewDevice === 'tablet',
                    'w-[390px] shadow-2xl rounded-xl overflow-hidden': previewDevice === 'mobile'
                }" class="transition-all duration-300 bg-white">
                    <img :src="previewImg" 
                         :alt="previewTitle" 
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';"
                         class="w-full h-auto object-top">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
