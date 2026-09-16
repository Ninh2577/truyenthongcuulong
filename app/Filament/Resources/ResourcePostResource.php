<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourcePostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResourcePostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $slug = 'tai-nguyen';
    protected static ?string $navigationIcon = 'heroicon-o-cloud-arrow-down';
    protected static ?string $navigationGroup = 'Nội Dung';
    protected static ?string $modelLabel = 'Tài nguyên';
    protected static ?string $pluralModelLabel = 'Tài nguyên';
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->inPillar('resource');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Thông tin Tài nguyên')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Tên tài nguyên / Tiêu đề')
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
                                ->label('Mô tả ngắn (Hiển thị ở trang danh sách)')
                                ->rows(3),
                        ]),

                    Forms\Components\Section::make('Trang chi tiết & Nút tải về')
                        ->schema([
                            \AmidEsfahani\FilamentTinyEditor\TinyEditor::make('content')
                                ->label('Nội dung hướng dẫn & Liên kết tải (Google Drive, v.v...)')
                                ->columnSpanFull()
                                ->profile('default')
                                ->toolbarMode('wrap')
                                ->language('vi'),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Xuất bản & Phân loại')
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->label('Trạng thái')
                                ->options([
                                    'draft' => 'Nháp (Draft)',
                                    'published' => 'Đã xuất bản (Published)',
                                ])
                                ->default('published')
                                ->required(),
                            
                            Forms\Components\Select::make('category_id')
                                ->label('Chuyên mục (Nhóm tài nguyên)')
                                ->relationship('category', 'name', fn ($query) => $query->where('pillar_group', 'resource'))
                                ->searchable()
                                ->preload()
                                ->required(),
                        ]),
                        
                    Forms\Components\Section::make('Hình ảnh')
                        ->schema([
                            \App\Filament\Forms\Components\MediaPicker::make('thumbnail')
                                ->label('Ảnh bìa (Thumbnail)'),
                        ]),
                ])->columnSpan(['lg' => 1]),
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
                    ->label('Tên Tài nguyên')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Chuyên mục')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
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
                    ->label('Lượt tải/xem')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y')
                    ->sortable(),
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
            'index' => Pages\ListResourcePosts::route('/'),
            'create' => Pages\CreateResourcePost::route('/create'),
            'edit' => Pages\EditResourcePost::route('/{record}/edit'),
        ];
    }
}
