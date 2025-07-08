<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {
        $systems = System::all();
        return view('admin.system.index', compact('systems'));
    }

    public function create()
    {
        return view('admin.system.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'map' => 'nullable|string',
            'is_use' => 'required|boolean'
        ]);

        System::create($data);
        return redirect()->route('admin.system.index')->with('success', 'Thêm mới thành công');
    }

    public function edit($id)
    {
        $system = System::findOrFail($id);
        return view('admin.system.edit', compact('system'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'map' => 'nullable|string',
            'is_use' => 'required|boolean'
        ]);

        $system = System::findOrFail($id);
        $system->update($data);
        return redirect()->route('admin.system.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $system = System::findOrFail($id);
        $system->delete();
        return redirect()->route('admin.system.index')->with('success', 'Xoá thành công');
    }
}
