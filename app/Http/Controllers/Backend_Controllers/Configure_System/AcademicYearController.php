<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;

class AcademicYearController extends Controller
{
    public function ViewYear()
    {
        $data['allData'] = AcademicYear::all();
        return view('backend.student.view_year', $data);
    }
    public function AddYear()
    {
        return view('backend.student.add_year');
    }
    public function CreateYear(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:academic_years,name'
        ]);
        $data = new AcademicYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Academic Year Created Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.year')->with($notification);
    }
    public function EditYear($id)
    {
        $editData = AcademicYear::find($id);
        return view('backend.student.edit_year', compact('editData'));
    }
    public function UpdateYear(Request $request, $id)
    {
        $data = AcademicYear::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:academic_years,name,' . $data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Academic Year Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.year')->with($notification);
    }
    public function DeleteYear($id)
    {
        $year = AcademicYear::find($id);
        $year->delete();

        $notification = array(
            'message' => 'Academic Year Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.year')->with($notification);
    }
}
