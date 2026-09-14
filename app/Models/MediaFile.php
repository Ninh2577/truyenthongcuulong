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
}
