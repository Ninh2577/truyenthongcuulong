<x-filament-panels::page class="cl-chat-workspace-page">
    {{--
        CHAT VISITORS & CUSTOMER 360 WORKSPACE - CỬU LONG ID COMMAND CENTER
        Phase 02.4 Realtime Visitor Tracking & Customer 360 Workspace:
        - Header: Breadcrumb, Tab Switcher (Khách truy cập & Khách hàng | Cài đặt chat), Realtime Online/Offline Badges
        - View 1: Customer Workspace & Visitor Monitor (2 Columns: Customer List + Customer Detail 360)
        - View 2: Cài Đặt Chat (5 Configuration Cards)
    --}}
    <style>
        .cl-chat-workspace-page {
            padding: 0 !important;
            margin: -1.5rem -1.5rem !important;
            max-width: none !important;
        }
        @media (min-width: 1024px) {
            .cl-chat-workspace-page {
                margin: -2rem -2rem !important;
            }
        }
        .fi-page-header, .fi-header {
            display: none !important;
        }

        /* Root Page Container */
        .cl-page-wrapper {
            background-color: #f8fafc;
            min-height: calc(100vh - 4.15rem);
            padding: 20px 24px 36px 24px;
            box-sizing: border-box;
            font-family: inherit;
            color: #0f172a;
        }

        /* Header Bar */
        .cl-header-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            color: #64748b;
            margin-bottom: 6px;
            font-weight: 500;
        }
        .cl-header-breadcrumb a {
            color: #64748b;
            text-decoration: none;
        }
        .cl-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 16px;
            flex-wrap: wrap;
        }
        .cl-title-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .cl-title-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid #3b82f6;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .cl-title-text h1 {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }
        .cl-title-text p {
            font-size: 12px;
            color: #64748b;
            margin: 2px 0 0 0;
            font-weight: 450;
        }

        /* Status Pills in Header */
        .cl-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        }
        .cl-status-online {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .cl-status-offline {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .cl-dot-pulse {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #10b981;
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pulse-dot 1.8s infinite;
        }
        .cl-dot-gray {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #94a3b8;
        }
        @keyframes pulse-dot {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6); }
            70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Tab Switcher */
        .cl-tabs-bar {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #e2e8f0;
            padding: 4px;
            border-radius: 12px;
        }
        .cl-tab-btn {
            border: none;
            background: transparent;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-tab-btn.is-active {
            background: #ffffff;
            color: #0f172a;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Save Button for Settings */
        .cl-btn-save {
            background: linear-gradient(135deg, #ff5400 0%, #ff4200 100%);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 8px 18px;
            font-size: 12.5px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(255, 84, 0, 0.28);
            transition: all 0.15s ease;
        }
        .cl-btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.38);
        }

        /* 2-Column Workspace Grid */
        .cl-workspace-grid {
            display: grid;
            grid-template-columns: 380px minmax(0, 1fr);
            gap: 20px;
            align-items: start;
        }
        @media (max-width: 1024px) {
            .cl-workspace-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Panel Box */
        .cl-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Visitor Card Item */
        .cl-visitor-item {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background 0.15s ease;
            position: relative;
        }
        .cl-visitor-item:hover {
            background: #f8fafc;
        }
        .cl-visitor-item.is-selected {
            background: #eff6ff;
            border-left: 3px solid #2563eb;
        }

        /* Badge styles */
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
        }
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
        }
        .badge-info {
            background: #eff6ff;
            color: #1e40af;
            font-size: 10.5px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 6px;
        }
        .badge-secondary {
            background: #f1f5f9;
            color: #475569;
            font-size: 10.5px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 6px;
        }

        /* Form Controls */
        .cl-input-text {
            width: 100%;
            font-size: 12.5px;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 12px;
            background: #ffffff;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.15s ease;
        }
        .cl-input-text:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        select.cl-select {
            font-size: 12px;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 6px 10px;
            background: #ffffff;
            outline: none;
        }

        /* Settings Grid Layouts */
        .cl-grid-top {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .cl-grid-bottom {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
        }
        @media (max-width: 1200px) {
            .cl-grid-top { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .cl-grid-bottom { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .cl-grid-top { grid-template-columns: 1fr; }
        }
        .cl-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 22px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }
        .cl-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .cl-card-header-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .cl-card-header-text h3 {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }
        .cl-card-header-text p {
            font-size: 11.5px;
            color: #64748b;
            margin: 2px 0 0 0;
        }
        .cl-switch {
            position: relative;
            display: inline-block;
            width: 42px;
            height: 22px;
            flex-shrink: 0;
            cursor: pointer;
        }
        .cl-switch input { opacity: 0; width: 0; height: 0; margin: 0; }
        .cl-slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #cbd5e1;
            transition: 0.2s;
            border-radius: 9999px;
        }
        .cl-slider:before {
            position: absolute;
            content: "";
            height: 16px; width: 16px;
            left: 3px; bottom: 3px;
            background-color: white;
            transition: 0.2s;
            border-radius: 50%;
        }
        .cl-switch input:checked + .cl-slider { background-color: #2563eb; }
        .cl-switch input:checked + .cl-slider:before { transform: translateX(20px); }
        .cl-label {
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 5px;
            display: block;
        }
        .cl-textarea {
            width: 100%;
            font-size: 12px;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 12px;
            outline: none;
            box-sizing: border-box;
            resize: vertical;
        }
    </style>

    @php
        $statusCounts = $this->getVisitorStatusCounts();
        $onlineCount = $statusCounts['online'];
        $offlineCount = $statusCounts['offline'];
    @endphp

    <div class="cl-page-wrapper">
        {{-- Breadcrumb Row --}}
        <div class="cl-header-breadcrumb">
            <svg style="width: 14px; height: 14px; color: #2563eb;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <span>Truyền thông & CSKH</span>
            <span style="color: #94a3b8;">›</span>
            <span style="color: #0f172a; font-weight: 600;">{{ $activeWorkspaceTab === 'settings' ? 'Cài đặt chat' : 'Khách hàng & Khách truy cập' }}</span>
        </div>

        {{-- Header Bar (Title, Online/Offline Stats, Tab Switcher, Save Button) --}}
        <div class="cl-header-row">
            <div class="cl-title-group">
                <div class="cl-title-icon">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                </div>
                <div class="cl-title-text">
                    <h1>Khách truy cập & Khách hàng</h1>
                    <p>Theo dõi thời gian thực khách truy cập website và quản lý hồ sơ Customer 360°.</p>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                {{-- Realtime Online / Offline Badges (Section 26 Requirements) --}}
                <div class="cl-status-pill cl-status-online">
                    <span class="cl-dot-pulse"></span>
                    <span>Online {{ $onlineCount }}</span>
                </div>
                <div class="cl-status-pill cl-status-offline">
                    <span class="cl-dot-gray"></span>
                    <span>Offline {{ $offlineCount }}</span>
                </div>

                {{-- Tab Switcher --}}
                <div class="cl-tabs-bar">
                    <button
                        type="button"
                        wire:click="setWorkspaceTab('visitors')"
                        class="cl-tab-btn {{ $activeWorkspaceTab === 'visitors' ? 'is-active' : '' }}"
                    >
                        Khách truy cập
                    </button>
                    <button
                        type="button"
                        wire:click="setWorkspaceTab('settings')"
                        class="cl-tab-btn {{ $activeWorkspaceTab === 'settings' ? 'is-active' : '' }}"
                    >
                        Cài đặt chat
                    </button>
                </div>

                @if($activeWorkspaceTab === 'settings')
                    <button
                        type="button"
                        wire:click="saveSettings"
                        x-on:click="$dispatch('show-save-toast')"
                        class="cl-btn-save"
                    >
                        <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V3"/>
                        </svg>
                        <span>Lưu cài đặt</span>
                    </button>
                @endif
            </div>
        </div>

        {{-- Toast Notification --}}
        <div
            x-data="{ open: false }"
            x-on:show-save-toast.window="open = true; setTimeout(() => open = false, 3500)"
            x-show="open"
            x-transition
            style="position: fixed; top: 24px; right: 28px; background: #0f172a; color: #ffffff; padding: 12px 20px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.25); font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 10px; z-index: 99999;"
        >
            <div style="width: 20px; height: 20px; border-radius: 50%; background: #10b981; color: #fff; display: flex; align-items: center; justify-content: center;">✓</div>
            <span>Đã lưu cài đặt thành công!</span>
        </div>

        {{-- ========================================================
             VIEW 1: VISITOR MONITOR & CUSTOMER 360 WORKSPACE
             ======================================================== --}}
        @if($activeWorkspaceTab === 'visitors')
            <div class="cl-workspace-grid">
                {{-- COLUMN 1: VISITOR LIST (380px) --}}
                <div class="cl-panel">
                    {{-- Search & Filter Controls --}}
                    <div style="padding: 16px; border-bottom: 1px solid #f1f5f9; background: #fafbfc;">
                        <div style="position: relative; margin-bottom: 10px;">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                class="cl-input-text"
                                placeholder="Tìm theo tên, UUID, email, SĐT..."
                                style="padding-left: 32px;"
                            >
                            <svg style="width: 14px; height: 14px; color: #94a3b8; position: absolute; left: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                            <span style="font-size: 11.5px; color: #64748b; font-weight: 500;">Bộ lọc trạng thái:</span>
                            <select wire:model.live="filterStatus" class="cl-select">
                                <option value="all">Tất cả</option>
                                <option value="active">Đang hoạt động</option>
                                <option value="blocked">Bị chặn</option>
                                <option value="open">Đang mở</option>
                                <option value="waiting_agent">Chờ nhân viên</option>
                                <option value="closed">Đã đóng</option>
                                <option value="spam">Spam</option>
                            </select>
                        </div>
                    </div>

                    {{-- Visitor Items List --}}
                    <div style="max-height: calc(100vh - 15rem); overflow-y: auto;">
                        @forelse($this->visitors as $visitor)
                            @php
                                $track = $this->getTrackingData($visitor->visitor_uuid, $visitor);
                                $isSelected = $this->selectedVisitorUuid === $visitor->visitor_uuid;
                                $hasSpam = $visitor->conversations->where('status', \App\Enums\ChatConversationStatus::Spam)->count() > 0;
                            @endphp
                            <div
                                wire:key="visitor-{{ $visitor->visitor_uuid }}"
                                wire:click="selectVisitor('{{ $visitor->visitor_uuid }}')"
                                class="cl-visitor-item {{ $isSelected ? 'is-selected' : '' }}"
                            >
                                <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
                                    <div style="display: flex; align-items: center; gap: 8px; min-width: 0;">
                                        {{-- Online Indicator Dot --}}
                                        @if($track['is_online'])
                                            <span class="cl-dot-pulse" title="Đang online"></span>
                                        @else
                                            <span class="cl-dot-gray" title="Offline"></span>
                                        @endif

                                        <div style="min-width: 0;">
                                            <div style="font-size: 13px; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $visitor->name ?: 'Khách ' . substr($visitor->visitor_uuid, 0, 8) }}
                                            </div>
                                            <div style="font-size: 11px; color: #64748b; font-family: monospace;">
                                                UUID: {{ substr($visitor->visitor_uuid, 0, 8) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 4px; flex-shrink: 0;">
                                        @if($visitor->blocked_at)
                                            <span class="badge-danger">Bị chặn</span>
                                        @endif
                                        @if($hasSpam)
                                            <span class="badge-warning">Có spam</span>
                                        @endif
                                        <span class="badge-secondary">{{ $track['device_type'] }}</span>
                                    </div>
                                </div>

                                {{-- Tracking Summary Row --}}
                                <div style="margin-top: 8px; display: flex; align-items: center; justify-content: space-between; font-size: 11px; color: #64748b;">
                                    <span style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $track['current_url'] }}">
                                        📄 {{ $track['page_title'] ?: $track['current_url'] }}
                                    </span>
                                    <span>
                                        {{ $track['browser'] }} · {{ $track['os'] }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div style="padding: 32px 16px; text-align: center; color: #64748b; font-size: 12.5px;">
                                <div style="font-size: 28px; margin-bottom: 8px;">👥</div>
                                <div>Chưa có khách hàng nào phù hợp với bộ lọc.</div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination Controls --}}
                    @if($this->visitors->hasPages())
                        <div style="padding: 12px 16px; border-top: 1px solid #f1f5f9; background: #fafbfc;">
                            {{ $this->visitors->links() }}
                        </div>
                    @endif
                </div>

                {{-- COLUMN 2: CUSTOMER DETAIL 360 (Flex-1) --}}
                <div class="cl-panel" style="padding: 24px;">
                    @if($this->selectedVisitor)
                        @php
                            $selVisitor = $this->selectedVisitor;
                            $selTrack = $this->getTrackingData($selVisitor->visitor_uuid, $selVisitor);
                            $latestConv = $selVisitor->conversations->first();
                        @endphp
                        {{-- Profile Header --}}
                        <div style="display: flex; align-items: flex-start; justify-content: space-between; padding-bottom: 18px; border-bottom: 1px solid #f1f5f9; margin-bottom: 20px; gap: 16px; flex-wrap: wrap;">
                            <div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0;">
                                        {{ $selVisitor->name ?: 'Khách chưa đặt tên' }}
                                    </h2>
                                    @if($selTrack['is_online'])
                                        <span class="cl-status-pill cl-status-online" style="font-size: 11px; padding: 2px 8px;">Online</span>
                                    @else
                                        <span class="cl-status-pill cl-status-offline" style="font-size: 11px; padding: 2px 8px;">Offline</span>
                                    @endif
                                    @if($selVisitor->blocked_at)
                                        <span class="badge-danger">Bị chặn</span>
                                    @endif
                                </div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 4px; font-family: monospace;">
                                    Visitor ID: {{ $selVisitor->visitor_uuid }}
                                </div>
                                <div style="font-size: 11.5px; color: #64748b; margin-top: 4px;">
                                    Hoạt động gần nhất: {{ $selTrack['last_activity_at'] ? \Carbon\Carbon::parse($selTrack['last_activity_at'])->diffForHumans() : 'Chưa ghi nhận' }}
                                    @if($selTrack['dwell_seconds'] > 0)
                                        · Thời gian trên trang: {{ gmdate("H:i:s", $selTrack['dwell_seconds']) }}
                                    @endif
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; gap: 8px;">
                                {{-- Block / Unblock Button --}}
                                <button
                                    type="button"
                                    wire:click="toggleBlockVisitor('{{ $selVisitor->visitor_uuid }}')"
                                    class="{{ $selVisitor->blocked_at ? 'cl-btn-save' : 'badge-danger' }}"
                                    style="padding: 7px 14px; border-radius: 8px; border: 1px solid currentColor; cursor: pointer; font-size: 12px; font-weight: 700;"
                                >
                                    {{ $selVisitor->blocked_at ? 'Bỏ chặn khách' : 'Chặn khách' }}
                                </button>
                            </div>
                        </div>

                        {{-- Realtime Environment Grid --}}
                        <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; margin-bottom: 24px; background: #f8fafc; padding: 14px; border-radius: 12px; border: 1px solid #e2e8f0;">
                            <div>
                                <span style="font-size: 11px; color: #64748b; font-weight: 600; display: block;">Thiết bị</span>
                                <span style="font-size: 12.5px; font-weight: 700; color: #0f172a;">{{ $selTrack['device_type'] }}</span>
                            </div>
                            <div>
                                <span style="font-size: 11px; color: #64748b; font-weight: 600; display: block;">Trình duyệt</span>
                                <span style="font-size: 12.5px; font-weight: 700; color: #0f172a;">{{ $selTrack['browser'] }} {{ $selTrack['browser_version'] }}</span>
                            </div>
                            <div>
                                <span style="font-size: 11px; color: #64748b; font-weight: 600; display: block;">Hệ điều hành</span>
                                <span style="font-size: 12.5px; font-weight: 700; color: #0f172a;">{{ $selTrack['os'] }} {{ $selTrack['os_version'] }}</span>
                            </div>
                            <div>
                                <span style="font-size: 11px; color: #64748b; font-weight: 600; display: block;">Trang đang xem</span>
                                <span style="font-size: 12px; font-weight: 600; color: #2563eb; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $selTrack['current_url'] }}">
                                    {{ $selTrack['current_url'] }}
                                </span>
                            </div>
                        </div>

                        {{-- SECTION 1: SESSIONS (Phiên hoạt động gần nhất) --}}
                        <div style="margin-bottom: 24px;">
                            <h3 style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                                <svg style="width: 16px; height: 16px; color: #2563eb;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Phiên hoạt động gần nhất
                            </h3>
                            <div style="border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                                    <thead style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; text-align: left; color: #64748b;">
                                        <tr>
                                            <th style="padding: 8px 12px;">Khởi tạo</th>
                                            <th style="padding: 8px 12px;">Hoạt động cuối</th>
                                            <th style="padding: 8px 12px;">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($selVisitor->sessions as $sess)
                                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                                <td style="padding: 8px 12px; color: #334155;">{{ $sess->created_at->format('H:i d/m/Y') }}</td>
                                                <td style="padding: 8px 12px; color: #334155;">{{ $sess->last_active_at ? $sess->last_active_at->format('H:i d/m/Y') : 'Chưa có' }}</td>
                                                <td style="padding: 8px 12px;">
                                                    @if($sess->expires_at && $sess->expires_at > now())
                                                        <span class="cl-status-pill cl-status-online" style="font-size: 10.5px; padding: 1px 6px;">Hiệu lực</span>
                                                    @else
                                                        <span class="cl-status-pill cl-status-offline" style="font-size: 10.5px; padding: 1px 6px;">Hết hạn</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" style="padding: 12px; text-align: center; color: #94a3b8;">Chưa ghi nhận phiên làm việc.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- SECTION 2: CONVERSATIONS (Lịch sử hội thoại) --}}
                        <div style="margin-bottom: 24px;">
                            <h3 style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
                                <span>Lịch sử hội thoại ({{ $selVisitor->conversations->count() }} cuộc)</span>
                            </h3>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @forelse($selVisitor->conversations as $conv)
                                    <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 14px; background: #ffffff; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                                        <div style="min-width: 0;">
                                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                                <span style="font-family: monospace; font-size: 12px; font-weight: 700; color: #0f172a;">
                                                    #{{ substr($conv->conversation_uuid, 0, 8) }}
                                                </span>
                                                <span class="badge-info">{{ $conv->status->value }}</span>
                                                <span class="badge-secondary">{{ $conv->channel->value }}</span>
                                            </div>
                                            <div style="font-size: 12px; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 380px;">
                                                💬 {{ $conv->latestMessage?->message_body ?: 'Chưa có tin nhắn' }}
                                            </div>
                                        </div>
                                        <button
                                            type="button"
                                            wire:click="openConversation('{{ $conv->conversation_uuid }}')"
                                            class="cl-btn-save"
                                            style="padding: 6px 12px; font-size: 11.5px; border-radius: 8px;"
                                        >
                                            Xem cuộc trò chuyện
                                        </button>
                                    </div>
                                @empty
                                    <div style="padding: 16px; border: 1px dashed #cbd5e1; border-radius: 10px; text-align: center; color: #94a3b8; font-size: 12px;">
                                        Khách chưa có cuộc trò chuyện nào.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- SECTION 3: INTERNAL NOTES (Ghi chú nội bộ) --}}
                        <div style="margin-bottom: 24px;">
                            <h3 style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                                <svg style="width: 16px; height: 16px; color: #f59e0b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                Ghi chú nội bộ
                            </h3>

                            {{-- Add Note Form --}}
                            <div style="margin-bottom: 12px; display: flex; gap: 8px;">
                                <input
                                    type="text"
                                    wire:model="newInternalNote"
                                    class="cl-input-text"
                                    placeholder="Thêm ghi chú nghiệp vụ cho khách hàng..."
                                    wire:keydown.enter="addInternalNote"
                                >
                                <button
                                    type="button"
                                    wire:click="addInternalNote"
                                    class="cl-btn-save"
                                    style="padding: 6px 14px; font-size: 12px; flex-shrink: 0;"
                                >
                                    Lưu ghi chú
                                </button>
                            </div>

                            {{-- Notes List --}}
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @php
                                    $allNotes = $selVisitor->conversations->flatMap->internalNotes->sortByDesc('created_at');
                                @endphp
                                @forelse($allNotes as $note)
                                    <div style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px; padding: 10px 12px; font-size: 12px;">
                                        <div style="color: #92400e; font-weight: 500;">{{ $note->note_body }}</div>
                                        <div style="color: #b45309; font-size: 10.5px; margin-top: 4px; display: flex; justify-content: space-between;">
                                            <span>Bởi: {{ $note->user?->name ?: 'Nhân viên' }}</span>
                                            <span>{{ $note->created_at->format('H:i d/m/Y') }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div style="color: #94a3b8; font-size: 11.5px; font-style: italic;">Chưa có ghi chú nội bộ nào.</div>
                                @endforelse
                            </div>
                        </div>

                        {{-- SECTION 4: TAGS (Thẻ phân loại) --}}
                        <div style="padding-top: 14px; border-top: 1px solid #f1f5f9;">
                            <span style="font-size: 11.5px; color: #64748b; font-weight: 600;">Thẻ phân loại:</span>
                            <span style="font-size: 11.5px; color: #94a3b8; margin-left: 6px;">Chưa phân thẻ</span>
                        </div>
                    @else
                        <div style="text-align: center; padding: 80px 20px; color: #64748b;">
                            <div style="font-size: 40px; margin-bottom: 12px;">👆</div>
                            <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Chọn khách hàng để xem chi tiết 360°</h3>
                            <p style="font-size: 12.5px; margin: 0;">Nhấp vào bất kỳ khách truy cập nào từ danh sách bên trái để theo dõi hành trình và lịch sử hội thoại.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- ========================================================
             VIEW 2: CHAT SETTINGS CARDS
             ======================================================== --}}
        @if($activeWorkspaceTab === 'settings')
            {{-- ROW 1: 3 COLUMNS (Cài đặt chung, Kênh chat, Hỗ trợ nhanh) --}}
            <div class="cl-grid-top">
                {{-- CARD 1: Cài đặt chung --}}
                <div class="cl-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-icon">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <div class="cl-card-header-text">
                            <h3>Cài đặt chung</h3>
                            <p>Bật/tắt tính năng chat và cấu hình hiển thị.</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; align-items: flex-start; gap: 14px;">
                            <label class="cl-switch">
                                <input type="checkbox" wire:model.live="enable_live_chat">
                                <span class="cl-slider"></span>
                            </label>
                            <div>
                                <div style="font-size: 13px; font-weight: 700; color: #0f172a;">Bật tính năng chat trực tuyến</div>
                                <div style="font-size: 11.5px; color: #64748b;">Cho phép khách truy cập trò chuyện trực tiếp với nhân viên hỗ trợ.</div>
                            </div>
                        </div>
                        <div>
                            <label class="cl-label">Hiển thị cửa sổ chat</label>
                            <select wire:model.live="window_position" class="cl-select" style="width: 100%;">
                                <option value="bottom_right">Góc phải dưới cùng</option>
                                <option value="bottom_left">Góc trái dưới cùng</option>
                            </select>
                        </div>
                        <div style="display: flex; align-items: flex-start; gap: 14px;">
                            <label class="cl-switch">
                                <input type="checkbox" wire:model.live="enable_notifications">
                                <span class="cl-slider"></span>
                            </label>
                            <div>
                                <div style="font-size: 13px; font-weight: 700; color: #0f172a;">Thông báo khi có tin nhắn mới</div>
                                <div style="font-size: 11.5px; color: #64748b;">Hiển thị thông báo trên thanh tiêu đề và âm thanh.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: Kênh chat --}}
                <div class="cl-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-icon">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        </div>
                        <div class="cl-card-header-text">
                            <h3>Kênh chat</h3>
                            <p>Kết nối các kênh hỗ trợ khách hàng.</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-size: 13px; font-weight: 600;">Chat trực tiếp (Website)</span>
                            <label class="cl-switch"><input type="checkbox" wire:model.live="channel_website"><span class="cl-slider"></span></label>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-size: 13px; font-weight: 600;">Zalo</span>
                            <label class="cl-switch"><input type="checkbox" wire:model.live="channel_zalo"><span class="cl-slider"></span></label>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-size: 13px; font-weight: 600;">Facebook Messenger</span>
                            <label class="cl-switch"><input type="checkbox" wire:model.live="channel_messenger"><span class="cl-slider"></span></label>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-size: 13px; font-weight: 600;">Hotline</span>
                            <label class="cl-switch"><input type="checkbox" wire:model.live="channel_hotline"><span class="cl-slider"></span></label>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-size: 13px; font-weight: 600;">Email</span>
                            <label class="cl-switch"><input type="checkbox" wire:model.live="channel_email"><span class="cl-slider"></span></label>
                        </div>
                    </div>
                </div>

                {{-- CARD 3: Thông tin hỗ trợ nhanh --}}
                <div class="cl-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-icon">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div class="cl-card-header-text">
                            <h3>Thông tin hỗ trợ nhanh</h3>
                            <p>Hiển thị thông tin liên hệ trên cửa sổ chat.</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div>
                            <label class="cl-label">Số điện thoại</label>
                            <input type="text" wire:model.live="support_phone" class="cl-input-text" placeholder="0939 123 456">
                        </div>
                        <div>
                            <label class="cl-label">Email</label>
                            <input type="email" wire:model.live="support_email" class="cl-input-text" placeholder="minhthuan@gmail.com">
                        </div>
                        <div>
                            <label class="cl-label">Thời gian làm việc</label>
                            <select wire:model.live="support_hours" class="cl-select" style="width: 100%;">
                                <option value="Thứ 2 - Thứ 7 (8:00 - 17:30)">Thứ 2 - Thứ 7 (8:00 - 17:30)</option>
                                <option value="Thứ 2 - Chủ Nhật (8:00 - 21:00)">Thứ 2 - Chủ Nhật (8:00 - 21:00)</option>
                                <option value="Hỗ trợ 24/7">Hỗ trợ 24/7</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ROW 2: 2 COLUMNS (Thiết lập giao diện, Tự động trả lời) --}}
            <div class="cl-grid-bottom">
                <div class="cl-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-icon"><svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4 5 5 0 013-4.5 4 4 0 014.5-3 5 5 0 014.5 3 4 4 0 013 4.5 4 4 0 01-4 4H7z"/></svg></div>
                        <div class="cl-card-header-text">
                            <h3>Thiết lập giao diện chat</h3>
                            <p>Tùy chỉnh giao diện theo nhận diện thương hiệu.</p>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px;">
                        <div>
                            <label class="cl-label">Màu sắc chủ đạo</label>
                            <select wire:model.live="primary_color" class="cl-select" style="width: 100%;">
                                <option value="#FF6B00">#FF6B00 (Cam Cửu Long)</option>
                                <option value="#2563EB">#2563EB (Xanh dương)</option>
                            </select>
                        </div>
                        <div>
                            <label class="cl-label">Vị trí hiển thị</label>
                            <select wire:model.live="widget_position" class="cl-select" style="width: 100%;">
                                <option value="Góc phải dưới cùng">Góc phải dưới cùng</option>
                                <option value="Góc trái dưới cùng">Góc trái dưới cùng</option>
                            </select>
                        </div>
                        <div>
                            <label class="cl-label">Icon chat</label>
                            <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 7px 12px; font-size: 12px;">💬 Icon mặc định</div>
                        </div>
                    </div>
                </div>

                <div class="cl-card">
                    <div class="cl-card-header">
                        <div class="cl-card-header-icon"><svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
                        <div class="cl-card-header-text">
                            <h3>Tự động trả lời</h3>
                            <p>Thiết lập phản hồi khi tiếp nhận tin nhắn mới.</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <label class="cl-switch"><input type="checkbox" wire:model.live="enable_auto_reply"><span class="cl-slider"></span></label>
                            <span style="font-size: 13px; font-weight: 700;">Bật tin nhắn tự động</span>
                        </div>
                        <div>
                            <label class="cl-label">Nội dung tin nhắn</label>
                            <textarea wire:model.live="auto_reply_content" rows="2" class="cl-textarea"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
