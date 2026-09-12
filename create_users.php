<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$admin = \App\Models\User::firstOrCreate(['email' => 'admin@test.com'], ['name' => 'Admin Test', 'password' => \Hash::make('password')]);
$admin->assignRole('Admin');

$editor = \App\Models\User::firstOrCreate(['email' => 'editor@test.com'], ['name' => 'Editor Test', 'password' => \Hash::make('password')]);
$editor->assignRole('Biên Tập Viên');

$collab = \App\Models\User::firstOrCreate(['email' => 'collab@test.com'], ['name' => 'Collab Test', 'password' => \Hash::make('password')]);
$collab->assignRole('Cộng Tác Viên');

echo "Done\n";
