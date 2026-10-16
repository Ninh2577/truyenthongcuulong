<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'TUYỂN DỤNG & NHÂN SỰ';
    protected static ?string $navigationLabel = 'Hồ sơ ứng tuyển';
    protected static ?string $modelLabel = 'Hồ sơ ứng tuyển';
    protected static ?string $pluralModelLabel = 'Hồ sơ ứng tuyển';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin ứng viên')
                    ->schema([
                        Forms\Components\TextInput::make('fullname')
                            ->label('Họ và tên ứng viên')
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('position')
                            ->label('Vị trí ứng tuyển')
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Địa chỉ Email')
                            ->disabled(),
                        Forms\Components\Textarea::make('cover_letter')
                            ->label('Thư giới thiệu / Lời nhắn')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Hồ sơ CV & Xử lý tuyển dụng')
                    ->schema([
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('download_cv_form')
                                ->label('Tải xuống tệp CV ứng viên')
                                ->icon('heroicon-o-arrow-down-tray')
                                ->color('primary')
                                ->button()
                                ->action(function ($record) {
                                    if (!$record || empty($record->cv_path)) {
                                        Notification::make()->title('Không tìm thấy tệp CV')->danger()->send();
                                        return null;
                                    }

                                    $disk = Storage::disk('private_cv');
                                    if ($disk->exists($record->cv_path)) {
                                        $ext = pathinfo($record->cv_path, PATHINFO_EXTENSION);
                                        $downloadName = 'CV_' . Str::slug($record->fullname) . '_' . date('Ymd') . '.' . $ext;
                                        return $disk->download($record->cv_path, $downloadName);
                                    }

                                    Notification::make()->title('Tệp CV không tồn tại trên hệ thống lưu trữ')->danger()->send();
                                    return null;
                                }),
                        ])->fullWidth(),

                        Forms\Components\Select::make('status')
                            ->label('Trạng thái xét duyệt')
                            ->options([
                                'pending' => 'Chờ duyệt (Mới)',
                                'reviewed' => 'Đang xem xét / Phỏng vấn',
                                'hired' => 'Đã tuyển dụng (Trúng tuyển)',
                                'rejected' => 'Từ chối hồ sơ',
                            ])
                            ->required()
                            ->default('pending'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->label('Họ tên ứng viên')
                    ->searchable()
                    ->sortable()
                    ->weight('font-semibold')
                    ->icon('heroicon-o-user'),
                Tables\Columns\TextColumn::make('position')
                    ->label('Vị trí ứng tuyển')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->color('gray'),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ duyệt',
                        'reviewed' => 'Đang xem xét',
                        'hired' => 'Đã tuyển',
                        'rejected' => 'Từ chối',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày nộp')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Chưa có hồ sơ ứng tuyển nào')
            ->emptyStateDescription('Mọi hồ sơ ứng tuyển nộp từ trang Tuyển dụng sẽ được ghi nhận và hiển thị tại đây.')
            ->emptyStateIcon('heroicon-o-academic-cap')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ duyệt',
                        'reviewed' => 'Đang xem xét',
                        'hired' => 'Đã tuyển dụng',
                        'rejected' => 'Từ chối',
                    ]),
                Tables\Filters\SelectFilter::make('position')
                    ->label('Vị trí ứng tuyển')
                    ->options(fn () => JobApplication::distinct()->pluck('position', 'position')->toArray()),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Tải CV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->action(function (JobApplication $record) {
                        if (empty($record->cv_path)) {
                            Notification::make()->title('Không có tệp CV đính kèm')->danger()->send();
                            return null;
                        }

                        $disk = Storage::disk('private_cv');
                        if ($disk->exists($record->cv_path)) {
                            $ext = pathinfo($record->cv_path, PATHINFO_EXTENSION);
                            $downloadName = 'CV_' . Str::slug($record->fullname) . '_' . date('Ymd') . '.' . $ext;
                            return $disk->download($record->cv_path, $downloadName);
                        }

                        Notification::make()->title('Tệp CV không tồn tại')->danger()->send();
                        return null;
                    }),
                Tables\Actions\Action::make('call')
                    ->label('Gọi')
                    ->icon('heroicon-o-phone')
                    ->color('success')
                    ->url(fn (JobApplication $record) => $record->phone ? 'tel:' . preg_replace('/[^0-9]/', '', $record->phone) : null)
                    ->openUrlInNewTab()
                    ->visible(fn (JobApplication $record) => filled($record->phone)),
                Tables\Actions\Action::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->url(fn (JobApplication $record) => $record->email ? 'mailto:' . $record->email : null)
                    ->openUrlInNewTab()
                    ->visible(fn (JobApplication $record) => filled($record->email)),
                Tables\Actions\EditAction::make()->label('Xử lý'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa hồ sơ ứng tuyển này?')
                    ->modalDescription('Hồ sơ và tệp CV sẽ bị xóa khỏi hệ thống. Thao tác này không thể hoàn tác.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ')
                    ->after(function (JobApplication $record) {
                        if (!empty($record->cv_path) && Storage::disk('private_cv')->exists($record->cv_path)) {
                            Storage::disk('private_cv')->delete($record->cv_path);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các hồ sơ đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các hồ sơ đã chọn?')
                        ->modalDescription('Tất cả hồ sơ được chọn sẽ bị xóa vĩnh viễn khỏi hệ thống.')
                        ->modalSubmitActionLabel('Xác nhận xóa hàng loạt')
                        ->modalCancelActionLabel('Hủy bỏ'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobApplications::route('/'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
}
