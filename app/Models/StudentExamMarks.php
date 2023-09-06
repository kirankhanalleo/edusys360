<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamMarks extends Model
{
    public function getStudent()
    {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }
    public function getSubject()
    {
        return $this->belongsTo(SubjectAssignment::class, 'subject_id', 'id');
    }
    public function getSubjectName()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id', 'id');
    }
    public function getYear()
    {
        return $this->belongsTo(AcademicYear::class, 'year_id', 'id');
    }
    public function getClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    public function getExam()
    {
        return $this->belongsTo(ExamModel::class, 'exam_id', 'id');
    }
}
