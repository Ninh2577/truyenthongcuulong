<?php

namespace Tests\Feature;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Services\Chat\VisitorSessionService;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class ChatWidgetTest extends TestCase
{
    protected VisitorSessionService $sessionService;
    protected string $cookieName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->sessionService = app(VisitorSessionService::class);
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');
        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');
    }

    /**
     * Test that the homepage renders the chat widget and required meta tags.
     */
    public function test_homepage_renders_chat_widget_and_csrf_meta_tag(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<meta name="csrf-token"', false);
        $response->assertSee('clmChatWidget', false);
        $response->assertSee('id="chat-widget-root"', false);
        $response->assertSee('id="chat-fab-button"', false);
        $response->assertSee('id="chat-window-modal"', false);
        $response->assertSee('id="chat-message-input"', false);
        $response->assertSee('id="chat-send-btn"', false);
    }

    /**
     * Test that old WordPress AI Engine chatbot remnants are absent.
     */
    public function test_no_wordpress_chatbot_remnants_in_html(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('mwai_chatbot');
        $response->assertDontSee('chatbot-ttxs1x');
        $response->assertDontSee('ai-engine');
    }

    /**
     * Test that chat widget uses x-text and does NOT use x-html or innerHTML for messages.
     */
    public function test_chat_widget_blade_avoids_x_html_and_inner_html(): void
    {
        $viewPath = resource_path('views/components/chat/widget.blade.php');
        $this->assertFileExists($viewPath);

        $content = file_get_contents($viewPath);

        $this->assertStringNotContainsString('x-html', $content, 'Widget MUST NOT use x-html for message rendering to prevent XSS.');
        $this->assertStringNotContainsString('.innerHTML', $content, 'Widget MUST NOT assign innerHTML directly.');
        $this->assertStringContainsString('x-text="msg.message"', $content, 'Widget MUST use x-text for rendering message content.');
        $this->assertStringContainsString('x-text="formatTime(msg.created_at)"', $content, 'Widget MUST use x-text for message timestamps.');
    }

    /**
     * Test full widget HTTP lifecycle:
     * 1. Init visitor session -> receive cookie
     * 2. Create conversation
     * 3. Send message
     * 4. Poll messages (includes newly sent message)
     * 5. Mark as read
     * 6. Edit message
     * 7. Recall message
     */
    public function test_full_widget_api_interaction_lifecycle(): void
    {
        // 1. Init visitor session
        $initResponse = $this->postJson('/api/chat/session/init');
        $initResponse->assertStatus(200)
            ->assertCookie($this->cookieName)
            ->assertJsonStructure(['visitor_uuid']);

        $rawToken = $initResponse->getCookie($this->cookieName, false)?->getValue();
        $this->assertNotEmpty($rawToken);

        // 2. Create/fetch active conversation
        $convResponse = $this->withCookie($this->cookieName, $rawToken)
            ->postJson('/api/chat/conversations');

        $convResponse->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['conversation_uuid', 'status']
            ]);

        $convUuid = $convResponse->json('data.conversation_uuid');
        $this->assertNotEmpty($convUuid);

        // 3. Send message
        $sendResponse = $this->withCookie($this->cookieName, $rawToken)
            ->postJson("/api/chat/conversations/{$convUuid}/messages", [
                'message' => 'Xin chào, tôi cần tư vấn dịch vụ truyền thông!'
            ]);

        $sendResponse->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['message_uuid', 'message', 'sender_type', 'status', 'created_at']
            ]);

        $msgUuid = $sendResponse->json('data.message_uuid');
        $this->assertEquals('Xin chào, tôi cần tư vấn dịch vụ truyền thông!', $sendResponse->json('data.message'));
        $this->assertEquals('visitor', $sendResponse->json('data.sender_type'));

        // 4. Poll messages
        $messagesResponse = $this->withCookie($this->cookieName, $rawToken)
            ->getJson("/api/chat/conversations/{$convUuid}/messages");

        $messagesResponse->assertStatus(200);

        $messages = $messagesResponse->json('data');
        $this->assertIsArray($messages);
        $this->assertCount(1, $messages);
        $this->assertEquals($msgUuid, $messages[0]['message_uuid']);

        // 5. Mark as read
        $readResponse = $this->withCookie($this->cookieName, $rawToken)
            ->postJson("/api/chat/conversations/{$convUuid}/read");

        $readResponse->assertStatus(200)
            ->assertJsonPath('status', 'OK')
            ->assertJsonPath('conversation_uuid', $convUuid);

        // 6. Edit message
        $editResponse = $this->withCookie($this->cookieName, $rawToken)
            ->patchJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}", [
                'message' => 'Xin chào, tôi cần tư vấn gói sản xuất TVC chuyên nghiệp!'
            ]);

        $editResponse->assertStatus(200)
            ->assertJsonPath('data.message', 'Xin chào, tôi cần tư vấn gói sản xuất TVC chuyên nghiệp!');
        $this->assertNotNull($editResponse->json('data.edited_at'));

        // 7. Recall message
        $recallResponse = $this->withCookie($this->cookieName, $rawToken)
            ->postJson("/api/chat/conversations/{$convUuid}/messages/{$msgUuid}/recall");

        $recallResponse->assertStatus(200)
            ->assertJsonPath('data.recalled', true);
        $this->assertNull($recallResponse->json('data.message'));

        // Verify polled messages reflect recalled state
        $pollAfterRecall = $this->withCookie($this->cookieName, $rawToken)
            ->getJson("/api/chat/conversations/{$convUuid}/messages");

        $pollAfterRecall->assertStatus(200);
        $recalledMsg = $pollAfterRecall->json('data.0');
        $this->assertTrue($recalledMsg['recalled']);
        $this->assertNull($recalledMsg['message']);
    }

    /**
     * Test that widget configuration values match expected defaults.
     */
    public function test_widget_config_values(): void
    {
        $this->assertEquals(3500, config('chat.widget_poll_interval_ms'));
        $this->assertEquals(2000, config('chat.widget_max_input_length'));
        $this->assertEquals('chat_visitor_token', config('chat.cookie_name'));
    }

    /**
     * Test that CSP headers allow widget operations (connect-src includes self).
     */
    public function test_csp_allows_widget_connect_src(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $csp = $response->headers->get('Content-Security-Policy');
        if ($csp) {
            $this->assertStringContainsString("connect-src", $csp);
            $this->assertStringContainsString("'self'", $csp);
        }
    }
}
