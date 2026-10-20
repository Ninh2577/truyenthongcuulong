<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    public Collection $permissions;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa vai trò')
                ->authorize(fn () => \App\Services\RolePermissionSecurityService::checkCanDeleteRole(auth()->user(), $this->record)['allowed'])
                ->hidden(fn () => \App\Services\RolePermissionSecurityService::isProtectedRole($this->record) || $this->record->users()->count() > 0)
                ->requiresConfirmation()
                ->modalHeading('Xác nhận xóa vai trò?')
                ->modalDescription('Chỉ có thể xóa các vai trò tùy biến không có người dùng nào đang sử dụng.'),
        ];
    }

    protected function beforeSave(): void
    {
        if (\App\Services\RolePermissionSecurityService::isProtectedRole($this->record)) {
            if ($this->record->name !== ($this->data['name'] ?? $this->record->name)) {
                \Filament\Notifications\Notification::make()
                    ->danger()
                    ->title('Thao tác bị chặn')
                    ->body('Không được phép thay đổi tên vai trò hệ thống cốt lõi.')
                    ->send();

                $this->halt();
            }
        }
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
    }
}
