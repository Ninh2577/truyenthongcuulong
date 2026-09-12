<section class="w-full bg-slate-50 border-b border-slate-200/80 py-6 lg:py-7 overflow-hidden" id="marquee-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
        <div class="flex items-center justify-center gap-3 text-center">
            <span class="h-px w-8 bg-slate-300"></span>
            <p class="font-mono text-xs font-bold uppercase tracking-widest text-slate-500">
                Đối Tác Chiến Lược &bull; Khách Hàng Đồng Hành Cùng Truyền Thông Cửu Long
            </p>
            <span class="h-px w-8 bg-slate-300"></span>
        </div>
    </div>

    <div class="flex flex-col gap-3">
        <!-- Dải 1: ĐỐI TÁC CHIẾN LƯỢC (Cuộn sang trái) -->
        <div class="marquee-container relative w-full overflow-hidden flex items-center py-1">
            <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-28 z-10 pointer-events-none bg-gradient-to-r from-slate-50 to-transparent"></div>
            <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-28 z-10 pointer-events-none bg-gradient-to-l from-slate-50 to-transparent"></div>

            <div class="marquee-track flex items-center gap-3 sm:gap-4 shrink-0">
                @foreach(array_merge($marqueePartners->all(), $marqueePartners->all()) as $partner)
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:bg-orange-50/20 hover:shadow-xs transition-all duration-200 group shrink-0">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary/80 group-hover:scale-125 transition-transform"></span>
                        <span class="font-headline font-bold text-slate-700 text-xs sm:text-sm tracking-wide group-hover:text-navy-base whitespace-nowrap">{{ $partner->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Dải 2: KHÁCH HÀNG ĐỒNG HÀNH (Cuộn theo chiều ngược lại) -->
        <div class="marquee-container relative w-full overflow-hidden flex items-center py-1">
            <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-28 z-10 pointer-events-none bg-gradient-to-r from-slate-50 to-transparent"></div>
            <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-28 z-10 pointer-events-none bg-gradient-to-l from-slate-50 to-transparent"></div>

            <div class="marquee-track-reverse flex items-center gap-3 sm:gap-4 shrink-0">
                @foreach(array_merge($marqueeClients->all(), $marqueeClients->all()) as $client)
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-white border border-slate-200/90 shadow-2xs hover:border-sky-500/50 hover:bg-sky-50/20 hover:shadow-xs transition-all duration-200 group shrink-0">
                        <span class="w-1.5 h-1.5 rounded-full bg-sky-600/80 group-hover:scale-125 transition-transform"></span>
                        <span class="font-headline font-bold text-slate-700 text-xs sm:text-sm tracking-wide group-hover:text-navy-base whitespace-nowrap">{{ $client->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>