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

        // Single-use recovery code enforcement: consume used recovery code immediately
        \Illuminate\Support\Facades\Event::listen(
            \Stephenjude\FilamentTwoFactorAuthentication\Events\ValidTwoFactorRecoveryCodeProvided::class,
            function (\Stephenjude\FilamentTwoFactorAuthentication\Events\ValidTwoFactorRecoveryCodeProvided $event) {
                $req = request();
                $submittedCode = null;

                $components = $req->json('components', []);
                foreach ($components as $component) {
                    $snapshot = json_decode($component['snapshot'] ?? '{}', true);
                    if (! empty($snapshot['data']['data']['recovery_code'])) {
                        $submittedCode = $snapshot['data']['data']['recovery_code'];
                        break;
                    }
                    if (! empty($component['updates']['data.recovery_code'])) {
                        $submittedCode = $component['updates']['data.recovery_code'];
                        break;
                    }
                }

                if (! $submittedCode && $req->has('data.recovery_code')) {
                    $submittedCode = $req->input('data.recovery_code');
                }

                if ($submittedCode && $event->user && method_exists($event->user, 'recoveryCodes')) {
                    $validCodes = $event->user->recoveryCodes();
                    foreach ($validCodes as $code) {
                        if (hash_equals((string) $code, (string) $submittedCode)) {
                            $event->user->replaceRecoveryCode($code);
                            break;
                        }
                    }
                }
            }
        );
    }
}