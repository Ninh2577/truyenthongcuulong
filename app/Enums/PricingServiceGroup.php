<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PricingServiceGroup: string implements HasLabel, HasColor
{
    case TVC = 'tvc';
    case Web = 'web';
    case Marketing = 'marketing';
    case UiUx = 'ui-ux';
    case WebsiteCare = 'website-care';
    case EventPhotography = 'event-photography';
    case EventVideography = 'event-videography';
    case TeambuildingPhotography = 'teambuilding-photography';
    case TeambuildingVideography = 'teambuilding-videography';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TVC => 'Sản Xuất Video & TVC',
            self::Web => 'Thiết Kế Web & App',
            self::Marketing => 'Quảng Cáo & Marketing Số',
            self::UiUx => 'Thiết Kế UI/UX',
            self::WebsiteCare => 'Quản Trị & Chăm Sóc Web',
            self::EventPhotography => 'Chụp Ảnh Sự Kiện',
            self::EventVideography => 'Quay Phim Sự Kiện',
            self::TeambuildingPhotography => 'Chụp Ảnh Teambuilding',
            self::TeambuildingVideography => 'Quay Phim Teambuilding',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TVC => 'warning',
            self::Web => 'info',
            self::Marketing => 'success',
            self::UiUx => 'primary',
            self::WebsiteCare => 'info',
            self::EventPhotography => 'success',
            self::EventVideography => 'danger',
            self::TeambuildingPhotography => 'primary',
            self::TeambuildingVideography => 'warning',
        };
    }
}
