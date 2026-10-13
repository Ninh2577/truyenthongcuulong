<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::where('email', 'hoangninh2577@gmail.com')->first() ?? App\Models\User::first();
auth()->login($user);

$request = Illuminate\Http\Request::create('/cuulongteam/categories', 'GET');
$response = $kernel->handle($request);

echo "Status Code: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() >= 400) {
    echo "Content error: " . substr($response->getContent(), 0, 1000) . "\n";
} else {
    echo "Response OK! Length: " . strlen($response->getContent()) . "\n";
}
