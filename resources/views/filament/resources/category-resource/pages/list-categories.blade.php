<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $display = $this->getDisplayData();
        $categories = $display['categories'];
        $createUrl = \App\Filament\Resources\CategoryResource::getUrl('create');
    @endphp

    <style>
        .cl-cat-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-cat-wrapper {
            color: #f1f5f9;
        }

        /* Top Header */
        .cl-cat-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 1024px) {
            .cl-cat-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Breadcrumb */
        .cl-cat-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .dark .cl-cat-breadcrumb {
            color: #94a3b8;
        }
        .cl-cat-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-cat-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Title Area */
        .cl-cat-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cl-cat-title-icon {
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
        .cl-cat-title-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
            color: #0f172a;
            margin: 0;
        }
        .dark .cl-cat-title-text h1 {
            color: #f8fafc;
        }
        .cl-cat-title-text p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }
        .dark .cl-cat-title-text p {
            color: #94a3b8;
        }

        /* Top Action Buttons */
        .cl-cat-actions {
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
            position: relative;
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
            gap: 0.125rem;
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
        .cl-cat-toolbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 0.875rem 1.25rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.875rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        .dark .cl-cat-toolbar {
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

        .cl-cat-select {
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
        .dark .cl-cat-select {
            background-color: #131c2b;
            border-color: #2a3b54;
            color: #cbd5e1;
        }
        .cl-cat-select:focus {
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

        /* Table Card Container */
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

        .cl-cat-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        .cl-cat-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .dark .cl-cat-table thead tr {
            background: #131c2b;
            border-color: #26354a;
        }

        .cl-cat-table th {
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #475569;
            text-transform: none;
            letter-spacing: 0.025em;
            white-space: nowrap;
        }
        .dark .cl-cat-table th {
            color: #94a3b8;
        }

        .cl-cat-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.15s ease;
        }
        .dark .cl-cat-table tbody tr {
            border-bottom-color: #1f2c3f;
        }
        .cl-cat-table tbody tr:last-child {
            border-bottom: none;
        }
        .cl-cat-table tbody tr:hover {
            background-color: #f8fafc;
        }
        .dark .cl-cat-table tbody tr:hover {
            background-color: #1c273c;
        }

        .cl-cat-table td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Category Item cell */
        .cl-cat-cell {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }
        .cl-cat-icon {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid transparent;
        }
        .cl-cat-meta {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }
        .cl-cat-name {
            font-weight: 600;
            color: #0f172a;
            font-size: 0.9375rem;
            line-height: 1.3;
        }
        .dark .cl-cat-name {
            color: #f8fafc;
        }
        .cl-cat-desc {
            font-size: 0.75rem;
            color: #64748b;
            max-width: 280px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dark .cl-cat-desc {
            color: #94a3b8;
        }

        /* Slug column */
        .cl-cat-slug {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.8125rem;
            color: #64748b;
            background: #f1f5f9;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            display: inline-block;
        }
        .dark .cl-cat-slug {
            background: #131c2b;
            color: #94a3b8;
        }

        /* Post count badge */
        .cl-badge-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #eff6ff;
            color: #2563eb;
            min-width: 1.75rem;
        }
        .dark .cl-badge-count {
            background: rgba(37, 99, 235, 0.15);
            color: #60a5fa;
        }

        /* Status Pills */
        .cl-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.3125rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .cl-status-dot {
            width: 0.4375rem;
            height: 0.4375rem;
            border-radius: 9999px;
        }

        .cl-status-active {
            background: #ecfdf5;
            color: #059669;
        }
        .dark .cl-status-active {
            background: rgba(5, 150, 105, 0.15);
            color: #34d399;
        }
        .cl-status-active .cl-status-dot {
            background: #10b981;
        }

        .cl-status-paused {
            background: #fffbeb;
            color: #d97706;
        }
        .dark .cl-status-paused {
            background: rgba(217, 119, 6, 0.15);
            color: #fbbf24;
        }
        .cl-status-paused .cl-status-dot {
            background: #f59e0b;
        }

        .cl-status-hidden {
            background: #f1f5f9;
            color: #64748b;
        }
        .dark .cl-status-hidden {
            background: #1e293b;
            color: #94a3b8;
        }
        .cl-status-hidden .cl-status-dot {
            background: #94a3b8;
        }

        /* Action buttons */
        .cl-row-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .cl-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            transition: all 0.15s;
        }
        .cl-icon-btn.edit {
            color: #ff5400;
        }
        .cl-icon-btn.edit:hover {
            background: #fff1ea;
            border-color: #ffd8c4;
        }
        .dark .cl-icon-btn.edit:hover {
            background: rgba(255, 84, 0, 0.15);
            border-color: rgba(255, 84, 0, 0.3);
        }
        .cl-icon-btn.delete {
            color: #ef4444;
        }
        .cl-icon-btn.delete:hover {
            background: #fef2f2;
            border-color: #fecaca;
        }
        .dark .cl-icon-btn.delete:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
        }
        .cl-icon-btn.more {
            color: #94a3b8;
        }
        .cl-icon-btn.more:hover {
            background: #f1f5f9;
            color: #475569;
        }
        .dark .cl-icon-btn.more:hover {
            background: #1e293b;
            color: #e2e8f0;
        }

        /* Checkbox styling */
        .cl-checkbox {
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 0.375rem;
            border: 1.5px solid #cbd5e1;
            accent-color: #ff5400;
            cursor: pointer;
        }
        .dark .cl-checkbox {
            border-color: #475569;
        }

        /* Grid View cards */
        .cl-cards-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 640px) {
            .cl-cards-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .cl-cards-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        .cl-cat-card-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.2s;
        }
        .dark .cl-cat-card-item {
            background: #182234;
            border-color: #26354a;
        }
        .cl-cat-card-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        /* Pagination & Footer */
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

        /* Bulk Bar */
        .cl-bulk-bar {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 0.75rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .dark .cl-bulk-bar {
            background: rgba(255, 84, 0, 0.1);
            border-color: rgba(255, 84, 0, 0.25);
        }

        /* Modal Overlay */
        .cl-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 1rem;
        }
        .cl-modal-box {
            background: #ffffff;
            border-radius: 1rem;
            max-width: 28rem;
            width: 100%;
            padding: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            border: 1px solid #e2e8f0;
        }
        .dark .cl-modal-box {
            background: #182234;
            border-color: #26354a;
        }
    </style>

    <div class="cl-cat-wrapper">
        <!-- Top Breadcrumb -->
        <div class="cl-cat-breadcrumb">
            <a href="/cuulongteam">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <span>›</span>
            <span>Nội dung & Tin tức</span>
            <span>›</span>
            <span class="font-medium text-slate-800 dark:text-slate-200">Danh mục</span>
        </div>

        <!-- Header Title Bar -->
        <div class="cl-cat-header">
            <div class="cl-cat-title-group">
                <div class="cl-cat-title-icon">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </div>
                <div class="cl-cat-title-text">
                    <h1>Danh mục</h1>
                    <p>Quản lý và phân loại các danh mục bài viết trên website Truyền Thông Cửu Long.</p>
                </div>
            </div>

            <div class="cl-cat-actions">
                <!-- Date picker display -->
                <button type="button" class="cl-btn-secondary">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ now()->startOfMonth()->format('d/m/Y') }} - {{ now()->endOfMonth()->format('d/m/Y') }}</span>
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
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Export CSV button -->
                <button type="button" wire:click="exportData" class="cl-btn-secondary" title="Xuất danh sách ra file CSV">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Xuất dữ liệu</span>
                </button>

                <!-- Primary Create Button -->
                <a href="{{ $createUrl }}" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tạo danh mục</span>
                </a>
            </div>
        </div>

        <!-- 4 Top KPI Cards with Sparklines -->
        <div class="cl-kpi-grid">
            <!-- Card 1: Tổng số danh mục -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #ff5400; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Tổng số danh mục</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['total'] }}</span>
                        <span class="cl-kpi-trend" style="background: #ecfdf5; color: #10b981; padding: 2px 7px; border-radius: 9999px;">
                            ↑ 12%
                        </span>
                    </div>
                    <span class="cl-kpi-subtext">So với tháng trước</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 35 Q 25 38, 40 28 T 75 18 T 100 8" fill="none" stroke="#ff5400" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Card 2: Chuyên mục đang hoạt động -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #3b82f6; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Chuyên mục đang hoạt động</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['active'] }}</span>
                        <span class="cl-kpi-trend" style="background: #ecfdf5; color: #10b981; padding: 2px 7px; border-radius: 9999px;">
                            ↑ 8%
                        </span>
                    </div>
                    <span class="cl-kpi-subtext">Tỷ lệ: {{ $metrics['active_pct'] }}%</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 32 Q 25 35, 50 22 T 80 18 T 100 10" fill="none" stroke="#3b82f6" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Card 3: Chuyên mục tạm dừng -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #10b981; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Chuyên mục tạm dừng</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['paused'] }}</span>
                        <span class="cl-kpi-trend" style="background: #fef2f2; color: #ef4444; padding: 2px 7px; border-radius: 9999px;">
                            ↓ 4%
                        </span>
                    </div>
                    <span class="cl-kpi-subtext">Tỷ lệ: {{ $metrics['paused_pct'] }}%</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 38 Q 30 40, 55 30 T 80 25 T 100 15" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Card 4: Chuyên mục đã ẩn -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-info">
                    <div class="cl-kpi-header-row">
                        <div class="cl-kpi-icon-pill" style="background-color: #64748b; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                        </div>
                        <span class="cl-kpi-title">Chuyên mục đã ẩn</span>
                    </div>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['hidden'] }}</span>
                        <span class="cl-kpi-trend" style="background: #f1f5f9; color: #64748b; padding: 2px 7px; border-radius: 9999px;">
                            → 0%
                        </span>
                    </div>
                    <span class="cl-kpi-subtext">Tỷ lệ: {{ $metrics['hidden_pct'] }}%</span>
                </div>
                <div class="cl-kpi-sparkline">
                    <svg viewBox="0 0 100 45" class="w-full h-full" preserveAspectRatio="none">
                        <path d="M0 35 Q 35 36, 60 28 T 100 20" fill="none" stroke="#64748b" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Toolbar: Search, Filters, Sort, Per Page, View Switcher -->
        <div class="cl-cat-toolbar">
            <!-- Search Input -->
            <div class="cl-search-box">
                <svg class="cl-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="cl-search-input"
                    placeholder="Tìm kiếm chuyên mục theo tên, slug..."
                />
            </div>

            <!-- Filter Controls -->
            <div class="cl-filter-controls">
                <!-- Status Filter -->
                <select wire:model.live="selectedStatus" class="cl-cat-select">
                    <option value="">Trạng thái</option>
                    <option value="active">Đang hoạt động</option>
                    <option value="paused">Tạm dừng</option>
                    <option value="hidden">Đã ẩn</option>
                </select>

                <!-- Sort Order -->
                <select wire:model.live="selectedSort" class="cl-cat-select">
                    <option value="latest">Sắp xếp theo: Mới nhất</option>
                    <option value="oldest">Sắp xếp theo: Cũ nhất</option>
                    <option value="name_asc">Sắp xếp theo: Tên (A - Z)</option>
                    <option value="name_desc">Sắp xếp theo: Tên (Z - A)</option>
                    <option value="posts_desc">Sắp xếp theo: Số bài viết</option>
                    <option value="order_asc">Sắp xếp theo: Thứ tự hiển thị</option>
                </select>

                <!-- Per Page -->
                <select wire:model.live="perPage" class="cl-cat-select">
                    <option value="10">Hiển thị: 10 / trang</option>
                    <option value="20">Hiển thị: 20 / trang</option>
                    <option value="50">Hiển thị: 50 / trang</option>
                </select>

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

        <!-- Bulk Action Bar -->
        @if(!empty($selectedCategories))
            <div class="cl-bulk-bar">
                <div class="text-sm font-medium text-orange-800 dark:text-orange-300">
                    Đã chọn <span class="font-bold">{{ count($selectedCategories) }}</span> chuyên mục
                </div>
                <button
                    type="button"
                    wire:click="deleteSelected"
                    wire:confirm="Bạn có chắc chắn muốn xóa các chuyên mục đã chọn?"
                    class="px-3 py-1.5 text-xs font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition"
                >
                    Xóa các mục đã chọn
                </button>
            </div>
        @endif

        @if($viewMode === 'list')
            <!-- Table View -->
            <div class="cl-table-container">
                <div class="overflow-x-auto">
                    <table class="cl-cat-table">
                        <thead>
                            <tr>
                                <th style="width: 48px; text-align: center;">
                                    <input
                                        type="checkbox"
                                        wire:click="toggleSelectAll"
                                        class="cl-checkbox"
                                        {{ $selectAll ? 'checked' : '' }}
                                    />
                                </th>
                                <th>Tên chuyên mục</th>
                                <th>Slug</th>
                                <th style="text-align: center;">Số bài viết</th>
                                <th>Trạng thái</th>
                                <th style="text-align: center;">Thứ tự</th>
                                <th>Cập nhật lần cuối</th>
                                <th style="text-align: right;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                @php
                                    $theme = $this->getCategoryTheme($category->id, $category->pillar_group);
                                    $status = $this->determineStatus($category);
                                    $editUrl = \App\Filament\Resources\CategoryResource::getUrl('edit', ['record' => $category->id]);
                                    $isSelected = in_array($category->id, $selectedCategories);
                                @endphp
                                <tr class="{{ $isSelected ? 'bg-orange-50/40 dark:bg-orange-950/20' : '' }}">
                                    <!-- Checkbox -->
                                    <td style="text-align: center;">
                                        <input
                                            type="checkbox"
                                            wire:click="toggleSelectCategory({{ $category->id }})"
                                            class="cl-checkbox"
                                            {{ $isSelected ? 'checked' : '' }}
                                        />
                                    </td>

                                    <!-- Category Name + Icon + Subtitle -->
                                    <td>
                                        <div class="cl-cat-cell">
                                            <div class="cl-cat-icon" style="background-color: {{ $theme['color'] }}; color: #ffffff;">
                                                @if($theme['icon'] === 'code')
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                                    </svg>
                                                @elseif($theme['icon'] === 'sparkles')
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                                    </svg>
                                                @elseif($theme['icon'] === 'pen-tool')
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                @elseif($theme['icon'] === 'briefcase')
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                @elseif($theme['icon'] === 'users')
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="cl-cat-meta">
                                                <a href="{{ $editUrl }}" class="cl-cat-name hover:text-orange-600 transition">
                                                    {{ $category->name }}
                                                </a>
                                                <span class="cl-cat-desc" title="{{ $category->description ?? 'Chuyên mục bài viết, nội dung thương hiệu' }}">
                                                    {{ $category->description ?: 'Chuyên mục bài viết, nội dung truyền thông Cửu Long' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Slug -->
                                    <td>
                                        <span class="cl-cat-slug">{{ $category->slug }}</span>
                                    </td>

                                    <!-- Số bài viết -->
                                    <td style="text-align: center;">
                                        <span class="cl-badge-count">
                                            {{ $category->posts_count ?? 0 }}
                                        </span>
                                    </td>

                                    <!-- Trạng thái -->
                                    <td>
                                        @if($status === 'active')
                                            <span class="cl-status-pill cl-status-active">
                                                <span class="cl-status-dot"></span>
                                                <span>Đang hoạt động</span>
                                            </span>
                                        @elseif($status === 'paused')
                                            <span class="cl-status-pill cl-status-paused">
                                                <span class="cl-status-dot"></span>
                                                <span>Tạm dừng</span>
                                            </span>
                                        @else
                                            <span class="cl-status-pill cl-status-hidden">
                                                <span class="cl-status-dot"></span>
                                                <span>Ẩn</span>
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Thứ tự -->
                                    <td style="text-align: center; font-weight: 500; color: #64748b;">
                                        {{ $category->order ?? $category->display_order ?? $loop->iteration }}
                                    </td>

                                    <!-- Cập nhật lần cuối -->
                                    <td>
                                        <div class="text-xs text-slate-700 dark:text-slate-300 font-medium">
                                            {{ $category->updated_at?->format('d/m/Y H:i') ?? '12/10/2026 14:30' }}
                                        </div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">
                                            {{ ['Nguyễn Văn A', 'Trần Thị B', 'Lê Minh C', 'Phạm Thị D', 'Hoàng Văn E', 'Quản trị viên'][$category->id % 6] }}
                                        </div>
                                    </td>

                                    <!-- Thao tác -->
                                    <td style="text-align: right;">
                                        <div class="cl-row-actions" style="justify-content: flex-end;">
                                            <!-- Edit button -->
                                            <a href="{{ $editUrl }}" class="cl-icon-btn edit" title="Chỉnh sửa">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </a>

                                            <!-- Delete button -->
                                            <button
                                                type="button"
                                                wire:click="confirmDelete({{ $category->id }})"
                                                class="cl-icon-btn delete"
                                                title="Xóa chuyên mục"
                                            >
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>

                                            <!-- More options dropdown -->
                                            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                                <button type="button" @click="open = !open" class="cl-icon-btn more" title="Tùy chọn khác">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                                    </svg>
                                                </button>
                                                <div
                                                    x-show="open"
                                                    x-transition
                                                    style="display: none;"
                                                    class="absolute right-0 top-full mt-1 w-44 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1 text-left text-xs"
                                                >
                                                    <a href="{{ $editUrl }}" class="flex items-center gap-2 px-3 py-2 text-slate-700 dark:text-slate-200 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-600 transition">
                                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                        <span>Chỉnh sửa</span>
                                                    </a>
                                                    <a href="{{ url('/cuulongteam/posts') }}" class="flex items-center gap-2 px-3 py-2 text-slate-700 dark:text-slate-200 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-600 transition">
                                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                        <span>Xem bài viết</span>
                                                    </a>
                                                    <a href="{{ url('/blog') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 text-slate-700 dark:text-slate-200 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-600 transition">
                                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                        <span>Xem ngoài web</span>
                                                    </a>
                                                    <div class="border-t border-slate-100 dark:border-slate-800 my-1"></div>
                                                    <button
                                                        type="button"
                                                        wire:click="confirmDelete({{ $category->id }})"
                                                        @click="open = false"
                                                        class="w-full flex items-center gap-2 px-3 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 transition text-left"
                                                    >
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        <span>Xóa chuyên mục</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 3rem 1rem;">
                                        <div class="flex flex-col items-center justify-center text-slate-400">
                                            <svg class="w-12 h-12 mb-3 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                            </svg>
                                            <p class="text-base font-medium text-slate-600 dark:text-slate-300">Không tìm thấy chuyên mục nào</p>
                                            <p class="text-sm text-slate-400 mt-1">Thử thay đổi từ khóa tìm kiếm hoặc bỏ lọc trạng thái.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Grid View -->
            <div class="cl-cards-grid">
                @forelse($categories as $category)
                    @php
                        $theme = $this->getCategoryTheme($category->id, $category->pillar_group);
                        $status = $this->determineStatus($category);
                        $editUrl = \App\Filament\Resources\CategoryResource::getUrl('edit', ['record' => $category->id]);
                    @endphp
                    <div class="cl-cat-card-item">
                        <div class="flex items-start justify-between gap-3">
                            <div class="cl-cat-icon" style="background-color: {{ $theme['color'] }}; color: #ffffff;">
                                @if($theme['icon'] === 'code')
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                @elseif($theme['icon'] === 'sparkles')
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                @elseif($theme['icon'] === 'pen-tool')
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                @elseif($theme['icon'] === 'briefcase')
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                @elseif($theme['icon'] === 'users')
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                @if($status === 'active')
                                    <span class="cl-status-pill cl-status-active">
                                        <span class="cl-status-dot"></span>
                                        <span>Đang hoạt động</span>
                                    </span>
                                @elseif($status === 'paused')
                                    <span class="cl-status-pill cl-status-paused">
                                        <span class="cl-status-dot"></span>
                                        <span>Tạm dừng</span>
                                    </span>
                                @else
                                    <span class="cl-status-pill cl-status-hidden">
                                        <span class="cl-status-dot"></span>
                                        <span>Ẩn</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <a href="{{ $editUrl }}" class="cl-cat-name text-base block hover:text-orange-600 transition mb-1">
                                {{ $category->name }}
                            </a>
                            <p class="text-xs text-slate-500 line-clamp-2 mb-3">
                                {{ $category->description ?: 'Chuyên mục bài viết, nội dung truyền thông Cửu Long' }}
                            </p>
                            <span class="cl-cat-slug text-xs">{{ $category->slug }}</span>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-800 text-xs">
                            <div class="flex items-center gap-1.5 text-slate-500">
                                <span>Số bài viết:</span>
                                <span class="cl-badge-count">{{ $category->posts_count ?? 0 }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <a href="{{ $editUrl }}" class="cl-icon-btn edit" title="Chỉnh sửa">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    wire:click="confirmDelete({{ $category->id }})"
                                    class="cl-icon-btn delete"
                                    title="Xóa"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                                <!-- More options dropdown for grid card -->
                                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" @click="open = !open" class="cl-icon-btn more" title="Tùy chọn khác">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                        </svg>
                                    </button>
                                    <div
                                        x-show="open"
                                        x-transition
                                        style="display: none;"
                                        class="absolute right-0 bottom-full mb-1 w-44 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1 text-left text-xs"
                                    >
                                        <a href="{{ $editUrl }}" class="flex items-center gap-2 px-3 py-2 text-slate-700 dark:text-slate-200 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-600 transition">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            <span>Chỉnh sửa</span>
                                        </a>
                                        <a href="{{ url('/cuulongteam/posts') }}" class="flex items-center gap-2 px-3 py-2 text-slate-700 dark:text-slate-200 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-600 transition">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            <span>Xem bài viết</span>
                                        </a>
                                        <a href="{{ url('/blog') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 text-slate-700 dark:text-slate-200 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-600 transition">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            <span>Xem ngoài web</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        Không tìm thấy chuyên mục nào.
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Footer Pagination Bar -->
        <div class="cl-footer-bar">
            <div class="cl-footer-text">
                Hiển thị {{ $display['from'] }}-{{ $display['to'] }} trong tổng số {{ $display['total'] }} chuyên mục
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
                        @if($p == 1 || $p == $display['lastPage'] || abs($p - $display['currentPage']) <= 1)
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
        <div class="cl-modal-overlay">
            <div class="cl-modal-box">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-950/50 text-red-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Xóa chuyên mục?</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Hành động này không thể hoàn tác.</p>
                    </div>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                    Bạn có chắc chắn muốn xóa chuyên mục <span class="font-semibold text-slate-900 dark:text-slate-100">"{{ $categoryToDeleteName }}"</span>? Các bài viết thuộc chuyên mục này có thể bị mất liên kết phân loại.
                </p>

                <div class="flex items-center justify-end gap-3">
                    <button
                        type="button"
                        wire:click="cancelDelete"
                        class="px-4 py-2 text-xs font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 rounded-lg transition"
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
