<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use App\Models\ExamModel;
use Illuminate\Http\Request;

class ExamModelController extends Controller
{
    public function ViewExamModel()
    {
        $data['allData'] = ExamModel::all();
        return view('backend.setup.view_exam_model', $data);
    }
    public function AddExamModel()
    {
        return view('backend.setup.add_exam_model');
    }
    public function CreateExamModel(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:exam_models,name'
        ]);
        $data = new ExamModel();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Model Created Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.exam.model')->with($notification);
    }
    public function EditExamModel($id)
    {
        $editData = ExamModel::find($id);
        return view('backend.setup.edit_exam_model', compact('editData'));
    }
    public function UpdateExamModel(Request $request, $id)
    {
        $data = ExamModel::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:exam_models,name'
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Model Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.exam.model')->with($notification);
    }
    public function DeleteExamModel($id)
    {
        $exam = ExamModel::find($id);
        $exam->delete();

        $notification = array(
            'message' => 'Exam Model Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.exam.model')->with($notification);
    }
}
