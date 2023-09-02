<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    public function getStudent()
    {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }
    public function getStudentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    public function getStudentYear()
    {
        return $this->belongsTo(AcademicYear::class, 'year_id', 'id');
    }
    public function getStudentDiscount()
    {
        return $this->belongsTo(StudentPrivilege::class, 'id', 'student_assignment_id');
    }
    public function getFeeCategory()
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }
}
