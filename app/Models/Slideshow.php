<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slideshow extends Model
{
    protected $fillable = [
        'title',
        'filename',
        'path',
        'type',
        'mime_type',
        'size',
        'sort_order'
    ];

    protected $casts = [
        'size' => 'integer'
    ];

    /**
     * Get the full URL for the slideshow file
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    /**
     * Get human readable file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes > 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Scope to get only images
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Scope to get only videos
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Scope to get only GIFs
     */
    public function scopeGifs($query)
    {
        return $query->where('type', 'gif');
    }
}
