@props([
    'variant' => 'service-split', // 'service-split' | 'service-centered' | 'media-visual' | 'case-study'
    'eyebrow' => null,           // Nhãn phía trên tiêu đề (chuỗi text)
    'title' => '',               // Tiêu đề H1 chính
    'titleAccent' => null,       // Phần tiêu đề nhấn / dòng 2
    'description' => '',         // Đoạn văn bản mô tả
    'breadcrumb' => [],          // Danh sách breadcrumb [['label' => '...', 'url' => '...']]
    'primaryCta' => null,        // ['label' => '...', 'url' => '...', 'icon' => '...']
    'secondaryCta' => null,      // ['label' => '...', 'url' => '...', 'icon' => '...']
    'image' => null,             // URL ảnh desktop
    'imageMobile' => null,       // URL ảnh mobile (tùy chọn)
    'imageAlt' => '',            // Thuộc tính alt ảnh (mô tả ngữ nghĩa)
    'aspectRatio' => 'aspect-[16/10]', // Tỷ lệ khung hình (chống CLS)
    'metaStrip' => null,         // Metadata cho case study: [['label' => '...', 'value' => '...']]
    'isLcp' => false,            // Đánh dấu ảnh LCP ưu tiên tải
    'class' => '',               // Class tùy chỉnh bổ sung cho section
    'id' => null,                // ID định danh section
])

@php
    $allowedVariants = ['service-split', 'service-centered', 'media-visual', 'case-study'];
    $activeVariant = in_array($variant, $allowedVariants, true) ? $variant : 'service-split';

    // Kiểm tra có visual (slot hoặc ảnh) hay không
    $hasSlot = $slot->isNotEmpty();
    $hasImage = !empty($image);
    $hasVisual = $hasSlot || $hasImage;

    // Kiểm tra tính hợp lệ của CTA
    $hasPrimaryCta = is_array($primaryCta) && !empty($primaryCta['label']) && !empty($primaryCta['url']);
    $hasSecondaryCta = is_array($secondaryCta) && !empty($secondaryCta['label']) && !empty($secondaryCta['url']);
    $hasCtas = $hasPrimaryCta || $hasSecondaryCta;

    // Kiểm tra metadata strip
    $hasMetaStrip = is_array($metaStrip) && count($metaStrip) > 0;
@endphp

<section 
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => "relative w-full overflow-hidden bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80 pt-28 pb-14 sm:pb-16 lg:pt-36 lg:pb-20 {$class}"]) }}
    style="font-family: var(--font-primary), Mulish, sans-serif;"
>
    {{-- Hiệu ứng ánh sáng nền tinh tế (chống chói, tôn trọng visual) --}}
    <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-amber-400/5 via-primary/5 to-transparent blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 left-10 w-[400px] h-[300px] rounded-full bg-gradient-to-tr from-sky-500/5 via-primary/5 to-transparent blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Breadcrumb điều hướng (chỉ render khi có dữ liệu) --}}
        @if(!empty($breadcrumb) && is_array($breadcrumb))
            <div class="mb-6 sm:mb-8">
                <x-ui.breadcrumb :items="$breadcrumb" />
            </div>
        @endif

        {{-- ==================== BIẾN THỂ 1: SERVICE-SPLIT ==================== --}}
        @if($activeVariant === 'service-split')
            @if($hasVisual)
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                    {{-- Cột nội dung văn bản (bên trái) --}}
                    <div class="lg:col-span-7 flex flex-col items-start gap-5">
                        @if(!empty($eyebrow))
                            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold uppercase tracking-wider">
                                {{ $eyebrow }}
                            </span>
                        @endif

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                            {{ $title }}
                            @if(!empty($titleAccent))
                                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                                    {{ $titleAccent }}
                                </span>
                            @endif
                        </h1>

                        @if(!empty($description))
                            <p class="text-slate-600 text-sm sm:text-base lg:text-lg leading-relaxed max-w-2xl">
                                {{ $description }}
                            </p>
                        @endif

                        @if($hasCtas)
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2 w-full sm:w-auto">
                                @if($hasPrimaryCta)
                                    <a href="{{ $primaryCta['url'] }}" class="btn-primary-cta inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#070f1e]">
                                        <span>{{ $primaryCta['label'] }}</span>
                                        @if(!empty($primaryCta['icon']))
                                            <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">{{ $primaryCta['icon'] }}</span>
                                        @else
                                            <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                                        @endif
                                    </a>
                                @endif

                                @if($hasSecondaryCta)
                                    <a href="{{ $secondaryCta['url'] }}" class="btn-secondary-cta inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary text-xs sm:text-sm font-semibold shadow-2xs hover:border-slate-300 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-400">
                                        <span>{{ $secondaryCta['label'] }}</span>
                                        @if(!empty($secondaryCta['icon']))
                                            <span class="material-symbols-outlined text-[16px]" aria-hidden="true">{{ $secondaryCta['icon'] }}</span>
                                        @endif
                                    </a>
                                @endif
                            </div>
                        @endif

                        @if(isset($extra))
                            {{ $extra }}
                        @endif
                    </div>

                    {{-- Cột visual (bên phải): Slot hoặc Ảnh --}}
                    <div class="lg:col-span-5 w-full">
                        @if($hasSlot)
                            <div class="w-full">
                                {{ $slot }}
                            </div>
                        @elseif($hasImage)
                            <div class="w-full overflow-hidden rounded-2xl bg-white border border-slate-200/90 shadow-sm {{ $aspectRatio }}">
                                @if(!empty($imageMobile))
                                    <picture class="w-full h-full block">
                                        <source media="(max-width: 640px)" srcset="{{ $imageMobile }}">
                                        <img 
                                            src="{{ $image }}" 
                                            alt="{{ $imageAlt }}" 
                                            class="w-full h-full object-cover object-center"
                                            loading="{{ $isLcp ? 'eager' : 'lazy' }}"
                                            decoding="async"
                                            @if($isLcp) fetchpriority="high" @endif
                                        >
                                    </picture>
                                @else
                                    <img 
                                        src="{{ $image }}" 
                                        alt="{{ $imageAlt }}" 
                                        class="w-full h-full object-cover object-center"
                                        loading="{{ $isLcp ? 'eager' : 'lazy' }}"
                                        decoding="async"
                                        @if($isLcp) fetchpriority="high" @endif
                                    >
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @else
                {{-- Fallback khi service-split không có visual: Tự co gọn về bố cục căn giữa an toàn --}}
                <div class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
                    @if(!empty($eyebrow))
                        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold uppercase tracking-wider">
                            {{ $eyebrow }}
                        </span>
                    @endif

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                        {{ $title }}
                        @if(!empty($titleAccent))
                            <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                                {{ $titleAccent }}
                            </span>
                        @endif
                    </h1>

                    @if(!empty($description))
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                            {{ $description }}
                        </p>
                    @endif

                    @if($hasCtas)
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2 w-full sm:w-auto">
                            @if($hasPrimaryCta)
                                <a href="{{ $primaryCta['url'] }}" class="btn-primary-cta inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#070f1e] w-full sm:w-auto">
                                    <span>{{ $primaryCta['label'] }}</span>
                                    @if(!empty($primaryCta['icon']))
                                        <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">{{ $primaryCta['icon'] }}</span>
                                    @else
                                        <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                                    @endif
                                </a>
                            @endif

                            @if($hasSecondaryCta)
                                <a href="{{ $secondaryCta['url'] }}" class="btn-secondary-cta inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary text-xs sm:text-sm font-semibold shadow-2xs hover:border-slate-300 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-400 w-full sm:w-auto">
                                    <span>{{ $secondaryCta['label'] }}</span>
                                    @if(!empty($secondaryCta['icon']))
                                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true">{{ $secondaryCta['icon'] }}</span>
                                    @endif
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

        {{-- ==================== BIẾN THỂ 2: SERVICE-CENTERED ==================== --}}
        @elseif($activeVariant === 'service-centered')
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
                @if(!empty($eyebrow))
                    <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold uppercase tracking-wider">
                        {{ $eyebrow }}
                    </span>
                @endif

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                    {{ $title }}
                    @if(!empty($titleAccent))
                        <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                            {{ $titleAccent }}
                        </span>
                    @endif
                </h1>

                @if(!empty($description))
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                        {{ $description }}
                    </p>
                @endif

                @if($hasCtas)
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2 w-full sm:w-auto">
                        @if($hasPrimaryCta)
                            <a href="{{ $primaryCta['url'] }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#070f1e] w-full sm:w-auto">
                                <span>{{ $primaryCta['label'] }}</span>
                                @if(!empty($primaryCta['icon']))
                                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">{{ $primaryCta['icon'] }}</span>
                                @else
                                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">arrow_forward</span>
                                @endif
                            </a>
                        @endif

                        @if($hasSecondaryCta)
                            <a href="{{ $secondaryCta['url'] }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary text-xs sm:text-sm font-semibold shadow-2xs hover:border-slate-300 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-400 w-full sm:w-auto">
                                <span>{{ $secondaryCta['label'] }}</span>
                                @if(!empty($secondaryCta['icon']))
                                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">{{ $secondaryCta['icon'] }}</span>
                                @endif
                            </a>
                        @endif
                    </div>
                @endif

                {{-- Vùng visual tùy chọn phía dưới nội dung căn giữa --}}
                @if($hasSlot)
                    <div class="w-full pt-6">
                        {{ $slot }}
                    </div>
                @elseif($hasImage)
                    <div class="w-full max-w-3xl pt-6">
                        <div class="overflow-hidden rounded-2xl bg-white border border-slate-200/90 shadow-sm {{ $aspectRatio }}">
                            <img 
                                src="{{ $image }}" 
                                alt="{{ $imageAlt }}" 
                                class="w-full h-full object-cover object-center"
                                loading="{{ $isLcp ? 'eager' : 'lazy' }}"
                                decoding="async"
                                @if($isLcp) fetchpriority="high" @endif
                            >
                        </div>
                    </div>
                @endif
            </div>

        {{-- ==================== BIẾN THỂ 3: MEDIA-VISUAL ==================== --}}
        @elseif($activeVariant === 'media-visual')
            <div class="max-w-5xl mx-auto flex flex-col items-center text-center gap-6">
                @if(!empty($eyebrow))
                    <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold uppercase tracking-wider">
                        {{ $eyebrow }}
                    </span>
                @endif

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight max-w-4xl">
                    {{ $title }}
                    @if(!empty($titleAccent))
                        <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                            {{ $titleAccent }}
                        </span>
                    @endif
                </h1>

                @if(!empty($description))
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                        {{ $description }}
                    </p>
                @endif

                @if($hasCtas)
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-1 w-full sm:w-auto">
                        @if($hasPrimaryCta)
                            <a href="{{ $primaryCta['url'] }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#070f1e] w-full sm:w-auto">
                                <span>{{ $primaryCta['label'] }}</span>
                                @if(!empty($primaryCta['icon']))
                                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">{{ $primaryCta['icon'] }}</span>
                                @endif
                            </a>
                        @endif

                        @if($hasSecondaryCta)
                            <a href="{{ $secondaryCta['url'] }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-primary text-xs sm:text-sm font-semibold shadow-2xs hover:border-slate-300 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-400 w-full sm:w-auto">
                                @if(!empty($secondaryCta['icon']))
                                    <span class="material-symbols-outlined text-[18px] text-primary" aria-hidden="true">{{ $secondaryCta['icon'] }}</span>
                                @endif
                                <span>{{ $secondaryCta['label'] }}</span>
                            </a>
                        @endif
                    </div>
                @endif

                {{-- Khung Visual Điện Ảnh Chuẩn (Video trigger hoặc Reel Backdrop) --}}
                @if($hasSlot)
                    <div class="w-full pt-4">
                        {{ $slot }}
                    </div>
                @elseif($hasImage)
                    <div class="w-full pt-4">
                        <div class="relative w-full overflow-hidden rounded-2xl md:rounded-3xl border border-slate-200/90 shadow-md bg-slate-900 {{ $aspectRatio }}">
                            <img 
                                src="{{ $image }}" 
                                alt="{{ $imageAlt }}" 
                                class="w-full h-full object-cover object-center"
                                loading="{{ $isLcp ? 'eager' : 'lazy' }}"
                                decoding="async"
                                @if($isLcp) fetchpriority="high" @endif
                            >
                            {{-- Lớp phủ chuyển sắc bảo vệ tương phản nội dung --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent pointer-events-none" aria-hidden="true"></div>
                        </div>
                    </div>
                @endif
            </div>

        {{-- ==================== BIẾN THỂ 4: CASE-STUDY ==================== --}}
        @elseif($activeVariant === 'case-study')
            <div class="max-w-5xl mx-auto flex flex-col gap-6">
                @if(!empty($eyebrow))
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-semibold uppercase tracking-wider w-fit">
                        <span class="w-2 h-2 rounded-full bg-primary" aria-hidden="true"></span>
                        <span>{{ $eyebrow }}</span>
                    </div>
                @endif

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                    {{ $title }}
                    @if(!empty($titleAccent))
                        <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                            {{ $titleAccent }}
                        </span>
                    @endif
                </h1>

                @if(!empty($description))
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-3xl">
                        {{ $description }}
                    </p>
                @endif

                {{-- Metadata Strip dành riêng cho Case Study (chỉ hiển thị các trường có thật) --}}
                @if($hasMetaStrip)
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 mt-2 border-t border-slate-200/80 text-xs">
                        @foreach($metaStrip as $meta)
                            @if(!empty($meta['label']) && !empty($meta['value']))
                                <div>
                                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">{{ $meta['label'] }}</span>
                                    <span class="font-bold text-[#070f1e] mt-0.5 block truncate {{ $meta['color'] ?? '' }}">
                                        {{ $meta['value'] }}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- Slot tùy chọn cho sơ đồ hệ thống hoặc visual mockup dự án --}}
                @if($hasSlot)
                    <div class="w-full pt-4">
                        {{ $slot }}
                    </div>
                @elseif($hasImage)
                    <div class="w-full pt-4">
                        <div class="w-full overflow-hidden rounded-2xl bg-white border border-slate-200/90 shadow-sm {{ $aspectRatio }}">
                            <img 
                                src="{{ $image }}" 
                                alt="{{ $imageAlt }}" 
                                class="w-full h-full object-cover object-top"
                                loading="{{ $isLcp ? 'eager' : 'lazy' }}"
                                decoding="async"
                                @if($isLcp) fetchpriority="high" @endif
                            >
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </div>
</section>
