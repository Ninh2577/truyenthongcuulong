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
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Kinh Doanh';
    protected static ?string $modelLabel = 'Bảng giá';
    protected static ?string $pluralModelLabel = 'Bảng giá Dịch vụ';
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
                        Forms\Components\Toggle::make('is_active')
                            ->label('Kích hoạt hiển thị')
                            ->default(true),
                    ])->columns(3),
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
            ->filters([
                Tables\Filters\SelectFilter::make('service_group')
                    ->label('Nhóm dịch vụ')
                    ->options(\App\Enums\PricingServiceGroup::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
