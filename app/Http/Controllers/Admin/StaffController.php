<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function listStaff()
    {
        $listStaff = Staff::with(['role'])
            ->paginate(7);
        return view('admin.staffs.list-staff')->with(['listStaff' => $listStaff]);
    }

    public function addStaff()
    {
        //
    }

    public function detailStaff($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.staffs.detail-staff', compact('staff'));
    }
}
