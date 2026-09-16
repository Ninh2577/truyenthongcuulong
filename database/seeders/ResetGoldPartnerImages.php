<?php
// Reset image field về NULL cho MTC Travel, Gonatour, Apollo Travel & Events
\DB::table('partners')->where('id', 6)->update(['image' => null, 'updated_at' => now()]);
echo "✅ MTC Travel (ID:6): image reset → NULL\n";

\DB::table('partners')->where('id', 7)->update(['image' => null, 'updated_at' => now()]);
echo "✅ Gonatour (ID:7): image reset → NULL\n";

\DB::table('partners')->where('id', 8)->update(['image' => null, 'updated_at' => now()]);
echo "✅ Apollo Travel & Events (ID:8): image reset → NULL\n";

// Xác minh
$gold = \DB::table('partners')->whereIn('id', [6, 7, 8])->get(['id', 'name', 'image', 'logo']);
echo "\n=== XÁC MINH ===\n";
foreach ($gold as $p) {
    echo "ID:{$p->id} {$p->name} | image=" . var_export($p->image, true) . " | logo=" . var_export($p->logo, true) . "\n";
}

// Xác minh file đã xóa
echo "\n=== KIỂM TRA FILE VẬT LÝ ===\n";
foreach (['mtc_travel_clean.jpg', 'gonatour_clean.jpg', 'apollo_events_clean.jpg'] as $f) {
    $path = storage_path('app/public/partners/' . $f);
    echo $f . ': ' . (file_exists($path) ? 'STILL EXISTS ❌' : 'DELETED ✅') . "\n";
}
echo "\nHoàn tất rollback.\n";
