<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\File;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(base_path('clients.json'));
        $clients = json_decode($json, true);

        foreach ($clients as $index => $clientData) {
            Client::create([
                'name' => $clientData['name'],
                'slug' => $clientData['slug'] ?? \Str::slug($clientData['name']),
                'industry_category' => $clientData['industry_category'] ?? null,
                'logo' => $clientData['logo'] ?? null,
                'service_used' => $clientData['service_used'] ?? null,
                'order' => $index,
                'is_active' => true,
            ]);
        }
    }
}
