<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'DỊCH VỤ & KHÁCH HÀNG';
    protected static ?string $navigationLabel = 'Khách Hàng Tiêu Biểu';
    protected static ?string $modelLabel = 'Khách hàng';
    protected static ?string $pluralModelLabel = 'Khách Hàng Tiêu Biểu';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin khách hàng')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên khách hàng')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('industry_category')
                            ->label('Lĩnh vực kinh doanh')
                            ->options(\App\Enums\IndustryCategory::class)
                            ->required(),
                        Forms\Components\TextInput::make('service_used')
                            ->label('Dịch vụ sử dụng')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('year_started')
                            ->label('Năm bắt đầu hợp tác')
                            ->maxLength(10),
                    ])->columns(2),

                Forms\Components\Section::make('Chi tiết & Hình ảnh')
                    ->schema([
                        \App\Filament\Forms\Components\MediaPicker::make('logo')
                            ->label('Logo khách hàng')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả chi tiết')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Trạng thái')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Thứ tự hiển thị')
                            ->numeric()
                            ->minValue(0)
                            ->default(fn () => \App\Models\Client::max('order') !== null ? \App\Models\Client::max('order') + 1 : 0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Kích hoạt hiển thị')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->square()
                    ->size(48)
                    ->extraImgAttributes(['class' => 'rounded-lg object-contain bg-white dark:bg-slate-800 p-1 ring-1 ring-slate-200 dark:ring-slate-700'])
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'C') . '&color=FFFFFF&background=F59E0B'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên khách hàng')
                    ->searchable()
                    ->sortable()
                    ->weight('font-semibold'),
                Tables\Columns\TextColumn::make('industry_category')
                    ->label('Lĩnh vực')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => \App\Enums\IndustryCategory::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn (string $state): string => \App\Enums\IndustryCategory::tryFrom($state)?->getColor() ?? 'gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_used')
                    ->label('Dịch vụ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Hiển thị')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->emptyStateHeading('Chưa có khách hàng nào')
            ->emptyStateDescription('Thêm khách hàng tiêu biểu đầu tiên để hiển thị hồ sơ đối tác trên website.')
            ->emptyStateIcon('heroicon-o-building-office')
            ->filters([
                Tables\Filters\SelectFilter::make('industry_category')
                    ->label('Lĩnh vực')
                    ->options(\App\Enums\IndustryCategory::class),
            ])
            ->actions([
                Tables\Actions\Action::make('view_web')
                    ->label('Xem web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn () => url('/khach-hang'))
                    ->openUrlInNewTab()
                    ->color('gray'),
                Tables\Actions\EditAction::make()->label('Chỉnh sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa khách hàng tiêu biểu?')
                    ->modalDescription('Thông tin khách hàng này sẽ bị xóa khỏi hệ thống. Thao tác này không thể hoàn tác.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các khách hàng đã chọn?')
                        ->modalDescription('Tất cả khách hàng được chọn sẽ bị xóa vĩnh viễn khỏi hệ thống.')
                        ->modalSubmitActionLabel('Xác nhận xóa hàng loạt')
                        ->modalCancelActionLabel('Hủy bỏ'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
