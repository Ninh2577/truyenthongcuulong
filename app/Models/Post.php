<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    protected $appends = ['seo_score', 'seo_breakdown', 'thumbnail_url'];

    protected static function booted()
    {
        static::saved(function ($post) {
            \Illuminate\Support\Facades\Cache::forget('post_editorial_' . $post->id);
        });
    }

    /**
     * LƯU Ý KỸ THUẬT:
     * Cột `seo_score` và `seo_breakdown` là các Accessors được tính toán on-the-fly (runtime).
     * Do chúng KHÔNG tồn tại dưới dạng cột thực tế trong CSDL (Database), bạn KHÔNG THỂ sử dụng
     * các tính năng ->sortable() hay ->searchable() chuẩn của Filament/Eloquent cho các cột này.
     * Nếu trong tương lai cần sort/filter theo Điểm SEO, cần tạo cột thực sự trong CSDL và dùng
     * Model Observer (như saving) để tính toán & lưu giá trị vào DB thay vì dùng accessor thuần.
     */
    public function getSeoBreakdownAttribute(): array
    {
        $data = [
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'thumbnail' => $this->thumbnail,
            'focus_keyword' => $this->focus_keyword,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
        return \App\Services\SeoScoreCalculator::calculate($data)['breakdown'];
    }

    public function getSeoScoreAttribute(): int
    {
        $data = [
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'thumbnail' => $this->thumbnail,
            'focus_keyword' => $this->focus_keyword,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
        return \App\Services\SeoScoreCalculator::calculate($data)['score'];
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
            return $this->thumbnail;
        }

        return asset('storage/' . $this->thumbnail);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopeInPillar(Builder $query, string $pillar): Builder
    {
        return $query->whereHas('category', function ($q) use ($pillar) {
            $q->where('pillar_group', $pillar);
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function getPillarGroupAttribute(): ?string
    {
        return $this->category?->pillar_group;
    }
}
