<?php

namespace Tests\Feature\ChatAI;

use App\DTOs\Chat\ChatAIMessage;
use App\DTOs\Chat\ChatAIRequest;
use App\Services\Chat\AI\ChatAIBusinessGuard;
use App\Services\Chat\AI\ChatAIPromptBuilder;
use App\Services\Chat\AI\Providers\OpenAIChatProvider;
use Tests\TestCase;

class ChatAILiveOpenAITest extends TestCase
{
    protected ?string $apiKey;
    protected string $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiKey = env('OPENAI_API_KEY') ?: config('chat_ai.openai.api_key');
        $this->model = env('OPENAI_MODEL') ?: config('chat_ai.openai.model', 'gpt-4o-mini');
    }

    protected function requiresLiveApiKey(): void
    {
        if (empty($this->apiKey) || $this->apiKey === 'test-dummy-api-key' || ! str_starts_with($this->apiKey, 'sk-')) {
            $this->markTestSkipped('Live OPENAI_API_KEY is not configured in the environment. Skipping live integration test.');
        }
    }

    /**
     * LIVE TEST 01: Live OpenAI API connection and basic Vietnamese greeting.
     */
    public function test_live_01_openai_connection_and_greeting(): void
    {
        $this->requiresLiveApiKey();

        $provider = new OpenAIChatProvider(
            apiKey: $this->apiKey,
            model: $this->model,
            timeout: 15
        );

        $systemPrompt = ChatAIPromptBuilder::getSystemPrompt();
        $request = new ChatAIRequest(
            messages: [
                new ChatAIMessage(role: 'user', content: 'Xin chào Cửu Long Media'),
            ],
            systemPrompt: $systemPrompt,
            maxOutputTokens: 150
        );

        $startTime = microtime(true);
        $response = $provider->generateReply($request);
        $duration = microtime(true) - $startTime;

        $this->assertNotEmpty($response->content);
        $this->assertGreaterThan(0, $response->totalTokens);
        $this->assertLessThan(15.0, $duration);
    }

    /**
     * LIVE TEST 02: Business compliance on media job inquiry under live OpenAI.
     */
    public function test_live_02_openai_media_suspension_compliance(): void
    {
        $this->requiresLiveApiKey();

        $provider = new OpenAIChatProvider(
            apiKey: $this->apiKey,
            model: $this->model,
            timeout: 15
        );

        $systemPrompt = ChatAIPromptBuilder::getSystemPrompt();
        $request = new ChatAIRequest(
            messages: [
                new ChatAIMessage(role: 'user', content: 'Bên bạn có nhận quay phim sự kiện đám cưới cuối tuần này không?'),
            ],
            systemPrompt: $systemPrompt,
            maxOutputTokens: 200
        );

        $response = $provider->generateReply($request);

        // Run through business guard
        $guard = new ChatAIBusinessGuard();
        $enforced = $guard->validateAndEnforce($response->content);

        $this->assertStringContainsString('tạm ngưng', mb_strtolower($enforced, 'UTF-8'));
    }
}
