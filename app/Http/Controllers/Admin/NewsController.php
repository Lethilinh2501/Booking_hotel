<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Str;
// Thêm các class cần thiết
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::where('status', 'active')->get(); // Chỉ lấy các danh mục hoạt động
        return view('admin.news.create', compact('categories'));
    }

    // Sử dụng StoreNewsRequest để xử lý validation
    public function store(StoreNewsRequest $request)
    {
        $validated = $request->validated(); // Lấy dữ liệu đã được validate
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        if ($validated['status'] == 'published') {
            $validated['published_at'] = now();
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Thêm tin tức thành công!');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::where('status', 'active')->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    // Sử dụng UpdateNewsRequest và triển khai xóa ảnh cũ
    public function update(UpdateNewsRequest $request, News $news)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            // SỬA: Xóa ảnh cũ nếu nó tồn tại trước khi upload ảnh mới
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        if ($validated['status'] == 'published' && is_null($news->published_at)) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công!');
    }

    // Triển khai xóa ảnh khỏi storage khi xóa tin tức
    public function destroy(News $news)
    {
        // SỬA: Xóa ảnh liên quan khỏi storage
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Xóa tin tức thành công!');
    }
    
    public function toggleFeatured(News $news)
    {
        $news->is_featured = !$news->is_featured;
        $news->save();
        return back()->with('success', 'Thay đổi trạng thái nổi bật thành công!');
    }
}