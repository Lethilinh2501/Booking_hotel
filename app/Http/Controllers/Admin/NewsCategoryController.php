<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::latest()
                               ->paginate(10);
                               
        return view('admin.news-categories.index', compact('categories'));
    }

    public function create()
    {
            $parentCategories = NewsCategory::all();

        return view('admin.news-categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:news_categories,id'
        ]);

        // Tạo slug từ name
        $validated['slug'] = Str::slug($request->name);

        NewsCategory::create($validated);

        return redirect()->route('admin.news-categories.index')
                        ->with('success', 'Danh mục đã được thêm thành công');
    }

    public function show(NewsCategory $category)
    {
        return view('admin.news-categories.show', compact('category'));
    }

    public function edit(NewsCategory $category)
    {
        $parentCategories = NewsCategory::where('id', '!=', $category->id)->get();
        return view('admin.news-categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, NewsCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name,'.$category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:news_categories,id'
        ]);

        // Cập nhật slug nếu name thay đổi
        if ($category->name !== $request->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        $category->update($validated);

        return redirect()->route('admin.news-categories.index')
                        ->with('success', 'Danh mục đã được cập nhật thành công');
    }

    public function destroy(NewsCategory $category)
    {
        // Kiểm tra nếu danh mục có bài viết
        if ($category->news()->count() > 0) {
            return redirect()->back()
                            ->with('error', 'Không thể xóa danh mục vì có tin tức thuộc danh mục này');
        }

        // Kiểm tra nếu danh mục có danh mục con
        if ($category->children()->count() > 0) {
            return redirect()->back()
                            ->with('error', 'Không thể xóa danh mục vì có danh mục con');
        }

        $category->delete();

        return redirect()->route('admin.news-categories.index')
                        ->with('success', 'Danh mục đã được xóa thành công');
    }

    public function updateStatus(Request $request, NewsCategory $category)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $category->update(['status' => $request->status]);

        return back()->with('success', 'Trạng thái danh mục đã được cập nhật');
    }
}