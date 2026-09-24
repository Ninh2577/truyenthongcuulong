<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ChatConversationChannel: string implements HasLabel, HasColor
{
    case Human = 'human';
    case Ai = 'ai';
    case Hybrid = 'hybrid';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Human => 'Nhân viên (Human)',
            self::Ai => 'Trợ lý AI (Bot)',
            self::Hybrid => 'Hỗn hợp (Hybrid)',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Human => 'success',
            self::Ai => 'primary',
            self::Hybrid => 'warning',
        };
    }
}
