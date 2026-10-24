<?php

namespace App\Filament\Resources\CaseStudyResource\Pages;

use App\Filament\Resources\CaseStudyResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCaseStudy extends EditRecord
{
    protected static string $resource = CaseStudyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Đã cập nhật dự án thành công')
            ->body('Các thay đổi của dự án đã được lưu vào hệ thống.');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save_top')
                ->label('Lưu thay đổi')
                ->icon('heroicon-o-check')
                ->color('primary')
                ->keyBindings(['mod+s'])
                ->action('save'),

            Actions\Action::make('preview')
                ->label('Xem trên web')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(fn ($record) => $record?->group === 'media'
                    ? url('/du-an/media#' . ($record->slug ?? ''))
                    : url('/du-an#' . ($record->slug ?? ''))
                )
                ->openUrlInNewTab(),

            Actions\Action::make('back')
                ->label('Quay lại danh sách')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(fn () => CaseStudyResource::getUrl('index')),

            Actions\DeleteAction::make()
                ->label('Xóa dự án'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Lưu thay đổi')
                ->icon('heroicon-o-check'),
            $this->getCancelFormAction()
                ->label('Quay lại danh sách')
                ->icon('heroicon-o-arrow-left'),
        ];
    }
}
