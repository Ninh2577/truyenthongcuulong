<?php
require __DIR__."/../vendor/autoload.php";
$app = require_once __DIR__."/../bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\MenuItem::where('url', '/booking')->orWhere('url', 'http://127.0.0.1:8000/booking')->update(['url' => '/dich-vu/booking']);
\App\Models\MenuItem::where('url', '/kho-giao-dien')->orWhere('url', 'http://127.0.0.1:8000/kho-giao-dien')->update(['url' => '/dich-vu/kho-giao-dien']);
\App\Models\MenuItem::where('url', '/bang-gia')->orWhere('url', 'http://127.0.0.1:8000/bang-gia')->update(['url' => '/dich-vu/bang-gia']);

// For items that might use full URL starting with /
\App\Models\MenuItem::where('url', 'like', '%/booking')->update(['url' => '/dich-vu/booking']);
\App\Models\MenuItem::where('url', 'like', '%/kho-giao-dien')->update(['url' => '/dich-vu/kho-giao-dien']);
\App\Models\MenuItem::where('url', 'like', '%/bang-gia')->update(['url' => '/dich-vu/bang-gia']);

echo "Updated menu item URLs in database";
