<?php
require __DIR__."/../vendor/autoload.php";
$app = require_once __DIR__."/../bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\MenuItem::where("title", "Quay TVC Doanh Nghi?p 4K")->update(["title" => "Quay Phim S? Ki?n & Team Building"]);
\App\Models\MenuItem::where("title", "Qu?ng cáo Performance TikTok & Meta")->update(["title" => "Qu?ng Cáo Google Ads & Facebook"]);
\App\Models\MenuItem::where("title", "Booking Team Media & Livestream")->update(["title" => "Booking Team Media"]);
echo "Done";
