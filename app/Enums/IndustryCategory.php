<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum IndustryCategory: string implements HasLabel, HasColor
{
    case Finance = 'finance';
    case Tech = 'tech';
    case Industry = 'industry';
    case Tourism = 'tourism';
    case Healthcare = 'healthcare';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Finance => 'Tài chính & Ngân hàng',
            self::Tech => 'Công nghệ & Giải pháp số',
            self::Industry => 'Nông nghiệp & Sản xuất',
            self::Tourism => 'Du lịch & Bán lẻ',
            self::Healthcare => 'Y tế, Giáo dục & Xã hội',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Finance => '#c2410c', // orange-700
            self::Tech => '#ea580c', // orange-600
            self::Industry => '#f59e0b', // amber-500
            self::Tourism => '#fbbf24', // amber-400
            self::Healthcare => '#fcd34d', // amber-300
        };
    }
}
