<?php
// Cập nhật ảnh sạch cho MTC Travel, Gonatour, Apollo Travel & Events
// KHÔNG thay đổi bất kỳ thông tin nào khác (tên, mô tả, thứ hạng)

// MTC Travel (ID:6) - ảnh tour du lịch trọn gói sạch
\DB::table('partners')->where('id', 6)->update([
    'image' => 'partners/mtc_travel_clean.jpg',
    'updated_at' => now(),
]);
echo "✅ MTC Travel: image updated → partners/mtc_travel_clean.jpg\n";

// Gonatour (ID:7) - ảnh sân bay quốc tế sạch
\DB::table('partners')->where('id', 7)->update([
    'image' => 'partners/gonatour_clean.jpg',
    'updated_at' => now(),
]);
echo "✅ Gonatour: image updated → partners/gonatour_clean.jpg\n";

// Apollo Travel & Events (ID:8) - ảnh gala dinner sạch
\DB::table('partners')->where('id', 8)->update([
    'image' => 'partners/apollo_events_clean.jpg',
    'updated_at' => now(),
]);
echo "✅ Apollo Travel & Events: image added → partners/apollo_events_clean.jpg\n";

// Xác minh
echo "\n=== XÁC MINH SAU CẬP NHẬT ===\n";
$gold = \DB::table('partners')->whereIn('id', [6, 7, 8])->get(['id', 'name', 'image', 'logo']);
foreach ($gold as $p) {
    $imgPath = storage_path('app/public/' . $p->image);
    $exists = file_exists($imgPath) ? 'FILE EXISTS ✅' : 'FILE NOT FOUND ❌';
    echo "ID:{$p->id} {$p->name}\n  image: {$p->image}\n  file: {$exists}\n";
}

echo "\nXác nhận: Không thay đổi name, display_sections, order, description, tagline của bất kỳ đối tác nào.\n";
