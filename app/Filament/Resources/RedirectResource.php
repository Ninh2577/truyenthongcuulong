<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedirectResource\Pages;
use App\Models\Redirect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?string $navigationGroup = 'Cấu Hình SEO';
    protected static ?string $modelLabel = 'Chuyển hướng 301';
    protected static ?string $pluralModelLabel = 'Chuyển hướng 301';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('old_url')->label('URL cũ')->required(),
                Forms\Components\TextInput::make('new_url')->label('URL đích')->required(),
                Forms\Components\TextInput::make('status_code')->label('Mã HTTP')->default(301)->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('old_url')->label('URL cũ (WordPress)')->searchable(),
                Tables\Columns\TextColumn::make('new_url')->label('URL mới (Laravel)')->searchable(),
                Tables\Columns\TextColumn::make('status_code')->label('Mã HTTP')->badge(),
                Tables\Columns\TextColumn::make('hits')->label('Số lượt click')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRedirects::route('/'),
            'create' => Pages\CreateRedirect::route('/create'),
            'edit' => Pages\EditRedirect::route('/{record}/edit'),
        ];
    }
}