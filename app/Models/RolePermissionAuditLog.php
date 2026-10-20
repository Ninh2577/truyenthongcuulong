<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermissionAuditLog extends Model
{
    protected $table = 'role_permission_audit_logs';

    protected $fillable = [
        'actor_user_id',
        'actor_name',
        'actor_email',
        'action',
        'target_type',
        'target_id',
        'target_name',
        'before_state',
        'after_state',
        'changed_fields',
        'ip_address',
        'user_agent',
        'success',
        'reason',
        'sensitivity_level',
    ];

    protected $casts = [
        'before_state' => 'array',
        'after_state' => 'array',
        'changed_fields' => 'array',
        'success' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public const ACTION_CREATE_ROLE = 'CREATE_ROLE';
    public const ACTION_UPDATE_ROLE = 'UPDATE_ROLE';
    public const ACTION_DELETE_ROLE = 'DELETE_ROLE';
    public const ACTION_CLONE_ROLE = 'CLONE_ROLE';
    public const ACTION_ASSIGN_ROLE_TO_USER = 'ASSIGN_ROLE_TO_USER';
    public const ACTION_REMOVE_ROLE_FROM_USER = 'REMOVE_ROLE_FROM_USER';
    public const ACTION_GRANT_PERMISSION = 'GRANT_PERMISSION';
    public const ACTION_REVOKE_PERMISSION = 'REVOKE_PERMISSION';
    public const ACTION_BULK_PERMISSION_CHANGE = 'BULK_PERMISSION_CHANGE';
    public const ACTION_SUPER_ADMIN_CHANGE = 'SUPER_ADMIN_CHANGE';
    public const ACTION_SENSITIVE_PERMISSION_CHANGE = 'SENSITIVE_PERMISSION_CHANGE';

    public const SENSITIVITY_NORMAL = 'normal';
    public const SENSITIVITY_SENSITIVE = 'sensitive';
    public const SENSITIVITY_CRITICAL = 'critical';

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        $term = trim($term);

        return $query->where(function (Builder $q) use ($term) {
            $q->where('target_name', 'like', "%{$term}%")
                ->orWhere('actor_name', 'like', "%{$term}%")
                ->orWhere('actor_email', 'like', "%{$term}%")
                ->orWhere('action', 'like', "%{$term}%")
                ->orWhere('reason', 'like', "%{$term}%")
                ->orWhere('ip_address', 'like', "%{$term}%");
        });
    }

    public function scopeByActor(Builder $query, ?int $actorId): Builder
    {
        return $actorId ? $query->where('actor_user_id', $actorId) : $query;
    }

    public function scopeByAction(Builder $query, ?string $action): Builder
    {
        return $action ? $query->where('action', $action) : $query;
    }

    public function scopeBySensitivity(Builder $query, ?string $level): Builder
    {
        return $level ? $query->where('sensitivity_level', $level) : $query;
    }

    public function getActionLabel(): string
    {
        return match ($this->action) {
            self::ACTION_CREATE_ROLE => '✨ Tạo vai trò mới',
            self::ACTION_UPDATE_ROLE => '✏️ Cập nhật vai trò',
            self::ACTION_DELETE_ROLE => '🗑️ Xóa vai trò',
            self::ACTION_CLONE_ROLE => '📋 Sao chép vai trò',
            self::ACTION_ASSIGN_ROLE_TO_USER => '👤 Gán vai trò cho tài khoản',
            self::ACTION_REMOVE_ROLE_FROM_USER => '🚫 Gỡ vai trò khỏi tài khoản',
            self::ACTION_GRANT_PERMISSION => '🔓 Cấp quyền hạn',
            self::ACTION_REVOKE_PERMISSION => '🔒 Thu hồi quyền hạn',
            self::ACTION_BULK_PERMISSION_CHANGE => '⚙️ Thay đổi quyền hàng loạt',
            self::ACTION_SUPER_ADMIN_CHANGE => '👑 Can thiệp quyền Super Admin',
            self::ACTION_SENSITIVE_PERMISSION_CHANGE => '⚠️ Thay đổi quyền nhạy cảm',
            default => $this->action,
        };
    }

    public function getSensitivityBadge(): array
    {
        return match ($this->sensitivity_level) {
            self::SENSITIVITY_CRITICAL => [
                'label' => '🔴 Cực kỳ nhạy cảm',
                'color' => 'danger',
                'bg' => 'bg-red-500/10 text-red-600 border border-red-500/20',
            ],
            self::SENSITIVITY_SENSITIVE => [
                'label' => '🟠 Nhạy cảm',
                'color' => 'warning',
                'bg' => 'bg-amber-500/10 text-amber-600 border border-amber-500/20',
            ],
            default => [
                'label' => '🟢 Thông thường',
                'color' => 'success',
                'bg' => 'bg-emerald-500/10 text-emerald-600 border border-emerald-500/20',
            ],
        };
    }

    public function isCritical(): bool
    {
        return $this->sensitivity_level === self::SENSITIVITY_CRITICAL;
    }

    public function isSensitive(): bool
    {
        return $this->sensitivity_level === self::SENSITIVITY_SENSITIVE;
    }
}
