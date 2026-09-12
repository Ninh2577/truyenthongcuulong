<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Resources\ContactResource;

class NewContactsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'Liên hệ mới cần xử lý';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Contact::query()->where('status', 'new')->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('fullname')->label('Khách hàng'),
                Tables\Columns\TextColumn::make('phone')->label('Số điện thoại'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Thời gian')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Xem')
                    ->url(fn (Contact $record): string => ContactResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('view_all')
                    ->label('Xem tất cả (Lọc "New")')
                    ->url(ContactResource::getUrl('index') . '?tableFilters[status][value]=new')
                    ->button(),
            ]);
    }
}
