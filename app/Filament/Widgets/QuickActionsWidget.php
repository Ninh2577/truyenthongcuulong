<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected static bool $isLazy = false;
    protected static string $view = 'filament.widgets.quick-actions-widget';
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';
}
