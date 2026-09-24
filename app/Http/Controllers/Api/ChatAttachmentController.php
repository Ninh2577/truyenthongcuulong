<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatMessageResource;
use App\Models\ChatAttachment;
use App\Models\ChatVisitor;
use App\Services\Chat\ChatAttachmentService;
use App\Services\Chat\ChatMessageService;
use App\Services\Chat\VisitorChatAccessService;
use App\Services\Chat\VisitorSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ChatAttachmentController extends Controller
{
    /**
     * Upload one or more attachments for a conversation as a new message.
     */
    public function store(
        Request $request,
        string $conversationUuid,
        VisitorChatAccessService $accessService,
        ChatMessageService $messageService
    ): JsonResponse {
        /** @var ChatVisitor $visitor */
        $visitor = $request->attributes->get('chat_visitor');

        $conversation = $accessService->verifyConversationOwnership($visitor, $conversationUuid);

        $files = $request->file('attachments');
        if (! is_array($files) || empty($files)) {
            // Also support single file in 'attachment' or 'file'
            $single = $request->file('attachment') ?: $request->file('file');
            if ($single) {
                $files = [$single];
            } else {
                throw new UnprocessableEntityHttpException('Vui lòng chọn ít nhất một tệp đính kèm.');
            }
        }

        $messageText = $request->input('message');
        $message = $messageService->sendMessage($visitor, $conversation, $messageText, $files);

        return (new ChatMessageResource($message))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Download or stream attachment with authorization checks and strict security headers.
     */
    public function show(
        Request $request,
        string $attachmentUuid,
        ChatAttachmentService $attachmentService,
        VisitorSessionService $sessionService
    ): StreamedResponse {
        $attachment = ChatAttachment::query()
            ->where('attachment_uuid', $attachmentUuid)
            ->with(['message.conversation'])
            ->first();

        if (! $attachment) {
            throw new NotFoundHttpException('Tệp đính kèm không tồn tại.');
        }

        // Identify visitor requester via canonical HttpOnly cookie
        $visitor = null;
        $rawToken = $request->cookie(config('chat.cookie_name', 'chat_visitor_token'));
        if ($rawToken) {
            $session = $sessionService->authenticate($rawToken);
            $visitor = $session?->visitor;
        }

        // Identify authenticated admin/agent user
        $user = $request->user();

        return $attachmentService->downloadAttachment($attachment, $visitor, $user);
    }
}
