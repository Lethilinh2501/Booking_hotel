<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author.role', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::all();
    return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:posts,slug',
            'excerpt'      => 'nullable|string|max:255',
            'content'      => 'required|string',
            'category_id'  => 'required|exists:post_categories,id',
            'status'       => 'required|in:draft,published,archived',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ], [
            // Validation messages...
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/posts', 'public');
        }

        Post::create([
            'title'        => $validated['title'],
            'slug'         => $validated['slug'],
            'excerpt'      => $validated['excerpt'],
            'content'      => $validated['content'],
            'category_id'  => $validated['category_id'],
            'status'       => $validated['status'],
            'image'        => $imagePath,
            'published_at' => $validated['published_at'],
            'is_featured'  => $request->has('is_featured'),
            'author_id'    => auth()->id() ?? 1, // Sử dụng auth nếu có
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết thành công!');
    }

    public function show($id)
    {
        $post = Post::with(['category', 'author'])->findOrFail($id);
    return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();
            return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:posts,slug,' . $id,
            'excerpt'      => 'nullable|string|max:255',
            'content'      => 'required|string',
            'category_id'  => 'required|exists:post_categories,id',
            'status'       => 'required|in:draft,published,archived',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ], [
            // Validation messages...
        ]);

        $post = Post::findOrFail($id);
        $data = $validated;
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('uploads/posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Xóa bài viết thành công!');
    }

    // Hiển thị danh sách bài viết client
public function indexClient()
{
    $posts = Post::with('category')
        ->where('status', 'published')
        ->orderByDesc('published_at')
        ->paginate(6);

    return view('client.news.index', compact('posts'));
}

// Hiển thị bài viết theo danh mục
public function byCategory($id)
{
    $category = PostCategory::findOrFail($id);

    $posts = Post::where('category_id', $id)
        ->where('status', 'published')
        ->orderByDesc('published_at')
        ->paginate(6);

    return view('client.news.category', compact('category', 'posts'));
}

// Chi tiết bài viết
public function showClient($id)
{
    $post = Post::with('category')->where('status', 'published')->findOrFail($id);

    return view('client.news.show', compact('post'));
}

}