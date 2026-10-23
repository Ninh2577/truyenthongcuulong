<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (empty($data['logo'])) {
            $client = $this->getRecord();
            if ($client && $client->logo_url) {
                $path = parse_url($client->logo_url, PHP_URL_PATH);
                $data['logo'] = $path ?: $client->logo_url;
            }
        }

        return $data;
    }
}
