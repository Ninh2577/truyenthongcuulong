<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(fn() => \Illuminate\Support\Facades\Cache::forget('header_menu_items_tree'));
        static::deleted(fn() => \Illuminate\Support\Facades\Cache::forget('header_menu_items_tree'));
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }
    
    public function rootItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('order');
    }
}
