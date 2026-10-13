<?php

namespace App\Listeners\Chat;

use App\Enums\ChatMessageSenderType;
use App\Events\Chat\ChatMessageCreated;
use App\Services\Chat\AI\ChatAIConversationService;

class HandleAIChatOrchestration
{
    public function __construct(
        protected ChatAIConversationService $aiConversationService
    ) {}

    /**
     * Handle the event when a new chat message is created.
     * Enforces strict loop protection: only visitor messages can invoke AI.
     */
    public function handle(ChatMessageCreated $event): void
    {
        $message = $event->chatMessage;
        if (! $message) {
            return;
        }

        // Loop Protection Invariant:
        // System, Bot, or Agent messages must NEVER trigger AI!
        if ($message->sender_type !== ChatMessageSenderType::Visitor) {
            return;
        }

        $conversation = $message->conversation;
        if (! $conversation) {
            return;
        }

        // Fail-safe pre-flight lifecycle guards:
        // Do not invoke AI if conversation is closed, marked as spam, or waiting for an agent
        if ($conversation->status === \App\Enums\ChatConversationStatus::Closed 
            || $conversation->status === \App\Enums\ChatConversationStatus::Spam
            || $conversation->status === \App\Enums\ChatConversationStatus::WaitingAgent
        ) {
            return;
        }

        // Do not invoke AI if conversation is on Human channel or already claimed by an agent
        if ($conversation->channel === \App\Enums\ChatConversationChannel::Human || $conversation->assigned_to_user_id !== null) {
            return;
        }

        // Do not invoke AI if automation engine has already responded to this visitor message
        if (\Illuminate\Support\Facades\Cache::has("chat_auto:responded:{$message->message_uuid}")) {
            return;
        }

        $this->aiConversationService->processVisitorMessage($conversation, $message);
    }
}
