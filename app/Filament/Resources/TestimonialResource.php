<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Nội dung chung';
    protected static ?string $modelLabel = 'Đánh giá';
    protected static ?string $pluralModelLabel = 'Đánh giá của Khách hàng';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin khách hàng')
                    ->schema([
                        Forms\Components\TextInput::make('client_name')
                            ->label('Tên khách hàng')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('client_title')
                            ->label('Chức danh / Công ty')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('avatar')
                            ->label('Ảnh đại diện')
                            ->image()
                            ->directory('testimonials')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Nội dung đánh giá')
                    ->schema([
                        Forms\Components\Textarea::make('quote')
                            ->label('Nội dung')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Ảnh')
                    ->circular()
                    ->size(48)
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->client_name ?? 'C') . '&color=FFFFFF&background=F59E0B'),
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_title')
                    ->label('Chức danh / Công ty')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quote')
                    ->label('Nội dung')
                    ->limit(50),
            ])
            ->defaultSort('id', 'desc')
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
