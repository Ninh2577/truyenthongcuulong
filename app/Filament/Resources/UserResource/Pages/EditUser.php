<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa tài khoản')
                ->authorize(fn () => \App\Services\RolePermissionSecurityService::checkCanDeleteUser(auth()->user(), $this->record)['allowed'])
                ->hidden(fn () => auth()->id() === $this->record->id || ($this->record->hasRole('super_admin') && \App\Models\User::role('super_admin')->count() <= 1)),
        ];
    }

    public array $oldRoles = [];

    protected function beforeSave(): void
    {
        $newRoles = $this->data['roles'] ?? [];
        $check = \App\Services\RolePermissionSecurityService::checkCanUpdateUserRoles(auth()->user(), $this->record, $newRoles);
        if (! $check['allowed']) {
            \Filament\Notifications\Notification::make()
                ->danger()
                ->title('Thao tác bị chặn do bảo mật')
                ->body($check['reason'])
                ->persistent()
                ->send();

            $this->halt();
        }

        $this->oldRoles = $this->record->roles->pluck('name')->toArray();
    }

    protected function afterSave(): void
    {
        $newRoles = $this->record->fresh()->roles->pluck('name')->toArray();
        if ($this->oldRoles !== $newRoles) {
            \App\Services\RolePermissionAuditService::logUserRolesChanged(
                $this->record,
                $this->oldRoles,
                $newRoles,
                auth()->user()
            );
        }
    }
}
