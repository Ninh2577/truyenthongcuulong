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
    protected static ?string $navigationGroup = 'DỊCH VỤ & KHÁCH HÀNG';
    protected static ?string $navigationLabel = 'Dịch Vụ & Giải Pháp';
    protected static ?string $modelLabel = 'Dịch vụ';
    protected static ?string $pluralModelLabel = 'Dịch Vụ & Giải Pháp';
    protected static ?int $navigationSort = 1;
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Thông tin dịch vụ & Định vị')
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
                                ->placeholder('Mô tả ngắn gọn giá trị cốt lõi mang lại cho khách hàng...')
                                ->rows(3)
                                ->columnSpanFull(),
                            Forms\Components\TagsInput::make('features')
                                ->label('Ưu điểm cốt lõi & Cam kết SLA')
                                ->placeholder('Thêm ưu điểm/cam kết và ấn Enter...')
                                ->helperText('Danh sách các ưu điểm, công nghệ hoặc tiêu chuẩn nghiệm thu của dịch vụ')
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
                Tables\Columns\ToggleColumn::make('featured')
                    ->label('Nổi bật')
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
                    ->url(function ($record) {
                        return match ($record->slug) {
                            'thiet-ke-website' => url('/dich-vu/kho-giao-dien'),
                            'web-app', 'thiet-ke-web-app' => url('/dich-vu/web-app'),
                            'ui-ux', 'thiet-ke-ui-ux' => url('/dich-vu/ui-ux'),
                            'marketing', 'seo', 'dich-vu-seo-tong-the' => url('/dich-vu/marketing'),
                            'quan-tri-website', 'cham-soc-website' => url('/dich-vu/quan-tri-website'),
                            'chup-anh-su-kien' => url('/dich-vu/chup-anh-su-kien'),
                            'quay-phim-su-kien' => url('/dich-vu/quay-phim-su-kien'),
                            'chup-anh-teambuilding' => url('/dich-vu/chup-anh-teambuilding'),
                            'quay-phim-teambuilding' => url('/dich-vu/quay-phim-teambuilding'),
                            'quay-chup-flycam', 'flycam' => url('/dich-vu/quay-chup-flycam'),
                            default => url('/dich-vu/' . $record->slug),
                        };
                    })
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
