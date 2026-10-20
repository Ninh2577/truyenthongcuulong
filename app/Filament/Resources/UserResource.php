<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'CẤU HÌNH & HỆ THỐNG';
    protected static ?string $navigationLabel = 'Tài khoản';
    protected static ?string $modelLabel = 'Tài khoản';
    protected static ?string $pluralModelLabel = 'Tài khoản quản trị';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Họ Tên')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Mật khẩu')
                    ->password()
                    ->rule(Password::min(12))
                    ->maxLength(255)
                    ->confirmed()
                    ->nullable(fn (string $context): bool => $context === 'edit')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->helperText('Tối thiểu 12 ký tự.'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->label('Xác nhận mật khẩu')
                    ->password()
                    ->maxLength(255)
                    ->dehydrated(false)
                    ->required(fn ($get, string $context): bool => $context === 'create' || filled($get('password'))),
                Forms\Components\Select::make('roles')
                    ->label('Phân quyền (Role)')
                    ->multiple()
                    ->relationship('roles', 'name', modifyQueryUsing: function ($query) {
                        if (! auth()->user()?->hasRole('super_admin')) {
                            $query->where('name', '!=', 'super_admin');
                        }
                    })
                    ->preload()
                    ->visible(fn () => auth()->user()?->hasAnyRole(['super_admin', 'Admin']) || auth()->user()?->can('update_users') || auth()->user()?->can('update_user')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Họ Tên')
                    ->searchable()
                    ->sortable()
                    ->weight('font-semibold')
                    ->icon('heroicon-o-user'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->color('gray')
                    ->icon('heroicon-o-envelope'),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Vai trò / Phân quyền')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),
            ])
            ->emptyStateHeading('Chưa có tài khoản nào')
            ->emptyStateDescription('Tạo tài khoản quản trị viên mới để cấp quyền truy cập hệ thống.')
            ->emptyStateIcon('heroicon-o-users')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Chỉnh sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->authorize(fn ($record) => \App\Services\RolePermissionSecurityService::checkCanDeleteUser(auth()->user(), $record)['allowed'])
                    ->hidden(fn ($record) => auth()->id() === $record->id || ($record->hasRole('super_admin') && \App\Models\User::role('super_admin')->count() <= 1))
                    ->requiresConfirmation()
                    ->modalHeading('Xóa tài khoản người dùng?')
                    ->modalDescription('Tài khoản này sẽ bị xóa và mất toàn bộ quyền truy cập vào Admin Panel.')
                    ->modalSubmitActionLabel('Xác nhận xóa')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các mục đã chọn')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $deletedCount = 0;
                            $skippedCount = 0;
                            foreach ($records as $record) {
                                $check = \App\Services\RolePermissionSecurityService::checkCanDeleteUser(auth()->user(), $record);
                                if ($check['allowed']) {
                                    $record->delete();
                                    $deletedCount++;
                                } else {
                                    $skippedCount++;
                                }
                            }

                            if ($deletedCount > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->success()
                                    ->title("Đã xóa thành công {$deletedCount} tài khoản.")
                                    ->send();
                            }

                            if ($skippedCount > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->warning()
                                    ->title("Đã bỏ qua {$skippedCount} tài khoản được bảo vệ (Super Admin hoặc tài khoản hiện tại).")
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các tài khoản đã chọn?')
                        ->modalDescription('Các tài khoản được chọn sẽ bị xóa khỏi hệ thống. Tài khoản Super Admin hoặc tài khoản đang đăng nhập sẽ tự động được bảo vệ an toàn.')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
