<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function listPost()
    {
        $listPost = Post::with(['author.role', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('admin.post.list-post', compact('listPost'));
    }

    public function addPost()
    {
        $categories = PostCategory::all();
        return view('admin.post.add-post', compact('categories'));
    }

    public function addPostPost(Request $request)
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
            'title.required'        => 'Vui lòng nhập tiêu đề.',
            'slug.required'         => 'Vui lòng nhập slug.',
            'slug.unique'           => 'Slug đã tồn tại.',
            'content.required'      => 'Vui lòng nhập nội dung.',
            'category_id.required'  => 'Vui lòng chọn danh mục.',
            'status.required'       => 'Vui lòng chọn trạng thái.',
            'image.image'           => 'Tệp tải lên phải là hình ảnh.',
            'image.max'             => 'Ảnh không được vượt quá 2MB.',
        ]);

        // Xử lý lưu ảnh nếu có
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('uploads/posts', $filename, 'public');
        }

        Post::create([
            'title'        => $validated['title'],
            'slug'         => $validated['slug'],
            'excerpt'      => $request->input('excerpt'),
            'content'      => $validated['content'],
            'category_id'  => $validated['category_id'],
            'status'       => $validated['status'],
            'image'        => $imagePath,
            'published_at' => $request->input('published_at'),
            'is_featured'  => $request->has('is_featured'),
            'author_id'    => 1, // Tạm gán nếu chưa có auth
        ]);

        return redirect()->route('admin.post.listPost')->with('success', 'Thêm bài viết thành công!');
    }

    public function updatePost($id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();

        return view('admin.post.update-post', compact('post', 'categories'));
    }

    public function updatePatchPost(Request $request, $id)
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
            'title.required'        => 'Vui lòng nhập tiêu đề.',
            'slug.required'         => 'Vui lòng nhập slug.',
            'slug.unique'           => 'Slug đã tồn tại.',
            'content.required'      => 'Vui lòng nhập nội dung.',
            'category_id.required'  => 'Vui lòng chọn danh mục.',
            'status.required'       => 'Vui lòng chọn trạng thái.',
            'image.image'           => 'Tệp tải lên phải là hình ảnh.',
            'image.max'             => 'Ảnh không được vượt quá 2MB.',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validated['title'];
        $post->slug = $validated['slug'];
        $post->excerpt = $validated['excerpt'];
        $post->content = $validated['content'];
        $post->category_id = $validated['category_id'];
        $post->status = $validated['status'];
        $post->published_at = $validated['published_at'];
        $post->is_featured = $request->has('is_featured');

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/posts', $filename, 'public');
            $post->image = $path;
        }

        $post->save();

        return redirect()->route('admin.post.listPost')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function detailPost($id)
    {
        $post = Post::with(['category', 'author'])->findOrFail($id);
        return view('admin.post.detail-post', compact('post'));
    }

    public function deletePost(Request $req)
    {
        $post = Post::findOrFail($req->id);

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.post.listPost')
            ->with('message', 'Xóa bài viết thành công!');
    }
}
