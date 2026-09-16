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
}
