<?php

namespace App\Services\Chat\AI\Providers;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Exceptions\Chat\ChatAIUnavailableException;

class NoneChatAIProvider implements ChatAIServiceInterface
{
    public function generateReply(ChatAIRequest $request): ChatAIResponse
    {
        throw new ChatAIUnavailableException('Dịch vụ AI chưa được kích hoạt hoặc nhà cung cấp chưa được cấu hình.');
    }

    public function isAvailable(): bool
    {
        return false;
    }

    public function getProviderName(): string
    {
        return 'none';
    }
}
