<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function listBanner()
    {
        $listBanner = Banner::paginate(7);
        return view('admin.banners.list-banner', compact('listBanner'));
    }

    public function addBanner()
    {
        return view('admin.banners.add-banner');
    }

    public function addPostBanner(Request $req)
    {
        $validated = $req->validate([
            'name'  => 'required|string|max:255',
            'link'  => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('uploads/banners', $filename, 'public');
        }

        Banner::create([
            'name'   => $validated['name'],
            'link'   => $validated['link'] ?? null,
            'image'  => $imagePath,
            'is_use' => $req->has('is_use') ? 1 : 0,
        ]);

        return redirect()->route('admin.banners.listBanner')
            ->with('message', 'Thêm banner thành công!');
    }

    public function detailBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.detail-banner', compact('banner'));
    }

    public function updateBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.update-banner', compact('banner'));
    }

    public function updatePostBanner($id, Request $req)
    {
        $banner = Banner::findOrFail($id);

        $validated = $req->validate([
            'name'  => 'required|string|max:255',
            'link'  => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $banner->image;

        if ($req->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $file = $req->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('uploads/banners', $filename, 'public');
        }

        $banner->update([
            'name'   => $validated['name'],
            'link'   => $validated['link'] ?? null,
            'image'  => $imagePath,
            'is_use' => $req->has('is_use') ? 1 : 0,
        ]);

        return redirect()->route('admin.banners.listBanner')
            ->with('message', 'Cập nhật banner thành công!');
    }

    public function deleteBanner(Request $req)
    {
        $banner = Banner::findOrFail($req->id);

        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.listBanner')
            ->with('message', 'Xóa banner thành công!');
    }
}
