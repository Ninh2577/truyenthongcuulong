<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Chat\VisitorSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;

class ChatSessionController extends Controller
{
    /**
     * Initialize or resume a visitor chat session.
     * Generates a new visitor & session if none provided, or reuses existing valid session.
     */
    public function init(Request $request, VisitorSessionService $sessionService): JsonResponse
    {
        $cookieName = config('chat.cookie_name', 'chat_visitor_token');
        $existingCookie = $request->cookie($cookieName);
        $existingToken = is_string($existingCookie) && $existingCookie !== '' ? trim($existingCookie) : null;

        $result = $sessionService->initSession(
            $existingToken,
            [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]
        );

        if (! empty($result['blocked'])) {
            return response()->json([
                'message' => 'Visitor access has been blocked.',
            ], 403);
        }

        $ttlDays = (int) config('chat.visitor_session_ttl_days', 30);

        $cookie = new Cookie(
            name: $cookieName,
            value: $result['session_token'],
            expire: now()->addDays($ttlDays),
            path: '/',
            domain: null,
            secure: $request->isSecure(),
            httpOnly: true,
            raw: false,
            sameSite: 'lax'
        );

        return response()->json([
            'visitor_uuid' => $result['visitor']->visitor_uuid,
        ], 200)->withCookie($cookie);
    }
}
