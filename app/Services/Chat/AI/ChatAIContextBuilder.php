<?php

namespace App\Services\Chat\AI;

use App\DTOs\Chat\ChatAIMessage;
use App\DTOs\Chat\ChatAIRequest;
use App\Enums\ChatMessageSenderType;
use App\Models\ChatConversation;
use App\Models\ChatMessage;

class ChatAIContextBuilder
{
    /**
     * Build a sanitized, secure ChatAIRequest from a conversation.
     *
     * SECURITY INVARIANTS:
     * - Never includes ChatInternalNote.
     * - Never includes filesystem attachment paths, private disks, or private URLs.
     * - Never includes visitor tokens, session tokens, passwords, or numeric DB IDs.
     * - Never exposes moderation internals, client IP, or user agents.
     * - Preserves UTF-8 multibyte boundary integrity.
     * - Orders messages strictly deterministically (chronological ASC).
     */
    public function build(
        ChatConversation $conversation,
        ?string $systemPrompt = null,
        ?int $maxInputChars = null,
        ?float $temperature = null,
        ?int $maxOutputTokens = null
    ): ChatAIRequest {
        $maxChars = $maxInputChars ?? (int) config('chat_ai.max_input_chars', 4000);

        // Fetch messages with deterministic chronological ordering
        $rawMessages = $conversation->messages()
            ->whereIn('sender_type', [
                ChatMessageSenderType::Visitor,
                ChatMessageSenderType::Agent,
                ChatMessageSenderType::System,
            ])
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        if ($rawMessages->isEmpty()) {
            return new ChatAIRequest(
                messages: [],
                systemPrompt: $systemPrompt,
                temperature: $temperature,
                maxOutputTokens: $maxOutputTokens,
                metadata: [
                    'conversation_uuid' => $conversation->conversation_uuid,
                    'channel' => $conversation->channel?->value ?? 'human',
                ]
            );
        }

        // Map messages into sanitized ChatAIMessage items (strictly extracting role and body)
        $mapped = [];
        foreach ($rawMessages as $msg) {
            /** @var ChatMessage $msg */
            $role = match ($msg->sender_type) {
                ChatMessageSenderType::Visitor => 'user',
                ChatMessageSenderType::Agent, ChatMessageSenderType::System => 'assistant',
                default => null,
            };

            if (! $role) {
                continue;
            }

            $body = trim((string) $msg->message_body);
            if ($body === '') {
                continue;
            }

            $mapped[] = new ChatAIMessage(
                role: $role,
                content: $body
            );
        }

        // Truncate context deterministically: preserve the most recent messages fitting in $maxChars
        $selectedMessages = $this->truncateToMaxChars($mapped, $maxChars);

        return new ChatAIRequest(
            messages: $selectedMessages,
            systemPrompt: $systemPrompt,
            temperature: $temperature,
            maxOutputTokens: $maxOutputTokens,
            metadata: [
                'conversation_uuid' => $conversation->conversation_uuid,
                'channel' => $conversation->channel?->value ?? 'human',
            ]
        );
    }

    /**
     * Select the most recent messages whose combined length does not exceed $maxChars.
     * Preserves chronological order (oldest to newest) among selected items.
     * Ensures multibyte UTF-8 safety.
     *
     * @param array<int, ChatAIMessage> $messages
     * @param int $maxChars
     * @return array<int, ChatAIMessage>
     */
    protected function truncateToMaxChars(array $messages, int $maxChars): array
    {
        if (empty($messages)) {
            return [];
        }

        $totalLength = 0;
        $selectedReverse = [];

        // Traverse backwards from newest to oldest
        for ($i = count($messages) - 1; $i >= 0; $i--) {
            $msg = $messages[$i];
            $msgLen = mb_strlen($msg->content, 'UTF-8');

            if ($totalLength + $msgLen <= $maxChars) {
                $selectedReverse[] = $msg;
                $totalLength += $msgLen;
            } else {
                // If even the latest single message exceeds $maxChars, safely truncate it
                if (empty($selectedReverse)) {
                    $truncatedContent = mb_substr($msg->content, 0, $maxChars, 'UTF-8');
                    $selectedReverse[] = new ChatAIMessage(
                        role: $msg->role,
                        content: $truncatedContent
                    );
                }
                break;
            }
        }

        // Restore original chronological order
        return array_reverse($selectedReverse);
    }
}
