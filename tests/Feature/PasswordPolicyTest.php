<?php

namespace Tests\Feature;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class PasswordPolicyTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        Filament::setCurrentPanel(Filament::getPanel('admin'));
        $this->admin = User::where('email', 'admin@truyenthongcuulong.com')->first();
        $this->actingAs($this->admin);
        Filament::auth()->setUser($this->admin);
    }

    /**
     * P-01: Valid password (>= 12 characters, confirmed) is accepted on user creation.
     */
    public function test_p01_valid_password_accepted(): void
    {
        $testEmail = 'p01_valid_' . uniqid() . '@example.com';

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Valid Pwd User',
                'email' => $testEmail,
                'password' => 'SecurePassphrase2026!',
                'password_confirmation' => 'SecurePassphrase2026!',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $created = User::where('email', $testEmail)->first();
        $this->assertNotNull($created);
        $this->assertTrue(Hash::check('SecurePassphrase2026!', $created->password));

        // Cleanup
        $created->delete();
    }

    /**
     * P-02: Password shorter than 12 characters is rejected.
     */
    public function test_p02_short_password_rejected(): void
    {
        $testEmail = 'p02_short_' . uniqid() . '@example.com';

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Short Pwd User',
                'email' => $testEmail,
                'password' => 'Short123!',
                'password_confirmation' => 'Short123!',
            ])
            ->call('create')
            ->assertHasFormErrors(['password']);

        $this->assertNull(User::where('email', $testEmail)->first());
    }

    /**
     * P-03: Long passphrase (e.g. 50+ characters) is accepted.
     */
    public function test_p03_long_passphrase_accepted(): void
    {
        $testEmail = 'p03_long_' . uniqid() . '@example.com';
        $longPassphrase = 'This-is-a-very-long-and-secure-passphrase-exceeding-fifty-characters-2026!';

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Long Passphrase User',
                'email' => $testEmail,
                'password' => $longPassphrase,
                'password_confirmation' => $longPassphrase,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $created = User::where('email', $testEmail)->first();
        $this->assertNotNull($created);
        $this->assertTrue(Hash::check($longPassphrase, $created->password));

        // Cleanup
        $created->delete();
    }

    /**
     * P-04: Password confirmation mismatch is rejected.
     */
    public function test_p04_password_confirmation_mismatch_rejected(): void
    {
        $testEmail = 'p04_mismatch_' . uniqid() . '@example.com';

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Mismatch Pwd User',
                'email' => $testEmail,
                'password' => 'CorrectPassword123!',
                'password_confirmation' => 'DifferentPassword123!',
            ])
            ->call('create')
            ->assertHasFormErrors(['password']);

        $this->assertNull(User::where('email', $testEmail)->first());
    }

    /**
     * P-05: Empty password when editing existing user does NOT overwrite existing password.
     */
    public function test_p05_empty_password_on_edit_preserves_existing_password(): void
    {
        $testUser = User::create([
            'name' => 'Existing User For Edit Test',
            'email' => 'p05_edit_' . uniqid() . '@example.com',
            'password' => 'OriginalPassword2026!',
        ]);

        $originalHash = $testUser->password;
        $this->assertTrue(Hash::check('OriginalPassword2026!', $originalHash));

        Livewire::test(EditUser::class, ['record' => $testUser->id])
            ->fillForm([
                'name' => 'Updated Name Only',
                'password' => null,
                'password_confirmation' => null,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $testUser->refresh();
        $this->assertEquals('Updated Name Only', $testUser->name);
        $this->assertEquals($originalHash, $testUser->password);
        $this->assertTrue(Hash::check('OriginalPassword2026!', $testUser->password));

        // Cleanup
        $testUser->delete();
    }

    /**
     * P-05b: Valid password change on edit updates password and revokes trusted devices.
     */
    public function test_p05b_password_change_on_edit_updates_hash_and_revokes_trusted_devices(): void
    {
        $testUser = User::create([
            'name' => 'User For Password Change Test',
            'email' => 'p05b_change_' . uniqid() . '@example.com',
            'password' => 'OldPassword12345!',
        ]);

        // Create a trusted device for this user
        $rawToken = bin2hex(random_bytes(32));
        $device = \App\Models\TrustedDevice::create([
            'user_id' => $testUser->id,
            'token_hash' => hash('sha256', $rawToken),
            'device_name' => 'Test Device',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'TestAgent',
            'expires_at' => now()->addDays(7),
        ]);

        $this->assertNull($device->revoked_at);

        Livewire::test(EditUser::class, ['record' => $testUser->id])
            ->fillForm([
                'password' => 'NewSecurePassword2026!',
                'password_confirmation' => 'NewSecurePassword2026!',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $testUser->refresh();
        $this->assertTrue(Hash::check('NewSecurePassword2026!', $testUser->password));

        // Verify trusted device was automatically revoked by User::booted() hook
        $device->refresh();
        $this->assertNotNull($device->revoked_at);

        // Cleanup
        $device->delete();
        $testUser->delete();
    }

    /**
     * P-05c: Short password on edit is rejected.
     */
    public function test_p05c_short_password_on_edit_rejected(): void
    {
        $testUser = User::create([
            'name' => 'User For Short Pwd Edit Test',
            'email' => 'p05c_short_' . uniqid() . '@example.com',
            'password' => 'OldPassword12345!',
        ]);

        Livewire::test(EditUser::class, ['record' => $testUser->id])
            ->fillForm([
                'password' => 'short',
                'password_confirmation' => 'short',
            ])
            ->call('save')
            ->assertHasFormErrors(['password']);

        // Cleanup
        $testUser->delete();
    }

    /**
     * P-07: Unicode passphrases with diacritics are accepted.
     */
    public function test_p07_unicode_passphrase_accepted(): void
    {
        $testEmail = 'p07_unicode_' . uniqid() . '@example.com';
        $unicodePassphrase = 'MậtKhẩuBảoMậtCửuLong2026!';

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Unicode Pwd User',
                'email' => $testEmail,
                'password' => $unicodePassphrase,
                'password_confirmation' => $unicodePassphrase,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $created = User::where('email', $testEmail)->first();
        $this->assertNotNull($created);
        $this->assertTrue(Hash::check($unicodePassphrase, $created->password));

        // Cleanup
        $created->delete();
    }

    /**
     * P-08: Passphrase with spaces is preserved and accepted.
     */
    public function test_p08_passphrase_with_spaces_accepted(): void
    {
        $testEmail = 'p08_spaces_' . uniqid() . '@example.com';
        $spacedPassphrase = 'correct horse battery staple 2026';

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Spaced Pwd User',
                'email' => $testEmail,
                'password' => $spacedPassphrase,
                'password_confirmation' => $spacedPassphrase,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $created = User::where('email', $testEmail)->first();
        $this->assertNotNull($created);
        $this->assertTrue(Hash::check($spacedPassphrase, $created->password));

        // Cleanup
        $created->delete();
    }
}
