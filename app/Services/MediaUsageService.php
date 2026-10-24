<?php

namespace App\Services;

use App\Models\MediaFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MediaUsageService
{
    /**
     * Trích xuất tất cả đường dẫn ảnh và tên file từ văn bản / HTML / JSON.
     *
     * @param string|null $text
     * @return array{paths: array<string>, filenames: array<string>}
     */
    public static function extractMediaReferences(?string $text): array
    {
        if (empty($text)) {
            return ['paths' => [], 'filenames' => []];
        }

        $paths = [];
        $filenames = [];

        // Hỗ trợ cả chuỗi thường lẫn chuỗi đã urldecode
        $textsToScan = [$text];
        $decoded = urldecode($text);
        if ($decoded !== $text) {
            $textsToScan[] = $decoded;
        }

        foreach ($textsToScan as $t) {
            // 1. Tìm các đường dẫn thư mục media (uploads, photos, partners, clients, projects, images)
            if (preg_match_all('/(?:storage\/|\/storage\/)?(uploads\/[^\s"\'<>?#]+|photos\/[^\s"\'<>?#]+|partners\/[^\s"\'<>?#]+|clients\/[^\s"\'<>?#]+|projects\/[^\s"\'<>?#]+|images\/[^\s"\'<>?#]+)/i', $t, $matches)) {
                foreach ($matches[1] as $match) {
                    $cleanPath = trim(str_replace('\\', '/', $match), '/');
                    if (!empty($cleanPath)) {
                        $paths[] = $cleanPath;
                        $filenames[] = basename($cleanPath);
                    }
                }
            }

            // 2. Tìm tất cả tên file ảnh có phần mở rộng phổ biến
            if (preg_match_all('/([a-zA-Z0-9_\-\.%]+\.(?:jpg|jpeg|png|webp|gif|svg))/i', $t, $fileMatches)) {
                foreach ($fileMatches[1] as $fn) {
                    $cleanFn = trim(basename(str_replace('\\', '/', $fn)));
                    if (!empty($cleanFn)) {
                        $filenames[] = $cleanFn;
                    }
                }
            }
        }

        return [
            'paths' => array_values(array_unique($paths)),
            'filenames' => array_values(array_unique($filenames)),
        ];
    }

    /**
     * Đồng bộ ngay lập tức lượt sử dụng ảnh cho một bản ghi (Post, CaseStudy, v.v...)
     * Chạy tự động trong hook saved/deleted của Model (< 5ms).
     *
     * @param Model $record
     * @return int Số file media được cập nhật
     */
    public static function syncForRecord(Model $record): int
    {
        try {
            // Gom tất cả nội dung hình ảnh từ record hiện tại
            $currentText = '';
            foreach (['thumbnail', 'content', 'gallery', 'logo', 'icon', 'image'] as $col) {
                if (isset($record->{$col})) {
                    $val = $record->{$col};
                    $currentText .= ' ' . (is_array($val) ? json_encode($val) : (string) $val);
                }
            }

            // Gom cả nội dung trước khi cập nhật (để xử lý ảnh bị gỡ bỏ)
            $originalText = '';
            foreach (['thumbnail', 'content', 'gallery', 'logo', 'icon', 'image'] as $col) {
                $origVal = $record->getOriginal($col);
                if (!empty($origVal)) {
                    $originalText .= ' ' . (is_array($origVal) ? json_encode($origVal) : (string) $origVal);
                }
            }

            $combinedText = $currentText . ' ' . $originalText;
            $refs = self::extractMediaReferences($combinedText);

            if (empty($refs['paths']) && empty($refs['filenames'])) {
                return 0;
            }

            // Tìm tất cả các bản ghi MediaFile bị ảnh hưởng
            $mediaFiles = MediaFile::query()
                ->where(function ($query) use ($refs) {
                    if (!empty($refs['paths'])) {
                        $query->whereIn('path', $refs['paths']);
                    }
                    if (!empty($refs['filenames'])) {
                        $query->orWhereIn('filename', $refs['filenames']);
                    }
                })
                ->get();

            if ($mediaFiles->isEmpty()) {
                return 0;
            }

            $updatedCount = 0;
            foreach ($mediaFiles as $media) {
                $newCount = self::calculateUsageCountForMedia($media);
                if ($media->usage_count !== $newCount) {
                    $media->update(['usage_count' => $newCount]);
                    $updatedCount++;
                }
            }

            return $updatedCount;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Lỗi syncForRecord MediaUsageService: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Tính toán chính xác lượt sử dụng của 1 MediaFile trong toàn bộ cơ sở dữ liệu.
     *
     * @param MediaFile $media
     * @return int
     */
    public static function calculateUsageCountForMedia(MediaFile $media): int
    {
        // Tài nguyên giao diện trong images/ luôn được tính là đang sử dụng
        if ($media->isUiAsset() || str_starts_with($media->path, 'images/')) {
            return 1;
        }

        $path = $media->path;
        $filename = $media->filename;
        $filenameDecoded = urldecode($filename);

        $count = 0;

        // 1. Bài viết (Posts)
        if (Schema::hasTable('posts')) {
            $count += DB::table('posts')
                ->whereNull('deleted_at')
                ->where(function ($q) use ($path, $filename, $filenameDecoded) {
                    $q->where('thumbnail', 'like', "%{$path}%")
                      ->orWhere('thumbnail', 'like', "%{$filename}%")
                      ->orWhere('content', 'like', "%{$path}%")
                      ->orWhere('content', 'like', "%{$filename}%");
                    if ($filenameDecoded !== $filename) {
                        $q->orWhere('thumbnail', 'like', "%{$filenameDecoded}%")
                          ->orWhere('content', 'like', "%{$filenameDecoded}%");
                    }
                })->count();
        }

        // 2. Dự án / Case Studies
        if (Schema::hasTable('case_studies')) {
            $count += DB::table('case_studies')
                ->where(function ($q) use ($path, $filename, $filenameDecoded) {
                    $q->where('thumbnail', 'like', "%{$path}%")
                      ->orWhere('thumbnail', 'like', "%{$filename}%")
                      ->orWhere('content', 'like', "%{$path}%")
                      ->orWhere('content', 'like', "%{$filename}%")
                      ->orWhere('gallery', 'like', "%{$path}%")
                      ->orWhere('gallery', 'like', "%{$filename}%");
                    if ($filenameDecoded !== $filename) {
                        $q->orWhere('thumbnail', 'like', "%{$filenameDecoded}%")
                          ->orWhere('content', 'like', "%{$filenameDecoded}%")
                          ->orWhere('gallery', 'like', "%{$filenameDecoded}%");
                    }
                })->count();
        }

        // 3. Bảng giá (Pricing Plans)
        if (Schema::hasTable('pricing_plans')) {
            $count += DB::table('pricing_plans')
                ->where(function ($q) use ($path, $filename) {
                    $q->where('thumbnail', 'like', "%{$path}%")
                      ->orWhere('thumbnail', 'like', "%{$filename}%");
                })->count();
        }

        // 4. Đối tác (Partners)
        if (Schema::hasTable('partners')) {
            $count += DB::table('partners')
                ->where(function ($q) use ($path, $filename) {
                    $q->where('logo', 'like', "%{$path}%")
                      ->orWhere('logo', 'like', "%{$filename}%");
                })->count();
        }

        // 5. Khách hàng (Clients)
        if (Schema::hasTable('clients')) {
            $count += DB::table('clients')
                ->where(function ($q) use ($path, $filename) {
                    $q->where('logo', 'like', "%{$path}%")
                      ->orWhere('logo', 'like', "%{$filename}%");
                })->count();
        }

        // 6. Dịch vụ (Services)
        if (Schema::hasTable('services')) {
            $count += DB::table('services')
                ->where(function ($q) use ($path, $filename) {
                    if (Schema::hasColumn('services', 'icon')) {
                        $q->where('icon', 'like', "%{$path}%")
                          ->orWhere('icon', 'like', "%{$filename}%");
                    }
                    if (Schema::hasColumn('services', 'content')) {
                        $q->orWhere('content', 'like', "%{$path}%")
                          ->orWhere('content', 'like', "%{$filename}%");
                    }
                })->count();
        }

        return $count;
    }

    /**
     * Quét và tính toán lại toàn bộ lượt sử dụng của tất cả ảnh trong hệ thống.
     * Tối ưu hóa cực đại (chạy trong ~1-2 giây cho hàng nghìn ảnh).
     *
     * @return array{total: int, ui: int, used_posts: int, unused_uploads: int}
     */
    public static function recalculateAll(): array
    {
        @set_time_limit(300);

        // 1. Gom toàn bộ văn bản nội dung từ tất cả các bảng vào bộ nhớ
        $textPool = '';

        if (Schema::hasTable('posts')) {
            $posts = DB::table('posts')->whereNull('deleted_at')->select('thumbnail', 'content')->get();
            foreach ($posts as $p) {
                $textPool .= ' ' . $p->thumbnail . ' ' . $p->content;
            }
        }

        if (Schema::hasTable('case_studies')) {
            $cases = DB::table('case_studies')->select('thumbnail', 'content', 'gallery')->get();
            foreach ($cases as $c) {
                $textPool .= ' ' . $c->thumbnail . ' ' . $c->content . ' ' . $c->gallery;
            }
        }

        if (Schema::hasTable('pricing_plans')) {
            $textPool .= ' ' . DB::table('pricing_plans')->pluck('thumbnail')->implode(' ');
        }

        if (Schema::hasTable('partners')) {
            $textPool .= ' ' . DB::table('partners')->pluck('logo')->implode(' ');
        }

        if (Schema::hasTable('clients')) {
            $textPool .= ' ' . DB::table('clients')->pluck('logo')->implode(' ');
        }

        if (Schema::hasTable('services')) {
            if (Schema::hasColumn('services', 'icon')) {
                $textPool .= ' ' . DB::table('services')->pluck('icon')->implode(' ');
            }
            if (Schema::hasColumn('services', 'content')) {
                $textPool .= ' ' . DB::table('services')->pluck('content')->implode(' ');
            }
            if (Schema::hasColumn('services', 'summary')) {
                $textPool .= ' ' . DB::table('services')->pluck('summary')->implode(' ');
            }
        }

        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'image')) {
            $textPool .= ' ' . DB::table('categories')->pluck('image')->implode(' ');
        }

        if (Schema::hasTable('settings')) {
            $textPool .= ' ' . DB::table('settings')->pluck('value')->implode(' ');
        }

        // Quét toàn bộ mã nguồn Blade views (nhận diện ảnh hardcoded trên giao diện website & trang đối tác)
        $viewsDir = resource_path('views');
        if (is_dir($viewsDir)) {
            $viewFiles = \Illuminate\Support\Facades\File::allFiles($viewsDir);
            foreach ($viewFiles as $f) {
                if (str_ends_with($f->getFilename(), '.blade.php')) {
                    $textPool .= ' ' . file_get_contents($f->getPathname());
                }
            }
        }

        // Tạo bản copy đã decode url để so khớp cả tên file có dấu / khoảng trắng
        $decodedTextPool = urldecode($textPool);

        // 2. Quét qua tất cả MediaFile và cập nhật theo lô
        $allMedia = MediaFile::select('id', 'path', 'filename', 'usage_count')->get();
        $uiCount = 0;
        $usedPostsCount = 0;
        $unusedUploadsCount = 0;

        $updatesToApply = [];

        foreach ($allMedia as $media) {
            $count = 0;

            if ($media->isUiAsset() || str_starts_with($media->path, 'images/')) {
                $count = 1;
                $uiCount++;
            } else {
                $cleanPath = str_replace('\\', '/', $media->path);
                $cleanFilename = $media->filename;

                // Kiểm tra theo path
                if (str_contains($textPool, $cleanPath) || str_contains($decodedTextPool, $cleanPath)) {
                    $count += max(
                        substr_count($textPool, $cleanPath),
                        substr_count($decodedTextPool, $cleanPath)
                    );
                }

                // Kiểm tra theo filename nếu path chưa ra kết quả
                if ($count === 0 && (str_contains($textPool, $cleanFilename) || str_contains($decodedTextPool, $cleanFilename))) {
                    $count += max(
                        substr_count($textPool, $cleanFilename),
                        substr_count($decodedTextPool, $cleanFilename)
                    );
                }

                if ($count > 0) {
                    $usedPostsCount++;
                } else {
                    $unusedUploadsCount++;
                }
            }

            if ($media->usage_count !== $count) {
                $updatesToApply[$media->id] = $count;
            }
        }

        // 3. Cập nhật vào DB theo lô (chunks) để đạt tốc độ cao nhất
        if (!empty($updatesToApply)) {
            $chunks = array_chunk($updatesToApply, 200, true);
            foreach ($chunks as $chunk) {
                DB::transaction(function () use ($chunk) {
                    $cases = [];
                    $ids = [];
                    foreach ($chunk as $id => $cnt) {
                        $id = (int) $id;
                        $cnt = (int) $cnt;
                        $cases[] = "WHEN id = {$id} THEN {$cnt}";
                        $ids[] = $id;
                    }
                    $idList = implode(',', $ids);
                    $caseSql = implode(' ', $cases);
                    DB::statement("UPDATE media_files SET usage_count = CASE {$caseSql} END WHERE id IN ({$idList})");
                });
            }
        }

        return [
            'total' => $allMedia->count(),
            'ui' => $uiCount,
            'used_posts' => $usedPostsCount,
            'unused_uploads' => $unusedUploadsCount,
        ];
    }
}
