<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Kinh Doanh';
    protected static ?string $modelLabel = 'Dịch vụ';
    protected static ?string $pluralModelLabel = 'Dịch vụ';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Tên dịch vụ')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('group')
                    ->label('Trụ cột')
                    ->options(\App\Enums\PillarGroup::class)
                    ->required(),
                Forms\Components\TextInput::make('icon')
                    ->label('Icon (video, megaphone, code, cpu...)'),
                Forms\Components\Toggle::make('featured')
                    ->label('Nổi bật ở trang chủ')
                    ->default(true),
                Forms\Components\Textarea::make('summary')
                    ->label('Tóm tắt ngắn')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('Nội dung gói dịch vụ')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Tên dịch vụ')->searchable(),
                Tables\Columns\TextColumn::make('group')
                    ->label('Trụ cột')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => \App\Enums\PillarGroup::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn (string $state): string => \App\Enums\PillarGroup::tryFrom($state)?->getColor() ?? 'gray'),
                Tables\Columns\IconColumn::make('featured')->label('Nổi bật')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày tạo')->date('d/m/Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}