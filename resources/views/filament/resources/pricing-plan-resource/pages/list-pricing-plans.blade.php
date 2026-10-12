<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $display = $this->getDisplayData();
        $plans = $display['plans'];
        $createUrl = $display['createUrl'];
    @endphp

    <style>
        .cl-pp-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-pp-wrapper {
            color: #f1f5f9;
        }

        /* Top Header */
        .cl-pp-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 1024px) {
            .cl-pp-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Breadcrumb */
        .cl-pp-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .dark .cl-pp-breadcrumb {
            color: #94a3b8;
        }
        .cl-pp-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-pp-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Title Area */
        .cl-pp-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cl-pp-title-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.875rem;
            background: #ff5400;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
            flex-shrink: 0;
        }
        .cl-pp-title-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
            color: #0f172a;
            margin: 0;
        }
        .dark .cl-pp-title-text h1 {
            color: #f8fafc;
        }
        .cl-pp-title-text p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }
        .dark .cl-pp-title-text p {
            color: #94a3b8;
        }

        /* Top Action Buttons */
        .cl-pp-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.625rem;
        }
        .cl-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5625rem 0.875rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #334155;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.625rem;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            white-space: nowrap;
        }
        .dark .cl-btn-secondary {
            background: #1e293b;
            border-color: #334155;
            color: #e2e8f0;
        }
        .cl-btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        .dark .cl-btn-secondary:hover {
            background: #27354a;
            border-color: #475569;
        }

        .cl-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5625rem 1.125rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #ffffff;
            background: #ff5400;
            border: 1px solid #ff5400;
            border-radius: 0.625rem;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.3);
            text-decoration: none;
            white-space: nowrap;
        }
        .cl-btn-primary:hover {
            background: #e04a00;
            border-color: #e04a00;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.4);
        }

        /* 4 Top KPI Cards */
        .cl-kpi-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 640px) {
            .cl-kpi-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .cl-kpi-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .cl-kpi-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dark .cl-kpi-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .cl-kpi-icon-pill {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .cl-kpi-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            min-width: 0;
        }
        .cl-kpi-title {
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
        }
        .dark .cl-kpi-title {
            color: #94a3b8;
        }
        .cl-kpi-value-row {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
        }
        .cl-kpi-value {
            font-size: 1.625rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }
        .dark .cl-kpi-value {
            color: #f8fafc;
        }
        .cl-kpi-trend {
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            padding: 2px 7px;
            border-radius: 9999px;
            background: #ecfdf5;
            color: #10b981;
        }
        .dark .cl-kpi-trend {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
        }
        .cl-kpi-subtext {
            font-size: 0.75rem;
            color: #64748b;
        }
        .dark .cl-kpi-subtext {
            color: #94a3b8;
        }

        /* Filter Toolbar */
        .cl-pp-toolbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 0.875rem 1.25rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.875rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        .dark .cl-pp-toolbar {
            background: #182234;
            border-color: #26354a;
        }

        .cl-search-box {
            position: relative;
            flex: 1 1 280px;
            min-width: 240px;
        }
        .cl-search-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            width: 1.125rem;
            height: 1.125rem;
        }
        .cl-search-input {
            width: 100%;
            padding: 0.5625rem 0.875rem 0.5625rem 2.5rem;
            font-size: 0.875rem;
            border-radius: 0.625rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #0f172a;
            outline: none;
            transition: all 0.15s ease;
        }
        .dark .cl-search-input {
            background: #131c2b;
            border-color: #2a3b54;
            color: #f1f5f9;
        }
        .cl-search-input:focus {
            border-color: #ff5400;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.15);
        }
        .dark .cl-search-input:focus {
            background: #182234;
        }

        .cl-filter-controls {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.625rem;
        }

        .cl-pp-select {
            padding: 0.5625rem 2rem 0.5625rem 0.875rem;
            font-size: 0.875rem;
            color: #334155;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.25em 1.25em;
            border: 1px solid #e2e8f0;
            border-radius: 0.625rem;
            appearance: none;
            outline: none;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-pp-select {
            background-color: #131c2b;
            border-color: #2a3b54;
            color: #cbd5e1;
        }
        .cl-pp-select:focus {
            border-color: #ff5400;
            box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15);
        }

        .cl-view-switcher {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 0.625rem;
            padding: 0.25rem;
            gap: 0.125rem;
        }
        .dark .cl-view-switcher {
            background: #131c2b;
        }
        .cl-view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-view-btn {
            color: #94a3b8;
        }
        .cl-view-btn.active {
            background: #ff5400;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(255, 84, 0, 0.3);
        }

        /* Data Table (List View) */
        .cl-table-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.5rem;
        }
        .dark .cl-table-container {
            background: #182234;
            border-color: #26354a;
        }
        .cl-pp-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            text-align: left;
        }
        .cl-pp-table th {
            padding: 0.75rem 0.625rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #475569;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }
        .dark .cl-pp-table th {
            background: #131c2b;
            border-color: #26354a;
            color: #94a3b8;
        }
        .cl-pp-table td {
            padding: 0.75rem 0.625rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .dark .cl-pp-table td {
            border-bottom-color: #1f2c3f;
        }
        .cl-pp-table tr:hover {
            background: #f8fafc;
        }
        .dark .cl-pp-table tr:hover {
            background: #1c273c;
        }

        .cl-service-thumb {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 0.5rem;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .dark .cl-service-thumb {
            border-color: #334155;
        }

        .cl-service-title {
            font-weight: 700;
            color: #0f172a;
            text-decoration: none;
            display: block;
            line-height: 1.35;
        }
        .dark .cl-service-title {
            color: #f1f5f9;
        }
        .cl-service-title:hover {
            color: #ff5400;
        }
        .cl-service-sub {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.125rem;
            display: block;
        }
        .dark .cl-service-sub {
            color: #94a3b8;
        }

        .cl-tag-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.6875rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .cl-price-badge {
            font-weight: 600;
            color: #1e293b;
            white-space: nowrap;
            font-size: 0.8125rem;
        }
        .dark .cl-price-badge {
            color: #f1f5f9;
        }

        .cl-table-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.25rem;
            white-space: nowrap;
        }
        .cl-action-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-action-icon-btn {
            background: #182234;
            border-color: #26354a;
            color: #94a3b8;
        }
        .cl-action-icon-btn:hover {
            transform: translateY(-1px);
        }
        .cl-action-icon-btn.edit:hover {
            color: #ff5400;
            border-color: #ff5400;
            background: #fff7ed;
        }
        .cl-action-icon-btn.copy:hover {
            color: #2563eb;
            border-color: #2563eb;
            background: #eff6ff;
        }
        .cl-action-icon-btn.delete:hover {
            color: #ef4444;
            border-color: #ef4444;
            background: #fef2f2;
        }

        /* 3-Column Grid View */
        .cl-grid-container {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 640px) {
            .cl-grid-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .cl-grid-container {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .cl-grid-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dark .cl-grid-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-grid-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.08);
        }

        .cl-grid-card-img-wrap {
            position: relative;
            width: 100%;
            height: 10rem;
            background: #0f172a;
            overflow: hidden;
        }
        .cl-grid-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .cl-grid-card:hover .cl-grid-card-img {
            transform: scale(1.04);
        }

        .cl-grid-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
            gap: 1rem;
        }

        /* Footer Pagination */
        .cl-footer-bar {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 0.5rem;
        }
        @media (min-width: 640px) {
            .cl-footer-bar {
                flex-direction: row;
            }
        }
        .cl-footer-text {
            font-size: 0.8125rem;
            color: #64748b;
        }
        .dark .cl-footer-text {
            color: #94a3b8;
        }
        .cl-pagination {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }
        .cl-page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.25rem;
            height: 2.25rem;
            padding: 0 0.5rem;
            font-size: 0.8125rem;
            font-weight: 500;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #334155;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-page-btn {
            background: #182234;
            border-color: #26354a;
            color: #cbd5e1;
        }
        .cl-page-btn:hover:not(:disabled) {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        .dark .cl-page-btn:hover:not(:disabled) {
            background: #202d42;
            border-color: #384860;
        }
        .cl-page-btn.active {
            background: #ff5400;
            border-color: #ff5400;
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(255, 84, 0, 0.3);
        }
        .cl-page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }
    </style>

    <div class="cl-pp-wrapper">
        <!-- Top Breadcrumb -->
        <div class="cl-pp-breadcrumb">
            <a href="/cuulongteam">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <span>›</span>
            <span>Kinh doanh & Khách hàng</span>
            <span>›</span>
            <span class="font-medium text-slate-800 dark:text-slate-200">Bảng giá dịch vụ</span>
        </div>

        <!-- Header Title Bar -->
        <div class="cl-pp-header">
            <div class="cl-pp-title-group">
                <div class="cl-pp-title-icon">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div class="cl-pp-title-text">
                    <h1>Bảng giá dịch vụ</h1>
                    <p>Quản lý và cập nhật bảng giá các dịch vụ của Cửu Long Media.</p>
                </div>
            </div>

            <div class="cl-pp-actions">
                <!-- Date picker display -->
                <button type="button" class="cl-btn-secondary">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $dateRange }}</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Select category header -->
                <select wire:model.live="selectedCategory" class="cl-pp-select" style="font-size: 0.8125rem; padding-top: 0.5rem; padding-bottom: 0.5rem;">
                    <option value="">Tất cả danh mục</option>
                    <option value="Website">Website</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="Truyền thông">Truyền thông</option>
                    <option value="Media">Media</option>
                    <option value="Thiết kế">Thiết kế</option>
                    <option value="Sự kiện">Sự kiện</option>
                </select>

                <!-- Filter button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span>Bộ lọc</span>
                </button>

                <!-- Primary Create Button -->
                <a href="{{ $createUrl }}" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>+ Thêm dịch vụ</span>
                </a>
            </div>
        </div>

        <!-- 4 Top KPI Cards -->
        <div class="cl-kpi-grid">
            <!-- Card 1: Tổng số dịch vụ -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #eff6ff; color: #2563eb;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Tổng số dịch vụ</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['total'] }}</span>
                        <span class="cl-kpi-trend">↑ 12%</span>
                    </div>
                    <span class="cl-kpi-subtext">Dịch vụ đang hoạt động: {{ $metrics['active'] }}</span>
                </div>
            </div>

            <!-- Card 2: Tổng doanh thu (ước tính) -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #ecfdf5; color: #059669;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Tổng doanh thu (ước tính)</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['revenue'] }}</span>
                        <span class="cl-kpi-trend">↑ 18%</span>
                    </div>
                    <span class="cl-kpi-subtext">So với tháng trước</span>
                </div>
            </div>

            <!-- Card 3: Khách hàng sử dụng -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #f5f3ff; color: #8b5cf6;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Khách hàng sử dụng</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['clients'] }}</span>
                        <span class="cl-kpi-trend">↑ 22%</span>
                    </div>
                    <span class="cl-kpi-subtext">Khách hàng mới: {{ $metrics['new_clients'] }}</span>
                </div>
            </div>

            <!-- Card 4: Dịch vụ nổi bật -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #fff7ed; color: #ff5400;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Dịch vụ nổi bật</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['featured'] }}</span>
                    </div>
                    <span class="cl-kpi-subtext">Được xem nhiều nhất</span>
                </div>
            </div>
        </div>

        <!-- Filter Toolbar -->
        <div class="cl-pp-toolbar">
            <!-- Search Box -->
            <div class="cl-search-box">
                <svg class="cl-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="cl-search-input"
                    placeholder="Tìm kiếm tên dịch vụ, danh mục, mô tả..."
                />
            </div>

            <!-- Filter Controls -->
            <div class="cl-filter-controls">
                <!-- Dropdown: Danh mục -->
                <select wire:model.live="selectedCategory" class="cl-pp-select">
                    <option value="">Danh mục</option>
                    <option value="Website">Website</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="Truyền thông">Truyền thông</option>
                    <option value="Media">Media</option>
                    <option value="Thiết kế">Thiết kế</option>
                    <option value="Sự kiện">Sự kiện</option>
                </select>

                <!-- Dropdown: Trạng thái -->
                <select wire:model.live="selectedStatus" class="cl-pp-select">
                    <option value="">Trạng thái</option>
                    <option value="active">Đang hoạt động</option>
                    <option value="inactive">Tạm dừng</option>
                </select>

                <!-- Dropdown: Mức giá -->
                <select wire:model.live="selectedPriceRange" class="cl-pp-select">
                    <option value="">Mức giá</option>
                    <option value="under_5m">Dưới 5 triệu</option>
                    <option value="5m_15m">5 – 15 triệu</option>
                    <option value="15m_30m">15 – 30 triệu</option>
                    <option value="above_30m">Trên 30 triệu</option>
                </select>

                <!-- Reset Button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Đặt lại</span>
                </button>

                <!-- View Switcher (Defaults to List active per screenshot) -->
                <div class="cl-view-switcher">
                    <button
                        type="button"
                        wire:click="setViewMode('grid')"
                        class="cl-view-btn {{ $viewMode === 'grid' ? 'active' : '' }}"
                        title="Chế độ lưới"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button
                        type="button"
                        wire:click="setViewMode('list')"
                        class="cl-view-btn {{ $viewMode === 'list' ? 'active' : '' }}"
                        title="Chế độ danh sách"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        @if($viewMode === 'list')
            <!-- Data Table (Matches Screenshot) -->
            <div class="cl-table-container">
                <div class="overflow-x-auto">
                    <table class="cl-pp-table">
                        <thead>
                            <tr>
                                <th style="width: 36px; text-align: center;">
                                    <input
                                        type="checkbox"
                                        wire:click="toggleSelectAll"
                                        {{ $selectAll ? 'checked' : '' }}
                                        class="rounded border-slate-300 text-orange-600 focus:ring-orange-500 cursor-pointer"
                                    />
                                </th>
                                <th style="width: 52px; text-align: center;">Hình ảnh</th>
                                <th wire:click="sortBy('tier_name')" style="cursor: pointer; min-width: 170px;">
                                    <div class="flex items-center gap-1.5">
                                        <span>Tên dịch vụ</span>
                                        <span class="text-xs text-slate-400">↕</span>
                                    </div>
                                </th>
                                <th style="width: 105px; white-space: nowrap;">Danh mục</th>
                                <th style="max-width: 250px;">Mô tả ngắn</th>
                                <th style="width: 145px; white-space: nowrap;">Giá bán (VNĐ)</th>
                                <th style="width: 100px; white-space: nowrap;">Trạng thái</th>
                                <th wire:click="sortBy('updated_at')" style="cursor: pointer; width: 110px; white-space: nowrap;">
                                    <div class="flex items-center gap-1.5">
                                        <span>Ngày cập nhật</span>
                                        <span class="text-xs text-slate-400">↕</span>
                                    </div>
                                </th>
                                <th style="width: 90px; text-align: right; white-space: nowrap;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plans as $item)
                                <tr>
                                    <!-- Checkbox -->
                                    <td style="text-align: center;">
                                        <input
                                            type="checkbox"
                                            wire:click="toggleSelectPlan({{ $item['id'] }})"
                                            {{ in_array($item['id'], $selectedPlans) ? 'checked' : '' }}
                                            class="rounded border-slate-300 text-orange-600 focus:ring-orange-500 cursor-pointer"
                                        />
                                    </td>

                                    <!-- Thumbnail -->
                                    <td style="text-align: center;">
                                        <img
                                            src="{{ $item['thumb_url'] }}"
                                            alt="{{ $item['tier_name'] }}"
                                            class="cl-service-thumb mx-auto"
                                            onerror="this.src='/images/services/service_card_2_webapp.png'"
                                        />
                                    </td>

                                    <!-- Service Title & Subtitle -->
                                    <td>
                                        <a href="{{ $item['edit_url'] }}" class="cl-service-title">
                                            {{ $item['tier_name'] }}
                                        </a>
                                        <span class="cl-service-sub">
                                            {{ $item['subtitle'] }}
                                        </span>
                                    </td>

                                    <!-- Category Pill -->
                                    <td>
                                        <span class="cl-tag-pill" style="background-color: {{ $item['category_bg'] }}; color: {{ $item['category_text'] }};">
                                            {{ $item['category'] }}
                                        </span>
                                    </td>

                                    <!-- Short Description -->
                                    <td>
                                        <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed" style="margin: 0;">
                                            {{ $item['description'] }}
                                        </p>
                                    </td>

                                    <!-- Price Display -->
                                    <td>
                                        <span class="cl-price-badge">
                                            {{ $item['price_display'] }}
                                        </span>
                                    </td>

                                    <!-- Status Pill -->
                                    <td>
                                        <span class="cl-tag-pill" style="background-color: {{ $item['status_bg'] }}; color: {{ $item['status_color'] }};">
                                            {{ $item['status_text'] }}
                                        </span>
                                    </td>

                                    <!-- Updated Date -->
                                    <td class="text-xs text-slate-500" style="white-space: nowrap;">
                                        {{ $item['updated_at'] }}
                                    </td>

                                    <!-- Action Buttons -->
                                    <td style="text-align: right;">
                                        <div class="cl-table-actions">
                                            <!-- Edit (orange pencil) -->
                                            <a href="{{ $item['edit_url'] }}" class="cl-action-icon-btn edit" title="Chỉnh sửa">
                                                <svg class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </a>

                                            <!-- Duplicate (blue copy icon) -->
                                            <button
                                                type="button"
                                                wire:click="duplicatePlan({{ $item['id'] }})"
                                                class="cl-action-icon-btn copy"
                                                title="Nhân bản dịch vụ"
                                            >
                                                <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </button>

                                            <!-- Delete (red trash icon) -->
                                            <button
                                                type="button"
                                                wire:click="confirmDelete({{ $item['id'] }})"
                                                class="cl-action-icon-btn delete"
                                                title="Xóa dịch vụ"
                                            >
                                                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center; padding: 3rem 1rem;" class="text-slate-400">
                                        Không tìm thấy dịch vụ nào phù hợp với bộ lọc.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Grid View (Toggleable) -->
            <div class="cl-grid-container">
                @forelse($plans as $item)
                    <div class="cl-grid-card">
                        <!-- Card Image -->
                        <div class="cl-grid-card-img-wrap">
                            <img
                                src="{{ $item['thumb_url'] }}"
                                alt="{{ $item['tier_name'] }}"
                                class="cl-grid-card-img"
                                onerror="this.src='/images/services/service_card_2_webapp.png'"
                            />
                            <div class="absolute top-3 left-3">
                                <span class="cl-tag-pill" style="background-color: {{ $item['category_bg'] }}; color: {{ $item['category_text'] }}; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                    {{ $item['category'] }}
                                </span>
                            </div>
                            @if($item['is_featured'])
                                <div class="absolute top-3 right-3">
                                    <span class="cl-tag-pill text-white" style="background-color: #ff5400; box-shadow: 0 2px 6px rgba(255,84,0,0.35);">
                                        ★ Nổi bật
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="cl-grid-body">
                            <div>
                                <a href="{{ $item['edit_url'] }}" class="text-base font-bold text-slate-900 dark:text-slate-100 hover:text-orange-600 transition block">
                                    {{ $item['tier_name'] }}
                                </a>
                                <span class="text-xs text-slate-500 block mt-1">
                                    {{ $item['subtitle'] }}
                                </span>
                                <div class="mt-3 text-lg font-bold text-orange-600 dark:text-orange-400">
                                    {{ $item['price_display'] }} <span class="text-xs font-normal text-slate-500">VNĐ</span>
                                </div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 line-clamp-2 leading-relaxed">
                                    {{ $item['description'] }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <span class="cl-tag-pill" style="background-color: {{ $item['status_bg'] }}; color: {{ $item['status_color'] }};">
                                    {{ $item['status_text'] }}
                                </span>

                                <div class="cl-table-actions">
                                    <a href="{{ $item['edit_url'] }}" class="cl-action-icon-btn edit" title="Sửa">
                                        <svg class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                    <button type="button" wire:click="duplicatePlan({{ $item['id'] }})" class="cl-action-icon-btn copy" title="Nhân bản">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="confirmDelete({{ $item['id'] }})" class="cl-action-icon-btn delete" title="Xóa">
                                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        Không tìm thấy dịch vụ nào phù hợp.
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Footer Pagination Bar -->
        <div class="cl-footer-bar">
            <div class="cl-footer-text">
                Hiển thị {{ $display['from'] }}-{{ $display['to'] }} trong tổng số {{ $display['total'] }} dịch vụ
            </div>

            @if($display['lastPage'] > 1)
                <div class="cl-pagination">
                    <!-- Prev Page -->
                    <button
                        type="button"
                        wire:click="previousPage"
                        class="cl-page-btn"
                        {{ $display['currentPage'] <= 1 ? 'disabled' : '' }}
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <!-- Page Numbers -->
                    @for($p = 1; $p <= $display['lastPage']; $p++)
                        @if($p == 1 || $p == $display['lastPage'] || abs($p - $display['currentPage']) <= 2)
                            <button
                                type="button"
                                wire:click="setPage({{ $p }})"
                                class="cl-page-btn {{ $p == $display['currentPage'] ? 'active' : '' }}"
                            >
                                {{ $p }}
                            </button>
                        @elseif($p == 2 || $p == $display['lastPage'] - 1)
                            <span class="px-1 text-slate-400">...</span>
                        @endif
                    @endfor

                    <!-- Next Page -->
                    <button
                        type="button"
                        wire:click="nextPage"
                        class="cl-page-btn"
                        {{ $display['currentPage'] >= $display['lastPage'] ? 'disabled' : '' }}
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-950/50 text-red-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Xóa dịch vụ?</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Hành động này không thể hoàn tác.</p>
                    </div>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                    Bạn có chắc chắn muốn xóa dịch vụ <span class="font-semibold text-slate-900 dark:text-slate-100">"{{ $planToDeleteTitle }}"</span>? Dịch vụ sẽ bị xóa khỏi bảng giá website.
                </p>

                <div class="flex items-center justify-end gap-3">
                    <button
                        type="button"
                        wire:click="cancelDelete"
                        class="px-4 py-2 text-xs font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 rounded-lg transition"
                    >
                        Hủy bỏ
                    </button>
                    <button
                        type="button"
                        wire:click="executeDelete"
                        class="px-4 py-2 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm shadow-red-500/20 transition"
                    >
                        Xác nhận xóa
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
