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

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';
    
    protected static ?string $navigationGroup = 'Giao Diện';
    
    protected static ?string $navigationLabel = 'Menu & Điều Hướng';

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
                    ->label('Đường dẫn (URL)'),
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
