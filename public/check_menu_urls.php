<?php
require __DIR__."/../vendor/autoload.php";
$app = require_once __DIR__."/../bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$items = \App\Models\MenuItem::where('url', 'like', '%booking%')
    ->orWhere('url', 'like', '%kho-giao-dien%')
    ->orWhere('url', 'like', '%bang-gia%')
    ->get(['id', 'title', 'url']);

echo json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
