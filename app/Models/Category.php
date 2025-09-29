<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'sort_order'
    ];

    /**
     * Get all news items for this category
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class)->orderBy('sort_order');
    }
}
