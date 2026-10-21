<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeSiteImages extends Command
{
    protected $signature = 'site:optimize-images {--force : Re-optimize existing webp files} {--quality=90 : WebP quality for JPG (1-100)} {--revert : Delete all generated WebP files and revert to original PNG/JPG}';
    protected $description = 'Compress, resize oversized images and generate high-performance lossless WebP versions for public/images';

    public function handle(): int
    {
        $baseDir = public_path('images');
        if (!is_dir($baseDir)) {
            $this->error("Directory does not exist: $baseDir");
            return 1;
        }

        if ($this->option('revert')) {
            $this->warn('Reverting: Deleting generated WebP files so the site falls back to original PNG/JPG...');
            $files = $this->getImagesRecursive($baseDir);
            $deleted = 0;
            foreach ($files as $filePath) {
                $webpPath = preg_replace('/\.(png|jpe?g)$/i', '.webp', $filePath);
                if (file_exists($webpPath)) {
                    @unlink($webpPath);
                    $deleted++;
                }
            }
            $this->info("Successfully removed $deleted WebP files. All images restored to original PNG/JPG assets.");
            return 0;
        }

        $this->info('Starting image optimization and WebP conversion for public/images (Lossless for PNG, High-Q for JPG)...');

        $force = (bool) $this->option('force');
        $quality = (int) $this->option('quality');

        $files = $this->getImagesRecursive($baseDir);
        $totalFiles = count($files);
        $this->info("Found $totalFiles PNG and JPG images to process.");

        $processed = 0;
        $savedBytes = 0;
        $totalOriginalBytes = 0;

        foreach ($files as $filePath) {
            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            if (!in_array($ext, ['png', 'jpg', 'jpeg'])) {
                continue;
            }

            $webpPath = preg_replace('/\.(png|jpe?g)$/i', '.webp', $filePath);
            $origSize = filesize($filePath);
            $totalOriginalBytes += $origSize;

            // Skip if webp already exists and is newer than source, unless forced
            if (!$force && file_exists($webpPath) && filemtime($webpPath) >= filemtime($filePath)) {
                $savedBytes += ($origSize - filesize($webpPath));
                continue;
            }

            $img = null;
            if ($ext === 'png') {
                $img = @imagecreatefrompng($filePath);
            } elseif (in_array($ext, ['jpg', 'jpeg'])) {
                $img = @imagecreatefromjpeg($filePath);
            }

            if (!$img) {
                continue;
            }

            // Preserve alpha transparency for PNGs
            if ($ext === 'png') {
                imagepalettetotruecolor($img);
                imagealphablending($img, false);
                imagesavealpha($img, true);
            }

            $w = imagesx($img);
            $h = imagesy($img);

            // Only downscale if truly oversized (> 2560px for width, or > 3500px for height)
            $scaled = null;
            if ($w > 2560 || $h > 3500) {
                $newW = $w > 2560 ? 2560 : (int) round($w * (3500 / $h));
                $newH = (int) round($h * ($newW / $w));

                $scaled = imagecreatetruecolor($newW, $newH);
                if ($ext === 'png') {
                    imagealphablending($scaled, false);
                    imagesavealpha($scaled, true);
                    $transparent = imagecolorallocatealpha($scaled, 255, 255, 255, 127);
                    imagefilledrectangle($scaled, 0, 0, $newW, $newH, $transparent);
                }
                imagecopyresampled($scaled, $img, 0, 0, 0, 0, $newW, $newH, $w, $h);
            }

            $targetImg = $scaled ?: $img;

            // Generate WebP:
            // For PNG (graphics, icons, banners, mockups): ALWAYS use IMG_WEBP_LOSSLESS to prevent any color banding or speck artifacts
            // For JPG (photos): Use high-fidelity quality (default 90)
            if ($ext === 'png' && defined('IMG_WEBP_LOSSLESS')) {
                imagewebp($targetImg, $webpPath, IMG_WEBP_LOSSLESS);
            } else {
                imagewebp($targetImg, $webpPath, $quality);
            }

            $webpSize = filesize($webpPath);
            $savedBytes += ($origSize - $webpSize);
            $processed++;

            if ($scaled) {
                imagedestroy($scaled);
            }
            imagedestroy($img);
        }

        $this->info("Successfully converted/optimized $processed images to WebP.");
        $origMB = round($totalOriginalBytes / 1024 / 1024, 2);
        $savedMB = round($savedBytes / 1024 / 1024, 2);
        $reduction = $totalOriginalBytes > 0 ? round(($savedBytes / $totalOriginalBytes) * 100, 1) : 0;

        $this->info("Total original image weight: {$origMB} MB");
        $this->info("Total payload saved: {$savedMB} MB ({$reduction}% reduction)");

        return 0;
    }

    protected function getImagesRecursive(string $dir): array
    {
        $result = [];
        $items = scandir($dir);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($fullPath)) {
                $result = array_merge($result, $this->getImagesRecursive($fullPath));
            } elseif (is_file($fullPath)) {
                $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
                    $result[] = $fullPath;
                }
            }
        }

        return $result;
    }
}
