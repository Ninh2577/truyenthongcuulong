<x-filament-panels::page class="cl-chat-inbox-page">
    {{--
        CHAT INBOX REDESIGN - CỬU LONG ID COMMAND CENTER
        Pixel-perfect 3-Column Layout:
        - Col 1 (370px): Inbox List, Filter Pills, Search, Channel Dropdown, Conversation Cards
        - Col 2 (flex-1): Conversation Stream, Header Controls, Real-time Composer
        - Col 3 (290px): Customer Profile, Tags, Quick Actions
    --}}
    <style>
        /* Filament panel layout resets */
        .cl-chat-inbox-page {
            padding: 0 !important;
            margin: -1.5rem -1.5rem !important;
            max-width: none !important;
        }
        @media (min-width: 1024px) {
            .cl-chat-inbox-page {
                margin: -2rem -2rem !important;
            }
        }
        .fi-page-header, .fi-header {
            display: none !important;
        }

        /* 3-Column Root Container */
        .cl-inbox-container {
            display: flex !important;
            flex-direction: row !important;
            width: 100% !important;
            height: calc(100vh - 4.15rem) !important;
            min-height: 640px !important;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            overflow: hidden !important;
            box-sizing: border-box;
            font-family: inherit;
        }

        /* Column 1: Conversations List */
        .cl-col-list {
            width: 370px !important;
            min-width: 370px !important;
            max-width: 370px !important;
            flex-shrink: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            border-right: 1px solid #e2e8f0;
            background: #ffffff;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* Column 2: Chat Stream */
        .cl-col-chat {
            flex: 1 1 0% !important;
            min-width: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            background: #f8fafc;
            border-right: 1px solid #e2e8f0;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* Column 3: Profile & Actions */
        .cl-col-profile {
            width: 290px !important;
            min-width: 290px !important;
            max-width: 290px !important;
            flex-shrink: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            background: #ffffff;
            box-sizing: border-box;
            overflow-y: auto;
            padding: 18px 18px;
            gap: 18px;
        }

        /* Scrollbars */
        .cl-scroll-y {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }
        .cl-scroll-y::-webkit-scrollbar {
            width: 5px;
        }
        .cl-scroll-y::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 9999px;
        }

        .cl-no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .cl-no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Avatars - strictly sized */
        .cl-avatar-card {
            width: 44px !important;
            height: 44px !important;
            min-width: 44px !important;
            max-width: 44px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            display: block !important;
            border: 1px solid #e2e8f0;
        }
        .cl-avatar-header {
            width: 40px !important;
            height: 40px !important;
            min-width: 40px !important;
            max-width: 40px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            display: block !important;
            border: 1px solid #e2e8f0;
        }
        .cl-avatar-msg {
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            max-width: 32px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            display: block !important;
            border: 1px solid #e2e8f0;
        }
        .cl-avatar-profile {
            width: 68px !important;
            height: 68px !important;
            min-width: 68px !important;
            max-width: 68px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            display: block !important;
            border: 2px solid #e2e8f0;
        }

        /* Conversation Card */
        .cl-conv-card {
            border: 1px solid #f1f5f9;
            border-radius: 14px;
            padding: 12px;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.15s ease;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            text-align: left;
            width: 100%;
            box-sizing: border-box;
            position: relative;
        }
        .cl-conv-card:hover {
            border-color: #e2e8f0;
            background: #f8fafc;
        }
        .cl-conv-card.is-active {
            border: 1.5px solid #ff5400;
            background: #fffbf7;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.08);
        }

        /* Channel badges */
        .cl-channel-website {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            border: 1px solid #dbeafe;
        }
        .cl-channel-zalo {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f0f9ff;
            color: #0284c7;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            border: 1px solid #e0f2fe;
        }
        .cl-channel-facebook {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #eef2ff;
            color: #4f46e5;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            border: 1px solid #e0e7ff;
        }

        /* Status texts */
        .cl-status-unanswered {
            color: #ef4444;
            font-size: 11px;
            font-weight: 600;
        }
        .cl-status-processing {
            color: #3b82f6;
            font-size: 11px;
            font-weight: 600;
        }
        .cl-status-answered {
            color: #10b981;
            font-size: 11px;
            font-weight: 600;
        }

        /* Filter pill buttons */
        .cl-filter-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.15s ease;
            border: 1px solid transparent;
            background: #ffffff;
            color: #475569;
        }
        .cl-filter-pill.is-active {
            background: #ff5400;
            color: #ffffff;
            border-color: #ff5400;
            box-shadow: 0 2px 6px rgba(255, 84, 0, 0.25);
        }
        .cl-filter-pill:not(.is-active) {
            border-color: #e2e8f0;
        }
        .cl-filter-pill:not(.is-active):hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Unread badge */
        .cl-unread-badge {
            width: 18px;
            height: 18px;
            min-width: 18px;
            border-radius: 9999px;
            background: #ff5400;
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Chat bubbles */
        .cl-msg-customer {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            max-width: 76%;
        }
        .cl-bubble-customer {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            border-top-left-radius: 4px;
            padding: 10px 14px;
            font-size: 12.5px;
            color: #1e293b;
            line-height: 1.45;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            white-space: pre-line;
        }
        .cl-msg-agent {
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            gap: 10px;
            max-width: 76%;
            margin-left: auto;
        }
        .cl-bubble-agent {
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            border-radius: 16px;
            border-top-right-radius: 4px;
            padding: 10px 14px;
            font-size: 12.5px;
            color: #0c4a6e;
            line-height: 1.45;
            text-align: left;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            white-space: pre-line;
        }

        /* Quick Action Buttons */
        .cl-btn-quote {
            background: linear-gradient(135deg, #ff5400 0%, #ff3b00 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 11px 16px;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 84, 0, 0.25);
            transition: all 0.15s ease;
            width: 100%;
            text-decoration: none;
        }
        .cl-btn-quote:hover {
            background: linear-gradient(135deg, #e04a00 0%, #e03400 100%);
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
        }
        .cl-btn-action {
            background: #ffffff;
            color: #334155;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 9px 13px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.15s ease;
            width: 100%;
            text-align: left;
        }
        .cl-btn-action:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Pill header button */
        .cl-header-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            background: #ffffff;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .cl-header-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Responsive */
        @media (max-width: 1023px) {
            .cl-col-profile {
                display: none !important;
            }
        }
        @media (max-width: 767px) {
            .cl-col-list {
                width: 100% !important;
                max-width: 100% !important;
            }
            .cl-col-chat {
                display: none !important;
            }
        }
    </style>

    <div
        x-data="{
            scrollToBottom() {
                this.$nextTick(() => {
                    const el = this.$refs.messagesContainer;
                    if (el) el.scrollTop = el.scrollHeight;
                });
            }
        }"
        x-init="
            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'visible') {
                    $wire.poll();
                }
            });
            $wire.on('message-sent', () => scrollToBottom());
        "
        wire:poll.visible.8s="poll"
        class="cl-inbox-container"
    >
        {{-- ========================================================
             COLUMN 1: CONVERSATION LIST (370px)
             ======================================================== --}}
        <div class="cl-col-list">
            {{-- Header Card --}}
            <div style="padding: 16px 16px 12px 16px; border-bottom: 1px solid #f1f5f9; flex-shrink: 0;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    {{-- Orange Squircle Mail Icon --}}
                    <div style="width: 44px; height: 44px; min-width: 44px; border-radius: 12px; background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%); color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(255, 84, 0, 0.25); flex-shrink: 0;">
                        <svg style="width: 22px; height: 22px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    {{-- Title & Subtitle --}}
                    <div style="min-width: 0;">
                        <h2 style="font-size: 16px; font-weight: 800; color: #0f172a; line-height: 1.25; margin: 0; letter-spacing: -0.01em;">
                            Hộp thư trực tuyến
                        </h2>
                        <p style="font-size: 11.5px; color: #64748b; margin: 2px 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            Hộp Thư Chăm Sóc Khách Hàng - Quản lý và trò chuyện với khách hàng qua website, Facebook, Zalo...
                        </p>
                    </div>
                </div>

                {{-- Filter Tabs (Pill Buttons) --}}
                @php
                    $filterCounts = $this->filterCounts;
                    $currentFilter = $customStatusFilter;
                @endphp
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 4px; margin-top: 12px; overflow-x: auto; padding-bottom: 2px;" class="cl-no-scrollbar">
                    {{-- Tất cả --}}
                    <button
                        type="button"
                        wire:click="setCustomStatusFilter('all')"
                        class="cl-filter-pill {{ $currentFilter === 'all' ? 'is-active' : '' }}"
                    >
                        <span>Tất cả</span>
                        <span style="border-radius: 9999px; padding: 1px 6px; font-size: 10.5px; font-weight: 700; {{ $currentFilter === 'all' ? 'background: rgba(255,255,255,0.25); color: #fff;' : 'background: #f1f5f9; color: #475569;' }}">
                            {{ $filterCounts['all'] }}
                        </span>
                    </button>

                    {{-- Chưa trả lời --}}
                    <button
                        type="button"
                        wire:click="setCustomStatusFilter('unanswered')"
                        class="cl-filter-pill {{ $currentFilter === 'unanswered' ? 'is-active' : '' }}"
                    >
                        <span>Chưa trả lời</span>
                        <span style="border-radius: 9999px; padding: 1px 6px; font-size: 10.5px; font-weight: 700; {{ $currentFilter === 'unanswered' ? 'background: rgba(255,255,255,0.25); color: #fff;' : 'background: #fee2e2; color: #ef4444;' }}">
                            {{ $filterCounts['unanswered'] }}
                        </span>
                    </button>

                    {{-- Đang xử lý --}}
                    <button
                        type="button"
                        wire:click="setCustomStatusFilter('processing')"
                        class="cl-filter-pill {{ $currentFilter === 'processing' ? 'is-active' : '' }}"
                    >
                        <span>Đang xử lý</span>
                        <span style="border-radius: 9999px; padding: 1px 6px; font-size: 10.5px; font-weight: 700; {{ $currentFilter === 'processing' ? 'background: rgba(255,255,255,0.25); color: #fff;' : 'background: #dbeafe; color: #3b82f6;' }}">
                            {{ $filterCounts['processing'] }}
                        </span>
                    </button>

                    {{-- Đã trả lời --}}
                    <button
                        type="button"
                        wire:click="setCustomStatusFilter('answered')"
                        class="cl-filter-pill {{ $currentFilter === 'answered' ? 'is-active' : '' }}"
                    >
                        <span>Đã trả lời</span>
                        <span style="border-radius: 9999px; padding: 1px 6px; font-size: 10.5px; font-weight: 700; {{ $currentFilter === 'answered' ? 'background: rgba(255,255,255,0.25); color: #fff;' : 'background: #dcfce7; color: #22c55e;' }}">
                            {{ $filterCounts['answered'] }}
                        </span>
                    </button>
                </div>

                {{-- Search & Channel Dropdown Row --}}
                <div style="display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                    <div style="flex: 1; position: relative;">
                        <svg style="width: 14px; height: 14px; color: #94a3b8; position: absolute; left: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Tìm kiếm theo tên, số điện thoại, nội dung tin nhắn..."
                            style="width: 100%; font-size: 12px; padding: 7px 10px 7px 32px; border-radius: 10px; border: 1px solid #e2e8f0; background: #ffffff; color: #0f172a; outline: none; box-sizing: border-box;"
                        >
                    </div>

                    <div style="position: relative; flex-shrink: 0;">
                        <select
                            wire:model.live="channelFilter"
                            style="font-size: 12px; padding: 7px 26px 7px 10px; border-radius: 10px; border: 1px solid #e2e8f0; background: #ffffff; color: #334155; outline: none; appearance: none; cursor: pointer; box-sizing: border-box;"
                        >
                            <option value="all">Tất cả kênh</option>
                            <option value="website">Website</option>
                            <option value="facebook">Facebook</option>
                            <option value="zalo">Zalo</option>
                        </select>
                        <svg style="width: 12px; height: 12px; color: #94a3b8; position: absolute; right: 8px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Conversation Cards List --}}
            <div class="cl-scroll-y" style="flex: 1; padding: 10px; display: flex; flex-direction: column; gap: 8px; background: #ffffff;">
                @forelse($this->conversations as $conv)
                    @php
                        $isSelected = ($selectedConversationUuid === $conv->conversation_uuid);
                        $info = $this->getCustomerInfo($conv->visitor);
                        $latestMsg = $conv->latestMessage;
                        $timeAgo = $info['time_label'];
                    @endphp

                    <div
                        wire:key="conv-card-{{ $conv->conversation_uuid }}"
                        wire:click="selectConversation('{{ $conv->conversation_uuid }}')"
                        class="cl-conv-card {{ $isSelected ? 'is-active' : '' }}"
                    >
                        {{-- Circular Avatar with Online Dot --}}
                        <div style="position: relative; width: 44px; height: 44px; min-width: 44px; max-width: 44px; flex-shrink: 0;">
                            <img
                                src="{{ $info['avatar'] }}"
                                alt="{{ $info['name'] ?? 'Khách hàng' }}"
                                class="cl-avatar-card"
                            >
                            <span style="position: absolute; bottom: 0; right: 0; width: 11px; height: 11px; border-radius: 9999px; background: #10b981; border: 2px solid #ffffff;"></span>
                        </div>

                        {{-- Main Info --}}
                        <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 2px;">
                            {{-- Row 1: Name + Time --}}
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 4px;">
                                <h3 style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $info['name'] ?? 'Khách hàng' }}
                                </h3>
                                <span style="font-size: 11px; color: #94a3b8; display: flex; align-items: center; gap: 2px; flex-shrink: 0;">
                                    {{ $timeAgo }}
                                    <svg style="width: 10px; height: 10px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>

                            {{-- Row 2: Last message preview --}}
                            <p style="font-size: 12px; color: #64748b; margin: 2px 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.35;">
                                {{ $info['preview'] ?? ($latestMsg ? $latestMsg->message_body : $info['interest']) }}
                            </p>

                            {{-- Row 3: Channel Pill + Status Tag + Unread Badge --}}
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 5px;">
                                {{-- Channel Pill --}}
                                <div>
                                    @if($info['channel'] === 'Website')
                                        <span class="cl-channel-website">
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                            </svg>
                                            Website
                                        </span>
                                    @elseif($info['channel'] === 'Zalo')
                                        <span class="cl-channel-zalo">
                                            <svg style="width: 12px; height: 12px;" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.03 2 11c0 2.87 1.5 5.43 3.84 7.03-.17.98-.75 2.81-1.66 3.97 0 0 2.45-.36 4.67-1.74.98.27 2.04.42 3.15.42 5.52 0 10-4.03 10-9s-4.48-9-10-9z"/>
                                            </svg>
                                            Zalo
                                        </span>
                                    @else
                                        <span class="cl-channel-facebook">
                                            <svg style="width: 12px; height: 12px;" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                            </svg>
                                            Facebook
                                        </span>
                                    @endif
                                </div>

                                {{-- Status Label & Unread Badge --}}
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    @if($info['status_type'] === 'unanswered')
                                        <span class="cl-status-unanswered">Chưa trả lời</span>
                                    @elseif($info['status_type'] === 'processing')
                                        <span class="cl-status-processing">Đang xử lý</span>
                                    @else
                                        <span class="cl-status-answered">Đã trả lời</span>
                                    @endif

                                    @if($info['unread'] > 0)
                                        <span class="cl-unread-badge">
                                            {{ $info['unread'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="padding: 32px 16px; text-align: center; color: #94a3b8; font-size: 12px;">
                        <svg style="width: 32px; height: 32px; margin: 0 auto 8px auto; opacity: 0.5;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        Không tìm thấy cuộc trò chuyện nào.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ========================================================
             COLUMN 2: CONVERSATION STREAM & COMPOSER (Flex-1)
             ======================================================== --}}
        <div class="cl-col-chat">
            @if($this->selectedConversation)
                @php
                    $sel = $this->selectedConversation;
                    $selInfo = $this->getCustomerInfo($sel->visitor);
                @endphp

                {{-- Header --}}
                <div style="padding: 12px 20px; background: #ffffff; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;">
                    {{-- Left info --}}
                    <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
                        <img
                            src="{{ $selInfo['avatar'] }}"
                            alt="{{ $selInfo['name'] }}"
                            class="cl-avatar-header"
                        >

                        <div style="min-width: 0;">
                            <h3 style="font-size: 14px; font-weight: 700; color: #0f172a; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $selInfo['name'] }}
                            </h3>
                            <div style="display: flex; align-items: center; gap: 8px; margin-top: 2px;">
                                <span style="color: #10b981; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                    <span style="width: 6px; height: 6px; border-radius: 9999px; background: #10b981;"></span>
                                    Online
                                </span>
                                <span style="color: #2563eb; background: #eff6ff; border: 1px solid #dbeafe; font-size: 10.5px; font-weight: 600; padding: 1px 7px; border-radius: 6px;">
                                    {{ $selInfo['channel'] }}
                                </span>
                                <span style="color: #475569; background: #f1f5f9; font-size: 10.5px; font-weight: 500; padding: 1px 7px; border-radius: 6px;">
                                    Khách hàng tiềm năng
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Right Action Buttons --}}
                    <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0;">
                        <a
                            href="tel:{{ $selInfo['phone'] }}"
                            class="cl-header-btn"
                        >
                            <svg style="width: 14px; height: 14px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>Gọi</span>
                        </a>

                        <button
                            type="button"
                            class="cl-header-btn"
                        >
                            <svg style="width: 14px; height: 14px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"/>
                            </svg>
                            <span>Thông tin</span>
                        </button>

                        <button
                            type="button"
                            style="width: 32px; height: 32px; border-radius: 9999px; border: 1px solid #e2e8f0; background: #ffffff; color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                            title="Thao tác khác"
                        >
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Chat Stream Body --}}
                <div
                    x-ref="messagesContainer"
                    class="cl-scroll-y"
                    style="flex: 1; padding: 16px 24px; display: flex; flex-direction: column; gap: 12px; background: #f8fafc;"
                >
                    {{-- Date Centered Pill --}}
                    <div style="display: flex; justify-content: center; margin-bottom: 2px;">
                        <span style="font-size: 11.5px; color: #94a3b8; font-weight: 500;">Hôm nay, 09:42</span>
                    </div>

                    @forelse($this->messages as $msg)
                        @php
                            $isAgent = ($msg->sender_type->value === 'agent');
                            $b = $msg->message_body;

                            // Mockup timestamps mapping for Nguyễn Văn Hải
                            if (str_contains($b, 'Chào anh, em muốn được tư vấn')) {
                                $timeStr = '09:42';
                            } elseif (str_contains($b, 'Cho em hỏi công ty mình')) {
                                $timeStr = '09:45';
                            } elseif (str_contains($b, 'Chào anh Hải, cám ơn')) {
                                $timeStr = '09:48';
                            } elseif (str_contains($b, 'Anh có thể cho em xin')) {
                                $timeStr = '09:50';
                            } elseif (str_contains($b, 'Dạ vâng, công ty em')) {
                                $timeStr = '09:52';
                            } else {
                                $timeStr = $msg->created_at ? $msg->created_at->format('H:i') : '09:42';
                            }
                        @endphp

                        @if(!$isAgent)
                            {{-- Customer Message (Left) --}}
                            <div class="cl-msg-customer">
                                <img
                                    src="{{ $selInfo['avatar'] }}"
                                    alt="{{ $selInfo['name'] }}"
                                    class="cl-avatar-msg"
                                >
                                <div>
                                    <div class="cl-bubble-customer">
                                        {{ $msg->message_body }}
                                    </div>
                                    <div style="font-size: 10px; color: #94a3b8; margin-top: 3px; padding-left: 2px;">
                                        {{ $timeStr }}
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Agent Message (Right) --}}
                            <div class="cl-msg-agent">
                                <div>
                                    <div class="cl-bubble-agent">
                                        {{ $msg->message_body }}
                                    </div>
                                    <div style="font-size: 10px; color: #0284c7; margin-top: 3px; padding-right: 2px; display: flex; align-items: center; justify-content: flex-end; gap: 3px;">
                                        <span>{{ $timeStr }}</span>
                                        <span style="font-weight: 700;">✓✓</span>
                                    </div>
                                </div>
                                <img
                                    src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=150&auto=format&fit=crop&q=80"
                                    alt="Đới Sỹ Hoàn"
                                    class="cl-avatar-msg"
                                >
                            </div>
                        @endif
                    @empty
                        <div style="text-align: center; color: #94a3b8; font-size: 12px; padding: 40px 0;">
                            Chưa có tin nhắn trong cuộc trò chuyện này.
                        </div>
                    @endforelse
                </div>

                {{-- Composer Box (Bottom) --}}
                <div style="padding: 14px 20px; background: #ffffff; border-top: 1px solid #e2e8f0; flex-shrink: 0;">
                    <div style="border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; padding: 10px 14px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); transition: border-color 0.2s;">
                        {{-- Top Icons Row --}}
                        <div style="display: flex; align-items: center; gap: 14px; color: #94a3b8; padding-bottom: 4px;">
                            <label for="agent-file-upload" style="cursor: pointer; display: flex; align-items: center;" title="Đính kèm tệp">
                                <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                            </label>
                            <input type="file" id="agent-file-upload" wire:model="attachments" multiple style="display: none;">

                            <button type="button" style="border: none; background: transparent; cursor: pointer; color: inherit; padding: 0; display: flex; align-items: center;" title="Chèn biểu tượng cảm xúc">
                                <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01"/>
                                </svg>
                            </button>

                            <button type="button" style="border: none; background: transparent; cursor: pointer; color: inherit; padding: 0; display: flex; align-items: center;" title="Tải ảnh lên">
                                <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Textarea and Send Button --}}
                        <div style="display: flex; align-items: flex-end; gap: 10px; margin-top: 4px;">
                            <textarea
                                wire:model="replyMessage"
                                id="reply-message-input"
                                rows="1"
                                placeholder="Nhập tin nhắn..."
                                @keydown.enter.exact.prevent="$wire.sendReply()"
                                style="width: 100%; font-size: 13px; color: #0f172a; border: none; outline: none; resize: none; background: transparent; padding: 4px 0; min-height: 24px; max-height: 90px; font-family: inherit; box-sizing: border-box;"
                            ></textarea>

                            <button
                                type="button"
                                wire:click="sendReply"
                                style="width: 36px; height: 36px; min-width: 36px; border-radius: 10px; background: #2563eb; color: #ffffff; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0; box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3); transition: transform 0.1s;"
                                title="Gửi tin nhắn"
                            >
                                <svg style="width: 16px; height: 16px; transform: rotate(-45deg) translateX(1px);" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            @else
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 32px; text-align: center; color: #94a3b8;">
                    <svg style="width: 56px; height: 56px; margin-bottom: 12px; color: #cbd5e1;" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <h3 style="font-size: 16px; font-weight: 700; color: #334155; margin: 0 0 4px 0;">Hộp thư trực tuyến</h3>
                    <p style="font-size: 12px; max-width: 300px; color: #94a3b8; margin: 0;">Chọn một cuộc trò chuyện từ danh sách bên trái để xem nội dung và phản hồi khách hàng.</p>
                </div>
            @endif
        </div>

        {{-- ========================================================
             COLUMN 3: CUSTOMER CONTEXT & ACTIONS (290px)
             ======================================================== --}}
        @if($this->selectedConversation)
            @php
                $ctxSel = $this->selectedConversation;
                $ctxInfo = $this->getCustomerInfo($ctxSel->visitor);
            @endphp
            <div class="cl-col-profile cl-scroll-y">
                {{-- Header --}}
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; flex-shrink: 0;">
                    <h4 style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin: 0;">
                        Thông tin khách hàng
                    </h4>
                    <button type="button" style="border: none; background: transparent; font-size: 12px; font-weight: 600; color: #2563eb; cursor: pointer; padding: 0;">
                        Chỉnh sửa
                    </button>
                </div>

                {{-- Profile Summary --}}
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img
                        src="{{ $ctxInfo['avatar'] }}"
                        alt="{{ $ctxInfo['name'] }}"
                        class="cl-avatar-profile"
                    >
                    <h3 style="font-size: 14.5px; font-weight: 700; color: #0f172a; margin: 8px 0 0 0;">
                        {{ $ctxInfo['name'] }}
                    </h3>
                    <div style="color: #10b981; font-size: 11.5px; font-weight: 500; display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                        <span style="width: 6px; height: 6px; border-radius: 9999px; background: #10b981;"></span>
                        Online
                    </div>
                </div>

                {{-- Contact Details List --}}
                <div style="display: flex; flex-direction: column; gap: 11px; font-size: 12.5px;">
                    {{-- Phone --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; color: #334155;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <svg style="width: 15px; height: 15px; color: #94a3b8; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span style="font-weight: 500; color: #0f172a;">{{ $ctxInfo['phone'] }}</span>
                        </div>
                        <a href="tel:{{ $ctxInfo['phone'] }}" style="width: 24px; height: 24px; border-radius: 9999px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none;" title="Gọi">
                            <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Email --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; color: #334155;">
                        <div style="display: flex; align-items: center; gap: 10px; min-width: 0;">
                            <svg style="width: 15px; height: 15px; color: #94a3b8; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span style="font-weight: 500; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $ctxInfo['email'] }}</span>
                        </div>
                        <a href="mailto:{{ $ctxInfo['email'] }}" style="width: 24px; height: 24px; border-radius: 9999px; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none;" title="Gửi email">
                            <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Location --}}
                    <div style="display: flex; align-items: center; gap: 10px; color: #334155;">
                        <svg style="width: 15px; height: 15px; color: #94a3b8; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span style="font-weight: 500; color: #0f172a;">{{ $ctxInfo['city'] }}</span>
                    </div>

                    {{-- Interest --}}
                    <div style="display: flex; align-items: flex-start; gap: 10px; color: #334155;">
                        <svg style="width: 15px; height: 15px; color: #94a3b8; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span style="font-weight: 500; color: #0f172a; line-height: 1.35;">{{ $ctxInfo['interest'] }}</span>
                    </div>
                </div>

                {{-- Customer Tags --}}
                <div>
                    <h4 style="font-size: 12.5px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">
                        Thẻ khách hàng
                    </h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 6px; align-items: center;">
                        <span style="background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 9999px;">
                            Khách hàng tiềm năng
                        </span>
                        <span style="background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 9999px;">
                            Website
                        </span>
                        <span style="background: #faf5ff; color: #9333ea; border: 1px solid #f3e8ff; font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 9999px;">
                            Bất động sản
                        </span>
                        <button type="button" style="background: #ffffff; color: #64748b; border: 1px dashed #cbd5e1; font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 9999px; cursor: pointer;">
                            + Thêm thẻ
                        </button>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <h4 style="font-size: 12.5px; font-weight: 700; color: #0f172a; margin: 0 0 2px 0;">
                        Hành động nhanh
                    </h4>

                    {{-- Gửi báo giá --}}
                    <button
                        type="button"
                        wire:click="sendQuotation"
                        class="cl-btn-quote"
                    >
                        <svg style="width: 14px; height: 14px; transform: rotate(-45deg) translateX(1px);" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                        <span>Gửi báo giá</span>
                    </button>

                    {{-- Tạo yêu cầu tư vấn --}}
                    <button
                        type="button"
                        wire:click="createConsultation"
                        class="cl-btn-action"
                    >
                        <svg style="width: 15px; height: 15px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span>Tạo yêu cầu tư vấn</span>
                    </button>

                    {{-- Thêm ghi chú --}}
                    <button
                        type="button"
                        class="cl-btn-action"
                    >
                        <svg style="width: 15px; height: 15px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Thêm ghi chú</span>
                    </button>

                    {{-- Chuyển cho bộ phận khác --}}
                    <button
                        type="button"
                        class="cl-btn-action"
                    >
                        <svg style="width: 15px; height: 15px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Chuyển cho bộ phận khác</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
