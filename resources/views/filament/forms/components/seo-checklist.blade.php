@php
    $score = $result['score'] ?? 0;
    $breakdowns = $result['breakdown'] ?? [];
    
    $level = match(true) {
        $score >= 80 => ['color' => 'text-success-600 dark:text-success-400', 'bg' => 'bg-success-50 dark:bg-success-900/30', 'border' => 'border-success-200 dark:border-success-800', 'text' => 'Rất Tốt (Tuyệt vời)'],
        $score >= 50 => ['color' => 'text-warning-600 dark:text-warning-400', 'bg' => 'bg-warning-50 dark:bg-warning-900/30', 'border' => 'border-warning-200 dark:border-warning-800', 'text' => 'Trung Bình (Cần cải thiện)'],
        default => ['color' => 'text-danger-600 dark:text-danger-400', 'bg' => 'bg-danger-50 dark:bg-danger-900/30', 'border' => 'border-danger-200 dark:border-danger-800', 'text' => 'Kém (Cần tối ưu ngay)'],
    };
@endphp

<div class="space-y-4">
    <!-- Main Score Card -->
    <div class="flex items-center p-4 rounded-xl border {{ $level['border'] }} {{ $level['bg'] }}">
        <div class="relative w-16 h-16 flex-none mr-4">
            <svg class="w-full h-full" viewBox="0 0 36 36">
                <!-- Background Circle -->
                <path
                    class="text-white dark:text-gray-700"
                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="3"
                />
                <!-- Progress Circle -->
                <path
                    class="{{ $level['color'] }}"
                    stroke-dasharray="{{ $score }}, 100"
                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="3"
                />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-lg font-bold {{ $level['color'] }}">{{ $score }}/100</span>
            </div>
        </div>
        <div>
            <h4 class="text-base font-bold mb-1 {{ $level['color'] }}">Mức độ: {{ $level['text'] }}</h4>
            <p class="text-xs text-gray-600 dark:text-gray-400">Hoàn thiện các tiêu chí bên dưới để tối đa hóa điểm SEO.</p>
        </div>
    </div>

    <ul class="space-y-2 text-sm mt-4">
        @foreach($breakdowns as $item)
            <li class="flex items-start space-x-2">
                @if($item['status'])
                    <x-heroicon-o-check-circle class="w-5 h-5 flex-none" style="color: #16a34a;" />
                    <span class="font-medium" style="color: #15803d;">{{ $item['label'] }}</span>
                @else
                    <x-heroicon-o-x-circle class="w-5 h-5 flex-none" style="color: #dc2626;" />
                    <span style="color: #b91c1c;">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
