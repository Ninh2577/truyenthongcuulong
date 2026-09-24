<x-filament-panels::page>
    {{--
        CHAT-14: 3-Column Workspace
        Col 1 (w-72/80)  : Conversation list — search, filters, unread toggle
        Col 2 (flex-1)   : Conversation detail — header, message thread, composer
        Col 3 (w-64/72)  : Customer context — visitor info, notes, sessions
        Mobile           : Stacked — list / detail / context (via toggling)
    --}}
    <div
        x-data="{
            mobileView: 'list', {{-- 'list' | 'detail' | 'context' --}}
            scrollToBottom() {
                this.$nextTick(() => {
                    const el = this.$refs.messagesContainer;
                    if (el) el.scrollTop = el.scrollHeight;
                });
            },
            openDetail() {
                this.mobileView = 'detail';
                this.$nextTick(() => this.scrollToBottom());
            }
        }"
        x-init="
            scrollToBottom();
            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'visible') {
                    $wire.poll();
                    scrollToBottom();
                }
            });
            $wire.on('message-sent', () => scrollToBottom());
            $wire.on('conversation-opened', () => openDetail());
        "
        wire:poll.visible.8s="poll"
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm overflow-hidden flex h-[calc(100vh-12rem)] min-h-[600px]"
    >
        {{-- ==================== COLUMN 1: CONVERSATION LIST ==================== --}}
        <div
            class="w-full md:w-72 lg:w-80 border-r border-gray-200 dark:border-gray-800 flex flex-col shrink-0 bg-gray-50/60 dark:bg-gray-900/50"
            :class="mobileView === 'list' ? 'flex' : 'hidden md:flex'"
        >
            {{-- Toolbar: Search + Filters --}}
            <div class="px-3 pt-3 pb-2 border-b border-gray-200 dark:border-gray-800 space-y-2">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-1">
                    <h2 class="text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Hộp thư</h2>
                    <span class="text-[11px] text-gray-400">
                        {{ $this->conversations->total() }} cuộc
                    </span>
                </div>

                {{-- Search --}}
                <div class="relative">
                    <x-filament::input.wrapper prefix-icon="heroicon-m-magnifying-glass">
                        <x-filament::input
                            type="search"
                            wire:model.live.debounce.350ms="search"
                            placeholder="Tìm khách, nội dung..."
                            id="chat-inbox-search"
                        />
                    </x-filament::input.wrapper>
                </div>

                {{-- Status + Assignment Filters --}}
                <div class="grid grid-cols-2 gap-1.5">
                    <select
                        wire:model.live="filterStatus"
                        id="chat-inbox-filter-status"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-[11px] py-1.5 focus:ring-primary-500 focus:border-primary-500"
                    >
                        <option value="all">Tất cả</option>
                        <option value="open">Mới mở</option>
                        <option value="assigned">Đã tiếp nhận</option>
                        <option value="waiting_agent">Chờ nhân viên</option>
                        <option value="waiting_customer">Chờ khách</option>
                        <option value="closed">Đã đóng</option>
                        <option value="spam">Spam</option>
                    </select>

                    <select
                        wire:model.live="filterAssignment"
                        id="chat-inbox-filter-assignment"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-[11px] py-1.5 focus:ring-primary-500 focus:border-primary-500"
                    >
                        <option value="all">Tất cả</option>
                        <option value="mine">Của tôi</option>
                        <option value="unassigned">Chưa nhận</option>
                    </select>
                </div>

                {{-- Unread Toggle --}}
                <label class="flex items-center gap-2 cursor-pointer text-[11px] text-gray-500 dark:text-gray-400 select-none pt-0.5">
                    <input
                        type="checkbox"
                        wire:model.live="unreadOnly"
                        id="chat-inbox-unread-only"
                        class="rounded border-gray-300 dark:border-gray-700 text-primary-600 focus:ring-primary-500"
                    />
                    <span>Chỉ tin chưa đọc</span>
                </label>
            </div>

            {{-- Conversation List --}}
            <div class="flex-1 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-800/60">
                @forelse($this->conversations as $conv)
                    @php
                        $isSelected = ($selectedConversationUuid === $conv->conversation_uuid);
                        $visitorName = $conv->visitor?->name ?: ('Khách #' . substr($conv->visitor?->visitor_uuid ?? 'unknown', 0, 8));
                        $latestMsg   = $conv->latestMessage;
                        $lastTime    = $conv->last_message_at
                            ? $conv->last_message_at->diffForHumans()
                            : $conv->created_at->diffForHumans();
                    @endphp

                    <button
                        type="button"
                        wire:key="conv-item-{{ $conv->conversation_uuid }}"
                        wire:click="selectConversation('{{ $conv->conversation_uuid }}')"
                        x-on:click="openDetail()"
                        id="conv-item-{{ $conv->conversation_uuid }}"
                        class="w-full text-left px-3 py-3 cursor-pointer transition-all duration-150 relative {{ $isSelected ? 'bg-primary-50 dark:bg-primary-950/30 border-l-4 border-l-primary-500' : 'hover:bg-gray-100/70 dark:hover:bg-gray-800/40 border-l-4 border-l-transparent' }}"
                    >
                        {{-- Top row: name + time --}}
                        <div class="flex items-start justify-between gap-2 mb-0.5">
                            <span class="font-semibold text-xs text-gray-900 dark:text-gray-100 truncate">
                                {{ $visitorName }}
                            </span>
                            <span class="text-[10px] text-gray-400 shrink-0">{{ $lastTime }}</span>
                        </div>

                        {{-- Last message snippet --}}
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 line-clamp-1 mb-1.5">
                            @if($latestMsg)
                                @if($latestMsg->recalled_at)
                                    <em class="text-gray-400">[Tin nhắn đã thu hồi]</em>
                                @else
                                    <span class="font-medium text-gray-600 dark:text-gray-300">
                                        @if($latestMsg->sender_type->value === 'agent') Bạn:&nbsp;
                                        @elseif($latestMsg->sender_type->value === 'bot') AI:&nbsp;
                                        @elseif($latestMsg->sender_type->value === 'system') Hệ thống:&nbsp;
                                        @endif
                                    </span>{{ Str::limit($latestMsg->message_body, 60) }}
                                @endif
                            @else
                                <span class="italic text-gray-400">Chưa có tin nhắn</span>
                            @endif
                        </p>

                        {{-- Badges row --}}
                        <div class="flex items-center justify-between gap-1">
                            <div class="flex items-center gap-1 flex-wrap">
                                <x-filament::badge :color="$conv->status->getColor()" size="sm">
                                    {{ $conv->status->getLabel() }}
                                </x-filament::badge>

                                @if($conv->channel)
                                    <x-filament::badge :color="$conv->channel->getColor()" size="sm">
                                        {{ $conv->channel->getLabel() }}
                                    </x-filament::badge>
                                @endif

                                @if($conv->assignedUser)
                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-gray-200/80 dark:bg-gray-800 text-gray-700 dark:text-gray-300 flex items-center gap-1">
                                        <x-filament::icon icon="heroicon-m-user" class="w-2.5 h-2.5" />
                                        {{ Str::limit($conv->assignedUser->name, 10) }}
                                    </span>
                                @else
                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-amber-100 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 font-medium">
                                        Chưa nhận
                                    </span>
                                @endif
                            </div>

                            @if($conv->agent_unread_count > 0)
                                <span class="px-1.5 py-0.5 min-w-[18px] text-center rounded-full bg-red-600 text-white font-bold text-[10px] shrink-0">
                                    {{ $conv->agent_unread_count }}
                                </span>
                            @endif
                        </div>
                    </button>
                @empty
                    <div class="p-8 text-center text-gray-400 text-xs">
                        <x-filament::icon icon="heroicon-o-inbox" class="w-8 h-8 mx-auto mb-2 opacity-50" />
                        Không tìm thấy cuộc trò chuyện nào.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ==================== COLUMN 2: CONVERSATION DETAIL ==================== --}}
        <div
            class="flex-1 flex flex-col h-full overflow-hidden bg-white dark:bg-gray-900"
            :class="mobileView === 'detail' ? 'flex' : 'hidden md:flex'"
        >
            @if($this->selectedConversation)
                @php
                    $sel           = $this->selectedConversation;
                    $visitorTitle  = $sel->visitor?->name ?: ('Khách #' . substr($sel->visitor?->visitor_uuid ?? 'unknown', 0, 8));
                    $isClosed      = ($sel->status->value === 'closed');
                    $isSpam        = ($sel->status->value === 'spam');
                    $isAssignedToMe = ((int) $sel->assigned_to_user_id === (int) auth()->id());
                @endphp

                {{-- Conversation Header --}}
                <div class="px-4 py-2.5 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between gap-3 bg-gray-50/30 dark:bg-gray-900/50 shrink-0">
                    {{-- Mobile back button --}}
                    <div class="flex items-center gap-2 min-w-0 flex-1">
                        <button
                            type="button"
                            x-on:click="mobileView = 'list'"
                            class="md:hidden p-1.5 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 shrink-0"
                            title="Quay lại danh sách"
                        >
                            <x-filament::icon icon="heroicon-m-arrow-left" class="w-4 h-4" />
                        </button>

                        {{-- Avatar + Identity --}}
                        <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-950 text-primary-600 dark:text-primary-400 flex items-center justify-center font-bold text-sm shrink-0">
                            {{ mb_substr($visitorTitle, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <h3 class="font-bold text-sm text-gray-900 dark:text-gray-100 truncate">
                                    {{ $visitorTitle }}
                                </h3>
                                <x-filament::badge :color="$sel->status->getColor()" size="sm">
                                    {{ $sel->status->getLabel() }}
                                </x-filament::badge>
                                @if($sel->channel)
                                    <x-filament::badge :color="$sel->channel->getColor()" size="sm">
                                        {{ $sel->channel->getLabel() }}
                                    </x-filament::badge>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 text-[10px] text-gray-400 mt-0.5">
                                <span>Ref: <code class="font-mono">{{ substr($sel->conversation_uuid, 0, 8) }}</code></span>
                                @if($sel->assignedUser)
                                    <span>· {{ $sel->assignedUser->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-1.5 shrink-0">
                        @if(!$isClosed && !$isSpam && !$isAssignedToMe)
                            <x-filament::button
                                size="sm"
                                color="primary"
                                icon="heroicon-m-hand-raised"
                                wire:click="claim"
                                id="btn-claim-conversation"
                            >
                                Tiếp nhận
                            </x-filament::button>
                        @endif

                        @if(!$isClosed && !$isSpam)
                            <x-filament::button
                                size="sm"
                                color="gray"
                                icon="heroicon-m-check-circle"
                                wire:click="closeConversation"
                                id="btn-close-conversation"
                            >
                                Đóng
                            </x-filament::button>
                        @elseif($isClosed)
                            <x-filament::button
                                size="sm"
                                color="warning"
                                icon="heroicon-m-arrow-path"
                                wire:click="reopenConversation"
                                id="btn-reopen-conversation"
                            >
                                Mở lại
                            </x-filament::button>
                        @endif

                        @if(auth()->user()->hasAnyRole(['super_admin', 'Admin']))
                            @if(!$isSpam)
                                <x-filament::button
                                    size="sm"
                                    color="danger"
                                    icon="heroicon-m-no-symbol"
                                    wire:click="markAsSpam"
                                    wire:confirm="Đánh dấu SPAM cuộc trò chuyện này?"
                                    id="btn-mark-spam"
                                >
                                    Spam
                                </x-filament::button>
                            @else
                                <x-filament::button
                                    size="sm"
                                    color="success"
                                    icon="heroicon-m-arrow-path"
                                    wire:click="unmarkSpam"
                                    id="btn-unmark-spam"
                                >
                                    Bỏ Spam
                                </x-filament::button>
                            @endif
                        @endif

                        {{-- Mobile: show context panel --}}
                        <button
                            type="button"
                            x-on:click="mobileView = 'context'"
                            class="lg:hidden p-1.5 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800"
                            title="Thông tin khách"
                        >
                            <x-filament::icon icon="heroicon-m-information-circle" class="w-4 h-4" />
                        </button>
                    </div>
                </div>

                {{-- Tab Bar: Messages / Notes --}}
                <div class="px-4 border-b border-gray-200 dark:border-gray-800 flex gap-4 text-xs font-semibold shrink-0">
                    <button
                        type="button"
                        wire:click="$set('activeTab', 'messages')"
                        id="tab-messages"
                        class="py-2.5 border-b-2 transition-colors {{ $activeTab === 'messages' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}"
                    >
                        Tin nhắn
                    </button>
                    <button
                        type="button"
                        wire:click="$set('activeTab', 'notes')"
                        id="tab-notes"
                        class="py-2.5 border-b-2 transition-colors flex items-center gap-1.5 {{ $activeTab === 'notes' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}"
                    >
                        <span>Ghi chú nội bộ</span>
                        @if($this->internalNotes->count() > 0)
                            <span class="px-1.5 rounded-full bg-gray-200 dark:bg-gray-700 text-[10px]">
                                {{ $this->internalNotes->count() }}
                            </span>
                        @endif
                    </button>
                </div>

                {{-- TAB: MESSAGES --}}
                @if($activeTab === 'messages')
                    <div
                        x-ref="messagesContainer"
                        class="flex-1 overflow-y-auto p-4 space-y-3.5 bg-gray-50/30 dark:bg-gray-950/20"
                    >
                        @forelse($this->messages as $msg)
                            @php
                                $isVisitor   = ($msg->sender_type->value === 'visitor');
                                $isBot       = ($msg->sender_type->value === 'bot');
                                $isSystem    = ($msg->sender_type->value === 'system');
                                $isAgent     = ($msg->sender_type->value === 'agent');
                                $isMyMessage = ($isAgent && (int) $msg->sender_user_id === (int) auth()->id());
                                $isRecalled  = !empty($msg->recalled_at);
                                $editWindow  = (int) config('chat.message_edit_window_minutes', 15);
                                $recallWindow = (int) config('chat.message_recall_window_minutes', 60);
                                $canEdit     = ($isMyMessage && !$isRecalled && $msg->created_at->addMinutes($editWindow)->isFuture());
                                $canRecall   = ($isMyMessage && !$isRecalled && $msg->created_at->addMinutes($recallWindow)->isFuture());
                            @endphp

                            <div
                                wire:key="msg-{{ $msg->message_uuid }}"
                                class="flex flex-col {{ ($isVisitor || $isBot || $isSystem) ? 'items-start' : 'items-end' }}"
                            >
                                {{-- Sender label --}}
                                <div class="flex items-center gap-1.5 mb-1 px-1 text-[11px] text-gray-400">
                                    @if($isVisitor)
                                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $visitorTitle }}</span>
                                    @elseif($isBot)
                                        <span class="inline-flex items-center gap-1 font-semibold text-indigo-600 dark:text-indigo-400">
                                            <x-filament::icon icon="heroicon-m-sparkles" class="w-3 h-3 text-indigo-500" />
                                            Trợ lý AI
                                        </span>
                                    @elseif($isSystem)
                                        <span class="inline-flex items-center gap-1 font-semibold text-gray-500 dark:text-gray-400">
                                            <x-filament::icon icon="heroicon-m-cog-6-tooth" class="w-3 h-3" />
                                            Hệ thống
                                        </span>
                                    @else
                                        <span class="font-medium text-primary-600 dark:text-primary-400">
                                            {{ $msg->senderUser?->name ?? 'Nhân viên CSKH' }}
                                        </span>
                                    @endif
                                    <span>·</span>
                                    <span>{{ $msg->created_at->format('H:i') }}</span>
                                    @if($msg->edited_at && !$isRecalled)
                                        <span class="italic text-[10px]">(Đã sửa)</span>
                                    @endif
                                </div>

                                {{-- Bubble --}}
                                <div class="relative group max-w-[80%]">
                                    @if($isRecalled)
                                        <div class="px-3.5 py-2 rounded-2xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-400 text-xs italic flex items-center gap-1.5">
                                            <x-filament::icon icon="heroicon-m-arrow-uturn-left" class="w-3.5 h-3.5" />
                                            Tin nhắn đã được thu hồi
                                        </div>
                                    @else
                                        <div class="px-4 py-2.5 rounded-2xl text-xs sm:text-sm leading-relaxed break-words shadow-sm {{
                                            $isVisitor
                                                ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-200/80 dark:border-gray-700/80 rounded-tl-sm'
                                                : ($isBot
                                                    ? 'bg-indigo-50/80 dark:bg-indigo-950/40 text-gray-900 dark:text-gray-100 border border-indigo-200/70 dark:border-indigo-800/60 rounded-tl-sm'
                                                    : ($isSystem
                                                        ? 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 rounded-tl-sm text-xs'
                                                        : 'bg-primary-600 text-white rounded-tr-sm'))
                                        }}">
                                            @if($msg->message_body)
                                                <p class="whitespace-pre-wrap select-text">{{ $msg->message_body }}</p>
                                            @endif

                                            @if($msg->attachments && $msg->attachments->count() > 0)
                                                <div class="mt-2 space-y-1.5">
                                                    @foreach($msg->attachments as $att)
                                                        @php
                                                            $isImg = str_starts_with($att->mime_type, 'image/');
                                                            $dlUrl = route('api.chat.attachments.show', ['attachment_uuid' => $att->attachment_uuid]);
                                                        @endphp
                                                        @if($isImg)
                                                            <a href="{{ $dlUrl }}" target="_blank" rel="noopener noreferrer" class="block overflow-hidden rounded-lg hover:opacity-90 transition">
                                                                <img src="{{ $dlUrl }}" alt="{{ $att->original_name }}" class="max-h-48 max-w-full object-cover rounded-lg" loading="lazy">
                                                            </a>
                                                        @else
                                                            <a href="{{ $dlUrl }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 p-2 rounded-lg {{ $isVisitor ? 'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600' : 'bg-black/20 hover:bg-black/30' }} text-xs transition">
                                                                <x-filament::icon icon="heroicon-m-document-text" class="w-4 h-4 shrink-0" />
                                                                <div class="min-w-0 flex-1 truncate">
                                                                    <span class="font-medium truncate block">{{ $att->original_name }}</span>
                                                                    <span class="text-[10px] opacity-75">{{ number_format($att->file_size / 1024, 1) }} KB</span>
                                                                </div>
                                                                <x-filament::icon icon="heroicon-m-arrow-down-tray" class="w-3.5 h-3.5 shrink-0" />
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Agent edit/recall actions (hover) --}}
                                        @if(($canEdit || $canRecall) && $editingMessageUuid !== $msg->message_uuid)
                                            <div class="absolute top-1/2 -translate-y-1/2 {{ $isVisitor ? '-right-14' : '-left-14' }} opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                                                @if($canEdit)
                                                    <button
                                                        type="button"
                                                        wire:click="startEditMessage('{{ $msg->message_uuid }}', @js($msg->message_body))"
                                                        class="p-1 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 rounded hover:bg-gray-100 dark:hover:bg-gray-800"
                                                        title="Sửa ({{ config('chat.message_edit_window_minutes', 15) }} phút)"
                                                    >
                                                        <x-filament::icon icon="heroicon-m-pencil-square" class="w-3.5 h-3.5" />
                                                    </button>
                                                @endif

                                                @if($canRecall)
                                                    <button
                                                        type="button"
                                                        wire:click="recallMessage('{{ $msg->message_uuid }}')"
                                                        wire:confirm="Thu hồi tin nhắn này?"
                                                        class="p-1 text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded hover:bg-gray-100 dark:hover:bg-gray-800"
                                                        title="Thu hồi"
                                                    >
                                                        <x-filament::icon icon="heroicon-m-arrow-uturn-left" class="w-3.5 h-3.5" />
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                {{-- Read tick for agent messages --}}
                                @if($isAgent && !$isRecalled)
                                    <div class="mt-0.5 text-[10px] text-gray-400">
                                        @if($msg->status->value === 'read')
                                            <span class="text-emerald-500">Đã xem</span>
                                        @else
                                            <span>Đã gửi</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-400 text-xs">
                                <x-filament::icon icon="heroicon-o-chat-bubble-left-right" class="w-8 h-8 mx-auto mb-2 opacity-40" />
                                Chưa có tin nhắn nào trong cuộc trò chuyện này.
                            </div>
                        @endforelse

                        {{-- Inline Edit Box --}}
                        @if($editingMessageUuid)
                            <div class="p-3 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 rounded-xl my-2" id="message-edit-box">
                                <div class="flex items-center justify-between text-xs text-amber-800 dark:text-amber-300 font-semibold mb-1.5">
                                    <span>Chỉnh sửa tin nhắn</span>
                                    <button type="button" wire:click="cancelEditMessage" class="text-gray-400 hover:text-gray-600">&times;</button>
                                </div>
                                <textarea
                                    wire:model="editMessageText"
                                    rows="2"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-xs p-2 focus:ring-primary-500 focus:border-primary-500"
                                ></textarea>
                                <div class="flex justify-end gap-2 mt-2">
                                    <x-filament::button size="xs" color="gray" wire:click="cancelEditMessage">Hủy</x-filament::button>
                                    <x-filament::button size="xs" color="primary" wire:click="saveEditMessage">Lưu</x-filament::button>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Composer --}}
                    <div class="p-3 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shrink-0" id="message-composer">
                        @if($isClosed)
                            <div class="p-2.5 bg-gray-100 dark:bg-gray-800 text-gray-500 text-center text-xs rounded-lg flex items-center justify-center gap-2">
                                <x-filament::icon icon="heroicon-m-lock-closed" class="w-4 h-4" />
                                <span>Hội thoại đã đóng. Nhấn <strong>Mở lại</strong> để tiếp tục.</span>
                            </div>
                        @elseif($isSpam)
                            <div class="p-2.5 bg-red-50 dark:bg-red-950/30 text-red-600 text-center text-xs rounded-lg flex items-center justify-center gap-2">
                                <x-filament::icon icon="heroicon-m-no-symbol" class="w-4 h-4" />
                                <span>Hội thoại này đã bị đánh dấu SPAM.</span>
                            </div>
                        @else
                            {{-- Attachment chips --}}
                            @if(count($attachments) > 0)
                                <div class="mb-2 flex flex-wrap gap-1.5">
                                    @foreach($attachments as $idx => $att)
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-xs text-gray-700 dark:text-gray-300">
                                            <x-filament::icon icon="heroicon-m-paper-clip" class="w-3 h-3 text-primary-500" />
                                            <span class="max-w-[120px] truncate">{{ $att->getClientOriginalName() }}</span>
                                            <button type="button" wire:click="removeAttachment({{ $idx }})" class="text-gray-400 hover:text-red-500">&times;</button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div wire:loading wire:target="attachments" class="text-xs text-primary-600 mb-1.5 flex items-center gap-1.5">
                                <div class="w-3 h-3 border-2 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                                Đang tải tệp đính kèm...
                            </div>

                            <form wire:submit.prevent="sendReply" class="flex items-end gap-2" id="reply-form">
                                <input
                                    type="file"
                                    id="agent-attachments-input"
                                    wire:model="attachments"
                                    multiple
                                    accept=".jpg,.jpeg,.png,.webp,.gif,.pdf,.doc,.docx"
                                    class="hidden"
                                />

                                <label
                                    for="agent-attachments-input"
                                    class="w-9 h-9 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-500 hover:text-gray-700 dark:hover:text-gray-200 flex items-center justify-center cursor-pointer transition shrink-0"
                                    title="Đính kèm tệp"
                                >
                                    <x-filament::icon icon="heroicon-m-paper-clip" class="w-4 h-4" />
                                </label>

                                <div class="flex-1">
                                    <textarea
                                        wire:model="replyMessage"
                                        id="reply-message-input"
                                        rows="1"
                                        placeholder="Nhập câu trả lời... (Enter gửi, Shift+Enter xuống dòng)"
                                        @keydown.enter.exact.prevent="$wire.sendReply()"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm p-2.5 focus:ring-primary-500 focus:border-primary-500 resize-none max-h-28 transition"
                                    ></textarea>
                                </div>

                                <x-filament::button
                                    type="submit"
                                    color="primary"
                                    icon="heroicon-m-paper-airplane"
                                    wire:loading.attr="disabled"
                                    wire:target="sendReply"
                                    id="btn-send-reply"
                                    class="shrink-0"
                                >
                                    Gửi
                                </x-filament::button>
                            </form>
                        @endif
                    </div>

                {{-- TAB: INTERNAL NOTES --}}
                @elseif($activeTab === 'notes')
                    <div class="flex-1 overflow-y-auto p-4 bg-gray-50/20 dark:bg-gray-950/20 flex flex-col gap-3">
                        <div class="p-3 bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-900 rounded-lg text-xs text-blue-700 dark:text-blue-300 flex items-center gap-2">
                            <x-filament::icon icon="heroicon-m-information-circle" class="w-4 h-4 shrink-0" />
                            <span>Ghi chú nội bộ chỉ hiển thị cho nhân viên và ban quản trị — khách không nhìn thấy.</span>
                        </div>

                        <div class="space-y-2.5 flex-1">
                            @forelse($this->internalNotes as $note)
                                <div class="p-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm">
                                    <div class="flex items-center justify-between text-xs text-gray-400 mb-1.5">
                                        <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $note->user?->name ?? 'Nhân viên' }}</span>
                                        <span>{{ $note->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <p class="text-xs text-gray-800 dark:text-gray-300 whitespace-pre-wrap">{{ $note->note_body }}</p>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-400 text-xs">
                                    Chưa có ghi chú nào.
                                </div>
                            @endforelse
                        </div>

                        <div class="pt-3 border-t border-gray-200 dark:border-gray-800 shrink-0">
                            <h4 class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Thêm ghi chú</h4>
                            <textarea
                                wire:model="internalNoteText"
                                id="internal-note-input"
                                rows="2"
                                placeholder="Ghi chú về yêu cầu khách hàng..."
                                class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-xs p-2.5 focus:ring-primary-500 focus:border-primary-500 mb-2"
                            ></textarea>
                            <div class="flex justify-end">
                                <x-filament::button
                                    size="sm"
                                    color="primary"
                                    wire:click="addNote"
                                    wire:loading.attr="disabled"
                                    id="btn-add-note"
                                >
                                    Lưu ghi chú
                                </x-filament::button>
                            </div>
                        </div>
                    </div>
                @endif

            @else
                {{-- No conversation selected —  empty state --}}
                <div class="flex-1 flex flex-col items-center justify-center p-8 text-center text-gray-400">
                    <x-filament::icon icon="heroicon-o-chat-bubble-left-ellipsis" class="w-14 h-14 mb-3 text-gray-300 dark:text-gray-700" />
                    <h3 class="text-base font-semibold text-gray-700 dark:text-gray-300 mb-1">Hộp thư hỗ trợ khách hàng</h3>
                    <p class="text-xs max-w-xs">Chọn một cuộc trò chuyện từ danh sách bên trái để xem lịch sử và bắt đầu hỗ trợ khách.</p>
                </div>
            @endif
        </div>

        {{-- ==================== COLUMN 3: CUSTOMER CONTEXT ==================== --}}
        @if($this->selectedConversation)
            @php
                $ctxSel = $this->selectedConversation;
                $ctxVisitor = $ctxSel->visitor;
            @endphp
            <div
                class="w-64 xl:w-72 border-l border-gray-200 dark:border-gray-800 flex flex-col shrink-0 bg-gray-50/40 dark:bg-gray-900/40 overflow-y-auto"
                :class="mobileView === 'context' ? 'flex' : 'hidden lg:flex'"
            >
                {{-- Mobile back button --}}
                <div class="lg:hidden px-4 pt-3 pb-1 border-b border-gray-200 dark:border-gray-800 flex items-center gap-2">
                    <button
                        type="button"
                        x-on:click="mobileView = 'detail'"
                        class="p-1.5 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800"
                        title="Quay lại"
                    >
                        <x-filament::icon icon="heroicon-m-arrow-left" class="w-4 h-4" />
                    </button>
                    <span class="text-xs font-semibold text-gray-600 dark:text-gray-400">Thông tin khách</span>
                </div>

                <div class="p-4 space-y-5">
                    {{-- Visitor Identity --}}
                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Khách truy cập</h4>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-950 text-primary-600 dark:text-primary-400 flex items-center justify-center font-bold text-base shrink-0">
                                {{ mb_substr($ctxVisitor?->name ?: 'K', 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                    {{ $ctxVisitor?->name ?: ('Khách #' . substr($ctxVisitor?->visitor_uuid ?? 'unknown', 0, 8)) }}
                                </p>
                                @if($ctxVisitor?->blocked_at)
                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400 font-medium">Đã chặn</span>
                                @else
                                    <span class="text-[10px] text-gray-400">Khách truy cập web</span>
                                @endif
                            </div>
                        </div>

                        {{-- Contact info --}}
                        <div class="space-y-1.5">
                            @if($ctxVisitor?->email)
                                <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400">
                                    <x-filament::icon icon="heroicon-m-envelope" class="w-3.5 h-3.5 shrink-0 text-gray-400" />
                                    <span class="truncate">{{ $ctxVisitor->email }}</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-xs text-gray-400 italic">
                                    <x-filament::icon icon="heroicon-m-envelope" class="w-3.5 h-3.5 shrink-0" />
                                    <span>Chưa có email</span>
                                </div>
                            @endif

                            @if($ctxVisitor?->phone)
                                <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400">
                                    <x-filament::icon icon="heroicon-m-phone" class="w-3.5 h-3.5 shrink-0 text-gray-400" />
                                    <span>{{ $ctxVisitor->phone }}</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-xs text-gray-400 italic">
                                    <x-filament::icon icon="heroicon-m-phone" class="w-3.5 h-3.5 shrink-0" />
                                    <span>Chưa có SĐT</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Conversation Meta --}}
                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Cuộc trò chuyện</h4>
                        <div class="space-y-1.5 text-xs">
                            <div class="flex justify-between">
                                <span class="text-gray-500">UUID</span>
                                <code class="font-mono text-[10px] text-gray-600 dark:text-gray-400">{{ substr($ctxSel->conversation_uuid, 0, 12) }}…</code>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Trạng thái</span>
                                <x-filament::badge :color="$ctxSel->status->getColor()" size="sm">
                                    {{ $ctxSel->status->getLabel() }}
                                </x-filament::badge>
                            </div>
                            @if($ctxSel->channel)
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Kênh</span>
                                    <x-filament::badge :color="$ctxSel->channel->getColor()" size="sm">
                                        {{ $ctxSel->channel->getLabel() }}
                                    </x-filament::badge>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="text-gray-500">Bắt đầu</span>
                                <span class="text-gray-700 dark:text-gray-300">{{ $ctxSel->created_at->format('d/m H:i') }}</span>
                            </div>
                            @if($ctxSel->last_message_at)
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Tin cuối</span>
                                    <span class="text-gray-700 dark:text-gray-300">{{ $ctxSel->last_message_at->diffForHumans() }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Assignment --}}
                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Người phụ trách</h4>
                        @if($ctxSel->assignedUser)
                            <div class="flex items-center gap-2 text-xs">
                                <div class="w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 flex items-center justify-center font-bold text-[10px] shrink-0">
                                    {{ mb_substr($ctxSel->assignedUser->name, 0, 1) }}
                                </div>
                                <span class="text-gray-800 dark:text-gray-200">{{ $ctxSel->assignedUser->name }}</span>
                            </div>
                        @else
                            <span class="text-xs text-amber-600 dark:text-amber-400">Chưa phân công</span>
                        @endif
                    </div>

                    {{-- Admin actions on visitor --}}
                    @if(auth()->user()->hasAnyRole(['super_admin', 'Admin']) && $ctxVisitor)
                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Quản lý khách</h4>
                            @if(empty($ctxVisitor->blocked_at))
                                <x-filament::button
                                    size="sm"
                                    color="gray"
                                    icon="heroicon-m-user-minus"
                                    wire:click="blockVisitor"
                                    wire:confirm="Chặn khách truy cập này? Toàn bộ phiên sẽ bị thu hồi ngay."
                                    class="w-full"
                                    id="btn-block-visitor"
                                >
                                    Chặn khách
                                </x-filament::button>
                            @else
                                <x-filament::button
                                    size="sm"
                                    color="warning"
                                    icon="heroicon-m-user-plus"
                                    wire:click="unblockVisitor"
                                    class="w-full"
                                    id="btn-unblock-visitor"
                                >
                                    Bỏ chặn khách
                                </x-filament::button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
