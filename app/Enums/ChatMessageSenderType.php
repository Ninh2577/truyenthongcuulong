<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ChatMessageSenderType: string implements HasLabel, HasColor
{
    case Visitor = 'visitor';
    case Agent = 'agent';
    case Bot = 'bot';
    case System = 'system';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Visitor => 'Khách truy cập',
            self::Agent => 'Tư vấn viên',
            self::Bot => 'AI Bot',
            self::System => 'Hệ thống',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Visitor => 'info',
            self::Agent => 'primary',
            self::Bot => 'primary',
            self::System => 'gray',
        };
    }
}
