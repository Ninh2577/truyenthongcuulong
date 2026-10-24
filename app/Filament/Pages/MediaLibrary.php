<?php

namespace App\Filament\Pages;

use App\Models\MediaFile;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class MediaLibrary extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'NỘI DUNG & TIN TỨC';
    protected static ?string $navigationLabel = 'Thư Viện Media';
    protected static ?string $title = 'Thư Viện Media (DAM)';
    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.media-library';

    public function getSubheading(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        return new \Illuminate\Support\HtmlString('<style>
            .media-card > div.flex.items-center { display: grid !important; grid-template-columns: auto 1fr; grid-template-rows: 1fr auto; padding: 0 !important; }
            .media-card .fi-ta-record-checkbox { grid-column: 1; grid-row: 2; margin: 12px !important; align-self: center; z-index: 10; }
            .media-card > div.flex.items-center > div.w-full { display: contents !important; }
            .media-card > div.flex.items-center > div.w-full > .flex-1 { grid-column: 1 / -1; grid-row: 1; width: 100%; overflow: hidden; }
            .media-card > div.flex.items-center > div.w-full > :nth-child(2) { grid-column: 2; grid-row: 2; display: flex; justify-content: flex-end; padding: 8px 12px; }
        </style>');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(MediaFile::query())
            ->defaultSort('created_at', 'desc')
            ->contentGrid([
                'md' => 3,
                'xl' => 4,
                '2xl' => 5,
            ])
            ->recordClasses('media-card overflow-hidden')
            ->columns([
                \Filament\Tables\Columns\Layout\Stack::make([
                    ImageColumn::make('url')
                        ->label('Hình ảnh')
                        ->state(fn ($record) => $record->url)
                        ->height('160px')
                        ->width('100%')
                        ->extraImgAttributes(['class' => 'object-cover w-full h-[160px] bg-gray-50 dark:bg-gray-800']),
                    \Filament\Tables\Columns\Layout\Stack::make([
                        TextColumn::make('filename')
                            ->searchable()
                            ->wrap()
                            ->lineClamp(2)
                            ->size('sm')
                            ->weight('bold')
                            ->alignCenter(),
                        TextColumn::make('size_formatted')
                            ->size('xs')
                            ->color('gray')
                            ->alignCenter(),
                        TextColumn::make('usage_info')
                            ->state(function ($record) {
                                if ($record->isUiAsset()) {
                                    return '🎨 Website / Giao diện mẫu';
                                }
                                if ($record->usage_count > 0) {
                                    return "✅ Bài viết ({$record->usage_count})";
                                }
                                return '⚪ Chưa liên kết nội dung';
                            })
                            ->badge()
                            ->color(function ($record) {
                                if ($record->isUiAsset()) {
                                    return 'info';
                                }
                                return $record->usage_count > 0 ? 'success' : 'gray';
                            })
                            ->size('xs')
                            ->alignCenter(),
                    ])->space(1)->extraAttributes(['class' => 'p-2 w-full']),
                ])->space(0)->extraAttributes(['class' => 'w-full']),
            ])
            ->filters([
                SelectFilter::make('folder')
                    ->label('Thư mục / Nguồn')
                    ->options([
                        'images' => '🎨 Giao diện & Dịch vụ (images)',
                        'uploads' => '📄 Uploads bài viết (uploads)',
                        'partners' => '🤝 Đối tác (partners)',
                        'clients' => '🏢 Khách hàng (clients)',
                        'projects' => '💼 Dự án (projects)',
                        'photos' => '📷 Thư viện ảnh (photos)',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['value'])) {
                            $query->where('path', 'like', $data['value'] . '/%');
                        }
                    }),
                SelectFilter::make('usage_status')
                    ->label('Phân loại sử dụng')
                    ->options([
                        'ui' => '🎨 Giao diện & Mẫu website (UI / Templates)',
                        'posts' => '✅ Đang dùng trong bài viết & dự án',
                        'unused' => '⚪ File tải lên chưa liên kết (Uploads chờ dùng)',
                    ])
                    ->query(function (Builder $query, array $data) {
                        $val = $data['value'] ?? null;
                        if ($val === 'ui') {
                            $query->uiAssets();
                        } elseif ($val === 'posts') {
                            $query->usedInContent();
                        } elseif ($val === 'unused') {
                            $query->unusedUploads();
                        }
                    }),
                SelectFilter::make('folder_year')
                    ->label('Năm tải lên')
                    ->options([
                        '2026' => '2026',
                        '2025' => '2025',
                        '2024' => '2024',
                        '2023' => '2023',
                        '2022' => '2022',
                        '2021' => '2021',
                        '2020' => '2020',
                        '2019' => '2019',
                        'null' => 'Không phân loại / Khác',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (isset($data['value'])) {
                            if ($data['value'] === 'null') {
                                $query->whereNull('folder_year');
                            } else {
                                $query->where('folder_year', $data['value']);
                            }
                        }
                    }),
                Filter::make('unused')
                    ->label('Chỉ ảnh chưa liên kết nội dung')
                    ->query(fn (Builder $query): Builder => $query->unusedUploads())
                    ->default(fn () => request()->has('unused'))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->hiddenLabel()
                    ->tooltip('Xem phóng to')
                    ->modalHeading(fn($record) => $record->filename)
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->form([
                        \Filament\Forms\Components\Placeholder::make('image')
                            ->hiddenLabel()
                            ->content(fn($record) => new \Illuminate\Support\HtmlString(
                                '<div class="flex justify-center p-2 bg-gray-50 dark:bg-gray-900 rounded-lg">' .
                                '<img src="' . $record->url . '" class="max-h-[75vh] w-auto max-w-full object-contain rounded shadow" />' .
                                '</div>'
                            )),
                    ]),
                Tables\Actions\EditAction::make()
                    ->hiddenLabel()
                    ->tooltip('Chi tiết / Chỉnh sửa')
                    ->modalHeading('Chi tiết Media')
                    ->modalWidth('6xl')
                    ->form([
                        \Filament\Forms\Components\Grid::make(3)
                            ->schema([
                                \Filament\Forms\Components\Group::make()
                                    ->schema([
                                        \Filament\Forms\Components\Placeholder::make('preview')
                                            ->hiddenLabel()
                                            ->content(fn ($record) => new \Illuminate\Support\HtmlString(
                                                '<div class="flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg p-2 min-h-[200px]">' .
                                                '<img src="' . $record->url . '" style="max-height: 220px; object-fit: contain; border-radius: 6px;" />' .
                                                '</div>'
                                            )),
                                        \Filament\Forms\Components\Placeholder::make('info')
                                            ->hiddenLabel()
                                            ->content(function ($record) {
                                                if ($record->isUiAsset()) {
                                                    $usageBadge = "<span class='px-2 py-0.5 rounded text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300'>🎨 Tài nguyên giao diện website (UI Asset)</span>";
                                                    $usageHtml = "<div class='mt-2'><b>Trạng thái:</b> {$usageBadge}</div>" .
                                                                 "<div class='text-xs text-blue-600 dark:text-blue-400 mt-1'>Ảnh này phục vụ cấu trúc giao diện, dịch vụ, logo hoặc template của website. Được bảo vệ an toàn để không làm vỡ trang.</div>";
                                                } elseif ($record->usage_count > 0) {
                                                    $usageBadge = "<span class='px-2 py-0.5 rounded text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300'>✅ Đang dùng ở {$record->usage_count} nơi</span>";
                                                    $usageHtml = "<div class='mt-2'><b>Trạng thái:</b> {$usageBadge}</div>";
                                                    
                                                    $locations = [];
                                                    $posts = \App\Models\Post::where('content', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('thumbnail', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('thumbnail', 'LIKE', '%' . $record->filename . '%')
                                                        ->take(3)->get();
                                                    foreach ($posts as $post) {
                                                        $url = \App\Filament\Resources\PostResource::getUrl('edit', ['record' => $post->id]);
                                                        $locations[] = 'Bài viết: <a href="' . $url . '" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">' . $post->title . ' <span class="text-[10px] ml-1 opacity-70">🔗</span></a>';
                                                    }
                                                    
                                                    $caseStudies = \App\Models\CaseStudy::where('content', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('thumbnail', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('thumbnail', 'LIKE', '%' . $record->filename . '%')
                                                        ->take(3)->get();
                                                    foreach ($caseStudies as $cs) {
                                                        $url = \App\Filament\Resources\CaseStudyResource::getUrl('edit', ['record' => $cs->id]);
                                                        $locations[] = 'Case Study: <a href="' . $url . '" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">' . $cs->title . ' <span class="text-[10px] ml-1 opacity-70">🔗</span></a>';
                                                    }
                                                    
                                                    $partners = \App\Models\Partner::where('logo', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('logo', 'LIKE', '%' . $record->filename . '%')
                                                        ->take(3)->get();
                                                    foreach ($partners as $p) {
                                                        $url = \App\Filament\Resources\PartnerResource::getUrl('edit', ['record' => $p->id]);
                                                        $locations[] = 'Đối tác: <a href="' . $url . '" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">' . $p->name . ' <span class="text-[10px] ml-1 opacity-70">🔗</span></a>';
                                                    }
                                                    
                                                    $clients = \App\Models\Client::where('logo', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('logo', 'LIKE', '%' . $record->filename . '%')
                                                        ->take(3)->get();
                                                    foreach ($clients as $c) {
                                                        $url = \App\Filament\Resources\ClientResource::getUrl('edit', ['record' => $c->id]);
                                                        $locations[] = 'Khách hàng: <a href="' . $url . '" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">' . $c->name . ' <span class="text-[10px] ml-1 opacity-70">🔗</span></a>';
                                                    }
                                                    
                                                    if (!empty($locations)) {
                                                        $usageHtml .= "<ul class='list-disc pl-5 mt-1 text-xs text-gray-700 dark:text-gray-300'>";
                                                        foreach (array_slice($locations, 0, 3) as $loc) {
                                                            $usageHtml .= "<li>{$loc}</li>";
                                                        }
                                                        if (count($locations) > 3 || $record->usage_count > 3) {
                                                            $usageHtml .= "<li class='text-gray-500'>... và các trang nội dung khác</li>";
                                                        }
                                                        $usageHtml .= "</ul>";
                                                    }
                                                } else {
                                                    $usageBadge = "<span class='px-2 py-0.5 rounded text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300'>⚪ Chưa liên kết nội dung</span>";
                                                    $usageHtml = "<div class='mt-2'><b>Trạng thái:</b> {$usageBadge}</div>" .
                                                                 "<div class='text-xs text-gray-500 mt-1'>File ảnh này đã tải lên thư viện nhưng hiện chưa được chèn vào bài viết hoặc giao diện nào.</div>";
                                                }

                                                return new \Illuminate\Support\HtmlString(
                                                    "<div class='text-sm text-gray-600 dark:text-gray-400 space-y-1'>" .
                                                    "<div><b>Tên file:</b> {$record->filename}</div>" .
                                                    "<div><b>Đường dẫn:</b> <code class='text-xs bg-gray-100 dark:bg-gray-800 px-1 py-0.5 rounded'>{$record->path}</code></div>" .
                                                    "<div><b>Kích thước:</b> {$record->size_formatted}</div>" .
                                                    ($record->width && $record->height ? "<div><b>Độ phân giải:</b> {$record->width} x {$record->height} px</div>" : "") .
                                                    "<div><b>Loại:</b> {$record->mime_type}</div>" .
                                                    "<div><b>Ngày cập nhật:</b> {$record->created_at->format('d/m/Y H:i')}</div>" .
                                                    $usageHtml .
                                                    "</div>"
                                                );
                                            }),
                                        \Filament\Forms\Components\Actions::make([
                                            \Filament\Forms\Components\Actions\Action::make('download')
                                                ->label('Tải về')
                                                ->icon('heroicon-m-arrow-down-tray')
                                                ->color('gray')
                                                ->action(function ($record) {
                                                    $fullPath = $record->full_path;
                                                    if (file_exists($fullPath)) {
                                                        return response()->download($fullPath, $record->filename);
                                                    }
                                                    Notification::make()->title('File không tồn tại trên hệ thống')->danger()->send();
                                                }),
                                            \Filament\Forms\Components\Actions\Action::make('delete_media')
                                                ->label('Xóa ảnh')
                                                ->icon('heroicon-m-trash')
                                                ->color('danger')
                                                ->action(function ($record, $livewire, $component) {
                                                    if ($record->isUiAsset()) {
                                                        Notification::make()
                                                            ->title('Không thể xóa ảnh tài nguyên giao diện!')
                                                            ->body('Đây là ảnh thuộc bộ giao diện, dịch vụ hoặc nhận diện của website. Xóa sẽ gây hỏng hiển thị trang chủ!')
                                                            ->danger()
                                                            ->send();
                                                        return;
                                                    }

                                                    $msg = $record->usage_count > 0 
                                                        ? "Ảnh này đang được sử dụng ở <b>{$record->usage_count}</b> nơi.<br>Xóa ảnh này sẽ làm <b>MẤT ẢNH</b> ở các bài viết đang sử dụng!<br>Bạn vẫn nhất quyết muốn xóa?"
                                                        : "Bạn có chắc chắn muốn xóa ảnh này không? File thực tế trên máy chủ cũng sẽ bị xóa vĩnh viễn.";

                                                    Notification::make()
                                                        ->title('Xác nhận xóa ảnh')
                                                        ->body(new \Illuminate\Support\HtmlString($msg))
                                                        ->danger()
                                                        ->persistent()
                                                        ->actions([
                                                             \Filament\Notifications\Actions\Action::make('confirm_delete')
                                                                ->label('Vẫn Xóa')
                                                                ->color('danger')
                                                                ->button()
                                                                ->close()
                                                                ->action(function () use ($record, $livewire) {
                                                                    if (file_exists($record->full_path)) {
                                                                        @unlink($record->full_path);
                                                                    }
                                                                    $record->delete();
                                                                    $livewire->unmountTableAction();
                                                                    Notification::make()->title('Đã xóa ảnh thành công.')->success()->send();
                                                                }),
                                                            \Filament\Notifications\Actions\Action::make('cancel')
                                                                ->label('Hủy bỏ')
                                                                ->color('gray')
                                                                ->close(),
                                                        ])
                                                        ->send();
                                                }),
                                        ])->fullWidth(),
                                    ])
                                    ->columnSpan(1),
                                
                                \Filament\Forms\Components\Group::make()
                                    ->schema([
                                        \Filament\Forms\Components\Placeholder::make('full_url')
                                            ->label('URL File Trực Tiếp')
                                            ->content(function ($record) {
                                                $url = $record->url;
                                                return new \Illuminate\Support\HtmlString('
                                                    <div class="flex items-center gap-2 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-white/5 shadow-sm">
                                                        <input type="text" value="' . $url . '" class="w-full bg-transparent border-none focus:ring-0 text-sm p-0 dark:text-white" readonly id="url-input-' . $record->id . '">
                                                        <button type="button" class="text-primary-600 hover:text-primary-500 transition-colors" onclick="navigator.clipboard.writeText(document.getElementById(\'url-input-' . $record->id . '\').value).then(() => { try { new FilamentNotification().title(\'Đã copy URL thành công!\').success().send(); } catch(e) { alert(\'Đã copy URL thành công!\'); } });">
                                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                ');
                                            }),
                                        \Filament\Forms\Components\Grid::make(2)
                                            ->schema([
                                                \Filament\Forms\Components\TextInput::make('title')
                                                    ->label('Tiêu đề (Title)'),
                                                \Filament\Forms\Components\TextInput::make('alt_text')
                                                    ->label('Mô tả SEO (Alt Text)'),
                                            ]),
                                        \Filament\Forms\Components\Textarea::make('caption')
                                            ->label('Chú thích (Caption)')
                                            ->rows(2),
                                        \Filament\Forms\Components\Textarea::make('description')
                                            ->label('Miêu tả của ảnh (Description)')
                                            ->rows(2),
                                    ])
                                    ->columnSpan(2),
                            ])
                    ]),
                Tables\Actions\DeleteAction::make()
                    ->hiddenLabel()
                    ->tooltip('Xóa')
                    ->action(function ($record, Tables\Actions\DeleteAction $action) {
                        if ($record->isUiAsset()) {
                            Notification::make()
                                ->title('Không thể xóa ảnh tài nguyên giao diện!')
                                ->body('Ảnh này phục vụ hiển thị giao diện hệ thống. Không được phép xóa.')
                                ->danger()
                                ->send();
                            $action->cancel();
                            return;
                        }

                        if ($record->usage_count > 0) {
                            Notification::make()
                                ->title('Không thể xóa ảnh này!')
                                ->body("Ảnh này đang được sử dụng ở {$record->usage_count} nơi. Xóa có thể làm vỡ hình ảnh hiển thị trên trang.")
                                ->danger()
                                ->send();
                            $action->cancel();
                            return;
                        }

                        if (file_exists($record->full_path)) {
                            @unlink($record->full_path);
                        }
                        $record->delete();
                        Notification::make()->title('Đã xóa ảnh thành công.')->success()->send();
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('delete')
                        ->label('Xóa hàng loạt ảnh chưa dùng')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $deleted = 0;
                            $skipped = 0;
                            foreach ($records as $record) {
                                if ($record->isUiAsset() || $record->usage_count > 0) {
                                    $skipped++;
                                } else {
                                    if (file_exists($record->full_path)) {
                                        @unlink($record->full_path);
                                    }
                                    $record->delete();
                                    $deleted++;
                                }
                            }
                            if ($skipped > 0) {
                                Notification::make()
                                    ->title('Cảnh báo xóa hàng loạt')
                                    ->body("Đã xóa $deleted ảnh chưa dùng. Tự động bảo vệ $skipped ảnh (giao diện hoặc bài viết đang dùng).")
                                    ->warning()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Thành công')
                                    ->body("Đã xóa $deleted ảnh.")
                                    ->success()
                                    ->send();
                            }
                        }),
                ]),
            ])
            ->headerActions([
                Action::make('sync_media')
                    ->label('Đồng bộ ảnh & Kiểm tra sử dụng')
                    ->icon('heroicon-m-arrow-path')
                    ->color('primary')
                    ->action(function () {
                        $count = static::syncDiskMedia(false);
                        $stats = static::recalculateUsage();
                        Notification::make()
                            ->title('Đồng bộ & Kiểm tra hoàn tất')
                            ->body("Đã quét {$stats['total']} ảnh trong project. Giao diện: {$stats['ui']} ảnh, Đang dùng trong bài viết: {$stats['used_posts']} ảnh, Chưa dùng: {$stats['unused_uploads']} ảnh.")
                            ->success()
                            ->send();
                    }),
                Action::make('upload')
                    ->label('Tải ảnh lên')
                    ->icon('heroicon-m-arrow-up-tray')
                    ->form([
                        FileUpload::make('images')
                            ->label('Chọn ảnh')
                            ->multiple()
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->maxSize(5120) // 5MB
                            ->validationMessages([
                                'max' => 'File vượt quá 5MB.',
                                'mimes' => 'Định dạng không được hỗ trợ. Chỉ chấp nhận jpg, png, webp, gif.',
                            ])
                            ->directory('uploads/' . date('Y'))
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $count = 0;
                        foreach ($data['images'] as $path) {
                            $absolutePath = \Illuminate\Support\Facades\Storage::disk('public')->path($path);
                            $size = @filesize($absolutePath) ?: 0;
                            $imageSize = @getimagesize($absolutePath);
                            
                            $width = $imageSize ? $imageSize[0] : null;
                            $height = $imageSize ? $imageSize[1] : null;
                            $mime = $imageSize ? $imageSize['mime'] : 'image/jpeg';
                            
                            MediaFile::create([
                                'filename' => basename($path),
                                'original_name' => basename($path),
                                'path' => $path,
                                'disk' => 'public',
                                'mime_type' => $mime,
                                'size' => $size,
                                'width' => $width,
                                'height' => $height,
                                'folder_year' => date('Y'),
                                'usage_count' => 0,
                            ]);
                            $count++;
                        }
                        Notification::make()
                            ->title('Thành công')
                            ->body("Đã tải lên $count ảnh.")
                            ->success()
                            ->send();
                    })
            ])
            ->emptyStateHeading('Chưa có hình ảnh nào được lập chỉ mục')
            ->emptyStateDescription('Hệ thống phát hiện ảnh trên máy chủ chưa được quét vào thư viện. Hãy bấm nút bên dưới để quét và nạp toàn bộ ảnh vào hệ thống.')
            ->emptyStateIcon('heroicon-o-photo')
            ->emptyStateActions([
                Tables\Actions\Action::make('sync_now')
                    ->label('Quét & Đồng bộ ảnh ngay')
                    ->icon('heroicon-m-arrow-path')
                    ->button()
                    ->color('primary')
                    ->action(function () {
                        $count = static::syncDiskMedia(false);
                        $stats = static::recalculateUsage();
                        Notification::make()
                            ->title('Đồng bộ thành công')
                            ->body("Đã quét {$stats['total']} ảnh.")
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public function mount(): void
    {
        $total = MediaFile::count();
        $uiCount = MediaFile::where('path', 'like', 'images/%')->count();
        if ($total === 0 || $uiCount === 0) {
            static::syncDiskMedia();
            static::recalculateUsage();
        }
    }

    public static function syncDiskMedia(bool $forceAll = false): int
    {
        @set_time_limit(300);
        
        $existingPaths = MediaFile::pluck('path')->flip()->toArray();
        
        $sources = [
            'uploads' => storage_path('app/public/uploads'),
            'partners' => storage_path('app/public/partners'),
            'clients' => storage_path('app/public/clients'),
            'photos' => storage_path('app/public/photos'),
            'projects' => storage_path('app/public/projects'),
            'images' => public_path('images'),
        ];
        
        $validExts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
        $batch = [];
        $now = now();
        $count = 0;
        
        foreach ($sources as $folderKey => $folderPath) {
            if (!file_exists($folderPath)) {
                continue;
            }
            
            $files = \Illuminate\Support\Facades\File::allFiles($folderPath);
            foreach ($files as $file) {
                $ext = strtolower($file->getExtension());
                if (!in_array($ext, $validExts)) {
                    continue;
                }
                
                $relPath = $folderKey . '/' . str_replace('\\', '/', $file->getRelativePathname());
                if (isset($existingPaths[$relPath]) && !$forceAll) {
                    continue;
                }
                
                $filename = $file->getFilename();
                $size = $file->getSize();
                
                $folderYear = null;
                if (preg_match('/(?:uploads|photos)\/(\d{4})\//', $relPath, $m)) {
                    $folderYear = $m[1];
                } else {
                    $folderYear = date('Y', $file->getMTime());
                }
                
                $mime = match($ext) {
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'webp' => 'image/webp',
                    'gif' => 'image/gif',
                    'svg' => 'image/svg+xml',
                    default => 'image/jpeg',
                };
                
                $isUi = str_starts_with($relPath, 'images/');
                
                $batch[] = [
                    'filename' => $filename,
                    'original_name' => $filename,
                    'path' => $relPath,
                    'disk' => 'public',
                    'mime_type' => $mime,
                    'size' => $size,
                    'width' => null,
                    'height' => null,
                    'folder_year' => $folderYear,
                    'alt_text' => null,
                    'caption' => null,
                    'usage_count' => $isUi ? 1 : 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                
                if (count($batch) >= 200) {
                    \Illuminate\Support\Facades\DB::table('media_files')->insertOrIgnore($batch);
                    $count += count($batch);
                    $batch = [];
                }
            }
        }
        
        if (!empty($batch)) {
            \Illuminate\Support\Facades\DB::table('media_files')->insertOrIgnore($batch);
            $count += count($batch);
        }
        
        return $count;
    }

    public static function recalculateUsage(): array
    {
        return \App\Services\MediaUsageService::recalculateAll();
    }
}
