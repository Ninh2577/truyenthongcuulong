<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\User;
use App\Services\RolePermissionMatrixHelper;
use App\Services\RolePermissionSecurityService;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Role::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'CẤU HÌNH & HỆ THỐNG';

    protected static ?string $navigationLabel = 'Phân quyền';

    protected static ?string $modelLabel = 'Vai trò & Phân quyền';

    protected static ?string $pluralModelLabel = 'Danh sách Vai trò & Phân quyền';

    protected static ?int $navigationSort = 6;

    protected static ?string $slug = 'shield/roles';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông Tin Vai Trò')
                    ->description('Thiết lập định danh và cấu hình bảo mật cơ sở của vai trò.')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Tên vai trò (Định danh)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->disabled(fn (?Role $record) => $record && RolePermissionSecurityService::isProtectedRole($record))
                                    ->helperText(fn (?Role $record) => $record && RolePermissionSecurityService::isProtectedRole($record)
                                        ? '🛡️ Vai trò hệ thống cốt lõi không được phép đổi tên.'
                                        : 'Nhập tên nhận diện vai trò trong hệ thống.'),

                                Forms\Components\TextInput::make('guard_name')
                                    ->label('Cổng bảo vệ (Guard)')
                                    ->default('web')
                                    ->disabled()
                                    ->dehydrated()
                                    ->helperText('Hệ thống hoạt động với guard "web".'),

                                Forms\Components\Placeholder::make('role_badge')
                                    ->label('Phân loại vai trò')
                                    ->content(function (?Role $record) {
                                        if (! $record) {
                                            return new HtmlString('<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200">⚙️ Vai trò mới tùy biến</span>');
                                        }

                                        $badge = RolePermissionSecurityService::getRoleBadgeInfo($record);
                                        $desc = RolePermissionSecurityService::getRoleDescription($record);

                                        return new HtmlString("
                                            <div class='space-y-1'>
                                                <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold text-white " . match ($badge['color']) {
                                                    'danger' => 'bg-red-600',
                                                    'warning' => 'bg-amber-500',
                                                    'info' => 'bg-blue-600',
                                                    default => 'bg-slate-500'
                                                } . "'>{$badge['label']}</span>
                                                <p class='text-xs text-gray-500 dark:text-gray-400'>{$desc}</p>
                                            </div>
                                        ");
                                    }),
                            ]),
                    ]),

                Forms\Components\Tabs::make('Ma Trận Phân Quyền Chi Tiết')
                    ->contained()
                    ->columnSpanFull()
                    ->tabs([
                        // Tab 1: Nội dung & Tin tức (Gồm 3 Resources + Thư viện Media)
                        Forms\Components\Tabs\Tab::make('tab_content')
                            ->label('📰 Nội Dung & Tin Tức')
                            ->badge('4 phân hệ')
                            ->schema(array_merge(
                                static::buildResourceGroupSchema(RolePermissionMatrixHelper::GROUP_CONTENT),
                                [static::buildMediaLibrarySection()]
                            )),

                        // Tab 2: Dịch vụ & Khách hàng (4 Resources: Dịch vụ, Dự án, Bảng giá, Khách hàng)
                        Forms\Components\Tabs\Tab::make('tab_business')
                            ->label('💼 Dịch Vụ & Khách Hàng')
                            ->badge('4 phân hệ')
                            ->schema(static::buildResourceGroupSchema(RolePermissionMatrixHelper::GROUP_BUSINESS)),

                        // Tab 3: Chat, CSKH & Tuyển dụng (Yêu cầu tư vấn, Tuyển dụng, Hộp thư, Khách online, Kịch bản, Spam, AI Bot)
                        Forms\Components\Tabs\Tab::make('tab_communication')
                            ->label('💬 Chat, CSKH & Tuyển Dụng')
                            ->badge('7 phân hệ')
                            ->schema(array_merge(
                                static::buildResourceGroupSchema(RolePermissionMatrixHelper::GROUP_COMMUNICATION),
                                [static::buildCommunicationPagesSection()]
                            )),

                        // Tab 4: Cấu hình & Hệ thống (Đối tác, Menu, SEO 301, Cài đặt, Schema SEO, Tài khoản, Phân quyền)
                        Forms\Components\Tabs\Tab::make('tab_system')
                            ->label('⚙️ Cấu Hình & Hệ Thống')
                            ->badge('Bảo mật cao')
                            ->schema(array_merge(
                                static::buildResourceGroupSchema(RolePermissionMatrixHelper::GROUP_SYSTEM),
                                [static::buildSystemPagesSection()]
                            )),

                        // Tab 5: Bảng điều khiển & Widget
                        Forms\Components\Tabs\Tab::make('tab_dashboard')
                            ->label('📊 Dashboard & Báo Cáo')
                            ->badge('7 tiện ích')
                            ->schema([static::buildDashboardWidgetsSection()]),
                    ]),
            ]);
    }

    /**
     * Tạo schema cho nhóm Resource với nhãn checkbox tinh gọn, không lặp lại tên module
     */
    protected static function buildResourceGroupSchema(string $group): array
    {
        $resources = collect(RolePermissionMatrixHelper::getResourceRegistry())
            ->filter(fn ($config) => $config['group'] === $group);

        $actions = RolePermissionMatrixHelper::getActionLabels();

        $sections = [];

        foreach ($resources as $resKey => $resConfig) {
            $permissionOptions = [];
            $allPermKeys = [];
            $viewOnlyKeys = [];

            foreach ($actions as $actionKey => $actionLabel) {
                $permKey = "{$actionKey}_{$resKey}";
                // Nhãn tinh gọn: Không lặp lại tên module trong từng checkbox
                $permissionOptions[$permKey] = $actionLabel;
                $allPermKeys[] = $permKey;
                if (in_array($actionKey, ['view', 'view_any'], true)) {
                    $viewOnlyKeys[] = $permKey;
                }
            }

            $fieldName = 'permissions_' . str_replace('::', '_', $resKey);
            $isSensitive = ! empty($resConfig['sensitive']);

            $sections[] = Forms\Components\Section::make($resConfig['name'])
                ->description(new HtmlString(
                    $isSensitive
                        ? "<span class='text-amber-600 dark:text-amber-400 font-semibold'>⚠️ PHÂN HỆ QUẢN TRỊ NHẠY CẢM:</span> {$resConfig['description']}"
                        : $resConfig['description']
                ))
                ->icon($resConfig['icon'])
                ->collapsible()
                ->compact()
                ->headerActions([
                    Forms\Components\Actions\Action::make('select_view_only_' . $fieldName)
                        ->label('Chỉ xem')
                        ->icon('heroicon-m-eye')
                        ->size('xs')
                        ->color('gray')
                        ->action(fn (Set $set) => $set($fieldName, $viewOnlyKeys)),

                    Forms\Components\Actions\Action::make('select_all_' . $fieldName)
                        ->label('Toàn quyền')
                        ->icon('heroicon-m-check-badge')
                        ->size('xs')
                        ->color('primary')
                        ->action(fn (Set $set) => $set($fieldName, $allPermKeys)),

                    Forms\Components\Actions\Action::make('deselect_all_' . $fieldName)
                        ->label('Bỏ chọn')
                        ->icon('heroicon-m-x-mark')
                        ->size('xs')
                        ->color('danger')
                        ->action(fn (Set $set) => $set($fieldName, [])),
                ])
                ->schema([
                    Forms\Components\CheckboxList::make($fieldName)
                        ->label('')
                        ->options($permissionOptions)
                        ->columns([
                            'default' => 2,
                            'sm' => 3,
                            'lg' => 6,
                        ])
                        ->afterStateHydrated(function (Forms\Components\CheckboxList $component, ?Role $record) use ($allPermKeys) {
                            if (! $record) {
                                return;
                            }
                            $component->state(
                                $record->permissions->whereIn('name', $allPermKeys)->pluck('name')->toArray()
                            );
                        })
                        ->dehydrated(fn ($state) => is_array($state)),
                ]);
        }

        return $sections;
    }

    /**
     * Section cho Thư viện Media (thuộc nhóm Nội Dung & Tin Tức)
     */
    protected static function buildMediaLibrarySection(): Forms\Components\Section
    {
        $fieldName = 'permissions_page_media';
        $keys = ['page_MediaLibrary'];
        $options = [
            'page_MediaLibrary' => 'Truy cập Thư Viện Media (Quản lý hình ảnh, video và tệp tin tải lên website)',
        ];

        return Forms\Components\Section::make('Thư Viện Media & Tệp Tin')
            ->description('Khu vực upload và quản lý các tài nguyên đa phương tiện dùng trong bài viết.')
            ->icon('heroicon-o-photo')
            ->collapsible()
            ->compact()
            ->headerActions([
                Forms\Components\Actions\Action::make('select_all_' . $fieldName)
                    ->label('Cấp quyền')
                    ->size('xs')
                    ->color('primary')
                    ->action(fn (Set $set) => $set($fieldName, $keys)),

                Forms\Components\Actions\Action::make('deselect_all_' . $fieldName)
                    ->label('Bỏ chọn')
                    ->size('xs')
                    ->color('danger')
                    ->action(fn (Set $set) => $set($fieldName, [])),
            ])
            ->schema([
                Forms\Components\CheckboxList::make($fieldName)
                    ->label('')
                    ->options($options)
                    ->columns(1)
                    ->afterStateHydrated(function (Forms\Components\CheckboxList $component, ?Role $record) use ($keys) {
                        if (! $record) {
                            return;
                        }
                        $component->state(
                            $record->permissions->whereIn('name', $keys)->pluck('name')->toArray()
                        );
                    })
                    ->dehydrated(fn ($state) => is_array($state)),
            ]);
    }

    /**
     * Tạo section cho các Pages Chat & CSKH
     */
    protected static function buildCommunicationPagesSection(): Forms\Components\Section
    {
        $pages = collect(RolePermissionMatrixHelper::getPageRegistry())
            ->filter(fn ($config) => $config['group'] === RolePermissionMatrixHelper::GROUP_COMMUNICATION);

        $options = [];
        $keys = [];
        foreach ($pages as $permKey => $config) {
            $options[$permKey] = "{$config['name']} — {$config['description']}";
            $keys[] = $permKey;
        }

        $fieldName = 'permissions_pages_communication';

        return Forms\Components\Section::make('Kênh Tương Tác Trực Tuyến & Bot AI')
            ->description('Quyền truy cập các màn hình tiếp nhận và tương tác với khách hàng trực tuyến.')
            ->icon('heroicon-o-chat-bubble-bottom-center-text')
            ->collapsible()
            ->compact()
            ->headerActions([
                Forms\Components\Actions\Action::make('select_all_' . $fieldName)
                    ->label('Cấp toàn bộ')
                    ->size('xs')
                    ->color('primary')
                    ->action(fn (Set $set) => $set($fieldName, $keys)),

                Forms\Components\Actions\Action::make('deselect_all_' . $fieldName)
                    ->label('Bỏ chọn')
                    ->size('xs')
                    ->color('danger')
                    ->action(fn (Set $set) => $set($fieldName, [])),
            ])
            ->schema([
                Forms\Components\CheckboxList::make($fieldName)
                    ->label('')
                    ->options($options)
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                    ])
                    ->afterStateHydrated(function (Forms\Components\CheckboxList $component, ?Role $record) use ($keys) {
                        if (! $record) {
                            return;
                        }
                        $component->state(
                            $record->permissions->whereIn('name', $keys)->pluck('name')->toArray()
                        );
                    })
                    ->dehydrated(fn ($state) => is_array($state)),
            ]);
    }

    /**
     * Tạo section cho các Pages Cấu hình hệ thống (Cài đặt, Schema SEO)
     */
    protected static function buildSystemPagesSection(): Forms\Components\Section
    {
        $pages = collect(RolePermissionMatrixHelper::getPageRegistry())
            ->filter(fn ($config) => $config['group'] === RolePermissionMatrixHelper::GROUP_SYSTEM);

        $options = [];
        $keys = [];
        foreach ($pages as $permKey => $config) {
            $prefix = ! empty($config['sensitive']) ? '🔒 ' : '';
            $options[$permKey] = "{$prefix}{$config['name']} — {$config['description']}";
            $keys[] = $permKey;
        }

        $fieldName = 'permissions_pages_system';

        return Forms\Components\Section::make('Trang Cài Đặt Chung & Cấu Hình SEO')
            ->description(new HtmlString("<span class='text-amber-600 dark:text-amber-400 font-semibold'>⚠️ QUẢN TRỊ NỀN TẢNG:</span> Quyền can thiệp vào cài đặt lõi công ty và cấu hình SEO Schema."))
            ->icon('heroicon-o-cog')
            ->collapsible()
            ->compact()
            ->headerActions([
                Forms\Components\Actions\Action::make('select_all_' . $fieldName)
                    ->label('Cấp toàn bộ')
                    ->size('xs')
                    ->color('primary')
                    ->action(fn (Set $set) => $set($fieldName, $keys)),

                Forms\Components\Actions\Action::make('deselect_all_' . $fieldName)
                    ->label('Bỏ chọn')
                    ->size('xs')
                    ->color('danger')
                    ->action(fn (Set $set) => $set($fieldName, [])),
            ])
            ->schema([
                Forms\Components\CheckboxList::make($fieldName)
                    ->label('')
                    ->options($options)
                    ->columns(1)
                    ->afterStateHydrated(function (Forms\Components\CheckboxList $component, ?Role $record) use ($keys) {
                        if (! $record) {
                            return;
                        }
                        $component->state(
                            $record->permissions->whereIn('name', $keys)->pluck('name')->toArray()
                        );
                    })
                    ->dehydrated(fn ($state) => is_array($state)),
            ]);
    }

    /**
     * Tạo section cho Dashboard Widgets
     */
    protected static function buildDashboardWidgetsSection(): Forms\Components\Section
    {
        $widgets = RolePermissionMatrixHelper::getWidgetRegistry();

        $options = [];
        $keys = [];
        foreach ($widgets as $permKey => $config) {
            $options[$permKey] = "{$config['name']} ({$config['description']})";
            $keys[] = $permKey;
        }

        $fieldName = 'permissions_widgets';

        return Forms\Components\Section::make('Tiện Ích Dashboard (Bảng Điều Khiển)')
            ->description('Chọn các thẻ số liệu và widget cho phép vai trò này nhìn thấy khi truy cập trang chủ quản trị.')
            ->icon('heroicon-o-chart-bar')
            ->collapsible()
            ->compact()
            ->headerActions([
                Forms\Components\Actions\Action::make('select_all_' . $fieldName)
                    ->label('Hiển thị tất cả')
                    ->size('xs')
                    ->color('primary')
                    ->action(fn (Set $set) => $set($fieldName, $keys)),

                Forms\Components\Actions\Action::make('deselect_all_' . $fieldName)
                    ->label('Ẩn tất cả')
                    ->size('xs')
                    ->color('danger')
                    ->action(fn (Set $set) => $set($fieldName, [])),
            ])
            ->schema([
                Forms\Components\CheckboxList::make($fieldName)
                    ->label('')
                    ->options($options)
                    ->columns(2)
                    ->afterStateHydrated(function (Forms\Components\CheckboxList $component, ?Role $record) use ($keys) {
                        if (! $record) {
                            return;
                        }
                        $component->state(
                            $record->permissions->whereIn('name', $keys)->pluck('name')->toArray()
                        );
                    })
                    ->dehydrated(fn ($state) => is_array($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Vai trò')
                    ->weight('font-bold')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => Str::headline($state))
                    ->description(fn (Role $record) => "Mã: {$record->name}"),

                Tables\Columns\TextColumn::make('role_type')
                    ->label('Loại vai trò')
                    ->badge()
                    ->getStateUsing(fn (Role $record) => RolePermissionSecurityService::getRoleBadgeInfo($record)['label'])
                    ->color(fn (Role $record) => RolePermissionSecurityService::getRoleBadgeInfo($record)['color'])
                    ->icon(fn (Role $record) => RolePermissionSecurityService::getRoleBadgeInfo($record)['icon']),

                Tables\Columns\TextColumn::make('users_count')
                    ->label('Thành viên')
                    ->counts('users')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'info' : 'gray')
                    ->icon('heroicon-m-users')
                    ->formatStateUsing(fn ($state) => "{$state} thành viên")
                    ->action(
                        Tables\Actions\Action::make('view_members')
                            ->modalHeading(fn (Role $record) => 'Thành viên đang giữ vai trò: ' . Str::headline($record->name))
                            ->modalDescription('Danh sách các tài khoản đang được phân quyền giữ vai trò này.')
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Đóng')
                            ->modalWidth('3xl')
                            ->modalContent(fn (Role $record) => view('filament.resources.roles.view-members-modal', [
                                'role' => $record,
                                'users' => $record->users()->latest()->limit(50)->get(),
                            ]))
                    ),

                Tables\Columns\TextColumn::make('permissions_count')
                    ->label('Quyền hiệu lực')
                    ->counts('permissions')
                    ->badge()
                    ->color(fn ($state) => $state >= 105 ? 'success' : ($state > 0 ? 'primary' : 'gray'))
                    ->formatStateUsing(fn ($state) => $state >= 105 ? "Toàn quyền ({$state})" : "{$state} quyền")
                    ->tooltip(fn ($state) => "{$state} / 105 quyền hạn có hiệu lực"),

                Tables\Columns\TextColumn::make('description')
                    ->label('Mô tả phạm vi')
                    ->getStateUsing(fn (Role $record) => RolePermissionSecurityService::getRoleDescription($record))
                    ->color('gray')
                    ->wrap(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật lần cuối')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('guard_name')
                    ->label('Cổng bảo vệ')
                    ->badge()
                    ->color('warning')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_type_filter')
                    ->label('Lọc theo loại vai trò')
                    ->options([
                        'system' => '🛡️ Vai trò hệ thống',
                        'business' => '💼 Vai trò nghiệp vụ',
                        'custom' => '⚙️ Vai trò tùy biến',
                    ])
                    ->query(function (Builder $query, array $data) {
                        $value = $data['value'] ?? null;
                        if ($value === 'system') {
                            $query->whereIn('name', RolePermissionSecurityService::CORE_ADMIN_ROLES);
                        } elseif ($value === 'business') {
                            $query->whereIn('name', RolePermissionSecurityService::BUSINESS_ROLES);
                        } elseif ($value === 'custom') {
                            $allKnown = array_merge(RolePermissionSecurityService::CORE_ADMIN_ROLES, RolePermissionSecurityService::BUSINESS_ROLES);
                            $query->whereNotIn('name', $allKnown);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Chỉnh sửa')
                    ->color('primary'),

                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->color('danger')
                    ->authorize(fn (Role $record) => RolePermissionSecurityService::checkCanDeleteRole(auth()->user(), $record)['allowed'])
                    ->hidden(fn (Role $record) => RolePermissionSecurityService::isProtectedRole($record) || $record->users()->count() > 0)
                    ->requiresConfirmation()
                    ->modalHeading(fn (Role $record) => "Xóa vai trò '{$record->name}'?")
                    ->modalDescription('Thao tác này sẽ xóa vĩnh viễn vai trò khỏi hệ thống. Chỉ cho phép xóa các vai trò không có thành viên nào đang sử dụng.')
                    ->modalSubmitActionLabel('Xác nhận xóa vai trò')
                    ->modalCancelActionLabel('Hủy bỏ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa các vai trò đã chọn')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $deletedCount = 0;
                            $skippedCount = 0;

                            foreach ($records as $record) {
                                $check = RolePermissionSecurityService::checkCanDeleteRole(auth()->user(), $record);
                                if ($check['allowed']) {
                                    $record->delete();
                                    $deletedCount++;
                                } else {
                                    $skippedCount++;
                                }
                            }

                            if ($deletedCount > 0) {
                                Notification::make()
                                    ->success()
                                    ->title("Đã xóa thành công {$deletedCount} vai trò.")
                                    ->send();
                            }

                            if ($skippedCount > 0) {
                                Notification::make()
                                    ->warning()
                                    ->title("Đã bỏ qua {$skippedCount} vai trò được bảo vệ hoặc đang có người dùng.")
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Xóa các vai trò đã chọn?')
                        ->modalDescription('Hệ thống sẽ tự động bỏ qua và bảo vệ tuyệt đối các vai trò hệ thống hoặc vai trò đang có tài khoản sử dụng.')
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
