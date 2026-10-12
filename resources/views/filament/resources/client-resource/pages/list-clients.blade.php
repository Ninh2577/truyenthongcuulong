<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $display = $this->getDisplayData();
        $clients = $display['clients'];
        $createUrl = $display['createUrl'];
        $availableIndustries = \App\Models\Client::all()->pluck('industry_label')->unique()->filter()->values();
    @endphp

    <style>
        .cl-client-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-client-wrapper {
            color: #f1f5f9;
        }

        /* Top Header */
        .cl-client-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 1024px) {
            .cl-client-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Breadcrumb */
        .cl-client-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .dark .cl-client-breadcrumb {
            color: #94a3b8;
        }
        .cl-client-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-client-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Title Area */
        .cl-client-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cl-client-title-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
            color: #0f172a;
            margin: 0;
        }
        .dark .cl-client-title-text h1 {
            color: #f8fafc;
        }
        .cl-client-title-text p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }
        .dark .cl-client-title-text p {
            color: #94a3b8;
        }

        /* Top Action Buttons */
        .cl-client-actions {
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
            justify-content: space-between;
            position: relative;
            overflow: hidden;
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

        .cl-kpi-left-wrap {
            display: flex;
            align-items: center;
            gap: 1rem;
            z-index: 2;
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

        .cl-kpi-right-art {
            width: 3.5rem;
            height: 3.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.35;
            flex-shrink: 0;
            z-index: 1;
        }

        /* Filter Toolbar */
        .cl-client-toolbar {
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
        .dark .cl-client-toolbar {
            background: #182234;
            border-color: #26354a;
        }

        .cl-search-box {
            position: relative;
            flex: 1 1 300px;
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

        .cl-select-input {
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
        .dark .cl-select-input {
            background-color: #131c2b;
            border-color: #2a3b54;
            color: #cbd5e1;
        }
        .cl-select-input:focus {
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

        /* 4-Column Grid View of Client Cards */
        .cl-client-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 640px) {
            .cl-client-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .cl-client-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .cl-client-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }
        .dark .cl-client-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-client-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.08);
        }

        /* Card Header with Logo Box and Background Photo */
        .cl-client-card-header {
            position: relative;
            width: 100%;
            height: 5.75rem;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 0.875rem;
            overflow: hidden;
        }
        .cl-client-bg-photo {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 68%;
            object-fit: cover;
            opacity: 0.85;
            mask-image: linear-gradient(to right, transparent 0%, black 35%);
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 35%);
        }
        .cl-client-logo-box {
            position: relative;
            z-index: 2;
            width: 5.5rem;
            height: 2.75rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.625rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.375rem 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }
        .dark .cl-client-logo-box {
            background: #1e293b;
            border-color: #334155;
        }
        .cl-client-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* Card Body */
        .cl-client-card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
            gap: 0.875rem;
        }

        .cl-rating-stars {
            display: flex;
            align-items: center;
            gap: 0.125rem;
            color: #f59e0b;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .cl-client-quote {
            font-size: 0.75rem;
            line-height: 1.5;
            color: #475569;
            font-style: italic;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: 0;
            position: relative;
            padding-left: 0.875rem;
        }
        .dark .cl-client-quote {
            color: #cbd5e1;
        }
        .cl-client-quote::before {
            content: '“';
            position: absolute;
            left: 0;
            top: -0.25rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: #94a3b8;
            font-style: normal;
        }

        /* Representative Row */
        .cl-rep-row {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            margin-top: 0.25rem;
        }
        .cl-rep-avatar {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 9999px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .dark .cl-rep-avatar {
            border-color: #334155;
        }
        .cl-rep-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .cl-rep-name {
            font-size: 0.8125rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.25;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dark .cl-rep-name {
            color: #f8fafc;
        }
        .cl-rep-role {
            font-size: 0.6875rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 1px;
        }
        .dark .cl-rep-role {
            color: #94a3b8;
        }

        /* Card Footer */
        .cl-client-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.625rem;
            border-top: 1px solid #f1f5f9;
            font-size: 0.6875rem;
        }
        .dark .cl-client-card-footer {
            border-top-color: #1e293b;
        }

        .cl-tag-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.6875rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .cl-date-text {
            color: #94a3b8;
            font-size: 0.6875rem;
        }

        .cl-card-quick-actions {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .cl-card-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.5rem;
            height: 1.5rem;
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
        .cl-client-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8125rem;
            text-align: left;
        }
        .cl-client-table th {
            padding: 0.75rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #475569;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }
        .dark .cl-client-table th {
            background: #131c2b;
            border-color: #26354a;
            color: #94a3b8;
        }
        .cl-client-table td {
            padding: 0.75rem 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .dark .cl-client-table td {
            border-bottom-color: #1f2c3f;
        }
        .cl-client-table tr:hover {
            background: #f8fafc;
        }
        .dark .cl-client-table tr:hover {
            background: #1c273c;
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

    <div class="cl-client-wrapper">
        <!-- Top Breadcrumb -->
        <div class="cl-client-breadcrumb">
            <a href="/cuulongteam">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <span>›</span>
            <span>Kinh doanh & Khách hàng</span>
            <span>›</span>
            <span class="font-medium text-slate-800 dark:text-slate-200">Khách hàng tiêu biểu</span>
        </div>

        <!-- Header Title Bar -->
        <div class="cl-client-header">
            <div class="cl-client-title-group">
                <div class="cl-client-title-text">
                    <h1>Khách Hàng Tiêu Biểu</h1>
                    <p>Những khách hàng đã tin tưởng và đồng hành cùng Cửu Long Media.</p>
                </div>
            </div>

            <div class="cl-client-actions">
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

                <!-- Select Industry Header -->
                <select wire:model.live="selectedIndustry" class="cl-select-input" style="font-size: 0.8125rem; padding-top: 0.5rem; padding-bottom: 0.5rem;">
                    <option value="">Tất cả lĩnh vực</option>
                    @foreach($availableIndustries as $ind)
                        <option value="{{ $ind }}">{{ $ind }}</option>
                    @endforeach
                </select>

                <!-- Primary Create Button -->
                <a href="{{ $createUrl }}" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>+ Thêm khách hàng</span>
                </a>
            </div>
        </div>

        <!-- 4 Top KPI Cards -->
        <div class="cl-kpi-grid">
            <!-- Card 1: Tổng khách hàng tiêu biểu -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left-wrap">
                    <div class="cl-kpi-icon-pill" style="background-color: #2563eb; color: #ffffff;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-info">
                        <span class="cl-kpi-title">Tổng khách hàng tiêu biểu</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-value">{{ $metrics['total'] }}</span>
                            <span class="cl-kpi-trend">↑ 22%</span>
                        </div>
                        <span class="cl-kpi-subtext">So với tháng trước</span>
                    </div>
                </div>
                <div class="cl-kpi-right-art text-blue-500">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 16v-1a4 4 0 00-3-3.87A5.97 5.97 0 0114 15v1h2zM4 16v-1c0-.73.2-1.41.54-2A4 4 0 001 15v1h3z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 2: Khách hàng mới -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left-wrap">
                    <div class="cl-kpi-icon-pill" style="background-color: #059669; color: #ffffff;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-info">
                        <span class="cl-kpi-title">Khách hàng mới</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-value">{{ $metrics['new'] }}</span>
                            <span class="cl-kpi-trend">↑ 16%</span>
                        </div>
                        <span class="cl-kpi-subtext">So với tháng trước</span>
                    </div>
                </div>
                <div class="cl-kpi-right-art text-emerald-500">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>

            <!-- Card 3: Tỷ lệ hài lòng -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left-wrap">
                    <div class="cl-kpi-icon-pill" style="background-color: #a855f7; color: #ffffff;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-info">
                        <span class="cl-kpi-title">Tỷ lệ hài lòng</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-value">{{ $metrics['satisfaction'] }}</span>
                            <span class="cl-kpi-trend">↑ 5%</span>
                        </div>
                        <span class="cl-kpi-subtext">Dựa trên đánh giá</span>
                    </div>
                </div>
                <div class="cl-kpi-right-art text-purple-400">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <!-- Card 4: Lĩnh vực tiêu biểu -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left-wrap">
                    <div class="cl-kpi-icon-pill" style="background-color: #ff5400; color: #ffffff;">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-info">
                        <span class="cl-kpi-title">Lĩnh vực tiêu biểu</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-value">{{ $metrics['industries'] }}</span>
                            <span class="cl-kpi-trend">↑ 33%</span>
                        </div>
                        <span class="cl-kpi-subtext">Ngành nghề khác nhau</span>
                    </div>
                </div>
                <div class="cl-kpi-right-art text-orange-400">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Filter Toolbar -->
        <div class="cl-client-toolbar">
            <!-- Search Input -->
            <div class="cl-search-box">
                <svg class="cl-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="cl-search-input"
                    placeholder="Tìm kiếm tên khách hàng, lĩnh vực, dự án, từ khóa..."
                />
            </div>

            <!-- Filter Controls -->
            <div class="cl-filter-controls">
                <!-- Dropdown: Lĩnh vực -->
                <select wire:model.live="selectedIndustry" class="cl-select-input">
                    <option value="">Lĩnh vực (Tất cả)</option>
                    @foreach($availableIndustries as $ind)
                        <option value="{{ $ind }}">{{ $ind }}</option>
                    @endforeach
                </select>

                <!-- Dropdown: Trạng thái -->
                <select wire:model.live="selectedStatus" class="cl-select-input">
                    <option value="">Trạng thái</option>
                    <option value="active">Đang hợp tác</option>
                    <option value="inactive">Tạm dừng</option>
                </select>

                <!-- Reset Button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Đặt lại</span>
                </button>

                <!-- View Switcher (Defaults to Grid active per screenshot) -->
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
            <!-- 4-Column Grid View (Matches User Screenshot) -->
            <div class="cl-client-grid">
                @forelse($clients as $item)
                    <div class="cl-client-card">
                        <!-- Top Header with Logo Box and Background Photo -->
                        <div class="cl-client-card-header">
                            <div class="cl-client-logo-box">
                                <img
                                    src="{{ $item['logo_url'] }}"
                                    alt="{{ $item['name'] }}"
                                    class="cl-client-logo-img"
                                    onerror="this.src='/images/logoKhachHang/1.png'"
                                />
                            </div>
                            <img
                                src="{{ $item['banner_url'] }}"
                                alt="{{ $item['name'] }} Project"
                                class="cl-client-bg-photo"
                                onerror="this.src='/images/modern_tech_platform.jpg'"
                            />
                        </div>

                        <!-- Card Body -->
                        <div class="cl-client-card-body">
                            <!-- Star Rating -->
                            <div class="cl-rating-stars">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>

                            <!-- Testimonial Quote -->
                            <p class="cl-client-quote">
                                {{ $item['description'] }}
                            </p>

                            <!-- Representative Row -->
                            <div class="cl-rep-row">
                                <img
                                    src="{{ $item['representative_avatar'] }}"
                                    alt="{{ $item['representative_name'] }}"
                                    class="cl-rep-avatar"
                                    onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=ff5400&color=fff'"
                                />
                                <div class="cl-rep-info">
                                    <span class="cl-rep-name">
                                        {{ $item['representative_name'] }}
                                    </span>
                                    <span class="cl-rep-role">
                                        {{ $item['representative_role'] }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="cl-client-card-footer">
                                <span class="cl-tag-pill" style="background-color: {{ $item['industry_bg'] }}; color: {{ $item['industry_text'] }};">
                                    {{ $item['industry'] }}
                                </span>

                                <div class="flex items-center gap-2">
                                    <span class="cl-date-text">{{ $item['date_text'] }}</span>
                                    <div class="cl-card-quick-actions">
                                        <a href="{{ $item['edit_url'] }}" class="cl-card-icon-btn" title="Chỉnh sửa">
                                            <svg class="w-3 h-3 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>
                                        <button type="button" wire:click="confirmDelete({{ $item['id'] }})" class="cl-card-icon-btn" title="Xóa">
                                            <svg class="w-3 h-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        Không tìm thấy khách hàng nào phù hợp với bộ lọc.
                    </div>
                @endforelse
            </div>
        @else
            <!-- List Table View (Toggleable) -->
            <div class="cl-table-container">
                <div class="overflow-x-auto">
                    <table class="cl-client-table">
                        <thead>
                            <tr>
                                <th style="width: 5rem; text-align: center;">Logo</th>
                                <th style="min-width: 180px;">Tên khách hàng</th>
                                <th style="width: 120px;">Lĩnh vực</th>
                                <th style="min-width: 220px;">Lời nhận xét / Đánh giá</th>
                                <th style="min-width: 180px;">Người đại diện</th>
                                <th style="width: 110px;">Trạng thái</th>
                                <th style="width: 100px;">Ngày tạo</th>
                                <th style="width: 90px; text-align: right;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $item)
                                <tr>
                                    <td style="text-align: center;">
                                        <div class="w-12 h-8 mx-auto bg-white dark:bg-slate-800 rounded border border-slate-200 dark:border-slate-700 flex items-center justify-center p-1">
                                            <img
                                                src="{{ $item['logo_url'] }}"
                                                alt="{{ $item['name'] }}"
                                                class="max-w-full max-h-full object-contain"
                                                onerror="this.src='/images/logoKhachHang/1.png'"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ $item['edit_url'] }}" class="font-bold text-slate-900 dark:text-slate-100 hover:text-orange-600 transition block">
                                            {{ $item['name'] }}
                                        </a>
                                        <span class="text-xs text-slate-500">
                                            {{ $item['service_used'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="cl-tag-pill" style="background-color: {{ $item['industry_bg'] }}; color: {{ $item['industry_text'] }};">
                                            {{ $item['industry'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 italic" style="margin: 0;">
                                            “{{ $item['description'] }}”
                                        </p>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <img src="{{ $item['representative_avatar'] }}" class="w-7 h-7 rounded-full border border-slate-200" alt="" />
                                            <div>
                                                <span class="font-bold text-xs text-slate-900 dark:text-slate-100 block">{{ $item['representative_name'] }}</span>
                                                <span class="text-[11px] text-slate-500 block">{{ $item['representative_role'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="cl-tag-pill text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 dark:text-emerald-400">
                                            {{ $item['status_text'] }}
                                        </span>
                                    </td>
                                    <td class="text-xs text-slate-500" style="white-space: nowrap;">
                                        {{ $item['date_text'] }}
                                    </td>
                                    <td style="text-align: right;">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ $item['edit_url'] }}" class="cl-card-icon-btn" title="Sửa">
                                                <svg class="w-3.5 h-3.5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                        Không tìm thấy khách hàng nào.
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
                Hiển thị {{ $display['from'] }}-{{ $display['to'] }} trong tổng số {{ $display['total'] }} khách hàng
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
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Xóa khách hàng?</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Hành động này không thể hoàn tác.</p>
                    </div>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                    Bạn có chắc chắn muốn xóa hồ sơ khách hàng <span class="font-semibold text-slate-900 dark:text-slate-100">"{{ $clientToDeleteName }}"</span>?
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
