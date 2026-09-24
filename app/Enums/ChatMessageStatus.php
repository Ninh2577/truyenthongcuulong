<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ChatMessageStatus: string implements HasLabel, HasColor
{
    case Sent = 'sent';
    case Delivered = 'delivered';
    case Read = 'read';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Sent => 'Đã gửi',
            self::Delivered => 'Đã nhận',
            self::Read => 'Đã xem',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Sent => 'gray',
            self::Delivered => 'info',
            self::Read => 'success',
        };
    }
}
