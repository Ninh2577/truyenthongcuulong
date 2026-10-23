<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $facets = $this->getSidebarFacets();
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
            margin-bottom: 1.25rem;
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
            letter-spacing: -0.02em;
        }
        .dark .cl-pp-title-text h1 {
            color: #f8fafc;
        }
        .cl-pp-title-text p {
            font-size: 0.84rem;
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
            gap: 0.5rem;
        }
        .cl-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 0.85rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #334155;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.625rem;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
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
        }

        .cl-btn-export {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 0.85rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #ea580c;
            background: #ffffff;
            border: 1px solid #fed7aa;
            border-radius: 0.625rem;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(234, 88, 12, 0.06);
            white-space: nowrap;
        }
        .dark .cl-btn-export {
            background: #1e293b;
            border-color: #7c2d12;
            color: #fb923c;
        }
        .cl-btn-export:hover {
            background: #fff7ed;
            border-color: #fdba74;
        }

        .cl-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.125rem;
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
            margin-bottom: 1.25rem;
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
            border-radius: 0.875rem;
            padding: 1rem 1.125rem;
            display: flex;
            align-items: center;
            gap: 0.875rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .dark .cl-kpi-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px -3px rgba(0, 0, 0, 0.08);
        }

        .cl-kpi-icon-pill {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .cl-kpi-info {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            flex: 1;
            min-width: 0;
        }
        .cl-kpi-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.03em;
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
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }
        .dark .cl-kpi-value {
            color: #f8fafc;
        }
        .cl-kpi-trend {
            font-size: 0.6875rem;
            font-weight: 600;
            color: #059669;
            background: #ecfdf5;
            padding: 0.125rem 0.375rem;
            border-radius: 9999px;
        }
        .dark .cl-kpi-trend {
            background: #064e3b;
            color: #a7f3d0;
        }
        .cl-kpi-subtext {
            font-size: 0.72rem;
            color: #94a3b8;
        }
        .dark .cl-kpi-subtext {
            color: #64748b;
        }

        /* Two Column Body Grid */
        .cl-body-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            align-items: start;
        }
        @media (min-width: 1024px) {
            .cl-body-grid {
                grid-template-columns: 270px 1fr;
            }
        }
        @media (min-width: 1280px) {
            .cl-body-grid {
                grid-template-columns: 290px 1fr;
            }
        }

        /* Sidebar Styles */
        .cl-sidebar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.125rem;
            display: flex;
            flex-direction: column;
            gap: 1.35rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            align-self: start;
        }
        .dark .cl-sidebar {
            background: #182234;
            border-color: #26354a;
        }
        @media (min-width: 1024px) {
            .cl-sidebar {
                position: sticky;
                top: 5rem;
                max-height: calc(100vh - 6rem);
                overflow-y: auto;
                overscroll-behavior: contain;
                z-index: 10;
                scrollbar-width: thin;
                scrollbar-color: #cbd5e1 transparent;
            }
            .dark .cl-sidebar {
                scrollbar-color: #334155 transparent;
            }
            .cl-sidebar::-webkit-scrollbar {
                width: 5px;
            }
            .cl-sidebar::-webkit-scrollbar-track {
                background: transparent;
            }
            .cl-sidebar::-webkit-scrollbar-thumb {
                background-color: #cbd5e1;
                border-radius: 9999px;
            }
            .dark .cl-sidebar::-webkit-scrollbar-thumb {
                background-color: #334155;
            }
        }
        .cl-sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .dark .cl-sidebar-header {
            border-bottom-color: #26354a;
        }
        .cl-sidebar-title {
            font-size: 0.8125rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .dark .cl-sidebar-title {
            color: #f1f5f9;
        }
        .cl-sidebar-reset {
            font-size: 0.72rem;
            color: #ff5400;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
        }
        .cl-sidebar-reset:hover {
            text-decoration: underline;
        }

        .cl-filter-block-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.625rem;
        }
        .dark .cl-filter-block-title {
            color: #94a3b8;
        }
        .cl-facet-list {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }
        .cl-facet-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8125rem;
            color: #475569;
            cursor: pointer;
            user-select: none;
            padding: 0.25rem 0.35rem;
            border-radius: 0.375rem;
            transition: all 0.15s;
        }
        .dark .cl-facet-item {
            color: #cbd5e1;
        }
        .cl-facet-item:hover {
            background: #f8fafc;
            color: #ff5400;
        }
        .dark .cl-facet-item:hover {
            background: #202d42;
            color: #ff7a29;
        }
        .cl-facet-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 0;
        }
        .cl-facet-label {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .cl-checkbox {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1.5px solid #cbd5e1;
            accent-color: #ff5400;
            cursor: pointer;
        }
        .cl-facet-count {
            font-size: 0.6875rem;
            color: #94a3b8;
            font-weight: 600;
            background: #f1f5f9;
            padding: 0.1rem 0.4rem;
            border-radius: 9999px;
        }
        .dark .cl-facet-count {
            background: #26354a;
            color: #94a3b8;
        }

        .cl-status-facet-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.35rem 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-status-facet-item {
            color: #cbd5e1;
        }
        .cl-status-facet-item:hover {
            background: #f8fafc;
        }
        .dark .cl-status-facet-item:hover {
            background: #202d42;
        }
        .cl-status-facet-item.active {
            background: #fff7ed;
            color: #ea580c;
            font-weight: 600;
        }
        .dark .cl-status-facet-item.active {
            background: rgba(234, 88, 12, 0.15);
            color: #fb923c;
        }

        /* Filter Toolbar */
        .cl-pp-toolbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            padding: 0.75rem 1rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }
        .dark .cl-pp-toolbar {
            background: #182234;
            border-color: #26354a;
        }

        .cl-search-box {
            position: relative;
            flex: 1 1 240px;
            min-width: 200px;
        }
        .cl-search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            width: 1rem;
            height: 1rem;
        }
        .cl-search-input {
            width: 100%;
            padding: 0.5rem 0.75rem 0.5rem 2.25rem;
            font-size: 0.84rem;
            border-radius: 0.5rem;
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
            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.12);
        }
        .dark .cl-search-input:focus {
            background: #182234;
        }

        .cl-filter-controls {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .cl-pp-select {
            padding: 0.45rem 1.85rem 0.45rem 0.7rem;
            font-size: 0.8125rem;
            color: #334155;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.15em 1.15em;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
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
            border-radius: 0.5rem;
            padding: 0.2rem;
            gap: 0.125rem;
        }
        .dark .cl-view-switcher {
            background: #131c2b;
        }
        .cl-view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.875rem;
            height: 1.875rem;
            border-radius: 0.375rem;
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
            box-shadow: 0 1px 4px rgba(255, 84, 0, 0.35);
        }

        /* Data Table (List View) */
        .cl-table-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            margin-bottom: 1.25rem;
        }
        .dark .cl-table-container {
            background: #182234;
            border-color: #26354a;
        }
        .cl-pp-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
            text-align: left;
        }
        .cl-pp-table th {
            padding: 0.75rem 0.625rem;
            font-size: 0.72rem;
            font-weight: 700;
            color: #475569;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.03em;
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
            background: #fafafa;
        }
        .dark .cl-pp-table tr:hover {
            background: #1c273c;
        }

        .cl-service-thumb {
            width: 2.5rem;
            height: 2.5rem;
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
            line-height: 1.3;
            font-size: 0.84rem;
        }
        .dark .cl-service-title {
            color: #f1f5f9;
        }
        .cl-service-title:hover {
            color: #ff5400;
        }
        .cl-service-sub {
            font-size: 0.72rem;
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
            padding: 0.2rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.6875rem;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Quick Location Pills */
        .cl-loc-pills {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            flex-wrap: wrap;
        }
        .cl-loc-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            padding: 0.18rem 0.45rem;
            border-radius: 0.375rem;
            font-size: 0.6875rem;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.15s;
            user-select: none;
        }
        .cl-loc-pill.pricing-on {
            background: #fff7ed;
            color: #ea580c;
            border-color: #fdba74;
        }
        .cl-loc-pill.pricing-off {
            background: #f1f5f9;
            color: #94a3b8;
            border-color: #e2e8f0;
            opacity: 0.65;
        }
        .cl-loc-pill.service-on {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }
        .cl-loc-pill.service-off {
            background: #f1f5f9;
            color: #94a3b8;
            border-color: #e2e8f0;
            opacity: 0.65;
        }
        .cl-loc-pill:hover {
            transform: scale(1.05);
        }

        .cl-featured-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.18rem 0.45rem;
            border-radius: 0.375rem;
            font-size: 0.6875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s;
            user-select: none;
        }
        .cl-featured-badge.on {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fcd34d;
        }
        .cl-featured-badge.off {
            background: #f8fafc;
            color: #94a3b8;
            border: 1px solid #e2e8f0;
        }
        .cl-featured-badge:hover {
            transform: scale(1.05);
        }

        .cl-status-toggle {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
        }
        .cl-status-toggle.active {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }
        .cl-status-toggle.inactive {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
        .cl-status-toggle:hover {
            transform: scale(1.04);
        }

        .cl-order-input {
            width: 3.25rem;
            padding: 0.2rem 0.4rem;
            font-size: 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            text-align: center;
            background: #ffffff;
            color: #0f172a;
        }
        .dark .cl-order-input {
            background: #131c2b;
            border-color: #2a3b54;
            color: #f1f5f9;
        }
        .cl-order-input:focus {
            outline: none;
            border-color: #ff5400;
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
            text-decoration: none;
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
        .cl-action-icon-btn.view:hover {
            color: #059669;
            border-color: #059669;
            background: #ecfdf5;
        }

        /* 3-Column Grid View */
        .cl-grid-container {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }
        @media (min-width: 640px) {
            .cl-grid-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1280px) {
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }
        .dark .cl-grid-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-grid-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.08);
        }
        .cl-grid-card.is-featured-card {
            border-color: #ff5400;
            box-shadow: 0 4px 16px -2px rgba(255, 84, 0, 0.2);
        }

        .cl-grid-card-img-wrap {
            position: relative;
            width: 100%;
            height: 8.5rem;
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
            padding: 1.125rem;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
            gap: 0.875rem;
        }

        /* Footer Pagination */
        .cl-footer-bar {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
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
            gap: 0.35rem;
        }
        .cl-page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.125rem;
            height: 2.125rem;
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
            <span>Dịch vụ & Khách hàng</span>
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
                    <p>Quản lý các gói bảng giá, phạm vi hiển thị trên website và trang dịch vụ chi tiết.</p>
                </div>
            </div>

            <div class="cl-pp-actions">
                <!-- Export Button -->
                <button type="button" wire:click="exportData" class="cl-btn-export" title="Xuất dữ liệu bảng giá ra file CSV">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Xuất CSV</span>
                </button>

                <!-- Filter reset button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Đặt lại</span>
                </button>

                <!-- Primary Create Button -->
                <a href="{{ $createUrl }}" class="cl-btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>+ Thêm gói bảng giá</span>
                </a>
            </div>
        </div>

        <!-- 4 Top KPI Cards -->
        <div class="cl-kpi-grid">
            <!-- Card 1: Tổng số gói dịch vụ -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #eff6ff; color: #2563eb;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Tổng số gói dịch vụ</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['total'] }}</span>
                        <span class="cl-kpi-trend">{{ $metrics['active'] }} hoạt động</span>
                    </div>
                    <span class="cl-kpi-subtext">9 nhóm dịch vụ chính</span>
                </div>
            </div>

            <!-- Card 2: Hiện trên Bảng giá -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #fff7ed; color: #ea580c;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Trang Bảng giá (/dich-vu/bang-gia)</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['pricing_page'] }}</span>
                        <span class="cl-kpi-trend" style="background: #fff7ed; color: #ea580c;">Hiển thị</span>
                    </div>
                    <span class="cl-kpi-subtext">Được nạp vào bảng giá tổng hợp</span>
                </div>
            </div>

            <!-- Card 3: Hiện trên Trang dịch vụ con -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #ecfdf5; color: #059669;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Trang Dịch vụ con</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['service_page'] }}</span>
                        <span class="cl-kpi-trend">Đồng bộ</span>
                    </div>
                    <span class="cl-kpi-subtext">Hiển thị trong 7 trang dịch vụ</span>
                </div>
            </div>

            <!-- Card 4: Gói Khuyên Dùng (Featured) -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-icon-pill" style="background-color: #fef3c7; color: #b45309;">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <div class="cl-kpi-info">
                    <span class="cl-kpi-title">Gói Nổi Bật (Hot)</span>
                    <div class="cl-kpi-value-row">
                        <span class="cl-kpi-value">{{ $metrics['featured'] }}</span>
                        <span class="cl-kpi-trend" style="background: #fef3c7; color: #b45309;">Khuyên dùng</span>
                    </div>
                    <span class="cl-kpi-subtext">Highlight trung tâm card</span>
                </div>
            </div>
        </div>

        <!-- Two Column Layout: Sidebar (Left) + Main Content (Right) -->
        <div class="cl-body-grid">
            
            <!-- SIDEBAR: Facet Filters -->
            <aside class="cl-sidebar">
                <div class="cl-sidebar-header">
                    <div class="cl-sidebar-title">
                        <svg class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span>BỘ LỌC TÌM KIẾM</span>
                    </div>
                    <button type="button" wire:click="resetFilters" class="cl-sidebar-reset">
                        Đặt lại
                    </button>
                </div>

                <!-- Facet 1: Trang hiển thị -->
                <div>
                    <div class="cl-filter-block-title">Trang Hiển Thị</div>
                    <div class="cl-facet-list">
                        @foreach($facets['display_pages'] as $pageFacet)
                            <label class="cl-facet-item">
                                <div class="cl-facet-left">
                                    <input
                                        type="checkbox"
                                        value="{{ $pageFacet['id'] }}"
                                        wire:model.live="sidebarDisplayPages"
                                        class="cl-checkbox"
                                    />
                                    <span class="cl-facet-label">{{ $pageFacet['label'] }}</span>
                                </div>
                                <span class="cl-facet-count">{{ $pageFacet['count'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Facet 2: Nhóm dịch vụ -->
                <div>
                    <div class="cl-filter-block-title">Nhóm Dịch Vụ</div>
                    <div class="cl-facet-list">
                        @foreach($facets['service_groups'] as $groupFacet)
                            <label class="cl-facet-item">
                                <div class="cl-facet-left">
                                    <input
                                        type="checkbox"
                                        value="{{ $groupFacet['id'] }}"
                                        wire:model.live="sidebarServiceGroups"
                                        class="cl-checkbox"
                                    />
                                    <span class="cl-facet-label">{{ $groupFacet['label'] }}</span>
                                </div>
                                <span class="cl-facet-count">{{ $groupFacet['count'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Facet 3: Trạng thái gói -->
                <div>
                    <div class="cl-filter-block-title">Trạng Thái Gói</div>
                    <div class="cl-facet-list">
                        @foreach($facets['statuses'] as $statusFacet)
                            <div
                                wire:click="setSidebarStatus('{{ $statusFacet['id'] }}')"
                                class="cl-status-facet-item {{ $sidebarStatus === $statusFacet['id'] ? 'active' : '' }}"
                            >
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $statusFacet['color'] }};"></span>
                                    <span>{{ $statusFacet['label'] }}</span>
                                </div>
                                <span class="cl-facet-count">{{ $statusFacet['count'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Zalo Consultation Hotlink -->
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800">
                    <a href="https://zalo.me/0939363262" target="_blank" class="w-full py-2.5 px-3 rounded-lg bg-orange-50 hover:bg-orange-100 text-orange-600 font-bold text-xs flex items-center justify-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span>Hỗ trợ kỹ thuật Zalo</span>
                    </a>
                </div>
            </aside>

            <!-- MAIN CONTENT: Toolbar + Table/Grid -->
            <main>
                <!-- Filter Toolbar -->
                <div class="cl-pp-toolbar">
                    <!-- Search Input -->
                    <div class="cl-search-box">
                        <svg class="cl-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            class="cl-search-input"
                            placeholder="Tìm kiếm theo tên gói, mô tả, mức giá..."
                        />
                    </div>

                    <!-- Toolbar Dropdowns -->
                    <div class="cl-filter-controls">
                        <!-- Nhóm dịch vụ Dropdown -->
                        <select wire:model.live="selectedCategory" class="cl-pp-select">
                            <option value="">Tất cả nhóm</option>
                            <option value="tvc">Sản Xuất Video & TVC</option>
                            <option value="web">Thiết Kế Web & App</option>
                            <option value="marketing">Quảng Cáo & Marketing</option>
                            <option value="ui-ux">Thiết Kế UI/UX</option>
                            <option value="website-care">Quản Trị Web</option>
                            <option value="event-photography">Chụp Ảnh Sự Kiện</option>
                            <option value="event-videography">Quay Phim Sự Kiện</option>
                            <option value="teambuilding-photography">Chụp Ảnh Teambuilding</option>
                            <option value="teambuilding-videography">Quay Phim Teambuilding</option>
                        </select>

                        <!-- Trạng thái Dropdown -->
                        <select wire:model.live="selectedStatus" class="cl-pp-select">
                            <option value="">Trạng thái</option>
                            <option value="active">Đang hoạt động</option>
                            <option value="featured">Gói nổi bật</option>
                            <option value="inactive">Tạm dừng</option>
                        </select>

                        <!-- Mức giá Dropdown -->
                        <select wire:model.live="selectedPriceRange" class="cl-pp-select">
                            <option value="">Mức giá</option>
                            <option value="under_5m">Dưới 5 triệu</option>
                            <option value="5m_15m">5 – 15 triệu</option>
                            <option value="15m_30m">15 – 30 triệu</option>
                            <option value="above_30m">Trên 30 triệu</option>
                        </select>

                        <!-- View Switcher -->
                        <div class="cl-view-switcher">
                            <button
                                type="button"
                                wire:click="setViewMode('list')"
                                class="cl-view-btn {{ $viewMode === 'list' ? 'active' : '' }}"
                                title="Chế độ danh sách (Bảng)"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                            <button
                                type="button"
                                wire:click="setViewMode('grid')"
                                class="cl-view-btn {{ $viewMode === 'grid' ? 'active' : '' }}"
                                title="Chế độ lưới (Thẻ)"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @if($viewMode === 'list')
                    <!-- Data Table -->
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
                                        <th style="width: 48px; text-align: center;">Ảnh</th>
                                        <th wire:click="sortBy('tier_name')" style="cursor: pointer; min-width: 170px;">
                                            <div class="flex items-center gap-1.5">
                                                <span>Tên gói dịch vụ</span>
                                                <span class="text-xs text-slate-400">↕</span>
                                            </div>
                                        </th>
                                        <th style="width: 125px; white-space: nowrap;">Nhóm dịch vụ</th>
                                        <th style="min-width: 140px; white-space: nowrap;">Vị trí hiển thị</th>
                                        <th style="width: 110px; white-space: nowrap;">Giá bán</th>
                                        <th style="width: 85px; text-align: center; white-space: nowrap;">Nổi bật</th>
                                        <th style="width: 90px; text-align: center; white-space: nowrap;">Trạng thái</th>
                                        <th style="width: 65px; text-align: center; white-space: nowrap;">Thứ tự</th>
                                        <th style="width: 100px; text-align: right; white-space: nowrap;">Thao tác</th>
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

                                            <!-- Display Locations (Quick Toggles) -->
                                            <td>
                                                <div class="cl-loc-pills">
                                                    <span
                                                        wire:click="toggleLocation({{ $item['id'] }}, 'pricing')"
                                                        class="cl-loc-pill {{ $item['show_on_pricing_page'] ? 'pricing-on' : 'pricing-off' }}"
                                                        title="Click để bật/tắt hiển thị trên Trang Bảng giá tổng hợp (/dich-vu/bang-gia)"
                                                    >
                                                        <span>{{ $item['show_on_pricing_page'] ? '✓' : '✗' }}</span>
                                                        <span>Bảng giá</span>
                                                    </span>

                                                    <span
                                                        wire:click="toggleLocation({{ $item['id'] }}, 'service')"
                                                        class="cl-loc-pill {{ $item['show_on_service_page'] ? 'service-on' : 'service-off' }}"
                                                        title="Click để bật/tắt hiển thị trên Trang Dịch vụ con chi tiết"
                                                    >
                                                        <span>{{ $item['show_on_service_page'] ? '✓' : '✗' }}</span>
                                                        <span>Trang DV</span>
                                                    </span>
                                                </div>
                                            </td>

                                            <!-- Price Display -->
                                            <td>
                                                <span class="font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm">
                                                    {{ $item['price_display'] }}
                                                </span>
                                            </td>

                                            <!-- Featured Toggle -->
                                            <td style="text-align: center;">
                                                <span
                                                    wire:click="toggleFeaturedStatus({{ $item['id'] }})"
                                                    class="cl-featured-badge {{ $item['is_featured'] ? 'on' : 'off' }}"
                                                    title="Click để đổi trạng thái Gói Nổi Bật (Khuyên dùng)"
                                                >
                                                    <span>{{ $item['is_featured'] ? '★ Hot' : '☆ Thường' }}</span>
                                                </span>
                                            </td>

                                            <!-- Status Toggle -->
                                            <td style="text-align: center;">
                                                <span
                                                    wire:click="toggleActiveStatus({{ $item['id'] }})"
                                                    class="cl-status-toggle {{ $item['is_active'] ? 'active' : 'inactive' }}"
                                                    title="Click để kích hoạt/tạm dừng gói này"
                                                >
                                                    <span class="w-1.5 h-1.5 rounded-full {{ $item['is_active'] ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                                    <span>{{ $item['is_active'] ? 'Hiện' : 'Ẩn' }}</span>
                                                </span>
                                            </td>

                                            <!-- Order Input -->
                                            <td style="text-align: center;">
                                                <input
                                                    type="number"
                                                    value="{{ $item['order'] }}"
                                                    wire:change="updatePlanOrder({{ $item['id'] }}, $event.target.value)"
                                                    class="cl-order-input"
                                                    title="Nhập thứ tự hiển thị"
                                                />
                                            </td>

                                            <!-- Action Buttons -->
                                            <td style="text-align: right;">
                                                <div class="cl-table-actions">
                                                    <!-- View Web -->
                                                    <a href="{{ $item['target_url'] }}" target="_blank" class="cl-action-icon-btn view" title="Xem trên website khách hàng">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                        </svg>
                                                    </a>

                                                    <!-- Edit -->
                                                    <a href="{{ $item['edit_url'] }}" class="cl-action-icon-btn edit" title="Chỉnh sửa chi tiết">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </a>

                                                    <!-- Duplicate -->
                                                    <button type="button" wire:click="duplicatePlan({{ $item['id'] }})" class="cl-action-icon-btn copy" title="Nhân bản gói này">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                        </svg>
                                                    </button>

                                                    <!-- Delete -->
                                                    <button type="button" wire:click="confirmDelete({{ $item['id'] }})" class="cl-action-icon-btn delete" title="Xóa gói">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="py-12 text-center text-slate-500">
                                                <div class="flex flex-col items-center justify-center gap-2">
                                                    <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    <span class="font-semibold text-slate-700">Không tìm thấy gói bảng giá phù hợp</span>
                                                    <span class="text-xs text-slate-400">Thử thay đổi từ khóa hoặc bộ lọc bên trái</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <!-- Grid View (Cards) -->
                    <div class="cl-grid-container">
                        @forelse($plans as $item)
                            <div class="cl-grid-card {{ $item['is_featured'] ? 'is-featured-card' : '' }}">
                                <!-- Featured Banner Ribbon -->
                                @if($item['is_featured'])
                                    <div class="bg-gradient-to-r from-[#ff5400] to-[#ea580c] text-white text-[10px] font-black uppercase tracking-wider py-1 px-3 text-center shadow-xs">
                                        ★ GÓI KHUYÊN DÙNG (HOT) ★
                                    </div>
                                @endif

                                <!-- Top Image -->
                                <div class="cl-grid-card-img-wrap">
                                    <img
                                        src="{{ $item['thumb_url'] }}"
                                        alt="{{ $item['tier_name'] }}"
                                        class="cl-grid-card-img"
                                        onerror="this.src='/images/services/service_card_2_webapp.png'"
                                    />
                                    <div class="absolute top-2.5 left-2.5">
                                        <span class="cl-tag-pill shadow-xs" style="background-color: {{ $item['category_bg'] }}; color: {{ $item['category_text'] }};">
                                            {{ $item['category'] }}
                                        </span>
                                    </div>
                                    <div class="absolute top-2.5 right-2.5">
                                        <span
                                            wire:click="toggleActiveStatus({{ $item['id'] }})"
                                            class="cl-status-toggle {{ $item['is_active'] ? 'active' : 'inactive' }} shadow-xs"
                                        >
                                            <span class="w-1.5 h-1.5 rounded-full {{ $item['is_active'] ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                            <span>{{ $item['is_active'] ? 'Hiện' : 'Ẩn' }}</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="cl-grid-body">
                                    <div class="space-y-2">
                                        <div>
                                            <a href="{{ $item['edit_url'] }}" class="cl-service-title text-base font-extrabold hover:text-[#ff5400]">
                                                {{ $item['tier_name'] }}
                                            </a>
                                            <span class="cl-service-sub text-xs">
                                                {{ $item['subtitle'] }}
                                            </span>
                                        </div>

                                        <!-- Price -->
                                        <div class="pt-1">
                                            <span class="text-xl font-black text-[#ff5400]">
                                                {{ $item['price_display'] }}
                                            </span>
                                        </div>

                                        <!-- Features list preview -->
                                        @if(!empty($item['features']))
                                            <ul class="space-y-1 pt-2 border-t border-slate-100 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-400">
                                                @foreach(array_slice($item['features'], 0, 3) as $feat)
                                                    <li class="flex items-center gap-1.5 line-clamp-1">
                                                        <span class="text-emerald-500 font-bold">✓</span>
                                                        <span>{{ $feat }}</span>
                                                    </li>
                                                @endforeach
                                                @if(count($item['features']) > 3)
                                                    <li class="text-[11px] text-slate-400 italic">
                                                        +{{ count($item['features']) - 3 }} quyền lợi khác...
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>

                                    <!-- Bottom: Display Locations & Actions -->
                                    <div class="pt-3 border-t border-slate-100 dark:border-slate-800 space-y-2.5">
                                        <!-- Quick Toggles -->
                                        <div class="flex items-center justify-between">
                                            <span class="text-[11px] font-semibold text-slate-500">Hiển thị:</span>
                                            <div class="cl-loc-pills">
                                                <span
                                                    wire:click="toggleLocation({{ $item['id'] }}, 'pricing')"
                                                    class="cl-loc-pill {{ $item['show_on_pricing_page'] ? 'pricing-on' : 'pricing-off' }}"
                                                    title="Bật/Tắt hiển thị Bảng giá"
                                                >
                                                    {{ $item['show_on_pricing_page'] ? '✓' : '✗' }} Bảng giá
                                                </span>
                                                <span
                                                    wire:click="toggleLocation({{ $item['id'] }}, 'service')"
                                                    class="cl-loc-pill {{ $item['show_on_service_page'] ? 'service-on' : 'service-off' }}"
                                                    title="Bật/Tắt hiển thị Trang DV"
                                                >
                                                    {{ $item['show_on_service_page'] ? '✓' : '✗' }} Trang DV
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Actions bar -->
                                        <div class="flex items-center justify-between pt-1">
                                            <div class="flex items-center gap-1">
                                                <span class="text-[11px] text-slate-400">#{{ $item['order'] }}</span>
                                                <span
                                                    wire:click="toggleFeaturedStatus({{ $item['id'] }})"
                                                    class="cl-featured-badge {{ $item['is_featured'] ? 'on' : 'off' }}"
                                                >
                                                    {{ $item['is_featured'] ? '★' : '☆' }}
                                                </span>
                                            </div>

                                            <div class="cl-table-actions">
                                                <a href="{{ $item['target_url'] }}" target="_blank" class="cl-action-icon-btn view" title="Xem trên web">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                    </svg>
                                                </a>
                                                <a href="{{ $item['edit_url'] }}" class="cl-action-icon-btn edit" title="Sửa">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </a>
                                                <button type="button" wire:click="duplicatePlan({{ $item['id'] }})" class="cl-action-icon-btn copy" title="Nhân bản">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                    </svg>
                                                </button>
                                                <button type="button" wire:click="confirmDelete({{ $item['id'] }})" class="cl-action-icon-btn delete" title="Xóa">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center text-slate-500">
                                <span class="font-semibold text-slate-700">Không tìm thấy gói bảng giá phù hợp</span>
                            </div>
                        @endforelse
                    </div>
                @endif

                <!-- Pagination Bar -->
                <div class="cl-footer-bar">
                    <span class="cl-footer-text">
                        Hiển thị {{ $display['from'] }} - {{ $display['to'] }} trên tổng số <strong>{{ $display['total'] }}</strong> gói bảng giá
                    </span>

                    <div class="cl-pagination">
                        <button
                            type="button"
                            wire:click="previousPage"
                            {{ $display['currentPage'] <= 1 ? 'disabled' : '' }}
                            class="cl-page-btn"
                            title="Trang trước"
                        >
                            ‹
                        </button>

                        @for($p = 1; $p <= $display['lastPage']; $p++)
                            @if($p == 1 || $p == $display['lastPage'] || abs($p - $display['currentPage']) <= 1)
                                <button
                                    type="button"
                                    wire:click="setPage({{ $p }})"
                                    class="cl-page-btn {{ $display['currentPage'] === $p ? 'active' : '' }}"
                                >
                                    {{ $p }}
                                </button>
                            @elseif(abs($p - $display['currentPage']) == 2)
                                <span class="px-1 text-slate-400">...</span>
                            @endif
                        @endfor

                        <button
                            type="button"
                            wire:click="nextPage"
                            {{ $display['currentPage'] >= $display['lastPage'] ? 'disabled' : '' }}
                            class="cl-page-btn"
                            title="Trang kế tiếp"
                        >
                            ›
                        </button>
                    </div>
                </div>
            </main>
        </div>

        <!-- Delete Confirmation Modal -->
        @if($showDeleteModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
                <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Xóa gói bảng giá?</h3>
                            <p class="text-xs text-slate-500">Thao tác này sẽ gỡ gói dịch vụ khỏi hệ thống.</p>
                        </div>
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-300">
                        Bạn có chắc chắn muốn xóa gói <strong>"{{ $planToDeleteTitle }}"</strong>? Thao tác này không thể hoàn tác.
                    </p>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" wire:click="cancelDelete" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold">
                            Hủy bỏ
                        </button>
                        <button type="button" wire:click="executeDelete" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-xs font-bold shadow-xs">
                            Xác nhận xóa
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
