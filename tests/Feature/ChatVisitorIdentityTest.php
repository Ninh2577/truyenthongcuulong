<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyVisitorSession;
use App\Models\ChatConversation;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Services\Chat\VisitorChatAccessService;
use App\Services\Chat\VisitorSessionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Tests\TestCase;

class ChatVisitorIdentityTest extends TestCase
{
    protected VisitorSessionService $sessionService;
    protected VisitorChatAccessService $accessService;
    protected string $cookieName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->sessionService = app(VisitorSessionService::class);
        $this->accessService = app(VisitorChatAccessService::class);
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');
        RateLimiter::clear('chat-session-init');

        // Register a temporary test route protected strictly by chat.visitor middleware
        Route::get('/api/test-protected-visitor-endpoint', function (Request $request) {
            $visitor = $request->attributes->get('chat_visitor');
            return response()->json([
                'status' => 'OK',
                'visitor_uuid' => $visitor?->visitor_uuid,
            ]);
        })->middleware('chat.visitor');
    }

    /**
     * Helper to extract the chat_visitor_token cookie value from a TestResponse.
     */
    protected function getSessionTokenFromCookie($response): ?string
    {
        $cookie = $response->getCookie($this->cookieName, false);
        return $cookie ? $cookie->getValue() : null;
    }

    /**
     * Test 1: POST /api/chat/session/init creates visitor & session, returns only visitor_uuid in JSON,
     * transports token strictly via HttpOnly cookie, and persists SHA-256 hash in DB.
     */
    public function test_initial_session_creation_success(): void
    {
        $response = $this->postJson('/api/chat/session/init');

        $response->assertStatus(200);

        // JSON response only exposes visitor_uuid (plaintext token removed from JSON per canonical transport)
        $response->assertExactJson([
            'visitor_uuid' => $response->json('visitor_uuid'),
        ]);
        $this->assertTrue(Str::isUuid($response->json('visitor_uuid')));

        // Plaintext token is transported in HttpOnly cookie
        $response->assertCookie($this->cookieName);
        $rawToken = $this->getSessionTokenFromCookie($response);
        $this->assertNotNull($rawToken);
        $this->assertMatchesRegularExpression('/^[a-f0-9]{64}$/', $rawToken);

        // Assert database does NOT contain plaintext token
        $this->assertDatabaseMissing('chat_visitor_sessions', [
            'token_hash' => $rawToken,
        ]);

        // Assert database contains the SHA-256 hash
        $expectedHash = hash('sha256', $rawToken);
        $this->assertDatabaseHas('chat_visitor_sessions', [
            'token_hash' => $expectedHash,
        ]);

        // Assert response does not expose database internal IDs or plaintext token
        $response->assertJsonMissing(['id', 'token_hash', 'session_token', 'first_ip', 'user_agent']);
    }

    /**
     * Test 2: Verify token hash matches SHA-256 calculation.
     */
    public function test_token_hash_verification(): void
    {
        $response = $this->postJson('/api/chat/session/init');
        $rawToken = $this->getSessionTokenFromCookie($response);
        $this->assertNotNull($rawToken);

        $expectedHash = hash('sha256', $rawToken);
        $session = ChatVisitorSession::where('token_hash', $expectedHash)->first();

        $this->assertNotNull($session);
        $this->assertEquals($expectedHash, $session->token_hash);
        $this->assertTrue($session->expires_at->isFuture());
    }

    /**
     * Test 3: Idempotent session reuse — calling init with valid existing cookie reuses same visitor and session.
     */
    public function test_reuse_existing_valid_session(): void
    {
        $init1 = $this->postJson('/api/chat/session/init');
        $token1 = $this->getSessionTokenFromCookie($init1);
        $uuid1 = $init1->json('visitor_uuid');

        $visitorCountBefore = ChatVisitor::count();
        $sessionCountBefore = ChatVisitorSession::count();

        $init2 = $this->withCookie($this->cookieName, $token1)
            ->postJson('/api/chat/session/init');

        $init2->assertStatus(200);
        $this->assertEquals($uuid1, $init2->json('visitor_uuid'));
        $this->assertEquals($token1, $this->getSessionTokenFromCookie($init2));

        // No duplicate records created
        $this->assertEquals($visitorCountBefore, ChatVisitor::count());
        $this->assertEquals($sessionCountBefore, ChatVisitorSession::count());
    }

    /**
     * Test 4: Expired session cookie fails with 401 on protected routes, but calling init with expired cookie
     * renews session for the same visitor without losing conversation identity.
     */
    public function test_expired_session_handling(): void
    {
        $visitor = ChatVisitor::create(['name' => 'Expired Visitor Test']);
        $rawToken = bin2hex(random_bytes(32));

        // Create expired session
        $visitor->sessions()->create([
            'token_hash' => hash('sha256', $rawToken),
            'expires_at' => now()->subDay(),
            'last_active_at' => now()->subDays(2),
        ]);

        // Accessing protected endpoint with expired cookie must fail with 401
        $res = $this->withCookie($this->cookieName, $rawToken)
            ->getJson('/api/test-protected-visitor-endpoint');
        $res->assertStatus(401);

        // Initializing with expired cookie should issue a new session for the SAME visitor
        $initRes = $this->withCookie($this->cookieName, $rawToken)
            ->postJson('/api/chat/session/init');

        $initRes->assertStatus(200);
        $this->assertEquals($visitor->visitor_uuid, $initRes->json('visitor_uuid'));

        $newToken = $this->getSessionTokenFromCookie($initRes);
        $this->assertNotNull($newToken);
        $this->assertNotEquals($rawToken, $newToken);

        // New session must be valid
        $newAuth = $this->sessionService->authenticate($newToken);
        $this->assertNotNull($newAuth);
        $this->assertEquals($visitor->id, $newAuth->visitor->id);
    }

    /**
     * Test 5: Invalid/Bogus cookie returns HTTP 401 on protected endpoints.
     */
    public function test_invalid_token_returns_401(): void
    {
        $bogusToken = bin2hex(random_bytes(32));

        $res = $this->withCookie($this->cookieName, $bogusToken)
            ->getJson('/api/test-protected-visitor-endpoint');

        $res->assertStatus(401);
        $res->assertJson(['message' => 'Invalid or expired visitor session.']);
    }

    /**
     * Test 6: Blocked visitor is denied with HTTP 403 on init and protected routes.
     */
    public function test_blocked_visitor_rejected_with_403(): void
    {
        $visitor = ChatVisitor::create([
            'name' => 'Spam Visitor',
            'blocked_at' => now(),
        ]);
        $rawToken = bin2hex(random_bytes(32));
        $visitor->sessions()->create([
            'token_hash' => hash('sha256', $rawToken),
            'expires_at' => now()->addDays(30),
            'last_active_at' => now(),
        ]);

        // Attempt init with cookie
        $initRes = $this->withCookie($this->cookieName, $rawToken)
            ->postJson('/api/chat/session/init');
        $initRes->assertStatus(403);
        $initRes->assertJson(['message' => 'Visitor access has been blocked.']);

        // Attempt protected route with cookie
        $routeRes = $this->withCookie($this->cookieName, $rawToken)
            ->getJson('/api/test-protected-visitor-endpoint');
        $routeRes->assertStatus(403);
    }

    /**
     * Test 7: Device isolation — Two independent clients get distinct visitor identities and cookies.
     */
    public function test_device_isolation_creates_distinct_visitors(): void
    {
        $clientA = $this->withServerVariables(['REMOTE_ADDR' => '10.0.0.1'])
            ->postJson('/api/chat/session/init');

        $clientB = $this->withServerVariables(['REMOTE_ADDR' => '10.0.0.2'])
            ->postJson('/api/chat/session/init');

        $this->assertNotEquals($clientA->json('visitor_uuid'), $clientB->json('visitor_uuid'));
        $this->assertNotEquals(
            $this->getSessionTokenFromCookie($clientA),
            $this->getSessionTokenFromCookie($clientB)
        );
    }

    /**
     * Test 8: Conversation Ownership Verification (IDOR Prevention).
     * Visitor A cannot access Conversation B, while Visitor B can access Conversation B.
     */
    public function test_conversation_ownership_and_idor_prevention(): void
    {
        $visitorA = ChatVisitor::create(['name' => 'Visitor A']);
        $visitorB = ChatVisitor::create(['name' => 'Visitor B']);

        $convA = ChatConversation::create(['chat_visitor_id' => $visitorA->id]);
        $convB = ChatConversation::create(['chat_visitor_id' => $visitorB->id]);

        // Visitor B can access their own conversation
        $accessedConv = $this->accessService->verifyConversationOwnership($visitorB, $convB->conversation_uuid);
        $this->assertEquals($convB->id, $accessedConv->id);
        $this->assertTrue($this->accessService->canAccess($visitorB, $convB));

        // Visitor A ATTEMPTING to access Conversation B MUST fail with ModelNotFoundException (404)
        $this->expectException(ModelNotFoundException::class);
        $this->accessService->verifyConversationOwnership($visitorA, $convB->conversation_uuid);
    }

    /**
     * Test 9: Public UUID alone without matching visitor ownership is rejected.
     */
    public function test_uuid_alone_without_ownership_is_insufficient(): void
    {
        $owner = ChatVisitor::create(['name' => 'Real Owner']);
        $attacker = ChatVisitor::create(['name' => 'Attacker']);

        $conv = ChatConversation::create(['chat_visitor_id' => $owner->id]);

        // False boolean check
        $this->assertFalse($this->accessService->canAccess($attacker, $conv));

        // Exception on ownership assertion
        $this->expectException(ModelNotFoundException::class);
        $this->accessService->verifyConversationOwnership($attacker, $conv->conversation_uuid);
    }

    /**
     * Test 10: Revoked session cannot authenticate with cookie.
     */
    public function test_revoked_session_fails_authentication(): void
    {
        $response = $this->postJson('/api/chat/session/init');
        $rawToken = $this->getSessionTokenFromCookie($response);

        // Verify valid before revocation
        $resBefore = $this->withCookie($this->cookieName, $rawToken)
            ->getJson('/api/test-protected-visitor-endpoint');
        $resBefore->assertStatus(200);

        // Revoke session
        $revoked = $this->sessionService->revokeSession($rawToken);
        $this->assertTrue($revoked);

        // Authentication must now fail
        $resAfter = $this->withCookie($this->cookieName, $rawToken)
            ->getJson('/api/test-protected-visitor-endpoint');
        $resAfter->assertStatus(401);
    }

    /**
     * Test 11: Visitor blocked after session creation is immediately rejected on subsequent requests with cookie.
     */
    public function test_visitor_blocked_after_session_creation_is_rejected(): void
    {
        $response = $this->postJson('/api/chat/session/init');
        $rawToken = $this->getSessionTokenFromCookie($response);
        $visitorUuid = $response->json('visitor_uuid');

        // Works before blocking
        $this->withCookie($this->cookieName, $rawToken)
            ->getJson('/api/test-protected-visitor-endpoint')
            ->assertStatus(200);

        // Admin blocks visitor
        $visitor = ChatVisitor::where('visitor_uuid', $visitorUuid)->first();
        $visitor->update(['blocked_at' => now()]);

        // Immediately denied with 403
        $this->withCookie($this->cookieName, $rawToken)
            ->getJson('/api/test-protected-visitor-endpoint')
            ->assertStatus(403);
    }

    /**
     * Test 12: Rate limiting on POST /api/chat/session/init triggers HTTP 429 when threshold exceeded.
     */
    public function test_session_init_rate_limiting(): void
    {
        $ip = '198.51.100.99';
        $limit = (int) config('chat.session_init_rate_limit', 10);
        $hashedLimiterKey = md5('chat-session-init'.'ip:'.$ip);

        // Simulate consuming all attempts
        for ($i = 0; $i < $limit; $i++) {
            RateLimiter::hit($hashedLimiterKey, 60);
        }

        // Next request from same IP must receive 429 Too Many Requests
        $response = $this->withServerVariables(['REMOTE_ADDR' => $ip])
            ->postJson('/api/chat/session/init');

        $response->assertStatus(429);
        $this->assertTrue($response->headers->has('Retry-After'));
    }

    /**
     * Corrective Test A: Cookie authentication succeeds when valid cookie is provided.
     */
    public function test_corrective_a_cookie_authentication_succeeds(): void
    {
        $init = $this->postJson('/api/chat/session/init');
        $token = $this->getSessionTokenFromCookie($init);

        $res = $this->withCookie($this->cookieName, $token)
            ->getJson('/api/test-protected-visitor-endpoint');

        $res->assertStatus(200);
        $res->assertJson([
            'status' => 'OK',
            'visitor_uuid' => $init->json('visitor_uuid'),
        ]);
    }

    /**
     * Corrective Test B: Header token X-Visitor-Token is REJECTED when cookie is missing.
     */
    public function test_corrective_b_header_token_rejected_without_cookie(): void
    {
        $init = $this->postJson('/api/chat/session/init');
        $token = $this->getSessionTokenFromCookie($init);

        // Request with valid token in X-Visitor-Token header but NO cookie
        $res = $this->withHeader('X-Visitor-Token', $token)
            ->getJson('/api/test-protected-visitor-endpoint');

        $res->assertStatus(401);
        $res->assertJson(['message' => 'Unauthenticated visitor session.']);
    }

    /**
     * Corrective Test C: Bearer Authorization token is REJECTED when cookie is missing.
     */
    public function test_corrective_c_bearer_token_rejected_without_cookie(): void
    {
        $init = $this->postJson('/api/chat/session/init');
        $token = $this->getSessionTokenFromCookie($init);

        // Request with valid token in Authorization: Bearer header but NO cookie
        $res = $this->withToken($token)
            ->getJson('/api/test-protected-visitor-endpoint');

        $res->assertStatus(401);
        $res->assertJson(['message' => 'Unauthenticated visitor session.']);
    }

    /**
     * Corrective Test D: Cookie remains canonical and overrides/ignores any provided headers.
     */
    public function test_corrective_d_cookie_remains_canonical_ignoring_headers(): void
    {
        $init = $this->postJson('/api/chat/session/init');
        $validToken = $this->getSessionTokenFromCookie($init);
        $bogusHeaderToken = bin2hex(random_bytes(32));

        // Request sends valid cookie + bogus X-Visitor-Token and bogus Bearer headers
        $res = $this->withCookie($this->cookieName, $validToken)
            ->withHeader('X-Visitor-Token', $bogusHeaderToken)
            ->withToken($bogusHeaderToken)
            ->getJson('/api/test-protected-visitor-endpoint');

        // Must succeed because canonical cookie is evaluated exclusively
        $res->assertStatus(200);
        $res->assertJson([
            'status' => 'OK',
            'visitor_uuid' => $init->json('visitor_uuid'),
        ]);
    }

    /**
     * Corrective Test E: Session init sets cookie with HttpOnly, SameSite=Lax, and proper TTL.
     */
    public function test_corrective_e_session_init_sets_secure_cookie_attributes(): void
    {
        $response = $this->postJson('/api/chat/session/init');
        $response->assertStatus(200);

        $cookie = $response->getCookie($this->cookieName, false);
        $this->assertNotNull($cookie);

        $this->assertTrue($cookie->isHttpOnly(), 'Cookie must be HttpOnly.');
        $this->assertEquals('lax', strtolower($cookie->getSameSite() ?? ''), 'Cookie SameSite must be Lax.');
        
        // TTL verification (around 30 days)
        $expectedExpiration = now()->addDays(config('chat.visitor_session_ttl_days', 30))->timestamp;
        $this->assertEqualsWithDelta($expectedExpiration, $cookie->getExpiresTime(), 60, 'Cookie expiration must match configured TTL.');
    }
}
