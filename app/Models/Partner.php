<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tier',
        'category',
        'logo',
        'image',
        'description',
        'tagline',
        'website_url',
        'order',
        'is_active',
        'show_on_partner_page',
        'display_sections',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_partner_page' => 'boolean',
        'display_sections' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('partners.section1');
            \Illuminate\Support\Facades\Cache::forget('partners.section2');
            \Illuminate\Support\Facades\Cache::forget('partners.section3');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('partners.section1');
            \Illuminate\Support\Facades\Cache::forget('partners.section2');
            \Illuminate\Support\Facades\Cache::forget('partners.section3');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getNameAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = clean_special_chars($value);
    }

    public function getDescriptionAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setDescriptionAttribute($value): void
    {
        $this->attributes['description'] = clean_special_chars($value);
    }

    public function getTaglineAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setTaglineAttribute($value): void
    {
        $this->attributes['tagline'] = clean_special_chars($value);
    }
}
