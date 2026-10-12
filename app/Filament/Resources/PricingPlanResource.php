<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricingPlanResource\Pages;
use App\Models\PricingPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PricingPlanResource extends Resource
{
    protected static ?string $model = PricingPlan::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'KINH DOANH & KHÁCH HÀNG';
    protected static ?string $navigationLabel = 'Bảng Giá Dịch Vụ';
    protected static ?string $modelLabel = 'Bảng giá dịch vụ';
    protected static ?string $pluralModelLabel = 'Bảng giá dịch vụ';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin chung')
                    ->schema([
                        Forms\Components\Select::make('service_group')
                            ->label('Nhóm dịch vụ')
                            ->options(\App\Enums\PricingServiceGroup::class)
                            ->required(),
                        Forms\Components\TextInput::make('tier_name')
                            ->label('Tên gói (Tier)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price_display')
                            ->label('Hiển thị giá')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price_note')
                            ->label('Ghi chú giá')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả ngắn gọn')
                            ->columnSpanFull()
                            ->maxLength(65535),
                    ])->columns(2),

                Forms\Components\Section::make('Tính năng & Dịch vụ')
                    ->schema([
                        Forms\Components\TagsInput::make('features')
                            ->label('Danh sách quyền lợi')
                            ->placeholder('Thêm quyền lợi và nhấn Enter')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Cấu hình & Trạng thái')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Nổi bật (Khuyên dùng)')
                            ->default(false),
                        Forms\Components\TextInput::make('order')
                            ->label('Thứ tự hiển thị')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('cta_label')
                            ->label('Nút Call-to-action')
                            ->placeholder('VD: Chọn Gói Landing Page')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Kích hoạt hiển thị')
                            ->default(true),
                    ])->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_group')
                    ->label('Nhóm dịch vụ')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => \App\Enums\PricingServiceGroup::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn (string $state): string => \App\Enums\PricingServiceGroup::tryFrom($state)?->getColor() ?? 'gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tier_name')
                    ->label('Tên gói')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_display')
                    ->label('Giá hiển thị')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Hiển thị')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->emptyStateHeading('Chưa có bảng giá nào')
            ->emptyStateDescription('Tạo gói dịch vụ đầu tiên để cung cấp thông tin chi phí và quyền lợi cho khách hàng.')
            ->emptyStateIcon('heroicon-o-currency-dollar')
            ->filters([
                Tables\Filters\SelectFilter::make('service_group')
                    ->label('Nhóm dịch vụ')
                    ->options(\App\Enums\PricingServiceGroup::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Chỉnh sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa gói bảng giá?')
                    ->modalDescription('Gói dịch vụ này sẽ bị xóa khỏi bảng giá website. Thao tác này không thể hoàn tác.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các gói bảng giá đã chọn?')
                        ->modalDescription('Tất cả gói dịch vụ được chọn sẽ bị xóa vĩnh viễn khỏi hệ thống.')
                        ->modalSubmitActionLabel('Xác nhận xóa hàng loạt')
                        ->modalCancelActionLabel('Hủy bỏ'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPricingPlans::route('/'),
            'create' => Pages\CreatePricingPlan::route('/create'),
            'edit' => Pages\EditPricingPlan::route('/{record}/edit'),
        ];
    }
}
