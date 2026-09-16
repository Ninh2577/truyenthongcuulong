<?php
// Xác minh fix đã đúng: render URL thumbnail thực tế sẽ ra gì
$posts = \DB::table('posts')
    ->where('category_id', 14)
    ->where('status', 'published')
    ->whereNotNull('thumbnail')
    ->limit(8)
    ->get(['id', 'title', 'thumbnail']);

echo "=== URL THUMBNAIL SẼ ĐƯỢC RENDER SAU KHI FIX ===\n";
foreach ($posts as $p) {
    $thumbSrc = \Str::startsWith($p->thumbnail, 'http')
        ? $p->thumbnail
        : 'http://127.0.0.1:8000/storage/' . $p->thumbnail;
    echo "\nID:{$p->id}\n";
    echo "  DB value: {$p->thumbnail}\n";
    echo "  Rendered URL: {$thumbSrc}\n";
    echo "  Is external URL: " . (\Str::startsWith($p->thumbnail, 'http') ? 'YES (WordPress CDN)' : 'NO (local)') . "\n";
}

// Kiểm tra có bao nhiêu bản ghi dùng URL ngoài vs local
$total = \DB::table('posts')->where('category_id', 14)->where('status','published')->count();
$external = \DB::table('posts')->where('category_id', 14)->where('status','published')
    ->where('thumbnail', 'like', 'http%')->count();
$local = \DB::table('posts')->where('category_id', 14)->where('status','published')
    ->where('thumbnail', 'not like', 'http%')->whereNotNull('thumbnail')->count();
$nullThumb = \DB::table('posts')->where('category_id', 14)->where('status','published')
    ->whereNull('thumbnail')->count();

echo "\n=== TỔNG KẾT ===\n";
echo "Total published templates: {$total}\n";
echo "Thumbnail là URL ngoài (WordPress cũ): {$external}\n";
echo "Thumbnail là path local (storage/): {$local}\n";
echo "Thumbnail NULL: {$nullThumb}\n";

// Kiểm tra URL WordPress còn sống không (HEAD request)
echo "\n=== KIỂM TRA 1 URL WORDPRESS CÒN ACCESSIBLE KHÔNG ===\n";
$sampleUrl = \DB::table('posts')->where('category_id', 14)->where('thumbnail', 'like', 'http%')->value('thumbnail');
if ($sampleUrl) {
    $context = stream_context_create(['http' => ['method' => 'HEAD', 'timeout' => 5, 'ignore_errors' => true]]);
    $headers = @get_headers($sampleUrl, true, $context);
    if ($headers) {
        $status = $headers[0] ?? 'Unknown';
        echo "URL: {$sampleUrl}\nHTTP Status: {$status}\n";
        echo "ACCESSIBLE: " . (str_contains($status, '200') ? 'YES ✅' : 'NO ❌ (need local copy)') . "\n";
    } else {
        echo "URL: {$sampleUrl}\nCannot connect (no network or blocked)\n";
    }
}
