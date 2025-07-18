<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\RulesAndRegulation;

use Illuminate\Http\Request;

class RuleAndRegulationController extends Controller
{
    public function index()
    {
        $rules = RulesAndRegulation::orderBy('created_at', 'desc')->get();
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return  view('admin.rules.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'roomTypes' => 'nullable|array',
            'roomTypes.*' => 'exists:room_types,id',
        ]);

        $rule = RulesAndRegulation::create([
            'name' => $validated['name'],
            'is_active' => $validated['is_active'],
        ]);

        if (!empty($validated['roomTypes'])) {
            $rule->roomTypes()->sync($validated['roomTypes']);
        }

        return redirect()->route('admin.rules.index')->with('success', 'Thêm quy định thành công!');
    }


    public function edit($id)
    {
        $roomTypes = RoomType::all();
        $rule = RulesAndRegulation::findOrFail($id);
        return view('admin.rules.edit', compact('rule', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'roomTypes' => 'nullable|array',
            'roomTypes.*' => 'exists:room_types,id',
        ]);

        $rule = RulesAndRegulation::findOrFail($id);

        $rule->update([
            'name' => $validated['name'],
            'is_active' => $validated['is_active'],
        ]);

        if (!empty($validated['roomTypes'])) {
            $selected = $validated['roomTypes'];

            if (in_array('all', $selected)) {
                $allRoomTypeIds = RoomType::pluck('id')->toArray();
                $rule->roomTypes()->sync($allRoomTypeIds);
            } else {
                $rule->roomTypes()->sync($selected);
            }
        } else {
            // Nếu không chọn loại phòng nào, bỏ hết liên kết
            $rule->roomTypes()->detach();
        }

        return redirect()->route('admin.rules.index')->with('success', 'Cập nhật quy định thành công!');
    }

    public function destroy($id)
    {
        RulesAndRegulation::destroy($id);
        return redirect()->route('admin.rules.index')->with('success', 'Xóa thành công!');
    }
}
