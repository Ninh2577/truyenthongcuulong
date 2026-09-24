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

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Khách hàng';
    protected static ?string $title = 'Khách Hàng & Visitor 360';
    protected static ?string $slug = 'chat-visitors';
    protected static ?int $navigationSort = 20;
    protected static string $view = 'filament.pages.chat-visitors';

    // State properties
    public ?string $selectedVisitorUuid = null;
    public string $search = '';
    public string $filterStatus = 'all'; // 'all', 'active', 'blocked', 'open', 'waiting_agent', 'closed', 'spam'
    public string $newInternalNote = '';

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

        $count = ChatVisitor::query()->count();

        return $count > 0 ? (string) $count : null;
    }

    public function mount(): void
    {
        abort_unless(static::canAccess(), 403);

        $requestedUuid = request()->query('visitor');
        if ($requestedUuid) {
            $this->selectedVisitorUuid = $requestedUuid;
        }
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
