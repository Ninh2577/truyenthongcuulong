<?php

namespace App\Filament\Pages;

use App\Enums\ChatConversationStatus;
use App\Models\ChatConversation;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatAgentMessageService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Gate;
use Livewire\WithFileUploads;
use Throwable;

class ChatInbox extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Hộp thư';
    protected static ?string $title = 'Hộp Thư Chăm Sóc Khách Hàng';
    protected static ?string $slug = 'chat-inbox';
    protected static ?int $navigationSort = 10;
    protected static string $view = 'filament.pages.chat-inbox';

    // State properties
    public ?string $selectedConversationUuid = null;
    public string $filterStatus = 'all';
    public string $filterAssignment = 'all';
    public bool $unreadOnly = false;
    public string $search = '';

    public string $replyMessage = '';
    public $attachments = [];
    public string $internalNoteText = '';
    public string $activeTab = 'messages'; // 'messages' | 'notes'

    public ?string $editingMessageUuid = null;
    public string $editMessageText = '';

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

        $unread = ChatConversation::query()
            ->where('agent_unread_count', '>', 0)
            ->count();

        return $unread > 0 ? (string) $unread : null;
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
        } else {
            // Auto-select first conversation if available
            $first = ChatConversation::query()
                ->orderByRaw('COALESCE(last_message_at, created_at) DESC')
                ->value('conversation_uuid');
            $this->selectedConversationUuid = $first;
        }

        if ($this->selectedConversationUuid) {
            $this->markConversationAsRead();
        }
    }

    /**
     * Get paginated conversations list matching current filters.
     */
    public function getConversationsProperty()
    {
        /** @var ChatAgentConversationService $convService */
        $convService = app(ChatAgentConversationService::class);

        return $convService->listConversationsForAgent(auth()->user(), [
            'status' => $this->filterStatus,
            'assignment' => $this->filterAssignment,
            'unread_only' => $this->unreadOnly,
            'search' => $this->search,
        ], 50);
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
            ->with(['visitor', 'assignedUser', 'closedByUser'])
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

        /** @var ChatAgentMessageService $msgService */
        $msgService = app(ChatAgentMessageService::class);

        return $msgService->listMessages(auth()->user(), $this->selectedConversation, 100);
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

    /**
     * Select a conversation from the list.
     * CHAT-14 FIX: markConversationAsRead() is wrapped in try-catch so that
     * if it throws (e.g. auth mismatch on spam conversations), the state update
     * for selectedConversationUuid is NOT rolled back by Livewire 3.
     */
    public function selectConversation(string $uuid): void
    {
        $this->selectedConversationUuid = $uuid;
        $this->editingMessageUuid = null;
        $this->editMessageText = '';
        $this->replyMessage = '';
        unset($this->selectedConversation, $this->messages, $this->internalNotes);

        // Non-blocking: read-marking failure must NOT prevent conversation opening
        try {
            $this->markConversationAsRead();
        } catch (Throwable $e) {
            // Log for observability but do not propagate
            logger()->warning('ChatInbox: markConversationAsRead failed silently', [
                'conversation_uuid' => $uuid,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Reset unread counters on the currently open conversation.
     */
    protected function markConversationAsRead(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        if ($this->selectedConversation->agent_unread_count > 0) {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->markAsReadByAgent(auth()->user(), $this->selectedConversation);
        }
    }

    /**
     * Send agent reply message.
     */
    public function sendReply(): void
    {
        $trimmed = trim($this->replyMessage);
        $hasAttachments = ! empty($this->attachments);
        if (($trimmed === '' && ! $hasAttachments) || ! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->sendAgentMessage(auth()->user(), $this->selectedConversation, $trimmed, $this->attachments);

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
     * Remove an attachment before sending.
     */
    public function removeAttachment(int $idx): void
    {
        unset($this->attachments[$idx]);
        $this->attachments = array_values($this->attachments);
    }

    /**
     * Claim the active conversation for the logged-in agent.
     */
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

    /**
     * Close the active conversation.
     */
    public function closeConversation(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->closeConversation(auth()->user(), $this->selectedConversation);

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

    /**
     * Reopen the active conversation.
     */
    public function reopenConversation(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->reopenConversation(auth()->user(), $this->selectedConversation);

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

    /**
     * Mark the active conversation as spam.
     */
    public function markAsSpam(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->markAsSpam(auth()->user(), $this->selectedConversation);

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

    /**
     * Unmark active spam conversation.
     */
    public function unmarkSpam(): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->unmarkSpam(auth()->user(), $this->selectedConversation);

            Notification::make()
                ->title('Đã khôi phục cuộc trò chuyện')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi khôi phục cuộc trò chuyện')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Block the visitor of the active conversation.
     */
    public function blockVisitor(): void
    {
        if (! $this->selectedConversation || ! $this->selectedConversation->visitor) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->blockVisitor(auth()->user(), $this->selectedConversation->visitor);

            Notification::make()
                ->title('Đã chặn khách truy cập')
                ->warning()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi chặn khách')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Unblock the visitor of the active conversation.
     */
    public function unblockVisitor(): void
    {
        if (! $this->selectedConversation || ! $this->selectedConversation->visitor) {
            return;
        }

        try {
            /** @var ChatAgentConversationService $convService */
            $convService = app(ChatAgentConversationService::class);
            $convService->unblockVisitor(auth()->user(), $this->selectedConversation->visitor);

            Notification::make()
                ->title('Đã bỏ chặn khách truy cập')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi bỏ chặn khách')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Add an internal note to the active conversation.
     */
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

    /**
     * Start inline message editing for an agent message.
     */
    public function startEditMessage(string $uuid, string $body): void
    {
        $this->editingMessageUuid = $uuid;
        $this->editMessageText = $body;
    }

    /**
     * Cancel message editing.
     */
    public function cancelEditMessage(): void
    {
        $this->editingMessageUuid = null;
        $this->editMessageText = '';
    }

    /**
     * Save edited agent message.
     */
    public function saveEditMessage(): void
    {
        $trimmed = trim($this->editMessageText);
        if ($trimmed === '' || ! $this->selectedConversation || ! $this->editingMessageUuid) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->editAgentMessage(auth()->user(), $this->selectedConversation, $this->editingMessageUuid, $trimmed);

            $this->cancelEditMessage();
            Notification::make()
                ->title('Đã cập nhật tin nhắn')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi cập nhật tin nhắn')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Recall an agent message.
     */
    public function recallMessage(string $uuid): void
    {
        if (! $this->selectedConversation) {
            return;
        }

        try {
            /** @var ChatAgentMessageService $msgService */
            $msgService = app(ChatAgentMessageService::class);
            $msgService->recallAgentMessage(auth()->user(), $this->selectedConversation, $uuid);

            Notification::make()
                ->title('Đã thu hồi tin nhắn')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Lỗi thu hồi tin nhắn')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public bool $isPolling = false;

    /**
     * Polling handler called by wire:poll on the page.
     */
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
        } finally {
            $this->isPolling = false;
        }
    }
}
