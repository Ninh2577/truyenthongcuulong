<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\URL;
use Filament\Notifications\Notification;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('publish_header')
                ->label('Đăng bài viết')
                ->color('success')
                ->icon('heroicon-o-paper-airplane')
                ->visible(fn ($record) => $record->status !== 'published')
                ->action(function () {
                    $this->data['status'] = 'published';
                    if (empty($this->data['published_at'])) {
                        $this->data['published_at'] = now();
                    }
                    $this->save();
                    Notification::make()->title('Đã xuất bản bài viết thành công!')->success()->send();
                }),
            Actions\Action::make('preview')
                ->label('Xem trước')
                ->color('info')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) => URL::signedRoute('post.preview', ['post' => $record->id]))
                ->openUrlInNewTab(),
            Actions\Action::make('duplicate')
                ->label('Nhân bản')
                ->color('gray')
                ->icon('heroicon-o-document-duplicate')
                ->action(function ($record) {
                    $replica = $record->replicate([
                        'views',
                        'created_at',
                        'updated_at',
                    ]);
                    $replica->title = '[Bản sao] ' . $record->title;
                    $replica->slug = \Illuminate\Support\Str::slug($replica->title) . '-' . \Illuminate\Support\Str::random(5);
                    $replica->status = 'draft';
                    $replica->author_id = auth()->id() ?? $record->author_id;
                    $replica->published_at = null;
                    $replica->save();

                    Notification::make()->title('Đã nhân bản bài viết thành công!')->success()->send();

                    $this->redirect(PostResource::getUrl('edit', ['record' => $replica->id]));
                }),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('publish')
                ->label(fn () => $this->record->status === 'published' ? 'Cập nhật & Đăng bài' : 'Đăng bài viết')
                ->color('success')
                ->icon('heroicon-o-paper-airplane')
                ->action(function () {
                    $this->data['status'] = 'published';
                    if (empty($this->data['published_at'])) {
                        $this->data['published_at'] = now();
                    }
                    $this->save();
                    Notification::make()->title('Đã xuất bản bài viết thành công!')->success()->send();
                }),
            Actions\Action::make('save_draft')
                ->label('Lưu nháp')
                ->color('warning')
                ->icon('heroicon-o-archive-box')
                ->action(function () {
                    $this->data['status'] = 'draft';
                    $this->save();
                    Notification::make()->title('Đã chuyển bài viết về bản nháp!')->success()->send();
                }),
            $this->getSaveFormAction()
                ->label('Lưu thay đổi'),
            $this->getCancelFormAction()
                ->label('Quay lại'),
        ];
    }
}
