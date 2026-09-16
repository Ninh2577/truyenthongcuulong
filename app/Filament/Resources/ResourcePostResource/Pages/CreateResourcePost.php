<?php

namespace App\Filament\Resources\ResourcePostResource\Pages;

use App\Filament\Resources\ResourcePostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateResourcePost extends CreateRecord
{
    protected static string $resource = ResourcePostResource::class;

    protected function getFormActions(): array
    {
        return array_merge([
            Actions\Action::make('save_draft')
                ->label('Lưu nháp')
                ->color('warning')
                ->icon('heroicon-o-archive-box')
                ->action(function () {
                    $this->data['status'] = 'draft';
                    $this->create();
                    Notification::make()->title('Đã lưu bản nháp!')->success()->send();
                }),
        ], parent::getFormActions());
    }
}
