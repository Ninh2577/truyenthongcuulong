<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $display = $this->getDisplayData();
        $contacts = $display['contacts'];
    @endphp

    <style>
        .cl-contact-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-contact-wrapper {
            color: #f1f5f9;
        }

        /* Top Header */
        .cl-contact-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 1024px) {
            .cl-contact-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Breadcrumb */
        .cl-contact-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .dark .cl-contact-breadcrumb {
            color: #94a3b8;
        }
        .cl-contact-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-contact-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Title Area */
        .cl-contact-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cl-contact-title-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 1rem;
            background: linear-gradient(135deg, #ff5400 0%, #ff7a1a 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.3);
            flex-shrink: 0;
        }
        .cl-contact-title-text h1 {
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1.25;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.02em;
        }
        .dark .cl-contact-title-text h1 {
            color: #f8fafc;
        }
        .cl-contact-title-text p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
            font-weight: 450;
        }
        .dark .cl-contact-title-text p {
            color: #94a3b8;
        }

        /* Top Action Buttons */
        .cl-contact-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        @media (min-width: 1024px) {
            .cl-contact-actions {
                flex-wrap: nowrap;
                flex-shrink: 0;
            }
        }

        .cl-btn-dropdown {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #334155;
            font-size: 0.8125rem;
            font-weight: 500;
            padding: 0.55rem 0.875rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .dark .cl-btn-dropdown {
            background: #182234;
            border-color: #26354a;
            color: #cbd5e1;
        }
        .cl-btn-dropdown:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }
        .dark .cl-btn-dropdown:hover {
            background: #1e2c40;
            border-color: #334560;
        }

        .cl-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #ff5400;
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.6rem 1.15rem;
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.28);
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
        }
        .cl-btn-primary:hover {
            background: #e04a00;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(255, 84, 0, 0.35);
        }

        /* 4 KPI Metrics Grid */
        .cl-metrics-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 640px) {
            .cl-metrics-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .cl-metrics-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .cl-metric-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.25rem 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            transition: all 0.2s ease;
        }
        .dark .cl-metric-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-metric-card:hover {
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }
        .dark .cl-metric-card:hover {
            border-color: #334560;
        }

        .cl-metric-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cl-metric-content {
            flex-grow: 1;
            min-width: 0;
        }
        .cl-metric-label {
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 0.25rem;
        }
        .dark .cl-metric-label {
            color: #94a3b8;
        }
        .cl-metric-value-row {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
        }
        .cl-metric-value {
            font-size: 1.625rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1.15;
            letter-spacing: -0.02em;
        }
        .dark .cl-metric-value {
            color: #f8fafc;
        }
        .cl-metric-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.125rem;
            font-size: 0.6875rem;
            font-weight: 700;
            padding: 0.15rem 0.45rem;
            border-radius: 9999px;
            line-height: 1;
        }
        .cl-metric-badge-up {
            background: #ecfdf5;
            color: #059669;
        }
        .dark .cl-metric-badge-up {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
        }
        .cl-metric-badge-down {
            background: #fff1f2;
            color: #e11d48;
        }
        .dark .cl-metric-badge-down {
            background: rgba(225, 29, 72, 0.15);
            color: #fb7185;
        }
        .cl-metric-subtext {
            font-size: 0.71875rem;
            color: #94a3b8;
            margin-top: 0.25rem;
            font-weight: 450;
        }
        .dark .cl-metric-subtext {
            color: #64748b;
        }

        /* Filter Toolbar */
        .cl-toolbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 0.875rem 1rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .dark .cl-toolbar {
            background: #182234;
            border-color: #26354a;
        }
        @media (min-width: 1024px) {
            .cl-toolbar {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        .cl-search-box {
            position: relative;
            flex-grow: 1;
            max-width: 100%;
        }
        @media (min-width: 1024px) {
            .cl-search-box {
                max-width: 380px;
            }
        }
        .cl-search-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }
        .cl-search-input {
            width: 100%;
            padding: 0.55rem 0.875rem 0.55rem 2.375rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.8125rem;
            background: #ffffff;
            color: #1e293b;
            transition: all 0.15s ease;
            outline: none;
        }
        .dark .cl-search-input {
            background: #131c2b;
            border-color: #26354a;
            color: #f1f5f9;
        }
        .cl-search-input:focus {
            border-color: #ff5400;
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.12);
        }

        .cl-filter-group {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            flex-wrap: wrap;
        }

        .cl-select-filter {
            padding: 0.55rem 2rem 0.55rem 0.875rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            background: #ffffff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") no-repeat right 0.5rem center/1.25rem;
            color: #334155;
            cursor: pointer;
            outline: none;
            appearance: none;
            transition: all 0.15s ease;
        }
        .dark .cl-select-filter {
            background-color: #131c2b;
            border-color: #26354a;
            color: #cbd5e1;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        }
        .cl-select-filter:focus {
            border-color: #ff5400;
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.12);
        }

        .cl-btn-reset {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.55rem 0.875rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .dark .cl-btn-reset {
            background: #131c2b;
            border-color: #26354a;
            color: #94a3b8;
        }
        .cl-btn-reset:hover {
            color: #ff5400;
            border-color: #ff5400;
        }

        /* View Mode Toggle */
        .cl-view-toggle {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            padding: 0.2rem;
            border-radius: 0.625rem;
            gap: 0.125rem;
        }
        .dark .cl-view-toggle {
            background: #131c2b;
        }
        .cl-view-btn {
            padding: 0.4rem 0.5rem;
            border-radius: 0.5rem;
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .cl-view-btn.active {
            background: #ff5400;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(255, 84, 0, 0.3);
        }

        /* Table Container */
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

        .cl-contact-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }
        .cl-contact-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .dark .cl-contact-table thead tr {
            background: #131c2b;
            border-color: #26354a;
        }
        .cl-contact-table th {
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: #475569;
            letter-spacing: 0.025em;
            white-space: nowrap;
        }
        .dark .cl-contact-table th {
            color: #94a3b8;
        }
        .cl-contact-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.15s ease;
        }
        .dark .cl-contact-table tbody tr {
            border-bottom-color: #1f2c3f;
        }
        .cl-contact-table tbody tr:last-child {
            border-bottom: none;
        }
        .cl-contact-table tbody tr:hover {
            background-color: #f8fafc;
        }
        .dark .cl-contact-table tbody tr:hover {
            background-color: #1c273c;
        }
        .cl-contact-table td {
            padding: 1rem 1rem;
            vertical-align: middle;
        }

        /* Customer Cell */
        .cl-cust-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .cl-cust-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .cl-cust-avatar-letter {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9375rem;
            flex-shrink: 0;
        }
        .cl-cust-name {
            font-weight: 700;
            color: #0f172a;
            font-size: 0.875rem;
            line-height: 1.25;
        }
        .dark .cl-cust-name {
            color: #f8fafc;
        }
        .cl-cust-tag {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.125rem;
            font-weight: 450;
        }
        .dark .cl-cust-tag {
            color: #94a3b8;
        }

        /* Contact Info Cell */
        .cl-contact-info-cell {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            font-size: 0.8125rem;
        }
        .cl-contact-info-row {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            color: #334155;
            text-decoration: none;
            transition: color 0.15s ease;
        }
        .dark .cl-contact-info-row {
            color: #cbd5e1;
        }
        .cl-contact-info-row:hover {
            color: #ff5400;
        }
        .cl-contact-info-row span.icon {
            color: #94a3b8;
            font-size: 0.875rem;
        }

        /* Channel Badge */
        .cl-channel-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.3rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Status Badge */
        .cl-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.3rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Time Cell */
        .cl-time-cell {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
            font-size: 0.8125rem;
        }
        .cl-time-main {
            font-weight: 600;
            color: #1e293b;
        }
        .dark .cl-time-main {
            color: #e2e8f0;
        }
        .cl-time-rel {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Action Buttons */
        .cl-action-group {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .cl-action-btn {
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            border: none;
            background: transparent;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-action-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
        .dark .cl-action-btn:hover {
            background: #1e2c40;
            color: #f8fafc;
        }
        .cl-action-btn.delete:hover {
            background: #fef2f2;
            color: #ef4444;
        }

        /* Bulk Action Floating Bar */
        .cl-bulk-bar {
            background: #0f172a;
            color: #ffffff;
            border-radius: 0.875rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.2s ease-out;
        }

        /* Pagination Footer */
        .cl-pagination-footer {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
        }
        @media (min-width: 640px) {
            .cl-pagination-footer {
                flex-direction: row;
            }
        }
        .cl-pagination-info {
            font-size: 0.8125rem;
            color: #64748b;
        }
        .dark .cl-pagination-info {
            color: #94a3b8;
        }
        .cl-pagination-btns {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .cl-page-btn {
            min-width: 2rem;
            height: 2rem;
            padding: 0 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            font-size: 0.8125rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .dark .cl-page-btn {
            background: #182234;
            border-color: #26354a;
            color: #cbd5e1;
        }
        .cl-page-btn:hover:not(:disabled) {
            border-color: #ff5400;
            color: #ff5400;
        }
        .cl-page-btn.active {
            background: #ff5400;
            border-color: #ff5400;
            color: #ffffff;
            font-weight: 700;
        }
        .cl-page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Custom Modal Backdrop & Dialog */
        .cl-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            animation: fadeIn 0.2s ease-out;
        }
        .cl-modal-dialog {
            background: #ffffff;
            border-radius: 1.25rem;
            width: 100%;
            max-width: 580px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid #e2e8f0;
            animation: scaleUp 0.2s ease-out;
        }
        .dark .cl-modal-dialog {
            background: #182234;
            border-color: #26354a;
            color: #f1f5f9;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes scaleUp {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>

    <div class="cl-contact-wrapper">
        
        <!-- Breadcrumb -->
        <div class="cl-contact-breadcrumb">
            <svg class="w-4 h-4 text-[#ff5400]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            <a href="#">Truyền thông &amp; CSKH</a>
            <span>&rsaquo;</span>
            <span class="font-medium text-slate-700 dark:text-slate-300">Yêu Cầu Tư Vấn</span>
        </div>

        <!-- Top Header Row -->
        <div class="cl-contact-header" style="display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: nowrap;">
            
            <!-- Left: Title Group -->
            <div class="cl-contact-title-group" style="flex: 1 1 auto; min-width: 0;">
                <div class="cl-contact-title-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="cl-contact-title-text" style="min-width: 0;">
                    <h1>Yêu Cầu Tư Vấn</h1>
                    <p style="max-width: 440px;" class="truncate sm:whitespace-normal">Quản lý các yêu cầu tư vấn từ khách hàng thông qua website, hotline và các kênh liên hệ khác.</p>
                </div>
            </div>

            <!-- Right: Action Controls -->
            <div class="cl-contact-actions" style="display: flex; align-items: center; gap: 0.625rem; flex-wrap: nowrap; flex-shrink: 0;">
                <!-- Date Range Dropdown -->
                <button type="button" class="cl-btn-dropdown">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $dateRange }}</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Channel Dropdown -->
                <div class="relative inline-flex items-center">
                    <select wire:model.live="selectedChannel" class="cl-btn-dropdown" style="padding-right: 2.2rem; appearance: none; -webkit-appearance: none;">
                        <option value="">Tất cả kênh</option>
                        <option value="website">Website</option>
                        <option value="hotline">Hotline</option>
                        <option value="form">Form tư vấn</option>
                        <option value="email">Email</option>
                        <option value="zalo">Zalo</option>
                    </select>
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                <!-- Create Primary Button -->
                <button type="button" wire:click="openCreateModal" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tạo yêu cầu tư vấn</span>
                </button>
            </div>
        </div>

        <!-- 4 KPI Metrics Cards Grid -->
        <div class="cl-metrics-grid">
            
            <!-- Metric 1: Tổng yêu cầu tư vấn -->
            <div class="cl-metric-card">
                <div class="cl-metric-icon" style="background: #3b82f6;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <div class="cl-metric-content">
                    <div class="cl-metric-label">Tổng yêu cầu tư vấn</div>
                    <div class="cl-metric-value-row">
                        <span class="cl-metric-value">{{ $metrics['total'] }}</span>
                        <span class="cl-metric-badge cl-metric-badge-up">
                            &uarr; {{ $metrics['total_trend'] }}
                        </span>
                    </div>
                    <div class="cl-metric-subtext">{{ $metrics['total_sub'] }}</div>
                </div>
            </div>

            <!-- Metric 2: Đã xử lý -->
            <div class="cl-metric-card">
                <div class="cl-metric-icon" style="background: #10b981;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="cl-metric-content">
                    <div class="cl-metric-label">Đã xử lý</div>
                    <div class="cl-metric-value-row">
                        <span class="cl-metric-value">{{ $metrics['resolved'] }}</span>
                        <span class="cl-metric-badge cl-metric-badge-up">
                            &uarr; {{ $metrics['resolved_trend'] }}
                        </span>
                    </div>
                    <div class="cl-metric-subtext">{{ $metrics['resolved_sub'] }}</div>
                </div>
            </div>

            <!-- Metric 3: Chờ xử lý -->
            <div class="cl-metric-card">
                <div class="cl-metric-icon" style="background: #ff5400;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="cl-metric-content">
                    <div class="cl-metric-label">Chờ xử lý</div>
                    <div class="cl-metric-value-row">
                        <span class="cl-metric-value">{{ $metrics['pending'] }}</span>
                        <span class="cl-metric-badge cl-metric-badge-down">
                            &darr; {{ $metrics['pending_trend'] }}
                        </span>
                    </div>
                    <div class="cl-metric-subtext">{{ $metrics['pending_sub'] }}</div>
                </div>
            </div>

            <!-- Metric 4: Hôm nay -->
            <div class="cl-metric-card">
                <div class="cl-metric-icon" style="background: #6366f1;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="cl-metric-content">
                    <div class="cl-metric-label">Hôm nay</div>
                    <div class="cl-metric-value-row">
                        <span class="cl-metric-value">{{ $metrics['today'] }}</span>
                        <span class="cl-metric-badge cl-metric-badge-up">
                            &uarr; {{ $metrics['today_trend'] }}
                        </span>
                    </div>
                    <div class="cl-metric-subtext">{{ $metrics['today_sub'] }}</div>
                </div>
            </div>

        </div>

        <!-- Filter & Search Toolbar -->
        <div class="cl-toolbar">
            
            <!-- Left: Search Box -->
            <div class="cl-search-box">
                <svg class="w-4 h-4 cl-search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" 
                       wire:model.live.debounce.300ms="search"
                       class="cl-search-input" 
                       placeholder="Tìm kiếm theo tên, số điện thoại, email, nội dung tư vấn...">
            </div>

            <!-- Right: Filter Dropdowns & View Toggles -->
            <div class="cl-filter-group">
                
                <!-- Status Filter -->
                <select wire:model.live="selectedStatus" class="cl-select-filter">
                    <option value="">Trạng thái</option>
                    <option value="resolved">Đã xử lý</option>
                    <option value="processing">Đang xử lý</option>
                    <option value="new">Chờ xử lý</option>
                    <option value="rejected">Từ chối</option>
                </select>

                <!-- Channel Filter -->
                <select wire:model.live="selectedChannel" class="cl-select-filter">
                    <option value="">Kênh tiếp nhận</option>
                    <option value="website">Website</option>
                    <option value="hotline">Hotline</option>
                    <option value="form">Form tư vấn</option>
                    <option value="email">Email</option>
                    <option value="zalo">Zalo</option>
                </select>

                <!-- Date Filter -->
                <select wire:model.live="selectedDate" class="cl-select-filter">
                    <option value="">Ngày gửi</option>
                    <option value="today">Hôm nay</option>
                    <option value="7days">7 ngày qua</option>
                    <option value="30days">30 ngày qua</option>
                    <option value="month">Tháng này</option>
                </select>

                <!-- Reset Button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-reset" title="Đặt lại bộ lọc">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Đặt lại</span>
                </button>

                <!-- View Switcher -->
                <div class="cl-view-toggle">
                    <button type="button" 
                            wire:click="setViewMode('grid')" 
                            class="cl-view-btn {{ $viewMode === 'grid' ? 'active' : '' }}" 
                            title="Chế độ Lưới">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button type="button" 
                            wire:click="setViewMode('list')" 
                            class="cl-view-btn {{ $viewMode === 'list' ? 'active' : '' }}" 
                            title="Chế độ Danh sách">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Bulk Action Floating Bar -->
        @if (count($selectedContacts) > 0)
            <div class="cl-bulk-bar">
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#ff5400]"></span>
                    <span class="text-sm font-medium">Đã chọn <strong>{{ count($selectedContacts) }}</strong> yêu cầu tư vấn</span>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" 
                            wire:click="deleteSelected" 
                            wire:confirm="Bạn có chắc chắn muốn xóa những yêu cầu tư vấn đã chọn?"
                            class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span>Xóa mục đã chọn</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Main Content: Table or Grid View -->
        @if ($viewMode === 'list')
            <div class="cl-table-container">
                <div class="overflow-x-auto">
                    <table class="cl-contact-table">
                        <thead>
                            <tr>
                                <th style="width: 44px; text-align: center;">
                                    <input type="checkbox" 
                                           wire:click="toggleSelectAll" 
                                           {{ $selectAll ? 'checked' : '' }}
                                           class="w-4 h-4 text-[#ff5400] rounded border-slate-300 focus:ring-[#ff5400] cursor-pointer">
                                </th>
                                <th style="min-width: 180px;">Khách hàng</th>
                                <th style="min-width: 180px;">Thông tin liên hệ</th>
                                <th style="min-width: 280px;">Nội dung yêu cầu</th>
                                <th style="min-width: 130px;">Kênh tiếp nhận</th>
                                <th style="min-width: 120px;">Trạng thái</th>
                                <th style="min-width: 140px;">
                                    <div class="flex items-center gap-1 cursor-pointer select-none">
                                        <span>Thời gian gửi</span>
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </th>
                                <th style="min-width: 155px; text-align: right; white-space: nowrap;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $c)
                                <tr>
                                    <!-- Checkbox -->
                                    <td style="text-align: center;">
                                        <input type="checkbox" 
                                               wire:click="toggleSelectContact({{ $c->id }})"
                                               {{ in_array($c->id, $selectedContacts) ? 'checked' : '' }}
                                               class="w-4 h-4 text-[#ff5400] rounded border-slate-300 focus:ring-[#ff5400] cursor-pointer">
                                    </td>

                                    <!-- Customer Cell -->
                                    <td>
                                        <div class="cl-cust-cell">
                                            @if ($c->avatar)
                                                <img src="{{ $c->avatar }}" alt="{{ $c->fullname }}" class="cl-cust-avatar">
                                            @else
                                                @php
                                                    $firstChar = mb_substr(trim($c->fullname), 0, 1);
                                                    $bgColors = ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ec4899', '#06b6d4'];
                                                    $bgCol = $bgColors[crc32($c->fullname) % count($bgColors)];
                                                @endphp
                                                <div class="cl-cust-avatar-letter" style="background: {{ $bgCol }};">
                                                    {{ strtoupper($firstChar) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="cl-cust-name">{{ $c->fullname }}</div>
                                                <div class="cl-cust-tag">{{ $c->customer_type ?: 'Khách hàng mới' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Contact Info Cell -->
                                    <td>
                                        <div class="cl-contact-info-cell">
                                            @if ($c->phone)
                                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $c->phone) }}" class="cl-contact-info-row">
                                                    <span class="icon">📞</span>
                                                    <span>{{ $c->phone }}</span>
                                                </a>
                                            @endif
                                            @if ($c->email)
                                                <a href="mailto:{{ $c->email }}" class="cl-contact-info-row">
                                                    <span class="icon">✉</span>
                                                    <span class="truncate max-w-[170px]">{{ $c->email }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Message Request Cell -->
                                    <td>
                                        <div class="text-slate-600 dark:text-slate-300 text-xs sm:text-[13px] leading-relaxed max-w-[340px] line-clamp-2"
                                             title="{{ $c->message }}">
                                            {{ $c->message }}
                                        </div>
                                    </td>

                                    <!-- Channel Cell -->
                                    <td>
                                        @php
                                            $channel = strtolower($c->channel ?: 'website');
                                            $channelConfigs = [
                                                'website' => ['label' => 'Website', 'icon' => '🌐', 'bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe'],
                                                'hotline' => ['label' => 'Hotline', 'icon' => '📞', 'bg' => '#f0fdf4', 'text' => '#16a34a', 'border' => '#bbf7d0'],
                                                'form' => ['label' => 'Form tư vấn', 'icon' => '📋', 'bg' => '#faf5ff', 'text' => '#9333ea', 'border' => '#e9d5ff'],
                                                'email' => ['label' => 'Email', 'icon' => '✉', 'bg' => '#fff1f2', 'text' => '#e11d48', 'border' => '#fecdd3'],
                                                'zalo' => ['label' => 'Zalo', 'icon' => '💬', 'bg' => '#f0f9ff', 'text' => '#0284c7', 'border' => '#bae6fd'],
                                            ];
                                            $cfg = $channelConfigs[$channel] ?? $channelConfigs['website'];
                                        @endphp
                                        <span class="cl-channel-badge" style="background: {{ $cfg['bg'] }}; color: {{ $cfg['text'] }}; border: 1px solid {{ $cfg['border'] }};">
                                            <span>{{ $cfg['icon'] }}</span>
                                            <span>{{ $cfg['label'] }}</span>
                                        </span>
                                    </td>

                                    <!-- Status Cell -->
                                    <td>
                                        @php
                                            $st = strtolower($c->status ?: 'new');
                                            $statusConfigs = [
                                                'resolved' => ['label' => 'Đã xử lý', 'dot' => '#10b981', 'bg' => '#ecfdf5', 'text' => '#059669', 'border' => '#a7f3d0'],
                                                'processing' => ['label' => 'Đang xử lý', 'dot' => '#3b82f6', 'bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe'],
                                                'new' => ['label' => 'Chờ xử lý', 'dot' => '#f59e0b', 'bg' => '#fffbeb', 'text' => '#d97706', 'border' => '#fde68a'],
                                                'rejected' => ['label' => 'Từ chối', 'dot' => '#ef4444', 'bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#fecaca'],
                                            ];
                                            $stCfg = $statusConfigs[$st] ?? $statusConfigs['new'];
                                        @endphp
                                        <span class="cl-status-badge" style="background: {{ $stCfg['bg'] }}; color: {{ $stCfg['text'] }}; border: 1px solid {{ $stCfg['border'] }};">
                                            <span style="display: inline-block; width: 6px; height: 6px; border-radius: 9999px; background: {{ $stCfg['dot'] }};"></span>
                                            <span>{{ $stCfg['label'] }}</span>
                                        </span>
                                    </td>

                                    <!-- Time Sent Cell -->
                                    <td>
                                        <div class="cl-time-cell">
                                            <div class="cl-time-main">{{ $c->created_at?->format('d/m/Y H:i') ?? '—' }}</div>
                                            <div class="cl-time-rel">{{ $c->created_at?->diffForHumans() ?? '' }}</div>
                                        </div>
                                    </td>

                                    <!-- Action Buttons -->
                                    <td>
                                        <div class="cl-action-group justify-end">
                                            <!-- View Detail -->
                                            <button type="button" 
                                                    wire:click="openViewModal({{ $c->id }})" 
                                                    class="cl-action-btn" 
                                                    title="Xem chi tiết">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>

                                            <!-- Edit / Update Status -->
                                            <button type="button" 
                                                    wire:click="openEditModal({{ $c->id }})" 
                                                    class="cl-action-btn" 
                                                    title="Cập nhật trạng thái">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </button>

                                            <!-- Delete -->
                                            <button type="button" 
                                                    wire:click="confirmDelete({{ $c->id }})" 
                                                    class="cl-action-btn delete" 
                                                    title="Xóa yêu cầu">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>

                                            <!-- More menu trigger -->
                                            <button type="button" 
                                                    wire:click="openViewModal({{ $c->id }})" 
                                                    class="cl-action-btn" 
                                                    title="Tùy chọn khác">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-12">
                                        <div class="flex flex-col items-center justify-center text-slate-400">
                                            <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            <p class="text-base font-semibold text-slate-700 dark:text-slate-300">Không tìm thấy yêu cầu tư vấn</p>
                                            <p class="text-xs text-slate-400 mt-1">Hãy thử tìm kiếm với từ khóa khác hoặc điều chỉnh bộ lọc.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Grid / Card View Mode -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @forelse ($contacts as $c)
                    <div class="bg-white dark:bg-[#182234] border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex items-center gap-3">
                                @if ($c->avatar)
                                    <img src="{{ $c->avatar }}" alt="{{ $c->fullname }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    @php
                                        $firstChar = mb_substr(trim($c->fullname), 0, 1);
                                        $bgColors = ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ec4899', '#06b6d4'];
                                        $bgCol = $bgColors[crc32($c->fullname) % count($bgColors)];
                                    @endphp
                                    <div class="w-10 h-10 rounded-full text-white font-bold text-sm flex items-center justify-center" style="background: {{ $bgCol }};">
                                        {{ strtoupper($firstChar) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $c->fullname }}</h4>
                                    <span class="text-xs text-slate-500">{{ $c->customer_type ?: 'Khách hàng mới' }}</span>
                                </div>
                            </div>

                            @php
                                $st = strtolower($c->status ?: 'new');
                                $statusConfigs = [
                                    'resolved' => ['label' => 'Đã xử lý', 'dot' => '#10b981', 'bg' => '#ecfdf5', 'text' => '#059669', 'border' => '#a7f3d0'],
                                    'processing' => ['label' => 'Đang xử lý', 'dot' => '#3b82f6', 'bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe'],
                                    'new' => ['label' => 'Chờ xử lý', 'dot' => '#f59e0b', 'bg' => '#fffbeb', 'text' => '#d97706', 'border' => '#fde68a'],
                                    'rejected' => ['label' => 'Từ chối', 'dot' => '#ef4444', 'bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#fecaca'],
                                ];
                                $stCfg = $statusConfigs[$st] ?? $statusConfigs['new'];
                            @endphp
                            <span class="cl-status-badge text-[11px]" style="background: {{ $stCfg['bg'] }}; color: {{ $stCfg['text'] }}; border: 1px solid {{ $stCfg['border'] }};">
                                <span style="display: inline-block; width: 5px; height: 5px; border-radius: 9999px; background: {{ $stCfg['dot'] }};"></span>
                                <span>{{ $stCfg['label'] }}</span>
                            </span>
                        </div>

                        <p class="text-xs text-slate-600 dark:text-slate-300 line-clamp-3 mb-4 leading-relaxed">
                            {{ $c->message }}
                        </p>

                        <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-500">
                            <span class="flex items-center gap-1.5 font-medium text-slate-700 dark:text-slate-300">
                                📞 {{ $c->phone }}
                            </span>
                            <div class="flex items-center gap-1">
                                <button type="button" wire:click="openViewModal({{ $c->id }})" class="p-1 hover:text-slate-900 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                                <button type="button" wire:click="openEditModal({{ $c->id }})" class="p-1 hover:text-slate-900 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </button>
                                <button type="button" wire:click="confirmDelete({{ $c->id }})" class="p-1 hover:text-red-500 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        Chưa có dữ liệu yêu cầu tư vấn.
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Pagination Footer -->
        <div class="cl-pagination-footer">
            <div class="cl-pagination-info">
                Hiển thị <strong>{{ $display['from'] }}-{{ $display['to'] }}</strong> trong tổng số <strong>{{ $display['totalDisplayFormatted'] }}</strong> kết quả
            </div>

            <div class="cl-pagination-btns">
                <!-- Prev Button -->
                <button type="button" 
                        wire:click="previousPage" 
                        {{ $display['currentPage'] <= 1 ? 'disabled' : '' }}
                        class="cl-page-btn" 
                        title="Trang trước">
                    &lsaquo;
                </button>

                @for ($p = 1; $p <= $display['lastPage']; $p++)
                    @if ($display['lastPage'] <= 7 || $p == 1 || $p == $display['lastPage'] || abs($p - $display['currentPage']) <= 1)
                        <button type="button" 
                                wire:click="setPage({{ $p }})" 
                                class="cl-page-btn {{ $display['currentPage'] == $p ? 'active' : '' }}">
                            {{ $p }}
                        </button>
                    @elseif (($p == 2 && $display['currentPage'] > 3) || ($p == $display['lastPage'] - 1 && $display['currentPage'] < $display['lastPage'] - 2))
                        <span class="px-1 text-slate-400 text-xs">...</span>
                    @endif
                @endfor

                <!-- Next Button -->
                <button type="button" 
                        wire:click="nextPage" 
                        {{ $display['currentPage'] >= $display['lastPage'] ? 'disabled' : '' }}
                        class="cl-page-btn" 
                        title="Trang sau">
                    &rsaquo;
                </button>
            </div>
        </div>

    </div>

    <!-- ==============================================
         MODAL 1: TẠO MỚI YÊU CẦU TƯ VẤN
         ============================================== -->
    @if ($showCreateModal)
        <div class="cl-modal-backdrop" wire:click.self="closeCreateModal">
            <div class="cl-modal-dialog">
                <div class="p-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#ff5400]/10 text-[#ff5400] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tạo Yêu Cầu Tư Vấn</h3>
                                <p class="text-xs text-slate-500">Thêm mới yêu cầu tư vấn nhận từ khách hàng</p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeCreateModal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                            ✕
                        </button>
                    </div>

                    <form wire:submit="saveNewContact" class="mt-5 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Họ và tên *</label>
                                <input type="text" wire:model="createFullname" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none" placeholder="Nguyễn Văn A">
                                @error('createFullname') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Loại khách hàng</label>
                                <select wire:model="createCustomerType" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none">
                                    <option value="Khách hàng mới">Khách hàng mới</option>
                                    <option value="Khách hàng tiềm năng">Khách hàng tiềm năng</option>
                                    <option value="Khách hàng thân thiết">Khách hàng thân thiết</option>
                                    <option value="Khách hàng VIP">Khách hàng VIP</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Số điện thoại *</label>
                                <input type="text" wire:model="createPhone" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none" placeholder="0939 123 456">
                                @error('createPhone') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                                <input type="email" wire:model="createEmail" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none" placeholder="khachhang@gmail.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kênh tiếp nhận</label>
                                <select wire:model="createChannel" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none">
                                    <option value="website">Website</option>
                                    <option value="hotline">Hotline</option>
                                    <option value="form">Form tư vấn</option>
                                    <option value="email">Email</option>
                                    <option value="zalo">Zalo</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Dịch vụ quan tâm</label>
                                <input type="text" wire:model="createService" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none" placeholder="Ví dụ: Thiết kế website, Quay video...">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nội dung yêu cầu *</label>
                            <textarea wire:model="createMessage" rows="3" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none" placeholder="Nhập chi tiết yêu cầu tư vấn của khách hàng..."></textarea>
                            @error('createMessage') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Trạng thái ban đầu</label>
                            <select wire:model="createStatus" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none">
                                <option value="new">Chờ xử lý</option>
                                <option value="processing">Đang xử lý</option>
                                <option value="resolved">Đã xử lý</option>
                            </select>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                            <button type="button" wire:click="closeCreateModal" class="px-4 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                                Hủy bỏ
                            </button>
                            <button type="submit" class="cl-btn-primary">
                                Lưu yêu cầu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- ==============================================
         MODAL 2: XEM CHI TIẾT YÊU CẦU TƯ VẤN
         ============================================== -->
    @if ($showViewModal && $viewingContact)
        <div class="cl-modal-backdrop" wire:click.self="closeViewModal">
            <div class="cl-modal-dialog">
                <div class="p-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Chi Tiết Yêu Cầu Tư Vấn #{{ $viewingContact['id'] }}</h3>
                                <p class="text-xs text-slate-500">Gửi lúc {{ $viewingContact['created_at'] }} ({{ $viewingContact['created_relative'] }})</p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeViewModal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                            ✕
                        </button>
                    </div>

                    <div class="mt-5 space-y-4">
                        <!-- Customer Info Box -->
                        <div class="bg-slate-50 dark:bg-[#131c2b] p-4 rounded-xl border border-slate-200/60 dark:border-slate-700/60">
                            <div class="flex items-center gap-3">
                                @if ($viewingContact['avatar'])
                                    <img src="{{ $viewingContact['avatar'] }}" alt="{{ $viewingContact['fullname'] }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-[#ff5400] text-white font-black text-lg flex items-center justify-center">
                                        {{ strtoupper(mb_substr($viewingContact['fullname'], 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white text-base">{{ $viewingContact['fullname'] }}</h4>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $viewingContact['customer_type'] }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4 pt-3 border-t border-slate-200 dark:border-slate-700 text-xs">
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Số điện thoại:</span>
                                    <a href="tel:{{ $viewingContact['phone'] }}" class="font-semibold text-blue-600 hover:underline">
                                        📞 {{ $viewingContact['phone'] }}
                                    </a>
                                </div>
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Email:</span>
                                    <a href="mailto:{{ $viewingContact['email'] }}" class="font-semibold text-blue-600 hover:underline">
                                        ✉ {{ $viewingContact['email'] ?: 'Chưa cập nhật' }}
                                    </a>
                                </div>
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Kênh tiếp nhận:</span>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300 uppercase">
                                        {{ $viewingContact['channel'] }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Trạng thái:</span>
                                    <span class="font-bold text-[#ff5400]">
                                        {{ $viewingContact['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Message Content -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nội dung yêu cầu:</label>
                            <div class="bg-white dark:bg-[#182234] p-4 rounded-xl border border-slate-200 dark:border-slate-700 text-sm leading-relaxed text-slate-700 dark:text-slate-200">
                                {{ $viewingContact['message'] }}
                            </div>
                        </div>

                        @if ($viewingContact['admin_note'])
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ghi chú xử lý nội bộ:</label>
                                <div class="bg-amber-50/60 dark:bg-amber-950/20 p-3.5 rounded-xl border border-amber-200 dark:border-amber-800 text-xs text-amber-900 dark:text-amber-200">
                                    {{ $viewingContact['admin_note'] }}
                                </div>
                            </div>
                        @endif

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <a href="tel:{{ $viewingContact['phone'] }}" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-semibold flex items-center gap-1 transition">
                                    <span>Gọi ngay</span>
                                </a>
                                @if ($viewingContact['email'])
                                    <a href="mailto:{{ $viewingContact['email'] }}" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold flex items-center gap-1 transition">
                                        <span>Gửi Email</span>
                                    </a>
                                @endif
                            </div>

                            <button type="button" wire:click="closeViewModal" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-200 transition">
                                Đóng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==============================================
         MODAL 3: CẬP NHẬT TRẠNG THÁI YÊU CẦU TƯ VẤN
         ============================================== -->
    @if ($showEditModal)
        <div class="cl-modal-backdrop" wire:click.self="closeEditModal">
            <div class="cl-modal-dialog">
                <div class="p-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-500/10 text-[#ff5400] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Cập Nhật Trạng Thái Yêu Cầu #{{ $editingContactId }}</h3>
                                <p class="text-xs text-slate-500">Cập nhật tiến độ xử lý và phản hồi tới khách hàng</p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeEditModal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                            ✕
                        </button>
                    </div>

                    <form wire:submit="saveEditStatus" class="mt-5 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Trạng thái xử lý *</label>
                            <select wire:model="editStatus" class="w-full px-3.5 py-2.5 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none font-medium">
                                <option value="new">Chờ xử lý</option>
                                <option value="processing">Đang xử lý</option>
                                <option value="resolved">Đã xử lý (Đã phản hồi)</option>
                                <option value="rejected">Từ chối</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ghi chú nội bộ (Admin)</label>
                            <textarea wire:model="editAdminNote" rows="3" class="w-full px-3.5 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] focus:ring-1 focus:ring-[#ff5400] outline-none" placeholder="Ghi chú lại quá trình liên hệ, lịch hẹn với khách hàng..."></textarea>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                            <button type="button" wire:click="closeEditModal" class="px-4 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                                Hủy bỏ
                            </button>
                            <button type="submit" class="cl-btn-primary">
                                Cập nhật trạng thái
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- ==============================================
         MODAL 4: XÁC NHẬN XÓA YÊU CẦU TƯ VẤN
         ============================================== -->
    @if ($showDeleteModal)
        <div class="cl-modal-backdrop" wire:click.self="cancelDelete">
            <div class="cl-modal-dialog" style="max-width: 440px;">
                <div class="p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Xóa Yêu Cầu Tư Vấn?</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Bạn có chắc chắn muốn xóa yêu cầu tư vấn của khách hàng <strong>"{{ $contactToDeleteName }}"</strong>?<br>
                        Thao tác này không thể hoàn tác.
                    </p>

                    <div class="mt-6 flex items-center justify-center gap-3">
                        <button type="button" wire:click="cancelDelete" class="px-4 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            Hủy bỏ
                        </button>
                        <button type="button" wire:click="executeDelete" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-semibold transition">
                            Xác nhận xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-filament-panels::page>
