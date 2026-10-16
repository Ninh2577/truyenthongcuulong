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
    protected static ?string $navigationGroup = 'DỊCH VỤ & KHÁCH HÀNG';
    protected static ?string $modelLabel = 'Dự án';
    protected static ?string $pluralModelLabel = 'Dự án tiêu biểu';
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
                                    Forms\Components\Repeater::make('gallery')
                                        ->label('Thư viện ảnh dự án / Behind the scenes')
                                        ->schema([
                                            \App\Filament\Forms\Components\MediaPicker::make('image_url')
                                                ->label('Hình ảnh')
                                                ->required(),
                                            Forms\Components\TextInput::make('caption')
                                                ->label('Chú thích ảnh / Tiêu đề phân cảnh'),
                                        ])
                                        ->columns(2)
                                        ->collapsible()
                                        ->defaultItems(0)
                                        ->reorderableWithButtons(),
                                ]),

                            Forms\Components\Tabs\Tab::make('Bài toán & Kỹ thuật')
                                ->icon('heroicon-o-cpu-chip')
                                ->schema([
                                    Forms\Components\Grid::make(2)->schema([
                                        Forms\Components\Textarea::make('meta_data.problem')
                                            ->label('Bài toán doanh nghiệp (Problem)')
                                            ->placeholder('Cần nâng cấp nhận diện số và chuẩn hóa quy trình vận hành trực tuyến...')
                                            ->rows(3),
                                        Forms\Components\Textarea::make('meta_data.solution')
                                            ->label('Giải pháp triển khai (Solution)')
                                            ->placeholder('Xây dựng giải pháp kỹ thuật may đo phù hợp với đặc thù nghiệp vụ...')
                                            ->rows(3),
                                    ]),
                                    Forms\Components\Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('meta_data.tech_stack')
                                            ->label('Công nghệ / Stack kỹ thuật')
                                            ->placeholder('PHP, Laravel, TailwindCSS, MySQL...')
                                            ->helperText('Hiển thị trong hồ sơ kỹ thuật case study'),
                                        Forms\Components\TextInput::make('meta_data.result')
                                            ->label('Kết quả bàn giao (Deliverables)')
                                            ->placeholder('Bàn giao mã nguồn, nghiệm thu hoàn tất...')
                                            ->helperText('Tóm tắt kết quả nghiệm thu bàn giao'),
                                    ]),
                                    Forms\Components\Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('meta_data.demo_url')
                                            ->label('Đường dẫn trải nghiệm (Live Demo URL)')
                                            ->url()
                                            ->placeholder('https://example.com')
                                            ->helperText('Dành cho các dự án Web/App có trang xem trực tiếp'),
                                        Forms\Components\TextInput::make('meta_data.gear_used')
                                            ->label('Thiết bị ghi hình / Media Gear')
                                            ->placeholder('Sony FX3, Flycam 4K, Gimbal RS3...')
                                            ->helperText('Dành cho các dự án TVC / Media sản xuất'),
                                    ]),
                                ]),
                                
                            Forms\Components\Tabs\Tab::make('Số liệu & Trạng thái')
                                ->icon('heroicon-o-chart-bar')
                                ->schema([
                                    Forms\Components\Repeater::make('meta_data.metrics')
                                        ->label('Các chỉ số nổi bật (Tối đa 2)')
                                        ->schema([
                                            Forms\Components\TextInput::make('value')
                                                ->label('Giá trị (VD: 300+, 100%)')
                                                ->required(),
                                            Forms\Components\TextInput::make('label')
                                                ->label('Nhãn (VD: Nhân sự, Số hóa)')
                                                ->required(),
                                            Forms\Components\TextInput::make('context')
                                                ->label('Ngữ cảnh chi tiết'),
                                        ])
                                        ->columns(3)
                                        ->maxItems(2)
                                        ->defaultItems(0)
                                        ->reorderableWithButtons(),
                                    Forms\Components\TextInput::make('meta_data.status_badge')
                                        ->label('Nhãn trạng thái thay thế (Badge)')
                                        ->helperText('Sử dụng khi dự án chưa có số liệu đo lường cụ thể (VD: Triển khai nội bộ). Nhãn này sẽ được hiển thị nếu danh sách chỉ số ở trên trống.'),
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
                    ->searchable()
                    ->weight('bold'),
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
                Tables\Columns\ToggleColumn::make('featured')
                    ->label('Nổi bật')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->emptyStateHeading('Chưa có dự án nào')
            ->emptyStateDescription('Tạo dự án tiêu biểu đầu tiên để giới thiệu hồ sơ năng lực thực tế của công ty.')
            ->emptyStateIcon('heroicon-o-briefcase')
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Nhóm dịch vụ')
                    ->options(\App\Enums\PillarGroup::class),
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Dự án nổi bật'),
            ])
            ->actions([
                Tables\Actions\Action::make('view_web')
                    ->label('Xem web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => url('/du-an/' . $record->slug))
                    ->openUrlInNewTab()
                    ->color('gray'),
                Tables\Actions\EditAction::make()->label('Chỉnh sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa dự án tiêu biểu?')
                    ->modalDescription('Dự án này sẽ bị xóa khỏi hệ thống. Thao tác này không thể hoàn tác.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các dự án đã chọn?')
                        ->modalDescription('Tất cả dự án được chọn sẽ bị xóa vĩnh viễn khỏi hệ thống.')
                        ->modalSubmitActionLabel('Xác nhận xóa hàng loạt')
                        ->modalCancelActionLabel('Hủy bỏ'),
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
