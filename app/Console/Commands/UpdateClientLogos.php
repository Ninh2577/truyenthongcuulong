<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateClientLogos extends Command
{
    protected $signature = 'app:update-client-logos';
    protected $description = 'Update client logos from clearbit';

    public function handle()
    {
        $domains = [
            'Ngân Hàng Sacombank' => 'sacombank.com.vn',
            'Ngân Hàng ACB' => 'acb.com.vn',
            'VietABank' => 'vietabank.com.vn',
            'Ngân Hàng VBI' => 'vbi.vietinbank.vn',
            'Rakus' => 'rakus.vn',
            'BTM Global' => 'btmglobal.com',
            'TBR' => 'tbr.vn',
            'Alo 360' => 'alo360.com',
            'C.P. Vietnam' => 'cp.com.vn',
            'Tata International' => 'tatainternational.com',
            'Hoya Lens Việt Nam' => 'hoyavision.com',
            'Kinh Đô' => 'kdc.vn',
            'Cholontourist' => 'cholontourist.vn',
            'Swarovski' => 'swarovski.com',
            'Trường Đại Học Văn Hiến' => 'vhu.edu.vn',
            'Phòng Khám Đa Khoa Gia Phước' => 'phongkhamgiaphuoc.vn',
        ];

        Storage::disk('public')->makeDirectory('clients');

        foreach ($domains as $name => $domain) {
            $client = Client::where('name', $name)->first();
            if ($client) {
                $this->info("Downloading logo for {$name} ({$domain})...");
                $url = "https://logo.clearbit.com/{$domain}";
                
                try {
                    $response = Http::timeout(5)->get($url);
                    if ($response->successful()) {
                        $filename = 'clients/' . Str::slug($name) . '.png';
                        Storage::disk('public')->put($filename, $response->body());
                        $client->update(['logo' => $filename]);
                        $this->info("Saved logo: {$filename}");
                    } else {
                        $this->error("Failed to download logo for {$name}");
                    }
                } catch (\Exception $e) {
                    $this->error("Error downloading for {$name}: " . $e->getMessage());
                }
            }
        }
        
        $this->info('Done!');
    }
}
