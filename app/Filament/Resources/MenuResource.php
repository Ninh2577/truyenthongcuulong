<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    
    protected static ?string $navigationGroup = 'Giao Diện';
    
    protected static ?string $navigationLabel = 'Vị trí Menu';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Tên Menu (Ví dụ: Menu Chính)'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Vị trí (Ví dụ: header, footer)'),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Kích hoạt'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->label('Tên Menu'),
                Tables\Columns\TextColumn::make('location')->searchable()->label('Vị trí'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Trạng thái'),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMenus::route('/'),
        ];
    }
}
