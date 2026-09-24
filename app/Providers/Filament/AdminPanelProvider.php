<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('cuulongteam')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->brandName('Truyền Thông Cửu Long')
            ->colors([
                'primary' => [
                    50 => '#fffbeb',
                    100 => '#fef3c7',
                    200 => '#fde68a',
                    300 => '#fcd34d',
                    400 => '#fbbf24',
                    500 => '#f59e0b', // Primary
                    600 => '#ea580c', // Hover/Active
                    700 => '#c2410c',
                    800 => '#9a3412',
                    900 => '#7c2d12',
                    950 => '#431407',
                ],
                'warning' => \Filament\Support\Colors\Color::hex('#b45309'),
                'gray' => \Filament\Support\Colors\Color::Slate,
            ])
            ->font('Space Grotesk')
            ->brandLogo(fn () => new \Illuminate\Support\HtmlString('
                <div class="flex items-center gap-2">
                    <img src="' . asset('images/logo-ttcl.png') . '" class="h-8 w-auto" alt="Logo" />
                    <span class="font-bold text-xl text-gray-900 dark:text-white tracking-tight">Cửu Long Media</span>
                </div>
            '))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo-ttcl.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->navigationGroups([
                'Nội Dung',
                'Kinh Doanh',
                'Chat & CSKH',
                'Quản Lý Website',
                'Nội dung chung',
                'Cấu Hình SEO',
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Default widgets removed for a cleaner dashboard
            ])
            ->plugins([
                \Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticationPlugin::make()
                    ->enableTwoFactorAuthentication(condition: true, challengeMiddleware: \App\Http\Middleware\TwoFactorChallenge::class)
                    ->addTwoFactorMenuItem(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}





