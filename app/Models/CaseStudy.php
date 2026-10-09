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
        
        if ($this->slug === 'ung-dung-quan-ly-phong-kham') {
            return asset('images/projects/clinic-app-mockup.jpg');
        }
        if ($this->slug === 'website-phong-kham-da-khoa') {
            return asset('images/projects/clinic-website-wp.png');
        }
        if ($this->slug === 'tvc-quang-cao-sacombank') {
            return asset('images/projects/sacombank-media-thumb.jpg');
        }
        if ($this->slug === 'phim-doanh-nghiep-hoya') {
            return asset('images/projects/hoyalens-media-thumb.jpg');
        }
        if ($this->slug === 'website-du-lich-long-trekking') {
            return asset('images/projects/long-trekking-mockup.jpg');
        }
        if ($this->slug === 'website-tui-la-nguoi-mien-tay') {
            return asset('images/projects/web_tuilanguoimientay.jpg');
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

    /**
     * Problem statement accessor
     */
    public function getProblemAttribute()
    {
        return $this->meta_data['problem'] ?? null;
    }

    /**
     * Solution description accessor
     */
    public function getSolutionAttribute()
    {
        return $this->meta_data['solution'] ?? null;
    }

    /**
     * Technology stack accessor
     */
    public function getTechStackAttribute()
    {
        return $this->meta_data['tech_stack'] ?? null;
    }

    /**
     * Deliverables / Results accessor
     */
    public function getResultAttribute()
    {
        return $this->meta_data['result'] ?? null;
    }
}
