<?php

namespace App\Exceptions\Chat;

use RuntimeException;
use Throwable;

class ChatAIException extends RuntimeException
{
    protected string $errorCode;

    public function __construct(string $message = 'Lỗi dịch vụ AI.', string $errorCode = 'AI_ERROR', int $code = 0, ?Throwable $previous = null)
    {
        // Sanitize message to guarantee no API keys or credentials can leak
        $sanitizedMessage = $this->sanitizeMessage($message);
        parent::__construct($sanitizedMessage, $code, $previous);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * Strip potential API keys, Bearer tokens, and sensitive headers from exception messages.
     */
    protected function sanitizeMessage(string $message): string
    {
        // Redact Bearer tokens
        $sanitized = preg_replace('/Bearer\s+[A-Za-z0-9\-._~+\/]+=*/i', 'Bearer [REDACTED]', $message);
        // Redact sk-... openai style keys
        $sanitized = preg_replace('/sk-[A-Za-z0-9\-]{20,}/i', 'sk-[REDACTED]', $sanitized);
        // Redact AIza... Google style keys
        $sanitized = preg_replace('/AIza[0-9A-Za-z-_]{35}/i', 'AIza[REDACTED]', $sanitized);

        return (string) $sanitized;
    }
}
