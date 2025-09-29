<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::orderBy('sort_order')->get();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maxSize = env('MAX_VIDEO_SIZE', 104857600); // 100MB default
        $allowedFormats = explode(',', env('SUPPORTED_VIDEO_FORMATS', 'mp4,avi,mov'));
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'video' => 'required|file|max:' . ($maxSize / 1024) . '|mimes:' . implode(',', $allowedFormats),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('videos', $filename, 'public');

            // Set sort order to last
            $maxOrder = Video::max('sort_order') ?? 0;

            Video::create([
                'title' => $request->title,
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'sort_order' => $maxOrder + 1
            ]);

            return redirect()->route('admin.videos.index')
                ->with('success', 'Video uploaded successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to upload video: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $video->update($request->only('title'));

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        try {
            // Delete file from storage
            if (Storage::disk('public')->exists($video->path)) {
                Storage::disk('public')->delete($video->path);
            }

            // Delete record from database
            $video->delete();

            return redirect()->route('admin.videos.index')
                ->with('success', 'Video deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete video: ' . $e->getMessage());
        }
    }

    /**
     * Handle multiple file uploads with progress tracking
     */
    public function upload(Request $request)
    {
        $maxSize = env('MAX_VIDEO_SIZE', 104857600); // 100MB default
        $allowedFormats = explode(',', env('SUPPORTED_VIDEO_FORMATS', 'mp4,avi,mov'));
        
        $validator = Validator::make($request->all(), [
            'videos' => 'required|array',
            'videos.*' => 'required|file|max:' . ($maxSize / 1024) . '|mimes:' . implode(',', $allowedFormats),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $results = [];
        $successCount = 0;
        $failCount = 0;

        foreach ($request->file('videos') as $file) {
            try {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('videos', $filename, 'public');

                // Set sort order to last
                $maxOrder = Video::max('sort_order') ?? 0;

                Video::create([
                    'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'filename' => $filename,
                    'path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'sort_order' => $maxOrder + 1
                ]);

                $results[] = [
                    'filename' => $file->getClientOriginalName(),
                    'success' => true,
                    'message' => 'Uploaded successfully'
                ];
                $successCount++;

            } catch (\Exception $e) {
                $results[] = [
                    'filename' => $file->getClientOriginalName(),
                    'success' => false,
                    'message' => $e->getMessage()
                ];
                $failCount++;
            }
        }

        return response()->json([
            'success' => true,
            'results' => $results,
            'summary' => [
                'total' => count($request->file('videos')),
                'success' => $successCount,
                'failed' => $failCount
            ]
        ]);
    }

    /**
     * Reorder videos
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'videos' => 'required|array',
            'videos.*' => 'exists:videos,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }

        foreach ($request->videos as $index => $videoId) {
            Video::where('id', $videoId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Videos reordered successfully']);
    }
}
