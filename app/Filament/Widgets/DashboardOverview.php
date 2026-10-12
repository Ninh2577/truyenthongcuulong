<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Post;
use App\Models\Partner;
use App\Models\Client;
use App\Models\CaseStudy;

class DashboardOverview extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $publishedPosts = Post::where('status', 'published')->count();
        $caseStudies = CaseStudy::count();
        $visibleClients = Client::where('is_active', true)->count();
        $visiblePartners = Partner::where('is_active', true)->count();

        $postUrl = class_exists(\App\Filament\Resources\PostResource::class)
            ? \App\Filament\Resources\PostResource::getUrl('index')
            : null;

        $caseStudyUrl = class_exists(\App\Filament\Resources\CaseStudyResource::class)
            ? \App\Filament\Resources\CaseStudyResource::getUrl('index')
            : null;

        $clientUrl = class_exists(\App\Filament\Resources\ClientResource::class)
            ? \App\Filament\Resources\ClientResource::getUrl('index')
            : null;

        $partnerUrl = class_exists(\App\Filament\Resources\PartnerResource::class)
            ? \App\Filament\Resources\PartnerResource::getUrl('index')
            : null;

        $hoverClass = 'hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 cursor-pointer';

        return [
            Stat::make('Bài Viết Đã Đăng', number_format($publishedPosts))
                ->description('Tổng số bài viết đã xuất bản')
                ->icon('heroicon-o-document-text')
                ->color('primary')
                ->url($postUrl)
                ->extraAttributes(['class' => $hoverClass]),

            Stat::make('Dự Án Tiêu Biểu', number_format($caseStudies))
                ->description('Hồ sơ năng lực Case Study')
                ->icon('heroicon-o-briefcase')
                ->color('info')
                ->url($caseStudyUrl)
                ->extraAttributes(['class' => $hoverClass]),

            Stat::make('Khách Hàng Tin Cậy', number_format($visibleClients))
                ->description('Logo đối tác đang hiển thị')
                ->icon('heroicon-o-building-office')
                ->color('success')
                ->url($clientUrl)
                ->extraAttributes(['class' => $hoverClass]),

            Stat::make('Đối Tác Chiến Lược', number_format($visiblePartners))
                ->description('Mạng lưới liên kết Cửu Long')
                ->icon('heroicon-o-user-group')
                ->color('warning')
                ->url($partnerUrl)
                ->extraAttributes(['class' => $hoverClass]),
        ];
    }
}
