<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Visitor Session Configuration
    |--------------------------------------------------------------------------
    |
    | Duration in days that a visitor chat session remains valid before expiring.
    | Default is 30 days as specified in CHAT-03 architecture.
    |
    */

    'visitor_session_ttl_days' => (int) env('CHAT_VISITOR_SESSION_TTL_DAYS', 30),

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting Configuration
    |--------------------------------------------------------------------------
    |
    | Number of session initialization attempts allowed per minute per client IP.
    | Prevents automated flooding and session exhaustion abuse.
    |
    */

    'session_init_rate_limit' => (int) env('CHAT_SESSION_INIT_RATE_LIMIT', 10),

    /*
    |--------------------------------------------------------------------------
    | Cookie Transport Configuration
    |--------------------------------------------------------------------------
    |
    | Name of the cookie used when transporting visitor tokens to browsers.
    |
    */

    'cookie_name' => 'chat_visitor_token',

    /*
    |--------------------------------------------------------------------------
    | Messaging Configuration
    |--------------------------------------------------------------------------
    |
    | Rules and thresholds for messaging lifecycle: rate limit, edit/recall
    | time windows, message body length, and pagination parameters.
    |
    */

    'message_send_rate_limit' => (int) env('CHAT_MESSAGE_SEND_RATE_LIMIT', 30),
    'message_edit_window_minutes' => (int) env('CHAT_MESSAGE_EDIT_WINDOW_MINUTES', 15),
    'message_recall_window_minutes' => (int) env('CHAT_MESSAGE_RECALL_WINDOW_MINUTES', 60),
    'message_max_length' => (int) env('CHAT_MESSAGE_MAX_LENGTH', 2000),

    'messages_per_page_default' => 30,
    'messages_per_page_max' => 100,

    'conversations_per_page_default' => 15,
    'conversations_per_page_max' => 100,

    /*
    |--------------------------------------------------------------------------
    | Visitor Chat Widget Configuration
    |--------------------------------------------------------------------------
    |
    | Polling interval in milliseconds and max character count for frontend input.
    |
    */

    'widget_poll_interval_ms' => (int) env('CHAT_WIDGET_POLL_INTERVAL_MS', 3500),
    'widget_max_input_length' => (int) env('CHAT_WIDGET_MAX_INPUT_LENGTH', 2000),

    /*
    |--------------------------------------------------------------------------
    | Agent Inbox Configuration
    |--------------------------------------------------------------------------
    |
    | Polling interval in seconds for the Filament Agent Inbox interface.
    |
    */

    'agent_poll_interval_seconds' => (int) env('CHAT_AGENT_POLL_INTERVAL_SECONDS', 4),

    /*
    |--------------------------------------------------------------------------
    | Chat Attachments Configuration (CHAT-07)
    |--------------------------------------------------------------------------
    |
    | Disk, size thresholds, allowed counts, and rate limits for file attachments.
    |
    */

    'attachment_disk' => env('CHAT_ATTACHMENT_DISK', 'chat_private'),
    'attachment_image_max_kb' => (int) env('CHAT_ATTACHMENT_IMAGE_MAX_KB', 5120), // 5MB
    'attachment_document_max_kb' => (int) env('CHAT_ATTACHMENT_DOCUMENT_MAX_KB', 10240), // 10MB
    'attachment_max_files_per_message' => (int) env('CHAT_ATTACHMENT_MAX_FILES_PER_MESSAGE', 5),
    'attachment_upload_rate_limit' => (int) env('CHAT_ATTACHMENT_UPLOAD_RATE_LIMIT', 20),

    /*
    |--------------------------------------------------------------------------
    | Spam & Security Moderation Configuration (CHAT-09)
    |--------------------------------------------------------------------------
    |
    | Thresholds and rules for detecting duplicate message floods and abuse.
    |
    */

    'spam_duplicate_threshold' => (int) env('CHAT_SPAM_DUPLICATE_THRESHOLD', 4),
    'spam_duplicate_window_seconds' => (int) env('CHAT_SPAM_DUPLICATE_WINDOW_SECONDS', 30),
    'spam_duplicate_action' => env('CHAT_SPAM_DUPLICATE_ACTION', 'throttle'), // 'throttle' | 'mark_spam'

];
