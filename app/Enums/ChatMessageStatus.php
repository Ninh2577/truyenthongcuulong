<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ChatMessageStatus: string implements HasLabel, HasColor
{
    case Sending = 'sending';
    case Sent = 'sent';
    case Delivered = 'delivered';
    case Read = 'read';
    case Failed = 'failed';
    case Deleted = 'deleted';
    case Recalled = 'recalled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Sending => 'Đang gửi...',
            self::Sent => 'Đã gửi',
            self::Delivered => 'Đã nhận',
            self::Read => 'Đã xem',
            self::Failed => 'Gửi thất bại',
            self::Deleted => 'Đã xóa',
            self::Recalled => 'Đã thu hồi',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Sending => 'gray',
            self::Sent => 'gray',
            self::Delivered => 'info',
            self::Read => 'success',
            self::Failed => 'danger',
            self::Deleted => 'warning',
            self::Recalled => 'gray',
        };
    }
}
