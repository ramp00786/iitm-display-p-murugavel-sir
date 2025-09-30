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
        if (!$this->path || !$this->filename) {
            return '';
        }
        
        // Construct the full path
        $fullPath = $this->path;
        if (!str_ends_with($this->path, $this->filename)) {
            $fullPath = rtrim($this->path, '/') . '/' . $this->filename;
        }
        
        // For subdirectory deployments, use asset() with proper path construction
        if (str_starts_with($fullPath, 'storage/')) {
            return asset($fullPath);
        } elseif (str_starts_with($fullPath, 'slideshows/')) {
            return asset('storage/' . $fullPath);
        } else {
            return asset('storage/' . ltrim($fullPath, '/'));
        }
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
