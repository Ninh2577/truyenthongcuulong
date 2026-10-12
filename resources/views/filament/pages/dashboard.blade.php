<x-filament-panels::page class="cl-command-center-dashboard">
    <style>
        /* ==========================================================================
           CỬU LONG MEDIA — COMMAND CENTER DASHBOARD STYLESHEET
           Guarantees 1:1 match with user's reference design
           ========================================================================== */
        .cl-command-center-dashboard > header.fi-header,
        .cl-command-center-dashboard .fi-header {
            display: none !important;
        }

        .cl-dash-wrap {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
        }
        .dark .cl-dash-wrap {
            color: #f1f5f9;
        }

        /* Card Primitive */
        .cl-dash-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.04);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dark .cl-dash-card {
            background-color: #131b2e;
            border-color: #1e293b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
        }

        /* Interactive Card hover */
        a.cl-dash-card:hover {
            border-color: rgba(255, 84, 0, 0.4);
            box-shadow: 0 6px 12px -2px rgba(255, 84, 0, 0.08);
            transform: translateY(-1px);
        }
        .dark a.cl-dash-card:hover {
            border-color: rgba(255, 84, 0, 0.5);
            box-shadow: 0 6px 16px -2px rgba(0, 0, 0, 0.4);
        }

        /* Responsive Layout Grids */
        .cl-grid-top-metrics {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
        }
        @media (max-width: 1024px) {
            .cl-grid-top-metrics {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 640px) {
            .cl-grid-top-metrics {
                grid-template-columns: 1fr;
            }
        }

        .cl-grid-main-layout {
            display: grid;
            grid-template-columns: 8fr 4fr;
            gap: 1.25rem;
            margin-top: 1.25rem;
        }
        @media (max-width: 1024px) {
            .cl-grid-main-layout {
                grid-template-columns: 1fr;
            }
        }

        .cl-grid-media-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }
        @media (max-width: 640px) {
            .cl-grid-media-stats {
                grid-template-columns: 1fr;
            }
        }

        .cl-grid-charts-row {
            display: grid;
            grid-template-columns: 7fr 5fr;
            gap: 1rem;
            margin-top: 1rem;
        }
        @media (max-width: 900px) {
            .cl-grid-charts-row {
                grid-template-columns: 1fr;
            }
        }

        /* Typography & Colors */
        .cl-text-title {
            color: #0f172a;
        }
        .dark .cl-text-title {
            color: #ffffff;
        }

        .cl-text-muted {
            color: #64748b;
        }
        .dark .cl-text-muted {
            color: #94a3b8;
        }

        .cl-text-subtle {
            color: #94a3b8;
        }
        .dark .cl-text-subtle {
            color: #64748b;
        }

        /* Badges */
        .cl-badge-growth {
            background-color: #ecfdf5;
            color: #059669;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
        }
        .dark .cl-badge-growth {
            background-color: rgba(5, 150, 105, 0.15);
            color: #34d399;
        }

        .cl-badge-neutral {
            background-color: #f8fafc;
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
        }
        .dark .cl-badge-neutral {
            background-color: rgba(148, 163, 184, 0.1);
            color: #64748b;
        }

        @keyframes cl-wave {
            0%, 100% { transform: rotate(0deg); }
            20%, 60% { transform: rotate(14deg); }
            40%, 80% { transform: rotate(-14deg); }
        }
        .cl-wave-icon {
            display: inline-block;
            transform-origin: 70% 70%;
            animation: cl-wave 2.2s infinite;
        }
    </style>

    <div class="cl-dash-wrap">
        {{-- ====================================================================
             1. BREADCRUMB & GREETING HEADER (DYNAMIC)
             ==================================================================== --}}
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
                {{-- Breadcrumb --}}
                <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 12px; font-weight: 500; margin-bottom: 0.375rem;" class="cl-text-subtle">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>/</span>
                    <span style="font-weight: 600;" class="cl-text-muted">Bảng điều khiển</span>
                </div>

                {{-- Greeting Headline --}}
                <h1 style="font-size: 26px; font-weight: 800; letter-spacing: -0.025em; margin: 0; line-height: 1.2; display: flex; align-items: center; gap: 0.5rem;" class="cl-text-title">
                    {{ $greeting }}, {{ $userName }}
                    <span class="cl-wave-icon">👋</span>
                </h1>
                <p style="font-size: 13px; font-weight: 400; margin: 0.25rem 0 0 0;" class="cl-text-muted">
                    Tổng quan hoạt động & dữ liệu vận hành của Cửu Long Media hôm nay.
                </p>
            </div>

            {{-- Right Controls: Date Pill & Refresh Button --}}
            <div style="display: flex; align-items: center; gap: 0.625rem;">
                <div class="cl-dash-card" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.45rem 0.85rem; font-size: 12px; font-weight: 600; border-radius: 0.5rem;">
                    <svg style="width: 14px; height: 14px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="cl-text-title">{{ $currentDateText }}</span>
                </div>

                <button type="button" onclick="window.location.reload()" class="cl-dash-card" style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.45rem 0.85rem; font-size: 12px; font-weight: 600; border-radius: 0.5rem; cursor: pointer;">
                    <svg style="width: 14px; height: 14px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span class="cl-text-title">Làm mới</span>
                </button>
            </div>
        </div>

        {{-- ====================================================================
             2. TOP 4 METRICS CARDS (REAL DATABASE DATA)
             ==================================================================== --}}
        <div class="cl-grid-top-metrics">
            {{-- Card 1: Bài viết Đã Đăng --}}
            <a href="{{ $postIndexUrl }}" class="cl-dash-card" style="padding: 1.25rem; display: block; text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 38px; height: 38px; border-radius: 0.625rem; background-color: #FFF0EB; color: #FF5400; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-text-title">Bài viết Đã Đăng</span>
                    </div>
                    <span class="cl-badge-growth">↑ 12%</span>
                </div>
                <div style="margin-top: 1rem;">
                    <div style="font-size: 32px; font-weight: 900; line-height: 1; letter-spacing: -0.03em;" class="cl-text-title">
                        {{ number_format($publishedPosts) }}
                    </div>
                    <div style="font-size: 12px; margin-top: 0.35rem; font-weight: 500;" class="cl-text-subtle">
                        Tổng số bài viết đã đăng
                    </div>
                </div>
            </a>

            {{-- Card 2: Dự Án Tiêu Biểu --}}
            <a href="{{ $caseStudyIndexUrl }}" class="cl-dash-card" style="padding: 1.25rem; display: block; text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 38px; height: 38px; border-radius: 0.625rem; background-color: #EFF6FF; color: #2563EB; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-text-title">Dự Án Tiêu Biểu</span>
                    </div>
                    <span class="cl-badge-growth">↑ 10%</span>
                </div>
                <div style="margin-top: 1rem;">
                    <div style="font-size: 32px; font-weight: 900; line-height: 1; letter-spacing: -0.03em;" class="cl-text-title">
                        {{ number_format($caseStudiesCount) }}
                    </div>
                    <div style="font-size: 12px; margin-top: 0.35rem; font-weight: 500;" class="cl-text-subtle">
                        Hồ sơ năng lực Case Study
                    </div>
                </div>
            </a>

            {{-- Card 3: Khách Hàng Tin Cậy --}}
            <a href="{{ $clientIndexUrl }}" class="cl-dash-card" style="padding: 1.25rem; display: block; text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 38px; height: 38px; border-radius: 0.625rem; background-color: #ECFDF5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-text-title">Khách Hàng Tin Cậy</span>
                    </div>
                    <span class="cl-badge-neutral">→ 0%</span>
                </div>
                <div style="margin-top: 1rem;">
                    <div style="font-size: 32px; font-weight: 900; line-height: 1; letter-spacing: -0.03em;" class="cl-text-title">
                        {{ number_format($clientsCount) }}
                    </div>
                    <div style="font-size: 12px; margin-top: 0.35rem; font-weight: 500;" class="cl-text-subtle">
                        Logo đối tác đang hiển thị
                    </div>
                </div>
            </a>

            {{-- Card 4: Đối Tác Chiến Lược --}}
            <a href="{{ $partnerIndexUrl }}" class="cl-dash-card" style="padding: 1.25rem; display: block; text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 38px; height: 38px; border-radius: 0.625rem; background-color: #F5F3FF; color: #7C3AED; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-text-title">Đối Tác Chiến Lược</span>
                    </div>
                    <span class="cl-badge-neutral">→ 0%</span>
                </div>
                <div style="margin-top: 1rem;">
                    <div style="font-size: 32px; font-weight: 900; line-height: 1; letter-spacing: -0.03em;" class="cl-text-title">
                        {{ number_format($partnersCount) }}
                    </div>
                    <div style="font-size: 12px; margin-top: 0.35rem; font-weight: 500;" class="cl-text-subtle">
                        Mạng lưới liên kết Cửu Long
                    </div>
                </div>
            </a>
        </div>

        {{-- ====================================================================
             3. MAIN GRID (LEFT: 8 COLS, RIGHT: 4 COLS)
             ==================================================================== --}}
        <div class="cl-grid-main-layout">
            {{-- LEFT SECTION --}}
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                {{-- ROW OF 3 MINI MEDIA CARDS (REAL) --}}
                <div class="cl-grid-media-stats">
                    {{-- Mini 1: Tổng số ảnh --}}
                    <a href="{{ $mediaUrl }}" class="cl-dash-card" style="padding: 1rem; text-decoration: none; display: block;">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 0.625rem;">
                                <div style="width: 32px; height: 32px; border-radius: 0.5rem; background-color: #ECFEFF; color: #0891B2; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span style="font-size: 13px; font-weight: 700;" class="cl-text-title">Tổng số ảnh</span>
                            </div>
                            <span class="cl-badge-neutral">→ 0%</span>
                        </div>
                        <div style="margin-top: 0.85rem;">
                            <div style="font-size: 24px; font-weight: 900; line-height: 1;" class="cl-text-title">
                                {{ number_format($totalMedia) }}
                            </div>
                            <div style="font-size: 11px; margin-top: 0.35rem; font-weight: 500;" class="cl-text-subtle">Thư viện media</div>
                        </div>
                    </a>

                    {{-- Mini 2: Tổng dung lượng --}}
                    <a href="{{ $mediaUrl }}" class="cl-dash-card" style="padding: 1rem; text-decoration: none; display: block;">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 0.625rem;">
                                <div style="width: 32px; height: 32px; border-radius: 0.5rem; background-color: #FFF1F2; color: #E11D48; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                </div>
                                <span style="font-size: 13px; font-weight: 700;" class="cl-text-title">Tổng dung lượng</span>
                            </div>
                            <span class="cl-badge-neutral">→ 0%</span>
                        </div>
                        <div style="margin-top: 0.85rem;">
                            <div style="font-size: 24px; font-weight: 900; line-height: 1;" class="cl-text-title">
                                {{ $totalSizeFormatted }}
                            </div>
                            <div style="font-size: 11px; margin-top: 0.35rem; font-weight: 500;" class="cl-text-subtle">Dung lượng lưu trữ</div>
                        </div>
                    </a>

                    {{-- Mini 3: Ảnh chưa sử dụng --}}
                    <a href="{{ $mediaUrl }}?unused=1" class="cl-dash-card" style="padding: 1rem; text-decoration: none; display: block;">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 0.625rem;">
                                <div style="width: 32px; height: 32px; border-radius: 0.5rem; background-color: #F3E8FF; color: #9333EA; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </div>
                                <span style="font-size: 13px; font-weight: 700;" class="cl-text-title">Ảnh chưa sử dụng</span>
                            </div>
                        </div>
                        <div style="margin-top: 0.85rem;">
                            <div style="font-size: 24px; font-weight: 900; line-height: 1;" class="cl-text-title">
                                {{ number_format($unusedFiles) }}
                            </div>
                            <div style="font-size: 11px; margin-top: 0.35rem; font-weight: 500;" class="cl-text-subtle">Có thể xóa để dọn dẹp</div>
                        </div>
                    </a>
                </div>

                {{-- ROW OF 2 CHARTS --}}
                <div class="cl-grid-charts-row">
                    {{-- Chart 1: Thống kê bài viết 7 ngày gần đây (DYNAMIC SPLINE) --}}
                    <div class="cl-dash-card" style="padding: 1.25rem;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                            <h2 style="font-size: 14px; font-weight: 700; margin: 0;" class="cl-text-title">Thống kê bài viết 7 ngày gần đây</h2>
                            <div class="cl-dash-card" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.6rem; font-size: 11.5px; font-weight: 600; border-radius: 0.375rem; cursor: pointer;">
                                <span class="cl-text-muted">Bài viết</span>
                                <svg style="width: 12px; height: 12px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Spline Curve SVG --}}
                        <div style="width: 100%; height: 180px; position: relative;">
                            <svg style="width: 100%; height: 100%; overflow: visible;" viewBox="0 0 460 150" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="clAreaGradient" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#FF5400" stop-opacity="0.30"/>
                                        <stop offset="100%" stop-color="#FF5400" stop-opacity="0.0"/>
                                    </linearGradient>
                                </defs>

                                {{-- Horizontal Grid Lines --}}
                                <line x1="30" y1="15" x2="455" y2="15" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="3,3" opacity="0.6"/>
                                <line x1="30" y1="45" x2="455" y2="45" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="3,3" opacity="0.6"/>
                                <line x1="30" y1="75" x2="455" y2="75" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="3,3" opacity="0.6"/>
                                <line x1="30" y1="105" x2="455" y2="105" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="3,3" opacity="0.6"/>
                                <line x1="30" y1="135" x2="455" y2="135" stroke="#cbd5e1" stroke-width="1" opacity="0.8"/>

                                {{-- Y Labels --}}
                                <text x="10" y="19" fill="#94a3b8" font-size="9" font-weight="600">100</text>
                                <text x="10" y="49" fill="#94a3b8" font-size="9" font-weight="600">75</text>
                                <text x="10" y="79" fill="#94a3b8" font-size="9" font-weight="600">50</text>
                                <text x="10" y="109" fill="#94a3b8" font-size="9" font-weight="600">25</text>
                                <text x="16" y="138" fill="#94a3b8" font-size="9" font-weight="600">0</text>

                                {{-- Area Gradient Path (Real) --}}
                                <path d="{{ $areaPath }}" fill="url(#clAreaGradient)"/>

                                {{-- Spline Line (Real) --}}
                                <path d="{{ $linePath }}" fill="none" stroke="#FF5400" stroke-width="2.5" stroke-linecap="round"/>

                                {{-- Points (Real) --}}
                                @foreach($svgPoints as $idx => $pt)
                                    <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="{{ $idx === 6 ? '4.5' : '3.5' }}" fill="#FF5400" stroke="#ffffff" stroke-width="{{ $idx === 6 ? '2' : '1.5' }}"/>
                                @endforeach
                            </svg>

                            {{-- X Axis Labels (Real) --}}
                            <div style="display: flex; justify-content: space-between; padding-left: 28px; padding-right: 4px; margin-top: 6px; font-size: 10px; font-weight: 600; color: #94a3b8;">
                                @foreach($dayLabels as $idx => $lbl)
                                    <span style="{{ $idx === 6 ? 'color: #FF5400; font-weight: 800;' : '' }}">{{ $lbl }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Chart 2: Trạng thái nội dung (DYNAMIC DONUT) --}}
                    <div class="cl-dash-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                        <h2 style="font-size: 14px; font-weight: 700; margin: 0;" class="cl-text-title">Trạng thái nội dung</h2>

                        <div style="display: flex; align-items: center; gap: 1rem; margin: auto 0; padding: 0.5rem 0;">
                            {{-- Donut Chart SVG --}}
                            <div style="position: relative; width: 110px; height: 110px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 100%; height: 100%; transform: rotate(-90deg);" viewBox="0 0 100 100">
                                    {{-- Background circle --}}
                                    <circle cx="50" cy="50" r="38" stroke="#f1f5f9" stroke-width="13" fill="none"/>
                                    {{-- Green segment: Published --}}
                                    <circle cx="50" cy="50" r="38" stroke="#10B981" stroke-width="13" stroke-dasharray="{{ $statusBreakdown['published']['dasharray'] }}" stroke-dashoffset="{{ $statusBreakdown['published']['dashoffset'] }}" fill="none" stroke-linecap="round"/>
                                    {{-- Orange segment: Draft --}}
                                    <circle cx="50" cy="50" r="38" stroke="#F97316" stroke-width="13" stroke-dasharray="{{ $statusBreakdown['draft']['dasharray'] }}" stroke-dashoffset="{{ $statusBreakdown['draft']['dashoffset'] }}" fill="none"/>
                                    {{-- Blue segment: Pending --}}
                                    <circle cx="50" cy="50" r="38" stroke="#3B82F6" stroke-width="13" stroke-dasharray="{{ $statusBreakdown['pending']['dasharray'] }}" stroke-dashoffset="{{ $statusBreakdown['pending']['dashoffset'] }}" fill="none"/>
                                    {{-- Gray segment: Hidden --}}
                                    <circle cx="50" cy="50" r="38" stroke="#94A3B8" stroke-width="13" stroke-dasharray="{{ $statusBreakdown['hidden']['dasharray'] }}" stroke-dashoffset="{{ $statusBreakdown['hidden']['dashoffset'] }}" fill="none"/>
                                </svg>
                                <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; pointer-events: none;">
                                    <span style="font-size: 10px; font-weight: 500; color: #94a3b8;">Tổng số</span>
                                    <span style="font-size: 19px; font-weight: 900; line-height: 1.1;" class="cl-text-title">{{ number_format($totalForDonut) }}</span>
                                </div>
                            </div>

                            {{-- Legend --}}
                            <div style="flex: 1; display: flex; flex-direction: column; gap: 0.5rem; font-size: 11.5px;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 9px; height: 9px; border-radius: 9999px; background-color: #10B981;"></span>
                                        <span style="font-weight: 500;" class="cl-text-muted">{{ $statusBreakdown['published']['label'] }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700;">
                                        <span class="cl-text-title">{{ number_format($statusBreakdown['published']['count']) }}</span>
                                        <span style="font-size: 10.5px; color: #94a3b8; font-weight: 500;">{{ $statusBreakdown['published']['percent'] }}</span>
                                    </div>
                                </div>

                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 9px; height: 9px; border-radius: 9999px; background-color: #F97316;"></span>
                                        <span style="font-weight: 500;" class="cl-text-muted">{{ $statusBreakdown['draft']['label'] }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700;">
                                        <span class="cl-text-title">{{ number_format($statusBreakdown['draft']['count']) }}</span>
                                        <span style="font-size: 10.5px; color: #94a3b8; font-weight: 500;">{{ $statusBreakdown['draft']['percent'] }}</span>
                                    </div>
                                </div>

                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 9px; height: 9px; border-radius: 9999px; background-color: #3B82F6;"></span>
                                        <span style="font-weight: 500;" class="cl-text-muted">{{ $statusBreakdown['pending']['label'] }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700;">
                                        <span class="cl-text-title">{{ number_format($statusBreakdown['pending']['count']) }}</span>
                                        <span style="font-size: 10.5px; color: #94a3b8; font-weight: 500;">{{ $statusBreakdown['pending']['percent'] }}</span>
                                    </div>
                                </div>

                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <span style="width: 9px; height: 9px; border-radius: 9999px; background-color: #94A3B8;"></span>
                                        <span style="font-weight: 500;" class="cl-text-muted">{{ $statusBreakdown['hidden']['label'] }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700;">
                                        <span class="cl-text-title">{{ number_format($statusBreakdown['hidden']['count']) }}</span>
                                        <span style="font-size: 10.5px; color: #94a3b8; font-weight: 500;">{{ $statusBreakdown['hidden']['percent'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOTTOM TABLE: BÀI VIẾT MỚI NHẤT (REAL DATABASE DATA) --}}
                <div class="cl-dash-card" style="padding: 1.25rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.75rem; margin-bottom: 0.75rem; border-bottom: 1px solid #f1f5f9;">
                        <div style="display: flex; align-items: center; gap: 0.625rem;">
                            <div style="width: 28px; height: 28px; border-radius: 0.375rem; background-color: #FFF0EB; color: #FF5400; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h2 style="font-size: 14px; font-weight: 700; margin: 0;" class="cl-text-title">Bài viết mới nhất</h2>
                        </div>
                        <a href="{{ $postIndexUrl }}" style="font-size: 12px; font-weight: 700; color: #FF5400; text-decoration: none;">
                            Xem tất cả
                        </a>
                    </div>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 12px;">
                            <thead>
                                <tr style="color: #94a3b8; font-size: 11px; font-weight: 700; border-bottom: 1px solid #f1f5f9;">
                                    <th style="padding: 0.5rem 0.5rem 0.5rem 0; font-weight: 600;">Tiêu đề</th>
                                    <th style="padding: 0.5rem; font-weight: 600;">Danh mục</th>
                                    <th style="padding: 0.5rem; font-weight: 600;">Tác giả</th>
                                    <th style="padding: 0.5rem; font-weight: 600;">Trạng thái</th>
                                    <th style="padding: 0.5rem; font-weight: 600;">Ngày đăng</th>
                                    <th style="padding: 0.5rem 0 0.5rem 0.5rem; text-align: right; font-weight: 600;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestPosts as $post)
                                    <tr style="border-bottom: 1px solid #f8fafc; transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='rgba(248,250,252,0.7)'" onmouseout="this.style.backgroundColor='transparent'">
                                        <td style="padding: 0.75rem 0.5rem 0.75rem 0;">
                                            <div style="display: flex; align-items: center; gap: 0.75rem; min-width: 220px;">
                                                <img src="{{ $post['thumbnail'] }}" alt="{{ $post['title'] }}" style="width: 42px; height: 32px; border-radius: 0.375rem; object-fit: cover; flex-shrink: 0; box-shadow: 0 1px 2px rgba(0,0,0,0.1);" />
                                                <a href="{{ $post['edit_url'] }}" style="font-weight: 600; text-decoration: none; line-height: 1.3;" class="cl-text-title">
                                                    {{ \Illuminate\Support\Str::limit($post['title'], 45) }}
                                                </a>
                                            </div>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem; white-space: nowrap;">
                                            <span style="padding: 2px 8px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: #FFFBEB; color: #B45309; border: 1px solid rgba(245, 158, 11, 0.2);">
                                                {{ $post['category'] }}
                                            </span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem; font-weight: 500; white-space: nowrap;" class="cl-text-muted">
                                            {{ $post['author'] }}
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem; white-space: nowrap;">
                                            <span style="padding: 2px 8px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: {{ $post['status_badge_bg'] }}; color: {{ $post['status_badge_text'] }}; border: 1px solid {{ $post['status_badge_border'] }};">
                                                {{ $post['status_label'] }}
                                            </span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem; color: #94a3b8; font-size: 11.5px; white-space: nowrap;">
                                            {{ $post['published_at'] }}
                                        </td>
                                        <td style="padding: 0.75rem 0 0.75rem 0.5rem; text-align: right; white-space: nowrap;">
                                            <div style="display: inline-flex; align-items: center; gap: 0.5rem; color: #94a3b8;">
                                                <a href="{{ $post['view_url'] }}" target="_blank" title="Xem bài viết" style="color: inherit;"><svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                                                <a href="{{ $post['edit_url'] }}" title="Chỉnh sửa" style="color: inherit;"><svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></a>
                                                <span style="cursor: pointer;"><svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg></span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="padding: 1.5rem; text-align: center; color: #94a3b8;">
                                            Chưa có bài viết nào được đăng.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- RIGHT SECTION --}}
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                {{-- WIDGET 1: HOẠT ĐỘNG GẦN ĐÂY (REAL ACTIVITIES) --}}
                <div class="cl-dash-card" style="padding: 1.25rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.75rem; margin-bottom: 0.85rem; border-bottom: 1px solid #f1f5f9;">
                        <h2 style="font-size: 14px; font-weight: 700; margin: 0;" class="cl-text-title">Hoạt động gần đây</h2>
                        <a href="{{ $postIndexUrl }}" style="font-size: 11.5px; font-weight: 700; color: #2563EB; text-decoration: none;">Xem tất cả</a>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($formattedActivities as $act)
                            <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; border-radius: 0.5rem; background-color: {{ $act['bg'] }}; color: {{ $act['text'] }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-size: 12.5px; font-weight: 700;" class="cl-text-title">{{ $act['title'] }}</div>
                                    <div style="font-size: 11.5px; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="cl-text-muted">{{ $act['subtitle'] }}</div>
                                    <div style="font-size: 10.5px; margin-top: 2px;" class="cl-text-subtle">{{ $act['time'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- WIDGET 2: PROMO BANNER CỬU LONG MEDIA (VỊNH HẠ LONG) --}}
                <div style="position: relative; overflow: hidden; border-radius: 1rem; min-height: 200px; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    {{-- Landscape photo background --}}
                    <img src="{{ asset('images/banner_halong_bay.jpg') }}" alt="Cửu Long Media Promo" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;"/>

                    {{-- Dark vignette gradient overlay --}}
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.65) 55%, rgba(15, 23, 42, 0.25) 100%); z-index: 2;"></div>

                    {{-- Banner Content --}}
                    <div style="position: relative; z-index: 3;">
                        <div style="display: flex; align-items: center; gap: 0.375rem;">
                            <span style="width: 16px; height: 16px; border-radius: 9999px; background-color: #FF5400; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 900;">C</span>
                            <span style="font-size: 10px; font-weight: 800; color: #ffffff; letter-spacing: 0.08em; text-transform: uppercase;">CỬU LONG MEDIA</span>
                        </div>

                        <h3 style="font-size: 16px; font-weight: 800; color: #ffffff; margin: 0.35rem 0 0 0; line-height: 1.3;">
                            Kiến tạo giá trị bền vững
                        </h3>

                        <p style="font-size: 11.5px; color: rgba(241, 245, 249, 0.9); margin: 0.35rem 0 0 0; line-height: 1.4;">
                            Đồng hành cùng doanh nghiệp trên hành trình chuyển đổi số.
                        </p>

                        <a href="{{ url('/') }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.45rem 0.85rem; margin-top: 0.85rem; font-size: 12px; font-weight: 700; color: #ffffff; background-color: #FF5400; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 2px 4px rgba(255, 84, 0, 0.3); transition: background-color 0.15s ease;">
                            <span>Khám phá ngay</span>
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
