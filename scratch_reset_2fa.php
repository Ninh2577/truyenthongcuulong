<?php
require 'C:/xampp/htdocs/truyenthongcuulong-laravel/vendor/autoload.php';
$app = require 'C:/xampp/htdocs/truyenthongcuulong-laravel/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::where('email', 'admin@truyenthongcuulong.com')->first();
if ($user) {
    $user->forceFill([
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
        'two_factor_confirmed_at' => null,
    ])->save();

    App\Models\TrustedDevice::where('user_id', $user->id)->delete();

    echo "SUCCESS: Reset 2FA for {$user->email} successfully!\n";
} else {
    echo "ERROR: User not found!\n";
}
