<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(base_path('clients.json'));
        // Remove UTF-8 BOM if present
        $json = preg_replace('/^\xEF\xBB\xBF/', '', $json);
        $clients = json_decode($json, true) ?: [];

        // Check if P.A Việt Nam is included, if not add it
        $hasPA = false;
        foreach ($clients as $c) {
            if (isset($c['name']) && str_contains(strtolower($c['name']), 'p.a')) {
                $hasPA = true;
                break;
            }
        }
        if (!$hasPA) {
            $clients[] = [
                'name' => 'P.A Việt Nam',
                'slug' => 'pa-viet-nam',
                'industry_category' => 'tech',
                'logo' => '/images/logoKhachHang/31.png',
                'service_used' => 'Domain, Máy Chủ Cloud & Bảo Mật',
                'description' => 'Nhà đăng ký tên miền và hạ tầng điện toán đám mây lớn nhất Việt Nam. Đối tác tin cậy cung cấp hạ tầng máy chủ chuẩn Tier 3 và giải pháp Cloud bảo mật cao cho các dự án của Cửu Long.',
                'year_started' => '2021',
                'representative_name' => 'Nguyễn Hữu Trọng',
                'representative_role' => 'Trưởng ban Khách hàng Doanh nghiệp',
            ];
        }

        // Delete previous records and re-seed clean real project records
        Client::truncate();

        foreach ($clients as $index => $clientData) {
            Client::create([
                'id' => $index + 1,
                'name' => $clientData['name'],
                'slug' => $clientData['slug'] ?? Str::slug($clientData['name']),
                'industry_category' => $clientData['industry_category'] ?? null,
                'logo' => $clientData['logo'] ?? "/images/logoKhachHang/" . (($index % 48) + 1) . ".png",
                'description' => $clientData['description'] ?? null,
                'service_used' => $clientData['service_used'] ?? null,
                'year_started' => $clientData['year_started'] ?? '2022',
                'order' => $index + 1,
                'is_active' => true,
                'show_on_home' => true,
                'show_on_media' => true,
                'show_on_clients' => true,
            ]);
        }
    }
}
