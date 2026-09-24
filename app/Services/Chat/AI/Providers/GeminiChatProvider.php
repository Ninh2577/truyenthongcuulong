<?php

namespace App\Services\Chat\AI\Providers;

use App\Contracts\Chat\ChatAIServiceInterface;
use App\DTOs\Chat\ChatAIMessage;
use App\DTOs\Chat\ChatAIRequest;
use App\DTOs\Chat\ChatAIResponse;
use App\Exceptions\Chat\ChatAIConfigurationException;
use App\Exceptions\Chat\ChatAIProviderException;
use App\Exceptions\Chat\ChatAITimeoutException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class GeminiChatProvider implements ChatAIServiceInterface
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
        $this->apiKey = $apiKey ?? config('chat_ai.gemini.api_key');
        $this->model = $model ?? config('chat_ai.gemini.model', 'gemini-1.5-flash');
        $this->baseUrl = rtrim($baseUrl ?? config('chat_ai.gemini.base_url', 'https://generativelanguage.googleapis.com/v1beta'), '/');
        $this->timeout = $timeout ?? (int) config('chat_ai.timeout_seconds', 15);
        $this->connectTimeout = $connectTimeout ?? (int) config('chat_ai.connect_timeout_seconds', 5);
    }

    public function isAvailable(): bool
    {
        return ! empty($this->apiKey);
    }

    public function getProviderName(): string
    {
        return 'gemini';
    }

    public function generateReply(ChatAIRequest $request): ChatAIResponse
    {
        if (! $this->isAvailable()) {
            throw new ChatAIConfigurationException('Google Gemini API key chưa được cấu hình.');
        }

        $endpoint = "{$this->baseUrl}/models/{$this->model}:generateContent";

        // Map messages into Gemini contents structure
        $contents = [];
        foreach ($request->messages as $msg) {
            /** @var ChatAIMessage $msg */
            $role = match ($msg->role) {
                'user' => 'user',
                'assistant' => 'model',
                default => 'user',
            };

            $contents[] = [
                'role' => $role,
                'parts' => [
                    ['text' => $msg->content],
                ],
            ];
        }

        $payload = [
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => $request->temperature ?? (float) config('chat_ai.temperature', 0.7),
                'maxOutputTokens' => $request->maxOutputTokens ?? (int) config('chat_ai.max_output_tokens', 500),
            ],
        ];

        if (! empty($request->systemPrompt)) {
            $payload['system_instruction'] = [
                'parts' => [
                    ['text' => $request->systemPrompt],
                ],
            ];
        }

        try {
            $response = Http::withHeaders([
                'x-goog-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])
            ->connectTimeout($this->connectTimeout)
            ->timeout($this->timeout)
            ->post($endpoint, $payload);
        } catch (ConnectionException $e) {
            throw new ChatAITimeoutException('Kết nối tới Google Gemini API đã hết thời gian chờ (timeout).', 504, $e);
        } catch (Throwable $e) {
            throw new ChatAIProviderException('Lỗi mạng khi gửi yêu cầu tới Google Gemini API.', 502, $e);
        }

        if ($response->status() === 400 || $response->status() === 401 || $response->status() === 403) {
            throw new ChatAIConfigurationException('Google Gemini API xác thực thất bại: API key không hợp lệ hoặc không có quyền.');
        }

        if ($response->status() === 429) {
            throw new ChatAIProviderException('Google Gemini API bị giới hạn tần suất yêu cầu (Rate Limit Exceeded).', 429);
        }

        if (! $response->successful()) {
            throw new ChatAIProviderException(
                "Google Gemini API trả về lỗi HTTP {$response->status()}.",
                $response->status()
            );
        }

        $data = $response->json();
        $replyContent = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if ($replyContent === null || ! is_string($replyContent)) {
            throw new ChatAIProviderException('Phản hồi từ Google Gemini API có định dạng không hợp lệ.');
        }

        $promptTokens = (int) ($data['usageMetadata']['promptTokenCount'] ?? 0);
        $completionTokens = (int) ($data['usageMetadata']['candidatesTokenCount'] ?? 0);
        $totalTokens = (int) ($data['usageMetadata']['totalTokenCount'] ?? 0);

        return new ChatAIResponse(
            content: trim($replyContent),
            provider: $this->getProviderName(),
            model: $this->model,
            promptTokens: $promptTokens,
            completionTokens: $completionTokens,
            totalTokens: $totalTokens,
            metadata: [
                'finish_reason' => $data['candidates'][0]['finishReason'] ?? 'STOP',
            ]
        );
    }
}
