<?php

namespace App\Http\Controllers\Backend_Controller\Report_Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentExamMarks;
use App\Models\ExamModel;
use App\Models\StudentClass;
use App\Models\AcademicYear;
use App\Models\GradePoint;

class StudentMarksheetController extends Controller
{
    public function ViewMarksheet()
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['examModel'] = ExamModel::all();
        return view('backend.analytics.marksheet.view_marksheet', $data);
    }
    public function GetMarksheet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $reg_id = $request->reg_id;

        $failCount = StudentExamMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_id', $exam_id)->where('reg_id', $reg_id)->where('marks', '<', '40')->get()->count();
        $student = StudentExamMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_id', $exam_id)->where('reg_id', $reg_id)->first();

        if ($student == true) {
            $obtMarks = StudentExamMarks::with(['getSubject', 'getSubjectName', 'getYear'])->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_id', $exam_id)->where('reg_id', $reg_id)->get();
            // dd($obtMarks)->toArray();
            $obtGrades = GradePoint::all();
            return view('backend.analytics.marksheet.marksheet_pdf', compact('obtMarks', 'obtGrades', 'failCount'));
        } else {
            $notification = array(
                'message' => 'Sorry! No data found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
