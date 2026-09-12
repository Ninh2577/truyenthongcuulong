<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Quản Lý Website';
    protected static ?string $modelLabel = 'Đối tác';
    protected static ?string $pluralModelLabel = 'Mạng lưới Đối tác';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin đối tác')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên đối tác')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('tier')
                            ->label('Phân cấp (Tier)')
                            ->options(\App\Enums\PartnerTier::class)
                            ->required()
                            ->default('gold'),
                        Forms\Components\TextInput::make('category')
                            ->label('Lĩnh vực / Chuyên mục')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tagline')
                            ->label('Tagline phụ')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Hình ảnh & Mô tả')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Hình ảnh nền (dành cho Top & Gold)')
                            ->image()
                            ->directory('partners')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo đối tác')
                            ->image()
                            ->directory('partners')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả ngắn')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('website_url')
                            ->label('URL Website')
                            ->url()
                            ->maxLength(255),
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
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'P') . '&color=FFFFFF&background=F59E0B'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên đối tác')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tier')
                    ->label('Phân cấp')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => \App\Enums\PartnerTier::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn (string $state): string => \App\Enums\PartnerTier::tryFrom($state)?->getColor() ?? 'gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Lĩnh vực')
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
                Tables\Filters\SelectFilter::make('tier')
                    ->label('Phân cấp')
                    ->options(\App\Enums\PartnerTier::class),
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
