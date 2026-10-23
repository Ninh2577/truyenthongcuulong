<?php

namespace App\Filament\Resources\PricingPlanResource\Pages;

use App\Filament\Resources\PricingPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPricingPlan extends EditRecord
{
    protected static string $resource = PricingPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (empty($data['thumbnail'])) {
            $plan = $this->getRecord();
            if ($plan && $plan->thumbnail_url) {
                $path = parse_url($plan->thumbnail_url, PHP_URL_PATH);
                $data['thumbnail'] = $path ?: $plan->thumbnail_url;
            }
        }

        return $data;
    }
}
