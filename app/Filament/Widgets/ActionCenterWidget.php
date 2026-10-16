<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Contact;
use App\Models\JobApplication;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;

class ActionCenterWidget extends Widget
{
    protected static bool $isLazy = false;
    protected static string $view = 'filament.widgets.action-center-widget';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $newContacts = Contact::where('status', 'new')->count();
        $newJobApps = JobApplication::where('status', 'pending')->count();
        
        $duplicateUrlsCount = 0;
        try {
            $duplicateUrlsCount = Redirect::select('old_url', DB::raw('count(*) as total'))
                ->groupBy('old_url')
                ->havingRaw('count(*) > 1')
                ->get()
                ->count();
        } catch (\Throwable $e) {
            $duplicateUrlsCount = 0;
        }

        $contactUrl = class_exists(\App\Filament\Resources\ContactResource::class)
            ? \App\Filament\Resources\ContactResource::getUrl('index') . '?tableFilters[status][value]=new'
            : null;

        $redirectUrl = class_exists(\App\Filament\Resources\RedirectResource::class)
            ? \App\Filament\Resources\RedirectResource::getUrl('index')
            : null;

        $jobAppsUrl = class_exists(\App\Filament\Resources\JobApplicationResource::class)
            ? \App\Filament\Resources\JobApplicationResource::getUrl('index') . '?tableFilters[status][value]=pending'
            : null;

        $totalActionItems = ($newContacts > 0 ? 1 : 0) + ($newJobApps > 0 ? 1 : 0) + ($duplicateUrlsCount > 0 ? 1 : 0);

        return [
            'newContacts' => $newContacts,
            'newJobApps' => $newJobApps,
            'duplicateUrlsCount' => $duplicateUrlsCount,
            'contactUrl' => $contactUrl,
            'redirectUrl' => $redirectUrl,
            'jobAppsUrl' => $jobAppsUrl,
            'totalActionItems' => $totalActionItems,
        ];
    }
}
