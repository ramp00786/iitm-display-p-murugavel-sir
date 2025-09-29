<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\Models\Video;
use App\Models\Slideshow;

class HomeController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        // Get slideshow items ordered by sort_order
        $slideshows = Slideshow::orderBy('sort_order')->get();
        
        // Get videos ordered by sort_order
        $videos = Video::orderBy('sort_order')->get();
        
        // Get news by category for tickers
        $newsCategory = Category::where('name', 'News')->first();
        $temperatureCategory = Category::where('name', 'Temperature')->first();
        
        $newsItems = $newsCategory ? $newsCategory->news()->orderBy('sort_order')->get() : collect();
        $temperatureItems = $temperatureCategory ? $temperatureCategory->news()->orderBy('sort_order')->get() : collect();
        
        return view('home', compact('slideshows', 'videos', 'newsItems', 'temperatureItems'));
    }
}
