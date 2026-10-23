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
            'level_title' => 'Xuất Sắc',
            'status_label' => 'Đạt chuẩn SEO Google',
            'advice' => 'Tuyệt vời! Bài viết đã tối ưu rất tốt các tiêu chuẩn xếp hạng của Google.',
            'color' => '#10b981',
            'stroke' => '#10b981',
            'card_bg' => 'linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(16, 185, 129, 0.02) 100%)',
            'card_border' => 'rgba(16, 185, 129, 0.25)',
            'badge_bg' => 'rgba(16, 185, 129, 0.15)',
            'badge_text' => '#059669',
            'dot' => '#10b981',
            'bar_gradient' => 'linear-gradient(90deg, #34d399 0%, #059669 100%)',
        ],
        $score >= 50 => [
            'level_title' => 'Khá Tốt',
            'status_label' => 'Cần cải thiện thêm',
            'advice' => 'Bài viết cơ bản đã ổn. Hoàn thiện thêm các mục chưa đạt để bứt phá Top 1.',
            'color' => '#f59e0b',
            'stroke' => '#f59e0b',
            'card_bg' => 'linear-gradient(135deg, rgba(245, 158, 11, 0.08) 0%, rgba(245, 158, 11, 0.02) 100%)',
            'card_border' => 'rgba(245, 158, 11, 0.25)',
            'badge_bg' => 'rgba(245, 158, 11, 0.15)',
            'badge_text' => '#d97706',
            'dot' => '#f59e0b',
            'bar_gradient' => 'linear-gradient(90deg, #fbbf24 0%, #d97706 100%)',
        ],
        default => [
            'level_title' => 'Chưa Đạt',
            'status_label' => 'Cần tối ưu ngay',
            'advice' => 'Chưa đáp ứng tiêu chuẩn SEO cơ bản. Xem danh sách bên dưới để bổ sung.',
            'color' => '#ef4444',
            'stroke' => '#ef4444',
            'card_bg' => 'linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(239, 68, 68, 0.02) 100%)',
            'card_border' => 'rgba(239, 68, 68, 0.25)',
            'badge_bg' => 'rgba(239, 68, 68, 0.15)',
            'badge_text' => '#dc2626',
            'dot' => '#ef4444',
            'bar_gradient' => 'linear-gradient(90deg, #f87171 0%, #dc2626 100%)',
        ],
    };

    // Metadata chi tiết cho từng tiêu chí: Tên chuẩn, mô tả ngắn, gợi ý tối ưu
    $metaDetails = [
        'meta_title' => [
            'title' => 'Độ dài Meta Title',
            'group' => 'snippet',
            'hint' => 'Độ dài lý tưởng từ 50-60 ký tự giúp hiển thị trọn vẹn trên Google không bị cắt ngắn.',
            'points' => 10,
        ],
        'meta_description' => [
            'title' => 'Độ dài Meta Description',
            'group' => 'snippet',
            'hint' => 'Độ dài lý tưởng từ 120-160 ký tự kích thích tỉ lệ nhấp CTR cao nhất.',
            'points' => 10,
        ],
        'keyword_in_slug' => [
            'title' => 'Từ khóa trong Đường dẫn (Slug)',
            'group' => 'keyword',
            'hint' => 'URL chứa từ khóa chính giúp Google nhận diện chủ đề trang nhanh chóng.',
            'points' => 15,
        ],
        'keyword_in_title' => [
            'title' => 'Từ khóa trong Tiêu đề bài viết',
            'group' => 'keyword',
            'hint' => 'Tiêu đề chính nên xuất hiện từ khóa mục tiêu, ưu tiên ở nửa đầu câu.',
            'points' => 15,
        ],
        'keyword_in_meta' => [
            'title' => 'Từ khóa trong Meta Description',
            'group' => 'keyword',
            'hint' => 'Google sẽ tự động in đậm từ khóa trong kết quả tìm kiếm khi người dùng gõ từ khóa này.',
            'points' => 10,
        ],
        'keyword_in_content' => [
            'title' => 'Từ khóa trong Nội dung bài viết',
            'group' => 'keyword',
            'hint' => 'Từ khóa nên xuất hiện tự nhiên trong các đoạn mở đầu và thân bài.',
            'points' => 15,
        ],
        'thumbnail' => [
            'title' => 'Có ảnh đại diện (Thumbnail)',
            'group' => 'media',
            'hint' => 'Ảnh đại diện chất lượng cao giúp tăng tỉ lệ click khi chia sẻ lên mạng xã hội.',
            'points' => 10,
        ],
        'content_length' => [
            'title' => 'Độ dài bài viết (> 600 từ)',
            'group' => 'content',
            'hint' => 'Nội dung có chiều sâu trên 600 từ được Google ưu tiên đánh giá là bài viết chất lượng.',
            'points' => 5,
        ],
        'content_images' => [
            'title' => 'Bài viết có hình ảnh minh họa',
            'group' => 'media',
            'hint' => 'Hình ảnh giúp người đọc dễ tiếp thu và kéo dài thời gian đọc trên trang.',
            'points' => 5,
        ],
        'internal_links' => [
            'title' => 'Bài viết có liên kết nội bộ',
            'group' => 'content',
            'hint' => 'Liên kết đến các trang dịch vụ hoặc bài viết khác để điều hướng người đọc.',
            'points' => 5,
        ],
    ];

    $metaTitle = $formData['meta_title'] ?? '';
    $metaDesc = $formData['meta_description'] ?? '';
    $postTitle = $formData['title'] ?? '';
    $slug = $formData['slug'] ?? '';
    $focusKeyword = $formData['focus_keyword'] ?? '';
    
    $displayTitle = !empty(trim($metaTitle)) ? $metaTitle : (!empty(trim($postTitle)) ? $postTitle : 'Tiêu đề bài viết sẽ hiển thị tại đây...');
    $displayDesc = !empty(trim($metaDesc)) ? $metaDesc : 'Mô tả ngắn gọn về bài viết sẽ hiển thị trên kết quả tìm kiếm Google nhằm kích thích người dùng truy cập...';
    $displayUrl = 'https://truyenthongcuulong.com/' . ($slug ? $slug : 'duong-dan-bai-viet');
@endphp

<div 
    x-data="{
        viewMode: 'checklist', // 'checklist' hoặc 'serp'
        filterTab: '{{ $failedCount > 0 ? 'failed' : 'all' }}', // 'failed', 'passed', 'all'
        serpDevice: 'desktop' // 'desktop' hoặc 'mobile'
    }"
    class="cl-seo-container"
>
    <style>
        .cl-seo-container {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .cl-seo-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            gap: 8px;
            flex-wrap: wrap;
        }
        .cl-seo-view-tabs {
            display: inline-flex;
            background: #f1f5f9;
            padding: 3px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        .dark .cl-seo-view-tabs {
            background: #1e293b;
            border-color: #334155;
        }
        .cl-seo-tab-btn {
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .cl-seo-tab-btn:hover {
            color: #0f172a;
        }
        .dark .cl-seo-tab-btn:hover {
            color: #f8fafc;
        }
        .cl-seo-tab-btn.active {
            background: #ffffff;
            color: #0f172a;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        .dark .cl-seo-tab-btn.active {
            background: #0f172a;
            color: #f8fafc;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* SCORE HERO CARD */
        .cl-score-card {
            border-radius: 14px;
            padding: 16px;
            background: {{ $level['card_bg'] }};
            border: 1px solid {{ $level['card_border'] }};
            margin-bottom: 14px;
            transition: all 0.2s ease;
        }
        .cl-score-top {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .cl-gauge-box {
            position: relative;
            width: 72px;
            height: 72px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
        .dark .cl-gauge-box {
            background: #0f172a;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        .cl-gauge-svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }
        .cl-gauge-num {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }
        .cl-gauge-val {
            font-size: 22px;
            font-weight: 800;
            line-height: 1;
            color: {{ $level['color'] }};
        }
        .cl-gauge-max {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            margin-top: 1px;
        }

        .cl-score-info {
            flex: 1;
            min-width: 0;
        }
        .cl-score-badge-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
            flex-wrap: wrap;
        }
        .cl-score-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            background: {{ $level['badge_bg'] }};
            color: {{ $level['badge_text'] }};
            border: 1px solid {{ $level['card_border'] }};
        }
        .cl-score-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: {{ $level['dot'] }};
        }
        .cl-score-advice {
            font-size: 12px;
            color: #475569;
            line-height: 1.45;
        }
        .dark .cl-score-advice {
            color: #cbd5e1;
        }

        /* PROGRESS LINE */
        .cl-score-bar-box {
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        .dark .cl-score-bar-box {
            border-top-color: rgba(255, 255, 255, 0.08);
        }
        .cl-score-bar-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11.5px;
            margin-bottom: 5px;
        }
        .cl-score-track {
            height: 6px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }
        .dark .cl-score-track {
            background: #334155;
        }
        .cl-score-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease-out;
            background: {{ $level['bar_gradient'] }};
        }

        /* FILTER BUTTONS ROW */
        .cl-filter-bar {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }
        .dark .cl-filter-bar {
            border-bottom-color: #334155;
        }
        .cl-filter-btn {
            padding: 4px 10px;
            font-size: 11.5px;
            font-weight: 600;
            border-radius: 7px;
            border: 1px solid transparent;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .cl-filter-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
        .dark .cl-filter-btn:hover {
            background: #1e293b;
            color: #f8fafc;
        }
        .cl-filter-btn.active-failed {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border-color: rgba(239, 68, 68, 0.25);
        }
        .cl-filter-btn.active-passed {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-color: rgba(16, 185, 129, 0.25);
        }
        .cl-filter-btn.active-all {
            background: #f1f5f9;
            color: #0f172a;
            border-color: #cbd5e1;
        }
        .dark .cl-filter-btn.active-all {
            background: #1e293b;
            color: #f8fafc;
            border-color: #475569;
        }

        /* CHECKLIST ITEMS */
        .cl-check-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
            max-height: 480px;
            overflow-y: auto;
            padding-right: 2px;
        }
        .cl-check-item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            transition: all 0.15s ease;
        }
        .dark .cl-check-item {
            background: #0f172a;
            border-color: #1e293b;
        }
        .cl-check-item:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }
        .dark .cl-check-item:hover {
            border-color: #334155;
            background: #131c31;
        }
        .cl-check-left {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            min-width: 0;
            flex: 1;
        }
        .cl-check-icon {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
            font-size: 10px;
            font-weight: 800;
        }
        .cl-check-icon.pass {
            background: #dcfce7;
            color: #15803d;
        }
        .dark .cl-check-icon.pass {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }
        .cl-check-icon.fail {
            background: #fee2e2;
            color: #b91c1c;
        }
        .dark .cl-check-icon.fail {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }
        .cl-check-text {
            min-width: 0;
            flex: 1;
        }
        .cl-check-name {
            font-size: 12px;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.3;
        }
        .dark .cl-check-name {
            color: #e2e8f0;
        }
        .cl-check-hint {
            font-size: 11px;
            color: #64748b;
            margin-top: 2px;
            line-height: 1.35;
        }
        .dark .cl-check-hint {
            color: #94a3b8;
        }
        .cl-check-badge {
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
            flex-shrink: 0;
            font-family: ui-monospace, SFMono-Regular, monospace;
        }
        .cl-check-badge.pass {
            background: #dcfce7;
            color: #166534;
        }
        .dark .cl-check-badge.pass {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
        }
        .cl-check-badge.fail {
            background: #f1f5f9;
            color: #94a3b8;
        }
        .dark .cl-check-badge.fail {
            background: #1e293b;
            color: #64748b;
        }

        /* GOOGLE SERP PREVIEW STYLING */
        .cl-serp-box {
            border-radius: 14px;
            padding: 16px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        .dark .cl-serp-box {
            background: #0f172a;
            border-color: #1e293b;
        }
        .cl-serp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f5f9;
        }
        .dark .cl-serp-header {
            border-bottom-color: #1e293b;
        }
        .cl-serp-device-switch {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .cl-serp-device-btn {
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: transparent;
            color: #64748b;
            cursor: pointer;
        }
        .dark .cl-serp-device-btn {
            border-color: #334155;
        }
        .cl-serp-device-btn.active {
            background: #ff5e14;
            color: #ffffff;
            border-color: #ff5e14;
        }
        .cl-serp-snippet {
            padding: 12px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-family: arial, sans-serif;
        }
        .dark .cl-serp-snippet {
            background: #131c31;
            border-color: #1e293b;
        }
        .cl-serp-url-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }
        .cl-serp-favicon {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ff5e14;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            flex-shrink: 0;
        }
        .cl-serp-site-name {
            font-size: 12px;
            font-weight: 500;
            color: #202124;
            line-height: 1.2;
        }
        .dark .cl-serp-site-name {
            color: #dadce0;
        }
        .cl-serp-url {
            font-size: 11px;
            color: #4d5156;
            line-height: 1.2;
            word-break: break-all;
        }
        .dark .cl-serp-url {
            color: #bdc1c6;
        }
        .cl-serp-title {
            font-size: 18px;
            color: #1a0dab;
            line-height: 1.3;
            margin: 4px 0 6px 0;
            cursor: pointer;
            word-break: break-word;
        }
        .dark .cl-serp-title {
            color: #8ab4f8;
        }
        .cl-serp-title:hover {
            text-decoration: underline;
        }
        .cl-serp-desc {
            font-size: 13px;
            color: #4d5156;
            line-height: 1.5;
            word-break: break-word;
        }
        .dark .cl-serp-desc {
            color: #bdc1c6;
        }
        .cl-serp-desc strong {
            color: #202124;
            font-weight: 700;
        }
        .dark .cl-serp-desc strong {
            color: #ffffff;
        }
    </style>

    <!-- NAVIGATION VIEW SWITCHER -->
    <div class="cl-seo-nav">
        <div class="cl-seo-view-tabs">
            <button 
                type="button" 
                @click="viewMode = 'checklist'" 
                :class="{ 'active': viewMode === 'checklist' }"
                class="cl-seo-tab-btn"
            >
                <span>📊</span>
                <span>Tiêu chuẩn SEO ({{ $passedCount }}/{{ $totalCount }})</span>
            </button>
            <button 
                type="button" 
                @click="viewMode = 'serp'" 
                :class="{ 'active': viewMode === 'serp' }"
                class="cl-seo-tab-btn"
            >
                <span>🔍</span>
                <span>Google SERP Preview</span>
            </button>
        </div>

        @if($hasInput)
            <span style="font-size: 11px; font-weight: 600; color: #94a3b8;">
                Real-time Livewire Analysis
            </span>
        @endif
    </div>

    @if(!$hasInput)
        <!-- EMPTY STATE: CHƯA CÓ DỮ LIỆU ĐỂ PHÂN TÍCH -->
        <div style="padding: 24px 16px; text-align: center; border-radius: 14px; background: #f8fafc; border: 1px dashed #cbd5e1;" class="dark:bg-slate-900/50 dark:border-slate-800">
            <div style="width: 44px; height: 44px; margin: 0 auto 10px; border-radius: 50%; background: rgba(14, 165, 233, 0.12); color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                🎯
            </div>
            <div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 4px;" class="dark:text-slate-200">
                Sẵn sàng chấm điểm SEO Google
            </div>
            <div style="font-size: 11.5px; color: #64748b; max-width: 320px; margin: 0 auto; line-height: 1.5;">
                Vui lòng nhập <strong>Từ khóa chính (Focus Keyword)</strong> và <strong>Tiêu đề bài viết</strong> để hệ thống tự động kiểm tra theo thuật toán Google.
            </div>
        </div>
    @else
        <!-- VIEW 1: BẢNG TIÊU CHUẨN & CHẤM ĐIỂM -->
        <div x-show="viewMode === 'checklist'">
            <!-- SCORE HERO CARD -->
            <div class="cl-score-card">
                <div class="cl-score-top">
                    <!-- Gauge Donut -->
                    <div class="cl-gauge-box">
                        <svg class="cl-gauge-svg" viewBox="0 0 36 36">
                            <path
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#e2e8f0"
                                class="dark:stroke-slate-700"
                                stroke-width="3.5"
                            />
                            <path
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="{{ $level['stroke'] }}"
                                stroke-width="3.5"
                                stroke-linecap="round"
                                stroke-dasharray="{{ $score }}, 100"
                                style="transition: stroke-dasharray 0.6s ease;"
                            />
                        </svg>
                        <div class="cl-gauge-num">
                            <span class="cl-gauge-val">{{ $score }}</span>
                            <span class="cl-gauge-max">/100</span>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="cl-score-info">
                        <div class="cl-score-badge-row">
                            <span class="cl-score-pill">
                                <span class="cl-score-dot"></span>
                                {{ $level['level_title'] }} • {{ $level['status_label'] }}
                            </span>
                        </div>
                        <div class="cl-score-advice">
                            {{ $level['advice'] }}
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="cl-score-bar-box">
                    <div class="cl-score-bar-meta">
                        <span style="font-weight: 600; color: #475569;" class="dark:text-slate-400">Tiêu chí đạt:</span>
                        <span style="font-weight: 700; color: {{ $level['color'] }};">
                            {{ $passedCount }} / {{ $totalCount }} mục ({{ $progressPercent }}%)
                        </span>
                    </div>
                    <div class="cl-score-track">
                        <div class="cl-score-fill" style="width: {{ $progressPercent }}%;"></div>
                    </div>
                </div>
            </div>

            <!-- SMART FILTER TOOLBAR (KHẮC PHỤC RỐI MẮT) -->
            <div class="cl-filter-bar">
                <button 
                    type="button" 
                    @click="filterTab = 'failed'" 
                    :class="{ 'active-failed': filterTab === 'failed' }"
                    class="cl-filter-btn"
                >
                    <span>⚠️ Cần tối ưu</span>
                    <span style="font-weight: 700; padding: 1px 6px; border-radius: 10px; font-size: 10px; background: rgba(239, 68, 68, 0.15);">
                        {{ $failedCount }}
                    </span>
                </button>

                <button 
                    type="button" 
                    @click="filterTab = 'passed'" 
                    :class="{ 'active-passed': filterTab === 'passed' }"
                    class="cl-filter-btn"
                >
                    <span>✓ Đã đạt</span>
                    <span style="font-weight: 700; padding: 1px 6px; border-radius: 10px; font-size: 10px; background: rgba(16, 185, 129, 0.15);">
                        {{ $passedCount }}
                    </span>
                </button>

                <button 
                    type="button" 
                    @click="filterTab = 'all'" 
                    :class="{ 'active-all': filterTab === 'all' }"
                    class="cl-filter-btn"
                >
                    <span>Tất cả ({{ $totalCount }})</span>
                </button>
            </div>

            <!-- CHECKLIST ITEMS LIST -->
            <div class="cl-check-list">
                @foreach($breakdowns as $key => $item)
                    @php
                        $isPassed = (bool) $item['status'];
                        $meta = $metaDetails[$key] ?? [
                            'title' => $item['label'],
                            'hint' => '',
                            'points' => $item['score'] ?? 5,
                        ];
                    @endphp
                    <div 
                        x-show="filterTab === 'all' || (filterTab === 'passed' && {{ $isPassed ? 'true' : 'false' }}) || (filterTab === 'failed' && {{ !$isPassed ? 'true' : 'false' }})"
                        class="cl-check-item"
                    >
                        <div class="cl-check-left">
                            <span class="cl-check-icon {{ $isPassed ? 'pass' : 'fail' }}">
                                {{ $isPassed ? '✓' : '✕' }}
                            </span>
                            <div class="cl-check-text">
                                <div class="cl-check-name">
                                    {{ $meta['title'] }}
                                </div>
                                <div class="cl-check-hint">
                                    {{ $meta['hint'] }}
                                </div>
                            </div>
                        </div>

                        <div class="cl-check-badge {{ $isPassed ? 'pass' : 'fail' }}">
                            {{ $isPassed ? '+' . $meta['points'] . 'đ' : '+0đ' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- VIEW 2: GOOGLE SERP PREVIEW (MÔ PHỎNG GOOGLE SEARCH) -->
        <div x-show="viewMode === 'serp'" style="display: none;">
            <div class="cl-serp-box">
                <div class="cl-serp-header">
                    <div style="font-size: 12px; font-weight: 700; color: #334155;" class="dark:text-slate-300">
                        Mô phỏng kết quả tìm kiếm Google
                    </div>
                    <div class="cl-serp-device-switch">
                        <button 
                            type="button" 
                            @click="serpDevice = 'desktop'" 
                            :class="{ 'active': serpDevice === 'desktop' }"
                            class="cl-serp-device-btn"
                        >
                            🖥️ Desktop
                        </button>
                        <button 
                            type="button" 
                            @click="serpDevice = 'mobile'" 
                            :class="{ 'active': serpDevice === 'mobile' }"
                            class="cl-serp-device-btn"
                        >
                            📱 Mobile
                        </button>
                    </div>
                </div>

                <div class="cl-serp-snippet" :style="serpDevice === 'mobile' ? 'max-width: 375px; margin: 0 auto;' : ''">
                    <!-- Favicon & URL -->
                    <div class="cl-serp-url-row">
                        <div class="cl-serp-favicon">
                            CL
                        </div>
                        <div>
                            <div class="cl-serp-site-name">Truyền Thông Cửu Long</div>
                            <div class="cl-serp-url">{{ $displayUrl }}</div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="cl-serp-title">
                        {{ $displayTitle }}
                    </div>

                    <!-- Description -->
                    <div class="cl-serp-desc">
                        @if($focusKeyword)
                            {!! preg_replace('/(' . preg_quote($focusKeyword, '/') . ')/iu', '<strong>$1</strong>', e($displayDesc)) !!}
                        @else
                            {{ $displayDesc }}
                        @endif
                    </div>
                </div>

                <!-- SEO TIP FOOTER -->
                <div style="margin-top: 12px; padding: 8px 12px; border-radius: 8px; background: rgba(14, 165, 233, 0.08); font-size: 11.5px; color: #0369a1; display: flex; align-items: center; gap: 8px;">
                    <span>💡</span>
                    <span>Google sẽ tự động bôi đậm các từ khóa trùng với truy vấn tìm kiếm của người dùng trong phần mô tả.</span>
                </div>
            </div>
        </div>
    @endif
</div>
