@props([
    'as' => 'div',
    'size' => 'default', // 'default' (7xl), 'narrow' (5xl), 'wide' (8xl), 'full'
    'class' => '',
])

@php
    $sizeClasses = match($size) {
        'narrow' => 'max-w-5xl',
        'wide' => 'max-w-[90rem]',
        'full' => 'max-w-full',
        default => 'max-w-7xl',
    };
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "w-full mx-auto px-4 sm:px-6 lg:px-8 {$sizeClasses} {$class}"]) }}>
    {{ $slot }}
</{{ $as }}>
