<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\URL;


class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    /**
     * Flag để biết sau khi tạo xong cần chuyển đến xem trước hay không
     */
    public bool $redirectToPreview = false;

    protected function getFormActions(): array
    {
        return [
            // Xem trước (tạo rồi redirect sang preview)
            Actions\Action::make('preview')
                ->label('Xem trước')
                ->color('info')
                ->icon('heroicon-o-eye')
                ->action(function () {
                    $this->redirectToPreview = true;
                    $this->create();
                }),

            // Nút Tạo — label đổi theo trạng thái đang chọn
            $this->getCreateFormAction()
                ->label(function () {
                    $status = $this->data['status'] ?? 'draft';
                    return $status === 'published' ? 'Xuất bản' : 'Lưu Nháp';
                })
                ->icon(function () {
                    $status = $this->data['status'] ?? 'draft';
                    return $status === 'published'
                        ? 'heroicon-o-globe-alt'
                        : 'heroicon-o-archive-box';
                }),

            // Quay lại
            $this->getCancelFormAction(),
        ];

    }

    protected function afterCreate(): void
    {
        if ($this->redirectToPreview) {
            $record = $this->getRecord();
            $previewUrl = URL::signedRoute('post.preview', ['post' => $record->id]);
            $this->redirect($previewUrl);
        }
    }
}
