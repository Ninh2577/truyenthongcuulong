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
                Forms\Components\Section::make('Thông tin bài viết')
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
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->label('Chuyên mục')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Ảnh đại diện (Thumbnail)')
                            ->image()
                            ->directory('uploads/thumbnails')
                            ->disk('public'),
                        Forms\Components\Textarea::make('summary')
                            ->label('Tóm tắt ngắn (Excerpt)')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Nội dung chi tiết')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Trạng thái & Biên tập')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái hiển thị (Hệ thống)')
                            ->options([
                                'draft' => 'Bản nháp (Draft)',
                                'published' => 'Đã xuất bản (Published)',
                            ])
                            ->default('draft')
                            ->disabled(fn () => !auth()->user()->hasAnyRole(['Admin', 'Biên Tập Viên']))
                            ->dehydrated()
                            ->required(),
                        Forms\Components\Select::make('editorial_status')
                            ->label('Đánh giá nội dung (Biên tập viên)')
                            ->options([
                                'draft' => 'Nháp',
                                'pending' => 'Chờ duyệt',
                                'keep' => 'Đã xuất bản',
                                'archived' => 'Đã lưu trữ',
                            ])
                            ->default('draft')
                            ->disabled(fn () => !auth()->user()->hasAnyRole(['Admin', 'Biên Tập Viên']))
                            ->dehydrated()
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Ngày đăng')
                            ->default(now()),
                    ])->columns(3),

                Forms\Components\Section::make('Tối ưu SEO (Meta Tags)')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Tiêu đề SEO (Meta Title)')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Mô tả SEO (Meta Description)')
                            ->rows(2),
                    ])->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->disk('public')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Chuyên mục')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái hiển thị')
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
                Tables\Columns\TextColumn::make('editorial_status')
                    ->label('Đánh giá Nội dung')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Nháp',
                        'pending' => 'Chờ duyệt',
                        'keep' => 'Đã xuất bản',
                        'archived' => 'Đã lưu trữ',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'pending' => 'warning',
                        'keep' => 'success',
                        'archived' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('views')
                    ->label('Lượt xem')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Ngày đăng')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Chuyên mục')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái hiển thị')
                    ->options([
                        'draft' => 'Bản nháp',
                        'published' => 'Đã xuất bản',
                    ]),
                Tables\Filters\SelectFilter::make('editorial_status')
                    ->label('Trạng thái Biên tập')
                    ->options([
                        'draft' => 'Nháp',
                        'pending' => 'Chờ duyệt',
                        'keep' => 'Đã xuất bản',
                        'archived' => 'Đã lưu trữ',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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