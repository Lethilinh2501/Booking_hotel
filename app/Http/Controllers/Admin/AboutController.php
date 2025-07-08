<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about' => 'required|string',
            'is_use' => 'required|boolean',
        ]);

        $about = About::first();
        if ($about) {
            $about->update($request->only(['about', 'is_use']));
        } else {
            About::create($request->only(['about', 'is_use']));
        }

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'about' => 'required|string',
            'is_use' => 'required|boolean',
        ]);

        About::create($request->only(['about', 'is_use']));

        return redirect()->route('admin.about.edit')->with('success', 'Đã thêm mới!');
    }
    public function index()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }
    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'Xoá thành công!');
    }
}
