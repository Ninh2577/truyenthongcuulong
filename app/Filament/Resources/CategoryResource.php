<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Nội Dung';
    protected static ?string $modelLabel = 'Chuyên mục';
    protected static ?string $pluralModelLabel = 'Chuyên mục';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên chuyên mục')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
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
                    ->relationship('parent', 'name'),
                Forms\Components\Textarea::make('description')
                    ->label('Mô tả')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên chuyên mục')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Phân nhóm')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => \App\Enums\PillarGroup::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn (string $state): string => \App\Enums\PillarGroup::tryFrom($state)?->getColor() ?? 'gray'),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Chuyên mục cha')
                    ->sortable(),
                Tables\Columns\TextColumn::make('posts_count')
                    ->label('Số bài viết')
                    ->counts('posts')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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