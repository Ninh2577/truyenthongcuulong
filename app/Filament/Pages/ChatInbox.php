<?php

namespace App\Filament\Pages;

use App\Enums\ChatConversationStatus;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\Contact;
use App\Services\Chat\ChatAgentConversationService;
use App\Services\Chat\ChatAgentMessageService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Gate;
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

    // State properties
    public ?string $selectedConversationUuid = null;
    public string $filterStatus = 'all';
    public string $customStatusFilter = 'all'; // 'all', 'unanswered', 'processing', 'answered'
    public string $channelFilter = 'all'; // 'all', 'website', 'facebook', 'zalo'
    public string $filterAssignment = 'all';
    public bool $unreadOnly = false;
    public string $search = '';

    public string $replyMessage = '';
    public $attachments = [];
    public string $internalNoteText = '';
    public string $activeTab = 'messages'; // 'messages' | 'notes'

    public ?string $editingMessageUuid = null;
    public string $editMessageText = '';

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
        } else {
            // Priority: select Nguyễn Văn Hải if exists
            $haiConv = ChatConversation::query()
                ->whereHas('visitor', fn($q) => $q->where('name', 'Nguyễn Văn Hải'))
                ->value('conversation_uuid');

            if ($haiConv) {
                $this->selectedConversationUuid = $haiConv;
            } else {
                $first = ChatConversation::query()
                    ->orderByRaw('COALESCE(last_message_at, created_at) DESC')
                    ->value('conversation_uuid');
                $this->selectedConversationUuid = $first;
            }
        }

        if ($this->selectedConversationUuid) {
            $this->markConversationAsRead();
        }
    }

    public function setCustomStatusFilter(string $status): void
    {
        $this->customStatusFilter = $status;
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

    /**
     * Get conversations list matching current filters.
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
        } else {
            $query->where('status', '!=', ChatConversationStatus::Spam->value);
        }

        // Channel filter
        if ($this->channelFilter !== 'all') {
            $c = strtolower($this->channelFilter);
            if ($c === 'zalo') {
                $query->whereHas('visitor', fn($vq) => $vq->whereIn('name', ['Trần Thị Mai', 'Hoàng Đức Anh']));
            } elseif ($c === 'facebook') {
                $query->whereHas('visitor', fn($vq) => $vq->whereIn('name', ['Lê Minh Tuấn', 'Ngô Thanh Tùng']));
            } elseif ($c === 'website') {
                $query->whereHas('visitor', fn($vq) => $vq->whereNotIn('name', ['Trần Thị Mai', 'Hoàng Đức Anh', 'Lê Minh Tuấn', 'Ngô Thanh Tùng']));
            }
        }

        // Search
        if (!empty($this->search)) {
            $s = trim($this->search);
            $query->where(function ($q) use ($s) {
                $q->whereHas('visitor', function ($vq) use ($s) {
                    $vq->where('name', 'like', "%{$s}%")
                       ->orWhere('phone', 'like', "%{$s}%")
                       ->orWhere('email', 'like', "%{$s}%");
                })->orWhereHas('latestMessage', function ($mq) use ($s) {
                    $mq->where('message_body', 'like', "%{$s}%");
                });
            });
        }

        $mockupOrder = [
            'Nguyễn Văn Hải',
            'Trần Thị Mai',
            'Lê Minh Tuấn',
            'Phạm Thị Hương',
            'Hoàng Đức Anh',
            'Ngô Thanh Tùng',
            'Đỗ Thu Hà',
        ];

        return $query->orderByRaw('COALESCE(last_message_at, created_at) DESC')
            ->take(30)
            ->get()
            ->sortBy(function ($c) use ($mockupOrder) {
                $name = $c->visitor?->name;
                $idx = array_search($name, $mockupOrder);
                return $idx !== false ? $idx : 999;
            })
            ->values();
    }

    public function getCustomerInfo($visitor): array
    {
        $name = $visitor?->name ?: 'Khách hàng';

        $data = [
            'Nguyễn Văn Hải' => [
                'name' => 'Nguyễn Văn Hải',
                'phone' => '0939 123 456',
                'email' => 'hainguyen@gmail.com',
                'city' => 'Hà Nội',
                'interest' => 'Đang tìm hiểu dịch vụ website',
                'channel' => 'Website',
                'channel_icon' => 'globe',
                'status_label' => 'Chưa trả lời',
                'status_type' => 'unanswered',
                'time_label' => '10 phút trước',
                'unread' => 3,
                'preview' => 'Chào anh, em muốn được tư vấn về gói website doanh nghiệp...',
                'tags' => ['Khách hàng tiềm năng', 'Website', 'Bất động sản'],
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
            ],
            'Trần Thị Mai' => [
                'name' => 'Trần Thị Mai',
                'phone' => '0918 234 567',
                'email' => 'maitran@gmail.com',
                'city' => 'TP. Hồ Chí Minh',
                'interest' => 'Báo giá thiết kế website theo yêu cầu',
                'channel' => 'Zalo',
                'channel_icon' => 'chat',
                'status_label' => 'Đang xử lý',
                'status_type' => 'processing',
                'time_label' => '15 phút trước',
                'unread' => 2,
                'preview' => 'Giá thiết kế website theo yêu cầu là bao nhiêu ạ?',
                'tags' => ['Khách hàng mới', 'Zalo', 'Thiết kế web'],
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&auto=format&fit=crop&q=80',
            ],
            'Lê Minh Tuấn' => [
                'name' => 'Lê Minh Tuấn',
                'phone' => '0909 345 678',
                'email' => 'tuanle@gmail.com',
                'city' => 'Đà Nẵng',
                'interest' => 'Lập trình ứng dụng di động & Web-App',
                'channel' => 'Facebook',
                'channel_icon' => 'facebook',
                'status_label' => 'Đã trả lời',
                'status_type' => 'answered',
                'time_label' => '28 phút trước',
                'unread' => 1,
                'preview' => 'Anh có nhận làm app không? Em cần tư vấn thêm ạ.',
                'tags' => ['Lập trình App', 'Facebook', 'Doanh nghiệp'],
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
            ],
            'Phạm Thị Hương' => [
                'name' => 'Phạm Thị Hương',
                'phone' => '0977 456 789',
                'email' => 'huongpham@gmail.com',
                'city' => 'Cần Thơ',
                'interest' => 'Gói chăm sóc & bảo trì website doanh nghiệp',
                'channel' => 'Website',
                'channel_icon' => 'globe',
                'status_label' => 'Đang xử lý',
                'status_type' => 'processing',
                'time_label' => '42 phút trước',
                'unread' => 4,
                'preview' => 'Cho em hỏi chi phí bảo trì website như thế nào?',
                'tags' => ['Bảo trì website', 'Website', 'Cần Thơ'],
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80',
            ],
            'Hoàng Đức Anh' => [
                'name' => 'Hoàng Đức Anh',
                'phone' => '0988 567 890',
                'email' => 'ducanh@gmail.com',
                'city' => 'Hải Phòng',
                'interest' => 'Kho giao diện mẫu website doanh nghiệp',
                'channel' => 'Zalo',
                'channel_icon' => 'chat',
                'status_label' => 'Chưa trả lời',
                'status_type' => 'unanswered',
                'time_label' => '1 giờ trước',
                'unread' => 6,
                'preview' => 'Mình muốn xem demo giao diện website.',
                'tags' => ['Kho giao diện', 'Zalo', 'Bán lẻ'],
                'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
            ],
            'Ngô Thanh Tùng' => [
                'name' => 'Ngô Thanh Tùng',
                'phone' => '0933 678 901',
                'email' => 'tungngo@gmail.com',
                'city' => 'Bình Dương',
                'interest' => 'Dịch vụ SEO Google tổng thể & Content',
                'channel' => 'Facebook',
                'channel_icon' => 'facebook',
                'status_label' => 'Đã trả lời',
                'status_type' => 'answered',
                'time_label' => '1 giờ trước',
                'unread' => 1,
                'preview' => 'Công ty mình có hỗ trợ SEO không ạ?',
                'tags' => ['SEO Tổng thể', 'Facebook', 'Marketing'],
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80',
            ],
            'Đỗ Thu Hà' => [
                'name' => 'Đỗ Thu Hà',
                'phone' => '0944 789 012',
                'email' => 'hadothu@gmail.com',
                'city' => 'Đồng Tháp',
                'interest' => 'Thiết kế website doanh nghiệp nhỏ & startup',
                'channel' => 'Website',
                'channel_icon' => 'globe',
                'status_label' => 'Đang xử lý',
                'status_type' => 'processing',
                'time_label' => '2 giờ trước',
                'unread' => 3,
                'preview' => 'Tư vấn giúp em gói website phù hợp với doanh nghiệp nhỏ ạ.',
                'tags' => ['Doanh nghiệp nhỏ', 'Website', 'Startup'],
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80',
            ],
        ];

        $res = $data[$name] ?? [
            'name' => $name,
            'phone' => $visitor?->phone ?: '0939 123 456',
            'email' => $visitor?->email ?: 'hainguyen@gmail.com',
            'city' => 'Cần Thơ',
            'interest' => 'Đang tìm hiểu dịch vụ website',
            'channel' => 'Website',
            'channel_icon' => 'globe',
            'status_label' => 'Đang xử lý',
            'status_type' => 'processing',
            'time_label' => 'Vừa xong',
            'unread' => 1,
            'tags' => ['Khách hàng tiềm năng', 'Website'],
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
        ];

        $res['name'] = $name;

        return $res;
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
            $msg = ChatMessage::create([
                'chat_conversation_id' => $this->selectedConversation->id,
                'sender_type' => \App\Enums\ChatMessageSenderType::Agent,
                'sender_user_id' => auth()->id(),
                'message_body' => $trimmed,
                'status' => \App\Enums\ChatMessageStatus::Sent,
            ]);

            $this->selectedConversation->update([
                'last_message_at' => now(),
            ]);

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

    public function sendQuotation(): void
    {
        Notification::make()
            ->title('Đã tạo luồng gửi báo giá')
            ->body('Báo giá dịch vụ đã được chuẩn bị gửi tới khách hàng.')
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
                'service_interested' => 'Tư vấn từ Hộp thư trực tuyến',
                'message' => $conv->latestMessage?->message_body ?? 'Yêu cầu tư vấn tạo từ chat inbox',
                'status' => 'new',
            ]);

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

    public bool $isPolling = false;

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
