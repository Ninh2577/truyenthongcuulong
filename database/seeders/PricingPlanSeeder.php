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

        $activeIds = [];
        foreach ($plans as $index => $planData) {
            $plan = PricingPlan::updateOrCreate(
                [
                    'service_group' => $planData['service_group'],
                    'tier_name' => $planData['tier_name'],
                ],
                [
                    'price_display' => $planData['price_display'],
                    'price_note' => $planData['price_note'] ?? null,
                    'is_featured' => $planData['is_featured'] ?? false,
                    'features' => $planData['features'] ?? [],
                    'order' => $index,
                    'is_active' => true,
                    'show_on_pricing_page' => (bool) ($planData['show_on_pricing_page'] ?? false),
                    'show_on_service_page' => (bool) ($planData['show_on_service_page'] ?? false),
                    'target_page' => $planData['target_page'] ?? null,
                    'thumbnail' => $planData['thumbnail'] ?? null,
                    'description' => $planData['description'] ?? null,
                    'cta_label' => $planData['cta_label'] ?? null,
                ]
            );
            $activeIds[] = $plan->id;
        }

        // Clean up obsolete plans that are no longer in pricing.json
        PricingPlan::whereNotIn('id', $activeIds)->delete();
    }
}
