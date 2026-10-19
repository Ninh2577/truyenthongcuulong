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
            // Nút Đăng bài viết (Xuất bản)
            Actions\Action::make('publish')
                ->label('Đăng bài viết')
                ->color('success')
                ->icon('heroicon-o-paper-airplane')
                ->action(function () {
                    $this->data['status'] = 'published';
                    if (empty($this->data['published_at'])) {
                        $this->data['published_at'] = now();
                    }
                    $this->create();
                }),

            // Nút Lưu nháp
            Actions\Action::make('save_draft')
                ->label('Lưu nháp')
                ->color('warning')
                ->icon('heroicon-o-archive-box')
                ->action(function () {
                    $this->data['status'] = 'draft';
                    $this->create();
                }),

            // Xem trước (tạo rồi redirect sang preview)
            Actions\Action::make('preview')
                ->label('Xem trước')
                ->color('info')
                ->icon('heroicon-o-eye')
                ->action(function () {
                    $this->redirectToPreview = true;
                    $this->create();
                }),

            // Quay lại
            $this->getCancelFormAction()
                ->label('Quay lại'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['author_id'])) {
            $data['author_id'] = auth()->id();
        }

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        $status = $this->data['status'] ?? 'draft';
        return $status === 'published' ? 'Đã xuất bản bài viết thành công!' : 'Đã lưu bản nháp bài viết!';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
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
