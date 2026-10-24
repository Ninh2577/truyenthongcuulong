<?php

namespace App\Filament\Resources;

use App\Enums\PillarGroup;
use App\Filament\Forms\Components\MediaPicker;
use App\Filament\Resources\CaseStudyResource\Pages;
use App\Models\CaseStudy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

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
                                            ->placeholder('VD: Cửu Long Camping')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                        Forms\Components\TextInput::make('slug')
                                            ->label('Đường dẫn (Slug)')
                                            ->placeholder('VD: website-cuu-long-camping')
                                            ->required()
                                            ->unique(CaseStudy::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('client_name')
                                            ->label('Tên khách hàng / Đối tác')
                                            ->placeholder('VD: Cửu Long Camping & Glamping')
                                            ->maxLength(255),
                                        Forms\Components\Select::make('group')
                                            ->label('Nhóm dịch vụ')
                                            ->options(PillarGroup::class)
                                            ->required()
                                            ->default(PillarGroup::Technology),
                                        Forms\Components\Select::make('meta_data.category_name')
                                            ->label('Phân loại ngành nghề (Category)')
                                            ->options([
                                                'Du lịch' => 'Du lịch',
                                                'Y tế' => 'Y tế',
                                                'Dịch vụ' => 'Dịch vụ',
                                                'Doanh nghiệp' => 'Doanh nghiệp',
                                                'Thương mại điện tử' => 'Thương mại điện tử',
                                                'Giáo dục' => 'Giáo dục',
                                                'Khác' => 'Khác',
                                            ])
                                            ->searchable()
                                            ->preload()
                                            ->default('Du lịch'),
                                        Forms\Components\TextInput::make('meta_data.domain')
                                            ->label('Tên miền (Domain website)')
                                            ->placeholder('VD: cuulongcamping.vn'),
                                        Forms\Components\TextInput::make('meta_data.demo_url')
                                            ->label('Website trực tuyến (URL)')
                                            ->url()
                                            ->placeholder('https://cuulongcamping.vn')
                                            ->columnSpanFull(),
                                    ]),
                                    Forms\Components\Textarea::make('summary')
                                        ->label('Tóm tắt dự án')
                                        ->placeholder('Mô tả ngắn gọn về dự án (hiển thị trên thẻ card website phía client)...')
                                        ->helperText('Tối ưu từ 120 - 200 ký tự để hiển thị đẹp nhất trên giao diện thẻ card.')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    Forms\Components\TagsInput::make('meta_data.features')
                                        ->label('Đặc điểm & Tính năng nổi bật')
                                        ->placeholder('Gõ tính năng và nhấn Enter (VD: Đặt lịch cắm trại thông minh)')
                                        ->helperText('Hiển thị trong danh sách tính năng khi người dùng xem chi tiết dự án.')
                                        ->columnSpanFull(),
                                    Forms\Components\RichEditor::make('content')
                                        ->label('Nội dung chi tiết (Bài viết Case Study)')
                                        ->toolbarButtons([
                                            'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                                        ])
                                        ->columnSpanFull(),
                                ]),
                            
                            Forms\Components\Tabs\Tab::make('Thư viện & Video')
                                ->icon('heroicon-o-photo')
                                ->schema([
                                    Forms\Components\TextInput::make('video_url')
                                        ->label('Đường dẫn Video YouTube')
                                        ->url()
                                        ->maxLength(255)
                                        ->placeholder('https://www.youtube.com/watch?v=...')
                                        ->helperText('Dán link YouTube (Tùy chọn). Hệ thống sẽ tự động nhúng video vào trang chi tiết dự án.'),
                                    Forms\Components\Repeater::make('gallery')
                                        ->label('Thư viện hình ảnh dự án (Behind the scenes / Screenshot)')
                                        ->schema([
                                            MediaPicker::make('image_url')
                                                ->label('Hình ảnh')
                                                ->required(),
                                            Forms\Components\TextInput::make('caption')
                                                ->label('Chú thích ảnh / Tiêu đề phân cảnh')
                                                ->placeholder('VD: Giao diện đặt lịch trên điện thoại'),
                                        ])
                                        ->columns(2)
                                        ->collapsible()
                                        ->defaultItems(0)
                                        ->reorderableWithButtons(),
                                ]),

                            Forms\Components\Tabs\Tab::make('Hồ sơ kỹ thuật')
                                ->icon('heroicon-o-cpu-chip')
                                ->schema([
                                    Forms\Components\Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('meta_data.tech_stack')
                                            ->label('Công nghệ / Stack kỹ thuật')
                                            ->placeholder('Laravel, Tailwind CSS, Booking Engine, VNPay...')
                                            ->helperText('Các công nghệ chính dùng để xây dựng dự án.'),
                                        Forms\Components\TextInput::make('meta_data.result')
                                            ->label('Kết quả nghiệm thu bàn giao')
                                            ->placeholder('Bàn giao mã nguồn, nghiệm thu 100% đúng hạn...')
                                            ->helperText('Tóm tắt kết quả bàn giao cho đối tác.'),
                                    ]),
                                    Forms\Components\Grid::make(2)->schema([
                                        Forms\Components\Textarea::make('meta_data.problem')
                                            ->label('Bài toán của khách hàng (Problem)')
                                            ->placeholder('Khách hàng gặp khó khăn trong việc quản lý lịch trống và thanh toán trực tuyến...')
                                            ->rows(4),
                                        Forms\Components\Textarea::make('meta_data.solution')
                                            ->label('Giải pháp của Cửu Long (Solution)')
                                            ->placeholder('Xây dựng hệ thống booking tự động, đồng bộ dữ liệu thời gian thực...')
                                            ->rows(4),
                                    ]),
                                    Forms\Components\TextInput::make('meta_data.gear_used')
                                        ->label('Thiết bị sản xuất / Media Gear (Nếu có)')
                                        ->placeholder('Sony FX3, Flycam 4K, Gimbal RS3...')
                                        ->helperText('Dành cho dự án có hạng mục quay chụp, Media sản xuất.'),
                                ]),
                                
                            Forms\Components\Tabs\Tab::make('Chỉ số đo lường (KPI)')
                                ->icon('heroicon-o-chart-bar')
                                ->schema([
                                    Forms\Components\Repeater::make('meta_data.metrics')
                                        ->label('Các chỉ số kết quả nổi bật (Tối đa 2 chỉ số)')
                                        ->schema([
                                            Forms\Components\TextInput::make('value')
                                                ->label('Giá trị (VD: +240%, 10K+)')
                                                ->placeholder('+240%')
                                                ->required(),
                                            Forms\Components\TextInput::make('label')
                                                ->label('Nhãn chỉ số (VD: Tăng trưởng booking)')
                                                ->placeholder('Tăng trưởng booking')
                                                ->required(),
                                            Forms\Components\TextInput::make('context')
                                                ->label('Ghi chú chi tiết')
                                                ->placeholder('Tăng trong 3 tháng đầu ra mắt'),
                                        ])
                                        ->columns(3)
                                        ->maxItems(2)
                                        ->defaultItems(0)
                                        ->reorderableWithButtons(),
                                    Forms\Components\TextInput::make('meta_data.status_badge')
                                        ->label('Nhãn trạng thái bổ sung (Badge)')
                                        ->placeholder('VD: Triển khai thành công')
                                        ->helperText('Hiển thị nếu dự án chưa có các chỉ số đo lường cụ thể ở trên.'),
                                ]),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Ảnh đại diện (Thumbnail)')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            MediaPicker::make('thumbnail')
                                ->label('Ảnh đại diện dự án')
                                ->helperText('Ảnh hiển thị trên thẻ card và trang chi tiết. Khuyến nghị tỷ lệ 16:9.')
                                ->live(),
                        ]),

                    Forms\Components\Section::make('Hiển thị & Trạng thái')
                        ->icon('heroicon-o-eye')
                        ->schema([
                            Forms\Components\Toggle::make('featured')
                                ->label('Nổi bật (Trang chủ)')
                                ->helperText('Bật để ưu tiên hiển thị tại trang chủ website')
                                ->default(false),
                            Forms\Components\Select::make('status')
                                ->label('Trạng thái dự án')
                                ->options([
                                    'active' => 'Đang hoạt động',
                                    'completed' => 'Đã hoàn thành',
                                    'pending' => 'Tạm dừng',
                                ])
                                ->default('active')
                                ->required(),
                            Forms\Components\TextInput::make('views')
                                ->label('Lượt xem thực tế (Views)')
                                ->helperText('Số lượt xem thực tế tự động tăng khi có người xem.')
                                ->numeric()
                                ->default(0),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('order')
                                    ->label('Thứ tự')
                                    ->helperText('Số nhỏ xếp trước')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('year')
                                    ->label('Năm')
                                    ->placeholder('2024')
                                    ->maxLength(4)
                                    ->numeric(),
                            ]),
                        ]),
                    
                    Forms\Components\Section::make('Phân bổ trang hiển thị')
                        ->description('Chọn các trang mà dự án này sẽ xuất hiện')
                        ->icon('heroicon-o-map')
                        ->collapsible()
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
                                ->columns(1),
                        ]),

                    Forms\Components\Section::make('Thông tin hệ thống')
                        ->icon('heroicon-o-clock')
                        ->collapsed()
                        ->schema([
                            Forms\Components\Placeholder::make('created_at')
                                ->label('Thời gian tạo')
                                ->content(fn ($record) => $record?->created_at ? $record->created_at->format('d/m/Y H:i') : '—'),
                            Forms\Components\Placeholder::make('updated_at')
                                ->label('Lần sửa gần nhất')
                                ->content(fn ($record) => $record?->updated_at ? $record->updated_at->format('d/m/Y H:i') : '—'),
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
                    ->formatStateUsing(fn (?string $state) => $state ? (PillarGroup::tryFrom($state)?->getLabel() ?? $state) : '—')
                    ->color(fn (?string $state): string => $state ? (PillarGroup::tryFrom($state)?->getColor() ?? 'gray') : 'gray')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Năm')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('featured')
                    ->label('Nổi bật')
                    ->sortable(),
                Tables\Columns\TextColumn::make('views')
                    ->label('Lượt xem')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format((int) ($state ?? 0), 0, ',', '.') . ' lượt xem'),
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
                    ->options(PillarGroup::class),
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Dự án nổi bật'),
            ])
            ->actions([
                Tables\Actions\Action::make('view_web')
                    ->label('Xem web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => $record?->group === 'media'
                        ? url('/du-an/media#' . ($record?->slug ?? ''))
                        : url('/du-an#' . ($record?->slug ?? ''))
                    )
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
