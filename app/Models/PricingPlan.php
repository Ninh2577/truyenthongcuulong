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
        'show_on_pricing_page',
        'show_on_service_page',
        'target_page',
        'cta_label',
        'description',
        'thumbnail',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'show_on_pricing_page' => 'boolean',
        'show_on_service_page' => 'boolean',
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

        $clearCache = function () {
            \Illuminate\Support\Facades\Cache::forget('pricing.tvc');
            \Illuminate\Support\Facades\Cache::forget('pricing.web');
            \Illuminate\Support\Facades\Cache::forget('pricing.marketing');
            \Illuminate\Support\Facades\Cache::forget('pricing.plans_all');
        };

        static::saved(function ($plan) use ($clearCache) {
            $clearCache();
            \App\Services\MediaUsageService::syncForRecord($plan);
        });
        static::deleted(function ($plan) use ($clearCache) {
            $clearCache();
            \App\Services\MediaUsageService::syncForRecord($plan);
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForPricingPage($query)
    {
        return $query->where('show_on_pricing_page', true);
    }

    public function scopeForServicePage($query, string $target = '')
    {
        $q = $query->where('show_on_service_page', true);
        if (!empty($target)) {
            $q->where(function ($sub) use ($target) {
                $sub->where('target_page', $target)
                    ->orWhere('service_group', $target);
            });
        }
        return $q;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->service_group) {
            'tvc', 'media' => 'Sản Xuất TVC',
            'web', 'website', 'web-app' => 'Thiết Kế Web',
            'marketing', 'digital-marketing' => 'Marketing Online',
            'ui-ux' => 'Thiết Kế UI/UX',
            'website-care' => 'Quản Trị Web',
            'event-photography' => 'Chụp Ảnh Sự Kiện',
            'event-videography' => 'Quay Phim Sự Kiện',
            'teambuilding-photography' => 'Chụp Ảnh Teambuilding',
            'teambuilding-videography' => 'Quay Phim Teambuilding',
            default => 'Dịch Vụ Khác',
        };
    }

    public function getCategoryBgAttribute(): string
    {
        return match ($this->service_group) {
            'web' => '#EFF6FF',
            'marketing' => '#F3E8FF',
            'tvc' => '#FFF7ED',
            'ui-ux' => '#FDF2F8',
            'website-care' => '#F0FDFA',
            'event-photography' => '#ECFDF5',
            'event-videography' => '#FEF2F2',
            'teambuilding-photography' => '#EEF2FF',
            'teambuilding-videography' => '#FFFBEB',
            default => '#F1F5F9',
        };
    }

    public function getCategoryTextAttribute(): string
    {
        return match ($this->service_group) {
            'web' => '#2563EB',
            'marketing' => '#7C3AED',
            'tvc' => '#EA580C',
            'ui-ux' => '#DB2777',
            'website-care' => '#0D9488',
            'event-photography' => '#059669',
            'event-videography' => '#DC2626',
            'teambuilding-photography' => '#4F46E5',
            'teambuilding-videography' => '#D97706',
            default => '#475569',
        };
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            $t = $this->thumbnail;
            if (str_starts_with($t, 'http://') || str_starts_with($t, 'https://')) {
                return $t;
            }
            $clean = ltrim($t, '/');
            if (str_starts_with($clean, 'storage/') || str_starts_with($clean, 'images/') || str_starts_with($clean, 'img/') || str_starts_with($clean, 'assets/')) {
                return asset($clean);
            }
            return asset('storage/' . $clean);
        }

        return match ($this->service_group) {
            'web' => asset('images/services/service_card_2_webapp.png'),
            'marketing' => asset('images/seo/hero-seo.png'),
            'tvc' => asset('images/services/service_card_1_film.png'),
            'ui-ux' => asset('images/services/service_card_6_branding.png'),
            'website-care' => asset('images/services/service_card_2_webapp.png'),
            'event-photography' => asset('images/chup-anh-su-kien/category-hoi-nghi.png'),
            'event-videography' => asset('images/services/service_card_1_film.png'),
            'teambuilding-photography' => asset('images/chup-anh-teambuilding/pkg_basic.png'),
            'teambuilding-videography' => asset('images/chup-anh-teambuilding/hero_teambuilding.png'),
            default => asset('images/services/service_card_2_webapp.png'),
        };
    }
}
