@php
    $pollInterval = (int) config('chat.widget_poll_interval_ms', 1000);
    $maxInputLength = (int) config('chat.widget_max_input_length', 2000);
@endphp

<div
    id="chat-widget-root"
    x-data="clmChatWidget({
        pollInterval: {{ $pollInterval }},
        maxInputLength: {{ $maxInputLength }},
    })"
    x-init="initWidget()"
    x-cloak
    class="clm-chat-widget-root font-sans"
    style="position: relative; z-index: 99990 !important;"
    @keydown.escape.window="if (isOpen) closeWidget()"
>
    <!-- ==================== CHAT FAB BUTTON ==================== -->
    <div class="fixed bottom-5 right-4 sm:bottom-6 sm:right-6 flex items-center justify-center" style="z-index: 99995 !important;">
        <button
            type="button"
            id="chat-fab-button"
            @click="toggleWidget()"
            class="relative group w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-orange-600 via-orange-500 to-amber-500 text-white shadow-xl hover:shadow-orange-500/30 flex items-center justify-center transform hover:scale-105 active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-orange-500/40"
            :aria-expanded="isOpen.toString()"
            aria-controls="clm-chat-window"
            :aria-label="isOpen ? 'Đóng cửa sổ hỗ trợ chat' : 'Mở chat hỗ trợ trực tuyến với Truyền Thông Cửu Long'"
        >
            <!-- Pulsing Halo Animation -->
            <span
                x-show="!isOpen"
                class="absolute -inset-1 rounded-full bg-orange-500/40 blur-sm animate-ping pointer-events-none opacity-75"
            ></span>

            <!-- Unread Badge -->
            <span
                x-show="unreadCount > 0 && !isOpen"
                x-transition
                class="absolute -top-1 -right-1 min-w-[22px] h-[22px] px-1.5 rounded-full bg-red-600 text-white text-xs font-bold flex items-center justify-center border-2 border-[#080C16] shadow-md z-10"
                x-text="unreadCount > 99 ? '99+' : unreadCount"
            ></span>

            <!-- FAB Icons (Instant Inline SVGs, Zero FOUT) -->
            <svg
                x-show="!isOpen"
                class="w-7 h-7 sm:w-8 sm:h-8 text-white transition-transform duration-300 group-hover:rotate-12 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <svg
                x-show="isOpen"
                class="w-7 h-7 sm:w-8 sm:h-8 text-white transition-transform duration-300 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2.5"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- ==================== CHAT WINDOW MODAL / DRAWER ==================== -->
    <div
        id="chat-window-modal"
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-8 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-8 sm:scale-95"
        role="region"
        aria-label="Hộp thoại chat hỗ trợ khách hàng"
        class="fixed inset-0 sm:inset-auto sm:bottom-24 sm:right-6 w-full sm:w-[390px] h-[100dvh] sm:h-[580px] bg-[#070F1E] sm:bg-[#070F1E]/95 sm:backdrop-blur-2xl border-0 sm:border sm:border-white/10 sm:rounded-2xl shadow-2xl flex flex-col overflow-hidden"
        style="z-index: 99999 !important;"
    >
        <!-- Header -->
        <div class="px-4 py-3.5 bg-gradient-to-r from-[#0B1528] via-[#0F1E3A] to-[#122448] border-b border-white/10 flex items-center justify-between shrink-0 shadow-md">
            <div class="flex items-center gap-3">
                <div class="relative w-9 h-9 rounded-full bg-gradient-to-tr from-orange-600 to-amber-500 p-0.5 shadow-md flex items-center justify-center">
                    <img src="{{ asset('images/logo-ttcl.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full bg-[#080C16] p-0.5" />
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-[#0B1528]"></span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white tracking-wide flex items-center gap-1.5">
                        Truyền Thông Cửu Long
                    </h3>
                    <p class="text-[11px] text-slate-400 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span x-text="headerSubtitle">Hỗ trợ trực tuyến</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-1">
                <!-- New conversation button -->
                <button
                    type="button"
                    @click="confirmNewConversation()"
                    class="p-1.5 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition-colors focus:outline-none"
                    title="Bắt đầu cuộc trò chuyện mới"
                    aria-label="Bắt đầu cuộc trò chuyện mới"
                >
                    <span class="material-symbols-outlined text-[20px]">restart_alt</span>
                </button>

                <!-- Close button -->
                <button
                    type="button"
                    @click="closeWidget()"
                    class="p-1.5 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition-colors focus:outline-none"
                    title="Đóng chat"
                    aria-label="Đóng chat"
                >
                    <span class="material-symbols-outlined text-[22px]">close</span>
                </button>
            </div>
        </div>

        <!-- System / Network Error Banner -->
        <div
            x-show="errorMessage"
            x-transition
            class="px-3.5 py-2 bg-red-950/80 border-b border-red-500/20 text-red-200 text-xs flex items-center justify-between shrink-0"
        >
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-red-400">error</span>
                <span x-text="errorMessage"></span>
            </div>
            <button
                type="button"
                @click="errorMessage = null"
                class="text-red-300 hover:text-white text-xs ml-2 font-bold focus:outline-none"
                aria-label="Đóng thông báo lỗi"
            >&times;</button>
        </div>

        <!-- Closed Conversation Banner -->
        <div
            x-show="conversation && conversation.status === 'closed'"
            class="p-3 bg-amber-950/60 border-b border-amber-500/20 text-amber-200 text-xs flex items-center justify-between shrink-0"
        >
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-amber-400">check_circle</span>
                <span>Cuộc trò chuyện này đã kết thúc.</span>
            </div>
            <button
                type="button"
                @click="startNewConversation()"
                class="px-2.5 py-1 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded text-[11px] transition shadow"
            >
                Tạo mới
            </button>
        </div>

        <!-- Spam Conversation Banner -->
        <div
            x-show="conversation && conversation.status === 'spam'"
            class="p-3 bg-red-950/80 border-b border-red-500/30 text-red-300 text-xs flex items-center gap-2 shrink-0"
        >
            <span class="material-symbols-outlined text-sm text-red-400">block</span>
            <span>Hội thoại đã bị hạn chế do vi phạm chính sách gửi tin nhắn.</span>
        </div>

        <!-- ==================== MESSAGES LIST ==================== -->
        <div
            x-ref="messagesContainer"
            @scroll="handleScroll()"
            class="flex-1 overflow-y-auto px-4 py-4 space-y-3.5 scroll-smooth overscroll-contain"
        >
            <!-- Loading Indicator -->
            <div x-show="isLoading" class="flex flex-col items-center justify-center py-8 text-slate-400 text-xs gap-2">
                <div class="w-6 h-6 border-2 border-orange-500 border-t-transparent rounded-full animate-spin"></div>
                <span>Đang kết nối hội thoại...</span>
            </div>

            <!-- Welcome Greeting when empty -->
            <div x-show="!isLoading && messages.length === 0" class="text-center py-8 px-4">
                <div class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-orange-400">
                    <span class="material-symbols-outlined text-2xl">support_agent</span>
                </div>
                <h4 class="text-sm font-semibold text-white mb-1">Xin chào quý khách!</h4>
                <p class="text-xs text-slate-400 leading-relaxed max-w-[240px] mx-auto">
                    Chúng tôi có thể giúp gì cho quý khách về dịch vụ sản xuất media hoặc giải pháp công nghệ?
                </p>
            </div>

            <!-- Message Items -->
            <template x-for="msg in messages" :key="msg.message_uuid">
                <div
                    class="flex flex-col"
                    :class="msg.sender_type === 'visitor' ? 'items-end' : 'items-start'"
                >
                    <!-- Sender Name / Label -->
                    <span
                        x-show="msg.sender_type !== 'visitor'"
                        class="text-[10px] text-slate-400 font-medium mb-1 px-1 flex items-center gap-1"
                    >
                        <span class="material-symbols-outlined text-[12px] text-orange-400" x-text="msg.sender_type === 'bot' ? 'smart_toy' : 'support_agent'"></span>
                        <span x-text="msg.sender_type === 'bot' ? 'Cửu Long AI' : (msg.sender_type === 'system' ? 'Hệ thống' : 'Nhân viên tư vấn')"></span>
                    </span>

                    <!-- Bubble Container with Hover Actions -->
                    <div class="relative group max-w-[85%]">
                        <!-- Visitor Message Actions Trigger (3 dots) -->
                        <div
                            x-show="msg.sender_type === 'visitor' && !msg.recalled && isEditableOrRecallable(msg)"
                            class="absolute top-1/2 -translate-y-1/2 -left-8 opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1"
                        >
                            <button
                                type="button"
                                @click="openMessageActions(msg)"
                                class="p-1 text-slate-400 hover:text-white rounded hover:bg-white/10 transition focus:outline-none"
                                title="Tùy chọn tin nhắn"
                                aria-label="Tùy chọn tin nhắn"
                            >
                                <span class="material-symbols-outlined text-[16px]">more_vert</span>
                            </button>
                        </div>

                        <!-- Recalled Message Bubble -->
                        <div
                            x-show="msg.recalled"
                            class="px-3.5 py-2.5 rounded-2xl rounded-tr-sm bg-slate-900/60 border border-slate-700/60 text-slate-400 text-xs italic flex items-center gap-1.5"
                        >
                            <span class="material-symbols-outlined text-sm text-slate-500">undo</span>
                            <span>Tin nhắn đã được thu hồi</span>
                        </div>

                        <!-- Active Message Bubble (XSS Safe: STRICT TEXT BINDING ONLY) -->
                        <div
                            x-show="!msg.recalled"
                            class="px-3.5 py-2.5 text-xs sm:text-[13px] leading-relaxed break-words shadow-sm"
                            :class="msg.sender_type === 'visitor'
                                ? 'bg-gradient-to-tr from-orange-600 to-amber-600 text-white rounded-2xl rounded-tr-xs'
                                : 'bg-[#101F38] text-slate-100 border border-white/10 rounded-2xl rounded-tl-xs'"
                        >
                            <span class="whitespace-pre-wrap select-text" x-show="msg.message && !msg.recalled && !msg.deleted" x-text="msg.message"></span>

                            <!-- Recalled Message Notice -->
                            <div x-show="msg.recalled" class="text-xs italic text-slate-400 flex items-center gap-1.5 py-0.5">
                                <span class="material-symbols-outlined text-sm">history_toggle_off</span>
                                <span>Tin nhắn đã được thu hồi</span>
                            </div>

                            <!-- Deleted Message Notice -->
                            <div x-show="msg.deleted && !msg.recalled" class="text-xs italic text-slate-400 flex items-center gap-1.5 py-0.5">
                                <span class="material-symbols-outlined text-sm">delete_outline</span>
                                <span>Tin nhắn đã được xóa</span>
                            </div>

                            <!-- Attachments List -->
                            <div x-show="!msg.recalled && !msg.deleted && msg.attachments && msg.attachments.length > 0" class="mt-2 space-y-1.5">
                                <template x-for="att in (msg.attachments || [])" :key="att.attachment_uuid">
                                    <div class="mt-1">
                                        <!-- Image Attachment Preview -->
                                        <template x-if="att.is_image">
                                            <a :href="att.download_url" target="_blank" rel="noopener noreferrer" class="block overflow-hidden rounded-lg border border-white/20 hover:opacity-90 transition">
                                                <img :src="att.download_url" :alt="att.original_name" class="max-h-48 max-w-full object-cover rounded-lg" loading="lazy">
                                            </a>
                                        </template>

                                        <!-- Document Attachment -->
                                        <template x-if="!att.is_image">
                                            <a :href="att.download_url" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 p-2 rounded-lg bg-black/25 hover:bg-black/40 border border-white/10 text-xs transition">
                                                <span class="material-symbols-outlined text-base shrink-0">description</span>
                                                <div class="min-w-0 flex-1 truncate">
                                                    <span class="font-medium truncate block" x-text="att.original_name"></span>
                                                    <span class="text-[10px] opacity-75" x-text="formatBytes(att.file_size)"></span>
                                                </div>
                                                <span class="material-symbols-outlined text-sm shrink-0">download</span>
                                            </a>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Message Meta (Timestamp, Status, Edited) -->
                        <div
                            class="flex items-center gap-1.5 mt-1 px-1 text-[10px] text-slate-400"
                            :class="msg.sender_type === 'visitor' ? 'justify-end' : 'justify-start'"
                        >
                            <span x-text="formatTime(msg.created_at)"></span>
                            <span x-show="msg.edited_at && !msg.recalled && !msg.deleted" class="text-[9px] italic text-slate-400">· Đã chỉnh sửa</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'sending'" class="text-[9px] italic text-slate-400">Đang gửi...</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'failed'" class="text-[9px] font-semibold text-rose-400">! Gửi thất bại</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'sent'" class="material-symbols-outlined text-[11px] text-orange-400" title="Đã gửi">done</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'delivered'" class="material-symbols-outlined text-[11px] text-slate-400" title="Đã nhận">done_all</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'read'" class="material-symbols-outlined text-[11px] text-emerald-400" title="Đã xem">done_all</span>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Sending Status Bubble (Local pending) -->
            <div x-show="isSending" class="flex flex-col items-end">
                <div class="px-3 py-2 bg-orange-600/60 border border-orange-500/30 text-white/80 rounded-2xl rounded-tr-xs text-xs flex items-center gap-2 animate-pulse">
                    <div class="w-3 h-3 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    <span>Đang gửi...</span>
                </div>
            </div>

            <!-- AI Bot Typing Indicator -->
            <div x-show="isBotTyping" class="flex flex-col items-start" x-transition>
                <span class="text-[10px] text-slate-400 font-medium mb-1 px-1 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[12px] text-orange-400">smart_toy</span>
                    <span>Cửu Long AI</span>
                </span>
                <div class="px-3.5 py-2.5 bg-[#101F38] text-slate-300 border border-white/10 rounded-2xl rounded-tl-xs text-xs flex items-center gap-2">
                    <div class="flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                        <span class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                        <span class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-bounce"></span>
                    </div>
                    <span class="text-[11px] text-slate-400 italic">Cửu Long AI đang trả lời...</span>
                </div>
            </div>
        </div>

        <!-- New Messages Below Pill -->
        <div
            x-show="hasNewMessagesBelow"
            x-transition
            class="absolute bottom-20 left-1/2 -translate-x-1/2 z-20"
        >
            <button
                type="button"
                @click="scrollToBottom(true)"
                class="px-3 py-1.5 rounded-full bg-orange-600 hover:bg-orange-500 text-white text-xs font-semibold shadow-lg flex items-center gap-1.5 transition transform active:scale-95"
            >
                <span class="material-symbols-outlined text-sm">arrow_downward</span>
                <span>Tin nhắn mới</span>
            </button>
        </div>

        <!-- ==================== ACTION MODAL / INLINE EDIT ==================== -->
        <!-- Edit Message Panel -->
        <div
            x-show="editingMessageUuid"
            x-transition
            class="p-3 bg-[#0B1528] border-t border-white/10 flex flex-col gap-2 shrink-0 z-30"
        >
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span class="font-medium text-white flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs text-orange-400">edit</span>
                    Chỉnh sửa tin nhắn
                </span>
                <span class="text-[10px]">Cửa sổ tối đa 15 phút</span>
            </div>
            <textarea
                x-model="editInputText"
                maxlength="2000"
                rows="2"
                class="w-full px-3 py-2 rounded-lg bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-orange-500 resize-none"
                placeholder="Nội dung đã chỉnh sửa..."
                @keydown.enter.prevent="saveEditMessage()"
            ></textarea>
            <div class="flex items-center justify-end gap-2">
                <button
                    type="button"
                    @click="cancelEditMessage()"
                    class="px-3 py-1 rounded text-xs text-slate-300 hover:text-white hover:bg-white/10 transition"
                >Hủy</button>
                <button
                    type="button"
                    @click="saveEditMessage()"
                    :disabled="!editInputText.trim()"
                    class="px-3 py-1 rounded text-xs font-semibold bg-orange-600 hover:bg-orange-500 text-white disabled:opacity-50 transition shadow"
                >Lưu thay đổi</button>
            </div>
        </div>

        <!-- Options Popup for a Selected Message -->
        <div
            x-show="activeActionMessage"
            x-transition
            class="absolute inset-x-4 bottom-20 bg-[#0F1E3A] border border-white/15 rounded-xl p-3 shadow-2xl z-40 flex flex-col gap-1 text-xs"
            @click.away="activeActionMessage = null"
        >
            <div class="flex items-center justify-between pb-2 border-b border-white/10 text-slate-400 text-[11px]">
                <span>Tùy chọn tin nhắn</span>
                <button type="button" @click="activeActionMessage = null" class="text-slate-400 hover:text-white">&times;</button>
            </div>
            <!-- Edit Button -->
            <button
                type="button"
                x-show="activeActionMessage && canEdit(activeActionMessage)"
                @click="startEditMessage(activeActionMessage)"
                class="w-full px-2.5 py-2 rounded-lg text-left text-slate-200 hover:bg-white/10 hover:text-white flex items-center gap-2 transition"
            >
                <span class="material-symbols-outlined text-sm text-amber-400">edit</span>
                <span>Chỉnh sửa nội dung (trong 15 phút)</span>
            </button>
            <!-- Recall Button -->
            <button
                type="button"
                x-show="activeActionMessage && canRecall(activeActionMessage)"
                @click="triggerRecallMessage(activeActionMessage)"
                class="w-full px-2.5 py-2 rounded-lg text-left text-red-300 hover:bg-red-500/20 hover:text-red-200 flex items-center gap-2 transition"
            >
                <span class="material-symbols-outlined text-sm text-red-400">undo</span>
                <span>Thu hồi tin nhắn (trong 60 phút)</span>
            </button>
            <!-- Delete Button -->
            <button
                type="button"
                x-show="activeActionMessage && activeActionMessage.sender_type === 'visitor' && !activeActionMessage.deleted"
                @click="deleteMessage(activeActionMessage)"
                class="w-full px-2.5 py-2 rounded-lg text-left text-rose-300 hover:bg-rose-500/20 hover:text-rose-200 flex items-center gap-2 transition"
            >
                <span class="material-symbols-outlined text-sm text-rose-400">delete</span>
                <span>Xóa tin nhắn</span>
            </button>
        </div>

        <!-- ==================== COMPOSER AREA ==================== -->
        <div class="p-3 bg-[#070f1e] border-t border-white/10 shrink-0 shadow-lg">
            <!-- Selected Attachments Preview Chips -->
            <div x-show="selectedFiles.length > 0" class="mb-2 flex flex-wrap gap-1.5" x-cloak>
                <template x-for="(file, idx) in selectedFiles" :key="idx">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white/10 border border-white/15 text-[11px] text-slate-200 shadow-sm">
                        <span class="material-symbols-outlined text-xs text-orange-400">attach_file</span>
                        <span class="max-w-[120px] truncate" x-text="file.name"></span>
                        <span class="text-[9px] text-slate-400" x-text="formatBytes(file.size)"></span>
                        <button type="button" @click="removeSelectedFile(idx)" class="text-slate-400 hover:text-white ml-0.5" aria-label="Xóa file đính kèm">&times;</button>
                    </div>
                </template>
            </div>

            <!-- Unified Capsule Input Box -->
            <form
                @submit.prevent="submitMessage()"
                class="flex items-end gap-1.5 p-1.5 rounded-2xl bg-[#0c1830] border border-white/15 focus-within:border-orange-500/80 focus-within:ring-2 focus-within:ring-orange-500/20 transition-all duration-200 shadow-inner"
            >
                <!-- Hidden file input -->
                <input
                    type="file"
                    x-ref="attachmentInput"
                    multiple
                    accept=".jpg,.jpeg,.png,.webp,.gif,.pdf,.doc,.docx"
                    class="hidden"
                    @change="handleFileSelect($event)"
                />

                <!-- Attachment Picker Button -->
                <button
                    type="button"
                    @click="$refs.attachmentInput.click()"
                    :disabled="isComposerDisabled || isSending"
                    class="w-8 h-8 rounded-xl text-slate-400 hover:text-orange-400 hover:bg-white/10 flex items-center justify-center shrink-0 transition-colors disabled:opacity-30 disabled:cursor-not-allowed"
                    title="Đính kèm ảnh hoặc tài liệu"
                    aria-label="Đính kèm tệp"
                >
                    <span class="material-symbols-outlined text-[19px]">attach_file</span>
                </button>

                <!-- Textarea -->
                <div class="flex-1 min-w-0 relative py-1 px-1">
                    <textarea
                        id="chat-message-input"
                        x-ref="messageInput"
                        x-model="inputText"
                        :disabled="isComposerDisabled"
                        :maxlength="maxInputLength"
                        rows="1"
                        @keydown="handleKeydown($event)"
                        @input="autoGrowTextarea($el); handleTyping()"
                        placeholder="Nhập tin nhắn..."
                        aria-label="Nội dung tin nhắn"
                        class="w-full p-0 bg-transparent border-0 text-white placeholder-slate-400 text-[13px] leading-[1.4] resize-none focus:outline-none focus:ring-0 max-h-24 disabled:opacity-40 disabled:cursor-not-allowed"
                        style="min-height: 20px; box-shadow: none !important;"
                    ></textarea>

                    <!-- Character counter when near limit -->
                    <span
                        x-show="inputText.length > maxInputLength - 100"
                        class="absolute right-0 -bottom-3 text-[9px] text-amber-400 font-mono"
                        x-text="inputText.length + '/' + maxInputLength"
                        x-cloak
                    ></span>
                </div>

                <!-- Send Button -->
                <button
                    type="submit"
                    id="chat-send-btn"
                    :disabled="isComposerDisabled || (!inputText.trim() && selectedFiles.length === 0) || isSending"
                    class="w-8 h-8 rounded-xl bg-gradient-to-tr from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white flex items-center justify-center shrink-0 shadow-md disabled:opacity-30 disabled:grayscale disabled:cursor-not-allowed transition-all transform active:scale-95 focus:outline-none focus:ring-2 focus:ring-orange-500/50"
                    aria-label="Gửi tin nhắn"
                >
                    <svg class="w-4 h-4 transform rotate-45 -translate-y-0.5 -translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>

            <div class="flex items-center justify-between mt-2 px-1 text-[10px] text-slate-400 font-medium">
                <span class="flex items-center gap-1">
                    <svg class="w-2.5 h-2.5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    Bảo mật bởi Truyền Thông Cửu Long
                </span>
                <span class="text-slate-400">Enter gửi • Shift+Enter xuống dòng</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('clmChatWidget', (config) => ({
        // Configuration
        pollInterval: config.pollInterval || 1000,
        activePollInterval: config.pollInterval || 1000,
        idlePollInterval: 3000,
        idleThresholdMs: 120000, // 2 minutes
        maxInputLength: config.maxInputLength || 2000,

        // State Machine
        isOpen: false,
        sessionInitialized: false,
        visitorUuid: null,
        conversation: null,
        messages: [],
        unreadCount: 0,

        // Input & Flags
        inputText: '',
        selectedFiles: [],
        isSending: false,
        isLoading: false,
        isFetching: false,
        lastUserActivity: Date.now(),
        pollCycleCount: 0,
        errorMessage: null,

        // Edit / Recall State
        activeActionMessage: null,
        editingMessageUuid: null,
        editInputText: '',

        // UI & Polling State
        pollingTimer: null,
        isAtBottom: true,
        hasNewMessagesBelow: false,
        markReadDebounceTimer: null,
        typingDebounceTimer: null,

        get isComposerDisabled() {
            if (this.isLoading) return true;
            if (!this.conversation) return false;
            return this.conversation.status === 'closed' || this.conversation.status === 'spam';
        },

        get headerSubtitle() {
            if (!this.conversation) return 'Trực tuyến';
            if (this.conversation.status === 'waiting_customer') return 'Đang đợi bạn phản hồi';
            if (this.conversation.status === 'waiting_agent') return 'Đang chờ nhân viên kết nối';
            if (this.conversation.status === 'assigned') return 'Đã tiếp nhận';
            if (this.conversation.status === 'closed') return 'Đã kết thúc';
            if (this.conversation.status === 'spam') return 'Hạn chế';
            return 'Hỗ trợ trực tuyến';
        },

        get statusBadgeText() {
            if (this.conversation && this.conversation.channel) {
                return 'Kênh ' + this.conversation.channel;
            }
            return 'Hỗ trợ trực tuyến';
        },

        initWidget() {
            // Track user activity to adapt polling cadence
            const recordActivity = () => {
                const wasIdle = (Date.now() - this.lastUserActivity) > this.idleThresholdMs;
                this.lastUserActivity = Date.now();
                if (wasIdle && this.isOpen && this.pollingTimer) {
                    this.startPolling();
                }
            };
            window.addEventListener('mousemove', recordActivity, { passive: true });
            window.addEventListener('keydown', recordActivity, { passive: true });
            window.addEventListener('touchstart', recordActivity, { passive: true });

            // Listen for browser tab visibility changes
            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'hidden') {
                    this.stopPolling();
                } else if (this.isOpen && this.conversation) {
                    this.lastUserActivity = Date.now();
                    this.fetchMessages(true);
                    this.checkConversationStatus();
                    this.startPolling();
                }
            });

            // Send tracking heartbeat on page load
            this.sendTrackingHeartbeat();
        },

        sendTrackingHeartbeat() {
            try {
                fetch('/api/chat/tracking/heartbeat', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        current_url: window.location.href,
                        page_title: document.title,
                        referrer: document.referrer || null
                    })
                }).catch(() => {});
            } catch (e) {}
        },

        toggleWidget() {
            if (this.isOpen) {
                this.closeWidget();
            } else {
                this.openWidget();
            }
        },

        async openWidget() {
            this.isOpen = true;
            this.errorMessage = null;

            if (!this.sessionInitialized || !this.conversation) {
                await this.initSessionAndConversation();
            } else {
                await this.fetchMessages(true);
                this.startPolling();
                this.markAsRead();
            }

            this.$nextTick(() => {
                this.scrollToBottom(true);
                if (this.$refs.messageInput && !this.isComposerDisabled) {
                    this.$refs.messageInput.focus();
                }
            });
        },

        closeWidget() {
            this.isOpen = false;
            this.stopPolling();
            this.activeActionMessage = null;
            this.cancelEditMessage();
        },

        async initSessionAndConversation() {
            this.isLoading = true;
            this.errorMessage = null;

            try {
                // 1. Initialize visitor session (HttpOnly cookie set by server)
                const sessionRes = await fetch('/api/chat/session/init', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });

                if (!sessionRes.ok) {
                    if (sessionRes.status === 403) {
                        this.errorMessage = 'Truy cập của quý khách hiện đang bị giới hạn.';
                    } else if (sessionRes.status === 429) {
                        this.errorMessage = 'Quá nhiều yêu cầu. Vui lòng thử lại sau giây lát.';
                    } else {
                        this.errorMessage = 'Không thể khởi tạo phiên trò chuyện.';
                    }
                    this.isLoading = false;
                    return;
                }

                const sessionData = await sessionRes.json();
                this.visitorUuid = sessionData.visitor_uuid;
                this.sessionInitialized = true;

                // Send tracking heartbeat immediately with current page & referrer
                this.sendTrackingHeartbeat();

                // 2. Check if visitor already has an active conversation with previous history
                const listRes = await fetch('/api/chat/conversations?per_page=1', {
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });

                if (listRes.ok) {
                    const listData = await listRes.json();
                    if (listData.data && listData.data.length > 0) {
                        const existingConv = listData.data[0];
                        if (existingConv.status !== 'closed' && existingConv.status !== 'spam') {
                            this.conversation = existingConv;
                            await this.fetchMessages(true);
                            this.startPolling();
                            this.markAsRead();
                        }
                    }
                }
            } catch (err) {
                console.error('[ChatWidget] Init error:', err);
                this.errorMessage = 'Lỗi kết nối máy chủ. Vui lòng kiểm tra lại mạng.';
            } finally {
                this.isLoading = false;
                this.$nextTick(() => this.scrollToBottom(true));
            }
        },

        async fetchMessages(forceScroll = false) {
            if (this.isFetching) return;
            if (!this.conversation || !this.conversation.conversation_uuid) return;
            if (this.conversation.status === 'closed' || this.conversation.status === 'spam') {
                this.stopPolling();
                return;
            }

            this.isFetching = true;

            try {
                // Periodic conversation status refresh (every 3rd poll)
                this.pollCycleCount++;
                if (this.pollCycleCount % 3 === 0) {
                    this.checkConversationStatus();
                }

                const res = await fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/messages?per_page=100`, {
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });

                if (res.status === 401) {
                    // Session expired, re-init
                    this.sessionInitialized = false;
                    await this.initSessionAndConversation();
                    return;
                }

                if (res.status === 404) {
                    this.errorMessage = 'Cuộc trò chuyện không còn khả dụng.';
                    this.stopPolling();
                    return;
                }

                if (res.status === 403) {
                    this.errorMessage = 'Hội thoại đã bị hạn chế.';
                    this.stopPolling();
                    return;
                }

                if (!res.ok) return;

                const responseData = await res.json();
                const fetchedMessages = responseData.data || [];

                let hadNewIncoming = false;

                // Smart merge messages preventing duplicates & matching optimistic ones
                fetchedMessages.forEach(newMsg => {
                    const existingIdx = this.messages.findIndex(m =>
                        m.message_uuid === newMsg.message_uuid ||
                        (newMsg.client_message_id && m.client_message_id === newMsg.client_message_id) ||
                        (m.message_uuid && m.message_uuid.startsWith('tmp_') && m.client_message_id === newMsg.client_message_id)
                    );

                    if (existingIdx !== -1) {
                        this.messages[existingIdx] = Object.assign({}, this.messages[existingIdx], newMsg);
                    } else {
                        this.messages.push(newMsg);
                        if (newMsg.sender_type !== 'visitor') {
                            hadNewIncoming = true;
                        }
                    }
                });

                if (hadNewIncoming) {
                    if (this.isAtBottom || forceScroll) {
                        this.$nextTick(() => this.scrollToBottom(true));
                        this.markAsRead();
                    } else {
                        this.hasNewMessagesBelow = true;
                    }
                } else if (forceScroll) {
                    this.$nextTick(() => this.scrollToBottom(true));
                }
            } catch (err) {
                // Silently ignore transient network fetch errors during background polling
            } finally {
                this.isFetching = false;
            }
        },

        async checkConversationStatus() {
            if (!this.conversation || !this.conversation.conversation_uuid) return;
            try {
                const res = await fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}`, {
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });
                if (res.ok) {
                    const convData = await res.json();
                    if (convData && convData.data) {
                        const updated = convData.data;
                        this.conversation.status = updated.status;
                        this.conversation.channel = updated.channel;
                        if (updated.status === 'closed' || updated.status === 'spam') {
                            this.stopPolling();
                        }
                    }
                }
            } catch (err) {
                // Ignore transient network errors
            }
        },

        handleFileSelect(e) {
            const files = Array.from(e.target.files || []);
            if (!files.length) return;

            const allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf', 'doc', 'docx'];
            const maxFiles = 5;

            for (const f of files) {
                if (this.selectedFiles.length >= maxFiles) {
                    this.errorMessage = `Chỉ được đính kèm tối đa ${maxFiles} tệp mỗi tin nhắn.`;
                    break;
                }

                const ext = f.name.split('.').pop().toLowerCase();
                if (ext === 'svg' || f.type.includes('svg')) {
                    this.errorMessage = 'Tệp SVG không được phép tải lên vì lý do an toàn.';
                    continue;
                }

                if (!allowedExts.includes(ext)) {
                    this.errorMessage = `Định dạng .${ext} không được hỗ trợ. Chỉ cho phép ảnh hoặc tài liệu PDF/DOC.`;
                    continue;
                }

                const isImg = ['jpg', 'jpeg', 'png', 'webp', 'gif'].includes(ext);
                const maxSize = isImg ? (5 * 1024 * 1024) : (10 * 1024 * 1024);
                if (f.size > maxSize) {
                    this.errorMessage = `Tệp "${f.name}" vượt quá kích thước cho phép (${isImg ? '5MB' : '10MB'}).`;
                    continue;
                }

                this.selectedFiles.push(f);
            }

            if (this.$refs.attachmentInput) {
                this.$refs.attachmentInput.value = '';
            }
        },

        removeSelectedFile(idx) {
            this.selectedFiles.splice(idx, 1);
        },

        formatBytes(bytes) {
            if (!bytes || bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        },

        handleTyping() {
            if (!this.conversation || !this.conversation.conversation_uuid) return;
            if (this.typingDebounceTimer) clearTimeout(this.typingDebounceTimer);
            this.typingDebounceTimer = setTimeout(() => {
                fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/typing`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ is_typing: true })
                }).catch(() => {});
            }, 300);
        },

        async deleteMessage(msg) {
            if (!msg || !this.conversation) return;
            this.activeActionMessage = null;
            try {
                const res = await fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/messages/${msg.message_uuid}/delete`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });
                if (res.ok) {
                    msg.deleted = true;
                    msg.message = null;
                }
            } catch (err) {
                console.error('[ChatWidget] Delete message error:', err);
            }
        },

        handleKeydown(e) {
            if (e.key === 'Enter') {
                if (e.shiftKey) {
                    // Shift+Enter: allow normal newline in textarea
                    return;
                }
                // Enter without Shift: prevent newline and send message!
                e.preventDefault();
                this.submitMessage();
            }
        },

        async submitMessage() {
            const trimmed = this.inputText.trim();
            const hasFiles = this.selectedFiles.length > 0;
            if ((!trimmed && !hasFiles) || this.isSending || this.isComposerDisabled) return;

            if (trimmed.length > this.maxInputLength) {
                this.errorMessage = `Tin nhắn vượt quá ${this.maxInputLength} ký tự cho phép.`;
                return;
            }

            this.isSending = true;
            this.errorMessage = null;

            // Generate UUID / client ID for Optimistic UI & Idempotency
            const clientMessageId = 'vis_' + Date.now() + '_' + Math.random().toString(36).substring(2, 9);
            const tempUuid = 'tmp_' + clientMessageId;

            // Instant optimistic append
            const optMsg = {
                message_uuid: tempUuid,
                client_message_id: clientMessageId,
                sender_type: 'visitor',
                message: trimmed,
                status: 'sending',
                created_at: new Date().toISOString(),
                attachments: []
            };
            this.messages.push(optMsg);

            this.inputText = '';
            const pendingFiles = [...this.selectedFiles];
            this.selectedFiles = [];
            if (this.$refs.messageInput) {
                this.$refs.messageInput.style.height = 'auto';
            }
            this.$nextTick(() => this.scrollToBottom(true));

            try {
                // If conversation does not exist yet in database, create it now with first message!
                if (!this.conversation || !this.conversation.conversation_uuid) {
                    const convRes = await fetch('/api/chat/conversations', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            source_url: window.location.href,
                            source_path: window.location.pathname,
                            source_title: document.title,
                            referrer: document.referrer || null
                        }),
                        credentials: 'same-origin'
                    });

                    if (!convRes.ok) {
                        optMsg.status = 'failed';
                        this.errorMessage = 'Không thể tạo phiên trò chuyện.';
                        return;
                    }

                    const convData = await convRes.json();
                    this.conversation = convData.data;
                    this.startPolling();
                }

                let res;
                if (hasFiles) {
                    const formData = new FormData();
                    if (trimmed) formData.append('message', trimmed);
                    formData.append('client_message_id', clientMessageId);
                    pendingFiles.forEach(f => formData.append('attachments[]', f));

                    res = await fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/messages`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        credentials: 'same-origin',
                        body: formData
                    });
                } else {
                    res = await fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/messages`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            message: trimmed,
                            client_message_id: clientMessageId
                        })
                    });
                }

                if (res.status === 201) {
                    const data = await res.json();
                    const newMsg = data.data;

                    // Replace temporary optimistic message
                    const optIdx = this.messages.findIndex(m => m.client_message_id === clientMessageId || m.message_uuid === tempUuid);
                    if (optIdx !== -1) {
                        this.messages[optIdx] = newMsg;
                    } else if (!this.messages.some(m => m.message_uuid === newMsg.message_uuid)) {
                        this.messages.push(newMsg);
                    }

                    // Update conversation status if previously waiting_customer
                    if (this.conversation.status === 'waiting_customer') {
                        this.conversation.status = 'waiting_agent';
                    }

                    this.$nextTick(() => this.scrollToBottom(true));
                    setTimeout(() => this.fetchMessages(true), 400);
                } else {
                    optMsg.status = 'failed';

                    if (res.status === 422) {
                        const errJson = await res.json();
                        const msg = errJson.message || 'Tin nhắn không hợp lệ.';
                        if (msg.includes('closed') || msg.includes('đã kết thúc')) {
                            this.conversation.status = 'closed';
                        }
                        this.errorMessage = msg;
                    } else if (res.status === 429) {
                        this.errorMessage = 'Bạn đang gửi tin nhắn quá nhanh. Vui lòng đợi trong giây lát.';
                    } else if (res.status === 403) {
                        this.conversation.status = 'spam';
                        this.errorMessage = 'Hội thoại đã bị hạn chế.';
                    } else if (res.status === 401) {
                        this.sessionInitialized = false;
                        await this.initSessionAndConversation();
                        this.errorMessage = 'Phiên làm việc vừa được cập nhật, vui lòng gửi lại.';
                    } else {
                        this.errorMessage = 'Không thể gửi tin nhắn. Vui lòng thử lại.';
                    }
                }
            } catch (err) {
                console.error('[ChatWidget] Send error:', err);
                optMsg.status = 'failed';
                this.errorMessage = 'Lỗi kết nối. Không thể gửi tin nhắn.';
            } finally {
                this.isSending = false;
            }
        },

        // Message Actions (Edit / Recall)
        openMessageActions(msg) {
            this.activeActionMessage = msg;
        },

        canEdit(msg) {
            if (!msg || msg.sender_type !== 'visitor' || msg.recalled) return false;
            const created = new Date(msg.created_at).getTime();
            const now = Date.now();
            return (now - created) <= (15 * 60 * 1000);
        },

        canRecall(msg) {
            if (!msg || msg.sender_type !== 'visitor' || msg.recalled) return false;
            const created = new Date(msg.created_at).getTime();
            const now = Date.now();
            return (now - created) <= (60 * 60 * 1000);
        },

        isEditableOrRecallable(msg) {
            return this.canEdit(msg) || this.canRecall(msg);
        },

        startEditMessage(msg) {
            this.activeActionMessage = null;
            this.editingMessageUuid = msg.message_uuid;
            this.editInputText = msg.message || '';
        },

        cancelEditMessage() {
            this.editingMessageUuid = null;
            this.editInputText = '';
        },

        async saveEditMessage() {
            const trimmed = this.editInputText.trim();
            if (!trimmed || !this.editingMessageUuid) return;

            try {
                const res = await fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/messages/${this.editingMessageUuid}`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ message: trimmed })
                });

                if (res.ok) {
                    const data = await res.json();
                    const updated = data.data;
                    const idx = this.messages.findIndex(m => m.message_uuid === updated.message_uuid);
                    if (idx !== -1) {
                        this.messages[idx] = Object.assign({}, this.messages[idx], updated);
                    }
                    this.cancelEditMessage();
                } else if (res.status === 422) {
                    const errJson = await res.json();
                    this.errorMessage = errJson.message || 'Thời gian cho phép chỉnh sửa đã hết.';
                    this.cancelEditMessage();
                }
            } catch (err) {
                this.errorMessage = 'Lỗi kết nối khi cập nhật tin nhắn.';
            }
        },

        async triggerRecallMessage(msg) {
            if (!msg || !confirm('Quý khách có chắc chắn muốn thu hồi tin nhắn này không?')) return;
            this.activeActionMessage = null;

            try {
                const res = await fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/messages/${msg.message_uuid}/recall`, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });

                if (res.ok) {
                    const data = await res.json();
                    const recalledMsg = data.data;
                    const idx = this.messages.findIndex(m => m.message_uuid === recalledMsg.message_uuid);
                    if (idx !== -1) {
                        this.messages[idx] = Object.assign({}, this.messages[idx], recalledMsg);
                    }
                } else if (res.status === 422) {
                    const errJson = await res.json();
                    this.errorMessage = errJson.message || 'Thời gian cho phép thu hồi đã hết.';
                }
            } catch (err) {
                this.errorMessage = 'Lỗi kết nối khi thu hồi tin nhắn.';
            }
        },

        async confirmNewConversation() {
            if (!confirm('Bắt đầu cuộc trò chuyện mới?')) return;
            await this.startNewConversation();
        },

        async startNewConversation() {
            this.messages = [];
            this.conversation = null;
            await this.initSessionAndConversation();
        },

        markAsRead() {
            if (!this.conversation || !this.conversation.conversation_uuid) return;
            clearTimeout(this.markReadDebounceTimer);
            this.markReadDebounceTimer = setTimeout(() => {
                fetch(`/api/chat/conversations/${this.conversation.conversation_uuid}/read`, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                }).catch(() => {});
                this.unreadCount = 0;
            }, 600);
        },

        // Smart Polling Engine (Single loop guarantee with adaptive cadence & backoff)
        startPolling() {
            this.stopPolling();
            this.scheduleNextPoll();
        },

        stopPolling() {
            if (this.pollingTimer) {
                clearTimeout(this.pollingTimer);
                this.pollingTimer = null;
            }
        },

        scheduleNextPoll() {
            if (!this.isOpen || document.visibilityState !== 'visible') return;
            if (this.conversation && (this.conversation.status === 'closed' || this.conversation.status === 'spam')) return;

            const isIdle = (Date.now() - this.lastUserActivity) > this.idleThresholdMs;
            const delay = isIdle ? this.idlePollInterval : this.activePollInterval;

            this.pollingTimer = setTimeout(async () => {
                if (this.isOpen && document.visibilityState === 'visible') {
                    await this.fetchMessages();
                }
                this.scheduleNextPoll();
            }, delay);
        },

        // UI Helpers
        handleScroll() {
            const el = this.$refs.messagesContainer;
            if (!el) return;
            const threshold = 60;
            const atBottom = el.scrollHeight - el.scrollTop - el.clientHeight <= threshold;
            this.isAtBottom = atBottom;
            if (atBottom) {
                this.hasNewMessagesBelow = false;
            }
        },

        scrollToBottom(smooth = false) {
            const el = this.$refs.messagesContainer;
            if (!el) return;
            el.scrollTo({
                top: el.scrollHeight,
                behavior: smooth ? 'smooth' : 'auto'
            });
            this.isAtBottom = true;
            this.hasNewMessagesBelow = false;
        },

        autoGrowTextarea(el) {
            if (!el) return;
            el.style.height = 'auto';
            const newHeight = Math.min(Math.max(el.scrollHeight, 20), 96);
            el.style.height = newHeight + 'px';
        },

        formatTime(isoString) {
            if (!isoString) return '';
            try {
                const date = new Date(isoString);
                return date.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
            } catch (e) {
                return '';
            }
        }
    }));
});
</script>

<style>
/* Chat Widget specific isolated animation styles */
.clm-chat-widget-root {
    color-scheme: dark;
}
.clm-chat-widget-root [x-cloak] {
    display: none !important;
}
#chat-message-input {
    resize: none !important;
    scrollbar-width: thin !important;
    scrollbar-color: rgba(255, 255, 255, 0.15) transparent !important;
}
#chat-message-input::-webkit-scrollbar {
    width: 3px !important;
}
#chat-message-input::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.15) !important;
    border-radius: 9999px !important;
}
#chat-message-input::-webkit-resizer {
    display: none !important;
}
</style>
