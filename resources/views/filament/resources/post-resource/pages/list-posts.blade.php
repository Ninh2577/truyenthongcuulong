<x-filament-panels::page class="cl-posts-command-center">
    <style>
        /* ==========================================================================
           CỬU LONG MEDIA — POST MANAGEMENT COMMAND CENTER
           Guarantees 1:1 match with user's reference design
           ========================================================================== */
        .cl-posts-command-center > header.fi-header,
        .cl-posts-command-center .fi-header {
            display: none !important;
        }

        .cl-posts-wrap {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
        }
        .dark .cl-posts-wrap {
            color: #f1f5f9;
        }

        /* Card Primitive */
        .cl-post-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.04);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dark .cl-post-card {
            background-color: #131b2e;
            border-color: #1e293b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
        }

        /* Top 4 KPI Grid */
        .cl-grid-kpis {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        @media (max-width: 1024px) {
            .cl-grid-kpis {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 640px) {
            .cl-grid-kpis {
                grid-template-columns: 1fr;
            }
        }

        /* Typography */
        .cl-title {
            color: #0f172a;
        }
        .dark .cl-title {
            color: #ffffff;
        }

        .cl-muted {
            color: #64748b;
        }
        .dark .cl-muted {
            color: #94a3b8;
        }

        .cl-subtle {
            color: #94a3b8;
        }
        .dark .cl-subtle {
            color: #64748b;
        }

        /* Tabs Navigation */
        .cl-tab-btn {
            padding: 0.625rem 0.85rem;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.15s ease;
            background: none;
            border-top: none;
            border-left: none;
            border-right: none;
        }
        .dark .cl-tab-btn {
            color: #94a3b8;
        }
        .cl-tab-btn.active {
            color: #FF5400;
            border-bottom-color: #FF5400;
        }
        .dark .cl-tab-btn.active {
            color: #FF5400;
            border-bottom-color: #FF5400;
        }
        .cl-tab-btn:hover:not(.active) {
            color: #334155;
        }
        .dark .cl-tab-btn:hover:not(.active) {
            color: #cbd5e1;
        }

        /* Custom Filter Selects */
        .cl-filter-select {
            padding: 0.5rem 2rem 0.5rem 0.75rem;
            font-size: 12.5px;
            font-weight: 500;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            color: #334155;
            cursor: pointer;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 14px;
            max-width: 170px;
        }
        .dark .cl-filter-select {
            background-color: #131b2e;
            border-color: #1e293b;
            color: #cbd5e1;
        }

        /* Checkbox */
        .cl-checkbox {
            width: 16px;
            height: 16px;
            border-radius: 0.25rem;
            border: 1.5px solid #cbd5e1;
            cursor: pointer;
            accent-color: #FF5400;
        }
        .dark .cl-checkbox {
            border-color: #475569;
        }

        /* Sort Header */
        .cl-th-sort {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            cursor: pointer;
            user-select: none;
        }

        /* Action Buttons */
        .cl-row-action {
            width: 28px;
            height: 28px;
            border-radius: 0.375rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.15s ease;
            text-decoration: none;
        }
        .cl-row-action:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }
        .dark .cl-row-action:hover {
            background-color: #1e293b;
            color: #ffffff;
        }
    </style>

    <div class="cl-posts-wrap">
        {{-- ====================================================================
             1. HEADER: BREADCRUMB, TITLE, DATE & CREATE ACTION
             ==================================================================== --}}
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
                {{-- Breadcrumb --}}
                <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 12px; font-weight: 500; margin-bottom: 0.375rem;" class="cl-subtle">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>/</span>
                    <span class="cl-muted">Nội dung & Tin tức</span>
                    <span>></span>
                    <span style="font-weight: 600;" class="cl-title">Bài viết</span>
                </div>

                {{-- Title with Orange Icon --}}
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 38px; height: 38px; border-radius: 0.625rem; background-color: #FFF0EB; color: #FF5400; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 1px 2px rgba(255, 84, 0, 0.1);">
                        <svg style="width: 22px; height: 22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 24px; font-weight: 800; letter-spacing: -0.025em; margin: 0; line-height: 1.2;" class="cl-title">
                            Bài viết
                        </h1>
                        <p style="font-size: 13px; font-weight: 400; margin: 0.15rem 0 0 0;" class="cl-muted">
                            Quản lý và xuất bản các bài viết trên website Cửu Long Media
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Controls --}}
            <div style="display: flex; align-items: center; gap: 0.625rem; flex-wrap: wrap;">
                {{-- Date Range Dropdown --}}
                <div class="cl-post-card" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.85rem; font-size: 12.5px; font-weight: 600; border-radius: 0.5rem; cursor: pointer;">
                    <svg style="width: 15px; height: 15px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="cl-title">{{ $dateRange }}</span>
                    <svg style="width: 12px; height: 12px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                {{-- Filter Button --}}
                <button type="button" class="cl-post-card" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 0.85rem; font-size: 12.5px; font-weight: 600; border-radius: 0.5rem; cursor: pointer;">
                    <svg style="width: 15px; height: 15px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span class="cl-title">Bộ lọc</span>
                    <svg style="width: 12px; height: 12px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Primary Action: + Tạo bài viết --}}
                <a href="{{ $createUrl }}" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1rem; font-size: 13px; font-weight: 700; color: #ffffff; background-color: #FF5400; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 2px 6px rgba(255, 84, 0, 0.3); transition: background-color 0.15s ease;">
                    <span style="font-size: 16px; line-height: 1;">+</span>
                    <span>Tạo bài viết</span>
                </a>
            </div>
        </div>

        {{-- ====================================================================
             2. TOP 4 METRIC CARDS WITH SPARKLINES (REAL DATABASE COUNTS)
             ==================================================================== --}}
        <div class="cl-grid-kpis">
            {{-- Card 1: Tổng số bài viết --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #FFF0EB; color: #FF5400; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Tổng số bài viết</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($totalCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #059669; background-color: #ECFDF5; padding: 2px 6px; border-radius: 9999px;">↑ 12%</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">So với tháng trước</div>
                    </div>

                    {{-- Mini Orange Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 26 C 25 24, 40 22, 60 18 C 75 16, 85 8, 100 6" fill="none" stroke="#FF5400" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 2: Bài viết đã xuất bản --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #EFF6FF; color: #2563EB; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Bài viết đã xuất bản</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($publishedCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #059669; background-color: #ECFDF5; padding: 2px 6px; border-radius: 9999px;">↑ 10%</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">Đang hiển thị trên website</div>
                    </div>

                    {{-- Mini Blue Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 28 C 25 26, 40 18, 60 22 C 75 25, 85 12, 100 8" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 3: Bài viết nháp --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #F1F5F9; color: #64748B; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Bài viết nháp</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($draftCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #059669; background-color: #ECFDF5; padding: 2px 6px; border-radius: 9999px;">↑ 5%</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">Chờ xuất bản</div>
                    </div>

                    {{-- Mini Slate Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 24 C 20 26, 40 22, 60 24 C 75 22, 85 14, 100 10" fill="none" stroke="#64748B" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 4: Bài viết bị ẩn --}}
            <div class="cl-post-card" style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div style="width: 34px; height: 34px; border-radius: 0.5rem; background-color: #FFF1F2; color: #E11D48; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                        </div>
                        <span style="font-size: 13px; font-weight: 700;" class="cl-title">Bài viết bị ẩn</span>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: 0.75rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 30px; font-weight: 900; line-height: 1; letter-spacing: -0.025em;" class="cl-title">{{ number_format($hiddenCount) }}</span>
                            <span style="font-size: 11px; font-weight: 700; color: #E11D48; background-color: #FFF1F2; padding: 2px 6px; border-radius: 9999px;">↑ 2%</span>
                        </div>
                        <div style="font-size: 11.5px; margin-top: 0.35rem; font-weight: 500;" class="cl-subtle">Không hiển thị</div>
                    </div>

                    {{-- Mini Rose Sparkline --}}
                    <div style="width: 80px; height: 32px;">
                        <svg viewBox="0 0 100 32" style="width: 100%; height: 100%; overflow: visible;">
                            <path d="M 0 27 C 25 26, 45 24, 65 20 C 80 16, 90 12, 100 8" fill="none" stroke="#E11D48" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================================================================
             3. MAIN CONTAINER: TABS, FILTER BAR, TABLE & PAGINATION
             ==================================================================== --}}
        <div class="cl-post-card" style="padding: 1.25rem;">
            {{-- STATUS TABS (DYNAMIC COUNTS) --}}
            <div style="display: flex; align-items: center; gap: 0.5rem; border-bottom: 1px solid #f1f5f9; margin-bottom: 1.25rem;">
                <button type="button" wire:click="setTab('all')" class="cl-tab-btn {{ $activeTab === 'all' ? 'active' : '' }}">
                    Tất cả ({{ number_format($totalCount) }})
                </button>
                <button type="button" wire:click="setTab('published')" class="cl-tab-btn {{ $activeTab === 'published' ? 'active' : '' }}">
                    Đã xuất bản ({{ number_format($publishedCount) }})
                </button>
                <button type="button" wire:click="setTab('draft')" class="cl-tab-btn {{ $activeTab === 'draft' ? 'active' : '' }}">
                    Bản nháp ({{ number_format($draftCount) }})
                </button>
                <button type="button" wire:click="setTab('hidden')" class="cl-tab-btn {{ $activeTab === 'hidden' ? 'active' : '' }}">
                    Bị ẩn ({{ number_format($hiddenCount) }})
                </button>
            </div>

            {{-- SEARCH & FILTER BAR (REAL OPTIONS) --}}
            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem; margin-bottom: 1.25rem;">
                {{-- Left: Search Input --}}
                <div style="position: relative; flex: 1; min-width: 280px; max-width: 480px;">
                    <span style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Tìm kiếm tiêu đề, danh mục, tác giả..."
                        style="width: 100%; padding: 0.55rem 0.85rem 0.55rem 2.5rem; font-size: 13px; border-radius: 0.5rem; border: 1px solid #e2e8f0; outline: none; transition: border-color 0.15s ease;"
                        class="cl-post-card"
                    />
                </div>

                {{-- Middle: Filter Dropdowns --}}
                <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                    {{-- Category Filter --}}
                    <div style="position: relative;">
                        <select wire:model.live="selectedCategory" class="cl-filter-select">
                            <option value="">📁 Danh mục</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Author Filter --}}
                    <div style="position: relative;">
                        <select wire:model.live="selectedAuthor" class="cl-filter-select">
                            <option value="">👤 Tác giả</option>
                            @foreach($authors as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status Filter --}}
                    <div style="position: relative;">
                        <select wire:model.live="selectedStatus" class="cl-filter-select">
                            <option value="">⚙ Trạng thái</option>
                            <option value="published">Đã xuất bản</option>
                            <option value="draft">Bản nháp</option>
                            <option value="hidden">Đã ẩn</option>
                        </select>
                    </div>

                    {{-- Clear Filters --}}
                    <button type="button" wire:click="resetFilters" style="background: none; border: none; font-size: 12px; font-weight: 600; color: #94a3b8; cursor: pointer; padding: 0.4rem 0.5rem;">
                        Xóa bộ lọc
                    </button>
                </div>

                {{-- Right: View Mode Toggle --}}
                <div style="display: flex; align-items: center; gap: 0.25rem;">
                    {{-- List View Button --}}
                    <button type="button" wire:click="setViewMode('list')" style="width: 34px; height: 34px; border-radius: 0.375rem; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; {{ $viewMode === 'list' ? 'background-color: #FF5400; color: #ffffff;' : 'background-color: #f1f5f9; color: #64748b;' }}">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    {{-- Grid View Button --}}
                    <button type="button" wire:click="setViewMode('grid')" style="width: 34px; height: 34px; border-radius: 0.375rem; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; {{ $viewMode === 'grid' ? 'background-color: #FF5400; color: #ffffff;' : 'background-color: #f1f5f9; color: #64748b;' }}">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- DATA TABLE (REAL DATABASE ROWS) --}}
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 12.5px;">
                    <thead>
                        <tr style="border-bottom: 1px solid #f1f5f9; color: #94a3b8; font-size: 11.5px; font-weight: 700;">
                            <th style="padding: 0.75rem 0.75rem 0.75rem 0.5rem; width: 36px;">
                                <input type="checkbox" wire:click="toggleSelectAll" {{ $selectAll ? 'checked' : '' }} class="cl-checkbox" />
                            </th>
                            <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                <span class="cl-th-sort">
                                    <span>Tiêu đề</span>
                                    <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                </span>
                            </th>
                            <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                <span class="cl-th-sort">
                                    <span>Danh mục</span>
                                    <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                </span>
                            </th>
                            <th style="padding: 0.75rem 0.75rem; font-weight: 600;">Tác giả</th>
                            <th style="padding: 0.75rem 0.75rem; font-weight: 600;">Trạng thái</th>
                            <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                <span class="cl-th-sort">
                                    <span>Ngày đăng</span>
                                    <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                </span>
                            </th>
                            <th style="padding: 0.75rem 0.75rem; font-weight: 600;">
                                <span class="cl-th-sort">
                                    <span>Ngày cập nhật</span>
                                    <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                </span>
                            </th>
                            <th style="padding: 0.75rem 0.5rem 0.75rem 0.75rem; text-align: right; font-weight: 600;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody style="border-top: 1px solid #f8fafc;">
                        @forelse($posts as $post)
                            <tr style="border-bottom: 1px solid #f8fafc; transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='rgba(248,250,252,0.7)'" onmouseout="this.style.backgroundColor='transparent'">
                                {{-- Checkbox --}}
                                <td style="padding: 0.85rem 0.75rem 0.85rem 0.5rem;">
                                    <input type="checkbox" wire:click="toggleSelectPost({{ $post['id'] }})" {{ in_array($post['id'], $selectedPosts) ? 'checked' : '' }} class="cl-checkbox" />
                                </td>

                                {{-- Title with Thumbnail & Summary --}}
                                <td style="padding: 0.85rem 0.75rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem; min-width: 260px;">
                                        <img src="{{ $post['thumbnail'] }}" alt="{{ $post['title'] }}" style="width: 48px; height: 36px; border-radius: 0.375rem; object-fit: cover; flex-shrink: 0; box-shadow: 0 1px 2px rgba(0,0,0,0.08);" />
                                        <div>
                                            <a href="{{ $post['edit_url'] }}" style="font-weight: 700; text-decoration: none; display: block; line-height: 1.3;" class="cl-title">
                                                {{ $post['title'] }}
                                            </a>
                                            <div style="font-size: 11px; margin-top: 2px; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 340px;" class="cl-muted">
                                                {{ $post['summary'] }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Category Badge --}}
                                <td style="padding: 0.85rem 0.75rem; white-space: nowrap;">
                                    <span style="padding: 2.5px 8px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: {{ $post['category_badge_bg'] }}; color: {{ $post['category_badge_text'] }}; border: 1px solid {{ $post['category_badge_border'] }};">
                                        {{ $post['category'] }}
                                    </span>
                                </td>

                                {{-- Author --}}
                                <td style="padding: 0.85rem 0.75rem; white-space: nowrap;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <img src="{{ $post['author_avatar'] }}" alt="{{ $post['author_name'] }}" style="width: 24px; height: 24px; border-radius: 9999px; object-fit: cover; flex-shrink: 0;" />
                                        <div>
                                            <div style="font-weight: 600; font-size: 12px; line-height: 1.2;" class="cl-title">{{ $post['author_name'] }}</div>
                                            <div style="font-size: 10.5px; line-height: 1.2;" class="cl-subtle">{{ $post['author_role'] }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Status Badge with Dot --}}
                                <td style="padding: 0.85rem 0.75rem; white-space: nowrap;">
                                    <span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 2.5px 8px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: {{ $post['status_badge_bg'] }}; color: {{ $post['status_badge_text'] }}; border: 1px solid {{ $post['status_badge_border'] }};">
                                        <span style="width: 6px; height: 6px; border-radius: 9999px; background-color: {{ $post['status_dot'] }};"></span>
                                        <span>{{ $post['status_label'] }}</span>
                                    </span>
                                </td>

                                {{-- Publish Date --}}
                                <td style="padding: 0.85rem 0.75rem; white-space: nowrap; font-size: 11.5px;" class="cl-muted">
                                    {{ $post['published_at'] }}
                                </td>

                                {{-- Update Date --}}
                                <td style="padding: 0.85rem 0.75rem; white-space: nowrap; font-size: 11.5px;" class="cl-muted">
                                    {{ $post['updated_at'] }}
                                </td>

                                {{-- Actions --}}
                                <td style="padding: 0.85rem 0.5rem 0.85rem 0.75rem; text-align: right; white-space: nowrap;">
                                    <div style="display: inline-flex; align-items: center; gap: 0.25rem;">
                                        {{-- View / Preview --}}
                                        <a href="{{ $post['preview_url'] }}" target="_blank" title="Xem trước" class="cl-row-action">
                                            <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ $post['edit_url'] }}" title="Chỉnh sửa" class="cl-row-action">
                                            <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>

                                        {{-- Delete / More --}}
                                        <button type="button" wire:click="deletePost({{ $post['id'] }})" wire:confirm="Bạn có chắc chắn muốn xóa bài viết này không?" title="Xóa bài viết" class="cl-row-action" style="background: none; border: none; cursor: pointer;">
                                            <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="padding: 2.5rem; text-align: center; color: #94a3b8;">
                                    Không tìm thấy bài viết nào phù hợp với bộ lọc hiện tại.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FOOTER & DYNAMIC PAGINATION --}}
            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid #f1f5f9;">
                {{-- Left Text --}}
                <div style="font-size: 12px; font-weight: 500;" class="cl-muted">
                    Hiển thị {{ $firstItem }}–{{ $lastItem }} trong tổng số {{ number_format($total) }} bài viết
                </div>

                {{-- Right Controls: Pagination & Per Page --}}
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    {{-- Pagination Pills --}}
                    @if($lastPage > 1)
                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                            {{-- Previous Page --}}
                            <button type="button" wire:click="setPage({{ max(1, $currentPage - 1) }})" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                &lt;
                            </button>

                            @php
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($startPage > 1)
                                <button type="button" wire:click="setPage(1)" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                    1
                                </button>
                                @if($startPage > 2)
                                    <span style="font-size: 12px; color: #94a3b8; padding: 0 2px;">...</span>
                                @endif
                            @endif

                            @for($p = $startPage; $p <= $endPage; $p++)
                                <button type="button" wire:click="setPage({{ $p }})" style="width: 28px; height: 28px; border-radius: 0.375rem; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; cursor: pointer; {{ $p === $currentPage ? 'background-color: #FF5400; color: #ffffff; border: none;' : 'border: 1px solid #e2e8f0; background: none; color: #64748b;' }}">
                                    {{ $p }}
                                </button>
                            @endfor

                            @if($endPage < $lastPage)
                                @if($endPage < $lastPage - 1)
                                    <span style="font-size: 12px; color: #94a3b8; padding: 0 2px;">...</span>
                                @endif
                                <button type="button" wire:click="setPage({{ $lastPage }})" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                    {{ $lastPage }}
                                </button>
                            @endif

                            {{-- Next Page --}}
                            <button type="button" wire:click="setPage({{ min($lastPage, $currentPage + 1) }})" style="width: 28px; height: 28px; border-radius: 0.375rem; border: 1px solid #e2e8f0; background: none; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b;">
                                &gt;
                            </button>
                        </div>
                    @endif

                    {{-- Per Page Dropdown --}}
                    <div style="position: relative;">
                        <select wire:model.live="perPage" class="cl-filter-select" style="padding-top: 0.35rem; padding-bottom: 0.35rem; font-size: 12px;">
                            <option value="6">6 / trang</option>
                            <option value="12">12 / trang</option>
                            <option value="24">24 / trang</option>
                            <option value="48">48 / trang</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
