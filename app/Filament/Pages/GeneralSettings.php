<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class GeneralSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('Admin');
    }

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Quản Lý Website';
    protected static ?string $navigationLabel = 'Cài Đặt Chung';
    protected static ?string $title = 'Cài Đặt Website';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.general-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin Liên hệ')
                    ->schema([
                        TextInput::make('company_phone')
                            ->label('Hotline (SĐT)')
                            ->required()
                            ->tel()
                            ->placeholder('0939 363 262'),
                        TextInput::make('company_email')
                            ->label('Email Liên hệ')
                            ->email()
                            ->required()
                            ->placeholder('info@truyenthongcuulong.com'),
                    ])->columns(2),

                Section::make('Mạng xã hội')
                    ->schema([
                        TextInput::make('social_facebook')
                            ->label('Facebook Link')
                            ->url()
                            ->placeholder('https://facebook.com/...'),
                        TextInput::make('social_zalo')
                            ->label('Zalo Phone (Chỉ số)')
                            ->placeholder('0939363262'),
                        TextInput::make('social_youtube')
                            ->label('YouTube Link')
                            ->url()
                            ->placeholder('https://youtube.com/...'),
                    ])->columns(3),

                Section::make('Thông tin Tổ chức (SEO Schema)')
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Tên Tổ chức / Công ty')
                            ->required()
                            ->placeholder('Truyền Thông Cửu Long'),
                        TextInput::make('company_address')
                            ->label('Địa chỉ')
                            ->required()
                            ->placeholder('Lầu 5, 57 Hùng Vương, Cần Thơ'),
                        Textarea::make('company_description')
                            ->label('Mô tả ngắn (Description)')
                            ->rows(3),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
            Cache::forget("setting_{$key}"); // Clear cache for each updated setting
        }

        Notification::make()
            ->title('Đã lưu cấu hình')
            ->success()
            ->send();
    }
}
