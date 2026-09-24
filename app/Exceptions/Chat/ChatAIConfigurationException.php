<?php

namespace App\Exceptions\Chat;

use Throwable;

class ChatAIConfigurationException extends ChatAIException
{
    public function __construct(string $message = 'Cấu hình dịch vụ AI không hợp lệ hoặc thiếu thông tin xác thực.', int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, 'AI_CONFIGURATION_ERROR', $code, $previous);
    }
}
