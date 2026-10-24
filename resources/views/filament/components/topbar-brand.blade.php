<div class="flex items-center gap-3 py-1 select-none" x-data="{}">
    <!-- Brand badge on topbar when sidebar is collapsed on desktop -->
    <div x-show="! $store.sidebar.isOpen" x-cloak class="hidden lg:flex items-center gap-2.5 transition-all duration-200">
        <a href="{{ filament()->getHomeUrl() }}" class="flex items-center gap-2 group">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold text-[#FF5400] bg-orange-500/10 border border-orange-500/20 group-hover:bg-orange-500/15 transition-all">
                TRUYỀN THÔNG CỬU LONG
            </span>
            <span class="text-xs text-slate-300 dark:text-slate-600">/</span>
            <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">
                Hệ Thống Quản Trị
            </span>
        </a>
    </div>

    <!-- Active workspace context pill when sidebar is open on desktop -->
    <div x-show="$store.sidebar.isOpen" class="hidden lg:flex items-center gap-2">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11.5px] font-medium bg-slate-100/90 hover:bg-slate-200/80 text-slate-700 dark:bg-slate-800/80 dark:hover:bg-slate-700/70 dark:text-slate-300 border border-slate-200/80 dark:border-slate-700/80 transition-colors shadow-2xs">
            <span class="relative flex h-2 w-2 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="font-bold text-slate-800 dark:text-slate-100 tracking-tight">Truyền Thông Cửu Long</span>
            <span class="text-slate-300 dark:text-slate-600">|</span>
            <span class="text-slate-500 dark:text-slate-400">Trung Tâm Điều Hành & Quản Trị Hệ Thống</span>
        </span>
    </div>
</div>
