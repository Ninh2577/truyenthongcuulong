<?php

namespace App\Filament\Imports;

use App\Models\Redirect;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Str;

class RedirectImporter extends Importer
{
    protected static ?string $model = Redirect::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('old_url')
                ->label('URL cũ')
                ->requiredMapping()
                ->rules([
                    'required',
                    'max:500',
                    'string',
                    'unique:redirects,old_url', // Đảm bảo record chưa tồn tại (Không overwrite blindly)
                ]),
            ImportColumn::make('new_url')
                ->label('URL mới')
                ->requiredMapping()
                ->rules([
                    'required',
                    'max:500',
                    'string',
                ]),
            ImportColumn::make('status_code')
                ->label('Mã HTTP (Status)')
                ->rules(['nullable', 'integer', 'in:301,302,307,308']),
        ];
    }

    public function resolveRecord(): ?Redirect
    {
        // Trả về instance mới, rules() bên trên đã đảm nhận việc validate unique old_url
        // Để tránh overwrite record hiện tại, chúng ta không dùng Redirect::firstOrNew(...)
        return new Redirect();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Quá trình import Redirect đã hoàn tất. Có ' . number_format($import->successful_rows) . ' dòng thành công.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' Tuy nhiên, có ' . number_format($failedRowsCount) . ' dòng bị lỗi (duplicate, sai format, v.v). Vui lòng tải file lỗi (CSV) để kiểm tra nguyên nhân.';
        }

        return $body;
    }
}
