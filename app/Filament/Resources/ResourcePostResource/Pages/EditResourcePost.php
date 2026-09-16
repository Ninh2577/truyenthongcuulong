<?php

namespace App\Filament\Resources\ResourcePostResource\Pages;

use App\Filament\Resources\ResourcePostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\URL;
use Filament\Notifications\Notification;

class EditResourcePost extends EditRecord
{
    protected static string $resource = ResourcePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->label('Xem trước')
                ->color('info')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) => URL::signedRoute('post.preview', ['post' => $record->id]))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return array_merge([
            Actions\Action::make('save_draft')
                ->label('Lưu nháp')
                ->color('warning')
                ->icon('heroicon-o-archive-box')
                ->action(function () {
                    $this->data['status'] = 'draft';
                    $this->save();
                    Notification::make()->title('Đã lưu bản nháp!')->success()->send();
                }),
        ], parent::getFormActions());
    }
}
