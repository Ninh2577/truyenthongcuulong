<?php
// Rollback: khôi phục lại relative paths từ full URLs
// Vì URL phụ thuộc vào server (localhost, 127.0.0.1:8888) nên không nên lưu full URL vào DB

$partners = \App\Models\Partner::all();
$updated = 0;

foreach ($partners as $partner) {
    $changed = false;

    foreach (['image', 'logo'] as $field) {
        $val = $partner->$field;
        if (!$val) continue;

        // Nếu là full URL → extract relative path
        if (\Str::startsWith($val, 'http')) {
            // Tìm /storage/ trong URL → lấy phần sau
            if (preg_match('#/storage/(.+)$#', $val, $m)) {
                $partner->$field = $m[1]; // e.g. uploads/2026/09/...
                $changed = true;
                echo "Rollback [{$partner->name}] {$field}: {$val} → {$m[1]}\n";
            }
        }
    }

    if ($changed) {
        $partner->save();
        $updated++;
    }
}

echo "\nDone! Rolled back {$updated} partners.\n";
