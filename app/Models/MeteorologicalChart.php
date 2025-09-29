<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MeteorologicalChart extends Model
{
    protected $fillable = [
        'tab_id', 'title', 'chart_type', 'chart_config', 'order', 'is_active'
    ];

    protected $casts = [
        'chart_config' => 'array',
        'is_active' => 'boolean',
    ];

    public function tab(): BelongsTo
    {
        return $this->belongsTo(MeteorologicalTab::class, 'tab_id');
    }

    public function chartData(): HasOne
    {
        return $this->hasOne(ChartData::class, 'chart_id');
    }

    public static function getChartTypes(): array
    {
        return [
            'bar' => 'Bar Chart',
            'line' => 'Line Chart',
            'area' => 'Area Chart',
            'pie' => 'Pie Chart',
            'doughnut' => 'Doughnut Chart',
            'radar' => 'Radar Chart',
            'polarArea' => 'Polar Area Chart',
            'scatter' => 'Scatter Chart',
            'bubble' => 'Bubble Chart'
        ];
    }
}
