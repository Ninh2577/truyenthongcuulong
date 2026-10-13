<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$post = App\Models\Post::find(19627);
$signedUrl = Illuminate\Support\Facades\URL::signedRoute('post.preview', ['post' => $post->id]);
echo "Signed URL: $signedUrl\n";

$controller = new App\Http\Controllers\BlogController();
$view = $controller->preview($post);
echo "Preview View: " . $view->getName() . "\n";

$directView = $controller->resolveSlug('thiet-ke-web-ban-hang-can-tho');
echo "Direct Slug View: " . (is_object($directView) ? get_class($directView) : gettype($directView)) . "\n";
