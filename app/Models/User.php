<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticatable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasPanelShield, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Panel access is granted to anyone with the super_admin role,
        // or any of the existing administrative roles, or if it's the root admin account.
        // Resource-specific access is handled by Policies and Permissions.
        
        if ($this->email === 'admin@truyenthongcuulong.com') {
            return true;
        }
        return $this->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên', 'Cộng Tác Viên']);
    }

    /**
     * Override trait method to fix vendor missing namespace import for RecoveryCode.
     * Ensures recovery codes are single-use by removing the consumed code.
     */
    public function replaceRecoveryCode(string $code): void
    {
        $newCode = \Stephenjude\FilamentTwoFactorAuthentication\Actions\RecoveryCode::generate();
        $currentCodes = json_decode(decrypt($this->two_factor_recovery_codes), true) ?: [];

        $updatedCodes = array_values(array_filter($currentCodes, fn ($c) => ! hash_equals((string) $c, (string) $code)));
        $updatedCodes[] = $newCode;

        $this->forceFill([
            'two_factor_recovery_codes' => encrypt(json_encode($updatedCodes)),
        ]);

        if ($this->exists) {
            $this->save();
        }

        event(new \Stephenjude\FilamentTwoFactorAuthentication\Events\RecoveryCodeReplaced($this, $code));
    }
}
