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
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Quản Lý Website';
    protected static ?string $modelLabel = 'Khách hàng';
    protected static ?string $pluralModelLabel = 'Danh sách Khách hàng';
    protected static ?int $navigationSort = 1;

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
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo khách hàng')
                            ->image()
                            ->directory('clients')
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
                            ->default(0),
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
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'C') . '&color=FFFFFF&background=F59E0B'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên khách hàng')
                    ->searchable()
                    ->sortable(),
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
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Hiển thị')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('industry_category')
                    ->label('Lĩnh vực')
                    ->options(\App\Enums\IndustryCategory::class),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
