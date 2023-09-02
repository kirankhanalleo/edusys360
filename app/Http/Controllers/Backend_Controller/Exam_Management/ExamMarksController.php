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
}
