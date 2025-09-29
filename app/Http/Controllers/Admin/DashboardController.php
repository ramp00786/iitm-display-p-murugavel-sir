<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\Models\Video;
use App\Models\Slideshow;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard with statistics
     */
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'news' => News::count(),
            'videos' => Video::count(),
            'slideshows' => Slideshow::count(),
            'storage_usage' => $this->getStorageUsage()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Calculate storage usage
     */
    private function getStorageUsage()
    {
        $videoSize = Video::sum('size');
        $slideshowSize = Slideshow::sum('size');
        $totalSize = $videoSize + $slideshowSize;
        
        return [
            'videos' => $this->formatBytes($videoSize),
            'slideshows' => $this->formatBytes($slideshowSize),
            'total' => $this->formatBytes($totalSize)
        ];
    }

    /**
     * Format bytes to human readable
     */
    private function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes > 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
