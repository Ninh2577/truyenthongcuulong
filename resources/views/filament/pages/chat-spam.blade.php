<x-filament-panels::page>
<div class="cl-spam-wrap">
    <!-- Top Breadcrumb & Header Row -->
    <div class="cl-spam-header">
        <div class="cl-spam-header-left">
            <!-- Breadcrumb -->
            <div class="cl-spam-breadcrumb">
                <span>Cấu hình & Hệ thống</span>
                <span class="cl-crumb-sep">›</span>
                <span class="cl-crumb-active">Spam & Chặn</span>
            </div>

            <!-- Title & Subtitle with Shield Icon -->
            <div class="cl-spam-title-row">
                <div class="cl-shield-avatar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h1 class="cl-spam-title">Spam & Chặn</h1>
                    <p class="cl-spam-subtitle">Tự động phát hiện và ngăn chặn tin nhắn rác, hạn chế các hành vi spam và quản lý danh sách chặn.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics / Stat Cards Row (4 cards) -->
    <div class="cl-stats-grid">
        <!-- Card 1: Tin nhắn bị chặn -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap icon-red">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Tin nhắn bị chặn</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">1.248</span>
                    <span class="cl-stat-trend trend-up">↑ 12%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>

        <!-- Card 2: Số IP bị chặn -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap icon-blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Số IP bị chặn</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">368</span>
                    <span class="cl-stat-trend trend-up">↑ 8%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>

        <!-- Card 3: Số từ khóa spam -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap icon-orange">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Số từ khóa spam</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">125</span>
                    <span class="cl-stat-trend trend-up">↑ 5%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>

        <!-- Card 4: Danh sách chặn thủ công -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap icon-purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Danh sách chặn thủ công</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">42</span>
                    <span class="cl-stat-trend trend-up">↑ 2%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>
    </div>

    <!-- Main Content: 2 Columns Split Grid -->
    <div class="cl-main-spam-grid">
        <!-- Left Column: Cài đặt bảo vệ (approx 57%) -->
        <div class="cl-left-panel">
            <div class="cl-panel-card">
                <!-- Tabs Row -->
                <div class="cl-tabs-bar">
                    <button
                        type="button"
                        wire:click="switchTab('general')"
                        class="cl-tab-item {{ $activeTab === 'general' ? 'is-active' : '' }}"
                    >
                        Cài đặt chung
                    </button>
                    <button
                        type="button"
                        wire:click="switchTab('keywords')"
                        class="cl-tab-item {{ $activeTab === 'keywords' ? 'is-active' : '' }}"
                    >
                        Từ khóa spam
                    </button>
                    <button
                        type="button"
                        wire:click="switchTab('blacklist')"
                        class="cl-tab-item {{ $activeTab === 'blacklist' ? 'is-active' : '' }}"
                    >
                        Danh sách chặn
                    </button>
                    <button
                        type="button"
                        wire:click="switchTab('history')"
                        class="cl-tab-item {{ $activeTab === 'history' ? 'is-active' : '' }}"
                    >
                        Lịch sử xử lý
                    </button>
                </div>

                <!-- Settings Rows List -->
                @if($activeTab === 'general')
                    <div class="cl-settings-list">
                        <!-- Setting 1: Chặn tin nhắn rác tự động -->
                        <div class="cl-setting-box">
                            <div class="cl-sbox-left">
                                <div class="cl-sbox-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="cl-sbox-info">
                                    <div class="cl-sbox-title">Chặn tin nhắn rác tự động</div>
                                    <div class="cl-sbox-desc">Hệ thống sẽ tự động phát hiện và chặn các tin nhắn có dấu hiệu spam, quảng cáo, lừa đảo.</div>
                                </div>
                            </div>
                            <div class="cl-sbox-right">
                                <button
                                    type="button"
                                    wire:click="toggleSetting('auto_spam_block')"
                                    class="cl-toggle-switch {{ $auto_spam_block ? 'is-active' : '' }}"
                                    aria-label="Toggle auto spam block"
                                >
                                    <span class="cl-toggle-knob"></span>
                                </button>
                                <span class="cl-toggle-label">{{ $auto_spam_block ? 'Bật' : 'Tắt' }}</span>
                            </div>
                        </div>

                        <!-- Setting 2: Lọc theo từ khóa -->
                        <div class="cl-setting-box">
                            <div class="cl-sbox-left">
                                <div class="cl-sbox-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <div class="cl-sbox-info">
                                    <div class="cl-sbox-title">Lọc theo từ khóa</div>
                                    <div class="cl-sbox-desc">Tự động chặn tin nhắn chứa các từ khóa không phù hợp.</div>
                                </div>
                            </div>
                            <div class="cl-sbox-right">
                                <button
                                    type="button"
                                    wire:click="toggleSetting('keyword_filter')"
                                    class="cl-toggle-switch {{ $keyword_filter ? 'is-active' : '' }}"
                                    aria-label="Toggle keyword filter"
                                >
                                    <span class="cl-toggle-knob"></span>
                                </button>
                                <span class="cl-toggle-label">{{ $keyword_filter ? 'Bật' : 'Tắt' }}</span>
                                <a href="javascript:void(0)" wire:click="switchTab('keywords')" class="cl-manage-link">
                                    Quản lý từ khóa <span class="cl-arrow">›</span>
                                </a>
                            </div>
                        </div>

                        <!-- Setting 3: Chặn theo IP -->
                        <div class="cl-setting-box">
                            <div class="cl-sbox-left">
                                <div class="cl-sbox-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </div>
                                <div class="cl-sbox-info">
                                    <div class="cl-sbox-title">Chặn theo IP</div>
                                    <div class="cl-sbox-desc">Ngăn chặn các địa chỉ IP có hành vi gửi spam hoặc vi phạm chính sách.</div>
                                </div>
                            </div>
                            <div class="cl-sbox-right">
                                <button
                                    type="button"
                                    wire:click="toggleSetting('ip_filter')"
                                    class="cl-toggle-switch {{ $ip_filter ? 'is-active' : '' }}"
                                    aria-label="Toggle ip filter"
                                >
                                    <span class="cl-toggle-knob"></span>
                                </button>
                                <span class="cl-toggle-label">{{ $ip_filter ? 'Bật' : 'Tắt' }}</span>
                                <a href="javascript:void(0)" wire:click="switchTab('blacklist')" class="cl-manage-link">
                                    Quản lý IP <span class="cl-arrow">›</span>
                                </a>
                            </div>
                        </div>

                        <!-- Setting 4: Giới hạn tần suất gửi tin -->
                        <div class="cl-setting-box">
                            <div class="cl-sbox-left">
                                <div class="cl-sbox-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="cl-sbox-info">
                                    <div class="cl-sbox-title">Giới hạn tần suất gửi tin</div>
                                    <div class="cl-sbox-desc">Tự động chặn tạm thời nếu khách hàng gửi quá nhiều tin trong thời gian ngắn.</div>
                                </div>
                            </div>
                            <div class="cl-sbox-right">
                                <button
                                    type="button"
                                    wire:click="toggleSetting('rate_limit_filter')"
                                    class="cl-toggle-switch {{ $rate_limit_filter ? 'is-active' : '' }}"
                                    aria-label="Toggle rate limit"
                                >
                                    <span class="cl-toggle-knob"></span>
                                </button>
                                <span class="cl-toggle-label">{{ $rate_limit_filter ? 'Bật' : 'Tắt' }}</span>
                                <a href="javascript:void(0)" class="cl-manage-link">
                                    Cài đặt hạn mức <span class="cl-arrow">›</span>
                                </a>
                            </div>
                        </div>

                        <!-- Alert Box: Chế độ lọc thông minh đang hoạt động -->
                        <div class="cl-smart-alert-box">
                            <div class="cl-alert-left">
                                <div class="cl-alert-icon">
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="cl-alert-info">
                                    <div class="cl-alert-title">Chế độ lọc thông minh đang hoạt động</div>
                                    <div class="cl-alert-desc">Hệ thống đang sử dụng AI để phân tích hành vi và phát hiện spam theo thời gian thực.</div>
                                </div>
                            </div>
                            <div class="cl-alert-right">
                                <span class="cl-badge-active">
                                    <span class="cl-dot-green"></span> Đang hoạt động
                                </span>
                            </div>
                        </div>
                    </div>
                @elseif($activeTab === 'keywords')
                    <!-- Tab Từ khóa spam -->
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg text-xs leading-relaxed space-y-2">
                        <div class="font-semibold text-gray-900 text-sm">Quản lý nâng cao từ khóa kiểm duyệt</div>
                        <p class="text-gray-600">Khi khách truy cập gửi tin nhắn có chứa bất kỳ từ khóa nào trong danh sách được kích hoạt, tin nhắn sẽ bị chặn hoặc chuyển vào hàng chờ kiểm duyệt.</p>
                        <div class="pt-2">
                            <button type="button" wire:click="openAddKeywordModal" class="cl-btn-mini-add">
                                + Thêm từ khóa mới
                            </button>
                        </div>
                    </div>
                @elseif($activeTab === 'blacklist')
                    <!-- Tab Danh sách chặn -->
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg text-xs leading-relaxed space-y-2">
                        <div class="font-semibold text-gray-900 text-sm">Danh sách địa chỉ IP & Thiết bị bị chặn</div>
                        <p class="text-gray-600">Các địa chỉ IP bị chặn sẽ không thể gửi tin nhắn hoặc bắt đầu cuộc trò chuyện mới trên toàn bộ hệ thống website.</p>
                        <div class="pt-2">
                            <button type="button" wire:click="openAddIpModal" class="cl-btn-mini-add">
                                + Thêm IP mới vào danh sách
                            </button>
                        </div>
                    </div>
                @else
                    <!-- Tab Lịch sử xử lý -->
                    <div class="p-6 text-center text-gray-500 text-xs">
                        <div class="font-semibold text-gray-800 text-sm mb-1">Nhật ký xử lý vi phạm</div>
                        <p class="text-gray-500">Ghi nhận 1.248 sự kiện chặn tin nhắn và 368 lượt ngăn chặn IP tự động trong 7 ngày qua.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: 2 Tables (approx 43%) -->
        <div class="cl-right-panel">
            <!-- Card 1: Danh sách từ khóa spam -->
            <div class="cl-right-card">
                <div class="cl-rcard-header">
                    <div class="cl-rcard-title">
                        <svg class="cl-icon-shield-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Danh sách từ khóa spam</span>
                    </div>
                    <div class="cl-rcard-actions">
                        <a href="javascript:void(0)" wire:click="switchTab('keywords')" class="cl-view-all-link">Xem tất cả</a>
                        <button type="button" wire:click="openAddKeywordModal" class="cl-btn-add-action">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <span>Thêm từ khóa</span>
                        </button>
                    </div>
                </div>

                <div class="cl-mini-table-wrap">
                    <table class="cl-mini-table">
                        <thead>
                            <tr>
                                <th>Từ khóa</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($spamKeywords as $index => $kw)
                                <tr>
                                    <td class="font-medium text-slate-800">{{ $kw['keyword'] ?? '' }}</td>
                                    <td>
                                        @php
                                            $tClass = match($kw['type_class'] ?? 'ad') {
                                                'fraud' => 'badge-fraud',
                                                'inappropriate' => 'badge-inappropriate',
                                                default => 'badge-ad',
                                            };
                                        @endphp
                                        <span class="cl-type-badge {{ $tClass }}">
                                            {{ $kw['type'] ?? 'Quảng cáo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button
                                            type="button"
                                            wire:click="toggleKeyword({{ $index }})"
                                            class="cl-table-switch {{ ($kw['enabled'] ?? false) ? 'is-active' : '' }}"
                                            aria-label="Toggle keyword"
                                        >
                                            <span class="cl-table-knob"></span>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button
                                            type="button"
                                            wire:click="deleteKeyword({{ $index }})"
                                            class="cl-btn-trash"
                                            title="Xóa từ khóa"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Card 2: Danh sách IP bị chặn -->
            <div class="cl-right-card">
                <div class="cl-rcard-header">
                    <div class="cl-rcard-title">
                        <svg class="cl-icon-ban-red" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        <span>Danh sách IP bị chặn</span>
                    </div>
                    <div class="cl-rcard-actions">
                        <a href="javascript:void(0)" wire:click="switchTab('blacklist')" class="cl-view-all-link">Xem tất cả</a>
                        <button type="button" wire:click="openAddIpModal" class="cl-btn-add-action">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <span>Thêm IP</span>
                        </button>
                    </div>
                </div>

                <div class="cl-mini-table-wrap">
                    <table class="cl-mini-table">
                        <thead>
                            <tr>
                                <th>Địa chỉ IP</th>
                                <th>Lý do</th>
                                <th>Thời gian chặn</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blockedIps as $idx => $ipItem)
                                <tr>
                                    <td class="font-medium text-slate-800">{{ $ipItem['ip'] ?? '' }}</td>
                                    <td>
                                        <span class="cl-reason-text">{{ $ipItem['reason'] ?? 'Spam' }}</span>
                                    </td>
                                    <td class="text-slate-500 text-[11px]">{{ $ipItem['blocked_at'] ?? '' }}</td>
                                    <td class="text-center">
                                        <button
                                            type="button"
                                            wire:click="deleteIp({{ $idx }})"
                                            class="cl-btn-trash"
                                            title="Gỡ chặn IP"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Thêm từ khóa spam -->
    @if($showAddKeywordModal)
        <div class="cl-modal-backdrop" wire:click.self="$set('showAddKeywordModal', false)">
            <div class="cl-modal-card">
                <div class="cl-modal-header">
                    <h3 class="cl-modal-title">Thêm từ khóa kiểm duyệt mới</h3>
                    <button type="button" wire:click="$set('showAddKeywordModal', false)" class="cl-modal-close">✕</button>
                </div>
                <div class="cl-modal-body">
                    <div class="cl-mgroup">
                        <label class="cl-mlabel">Từ khóa hoặc cụm từ <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            wire:model="newKeyword"
                            placeholder="Ví dụ: nạp tiền, ưu đãi ảo..."
                            class="cl-minput"
                        />
                    </div>
                    <div class="cl-mgroup">
                        <label class="cl-mlabel">Phân loại</label>
                        <select wire:model="newKeywordType" class="cl-mselect">
                            <option value="Quảng cáo">Quảng cáo</option>
                            <option value="Lừa đảo">Lừa đảo</option>
                            <option value="Không phù hợp">Không phù hợp</option>
                        </select>
                    </div>
                </div>
                <div class="cl-modal-footer">
                    <button type="button" wire:click="$set('showAddKeywordModal', false)" class="cl-btn-cancel">Hủy</button>
                    <button type="button" wire:click="saveNewKeyword" class="cl-btn-confirm">Thêm từ khóa</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal: Thêm IP chặn -->
    @if($showAddIpModal)
        <div class="cl-modal-backdrop" wire:click.self="$set('showAddIpModal', false)">
            <div class="cl-modal-card">
                <div class="cl-modal-header">
                    <h3 class="cl-modal-title">Thêm IP vào danh sách chặn</h3>
                    <button type="button" wire:click="$set('showAddIpModal', false)" class="cl-modal-close">✕</button>
                </div>
                <div class="cl-modal-body">
                    <div class="cl-mgroup">
                        <label class="cl-mlabel">Địa chỉ IPv4 / IPv6 <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            wire:model="newIp"
                            placeholder="Ví dụ: 113.161.45.8"
                            class="cl-minput"
                        />
                    </div>
                    <div class="cl-mgroup">
                        <label class="cl-mlabel">Lý do chặn</label>
                        <select wire:model="newIpReason" class="cl-mselect">
                            <option value="Spam">Spam tin nhắn</option>
                            <option value="Tấn công">Tấn công / Dò quét</option>
                            <option value="Vi phạm chính sách">Vi phạm chính sách</option>
                        </select>
                    </div>
                </div>
                <div class="cl-modal-footer">
                    <button type="button" wire:click="$set('showAddIpModal', false)" class="cl-btn-cancel">Hủy</button>
                    <button type="button" wire:click="saveNewIp" class="cl-btn-confirm">Chặn IP</button>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Reset Filament Wrappers */
.fi-page-header, .fi-header {
    display: none !important;
}

.cl-spam-wrap {
    background-color: #f8fafc;
    margin: -1.5rem -1.5rem !important;
    padding: 1.5rem 1.75rem 3rem 1.75rem !important;
    min-height: 100vh;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #1e293b;
    box-sizing: border-box;
}

@media (min-width: 1024px) {
    .cl-spam-wrap {
        margin: -2rem -2rem !important;
        padding: 1.75rem 2rem 3.5rem 2rem !important;
    }
}

/* Header & Breadcrumb */
.cl-spam-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    gap: 1.25rem;
    margin-bottom: 1.25rem;
}

.cl-spam-header-left {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.cl-spam-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 13px;
    color: #64748b;
    font-weight: 400;
}

.cl-crumb-sep {
    color: #94a3b8;
    font-size: 13px;
}

.cl-crumb-active {
    color: #475569;
    font-weight: 500;
}

.cl-spam-title-row {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    margin-top: 2px;
}

.cl-shield-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background-color: #e0f2fe;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0284c7;
    flex-shrink: 0;
}

.cl-shield-avatar svg {
    width: 24px;
    height: 24px;
}

.cl-spam-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.01em;
}

.cl-spam-subtitle {
    font-size: 13px;
    color: #64748b;
    margin: 3px 0 0 0;
    line-height: 1.4;
}

/* Metrics Grid (4 Cards) */
.cl-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.25rem;
}

@media (max-width: 1024px) {
    .cl-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .cl-stats-grid {
        grid-template-columns: 1fr;
    }
}

.cl-stat-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 18px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

.cl-stat-icon-wrap {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-stat-icon-wrap.icon-red {
    background-color: #fee2e2;
    color: #dc2626;
}

.cl-stat-icon-wrap.icon-blue {
    background-color: #e0f2fe;
    color: #0284c7;
}

.cl-stat-icon-wrap.icon-orange {
    background-color: #ffedd5;
    color: #ea580c;
}

.cl-stat-icon-wrap.icon-purple {
    background-color: #f3e8ff;
    color: #9333ea;
}

.cl-stat-icon-wrap svg {
    width: 20px;
    height: 20px;
}

.cl-stat-info {
    display: flex;
    flex-direction: column;
}

.cl-stat-label {
    font-size: 12px;
    color: #64748b;
    font-weight: 500;
}

.cl-stat-num-row {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-top: 4px;
}

.cl-stat-value {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
}

.cl-stat-trend {
    font-size: 11.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.trend-up {
    color: #16a34a;
}

.cl-stat-sub {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 3px;
}

/* Main 2-Column Split Grid */
.cl-main-spam-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.32fr) minmax(380px, 1fr);
    gap: 1.25rem;
    align-items: start;
}

@media (max-width: 1200px) {
    .cl-main-spam-grid {
        grid-template-columns: 1fr;
    }
}

/* Left Panel */
.cl-left-panel {
    display: flex;
    flex-direction: column;
}

.cl-panel-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px 22px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

/* Tabs Bar */
.cl-tabs-bar {
    display: flex;
    align-items: center;
    gap: 24px;
    border-bottom: 1px solid #e2e8f0;
    margin-bottom: 20px;
    overflow-x: auto;
}

.cl-tab-item {
    background: transparent;
    border: none;
    padding: 8px 2px 10px 2px;
    font-size: 13px;
    font-weight: 500;
    color: #64748b;
    cursor: pointer;
    position: relative;
    white-space: nowrap;
    transition: color 0.15s ease;
}

.cl-tab-item:hover {
    color: #0f172a;
}

.cl-tab-item.is-active {
    color: #ff5400;
    font-weight: 600;
}

.cl-tab-item.is-active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #ff5400;
    border-radius: 2px;
}

/* Settings List */
.cl-settings-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.cl-setting-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 18px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    transition: border-color 0.15s ease;
}

.cl-setting-box:hover {
    border-color: #cbd5e1;
}

.cl-sbox-left {
    display: flex;
    align-items: center;
    gap: 14px;
    flex: 1;
}

.cl-sbox-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background-color: #e0f2fe;
    color: #0284c7;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-sbox-icon svg {
    width: 19px;
    height: 19px;
}

.cl-sbox-info {
    display: flex;
    flex-direction: column;
}

.cl-sbox-title {
    font-size: 13.5px;
    font-weight: 600;
    color: #0f172a;
}

.cl-sbox-desc {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
    line-height: 1.35;
}

.cl-sbox-right {
    display: flex;
    align-items: center;
    gap: 10px;
    white-space: nowrap;
}

.cl-toggle-switch {
    width: 38px;
    height: 22px;
    background-color: #cbd5e1;
    border-radius: 9999px;
    border: none;
    position: relative;
    cursor: pointer;
    transition: background-color 0.2s ease;
    padding: 2px;
}

.cl-toggle-switch.is-active {
    background-color: #2563eb;
}

.cl-toggle-knob {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 18px;
    height: 18px;
    background-color: #ffffff;
    border-radius: 50%;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.cl-toggle-switch.is-active .cl-toggle-knob {
    transform: translateX(16px);
}

.cl-toggle-label {
    font-size: 12px;
    font-weight: 500;
    color: #0f172a;
    min-width: 20px;
}

.cl-manage-link {
    font-size: 12px;
    color: #2563eb;
    font-weight: 500;
    text-decoration: none;
    margin-left: 8px;
    display: inline-flex;
    align-items: center;
    gap: 2px;
}

.cl-manage-link:hover {
    text-decoration: underline;
}

.cl-arrow {
    font-size: 14px;
}

/* Smart AI Alert Box */
.cl-smart-alert-box {
    background: #f0f7ff;
    border: 1px solid #bae6fd;
    border-radius: 10px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 8px;
}

.cl-alert-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.cl-alert-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #2563eb;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-alert-icon svg {
    width: 14px;
    height: 14px;
}

.cl-alert-info {
    display: flex;
    flex-direction: column;
}

.cl-alert-title {
    font-size: 13px;
    font-weight: 600;
    color: #0f172a;
}

.cl-alert-desc {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
}

.cl-badge-active {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 500;
    background-color: #dcfce7;
    color: #16a34a;
    border: 1px solid #bbf7d0;
    white-space: nowrap;
}

.cl-dot-green {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #16a34a;
}

/* Right Panel: 2 Cards */
.cl-right-panel {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.cl-right-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    overflow: hidden;
}

.cl-rcard-header {
    padding: 12px 18px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
}

.cl-rcard-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    font-weight: 700;
    color: #0f172a;
}

.cl-icon-shield-orange {
    width: 18px;
    height: 18px;
    color: #ea580c;
}

.cl-icon-ban-red {
    width: 18px;
    height: 18px;
    color: #dc2626;
}

.cl-rcard-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.cl-view-all-link {
    font-size: 12px;
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
}

.cl-view-all-link:hover {
    text-decoration: underline;
}

.cl-btn-add-action {
    background-color: #ff5400;
    color: #ffffff;
    font-size: 12px;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    padding: 5px 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(255, 84, 0, 0.2);
    transition: all 0.15s ease;
}

.cl-btn-add-action:hover {
    background-color: #e64a00;
}

/* Mini Tables */
.cl-mini-table-wrap {
    width: 100%;
    overflow-x: auto;
}

.cl-mini-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12.5px;
    text-align: left;
}

.cl-mini-table thead tr {
    border-bottom: 1px solid #f1f5f9;
    background: #ffffff;
}

.cl-mini-table th {
    padding: 10px 14px;
    font-size: 11.5px;
    font-weight: 600;
    color: #64748b;
    white-space: nowrap;
}

.cl-mini-table td {
    padding: 10px 14px;
    border-bottom: 1px solid #f8fafc;
    vertical-align: middle;
}

.cl-mini-table tbody tr:hover {
    background-color: #f8fafc;
}

/* Badges for types */
.cl-type-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 9999px;
    font-size: 11px;
    font-weight: 500;
    white-space: nowrap;
}

.badge-ad {
    background-color: #e0f2fe;
    color: #0284c7;
    border: 1px solid #bae6fd;
}

.badge-fraud {
    background-color: #fee2e2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.badge-inappropriate {
    background-color: #dcfce7;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}

.cl-reason-text {
    color: #ef4444;
    font-weight: 500;
    font-size: 12px;
}

/* Mini Switch inside Table */
.cl-table-switch {
    width: 32px;
    height: 18px;
    background-color: #cbd5e1;
    border-radius: 9999px;
    border: none;
    position: relative;
    cursor: pointer;
    transition: background-color 0.2s ease;
    padding: 2px;
}

.cl-table-switch.is-active {
    background-color: #2563eb;
}

.cl-table-knob {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 14px;
    height: 14px;
    background-color: #ffffff;
    border-radius: 50%;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.cl-table-switch.is-active .cl-table-knob {
    transform: translateX(14px);
}

.cl-btn-trash {
    background: transparent;
    border: none;
    color: #ef4444;
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background 0.15s;
}

.cl-btn-trash svg {
    width: 15px;
    height: 15px;
}

.cl-btn-trash:hover {
    background: #fee2e2;
}

.cl-btn-mini-add {
    background-color: #ff5400;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 7px 14px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}

/* Modals */
.cl-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 1rem;
}

.cl-modal-card {
    background: #ffffff;
    border-radius: 12px;
    width: 100%;
    max-width: 440px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    animation: clFadeIn 0.15s ease-out;
}

@keyframes clFadeIn {
    from { opacity: 0; transform: scale(0.96); }
    to { opacity: 1; transform: scale(1); }
}

.cl-modal-header {
    padding: 14px 18px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cl-modal-title {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.cl-modal-close {
    background: transparent;
    border: none;
    font-size: 16px;
    color: #94a3b8;
    cursor: pointer;
}

.cl-modal-body {
    padding: 16px 18px;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.cl-mgroup {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cl-mlabel {
    font-size: 12px;
    font-weight: 600;
    color: #334155;
}

.cl-minput, .cl-mselect {
    width: 100%;
    height: 38px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 12px;
    font-size: 13px;
    color: #1e293b;
    outline: none;
    box-sizing: border-box;
}

.cl-minput:focus, .cl-mselect:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

.cl-modal-footer {
    padding: 12px 18px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    background: #f8fafc;
}

.cl-btn-cancel {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 6px 14px;
    font-size: 12px;
    color: #475569;
    cursor: pointer;
}

.cl-btn-confirm {
    background: #ff5400;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 6px 16px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}
</style>
</x-filament-panels::page>
