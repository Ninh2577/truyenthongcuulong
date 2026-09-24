<?php

namespace App\Services\Chat\AI;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Exceptions\Chat\ChatAIConfigurationException;
use App\Exceptions\Chat\ChatAIUnavailableException;
use App\Services\Chat\AI\Providers\FakeChatAIProvider;
use App\Services\Chat\AI\Providers\GeminiChatProvider;
use App\Services\Chat\AI\Providers\NoneChatAIProvider;
use App\Services\Chat\AI\Providers\OpenAIChatProvider;

class ChatAIManager implements ChatAIServiceInterface
{
    protected ?ChatAIServiceInterface $resolvedProvider = null;

    /**
     * Resolve the active AI provider strictly based on server configuration.
     */
    public function getProvider(): ChatAIServiceInterface
    {
        if ($this->resolvedProvider !== null) {
            return $this->resolvedProvider;
        }

        $settings = app(ChatAISettingsResolver::class);
        $enabled = $settings->isEnabled();
        if (! $enabled) {
            return $this->resolvedProvider = new NoneChatAIProvider();
        }

        $providerName = $settings->getProvider();

        $this->resolvedProvider = match ($providerName) {
            'none', '' => new NoneChatAIProvider(),
            'fake' => new FakeChatAIProvider(),
            'openai' => new OpenAIChatProvider(),
            'gemini' => new GeminiChatProvider(),
            default => throw new ChatAIConfigurationException("Nhà cung cấp AI '{$providerName}' không được hỗ trợ."),
        };

        return $this->resolvedProvider;
    }

    /**
     * Set a custom provider instance (used for testing and dependency injection).
     */
    public function setProvider(ChatAIServiceInterface $provider): self
    {
        $this->resolvedProvider = $provider;

        return $this;
    }

    /**
     * Reset the resolved provider (forces re-resolution from configuration).
     */
    public function resetProvider(): void
    {
        $this->resolvedProvider = null;
    }

    public function generateReply(ChatAIRequest $request): ChatAIResponse
    {
        $provider = $this->getProvider();

        if (! $provider->isAvailable()) {
            throw new ChatAIUnavailableException('Dịch vụ AI hiện không khả dụng.');
        }

        return $provider->generateReply($request);
    }

    public function isAvailable(): bool
    {
        return $this->getProvider()->isAvailable();
    }

    public function getProviderName(): string
    {
        return $this->getProvider()->getProviderName();
    }
}
