<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slideshow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slideshows = Slideshow::orderBy('sort_order')->get();
        return view('admin.slideshows.index', compact('slideshows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slideshows.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maxImageSize = env('MAX_IMAGE_SIZE', 10485760); // 10MB default
        $maxVideoSize = env('MAX_VIDEO_SIZE', 104857600); // 100MB default
        $imageFormats = explode(',', env('SUPPORTED_IMAGE_FORMATS', 'jpg,jpeg,png,gif'));
        $videoFormats = explode(',', env('SUPPORTED_VIDEO_FORMATS', 'mp4,avi,mov'));
        $allFormats = array_merge($imageFormats, $videoFormats);
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:' . implode(',', $allFormats),
        ]);

        // Add custom size validation based on file type
        $validator->after(function ($validator) use ($request, $maxImageSize, $maxVideoSize, $imageFormats) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = strtolower($file->getClientOriginalExtension());
                
                if (in_array($extension, $imageFormats)) {
                    if ($file->getSize() > $maxImageSize) {
                        $validator->errors()->add('file', 'Image file size cannot exceed ' . number_format($maxImageSize / 1048576, 0) . 'MB.');
                    }
                } else {
                    if ($file->getSize() > $maxVideoSize) {
                        $validator->errors()->add('file', 'Video file size cannot exceed ' . number_format($maxVideoSize / 1048576, 0) . 'MB.');
                    }
                }
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('slideshows', $filename, 'public');

            // Determine file type
            $mimeType = $file->getMimeType();
            $type = 'image'; // default
            
            if (str_starts_with($mimeType, 'video/')) {
                $type = 'video';
            } elseif (str_starts_with($mimeType, 'image/gif')) {
                $type = 'gif';
            }

            // Set sort order to last
            $maxOrder = Slideshow::max('sort_order') ?? 0;

            Slideshow::create([
                'title' => $request->title,
                'filename' => $filename,
                'path' => $path,
                'type' => $type,
                'mime_type' => $mimeType,
                'size' => $file->getSize(),
                'sort_order' => $maxOrder + 1
            ]);

            return redirect()->route('admin.slideshows.index')
                ->with('success', 'Slideshow item uploaded successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slideshow $slideshow)
    {
        return view('admin.slideshows.show', compact('slideshow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slideshow $slideshow)
    {
        return view('admin.slideshows.edit', compact('slideshow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slideshow $slideshow)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $slideshow->update($request->only('title'));

        return redirect()->route('admin.slideshows.index')
            ->with('success', 'Slideshow item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slideshow $slideshow)
    {
        try {
            // Delete file from storage
            if (Storage::disk('public')->exists($slideshow->path)) {
                Storage::disk('public')->delete($slideshow->path);
            }

            // Delete record from database
            $slideshow->delete();

            return redirect()->route('admin.slideshows.index')
                ->with('success', 'Slideshow item deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete slideshow item: ' . $e->getMessage());
        }
    }

    /**
     * Handle multiple file uploads with progress tracking
     */
    public function upload(Request $request)
    {
        $maxImageSize = env('MAX_IMAGE_SIZE', 10485760); // 10MB default
        $maxVideoSize = env('MAX_VIDEO_SIZE', 104857600); // 100MB default
        $imageFormats = explode(',', env('SUPPORTED_IMAGE_FORMATS', 'jpg,jpeg,png,gif'));
        $videoFormats = explode(',', env('SUPPORTED_VIDEO_FORMATS', 'mp4,avi,mov'));
        $allFormats = array_merge($imageFormats, $videoFormats);
        
        $validator = Validator::make($request->all(), [
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:' . implode(',', $allFormats),
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

        foreach ($request->file('files') as $file) {
            try {
                $extension = strtolower($file->getClientOriginalExtension());
                
                // Check file size based on type
                if (in_array($extension, $imageFormats) && $file->getSize() > $maxImageSize) {
                    throw new \Exception('Image file size exceeds ' . number_format($maxImageSize / 1048576, 0) . 'MB limit');
                }
                
                if (in_array($extension, $videoFormats) && $file->getSize() > $maxVideoSize) {
                    throw new \Exception('Video file size exceeds ' . number_format($maxVideoSize / 1048576, 0) . 'MB limit');
                }

                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('slideshows', $filename, 'public');

                // Determine file type
                $mimeType = $file->getMimeType();
                $type = 'image'; // default
                
                if (str_starts_with($mimeType, 'video/')) {
                    $type = 'video';
                } elseif (str_starts_with($mimeType, 'image/gif')) {
                    $type = 'gif';
                }

                // Set sort order to last
                $maxOrder = Slideshow::max('sort_order') ?? 0;

                Slideshow::create([
                    'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'filename' => $filename,
                    'path' => $path,
                    'type' => $type,
                    'mime_type' => $mimeType,
                    'size' => $file->getSize(),
                    'sort_order' => $maxOrder + 1
                ]);

                $results[] = [
                    'filename' => $file->getClientOriginalName(),
                    'success' => true,
                    'message' => 'Uploaded successfully',
                    'type' => $type
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
                'total' => count($request->file('files')),
                'success' => $successCount,
                'failed' => $failCount
            ]
        ]);
    }

    /**
     * Reorder slideshow items
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slideshows' => 'required|array',
            'slideshows.*' => 'exists:slideshows,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }

        foreach ($request->slideshows as $index => $slideshowId) {
            Slideshow::where('id', $slideshowId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Slideshow items reordered successfully']);
    }
}
