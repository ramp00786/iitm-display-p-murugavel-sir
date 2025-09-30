<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\Models\Video;
use App\Models\Slideshow;
use App\Models\MeteorologicalTab;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard with statistics
     */
    public function index()
    {
        try {
            $stats = [
                'categories' => Category::count() ?: 0,
                'news' => News::count() ?: 0,
                'videos' => Video::count() ?: 0,
                'slideshows' => Slideshow::count() ?: 0,
                'meteorological_tabs' => class_exists('App\Models\MeteorologicalTab') ? MeteorologicalTab::count() : 0,
                'storage_usage' => $this->getStorageUsage(),
                'recent_activity' => $this->getRecentActivity(),
                'content_breakdown' => $this->getContentBreakdown(),
                'system_health' => $this->getSystemHealth()
            ];
        } catch (\Exception $e) {
            // Fallback stats if there are database issues
            $stats = [
                'categories' => 0,
                'news' => 0,
                'videos' => 0,
                'slideshows' => 0,
                'meteorological_tabs' => 0,
                'storage_usage' => ['videos' => '0 B', 'slideshows' => '0 B', 'total' => '0 B'],
                'recent_activity' => collect(),
                'content_breakdown' => ['news_by_category' => collect(), 'slideshow_by_type' => collect(), 'storage_by_type' => []],
                'system_health' => [
                    'status' => 'warning',
                    'content_activity' => 0,
                    'total_content' => 0,
                    'categories_configured' => false,
                    'has_videos' => false,
                    'has_news' => false,
                    'has_slideshows' => false,
                    'storage_warning' => false,
                ]
            ];
        }

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Calculate storage usage
     */
    private function getStorageUsage()
    {
        try {
            $videoSize = Video::sum('size') ?: 0;
            $slideshowSize = Slideshow::sum('size') ?: 0;
            $totalSize = $videoSize + $slideshowSize;
            
            return [
                'videos' => $this->formatBytes($videoSize),
                'slideshows' => $this->formatBytes($slideshowSize),
                'total' => $this->formatBytes($totalSize)
            ];
        } catch (\Exception $e) {
            return [
                'videos' => '0 B',
                'slideshows' => '0 B',
                'total' => '0 B'
            ];
        }
    }

    /**
     * Get recent activity across all modules
     */
    private function getRecentActivity()
    {
        $activities = collect();
        
        try {
            // Recent news
            $recentNews = News::with('category')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'type' => 'news',
                        'icon' => 'fas fa-newspaper',
                        'color' => 'success',
                        'title' => $item->title,
                        'description' => "Added to " . ($item->category ? $item->category->name : 'Uncategorized'),
                        'time' => $item->created_at->diffForHumans(),
                        'created_at' => $item->created_at
                    ];
                });
            
            // Recent videos
            $recentVideos = Video::orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'type' => 'video',
                        'icon' => 'fas fa-video',
                        'color' => 'info',
                        'title' => $item->title,
                        'description' => $this->formatBytes($item->size ?: 0) . ' • ' . strtoupper(pathinfo($item->filename ?: '', PATHINFO_EXTENSION)),
                        'time' => $item->created_at->diffForHumans(),
                        'created_at' => $item->created_at
                    ];
                });
            
            // Recent slideshows
            $recentSlideshows = Slideshow::orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'type' => 'slideshow',
                        'icon' => 'fas fa-images',
                        'color' => 'warning',
                        'title' => $item->title,
                        'description' => ucfirst($item->type ?: 'unknown') . ' • ' . $this->formatBytes($item->size ?: 0),
                        'time' => $item->created_at->diffForHumans(),
                        'created_at' => $item->created_at
                    ];
                });
            
            $activities = $activities
                ->merge($recentNews)
                ->merge($recentVideos)
                ->merge($recentSlideshows)
                ->sortByDesc('created_at')
                ->take(10)
                ->values();
                
        } catch (\Exception $e) {
            // Return empty collection if there's an error
            $activities = collect();
        }
        
        return $activities;
    }

    /**
     * Get content breakdown by type and category
     */
    private function getContentBreakdown()
    {
        try {
            $newsByCategory = News::with('category')
                ->get()
                ->groupBy('category.name')
                ->map(function ($group) {
                    return (object) [
                        'category_name' => $group->first()->category->name ?? 'Uncategorized',
                        'count' => $group->count()
                    ];
                })
                ->values();

            $slideshowByType = Slideshow::select('type', \DB::raw('COUNT(*) as count'))
                ->groupBy('type')
                ->get();

        } catch (\Exception $e) {
            // Fallback in case of database errors
            $newsByCategory = collect();
            $slideshowByType = collect();
        }

        return [
            'news_by_category' => $newsByCategory,
            'slideshow_by_type' => $slideshowByType,
            'storage_by_type' => [
                'videos' => Video::sum('size') ?: 0,
                'images' => Slideshow::where('type', 'image')->sum('size') ?: 0,
                'gifs' => Slideshow::where('type', 'gif')->sum('size') ?: 0,
                'slideshow_videos' => Slideshow::where('type', 'video')->sum('size') ?: 0,
            ]
        ];
    }

    /**
     * Get system health indicators
     */
    private function getSystemHealth()
    {
        try {
            $newsCount = News::count() ?: 0;
            $videoCount = Video::count() ?: 0;
            $slideshowCount = Slideshow::count() ?: 0;
            $categoryCount = Category::count() ?: 0;
            
            $totalContent = $newsCount + $videoCount + $slideshowCount;
            
            $recentActivity = News::where('created_at', '>=', Carbon::now()->subDays(7))->count() +
                             Video::where('created_at', '>=', Carbon::now()->subDays(7))->count() +
                             Slideshow::where('created_at', '>=', Carbon::now()->subDays(7))->count();
            
            return [
                'status' => $totalContent > 0 ? 'healthy' : 'warning',
                'content_activity' => $recentActivity,
                'total_content' => $totalContent,
                'categories_configured' => $categoryCount > 0,
                'has_videos' => $videoCount > 0,
                'has_news' => $newsCount > 0,
                'has_slideshows' => $slideshowCount > 0,
                'storage_warning' => $this->getTotalStorageSize() > (500 * 1024 * 1024), // 500MB warning
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'warning',
                'content_activity' => 0,
                'total_content' => 0,
                'categories_configured' => false,
                'has_videos' => false,
                'has_news' => false,
                'has_slideshows' => false,
                'storage_warning' => false,
            ];
        }
    }

    /**
     * Get total storage size in bytes
     */
    private function getTotalStorageSize()
    {
        try {
            $videoSize = Video::sum('size') ?: 0;
            $slideshowSize = Slideshow::sum('size') ?: 0;
            return $videoSize + $slideshowSize;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Format bytes to human readable
     */
    private function formatBytes($bytes)
    {
        if ($bytes == 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes > 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
