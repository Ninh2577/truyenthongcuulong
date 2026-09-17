<?php
require __DIR__."/../vendor/autoload.php";
$app = require_once __DIR__."/../bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\CaseStudy::whereIn("slug", ["he-thong-erp-quan-tri-doanh-nghiep", "chatbot-tu-van-khach-hang"])->delete();
echo "Deleted ERP and Chatbot case studies";
