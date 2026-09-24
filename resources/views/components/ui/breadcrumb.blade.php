@props([
    'items' => [], // Array of ['label' => 'Title', 'url' => '/path'] (last item usually has no url)
    'class' => '',
])

@if(!empty($items))
<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => "flex items-center gap-1.5 sm:gap-2 text-xs font-mono text-slate-500 overflow-x-auto py-1 {$class}"]) }}>
    <ol class="flex items-center gap-1.5 sm:gap-2 whitespace-nowrap" itemscope itemtype="https://schema.org/BreadcrumbList">
        {{-- Home Link --}}
        <li class="inline-flex items-center gap-1.5" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-slate-500 hover:text-navy-base transition-colors" itemprop="item">
                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">home</span>
                <span itemprop="name">Trang chủ</span>
            </a>
            <meta itemprop="position" content="1" />
            <span class="text-slate-300" aria-hidden="true">/</span>
        </li>

        @php $pos = 2; @endphp
        @foreach($items as $index => $item)
            @php
                $isLast = ($index === count($items) - 1);
                $label = is_array($item) ? ($item['label'] ?? '') : $item;
                $url = is_array($item) ? ($item['url'] ?? null) : null;
            @endphp

            <li class="inline-flex items-center gap-1.5" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if(!$isLast && $url)
                    <a href="{{ url($url) }}" class="text-slate-500 hover:text-navy-base transition-colors truncate max-w-[150px] sm:max-w-none" itemprop="item">
                        <span itemprop="name">{{ $label }}</span>
                    </a>
                    <meta itemprop="position" content="{{ $pos++ }}" />
                    <span class="text-slate-300" aria-hidden="true">/</span>
                @else
                    <span class="text-slate-800 font-bold truncate max-w-[180px] sm:max-w-none" aria-current="page" itemprop="name">
                        {{ $label }}
                    </span>
                    <meta itemprop="position" content="{{ $pos++ }}" />
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
