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
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationGroup = 'Cấu Hình SEO';
    protected static ?string $modelLabel = 'Chuyển hướng 301';
    protected static ?string $pluralModelLabel = 'Chuyển hướng 301';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'old_url';

    public static function getGloballySearchableAttributes(): array
    {
        return ['old_url', 'new_url'];
    }

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
                Tables\Columns\TextColumn::make('old_url')
                    ->label('URL cũ (WordPress)')
                    ->searchable()
                    ->limit(50)
                    ->color(fn (Redirect $record) => Redirect::where('old_url', $record->old_url)->count() > 1 ? 'danger' : null)
                    ->icon(fn (Redirect $record) => Redirect::where('old_url', $record->old_url)->count() > 1 ? 'heroicon-o-exclamation-triangle' : null)
                    ->tooltip(function (Redirect $record) {
                        $isDuplicate = Redirect::where('old_url', $record->old_url)->count() > 1;
                        if ($isDuplicate) {
                            return "⚠️ CẢNH BÁO TRÙNG LẶP: Có nhiều hơn 1 record dùng old_url này.\n\n" . $record->old_url;
                        }
                        return strlen($record->old_url) > 50 ? $record->old_url : null;
                    }),
                Tables\Columns\TextColumn::make('new_url')
                    ->label('URL mới (Laravel)')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn (?string $state): ?string => $state && strlen($state) > 50 ? $state : null),
                Tables\Columns\TextColumn::make('status_code')
                    ->label('Mã HTTP')
                    ->badge()
                    ->color(fn ($state): string => (string)$state === '301' ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('hits')
                    ->label('Số lượt click')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\Action::make('test')
                    ->label('Test')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('info')
                    ->url(fn (Redirect $record): string => str_starts_with($record->new_url, 'http') ? $record->new_url : url($record->new_url))
                    ->openUrlInNewTab(),
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