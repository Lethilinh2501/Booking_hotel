<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::paginate(7);
        return view('admin.abouts.index', compact('abouts'));
    }
    public function create()
    {
        return view('admin.abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'about' => 'required',
            'is_use' => 'boolean',
        ]);

        About::create($request->only('about', 'is_use'));

        return redirect()->route('admin.abouts.index')->with('success', 'Thêm mới thành công');
    }

    public function show($id)
    {
        $about = About::findOrFail($id);
        return view('admin.abouts.show', compact('about'));
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.abouts.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'about' => 'required',
            'is_use' => 'boolean',
        ]);

        $about = About::findOrFail($id);
        $about->update($request->only('about', 'is_use'));

        return redirect()->route('admin.abouts.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.abouts.index')->with('success', 'Xoá thành công');
    }
}