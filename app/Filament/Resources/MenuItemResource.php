<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    
    protected static ?string $navigationGroup = 'CẤU HÌNH & HỆ THỐNG';
    
    protected static ?string $navigationLabel = 'Liên kết Menu con';

    protected static ?int $navigationSort = 4;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('menu_id')
                    ->relationship('menu', 'name')
                    ->required()
                    ->label('Thuộc Menu'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Tên hiển thị (Tiêu đề)'),
                Forms\Components\TextInput::make('url')
                    ->maxLength(255)
                    ->label('Đường dẫn (URL)')
                    ->helperText('Đường dẫn trang web (VD: /dich-vu/web-app, /kho-giao-dien, /dich-vu-seo-can-tho...). Tự động chuẩn hóa dấu / ở đầu.')
                    ->datalist([
                        '/',
                        '/kho-giao-dien',
                        '/mau-giao-dien',
                        '/dich-vu/web-app',
                        '/dich-vu/ui-ux',
                        '/dich-vu/marketing',
                        '/dich-vu-seo-can-tho',
                        '/dich-vu/quan-tri-website',
                        '/dich-vu/chup-anh-su-kien',
                        '/dich-vu/quay-phim-su-kien',
                        '/dich-vu/chup-anh-teambuilding',
                        '/dich-vu/quay-phim-teambuilding',
                        '/dich-vu/quay-chup-flycam',
                        '/dich-vu/bang-gia',
                        '/du-an',
                        '/du-an/media',
                        '/bai-viet',
                        '/khach-hang',
                        '/tuyen-dung',
                        '/ho-so-nang-luc',
                        '/lien-he',
                    ]),
                Forms\Components\Select::make('route_name')
                    ->label('Trang chức năng (Đích hiển thị khi truy cập URL này)')
                    ->options(\App\Services\MenuRouteResolver::supportedRoutes())
                    ->default('')
                    ->helperText('Bạn có thể đặt Đường dẫn (URL) thành BẤT KỲ TÊN NÀO mong muốn (VD: /mau-giao-dien, /giao-dien-dep,...), hệ thống sẽ luôn hiển thị đúng trang chức năng này mà không bao giờ bị lỗi 404!'),
                Forms\Components\Select::make('target')
                    ->options([
                        '_self' => 'Mở trong tab hiện tại',
                        '_blank' => 'Mở trong tab mới',
                    ])
                    ->default('_self')
                    ->required()
                    ->label('Hành động khi click'),
                Forms\Components\TextInput::make('subtitle')
                    ->maxLength(255)
                    ->label('Phụ đề (Dòng text nhỏ ở dưới)'),
                Forms\Components\TextInput::make('icon')
                    ->maxLength(255)
                    ->label('Icon (Tuỳ chọn) - VD: code, videocam...'),
                Forms\Components\TextInput::make('icon_color')
                    ->maxLength(255)
                    ->label('Màu Icon (Mã màu Tailwind) - VD: text-sky-600'),
                Forms\Components\TextInput::make('badge_text')
                    ->maxLength(255)
                    ->label('Badge Text (VD: Hot, New)'),
                Forms\Components\TextInput::make('badge_color')
                    ->maxLength(255)
                    ->label('Màu nền Badge (Mã màu Tailwind) - VD: bg-amber-500'),
                Forms\Components\TextInput::make('bg_color')
                    ->maxLength(255)
                    ->label('Màu nền cả khối (Mã Tailwind) - VD: bg-amber-50/70'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\MenuItemTree::route('/'),
        ];
    }
}
