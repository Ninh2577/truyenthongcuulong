<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Post;
use App\Models\Partner;
use App\Models\Client;
use App\Models\CaseStudy;
use App\Models\Contact;
use App\Models\JobApplication;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;

class DashboardOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    
    // We want the columns to be 4 to fit everything nicely
    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        // 1. Statistics
        $publishedPosts = Post::where('status', 'published')->count();
        $visiblePartners = Partner::where('is_active', true)->count();
        $visibleClients = Client::where('is_active', true)->count();
        $caseStudies = CaseStudy::count();

        // 2. New Contacts
        $newContacts = Contact::where('status', 'new')->count();
        
        // 3. New Job Applications
        $newJobApps = JobApplication::where('status', 'pending')->count();

        // Check if ContactResource is registered for linking
        $contactUrl = class_exists(\App\Filament\Resources\ContactResource::class) 
            ? \App\Filament\Resources\ContactResource::getUrl('index') 
            : null;

        $hoverClass = 'hover:-translate-y-1 hover:shadow-xl transition-all duration-300';
        
        return [
            Stat::make('Bài Viết Đã Xuất Bản', $publishedPosts)
                ->description('Tổng số bài viết đã đăng')
                ->icon('heroicon-o-document-text')
                ->color('warning')
                ->extraAttributes(['class' => $hoverClass . ' animate-fade-in-up stagger-1']),
                
            Stat::make('Đối Tác Đang Hiển Thị', $visiblePartners)
                ->description('Đối tác hiện tại')
                ->icon('heroicon-o-star')
                ->color('primary')
                ->extraAttributes(['class' => $hoverClass . ' animate-fade-in-up stagger-2']),
                
            Stat::make('Khách Hàng Đang Hiển Thị', $visibleClients)
                ->description('Khách hàng hiện tại')
                ->icon('heroicon-o-users')
                ->color('info')
                ->extraAttributes(['class' => $hoverClass . ' animate-fade-in-up stagger-3']),
                
            Stat::make('Dự Án (Case Study)', $caseStudies)
                ->description('Tổng số dự án')
                ->icon('heroicon-o-briefcase')
                ->color('danger')
                ->extraAttributes(['class' => $hoverClass . ' animate-fade-in-up stagger-4']),

            Stat::make('Liên Hệ Mới', $newContacts)
                ->description($newContacts > 0 ? 'Cần xử lý ngay' : 'Đã xử lý xong')
                ->color($newContacts > 0 ? 'danger' : 'success')
                ->url($contactUrl)
                ->icon('heroicon-o-inbox-arrow-down')
                ->extraAttributes(['class' => $hoverClass . ' animate-fade-in-up stagger-5']),

            Stat::make('Hồ Sơ Ứng Tuyển Mới', $newJobApps)
                ->description($newJobApps > 0 ? 'Ứng viên mới chờ duyệt' : 'Không có hồ sơ mới')
                ->color($newJobApps > 0 ? 'warning' : 'success')
                ->icon('heroicon-o-academic-cap')
                ->extraAttributes(['class' => $hoverClass . ' animate-fade-in-up stagger-6']),
        ];
    }
}
