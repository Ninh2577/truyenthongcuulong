<x-filament-panels::page>
    @php
        $metrics = $this->getMetrics();
        $facets = $this->getSidebarFacets();
        $display = $this->getDisplayData();
        $clients = $display['clients'];
        $createUrl = $display['createUrl'];
        $availableIndustries = \App\Models\Client::all()->pluck('industry_label')->unique()->filter()->values();
    @endphp

    <style>
        .cl-wrapper {
            font-family: inherit;
            color: #1e293b;
        }
        .dark .cl-wrapper {
            color: #f1f5f9;
        }

        /* Top Breadcrumb */
        .cl-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.75rem;
        }
        .dark .cl-breadcrumb {
            color: #94a3b8;
        }
        .cl-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s;
        }
        .cl-breadcrumb a:hover {
            color: #ff5400;
        }

        /* Header Bar */
        .cl-header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        @media (min-width: 1024px) {
            .cl-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }
        .cl-header-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.02em;
        }
        .dark .cl-header-title h1 {
            color: #f8fafc;
        }
        .cl-header-title p {
            font-size: 0.84rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }
        .dark .cl-header-title p {
            color: #94a3b8;
        }

        .cl-header-actions {
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
            white-space: nowrap;
        }
        .dark .cl-btn-export {
            background: #1c2738;
            border-color: #7c2d12;
            color: #fb923c;
        }
        .cl-btn-export:hover {
            background: #fff7ed;
            border-color: #f97316;
        }

        .cl-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #ffffff;
            background: #ff5400;
            border: 1px solid #ff5400;
            border-radius: 0.625rem;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.25);
            text-decoration: none;
            white-space: nowrap;
        }
        .cl-btn-primary:hover {
            background: #e04a00;
            border-color: #e04a00;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.35);
        }

        /* 4 Top KPI Cards */
        .cl-kpi-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 0.875rem;
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
            border-radius: 1rem;
            padding: 1.125rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
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
            z-index: 2;
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
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }
        .cl-kpi-meta {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }
        .cl-kpi-label {
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
        }
        .dark .cl-kpi-label {
            color: #94a3b8;
        }
        .cl-kpi-value-row {
            display: flex;
            align-items: baseline;
            gap: 0.4rem;
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
        .cl-kpi-trend {
            font-size: 0.72rem;
            font-weight: 700;
            color: #10b981;
        }
        .cl-kpi-sub {
            font-size: 0.72rem;
            color: #94a3b8;
        }

        .cl-kpi-ghost {
            width: 3rem;
            height: 3rem;
            opacity: 0.22;
            flex-shrink: 0;
            z-index: 1;
        }

        /* Toolbar */
        .cl-toolbar {
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
        .dark .cl-toolbar {
            background: #182234;
            border-color: #26354a;
        }
        .cl-search-box {
            position: relative;
            flex: 1 1 280px;
            min-width: 220px;
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

        .cl-toolbar-right {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .cl-select {
            padding: 0.48rem 1.85rem 0.48rem 0.75rem;
            font-size: 0.8125rem;
            color: #334155;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.1em 1.1em;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            appearance: none;
            outline: none;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-select {
            background-color: #131c2b;
            border-color: #2a3b54;
            color: #cbd5e1;
        }

        .cl-view-btn-wrap {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 0.5rem;
            padding: 0.2rem;
            gap: 0.15rem;
        }
        .dark .cl-view-btn-wrap {
            background: #131c2b;
        }
        .cl-v-btn {
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
        .cl-v-btn.active {
            background: #ff5400;
            color: #ffffff;
            box-shadow: 0 1px 4px rgba(255, 84, 0, 0.35);
        }

        /* Two Column Layout */
        .cl-body-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            align-items: start;
        }
        @media (min-width: 1024px) {
            .cl-body-grid {
                grid-template-columns: 260px 1fr;
            }
        }
        @media (min-width: 1280px) {
            .cl-body-grid {
                grid-template-columns: 275px 1fr;
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
            gap: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }
        .dark .cl-sidebar {
            background: #182234;
            border-color: #26354a;
        }
        .cl-filter-block-title {
            font-size: 0.8125rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.75rem;
            letter-spacing: -0.01em;
        }
        .dark .cl-filter-block-title {
            color: #f1f5f9;
        }
        .cl-facet-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .cl-facet-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8125rem;
            color: #475569;
            cursor: pointer;
            user-select: none;
            padding: 0.2rem 0;
            transition: color 0.15s;
        }
        .dark .cl-facet-item {
            color: #cbd5e1;
        }
        .cl-facet-item:hover {
            color: #ff5400;
        }
        .cl-facet-left {
            display: flex;
            align-items: center;
            gap: 0.625rem;
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
            font-size: 0.72rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .cl-status-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.4rem 0.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.15s;
            font-size: 0.8125rem;
            color: #334155;
        }
        .dark .cl-status-item {
            color: #cbd5e1;
        }
        .cl-status-item:hover, .cl-status-item.active {
            background: #f8fafc;
        }
        .dark .cl-status-item:hover, .dark .cl-status-item.active {
            background: #1f2c3f;
        }
        .cl-status-dot {
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 9999px;
            display: inline-block;
        }

        /* 4-Column Card Grid */
        .cl-cards-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        @media (min-width: 640px) {
            .cl-cards-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1200px) {
            .cl-cards-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .cl-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.875rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }
        .dark .cl-card {
            background: #182234;
            border-color: #26354a;
        }
        .cl-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.08);
        }

        /* Card Top Banner with Floating Status Pill */
        .cl-card-banner {
            position: relative;
            width: 100%;
            height: 5.75rem;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.25rem;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }
        .dark .cl-card-banner {
            background: #0f172a;
            border-bottom-color: #1e293b;
        }
        .cl-card-banner-img {
            max-width: 75%;
            max-height: 75%;
            width: auto;
            height: auto;
            object-fit: contain !important;
            filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.06));
            transition: transform 0.25s ease;
        }
        .cl-card:hover .cl-card-banner-img {
            transform: scale(1.05);
        }
        .cl-fallback-contain {
            object-fit: contain !important;
            padding: 0.75rem !important;
            background: #f8fafc !important;
        }
        .dark .cl-fallback-contain {
            background: #0f172a !important;
        }
        .cl-card-status-badge {
            position: absolute;
            top: 0.625rem;
            right: 0.625rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            padding: 0.2rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
        }
        .dark .cl-card-status-badge {
            background: rgba(15, 23, 42, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Brand Avatar Box overlapping banner */
        .cl-card-avatar-wrap {
            position: relative;
            padding: 0 1rem;
            margin-top: -1.375rem;
            z-index: 5;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }
        .cl-brand-avatar-box {
            position: relative;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 0.875rem;
            background: #ffffff;
            border: 2.5px solid #ffffff;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
            padding: 0.35rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.2s;
        }
        .dark .cl-brand-avatar-box {
            background: #0f172a;
            border-color: #1e293b;
        }
        .cl-card:hover .cl-brand-avatar-box {
            transform: scale(1.04);
        }
        .cl-brand-avatar-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 1px 2px rgba(0,0,0,0.06));
        }
        .cl-rep-badge-corner {
            position: absolute;
            bottom: -0.3rem;
            right: -0.3rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 9999px;
            font-size: 0.5625rem;
            font-weight: 800;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.25);
            letter-spacing: -0.02em;
        }
        .dark .cl-rep-badge-corner {
            border-color: #0f172a;
        }
        .cl-initials-avatar {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 9999px;
            border: 2.5px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 800;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            flex-shrink: 0;
            letter-spacing: -0.02em;
        }
        .dark .cl-initials-avatar {
            border-color: #182234;
        }

        /* Client Card Body */
        .cl-card-body {
            padding: 0.625rem 1rem 0.875rem 1rem;
            display: flex;
            flex-direction: column;
            flex: 1;
            gap: 0.625rem;
        }

        .cl-name-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.35rem;
        }
        .cl-rep-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.25;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dark .cl-rep-title {
            color: #f8fafc;
        }
        .cl-chat-pill {
            display: inline-flex;
            align-items: center;
            font-size: 0.65rem;
            font-weight: 600;
            color: #2563eb;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            padding: 0.12rem 0.45rem;
            border-radius: 9999px;
            white-space: nowrap;
        }
        .dark .cl-chat-pill {
            background: rgba(37, 99, 235, 0.15);
            color: #60a5fa;
            border-color: rgba(37, 99, 235, 0.3);
        }

        .cl-company-name {
            font-size: 0.75rem;
            color: #64748b;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dark .cl-company-name {
            color: #94a3b8;
        }

        /* Contact Details */
        .cl-contact-list {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            font-size: 0.72rem;
            color: #475569;
        }
        .dark .cl-contact-list {
            color: #cbd5e1;
        }
        .cl-contact-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Interest Service Tags */
        .cl-tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
        }
        .cl-service-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.18rem 0.45rem;
            border-radius: 0.375rem;
            font-size: 0.6875rem;
            font-weight: 500;
            white-space: nowrap;
        }

        /* Display Locations Row (Marquee integration) */
        .cl-loc-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.4rem;
            border-top: 1px solid #f1f5f9;
            font-size: 0.6875rem;
        }
        .dark .cl-loc-strip {
            border-top-color: #1e293b;
        }
        .cl-loc-pills {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .cl-loc-toggle {
            padding: 0.15rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.65rem;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.15s;
        }

        /* Card Footer */
        .cl-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.5rem;
            border-top: 1px solid #f1f5f9;
            margin-top: auto;
        }
        .dark .cl-card-footer {
            border-top-color: #1e293b;
        }
        .cl-interaction-meta {
            display: flex;
            flex-direction: column;
        }
        .cl-meta-lbl {
            font-size: 0.65rem;
            color: #94a3b8;
        }
        .cl-meta-val {
            font-size: 0.72rem;
            font-weight: 600;
            color: #334155;
        }
        .dark .cl-meta-val {
            color: #cbd5e1;
        }

        .cl-btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.625rem;
            font-size: 0.72rem;
            font-weight: 600;
            color: #334155;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.15s;
        }
        .dark .cl-btn-detail {
            background: #1e293b;
            border-color: #334155;
            color: #cbd5e1;
        }
        .cl-btn-detail:hover {
            color: #ff5400;
            border-color: #ff5400;
            background: #fff7ed;
        }
        .dark .cl-btn-detail:hover {
            background: #281c16;
            color: #ff7833;
        }

        /* Pagination Bar */
        .cl-pagination-bar {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
            justify-content: space-between;
            padding: 0.875rem 0.25rem;
        }
        @media (min-width: 640px) {
            .cl-pagination-bar {
                flex-direction: row;
            }
        }
        .cl-page-indicator {
            font-size: 0.8125rem;
            color: #64748b;
        }
        .dark .cl-page-indicator {
            color: #94a3b8;
        }
        .cl-page-group {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        .cl-p-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2rem;
            height: 2rem;
            padding: 0 0.4rem;
            font-size: 0.8125rem;
            font-weight: 500;
            border-radius: 0.45rem;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #334155;
            cursor: pointer;
            transition: all 0.15s;
        }
        .dark .cl-p-btn {
            background: #182234;
            border-color: #26354a;
            color: #cbd5e1;
        }
        .cl-p-btn:hover:not(:disabled) {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        .cl-p-btn.active {
            background: #ff5400;
            border-color: #ff5400;
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 1px 4px rgba(255, 84, 0, 0.3);
        }
        .cl-p-btn:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }
    </style>

    <div class="cl-wrapper">
        <!-- Breadcrumb: Trang chủ › Khách hàng › Khách hàng tiêu biểu -->
        <div class="cl-breadcrumb">
            <a href="/cuulongteam" class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Trang chủ</span>
            </a>
            <span>›</span>
            <span>Khách hàng</span>
            <span>›</span>
            <span class="font-semibold text-slate-800 dark:text-slate-200">Khách hàng tiêu biểu</span>
        </div>

        <!-- Header Title Bar -->
        <div class="cl-header">
            <div class="cl-header-title">
                <h1>Khách hàng tiêu biểu</h1>
                <p>Danh sách khách hàng đã có tương tác và quan tâm đến dịch vụ của Truyền Thông Cửu Long.</p>
            </div>

            <div class="cl-header-actions">
                <!-- Date range button -->
                <button type="button" class="cl-btn-secondary">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $dateRange }}</span>
                </button>

                <!-- Display Page Filter Dropdown in Header -->
                <select wire:model.live="selectedDisplayPage" class="cl-select">
                    <option value="">Tất cả trang hiển thị</option>
                    @foreach($facets['display_pages'] as $dp)
                        <option value="{{ $dp['id'] }}">{{ $dp['label'] }} ({{ $dp['count'] }})</option>
                    @endforeach
                </select>

                <!-- Export CSV button -->
                <button type="button" wire:click="exportData" class="cl-btn-export" title="Xuất dữ liệu danh sách khách hàng ra CSV">
                    <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <span>Xuất danh sách</span>
                </button>

                <!-- Speed configuration trigger button -->
                <button
                    type="button"
                    wire:click="openSpeedModal"
                    class="cl-btn-secondary hover:border-orange-500 hover:text-orange-600 transition"
                    title="Cấu hình tốc độ cuộn logo khách hàng trên website"
                >
                    <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Tốc độ cuộn logo</span>
                </button>

                <!-- Primary Add button -->
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
            <!-- Card 1: Tổng khách hàng -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background-color: #2563eb;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-meta">
                        <span class="cl-kpi-label">Tổng khách hàng</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-val">{{ $metrics['total'] }}</span>
                            <span class="cl-kpi-trend">{{ $metrics['total_trend'] }}</span>
                        </div>
                        <span class="cl-kpi-sub">{{ $metrics['total_sub'] ?? 'Đang hợp tác trong hệ thống' }}</span>
                    </div>
                </div>
                <div class="cl-kpi-ghost text-blue-500">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 16v-1a4 4 0 00-3-3.87A5.97 5.97 0 0114 15v1h2zM4 16v-1c0-.73.2-1.41.54-2A4 4 0 001 15v1h3z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 2: Khách hàng mới -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background-color: #10b981;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-meta">
                        <span class="cl-kpi-label">Khách hàng mới</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-val">{{ $metrics['new'] }}</span>
                            <span class="cl-kpi-trend">{{ $metrics['new_trend'] }}</span>
                        </div>
                        <span class="cl-kpi-sub">{{ $metrics['new_sub'] ?? 'Có ít nhất 1 lần gửi form' }}</span>
                    </div>
                </div>
                <div class="cl-kpi-ghost text-emerald-500">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>

            <!-- Card 3: Tỷ lệ hài lòng -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background-color: #8b5cf6;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zm-4 0h-2v2h2V9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-meta">
                        <span class="cl-kpi-label">Tỷ lệ hài lòng</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-val">{{ $metrics['satisfaction'] }}</span>
                            <span class="cl-kpi-trend">{{ $metrics['satisfaction_trend'] }}</span>
                        </div>
                        <span class="cl-kpi-sub">{{ $metrics['satisfaction_sub'] ?? 'Dựa trên đánh giá & hợp tác' }}</span>
                    </div>
                </div>
                <div class="cl-kpi-ghost text-violet-400">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <!-- Card 4: Lĩnh vực tiêu biểu -->
            <div class="cl-kpi-card">
                <div class="cl-kpi-left">
                    <div class="cl-kpi-icon" style="background-color: #f97316;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <div class="cl-kpi-meta">
                        <span class="cl-kpi-label">Lĩnh vực tiêu biểu</span>
                        <div class="cl-kpi-value-row">
                            <span class="cl-kpi-val">{{ $metrics['industries'] }}</span>
                            <span class="cl-kpi-trend">{{ $metrics['industries_trend'] }}</span>
                        </div>
                        <span class="cl-kpi-sub">{{ $metrics['industries_sub'] ?? 'Ngành nghề khác nhau' }}</span>
                    </div>
                </div>
                <div class="cl-kpi-ghost text-orange-400">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Filter Toolbar -->
        <div class="cl-toolbar">
            <!-- Search Input -->
            <div class="cl-search-box">
                <svg class="cl-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="cl-search-input"
                    placeholder="Tìm kiếm khách hàng theo tên, SĐT, email, công ty..."
                />
            </div>

            <!-- Toolbar Controls -->
            <div class="cl-toolbar-right">
                <!-- Select Display Page -->
                <select wire:model.live="selectedDisplayPage" class="cl-select">
                    <option value="">Trang hiển thị (Tất cả)</option>
                    @foreach($facets['display_pages'] as $dp)
                        <option value="{{ $dp['id'] }}">{{ $dp['label'] }} ({{ $dp['count'] }})</option>
                    @endforeach
                </select>

                <!-- Select Industry -->
                <select wire:model.live="selectedIndustry" class="cl-select">
                    <option value="">Tất cả lĩnh vực</option>
                    @foreach($availableIndustries as $ind)
                        <option value="{{ $ind }}">{{ $ind }}</option>
                    @endforeach
                </select>

                <!-- Select Status -->
                <select wire:model.live="selectedStatus" class="cl-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active">Đang hoạt động</option>
                    <option value="inactive">Ngừng tương tác</option>
                </select>

                <!-- Reset Button -->
                <button type="button" wire:click="resetFilters" class="cl-btn-secondary" title="Đặt lại bộ lọc">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Đặt lại</span>
                </button>

                <!-- View Switcher -->
                <div class="cl-view-btn-wrap">
                    <button
                        type="button"
                        wire:click="setViewMode('grid')"
                        class="cl-v-btn {{ $viewMode === 'grid' ? 'active' : '' }}"
                        title="Chế độ lưới"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button
                        type="button"
                        wire:click="setViewMode('list')"
                        class="cl-v-btn {{ $viewMode === 'list' ? 'active' : '' }}"
                        title="Chế độ danh sách"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- 2-Column Main Layout: Left Sidebar + Right Card Grid -->
        <div class="cl-body-grid">
            <!-- Left Sidebar -->
            <aside class="cl-sidebar">
                <!-- Section 1: Lọc theo trang hiển thị -->
                <div>
                    <h3 class="cl-filter-block-title">Lọc theo trang hiển thị</h3>
                    <div class="cl-facet-list">
                        @foreach($facets['display_pages'] as $dp)
                            <label class="cl-facet-item">
                                <div class="cl-facet-left">
                                    <input
                                        type="checkbox"
                                        value="{{ $dp['id'] }}"
                                        wire:model.live="sidebarDisplayPages"
                                        class="cl-checkbox"
                                    />
                                    <span>{{ $dp['label'] }}</span>
                                </div>
                                <span class="cl-facet-count">{{ $dp['count'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Section 2: Lĩnh vực quan tâm -->
                <div>
                    <h3 class="cl-filter-block-title">Lĩnh vực quan tâm</h3>
                    <div class="cl-facet-list">
                        @foreach($facets['interests'] as $inte)
                            <label class="cl-facet-item">
                                <div class="cl-facet-left">
                                    <input
                                        type="checkbox"
                                        value="{{ $inte['id'] }}"
                                        wire:model.live="sidebarInterests"
                                        class="cl-checkbox"
                                    />
                                    <span>{{ $inte['label'] }}</span>
                                </div>
                                <span class="cl-facet-count">{{ $inte['count'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Section 3: Trạng thái khách hàng -->
                <div>
                    <h3 class="cl-filter-block-title">Trạng thái khách hàng</h3>
                    <div class="cl-facet-list">
                        @foreach($facets['statuses'] as $st)
                            <div
                                wire:click="setSidebarStatus('{{ $st['id'] }}')"
                                class="cl-status-item {{ $sidebarStatus === $st['id'] ? 'active' : '' }}"
                            >
                                <div class="flex items-center gap-2">
                                    <span class="cl-status-dot" style="background-color: {{ $st['color'] }};"></span>
                                    <span class="font-medium {{ $sidebarStatus === $st['id'] ? 'text-orange-600 font-bold' : '' }}">{{ $st['label'] }}</span>
                                </div>
                                <span class="cl-facet-count">{{ $st['count'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>

            <!-- Right Main Area: 4-Column Cards or List -->
            <div>
                @if($viewMode === 'grid')
                    <div class="cl-cards-grid">
                        @forelse($clients as $item)
                            <div class="cl-card">
                                <!-- Top Banner with Photo & Floating Status -->
                                <div class="cl-card-banner">
                                    <img
                                        src="{{ $item['banner_url'] }}"
                                        alt="{{ $item['company_name'] }}"
                                        class="cl-card-banner-img"
                                        onerror="this.onerror=null; this.src='{{ $item['logo_url'] }}'; this.classList.add('cl-fallback-contain');"
                                    />
                                    <!-- Floating Status Pill -->
                                    <div class="cl-card-status-badge">
                                        <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $item['dot_color'] }};"></span>
                                        <span class="text-slate-800 dark:text-slate-200">{{ $item['status_label'] }}</span>
                                    </div>
                                </div>

                                <!-- Representative Avatar overlapping banner -->
                                <div class="cl-card-avatar-wrap">
                                    <div class="cl-initials-avatar" style="background-color: {{ $item['avatar_color'] }};" title="Người đại diện: {{ $item['rep_name'] }} ({{ $item['rep_role'] ?? 'Đại diện' }})">
                                        {{ $item['initials'] }}
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-800/80 px-2 py-0.5 rounded-full border border-slate-200/80 dark:border-slate-700 shadow-xs">
                                        <svg class="w-3 h-3 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        #{{ $item['order'] }}
                                    </span>
                                </div>

                                <!-- Card Body -->
                                <div class="cl-card-body">
                                    <!-- Representative Name + Interaction Tag -->
                                    <div class="cl-name-row">
                                        <span class="cl-rep-title" title="{{ $item['rep_name'] }}">
                                            {{ $item['rep_name'] }}
                                        </span>
                                        <span class="cl-chat-pill">
                                            {{ $item['interaction_badge'] }}
                                        </span>
                                    </div>

                                    <!-- Company Name -->
                                    <span class="cl-company-name" title="{{ $item['company_name'] }}">
                                        {{ $item['company_name'] }}
                                    </span>

                                    <!-- Contact Info: Phone & Email -->
                                    <div class="cl-contact-list">
                                        <div class="cl-contact-item" title="Số điện thoại">
                                            <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span>{{ $item['phone'] }}</span>
                                        </div>
                                        <div class="cl-contact-item" title="Email liên hệ">
                                            <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="truncate">{{ $item['email'] }}</span>
                                        </div>
                                    </div>

                                    <!-- Service Interest Tags -->
                                    <div class="cl-tag-container">
                                        @foreach($item['tags'] as $tag)
                                            <span
                                                class="cl-service-pill"
                                                style="background-color: {{ $tag['bg'] }}; color: {{ $tag['text'] }};"
                                            >
                                                <span>{{ $tag['name'] }}</span>
                                            </span>
                                        @endforeach
                                    </div>

                                    <!-- Display Locations & Marquee Scope (Preserved Feature!) -->
                                    <div class="cl-loc-strip">
                                        <div class="cl-loc-pills">
                                            <button
                                                type="button"
                                                wire:click="toggleLocation({{ $item['id'] }}, 'home')"
                                                class="cl-loc-toggle {{ $item['show_on_home'] ? 'bg-orange-50 text-orange-700 border-orange-200 dark:bg-orange-950/40 dark:text-orange-300' : 'bg-slate-100 text-slate-400 dark:bg-slate-800' }}"
                                                title="Bật/tắt hiển thị logo Trang chủ"
                                            >
                                                {{ $item['show_on_home'] ? '●' : '○' }} Chủ
                                            </button>
                                            <button
                                                type="button"
                                                wire:click="toggleLocation({{ $item['id'] }}, 'media')"
                                                class="cl-loc-toggle {{ $item['show_on_media'] ? 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-950/40 dark:text-blue-300' : 'bg-slate-100 text-slate-400 dark:bg-slate-800' }}"
                                                title="Bật/tắt hiển thị logo Trang Media"
                                            >
                                                {{ $item['show_on_media'] ? '●' : '○' }} Media
                                            </button>
                                            <button
                                                type="button"
                                                wire:click="toggleLocation({{ $item['id'] }}, 'clients')"
                                                class="cl-loc-toggle {{ $item['show_on_clients'] ? 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-300' : 'bg-slate-100 text-slate-400 dark:bg-slate-800' }}"
                                                title="Bật/tắt hiển thị logo Trang Khách hàng"
                                            >
                                                {{ $item['show_on_clients'] ? '●' : '○' }} KH
                                            </button>
                                        </div>
                                        <span class="font-mono text-[10px] text-slate-400" title="Vị trí thứ tự">#{{ $item['order'] }}</span>
                                    </div>

                                    <!-- Card Footer: Last Interaction & Details button -->
                                    <div class="cl-card-footer">
                                        <div class="cl-interaction-meta">
                                            <span class="cl-meta-lbl">Lần cuối tương tác</span>
                                            <span class="cl-meta-val">{{ $item['last_interaction'] }}</span>
                                        </div>

                                        <div class="flex items-center gap-1.5">
                                            <a href="{{ $item['edit_url'] }}" class="cl-btn-detail">
                                                <span>Xem chi tiết</span>
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                            <button
                                                type="button"
                                                wire:click="confirmDelete({{ $item['id'] }})"
                                                class="w-6 h-6 rounded flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 transition"
                                                title="Xóa hồ sơ"
                                            >
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 text-slate-400 bg-white dark:bg-slate-800 rounded-xl border border-dashed border-slate-200 dark:border-slate-700">
                                Không tìm thấy khách hàng nào phù hợp với bộ lọc hiện tại.
                            </div>
                        @endforelse
                    </div>
                @else
                    <!-- List Table View (Toggleable mode) -->
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden shadow-sm mb-4">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-semibold uppercase text-[10px]">
                                    <tr>
                                        <th class="p-3 w-16 text-center">Avatar</th>
                                        <th class="p-3">Khách hàng / Công ty</th>
                                        <th class="p-3">Người đại diện</th>
                                        <th class="p-3">Liên hệ</th>
                                        <th class="p-3 text-center">Trạng thái</th>
                                        <th class="p-3 text-center">Hiển thị</th>
                                        <th class="p-3 text-right">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                    @forelse($clients as $item)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                            <td class="p-3 text-center">
                                                <div class="relative w-10 h-10 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-1 flex items-center justify-center mx-auto shadow-sm">
                                                    <img src="{{ $item['logo_url'] }}" alt="{{ $item['company_name'] }}" class="max-w-full max-h-full object-contain" onerror="this.onerror=null; this.src='{{ $item['banner_url'] }}';"/>
                                                    <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full text-[8px] font-bold text-white flex items-center justify-center border border-white dark:border-slate-800 shadow-sm" style="background-color: {{ $item['avatar_color'] }};" title="Đại diện: {{ $item['rep_name'] }}">
                                                        {{ $item['initials'] }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="p-3">
                                                <div class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $item['company_name'] }}</div>
                                                <div class="text-[11px] text-slate-400">Vị trí marquee: #{{ $item['order'] }}</div>
                                            </td>
                                            <td class="p-3">
                                                <div class="font-semibold text-slate-700 dark:text-slate-300">{{ $item['rep_name'] }}</div>
                                                <div class="text-[10px] text-blue-600 dark:text-blue-400">{{ $item['interaction_badge'] }}</div>
                                            </td>
                                            <td class="p-3">
                                                <div class="text-[11px] text-slate-600 dark:text-slate-400">{{ $item['phone'] }}</div>
                                                <div class="text-[10px] text-slate-400">{{ $item['email'] }}</div>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold" style="background-color: {{ $item['status_label'] === 'Hoạt động' ? '#ecfdf5' : '#fef3c7' }}; color: {{ $item['dot_color'] }};">
                                                    ● {{ $item['status_label'] }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="inline-flex items-center gap-1">
                                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold {{ $item['show_on_home'] ? 'bg-orange-100 text-orange-700' : 'bg-slate-100 text-slate-400' }}">Chủ</span>
                                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold {{ $item['show_on_media'] ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-400' }}">Media</span>
                                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold {{ $item['show_on_clients'] ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">KH</span>
                                                </div>
                                            </td>
                                            <td class="p-3 text-right">
                                                <div class="inline-flex items-center gap-1">
                                                    <a href="{{ $item['edit_url'] }}" class="p-1 rounded text-slate-600 hover:text-orange-600 transition" title="Sửa">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </a>
                                                    <button type="button" wire:click="confirmDelete({{ $item['id'] }})" class="p-1 rounded text-slate-400 hover:text-red-600 transition" title="Xóa">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="p-8 text-center text-slate-400">Không tìm thấy khách hàng nào.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Pagination Footer Bar matching user screenshot -->
                <div class="cl-pagination-bar">
                    <span class="cl-page-indicator">
                        Hiển thị {{ $display['from'] }}-{{ $display['to'] }} trong tổng số {{ number_format($display['total']) }} khách hàng
                    </span>

                    @if($display['lastPage'] > 1)
                        <div class="cl-page-group">
                            {{-- Jump to first page --}}
                            @if($display['currentPage'] > 3 && $display['lastPage'] > 7)
                                <button
                                    type="button"
                                    wire:click="setPage(1)"
                                    class="cl-p-btn"
                                    title="Về trang đầu (1)"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                                    </svg>
                                </button>
                            @endif

                            <!-- Prev button -->
                            <button
                                type="button"
                                wire:click="previousPage"
                                class="cl-p-btn"
                                {{ $display['currentPage'] <= 1 ? 'disabled' : '' }}
                                title="Trang trước"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>

                            <!-- Page Numbers with Ellipsis -->
                            @foreach($display['pages'] as $p)
                                @if($p === '...')
                                    <span style="min-width: 1.5rem; height: 2rem; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-weight: 700; font-size: 0.875rem;">...</span>
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

                            <!-- Next button -->
                            <button
                                type="button"
                                wire:click="nextPage"
                                class="cl-p-btn"
                                {{ $display['currentPage'] >= $display['lastPage'] ? 'disabled' : '' }}
                                title="Trang kế tiếp"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>

                            {{-- Jump to last page --}}
                            @if($display['currentPage'] < $display['lastPage'] - 2 && $display['lastPage'] > 7)
                                <button
                                    type="button"
                                    wire:click="setPage({{ $display['lastPage'] }})"
                                    class="cl-p-btn"
                                    title="Đến trang cuối ({{ $display['lastPage'] }})"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
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

    <!-- Speed Configuration Modal -->
    @if($showSpeedModal)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-orange-100 dark:bg-orange-950/50 text-orange-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Cấu hình Tốc độ cuộn Logo Khách hàng</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Tùy chỉnh thời gian chạy hết một chu kỳ logo cho từng trang</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeSpeedModal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-5 my-4">
                    <!-- Speed Home -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                1. Trang Chủ (/)
                            </label>
                            <span class="text-xs font-mono font-bold text-orange-600 bg-orange-50 dark:bg-orange-950 px-2 py-0.5 rounded border border-orange-200 dark:border-orange-800">
                                {{ $speedHome }} giây / vòng
                            </span>
                        </div>
                        <input
                            type="range"
                            min="20"
                            max="180"
                            step="5"
                            wire:model.live="speedHome"
                            class="w-full accent-orange-500 cursor-pointer"
                        />
                        <div class="flex justify-between text-[11px] text-slate-400 mt-1">
                            <span>Chạy nhanh (20s)</span>
                            <span>Tiêu chuẩn (80s)</span>
                            <span>Chạy chậm (180s)</span>
                        </div>
                    </div>

                    <!-- Speed Media -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                2. Trang Sản Xuất Media (/du-an/media-su-kien)
                            </label>
                            <span class="text-xs font-mono font-bold text-blue-600 bg-blue-50 dark:bg-blue-950 px-2 py-0.5 rounded border border-blue-200 dark:border-blue-800">
                                {{ $speedMedia }} giây / vòng
                            </span>
                        </div>
                        <input
                            type="range"
                            min="20"
                            max="180"
                            step="5"
                            wire:model.live="speedMedia"
                            class="w-full accent-blue-500 cursor-pointer"
                        />
                        <div class="flex justify-between text-[11px] text-slate-400 mt-1">
                            <span>Chạy nhanh (20s)</span>
                            <span>Tiêu chuẩn (80s)</span>
                            <span>Chạy chậm (180s)</span>
                        </div>
                    </div>

                    <!-- Speed Clients -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                3. Trang Đối Tác & Khách Hàng (/khach-hang)
                            </label>
                            <span class="text-xs font-mono font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-950 px-2 py-0.5 rounded border border-emerald-200 dark:border-emerald-800">
                                {{ $speedClients }} giây / vòng
                            </span>
                        </div>
                        <input
                            type="range"
                            min="20"
                            max="180"
                            step="5"
                            wire:model.live="speedClients"
                            class="w-full accent-emerald-500 cursor-pointer"
                        />
                        <div class="flex justify-between text-[11px] text-slate-400 mt-1">
                            <span>Chạy nhanh (20s)</span>
                            <span>Tiêu chuẩn (85s)</span>
                            <span>Chạy chậm (180s)</span>
                        </div>
                    </div>

                    <div class="p-3 bg-amber-50 dark:bg-amber-950/40 rounded-xl border border-amber-200 dark:border-amber-800/60 text-xs text-amber-800 dark:text-amber-300 flex items-start gap-2">
                        <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Mẹo: Thời gian tính theo chu kỳ cuộn toàn bộ logo. Số giây càng nhỏ logo lướt qua càng nhanh. Khuyên dùng khoảng <strong>60s - 90s</strong> để mắt người xem dễ nhận diện thương hiệu nhất.</span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-700">
                    <button
                        type="button"
                        wire:click="closeSpeedModal"
                        class="px-4 py-2 text-xs font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 rounded-lg transition"
                    >
                        Hủy bỏ
                    </button>
                    <button
                        type="button"
                        wire:click="saveSpeedSettings"
                        class="px-4 py-2 text-xs font-semibold text-white bg-orange-600 hover:bg-orange-700 rounded-lg shadow-sm shadow-orange-500/20 transition flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Lưu cấu hình tốc độ</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
