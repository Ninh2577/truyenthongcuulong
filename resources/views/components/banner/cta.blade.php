@props([
    'eyebrow' => 'BẮT ĐẦU DỰ ÁN • TƯ VẤN GIẢI PHÁP CÔNG NGHỆ',
    'title' => 'Bạn đang cần xây dựng một hệ thống phù hợp với doanh nghiệp?',
    'description' => 'Trao đổi với Cửu Long để làm rõ bài toán, phạm vi và hướng triển khai kỹ thuật.',
    'primaryCta' => null,   // ['label' => 'Bắt đầu dự án', 'url' => route('contact'), 'icon' => 'arrow_forward']
    'secondaryCta' => null, // ['label' => 'Xem giải pháp công nghệ', 'url' => route('services.index'), 'icon' => 'schema']
    'trustPoints' => [],    // Danh sách điểm tin cậy ['Điểm 1', 'Điểm 2']
    'variant' => 'dark',    // 'dark' (nền tối công nghệ) | 'light' (nền sáng)
    'id' => 'cta-conversion-band',
    'class' => '',
])

@php
    $isDark = $variant !== 'light';

    // Xử lý CTA chính mặc định nếu không truyền
    $defaultPrimaryUrl = \Illuminate\Support\Facades\Route::has('contact') ? route('contact') : '/lien-he';
    $resolvedPrimaryCta = $primaryCta ?? [
        'label' => 'Bắt đầu dự án',
        'url' => $defaultPrimaryUrl,
        'icon' => 'arrow_forward'
    ];

    $hasPrimary = is_array($resolvedPrimaryCta) && !empty($resolvedPrimaryCta['label']) && !empty($resolvedPrimaryCta['url']);
    $hasSecondary = is_array($secondaryCta) && !empty($secondaryCta['label']) && !empty($secondaryCta['url']);
    $hasTrustPoints = is_array($trustPoints) && count($trustPoints) > 0;
@endphp

<section 
    id="{{ $id }}"
    {{ $attributes->merge(['class' => 'relative w-full overflow-hidden py-16 lg:py-20 border-t ' . ($isDark ? 'bg-gradient-to-br from-[#070F1E] via-[#0C1A30] to-navy-base text-white border-slate-800' : 'bg-surface-low bg-dot-grid-subtle text-[#070f1e] border-slate-200/80') . ' ' . $class]) }}
    style="font-family: var(--font-primary), Mulish, sans-serif;"
    aria-labelledby="{{ $id }}-title"
>
    {{-- Hiệu ứng ánh sáng nền tinh tế --}}
    @if($isDark)
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-gradient-to-b from-primary/15 via-sky-500/10 to-transparent blur-3xl pointer-events-none" aria-hidden="true"></div>
        <div class="absolute bottom-0 right-10 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
    @else
        <div class="absolute -top-24 right-0 w-[450px] h-[450px] rounded-full bg-gradient-to-br from-amber-400/5 via-primary/5 to-transparent blur-3xl pointer-events-none" aria-hidden="true"></div>
        <div class="absolute bottom-0 left-10 w-[350px] h-[250px] rounded-full bg-gradient-to-tr from-sky-500/5 via-primary/5 to-transparent blur-3xl pointer-events-none" aria-hidden="true"></div>
    @endif

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 flex flex-col items-center gap-6">
        
        {{-- Eyebrow --}}
        @if(!empty($eyebrow))
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider {{ $isDark ? 'bg-white/10 backdrop-blur-md text-amber-300 border border-white/15 shadow-2xs' : 'bg-slate-100 text-slate-700 border border-slate-200/80' }}">
                <span>{{ $eyebrow }}</span>
            </div>
        @endif

        {{-- Tiêu đề H2 chuẩn mực (không dùng H1 cho banner cuối trang) --}}
        <h2 id="{{ $id }}-title" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight max-w-3xl leading-tight {{ $isDark ? 'text-white' : 'text-[#070f1e]' }}">
            {{ $title }}
        </h2>

        {{-- Mô tả phụ --}}
        @if(!empty($description))
            <p class="text-sm sm:text-base lg:text-lg max-w-2xl leading-relaxed {{ $isDark ? 'text-slate-300' : 'text-slate-600' }}">
                {{ $description }}
            </p>
        @endif

        {{-- Nhóm nút hành động CTA (tối đa 2 nút) --}}
        @if($hasPrimary || $hasSecondary)
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3.5 pt-2 w-full sm:w-auto">
                @if($hasPrimary)
                    <a 
                        href="{{ $resolvedPrimaryCta['url'] }}" 
                        class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl font-bold text-xs sm:text-sm shadow-md transition-all focus-visible:outline-none focus-visible:ring-2 active:scale-[0.98] {{ $isDark ? 'bg-primary hover:bg-orange-600 text-white shadow-primary/20 focus-visible:ring-white' : 'bg-[#070f1e] hover:bg-slate-800 text-white shadow-navy-base/20 focus-visible:ring-[#070f1e]' }}"
                    >
                        <span>{{ $resolvedPrimaryCta['label'] }}</span>
                        @if(!empty($resolvedPrimaryCta['icon']))
                            <span class="material-symbols-outlined text-[17px] text-amber-300" aria-hidden="true">{{ $resolvedPrimaryCta['icon'] }}</span>
                        @else
                            <span class="material-symbols-outlined text-[17px] text-amber-300" aria-hidden="true">arrow_forward</span>
                        @endif
                    </a>
                @endif

                @if($hasSecondary)
                    <a 
                        href="{{ $secondaryCta['url'] }}" 
                        class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl font-semibold text-xs sm:text-sm border transition-all focus-visible:outline-none focus-visible:ring-2 active:scale-[0.98] {{ $isDark ? 'bg-white/10 hover:bg-white/20 text-white border-white/20 focus-visible:ring-white' : 'bg-white hover:bg-slate-50 text-slate-800 border-slate-200 shadow-2xs hover:border-slate-300 focus-visible:ring-slate-400' }}"
                    >
                        @if(!empty($secondaryCta['icon']))
                            <span class="material-symbols-outlined text-[17px]" aria-hidden="true">{{ $secondaryCta['icon'] }}</span>
                        @endif
                        <span>{{ $secondaryCta['label'] }}</span>
                    </a>
                @endif
            </div>
        @endif

        {{-- Slot nội dung mở rộng (tùy chọn) --}}
        @if($slot->isNotEmpty())
            <div class="w-full pt-2">
                {{ $slot }}
            </div>
        @endif

        {{-- Danh sách điểm tin cậy (chỉ hiển thị khi có dữ liệu) --}}
        @if($hasTrustPoints)
            <div class="pt-6 border-t w-full max-w-2xl flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs {{ $isDark ? 'border-white/10 text-slate-400' : 'border-slate-200/80 text-slate-500' }}">
                @foreach($trustPoints as $point)
                    @if(!empty($point))
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-emerald-400" aria-hidden="true">check_circle</span>
                            <span>{{ $point }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

    </div>
</section>
