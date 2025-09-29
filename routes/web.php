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

// Landing page route
Route::get('/', [HomeController::class, 'index'])->name('home');

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
    
    // Additional routes for reordering
    Route::post('/categories/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
    Route::post('/news/reorder', [NewsController::class, 'reorder'])->name('news.reorder');
    Route::post('/videos/reorder', [VideoController::class, 'reorder'])->name('videos.reorder');
    Route::post('/slideshows/reorder', [SlideshowController::class, 'reorder'])->name('slideshows.reorder');
    
    // Video upload routes
    Route::post('/videos/upload', [VideoController::class, 'upload'])->name('videos.upload');
    Route::post('/slideshows/upload', [SlideshowController::class, 'upload'])->name('slideshows.upload');
});
