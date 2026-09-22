<?php

namespace App\Filament\Pages\Auth;

use App\Services\TrustedDeviceService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\LoginResponse;
use Stephenjude\FilamentTwoFactorAuthentication\Events\TwoFactorAuthenticationFailed;
use Stephenjude\FilamentTwoFactorAuthentication\Events\ValidTwoFactorAuthenticationCodeProvided;
use Stephenjude\FilamentTwoFactorAuthentication\Pages\Challenge as BaseChallenge;
use Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticationProvider;

class CustomTwoFactorChallenge extends BaseChallenge
{
    /**
     * Override authenticate() to issue 7-day Trusted Device token
     * strictly AFTER the OTP code has been verified and confirmed valid.
     */
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);

            // 1. Form validation: validates OTP code. Throws ValidationException if invalid.
            $data = $this->form->getState();

            $user = Filament::auth()->user();

            // 2. Only if OTP validation succeeds, evaluate remember_device option
            if (! empty($data['remember_device'])) {
                app(TrustedDeviceService::class)->trustCurrentDevice($user);
            }

            // 3. Mark 2FA challenge passed for this session
            $user->setTwoFactorChallengePassed();

            event(new ValidTwoFactorAuthenticationCodeProvided($user));

            return app(LoginResponse::class);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }
    }

    /**
     * Build challenge form schema with OTP code and "Tin cậy thiết bị này trong 7 ngày" checkbox.
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        TextInput::make('code')
                            ->hiddenLabel()
                            ->hint(
                                __('filament-two-factor-authentication::pages.challenge.confirm')
                            )
                            ->label(__('filament-two-factor-authentication::pages.challenge.code'))
                            ->required()
                            ->autocomplete()
                            ->rules([
                                fn () => function (string $attribute, $value, $fail) {
                                    $user = Filament::auth()->user();
                                    if (is_null($user)) {
                                        $fail(__('filament-two-factor-authentication::pages.challenge.error'));

                                        redirect()->to(filament()->getCurrentPanel()->getLoginUrl());

                                        return;
                                    }

                                    $isValidCode = app(TwoFactorAuthenticationProvider::class)->verify(
                                        secret: decrypt($user->two_factor_secret),
                                        code: $value
                                    );

                                    if (! $isValidCode) {
                                        $fail(__('filament-two-factor-authentication::pages.challenge.error'));

                                        event(new TwoFactorAuthenticationFailed($user));
                                    }
                                },
                            ]),

                        Checkbox::make('remember_device')
                            ->label(__('filament-two-factor-authentication::pages.challenge.remember_device'))
                            ->default(false),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
}
