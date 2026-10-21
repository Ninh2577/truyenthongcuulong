<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
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
            'google_site_verification' => '0vAK7xzj2s_zBGfLsmeQjZCh3RGTi5Y45RmyxeUTdCg',
            'analytics_ga4' => 'UA-147223881-1',
            'analytics_gtm' => 'GTM-5TL3XPH',
            'google_adsense_enabled' => false,
            'google_adsense_client' => '',
            'google_adsense_auto_ads' => false,
            'ads_post_top_enabled' => false,
            'ads_post_top_code' => '',
            'ads_post_middle_enabled' => false,
            'ads_post_middle_paragraph' => 3,
            'ads_post_middle_code' => '',
            'ads_post_bottom_enabled' => false,
            'ads_post_bottom_code' => '',
            'ads_sidebar_enabled' => false,
            'ads_sidebar_code' => '',
            'ads_footer_banner_enabled' => false,
            'ads_footer_banner_code' => '',
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

        // Tự động chuyển mã AdSense cũ ra khỏi custom_header_scripts nếu trước đó bị dán nhầm vào
        if (!empty($merged['custom_header_scripts']) && str_contains($merged['custom_header_scripts'], 'pagead2.googlesyndication.com')) {
            if (empty($merged['google_adsense_client']) && preg_match('/client=(ca-pub-[0-9]+)/', $merged['custom_header_scripts'], $m)) {
                $merged['google_adsense_client'] = $m[1];
                Setting::updateOrCreate(['key' => 'google_adsense_client'], ['value' => $m[1]]);
            }
            $cleanedHeader = preg_replace('/<script[^>]*pagead2\.googlesyndication\.com[^>]*>.*?<\/script>/is', '', $merged['custom_header_scripts']);
            $merged['custom_header_scripts'] = trim($cleanedHeader);
            Setting::updateOrCreate(['key' => 'custom_header_scripts'], ['value' => $merged['custom_header_scripts']]);
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

                        \Filament\Forms\Components\Tabs\Tab::make('Quản Lý Quảng Cáo (AdSense)')
                            ->icon('heroicon-o-megaphone')
                            ->schema([
                                Section::make('Cấu hình chung Google AdSense')
                                    ->description('Kiểm soát bật/tắt toàn bộ quảng cáo và thông tin tài khoản AdSense của bạn.')
                                    ->schema([
                                        Toggle::make('google_adsense_enabled')
                                            ->label('Kích hoạt hiển thị quảng cáo trên website')
                                            ->helperText('Bật/tắt nhanh toàn bộ quảng cáo trên toàn bộ website mà không bị mất mã.')
                                            ->default(false),
                                        TextInput::make('google_adsense_client')
                                            ->label('Mã Publisher ID (ca-pub-XXXXXXXXXX)')
                                            ->placeholder('ca-pub-7725186365395401')
                                            ->helperText('ID tài khoản AdSense của bạn. Dùng để tự động nạp thư viện script Google AdSense chuẩn SEO.')
                                            ->columnSpan(1),
                                        Toggle::make('google_adsense_auto_ads')
                                            ->label('Bật Quảng cáo tự động của Google (Auto Ads)')
                                            ->helperText('CẢNH BÁO: Nếu bật, Google có thể tự chèn quảng cáo dính đáy màn hình (anchor ads), xen kẽ trang. KHUYẾN NGHỊ TẮT để tự kiểm soát 5 vị trí bên dưới.')
                                            ->default(false)
                                            ->columnSpan(1),
                                    ])->columns(2),

                                Section::make('Vị trí 1: Đầu nội dung bài viết (Post Top)')
                                    ->description('Quảng cáo hiển thị ngay trước khi bắt đầu nội dung chi tiết bài viết.')
                                    ->collapsible()
                                    ->schema([
                                        Toggle::make('ads_post_top_enabled')
                                            ->label('Bật vị trí Đầu bài viết')
                                            ->default(false),
                                        Textarea::make('ads_post_top_code')
                                            ->label('Mã đơn vị quảng cáo AdSense (<ins class="adsbygoogle" ...></ins>)')
                                            ->rows(3)
                                            ->placeholder('<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-..." data-ad-slot="..." data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>')
                                            ->helperText('Tạo "Đơn vị quảng cáo hiển thị" trong Google AdSense rồi dán mã vào đây.')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Vị trí 2: Giữa nội dung bài viết (In-Article / Post Middle)')
                                    ->description('Quảng cáo hiển thị xen kẽ tự nhiên vào giữa các đoạn văn bản của bài viết.')
                                    ->collapsible()
                                    ->schema([
                                        Toggle::make('ads_post_middle_enabled')
                                            ->label('Bật vị trí Giữa bài viết')
                                            ->default(false),
                                        TextInput::make('ads_post_middle_paragraph')
                                            ->label('Chèn sau đoạn văn thứ mấy?')
                                            ->numeric()
                                            ->default(3)
                                            ->helperText('Ví dụ: Nhập số 3 để quảng cáo tự động hiển thị sau đoạn văn bản thứ 3.'),
                                        Textarea::make('ads_post_middle_code')
                                            ->label('Mã đơn vị quảng cáo Trong bài viết (In-article ad)')
                                            ->rows(3)
                                            ->placeholder('<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-..." data-ad-slot="..."></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>')
                                            ->helperText('Nên chọn loại "Quảng cáo trong bài viết" từ AdSense để giao diện tự nhiên và đẹp mắt nhất.')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Vị trí 3: Cuối nội dung bài viết (Post Bottom)')
                                    ->description('Quảng cáo hiển thị ngay sau khi kết thúc bài viết, trước phần liên hệ tư vấn.')
                                    ->collapsible()
                                    ->schema([
                                        Toggle::make('ads_post_bottom_enabled')
                                            ->label('Bật vị trí Cuối bài viết')
                                            ->default(false),
                                        Textarea::make('ads_post_bottom_code')
                                            ->label('Mã đơn vị quảng cáo AdSense')
                                            ->rows(3)
                                            ->placeholder('<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-..." data-ad-slot="..." data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Vị trí 4: Cột bên bài viết (Article Sidebar)')
                                    ->description('Quảng cáo hiển thị ở thanh bên phải (Sidebar) của trang chi tiết bài viết (dạng banner vuông hoặc dọc).')
                                    ->collapsible()
                                    ->schema([
                                        Toggle::make('ads_sidebar_enabled')
                                            ->label('Bật vị trí Cột bên (Sidebar)')
                                            ->default(false),
                                        Textarea::make('ads_sidebar_code')
                                            ->label('Mã đơn vị quảng cáo Sidebar')
                                            ->rows(3)
                                            ->placeholder('<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-..." data-ad-slot="..." data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>')
                                            ->helperText('Nên sử dụng kích thước banner hình vuông (300x250) hoặc banner dọc (300x600).')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Vị trí 5: Banner chân trang (Footer Banner)')
                                    ->description('Banner quảng cáo hiển thị ở đáy website ngay phía trên Footer trên toàn bộ các trang.')
                                    ->collapsible()
                                    ->schema([
                                        Toggle::make('ads_footer_banner_enabled')
                                            ->label('Bật vị trí Banner Chân trang')
                                            ->default(false),
                                        Textarea::make('ads_footer_banner_code')
                                            ->label('Mã đơn vị quảng cáo Footer Banner')
                                            ->rows(3)
                                            ->placeholder('<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-..." data-ad-slot="..." data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>')
                                            ->helperText('Nên sử dụng banner ngang kích thước lớn (728x90 hoặc 970x250 hoặc Responsive ngang).')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        \Filament\Forms\Components\Tabs\Tab::make('Mã nhúng & Tùy biến')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                Section::make('Mã Nhúng Tùy Biến (Header & Footer)')
                                    ->description('Dán các đoạn mã script theo dõi, thẻ meta xác minh hoặc tiện ích bên thứ 3 (Facebook Pixel, TikTok Pixel, Chat Widget,...).')
                                    ->schema([
                                        Textarea::make('custom_header_scripts')
                                            ->label('Mã nhúng Header (Trước thẻ </head>)')
                                            ->rows(4)
                                            ->placeholder('<!-- Ví dụ: Meta tag xác minh, Facebook Pixel, CSS tùy chỉnh -->')
                                            ->helperText('Dành cho các mã script hoặc meta tag cần chạy trong phần đầu trang <head> (Không dùng cho mã quảng cáo Google AdSense).')
                                            ->columnSpanFull(),
                                        Textarea::make('custom_footer_scripts')
                                            ->label('Mã nhúng Footer (Trước thẻ </body>)')
                                            ->rows(4)
                                            ->placeholder('<!-- Ví dụ: Zalo Chat Widget, LiveChat, Script thống kê -->')
                                            ->helperText('Dành cho các mã script tiện ích hoặc widget tương tác tải ở cuối trang trước khi đóng thẻ </body>.')
                                            ->columnSpanFull(),
                                    ]),
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

            // Tự động lọc sạch mã AdSense nếu người dùng dán vào custom_header_scripts
            if ($key === 'custom_header_scripts' && !empty($value)) {
                if (preg_match('/client=(ca-pub-[0-9]+)/', $value, $m) && empty($data['google_adsense_client'])) {
                    Setting::updateOrCreate(['key' => 'google_adsense_client'], ['value' => $m[1]]);
                }
                $value = trim(preg_replace('/<script[^>]*pagead2\.googlesyndication\.com[^>]*>.*?<\/script>/is', '', $value));
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
