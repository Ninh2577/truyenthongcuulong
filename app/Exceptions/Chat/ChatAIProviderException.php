<?php

namespace App\Exceptions\Chat;

use Throwable;

class ChatAIProviderException extends ChatAIException
{
    public function __construct(string $message = 'Nhà cung cấp dịch vụ AI phản hồi lỗi.', int $code = 502, ?Throwable $previous = null)
    {
        parent::__construct($message, 'AI_PROVIDER_ERROR', $code, $previous);
    }
}
