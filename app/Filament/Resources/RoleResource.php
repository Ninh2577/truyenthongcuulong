<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\RolePermissionAuditLog;
use App\Models\User;
use App\Services\RolePermissionAuditService;
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
use Spatie\Permission\PermissionRegistrar;

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

                Forms\Components\Placeholder::make('permission_matrix_toolbar')
                    ->label('')
                    ->columnSpanFull()
                    ->content(new HtmlString('
                        <div class="p-3.5 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm space-y-3" x-data="{
                            permQuery: \'\',
                            filterPermissions() {
                                const q = this.permQuery.trim().toLowerCase();
                                const container = document.querySelector(\'.fi-fo-tabs\') || document.querySelector(\'.filament-forms-tabs-component\') || document;
                                const items = container.querySelectorAll(\'label.fi-fo-checkbox-list-option, .fi-fo-checkbox-list-option\');
                                
                                items.forEach(el => {
                                    const text = el.textContent.toLowerCase();
                                    if (!q || text.includes(q)) {
                                        el.style.display = \'\';
                                    } else {
                                        el.style.display = \'none\';
                                    }
                                });
                            }
                        }">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="relative flex-1 max-w-md">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <input
                                        type="text"
                                        x-model="permQuery"
                                        @input="filterPermissions()"
                                        placeholder="🔍 Tìm nhanh quyền hạn theo từ khóa, module, hành động..."
                                        class="w-full pl-9 pr-3 py-1.5 text-xs rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#FF5400] focus:border-[#FF5400] transition"
                                    />
                                </div>
                                
                                <div class="flex flex-wrap items-center gap-2 text-xs">
                                    <span class="font-bold text-gray-700 dark:text-gray-300">Phân loại nhạy cảm:</span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 font-semibold border border-emerald-200 dark:border-emerald-800">
                                        🟢 Thông thường
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 font-semibold border border-amber-200 dark:border-amber-800">
                                        🟠 Nhạy cảm
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-400 font-semibold border border-red-200 dark:border-red-800">
                                        🔴 Cực kỳ nhạy cảm
                                    </span>
                                </div>
                            </div>
                            <div x-show="permQuery.length > 0" x-cloak class="text-[11px] text-gray-500 flex items-center justify-between">
                                <span>Đang lọc theo: <b class="text-[#FF5400]" x-text="permQuery"></b></span>
                                <button type="button" @click="permQuery = \'\'; filterPermissions()" class="text-xs text-red-500 hover:underline">Xóa bộ lọc</button>
                            </div>
                        </div>
                    ')),

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
                $sens = RolePermissionMatrixHelper::getPermissionSensitivity($permKey);
                $icon = match ($sens) {
                    RolePermissionMatrixHelper::LEVEL_CRITICAL => '🔴',
                    RolePermissionMatrixHelper::LEVEL_SENSITIVE => '🟠',
                    default => '🟢',
                };
                // Nhãn tinh gọn kèm phân loại an ninh
                $permissionOptions[$permKey] = "{$icon} {$actionLabel}";
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
            'page_MediaLibrary' => '🟢 Truy cập Thư Viện Media (Quản lý hình ảnh, video và tệp tin tải lên website)',
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
            $sens = RolePermissionMatrixHelper::getPermissionSensitivity($permKey);
            $icon = match ($sens) {
                RolePermissionMatrixHelper::LEVEL_CRITICAL => '🔴',
                RolePermissionMatrixHelper::LEVEL_SENSITIVE => '🟠',
                default => '🟢',
            };
            $options[$permKey] = "{$icon} {$config['name']} — {$config['description']}";
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
            $sens = RolePermissionMatrixHelper::getPermissionSensitivity($permKey);
            $icon = match ($sens) {
                RolePermissionMatrixHelper::LEVEL_CRITICAL => '🔴',
                RolePermissionMatrixHelper::LEVEL_SENSITIVE => '🟠',
                default => '🟢',
            };
            $options[$permKey] = "{$icon} {$config['name']} — {$config['description']}";
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
            $sens = RolePermissionMatrixHelper::getPermissionSensitivity($permKey);
            $icon = match ($sens) {
                RolePermissionMatrixHelper::LEVEL_CRITICAL => '🔴',
                RolePermissionMatrixHelper::LEVEL_SENSITIVE => '🟠',
                default => '🟢',
            };
            $options[$permKey] = "{$icon} {$config['name']} ({$config['description']})";
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
                Tables\Actions\ViewAction::make()
                    ->label('Xem chi tiết'),

                Tables\Actions\EditAction::make()
                    ->label('Chỉnh sửa')
                    ->color('primary'),

                Tables\Actions\Action::make('clone')
                    ->label('Sao chép')
                    ->icon('heroicon-m-document-duplicate')
                    ->color('warning')
                    ->authorize(fn () => auth()->user()->can('create_shield::role'))
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên vai trò mới (Định danh)')
                            ->required()
                            ->unique(Role::class, 'name')
                            ->maxLength(255)
                            ->default(fn (Role $record) => $record->name . ' (Bản sao)')
                            ->helperText('Định danh duy nhất của vai trò mới được sao chép.'),

                        Forms\Components\Placeholder::make('clone_info')
                            ->label('Quy chuẩn kế thừa Enterprise')
                            ->content(function (Role $record) {
                                $permCount = $record->permissions()->count();
                                return new HtmlString("
                                    <div class='p-3.5 bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800 rounded-xl text-xs space-y-1.5 text-gray-700 dark:text-gray-300'>
                                        <div class='font-bold text-amber-800 dark:text-amber-400'>📋 Nguyên tắc bảo mật kế thừa:</div>
                                        <div>✓ Sao chép toàn bộ <b>{$permCount} quyền hạn</b> từ vai trò: <b>{$record->name}</b>.</div>
                                        <div>❌ <b>KHÔNG</b> gán lại người dùng (Bắt đầu với 0 thành viên).</div>
                                        <div>❌ <b>KHÔNG</b> kế thừa đặc quyền hệ thống cốt lõi (Core System Protected).</div>
                                    </div>
                                ");
                            }),
                    ])
                    ->modalHeading(fn (Role $record) => "Sao chép vai trò: {$record->name}")
                    ->modalSubmitActionLabel('Tạo vai trò bản sao')
                    ->modalCancelActionLabel('Hủy bỏ')
                    ->action(function (Role $record, array $data) {
                        $user = auth()->user();

                        // Privilege escalation protection
                        if (! $user->hasRole('super_admin') && $record->name === 'super_admin') {
                            Notification::make()
                                ->danger()
                                ->title('Thao tác bị từ chối')
                                ->body('Chỉ có Super Admin mới có quyền nhân bản cấu hình của vai trò Super Admin.')
                                ->send();
                            return;
                        }

                        $newRole = Role::create([
                            'name' => $data['name'],
                            'guard_name' => $record->guard_name,
                        ]);

                        $permissions = $record->permissions;
                        $newRole->syncPermissions($permissions);

                        // Invalidate Spatie permission cache
                        app(PermissionRegistrar::class)->forgetCachedPermissions();

                        // Audit Log
                        RolePermissionAuditService::logRoleCloned(
                            $record,
                            $newRole,
                            $permissions->pluck('name')->toArray(),
                            $user
                        );

                        Notification::make()
                            ->success()
                            ->title("Đã nhân bản vai trò thành công: {$newRole->name}")
                            ->body("Kế thừa thành công {$permissions->count()} quyền hạn.")
                            ->send();
                    }),

                Tables\Actions\Action::make('audit_history')
                    ->label('Lịch sử')
                    ->icon('heroicon-m-clock')
                    ->color('gray')
                    ->modalHeading(fn (Role $record) => "Lịch sử phân quyền: {$record->name}")
                    ->modalDescription('Toàn bộ nhật ký audit log thay đổi liên quan đến vai trò này.')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Đóng')
                    ->modalWidth('7xl')
                    ->modalContent(fn (Role $record) => view('filament.resources.roles.audit-logs-modal', [
                        'logs' => RolePermissionAuditLog::where(function ($q) use ($record) {
                            $q->where(function ($q2) use ($record) {
                                $q2->where('target_type', 'role')->where('target_id', $record->id);
                            })->orWhere('target_name', $record->name);
                        })->latest('created_at')->limit(100)->get(),
                        'roles' => Role::all(),
                        'targetRole' => $record,
                    ])),

                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->color('danger')
                    ->authorize(fn (Role $record) => RolePermissionSecurityService::checkCanDeleteRole(auth()->user(), $record)['allowed'])
                    ->hidden(fn (Role $record) => RolePermissionSecurityService::isProtectedRole($record) || $record->users()->count() > 0)
                    ->requiresConfirmation()
                    ->modalHeading(fn (Role $record) => "Xóa vai trò '{$record->name}'?")
                    ->modalDescription('Thao tác này sẽ xóa vĩnh viễn vai trò khỏi hệ thống. Chỉ cho phép xóa các vai trò không có thành viên nào đang sử dụng.')
                    ->before(function (Role $record) {
                        RolePermissionAuditService::logRoleDeleted($record, auth()->user());
                    })
                    ->after(function () {
                        app(PermissionRegistrar::class)->forgetCachedPermissions();
                    })
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
                                    RolePermissionAuditService::logRoleDeleted($record, auth()->user());
                                    $record->delete();
                                    $deletedCount++;
                                } else {
                                    $skippedCount++;
                                }
                            }

                            if ($deletedCount > 0) {
                                app(PermissionRegistrar::class)->forgetCachedPermissions();

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
