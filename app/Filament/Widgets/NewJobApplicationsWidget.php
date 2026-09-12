<?php

namespace App\Filament\Widgets;

use App\Models\JobApplication;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class NewJobApplicationsWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'Hồ sơ ứng tuyển mới nhất';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                JobApplication::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('fullname')->label('Ứng viên'),
                Tables\Columns\TextColumn::make('position')->label('Vị trí ứng tuyển'),
                Tables\Columns\TextColumn::make('phone')->label('Số điện thoại'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'reviewed' => 'info',
                        'rejected' => 'danger',
                        'hired' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Thời gian nộp')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->paginated(false);
    }
}
