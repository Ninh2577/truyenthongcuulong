<x-filament-panels::page>
    <style>
        .cl-qr-page {
            font-family: inherit;
            color: #0f172a;
        }
        /* Top Breadcrumb */
        .cl-qr-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            color: #64748b;
            margin-bottom: 8px;
        }
        .cl-qr-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-qr-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Top Header Row */
        .cl-qr-header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 14px;
        }
        .cl-qr-header-left {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        .cl-qr-header-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #fff7ed;
            color: #ea580c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 1px 3px rgba(234, 88, 12, 0.15);
        }
        .cl-qr-header-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
            letter-spacing: -0.02em;
        }
        .cl-qr-header-desc {
            font-size: 13.5px;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
            max-width: 650px;
        }
        .cl-qr-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cl-qr-btn-guide {
            padding: 9px 16px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        .cl-qr-btn-guide:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a;
        }
        .cl-qr-btn-add {
            padding: 9px 18px;
            border-radius: 10px;
            border: none;
            background: #ff5400;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.35);
            transition: all 0.15s ease;
        }
        .cl-qr-btn-add:hover {
            background: #e04b00;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.45);
            transform: translateY(-1px);
        }

        /* 4 Stat Cards */
        .cl-qr-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 22px;
        }
        @media (max-width: 1024px) {
            .cl-qr-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 640px) {
            .cl-qr-stats-grid {
                grid-template-columns: 1fr;
            }
        }
        .cl-qr-stat-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }
        .cl-qr-stat-box:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }
        .cl-qr-stat-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .cl-qr-stat-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 2px;
        }
        .cl-qr-stat-value {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            margin-bottom: 4px;
            letter-spacing: -0.02em;
        }
        .cl-qr-stat-trend {
            font-size: 11.5px;
            font-weight: 600;
            color: #16a34a;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Main Workspace 2 Columns */
        .cl-qr-workspace-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 18px;
            align-items: start;
            width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1140px) {
            .cl-qr-workspace-layout {
                grid-template-columns: 1fr;
            }
        }

        /* Filter Controls Bar */
        .cl-qr-filter-bar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 14px;
            flex-wrap: wrap;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            box-sizing: border-box;
        }
        .cl-qr-search-wrap {
            position: relative;
            flex: 1 1 200px;
            min-width: 180px;
        }
        .cl-qr-search-input {
            width: 100%;
            height: 38px;
            padding: 8px 12px 8px 34px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 13px;
            color: #0f172a;
            background: #ffffff;
            outline: none;
            box-sizing: border-box;
            transition: all 0.15s ease;
        }
        .cl-qr-search-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .cl-qr-filter-selects {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            flex-shrink: 0;
        }
        .cl-qr-select {
            height: 38px;
            padding: 0 32px 0 12px !important;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            background-color: #ffffff;
            outline: none;
            cursor: pointer;
            box-sizing: border-box;
            flex-shrink: 0;
            transition: all 0.15s ease;
        }
        .cl-qr-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .cl-qr-select-cat {
            min-width: 155px;
        }
        .cl-qr-select-type {
            min-width: 120px;
        }
        .cl-qr-select-status {
            min-width: 125px;
        }

        /* Category Pill Tabs Row */
        .cl-qr-category-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .cl-qr-pill-btn {
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.15s ease;
        }
        .cl-qr-pill-btn:hover {
            border-color: #cbd5e1;
            color: #0f172a;
            background: #f8fafc;
        }
        .cl-qr-pill-btn.is-active {
            background: #ff5400;
            color: #ffffff;
            border-color: #ff5400;
            box-shadow: 0 2px 6px rgba(255, 84, 0, 0.3);
        }
        .cl-qr-pill-badge {
            background: rgba(0, 0, 0, 0.08);
            border-radius: 9999px;
            padding: 1px 7px;
            font-size: 11px;
            font-weight: 700;
        }
        .cl-qr-pill-btn.is-active .cl-qr-pill-badge {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        /* Cards Grid */
        .cl-qr-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }
        @media (max-width: 1420px) {
            .cl-qr-cards-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 680px) {
            .cl-qr-cards-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Individual Quick Reply Card */
        .cl-qr-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
            position: relative;
        }
        .cl-qr-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 18px -2px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }
        .cl-qr-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
        }
        .cl-qr-card-title-group {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            flex: 1;
        }
        .cl-qr-circle-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        .cl-qr-card-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .cl-qr-shortcut-pill {
            background: #ecfeff;
            color: #0284c7;
            border: 1px solid #bae6fd;
            font-family: ui-monospace, monospace;
            font-weight: 700;
            font-size: 11.5px;
            padding: 2px 8px;
            border-radius: 6px;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .cl-qr-card-body {
            font-size: 13px;
            line-height: 1.55;
            color: #475569;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 58px;
            word-break: break-word;
        }
        .cl-qr-card-cat-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            margin-bottom: 14px;
        }
        .cl-qr-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f1f5f9;
            padding-top: 12px;
            margin-top: 4px;
        }
        .cl-qr-footer-actions-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .cl-qr-action-link {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            background: transparent;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0;
            transition: color 0.15s ease;
        }
        .cl-qr-action-link:hover {
            color: #ff5400;
        }
        .cl-qr-footer-actions-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Toggle Switch UI */
        .cl-qr-toggle-wrap {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            user-select: none;
            font-size: 11.5px;
            font-weight: 700;
        }
        .cl-qr-toggle-track {
            width: 32px;
            height: 18px;
            border-radius: 9999px;
            position: relative;
            transition: background 0.2s ease;
        }
        .cl-qr-toggle-thumb {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ffffff;
            position: absolute;
            top: 2px;
            transition: transform 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Right Sidebar Cards */
        .cl-qr-sidebar-wrap {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: sticky;
            top: 20px;
            width: 100%;
            max-width: 280px;
            box-sizing: border-box;
        }
        .cl-qr-guide-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 18px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            box-sizing: border-box;
        }
        .cl-qr-guide-box-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f5f9;
        }
        .cl-qr-guide-box-title {
            font-size: 14.5px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }
        .cl-qr-guide-reset-btn {
            font-size: 11.5px;
            color: #64748b;
            background: transparent;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-weight: 600;
        }
        .cl-qr-guide-reset-btn:hover {
            color: #ff5400;
        }
        .cl-qr-shortcut-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 7px 0;
            font-size: 12px;
            border-bottom: 1px dashed #f1f5f9;
        }
        .cl-qr-shortcut-row:last-child {
            border-bottom: none;
        }
        .cl-qr-kbd-key {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 2px 7px;
            font-family: ui-monospace, monospace;
            font-weight: 700;
            font-size: 11px;
            color: #334155;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            white-space: nowrap;
            flex-shrink: 0;
        }
        .cl-qr-shortcut-label {
            color: #475569;
            font-size: 11.5px;
            text-align: right;
            white-space: nowrap;
        }

        /* Tips Card (Light Blue) */
        .cl-qr-tips-box {
            background: #f0f7ff;
            border: 1px solid #e0f2fe;
            border-radius: 16px;
            padding: 18px;
        }
        .cl-qr-tips-title {
            font-size: 13.5px;
            font-weight: 800;
            color: #0369a1;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0 0 10px 0;
        }
        .cl-qr-tips-list {
            margin: 0 0 16px 0;
            padding: 0;
            list-style: none;
            font-size: 12px;
            color: #334155;
            line-height: 1.6;
        }
        .cl-qr-tips-list li {
            margin-bottom: 4px;
        }
        .cl-qr-tips-mockup {
            background: #ffffff;
            border: 1px solid #bae6fd;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.08);
        }
        .cl-qr-tips-mockup-tag {
            font-family: ui-monospace, monospace;
            font-weight: 800;
            color: #0284c7;
            font-size: 13px;
        }
        .cl-qr-tips-send-icon {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #0284c7;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }
        .cl-qr-tips-caption {
            font-size: 11px;
            color: #64748b;
            text-align: center;
            margin-top: 8px;
        }

        /* Modals */
        .cl-qr-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(8px);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        .cl-qr-modal-card {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 580px;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            animation: clModalZoomIn 0.2s ease-out;
        }
        @keyframes clModalZoomIn {
            from { opacity: 0; transform: scale(0.96) translateY(8px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
    </style>

    <div class="cl-qr-page">
        {{-- 1. Top Breadcrumb --}}
        <div class="cl-qr-breadcrumb">
            <a href="/cuulongteam">Trang chủ</a>
            <span>›</span>
            <span style="font-weight: 700; color: #0f172a;">Phím tắt & Mẫu tin</span>
        </div>

        {{-- 2. Header Row --}}
        <div class="cl-qr-header-row">
            <div class="cl-qr-header-left">
                <div class="cl-qr-header-icon">
                    ⚡
                </div>
                <div>
                    <h1 class="cl-qr-header-title">Phím tắt & Mẫu tin nhắn</h1>
                    <p class="cl-qr-header-desc">
                        Quản lý các tin nhắn mẫu và phím tắt giúp bạn phản hồi khách hàng nhanh chóng, chuyên nghiệp và hiệu quả.
                    </p>
                </div>
            </div>

            <div class="cl-qr-header-actions">
                <button
                    type="button"
                    wire:click="openGuideModal"
                    class="cl-qr-btn-guide"
                >
                    <span>📖</span> Hướng dẫn sử dụng
                </button>

                <button
                    type="button"
                    wire:click="openCreateModal"
                    class="cl-qr-btn-add"
                >
                    <span>+</span> Thêm mẫu tin
                </button>
            </div>
        </div>

        {{-- 3. Top 4 Stat Metric Cards --}}
        <div class="cl-qr-stats-grid">
            {{-- Card 1: Tổng mẫu tin --}}
            <div class="cl-qr-stat-box">
                <div class="cl-qr-stat-icon-wrap" style="background: #f3e8ff; color: #9333ea;">
                    💬
                </div>
                <div>
                    <div class="cl-qr-stat-label">Tổng mẫu tin</div>
                    <div class="cl-qr-stat-value">{{ $this->stats['total'] }}</div>
                    <div class="cl-qr-stat-trend">
                        <span>↑</span> 2 mới trong tuần
                    </div>
                </div>
            </div>

            {{-- Card 2: Tổng phím tắt --}}
            <div class="cl-qr-stat-box">
                <div class="cl-qr-stat-icon-wrap" style="background: #e0f2fe; color: #0284c7;">
                    ⌨️
                </div>
                <div>
                    <div class="cl-qr-stat-label">Tổng phím tắt</div>
                    <div class="cl-qr-stat-value">{{ $this->stats['shortcuts'] }}</div>
                    <div class="cl-qr-stat-trend">
                        <span>↑</span> 1 mới trong tuần
                    </div>
                </div>
            </div>

            {{-- Card 3: Đã sử dụng hôm nay --}}
            <div class="cl-qr-stat-box">
                <div class="cl-qr-stat-icon-wrap" style="background: #ffe4e6; color: #e11d48;">
                    ▶
                </div>
                <div>
                    <div class="cl-qr-stat-label">Đã sử dụng hôm nay</div>
                    <div class="cl-qr-stat-value">{{ $this->stats['today_usage'] }}</div>
                    <div class="cl-qr-stat-trend">
                        <span>↑</span> 23% so với hôm qua
                    </div>
                </div>
            </div>

            {{-- Card 4: Danh mục --}}
            <div class="cl-qr-stat-box">
                <div class="cl-qr-stat-icon-wrap" style="background: #fef3c7; color: #d97706;">
                    📁
                </div>
                <div>
                    <div class="cl-qr-stat-label">Danh mục</div>
                    <div class="cl-qr-stat-value">{{ $this->stats['categories'] }}</div>
                    <div class="cl-qr-stat-trend">
                        <span>●</span> Đang hoạt động
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. Main Workspace Layout: Left Content (75%) + Right Sidebar (25%) --}}
        <div class="cl-qr-workspace-layout">
            {{-- ==================== LEFT COLUMN ==================== --}}
            <div>
                {{-- Filter Toolbar --}}
                <div class="cl-qr-filter-bar">
                    {{-- Search Input --}}
                    <div class="cl-qr-search-wrap">
                        <input
                            type="text"
                            wire:model.live.debounce.250ms="search"
                            placeholder="Tìm kiếm mẫu tin, phím tắt..."
                            class="cl-qr-search-input"
                        />
                        <span style="position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px;">
                            🔍
                        </span>
                        @if(!empty($search))
                            <button
                                type="button"
                                wire:click="$set('search', '')"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent; color: #94a3b8; cursor: pointer; font-size: 14px;"
                            >&times;</button>
                        @endif
                    </div>

                    <div class="cl-qr-filter-selects">
                        {{-- Dropdown: Tất cả danh mục --}}
                        <select
                            wire:model.live="activeCategory"
                            class="cl-qr-select cl-qr-select-cat"
                        >
                            <option value="all">Tất cả danh mục</option>
                            <option value="Chào hỏi">Chào hỏi</option>
                            <option value="Tư vấn dịch vụ">Tư vấn dịch vụ</option>
                            <option value="Báo giá">Báo giá</option>
                            <option value="CSKH">CSKH</option>
                            <option value="Khác">Khác</option>
                        </select>

                        {{-- Dropdown: Tất cả loại --}}
                        <select
                            wire:model.live="activeType"
                            class="cl-qr-select cl-qr-select-type"
                        >
                            <option value="all">Tất cả loại</option>
                            <option value="standard">Tiêu chuẩn</option>
                            <option value="custom">Tùy chỉnh</option>
                        </select>

                        {{-- Dropdown: Trạng thái --}}
                        <select
                            wire:model.live="activeStatus"
                            class="cl-qr-select cl-qr-select-status"
                        >
                            <option value="all">Trạng thái</option>
                            <option value="active">Đang dùng</option>
                            <option value="inactive">Tạm dừng</option>
                        </select>
                    </div>
                </div>

                {{-- Category Pill Tabs Row --}}
                <div class="cl-qr-category-row">
                    <button
                        type="button"
                        wire:click="$set('activeCategory', 'all')"
                        class="cl-qr-pill-btn {{ $activeCategory === 'all' ? 'is-active' : '' }}"
                    >
                        <span>Tất cả</span>
                        <span class="cl-qr-pill-badge">{{ $this->categoryCounts['all'] }}</span>
                    </button>

                    <button
                        type="button"
                        wire:click="$set('activeCategory', 'Chào hỏi')"
                        class="cl-qr-pill-btn {{ $activeCategory === 'Chào hỏi' ? 'is-active' : '' }}"
                    >
                        <span>Chào hỏi</span>
                        <span class="cl-qr-pill-badge">{{ $this->categoryCounts['Chào hỏi'] ?? 0 }}</span>
                    </button>

                    <button
                        type="button"
                        wire:click="$set('activeCategory', 'Tư vấn dịch vụ')"
                        class="cl-qr-pill-btn {{ $activeCategory === 'Tư vấn dịch vụ' ? 'is-active' : '' }}"
                    >
                        <span>Tư vấn dịch vụ</span>
                        <span class="cl-qr-pill-badge">{{ $this->categoryCounts['Tư vấn dịch vụ'] ?? 0 }}</span>
                    </button>

                    <button
                        type="button"
                        wire:click="$set('activeCategory', 'Báo giá')"
                        class="cl-qr-pill-btn {{ $activeCategory === 'Báo giá' ? 'is-active' : '' }}"
                    >
                        <span>Báo giá</span>
                        <span class="cl-qr-pill-badge">{{ $this->categoryCounts['Báo giá'] ?? 0 }}</span>
                    </button>

                    <button
                        type="button"
                        wire:click="$set('activeCategory', 'CSKH')"
                        class="cl-qr-pill-btn {{ $activeCategory === 'CSKH' ? 'is-active' : '' }}"
                    >
                        <span>CSKH</span>
                        <span class="cl-qr-pill-badge">{{ $this->categoryCounts['CSKH'] ?? 0 }}</span>
                    </button>

                    <button
                        type="button"
                        wire:click="$set('activeCategory', 'Khác')"
                        class="cl-qr-pill-btn {{ $activeCategory === 'Khác' ? 'is-active' : '' }}"
                    >
                        <span>Khác</span>
                        <span class="cl-qr-pill-badge">{{ $this->categoryCounts['Khác'] ?? 0 }}</span>
                    </button>
                </div>

                {{-- Cards Grid (3 Columns) --}}
                @if(empty($this->quickReplies))
                    <div style="text-align: center; padding: 48px 16px; background: #ffffff; border-radius: 16px; border: 1px dashed #cbd5e1; color: #64748b;">
                        <div style="font-size: 32px; margin-bottom: 8px;">🔍</div>
                        <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">Không tìm thấy mẫu tin phù hợp</h4>
                        <p style="font-size: 13px; margin: 0 0 16px 0;">Thử tìm kiếm với từ khóa khác hoặc tạo mẫu tin mới.</p>
                        <button
                            type="button"
                            wire:click="openCreateModal"
                            class="cl-qr-btn-add"
                        >
                            + Thêm mẫu tin
                        </button>
                    </div>
                @else
                    <div class="cl-qr-cards-grid">
                        @foreach($this->quickReplies as $item)
                            @php
                                $meta = $this->getCategoryMeta($item['category'] ?? 'Khác');
                                $isActive = (bool) ($item['is_active'] ?? true);
                            @endphp

                            <div class="cl-qr-card" wire:key="qr-item-{{ $item['id'] }}">
                                <div>
                                    {{-- Card Top Row --}}
                                    <div class="cl-qr-card-top">
                                        <div class="cl-qr-card-title-group">
                                            <div class="cl-qr-circle-icon" style="background: {{ $meta['bg'] }}; color: {{ $meta['color'] }};">
                                                <span>{{ $meta['icon'] }}</span>
                                            </div>
                                            <div class="cl-qr-card-title" title="{{ $item['title'] }}">
                                                {{ $item['title'] }}
                                            </div>
                                        </div>

                                        <div class="cl-qr-shortcut-pill">
                                            {{ $item['shortcut'] }}
                                        </div>
                                    </div>

                                    {{-- Card Body Preview --}}
                                    <div class="cl-qr-card-body" title="{{ $item['content'] }}">
                                        {{ $item['content'] }}
                                    </div>

                                    {{-- Category Badge --}}
                                    <div>
                                        <span class="cl-qr-card-cat-badge" style="background: {{ $meta['tag_bg'] }}; color: {{ $meta['tag_text'] }};">
                                            <span>{{ $meta['icon'] }}</span>
                                            <span>{{ $item['category'] ?? 'Tư vấn' }}</span>
                                        </span>
                                    </div>
                                </div>

                                {{-- Card Footer Actions --}}
                                <div class="cl-qr-card-footer">
                                    <div class="cl-qr-footer-actions-left">
                                        <button
                                            type="button"
                                            wire:click="openEditModal('{{ $item['id'] }}')"
                                            class="cl-qr-action-link"
                                            title="Chỉnh sửa mẫu tin"
                                        >
                                            ✏️ Sửa
                                        </button>

                                        <button
                                            type="button"
                                            onclick="navigator.clipboard.writeText(`{{ addslashes($item['content']) }}`); (window.ClElegantModal ? window.ClElegantModal.alert('Đã sao chép nội dung mẫu tin vào khay nhớ tạm!', 'Đã Sao Chép') : alert('Đã sao chép!'));"
                                            class="cl-qr-action-link"
                                            title="Sao chép nội dung"
                                        >
                                            📋 Sao chép
                                        </button>
                                    </div>

                                    <div class="cl-qr-footer-actions-right">
                                        {{-- Toggle State Switch --}}
                                        <div
                                            wire:click="toggleStatus('{{ $item['id'] }}')"
                                            class="cl-qr-toggle-wrap"
                                            title="{{ $isActive ? 'Bấm để tạm dừng phím tắt này' : 'Bấm để kích hoạt' }}"
                                        >
                                            <div
                                                class="cl-qr-toggle-track"
                                                style="background: {{ $isActive ? '#2563eb' : '#cbd5e1' }};"
                                            >
                                                <div
                                                    class="cl-qr-toggle-thumb"
                                                    style="left: {{ $isActive ? '16px' : '2px' }};"
                                                ></div>
                                            </div>
                                            <span style="color: {{ $isActive ? '#0284c7' : '#94a3b8' }};">
                                                {{ $isActive ? 'Đang dùng' : 'Tạm dừng' }}
                                            </span>
                                        </div>

                                        {{-- Three Dot Menu Trigger --}}
                                        <div x-data="{ menuOpen: false }" style="position: relative;">
                                            <button
                                                type="button"
                                                @click="menuOpen = !menuOpen"
                                                style="border: none; background: transparent; color: #94a3b8; font-size: 16px; cursor: pointer; padding: 2px 4px; line-height: 1;"
                                                title="Tùy chọn khác"
                                            >
                                                ⋮
                                            </button>

                                            <div
                                                x-show="menuOpen"
                                                @click.outside="menuOpen = false"
                                                x-cloak
                                                style="position: absolute; right: 0; bottom: calc(100% + 4px); background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); width: 140px; z-index: 50; padding: 4px; font-size: 12px;"
                                            >
                                                <button
                                                    type="button"
                                                    wire:click="openEditModal('{{ $item['id'] }}'); menuOpen = false;"
                                                    style="width: 100%; text-align: left; padding: 6px 10px; border-radius: 6px; border: none; background: transparent; cursor: pointer; color: #334155;"
                                                    onmouseover="this.style.background='#f1f5f9'"
                                                    onmouseout="this.style.background='transparent'"
                                                >
                                                    ✏️ Sửa mẫu tin
                                                </button>
                                                <button
                                                    type="button"
                                                    wire:click="duplicate('{{ $item['id'] }}'); menuOpen = false;"
                                                    style="width: 100%; text-align: left; padding: 6px 10px; border-radius: 6px; border: none; background: transparent; cursor: pointer; color: #334155;"
                                                    onmouseover="this.style.background='#f1f5f9'"
                                                    onmouseout="this.style.background='transparent'"
                                                >
                                                    📑 Nhân bản
                                                </button>
                                                <button
                                                    type="button"
                                                    wire:click="delete('{{ $item['id'] }}'); menuOpen = false;"
                                                    wire:confirm="Bạn có chắc chắn muốn xóa phím tắt này không?"
                                                    style="width: 100%; text-align: left; padding: 6px 10px; border-radius: 6px; border: none; background: transparent; cursor: pointer; color: #ef4444;"
                                                    onmouseover="this.style.background='#fef2f2'"
                                                    onmouseout="this.style.background='transparent'"
                                                >
                                                    🗑️ Xóa phím tắt
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ==================== RIGHT SIDEBAR ==================== --}}
            <div class="cl-qr-sidebar-wrap">
                {{-- Box 1: Phím tắt nhanh --}}
                <div class="cl-qr-guide-box">
                    <div class="cl-qr-guide-box-header">
                        <h3 class="cl-qr-guide-box-title">Phím tắt nhanh</h3>
                        <button
                            type="button"
                            wire:click="openResetModal"
                            class="cl-qr-guide-reset-btn"
                            title="Khôi phục lại danh mục phím tắt tiêu chuẩn"
                        >
                            <span>Đặt lại</span>
                            <span>ℹ️</span>
                        </button>
                    </div>

                    <div>
                        <div class="cl-qr-shortcut-row">
                            <span class="cl-qr-kbd-key">/</span>
                            <span class="cl-qr-shortcut-label">Mở danh sách phím tắt</span>
                        </div>
                        <div class="cl-qr-shortcut-row">
                            <span class="cl-qr-kbd-key">↑ / ↓</span>
                            <span class="cl-qr-shortcut-label">Chọn mẫu tin</span>
                        </div>
                        <div class="cl-qr-shortcut-row">
                            <span class="cl-qr-kbd-key">↵ Enter</span>
                            <span class="cl-qr-shortcut-label">Chèn vào ô chat</span>
                        </div>
                        <div class="cl-qr-shortcut-row">
                            <span class="cl-qr-kbd-key">Esc</span>
                            <span class="cl-qr-shortcut-label">Đóng danh sách</span>
                        </div>
                        <div class="cl-qr-shortcut-row">
                            <span class="cl-qr-kbd-key">Ctrl + K</span>
                            <span class="cl-qr-shortcut-label">Tìm kiếm hội thoại</span>
                        </div>
                        <div class="cl-qr-shortcut-row">
                            <span class="cl-qr-kbd-key">Ctrl + Enter</span>
                            <span class="cl-qr-shortcut-label">Gửi tin nhắn</span>
                        </div>
                        <div class="cl-qr-shortcut-row">
                            <span class="cl-qr-kbd-key">Alt + M</span>
                            <span class="cl-qr-shortcut-label">Mở phím tắt</span>
                        </div>
                    </div>
                </div>

                {{-- Box 2: Mẹo sử dụng --}}
                <div class="cl-qr-tips-box">
                    <h4 class="cl-qr-tips-title">
                        <span>💡</span>
                        <span>Mẹo sử dụng</span>
                    </h4>

                    <ul class="cl-qr-tips-list">
                        <li>• Nhập <strong>/</strong> để xem danh sách phím tắt.</li>
                        <li>• Nhấn <strong>↑ ↓</strong> để chọn nhanh.</li>
                        <li>• Nhấn <strong>Enter</strong> để chèn vào ô chat.</li>
                        <li>• Không tự động gửi, bạn cần nhấn <strong>Gửi</strong>.</li>
                    </ul>

                    {{-- Mini Interactive Mockup --}}
                    <div class="cl-qr-tips-mockup">
                        <span class="cl-qr-tips-mockup-tag">/hello</span>
                        <div class="cl-qr-tips-send-icon">
                            ✈️
                        </div>
                    </div>

                    <div class="cl-qr-tips-caption">
                        Gõ / và chọn mẫu tin bạn muốn
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== MODALS ==================== --}}
        {{-- Modal Thêm mới / Sửa --}}
        @if($showModal)
            <div class="cl-qr-modal-backdrop" wire:click.self="$set('showModal', false)">
                <div class="cl-qr-modal-card">
                    <div style="height: 4px; width: 100%; background: #ff5400;"></div>
                    <div style="padding: 18px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">
                            {{ $isEditing ? '✏️ Chỉnh sửa mẫu tin nhắn' : '⚡ Thêm mới mẫu tin nhắn' }}
                        </h3>
                        <button
                            type="button"
                            wire:click="$set('showModal', false)"
                            style="border: none; background: transparent; font-size: 20px; color: #94a3b8; cursor: pointer;"
                        >&times;</button>
                    </div>

                    <form wire:submit="save" style="padding: 20px 24px;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                            {{-- Title --}}
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                    Tên mẫu tin nhắn <span style="color: #ef4444;">*</span>
                                </label>
                                <input
                                    type="text"
                                    wire:model="replyTitle"
                                    placeholder="Ví dụ: Chào hỏi khách hàng"
                                    style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; box-sizing: border-box;"
                                />
                                @error('replyTitle') <span style="color: #ef4444; font-size: 11px;">{{ $message }}</span> @enderror
                            </div>

                            {{-- Shortcut --}}
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                    Phím tắt gọi nhanh <span style="color: #ef4444;">*</span>
                                </label>
                                <input
                                    type="text"
                                    wire:model="shortcut"
                                    placeholder="Ví dụ: /hello"
                                    style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; font-family: monospace; font-weight: 700; color: #0284c7; outline: none; box-sizing: border-box;"
                                />
                                @error('shortcut') <span style="color: #ef4444; font-size: 11px;">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                            {{-- Category --}}
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                    Danh mục <span style="color: #ef4444;">*</span>
                                </label>
                                <select
                                    wire:model="category"
                                    style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; box-sizing: border-box; background: #ffffff;"
                                >
                                    <option value="Chào hỏi">Chào hỏi</option>
                                    <option value="Tư vấn dịch vụ">Tư vấn dịch vụ</option>
                                    <option value="Báo giá">Báo giá</option>
                                    <option value="CSKH">CSKH</option>
                                    <option value="Khác">Khác</option>
                                </select>
                                @error('category') <span style="color: #ef4444; font-size: 11px;">{{ $message }}</span> @enderror
                            </div>

                            {{-- Description --}}
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                    Ghi chú mô tả
                                </label>
                                <input
                                    type="text"
                                    wire:model="description"
                                    placeholder="Mô tả mục đích sử dụng..."
                                    style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; box-sizing: border-box;"
                                />
                            </div>
                        </div>

                        {{-- Content --}}
                        <div style="margin-bottom: 14px;">
                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                Nội dung tin nhắn <span style="color: #ef4444;">*</span>
                            </label>
                            <textarea
                                wire:model="content"
                                rows="5"
                                placeholder="Nhập nội dung tin nhắn mẫu..."
                                style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; line-height: 1.5; outline: none; box-sizing: border-box; font-family: inherit;"
                            ></textarea>
                            @error('content') <span style="color: #ef4444; font-size: 11px;">{{ $message }}</span> @enderror
                        </div>

                        {{-- Active status --}}
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 20px;">
                            <input
                                type="checkbox"
                                id="qr-modal-active"
                                wire:model="is_active"
                                style="width: 16px; height: 16px; cursor: pointer;"
                            />
                            <label for="qr-modal-active" style="font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                                Kích hoạt và cho phép sử dụng ngay
                            </label>
                        </div>

                        {{-- Buttons --}}
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                            <button
                                type="button"
                                wire:click="$set('showModal', false)"
                                style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #64748b; font-weight: 600; font-size: 12.5px; cursor: pointer;"
                            >
                                Hủy bỏ
                            </button>
                            <button
                                type="submit"
                                style="padding: 8px 20px; border-radius: 8px; border: none; background: #ff5400; color: #ffffff; font-weight: 700; font-size: 13px; cursor: pointer; box-shadow: 0 2px 8px rgba(255,84,0,0.3);"
                            >
                                {{ $isEditing ? 'Lưu thay đổi' : 'Thêm mẫu tin' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        {{-- Modal Hướng dẫn sử dụng --}}
        @if($showGuideModal)
            <div class="cl-qr-modal-backdrop" wire:click.self="closeGuideModal">
                <div class="cl-qr-modal-card">
                    <div style="height: 4px; width: 100%; background: #0284c7;"></div>
                    <div style="padding: 18px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span>📖</span> Hướng Dẫn Sử Dụng Phím Tắt & Mẫu Tin
                        </h3>
                        <button
                            type="button"
                            wire:click="closeGuideModal"
                            style="border: none; background: transparent; font-size: 20px; color: #94a3b8; cursor: pointer;"
                        >&times;</button>
                    </div>

                    <div style="padding: 22px 24px; font-size: 13.5px; line-height: 1.6; color: #334155;">
                        <div style="margin-bottom: 16px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">1. Cách gọi mẫu tin trong Hộp thư trực tuyến:</h4>
                            <p style="margin: 0; color: #64748b;">
                                Tại ô nhập tin nhắn phản hồi, gõ ký tự <code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-weight: 700; color: #0284c7;">/</code> kèm từ khóa (ví dụ: <code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-family: monospace;">/website</code>, <code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-family: monospace;">/gia</code>). Menu gợi ý thông minh sẽ tự động xuất hiện.
                            </p>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">2. Phím điều hướng nhanh:</h4>
                            <p style="margin: 0; color: #64748b;">
                                Dùng phím mũi tên <strong>↑</strong> hoặc <strong>↓</strong> để di chuyển lựa chọn, nhấn <strong>Enter</strong> để chèn nội dung vào khung soạn thảo. Nhấn <strong>Esc</strong> để đóng menu.
                            </p>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">3. Tính năng an toàn:</h4>
                            <p style="margin: 0; color: #64748b;">
                                Mẫu tin khi chèn sẽ <strong>không tự động gửi ngay</strong>, cho phép nhân viên kiểm tra, cá nhân hóa tên khách hàng hoặc bổ sung thông tin trước khi nhấn <strong>Gửi (Enter)</strong>.
                            </p>
                        </div>

                        <div style="text-align: right; margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 14px;">
                            <button
                                type="button"
                                wire:click="closeGuideModal"
                                style="padding: 8px 20px; border-radius: 8px; border: none; background: #0284c7; color: #ffffff; font-weight: 700; font-size: 13px; cursor: pointer;"
                            >
                                Đã hiểu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Modal Khôi phục mặc định --}}
        @if($showResetModal)
            <div class="cl-qr-modal-backdrop" wire:click.self="$set('showResetModal', false)">
                <div class="cl-qr-modal-card" style="max-width: 460px; padding: 24px; text-align: center;">
                    <div style="font-size: 40px; margin-bottom: 10px;">↻</div>
                    <h3 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0;">
                        Đặt lại danh mục phím tắt tiêu chuẩn?
                    </h3>
                    <p style="font-size: 13px; color: #64748b; margin: 0 0 20px 0; line-height: 1.5;">
                        Hành động này sẽ khôi phục lại các phím tắt tiêu chuẩn theo cấu hình chuẩn doanh nghiệp của Truyền Thông Cửu Long.
                    </p>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                        <button
                            type="button"
                            wire:click="$set('showResetModal', false)"
                            style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #64748b; font-weight: 600; font-size: 12.5px; cursor: pointer;"
                        >
                            Hủy bỏ
                        </button>
                        <button
                            type="button"
                            wire:click="confirmReset"
                            style="padding: 8px 20px; border-radius: 8px; border: none; background: #ff5400; color: #ffffff; font-weight: 700; font-size: 12.5px; cursor: pointer;"
                        >
                            Xác nhận đặt lại
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
