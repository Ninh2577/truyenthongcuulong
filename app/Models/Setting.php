<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('settings_all_dict');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('settings_all_dict');
        });
    }
}
