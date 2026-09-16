<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseStudyResource\Pages;
use App\Filament\Resources\CaseStudyResource\RelationManagers;
use App\Models\CaseStudy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaseStudyResource extends Resource
{
    protected static ?string $model = CaseStudy::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Nội Dung';
    protected static ?string $modelLabel = 'Dự án';
    protected static ?string $pluralModelLabel = 'Dự án (Case Study)';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Tabs::make('Tabs')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make('Thông tin chung')
                                ->icon('heroicon-o-information-circle')
                                ->schema([
                                    Forms\Components\Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Tên dự án')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                        Forms\Components\TextInput::make('slug')
                                            ->label('Đường dẫn (Slug)')
                                            ->required()
                                            ->unique(CaseStudy::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('client_name')
                                            ->label('Tên khách hàng / Đối tác')
                                            ->maxLength(255),
                                        Forms\Components\Select::make('group')
                                            ->label('Nhóm dịch vụ')
                                            ->options(\App\Enums\PillarGroup::class)
                                            ->required()
                                            ->default(\App\Enums\PillarGroup::Media),
                                    ]),
                                    Forms\Components\Textarea::make('summary')
                                        ->label('Tóm tắt dự án')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    Forms\Components\RichEditor::make('content')
                                        ->label('Nội dung chi tiết')
                                        ->toolbarButtons([
                                            'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                                        ])
                                        ->columnSpanFull(),
                                ]),
                            
                            Forms\Components\Tabs\Tab::make('Hình ảnh & Video')
                                ->icon('heroicon-o-photo')
                                ->schema([
                                    Forms\Components\TextInput::make('video_url')
                                        ->label('Đường dẫn Video (Video URL)')
                                        ->url()
                                        ->maxLength(255)
                                        ->helperText('Dán link YouTube (Tùy chọn). Nếu bạn không tải Ảnh đại diện, hệ thống sẽ tự động lấy ảnh bìa từ video này.'),
                                    \App\Filament\Forms\Components\MediaPicker::make('thumbnail')
                                        ->label('Ảnh đại diện (Thumbnail)')
                                        ->live(),
                                ]),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Hiển thị & Sắp xếp')
                        ->icon('heroicon-o-eye')
                        ->schema([
                            Forms\Components\Toggle::make('featured')
                                ->label('Nổi bật (Trang chủ)')
                                ->default(false),
                            Forms\Components\TextInput::make('order')
                                ->label('Thứ tự ưu tiên')
                                ->helperText('Số càng nhỏ càng xếp trên')
                                ->numeric()
                                ->default(0),
                            Forms\Components\TextInput::make('year')
                                ->label('Năm thực hiện')
                                ->maxLength(4)
                                ->numeric(),
                        ]),
                    
                    Forms\Components\Section::make('Phân bổ trang')
                        ->description('Chọn các trang mà dự án này sẽ xuất hiện')
                        ->icon('heroicon-o-map')
                        ->schema([
                            Forms\Components\CheckboxList::make('meta_data.show_on_pages')
                                ->label('Trang xuất hiện')
                                ->hiddenLabel()
                                ->options([
                                    'home' => 'Trang Chủ',
                                    'web-app' => 'Trang Dịch Vụ Web/App',
                                    'media' => 'Trang Dịch Vụ Media',
                                    'marketing' => 'Trang Dịch Vụ Marketing',
                                ])
                                ->columns(1)
                                ->gridDirection('row'),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->square()
                    ->size(48)
                    ->getStateUsing(fn ($record) => $record->cover_image_url)
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->title ?? 'CS') . '&color=FFFFFF&background=F59E0B'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tên dự án')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Đường dẫn')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('group')
                    ->label('Nhóm dịch vụ')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => \App\Enums\PillarGroup::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn (string $state): string => \App\Enums\PillarGroup::tryFrom($state)?->getColor() ?? 'gray')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Năm')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Nhóm dịch vụ')
                    ->options(\App\Enums\PillarGroup::class),
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Dự án nổi bật'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaseStudies::route('/'),
            'create' => Pages\CreateCaseStudy::route('/create'),
            'edit' => Pages\EditCaseStudy::route('/{record}/edit'),
        ];
    }
}
