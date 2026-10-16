<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
        'features' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn() => \Illuminate\Support\Facades\Cache::forget('home_page_data'));
        static::deleted(fn() => \Illuminate\Support\Facades\Cache::forget('home_page_data'));
    }

    public function getTitleAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = clean_special_chars($value);
    }
}
