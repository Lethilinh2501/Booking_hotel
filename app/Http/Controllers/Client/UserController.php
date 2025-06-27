<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    const PATH_UPLOAD_IMAGE = 'users';

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.list', compact('users'));
    }
      public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    public function edit(string $id)
    {
        if (auth()->id() != $id) {
            abort(403, 'Bạn không có quyền truy cập');
        }
        $user = User::query()->findOrFail($id);
        return view('client.profileUse', compact('user'));
    }
    public function update(string $id ,Request $request)
    {
        $user = User::query()->findOrFail($id);
        $data = $request->except('avatar');
         // Xử lý ảnh
         if ($request->hasFile('avatar')) {
            $imagePath = Storage::put(self::PATH_UPLOAD_IMAGE, $request->file('avatar'));
            $data['avatar'] = $imagePath;
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
        }
         $user->update($data);

        return redirect()->route('profileUse.edit', $id)
            ->with('success', 'Thông tin người dùng đã được cập nhật');
    }
}
