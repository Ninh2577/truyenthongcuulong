@props([
    'variant' => 'default', // 'default', 'interactive', 'subtle', 'dark'
    'padding' => 'default', // 'none', 'sm', 'default', 'lg'
    'radius' => '2xl',     // 'xl', '2xl', '3xl'
    'as' => 'div',
])

@php
    $baseClasses = 'relative transition-all duration-300';

    $variantClasses = match($variant) {
        'interactive' => 'bg-white border border-slate-200/90 shadow-2xs hover:shadow-xl hover:border-slate-300 hover:-translate-y-1',
        'subtle' => 'bg-slate-50/80 border border-slate-200/70',
        'dark' => 'bg-[#070F1E] text-white border border-white/10 shadow-xl',
        default => 'bg-white border border-slate-200/80 shadow-2xs',
    };

    $radiusClasses = match($radius) {
        'xl' => 'rounded-xl',
        '3xl' => 'rounded-3xl',
        default => 'rounded-2xl',
    };

    $paddingClasses = match($padding) {
        'none' => '',
        'sm' => 'p-4 sm:p-5',
        'lg' => 'p-8 sm:p-10',
        default => 'p-6 sm:p-8',
    };
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses} {$radiusClasses} {$paddingClasses}"]) }}>
    {{ $slot }}
</{{ $as }}>
