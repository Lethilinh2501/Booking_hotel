<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostClientController extends Controller
{
    // Trang danh sách tất cả bài viết
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $postsQuery = Post::where('status', 'published');

        if (!empty($keyword)) {
            $postsQuery->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('content', 'like', "%$keyword%");
            });
        }

        $posts = $postsQuery->latest('published_at')->paginate(6);

        $postcategories = PostCategory::withCount([
            'posts' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        $popularPosts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('client.posts.index', compact(
            'posts',
            'postcategories',
            'popularPosts',
            'keyword'
        ));
    }

    // Hiển thị bài viết theo danh mục
    public function byCategory($id)
    {
        $selectedCategory = PostCategory::findOrFail($id);

        $posts = Post::where('status', 'published')
            ->where('category_id', $id)
            ->latest('published_at')
            ->paginate(6);

        $postcategories = PostCategory::withCount([
            'posts' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        $popularPosts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('client.posts.index', compact('posts', 'postcategories', 'popularPosts', 'selectedCategory'));
    }

    public function show(Post $post)
    {
        abort_if($post->status !== 'published', 404);

        $postcategories = PostCategory::withCount([
            'posts' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        $popularPosts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('client.posts.show', compact('post', 'postcategories', 'popularPosts'));
    }
}
