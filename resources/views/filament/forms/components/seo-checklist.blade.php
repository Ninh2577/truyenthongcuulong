@php
    $score = $result['score'] ?? 0;
    $breakdowns = $result['breakdown'] ?? [];
    $hasInput = $hasInput ?? (!empty(trim($result['focus_keyword'] ?? '')) && !empty(trim($result['title'] ?? '')));
    
    $passedCount = collect($breakdowns)->where('status', true)->count();
    $totalCount = count($breakdowns);
    $failedCount = $totalCount - $passedCount;
    $progressPercent = $totalCount > 0 ? round(($passedCount / $totalCount) * 100) : 0;

    $level = match(true) {
        $score >= 80 => [
            'level_title' => 'Rất Tốt',
            'status_label' => 'Đạt chuẩn SEO',
            'advice' => 'Bài viết đã tối ưu chuẩn SEO của Google, sẵn sàng xuất bản!',
            'color' => '#15803d',
            'stroke' => '#16a34a',
            'card_bg' => 'background: linear-gradient(135deg, rgba(240, 253, 244, 0.95) 0%, rgba(220, 252, 231, 0.6) 100%); border-color: #86efac;',
            'badge_bg' => '#dcfce7',
            'badge_text' => '#15803d',
            'badge_border' => '#86efac',
            'dot' => '#16a34a',
            'bar_gradient' => 'linear-gradient(90deg, #22c55e 0%, #16a34a 100%)',
        ],
        $score >= 50 => [
            'level_title' => 'Trung Bình',
            'status_label' => 'Cần cải thiện',
            'advice' => 'Hoàn thiện thêm các tiêu chí bên dưới để tối ưu thứ hạng tìm kiếm.',
            'color' => '#b45309',
            'stroke' => '#f59e0b',
            'card_bg' => 'background: linear-gradient(135deg, rgba(254, 243, 199, 0.95) 0%, rgba(253, 230, 138, 0.5) 100%); border-color: #fcd34d;',
            'badge_bg' => '#fef3c7',
            'badge_text' => '#b45309',
            'badge_border' => '#fcd34d',
            'dot' => '#f59e0b',
            'bar_gradient' => 'linear-gradient(90deg, #fbbf24 0%, #d97706 100%)',
        ],
        default => [
            'level_title' => 'Chưa Đạt',
            'status_label' => 'Cần tối ưu ngay',
            'advice' => 'Bài viết chưa đáp ứng các tiêu chuẩn SEO cơ bản của Google.',
            'color' => '#b91c1c',
            'stroke' => '#ef4444',
            'card_bg' => 'background: linear-gradient(135deg, rgba(254, 242, 242, 0.95) 0%, rgba(254, 226, 226, 0.5) 100%); border-color: #fca5a5;',
            'badge_bg' => '#fee2e2',
            'badge_text' => '#b91c1c',
            'badge_border' => '#fca5a5',
            'dot' => '#ef4444',
            'bar_gradient' => 'linear-gradient(90deg, #f87171 0%, #dc2626 100%)',
        ],
    };

    // Chuẩn hóa nhãn tiêu chí để ngắn gọn, chuyên nghiệp, không bị cắt chữ
    $friendlyLabels = [
        'meta_title' => 'Độ dài Meta Title (50-60 ký tự)',
        'meta_description' => 'Độ dài Meta Description (120-160 ký tự)',
        'thumbnail' => 'Có ảnh đại diện (Thumbnail)',
        'keyword_in_title' => 'Từ khóa trong Tiêu đề bài viết',
        'keyword_in_slug' => 'Từ khóa trong Đường dẫn (Slug)',
        'keyword_in_meta' => 'Từ khóa trong Meta Description',
        'keyword_in_content' => 'Từ khóa trong Nội dung bài viết',
        'content_length' => 'Nội dung dài hơn 600 từ',
        'content_images' => 'Bài viết có chứa hình ảnh',
        'internal_links' => 'Bài viết có chứa liên kết',
    ];
@endphp

<div class="space-y-4">
    @if(!$hasInput)
        <!-- EMPTY / NEUTRAL STATE: CHƯA PHÂN TÍCH -->
        <div class="p-6 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 bg-gray-50/70 dark:bg-gray-800/40 text-center transition-all">
            <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 flex items-center justify-center shadow-xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h4 class="text-sm font-bold text-gray-800 dark:text-gray-200 mb-1">Sẵn sàng phân tích</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400 max-w-sm mx-auto leading-relaxed">
                Nhập <strong>Từ khóa chính (Focus Keyword)</strong> và <strong>Tiêu đề bài viết</strong> để bắt đầu kiểm tra chuẩn Google.
            </p>
        </div>
    @else
        <!-- 1. BẢNG TỔNG QUAN ĐIỂM SEO & MỨC ĐỘ -->
        <div class="p-4 rounded-2xl border shadow-sm transition-all dark:bg-gray-900/60 dark:border-gray-800" style="{{ $level['card_bg'] }}">
            <div class="flex items-center gap-4">
                <!-- Vòng tròn điểm số (Gauge Chart) -->
                <div class="relative w-20 h-20 flex-shrink-0 flex items-center justify-center p-1 bg-white/80 dark:bg-gray-800/80 rounded-full shadow-xs">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                        <!-- Background Circle -->
                        <path
                            class="text-gray-200/90 dark:text-gray-700/80"
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
                    <!-- Điểm số bên trong -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-xl sm:text-2xl font-black leading-none tracking-tight" style="color: {{ $level['color'] }};">
                            {{ $score }}
                        </span>
                        <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 tracking-wider mt-0.5">
                            /100
                        </span>
                    </div>
                </div>

                <!-- Cột thông tin mức độ -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap mb-1">
                        <span class="text-[11px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Đánh giá</span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold leading-tight shadow-xs whitespace-nowrap" style="background-color: {{ $level['badge_bg'] }}; color: {{ $level['badge_text'] }}; border: 1px solid {{ $level['badge_border'] }};">
                            <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $level['dot'] }};"></span>
                            {{ $level['level_title'] }} ({{ $level['status_label'] }})
                        </span>
                    </div>
                    <p class="text-xs text-gray-700 dark:text-gray-300 leading-snug">
                        {{ $level['advice'] }}
                    </p>
                </div>
            </div>

            <!-- 2. KHỐI TIẾN ĐỘ TIÊU CHÍ -->
            <div class="mt-3.5 p-2.5 rounded-xl bg-white/70 dark:bg-gray-800/60 border border-black/5 dark:border-white/5 shadow-xs">
                <div class="flex items-center justify-between text-xs mb-1.5">
                    <span class="font-medium text-gray-600 dark:text-gray-300">Tiêu chí đạt chuẩn:</span>
                    <span class="font-bold text-xs" style="color: {{ $level['color'] }};">
                        {{ $passedCount }}/{{ $totalCount }} tiêu chí ({{ $progressPercent }}%)
                    </span>
                </div>
                <div class="w-full bg-gray-200/90 dark:bg-gray-700/80 rounded-full h-2 overflow-hidden">
                    <div class="h-2 rounded-full transition-all duration-500 ease-out" style="width: {{ $progressPercent }}%; background: {{ $level['bar_gradient'] }};"></div>
                </div>
            </div>
        </div>

        <!-- 3. DANH SÁCH CHI TIẾT CÁC TIÊU CHÍ (ACCORDION GẬP MỞ - MẶC ĐỊNH ĐÓNG) -->
        <div x-data="{ open: false }" class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-xs overflow-hidden">
            <!-- Header Accordion Trigger -->
            <button
                type="button"
                @click="open = !open"
                class="w-full px-3.5 py-2.5 bg-gray-50/80 dark:bg-gray-800/50 hover:bg-gray-100/70 dark:hover:bg-gray-800/80 transition-colors flex items-center justify-between text-left cursor-pointer border-b border-transparent"
                :class="{ 'border-gray-200/70 dark:border-gray-800': open }"
            >
                <div class="flex items-center gap-2">
                    <span class="text-[11px] font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Chi tiết tiêu chí Google</span>
                    <span class="text-xs text-primary-600 dark:text-primary-400 font-medium inline-flex items-center gap-1">
                        <span x-text="open ? 'Thu gọn' : 'Xem chi tiết tiêu chí ▼'">Xem chi tiết tiêu chí ▼</span>
                        <svg class="w-3.5 h-3.5 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-400 border border-emerald-200/70 dark:border-emerald-800/60">
                        {{ $passedCount }} Đạt
                    </span>
                    @if($failedCount > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-rose-50 text-rose-700 dark:bg-rose-950/50 dark:text-rose-400 border border-rose-200/70 dark:border-rose-800/60">
                            {{ $failedCount }} Cần tối ưu
                        </span>
                    @endif
                </div>
            </button>

            <!-- List tiêu chí: collapsible with Alpine -->
            <div x-show="open" x-transition.opacity.duration.200ms style="display: none;">
                <ul class="divide-y divide-gray-100 dark:divide-gray-800/70 text-xs sm:text-sm p-1">
                    @foreach($breakdowns as $key => $item)
                        @php
                            $displayLabel = $friendlyLabels[$key] ?? $item['label'];
                        @endphp
                        <li class="flex items-center justify-between py-2 px-2.5 rounded-xl transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50 gap-2">
                            <div class="flex items-center space-x-2.5 min-w-0 flex-1">
                                @if($item['status'])
                                    <div class="w-5 h-5 rounded-full flex items-center justify-center bg-emerald-100 dark:bg-emerald-950/60 flex-shrink-0">
                                        <x-heroicon-s-check class="w-3.5 h-3.5" style="color: #16a34a;" />
                                    </div>
                                    <span class="font-medium text-xs sm:text-[13px] text-gray-800 dark:text-gray-200 leading-tight">
                                        {{ $displayLabel }}
                                    </span>
                                @else
                                    <div class="w-5 h-5 rounded-full flex items-center justify-center bg-rose-100 dark:bg-rose-950/60 flex-shrink-0">
                                        <x-heroicon-s-x-mark class="w-3.5 h-3.5" style="color: #dc2626;" />
                                    </div>
                                    <span class="text-xs sm:text-[13px] text-gray-500 dark:text-gray-400 leading-tight">
                                        {{ $displayLabel }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex-shrink-0 pl-1">
                                @if($item['status'])
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-400 border border-emerald-200/60 dark:border-emerald-800/50">
                                        +{{ $item['score'] }}đ
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-[11px] font-semibold text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-800/50">
                                        +0đ
                                    </span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
