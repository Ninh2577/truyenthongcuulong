<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    protected static string $layout = 'filament-panels::components.layout.base';
    protected static string $view = 'filament.pages.auth.custom-login';

    public function getHeading(): string|Htmlable
    {
        return '';
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent()
                    ->prefixIcon('heroicon-o-envelope')
                    ->label('Địa chỉ Email Doanh nghiệp'),
                $this->getPasswordFormComponent()
                    ->prefixIcon('heroicon-o-lock-closed')
                    ->label('Mật khẩu')
                    ->helperText(new \Illuminate\Support\HtmlString('<div style="text-align: right; margin-top: 4px;"><a href="'. (filament()->hasPasswordReset() ? filament()->getResetPasswordUrl() : '#') .'" class="forgot-password-link" style="color: rgba(245,158,11,0.85); font-size: 0.85rem; text-decoration: none;">Quên mật khẩu?</a></div>')),
                $this->getRememberFormComponent()
                    ->label('Duy trì đăng nhập trên thiết bị này'),
            ])
            ->statePath('data');
    }
}
