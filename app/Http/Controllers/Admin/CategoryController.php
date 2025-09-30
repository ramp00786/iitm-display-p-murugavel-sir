<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Set sort order to last
        $maxOrder = Category::max('sort_order') ?? 0;

        Category::create([
            'name' => $request->name,
            'sort_order' => $maxOrder + 1
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('news');
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category->update($request->only('name'));

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $category)
    {
        // Validate the password
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors([
                'delete_error' => 'Password is required and must be at least 6 characters long.'
            ])->with('error', 'Password validation failed.');
        }

        // Verify the password against the current authenticated user
        $user = auth()->user();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'delete_error' => 'Invalid password. Please enter your correct admin password.'
            ])->with('error', 'Invalid password provided.');
        }

        // Check if category has news items
        if ($category->news()->count() > 0) {
            return back()->withErrors([
                'delete_error' => 'Cannot delete category that has news items. Move or delete the news items first.'
            ])->with('error', 'Cannot delete category that has news items.');
        }

        try {
            // Store category name for success message
            $categoryName = $category->name;
            
            // Delete the category
            $category->delete();

            return redirect()->route('admin.categories.index')
                ->with('success', "Category '{$categoryName}' deleted successfully.");

        } catch (\Exception $e) {
            return back()->withErrors([
                'delete_error' => 'Failed to delete category: ' . $e->getMessage()
            ])->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }

    /**
     * Reorder categories
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }

        foreach ($request->categories as $index => $categoryId) {
            Category::where('id', $categoryId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Categories reordered successfully']);
    }
}
