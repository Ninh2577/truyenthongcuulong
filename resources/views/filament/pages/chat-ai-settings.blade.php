<x-filament-panels::page>
<div class="cl-ai-page-wrap">
    <!-- Top Breadcrumb & Header Row -->
    <div class="cl-ai-header">
        <div class="cl-ai-header-left">
            <!-- Breadcrumb -->
            <div class="cl-ai-breadcrumb">
                <svg class="cl-home-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span>Truyền thông & CSKH</span>
                <span class="cl-crumb-sep">›</span>
                <span class="cl-crumb-active">Trợ Lý AI Bot</span>
            </div>

            <!-- Title & Subtitle with Robot Icon -->
            <div class="cl-ai-title-row">
                <div class="cl-robot-avatar">
                    <svg class="cl-robot-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                        <circle cx="12" cy="5" r="2"></circle>
                        <path d="M12 7v4"></path>
                        <line x1="8" y1="16" x2="8" y2="16"></line>
                        <line x1="16" y1="16" x2="16" y2="16"></line>
                    </svg>
                </div>
                <div>
                    <h1 class="cl-ai-title">Trợ Lý AI Bot</h1>
                    <p class="cl-ai-subtitle">Quản Trị Vận Hành AI Chat - Thiết lập và quản lý trợ lý AI giúp tự động phản hồi khách hàng 24/7, hỗ trợ tư vấn và giải đáp thông tin nhanh chóng.</p>
                </div>
            </div>
        </div>

        <!-- Top Right Actions: Master Toggle + Save Button -->
        <div class="cl-ai-header-right">
            <!-- Master Bot Toggle -->
            <div class="cl-master-toggle-wrap">
                <button
                    type="button"
                    wire:click="toggleBot"
                    class="cl-master-switch {{ $enabled ? 'is-active' : '' }}"
                    aria-label="Bật/Tắt AI Bot"
                >
                    <span class="cl-master-knob"></span>
                </button>
                <div class="cl-toggle-text-block">
                    <span class="cl-toggle-title">Bật AI Bot</span>
                    <span class="cl-toggle-desc">{{ $enabled ? 'Bot đang hoạt động' : 'Bot đã tạm dừng' }}</span>
                </div>
            </div>

            <!-- Save Settings Button -->
            <button
                type="button"
                wire:click="save"
                wire:loading.attr="disabled"
                class="cl-btn-save"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                <span wire:loading.remove>Lưu cài đặt</span>
                <span wire:loading>Đang lưu...</span>
            </button>
        </div>
    </div>

    <!-- Metrics / Stat Cards Row (4 cards) -->
    <div class="cl-stats-grid">
        <!-- Card 1: Tổng câu hỏi đã xử lý -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Tổng câu hỏi đã xử lý</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">1.248</span>
                    <span class="cl-stat-trend trend-up">↑ 12%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>

        <!-- Card 2: Khách hàng đã tương tác -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Khách hàng đã tương tác</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">892</span>
                    <span class="cl-stat-trend trend-up">↑ 18%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>

        <!-- Card 3: Thời gian phản hồi trung bình -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Thời gian phản hồi trung bình</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">3.2s</span>
                    <span class="cl-stat-trend trend-down">↓ 45%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>

        <!-- Card 4: Tỷ lệ hài lòng -->
        <div class="cl-stat-card">
            <div class="cl-stat-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="cl-stat-info">
                <div class="cl-stat-label">Tỷ lệ hài lòng</div>
                <div class="cl-stat-num-row">
                    <span class="cl-stat-value">98.5%</span>
                    <span class="cl-stat-trend trend-up">↑ 2%</span>
                </div>
                <div class="cl-stat-sub">so với 7 ngày trước</div>
            </div>
        </div>
    </div>

    <!-- Main Content: 2 Columns Split Grid -->
    <div class="cl-main-ai-grid">
        <!-- Left Column: Cấu hình AI Bot (approx 62%) -->
        <div class="cl-left-stack">
            <!-- Configuration Card -->
            <div class="cl-config-card">
                <!-- Card Header -->
                <div class="cl-config-header">
                    <div class="cl-config-title">
                        <svg class="cl-gear-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Cấu hình AI Bot</span>
                    </div>
                </div>

                <!-- Tabs Row -->
                <div class="cl-tabs-bar">
                    <button
                        type="button"
                        wire:click="switchTab('general')"
                        class="cl-tab-item {{ $activeTab === 'general' ? 'is-active' : '' }}"
                    >
                        Thông tin chung
                    </button>
                    <button
                        type="button"
                        wire:click="switchTab('scenarios')"
                        class="cl-tab-item {{ $activeTab === 'scenarios' ? 'is-active' : '' }}"
                    >
                        Kịch bản trả lời
                    </button>
                    <button
                        type="button"
                        wire:click="switchTab('data_integration')"
                        class="cl-tab-item {{ $activeTab === 'data_integration' ? 'is-active' : '' }}"
                    >
                        Tích hợp dữ liệu
                    </button>
                    <button
                        type="button"
                        wire:click="switchTab('advanced')"
                        class="cl-tab-item {{ $activeTab === 'advanced' ? 'is-active' : '' }}"
                    >
                        Nâng cao
                    </button>
                </div>

                <!-- Tab 1: Thông tin chung -->
                @if($activeTab === 'general')
                    <div class="cl-tab-content">
                        <!-- Tên AI Bot -->
                        <div class="cl-form-group">
                            <label class="cl-field-label">Tên AI Bot</label>
                            <div class="cl-input-container">
                                <input
                                    type="text"
                                    wire:model="bot_name"
                                    maxlength="50"
                                    class="cl-text-field"
                                />
                                <span class="cl-counter-text">{{ mb_strlen($bot_name) }}/50</span>
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div class="cl-form-group">
                            <label class="cl-field-label">Mô tả</label>
                            <div class="cl-textarea-container">
                                <textarea
                                    wire:model="bot_description"
                                    rows="3"
                                    maxlength="200"
                                    class="cl-textarea-field"
                                ></textarea>
                                <span class="cl-counter-text-bottom">{{ mb_strlen($bot_description) }}/200</span>
                            </div>
                        </div>

                        <!-- Ngôn ngữ -->
                        <div class="cl-form-group">
                            <label class="cl-field-label">Ngôn ngữ</label>
                            <div class="cl-select-container">
                                <select wire:model="bot_language" class="cl-select-field">
                                    <option value="vi">Tiếng Việt</option>
                                    <option value="en">English (Tiếng Anh)</option>
                                </select>
                                <svg class="cl-select-chevron" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <!-- 4 Feature Toggles Cards -->
                        <div class="cl-features-grid">
                            <!-- Feature 1: Tư vấn dự án -->
                            <div class="cl-feature-box">
                                <div class="cl-fbox-top">
                                    <div class="cl-fbox-icon">
                                        <svg viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 1v10h8V5H6z" />
                                        </svg>
                                    </div>
                                    <button
                                        type="button"
                                        wire:click="$toggle('feature_project_consulting')"
                                        class="cl-mini-switch {{ $feature_project_consulting ? 'is-active' : '' }}"
                                        aria-label="Tư vấn dự án"
                                    >
                                        <span class="cl-mini-knob"></span>
                                    </button>
                                </div>
                                <div class="cl-fbox-bottom">
                                    <div class="cl-fbox-title">Tư vấn dự án</div>
                                    <div class="cl-fbox-desc">Trả lời thông tin về các dự án, giải pháp</div>
                                </div>
                            </div>

                            <!-- Feature 2: Báo giá dịch vụ -->
                            <div class="cl-feature-box">
                                <div class="cl-fbox-top">
                                    <div class="cl-fbox-icon">
                                        <svg viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <button
                                        type="button"
                                        wire:click="$toggle('feature_price_quote')"
                                        class="cl-mini-switch {{ $feature_price_quote ? 'is-active' : '' }}"
                                        aria-label="Báo giá dịch vụ"
                                    >
                                        <span class="cl-mini-knob"></span>
                                    </button>
                                </div>
                                <div class="cl-fbox-bottom">
                                    <div class="cl-fbox-title">Báo giá dịch vụ</div>
                                    <div class="cl-fbox-desc">Giải đáp chi phí, báo giá nhanh</div>
                                </div>
                            </div>

                            <!-- Feature 3: Hỗ trợ kỹ thuật -->
                            <div class="cl-feature-box">
                                <div class="cl-fbox-top">
                                    <div class="cl-fbox-icon">
                                        <svg viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <button
                                        type="button"
                                        wire:click="$toggle('feature_tech_support')"
                                        class="cl-mini-switch {{ $feature_tech_support ? 'is-active' : '' }}"
                                        aria-label="Hỗ trợ kỹ thuật"
                                    >
                                        <span class="cl-mini-knob"></span>
                                    </button>
                                </div>
                                <div class="cl-fbox-bottom">
                                    <div class="cl-fbox-title">Hỗ trợ kỹ thuật</div>
                                    <div class="cl-fbox-desc">Hướng dẫn sử dụng, xử lý sự cố</div>
                                </div>
                            </div>

                            <!-- Feature 4: CSKH -->
                            <div class="cl-feature-box">
                                <div class="cl-fbox-top">
                                    <div class="cl-fbox-icon">
                                        <svg viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                        </svg>
                                    </div>
                                    <button
                                        type="button"
                                        wire:click="$toggle('feature_customer_care')"
                                        class="cl-mini-switch {{ $feature_customer_care ? 'is-active' : '' }}"
                                        aria-label="CSKH"
                                    >
                                        <span class="cl-mini-knob"></span>
                                    </button>
                                </div>
                                <div class="cl-fbox-bottom">
                                    <div class="cl-fbox-title">CSKH</div>
                                    <div class="cl-fbox-desc">Chăm sóc sau bán hàng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($activeTab === 'scenarios')
                    <!-- Tab 2: Kịch bản trả lời -->
                    <div class="cl-tab-content space-y-4">
                        <div class="cl-form-group">
                            <label class="cl-field-label">Thông báo chuyển giao tư vấn viên</label>
                            <textarea wire:model="handoff_notice" rows="2" class="cl-textarea-field"></textarea>
                        </div>
                        <div class="cl-form-group">
                            <label class="cl-field-label">Thông báo khi hệ thống AI bận / Timeout</label>
                            <textarea wire:model="fallback_notice" rows="2" class="cl-textarea-field"></textarea>
                        </div>
                        <div class="cl-form-group">
                            <label class="cl-field-label">Từ khóa bàn giao nhân viên (Mỗi từ 1 dòng)</label>
                            <textarea wire:model="handoff_keywords_text" rows="3" class="cl-textarea-field font-mono"></textarea>
                        </div>
                    </div>
                @elseif($activeTab === 'data_integration')
                    <!-- Tab 3: Tích hợp dữ liệu -->
                    <div class="cl-tab-content space-y-4">
                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg text-xs text-blue-800 leading-relaxed">
                            <strong>Cơ sở dữ liệu tri thức (Knowledge Base):</strong> AI Bot được kết nối với danh mục bài viết dịch vụ, bảng giá chính sách và hồ sơ năng lực của Truyền Thông Cửu Long để phản hồi chính xác thông tin.
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs">
                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <span class="text-gray-500 block">Dữ liệu bài viết dịch vụ:</span>
                                <span class="font-bold text-gray-800">Đã đồng bộ (24 bài)</span>
                            </div>
                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <span class="text-gray-500 block">Dữ liệu bảng giá:</span>
                                <span class="font-bold text-gray-800">Đã đồng bộ (6 gói dịch vụ)</span>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Tab 4: Nâng cao -->
                    <div class="cl-tab-content space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="cl-form-group">
                                <label class="cl-field-label">Nhà cung cấp AI (Provider)</label>
                                <select wire:model="provider" class="cl-select-field">
                                    <option value="openai">OpenAI (GPT-4o / GPT-4o-mini)</option>
                                    <option value="gemini">Google Gemini (1.5 Flash)</option>
                                    <option value="none">none — Tắt nhà cung cấp</option>
                                </select>
                            </div>
                            <div class="cl-form-group">
                                <label class="cl-field-label">Kênh phân bổ mặc định</label>
                                <select wire:model="default_channel" class="cl-select-field">
                                    <option value="hybrid">hybrid — Hỗn hợp</option>
                                    <option value="ai">ai — Ưu tiên AI</option>
                                    <option value="human">human — Nhân viên tư vấn</option>
                                </select>
                            </div>
                        </div>

                        <div class="cl-form-group">
                            <label class="cl-field-label">Giới hạn phản hồi (tin / phút)</label>
                            <input type="number" min="1" max="60" wire:model="max_ai_replies_per_minute" class="cl-text-field" />
                            @error('max_ai_replies_per_minute') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Status API Keys -->
                        <div class="grid grid-cols-2 gap-4 text-xs pt-2">
                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <span class="text-gray-500 block">OpenAI API Key:</span>
                                @if(!empty(config('chat_ai.openai.api_key')))
                                    <span class="font-semibold text-emerald-600">● Đã cấu hình</span>
                                @else
                                    <span class="font-semibold text-amber-600">● Chưa có Key</span>
                                @endif
                            </div>
                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <span class="text-gray-500 block">Gemini API Key:</span>
                                @if(!empty(config('chat_ai.gemini.api_key')))
                                    <span class="font-semibold text-emerald-600">● Đã cấu hình</span>
                                @else
                                    <span class="font-semibold text-amber-600">● Chưa có Key</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Bottom Banner: Thống kê và Nhật ký hoạt động -->
            <div class="cl-activity-banner" wire:click="switchTab('advanced')">
                <div class="cl-act-left">
                    <div class="cl-act-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <div class="cl-act-title">Thống kê và Nhật ký hoạt động</div>
                        <div class="cl-act-desc">Xem chi tiết các tương tác và hiệu suất của AI Bot trong thời gian gần đây.</div>
                    </div>
                </div>
                <div class="cl-act-arrow">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Right Column: Thử nghiệm AI Bot (approx 38%) -->
        <div class="cl-test-card">
            <!-- Card Header -->
            <div class="cl-test-header">
                <div class="cl-test-title">
                    <svg class="cl-test-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                    </svg>
                    <span>Thử nghiệm AI Bot</span>
                </div>

                <button
                    type="button"
                    wire:click="clearTestHistory"
                    class="cl-btn-clear"
                    title="Xóa cuộc hội thoại mẫu"
                >
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Xóa lịch sử</span>
                </button>
            </div>

            <!-- Chat Messages Body -->
            <div class="cl-chat-body" id="cl-chat-scroll">
                @foreach($testMessages as $msg)
                    @if(($msg['sender'] ?? '') === 'bot')
                        <!-- Bot Message -->
                        <div class="cl-chat-msg-row bot-row">
                            <div class="cl-bot-msg-avatar">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                                    <circle cx="12" cy="5" r="2"></circle>
                                    <path d="M12 7v4"></path>
                                    <line x1="8" y1="16" x2="8" y2="16"></line>
                                    <line x1="16" y1="16" x2="16" y2="16"></line>
                                </svg>
                            </div>
                            <div class="cl-bubble-wrap">
                                <div class="cl-bot-bubble">
                                    {!! nl2br(e($msg['text'] ?? '')) !!}
                                </div>
                                <div class="cl-msg-time">{{ $msg['time'] ?? '14:32' }}</div>
                            </div>
                        </div>
                    @else
                        <!-- User Message -->
                        <div class="cl-chat-msg-row user-row">
                            <div class="cl-bubble-wrap user-bubble-wrap">
                                <div class="cl-user-bubble">
                                    {{ $msg['text'] ?? '' }}
                                </div>
                                <div class="cl-msg-time">{{ $msg['time'] ?? '14:33' }}</div>
                            </div>
                            <div class="cl-user-msg-avatar">
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Chat Input Footer -->
            <div class="cl-chat-footer">
                <form wire:submit.prevent="sendTestMessage" class="cl-chat-form">
                    <input
                        type="text"
                        wire:model="testInput"
                        placeholder="Nhập câu hỏi của bạn..."
                        class="cl-chat-input"
                    />
                    <button type="submit" class="cl-chat-send-btn" aria-label="Gửi tin nhắn">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Reset Filament Wrappers */
.fi-page-header, .fi-header {
    display: none !important;
}

.cl-ai-page-wrap {
    background-color: #f8fafc;
    margin: -1.5rem -1.5rem !important;
    padding: 1.5rem 1.75rem 3rem 1.75rem !important;
    min-height: 100vh;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #1e293b;
    box-sizing: border-box;
}

@media (min-width: 1024px) {
    .cl-ai-page-wrap {
        margin: -2rem -2rem !important;
        padding: 1.75rem 2rem 3.5rem 2rem !important;
    }
}

/* Header & Breadcrumb */
.cl-ai-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    gap: 1.25rem;
    margin-bottom: 1.25rem;
}

.cl-ai-header-left {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.cl-ai-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 13px;
    color: #2563eb;
    font-weight: 500;
}

.cl-home-icon {
    width: 14px;
    height: 14px;
    color: #2563eb;
}

.cl-crumb-sep {
    color: #94a3b8;
    font-size: 13px;
}

.cl-crumb-active {
    color: #64748b;
    font-weight: 400;
}

.cl-ai-title-row {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    margin-top: 2px;
}

.cl-robot-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background-color: #e0f2fe;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0284c7;
    flex-shrink: 0;
}

.cl-robot-svg {
    width: 24px;
    height: 24px;
}

.cl-ai-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.01em;
}

.cl-ai-subtitle {
    font-size: 13px;
    color: #64748b;
    margin: 3px 0 0 0;
    line-height: 1.4;
}

/* Header Right: Master Toggle & Save Button */
.cl-ai-header-right {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.cl-master-toggle-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cl-master-switch {
    width: 44px;
    height: 24px;
    background-color: #cbd5e1;
    border-radius: 9999px;
    border: none;
    position: relative;
    cursor: pointer;
    transition: background-color 0.2s ease;
    padding: 2px;
}

.cl-master-switch.is-active {
    background-color: #2563eb;
}

.cl-master-knob {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    background-color: #ffffff;
    border-radius: 50%;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

.cl-master-switch.is-active .cl-master-knob {
    transform: translateX(20px);
}

.cl-toggle-text-block {
    display: flex;
    flex-direction: column;
}

.cl-toggle-title {
    font-size: 13px;
    font-weight: 600;
    color: #0f172a;
}

.cl-toggle-desc {
    font-size: 11px;
    color: #64748b;
}

.cl-btn-save {
    height: 40px;
    background-color: #ff5400;
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    padding: 0 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(255, 84, 0, 0.25);
    transition: all 0.15s ease;
    white-space: nowrap;
}

.cl-btn-save:hover {
    background-color: #e64a00;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(255, 84, 0, 0.3);
}

.cl-btn-save:active {
    transform: translateY(0);
}

/* Metrics Row (4 cards) */
.cl-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.25rem;
}

@media (max-width: 1024px) {
    .cl-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .cl-stats-grid {
        grid-template-columns: 1fr;
    }
}

.cl-stat-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 18px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

.cl-stat-icon-wrap {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #e0f2fe;
    color: #0284c7;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-stat-icon-wrap svg {
    width: 20px;
    height: 20px;
}

.cl-stat-info {
    display: flex;
    flex-direction: column;
}

.cl-stat-label {
    font-size: 12px;
    color: #64748b;
    font-weight: 500;
}

.cl-stat-num-row {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-top: 4px;
}

.cl-stat-value {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
}

.cl-stat-trend {
    font-size: 11.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.trend-up {
    color: #16a34a;
}

.trend-down {
    color: #16a34a; /* In response time, down is good! */
}

.cl-stat-sub {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 3px;
}

/* Main 2-Column Layout */
.cl-main-ai-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.45fr) minmax(360px, 1fr);
    gap: 1.25rem;
    align-items: start;
}

@media (max-width: 1200px) {
    .cl-main-ai-grid {
        grid-template-columns: 1fr;
    }
}

.cl-left-stack {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Configuration Card */
.cl-config-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px 22px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

.cl-config-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.cl-config-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
}

.cl-gear-icon {
    width: 18px;
    height: 18px;
    color: #0284c7;
}

/* Tabs Bar */
.cl-tabs-bar {
    display: flex;
    align-items: center;
    gap: 24px;
    border-bottom: 1px solid #e2e8f0;
    margin-bottom: 20px;
    overflow-x: auto;
}

.cl-tab-item {
    background: transparent;
    border: none;
    padding: 8px 2px 10px 2px;
    font-size: 13px;
    font-weight: 500;
    color: #64748b;
    cursor: pointer;
    position: relative;
    white-space: nowrap;
    transition: color 0.15s ease;
}

.cl-tab-item:hover {
    color: #0f172a;
}

.cl-tab-item.is-active {
    color: #ff5400;
    font-weight: 600;
}

.cl-tab-item.is-active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #ff5400;
    border-radius: 2px;
}

/* Form Groups in Tab */
.cl-tab-content {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.cl-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cl-field-label {
    font-size: 12.5px;
    font-weight: 600;
    color: #334155;
}

.cl-input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.cl-text-field {
    width: 100%;
    height: 40px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 54px 0 12px;
    font-size: 13px;
    color: #1e293b;
    outline: none;
    transition: all 0.2s ease;
}

.cl-text-field:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

.cl-counter-text {
    position: absolute;
    right: 12px;
    font-size: 11.5px;
    color: #94a3b8;
    pointer-events: none;
}

.cl-textarea-container {
    position: relative;
    display: flex;
    flex-direction: column;
}

.cl-textarea-field {
    width: 100%;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 12px 24px 12px;
    font-size: 13px;
    color: #1e293b;
    outline: none;
    resize: vertical;
    transition: all 0.2s ease;
    font-family: inherit;
    line-height: 1.45;
}

.cl-textarea-field:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

.cl-counter-text-bottom {
    position: absolute;
    bottom: 8px;
    right: 12px;
    font-size: 11px;
    color: #94a3b8;
    pointer-events: none;
}

.cl-select-container {
    position: relative;
    display: flex;
    align-items: center;
}

.cl-select-field {
    width: 100%;
    height: 40px;
    background: #ffffff !important;
    background-image: none !important;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 34px 0 12px;
    font-size: 13px;
    color: #1e293b;
    outline: none;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cl-select-field:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

.cl-select-chevron {
    position: absolute;
    right: 12px;
    width: 16px;
    height: 16px;
    color: #64748b;
    pointer-events: none;
}

/* Features Grid (4 boxes) */
.cl-features-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-top: 6px;
}

@media (max-width: 900px) {
    .cl-features-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.cl-feature-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 13px 12px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 108px;
}

.cl-fbox-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}

.cl-fbox-icon {
    width: 26px;
    height: 26px;
    border-radius: 6px;
    background: #e0f2fe;
    color: #0284c7;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cl-fbox-icon svg {
    width: 15px;
    height: 15px;
}

.cl-mini-switch {
    width: 34px;
    height: 20px;
    background-color: #cbd5e1;
    border-radius: 9999px;
    border: none;
    position: relative;
    cursor: pointer;
    transition: background-color 0.2s ease;
    padding: 2px;
}

.cl-mini-switch.is-active {
    background-color: #2563eb;
}

.cl-mini-knob {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 16px;
    height: 16px;
    background-color: #ffffff;
    border-radius: 50%;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.cl-mini-switch.is-active .cl-mini-knob {
    transform: translateX(14px);
}

.cl-fbox-bottom {
    display: flex;
    flex-direction: column;
}

.cl-fbox-title {
    font-size: 12.5px;
    font-weight: 600;
    color: #0f172a;
    line-height: 1.3;
}

.cl-fbox-desc {
    font-size: 11px;
    color: #64748b;
    margin-top: 2px;
    line-height: 1.3;
}

/* Activity Banner */
.cl-activity-banner {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    transition: all 0.15s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

.cl-activity-banner:hover {
    border-color: #cbd5e1;
    background-color: #f8fafc;
}

.cl-act-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.cl-act-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #e0f2fe;
    color: #0284c7;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cl-act-icon svg {
    width: 18px;
    height: 18px;
}

.cl-act-title {
    font-size: 13.5px;
    font-weight: 700;
    color: #0f172a;
}

.cl-act-desc {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
}

.cl-act-arrow {
    color: #2563eb;
    display: flex;
    align-items: center;
}

.cl-act-arrow svg {
    width: 20px;
    height: 20px;
}

/* Right Column: Thử nghiệm AI Bot */
.cl-test-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    height: 580px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    overflow: hidden;
}

.cl-test-header {
    padding: 14px 18px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
}

.cl-test-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
}

.cl-test-icon {
    width: 18px;
    height: 18px;
    color: #0284c7;
}

.cl-btn-clear {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 11px;
    color: #64748b;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.15s ease;
}

.cl-btn-clear svg {
    width: 13px;
    height: 13px;
}

.cl-btn-clear:hover {
    color: #dc2626;
    border-color: #fca5a5;
    background: #fef2f2;
}

/* Chat Body */
.cl-chat-body {
    flex: 1;
    padding: 16px 18px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
    background: #fafafa;
}

.cl-chat-msg-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.cl-chat-msg-row.bot-row {
    justify-content: flex-start;
}

.cl-chat-msg-row.user-row {
    justify-content: flex-end;
}

.cl-bot-msg-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #e0f2fe;
    color: #0284c7;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

.cl-bot-msg-avatar svg {
    width: 16px;
    height: 16px;
}

.cl-user-msg-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #2563eb;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

.cl-user-msg-avatar svg {
    width: 16px;
    height: 16px;
}

.cl-bubble-wrap {
    display: flex;
    flex-direction: column;
    max-width: 82%;
}

.cl-bubble-wrap.user-bubble-wrap {
    align-items: flex-end;
}

.cl-bot-bubble {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 10px 14px;
    font-size: 12px;
    color: #1e293b;
    line-height: 1.45;
    word-break: break-word;
}

.cl-user-bubble {
    background-color: #2563eb;
    color: #ffffff;
    border-radius: 12px;
    padding: 10px 14px;
    font-size: 12px;
    line-height: 1.45;
    word-break: break-word;
}

.cl-msg-time {
    font-size: 10.5px;
    color: #94a3b8;
    margin-top: 3px;
    padding: 0 4px;
}

/* Chat Footer / Input */
.cl-chat-footer {
    padding: 12px 16px;
    border-top: 1px solid #f1f5f9;
    background: #ffffff;
}

.cl-chat-form {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.cl-chat-input {
    flex: 1;
    height: 40px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 0 14px;
    font-size: 13px;
    color: #1e293b;
    outline: none;
    transition: all 0.15s ease;
}

.cl-chat-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

.cl-chat-send-btn {
    width: 40px;
    height: 40px;
    background-color: #2563eb;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s ease;
    flex-shrink: 0;
}

.cl-chat-send-btn svg {
    width: 17px;
    height: 17px;
}

.cl-chat-send-btn:hover {
    background-color: #1d4ed8;
}
</style>
</x-filament-panels::page>
