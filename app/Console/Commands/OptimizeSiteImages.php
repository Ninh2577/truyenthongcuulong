<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeSiteImages extends Command
{
    protected $signature = 'site:optimize-images {--force : Re-optimize existing webp files} {--quality=82 : WebP quality (1-100)}';
    protected $description = 'Compress, resize oversized images and generate high-performance WebP versions for public/images';

    public function handle(): int
    {
        $this->info('Starting image optimization and WebP conversion for public/images...');

        $baseDir = public_path('images');
        if (!is_dir($baseDir)) {
            $this->error("Directory does not exist: $baseDir");
            return 1;
        }

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
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);

            $w = imagesx($img);
            $h = imagesy($img);

            // Determine if resize is needed
            // For standard horizontal images, cap max width at 1920px
            // For extra-tall fullpage mockups (height > 3000px), cap width at 1200px
            $maxWidth = ($h > 3000) ? 1200 : 1920;
            $scaled = null;

            if ($w > $maxWidth) {
                $newW = $maxWidth;
                $newH = (int) round($h * ($newW / $w));
                $scaled = imagescale($img, $newW, $newH, IMG_BICUBIC);
            }

            $targetImg = $scaled ?: $img;

            // Generate WebP
            imagewebp($targetImg, $webpPath, $quality);

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
