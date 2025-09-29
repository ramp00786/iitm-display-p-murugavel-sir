<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\JsonResponse;

class DebugController extends Controller
{
    public function videos(): JsonResponse
    {
        $videos = Video::all();
        $debugInfo = [];
        
        foreach ($videos as $video) {
            $videoFiles = glob(storage_path('app/public/videos/*'));
            $matchingFiles = [];
            
            foreach ($videoFiles as $file) {
                $filename = basename($file, '.mp4');
                if (str_contains(strtolower($filename), strtolower($video->title))) {
                    $matchingFiles[] = [
                        'file' => basename($file),
                        'path' => $file,
                        'exists' => file_exists($file),
                        'url' => asset('storage/videos/' . basename($file))
                    ];
                }
            }
            
            $debugInfo[] = [
                'id' => $video->id,
                'title' => $video->title,
                'url_in_db' => $video->url,
                'matching_files' => $matchingFiles,
                'all_video_files' => array_map('basename', $videoFiles)
            ];
        }
        
        return response()->json([
            'debug' => $debugInfo,
            'storage_path' => storage_path('app/public/videos/'),
            'public_path' => public_path('storage/videos/'),
            'storage_link_exists' => is_link(public_path('storage'))
        ]);
    }
}