<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    const PATH_UPLOAD_IMAGE = 'users';

    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);
        return view('client.profileUse', compact('user'));
    }
    public function update(string $id ,Request $request)
    {
        $user = User::query()->findOrFail($id);
        $data = $request->except('image');
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
