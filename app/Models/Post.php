<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()->logAll();
    }

    use HasFactory, \Spatie\Activitylog\Traits\LogsActivity;

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
     * LÆ¯U Ã Ká»¸ THUáº¬T:
     * Cá»™t `seo_score` vÃ  `seo_breakdown` lÃ  cÃ¡c Accessors Ä‘Æ°á»£c tÃ­nh toÃ¡n on-the-fly (runtime).
     * Do chÃºng KHÃ”NG tá»“n táº¡i dÆ°á»›i dáº¡ng cá»™t thá»±c táº¿ trong CSDL (Database), báº¡n KHÃ”NG THá»‚ sá»­ dá»¥ng
     * cÃ¡c tÃ­nh nÄƒng ->sortable() hay ->searchable() chuáº©n cá»§a Filament/Eloquent cho cÃ¡c cá»™t nÃ y.
     * Náº¿u trong tÆ°Æ¡ng lai cáº§n sort/filter theo Äiá»ƒm SEO, cáº§n táº¡o cá»™t thá»±c sá»± trong CSDL vÃ  dÃ¹ng
     * Model Observer (nhÆ° saving) Ä‘á»ƒ tÃ­nh toÃ¡n & lÆ°u giÃ¡ trá»‹ vÃ o DB thay vÃ¬ dÃ¹ng accessor thuáº§n.
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

