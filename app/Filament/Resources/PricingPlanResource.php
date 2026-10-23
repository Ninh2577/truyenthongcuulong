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
    protected static ?string $navigationGroup = 'DỊCH VỤ & KHÁCH HÀNG';
    protected static ?string $navigationLabel = 'Bảng Giá Dịch Vụ';
    protected static ?string $modelLabel = 'Bảng giá dịch vụ';
    protected static ?string $pluralModelLabel = 'Bảng giá dịch vụ';
    protected static ?int $navigationSort = 3;

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

                Forms\Components\Section::make('Hình ảnh minh họa')
                    ->description('Ảnh đại diện hiển thị trên thẻ gói giá và trang khách hàng (có thể chọn từ Thư viện Media hoặc tải lên mới)')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        \App\Filament\Forms\Components\MediaPicker::make('thumbnail')
                            ->label('Hình ảnh đại diện (Thumbnail)')
                            ->helperText('Bấm vào ô bên dưới để chọn hình ảnh từ Thư viện Media.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Tính năng & Dịch vụ')
                    ->schema([
                        Forms\Components\TagsInput::make('features')
                            ->label('Danh sách quyền lợi')
                            ->placeholder('Thêm quyền lợi và nhấn Enter')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Cấu hình Hiển thị & Phạm vi')
                    ->description('Cấu hình nơi gói bảng giá này sẽ xuất hiện trên giao diện khách hàng (Client-side)')
                    ->schema([
                        Forms\Components\Toggle::make('show_on_pricing_page')
                            ->label('Hiển thị trên Trang Bảng giá (/dich-vu/bang-gia)')
                            ->helperText('Bật để gói xuất hiện trong bảng giá tổng hợp')
                            ->default(true),
                        Forms\Components\Toggle::make('show_on_service_page')
                            ->label('Hiển thị trên Trang Dịch vụ con')
                            ->helperText('Bật để gói xuất hiện trực tiếp trong trang dịch vụ chi tiết')
                            ->default(true),
                        Forms\Components\Select::make('target_page')
                            ->label('Trang dịch vụ tương ứng')
                            ->placeholder('Chọn trang dịch vụ hiển thị')
                            ->options([
                                'dich-vu/web-app' => 'Thiết kế Web App & Ứng Dụng Di Động (/dich-vu/web-app)',
                                'dich-vu/ui-ux' => 'Thiết Kế UI/UX Theo Yêu Cầu (/dich-vu/ui-ux)',
                                'dich-vu/marketing' => 'Dịch Vụ SEO & Marketing Tổng Thể (/dich-vu/marketing)',
                                'dich-vu/quan-tri-website' => 'Quản Trị Website (/dich-vu/quan-tri-website)',
                                'dich-vu/chup-anh-su-kien' => 'Chụp Ảnh Sự Kiện (/dich-vu/chup-anh-su-kien)',
                                'dich-vu/quay-phim-su-kien' => 'Quay Phim Sự Kiện & TVC (/dich-vu/quay-phim-su-kien)',
                                'dich-vu/chup-anh-teambuilding' => 'Chụp Ảnh Teambuilding (/dich-vu/chup-anh-teambuilding)',
                                'dich-vu/quay-phim-teambuilding' => 'Quay Phim Teambuilding (/dich-vu/quay-phim-teambuilding)',
                                'dich-vu/quay-chup-flycam' => 'Quay Chụp Flycam (/dich-vu/quay-chup-flycam)',
                                'dich-vu/kho-giao-dien' => 'Kho Mẫu Giao Diện Website (/dich-vu/kho-giao-dien)',
                            ])
                            ->searchable()
                            ->columnSpanFull(),
                    ])->columns(2),

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
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Hiển thị')
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
                Tables\Actions\Action::make('view_web')
                    ->label('Xem web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn () => url('/dich-vu/bang-gia'))
                    ->openUrlInNewTab()
                    ->color('gray'),
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
