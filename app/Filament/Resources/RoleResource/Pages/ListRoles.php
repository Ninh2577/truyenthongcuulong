<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\RolePermissionAuditLog;
use App\Services\RolePermissionMatrixHelper;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;
use Spatie\Permission\Models\Role;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('compare_roles')
                ->label('So sánh vai trò')
                ->icon('heroicon-m-arrows-right-left')
                ->color('info')
                ->modalHeading('So Sánh Ma Trận Quyền Giữa 2 Vai Trò')
                ->modalDescription('Đối chiếu quyền giống nhau, khác nhau và phân quyền chi tiết giữa 2 vai trò trong hệ thống.')
                ->modalWidth('7xl')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Đóng')
                ->form([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('role_a')
                                ->label('Vai trò A (Gốc)')
                                ->options(fn () => Role::pluck('name', 'id'))
                                ->default(fn () => Role::first()?->id)
                                ->required()
                                ->live(),
                            Forms\Components\Select::make('role_b')
                                ->label('Vai trò B (Đối chiếu)')
                                ->options(fn () => Role::pluck('name', 'id'))
                                ->default(fn () => Role::skip(1)->first()?->id ?? Role::first()?->id)
                                ->required()
                                ->live(),
                        ]),
                    Forms\Components\Placeholder::make('comparison_matrix')
                        ->label('')
                        ->columnSpanFull()
                        ->content(function ($get) {
                            $roleAId = $get('role_a');
                            $roleBId = $get('role_b');
                            if (! $roleAId || ! $roleBId) {
                                return new HtmlString('<div class="p-4 text-center text-xs text-gray-500">Vui lòng chọn 2 vai trò để đối chiếu.</div>');
                            }
                            $roleA = Role::with('permissions')->find($roleAId);
                            $roleB = Role::with('permissions')->find($roleBId);
                            if (! $roleA || ! $roleB) {
                                return new HtmlString('<div class="p-4 text-center text-xs text-red-500">Không tìm thấy vai trò đã chọn.</div>');
                            }
                            $comparison = RolePermissionMatrixHelper::compareRoles($roleA, $roleB);
                            return view('filament.resources.roles.compare-roles-modal', [
                                'roleA' => $roleA,
                                'roleB' => $roleB,
                                'comparison' => $comparison,
                            ]);
                        }),
                ]),

            Actions\Action::make('audit_logs')
                ->label('Lịch sử phân quyền')
                ->icon('heroicon-m-clipboard-document-list')
                ->color('gray')
                ->modalHeading('Nhật Ký Lịch Sử Phân Quyền (Enterprise Audit Log)')
                ->modalDescription('Theo dõi toàn bộ biến động tạo mới, cập nhật, nhân bản và xóa vai trò & phân quyền trong hệ thống.')
                ->modalWidth('7xl')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Đóng')
                ->modalContent(fn () => view('filament.resources.roles.audit-logs-modal', [
                    'logs' => RolePermissionAuditLog::with('actor')->latest('created_at')->limit(150)->get(),
                    'roles' => Role::all(),
                    'targetRole' => null,
                ])),

            Actions\CreateAction::make()
                ->label('Tạo mới Vai trò & Phân quyền')
                ->icon('heroicon-m-plus'),
        ];
    }
}
