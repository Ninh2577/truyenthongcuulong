<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'meta_data' => 'array',
        'featured' => 'boolean',
    ];

    /**
     * Lấy đường dẫn ảnh bìa (thumbnail gốc hoặc từ youtube)
     *
     * @return string|null
     */
    public function getCoverImageUrlAttribute()
    {
        $imageUrl = null;
        
        // Ưu tiên lấy ảnh bìa YouTube nếu có video_url
        if (!empty($this->video_url)) {
            $videoId = null;
            if (\Illuminate\Support\Str::contains($this->video_url, 'youtube.com/embed/')) {
                preg_match('/embed\/([a-zA-Z0-9_-]+)/', $this->video_url, $matches);
                $videoId = $matches[1] ?? null;
            } elseif (\Illuminate\Support\Str::contains($this->video_url, 'watch?v=')) {
                preg_match('/v=([a-zA-Z0-9_-]+)/', $this->video_url, $matches);
                $videoId = $matches[1] ?? null;
            } elseif (\Illuminate\Support\Str::contains($this->video_url, 'youtu.be/')) {
                preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $this->video_url, $matches);
                $videoId = $matches[1] ?? null;
            }
            
            if ($videoId) {
                return 'https://img.youtube.com/vi/' . $videoId . '/maxresdefault.jpg';
            }
        }
        
        // Nếu không có video_url hoặc không lấy được từ YouTube thì dùng thumbnail tải lên
        if (!empty($this->thumbnail)) {
            if (\Illuminate\Support\Str::startsWith($this->thumbnail, 'http')) {
                return $this->thumbnail;
            }
            return asset('storage/' . $this->thumbnail);
        }

        return null;
    }
}
