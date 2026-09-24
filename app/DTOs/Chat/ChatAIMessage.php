<?php

namespace App\DTOs\Chat;

class ChatAIMessage
{
    /**
     * @param string $role Role in conversation ('system', 'user', 'assistant')
     * @param string $content Plain text message content
     */
    public function __construct(
        public readonly string $role,
        public readonly string $content
    ) {}

    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'content' => $this->content,
        ];
    }
}
