<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function ViewClass()
    {
        $data['allData'] = StudentClass::all();
        return view('backend.setup.view_class', $data);
    }
    public function AddClass()
    {
        return view('backend.setup.add_class');
    }
    public function CreateClass(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name'
        ]);
        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Class Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.class')->with($notification);
    }
    public function EditClass($id)
    {
        $editData = StudentClass::find($id);
        return view('backend.setup.edit_class', compact('editData'));
    }
    public function UpdateClass(Request $request, $id)
    {
        $data = StudentClass::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name,' . $data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Class Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.class')->with($notification);
    }
    public function DeleteClass($id)
    {
        $student = StudentClass::find($id);
        $student->delete();

        $notification = array(
            'message' => 'Class Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.class')->with($notification);
    }
}
