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
        $clients = json_decode($json, true);

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
            ]);
        }
    }
}
