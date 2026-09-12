<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        require_once app_path('helpers.php');

        Paginator::useTailwind();

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}