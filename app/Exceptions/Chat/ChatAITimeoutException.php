<?php

namespace App\Exceptions\Chat;

use Throwable;

class ChatAITimeoutException extends ChatAIException
{
    public function __construct(string $message = 'Yêu cầu tới dịch vụ AI đã hết thời gian chờ (timeout).', int $code = 504, ?Throwable $previous = null)
    {
        parent::__construct($message, 'AI_TIMEOUT', $code, $previous);
    }
}
