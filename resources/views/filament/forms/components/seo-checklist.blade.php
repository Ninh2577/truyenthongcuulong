@php
    $score = $result['score'] ?? 0;
    $breakdowns = $result['breakdown'] ?? [];
    
    $passedCount = collect($breakdowns)->where('status', true)->count();
    $totalCount = count($breakdowns);

    $level = match(true) {
        $score >= 80 => [
            'badge_text' => 'Rất Tốt',
            'advice' => 'Bài viết đã tối ưu SEO chuẩn Google, sẵn sàng xuất bản!',
            'color' => '#15803d',
            'stroke' => '#16a34a',
            'bg_card' => 'background-color: rgba(240, 253, 244, 0.85); border-color: #bbf7d0;',
            'bg_card_dark' => 'dark:bg-emerald-950/20 dark:border-emerald-800/60',
            'badge_bg' => '#dcfce7',
            'badge_border' => '#86efac',
            'dot' => '#16a34a',
            'bar_color' => '#16a34a',
        ],
        $score >= 50 => [
            'badge_text' => 'Trung Bình (Cần cải thiện)',
            'advice' => 'Hoàn thiện thêm các tiêu chí bên dưới để tối ưu thứ hạng tìm kiếm.',
            'color' => '#b45309',
            'stroke' => '#f59e0b',
            'bg_card' => 'background-color: rgba(254, 243, 199, 0.65); border-color: #fde68a;',
            'bg_card_dark' => 'dark:bg-amber-950/20 dark:border-amber-800/60',
            'badge_bg' => '#fef3c7',
            'badge_border' => '#fcd34d',
            'dot' => '#f59e0b',
            'bar_color' => '#f59e0b',
        ],
        default => [
            'badge_text' => 'Chưa Đạt (Cần tối ưu)',
            'advice' => 'Bài viết chưa đáp ứng các tiêu chuẩn SEO cơ bản của Google.',
            'color' => '#b91c1c',
            'stroke' => '#ef4444',
            'bg_card' => 'background-color: rgba(254, 242, 242, 0.75); border-color: #fecaca;',
            'bg_card_dark' => 'dark:bg-rose-950/20 dark:border-rose-800/60',
            'badge_bg' => '#fee2e2',
            'badge_border' => '#fca5a5',
            'dot' => '#ef4444',
            'bar_color' => '#ef4444',
        ],
    };
@endphp

<div class="space-y-3.5">
    <!-- Main Score Card -->
    <div class="p-3.5 sm:p-4 rounded-xl border shadow-xs transition-all {{ $level['bg_card_dark'] }}" style="{{ $level['bg_card'] }}">
        <div class="flex items-center gap-3.5">
            <!-- Vòng tròn điểm số (SVG Gauge) -->
            <div class="relative w-16 h-16 sm:w-18 sm:h-18 flex-shrink-0 flex items-center justify-center">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                    <!-- Background Circle -->
                    <path
                        class="text-gray-200 dark:text-gray-700/80"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="3"
                    />
                    <!-- Progress Circle -->
                    <path
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                        fill="none"
                        stroke="{{ $level['stroke'] }}"
                        stroke-width="3.2"
                        stroke-linecap="round"
                        stroke-dasharray="{{ $score }}, 100"
                        class="transition-all duration-700 ease-out"
                    />
                </svg>
                <!-- Điểm số bên trong: số to ở trên, /100 nhỏ ở dưới, không bao giờ bị tràn lố -->
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-lg sm:text-xl font-black leading-none tracking-tight" style="color: {{ $level['color'] }};">
                        {{ $score }}
                    </span>
                    <span class="text-[9px] font-semibold text-gray-500 dark:text-gray-400 tracking-wider mt-0.5">
                        /100
                    </span>
                </div>
            </div>

            <!-- Cột thông tin mức độ & lời khuyên -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-[11px] font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Mức độ</span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold leading-tight" style="background-color: {{ $level['badge_bg'] }}; color: {{ $level['color'] }}; border: 1px solid {{ $level['badge_border'] }};">
                        <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $level['dot'] }};"></span>
                        {{ $level['badge_text'] }}
                    </span>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-300 mt-1.5 leading-relaxed">
                    {{ $level['advice'] }}
                </p>
            </div>
        </div>

        <!-- Mini Progress Bar hoàn thành tiêu chí -->
        <div class="mt-3 pt-2.5 border-t border-gray-200/70 dark:border-gray-700/60">
            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-1.5">
                <span class="font-medium text-[11px]">Tiêu chí đạt chuẩn:</span>
                <span class="font-bold text-xs" style="color: {{ $level['color'] }};">{{ $passedCount }}/{{ $totalCount }}</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700/80 rounded-full h-1.5 overflow-hidden">
                <div class="h-1.5 rounded-full transition-all duration-500 ease-out" style="width: {{ $totalCount > 0 ? round(($passedCount / $totalCount) * 100) : 0 }}%; background-color: {{ $level['bar_color'] }};"></div>
            </div>
        </div>
    </div>

    <!-- Danh sách tiêu chí SEO Checklist -->
    <div class="rounded-xl border border-gray-200/80 dark:border-gray-800 bg-white/70 dark:bg-gray-900/40 p-2 sm:p-2.5 shadow-xs">
        <ul class="divide-y divide-gray-100 dark:divide-gray-800/80 text-xs sm:text-sm">
            @foreach($breakdowns as $item)
                <li class="flex items-center justify-between py-1.5 px-2 rounded-lg transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <div class="flex items-center space-x-2 min-w-0 pr-2">
                        @if($item['status'])
                            <x-heroicon-s-check-circle class="w-4 h-4 sm:w-4.5 sm:h-4.5 flex-shrink-0" style="color: #16a34a;" />
                            <span class="font-medium text-xs sm:text-sm text-gray-800 dark:text-gray-200 truncate">{{ $item['label'] }}</span>
                        @else
                            <x-heroicon-s-x-circle class="w-4 h-4 sm:w-4.5 sm:h-4.5 flex-shrink-0" style="color: #dc2626;" />
                            <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 truncate">{{ $item['label'] }}</span>
                        @endif
                    </div>
                    <span class="text-[11px] font-semibold flex-shrink-0 {{ $item['status'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-400 dark:text-gray-500' }}">
                        +{{ $item['score'] }}đ
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
