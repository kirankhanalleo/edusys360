<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use App\Models\SubjectModel;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function ViewSubjects()
    {
        $data['allData'] = SubjectModel::all();
        return view('backend.student.view_subjects', $data);
    }
    public function AddSubjects()
    {
        return view('backend.student.add_subjects');
    }
    public function CreateSubjects(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:subject_models,name'
        ]);
        $data = new SubjectModel();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Created Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.subjects')->with($notification);
    }
    public function EditSubjects($id)
    {
        $editData = SubjectModel::find($id);
        return view('backend.student.edit_subjects', compact('editData'));
    }
    public function UpdateSubjects(Request $request, $id)
    {
        $data = SubjectModel::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:subject_models,name'
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.subjects')->with($notification);
    }
    public function DeleteSubjects($id)
    {
        $subject = SubjectModel::find($id);
        $subject->delete();

        $notification = array(
            'message' => 'Subject Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.subjects')->with($notification);
    }
}
