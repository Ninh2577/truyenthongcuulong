<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $display = $this->getDisplayData();
        $users = $display['users'];
        $availableRoles = $this->getAvailableRoles();
        $createUrl = \App\Filament\Resources\UserResource::getUrl('create');
    @endphp

    <style>
        .cl-user-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-user-wrapper {
            color: #f1f5f9;
        }

        /* Top Header */
        .cl-user-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 1024px) {
            .cl-user-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Breadcrumb */
        .cl-user-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .dark .cl-user-breadcrumb {
            color: #94a3b8;
        }
        .cl-user-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-user-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Title Area */
        .cl-user-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cl-user-title-icon {
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
        .cl-user-title-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
            color: #0f172a;
            margin: 0;
        }
        .dark .cl-user-title-text h1 {
            color: #f8fafc;
        }
        .cl-user-title-text p {
            font-size: 0.84rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }
        .dark .cl-user-title-text p {
            color: #94a3b8;
        }

        /* Top Action Buttons */
        .cl-user-actions {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            flex-wrap: wrap;
        }
        .cl-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #ff5400;
            color: #ffffff;
            font-size: 0.84rem;
            font-weight: 600;
            padding: 0.625rem 1.125rem;
            border-radius: 0.625rem;
            text-decoration: none;
            border: 1px solid #ff5400;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.25);
            transition: all 0.15s ease;
            cursor: pointer;
        }
        .cl-btn-primary:hover {
            background: #e04a00;
            border-color: #e04a00;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.35);
            transform: translateY(-1px);
        }

        /* 4 Top KPI Cards */
        .cl-kpi-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 0.875rem;
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
            padding: 1.125rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .dark .cl-kpi-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .cl-kpi-left {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }
        .cl-kpi-icon {
            width: 2.875rem;
            height: 2.875rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ffffff;
        }
        .cl-kpi-label {
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
        }
        .dark .cl-kpi-label {
            color: #94a3b8;
        }
        .cl-kpi-val {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }
        .dark .cl-kpi-val {
            color: #f8fafc;
        }
        .cl-kpi-sub {
            font-size: 0.72rem;
            color: #94a3b8;
        }

        /* Filter Toolbar */
        .cl-toolbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            margin-bottom: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        .dark .cl-toolbar {
            background: #182234;
            border-color: #26354a;
        }
        @media (min-width: 1024px) {
            .cl-toolbar-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
            }
        }

        .cl-search-box {
            position: relative;
            flex: 1;
            max-width: 360px;
        }
        .cl-search-box svg {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.125rem;
            height: 1.125rem;
            color: #94a3b8;
            pointer-events: none;
        }
        .cl-search-input {
            width: 100%;
            padding: 0.55rem 0.85rem 0.55rem 2.4rem;
            font-size: 0.84rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.625rem;
            background: #f8fafc;
            color: #0f172a;
            outline: none;
            transition: all 0.15s ease;
        }
        .dark .cl-search-input {
            background: #0f172a;
            border-color: #334155;
            color: #f8fafc;
        }
        .cl-search-input:focus {
            border-color: #ff5400;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.12);
        }
        .dark .cl-search-input:focus {
            background: #0f172a;
        }

        .cl-filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .cl-select {
            padding: 0.5rem 2rem 0.5rem 0.85rem;
            font-size: 0.8125rem;
            line-height: 1.35;
            border: 1px solid #cbd5e1;
            border-radius: 0.625rem;
            background-color: #ffffff;
            color: #334155;
            outline: none;
            cursor: pointer;
            transition: all 0.15s ease;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.65rem center;
            background-size: 0.85rem;
        }
        .cl-select:hover {
            border-color: #ff5400;
        }
        .cl-select:focus {
            border-color: #ff5400;
            box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15);
        }
        .dark .cl-select {
            background-color: #0f172a;
            border-color: #334155;
            color: #cbd5e1;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        }

        .cl-view-toggle {
            display: inline-flex;
            border: 1px solid #cbd5e1;
            border-radius: 0.625rem;
            overflow: hidden;
            background: #f1f5f9;
            padding: 2px;
        }
        .dark .cl-view-toggle {
            background: #0f172a;
            border-color: #334155;
        }
        .cl-view-btn {
            padding: 0.35rem 0.6rem;
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            border-radius: 0.45rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s;
        }
        .cl-view-btn.active {
            background: #ffffff;
            color: #ff5400;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            font-weight: 600;
        }
        .dark .cl-view-btn.active {
            background: #1e293b;
            color: #ff5400;
        }

        /* Bulk Actions Bar */
        .cl-bulk-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.65rem 1rem;
            background: #fff7ed;
            border: 1px solid #ffedd5;
            border-radius: 0.625rem;
            font-size: 0.8125rem;
            color: #c2410c;
        }
        .dark .cl-bulk-bar {
            background: rgba(255, 84, 0, 0.1);
            border-color: rgba(255, 84, 0, 0.2);
            color: #fdba74;
        }

        /* Table Design */
        .cl-table-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            margin-bottom: 1.25rem;
        }
        .dark .cl-table-container {
            background: #182234;
            border-color: #26354a;
        }
        .cl-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.84rem;
        }
        .cl-table thead {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .dark .cl-table thead {
            background: #131c2e;
            border-bottom-color: #26354a;
        }
        .cl-table th {
            padding: 0.85rem 1rem;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
        }
        .dark .cl-table th {
            color: #94a3b8;
        }
        .cl-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.12s ease;
        }
        .dark .cl-table tbody tr {
            border-bottom-color: #1e293b;
        }
        .cl-table tbody tr:hover {
            background: #f8fafc;
        }
        .dark .cl-table tbody tr:hover {
            background: rgba(30, 41, 59, 0.5);
        }
        .cl-table td {
            padding: 0.95rem 1rem;
            vertical-align: middle;
        }

        /* User Avatar in Table */
        .cl-avatar-wrap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .cl-avatar-circle {
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            color: #ffffff;
            flex-shrink: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }
        .cl-user-name {
            font-weight: 600;
            color: #0f172a;
            line-height: 1.3;
        }
        .dark .cl-user-name {
            color: #f8fafc;
        }

        /* Role Badges */
        .cl-role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.55rem;
            border-radius: 9999px;
            font-size: 0.72rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .cl-role-super-admin {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fca5a5;
        }
        .dark .cl-role-super-admin {
            background: rgba(220, 38, 38, 0.2);
            color: #f87171;
            border-color: rgba(220, 38, 38, 0.4);
        }
        .cl-role-admin {
            background: #ffedd5;
            color: #c2410c;
            border: 1px solid #fdba74;
        }
        .dark .cl-role-admin {
            background: rgba(234, 88, 12, 0.2);
            color: #fb923c;
            border-color: rgba(234, 88, 12, 0.4);
        }
        .cl-role-editor {
            background: #dbeafe;
            color: #1d4ed8;
            border: 1px solid #93c5fd;
        }
        .dark .cl-role-editor {
            background: rgba(29, 78, 216, 0.2);
            color: #60a5fa;
            border-color: rgba(29, 78, 216, 0.4);
        }
        .cl-role-other {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .dark .cl-role-other {
            background: #1e293b;
            color: #cbd5e1;
            border-color: #334155;
        }

        /* 2FA Badge */
        .cl-2fa-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.55rem;
            border-radius: 9999px;
            font-size: 0.72rem;
            font-weight: 600;
        }
        .cl-2fa-on {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }
        .dark .cl-2fa-on {
            background: rgba(22, 163, 74, 0.2);
            color: #4ade80;
            border-color: rgba(22, 163, 74, 0.4);
        }
        .cl-2fa-off {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
        .dark .cl-2fa-off {
            background: #1e293b;
            color: #94a3b8;
            border-color: #334155;
        }

        /* Action Buttons in Row */
        .cl-row-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.35rem;
        }
        .cl-btn-row-edit {
            padding: 0.35rem 0.65rem;
            border-radius: 0.45rem;
            font-size: 0.75rem;
            font-weight: 600;
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.15s ease;
            border: 1px solid #e2e8f0;
        }
        .dark .cl-btn-row-edit {
            background: #1e293b;
            border-color: #334155;
            color: #e2e8f0;
        }
        .cl-btn-row-edit:hover {
            background: #ff5400;
            color: #ffffff;
            border-color: #ff5400;
        }
        .cl-btn-row-delete {
            padding: 0.35rem 0.55rem;
            border-radius: 0.45rem;
            font-size: 0.75rem;
            background: transparent;
            color: #94a3b8;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .cl-btn-row-delete:hover:not(:disabled) {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fca5a5;
        }
        .cl-btn-row-delete:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        /* Grid Cards View */
        .cl-grid-cards {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        @media (min-width: 640px) {
            .cl-grid-cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .cl-grid-cards {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        .cl-user-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: all 0.15s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .dark .cl-user-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }

        /* Pagination Footer Bar */
        /* Pagination Footer Bar */
        .cl-pagination-bar {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1.25rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        .dark .cl-pagination-bar {
            background: #182234;
            border-color: #26354a;
        }
        .cl-page-info {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            flex-wrap: wrap;
            flex-shrink: 0;
        }
        .cl-page-indicator {
            font-size: 0.8125rem;
            color: #64748b;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .dark .cl-page-indicator {
            color: #94a3b8;
        }
        .cl-per-page-wrap {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8125rem;
            color: #64748b;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .dark .cl-per-page-wrap {
            color: #94a3b8;
        }
        .cl-per-page-select {
            padding: 0.35rem 1.85rem 0.35rem 0.75rem;
            font-size: 0.8125rem;
            font-weight: 600;
            line-height: 1.35;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            background-color: #ffffff;
            color: #334155;
            outline: none;
            cursor: pointer;
            min-width: 5.2rem;
            box-sizing: border-box;
            flex-shrink: 0;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.55rem center;
            background-size: 0.8rem;
            transition: all 0.15s ease;
        }
        .cl-per-page-select:hover {
            border-color: #ff5400;
        }
        .cl-per-page-select:focus {
            border-color: #ff5400;
            box-shadow: 0 0 0 2px rgba(255, 84, 0, 0.15);
        }
        .dark .cl-per-page-select {
            background-color: #0f172a;
            border-color: #334155;
            color: #f1f5f9;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        }
        .cl-page-group {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .cl-p-dots {
            min-width: 1.5rem;
            height: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-weight: 700;
            font-size: 0.875rem;
            user-select: none;
            letter-spacing: 0.1em;
        }
        .cl-p-btn {
            min-width: 2rem;
            height: 2rem;
            padding: 0 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #334155;
            font-size: 0.8125rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-p-btn {
            background: #0f172a;
            border-color: #334155;
            color: #cbd5e1;
        }
        .cl-p-btn:hover:not(:disabled) {
            border-color: #ff5400;
            color: #ff5400;
        }
        .cl-p-btn.active {
            background: #ff5400;
            color: #ffffff;
            border-color: #ff5400;
        }
        .cl-p-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Delete Confirmation Modal Styles */
        .cl-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999999;
            padding: 1.25rem;
        }
        .cl-modal-dialog {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            animation: clZoomIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .dark .cl-modal-dialog {
            background: #182234;
            border-color: #26354a;
        }
        @keyframes clZoomIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .cl-delete-icon-wrapper {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 9999px;
            background: #fee2e2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem auto;
        }
        .dark .cl-delete-icon-wrapper {
            background: rgba(220, 38, 38, 0.2);
            color: #f87171;
        }
        .cl-btn-delete-confirm {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #dc2626;
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.6rem 1.25rem;
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.35);
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-btn-delete-confirm:hover {
            background: #b91c1c;
            transform: translateY(-1px);
        }
        .cl-btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #334155;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.6rem 1.25rem;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .dark .cl-btn-cancel {
            background: #1e293b;
            border-color: #334155;
            color: #e2e8f0;
        }
        .cl-btn-cancel:hover {
            background: #f1f5f9;
        }
    </style>

    <div class="cl-user-wrapper">
        <!-- TOP BREADCRUMB & HEADER -->
        <div class="cl-user-header">
            <div>
                <div class="cl-user-breadcrumb">
                    <a href="{{ url('/cuulongteam') }}">Trang chủ</a>
                    <span>/</span>
                    <span>CẤU HÌNH & HỆ THỐNG</span>
                    <span>/</span>
                    <span class="text-slate-900 dark:text-slate-100 font-semibold">Tài khoản</span>
                </div>
                <div class="cl-user-title-group">
                    <div class="cl-user-title-icon">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="cl-user-title-text">
                        <h1>Tài khoản quản trị hệ thống</h1>
                        <p>Quản lý tài khoản người dùng, phân quyền truy cập và kiểm soát an toàn bảo mật 2FA</p>
                    </div>
                </div>
            </div>

            <div class="cl-user-actions">
                <a href="{{ $createUrl }}" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Thêm tài khoản mới</span>
                </a>
            </div>
        </div>

        <!-- 4 TOP KPI METRIC CARDS -->
        <div class="cl-kpi-grid">
            <!-- Metric 1: Total Users -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background: linear-gradient(135deg, #FF5400 0%, #EA580C 100%);">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="cl-kpi-label">Tổng tài khoản</div>
                        <div class="cl-kpi-val">{{ $metrics['total'] }}</div>
                        <div class="cl-kpi-sub">Thành viên trong hệ thống</div>
                    </div>
                </div>
            </div>

            <!-- Metric 2: Admins -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="cl-kpi-label">Quản trị viên</div>
                        <div class="cl-kpi-val">{{ $metrics['admins'] }}</div>
                        <div class="cl-kpi-sub">Super Admin & Admin</div>
                    </div>
                </div>
            </div>

            <!-- Metric 3: Editors -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <div class="cl-kpi-label">Biên Tập Viên</div>
                        <div class="cl-kpi-val">{{ $metrics['editors'] }}</div>
                        <div class="cl-kpi-sub">Quản trị bài viết & nội dung</div>
                    </div>
                </div>
            </div>

            <!-- Metric 4: 2FA Active -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background: linear-gradient(135deg, #16A34A 0%, #15803D 100%);">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <div class="cl-kpi-label">Bảo mật 2FA</div>
                        <div class="cl-kpi-val">{{ $metrics['two_factor'] }}</div>
                        <div class="cl-kpi-sub">Tài khoản đã bật 2FA</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTER & TOOLBAR -->
        <div class="cl-toolbar">
            <div class="cl-toolbar-top">
                <!-- Search Box -->
                <div class="cl-search-box">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input
                        type="text"
                        wire:model.live.debounce.350ms="search"
                        placeholder="Tìm kiếm theo họ tên, email..."
                        class="cl-search-input"
                    />
                </div>

                <!-- Filters -->
                <div class="cl-filter-group">
                    <!-- Role Filter -->
                    <select wire:model.live="selectedRole" class="cl-select">
                        <option value="">Tất cả vai trò</option>
                        @foreach($availableRoles as $r)
                            <option value="{{ $r }}">{{ $r }}</option>
                        @endforeach
                    </select>

                    <!-- 2FA Filter -->
                    <select wire:model.live="selected2FA" class="cl-select">
                        <option value="">Bảo mật 2FA (Tất cả)</option>
                        <option value="enabled">Đã bật 2FA</option>
                        <option value="disabled">Chưa kích hoạt 2FA</option>
                    </select>

                    <!-- Sort -->
                    <select wire:model.live="selectedSort" class="cl-select">
                        <option value="latest">Mới nhất</option>
                        <option value="oldest">Cũ nhất</option>
                        <option value="name_asc">Tên A → Z</option>
                        <option value="name_desc">Tên Z → A</option>
                    </select>

                    <!-- View Mode Toggle -->
                    <div class="cl-view-toggle">
                        <button
                            type="button"
                            wire:click="setViewMode('list')"
                            class="cl-view-btn {{ $viewMode === 'list' ? 'active' : '' }}"
                            title="Chế độ xem Bảng"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            wire:click="setViewMode('grid')"
                            class="cl-view-btn {{ $viewMode === 'grid' ? 'active' : '' }}"
                            title="Chế độ xem Thẻ"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Reset Filters -->
                    @if(!empty($search) || !empty($selectedRole) || !empty($selected2FA) || $selectedSort !== 'latest')
                        <button
                            type="button"
                            wire:click="resetFilters"
                            class="text-xs font-semibold text-orange-600 dark:text-orange-400 hover:underline px-2 py-1"
                        >
                            Đặt lại
                        </button>
                    @endif
                </div>
            </div>

            <!-- Bulk Selection Active Banner -->
            @if(count($selectedUsers) > 0)
                <div class="cl-bulk-bar">
                    <div class="flex items-center gap-2">
                        <span class="font-bold">Đã chọn {{ count($selectedUsers) }} tài khoản</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            wire:click="deleteSelected"
                            wire:confirm="Bạn có chắc chắn muốn xóa các tài khoản đã chọn? (Tài khoản Super Admin và tài khoản hiện tại sẽ tự động được bảo vệ)"
                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-semibold shadow-xs"
                        >
                            Xóa các mục đã chọn
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <!-- MAIN DATA: TABLE OR GRID VIEW -->
        @if($viewMode === 'list')
            <div class="cl-table-container">
                <div style="overflow-x: auto;">
                    <table class="cl-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input
                                        type="checkbox"
                                        wire:click="toggleSelectAll"
                                        {{ $selectAll ? 'checked' : '' }}
                                        class="rounded border-slate-300 text-orange-600 focus:ring-orange-500 cursor-pointer"
                                    />
                                </th>
                                <th>Họ & Tên</th>
                                <th>Email</th>
                                <th>Phân quyền / Vai trò</th>
                                <th>Bảo mật 2FA</th>
                                <th>Ngày tạo</th>
                                <th style="text-align: right;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $u)
                                @php
                                    $firstLetter = mb_substr(trim($u['name']), 0, 1, 'UTF-8');
                                    $palette = ['#ff5400', '#2563eb', '#16a34a', '#8b5cf6', '#ec4899', '#0891b2', '#f59e0b'];
                                    $bgCol = $palette[abs(crc32($u['email'])) % count($palette)];
                                @endphp
                                <tr>
                                    <td>
                                        <input
                                            type="checkbox"
                                            wire:click="toggleSelectUser({{ $u['id'] }})"
                                            {{ in_array($u['id'], $selectedUsers) ? 'checked' : '' }}
                                            class="rounded border-slate-300 text-orange-600 focus:ring-orange-500 cursor-pointer"
                                        />
                                    </td>
                                    <td>
                                        <div class="cl-avatar-wrap">
                                            <div class="cl-avatar-circle" style="background: {{ $bgCol }};">
                                                {{ strtoupper($firstLetter) }}
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-1.5">
                                                    <span class="cl-user-name">{{ $u['name'] }}</span>
                                                    @if($u['is_current'])
                                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-orange-100 text-orange-700 dark:bg-orange-950/60 dark:text-orange-300">
                                                            Bạn
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="text-[11px] text-slate-400">ID: #{{ $u['id'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1.5 font-mono text-xs text-slate-600 dark:text-slate-400">
                                            <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ $u['email'] }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1.5 flex-wrap">
                                            @forelse($u['roles'] as $r)
                                                @php
                                                    $rClass = match($r) {
                                                        'super_admin' => 'cl-role-super-admin',
                                                        'Admin' => 'cl-role-admin',
                                                        'Biên Tập Viên' => 'cl-role-editor',
                                                        default => 'cl-role-other',
                                                    };
                                                @endphp
                                                <span class="cl-role-badge {{ $rClass }}">
                                                    <span>{{ $r === 'super_admin' ? 'Super Admin' : $r }}</span>
                                                </span>
                                            @empty
                                                <span class="text-xs text-slate-400 italic">Chưa phân vai trò</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td>
                                        @if($u['has_2fa'])
                                            <span class="cl-2fa-badge cl-2fa-on" title="Tài khoản đã được bảo vệ với xác thực 2 bước">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                                <span>Đã bật 2FA</span>
                                            </span>
                                        @else
                                            <span class="cl-2fa-badge cl-2fa-off" title="Chưa kích hoạt xác thực 2 bước">
                                                <span>Chưa bật</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-xs text-slate-700 dark:text-slate-300 font-medium">{{ $u['created_at'] }}</div>
                                        <div class="text-[11px] text-slate-400">{{ $u['created_relative'] }}</div>
                                    </td>
                                    <td>
                                        <div class="cl-row-actions">
                                            <a href="{{ $u['edit_url'] }}" class="cl-btn-row-edit" title="Chỉnh sửa thông tin tài khoản">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                <span>Sửa</span>
                                            </a>
                                            <button
                                                type="button"
                                                wire:click="confirmDelete({{ $u['id'] }})"
                                                class="cl-btn-row-delete"
                                                title="{{ $u['can_delete'] ? 'Xóa tài khoản' : $u['delete_reason'] }}"
                                            >
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-slate-400">
                                        Không tìm thấy tài khoản quản trị nào phù hợp với bộ lọc.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- GRID CARDS VIEW -->
            <div class="cl-grid-cards">
                @forelse($users as $u)
                    @php
                        $firstLetter = mb_substr(trim($u['name']), 0, 1, 'UTF-8');
                        $palette = ['#ff5400', '#2563eb', '#16a34a', '#8b5cf6', '#ec4899', '#0891b2', '#f59e0b'];
                        $bgCol = $palette[abs(crc32($u['email'])) % count($palette)];
                    @endphp
                    <div class="cl-user-card">
                        <div>
                            <div class="flex items-start justify-between mb-3">
                                <div class="cl-avatar-wrap">
                                    <div class="cl-avatar-circle" style="background: {{ $bgCol }}; width: 2.75rem; height: 2.75rem; font-size: 1rem;">
                                        {{ strtoupper($firstLetter) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-1.5">
                                            <h4 class="font-bold text-slate-900 dark:text-white text-sm m-0">{{ $u['name'] }}</h4>
                                            @if($u['is_current'])
                                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-orange-100 text-orange-700 dark:bg-orange-950/60 dark:text-orange-300">
                                                    Bạn
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-slate-400 font-mono">{{ $u['email'] }}</span>
                                    </div>
                                </div>

                                <div>
                                    @if($u['has_2fa'])
                                        <span class="w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center" title="2FA đã kích hoạt">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-1.5 flex-wrap my-3">
                                @forelse($u['roles'] as $r)
                                    @php
                                        $rClass = match($r) {
                                            'super_admin' => 'cl-role-super-admin',
                                            'Admin' => 'cl-role-admin',
                                            'Biên Tập Viên' => 'cl-role-editor',
                                            default => 'cl-role-other',
                                        };
                                    @endphp
                                    <span class="cl-role-badge {{ $rClass }}">
                                        <span>{{ $r === 'super_admin' ? 'Super Admin' : $r }}</span>
                                    </span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">Chưa phân vai trò</span>
                                @endforelse
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-400">
                            <span>Tạo: {{ $u['created_at'] }}</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ $u['edit_url'] }}" class="text-orange-600 font-semibold hover:underline">
                                    Chỉnh sửa
                                </a>
                                <button
                                    type="button"
                                    wire:click="confirmDelete({{ $u['id'] }})"
                                    class="text-slate-400 hover:text-red-600 transition"
                                    title="{{ $u['can_delete'] ? 'Xóa tài khoản' : $u['delete_reason'] }}"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-8 text-center text-slate-400">
                        Không tìm thấy tài khoản quản trị nào.
                    </div>
                @endforelse
            </div>
        @endif

        <!-- PAGINATION BAR (SUPPORTS 'all' SMOOTHLY) -->
        <div class="cl-pagination-bar">
            <div class="cl-page-info">
                <span class="cl-page-indicator">
                    Hiển thị <strong>{{ $display['from'] }}-{{ $display['to'] }}</strong> trong tổng số <strong>{{ number_format($display['total']) }}</strong> tài khoản
                </span>

                <div class="cl-per-page-wrap">
                    <span>Mỗi trang:</span>
                    <select wire:model.live="perPage" class="cl-per-page-select">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">Tất cả</option>
                    </select>
                </div>
            </div>

            @if($display['lastPage'] > 1)
                <div class="cl-page-group">
                    {{-- Jump to first page if current page > 3 --}}
                    @if($display['currentPage'] > 3 && $display['lastPage'] > 7)
                        <button
                            type="button"
                            wire:click="setPage(1)"
                            class="cl-p-btn"
                            title="Về trang đầu (1)"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                            </svg>
                        </button>
                    @endif

                    {{-- Prev button --}}
                    <button
                        type="button"
                        wire:click="previousPage"
                        class="cl-p-btn"
                        {{ $display['currentPage'] <= 1 ? 'disabled' : '' }}
                        title="Trang trước"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    {{-- Numbered pages with ellipsis --}}
                    @foreach($display['pages'] as $p)
                        @if($p === '...')
                            <span class="cl-p-dots">...</span>
                        @else
                            <button
                                type="button"
                                wire:click="setPage({{ $p }})"
                                class="cl-p-btn {{ $display['currentPage'] === (int) $p ? 'active' : '' }}"
                            >
                                {{ $p }}
                            </button>
                        @endif
                    @endforeach

                    {{-- Next button --}}
                    <button
                        type="button"
                        wire:click="nextPage"
                        class="cl-p-btn"
                        {{ $display['currentPage'] >= $display['lastPage'] ? 'disabled' : '' }}
                        title="Trang kế tiếp"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    {{-- Jump to last page if not close --}}
                    @if($display['currentPage'] < $display['lastPage'] - 2 && $display['lastPage'] > 7)
                        <button
                            type="button"
                            wire:click="setPage({{ $display['lastPage'] }})"
                            class="cl-p-btn"
                            title="Đến trang cuối ({{ $display['lastPage'] }})"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- DELETE CONFIRMATION MODAL -->
    @if($showDeleteModal)
        <div class="cl-modal-backdrop" wire:click.self="cancelDelete">
            <div class="cl-modal-dialog">
                <div style="padding: 1.5rem; text-align: center;">
                    <div class="cl-delete-icon-wrapper">
                        <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 dark:text-white" style="margin-bottom: 8px;">
                        Xóa Tài Khoản Quản Trị?
                    </h3>

                    @if($canDeleteTarget)
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed" style="font-size: 13px; line-height: 1.6; margin-bottom: 24px;">
                            Bạn có chắc chắn muốn xóa tài khoản của người dùng <strong>"{{ $userToDeleteName }}"</strong>?<br>
                            Tài khoản này sẽ mất toàn bộ quyền truy cập vào Admin Panel và thao tác này không thể hoàn tác.
                        </p>

                        <div style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                            <button type="button" wire:click="cancelDelete" class="cl-btn-cancel">
                                Hủy bỏ
                            </button>
                            <button type="button" wire:click="executeDelete" class="cl-btn-delete-confirm">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Xác nhận xóa</span>
                            </button>
                        </div>
                    @else
                        <div style="padding: 12px; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 12px; margin-bottom: 20px;">
                            <p style="font-size: 13px; color: #e11d48; margin: 0; font-weight: 600;">
                                ⚠️ {{ $deleteDenialReason }}
                            </p>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: center;">
                            <button type="button" wire:click="cancelDelete" class="cl-btn-cancel">
                                Đã hiểu và Đóng
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
