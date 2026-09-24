<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ChatConversationStatus: string implements HasLabel, HasColor
{
    case Open = 'open';
    case Assigned = 'assigned';
    case WaitingCustomer = 'waiting_customer';
    case WaitingAgent = 'waiting_agent';
    case Closed = 'closed';
    case Spam = 'spam';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Open => 'Mới mở',
            self::Assigned => 'Đã tiếp nhận',
            self::WaitingCustomer => 'Chờ khách phản hồi',
            self::WaitingAgent => 'Chờ nhân viên',
            self::Closed => 'Đã đóng',
            self::Spam => 'Spam / Rác',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Open => 'info',
            self::Assigned => 'primary',
            self::WaitingCustomer => 'gray',
            self::WaitingAgent => 'warning',
            self::Closed => 'success',
            self::Spam => 'danger',
        };
    }
}
