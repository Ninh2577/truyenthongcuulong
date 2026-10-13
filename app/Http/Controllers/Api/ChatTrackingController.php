<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use App\Services\Chat\ChatVisitorTrackingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatTrackingController extends Controller
{
    public function __construct(
        protected ChatVisitorTrackingService $trackingService
    ) {}

    /**
     * Record visitor heartbeat and update realtime tracking metrics.
     */
    public function heartbeat(Request $request): JsonResponse
    {
        /** @var ChatVisitor|null $visitor */
        $visitor = $request->attributes->get('chat_visitor');
        /** @var ChatVisitorSession|null $session */
        $session = $request->attributes->get('chat_session');

        if (! $visitor) {
            return response()->json([
                'message' => 'Visitor not found for current session.',
            ], 401);
        }

        $validated = $request->validate([
            'current_url' => ['nullable', 'string', 'max:500'],
            'page_title' => ['nullable', 'string', 'max:255'],
            'referrer' => ['nullable', 'string', 'max:500'],
        ]);

        $payload = array_merge($validated, [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $data = $this->trackingService->recordHeartbeat($visitor, $session, $payload);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }
}
