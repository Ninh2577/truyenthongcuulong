<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class GeneralSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'Admin']) || (bool) auth()->user()?->can('manage_settings');
    }

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'CẤU HÌNH & HỆ THỐNG';
    protected static ?string $navigationLabel = 'Cài đặt';
    protected static ?string $title = 'Cài Đặt Hệ Thống & Doanh Nghiệp';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.general-settings';

    public ?array $data = [];

    public static function getDefaults(): array
    {
        return [
            'company_name' => 'Công Ty TNHH Truyền Thông Cửu Long',
            'company_phone' => '0939 363 262',
            'company_email' => 'info@truyenthongcuulong.com',
            'company_address' => 'Lầu 5, 57 Hùng Vương, P. Ninh Kiều, TP. Cần Thơ',
            'company_description' => 'Công ty thiết kế Web, WebApp, UX/UI, SEO tổng thể & dịch vụ quay chụp sự kiện, team building, flycam chuyên nghiệp tại Cần Thơ & ĐBSCL.',
            'social_facebook' => 'https://www.facebook.com/truyenthongcuulong',
            'social_zalo' => '0939363262',
            'social_youtube' => 'https://www.youtube.com/@truyenthongcuulong',
            'company_map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125715.77259461124!2d105.6983416!3d10.0341851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f6de3dedb%3A0x329435b60e7f7229!2zQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s',
            'google_site_verification' => '',
            'analytics_ga4' => '',
            'analytics_gtm' => '',
            'custom_header_scripts' => '',
            'custom_footer_scripts' => '',
        ];
    }

    public function mount(): void
    {
        $defaults = self::getDefaults();
        $stored = Setting::pluck('value', 'key')->toArray();

        // Tự động map dữ liệu thực tế của doanh nghiệp vào từng trường
        $merged = [];
        foreach ($defaults as $key => $defaultVal) {
            $merged[$key] = (isset($stored[$key]) && $stored[$key] !== '' && $stored[$key] !== null) 
                ? $stored[$key] 
                : $defaultVal;
        }

        // Tự động lưu giá trị mặc định vào DB nếu trước đó chưa có để đồng bộ hệ thống
        foreach ($merged as $k => $v) {
            if (!empty($v) && (!isset($stored[$k]) || $stored[$k] === '' || $stored[$k] === null)) {
                Setting::updateOrCreate(['key' => $k], ['value' => $v]);
            }
        }
        Cache::forget('settings_all_dict');

        $this->form->fill($merged);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Tabs::make('SettingsTabs')
                    ->columnSpanFull()
                    ->tabs([
                        \Filament\Forms\Components\Tabs\Tab::make('Thông tin công ty')
                            ->icon('heroicon-o-building-office-2')
                            ->schema([
                                TextInput::make('company_name')
                                    ->label('Tên Tổ chức / Doanh nghiệp')
                                    ->required()
                                    ->placeholder('Công ty TNHH Truyền Thông Cửu Long'),
                                TextInput::make('company_phone')
                                    ->label('Hotline đại diện')
                                    ->required()
                                    ->tel()
                                    ->placeholder('0939 363 262'),
                                TextInput::make('company_email')
                                    ->label('Email tiếp nhận thông tin')
                                    ->email()
                                    ->required()
                                    ->placeholder('info@truyenthongcuulong.com'),
                                TextInput::make('company_address')
                                    ->label('Địa chỉ trụ sở chính')
                                    ->required()
                                    ->placeholder('Lầu 5, 57 Hùng Vương, Cần Thơ'),
                                Textarea::make('company_description')
                                    ->label('Mô tả ngắn doanh nghiệp')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])->columns(2),

                        \Filament\Forms\Components\Tabs\Tab::make('Mạng xã hội & Kênh liên lạc')
                            ->icon('heroicon-o-share')
                            ->schema([
                                TextInput::make('social_facebook')
                                    ->label('Facebook Fanpage')
                                    ->url()
                                    ->placeholder('https://facebook.com/...'),
                                TextInput::make('social_zalo')
                                    ->label('Số Zalo tư vấn (Chỉ số)')
                                    ->placeholder('0939363262'),
                                TextInput::make('social_youtube')
                                    ->label('Kênh YouTube')
                                    ->url()
                                    ->placeholder('https://youtube.com/...'),
                            ])->columns(3),

                        \Filament\Forms\Components\Tabs\Tab::make('Cấu hình SEO & Bản đồ')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                TextInput::make('google_site_verification')
                                    ->label('Mã xác minh Google Search Console (google-site-verification)')
                                    ->placeholder('VD: 4aBcdEfGhIjKlMnOpQrStUvWxYz0123456789')
                                    ->helperText('Dán chuỗi mã xác minh (content="...") hoặc nguyên thẻ meta do Google cấp.')
                                    ->columnSpanFull(),
                                Textarea::make('company_map')
                                    ->label('Google Maps (URL Embed / Iframe)')
                                    ->placeholder('https://www.google.com/maps/embed?...')
                                    ->helperText('Dán URL nhúng hoặc nguyên thẻ <iframe> từ Google Maps.')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),

                        \Filament\Forms\Components\Tabs\Tab::make('Analytics & Đo lường')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                TextInput::make('analytics_ga4')
                                    ->label('Google Analytics 4 Measurement ID')
                                    ->placeholder('G-XXXXXXXXXX')
                                    ->helperText('Mã luồng dữ liệu Google Analytics 4 (bắt đầu bằng G-).'),
                                TextInput::make('analytics_gtm')
                                    ->label('Google Tag Manager ID')
                                    ->placeholder('GTM-XXXXXXX')
                                    ->helperText('Mã container Google Tag Manager (bắt đầu bằng GTM-).'),
                            ])->columns(2),

                        \Filament\Forms\Components\Tabs\Tab::make('Mã nhúng & Tùy biến')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                Textarea::make('custom_header_scripts')
                                    ->label('Mã nhúng trước thẻ </head>')
                                    ->rows(4)
                                    ->placeholder('<!-- Custom Header Scripts -->')
                                    ->columnSpanFull(),
                                Textarea::make('custom_footer_scripts')
                                    ->label('Mã nhúng trước thẻ </body>')
                                    ->rows(4)
                                    ->placeholder('<!-- Custom Footer Scripts -->')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            // Tự động trích xuất chuỗi mã nếu người dùng dán nguyên thẻ <meta ... content="XYZ">
            if ($key === 'google_site_verification' && !empty($value)) {
                if (preg_match('/content=["\']([^"\']+)["\']/', $value, $m)) {
                    $value = $m[1];
                }
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
            Cache::forget("setting_{$key}"); // Clear cache for each updated setting
        }

        Cache::forget('settings_all_dict'); // Clear global helper settings dictionary

        Notification::make()
            ->title('Đã lưu cấu hình')
            ->success()
            ->send();
    }
}
