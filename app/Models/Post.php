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

    protected $appends = ['seo_score', 'seo_breakdown'];

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
        $breakdown = [];
        
        // 1. Meta Title (50-60 chars)
        $mtLen = mb_strlen((string)$this->meta_title, 'UTF-8');
        $hasMt = $mtLen >= 50 && $mtLen <= 60;
        $breakdown['meta_title'] = [
            'label' => 'Meta Title (50-60 ký tự)',
            'status' => $hasMt,
            'score' => $hasMt ? 20 : 0
        ];

        // 2. Meta Description (120-160 chars)
        $mdLen = mb_strlen((string)$this->meta_description, 'UTF-8');
        $hasMd = $mdLen >= 120 && $mdLen <= 160;
        $breakdown['meta_description'] = [
            'label' => 'Meta Description (120-160 ký tự)',
            'status' => $hasMd,
            'score' => $hasMd ? 20 : 0
        ];

        // 3. Thumbnail
        $hasThumb = !empty($this->thumbnail);
        $breakdown['thumbnail'] = [
            'label' => 'Có ảnh đại diện (Thumbnail)',
            'status' => $hasThumb,
            'score' => $hasThumb ? 20 : 0
        ];

        // 4. Content length (> 300 words)
        $wordCount = str_word_count(strip_tags((string)$this->content));
        $hasContent = $wordCount > 300;
        $breakdown['content'] = [
            'label' => 'Nội dung > 300 từ',
            'status' => $hasContent,
            'score' => $hasContent ? 20 : 0
        ];

        // 5. Friendly Slug
        $slug = (string)$this->slug;
        $slugLen = mb_strlen($slug, 'UTF-8');
        $slugValid = false;
        if ($slugLen > 0 && $slugLen <= 75) {
            if (preg_match('/^[a-z0-9-]+$/', $slug)) {
                if (!str_contains($slug, '--') && !str_starts_with($slug, '-') && !str_ends_with($slug, '-')) {
                    $slugValid = true;
                }
            }
        }
        $breakdown['slug'] = [
            'label' => 'Slug chuẩn SEO (<=75 ký tự, hợp lệ)',
            'status' => $slugValid,
            'score' => $slugValid ? 20 : 0
        ];

        return $breakdown;
    }

    public function getSeoScoreAttribute(): int
    {
        $breakdown = $this->seo_breakdown;
        $total = 0;
        foreach ($breakdown as $item) {
            $total += $item['score'];
        }
        return $total;
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
