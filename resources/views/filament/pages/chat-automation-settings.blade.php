<x-filament-panels::page>
@php
    $filteredScripts = $this->getFilteredScripts();
    $selected = $this->getSelectedScript();
    $totalCount = count($scripts);
    $welcomeCount = count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'welcome'));
    $consultingCount = count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'consulting'));
    $careCount = count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'care'));
    $otherCount = count(array_filter($scripts, fn($s) => ($s['category'] ?? '') === 'other'));
@endphp

<div class="cl-auto-wrap">
    <!-- Top Breadcrumb & Header Row -->
    <div class="cl-auto-header">
        <div class="cl-auto-header-left">
            <!-- Breadcrumb -->
            <div class="cl-auto-breadcrumb">
                <span>Truyền thông & CSKH</span>
                <span class="cl-crumb-sep">›</span>
                <span class="cl-crumb-active">Kịch bản tự động</span>
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
                    <h1 class="cl-auto-title">Kịch Bản Tự Động</h1>
                    <p class="cl-auto-subtitle">Tạo và quản lý các kịch bản tự động để phản hồi khách hàng nhanh chóng, chuyên nghiệp và hiệu quả.</p>
                </div>
            </div>
        </div>

        <!-- Top Right Actions: Search + Create Button -->
        <div class="cl-auto-header-right">
            <div class="cl-search-box">
                <svg class="cl-search-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Tìm kiếm kịch bản..."
                    class="cl-search-input"
                />
            </div>

            <button
                type="button"
                wire:click="createNewScript"
                class="cl-btn-create"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tạo kịch bản mới</span>
            </button>
        </div>
    </div>

    <!-- Filter Pills Row -->
    <div class="cl-filter-row">
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
            <span class="cl-pill-count">2</span>
        </button>

        <button
            type="button"
            wire:click="setFilter('consulting')"
            class="cl-filter-pill {{ $activeFilter === 'consulting' ? 'active' : '' }}"
        >
            <span>Tư vấn dịch vụ</span>
            <span class="cl-pill-count">2</span>
        </button>

        <button
            type="button"
            wire:click="setFilter('care')"
            class="cl-filter-pill {{ $activeFilter === 'care' ? 'active' : '' }}"
        >
            <span>Chăm sóc KH</span>
            <span class="cl-pill-count">1</span>
        </button>

        <button
            type="button"
            wire:click="setFilter('other')"
            class="cl-filter-pill {{ $activeFilter === 'other' ? 'active' : '' }}"
        >
            <span>Khác</span>
            <span class="cl-pill-count">1</span>
        </button>
    </div>

    <!-- Main Content: 2 Columns Split Grid -->
    <div class="cl-main-grid">
        <!-- Left Column: Scripts Table (approx 72%) -->
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
                                />
                            </th>
                            <th class="cl-th-name">Tên kịch bản</th>
                            <th class="cl-th-cat">Loại</th>
                            <th class="cl-th-trigger">Điều kiện kích hoạt</th>
                            <th class="cl-th-status">Trạng thái</th>
                            <th class="cl-th-uses">Lượt sử dụng</th>
                            <th class="cl-th-actions">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($filteredScripts as $s)
                            @php
                                $isSelected = ($selectedScriptId === ($s['id'] ?? ''));
                                $isChecked = in_array($s['id'], $selectedIds);
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
                                    />
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
                                            <div class="cl-script-title">{{ $s['name'] ?? '' }}</div>
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
                                    <span class="cl-trigger-text">{{ $s['trigger'] ?? '' }}</span>
                                </td>

                                <!-- Trạng thái (Toggle Switch) -->
                                <td class="cl-td-status" wire:click.stop>
                                    <div class="cl-toggle-wrap">
                                        <button
                                            type="button"
                                            wire:click="toggleScript('{{ $s['id'] }}')"
                                            class="cl-switch {{ ($s['enabled'] ?? false) ? 'is-active' : '' }}"
                                            aria-label="Toggle script"
                                        >
                                            <span class="cl-switch-knob"></span>
                                        </button>
                                        <span class="cl-status-label {{ ($s['enabled'] ?? false) ? 'is-active' : 'is-inactive' }}">
                                            {{ ($s['enabled'] ?? false) ? 'Đang hoạt động' : 'Tạm dừng' }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Lượt sử dụng -->
                                <td class="cl-td-uses">
                                    <span class="cl-uses-count">{{ $s['usage_count'] ?? '0' }}</span>
                                </td>

                                <!-- Thao tác -->
                                <td class="cl-td-actions" wire:click.stop>
                                    <div class="cl-actions-wrap">
                                        <button
                                            type="button"
                                            wire:click="editScript('{{ $s['id'] }}')"
                                            class="cl-act-btn"
                                            title="Chỉnh sửa"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            wire:click="duplicateScript('{{ $s['id'] }}')"
                                            class="cl-act-btn"
                                            title="Sao chép"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                                <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            class="cl-act-btn"
                                            title="Tùy chọn khác"
                                        >
                                            <svg viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="cl-empty-row">
                                    Không tìm thấy kịch bản nào phù hợp với bộ lọc.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer: Count & Pagination -->
            <div class="cl-table-footer">
                <div class="cl-footer-count">
                    Tổng cộng: <strong>{{ count($filteredScripts) }}</strong> kịch bản
                </div>

                <div class="cl-pagination">
                    <button type="button" class="cl-page-nav is-disabled" disabled aria-label="Previous">
                        ‹
                    </button>
                    <button type="button" class="cl-page-num is-active">
                        1
                    </button>
                    <button type="button" class="cl-page-nav is-disabled" disabled aria-label="Next">
                        ›
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Column: Preview & Configuration Cards (approx 28%) -->
        <div class="cl-side-column">
            <!-- Card 1: Xem trước kịch bản -->
            <div class="cl-side-card">
                <div class="cl-card-header">
                    <h2 class="cl-card-title">Xem trước kịch bản</h2>
                    <a href="javascript:void(0)" wire:click="editScript('{{ $selected['id'] ?? '' }}')" class="cl-card-link">
                        Xem chi tiết
                    </a>
                </div>

                <!-- Simulation Flow -->
                <div class="cl-preview-flow">
                    <!-- Step 1: Khách hàng bắt đầu chat -->
                    <div class="cl-flow-step">
                        <div class="cl-step-header">
                            <span class="cl-step-badge">1</span>
                            <span class="cl-step-title">{{ $selected['preview_trigger'] ?? 'Khách hàng bắt đầu chat' }}</span>
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

                    <!-- Step 2: Hệ thống tự động phản hồi -->
                    <div class="cl-flow-step is-last">
                        <div class="cl-step-header">
                            <span class="cl-step-badge">2</span>
                            <span class="cl-step-title">Hệ thống tự động phản hồi</span>
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

            <!-- Card 2: Cài đặt kịch bản -->
            <div class="cl-side-card">
                <div class="cl-card-header">
                    <h2 class="cl-card-title">Cài đặt kịch bản</h2>
                </div>

                <div class="cl-settings-list">
                    <!-- Row 1: Tên kịch bản -->
                    <div class="cl-setting-row">
                        <div class="cl-setting-left">
                            <svg class="cl-setting-icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                            </svg>
                            <span class="cl-setting-label">Tên kịch bản</span>
                        </div>
                        <div class="cl-setting-val">
                            {{ $selected['name'] ?? 'Chào mừng khách hàng' }}
                        </div>
                    </div>

                    <!-- Row 2: Loại kịch bản -->
                    <div class="cl-setting-row">
                        <div class="cl-setting-left">
                            <svg class="cl-setting-icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M17.707 9.293l-5-5A.997.997 0 0012 4H5a2 2 0 00-2 2v7a2 2 0 002 2h7a.997.997 0 00.707-.293l5-5a.999.999 0 000-1.414zM8 9a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" clip-rule="evenodd" />
                            </svg>
                            <span class="cl-setting-label">Loại kịch bản</span>
                        </div>
                        <div class="cl-setting-val">
                            @php
                                $c = $selected['category'] ?? '';
                                $bClass = match($c) {
                                    'welcome' => 'badge-welcome',
                                    'consulting' => 'badge-consulting',
                                    'care' => 'badge-care',
                                    default => 'badge-other',
                                };
                            @endphp
                            <span class="cl-badge {{ $bClass }}">
                                {{ $selected['category_label'] ?? 'Chào mừng' }}
                            </span>
                        </div>
                    </div>

                    <!-- Row 3: Trạng thái -->
                    <div class="cl-setting-row">
                        <div class="cl-setting-left">
                            <svg class="cl-setting-icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                            </svg>
                            <span class="cl-setting-label">Trạng thái</span>
                        </div>
                        <div class="cl-setting-val">
                            @if($selected['enabled'] ?? false)
                                <span class="cl-badge badge-active">
                                    <span class="cl-dot-green"></span> Đang hoạt động
                                </span>
                            @else
                                <span class="cl-badge badge-other">
                                    <span class="cl-dot-gray"></span> Tạm dừng
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Reset Filament Wrappers */
.fi-page-header, .fi-header {
    display: none !important;
}

.cl-auto-wrap {
    background-color: #f8fafc;
    margin: -1.5rem -1.5rem !important;
    padding: 1.5rem 1.75rem 3rem 1.75rem !important;
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

.cl-auto-title-row {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    margin-top: 2px;
}

.cl-robot-avatar {
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

.cl-robot-svg {
    width: 24px;
    height: 24px;
}

.cl-auto-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.01em;
}

.cl-auto-subtitle {
    font-size: 13px;
    color: #64748b;
    margin: 3px 0 0 0;
    line-height: 1.4;
}

/* Header Right: Search & Create Button */
.cl-auto-header-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.cl-search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.cl-search-icon {
    position: absolute;
    left: 12px;
    width: 18px;
    height: 18px;
    color: #94a3b8;
    pointer-events: none;
}

.cl-search-input {
    width: 260px;
    height: 40px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 12px 0 38px;
    font-size: 13px;
    color: #1e293b;
    outline: none;
    transition: all 0.2s ease;
}

.cl-search-input:focus {
    border-color: #ff5400;
    box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15);
}

.cl-btn-create {
    height: 40px;
    background-color: #ff5400;
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    padding: 0 18px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(255, 84, 0, 0.25);
    transition: all 0.15s ease;
    white-space: nowrap;
}

.cl-btn-create:hover {
    background-color: #e64a00;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(255, 84, 0, 0.3);
}

.cl-btn-create:active {
    transform: translateY(0);
}

/* Filter Row */
.cl-filter-row {
    display: flex;
    align-items: center;
    gap: 0.65rem;
    margin-bottom: 1.25rem;
    overflow-x: auto;
    padding-bottom: 4px;
}

.cl-filter-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    height: 38px;
    padding: 0 16px;
    border-radius: 9999px;
    font-size: 13px;
    font-weight: 500;
    color: #475569;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.15s ease;
}

.cl-filter-pill:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.cl-filter-pill.active {
    background-color: #ff5400;
    border-color: #ff5400;
    color: #ffffff;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(255, 84, 0, 0.2);
}

.cl-pill-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 18px;
    height: 18px;
    padding: 0 5px;
    border-radius: 9999px;
    font-size: 11px;
    font-weight: 600;
    background: #f1f5f9;
    color: #64748b;
}

.cl-filter-pill.active .cl-pill-count {
    background: rgba(255, 255, 255, 0.28);
    color: #ffffff;
}

/* Main Grid Layout */
.cl-main-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 1.25rem;
    align-items: start;
}

@media (max-width: 1200px) {
    .cl-main-grid {
        grid-template-columns: 1fr;
    }
}

/* Left: Table Container */
.cl-table-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}

.cl-table-responsive {
    width: 100%;
    overflow-x: auto;
}

.cl-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 13px;
    table-layout: auto;
}

.cl-table thead tr {
    border-bottom: 1px solid #e2e8f0;
    background-color: #ffffff;
}

.cl-table th {
    padding: 11px 6px;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    text-transform: none;
    letter-spacing: 0;
    white-space: nowrap;
}

.cl-th-check, .cl-td-check {
    width: 28px;
    padding-left: 10px !important;
    padding-right: 2px !important;
    text-align: center;
}

.cl-th-name {
    min-width: 180px;
}

.cl-th-cat {
    width: 90px;
}

.cl-th-trigger {
    min-width: 150px;
}

.cl-th-status {
    width: 125px;
}

.cl-th-uses {
    width: 70px;
    text-align: left;
}

.cl-th-actions {
    width: 80px;
    text-align: center;
}

.cl-checkbox {
    width: 15px;
    height: 15px;
    border-radius: 4px;
    border: 1.5px solid #cbd5e1;
    cursor: pointer;
    accent-color: #ff5400;
}

.cl-tr {
    border-bottom: 1px solid #f1f5f9;
    cursor: pointer;
    transition: background-color 0.15s ease;
}

.cl-tr:hover {
    background-color: #f8fafc;
}

.cl-tr.is-selected {
    background-color: #f0f7ff;
}

.cl-table td {
    padding: 10px 6px;
    vertical-align: middle;
}

/* Name Column */
.cl-name-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.cl-script-icon-wrap {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

.cl-icon-svg {
    width: 18px;
    height: 18px;
}

.cl-name-info {
    display: flex;
    flex-direction: column;
}

.cl-script-title {
    font-size: 13px;
    font-weight: 600;
    color: #0f172a;
    line-height: 1.3;
}

.cl-script-desc {
    font-size: 11px;
    color: #64748b;
    margin-top: 2px;
    line-height: 1.35;
    max-width: 220px;
}

/* Badges */
.cl-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 500;
    white-space: nowrap;
    line-height: 1.3;
}

.badge-welcome {
    background-color: #e0f2fe;
    color: #0284c7;
    border: 1px solid #bae6fd;
}

.badge-consulting {
    background-color: #dcfce7;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}

.badge-care {
    background-color: #f3e8ff;
    color: #9333ea;
    border: 1px solid #e9d5ff;
}

.badge-other {
    background-color: #f1f5f9;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.badge-active {
    background-color: #dcfce7;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}

.cl-dot-green {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #16a34a;
}

.cl-dot-gray {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #94a3b8;
}

/* Trigger column */
.cl-trigger-text {
    font-size: 11.5px;
    color: #334155;
    line-height: 1.35;
    display: inline-block;
    max-width: 170px;
}

/* Toggle Switch */
.cl-toggle-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.cl-switch {
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

.cl-switch.is-active {
    background-color: #2563eb;
}

.cl-switch-knob {
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

.cl-switch.is-active .cl-switch-knob {
    transform: translateX(16px);
}

.cl-status-label {
    font-size: 12px;
    font-weight: 500;
}

.cl-status-label.is-active {
    color: #2563eb;
}

.cl-status-label.is-inactive {
    color: #64748b;
}

/* Usage count */
.cl-uses-count {
    font-size: 12.5px;
    font-weight: 600;
    color: #334155;
}

/* Action Buttons */
.cl-actions-wrap {
    display: flex;
    align-items: center;
    gap: 4px;
}

.cl-act-btn {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    background: transparent;
    border: none;
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
    background-color: #e2e8f0;
    color: #0f172a;
}

.cl-empty-row {
    text-align: center;
    padding: 40px !important;
    color: #64748b;
    font-size: 13px;
}

/* Table Footer */
.cl-table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 18px;
    border-top: 1px solid #f1f5f9;
    background-color: #ffffff;
    font-size: 12px;
}

.cl-footer-count {
    color: #64748b;
}

.cl-pagination {
    display: flex;
    align-items: center;
    gap: 4px;
}

.cl-page-nav, .cl-page-num {
    height: 28px;
    min-width: 28px;
    padding: 0 8px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    color: #475569;
    cursor: pointer;
    transition: all 0.15s ease;
}

.cl-page-num.is-active {
    background-color: #2563eb;
    border-color: #2563eb;
    color: #ffffff;
    font-weight: 600;
}

.cl-page-nav.is-disabled {
    color: #cbd5e1;
    background: #f8fafc;
    border-color: #f1f5f9;
    cursor: not-allowed;
}

/* Right Side Column */
.cl-side-column {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.cl-side-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 18px 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.cl-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
}

.cl-card-title {
    font-size: 14.5px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.cl-card-link {
    font-size: 12px;
    color: #2563eb;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.15s;
}

.cl-card-link:hover {
    text-decoration: underline;
    color: #1d4ed8;
}

/* Simulation Flow in Card 1 */
.cl-preview-flow {
    display: flex;
    flex-direction: column;
    position: relative;
}

.cl-flow-step {
    position: relative;
    padding-bottom: 16px;
}

.cl-flow-step:not(.is-last)::after {
    content: '';
    position: absolute;
    left: 10px;
    top: 24px;
    bottom: 0px;
    width: 2px;
    background: #e2e8f0;
}

.cl-step-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
}

.cl-step-badge {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #ff5400;
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    z-index: 1;
}

.cl-step-title {
    font-size: 12.5px;
    font-weight: 600;
    color: #0f172a;
}

.cl-step-body {
    padding-left: 28px;
}

.cl-chat-row {
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.cl-user-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    flex-shrink: 0;
}

.cl-user-avatar svg {
    width: 16px;
    height: 16px;
}

.cl-bubble-user {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 8px 14px;
    font-size: 12px;
    color: #1e293b;
    line-height: 1.4;
}

.cl-bot-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #e0f2fe;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0284c7;
    flex-shrink: 0;
    margin-top: 2px;
}

.cl-bot-avatar svg {
    width: 16px;
    height: 16px;
}

.cl-bubble-bot {
    background-color: #f0f7ff;
    border: 1px solid #bae6fd;
    border-radius: 12px;
    padding: 12px 14px;
    font-size: 12px;
    color: #0f172a;
    line-height: 1.45;
    flex: 1;
}

.cl-bot-msg-text {
    font-size: 12px;
    color: #1e293b;
    white-space: pre-line;
}

.cl-bot-options {
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cl-opt-button {
    background: #ffffff;
    border: 1px solid #bae6fd;
    border-radius: 8px;
    padding: 7px 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 11.5px;
    font-weight: 500;
    color: #0284c7;
    cursor: pointer;
    transition: all 0.15s ease;
}

.cl-opt-button:hover {
    background: #f8fafc;
    border-color: #0284c7;
}

.cl-opt-arrow {
    font-size: 14px;
    color: #0284c7;
}

/* Card 2: Cài đặt kịch bản */
.cl-settings-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.cl-setting-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12px;
    padding: 4px 0;
}

.cl-setting-left {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #64748b;
}

.cl-setting-icon {
    width: 16px;
    height: 16px;
    color: #64748b;
}

.cl-setting-label {
    color: #64748b;
    font-size: 12px;
}

.cl-setting-val {
    font-weight: 600;
    color: #0f172a;
    font-size: 12px;
    text-align: right;
}
</style>
</x-filament-panels::page>
