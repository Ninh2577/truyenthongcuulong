<?php

namespace App\Filament\Pages;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Models\ChatConversation;
use App\Models\ChatInternalNote;
use App\Models\ChatVisitor;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Throwable;

/**
 * CHAT-15: Customer Workspace & Visitor 360 Foundation.
 * Provides a 2-column Customer 360 workspace: Customer List + Customer Detail (Profile, Sessions, Conversations, Notes).
 */
class ChatVisitorsPage extends Page
{
    use WithPagination;

    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Khách hàng';
    protected static ?string $title = 'Khách truy cập & Khách hàng';
    protected static ?string $slug = 'chat-visitors';
    protected static ?int $navigationSort = 20;
    protected static string $view = 'filament.pages.chat-visitors';

    // State properties for Chat Settings
    public bool $enable_live_chat = true;
    public string $window_position = 'bottom_right';
    public bool $enable_notifications = true;

    // Channels
    public bool $channel_website = true;
    public bool $channel_zalo = true;
    public bool $channel_messenger = false;
    public bool $channel_hotline = true;
    public bool $channel_email = true;

    // Quick Support Info
    public string $support_phone = '0939 123 456';
    public string $support_email = 'minhthuan@gmail.com';
    public string $support_hours = 'Thứ 2 - Thứ 7 (8:00 - 17:30)';
    public string $welcome_message = "Xin chào! 👋\nCảm ơn bạn đã quan tâm đến Cửu Long ID.\nVui lòng để lại thông tin, chúng tôi sẽ liên hệ sớm nhất!";

    // Interface Appearance
    public string $primary_color = '#FF6B00';
    public string $widget_position = 'Góc phải dưới cùng';
    public string $chat_icon = 'chat_bubble';

    // Auto Reply
    public bool $enable_auto_reply = true;
    public string $auto_reply_content = 'Cảm ơn bạn đã liên hệ! Chúng tôi đã nhận được tin nhắn của bạn và sẽ phản hồi sớm nhất.';
    public string $auto_reply_delay = 'Ngay lập tức';

    // Workspace & Tab State
    public string $activeWorkspaceTab = 'visitors'; // 'visitors' | 'settings'
    public ?string $selectedVisitorUuid = null;
    public string $search = '';
    public string $filterStatus = 'all'; // 'all', 'active', 'blocked', 'open', 'waiting_agent', 'closed', 'spam'
    public string $newInternalNote = '';

    public function setWorkspaceTab(string $tab): void
    {
        $this->activeWorkspaceTab = in_array($tab, ['visitors', 'settings']) ? $tab : 'visitors';
    }

    public function getTrackingData(string $visitorUuid, ?ChatVisitor $visitor = null): array
    {
        return app(\App\Services\Chat\ChatVisitorTrackingService::class)->getTracking($visitorUuid, $visitor);
    }

    public function getVisitorStatusCounts(): array
    {
        return app(\App\Services\Chat\ChatVisitorTrackingService::class)->getStatusCounts();
    }

    public function getHeading(): \Illuminate\Contracts\Support\Htmlable|string
    {
        return '';
    }

    public function getBreadcrumbs(): array
    {
        return [];
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

        return '249';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public function mount(): void
    {
        abort_unless(static::canAccess(), 403);

        $saved = \App\Models\ChatSetting::get('chat_general_settings');
        if (is_array($saved)) {
            $this->enable_live_chat = $saved['enable_live_chat'] ?? true;
            $this->window_position = $saved['window_position'] ?? 'bottom_right';
            $this->enable_notifications = $saved['enable_notifications'] ?? true;
            $this->channel_website = $saved['channel_website'] ?? true;
            $this->channel_zalo = $saved['channel_zalo'] ?? true;
            $this->channel_messenger = $saved['channel_messenger'] ?? false;
            $this->channel_hotline = $saved['channel_hotline'] ?? true;
            $this->channel_email = $saved['channel_email'] ?? true;
            $this->support_phone = $saved['support_phone'] ?? '0939 123 456';
            $this->support_email = $saved['support_email'] ?? 'minhthuan@gmail.com';
            $this->support_hours = $saved['support_hours'] ?? 'Thứ 2 - Thứ 7 (8:00 - 17:30)';
            $this->welcome_message = $saved['welcome_message'] ?? "Xin chào! 👋\nCảm ơn bạn đã quan tâm đến Cửu Long ID.\nVui lòng để lại thông tin, chúng tôi sẽ liên hệ sớm nhất!";
            $this->primary_color = $saved['primary_color'] ?? '#FF6B00';
            $this->widget_position = $saved['widget_position'] ?? 'Góc phải dưới cùng';
            $this->chat_icon = $saved['chat_icon'] ?? 'chat_bubble';
            $this->enable_auto_reply = $saved['enable_auto_reply'] ?? true;
            $this->auto_reply_content = $saved['auto_reply_content'] ?? 'Cảm ơn bạn đã liên hệ! Chúng tôi đã nhận được tin nhắn của bạn và sẽ phản hồi sớm nhất.';
            $this->auto_reply_delay = $saved['auto_reply_delay'] ?? 'Ngay lập tức';
        }

        $requestedUuid = request()->query('visitor');
        if ($requestedUuid) {
            $this->selectedVisitorUuid = $requestedUuid;
        }
    }

    public function saveSettings(): void
    {
        $data = [
            'enable_live_chat' => $this->enable_live_chat,
            'window_position' => $this->window_position,
            'enable_notifications' => $this->enable_notifications,
            'channel_website' => $this->channel_website,
            'channel_zalo' => $this->channel_zalo,
            'channel_messenger' => $this->channel_messenger,
            'channel_hotline' => $this->channel_hotline,
            'channel_email' => $this->channel_email,
            'support_phone' => $this->support_phone,
            'support_email' => $this->support_email,
            'support_hours' => $this->support_hours,
            'welcome_message' => $this->welcome_message,
            'primary_color' => $this->primary_color,
            'widget_position' => $this->widget_position,
            'chat_icon' => $this->chat_icon,
            'enable_auto_reply' => $this->enable_auto_reply,
            'auto_reply_content' => $this->auto_reply_content,
            'auto_reply_delay' => $this->auto_reply_delay,
        ];

        \App\Models\ChatSetting::set('chat_general_settings', $data, 'Cài đặt hệ thống Chat trực tuyến');

        Notification::make()
            ->title('Đã lưu cài đặt chat')
            ->body('Cấu hình chức năng chat trực tuyến đã được cập nhật thành công.')
            ->success()
            ->send();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterStatus(): void
    {
        $this->resetPage();
    }

    /**
     * Get paginated visitors list matching search and status filter.
     */
    public function getVisitorsProperty(): LengthAwarePaginator
    {
        $query = ChatVisitor::query()
            ->withCount(['conversations', 'sessions'])
            ->with([
                'conversations' => function ($q) {
                    $q->orderByDesc('last_message_at')
                        ->orderByDesc('created_at')
                        ->limit(1);
                },
            ]);

        // Search query
        $trimmedSearch = trim($this->search);
        if ($trimmedSearch !== '') {
            $query->where(function ($q) use ($trimmedSearch) {
                $q->where('name', 'like', "%{$trimmedSearch}%")
                    ->orWhere('visitor_uuid', 'like', "%{$trimmedSearch}%")
                    ->orWhere('email', 'like', "%{$trimmedSearch}%")
                    ->orWhere('phone', 'like', "%{$trimmedSearch}%");
            });
        }

        // Status filter
        match ($this->filterStatus) {
            'blocked' => $query->whereNotNull('blocked_at'),
            'active' => $query->whereNull('blocked_at'),
            'open' => $query->whereHas('conversations', function ($q) {
                $q->whereIn('status', [ChatConversationStatus::Open, ChatConversationStatus::Assigned]);
            }),
            'waiting_agent' => $query->whereHas('conversations', function ($q) {
                $q->where('status', ChatConversationStatus::WaitingAgent);
            }),
            'closed' => $query->whereHas('conversations', function ($q) {
                $q->where('status', ChatConversationStatus::Closed);
            }),
            'spam' => $query->whereHas('conversations', function ($q) {
                $q->where('status', ChatConversationStatus::Spam);
            }),
            default => null,
        };

        return $query->orderByDesc('created_at')->paginate(15);
    }

    /**
     * Get selected visitor model with relations.
     */
    public function getSelectedVisitorProperty(): ?ChatVisitor
    {
        if (! $this->selectedVisitorUuid) {
            return null;
        }

        return ChatVisitor::query()
            ->where('visitor_uuid', $this->selectedVisitorUuid)
            ->with([
                'sessions' => function ($q) {
                    $q->latest('last_active_at')->limit(10);
                },
                'conversations' => function ($q) {
                    $q->with(['latestMessage', 'assignedUser', 'closedByUser', 'internalNotes.user'])
                        ->orderByDesc('created_at');
                },
            ])
            ->first();
    }

    /**
     * Select a visitor to view in detail pane.
     */
    public function selectVisitor(string $uuid): void
    {
        $this->selectedVisitorUuid = $uuid;
        $this->newInternalNote = '';
        unset($this->selectedVisitor);
    }

    /**
     * Navigate to ChatInbox to open the selected conversation.
     */
    public function openConversation(string $conversationUuid): void
    {
        $this->redirect(route('filament.admin.pages.chat-inbox', ['conversation' => $conversationUuid]));
    }

    /**
     * Toggle block/unblock status for the selected visitor.
     * Admin only per CHAT-09 moderation invariants.
     */
    public function toggleBlockVisitor(string $visitorUuid): void
    {
        $user = auth()->user();
        if (! $user || ! Gate::forUser($user)->allows('blockVisitor', ChatConversation::class)) {
            Notification::make()
                ->title('Từ chối truy cập')
                ->body('Bạn không có quyền thực hiện thao tác chặn khách truy cập.')
                ->danger()
                ->send();

            return;
        }

        $visitor = ChatVisitor::where('visitor_uuid', $visitorUuid)->first();
        if (! $visitor) {
            return;
        }

        if ($visitor->blocked_at !== null) {
            $visitor->update(['blocked_at' => null]);
            Notification::make()
                ->title('Đã bỏ chặn khách truy cập')
                ->success()
                ->send();
        } else {
            $visitor->update(['blocked_at' => now()]);
            Notification::make()
                ->title('Đã chặn khách truy cập')
                ->warning()
                ->send();
        }

        unset($this->selectedVisitor);
    }

    /**
     * Add an internal note to the visitor's latest conversation.
     */
    public function addInternalNote(): void
    {
        $trimmed = trim($this->newInternalNote);
        if ($trimmed === '' || ! $this->selectedVisitor) {
            return;
        }

        $latestConv = $this->selectedVisitor->conversations()->latest('created_at')->first();
        if (! $latestConv) {
            Notification::make()
                ->title('Không thể thêm ghi chú')
                ->body('Khách truy cập chưa có cuộc hội thoại nào để lưu ghi chú.')
                ->warning()
                ->send();

            return;
        }

        try {
            ChatInternalNote::create([
                'chat_conversation_id' => $latestConv->id,
                'user_id' => auth()->id(),
                'note_body' => $trimmed,
            ]);

            $this->newInternalNote = '';
            unset($this->selectedVisitor);

            Notification::make()
                ->title('Đã lưu ghi chú nội bộ')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi lưu ghi chú')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
