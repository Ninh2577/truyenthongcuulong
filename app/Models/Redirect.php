<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(fn() => \Illuminate\Support\Facades\Cache::forget('redirects_map'));
        static::deleted(fn() => \Illuminate\Support\Facades\Cache::forget('redirects_map'));
    }
}
