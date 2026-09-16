<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScanLegacyMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:scan-legacy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan existing media files and insert into media_files table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0);

        $this->info('Scanning for legacy media files...');

        $files = array_merge(
            \Illuminate\Support\Facades\Storage::disk('public')->allFiles('uploads'),
            \Illuminate\Support\Facades\Storage::disk('public')->allFiles('partners')
        );

        // Filter valid image types
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $imageFiles = array_filter($files, function ($file) use ($validExtensions) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return in_array($ext, $validExtensions);
        });

        $totalFiles = count($imageFiles);
        $this->info("Found $totalFiles image files.");

        $bar = $this->output->createProgressBar($totalFiles);
        $bar->start();

        // Load all Blade views AND App code content to check for hardcoded image usage
        $bladeFiles = \Illuminate\Support\Facades\File::allFiles(resource_path('views'));
        $appFiles = \Illuminate\Support\Facades\File::allFiles(app_path());
        
        $allViewsContent = '';
        foreach ($bladeFiles as $file) {
            $allViewsContent .= file_get_contents($file->getPathname());
        }
        foreach ($appFiles as $file) {
            if ($file->getExtension() === 'php') {
                $allViewsContent .= file_get_contents($file->getPathname());
            }
        }

        $errors = [];
        $inserted = 0;
        $updated = 0;

        foreach ($imageFiles as $path) {
            try {
                $absolutePath = \Illuminate\Support\Facades\Storage::disk('public')->path($path);
                
                if (!file_exists($absolutePath)) {
                    throw new \Exception("File not found on disk");
                }

                $size = filesize($absolutePath);
                $imageSize = @getimagesize($absolutePath);
                
                if ($imageSize === false) {
                    throw new \Exception("Could not read image dimensions or invalid image");
                }

                $width = $imageSize[0];
                $height = $imageSize[1];
                $mime = $imageSize['mime'];
                $filename = basename($path);

                // Determine folder_year
                $folderYear = null;
                if (preg_match('/^uploads\/(\d{4})\//', $path, $matches)) {
                    $folderYear = $matches[1];
                }

                // Alt text logic
                $altText = null;
                if (in_array($filename, ['mockup_erp.jpg', 'mockup_phongkham.jpg'])) {
                    $altText = 'Ảnh minh họa giao diện — không phải ảnh chụp màn hình thật';
                }

                // Calculate usage count
                $usageCount = 0;
                $usageCount += \App\Models\Post::where('content', 'LIKE', '%' . $path . '%')
                                               ->orWhere('thumbnail', 'LIKE', '%' . $path . '%')->count();
                $usageCount += \App\Models\CaseStudy::where('content', 'LIKE', '%' . $path . '%')
                                                    ->orWhere('thumbnail', 'LIKE', '%' . $path . '%')->count();
                $usageCount += \App\Models\Partner::where('logo', 'LIKE', '%' . $path . '%')->count();
                $usageCount += \App\Models\Client::where('logo', 'LIKE', '%' . $path . '%')->count();

                // Check if used in Blade templates
                if (str_contains($allViewsContent, $filename)) {
                    $usageCount += 1;
                }

                $mediaFile = \App\Models\MediaFile::where('path', $path)->first();
                if ($mediaFile) {
                    $mediaFile->update([
                        'size' => $size,
                        'width' => $width,
                        'height' => $height,
                        'mime_type' => $mime,
                        'usage_count' => $usageCount,
                    ]);
                    $updated++;
                } else {
                    \App\Models\MediaFile::create([
                        'filename' => $filename,
                        'original_name' => $filename,
                        'path' => $path,
                        'disk' => 'public',
                        'mime_type' => $mime,
                        'size' => $size,
                        'width' => $width,
                        'height' => $height,
                        'folder_year' => $folderYear,
                        'alt_text' => $altText,
                        'usage_count' => $usageCount,
                    ]);
                    $inserted++;
                }

            } catch (\Exception $e) {
                $errors[] = "Error processing $path: " . $e->getMessage();
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Completed scanning.");
        $this->info("Inserted: $inserted");
        $this->info("Updated: $updated");
        $this->info("Failed: " . count($errors));

        if (!empty($errors)) {
            $this->warn("Errors encountered:");
            foreach ($errors as $error) {
                $this->line("- $error");
            }
        }
    }
}
