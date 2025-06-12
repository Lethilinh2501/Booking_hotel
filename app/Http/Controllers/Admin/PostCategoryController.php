<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::orderBy('created_at', 'desc')->get();
        return view('admin.postcategory.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.postcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:post_categories,name'
        ]);

        PostCategory::create(['name' => $request->name]);

        return redirect()->route('admin.postcategory.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function show($id)
    {
        $category = PostCategory::findOrFail($id);
        return view('admin.postcategory.show', compact('category'));
    }

    public function edit($id)
    {
        $category = PostCategory::findOrFail($id);
        return view('admin.postcategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:post_categories,name,' . $id
        ]);

        $category = PostCategory::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('admin.postcategory.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy($id)
    {
        $category = PostCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.postcategory.index')->with('success', 'Xóa danh mục thành công!');
    }

    public function updateStatus($id)
    {
        // Vì trong schema không có status nên tạm thời bỏ chức năng này nếu không cần dùng
        return back()->with('info', 'Chức năng trạng thái chưa được triển khai.');
    }
}
