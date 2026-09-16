<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Quản Lý Website';
    protected static ?string $modelLabel = 'Đối tác';
    protected static ?string $pluralModelLabel = 'Mạng lưới Đối tác';
    protected static ?int $navigationSort = 2;

    // Giới hạn số lượng mỗi mục
    const SECTION_LIMITS = [
        1 => 3,
        2 => 3,
        3 => 12,
    ];

    const SECTION_LABELS = [
        1 => 'Top Tier',
        2 => 'Gold Tier',
        3 => 'Strategic',
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin đối tác')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên đối tác')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('category')
                            ->label('Lĩnh vực / Chuyên mục')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tagline')
                            ->label('Tagline phụ')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Hình ảnh & Mô tả')
                    ->schema([
                        \App\Filament\Forms\Components\MediaPicker::make('image')
                            ->label('Hình ảnh nền (dành cho Mục 1 & 2)')
                            ->columnSpanFull(),
                        \App\Filament\Forms\Components\MediaPicker::make('logo')
                            ->label('Logo đối tác')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả ngắn')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('website_url')
                            ->label('URL Website')
                            ->url()
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Phân bổ hiển thị trên trang Đối Tác')
                    ->description('Tích chọn các mục muốn hiển thị. Một đối tác có thể xuất hiện ở nhiều mục. Mỗi mục có giới hạn số lượng riêng.')
                    ->schema([
                        Forms\Components\CheckboxList::make('display_sections')
                            ->label('Hiển thị ở mục nào?')
                            ->options([
                                1 => '01 · TOP TIER SHOWCASE — Tối đa 3 đối tác (ảnh lớn nổi bật)',
                                2 => '02 · GOLD TIER NETWORK — Tối đa 3 đối tác (ảnh vừa)',
                                3 => '03 · STRATEGIC COMPACT DIRECTORY — Tối đa 12 đối tác (dạng danh sách)',
                            ])
                            ->helperText(function ($record) {
                                $lines = [];
                                foreach (self::SECTION_LIMITS as $section => $limit) {
                                    // Đếm số đối tác trong mục này (trừ bản ghi hiện tại)
                                    $count = Partner::whereJsonContains('display_sections', $section)
                                        ->when($record?->id, fn($q) => $q->where('id', '!=', $record->id))
                                        ->count();
                                    $label = self::SECTION_LABELS[$section];
                                    $status = $count >= $limit ? " ⚠ ĐẦY" : "";
                                    $lines[] = "Mục {$section} ({$label}): {$count}/{$limit}{$status}";
                                }
                                return implode('  •  ', $lines);
                            })
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->label('Thứ tự hiển thị (số nhỏ = lên trước)')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Kích hoạt (Toàn hệ thống - Marquee)')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_or_image')
                    ->label('Ảnh / Logo')
                    ->square()
                    ->size(48)
                    ->getStateUsing(fn ($record) => $record->logo ?? $record->image)
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'P') . '&color=FFFFFF&background=F59E0B'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên đối tác')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('display_sections')
                    ->label('Mục hiển thị')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        $sections = $record->display_sections ?? [];
                        if (empty($sections)) return ['Không hiển thị'];
                        return array_map(fn($s) => match((int)$s) {
                            1 => '01 · TOP',
                            2 => '02 · GOLD',
                            3 => '03 · STRATEGIC',
                            default => "Mục {$s}",
                        }, $sections);
                    })
                    ->color(fn ($state) => match($state) {
                        '01 · TOP'        => 'warning',
                        '02 · GOLD'       => 'success',
                        '03 · STRATEGIC'  => 'info',
                        default           => 'gray',
                    })
                    ->separator(','),
                Tables\Columns\TextColumn::make('category')
                    ->label('Lĩnh vực')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\Filter::make('section_1')
                    ->label('Mục 1 · Top Tier')
                    ->query(fn ($query) => $query->whereJsonContains('display_sections', 1)),
                Tables\Filters\Filter::make('section_2')
                    ->label('Mục 2 · Gold Tier')
                    ->query(fn ($query) => $query->whereJsonContains('display_sections', 2)),
                Tables\Filters\Filter::make('section_3')
                    ->label('Mục 3 · Strategic')
                    ->query(fn ($query) => $query->whereJsonContains('display_sections', 3)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (Partner $record, array $data): Partner {
                        $newSections = $data['display_sections'] ?? [];

                        // Kiểm tra giới hạn từng mục mới được thêm vào
                        $oldSections = $record->display_sections ?? [];
                        $addedSections = array_diff($newSections, $oldSections);

                        $overLimit = [];
                        foreach ($addedSections as $section) {
                            $section = (int)$section;
                            $limit = self::SECTION_LIMITS[$section] ?? 99;
                            $count = Partner::whereJsonContains('display_sections', $section)
                                ->where('id', '!=', $record->id)
                                ->count();
                            if ($count >= $limit) {
                                $overLimit[] = 'Mục ' . $section . ' (' . (self::SECTION_LABELS[$section] ?? '') . ') đã đủ ' . $limit . ' đối tác';
                            }
                        }

                        if (!empty($overLimit)) {
                            Notification::make()
                                ->title('Đã đạt giới hạn số lượng!')
                                ->body(implode("\n", $overLimit) . "\nHãy bỏ bớt đối tác khác trước khi thêm.")
                                ->danger()
                                ->send();
                            // Chỉ giữ lại những mục cũ + mục mới không bị giới hạn
                            $validNew = array_diff($addedSections, array_map(fn($msg) => null, $overLimit));
                            $data['display_sections'] = array_values(array_unique(array_merge(
                                $oldSections,
                                array_diff($newSections, array_keys(array_fill(0, count($overLimit), true)))
                            )));
                            // Đơn giản hơn: giữ nguyên oldSections nếu có lỗi
                            $data['display_sections'] = $oldSections;
                        }

                        $record->update($data);
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
