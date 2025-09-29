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
                ->select('id', 'title', 'url', 'type', 'mime_type', 'sort_order')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'url' => $item->url,
                        'type' => $item->type,
                        'mime_type' => $item->mime_type
                    ];
                });

            // Get videos ordered by sort_order
            $videos = Video::orderBy('sort_order')
                ->select('id', 'title', 'url', 'mime_type', 'sort_order')
                ->get()
                ->map(function($video) {
                    return [
                        'id' => $video->id,
                        'title' => $video->title,
                        'url' => $video->url,
                        'mime_type' => $video->mime_type
                    ];
                });

            // Get news by category for tickers
            $newsCategory = Category::where('name', 'News')->first();
            $temperatureCategory = Category::where('name', 'Temperature')->first();

            $newsItems = $newsCategory 
                ? $newsCategory->news()
                    ->orderBy('sort_order')
                    ->select('id', 'title', 'content')
                    ->get()
                    ->map(function($news) {
                        return [
                            'id' => $news->id,
                            'title' => $news->title,
                            'content' => $news->content
                        ];
                    })
                : collect();

            $temperatureItems = $temperatureCategory 
                ? $temperatureCategory->news()
                    ->orderBy('sort_order')
                    ->select('id', 'title', 'content')
                    ->get()
                    ->map(function($temp) {
                        return [
                            'id' => $temp->id,
                            'title' => $temp->title,
                            'content' => $temp->content
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
                ->select('id', 'title', 'url', 'type', 'mime_type')
                ->get();

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
                ->select('id', 'title', 'url', 'mime_type')
                ->get();

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