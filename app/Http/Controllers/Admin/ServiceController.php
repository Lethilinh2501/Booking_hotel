<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required'  => 'Vui lòng nhập tên dịch vụ',
            'name.max'       => 'Tên dịch vụ không được vượt quá 255 ký tự',
            'price.required' => 'Vui lòng nhập giá dịch vụ',
            'price.numeric'  => 'Giá dịch vụ phải là một số',
            'price.gt'       => 'Giá dịch vụ phải lớn hơn 0',
        ]);

        Service::create($request->all());
        return redirect()->route('admin.services.index')->with('message', 'Thêm dịch vụ thành công!');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
        ], [
            'name.required'  => 'Vui lòng nhập tên dịch vụ',
            'name.max'       => 'Tên dịch vụ không được vượt quá 255 ký tự',
            'price.required' => 'Vui lòng nhập giá dịch vụ',
            'price.numeric'  => 'Giá dịch vụ phải là số',
            'price.min'      => 'Giá dịch vụ phải lớn hơn 0',
        ]);

        $service = Service::findOrFail($id);
        $service->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.services.index')->with('message', 'Cập nhật dịch vụ thành công!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete(); // Xóa mềm
        return redirect()->route('admin.services.index')->with('message', 'Đã xóa phòng thành công!');
    }
}
