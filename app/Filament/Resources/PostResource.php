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
                Forms\Components\Grid::make([
                    'default' => 1,
                    'lg' => 3,
                ])
                ->columnSpanFull()
                ->extraAttributes([
                    'class' => 'items-start',
                ])
                ->schema([
                    // ==========================================
                    // CỘT TRÁI (~70%): NỘI DUNG & SEO
                    // ==========================================
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
                                                    return view('filament.forms.components.seo-checklist', ['result' => $result]);
                                                }),
                                        ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpan([
                        'default' => 1,
                        'lg' => 2,
                    ]),

                    // ==========================================
                    // CỘT PHẢI SIDEBAR (~30%): CÀI ĐẶT & XUẤT BẢN (STICKY KHI CUỘN)
                    // ==========================================
                    Forms\Components\Group::make([
                        // 1. Xuất bản & Hẹn giờ
                        Forms\Components\Section::make('Xuất bản & Lịch đăng')
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

                        // 2. Chuyên mục & Phân loại
                        Forms\Components\Section::make('Chuyên mục & Tác giả')
                            ->collapsible()
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('Chuyên mục')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

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

                        // 3. Ảnh đại diện (Thumbnail)
                        Forms\Components\Section::make('Ảnh đại diện (Thumbnail)')
                            ->collapsible()
                            ->schema([
                                \App\Filament\Forms\Components\MediaPicker::make('thumbnail')
                                    ->label('')
                                    ->live(onBlur: true),
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