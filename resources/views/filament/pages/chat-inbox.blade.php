<x-filament-panels::page class="cl-chat-inbox-page">
    {{--
        CHAT INBOX REDESIGN - CỬU LONG ID COMMAND CENTER
        Pixel-perfect 3-Column Layout:
        - Col 1 (370px): Inbox List, Filter Pills, Search, Channel & Tag Dropdowns, Conversation Cards
        - Col 2 (flex-1): Conversation Stream, Real-time Connection State, Controls, Composer
        - Col 3 (290px): Customer 360 Profile, Tags, Lead Stage, Source URL & Visitor Tracking, Quick Actions
    --}}
    <style>
        /* Lock outer window scrolling completely to eliminate large outer scrollbar */
        html, body {
            height: 100% !important;
            max-height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }

        .fi-body,
        .fi-layout {
            height: 100% !important;
            max-height: 100% !important;
            overflow: hidden !important;
        }

        .fi-main-ctn {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            max-height: 100% !important;
            flex: 1 1 0% !important;
            min-height: 0 !important;
            overflow: hidden !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .fi-topbar {
            flex-shrink: 0 !important;
        }

        .fi-main,
        main {
            display: flex !important;
            flex-direction: column !important;
            flex: 1 1 0% !important;
            min-height: 0 !important;
            height: 100% !important;
            max-height: 100% !important;
            overflow: hidden !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Filament panel layout resets */
        .cl-chat-inbox-page,
        .fi-page {
            padding: 0 !important;
            margin: 0 !important;
            max-width: none !important;
            display: flex !important;
            flex-direction: column !important;
            flex: 1 1 0% !important;
            min-height: 0 !important;
            height: 100% !important;
            max-height: 100% !important;
            overflow: hidden !important;
        }
        .cl-chat-inbox-page section,
        .cl-chat-inbox-page > section,
        .fi-page section,
        .fi-page > section,
        .fi-section {
            padding: 0 !important;
            margin: 0 !important;
            gap: 0 !important;
            height: 100% !important;
            max-height: 100% !important;
            min-height: 0 !important;
            flex: 1 1 0% !important;
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
        }
        @media (min-width: 640px) {
            .fi-main, main, .fi-page, .cl-chat-inbox-page {
                padding: 0 !important;
                margin: 0 !important;
            }
        }
        @media (min-width: 1024px) {
            .fi-main, main, .fi-page, .cl-chat-inbox-page {
                padding: 0 !important;
                margin: 0 !important;
            }
        }
        .fi-page-header, .fi-header {
            display: none !important;
        }

        /* 3-Column Root Container: fits 100% into viewport without pushing bottom bar offscreen */
        .cl-inbox-container {
            display: flex !important;
            flex-direction: row !important;
            flex: 1 1 0% !important;
            min-height: 0 !important;
            width: 100% !important;
            height: calc(100vh - 4.25rem) !important;
            max-height: calc(100vh - 4.25rem) !important;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            overflow: hidden !important;
            box-sizing: border-box;
            font-family: inherit;
            position: relative;
        }

        /* Column 1: Conversations List */
        .cl-col-list {
            width: 340px !important;
            min-width: 320px !important;
            max-width: 350px !important;
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
            position: relative;
        }

        /* Column 3: Profile & Actions */
        .cl-col-profile {
            width: 320px !important;
            min-width: 320px !important;
            max-width: 320px !important;
            flex-shrink: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            max-height: 100% !important;
            min-height: 0 !important;
            background: #ffffff;
            box-sizing: border-box;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            padding: 16px 14px 24px 14px;
            gap: 16px;
            scrollbar-width: thin !important;
            scrollbar-color: #cbd5e1 #f8fafc !important;
        }
        .cl-col-profile::-webkit-scrollbar {
            width: 6px !important;
            display: block !important;
        }
        .cl-col-profile::-webkit-scrollbar-track {
            background: #f8fafc !important;
            border-radius: 4px !important;
        }
        .cl-col-profile::-webkit-scrollbar-thumb {
            background-color: #cbd5e1 !important;
            border-radius: 4px !important;
        }
        .cl-col-profile::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8 !important;
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

        /* Avatars */
        .cl-avatar-card {
            width: 44px !important;
            height: 44px !important;
            min-width: 44px !important;
            max-width: 44px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            display: block !important;
            border: 1px solid #e2e8f0;
            background: #f1f5f9;
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
            background: #f1f5f9;
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
            background: #f1f5f9;
        }
        .cl-avatar-profile {
            width: 64px !important;
            height: 64px !important;
            min-width: 64px !important;
            max-width: 64px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            display: block !important;
            border: 2px solid #e2e8f0;
            background: #f1f5f9;
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
        .cl-conv-card.is-unread {
            background: #fffaf0;
            border-color: #fed7aa;
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
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border-radius: 9999px;
            background: #ff5400;
            color: #ffffff;
            font-size: 10.5px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 1px 3px rgba(255, 84, 0, 0.3);
        }

        /* Chat bubbles */
        .cl-msg-customer {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            max-width: 78%;
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
            word-break: break-word;
        }
        .cl-msg-agent {
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            gap: 10px;
            max-width: 78%;
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
            word-break: break-word;
        }

        /* Buttons */
        .cl-btn-quote {
            background: linear-gradient(135deg, #ff5400 0%, #ff3b00 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 12.5px;
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
            box-sizing: border-box;
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
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.15s ease;
            width: 100%;
            text-align: left;
            box-sizing: border-box;
        }
        .cl-btn-action:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Pill header button */
        .cl-header-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 600;
            color: #334155;
            background: #ffffff;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .cl-header-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Tag pill */
        .cl-tag-badge {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
            font-size: 11px;
            font-weight: 500;
            padding: 3px 8px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .cl-tag-remove-btn {
            border: none;
            background: transparent;
            color: #93c5fd;
            cursor: pointer;
            padding: 0;
            font-size: 13px;
            font-weight: 700;
            line-height: 1;
            display: inline-flex;
            align-items: center;
        }
        .cl-tag-remove-btn:hover {
            color: #ef4444;
        }

        /* Floating Toast Popup */
        .cl-inbox-toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 99999;
            width: 330px;
            background: #ffffff;
            border: 1.5px solid #ff5400;
            border-radius: 16px;
            box-shadow: 0 12px 28px -4px rgba(255, 84, 0, 0.22), 0 8px 12px -4px rgba(0, 0, 0, 0.08);
            padding: 14px;
            box-sizing: border-box;
            animation: clSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes clSlideUp {
            from {
                opacity: 0;
                transform: translateY(16px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Smart Scroll Bottom Pill */
        .cl-scroll-bottom-pill {
            position: absolute;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 40;
            background: #ff5400;
            color: #ffffff;
            font-size: 11.5px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 9999px;
            border: none;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .cl-scroll-bottom-pill:hover {
            background: #e04a00;
            transform: translateX(-50%) translateY(-2px);
        }

        /* Typing Dots Animation */
        .cl-typing-dots {
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }
        .cl-typing-dots span {
            width: 5px;
            height: 5px;
            background: #ff5400;
            border-radius: 9999px;
            animation: clBounce 1.4s infinite ease-in-out both;
        }
        .cl-typing-dots span:nth-child(1) { animation-delay: -0.32s; }
        .cl-typing-dots span:nth-child(2) { animation-delay: -0.16s; }
        @keyframes clBounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        /* Message Action Triggers */
        .cl-msg-wrapper {
            position: relative;
        }
        .cl-msg-action-trigger {
            opacity: 0;
            transition: opacity 0.15s ease;
        }
        .cl-msg-wrapper:hover .cl-msg-action-trigger {
            opacity: 1;
        }

        /* Unread Separator */
        .cl-unread-separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 12px 0;
            color: #ff5400;
            font-size: 11px;
            font-weight: 700;
        }
        .cl-unread-separator::before,
        .cl-unread-separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px dashed #ff5400;
        }
        .cl-unread-separator span {
            padding: 0 10px;
        }

        /* Recalled & Deleted Bubble States */
        .cl-bubble-recalled, .cl-bubble-deleted {
            font-style: italic;
            color: #64748b;
            background: #f1f5f9;
            border: 1px dashed #cbd5e1;
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 11.5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Optimistic UI Bubble */
        .cl-bubble-optimistic {
            opacity: 0.75;
            border-style: dashed !important;
        }
        .cl-retry-btn {
            background: #fee2e2;
            color: #ef4444;
            border: 1px solid #fca5a5;
            border-radius: 4px;
            padding: 1px 6px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            margin-left: 4px;
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }
        .cl-retry-btn:hover {
            background: #fecaca;
        }

        /* Chat Composer Redesign */
        .cl-composer-container {
            padding: 12px 18px 14px 18px;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            flex-shrink: 0 !important;
            z-index: 30;
            position: relative;
            box-shadow: 0 -3px 12px rgba(0, 0, 0, 0.03);
        }
        /* Chat Composer Redesign - Ultra Soft & Modern Border */
        .cl-composer-container {
            padding: 10px 18px 14px 18px;
            background: #ffffff;
            border-top: 1px solid #f1f5f9;
            flex-shrink: 0 !important;
            z-index: 30;
            position: relative;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.02);
        }
        .cl-composer-box {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 14px !important;
            background: #ffffff !important;
            padding: 8px 12px 10px 14px !important;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02), 0 2px 6px -1px rgba(0, 0, 0, 0.04) !important;
            position: relative;
        }
        .cl-composer-box:focus-within {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.14), 0 4px 12px -2px rgba(37, 99, 235, 0.06) !important;
        }
        .cl-composer-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 6px;
            margin-bottom: 6px;
            border-bottom: 1px solid #f8fafc;
        }
        .cl-composer-tools-left {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .cl-composer-tool-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid transparent;
            background: transparent;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
            font-size: 15px;
            padding: 0;
        }
        .cl-composer-tool-btn:hover {
            background: #f1f5f9;
            color: #1e293b;
            border-color: #e2e8f0;
        }
        .cl-composer-tool-btn.is-active {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }
        .cl-composer-shortcuts-hint {
            font-size: 11px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cl-composer-shortcuts-hint kbd {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 1px 5px;
            font-family: inherit;
            font-size: 10px;
            color: #64748b;
        }
        .cl-composer-textarea,
        #reply-message-input {
            width: 100% !important;
            font-size: 13.5px !important;
            line-height: 1.55 !important;
            color: #0f172a !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            resize: none !important;
            background: transparent !important;
            padding: 6px 8px 6px 0 !important;
            min-height: 44px !important;
            max-height: 180px !important;
            field-sizing: content !important;
            font-family: inherit !important;
            box-sizing: border-box !important;
            overflow-y: auto !important;
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }
        .cl-composer-textarea:focus,
        #reply-message-input:focus {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .cl-composer-textarea::placeholder,
        #reply-message-input::placeholder {
            color: #94a3b8;
        }
        .cl-composer-textarea::-webkit-scrollbar,
        #reply-message-input::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .cl-composer-textarea::-webkit-scrollbar-track,
        #reply-message-input::-webkit-scrollbar-track {
            display: none !important;
            background: transparent;
        }
        .cl-composer-textarea::-webkit-scrollbar-thumb,
        #reply-message-input::-webkit-scrollbar-thumb {
            display: none !important;
            background: transparent;
        }
        .cl-composer-textarea::-webkit-scrollbar-button,
        #reply-message-input::-webkit-scrollbar-button {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .cl-composer-send-btn {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            margin-bottom: 2px;
        }
        .cl-composer-send-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
            transform: scale(1.05);
        }
        .cl-composer-send-btn:active:not(:disabled) {
            transform: scale(0.96);
        }
        .cl-composer-send-btn:disabled {
            opacity: 0.35;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        /* Quick Replies Dropdown Popover - Soft Modern Floating Card */
        .cl-quick-reply-dropdown {
            position: absolute;
            bottom: calc(100% + 10px);
            left: 18px;
            right: 18px;
            max-width: 640px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 16px 36px -6px rgba(15, 23, 42, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.04);
            z-index: 999;
            overflow: hidden;
            animation: clQuickFade 0.15s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes clQuickFade {
            from { opacity: 0; transform: translateY(6px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .cl-quick-reply-header {
            padding: 10px 14px;
            background: #f8fafc;
            border-bottom: 1px solid #eef2f6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }
        .cl-quick-reply-title {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.04em;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
        }
        .cl-quick-reply-title span:first-child {
            color: #ea580c;
            font-size: 13px;
        }
        .cl-quick-reply-hint {
            font-size: 11px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cl-quick-reply-hint kbd {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 1px 5px;
            font-size: 10px;
            font-family: inherit;
            color: #475569;
        }
        .cl-quick-reply-manage-link {
            font-size: 11px;
            font-weight: 700;
            color: #2563eb;
            background: #eff6ff;
            padding: 3px 8px;
            border-radius: 6px;
            border: 1px solid #bfdbfe;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.15s ease;
        }
        .cl-quick-reply-manage-link:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }
        .cl-quick-reply-close-btn {
            border: none;
            background: #f1f5f9;
            color: #64748b;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-quick-reply-close-btn:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .cl-quick-reply-list {
            max-height: 270px;
            overflow-y: auto;
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }
        .cl-quick-reply-list::-webkit-scrollbar {
            width: 5px;
        }
        .cl-quick-reply-list::-webkit-scrollbar-track {
            background: transparent;
        }
        .cl-quick-reply-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .cl-quick-reply-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .cl-quick-reply-list::-webkit-scrollbar-button {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .cl-quick-reply-item {
            padding: 9px 12px;
            border-radius: 10px;
            border: 1px solid #f1f5f9;
            background: #ffffff;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-quick-reply-item:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
        }
        .cl-quick-reply-item.is-selected {
            background: #f0f7ff;
            border-color: #bae6fd;
            box-shadow: 0 1px 4px rgba(2, 132, 199, 0.08);
        }
        .cl-quick-reply-badge {
            background: #ecfeff;
            color: #0284c7;
            border: 1px solid #bae6fd;
            font-weight: 800;
            font-size: 11.5px;
            padding: 3px 8px;
            border-radius: 6px;
            white-space: nowrap;
            font-family: ui-monospace, monospace;
            flex-shrink: 0;
        }
        .cl-quick-reply-item.is-selected .cl-quick-reply-badge {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
        }
        .cl-quick-reply-info {
            flex: 1;
            min-width: 0;
        }
        .cl-quick-reply-name {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 2px;
        }
        .cl-quick-reply-name span:first-child {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
        }
        .cl-quick-reply-cat {
            font-size: 10px;
            color: #64748b;
            background: #f1f5f9;
            padding: 1px 6px;
            border-radius: 4px;
            font-weight: 600;
        }
        .cl-quick-reply-snippet {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.45;
        }
        .cl-quick-reply-empty {
            padding: 20px;
            text-align: center;
            font-size: 12.5px;
            color: #94a3b8;
        }

        /* Emoji Picker Popover */
        .cl-emoji-picker-dropdown {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 18px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
            padding: 8px;
            z-index: 999;
            width: 240px;
        }
        .cl-emoji-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 4px;
        }
        .cl-emoji-btn {
            font-size: 18px;
            background: transparent;
            border: none;
            border-radius: 6px;
            padding: 6px;
            cursor: pointer;
            transition: background 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .cl-emoji-btn:hover {
            background: #f1f5f9;
            transform: scale(1.15);
        }

        /* Quotation Modal Backdrop & Card */
        .cl-quote-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(3px);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        .cl-quote-modal-card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 20px 40px -8px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 640px;
            max-height: 85vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            animation: clSlideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cl-quote-modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fafafa;
        }
        .cl-quote-modal-body {
            padding: 16px 20px;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .cl-quote-plan-card {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 14px;
            cursor: pointer;
            transition: all 0.15s ease;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .cl-quote-plan-card:hover {
            border-color: #93c5fd;
            background: #f8fafc;
        }
        .cl-quote-plan-card.is-selected {
            border-color: #2563eb;
            background: #eff6ff;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
        }
        .cl-quote-modal-footer {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
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
            // Settings from localStorage
            soundEnabled: localStorage.getItem('cl_inbox_sound') !== 'false',
            popupEnabled: localStorage.getItem('cl_inbox_popup') !== 'false',
            browserNotifEnabled: localStorage.getItem('cl_inbox_browser_notif') !== 'false',
            notifPermission: (typeof Notification !== 'undefined') ? Notification.permission : 'default',
            showPrefMenu: false,

            // Connection state
            connectionState: 'connected', // 'connected', 'offline'

            // Floating Toast State
            popupVisible: false,
            popupData: {
                customer_name: '',
                preview: '',
                conversation_uuid: '',
                count: 1,
            },
            popupTimer: null,

            // Anti-duplicate notification
            seenMessageUuids: new Set(),
            tabChannel: null,

            // Optimistic message list
            optimisticMessages: [],

            // Smart Scroll & Unread below
            unreadBelowCount: 0,
            isUserScrolledUp: false,

            // Typing indicators
            visitorTyping: false,
            agentTypingTimer: null,

            // Message context menu
            activeMenuMsgUuid: null,
            copiedNoticeMsgUuid: null,

            // Composer & Shortcuts state
            isSubmitting: false,
            messageInputText: '',
            showEmojiPicker: false,
            emojis: ['👍', '❤️', '😊', '🙏', '🎉', '🤝', '💼', '🚀', '⭐', '✨', '📋', '📞', '💬', '💡', '✅'],
            quickReplies: {{ Js::from($this->quickReplies) }},
            quickReplyOpen: false,
            quickReplyQuery: '',
            quickReplyIndex: 0,

            get filteredQuickReplies() {
                const q = (this.quickReplyQuery || '').toLowerCase().trim();
                if (!q || q === '/') return this.quickReplies;
                const cleanQ = q.startsWith('/') ? q.substring(1) : q;
                return this.quickReplies.filter(item => {
                    const sc = (item.shortcut || '').toLowerCase().replace(/^\//, '');
                    const title = (item.title || '').toLowerCase();
                    const cat = (item.category || '').toLowerCase();
                    return sc.includes(cleanQ) || title.includes(cleanQ) || cat.includes(cleanQ);
                });
            },

            init() {
                // Multi-tab coordination
                try {
                    if (typeof BroadcastChannel !== 'undefined') {
                        this.tabChannel = new BroadcastChannel('cl_inbox_tab_coord');
                        this.tabChannel.onmessage = (event) => {
                            const data = event.data;
                            if (data && data.type === 'NOTIFY_PLAYED') {
                                this.seenMessageUuids.add(data.message_uuid);
                            }
                        };
                    }
                } catch (e) {
                    console.warn('[Inbox] BroadcastChannel disabled:', e);
                }

                // Auto request notification permission on user click if default
                if (typeof Notification !== 'undefined' && Notification.permission === 'default') {
                    const reqOnce = () => {
                        Notification.requestPermission().then(res => {
                            this.notifPermission = res;
                            this.browserNotifEnabled = (res === 'granted');
                            localStorage.setItem('cl_inbox_browser_notif', this.browserNotifEnabled);
                        });
                    };
                    window.addEventListener('click', reqOnce, { once: true });
                }

                // Window online/offline
                window.addEventListener('online', () => { 
                    this.connectionState = 'reconnecting';
                    $wire.poll().then(() => {
                        this.connectionState = 'connected';
                    });
                });
                window.addEventListener('offline', () => { 
                    this.connectionState = 'offline'; 
                });

                // Visibility polling hook
                document.addEventListener('visibilitychange', () => {
                    if (document.visibilityState === 'visible') {
                        $wire.poll();
                    }
                });

                // Global keyboard shortcuts
                window.addEventListener('keydown', (e) => {
                    // Ctrl/Cmd + K: focus conversation search input
                    if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                        e.preventDefault();
                        const searchEl = document.getElementById('cl-conversation-search-input');
                        if (searchEl) {
                            searchEl.focus();
                            searchEl.select();
                        }
                    }
                    // Ctrl/Cmd + Enter: submit reply
                    if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                        e.preventDefault();
                        this.sendOptimisticReply();
                    }
                    // Alt + M (or Alt + /): toggle quick replies catalog (Mẫu tin)
                    if ((e.altKey && (e.key === 'm' || e.key === 'M')) || (e.altKey && e.key === '/')) {
                        e.preventDefault();
                        this.quickReplyOpen = !this.quickReplyOpen;
                        this.quickReplyQuery = '';
                        this.quickReplyIndex = 0;
                    }
                });

                // Scroll to bottom on reply sent & clear optimistic
                $wire.on('message-sent', () => {
                    this.optimisticMessages = [];
                    this.isSubmitting = false;
                    this.scrollToBottom();
                });

                $wire.on('message-deleted', (data) => {
                    this.activeMenuMsgUuid = null;
                });

                $wire.on('message-recalled', (data) => {
                    this.activeMenuMsgUuid = null;
                });

                // Visitor typing status
                $wire.on('visitor-typing-status', (data) => {
                    const payload = data[0] || data;
                    this.visitorTyping = !!payload.is_typing;
                    if (this.visitorTyping && !this.isUserScrolledUp) {
                        this.scrollToBottom();
                    }
                });

                // Realtime incoming customer message handler
                $wire.on('incoming-customer-message', (data) => {
                    const payload = data[0] || data;
                    this.handleIncomingMessage(payload);

                    if (payload.is_current_conversation) {
                        if (this.isUserScrolledUp) {
                            this.unreadBelowCount++;
                        } else {
                            this.scrollToBottom();
                        }
                    }
                });

                // Realtime sync event
                $wire.on('inbox-synced', (data) => {
                    const payload = data[0] || data;
                    this.connectionState = 'connected';
                    this.updateTabTitle(payload.total_unread);
                });

                this.updateTabTitle();
            },

            handleScroll(e) {
                const el = e.target;
                const distFromBottom = el.scrollHeight - el.scrollTop - el.clientHeight;
                this.isUserScrolledUp = distFromBottom > 70;
                if (!this.isUserScrolledUp) {
                    this.unreadBelowCount = 0;
                }
            },

            scrollToBottom(force = false) {
                this.$nextTick(() => {
                    const el = this.$refs.messagesContainer;
                    if (el) {
                        el.scrollTo({
                            top: el.scrollHeight,
                            behavior: force ? 'auto' : 'smooth'
                        });
                        this.unreadBelowCount = 0;
                        this.isUserScrolledUp = false;
                    }
                });
            },

            onComposerInput(e) {
                const val = e.target.value;
                this.messageInputText = val;

                // Check for slash command
                const match = val.match(/(?:^|\s)\/([a-zA-Z0-9_\-]*)$/);
                if (match) {
                    this.quickReplyQuery = match[1] ? '/' + match[1] : '/';
                    this.quickReplyOpen = true;
                    this.quickReplyIndex = 0;
                } else {
                    this.quickReplyOpen = false;
                }

                this.resizeComposer(e.target);
                this.handleAgentTyping();
            },

            resizeComposer(el) {
                if (!el) el = document.getElementById('reply-message-input');
                if (!el) return;
                el.style.height = 'auto';
                const targetH = Math.min(Math.max(el.scrollHeight, 44), 180);
                el.style.height = targetH + 'px';
            },

            onComposerKeyDown(e) {
                if (this.quickReplyOpen) {
                    const list = this.filteredQuickReplies;
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        if (list.length > 0) {
                            this.quickReplyIndex = (this.quickReplyIndex + 1) % list.length;
                        }
                        return;
                    }
                    if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        if (list.length > 0) {
                            this.quickReplyIndex = (this.quickReplyIndex - 1 + list.length) % list.length;
                        }
                        return;
                    }
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if (list.length > 0 && list[this.quickReplyIndex]) {
                            this.insertQuickReply(list[this.quickReplyIndex]);
                        }
                        return;
                    }
                    if (e.key === 'Escape') {
                        e.preventDefault();
                        this.quickReplyOpen = false;
                        return;
                    }
                }

                if (e.key === 'Enter') {
                    if (e.shiftKey) {
                        return; // allow newline
                    }
                    if (!e.isComposing) {
                        e.preventDefault();
                        this.sendOptimisticReply();
                    }
                    return;
                }

                if (e.key === 'Escape') {
                    this.showEmojiPicker = false;
                    this.quickReplyOpen = false;
                }
            },

            insertQuickReply(qr) {
                if (!qr) return;
                const inputEl = document.getElementById('reply-message-input');
                if (!inputEl) return;

                const curVal = inputEl.value;
                const slashRegex = /(?:^|\s)\/([a-zA-Z0-9_\-]*)$/;
                let finalVal = '';
                if (slashRegex.test(curVal)) {
                    finalVal = curVal.replace(slashRegex, (match) => {
                        return match.startsWith(' ') ? ' ' + qr.content : qr.content;
                    });
                } else {
                    finalVal = (curVal ? curVal + ' ' : '') + qr.content;
                }

                inputEl.value = finalVal;
                this.messageInputText = finalVal;
                $wire.replyMessage = finalVal;
                this.quickReplyOpen = false;
                this.quickReplyQuery = '';

                // Dispatch native events for Livewire and Alpine
                inputEl.dispatchEvent(new Event('input', { bubbles: true }));
                inputEl.dispatchEvent(new Event('change', { bubbles: true }));

                this.resizeComposer(inputEl);
                this.$nextTick(() => {
                    inputEl.focus();
                    this.resizeComposer(inputEl);
                });
                setTimeout(() => this.resizeComposer(inputEl), 30);
                setTimeout(() => this.resizeComposer(inputEl), 100);
                setTimeout(() => this.resizeComposer(inputEl), 200);
            },

            insertEmoji(emo) {
                const inputEl = document.getElementById('reply-message-input');
                if (!inputEl) return;
                const start = inputEl.selectionStart || inputEl.value.length;
                const end = inputEl.selectionEnd || inputEl.value.length;
                const text = inputEl.value;
                inputEl.value = text.substring(0, start) + emo + text.substring(end);
                this.messageInputText = inputEl.value;
                $wire.replyMessage = inputEl.value;
                this.showEmojiPicker = false;

                inputEl.dispatchEvent(new Event('input', { bubbles: true }));
                inputEl.dispatchEvent(new Event('change', { bubbles: true }));

                this.$nextTick(() => {
                    inputEl.focus();
                    inputEl.setSelectionRange(start + emo.length, start + emo.length);
                    this.resizeComposer(inputEl);
                });
                setTimeout(() => this.resizeComposer(inputEl), 40);
                setTimeout(() => this.resizeComposer(inputEl), 120);
            },

            sendOptimisticReply() {
                if (this.isSubmitting) return;
                const inputEl = document.getElementById('reply-message-input');
                const text = (inputEl ? inputEl.value : $wire.replyMessage || '').trim();
                const hasAttach = ($wire.attachments && $wire.attachments.length > 0);
                if (!text && !hasAttach) return;

                this.isSubmitting = true;
                const clientMsgId = 'agent_' + Date.now() + '_' + Math.random().toString(36).substring(2, 9);
                const opt = {
                    message_uuid: 'tmp_' + clientMsgId,
                    client_message_id: clientMsgId,
                    message_body: text,
                    sender_type: { value: 'agent' },
                    status: { value: 'sending' },
                    time_str: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                    is_optimistic: true,
                };

                this.optimisticMessages.push(opt);
                if (inputEl) {
                    inputEl.value = '';
                    inputEl.style.height = 'auto';
                }
                this.messageInputText = '';
                $wire.replyMessage = '';
                this.quickReplyOpen = false;
                this.showEmojiPicker = false;

                if (!this.isUserScrolledUp) {
                    this.scrollToBottom(true);
                }

                $wire.sendReply(text, clientMsgId).then(() => {
                    this.isSubmitting = false;
                    this.optimisticMessages = this.optimisticMessages.filter(m => m.client_message_id !== clientMsgId);
                    this.$nextTick(() => this.scrollToBottom(true));
                }).catch(() => {
                    this.isSubmitting = false;
                    opt.status = { value: 'failed' };
                });
            },

            retryOptimisticMessage(optMsg) {
                if (!optMsg || optMsg.status.value === 'sending') return;
                optMsg.status = { value: 'sending' };
                $wire.sendReply(optMsg.message_body, optMsg.client_message_id).then(() => {
                    this.optimisticMessages = this.optimisticMessages.filter(m => m.client_message_id !== optMsg.client_message_id);
                    this.$nextTick(() => this.scrollToBottom(true));
                }).catch(() => {
                    optMsg.status = { value: 'failed' };
                });
            },

            handleAgentTyping() {
                $wire.setAgentTyping(true);
                if (this.agentTypingTimer) clearTimeout(this.agentTypingTimer);
                this.agentTypingTimer = setTimeout(() => {
                    $wire.setAgentTyping(false);
                }, 1500);
            },

            toggleMsgMenu(msgUuid) {
                this.activeMenuMsgUuid = (this.activeMenuMsgUuid === msgUuid) ? null : msgUuid;
            },

            copyMessageText(text, msgUuid) {
                if (!text) return;
                navigator.clipboard.writeText(text).then(() => {
                    this.copiedNoticeMsgUuid = msgUuid;
                    setTimeout(() => {
                        this.copiedNoticeMsgUuid = null;
                        this.activeMenuMsgUuid = null;
                    }, 1200);
                });
            },

            toggleSound() {
                this.soundEnabled = !this.soundEnabled;
                localStorage.setItem('cl_inbox_sound', this.soundEnabled);
            },

            togglePopup() {
                this.popupEnabled = !this.popupEnabled;
                localStorage.setItem('cl_inbox_popup', this.popupEnabled);
            },

            async requestBrowserNotif() {
                if (typeof Notification === 'undefined') return;
                const res = await Notification.requestPermission();
                this.notifPermission = res;
                this.browserNotifEnabled = (res === 'granted');
                localStorage.setItem('cl_inbox_browser_notif', this.browserNotifEnabled);
            },

            playChime() {
                if (!this.soundEnabled) return;
                try {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    if (!AudioContext) return;
                    const ctx = new AudioContext();
                    const now = ctx.currentTime;

                    // Note 1: 587.33 Hz (D5)
                    const osc1 = ctx.createOscillator();
                    const gain1 = ctx.createGain();
                    osc1.type = 'sine';
                    osc1.frequency.setValueAtTime(587.33, now);
                    gain1.gain.setValueAtTime(0.12, now);
                    gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.3);
                    osc1.connect(gain1);
                    gain1.connect(ctx.destination);
                    osc1.start(now);
                    osc1.stop(now + 0.3);

                    // Note 2: 880 Hz (A5)
                    const osc2 = ctx.createOscillator();
                    const gain2 = ctx.createGain();
                    osc2.type = 'sine';
                    osc2.frequency.setValueAtTime(880, now + 0.1);
                    gain2.gain.setValueAtTime(0.15, now + 0.1);
                    gain2.gain.exponentialRampToValueAtTime(0.001, now + 0.5);
                    osc2.connect(gain2);
                    gain2.connect(ctx.destination);
                    osc2.start(now + 0.1);
                    osc2.stop(now + 0.5);
                } catch (e) {
                    // Handled gracefully without error
                }
            },

            handleIncomingMessage(data) {
                if (!data || !data.message_uuid) return;

                // Anti-duplicate check
                if (this.seenMessageUuids.has(data.message_uuid)) {
                    return;
                }
                this.seenMessageUuids.add(data.message_uuid);

                // Multi-tab broadcast
                if (this.tabChannel) {
                    this.tabChannel.postMessage({
                        type: 'NOTIFY_PLAYED',
                        message_uuid: data.message_uuid
                    });
                }

                // Update tab title
                this.updateTabTitle(data.total_unread);

                // Play sound notification
                if (this.soundEnabled) {
                    this.playChime();
                }

                // Show bottom-right popup toast if not currently viewing this conversation
                if (this.popupEnabled && !data.is_current_conversation) {
                    this.showPopup(data);
                }

                // HTML5 Browser Notification if tab is hidden OR window is unfocused (user working in Word, Excel, Zalo, etc.)
                var isWindowUnfocused = !document.hasFocus() || document.hidden;
                if (this.browserNotifEnabled && this.notifPermission === 'granted' && (isWindowUnfocused || !data.is_current_conversation)) {
                    try {
                        const notif = new Notification('💬 TIN NHẮN MỚI — ' + (data.customer_name || 'Khách hàng'), {
                            body: (data.customer_name || 'Khách hàng') + ': ' + (data.preview || 'Tin nhắn mới'),
                            icon: '/images/logo-notification.png',
                            badge: '/images/logo-notification.png',
                            tag: 'cl_inbox_' + (data.message_uuid || Date.now()),
                            requireInteraction: true,
                            renotify: true,
                            silent: false
                        });
                        notif.onclick = () => {
                            window.focus();
                            if (data.conversation_uuid) {
                                $wire.selectConversation(data.conversation_uuid);
                            }
                            notif.close();
                        };
                    } catch (err) {}
                }
            },

            showPopup(data) {
                if (this.popupTimer) clearTimeout(this.popupTimer);

                if (this.popupVisible && this.popupData.conversation_uuid === data.conversation_uuid) {
                    this.popupData.count = (this.popupData.count || 1) + 1;
                    this.popupData.preview = data.preview;
                } else {
                    this.popupData = {
                        customer_name: data.customer_name || 'Khách hàng',
                        preview: data.preview || '',
                        conversation_uuid: data.conversation_uuid,
                        count: 1,
                    };
                }

                this.popupVisible = true;
                this.popupTimer = setTimeout(() => {
                    this.popupVisible = false;
                }, 6000);
            },

            dismissPopup() {
                this.popupVisible = false;
                if (this.popupTimer) clearTimeout(this.popupTimer);
            },

            openFromPopup() {
                const uuid = this.popupData.conversation_uuid;
                this.dismissPopup();
                if (uuid) {
                    $wire.selectConversation(uuid);
                }
            },

            updateTabTitle(count = null) {
                if (count === null) {
                    const badge = document.querySelector('.cl-unread-indicator-badge');
                    count = badge ? (parseInt(badge.getAttribute('data-unread')) || 0) : 0;
                }
                if (typeof window.__clUpdateTabIndicator === 'function') {
                    window.__clUpdateTabIndicator(count);
                } else {
                    const base = 'Hộp thư trực tuyến | Cửu Long';
                    if (count > 0) {
                        document.title = '🔴 (' + count + ') ' + base;
                    } else {
                        document.title = base;
                    }
                }
            }
        }"
        wire:poll.visible.1s="poll"
        class="cl-inbox-container"
    >
        {{-- ========================================================
             COLUMN 1: CONVERSATION LIST (370px)
             ======================================================== --}}
        <div class="cl-col-list">
            {{-- Header Card --}}
            <div style="padding: 16px 16px 12px 16px; border-bottom: 1px solid #f1f5f9; flex-shrink: 0;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
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
                            <p style="font-size: 11px; color: #64748b; margin: 2px 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                Hộp Thư Chăm Sóc Khách Hàng - CSKH & Hội thoại trực tuyến
                            </p>
                        </div>
                    </div>

                    {{-- Connection Indicator Pill --}}
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span
                            x-show="connectionState === 'connected'"
                            style="display: inline-flex; align-items: center; gap: 4px; font-size: 10.5px; font-weight: 600; color: #16a34a; background: #dcfce7; padding: 2px 7px; border-radius: 9999px;"
                            title="Kết nối realtime hoạt động"
                        >
                            <span style="width: 6px; height: 6px; border-radius: 9999px; background: #16a34a;"></span>
                            Online
                        </span>
                        <span
                            x-show="connectionState === 'offline'"
                            style="display: inline-flex; align-items: center; gap: 4px; font-size: 10.5px; font-weight: 600; color: #ef4444; background: #fee2e2; padding: 2px 7px; border-radius: 9999px;"
                            title="Mất kết nối mạng"
                        >
                            <span style="width: 6px; height: 6px; border-radius: 9999px; background: #ef4444;"></span>
                            Offline
                        </span>
                    </div>
                </div>

                {{-- Status Filter Tabs (Pill Buttons) --}}
                @php
                    $filterCounts = $this->filterCounts;
                    $currentFilter = $customStatusFilter;
                    $totalUnreadCount = (int) \App\Models\ChatConversation::where('agent_unread_count', '>', 0)->sum('agent_unread_count');
                @endphp
                <span class="cl-unread-indicator-badge" data-unread="{{ $totalUnreadCount }}" style="display: none;"></span>

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

                {{-- Search Row --}}
                <div style="position: relative; margin-top: 10px;">
                    <svg style="width: 14px; height: 14px; color: #94a3b8; position: absolute; left: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        type="text"
                        id="cl-conversation-search-input"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Tìm theo tên, SĐT, tin nhắn, nguồn (Ctrl+K)..."
                        style="width: 100%; font-size: 12px; padding: 7px 10px 7px 32px; border-radius: 10px; border: 1px solid #e2e8f0; background: #ffffff; color: #0f172a; outline: none; box-sizing: border-box;"
                    >

                </div>

                {{-- Filter Secondary Row: Tag Filter & Channel Dropdown --}}
                <div style="display: flex; align-items: center; gap: 8px; margin-top: 8px;">
                    {{-- Channel Filter --}}
                    <div style="position: relative; flex: 1;">
                        <select
                            wire:model.live="channelFilter"
                            style="width: 100%; font-size: 11.5px; padding: 6px 24px 6px 8px; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; color: #334155; outline: none; appearance: none; cursor: pointer; box-sizing: border-box;"
                        >
                            <option value="all">Tất cả kênh</option>
                            <option value="website">Website</option>
                            <option value="facebook">Facebook</option>
                            <option value="zalo">Zalo</option>
                        </select>
                        <svg style="width: 11px; height: 11px; color: #94a3b8; position: absolute; right: 8px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    {{-- Tag Filter Dropdown --}}
                    <div style="position: relative; flex: 1;">
                        <select
                            wire:model.live="filterTag"
                            style="width: 100%; font-size: 11.5px; padding: 6px 24px 6px 8px; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; color: #334155; outline: none; appearance: none; cursor: pointer; box-sizing: border-box;"
                        >
                            <option value="all">Tất cả thẻ</option>
                            @foreach($this->availableTags as $t)
                                <option value="{{ $t }}">{{ $t }}</option>
                            @endforeach
                        </select>
                        <svg style="width: 11px; height: 11px; color: #94a3b8; position: absolute; right: 8px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    {{-- Unread Only Toggle --}}
                    <button
                        type="button"
                        wire:click="$toggle('unreadOnly')"
                        style="padding: 6px 10px; border-radius: 8px; font-size: 11px; font-weight: 600; cursor: pointer; border: 1px solid {{ $unreadOnly ? '#ff5400' : '#e2e8f0' }}; background: {{ $unreadOnly ? '#fff7ed' : '#ffffff' }}; color: {{ $unreadOnly ? '#ff5400' : '#64748b' }}; display: flex; align-items: center; gap: 4px; flex-shrink: 0;"
                        title="Chỉ hiển thị tin chưa đọc"
                    >
                        <span style="width: 6px; height: 6px; border-radius: 9999px; background: {{ $unreadOnly ? '#ff5400' : '#cbd5e1' }};"></span>
                        Chưa đọc
                    </button>
                </div>
            </div>

            {{-- Bulk Selection & Action Bar --}}
            <div style="padding: 6px 12px; background: {{ count($selectedConversations) > 0 ? '#fff1f2' : '#f8fafc' }}; border-bottom: 1px solid {{ count($selectedConversations) > 0 ? '#fecdd3' : '#e2e8f0' }}; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; min-height: 38px; box-sizing: border-box; transition: background 0.15s ease;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <input
                        type="checkbox"
                        id="select-all-conversations-chk"
                        wire:model.live="selectAll"
                        style="width: 16px; height: 16px; accent-color: #e11d48; cursor: pointer; border-radius: 4px;"
                    />
                    <label for="select-all-conversations-chk" style="cursor: pointer; font-size: 11.5px; font-weight: 600; color: {{ count($selectedConversations) > 0 ? '#9f1239' : '#334155' }}; user-select: none;">
                        @if(count($selectedConversations) > 0)
                            Đã chọn {{ count($selectedConversations) }}/{{ $this->conversations->count() }}
                        @else
                            Chọn tất cả ({{ $this->conversations->count() }})
                        @endif
                    </label>
                </div>

                <div style="display: flex; align-items: center; gap: 6px;">
                    @if(count($selectedConversations) > 0)
                        <button
                            type="button"
                            wire:click="clearSelection"
                            style="font-size: 11px; color: #64748b; background: transparent; border: none; cursor: pointer; padding: 2px 6px; text-decoration: underline;"
                        >
                            Bỏ chọn
                        </button>

                        <button
                            type="button"
                            wire:click="deleteSelectedConversations"
                            wire:confirm="Bạn có chắc chắn muốn xóa vĩnh viễn {{ count($selectedConversations) }} phiên trò chuyện đã chọn không? Hành động này không thể hoàn tác."
                            style="padding: 5px 12px; font-size: 11.5px; font-weight: 700; border-radius: 6px; background: #e11d48; color: #ffffff; border: none; cursor: pointer; display: flex; align-items: center; gap: 5px; box-shadow: 0 1px 4px rgba(225,29,72,0.35); transition: all 0.15s ease;"
                            title="Bấm vào đây để xác nhận xóa các phiên trò chuyện đã chọn"
                        >
                            <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span>Xác nhận xóa ({{ count($selectedConversations) }})</span>
                        </button>
                    @else
                        @if($this->conversations->count() > 0)
                            <button
                                type="button"
                                wire:click="deleteAllConversations"
                                wire:confirm="Bạn có chắc chắn muốn xóa vĩnh viễn TOÀN BỘ {{ $this->conversations->count() }} phiên trò chuyện đang hiển thị không? Hành động này không thể hoàn tác."
                                style="padding: 3px 8px; font-size: 11px; font-weight: 600; border-radius: 6px; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: background 0.15s ease;"
                                title="Xóa toàn bộ các phiên trò chuyện đang hiển thị"
                            >
                                <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Xóa toàn bộ ({{ $this->conversations->count() }})</span>
                            </button>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Conversation Cards List --}}
            <div class="cl-scroll-y" style="flex: 1; padding: 10px; display: flex; flex-direction: column; gap: 8px; background: #ffffff;">
                @forelse($this->conversations as $conv)
                    @php
                        $isSelected = ($selectedConversationUuid === $conv->conversation_uuid);
                        $isChecked = in_array($conv->conversation_uuid, $selectedConversations, true);
                        $info = $this->getCustomerInfo($conv->visitor, $conv);
                        $isUnread = ($info['unread'] > 0);
                    @endphp

                    <div
                        wire:key="conv-card-{{ $conv->conversation_uuid }}"
                        wire:click="selectConversation('{{ $conv->conversation_uuid }}')"
                        class="cl-conv-card {{ $isSelected ? 'is-active' : '' }} {{ $isUnread ? 'is-unread' : '' }}"
                        style="{{ $isChecked ? 'border-color: #f43f5e; background: #fff5f6;' : '' }}"
                    >
                        {{-- Selection Checkbox --}}
                        <div style="display: flex; align-items: center; justify-content: center; padding-right: 4px;" @click.stop>
                            <input
                                type="checkbox"
                                value="{{ $conv->conversation_uuid }}"
                                wire:model.live="selectedConversations"
                                style="width: 15px; height: 15px; accent-color: #e11d48; cursor: pointer; border-radius: 4px;"
                                title="Chọn cuộc trò chuyện này"
                            />
                        </div>

                        {{-- Circular Avatar with Online Dot --}}
                        <div style="position: relative; width: 44px; height: 44px; min-width: 44px; max-width: 44px; flex-shrink: 0;">
                            <img
                                src="{{ $info['avatar'] }}"
                                alt="{{ $info['name'] }}"
                                class="cl-avatar-card"
                            >
                            @if($info['is_online'])
                                <span style="position: absolute; bottom: 0; right: 0; width: 11px; height: 11px; border-radius: 9999px; background: #10b981; border: 2px solid #ffffff;" title="Đang online"></span>
                            @else
                                <span style="position: absolute; bottom: 0; right: 0; width: 11px; height: 11px; border-radius: 9999px; background: #94a3b8; border: 2px solid #ffffff;" title="Ngoại tuyến"></span>
                            @endif
                        </div>

                        {{-- Main Info --}}
                        <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 2px;">
                            {{-- Row 1: Name + Time --}}
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 4px;">
                                <h3 style="font-size: 13.5px; font-weight: {{ $isUnread ? '800' : '700' }}; color: {{ $isUnread ? '#0f172a' : '#1e293b' }}; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $info['name'] }}
                                </h3>
                                <span style="font-size: 11px; color: {{ $isUnread ? '#ff5400; font-weight: 700;' : '#94a3b8;' }} flex-shrink: 0;">
                                    {{ $info['time_label'] }}
                                </span>
                            </div>

                            {{-- Row 2: Source Path if present --}}
                            @if(!empty($info['source_path']))
                                <div style="font-size: 10.5px; color: #0284c7; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: flex; align-items: center; gap: 3px;">
                                    <svg style="width: 10px; height: 10px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                    </svg>
                                    <span>{{ $info['source_path'] === '/' ? 'Trang chủ (/)' : $info['source_path'] }}</span>
                                </div>
                            @endif

                            {{-- Row 3: Last message preview --}}
                            <p style="font-size: 12px; color: {{ $isUnread ? '#0f172a; font-weight: 600;' : '#64748b;' }} margin: 1px 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.35;">
                                {{ $info['preview'] }}
                            </p>

                            {{-- Row 4: Channel Pill + Tags + Status & Unread Badge --}}
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 5px;">
                                {{-- Channel Pill & Tag --}}
                                <div style="display: flex; align-items: center; gap: 4px; overflow: hidden;">
                                    @if(strtolower($info['channel_val']) === 'zalo')
                                        <span class="cl-channel-zalo">Zalo</span>
                                    @elseif(strtolower($info['channel_val']) === 'facebook')
                                        <span class="cl-channel-facebook">Facebook</span>
                                    @else
                                        <span class="cl-channel-website">Website</span>
                                    @endif

                                    @if(!empty($info['tags']) && is_array($info['tags']))
                                        @php
                                            $cardTags = array_values(array_filter($info['tags'], function($t) use ($info) {
                                                return strcasecmp($t, $info['channel_val'] ?? '') !== 0 && strcasecmp($t, 'Website') !== 0;
                                            }));
                                        @endphp
                                        @foreach(array_slice($cardTags, 0, 1) as $t)
                                            <span style="font-size: 10px; color: #475569; background: #f1f5f9; padding: 2px 6px; border-radius: 4px; white-space: nowrap;">
                                                {{ $t }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>

                                {{-- Status Label & Unread Badge --}}
                                <div style="display: flex; align-items: center; gap: 6px; flex-shrink: 0;">
                                    @if($info['status_type'] === 'unanswered')
                                        <span class="cl-status-unanswered">{{ $info['status_label'] }}</span>
                                    @elseif($info['status_type'] === 'processing')
                                        <span class="cl-status-processing">{{ $info['status_label'] }}</span>
                                    @else
                                        <span class="cl-status-answered">{{ $info['status_label'] }}</span>
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
                        Không tìm thấy cuộc trò chuyện nào phù hợp.
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
                    $selInfo = $this->getCustomerInfo($sel->visitor, $sel);
                @endphp

                {{-- Header --}}
                <div style="padding: 10px 16px; background: #ffffff; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-shrink: 0; min-width: 0; box-sizing: border-box;">
                    {{-- Left info --}}
                    <div style="display: flex; align-items: center; gap: 10px; min-width: 0; flex: 1 1 auto; overflow: hidden;">
                        <img
                            src="{{ $selInfo['avatar'] }}"
                            alt="{{ $selInfo['name'] }}"
                            class="cl-avatar-header"
                        >

                        <div style="min-width: 0; flex: 1 1 auto; overflow: hidden;">
                            <div style="display: flex; align-items: center; gap: 6px; overflow: hidden;">
                                <h3 style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $selInfo['name'] }}">
                                    {{ $selInfo['name'] }}
                                </h3>
                                @if($selInfo['is_online'])
                                    <span style="color: #10b981; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; flex-shrink: 0;">
                                        <span style="width: 6px; height: 6px; border-radius: 9999px; background: #10b981;"></span>
                                        Online
                                    </span>
                                @else
                                    <span style="color: #94a3b8; font-size: 11px; font-weight: 500; display: inline-flex; align-items: center; gap: 4px; flex-shrink: 0;">
                                        <span style="width: 6px; height: 6px; border-radius: 9999px; background: #94a3b8;"></span>
                                        Offline
                                    </span>
                                @endif
                            </div>

                            <div style="display: flex; align-items: center; gap: 6px; margin-top: 3px; flex-wrap: nowrap; overflow: hidden;">
                                <span style="color: #2563eb; background: #eff6ff; border: 1px solid #dbeafe; font-size: 10.5px; font-weight: 600; padding: 1px 7px; border-radius: 6px; flex-shrink: 0;">
                                    {{ $selInfo['channel'] }}
                                </span>
                                <span style="color: #0f172a; background: #f8fafc; border: 1px solid #e2e8f0; font-size: 10.5px; font-weight: 600; padding: 1px 7px; border-radius: 6px; flex-shrink: 0;">
                                    {{ $selInfo['lead_status_label'] }}
                                </span>
                                @if(!empty($selInfo['source_path']))
                                    <span style="color: #64748b; font-size: 11px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px; flex-shrink: 1;" title="{{ $selInfo['source_url'] }}">
                                        {{ $selInfo['source_path'] }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Right Action Buttons --}}
                    <div style="display: flex; align-items: center; gap: 6px; flex-shrink: 0; margin-left: auto;">
                        {{-- Human Takeover / Claim --}}
                        @if(!$sel->assigned_to_user_id)
                            <button
                                type="button"
                                wire:click="claim"
                                class="cl-header-btn"
                                style="background: #eff6ff; color: #2563eb; border-color: #bfdbfe;"
                                title="Tiếp nhận cuộc trò chuyện này"
                            >
                                <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Tiếp nhận</span>
                            </button>
                        @endif

                        {{-- Close / Reopen Conversation --}}
                        @if($sel->status->value === 'closed')
                            <button
                                type="button"
                                wire:click="reopenConversation"
                                class="cl-header-btn"
                                style="color: #16a34a; border-color: #bbf7d0;"
                            >
                                <span>Mở lại</span>
                            </button>
                        @else
                            <button
                                type="button"
                                wire:click="closeConversation"
                                class="cl-header-btn"
                                style="color: #64748b;"
                                title="Đóng cuộc trò chuyện"
                            >
                                <span>Đóng chat</span>
                            </button>
                        @endif

                        {{-- Xóa phiên chat --}}
                        <button
                            type="button"
                            wire:click="deleteConversation"
                            wire:confirm="Bạn có chắc chắn muốn xóa vĩnh viễn toàn bộ phiên trò chuyện này không? Hành động này không thể hoàn tác."
                            class="cl-header-btn"
                            style="color: #ef4444; border-color: #fecaca; background: #fff5f5;"
                            title="Xóa vĩnh viễn phiên trò chuyện này"
                        >
                            <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span>Xóa phiên chat</span>
                        </button>

                        {{-- Notification Preferences Popover --}}
                        <div style="position: relative;" @click.outside="showPrefMenu = false">
                            <button
                                type="button"
                                @click="showPrefMenu = !showPrefMenu"
                                style="width: 32px; height: 32px; border-radius: 9999px; border: 1px solid #e2e8f0; background: #ffffff; color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                title="Cài đặt thông báo"
                            >
                                <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </button>

                            <div
                                x-show="showPrefMenu"
                                x-transition
                                style="position: absolute; right: 0; top: 38px; width: 230px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); padding: 12px; z-index: 1000; box-sizing: border-box;"
                            >
                                <h5 style="font-size: 12px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Tùy chọn thông báo</h5>
                                <div style="display: flex; flex-direction: column; gap: 8px; font-size: 12px; color: #334155;">
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="checkbox" :checked="soundEnabled" @change="toggleSound()" />
                                        <span>Âm thanh thông báo</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="checkbox" :checked="popupEnabled" @change="togglePopup()" />
                                        <span>Popup góc phải</span>
                                    </label>
                                    <div style="border-top: 1px solid #f1f5f9; padding-top: 6px;">
                                        <div style="display: flex; align-items: center; justify-content: space-between;">
                                            <span>Trình duyệt:</span>
                                            <span style="font-weight: 700; font-size: 10.5px;" :style="notifPermission === 'granted' ? 'color: #16a34a;' : 'color: #ea580c;'" x-text="notifPermission"></span>
                                        </div>
                                        <template x-if="notifPermission !== 'granted'">
                                            <button
                                                type="button"
                                                @click="requestBrowserNotif()"
                                                style="margin-top: 6px; width: 100%; font-size: 11px; padding: 4px; border-radius: 6px; border: 1px solid #ff5400; background: #fff7ed; color: #ff5400; font-weight: 600; cursor: pointer;"
                                            >
                                                Yêu cầu cấp quyền
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Chat Stream Body (Relative for floating scroll button) --}}
                <div style="position: relative; flex: 1 1 0% !important; min-height: 0 !important; display: flex; flex-direction: column; overflow: hidden; background: #f8fafc;">
                    <div
                        x-ref="messagesContainer"
                        @scroll.passive="handleScroll($event)"
                        class="cl-scroll-y"
                        style="flex: 1 1 0% !important; min-height: 0 !important; padding: 16px 20px; display: flex; flex-direction: column; gap: 12px; overflow-y: auto !important;"
                    >
                        @php $hasRenderedUnread = false; @endphp
                        @forelse($this->messages as $msg)
                            @php
                                $isAgent = ($msg->sender_type->value === 'agent');
                                $isRecalled = ($msg->recalled_at !== null || $msg->status->value === 'recalled');
                                $isDeleted = ($msg->deleted_at !== null || $msg->status->value === 'deleted');
                                $timeStr = $msg->created_at ? $msg->created_at->format('H:i') : '';
                            @endphp

                            {{-- Unread Separator Bar --}}
                            @if(!$hasRenderedUnread && !$isAgent && $msg->status->value !== 'read')
                                <div class="cl-unread-separator">
                                    <span>Tin nhắn chưa đọc</span>
                                </div>
                                @php $hasRenderedUnread = true; @endphp
                            @endif

                            @if(!$isAgent)
                                {{-- Customer Message (Left) --}}
                                <div class="cl-msg-customer cl-msg-wrapper" wire:key="msg-{{ $msg->message_uuid }}">
                                    <img
                                        src="{{ $selInfo['avatar'] }}"
                                        alt="{{ $selInfo['name'] }}"
                                        class="cl-avatar-msg"
                                    >
                                    <div style="position: relative;">
                                        @if($isRecalled)
                                            <div class="cl-bubble-recalled">
                                                <span>🚫 Tin nhắn đã được thu hồi</span>
                                            </div>
                                        @elseif($isDeleted)
                                            <div class="cl-bubble-deleted">
                                                <span>🗑️ Tin nhắn đã được xóa</span>
                                            </div>
                                        @else
                                            <div class="cl-bubble-customer">
                                                {{ $msg->message_body }}
                                            </div>
                                        @endif

                                        <div style="font-size: 10px; color: #94a3b8; margin-top: 3px; padding-left: 2px; display: flex; align-items: center; gap: 8px;">
                                            <span>{{ $timeStr }}</span>

                                            {{-- Copy action & Delete if permitted --}}
                                            @if(!$isRecalled && !$isDeleted)
                                                <button
                                                    type="button"
                                                    @click="copyMessageText('{{ addslashes($msg->message_body) }}', '{{ $msg->message_uuid }}')"
                                                    class="cl-msg-action-trigger"
                                                    style="border: none; background: transparent; font-size: 10px; color: #64748b; cursor: pointer; padding: 0;"
                                                    title="Sao chép tin nhắn"
                                                >
                                                    <span x-text="copiedNoticeMsgUuid === '{{ $msg->message_uuid }}' ? 'Đã sao chép' : 'Sao chép'"></span>
                                                </button>

                                                @can('delete', $sel)
                                                    <button
                                                        type="button"
                                                        wire:click="deleteMessage('{{ $msg->message_uuid }}')"
                                                        wire:confirm="Bạn có chắc chắn muốn xóa tin nhắn này của khách hàng không?"
                                                        class="cl-msg-action-trigger"
                                                        style="border: none; background: transparent; font-size: 10px; color: #ef4444; cursor: pointer; padding: 0 4px;"
                                                        title="Xóa tin nhắn của khách"
                                                    >
                                                        Xóa
                                                    </button>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Agent Message (Right) --}}
                                <div class="cl-msg-agent cl-msg-wrapper" wire:key="msg-{{ $msg->message_uuid }}">
                                    <div style="position: relative; text-align: right;">
                                        @if($isRecalled)
                                            <div class="cl-bubble-recalled" style="text-align: left;">
                                                <span>🚫 Tin nhắn đã được thu hồi</span>
                                            </div>
                                        @elseif($isDeleted)
                                            <div class="cl-bubble-deleted" style="text-align: left;">
                                                <span>🗑️ Tin nhắn đã được xóa</span>
                                            </div>
                                        @elseif($this->editingMessageUuid === $msg->message_uuid)
                                            <div style="background: #ffffff; border: 1.5px solid #2563eb; border-radius: 12px; padding: 10px 12px; width: 340px; max-width: 100%; box-shadow: 0 4px 14px rgba(37,99,235,0.18); text-align: left;">
                                                <div style="font-size: 11px; font-weight: 700; color: #2563eb; margin-bottom: 6px; display: flex; align-items: center; justify-content: space-between;">
                                                    <span>✏️ Chỉnh sửa tin nhắn</span>
                                                    <button type="button" wire:click="cancelEdit" style="border: none; background: transparent; color: #94a3b8; cursor: pointer; font-size: 13px;">✕</button>
                                                </div>
                                                <textarea
                                                    wire:model="editMessageText"
                                                    rows="2"
                                                    style="width: 100%; font-size: 12.5px; color: #0f172a; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; outline: none; resize: vertical; box-sizing: border-box; font-family: inherit;"
                                                    @keydown.enter.exact.prevent="$wire.saveEditMessage()"
                                                ></textarea>
                                                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px; margin-top: 8px;">
                                                    <button
                                                        type="button"
                                                        wire:click="cancelEdit"
                                                        style="padding: 4px 10px; font-size: 11px; font-weight: 600; border: 1px solid #cbd5e1; border-radius: 6px; background: #ffffff; color: #64748b; cursor: pointer;"
                                                    >
                                                        Hủy
                                                    </button>
                                                    <button
                                                        type="button"
                                                        wire:click="saveEditMessage"
                                                        style="padding: 4px 12px; font-size: 11px; font-weight: 600; border: none; border-radius: 6px; background: #2563eb; color: #ffffff; cursor: pointer; box-shadow: 0 1px 3px rgba(37,99,235,0.3);"
                                                    >
                                                        Lưu thay đổi
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="cl-bubble-agent">
                                                {{ $msg->message_body }}
                                                @if($msg->edited_at)
                                                    <span style="font-size: 10px; opacity: 0.8; font-style: italic; margin-left: 4px;">(đã sửa)</span>
                                                @endif
                                            </div>
                                        @endif

                                        {{-- Message Status & Context Actions --}}
                                        <div style="font-size: 10px; color: #0284c7; margin-top: 3px; padding-right: 2px; display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                            <span>{{ $timeStr }}</span>

                                            @if(!$isRecalled && !$isDeleted)
                                                {{-- Status badges --}}
                                                @if($msg->status->value === 'read')
                                                    <span style="font-weight: 700; color: #2563eb;" title="Khách đã xem">✓✓ Đã xem</span>
                                                @elseif($msg->status->value === 'delivered')
                                                    <span style="font-weight: 700; color: #0284c7;" title="Đã nhận">✓✓ Đã nhận</span>
                                                @else
                                                    <span style="color: #64748b;" title="Đã gửi">✓ Đã gửi</span>
                                                @endif

                                                {{-- Direct hover actions --}}
                                                <button
                                                    type="button"
                                                    wire:click="startEditMessage('{{ $msg->message_uuid }}')"
                                                    class="cl-msg-action-trigger"
                                                    style="border: none; background: transparent; font-size: 10px; color: #2563eb; cursor: pointer; padding: 0 3px;"
                                                    title="Sửa tin nhắn"
                                                >
                                                    Sửa
                                                </button>
                                                <button
                                                    type="button"
                                                    wire:click="recallMessage('{{ $msg->message_uuid }}')"
                                                    wire:confirm="Bạn có chắc chắn muốn thu hồi tin nhắn này không?"
                                                    class="cl-msg-action-trigger"
                                                    style="border: none; background: transparent; font-size: 10px; color: #ea580c; cursor: pointer; padding: 0 3px;"
                                                    title="Thu hồi tin nhắn"
                                                >
                                                    Thu hồi
                                                </button>
                                                <button
                                                    type="button"
                                                    wire:click="deleteMessage('{{ $msg->message_uuid }}')"
                                                    wire:confirm="Bạn có chắc chắn muốn xóa tin nhắn này không?"
                                                    class="cl-msg-action-trigger"
                                                    style="border: none; background: transparent; font-size: 10px; color: #ef4444; cursor: pointer; padding: 0 3px;"
                                                    title="Xóa tin nhắn"
                                                >
                                                    Xóa
                                                </button>

                                                {{-- 3-dots Context Menu Button --}}
                                                <div style="position: relative; display: inline-block;">
                                                    <button
                                                        type="button"
                                                        @click="toggleMsgMenu('{{ $msg->message_uuid }}')"
                                                        style="border: none; background: transparent; color: #64748b; cursor: pointer; padding: 0 4px; font-weight: 700;"
                                                        title="Tùy chọn tin nhắn"
                                                    >•••</button>

                                                    {{-- Popover menu --}}
                                                    <div
                                                        x-show="activeMenuMsgUuid === '{{ $msg->message_uuid }}'"
                                                        @click.outside="activeMenuMsgUuid = null"
                                                        x-transition
                                                        style="position: absolute; right: 0; bottom: 18px; width: 140px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 4px 14px rgba(0,0,0,0.1); padding: 4px; z-index: 50; text-align: left;"
                                                    >
                                                        <button
                                                            type="button"
                                                            @click="copyMessageText('{{ addslashes($msg->message_body) }}', '{{ $msg->message_uuid }}')"
                                                            style="width: 100%; text-align: left; padding: 5px 8px; font-size: 11px; border: none; background: transparent; color: #334155; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                                                        >
                                                            <span>📋</span>
                                                            <span x-text="copiedNoticeMsgUuid === '{{ $msg->message_uuid }}' ? 'Đã sao chép' : 'Sao chép'"></span>
                                                        </button>

                                                        <button
                                                            type="button"
                                                            wire:click="startEditMessage('{{ $msg->message_uuid }}')"
                                                            style="width: 100%; text-align: left; padding: 5px 8px; font-size: 11px; border: none; background: transparent; color: #2563eb; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                                                        >
                                                            <span>✏️</span>
                                                            <span>Sửa tin nhắn</span>
                                                        </button>

                                                        <button
                                                            type="button"
                                                            wire:click="recallMessage('{{ $msg->message_uuid }}')"
                                                            wire:confirm="Bạn có chắc chắn muốn thu hồi tin nhắn này không?"
                                                            style="width: 100%; text-align: left; padding: 5px 8px; font-size: 11px; border: none; background: transparent; color: #ea580c; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                                                        >
                                                            <span>↩️</span>
                                                            <span>Thu hồi</span>
                                                        </button>

                                                        <button
                                                            type="button"
                                                            wire:click="deleteMessage('{{ $msg->message_uuid }}')"
                                                            wire:confirm="Bạn có chắc chắn muốn xóa tin nhắn này không?"
                                                            style="width: 100%; text-align: left; padding: 5px 8px; font-size: 11px; border: none; background: transparent; color: #ef4444; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                                                        >
                                                            <span>🗑️</span>
                                                            <span>Xóa</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div style="width: 32px; height: 32px; min-width: 32px; border-radius: 9999px; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0;">
                                        CS
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div style="text-align: center; color: #94a3b8; font-size: 12px; padding: 40px 0;">
                                Chưa có tin nhắn trong cuộc trò chuyện này.
                            </div>
                        @endforelse

                        {{-- Optimistic Agent Messages --}}
                        <template x-for="optMsg in optimisticMessages" :key="optMsg.client_message_id">
                            <div class="cl-msg-agent">
                                <div>
                                    <div class="cl-bubble-agent cl-bubble-optimistic" x-text="optMsg.message_body"></div>
                                    <div style="font-size: 10px; color: #0284c7; margin-top: 3px; padding-right: 2px; display: flex; align-items: center; justify-content: flex-end; gap: 4px;">
                                        <span x-text="optMsg.time_str"></span>
                                        <template x-if="optMsg.status.value === 'sending'">
                                            <span style="font-style: italic; color: #0284c7; display: inline-flex; align-items: center; gap: 3px;">
                                                <svg style="width: 10px; height: 10px; animation: spin 1s linear infinite;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10"/></svg>
                                                <span>Đang gửi...</span>
                                            </span>
                                        </template>
                                        <template x-if="optMsg.status.value === 'failed'">
                                            <span style="display: inline-flex; align-items: center; gap: 2px;">
                                                <span style="color: #ef4444; font-weight: 600;">Không gửi được</span>
                                                <button type="button" @click="retryOptimisticMessage(optMsg)" class="cl-retry-btn">
                                                    ↻ Thử lại
                                                </button>
                                            </span>
                                        </template>
                                    </div>
                                </div>
                                <div style="width: 32px; height: 32px; min-width: 32px; border-radius: 9999px; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0;">
                                    CS
                                </div>
                            </div>
                        </template>

                        {{-- Visitor Typing Indicator --}}
                        <div
                            x-show="visitorTyping"
                            x-transition
                            x-cloak
                            style="display: flex; align-items: center; gap: 8px; padding: 6px 12px; border-radius: 12px; background: #ffffff; border: 1px solid #e2e8f0; width: fit-content; font-size: 11.5px; color: #64748b; margin-top: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);"
                        >
                            <div class="cl-typing-dots">
                                <span></span><span></span><span></span>
                            </div>
                            <span>Khách hàng đang soạn tin nhắn...</span>
                        </div>
                    </div>

                    {{-- Floating Scroll to Bottom Pill --}}
                    <button
                        type="button"
                        x-show="isUserScrolledUp && unreadBelowCount > 0"
                        x-cloak
                        @click="scrollToBottom(true)"
                        class="cl-scroll-bottom-pill"
                    >
                        <span>↓</span>
                        <span><span x-text="unreadBelowCount"></span> tin nhắn mới</span>
                    </button>
                </div>

                {{-- ========================================================
                     REDESIGNED PROFESSIONAL CUSTOMER SUPPORT CHAT COMPOSER
                     Structure:
                     ┌──────────────────────────────────────────────────────────────┐
                     │  📎   😊   🖼️    ⚡   [ Nhập tin nhắn... ]                ➤ │
                     │  Enter: Gửi nhanh       Shift + Enter: Xuống dòng            │
                     └──────────────────────────────────────────────────────────────┘
                     ======================================================== --}}
                <div class="cl-composer-container">
                    {{-- Hidden file inputs for attachment & image --}}
                    <input
                        type="file"
                        id="cl-attachment-input"
                        wire:model="attachments"
                        multiple
                        style="display: none;"
                    >
                    <input
                        type="file"
                        id="cl-image-input"
                        wire:model="attachments"
                        accept="image/*"
                        multiple
                        style="display: none;"
                    >

                    {{-- Quick Replies Dropdown Popover --}}
                    <div
                        x-show="quickReplyOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 transform translate-y-2 scale-98"
                        x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 transform translate-y-2 scale-98"
                        x-cloak
                        class="cl-quick-reply-dropdown"
                    >
                        <div class="cl-quick-reply-header">
                            <div class="cl-quick-reply-title">
                                <span>⚡</span>
                                <span>Phím tắt & Tin nhắn mẫu</span>
                            </div>
                            <div class="cl-quick-reply-hint">
                                <span><kbd>↑↓</kbd> Chọn</span>
                                <span><kbd>Enter</kbd> Chèn</span>
                                <span><kbd>Esc</kbd> Đóng</span>
                                <a
                                    href="/cuulongteam/chat-quick-replies"
                                    target="_blank"
                                    class="cl-quick-reply-manage-link"
                                    title="Mở trang Quản lý phím tắt & Tin nhắn mẫu trong tab mới"
                                >
                                    ⚙️ Quản lý
                                </a>
                                <button
                                    type="button"
                                    @click="quickReplyOpen = false"
                                    class="cl-quick-reply-close-btn"
                                    title="Đóng bảng gợi ý"
                                >&times;</button>
                            </div>
                        </div>
                        <div class="cl-quick-reply-list">
                            <template x-for="(qr, idx) in filteredQuickReplies" :key="qr.id">
                                <div
                                    @click="insertQuickReply(qr)"
                                    :class="{'is-selected': idx === quickReplyIndex}"
                                    class="cl-quick-reply-item"
                                >
                                    <div class="cl-quick-reply-badge" x-text="qr.shortcut"></div>
                                    <div class="cl-quick-reply-info">
                                        <div class="cl-quick-reply-name">
                                            <span x-text="qr.title" style="font-weight: 700; color: #0f172a;"></span>
                                            <span x-text="qr.category" class="cl-quick-reply-cat"></span>
                                        </div>
                                        <div class="cl-quick-reply-snippet" x-text="qr.content"></div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="filteredQuickReplies.length === 0" class="cl-quick-reply-empty">
                                Không tìm thấy tin nhắn mẫu nào phù hợp với từ khóa "<span x-text="quickReplyQuery"></span>"
                            </div>
                        </div>
                    </div>

                    {{-- Emoji Picker Popover --}}
                    <div
                        x-show="showEmojiPicker"
                        x-transition
                        x-cloak
                        class="cl-emoji-picker-dropdown"
                    >
                        <div class="cl-emoji-grid">
                            <template x-for="emo in emojis" :key="emo">
                                <button
                                    type="button"
                                    @click="insertEmoji(emo)"
                                    class="cl-emoji-btn"
                                    x-text="emo"
                                ></button>
                            </template>
                        </div>
                    </div>

                    {{-- Attachment Preview Chips --}}
                    @if(!empty($attachments))
                        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 8px;">
                            @foreach($attachments as $idx => $file)
                                <div style="display: inline-flex; align-items: center; gap: 6px; padding: 3px 8px; border-radius: 6px; background: #eff6ff; border: 1px solid #bfdbfe; font-size: 11px; color: #1e40af;">
                                    <span>📎 {{ $file->getClientOriginalName() }}</span>
                                    <button
                                        type="button"
                                        wire:click="removeAttachment({{ $idx }})"
                                        style="border: none; background: transparent; color: #ef4444; cursor: pointer; padding: 0; font-weight: 700;"
                                    >&times;</button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Main Composer Box --}}
                    <div class="cl-composer-box">
                        {{-- Toolbar Row --}}
                        <div class="cl-composer-toolbar">
                            <div class="cl-composer-tools-left">
                                {{-- 📎 Attachment button --}}
                                <button
                                    type="button"
                                    onclick="document.getElementById('cl-attachment-input').click()"
                                    class="cl-composer-tool-btn"
                                    title="Đính kèm tệp tài liệu"
                                >
                                    📎
                                </button>

                                {{-- 😊 Emoji button --}}
                                <button
                                    type="button"
                                    @click="showEmojiPicker = !showEmojiPicker; quickReplyOpen = false;"
                                    :class="{'is-active': showEmojiPicker}"
                                    class="cl-composer-tool-btn"
                                    title="Chèn biểu tượng cảm xúc"
                                >
                                    😊
                                </button>

                                {{-- 🖼️ Image button --}}
                                <button
                                    type="button"
                                    onclick="document.getElementById('cl-image-input').click()"
                                    class="cl-composer-tool-btn"
                                    title="Gửi hình ảnh"
                                >
                                    🖼️
                                </button>

                                {{-- ⚡ Quick reply button --}}
                                <button
                                    type="button"
                                    @click="quickReplyOpen = !quickReplyOpen; quickReplyQuery = ''; quickReplyIndex = 0; showEmojiPicker = false;"
                                    :class="{'is-active': quickReplyOpen}"
                                    class="cl-composer-tool-btn"
                                    title="Mở danh sách phím tắt (/...)"
                                >
                                    ⚡
                                </button>

                                {{-- ⚙️ Direct link to Quick Replies Page --}}
                                <a
                                    href="/cuulongteam/chat-quick-replies"
                                    target="_blank"
                                    class="cl-composer-tool-btn"
                                    title="Quản lý Phím tắt & Mẫu tin (Mở trang riêng)"
                                    style="text-decoration: none;"
                                >
                                    ⚙️
                                </a>
                            </div>

                            <div class="cl-composer-shortcuts-hint">
                                <span><kbd>Enter</kbd> Gửi</span>
                                <span><kbd>Shift + Enter</kbd> Xuống dòng</span>
                                <span><kbd>/</kbd> Phím tắt</span>
                            </div>
                        </div>

                        {{-- Textarea and Fixed Send Button --}}
                        <div style="display: flex; align-items: flex-end; gap: 10px;">
                            <textarea
                                wire:model="replyMessage"
                                id="reply-message-input"
                                rows="1"
                                placeholder="Nhập tin nhắn phản hồi cho khách hàng (Gõ / để dùng tin nhắn mẫu, Enter để gửi)..."
                                @input="onComposerInput($event); resizeComposer($el);"
                                @keydown="onComposerKeyDown($event)"
                                x-init="resizeComposer($el); $nextTick(() => resizeComposer($el)); $watch('replyMessage', () => { resizeComposer($el); $nextTick(() => resizeComposer($el)); }); $watch('messageInputText', () => { resizeComposer($el); $nextTick(() => resizeComposer($el)); })"
                                class="cl-composer-textarea"
                                style="border: none !important; outline: none !important; box-shadow: none !important; -webkit-box-shadow: none !important; background: transparent !important;"
                            ></textarea>

                            <button
                                type="button"
                                @click="sendOptimisticReply()"
                                :disabled="isSubmitting || (!messageInputText.trim() && {{ empty($attachments) ? 'true' : 'false' }})"
                                class="cl-composer-send-btn"
                                title="Gửi tin nhắn phản hồi (Enter)"
                            >
                                <template x-if="isSubmitting">
                                    <svg style="width: 16px; height: 16px; animation: spin 1s linear infinite;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
                                        <path d="M12 2a10 10 0 0 1 10 10"/>
                                    </svg>
                                </template>
                                <template x-if="!isSubmitting">
                                    <svg style="width: 16px; height: 16px; transform: rotate(-45deg) translateX(1px);" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                </template>
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
                    <p style="font-size: 12px; max-width: 300px; color: #94a3b8; margin: 0;">Chọn một cuộc trò chuyện từ danh sách bên trái để phản hồi khách hàng.</p>
                </div>
            @endif
        </div>

        {{-- ========================================================
             COLUMN 3: CUSTOMER 360 PROFILE & ACTIONS (300px)
             ======================================================== --}}
        @if($this->selectedConversation)
            @php
                $ctxSel = $this->selectedConversation;
                $ctxInfo = $this->getCustomerInfo($ctxSel->visitor, $ctxSel);
            @endphp
            <div class="cl-col-profile cl-scroll-y">
                {{-- Header --}}
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 8px; border-bottom: 1px solid #f1f5f9; flex-shrink: 0;">
                    <h4 style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin: 0;">
                        Thông tin khách hàng
                    </h4>
                    <span style="font-size: 11px; font-weight: 600; color: #64748b;">
                        Customer 360
                    </span>
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
                    @if($ctxInfo['is_online'])
                        <div style="color: #10b981; font-size: 11.5px; font-weight: 600; display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                            <span style="width: 6px; height: 6px; border-radius: 9999px; background: #10b981;"></span>
                            Đang trực tuyến
                        </div>
                    @else
                        <div style="color: #94a3b8; font-size: 11.5px; font-weight: 500; display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                            <span style="width: 6px; height: 6px; border-radius: 9999px; background: #94a3b8;"></span>
                            Ngoại tuyến
                        </div>
                    @endif
                </div>

                {{-- Contact Details List --}}
                <div style="display: flex; flex-direction: column; gap: 10px; font-size: 12px; background: #f8fafc; padding: 10px 12px; border-radius: 12px; border: 1px solid #f1f5f9;">
                    {{-- Phone --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; color: #334155;">
                        <span style="color: #64748b;">SĐT:</span>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <span style="font-weight: 600; color: #0f172a;">{{ $ctxInfo['phone'] }}</span>
                            @if($ctxInfo['phone'] !== 'Chưa cung cấp')
                                <a href="tel:{{ $ctxInfo['phone'] }}" style="color: #2563eb;" title="Gọi">
                                    <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Email --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; color: #334155;">
                        <span style="color: #64748b;">Email:</span>
                        <span style="font-weight: 600; color: #0f172a; max-width: 170px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $ctxInfo['email'] }}">
                            {{ $ctxInfo['email'] }}
                        </span>
                    </div>

                    {{-- Location --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; color: #334155;">
                        <span style="color: #64748b;">Khu vực:</span>
                        <span style="font-weight: 600; color: #0f172a;">{{ $ctxInfo['city'] }}</span>
                    </div>
                </div>

                {{-- Lead Stage Management --}}
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                        <h4 style="font-size: 12px; font-weight: 700; color: #0f172a; margin: 0;">
                            Giai đoạn khách hàng
                        </h4>
                        <span style="font-size: 11px; font-weight: 600; color: #ff5400;">
                            {{ $ctxInfo['lead_status_label'] }}
                        </span>
                    </div>
                    <select
                        wire:change="updateLeadStatus($event.target.value)"
                        style="width: 100%; font-size: 11.5px; padding: 6px 10px; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; color: #334155; outline: none; cursor: pointer; box-sizing: border-box;"
                    >
                        <option value="new" {{ $ctxInfo['lead_status'] === 'new' ? 'selected' : '' }}>Mới (New)</option>
                        <option value="contacting" {{ $ctxInfo['lead_status'] === 'contacting' ? 'selected' : '' }}>Đang liên hệ (Contacting)</option>
                        <option value="quoted" {{ $ctxInfo['lead_status'] === 'quoted' ? 'selected' : '' }}>Đã báo giá (Quoted)</option>
                        <option value="deal_closed" {{ $ctxInfo['lead_status'] === 'deal_closed' ? 'selected' : '' }}>Chốt hợp đồng (Deal Closed)</option>
                        <option value="cancelled" {{ $ctxInfo['lead_status'] === 'cancelled' ? 'selected' : '' }}>Hủy (Cancelled)</option>
                    </select>
                </div>

                {{-- Customer Tags --}}
                <div>
                    <h4 style="font-size: 12px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
                        Thẻ phân loại
                    </h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 6px; align-items: center;">
                        @if(!empty($ctxInfo['tags']) && is_array($ctxInfo['tags']))
                            @foreach($ctxInfo['tags'] as $tagItem)
                                <span class="cl-tag-badge">
                                    <span>{{ $tagItem }}</span>
                                    <button
                                        type="button"
                                        wire:click="removeTag('{{ $tagItem }}')"
                                        class="cl-tag-remove-btn"
                                        title="Xóa thẻ"
                                    >×</button>
                                </span>
                            @endforeach
                        @endif
                    </div>

                    {{-- Add Tag Input --}}
                    <div style="display: flex; gap: 6px; margin-top: 8px;">
                        <input
                            type="text"
                            wire:model="newTagInput"
                            @keydown.enter.prevent="$wire.addTag($wire.newTagInput)"
                            placeholder="Nhập tên thẻ mới..."
                            style="flex: 1; font-size: 11.5px; padding: 5px 8px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box;"
                        />
                        <button
                            type="button"
                            wire:click="addTag(newTagInput)"
                            style="padding: 5px 10px; font-size: 11px; font-weight: 600; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; color: #2563eb; cursor: pointer;"
                        >
                            + Thêm
                        </button>
                    </div>
                </div>

                {{-- SOURCE URL & VISITOR TRACKING --}}
                <div style="border-top: 1px solid #f1f5f9; padding-top: 12px;">
                    <h4 style="font-size: 12px; font-weight: 700; color: #0f172a; margin: 0 0 10px 0; display: flex; align-items: center; justify-content: space-between;">
                        <span>Nguồn truy cập</span>
                        <span style="font-size: 10.5px; color: #2563eb; font-weight: 600; background: #eff6ff; padding: 2px 8px; border-radius: 9999px; border: 1px solid #bfdbfe;">
                            {{ $ctxInfo['channel'] }}
                        </span>
                    </h4>

                    <div style="display: flex; flex-direction: column; gap: 10px; font-size: 11.5px; color: #334155;">
                        {{-- Nguồn giới thiệu (Referrer) --}}
                        <div style="background: #f8fafc; padding: 8px 10px; border-radius: 8px; border: 1px solid #f1f5f9;">
                            <span style="color: #64748b; font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Nguồn giới thiệu:</span>
                            <div style="font-weight: 600; color: #0f172a; margin-top: 3px; display: flex; align-items: center; gap: 4px;">
                                @if(empty($ctxInfo['referrer']) || $ctxInfo['referrer'] === 'Truy cập trực tiếp (Direct)')
                                    <span style="color: #475569;">Truy cập trực tiếp (Direct)</span>
                                @else
                                    <svg style="width: 12px; height: 12px; color: #2563eb; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                    </svg>
                                    <span style="color: #0369a1; word-break: break-all;">{{ $ctxInfo['referrer'] }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Trang bắt đầu (Landing Page) --}}
                        <div style="background: #f8fafc; padding: 8px 10px; border-radius: 8px; border: 1px solid #f1f5f9;">
                            <span style="color: #64748b; font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Trang bắt đầu (Landing):</span>
                            <div style="font-weight: 600; color: #0f172a; margin-top: 3px; line-height: 1.4;">
                                {{ $ctxInfo['source_title'] }}
                            </div>
                            @if(!empty($ctxInfo['source_path']))
                                <div style="font-size: 11px; color: #0284c7; margin-top: 2px; word-break: break-all;">
                                    {{ $ctxInfo['source_path'] }}
                                </div>
                            @endif
                            @if(!empty($ctxInfo['source_url']) && \Illuminate\Support\Str::startsWith($ctxInfo['source_url'], ['http://', 'https://', '/']))
                                <div style="margin-top: 6px;">
                                    <a
                                        href="{{ $ctxInfo['source_url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="cl-btn-action"
                                        style="display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; color: #2563eb; background: #eff6ff; border-color: #bfdbfe; text-decoration: none; padding: 5px 10px;"
                                    >
                                        <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        <span>Mở trang bắt đầu</span>
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Trang đang xem hiện tại (Realtime) nếu khác trang bắt đầu --}}
                        @if(!empty($ctxInfo['current_page']) && $ctxInfo['current_page'] !== $ctxInfo['source_url'])
                            <div style="background: #eff6ff; padding: 8px 10px; border-radius: 8px; border: 1px solid #bfdbfe;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <span style="color: #1d4ed8; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Đang xem (Realtime):</span>
                                    <span style="width: 6px; height: 6px; border-radius: 9999px; background: #10b981;"></span>
                                </div>
                                <div style="font-weight: 600; color: #1e3a8a; margin-top: 3px; line-height: 1.4;">
                                    {{ $ctxInfo['current_page_title'] ?: $ctxInfo['current_page'] }}
                                </div>
                                <div style="margin-top: 6px;">
                                    <a
                                        href="{{ $ctxInfo['current_page'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        style="display: inline-flex; align-items: center; gap: 4px; font-size: 11px; color: #1d4ed8; text-decoration: none; word-break: break-all; background: #ffffff; padding: 4px 8px; border-radius: 6px; border: 1px solid #bfdbfe;"
                                    >
                                        <svg style="width: 11px; height: 11px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        <span>{{ $ctxInfo['current_page'] }}</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Thiết bị & Trình duyệt --}}
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; margin-top: 2px; background: #f8fafc; padding: 8px 10px; border-radius: 8px; border: 1px solid #f1f5f9;">
                            <div>
                                <span style="color: #64748b; font-size: 10px;">Thiết bị:</span>
                                <div style="font-weight: 600; color: #0f172a; font-size: 11px;">{{ $ctxInfo['device_type'] }}</div>
                            </div>
                            <div>
                                <span style="color: #64748b; font-size: 10px;">Trình duyệt:</span>
                                <div style="font-weight: 600; color: #0f172a; font-size: 11px;">{{ $ctxInfo['browser'] }}</div>
                            </div>
                            <div>
                                <span style="color: #64748b; font-size: 10px;">Hệ điều hành:</span>
                                <div style="font-weight: 600; color: #0f172a; font-size: 11px;">{{ $ctxInfo['os'] }}</div>
                            </div>
                            <div>
                                <span style="color: #64748b; font-size: 10px;">Hoạt động:</span>
                                <div style="font-weight: 600; color: #0f172a; font-size: 11px;">{{ $ctxInfo['last_seen'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div style="display: flex; flex-direction: column; gap: 8px; margin-top: auto; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                    <h4 style="font-size: 12px; font-weight: 700; color: #0f172a; margin: 0 0 2px 0;">
                        Hành động CSKH
                    </h4>

                    {{-- Gửi báo giá --}}
                    <button
                        type="button"
                        wire:click="openQuoteModal"
                        class="cl-btn-quote"
                    >
                        <svg style="width: 14px; height: 14px; transform: rotate(-45deg) translateX(1px);" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                        <span>Gửi báo giá dịch vụ</span>
                    </button>

                    {{-- Tạo yêu cầu tư vấn --}}
                    <button
                        type="button"
                        wire:click="createConsultation"
                        class="cl-btn-action"
                    >
                        <svg style="width: 14px; height: 14px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span>Tạo Yêu Cầu Tư Vấn</span>
                    </button>

                    {{-- Đánh dấu spam --}}
                    <button
                        type="button"
                        wire:click="markAsSpam"
                        class="cl-btn-action"
                        style="color: #ea580c;"
                    >
                        <svg style="width: 14px; height: 14px; color: #ea580c;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                        </svg>
                        <span>Đánh dấu Spam</span>
                    </button>

                    {{-- Xóa phiên chat vĩnh viễn --}}
                    <button
                        type="button"
                        wire:click="deleteConversation"
                        wire:confirm="Bạn có chắc chắn muốn xóa vĩnh viễn toàn bộ phiên trò chuyện này không? Hành động này không thể hoàn tác."
                        class="cl-btn-action"
                        style="color: #ef4444; border-color: #fecaca; background: #fff5f5;"
                    >
                        <svg style="width: 14px; height: 14px; color: #ef4444;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span style="font-weight: 600;">Xóa phiên chat</span>
                    </button>
                </div>
            </div>
        @endif

        {{-- ========================================================
             BOTTOM-RIGHT FLOATING NOTIFICATION POPUP (TOAST)
             ======================================================== --}}
        <div
            x-show="popupVisible"
            x-cloak
            class="cl-inbox-toast"
        >
            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
                <div style="display: flex; align-items: center; gap: 6px;">
                    <span style="width: 8px; height: 8px; border-radius: 9999px; background: #ff5400; display: inline-block;"></span>
                    <span style="font-size: 11px; font-weight: 700; color: #ff5400; text-transform: uppercase; letter-spacing: 0.04em;">
                        Tin nhắn mới
                    </span>
                    <template x-if="popupData.count > 1">
                        <span style="font-size: 10px; font-weight: 700; background: #ff5400; color: #fff; padding: 0 5px; border-radius: 9999px;" x-text="popupData.count"></span>
                    </template>
                </div>
                <button
                    type="button"
                    @click="dismissPopup()"
                    style="border: none; background: transparent; color: #94a3b8; cursor: pointer; padding: 0; font-size: 14px; line-height: 1;"
                >×</button>
            </div>

            <div style="margin-top: 6px;">
                <h5 style="font-size: 12.5px; font-weight: 700; color: #0f172a; margin: 0;" x-text="popupData.customer_name"></h5>
                <p style="font-size: 11.5px; color: #475569; margin: 3px 0 0 0; line-height: 1.35; max-height: 38px; overflow: hidden; text-overflow: ellipsis;" x-text="popupData.preview"></p>
            </div>

            <div style="margin-top: 10px; display: flex; justify-content: flex-end;">
                <button
                    type="button"
                    @click="openFromPopup()"
                    style="padding: 5px 12px; font-size: 11.5px; font-weight: 700; border-radius: 8px; border: none; background: #ff5400; color: #ffffff; cursor: pointer; box-shadow: 0 2px 6px rgba(255, 84, 0, 0.3);"
                >
                    Xem cuộc trò chuyện
                </button>
            </div>
        </div>

        {{-- ========================================================
             QUOTATION SELECTION & SEND MODAL
             ======================================================== --}}
        @if($showQuoteModal)
            <div class="cl-quote-modal-backdrop" wire:click.self="closeQuoteModal">
                <div class="cl-quote-modal-card">
                    <div class="cl-quote-modal-header">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 36px; height: 36px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 15px; font-weight: 800; color: #0f172a; margin: 0;">
                                    Gửi Báo Giá Dịch Vụ Cho Khách Hàng
                                </h3>
                                <p style="font-size: 11.5px; color: #64748b; margin: 2px 0 0 0;">
                                    Dữ liệu bảng giá chính thức từ hệ thống Truyền Thông Cửu Long (không hard-code).
                                </p>
                            </div>
                        </div>
                        <button
                            type="button"
                            wire:click="closeQuoteModal"
                            style="border: none; background: transparent; font-size: 20px; color: #94a3b8; cursor: pointer; padding: 4px;"
                        >&times;</button>
                    </div>

                    <div class="cl-quote-modal-body">
                        @if($this->pricingPlans->isEmpty())
                            <div style="padding: 24px; text-align: center; background: #fffbeb; border: 1px dashed #fcd34d; border-radius: 12px; color: #92400e;">
                                <p style="font-weight: 700; margin: 0 0 6px 0;">Chức năng hiện tại chưa có nguồn dữ liệu bảng giá đủ để tự động gửi báo giá.</p>
                                <p style="font-size: 12px; margin: 0 0 14px 0;">Vui lòng thêm các gói dịch vụ tại module Bảng Giá Dịch Vụ trước khi gửi báo giá.</p>
                                <a
                                    href="/cuulongteam/pricing-plans"
                                    target="_blank"
                                    style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; background: #d97706; color: #fff; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 700;"
                                >
                                    Quản lý Bảng Giá Dịch Vụ
                                </a>
                            </div>
                        @else
                            <div style="font-size: 12px; color: #475569; margin-bottom: 4px;">
                                Chọn gói dịch vụ muốn gửi báo giá cho khách:
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($this->pricingPlans as $plan)
                                    <div
                                        wire:click="selectQuotePlan({{ $plan->id }})"
                                        class="cl-quote-plan-card {{ $selectedPricingPlanId === $plan->id ? 'is-selected' : '' }}"
                                    >
                                        <div style="display: flex; align-items: center; justify-content: space-between;">
                                            <div style="display: flex; align-items: center; gap: 8px;">
                                                <input
                                                    type="radio"
                                                    name="quote_plan"
                                                    value="{{ $plan->id }}"
                                                    wire:model.live="selectedPricingPlanId"
                                                    style="cursor: pointer;"
                                                >
                                                <span style="font-weight: 700; font-size: 13.5px; color: #0f172a;">
                                                    {{ $plan->tier_name }}
                                                </span>
                                                <span style="font-size: 10.5px; font-weight: 600; padding: 2px 7px; border-radius: 9999px; background: {{ $plan->category_bg }}; color: {{ $plan->category_text }};">
                                                    {{ $plan->category_label }}
                                                </span>
                                                @if($plan->is_featured)
                                                    <span style="font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 4px; background: #fef08a; color: #854d0e;">
                                                        ★ Phổ biến
                                                    </span>
                                                @endif
                                            </div>

                                            <div style="text-align: right;">
                                                <span style="font-size: 13.5px; font-weight: 800; color: #2563eb;">
                                                    {{ $plan->price_display }}
                                                </span>
                                                @if($plan->price_note)
                                                    <div style="font-size: 10.5px; color: #64748b;">
                                                        {{ $plan->price_note }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if($plan->description)
                                            <p style="font-size: 11.5px; color: #64748b; margin: 2px 0 0 24px; line-height: 1.4;">
                                                {{ $plan->description }}
                                            </p>
                                        @endif

                                        @if(!empty($plan->features) && is_array($plan->features))
                                            <div style="margin: 4px 0 0 24px; display: flex; flex-wrap: wrap; gap: 4px;">
                                                @foreach(array_slice($plan->features, 0, 3) as $feat)
                                                    <span style="font-size: 10.5px; color: #475569; background: #f1f5f9; padding: 1px 6px; border-radius: 4px;">
                                                        ✓ {{ $feat }}
                                                    </span>
                                                @endforeach
                                                @if(count($plan->features) > 3)
                                                    <span style="font-size: 10.5px; color: #94a3b8;">+{{ count($plan->features) - 3 }} tính năng</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="cl-quote-modal-footer">
                        <button
                            type="button"
                            wire:click="closeQuoteModal"
                            style="padding: 7px 14px; font-size: 12px; font-weight: 600; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #475569; cursor: pointer;"
                        >
                            Hủy bỏ
                        </button>

                        @if(!$this->pricingPlans->isEmpty())
                            <button
                                type="button"
                                wire:click="sendQuotation()"
                                style="padding: 7px 14px; font-size: 12px; font-weight: 700; border-radius: 8px; border: 1px solid #93c5fd; background: #eff6ff; color: #2563eb; cursor: pointer;"
                                title="Tự động chọn gói phù hợp nhất theo chủ đề hội thoại"
                            >
                                Gửi gói phù hợp nhất
                            </button>

                            <button
                                type="button"
                                wire:click="sendQuotation({{ $selectedPricingPlanId }})"
                                @disabled(!$selectedPricingPlanId)
                                style="padding: 7px 18px; font-size: 12px; font-weight: 700; border-radius: 8px; border: none; background: #2563eb; color: #ffffff; cursor: pointer; box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3); opacity: {{ $selectedPricingPlanId ? '1' : '0.5' }};"
                            >
                                Gửi Báo Giá Ngay
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>

