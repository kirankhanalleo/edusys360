<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function ViewDesignation()
    {
        $data['allData'] = Designation::all();
        return view('backend.employee.view_designation', $data);
    }
    public function CreateDesignation(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:designations,name'
        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.designation')->with($notification);
    }
    public function EditDesignation($id)
    {
        $editData = Designation::find($id);
        return view('backend.employee.edit_designation', compact('editData'));
    }
    public function UpdateDesignation(Request $request, $id)
    {
        $data = Designation::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Updated Successfully',
            'alert-type' => 'Success'
        );
        return redirect()->route('view.designation')->with($notification);
    }
    public function DeleteDesignation($id)
    {
        $data = Designation::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Designation Deleted Successfully',
            'alert-type' => 'Success'
        );
        return redirect()->route('view.designation')->with($notification);
    }
}
