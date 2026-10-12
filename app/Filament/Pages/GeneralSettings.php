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
        return auth()->user()->hasRole('Admin');
    }

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'CẤU HÌNH & HỆ THỐNG';
    protected static ?string $navigationLabel = 'Cài đặt';
    protected static ?string $title = 'Cài Đặt Hệ Thống & Doanh Nghiệp';
    protected static ?int $navigationSort = 4;
    protected static string $view = 'filament.pages.general-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
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
                                    ->placeholder('G-XXXXXXXXXX'),
                                TextInput::make('analytics_gtm')
                                    ->label('Google Tag Manager ID')
                                    ->placeholder('GTM-XXXXXXX'),
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
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
            Cache::forget("setting_{$key}"); // Clear cache for each updated setting
        }

        Notification::make()
            ->title('Đã lưu cấu hình')
            ->success()
            ->send();
    }
}
