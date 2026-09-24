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

        $this->aiConversationService->processVisitorMessage($conversation, $message);
    }
}
