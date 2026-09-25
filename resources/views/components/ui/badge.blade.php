@props([
    'variant' => 'neutral', // 'tech', 'media', 'neutral', 'success', 'warning', 'danger'
    'size' => 'md',        // 'sm', 'md'
    'dot' => false,
    'icon' => null,
])

@php
    $baseClasses = 'inline-flex items-center font-semibold tracking-wide uppercase rounded-full select-none';

    $variantClasses = match($variant) {
        'tech' => 'bg-sky-50 text-sky-700 border border-sky-200/80',
        'media' => 'bg-amber-50 text-amber-800 border border-amber-200/80',
        'success' => 'bg-emerald-50 text-emerald-700 border border-emerald-200/80',
        'warning' => 'bg-orange-50 text-orange-800 border border-orange-200/80',
        'danger' => 'bg-rose-50 text-rose-700 border border-rose-200/80',
        default => 'bg-slate-100 text-slate-700 border border-slate-200/80',
    };

    $dotColorClasses = match($variant) {
        'tech' => 'bg-sky-500',
        'media' => 'bg-amber-500',
        'success' => 'bg-emerald-500',
        'warning' => 'bg-orange-500',
        'danger' => 'bg-rose-500',
        default => 'bg-slate-400',
    };

    $sizeClasses = match($size) {
        'sm' => 'px-2 py-0.5 text-[9px] gap-1',
        default => 'px-3 py-1 text-[11px] gap-1.5',
    };
@endphp

<span {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses} {$sizeClasses}"]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColorClasses }}" aria-hidden="true"></span>
    @endif
    @if($icon)
        <span class="material-symbols-outlined text-[13px]" aria-hidden="true">{{ $icon }}</span>
    @endif
    <span>{{ $slot }}</span>
</span>
