<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redirect;
use Illuminate\Support\Facades\Log;

class SeoRedirectsSeeder extends Seeder
{
    public function run(): void
    {
        // XÃ³a toÃ n bá»™ báº£ng trÆ°á»›c khi import Ä‘á»ƒ reset láº¡i toÃ n bá»™
        Redirect::truncate();

        $csvFile = base_path('wp-url-mapping.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found: $csvFile");
            return;
        }

        $file = fopen($csvFile, 'r');
        $header = [
            'old_url', 'normalized_old_url', 'content_type', 'wp_post_id', 'wp_status', 'wp_title',
            'new_url', 'destination_exists', 'mapping_status', 'confidence', 'reason',
            'collision_type', 'duplicate_type', 'duplicate_source', 'duplicate_destination', 
            'query_string_present', 'trailing_slash_difference', 'redirect_chain_risk', 'redirect_loop_risk'
        ];

        $imported = 0;
        $skipped = 0;

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($header, $row);
            
            // Chỉ import các record được đánh dấu MAPPED
            if ($data['mapping_status'] !== 'MAPPED') {
                continue;
            }

            // Dùng normalized_old_url nhưng giữ trailing slash nếu URL cũ có
            $parsed = parse_url($data['old_url']);
            $oldUrlPath = $parsed['path'] ?? '/';
            
            // Dọn sạch tiền tố /bai-viet/ và /tin-tuc/ thành Catch-All Route domain/{slug}
            $newUrl = preg_replace('#^/(tin-tuc|bai-viet)/#', '/', $data['new_url']);

            // Bỏ qua nếu URL cũ và URL mới trùng nhau để chống vòng lặp redirect
            if (rtrim($oldUrlPath, '/') === rtrim($newUrl, '/')) {
                $skipped++;
                continue;
            }

            // Kiểm tra xem đã tồn tại chưa để tránh trùng lặp
            $exists = Redirect::where('old_url', $oldUrlPath)->exists();
            
            if ($exists) {
                $skipped++;
                continue;
            }

            Redirect::create([
                'old_url' => $oldUrlPath,
                'new_url' => $newUrl,
                'status_code' => 301,
            ]);

            $imported++;
        }

        fclose($file);

        $this->command->info("SEO Redirects Import Completed!");
        $this->command->info("Imported: $imported");
        $this->command->info("Skipped (already exist): $skipped");
    }
}
