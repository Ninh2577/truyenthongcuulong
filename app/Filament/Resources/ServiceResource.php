<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'KINH DOANH & KHÁCH HÀNG';
    protected static ?string $navigationLabel = 'Dịch Vụ Website';
    protected static ?string $modelLabel = 'Dịch vụ';
    protected static ?string $pluralModelLabel = 'Dịch vụ Website';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Thông tin dịch vụ')
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Tên dịch vụ')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Đường dẫn (Slug)')
                                    ->required()
                                    ->unique(Service::class, 'slug', ignoreRecord: true)
                                    ->maxLength(255),
                                Forms\Components\Select::make('group')
                                    ->label('Trụ cột / Nhóm dịch vụ')
                                    ->options(\App\Enums\PillarGroup::class)
                                    ->required()
                                    ->default(\App\Enums\PillarGroup::Technology),
                                Forms\Components\TextInput::make('icon')
                                    ->label('Biểu tượng / Icon')
                                    ->maxLength(255)
                                    ->placeholder('heroicon-o-computer-desktop hoặc cpu')
                                    ->helperText('Tên định danh icon (Heroicon hoặc CSS icon class)'),
                            ]),
                            Forms\Components\Textarea::make('summary')
                                ->label('Tóm tắt dịch vụ')
                                ->rows(3)
                                ->columnSpanFull(),
                            Forms\Components\TagsInput::make('features')
                                ->label('Tính năng cốt lõi / Điểm nổi bật')
                                ->placeholder('Thêm tính năng và ấn Enter...')
                                ->helperText('Danh sách các ưu điểm, công nghệ hoặc gói tính năng chính của dịch vụ')
                                ->columnSpanFull(),
                            Forms\Components\RichEditor::make('content')
                                ->label('Nội dung chi tiết dịch vụ')
                                ->toolbarButtons([
                                    'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                                ])
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Trạng thái & Hiển thị')
                        ->schema([
                            Forms\Components\Toggle::make('featured')
                                ->label('Dịch vụ tiêu biểu (Nổi bật)')
                                ->helperText('Ưu tiên ghim xuất hiện trên trang chủ')
                                ->default(false),
                            Forms\Components\TextInput::make('order')
                                ->label('Thứ tự hiển thị')
                                ->numeric()
                                ->default(0)
                                ->helperText('Số nhỏ hơn sẽ hiển thị trước'),
                        ]),

                    Forms\Components\Section::make('Tối ưu hóa SEO')
                        ->schema([
                            Forms\Components\TextInput::make('meta_title')
                                ->label('Tiêu đề SEO (Meta Title)')
                                ->maxLength(255),
                            Forms\Components\Textarea::make('meta_description')
                                ->label('Mô tả SEO (Meta Description)')
                                ->rows(3),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Tên dịch vụ')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Đường dẫn')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('group')
                    ->label('Nhóm dịch vụ')
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => $state ? (\App\Enums\PillarGroup::tryFrom($state)?->getLabel() ?? $state) : '—')
                    ->color(fn (?string $state): string => $state ? (\App\Enums\PillarGroup::tryFrom($state)?->getColor() ?? 'gray') : 'gray')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('features')
                    ->label('Tính năng')
                    ->badge()
                    ->separator(',')
                    ->limitList(2)
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\IconColumn::make('featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Lọc theo nhóm')
                    ->options(\App\Enums\PillarGroup::class),
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Trạng thái nổi bật')
                    ->trueLabel('Chỉ dịch vụ nổi bật')
                    ->falseLabel('Chỉ dịch vụ thường'),
            ])
            ->actions([
                Tables\Actions\Action::make('view_web')
                    ->label('Xem web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => url('/dich-vu/' . $record->slug))
                    ->openUrlInNewTab()
                    ->color('gray'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
