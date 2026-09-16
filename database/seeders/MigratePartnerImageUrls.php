<?php
// Migrate: convert relative image/logo paths to full URLs in partners table
// Đảm bảo tất cả ảnh cũ (dạng uploads/...) được chuyển sang full URL

$partners = \App\Models\Partner::all();
$updated = 0;

foreach ($partners as $partner) {
    $changed = false;

    foreach (['image', 'logo'] as $field) {
        $val = $partner->$field;
        if (!$val) continue;

        // Nếu đã là full URL → bỏ qua
        if (\Str::startsWith($val, 'http')) continue;

        // Tìm MediaFile theo path
        $media = \App\Models\MediaFile::where('path', $val)->first();
        if ($media) {
            $fullUrl = \Illuminate\Support\Facades\Storage::disk($media->disk)->url($media->path);
            $partner->$field = $fullUrl;
            $changed = true;
            echo "Partner [{$partner->name}] {$field}: {$val} → {$fullUrl}\n";
        } else {
            // Không tìm được MediaFile, tự convert
            $fullUrl = asset('storage/' . $val);
            $partner->$field = $fullUrl;
            $changed = true;
            echo "Partner [{$partner->name}] {$field}: {$val} → {$fullUrl} (no MediaFile)\n";
        }
    }

    if ($changed) {
        $partner->save();
        $updated++;
    }
}

echo "\nDone! Updated {$updated} partners.\n";
