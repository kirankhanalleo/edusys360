<?php

namespace App\Http\Controllers\Backend_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\StudentExamMarks;
use App\Models\Students;
use App\Models\AcademicYear;
use App\Models\ExamModel;
use App\Models\StudentAssignment;
use App\Models\SubjectAssignment;

class PrimaryController extends Controller
{
    public function GetSubject(Request $request)
    {
        $class_id = $request->class_id;
        $allData = SubjectAssignment::with(['subject'])->where('class_id', $class_id)->get();
        return response()->json($allData);
    }
    public function GetStudents(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $allData = StudentAssignment::with(['getStudent'])->where('year_id', $year_id)->where('class_id', $class_id)->get();

        return response()->json($allData);
    }
    public function EditStudentsMarks()
    {
    }
}
