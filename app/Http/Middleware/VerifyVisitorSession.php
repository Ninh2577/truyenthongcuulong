<?php

namespace App\Http\Middleware;

use App\Services\Chat\VisitorSessionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyVisitorSession
{
    public function __construct(
        protected VisitorSessionService $sessionService
    ) {}

    /**
     * Handle an incoming request and enforce visitor session authentication.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rawToken = $this->extractToken($request);

        if (empty($rawToken)) {
            return response()->json([
                'message' => 'Unauthenticated visitor session.',
            ], 401);
        }

        // Check if token belongs to an explicitly blocked visitor with active session (403 Forbidden)
        if ($this->sessionService->isTokenOfBlockedVisitor($rawToken)) {
            return response()->json([
                'message' => 'Visitor access has been blocked.',
            ], 403);
        }

        $session = $this->sessionService->authenticate($rawToken);

        if (! $session) {
            return response()->json([
                'message' => 'Invalid or expired visitor session.',
            ], 401);
        }

        // Attach authenticated visitor and session instances to request attributes
        $request->attributes->set('chat_visitor', $session->visitor);
        $request->attributes->set('chat_session', $session);

        return $next($request);
    }

    /**
     * Extract token strictly and exclusively from the canonical HttpOnly cookie.
     * All header/bearer/body fallbacks are explicitly removed.
     */
    protected function extractToken(Request $request): ?string
    {
        $cookieName = config('chat.cookie_name', 'chat_visitor_token');
        $cookie = $request->cookie($cookieName);

        return is_string($cookie) && $cookie !== '' ? trim($cookie) : null;
    }
}
