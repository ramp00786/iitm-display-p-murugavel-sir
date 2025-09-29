<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'sort_order'
    ];

    /**
     * Get the category this news belongs to
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
