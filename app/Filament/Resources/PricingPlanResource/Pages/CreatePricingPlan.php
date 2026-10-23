<?php

namespace App\Filament\Resources\PricingPlanResource\Pages;

use App\Filament\Resources\PricingPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePricingPlan extends CreateRecord
{
    protected static string $resource = PricingPlanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['thumbnail'])) {
            $group = $data['service_group'] ?? 'web';
            $data['thumbnail'] = match ($group) {
                'web' => '/images/services/service_card_2_webapp.png',
                'marketing' => '/images/seo/hero-seo.png',
                'tvc' => '/images/services/service_card_1_film.png',
                'ui-ux' => '/images/services/service_card_6_branding.png',
                'website-care' => '/images/services/service_card_2_webapp.png',
                'event-photography' => '/images/chup-anh-su-kien/category-hoi-nghi.png',
                'event-videography' => '/images/services/service_card_1_film.png',
                'teambuilding-photography' => !empty($data['is_featured']) ? '/images/chup-anh-teambuilding/pkg_advanced.png' : '/images/chup-anh-teambuilding/pkg_basic.png',
                'teambuilding-videography' => '/images/chup-anh-teambuilding/hero_teambuilding.png',
                default => '/images/services/service_card_2_webapp.png',
            };
        }

        return $data;
    }
}
