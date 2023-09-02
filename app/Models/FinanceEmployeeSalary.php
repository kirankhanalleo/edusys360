<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceEmployeeSalary extends Model
{
    public function getEmployee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'id');
    }
}
