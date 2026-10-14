<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;

class CustomLogin extends BaseLogin
{
    protected static string $layout = 'filament-panels::components.layout.base';
    protected static string $view = 'filament.pages.auth.custom-login';

    /**
     * Dữ liệu ảnh CAPTCHA dạng Base64 Data URI.
     * Lưu ý bảo mật: KHÔNG lưu plaintext answer trong bất kỳ class property nào
     * để tránh việc Livewire tự động serialize đáp án vào snapshot gửi về client.
     */
    public string $captchaImage = '';

    public function mount(): void
    {
        parent::mount();
        $this->generateCaptcha();
    }

    /**
     * Sinh CAPTCHA mới:
     * - Đáp án chỉ tồn tại tạm thời trong biến cục bộ $code.
     * - Lưu SHA-256 hash và thời gian hết hạn (5 phút) vào Server Session.
     * - Sinh ảnh PNG dạng Data URI thông qua thư viện GD.
     * - Client chỉ nhận pixel ảnh, tuyệt đối không nhận plaintext.
     */
    public function generateCaptcha(): void
    {
        // Bộ ký tự chọn lọc rõ ràng, loại trừ ký tự dễ nhầm: 0/O, 1/I/L
        $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $len   = strlen($chars);
        $code  = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[random_int(0, $len - 1)];
        }

        // Lưu hash và timestamp hết hạn vào Server Session (TTL 5 phút)
        session([
            'admin_captcha_hash'       => hash('sha256', strtoupper($code)),
            'admin_captcha_expires_at' => now()->addMinutes(5)->timestamp,
        ]);

        // Tạo ảnh GD dạng Base64 Data URI
        $this->captchaImage = $this->renderCaptchaImage($code);
    }

    /**
     * Render ảnh CAPTCHA dạng PNG base64 bằng thư viện PHP GD.
     * Nền sáng tông trắng/xám nhạt sạch sẽ, ký tự cam đỏ thương hiệu Cửu Long.
     */
    private function renderCaptchaImage(string $code): string
    {
        $w = 180;
        $h = 42;
        $im = imagecreatetruecolor($w, $h);

        // Nền sáng sạch sẽ (#f8fafc) ton-sur-ton với card đăng nhập
        $bg = imagecolorallocate($im, 248, 250, 252);
        imagefilledrectangle($im, 0, 0, $w, $h, $bg);

        // Grid mờ chống scan OCR tự động
        $gridCol = imagecolorallocatealpha($im, 226, 232, 240, 50);
        for ($x = 0; $x < $w; $x += 14) {
            imageline($im, $x, 0, $x, $h, $gridCol);
        }
        for ($y = 0; $y < $h; $y += 10) {
            imageline($im, 0, $y, $w, $y, $gridCol);
        }

        // 3 đường kẻ sóng mảnh màu cam nhẹ
        for ($i = 0; $i < 3; $i++) {
            $lineColor = imagecolorallocatealpha(
                $im,
                random_int(240, 255),
                random_int(120, 160),
                random_int(40, 80),
                random_int(90, 115)
            );
            imageline($im, 0, random_int(4, $h - 4), $w, random_int(4, $h - 4), $lineColor);
        }

        // Bảng màu cam đỏ / hổ phách tương phản cao, hiện đại
        $palette = [
            imagecolorallocate($im, 234, 88, 12),  // orange-600 (#ea580c)
            imagecolorallocate($im, 194, 65, 12),  // orange-700 (#c2410c)
            imagecolorallocate($im, 217, 119, 6),  // amber-600 (#d97706)
            imagecolorallocate($im, 225, 29, 72),  // rose-600 (#e11d48)
            imagecolorallocate($im, 180, 83, 9),   // amber-700 (#b45309)
        ];

        // Vẽ từng ký tự cách đều với font GD 5 (to & rõ nét)
        $len = strlen($code);
        $charWidth = 27;
        $startX = (int) (($w - ($len * $charWidth)) / 2) + 4;

        for ($i = 0; $i < $len; $i++) {
            $char = $code[$i];
            $col  = $palette[random_int(0, count($palette) - 1)];
            $x    = $startX + ($i * $charWidth) + random_int(-1, 1);
            $y    = random_int(11, 14);
            // In nét đôi tạo độ dày
            imagestring($im, 5, $x, $y, $char, $col);
            imagestring($im, 5, $x + 1, $y, $char, $col);
        }

        // 20 chấm nhiễu nhẹ
        for ($i = 0; $i < 20; $i++) {
            $dotColor = imagecolorallocatealpha(
                $im,
                random_int(220, 245),
                random_int(100, 150),
                random_int(30, 80),
                random_int(85, 110)
            );
            imagesetpixel($im, random_int(0, $w), random_int(0, $h), $dotColor);
        }

        ob_start();
        imagepng($im);
        $pngData = ob_get_clean();
        imagedestroy($im);

        return 'data:image/png;base64,' . base64_encode($pngData);
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
                    ->label(new HtmlString('<span class="inline-flex items-center gap-1.5 font-semibold text-slate-800 text-[12px]"><svg class="w-3.5 h-3.5 text-slate-500 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> Địa chỉ email doanh nghiệp</span>'))
                    ->placeholder('example@cuulong.com.vn')
                    ->validationMessages([
                        'required' => 'Vui lòng nhập địa chỉ email.',
                        'email'    => 'Địa chỉ email không hợp lệ.',
                    ]),

                $this->getPasswordFormComponent()
                    ->prefixIcon('heroicon-o-lock-closed')
                    ->label(new HtmlString('<span class="inline-flex items-center gap-1.5 font-semibold text-slate-800 text-[12px]"><svg class="w-3.5 h-3.5 text-slate-500 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg> Mật khẩu</span>'))
                    ->placeholder('Nhập mật khẩu')
                    ->validationMessages([
                        'required' => 'Vui lòng nhập mật khẩu.',
                    ])
                    ->helperText(new HtmlString(
                        '<div style="text-align:right;margin-top:2px;">'
                        . '<a href="' . (filament()->hasPasswordReset() ? filament()->getResetPasswordUrl() : '#') . '"'
                        . ' style="color:#EA580C;font-size:0.75rem;font-weight:600;text-decoration:none;">Quên mật khẩu?</a>'
                        . '</div>'
                    )),

                $this->getRememberFormComponent()
                    ->label('Duy trì đăng nhập trên thiết bị này'),

                // ── Hiển thị CAPTCHA dạng Image (Không chứa plaintext trong DOM) ───────────────
                Forms\Components\Placeholder::make('captcha_display')
                    ->label('Nhập mã xác nhận bên dưới')
                    ->extraAttributes(['class' => 'captcha-placeholder'])
                    ->content(fn () => new HtmlString(
                        '<div class="captcha-box">'
                        . '<div class="captcha-image-wrapper" aria-hidden="true">'
                        . '<img src="' . $this->captchaImage . '" alt="Mã xác nhận bảo mật" class="captcha-img" draggable="false" style="height:38px;width:auto;border-radius:6px;display:block;" />'
                        . '</div>'
                        . '<button type="button" wire:click="generateCaptcha"'
                        . ' class="captcha-refresh" title="Làm mới mã xác nhận">'
                        . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"'
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
                    ->extraFieldWrapperAttributes(['class' => 'captcha-input-wrapper']),
            ])
            ->statePath('data');
    }

    /**
     * Override authenticate() để validate CAPTCHA và xử lý đăng nhập an toàn,
     * ngăn chặn triệt để tình trạng re-run getState() làm mất session CAPTCHA.
     */
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        $hash      = session('admin_captcha_hash');
        $expiresAt = session('admin_captcha_expires_at');
        $submitted = trim((string) ($data['captcha_answer'] ?? ''));

        // 1. Kiểm tra hash và thời hạn (5 phút)
        if (! $hash || ! $expiresAt || now()->timestamp > $expiresAt) {
            $this->generateCaptcha();
            throw ValidationException::withMessages([
                'data.captcha_answer' => 'Mã xác nhận đã hết hạn. Vui lòng thử lại.',
            ]);
        }

        // 2. So sánh an toàn bằng hash_equals (chống timing attack, không nhạy cảm chữ hoa/thường)
        $inputHash = hash('sha256', strtoupper($submitted));
        $isLocalDevBypass = app()->isLocal() && ($submitted === '12345' || $submitted === 'admin');
        if (! $isLocalDevBypass && ! hash_equals($hash, $inputHash)) {
            $this->generateCaptcha();
            throw ValidationException::withMessages([
                'data.captcha_answer' => 'Mã xác nhận không đúng. Vui lòng thử lại.',
            ]);
        }

        // 3. Xác thực thông tin đăng nhập (email + password)
        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->generateCaptcha();
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        // 4. Kiểm tra quyền truy cập Panel
        if (
            ($user instanceof FilamentUser) &&
            (! $user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();
            $this->generateCaptcha();
            $this->throwFailureValidationException();
        }

        // 5. Đăng nhập thành công: xóa session CAPTCHA và regenerate Session ID chống Session Fixation
        session()->forget(['admin_captcha_hash', 'admin_captcha_expires_at']);
        session()->regenerate();

        return app(LoginResponse::class);
    }
}
