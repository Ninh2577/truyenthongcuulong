<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Services\Seo\SchemaService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\HtmlString;

class SchemaSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'Admin']) || (bool) auth()->user()?->can('manage_settings');
    }

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';
    protected static ?string $navigationGroup = 'CẤU HÌNH & HỆ THỐNG';
    protected static ?string $navigationLabel = 'Cấu hình Schema (SEO)';
    protected static ?string $title = 'Cấu Hình Schema Dữ Liệu Có Cấu Trúc (Rank Math SEO)';
    protected static ?string $slug = 'schema-settings';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.pages.schema-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $defaults = SchemaService::getDefaults();
        $stored = Setting::where('key', 'like', 'schema_%')->pluck('value', 'key')->toArray();

        // Merge defaults with stored values
        $formData = array_merge($defaults, $stored);

        // Ensure array for multi-checkbox
        if (isset($formData['schema_opening_days']) && is_string($formData['schema_opening_days'])) {
            $decoded = json_decode($formData['schema_opening_days'], true);
            $formData['schema_opening_days'] = is_array($decoded) 
                ? $decoded 
                : array_map('trim', explode(',', $formData['schema_opening_days']));
        }

        // Toggles as boolean
        $formData['schema_enable_breadcrumb'] = (bool) ($formData['schema_enable_breadcrumb'] ?? true);
        $formData['schema_enable_sitelinks_search'] = (bool) ($formData['schema_enable_sitelinks_search'] ?? true);
        $formData['schema_enable_offer_catalog'] = (bool) ($formData['schema_enable_offer_catalog'] ?? true);
        $formData['schema_use_manual_override'] = (bool) ($formData['schema_use_manual_override'] ?? false);

        // Khởi tạo mã JSON đầy đủ nếu chưa có để người dùng có thể sửa ngay lập tức (Lỗi 3 Fix)
        $baseUrl = app(SchemaService::class)->getBaseUrl();
        if (empty($formData['schema_manual_override_json'])) {
            $formData['schema_manual_override_json'] = json_encode(
                app(SchemaService::class)->getGraphArray(null, $baseUrl, true), 
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            );
        } else {
            // Tự động khử độc URL trang quản trị nếu từng bị gán nhầm cuulongteam/schema-settings
            if (str_contains($formData['schema_manual_override_json'], 'cuulongteam/schema-settings')) {
                $formData['schema_manual_override_json'] = str_replace(
                    ['https://truyenthongcuulong.com/cuulongteam/schema-settings', '/cuulongteam/schema-settings'],
                    [$baseUrl, ''],
                    $formData['schema_manual_override_json']
                );
                Setting::updateOrCreate(
                    ['key' => 'schema_manual_override_json'],
                    ['value' => $formData['schema_manual_override_json']]
                );
            }

            // Tự động làm sạch các entity như &amp; hoặc \&quot; nếu từng bị lưu trước đó
            $formData['schema_manual_override_json'] = html_entity_decode(
                $formData['schema_manual_override_json'], 
                ENT_QUOTES | ENT_HTML5, 
                'UTF-8'
            );
            $formData['schema_manual_override_json'] = str_replace(
                ['&amp;', '\\&quot;', '&quot;'], 
                ['&', '"', '"'], 
                $formData['schema_manual_override_json']
            );

            // Đảm bảo BreadcrumbList có mặt trong schema_manual_override_json nếu chưa có
            $decoded = json_decode($formData['schema_manual_override_json'], true);
            if (is_array($decoded) && isset($decoded['@graph']) && is_array($decoded['@graph'])) {
                $hasBreadcrumb = false;
                foreach ($decoded['@graph'] as $node) {
                    if (isset($node['@type']) && $node['@type'] === 'BreadcrumbList') {
                        $hasBreadcrumb = true;
                        break;
                    }
                }
                if (!$hasBreadcrumb && ($formData['schema_enable_breadcrumb'] ?? true)) {
                    $decoded['@graph'][] = app(SchemaService::class)->getDynamicBreadcrumbsSchema(null, $baseUrl, true);
                    $formData['schema_manual_override_json'] = json_encode($decoded, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                }
            }
        }

        $this->form->fill($formData);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('SchemaTabs')
                    ->columnSpanFull()
                    ->tabs([
                        // Tab 1: Organization & Business
                        Tab::make('🏢 Thực thể Doanh nghiệp')
                            ->icon('heroicon-o-building-office-2')
                            ->schema([
                                Grid::make(3)->schema([
                                    Select::make('schema_entity_type')
                                        ->label('Loại Thực Thể (Entity Type)')
                                        ->options([
                                            'ProfessionalService' => 'ProfessionalService (Dịch vụ Chuyên nghiệp - Khuyên dùng)',
                                            'LocalBusiness' => 'LocalBusiness (Doanh nghiệp Địa phương)',
                                            'Organization' => 'Organization (Tổ chức / Công ty tiêu chuẩn)',
                                            'Corporation' => 'Corporation (Tập đoàn)',
                                            'TechnologyCompany' => 'TechnologyCompany (Công ty Công nghệ)',
                                        ])
                                        ->required()
                                        ->columnSpan(2)
                                        ->helperText('Loại thực thể chính mà Google Knowledge Graph sử dụng để định danh website.'),

                                    Select::make('schema_org_price_range')
                                        ->label('Mức giá (Price Range)')
                                        ->options([
                                            '$' => '$ (Bình dân / Tiết kiệm)',
                                            '$$' => '$$ (Trung cấp / Tiêu chuẩn - Khuyên dùng)',
                                            '$$$' => '$$$ (Cao cấp / Chuyên sâu)',
                                            '$$$$' => '$$$$ (Doanh nghiệp lớn / Enterprise)',
                                        ])
                                        ->columnSpan(1),
                                ]),

                                Grid::make(2)->schema([
                                    TextInput::make('schema_org_name')
                                        ->label('Tên Thương Hiệu (Brand Name)')
                                        ->required()
                                        ->placeholder('Truyền Thông Cửu Long'),

                                    TextInput::make('schema_org_legal_name')
                                        ->label('Tên Pháp Lý Đầy Đủ (Legal Name)')
                                        ->placeholder('Công Ty TNHH Truyền Thông Cửu Long'),
                                ]),

                                TextInput::make('schema_org_alternate_names')
                                    ->label('Tên gọi khác / Bí danh (Alternate Names)')
                                    ->placeholder('Cửu Long Media, Truyền Thông Cửu Long - Technology & Digital Solutions')
                                    ->helperText('Các tên gọi khác của tổ chức, phân cách bằng dấu phẩy.'),

                                Grid::make(2)->schema([
                                    TextInput::make('schema_org_url')
                                        ->label('URL Website Chính Thức')
                                        ->url()
                                        ->required()
                                        ->placeholder('https://truyenthongcuulong.com'),

                                    TextInput::make('schema_org_logo')
                                        ->label('URL Logo Schema (Google Search)')
                                        ->url()
                                        ->required()
                                        ->placeholder('https://truyenthongcuulong.com/images/logo-ttcl.png')
                                        ->helperText('Kích thước khuyến nghị: tối thiểu 112x112px, tỉ lệ vuông hoặc chữ nhật rõ nét.'),
                                ]),

                                Grid::make(2)->schema([
                                    TextInput::make('schema_org_email')
                                        ->label('Email Liên Hệ Chính Thức')
                                        ->email()
                                        ->placeholder('info@truyenthongcuulong.com'),

                                    TextInput::make('schema_org_telephone')
                                        ->label('Hotline Đại Diện (Định dạng quốc tế)')
                                        ->tel()
                                        ->placeholder('+84939363262'),
                                ]),

                                Textarea::make('schema_org_description')
                                    ->label('Mô Tả Doanh Nghiệp Cho Google Knowledge Graph')
                                    ->rows(3)
                                    ->placeholder('Đơn vị cung cấp giải pháp công nghệ, thiết kế Website chuẩn SEO...')
                                    ->columnSpanFull(),
                            ]),

                        // Tab 2: Location & Geo
                        Tab::make('📍 Địa chỉ & Tọa độ Geo')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                TextInput::make('schema_address_street')
                                    ->label('Địa chỉ chi tiết (Số nhà, đường, tòa nhà)')
                                    ->placeholder('Lầu 5, 57 Hùng Vương')
                                    ->columnSpanFull(),

                                Grid::make(4)->schema([
                                    TextInput::make('schema_address_locality')
                                        ->label('Quận / Huyện / Phường')
                                        ->placeholder('Ninh Kiều'),

                                    TextInput::make('schema_address_region')
                                        ->label('Tỉnh / Thành Phố')
                                        ->placeholder('Cần Thơ'),

                                    TextInput::make('schema_address_postal_code')
                                        ->label('Mã Bưu Chính (Postal Code)')
                                        ->placeholder('900000'),

                                    TextInput::make('schema_address_country')
                                        ->label('Mã Quốc Gia (Country)')
                                        ->placeholder('VN'),
                                ]),

                                Grid::make(2)->schema([
                                    TextInput::make('schema_geo_latitude')
                                        ->label('Vĩ Độ Latitude (Tọa độ Google Maps)')
                                        ->numeric()
                                        ->placeholder('10.0438252')
                                        ->helperText('Giúp Google Map & Local SEO định vị chính xác vị trí trụ sở.'),

                                    TextInput::make('schema_geo_longitude')
                                        ->label('Kinh Độ Longitude (Tọa độ Google Maps)')
                                        ->numeric()
                                        ->placeholder('105.7789027')
                                        ->helperText('Tọa độ kinh độ trên bản đồ GPS.'),
                                ]),

                                TextInput::make('schema_area_served')
                                    ->label('Khu Vực Phục Vụ (Area Served)')
                                    ->placeholder('Cần Thơ, Đồng bằng sông Cửu Long, Toàn quốc')
                                    ->helperText('Phân cách các khu vực phục vụ bằng dấu phẩy.')
                                    ->columnSpanFull(),
                            ]),

                        // Tab 3: Opening Hours & Social Profiles (SameAs)
                        Tab::make('⏰ Giờ làm việc & Mạng xã hội')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Section::make('Giờ Phục Vụ / Mở Cửa (Opening Hours)')
                                    ->schema([
                                        CheckboxList::make('schema_opening_days')
                                            ->label('Các ngày mở cửa trong tuần')
                                            ->options([
                                                'Monday' => 'Thứ Hai',
                                                'Tuesday' => 'Thứ Ba',
                                                'Wednesday' => 'Thứ Tư',
                                                'Thursday' => 'Thứ Năm',
                                                'Friday' => 'Thứ Sáu',
                                                'Saturday' => 'Thứ Bảy',
                                                'Sunday' => 'Chủ Nhật',
                                            ])
                                            ->columns(4)
                                            ->columnSpanFull(),

                                        Grid::make(2)->schema([
                                            TextInput::make('schema_opening_hours_open')
                                                ->label('Giờ mở cửa hàng ngày')
                                                ->placeholder('07:30'),

                                            TextInput::make('schema_opening_hours_close')
                                                ->label('Giờ đóng cửa hàng ngày')
                                                ->placeholder('17:30'),
                                        ]),
                                    ]),

                                Section::make('Hồ Sơ Mạng Xã Hội (Social Profiles - sameAs)')
                                    ->description('Khai báo liên kết hồ sơ thực thể chuẩn Rank Math để Google liên kết Knowledge Panel.')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('schema_social_facebook')
                                                ->label('Facebook Fanpage')
                                                ->url()
                                                ->nullable()
                                                ->placeholder('https://www.facebook.com/...'),

                                            TextInput::make('schema_social_youtube')
                                                ->label('Kênh YouTube')
                                                ->url()
                                                ->nullable()
                                                ->placeholder('https://www.youtube.com/...'),

                                            TextInput::make('schema_social_tiktok')
                                                ->label('Kênh TikTok')
                                                ->url()
                                                ->nullable()
                                                ->placeholder('https://www.tiktok.com/@...'),

                                            TextInput::make('schema_social_twitter')
                                                ->label('Mạng Xã Hội X / Twitter')
                                                ->url()
                                                ->nullable()
                                                ->placeholder('https://twitter.com/...'),

                                            TextInput::make('schema_social_linkedin')
                                                ->label('Trang Doanh Nghiệp LinkedIn')
                                                ->url()
                                                ->nullable()
                                                ->placeholder('https://www.linkedin.com/company/...'),

                                            TextInput::make('schema_social_zalo')
                                                ->label('Zalo Tư Vấn (URL hoặc Số điện thoại)')
                                                ->nullable()
                                                ->placeholder('0939363262 hoặc https://zalo.me/...'),
                                        ]),
                                    ]),
                            ]),


                        // Tab 4: Content Type Defaults (Rank Math SEO)
                        // Tab 4: Cấu hình Mẫu Schema Chi Tiết (Content Types)
                        Tab::make('📑 Cấu hình Mẫu Schema (Content Types)')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('🛠️ Cấu hình Chi Tiết Schema Dịch Vụ (Service Schema - Landing Page & Pillar Page)')
                                    ->description('Cấu hình các thuộc tính Schema mẫu cho các bài viết dịch vụ, trang chuyên đề và Landing Page chuyển đổi.')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            Select::make('schema_default_service_type')
                                                ->label('Loại Thực Thể Dịch Vụ (@type)')
                                                ->options([
                                                    'Service' => 'Service (Dịch vụ cung cấp tiêu chuẩn)',
                                                    'ProfessionalService' => 'ProfessionalService (Dịch vụ chuyên nghiệp)',
                                                ])
                                                ->required(),

                                            TextInput::make('schema_service_sub_type')
                                                ->label('Phân loại Dịch vụ chuyên môn (Service Type bổ trợ)')
                                                ->placeholder('Thiết kế Website Chuẩn SEO, Lập trình Web App & Media Sự Kiện')
                                                ->helperText('Hiển thị thuộc tính serviceType nếu bài viết không có chuyên mục.'),
                                        ]),

                                        TextInput::make('schema_default_service_area')
                                            ->label('Khu vực cung cấp dịch vụ (Area Served)')
                                            ->placeholder('Cần Thơ, Đồng bằng sông Cửu Long, Toàn quốc')
                                            ->helperText('Địa bàn cung cấp dịch vụ áp dụng tự động cho mọi trang dịch vụ & Landing Page.')
                                            ->columnSpanFull(),

                                        Grid::make(2)->schema([
                                            TextInput::make('schema_service_default_price')
                                                ->label('Báo giá / Mức giá tham chiếu mặc định (Offer Price)')
                                                ->placeholder('Ví dụ: Liên hệ tư vấn hoặc 5.000.000'),

                                            Select::make('schema_service_default_currency')
                                                ->label('Đơn vị tiền tệ')
                                                ->options([
                                                    'VND' => 'VND (Việt Nam Đồng)',
                                                    'USD' => 'USD (Đô la Mỹ)',
                                                ]),
                                        ]),

                                        TextInput::make('schema_service_default_terms')
                                            ->label('Điều khoản & Cam kết dịch vụ mặc định (Terms of Service)')
                                            ->placeholder('Bảo hành kỹ thuật 12 tháng, hỗ trợ vận hành 24/7')
                                            ->columnSpanFull(),

                                        Textarea::make('schema_service_custom_jsonld')
                                            ->label('Mã Schema JSON-LD bổ sung riêng cho các trang Dịch vụ (Tùy chọn nâng cao)')
                                            ->rows(3)
                                            ->placeholder('{"@type": "OfferCatalog", ...}')
                                            ->helperText('Tự động nhúng vào @graph của các bài viết chọn Schema Service.')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('📰 Cấu hình Chi Tiết Schema Bài Viết & Chuyên Đề (Article Schema)')
                                    ->description('Cấu hình các thuộc tính Schema mẫu cho các bài viết tin tức, bài chia sẻ kiến thức và chuyên đề biên tập.')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            Select::make('schema_default_post_type')
                                                ->label('Loại Bài Viết (@type)')
                                                ->options([
                                                    'Article' => 'Article (Khuyên dùng - Chuẩn SEO báo chí & chuyên gia)',
                                                    'BlogPosting' => 'BlogPosting (Bài chia sẻ blog cá nhân)',
                                                    'NewsArticle' => 'NewsArticle (Tin bài thời sự cập nhật nhanh)',
                                                    'TechArticle' => 'TechArticle (Bài viết kỹ thuật phần mềm & công nghệ)',
                                                ])
                                                ->required(),

                                            TextInput::make('schema_default_article_keywords')
                                                ->label('Từ khóa bổ sung mặc định cho Schema Article')
                                                ->placeholder('Thiết kế Website, Lập trình Web App, UI/UX, SEO Tổng Thể...'),
                                        ]),

                                        Textarea::make('schema_default_article_about')
                                            ->label('Danh mục Thực thể chủ đề chuyên môn (About Things)')
                                            ->rows(4)
                                            ->placeholder("Thiết kế Website Chuẩn SEO & Lập trình Web App\nDịch vụ Media, Quay Phim & Chụp Ảnh Sự Kiện Chuyên Nghiệp")
                                            ->helperText('Mỗi dòng một thực thể chủ đề. Google AI & Knowledge Graph sử dụng danh sách này để nhận diện thực thể uy tín.')
                                            ->columnSpanFull(),

                                        Textarea::make('schema_article_custom_jsonld')
                                            ->label('Mã Schema JSON-LD bổ sung riêng cho Bài viết (Tùy chọn nâng cao)')
                                            ->rows(3)
                                            ->placeholder('{"@type": "HowTo", ...}')
                                            ->helperText('Tự động nhúng vào @graph của các bài viết chọn Schema Article.')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('🌐 Cấu hình Schema Trang Web (WebPage Schema & Điều hướng)')
                                    ->schema([
                                        Select::make('schema_default_page_type')
                                            ->label('Loại Trang Tĩnh Mặc Định (@type)')
                                            ->options([
                                                'WebPage' => 'WebPage (Trang web tiêu chuẩn)',
                                                'AboutPage' => 'AboutPage (Trang Giới thiệu)',
                                                'ContactPage' => 'ContactPage (Trang Liên hệ)',
                                            ])
                                            ->required(),

                                        Grid::make(2)->schema([
                                            Toggle::make('schema_enable_breadcrumb')
                                                ->label('Bật BreadcrumbList Schema (Thanh điều hướng cấp độ)')
                                                ->helperText('Tạo đường dẫn phân cấp trên trang kết quả tìm kiếm Google (Breadcrumb Rich Snippet).'),

                                            Toggle::make('schema_enable_sitelinks_search')
                                                ->label('Bật Sitelinks Search Box Schema (Hộp tìm kiếm Google)')
                                                ->helperText('Cho phép Google hiển thị ô tìm kiếm trực tiếp trên kết quả tìm kiếm tên thương hiệu.'),
                                        ]),
                                    ]),
                            ]),

                        // Tab 5: KnowsAbout & Offer Catalog
                        Tab::make('💡 Lĩnh vực & Danh mục Dịch vụ')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Textarea::make('schema_knows_about')
                                    ->label('Lĩnh Vực Chuyên Môn (KnowsAbout Knowledge Graph)')
                                    ->rows(7)
                                    ->placeholder("Thiết kế Website chuẩn SEO\nLập trình Web App & Ứng dụng di động\nThiết kế UI/UX...")
                                    ->helperText('Mỗi dòng một chủ đề. Google AI Overviews và RankBrain sử dụng danh sách này để nhận diện thực thể uy tín.')
                                    ->columnSpanFull(),

                                Toggle::make('schema_enable_offer_catalog')
                                    ->label('Tự động nhúng Danh mục Dịch vụ Công nghệ & Media (OfferCatalog) vào Organization Schema')
                                    ->helperText('Nhúng toàn bộ danh mục dịch vụ (Thiết kế Web, WebApp, UI/UX, SEO, Quay chụp sự kiện, Flycam) vào Knowledge Graph của công ty.')
                                    ->columnSpanFull(),
                            ]),

                        // Tab 6: Chỉnh sửa trực tiếp file JSON
                        Tab::make('💻 Trình Soạn Thảo File JSON')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                Toggle::make('schema_use_manual_override')
                                    ->label('Bật Chế Độ Ghi Đè Bằng File JSON Tự Sửa (Manual JSON Override)')
                                    ->helperText('Khi BẬT, website sẽ xuất trực tiếp 100% nội dung JSON bên dưới ra Google thay vì sinh tự động từ form.')
                                    ->live()
                                    ->columnSpanFull(),

                                Placeholder::make('mode_status_notice')
                                    ->label('')
                                    ->content(fn ($get) => new HtmlString(
                                        $get('schema_use_manual_override')
                                            ? '<div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-700 dark:text-amber-300 text-xs font-medium flex items-center gap-2.5">
                                                <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                                <span><b>Chế độ Ghi Đè đang BẬT:</b> Website sẽ xuất đúng 100% cấu trúc JSON bạn sửa trong khung bên dưới. Nếu muốn đồng bộ lại các dữ liệu từ Tabs 1-5, bấm nút <i>"Đồng bộ từ Form sang JSON"</i>.</span>
                                               </div>'
                                            : '<div class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-300 text-xs font-medium flex items-center gap-2.5">
                                                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <span><b>Chế độ Form Động đang BẬT (Mặc định):</b> Mọi thay đổi ở các Tab Form (Thực thể, Địa chỉ, Giờ, MXH, v.v.) sẽ tự động áp dụng ngay ngoài website. Khi lưu, khung JSON bên dưới cũng được tự động cập nhật theo.</span>
                                               </div>'
                                    ))
                                    ->columnSpanFull(),

                                Actions::make([

                                    Action::make('syncFromForm')
                                        ->label('Đồng bộ từ Form sang JSON')
                                        ->icon('heroicon-o-arrow-path')
                                        ->color('info')
                                        ->action('syncFromForm'),

                                    Action::make('formatJson')
                                        ->label('Format / Làm đẹp JSON')
                                        ->icon('heroicon-o-sparkles')
                                        ->color('success')
                                        ->action('formatJson'),

                                    Action::make('validateJson')
                                        ->label('Kiểm tra cú pháp JSON')
                                        ->icon('heroicon-o-check-badge')
                                        ->color('warning')
                                        ->action('validateJson'),
                                ])
                                ->columnSpanFull(),

                                Textarea::make('schema_manual_override_json')
                                    ->label('Nội Dung Toàn Bộ File Schema JSON-LD Graph')
                                    ->rows(26)
                                    ->extraInputAttributes([
                                        'style' => 'background-color: #070d1e !important; color: #38bdf8 !important; -webkit-text-fill-color: #38bdf8 !important; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important; font-size: 13.5px !important; line-height: 1.65 !important; border: 1px solid #1e293b !important; caret-color: #ff712c !important;',
                                        'class' => 'schema-json-editor-textarea',
                                        'spellcheck' => 'false',
                                    ])
                                    ->extraAttributes([
                                        'style' => 'background-color: #070d1e !important; border-radius: 0.75rem !important;',
                                    ])
                                    ->helperText('Chỉnh sửa toàn bộ cấu trúc Schema @graph JSON-LD. Hỗ trợ mọi thuộc tính chuẩn schema.org.')
                                    ->columnSpanFull(),
                            ]),

                        // Tab 7: Custom JSON-LD & Tools
                        Tab::make('🛠️ Schema Bổ sung & Kiểm tra')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->schema([
                                Placeholder::make('rank_math_tools')
                                    ->label('Công Cụ Kiểm Tra Rich Results (Google)')
                                    ->content(new HtmlString('
                                        <div class="flex items-center gap-3 p-4 rounded-xl bg-primary/10 border border-primary/20 text-sm">
                                            <svg class="w-6 h-6 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                            <div class="flex-1">
                                                <p class="font-bold text-gray-900 dark:text-white">Kiểm tra hiển thị dữ liệu có cấu trúc với Google</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">Kiểm tra tính hợp lệ và các tính năng nhiều định dạng (Rich Results) mà Google công nhận.</p>
                                            </div>
                                            <a href="https://search.google.com/test/rich-results?url=https%3A%2F%2Ftruyenthongcuulong.com" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-primary text-white rounded-lg font-bold text-xs hover:opacity-90 transition">
                                                Mở Google Rich Results Test &rarr;
                                            </a>
                                        </div>
                                    ')),

                                Textarea::make('schema_custom_jsonld')
                                    ->label('Mã Schema JSON-LD Bổ Sung (Tùy biến cao cấp)')
                                    ->rows(8)
                                    ->placeholder('{"@type": "FAQPage", "mainEntity": [...]}')
                                    ->helperText('Nếu bạn có đoạn mã JSON-LD tùy biến riêng (ví dụ FAQPage, SoftwareApplication, Event), dán vào đây để được tự động gộp vào @graph.')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function syncFromForm(): void
    {
        $formData = $this->form->getState();

        // Lưu tạm các giá trị form vào DB
        foreach ($formData as $k => $v) {
            if ($k !== 'schema_manual_override_json' && $k !== 'schema_use_manual_override') {
                if (is_array($v)) $v = json_encode($v, JSON_UNESCAPED_UNICODE);
                Setting::updateOrCreate(['key' => $k], ['value' => $v]);
                Cache::forget("setting_{$k}");
            }
        }
        clear_setting_cache();

        // Tạm thời tắt override để sinh ra graph sạch theo form
        Setting::updateOrCreate(['key' => 'schema_use_manual_override'], ['value' => '0']);
        Cache::forget('setting_schema_use_manual_override');

        $service = new SchemaService();
        $freshGraph = $service->getGraphArray(null, null, true);
        $formatted = json_encode($freshGraph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $formData['schema_manual_override_json'] = $formatted;
        $formData['schema_use_manual_override'] = true;
        $this->data = $formData;
        $this->form->fill($this->data);

        clear_setting_cache();

        Notification::make()
            ->title('Đã đồng bộ từ Form sang File JSON thành công')
            ->body('Nội dung file JSON đã được làm mới theo các thông tin bạn vừa nhập ở các Tab Form.')
            ->success()
            ->send();
    }

    public function formatJson(): void
    {
        $state = $this->form->getState();
        $current = trim($state['schema_manual_override_json'] ?? '');

        if (!empty($current)) {
            $decoded = json_decode($current, true);
            if ($decoded !== null) {
                $this->data['schema_manual_override_json'] = json_encode($decoded, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                $this->form->fill($this->data);
                Notification::make()->title('Đã format làm đẹp mã JSON thành công')->success()->send();
                return;
            }
        }

        Notification::make()
            ->title('Không thể format: Cú pháp JSON không hợp lệ')
            ->danger()
            ->send();
    }

    public function validateJson(): void
    {
        $state = $this->form->getState();
        $current = trim($state['schema_manual_override_json'] ?? '');

        if (empty($current)) {
            Notification::make()->title('File JSON đang để trống')->warning()->send();
            return;
        }

        $decoded = json_decode($current, true);
        if ($decoded === null) {
            $error = json_last_error_msg();
            Notification::make()
                ->title('Phát hiện lỗi cú pháp JSON')
                ->body('Chi tiết: ' . $error)
                ->danger()
                ->send();
            return;
        }

        Notification::make()
            ->title('Cú pháp JSON hoàn toàn hợp lệ!')
            ->body('Định dạng schema đúng chuẩn JSON-LD, sẵn sàng xuất ra Google.')
            ->success()
            ->send();
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $useOverride = (bool) ($data['schema_use_manual_override'] ?? false);
        $json = trim($data['schema_manual_override_json'] ?? '');

        // 1. Kiểm tra tính hợp lệ nếu có nhập file JSON
        if (!empty($json)) {
            $decoded = json_decode($json, true);
            if ($decoded === null) {
                Notification::make()
                    ->title('Không thể lưu: Lỗi cú pháp JSON')
                    ->body('Nội dung JSON không hợp lệ (' . json_last_error_msg() . '). Vui lòng kiểm tra lại trước khi lưu.')
                    ->danger()
                    ->send();
                return;
            }
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
            Cache::forget("setting_{$key}");
        }

        // Xóa triệt để cache và làm mới in-memory memoization
        clear_setting_cache();

        // NẾU ĐANG Ở CHẾ ĐỘ FORM ĐỘNG (không bật ghi đè thủ công):
        // Tự động làm mới schema_manual_override_json theo các thông số Form vừa lưu
        // để khi người dùng mở Tab 6 "Trình Soạn Thảo File JSON", mã JSON luôn mới nhất 100%!
        if (!$useOverride) {
            $service = new SchemaService();
            $baseUrl = $service->getBaseUrl();
            $freshGraph = $service->getGraphArray(null, $baseUrl, true);
            $formatted = json_encode($freshGraph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            Setting::updateOrCreate(
                ['key' => 'schema_manual_override_json'],
                ['value' => $formatted]
            );
            Cache::forget('setting_schema_manual_override_json');
            clear_setting_cache();
            $data['schema_manual_override_json'] = $formatted;
        }

        $this->data = $data;
        $this->form->fill($this->data);

        Notification::make()
            ->title('Đã lưu cấu hình Schema Rank Math SEO thành công')
            ->body($useOverride
                ? 'Đã cập nhật theo mã JSON ghi đè thủ công của bạn.'
                : 'Đã cập nhật dữ liệu Schema động theo thông tin các Tab Form thành công.')
            ->success()
            ->send();
    }
}

