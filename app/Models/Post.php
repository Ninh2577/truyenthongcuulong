<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, \Spatie\Activitylog\Traits\LogsActivity, SoftDeletes;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->useLogName('posts')
            ->logOnly([
                'title',
                'slug',
                'status',
                'category_id',
                'author_id',
                'published_at',
                'thumbnail',
                'is_featured',
                'focus_keyword',
                'is_page',
                'page_template',
                'show_toc',
                'show_cta_form',
                'show_author_date',
                'schema_type',
                'schema_data',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->dontLogIfAttributesChangedOnly(['views', 'updated_at']);
    }

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
        'is_page' => 'boolean',
        'show_toc' => 'boolean',
        'show_cta_form' => 'boolean',
        'show_author_date' => 'boolean',
        'schema_data' => 'array',
    ];

    protected $appends = ['seo_score', 'seo_breakdown', 'thumbnail_url'];

    protected static function booted()
    {
        static::saving(function ($post) {
            if (!empty($post->content)) {
                $post->content = clean_ai_content($post->content);
            }
            if (empty($post->summary) && !empty($post->content)) {
                $cleanContent = preg_replace('/\[(?:embed|video)[^\]]*\].*?\[\/(?:embed|video)\]/is', '', $post->content);
                $post->summary = clean_special_chars(\Illuminate\Support\Str::limit(strip_tags($cleanContent), 200));
            }
        });

        static::saved(function ($post) {
            \Illuminate\Support\Facades\Cache::forget('post_editorial_' . $post->id);
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('template_showcase_metadata');
        });

        static::deleted(function ($post) {
            \Illuminate\Support\Facades\Cache::forget('post_editorial_' . $post->id);
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('template_showcase_metadata');
        });
    }

    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = clean_ai_content($value);
    }

    public function getTitleAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = clean_special_chars($value);
    }

    public function getSummaryAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setSummaryAttribute($value): void
    {
        $this->attributes['summary'] = clean_special_chars($value);
    }

    public function getMetaTitleAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setMetaTitleAttribute($value): void
    {
        $this->attributes['meta_title'] = clean_special_chars($value);
    }

    public function getMetaDescriptionAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setMetaDescriptionAttribute($value): void
    {
        $this->attributes['meta_description'] = clean_special_chars($value);
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
            $q->where('pillar_group', $pillar)->orWhere('type', $pillar);
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

    public function isPillarPage(): bool
    {
        return (bool) $this->is_page && $this->page_template === 'pillar_page';
    }

    public function isLandingPage(): bool
    {
        return (bool) $this->is_page && $this->page_template === 'landing_page';
    }

    /**
     * Advanced Topic Cluster & Relevance Scoring Model (Phase 5).
     * Retrieves and ranks satellite / cluster articles based on multi-tier relevance signals:
     * - Tier 1: Exact focus_keyword match (+40) & Category match (+30)
     * - Tier 2: Partial keyword / title overlap (+20) & Pillar group match (+15)
     * - Tier 3: Category or Pillar group match only (+30 or +15)
     * Strictly enforces deterministic ordering: relevance_score DESC, published_at DESC, id DESC.
     * Guaranteed zero self-link, zero draft/hidden posts, zero duplicate, with safe fallback.
     */
    public function clusterPosts(int $limit = 8)
    {
        $this->loadMissing('category');
        $pillar = $this->category?->pillar_group;
        $keyword = trim(mb_strtolower((string) $this->focus_keyword));

        // 1. Nếu không có cả category_id, pillar_group lẫn focus_keyword -> Trả về rỗng
        if (!$this->category_id && empty($pillar) && empty($keyword)) {
            return collect();
        }

        // 2. Truy vấn tập ứng viên có chọn lọc (Candidate Pool <= 50) sắp xếp theo ngày xuất bản
        $candidates = static::with(['category', 'author'])
            ->where('status', 'published')
            ->where('id', '!=', $this->id)
            ->where(function ($query) use ($pillar, $keyword) {
                if ($this->category_id) {
                    $query->where('category_id', $this->category_id);
                }
                if (!empty($pillar)) {
                    $query->orWhereHas('category', function ($q) use ($pillar) {
                        $q->where('pillar_group', $pillar);
                    });
                }
                if (!empty($keyword)) {
                    $query->orWhere('focus_keyword', 'like', "%{$keyword}%")
                          ->orWhere('title', 'like', "%{$keyword}%");
                }
            })
            ->orderByDesc('published_at')
            ->limit(50)
            ->get();

        // 3. Nếu không tìm thấy ứng viên nào, kích hoạt fallback an toàn về cùng category
        if ($candidates->isEmpty()) {
            if (!$this->category_id) {
                return collect();
            }

            return static::with(['category', 'author'])
                ->where('status', 'published')
                ->where('id', '!=', $this->id)
                ->where('category_id', $this->category_id)
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take($limit)
                ->get();
        }

        // 4. Chấm điểm liên quan (Relevance Scoring) trên dữ liệu thực tế
        $scored = $candidates->map(function ($c) use ($pillar, $keyword) {
            $score = 0;
            $cKeyword = trim(mb_strtolower((string) $c->focus_keyword));
            $cTitle = trim(mb_strtolower((string) $c->title));

            // Tín hiệu 1: Trùng khớp focus_keyword
            if (!empty($keyword) && !empty($cKeyword) && $cKeyword === $keyword) {
                $score += 40; // Exact keyword match (Tier 1)
            } elseif (!empty($keyword) && (str_contains($cKeyword, $keyword) || str_contains($cTitle, $keyword))) {
                $score += 20; // Partial keyword match (Tier 2)
            }

            // Tín hiệu 2: Cùng Category
            if ($this->category_id && $c->category_id === $this->category_id) {
                $score += 30; // Same category (Tier 1/2)
            }

            // Tín hiệu 3: Cùng Pillar Group
            if (!empty($pillar) && $c->category?->pillar_group === $pillar) {
                $score += 15; // Same macro thematic group (Tier 2/3)
            }

            $c->relevance_score = $score;
            return $c;
        })
        ->filter(fn($c) => $c->relevance_score > 0)
        ->sort(function ($a, $b) {
            // Sắp xếp xác định (Deterministic Ordering):
            // 1. Điểm relevance giảm dần
            if ($a->relevance_score !== $b->relevance_score) {
                return $b->relevance_score <=> $a->relevance_score;
            }
            // 2. Ngày xuất bản mới nhất đứng trước
            $timeA = $a->published_at ? $a->published_at->timestamp : 0;
            $timeB = $b->published_at ? $b->published_at->timestamp : 0;
            if ($timeA !== $timeB) {
                return $timeB <=> $timeA;
            }
            // 3. ID giảm dần (Deterministic tie-breaker)
            return $b->id <=> $a->id;
        })
        ->values()
        ->take($limit);

        // 5. Fallback nếu điểm relevance lọc rỗng
        if ($scored->isEmpty() && $this->category_id) {
            return static::with(['category', 'author'])
                ->where('status', 'published')
                ->where('id', '!=', $this->id)
                ->where('category_id', $this->category_id)
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take($limit)
                ->get();
        }

        return $scored;
    }
}

