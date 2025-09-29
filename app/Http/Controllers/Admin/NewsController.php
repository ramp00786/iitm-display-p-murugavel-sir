<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')->orderBy('sort_order')->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $selectedCategory = request('category_id');
        return view('admin.news.create', compact('categories', 'selectedCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Set sort order to last within category
        $maxOrder = News::where('category_id', $request->category_id)->max('sort_order') ?? 0;

        News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'sort_order' => $maxOrder + 1
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'News item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $news->load('category');
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $news->update($request->only('category_id', 'title'));

        return redirect()->route('admin.news.index')
            ->with('success', 'News item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News item deleted successfully.');
    }

    /**
     * Reorder news items
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news' => 'required|array',
            'news.*' => 'exists:news,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }

        foreach ($request->news as $index => $newsId) {
            News::where('id', $newsId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'News items reordered successfully']);
    }
}
