<?php

namespace App\Filament\Widgets;

use App\Models\MediaFile;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MediaStatsWidget extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalFiles = MediaFile::count();
        $totalBytes = MediaFile::sum('size');
        
        $uiFiles = MediaFile::where('path', 'like', 'images/%')->count();
        $usedPostFiles = MediaFile::where('path', 'not like', 'images/%')->where('usage_count', '>', 0)->count();
        $unusedFiles = MediaFile::where('path', 'not like', 'images/%')->where('usage_count', 0)->count();
        
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        if ($totalBytes == 0) {
            $totalSizeFormatted = '0 B';
        } else {
            $i = floor(log($totalBytes, 1024));
            $totalSizeFormatted = @round($totalBytes / pow(1024, $i), 2) . ' ' . $units[$i];
        }

        $unusedPct = $totalFiles > 0 ? round(($unusedFiles / $totalFiles) * 100, 1) : 0;

        return [
            Stat::make('Tổng số ảnh', number_format($totalFiles))
                ->icon('heroicon-o-photo')
                ->color('primary')
                ->description('Toàn bộ media & giao diện (' . $totalSizeFormatted . ')')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl()),
            Stat::make('Tài nguyên giao diện', number_format($uiFiles))
                ->icon('heroicon-o-paint-brush')
                ->color('info')
                ->description('Ảnh UI/UX, dịch vụ, logo, icons')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl() . '?tableFilters[folder][value]=images'),
            Stat::make('Dùng trong bài viết', number_format($usedPostFiles))
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->description('Ảnh bài viết & dự án đang dùng')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl() . '?tableFilters[usage_status][value]=posts'),
            Stat::make('Chưa dùng trong bài viết', number_format($unusedFiles))
                ->icon('heroicon-o-trash')
                ->description("{$unusedPct}% uploads thừa — Có thể dọn dẹp")
                ->color('warning')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl() . '?unused=1'),
        ];
    }
}
