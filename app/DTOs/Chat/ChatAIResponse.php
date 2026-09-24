<?php

namespace App\DTOs\Chat;

class ChatAIResponse
{
    /**
     * @param string $content Generated response text (strictly plain text, treated as untrusted external data)
     * @param string $provider Name of the provider ('openai', 'gemini', 'fake')
     * @param string|null $model Model identifier used for generation
     * @param int $promptTokens Number of tokens in prompt
     * @param int $completionTokens Number of tokens in completion
     * @param int $totalTokens Total token count
     * @param array<string, mixed> $metadata Additional provider metadata
     */
    public function __construct(
        public readonly string $content,
        public readonly string $provider,
        public readonly ?string $model = null,
        public readonly int $promptTokens = 0,
        public readonly int $completionTokens = 0,
        public readonly int $totalTokens = 0,
        public readonly array $metadata = []
    ) {}

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'provider' => $this->provider,
            'model' => $this->model,
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'total_tokens' => $this->totalTokens,
            'metadata' => $this->metadata,
        ];
    }
}
