<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $count = Illuminate\Support\Facades\DB::connection('wordpress_legacy')->table('posts')->count();
    echo "wordpress_legacy connection OK! Post count: $count\n";
} catch (Exception $e) {
    echo "Connection error: " . $e->getMessage() . "\n";
}
