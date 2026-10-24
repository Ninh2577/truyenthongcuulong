<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $display = $this->getDisplayData();
        $cases = $display['cases'];
        $createUrl = $display['createUrl'];
    @endphp

    <style>
        .cl-cs-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-cs-wrapper {
            color: #f1f5f9;
        }

        /* Top Header */
        .cl-cs-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 1024px) {
            .cl-cs-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Breadcrumb */
        .cl-cs-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .dark .cl-cs-breadcrumb {
            color: #94a3b8;
        }
        .cl-cs-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-cs-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Title Area */
        .cl-cs-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cl-cs-title-icon {
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
        .cl-cs-title-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
            color: #0f172a;
            margin: 0;
        }
        .dark .cl-cs-title-text h1 {
            color: #f8fafc;
        }
        .cl-cs-title-text p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }
        .dark .cl-cs-title-text p {
            color: #94a3b8;
        }

        /* Top Action Buttons */
        .cl-cs-actions {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
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
            justify-content: space-between;
            align-items: center;
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

        .cl-kpi-info {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }
        .cl-kpi-header-row {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }
        .cl-kpi-icon-pill {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.625rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
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
            gap: 0.625rem;
            margin-top: 0.25rem;
        }
        .cl-kpi-value {
            font-size: 1.75rem;
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
        .cl-kpi-sparkline {
            width: 5.5rem;
            height: 2.5rem;
            flex-shrink: 0;
        }

        /* Filter Toolbar */
        .cl-cs-toolbar {
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
        .dark .cl-cs-toolbar {
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

        .cl-cs-select {
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
        .dark .cl-cs-select {
            background-color: #131c2b;
            border-color: #2a3b54;
            color: #cbd5e1;
        }
        .cl-cs-select:focus {
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

        /* 4-Column Grid Cards */
        .cl-case-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 640px) {
            .cl-case-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .cl-case-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .cl-case-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dark .cl-case-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-case-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.08);
        }

        .cl-case-img-wrap {
            position: relative;
            width: 100%;
            height: 11rem;
            background: #0f172a;
            overflow: hidden;
        }
        .cl-case-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .cl-case-card:hover .cl-case-img {
            transform: scale(1.04);
        }

        .cl-feature-badge {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.625rem;
            border-radius: 0.5rem;
            font-size: 0.6875rem;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
            letter-spacing: 0.025em;
        }

        .cl-case-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
            gap: 0.875rem;
        }

        .cl-case-title {
            font-size: 0.9375rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .dark .cl-case-title {
            color: #f8fafc;
        }
        .cl-case-title:hover {
            color: #ff5400;
        }

        .cl-case-client {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
        }
        .dark .cl-case-client {
            color: #94a3b8;
        }

        .cl-case-tags {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.375rem;
        }
        .cl-tag-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.1875rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.6875rem;
            font-weight: 600;
        }

        .cl-case-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.75rem;
            border-top: 1px solid #f1f5f9;
            font-size: 0.6875rem;
            color: #64748b;
        }
        .dark .cl-case-footer {
            border-top-color: #1e293b;
            color: #94a3b8;
        }

        .cl-case-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cl-card-actions {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .cl-card-icon-btn {
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
        .dark .cl-card-icon-btn {
            background: #182234;
            border-color: #26354a;
            color: #94a3b8;
        }
        .cl-card-icon-btn:hover {
            color: #ff5400;
            border-color: #ff5400;
            background: #fff7ed;
        }
        .dark .cl-card-icon-btn:hover {
            background: rgba(255, 84, 0, 0.15);
        }

        /* List Table View */
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
        .cl-cs-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            text-align: left;
        }
        .cl-cs-table th {
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #475569;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }
        .dark .cl-cs-table th {
            background: #131c2b;
            border-color: #26354a;
            color: #94a3b8;
        }
        .cl-cs-table td {
            padding: 0.875rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .dark .cl-cs-table td {
            border-bottom-color: #1f2c3f;
        }
        .cl-cs-table tr:hover {
            background: #f8fafc;
        }
        .dark .cl-cs-table tr:hover {
            background: #1c273c;
        }

        .cl-list-row-flex {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .cl-list-thumb {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 0.5rem;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .dark .cl-list-thumb {
            border-color: #334155;
        }
        .cl-list-title {
            font-weight: 700;
            color: #0f172a;
            text-decoration: none;
            display: block;
            line-height: 1.3;
        }
        .dark .cl-list-title {
            color: #f1f5f9;
        }
        .cl-list-title:hover {
            color: #ff5400;
        }
        .cl-list-summary {
            font-size: 0.75rem;
            color: #64748b;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 340px;
            margin-top: 2px;
        }
        .dark .cl-list-summary {
            color: #94a3b8;
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

    <div class="cl-cs-wrapper">
        <!-- Top Breadcrumb -->
        <div class="cl-cs-breadcrumb">
            <a href="/cuulongteam">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <span>›</span>
            <span>Kinh doanh & Khách hàng</span>
            <span>›</span>
            <span class="font-medium text-slate-800 dark:text-slate-200">Dự án tiêu biểu</span>
        </div>

        <!-- Header Title Bar -->
        <div class="cl-cs-header">
            <div class="cl-cs-title-group">
                <div class="cl-cs-title-icon">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="cl-cs-title-text">
                    <h1>Dự án tiêu biểu</h1>
                    <p>Quản lý các dự án tiêu biểu, case study và portfolio của Cửu Long Media.</p>
                </div>
            </div>

            <div class="cl-cs-actions">
                <!-- Date picker display -->
                <button type="button" class="cl-btn-secondary">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>01/10/2024 - 31/10/2026</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Filter button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span>Bộ lọc</span>
                </button>

                <!-- View Switcher in Header -->
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

                <!-- Primary Create Button -->
                <a href="{{ $createUrl }}" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tạo dự án tiêu biểu</span>
                </a>
            </div>
        </div>

        <!-- 4 Top KPI Cards with Sparklines -->
        <div class="cl-kpi-grid">
            <!-- Card 1: Tổng dự án -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #ff5400; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Tổng dự án</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['total'] }}</span>
                        <span class="cl-kpi-trend">Đồng bộ</span>
                    </div>
                    <span class="cl-kpi-subtext">Dự án trong hệ thống</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 35 Q 25 38, 45 25 T 75 20 T 100 8" fill="none" stroke="#ff5400" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Card 2: Dự án nổi bật -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #2563eb; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Dự án nổi bật</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['featured'] }}</span>
                        <span class="cl-kpi-trend">{{ $metrics['featured_percent'] }}%</span>
                    </div>
                    <span class="cl-kpi-subtext">Được hiển thị trang chủ</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 32 Q 25 35, 50 20 T 80 18 T 100 10" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Card 3: Khách hàng -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #059669; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Khách hàng</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['clients'] }}</span>
                        <span class="cl-kpi-trend">Thực tế</span>
                    </div>
                    <span class="cl-kpi-subtext">Khách hàng đã hợp tác</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 38 Q 30 40, 55 28 T 80 22 T 100 12" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Card 4: Danh mục dự án -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #8b5cf6; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Danh mục dự án</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['categories'] }}</span>
                        <span class="cl-kpi-trend">Nhóm</span>
                    </div>
                    <span class="cl-kpi-subtext">Danh mục đang hoạt động</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 35 Q 35 36, 65 25 T 100 15" fill="none" stroke="#8b5cf6" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Toolbar: Search, Filters, Sort, View Switcher -->
        <div class="cl-cs-toolbar">
            <!-- Search Input -->
            <div class="cl-search-box">
                <svg class="cl-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="cl-search-input"
                    placeholder="Tìm kiếm dự án theo tên, khách hàng, danh mục..."
                />
            </div>

            <!-- Filter Controls -->
            <div class="cl-filter-controls">
                <!-- Danh mục dropdown -->
                <select wire:model.live="selectedCategory" class="cl-cs-select">
                    <option value="">Danh mục</option>
                    <option value="Du lịch">Du lịch</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Công nghệ">Công nghệ</option>
                    <option value="Thương hiệu">Thương hiệu</option>
                    <option value="Giáo dục">Giáo dục</option>
                    <option value="Ẩm thực">Ẩm thực</option>
                    <option value="Sự kiện">Sự kiện</option>
                    <option value="Bất động sản">Bất động sản</option>
                </select>

                <!-- Trạng thái dropdown -->
                <select wire:model.live="selectedStatus" class="cl-cs-select">
                    <option value="">Trạng thái</option>
                    <option value="active">Đang hoạt động</option>
                    <option value="completed">Đã hoàn thành</option>
                </select>

                <!-- Nổi bật dropdown -->
                <select wire:model.live="selectedFeatured" class="cl-cs-select">
                    <option value="">Nổi bật</option>
                    <option value="featured">Nổi bật</option>
                    <option value="recommended">Đề xuất</option>
                    <option value="common">Thường gặp</option>
                </select>

                <!-- Reset button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Đặt lại</span>
                </button>

                <!-- View Switcher -->
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

        @if($viewMode === 'grid')
            <!-- 4-Column Grid View (Matches Screenshot) -->
            <div class="cl-case-grid">
                @forelse($cases as $item)
                    <div class="cl-case-card">
                        <!-- Card Image + Feature Badge -->
                        <div class="cl-case-img-wrap">
                            <img
                                src="{{ $item['thumb_url'] }}"
                                alt="{{ $item['title'] }}"
                                class="cl-case-img"
                                onerror="this.src='/images/banner_halong_bay.jpg'"
                            />
                            <div class="cl-feature-badge" style="background-color: {{ $item['feature_bg'] }};">
                                <span>★</span>
                                <span>{{ $item['feature_badge'] }}</span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="cl-case-body">
                            <div>
                                <a href="{{ $item['edit_url'] }}" class="cl-case-title">
                                    {{ $item['title'] }}
                                </a>
                                <div class="cl-case-client">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>Khách hàng: {{ $item['client_name'] }}</span>
                                </div>
                            </div>

                            <div class="cl-case-tags">
                                <span class="cl-tag-pill" style="background-color: {{ $item['category_bg'] }}; color: {{ $item['category_text'] }};">
                                    {{ $item['category'] }}
                                </span>
                                <span class="cl-tag-pill" style="background-color: {{ $item['status_bg'] }}; color: {{ $item['status_color'] }};">
                                    {{ $item['status_text'] }}
                                </span>
                            </div>

                            <!-- Footer of Card -->
                            <div class="cl-case-footer">
                                <div class="cl-case-meta">
                                    <span>📅 {{ $item['date_text'] }}</span>
                                    <span>•</span>
                                    <span>👁 {{ $item['views_text'] }}</span>
                                </div>

                                <div class="cl-card-actions">
                                    <!-- View/Preview -->
                                    <a href="{{ $item['preview_url'] }}" target="_blank" class="cl-card-icon-btn" title="Xem dự án">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ $item['edit_url'] }}" class="cl-card-icon-btn" title="Chỉnh sửa">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    <!-- More / Delete -->
                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $item['id'] }})"
                                        class="cl-card-icon-btn"
                                        title="Xóa dự án"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-base font-medium text-slate-600 dark:text-slate-300">Không tìm thấy dự án nào</p>
                        <p class="text-sm text-slate-400 mt-1">Thử thay đổi từ khóa tìm kiếm hoặc bấm Đặt lại bộ lọc.</p>
                    </div>
                @endforelse
            </div>
        @else
            <!-- List Table View -->
            <div class="cl-table-container">
                <div class="overflow-x-auto">
                    <table class="cl-cs-table">
                        <thead>
                            <tr>
                                <th>Tên dự án</th>
                                <th>Khách hàng</th>
                                <th>Danh mục</th>
                                <th style="text-align: center;">Nổi bật</th>
                                <th>Trạng thái</th>
                                <th>Lượt xem</th>
                                <th>Ngày tạo</th>
                                <th style="text-align: right;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cases as $item)
                                <tr>
                                    <td>
                                        <div class="cl-list-row-flex">
                                            <img
                                                src="{{ $item['thumb_url'] }}"
                                                alt="{{ $item['title'] }}"
                                                class="cl-list-thumb"
                                                onerror="this.src='/images/banner_halong_bay.jpg'"
                                            />
                                            <div style="min-width: 0;">
                                                <a href="{{ $item['edit_url'] }}" class="cl-list-title">
                                                    {{ $item['title'] }}
                                                </a>
                                                <span class="cl-list-summary">
                                                    {{ $item['summary'] ?: 'Dự án tiêu biểu truyền thông Cửu Long' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-slate-700 dark:text-slate-300 font-medium" style="white-space: nowrap;">
                                        {{ $item['client_name'] }}
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span class="cl-tag-pill" style="background-color: {{ $item['category_bg'] }}; color: {{ $item['category_text'] }};">
                                            {{ $item['category'] }}
                                        </span>
                                    </td>
                                    <td style="text-align: center; white-space: nowrap;">
                                        <span class="cl-tag-pill text-white" style="background-color: {{ $item['feature_bg'] }};">
                                            ★ {{ $item['feature_badge'] }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span class="cl-tag-pill" style="background-color: {{ $item['status_bg'] }}; color: {{ $item['status_color'] }};">
                                            {{ $item['status_text'] }}
                                        </span>
                                    </td>
                                    <td class="text-slate-600 dark:text-slate-400 font-medium" style="white-space: nowrap;">
                                        {{ $item['views_text'] }}
                                    </td>
                                    <td class="text-xs text-slate-500" style="white-space: nowrap;">
                                        {{ $item['date_text'] }}
                                    </td>
                                    <td style="text-align: right; white-space: nowrap;">
                                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.25rem;">
                                            <a href="{{ $item['preview_url'] }}" target="_blank" class="cl-card-icon-btn" title="Xem">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ $item['edit_url'] }}" class="cl-card-icon-btn" title="Sửa">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </a>
                                            <button type="button" wire:click="confirmDelete({{ $item['id'] }})" class="cl-card-icon-btn" title="Xóa">
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 3rem 1rem;" class="text-slate-400">
                                        Không tìm thấy dự án nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Footer Pagination Bar -->
        <div class="cl-footer-bar">
            <div class="cl-footer-text">
                Hiển thị {{ $display['from'] }}-{{ $display['to'] }} trong tổng số {{ $display['total'] }} dự án
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
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Xóa dự án tiêu biểu?</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Hành động này không thể hoàn tác.</p>
                    </div>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                    Bạn có chắc chắn muốn xóa dự án <span class="font-semibold text-slate-900 dark:text-slate-100">"{{ $caseToDeleteTitle }}"</span>? Dự án sẽ bị gỡ bỏ khỏi hệ thống và website.
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
