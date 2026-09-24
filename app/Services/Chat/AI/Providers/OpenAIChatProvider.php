<?php

namespace App\Services\Chat\AI\Providers;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIMessage;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Exceptions\Chat\ChatAIConfigurationException;
use App\Exceptions\Chat\ChatAIException;
use App\Exceptions\Chat\ChatAIProviderException;
use App\Exceptions\Chat\ChatAITimeoutException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class OpenAIChatProvider implements ChatAIServiceInterface
{
    protected ?string $apiKey;
    protected string $model;
    protected string $baseUrl;
    protected int $timeout;
    protected int $connectTimeout;

    public function __construct(
        ?string $apiKey = null,
        ?string $model = null,
        ?string $baseUrl = null,
        ?int $timeout = null,
        ?int $connectTimeout = null
    ) {
        $this->apiKey = $apiKey ?? config('chat_ai.openai.api_key');
        $this->model = $model ?? config('chat_ai.openai.model', 'gpt-4o-mini');
        $this->baseUrl = rtrim($baseUrl ?? config('chat_ai.openai.base_url', 'https://api.openai.com/v1'), '/');
        $this->timeout = $timeout ?? (int) config('chat_ai.timeout_seconds', 15);
        $this->connectTimeout = $connectTimeout ?? (int) config('chat_ai.connect_timeout_seconds', 5);
    }

    public function isAvailable(): bool
    {
        return ! empty($this->apiKey);
    }

    public function getProviderName(): string
    {
        return 'openai';
    }

    public function generateReply(ChatAIRequest $request): ChatAIResponse
    {
        if (! $this->isAvailable()) {
            throw new ChatAIConfigurationException('OpenAI API key chưa được cấu hình.');
        }

        $endpoint = "{$this->baseUrl}/chat/completions";

        // Build messages payload
        $payloadMessages = [];
        if (! empty($request->systemPrompt)) {
            $payloadMessages[] = [
                'role' => 'system',
                'content' => $request->systemPrompt,
            ];
        }

        foreach ($request->messages as $msg) {
            /** @var ChatAIMessage $msg */
            $payloadMessages[] = [
                'role' => $msg->role,
                'content' => $msg->content,
            ];
        }

        $payload = [
            'model' => $this->model,
            'messages' => $payloadMessages,
            'temperature' => $request->temperature ?? (float) config('chat_ai.temperature', 0.7),
            'max_tokens' => $request->maxOutputTokens ?? (int) config('chat_ai.max_output_tokens', 500),
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])
            ->connectTimeout($this->connectTimeout)
            ->timeout($this->timeout)
            ->post($endpoint, $payload);
        } catch (ConnectionException $e) {
            throw new ChatAITimeoutException('Kết nối tới OpenAI API đã hết thời gian chờ (timeout).', 504, $e);
        } catch (Throwable $e) {
            throw new ChatAIProviderException('Lỗi mạng khi gửi yêu cầu tới OpenAI API.', 502, $e);
        }

        if ($response->status() === 401 || $response->status() === 403) {
            throw new ChatAIConfigurationException('OpenAI API xác thực thất bại: API key không hợp lệ hoặc đã hết hạn.');
        }

        if ($response->status() === 429) {
            throw new ChatAIProviderException('OpenAI API bị giới hạn tần suất yêu cầu (Rate Limit Exceeded).', 429);
        }

        if (! $response->successful()) {
            throw new ChatAIProviderException(
                "OpenAI API trả về lỗi HTTP {$response->status()}.",
                $response->status()
            );
        }

        $data = $response->json();
        $replyContent = $data['choices'][0]['message']['content'] ?? null;

        if ($replyContent === null || ! is_string($replyContent)) {
            throw new ChatAIProviderException('Phản hồi từ OpenAI API có định dạng không hợp lệ.');
        }

        $promptTokens = (int) ($data['usage']['prompt_tokens'] ?? 0);
        $completionTokens = (int) ($data['usage']['completion_tokens'] ?? 0);
        $totalTokens = (int) ($data['usage']['total_tokens'] ?? 0);

        return new ChatAIResponse(
            content: trim($replyContent),
            provider: $this->getProviderName(),
            model: $data['model'] ?? $this->model,
            promptTokens: $promptTokens,
            completionTokens: $completionTokens,
            totalTokens: $totalTokens,
            metadata: [
                'finish_reason' => $data['choices'][0]['finish_reason'] ?? 'stop',
                'id' => $data['id'] ?? null,
            ]
        );
    }
}
