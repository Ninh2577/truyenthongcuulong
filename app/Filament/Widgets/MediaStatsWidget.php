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
        
        $uiFiles = MediaFile::uiAssets()->count();
        $usedPostFiles = MediaFile::usedInContent()->count();
        $unusedFiles = MediaFile::unusedUploads()->count();
        
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
                ->description('Toàn bộ media & website (' . $totalSizeFormatted . ')')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl()),
            Stat::make('Giao diện & Mẫu website', number_format($uiFiles))
                ->icon('heroicon-o-paint-brush')
                ->color('info')
                ->description('Ảnh UI/UX, logo, dịch vụ & mẫu website')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl() . '?tableFilters[usage_status][value]=ui'),
            Stat::make('Dùng trong bài viết & dự án', number_format($usedPostFiles))
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->description('Ảnh bài viết & dự án đang sử dụng')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl() . '?tableFilters[usage_status][value]=posts'),
            Stat::make('Chưa liên kết nội dung', number_format($unusedFiles))
                ->icon('heroicon-o-arrow-up-tray')
                ->description("{$unusedPct}% uploads chờ liên kết bài viết")
                ->color('warning')
                ->url(\App\Filament\Pages\MediaLibrary::getUrl() . '?unused=1'),
        ];
    }
}
