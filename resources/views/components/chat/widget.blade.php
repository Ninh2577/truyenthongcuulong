@php
    $pollInterval = (int) config('chat.widget_poll_interval_ms', 3500);
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
    @keydown.escape.window="if (isOpen) closeWidget()"
>
    <!-- ==================== CHAT FAB BUTTON ==================== -->
    <div class="fixed bottom-5 right-4 sm:bottom-6 sm:right-6 z-[95] flex items-center justify-center">
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

            <!-- FAB Icons -->
            <span
                x-show="!isOpen"
                class="material-symbols-outlined text-3xl sm:text-4xl text-white transition-transform duration-300 group-hover:rotate-12"
            >chat</span>
            <span
                x-show="isOpen"
                class="material-symbols-outlined text-3xl text-white transition-transform duration-300"
            >close</span>
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
        class="fixed inset-0 sm:inset-auto sm:bottom-24 sm:right-6 w-full sm:w-[390px] h-[100dvh] sm:h-[580px] bg-[#070F1E] sm:bg-[#070F1E]/95 sm:backdrop-blur-2xl border-0 sm:border sm:border-white/10 sm:rounded-2xl shadow-2xl flex flex-col z-[100] overflow-hidden"
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
                        <span class="material-symbols-outlined text-[12px] text-orange-400">verified_user</span>
                        <span x-text="msg.sender_type === 'bot' ? 'Trợ lý AI' : 'Tư vấn viên'"></span>
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
                            <span class="whitespace-pre-wrap select-text" x-show="msg.message" x-text="msg.message"></span>

                            <!-- Attachments List -->
                            <div x-show="msg.attachments && msg.attachments.length > 0" class="mt-2 space-y-1.5">
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
                            <span x-show="msg.edited_at && !msg.recalled" class="text-[9px] italic text-slate-400">· Đã chỉnh sửa</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'sent'" class="material-symbols-outlined text-[11px] text-orange-400">done</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'delivered'" class="material-symbols-outlined text-[11px] text-slate-400">done_all</span>
                            <span x-show="msg.sender_type === 'visitor' && msg.status === 'read'" class="material-symbols-outlined text-[11px] text-emerald-400">done_all</span>
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
        </div>

        <!-- ==================== COMPOSER AREA ==================== -->
        <div class="p-3 bg-[#081122] border-t border-white/10 shrink-0">
            <!-- Selected Attachments Preview Chips -->
            <div x-show="selectedFiles.length > 0" class="mb-2 flex flex-wrap gap-1.5">
                <template x-for="(file, idx) in selectedFiles" :key="idx">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white/10 border border-white/15 text-[11px] text-slate-200">
                        <span class="material-symbols-outlined text-xs text-orange-400">attach_file</span>
                        <span class="max-w-[120px] truncate" x-text="file.name"></span>
                        <span class="text-[9px] text-slate-400" x-text="formatBytes(file.size)"></span>
                        <button type="button" @click="removeSelectedFile(idx)" class="text-slate-400 hover:text-white ml-0.5">&times;</button>
                    </div>
                </template>
            </div>

            <form
                @submit.prevent="submitMessage()"
                class="flex items-end gap-2"
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
                    class="w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-slate-400 hover:text-white flex items-center justify-center shrink-0 transition disabled:opacity-40 disabled:cursor-not-allowed"
                    title="Đính kèm tệp (Ảnh tối đa 5MB, Tài liệu tối đa 10MB)"
                    aria-label="Đính kèm tệp"
                >
                    <span class="material-symbols-outlined text-[20px]">attach_file</span>
                </button>

                <div class="flex-1 relative">
                    <textarea
                        id="chat-message-input"
                        x-ref="messageInput"
                        x-model="inputText"
                        :disabled="isComposerDisabled"
                        :maxlength="maxInputLength"
                        rows="1"
                        @keydown.enter.exact.prevent="submitMessage()"
                        @input="autoGrowTextarea($el)"
                        placeholder="Nhập tin nhắn... (Enter để gửi)"
                        aria-label="Nội dung tin nhắn gửi tới tư vấn viên"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-400 text-xs sm:text-[13px] focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition resize-none max-h-28 disabled:opacity-50 disabled:cursor-not-allowed"
                    ></textarea>

                    <!-- Character counter when near limit -->
                    <span
                        x-show="inputText.length > maxInputLength - 100"
                        class="absolute right-2 bottom-1 text-[10px] text-amber-400 font-mono"
                        x-text="inputText.length + '/' + maxInputLength"
                    ></span>
                </div>

                <!-- Send Button -->
                <button
                    type="submit"
                    id="chat-send-btn"
                    :disabled="isComposerDisabled || (!inputText.trim() && selectedFiles.length === 0) || isSending"
                    class="w-10 h-10 rounded-xl bg-gradient-to-tr from-orange-600 to-amber-500 hover:from-orange-500 hover:to-amber-400 text-white flex items-center justify-center shrink-0 shadow-md disabled:opacity-40 disabled:cursor-not-allowed transition transform active:scale-95 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    aria-label="Gửi tin nhắn"
                >
                    <span class="material-symbols-outlined text-[20px]">send</span>
                </button>
            </form>
            <div class="flex items-center justify-between mt-1.5 px-1 text-[10px] text-slate-400">
                <span>Bảo mật bởi Truyền Thông Cửu Long</span>
                <span x-text="statusBadgeText"></span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('clmChatWidget', (config) => ({
        // Configuration
        pollInterval: config.pollInterval || 3500,
        activePollInterval: config.pollInterval || 3500,
        idlePollInterval: 7000,
        idleThresholdMs: 120000, // 2 minutes
        maxInputLength: config.maxInputLength || 2000,

        // State Machine
        isOpen: false,
        sessionInitialized: false,
        visitorUuid: null,
        conversation: null,
        messages: [],
        knownMessageUuids: new Set(),
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
            return 'Hỗ trợ 24/7';
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

                // 2. Create or reuse active conversation
                const convRes = await fetch('/api/chat/conversations', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });

                if (!convRes.ok) {
                    this.errorMessage = 'Không thể tải cuộc trò chuyện.';
                    this.isLoading = false;
                    return;
                }

                const convData = await convRes.json();
                this.conversation = convData.data;

                // 3. Fetch initial message history
                await this.fetchMessages(true);

                // 4. Start polling & mark read
                this.startPolling();
                this.markAsRead();
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

                // Smart merge messages preventing duplicates
                fetchedMessages.forEach(newMsg => {
                    if (this.knownMessageUuids.has(newMsg.message_uuid)) {
                        // Update existing message if status, recalled, or content changed
                        const existingIdx = this.messages.findIndex(m => m.message_uuid === newMsg.message_uuid);
                        if (existingIdx !== -1) {
                            this.messages[existingIdx] = Object.assign({}, this.messages[existingIdx], newMsg);
                        }
                    } else {
                        // Append brand new message
                        this.knownMessageUuids.add(newMsg.message_uuid);
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

            try {
                let res;
                if (hasFiles) {
                    const formData = new FormData();
                    if (trimmed) formData.append('message', trimmed);
                    this.selectedFiles.forEach(f => formData.append('attachments[]', f));

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
                        body: JSON.stringify({ message: trimmed })
                    });
                }

                if (res.status === 201) {
                    const data = await res.json();
                    const newMsg = data.data;

                    if (!this.knownMessageUuids.has(newMsg.message_uuid)) {
                        this.knownMessageUuids.add(newMsg.message_uuid);
                        this.messages.push(newMsg);
                    }

                    this.inputText = '';
                    this.selectedFiles = [];
                    if (this.$refs.messageInput) {
                        this.$refs.messageInput.style.height = 'auto';
                    }

                    // Update conversation status if previously waiting_customer
                    if (this.conversation.status === 'waiting_customer') {
                        this.conversation.status = 'waiting_agent';
                    }

                    this.$nextTick(() => this.scrollToBottom(true));
                } else if (res.status === 422) {
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
            } catch (err) {
                console.error('[ChatWidget] Send error:', err);
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
            this.knownMessageUuids.clear();
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
            el.style.height = 'auto';
            el.style.height = Math.min(el.scrollHeight, 112) + 'px';
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
</style>
