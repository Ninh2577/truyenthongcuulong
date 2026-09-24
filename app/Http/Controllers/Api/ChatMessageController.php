<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\EditMessageRequest;
use App\Http\Requests\Chat\SendMessageRequest;
use App\Http\Resources\Chat\ChatMessageResource;
use App\Models\ChatVisitor;
use App\Services\Chat\ChatMessageService;
use App\Services\Chat\VisitorChatAccessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChatMessageController extends Controller
{
    /**
     * List messages for a conversation owned by the authenticated visitor.
     */
    public function index(
        Request $request,
        string $conversationUuid,
        VisitorChatAccessService $accessService,
        ChatMessageService $messageService
    ): AnonymousResourceCollection {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $accessService->verifyConversationOwnership($visitor, $conversationUuid);
        $perPage = (int) $request->query('per_page', config('chat.messages_per_page_default', 30));
        $afterUuid = $request->query('after_uuid');

        $messages = $messageService->listMessages($conversation, $perPage, $afterUuid);

        return ChatMessageResource::collection($messages);
    }

    /**
     * Send a new message to the conversation.
     */
    public function store(
        SendMessageRequest $request,
        string $conversationUuid,
        VisitorChatAccessService $accessService,
        ChatMessageService $messageService
    ): JsonResponse {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $accessService->verifyConversationOwnership($visitor, $conversationUuid);

        $files = $request->file('attachments');
        if (! is_array($files)) {
            $single = $request->file('attachment') ?: $request->file('file');
            $files = $single ? [$single] : [];
        }

        $message = $messageService->sendMessage($visitor, $conversation, $request->input('message'), $files);

        return (new ChatMessageResource($message))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Edit a visitor message within the allowed time window (default 15 minutes).
     */
    public function update(
        EditMessageRequest $request,
        string $conversationUuid,
        string $messageUuid,
        VisitorChatAccessService $accessService,
        ChatMessageService $messageService
    ): ChatMessageResource {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $accessService->verifyConversationOwnership($visitor, $conversationUuid);
        $message = $messageService->editMessage($visitor, $conversation, $messageUuid, $request->input('message'));

        return new ChatMessageResource($message);
    }

    /**
     * Soft recall a visitor message within the allowed time window (default 60 minutes).
     */
    public function recall(
        Request $request,
        string $conversationUuid,
        string $messageUuid,
        VisitorChatAccessService $accessService,
        ChatMessageService $messageService
    ): ChatMessageResource {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $accessService->verifyConversationOwnership($visitor, $conversationUuid);
        $message = $messageService->recallMessage($visitor, $conversation, $messageUuid);

        return new ChatMessageResource($message);
    }
}
