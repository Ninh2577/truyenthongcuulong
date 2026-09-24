<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatConversationResource;
use App\Models\ChatVisitor;
use App\Services\Chat\ChatConversationService;
use App\Services\Chat\VisitorChatAccessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChatConversationController extends Controller
{
    /**
     * List all conversations owned by the authenticated visitor.
     */
    public function index(Request $request, ChatConversationService $conversationService): AnonymousResourceCollection
    {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');
        $perPage = (int) $request->query('per_page', config('chat.conversations_per_page_default', 15));

        $conversations = $conversationService->listVisitorConversations($visitor, $perPage);

        return ChatConversationResource::collection($conversations);
    }

    /**
     * Create or reuse an active conversation for the authenticated visitor.
     */
    public function store(Request $request, ChatConversationService $conversationService): JsonResponse
    {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $conversationService->getOrCreateActiveConversation($visitor);

        return (new ChatConversationResource($conversation))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Show details of a specific conversation owned by the visitor.
     */
    public function show(
        Request $request,
        string $conversationUuid,
        VisitorChatAccessService $accessService
    ): ChatConversationResource {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $accessService->verifyConversationOwnership($visitor, $conversationUuid);

        return new ChatConversationResource($conversation);
    }

    /**
     * Mark all incoming messages in the conversation as read by the visitor.
     */
    public function markRead(
        Request $request,
        string $conversationUuid,
        VisitorChatAccessService $accessService,
        ChatConversationService $conversationService
    ): JsonResponse {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $accessService->verifyConversationOwnership($visitor, $conversationUuid);
        $conversationService->markAsReadByVisitor($visitor, $conversation);

        return response()->json([
            'status' => 'OK',
            'conversation_uuid' => $conversation->conversation_uuid,
        ]);
    }
}
