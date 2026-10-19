<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

class MenuItem extends Model
{
    use ModelTree;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(function () {
            static::clearMenuCache();
        });
        static::deleted(function () {
            static::clearMenuCache();
        });
    }

    public static function clearMenuCache(): void
    {
        \Illuminate\Support\Facades\Cache::forget('header_menu_items_tree');
        \Illuminate\Support\Facades\Cache::forget('header_menu_items_tree_v3');
        \Illuminate\Support\Facades\Cache::forget('header_menu_items_tree_v4');
        \Illuminate\Support\Facades\Cache::put('header_menu_version', time(), 86400 * 30);
    }
    
    public function determineTitleColumnName(): string
    {
        return 'title';
    }

    public function determineIconColumnName(): string
    {
        return 'tree_icon'; // Tránh dùng cột 'icon' vì nó chứa Material Symbols không tương thích với Filament's dynamic component
    }

    public static function defaultParentKey()
    {
        return null;
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function setUrlAttribute($value): void
    {
        $url = trim($value ?? '');
        if ($url !== '' && $url !== '#' && !preg_match('#^(https?://|tel:|mailto:|javascript:)#i', $url)) {
            $url = '/' . ltrim($url, '/');
        }
        $this->attributes['url'] = $url;
    }

    public function getUrlAttribute($value): ?string
    {
        if (empty($value) || $value === '#') {
            return $value;
        }
        if (preg_match('#^(https?://|tel:|mailto:|javascript:)#i', $value)) {
            return $value;
        }
        return '/' . ltrim($value, '/');
    }
}
