<?php

namespace App\Exceptions\Chat;

use Throwable;

class ChatAIUnavailableException extends ChatAIException
{
    public function __construct(string $message = 'Dịch vụ AI hiện không khả dụng.', int $code = 503, ?Throwable $previous = null)
    {
        parent::__construct($message, 'AI_UNAVAILABLE', $code, $previous);
    }
}
