<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use Illuminate\Support\Facades\File;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(base_path('partners.json'));
        $partners = json_decode($json, true);

        foreach ($partners as $index => $partnerData) {
            Partner::create([
                'name' => $partnerData['name'],
                'slug' => $partnerData['slug'] ?? \Str::slug($partnerData['name']),
                'tier' => $partnerData['tier'],
                'category' => $partnerData['category'] ?? null,
                'description' => $partnerData['description'] ?? null,
                'tagline' => $partnerData['tagline'] ?? null,
                'image' => $partnerData['image'] ?? null,
                'order' => $index,
                'is_active' => true,
            ]);
        }
    }
}
