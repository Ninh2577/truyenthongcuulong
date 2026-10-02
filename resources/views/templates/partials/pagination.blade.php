@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center gap-1.5 sm:gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-slate-200 text-slate-300 flex items-center justify-center cursor-not-allowed">
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-slate-200 bg-white hover:border-orange-500 hover:text-orange-500 text-slate-600 flex items-center justify-center transition-all shadow-2xs">
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center text-xs text-slate-400 font-bold tracking-widest">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-orange-500 text-white font-bold text-xs sm:text-sm flex items-center justify-center shadow-xs">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-white border border-transparent hover:border-slate-200 hover:bg-slate-50 text-slate-600 hover:text-orange-600 font-semibold text-xs sm:text-sm flex items-center justify-center transition-all">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-slate-200 bg-white hover:border-orange-500 hover:text-orange-500 text-slate-600 flex items-center justify-center transition-all shadow-2xs">
                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
            </a>
        @else
            <span class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-slate-200 text-slate-300 flex items-center justify-center cursor-not-allowed">
                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
            </span>
        @endif
    </nav>
@endif
