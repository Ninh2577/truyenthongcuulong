<?php

namespace App\Services\Chat;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationRead;
use App\Events\Chat\ChatConversationUpdated;
use App\Models\ChatConversation;
use App\Models\ChatVisitor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ChatConversationService
{
    /**
     * Active statuses considered valid for reusing an existing ongoing conversation.
     *
     * @var array<string>
     */
    protected const ACTIVE_STATUSES = [
        ChatConversationStatus::Open->value,
        ChatConversationStatus::Assigned->value,
        ChatConversationStatus::WaitingCustomer->value,
        ChatConversationStatus::WaitingAgent->value,
    ];

    /**
     * Retrieve an active ongoing conversation for the visitor or create a new one.
     * Wrapped in a database transaction to prevent concurrent duplicate conversation creation.
     *
     * @throws AccessDeniedHttpException
     */
    public function getOrCreateActiveConversation(ChatVisitor $visitor): ChatConversation
    {
        if ($visitor->blocked_at !== null) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        return DB::transaction(function () use ($visitor) {
            // Pessimistically lock the visitor record to serialize active conversation creation for this visitor
            ChatVisitor::query()->where('id', $visitor->id)->lockForUpdate()->first();

            $activeConversation = ChatConversation::query()
                ->where('chat_visitor_id', $visitor->id)
                ->whereIn('status', self::ACTIVE_STATUSES)
                ->latest('id')
                ->lockForUpdate()
                ->first();

            if ($activeConversation) {
                return $activeConversation;
            }

            $newConversation = ChatConversation::create([
                'chat_visitor_id' => $visitor->id,
                'status' => ChatConversationStatus::Open,
                'channel' => ChatConversationChannel::Human,
                'visitor_unread_count' => 0,
                'agent_unread_count' => 0,
            ]);

            DB::afterCommit(function () use ($newConversation, $visitor) {
                app(\App\Services\Chat\Automation\ChatAutomationEngine::class)->handleTrigger('conversation_created', [
                    'conversation' => $newConversation,
                    'visitor' => $visitor,
                    'event_id' => $newConversation->conversation_uuid,
                ]);
            });

            return $newConversation;
        });
    }

    /**
     * List all conversations belonging to the authenticated visitor with pagination.
     */
    public function listVisitorConversations(ChatVisitor $visitor, int $perPage = 15): LengthAwarePaginator
    {
        if ($visitor->blocked_at !== null) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        $maxPerPage = (int) config('chat.conversations_per_page_max', 100);
        $perPage = max(1, min($perPage, $maxPerPage));

        return ChatConversation::query()
            ->where('chat_visitor_id', $visitor->id)
            ->orderByRaw('COALESCE(last_message_at, created_at) DESC')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Mark a conversation as read by the visitor:
     * - Resets visitor_unread_count to 0.
     * - Marks unread agent/bot/system messages as read.
     */
    public function markAsReadByVisitor(ChatVisitor $visitor, ChatConversation $conversation): void
    {
        if ($visitor->blocked_at !== null) {
            throw new AccessDeniedHttpException('Visitor access has been blocked.');
        }

        if ((int) $conversation->chat_visitor_id !== (int) $visitor->id) {
            return;
        }

        DB::transaction(function () use ($conversation) {
            $conversation->update([
                'visitor_unread_count' => 0,
            ]);

            $conversation->messages()
                ->where('sender_type', '!=', ChatMessageSenderType::Visitor->value)
                ->whereNull('read_at')
                ->update([
                    'read_at' => now(),
                    'status' => ChatMessageStatus::Read->value,
                ]);

            $freshConversation = $conversation->fresh();

            DB::afterCommit(function () use ($freshConversation) {
                event(new ChatConversationRead($freshConversation, 'visitor'));
                event(new ChatConversationUpdated($freshConversation));
            });
        });
    }
}
