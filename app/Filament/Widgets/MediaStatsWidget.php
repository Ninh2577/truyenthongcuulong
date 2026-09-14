<?php

namespace App\Filament\Widgets;

use App\Models\MediaFile;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MediaStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalFiles = MediaFile::count();
        $totalBytes = MediaFile::sum('size');
        $unusedFiles = MediaFile::where('usage_count', 0)->count();
        
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        if ($totalBytes == 0) {
            $totalSizeFormatted = '0 B';
        } else {
            $i = floor(log($totalBytes, 1024));
            $totalSizeFormatted = @round($totalBytes / pow(1024, $i), 2) . ' ' . $units[$i];
        }

        return [
            Stat::make('Tổng số ảnh', number_format($totalFiles))
                ->icon('heroicon-o-photo')
                ->color('primary'),
            Stat::make('Tổng dung lượng', $totalSizeFormatted)
                ->icon('heroicon-o-server')
                ->color('success'),
            Stat::make('Ảnh chưa sử dụng', number_format($unusedFiles))
                ->icon('heroicon-o-trash')
                ->description('Có thể xóa để dọn dẹp')
                ->color('warning'),
        ];
    }
}
