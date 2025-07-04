<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePlus;
use Illuminate\Http\Request;

class ServicePlusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $servicePluses = ServicePlus::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.servicesPlus.index', compact('servicePluses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.servicesPlus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        ServicePlus::create($request->all());
        return redirect()->route('admin.servicesPlus.index')->with('message', 'Thêm dịch vụ plus thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servicePlus = ServicePlus::findOrFail($id);
        return view('admin.servicesPlus.edit', compact('servicePlus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        $servicePlus = ServicePlus::findOrFail($id);
        $servicePlus->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.servicesPlus.index')->with('message', 'Cập nhật dịch vụ plus thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servicePlus = ServicePlus::findOrFail($id);
        $servicePlus->delete(); // Xóa mềm
        return redirect()->route('admin.servicesPlus.index')->with('message', 'Đã xóa phòng thành công!');
    }
}
