<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $fillable = [
        'filename',
        'original_name',
        'title',
        'path',
        'disk',
        'mime_type',
        'size',
        'width',
        'height',
        'folder_year',
        'alt_text',
        'caption',
        'description',
        'uploaded_by',
        'usage_count',
    ];

    protected $appends = [
        'url',
        'size_formatted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getSizeFormattedAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        if ($bytes == 0) return '0 B';
        
        $i = floor(log($bytes, 1024));
        return @round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }

    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->path, 'images/')) {
            return asset($this->path);
        }
        return asset('storage/' . $this->path);
    }

    public function getFullPathAttribute(): string
    {
        if (str_starts_with($this->path, 'images/')) {
            return public_path($this->path);
        }
        return storage_path('app/public/' . $this->path);
    }

    public function isUiAsset(): bool
    {
        $path = str_replace('\\', '/', strtolower($this->path));
        $fn = strtolower($this->filename);

        return str_starts_with($path, 'images/')
            || str_contains($path, 'template-')
            || str_contains($fn, 'template-')
            || str_contains($path, 'template_')
            || str_contains($fn, 'template_')
            || str_contains($fn, 'website-')
            || str_contains($fn, 'banner-template')
            || str_contains($fn, 'banner-website')
            || str_starts_with($path, 'uploads/projects/')
            || str_starts_with($path, 'partners/')
            || in_array($fn, [
                'mockup_erp.jpg',
                'mockup_phongkham.jpg',
                'lang_sen_real.jpg',
                'lien_minh_dbscl_opt.jpg',
                'long_trekking_real.jpg',
                'nam_tay_nguyen_real.jpg',
            ]);
    }

    public function getIsUsedAttribute(): bool
    {
        return $this->isUiAsset() || $this->usage_count > 0;
    }

    public function scopeUiAssets(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where(function ($q) {
            $q->where('path', 'like', 'images/%')
              ->orWhere('path', 'like', '%template-%')
              ->orWhere('filename', 'like', '%template-%')
              ->orWhere('path', 'like', '%template_%')
              ->orWhere('filename', 'like', '%template_%')
              ->orWhere('filename', 'like', 'website-%')
              ->orWhere('filename', 'like', 'banner-%')
              ->orWhere('path', 'like', 'uploads/projects/%')
              ->orWhere('path', 'like', 'partners/%')
              ->orWhereIn('filename', [
                  'mockup_erp.jpg',
                  'mockup_phongkham.jpg',
                  'lang_sen_real.jpg',
                  'lien_minh_dbscl_opt.jpg',
                  'long_trekking_real.jpg',
                  'nam_tay_nguyen_real.jpg',
              ]);
        });
    }

    public function scopeUsedInContent(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where(function ($q) {
            $q->where('path', 'not like', 'images/%')
              ->where('path', 'not like', '%template-%')
              ->where('filename', 'not like', '%template-%')
              ->where('path', 'not like', '%template_%')
              ->where('filename', 'not like', '%template_%')
              ->where('filename', 'not like', 'website-%')
              ->where('filename', 'not like', 'banner-%')
              ->where('path', 'not like', 'uploads/projects/%')
              ->where('path', 'not like', 'partners/%')
              ->whereNotIn('filename', [
                  'mockup_erp.jpg',
                  'mockup_phongkham.jpg',
                  'lang_sen_real.jpg',
                  'lien_minh_dbscl_opt.jpg',
                  'long_trekking_real.jpg',
                  'nam_tay_nguyen_real.jpg',
              ]);
        })->where('usage_count', '>', 0);
    }

    public function scopeUnusedUploads(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where(function ($q) {
            $q->where('path', 'not like', 'images/%')
              ->where('path', 'not like', '%template-%')
              ->where('filename', 'not like', '%template-%')
              ->where('path', 'not like', '%template_%')
              ->where('filename', 'not like', '%template_%')
              ->where('filename', 'not like', 'website-%')
              ->where('filename', 'not like', 'banner-%')
              ->where('path', 'not like', 'uploads/projects/%')
              ->where('path', 'not like', 'partners/%')
              ->whereNotIn('filename', [
                  'mockup_erp.jpg',
                  'mockup_phongkham.jpg',
                  'lang_sen_real.jpg',
                  'lien_minh_dbscl_opt.jpg',
                  'long_trekking_real.jpg',
                  'nam_tay_nguyen_real.jpg',
              ]);
        })->where('usage_count', 0);
    }
}
