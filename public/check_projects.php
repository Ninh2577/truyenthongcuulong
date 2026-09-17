<?php
require __DIR__."/../vendor/autoload.php";
$app = require_once __DIR__."/../bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $projects = \App\Models\CaseStudy::where('category', 'like', '%ERP%')
        ->orWhere('title', 'like', '%ERP%')
        ->orWhere('category', 'like', '%Chatbot%')
        ->orWhere('title', 'like', '%Chatbot%')
        ->get(['id', 'title', 'category']);
        
    echo json_encode($projects);
} catch (Exception $e) {
    echo $e->getMessage();
}
