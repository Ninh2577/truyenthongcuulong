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
        return str_starts_with($this->path, 'images/');
    }

    public function getIsUsedAttribute(): bool
    {
        return $this->isUiAsset() || $this->usage_count > 0;
    }
}
