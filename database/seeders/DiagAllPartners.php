<?php
// Kiểm tra tất cả đối tác và ảnh hiện tại
$partners = \App\Models\Partner::orderBy('display_sections')->orderBy('order')->get();

echo "=== TẤT CẢ ĐỐI TÁC VÀ ẢNH ===\n";
foreach ($partners as $p) {
    $sections = json_encode($p->display_sections ?? []);
    echo "\nID:{$p->id} [{$sections}] order:{$p->order} | {$p->name}\n";
    echo "  image: " . var_export($p->image, true) . "\n";
    echo "  logo:  " . var_export($p->logo, true) . "\n";
    
    // Kiểm tra file vật lý
    foreach (['image', 'logo'] as $field) {
        $val = $p->$field;
        if ($val && !\Str::startsWith($val, 'http')) {
            $path = storage_path('app/public/' . $val);
            $exists = file_exists($path) ? 'EXISTS' : 'NOT FOUND';
            echo "  [{$field} file check]: {$exists} → {$path}\n";
        }
    }
}
