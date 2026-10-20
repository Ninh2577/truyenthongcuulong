<x-filament-panels::page>
@php
    $filteredScripts = $this->getFilteredScripts();
    $paginatedScripts = $this->getPaginatedScripts();
    $selected = $this->getSelectedScript();
    $totalCount = $this->totalCount;
    $activeCount = $this->activeCount;
    $pausedCount = $this->pausedCount;
    $totalUsage = $this->totalUsage;
    $successRate = $this->successRate;
    $totalError = $this->totalError;
    $conflictsCount = count($this->conflictsList);
@endphp

<div class="cl-auto-wrap" x-data="automationCenter()">
    <!-- Top Breadcrumb & Header Row -->
    <div class="cl-auto-header">
        <div class="cl-auto-header-left">
            <!-- Breadcrumb -->
            <div class="cl-auto-breadcrumb">
                <span>Truyền thông & CSKH</span>
                <span class="cl-crumb-sep">›</span>
                <span class="cl-crumb-active">Kịch bản tự động</span>
                <span class="cl-crumb-sep">›</span>
                <span class="cl-crumb-badge">Automation Center</span>
            </div>

            <!-- Title & Subtitle with Robot Icon -->
            <div class="cl-auto-title-row">
                <div class="cl-robot-avatar">
                    <svg class="cl-robot-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                        <circle cx="12" cy="5" r="2"></circle>
                        <path d="M12 7v4"></path>
                        <line x1="8" y1="16" x2="8" y2="16"></line>
                        <line x1="16" y1="16" x2="16" y2="16"></line>
                    </svg>
                </div>
                <div>
                    <div class="cl-header-title-flex">
                        <h1 class="cl-auto-title">KỊCH BẢN TỰ ĐỘNG</h1>
                        <span class="cl-title-badge">Automation Center</span>
                    </div>
                    <p class="cl-auto-subtitle">Tạo, kiểm thử và quản lý các luồng tự động hóa chuyên nghiệp cho Chat & CSKH Cửu Long.</p>
                </div>
            </div>
        </div>

        <!-- Top Right Actions Toolbar -->
        <div class="cl-auto-header-right">
            <!-- Search Box with / shortcut indicator -->
            <div class="cl-search-box">
                <svg class="cl-search-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                <input
                    id="cl-search-input"
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Tìm kịch bản... (Phím /)"
                    class="cl-search-input"
                />
                <span class="cl-kbd-tag">/</span>
            </div>

            <!-- Tool buttons -->
            <button
                type="button"
                wire:click="openTestModal"
                class="cl-btn-secondary"
                title="Kiểm thử kịch bản tự động"
            >
                <span>🧪</span>
                <span class="cl-btn-label">Kiểm tra</span>
            </button>

            @if($conflictsCount > 0)
                <button
                    type="button"
                    wire:click="openConflictModal"
                    class="cl-btn-warning-badge"
                    title="Phát hiện xung đột giữa các kịch bản"
                >
                    <span class="cl-pulse-dot"></span>
                    <span>Xung đột ({{ $conflictsCount }})</span>
                </button>
            @endif

            <button
                type="button"
                wire:click="openLogModal"
                class="cl-btn-secondary"
                title="Xem lịch sử thực thi"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="cl-btn-label">Nhật ký</span>
            </button>

            <button
                type="button"
                wire:click="openVersionModal"
                class="cl-btn-secondary"
                title="Lịch sử phiên bản"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="cl-btn-label">Phiên bản</span>
            </button>

            <button
                type="button"
                wire:click="toggleShortcutModal"
                class="cl-btn-secondary"
                title="Phím tắt trợ giúp (?)"
            >
                <span class="cl-kbd-tag">?</span>
            </button>

            <!-- Create Button -->
            <button
                type="button"
                wire:click="createNewScript"
                class="cl-btn-create"
                title="Tạo kịch bản mới (Phím N)"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tạo kịch bản</span>
                <span class="cl-kbd-tag-light">N</span>
            </button>
        </div>
    </div>

    <!-- KPI Summary Row (6 Metrics Cards - Real Data Only) -->
    <div class="cl-kpi-grid">
        <div class="cl-kpi-card">
            <div class="cl-kpi-icon-wrap is-blue">
                <svg class="cl-kpi-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </div>
            <div class="cl-kpi-info">
                <div class="cl-kpi-label">Tổng kịch bản</div>
                <div class="cl-kpi-value">{{ $totalCount }}</div>
            </div>
        </div>

        <div class="cl-kpi-card">
            <div class="cl-kpi-icon-wrap is-green">
                <svg class="cl-kpi-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="cl-kpi-info">
                <div class="cl-kpi-label">Đang hoạt động</div>
                <div class="cl-kpi-value is-green-text">{{ $activeCount }}</div>
            </div>
        </div>

        <div class="cl-kpi-card">
            <div class="cl-kpi-icon-wrap is-amber">
                <svg class="cl-kpi-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="cl-kpi-info">
                <div class="cl-kpi-label">Tạm dừng</div>
                <div class="cl-kpi-value is-slate-text">{{ $pausedCount }}</div>
            </div>
        </div>

        <div class="cl-kpi-card">
            <div class="cl-kpi-icon-wrap is-orange">
                <svg class="cl-kpi-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div class="cl-kpi-info">
                <div class="cl-kpi-label">Tổng lượt kích hoạt</div>
                <div class="cl-kpi-value">{{ number_format($totalUsage, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="cl-kpi-card">
            <div class="cl-kpi-icon-wrap is-emerald">
                <svg class="cl-kpi-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <div class="cl-kpi-info">
                <div class="cl-kpi-label">Tỷ lệ thành công</div>
                <div class="cl-kpi-value is-emerald-text">{{ $successRate }}</div>
            </div>
        </div>

        <div class="cl-kpi-card">
            <div class="cl-kpi-icon-wrap {{ $totalError > 0 ? 'is-red' : 'is-gray' }}">
                <svg class="cl-kpi-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="cl-kpi-info">
                <div class="cl-kpi-label">Automation lỗi</div>
                <div class="cl-kpi-value {{ $totalError > 0 ? 'is-red-text' : 'is-slate-text' }}">{{ $totalError }}</div>
            </div>
        </div>
    </div>

    <!-- Conflict Warning Banner (if any) -->
    @if($conflictsCount > 0)
        <div class="cl-conflict-banner">
            <div class="cl-conflict-banner-left">
                <span class="cl-conflict-icon">⚠️</span>
                <div>
                    <strong>Cảnh báo xung đột ({{ $conflictsCount }}):</strong>
                    <span>Có kịch bản tự động trùng lặp từ khóa kích hoạt hoặc cùng mức ưu tiên (Priority).</span>
                </div>
            </div>
            <button type="button" wire:click="openConflictModal" class="cl-btn-banner-action">
                Xem chi tiết xung đột
            </button>
        </div>
    @endif

    <!-- Filter & Sort Bar -->
    <div class="cl-filter-toolbar">
        <!-- Category Pills -->
        <div class="cl-filter-pills">
            <button
                type="button"
                wire:click="setFilter('all')"
                class="cl-filter-pill {{ $activeFilter === 'all' ? 'active' : '' }}"
            >
                <span>Tất cả</span>
                <span class="cl-pill-count">{{ $totalCount }}</span>
            </button>

            <button
                type="button"
                wire:click="setFilter('welcome')"
                class="cl-filter-pill {{ $activeFilter === 'welcome' ? 'active' : '' }}"
            >
                <span>Chào mừng</span>
                <span class="cl-pill-count">{{ count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'welcome')) }}</span>
            </button>

            <button
                type="button"
                wire:click="setFilter('consulting')"
                class="cl-filter-pill {{ $activeFilter === 'consulting' ? 'active' : '' }}"
            >
                <span>Tư vấn dịch vụ</span>
                <span class="cl-pill-count">{{ count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'consulting')) }}</span>
            </button>

            <button
                type="button"
                wire:click="setFilter('care')"
                class="cl-filter-pill {{ $activeFilter === 'care' ? 'active' : '' }}"
            >
                <span>Chăm sóc KH</span>
                <span class="cl-pill-count">{{ count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'care')) }}</span>
            </button>

            <button
                type="button"
                wire:click="setFilter('other')"
                class="cl-filter-pill {{ $activeFilter === 'other' ? 'active' : '' }}"
            >
                <span>Khác</span>
                <span class="cl-pill-count">{{ count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'other')) }}</span>
            </button>
        </div>

        <!-- Filter Dropdowns: Status, Trigger, Priority, Sorting -->
        <div class="cl-dropdown-filters">
            <!-- Status Dropdown -->
            <select wire:model.live="statusFilter" class="cl-select-filter">
                <option value="all">Trạng thái: Tất cả</option>
                <option value="active">Đang hoạt động</option>
                <option value="paused">Tạm dừng</option>
            </select>

            <!-- Trigger Dropdown -->
            <select wire:model.live="triggerFilter" class="cl-select-filter">
                <option value="all">Kích hoạt: Tất cả</option>
                <option value="welcome">Tin nhắn đầu tiên</option>
                <option value="quote">Từ khóa báo giá</option>
                <option value="service">Từ khóa dịch vụ</option>
                <option value="after_care">Lịch chăm sóc sau</option>
                <option value="spam">Bộ lọc chống Spam</option>
            </select>

            <!-- Priority Dropdown -->
            <select wire:model.live="priorityFilter" class="cl-select-filter">
                <option value="all">Ưu tiên: Tất cả</option>
                <option value="high">Cao (P1 - P10)</option>
                <option value="medium">Trung bình (P11 - P25)</option>
                <option value="low">Tiêu chuẩn (P26+)</option>
            </select>

            <!-- Sorting Dropdown -->
            <select wire:model.live="sortBy" class="cl-select-filter">
                <option value="priority">Sắp xếp: Độ ưu tiên</option>
                <option value="usage_count">Sắp xếp: Lượt dùng nhiều</option>
                <option value="name">Sắp xếp: Tên kịch bản</option>
                <option value="updated_at">Sắp xếp: Mới cập nhật</option>
            </select>
        </div>
    </div>

    <!-- Bulk Action Bar (when items are checked) -->
    @if(count($selectedIds) > 0)
        <div class="cl-bulk-bar">
            <div class="cl-bulk-left">
                <span class="cl-bulk-check-icon">✓</span>
                <span>Đã chọn: <strong>{{ count($selectedIds) }}</strong> kịch bản</span>
            </div>
            <div class="cl-bulk-actions">
                <button type="button" wire:click="bulkActivate" class="cl-btn-bulk is-green">
                    Bật đã chọn (Shift+A)
                </button>
                <button type="button" wire:click="bulkPause" class="cl-btn-bulk is-amber">
                    Tạm dừng (Shift+P)
                </button>
                <button type="button" wire:click="openBulkDeleteConfirm" class="cl-btn-bulk is-red">
                    Xóa đã chọn
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content: 2 Columns Split Grid -->
    <div class="cl-main-grid">
        <!-- Left Column: Scripts Table (approx 68%) -->
        <div class="cl-table-card">
            <div class="cl-table-responsive">
                <table class="cl-table">
                    <thead>
                        <tr>
                            <th class="cl-th-check">
                                <input
                                    type="checkbox"
                                    wire:click="toggleSelectAll"
                                    {{ $selectAll ? 'checked' : '' }}
                                    class="cl-checkbox"
                                    aria-label="Chọn tất cả"
                                />
                            </th>
                            <th class="cl-th-priority" wire:click="setSorting('priority')">
                                <div class="cl-th-sortable">
                                    <span>P</span>
                                    @if($sortBy === 'priority')
                                        <span class="cl-sort-arrow">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="cl-th-name" wire:click="setSorting('name')">
                                <div class="cl-th-sortable">
                                    <span>Tên kịch bản</span>
                                    @if($sortBy === 'name')
                                        <span class="cl-sort-arrow">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="cl-th-cat">Loại</th>
                            <th class="cl-th-trigger">Điều kiện kích hoạt</th>
                            <th class="cl-th-status">Trạng thái</th>
                            <th class="cl-th-uses" wire:click="setSorting('usage_count')">
                                <div class="cl-th-sortable">
                                    <span>Lượt dùng</span>
                                    @if($sortBy === 'usage_count')
                                        <span class="cl-sort-arrow">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="cl-th-actions">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paginatedScripts as $s)
                            @php
                                $isSelected = ($selectedScriptId === ($s['id'] ?? ''));
                                $isChecked = in_array($s['id'], $selectedIds);
                                $priorityVal = (int) ($s['priority'] ?? 50);
                                $pBadgeClass = match(true) {
                                    $priorityVal <= 10 => 'p-high',
                                    $priorityVal <= 25 => 'p-med',
                                    default => 'p-low',
                                };
                            @endphp
                            <tr
                                wire:click="selectScript('{{ $s['id'] }}')"
                                class="cl-tr {{ $isSelected ? 'is-selected' : '' }}"
                            >
                                <!-- Checkbox -->
                                <td class="cl-td-check" wire:click.stop>
                                    <input
                                        type="checkbox"
                                        wire:click="toggleSelect('{{ $s['id'] }}')"
                                        {{ $isChecked ? 'checked' : '' }}
                                        class="cl-checkbox"
                                        aria-label="Chọn kịch bản {{ $s['name'] }}"
                                    />
                                </td>

                                <!-- Priority Tag -->
                                <td class="cl-td-priority">
                                    <span class="cl-priority-tag {{ $pBadgeClass }}" title="Độ ưu tiên: {{ $priorityVal }} (Số nhỏ hơn ưu tiên cao hơn)">
                                        P{{ $priorityVal }}
                                    </span>
                                </td>

                                <!-- Tên kịch bản + Icon + Desc -->
                                <td class="cl-td-name">
                                    <div class="cl-name-wrapper">
                                        <div class="cl-script-icon-wrap" style="background-color: {{ $s['icon_bg'] ?? '#e0f2fe' }}; color: {{ $s['icon_color'] ?? '#0284c7' }};">
                                            @if(($s['icon'] ?? '') === 'chat')
                                                <svg class="cl-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                            @elseif(($s['icon'] ?? '') === 'document')
                                                <svg class="cl-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            @elseif(($s['icon'] ?? '') === 'phone')
                                                <svg class="cl-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            @elseif(($s['icon'] ?? '') === 'user')
                                                <svg class="cl-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            @elseif(($s['icon'] ?? '') === 'shield')
                                                <svg class="cl-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            @else
                                                <svg class="cl-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="cl-name-info">
                                            <div class="cl-script-title-row">
                                                <span class="cl-script-title">{{ $s['name'] ?? '' }}</span>
                                                <span class="cl-cooldown-chip">⏱ {{ $s['cooldown_seconds'] ?? 30 }}s</span>
                                            </div>
                                            <div class="cl-script-desc">{{ $s['desc'] ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Loại -->
                                <td class="cl-td-cat">
                                    @php
                                        $cat = $s['category'] ?? '';
                                        $badgeClass = match($cat) {
                                            'welcome' => 'badge-welcome',
                                            'consulting' => 'badge-consulting',
                                            'care' => 'badge-care',
                                            default => 'badge-other',
                                        };
                                    @endphp
                                    <span class="cl-badge {{ $badgeClass }}">
                                        {{ $s['category_label'] ?? 'Khác' }}
                                    </span>
                                </td>

                                <!-- Điều kiện kích hoạt -->
                                <td class="cl-td-trigger">
                                    <span class="cl-trigger-text" title="{{ $s['trigger'] ?? '' }}">
                                        {{ $s['trigger'] ?? '' }}
                                    </span>
                                </td>

                                <!-- Trạng thái (Toggle Switch) -->
                                <td class="cl-td-status" wire:click.stop>
                                    <div class="cl-toggle-wrap">
                                        <button
                                            type="button"
                                            wire:click="toggleScript('{{ $s['id'] }}')"
                                            class="cl-switch {{ ($s['enabled'] ?? false) ? 'is-active' : '' }}"
                                            aria-label="Toggle script status"
                                        >
                                            <span class="cl-switch-knob"></span>
                                        </button>
                                        <span class="cl-status-label {{ ($s['enabled'] ?? false) ? 'is-active' : 'is-inactive' }}">
                                            {{ ($s['enabled'] ?? false) ? 'Đang bật' : 'Tạm dừng' }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Lượt sử dụng & Tỷ lệ thành công -->
                                <td class="cl-td-uses">
                                    <div class="cl-uses-cell">
                                        <span class="cl-uses-count">{{ number_format((int)($s['usage_count'] ?? 0), 0, ',', '.') }}</span>
                                        @if(($s['error_count'] ?? 0) > 0)
                                            <span class="cl-err-chip">Lỗi: {{ $s['error_count'] }}</span>
                                        @else
                                            <span class="cl-ok-chip">100% OK</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Thao tác -->
                                <td class="cl-td-actions" wire:click.stop>
                                    <div class="cl-actions-wrap">
                                        <button
                                            type="button"
                                            wire:click="editScript('{{ $s['id'] }}')"
                                            class="cl-act-btn"
                                            title="Chỉnh sửa (E)"
                                            aria-label="Chỉnh sửa"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            wire:click="duplicateScript('{{ $s['id'] }}')"
                                            class="cl-act-btn"
                                            title="Nhân bản (D)"
                                            aria-label="Nhân bản"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                                <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            wire:click="deleteScript('{{ $s['id'] }}')"
                                            wire:confirm="Bạn có chắc chắn muốn xóa kịch bản này không?"
                                            class="cl-act-btn is-danger"
                                            title="Xóa kịch bản"
                                            aria-label="Xóa kịch bản"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="cl-empty-row">
                                    <div class="cl-empty-box">
                                        <span class="cl-empty-icon">🔍</span>
                                        <p class="cl-empty-title">Không tìm thấy kịch bản nào phù hợp</p>
                                        <p class="cl-empty-desc">Thử thay đổi từ khóa tìm kiếm hoặc bỏ bớt các bộ lọc đang chọn.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer: Count & Pagination -->
            <div class="cl-table-footer">
                <div class="cl-footer-count">
                    Hiển thị <strong>{{ count($paginatedScripts) }}</strong> / <strong>{{ count($filteredScripts) }}</strong> kịch bản (Tổng hệ thống: {{ $totalCount }})
                </div>

                <div class="cl-pagination">
                    <button
                        type="button"
                        wire:click="previousPage"
                        class="cl-page-nav {{ $currentPage <= 1 ? 'is-disabled' : '' }}"
                        {{ $currentPage <= 1 ? 'disabled' : '' }}
                        aria-label="Trang trước"
                    >
                        ‹ Trước
                    </button>

                    @for($p = 1; $p <= $this->totalPages; $p++)
                        <button
                            type="button"
                            wire:click="gotoPage({{ $p }})"
                            class="cl-page-num {{ $currentPage === $p ? 'is-active' : '' }}"
                        >
                            {{ $p }}
                        </button>
                    @endfor

                    <button
                        type="button"
                        wire:click="nextPage"
                        class="cl-page-nav {{ $currentPage >= $this->totalPages ? 'is-disabled' : '' }}"
                        {{ $currentPage >= $this->totalPages ? 'disabled' : '' }}
                        aria-label="Trang kế tiếp"
                    >
                        Sau ›
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Column: Interactive 3-Tab Panel (approx 32%) -->
        <div class="cl-side-column">
            <!-- Tab Selector Bar -->
            <div class="cl-tab-bar">
                <button
                    type="button"
                    wire:click="setSideTab('preview')"
                    class="cl-tab-btn {{ $activeSideTab === 'preview' ? 'is-active' : '' }}"
                >
                    💬 Xem trước Chat
                </button>
                <button
                    type="button"
                    wire:click="setSideTab('workflow')"
                    class="cl-tab-btn {{ $activeSideTab === 'workflow' ? 'is-active' : '' }}"
                >
                    ⚡ Sơ đồ luồng
                </button>
                <button
                    type="button"
                    wire:click="setSideTab('details')"
                    class="cl-tab-btn {{ $activeSideTab === 'details' ? 'is-active' : '' }}"
                >
                    ⚙ Cấu hình chi tiết
                </button>
            </div>

            <!-- Tab 1: Live Chat Preview -->
            @if($activeSideTab === 'preview')
                <div class="cl-side-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-left">
                            <span class="cl-card-dot"></span>
                            <h2 class="cl-card-title">Mô phỏng trò chuyện</h2>
                        </div>
                        <button
                            type="button"
                            wire:click="editScript('{{ $selected['id'] ?? '' }}')"
                            class="cl-card-link"
                        >
                            Chỉnh sửa
                        </button>
                    </div>

                    <div class="cl-phone-mockup">
                        <div class="cl-phone-header">
                            <div class="cl-phone-brand">
                                <span class="cl-brand-logo">CL</span>
                                <div>
                                    <div class="cl-brand-name">Cửu Long Assistant</div>
                                    <div class="cl-brand-status">Trực tuyến tự động</div>
                                </div>
                            </div>
                            <span class="cl-brand-badge">P{{ $selected['priority'] ?? 20 }}</span>
                        </div>

                        <!-- Simulation Flow in Phone -->
                        <div class="cl-preview-flow">
                            <!-- Step 1: User message -->
                            <div class="cl-flow-step">
                                <div class="cl-step-header">
                                    <span class="cl-step-badge">1</span>
                                    <span class="cl-step-title">{{ $selected['preview_trigger'] ?? 'Khách gửi tin nhắn' }}</span>
                                </div>
                                <div class="cl-step-body">
                                    <div class="cl-chat-row cl-row-user">
                                        <div class="cl-user-avatar">
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="cl-bubble cl-bubble-user">
                                            {{ $selected['preview_user_msg'] ?? 'Xin chào!' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Automated Bot Response -->
                            <div class="cl-flow-step is-last">
                                <div class="cl-step-header">
                                    <span class="cl-step-badge">2</span>
                                    <span class="cl-step-title">Tự động phản hồi (Cooldown: {{ $selected['cooldown_seconds'] ?? 30 }}s)</span>
                                </div>
                                <div class="cl-step-body">
                                    <div class="cl-chat-row cl-row-bot">
                                        <div class="cl-bot-avatar">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                                                <circle cx="12" cy="5" r="2"></circle>
                                                <path d="M12 7v4"></path>
                                                <line x1="8" y1="16" x2="8" y2="16"></line>
                                                <line x1="16" y1="16" x2="16" y2="16"></line>
                                            </svg>
                                        </div>
                                        <div class="cl-bubble cl-bubble-bot">
                                            <div class="cl-bot-msg-text">
                                                {!! nl2br(e($selected['preview_bot_msg'] ?? '')) !!}
                                            </div>

                                            @if(!empty($selected['preview_options']))
                                                <div class="cl-bot-options">
                                                    @foreach($selected['preview_options'] as $opt)
                                                        <div class="cl-opt-button">
                                                            <span>{{ $opt }}</span>
                                                            <span class="cl-opt-arrow">›</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tab 2: Workflow Node Diagram -->
            @if($activeSideTab === 'workflow')
                <div class="cl-side-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-left">
                            <span class="cl-card-dot is-amber"></span>
                            <h2 class="cl-card-title">Sơ đồ luồng (Workflow Nodes)</h2>
                        </div>
                    </div>

                    <div class="cl-workflow-container">
                        <!-- Node 1: Trigger -->
                        <div class="cl-node-box is-trigger">
                            <div class="cl-node-header">
                                <span class="cl-node-type">TRIGGER</span>
                                <span class="cl-node-badge">{{ $selected['trigger_type'] ?? 'message_received' }}</span>
                            </div>
                            <div class="cl-node-content">
                                <strong>{{ $selected['trigger'] ?? 'Khi có sự kiện' }}</strong>
                            </div>
                        </div>

                        <div class="cl-node-arrow">↓</div>

                        <!-- Node 2: Condition Evaluation -->
                        <div class="cl-node-box is-condition">
                            <div class="cl-node-header">
                                <span class="cl-node-type">CONDITION ENGINE</span>
                                <span class="cl-node-badge">AND / OR</span>
                            </div>
                            <div class="cl-node-content">
                                <div class="cl-node-rule-item">✓ Không phải Visitor bị chặn</div>
                                <div class="cl-node-rule-item">✓ Hội thoại chưa được nhân viên tiếp nhận</div>
                                <div class="cl-node-rule-item">✓ Khớp điều kiện từ khóa & thời gian</div>
                                <div class="cl-node-rule-item">✓ Cooldown > {{ $selected['cooldown_seconds'] ?? 30 }}s</div>
                            </div>
                        </div>

                        <div class="cl-node-arrow">↓</div>

                        <!-- Node 3: Action Response -->
                        <div class="cl-node-box is-action">
                            <div class="cl-node-header">
                                <span class="cl-node-type">ACTION: SEND_MESSAGE</span>
                                <span class="cl-node-badge">Phản hồi</span>
                            </div>
                            <div class="cl-node-content">
                                <p class="cl-node-text">{{ Str::limit($selected['preview_bot_msg'] ?? '', 90) }}</p>
                                @if(!empty($selected['preview_options']))
                                    <div class="cl-node-chips">
                                        @foreach($selected['preview_options'] as $o)
                                            <span class="cl-node-chip">{{ $o }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="cl-node-arrow">↓</div>

                        <!-- Node 4: Next Handoff / End -->
                        <div class="cl-node-box is-next">
                            <div class="cl-node-header">
                                <span class="cl-node-type">NEXT STEP</span>
                                <span class="cl-node-badge">Sẵn sàng</span>
                            </div>
                            <div class="cl-node-content">
                                <span>Chờ tương tác tiếp theo từ khách hàng hoặc chuyển giao AI / Chuyên viên CSKH</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tab 3: Detailed Configuration & Metadata -->
            @if($activeSideTab === 'details')
                <div class="cl-side-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-left">
                            <span class="cl-card-dot is-blue"></span>
                            <h2 class="cl-card-title">Cấu hình & Siêu dữ liệu</h2>
                        </div>
                    </div>

                    <div class="cl-settings-list">
                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Mã định danh (ID)</span>
                            <span class="cl-setting-val font-mono">{{ $selected['id'] ?? '' }}</span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Tên kịch bản</span>
                            <span class="cl-setting-val font-semibold">{{ $selected['name'] ?? '' }}</span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Độ ưu tiên (Priority)</span>
                            <span class="cl-setting-val">
                                <span class="cl-priority-tag p-high">P{{ $selected['priority'] ?? 20 }}</span>
                            </span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Trạng thái</span>
                            <span class="cl-setting-val">
                                @if($selected['enabled'] ?? false)
                                    <span class="cl-badge badge-active"><span class="cl-dot-green"></span> Đang bật</span>
                                @else
                                    <span class="cl-badge badge-other"><span class="cl-dot-gray"></span> Tạm dừng</span>
                                @endif
                            </span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Thời gian giãn cách (Cooldown)</span>
                            <span class="cl-setting-val">{{ $selected['cooldown_seconds'] ?? 30 }} giây</span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Chống lặp vô hạn (Loop Guard)</span>
                            <span class="cl-setting-val is-green-text">✓ Tự động bảo vệ</span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Lượt kích hoạt</span>
                            <span class="cl-setting-val font-semibold">{{ number_format((int)($selected['usage_count'] ?? 0), 0, ',', '.') }}</span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Thành công / Lỗi</span>
                            <span class="cl-setting-val">
                                <span class="is-green-text">{{ $selected['success_count'] ?? $selected['usage_count'] ?? 0 }}</span> / 
                                <span class="is-red-text">{{ $selected['error_count'] ?? 0 }}</span>
                            </span>
                        </div>

                        <div class="cl-setting-row">
                            <span class="cl-setting-label">Cập nhật lần cuối</span>
                            <span class="cl-setting-val text-slate-500">{{ $selected['updated_at'] ?? '2026-10-20' }}</span>
                        </div>
                    </div>

                    <div class="cl-details-actions">
                        <button
                            type="button"
                            wire:click="toggleScript('{{ $selected['id'] ?? '' }}')"
                            class="cl-btn-secondary w-full"
                        >
                            {{ ($selected['enabled'] ?? false) ? 'Tạm dừng kịch bản' : 'Kích hoạt kịch bản' }}
                        </button>

                        <button
                            type="button"
                            wire:click="editScript('{{ $selected['id'] ?? '' }}')"
                            class="cl-btn-create w-full"
                        >
                            Chỉnh sửa cấu hình
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL 1: TEST SIMULATOR MODAL (🧪 Kiểm tra) -->
    <!-- ========================================== -->
    @if($showTestModal)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-modal-box is-lg">
                <div class="cl-modal-header">
                    <div class="cl-modal-title-wrap">
                        <span class="cl-modal-icon">🧪</span>
                        <div>
                            <h3 class="cl-modal-title">Kiểm thử Automation (Test Mode)</h3>
                            <p class="cl-modal-desc">Mô phỏng tin nhắn từ khách hàng để kiểm tra luồng khớp trigger, điều kiện và hành động mà KHÔNG gửi tin nhắn thật.</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModals" class="cl-modal-close">✕</button>
                </div>

                <div class="cl-modal-body">
                    <!-- Quick Preset Prompts -->
                    <div class="cl-test-presets">
                        <span class="cl-preset-label">Mẫu thử nhanh:</span>
                        <button type="button" wire:click="$set('testInputMessage', 'Cho tôi bảng giá website')" class="cl-preset-btn">"Bảng giá"</button>
                        <button type="button" wire:click="$set('testInputMessage', 'Xin chào bạn!')" class="cl-preset-btn">"Chào mừng"</button>
                        <button type="button" wire:click="$set('testInputMessage', 'Tôi muốn livestream sự kiện')" class="cl-preset-btn">"Livestream"</button>
                        <button type="button" wire:click="$set('testInputMessage', 'Quảng cáo cược uy tín nhận thưởng')" class="cl-preset-btn">"Spam mẫu"</button>
                        <button type="button" wire:click="$set('testInputMessage', 'Tôi muốn gặp trực tiếp nhân viên')" class="cl-preset-btn">"Gặp nhân viên"</button>
                    </div>

                    <!-- Input form -->
                    <div class="cl-test-input-row">
                        <input
                            type="text"
                            wire:model="testInputMessage"
                            wire:keydown.enter="runSimulation"
                            placeholder="Nhập tin nhắn khách hàng giả lập..."
                            class="cl-test-input"
                        />
                        <button
                            type="button"
                            wire:click="runSimulation"
                            class="cl-btn-create"
                        >
                            Chạy kiểm thử
                        </button>
                    </div>

                    <!-- Test Simulation Result -->
                    @if($testSimulationResult)
                        <div class="cl-test-result-box">
                            <div class="cl-result-header">
                                <div class="cl-result-badge-wrap">
                                    @php
                                        $res = $testSimulationResult['result'] ?? '';
                                        $badgeBg = match($res) {
                                            'PASS' => 'bg-emerald-100 text-emerald-700 border-emerald-300',
                                            'BLOCKED' => 'bg-red-100 text-red-700 border-red-300',
                                            'HANDOFF' => 'bg-blue-100 text-blue-700 border-blue-300',
                                            default => 'bg-slate-100 text-slate-700 border-slate-300',
                                        };
                                    @endphp
                                    <span class="cl-res-badge {{ $badgeBg }}">
                                        {{ $testSimulationResult['result'] }}
                                    </span>
                                    <span class="cl-res-label">{{ $testSimulationResult['status_label'] }}</span>
                                </div>
                                <span class="cl-res-time">⏱ Thời gian xử lý: {{ $testSimulationResult['duration_ms'] }}ms</span>
                            </div>

                            <div class="cl-test-pipeline">
                                <div class="cl-pipe-step">
                                    <div class="cl-pipe-num">1</div>
                                    <div class="cl-pipe-detail">
                                        <div class="cl-pipe-title">Tin nhắn đầu vào</div>
                                        <div class="cl-pipe-val font-mono">"{{ $testSimulationResult['input'] }}"</div>
                                    </div>
                                </div>

                                <div class="cl-pipe-step">
                                    <div class="cl-pipe-num">2</div>
                                    <div class="cl-pipe-detail">
                                        <div class="cl-pipe-title">Trigger khớp</div>
                                        <div class="cl-pipe-val text-blue-600">{{ $testSimulationResult['matched_trigger'] }}</div>
                                    </div>
                                </div>

                                <div class="cl-pipe-step">
                                    <div class="cl-pipe-num">3</div>
                                    <div class="cl-pipe-detail">
                                        <div class="cl-pipe-title">Kịch bản chiến thắng (theo Priority)</div>
                                        <div class="cl-pipe-val font-bold text-slate-900">{{ $testSimulationResult['selected_automation'] }}</div>
                                    </div>
                                </div>

                                <div class="cl-pipe-step">
                                    <div class="cl-pipe-num">4</div>
                                    <div class="cl-pipe-detail">
                                        <div class="cl-pipe-title">Hành động & Phản hồi tạo ra</div>
                                        <div class="cl-pipe-response">
                                            {!! nl2br(e($testSimulationResult['simulated_output'] ?? '')) !!}
                                        </div>
                                        @if(!empty($testSimulationResult['simulated_options']))
                                            <div class="cl-pipe-options">
                                                @foreach($testSimulationResult['simulated_options'] as $opt)
                                                    <span class="cl-pipe-opt-chip">{{ $opt }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if(!empty($testSimulationResult['notes']))
                                <div class="cl-test-note">
                                    💡 <strong>Ghi chú:</strong> {{ $testSimulationResult['notes'] }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="cl-modal-footer">
                    <button type="button" wire:click="closeModals" class="cl-btn-secondary">Đóng</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MODAL 2: CONFLICT DETECTOR MODAL           -->
    <!-- ========================================== -->
    @if($showConflictModal)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-modal-box is-lg">
                <div class="cl-modal-header">
                    <div class="cl-modal-title-wrap">
                        <span class="cl-modal-icon">⚡</span>
                        <div>
                            <h3 class="cl-modal-title">Phát hiện xung đột Automation</h3>
                            <p class="cl-modal-desc">Kiểm tra trùng lặp từ khóa, độ ưu tiên hoặc khả năng tạo vòng lặp giữa các kịch bản đang hoạt động.</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModals" class="cl-modal-close">✕</button>
                </div>

                <div class="cl-modal-body">
                    @if(empty($conflictsList))
                        <div class="cl-no-conflicts">
                            <span class="cl-ok-icon">✓</span>
                            <div class="font-bold text-emerald-800 text-base">Không phát hiện xung đột nào!</div>
                            <p class="text-slate-600 text-sm mt-1">Toàn bộ kịch bản tự động hóa đang có điều kiện và mức ưu tiên rõ ràng, không trùng lặp từ khóa.</p>
                        </div>
                    @else
                        <div class="cl-conflict-list">
                            @foreach($conflictsList as $conf)
                                <div class="cl-conflict-item {{ $conf['level'] === 'danger' ? 'is-danger' : 'is-warning' }}">
                                    <div class="cl-conflict-head">
                                        <span class="cl-conflict-badge {{ $conf['level'] === 'danger' ? 'is-danger' : 'is-warning' }}">
                                            {{ $conf['level'] === 'danger' ? 'XUNG ĐỘT CAO' : 'CẢNH BÁO' }}
                                        </span>
                                        <span class="cl-conflict-msg">{{ $conf['message'] }}</span>
                                    </div>
                                    <div class="cl-conflict-rec">
                                        <strong>Khuyến nghị khắc phục:</strong> {{ $conf['recommendation'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="cl-modal-footer">
                    <button type="button" wire:click="closeModals" class="cl-btn-secondary">Đóng</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MODAL 3: EXECUTION LOGS TRACE MODAL        -->
    <!-- ========================================== -->
    @if($showLogModal)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-modal-box is-xl">
                <div class="cl-modal-header">
                    <div class="cl-modal-title-wrap">
                        <span class="cl-modal-icon">📜</span>
                        <div>
                            <h3 class="cl-modal-title">Nhật ký thực thi (Execution Trace Logs)</h3>
                            <p class="cl-modal-desc">Lịch sử kích hoạt kịch bản tự động từ các sự kiện thực tế trong hệ thống Chat Cửu Long.</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModals" class="cl-modal-close">✕</button>
                </div>

                <div class="cl-modal-body">
                    <div class="cl-table-responsive max-h-96">
                        <table class="cl-table">
                            <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Khách hàng</th>
                                    <th>Tin nhắn đầu vào</th>
                                    <th>Kịch bản thực thi</th>
                                    <th>Kết quả</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logsList as $log)
                                    <tr>
                                        <td class="text-xs text-slate-500 font-mono">
                                            {{ \Carbon\Carbon::parse($log['timestamp'] ?? now())->format('H:i:s d/m') }}
                                        </td>
                                        <td class="font-medium text-slate-800 text-xs">
                                            {{ $log['customer'] ?? 'Khách vãng lai' }}
                                        </td>
                                        <td class="text-xs text-slate-700 max-w-xs truncate" title="{{ $log['input'] ?? '' }}">
                                            {{ $log['input'] ?? '' }}
                                        </td>
                                        <td class="text-xs font-semibold text-slate-900">
                                            {{ $log['automation'] ?? '' }}
                                        </td>
                                        <td>
                                            @if(($log['result'] ?? '') === 'SUCCESS')
                                                <span class="cl-badge badge-welcome">SUCCESS</span>
                                            @else
                                                <span class="cl-badge badge-other text-red-600 bg-red-50">ERROR</span>
                                            @endif
                                        </td>
                                        <td class="text-xs text-slate-500 font-mono">
                                            {{ $log['duration_ms'] ?? 1 }}ms
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-8 text-slate-400">
                                            Chưa ghi nhận nhật ký thực thi nào trong phiên gần đây.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="cl-modal-footer">
                    <button type="button" wire:click="closeModals" class="cl-btn-secondary">Đóng</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MODAL 4: VERSION HISTORY MODAL             -->
    <!-- ========================================== -->
    @if($showVersionModal)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-modal-box is-lg">
                <div class="cl-modal-header">
                    <div class="cl-modal-title-wrap">
                        <span class="cl-modal-icon">🕒</span>
                        <div>
                            <h3 class="cl-modal-title">Lịch sử phiên bản Automation</h3>
                            <p class="cl-modal-desc">Xem và khôi phục các điểm lưu cấu hình kịch bản tự động trong quá khứ.</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModals" class="cl-modal-close">✕</button>
                </div>

                <div class="cl-modal-body">
                    <div class="cl-version-list">
                        @forelse($versionsList as $ver)
                            <div class="cl-version-item">
                                <div class="cl-version-meta">
                                    <div class="cl-ver-badge">{{ $ver['version_number'] ?? 'v1.0' }}</div>
                                    <div>
                                        <div class="cl-ver-summary font-semibold text-slate-800">{{ $ver['change_summary'] ?? 'Cập nhật cấu hình' }}</div>
                                        <div class="cl-ver-details text-xs text-slate-500 mt-0.5">
                                            Người sửa: <strong>{{ $ver['author'] ?? 'Admin' }}</strong> • {{ $ver['timestamp'] ?? '' }} • {{ $ver['count'] ?? 0 }} kịch bản
                                        </div>
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    wire:click="restoreVersion('{{ $ver['id'] }}')"
                                    wire:confirm="Bạn có chắc chắn muốn khôi phục về phiên bản {{ $ver['version_number'] }} này không?"
                                    class="cl-btn-secondary is-sm"
                                >
                                    Khôi phục
                                </button>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400">
                                Chưa có phiên bản snapshot nào được lưu.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="cl-modal-footer">
                    <button type="button" wire:click="closeModals" class="cl-btn-secondary">Đóng</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MODAL 5: CREATE / EDIT AUTOMATION FORM     -->
    <!-- ========================================== -->
    @if($showCreateEditModal)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-modal-box is-lg">
                <div class="cl-modal-header">
                    <div class="cl-modal-title-wrap">
                        <span class="cl-modal-icon">{{ $isEditing ? '✏️' : '✨' }}</span>
                        <div>
                            <h3 class="cl-modal-title">{{ $isEditing ? 'Chỉnh sửa kịch bản' : 'Tạo kịch bản tự động mới' }}</h3>
                            <p class="cl-modal-desc">Cấu hình điều kiện kích hoạt, mức ưu tiên và nội dung tin nhắn tự động.</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModals" class="cl-modal-close">✕</button>
                </div>

                <div class="cl-modal-body">
                    <div class="cl-form-grid">
                        <!-- Tên kịch bản -->
                        <div class="cl-form-group col-span-2">
                            <label class="cl-form-label">Tên kịch bản <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                wire:model="editingScript.name"
                                placeholder="Ví dụ: Tư vấn bảng giá TVC 2026"
                                class="cl-form-input"
                            />
                        </div>

                        <!-- Loại kịch bản -->
                        <div class="cl-form-group">
                            <label class="cl-form-label">Phân loại kịch bản</label>
                            <select wire:model="editingScript.category" class="cl-form-input">
                                <option value="welcome">Chào mừng</option>
                                <option value="consulting">Tư vấn dịch vụ</option>
                                <option value="care">Chăm sóc khách hàng</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>

                        <!-- Trigger Type -->
                        <div class="cl-form-group">
                            <label class="cl-form-label">Sự kiện kích hoạt (Trigger Type)</label>
                            <select wire:model="editingScript.trigger_type" class="cl-form-input">
                                <option value="message_received">Khi nhận tin nhắn (Keywords)</option>
                                <option value="conversation_created">Khi khách bắt đầu chat</option>
                                <option value="schedule">Theo lịch trình (Chăm sóc sau)</option>
                            </select>
                        </div>

                        <!-- Priority & Cooldown -->
                        <div class="cl-form-group">
                            <label class="cl-form-label">Độ ưu tiên (Priority: 1-100, 1 cao nhất)</label>
                            <input
                                type="number"
                                min="1"
                                max="100"
                                wire:model="editingScript.priority"
                                class="cl-form-input"
                            />
                        </div>

                        <div class="cl-form-group">
                            <label class="cl-form-label">Giãn cách kích hoạt (Cooldown seconds)</label>
                            <input
                                type="number"
                                min="5"
                                max="86400"
                                wire:model="editingScript.cooldown_seconds"
                                class="cl-form-input"
                            />
                        </div>

                        <!-- Trigger text -->
                        <div class="cl-form-group col-span-2">
                            <label class="cl-form-label">Mô tả điều kiện kích hoạt <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                wire:model="editingScript.trigger"
                                placeholder='Ví dụ: Khi khách hàng gửi từ khóa ("báo giá", "chi phí")...'
                                class="cl-form-input"
                            />
                        </div>

                        <!-- Mô tả kịch bản -->
                        <div class="cl-form-group col-span-2">
                            <label class="cl-form-label">Mô tả mục đích kịch bản</label>
                            <input
                                type="text"
                                wire:model="editingScript.desc"
                                placeholder="Ghi chú ngắn về kịch bản..."
                                class="cl-form-input"
                            />
                        </div>

                        <!-- Bot message -->
                        <div class="cl-form-group col-span-2">
                            <label class="cl-form-label">Nội dung phản hồi tự động <span class="text-red-500">*</span></label>
                            <textarea
                                wire:model="editingScript.preview_bot_msg"
                                rows="3"
                                placeholder="Nội dung bot sẽ gửi cho khách hàng..."
                                class="cl-form-input"
                            ></textarea>
                        </div>

                        <!-- Quick reply options -->
                        <div class="cl-form-group col-span-2">
                            <label class="cl-form-label">Các nút tùy chọn nhanh (Quick Reply Chips)</label>
                            <div class="flex gap-2 mb-2">
                                <input
                                    type="text"
                                    wire:model="tempOptionInput"
                                    wire:keydown.enter.prevent="addOptionToEditing"
                                    placeholder="Nhập tên nút lựa chọn và nhấn Thêm..."
                                    class="cl-form-input"
                                />
                                <button type="button" wire:click="addOptionToEditing" class="cl-btn-secondary whitespace-nowrap">
                                    Thêm nút
                                </button>
                            </div>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($editingScript['preview_options'] ?? [] as $idx => $opt)
                                    <span class="cl-chip-removable">
                                        {{ $opt }}
                                        <button type="button" wire:click="removeOptionFromEditing({{ $idx }})" class="cl-chip-del">✕</button>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cl-modal-footer">
                    <button type="button" wire:click="closeModals" class="cl-btn-secondary">Hủy</button>
                    <button type="button" wire:click="saveEditingScript" class="cl-btn-create">
                        Lưu kịch bản
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MODAL 6: COMMAND PALETTE (Ctrl/Cmd + K)    -->
    <!-- ========================================== -->
    @if($showCommandPalette)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-palette-box">
                <div class="cl-palette-search-wrap">
                    <svg class="cl-search-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    <input
                        type="text"
                        wire:model.live="commandSearch"
                        placeholder="Gõ lệnh hoặc hành động cần thực hiện... (Esc để đóng)"
                        class="cl-palette-input"
                        autofocus
                    />
                    <span class="cl-kbd-tag">ESC</span>
                </div>

                <div class="cl-palette-list">
                    <div class="cl-palette-section">HÀNH ĐỘNG NHANH</div>

                    <button type="button" wire:click="createNewScript" class="cl-palette-item">
                        <span class="cl-palette-icon">✨</span>
                        <span class="cl-palette-text">Tạo kịch bản mới</span>
                        <span class="cl-palette-key">N</span>
                    </button>

                    <button type="button" wire:click="openTestModal" class="cl-palette-item">
                        <span class="cl-palette-icon">🧪</span>
                        <span class="cl-palette-text">Kiểm thử kịch bản tự động (Test Automation)</span>
                        <span class="cl-palette-key">T</span>
                    </button>

                    <button type="button" wire:click="openConflictModal" class="cl-palette-item">
                        <span class="cl-palette-icon">⚡</span>
                        <span class="cl-palette-text">Xem kiểm tra xung đột (Conflicts)</span>
                        <span class="cl-palette-key">C</span>
                    </button>

                    <button type="button" wire:click="openLogModal" class="cl-palette-item">
                        <span class="cl-palette-icon">📜</span>
                        <span class="cl-palette-text">Xem nhật ký thực thi (Execution Logs)</span>
                        <span class="cl-palette-key">L</span>
                    </button>

                    <button type="button" wire:click="openVersionModal" class="cl-palette-item">
                        <span class="cl-palette-icon">🕒</span>
                        <span class="cl-palette-text">Xem lịch sử phiên bản (Version History)</span>
                        <span class="cl-palette-key">V</span>
                    </button>

                    <button type="button" wire:click="toggleShortcutModal" class="cl-palette-item">
                        <span class="cl-palette-icon">⌨</span>
                        <span class="cl-palette-text">Bảng hướng dẫn phím tắt</span>
                        <span class="cl-palette-key">?</span>
                    </button>

                    <div class="cl-palette-section">TRÊN KỊCH BẢN ĐANG CHỌN</div>

                    <button type="button" wire:click="editCurrentSelected" class="cl-palette-item">
                        <span class="cl-palette-icon">✏️</span>
                        <span class="cl-palette-text">Chỉnh sửa kịch bản đang chọn</span>
                        <span class="cl-palette-key">E</span>
                    </button>

                    <button type="button" wire:click="duplicateCurrentSelected" class="cl-palette-item">
                        <span class="cl-palette-icon">📋</span>
                        <span class="cl-palette-text">Nhân bản kịch bản đang chọn</span>
                        <span class="cl-palette-key">D</span>
                    </button>

                    <button type="button" wire:click="toggleCurrentSelected" class="cl-palette-item">
                        <span class="cl-palette-icon">⏯</span>
                        <span class="cl-palette-text">Bật / Tạm dừng kịch bản đang chọn</span>
                        <span class="cl-palette-key">Space</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MODAL 7: KEYBOARD SHORTCUTS HELP MODAL (?) -->
    <!-- ========================================== -->
    @if($showShortcutModal)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-modal-box is-md">
                <div class="cl-modal-header">
                    <div class="cl-modal-title-wrap">
                        <span class="cl-modal-icon">⌨</span>
                        <div>
                            <h3 class="cl-modal-title">Phím tắt hệ thống Automation Center</h3>
                            <p class="cl-modal-desc">Thao tác siêu tốc không cần rời tay khỏi bàn phím.</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModals" class="cl-modal-close">✕</button>
                </div>

                <div class="cl-modal-body">
                    <div class="cl-shortcut-table">
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Tạo kịch bản mới</span>
                            <span class="cl-kbd-tag">N</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Tìm kiếm kịch bản</span>
                            <span class="cl-kbd-tag">/</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Mở Command Palette</span>
                            <span class="cl-kbd-tag">Ctrl + K / ⌘ + K</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Chỉnh sửa kịch bản đang chọn</span>
                            <span class="cl-kbd-tag">E</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Nhân bản kịch bản đang chọn</span>
                            <span class="cl-kbd-tag">D</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Bật / Tạm dừng kịch bản</span>
                            <span class="cl-kbd-tag">Space</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Xem chi tiết kịch bản</span>
                            <span class="cl-kbd-tag">Enter</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Kích hoạt kịch bản</span>
                            <span class="cl-kbd-tag">Shift + A</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Tạm dừng kịch bản</span>
                            <span class="cl-kbd-tag">Shift + P</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Đóng modal / hủy chọn</span>
                            <span class="cl-kbd-tag">Esc</span>
                        </div>
                        <div class="cl-shortcut-row">
                            <span class="cl-shortcut-action">Mở trợ giúp này</span>
                            <span class="cl-kbd-tag">?</span>
                        </div>
                    </div>
                </div>

                <div class="cl-modal-footer">
                    <button type="button" wire:click="closeModals" class="cl-btn-secondary">Đã hiểu</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MODAL 8: BULK DELETE CONFIRMATION          -->
    <!-- ========================================== -->
    @if($showBulkDeleteModal)
        <div class="cl-modal-overlay" wire:click.self="closeModals">
            <div class="cl-modal-box is-sm">
                <div class="cl-modal-header">
                    <div class="cl-modal-title-wrap">
                        <span class="cl-modal-icon">⚠️</span>
                        <div>
                            <h3 class="cl-modal-title text-red-600">Xác nhận xóa hàng loạt</h3>
                            <p class="cl-modal-desc">Thao tác này sẽ xóa vĩnh viễn các kịch bản đã chọn.</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModals" class="cl-modal-close">✕</button>
                </div>

                <div class="cl-modal-body">
                    <p class="text-sm text-slate-700">
                        Bạn có chắc chắn muốn xóa <strong>{{ count($selectedIds) }}</strong> kịch bản đang được chọn không?
                    </p>
                </div>

                <div class="cl-modal-footer">
                    <button type="button" wire:click="closeModals" class="cl-btn-secondary">Hủy</button>
                    <button type="button" wire:click="bulkDeleteConfirmed" class="cl-btn-create bg-red-600 hover:bg-red-700">
                        Xóa tất cả đã chọn
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Alpine Keyboard Listener -->
<script>
    function automationCenter() {
        return {
            init() {
                window.addEventListener('keydown', (e) => {
                    const target = e.target;
                    const isInput = target && (
                        ['INPUT', 'TEXTAREA', 'SELECT'].includes(target.tagName) ||
                        target.isContentEditable ||
                        target.closest('[contenteditable="true"]') ||
                        target.closest('.fi-input')
                    );

                    // Allow Escape even when inside an input to close modals
                    if (e.key === 'Escape') {
                        @this.closeModals();
                        return;
                    }

                    // Strict Input Suppression: Do not trigger single-letter shortcuts when typing in form fields
                    if (isInput) {
                        return;
                    }

                    // Ctrl+K / Cmd+K -> Command Palette
                    if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                        e.preventDefault();
                        @this.toggleCommandPalette();
                        return;
                    }

                    // Shift + A -> Activate
                    if (e.shiftKey && (e.key === 'A' || e.key === 'a')) {
                        e.preventDefault();
                        @this.activateSelected();
                        return;
                    }

                    // Shift + P -> Pause
                    if (e.shiftKey && (e.key === 'P' || e.key === 'p')) {
                        e.preventDefault();
                        @this.pauseSelected();
                        return;
                    }

                    // Single-key shortcuts (strictly without Ctrl/Cmd/Alt)
                    if (!e.ctrlKey && !e.metaKey && !e.altKey) {
                        if (e.key === 'n' || e.key === 'N') {
                            e.preventDefault();
                            @this.createNewScript();
                        } else if (e.key === '/') {
                            e.preventDefault();
                            document.getElementById('cl-search-input')?.focus();
                        } else if (e.key === 'e' || e.key === 'E') {
                            e.preventDefault();
                            @this.editCurrentSelected();
                        } else if (e.key === 'd' || e.key === 'D') {
                            e.preventDefault();
                            @this.duplicateCurrentSelected();
                        } else if (e.key === ' ') {
                            e.preventDefault();
                            @this.toggleCurrentSelected();
                        } else if (e.key === 'Enter') {
                            e.preventDefault();
                            @this.openSelectedDetails();
                        } else if (e.key === '?') {
                            e.preventDefault();
                            @this.toggleShortcutModal();
                        }
                    }
                });
            }
        };
    }
</script>

<style>
/* Reset Filament Wrappers */
.fi-page-header, .fi-header {
    display: none !important;
}

.cl-auto-wrap {
    background-color: #f8fafc;
    margin: -1.5rem -1.5rem !important;
    padding: 1.5rem 1.75rem 3.5rem 1.75rem !important;
    min-height: 100vh;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #1e293b;
    box-sizing: border-box;
}

@media (min-width: 1024px) {
    .cl-auto-wrap {
        margin: -2rem -2rem !important;
        padding: 1.75rem 2rem 3.5rem 2rem !important;
    }
}

/* Header & Breadcrumb */
.cl-auto-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    gap: 1.25rem;
    margin-bottom: 1.25rem;
}

.cl-auto-header-left {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.cl-auto-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
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

.cl-crumb-badge {
    background-color: #ff5400;
    color: #ffffff;
    font-size: 10px;
    font-weight: 700;
    padding: 1px 7px;
    border-radius: 9999px;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.cl-auto-title-row {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    margin-top: 2px;
}

.cl-header-title-flex {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.cl-title-badge {
    background-color: #fee2e2;
    color: #b91c1c;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 6px;
    border: 1px solid #fca5a5;
}

.cl-robot-avatar {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
    border: 1px solid #fed7aa;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff5400;
    flex-shrink: 0;
    box-shadow: 0 2px 4px rgba(255, 84, 0, 0.08);
}

.cl-robot-svg {
    width: 24px;
    height: 24px;
}

.cl-auto-title {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.02em;
}

.cl-auto-subtitle {
    font-size: 13px;
    color: #64748b;
    margin: 3px 0 0 0;
    line-height: 1.4;
}

/* Header Right Toolbar */
.cl-auto-header-right {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.6rem;
}

.cl-search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.cl-search-icon {
    position: absolute;
    left: 11px;
    width: 17px;
    height: 17px;
    color: #94a3b8;
    pointer-events: none;
}

.cl-search-input {
    width: 240px;
    height: 38px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 32px 0 36px;
    font-size: 13px;
    color: #1e293b;
    outline: none;
    transition: all 0.2s ease;
}

.cl-search-input:focus {
    border-color: #ff5400;
    box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15);
}

.cl-kbd-tag {
    position: absolute;
    right: 8px;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    color: #64748b;
    font-size: 10px;
    font-weight: 600;
    padding: 1px 5px;
    border-radius: 4px;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
}

.cl-kbd-tag-light {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
    font-size: 10px;
    font-weight: 700;
    padding: 1px 5px;
    border-radius: 4px;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
}

.cl-btn-secondary {
    height: 38px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 12px;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cl-btn-secondary:hover {
    background: #f8fafc;
    border-color: #94a3b8;
    color: #1e293b;
}

.cl-btn-secondary.is-sm {
    height: 28px;
    padding: 0 8px;
    font-size: 12px;
}

.cl-btn-warning-badge {
    height: 38px;
    background: #fffbeb;
    border: 1px solid #fcd34d;
    border-radius: 8px;
    padding: 0 12px;
    font-size: 12px;
    font-weight: 700;
    color: #b45309;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    animation: pulse 2s infinite;
}

.cl-pulse-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #f59e0b;
}

.cl-btn-create {
    height: 38px;
    background-color: #ff5400;
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    padding: 0 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(255, 84, 0, 0.2);
    transition: all 0.2s ease;
}

.cl-btn-create:hover {
    background-color: #ea4d00;
    box-shadow: 0 2px 4px rgba(255, 84, 0, 0.3);
}

/* KPI Summary Grid */
.cl-kpi-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.85rem;
    margin-bottom: 1.25rem;
}

@media (min-width: 768px) {
    .cl-kpi-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 1280px) {
    .cl-kpi-grid {
        grid-template-columns: repeat(6, 1fr);
    }
}

.cl-kpi-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.85rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
}

.cl-kpi-icon-wrap {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-kpi-icon-wrap.is-blue { background: #e0f2fe; color: #0284c7; }
.cl-kpi-icon-wrap.is-green { background: #dcfce7; color: #16a34a; }
.cl-kpi-icon-wrap.is-amber { background: #fef3c7; color: #d97706; }
.cl-kpi-icon-wrap.is-orange { background: #ffedd5; color: #ea580c; }
.cl-kpi-icon-wrap.is-emerald { background: #d1fae5; color: #059669; }
.cl-kpi-icon-wrap.is-red { background: #fee2e2; color: #dc2626; }
.cl-kpi-icon-wrap.is-gray { background: #f1f5f9; color: #64748b; }

.cl-kpi-svg {
    width: 20px;
    height: 20px;
}

.cl-kpi-info {
    display: flex;
    flex-direction: column;
}

.cl-kpi-label {
    font-size: 11px;
    font-weight: 500;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.cl-kpi-value {
    font-size: 19px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
    margin-top: 2px;
}

.cl-kpi-value.is-green-text { color: #16a34a; }
.cl-kpi-value.is-emerald-text { color: #059669; }
.cl-kpi-value.is-slate-text { color: #64748b; }
.cl-kpi-value.is-red-text { color: #dc2626; }

/* Conflict Banner */
.cl-conflict-banner {
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    font-size: 13px;
    color: #92400e;
}

.cl-conflict-banner-left {
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.cl-conflict-icon {
    font-size: 18px;
}

.cl-btn-banner-action {
    background: #d97706;
    color: #ffffff;
    font-size: 12px;
    font-weight: 700;
    border: none;
    border-radius: 6px;
    padding: 5px 12px;
    cursor: pointer;
    white-space: nowrap;
}

/* Filter Toolbar */
.cl-filter-toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    margin-bottom: 1.15rem;
}

.cl-filter-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.35rem;
}

.cl-filter-pill {
    height: 32px;
    padding: 0 12px;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    font-size: 12px;
    font-weight: 500;
    color: #64748b;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: all 0.15s ease;
}

.cl-filter-pill:hover {
    background: #f1f5f9;
    color: #1e293b;
}

.cl-filter-pill.active {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
    font-weight: 600;
}

.cl-pill-count {
    font-size: 11px;
    font-weight: 600;
    background: rgba(0, 0, 0, 0.06);
    padding: 1px 6px;
    border-radius: 10px;
}

.cl-filter-pill.active .cl-pill-count {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.cl-dropdown-filters {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.cl-select-filter {
    height: 32px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 0 8px;
    font-size: 12px;
    color: #475569;
    outline: none;
}

/* Bulk Action Bar */
.cl-bulk-bar {
    background: #0f172a;
    color: #ffffff;
    border-radius: 8px;
    padding: 0.65rem 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.cl-bulk-left {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 13px;
}

.cl-bulk-check-icon {
    background: #16a34a;
    color: #ffffff;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
}

.cl-bulk-actions {
    display: flex;
    gap: 0.5rem;
}

.cl-btn-bulk {
    border: none;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}

.cl-btn-bulk.is-green { background: #16a34a; color: #ffffff; }
.cl-btn-bulk.is-amber { background: #d97706; color: #ffffff; }
.cl-btn-bulk.is-red { background: #dc2626; color: #ffffff; }

/* Main Grid Layout */
.cl-main-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
    align-items: start;
}

@media (min-width: 1200px) {
    .cl-main-grid {
        grid-template-columns: 68% 32%;
    }
}

/* Table Card */
.cl-table-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}

.cl-table-responsive {
    overflow-x: auto;
}

.cl-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.cl-table th {
    background-color: #f8fafc;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    padding: 10px 14px;
    border-bottom: 1px solid #e2e8f0;
    white-space: nowrap;
}

.cl-th-sortable {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    cursor: pointer;
}

.cl-sort-arrow {
    color: #ff5400;
    font-size: 11px;
    font-weight: bold;
}

.cl-table td {
    padding: 12px 14px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13px;
    vertical-align: middle;
}

.cl-tr {
    transition: background-color 0.15s ease;
    cursor: pointer;
}

.cl-tr:hover {
    background-color: #f8fafc;
}

.cl-tr.is-selected {
    background-color: #fff7ed;
    border-left: 3px solid #ff5400;
}

.cl-checkbox {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    border: 1px solid #cbd5e1;
    accent-color: #ff5400;
    cursor: pointer;
}

.cl-priority-tag {
    display: inline-block;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
}

.cl-priority-tag.p-high { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
.cl-priority-tag.p-med { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
.cl-priority-tag.p-low { background: #e2e8f0; color: #475569; border: 1px solid #cbd5e1; }

.cl-name-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.cl-script-icon-wrap {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-icon-svg {
    width: 18px;
    height: 18px;
}

.cl-name-info {
    display: flex;
    flex-direction: column;
}

.cl-script-title-row {
    display: flex;
    align-items: center;
    gap: 6px;
}

.cl-script-title {
    font-weight: 700;
    color: #0f172a;
    font-size: 13px;
}

.cl-cooldown-chip {
    font-size: 10px;
    color: #64748b;
    background: #f1f5f9;
    padding: 1px 5px;
    border-radius: 4px;
}

.cl-script-desc {
    font-size: 12px;
    color: #64748b;
    margin-top: 1px;
    max-width: 320px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.cl-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 6px;
    white-space: nowrap;
}

.badge-welcome { background: #e0f2fe; color: #0369a1; }
.badge-consulting { background: #dcfce7; color: #15803d; }
.badge-care { background: #ffedd5; color: #c2410c; }
.badge-other { background: #f1f5f9; color: #475569; }
.badge-active { background: #dcfce7; color: #15803d; }

.cl-trigger-text {
    font-size: 12px;
    color: #475569;
    max-width: 240px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.cl-toggle-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
}

.cl-switch {
    width: 38px;
    height: 20px;
    background-color: #cbd5e1;
    border-radius: 9999px;
    border: none;
    padding: 2px;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.cl-switch.is-active {
    background-color: #16a34a;
}

.cl-switch-knob {
    width: 16px;
    height: 16px;
    background-color: #ffffff;
    border-radius: 50%;
    transition: transform 0.2s ease;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.cl-switch.is-active .cl-switch-knob {
    transform: translateX(18px);
}

.cl-status-label {
    font-size: 11px;
    font-weight: 600;
}

.cl-status-label.is-active { color: #16a34a; }
.cl-status-label.is-inactive { color: #94a3b8; }

.cl-uses-cell {
    display: flex;
    flex-direction: column;
}

.cl-uses-count {
    font-weight: 700;
    color: #0f172a;
    font-size: 13px;
}

.cl-ok-chip {
    font-size: 10px;
    color: #15803d;
    background: #dcfce7;
    padding: 1px 4px;
    border-radius: 4px;
    width: fit-content;
    margin-top: 2px;
}

.cl-err-chip {
    font-size: 10px;
    color: #b91c1c;
    background: #fee2e2;
    padding: 1px 4px;
    border-radius: 4px;
    width: fit-content;
    margin-top: 2px;
}

.cl-actions-wrap {
    display: flex;
    align-items: center;
    gap: 4px;
}

.cl-act-btn {
    width: 28px;
    height: 28px;
    border: none;
    border-radius: 6px;
    background: transparent;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s ease;
}

.cl-act-btn svg {
    width: 16px;
    height: 16px;
}

.cl-act-btn:hover {
    background: #f1f5f9;
    color: #1e293b;
}

.cl-act-btn.is-danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

/* Empty row */
.cl-empty-row {
    padding: 3rem 1rem !important;
    text-align: center;
}

.cl-empty-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.cl-empty-icon {
    font-size: 32px;
    margin-bottom: 0.5rem;
}

.cl-empty-title {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.cl-empty-desc {
    font-size: 13px;
    color: #64748b;
    margin: 4px 0 0 0;
}

/* Table Footer */
.cl-table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 16px;
    background-color: #ffffff;
    border-top: 1px solid #f1f5f9;
}

.cl-footer-count {
    font-size: 12px;
    color: #64748b;
}

.cl-pagination {
    display: flex;
    align-items: center;
    gap: 4px;
}

.cl-page-nav {
    height: 28px;
    padding: 0 8px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 12px;
    color: #475569;
    cursor: pointer;
}

.cl-page-nav.is-disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.cl-page-num {
    width: 28px;
    height: 28px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.cl-page-num.is-active {
    background: #ff5400;
    border-color: #ff5400;
    color: #ffffff;
}

/* Side Column Tabs */
.cl-side-column {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.cl-tab-bar {
    display: flex;
    background: #e2e8f0;
    padding: 3px;
    border-radius: 10px;
    gap: 3px;
}

.cl-tab-btn {
    flex: 1;
    border: none;
    background: transparent;
    border-radius: 8px;
    padding: 6px 8px;
    font-size: 11px;
    font-weight: 600;
    color: #475569;
    cursor: pointer;
    transition: all 0.15s ease;
    white-space: nowrap;
}

.cl-tab-btn.is-active {
    background: #ffffff;
    color: #0f172a;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.cl-side-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.15rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.cl-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.85rem;
    padding-bottom: 0.65rem;
    border-bottom: 1px solid #f1f5f9;
}

.cl-card-header-left {
    display: flex;
    align-items: center;
    gap: 6px;
}

.cl-card-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #16a34a;
}

.cl-card-dot.is-amber { background-color: #d97706; }
.cl-card-dot.is-blue { background-color: #0284c7; }

.cl-card-title {
    font-size: 13px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.cl-card-link {
    font-size: 12px;
    font-weight: 600;
    color: #ff5400;
    cursor: pointer;
    border: none;
    background: transparent;
}

/* Phone Mockup */
.cl-phone-mockup {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
}

.cl-phone-header {
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cl-phone-brand {
    display: flex;
    align-items: center;
    gap: 8px;
}

.cl-brand-logo {
    width: 26px;
    height: 26px;
    border-radius: 6px;
    background: #ff5400;
    color: #ffffff;
    font-weight: 800;
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cl-brand-name {
    font-size: 12px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.1;
}

.cl-brand-status {
    font-size: 10px;
    color: #16a34a;
}

.cl-brand-badge {
    background: #fee2e2;
    color: #b91c1c;
    font-size: 10px;
    font-weight: 700;
    padding: 1px 6px;
    border-radius: 4px;
}

.cl-preview-flow {
    padding: 12px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.cl-flow-step {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cl-step-header {
    display: flex;
    align-items: center;
    gap: 6px;
}

.cl-step-badge {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #475569;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cl-step-title {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
}

.cl-chat-row {
    display: flex;
    gap: 6px;
    max-width: 100%;
}

.cl-row-user {
    justify-content: flex-end;
}

.cl-user-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #cbd5e1;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    order: 2;
}

.cl-user-avatar svg { width: 14px; height: 14px; }

.cl-bubble-user {
    background: #ff5400;
    color: #ffffff;
    border-radius: 12px 2px 12px 12px;
    padding: 8px 12px;
    font-size: 12px;
    max-width: 80%;
    order: 1;
}

.cl-bot-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #e0f2fe;
    color: #0284c7;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-bot-avatar svg { width: 14px; height: 14px; }

.cl-bubble-bot {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 2px 12px 12px 12px;
    padding: 8px 12px;
    font-size: 12px;
    color: #1e293b;
    max-width: 85%;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
}

.cl-bot-msg-text {
    line-height: 1.4;
}

.cl-bot-options {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-top: 8px;
}

.cl-opt-button {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 5px 8px;
    font-size: 11px;
    font-weight: 500;
    color: #0284c7;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    transition: all 0.15s ease;
}

.cl-opt-button:hover {
    background: #e0f2fe;
    border-color: #bae6fd;
}

/* Workflow Container */
.cl-workflow-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.cl-node-box {
    width: 100%;
    border-radius: 8px;
    padding: 10px 12px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
}

.cl-node-box.is-trigger { border-left: 4px solid #ea580c; background: #fffaf5; }
.cl-node-box.is-condition { border-left: 4px solid #d97706; background: #fffdf5; }
.cl-node-box.is-action { border-left: 4px solid #0284c7; background: #f8fbff; }
.cl-node-box.is-next { border-left: 4px solid #16a34a; background: #f6fcf8; }

.cl-node-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 4px;
}

.cl-node-type {
    font-size: 10px;
    font-weight: 800;
    color: #64748b;
    letter-spacing: 0.04em;
}

.cl-node-badge {
    font-size: 9px;
    font-weight: 700;
    background: #e2e8f0;
    color: #475569;
    padding: 1px 5px;
    border-radius: 4px;
}

.cl-node-content {
    font-size: 12px;
    color: #1e293b;
    line-height: 1.4;
}

.cl-node-rule-item {
    font-size: 11px;
    color: #475569;
    margin-top: 2px;
}

.cl-node-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    margin-top: 6px;
}

.cl-node-chip {
    font-size: 10px;
    background: #e0f2fe;
    color: #0369a1;
    padding: 1px 6px;
    border-radius: 4px;
}

.cl-node-arrow {
    color: #94a3b8;
    font-weight: bold;
    font-size: 14px;
}

/* Settings List */
.cl-settings-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.cl-setting-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 0;
    border-bottom: 1px dashed #f1f5f9;
    font-size: 12px;
}

.cl-setting-label {
    color: #64748b;
}

.cl-setting-val {
    color: #0f172a;
}

.cl-details-actions {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-top: 12px;
}

/* Modal Overlay & Base */
.cl-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 1rem;
}

.cl-modal-box {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    width: 100%;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.cl-modal-box.is-sm { max-width: 440px; }
.cl-modal-box.is-md { max-width: 580px; }
.cl-modal-box.is-lg { max-width: 760px; }
.cl-modal-box.is-xl { max-width: 960px; }

.cl-modal-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f8fafc;
}

.cl-modal-title-wrap {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.cl-modal-icon {
    font-size: 22px;
}

.cl-modal-title {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}

.cl-modal-desc {
    font-size: 12px;
    color: #64748b;
    margin: 2px 0 0 0;
}

.cl-modal-close {
    background: transparent;
    border: none;
    font-size: 16px;
    color: #94a3b8;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 4px;
}

.cl-modal-close:hover {
    background: #e2e8f0;
    color: #0f172a;
}

.cl-modal-body {
    padding: 1.25rem;
    overflow-y: auto;
}

.cl-modal-footer {
    padding: 0.75rem 1.25rem;
    border-top: 1px solid #e2e8f0;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.5rem;
}

/* Test Simulator Modal specifics */
.cl-test-presets {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.cl-preset-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
}

.cl-preset-btn {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 2px 8px;
    font-size: 11px;
    color: #334155;
    cursor: pointer;
}

.cl-preset-btn:hover {
    background: #e2e8f0;
    color: #0f172a;
}

.cl-test-input-row {
    display: flex;
    gap: 8px;
    margin-bottom: 1.25rem;
}

.cl-test-input {
    flex: 1;
    height: 40px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 12px;
    font-size: 13px;
    outline: none;
}

.cl-test-input:focus {
    border-color: #ff5400;
    box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15);
}

.cl-test-result-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
}

.cl-result-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 0.65rem;
    border-bottom: 1px solid #e2e8f0;
}

.cl-result-badge-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
}

.cl-res-badge {
    font-size: 11px;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 6px;
    border: 1px solid;
    letter-spacing: 0.04em;
}

.cl-res-label {
    font-size: 13px;
    font-weight: 700;
    color: #0f172a;
}

.cl-res-time {
    font-size: 11px;
    font-mono: ui-monospace, monospace;
    color: #64748b;
}

.cl-test-pipeline {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.cl-pipe-step {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.cl-pipe-num {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: #ff5400;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-pipe-detail {
    flex: 1;
}

.cl-pipe-title {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
}

.cl-pipe-val {
    font-size: 13px;
    color: #0f172a;
    margin-top: 1px;
}

.cl-pipe-response {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 13px;
    color: #1e293b;
    margin-top: 4px;
    line-height: 1.4;
}

.cl-pipe-options {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 6px;
}

.cl-pipe-opt-chip {
    font-size: 11px;
    background: #e0f2fe;
    color: #0369a1;
    padding: 2px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.cl-test-note {
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 12px;
    color: #92400e;
    margin-top: 12px;
}

/* Conflict Modal specifics */
.cl-conflict-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.cl-conflict-item {
    border-radius: 8px;
    padding: 10px 12px;
    border: 1px solid;
}

.cl-conflict-item.is-danger {
    background: #fef2f2;
    border-color: #fecaca;
    color: #991b1b;
}

.cl-conflict-item.is-warning {
    background: #fffbeb;
    border-color: #fde68a;
    color: #92400e;
}

.cl-conflict-head {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
}

.cl-conflict-badge {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 4px;
}

.cl-conflict-badge.is-danger { background: #dc2626; color: #ffffff; }
.cl-conflict-badge.is-warning { background: #d97706; color: #ffffff; }

.cl-conflict-rec {
    font-size: 12px;
    margin-top: 4px;
    padding-top: 4px;
    border-top: 1px dashed rgba(0, 0, 0, 0.1);
}

.cl-no-conflicts {
    text-align: center;
    padding: 2rem 1rem;
}

.cl-ok-icon {
    display: inline-block;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #dcfce7;
    color: #16a34a;
    font-size: 20px;
    line-height: 38px;
    margin-bottom: 0.5rem;
}

/* Version Modal specifics */
.cl-version-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.cl-version-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cl-version-meta {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cl-ver-badge {
    background: #ff5400;
    color: #ffffff;
    font-weight: 800;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 6px;
}

/* Form Grid */
.cl-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.cl-form-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.cl-form-group.col-span-2 {
    grid-column: span 2;
}

.cl-form-label {
    font-size: 12px;
    font-weight: 600;
    color: #334155;
}

.cl-form-input {
    height: 38px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 0 10px;
    font-size: 13px;
    color: #0f172a;
    outline: none;
}

.cl-form-input:focus {
    border-color: #ff5400;
    box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15);
}

textarea.cl-form-input {
    height: auto;
    padding: 8px 10px;
}

.cl-chip-removable {
    background: #e0f2fe;
    color: #0369a1;
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.cl-chip-del {
    border: none;
    background: transparent;
    color: #0284c7;
    cursor: pointer;
    font-size: 10px;
}

/* Command Palette Box */
.cl-palette-box {
    background: #ffffff;
    border-radius: 12px;
    width: 100%;
    max-width: 580px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    overflow: hidden;
}

.cl-palette-search-wrap {
    position: relative;
    padding: 12px 14px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
}

.cl-palette-input {
    width: 100%;
    height: 36px;
    border: none;
    padding: 0 32px 0 28px;
    font-size: 15px;
    color: #0f172a;
    outline: none;
}

.cl-palette-list {
    max-height: 380px;
    overflow-y: auto;
    padding: 8px;
}

.cl-palette-section {
    font-size: 10px;
    font-weight: 800;
    color: #94a3b8;
    padding: 8px 10px 4px 10px;
    letter-spacing: 0.05em;
}

.cl-palette-item {
    width: 100%;
    border: none;
    background: transparent;
    border-radius: 6px;
    padding: 8px 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 13px;
    color: #334155;
    text-align: left;
    transition: all 0.1s ease;
}

.cl-palette-item:hover, .cl-palette-item:focus {
    background: #fff7ed;
    color: #ff5400;
}

.cl-palette-icon {
    font-size: 16px;
}

.cl-palette-text {
    flex: 1;
    font-weight: 500;
}

.cl-palette-key {
    background: #f1f5f9;
    color: #64748b;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 4px;
    font-family: ui-monospace, monospace;
}

/* Shortcut Modal Table */
.cl-shortcut-table {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cl-shortcut-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 0;
    border-bottom: 1px dashed #f1f5f9;
    font-size: 13px;
}

.cl-shortcut-action {
    color: #334155;
    font-weight: 500;
}
</style>
</x-filament-panels::page>
