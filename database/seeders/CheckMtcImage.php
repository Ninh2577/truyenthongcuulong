<?php
$mtc = \App\Models\Partner::where('name', 'like', '%MTC%')->first();
if ($mtc) {
    echo "Name: " . $mtc->name . "\n";
    echo "image field: " . var_export($mtc->image, true) . "\n";
    echo "logo field: " . var_export($mtc->logo, true) . "\n";
    echo "display_sections: " . json_encode($mtc->display_sections) . "\n";
    
    // Kiểm tra file tồn tại không
    if ($mtc->image) {
        $path = storage_path('app/public/' . $mtc->image);
        echo "Storage path check: " . $path . "\n";
        echo "File exists: " . (file_exists($path) ? 'YES' : 'NO') . "\n";
        
        // Thử với đường dẫn đầy đủ nếu bắt đầu bằng /storage hoặc storage
        if (\Str::startsWith($mtc->image, '/storage/')) {
            $altPath = public_path($mtc->image);
            echo "Alt path check: " . $altPath . "\n";
            echo "Alt file exists: " . (file_exists($altPath) ? 'YES' : 'NO') . "\n";
        }
        if (\Str::startsWith($mtc->image, 'http')) {
            echo "Image is a full URL\n";
        }
    }
} else {
    echo "MTC not found\n";
    // Show all partners
    \App\Models\Partner::all()->each(function($p) {
        echo $p->id . ': ' . $p->name . ' | image=' . substr($p->image ?? 'null', 0, 80) . "\n";
    });
}
