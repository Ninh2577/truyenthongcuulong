<?php

namespace App\Services\Chat\AI\Providers;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Exceptions\Chat\ChatAIConfigurationException;
use App\Exceptions\Chat\ChatAIException;
use App\Exceptions\Chat\ChatAITimeoutException;

class FakeChatAIProvider implements ChatAIServiceInterface
{
    protected ?string $cannedReply = null;
    protected ?ChatAIException $simulatedException = null;
    protected array $recordedRequests = [];

    public function __construct()
    {
        // Guard: Fake provider is strictly disallowed in production environment
        if (app()->environment('production')) {
            throw new ChatAIConfigurationException('FakeChatAIProvider không được phép hoạt động trên môi trường production.');
        }
    }

    public function setCannedReply(string $reply): self
    {
        $this->cannedReply = $reply;
        $this->simulatedException = null;

        return $this;
    }

    public function simulateException(ChatAIException $e): self
    {
        $this->simulatedException = $e;

        return $this;
    }

    public function simulateTimeout(): self
    {
        $this->simulatedException = new ChatAITimeoutException('Simulated AI timeout.');

        return $this;
    }

    public function generateReply(ChatAIRequest $request): ChatAIResponse
    {
        $this->recordedRequests[] = $request;

        if ($this->simulatedException !== null) {
            throw $this->simulatedException;
        }

        $replyContent = $this->cannedReply ?? 'Đây là phản hồi thử nghiệm từ FakeChatAIProvider.';

        return new ChatAIResponse(
            content: $replyContent,
            provider: 'fake',
            model: 'fake-test-model',
            promptTokens: 10,
            completionTokens: 20,
            totalTokens: 30,
            metadata: ['simulated' => true]
        );
    }

    public function isAvailable(): bool
    {
        return true;
    }

    public function getProviderName(): string
    {
        return 'fake';
    }

    public function getRecordedRequests(): array
    {
        return $this->recordedRequests;
    }

    public function getLastRecordedRequest(): ?ChatAIRequest
    {
        return empty($this->recordedRequests) ? null : end($this->recordedRequests);
    }

    public function reset(): void
    {
        $this->cannedReply = null;
        $this->simulatedException = null;
        $this->recordedRequests = [];
    }
}
