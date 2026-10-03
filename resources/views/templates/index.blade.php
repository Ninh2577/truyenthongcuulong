@extends('layouts.app')

@section('title', 'Kho Giao Diện Website Mẫu Chuẩn SEO - Truyền Thông Cửu Long')
@section('meta_description', 'Kho giao diện website được thiết kế chuyên nghiệp, hiện đại, tối ưu trải nghiệm người dùng và phù hợp với nhiều ngành nghề khác nhau.')

@section('content')
<div class="w-full bg-[#fafbfc] min-h-screen pb-16" style="font-family: var(--font-primary);" x-data="{
    consultModal: false,
    selectedTemplateTitle: '',
    selectedTemplateSlug: '',
    customerName: '',
    customerPhone: '',
    customerEmail: '',
    customerNote: '',
    isSubmitting: false,
    submitSuccess: false,

    openConsult(title, slug) {
        this.selectedTemplateTitle = title;
        this.selectedTemplateSlug = slug;
        this.customerNote = 'Tôi muốn tải về / nhận tư vấn mẫu giao diện: ' + title;
        this.submitSuccess = false;
        this.consultModal = true;
    },

    submitConsultForm() {
        if (!this.customerName || !this.customerPhone) {
            alert('Vui lòng nhập Họ tên và Số điện thoại để Cửu Long có thể liên hệ hỗ trợ!');
            return;
        }
        this.isSubmitting = true;
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('name', this.customerName);
        formData.append('phone', this.customerPhone);
        formData.append('email', this.customerEmail || 'demo-request@cuulong.vn');
        formData.append('service', 'Tải về / Tư vấn Template: ' + this.selectedTemplateTitle);
        formData.append('message', this.customerNote + ' (Mã mẫu: ' + this.selectedTemplateSlug + ')');

        fetch('{{ route('contact.submit') }}', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            this.isSubmitting = false;
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
                this.customerName = '';
                this.customerPhone = '';
                this.customerEmail = '';
                this.customerNote = '';
            }, 3000);
        })
        .catch(error => {
            this.isSubmitting = false;
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
            }, 3000);
        });
    }
}">

    <!-- ==================== HERO SECTION ==================== -->
    <section class="pt-20 pb-12 sm:pt-20 sm:pb-14 lg:pt-20 lg:pb-16 relative overflow-hidden" style="background: linear-gradient(108deg, #ffffff 0%, #ffffff 42%, #fff8f2 68%, #fae8d4 100%);">
        <!-- Ambient diagonal warm ray -->
        <div class="absolute top-0 right-0 w-[55%] h-full bg-gradient-to-bl from-orange-200/35 via-amber-100/20 to-transparent pointer-events-none transform -skew-x-12 origin-top-right"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full bg-orange-100/40 blur-3xl pointer-events-none"></div>

        <div class="w-full max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-10 xl:px-14 2xl:px-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 xl:gap-8 items-center">
                <!-- Left: Title, Intro, Search Form & 4 Quality Badges -->
                <div class="lg:col-span-6 xl:col-span-6 space-y-4 sm:space-y-5 lg:-mt-2">
                    <!-- Eyebrow Pill Tag -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-50 border border-orange-200/80 text-[#ea580c] text-xs sm:text-sm font-bold tracking-wide">
                        <span class="material-symbols-outlined text-[18px] text-[#ff5400]">layers</span>
                        <span>KHO GIAO DIỆN MẪU – TEMPLATE WEBSITE</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl sm:text-5xl lg:text-[54px] xl:text-[62px] font-extrabold text-[#0b1a30] tracking-tight leading-[1.08]">
                        Các Templates<br>
                        <span class="text-[#ff5400]">Của Cửu Long</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base text-slate-500 max-w-xl leading-relaxed font-normal">
                        Kho giao diện website được thiết kế chuyên nghiệp, hiện đại, tối ưu trải nghiệm người dùng và phù hợp với nhiều ngành nghề khác nhau.
                    </p>

                    <!-- Search Bar with Pill Shape -->
                    <div class="pt-1 max-w-xl xl:max-w-2xl">
                        <form action="{{ route('templates.index') }}" method="GET" class="relative flex items-center rounded-full bg-white border border-slate-200 shadow-[0_6px_30px_-4px_rgba(0,0,0,0.07)] p-2 pl-6 focus-within:border-[#ff5400] focus-within:ring-2 focus-within:ring-[#ff5400]/20 transition-all">
                            @if(request('industry'))
                                <input type="hidden" name="industry" value="{{ request('industry') }}">
                            @endif
                            <span class="material-symbols-outlined text-slate-400 text-[22px] shrink-0 mr-3">search</span>
                            <input 
                                type="text" 
                                name="q" 
                                value="{{ request('q') }}" 
                                placeholder="Tìm kiếm mẫu theo tên (VD: Giáo dục, Bất động sản,...)" 
                                class="w-full bg-transparent border-none ring-0 focus:ring-0 focus:outline-none focus:border-none shadow-none text-slate-800 placeholder:text-slate-400 text-sm sm:text-base font-medium pr-3"
                                style="box-shadow: none !important; border: none !important; outline: none !important;"
                            >
                            <button type="submit" class="px-7 py-3.5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ff6a1a] hover:from-[#e04a00] hover:to-[#ff5400] text-white text-sm sm:text-base font-bold transition-all shadow-md shrink-0 flex items-center gap-2 cursor-pointer">
                                <span>Tìm kiếm</span>
                                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                            </button>
                        </form>
                    </div>

                    <!-- 4 Trust & Quality Features Row -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-4 gap-x-4 sm:gap-x-6 xl:gap-x-3 gap-y-3.5 pt-3.5 sm:pt-4 border-t border-slate-100/80">
                        <!-- 1: Đa dạng ngành nghề -->
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-orange-100/80 text-[#ff5400] flex items-center justify-center shrink-0 shadow-xs">
                                <span class="material-symbols-outlined text-[17px] sm:text-[19px]">layers</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-[12px] sm:text-[13px] font-bold text-slate-800 leading-snug">Đa dạng ngành nghề</div>
                                <div class="text-[10px] sm:text-[11px] text-slate-500 leading-normal mt-0.5">Nhiều lĩnh vực khác nhau</div>
                            </div>
                        </div>

                        <!-- 2: Tối ưu SEO -->
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-amber-100/80 text-amber-500 flex items-center justify-center shrink-0 shadow-xs">
                                <span class="material-symbols-outlined text-[17px] sm:text-[19px]">bolt</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-[12px] sm:text-[13px] font-bold text-slate-800 leading-snug">Tối ưu SEO</div>
                                <div class="text-[10px] sm:text-[11px] text-slate-500 leading-normal mt-0.5">Chuẩn cấu trúc, dễ lên top</div>
                            </div>
                        </div>

                        <!-- 3: Responsive -->
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-orange-100/80 text-[#ea580c] flex items-center justify-center shrink-0 shadow-xs">
                                <span class="material-symbols-outlined text-[17px] sm:text-[19px]">smartphone</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-[12px] sm:text-[13px] font-bold text-slate-800 leading-snug">Responsive</div>
                                <div class="text-[10px] sm:text-[11px] text-slate-500 leading-normal mt-0.5">Hiển thị đẹp trên mọi thiết bị</div>
                            </div>
                        </div>

                        <!-- 4: Hỗ trợ tận tâm -->
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-orange-100/80 text-[#ff5400] flex items-center justify-center shrink-0 shadow-xs">
                                <span class="material-symbols-outlined text-[17px] sm:text-[19px]">headset_mic</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-[12px] sm:text-[13px] font-bold text-slate-800 leading-snug">Hỗ trợ tận tâm</div>
                                <div class="text-[10px] sm:text-[11px] text-slate-500 leading-normal mt-0.5">Tùy chỉnh theo yêu cầu</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: High Resolution Device Mockups & Callout Showcase -->
                <div class="lg:col-span-6 xl:col-span-6 relative flex items-center justify-center lg:justify-end">
                    <img src="{{ asset('images/templates/hero_devices_showcase.png') }}?v={{ file_exists(public_path('images/templates/hero_devices_showcase.png')) ? filemtime(public_path('images/templates/hero_devices_showcase.png')) : time() }}" 
                         alt="Các Templates Của Cửu Long - Mẫu giao diện chuyên nghiệp" 
                         class="w-full max-w-[700px] lg:max-w-[760px] xl:max-w-[850px] 2xl:max-w-[920px] h-auto object-contain select-none hover:scale-[1.01] transition-transform duration-300 pointer-events-none"
                         style="-webkit-mask-image: radial-gradient(ellipse 94% 90% at 50% 50%, black 75%, transparent 100%); mask-image: radial-gradient(ellipse 94% 90% at 50% 50%, black 75%, transparent 100%);">
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CATEGORY FILTER CARD (FLOATING WHITE CONTAINER) ==================== -->
    <div class="w-full max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-10 xl:px-14 2xl:px-20 -mt-6 sm:-mt-8 relative z-20">
        <div class="bg-white rounded-3xl shadow-[0_12px_45px_-10px_rgba(0,0,0,0.08)] border border-slate-100 p-4 sm:p-6 lg:p-7 space-y-3 sm:space-y-3.5">
            @php
                // Row 1: 8 Primary Categories matching exact image
                $row1Categories = [
                    ['slug' => '', 'name' => 'Tất cả', 'icon' => 'grid_view'],
                    ['slug' => 'doanh-nghiep', 'name' => 'Doanh nghiệp', 'icon' => 'business_center'],
                    ['slug' => 'bat-dong-san', 'name' => 'Bất động sản', 'icon' => 'domain'],
                    ['slug' => 'giao-duc', 'name' => 'Giáo dục', 'icon' => 'school'],
                    ['slug' => 'y-te', 'name' => 'Y tế', 'icon' => 'favorite_border'],
                    ['slug' => 'nha-hang', 'name' => 'Nhà hàng - Ẩm thực', 'icon' => 'restaurant'],
                    ['slug' => 'du-lich', 'name' => 'Du lịch', 'icon' => 'flight'],
                    ['slug' => 'ban-le', 'name' => 'Thương mại điện tử', 'icon' => 'shopping_cart'],
                ];

                // Row 2: 3 Categories (Centered)
                $row2Categories = [
                    ['slug' => 'dich-vu', 'name' => 'Dịch vụ', 'icon' => 'settings'],
                    ['slug' => 'cong-nghe', 'name' => 'Công nghệ', 'icon' => 'memory'],
                    ['slug' => 'khac', 'name' => 'Khác', 'icon' => 'more_horiz'],
                ];
            @endphp

            <!-- Row 1 Filter Pills -->
            <div class="flex flex-wrap items-center justify-center gap-1.5 sm:gap-2">
                @foreach($row1Categories as $tab)
                    @php
                        $isActive = ($tab['slug'] === '' && empty($selectedIndustry)) || ($selectedIndustry === $tab['slug']);
                        $url = $tab['slug'] === '' ? route('templates.index') : route('templates.index', ['industry' => $tab['slug']]);
                    @endphp
                    <a href="{{ $url }}" 
                       class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-3.5 py-2 sm:py-2.5 rounded-2xl text-xs sm:text-[13px] font-medium whitespace-nowrap transition-all duration-200 {{ $isActive ? 'bg-gradient-to-r from-[#ff5400] to-[#ff6a1a] text-white font-bold shadow-md' : 'bg-white border border-slate-200/90 text-slate-700 hover:border-[#ff5400]/60 hover:text-[#ff5400]' }}">
                        <span class="material-symbols-outlined text-[17px] {{ $isActive ? 'text-white' : 'text-slate-500' }}">{{ $tab['icon'] }}</span>
                        <span>{{ $tab['name'] }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Row 2 Filter Pills (Centered) -->
            <div class="flex flex-wrap items-center justify-center gap-1.5 sm:gap-2">
                @foreach($row2Categories as $tab)
                    @php
                        $isActive = ($tab['slug'] === '' && empty($selectedIndustry)) || ($selectedIndustry === $tab['slug']);
                        $url = $tab['slug'] === '' ? route('templates.index') : route('templates.index', ['industry' => $tab['slug']]);
                    @endphp
                    <a href="{{ $url }}" 
                       class="inline-flex items-center gap-1.5 sm:gap-2 px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-2xl text-xs sm:text-[13px] font-medium whitespace-nowrap transition-all duration-200 {{ $isActive ? 'bg-gradient-to-r from-[#ff5400] to-[#ff6a1a] text-white font-bold shadow-md' : 'bg-white border border-slate-200/90 text-slate-700 hover:border-[#ff5400]/60 hover:text-[#ff5400]' }}">
                        <span class="material-symbols-outlined text-[18px] {{ $isActive ? 'text-white' : 'text-slate-500' }}">{{ $tab['icon'] }}</span>
                        <span>{{ $tab['name'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ==================== TEMPLATES GRID (3 COLUMNS) ==================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @forelse($templates as $item)
            @php
                $thumb = $item->thumbnail_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                $demoUrl = route('templates.show', ['slug' => $item->slug, 'view' => 'demo']);
                $detailUrl = route('templates.show', ['slug' => $item->slug]);

                // Smart Category Tag Detection matching screenshot
                $categoryBadge = 'Doanh nghiệp';
                $contentStr = strtolower($item->slug . ' ' . $item->title . ' ' . $item->summary);
                if (str_contains($contentStr, 'real estate') || str_contains($contentStr, 'bất động sản') || str_contains($contentStr, 'bat-dong-san') || str_contains($contentStr, 'cs2') || str_contains($contentStr, 're2') || str_contains($contentStr, 'neckle') || str_contains($contentStr, 'land')) {
                    $categoryBadge = 'Bất động sản';
                } elseif (str_contains($contentStr, 'food') || str_contains($contentStr, 'nhà hàng') || str_contains($contentStr, 'ẩm thực') || str_contains($contentStr, 'nha-hang') || str_contains($contentStr, 'bocoloo') || str_contains($contentStr, 'bacola') || str_contains($contentStr, 'fs1') || str_contains($contentStr, 'fo1') || str_contains($contentStr, 'coffee') || str_contains($contentStr, 'sushi')) {
                    $categoryBadge = 'Nhà hàng - Ẩm thực';
                } elseif (str_contains($contentStr, 'travel') || str_contains($contentStr, 'du lịch') || str_contains($contentStr, 'du-lich') || str_contains($contentStr, 'tour') || str_contains($contentStr, 'resort') || str_contains($contentStr, 'hotel') || str_contains($contentStr, 'trs1')) {
                    $categoryBadge = 'Du lịch';
                } elseif (str_contains($contentStr, 'education') || str_contains($contentStr, 'giáo dục') || str_contains($contentStr, 'giao-duc') || str_contains($contentStr, 'academy') || str_contains($contentStr, 'khóa học') || str_contains($contentStr, 'trường') || str_contains($contentStr, 'eds1') || str_contains($contentStr, 'ed1')) {
                    $categoryBadge = 'Giáo dục';
                } elseif (str_contains($contentStr, 'care') || str_contains($contentStr, 'health') || str_contains($contentStr, 'y tế') || str_contains($contentStr, 'y-te') || str_contains($contentStr, 'phòng khám') || str_contains($contentStr, 'bệnh viện') || str_contains($contentStr, 'med1') || str_contains($contentStr, 'nha khoa')) {
                    $categoryBadge = 'Y tế';
                } elseif (str_contains($contentStr, 'ecommerce') || str_contains($contentStr, 'thương mại điện tử') || str_contains($contentStr, 'shop') || str_contains($contentStr, 'store') || str_contains($contentStr, 'ban-le') || str_contains($contentStr, 'bán lẻ') || str_contains($contentStr, 'shop1')) {
                    $categoryBadge = 'Thương mại điện tử';
                } elseif (str_contains($contentStr, 'tech') || str_contains($contentStr, 'công nghệ') || str_contains($contentStr, 'cong-nghe') || str_contains($contentStr, 'software') || str_contains($contentStr, 'app') || str_contains($contentStr, 'ai') || str_contains($contentStr, 'saas') || str_contains($contentStr, 'cloud')) {
                    $categoryBadge = 'Công nghệ';
                } elseif (str_contains($contentStr, 'fashion') || str_contains($contentStr, 'thời trang') || str_contains($contentStr, 'thoi-trang') || str_contains($contentStr, 'style') || str_contains($contentStr, 'fas1')) {
                    $categoryBadge = 'Thời trang';
                } elseif (str_contains($contentStr, 'service') || str_contains($contentStr, 'dịch vụ') || str_contains($contentStr, 'dich-vu') || str_contains($contentStr, 'consulting') || str_contains($contentStr, 'agency') || str_contains($contentStr, 'ser1')) {
                    $categoryBadge = 'Dịch vụ';
                } elseif (str_contains($contentStr, 'architecture') || str_contains($contentStr, 'kiến trúc') || str_contains($contentStr, 'nội thất') || str_contains($contentStr, 'xay-dung') || str_contains($contentStr, 'arc1')) {
                    $categoryBadge = 'Kiến trúc - Nội thất';
                } elseif (str_contains($contentStr, 'car') || str_contains($contentStr, 'ô tô') || str_contains($contentStr, 'xe') || str_contains($contentStr, 'rentaly') || str_contains($contentStr, 'ca2')) {
                    $categoryBadge = 'Ô tô - Thuê xe';
                }
            @endphp
            <article class="group bg-white rounded-2xl border border-slate-100/90 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.06)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden">
                <!-- Thumbnail Image Area -->
                <div class="m-3 mb-0 rounded-xl overflow-hidden bg-slate-100 relative aspect-[16/10]">
                    <a href="{{ $demoUrl }}" class="block w-full h-full">
                        <img 
                            src="{{ $thumb }}" 
                            alt="{{ $item->title }}" 
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy"
                        >
                    </a>
                    <!-- Quick Preview Hover Overlay -->
                    <div class="absolute inset-0 bg-slate-900/30 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                        <span class="px-3.5 py-1.5 rounded-full bg-white text-slate-900 font-bold text-xs shadow-md flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-[#ff5400]">visibility</span>
                            <span>Xem Demo</span>
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-5 flex flex-col flex-1">
                    <!-- Category Badge -->
                    <div class="mb-2">
                        <span class="inline-block px-3 py-0.5 rounded-full text-[11px] font-semibold text-[#ea580c] bg-orange-50">
                            {{ $categoryBadge }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-sm sm:text-base font-bold text-[#0b1a30] mb-1.5 leading-snug group-hover:text-[#ff5400] transition-colors line-clamp-1">
                        <a href="{{ $demoUrl }}">
                            {{ $item->title }}
                        </a>
                    </h2>

                    <!-- Excerpt / Summary -->
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-5 flex-1 font-normal">
                        {{ $item->summary ?: 'Giao diện hiện đại, chuyên nghiệp, phù hợp với doanh nghiệp, công ty, tập đoàn.' }}
                    </p>

                    <!-- Action Buttons: [Xem Demo] & [Tải về] both pill rounded-full -->
                    <div class="flex items-center gap-2.5 pt-1">
                        <!-- 1. Xem Demo Button (Pill with orange border) -->
                        <a href="{{ $demoUrl }}" 
                           class="flex-1 py-2 px-3 rounded-full border border-orange-400 bg-white hover:bg-orange-50/60 text-[#ea580c] text-xs font-bold text-center flex items-center justify-center gap-1.5 transition-all">
                            <span class="material-symbols-outlined text-[15px] text-[#ea580c]">visibility</span>
                            <span>Xem Demo</span>
                        </a>

                        <!-- 2. Tải về Button (Solid bright orange pill) -->
                        <button type="button" 
                                @click="openConsult('{{ addslashes($item->title) }}', '{{ $item->slug }}')"
                                class="flex-1 py-2 px-3 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ff6a1a] hover:from-[#e04a00] hover:to-[#ff5400] text-white text-xs font-bold text-center flex items-center justify-center gap-1.5 transition-all shadow-xs cursor-pointer">
                            <span class="material-symbols-outlined text-[15px]">download</span>
                            <span>Tải về</span>
                        </button>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">dashboard</span>
                <h3 class="text-base font-bold text-[#1A1A1B]">Không tìm thấy mẫu phù hợp</h3>
                <p class="text-xs text-slate-500 mt-1">Vui lòng chọn danh mục khác hoặc liên hệ để chúng tôi thiết kế riêng cho bạn.</p>
                <a href="{{ route('templates.index') }}" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-[#ff5400] hover:underline">
                    <span>Xem tất cả mẫu</span>
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination with Custom Matching Template -->
        <div class="mt-10 flex justify-center">
            {{ $templates->links('templates.partials.pagination') }}
        </div>
    </div>

    <!-- ==================== PROCESS SECTION (QUY TRÌNH 4 BƯỚC) ==================== -->
    <div id="process-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-24">
        <div class="rounded-[32px] border border-slate-200/90 p-6 sm:p-8 lg:p-10 pb-7 sm:pb-9 lg:pb-10 relative overflow-hidden shadow-[0_10px_35px_-5px_rgba(0,0,0,0.05)]" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 40%, #e2e8f0 85%, #cbd5e1 100%);">
            <!-- 3D Decorative Silver Wavy Ribbons matching reference image -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-[32px]">
                <svg class="absolute right-0 top-0 h-full w-[65%] sm:w-[50%] object-cover opacity-80" viewBox="0 0 600 400" fill="none" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="silver-ribbon-1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#ffffff" stop-opacity="0.95" />
                            <stop offset="35%" stop-color="#e2e8f0" stop-opacity="0.75" />
                            <stop offset="75%" stop-color="#cbd5e1" stop-opacity="0.55" />
                            <stop offset="100%" stop-color="#94a3b8" stop-opacity="0.35" />
                        </linearGradient>
                        <linearGradient id="silver-ribbon-2" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#ffffff" stop-opacity="0.85" />
                            <stop offset="50%" stop-color="#f1f5f9" stop-opacity="0.6" />
                            <stop offset="100%" stop-color="#cbd5e1" stop-opacity="0.45" />
                        </linearGradient>
                        <linearGradient id="bottom-wave" x1="0%" y1="100%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#cbd5e1" stop-opacity="0.4" />
                            <stop offset="50%" stop-color="#f1f5f9" stop-opacity="0.2" />
                            <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <path d="M140,0 Q320,140 380,400 L600,400 L600,0 Z" fill="url(#silver-ribbon-1)" />
                    <path d="M260,0 C390,110 440,240 600,310 L600,0 Z" fill="url(#silver-ribbon-2)" />
                    <path d="M140,0 Q320,140 380,400" stroke="rgba(255,255,255,0.9)" stroke-width="3" fill="none" />
                    <path d="M260,0 C390,110 440,240 600,310" stroke="rgba(255,255,255,0.75)" stroke-width="2" fill="none" />
                    <path d="M0,400 Q200,310 600,350 L600,400 Z" fill="url(#bottom-wave)" />
                </svg>
            </div>

            <!-- Section Header -->
            <div class="mb-7 relative z-10">
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">
                    <span class="text-sm font-black text-[#ff5400]">»</span>
                    <span>TẠI SAO NÊN CHỌN CHÚNG TÔI?</span>
                </div>
                <h3 class="text-2xl sm:text-3xl lg:text-[32px] font-extrabold text-[#0b1a30] tracking-tight mt-1.5 mb-2 leading-tight">
                    Quy Trình Triển Khai Template 4 Bước
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 max-w-2xl leading-relaxed">
                    Chỉ với 4 bước đơn giản, bạn đã có ngay một website chuyên nghiệp, hiện đại và sẵn sàng hoạt động.
                </p>
            </div>

            <!-- 4 Step Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 relative z-10">
                <!-- Step 01 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-[0_10px_25px_-5px_rgba(15,23,42,0.08),0_8px_10px_-6px_rgba(15,23,42,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group min-h-[210px]">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-xs shrink-0 border border-orange-200/50" style="background: linear-gradient(135deg, #fff3eb 0%, #ffedd5 100%);">
                            <span class="material-symbols-outlined text-[28px] text-[#ff5400]" style="font-variation-settings: 'FILL' 1;">package_2</span>
                        </div>
                        <div class="flex-1 mx-3 h-[2px] bg-gradient-to-r from-orange-300/80 via-slate-300/60 to-slate-200/50 rounded-full"></div>
                        <span class="w-8 h-8 rounded-full bg-[#f1f5f9] text-[#1e293b] font-bold text-xs flex items-center justify-center font-mono border border-slate-200/80 shrink-0">01</span>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-[#0b1a30] mb-1.5 group-hover:text-[#ff5400] transition-colors">Chọn mẫu giao diện</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">
                            Duyệt kho template theo ngành nghề, phong cách phù hợp với nhu cầu của bạn.
                        </p>
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-[0_10px_25px_-5px_rgba(15,23,42,0.08),0_8px_10px_-6px_rgba(15,23,42,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group min-h-[210px]">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-xs shrink-0 border border-orange-200/50" style="background: linear-gradient(135deg, #fff3eb 0%, #ffedd5 100%);">
                            <span class="material-symbols-outlined text-[28px] text-[#ff5400]" style="font-variation-settings: 'FILL' 1;">settings</span>
                        </div>
                        <div class="flex-1 mx-3 h-[2px] bg-gradient-to-r from-orange-300/80 via-slate-300/60 to-slate-200/50 rounded-full"></div>
                        <span class="w-8 h-8 rounded-full bg-[#f1f5f9] text-[#1e293b] font-bold text-xs flex items-center justify-center font-mono border border-slate-200/80 shrink-0">02</span>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-[#0b1a30] mb-1.5 group-hover:text-[#ff5400] transition-colors">Tùy chỉnh nội dung</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">
                            Thay đổi logo, màu sắc, hình ảnh và thông tin theo thương hiệu của bạn.
                        </p>
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-[0_10px_25px_-5px_rgba(15,23,42,0.08),0_8px_10px_-6px_rgba(15,23,42,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group min-h-[210px]">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-xs shrink-0 border border-orange-200/50" style="background: linear-gradient(135deg, #fff3eb 0%, #ffedd5 100%);">
                            <span class="material-symbols-outlined text-[28px] text-[#ff5400]" style="font-variation-settings: 'FILL' 1;">cloud_upload</span>
                        </div>
                        <div class="flex-1 mx-3 h-[2px] bg-gradient-to-r from-orange-300/80 via-slate-300/60 to-slate-200/50 rounded-full"></div>
                        <span class="w-8 h-8 rounded-full bg-[#f1f5f9] text-[#1e293b] font-bold text-xs flex items-center justify-center font-mono border border-slate-200/80 shrink-0">03</span>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-[#0b1a30] mb-1.5 group-hover:text-[#ff5400] transition-colors">Cài đặt & kiểm tra</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">
                            Đội ngũ kỹ thuật hỗ trợ cài đặt, kiểm tra và tối ưu hiệu suất website.
                        </p>
                    </div>
                </div>

                <!-- Step 04 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-[0_10px_25px_-5px_rgba(15,23,42,0.08),0_8px_10px_-6px_rgba(15,23,42,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group min-h-[210px]">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-xs shrink-0 border border-orange-200/50" style="background: linear-gradient(135deg, #fff3eb 0%, #ffedd5 100%);">
                            <span class="material-symbols-outlined text-[28px] text-[#ff5400]" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
                        </div>
                        <div class="flex-1 mx-3 h-[2px] bg-gradient-to-r from-orange-300/80 via-slate-300/60 to-slate-200/50 rounded-full"></div>
                        <span class="w-8 h-8 rounded-full bg-[#f1f5f9] text-[#1e293b] font-bold text-xs flex items-center justify-center font-mono border border-slate-200/80 shrink-0">04</span>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-[#0b1a30] mb-1.5 group-hover:text-[#ff5400] transition-colors">Bàn giao & hướng dẫn</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">
                            Hoàn tất bàn giao, hướng dẫn sử dụng và hỗ trợ kỹ thuật lâu dài.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== CTA BANNER SECTION ==================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-24">
        <section class="p-8 sm:p-12 lg:p-14 rounded-3xl bg-gradient-to-r from-[#ff5400] via-[#ff630d] to-[#ff751a] text-white shadow-xl flex flex-col lg:flex-row items-center justify-between gap-8 relative overflow-hidden">
            <!-- Ambient blurred lighting -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>

            <div class="space-y-4 max-w-xl relative z-10 text-center lg:text-left">
                <span class="text-xs font-bold text-orange-100 uppercase font-mono tracking-wider">
                    SẴN SÀNG BẮT ĐẦU?
                </span>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-tight">
                    Bạn Đang Có Một Bài Toán Cần Giải Quyết?
                </h3>
                <p class="text-xs sm:text-sm text-orange-100/90 leading-relaxed font-normal">
                    Hãy để Truyền Thông Cửu Long đồng hành cùng bạn. Liên hệ ngay để được tư vấn giải pháp phù hợp nhất với nhu cầu của doanh nghiệp.
                </p>
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3">
                    <a href="{{ route('contact') }}" class="px-6 py-3 rounded-full bg-white hover:bg-orange-50 text-[#ff5400] text-xs sm:text-sm font-bold text-center transition-all shadow-md flex items-center justify-center gap-1.5 w-full sm:w-auto">
                        <span>Liên hệ ngay</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                    <a href="{{ route('services.index') }}" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/40 text-xs sm:text-sm font-bold text-center transition-all flex items-center justify-center gap-1.5 w-full sm:w-auto">
                        <span>Xem các dịch vụ khác</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Laptop Mockup on Right -->
            <div class="relative z-10 shrink-0 w-full max-w-[420px] flex items-center justify-center">
                <img src="{{ asset('images/cta/tech_workspace_visual.png') }}" 
                     alt="Laptop Mockup Truyền Thông Cửu Long" 
                     class="w-full h-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500">
            </div>
        </section>
    </div>

    <!-- ==================== QUICK CONSULTATION / DOWNLOAD MODAL ==================== -->
    <div x-show="consultModal" 
         x-transition.opacity 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-xs" 
         style="display: none;">
        <div @click.outside="consultModal = false" 
             class="w-full max-w-lg bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden flex flex-col">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-orange-500 flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Tải Về & Tư Vấn Mẫu Giao Diện</h3>
                        <p class="text-[11px] text-slate-400 truncate max-w-xs" x-text="selectedTemplateTitle"></p>
                    </div>
                </div>
                <button type="button" @click="consultModal = false" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-[22px]">close</span>
                </button>
            </div>

            <!-- Modal Content / Form -->
            <div class="p-6">
                <!-- Success message -->
                <div x-show="submitSuccess" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-center space-y-2 mb-4">
                    <span class="material-symbols-outlined text-3xl text-emerald-600">check_circle</span>
                    <h4 class="font-bold text-sm">Gửi yêu cầu thành công!</h4>
                    <p class="text-xs text-slate-600">Đội ngũ Cửu Long sẽ liên hệ lại với bạn trong vòng 15 phút để bàn giao link tải và hướng dẫn cài đặt.</p>
                </div>

                <form x-show="!submitSuccess" @submit.prevent="submitConsultForm" class="space-y-4">
                    <!-- Template badge indicator -->
                    <div class="p-3 rounded-xl bg-orange-50 border border-orange-200/80 flex items-center gap-2">
                        <span class="material-symbols-outlined text-orange-500 text-[18px]">verified</span>
                        <span class="text-xs text-slate-700 font-semibold truncate">
                            Mẫu đang chọn: <strong class="text-orange-600 font-bold" x-text="selectedTemplateTitle"></strong>
                        </span>
                    </div>

                    <!-- Input Name -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Họ và tên của bạn <span class="text-rose-500">*</span></label>
                        <input type="text" x-model="customerName" required placeholder="Ví dụ: Nguyễn Văn A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <!-- Input Phone -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Số điện thoại / Zalo <span class="text-rose-500">*</span></label>
                        <input type="tel" x-model="customerPhone" required placeholder="Ví dụ: 0939 363 262" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email (nếu có)</label>
                        <input type="email" x-model="customerEmail" placeholder="email@doanhnghiep.vn" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <!-- Input Note -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nội dung mong muốn hỗ trợ</label>
                        <textarea x-model="customerNote" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-xs text-slate-900 outline-none transition-all resize-none"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            :disabled="isSubmitting"
                            class="w-full py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-70">
                        <span x-show="!isSubmitting">Tải Về & Nhận Tư Vấn Cài Đặt</span>
                        <span x-show="isSubmitting">Đang gửi yêu cầu...</span>
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>

                <!-- Direct Contact Strip -->
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Hỗ trợ trực tiếp 24/7:</span>
                    <a href="tel:0939363262" class="font-bold text-orange-500 hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[15px]">call</span>
                        <span>0939.363.262</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
