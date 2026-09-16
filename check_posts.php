<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$posts = App\Models\Post::where('content', 'LIKE', '%>>>%')->get();
if ($posts->isEmpty()) {
    echo "No posts found containing >>>\n";
} else {
    foreach($posts as $p) {
        echo $p->id . ': ' . $p->title . "\n";
    }
}
