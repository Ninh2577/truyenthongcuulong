@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="w-full py-6">

    {{-- Mobile: Prev / Next only --}}
    <div class="flex justify-between items-center sm:hidden gap-3">
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed select-none">
                <span class="material-symbols-outlined text-[15px]">arrow_back</span>
                Trước
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-navy-base bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md transition-all duration-200">
                <span class="material-symbols-outlined text-[15px]">arrow_back</span>
                Trước
            </a>
        @endif

        <span class="text-xs font-mono text-slate-500">
            Trang <span class="font-bold text-navy-base">{{ $paginator->currentPage() }}</span> / {{ $paginator->lastPage() }}
        </span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-navy-base bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md transition-all duration-200">
                Tiếp
                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
            </a>
        @else
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed select-none">
                Tiếp
                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
            </span>
        @endif
    </div>

    {{-- Desktop: Full pagination --}}
    <div class="hidden sm:flex sm:flex-col sm:items-center gap-4">

        {{-- Result info --}}
        <p class="text-xs font-mono text-slate-500 tracking-wide">
            @if ($paginator->firstItem())
                Hiển thị <span class="font-bold text-navy-base">{{ $paginator->firstItem() }}</span>–<span class="font-bold text-navy-base">{{ $paginator->lastItem() }}</span>
                trong tổng số <span class="font-bold text-primary">{{ $paginator->total() }}</span> kết quả
            @else
                {{ $paginator->count() }} kết quả
            @endif
        </p>

        {{-- Page buttons --}}
        <div class="flex items-center gap-1.5">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-300 bg-slate-100 border border-slate-200 cursor-not-allowed select-none" aria-label="{{ __('pagination.previous') }}">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-500 bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md hover:-translate-x-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30"
                   aria-label="{{ __('pagination.previous') }}">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </a>
            @endif

            {{-- Smart Compact Page Numbers --}}
            @php
                $curr = $paginator->currentPage();
                $last = $paginator->lastPage();
                
                if ($last <= 7) {
                    $smartPages = range(1, $last);
                } elseif ($curr <= 3) {
                    $smartPages = [1, 2, 3, 4, '...', $last];
                } elseif ($curr >= $last - 2) {
                    $smartPages = [1, '...', $last - 3, $last - 2, $last - 1, $last];
                } else {
                    $smartPages = [1, '...', $curr - 1, $curr, $curr + 1, '...', $last];
                }
            @endphp

            @foreach ($smartPages as $pageItem)
                {{-- "..." separator --}}
                @if ($pageItem === '...')
                    <span aria-disabled="true" class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-400 font-mono text-sm select-none">
                        ···
                    </span>
                {{-- Current page --}}
                @elseif ($pageItem == $paginator->currentPage())
                    <span aria-current="page"
                          class="w-9 h-9 inline-flex items-center justify-center rounded-full text-sm font-headline font-extrabold text-white bg-primary shadow-md shadow-primary/30 border border-primary/20 select-none cursor-default ring-2 ring-primary/20 ring-offset-1">
                        {{ $pageItem }}
                    </span>
                {{-- Page links --}}
                @else
                    <a href="{{ $paginator->url($pageItem) }}"
                       class="w-9 h-9 inline-flex items-center justify-center rounded-full text-sm font-headline font-semibold text-slate-600 bg-white border border-slate-200 shadow-sm hover:border-primary/60 hover:text-primary hover:bg-orange-50/60 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30"
                       aria-label="{{ __('Go to page :page', ['page' => $pageItem]) }}">
                        {{ $pageItem }}
                    </a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-500 bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md hover:translate-x-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30"
                   aria-label="{{ __('pagination.next') }}">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </a>
            @else
                <span aria-disabled="true" class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-300 bg-slate-100 border border-slate-200 cursor-not-allowed select-none" aria-label="{{ __('pagination.next') }}">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </span>
            @endif

        </div>
    </div>

</nav>
@endif
