<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PillarGroup: string implements HasLabel, HasColor
{
    case Media = 'media';
    case Technology = 'technology';
    case Marketing = 'marketing';
    case Resource = 'resource';
    case General = 'general';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Media => 'Truyền thông & Sáng tạo',
            self::Technology => 'Công nghệ & Giải pháp số',
            self::Marketing => 'Quảng cáo & Marketing Số',
            self::Resource => 'Tài nguyên & Biểu mẫu',
            self::General => 'Chung / Khác',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Media => 'warning',
            self::Technology => 'info',
            self::Marketing => 'success',
            self::Resource => 'primary',
            self::General => 'gray',
        };
    }
}
