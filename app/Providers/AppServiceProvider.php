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

        \Filament\Forms\Components\Field::configureUsing(function (\Filament\Forms\Components\Field $field) {
            if (method_exists($field, 'extraInputAttributes')) {
                $field->extraInputAttributes(function () use ($field) {
                    if ($field->isRequired()) {
                        $label = mb_strtolower($field->getLabel() ?? 'thông tin này', 'UTF-8');
                        $prefix = in_array(get_class($field), [\Filament\Forms\Components\Select::class, \Filament\Forms\Components\Radio::class, \Filament\Forms\Components\CheckboxList::class]) ? 'chọn' : 'nhập';
                        return [
                            'oninvalid' => "this.setCustomValidity('Vui lòng {$prefix} {$label}')",
                            'oninput' => "this.setCustomValidity('')",
                        ];
                    }
                    return [];
                });
            }
        });
    }
}