<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">Trạng thái SEO & Redirects</h2>
            <x-filament::button tag="a" href="/sitemap.xml" target="_blank" color="info" icon="heroicon-o-arrow-top-right-on-square">
                Mở Sitemap.xml
            </x-filament::button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="p-4 rounded-xl bg-white dark:bg-gray-900 ring-1 ring-gray-950/5 dark:ring-white/10 hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tổng số Redirect 301</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalRedirects }}</div>
            </div>
            <div class="p-4 rounded-xl bg-white dark:bg-gray-900 ring-1 ring-gray-950/5 dark:ring-white/10 hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tổng lượt truy cập (Hits) qua Redirect</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalHits }}</div>
            </div>
        </div>

        @if($duplicateUrls->count() > 0)
            <div class="p-4 rounded-xl bg-danger-50 text-danger-600 dark:bg-danger-500/10 dark:text-danger-400 ring-1 ring-danger-500/20">
                <div class="flex items-center gap-2 mb-3 font-bold text-base">
                    <x-filament::icon icon="heroicon-o-exclamation-triangle" class="w-6 h-6" />
                    CẢNH BÁO: Phát hiện {{ $duplicateUrls->count() }} URL bị cấu hình trùng lặp
                </div>
                <ul class="list-disc ml-8 text-sm space-y-1">
                    @foreach($duplicateUrls as $dup)
                        <li><strong>{{ $dup->old_url }}</strong> (xuất hiện {{ $dup->total }} lần)</li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="p-4 rounded-xl bg-success-50 text-success-600 dark:bg-success-500/10 dark:text-success-400 ring-1 ring-success-500/20 flex items-center justify-center">
                <div class="flex items-center gap-3 font-bold">
                    <div class="rounded-full bg-success-500/20 p-2 flex items-center justify-center">
                        <x-filament::icon icon="heroicon-o-check" class="w-6 h-6 text-success-600 dark:text-success-400" />
                    </div>
                    Khỏe mạnh: Không phát hiện trùng lặp URL
                </div>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
