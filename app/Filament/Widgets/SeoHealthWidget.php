<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;

class SeoHealthWidget extends Widget
{
    protected static string $view = 'filament.widgets.seo-health-widget';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $totalRedirects = Redirect::count();
        $totalHits = Redirect::sum('hits');
        
        $duplicateUrls = Redirect::select('old_url', DB::raw('count(*) as total'))
            ->groupBy('old_url')
            ->havingRaw('count(*) > 1')
            ->get();

        return [
            'totalRedirects' => $totalRedirects,
            'totalHits' => $totalHits ?? 0,
            'duplicateUrls' => $duplicateUrls,
        ];
    }
}
