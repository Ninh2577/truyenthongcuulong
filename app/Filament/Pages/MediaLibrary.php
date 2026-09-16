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
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class MediaLibrary extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Nội dung chung';
    protected static ?string $title = 'Thư Viện Media';
    protected static ?int $navigationSort = 3;

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
                    ImageColumn::make('path')
                        ->height('160px')
                        ->width('100%')
                        ->extraImgAttributes(['class' => 'object-cover w-full'])
                        ->disk('public'),
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
                    ])->space(1)->extraAttributes(['class' => 'p-2 w-full']),
                ])->space(0)->extraAttributes(['class' => 'w-full']),
            ])
            ->filters([
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
                    ->label('Ảnh chưa sử dụng')
                    ->query(fn (Builder $query): Builder => $query->where('usage_count', 0))
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
                            ->content(fn($record) => new \Illuminate\Support\HtmlString('<img src="' . asset('storage/' . $record->path) . '" class="w-full h-auto rounded-lg" />'))
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
                                                '<img src="' . asset('storage/' . $record->path) . '" style="width: 100%; max-height: 250px; object-fit: contain; border-radius: 8px; background: #f3f4f6; padding: 4px;" />'
                                            )),
                                        \Filament\Forms\Components\Placeholder::make('info')
                                            ->hiddenLabel()
                                            ->content(function ($record) {
                                                $usageHtml = "<div><b>Đang sử dụng:</b> {$record->usage_count} nơi</div>";
                                                
                                                if ($record->usage_count > 0) {
                                                    $locations = [];
                                                    $posts = \App\Models\Post::where('content', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('thumbnail', 'LIKE', '%' . $record->path . '%')->take(3)->get();
                                                    foreach ($posts as $post) {
                                                        $url = \App\Filament\Resources\PostResource::getUrl('edit', ['record' => $post->id]);
                                                        $locations[] = 'Bài viết: <a href="' . $url . '" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">' . $post->title . ' <span class="text-[10px] ml-1 opacity-70">🔗</span></a>';
                                                    }
                                                    
                                                    $caseStudies = \App\Models\CaseStudy::where('content', 'LIKE', '%' . $record->path . '%')
                                                        ->orWhere('thumbnail', 'LIKE', '%' . $record->path . '%')->take(3)->get();
                                                    foreach ($caseStudies as $cs) {
                                                        $url = \App\Filament\Resources\CaseStudyResource::getUrl('edit', ['record' => $cs->id]);
                                                        $locations[] = 'Case Study: <a href="' . $url . '" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">' . $cs->title . ' <span class="text-[10px] ml-1 opacity-70">🔗</span></a>';
                                                    }
                                                    
                                                    $partners = \App\Models\Partner::where('logo', 'LIKE', '%' . $record->path . '%')->take(3)->get();
                                                    foreach ($partners as $p) {
                                                        $url = \App\Filament\Resources\PartnerResource::getUrl('edit', ['record' => $p->id]);
                                                        $locations[] = 'Đối tác: <a href="' . $url . '" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">' . $p->name . ' <span class="text-[10px] ml-1 opacity-70">🔗</span></a>';
                                                    }
                                                    
                                                    $clients = \App\Models\Client::where('logo', 'LIKE', '%' . $record->path . '%')->take(3)->get();
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
                                                            $usageHtml .= "<li class='text-gray-500'>... và nhiều nơi khác</li>";
                                                        }
                                                        $usageHtml .= "</ul>";
                                                    }
                                                }

                                                return new \Illuminate\Support\HtmlString(
                                                    "<div class='text-sm text-gray-600 dark:text-gray-400 space-y-1'>" .
                                                    "<div><b>Tên file:</b> {$record->filename}</div>" .
                                                    "<div><b>Kích thước:</b> {$record->size_formatted}</div>" .
                                                    "<div><b>Kích thước ảnh:</b> {$record->width} x {$record->height} px</div>" .
                                                    "<div><b>Loại:</b> {$record->mime_type}</div>" .
                                                    "<div><b>Ngày tải lên:</b> {$record->created_at->format('d/m/Y H:i')}</div>" .
                                                    $usageHtml .
                                                    "</div>"
                                                );
                                            }),
                                        \Filament\Forms\Components\Actions::make([
                                            \Filament\Forms\Components\Actions\Action::make('download')
                                                ->label('Tải về')
                                                ->icon('heroicon-m-arrow-down-tray')
                                                ->color('gray')
                                                ->action(fn ($record) => response()->download(storage_path('app/public/' . $record->path))),
                                            \Filament\Forms\Components\Actions\Action::make('delete_media')
                                                ->label('Xóa ảnh')
                                                ->icon('heroicon-m-trash')
                                                ->color('danger')
                                                ->action(function ($record, $livewire, $component) {
                                                    $msg = $record->usage_count > 0 
                                                        ? "Ảnh này đang được sử dụng ở <b>{$record->usage_count}</b> nơi.<br>Xóa ảnh này sẽ làm <b>MẤT ẢNH</b> ở các nơi đang sử dụng!<br>Bạn vẫn nhất quyết muốn xóa?"
                                                        : "Bạn có chắc chắn muốn xóa ảnh này không? Hành động này không thể hoàn tác.";

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
                                            ->label('URL File')
                                            ->content(function ($record) {
                                                $url = asset('storage/' . $record->path);
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
                        if ($record->usage_count > 0) {
                            Notification::make()
                                ->title('Không thể xóa ảnh này!')
                                ->body("Ảnh này đang được sử dụng ở {$record->usage_count} nơi. Xóa có thể làm vỡ hình ảnh hiển thị trên trang.")
                                ->danger()
                                ->send();
                            $action->cancel();
                        } else {
                            $record->delete();
                        }
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('delete')
                        ->label('Xóa hàng loạt')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $deleted = 0;
                            $skipped = 0;
                            foreach ($records as $record) {
                                if ($record->usage_count > 0) {
                                    $skipped++;
                                } else {
                                    $record->delete();
                                    $deleted++;
                                }
                            }
                            if ($skipped > 0) {
                                Notification::make()
                                    ->title('Cảnh báo xóa hàng loạt')
                                    ->body("Đã xóa $deleted ảnh. Bỏ qua $skipped ảnh vì đang được sử dụng.")
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
                            $size = filesize($absolutePath);
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
            ]);
    }
}
