<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Video;
use App\Models\Slideshow;
use App\Models\MeteorologicalTab;
use Illuminate\Http\JsonResponse;

class DisplayDataController extends Controller
{
    /**
     * Get all display data for the home page
     */
    public function index(): JsonResponse
    {
        try {
            // Get slideshow items ordered by sort_order
            $slideshows = Slideshow::orderBy('sort_order')
                ->select('id', 'title', 'filename', 'path', 'type', 'mime_type', 'sort_order')
                ->get()
                ->map(function($item) {
                    // Construct URL from path and filename
                    $url = null;
                    
                    if ($item->path && $item->filename) {
                        // Check if path already ends with the filename
                        if (str_ends_with($item->path, $item->filename)) {
                            // Path already includes filename
                            $fullPath = $item->path;
                        } else {
                            // Path and filename are separate
                            $fullPath = rtrim($item->path, '/') . '/' . $item->filename;
                        }
                        
                        // Convert storage path to public URL
                        if (str_starts_with($fullPath, 'storage/')) {
                            $url = asset($fullPath);
                        } else {
                            $url = asset('storage/' . ltrim($fullPath, '/'));
                        }
                    }
                    
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'url' => $url,
                        'type' => $item->type,
                        'mime_type' => $item->mime_type
                    ];
                });

            // Get videos ordered by sort_order
            $videos = Video::orderBy('sort_order')
                ->select('id', 'title', 'filename', 'path', 'mime_type', 'sort_order')
                ->get()
                ->map(function($video) {
                    // Construct URL from path and filename
                    $url = null;
                    
                    if ($video->path && $video->filename) {
                        // Check if path already ends with the filename
                        if (str_ends_with($video->path, $video->filename)) {
                            // Path already includes filename
                            $fullPath = $video->path;
                        } else {
                            // Path and filename are separate
                            $fullPath = rtrim($video->path, '/') . '/' . $video->filename;
                        }
                        
                        // Convert storage path to public URL
                        if (str_starts_with($fullPath, 'storage/')) {
                            $url = asset($fullPath);
                        } else {
                            $url = asset('storage/' . ltrim($fullPath, '/'));
                        }
                    } else {
                        // Fallback: try to find the actual file by matching title
                        $videoFiles = glob(storage_path('app/public/videos/*'));
                        foreach ($videoFiles as $file) {
                            $filename = pathinfo($file, PATHINFO_FILENAME);
                            // Check if the filename contains the video title
                            if (str_contains(strtolower($filename), strtolower($video->title))) {
                                $url = asset('storage/videos/' . basename($file));
                                break;
                            }
                        }
                    }
                    
                    return [
                        'id' => $video->id,
                        'title' => $video->title,
                        'url' => $url,
                        'mime_type' => $video->mime_type
                    ];
                })
                ->filter(function($video) {
                    // Only include videos with valid URLs
                    return $video['url'] !== null;
                });

            // Get news by category for tickers
            $newsCategory = Category::where('name', 'News')->first();
            $temperatureCategory = Category::where('name', 'Temperature')->first();

            $newsItems = $newsCategory 
                ? $newsCategory->news()
                    ->orderBy('sort_order')
                    ->select('id', 'title')
                    ->get()
                    ->map(function($news) {
                        return [
                            'id' => $news->id,
                            'title' => $news->title,
                            'content' => $news->title // Use title as content since there's no separate content field
                        ];
                    })
                : collect();

            $temperatureItems = $temperatureCategory 
                ? $temperatureCategory->news()
                    ->orderBy('sort_order')
                    ->select('id', 'title')
                    ->get()
                    ->map(function($temp) {
                        return [
                            'id' => $temp->id,
                            'title' => $temp->title,
                            'content' => $temp->title // Use title as content since there's no separate content field
                        ];
                    })
                : collect();

            // Get meteorological tabs with their active charts
            $meteorologicalTabs = MeteorologicalTab::where('is_active', true)
                ->with(['activeCharts.chartData'])
                ->orderBy('order')
                ->get()
                ->map(function($tab) {
                    return [
                        'id' => $tab->id,
                        'heading' => $tab->heading ?? '',
                        'data_station' => $tab->data_station ?? 'unknown',
                        'is_active' => $tab->is_active,
                        'order' => $tab->order ?? 0,
                        'charts' => $tab->activeCharts->map(function($chart) {
                            return [
                                'id' => $chart->id,
                                'title' => $chart->title ?? '',
                                'chart_type' => $chart->chart_type ?? 'bar',
                                'data' => $chart->chartData ? [
                                    'labels' => $chart->chartData->labels ?? [],
                                    'datasets' => $chart->chartData->datasets ?? []
                                ] : null
                            ];
                        })
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'slideshows' => $slideshows,
                    'videos' => $videos,
                    'newsItems' => $newsItems,
                    'temperatureItems' => $temperatureItems,
                    'meteorologicalTabs' => $meteorologicalTabs
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching display data',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get only slideshow data
     */
    public function slideshows(): JsonResponse
    {
        try {
            $slideshows = Slideshow::orderBy('sort_order')
                ->select('id', 'title', 'filename', 'path', 'type', 'mime_type')
                ->get()
                ->map(function($item) {
                    // Construct URL from path and filename
                    $url = null;
                    
                    if ($item->path && $item->filename) {
                        // Check if path already ends with the filename
                        if (str_ends_with($item->path, $item->filename)) {
                            // Path already includes filename
                            $fullPath = $item->path;
                        } else {
                            // Path and filename are separate
                            $fullPath = rtrim($item->path, '/') . '/' . $item->filename;
                        }
                        
                        // Convert storage path to public URL
                        if (str_starts_with($fullPath, 'storage/')) {
                            $url = asset($fullPath);
                        } else {
                            $url = asset('storage/' . ltrim($fullPath, '/'));
                        }
                    }
                    
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'url' => $url,
                        'type' => $item->type,
                        'mime_type' => $item->mime_type
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $slideshows
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching slideshows',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get only video data
     */
    public function videos(): JsonResponse
    {
        try {
            $videos = Video::orderBy('sort_order')
                ->select('id', 'title', 'filename', 'path', 'mime_type')
                ->get()
                ->map(function($video) {
                    // Construct URL from path and filename
                    $url = null;
                    
                    if ($video->path && $video->filename) {
                        // Check if path already ends with the filename
                        if (str_ends_with($video->path, $video->filename)) {
                            // Path already includes filename
                            $fullPath = $video->path;
                        } else {
                            // Path and filename are separate
                            $fullPath = rtrim($video->path, '/') . '/' . $video->filename;
                        }
                        
                        // Convert storage path to public URL
                        if (str_starts_with($fullPath, 'storage/')) {
                            $url = asset($fullPath);
                        } else {
                            $url = asset('storage/' . ltrim($fullPath, '/'));
                        }
                    } else {
                        // Fallback: try to find the actual file by matching title
                        $videoFiles = glob(storage_path('app/public/videos/*'));
                        foreach ($videoFiles as $file) {
                            $filename = pathinfo($file, PATHINFO_FILENAME);
                            // Check if the filename contains the video title
                            if (str_contains(strtolower($filename), strtolower($video->title))) {
                                $url = asset('storage/videos/' . basename($file));
                                break;
                            }
                        }
                    }
                    
                    return [
                        'id' => $video->id,
                        'title' => $video->title,
                        'url' => $url,
                        'mime_type' => $video->mime_type
                    ];
                })
                ->filter(function($video) {
                    // Only include videos with valid URLs
                    return $video['url'] !== null;
                });

            return response()->json([
                'success' => true,
                'data' => $videos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching videos',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get only meteorological data
     */
    public function meteorological(): JsonResponse
    {
        try {
            $meteorologicalTabs = MeteorologicalTab::where('is_active', true)
                ->with(['activeCharts.chartData'])
                ->orderBy('order')
                ->get()
                ->map(function($tab) {
                    return [
                        'id' => $tab->id,
                        'heading' => $tab->heading ?? '',
                        'data_station' => $tab->data_station ?? 'unknown',
                        'is_active' => $tab->is_active,
                        'order' => $tab->order ?? 0,
                        'charts' => $tab->activeCharts->map(function($chart) {
                            return [
                                'id' => $chart->id,
                                'title' => $chart->title ?? '',
                                'chart_type' => $chart->chart_type ?? 'bar',
                                'data' => $chart->chartData ? [
                                    'labels' => $chart->chartData->labels ?? [],
                                    'datasets' => $chart->chartData->datasets ?? []
                                ] : null
                            ];
                        })
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $meteorologicalTabs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching meteorological data',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}