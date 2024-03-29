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

class ExamMarksController extends Controller
{
    public function AddExamMarks()
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['exam_model'] = ExamModel::all();
        return view('backend.exam.marks_management.add_exam_marks', $data);
    }
    public function CreateStudentExamMarks(Request $request)
    {
        $studentCount = $request->student_id;
        if ($studentCount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = new StudentExamMarks();
                $data->year_id = $request->year_id;
                $data->exam_id = $request->exam_id;
                $data->class_id = $request->class_id;
                $data->subject_id = $request->subject_id;
                $data->student_id = $request->student_id[$i];
                $data->reg_id = $request->reg_id[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
            $notification = array(
                'message' => 'Student Marks Added Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sorry! Student Marks Cannot be Inserted.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function EditStudentExamMarks()
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['exam_model'] = ExamModel::all();
        return view('backend.exam.marks_management.edit_exam_marks', $data);
    }
    public function EditStudentsMarks(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        $exam_id = $request->exam_id;

        $allData = StudentExamMarks::with(['getStudent'])->where('year_id', $year_id)->where('class_id', $class_id)->where('subject_id', $subject_id)->where('exam_id', $exam_id)->get();
        return response()->json($allData);
    }
    public function UpdateStudentExamMarks(Request $request)
    {
        StudentExamMarks::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('subject_id', $request->subject_id)->where('exam_id', $request->exam_id)->delete();
        $studentCount = $request->student_id;
        if ($studentCount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = new StudentExamMarks();
                $data->year_id = $request->year_id;
                $data->exam_id = $request->exam_id;
                $data->class_id = $request->class_id;
                $data->subject_id = $request->subject_id;
                $data->student_id = $request->student_id[$i];
                $data->reg_id = $request->reg_id[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
            $notification = array(
                'message' => 'Student Marks Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sorry! Student Marks Cannot be Updated.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
