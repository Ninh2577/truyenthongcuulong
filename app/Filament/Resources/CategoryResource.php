<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'NỘI DUNG & TIN TỨC';
    protected static ?string $modelLabel = 'Chuyên mục';
    protected static ?string $pluralModelLabel = 'Chuyên mục';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin Chuyên mục')
                    ->description('Cấu hình tên, đường dẫn tĩnh và phân nhóm chuyên mục dịch vụ')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên chuyên mục')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                        Forms\Components\TextInput::make('slug')
                            ->label('Đường dẫn tĩnh (Slug)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('type')
                            ->label('Nhóm dịch vụ chính')
                            ->options(\App\Enums\PillarGroup::class)
                            ->default(\App\Enums\PillarGroup::General)
                            ->required(),
                        Forms\Components\Select::make('parent_id')
                            ->label('Chuyên mục cha')
                            ->relationship('parent', 'name', modifyQueryUsing: fn (Builder $query, ?\Illuminate\Database\Eloquent\Model $record) => $record ? $query->where('id', '!=', $record->id) : $query)
                            ->placeholder('— Là chuyên mục gốc —'),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả chuyên mục')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên chuyên mục')
                    ->searchable()
                    ->sortable()
                    ->weight('font-semibold'),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Phân nhóm')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => \App\Enums\PillarGroup::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn (string $state): string => \App\Enums\PillarGroup::tryFrom($state)?->getColor() ?? 'gray'),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Chuyên mục cha')
                    ->sortable()
                    ->placeholder('— Gốc —'),
                Tables\Columns\TextColumn::make('posts_count')
                    ->label('Số bài viết')
                    ->counts('posts')
                    ->sortable()
                    ->badge()
                    ->color('gray'),
            ])
            ->emptyStateHeading('Chưa có chuyên mục nào')
            ->emptyStateDescription('Tạo chuyên mục đầu tiên để tổ chức và phân loại các bài viết, dịch vụ.')
            ->emptyStateIcon('heroicon-o-folder')
            ->actions([
                Tables\Actions\EditAction::make()->label('Chỉnh sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa chuyên mục này?')
                    ->modalDescription('Chuyên mục sẽ bị xóa khỏi hệ thống. Vui lòng đảm bảo các bài viết thuộc chuyên mục này đã được di chuyển.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các chuyên mục đã chọn?')
                        ->modalDescription('Tất cả chuyên mục được chọn sẽ bị xóa khỏi hệ thống.')
                        ->modalSubmitActionLabel('Xác nhận xóa hàng loạt')
                        ->modalCancelActionLabel('Hủy bỏ'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}