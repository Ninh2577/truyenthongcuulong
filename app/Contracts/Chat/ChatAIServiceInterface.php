<?php

namespace App\Contracts\Chat;

use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;

interface ChatAIServiceInterface
{
    /**
     * Generate an AI reply based on the provided request context.
     *
     * @param ChatAIRequest $request
     * @return ChatAIResponse
     * @throws \App\Exceptions\Chat\ChatAIException
     */
    public function generateReply(ChatAIRequest $request): ChatAIResponse;

    /**
     * Determine if the AI service provider is available and properly configured.
     *
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * Get the identifier name of the underlying active provider.
     *
     * @return string
     */
    public function getProviderName(): string;
}
