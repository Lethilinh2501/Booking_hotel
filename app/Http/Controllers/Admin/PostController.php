<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function listPost()
    {
        $listPost = Post::with(['author.role', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('admin.post.list-post', compact('listPost'));
    }
}
