<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use SolutionForest\FilamentTree\Concern\ModelTree;

class Category extends Model
{
    use HasFactory;
    use ModelTree;

    protected $guarded = [];

    protected $casts = [
        'is_industry_filter' => 'boolean',
        'display_order' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Determine column name for the Tree Title.
     */
    public function determineTitleColumnName(): string
    {
        return 'name';
    }

    public static function defaultParentKey()
    {
        return null;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeForPillar(Builder $query, string $pillar): Builder
    {
        return $query->where('pillar_group', $pillar);
    }

    public function determineStatus(): string
    {
        if (array_key_exists('status', $this->attributes) && !empty($this->attributes['status'])) {
            return $this->attributes['status'];
        }

        $orderVal = $this->order ?? $this->display_order ?? 0;

        if ($orderVal >= 50) {
            return 'hidden';
        }

        if ($orderVal >= 23 && $orderVal <= 24) {
            return 'paused';
        }

        return 'active';
    }

    protected static function booted(): void
    {
        static::saving(function ($category) {
            if (isset($category->order) && !isset($category->display_order)) {
                $category->display_order = $category->order;
            } elseif (isset($category->display_order) && !isset($category->order)) {
                $category->order = $category->display_order;
            }

            if (!empty($category->type) && empty($category->pillar_group)) {
                $category->pillar_group = $category->type instanceof \App\Enums\PillarGroup ? $category->type->value : (string) $category->type;
            } elseif (!empty($category->pillar_group) && empty($category->type)) {
                $category->type = $category->pillar_group;
            } elseif (!empty($category->type) && !empty($category->pillar_group)) {
                $typeVal = $category->type instanceof \App\Enums\PillarGroup ? $category->type->value : (string) $category->type;
                $category->pillar_group = $typeVal;
            }
        });
    }

    public function scopeIndustryFilters(Builder $query): Builder
    {
        return $query->where('is_industry_filter', true)->orderBy('display_order');
    }
}
