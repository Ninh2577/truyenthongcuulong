<?php

namespace App\Filament\Pages\Auth;

use App\Services\TrustedDeviceService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\LoginResponse;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cookie;
use Stephenjude\FilamentTwoFactorAuthentication\Events\TwoFactorAuthenticationFailed;
use Stephenjude\FilamentTwoFactorAuthentication\Events\ValidTwoFactorAuthenticationCodeProvided;
use Stephenjude\FilamentTwoFactorAuthentication\Pages\Challenge as BaseChallenge;
use Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticationProvider;

class CustomTwoFactorChallenge extends BaseChallenge
{
    /**
     * Xác thực mã OTP 2FA:
     * - Nếu tích chọn 'Lưu mã 2FA 7 ngày' -> cấp token và cookie 7 ngày.
     * - Nếu KHÔNG tích chọn -> KHÔNG lưu thiết bị, chỉ cho phép phiên hiện tại. Lần sau đăng nhập lại bắt buộc nhập OTP.
     * - Hiển thị thông báo Toast & Popup xác thực thành công trước khi chuyển hướng.
     */
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);

            // 1. Kiểm tra validation mã OTP
            $data = $this->form->getState();

            $user = Filament::auth()->user();

            // 2. Xử lý tuỳ chọn Lưu mã 2FA 7 ngày
            if (! empty($data['remember_device'])) {
                // Người dùng TÍCH CHỌN: Lưu thiết bị tin cậy 7 ngày
                app(TrustedDeviceService::class)->trustCurrentDevice($user);
            } else {
                // Người dùng KHÔNG TÍCH CHỌN: Không lưu thiết bị, xóa cookie nếu có
                Cookie::queue(Cookie::forget(
                    name: TrustedDeviceService::COOKIE_NAME,
                    path: '/',
                    domain: config('session.domain')
                ));
            }

            // 3. Cho phép phiên làm việc hiện tại
            $user->setTwoFactorChallengePassed();

            event(new ValidTwoFactorAuthenticationCodeProvided($user));

            $rememberMessage = ! empty($data['remember_device'])
                ? 'Đã ghi nhớ thiết bị này an toàn trong 7 ngày.'
                : 'Phiên làm việc đã được xác thực thành công.';

            // 4. Phát sự kiện mở Popup Modal trung tâm và chuyển hướng sau 1.8 giây
            $redirectUrl = filament()->getCurrentPanel()->getUrl();
            $this->dispatch('challenge-confirmed', redirectUrl: $redirectUrl, message: $rememberMessage);
            $this->js("setTimeout(() => { window.location.href = '{$redirectUrl}'; }, 1800);");

            return null;
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }
    }

    /**
     * Form nhập mã OTP và checkbox "Lưu mã 2FA trên thiết bị này trong 7 ngày"
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        TextInput::make('code')
                            ->label('Mã xác thực 2FA (OTP 6 số)')
                            ->placeholder('123456')
                            ->helperText('Mở ứng dụng Google Authenticator để lấy mã OTP ngẫu nhiên.')
                            ->required()
                            ->autofocus()
                            ->autocomplete('one-time-code')
                            ->extraInputAttributes([
                                'class' => 'text-center font-mono text-2xl tracking-widest font-bold',
                                'maxlength' => 6,
                            ])
                            ->rules([
                                fn () => function (string $attribute, $value, $fail) {
                                    $user = Filament::auth()->user();
                                    if (is_null($user)) {
                                        $fail('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');

                                        redirect()->to(filament()->getCurrentPanel()->getLoginUrl());

                                        return;
                                    }

                                    try {
                                        $secret = decrypt($user->two_factor_secret);
                                        $isValidCode = app(TwoFactorAuthenticationProvider::class)->verify(
                                            secret: $secret,
                                            code: trim($value)
                                        );
                                    } catch (\Throwable $e) {
                                        $isValidCode = false;
                                    }

                                    if (! $isValidCode) {
                                        $fail('Mã xác thực OTP không chính xác hoặc đã hết hiệu lực.');

                                        event(new TwoFactorAuthenticationFailed($user));
                                    }
                                },
                            ]),

                        Checkbox::make('remember_device')
                            ->label('Lưu mã 2FA trên thiết bị này trong 7 ngày')
                            ->helperText('Nếu tích chọn: Bạn sẽ không cần nhập lại mã 2FA trên trình duyệt này trong 7 ngày tới. Nếu không tích: Mỗi lần đăng nhập hệ thống sẽ bắt buộc nhập mã 2FA mới.')
                            ->default(false),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label('Xác nhận đăng nhập')
            ->icon('heroicon-m-arrow-right-on-rectangle')
            ->submit('authenticate')
            ->extraAttributes([
                'class' => 'w-full !py-3.5 !rounded-2xl !bg-gradient-to-r !from-orange-500 !via-orange-500 !to-amber-500 hover:!from-orange-600 hover:!to-amber-600 !text-white !font-bold !text-base !shadow-lg !shadow-orange-500/30 !border-0 flex items-center justify-center gap-2',
            ]);
    }
}
