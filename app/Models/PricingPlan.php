<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_group',
        'tier_name',
        'price_display',
        'price_note',
        'features',
        'is_featured',
        'order',
        'is_active',
        'cta_label',
        'description',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($plan) {
            // Un-feature other plans in the same service_group if this plan is being set to featured
            if ($plan->is_featured && $plan->isDirty('is_featured')) {
                static::where('service_group', $plan->service_group)
                    ->where('id', '!=', $plan->id)
                    ->update(['is_featured' => false]);
            }
        });

        static::saved(function ($plan) {
            \Illuminate\Support\Facades\Cache::forget('pricing.tvc');
            \Illuminate\Support\Facades\Cache::forget('pricing.web');
            \Illuminate\Support\Facades\Cache::forget('pricing.marketing');
        });

        static::deleted(function ($plan) {
            \Illuminate\Support\Facades\Cache::forget('pricing.tvc');
            \Illuminate\Support\Facades\Cache::forget('pricing.web');
            \Illuminate\Support\Facades\Cache::forget('pricing.marketing');
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

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->service_group) {
            'website', 'web', 'web-app' => 'Website',
            'digital-marketing', 'marketing' => 'Digital Marketing',
            'truyen-thong', 'communication' => 'Truyền thông',
            'media', 'tvc' => 'Media',
            'thiet-ke', 'design' => 'Thiết kế',
            'su-kien', 'event' => 'Sự kiện',
            default => 'Website',
        };
    }

    public function getCategoryBgAttribute(): string
    {
        return match ($this->category_label) {
            'Website' => '#EFF6FF',
            'Digital Marketing' => '#F3E8FF',
            'Truyền thông' => '#FFF7ED',
            'Media' => '#ECFEFF',
            'Thiết kế' => '#FDF2F8',
            'Sự kiện' => '#EEF2FF',
            default => '#F1F5F9',
        };
    }

    public function getCategoryTextAttribute(): string
    {
        return match ($this->category_label) {
            'Website' => '#2563EB',
            'Digital Marketing' => '#7C3AED',
            'Truyền thông' => '#EA580C',
            'Media' => '#0891B2',
            'Thiết kế' => '#DB2777',
            'Sự kiện' => '#4F46E5',
            default => '#475569',
        };
    }

    public function getThumbnailUrlAttribute(): string
    {
        return match ($this->category_label) {
            'Website' => asset('images/services/service_card_2_webapp.png'),
            'Digital Marketing' => asset('images/seo/hero-seo.png'),
            'Truyền thông' => asset('images/services/service_card_3_ads.png'),
            'Media' => asset('images/services/service_card_1_film.png'),
            'Thiết kế' => asset('images/services/service_card_6_branding.png'),
            'Sự kiện' => asset('images/chup-anh-su-kien/category-hoi-nghi.png'),
            default => asset('images/services/service_card_2_webapp.png'),
        };
    }
}
