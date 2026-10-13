<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Chat & CSKH';
    protected static ?string $navigationLabel = 'Yêu Cầu Tư Vấn';
    protected static ?string $modelLabel = 'Yêu Cầu Tư Vấn';
    protected static ?string $pluralModelLabel = 'Yêu Cầu Tư Vấn';
    protected static ?int $navigationSort = 1;
    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'new')->count();
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
                Forms\Components\Section::make('Thông tin khách hàng')
                    ->schema([
                        Forms\Components\TextInput::make('fullname')
                            ->label('Họ và tên')
                            ->disabled()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->disabled()
                            ->maxLength(30),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('service_interested')
                            ->label('Dịch vụ quan tâm')
                            ->disabled()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('message')
                            ->label('Nội dung yêu cầu')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Xử lý yêu cầu')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái xử lý')
                            ->options([
                                'new' => 'Mới',
                                'processing' => 'Đang xử lý',
                                'resolved' => 'Đã phản hồi',
                            ])
                            ->required()
                            ->default('new'),
                        Forms\Components\Textarea::make('admin_note')
                            ->label('Ghi chú nội bộ (Admin)')
                            ->helperText('Ghi chú lại quá trình liên hệ khách hàng (chỉ Admin xem được).')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->label('Khách hàng')
                    ->searchable()
                    ->weight('font-semibold')
                    ->icon('heroicon-o-user'),
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
                Tables\Columns\TextColumn::make('service_interested')
                    ->label('Dịch vụ quan tâm')
                    ->searchable()
                    ->badge()
                    ->color('info')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('message')
                    ->label('Nội dung yêu cầu')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->message)
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'new' => 'Mới (Chưa xử lý)',
                        'processing' => 'Đang liên hệ',
                        'resolved' => 'Đã phản hồi',
                    ])
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Thời gian gửi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),
            ])
            ->emptyStateHeading('Chưa có yêu cầu tư vấn')
            ->emptyStateDescription('Mọi yêu cầu khách hàng gửi từ website và landing page sẽ xuất hiện tại đây.')
            ->emptyStateIcon('heroicon-o-inbox-arrow-down')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Lọc theo trạng thái')
                    ->options([
                        'new' => 'Mới (Chưa xử lý)',
                        'processing' => 'Đang liên hệ',
                        'resolved' => 'Đã phản hồi',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('call')
                    ->label('Gọi')
                    ->icon('heroicon-o-phone')
                    ->color('success')
                    ->url(fn (Contact $record) => $record->phone ? 'tel:' . preg_replace('/[^0-9]/', '', $record->phone) : null)
                    ->openUrlInNewTab()
                    ->visible(fn (Contact $record) => filled($record->phone)),
                Tables\Actions\Action::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->url(fn (Contact $record) => $record->email ? 'mailto:' . $record->email : null)
                    ->openUrlInNewTab()
                    ->visible(fn (Contact $record) => filled($record->email)),
                Tables\Actions\EditAction::make()->label('Xử lý'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation()
                    ->modalHeading('Xóa yêu cầu tư vấn?')
                    ->modalDescription('Yêu cầu liên hệ này sẽ bị xóa khỏi danh sách. Thao tác này không thể hoàn tác.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các yêu cầu liên hệ đã chọn?')
                        ->modalDescription('Tất cả yêu cầu được chọn sẽ bị xóa vĩnh viễn khỏi hệ thống.')
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
            'index' => Pages\ListContacts::route('/'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
