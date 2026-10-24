<x-filament-widgets::widget>
    @php
        $hour = (int) now()->format('H');
        $greeting = $hour < 12 ? 'Chào buổi sáng' : ($hour < 18 ? 'Chào buổi chiều' : 'Chào buổi tối');
        $rawName = auth()->user()?->name ? trim((string) auth()->user()->name) : '';
        $userName = (empty($rawName) || str_contains($rawName, '@')) ? 'Quản trị viên' : $rawName;
        $postCreateUrl = \App\Filament\Resources\PostResource::getUrl('create');
        $caseStudyCreateUrl = \App\Filament\Resources\CaseStudyResource::getUrl('create');
        $partnerCreateUrl = \App\Filament\Resources\PartnerResource::getUrl('create');
        $mediaUrl = \App\Filament\Pages\MediaLibrary::getUrl();
    @endphp

    <div class="cl-custom-card p-5 shadow-sm transition-all duration-200">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Left: Greeting & Status -->
            <div class="space-y-1">
                <div class="flex items-center gap-2.5">
                    <h2 class="cl-title text-xl md:text-2xl font-bold tracking-tight">
                        {{ $greeting }}, {{ $userName }} 👋
                    </h2>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 border border-emerald-200/60 dark:border-emerald-800/40">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Trực tuyến
                    </span>
                </div>
                <p class="cl-subtext text-sm">
                    Tổng quan hoạt động & dữ liệu vận hành của Cửu Long Media hôm nay.
                </p>
            </div>

            <!-- Right: Quick Actions Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ $postCreateUrl }}" 
                   style="background-color: #FF5400; color: #ffffff;"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold shadow-sm hover:opacity-90 transition-all duration-150 active:scale-95">
                    <x-heroicon-m-pencil-square class="w-4 h-4 text-white" />
                    <span class="text-white font-medium">Bài viết mới</span>
                </a>

                <a href="{{ $caseStudyCreateUrl }}" 
                   class="cl-btn-secondary inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-150 active:scale-95">
                    <x-heroicon-m-briefcase class="w-4 h-4 opacity-70" />
                    <span>Dự án mới</span>
                </a>

                <a href="{{ $partnerCreateUrl }}" 
                   class="cl-btn-secondary inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-150 active:scale-95">
                    <x-heroicon-m-user-group class="w-4 h-4 opacity-70" />
                    <span>Đối tác mới</span>
                </a>

                <a href="{{ $mediaUrl }}" 
                   class="cl-btn-secondary inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-150 active:scale-95">
                    <x-heroicon-m-photo class="w-4 h-4 opacity-70" />
                    <span>Thư viện Media</span>
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
