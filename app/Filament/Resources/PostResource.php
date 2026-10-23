<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'NỘI DUNG & TIN TỨC';
    protected static ?string $modelLabel = 'Bài viết';
    protected static ?string $pluralModelLabel = 'Bài viết';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'draft')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

        public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('PostFormTabs')
                    ->tabs([
                        // ==========================================
                        // TAB 1: BÀI VIẾT (Soạn thảo nội dung & Xuất bản)
                        // ==========================================
                        Forms\Components\Tabs\Tab::make('Bài viết & Nội dung')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Grid::make([
                                    'default' => 1,
                                    'lg' => 3,
                                ])
                                ->extraAttributes([
                                    'class' => 'items-start',
                                ])
                                ->schema([
                                    // CỘT TRÁI (~70%): NỘI DUNG & SEO
                                    Forms\Components\Group::make([
                                        // Khối 1: Soạn thảo nội dung
                                        Forms\Components\Section::make('Nội dung bài viết')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Tiêu đề bài viết')
                                                    ->placeholder('Nhập tiêu đề bài viết...')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                                                Forms\Components\TextInput::make('slug')
                                                    ->label('Đường dẫn tĩnh (Slug)')
                                                    ->placeholder('duong-dan-bai-viet')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->unique(ignoreRecord: true)
                                                    ->live(onBlur: true),

                                                \AmidEsfahani\FilamentTinyEditor\TinyEditor::make('content')
                                                    ->label('Nội dung chi tiết')
                                                    ->columnSpanFull()
                                                    ->profile('default')
                                                    ->toolbarMode('wrap')
                                                    ->setCustomConfigs([
                                                        'link_rel_list' => [
                                                            ['text' => 'Do Follow (Mặc định)', 'value' => ''],
                                                            ['text' => 'No Follow (rel=nofollow)', 'value' => 'nofollow'],
                                                            ['text' => 'No Follow & Mở tab mới', 'value' => 'nofollow noopener noreferrer'],
                                                        ],
                                                        'rel_list' => [
                                                            ['text' => 'Do Follow (Mặc định)', 'value' => ''],
                                                            ['text' => 'No Follow (rel=nofollow)', 'value' => 'nofollow'],
                                                            ['text' => 'No Follow & Mở tab mới', 'value' => 'nofollow noopener noreferrer'],
                                                        ],
                                                        'link_default_target' => '_blank',
                                                        'link_title' => true,
                                                    ])
                                                    ->view('filament.custom-tiny-editor'),
                                            ]),

                                        // Khối 2: Tối ưu SEO & Phân tích
                                        Forms\Components\Section::make('Tối ưu SEO & Phân tích (Google Rank)')
                                            ->collapsible()
                                            ->schema([
                                                Forms\Components\Grid::make([
                                                    'default' => 1,
                                                    'xl' => 2,
                                                ])
                                                    ->schema([
                                                        Forms\Components\Group::make()->schema([
                                                            Forms\Components\TextInput::make('focus_keyword')
                                                                ->label('Từ khóa chính (Focus Keyword)')
                                                                ->placeholder('Nhập từ khóa chính để phân tích...')
                                                                ->maxLength(255)
                                                                ->live(debounce: 500),
                                                            Forms\Components\Placeholder::make('keyword_overlap_warning')
                                                                ->label('')
                                                                ->visible(function (Forms\Get $get, ?\App\Models\Post $record) {
                                                                    $kw = trim((string) $get('focus_keyword'));
                                                                    if (mb_strlen($kw) < 2) {
                                                                        return false;
                                                                    }
                                                                    $query = \App\Models\Post::where('status', 'published')
                                                                        ->where('focus_keyword', $kw);
                                                                    if ($record && $record->id) {
                                                                        $query->where('id', '!=', $record->id);
                                                                    }
                                                                    return $query->exists();
                                                                })
                                                                ->content(function (Forms\Get $get, ?\App\Models\Post $record) {
                                                                    $kw = trim((string) $get('focus_keyword'));
                                                                    $query = \App\Models\Post::where('status', 'published')
                                                                        ->where('focus_keyword', $kw);
                                                                    if ($record && $record->id) {
                                                                        $query->where('id', '!=', $record->id);
                                                                    }
                                                                    $overlappingPosts = $query->take(3)->get(['id', 'title', 'slug', 'status']);
                                                                    
                                                                    $itemsHtml = '';
                                                                    foreach ($overlappingPosts as $p) {
                                                                        $title = e($p->title);
                                                                        $slug = e($p->slug);
                                                                        $itemsHtml .= "<li class='mt-1 text-xs text-amber-800 dark:text-amber-300'>• <strong>{$title}</strong> (<code>/{$slug}</code>)</li>";
                                                                    }
                                                                    
                                                                    return new \Illuminate\Support\HtmlString("
                                                                        <div class='p-3 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/60 rounded-xl'>
                                                                            <div class='flex items-center gap-1.5 text-xs font-bold text-amber-900 dark:text-amber-200'>
                                                                                <span>⚠️ Phát hiện bài viết có cùng Focus Keyword</span>
                                                                            </div>
                                                                            <div class='mt-1 text-xs text-amber-800 dark:text-amber-300'>
                                                                                Từ khóa <strong>\"" . e($kw) . "\"</strong> đang được sử dụng bởi bài viết khác. Hãy kiểm tra để tránh cạnh tranh từ khóa nội bộ (Keyword Cannibalization):
                                                                            </div>
                                                                            <ul class='mt-1.5 list-none pl-0 space-y-0.5'>
                                                                                {$itemsHtml}
                                                                            </ul>
                                                                        </div>
                                                                    ");
                                                                }),
                                                            Forms\Components\TextInput::make('meta_title')
                                                                ->label('Tiêu đề SEO (Meta Title)')
                                                                ->maxLength(255)
                                                                ->live(onBlur: true),
                                                            Forms\Components\Textarea::make('meta_description')
                                                                ->label('Mô tả SEO (Meta Description)')
                                                                ->rows(3)
                                                                ->live(onBlur: true),
                                                        ]),

                                                        Forms\Components\Group::make()->schema([
                                                            Forms\Components\Placeholder::make('seo_score')
                                                                ->label('')
                                                                ->content(function (Forms\Get $get) {
                                                                    $data = [
                                                                        'meta_title' => $get('meta_title'),
                                                                        'meta_description' => $get('meta_description'),
                                                                        'thumbnail' => $get('thumbnail'),
                                                                        'focus_keyword' => $get('focus_keyword'),
                                                                        'title' => $get('title'),
                                                                        'slug' => $get('slug'),
                                                                        'content' => $get('content'),
                                                                    ];
                                                                    $result = \App\Services\SeoScoreCalculator::calculate($data);
                                                                    $hasKeyword = !empty(trim((string) $get('focus_keyword')));
                                                                    $hasTitle = !empty(trim((string) $get('title')));
                                                                    $hasInput = $hasKeyword && $hasTitle;
                                                                    return view('filament.forms.components.seo-checklist', [
                                                                        'result' => $result,
                                                                        'hasInput' => $hasInput,
                                                                    ]);
                                                                }),
                                                        ]),
                                                    ]),
                                            ]),
                                    ])
                                    ->columnSpan([
                                        'default' => 1,
                                        'lg' => 2,
                                    ]),

                                    // CỘT PHẢI SIDEBAR (~30%): CÀI ĐẶT & XUẤT BẢN (STICKY KHI CUỘN)
                                    Forms\Components\Group::make([
                                        // CARD 1: Xuất bản & Lịch đăng
                                        Forms\Components\Section::make('Xuất bản & Lịch đăng')
                                            ->icon('heroicon-o-paper-airplane')
                                            ->collapsible()
                                            ->schema([
                                                Forms\Components\Select::make('status')
                                                    ->label('Trạng thái')
                                                    ->options([
                                                        'draft' => 'Nháp (Draft)',
                                                        'published' => 'Đã xuất bản (Published)',
                                                        'hidden' => 'Tạm ẩn (Hidden)',
                                                    ])
                                                    ->default('draft')
                                                    ->live()
                                                    ->required(),

                                                Forms\Components\DateTimePicker::make('published_at')
                                                    ->label('Ngày đăng')
                                                    ->default(now()),

                                                Forms\Components\Actions::make([
                                                    Forms\Components\Actions\Action::make('preview')
                                                        ->label('Xem trước (Preview)')
                                                        ->icon('heroicon-o-eye')
                                                        ->color('gray')
                                                        ->url(fn ($record) => $record ? \Illuminate\Support\Facades\URL::signedRoute('post.preview', ['post' => $record->id]) : null)
                                                        ->openUrlInNewTab()
                                                        ->visible(fn ($record) => $record !== null),
                                                ])->fullWidth(),
                                            ]),

                                        // CARD 2: Phân loại & Ảnh đại diện (Thumbnail đầu card)
                                        Forms\Components\Section::make('Phân loại & Ảnh đại diện')
                                            ->icon('heroicon-o-photo')
                                            ->collapsible()
                                            ->schema([
                                                \App\Filament\Forms\Components\MediaPicker::make('thumbnail')
                                                    ->label('Ảnh đại diện (Thumbnail)')
                                                    ->live(onBlur: true),

                                                Forms\Components\Select::make('category_id')
                                                    ->label('Chuyên mục')
                                                    ->relationship('category', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->required(fn (Forms\Get $get) => $get('page_template') === 'standard')
                                                    ->visible(fn (Forms\Get $get) => $get('page_template') === 'standard'),

                                                Forms\Components\Select::make('author_id')
                                                    ->label('Tác giả bài viết')
                                                    ->relationship('author', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->default(fn () => auth()->id())
                                                    ->required(),

                                                Forms\Components\Select::make('article_type')
                                                    ->label('Định dạng bài viết')
                                                    ->options([
                                                        'standard' => 'Bài viết Tiêu chuẩn (Standard)',
                                                        'listicle' => 'Bài viết Tổng hợp (Listicle)',
                                                    ])
                                                    ->default('standard')
                                                    ->required(),
                                            ]),
                                    ])
                                    ->columnSpan([
                                        'default' => 1,
                                        'lg' => 1,
                                    ])
                                    ->extraAttributes([
                                        'class' => 'post-sidebar-sticky lg:sticky lg:top-20 self-start space-y-6',
                                        'style' => 'position: -webkit-sticky; position: sticky; top: 5rem; align-self: flex-start; z-index: 20;',
                                    ]),
                                ]),
                            ]),

                        // ==========================================
                        // TAB 2: CẤU HÌNH & SCHEMA (Cấu hình trang & Tùy biến Schema JSON-LD)
                        // ==========================================
                        Forms\Components\Tabs\Tab::make('Cấu hình & Schema')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->badge(fn (Forms\Get $get) => match ($get('page_template')) {
                                'pillar_page' => 'Pillar Page',
                                'landing_page' => 'Landing Page',
                                default => null,
                            })
                            ->badgeColor(fn (Forms\Get $get) => in_array($get('page_template'), ['pillar_page', 'landing_page']) ? 'warning' : 'gray')
                            ->schema([
                                Forms\Components\Grid::make([
                                    'default' => 1,
                                    'lg' => 12,
                                ])
                                ->extraAttributes([
                                    'class' => 'items-start gap-6',
                                ])
                                ->schema([
                                    // CỘT TRÁI (5 cols / 12 ~ 40%): Phân loại trang & Tùy chọn giao diện
                                    Forms\Components\Group::make([
                                        Forms\Components\Section::make('Phân loại & Thiết lập trang')
                                            ->icon('heroicon-o-document-duplicate')
                                            ->schema([
                                                Forms\Components\Radio::make('page_template')
                                                    ->label('Chọn loại trang')
                                                    ->options([
                                                        'standard' => 'Bài viết tiêu chuẩn',
                                                        'pillar_page' => 'Trang chuyên đề / Pillar Page',
                                                        'landing_page' => 'Trang đích chuyển đổi / Landing Page',
                                                    ])
                                                    ->descriptions([
                                                        'standard' => 'Bài viết tin tức, kiến thức biên tập tiêu chuẩn.',
                                                        'pillar_page' => 'Trang trụ cột chuyên đề với mục lục động, form tư vấn và cụm bài liên kết.',
                                                        'landing_page' => 'Trang đích tối ưu chuyển đổi cao (Lead Generation), lược bỏ menu phân tán.',
                                                    ])
                                                    ->default('standard')
                                                    ->formatStateUsing(function ($state, Forms\Get $get) {
                                                        if (!empty($state) && in_array($state, ['standard', 'pillar_page', 'landing_page'])) {
                                                            return $state;
                                                        }
                                                        return $get('is_page') ? 'pillar_page' : 'standard';
                                                    })
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                        $set('is_page', in_array($state, ['pillar_page', 'landing_page']));
                                                        if (in_array($state, ['pillar_page', 'landing_page'])) {
                                                            $set('category_id', null);
                                                        }
                                                        if ($state === 'landing_page') {
                                                            $set('show_toc', false);
                                                            $set('show_author_date', false);
                                                            $set('show_cta_form', true);
                                                            $set('schema_type', 'Service');
                                                        } elseif ($state === 'pillar_page') {
                                                            $set('show_toc', true);
                                                            $set('show_author_date', true);
                                                            $set('show_cta_form', true);
                                                            $set('schema_type', 'Article');
                                                        }
                                                    }),

                                                Forms\Components\Hidden::make('is_page')
                                                    ->default(false)
                                                    ->dehydrateStateUsing(fn ($state, Forms\Get $get) => in_array($get('page_template'), ['pillar_page', 'landing_page'])),

                                                Forms\Components\Section::make('Tùy chọn hiển thị giao diện')
                                                    ->compact()
                                                    ->visible(fn (Forms\Get $get) => in_array($get('page_template'), ['pillar_page', 'landing_page']))
                                                    ->schema([
                                                        Forms\Components\Toggle::make('show_cta_form')
                                                            ->label(fn (Forms\Get $get) => $get('page_template') === 'landing_page' ? 'Hiển thị Form đăng ký tư vấn & báo giá' : 'Hiển thị Form tư vấn')
                                                            ->default(true),

                                                        Forms\Components\Toggle::make('show_toc')
                                                            ->label('Hiển thị mục lục nhanh')
                                                            ->default(true),

                                                        Forms\Components\Toggle::make('show_author_date')
                                                            ->label('Hiển thị tác giả & ngày cập nhật')
                                                            ->default(true),
                                                    ]),
                                            ]),
                                    ])
                                    ->columnSpan(['default' => 12, 'lg' => 5])
                                    ->extraAttributes([
                                        'class' => 'lg:sticky lg:top-20 self-start space-y-6',
                                        'style' => 'position: -webkit-sticky; position: sticky; top: 5rem; align-self: flex-start; z-index: 10;',
                                    ]),

                                    // CỘT PHẢI (7 cols / 12 ~ 60% RỘNG RÃI): Cấu trúc Schema.org & Bộ soạn thảo JSON-LD
                                    Forms\Components\Group::make([
                                        Forms\Components\Section::make('Cấu hình Schema.org (Dữ liệu có cấu trúc SEO)')
                                            ->icon('heroicon-o-code-bracket-square')
                                            ->schema([
                                                Forms\Components\Placeholder::make('standard_note')
                                                    ->label('')
                                                    ->visible(fn (Forms\Get $get) => !in_array($get('page_template'), ['pillar_page', 'landing_page']))
                                                    ->content(new \Illuminate\Support\HtmlString("
                                                        <div class='flex items-start gap-3 p-4 rounded-2xl bg-sky-50 dark:bg-sky-950/40 border border-sky-200 dark:border-sky-800/60 text-sky-900 dark:text-sky-200 text-sm'>
                                                            <svg class='w-5 h-5 text-sky-600 dark:text-sky-400 mt-0.5 shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'/></svg>
                                                            <div class='leading-relaxed'>
                                                                <strong>Bài viết tiêu chuẩn:</strong> Hệ thống tự động thiết lập và liên kết <strong>Article Schema + BreadcrumbList + Author Person</strong> chuẩn SEO Google. Nếu bạn muốn cấu hình trang chuyên đề độc lập (Pillar Page) hoặc trang đích kèm tùy biến Schema JSON-LD riêng, hãy chọn <em>Trang chuyên đề / Pillar Page</em> hoặc <em>Trang đích chuyển đổi</em> ở cột bên trái.
                                                            </div>
                                                        </div>
                                                    ")),

                                                Forms\Components\Group::make([
                                                    // Chế độ cấu hình Schema
                                                    Forms\Components\Radio::make('schema_data.schema_mode')
                                                        ->label('Chế độ cấu hình Schema.org')
                                                        ->options([
                                                            'preset' => 'Sử dụng Schema mẫu tập trung (Service / WebPage / Article)',
                                                            'custom' => 'Tùy chỉnh tự do mã Schema JSON-LD riêng cho trang này (Nâng cao)',
                                                        ])
                                                        ->default('preset')
                                                        ->live()
                                                        ->afterStateHydrated(function ($component, $state, $record) {
                                                            if ($record && !empty($record->schema_data['custom_jsonld']) && empty($state)) {
                                                                $component->state('custom');
                                                            }
                                                        }),

                                                    // Nhóm 1: Schema mẫu tập trung (Preset)
                                                    Forms\Components\Group::make([
                                                        Forms\Components\Select::make('schema_type')
                                                            ->label('Loại cấu trúc Schema.org')
                                                            ->options([
                                                                'Service' => 'Service (Trang dịch vụ thực tế của doanh nghiệp)',
                                                                'WebPage' => 'WebPage (Trang thông tin/chuyên đề độc lập)',
                                                                'Article' => 'Article (Biên tập bài viết/chuyên đề)',
                                                            ])
                                                            ->default(fn (Forms\Get $get) => $get('page_template') === 'landing_page' ? 'Service' : 'Article')
                                                            ->required(fn (Forms\Get $get) => in_array($get('page_template'), ['pillar_page', 'landing_page']) && ($get('schema_data.schema_mode') ?? 'preset') === 'preset')
                                                            ->in(['Article', 'WebPage', 'Service'])
                                                            ->live()
                                                            ->helperText("• Service: Trang dịch vụ thực tế của doanh nghiệp.\n• WebPage: Trang thông tin/chuyên đề độc lập.\n• Article: Bài viết/chuyên đề biên tập."),

                                                        Forms\Components\Placeholder::make('template_info')
                                                            ->label('')
                                                            ->content(function (Forms\Get $get) {
                                                                $schemaType = $get('schema_type') ?: ($get('page_template') === 'landing_page' ? 'Service' : 'Article');
                                                                $schemaNote = match ($schemaType) {
                                                                    'Service' => 'Mẫu <strong>Service Schema</strong> (Tên dịch vụ, phân loại, giá, khu vực, điều khoản) sẽ được tự động nạp từ trang <em>Cấu hình Schema (SEO)</em>.',
                                                                    'WebPage' => 'Mẫu <strong>WebPage Schema</strong> sẽ được tự động nạp từ trang <em>Cấu hình Schema (SEO)</em>.',
                                                                    default => 'Mẫu <strong>Article Schema</strong> (Loại bài viết, danh mục thực thể about, từ khóa) sẽ được tự động nạp từ trang <em>Cấu hình Schema (SEO)</em>.',
                                                                };

                                                                if ($get('page_template') === 'landing_page') {
                                                                    return new \Illuminate\Support\HtmlString("
                                                                        <div class='flex flex-col gap-2 p-3 rounded-xl bg-orange-50/60 dark:bg-orange-950/40 border border-orange-200/60 dark:border-orange-800/50 text-xs text-orange-900 dark:text-orange-200'>
                                                                            <div class='flex items-start gap-2'>
                                                                                <svg class='w-4 h-4 text-orange-600 dark:text-orange-400 mt-0.5 shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 10V3L4 14h7v7l9-11h-7z'/></svg>
                                                                                <span class='leading-relaxed'><strong>Trang đích chuyển đổi (Landing Page):</strong> Giao diện tối ưu CRO (Lead Generation), lược bỏ menu phân tán, tập trung Hero và Form tư vấn.</span>
                                                                            </div>
                                                                            <div class='pt-2 border-t border-orange-200/50 dark:border-orange-800/40 text-[11px] text-orange-800 dark:text-orange-300'>
                                                                                💡 {$schemaNote}
                                                                            </div>
                                                                        </div>
                                                                    ");
                                                                }
                                                                return new \Illuminate\Support\HtmlString("
                                                                    <div class='flex flex-col gap-2 p-3 rounded-xl bg-primary-50/60 dark:bg-primary-950/40 border border-primary-200/60 dark:border-primary-800/50 text-xs text-primary-900 dark:text-primary-200'>
                                                                        <div class='flex items-start gap-2'>
                                                                            <svg class='w-4 h-4 text-primary-600 dark:text-primary-400 mt-0.5 shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'/></svg>
                                                                            <span class='leading-relaxed'><strong>Cụm bài viết vệ tinh (Topic Cluster):</strong> Các bài viết liên quan sẽ được hệ thống tự động lựa chọn dựa trên chuyên đề và từ khóa.</span>
                                                                        </div>
                                                                        <div class='pt-2 border-t border-primary-200/50 dark:border-primary-800/40 text-[11px] text-primary-800 dark:text-primary-300'>
                                                                            💡 {$schemaNote}
                                                                        </div>
                                                                    </div>
                                                                ");
                                                            }),
                                                    ])->visible(fn (Forms\Get $get) => ($get('schema_data.schema_mode') ?? 'preset') === 'preset'),

                                                    // Nhóm 2: Tùy chỉnh tự do mã Schema JSON-LD (Nâng cao)
                                                    Forms\Components\Group::make([
                                                        Forms\Components\Radio::make('schema_data.custom_mode')
                                                            ->label('Hình thức áp dụng Schema')
                                                            ->options([
                                                                'merge' => 'Ghép vào Graph chung (Khuyên dùng)',
                                                                'override' => 'Ghi đè toàn bộ @graph',
                                                            ])
                                                            ->descriptions([
                                                                'merge' => 'Giữ Organization, WebSite, Breadcrumbs & chèn thêm Schema này vào @graph.',
                                                                'override' => 'Xuất hoàn toàn theo mã JSON-LD này, ghi đè toàn bộ Schema mặc định.',
                                                            ])
                                                            ->default('merge')
                                                            ->live(),

                                                        \App\Filament\Forms\Components\SchemaCodeEditor::make('schema_data.custom_jsonld')
                                                            ->hiddenLabel(),
                                                    ])->visible(fn (Forms\Get $get) => ($get('schema_data.schema_mode') ?? 'preset') === 'custom'),
                                                ])->visible(fn (Forms\Get $get) => in_array($get('page_template'), ['pillar_page', 'landing_page'])),
                                            ]),
                                    ])->columnSpan(['default' => 12, 'lg' => 7]),
                                ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->disk('public')
                    ->square()
                    ->extraImgAttributes(['class' => 'object-cover']),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Chuyên mục')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('seo_score')
                    ->label('Điểm SEO')
                    ->badge()
                    ->color(fn ($state) => $state >= 70 ? 'success' : ($state >= 40 ? 'warning' : 'danger'))
                    ->formatStateUsing(fn ($state) => $state . '/100')
                    ->tooltip(function ($record) {
                        $breakdown = $record->seo_breakdown;
                        $lines = [];
                        foreach ($breakdown as $item) {
                            $icon = $item['status'] ? '✅' : '❌';
                            $lines[] = $icon . ' ' . $item['label'];
                        }
                        return implode("\n", $lines);
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái Xuất bản')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Nháp',
                        'published' => 'Đã xuất bản',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('views')
                    ->label('Lượt xem')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Ngày đăng')
                    ->dateTime('d/m/Y')
                    ->sortable(query: fn (\Illuminate\Database\Eloquent\Builder $query, string $direction) => $query->orderByRaw('COALESCE(published_at, updated_at) ' . $direction)),
            ])
            ->defaultSort('published_at', 'desc')
            ->emptyStateHeading('Chưa có bài viết nào')
            ->emptyStateDescription('Tạo bài viết đầu tiên để xuất bản tin tức và nội dung mới lên website.')
            ->emptyStateIcon('heroicon-o-document-text')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Chuyên mục')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái Xuất bản')
                    ->options([
                        'draft' => 'Bản nháp',
                        'published' => 'Đã xuất bản',
                        'hidden' => 'Đã ẩn',
                    ]),
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('published_from')->label('Từ ngày'),
                        \Filament\Forms\Components\DatePicker::make('published_until')->label('Đến ngày'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
                Tables\Filters\Filter::make('views')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('views_from')->label('Lượt xem từ')->numeric(),
                        \Filament\Forms\Components\TextInput::make('views_until')->label('Lượt xem đến')->numeric(),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when(
                                $data['views_from'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $views): \Illuminate\Database\Eloquent\Builder => $query->where('views', '>=', $views),
                            )
                            ->when(
                                $data['views_until'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $views): \Illuminate\Database\Eloquent\Builder => $query->where('views', '<=', $views),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('addToMenu')
                    ->label('Gắn vào Menu')
                    ->icon('heroicon-o-bars-3')
                    ->color('info')
                    ->visible(fn () => auth()->user()?->can('create_menu::item') ?? false)
                    ->modalHeading(fn (Post $record) => 'Gắn bài viết "' . $record->title . '" vào Menu Website')
                    ->modalDescription('Tạo liên kết nhanh dẫn đến bài viết này trên thanh Menu của website.')
                    ->modalSubmitActionLabel('Xác nhận gắn vào Menu')
                    ->form([
                        Forms\Components\Select::make('menu_id')
                            ->label('Chọn Menu')
                            ->options(\App\Models\Menu::pluck('name', 'id'))
                            ->required()
                            ->live(),

                        Forms\Components\Select::make('parent_id')
                            ->label('Chọn Menu cha (Tùy chọn)')
                            ->options(function (Forms\Get $get) {
                                $menuId = $get('menu_id');
                                if (!$menuId) {
                                    return [];
                                }
                                return \App\Models\MenuItem::where('menu_id', $menuId)
                                    ->whereNull('parent_id')
                                    ->pluck('title', 'id');
                            })
                            ->placeholder('Là mục Menu chính (Gốc)'),

                        Forms\Components\TextInput::make('title')
                            ->label('Tên hiển thị trên Menu')
                            ->default(fn (Post $record) => $record->title)
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('url')
                            ->label('Đường dẫn URL')
                            ->default(fn (Post $record) => '/' . ltrim($record->slug, '/'))
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Đường dẫn cố định chuẩn theo bài viết: /{slug}'),

                        Forms\Components\TextInput::make('order')
                            ->label('Thứ tự sắp xếp')
                            ->numeric()
                            ->default(1),
                    ])
                    ->action(function (Post $record, array $data): void {
                        $targetUrl = '/' . ltrim($record->slug, '/');

                        // 1. Kiểm tra URL đã tồn tại trong bất kỳ menu nào chưa
                        $existing = \App\Models\MenuItem::where('url', $targetUrl)
                            ->orWhere('url', url($targetUrl))
                            ->orWhere('url', ltrim($targetUrl, '/'))
                            ->with('menu')
                            ->first();

                        if ($existing) {
                            \Filament\Notifications\Notification::make()
                                ->warning()
                                ->title('URL này đã tồn tại trong Menu Website!')
                                ->body("Đường dẫn \"{$targetUrl}\" đã được gắn tại mục \"{$existing->title}\" thuộc Menu \"{$existing->menu?->name}\". Vui lòng không tạo liên kết trùng lặp.")
                                ->persistent()
                                ->send();
                            return;
                        }

                        // 2. Tạo MenuItem mới
                        \Illuminate\Support\Facades\DB::transaction(function () use ($data, $targetUrl) {
                            \App\Models\MenuItem::create([
                                'menu_id' => $data['menu_id'],
                                'parent_id' => !empty($data['parent_id']) ? $data['parent_id'] : null,
                                'title' => trim($data['title']),
                                'url' => $targetUrl,
                                'target' => '_self',
                                'order' => $data['order'] ?? 1,
                            ]);

                            // 3. Xóa cache Menu theo cơ chế hiện tại của Model MenuItem
                            \App\Models\MenuItem::clearMenuCache();
                        });

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Gắn vào Menu Website thành công!')
                            ->body("Đã tạo liên kết \"{$targetUrl}\" trên Menu.")
                            ->send();
                    }),
                Tables\Actions\EditAction::make()->label('Chỉnh sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa bài viết này?')
                    ->modalDescription('Bài viết này sẽ bị xóa khỏi hệ thống. Thao tác này không thể hoàn tác.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các bài viết đã chọn?')
                        ->modalDescription('Tất cả bài viết được chọn sẽ bị xóa vĩnh viễn khỏi hệ thống.')
                        ->modalSubmitActionLabel('Xác nhận xóa hàng loạt')
                        ->modalCancelActionLabel('Hủy bỏ'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}