<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Workspace Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-gray-200 dark:border-gray-800">
            <div>
                <h1 class="text-xl font-bold tracking-tight text-gray-950 dark:text-white flex items-center gap-2.5">
                    <x-filament::icon icon="heroicon-o-users" class="w-6 h-6 text-primary-600 dark:text-primary-400" />
                    Quản Lý Khách Hàng & Visitor 360
                </h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Theo dõi định danh, phiên duyệt web, lịch sử hội thoại và ghi chú nghiệp vụ của khách truy cập.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                    Tổng cộng: {{ $this->visitors->total() }} khách
                </span>
            </div>
        </div>

        {{-- 2-Column Workspace Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            {{-- COLUMN 1: Customer List (5 cols) --}}
            <div class="lg:col-span-5 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm flex flex-col overflow-hidden">
                {{-- Search & Filter Bar --}}
                <div class="p-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50 space-y-3">
                    <div class="relative">
                        <x-filament::icon icon="heroicon-m-magnifying-glass" class="w-4 h-4 text-gray-400 absolute left-3 top-3" />
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Tìm kiếm theo tên, UUID, email, SĐT..."
                            class="w-full pl-9 pr-4 py-2 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all placeholder:text-gray-400 dark:placeholder:text-gray-500"
                        />
                    </div>

                    <div class="flex items-center gap-2">
                        <select
                            wire:model.live="filterStatus"
                            class="w-full text-xs bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-2.5 py-1.5 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-gray-700 dark:text-gray-300"
                        >
                            <option value="all">Tất cả trạng thái</option>
                            <option value="active">Đang hoạt động</option>
                            <option value="blocked">Bị chặn</option>
                            <option value="open">Đang mở / Xử lý</option>
                            <option value="waiting_agent">Chờ nhân viên</option>
                            <option value="closed">Đã đóng</option>
                            <option value="spam">Có spam</option>
                        </select>
                    </div>
                </div>

                {{-- Loading Indicator --}}
                <div wire:loading wire:target="search, filterStatus, selectVisitor" class="p-4 text-center text-xs text-gray-500 dark:text-gray-400 bg-primary-50/30 dark:bg-primary-950/20 border-b border-primary-100 dark:border-primary-900">
                    <div class="inline-flex items-center gap-2">
                        <svg class="animate-spin h-3.5 w-3.5 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Đang cập nhật danh sách...
                    </div>
                </div>

                {{-- Visitors List --}}
                <div class="divide-y divide-gray-100 dark:divide-gray-800 max-h-[calc(100vh-320px)] overflow-y-auto">
                    @forelse ($this->visitors as $visitor)
                        @php
                            $isSelected = $selectedVisitorUuid === $visitor->visitor_uuid;
                            $initial = mb_substr($visitor->name ?? 'G', 0, 1);
                            $latestConv = $visitor->conversations->first();
                            $hasSpam = $visitor->conversations->contains('status', \App\Enums\ChatConversationStatus::Spam);
                        @endphp
                        <div
                            wire:click="selectVisitor('{{ $visitor->visitor_uuid }}')"
                            wire:key="visitor-item-{{ $visitor->visitor_uuid }}"
                            class="p-4 cursor-pointer transition-all hover:bg-gray-50 dark:hover:bg-gray-800/60 {{ $isSelected ? 'bg-primary-50/60 dark:bg-primary-950/30 border-l-4 border-primary-600 dark:border-primary-500' : '' }}"
                        >
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-sm {{ $visitor->blocked_at ? 'bg-rose-100 dark:bg-rose-900/40 text-rose-700 dark:text-rose-400' : ($isSelected ? 'bg-primary-600 text-white shadow-sm' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300') }}">
                                    {{ $initial }}
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                            {{ $visitor->name ?? 'Khách truy cập' }}
                                        </h3>
                                        <span class="text-[11px] text-gray-400 dark:text-gray-500 flex-shrink-0">
                                            {{ $visitor->created_at->diffForHumans(null, true, true) }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <span class="text-[11px] font-mono text-gray-500 dark:text-gray-400">
                                            UUID: {{ substr($visitor->visitor_uuid, 0, 8) }}...
                                        </span>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-1.5 mt-2">
                                        {{-- Moderation Status Badges --}}
                                        @if ($visitor->blocked_at)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-rose-100 dark:bg-rose-950/50 text-rose-700 dark:text-rose-400 border border-rose-200 dark:border-rose-900">
                                                Bị chặn
                                            </span>
                                        @endif

                                        @if ($hasSpam)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-amber-100 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-900">
                                                Có spam
                                            </span>
                                        @endif

                                        {{-- Conversation Count --}}
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                            {{ $visitor->conversations_count }} hội thoại
                                        </span>

                                        {{-- Session Count --}}
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                            {{ $visitor->sessions_count }} phiên
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <x-filament::icon icon="heroicon-o-users" class="w-10 h-10 mx-auto text-gray-300 dark:text-gray-600 mb-3" />
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Chưa có khách hàng</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Không tìm thấy khách truy cập nào phù hợp với điều kiện tìm kiếm.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination Links --}}
                <div class="p-3 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                    {{ $this->visitors->links() }}
                </div>
            </div>

            {{-- COLUMN 2: Customer Detail / Visitor 360 (7 cols) --}}
            <div class="lg:col-span-7 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden min-h-[500px]">
                @if ($this->selectedVisitor)
                    @php
                        $sel = $this->selectedVisitor;
                        $isBlocked = $sel->blocked_at !== null;
                        $canManageBlock = auth()->user() && \Illuminate\Support\Facades\Gate::forUser(auth()->user())->allows('blockVisitor', \App\Models\ChatConversation::class);
                    @endphp

                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        {{-- Visitor Profile Header --}}
                        <div class="p-6 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900 dark:to-gray-900/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-bold text-xl shadow-sm {{ $isBlocked ? 'bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-400 border border-rose-200 dark:border-rose-800' : 'bg-primary-600 text-white' }}">
                                    {{ mb_substr($sel->name ?? 'G', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2.5">
                                        <h2 class="text-lg font-bold text-gray-950 dark:text-white">
                                            {{ $sel->name ?? 'Khách truy cập ẩn danh' }}
                                        </h2>
                                        @if ($isBlocked)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-400 border border-rose-200 dark:border-rose-800">
                                                Bị chặn
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                                Đang hoạt động
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span class="font-mono bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded border border-gray-200 dark:border-gray-700">
                                            {{ $sel->visitor_uuid }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Moderation Action: Block / Unblock --}}
                            @if ($canManageBlock)
                                <div>
                                    @if ($isBlocked)
                                        <button
                                            type="button"
                                            wire:click="toggleBlockVisitor('{{ $sel->visitor_uuid }}')"
                                            wire:loading.attr="disabled"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition-all shadow-sm"
                                        >
                                            <x-filament::icon icon="heroicon-m-check-circle" class="w-4 h-4" />
                                            Bỏ chặn khách
                                        </button>
                                    @else
                                        <button
                                            type="button"
                                            wire:click="toggleBlockVisitor('{{ $sel->visitor_uuid }}')"
                                            wire:loading.attr="disabled"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-800 transition-all shadow-sm"
                                        >
                                            <x-filament::icon icon="heroicon-m-no-symbol" class="w-4 h-4" />
                                            Chặn khách này
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Metadata Grid --}}
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4 bg-gray-50/30 dark:bg-gray-800/20 text-xs">
                            <div class="p-3 rounded-lg bg-white dark:bg-gray-800/70 border border-gray-100 dark:border-gray-700/60">
                                <span class="text-gray-400 block mb-1">Thời gian tạo định danh</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $sel->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                            <div class="p-3 rounded-lg bg-white dark:bg-gray-800/70 border border-gray-100 dark:border-gray-700/60">
                                <span class="text-gray-400 block mb-1">Hoạt động gần nhất</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $sel->updated_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="p-3 rounded-lg bg-white dark:bg-gray-800/70 border border-gray-100 dark:border-gray-700/60">
                                <span class="text-gray-400 block mb-1">Tổng phiên / Hội thoại</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $sel->sessions->count() }} phiên / {{ $sel->conversations->count() }} cuộc
                                </span>
                            </div>
                        </div>

                        {{-- Conversation History Section --}}
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <x-filament::icon icon="heroicon-o-chat-bubble-left-right" class="w-4 h-4 text-primary-500" />
                                    Lịch sử cuộc hội thoại ({{ $sel->conversations->count() }})
                                </h3>
                            </div>

                            <div class="space-y-3">
                                @forelse ($sel->conversations as $conv)
                                    @php
                                        $channelLabel = match($conv->channel) {
                                            \App\Enums\ChatConversationChannel::Ai => 'Trợ lý AI',
                                            \App\Enums\ChatConversationChannel::Human => 'Nhân viên',
                                            \App\Enums\ChatConversationChannel::Hybrid => 'Hỗn hợp AI/Agent',
                                            default => $conv->channel->value,
                                        };
                                        $channelClass = match($conv->channel) {
                                            \App\Enums\ChatConversationChannel::Ai => 'bg-purple-100 text-purple-700 dark:bg-purple-950 dark:text-purple-300 border-purple-200 dark:border-purple-800',
                                            \App\Enums\ChatConversationChannel::Human => 'bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                                            default => 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                                        };
                                        $statusClass = match($conv->status) {
                                            \App\Enums\ChatConversationStatus::Open => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300',
                                            \App\Enums\ChatConversationStatus::Assigned => 'bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300',
                                            \App\Enums\ChatConversationStatus::WaitingAgent => 'bg-orange-100 text-orange-700 dark:bg-orange-950 dark:text-orange-300',
                                            \App\Enums\ChatConversationStatus::Closed => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
                                            \App\Enums\ChatConversationStatus::Spam => 'bg-rose-100 text-rose-700 dark:bg-rose-950 dark:text-rose-300',
                                            default => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
                                        };
                                    @endphp
                                    <div class="p-3.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-800/40 hover:border-gray-300 dark:hover:border-gray-700 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <div class="space-y-1.5">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-mono font-semibold text-gray-800 dark:text-gray-200">
                                                    #{{ substr($conv->conversation_uuid, 0, 8) }}
                                                </span>
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold {{ $statusClass }}">
                                                    {{ $conv->status->value }}
                                                </span>
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold border {{ $channelClass }}">
                                                    {{ $channelLabel }}
                                                </span>
                                            </div>

                                            @if ($conv->latestMessage)
                                                <p class="text-xs text-gray-600 dark:text-gray-300 line-clamp-1">
                                                    <span class="text-gray-400 font-medium">Tin nhắn gần nhất:</span> {{ $conv->latestMessage->message_body }}
                                                </p>
                                            @endif

                                            <div class="flex items-center gap-3 text-[11px] text-gray-400">
                                                <span>Tạo lúc: {{ $conv->created_at->format('d/m/Y H:i') }}</span>
                                                @if ($conv->assignedUser)
                                                    <span>Phụ trách: <strong class="text-gray-700 dark:text-gray-300">{{ $conv->assignedUser->name }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <button
                                                type="button"
                                                wire:click="openConversation('{{ $conv->conversation_uuid }}')"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-50 dark:bg-primary-950/50 text-primary-700 dark:text-primary-400 hover:bg-primary-100 dark:hover:bg-primary-900 border border-primary-200 dark:border-primary-800 transition-all shadow-sm"
                                            >
                                                Mở hội thoại
                                                <x-filament::icon icon="heroicon-m-arrow-top-right-on-square" class="w-3.5 h-3.5" />
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-6 text-center rounded-lg border border-dashed border-gray-200 dark:border-gray-800">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Khách truy cập chưa có cuộc hội thoại nào.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Session History Section --}}
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <x-filament::icon icon="heroicon-o-computer-desktop" class="w-4 h-4 text-primary-500" />
                                    Phiên hoạt động gần nhất ({{ $sel->sessions->count() }})
                                </h3>
                                <span class="text-[11px] text-gray-400">
                                    Bảo mật token ở tầng hệ thống
                                </span>
                            </div>

                            <div class="space-y-2">
                                @forelse ($sel->sessions as $idx => $sess)
                                    @php
                                        $isExpired = $sess->expires_at && $sess->expires_at->isPast();
                                    @endphp
                                    <div class="p-3 rounded-lg border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30 flex items-center justify-between text-xs">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium text-gray-700 dark:text-gray-300">Phiên #{{ $idx + 1 }}</span>
                                                @if ($isExpired)
                                                    <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] bg-gray-200 dark:bg-gray-800 text-gray-600 dark:text-gray-400">Đã hết hạn</span>
                                                @else
                                                    <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400">Hiệu lực</span>
                                                @endif
                                            </div>
                                            <p class="text-[11px] text-gray-400">
                                                Khởi tạo: {{ $sess->created_at->format('d/m/Y H:i:s') }}
                                            </p>
                                        </div>
                                        <div class="text-right text-[11px] text-gray-400">
                                            Hoạt động: {{ $sess->last_active_at ? $sess->last_active_at->diffForHumans() : 'N/A' }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-6 text-center rounded-lg border border-dashed border-gray-200 dark:border-gray-800">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Chưa ghi nhận phiên duyệt web nào.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Internal Notes Section --}}
                        <div class="p-6 space-y-4">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <x-filament::icon icon="heroicon-o-document-text" class="w-4 h-4 text-primary-500" />
                                Ghi chú nội bộ
                            </h3>

                            {{-- Notice --}}
                            <div class="p-3 rounded-lg bg-amber-50/70 dark:bg-amber-950/20 border border-amber-200/60 dark:border-amber-900/40 text-xs text-amber-800 dark:text-amber-300 flex items-start gap-2">
                                <x-filament::icon icon="heroicon-m-shield-check" class="w-4 h-4 flex-shrink-0 mt-0.5 text-amber-600 dark:text-amber-400" />
                                <span>Ghi chú nội bộ chỉ hiển thị với nhân viên chăm sóc khách hàng; tuyệt đối không gửi tới khách truy cập và không đưa vào bối cảnh AI.</span>
                            </div>

                            {{-- Notes List --}}
                            @php
                                $notes = $sel->conversations->flatMap->internalNotes->sortByDesc('created_at');
                            @endphp

                            <div class="space-y-2.5">
                                @forelse ($notes as $note)
                                    <div class="p-3 rounded-lg border border-gray-100 dark:border-gray-800 bg-gray-50/40 dark:bg-gray-800/30 text-xs space-y-1">
                                        <div class="flex items-center justify-between text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold text-gray-700 dark:text-gray-300">
                                                {{ $note->user->name ?? 'Nhân viên' }}
                                            </span>
                                            <span class="text-[11px]">{{ $note->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-800 dark:text-gray-200 whitespace-pre-wrap">{{ $note->note_body }}</p>
                                    </div>
                                @empty
                                    <p class="text-xs text-gray-500 dark:text-gray-400 italic">Chưa có ghi chú nội bộ nào cho khách hàng này.</p>
                                @endforelse
                            </div>

                            {{-- Add Note Form --}}
                            @if ($sel->conversations->isNotEmpty())
                                <div class="pt-2 border-t border-gray-100 dark:border-gray-800 space-y-2">
                                    <textarea
                                        wire:model="newInternalNote"
                                        placeholder="Nhập ghi chú nội bộ mới cho cuộc trò chuyện gần nhất..."
                                        rows="2"
                                        class="w-full text-xs bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-2.5 focus:ring-2 focus:ring-primary-500 focus:border-transparent placeholder:text-gray-400"
                                    ></textarea>
                                    <div class="flex justify-end">
                                        <button
                                            type="button"
                                            wire:click="addInternalNote"
                                            wire:loading.attr="disabled"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-900 hover:bg-gray-800 text-white dark:bg-gray-100 dark:hover:bg-white dark:text-gray-900 transition-all shadow-sm"
                                        >
                                            <x-filament::icon icon="heroicon-m-plus" class="w-3.5 h-3.5" />
                                            Lưu ghi chú
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    {{-- Empty Detail State --}}
                    <div class="flex flex-col items-center justify-center p-16 text-center h-full min-h-[500px]">
                        <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-4 text-gray-400 dark:text-gray-500">
                            <x-filament::icon icon="heroicon-o-user-circle" class="w-10 h-10" />
                        </div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">
                            Chưa chọn khách truy cập
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 max-w-sm">
                            Vui lòng chọn một khách truy cập từ danh sách bên trái để xem hồ sơ toàn diện (Visitor 360), lịch sử các cuộc hội thoại và phiên hoạt động.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
