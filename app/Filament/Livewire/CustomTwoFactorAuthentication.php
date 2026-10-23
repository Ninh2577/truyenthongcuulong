<?php

namespace App\Filament\Livewire;

use App\Services\TrustedDeviceService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Stephenjude\FilamentTwoFactorAuthentication\Actions\ConfirmTwoFactorAuthentication;
use Stephenjude\FilamentTwoFactorAuthentication\Actions\DisableTwoFactorAuthentication;
use Stephenjude\FilamentTwoFactorAuthentication\Livewire\TwoFactorAuthentication as BaseTwoFactorAuthentication;
use Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticationPlugin;

class CustomTwoFactorAuthentication extends BaseTwoFactorAuthentication
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->label('Nhập mã xác thực (OTP 6 số)')
                    ->placeholder('123456')
                    ->maxLength(6)
                    ->required()
                    ->autofocus()
                    ->extraInputAttributes([
                        'style' => 'text-align: center; font-size: 18px; font-weight: 700; letter-spacing: 0.25em; border-radius: 10px; height: 44px;',
                        'inputmode' => 'numeric',
                        'pattern' => '[0-9]*',
                        'autocomplete' => 'one-time-code',
                    ]),
            ])
            ->statePath('data');
    }
    public function mount(): void
    {
        $user = \Filament\Facades\Filament::auth()->user();
        if (! $user) {
            redirect()->to(filament()->getCurrentPanel()?->getLoginUrl() ?? '/cuulongteam/login');
            return;
        }

        // Chỉ Super Admin, Admin hoặc primary email mới có quyền
        $canManage = $user->hasAnyRole(['super_admin', 'Admin']) || $user->email === 'admin@truyenthongcuulong.com';
        if (! $canManage) {
            redirect()->to(filament()->getCurrentPanel()?->getUrl() ?? '/cuulongteam');
            return;
        }

        // Tự động hiển thị mã phục hồi nếu vừa kích hoạt thành công
        if ($user->hasEnabledTwoFactorAuthentication() && session()->get('just_enabled_2fa')) {
            $this->showRecoveryCodes = true;
            session()->forget('just_enabled_2fa');
        }

        $this->form->fill();
    }

    /**
     * Xác nhận kích hoạt 2FA lần đầu:
     * - Lưu trạng thái kích hoạt vào DB (ConfirmTwoFactorAuthentication)
     * - Thu hồi mọi token thiết bị cũ nếu có
     * - Đăng xuất tài khoản ngay lập tức để người dùng đăng nhập lại
     * - Chuyển về trang đăng nhập để bắt đầu bước xác thực mã 2FA với tuỳ chọn lưu 7 ngày
     */
    public function getUser(): \Filament\Models\Contracts\FilamentUser
    {
        $user = \Filament\Facades\Filament::auth()->user();

        if (! ($user instanceof \Illuminate\Database\Eloquent\Model)) {
            $user = \Illuminate\Support\Facades\Auth::user();
        }

        if (! ($user instanceof \Illuminate\Database\Eloquent\Model)) {
            $user = \App\Models\User::where('email', 'admin@truyenthongcuulong.com')->first();
        }

        return $user;
    }

    public function confirmSetup(): void
    {
        try {
            $this->rateLimit(5);

            $data = $this->form->getState();

            // 1. Xác thực OTP và kích hoạt 2FA vào database
            app(ConfirmTwoFactorAuthentication::class)($this->getUser(), $data['code']);

            // 2. Thu hồi toàn bộ thiết bị cũ
            app(TrustedDeviceService::class)->revokeAllForUser($this->getUser());

            // 3. Phát sự kiện mở Popup Modal trung tâm và chuyển hướng sau 2 giây qua route đăng xuất an toàn
            $logoutUrl = route('filament.cuulongteam.auth.2fa-activated-logout');
            $this->dispatch('setup-confirmed', redirectUrl: $logoutUrl);
            $this->js("setTimeout(() => { window.location.href = '{$logoutUrl}'; }, 2000);");
        } catch (TooManyRequestsException $exception) {
            $this->sendRateLimitedNotification($exception);

            return;
        }
    }

    /**
     * Nút Bắt đầu kích hoạt 2FA theo phong cách Cửu Long
     */
    protected function enableTwoFactorAuthenticationAction(): Action
    {
        return Action::make('enableTwoFactorAuthentication')
            ->label('Bắt đầu kích hoạt 2FA')
            ->icon('heroicon-s-shield-check')
            ->extraAttributes([
                'class' => 'w-full !py-3.5 !px-6 !rounded-2xl !bg-gradient-to-r !from-orange-500 !via-orange-500 !to-amber-500 hover:!from-orange-600 hover:!to-amber-600 !text-white !font-bold !text-base !shadow-lg !shadow-orange-500/30 hover:!shadow-orange-500/50 !transition-all !border-0 flex items-center justify-center gap-2',
            ])
            ->visible(fn () => ! $this->getUser()->hasEnabledTwoFactorAuthentication())
            ->modalWidth('md')
            ->modalHeading('Xác thực bảo mật tài khoản')
            ->modalDescription('Vui lòng nhập lại mật khẩu đăng nhập của bạn để tiến hành quét mã QR kích hoạt 2FA.')
            ->modalSubmitActionLabel('Tiếp tục quét mã QR')
            ->form(function () {
                if (! TwoFactorAuthenticationPlugin::get()->twoFactorSetupRequiresPassword()) {
                    return null;
                }

                return [
                    \Filament\Forms\Components\TextInput::make('confirmPassword')
                        ->label('Mật khẩu đăng nhập')
                        ->password()
                        ->revealable(filament()->arePasswordsRevealable())
                        ->required()
                        ->autocomplete('confirm-password')
                        ->rules([
                            fn () => function (string $attribute, $value, $fail) {
                                if (! Hash::check($value, $this->getUser()->password)) {
                                    $fail('Mật khẩu tài khoản đã nhập không chính xác.');
                                }
                            },
                        ]),
                ];
            })
            ->action(function () {
                try {
                    $this->rateLimit(5);

                    app(\Stephenjude\FilamentTwoFactorAuthentication\Actions\EnableTwoFactorAuthentication::class)($this->getUser());

                    $this->isConfirmingSetup = true;
                } catch (TooManyRequestsException $exception) {
                    $this->sendRateLimitedNotification($exception);

                    return;
                }
            });
    }

    /**
     * Override action disable 2FA để thu hồi tất cả thiết bị tin cậy
     */
    protected function disableTwoFactorAuthenticationAction(): Action
    {
        return Action::make('disableTwoFactorAuthentication')
            ->label('Tắt xác thực 2FA')
            ->color('danger')
            ->icon('heroicon-o-shield-exclamation')
            ->visible(fn () => $this->getUser()->hasEnabledTwoFactorAuthentication())
            ->modalWidth('md')
            ->modalHeading('Xác nhận tắt bảo mật 2FA')
            ->modalDescription('Cảnh báo: Việc tắt 2FA sẽ làm giảm mức độ bảo mật của tài khoản. Bạn có chắc chắn muốn tiếp tục?')
            ->modalSubmitActionLabel('Xác nhận tắt 2FA')
            ->form(function () {
                if (! TwoFactorAuthenticationPlugin::get()->twoFactorSetupRequiresPassword()) {
                    return null;
                }

                return [
                    \Filament\Forms\Components\TextInput::make('currentPassword')
                        ->label('Nhập mật khẩu để xác nhận')
                        ->password()
                        ->revealable(filament()->arePasswordsRevealable())
                        ->required()
                        ->autocomplete('current-password')
                        ->rules([
                            fn () => function (string $attribute, $value, $fail) {
                                if (! Hash::check($value, $this->getUser()->password)) {
                                    $fail('Mật khẩu tài khoản đã nhập không chính xác.');
                                }
                            },
                        ]),
                ];
            })
            ->action(function () {
                try {
                    $this->rateLimit(5);

                    app(DisableTwoFactorAuthentication::class)($this->getUser());

                    // Thu hồi toàn bộ token thiết bị tin cậy
                    app(TrustedDeviceService::class)->revokeAllForUser($this->getUser());

                    $this->showRecoveryCodes = false;

                    Notification::make()
                        ->title('Đã tắt xác thực 2FA')
                        ->body('Xác thực hai yếu tố và các phiên ghi nhớ 7 ngày đã bị vô hiệu hóa.')
                        ->warning()
                        ->send();

                    redirect()->to(filament()->getCurrentPanel()->route('two-factor.setup'));
                } catch (TooManyRequestsException $exception) {
                    $this->sendRateLimitedNotification($exception);

                    return;
                }
            });
    }
}
