<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PartnerTier: string implements HasLabel, HasColor
{
    case Top = 'top';
    case Gold = 'gold';
    case Strategic = 'strategic';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Top => 'Top Partner',
            self::Gold => 'Gold Partner',
            self::Strategic => 'Strategic Partner',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Top => '#ea580c', // Darkest orange/amber
            self::Gold => '#f59e0b', // Base amber
            self::Strategic => '#fbbf24', // Lighter amber
        };
    }
}
