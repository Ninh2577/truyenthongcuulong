<?php

namespace App\Listeners\Chat;

use App\Enums\ChatMessageSenderType;
use App\Events\Chat\ChatMessageCreated;
use App\Events\Chat\ChatConversationUpdated;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Services\Chat\Automation\ChatAutomationEngine;

class HandleChatAutomation
{
    public function __construct(
        protected ChatAutomationEngine $engine
    ) {}

    /**
     * Handle incoming domain events for chat automation.
     */
    public function handle(object $event): void
    {
        if ($event instanceof ChatMessageCreated) {
            $this->handleMessageCreated($event);
        } elseif ($event instanceof ChatConversationUpdated) {
            $this->handleConversationUpdated($event);
        }
    }

    /**
     * Handle automated processing for incoming messages.
     * Strictly enforces loop protection: only visitor messages can trigger message_received.
     */
    protected function handleMessageCreated(ChatMessageCreated $event): void
    {
        // Loop protection check at listener boundary
        if ($event->senderType !== ChatMessageSenderType::Visitor->value) {
            return;
        }

        $message = $event->chatMessage ?: ChatMessage::where('message_uuid', $event->messageUuid)->first();
        if (! $message) {
            return;
        }

        $conversation = $message->conversation;
        if (! $conversation) {
            return;
        }

        $this->engine->handleTrigger('message_received', [
            'conversation' => $conversation,
            'message' => $message,
            'visitor' => $conversation->visitor,
            'event_id' => $event->messageUuid,
        ]);
    }

    /**
     * Handle automated processing for conversation updates.
     */
    protected function handleConversationUpdated(ChatConversationUpdated $event): void
    {
        $conversation = ChatConversation::where('conversation_uuid', $event->conversationUuid)->first();
        if (! $conversation) {
            return;
        }

        $this->engine->handleTrigger('conversation_updated', [
            'conversation' => $conversation,
            'visitor' => $conversation->visitor,
            'event_id' => $event->conversationUuid . ':' . $event->status,
        ]);
    }
}
