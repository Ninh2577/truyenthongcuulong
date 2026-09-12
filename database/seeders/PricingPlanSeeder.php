<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPlan;
use Illuminate\Support\Facades\File;

class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(base_path('pricing.json'));
        $plans = json_decode($json, true);

        foreach ($plans as $index => $planData) {
            PricingPlan::create([
                'service_group' => $planData['service_group'],
                'tier_name' => $planData['tier_name'],
                'price_display' => $planData['price_display'],
                'price_note' => $planData['price_note'] ?? null,
                'is_featured' => $planData['is_featured'] ?? false,
                'features' => $planData['features'] ?? [],
                'order' => $index,
                'is_active' => true,
            ]);
        }
    }
}
