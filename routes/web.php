<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\SlideshowController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MeteorologicalController;
use App\Http\Controllers\Api\DisplayDataController;

// Landing page route
Route::get('/', [HomeController::class, 'index'])->name('home');

// API routes for display data
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/display-data', [DisplayDataController::class, 'index'])->name('display.data');
    Route::get('/slideshows', [DisplayDataController::class, 'slideshows'])->name('slideshows');
    Route::get('/videos', [DisplayDataController::class, 'videos'])->name('videos');
    Route::get('/meteorological', [DisplayDataController::class, 'meteorological'])->name('meteorological');
    
    // Debug endpoints
    Route::get('/debug/videos', [App\Http\Controllers\Api\DebugController::class, 'videos'])->name('debug.videos');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes - protected by admin middleware
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('news', NewsController::class);
    Route::resource('videos', VideoController::class);
    Route::resource('slideshows', SlideshowController::class);
    
    // Meteorological data routes
    Route::prefix('meteorological')->name('meteorological.')->group(function () {
        Route::get('/', [MeteorologicalController::class, 'index'])->name('index');
        Route::get('/create-tab', [MeteorologicalController::class, 'createTab'])->name('create.tab');
        Route::post('/store-tab', [MeteorologicalController::class, 'storeTab'])->name('store.tab');
        Route::get('/tab/{tab}/add-chart', [MeteorologicalController::class, 'addChart'])->name('add.chart');
        Route::get('/chart-types', [MeteorologicalController::class, 'showChartTypes'])->name('chart.types');
        Route::post('/store-chart', [MeteorologicalController::class, 'storeChart'])->name('store.chart');
        Route::get('/chart/{chart}/data', [MeteorologicalController::class, 'chartDataForm'])->name('chart.data.form');
        Route::post('/chart/{chart}/data', [MeteorologicalController::class, 'storeChartData'])->name('chart.data.store');
        Route::delete('/tab/{tab}', [MeteorologicalController::class, 'deleteTab'])->name('delete.tab');
        Route::post('/tab/{tab}/delete-with-password', [MeteorologicalController::class, 'deleteTabWithPassword'])->name('delete.tab.password');
        Route::delete('/chart/{chart}', [MeteorologicalController::class, 'deleteChart'])->name('delete.chart');
        
        // New AJAX routes for card interface
        Route::get('/tab/{tab}/charts', [MeteorologicalController::class, 'getTabCharts'])->name('tab.charts');
        Route::get('/tab/{tab}/charts-page', [MeteorologicalController::class, 'showTabChartsPage'])->name('tab.charts.page');
        Route::put('/tab/{tab}/update', [MeteorologicalController::class, 'updateTab'])->name('update.tab');
    });
    
    // Help & Documentation routes
    Route::prefix('help')->name('help.')->group(function () {
        Route::get('/', function () { return view('admin.help.index'); })->name('index');
        Route::get('/categories', function () { return view('admin.help.categories'); })->name('categories');
        Route::get('/news', function () { return view('admin.help.news'); })->name('news');
        Route::get('/videos', function () { return view('admin.help.videos'); })->name('videos');
        Route::get('/slideshows', function () { return view('admin.help.slideshows'); })->name('slideshows');
        Route::get('/meteorological', function () { return view('admin.help.meteorological'); })->name('meteorological');
        Route::get('/profile', function () { return view('admin.help.profile'); })->name('profile');
    });
    
    // Additional routes for reordering
    Route::post('/categories/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
    Route::post('/news/reorder', [NewsController::class, 'reorder'])->name('news.reorder');
    Route::post('/videos/reorder', [VideoController::class, 'reorder'])->name('videos.reorder');
    Route::post('/slideshows/reorder', [SlideshowController::class, 'reorder'])->name('slideshows.reorder');
    
    // Video upload routes
    Route::post('/videos/upload', [VideoController::class, 'upload'])->name('videos.upload');
    Route::post('/slideshows/upload', [SlideshowController::class, 'upload'])->name('slideshows.upload');
});
