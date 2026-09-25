@props([
    'eyebrow' => null,
    'eyebrowIcon' => null,
    'title' => '',
    'description' => null,
    'align' => 'center', // 'center', 'left'
    'tag' => 'h2',
])

@php
    $alignClasses = match($align) {
        'left' => 'text-left items-start',
        default => 'text-center items-center mx-auto',
    };
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col max-w-3xl {$alignClasses} mb-10 lg:mb-14"]) }}>
    @if($eyebrow)
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-50 text-sky-800 font-semibold text-[11px] tracking-wide border border-sky-200/80 mb-3.5 shadow-2xs">
            @if($eyebrowIcon)
                <span class="material-symbols-outlined text-[15px] text-sky-600" aria-hidden="true">{{ $eyebrowIcon }}</span>
            @endif
            <span>{{ $eyebrow }}</span>
        </div>
    @endif

    <{{ $tag }} class="font-headline text-2xl sm:text-3xl lg:text-4xl xl:text-[40px] font-extrabold tracking-tight text-navy-base leading-[1.2]">
        {{ $title ?: $slot }}
    </{{ $tag }}>

    @if($description)
        <p class="font-body text-slate-600 text-sm sm:text-base lg:text-lg mt-3.5 leading-relaxed">
            {{ $description }}
        </p>
    @endif

    @if(isset($actions))
        <div class="mt-6 flex flex-wrap gap-3">
            {{ $actions }}
        </div>
    @endif
</div>
