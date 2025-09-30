<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for MySQL string length issue with utf8mb4
        Schema::defaultStringLength(191);
        
        // Handle URL configuration for both local and server environments
        $this->configureUrls();
    }

    /**
     * Configure URLs for different environments
     */
    private function configureUrls(): void
    {
        $request = request();
        
        if (!$request) {
            return;
        }
        
        $host = $request->getHost();
        $uri = $request->getRequestUri();
        
        // Check if we're running on the server with subdirectory
        if (str_contains($host, 'arka.tropmet.res.in')) {
            // Server environment
            $baseUrl = 'https://arka.tropmet.res.in/iitm-display/public';
            config(['app.url' => $baseUrl]);
            URL::forceRootUrl($baseUrl);
            URL::forceScheme('https');
            
            // Also configure asset URL
            config(['app.asset_url' => $baseUrl]);
            
        } elseif (str_contains($host, '127.0.0.1') || str_contains($host, 'localhost') || $request->getPort() == 8000) {
            // Local development environment (php artisan serve or localhost)
            $baseUrl = $request->getScheme() . '://' . $request->getHttpHost();
            config(['app.url' => $baseUrl]);
            URL::forceRootUrl($baseUrl);
            
        } else {
            // Try to detect if we're in a subdirectory by checking the request URI
            if (str_contains($uri, '/iitm-display/public/')) {
                // Running in subdirectory but different domain
                $scheme = $request->getScheme();
                $host = $request->getHost();
                $baseUrl = $scheme . '://' . $host . '/iitm-display/public';
                config(['app.url' => $baseUrl]);
                URL::forceRootUrl($baseUrl);
                
                if ($scheme === 'https') {
                    URL::forceScheme('https');
                }
            }
        }
    }
}
