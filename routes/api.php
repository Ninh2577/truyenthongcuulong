<?php

use App\Http\Controllers\Api\ChatAttachmentController;
use App\Http\Controllers\Api\ChatConversationController;
use App\Http\Controllers\Api\ChatMessageController;
use App\Http\Controllers\Api\ChatSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('chat')->group(function () {
    Route::post('/session/init', [ChatSessionController::class, 'init'])
        ->middleware('throttle:chat-session-init')
        ->name('api.chat.session.init');

    // Download attachment route (supports both visitor and authenticated agent)
    Route::get('/attachments/{attachment_uuid}', [ChatAttachmentController::class, 'show'])
        ->name('api.chat.attachments.show');

    // Authenticated visitor messaging routes
    Route::middleware('chat.visitor')->group(function () {
        Route::get('/conversations', [ChatConversationController::class, 'index'])
            ->name('api.chat.conversations.index');
        Route::post('/conversations', [ChatConversationController::class, 'store'])
            ->name('api.chat.conversations.store');
        Route::get('/conversations/{conversation_uuid}', [ChatConversationController::class, 'show'])
            ->name('api.chat.conversations.show');
        Route::post('/conversations/{conversation_uuid}/read', [ChatConversationController::class, 'markRead'])
            ->name('api.chat.conversations.read');

        Route::get('/conversations/{conversation_uuid}/messages', [ChatMessageController::class, 'index'])
            ->name('api.chat.messages.index');
        Route::post('/conversations/{conversation_uuid}/messages', [ChatMessageController::class, 'store'])
            ->middleware('throttle:chat-message-send')
            ->name('api.chat.messages.store');
        Route::post('/conversations/{conversation_uuid}/attachments', [ChatAttachmentController::class, 'store'])
            ->middleware('throttle:chat-attachment-upload')
            ->name('api.chat.attachments.store');
        Route::patch('/conversations/{conversation_uuid}/messages/{message_uuid}', [ChatMessageController::class, 'update'])
            ->name('api.chat.messages.update');
        Route::post('/conversations/{conversation_uuid}/messages/{message_uuid}/recall', [ChatMessageController::class, 'recall'])
            ->name('api.chat.messages.recall');
        Route::delete('/conversations/{conversation_uuid}/messages/{message_uuid}', [ChatMessageController::class, 'recall'])
            ->name('api.chat.messages.destroy');
    });
});
