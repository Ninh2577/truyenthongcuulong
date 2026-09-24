@props([
    'variant' => 'primary', // 'primary', 'secondary', 'outline', 'ghost', 'dark'
    'size' => 'md',        // 'sm', 'md', 'lg'
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'iconRight' => null,
    'fullWidth' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-headline font-bold transition-all duration-200 select-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none active:scale-[0.98]';

    $variantClasses = match($variant) {
        'primary' => 'bg-navy-base hover:bg-slate-800 text-white shadow-md shadow-navy-base/15 focus-visible:ring-navy-base focus-visible:ring-offset-white border border-transparent',
        'secondary' => 'bg-white hover:bg-slate-50 text-slate-800 border border-slate-200 shadow-2xs hover:border-slate-300 focus-visible:ring-primary',
        'outline' => 'bg-transparent hover:bg-slate-100 text-slate-800 border border-slate-300 focus-visible:ring-primary',
        'ghost' => 'bg-transparent hover:bg-slate-100 text-slate-700 hover:text-navy-base focus-visible:ring-primary',
        'dark' => 'bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-sm focus-visible:ring-amber-400',
        default => 'bg-navy-base hover:bg-slate-800 text-white',
    };

    $sizeClasses = match($size) {
        'sm' => 'min-h-[36px] sm:min-h-[40px] px-3.5 py-1.5 text-xs rounded-lg gap-1.5',
        'lg' => 'min-h-[48px] px-7 py-3 text-base rounded-full gap-2.5',
        default => 'min-h-[44px] px-5 py-2.5 text-sm rounded-xl sm:rounded-full gap-2',
    };

    $widthClass = $fullWidth ? 'w-full' : '';
    $classes = "{$baseClasses} {$variantClasses} {$sizeClasses} {$widthClass}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <span class="material-symbols-outlined text-[18px] shrink-0" aria-hidden="true">{{ $icon }}</span>
        @endif
        <span>{{ $slot }}</span>
        @if($iconRight)
            <span class="material-symbols-outlined text-[18px] shrink-0" aria-hidden="true">{{ $iconRight }}</span>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <span class="material-symbols-outlined text-[18px] shrink-0" aria-hidden="true">{{ $icon }}</span>
        @endif
        <span>{{ $slot }}</span>
        @if($iconRight)
            <span class="material-symbols-outlined text-[18px] shrink-0" aria-hidden="true">{{ $iconRight }}</span>
        @endif
    </button>
@endif
