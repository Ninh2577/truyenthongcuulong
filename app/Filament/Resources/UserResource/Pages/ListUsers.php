<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use App\Services\RolePermissionSecurityService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Spatie\Permission\Models\Role;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.list-users';

    public string $search = '';
    public string $selectedRole = '';
    public string $selected2FA = '';
    public string $selectedSort = 'latest'; // 'latest', 'oldest', 'name_asc', 'name_desc'
    public string|int $perPage = 10; // 10, 25, 50, 'all'
    public int $currentPage = 1;
    public string $viewMode = 'list'; // 'list', 'grid'
    public array $selectedUsers = [];
    public bool $selectAll = false;

    // Delete modal confirmation
    public bool $showDeleteModal = false;
    public ?int $userToDeleteId = null;
    public string $userToDeleteName = '';
    public bool $canDeleteTarget = true;
    public string $deleteDenialReason = '';

    public function getHeading(): string|Htmlable
    {
        return '';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Tài khoản quản trị - Cửu Long ID';
    }

    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedRole(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelected2FA(): void
    {
        $this->currentPage = 1;
    }

    public function updatedSelectedSort(): void
    {
        $this->currentPage = 1;
    }

    public function updatedPerPage(): void
    {
        $this->currentPage = 1;
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = in_array($mode, ['list', 'grid']) ? $mode : 'list';
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedRole = '';
        $this->selected2FA = '';
        $this->selectedSort = 'latest';
        $this->currentPage = 1;
        $this->selectedUsers = [];
        $this->selectAll = false;
    }

    public function toggleSelectAll(): void
    {
        $this->selectAll = ! $this->selectAll;
        $data = $this->getDisplayData();
        if ($this->selectAll) {
            $this->selectedUsers = collect($data['users'])->pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function toggleSelectUser(int $id): void
    {
        if (in_array($id, $this->selectedUsers)) {
            $this->selectedUsers = array_values(array_diff($this->selectedUsers, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedUsers[] = $id;
            $data = $this->getDisplayData();
            if (count($this->selectedUsers) === count($data['users'])) {
                $this->selectAll = true;
            }
        }
    }

    public function setPage($page, $pageName = 'page'): void
    {
        $this->currentPage = max(1, (int) $page);
    }

    public function gotoPage($page, $pageName = 'page'): void
    {
        $this->setPage($page, $pageName);
    }

    public function nextPage($pageName = 'page'): void
    {
        $data = $this->getDisplayData();
        if ($this->currentPage < $data['lastPage']) {
            $this->currentPage++;
        }
    }

    public function previousPage($pageName = 'page'): void
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function resetPage($pageName = 'page'): void
    {
        $this->currentPage = 1;
    }

    public function confirmDelete(int $id): void
    {
        $target = User::find($id);
        if (! $target) {
            return;
        }

        $actor = auth()->user();
        $check = RolePermissionSecurityService::checkCanDeleteUser($actor, $target);

        $this->userToDeleteId = $id;
        $this->userToDeleteName = $target->name;
        $this->canDeleteTarget = $check['allowed'];
        $this->deleteDenialReason = $check['reason'] ?? '';
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->userToDeleteId = null;
        $this->userToDeleteName = '';
        $this->canDeleteTarget = true;
        $this->deleteDenialReason = '';
    }

    public function executeDelete(): void
    {
        if (! $this->userToDeleteId) {
            return;
        }

        $target = User::find($this->userToDeleteId);
        if ($target) {
            $actor = auth()->user();
            $check = RolePermissionSecurityService::checkCanDeleteUser($actor, $target);

            if (! $check['allowed']) {
                Notification::make()
                    ->danger()
                    ->title('Thao tác không được phép')
                    ->body($check['reason'])
                    ->send();
                $this->cancelDelete();
                return;
            }

            $name = $target->name;
            $target->delete();

            Notification::make()
                ->success()
                ->title('Xóa tài khoản thành công')
                ->body("Tài khoản \"{$name}\" đã được xóa khỏi hệ thống.")
                ->send();
        }

        $this->cancelDelete();
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        $actor = auth()->user();
        $deleted = 0;
        $skipped = 0;

        foreach ($this->selectedUsers as $id) {
            $u = User::find($id);
            if ($u) {
                $check = RolePermissionSecurityService::checkCanDeleteUser($actor, $u);
                if ($check['allowed']) {
                    $u->delete();
                    $deleted++;
                } else {
                    $skipped++;
                }
            }
        }

        if ($deleted > 0) {
            Notification::make()
                ->success()
                ->title("Đã xóa thành công {$deleted} tài khoản")
                ->send();
        }

        if ($skipped > 0) {
            Notification::make()
                ->warning()
                ->title("Đã bỏ qua {$skipped} tài khoản được bảo vệ (Super Admin hoặc tài khoản hiện tại)")
                ->send();
        }

        $this->selectedUsers = [];
        $this->selectAll = false;
    }

    public function getMetrics(): array
    {
        $total = User::count();
        $admins = User::role(['super_admin', 'Admin'])->count();
        $editors = User::role('Biên Tập Viên')->count();
        $twoFa = User::whereNotNull('two_factor_confirmed_at')->count();

        return [
            'total' => $total,
            'admins' => $admins,
            'editors' => $editors,
            'two_factor' => $twoFa,
        ];
    }

    public function getAvailableRoles(): array
    {
        return Role::all()->pluck('name')->toArray();
    }

    public function getDisplayData(): array
    {
        $query = User::with('roles');

        if (! empty($this->search)) {
            $s = trim($this->search);
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%");
            });
        }

        if (! empty($this->selectedRole)) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', $this->selectedRole);
            });
        }

        if ($this->selected2FA === 'enabled') {
            $query->whereNotNull('two_factor_confirmed_at');
        } elseif ($this->selected2FA === 'disabled') {
            $query->whereNull('two_factor_confirmed_at');
        }

        match ($this->selectedSort) {
            'oldest' => $query->orderBy('created_at', 'asc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $total = $query->count();

        // Handle 'all' pagination
        if ($this->perPage === 'all' || (is_numeric($this->perPage) && (int) $this->perPage <= 0)) {
            $itemsPerPage = max(1, $total);
            $lastPage = 1;
            $currentPage = 1;
            $users = $query->get();
            $from = $total > 0 ? 1 : 0;
            $to = $total;
        } else {
            $itemsPerPage = (int) $this->perPage;
            $lastPage = max(1, (int) ceil($total / $itemsPerPage));
            $currentPage = min($this->currentPage, $lastPage);
            $users = $query->forPage($currentPage, $itemsPerPage)->get();
            $from = $total > 0 ? (($currentPage - 1) * $itemsPerPage) + 1 : 0;
            $to = min($currentPage * $itemsPerPage, $total);
        }

        $currentUser = auth()->user();

        $formattedUsers = $users->map(function ($u) use ($currentUser) {
            $roles = $u->roles->pluck('name')->toArray();
            $check = RolePermissionSecurityService::checkCanDeleteUser($currentUser, $u);

            return [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'roles' => $roles,
                'is_current' => $currentUser && $currentUser->id === $u->id,
                'is_super_admin' => in_array('super_admin', $roles),
                'can_delete' => $check['allowed'],
                'delete_reason' => $check['reason'] ?? '',
                'has_2fa' => (bool) $u->two_factor_confirmed_at,
                'created_at' => $u->created_at?->format('d/m/Y H:i') ?? 'N/A',
                'created_relative' => $u->created_at?->diffForHumans() ?? '',
                'edit_url' => UserResource::getUrl('edit', ['record' => $u->id]),
            ];
        })->toArray();

        return [
            'users' => $formattedUsers,
            'total' => $total,
            'from' => $from,
            'to' => $to,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'pages' => $this->getPaginationPages($currentPage, $lastPage),
        ];
    }

    public function getPaginationPages(int $current, int $last): array
    {
        if ($last <= 7) {
            return range(1, $last);
        }

        if ($current <= 4) {
            return [1, 2, 3, 4, 5, '...', $last];
        }

        if ($current >= $last - 3) {
            return [1, '...', $last - 4, $last - 3, $last - 2, $last - 1, $last];
        }

        return [1, '...', $current - 1, $current, $current + 1, '...', $last];
    }
}
