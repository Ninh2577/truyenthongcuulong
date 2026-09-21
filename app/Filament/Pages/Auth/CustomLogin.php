<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;

class CustomLogin extends BaseLogin
{
    protected static string $layout = 'filament-panels::components.layout.base';
    protected static string $view = 'filament.pages.auth.custom-login';

    /** Chuỗi CAPTCHA 5 ký tự */
    public string $captchaCode = '';

    /** HTML đã render sẵn (tránh re-randomize mỗi lần Livewire re-render) */
    public string $captchaRendered = '';

    public function mount(): void
    {
        parent::mount();
        $this->generateCaptcha();
    }

    /**
     * Sinh chuỗi CAPTCHA 5 ký tự ngẫu nhiên (hoa, thường, số).
     * Là public method để Livewire có thể gọi qua wire:click.
     */
    public function generateCaptcha(): void
    {
        // Bỏ các ký tự dễ nhầm: 0/O, 1/l/I
        $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $len   = strlen($chars);
        $code  = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[random_int(0, $len - 1)];
        }
        $this->captchaCode     = $code;
        $this->captchaRendered = $this->buildCaptchaHtml($code);
    }

    /**
     * Render từng ký tự với màu và góc xoay ngẫu nhiên.
     */
    private function buildCaptchaHtml(string $code): string
    {
        $palette = ['#f59e0b', '#fbbf24', '#fb923c', '#fde68a', '#fdba74'];
        $html    = '';
        foreach (str_split($code) as $i => $char) {
            $rotate  = random_int(-14, 14);
            $size    = random_int(26, 34);
            $color   = $palette[$i % count($palette)];
            $shadow  = 'text-shadow:1px 1px 3px rgba(0,0,0,0.6),0 0 8px rgba(245,158,11,0.3)';
            $html   .= "<span style=\"display:inline-block;transform:rotate({$rotate}deg);color:{$color};font-size:{$size}px;font-weight:800;font-family:'Space Grotesk',monospace;letter-spacing:0.05em;{$shadow};\">{$char}</span>";
        }
        return $html;
    }

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
                    ->label('Địa chỉ Email Doanh nghiệp')
                    ->validationMessages([
                        'required' => 'Vui lòng nhập địa chỉ email.',
                        'email'    => 'Địa chỉ email không hợp lệ.',
                    ]),

                $this->getPasswordFormComponent()
                    ->prefixIcon('heroicon-o-lock-closed')
                    ->label('Mật khẩu')
                    ->validationMessages([
                        'required' => 'Vui lòng nhập mật khẩu.',
                    ])
                    ->helperText(new HtmlString(
                        '<div style="text-align:right;margin-top:4px;">'
                        . '<a href="' . (filament()->hasPasswordReset() ? filament()->getResetPasswordUrl() : '#') . '"'
                        . ' style="color:rgba(245,158,11,0.85);font-size:0.85rem;text-decoration:none;">Quên mật khẩu?</a>'
                        . '</div>'
                    )),

                $this->getRememberFormComponent()
                    ->label('Duy trì đăng nhập trên thiết bị này'),

                // ── Hiển thị CAPTCHA ───────────────────────────────────
                Forms\Components\Placeholder::make('captcha_display')
                    ->label('Nhập mã xác nhận bên dưới')
                    ->extraAttributes(['class' => 'captcha-placeholder'])
                    ->content(fn () => new HtmlString(
                        '<div class="captcha-box">'
                        . '<div class="captcha-chars" aria-hidden="true">' . $this->captchaRendered . '</div>'
                        . '<button type="button" wire:click="generateCaptcha"'
                        . ' class="captcha-refresh" title="Làm mới mã xác nhận">'
                        . '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none"'
                        . ' viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">'
                        . '<path stroke-linecap="round" stroke-linejoin="round"'
                        . ' d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9'
                        . 'm11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>'
                        . '</svg>'
                        . '</button>'
                        . '</div>'
                    )),

                // ── Ô nhập mã ──────────────────────────────────────────
                Forms\Components\TextInput::make('captcha_answer')
                    ->hiddenLabel()
                    ->placeholder('Nhập mã xác nhận...')
                    ->required()
                    ->prefixIcon('heroicon-o-shield-check')
                    ->validationMessages([
                        'required' => 'Vui lòng nhập mã xác nhận.',
                    ])
                    ->extraAttributes([
                        'autocomplete' => 'off',
                        'spellcheck'   => 'false',
                        'data-captcha' => 'true',
                    ])
                    ->extraFieldWrapperAttributes(['class' => 'captcha-input-wrapper'])
                    ->rules([
                        fn () => function (string $attribute, $value, \Closure $fail) {
                            // So sánh case-sensitive
                            if ($value !== $this->captchaCode) {
                                $this->generateCaptcha();
                                $fail('Mã xác nhận không đúng. Vui lòng thử lại.');
                            }
                        },
                    ]),
            ])
            ->statePath('data');
    }

    /**
     * Override để validate CAPTCHA trước khi gọi parent.
     */
    public function authenticate(): ?\Filament\Http\Responses\Auth\Contracts\LoginResponse
    {
        // getState() kích hoạt toàn bộ validation Filament (kể cả captcha_answer rule)
        $data = $this->form->getState();

        // Lớp bảo vệ thứ 2 (case-sensitive)
        if (($data['captcha_answer'] ?? '') !== $this->captchaCode) {
            $this->generateCaptcha();
            throw ValidationException::withMessages([
                'data.captcha_answer' => 'Mã xác nhận không đúng. Vui lòng thử lại.',
            ]);
        }

        return parent::authenticate();
    }
}
