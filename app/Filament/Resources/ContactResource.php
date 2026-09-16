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

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Kinh Doanh';
    protected static ?string $modelLabel = 'Liên hệ';
    protected static ?string $pluralModelLabel = 'Liên hệ';
    protected static ?int $navigationSort = 3;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count() ?: null;
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_interested')
                    ->label('Dịch vụ quan tâm')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('message')
                    ->label('Nội dung')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'new' => 'Mới',
                        'processing' => 'Đang xử lý',
                        'resolved' => 'Đã phản hồi',
                    ])
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Thời gian gửi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->emptyStateHeading('Chưa có yêu cầu liên hệ')
            ->emptyStateDescription('Mọi yêu cầu khách hàng gửi từ trang Liên hệ sẽ xuất hiện tại đây.')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Lọc theo trạng thái')
                    ->options([
                        'new' => 'Mới',
                        'processing' => 'Đang xử lý',
                        'resolved' => 'Đã phản hồi',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Xử lý'),
                Tables\Actions\Action::make('call')
                    ->label('Gọi khách hàng')
                    ->icon('heroicon-o-phone')
                    ->color('success')
                    ->url(fn (Contact $record) => $record->phone ? 'tel:' . preg_replace('/[^0-9]/', '', $record->phone) : null)
                    ->openUrlInNewTab()
                    ->visible(fn (Contact $record) => filled($record->phone)),
                Tables\Actions\Action::make('email')
                    ->label('Gửi Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->url(fn (Contact $record) => $record->email ? 'mailto:' . $record->email : null)
                    ->openUrlInNewTab()
                    ->visible(fn (Contact $record) => filled($record->email)),
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
            'index' => Pages\ListContacts::route('/'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
