<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChartData extends Model
{
    protected $fillable = [
        'chart_id', 'data', 'labels', 'datasets'
    ];

    protected $casts = [
        'data' => 'array',
        'labels' => 'array',
        'datasets' => 'array',
    ];

    public function chart(): BelongsTo
    {
        return $this->belongsTo(MeteorologicalChart::class, 'chart_id');
    }
}
