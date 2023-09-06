<?php

namespace App\Http\Controllers\Backend_Controller\Exam_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\StudentExamMarks;
use App\Models\Students;
use App\Models\AcademicYear;
use App\Models\ExamModel;
use App\Models\SubjectAssignment;
use App\Models\GradePoint;

class GradePointController extends Controller
{
    public function AddGradePoint()
    {
        $data['allData'] = GradePoint::all();
        return view('backend.exam.grade_point_management.view_grade_point', $data);
    }
    public function CreateGradePoint(Request $request)
    {
        $gradePoint = new GradePoint();
        $gradePoint->grade_name = $request->grade_name;
        $gradePoint->start_marks = $request->start_marks;
        $gradePoint->end_marks = $request->end_marks;
        $gradePoint->start_point = $request->start_point;
        $gradePoint->end_point = $request->end_point;
        $gradePoint->remarks = $request->remarks;
        $gradePoint->save();

        $notification = array(
            'message' => 'Grade Point Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('add.grade.point')->with($notification);
    }
    public function EditGradePoint($id)
    {
        $data['editData'] = GradePoint::find($id);
        return view('backend.exam.grade_point_management.edit_grade_point', $data);
    }
    public function UpdatetGradePoint(Request $request, $id)
    {
        $gradePoint =  GradePoint::find($id);
        $gradePoint->grade_name = $request->grade_name;
        $gradePoint->start_marks = $request->start_marks;
        $gradePoint->end_marks = $request->end_marks;
        $gradePoint->start_point = $request->start_point;
        $gradePoint->end_point = $request->end_point;
        $gradePoint->remarks = $request->remarks;
        $gradePoint->save();

        $notification = array(
            'message' => 'Grade Point Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('add.grade.point')->with($notification);
    }
}
