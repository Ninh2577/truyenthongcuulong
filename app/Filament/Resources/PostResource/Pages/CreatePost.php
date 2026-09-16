<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

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
