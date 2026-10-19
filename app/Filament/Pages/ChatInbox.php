<?php

namespace App\Filament\Pages;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\Contact;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatAgentMessageService;
use App\Services\Chat\ChatVisitorTrackingService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Throwable;

class ChatInbox extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Hộp thư trực tuyến';
    protected static ?string $title = 'Hộp thư trực tuyến';
    protected static ?string $slug = 'chat-inbox';
    protected static ?int $navigationSort = 10;
    protected static string $view = 'filament.pages.chat-inbox';

    // Filter & search state
    public ?string $selectedConversationUuid = null;
    public string $filterStatus = 'all';
    public string $customStatusFilter = 'all'; // 'all', 'unanswered', 'processing', 'answered', 'closed'
    public string $channelFilter = 'all';      // 'all', 'website', 'facebook', 'zalo'
    public string $filterTag = 'all';          // 'all' or specific tag
    public string $filterAssignment = 'all';
    public bool $unreadOnly = false;
    public string $search = '';

    // Bulk selection state
    public array $selectedConversations = [];
    public bool $selectAll = false;

    // Composer & notes
    public string $replyMessage = '';
    public $attachments = [];
    public string $internalNoteText = '';
    public string $activeTab = 'messages'; // 'messages' | 'notes'

    // Tagging & Lead stage input
    public string $newTagInput = '';

    public ?string $editingMessageUuid = null;
    public string $editMessageText = '';

    // Realtime polling tracking
    public bool $isPolling = false;
    public int $lastKnownUnreadTotal = 0;
    public ?int $lastKnownLatestMessageId = null;
    public ?string $lastKnownLatestMessageUuid = null;

    public function getHeading(): string|Htmlable
    {
        return '';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Hộp thư trực tuyến - Cửu Long ID';
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        return Gate::forUser($user)->allows('viewAny', ChatConversation::class);
    }

    public static function getNavigationBadge(): ?string
    {
        if (! static::canAccess()) {
            return null;
        }

        $count = ChatConversation::query()
            ->where('agent_unread_count', '>', 0)
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public function mount(?string $conversation = null): void
    {
        abort_unless(static::canAccess(), 403);

        $requested = $conversation ?: request()->query('conversation');
        if ($requested) {
            $this->selectedConversationUuid = $requested;
            $this->markConversationAsRead();
        } else {
            // Select first unread conversation or most recently active
            $first = ChatConversation::query()
                ->orderByRaw("
                    CASE 
                        WHEN agent_unread_count > 0 THEN 0 
                        WHEN status IN ('waiting_agent', 'open') THEN 1 
                        ELSE 2 
                    END ASC,
                    COALESCE(last_message_at, created_at) DESC
                ")
                ->value('conversation_uuid');

            $this->selectedConversationUuid = $first;
        }

        $this->lastKnownUnreadTotal = (int) ChatConversation::where('agent_unread_count', '>', 0)->sum('agent_unread_count');
        $this->lastKnownLatestMessageId = (int) (ChatMessage::where('sender_type', ChatMessageSenderType::Visitor)->max('id') ?? 0);
        $latest = ChatMessage::where('sender_type', ChatMessageSenderType::Visitor)->latest('id')->first();
        if ($latest) {
            $this->lastKnownLatestMessageUuid = $latest->message_uuid;
        }
    }

    public function setCustomStatusFilter(string $status): void
    {
        $this->customStatusFilter = $status;
    }

    public function setTagFilter(string $tag): void
    {
        $this->filterTag = $tag;
    }

    public function getFilterCountsProperty(): array
    {
        $base = ChatConversation::query()->where('status', '!=', ChatConversationStatus::Spam->value);

        return [
            'all' => (clone $base)->count(),
            'unanswered' => (clone $base)->whereIn('status', [ChatConversationStatus::WaitingAgent->value, ChatConversationStatus::Open->value])->count(),
            'processing' => (clone $base)->where('status', ChatConversationStatus::Assigned->value)->count(),
            'answered' => (clone $base)->whereIn('status', [ChatConversationStatus::Closed->value, ChatConversationStatus::WaitingCustomer->value])->count(),
        ];
    }

    public function getAvailableTagsProperty(): array
    {
        return [
            'Khách hàng tiềm năng',
            'Website',
            'Bất động sản',
            'SEO',
            'App di động',
            'Bảo trì web',
            'Doanh nghiệp',
            'Cần Thơ',
        ];
    }

    /**
     * Get conversations list matching current filters with Section 24 sorting.
     */
    public function getConversationsProperty()
    {
        $query = ChatConversation::query()
            ->with(['visitor', 'assignedUser', 'closedByUser', 'latestMessage']);

        // Custom status filter
        if ($this->customStatusFilter === 'unanswered') {
            $query->whereIn('status', [ChatConversationStatus::WaitingAgent->value, ChatConversationStatus::Open->value]);
        } elseif ($this->customStatusFilter === 'processing') {
            $query->where('status', ChatConversationStatus::Assigned->value);
        } elseif ($this->customStatusFilter === 'answered') {
            $query->whereIn('status', [ChatConversationStatus::Closed->value, ChatConversationStatus::WaitingCustomer->value]);
        } elseif ($this->customStatusFilter === 'closed') {
            $query->where('status', ChatConversationStatus::Closed->value);
        } else {
            $query->where('status', '!=', ChatConversationStatus::Spam->value);
        }

        // Tag filter
        if ($this->filterTag !== 'all' && ! empty($this->filterTag)) {
            $tag = $this->filterTag;
            $query->where(function ($q) use ($tag) {
                $q->whereJsonContains('tags', $tag)
                    ->orWhere('tags', 'like', "%\"{$tag}\"%");
            });
        }

        // Channel filter
        if ($this->channelFilter !== 'all') {
            $query->where('channel', $this->channelFilter);
        }

        // Unread only
        if ($this->unreadOnly) {
            $query->where('agent_unread_count', '>', 0);
        }

        // Search
        if (! empty($this->search)) {
            $s = trim($this->search);
            $query->where(function ($q) use ($s) {
                $q->whereHas('visitor', function ($vq) use ($s) {
                    $vq->where('name', 'like', "%{$s}%")
                       ->orWhere('phone', 'like', "%{$s}%")
                       ->orWhere('email', 'like', "%{$s}%");
                })->orWhereHas('latestMessage', function ($mq) use ($s) {
                    $mq->where('message_body', 'like', "%{$s}%");
                })->orWhere('source_url', 'like', "%{$s}%")
                  ->orWhere('source_path', 'like', "%{$s}%")
                  ->orWhere('tags', 'like', "%{$s}%");
            });
        }

        // Section 24 Priority Ordering:
        // 1. conversation có message mới chưa đọc
        // 2. conversation đang chờ agent
        // 3. conversation mới nhất
        return $query->orderByRaw("
            CASE 
                WHEN agent_unread_count > 0 THEN 0 
                WHEN status IN ('waiting_agent', 'open') THEN 1 
                ELSE 2 
            END ASC,
            COALESCE(last_message_at, created_at) DESC
        ")
        ->take(50)
        ->get();
    }

    /**
     * Build rich, dynamic customer and tracking profile without mockups.
     */
    public function getCustomerInfo($visitor, ?ChatConversation $conversation = null): array
    {
        $conversation = $conversation ?? $this->selectedConversation;
        $visitor = $visitor ?? $conversation?->visitor;

        $name = $visitor?->name ?: 'Khách hàng #' . ($visitor?->id ?? 'mới');
        $phone = $visitor?->phone ?: 'Chưa cung cấp';
        $email = $visitor?->email ?: 'Chưa cung cấp';
        $city = 'Cần Thơ';

        // Channel
        $channelVal = $conversation?->channel?->value ?? ($conversation?->channel ?? 'website');
        $channelName = match (strtolower((string) $channelVal)) {
            'zalo' => 'Zalo',
            'facebook' => 'Facebook',
            default => 'Website',
        };

        // Status
        $statusVal = $conversation?->status?->value ?? ($conversation?->status ?? 'open');
        $statusLabel = match ($statusVal) {
            'open' => 'Chưa trả lời',
            'waiting_agent' => 'Chờ nhân viên',
            'assigned' => 'Đang xử lý',
            'waiting_customer' => 'Đang đợi khách',
            'closed' => 'Đã đóng',
            'spam' => 'Spam / Rác',
            default => 'Mới mở',
        };

        $statusType = match ($statusVal) {
            'open', 'waiting_agent' => 'unanswered',
            'assigned' => 'processing',
            default => 'answered',
        };

        $timeLabel = $conversation?->last_message_at
            ? $conversation->last_message_at->diffForHumans()
            : ($conversation?->created_at ? $conversation->created_at->diffForHumans() : 'Vừa xong');

        $unread = (int) ($conversation?->agent_unread_count ?? 0);
        $preview = $conversation?->latestMessage?->message_body ?: 'Chưa có tin nhắn';

        $tags = is_array($conversation?->tags) ? $conversation->tags : ['Khách hàng tiềm năng'];
        $leadStatus = $conversation?->lead_status ?? 'new';
        $leadStatusLabel = match ($leadStatus) {
            'contacting' => 'Đang liên hệ',
            'quoted' => 'Đã báo giá',
            'deal_closed' => 'Chốt hợp đồng',
            'cancelled' => 'Hủy',
            default => 'Mới',
        };

        $sourceUrl = $conversation?->source_url;
        $sourcePath = $conversation?->source_path ?: ($sourceUrl ? (parse_url($sourceUrl, PHP_URL_PATH) ?: $sourceUrl) : null);
        $sourceTitle = $conversation?->source_title ?: ($sourcePath ? ($sourcePath === '/' ? 'Trang chủ Website' : 'Trang: ' . $sourcePath) : 'Trang chủ Website');
        $interest = $sourceTitle ?: 'Đang tìm hiểu dịch vụ';

        // Online & Visitor tracking
        $isOnline = false;
        $deviceType = 'Desktop';
        $browser = 'Chrome';
        $os = 'Windows';
        $dwellSeconds = 0;
        $firstSeen = $visitor?->created_at?->format('d/m/Y H:i') ?? 'Hôm nay';
        $lastSeen = 'Vừa xong';
        $referrer = 'Truy cập trực tiếp (Direct)';
        $currentPage = null;
        $currentPageTitle = null;

        if ($visitor) {
            try {
                /** @var ChatVisitorTrackingService $trackingService */
                $trackingService = app(ChatVisitorTrackingService::class);
                $tracking = $trackingService->getTracking($visitor->visitor_uuid, $visitor);
                $isOnline = (bool) ($tracking['is_online'] ?? false);
                $deviceType = $tracking['device_type'] ?? 'Desktop';
                $browser = $tracking['browser'] ?? 'Trình duyệt web';
                $os = $tracking['os'] ?? 'Hệ điều hành';
                $dwellSeconds = (int) ($tracking['dwell_seconds'] ?? 0);
                if (! empty($tracking['last_seen_at'])) {
                    $lastSeen = Carbon::parse($tracking['last_seen_at'])->diffForHumans();
                }
                if (! empty($tracking['referrer'])) {
                    $referrer = $tracking['referrer'];
                }
                if (! empty($tracking['current_url'])) {
                    $currentPage = $tracking['current_url'];
                    $currentPageTitle = $tracking['page_title'] ?? null;
                    if (empty($sourceUrl)) {
                        $sourceUrl = $currentPage;
                        $sourcePath = parse_url($sourceUrl, PHP_URL_PATH) ?: $sourceUrl;
                        $sourceTitle = $currentPageTitle ?: ($sourcePath === '/' ? 'Trang chủ Website' : 'Trang: ' . $sourcePath);
                    }
                }
            } catch (Throwable) {
                // Tracking cache fallback
            }
        }

        // Safe deterministic SVG avatar using UI Initials
        $initials = mb_substr($name, 0, 2);
        $avatar = "https://ui-avatars.com/api/?name=" . urlencode($initials) . "&background=ff5400&color=ffffff&bold=true";

        return [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'city' => $city,
            'interest' => $interest,
            'channel' => $channelName,
            'channel_val' => $channelVal,
            'status_label' => $statusLabel,
            'status_type' => $statusType,
            'time_label' => $timeLabel,
            'unread' => $unread,
            'preview' => $preview,
            'tags' => $tags,
            'lead_status' => $leadStatus,
            'lead_status_label' => $leadStatusLabel,
            'source_url' => $sourceUrl,
            'source_path' => $sourcePath,
            'source_title' => $sourceTitle,
            'referrer' => $referrer,
            'current_page' => $currentPage,
            'current_page_title' => $currentPageTitle,
            'avatar' => $avatar,
            'is_online' => $isOnline,
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
            'dwell_seconds' => $dwellSeconds,
            'first_seen' => $firstSeen,
            'last_seen' => $lastSeen,
        ];
    }

    /**
     * Get currently selected conversation model.
     */
    public function getSelectedConversationProperty(): ?ChatConversation
    {
        if (! $this->selectedConversationUuid) {
            return null;
        }

        return ChatConversation::query()
            ->where('conversation_uuid', $this->selectedConversationUuid)
            ->with(['visitor', 'assignedUser', 'closedByUser', 'latestMessage'])
            ->first();
    }

    /**
     * Get messages for the selected conversation.
     */
    public function getMessagesProperty()
    {
        if (! $this->selectedConversation) {
            return collect();
        }

        return ChatMessage::where('chat_conversation_id', $this->selectedConversation->id)
            ->with('senderUser')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Get internal notes for the selected conversation.
     */
    public function getInternalNotesProperty()
    {
        if (! $this->selectedConversation) {
            return collect();
        }

        /** @var ChatAgentMessageService $msgService */
        $msgService = app(ChatAgentMessageService::class);

        return $msgService->listInternalNotes(auth()->user(), $this->selectedConversation);
    }

    public function selectConversation(string $uuid): void
    {
        $this->selectedConversationUuid = $uuid;
        $this->editingMessageUuid = null;
        $this->editMessageText = '';
        $this->replyMessage = '';
        unset($this->selectedConversation, $this->messages, $this->internalNotes);

        try {
            $this->markConversationAsRead();
        } catch (Throwable $e) {
            logger()->warning('ChatInbox: markConversationAsRead failed silently', [
                'conversation_uuid' => $uuid,
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function markConversationAsRead(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        if ($this->selectedConversation->agent_unread_count > 0) {
            $this->selectedConversation->update(['agent_unread_count' => 0]);
        }

        // Mark all unread visitor messages in this conversation as read
        ChatMessage::where('chat_conversation_id', $this->selectedConversation->id)
            ->where('sender_type', ChatMessageSenderType::Visitor)
            ->whereNull('read_at')
            ->update(['read_at' => now(), 'status' => ChatMessageStatus::Read]);

        $totalUnread = (int) ChatConversation::where('agent_unread_count', '>', 0)->sum('agent_unread_count');
        $this->dispatch('inbox-synced', ['total_unread' => $totalUnread]);
    }

    /**
     * Send agent reply message using ChatAgentMessageService.
     * Enforces client_message_id idempotency, atomic takeover, and dispatching events.
     */
    public function sendReply(?string $text = null, ?string $clientMessageId = null): void
    {
        // Support both direct text argument from JS and Livewire property binding
        if ($clientMessageId === null && $text !== null && str_starts_with($text, 'agent_')) {
            $clientMessageId = $text;
            $text = null;
        }

        $payloadText = ($text !== null && $text !== '') ? $text : $this->replyMessage;
        $trimmed = trim((string) $payloadText);
        $hasAttachments = ! empty($this->attachments);
        if (($trimmed === '' && ! $hasAttachments) || ! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->sendAgentMessage(
                auth()->user(),
                $this->selectedConversation,
                $trimmed,
                $this->attachments,
                $clientMessageId
            );

            $this->replyMessage = '';
            $this->attachments = [];
            unset($this->messages, $this->selectedConversation);
            $this->dispatch('message-sent');
        } catch (Throwable $e) {
            Notification::make()
                ->title('Không thể gửi tin nhắn')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Recall an agent message within the allowed window.
     */
    public function recallMessage(string $messageUuid): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->recallAgentMessage(auth()->user(), $this->selectedConversation, $messageUuid);

            unset($this->messages);
            Notification::make()
                ->title('Đã thu hồi tin nhắn')
                ->success()
                ->send();

            $this->dispatch('message-recalled', ['message_uuid' => $messageUuid]);
        } catch (Throwable $e) {
            Notification::make()
                ->title('Không thể thu hồi tin nhắn')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Soft delete an agent message.
     */
    public function deleteMessage(string $messageUuid): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->deleteAgentMessage(auth()->user(), $this->selectedConversation, $messageUuid);

            unset($this->messages);
            Notification::make()
                ->title('Đã xóa tin nhắn')
                ->success()
                ->send();

            $this->dispatch('message-deleted', ['message_uuid' => $messageUuid]);
        } catch (Throwable $e) {
            Notification::make()
                ->title('Không thể xóa tin nhắn')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Delete the current conversation and all associated messages.
     */
    public function deleteConversation(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->deleteConversation(auth()->user(), $this->selectedConversation);

            $this->selectedConversationUuid = null;
            unset($this->selectedConversation, $this->messages, $this->internalNotes);

            $next = ChatConversation::query()
                ->where('status', '!=', ChatConversationStatus::Spam->value)
                ->orderByRaw("
                    CASE 
                        WHEN agent_unread_count > 0 THEN 0 
                        WHEN status IN ('waiting_agent', 'open') THEN 1 
                        ELSE 2 
                    END ASC,
                    COALESCE(last_message_at, created_at) DESC
                ")
                ->value('conversation_uuid');
            $this->selectedConversationUuid = $next;
            if ($next) {
                $this->markConversationAsRead();
            }

            Notification::make()
                ->title('Đã xóa phiên trò chuyện thành công')
                ->success()
                ->send();

            $this->dispatch('inbox-synced');
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi xóa phiên chat')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Livewire 3 hook when $selectAll is updated via wire:model.live.
     */
    public function updatedSelectAll($value): void
    {
        $this->selectAll = (bool) $value;

        if ($this->selectAll) {
            $this->selectedConversations = $this->conversations->pluck('conversation_uuid')->toArray();
        } else {
            $this->selectedConversations = [];
        }
    }

    /**
     * Livewire 3 hook when $selectedConversations is updated via wire:model.live.
     */
    public function updatedSelectedConversations(): void
    {
        $allCount = $this->conversations->count();
        $this->selectAll = ($allCount > 0 && count($this->selectedConversations) === $allCount);
    }

    /**
     * Toggle selection for all visible conversations.
     */
    public function toggleSelectAll(): void
    {
        $this->selectAll = ! $this->selectAll;
        $this->updatedSelectAll($this->selectAll);
    }

    /**
     * Toggle selection of a single conversation.
     */
    public function toggleSelectConversation(string $uuid): void
    {
        if (in_array($uuid, $this->selectedConversations, true)) {
            $this->selectedConversations = array_values(array_filter($this->selectedConversations, fn ($u) => $u !== $uuid));
        } else {
            $this->selectedConversations[] = $uuid;
        }

        $this->updatedSelectedConversations();
    }

    /**
     * Clear all selections.
     */
    public function clearSelection(): void
    {
        $this->selectedConversations = [];
        $this->selectAll = false;
    }

    /**
     * Delete all currently listed conversations.
     */
    public function deleteAllConversations(): void
    {
        $allUuids = $this->conversations->pluck('conversation_uuid')->toArray();
        if (empty($allUuids)) {
            Notification::make()
                ->title('Không có phiên trò chuyện nào để xóa')
                ->warning()
                ->send();
            return;
        }

        $this->selectedConversations = $allUuids;
        $this->deleteSelectedConversations();
    }

    /**
     * Bulk delete all selected conversations.
     */
    public function deleteSelectedConversations(): void
    {
        if (empty($this->selectedConversations)) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $count = $convService->bulkDeleteConversations(auth()->user(), $this->selectedConversations);

            $wasSelectedDeleted = in_array($this->selectedConversationUuid, $this->selectedConversations, true);
            $this->selectedConversations = [];
            $this->selectAll = false;

            if ($wasSelectedDeleted) {
                $this->selectedConversationUuid = null;
                unset($this->selectedConversation, $this->messages, $this->internalNotes);

                $next = ChatConversation::query()
                    ->where('status', '!=', ChatConversationStatus::Spam->value)
                    ->orderByRaw("
                        CASE 
                            WHEN agent_unread_count > 0 THEN 0 
                            WHEN status IN ('waiting_agent', 'open') THEN 1 
                            ELSE 2 
                        END ASC,
                        COALESCE(last_message_at, created_at) DESC
                    ")
                    ->value('conversation_uuid');
                $this->selectedConversationUuid = $next;
                if ($next) {
                    $this->markConversationAsRead();
                }
            }

            unset($this->conversations);

            Notification::make()
                ->title("Đã xóa thành công {$count} phiên trò chuyện đã chọn")
                ->success()
                ->send();

            $this->dispatch('inbox-synced');
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi xóa nhiều phiên chat')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Start inline editing for an agent message.
     */
    public function startEditMessage(string $messageUuid): void
    {
        $msg = $this->selectedConversation?->messages()->where('message_uuid', $messageUuid)->first();
        if ($msg && $msg->sender_type->value === 'agent') {
            $this->editingMessageUuid = $messageUuid;
            $this->editMessageText = $msg->message_body;
        }
    }

    /**
     * Cancel editing.
     */
    public function cancelEdit(): void
    {
        $this->editingMessageUuid = null;
        $this->editMessageText = '';
    }

    /**
     * Save edited message text.
     */
    public function saveEditMessage(): void
    {
        if (! $this->editingMessageUuid || ! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->editAgentMessage(auth()->user(), $this->selectedConversation, $this->editingMessageUuid, $this->editMessageText);

            $this->editingMessageUuid = null;
            $this->editMessageText = '';
            unset($this->messages);

            Notification::make()
                ->title('Đã cập nhật nội dung tin nhắn')
                ->success()
                ->send();

            $this->dispatch('message-edited');
        } catch (Throwable $e) {
            Notification::make()
                ->title('Không thể sửa tin nhắn')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function removeAttachment(int $idx): void
    {
        unset($this->attachments[$idx]);
        $this->attachments = array_values($this->attachments);
    }

    public function claim(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->claimConversation(auth()->user(), $this->selectedConversation);
            unset($this->selectedConversation);

            Notification::make()
                ->title('Đã tiếp nhận cuộc trò chuyện')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi tiếp nhận')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function closeConversation(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->closeConversation(auth()->user(), $this->selectedConversation);
            unset($this->selectedConversation);

            Notification::make()
                ->title('Đã đóng cuộc trò chuyện')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi đóng cuộc trò chuyện')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function reopenConversation(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->reopenConversation(auth()->user(), $this->selectedConversation);
            unset($this->selectedConversation);

            Notification::make()
                ->title('Đã mở lại cuộc trò chuyện')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi mở lại cuộc trò chuyện')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function markAsSpam(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->markAsSpam(auth()->user(), $this->selectedConversation);
            unset($this->selectedConversation);

            Notification::make()
                ->title('Đã đánh dấu cuộc trò chuyện là spam')
                ->warning()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi đánh dấu spam')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function addTag(string $tag): void
    {
        $conv = $this->selectedConversation;
        if (! $conv) {
            return;
        }

        $tag = trim($tag);
        if ($tag === '') {
            return;
        }

        $currentTags = is_array($conv->tags) ? $conv->tags : [];
        if (! in_array($tag, $currentTags, true)) {
            $currentTags[] = $tag;
            $conv->update(['tags' => array_values(array_unique($currentTags))]);
            unset($this->selectedConversation);
            Notification::make()->title("Đã thêm thẻ '{$tag}'")->success()->send();
        }
        $this->newTagInput = '';
    }

    public function removeTag(string $tag): void
    {
        $conv = $this->selectedConversation;
        if (! $conv) {
            return;
        }

        $currentTags = is_array($conv->tags) ? $conv->tags : [];
        $currentTags = array_values(array_filter($currentTags, fn ($t) => $t !== $tag));
        $conv->update(['tags' => $currentTags]);
        unset($this->selectedConversation);
        Notification::make()->title("Đã gỡ thẻ '{$tag}'")->success()->send();
    }

    public function updateLeadStatus(string $status): void
    {
        $conv = $this->selectedConversation;
        if (! $conv) {
            return;
        }

        $allowed = ['new', 'contacting', 'quoted', 'deal_closed', 'cancelled'];
        if (! in_array($status, $allowed, true)) {
            return;
        }

        $conv->update(['lead_status' => $status]);
        unset($this->selectedConversation);
        Notification::make()->title('Đã cập nhật giai đoạn khách hàng')->success()->send();
    }

    public function sendQuotation(): void
    {
        $this->updateLeadStatus('quoted');
        Notification::make()
            ->title('Đã tạo luồng gửi báo giá')
            ->body('Báo giá dịch vụ đã được chuẩn bị và chuyển trạng thái sang "Đã báo giá".')
            ->success()
            ->send();
    }

    public function createConsultation(): void
    {
        $conv = $this->selectedConversation;
        if ($conv && $conv->visitor) {
            Contact::create([
                'fullname' => $conv->visitor->name ?? 'Khách từ Hộp thư',
                'phone' => $conv->visitor->phone ?? '0939 123 456',
                'email' => $conv->visitor->email ?? 'hainguyen@gmail.com',
                'channel' => 'inbox',
                'service_interested' => $conv->source_title ?? 'Tư vấn từ Hộp thư trực tuyến',
                'message' => $conv->latestMessage?->message_body ?? 'Yêu cầu tư vấn tạo từ chat inbox',
                'status' => 'new',
            ]);

            $this->updateLeadStatus('contacting');

            Notification::make()
                ->title('Đã tạo yêu cầu tư vấn thành công')
                ->body('Hệ thống đã thêm liên hệ vào danh sách Yêu Cầu Tư Vấn.')
                ->success()
                ->send();
        }
    }

    public function addNote(): void
    {
        $trimmed = trim($this->internalNoteText);
        if ($trimmed === '' || ! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->addInternalNote(auth()->user(), $this->selectedConversation, $trimmed);

            $this->internalNoteText = '';
            Notification::make()
                ->title('Đã thêm ghi chú nội bộ')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi thêm ghi chú')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function poll(): void
    {
        if ($this->isPolling) {
            return;
        }

        $this->isPolling = true;

        try {
            if ($this->selectedConversation && $this->selectedConversation->agent_unread_count > 0) {
                $this->markConversationAsRead();
            }

            $totalUnread = (int) ChatConversation::where('agent_unread_count', '>', 0)->sum('agent_unread_count');

            // Only find messages genuinely newer than the last known message ID
            $latestVisitorMsg = ChatMessage::query()
                ->where('sender_type', ChatMessageSenderType::Visitor)
                ->where('id', '>', (int) $this->lastKnownLatestMessageId)
                ->with(['conversation.visitor'])
                ->latest('id')
                ->first();

            if ($latestVisitorMsg) {
                $this->lastKnownLatestMessageId = $latestVisitorMsg->id;
                $this->lastKnownLatestMessageUuid = $latestVisitorMsg->message_uuid;

                $conv = $latestVisitorMsg->conversation;
                $isCurrent = ($this->selectedConversationUuid === $conv?->conversation_uuid);

                $this->dispatch('incoming-customer-message', [
                    'message_uuid' => $latestVisitorMsg->message_uuid,
                    'conversation_uuid' => $conv?->conversation_uuid,
                    'customer_name' => $conv?->visitor?->name ?: 'Khách hàng',
                    'preview' => Str::limit($latestVisitorMsg->message_body, 80),
                    'total_unread' => $totalUnread,
                    'source_url' => $conv?->source_url,
                    'is_current_conversation' => $isCurrent,
                ]);
            }

            // Check typing status for selected conversation
            $isVisitorTyping = false;
            if ($this->selectedConversationUuid) {
                $typingData = \Illuminate\Support\Facades\Cache::get("chat:typing:conversation:{$this->selectedConversationUuid}:visitor");
                if (is_array($typingData) && (now()->timestamp - ($typingData['typed_at'] ?? 0)) <= 4) {
                    $isVisitorTyping = true;
                }
            }
            $this->dispatch('visitor-typing-status', ['is_typing' => $isVisitorTyping]);

            $this->lastKnownUnreadTotal = $totalUnread;
            $this->dispatch('inbox-synced', ['total_unread' => $totalUnread]);
        } finally {
            $this->isPolling = false;
        }
    }

    /**
     * Agent typing indicator notification to visitor.
     */
    public function setAgentTyping(bool $typing): void
    {
        if (! $this->selectedConversationUuid) {
            return;
        }

        $cacheKey = "chat:typing:conversation:{$this->selectedConversationUuid}:agent";
        if ($typing) {
            \Illuminate\Support\Facades\Cache::put($cacheKey, [
                'agent_id' => auth()->id(),
                'name' => auth()->user()?->name ?: 'Nhân viên CSKH',
                'typed_at' => now()->timestamp,
            ], now()->addSeconds(4));
        } else {
            \Illuminate\Support\Facades\Cache::forget($cacheKey);
        }
    }
}
