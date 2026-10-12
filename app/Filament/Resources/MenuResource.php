<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    
    protected static ?string $navigationGroup = 'CẤU HÌNH & HỆ THỐNG';
    
    protected static ?string $navigationLabel = 'Menu Website';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Tên Menu (Ví dụ: Menu Chính)'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Vị trí (Ví dụ: header, footer)'),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Kích hoạt'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Tên Menu')
                    ->weight('font-semibold'),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->sortable()
                    ->label('Vị trí hiển thị')
                    ->badge()
                    ->color('info'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Trạng thái')
                    ->sortable(),
            ])
            ->emptyStateHeading('Chưa có Menu nào')
            ->emptyStateDescription('Tạo menu đầu tiên để quản lý các liên kết điều hướng Header và Footer.')
            ->emptyStateIcon('heroicon-o-bars-3')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('manage_items')
                    ->label('≡ Cây liên kết')
                    ->icon('heroicon-o-queue-list')
                    ->color('primary')
                    ->button()
                    ->size('sm')
                    ->url(fn () => MenuItemResource::getUrl('index')),
                Tables\Actions\EditAction::make()->label('Chỉnh sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa Menu website?')
                    ->modalDescription('Menu này sẽ bị xóa khỏi hệ thống. Các liên kết con thuộc menu này cũng có thể bị ảnh hưởng.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các menu đã chọn?')
                        ->modalDescription('Tất cả menu được chọn sẽ bị xóa vĩnh viễn khỏi hệ thống.')
                        ->modalSubmitActionLabel('Xác nhận xóa hàng loạt')
                        ->modalCancelActionLabel('Hủy bỏ'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMenus::route('/'),
        ];
    }
}
