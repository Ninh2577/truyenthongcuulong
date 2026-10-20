<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\RolePermissionAuditLog;
use App\Services\RolePermissionAuditService;
use App\Services\RolePermissionMatrixHelper;
use App\Services\RolePermissionSecurityService;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    public Collection $permissions;

    public array $oldPermissions = [];

    public string $oldName = '';

    protected function getActions(): array
    {
        return [
            Actions\Action::make('audit_history')
                ->label('Lịch sử vai trò')
                ->icon('heroicon-m-clock')
                ->color('gray')
                ->modalHeading("Lịch sử phân quyền: {$this->record->name}")
                ->modalDescription('Toàn bộ nhật ký audit log thay đổi liên quan đến vai trò này.')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Đóng')
                ->modalWidth('7xl')
                ->modalContent(fn () => view('filament.resources.roles.audit-logs-modal', [
                    'logs' => RolePermissionAuditLog::where(function ($q) {
                        $q->where(function ($q2) {
                            $q2->where('target_type', 'role')->where('target_id', $this->record->id);
                        })->orWhere('target_name', $this->record->name);
                    })->latest('created_at')->limit(100)->get(),
                    'roles' => Role::all(),
                    'targetRole' => $this->record,
                ])),

            Actions\DeleteAction::make()
                ->label('Xóa vai trò')
                ->authorize(fn () => RolePermissionSecurityService::checkCanDeleteRole(auth()->user(), $this->record)['allowed'])
                ->hidden(fn () => RolePermissionSecurityService::isProtectedRole($this->record) || $this->record->users()->count() > 0)
                ->requiresConfirmation()
                ->modalHeading('Xác nhận xóa vai trò?')
                ->modalDescription('Chỉ có thể xóa các vai trò tùy biến không có người dùng nào đang sử dụng.')
                ->before(function () {
                    RolePermissionAuditService::logRoleDeleted($this->record, auth()->user());
                })
                ->after(function () {
                    app(PermissionRegistrar::class)->forgetCachedPermissions();
                }),
        ];
    }

    protected function getSaveFormAction(): Actions\Action
    {
        return parent::getSaveFormAction()
            ->label('Lưu thay đổi phân quyền')
            ->requiresConfirmation()
            ->modalHeading(fn () => "Xác nhận thay đổi phân quyền: {$this->record->name}")
            ->modalDescription(function () {
                $userCount = $this->record->users()->count();
                if ($userCount > 0) {
                    return "⚠️ Thay đổi này sẽ ảnh hưởng trực tiếp đến {$userCount} tài khoản đang sử dụng vai trò này.";
                }
                return 'Kiểm tra kỹ các quyền hạn được thêm mới hoặc gỡ bỏ trước khi áp dụng vào hệ thống.';
            })
            ->modalWidth('4xl')
            ->modalContent(function () {
                $currentPerms = $this->record->permissions->pluck('name')->toArray();
                $formData = $this->form->getRawState();
                $newPerms = collect($formData)
                    ->filter(fn ($val, $key) => str_starts_with($key, 'permissions_'))
                    ->values()
                    ->flatten()
                    ->filter()
                    ->unique()
                    ->values()
                    ->toArray();

                $diff = RolePermissionMatrixHelper::calculatePermissionDiff($currentPerms, $newPerms);
                $userCount = $this->record->users()->count();

                return view('filament.resources.roles.impact-preview-modal', [
                    'role' => $this->record,
                    'diff' => $diff,
                    'userCount' => $userCount,
                ]);
            })
            ->modalSubmitActionLabel('Xác nhận & Cập nhật')
            ->modalCancelActionLabel('Hủy bỏ');
    }

    protected function beforeSave(): void
    {
        if (RolePermissionSecurityService::isProtectedRole($this->record)) {
            if ($this->record->name !== ($this->data['name'] ?? $this->record->name)) {
                Notification::make()
                    ->danger()
                    ->title('Thao tác bị chặn')
                    ->body('Không được phép thay đổi tên vai trò hệ thống cốt lõi.')
                    ->send();

                $this->halt();
            }
        }

        $this->oldPermissions = $this->record->permissions->pluck('name')->toArray();
        $this->oldName = $this->record->name;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->permissions = collect($data)
            ->filter(function ($permission, $key) {
                return ! in_array($key, ['name', 'guard_name', 'select_all', Utils::getTenantModelForeignKey()]);
            })
            ->values()
            ->flatten()
            ->unique();

        if (Arr::has($data, Utils::getTenantModelForeignKey())) {
            return Arr::only($data, ['name', 'guard_name', Utils::getTenantModelForeignKey()]);
        }

        return Arr::only($data, ['name', 'guard_name']);
    }

    protected function afterSave(): void
    {
        $permissionModels = collect();
        $this->permissions->each(function ($permission) use ($permissionModels) {
            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                'name' => $permission,
                'guard_name' => $this->data['guard_name'],
            ]));
        });

        $this->record->syncPermissions($permissionModels);

        // Invalidate Spatie cache immediately
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Audit Log
        RolePermissionAuditService::logRoleUpdated(
            $this->record,
            $this->oldPermissions,
            $this->permissions->toArray(),
            auth()->user(),
            ['name' => $this->oldName],
            ['name' => $this->record->name]
        );
    }
}
