<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $display = $this->getDisplayData();
        $resources = $display['resources'];
        $createUrl = $display['createUrl'];
    @endphp

    <style>
        .cl-res-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-res-wrapper {
            color: #f1f5f9;
        }

        /* Top Header */
        .cl-res-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 1024px) {
            .cl-res-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Breadcrumb */
        .cl-res-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .dark .cl-res-breadcrumb {
            color: #94a3b8;
        }
        .cl-res-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-res-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Title Area */
        .cl-res-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cl-res-title-circle {
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            background: #fff7ed;
            border: 2px solid #ff5400;
            color: #ff5400;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.2);
            flex-shrink: 0;
        }
        .dark .cl-res-title-circle {
            background: rgba(255, 84, 0, 0.15);
            border-color: #ff5400;
            color: #ff5400;
        }
        .cl-res-title-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
            color: #0f172a;
            margin: 0;
        }
        .dark .cl-res-title-text h1 {
            color: #f8fafc;
        }
        .cl-res-title-text p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }
        .dark .cl-res-title-text p {
            color: #94a3b8;
        }

        /* Top Action Buttons */
        .cl-res-actions {
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

        /* 3 Top Metric Cards */
        .cl-metrics-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 768px) {
            .cl-metrics-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .cl-metric-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dark .cl-metric-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .cl-metric-icon-box {
            width: 3.25rem;
            height: 3.25rem;
            border-radius: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cl-metric-content {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            flex: 1;
        }
        .cl-metric-label {
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
        }
        .dark .cl-metric-label {
            color: #94a3b8;
        }
        .cl-metric-value-row {
            display: flex;
            align-items: baseline;
            gap: 0.75rem;
        }
        .cl-metric-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }
        .dark .cl-metric-value {
            color: #f8fafc;
        }
        .cl-metric-badge {
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            padding: 2px 7px;
            border-radius: 9999px;
            background: #ecfdf5;
            color: #10b981;
        }
        .dark .cl-metric-badge {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
        }
        .cl-metric-subtext {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.125rem;
        }
        .dark .cl-metric-subtext {
            color: #94a3b8;
        }

        /* Toolbar */
        .cl-res-toolbar {
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
        .dark .cl-res-toolbar {
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

        .cl-res-select {
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
        .dark .cl-res-select {
            background-color: #131c2b;
            border-color: #2a3b54;
            color: #cbd5e1;
        }
        .cl-res-select:focus {
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

        .cl-res-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        .cl-res-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .dark .cl-res-table thead tr {
            background: #131c2b;
            border-color: #26354a;
        }

        .cl-res-table th {
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #475569;
            letter-spacing: 0.025em;
            white-space: nowrap;
        }
        .dark .cl-res-table th {
            color: #94a3b8;
        }

        .cl-res-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.15s ease;
        }
        .dark .cl-res-table tbody tr {
            border-bottom-color: #1f2c3f;
        }
        .cl-res-table tbody tr:last-child {
            border-bottom: none;
        }
        .cl-res-table tbody tr:hover {
            background-color: #f8fafc;
        }
        .dark .cl-res-table tbody tr:hover {
            background-color: #1c273c;
        }

        .cl-res-table td {
            padding: 0.875rem 0.75rem;
            vertical-align: middle;
        }

        /* Resource title + thumbnail cell */
        .cl-res-info-cell {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }
        .cl-res-thumb {
            width: 3.25rem;
            height: 3.25rem;
            border-radius: 0.625rem;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .dark .cl-res-thumb {
            border-color: #2a3b54;
        }
        .cl-res-text {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }
        .cl-res-name {
            font-weight: 600;
            color: #0f172a;
            font-size: 0.9375rem;
            line-height: 1.3;
        }
        .dark .cl-res-name {
            color: #f8fafc;
        }
        .cl-res-desc {
            font-size: 0.75rem;
            color: #64748b;
            max-width: 260px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dark .cl-res-desc {
            color: #94a3b8;
        }

        /* Type Badge */
        .cl-type-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.25rem 0.625rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 600;
            border: 1px solid transparent;
        }

        /* File cell */
        .cl-file-cell {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #334155;
            font-family: inherit;
        }
        .dark .cl-file-cell {
            color: #cbd5e1;
        }
        .cl-file-icon {
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Status Pills */
        .cl-status-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
        }
        .cl-status-active {
            background: #ecfdf5;
            color: #059669;
        }
        .dark .cl-status-active {
            background: rgba(5, 150, 105, 0.15);
            color: #34d399;
        }

        .cl-status-pending {
            background: #fffbeb;
            color: #d97706;
        }
        .dark .cl-status-pending {
            background: rgba(217, 119, 6, 0.15);
            color: #fbbf24;
        }

        .cl-status-hidden {
            background: #f1f5f9;
            color: #64748b;
        }
        .dark .cl-status-hidden {
            background: #1e293b;
            color: #94a3b8;
        }

        /* Action buttons */
        .cl-row-actions {
            display: flex;
            align-items: center;
            gap: 0.375rem;
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
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s;
        }
        .cl-icon-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
        .dark .cl-icon-btn:hover {
            background: #1e293b;
            color: #f8fafc;
        }
        .cl-icon-btn.edit:hover {
            color: #ff5400;
            background: #fff7ed;
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
        .cl-res-card-item {
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
        .dark .cl-res-card-item {
            background: #182234;
            border-color: #26354a;
        }
        .cl-res-card-item:hover {
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

        /* Sticky Support Bubble */
        .cl-support-float {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
            padding: 0.5rem 1rem 0.5rem 0.625rem;
            display: flex;
            align-items: center;
            gap: 0.625rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            z-index: 50;
            text-decoration: none;
            transition: all 0.2s;
        }
        .dark .cl-support-float {
            background: #182234;
            border-color: #26354a;
        }
        .cl-support-float:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(255, 84, 0, 0.2);
            border-color: #ff5400;
        }
        .cl-support-icon {
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            background: #ff5400;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .cl-support-text {
            display: flex;
            flex-direction: column;
        }
        .cl-support-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #0f172a;
        }
        .dark .cl-support-title {
            color: #f8fafc;
        }
        .cl-support-sub {
            font-size: 0.6875rem;
            color: #64748b;
        }
        .dark .cl-support-sub {
            color: #94a3b8;
        }
    </style>

    <div class="cl-res-wrapper">
        <!-- Top Breadcrumb -->
        <div class="cl-res-breadcrumb">
            <a href="/cuulongteam">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <span>›</span>
            <span>Nội dung & Tin tức</span>
            <span>›</span>
            <span class="font-medium text-slate-800 dark:text-slate-200">Tài nguyên</span>
        </div>

        <!-- Header Title Bar -->
        <div class="cl-res-header">
            <div class="cl-res-title-group">
                <div class="cl-res-title-circle">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
                <div class="cl-res-title-text">
                    <h1>Tài nguyên</h1>
                    <p>Quản lý thư viện tài nguyên, file download và các tài liệu hữu ích cho người dùng.</p>
                </div>
            </div>

            <div class="cl-res-actions">
                <!-- Date picker display -->
                <button type="button" class="cl-btn-secondary">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>01/10/2026 - 31/10/2026</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Filter type quick dropdown -->
                <select wire:model.live="selectedType" class="cl-btn-secondary" style="appearance: none; -webkit-appearance: none; padding-right: 2rem; background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'%3e%3cpath stroke=\'%2364748b\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M6 8l4 4 4-4\'/%3e%3c/svg%3e'); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.25em 1.25em;">
                    <option value="">Tất cả loại</option>
                    <option value="pdf">PDF</option>
                    <option value="image">Hình ảnh</option>
                    <option value="video">Video</option>
                    <option value="other">Khác</option>
                </select>

                <!-- Primary Create Button -->
                <a href="{{ $createUrl }}" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Thêm tài nguyên</span>
                </a>
            </div>
        </div>

        <!-- 3 Top Metric Cards -->
        <div class="cl-metrics-grid">
            <!-- Card 1: Tổng tài nguyên -->
            <div class="cl-metric-card">
                <div class="cl-metric-icon-box" style="background-color: #2563eb; color: #ffffff;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                </div>
                <div class="cl-metric-content">
                    <span class="cl-metric-label">Tổng tài nguyên</span>
                    <div class="cl-metric-value-row">
                        <span class="cl-metric-value">{{ $metrics['total'] }}</span>
                        <span class="cl-metric-badge">↑ 12%</span>
                    </div>
                    <span class="cl-metric-subtext">Tài liệu, file, hình ảnh, video</span>
                </div>
            </div>

            <!-- Card 2: Tổng lượt tải -->
            <div class="cl-metric-card">
                <div class="cl-metric-icon-box" style="background-color: #059669; color: #ffffff;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="cl-metric-content">
                    <span class="cl-metric-label">Tổng lượt tải</span>
                    <div class="cl-metric-value-row">
                        <span class="cl-metric-value">{{ $metrics['downloads'] }}</span>
                        <span class="cl-metric-badge">↑ 24%</span>
                    </div>
                    <span class="cl-metric-subtext">Lượt tải trong 30 ngày</span>
                </div>
            </div>

            <!-- Card 3: Dung lượng lưu trữ -->
            <div class="cl-metric-card">
                <div class="cl-metric-icon-box" style="background-color: #8b5cf6; color: #ffffff;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </div>
                <div class="cl-metric-content">
                    <span class="cl-metric-label">Dung lượng lưu trữ</span>
                    <div class="cl-metric-value-row">
                        <span class="cl-metric-value">{{ $metrics['storage'] }}</span>
                        <span class="cl-metric-badge">↑ 8%</span>
                    </div>
                    <span class="cl-metric-subtext">Đã sử dụng / Tổng dung lượng</span>
                </div>
            </div>
        </div>

        <!-- Toolbar: Search, Filters, Sort, View Switcher -->
        <div class="cl-res-toolbar">
            <!-- Search Input -->
            <div class="cl-search-box">
                <svg class="cl-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="cl-search-input"
                    placeholder="Tìm kiếm tài nguyên theo tên, mô tả, từ khóa..."
                />
            </div>

            <!-- Filter Controls -->
            <div class="cl-filter-controls">
                <!-- Type Filter -->
                <select wire:model.live="selectedType" class="cl-res-select">
                    <option value="">Loại tài nguyên</option>
                    <option value="pdf">PDF</option>
                    <option value="image">Hình ảnh</option>
                    <option value="video">Video</option>
                    <option value="other">Khác</option>
                </select>

                <!-- Status Filter -->
                <select wire:model.live="selectedStatus" class="cl-res-select">
                    <option value="">Trạng thái</option>
                    <option value="published">Đang hoạt động</option>
                    <option value="draft">Chờ duyệt</option>
                    <option value="hidden">Đã ẩn</option>
                </select>

                <!-- Size Filter -->
                <select wire:model.live="selectedSize" class="cl-res-select">
                    <option value="">Kích thước file</option>
                    <option value="small">&lt; 5 MB</option>
                    <option value="medium">5 MB - 50 MB</option>
                    <option value="large">&gt; 50 MB</option>
                </select>

                <!-- Reset / Filter button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span>Bộ lọc</span>
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

        <!-- Bulk Action Bar -->
        @if(!empty($selectedResources))
            <div class="bg-orange-50 border border-orange-200 dark:bg-orange-950/20 dark:border-orange-800/40 rounded-xl p-3 mb-4 flex items-center justify-between">
                <div class="text-sm font-medium text-orange-800 dark:text-orange-300">
                    Đã chọn <span class="font-bold">{{ count($selectedResources) }}</span> tài nguyên
                </div>
                <button
                    type="button"
                    wire:click="deleteSelected"
                    wire:confirm="Bạn có chắc chắn muốn xóa các tài nguyên đã chọn?"
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
                    <table class="cl-res-table">
                        <thead>
                            <tr>
                                <th style="width: 44px; text-align: center;">
                                    <input
                                        type="checkbox"
                                        wire:click="toggleSelectAll"
                                        class="cl-checkbox"
                                        {{ $selectAll ? 'checked' : '' }}
                                    />
                                </th>
                                <th>
                                    <div class="inline-flex items-center gap-1 cursor-pointer" wire:click="$set('selectedSort', 'title_asc')">
                                        <span>Tên tài nguyên</span>
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </th>
                                <th style="text-align: center;">Loại</th>
                                <th>File</th>
                                <th>Kích thước</th>
                                <th style="text-align: center;">Lượt tải</th>
                                <th>Trạng thái</th>
                                <th>
                                    <div class="inline-flex items-center gap-1 cursor-pointer" wire:click="$set('selectedSort', 'latest')">
                                        <span>Cập nhật</span>
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </th>
                                <th style="text-align: right;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($resources as $res)
                                @php
                                    $isSelected = in_array($res['id'], $selectedResources);
                                    $file = $res['file_info'];
                                @endphp
                                <tr class="{{ $isSelected ? 'bg-orange-50/40 dark:bg-orange-950/20' : '' }}">
                                    <!-- Checkbox -->
                                    <td style="text-align: center;">
                                        <input
                                            type="checkbox"
                                            wire:click="toggleSelectResource({{ $res['id'] }})"
                                            class="cl-checkbox"
                                            {{ $isSelected ? 'checked' : '' }}
                                        />
                                    </td>

                                    <!-- Resource Name + Thumbnail + Description -->
                                    <td>
                                        <div class="cl-res-info-cell">
                                            <img
                                                src="{{ $res['thumbnail_url'] }}"
                                                alt="{{ $res['title'] }}"
                                                class="cl-res-thumb"
                                                onerror="this.src='/images/banner_halong_bay.jpg'"
                                            />
                                            <div class="cl-res-text">
                                                <a href="{{ $res['edit_url'] }}" class="cl-res-name hover:text-orange-600 transition">
                                                    {{ $res['title'] }}
                                                </a>
                                                <span class="cl-res-desc" title="{{ $res['summary'] }}">
                                                    {{ $res['summary'] ?: 'Tài liệu hướng dẫn chi tiết cách sử dụng...' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Type Pill Badge -->
                                    <td style="text-align: center;">
                                        <span class="cl-type-badge" style="background-color: {{ $file['badge_bg'] }}; color: {{ $file['badge_text'] }}; border-color: {{ $file['badge_border'] }};">
                                            {{ $file['type_label'] }}
                                        </span>
                                    </td>

                                    <!-- File info + Icon -->
                                    <td>
                                        <div class="cl-file-cell" title="{{ $file['file_name'] }}">
                                            <span style="width: 24px; height: 24px; border-radius: 6px; background-color: {{ $file['icon_color'] }}; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
                                                @if($file['icon'] === 'pdf')
                                                    <!-- PDF Icon -->
                                                    <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 2l5 5h-5V4zM8 17v-4h2a2 2 0 110 4H8zm6 0h-2v-4h2a2 2 0 110 4zm4-2h-1v2h-1.5v-4H18v2z"/>
                                                    </svg>
                                                @elseif($file['icon'] === 'video')
                                                    <!-- Video Icon -->
                                                    <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M4 6.75A2.75 2.75 0 016.75 4h10.5A2.75 2.75 0 0120 6.75v10.5A2.75 2.75 0 0117.25 20H6.75A2.75 2.75 0 014 17.25V6.75zM10 8.5v7l6-3.5-6-3.5z"/>
                                                    </svg>
                                                @else
                                                    <!-- Zip Icon -->
                                                    <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                                    </svg>
                                                @endif
                                            </span>
                                            <span style="max-width: 170px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: inline-block; font-size: 0.8125rem;">
                                                {{ $file['file_name'] }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Kích thước -->
                                    <td class="text-slate-600 dark:text-slate-400 font-medium">
                                        {{ $file['size_text'] }}
                                    </td>

                                    <!-- Lượt tải -->
                                    <td style="text-align: center; font-weight: 600; color: #334155;" class="dark:text-slate-300">
                                        {{ $res['views'] }}
                                    </td>

                                    <!-- Trạng thái -->
                                    <td>
                                        @if($res['status'] === 'published')
                                            <span class="cl-status-pill cl-status-active">Đang hoạt động</span>
                                        @elseif($res['status'] === 'draft')
                                            <span class="cl-status-pill cl-status-pending">Chờ duyệt</span>
                                        @else
                                            <span class="cl-status-pill cl-status-hidden">Đã ẩn</span>
                                        @endif
                                    </td>

                                    <!-- Cập nhật -->
                                    <td>
                                        <div class="text-xs text-slate-700 dark:text-slate-300 font-medium">
                                            {{ $res['updated_at'] }}
                                        </div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">
                                            {{ $res['author_name'] }}
                                        </div>
                                    </td>

                                    <!-- Thao tác -->
                                    <td style="text-align: right;">
                                        <div class="cl-row-actions" style="justify-content: flex-end;">
                                            <!-- Preview / Download -->
                                            <a href="{{ $res['preview_url'] }}" target="_blank" class="cl-icon-btn" title="Xem trước tài nguyên">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ $res['edit_url'] }}" class="cl-icon-btn edit" title="Chỉnh sửa">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </a>

                                            <!-- Copy Link -->
                                            <button
                                                type="button"
                                                class="cl-icon-btn"
                                                title="Sao chép liên kết"
                                                onclick="navigator.clipboard.writeText('{{ $res['preview_url'] }}'); alert('Đã sao chép liên kết tài nguyên!');"
                                            >
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                </svg>
                                            </button>

                                            <!-- More / Delete -->
                                            <button
                                                type="button"
                                                wire:click="confirmDelete({{ $res['id'] }})"
                                                class="cl-icon-btn"
                                                title="Tùy chọn khác"
                                            >
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center; padding: 3rem 1rem;">
                                        <div class="flex flex-col items-center justify-center text-slate-400">
                                            <svg class="w-12 h-12 mb-3 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                            </svg>
                                            <p class="text-base font-medium text-slate-600 dark:text-slate-300">Không tìm thấy tài nguyên nào</p>
                                            <p class="text-sm text-slate-400 mt-1">Thử thay đổi từ khóa tìm kiếm hoặc bỏ lọc các điều kiện.</p>
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
                @forelse($resources as $res)
                    @php
                        $file = $res['file_info'];
                    @endphp
                    <div class="cl-res-card-item">
                        <div class="relative overflow-hidden rounded-xl h-44 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                            <img
                                src="{{ $res['thumbnail_url'] }}"
                                alt="{{ $res['title'] }}"
                                class="w-full h-full object-cover"
                                onerror="this.src='/images/banner_halong_bay.jpg'"
                            />
                            <div class="absolute top-2.5 right-2.5">
                                <span class="cl-type-badge shadow-sm" style="background-color: {{ $file['badge_bg'] }}; color: {{ $file['badge_text'] }}; border-color: {{ $file['badge_border'] }};">
                                    {{ $file['type_label'] }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <a href="{{ $res['edit_url'] }}" class="cl-res-name text-base block hover:text-orange-600 transition mb-1">
                                {{ $res['title'] }}
                            </a>
                            <p class="text-xs text-slate-500 line-clamp-2 mb-2">
                                {{ $res['summary'] ?: 'Tài liệu hướng dẫn chi tiết cách sử dụng...' }}
                            </p>
                            <div class="flex items-center gap-2 text-xs text-slate-500">
                                <span>{{ $file['file_name'] }}</span>
                                <span>•</span>
                                <span class="font-medium text-slate-700 dark:text-slate-300">{{ $file['size_text'] }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-800 text-xs">
                            <div class="flex items-center gap-1.5 text-slate-500">
                                <span>Lượt tải:</span>
                                <span class="font-bold text-slate-800 dark:text-slate-200">{{ $res['views'] }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <a href="{{ $res['edit_url'] }}" class="cl-icon-btn edit" title="Chỉnh sửa">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    wire:click="confirmDelete({{ $res['id'] }})"
                                    class="cl-icon-btn"
                                    title="Xóa"
                                >
                                    <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        Không tìm thấy tài nguyên nào.
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Footer Pagination Bar -->
        <div class="cl-footer-bar">
            <div class="cl-footer-text">
                Hiển thị {{ $display['from'] }}–{{ $display['to'] }} trong tổng số {{ $display['total'] }} tài nguyên
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

    <!-- Sticky Help Bubble (Bottom Right) -->
    <a href="#" class="cl-support-float" title="Tài liệu hướng dẫn quản trị hệ thống">
        <div class="cl-support-icon">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <div class="cl-support-text">
            <span class="cl-support-title">Cần hỗ trợ?</span>
            <span class="cl-support-sub">Tài liệu hướng dẫn quản trị hệ thống</span>
        </div>
        <svg class="w-4 h-4 text-slate-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </a>

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
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Xóa tài nguyên?</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Hành động này không thể hoàn tác.</p>
                    </div>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                    Bạn có chắc chắn muốn xóa tài nguyên <span class="font-semibold text-slate-900 dark:text-slate-100">"{{ $resourceToDeleteName }}"</span> khỏi hệ thống?
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
