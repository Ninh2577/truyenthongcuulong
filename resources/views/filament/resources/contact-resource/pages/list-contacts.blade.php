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
        select.cl-btn-dropdown {
            background-image: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
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
            min-width: 220px;
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
            white-space: nowrap !important;
            word-break: keep-all !important;
        }
        .dark .cl-cust-name {
            color: #f8fafc;
        }
        .cl-cust-tag {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.125rem;
            font-weight: 450;
            white-space: nowrap !important;
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
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(5px);
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
            max-width: 620px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);
            border: 1px solid #e2e8f0;
            animation: scaleUp 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cl-modal-dialog-view {
            max-width: 980px !important;
            max-height: 92vh;
            overflow-y: auto;
            border-radius: 1.25rem !important;
        }
        .dark .cl-modal-dialog {
            background: #111a28;
            border-color: #233247;
            color: #f1f5f9;
        }

        /* 2-Column Grid for View Modal (Matches Exact Screenshot) */
        .cl-vmodal-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 1rem;
            align-items: stretch;
        }
        @media (max-width: 860px) {
            .cl-vmodal-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Left Column Card */
        .cl-vmodal-left-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.15rem;
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
        }
        .dark .cl-vmodal-left-card {
            background: #152236;
            border-color: #263852;
        }

        /* Customer Avatar & Header */
        .cl-vmodal-profile-wrap {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }
        .cl-vmodal-avatar-circle {
            width: 54px;
            height: 54px;
            min-width: 54px;
            min-height: 54px;
            border-radius: 9999px;
            background: #0891b2;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.25rem;
            position: relative;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);
        }
        .cl-vmodal-avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 9999px;
        }
        .cl-vmodal-online-dot {
            position: absolute;
            bottom: 1px;
            right: 1px;
            width: 13px;
            height: 13px;
            border-radius: 9999px;
            background: #10b981;
            border: 2.5px solid #ffffff;
        }
        .dark .cl-vmodal-online-dot {
            border-color: #152236;
        }
        .cl-vmodal-cust-name-row {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .cl-vmodal-cust-name {
            font-size: 1rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
        }
        .dark .cl-vmodal-cust-name {
            color: #f8fafc;
        }
        .cl-vmodal-edit-icon {
            width: 22px;
            height: 22px;
            border-radius: 9999px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-vmodal-edit-icon:hover {
            border-color: #ff5400;
            color: #ff5400;
            background: #fff7ed;
        }

        .cl-vmodal-badges-row {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            margin-top: 0.3rem;
            flex-wrap: wrap;
        }
        .cl-vbadge-type {
            font-size: 0.6875rem;
            font-weight: 600;
            color: #475569;
            background: #f1f5f9;
            padding: 0.15rem 0.55rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        .dark .cl-vbadge-type {
            background: #1e2c40;
            color: #cbd5e1;
        }
        .cl-vbadge-sync {
            font-size: 0.6875rem;
            font-weight: 700;
            color: #ea580c;
            background: #fff7ed;
            border: 1px solid #ffedd5;
            padding: 0.15rem 0.55rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .cl-vbadge-sync:hover {
            background: #ffedd5;
        }

        /* Divider */
        .cl-vmodal-divider {
            height: 1px;
            background: #f1f5f9;
            width: 100%;
        }
        .dark .cl-vmodal-divider {
            background: #233247;
        }

        /* Contact Details Rows */
        .cl-vmodal-contact-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            font-size: 0.8125rem;
        }
        .cl-vmodal-clabel {
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .dark .cl-vmodal-clabel {
            color: #94a3b8;
        }
        .cl-vmodal-cval-wrap {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .cl-vmodal-cval {
            font-weight: 700;
            color: #0f172a;
            font-size: 0.8125rem;
            text-decoration: none;
        }
        .dark .cl-vmodal-cval {
            color: #f1f5f9;
        }
        .cl-vmodal-cval:hover {
            color: #ff5400;
        }
        .cl-vmodal-copy-btn {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .dark .cl-vmodal-copy-btn {
            background: #18253a;
            border-color: #263852;
            color: #94a3b8;
        }
        .cl-vmodal-copy-btn:hover {
            border-color: #ff5400;
            color: #ff5400;
        }

        /* 2x2 Reception Grid */
        .cl-vmodal-meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        .cl-vmodal-mcell {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .cl-vmodal-mlabel {
            font-size: 0.6875rem;
            color: #64748b;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .dark .cl-vmodal-mlabel {
            color: #94a3b8;
        }
        .cl-vmodal-mchip-blue {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.6875rem;
            font-weight: 700;
            color: #2563eb;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            padding: 0.2rem 0.55rem;
            border-radius: 0.5rem;
            width: fit-content;
        }
        .cl-vmodal-mchip-orange {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.6875rem;
            font-weight: 700;
            color: #ea580c;
            background: #fff7ed;
            border: 1px solid #ffedd5;
            padding: 0.2rem 0.55rem;
            border-radius: 0.5rem;
            width: fit-content;
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .cl-vmodal-mlink {
            font-size: 0.6875rem;
            color: #0f172a;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            max-width: 145px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .dark .cl-vmodal-mlink {
            color: #cbd5e1;
        }
        .cl-vmodal-mlink:hover {
            color: #ff5400;
        }
        .cl-vmodal-mtime {
            font-size: 0.6875rem;
            color: #0f172a;
            font-weight: 600;
        }
        .dark .cl-vmodal-mtime {
            color: #cbd5e1;
        }

        /* Tags Section */
        .cl-vmodal-tag-head {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-bottom: 0.375rem;
        }
        .cl-vmodal-tags-wrap {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            flex-wrap: wrap;
        }
        .cl-vtag-item {
            font-size: 0.6875rem;
            font-weight: 600;
            padding: 0.2rem 0.55rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        .cl-vtag-orange {
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #ffedd5;
        }
        .cl-vtag-blue {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }
        .cl-vtag-purple {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #ddd6fe;
        }
        .cl-vtag-add {
            background: #f8fafc;
            color: #64748b;
            border: 1px dashed #cbd5e1;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-vtag-add:hover {
            border-color: #ff5400;
            color: #ff5400;
        }

        /* Right Column Card (Tabbed Workspace) */
        .cl-vmodal-right-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.15rem;
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            height: 100%;
        }
        .dark .cl-vmodal-right-card {
            background: #152236;
            border-color: #263852;
        }

        /* Custom Tabs Header */
        .cl-vtabs-nav {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 0.5rem;
        }
        .dark .cl-vtabs-nav {
            border-bottom-color: #263852;
        }
        .cl-vtab-btn {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #64748b;
            background: transparent;
            border: none;
            padding: 0.35rem 0.2rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            position: relative;
            transition: all 0.15s ease;
        }
        .dark .cl-vtab-btn {
            color: #94a3b8;
        }
        .cl-vtab-btn:hover {
            color: #ff5400;
        }
        .cl-vtab-btn.active {
            color: #ff5400;
            font-weight: 800;
        }
        .cl-vtab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            right: 0;
            height: 2.5px;
            background: #ff5400;
            border-radius: 9999px;
        }

        /* Tab Content: Messages Thread */
        .cl-vmodal-chat-thread {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-height: 220px;
            overflow-y: auto;
            padding-right: 0.25rem;
        }
        .cl-vmsg-item {
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
        }
        .cl-vmsg-avatar {
            width: 34px;
            height: 34px;
            border-radius: 9999px;
            background: #0891b2;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .cl-vmsg-content-wrap {
            flex: 1 1 auto;
            min-width: 0;
        }
        .cl-vmsg-meta-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.25rem;
        }
        .cl-vmsg-sender {
            font-size: 0.8125rem;
            font-weight: 700;
            color: #0f172a;
        }
        .dark .cl-vmsg-sender {
            color: #f8fafc;
        }
        .cl-vmsg-time {
            font-size: 0.6875rem;
            color: #94a3b8;
        }
        .cl-vmsg-bubble {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            padding: 0.625rem 0.875rem;
            font-size: 0.8125rem;
            line-height: 1.5;
            color: #1e293b;
            white-space: pre-line;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        .dark .cl-vmsg-bubble {
            background: #18253a;
            border-color: #263852;
            color: #f1f5f9;
        }
        .cl-vmsg-sublabel {
            font-size: 0.6875rem;
            color: #94a3b8;
            margin-top: 0.2rem;
            display: block;
        }

        /* Quick Canned Responses Bar */
        .cl-vquick-sec {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
            margin-top: 0.25rem;
        }
        .cl-vquick-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .cl-vquick-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .dark .cl-vquick-title {
            color: #f8fafc;
        }
        .cl-vquick-kbd {
            font-size: 0.6875rem;
            color: #64748b;
            background: #f1f5f9;
            padding: 0.15rem 0.45rem;
            border-radius: 0.375rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        .dark .cl-vquick-kbd {
            background: #1e2c40;
            color: #94a3b8;
        }
        .cl-vquick-chips-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.5rem;
        }
        @media (max-width: 768px) {
            .cl-vquick-chips-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        .cl-vquick-chip {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.625rem;
            padding: 0.4rem 0.55rem;
            cursor: pointer;
            text-align: left;
            transition: all 0.15s ease;
        }
        .dark .cl-vquick-chip {
            background: #18253a;
            border-color: #263852;
        }
        .cl-vquick-chip:hover {
            border-color: #ff5400;
            background: #fff7ed;
        }
        .cl-vchip-k {
            font-size: 0.6875rem;
            font-weight: 800;
            color: #ff5400;
            display: block;
        }
        .cl-vchip-desc {
            font-size: 0.625rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            margin-top: 0.1rem;
        }
        .dark .cl-vchip-desc {
            color: #94a3b8;
        }

        /* Interactive Chatbox Container */
        .cl-vchatbox {
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            background: #ffffff;
            padding: 0.5rem 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
            transition: border-color 0.15s ease;
        }
        .dark .cl-vchatbox {
            background: #18253a;
            border-color: #263852;
        }
        .cl-vchatbox:focus-within {
            border-color: #ff5400;
            box-shadow: 0 0 0 1px #ff5400;
        }
        .cl-vchatbox-textarea {
            width: 100%;
            border: none;
            outline: none;
            resize: none;
            background: transparent;
            font-size: 0.8125rem;
            color: #0f172a;
            line-height: 1.45;
            min-height: 48px;
            max-height: 90px;
        }
        .dark .cl-vchatbox-textarea {
            color: #f1f5f9;
        }
        .cl-vchatbox-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.35rem;
            border-top: 1px solid #f8fafc;
        }
        .dark .cl-vchatbox-toolbar {
            border-top-color: #233247;
        }
        .cl-vtb-icons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #94a3b8;
        }
        .cl-vtb-icon-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 0.15rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s ease;
        }
        .cl-vtb-icon-btn:hover {
            color: #ff5400;
        }
        .cl-vtb-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .cl-vtb-hints {
            font-size: 0.65625rem;
            color: #94a3b8;
        }
        .cl-vsend-btn {
            width: 34px;
            height: 34px;
            border-radius: 0.625rem;
            background: #ff5400;
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(255, 84, 0, 0.3);
            transition: all 0.15s ease;
            flex-shrink: 0;
        }
        .cl-vsend-btn:hover {
            background: #e04a00;
            transform: translateY(-1px);
        }

        /* Modal Footer Action Buttons */
        .cl-vmodal-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            padding-top: 0.75rem;
            margin-top: 0.75rem;
            border-top: 1px solid #e2e8f0;
            flex-wrap: wrap;
        }
        .dark .cl-vmodal-footer {
            border-top-color: #263852;
        }
        .cl-mfooter-btn-call {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.375rem !important;
            padding: 0.45rem 0.95rem !important;
            border-radius: 0.625rem !important;
            font-size: 0.78125rem !important;
            font-weight: 700 !important;
            background: #10b981 !important;
            color: #ffffff !important;
            text-decoration: none !important;
            border: none !important;
            cursor: pointer !important;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.25) !important;
            transition: all 0.15s ease !important;
        }
        .cl-mfooter-btn-call:hover {
            background: #059669 !important;
            transform: translateY(-1px) !important;
        }
        .cl-mfooter-btn-email {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.375rem !important;
            padding: 0.45rem 0.95rem !important;
            border-radius: 0.625rem !important;
            font-size: 0.78125rem !important;
            font-weight: 700 !important;
            background: #2563eb !important;
            color: #ffffff !important;
            text-decoration: none !important;
            border: none !important;
            cursor: pointer !important;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25) !important;
            transition: all 0.15s ease !important;
        }
        .cl-mfooter-btn-email:hover {
            background: #1d4ed8 !important;
            transform: translateY(-1px) !important;
        }
        .cl-mfooter-btn-edit {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.375rem !important;
            padding: 0.45rem 0.95rem !important;
            border-radius: 0.625rem !important;
            font-size: 0.78125rem !important;
            font-weight: 600 !important;
            background: #ffffff !important;
            color: #334155 !important;
            border: 1px solid #e2e8f0 !important;
            cursor: pointer !important;
            transition: all 0.15s ease !important;
        }
        .dark .cl-mfooter-btn-edit {
            background: #18253a !important;
            border-color: #263852 !important;
            color: #cbd5e1 !important;
        }
        .cl-mfooter-btn-edit:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        .cl-mfooter-status-select {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.375rem !important;
            padding: 0.45rem 0.85rem !important;
            border-radius: 0.625rem !important;
            font-size: 0.78125rem !important;
            font-weight: 600 !important;
            border: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
            color: #334155 !important;
            cursor: pointer !important;
            outline: none !important;
            transition: all 0.15s ease !important;
        }
        .dark .cl-mfooter-status-select {
            background: #18253a !important;
            border-color: #263852 !important;
            color: #cbd5e1 !important;
        }
        .cl-mfooter-btn-close {
            display: inline-flex !important;
            align-items: center !important;
            padding: 0.45rem 1.15rem !important;
            border-radius: 0.625rem !important;
            font-size: 0.78125rem !important;
            font-weight: 600 !important;
            background: #f1f5f9 !important;
            color: #475569 !important;
            border: none !important;
            cursor: pointer !important;
            transition: all 0.15s ease !important;
        }
        .dark .cl-mfooter-btn-close {
            background: #263852 !important;
            color: #cbd5e1 !important;
        }
        .cl-mfooter-btn-close:hover {
            background: #e2e8f0 !important;
            color: #0f172a !important;
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
        <div class="cl-contact-header">
            
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
            <div class="cl-contact-actions">
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
                    <select wire:model.live="selectedChannel" class="cl-btn-dropdown" style="padding-right: 2.2rem; appearance: none; -webkit-appearance: none; background-image: none !important;">
                        <option value="">Tất cả kênh</option>
                        <option value="website_contact">📋 Form Liên Hệ</option>
                        <option value="website_service">💼 Trang Dịch Vụ</option>
                        <option value="website_template">🎨 Mẫu Giao Diện</option>
                        <option value="website_booking">📅 Đặt Lịch Hẹn</option>
                        <option value="website_banner">📢 Banner CTA</option>
                        <option value="website_footer">🔻 Footer CTA</option>
                        <option value="website">🌐 Website (khác)</option>
                        <option value="hotline">📞 Hotline</option>
                        <option value="zalo">💬 Zalo</option>
                        <option value="email">✉️ Email</option>
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
                    <option value="">Tất cả trạng thái</option>
                    <option value="new">🟡 Mới / Chờ xử lý</option>
                    <option value="processing">🔵 Đang xử lý</option>
                    <option value="contacting">💬 Đang liên hệ</option>
                    <option value="quoted">🟣 Đã báo giá</option>
                    <option value="resolved">🟢 Đã xử lý</option>
                    <option value="signed">🤝 Chốt hợp đồng</option>
                    <option value="rejected">🔴 Từ chối</option>
                    <option value="cancelled">⛔ Đã hủy</option>
                </select>

                <!-- Channel Filter -->
                <select wire:model.live="selectedChannel" class="cl-select-filter">
                    <option value="">Tất cả kênh tiếp nhận</option>
                    <option value="website_contact">📋 Form Liên Hệ</option>
                    <option value="website_service">💼 Trang Dịch Vụ</option>
                    <option value="website_template">🎨 Mẫu Giao Diện</option>
                    <option value="website_booking">📅 Đặt Lịch Hẹn</option>
                    <option value="website_banner">📢 Banner CTA</option>
                    <option value="website_footer">🔻 Footer CTA</option>
                    <option value="website">🌐 Website (khác)</option>
                    <option value="hotline">📞 Hotline</option>
                    <option value="zalo">💬 Zalo</option>
                    <option value="email">✉️ Email</option>
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
                                <th style="min-width: 220px; width: 220px; white-space: nowrap !important;">Khách hàng</th>
                                <th style="min-width: 175px; white-space: nowrap !important;">Thông tin liên hệ</th>
                                <th style="min-width: 260px;">Nội dung yêu cầu</th>
                                <th style="min-width: 140px; white-space: nowrap !important;">Kênh tiếp nhận</th>
                                <th style="min-width: 125px; white-space: nowrap !important;">Trạng thái</th>
                                <th style="min-width: 140px; white-space: nowrap !important;">
                                    <div class="flex items-center gap-1 cursor-pointer select-none">
                                        <span>Thời gian gửi</span>
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </th>
                                <th style="min-width: 155px; text-align: right; white-space: nowrap !important;">Thao tác</th>
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
                                    <td style="min-width: 220px; width: 220px;">
                                        <div class="cl-cust-cell" style="min-width: 200px; white-space: nowrap;">
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
                                            <div style="min-width: 0;">
                                                <div class="cl-cust-name flex items-center gap-1.5" style="white-space: nowrap !important; word-break: keep-all !important; flex-wrap: nowrap;">
                                                    <span style="white-space: nowrap !important; word-break: keep-all !important;">{{ $c->fullname }}</span>
                                                    @if($c->chat_visitor_id && $c->visitor)
                                                        <a href="{{ route('filament.admin.pages.chat-visitors', ['visitor' => $c->visitor->visitor_uuid]) }}" class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-orange-50 text-[#ff5400] border border-orange-200 hover:bg-orange-100 transition shrink-0" title="Xem hồ sơ Customer 360">
                                                            360°
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="cl-cust-tag" style="white-space: nowrap !important;">{{ $c->customer_type ?: 'Khách hàng mới' }}</div>
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
                                        @if($c->service_interested)
                                            <div class="mb-1">
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10.5px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                    <span>🎯</span>
                                                    <span>{{ $c->service_interested }}</span>
                                                </span>
                                            </div>
                                        @endif
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
                                                'website_contact' => ['label' => 'Form Liên Hệ', 'icon' => '📋', 'bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe'],
                                                'website_service' => ['label' => 'Trang Dịch Vụ', 'icon' => '💼', 'bg' => '#fff7ed', 'text' => '#ea580c', 'border' => '#fed7aa'],
                                                'website_template' => ['label' => 'Mẫu Giao Diện', 'icon' => '🎨', 'bg' => '#f5f3ff', 'text' => '#7c3aed', 'border' => '#ddd6fe'],
                                                'website_booking' => ['label' => 'Đặt Lịch Hẹn', 'icon' => '📅', 'bg' => '#f0fdf4', 'text' => '#16a34a', 'border' => '#bbf7d0'],
                                                'website_banner' => ['label' => 'Banner CTA', 'icon' => '📢', 'bg' => '#fff1f2', 'text' => '#e11d48', 'border' => '#fecdd3'],
                                                'website_footer' => ['label' => 'Footer CTA', 'icon' => '🔻', 'bg' => '#f8fafc', 'text' => '#475569', 'border' => '#cbd5e1'],
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
                                                'signed' => ['label' => 'Chốt hợp đồng', 'dot' => '#10b981', 'bg' => '#ecfdf5', 'text' => '#059669', 'border' => '#a7f3d0'],
                                                'processing' => ['label' => 'Đang xử lý', 'dot' => '#3b82f6', 'bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe'],
                                                'contacting' => ['label' => 'Đang liên hệ', 'dot' => '#3b82f6', 'bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe'],
                                                'quoted' => ['label' => 'Đã báo giá', 'dot' => '#8b5cf6', 'bg' => '#f5f3ff', 'text' => '#7c3aed', 'border' => '#ddd6fe'],
                                                'new' => ['label' => 'Chờ xử lý', 'dot' => '#f59e0b', 'bg' => '#fffbeb', 'text' => '#d97706', 'border' => '#fde68a'],
                                                'rejected' => ['label' => 'Từ chối', 'dot' => '#ef4444', 'bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#fecaca'],
                                                'cancelled' => ['label' => 'Đã hủy', 'dot' => '#ef4444', 'bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#fecaca'],
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
                <div style="padding: 1.25rem 1.5rem;">
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#ff5400]/10 text-[#ff5400] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-white">Tạo Yêu Cầu Tư Vấn</h3>
                                <p class="text-xs text-slate-500">Thêm mới yêu cầu tư vấn nhận từ khách hàng</p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeCreateModal" style="width: 28px; height: 28px; border-radius: 8px; border: none; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease;" title="Đóng">
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
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
         MODAL 2: XEM CHI TIẾT YÊU CẦU TƯ VẤN (CỬU LONG CRM)
         ============================================== -->
    @if ($showViewModal && $viewingContact)
        @php
            $viewChannel = strtolower($viewingContact['channel'] ?: 'website');
            $vChannelCfg = $channelConfigs[$viewChannel] ?? $channelConfigs['website'];

            $viewStatus = strtolower($viewingContact['status'] ?: 'new');
            $vStatusCfg = $statusConfigs[$viewStatus] ?? $statusConfigs['new'];

            $words = preg_split('/\s+/', trim($viewingContact['fullname']));
            $initials = count($words) >= 2 
                ? mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1)
                : mb_substr($viewingContact['fullname'], 0, 2);
            $initials = mb_strtoupper($initials);

            $bgColors = ['#0891b2', '#0284c7', '#0d9488', '#2563eb', '#7c3aed'];
            $vAvatarBg = $bgColors[crc32($viewingContact['fullname']) % count($bgColors)];
        @endphp

        <div class="cl-modal-backdrop" wire:click.self="closeViewModal">
            <div class="cl-modal-dialog cl-modal-dialog-view">
                <div style="padding: 1.25rem 1.5rem;">
                    <!-- Modal Header -->
                    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.875rem; border-bottom: 1px solid #e2e8f0; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 38px; height: 38px; border-radius: 12px; background: linear-gradient(135deg, #ff5400, #ff8c00); color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.32); flex-shrink: 0;">
                                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <div>
                                <div style="display: flex; align-items: center; gap: 0.625rem; flex-wrap: wrap;">
                                    <h3 style="font-size: 1.125rem; font-weight: 800; color: #0f172a; margin: 0; line-height: 1.2;">Chi Tiết Yêu Cầu Tư Vấn #{{ $viewingContact['id'] }}</h3>
                                    <span class="cl-status-badge text-[11px] py-0.5 px-2.5" style="background: {{ $vStatusCfg['bg'] }}; color: {{ $vStatusCfg['text'] }}; border: 1px solid {{ $vStatusCfg['border'] }};">
                                        <span style="display: inline-block; width: 6px; height: 6px; border-radius: 9999px; background: {{ $vStatusCfg['dot'] }};"></span>
                                        <span>{{ $vStatusCfg['label'] }}</span>
                                    </span>
                                </div>
                                <p style="font-size: 0.75rem; color: #64748b; margin: 0.15rem 0 0; display: flex; align-items: center; gap: 0.3rem;">
                                    <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Gửi lúc {{ $viewingContact['created_at'] }} ({{ $viewingContact['created_relative'] }})</span>
                                </p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeViewModal" style="width: 32px; height: 32px; border-radius: 8px; border: none; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease;" title="Đóng">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- 2-Column Responsive Body (Matches Image Layout Exactly) -->
                    <div class="cl-vmodal-grid">
                        
                        <!-- LEFT COLUMN: Customer Info, Contact & Metadata Card -->
                        <div class="cl-vmodal-left-card">
                            
                            <!-- 1. Customer Profile Box with Avatar & Online Dot -->
                            <div class="cl-vmodal-profile-wrap">
                                <div class="cl-vmodal-avatar-circle" style="background: {{ $vAvatarBg }};">
                                    @if ($viewingContact['avatar'])
                                        <img src="{{ $viewingContact['avatar'] }}" alt="{{ $viewingContact['fullname'] }}">
                                    @else
                                        {{ $initials }}
                                    @endif
                                    <span class="cl-vmodal-online-dot" title="Khách hàng trực tuyến"></span>
                                </div>
                                <div style="min-width: 0; flex: 1 1 auto;">
                                    <div class="cl-vmodal-cust-name-row">
                                        <span class="cl-vmodal-cust-name" title="{{ $viewingContact['fullname'] }}">
                                            {{ $viewingContact['fullname'] }}
                                        </span>
                                        <button type="button" wire:click="openEditModal({{ $viewingContact['id'] }})" class="cl-vmodal-edit-icon" title="Chỉnh sửa thông tin">
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="cl-vmodal-badges-row">
                                        <span class="cl-vbadge-type">
                                            <svg style="width: 11px; height: 11px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <span>{{ $viewingContact['customer_type'] ?: 'Khách hàng mới' }}</span>
                                        </span>
                                        @if(!empty($viewingContact['visitor_uuid']))
                                            <a href="{{ route('filament.admin.pages.chat-visitors', ['visitor' => $viewingContact['visitor_uuid']]) }}" class="cl-vbadge-sync" title="Đã liên kết Customer 360">
                                                <span>360°</span>
                                                <span>Đã đồng bộ</span>
                                            </a>
                                        @else
                                            <span class="cl-vbadge-sync" style="background: #fff7ed; color: #ea580c; border: 1px solid #ffedd5;">
                                                <span>360°</span>
                                                <span>Đã đồng bộ</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="cl-vmodal-divider"></div>

                            <!-- 2. Contact Phone & Email Rows -->
                            <div style="display: flex; flex-direction: column; gap: 0.625rem;">
                                <!-- Phone -->
                                <div class="cl-vmodal-contact-row">
                                    <div class="cl-vmodal-clabel">
                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>Số điện thoại</span>
                                    </div>
                                    <div class="cl-vmodal-cval-wrap">
                                        @if($viewingContact['phone'])
                                            <a href="tel:{{ $viewingContact['phone'] }}" class="cl-vmodal-cval">{{ $viewingContact['phone'] }}</a>
                                            <button type="button" 
                                                    onclick="navigator.clipboard.writeText('{{ $viewingContact['phone'] }}'); this.title='Đã sao chép!';" 
                                                    class="cl-vmodal-copy-btn" 
                                                    title="Sao chép số điện thoại">
                                                <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </button>
                                        @else
                                            <span style="font-size: 0.75rem; color: #94a3b8; font-style: italic;">Chưa có</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="cl-vmodal-contact-row">
                                    <div class="cl-vmodal-clabel">
                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Email</span>
                                    </div>
                                    <div class="cl-vmodal-cval-wrap">
                                        @if($viewingContact['email'])
                                            <a href="mailto:{{ $viewingContact['email'] }}" class="cl-vmodal-cval" title="{{ $viewingContact['email'] }}">
                                                {{ $viewingContact['email'] }}
                                            </a>
                                            <button type="button" 
                                                    onclick="navigator.clipboard.writeText('{{ $viewingContact['email'] }}'); this.title='Đã sao chép!';" 
                                                    class="cl-vmodal-copy-btn" 
                                                    title="Sao chép email">
                                                <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </button>
                                        @else
                                            <span style="font-size: 0.75rem; color: #94a3b8; font-style: italic;">Chưa có</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="cl-vmodal-divider"></div>

                            <!-- 3. 2x2 Reception Grid -->
                            <div class="cl-vmodal-meta-grid">
                                <!-- Cell 1: Kênh tiếp nhận -->
                                <div class="cl-vmodal-mcell">
                                    <span class="cl-vmodal-mlabel">
                                        <svg style="width: 13px; height: 13px; color: #2563eb;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                        <span>Kênh tiếp nhận</span>
                                    </span>
                                    <span class="cl-vmodal-mchip-blue">
                                        <svg style="width: 11px; height: 11px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span>{{ $vChannelCfg['label'] === 'Website' ? 'Form Liên Hệ' : $vChannelCfg['label'] }}</span>
                                    </span>
                                </div>

                                <!-- Cell 2: Dịch vụ quan tâm -->
                                <div class="cl-vmodal-mcell">
                                    <span class="cl-vmodal-mlabel">
                                        <svg style="width: 13px; height: 13px; color: #ea580c;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Dịch vụ quan tâm</span>
                                    </span>
                                    <span class="cl-vmodal-mchip-orange" title="{{ $viewingContact['service_interested'] ?: 'Sản xuất Phim & Video' }}">
                                        <svg style="width: 11px; height: 11px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $viewingContact['service_interested'] ?: 'Sản xuất Phim & Video' }}</span>
                                    </span>
                                </div>

                                <!-- Cell 3: Nguồn -->
                                <div class="cl-vmodal-mcell">
                                    <span class="cl-vmodal-mlabel">
                                        <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                        <span>Nguồn</span>
                                    </span>
                                    @php
                                        $sourceUrl = $viewingContact['source_url'] ?: 'https://truyenthongcuulong.com/lien-he';
                                    @endphp
                                    <a href="{{ $sourceUrl }}" target="_blank" class="cl-vmodal-mlink" title="{{ $sourceUrl }}">
                                        <span class="truncate">{{ $sourceUrl }}</span>
                                        <svg style="width: 11px; height: 11px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                </div>

                                <!-- Cell 4: Thời gian -->
                                <div class="cl-vmodal-mcell">
                                    <span class="cl-vmodal-mlabel">
                                        <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Thời gian</span>
                                    </span>
                                    <span class="cl-vmodal-mtime">{{ $viewingContact['created_at'] }}</span>
                                </div>
                            </div>

                            <div class="cl-vmodal-divider"></div>

                            <!-- 4. Tags Section -->
                            <div>
                                <div class="cl-vmodal-tag-head">
                                    <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <span>Tag</span>
                                </div>
                                <div class="cl-vmodal-tags-wrap">
                                    <span class="cl-vtag-item cl-vtag-orange">
                                        <svg style="width: 11px; height: 11px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                        </svg>
                                        <span>Khách hàng tiềm năng</span>
                                    </span>
                                    <span class="cl-vtag-item cl-vtag-blue">
                                        <svg style="width: 11px; height: 11px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                        </svg>
                                        <span>Website</span>
                                    </span>
                                    <span class="cl-vtag-item cl-vtag-purple">
                                        <svg style="width: 11px; height: 11px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <span>Doanh nghiệp</span>
                                    </span>
                                    <button type="button" wire:click="openEditModal({{ $viewingContact['id'] }})" class="cl-vtag-item cl-vtag-add">
                                        <span>+ Thêm tag</span>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <!-- RIGHT COLUMN: Tabbed Workspace Card -->
                        <div class="cl-vmodal-right-card">
                            
                            <!-- Custom Tabs Navigation -->
                            <div class="cl-vtabs-nav">
                                <button type="button" wire:click="setActiveViewTab('messages')" class="cl-vtab-btn {{ $activeViewTab === 'messages' ? 'active' : '' }}">
                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                    </svg>
                                    <span>Tin nhắn</span>
                                </button>
                                <button type="button" wire:click="setActiveViewTab('info')" class="cl-vtab-btn {{ $activeViewTab === 'info' ? 'active' : '' }}">
                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>Thông tin</span>
                                </button>
                                <button type="button" wire:click="setActiveViewTab('history')" class="cl-vtab-btn {{ $activeViewTab === 'history' ? 'active' : '' }}">
                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Lịch sử</span>
                                </button>
                                <button type="button" wire:click="setActiveViewTab('notes')" class="cl-vtab-btn {{ $activeViewTab === 'notes' ? 'active' : '' }}">
                                    <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span>Ghi chú</span>
                                </button>
                            </div>

                            <!-- TAB 1: TIN NHẮN (MESSAGES) -->
                            @if ($activeViewTab === 'messages')
                                <div style="display: flex; flex-direction: column; gap: 0.75rem; flex-grow: 1;">
                                    
                                    <!-- Customer Chat Thread Box -->
                                    <div class="cl-vmodal-chat-thread">
                                        <!-- Customer Bubble -->
                                        <div class="cl-vmsg-item">
                                            <div class="cl-vmsg-avatar" style="background: {{ $vAvatarBg }};">
                                                {{ $initials }}
                                            </div>
                                            <div class="cl-vmsg-content-wrap">
                                                <div class="cl-vmsg-meta-row">
                                                    <span class="cl-vmsg-sender">{{ $viewingContact['fullname'] }}</span>
                                                    <span class="cl-vmsg-time">{{ $viewingContact['created_at'] }}</span>
                                                    <button type="button" 
                                                            onclick="navigator.clipboard.writeText(`{{ addslashes($viewingContact['message']) }}`); this.innerText='✓ Đã chép'; setTimeout(()=>this.innerText='...', 1500);" 
                                                            style="background: transparent; border: none; color: #94a3b8; font-size: 14px; cursor: pointer; margin-left: auto;" 
                                                            title="Sao chép nội dung">
                                                        ...
                                                    </button>
                                                </div>
                                                <div class="cl-vmsg-bubble">
                                                    {{ $viewingContact['message'] }}
                                                </div>
                                                <span class="cl-vmsg-sublabel">Khách hàng</span>
                                            </div>
                                        </div>

                                        <!-- If Admin replied before, show agent reply bubble -->
                                        @if(!empty($viewingContact['admin_note']))
                                            <div class="cl-vmsg-item" style="flex-direction: row-reverse;">
                                                <div class="cl-vmsg-avatar" style="background: linear-gradient(135deg, #ff5400, #ff8c00);">
                                                    CL
                                                </div>
                                                <div class="cl-vmsg-content-wrap" style="text-align: right;">
                                                    <div class="cl-vmsg-meta-row" style="justify-content: flex-end;">
                                                        <span class="cl-vmsg-time">{{ $viewingContact['replied_at'] ?: 'Nội bộ' }}</span>
                                                        <span class="cl-vmsg-sender" style="color: #ff5400;">Cửu Long CSKH</span>
                                                    </div>
                                                    <div class="cl-vmsg-bubble" style="background: #eff6ff; border-color: #bfdbfe; text-align: left; display: inline-block;">
                                                        {{ $viewingContact['admin_note'] }}
                                                    </div>
                                                    <span class="cl-vmsg-sublabel" style="text-align: right;">Ghi chú / Phản hồi</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Quick Canned Responses Bar (Gửi tin nhắn nhanh) -->
                                    <div class="cl-vquick-sec">
                                        <div class="cl-vquick-head">
                                            <span class="cl-vquick-title">
                                                <svg style="width: 14px; height: 14px; color: #ff5400;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                                <span>Gửi tin nhắn nhanh</span>
                                            </span>
                                            <span class="cl-vquick-kbd">
                                                <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                <span>Phím tắt</span>
                                            </span>
                                        </div>

                                        <div class="cl-vquick-chips-grid">
                                            <button type="button" wire:click="applyQuickReply('hello')" class="cl-vquick-chip">
                                                <span class="cl-vchip-k" style="color: #ea580c;">/ &nbsp; /hello</span>
                                                <span class="cl-vchip-desc">Lời chào thân thiện</span>
                                            </button>
                                            <button type="button" wire:click="applyQuickReply('gia')" class="cl-vquick-chip">
                                                <span class="cl-vchip-k" style="color: #ec4899;">/ &nbsp; /gia</span>
                                                <span class="cl-vchip-desc">Gửi thông tin giá dịch vụ</span>
                                            </button>
                                            <button type="button" wire:click="applyQuickReply('web')" class="cl-vquick-chip">
                                                <span class="cl-vchip-k" style="color: #0284c7;">/ &nbsp; /web</span>
                                                <span class="cl-vchip-desc">Tư vấn dịch vụ website</span>
                                            </button>
                                            <button type="button" wire:click="applyQuickReply('contact')" class="cl-vquick-chip">
                                                <span class="cl-vchip-k" style="color: #10b981;">/ &nbsp; /contact</span>
                                                <span class="cl-vchip-desc">Thông tin liên hệ</span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Interactive Chat Input Box -->
                                    <div class="cl-vchatbox">
                                        <textarea wire:model.defer="viewReplyMessage" 
                                                  wire:keydown.enter.prevent="sendReply"
                                                  class="cl-vchatbox-textarea" 
                                                  placeholder="Nhập tin nhắn..."></textarea>
                                        <div class="cl-vchatbox-toolbar">
                                            <div class="cl-vtb-icons">
                                                <button type="button" class="cl-vtb-icon-btn" title="Đính kèm tệp">
                                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                                    </svg>
                                                </button>
                                                <button type="button" class="cl-vtb-icon-btn" title="Biểu cảm">
                                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </button>
                                                <button type="button" class="cl-vtb-icon-btn" title="Gửi ảnh">
                                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="cl-vtb-right">
                                                <span class="cl-vtb-hints">Enter: Gửi &nbsp;|&nbsp; Shift + Enter: Xuống dòng &nbsp;&nbsp; {{ strlen($viewReplyMessage) }}/2000</span>
                                                <button type="button" wire:click="sendReply" class="cl-vsend-btn" title="Gửi tin nhắn">
                                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @elseif ($activeViewTab === 'info')
                                <!-- TAB 2: THÔNG TIN (CUSTOMER 360 PROFILE) -->
                                <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.8125rem;">
                                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem;">
                                        <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Hồ Sơ Nhận Diện Khách Hàng (Customer 360)</h4>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; font-size: 0.75rem;">
                                            <div>
                                                <span style="color: #64748b;">Mã yêu cầu:</span>
                                                <strong style="color: #0f172a;">#{{ $viewingContact['id'] }}</strong>
                                            </div>
                                            <div>
                                                <span style="color: #64748b;">Địa chỉ IP:</span>
                                                <strong style="color: #0f172a;">{{ $viewingContact['ip_address'] ?? '127.0.0.1' }}</strong>
                                            </div>
                                            <div>
                                                <span style="color: #64748b;">Mã định danh Visitor:</span>
                                                <strong style="color: #0f172a;">{{ $viewingContact['visitor_uuid'] ?? 'Khách vãng lai' }}</strong>
                                            </div>
                                            <div>
                                                <span style="color: #64748b;">Kênh ghi nhận:</span>
                                                <strong style="color: #0f172a;">{{ ucfirst($viewingContact['channel'] ?: 'website') }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    @if(!empty($viewingContact['visitor_uuid']))
                                        <div style="padding: 0.875rem 1rem; border: 1px dashed #fdba74; background: #fff7ed; border-radius: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                                            <div>
                                                <div style="font-weight: 700; color: #c2410c; font-size: 0.8125rem;">Khách hàng đã đồng bộ Live Chat</div>
                                                <div style="font-size: 0.6875rem; color: #ea580c;">Bạn có thể mở toàn bộ lịch sử trò chuyện & hành vi của khách hàng trên website.</div>
                                            </div>
                                            <a href="{{ route('filament.admin.pages.chat-visitors', ['visitor' => $viewingContact['visitor_uuid']]) }}" class="cl-btn-primary" style="padding: 0.4rem 0.85rem; font-size: 0.75rem; text-decoration: none;">
                                                Mở Live Chat 360 &rarr;
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @elseif ($activeViewTab === 'history')
                                <!-- TAB 3: LỊCH SỬ TIẾN ĐỘ -->
                                <div style="display: flex; flex-direction: column; gap: 0.625rem; font-size: 0.78125rem;">
                                    <div style="display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.625rem 0; border-bottom: 1px solid #f1f5f9;">
                                        <div style="width: 8px; height: 8px; border-radius: 9999px; background: #10b981; margin-top: 5px;"></div>
                                        <div>
                                            <div style="font-weight: 700; color: #0f172a;">Khách hàng gửi yêu cầu tư vấn</div>
                                            <div style="font-size: 0.6875rem; color: #64748b;">Thời gian: {{ $viewingContact['created_at'] }} thông qua {{ $vChannelCfg['label'] }}</div>
                                        </div>
                                    </div>
                                    <div style="display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.625rem 0; border-bottom: 1px solid #f1f5f9;">
                                        <div style="width: 8px; height: 8px; border-radius: 9999px; background: {{ $vStatusCfg['dot'] }}; margin-top: 5px;"></div>
                                        <div>
                                            <div style="font-weight: 700; color: #0f172a;">Trạng thái hiện tại: {{ $vStatusCfg['label'] }}</div>
                                            <div style="font-size: 0.6875rem; color: #64748b;">{{ $viewingContact['replied_at'] ? 'Đã phản hồi lúc ' . $viewingContact['replied_at'] : 'Đang chờ nhân viên xử lý' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($activeViewTab === 'notes')
                                <!-- TAB 4: GHI CHÚ NỘI BỘ -->
                                <div style="display: flex; flex-direction: column; gap: 0.625rem;">
                                    <label style="font-size: 0.75rem; font-weight: 700; color: #475569;">Ghi chú nội bộ cho nhân viên kinh doanh / tư vấn:</label>
                                    <textarea wire:model.defer="viewNoteDraft" rows="5" class="w-full px-3.5 py-2.5 border border-slate-300 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-[#131c2b] focus:border-[#ff5400] outline-none" placeholder="Nhập ghi chú chi tiết về nhu cầu, ngân sách hoặc lịch hẹn tư vấn của khách..."></textarea>
                                    <div style="display: flex; justify-content: flex-end;">
                                        <button type="button" wire:click="saveViewAdminNote" class="cl-btn-primary" style="padding: 0.45rem 1rem; font-size: 0.8125rem;">
                                            Lưu ghi chú
                                        </button>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- Compact Footer Actions Bar (Matches Exact Buttons in Image) -->
                    <div class="cl-vmodal-footer">
                        <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                            @if($viewingContact['phone'])
                                <a href="tel:{{ $viewingContact['phone'] }}" class="cl-mfooter-btn-call" title="Gọi cho khách hàng">
                                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span>Gọi điện</span>
                                </a>
                            @endif
                            @if ($viewingContact['email'])
                                <a href="mailto:{{ $viewingContact['email'] }}" class="cl-mfooter-btn-email" title="Gửi email cho khách hàng">
                                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Gửi Email</span>
                                </a>
                            @endif
                            <button type="button" wire:click="openEditModal({{ $viewingContact['id'] }})" class="cl-mfooter-btn-edit">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                <span>Ghi chú / Sửa</span>
                            </button>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <!-- Dropdown Chuyển trạng thái -->
                            <select onchange="@this.quickUpdateStatus({{ $viewingContact['id'] }}, this.value)" class="cl-mfooter-status-select" title="Chuyển trạng thái xử lý">
                                <option disabled value="">🔄 Chuyển trạng thái</option>
                                <option value="new" {{ $viewStatus === 'new' ? 'selected' : '' }}>• Chờ xử lý</option>
                                <option value="contacting" {{ $viewStatus === 'contacting' ? 'selected' : '' }}>• Đang liên hệ</option>
                                <option value="quoted" {{ $viewStatus === 'quoted' ? 'selected' : '' }}>• Đã báo giá</option>
                                <option value="signed" {{ $viewStatus === 'signed' ? 'selected' : '' }}>• Chốt hợp đồng</option>
                                <option value="resolved" {{ $viewStatus === 'resolved' ? 'selected' : '' }}>• Đã xử lý</option>
                                <option value="rejected" {{ $viewStatus === 'rejected' ? 'selected' : '' }}>• Từ chối</option>
                            </select>

                            <button type="button" wire:click="closeViewModal" class="cl-mfooter-btn-close">
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
                <div style="padding: 1.25rem 1.5rem;">
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-orange-500/10 text-[#ff5400] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-white">Cập Nhật Trạng Thái Yêu Cầu #{{ $editingContactId }}</h3>
                                <p class="text-xs text-slate-500">Cập nhật tiến độ xử lý và phản hồi tới khách hàng</p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeEditModal" style="width: 28px; height: 28px; border-radius: 8px; border: none; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease;" title="Đóng">
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
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
