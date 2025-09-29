<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeteorologicalTab extends Model
{
    protected $fillable = [
        'heading', 'data_station', 'order', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function charts(): HasMany
    {
        return $this->hasMany(MeteorologicalChart::class, 'tab_id');
    }

    public function activeCharts(): HasMany
    {
        return $this->hasMany(MeteorologicalChart::class, 'tab_id')
                    ->where('is_active', true)
                    ->orderBy('order');
    }
}
