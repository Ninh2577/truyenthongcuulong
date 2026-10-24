<x-filament-panels::page class="cl-posts-command-center">
    <style>
        /* ==========================================================================
           CỬU LONG MEDIA — POST MANAGEMENT COMMAND CENTER
           Guarantees 1:1 match with user's reference design & full functionality
           ========================================================================== */
        .cl-posts-command-center > header.fi-header,
        .cl-posts-command-center .fi-header {
            display: none !important;
        }

        .cl-posts-wrap {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
        }
        .dark .cl-posts-wrap {
            color: #f1f5f9;
        }

        /* Card Primitive */
        .cl-post-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.04);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dark .cl-post-card {
            background-color: #131b2e;
            border-color: #1e293b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
        }

        /* Top 4 KPI Grid */
        .cl-grid-kpis {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        @media (max-width: 1024px) {
            .cl-grid-kpis {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 640px) {
            .cl-grid-kpis {
                grid-template-columns: 1fr;
            }
        }

        /* Typography */
        .cl-title {
            color: #0f172a;
        }
        .dark .cl-title {
            color: #ffffff;
        }

        .cl-muted {
            color: #64748b;
        }
        .dark .cl-muted {
            color: #94a3b8;
        }

        .cl-subtle {
            color: #94a3b8;
        }
        .dark .cl-subtle {
            color: #64748b;
        }

        /* Tabs Navigation */
        .cl-tab-btn {
            padding: 0.625rem 0.85rem;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.15s ease;
            background: none;
            border-top: none;
            border-left: none;
            border-right: none;
        }
        .dark .cl-tab-btn {
            color: #94a3b8;
        }
        .cl-tab-btn.active {
            color: #FF5400;
            border-bottom-color: #FF5400;
        }
        .dark .cl-tab-btn.active {
            color: #FF5400;
            border-bottom-color: #FF5400;
        }
        .cl-tab-btn:hover:not(.active) {
            color: #334155;
        }
        .dark .cl-tab-btn:hover:not(.active) {
            color: #cbd5e1;
        }

        /* Custom Filter Selects & Modern Dropdown System */
        .cl-filter-select {
            padding: 0.5rem 2rem 0.5rem 0.75rem;
            font-size: 12.5px;
            font-weight: 500;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            color: #334155;
            cursor: pointer;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 14px;
            max-width: 170px;
        }
        .dark .cl-filter-select {
            background-color: #131b2e;
            border-color: #1e293b;
            color: #cbd5e1;
        }

        /* Modern Alpine Dropdown Trigger Buttons */
        .cl-dropdown-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.75rem;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: 0.625rem;
            border: 1.5px solid #e2e8f0;
            background-color: #ffffff;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            user-select: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        .cl-dropdown-btn:hover {
            border-color: #cbd5e1;
            background-color: #f8fafc;
            color: #0f172a;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .cl-dropdown-btn.active {
            border-color: #FF5400;
            background-color: #FFF7ED;
            color: #EA580C;
            box-shadow: 0 0 0 1px rgba(255, 84, 0, 0.2), 0 2px 4px rgba(234, 88, 12, 0.08);
        }
        .dark .cl-dropdown-btn {
            background-color: #131b2e;
            border-color: #1e293b;
            color: #cbd5e1;
        }
        .dark .cl-dropdown-btn:hover {
            border-color: #334155;
            background-color: #1e293b;
            color: #f8fafc;
        }
        .dark .cl-dropdown-btn.active {
            border-color: #FF5400;
            background-color: rgba(255, 84, 0, 0.15);
            color: #FB923C;
        }

        /* Modern Dropdown Popover Panel */
        .cl-dropdown-panel {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            z-index: 100;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.12), 0 10px 10px -5px rgba(0, 0, 0, 0.04), 0 0 0 1px rgba(226, 232, 240, 0.8);
            padding: 0.45rem;
            min-width: 210px;
            max-width: 320px;
        }
        .dark .cl-dropdown-panel {
            background: #0f172a;
            border-color: #1e293b;
            box-shadow: 0 25px 35px -5px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(30, 41, 59, 0.8);
        }

        /* Search input inside Dropdown */
        .cl-dropdown-search {
            width: 100%;
            padding: 0.45rem 0.65rem 0.45rem 2rem;
            font-size: 12.5px;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            outline: none;
            background: #f8fafc;
            color: #1e293b;
            transition: all 0.15s ease;
            box-sizing: border-box;
        }
        .cl-dropdown-search:focus {
            border-color: #FF5400;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.12);
        }
        .dark .cl-dropdown-search {
            background: #1e293b;
            border-color: #334155;
            color: #f1f5f9;
        }
        .dark .cl-dropdown-search:focus {
            border-color: #FF5400;
            background: #0f172a;
        }

        /* Scrollable Options List */
        .cl-dropdown-list {
            max-height: 260px;
            overflow-y: auto;
            overscroll-behavior: contain;
            margin-top: 0.35rem;
            padding-right: 2px;
        }
        .cl-dropdown-list::-webkit-scrollbar {
            width: 5px;
        }
        .cl-dropdown-list::-webkit-scrollbar-track {
            background: transparent;
        }
        .cl-dropdown-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .cl-dropdown-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .dark .cl-dropdown-list::-webkit-scrollbar-thumb {
            background: #334155;
        }

        /* Dropdown Item */
        .cl-dropdown-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 12.5px;
            font-weight: 500;
            color: #334155;
            border-radius: 0.5rem;
            border: none;
            background: transparent;
            cursor: pointer;
            text-align: left;
            transition: all 0.12s ease;
            gap: 0.5rem;
            box-sizing: border-box;
        }
        .cl-dropdown-item:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
        .cl-dropdown-item.selected {
            background: #FFF7ED;
            color: #EA580C;
            font-weight: 700;
        }
        .dark .cl-dropdown-item {
            color: #cbd5e1;
        }
        .dark .cl-dropdown-item:hover {
            background: #1e293b;
            color: #f8fafc;
        }
        .dark .cl-dropdown-item.selected {
            background: rgba(255, 84, 0, 0.15);
            color: #FB923C;
        }

        /* Checkbox */
        .cl-checkbox {
            width: 16px;
            height: 16px;
            border-radius: 0.25rem;
            border: 1.5px solid #cbd5e1;
            cursor: pointer;
            accent-color: #FF5400;
        }
        .dark .cl-checkbox {
            border-color: #475569;
        }

        /* Sort Header */
        .cl-th-sort {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            cursor: pointer;
            user-select: none;
            transition: color 0.15s ease;
        }
        .cl-th-sort:hover {
            color: #FF5400;
        }

        /* Action Buttons */
        .cl-row-action {
            width: 30px;
            height: 30px;
            border-radius: 0.375rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.15s ease;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
        }
        .cl-row-action:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }
        .dark .cl-row-action:hover {
            background-color: #1e293b;
            color: #ffffff;
        }
        .cl-row-action.delete:hover {
            background-color: #fee2e2;
            color: #ef4444;
        }

        /* Grid View Item */
        .cl-grid-card {
            border-radius: 0.875rem;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all 0.2s ease;
        }
        .cl-grid-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }
        .dark .cl-grid-card {
            background-color: #131b2e;
            border-color: #1e293b;
        }
        .dark .cl-grid-card:hover {
            border-color: #334155;
        }

        /* Bulk Action Bar */
        .cl-bulk-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%);
            border: 1px solid #FDBA74;
            border-radius: 0.75rem;
            color: #9A3412;
            animation: fadeIn 0.2s ease;
        }
        .dark .cl-bulk-bar {
            background: linear-gradient(135deg, #2D1A10 0%, #431E0E 100%);
            border-color: #9A3412;
            color: #FED7AA;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="cl-posts-wrap">
        {{-- ====================================================================
             1. HEADER: BREADCRUMB, TITLE, DATE & CREATE ACTION
             ==================================================================== --}}
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
                {{-- Breadcrumb --}}
                <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 12px; font-weight: 500; margin-bottom: 0.375rem;" class="cl-subtle">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>/</span>
                    <span class="cl-muted">Nội dung & Tin tức</span>
                    <span>></span>
                    <span style="font-weight: 600;" class="cl-title">Bài viết</span>
                </div>

                {{-- Title with Orange Icon --}}
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 38px; height: 38px; border-radius: 0.625rem; background-color: #FFF0EB; color: #FF5400; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 1px 2px rgba(255, 84, 0, 0.1);">
                        <svg style="width: 22px; height: 22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 24px; font-weight: 800; letter-spacing: -0.025em; margin: 0; line-height: 1.2;" class="cl-title">
                            Bài viết
                        </h1>
                        <p style="font-size: 13px; font-weight: 400; margin: 0.15rem 0 0 0;" class="cl-muted">
                            Quản lý, tìm kiếm và xuất bản các bài viết trên hệ thống Cửu Long Media
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Controls --}}
            <div style="display: flex; align-items: center; gap: 0.625rem; flex-wrap: wrap;">
                {{-- Date Range Dropdown with Alpine.js --}}
                <div x-data="{ open: false }" @click.outside="open = false" style="position: relative;">
                    <button type="button" 
                            @click="open = !open" 
                            class="cl-dropdown-btn {{ $dateFilter !== 'all' ? 'active' : '' }}">
                        <svg style="width: 15px; height: 15px; color: {{ $dateFilter !== 'all' ? '#FF5400' : '#ea580c' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $dateLabel ?? $dateRange }}</span>
                        <svg :style="open ? 'transform: rotate(180deg);' : ''" style="width: 12px; height: 12px; color: #94a3b8; transition: transform 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                         style="display: none; position: absolute; right: 0; top: calc(100% + 6px); z-index: 100; min-width: 190px;" 
                         class="cl-dropdown-panel">
                        <div class="cl-dropdown-list" style="margin-top: 0; max-height: none;">
                            @php
                                $dateOptions = [
                                    'all' => 'Tất cả thời gian',
                                    'today' => 'Hôm nay',
                                    'this_week' => 'Tuần này',
                                    'this_month' => 'Tháng này',
                                    'last_month' => 'Tháng trước',
                                ];
                            @endphp
                            @foreach($dateOptions as $val => $lbl)
                                <button type="button" 
                                        wire:click="setDateFilter('{{ $val }}')" 
                                        @click="open = false" 
                                        class="cl-dropdown-item {{ $dateFilter === $val ? 'selected' : '' }}">
                                    <span>{{ $lbl }}</span>
                                    @if($dateFilter === $val)
                                        <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Primary Action: + Tạo bài viết --}}
                <a href="{{ $createUrl }}" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1rem; font-size: 13px; font-weight: 700; color: #ffffff; background-color: #FF5400; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 2px 6px rgba(255, 84, 0, 0.3); transition: background-color 0.15s ease;">
                    <span style="font-size: 16px; line-height: 1;">+</span>
                    <span>Tạo bài viết</span>
                </a>
            </div>
        </div>

        {{-- ====================================================================
             2. TOP 4 METRIC CARDS WITH SPARKLINES (REAL DATABASE COUNTS)
             ==================================================================== --}}
        <div class="cl-grid-kpis">
            {{-- Card 1: Tổng số bài viết --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #FFF0EB; color: #FF5400; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Tổng số bài viết</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($totalCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #059669; background-color: #ECFDF5; padding: 2px 6px; border-radius: 9999px;">Tất cả</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">Tổng bài viết trong hệ thống</div>
                    </div>

                    {{-- Mini Orange Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 26 C 25 24, 40 22, 60 18 C 75 16, 85 8, 100 6" fill="none" stroke="#FF5400" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 2: Bài viết đã xuất bản --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #EFF6FF; color: #2563EB; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Bài viết đã xuất bản</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($publishedCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #059669; background-color: #ECFDF5; padding: 2px 6px; border-radius: 9999px;">Hoạt động</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">Đang hiển thị công khai</div>
                    </div>

                    {{-- Mini Blue Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 28 C 25 26, 40 18, 60 22 C 75 25, 85 12, 100 8" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 3: Bài viết nháp --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #F1F5F9; color: #64748B; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Bài viết nháp</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($draftCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #D97706; background-color: #FFFBEB; padding: 2px 6px; border-radius: 9999px;">Lưu nháp</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">Chờ duyệt hoặc biên tập</div>
                    </div>

                    {{-- Mini Slate Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 24 C 20 26, 40 22, 60 24 C 75 22, 85 14, 100 10" fill="none" stroke="#64748B" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 4: Bài viết bị ẩn --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #FFF1F2; color: #E11D48; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Bài viết bị ẩn</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($hiddenCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #E11D48; background-color: #FFF1F2; padding: 2px 6px; border-radius: 9999px;">Tạm ẩn</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">Không hiển thị ngoài web</div>
                    </div>

                    {{-- Mini Rose Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 27 C 25 26, 45 24, 65 20 C 80 16, 90 12, 100 8" fill="none" stroke="#E11D48" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================================================================
             3. MAIN CONTAINER: TABS, FILTER BAR, TABLE/GRID & PAGINATION
             ==================================================================== --}}
        <div class="cl-post-card" style="padding: 1.25rem;">
            {{-- STATUS TABS (DYNAMIC COUNTS) --}}
            <div style="display: flex; align-items: center; gap: 0.5rem; border-bottom: 1px solid #f1f5f9; margin-bottom: 1.25rem;">
                <button type="button" wire:click="setTab('all')" class="cl-tab-btn {{ $activeTab === 'all' ? 'active' : '' }}">
                    Tất cả ({{ number_format($totalCount) }})
                </button>
                <button type="button" wire:click="setTab('published')" class="cl-tab-btn {{ $activeTab === 'published' ? 'active' : '' }}">
                    Đã xuất bản ({{ number_format($publishedCount) }})
                </button>
                <button type="button" wire:click="setTab('draft')" class="cl-tab-btn {{ $activeTab === 'draft' ? 'active' : '' }}">
                    Bản nháp ({{ number_format($draftCount) }})
                </button>
                <button type="button" wire:click="setTab('hidden')" class="cl-tab-btn {{ $activeTab === 'hidden' ? 'active' : '' }}">
                    Bị ẩn ({{ number_format($hiddenCount) }})
                </button>
                <button type="button" wire:click="setTab('trash')" class="cl-tab-btn {{ $activeTab === 'trash' ? 'active' : '' }}" style="{{ $activeTab === 'trash' ? 'color: #dc2626 !important; border-bottom-color: #dc2626 !important;' : '' }}">
                    <span style="display: inline-flex; align-items: center; gap: 4px;">
                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Thùng rác ({{ number_format($trashCount) }})
                    </span>
                </button>
            </div>

            {{-- SEARCH & FILTER BAR --}}
            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem; margin-bottom: 1.25rem;">
                {{-- Left: Search Input --}}
                <div style="position: relative; flex: 1; min-width: 280px; max-width: 480px;">
                    <span style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Tìm kiếm tiêu đề, danh mục, tác giả..."
                        style="width: 100%; padding: 0.55rem 0.85rem 0.55rem 2.5rem; font-size: 13px; border-radius: 0.5rem; border: 1px solid #e2e8f0; outline: none; transition: border-color 0.15s ease;"
                        class="cl-post-card"
                    />
                </div>

                {{-- Middle: Custom Modern Filter Dropdowns --}}
                <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                    {{-- 1. Category Filter Dropdown with Alpine.js --}}
                    <div x-data="{ 
                            open: false, 
                            search: '',
                            matches(name) {
                                if (!this.search) return true;
                                return name.toLowerCase().includes(this.search.toLowerCase());
                            }
                         }" 
                         @click.outside="open = false; search = ''" 
                         style="position: relative;">
                        
                        <button type="button" 
                                @click="open = !open; if(open) $nextTick(() => $refs.catSearch?.focus())" 
                                class="cl-dropdown-btn {{ !empty($selectedCategory) ? 'active' : '' }}">
                            <span style="display: inline-flex; align-items: center; gap: 0.4rem;">
                                <span>📁</span>
                                <span style="max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ !empty($selectedCategory) && isset($categories[$selectedCategory]) ? $categories[$selectedCategory] : 'Danh mục' }}
                                </span>
                            </span>
                            @if(!empty($selectedCategory))
                                <span @click.stop="$wire.set('selectedCategory', '')" 
                                      title="Xóa lọc danh mục"
                                      style="display: inline-flex; align-items: center; justify-content: center; width: 17px; height: 17px; border-radius: 50%; background: rgba(234, 88, 12, 0.18); color: #ea580c; font-size: 12px; margin-left: 2px;">
                                    ×
                                </span>
                            @else
                                <svg :style="open ? 'transform: rotate(180deg);' : ''" style="width: 12px; height: 12px; color: #94a3b8; transition: transform 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            @endif
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                             style="display: none; width: 270px;" 
                             class="cl-dropdown-panel">
                            
                            {{-- Quick search input inside category dropdown --}}
                            <div style="position: relative; margin-bottom: 0.4rem;">
                                <svg style="position: absolute; left: 0.65rem; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #94a3b8; pointer-events: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input x-ref="catSearch" 
                                       x-model="search" 
                                       type="text" 
                                       placeholder="Tìm nhanh danh mục..." 
                                       class="cl-dropdown-search" />
                            </div>

                            <div class="cl-dropdown-list">
                                <button type="button" 
                                        @click="$wire.set('selectedCategory', ''); open = false; search = ''" 
                                        class="cl-dropdown-item {{ empty($selectedCategory) ? 'selected' : '' }}">
                                    <span>Tất cả danh mục</span>
                                    @if(empty($selectedCategory))
                                        <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </button>

                                @foreach($categories as $id => $name)
                                    <button type="button" 
                                            x-show="matches('{{ addslashes($name) }}')"
                                            @click="$wire.set('selectedCategory', '{{ $id }}'); open = false; search = ''" 
                                            class="cl-dropdown-item {{ (string)$selectedCategory === (string)$id ? 'selected' : '' }}">
                                        <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $name }}</span>
                                        @if((string)$selectedCategory === (string)$id)
                                            <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- 2. Author Filter Dropdown with Alpine.js --}}
                    <div x-data="{ open: false }" @click.outside="open = false" style="position: relative;">
                        <button type="button" 
                                @click="open = !open" 
                                class="cl-dropdown-btn {{ !empty($selectedAuthor) ? 'active' : '' }}">
                            <span style="display: inline-flex; align-items: center; gap: 0.4rem;">
                                <span>👤</span>
                                <span style="max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ !empty($selectedAuthor) && isset($authors[$selectedAuthor]) ? $authors[$selectedAuthor] : 'Tác giả' }}
                                </span>
                            </span>
                            @if(!empty($selectedAuthor))
                                <span @click.stop="$wire.set('selectedAuthor', '')" 
                                      title="Xóa lọc tác giả"
                                      style="display: inline-flex; align-items: center; justify-content: center; width: 17px; height: 17px; border-radius: 50%; background: rgba(234, 88, 12, 0.18); color: #ea580c; font-size: 12px; margin-left: 2px;">
                                    ×
                                </span>
                            @else
                                <svg :style="open ? 'transform: rotate(180deg);' : ''" style="width: 12px; height: 12px; color: #94a3b8; transition: transform 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            @endif
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                             style="display: none; width: 220px;" 
                             class="cl-dropdown-panel">
                            
                            <div class="cl-dropdown-list" style="margin-top: 0;">
                                <button type="button" 
                                        @click="$wire.set('selectedAuthor', ''); open = false" 
                                        class="cl-dropdown-item {{ empty($selectedAuthor) ? 'selected' : '' }}">
                                    <span>Tất cả tác giả</span>
                                    @if(empty($selectedAuthor))
                                        <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </button>

                                @foreach($authors as $id => $name)
                                    <button type="button" 
                                            @click="$wire.set('selectedAuthor', '{{ $id }}'); open = false" 
                                            class="cl-dropdown-item {{ (string)$selectedAuthor === (string)$id ? 'selected' : '' }}">
                                        <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $name }}</span>
                                        @if((string)$selectedAuthor === (string)$id)
                                            <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- 3. Status Filter Dropdown with Alpine.js --}}
                    <div x-data="{ open: false }" @click.outside="open = false" style="position: relative;">
                        <button type="button" 
                                @click="open = !open" 
                                class="cl-dropdown-btn {{ !empty($selectedStatus) ? 'active' : '' }}">
                            <span style="display: inline-flex; align-items: center; gap: 0.4rem;">
                                <span>⚙</span>
                                <span>
                                    {{ match($selectedStatus) {
                                        'published' => 'Đã xuất bản',
                                        'draft' => 'Bản nháp',
                                        'hidden' => 'Đã ẩn',
                                        default => 'Trạng thái'
                                    } }}
                                </span>
                            </span>
                            @if(!empty($selectedStatus))
                                <span @click.stop="$wire.set('selectedStatus', '')" 
                                      title="Xóa lọc trạng thái"
                                      style="display: inline-flex; align-items: center; justify-content: center; width: 17px; height: 17px; border-radius: 50%; background: rgba(234, 88, 12, 0.18); color: #ea580c; font-size: 12px; margin-left: 2px;">
                                    ×
                                </span>
                            @else
                                <svg :style="open ? 'transform: rotate(180deg);' : ''" style="width: 12px; height: 12px; color: #94a3b8; transition: transform 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            @endif
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                             style="display: none; width: 195px;" 
                             class="cl-dropdown-panel">
                            
                            <div class="cl-dropdown-list" style="margin-top: 0; max-height: none;">
                                <button type="button" 
                                        @click="$wire.set('selectedStatus', ''); open = false" 
                                        class="cl-dropdown-item {{ empty($selectedStatus) ? 'selected' : '' }}">
                                    <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #94a3b8;"></span>
                                        <span>Tất cả trạng thái</span>
                                    </span>
                                    @if(empty($selectedStatus))
                                        <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </button>

                                <button type="button" 
                                        @click="$wire.set('selectedStatus', 'published'); open = false" 
                                        class="cl-dropdown-item {{ $selectedStatus === 'published' ? 'selected' : '' }}">
                                    <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #10B981;"></span>
                                        <span>Đã xuất bản</span>
                                    </span>
                                    @if($selectedStatus === 'published')
                                        <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </button>

                                <button type="button" 
                                        @click="$wire.set('selectedStatus', 'draft'); open = false" 
                                        class="cl-dropdown-item {{ $selectedStatus === 'draft' ? 'selected' : '' }}">
                                    <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #F97316;"></span>
                                        <span>Bản nháp</span>
                                    </span>
                                    @if($selectedStatus === 'draft')
                                        <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </button>

                                <button type="button" 
                                        @click="$wire.set('selectedStatus', 'hidden'); open = false" 
                                        class="cl-dropdown-item {{ $selectedStatus === 'hidden' ? 'selected' : '' }}">
                                    <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #64748B;"></span>
                                        <span>Đã ẩn</span>
                                    </span>
                                    @if($selectedStatus === 'hidden')
                                        <svg style="width: 14px; height: 14px; color: #ea580c; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Clear Filters Button --}}
                    @if(!empty($selectedCategory) || !empty($selectedAuthor) || !empty($selectedStatus) || !empty($search) || $dateFilter !== 'all')
                        <button type="button" 
                                wire:click="resetFilters" 
                                style="background: #f1f5f9; border: 1px dashed #cbd5e1; border-radius: 0.625rem; font-size: 12px; font-weight: 600; color: #e11d48; cursor: pointer; padding: 0.45rem 0.75rem; display: inline-flex; align-items: center; gap: 4px; transition: all 0.15s ease;"
                                onmouseover="this.style.background='#fee2e2'; this.style.borderColor='#f87171';"
                                onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#cbd5e1';"
                                title="Đặt lại toàn bộ lọc">
                            <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>Xóa bộ lọc</span>
                        </button>
                    @endif
                </div>

                {{-- Right: View Mode Toggle --}}
                <div style="display: flex; align-items: center; gap: 0.25rem;">
                    {{-- List View Button --}}
                    <button type="button" wire:click="setViewMode('list')" title="Chế độ Danh sách" style="width: 34px; height: 34px; border-radius: 0.375rem; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease; {{ $viewMode === 'list' ? 'background-color: #FF5400; color: #ffffff;' : 'background-color: #f1f5f9; color: #64748b;' }}">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    {{-- Grid View Button --}}
                    <button type="button" wire:click="setViewMode('grid')" title="Chế độ Lưới (Card)" style="width: 34px; height: 34px; border-radius: 0.375rem; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease; {{ $viewMode === 'grid' ? 'background-color: #FF5400; color: #ffffff;' : 'background-color: #f1f5f9; color: #64748b;' }}">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ================================================================
                 4. BULK ACTIONS FLOATING BAR (Appears when posts are selected)
                 ================================================================ --}}
            @if(count($selectedPosts) > 0)
                <div class="cl-bulk-bar">
                    <div style="display: flex; align-items: center; gap: 0.6rem; font-size: 13px; font-weight: 700;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 9999px; background: #FF5400; color: #ffffff; font-size: 11px;">
                            {{ count($selectedPosts) }}
                        </span>
                        <span>Đã chọn {{ count($selectedPosts) }} bài viết</span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                        @if($activeTab === 'trash')
                            {{-- Khôi phục hàng loạt --}}
                            <button type="button" wire:click="bulkRestore" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.45rem 0.85rem; border-radius: 0.5rem; border: none; background: #059669; color: #ffffff; font-size: 12px; font-weight: 700; cursor: pointer; box-shadow: 0 2px 4px rgba(5, 150, 105, 0.2);">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                <span>Khôi phục tất cả đã chọn</span>
                            </button>

                            {{-- Xóa vĩnh viễn hàng loạt --}}
                            <button type="button" wire:click="openBulkDeleteModal" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.45rem 0.85rem; border-radius: 0.5rem; border: none; background: #DC2626; color: #ffffff; font-size: 12px; font-weight: 700; cursor: pointer; box-shadow: 0 2px 4px rgba(220, 38, 38, 0.2);">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Xóa vĩnh viễn</span>
                            </button>
                        @else
                            {{-- Xuất bản hàng loạt --}}
                            <button type="button" wire:click="bulkPublish" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.4rem 0.75rem; border-radius: 0.375rem; border: none; background: #059669; color: #ffffff; font-size: 12px; font-weight: 600; cursor: pointer;">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Xuất bản</span>
                            </button>

                            {{-- Chuyển về nháp --}}
                            <button type="button" wire:click="bulkDraft" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.4rem 0.75rem; border-radius: 0.375rem; border: none; background: #D97706; color: #ffffff; font-size: 12px; font-weight: 600; cursor: pointer;">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                <span>Lưu nháp</span>
                            </button>

                            {{-- Ẩn bài viết --}}
                            <button type="button" wire:click="bulkHide" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.4rem 0.75rem; border-radius: 0.375rem; border: none; background: #475569; color: #ffffff; font-size: 12px; font-weight: 600; cursor: pointer;">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                                <span>Ẩn</span>
                            </button>

                            {{-- Xóa đã chọn (Custom Modal) --}}
                            <button type="button" wire:click="openBulkDeleteModal" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.4rem 0.75rem; border-radius: 0.375rem; border: none; background: #DC2626; color: #ffffff; font-size: 12px; font-weight: 600; cursor: pointer;">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Xóa</span>
                            </button>
                        @endif

                        {{-- Bỏ chọn --}}
                        <button type="button" wire:click="clearSelection" style="padding: 0.4rem 0.65rem; border-radius: 0.375rem; border: 1px solid #cbd5e1; background: transparent; color: #475569; font-size: 12px; font-weight: 600; cursor: pointer;">
                            Bỏ chọn
                        </button>
                    </div>
                </div>
            @elseif($activeTab === 'trash' && $trashCount > 0)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; margin-bottom: 1rem; border-radius: 0.5rem; background: #FEF2F2; border: 1px solid #FECACA;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 13px; color: #991B1B;">
                        <svg style="width: 16px; height: 16px; color: #DC2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Thùng rác có <strong>{{ $trashCount }} bài viết</strong>. Bạn có thể khôi phục lại hoặc xóa vĩnh viễn khỏi hệ thống.</span>
                    </div>
                    <button type="button" wire:click="emptyTrash" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.35rem 0.75rem; border-radius: 0.375rem; border: 1px solid #FCA5A5; background: #FFFFFF; color: #DC2626; font-size: 12px; font-weight: 700; cursor: pointer;">
                        <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Dọn sạch thùng rác
                    </button>
                </div>
            @endif

            {{-- ================================================================
                 5. DATA DISPLAY: LIST (TABLE) OR GRID (CARDS)
                 ================================================================ --}}
            @if($viewMode === 'list')
                {{-- TABLE VIEW --}}
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 12.5px;">
                        <thead>
                            <tr style="border-bottom: 1px solid #f1f5f9; color: #94a3b8; font-size: 11.5px; font-weight: 700;">
                                <th style="padding: 0.75rem 0.75rem 0.75rem 0.5rem; width: 36px;">
                                    <input type="checkbox" wire:click="toggleSelectAll" {{ $selectAll ? 'checked' : '' }} class="cl-checkbox" title="Chọn tất cả" />
                                </th>
                                <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                    <span class="cl-th-sort" wire:click="sortBy('title')" title="Sắp xếp theo Tiêu đề">
                                        <span>Tiêu đề</span>
                                        @if($sortColumn === 'title')
                                            <span style="color: #FF5400; font-size: 11px;">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                        @else
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                        @endif
                                    </span>
                                </th>
                                <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                    <span class="cl-th-sort" wire:click="sortBy('category_id')" title="Sắp xếp theo Danh mục">
                                        <span>Danh mục</span>
                                        @if($sortColumn === 'category_id')
                                            <span style="color: #FF5400; font-size: 11px;">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                        @else
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                        @endif
                                    </span>
                                </th>
                                <th style="padding: 0.75rem 0.75rem; font-weight: 600;">Tác giả</th>
                                <th style="padding: 0.75rem 0.75rem; font-weight: 600;">Trạng thái</th>
                                <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                    <span class="cl-th-sort" wire:click="sortBy('published_at')" title="Sắp xếp theo Ngày đăng">
                                        <span>Ngày đăng</span>
                                        @if($sortColumn === 'published_at')
                                            <span style="color: #FF5400; font-size: 11px;">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                        @else
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                        @endif
                                    </span>
                                </th>
                                <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                    <span class="cl-th-sort" wire:click="sortBy('updated_at')" title="Sắp xếp theo Ngày cập nhật">
                                        <span>Ngày cập nhật</span>
                                        @if($sortColumn === 'updated_at')
                                            <span style="color: #FF5400; font-size: 11px;">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                        @else
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                        @endif
                                    </span>
                                </th>
                                <th style="padding: 0.75rem 0.5rem 0.75rem 0.75rem; text-align: right; font-weight: 600;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody style="border-top: 1px solid #f8fafc;">
                            @forelse($posts as $post)
                                <tr style="border-bottom: 1px solid #f8fafc; transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='rgba(248,250,252,0.7)'" onmouseout="this.style.backgroundColor='transparent'">
                                    {{-- Checkbox --}}
                                    <td style="padding: 0.85rem 0.75rem 0.85rem 0.5rem;">
                                        <input type="checkbox" wire:click="toggleSelectPost({{ $post['id'] }})" {{ in_array($post['id'], $selectedPosts) ? 'checked' : '' }} class="cl-checkbox" />
                                    </td>

                                    {{-- Title with Thumbnail & Summary --}}
                                    <td style="padding: 0.85rem 0.75rem;">
                                        <div style="display: flex; align-items: center; gap: 0.75rem; min-width: 260px;">
                                            <img src="{{ $post['thumbnail'] }}" alt="{{ $post['title'] }}" style="width: 48px; height: 36px; border-radius: 0.375rem; object-fit: cover; flex-shrink: 0; box-shadow: 0 1px 2px rgba(0,0,0,0.08);" />
                                            <div>
                                                <a href="{{ $post['edit_url'] }}" style="font-weight: 700; text-decoration: none; display: block; line-height: 1.3;" class="cl-title">
                                                    {{ $post['title'] }}
                                                </a>
                                                <div style="font-size: 11px; margin-top: 2px; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 340px;" class="cl-muted">
                                                    {{ $post['summary'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Category Badge --}}
                                    <td style="padding: 0.85rem 0.75rem; white-space: nowrap;">
                                        <span style="padding: 2.5px 8px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: {{ $post['category_badge_bg'] }}; color: {{ $post['category_badge_text'] }}; border: 1px solid {{ $post['category_badge_border'] }};">
                                            {{ $post['category'] }}
                                        </span>
                                    </td>

                                    {{-- Author --}}
                                    <td style="padding: 0.85rem 0.75rem; white-space: nowrap;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <img src="{{ $post['author_avatar'] }}" alt="{{ $post['author_name'] }}" style="width: 24px; height: 24px; border-radius: 9999px; object-fit: cover; flex-shrink: 0;" />
                                            <div>
                                                <div style="font-weight: 600; font-size: 12px; line-height: 1.2;" class="cl-title">{{ $post['author_name'] }}</div>
                                                <div style="font-size: 10.5px; line-height: 1.2;" class="cl-subtle">{{ $post['author_role'] }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Status Badge with Dot (Click to toggle status) --}}
                                    <td style="padding: 0.85rem 0.75rem; white-space: nowrap;">
                                        <button type="button" wire:click="toggleStatus({{ $post['id'] }})" title="Bấm để chuyển nhanh trạng thái" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 2.5px 8px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: {{ $post['status_badge_bg'] }}; color: {{ $post['status_badge_text'] }}; border: 1px solid {{ $post['status_badge_border'] }}; cursor: pointer;">
                                            <span style="width: 6px; height: 6px; border-radius: 9999px; background-color: {{ $post['status_dot'] }};"></span>
                                            <span>{{ $post['status_label'] }}</span>
                                        </button>
                                    </td>

                                    {{-- Publish Date --}}
                                    <td style="padding: 0.85rem 0.75rem; white-space: nowrap; font-size: 11.5px;" class="cl-muted">
                                        {{ $post['published_at'] }}
                                    </td>

                                    {{-- Update Date --}}
                                    <td style="padding: 0.85rem 0.75rem; white-space: nowrap; font-size: 11.5px;" class="cl-muted">
                                        {{ $post['updated_at'] }}
                                    </td>

                                    {{-- Row Actions --}}
                                    <td style="padding: 0.85rem 0.5rem 0.85rem 0.75rem; text-align: right; white-space: nowrap;">
                                        <div style="display: inline-flex; align-items: center; gap: 0.25rem;">
                                            @if(!empty($post['is_trashed']))
                                                {{-- Restore from trash --}}
                                                <button type="button" wire:click="restorePost({{ $post['id'] }})" title="Khôi phục bài viết" class="cl-row-action" style="color: #059669; background: #ECFDF5; border: 1px solid #A7F3D0;">
                                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                                </button>

                                                {{-- Force Delete --}}
                                                <button type="button" wire:click="openDeleteModal({{ $post['id'] }})" title="Xóa vĩnh viễn" class="cl-row-action delete">
                                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            @else
                                                {{-- View / Preview --}}
                                                <a href="{{ $post['preview_url'] }}" target="_blank" title="Xem trước trên website" class="cl-row-action">
                                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ $post['edit_url'] }}" title="Chỉnh sửa bài viết" class="cl-row-action">
                                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </a>

                                                {{-- Duplicate --}}
                                                <button type="button" wire:click="duplicatePost({{ $post['id'] }})" title="Nhân bản bài viết" class="cl-row-action">
                                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                    </svg>
                                                </button>

                                                {{-- Delete (Custom Modal) --}}
                                                <button type="button" wire:click="openDeleteModal({{ $post['id'] }})" title="Xóa bài viết" class="cl-row-action delete">
                                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="padding: 2.5rem; text-align: center; color: #94a3b8;">
                                        Không tìm thấy bài viết nào phù hợp với bộ lọc hiện tại.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                {{-- GRID (CARDS) VIEW --}}
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.25rem;">
                    @forelse($posts as $post)
                        <div class="cl-grid-card">
                            {{-- Card Image & Overlays --}}
                            <div style="position: relative; width: 100%; height: 165px; overflow: hidden; background: #f1f5f9;">
                                <img src="{{ $post['thumbnail'] }}" alt="{{ $post['title'] }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" />

                                {{-- Selection Checkbox --}}
                                <div style="position: absolute; top: 10px; left: 10px; z-index: 10;">
                                    <input type="checkbox" wire:click="toggleSelectPost({{ $post['id'] }})" {{ in_array($post['id'], $selectedPosts) ? 'checked' : '' }} class="cl-checkbox" style="width: 18px; height: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.3);" />
                                </div>

                                {{-- Category Badge --}}
                                <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                    <span style="padding: 2.5px 8px; border-radius: 9999px; font-size: 11px; font-weight: 700; background-color: {{ $post['category_badge_bg'] }}; color: {{ $post['category_badge_text'] }}; border: 1px solid {{ $post['category_badge_border'] }}; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                        {{ $post['category'] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div style="padding: 1rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    {{-- Status & Views Header --}}
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                                        <button type="button" wire:click="toggleStatus({{ $post['id'] }})" title="Bấm để đổi trạng thái" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 2px 7px; border-radius: 9999px; font-size: 10.5px; font-weight: 600; background-color: {{ $post['status_badge_bg'] }}; color: {{ $post['status_badge_text'] }}; border: 1px solid {{ $post['status_badge_border'] }}; cursor: pointer;">
                                            <span style="width: 5px; height: 5px; border-radius: 9999px; background-color: {{ $post['status_dot'] }};"></span>
                                            <span>{{ $post['status_label'] }}</span>
                                        </button>

                                        <span style="font-size: 11px; color: #94a3b8; display: inline-flex; align-items: center; gap: 0.25rem;">
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <span>{{ number_format($post['views']) }} lượt xem</span>
                                        </span>
                                    </div>

                                    {{-- Title --}}
                                    <a href="{{ $post['edit_url'] }}" style="font-weight: 700; font-size: 14px; text-decoration: none; line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 0.4rem;" class="cl-title">
                                        {{ $post['title'] }}
                                    </a>

                                    {{-- Excerpt --}}
                                    <p style="font-size: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin: 0 0 0.85rem 0;" class="cl-muted">
                                        {{ $post['summary'] }}
                                    </p>
                                </div>

                                {{-- Author & Meta Footer --}}
                                <div style="border-top: 1px solid #f1f5f9; padding-top: 0.75rem; margin-top: 0.5rem;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem;">
                                        <div style="display: flex; align-items: center; gap: 0.45rem;">
                                            <img src="{{ $post['author_avatar'] }}" alt="{{ $post['author_name'] }}" style="width: 22px; height: 22px; border-radius: 9999px; object-fit: cover;" />
                                            <span style="font-size: 11.5px; font-weight: 600;" class="cl-title">{{ $post['author_name'] }}</span>
                                        </div>
                                        <span style="font-size: 11px;" class="cl-subtle">{{ $post['published_at'] }}</span>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.25rem;">
                                        @if(!empty($post['is_trashed']))
                                            {{-- Restore from trash --}}
                                            <button type="button" wire:click="restorePost({{ $post['id'] }})" title="Khôi phục bài viết" class="cl-row-action" style="color: #059669; background: #ECFDF5; border: 1px solid #A7F3D0;">
                                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            </button>

                                            {{-- Force Delete --}}
                                            <button type="button" wire:click="openDeleteModal({{ $post['id'] }})" title="Xóa vĩnh viễn" class="cl-row-action delete">
                                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        @else
                                            <a href="{{ $post['preview_url'] }}" target="_blank" title="Xem trước" class="cl-row-action">
                                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>

                                            <a href="{{ $post['edit_url'] }}" title="Chỉnh sửa" class="cl-row-action">
                                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            </a>

                                            <button type="button" wire:click="duplicatePost({{ $post['id'] }})" title="Nhân bản" class="cl-row-action">
                                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                            </button>

                                            {{-- Delete (Custom Modal) --}}
                                            <button type="button" wire:click="openDeleteModal({{ $post['id'] }})" title="Xóa" class="cl-row-action delete">
                                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; padding: 3rem; text-align: center; color: #94a3b8;">
                            Không tìm thấy bài viết nào phù hợp với bộ lọc hiện tại.
                        </div>
                    @endforelse
                </div>
            @endif

            {{-- ================================================================
                 6. FOOTER & DYNAMIC PAGINATION
                 ================================================================ --}}
            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid #f1f5f9;">
                {{-- Left Text --}}
                <div style="font-size: 12px; font-weight: 500;" class="cl-muted">
                    Hiển thị {{ $firstItem }}–{{ $lastItem }} trong tổng số {{ number_format($total) }} bài viết
                </div>

                {{-- Right Controls: Pagination & Per Page --}}
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    {{-- Pagination Pills --}}
                    @if($lastPage > 1)
                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                            {{-- Previous Page --}}
                            <button type="button" wire:click="setPage({{ max(1, $currentPage - 1) }})" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                &lt;
                            </button>

                            @php
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($startPage > 1)
                                <button type="button" wire:click="setPage(1)" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                    1
                                </button>
                                @if($startPage > 2)
                                    <span style="font-size: 12px; color: #94a3b8; padding: 0 2px;">...</span>
                                @endif
                            @endif

                            @for($p = $startPage; $p <= $endPage; $p++)
                                <button type="button" wire:click="setPage({{ $p }})" style="width: 28px; height: 28px; border-radius: 0.375rem; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; cursor: pointer; {{ $p === $currentPage ? 'background-color: #FF5400; color: #ffffff; border: none;' : 'border: 1px solid #e2e8f0; background: none; color: #64748b;' }}">
                                    {{ $p }}
                                </button>
                            @endfor

                            @if($endPage < $lastPage)
                                @if($endPage < $lastPage - 1)
                                    <span style="font-size: 12px; color: #94a3b8; padding: 0 2px;">...</span>
                                @endif
                                <button type="button" wire:click="setPage({{ $lastPage }})" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                    {{ $lastPage }}
                                </button>
                            @endif

                            {{-- Next Page --}}
                            <button type="button" wire:click="setPage({{ min($lastPage, $currentPage + 1) }})" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                &gt;
                            </button>
                        </div>
                    @endif

                    {{-- Per Page Custom Dropdown --}}
                    <div x-data="{ open: false }" @click.outside="open = false" style="position: relative;">
                        <button type="button" @click="open = !open" 
                                class="cl-dropdown-btn" 
                                style="padding: 0.35rem 0.65rem; font-size: 12px;">
                            <span>{{ $perPage }} / trang</span>
                            <svg :style="open ? 'transform: rotate(180deg);' : ''" style="width: 11px; height: 11px; color: #94a3b8; transition: transform 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             style="display: none; position: absolute; right: 0; bottom: calc(100% + 6px); z-index: 100; min-width: 120px;" 
                             class="cl-dropdown-panel">
                            <div class="cl-dropdown-list" style="margin-top: 0; max-height: none;">
                                @foreach([6, 12, 24, 48] as $n)
                                    <button type="button" 
                                            wire:click="$set('perPage', {{ $n }})" 
                                            @click="open = false" 
                                            class="cl-dropdown-item {{ (int)$perPage === $n ? 'selected' : '' }}" 
                                            style="padding: 0.35rem 0.6rem; font-size: 12px;">
                                        <span>{{ $n }} / trang</span>
                                        @if((int)$perPage === $n)
                                            <svg style="width: 12px; height: 12px; color: #ea580c;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================
         7. CUSTOM DELETE MODAL (SANG TRỌNG, THANH LỊCH, HIỆN ĐẠI)
         ================================================================ --}}
    @if($showDeleteModal)
        <div style="position: fixed; inset: 0; z-index: 999999; display: flex; align-items: center; justify-content: center; padding: 1.25rem;">
            {{-- Backdrop with blur --}}
            <div wire:click="closeDeleteModal" 
                 style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: opacity 0.25s ease;">
            </div>

            {{-- Modal Content Card --}}
            <div style="position: relative; width: 100%; max-width: 530px; background: #ffffff; border-radius: 24px; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(226, 232, 240, 0.8); overflow: hidden; z-index: 10; font-family: inherit; animation: clModalPop 0.25s cubic-bezier(0.16, 1, 0.3, 1);">
                
                {{-- Header --}}
                <div style="padding: 1.75rem 1.75rem 1.25rem; border-bottom: 1px solid #f1f5f9; position: relative;">
                    {{-- Close X Button --}}
                    <button type="button" wire:click="closeDeleteModal" 
                            style="position: absolute; top: 1.25rem; right: 1.25rem; width: 34px; height: 34px; border-radius: 50%; border: 1px solid #e2e8f0; background: #ffffff; color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease;"
                            onmouseover="this.style.background='#f1f5f9'; this.style.color='#0f172a';"
                            onmouseout="this.style.background='#ffffff'; this.style.color='#64748b';">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        {{-- Icon Circle --}}
                        <div style="width: 52px; height: 52px; border-radius: 16px; background: {{ $isDeletingFromTrash ? 'rgba(239, 68, 68, 0.12)' : 'rgba(255, 94, 20, 0.12)' }}; border: 1.5px solid {{ $isDeletingFromTrash ? 'rgba(239, 68, 68, 0.25)' : 'rgba(255, 94, 20, 0.25)' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            @if($isDeletingFromTrash)
                                <svg style="width: 26px; height: 26px; color: #dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            @else
                                <svg style="width: 26px; height: 26px; color: #ff5e14;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            @endif
                        </div>

                        <div style="padding-right: 2rem;">
                            <h3 style="margin: 0 0 0.25rem; font-size: 18px; font-weight: 700; color: #0f172a; line-height: 1.3;">
                                {{ $isDeletingFromTrash ? 'Xác nhận xóa vĩnh viễn' : 'Xử lý xóa bài viết' }}
                            </h3>
                            <p style="margin: 0; font-size: 13px; color: #64748b; line-height: 1.4;">
                                {{ $isDeletingFromTrash ? 'Bài viết trong thùng rác sẽ bị gỡ hoàn toàn khỏi cơ sở dữ liệu.' : 'Bạn muốn chuyển vào thùng rác để khôi phục sau hay xóa vĩnh viễn?' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Post Title Preview Box --}}
                <div style="padding: 1.25rem 1.75rem 0.5rem;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0.85rem 1rem; display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">
                            {{ $deleteModalMode === 'bulk' ? 'Danh sách:' : 'Bài viết:' }}
                        </span>
                        <span style="font-size: 13px; font-weight: 600; color: #1e293b; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $postToDeleteTitle }}">
                            {{ $postToDeleteTitle }}
                        </span>
                    </div>
                </div>

                {{-- Actions Section --}}
                <div style="padding: 1.25rem 1.75rem 1.75rem; display: flex; flex-direction: column; gap: 0.85rem;">
                    @if($isDeletingFromTrash)
                        {{-- Mode: Deleting from trash --}}
                        <div style="background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 16px; padding: 1.1rem; text-align: left;">
                            <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                                <svg style="width: 20px; height: 20px; color: #dc2626; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <div>
                                    <div style="font-size: 13.5px; font-weight: 700; color: #991b1b; margin-bottom: 0.25rem;">
                                        Cảnh báo: Hành động không thể hoàn tác!
                                    </div>
                                    <div style="font-size: 12.5px; color: #b91c1c; line-height: 1.45;">
                                        Toàn bộ nội dung bài viết, hình ảnh liên quan và cấu hình SEO sẽ bị xóa vĩnh viễn khỏi hệ thống.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; margin-top: 0.5rem;">
                            <button type="button" wire:click="closeDeleteModal"
                                    style="padding: 0.65rem 1.25rem; border-radius: 12px; border: 1px solid #cbd5e1; background: #ffffff; color: #475569; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.15s ease;">
                                Hủy bỏ & Giữ lại
                            </button>

                            <button type="button" wire:click="forceDeletePost"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.4rem; border-radius: 12px; border: none; background: #dc2626; color: #ffffff; font-size: 13px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3); transition: all 0.15s ease;"
                                    onmouseover="this.style.background='#b91c1c';"
                                    onmouseout="this.style.background='#dc2626';">
                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Xác nhận xóa vĩnh viễn
                            </button>
                        </div>
                    @else
                        {{-- Mode: Normal deleting with 2 elegant options --}}
                        
                        {{-- OPTION 1: CHUYỂN VÀO THÙNG RÁC (KHUYÊN DÙNG) --}}
                        <div wire:click="moveToTrash"
                             style="position: relative; padding: 1.15rem; border-radius: 16px; border: 2px solid #fed7aa; background: linear-gradient(180deg, #fffaf5, #ffffff); cursor: pointer; transition: all 0.2s ease; text-align: left; box-shadow: 0 2px 8px rgba(249, 115, 22, 0.08);"
                             onmouseover="this.style.borderColor='#f97316'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(249, 115, 22, 0.15)';"
                             onmouseout="this.style.borderColor='#fed7aa'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(249, 115, 22, 0.08)';">
                            
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 0.75rem; margin-bottom: 0.35rem;">
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 10px; background: rgba(249, 115, 22, 0.15); color: #ea580c; display: flex; align-items: center; justify-content: center;">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </div>
                                    <div style="font-size: 14.5px; font-weight: 700; color: #9a3412;">
                                        Chuyển vào Thùng rác
                                    </div>
                                </div>
                                <span style="display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 9999px; font-size: 11px; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                    ✓ Khuyên dùng
                                </span>
                            </div>

                            <p style="margin: 0.4rem 0 0.85rem; font-size: 12.5px; color: #64748b; line-height: 1.45;">
                                Bài viết sẽ tạm thời được ẩn khỏi website và lưu trong Thùng rác. Bạn có thể <strong>khôi phục lại nguyên vẹn</strong> bất kỳ lúc nào khi cần.
                            </p>

                            <button type="button" 
                                    style="width: 100%; padding: 0.65rem 1rem; border-radius: 10px; border: none; background: linear-gradient(135deg, #ff5e14, #ea580c); color: #ffffff; font-size: 13px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(234, 88, 12, 0.25);">
                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Chuyển vào Thùng rác ngay</span>
                            </button>
                        </div>

                        {{-- OPTION 2: XÓA VĨNH VIỄN --}}
                        <div wire:click="forceDeletePost"
                             style="position: relative; padding: 1.15rem; border-radius: 16px; border: 1.5px solid #fecaca; background: linear-gradient(180deg, #fffafa, #ffffff); cursor: pointer; transition: all 0.2s ease; text-align: left;"
                             onmouseover="this.style.borderColor='#ef4444'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(239, 68, 68, 0.12)';"
                             onmouseout="this.style.borderColor='#fecaca'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 0.75rem; margin-bottom: 0.35rem;">
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 10px; background: rgba(239, 68, 68, 0.12); color: #dc2626; display: flex; align-items: center; justify-content: center;">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    </div>
                                    <div style="font-size: 14.5px; font-weight: 700; color: #991b1b;">
                                        Xóa vĩnh viễn
                                    </div>
                                </div>
                                <span style="display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 9999px; font-size: 11px; font-weight: 700; background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                                    Không thể hoàn tác
                                </span>
                            </div>

                            <p style="margin: 0.4rem 0 0.85rem; font-size: 12.5px; color: #64748b; line-height: 1.45;">
                                Xóa vĩnh viễn dữ liệu khỏi hệ thống ngay lập tức. Bạn sẽ <strong>không thể khôi phục lại</strong> sau khi xóa.
                            </p>

                            <button type="button"
                                    style="width: 100%; padding: 0.65rem 1rem; border-radius: 10px; border: 1.5px solid #fca5a5; background: #ffffff; color: #dc2626; font-size: 13px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.15s ease;"
                                    onmouseover="this.style.background='#dc2626'; this.style.color='#ffffff';"
                                    onmouseout="this.style.background='#ffffff'; this.style.color='#dc2626';">
                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Xóa vĩnh viễn dữ liệu</span>
                            </button>
                        </div>

                        {{-- Cancel Button --}}
                        <div style="text-align: center; margin-top: 0.35rem;">
                            <button type="button" wire:click="closeDeleteModal"
                                    style="background: transparent; border: none; font-size: 13px; font-weight: 600; color: #64748b; cursor: pointer; padding: 0.5rem 1rem; text-decoration: underline;"
                                    onmouseover="this.style.color='#0f172a';"
                                    onmouseout="this.style.color='#64748b';">
                                Hủy bỏ và giữ nguyên bài viết
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes clModalPop {
            0% { transform: scale(0.94); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</x-filament-panels::page>
