<?php

namespace App\Services\Chat;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Events\Chat\ChatConversationRead;
use App\Events\Chat\ChatConversationUpdated;
use App\Models\ChatConversation;
use App\Models\ChatVisitor;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ChatAgentConversationService
{
    /**
     * List conversations for an agent with filters, search, and deterministic ordering.
     */
    public function listConversationsForAgent(User $agent, array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        if (Gate::forUser($agent)->denies('viewAny', ChatConversation::class)) {
            throw new AccessDeniedHttpException('User is not authorized to access chat inbox.');
        }

        $query = ChatConversation::query()
            ->with(['visitor', 'assignedUser', 'closedByUser', 'latestMessage']);

        // Filter by Status (Default inbox excludes spam to keep queue clean)
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            if ($filters['status'] === 'spam') {
                if (Gate::forUser($agent)->denies('spam', ChatConversation::class)) {
                    throw new AccessDeniedHttpException('User is not authorized to view spam conversations.');
                }
            }
            $query->where('status', $filters['status']);
        } else {
            // Default view: exclude spam conversations
            $query->where('status', '!=', ChatConversationStatus::Spam->value);
        }

        // Filter by Assignment
        if (!empty($filters['assignment'])) {
            if ($filters['assignment'] === 'mine') {
                $query->where('assigned_to_user_id', $agent->id);
            } elseif ($filters['assignment'] === 'unassigned') {
                $query->whereNull('assigned_to_user_id');
            }
        }

        // Filter by unread (agent has unread messages)
        if (!empty($filters['unread_only'])) {
            $query->where('agent_unread_count', '>', 0);
        }

        // Search (by visitor name, phone, email, or conversation UUID)
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where(function ($q) use ($search) {
                $q->where('conversation_uuid', 'like', "%{$search}%")
                    ->orWhereHas('visitor', function ($vq) use ($search) {
                        $vq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%")
                            ->orWhere('visitor_uuid', 'like', "%{$search}%");
                    });
            });
        }

        $maxPerPage = (int) config('chat.conversations_per_page_max', 100);
        $perPage = max(1, min($perPage, $maxPerPage));

        return $query
            ->orderByRaw('COALESCE(last_message_at, created_at) DESC')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Retrieve conversation details with authorization check.
     */
    public function getConversation(User $agent, string $conversationUuid): ChatConversation
    {
        $conversation = ChatConversation::query()
            ->where('conversation_uuid', $conversationUuid)
            ->with(['visitor', 'assignedUser', 'closedByUser'])
            ->firstOrFail();

        if (Gate::forUser($agent)->denies('view', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to view this conversation.');
        }

        return $conversation;
    }

    /**
     * Claim a conversation for the authenticated agent.
     * Uses pessimistic locking to prevent race conditions when two agents click Claim simultaneously.
     *
     * @throws AccessDeniedHttpException
     * @throws ConflictHttpException
     */
    public function claimConversation(User $agent, ChatConversation $conversation): ChatConversation
    {
        if (Gate::forUser($agent)->denies('claim', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to claim this conversation.');
        }

        return DB::transaction(function () use ($agent, $conversation) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Check if already claimed by another agent
            if ($lockedConv->assigned_to_user_id !== null && (int) $lockedConv->assigned_to_user_id !== (int) $agent->id) {
                throw new ConflictHttpException('Cuộc trò chuyện này đã được tiếp nhận bởi nhân viên khác.');
            }

            $lockedConv->assigned_to_user_id = $agent->id;
            $lockedConv->channel = \App\Enums\ChatConversationChannel::Human;

            if ($lockedConv->status === ChatConversationStatus::Open || $lockedConv->status === ChatConversationStatus::WaitingAgent) {
                $lockedConv->status = ChatConversationStatus::Assigned;
            }

            $lockedConv->save();

            $fresh = $lockedConv->fresh(['visitor', 'assignedUser']);

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationUpdated($fresh));
            });

            return $fresh;
        });
    }

    /**
     * Reassign a conversation to another agent.
     */
    public function assignConversation(User $agent, ChatConversation $conversation, User $targetAgent): ChatConversation
    {
        if (Gate::forUser($agent)->denies('claim', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to assign this conversation.');
        }

        return DB::transaction(function () use ($conversation, $targetAgent) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedConv->assigned_to_user_id = $targetAgent->id;
            $lockedConv->channel = \App\Enums\ChatConversationChannel::Human;

            if ($lockedConv->status === ChatConversationStatus::Open || $lockedConv->status === ChatConversationStatus::WaitingAgent) {
                $lockedConv->status = ChatConversationStatus::Assigned;
            }

            $lockedConv->save();

            $fresh = $lockedConv->fresh(['visitor', 'assignedUser']);

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationUpdated($fresh));
            });

            return $fresh;
        });
    }

    /**
     * Mark conversation as read by the agent:
     * - Resets agent_unread_count to 0.
     * - Marks unread visitor messages as read.
     */
    public function markAsReadByAgent(User $agent, ChatConversation $conversation): void
    {
        if (Gate::forUser($agent)->denies('view', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to view this conversation.');
        }

        DB::transaction(function () use ($conversation) {
            $conversation->update([
                'agent_unread_count' => 0,
            ]);

            $conversation->messages()
                ->where('sender_type', ChatMessageSenderType::Visitor->value)
                ->whereNull('read_at')
                ->update([
                    'read_at' => now(),
                    'status' => ChatMessageStatus::Read->value,
                ]);

            $fresh = $conversation->fresh();

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationRead($fresh, 'agent'));
                event(new ChatConversationUpdated($fresh));
            });
        });
    }

    /**
     * Close a conversation.
     */
    public function closeConversation(User $agent, ChatConversation $conversation): ChatConversation
    {
        if (Gate::forUser($agent)->denies('close', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to close this conversation.');
        }

        return DB::transaction(function () use ($agent, $conversation) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedConv->status = ChatConversationStatus::Closed;
            $lockedConv->closed_at = now();
            $lockedConv->closed_by_user_id = $agent->id;
            $lockedConv->save();

            $fresh = $lockedConv->fresh(['visitor', 'assignedUser', 'closedByUser']);

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationUpdated($fresh));
            });

            return $fresh;
        });
    }

    /**
     * Reopen a closed conversation.
     */
    public function reopenConversation(User $agent, ChatConversation $conversation): ChatConversation
    {
        if (Gate::forUser($agent)->denies('reopen', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to reopen this conversation.');
        }

        return DB::transaction(function () use ($conversation) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedConv->status === ChatConversationStatus::Spam) {
                throw new UnprocessableEntityHttpException('Không thể mở lại cuộc trò chuyện bị đánh dấu spam.');
            }

            $lockedConv->status = $lockedConv->assigned_to_user_id
                ? ChatConversationStatus::Assigned
                : ChatConversationStatus::Open;

            $lockedConv->closed_at = null;
            $lockedConv->closed_by_user_id = null;
            $lockedConv->save();

            $fresh = $lockedConv->fresh(['visitor', 'assignedUser']);

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationUpdated($fresh));
            });

            return $fresh;
        });
    }

    /**
     * Mark a conversation as spam.
     */
    public function markAsSpam(User $agent, ChatConversation $conversation): ChatConversation
    {
        if (Gate::forUser($agent)->denies('spam', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to mark this conversation as spam.');
        }

        return DB::transaction(function () use ($conversation) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedConv->status = ChatConversationStatus::Spam;
            $lockedConv->save();

            $fresh = $lockedConv->fresh(['visitor', 'assignedUser']);

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationUpdated($fresh));
            });

            return $fresh;
        });
    }

    /**
     * Unmark a spam conversation, restoring it to open or assigned.
     */
    public function unmarkSpam(User $agent, ChatConversation $conversation): ChatConversation
    {
        if (Gate::forUser($agent)->denies('spam', $conversation)) {
            throw new AccessDeniedHttpException('User is not authorized to unmark spam for this conversation.');
        }

        return DB::transaction(function () use ($conversation) {
            /** @var ChatConversation $lockedConv */
            $lockedConv = ChatConversation::query()
                ->where('id', $conversation->id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedConv->status = $lockedConv->assigned_to_user_id
                ? ChatConversationStatus::Assigned
                : ChatConversationStatus::Open;

            $lockedConv->save();

            $fresh = $lockedConv->fresh(['visitor', 'assignedUser']);

            DB::afterCommit(function () use ($fresh) {
                event(new ChatConversationUpdated($fresh));
            });

            return $fresh;
        });
    }

    /**
     * Block a visitor and revoke all active sessions.
     */
    public function blockVisitor(User $agent, ChatVisitor $visitor): ChatVisitor
    {
        if (Gate::forUser($agent)->denies('blockVisitor', ChatConversation::class)) {
            throw new AccessDeniedHttpException('User is not authorized to block visitors.');
        }

        return DB::transaction(function () use ($visitor) {
            $visitor->update(['blocked_at' => now()]);

            // Revoke all existing sessions for this visitor by expiring them immediately
            $visitor->sessions()->update(['expires_at' => now()->subDay()]);

            return $visitor->fresh();
        });
    }

    /**
     * Unblock a previously blocked visitor.
     */
    public function unblockVisitor(User $agent, ChatVisitor $visitor): ChatVisitor
    {
        if (Gate::forUser($agent)->denies('blockVisitor', ChatConversation::class)) {
            throw new AccessDeniedHttpException('User is not authorized to unblock visitors.');
        }

        return DB::transaction(function () use ($visitor) {
            $visitor->update(['blocked_at' => null]);

            return $visitor->fresh();
        });
    }
}
