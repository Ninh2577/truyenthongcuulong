<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRole extends ViewRecord
{
    protected static string $resource = RoleResource::class;

    protected static string $view = 'filament.resources.roles.view-role';

    protected function getViewData(): array
    {
        $role = $this->record;
        $users = $role->users()->latest()->limit(100)->get();
        $auditLogs = \App\Models\RolePermissionAuditLog::where(function ($q) use ($role) {
            $q->where(function ($q2) use ($role) {
                $q2->where('target_type', 'role')->where('target_id', $role->id);
            })->orWhere('target_name', $role->name);
        })->latest('created_at')->limit(50)->get();

        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $allPermissions = \App\Services\RolePermissionMatrixHelper::getAllPermissionsMetadata();

        return [
            'role' => $role,
            'badgeInfo' => \App\Services\RolePermissionSecurityService::getRoleBadgeInfo($role),
            'description' => \App\Services\RolePermissionSecurityService::getRoleDescription($role),
            'isProtected' => \App\Services\RolePermissionSecurityService::isProtectedRole($role),
            'users' => $users,
            'usersCount' => $role->users()->count(),
            'auditLogs' => $auditLogs,
            'rolePermissions' => $rolePermissions,
            'allPermissions' => $allPermissions,
            'functionalGroups' => \App\Services\RolePermissionMatrixHelper::getFunctionalGroups(),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Chỉnh sửa'),
        ];
    }
}
