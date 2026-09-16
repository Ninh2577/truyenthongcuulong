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
}
