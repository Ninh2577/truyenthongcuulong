<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PricingServiceGroup: string implements HasLabel, HasColor
{
    case TVC = 'tvc';
    case Web = 'web';
    case Marketing = 'marketing';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TVC => 'Sản Xuất Video & TVC',
            self::Web => 'Thiết Kế Web & App',
            self::Marketing => 'Quảng Cáo & Marketing Số',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TVC => 'warning',
            self::Web => 'info',
            self::Marketing => 'success',
        };
    }
}
