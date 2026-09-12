<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Nội dung chung';
    protected static ?string $modelLabel = 'Thành viên';
    protected static ?string $pluralModelLabel = 'Đội ngũ nhân sự';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin nhân sự')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Họ tên')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('role')
                            ->label('Chức vụ / Vai trò')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('photo')
                            ->label('Hình ảnh chân dung')
                            ->image()
                            ->directory('team')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('bio')
                            ->label('Tiểu sử ngắn')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('order')
                            ->label('Thứ tự hiển thị')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Ảnh')
                    ->circular()
                    ->size(48)
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'TM') . '&color=FFFFFF&background=F59E0B'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Họ tên')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Chức vụ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
