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
    protected static ?string $navigationGroup = 'Nội Dung';
    protected static ?string $modelLabel = 'Bài viết';
    protected static ?string $pluralModelLabel = 'Bài viết';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Nội dung chính')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Tiêu đề')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Đường dẫn tĩnh (Slug)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->live(onBlur: true),
                                Forms\Components\Textarea::make('summary')
                                    ->label('Tóm tắt ngắn (Excerpt)')
                                    ->rows(3),
                                \AmidEsfahani\FilamentTinyEditor\TinyEditor::make('content')
                                    ->label('Nội dung chi tiết')
                                    ->columnSpanFull()
                                    ->profile('default')
                                    ->toolbarMode('wrap')
                                    ->language('vi'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Cài đặt & Tối ưu')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Group::make()->schema([
                                            Forms\Components\Section::make('Xuất bản')
                                                ->schema([
                                                    Forms\Components\Select::make('status')
                                                        ->label('Trạng thái')
                                                        ->options([
                                                            'draft' => 'Nháp (Draft)',
                                                            'published' => 'Đã xuất bản (Published)',
                                                        ])
                                                        ->default('draft')
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

                                            Forms\Components\Section::make('Phân loại & Hình ảnh')
                                                ->schema([
                                                    Forms\Components\Select::make('category_id')
                                                        ->label('Chuyên mục')
                                                        ->relationship('category', 'name')
                                                        ->searchable()
                                                        ->preload(),
                                                    Forms\Components\Select::make('article_type')
                                                        ->label('Định dạng bài viết')
                                                        ->options([
                                                            'standard' => 'Bài viết Tiêu chuẩn (Standard)',
                                                            'listicle' => 'Bài viết Tổng hợp (Listicle)',
                                                        ])
                                                        ->default('standard')
                                                        ->required(),
                                                    \App\Filament\Forms\Components\MediaPicker::make('thumbnail')
                                                        ->label('Ảnh đại diện (Thumbnail)')
                                                        ->live(onBlur: true),
                                                ]),
                                        ])->columnSpan(1),

                                        Forms\Components\Group::make()->schema([
                                            Forms\Components\Section::make('Tối ưu SEO (Meta Tags)')
                                                ->schema([
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
                                                        ->rows(2)
                                                        ->live(onBlur: true),
                                                ]),

                                            Forms\Components\Section::make('Phân tích SEO')
                                                ->schema([
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
                                        ])->columnSpan(1),
                                    ]),
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
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Chuyên mục')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái Xuất bản')
                    ->options([
                        'draft' => 'Bản nháp',
                        'published' => 'Đã xuất bản',
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation(),
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