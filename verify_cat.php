<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::first();
auth()->login($user);
$res = $kernel->handle(Illuminate\Http\Request::create('/cuulongteam/categories', 'GET'));
echo "HTTP Status: " . $res->getStatusCode() . " - Content Length: " . strlen($res->getContent()) . "\n";
