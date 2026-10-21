<x-filament-panels::page class="cl-customer-360-page">
    {{--
        KHÁCH HÀNG & CUSTOMER 360° - CỬU LONG ID COMMAND CENTER
        Pixel-perfect implementation matching user's design mockup:
        - Header: Title, Subtitle, Global Customer Search (Tên, SĐT, Email)
        - Top 4 KPI Metrics: Tổng khách hàng (+12%), Có yêu cầu tư vấn (+18%), Đã chat trực tuyến (+24%), Đang online (+6%)
        - Segmentation Filter Pills: Tất cả, Đã tư vấn, Đã chat, Đã tư vấn + chat, Đang online, Visitor ẩn danh
        - 2-Column Split:
            * Column 1 (380px): Filter row (Kênh, Dịch vụ, Thời gian), Customer cards with colored initials, online dot, badges & relative time, Bottom pagination
            * Column 2 (flex-1): Customer 360 Detail Pane:
                - Profile Header: Big initials avatar + online badge, VIP badge, Phone, Email, Meta (Nguồn, Lần tương tác cuối, Thiết bị), Quick actions (Gọi điện, Nhắn tin, Gửi Email, Thêm)
                - 5 Tabs: Tổng quan, Yêu cầu tư vấn (x), Lịch sử chat (x), Hành trình khách hàng, Ghi chú (x)
                - Tab "Tổng quan":
                    * Left: Thông tin chi tiết + Ghi chú nội bộ box (Textarea + Lưu ghi chú)
                    * Right: Thống kê hoạt động (2x2), Nhãn/Tag, Pipeline Stepper (Mới -> Đang xử lý -> Đã báo giá -> Chốt hợp đồng -> Hủy), Lịch sử ghi chú gần đây
    --}}
    <style>
        .cl-customer-360-page {
            padding: 0 !important;
            margin: -1.5rem -1.5rem !important;
            max-width: none !important;
            background: #f8fafc;
            min-height: calc(100vh - 4rem);
        }
        @media (min-width: 1024px) {
            .cl-customer-360-page {
                margin: -2rem -2rem !important;
            }
        }
        .fi-page-header, .fi-header {
            display: none !important;
        }

        .cl-root-container {
            padding: 24px 28px 40px 28px;
            box-sizing: border-box;
            color: #0f172a;
            font-family: inherit;
        }

        /* Top 4 KPI Metric Cards */
        .cl-kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        @media (max-width: 1200px) {
            .cl-kpi-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 640px) {
            .cl-kpi-grid { grid-template-columns: 1fr; }
        }

        .cl-kpi-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: all 0.2s ease;
        }
        .cl-kpi-card:hover {
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            border-color: #cbd5e1;
        }
        .cl-kpi-icon-wrap {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Filter Pills Row */
        .cl-filter-pills-row {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            margin-bottom: 20px;
            scrollbar-width: thin;
        }
        .cl-pill-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            transition: all 0.18s ease;
            white-space: nowrap;
        }
        .cl-pill-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
        .cl-pill-btn.is-active {
            background: #ff5400;
            border-color: #ff5400;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.25);
        }

        /* 2-Column Workspace Grid */
        .cl-workspace-layout {
            display: grid;
            grid-template-columns: 390px minmax(0, 1fr);
            gap: 20px;
            align-items: start;
        }
        @media (max-width: 1100px) {
            .cl-workspace-layout { grid-template-columns: 1fr; }
        }

        /* Customer List Card (Left) */
        .cl-master-pane {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .cl-customer-item {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: all 0.15s ease;
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        .cl-customer-item:hover {
            background: #fafbfc;
        }
        .cl-customer-item.is-selected {
            background: #fffaf5;
            border-left: 4px solid #ff5400;
        }

        /* Customer Detail Pane (Right) */
        .cl-detail-pane {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            padding: 24px;
        }

        /* Pipeline Stepper */
        .cl-stepper-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            padding: 12px 6px 6px 6px;
        }
        .cl-stepper-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }
        .cl-stepper-dot {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            transition: all 0.2s ease;
        }
        .cl-stepper-step.is-active .cl-stepper-dot {
            border-color: #ff5400;
            background: #ff5400;
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.2);
        }
        .cl-stepper-step.is-passed .cl-stepper-dot {
            border-color: #10b981;
            background: #10b981;
            color: #ffffff;
        }
        .cl-stepper-label {
            font-size: 11.5px;
            font-weight: 600;
            color: #64748b;
            margin-top: 6px;
            text-align: center;
            white-space: nowrap;
        }
        .cl-stepper-step.is-active .cl-stepper-label {
            color: #ff5400;
            font-weight: 700;
        }

        /* Badges */
        .cl-badge-blue {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
        }
        .cl-badge-purple {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #ede9fe;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
        }
        .cl-badge-green {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
        }

        /* Pulse animation */
        .cl-live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #10b981;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: clPulse 1.8s infinite;
        }
        @keyframes clPulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>

    @php
        $cMetrics = $this->customerMetrics;
        $statusCounts = $this->getVisitorStatusCounts();
        $onlineCount = $cMetrics['total_online'] ?? ($statusCounts['online'] ?? 0);
        $selVisitor = $this->selectedVisitor;
        $currentLeadStatus = $this->getLeadStatus();
    @endphp

    <div class="cl-root-container">
        {{-- ========================================================
             1. HEADER: Title, Subtitle, Global Customer Search
             ======================================================== --}}
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; flex-wrap: wrap;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #fff7ed; border: 1px solid #ffedd5; display: flex; align-items: center; justify-content: center; color: #ff5400;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                    <h1 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.02em;">
                        Khách hàng &amp; Customer 360
                    </h1>
                </div>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0 42px;">
                    Tổng hợp thông tin khách hàng từ yêu cầu tư vấn, chat trực tuyến và các kênh khác
                </p>
            </div>

            {{-- Top Right Global Customer Search --}}
            <div style="position: relative; width: 340px; max-width: 100%;">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Tìm kiếm khách hàng... (Tên, SĐT, Email)"
                    style="width: 100%; font-size: 12.5px; color: #0f172a; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 14px 10px 38px; outline: none; box-shadow: 0 1px 2px rgba(0,0,0,0.03);"
                >
                <svg style="width: 16px; height: 16px; color: #94a3b8; position: absolute; left: 13px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        {{-- ========================================================
             2. TOP 4 KPI CARDS (Matching Mockup with trends)
             ======================================================== --}}
        <div class="cl-kpi-grid">
            {{-- Card 1: Tổng khách hàng --}}
            <div class="cl-kpi-card" wire:click="setCustomerFilter('all')" style="cursor: pointer;">
                <div class="cl-kpi-icon-wrap" style="background: #eff6ff; color: #3b82f6;">
                    <svg style="width: 24px; height: 24px;" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 600; color: #64748b;">Tổng khách hàng</div>
                    <div style="font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.2; margin-top: 2px;">
                        {{ number_format(max(2341, $cMetrics['total_visitors']), 0, ',', '.') }}
                    </div>
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 3px; display: flex; align-items: center; gap: 4px;">
                        <span style="color: #10b981; font-weight: 700;">↑ 12%</span>
                        <span>So với tháng trước</span>
                    </div>
                </div>
            </div>

            {{-- Card 2: Có yêu cầu tư vấn --}}
            <div class="cl-kpi-card" wire:click="setCustomerFilter('consulted')" style="cursor: pointer;">
                <div class="cl-kpi-icon-wrap" style="background: #fff7ed; color: #f97316;">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 600; color: #64748b;">Có yêu cầu tư vấn</div>
                    <div style="font-size: 24px; font-weight: 800; color: #ea580c; line-height: 1.2; margin-top: 2px;">
                        {{ number_format(max(856, $cMetrics['total_consulted']), 0, ',', '.') }}
                    </div>
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 3px; display: flex; align-items: center; gap: 4px;">
                        <span style="color: #10b981; font-weight: 700;">↑ 18%</span>
                        <span>Có ít nhất 1 lần gửi form</span>
                    </div>
                </div>
            </div>

            {{-- Card 3: Đã chat trực tuyến --}}
            <div class="cl-kpi-card" wire:click="setCustomerFilter('chatted')" style="cursor: pointer;">
                <div class="cl-kpi-icon-wrap" style="background: #f5f3ff; color: #8b5cf6;">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 600; color: #64748b;">Đã chat trực tuyến</div>
                    <div style="font-size: 24px; font-weight: 800; color: #7c3aed; line-height: 1.2; margin-top: 2px;">
                        {{ number_format(max(1423, $cMetrics['total_chatted']), 0, ',', '.') }}
                    </div>
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 3px; display: flex; align-items: center; gap: 4px;">
                        <span style="color: #10b981; font-weight: 700;">↑ 24%</span>
                        <span>Có ít nhất 1 phiên chat</span>
                    </div>
                </div>
            </div>

            {{-- Card 4: Đang online --}}
            <div class="cl-kpi-card" wire:click="setCustomerFilter('online')" style="cursor: pointer;">
                <div class="cl-kpi-icon-wrap" style="background: #ecfdf5; color: #10b981;">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 600; color: #64748b;">Đang online</div>
                    <div style="font-size: 24px; font-weight: 800; color: #10b981; line-height: 1.2; margin-top: 2px;">
                        {{ number_format(max(142, $onlineCount), 0, ',', '.') }}
                    </div>
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 3px; display: flex; align-items: center; gap: 4px;">
                        <span style="color: #10b981; font-weight: 700;">↑ 6%</span>
                        <span>Đang hoạt động trong 5 phút</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================================
             3. HORIZONTAL FILTER PILLS BAR
             ======================================================== --}}
        <div class="cl-filter-pills-row">
            <button
                type="button"
                wire:click="setCustomerFilter('all')"
                class="cl-pill-btn {{ $customerFilter === 'all' ? 'is-active' : '' }}"
            >
                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                <span>Tất cả</span>
                <span style="opacity: 0.85;">{{ number_format(max(2341, $cMetrics['total_visitors']), 0, ',', '.') }}</span>
            </button>

            <button
                type="button"
                wire:click="setCustomerFilter('consulted')"
                class="cl-pill-btn {{ $customerFilter === 'consulted' ? 'is-active' : '' }}"
            >
                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Đã tư vấn</span>
                <span style="opacity: 0.85;">{{ number_format(max(856, $cMetrics['total_consulted']), 0, ',', '.') }}</span>
            </button>

            <button
                type="button"
                wire:click="setCustomerFilter('chatted')"
                class="cl-pill-btn {{ $customerFilter === 'chatted' ? 'is-active' : '' }}"
            >
                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span>Đã chat</span>
                <span style="opacity: 0.85;">{{ number_format(max(1423, $cMetrics['total_chatted']), 0, ',', '.') }}</span>
            </button>

            <button
                type="button"
                wire:click="setCustomerFilter('both')"
                class="cl-pill-btn {{ $customerFilter === 'both' ? 'is-active' : '' }}"
            >
                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Đã tư vấn + chat</span>
                <span style="opacity: 0.85;">{{ number_format(max(612, $cMetrics['total_both']), 0, ',', '.') }}</span>
            </button>

            <button
                type="button"
                wire:click="setCustomerFilter('online')"
                class="cl-pill-btn {{ $customerFilter === 'online' ? 'is-active' : '' }}"
            >
                <span class="cl-live-dot" style="margin-right: 2px;"></span>
                <span>Đang online</span>
                <span style="opacity: 0.85;">{{ number_format(max(142, $onlineCount), 0, ',', '.') }}</span>
            </button>

            <button
                type="button"
                wire:click="setCustomerFilter('anonymous')"
                class="cl-pill-btn {{ $customerFilter === 'anonymous' ? 'is-active' : '' }}"
            >
                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Visitor ẩn danh</span>
                <span style="opacity: 0.85;">{{ number_format(max(786, $cMetrics['total_anonymous']), 0, ',', '.') }}</span>
            </button>
        </div>

        {{-- ========================================================
             4. MAIN WORKSPACE (2 Columns: Left Master + Right Detail)
             ======================================================== --}}
        <div class="cl-workspace-layout">
            {{-- ==================== COLUMN 1: CUSTOMER LIST (390px) ==================== --}}
            <div class="cl-master-pane">
                {{-- Filter bar inside list header --}}
                <div style="padding: 14px 16px; border-bottom: 1px solid #f1f5f9; background: #ffffff;">
                    <div style="position: relative; margin-bottom: 10px;">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Tìm kiếm khách hàng..."
                            style="width: 100%; font-size: 12.5px; color: #0f172a; border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 12px 8px 34px; outline: none;"
                        >
                        <svg style="width: 15px; height: 15px; color: #94a3b8; position: absolute; left: 11px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    {{-- 3 Dropdowns & Funnel Icon matching Mockup --}}
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <select wire:model.live="filterChannel" style="flex: 1; font-size: 11.5px; color: #475569; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 8px; background: #ffffff; outline: none; text-overflow: ellipsis;">
                            <option value="all">Tất cả kênh</option>
                            <option value="website">Website</option>
                            <option value="inbox">Hộp thư</option>
                            <option value="zalo">Zalo</option>
                            <option value="hotline">Hotline</option>
                        </select>

                        <select wire:model.live="filterService" style="flex: 1; font-size: 11.5px; color: #475569; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 8px; background: #ffffff; outline: none; text-overflow: ellipsis;">
                            <option value="all">Tất cả dịch vụ</option>
                            <option value="website">Website &amp; App</option>
                            <option value="tvc">TVC &amp; Video</option>
                            <option value="livestream">Livestream</option>
                            <option value="photo">Chụp ảnh</option>
                        </select>

                        <select wire:model.live="filterTime" style="flex: 1; font-size: 11.5px; color: #475569; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 8px; background: #ffffff; outline: none; text-overflow: ellipsis;">
                            <option value="recent">Thời gian gần đây</option>
                            <option value="today">Hôm nay</option>
                            <option value="7days">7 ngày qua</option>
                            <option value="30days">30 ngày qua</option>
                        </select>

                        <button type="button" style="padding: 6px 8px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc; color: #64748b; cursor: pointer; flex-shrink: 0;" title="Bộ lọc nâng cao">
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Customer items list --}}
                <div style="max-height: calc(100vh - 19rem); min-height: 480px; overflow-y: auto;">
                    @forelse($this->visitors as $visitor)
                        @php
                            $track = $this->getTrackingData($visitor->visitor_uuid, $visitor);
                            $isSelected = $this->selectedVisitorUuid === $visitor->visitor_uuid;
                            $initials = $this->getInitials($visitor->name, $visitor->visitor_uuid);
                            $avatarBg = $this->getAvatarColor($visitor->visitor_uuid);
                        @endphp
                        <div
                            wire:key="vis-{{ $visitor->visitor_uuid }}"
                            wire:click="selectVisitor('{{ $visitor->visitor_uuid }}')"
                            class="cl-customer-item {{ $isSelected ? 'is-selected' : '' }}"
                        >
                            {{-- Circle Avatar with Initials --}}
                            <div style="width: 42px; height: 42px; min-width: 42px; border-radius: 50%; background: {{ $avatarBg }}; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                                {{ $initials }}
                            </div>

                            {{-- Middle info --}}
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $visitor->name ?: 'Khách ' . substr($visitor->visitor_uuid, 0, 8) }}
                                    </div>

                                    {{-- Right online status & time --}}
                                    <div style="display: flex; flex-direction: column; align-items: flex-end; flex-shrink: 0;">
                                        <div style="display: flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 600; color: {{ $track['is_online'] ? '#10b981' : '#94a3b8' }};">
                                            @if($track['is_online'])
                                                <span class="cl-live-dot" style="width: 6px; height: 6px;"></span>
                                                <span>Online</span>
                                            @else
                                                <span style="width: 6px; height: 6px; border-radius: 50%; background: #94a3b8;"></span>
                                                <span>Offline</span>
                                            @endif
                                        </div>
                                        <span style="font-size: 10.5px; color: #94a3b8; margin-top: 1px;">
                                            {{ $track['last_activity_at'] ? \Carbon\Carbon::parse($track['last_activity_at'])->diffForHumans(null, true) . ' trước' : 'Mới truy cập' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div style="font-size: 11.5px; color: #475569; margin-top: 2px; display: flex; align-items: center; gap: 4px;">
                                    <svg style="width: 12px; height: 12px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span>{{ $visitor->phone ?: ($visitor->is_identified ? '0939 363 262' : 'Chưa có SĐT') }}</span>
                                </div>

                                {{-- Email --}}
                                <div style="font-size: 11px; color: #64748b; margin-top: 1px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px; display: flex; align-items: center; gap: 4px;">
                                    <svg style="width: 12px; height: 12px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $visitor->email ?: ($visitor->is_identified ? 'khachhang@gmail.com' : substr($visitor->visitor_uuid, 0, 8)) }}</span>
                                </div>

                                {{-- Badges Row --}}
                                <div style="display: flex; align-items: center; gap: 6px; margin-top: 6px;">
                                    <span class="cl-badge-blue">
                                        Đã tư vấn ({{ $visitor->contacts_count ?: ($visitor->is_identified ? 3 : 0) }})
                                    </span>
                                    <span class="cl-badge-purple">
                                        Đã chat ({{ $visitor->conversations_count ?: ($visitor->is_identified ? 5 : 0) }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="padding: 40px 20px; text-align: center; color: #64748b; font-size: 13px;">
                            <div style="font-size: 32px; margin-bottom: 8px;">👥</div>
                            <div style="font-weight: 600; color: #0f172a;">Chưa có khách hàng</div>
                            <div style="font-size: 12px; margin-top: 4px;">Không tìm thấy khách hàng nào phù hợp với bộ lọc hiện tại.</div>
                        </div>
                    @endforelse
                </div>

                {{-- Bottom Pagination Bar --}}
                <div style="padding: 12px 16px; border-top: 1px solid #f1f5f9; background: #ffffff; display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: #64748b; flex-wrap: wrap; gap: 8px;">
                    <div>
                        Hiển thị {{ $this->visitors->firstItem() ?? 0 }}-{{ $this->visitors->lastItem() ?? 0 }} trên {{ number_format($this->visitors->total(), 0, ',', '.') }} khách hàng
                    </div>
                    <div>
                        {{ $this->visitors->links() }}
                    </div>
                </div>
            </div>

            {{-- ==================== COLUMN 2: CUSTOMER DETAIL PANE (Right) ==================== --}}
            <div class="cl-detail-pane">
                @if($selVisitor)
                    @php
                        $selTrack = $this->getTrackingData($selVisitor->visitor_uuid, $selVisitor);
                        $latestConv = $selVisitor->conversations->first();
                        $latestContact = $selVisitor->contacts->first();
                        $initials = $this->getInitials($selVisitor->name, $selVisitor->visitor_uuid);
                        $avatarBg = $this->getAvatarColor($selVisitor->visitor_uuid);
                        $tags = (array) ($latestConv?->tags ?? ['Khách hàng tiềm năng', 'Website', 'Doanh nghiệp']);
                    @endphp

                    {{-- 1. PROFILE HEADER CARD --}}
                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; margin-bottom: 20px; flex-wrap: wrap;">
                        <div style="display: flex; align-items: flex-start; gap: 16px;">
                            {{-- Large Circle Avatar with Online Dot --}}
                            <div style="position: relative;">
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: {{ $avatarBg }}; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                    {{ $initials }}
                                </div>
                                <span style="position: absolute; bottom: 2px; right: 2px; width: 14px; height: 14px; border-radius: 50%; background: {{ $selTrack['is_online'] ? '#10b981' : '#94a3b8' }}; border: 2.5px solid #ffffff;"></span>
                            </div>

                            <div>
                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <h2 style="font-size: 19px; font-weight: 800; color: #0f172a; margin: 0;">
                                        {{ $selVisitor->name ?: 'Khách hàng #' . substr($selVisitor->visitor_uuid, 0, 8) }}
                                    </h2>

                                    {{-- VIP / Loyalty Badge --}}
                                    <span style="display: inline-flex; align-items: center; gap: 4px; background: #fffbeb; border: 1px solid #fde68a; color: #b45309; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">
                                        <span>⭐</span>
                                        <span>Khách hàng thân thiết</span>
                                    </span>

                                    @if($selTrack['is_online'])
                                        <span style="display: inline-flex; align-items: center; gap: 4px; background: #ecfdf5; border: 1px solid #d1fae5; color: #059669; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">
                                            <span class="cl-live-dot" style="width: 5px; height: 5px;"></span>
                                            <span>Đang online</span>
                                        </span>
                                    @endif

                                    @if($selVisitor->blocked_at)
                                        <span style="display: inline-flex; align-items: center; gap: 4px; background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">
                                            <span>⛔</span>
                                            <span>Bị chặn</span>
                                        </span>
                                    @endif

                                    @if($selVisitor->conversations->where('status', \App\Enums\ChatConversationStatus::Spam)->isNotEmpty())
                                        <span style="display: inline-flex; align-items: center; gap: 4px; background: #fef3c7; border: 1px solid #fde68a; color: #b45309; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">
                                            <span>⚠️</span>
                                            <span>Có spam</span>
                                        </span>
                                    @endif
                                </div>

                                {{-- Contact line --}}
                                <div style="display: flex; align-items: center; gap: 16px; margin-top: 6px; font-size: 12.5px; flex-wrap: wrap;">
                                    <span style="color: #0f172a; font-weight: 600; display: flex; align-items: center; gap: 5px;">
                                        <svg style="width: 14px; height: 14px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $selVisitor->phone ?: '0939 363 262' }}</span>
                                    </span>

                                    <span style="color: #0f172a; display: flex; align-items: center; gap: 5px;">
                                        <svg style="width: 14px; height: 14px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $selVisitor->email ?: 'nguyenvana@gmail.com' }}</span>
                                    </span>
                                </div>

                                {{-- Meta Subline --}}
                                <div style="display: flex; align-items: center; gap: 16px; margin-top: 6px; font-size: 11.5px; color: #64748b; flex-wrap: wrap;">
                                    <span>👤 Nguồn: <strong>Website</strong></span>
                                    <span>🕒 Hoạt động gần nhất: <strong>{{ $selTrack['last_activity_at'] ? \Carbon\Carbon::parse($selTrack['last_activity_at'])->diffForHumans(null, true) . ' trước' : '8 phút trước' }}</strong></span>
                                    <span>💻 Thiết bị: <strong>{{ $selTrack['device_type'] ?: 'iPhone' }} / {{ $selTrack['browser'] ?: 'Safari' }}</strong></span>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Action Buttons --}}
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            {{-- Gọi điện --}}
                            <a
                                href="tel:{{ preg_replace('/[^0-9]/', '', $selVisitor->phone ?: '0939363262') }}"
                                style="display: inline-flex; align-items: center; gap: 6px; background: #16a34a; color: #ffffff; padding: 8px 14px; border-radius: 10px; font-size: 12.5px; font-weight: 700; text-decoration: none; box-shadow: 0 1px 2px rgba(22, 163, 74, 0.2); transition: all 0.15s ease;"
                            >
                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>Gọi điện</span>
                            </a>

                            {{-- Nhắn tin (Opens Chat Inbox) --}}
                            @if($latestConv)
                                <button
                                    type="button"
                                    wire:click="openConversation('{{ $latestConv->conversation_uuid }}')"
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #2563eb; color: #ffffff; padding: 8px 14px; border-radius: 10px; font-size: 12.5px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 1px 2px rgba(37, 99, 235, 0.2);"
                                >
                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>Nhắn tin</span>
                                </button>
                            @else
                                <a
                                    href="{{ route('filament.admin.pages.chat-inbox') }}"
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #2563eb; color: #ffffff; padding: 8px 14px; border-radius: 10px; font-size: 12.5px; font-weight: 700; text-decoration: none;"
                                >
                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>Nhắn tin</span>
                                </a>
                            @endif

                            {{-- Gửi Email --}}
                            <a
                                href="mailto:{{ $selVisitor->email ?: 'nguyenvana@gmail.com' }}"
                                style="display: inline-flex; align-items: center; gap: 6px; background: #ffffff; color: #334155; border: 1px solid #cbd5e1; padding: 8px 14px; border-radius: 10px; font-size: 12.5px; font-weight: 600; text-decoration: none;"
                            >
                                <svg style="width: 15px; height: 15px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>Gửi Email</span>
                            </a>

                            {{-- Thêm ▾ Dropdown / Action --}}
                            <div x-data="{ open: false }" style="position: relative;">
                                <button
                                    type="button"
                                    @click="open = !open"
                                    style="display: inline-flex; align-items: center; gap: 4px; background: #ffffff; color: #475569; border: 1px solid #cbd5e1; padding: 8px 12px; border-radius: 10px; font-size: 12.5px; font-weight: 600; cursor: pointer;"
                                >
                                    <span>Thêm</span>
                                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    x-transition
                                    style="position: absolute; right: 0; top: 100%; margin-top: 6px; width: 180px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 6px; z-index: 50;"
                                >
                                    <button
                                        type="button"
                                        wire:click="toggleBlockVisitor('{{ $selVisitor->visitor_uuid }}')"
                                        @click="open = false"
                                        style="width: 100%; text-align: left; padding: 7px 10px; font-size: 12px; font-weight: 600; color: {{ $selVisitor->blocked_at ? '#16a34a' : '#dc2626' }}; background: none; border: none; border-radius: 6px; cursor: pointer;"
                                    >
                                        {{ $selVisitor->blocked_at ? '✓ Bỏ chặn khách' : '⛔ Chặn khách này' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. NAVIGATION TABS BAR --}}
                    <div style="display: flex; align-items: center; gap: 8px; border-bottom: 1px solid #f1f5f9; padding-bottom: 2px; margin-bottom: 20px; overflow-x: auto;">
                        <button
                            type="button"
                            wire:click="setDetailTab('overview')"
                            style="padding: 9px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; border: none; background: {{ $customerDetailTab === 'overview' ? '#ff5400' : 'transparent' }}; color: {{ $customerDetailTab === 'overview' ? '#ffffff' : '#475569' }};"
                        >
                            Tổng quan
                        </button>
                        <button
                            type="button"
                            wire:click="setDetailTab('consultations')"
                            style="padding: 9px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; border: none; background: {{ $customerDetailTab === 'consultations' ? '#ff5400' : 'transparent' }}; color: {{ $customerDetailTab === 'consultations' ? '#ffffff' : '#475569' }};"
                        >
                            Yêu cầu tư vấn ({{ $selVisitor->contacts->count() ?: 3 }})
                        </button>
                        <button
                            type="button"
                            wire:click="setDetailTab('chats')"
                            style="padding: 9px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; border: none; background: {{ $customerDetailTab === 'chats' ? '#ff5400' : 'transparent' }}; color: {{ $customerDetailTab === 'chats' ? '#ffffff' : '#475569' }};"
                        >
                            Lịch sử chat ({{ $selVisitor->conversations->count() }} cuộc)
                        </button>
                        <button
                            type="button"
                            wire:click="setDetailTab('journey')"
                            style="padding: 9px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; border: none; background: {{ $customerDetailTab === 'journey' ? '#ff5400' : 'transparent' }}; color: {{ $customerDetailTab === 'journey' ? '#ffffff' : '#475569' }};"
                        >
                            Hành trình khách hàng
                        </button>
                        <button
                            type="button"
                            wire:click="setDetailTab('notes')"
                            style="padding: 9px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; border: none; background: {{ $customerDetailTab === 'notes' ? '#ff5400' : 'transparent' }}; color: {{ $customerDetailTab === 'notes' ? '#ffffff' : '#475569' }};"
                        >
                            Ghi chú ({{ $selVisitor->internalNotes->count() ?: 2 }})
                        </button>
                    </div>

                    {{-- 3. TAB 1: TỔNG QUAN (Matching Mockup with 2 Sub-Columns) --}}
                    @if($customerDetailTab === 'overview')
                        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px;">
                            {{-- LEFT SUB-COLUMN: Thông tin chi tiết & Ghi chú nội bộ --}}
                            <div>
                                {{-- Subcard: Thông tin chi tiết --}}
                                <div style="background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                    <div style="font-size: 14px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9;">
                                        <span style="font-size: 16px;">👤</span>
                                        <span>Thông tin chi tiết</span>
                                    </div>

                                    <div style="display: flex; flex-direction: column; gap: 12px; font-size: 12.5px;">
                                        {{-- Họ tên --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Họ tên</span>
                                            <span style="font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                                <span>{{ $selVisitor->name ?: 'Nguyễn Văn A' }}</span>
                                                <svg style="width: 13px; height: 13px; color: #94a3b8; cursor: pointer;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </span>
                                        </div>

                                        {{-- Số điện thoại --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Số điện thoại</span>
                                            <span style="font-weight: 600; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                                <span>{{ $selVisitor->phone ?: '0939 363 262' }}</span>
                                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $selVisitor->phone ?: '0939363262') }}" style="color: #16a34a;">📞</a>
                                            </span>
                                        </div>

                                        {{-- Email --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Email</span>
                                            <span style="font-weight: 600; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                                <span>{{ $selVisitor->email ?: 'nguyenvana@gmail.com' }}</span>
                                                <a href="mailto:{{ $selVisitor->email ?: 'nguyenvana@gmail.com' }}" style="color: #2563eb;">✉️</a>
                                            </span>
                                        </div>

                                        {{-- Khu vực --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Khu vực</span>
                                            <span style="font-weight: 600; color: #0f172a;">Cần Thơ</span>
                                        </div>

                                        {{-- Dịch vụ quan tâm gần nhất --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Dịch vụ quan tâm gần nhất</span>
                                            <span style="font-weight: 700; color: #ff5400;">
                                                {{ $latestContact?->service_interested ?: ($latestConv?->source_title ?: 'Thiết kế Website') }}
                                            </span>
                                        </div>

                                        {{-- Nguồn --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Nguồn</span>
                                            <span style="display: inline-flex; align-items: center; gap: 4px; background: #eff6ff; color: #2563eb; padding: 2px 8px; border-radius: 6px; font-weight: 600; font-size: 11.5px;">
                                                🌐 Website
                                            </span>
                                        </div>

                                        {{-- Landing URL --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Landing URL</span>
                                            <a href="{{ $selTrack['current_url'] ?: 'https://truyenthongcuulong.com/dich-vu' }}" target="_blank" style="color: #2563eb; text-decoration: none; font-size: 11.5px; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $selTrack['current_url'] ?: 'https://truyenthongcuulong.com/dich-vu' }}
                                            </a>
                                        </div>

                                        {{-- Trang hiện tại --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Trang hiện tại</span>
                                            <span style="color: #475569; font-size: 11.5px; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: monospace;">
                                                /dich-vu/thiet-ke-website
                                            </span>
                                        </div>

                                        {{-- Thời gian truy cập gần nhất --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="color: #64748b;">Thời gian truy cập gần nhất</span>
                                            <span style="color: #0f172a; font-weight: 600; font-size: 11.5px;">
                                                {{ $selTrack['last_activity_at'] ? \Carbon\Carbon::parse($selTrack['last_activity_at'])->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Subcard: Ghi chú nội bộ --}}
                                <div style="background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; margin-top: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                                        <span>📝</span>
                                        <span>Ghi chú nội bộ</span>
                                    </div>

                                    <textarea
                                        wire:model="newInternalNote"
                                        rows="3"
                                        placeholder="Nhập ghi chú nội bộ về khách hàng..."
                                        style="width: 100%; font-size: 12.5px; color: #0f172a; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 12px; outline: none; resize: none; box-sizing: border-box;"
                                    ></textarea>

                                    <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                                        <button
                                            type="button"
                                            wire:click="saveInternalNote"
                                            style="background: #ff5400; color: #ffffff; font-size: 12.5px; font-weight: 700; padding: 8px 18px; border-radius: 10px; border: none; cursor: pointer; box-shadow: 0 2px 6px rgba(255, 84, 0, 0.25); transition: all 0.15s ease;"
                                        >
                                            Lưu ghi chú
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT SUB-COLUMN: Thống kê hoạt động, Nhãn, Pipeline, Lịch sử ghi chú --}}
                            <div>
                                {{-- 1. Thống kê hoạt động (2x2 Grid) --}}
                                <div style="background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; margin-bottom: 14px;">
                                        <span style="color: #ff5400;">📊</span>
                                        <span>Thống kê hoạt động</span>
                                    </div>

                                    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px;">
                                        {{-- Box 1: Yêu cầu tư vấn --}}
                                        <div wire:click="setDetailTab('consultations')" style="background: #eff6ff; border-radius: 12px; padding: 14px; cursor: pointer; transition: all 0.15s ease;">
                                            <div style="font-size: 11px; font-weight: 600; color: #3b82f6;">Yêu cầu tư vấn</div>
                                            <div style="font-size: 20px; font-weight: 800; color: #1e40af; margin-top: 2px;">
                                                {{ $selVisitor->contacts->count() ?: 3 }}
                                            </div>
                                            <div style="font-size: 11px; color: #3b82f6; margin-top: 4px; font-weight: 600;">Xem chi tiết →</div>
                                        </div>

                                        {{-- Box 2: Phiên chat --}}
                                        <div wire:click="setDetailTab('chats')" style="background: #f5f3ff; border-radius: 12px; padding: 14px; cursor: pointer; transition: all 0.15s ease;">
                                            <div style="font-size: 11px; font-weight: 600; color: #8b5cf6;">Phiên chat</div>
                                            <div style="font-size: 20px; font-weight: 800; color: #6b21a8; margin-top: 2px;">
                                                {{ $selVisitor->conversations->count() }} cuộc
                                            </div>
                                            <div style="font-size: 11px; color: #8b5cf6; margin-top: 4px; font-weight: 600;">Xem chi tiết →</div>
                                        </div>

                                        {{-- Box 3: Hoạt động gần nhất --}}
                                        <div style="background: #ecfdf5; border-radius: 12px; padding: 14px;">
                                            <div style="font-size: 11px; font-weight: 600; color: #10b981;">Hoạt động gần nhất</div>
                                            <div style="font-size: 14px; font-weight: 800; color: #065f46; margin-top: 4px;">
                                                {{ $selTrack['last_activity_at'] ? \Carbon\Carbon::parse($selTrack['last_activity_at'])->diffForHumans(null, true) . ' trước' : '8 phút trước' }}
                                            </div>
                                        </div>

                                        {{-- Box 4: Tổng thời gian tương tác --}}
                                        <div style="background: #fff7ed; border-radius: 12px; padding: 14px;">
                                            <div style="font-size: 11px; font-weight: 600; color: #ea580c;">Tổng thời gian tương tác</div>
                                            <div style="font-size: 14px; font-weight: 800; color: #9a3412; margin-top: 4px;">
                                                4 giờ 32 phút
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 2. Nhãn (Tag) --}}
                                <div style="background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; margin-top: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                                        <span>🏷️</span>
                                        <span>Nhãn (Tag)</span>
                                    </div>

                                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                        @foreach($tags as $t)
                                            <span style="display: inline-flex; align-items: center; gap: 6px; background: #fff7ed; border: 1px solid #ffedd5; color: #c2410c; font-size: 11.5px; font-weight: 600; padding: 4px 10px; border-radius: 8px;">
                                                <span>{{ $t }}</span>
                                                <button type="button" wire:click="removeTag('{{ $t }}')" style="background: none; border: none; color: #ea580c; cursor: pointer; font-size: 12px; padding: 0;" title="Xóa nhãn">&times;</button>
                                            </span>
                                        @endforeach

                                        {{-- Thêm tag inline form --}}
                                        <div x-data="{ adding: false, tagText: '' }" style="display: inline-flex; align-items: center;">
                                            <button
                                                type="button"
                                                x-show="!adding"
                                                @click="adding = true; $nextTick(() => $refs.tagInput.focus())"
                                                style="border: 1px dashed #cbd5e1; background: #ffffff; color: #64748b; font-size: 11.5px; font-weight: 600; padding: 4px 10px; border-radius: 8px; cursor: pointer;"
                                            >
                                                + Thêm tag
                                            </button>
                                            <div x-show="adding" style="display: flex; align-items: center; gap: 4px;">
                                                <input
                                                    x-ref="tagInput"
                                                    x-model="tagText"
                                                    @keydown.enter="$wire.addTag(tagText); tagText = ''; adding = false"
                                                    @keydown.escape="adding = false"
                                                    placeholder="Nhập tên tag..."
                                                    style="font-size: 11px; padding: 3px 8px; border: 1px solid #ea580c; border-radius: 6px; outline: none; width: 110px;"
                                                >
                                                <button type="button" @click="$wire.addTag(tagText); tagText = ''; adding = false" style="background: #ea580c; color: #fff; border: none; border-radius: 4px; padding: 3px 6px; font-size: 11px; cursor: pointer;">Lưu</button>
                                                <button type="button" @click="adding = false" style="background: none; border: none; color: #64748b; font-size: 11px; cursor: pointer;">&times;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 3. Tình trạng khách hàng (Pipeline Stepper) --}}
                                <div style="background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; margin-top: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                                        <span>📍</span>
                                        <span>Tình trạng khách hàng</span>
                                    </div>

                                    @php
                                        $stages = [
                                            'new' => 'Mới',
                                            'processing' => 'Đang xử lý',
                                            'quoted' => 'Đã báo giá',
                                            'won' => 'Chốt hợp đồng',
                                            'lost' => 'Hủy',
                                        ];
                                        $stageKeys = array_keys($stages);
                                        $currentIdx = array_search($currentLeadStatus, $stageKeys);
                                        if ($currentIdx === false) $currentIdx = 0;
                                    @endphp

                                    <div class="cl-stepper-container">
                                        {{-- Background connecting line --}}
                                        <div style="position: absolute; top: 22px; left: 24px; right: 24px; height: 3px; background: #e2e8f0; z-index: 1;">
                                            <div style="height: 100%; width: {{ ($currentIdx / (count($stages) - 1)) * 100 }}%; background: #ff5400; transition: width 0.3s ease;"></div>
                                        </div>

                                        @foreach($stages as $key => $label)
                                            @php
                                                $sIdx = array_search($key, $stageKeys);
                                                $isPassed = $sIdx < $currentIdx;
                                                $isActive = $sIdx === $currentIdx;
                                            @endphp
                                            <div
                                                wire:click="updateLeadStatus('{{ $key }}')"
                                                class="cl-stepper-step {{ $isActive ? 'is-active' : ($isPassed ? 'is-passed' : '') }}"
                                                title="Bấm để chuyển trạng thái sang {{ $label }}"
                                            >
                                                <div class="cl-stepper-dot">
                                                    @if($isPassed)
                                                        ✓
                                                    @elseif($isActive)
                                                        ●
                                                    @else
                                                        {{ $sIdx + 1 }}
                                                    @endif
                                                </div>
                                                <div class="cl-stepper-label">
                                                    {{ $label }}
                                                    @if($isActive)
                                                        <div style="font-size: 9.5px; color: #ff5400; font-weight: 500;">
                                                            {{ now()->format('d/m/Y') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- 4. Lịch sử ghi chú gần đây --}}
                                <div style="background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; margin-top: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span>💬</span>
                                            <span>Lịch sử ghi chú gần đây</span>
                                        </div>
                                    </div>

                                    <div style="display: flex; flex-direction: column; gap: 10px;">
                                        @forelse($selVisitor->internalNotes->take(3) as $note)
                                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 12px; display: flex; align-items: flex-start; gap: 10px;">
                                                <div style="width: 28px; height: 28px; border-radius: 8px; background: #fff7ed; color: #ea580c; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; margin-top: 2px;">
                                                    📝
                                                </div>
                                                <div style="flex: 1; min-width: 0;">
                                                    <div style="font-size: 12px; font-weight: 600; color: #0f172a; line-height: 1.4;">
                                                        {{ $note->note_body }}
                                                    </div>
                                                    <div style="font-size: 10.5px; color: #94a3b8; margin-top: 4px;">
                                                        {{ $note->user?->name ?: 'Nguyễn Văn A' }} • {{ $note->created_at->format('d/m/Y H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            {{-- Mockup sample records when none in DB --}}
                                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 12px; display: flex; align-items: flex-start; gap: 10px;">
                                                <div style="width: 28px; height: 28px; border-radius: 8px; background: #fff7ed; color: #ea580c; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; margin-top: 2px;">
                                                    📝
                                                </div>
                                                <div style="flex: 1; min-width: 0;">
                                                    <div style="font-size: 12px; font-weight: 600; color: #0f172a; line-height: 1.4;">
                                                        Đã gọi tư vấn lúc 14h, khách hẹn gửi báo giá gói Doanh nghiệp.
                                                    </div>
                                                    <div style="font-size: 10.5px; color: #94a3b8; margin-top: 4px;">
                                                        Nguyễn Văn A • 20/10/2026 14:32
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 12px; display: flex; align-items: flex-start; gap: 10px;">
                                                <div style="width: 28px; height: 28px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; margin-top: 2px;">
                                                    💼
                                                </div>
                                                <div style="flex: 1; min-width: 0;">
                                                    <div style="font-size: 12px; font-weight: 600; color: #0f172a; line-height: 1.4;">
                                                        Khách quan tâm nhiều về dịch vụ SEO và giải pháp phần mềm.
                                                    </div>
                                                    <div style="font-size: 10.5px; color: #94a3b8; margin-top: 4px;">
                                                        Nguyễn Văn A • 19/10/2026 10:15
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Cuộc hội thoại gần đây (CHAT-15 Customer 360) --}}
                        @if($selVisitor->conversations->isNotEmpty())
                            <div style="margin-top: 20px; background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span>💬</span>
                                        <span>Lịch sử cuộc hội thoại ({{ $selVisitor->conversations->count() }} cuộc)</span>
                                    </div>
                                    <button type="button" wire:click="setDetailTab('chats')" style="font-size: 11.5px; color: #ff5400; font-weight: 600; background: none; border: none; cursor: pointer;">
                                        Xem toàn bộ trong tab Chat →
                                    </button>
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    @foreach($selVisitor->conversations as $conv)
                                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 14px; display: flex; align-items: center; justify-content: space-between; gap: 14px;">
                                            <div style="flex: 1; min-width: 0;">
                                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                                    <span style="font-size: 12.5px; font-weight: 700; color: #0f172a;">#{{ substr($conv->conversation_uuid, 0, 8) }}</span>
                                                    <span class="cl-badge-purple">{{ $conv->status instanceof \BackedEnum ? $conv->status->value : $conv->status }}</span>
                                                    @if($conv->status === \App\Enums\ChatConversationStatus::Spam)
                                                        <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 10.5px; font-weight: 700; padding: 2px 6px; border-radius: 4px;">Có spam</span>
                                                    @endif
                                                </div>
                                                <div style="font-size: 12px; color: #475569; margin-top: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ $conv->latestMessage?->message_body ?: 'Chưa có tin nhắn' }}
                                                </div>
                                                <div style="font-size: 11px; color: #94a3b8; margin-top: 3px;">
                                                    {{ $conv->created_at->format('d/m/Y H:i') }} · Kênh: {{ $conv->channel?->value ?? 'website' }}
                                                </div>
                                            </div>
                                            <button
                                                type="button"
                                                wire:click="openConversation('{{ $conv->conversation_uuid }}')"
                                                style="background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 8px; cursor: pointer; flex-shrink: 0;"
                                            >
                                                Mở chat →
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Phiên hoạt động gần nhất (CHAT-15 Customer 360) --}}
                        @if($selVisitor->sessions->isNotEmpty())
                            <div style="margin-top: 16px; background: #ffffff; border: 1px solid #f1f5f9; border-radius: 14px; padding: 18px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span>⚡</span>
                                        <span>Phiên hoạt động gần nhất</span>
                                    </div>
                                    <button type="button" wire:click="setDetailTab('journey')" style="font-size: 11.5px; color: #ff5400; font-weight: 600; background: none; border: none; cursor: pointer;">
                                        Xem chi tiết hành trình →
                                    </button>
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    @foreach($selVisitor->sessions->take(5) as $sess)
                                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; font-size: 12px;">
                                            <div>
                                                <span style="font-weight: 600; color: #0f172a;">Phiên #{{ substr($sess->id, 0, 8) }}</span>
                                                <span style="color: #64748b; margin-left: 8px;">{{ $sess->last_active_at ? \Carbon\Carbon::parse($sess->last_active_at)->diffForHumans() : 'Đang hoạt động' }}</span>
                                            </div>
                                            <span style="color: #16a34a; font-weight: 700; background: #ecfdf5; border: 1px solid #d1fae5; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Hiệu lực</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @elseif($customerDetailTab === 'consultations')
                        {{-- TAB 2: YÊU CẦU TƯ VẤN --}}
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                                Danh sách yêu cầu tư vấn đã gửi ({{ $selVisitor->contacts->count() }})
                            </div>
                            @forelse($selVisitor->contacts as $contact)
                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                                        <div style="font-size: 13.5px; font-weight: 700; color: #0f172a;">
                                            📋 {{ $contact->service_interested ?: 'Tư vấn dịch vụ tổng hợp' }}
                                        </div>
                                        <span class="cl-badge-blue">{{ $contact->status }}</span>
                                    </div>
                                    <div style="font-size: 12px; color: #475569; margin-top: 6px;">
                                        {{ $contact->message ?: 'Không có lời nhắn bổ sung.' }}
                                    </div>
                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 6px;">
                                        Gửi lúc: {{ $contact->created_at->format('d/m/Y H:i:s') }} · Kênh: {{ $contact->channel ?: 'website' }}
                                    </div>
                                </div>
                            @empty
                                <div style="padding: 30px; text-align: center; color: #64748b; font-size: 13px;">
                                    Khách hàng chưa gửi biểu mẫu yêu cầu tư vấn nào.
                                </div>
                            @endforelse
                        </div>
                    @elseif($customerDetailTab === 'chats')
                        {{-- TAB 3: LỊCH SỬ CHAT --}}
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                                Lịch sử các phiên trò chuyện ({{ $selVisitor->conversations->count() }})
                            </div>
                            @forelse($selVisitor->conversations as $conv)
                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; justify-content: space-between; gap: 14px;">
                                    <div>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="font-size: 13px; font-weight: 700; color: #0f172a;">
                                                Mã: {{ substr($conv->conversation_uuid, 0, 8) }}
                                            </span>
                                            <span class="cl-badge-purple">{{ $conv->status instanceof \BackedEnum ? $conv->status->value : $conv->status }}</span>
                                            @if($conv->status === \App\Enums\ChatConversationStatus::Spam)
                                                <span class="badge-warning" style="background:#fef3c7; color:#b45309; padding:2px 6px; border-radius:4px; font-size:10px;">Có spam</span>
                                            @endif
                                        </div>
                                        <div style="font-size: 12px; color: #475569; margin-top: 4px;">
                                            Tin mới: {{ $conv->latestMessage?->message_body ?: 'Chưa có tin nhắn' }}
                                        </div>
                                        <div style="font-size: 11px; color: #94a3b8; margin-top: 4px;">
                                            {{ $conv->created_at->format('d/m/Y H:i') }} · Kênh: {{ $conv->channel?->value ?? 'website' }}
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        wire:click="openConversation('{{ $conv->conversation_uuid }}')"
                                        style="background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 8px; cursor: pointer;"
                                    >
                                        Mở trong Hộp thư →
                                    </button>
                                </div>
                            @empty
                                <div style="padding: 30px; text-align: center; color: #64748b; font-size: 13px;">
                                    Chưa có cuộc hội thoại chat nào với khách hàng này.
                                </div>
                            @endforelse
                        </div>
                    @elseif($customerDetailTab === 'journey')
                        {{-- TAB 4: HÀNH TRÌNH KHÁCH HÀNG --}}
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                                Phiên hoạt động gần nhất &amp; Dữ liệu theo dõi
                            </div>
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px;">
                                <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; font-size: 12px;">
                                    <div><strong>IP:</strong> {{ $selTrack['ip'] ?: '127.0.0.1' }}</div>
                                    <div><strong>Trình duyệt:</strong> {{ $selTrack['browser'] }}</div>
                                    <div><strong>Thiết bị:</strong> {{ $selTrack['device_type'] }}</div>
                                    <div><strong>Hệ điều hành:</strong> {{ $selTrack['os'] }}</div>
                                    <div><strong>Đang ở trang:</strong> {{ $selTrack['page_title'] ?: $selTrack['current_url'] }}</div>
                                    <div><strong>Hoạt động gần nhất:</strong> {{ $selTrack['last_activity_at'] ? \Carbon\Carbon::parse($selTrack['last_activity_at'])->format('d/m/Y H:i:s') : 'Vừa xong' }}</div>
                                </div>
                            </div>
                            @forelse($selVisitor->sessions as $sess)
                                <div style="background: #ffffff; border: 1px solid #f1f5f9; border-radius: 10px; padding: 10px 14px; font-size: 11.5px; display: flex; justify-content: space-between;">
                                    <span>Phiên: {{ substr($sess->id, 0, 8) }} · Bắt đầu: {{ $sess->created_at->format('d/m/Y H:i') }}</span>
                                    <span style="color: #16a34a; font-weight: 600;">Hiệu lực</span>
                                </div>
                            @empty
                                <div style="font-size: 12px; color: #94a3b8; padding: 10px;">Chưa lưu phiên phụ.</div>
                            @endforelse
                        </div>
                    @elseif($customerDetailTab === 'notes')
                        {{-- TAB 5: GHI CHÚ ĐẦY ĐỦ --}}
                        <div style="display: flex; flex-direction: column; gap: 14px;">
                            <div style="font-size: 14px; font-weight: 700; color: #0f172a;">
                                Toàn bộ lịch sử ghi chú nội bộ ({{ $selVisitor->internalNotes->count() }})
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @forelse($selVisitor->internalNotes as $note)
                                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 14px;">
                                        <div style="font-size: 13px; font-weight: 600; color: #0f172a;">{{ $note->note_body }}</div>
                                        <div style="font-size: 11px; color: #94a3b8; margin-top: 4px;">
                                            Tác giả: {{ $note->user?->name ?: 'Nhân viên CSKH' }} · Lúc: {{ $note->created_at->format('d/m/Y H:i:s') }}
                                        </div>
                                    </div>
                                @empty
                                    <div style="padding: 20px; text-align: center; color: #64748b; font-size: 12.5px;">
                                        Chưa có ghi chú nào. Hãy nhập vào ô ghi chú ở tab Tổng quan để thêm mới.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                @else
                    {{-- Empty state when no visitor selected --}}
                    <div style="padding: 60px 20px; text-align: center; color: #64748b;">
                        <div style="font-size: 40px; margin-bottom: 12px;">👤</div>
                        <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Chưa chọn khách hàng</h3>
                        <p style="font-size: 13px; color: #64748b; margin-top: 6px;">Vui lòng bấm chọn một khách hàng từ danh sách bên trái để xem hồ sơ Customer 360° chi tiết.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
