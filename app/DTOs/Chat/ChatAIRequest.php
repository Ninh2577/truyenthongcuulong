<?php

namespace App\DTOs\Chat;

class ChatAIRequest
{
    /**
     * @param array<int, ChatAIMessage> $messages Ordered array of ChatAIMessage objects
     * @param string|null $systemPrompt Optional overriding system instruction
     * @param float|null $temperature Model generation temperature
     * @param int|null $maxOutputTokens Maximum response token limit
     * @param array<string, mixed> $metadata Arbitrary request metadata
     */
    public function __construct(
        public readonly array $messages,
        public readonly ?string $systemPrompt = null,
        public readonly ?float $temperature = null,
        public readonly ?int $maxOutputTokens = null,
        public readonly array $metadata = []
    ) {}

    public function toArray(): array
    {
        return [
            'messages' => array_map(fn (ChatAIMessage $msg) => $msg->toArray(), $this->messages),
            'system_prompt' => $this->systemPrompt,
            'temperature' => $this->temperature,
            'max_output_tokens' => $this->maxOutputTokens,
            'metadata' => $this->metadata,
        ];
    }
}
