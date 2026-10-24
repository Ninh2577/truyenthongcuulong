<div class="flex items-center gap-4 select-none py-1 group"
     :class="{ 'justify-center w-full': ! $store.sidebar.isOpen, 'cursor-pointer': ! $store.sidebar.isOpen }"
     @click="if (! $store.sidebar.isOpen) { $store.sidebar.open(); }"
     :title="! $store.sidebar.isOpen ? 'Nhấp để mở rộng menu' : ''"
>
    <!-- Brand Mark Icon -->
    <div class="relative flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500/10 via-orange-500/5 to-amber-500/10 border border-orange-500/25 shadow-2xs shrink-0 p-1 transition-all duration-300 group-hover:scale-105 group-hover:border-orange-500/40">
        <img src="{{ asset('images/logo-ttcl.png') }}" class="w-7 h-7 max-w-7 max-h-7 object-contain filter drop-shadow-xs" alt="Truyền Thông Cửu Long" />
    </div>

    <!-- Company Name (Hidden when sidebar is collapsed) -->
    <div x-show="$store.sidebar.isOpen" x-cloak class="flex items-center whitespace-nowrap pl-1 leading-none transition-all duration-200">
        <span class="font-bold text-[13.5px] text-slate-800 dark:text-slate-100 tracking-tight">
            Truyền Thông <span class="font-black text-[#FF5400]">Cửu Long</span>
        </span>
    </div>
</div>
